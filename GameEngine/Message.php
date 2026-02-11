<?php

/** --------------------------------------------------- **\
| ********* DO NOT REMOVE THIS COPYRIGHT NOTICE ********* |
+---------------------------------------------------------+
| Credits:     All the developers including the leaders:  |
|              Advocaite & Dzoki & Donnchadh              |
| Refactored by : Shadow								  |
|                                                         |
| Copyright:   TravianZ Project All rights reserved       |
\** --------------------------------------------------- **/

class Message {

    public $unread;
    public $nunread = false;
    public $note;

    public $inbox = array();
    public $inbox1 = array();
    public $sent = array();
    public $sent1 = array();
    public $archived = array();
    public $archived1 = array();

    public $reading = array();
    public $reply = '';
    public $noticearray = array();
    public $readingNotice = array();

    private $totalMessage = 0;

    /* ===================================================== */
    /* ================= CONSTRUCTOR ======================= */
    /* ===================================================== */

    function __construct() {

        global $session;

        $req_file = basename($_SERVER['PHP_SELF']);

        $this->unread  = $this->checkUnread();
        $this->nunread = $this->checkNUnread();

        if($req_file == 'nachrichten.php') {

            $t = isset($_GET['t']) ? trim($_GET['t']) : 1;

            switch($t) {

                case 2:
                case '2a':
                    $this->getMessages(2);
                break;

                case 3:
                    $this->getMessages(3);
                break;

                default:
                    $this->getMessages(1);
                break;
            }
        }

        if($req_file == 'berichte.php') {
            $this->getNotice();
        }

        if(isset($_SESSION['reply'])) {
            $this->reply = $_SESSION['reply'];
            unset($_SESSION['reply']);
        }
    }

    /* ===================================================== */
    /* ================= SAFE HELPERS ====================== */
    /* ===================================================== */

    private function sanitizeText($text) {
        return htmlspecialchars(trim($text), ENT_QUOTES, 'UTF-8');
    }

    private function sanitizeInt($value) {
        return (int)$value;
    }

    private function preventFlood($uid) {
        global $database;

        $uid = (int)$uid;
        $limitTime = time() - 60;

        $query = "SELECT COUNT(*) as total 
                  FROM ".TB_PREFIX."mdata 
                  WHERE owner = {$uid} 
                  AND time > {$limitTime}";

        $result = mysqli_fetch_assoc(mysqli_query($database->dblink, $query));

        if($result && $result['total'] > 5) {
            return false;
        }

        return true;
    }

    private function safeRedirect($url) {
        header("Location: ".$url);
        exit;
    }

    /* ===================================================== */
    /* ================= UNREAD ============================ */
    /* ===================================================== */

    private function checkUnread() {
        global $database, $session;
        return (int)$database->getUnreadMessagesCount($session->uid);
    }

    private function checkNUnread() {
        global $database, $session;
        return (int)$database->getUnreadNoticesCount($session->uid);
    }

    /* ===================================================== */
    /* ================= NOTICE SYSTEM ===================== */
    /* ===================================================== */

    public function noticeType($get) {

        global $session, $database;

        if(isset($get['t'])) {

            $type = null;
            $t = (int)$get['t'];

            if($t == 1) $type = array(8,15,16,17);
            if($t == 2) $type = array(10,11,12,13);
            if($t == 3) $type = array(1,2,3,4,5,6,7);
            if($t == 4) $type = array(0,18,19,20,21);

            if($t == 5) {
                if(!$session->plus) {
                    $this->safeRedirect("berichte.php");
                }
                $type = array(9);
            }

            if($type !== null) {
                $all = $database->getNotice($session->uid);
                $this->noticearray = $this->filter_by_value($all, "ntype", $type);
            }
        }

        if(isset($get['id'])) {
            $this->readingNotice = $this->getReadNotice((int)$get['id']);
        }
    }

    public function procNotice($post) {

        if(isset($post["del_x"]))      $this->removeNotice($post);
        if(isset($post['archive_x']))  $this->archiveNotice($post);
        if(isset($post['start_x']))    $this->unarchiveNotice($post);
    }

    private function getNotice() {

        global $database, $session;

        $all = $database->getNotice($session->uid);
        $this->noticearray = $this->filter_by_value_except($all, "ntype", 9);
    }

