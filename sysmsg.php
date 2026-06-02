<?php
include_once("GameEngine/Generator.php");
$start_timer = $generator->pageLoadTimeStart();

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : sysmsg.tpl                                                ##
##  Type           : Admin Panel System Messages                               ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki (Original)                                          ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2025. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

use App\Utils\AccessLogger;

include_once("GameEngine/Account.php");
include_once("GameEngine/Village.php");
AccessLogger::logRequest();

$max_per_pass = 1000;

// Default flow flags used later in template conditions.
$NextStep = false;
$NextStep2 = false;
$done = false;
$Interupt = false;

if (mysqli_num_rows(mysqli_query($database->dblink,"SELECT id FROM ".TB_PREFIX."users WHERE access = 9 AND id = ".$session->uid))!= '1') die("Hacking attempt!");

if(isset($_GET['del'])){
    mysqli_query($database->dblink, "UPDATE ".TB_PREFIX."users SET ok = 0");
}

if (@$_POST['submit'] == "Send")
{
	unset ($_SESSION['m_message']);
	$_SESSION['m_message'] = $_POST['message'];
	$NextStep = true;
}

if (@isset($_POST['confirm']))
{
	if ($_POST['confirm'] == 'No' ) $Interupt = true;
	if ($_POST['confirm'] == 'Yes'){

		if(file_exists("Templates/text.tpl")) {

		$myFile = "Templates/text.tpl";
		$fh = fopen($myFile, 'w') or die("<br/><br/><br/>Can't open file: templates/text.tpl");
		$text = file_get_contents("Templates/text_format.tpl");
		$text = preg_replace("'%TEKST%'",str_replace('"', '\\"', $_SESSION['m_message']),$text);
		fwrite($fh, $text);

		mysqli_query($database->dblink, "UPDATE ".TB_PREFIX."users SET ok = 1");

		$done = true;
		} else { die("<br/><br/><br/>wrong"); }
}}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo SERVER_NAME?> - System Message</title>
	<link rel="shortcut icon" href="favicon.ico"/>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

	<script src="mt-full.js?0ac37" type="text/javascript"></script>
	<script src="unx.js?f4b7h" type="text/javascript"></script>
	<script src="new.js?0ac37" type="text/javascript"></script>
	<link href="<?php echo GP_LOCATE;?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE;?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />
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
	<script type="text/javascript">window.addEvent('domready', start);</script>
</head>

<body class="v35 ie ie8">
<div class="wrapper">
<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" />
<div id="dynamic_header"></div>
<?php include("Templates/header.tpl");?>
<div id="mid">
<?php include("Templates/menu.tpl");?>

<div id="content" class="login">

