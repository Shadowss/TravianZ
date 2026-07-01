<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : Message.php                      	                       ##
##  Type           : Message System Backend                                    ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki           			                               ##
##  Refactored by  : Shadow & Ferywir									       ##
##  Thanks to      : ronix, InCube, Akakori, Elmar & Kirilloid                 ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  URLs:          : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

class Message
{
    public $unread, $nunread = false;
    public $note;

    public $inbox = [];
    public $inbox1 = [];
    public $sent = [];
    public $sent1 = [];
    public $reading = [];
    public $reply = [];
    public $archived = [];
    public $archived1 = [];
    public $noticearray = [];
    public $readingNotice = [];

    private $totalMessage;

    public function __construct()
    {
        $req_file = basename($_SERVER['PHP_SELF']);

        $this->unread  = $this->checkUnread();
        $this->nunread = $this->checkNUnread();

        if ($req_file == 'nachrichten.php') {
            if (isset($_GET['t'])) {
                switch ($_GET['t']) {

                    // Sent messages page / single sent message
                    case 2:
                    case '2a':
                        $this->getMessages(2);
                        break;

                    // Archived messages page
                    case 3:
                        $this->getMessages(3);
                        break;
                }
            } else {
                // Inbox / received messages page
                $this->getMessages(1);
            }
        }
        if ($req_file == 'berichte.php') {
            $this->getNotice();
        }
        if (isset($_SESSION['reply'])) {
            $this->reply = $_SESSION['reply'];
            unset($_SESSION['reply']);
        }
    }

    public function procMessage($post)
    {
        if (!isset($post['ft'])) {
            return;
        }
        switch ($post['ft']) {
            case "m1":
                $this->quoteMessage($post['id']);
                break;
            case "m2":
                if ($post['an'] == "[ally]") {
                    $this->sendAMessage(
                        $post['be'],
                        addslashes($post['message'])
                    );
                } else {
                    $this->sendMessage(
                        $post['an'],
                        $post['be'],
                        addslashes($post['message'])
                    );
                }
                header("Location: nachrichten.php?t=2");
                exit;
            case "m3":
            case "m4":
            case "m5":
                if (isset($post['delmsg'])) {
                    $this->removeMessage($post);
                }
                if (isset($post['archive'])) {
                    $this->archiveMessage($post);
                }
                if (isset($post['start'])) {
                    $this->unarchiveMessage($post);
                }
                break;
            case "m6":
                $this->createNote($post);
                break;
            case "m7":
                $this->addFriends($post);
                break;
        }
    }

    public function noticeType($get)
    {
        global $session, $database;
        if (isset($get['t'])) {
            switch ($get['t']) {
                case 1:
                    $type = [8, 15, 16, 17];
                    break;
                case 2:
                    $type = [10, 11, 12, 13];
                    break;
                case 3:
                    $type = [1, 2, 3, 4, 5, 6, 7];
                    break;
                case 4:
                    $type = [0, 18, 19, 20, 21, 24, 25];
                    break;
                case 5:
                    if (!$session->plus) {
                        header("Location: berichte.php");
                        exit;
                    }
                    $type = 9;
                    break;
                default:
                    $type = [];
                    break;
            }
            if (!is_array($type)) {
                $type = [$type];
            }
            $this->noticearray = $this->filter_by_value(
                $database->getNotice($session->uid),
                "ntype",
                $type
            );
        }
        if (isset($get['id'])) {
            $this->readingNotice = $this->getReadNotice($get['id']);
        }
    }

    public function procNotice($post)
    {
        if (isset($post["del_x"])) {
            $this->removeNotice($post);
        }
        if (isset($post['archive_x'])) {
            $this->archiveNotice($post);
        }
        if (isset($post['start_x'])) {
            $this->unarchiveNotice($post);
        }
    }