    private function getReadNotice($id) {

        global $database, $session;

        $id = (int)$id;
        if($id <= 0) return null;

        $notice = $database->getNotice2($id);

        if(!$notice) return null;

        if($notice['uid'] == $session->uid || $notice['ally'] == $session->alliance) {

            if($notice['uid'] == $session->uid) {
                $database->noticeViewed($notice['id']);
            }

            return $notice;
        }

        return null;
    }

    /* ===================================================== */
    /* ================= FILTER HELPERS ==================== */
    /* ===================================================== */

    private function filter_by_value_except($array, $index, $value) {

        $newarray = array();

        if(is_array($array)) {
            foreach($array as $row) {
                if(isset($row[$index]) && $row[$index] != $value) {
                    $newarray[] = $row;
                }
            }
        }

        return $newarray;
    }

    private function filter_by_value($array, $index, $values) {

        $newarray = array();

        if(!is_array($values)) {
            $values = array($values);
        }

        if(is_array($array)) {
            foreach($array as $row) {
                if(isset($row[$index]) && in_array($row[$index], $values)) {
                    $newarray[] = $row;
                }
            }
        }

        return $newarray;
    }

    /* ===================================================== */
    /* ================= MESSAGE LOADING =================== */
    /* ===================================================== */

    public function loadMessage($id) {

        global $database, $session;

        $id = (int)$id;
        if($id <= 0) return;

        if($this->findInbox($id)) {
            foreach($this->inbox as $message) {
                if($message['id'] == $id) {
                    $this->reading = $message;
                    break;
                }
            }
        }

        if($this->findSent($id)) {
            foreach($this->sent as $message) {
                if($message['id'] == $id) {
                    $this->reading = $message;
                    break;
                }
            }
        }

        if($session->plus && $this->findArchive($id)) {
            foreach($this->archived as $message) {
                if($message['id'] == $id) {
                    $this->reading = $message;
                    break;
                }
            }
        }

        if(!empty($this->reading) && $this->reading['viewed'] == 0) {
            $database->getMessage($id, 4);
        }
    }

    /* ===================================================== */
    /* ================= REPORT TYPE ======================= */
    /* ===================================================== */

    public function getReportType($type) {

        $type = (int)$type;

        switch($type) {

            case 2:
            case 4:
            case 5:
            case 6:
            case 7:
            case 18:
            case 20:
            case 21:
                return 1;

            case 11:
            case 12:
            case 13:
            case 14:
                return 10;

            case 16:
            case 17:
                return 15;

            case 19:
                return 3;

            case 23:
                return 22;
        }

        return $type;
    }

    /* ===================================================== */
    /* ================= NOTES ============================= */
    /* ===================================================== */

    public function loadNotes() {

        global $session;

        $file = "GameEngine/Notes/".md5($session->username).".txt";

        if(file_exists($file)) {
            $this->note = file_get_contents($file);
        } else {
            $this->note = "";
        }
    }
	
    /* ===================================================== */
    /* ================= DELETE MESSAGES =================== */
    /* ===================================================== */

    private function removeMessage($post) {

        global $database, $session;

        $mode5 = array();
        $mode7 = array();
        $mode8 = array();

        for($i = 1; $i <= 10; $i++) {

            if(isset($post['n'.$i])) {

                $id = (int)$post['n'.$i];
                if($id <= 0) continue;

                $query = "SELECT target, owner 
                          FROM ".TB_PREFIX."mdata 
                          WHERE id = {$id} LIMIT 1";

                $res = mysqli_fetch_assoc(mysqli_query($database->dblink, $query));
                if(!$res) continue;

                $target = (int)$res['target'];
                $owner  = (int)$res['owner'];

                if($target == $session->uid && $owner == $session->uid) {
                    $mode8[] = $id;
                }
                elseif($target == $session->uid) {
                    $mode5[] = $id;
                }
                elseif($owner == $session->uid) {
                    $mode7[] = $id;
                }
            }
        }

        if(!empty($mode5)) $database->getMessage($mode5, 5);
        if(!empty($mode7)) $database->getMessage($mode7, 7);
        if(!empty($mode8)) $database->getMessage($mode8, 8);

        $this->safeRedirect("nachrichten.php");
    }

    /* ===================================================== */
    /* ================= ARCHIVE MESSAGES ================== */
    /* ===================================================== */

