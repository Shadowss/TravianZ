<?php

/*
 * This file is part of the TravianZ Project
 *
 * Source code: <https://github.com/Shadowss/TravianZ/>
 *
 * Authors: Advocaite <https://github.com/advocaite>
 * Dzoki <http://forum.ragezone.com/members/1333337728.html>
 * Donnchadh <http://forum.ragezone.com/members/1333365974.html>
 *
 * License: GNU GPL-3.0 <https://github.com/Shadowss/TravianZ/blob/master/LICENSE>
 *
 * Copyright 2010-2018 TravianZ Team
 */
namespace TravianZ\Message;

use TravianZ\Database\Database;
use TravianZ\Account\Session;

class Message
{
    public $unread;

    public $note;

    public $inbox;

    public $inbox1;

    public $sent;

    public $sent1;

    public $reading;

    public $reply;

    public $archived;

    public $archived1;

    public $noticearray;

    public $nunread = false;

    public $readingNotice = [];

    private $totalMessage;

    private $database;

    private $session;

    function __construct(Database $database, Session $session)
    {
        $this->database = $database;
        $this->session = $session;
        
        $req_file = basename($_SERVER['PHP_SELF']);
        $this->unread = $this->checkUnread();
        $this->nunread = $this->checkNUnread();
        
        if ($req_file == 'nachrichten.php') {
            if (isset($_GET['t'])) {
                switch ($_GET['t']) {
                    // send messages page or a single sent message
                    case 2:
                    case '2a':
                        $this->getMessages(2);
                        break;
                    
                    // archived messages page
                    case 3:
                        $this->getMessages(3);
                        break;
                }
            } else {
                $this->getMessages(1); // inbox - received messages page
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
        if (isset($post['ft'])) {
            switch ($post['ft']) {
                case "m1":
                    $this->quoteMessage($post['id']);
                    break;
                case "m2":
                    if ($post['an'] == "[ally]")
                        $this->sendAMessage($post['be'], addslashes($post['message']));
                    else
                        $this->sendMessage($post['an'], $post['be'], addslashes($post['message']));
                    header("Location: nachrichten.php?t=2");
                    exit();
                case "m3":
                case "m4":
                case "m5":
                    if (isset($post['delmsg']))
                        $this->removeMessage($post);
                    if (isset($post['archive']))
                        $this->archiveMessage($post);
                    if (isset($post['start']))
                        $this->unarchiveMessage($post);
                    break;
                case "m6":
                    $this->createNote($post);
                    break;
                case "m7":
                    $this->addFriends($post);
                    break;
            }
        }
    }

    public function noticeType($get)
    {
        if (isset($get['t'])) {
            if ($get['t'] == 1) {
                $type = [8, 15, 16, 17];
            }
            
            if ($get['t'] == 2) {
                $type = [10, 11, 12, 13];
            }
            
            if ($get['t'] == 3) {
                $type = [1, 2, 3, 4, 5, 6, 7];
            }
            
            if ($get['t'] == 4) {
                $type = [0, 18, 19, 20, 21];
            }
            
            if ($get['t'] == 5) {
                if (!$this->session->plus) {
                    header("Location: berichte.php");
                    exit();
                } else {
                    $type = 9;
                }
            }
            if (!is_array($type)) {
                $type = [$type];
            }
            
            $this->noticearray = $this->filter_by_value($this->database->getNotice($this->session->uid), "ntype", $type);
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
                header("Location: nachrichten.php?t=1&id=" . $message['owner'] . "&mid=" . $message['id'] . "&tid=" . $message['target']);
                exit();
            }
        }
    }

    public function loadMessage($id)
    {
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
        
        if ($this->session->plus && $this->findArchive($id)) {
            foreach ($this->archived as $message) {
                if ($message['id'] == $id) {
                    $this->reading = $message;
                    break;
                }
            }
        }
        
        if ($this->reading['viewed'] == 0)
            $this->database->getMessage($id, 4, $this->session->access, $this->session->uid);
    }

    private function filter_by_value_except($array, $index, $value)
    {
        $newarray = [];
        if (is_array($array) && count($array) > 0) {
            foreach (array_keys($array) as $key) {
                $temp[$key] = $array[$key][$index];
                
                if ($temp[$key] != $value) {
                    array_push($newarray, $array[$key]);
                }
            }
        }
        return $newarray;
    }

    private function filter_by_value($array, $index, $value)
    {
        $newarray = [];
        if (is_array($array) && count($array) > 0) {
            foreach (array_keys($array) as $key) {
                $temp[$key] = $array[$key][$index];
                
                if (in_array($temp[$key], $value)) {
                    array_push($newarray, $array[$key]);
                }
            }
        }
        return $newarray;
    }

    private function getNotice()
    {
        $this->noticearray = $this->filter_by_value_except($this->database->getNotice($this->session->uid), "ntype", 9);
    }

    private function removeMessage($post)
    {
        $post = $this->database->escape($post);
        $mode5updates = $mode7updates = $mode8updates = [];
        
        for ($i = 1; $i <= 10; $i++) {
            if (isset($post['n' . $i])) {
                $message1 = mysqli_query($this->database->dblink, "SELECT target, owner FROM " . TB_PREFIX . "mdata where id = " . (int) $post['n' . $i] . "");
                $message = mysqli_fetch_array($message1);
                
                if ($message['target'] == $this->session->uid && $message['owner'] == $this->session->uid)
                    $mode8updates[] = $post['n' . $i];
                else if ($message['target'] == $this->session->uid)
                    $mode5updates[] = $post['n' . $i];
                else if ($message['owner'] == $this->session->uid)
                    $mode7updates[] = $post['n' . $i];
            }
        }
        
        if (count($mode5updates))
            $this->database->getMessage($mode5updates, 5, $this->session->access, $this->session->uid);
        if (count($mode7updates))
            $this->database->getMessage($mode7updates, 7, $this->session->access, $this->session->uid);
        if (count($mode8updates))
            $this->database->getMessage($mode8updates, 8, $this->session->access, $this->session->uid);
        
        header("Location: nachrichten.php");
        exit();
    }

    private function archiveMessage($post)
    {
        $archIDs = [];
        for ($i = 1; $i <= 10; $i++) {
            if (isset($post['n' . $i]))
                $archIDs[] = $post['n' . $i];
        }
        $this->database->setArchived($archIDs);
        
        header("Location: nachrichten.php");
        exit();
    }

    private function unarchiveMessage($post)
    {
        $normIDs = [];
        for ($i = 1; $i <= 10; $i++) {
            if (isset($post['n' . $i]))
                $normIDs[] = $post['n' . $i];
        }
        $this->database->setNorm($normIDs);
        
        header("Location: nachrichten.php");
        exit();
    }

    private function removeNotice($post)
    {
        $removeIDs = [];
        for ($i = 1; $i <= 10; $i++) {
            if (isset($post['n' . $i])) {
                $removeIDs[] = $post['n' . $i];
            }
        }
        
        $this->database->removeNotice($removeIDs);
        
        header("Location: berichte.php");
        exit();
    }

    private function archiveNotice($post)
    {
        $archiveIDs = [];
        for ($i = 1; $i <= 10; $i++) {
            if (isset($post['n' . $i])) {
                $archiveIDs[] = $post['n' . $i];
            }
        }
        
        $this->database->archiveNotice($archiveIDs);
        
        header("Location: berichte.php");
        exit();
    }

    private function unarchiveNotice($post)
    {
        $unarchIDs = [];
        for ($i = 1; $i <= 10; $i++) {
            if (isset($post['n' . $i])) {
                $unarchIDs[] = $post['n' . $i];
            }
        }
        
        $this->database->unarchiveNotice($unarchIDs);
        
        header("Location: berichte.php");
        exit();
    }

    private function getReadNotice($id)
    {
        $notice = $this->database->getNotice2($id);
        if ($notice['uid'] == $this->session->uid || $notice['ally'] == $this->session->alliance) {
            if ($notice['uid'] == $this->session->uid)
                $this->database->noticeViewed($notice['id']);
            return $notice;
        } else {
            return null;
        }
    }

    /**
     * Not all notices have a corresponding .tpl file but with this method it's like they have it
     *
     * @param int $type
     *            The type of the report (notice)
     * @return int Returns the new report type
     */
    public function getReportType($type)
    {
        switch ($type) {
            case 2:
            case 4:
            case 5:
            case 6:
            case 7:
            case 18:
            case 20:
            case 21:
                return 1; // General attacking reports
            
            case 11:
            case 12:
            case 13:
            case 14:
                return 10; // Merchants reports
            
            case 16:
            case 17:
                return 15; // Reinforcements attacked
            
            case 19:
                return 3; // No troops have returned
            
            case 23:
                return 22; // Festive reports
        }
        
        return $type;
    }

    public function loadNotes()
    {
        if (file_exists("GameEngine/Notes/" . md5($this->session->username) . ".txt")) {
            $this->note = file_get_contents("GameEngine/Notes/" . md5($this->session->username) . ".txt");
        } else {
            $this->note = "";
        }
    }

    private function createNote($post)
    {
        if ($this->session->plus) {
            $ourFileHandle = fopen("GameEngine/Notes/" . md5($this->session->username) . ".txt", 'w');
            fwrite($ourFileHandle, $post['notizen']);
            fclose($ourFileHandle);
        }
    }

    private function getMessages($which)
    {
        switch ($which) {
            case 1:
                $this->inbox = $this->database->getMessage($this->session->uid, 1, $this->session->access, $this->session->uid);
                $this->inbox1 = $this->database->getMessage($this->session->uid, 9, $this->session->access, $this->session->uid);
                break;
            
            case 2:
                $this->sent = $this->database->getMessage($this->session->uid, 2, $this->session->access, $this->session->uid);
                $this->sent1 = $this->database->getMessage($this->session->uid, 10, $this->session->access, $this->session->uid);
                break;
            
            case 3:
                if ($this->session->plus) {
                    $this->archived = $this->database->getMessage($this->session->uid, 6, $this->session->access, $this->session->uid);
                    $this->archived1 = $this->database->getMessage($this->session->uid, 11, $this->session->access, $this->session->uid);
                }
        }
    }

    private function sendAMessage($topic, $text)
    {        
        // Vulnerability closed by Shadow
        
        $q = "SELECT Count(*) as Total FROM " . TB_PREFIX . "mdata WHERE owner='" . $this->session->uid . "' AND time > " . (time() - 60);
        $res = mysqli_fetch_array(mysqli_query($this->database->dblink, $q), MYSQLI_ASSOC);
        if ($res['Total'] > 5)
            return; // flooding prevention
                                          
        // Vulnerability closed by Shadow
        
        $allmembersQ = mysqli_query($this->database->dblink, "SELECT id FROM " . TB_PREFIX . "users WHERE alliance='" . $this->session->alliance . "'");
        $userally = $this->database->getUserField($this->session->uid, "alliance", 0);
        $permission = mysqli_fetch_array(mysqli_query($this->database->dblink, "SELECT opt7 FROM " . TB_PREFIX . "ali_permission WHERE uid='" . $this->session->uid . "'"));
        
        if (WORD_CENSOR) {
            $topic = $this->wordCensor($topic);
            $text = $this->wordCensor($text);
        }
        
        if ($topic == "")
            $topic = "No subject";
        
        if (!preg_match('/\[message\]/', $text) && !preg_match('/\[\/message\]/', $text)) {
            $text = "[message]" . $text . "[/message]";
            $alliance = $player = $coor = $report = 0;
            
            for ($i = 0; $i <= $alliance; $i++) {
                if (preg_match('/\[alliance' . $i . '\]/', $text) && preg_match('/\[\/alliance' . $i . '\]/', $text)) {
                    $alliance1 = preg_replace('/\[message\](.*?)\[\/alliance' . $i . '\]/is', '', $text);
                    if (preg_match('/\[alliance' . $i . '\]/', $alliance1) && preg_match('/\[\/alliance' . $i . '\]/', $alliance1)) {
                        $j = $i + 1;
                        $alliance2 = preg_replace('/\[\/alliance' . $i . '\](.*?)\[\/message\]/is', '', $text);
                        $alliance1 = preg_replace('/\[alliance' . $i . '\]/', '[alliance' . $j . ']', $alliance1);
                        $alliance1 = preg_replace('/\[\/alliance' . $i . '\]/', '[/alliance' . $j . ']', $alliance1);
                        $text = $alliance2 . "[/alliance" . $i . "]" . $alliance1;
                        $alliance += 1;
                    }
                }
            }
            
            for ($i = 0; $i <= $player; $i++) {
                if (preg_match('/\[player' . $i . '\]/', $text) && preg_match('/\[\/player' . $i . '\]/', $text)) {
                    $player1 = preg_replace('/\[message\](.*?)\[\/player' . $i . '\]/is', '', $text);
                    if (preg_match('/\[player' . $i . '\]/', $player1) && preg_match('/\[\/player' . $i . '\]/', $player1)) {
                        $j = $i + 1;
                        $player2 = preg_replace('/\[\/player' . $i . '\](.*?)\[\/message\]/is', '', $text);
                        $player1 = preg_replace('/\[player' . $i . '\]/', '[player' . $j . ']', $player1);
                        $player1 = preg_replace('/\[\/player' . $i . '\]/', '[/player' . $j . ']', $player1);
                        $text = $player2 . "[/player" . $i . "]" . $player1;
                        $player += 1;
                    }
                }
            }
            
            for ($i = 0; $i <= $coor; $i++) {
                if (preg_match('/\[coor' . $i . '\]/', $text) && preg_match('/\[\/coor' . $i . '\]/', $text)) {
                    $coor1 = preg_replace('/\[message\](.*?)\[\/coor' . $i . '\]/is', '', $text);
                    if (preg_match('/\[coor' . $i . '\]/', $coor1) && preg_match('/\[\/coor' . $i . '\]/', $coor1)) {
                        $j = $i + 1;
                        $coor2 = preg_replace('/\[\/coor' . $i . '\](.*?)\[\/message\]/is', '', $text);
                        $coor1 = preg_replace('/\[coor' . $i . '\]/', '[coor' . $j . ']', $coor1);
                        $coor1 = preg_replace('/\[\/coor' . $i . '\]/', '[/coor' . $j . ']', $coor1);
                        $text = $coor2 . "[/coor" . $i . "]" . $coor1;
                        $coor += 1;
                    }
                }
            }
            
            for ($i = 0; $i <= $report; $i++) {
                if (preg_match('/\[report' . $i . '\]/', $text) && preg_match('/\[\/report' . $i . '\]/', $text)) {
                    $report1 = preg_replace('/\[message\](.*?)\[\/report' . $i . '\]/is', '', $text);
                    if (preg_match('/\[report' . $i . '\]/', $report1) && preg_match('/\[\/report' . $i . '\]/', $report1)) {
                        $j = $i + 1;
                        $report2 = preg_replace('/\[\/report' . $i . '\](.*?)\[\/message\]/is', '', $text);
                        $report1 = preg_replace('/\[report' . $i . '\]/', '[report' . $j . ']', $report1);
                        $report1 = preg_replace('/\[\/report' . $i . '\]/', '[/report' . $j . ']', $report1);
                        $text = $report2 . "[/report" . $i . "]" . $report1;
                        $report += 1;
                    }
                }
            }
            
            if ($permission['opt7'] == 1) {
                if ($userally > 0) {
                    while ($allmembers = mysqli_fetch_array($allmembersQ)) {
                        $this->database->sendMessage($allmembers[id], $this->session->uid, htmlspecialchars(addslashes($topic)), htmlspecialchars(addslashes($text)), 0, $alliance, $player, $coor, $report);
                    }
                }
            }
        }
    }

    private function sendMessage($recieve, $topic, $text, $security_check = true)
    {
        $user = $this->database->getUserField($recieve, "id", 1);
        
        // Vulnerability closed by Shadow
        if ($security_check) {
            $q = "SELECT Count(*) as Total FROM " . TB_PREFIX . "mdata WHERE owner='" . $this->session->uid . "' AND time > " . (time() - 60);
            $res = mysqli_fetch_array(mysqli_query($this->database->dblink, $q), MYSQLI_ASSOC);
            if ($res['Total'] > 5)
                return; // flooding prevention
        }
        
        // Vulnerability closed by Shadow
        if (WORD_CENSOR) {
            $topic = $this->wordCensor($topic);
            $text = $this->wordCensor($text);
        }
        
        if (empty($topic))
            $topic = "No subject";
        
        if (!preg_match('/\[message\]/', $text) && !preg_match('/\[\/message\]/', $text)) {
            $text = "[message]" . $text . "[/message]";
            $alliance = $player = $coor = $report = 0;
            
            for ($i = 0; $i <= $alliance; $i++) {
                if (preg_match('/\[alliance' . $i . '\]/', $text) && preg_match('/\[\/alliance' . $i . '\]/', $text)) {
                    $alliance1 = preg_replace('/\[message\](.*?)\[\/alliance' . $i . '\]/is', '', $text);
                    if (preg_match('/\[alliance' . $i . '\]/', $alliance1) && preg_match('/\[\/alliance' . $i . '\]/', $alliance1)) {
                        $j = $i + 1;
                        $alliance2 = preg_replace('/\[\/alliance' . $i . '\](.*?)\[\/message\]/is', '', $text);
                        $alliance1 = preg_replace('/\[alliance' . $i . '\]/', '[alliance' . $j . ']', $alliance1);
                        $alliance1 = preg_replace('/\[\/alliance' . $i . '\]/', '[/alliance' . $j . ']', $alliance1);
                        $text = $alliance2 . "[/alliance" . $i . "]" . $alliance1;
                        $alliance += 1;
                    }
                }
            }
            
            for ($i = 0; $i <= $player; $i++) {
                if (preg_match('/\[player' . $i . '\]/', $text) && preg_match('/\[\/player' . $i . '\]/', $text)) {
                    $player1 = preg_replace('/\[message\](.*?)\[\/player' . $i . '\]/is', '', $text);
                    if (preg_match('/\[player' . $i . '\]/', $player1) && preg_match('/\[\/player' . $i . '\]/', $player1)) {
                        $j = $i + 1;
                        $player2 = preg_replace('/\[\/player' . $i . '\](.*?)\[\/message\]/is', '', $text);
                        $player1 = preg_replace('/\[player' . $i . '\]/', '[player' . $j . ']', $player1);
                        $player1 = preg_replace('/\[\/player' . $i . '\]/', '[/player' . $j . ']', $player1);
                        $text = $player2 . "[/player" . $i . "]" . $player1;
                        $player += 1;
                    }
                }
            }
            
            for ($i = 0; $i <= $coor; $i++) {
                if (preg_match('/\[coor' . $i . '\]/', $text) && preg_match('/\[\/coor' . $i . '\]/', $text)) {
                    $coor1 = preg_replace('/\[message\](.*?)\[\/coor' . $i . '\]/is', '', $text);
                    if (preg_match('/\[coor' . $i . '\]/', $coor1) && preg_match('/\[\/coor' . $i . '\]/', $coor1)) {
                        $j = $i + 1;
                        $coor2 = preg_replace('/\[\/coor' . $i . '\](.*?)\[\/message\]/is', '', $text);
                        $coor1 = preg_replace('/\[coor' . $i . '\]/', '[coor' . $j . ']', $coor1);
                        $coor1 = preg_replace('/\[\/coor' . $i . '\]/', '[/coor' . $j . ']', $coor1);
                        $text = $coor2 . "[/coor" . $i . "]" . $coor1;
                        $coor += 1;
                    }
                }
            }
            
            for ($i = 0; $i <= $report; $i++) {
                if (preg_match('/\[report' . $i . '\]/', $text) && preg_match('/\[\/report' . $i . '\]/', $text)) {
                    $report1 = preg_replace('/\[message\](.*?)\[\/report' . $i . '\]/is', '', $text);
                    if (preg_match('/\[report' . $i . '\]/', $report1) && preg_match('/\[\/report' . $i . '\]/', $report1)) {
                        $j = $i + 1;
                        $report2 = preg_replace('/\[\/report' . $i . '\](.*?)\[\/message\]/is', '', $text);
                        $report1 = preg_replace('/\[report' . $i . '\]/', '[report' . $j . ']', $report1);
                        $report1 = preg_replace('/\[\/report' . $i . '\]/', '[/report' . $j . ']', $report1);
                        $text = $report2 . "[/report" . $i . "]" . $report1;
                        $report += 1;
                    }
                }
            }
            
            // check if we're not sending this as Support or Multihunter
            $support_from_admin_allowed = ($this->session->access == ADMIN && ADMIN_RECEIVE_SUPPORT_MESSAGES);
            $send_as = $this->session->uid;
            
            // send as Support?
            if ((!empty($_POST['as_support']) && $support_from_admin_allowed))
                $send_as = 1;
            
            // send as Multihunter
            if ((!empty($_POST['as_multihunter']) && $this->session->access == MULTIHUNTER))
                $send_as = 5;
            
            $this->database->sendMessage($user, $send_as, htmlspecialchars(addslashes($topic)), htmlspecialchars(addslashes($text)), 0, $alliance, $player, $coor, $report);
        }
    }

    public function sendWelcome($uid, $username)
    {
        $welcomemsg = file_get_contents("GameEngine/Admin/welcome.tpl");
        $welcomemsg = "[message]" . preg_replace([
            "'%USER%'",
            "'%START%'",
            "'%TIME%'",
            "'%PLAYERS%'",
            "'%ALLI%'",
            "'%SERVER_NAME%'",
            "'%PROTECTION%'"
        ], [
            $username,
            date("y.m.d", COMMENCE),
            date("H:i", COMMENCE),
            $this->database->countUser(),
            $this->database->countAlli(),
            SERVER_NAME,
            round((PROTECTION / 3600))
        ], $welcomemsg) . "[/message]";
        
        return $this->database->sendMessage($uid, 1, WEL_TOPIC, addslashes($welcomemsg), 0, 0, 0, 0, 0);
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
        return $this->database->getUnreadMessagesCount($this->session->uid);
    }

    private function checkNUnread()
    {
        return $this->database->getUnreadNoticesCount($this->session->uid);
    }

    private function findInbox($id)
    {
        if (!empty($this->inbox)) {
            foreach ($this->inbox as $message) {
                if ($message['id'] == $id)
                    return true;
            }
        }
        return false;
    }

    private function findSent($id)
    {
        if (!empty($this->sent)) {
            foreach ($this->sent as $message) {
                if ($message['id'] == $id)
                    return true;
            }
        }
        return false;
    }

    private function findArchive($id)
    {
        if (!empty($this->archived)) {
            foreach ($this->archived as $message) {
                if ($message['id'] == $id)
                    return true;
            }
        }
        
        return false;
    }

    public function addFriends($post)
    {
        for ($i = 0; $i <= 19; $i++) {
            if ($post['addfriends' . $i] != "") {
                $uid = $this->database->getUserField($post['addfriends' . $i], "id", 1);
                $added = 0;
                
                for ($j = 0; $j <= $i; $j++) {
                    if ($added == 0) {
                        $user = $this->database->getUserField($post['myid'], "friend" . $j, 0);
                        $userwait = $this->database->getUserField($post['myid'], "friend" . $j . "wait", 0);
                        $exist = 0;
                        
                        for ($k = 0; $k <= 19; $k++) {
                            $user1 = $this->database->getUserField($post['myid'], "friend" . $k, 0);
                            if ($user1 == $uid or $uid == $post['myid']) {
                                $exist = 1;
                            }
                        }
                        
                        if ($user == 0 && $userwait == 0 && $exist == 0) {
                            $added1 = 0;
                            
                            for ($l = 0; $l <= 19; $l++) {
                                $user2 = $this->database->getUserField($uid, "friend" . $l, 0);
                                $userwait2 = $this->database->getUserField($uid, "friend" . $l . "wait", 0);
                                
                                if ($user2 == 0 && $userwait2 == 0 && $added1 == 0) {
                                    $this->database->addFriend($uid, "friend" . $l . "wait", $post['myid']);
                                    $added1 = 1;
                                }
                            }
                            
                            $this->database->addFriend($post['myid'], "friend" . $j, $uid);
                            $this->database->addFriend($post['myid'], "friend" . $j . "wait", $uid);
                            $added = 1;
                        }
                    }
                }
            }
        }
        
        header("Location: nachrichten.php?t=1");
        exit();
    }
}