    public function quoteMessage($id)
    {
        foreach ($this->inbox as $message) {
            if ($message['id'] == $id) {
                $message = preg_replace('/\[message\]/', '', $message);
                $message = preg_replace('/\[\/message\]/', '', $message);
                for ($i = 1; $i <= $message['alliance']; $i++) {
                    $message = preg_replace('/\[alliance' . $i . '\]/', '[alliance0]', $message);
                    $message = preg_replace('/\[\/alliance' . $i . '\]/', '[/alliance0]', $message);
                }
                for ($i = 0; $i <= $message['player']; $i++) {
                    $message = preg_replace('/\[player' . $i . '\]/', '[player0]', $message);
                    $message = preg_replace('/\[\/player' . $i . '\]/', '[/player0]', $message);
                }
                for ($i = 0; $i <= $message['coor']; $i++) {
                    $message = preg_replace('/\[coor' . $i . '\]/', '[coor0]', $message);
                    $message = preg_replace('/\[\/coor' . $i . '\]/', '[/coor0]', $message);
                }
                for ($i = 0; $i <= $message['report']; $i++) {
                    $message = preg_replace('/\[report' . $i . '\]/', '[report0]', $message);
                    $message = preg_replace('/\[\/report' . $i . '\]/', '[/report0]', $message);
                }
                $this->reply = $_SESSION['reply'] = $message;
                header(
                    "Location: nachrichten.php?t=1&id=" .
                    $message['owner'] .
                    "&mid=" .
                    $message['id'] .
                    "&tid=" .
                    $message['target']
                );
                exit;
            }
        }
    }

    public function loadMessage($id)
    {
        global $database, $session;
        if ($this->findInbox($id)) {
            foreach ($this->inbox as $message) {
                if ($message['id'] == $id) {
                    $this->reading = $message;
                    break;
                }
            }
        }
        if ($this->findSent($id)) {
            foreach ($this->sent as $message) {
                if ($message['id'] == $id) {
                    $this->reading = $message;
                    break;
                }
            }
        }

        if ($session->plus && $this->findArchive($id)) {
            foreach ($this->archived as $message) {
                if ($message['id'] == $id) {
                    $this->reading = $message;
                    break;
                }
            }
        }
        if (!empty($this->reading) && $this->reading['viewed'] == 0) {
            $database->getMessage($id, 4);
        }
    }

    /**
     * Filter array by value except specific value.
     */
    private function filter_by_value_except($array, $index, $value)
    {
        $newarray = [];
        if (is_array($array) && count($array) > 0) {
            foreach ($array as $row) {
                if (isset($row[$index]) && $row[$index] != $value) {
                    $newarray[] = $row;
                }
            }
        }

        return $newarray;
    }

    /**
     * Filter array by accepted values.
     */
    private function filter_by_value($array, $index, $value)
    {
        $newarray = [];
        if (is_array($array) && count($array) > 0) {
            foreach ($array as $row) {
                if (
                    isset($row[$index]) &&
                    in_array($row[$index], $value)
                ) {
                    $newarray[] = $row;
                }
            }
        }
        return $newarray;
    }

    private function getNotice()
    {
        global $database, $session;
        $this->noticearray = $this->filter_by_value_except(
            $database->getNotice($session->uid),
            "ntype",
            9
        );
    }

    /**
     * Build selected IDs array from POST.
     */
    private function collectSelectedIds($post, $limit = 10)
    {
        $ids = [];
        for ($i = 1; $i <= $limit; $i++) {
            if (isset($post['n' . $i])) {
                $ids[] = (int)$post['n' . $i];
            }
        }
        return $ids;
    }

    private function removeMessage($post)
    {
        global $database, $session;
        $post = $database->escape($post);
        $mode5updates = [];
        $mode7updates = [];
        $mode8updates = [];
        for ($i = 1; $i <= 10; $i++) {
            if (!isset($post['n' . $i])) {
                continue;
            }
            $messageId = (int)$post['n' . $i];
            $query = mysqli_query(
                $database->dblink,
                "SELECT target, owner
                 FROM " . TB_PREFIX . "mdata
                 WHERE id = " . $messageId . "
                 LIMIT 1"
            );
            $message = mysqli_fetch_array($query);
            if (
                $message['target'] == $session->uid &&
                $message['owner'] == $session->uid
            ) {
                $mode8updates[] = $messageId;
            } elseif ($message['target'] == $session->uid) {
                $mode5updates[] = $messageId;
            } elseif ($message['owner'] == $session->uid) {
                $mode7updates[] = $messageId;
            }
        }
        if (!empty($mode5updates)) {
            $database->getMessage($mode5updates, 5);
        }
        if (!empty($mode7updates)) {
            $database->getMessage($mode7updates, 7);
        }
        if (!empty($mode8updates)) {
            $database->getMessage($mode8updates, 8);
        }
        header("Location: nachrichten.php");
        exit;
    }

