<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      DatabaseGlobalChatQueries.php                               ##
##  Purpose:       Server-wide ("World Chat") messages + moderation            ##
##                 (mute/block), separate from the existing alliance chat      ##
##                 (chat table, see GameEngine/Chat.php).                      ##
##                                                                             ##
##  Cerut de Catalin, 07.09.2026: chat general vizibil/scris de orice          ##
##  jucator logat, cu moderare pentru Admin (access 9) si MH (access 8).       ##
##                                                                             ##
##  Faza 2 (09.09.2026): stergere mesaj (mod), editare mesaj propriu (user),   ##
##  sondaje (chat_global_polls / chat_global_poll_votes) si suport emoji       ##
##  (chat_global trecut pe utf8mb4 - vezi struct.sql).                        ##
##                                                                             ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
#################################################################################

trait DatabaseGlobalChatQueries {

    /**
     * Posteaza un mesaj in chat-ul general, daca userul nu e mutat si a
     * trecut rate-limit-ul minim intre 2 mesaje (anti-spam simplu).
     *
     * @return array ['ok'=>bool, 'reason'=>string|null, 'mutedUntil'=>int|null]
     */
    function postGlobalChatMessage($uid, $msg) {
        $uid = (int) $uid;
        $msg = trim((string) $msg);

        if ($uid <= 0) {
            return ['ok' => false, 'reason' => 'notloggedin'];
        }

        if ($msg === '') {
            return ['ok' => false, 'reason' => 'empty'];
        }

        // acelasi plafon ca la chat-ul de alianta existent (chat.msg e varchar(255);
        // 250 lasa loc de siguranta pentru escaping/multi-byte)
        $msg = function_exists('mb_substr') ? mb_substr($msg, 0, 250) : substr($msg, 0, 250);

        $mutedUntil = $this->getGlobalChatMuteStatus($uid);
        if ($mutedUntil !== null) {
            return ['ok' => false, 'reason' => 'muted', 'mutedUntil' => $mutedUntil];
        }

        list($euid) = $this->escape_input($uid);

        $lastRow = mysqli_fetch_assoc($this->query(
            "SELECT date FROM " . TB_PREFIX . "chat_global WHERE id_user = $euid ORDER BY id DESC LIMIT 1"
        ));

        $now = time();
        // rate-limit: minim 3 secunde intre 2 mesaje ale aceluiasi user
        if ($lastRow && ($now - (int) $lastRow['date']) < 3) {
            return ['ok' => false, 'reason' => 'ratelimit'];
        }

        list($emsg) = $this->escape_input($msg);

        $this->query(
            "INSERT INTO " . TB_PREFIX . "chat_global (id_user, date, msg) VALUES ($euid, $now, '$emsg')"
        );

        return ['ok' => true];
    }

