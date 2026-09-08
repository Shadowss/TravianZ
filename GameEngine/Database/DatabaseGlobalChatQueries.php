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
    function getGlobalChatMessages($limit = 30, $sinceId = 0) {
        $limit = (int) $limit;
        $sinceId = (int) $sinceId;

        $where = $sinceId > 0 ? "WHERE c.id > $sinceId" : "";
        $order = $sinceId > 0 ? "ORDER BY c.id ASC" : "ORDER BY c.id DESC";
        // plafon si pe polling-ul incremental (nu doar la incarcarea initiala) -
        // daca un tab a stat minimizat/in background ore intregi (throttling de
        // browser pe mobil), la revenire nu vrem un SELECT nemarginit
        $limitSql = "LIMIT " . ($sinceId > 0 ? 200 : $limit);

        $q = "SELECT c.id, c.id_user, c.date, c.msg, u.username, u.access, a.tag AS ally_tag, a.id AS ally_id
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

        return $rows;
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