    private function archiveMessage($post)
    {
        global $database;
        $archIDs = $this->collectSelectedIds($post);
        $database->setArchived($archIDs);
        header("Location: nachrichten.php");
        exit;
    }

    private function unarchiveMessage($post)
    {
        global $database;
        $normIDs = $this->collectSelectedIds($post);
        $database->setNorm($normIDs);
        header("Location: nachrichten.php");
        exit;
    }

    private function removeNotice($post)
    {
        global $database;
        $removeIDs = $this->collectSelectedIds($post);
        $database->removeNotice($removeIDs);
        header("Location: berichte.php");
        exit;
    }

    private function archiveNotice($post)
    {
        global $database;
        $archiveIDs = $this->collectSelectedIds($post);
        $database->archiveNotice($archiveIDs);
        header("Location: berichte.php");
        exit;
    }

    private function unarchiveNotice($post)
    {
        global $database;
        $unarchIDs = $this->collectSelectedIds($post);
        $database->unarchiveNotice($unarchIDs);
        header("Location: berichte.php");
        exit;
    }

    private function getReadNotice($id)
    {
        global $database, $session;
        $notice = $database->getNotice2($id);
        if (
            $notice['uid'] == $session->uid ||
            $notice['ally'] == $session->alliance
        ) {
            if ($notice['uid'] == $session->uid) {
                $database->noticeViewed($notice['id']);
            }
            return $notice;
        }
        return null;
    }

    /**
     * Not all notices have a corresponding .tpl file.
     * This method maps them to existing report templates.
     */
    public function getReportType($type)
    {
        switch ($type) {

            // General attacking reports
            case 2:
            case 4:
            case 5:
            case 6:
            case 7:
            case 18:
            case 20:
            case 21:
                return 1;

            // Merchant reports
            case 11:
            case 12:
            case 13:
            case 14:
                return 10;

            // Reinforcements attacked
            case 16:
            case 17:
                return 15;

            // No troops returned
            case 19:
                return 3;

            // Festive reports
            case 23:
                return 22;

            // Settler reports: new village founded / valley occupied (issue #178)
            case 24:
            case 25:
                return 24;
        }
        return $type;
    }

    public function loadNotes()
    {
        global $session;
        $noteFile = "GameEngine/Notes/" . md5($session->username) . ".txt";
        if (file_exists($noteFile)) {
            $this->note = file_get_contents($noteFile);
        } else {
            $this->note = "";
        }
    }

    private function createNote($post)
    {
        global $session;
        if (!$session->plus) {
            return;
        }
        $noteFile = "GameEngine/Notes/" . md5($session->username) . ".txt";
        $ourFileHandle = fopen($noteFile, 'w');
        fwrite($ourFileHandle, $post['notizen']);
        fclose($ourFileHandle);
    }

    private function getMessages($which)
    {
        global $database, $session;
        switch ($which) {
            case 1:
                $this->inbox  = $database->getMessage($session->uid, 1);
                $this->inbox1 = $database->getMessage($session->uid, 9);
                break;
            case 2:
                $this->sent  = $database->getMessage($session->uid, 2);
                $this->sent1 = $database->getMessage($session->uid, 10);
                break;
            case 3:
                if ($session->plus) {
                    $this->archived  = $database->getMessage($session->uid, 6);
                    $this->archived1 = $database->getMessage($session->uid, 11);
                }
                break;
        }
    }