    /**
     * Mesajele din chat-ul general, gata de afisat (ordine cronologica).
     *
     * Mod 1 - incarcare initiala: ultimele $limit mesaje ($sinceId = 0).
     * Mod 2 - poll incremental: doar mesajele noi, mai mari decat $sinceId
     * (evita re-trimiterea ferestrei intregi la fiecare interogare din JS).
     *
     * Tag-ul de alianta si nivelul de access sunt rezolvate live, printr-un
     * singur JOIN (nu o interogare per mesaj) - reflecta mereu alianta
     * curenta a jucatorului, nu una "inghetata" la momentul postarii.
     */
    function getGlobalChatMessages($limit = 30, $sinceId = 0, $viewerUid = 0) {
        $limit = (int) $limit;
        $sinceId = (int) $sinceId;
        $viewerUid = (int) $viewerUid;

        $where = $sinceId > 0 ? "WHERE c.id > $sinceId" : "";
        $order = $sinceId > 0 ? "ORDER BY c.id ASC" : "ORDER BY c.id DESC";
        // plafon si pe polling-ul incremental (nu doar la incarcarea initiala) -
        // daca un tab a stat minimizat/in background ore intregi (throttling de
        // browser pe mobil), la revenire nu vrem un SELECT nemarginit
        $limitSql = "LIMIT " . ($sinceId > 0 ? 200 : $limit);

        // Faza 2: c.type/c.poll_id/c.deleted/c.edited - vezi editGlobalChatMessage(),
        // deleteGlobalChatMessage() si createGlobalChatPoll() mai jos
        $q = "SELECT c.id, c.id_user, c.date, c.msg, c.type, c.poll_id, c.deleted, c.edited,
                     u.username, u.access, a.tag AS ally_tag, a.id AS ally_id
              FROM " . TB_PREFIX . "chat_global c
              LEFT JOIN " . TB_PREFIX . "users u ON u.id = c.id_user
              LEFT JOIN " . TB_PREFIX . "alidata a ON a.id = u.alliance AND u.alliance > 0
              $where
              $order
              $limitSql";

        $rows = $this->mysqli_fetch_all($this->query($q));

        // la incarcarea initiala am luat descrescator (ca sa prindem exact
        // ultimele $limit), le intoarcem in ordine cronologica normala
        if ($sinceId <= 0) {
            $rows = array_reverse($rows);
        }

        foreach ($rows as &$row) {
            if ((int) $row['deleted'] === 1) {
                // golim textul server-side (nu doar in client) - un mesaj sters de
                // moderator (de obicei vulgar) nu trebuie sa mai ajunga deloc, sub
                // nicio forma, in raspunsul JSON catre ceilalti clienti
                $row['msg'] = '';
            } elseif ($row['type'] === 'poll' && $row['poll_id']) {
                $row['poll'] = $this->getGlobalChatPollData($row['poll_id'], $viewerUid);
            }
        }
        unset($row);

        return $rows;
    }

    /**
     * Editeaza un mesaj propriu (text simplu, nu sondaje) - vezi
     * deleteGlobalChatMessage() pentru actiunea de moderare (mesajul altcuiva).
     * Fara limita de timp la editare (nu a fost ceruta); usor de adaugat o
     * fereastra (ex. doar primele 5 minute) daca se doreste ulterior.
     *
     * @return array ['ok'=>bool, 'reason'=>string|null]
     */
    function editGlobalChatMessage($uid, $msgId, $newMsg) {
        $uid = (int) $uid;
        $msgId = (int) $msgId;
        $newMsg = trim((string) $newMsg);

        if ($uid <= 0 || $msgId <= 0) {
            return ['ok' => false, 'reason' => 'invalid'];
        }

        if ($newMsg === '') {
            return ['ok' => false, 'reason' => 'empty'];
        }

        $newMsg = function_exists('mb_substr') ? mb_substr($newMsg, 0, 250) : substr($newMsg, 0, 250);

        $row = mysqli_fetch_assoc($this->query(
            "SELECT id_user, type, deleted FROM " . TB_PREFIX . "chat_global WHERE id = $msgId"
        ));

        if (!$row) {
            return ['ok' => false, 'reason' => 'notfound'];
        }

        // doar propriul mesaj, doar daca nu a fost deja sters de un moderator,
        // si doar mesaje text (ancora unui sondaj nu se editeaza ca text simplu)
        if ((int) $row['id_user'] !== $uid || (int) $row['deleted'] === 1 || $row['type'] !== 'text') {
            return ['ok' => false, 'reason' => 'forbidden'];
        }

        list($emsg) = $this->escape_input($newMsg);
        $now = time();

        $this->query(
            "UPDATE " . TB_PREFIX . "chat_global SET msg = '$emsg', edited = 1, updated_at = $now WHERE id = $msgId"
        );

        return ['ok' => true];
    }

