<?php
include_once("GameEngine/Generator.php");
$start_timer = $generator->pageLoadTimeStart();

#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =- 			                   ##
## --------------------------------------------------------------------------- ##
## Project:     TravianZ 							                           ##
## Version:     01.06.2018 							                           ##
## Description: When an Admin/MH starts a maintenance                          ##
##              this page will be showed                                       ##
## Authors:     iopietro      		                                           ##
## Page:        maintenance.php                                      		   ##
## License:     TravianZ Project 						                       ##
## Copyright:   TravianZ (c) 2010-2018. All rights reserved. 			       ##
## URLs:        http://travian.shadowss.ro 					                   ##
## Source code: https://github.com/Shadowss/TravianZ/	 			           ##
## 										                                       ##
#################################################################################

use App\Utils\AccessLogger;

if (!function_exists('mysqli_result')) {
    function mysqli_result($res, $row, $field = 0) {
        $res->data_seek($row);
        $datarow = $res->fetch_array();
        return $datarow[$field];
    }
}

include_once("GameEngine/Village.php");
AccessLogger::logRequest();

if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	header("Location: ".$_SERVER['PHP_SELF']);
	exit;
}

if($_SESSION['ok'] == 2){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?php echo SERVER_NAME ?> - Game Over</title>
		<link rel="shortcut icon" href="favicon.ico"/>
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="imagetoolbar" content="no" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<script src="mt-full.js?0faab" type="text/javascript"></script>
		<script src="unx.js?f4b7h" type="text/javascript"></script>
		<script src="new.js?0faab" type="text/javascript"></script>
		<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css" />
		<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />
		<?php
		if($session->gpack == null || GP_ENABLE == false)
		{
			echo "
			<link href='".GP_LOCATE."travian.css?e21d2' rel='stylesheet' type='text/css' />
			<link href='".GP_LOCATE."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
		}
		else
		{
			echo "
			<link href='".$session->gpack."travian.css?e21d2' rel='stylesheet' type='text/css' />
			<link href='".$session->gpack."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
		}
		?>
		<script type="text/javascript">window.addEvent('domready', start);</script>
		<style type="text/css">
		.style1 {
		 text-align: center;
		}
		.style2 {
		 border-width: 0px;
		}
		</style>
	</head>
	<body class="v35 ie ie8">
		<div class="wrapper">
			<img style="filter: chroma();" src="img/x.gif" id="msfilter" alt="" />
			<div id="dynamic_header"></div>
			<?php include("Templates/header.tpl"); ?>
			<div id="mid">
				<?php include("Templates/menu.tpl"); ?>
				<div id="content" class="village2" style="font-size: 20pt;text-align: center">
					<p><b>Presently, the server is not available due to maintenance.</b></p>
					<img src="img/lol.PNG">
					<p><b>This take a few minutes. In the meantime you can drink a coffee.</b></p>
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
			include("Templates/res.tpl");
			include("Templates/footer.tpl");
			?>
			<div id="stime">
				<div id="ltime">
					<div id="ltimeWrap">
						<?php echo CALCULATED_IN;?> <b><?php
echo round(($generator->pageLoadTimeEnd()-$start_timer)*1000);
?></b> ms

<br /><?php echo SEVER_TIME;?> <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
					</div>
				</div>
			</div>
		<div id="ce">
	</body>
</html>
<?php
}else{
    header("Location: dorf1.php");
    exit;
}
?>