    /**
     * Normalize nested BBCode counters.
     */
    private function normalizeMessageTags(&$text, &$alliance, &$player, &$coor, &$report)
    {
        for ($i = 0; $i <= $alliance; $i++) {
            if (
                preg_match('/\[alliance' . $i . '\]/', $text) &&
                preg_match('/\[\/alliance' . $i . '\]/', $text)
            ) {
                $alliance1 = preg_replace('/\[message\](.*?)\[\/alliance' . $i . '\]/is', '', $text);
                if (
                    preg_match('/\[alliance' . $i . '\]/', $alliance1) &&
                    preg_match('/\[\/alliance' . $i . '\]/', $alliance1)
                ) {
                    $j = $i + 1;
                    $alliance2 = preg_replace('/\[\/alliance' . $i . '\](.*?)\[\/message\]/is', '', $text);
                    $alliance1 = preg_replace('/\[alliance' . $i . '\]/', '[alliance' . $j . ']', $alliance1);
                    $alliance1 = preg_replace('/\[\/alliance' . $i . '\]/', '[/alliance' . $j . ']', $alliance1);
                    $text = $alliance2 . "[/alliance" . $i . "]" . $alliance1;
                    $alliance++;
                }
            }
        }
        for ($i = 0; $i <= $player; $i++) {
            if (
                preg_match('/\[player' . $i . '\]/', $text) &&
                preg_match('/\[\/player' . $i . '\]/', $text)
            ) {
                $player1 = preg_replace('/\[message\](.*?)\[\/player' . $i . '\]/is', '', $text);
                if (
                    preg_match('/\[player' . $i . '\]/', $player1) &&
                    preg_match('/\[\/player' . $i . '\]/', $player1)
                ) {
                    $j = $i + 1;
                    $player2 = preg_replace('/\[\/player' . $i . '\](.*?)\[\/message\]/is', '', $text);
                    $player1 = preg_replace('/\[player' . $i . '\]/', '[player' . $j . ']', $player1);
                    $player1 = preg_replace('/\[\/player' . $i . '\]/', '[/player' . $j . ']', $player1);
                    $text = $player2 . "[/player" . $i . "]" . $player1;
                    $player++;
                }
            }
        }
        for ($i = 0; $i <= $coor; $i++) {
            if (
                preg_match('/\[coor' . $i . '\]/', $text) &&
                preg_match('/\[\/coor' . $i . '\]/', $text)
            ) {
                $coor1 = preg_replace('/\[message\](.*?)\[\/coor' . $i . '\]/is', '', $text);
                if (
                    preg_match('/\[coor' . $i . '\]/', $coor1) &&
                    preg_match('/\[\/coor' . $i . '\]/', $coor1)
                ) {
                    $j = $i + 1;
                    $coor2 = preg_replace('/\[\/coor' . $i . '\](.*?)\[\/message\]/is', '', $text);
                    $coor1 = preg_replace('/\[coor' . $i . '\]/', '[coor' . $j . ']', $coor1);
                    $coor1 = preg_replace('/\[\/coor' . $i . '\]/', '[/coor' . $j . ']', $coor1);
                    $text = $coor2 . "[/coor" . $i . "]" . $coor1;
                    $coor++;
                }
            }
        }
        for ($i = 0; $i <= $report; $i++) {
            if (
                preg_match('/\[report' . $i . '\]/', $text) &&
                preg_match('/\[\/report' . $i . '\]/', $text)
            ) {
                $report1 = preg_replace('/\[message\](.*?)\[\/report' . $i . '\]/is', '', $text);
                if (
                    preg_match('/\[report' . $i . '\]/', $report1) &&
                    preg_match('/\[\/report' . $i . '\]/', $report1)
                ) {
                    $j = $i + 1;
                    $report2 = preg_replace('/\[\/report' . $i . '\](.*?)\[\/message\]/is', '', $text);
                    $report1 = preg_replace('/\[report' . $i . '\]/', '[report' . $j . ']', $report1);
                    $report1 = preg_replace('/\[\/report' . $i . '\]/', '[/report' . $j . ']', $report1);
                    $text = $report2 . "[/report" . $i . "]" . $report1;
                    $report++;
                }
            }
        }
    }

