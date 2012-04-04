<?php

/*
|--------------------------------------------------------------------------
|   PLEASE DO NOT REMOVE THIS COPYRIGHT NOTICE!
|--------------------------------------------------------------------------  
|
|   Project owner:   Dzoki < dzoki.travian@gmail.com >
|  
|   This script is property of TravianX Project. You are allowed to change
|   its source and release it under own name, not under name `TravianX`. 
|   You have no rights to remove copyright notices.
|
|   TravianX All rights reserved
|
*/

       include ("GameEngine/Village.php");
       include ("GameEngine/Chat.php");
       $start = $generator->pageLoadTimeStart();
       $alliance->procAlliance($_GET);
if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	if(isset($_GET['s'])){
	header("Location: ".$_SERVER['PHP_SELF']."?s=".$_GET['s']);
	}else if(isset($_GET['aid'])){
	header("Location: ".$_SERVER['PHP_SELF']."?aid=".$_GET['aid']);
	}
	else{
	header("Location: ".$_SERVER['PHP_SELF']);
}
}
	   if(isset($_GET['s'])){
		$automation->isWinner();
		}
if($_GET['aid'] or $session->alliance!=0){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php

       echo SERVER_NAME

?></title>
    <link REL="shortcut icon" HREF="favicon.ico"/>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-full.js?0faaa" type="text/javascript"></script>
	<script src="unx.js?0faaa" type="text/javascript"></script>
	<script src="new.js?0faaa" type="text/javascript"></script>
	<link href="<?php

       echo GP_LOCATE;

?>lang/en/lang.css?f4b7c" rel="stylesheet" type="text/css" />
	<link href="<?php

       echo GP_LOCATE;

?>lang/en/compact.css?f4b7c" rel="stylesheet" type="text/css" />
	<?php

       if($session->gpack == null || GP_ENABLE == false) {
       	echo "
	<link href='" . GP_LOCATE . "travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='" . GP_LOCATE . "lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
       } else {
       	echo "
	<link href='" . $session->gpack . "travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='" . $session->gpack . "lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
       }

?>
	<script type="text/javascript">

		window.addEvent('domready', start);
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

       include ("Templates/menu.tpl");

       if(isset($_GET['s']) && $_GET['s'] == 2) {
       	echo '<div id="content"  class="forum">';
       } else {
       	echo '<div id="content"  class="alliance">';
       }

       if(isset($_GET['s'])) {
       	switch($_GET['s']) {
       		case 2:
       			include ("Templates/Alliance/forum.tpl");
       			break;
       		case 3:
       			include ("Templates/Alliance/attacks.tpl");
       			break;
       		case 4:
       			include ("Templates/Alliance/news.tpl");
       			break;
       		case 5:
       			include ("Templates/Alliance/option.tpl");
       			break;
       		case 6:
       			include ("Templates/Alliance/chat.tpl");
       			break;
       		case 1:
       		default:
       			include ("Templates/Alliance/overview.tpl");
       			break;
       	}
       	// Options
       } elseif(isset($_POST['o'])) {
       	switch($_POST['o']) {
       		case 1:
       			if(isset($_POST['s']) == 5 && isset($_POST['a_user'])) {
       				$alliance->procAlliForm($_POST);
       				//echo "Funcion para el cambio de nombre de la alianza";
       				include ("Templates/Alliance/changepos.tpl");
       			} else {
       				include ("Templates/Alliance/assignpos.tpl");
       			}
       			break;
       		case 2:
       			if(isset($_POST['s']) == 5 && isset($_POST['a']) == 2) {
       				$alliance->procAlliForm($_POST);
       				include ("Templates/Alliance/kick.tpl");
       			} else {
       				include ("Templates/Alliance/kick.tpl");
       			}
       			break;
       		case 3:
       			if(isset($_POST['s']) == 5 && isset($_POST['a']) == 3) {
       				$alliance->procAlliForm($_POST);
       				//echo "Funcion para el cambio de nombre de la alianza";
       				include ("Templates/Alliance/allidesc.tpl");
       			} else {
       				include ("Templates/Alliance/allidesc.tpl");
       			}
       			break;
       		case 4:
       			if(isset($_POST['s']) == 5 && isset($_POST['a']) == 4) {
       				$alliance->procAlliForm($_POST);
       				//echo "Funcion para el cambio de nombre de la alianza";
       				include ("Templates/Alliance/invite.tpl");
       			} else {
       				include ("Templates/Alliance/invite.tpl");
       			}
       			break;
       		case 5:
       			include ("Templates/Alliance/linkforum.tpl");
       			break;
       		case 6:
       			if(isset($_POST['dipl']) and isset($_POST['a_name'])) {
       				$alliance->procAlliForm($_POST);
       				include ("Templates/Alliance/chgdiplo.tpl");
       			} else {
       				include ("Templates/Alliance/chgdiplo.tpl");
       			}
       			break;
       		case 11:
       			if(isset($_POST['s']) == 5 && isset($_POST['a']) == 11) {
       				$alliance->procAlliForm($_POST);
       				//echo "Funcion para el cambio de nombre de la alianza";
       				include ("Templates/Alliance/quitalli.tpl");
       			} else {
       				include ("Templates/Alliance/quitalli.tpl");
       			}
       			break;
       		default:
       			include ("Templates/Alliance/option.tpl");
       			break;
       		case 100:
       			if(isset($_POST['s']) == 5 && isset($_POST['a']) == 100) {
       				$alliance->procAlliForm($_POST);
       				//echo "Funcion para el cambio de nombre de la alianza";
       				include ("Templates/Alliance/changename.tpl");
       			} else {
       				include ("Templates/Alliance/changename.tpl");
       			}
       			break;
       		case 101:
       			$post = $_POST['id'];
       			$database->diplomacyCancelOffer($post);
       			include ("Templates/Alliance/chgdiplo.tpl");
       			break;
       		case 102:
       			$post = $_POST['id'];
       			$post2 = $_POST['alli2'];
       			$database->diplomacyInviteDenied($post, $post2);
       			include ("Templates/Alliance/chgdiplo.tpl");
       			break;
       		case 103:
       			$post = $_POST['id'];
       			$post2 = $_POST['alli2'];
       			$database->diplomacyInviteAccept($post, $post2);
       			include ("Templates/Alliance/chgdiplo.tpl");
       			break;
       		case 104:
       			$post = $_POST['id'];
       			$post2 = $_POST['alli2'];
       			$database->diplomacyCancelExistingRelationship($post, $post2);
       			include ("Templates/Alliance/chgdiplo.tpl");
       	}
       } else {

       	include ("Templates/Alliance/overview.tpl");
       }

?>
</div>
<div id="side_info">
<?php

       include ("Templates/quest.tpl");
       include ("Templates/news.tpl");
       include ("Templates/multivillage.tpl");
       include ("Templates/links.tpl");

?>
</div>
<div class="clear"></div>
</div>
<div class="footer-stopper"></div>
<div class="clear"></div>

<?php

       include ("Templates/footer.tpl");
       include ("Templates/res.tpl");

?>
<div id="stime">
<div id="ltime">
<div id="ltimeWrap">
<?php

       echo CALCULATED;

?> <b><?php

       echo round(($generator->pageLoadTimeEnd() - $start) * 1000);

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
header("Location: dorf1.php");
}