<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       sysmsg.php                                                  ##
##  Developed by:  Dixie                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

use App\Utils\AccessLogger;

include_once("GameEngine/Account.php");
AccessLogger::logRequest();

$max_per_pass = 1000;
if (mysqli_num_rows(mysqli_query($database->dblink,"SELECT id FROM ".TB_PREFIX."users WHERE access = 9 AND id = ".$session->uid)) != '1') die("Hacking attempt!");

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
		$text = preg_replace("'%TEKST%'",str_replace('"', '\\"', $_SESSION['m_message']) ,$text);
		// the following is not really needed and results in fhe file starting with BOM which gets displayed when the message is shown
		// ... also, this very much depends on the underlying system and utf8_encode() is only good if the system is defaulted to ISO-8859-1
		// $text = utf8_encode($text);
		fwrite($fh, $text);

		mysqli_query($database->dblink, "UPDATE ".TB_PREFIX."users SET ok = 1");

		$done = true;
		} else { die("<br/><br/><br/>wrong"); }
}}

?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo SERVER_NAME ?> - System Message</title>
	<link rel="shortcut icon" href="favicon.ico"/>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

	<script src="mt-full.js?0ac37" type="text/javascript"></script>
	<script src="unx.js?f4b7h" type="text/javascript"></script>
	<script src="new.js?0ac37" type="text/javascript"></script>
	<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />
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
	</script>
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
	</script>
</head>


<body class="v35 ie ie8">
<div class="wrapper">
<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" />
<div id="dynamic_header">
	</div>
<?php include("Templates/header.tpl"); ?>
<div id="mid">
<?php include("Templates/menu.tpl"); ?>

<div id="content"  class="login">
<?php if (@!$NextStep && @!$NextStep2 && @!$done){?>
<form method="post" action="sysmsg.php" name="myform" id="myform">
			<table cellspacing="1" cellpadding="1" class="tbg" style="background-color:#C0C0C0; border: 0px solid #C0C0C0; font-size: 10pt;">
			  <tbody>
				<tr>
				  <td class="rbg" style="font-size: 10pt; text-align:center;">System Message</td>
				</tr>
				<tr>
				  <td style="font-size: 10pt; text-align:center;">Text BBCode:<br /><b>[b] txt [/b]</b> - <i>[i] txt [/i]</i> - <u>[u] txt [/u]</u> <br />
			<textarea class="fm" name="message" cols="60" rows="23"></textarea></td>
				</tr>
				<tr>
				  <td style="text-align:center;">All fields required</td>
				</tr>
				<tr>
				  <td style="text-align:center;">
					<input type="submit" value="Send" name="submit" />    </td>
				</tr>
			  </tbody>
			</table>
			</form>
<a href="sysmsg.php?del">Delete old System Message</a>
<?php }elseif (@$NextStep){?>
<form method="post" action="sysmsg.php">
			<table cellspacing="1" cellpadding="2" class="tbg">
			  <tbody>
				<tr>
				  <td class="rbg" colspan="2">Confirmation</td>
				</tr>
				<tr>
				  <td style="text-align: left; width: 200px;">Do you really want to send System Message?</td>
				  <td style="text-align: left;">
					<input type="submit" style="width: 240px;" class="fm" name="confirm" value="Yes" />
					<input type="submit" style="width: 240px;" class="fm" name="confirm" value="No" /></td>
				</tr>
			  </tbody>
			</table>
</form>
Example: (BBCode or quotation marks (" ") doesn't work over here!)
<?php
$txt=$_SESSION['m_message'];
$txt = preg_replace("/\[b\]/is",'<b>', $txt);
$txt = preg_replace("/\[\/b\]/is",'</b>', $txt);
$txt = preg_replace("/\[i\]/is",'<i>', $txt);
$txt = preg_replace("/\[\/i\]/is",'</i>', $txt);
$txt = preg_replace("/\[u\]/is",'<u>', $txt);
$txt = preg_replace("/\[\/u\]/is",'</u>', $txt);
echo ($txt);

}elseif (@$Interupt){?>
<b><?php echo MASS_ABORT; ?></b>

<?php }elseif (@$done){?>
System Message was sent
<?php }else{die("Something is wrong");}?>
</div>
<div id="side_info" class="outgame">
</div>

<div class="clear"></div>
			</div>

			<div class="footer-stopper outgame"></div>
			<div class="clear"></div>

<?php include("Templates/footer.tpl"); ?>
<div id="ce"></div>
</body>
</html>