    private function sendAMessage($topic, $text)
    {
        global $session, $database;

        // Flood protection
        $q = "
            SELECT COUNT(*) AS Total
            FROM " . TB_PREFIX . "mdata
            WHERE owner='" . $session->uid . "'
            AND time > " . (time() - 60);
        $res = mysqli_fetch_array(
            mysqli_query($database->dblink, $q),
            MYSQLI_ASSOC
        );
        if ($res['Total'] > 5) {
            return;
        }
        $allmembersQ = mysqli_query(
            $database->dblink,
            "SELECT id
             FROM " . TB_PREFIX . "users
             WHERE alliance='" . $session->alliance . "'"
        );
        $userally = $database->getUserField($session->uid, "alliance", 0);
        $permission = mysqli_fetch_array(
            mysqli_query(
                $database->dblink,
                "SELECT opt7
                 FROM " . TB_PREFIX . "ali_permission
                 WHERE uid='" . $session->uid . "'"
            )
        );
        if (defined('WORD_CENSOR')) {
            $topic = $this->wordCensor($topic);
            $text  = $this->wordCensor($text);
        }
        if ($topic == "") {
            $topic = "No subject";
        }
        if (
            !preg_match('/\[message\]/', $text) &&
            !preg_match('/\[\/message\]/', $text)
        ) {
            $text = "[message]" . $text . "[/message]";
            $alliance = 0;
            $player   = 0;
            $coor     = 0;
            $report   = 0;
            $this->normalizeMessageTags(
                $text,
                $alliance,
                $player,
                $coor,
                $report
            );
            if ($permission['opt7'] == 1) {
                if ($userally > 0) {
                    while ($allmembers = mysqli_fetch_array($allmembersQ)) {
                        $database->sendMessage(
                            $allmembers['id'],
                            $session->uid,
                            htmlspecialchars(addslashes($topic)),
                            htmlspecialchars(addslashes($text)),
                            0,
                            $alliance,
                            $player,
                            $coor,
                            $report
                        );
                    }
                }
            }
        }
    }

    private function sendMessage($recieve, $topic, $text, $security_check = true)
    {
        global $session, $database;
        $user = $database->getUserField($recieve, "id", 1);

        // Flood protection
        if ($security_check) {
            $q = "
                SELECT COUNT(*) AS Total
                FROM " . TB_PREFIX . "mdata
                WHERE owner='" . $session->uid . "'
                AND time > " . (time() - 60);

            $res = mysqli_fetch_array(
                mysqli_query($database->dblink, $q),
                MYSQLI_ASSOC
            );
            if ($res['Total'] > 5) {
                return;
            }
        }
        if (defined('WORD_CENSOR')) {
            $topic = $this->wordCensor($topic);
            $text  = $this->wordCensor($text);
        }
        if (empty($topic)) {
            $topic = "No subject";
        }
        if (
            !preg_match('/\[message\]/', $text) &&
            !preg_match('/\[\/message\]/', $text)
        ) {
            $text = "[message]" . $text . "[/message]";
            $alliance = 0;
            $player   = 0;
            $coor     = 0;
            $report   = 0;
            $this->normalizeMessageTags(
                $text,
                $alliance,
                $player,
                $coor,
                $report
            );

            // Default sender
            $send_as = $session->uid;

            // Support messages
            $support_from_admin_allowed =
                ($session->access == ADMIN && ADMIN_RECEIVE_SUPPORT_MESSAGES);
            if (
                !empty($_POST['as_support']) &&
                $support_from_admin_allowed
            ) {
                $send_as = 1;
            }
			
            // Multihunter messages
            if (
                !empty($_POST['as_multihunter']) &&
                $session->access == MULTIHUNTER
            ) {
                $send_as = 5;
            }
            $database->sendMessage(
                $user,
                $send_as,
                htmlspecialchars(addslashes($topic)),
                htmlspecialchars(addslashes($text)),
                0,
                $alliance,
                $player,
                $coor,
                $report
            );
        }
    }