    /**
     * Sterge (soft-delete) un mesaj din chat-ul general - actiune de moderare.
     * Textul e golit aici (nu doar ascuns in client), acelasi motiv ca la
     * golirea din getGlobalChatMessages() mai sus. Verificarea de rang (MH/
     * Admin, access minim) se face in ajax.php, la fel ca la mute/block - DAR
     * spre deosebire de mute/block, aici NU se compara rangul cu al autorului:
     * stergerea vizeaza continutul (un mesaj vulgar), nu persoana, deci orice
     * MH/Admin poate sterge orice mesaj, inclusiv al altui MH, ca sa poata
     * curata rapid chat-ul.
     *
     * @return bool
     */
    function deleteGlobalChatMessage($msgId) {
        $msgId = (int) $msgId;
        $now = time();

        return $this->query(
            "UPDATE " . TB_PREFIX . "chat_global SET msg = '', deleted = 1, updated_at = $now WHERE id = $msgId AND deleted = 0"
        ) ? true : false;
    }

    /**
     * Mesaje editate/sterse de la ultimul cec al clientului ($sinceTs, unix) -
     * necesar ca sa se poata actualiza "in loc" mesajele deja randate la un
     * client care are panoul de chat deschis de mai mult timp: poll-ul normal
     * de mesaje noi (getGlobalChatMessages, dupa id) nu ar mai prinde o
     * editare/stergere pe un mesaj vechi, deja afisat, cu id mai mic decat
     * ultimul id vazut de client.
     *
     * Include si datele proaspete de sondaj pentru randurile de tip 'poll'
     * (ex. cand cineva voteaza, votul nu schimba mesajul in sine, dar
     * voteGlobalChatPoll() atinge acest rand exact ca sa fie prins aici -
     * altfel doar cel care voteaza ar vedea rezultatul actualizat).
     *
     * @return array ['rows'=>array, 'now'=>int] - 'now' devine noul watermark pe client
     */
    function getGlobalChatUpdates($sinceTs, $viewerUid = 0, $limit = 100) {
        $sinceTs = (int) $sinceTs;
        $viewerUid = (int) $viewerUid;
        $now = time();
        $limit = (int) $limit;

        $rows = $this->mysqli_fetch_all($this->query(
            "SELECT id, msg, type, poll_id, deleted, edited FROM " . TB_PREFIX . "chat_global
             WHERE updated_at > $sinceTs AND updated_at <= $now
             ORDER BY updated_at ASC
             LIMIT $limit"
        ));

        foreach ($rows as &$row) {
            if ((int) $row['deleted'] === 1) {
                $row['msg'] = '';
            } elseif ($row['type'] === 'poll' && $row['poll_id']) {
                $row['poll'] = $this->getGlobalChatPollData($row['poll_id'], $viewerUid);
            }
        }
        unset($row);

        return ['rows' => $rows, 'now' => $now];
    }