    private function archiveMessage($post) {

        global $database;

        $ids = array();

        for($i = 1; $i <= 10; $i++) {
            if(isset($post['n'.$i])) {
                $id = (int)$post['n'.$i];
                if($id > 0) $ids[] = $id;
            }
        }

        if(!empty($ids)) {
            $database->setArchived($ids);
        }

        $this->safeRedirect("nachrichten.php");
    }

    private function unarchiveMessage($post) {

        global $database;

        $ids = array();

        for($i = 1; $i <= 10; $i++) {
            if(isset($post['n'.$i])) {
                $id = (int)$post['n'.$i];
                if($id > 0) $ids[] = $id;
            }
        }

        if(!empty($ids)) {
            $database->setNorm($ids);
        }

        $this->safeRedirect("nachrichten.php");
    }

    /* ===================================================== */
    /* ================= DELETE NOTICES ==================== */
    /* ===================================================== */

    private function removeNotice($post) {

        global $database;

        $ids = array();

        for($i = 1; $i <= 10; $i++) {
            if(isset($post['n'.$i])) {
                $id = (int)$post['n'.$i];
                if($id > 0) $ids[] = $id;
            }
        }

        if(!empty($ids)) {
            $database->removeNotice($ids);
        }

        $this->safeRedirect("berichte.php");
    }

    private function archiveNotice($post) {

        global $database;

        $ids = array();

        for($i = 1; $i <= 10; $i++) {
            if(isset($post['n'.$i])) {
                $id = (int)$post['n'.$i];
                if($id > 0) $ids[] = $id;
            }
        }

        if(!empty($ids)) {
            $database->archiveNotice($ids);
        }

        $this->safeRedirect("berichte.php");
    }

    private function unarchiveNotice($post) {

        global $database;

        $ids = array();

        for($i = 1; $i <= 10; $i++) {
            if(isset($post['n'.$i])) {
                $id = (int)$post['n'.$i];
                if($id > 0) $ids[] = $id;
            }
        }

        if(!empty($ids)) {
            $database->unarchiveNotice($ids);
        }

        $this->safeRedirect("berichte.php");
    }

    /* ===================================================== */
    /* ================= QUOTE MESSAGE ===================== */
    /* ===================================================== */

    public function quoteMessage($id) {

        $id = (int)$id;
        if($id <= 0) return;

        foreach($this->inbox as $message) {

            if($message['id'] == $id) {

                $text = $message['message'];

                $text = preg_replace('/\[message\]/i', '', $text);
                $text = preg_replace('/\[\/message\]/i', '', $text);

                $_SESSION['reply'] = $text;
                $this->reply = $text;

                $owner  = (int)$message['owner'];
                $mid    = (int)$message['id'];
                $target = (int)$message['target'];

                $this->safeRedirect(
                    "nachrichten.php?t=1&id=".$owner."&mid=".$mid."&tid=".$target
                );
            }
        }
    }

    /* ===================================================== */
    /* ================= PROCESS MESSAGE =================== */
    /* ===================================================== */

    public function procMessage($post) {

        if(!isset($post['ft'])) return;

        switch($post['ft']) {

            case "m1":
                if(isset($post['id'])) {
                    $this->quoteMessage((int)$post['id']);
                }
                break;

            case "m2":

                $receiver = isset($post['an']) ? trim($post['an']) : '';
                $topic    = isset($post['be']) ? trim($post['be']) : '';
                $message  = isset($post['message']) ? trim($post['message']) : '';

                if($receiver === "[ally]") {
                    $this->sendAMessage($topic, $message);
                } else {
                    $this->sendMessage($receiver, $topic, $message);
                }

                $this->safeRedirect("nachrichten.php?t=2");
                break;

            case "m3":
            case "m4":
            case "m5":

                if(isset($post['delmsg']))   $this->removeMessage($post);
                if(isset($post['archive']))  $this->archiveMessage($post);
                if(isset($post['start']))    $this->unarchiveMessage($post);
                break;

            case "m6":
                $this->createNote($post);
                break;

            case "m7":
                $this->addFriends($post);
                break;
        }
    }

    /* ===================================================== */
    /* ================= FLOOD PROTECTION ================== */
    /* ===================================================== */

    private function checkFlood($uid) {

        global $database;

        $uid = (int)$uid;

        $query = "SELECT COUNT(*) AS total
                  FROM ".TB_PREFIX."mdata
                  WHERE owner = {$uid}
                  AND time > ".(time() - 60);

        $res = mysqli_fetch_assoc(mysqli_query($database->dblink, $query));

        if($res && $res['total'] > 5) {
            return false;
        }

        return true;
    }

