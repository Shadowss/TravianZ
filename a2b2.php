<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       a2b2.php                                                    ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################


include("GameEngine/Village.php");
$amount = $_SESSION['amount'];
$start = $generator->pageLoadTimeStart();
if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	header("Location: ".$_SERVER['PHP_SELF']);
}
else {
	$building->procBuild($_GET);
}
$automation->isWinner();
?>
    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo SERVER_NAME ?></title>
	<link REL="shortcut icon" HREF="favicon.ico"/>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-full.js?0faaa" type="text/javascript"></script>
	<script src="unx.js?0faaa" type="text/javascript"></script>
	<script src="new.js?0faaa" type="text/javascript"></script>
	<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7c" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7c" rel="stylesheet" type="text/css" />
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
<?php include("Templates/Plus/pmenu.tpl"); ?>
<h1>Account transactions</h1>
<div id="products">
<?        
if ($amount == 199) {
// Kontoauszug aufrufen f&uuml;r Goldpaket A
$MyGold = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysql_error());
$golds = mysql_fetch_array($MyGold);
$goldnow = $golds['6'] + 60; 
mysql_query("UPDATE ".TB_PREFIX."users set gold = '".$goldnow."' where `id`='".$session->uid."'") or die(mysql_error());
$MyGold = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysql_error());
$golds1 = mysql_fetch_array($MyGold);
?><p>Thank you for your purchase here at Travianist.com</p><p>Below you see the entry record.  Out of it, you can observe your old as well as your new account balance.</p> 
<table class="plusFunctions" cellpadding="1" cellspacing="1">
		<thead>
			<tr>

				<th colspan="5" height="20">Record of <?php echo date('d.m.Y'); ?></th>
			</tr>
			<tr>
				<td align="center">Description</td><td align="center"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" /></td><td align="center">Action</td><td align="center"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" /></td><td>Date</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="desc"><b>&nbsp;&nbsp;Account Balance (old)</b></td>
				<td class="desc"><center><? echo $golds['6']; ?></center></td>
				<td class="desc"><center><b>&nbsp;</b></center></td>
				<td class="desc"><center>&nbsp;</center></td>
                <td class="act"><center>&nbsp;</center></td>
             </tr>
             <tr>
				<td class="desc"><center><b>&nbsp;</b></center></td>
				<td class="desc"><center>&nbsp;</center></td>
				<td class="desc"><b><font color="#71D000"><center>Package</center></font></b></td>
				<td class="desc"><center>60 Gold</center></td>
                <td class="act"><center>&nbsp;</center></td>
			</tr>
            <tr>
				<td class="desc"><b>&nbsp;&nbsp;Account Balance (new)</b></td>
				<td class="desc"><center>&nbsp;</center></td>
				<td class="desc"><center><b>&nbsp;</b></center></td>
				<td class="desc"><center><? echo $golds1['6']; ?></center></td>
                <td class="act"><center><?php echo date('d.m.Y H:i:s'); ?></center></td>
			</tr>
             </tbody></table>
            <p>Please verify the information.<br />It will let us know if the data is incorrect.</p>
            <p>Please mail your username, package, order time and email used to <a href="mailto:diq@xygen.us">our billing address</a>.</p>
          
<?

}
if ($amount == 499) {
// Kontoauszug aufrufen f&uuml;r Goldpaket B
$MyGold = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysql_error());
$golds = mysql_fetch_array($MyGold);
$goldnow = $golds['6'] + 120; 
mysql_query("UPDATE ".TB_PREFIX."users set gold = '".$goldnow."' where `id`='".$session->uid."'") or die(mysql_error());
$MyGold = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysql_error());
$golds1 = mysql_fetch_array($MyGold);
?><p>Thank you for your purchase here at TravianX.</p><p>Below you see the entry record.  Out of it, you can observe your old as well as your new account balance.</p> 
<table class="plusFunctions" cellpadding="1" cellspacing="1">
		<thead>
			<tr>

				<th colspan="5" height="20">Record of <?php echo date('d.m.Y'); ?></th>
			</tr>
			<tr>
				<td align="center">Description</td><td align="center"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" /></td><td align="center">Action</td><td align="center"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" /></td><td>Date</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="desc"><b>&nbsp;&nbsp;Account Balance (old)</b></td>
				<td class="desc"><center><? echo $golds['6']; ?></center></td>
				<td class="desc"><center><b>&nbsp;</b></center></td>
				<td class="desc"><center>&nbsp;</center></td>
                <td class="act"><center>&nbsp;</center></td>
             </tr>
             <tr>
				<td class="desc"><center><b>&nbsp;</b></center></td>
				<td class="desc"><center>&nbsp;</center></td>
				<td class="desc"><b><font color="#71D000"><center>Zubuchung</center></font></b></td>
				<td class="desc"><center>60 Gold</center></td>
                <td class="act"><center>&nbsp;</center></td>
			</tr>
            <tr>
				<td class="desc"><b>&nbsp;&nbsp;Account Balance (new)</b></td>
				<td class="desc"><center>&nbsp;</center></td>
				<td class="desc"><center><b>&nbsp;</b></center></td>
				<td class="desc"><center><? echo $golds1['6']; ?></center></td>
                <td class="act"><center><?php echo date('d.m.Y H:i:s'); ?></center></td>
			</tr>
             </tbody></table>
                      <p>Please verify the information.<br />It will let us know if the data is incorrect.</p>
            <p>Please mail your username, package, order time and email used to <a href="mailto:diq@xygen.us">our billing address</a>.</p>