    /**
     * Creeaza un sondaj in chat-ul general: un rand-ancora in chat_global
     * (type='poll', ca sa-si pastreze locul cronologic in flux de mesaje) +
     * randul cu intrebarea/optiunile in chat_global_polls. Reutilizeaza
     * acelasi mute-check ca postGlobalChatMessage (un user mutat nu poate
     * nici posta mesaje, nici crea sondaje).
     *
     * @param array $options 2-6 optiuni (string-uri) - restul sunt ignorate
     * @return array ['ok'=>bool, 'reason'=>string|null]
     */
    function createGlobalChatPoll($uid, $question, $options) {
        $uid = (int) $uid;
        $question = trim((string) $question);
        $question = function_exists('mb_substr') ? mb_substr($question, 0, 200) : substr($question, 0, 200);

        if ($uid <= 0 || $question === '') {
            return ['ok' => false, 'reason' => 'invalid'];
        }

        $clean = [];
        foreach ((array) $options as $opt) {
            $opt = trim((string) $opt);
            if ($opt === '') {
                continue;
            }
            $clean[] = function_exists('mb_substr') ? mb_substr($opt, 0, 60) : substr($opt, 0, 60);
            if (count($clean) >= 6) {
                break;
            }
        }

        if (count($clean) < 2) {
            return ['ok' => false, 'reason' => 'notenoughoptions'];
        }

        $mutedUntil = $this->getGlobalChatMuteStatus($uid);
        if ($mutedUntil !== null) {
            return ['ok' => false, 'reason' => 'muted', 'mutedUntil' => $mutedUntil];
        }

        list($euid) = $this->escape_input($uid);
        list($eq) = $this->escape_input($question);
        $now = time();

        // 1) randul-ancora in chat_global (msg = intrebarea - fallback util daca
        //    ceva citeste chat_global fara sa stie de chat_global_polls)
        $this->query(
            "INSERT INTO " . TB_PREFIX . "chat_global (id_user, date, msg, type) VALUES ($euid, $now, '$eq', 'poll')"
        );
        $chatId = mysqli_insert_id($this->dblink);

        // 2) intrebarea + optiunile (JSON)
        list($eOptions) = $this->escape_input(json_encode(array_values($clean)));
        $this->query(
            "INSERT INTO " . TB_PREFIX . "chat_global_polls (chat_id, id_user, question, options, created)
             VALUES ($chatId, $euid, '$eq', '$eOptions', $now)"
        );
        $pollId = mysqli_insert_id($this->dblink);

        // 3) leaga ancora de randul de sondaj
        $this->query(
            "UPDATE " . TB_PREFIX . "chat_global SET poll_id = $pollId WHERE id = $chatId"
        );

        return ['ok' => true];
    }

    /**
     * Inregistreaza votul unui user la un sondaj din chat-ul general. Userul
     * isi poate schimba optiunea (ON DUPLICATE KEY UPDATE) - nu exista un
     * "vot definitiv", nefiind cerut.
     *
     * @return array ['ok'=>bool, 'reason'=>string|null]
     */
    function voteGlobalChatPoll($uid, $pollId, $optionIndex) {
        $uid = (int) $uid;
        $pollId = (int) $pollId;
        $optionIndex = (int) $optionIndex;

        if ($uid <= 0 || $pollId <= 0 || $optionIndex < 0) {
            return ['ok' => false, 'reason' => 'invalid'];
        }

        $poll = mysqli_fetch_assoc($this->query(
            "SELECT chat_id, options FROM " . TB_PREFIX . "chat_global_polls WHERE id = $pollId"
        ));

        if (!$poll) {
            return ['ok' => false, 'reason' => 'notfound'];
        }

        $options = json_decode($poll['options'], true);
        if (!is_array($options) || !isset($options[$optionIndex])) {
            return ['ok' => false, 'reason' => 'invalid'];
        }

        $now = time();
        $this->query(
            "INSERT INTO " . TB_PREFIX . "chat_global_poll_votes (poll_id, id_user, option_index, voted_at)
             VALUES ($pollId, $uid, $optionIndex, $now)
             ON DUPLICATE KEY UPDATE option_index = $optionIndex, voted_at = $now"
        );

        // atinge randul-ancora din chat_global ca votul sa fie prins de
        // getGlobalChatUpdates() (watermark-ul de editari/stergeri) - altfel
        // doar userul care a votat ar vedea rezultatul actualizat, ceilalti
        // clienti cu sondajul deja afisat ar ramane cu numaratoarea veche
        $chatId = (int) $poll['chat_id'];
        $this->query(
            "UPDATE " . TB_PREFIX . "chat_global SET updated_at = $now WHERE id = $chatId"
        );

        return ['ok' => true];
    }