    /* ===================================================== */
    /* ================= SANITIZE TEXT ===================== */
    /* ===================================================== */

    private function sanitizeMessage($text) {

        $text = trim($text);

        // remove null bytes
        $text = str_replace("\0", '', $text);

        // prevent extremely long spam payloads
        if(strlen($text) > 15000) {
            $text = substr($text, 0, 15000);
        }

        return $text;
    }

    /* ===================================================== */
    /* ================= SEND ALLY MESSAGE ================= */
    /* ===================================================== */

    private function sendAMessage($topic, $text) {

        global $session, $database;

        if(!$this->checkFlood($session->uid)) {
            return;
        }

        $topic = $this->sanitizeMessage($topic);
        $text  = $this->sanitizeMessage($text);

        if(defined('WORD_CENSOR')) {
            $topic = $this->wordCensor($topic);
            $text  = $this->wordCensor($text);
        }

        if(empty($topic)) {
            $topic = "No subject";
        }

        if(!preg_match('/\[message\]/i', $text)) {
            $text = "[message]".$text."[/message]";
        }

        $topic = htmlspecialchars($topic, ENT_QUOTES, 'UTF-8');
        $text  = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');

        $userally = (int)$session->alliance;

        if($userally <= 0) return;

        $membersQ = mysqli_query(
            $database->dblink,
            "SELECT id FROM ".TB_PREFIX."users WHERE alliance = {$userally}"
        );

        while($row = mysqli_fetch_assoc($membersQ)) {

            $receiver = (int)$row['id'];

            $database->sendMessage(
                $receiver,
                $session->uid,
                $topic,
                $text,
                0,
                0,0,0,0
            );
        }
    }

    /* ===================================================== */
    /* ================= SEND PRIVATE MESSAGE ============== */
    /* ===================================================== */

    private function sendMessage($receiverName, $topic, $text) {

        global $session, $database;

        if(!$this->checkFlood($session->uid)) {
            return;
        }

        $receiverName = trim($receiverName);

        if(empty($receiverName)) return;

        // get receiver safely
        $receiverID = $database->getUserField($receiverName, "id", 1);
        $receiverID = (int)$receiverID;

        if($receiverID <= 0) return;

        $topic = $this->sanitizeMessage($topic);
        $text  = $this->sanitizeMessage($text);

        if(defined('WORD_CENSOR')) {
            $topic = $this->wordCensor($topic);
            $text  = $this->wordCensor($text);
        }

        if(empty($topic)) {
            $topic = "No subject";
        }

        if(!preg_match('/\[message\]/i', $text)) {
            $text = "[message]".$text."[/message]";
        }

        $topic = htmlspecialchars($topic, ENT_QUOTES, 'UTF-8');
        $text  = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');

        $send_as = $session->uid;

        $support_allowed = (
            $session->access == ADMIN &&
            defined('ADMIN_RECEIVE_SUPPORT_MESSAGES') &&
            ADMIN_RECEIVE_SUPPORT_MESSAGES
        );

        if(!empty($_POST['as_support']) && $support_allowed) {
            $send_as = 1;
        }

        if(!empty($_POST['as_multihunter']) && $session->access == MULTIHUNTER) {
            $send_as = 5;
        }

        $database->sendMessage(
            $receiverID,
            (int)$send_as,
            $topic,
            $text,
            0,
            0,0,0,0
        );
    }

    /* ===================================================== */
    /* ================= SEND WELCOME ====================== */
    /* ===================================================== */

    public function sendWelcome($uid, $username) {

        global $database;

        $uid = (int)$uid;
        if($uid <= 0) return false;

        $tplPath = "GameEngine/Admin/welcome.tpl";
        if(!file_exists($tplPath)) return false;

        $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

        $content = file_get_contents($tplPath);

        $content = preg_replace(
            array(
                "'%USER%'",
                "'%START%'",
                "'%TIME%'",
                "'%PLAYERS%'",
                "'%ALLI%'",
                "'%SERVER_NAME%'",
                "'%PROTECTION%'"
            ),
            array(
                $username,
                date("y.m.d", COMMENCE),
                date("H:i", COMMENCE),
                (int)$database->countUser(),
                (int)$database->countAlli(),
                SERVER_NAME,
                round((PROTECTION/3600))
            ),
            $content
        );

        $content = "[message]".$content."[/message]";

        return $database->sendMessage(
            $uid,
            1,
            WEL_TOPIC,
            htmlspecialchars($content, ENT_QUOTES, 'UTF-8'),
            0,0,0,0,0
        );
    }