    public function sendWelcome($uid, $username)
    {
        global $database;
        $welcomemsg = file_get_contents("GameEngine/Admin/welcome.tpl");
        $welcomemsg = "[message]" . preg_replace(
            [
                "'%USER%'",
                "'%START%'",
                "'%TIME%'",
                "'%PLAYERS%'",
                "'%ALLI%'",
                "'%SERVER_NAME%'",
                "'%PROTECTION%'"
            ],
            [
                $username,
                date("y.m.d", COMMENCE),
                date("H:i", COMMENCE),
                $database->countUser(),
                $database->countAlli(),
                SERVER_NAME,
                round((PROTECTION / 3600))
            ],
            $welcomemsg
        ) . "[/message]";
        return $database->sendMessage(
            $uid,
            1,
            WEL_TOPIC,
            addslashes($welcomemsg),
            0,
            0,
            0,
            0,
            0
        );
    }

    private function wordCensor($text)
    {
        $censorarray = explode(",", CENSORED);
        foreach ($censorarray as $key => $value) {
            $censorarray[$key] = "/" . $value . "/i";
        }
        return preg_replace($censorarray, "****", $text);
    }

    private function checkUnread()
    {
        global $database, $session;
        return $database->getUnreadMessagesCount($session->uid);
    }

    private function checkNUnread()
    {
        global $database, $session;
        return $database->getUnreadNoticesCount($session->uid);
    }

    private function findInbox($id)
    {
        if (!empty($this->inbox)) {
            foreach ($this->inbox as $message) {
                if ($message['id'] == $id) {
                    return true;
                }
            }
        }
        return false;
    }

    private function findSent($id)
    {
        if (!empty($this->sent)) {
            foreach ($this->sent as $message) {
                if ($message['id'] == $id) {
                    return true;
                }
            }
        }
        return false;
    }

    private function findArchive($id)
    {
        if (!empty($this->archived)) {
            foreach ($this->archived as $message) {
                if ($message['id'] == $id) {
                    return true;
                }
            }
        }
        return false;
    }

    public function addFriends($post)
    {
        global $database;
        for ($i = 0; $i <= 19; $i++) {
            if (empty($post['addfriends' . $i])) {
                continue;
            }
            $uid = $database->getUserField(
                $post['addfriends' . $i],
                "id",
                1
            );
            $added = 0;
            for ($j = 0; $j <= $i; $j++) {

                if ($added != 0) {
                    continue;
                }
                $user = $database->getUserField(
                    $post['myid'],
                    "friend" . $j,
                    0
                );
                $userwait = $database->getUserField(
                    $post['myid'],
                    "friend" . $j . "wait",
                    0
                );
                $exist = 0;
                for ($k = 0; $k <= 19; $k++) {

                    $user1 = $database->getUserField(
                        $post['myid'],
                        "friend" . $k,
                        0
                    );
                    if ($user1 == $uid || $uid == $post['myid']) {
                        $exist = 1;
                    }
                }
                if (
                    $user == 0 &&
                    $userwait == 0 &&
                    $exist == 0
                ) {
                    $added1 = 0;
                    for ($l = 0; $l <= 19; $l++) {
                        $user2 = $database->getUserField(
                            $uid,
                            "friend" . $l,
                            0
                        );
                        $userwait2 = $database->getUserField(
                            $uid,
                            "friend" . $l . "wait",
                            0
                        );
                        if (
                            $user2 == 0 &&
                            $userwait2 == 0 &&
                            $added1 == 0
                        ) {
                            $database->addFriend(
                                $uid,
                                "friend" . $l . "wait",
                                $post['myid']
                            );
                            $added1 = 1;
                        }
                    }
                    $database->addFriend(
                        $post['myid'],
                        "friend" . $j,
                        $uid
                    );
                    $database->addFriend(
                        $post['myid'],
                        "friend" . $j . "wait",
                        $uid
                    );
                    $added = 1;
                }
            }
        }
        header("Location: nachrichten.php?t=1");
        exit();
    }
};