    /**
     * Rezultatele unui sondaj + optiunea aleasa de $viewerUid (daca a votat).
     * Apelata per-rand din getGlobalChatMessages() pentru mesajele de tip
     * 'poll' - sondajele sunt rare fata de mesajele normale, deci interogarile
     * suplimentare (N+1) sunt neglijabile aici.
     */
    function getGlobalChatPollData($pollId, $viewerUid) {
        $pollId = (int) $pollId;
        $viewerUid = (int) $viewerUid;

        $poll = mysqli_fetch_assoc($this->query(
            "SELECT id, question, options FROM " . TB_PREFIX . "chat_global_polls WHERE id = $pollId"
        ));

        if (!$poll) {
            return null;
        }

        $options = json_decode($poll['options'], true);
        if (!is_array($options)) {
            $options = [];
        }

        $counts = array_fill(0, count($options), 0);
        $voteRows = $this->mysqli_fetch_all($this->query(
            "SELECT option_index, COUNT(*) AS c FROM " . TB_PREFIX . "chat_global_poll_votes
             WHERE poll_id = $pollId GROUP BY option_index"
        ));

        $total = 0;
        foreach ($voteRows as $vr) {
            $idx = (int) $vr['option_index'];
            if (isset($counts[$idx])) {
                $counts[$idx] = (int) $vr['c'];
            }
            $total += (int) $vr['c'];
        }

        $myVote = null;
        if ($viewerUid > 0) {
            $mv = mysqli_fetch_assoc($this->query(
                "SELECT option_index FROM " . TB_PREFIX . "chat_global_poll_votes
                 WHERE poll_id = $pollId AND id_user = $viewerUid"
            ));
            if ($mv) {
                $myVote = (int) $mv['option_index'];
            }
        }

        return [
            'id' => (int) $poll['id'],
            'question' => $poll['question'],
            'options' => $options,
            'counts' => $counts,
            'total' => $total,
            'myVote' => $myVote,
        ];
    }

    /**
     * Timestamp-ul (unix) pana la care userul e mutat din chat-ul general,
     * sau null daca nu e mutat (inclusiv daca o mutare veche a expirat).
     */
    function getGlobalChatMuteStatus($uid) {
        $uid = (int) $uid;

        $row = mysqli_fetch_assoc($this->query(
            "SELECT muted_until FROM " . TB_PREFIX . "chat_mutes WHERE id_user = $uid"
        ));

        if (!$row) {
            return null;
        }

        $until = (int) $row['muted_until'];
        return $until > time() ? $until : null;
    }

    /**
     * Info despre viewer-ul curent, folosita de client ca sa stie daca
     * afiseaza controalele de moderare si daca dezactiveaza inputul (mutat).
     */
    function getGlobalChatViewerInfo($uid) {
        $uid = (int) $uid;

        $access = (int) $this->getUserField($uid, 'access', 0);

        return [
            'uid' => $uid,
            'access' => $access,
            'isMod' => $access >= MULTIHUNTER,
            'mutedUntil' => $this->getGlobalChatMuteStatus($uid),
        ];
    }

    /**
     * Muteaza (temporar sau permanent, dupa $untilTimestamp) un user din
     * chat-ul general. Ierarhia de rang (cine pe cine poate muta) se
     * verifica in ajax.php inainte de a apela asta - metoda doar scrie
     * starea, ca sa ramana usor de testat separat.
     */
    function muteGlobalChatUser($targetUid, $mutedBy, $untilTimestamp, $reason = '') {
        $targetUid = (int) $targetUid;
        $mutedBy = (int) $mutedBy;
        $untilTimestamp = (int) $untilTimestamp;

        list($ereason) = $this->escape_input((string) $reason);
        $now = time();

        $q = "INSERT INTO " . TB_PREFIX . "chat_mutes (id_user, muted_until, muted_by, reason, created)
              VALUES ($targetUid, $untilTimestamp, $mutedBy, '$ereason', $now)
              ON DUPLICATE KEY UPDATE muted_until = $untilTimestamp, muted_by = $mutedBy, reason = '$ereason', created = $now";

        return $this->query($q) ? true : false;
    }

    function unmuteGlobalChatUser($targetUid) {
        $targetUid = (int) $targetUid;

        return $this->query(
            "DELETE FROM " . TB_PREFIX . "chat_mutes WHERE id_user = $targetUid"
        ) ? true : false;
    }
}