    /* ===================================================== */
    /* ================= SAFE WORD CENSOR ================== */
    /* ===================================================== */

    private function wordCensor($text) {

        if(!defined('CENSORED') || empty(CENSORED)) {
            return $text;
        }

        $censorarray = explode(",", CENSORED);
        $patterns = array();

        foreach($censorarray as $word) {

            $word = trim($word);
            if(empty($word)) continue;

            $word = preg_quote($word, '/');
            $patterns[] = '/'.$word.'/i';
        }

        if(!empty($patterns)) {
            $text = preg_replace($patterns, "****", $text);
        }

        return $text;
    }

    /* ===================================================== */
    /* ================= SAFE FIND METHODS ================= */
    /* ===================================================== */

    private function findInbox($id) {

        $id = (int)$id;

        if(!empty($this->inbox)) {
            foreach($this->inbox as $msg) {
                if((int)$msg['id'] === $id) return true;
            }
        }

        return false;
    }

    private function findSent($id) {

        $id = (int)$id;

        if(!empty($this->sent)) {
            foreach($this->sent as $msg) {
                if((int)$msg['id'] === $id) return true;
            }
        }

        return false;
    }

    private function findArchive($id) {

        $id = (int)$id;

        if(!empty($this->archived)) {
            foreach($this->archived as $msg) {
                if((int)$msg['id'] === $id) return true;
            }
        }

        return false;
    }

    /* ===================================================== */
    /* ================= SECURE FRIEND SYSTEM ============== */
    /* ===================================================== */

    public function addFriends($post){

        global $database, $session;

        $myID = (int)$session->uid;
        if($myID <= 0) return;

        for($i = 0; $i <= 19; $i++){

            if(empty($post['addfriends'.$i])) continue;

            $username = trim($post['addfriends'.$i]);
            $friendID = (int)$database->getUserField($username, "id", 1);

            if($friendID <= 0) continue;
            if($friendID == $myID) continue;

            // Check already exists
            $exists = false;
            for($k = 0; $k <= 19; $k++){
                if((int)$database->getUserField($myID, "friend".$k, 0) === $friendID){
                    $exists = true;
                    break;
                }
            }

            if($exists) continue;

            // Find empty slot
            for($j = 0; $j <= 19; $j++){

                $slot = (int)$database->getUserField($myID, "friend".$j, 0);
                $wait = (int)$database->getUserField($myID, "friend".$j."wait", 0);

                if($slot === 0 && $wait === 0){

                    $database->addFriend($myID, "friend".$j, $friendID);
                    $database->addFriend($myID, "friend".$j."wait", $friendID);

                    // Reciprocal request
                    for($l = 0; $l <= 19; $l++){

                        $slot2 = (int)$database->getUserField($friendID, "friend".$l, 0);
                        $wait2 = (int)$database->getUserField($friendID, "friend".$l."wait", 0);

                        if($slot2 === 0 && $wait2 === 0){
                            $database->addFriend($friendID, "friend".$l."wait", $myID);
                            break;
                        }
                    }

                    break;
                }
            }
        }

        $this->safeRedirect("nachrichten.php?t=1");
    }
	
    /* ===================================================== */
    /* ================= LOAD MESSAGES ===================== */
    /* ===================================================== */

    private function getMessages($which) {

        global $database, $session;

        $uid = (int)$session->uid;
        if($uid <= 0) return;

        switch((int)$which) {

            case 1:
                // Inbox
                $this->inbox  = $database->getMessage($uid, 1);
                $this->inbox1 = $database->getMessage($uid, 9);
                break;

            case 2:
                // Sent
                $this->sent  = $database->getMessage($uid, 2);
                $this->sent1 = $database->getMessage($uid, 10);
                break;

            case 3:
                // Archived (Plus only)
                if(!empty($session->plus)) {
                    $this->archived  = $database->getMessage($uid, 6);
                    $this->archived1 = $database->getMessage($uid, 11);
                }
                break;
        }
    }

}
