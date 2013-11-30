<?php

/** --------------------------------------------------- **\
| ********* DO NOT REMOVE THIS COPYRIGHT NOTICE ********* |
+---------------------------------------------------------+
| Credits:     All the developers including the leaders:  |
|              Advocaite & Dzoki & Donnchadh              |
|                                                         |
| Copyright:   TravianX Project All rights reserved       |
\** --------------------------------------------------- **/

class Message {

	public $unread, $nunread = false;
	public $note;
	public $inbox, $inbox1, $sent, $sent1, $reading, $reply, $archived, $archived1, $noticearray, $notice, $readingNotice = array();
	private $totalMessage, $totalNotice;
	private $allNotice = array();

	function Message() {
		$this->getMessages();
		$this->getNotice();
		if($this->totalMessage > 0) {
			$this->unread = $this->checkUnread();
		}
		if($this->totalNotice > 0) {
			$this->nunread = $this->checkNUnread();
		}
		if(isset($_SESSION['reply'])) {
			$this->reply = $_SESSION['reply'];
			unset($_SESSION['reply']);
		}
	}

	public function procMessage($post) {
		if(isset($post['ft'])) {
			switch($post['ft']) {
				case "m1":
					$this->quoteMessage($post['id']);
					break;
				case "m2":
				if ($post['an'] == "[ally]"){
				$this->sendAMessage($post['be'],addslashes($post['message']));
				}else{
				$this->sendMessage($post['an'],$post['be'],addslashes($post['message']));
				}
				header("Location: nachrichten.php?t=2");
					break;
				case "m3":
				case "m4":
				case "m5":
					if(isset($post['delmsg_x'])) {
					$this->removeMessage($post);
					$this->header($get);
					}
					if(isset($post['archive_x'])) {
						$this->archiveMessage($post);
					}
					if(isset($post['start_x'])) {
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
	}

	public function noticeType($get) {
		global $session, $database;
		if(isset($get['t'])) {
			if($get['t'] == 1) {
				$type = array(8, 15, 16, 17);
			}
			if($get['t'] == 2) {
				$type = array(10, 11, 12, 13);
			}
			if($get['t'] == 3) {
				$type = array(1, 2, 3, 4, 5, 6, 7);
			}
			if($get['t'] == 4) {
				$type = array(0, 18, 19, 20, 21);
			}
			if($get['t'] == 5) {
				if(!$session->plus){
					header("Location: berichte.php");
				} else {
					$type = 9;
				}
			}
			if (!is_array($type)) { $type = array($type); }
			$this->noticearray = $this->filter_by_value($database->getNotice($session->uid), "ntype", $type);
			$this->notice = $this->filter_by_value($database->getNotice3($session->uid), "ntype", $type);
		}
		if(isset($get['id'])) {
			$this->readingNotice = $this->getReadNotice($get['id']);
		}
	}

	public function procNotice($post) {
		if(isset($post["del_x"])) {
			$this->removeNotice($post);
		}
		if(isset($post['archive_x'])) {
			$this->archiveNotice($post);
		}
		if(isset($post['start_x'])) {
			$this->unarchiveNotice($post);
		}
	}

	public function quoteMessage($id) {
		foreach($this->inbox as $message) {
			if($message['id'] == $id) {
			$message = preg_replace('/\[message\]/', '', $message);
			$message = preg_replace('/\[\/message\]/', '', $message);
			for($i=1;$i<=$message['alliance'];$i++){
			$message = preg_replace('/\[alliance'.$i.'\]/', '[alliance0]', $message);
			$message = preg_replace('/\[\/alliance'.$i.'\]/', '[/alliance0]', $message);
			}
			for($i=0;$i<=$message['player'];$i++){
			$message = preg_replace('/\[player'.$i.'\]/', '[player0]', $message);
			$message = preg_replace('/\[\/player'.$i.'\]/', '[/player0]', $message);
			}
			for($i=0;$i<=$message['coor'];$i++){
			$message = preg_replace('/\[coor'.$i.'\]/', '[coor0]', $message);
			$message = preg_replace('/\[\/coor'.$i.'\]/', '[/coor0]', $message);
			}
			for($i=0;$i<=$message['report'];$i++){
			$message = preg_replace('/\[report'.$i.'\]/', '[report0]', $message);
			$message = preg_replace('/\[\/report'.$i.'\]/', '[/report0]', $message);
			}
				$this->reply = $_SESSION['reply'] = $message;
				header("Location: nachrichten.php?t=1&id=" . $message['owner']);
			}
		}
	}

	public function loadMessage($id) {
		global $database, $session;
		if($this->findInbox($id)) {
			foreach($this->inbox as $message) {
				if($message['id'] == $id) {
					$this->reading = $message;
				}
			}
		}
		if($this->findSent($id)) {
			foreach($this->sent as $message) {
				if($message['id'] == $id) {
					$this->reading = $message;
				}
			}
		}
		if($session->plus && $this->findArchive($id)) {
			foreach($this->archived as $message) {
				if($message['id'] == $id) {
					$this->reading = $message;
				}
			}
		}
		if($this->reading['viewed'] == 0) {
			$database->getMessage($id, 4);
		}
	}

	private function filter_by_value_except($array, $index, $value) {
		$newarray = array();
		if(is_array($array) && count($array) > 0) {
			foreach(array_keys($array) as $key) {
				$temp[$key] = $array[$key][$index];

				if($temp[$key] != $value) {
					array_push($newarray, $array[$key]);
					//$newarray[$key] = $array[$key];
				}
			}
		}
		return $newarray;
	}

	private function filter_by_value($array, $index, $value) {
		$newarray = array();
		if(is_array($array) && count($array) > 0) {
			foreach(array_keys($array) as $key) {
				$temp[$key] = $array[$key][$index];

				if(in_array($temp[$key], $value)) {
					array_push($newarray, $array[$key]);
					//$newarray[$key] = $array[$key];
				}
			}
		}
		return $newarray;
	}

	private function getNotice() {
		global $database, $session;
		$this->allNotice = $database->getNotice3($session->uid);
		$this->noticearray = $this->filter_by_value_except($database->getNotice($session->uid), "ntype", 9);
		$this->notice = $this->filter_by_value_except($this->allNotice, "ntype", 9);
		$this->totalNotice = count($this->allNotice);
	}

	private function removeMessage($post) {
		global $database,$session;
		for($i = 1; $i <= 10; $i++) {
			if(isset($post['n' . $i])) {
			$message1 = mysql_query("SELECT * FROM " . TB_PREFIX . "mdata where id = ".$post['n' . $i]."");
			$message = mysql_fetch_array($message1);
			if($message['target'] == $session->uid && $message['owner'] == $session->uid){
				$database->getMessage($post['n' . $i], 8);
			}else if($message['target'] == $session->uid){
				$database->getMessage($post['n' . $i], 5);
			}else if($message['owner'] == $session->uid){
				$database->getMessage($post['n' . $i], 7);
			}
			}
		}
		header("Location: nachrichten.php");
	}

	private function archiveMessage($post) {
		global $database;
		for($i = 1; $i <= 10; $i++) {
			if(isset($post['n' . $i])) {
				$database->setArchived($post['n' . $i]);
			}
		}
		header("Location: nachrichten.php");
	}

	private function unarchiveMessage($post) {
		global $database;
		for($i = 1; $i <= 10; $i++) {
			if(isset($post['n' . $i])) {
				$database->setNorm($post['n' . $i]);
			}
		}
		header("Location: nachrichten.php");
	}

	private function removeNotice($post) {
		global $database;
		for($i = 1; $i <= 10; $i++) {
			if(isset($post['n' . $i])) {
				$database->removeNotice($post['n' . $i], 5);
			}
		}
		header("Location: berichte.php");
	}

	private function archiveNotice($post) {
		global $database;
		for($i = 1; $i <= 10; $i++) {
			if(isset($post['n' . $i])) {
				$database->archiveNotice($post['n' . $i]);
			}
		}
		header("Location: berichte.php");
	}

	private function unarchiveNotice($post) {
		global $database;
		for($i = 1; $i <= 10; $i++) {
			if(isset($post['n' . $i])) {
				$database->unarchiveNotice($post['n' . $i]);
			}
		}
		header("Location: berichte.php");
	}

	private function getReadNotice($id) {
		global $database;
		foreach($this->allNotice as $notice) {
			if($notice['id'] == $id) {
				$database->noticeViewed($notice['id']);
				return $notice;
			}
		}
	}

	public function loadNotes() {
		global $session;
		if(file_exists("GameEngine/Notes/" . md5($session->username) . ".txt")) {
			$this->note = file_get_contents("GameEngine/Notes/" . md5($session->username) . ".txt");
		} else {
			$this->note = "";
		}
	}

	private function createNote($post) {
		global $session;
		if($session->plus) {
			$ourFileHandle = fopen("GameEngine/Notes/" . md5($session->username) . ".txt", 'w');
			fwrite($ourFileHandle, $post['notizen']);
			fclose($ourFileHandle);
		}
	}

	private function getMessages() {
		global $database, $session;
		$this->inbox = $database->getMessage($session->uid, 1);
		$this->sent = $database->getMessage($session->uid, 2);
		$this->inbox1 = $database->getMessage($session->uid, 9);
		$this->sent1 = $database->getMessage($session->uid, 10);
		if($session->plus) {
			$this->archived = $database->getMessage($session->uid, 6);
			$this->archived1 = $database->getMessage($session->uid, 11);
		}
		$this->totalMessage = count($this->inbox) + count($this->sent);
	}

	private function sendAMessage($topic,$text) {
		global $session,$database;
		
		// Vulnerability closed by Shadow

		$q = "SELECT * FROM ".TB_PREFIX."mdata WHERE owner='".$session->uid."' AND time > ".time()." - 60";
		$res = mysql_query($q) or die(mysql_error(). " query  ".$q);
		$flood = mysql_num_rows($res);
		if($flood > 5)
		return; //flood

		// Vulnerability closed by Shadow
			
		$allmembersQ = mysql_query("SELECT id FROM ".TB_PREFIX."users WHERE alliance='".$session->alliance."'");
		$userally = $database->getUserField($session->uid,"alliance",0);
		$permission=mysql_fetch_array(mysql_query("SELECT opt7 FROM ".TB_PREFIX."ali_permission WHERE uid='".$session->uid."'"));
		if(WORD_CENSOR) {
		$topic = $this->wordCensor($topic);
		$text = $this->wordCensor($text);
		}
		if($topic == "") {
		$topic = "No subject";
		}
		if(!preg_match('/\[message\]/',$text) && !preg_match('/\[\/message\]/',$text)){
		$text = "[message]".$text."[/message]";
		$alliance = $player = $coor = $report = 0;
		for($i=0;$i<=$alliance;$i++){
		if(preg_match('/\[alliance'.$i.'\]/',$text) && preg_match('/\[\/alliance'.$i.'\]/',$text)){
		$alliance1 = preg_replace('/\[message\](.*?)\[\/alliance'.$i.'\]/is', '', $text);
		if(preg_match('/\[alliance'.$i.'\]/',$alliance1) && preg_match('/\[\/alliance'.$i.'\]/',$alliance1)){
		$j = $i+1;
		$alliance2 = preg_replace('/\[\/alliance'.$i.'\](.*?)\[\/message\]/is', '', $text);
		$alliance1 = preg_replace('/\[alliance'.$i.'\]/', '[alliance'.$j.']', $alliance1);
		$alliance1 = preg_replace('/\[\/alliance'.$i.'\]/', '[/alliance'.$j.']', $alliance1);
		$text = $alliance2."[/alliance".$i."]".$alliance1;
		$alliance += 1;
		}
		}
		}
		for($i=0;$i<=$player;$i++){
		if(preg_match('/\[player'.$i.'\]/',$text) && preg_match('/\[\/player'.$i.'\]/',$text)){
		$player1 = preg_replace('/\[message\](.*?)\[\/player'.$i.'\]/is', '', $text);
		if(preg_match('/\[player'.$i.'\]/',$player1) && preg_match('/\[\/player'.$i.'\]/',$player1)){
		$j = $i+1;
		$player2 = preg_replace('/\[\/player'.$i.'\](.*?)\[\/message\]/is', '', $text);
		$player1 = preg_replace('/\[player'.$i.'\]/', '[player'.$j.']', $player1);
		$player1 = preg_replace('/\[\/player'.$i.'\]/', '[/player'.$j.']', $player1);
		$text = $player2."[/player".$i."]".$player1;
		$player += 1;
		}
		}
		}
		for($i=0;$i<=$coor;$i++){
		if(preg_match('/\[coor'.$i.'\]/',$text) && preg_match('/\[\/coor'.$i.'\]/',$text)){
		$coor1 = preg_replace('/\[message\](.*?)\[\/coor'.$i.'\]/is', '', $text);
		if(preg_match('/\[coor'.$i.'\]/',$coor1) && preg_match('/\[\/coor'.$i.'\]/',$coor1)){
		$j = $i+1;
		$coor2 = preg_replace('/\[\/coor'.$i.'\](.*?)\[\/message\]/is', '', $text);
		$coor1 = preg_replace('/\[coor'.$i.'\]/', '[coor'.$j.']', $coor1);
		$coor1 = preg_replace('/\[\/coor'.$i.'\]/', '[/coor'.$j.']', $coor1);
		$text = $coor2."[/coor".$i."]".$coor1;
		$coor += 1;
		}
		}
		}
		for($i=0;$i<=$report;$i++){
		if(preg_match('/\[report'.$i.'\]/',$text) && preg_match('/\[\/report'.$i.'\]/',$text)){
		$report1 = preg_replace('/\[message\](.*?)\[\/report'.$i.'\]/is', '', $text);
		if(preg_match('/\[report'.$i.'\]/',$report1) && preg_match('/\[\/report'.$i.'\]/',$report1)){
		$j = $i+1;
		$report2 = preg_replace('/\[\/report'.$i.'\](.*?)\[\/message\]/is', '', $text);
		$report1 = preg_replace('/\[report'.$i.'\]/', '[report'.$j.']', $report1);
		$report1 = preg_replace('/\[\/report'.$i.'\]/', '[/report'.$j.']', $report1);
		$text = $report2."[/report".$i."]".$report1;
		$report += 1;
		}
		}
		}
		if($permission[opt7]==1){
		if ($userally != 0) {
		while ($allmembers = mysql_fetch_array($allmembersQ)) {
		$database->sendMessage($allmembers[id],$session->uid,htmlspecialchars(addslashes($topic)),htmlspecialchars(addslashes($text)),0,$alliance,$player,$coor,$report);
		}
			}
			}
		}
	}

	private function sendMessage($recieve, $topic, $text) {
		global $session, $database;
		$user = $database->getUserField($recieve, "id", 1);

		// Vulnerability closed by Shadow

		$q = "SELECT * FROM ".TB_PREFIX."mdata WHERE owner='".$session->uid."' AND time > ".time()." - 60";
		$res = mysql_query($q) or die(mysql_error(). " query  ".$q);
		$flood = mysql_num_rows($res);
		if($flood > 5)
		return; //flood

		// Vulnerability closed by Shadow

		if(WORD_CENSOR) {
			$topic = $this->wordCensor($topic);
			$text = $this->wordCensor($text);
		}
		if($topic == "") {
			$topic = "No subject";
		}
		if(!preg_match('/\[message\]/',$text) && !preg_match('/\[\/message\]/',$text)){
		$text = "[message]".$text."[/message]";
		$alliance = $player = $coor = $report = 0;
		for($i=0;$i<=$alliance;$i++){
		if(preg_match('/\[alliance'.$i.'\]/',$text) && preg_match('/\[\/alliance'.$i.'\]/',$text)){
		$alliance1 = preg_replace('/\[message\](.*?)\[\/alliance'.$i.'\]/is', '', $text);
		if(preg_match('/\[alliance'.$i.'\]/',$alliance1) && preg_match('/\[\/alliance'.$i.'\]/',$alliance1)){
		$j = $i+1;
		$alliance2 = preg_replace('/\[\/alliance'.$i.'\](.*?)\[\/message\]/is', '', $text);
		$alliance1 = preg_replace('/\[alliance'.$i.'\]/', '[alliance'.$j.']', $alliance1);
		$alliance1 = preg_replace('/\[\/alliance'.$i.'\]/', '[/alliance'.$j.']', $alliance1);
		$text = $alliance2."[/alliance".$i."]".$alliance1;
		$alliance += 1;
		}
		}
		}
		for($i=0;$i<=$player;$i++){
		if(preg_match('/\[player'.$i.'\]/',$text) && preg_match('/\[\/player'.$i.'\]/',$text)){
		$player1 = preg_replace('/\[message\](.*?)\[\/player'.$i.'\]/is', '', $text);
		if(preg_match('/\[player'.$i.'\]/',$player1) && preg_match('/\[\/player'.$i.'\]/',$player1)){
		$j = $i+1;
		$player2 = preg_replace('/\[\/player'.$i.'\](.*?)\[\/message\]/is', '', $text);
		$player1 = preg_replace('/\[player'.$i.'\]/', '[player'.$j.']', $player1);
		$player1 = preg_replace('/\[\/player'.$i.'\]/', '[/player'.$j.']', $player1);
		$text = $player2."[/player".$i."]".$player1;
		$player += 1;
		}
		}
		}
		for($i=0;$i<=$coor;$i++){
		if(preg_match('/\[coor'.$i.'\]/',$text) && preg_match('/\[\/coor'.$i.'\]/',$text)){
		$coor1 = preg_replace('/\[message\](.*?)\[\/coor'.$i.'\]/is', '', $text);
		if(preg_match('/\[coor'.$i.'\]/',$coor1) && preg_match('/\[\/coor'.$i.'\]/',$coor1)){
		$j = $i+1;
		$coor2 = preg_replace('/\[\/coor'.$i.'\](.*?)\[\/message\]/is', '', $text);
		$coor1 = preg_replace('/\[coor'.$i.'\]/', '[coor'.$j.']', $coor1);
		$coor1 = preg_replace('/\[\/coor'.$i.'\]/', '[/coor'.$j.']', $coor1);
		$text = $coor2."[/coor".$i."]".$coor1;
		$coor += 1;
		}
		}
		}
		for($i=0;$i<=$report;$i++){
		if(preg_match('/\[report'.$i.'\]/',$text) && preg_match('/\[\/report'.$i.'\]/',$text)){
		$report1 = preg_replace('/\[message\](.*?)\[\/report'.$i.'\]/is', '', $text);
		if(preg_match('/\[report'.$i.'\]/',$report1) && preg_match('/\[\/report'.$i.'\]/',$report1)){
		$j = $i+1;
		$report2 = preg_replace('/\[\/report'.$i.'\](.*?)\[\/message\]/is', '', $text);
		$report1 = preg_replace('/\[report'.$i.'\]/', '[report'.$j.']', $report1);
		$report1 = preg_replace('/\[\/report'.$i.'\]/', '[/report'.$j.']', $report1);
		$text = $report2."[/report".$i."]".$report1;
		$report += 1;
		}
		}
		}
		$database->sendMessage($user, $session->uid, htmlspecialchars(addslashes($topic)), htmlspecialchars(addslashes($text)), 0, $alliance, $player, $coor, $report);
		}
	}

	//7 = village, attacker, att tribe, u1 - u10, lost %, w,c,i,c , cap
	//8 = village, attacker, att tribe, enforcement
	private function sendNotice($from, $vid, $fowner, $owner, $type, $extra) {

	}

	public function sendWelcome($uid, $username) {
		global $database;
		$welcomemsg = file_get_contents("GameEngine/Admin/welcome.tpl");
		$welcomemsg = preg_replace("'%USER%'", $username, $welcomemsg);
		$welcomemsg = preg_replace("'%START%'", date("y.m.d", COMMENCE), $welcomemsg);
		$welcomemsg = preg_replace("'%TIME%'", date("H:i", COMMENCE), $welcomemsg);
		$welcomemsg = preg_replace("'%PLAYERS%'", $database->countUser(), $welcomemsg);
		$welcomemsg = preg_replace("'%ALLI%'", $database->countAlli(), $welcomemsg);
		$welcomemsg = preg_replace("'%SERVER_NAME%'", SERVER_NAME, $welcomemsg);
                $welcomemsg = preg_replace("'%PROTECTION%'", (PROTECTION/3600), $welcomemsg);
		$welcomemsg = "[message]".$welcomemsg."[/message]";
		return $database->sendMessage($uid, 1, WEL_TOPIC, addslashes($welcomemsg), 0, 0, 0, 0, 0);
	}

	private function wordCensor($text) {
		$censorarray = explode(",", CENSORED);
		foreach($censorarray as $key => $value) {
			$censorarray[$key] = "/" . $value . "/i";
		}
		return preg_replace($censorarray, "****", $text);
	}

	private function checkUnread() {
		foreach($this->inbox as $message) {
			if($message['viewed'] == 0) {
				return true;
			}
		}
		return false;
	}

	private function checkNUnread() {
		foreach($this->allNotice as $notice) {
			if($notice['viewed'] == 0) {
				return true;
			}
		}
		return false;
	}

	private function findInbox($id) {
		foreach($this->inbox as $message) {
			if($message['id'] == $id) {
				return true;
			}
		}
		return false;
	}

	private function findSent($id) {
		foreach($this->sent as $message) {
			if($message['id'] == $id) {
				return true;
			}
		}
		return false;
	}

	private function findArchive($id) {
		foreach($this->archived as $message) {
			if($message['id'] == $id) {
				return true;
			}
		}
		return false;
	}

	public function addFriends($post) {
		global $database;
		for($i=0;$i<=19;$i++) {
		if($post['addfriends'.$i] != ""){
		$uid = $database->getUserField($post['addfriends'.$i], "id", 1);
		$added = 0;
		for($j=0;$j<=$i;$j++) {
		if($added == 0){
		$user = $database->getUserField($post['myid'], "friend".$j, 0);
		$userwait = $database->getUserField($post['myid'], "friend".$j."wait", 0);
		$exist = 0;
		for($k=0;$k<=19;$k++){
		$user1 = $database->getUserField($post['myid'], "friend".$k, 0);
		if($user1 == $uid or $uid == $post['myid']){
		$exist = 1;
		}
		}
		if($user == 0 && $userwait == 0 && $exist == 0){
		$added1 = 0;
		for($l=0;$l<=19;$l++){
		$user2 = $database->getUserField($uid, "friend".$l, 0);
		$userwait2 = $database->getUserField($uid, "friend".$l."wait", 0);
		if($user2 == 0 && $userwait2 == 0 && $added1 == 0){
		$database->addFriend($uid,"friend".$l."wait",$post['myid']);
		$added1 = 1;
		}
		}
		$database->addFriend($post['myid'],"friend".$j,$uid);
		$database->addFriend($post['myid'],"friend".$j."wait",$uid);
		$added = 1;
		}
		}
		}
		}
		}
		header("Location: nachrichten.php?t=1");
	}

}
;
