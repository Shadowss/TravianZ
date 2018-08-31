<?php
include_once("GameEngine/Generator.php");
$start_timer = $generator->pageLoadTimeStart();

//fix by ronix
use App\Utils\AccessLogger;

if(isset($_GET['aid']) && !is_numeric($_GET['aid'])) 
{
    header("location: allianz.php"); 
    exit;
}

include_once("GameEngine/Village.php");
include_once("GameEngine/Chat.php");
AccessLogger::logRequest();

$alliance->procAlliance($_GET);
if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	if(isset($_GET['s'])){
		header("Location: ".$_SERVER['PHP_SELF']."?s=".preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['s']));
		exit;
	}else if(isset($_GET['aid'])){
		header("Location: ".$_SERVER['PHP_SELF']."?aid=".preg_replace("/[^a-zA-Z0-9_-]/","",$_GET['aid']));
		exit;
	}else{
		header("Location: ".$_SERVER['PHP_SELF']);
		exit;
	}
}

if(isset($_GET['fid']) || isset($_GET['fid2'])){
	$fid = preg_replace("/[^0-9]/","",!empty($_GET['fid']) ? $_GET['fid'] : $_GET['fid2']);
	$forumInfos = $database->ForumCatEdit($fid);
	
	if(empty($forumInfos)){
		header("Location: ".$_SERVER['PHP_SELF']);
		exit;
	}
	
	$forum_type = reset($forumInfos);
	if (!empty($forum_type)) {
		if($forum_type['forum_area'] != 1 && !$alliance->isForumAccessible($fid)){
			if($forum_type['alliance'] != $session->alliance){
				header("Location: ".$_SERVER['PHP_SELF']);
				exit;
			}
		}
	}
}
if(isset($_GET['aid']) || isset($_GET['fid']) || isset($_GET['fid2']) ||
		$session->alliance > 0 || ($session->alliance == 0 && isset($_GET['s']) && $_GET['s'] == 2)){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php
	echo SERVER_NAME.' &raquo; &raquo; &raquo; Alliance ';
	
	if(!empty($_GET['s'])){
		switch($_GET['s']){
			case '2' :
				if($session->alliance == 0) echo 'Forum (No alliance)';
				else echo 'Forum ('.$alliance->allianceArray['tag'].' - '.$alliance->allianceArray['name'].')';
				break;
			
			case '6' :
				echo 'Chat ('.$alliance->allianceArray['tag'].' - '.$alliance->allianceArray['name'].')';
				break;
			
			case '3' :
				echo 'Attacks ('.$alliance->allianceArray['tag'].' - '.$alliance->allianceArray['name'].')';
				break;
			
			case '4' :
				echo 'News ('.$alliance->allianceArray['tag'].' - '.$alliance->allianceArray['name'].')';
				break;
			
			case '5' :
				echo 'Options ('.$alliance->allianceArray['tag'].' - '.$alliance->allianceArray['name'].')';
				break;
		}
	}
	else echo $alliance->allianceArray['tag'].' - '.$alliance->allianceArray['name'];

?></title>
	<link rel="shortcut icon" href="favicon.ico"/>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-full.js?0faab" type="text/javascript"></script>
	<script src="unx.js?f4b7h" type="text/javascript"></script>
	<script src="new.js?0faab" type="text/javascript"></script>
	<link href="<?php

	   echo GP_LOCATE;

?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css" />
	<link href="<?php

	   echo GP_LOCATE;

?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />
	<?php

	   if($session->gpack == null || GP_ENABLE == false) {
		echo "
	<link href='".GP_LOCATE."travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='".GP_LOCATE."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
	   } else {
		echo "
	<link href='".$session->gpack."travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='".$session->gpack."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
	   }

?>
	<script type="text/javascript">

		window.addEvent('domready', start);
				function getMouseCoords(e) {
					var coords = {};
					if (!e) var e = window.event;
					if (e.pageX || e.pageY) 	{
						coords.x = e.pageX;
						coords.y = e.pageY;
					}
					else if (e.clientX || e.clientY) 	{
						coords.x = e.clientX + document.body.scrollLeft
							+ document.documentElement.scrollLeft;
						coords.y = e.clientY + document.body.scrollTop
							+ document.documentElement.scrollTop;
					}
					return coords;
				}

				function med_mouseMoveHandler(e, desc_string){
					var coords = getMouseCoords(e);
					med_showDescription(coords, desc_string);
				}

				function med_closeDescription(){
					var layer = document.getElementById("medal_mouseover");
					layer.className = "hide";
				}

				function init_local(){
					med_init();
				}

				function med_init(){
					layer = document.createElement("div");
					layer.id = "medal_mouseover";
					layer.className = "hide";
					document.body.appendChild(layer);
				}

				function med_showDescription(coords, desc_string){
					var layer = document.getElementById("medal_mouseover");
					layer.style.top = (coords.y + 25)+ "px";
					layer.style.left = (coords.x - 20) + "px";
					layer.className = "";
					layer.innerHTML = desc_string;
				}
	</script>
</head>


<body class="v35 ie ie8">
<div class="wrapper">
<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" />
<div id="dynamic_header">
	</div>
<?php
	   include ("Templates/header.tpl");

?>
<div id="mid">
<?php
$userPermissions = $database->getAlliPermissions($session->uid, $session->alliance, 0);
	include ("Templates/menu.tpl");
	
	if(isset($_GET['s']) && $_GET['s'] == 2) echo '<div id="content"  class="forum">';
	else echo '<div id="content"  class="alliance">';
	
	if(isset($_GET['s'])){
		if($_GET['s'] != 5 || $session->sit == 0){
			switch($_GET['s']){
				case 2 :
					if(isset($_POST['vote'])) $alliance->Vote($_POST);
					include("Templates/Alliance/forum.tpl");
					break;
				case 3:
					include("Templates/Alliance/attacks.tpl");
					break;
				case 4:
					include("Templates/Alliance/news.tpl");
					break;
				case 5:
					include("Templates/Alliance/option.tpl");
					break;
				case 6:
					include("Templates/Alliance/chat.tpl");
					break;
				case 1:
				default:
					include("Templates/Alliance/overview.tpl");
					break;
			}
			// Options
		}else{
			header("Location: ".$_SERVER['PHP_SELF']);
			exit();
		}
	}else if(isset($_GET['delinvite'])){
		if($userPermissions['opt4'] == 0) $alliance->redirect();
		include ("Templates/Alliance/invite.tpl");
	}elseif(isset($_POST['o'])){
		switch($_POST['o']){
			case 1 :
				if($userPermissions['opt1'] == 0) $alliance->redirect();
				if(isset($_POST['s']) == 5 && isset($_POST['a_user'])){
					$alliance->procAlliForm($_POST);
					include("Templates/Alliance/changepos.tpl");
				}
				else include("Templates/Alliance/assignpos.tpl");
				break;
			case 2 :
				if($userPermissions['opt2'] == 0) $alliance->redirect();
				if(isset($_POST['s']) == 5 && isset($_POST['a']) == 2) $alliance->procAlliForm($_POST);
				include("Templates/Alliance/kick.tpl");
				break;
			case 3 :
				if($userPermissions['opt3'] == 0) $alliance->redirect();
				if(isset($_POST['s']) == 5 && isset($_POST['a']) == 3) $alliance->procAlliForm($_POST);
				include("Templates/Alliance/allidesc.tpl");
				break;
			case 4 :
				if($userPermissions['opt4'] == 0) $alliance->redirect();
				if(isset($_POST['s']) == 5 && isset($_POST['a']) == 4) $alliance->procAlliForm($_POST);
				include("Templates/Alliance/invite.tpl");
				break;
			case 5 :
				if($userPermissions['opt5'] == 0) $alliance->redirect();
				if(isset($_POST['f_link'])) $alliance->setForumLink($_POST);
				include("Templates/Alliance/linkforum.tpl");
				break;
			case 6 :
				if($userPermissions['opt6'] == 0) $alliance->redirect();
				if(isset($_POST['dipl']) && isset($_POST['a_name'])) $alliance->procAlliForm($_POST);
				include("Templates/Alliance/chgdiplo.tpl");
				break;
			case 11 :
				if(isset($_POST['s']) == 5 && isset($_POST['a']) == 11) $alliance->procAlliForm($_POST);
				include("Templates/Alliance/quitalli.tpl");
				break;
			case 100 :
				if($userPermissions['opt3'] == 0) $alliance->redirect();
				if(isset($_POST['s']) == 5 && isset($_POST['a']) == 100) $alliance->procAlliForm($_POST);
				include("Templates/Alliance/changename.tpl");
				break;
			case 101 :
				if($userPermissions['opt6'] == 0) $alliance->redirect();
				if(isset($_POST['id'])) $database->diplomacyCancelOffer($_POST['id'], $session->alliance);
				include("Templates/Alliance/chgdiplo.tpl");
				break;
			case 102 :
				if($userPermissions['opt6'] == 0) $alliance->redirect();
				if(isset($_POST['id'])) $database->diplomacyInviteDenied($_POST['id'], $session->alliance);
				include("Templates/Alliance/chgdiplo.tpl");
				break;
			case 103 :
				if($userPermissions['opt6'] == 0) $alliance->redirect();
				if(isset($_POST['id'])) $database->diplomacyInviteAccept($_POST['id'], $session->alliance);
				include("Templates/Alliance/chgdiplo.tpl");
				break;
			case 104 :
				if($userPermissions['opt6'] == 0) $alliance->redirect();
				if(isset($_POST['id'])) $database->diplomacyCancelExistingRelationship($_POST['id'], $session->alliance);
				include("Templates/Alliance/chgdiplo.tpl");
				break;
			default :
				include("Templates/Alliance/option.tpl");
				break;
		}
	}
	else include("Templates/Alliance/overview.tpl");		
?>
</div>
<br /><br /><br /><br /><div id="side_info">
<?php
include("Templates/multivillage.tpl");
include("Templates/quest.tpl");
include("Templates/news.tpl");
if(!NEW_FUNCTIONS_DISPLAY_LINKS) {
	echo "<br><br><br><br>";
	include("Templates/links.tpl");
}
?>
</div>
<div class="clear"></div>
</div>
<div class="footer-stopper"></div>
<div class="clear"></div>

<?php
include("Templates/footer.tpl");
include("Templates/res.tpl");
?>

<div id="stime">
<div id="ltime">
<div id="ltimeWrap">
<?php

	   echo CALCULATED;

?> <b><?php

	   echo round(($generator->pageLoadTimeEnd() - $start_timer) * 1000);

?></b> ms

<br /><?php

	   echo SERVER_TIME;

?> <span id="tp1" class="b"><?php

	   echo date('H:i:s');

?></span>
</div>
	</div>
</div>

<div id="ce"></div>
</body>
</html>
<?php
}else{
	header("Location: spieler.php?uid=".$session->uid);
	exit;
}
?>