<?

}
if ($amount == 999) {
// Kontoauszug aufrufen f&uuml;r Goldpaket C
$MyGold = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysql_error());
$golds = mysql_fetch_array($MyGold);
$goldnow = $golds['6'] + 360; 
mysql_query("UPDATE ".TB_PREFIX."users set gold = '".$goldnow."' where `id`='".$session->uid."'") or die(mysql_error());
$MyGold = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysql_error());
$golds1 = mysql_fetch_array($MyGold);
?><p>Thank you for your purchase here at TravianX.</p><p>Below you see the entry record.  Out of it, you can observe your old as well as your new account balance.</p>
<table class="plusFunctions" cellpadding="1" cellspacing="1">
		<thead>
			<tr>

				<th colspan="5" height="20">Record of <?php echo date('d.m.Y'); ?></th>
			</tr>
			<tr>
				<td align="center">Description</td><td align="center"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" /></td><td align="center">Action</td><td align="center"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" /></td><td>Date</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="desc"><b>&nbsp;&nbsp;Account Balance (old)</b></td>
				<td class="desc"><center><? echo $golds['6']; ?></center></td>
				<td class="desc"><center><b>&nbsp;</b></center></td>
				<td class="desc"><center>&nbsp;</center></td>
                <td class="act"><center>&nbsp;</center></td>
             </tr>
             <tr>
				<td class="desc"><center><b>&nbsp;</b></center></td>
				<td class="desc"><center>&nbsp;</center></td>
				<td class="desc"><b><font color="#71D000"><center>Zubuchung</center></font></b></td>
				<td class="desc"><center>60 Gold</center></td>
                <td class="act"><center>&nbsp;</center></td>
			</tr>
            <tr>
				<td class="desc"><b>&nbsp;&nbsp;Account Balance (new)</b></td>
				<td class="desc"><center>&nbsp;</center></td>
				<td class="desc"><center><b>&nbsp;</b></center></td>
				<td class="desc"><center><? echo $golds1['6']; ?></center></td>
                <td class="act"><center><?php echo date('d.m.Y H:i:s'); ?></center></td>
			</tr>
             </tbody></table>
                       <p>Please verify the information.<br />It will let us know if the data is incorrect.</p>
            <p>Please mail your username, package, order time and email used to <a href="mailto:diq@xygen.us">our billing address</a>.</p>
<?

}
if ($amount == 1999) {
// Kontoauszug aufrufen f&uuml;r Goldpaket D
$MyGold = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysql_error());
$golds = mysql_fetch_array($MyGold);
$goldnow = $golds['6'] + 1000; 
mysql_query("UPDATE ".TB_PREFIX."users set gold = '".$goldnow."' where `id`='".$session->uid."'") or die(mysql_error());
$MyGold = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysql_error());
$golds1 = mysql_fetch_array($MyGold);
?><p>Thank you for your purchase here at TravianX.</p><p>Below you see the entry record.  Out of it, you can observe your old as well as your new account balance.</p>
<table class="plusFunctions" cellpadding="1" cellspacing="1">
		<thead>
			<tr>

				<th colspan="5" height="20">Record of <?php echo date('d.m.Y'); ?></th>
			</tr>
			<tr>
				<td align="center">Description</td><td align="center"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" /></td><td align="center">Action</td><td align="center"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" /></td><td>Date</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="desc"><b>&nbsp;&nbsp;Account Balance (old)</b></td>
				<td class="desc"><center><? echo $golds['6']; ?></center></td>
				<td class="desc"><center><b>&nbsp;</b></center></td>
				<td class="desc"><center>&nbsp;</center></td>
                <td class="act"><center>&nbsp;</center></td>
             </tr>
             <tr>
				<td class="desc"><center><b>&nbsp;</b></center></td>
				<td class="desc"><center>&nbsp;</center></td>
				<td class="desc"><b><font color="#71D000"><center>Zubuchung</center></font></b></td>
				<td class="desc"><center>60 Gold</center></td>
                <td class="act"><center>&nbsp;</center></td>
			</tr>
            <tr>
				<td class="desc"><b>&nbsp;&nbsp;Account Balance (new)</b></td>
				<td class="desc"><center>&nbsp;</center></td>
				<td class="desc"><center><b>&nbsp;</b></center></td>
				<td class="desc"><center><? echo $golds1['6']; ?></center></td>
                <td class="act"><center><?php echo date('d.m.Y H:i:s'); ?></center></td>
			</tr>
             </tbody></table>
                        <p>Please verify the information.<br />It will let us know if the data is incorrect.</p>
            <p>Please mail your username, package, order time and email used to <a href="mailto:diq@xygen.us">our billing address</a>.</p>