<?php if (@!$NextStep && @!$NextStep2 && @!$done){?>
<div style="width:100%; max-width:500px; margin-top:50px; position:relative; z-index:5;">
<form method="post" action="sysmsg.php" name="myform" id="myform">
  <div style="background:#fff; border:1px solid #b3b3b3; border-radius:10px; overflow:hidden; box-shadow:0 1px 2px rgba(0,0,0,.06);">
    <div style="background:linear-gradient(#f8f8f8,#ededed); padding:7px; text-align:center; font-weight:bold; border-bottom:1px solid #d0d0d0; font-size:12px;">System Message Global</div>
    <div style="background:#fafafa; padding:5px; text-align:center; font-size:11px; color:#444; border-bottom:1px solid #e5e5e5;">
      BBCode:
      <span style="background:#fff; border:1px solid #ddd; padding:1px 4px; border-radius:3px; margin:0 2px;"><b>[b]bold[/b]</b></span>
      <span style="background:#fff; border:1px solid #ddd; padding:1px 4px; border-radius:3px; margin:0 2px;"><i>[i]italic[/i]</i></span>
      <span style="background:#fff; border:1px solid #ddd; padding:1px 4px; border-radius:3px; margin:0 2px;"><u>[u]underline[/u]</u></span>
    </div>
    <div style="padding:8px;">
      <textarea class="fm" name="message" cols="60" rows="18" style="width:100%; height:260px; border:1px solid #aeaeae; border-radius:6px; padding:8px; box-sizing:border-box; font-family:Verdana; font-size:12px; background:#fcfcfc;" placeholder="Scrie aici mesajul care va apărea pentru TOȚI jucătorii..."></textarea>
    </div>
    <div style="display:flex; justify-content:space-between; align-items:center; padding:7px 9px; background:#f5f5f5; border-top:1px solid #e0e0e0;">
      <a href="sysmsg.php?del" style="color:#4caf50; font-size:11px; font-weight:bold; text-decoration:none;">✖ Delete old System Message</a>
      <input type="submit" value="Trimite Mesaj" name="submit" style="background:#519e2e; color:#fff; border:1px solid #3d7a22; padding:6px 16px; border-radius:6px; font-weight:bold; cursor:pointer; font-size:12px;" />
    </div>
  </div>
</form>
</div>

<?php }elseif (@$NextStep){?>
<div style="width:100%; max-width:500px;">
  <div style="background:#fff; border:1px solid #b3b3b3; border-radius:10px; overflow:hidden;">
    <div style="background:#f0f0f0; padding:7px; text-align:center; font-weight:bold; border-bottom:1px solid #d0d0d0;">Confirmare</div>
    <div style="padding:14px; text-align:center; font-size:12px;">
      <p>Chiar vrei să trimiți System Message?</p>
      <form method="post" action="sysmsg.php">
        <input type="submit" class="fm" name="confirm" value="Yes" style="width:110px; margin-right:8px; background:#519e2e; color:#fff; border:1px solid #3d7a22; padding:5px; border-radius:5px; cursor:pointer;" />
        <input type="submit" class="fm" name="confirm" value="No" style="width:110px; background:#e0e0e0; border:1px solid #aaa; padding:5px; border-radius:5px; cursor:pointer;" />
      </form>
      <div style="margin-top:12px; text-align:left;">
        <div style="font-size:11px; color:#666; margin-bottom:4px;">Previzualizare:</div>
        <div style="background:#fcfcfc; border:1px dashed #bbb; padding:8px; border-radius:5px; min-height:60px;">
        <?php
        $txt=$_SESSION['m_message'];
        $txt = preg_replace("/\[b\]/is",'<b>', $txt);
        $txt = preg_replace("/\[\/b\]/is",'</b>', $txt);
        $txt = preg_replace("/\[i\]/is",'<i>', $txt);
        $txt = preg_replace("/\[\/i\]/is",'</i>', $txt);
        $txt = preg_replace("/\[u\]/is",'<u>', $txt);
        $txt = preg_replace("/\[\/u\]/is",'</u>', $txt);
        echo nl2br($txt);
      ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php }elseif (@$Interupt){?>
<div style="padding:20px; text-align:center; font-weight:bold; color:#b00000; border:1px solid #ccc; background:#fff; max-width:500px; border-radius:8px;"><b><?php echo MASS_ABORT;?></b></div>

<?php }elseif (@$done){?>
<div style="padding:20px; text-align:center; font-weight:bold; color:#2e7d32; border:1px solid #ccc; background:#fff; max-width:500px; border-radius:8px;">✓ System Message a fost trimis!</div>

<?php }else{die("Something is wrong");}?>
</div>

<div id="side_info" class="outgame">
<?php
include("Templates/multivillage.tpl");
include("Templates/quest.tpl");
include("Templates/news.tpl");
if (!NEW_FUNCTIONS_DISPLAY_LINKS) {
    echo "<br><br><br><br>";
    include("Templates/links.tpl");
}
?>
</div>

<div class="clear"></div>
</div>

<div class="footer-stopper outgame"></div>
<div class="clear"></div>

<?php
include("Templates/footer.tpl");
include("Templates/res.tpl");
?>
<div id="stime">
    <div id="ltime">
        <div id="ltimeWrap">
            <?php echo CALCULATED_IN;?> <b><?php echo round(($generator->pageLoadTimeEnd() - $start_timer) * 1000);?></b> ms
            <br /><?php echo SERVER_TIME;?> <span id="tp1" class="b"><?php echo date('H:i:s');?></span>
        </div>
    </div>
</div>
<div id="ce"></div>
</body>
</html>