<?

}
if ($amount == 4999) {
// Kontoauszug aufrufen f&uuml;r Goldpaket E
$MyGold = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysql_error());
$golds = mysql_fetch_array($MyGold);
$goldnow = $golds['6'] + 2000; 
mysql_query("UPDATE ".TB_PREFIX."users set gold = '".$goldnow."' where `id`='".$session->uid."'") or die(mysql_error());
$MyGold = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysql_error());
$golds1 = mysql_fetch_array($MyGold);
?><p>Thank you for your purchase here at TravianX.</p><p>Below you see the entry record.  Out of it, you can observe your old as well as your new account balance.</p>
<table class="plusFunctions" cellpadding="1" cellspacing="1">
		<thead>
			<tr>

				<th colspan="5" height="20">Record of <?php echo date('d.m.Y'); ?></th>
			</tr>
			<tr>
				<td align="center">Description</td><td align="center"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" /></td><td align="center">Action</td><td align="center"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" /></td><td>Date</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="desc"><b>&nbsp;&nbsp;Account Balance (old)</b></td>
				<td class="desc"><center><? echo $golds['6']; ?></center></td>
				<td class="desc"><center><b>&nbsp;</b></center></td>
				<td class="desc"><center>&nbsp;</center></td>
                <td class="act"><center>&nbsp;</center></td>
             </tr>
             <tr>
				<td class="desc"><center><b>&nbsp;</b></center></td>
				<td class="desc"><center>&nbsp;</center></td>
				<td class="desc"><b><font color="#71D000"><center>Zubuchung</center></font></b></td>
				<td class="desc"><center>60 Gold</center></td>
                <td class="act"><center>&nbsp;</center></td>
			</tr>
            <tr>
				<td class="desc"><b>&nbsp;&nbsp;Account Balance (new)</b></td>
				<td class="desc"><center>&nbsp;</center></td>
				<td class="desc"><center><b>&nbsp;</b></center></td>
				<td class="desc"><center><? echo $golds1['6']; ?></center></td>
                <td class="act"><center><?php echo date('d.m.Y H:i:s'); ?></center></td>
			</tr>
             </tbody></table>
                        <p>Please verify the information.<br />It will let us know if the data is incorrect.</p>
            <p>Please mail your username, package, order time and email used to <a href="mailto:diq@xygen.us">our billing address</a>.</p>
<?
}
				if ($amount == 0) 
				{
				$MyGold = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE `id`='".$session->uid."'") or die(mysql_error());
				$golds = mysql_fetch_array($MyGold);	
					 ?>
                
<p>Here you can see your current account statement.</p> 
<table class="plusFunctions" cellpadding="1" cellspacing="1">
		<thead>
			<tr>

				<th colspan="5" height="20">Record of <?php echo date('d.m.Y'); ?></th>
			</tr>
			<tr>
				<td align="center">Description</td><td align="center"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" /></td><td align="center">Action</td><td align="center"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" /></td><td>Date</td></tr>
		</thead>
		<tbody>
			<tr>
				<td class="desc"><b>&nbsp;&nbsp;Current account balance</b></td>
				<td class="desc"><center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center></td>
				<td class="desc"><center><b>Account inquiry</b></center></td>
				<td class="desc"><center><? echo $golds['6']; ?></center></td>
                <td class="act"><center><?php echo date('d.m.Y H:i:s'); ?></center></td>
             </tr>
             </tbody></table>
                       <p>Please verify the information.<br />It will let us know if the data is incorrect.</p>
            <p>Please mail your username, package, order time and email used to <a href="mailto:contact@shadowss.ro">our billing address</a>.</p>
				<? 
				
				}

?>
<? $_SESSION['amount'] = 0; ?>

</div>
</div>
</br></br></br></br><div id="side_info">
<?php
include("Templates/multivillage.tpl");
include("Templates/quest.tpl");
include("Templates/news.tpl");
include("Templates/links.tpl");
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
Calculated in <b><?php
echo round(($generator->pageLoadTimeEnd()-$start)*1000);
?></b> ms

<br />Server time: <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
</div>
	</div>
</div>

<div id="ce"></div>
</body>
</html>