<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       anmelden.php                                                 ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

include('GameEngine/Account.php');
$invited=(isset($_GET['uid'])) ? filter_var($_GET['uid'], FILTER_SANITIZE_NUMBER_INT):$form->getError('invt');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
	<title><?php echo SERVER_NAME; ?></title>
		<link REL="shortcut icon" HREF="favicon.ico"/>
	<meta name="content-language" content="en" />
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-core.js?0faaa" type="text/javascript"></script>
	<script src="mt-more.js?0faaa" type="text/javascript"></script>
	<script src="unx.js?0faaa" type="text/javascript"></script>
	<script src="new.js?0faaa" type="text/javascript"></script>
	<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7c" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7c" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE ?>travian.css?f4b7c" rel="stylesheet" type="text/css" />
		<link href="<?php echo GP_LOCATE ?>lang/en/lang.css" rel="stylesheet" type="text/css" />
	   </head>

<body class="v35 ie ie7" onload="initCounter()">

<div class="wrapper">
<div id="dynamic_header">
</div>
<div id="header"></div>
<div id="mid">
<?php include("Templates/menu.tpl");
if(REG_OPEN == true){ ?>
<div id="content"  class="signup">

<h1><img src="img/x.gif" class="anmelden" alt="register for the game"></h1>
<h5><img src="img/x.gif" class="img_u05" alt="registration"/></h5>

<p><?php echo BEFORE_REGISTER; ?></p>

<form name="snd" method="post" action="anmelden.php">
<input type="hidden" name="invited" value="<?php echo $invited; ?>" />
<input type="hidden" name="ft" value="a1" />

<table cellpadding="1" cellspacing="1" id="sign_input">
	<tbody>
		<tr class="top">
			<th><?php echo NICKNAME; ?></td>
			<td><input class="text" type="text" name="name" value="<?php echo $form->getValue('name'); ?>" maxlength="30" />
			<span class="error"><?php echo $form->getError('name'); ?></span>
			</td>
		</tr>
		<tr>
			<th><?php echo EMAIL; ?></th>
			<td>
				<input class="text" type="text" name="email" value="<?php echo stripslashes($form->getValue('email')); ?>" />
				<span class="error"><?php echo $form->getError('email'); ?></span>
				</td>
			</tr>
		<tr>
			<th><?php echo PASSWORD; ?></th>
			<td>
				<input class="text" type="password" name="pw" value="<?php echo stripslashes($form->getValue('pw')); ?>" maxlength="100" />
				<span class="error"><?php echo $form->getError('pw'); ?></span>
			</td>
		</tr>
	</tbody>
</table>

<table cellpadding="1" cellspacing="1" id="sign_select">
	<tbody>
		<tr class="top">
			<th><img src="img/x.gif" class="img_u06" alt="choose tribe"></th>
			<th colspan="2"><img src="img/x.gif" class="img_u07" alt="starting position"></th>
		</tr>
		<tr>
			<td class="nat"><label><input class="radio" type="radio" name="vid" value="1" <?php echo $form->getRadio('vid',1); ?>>&nbsp;<?php echo ROMANS; ?></label></td>
			&nbsp;<td class="pos1"><label><input class="radio" type="radio" name="kid" value="0" checked>&nbsp;<?php echo RANDOM; ?></label></td>
			<td class="pos2">&nbsp;</td>
		</tr>
		<tr>
			<td><label><input class="radio" type="radio" name="vid" value="2" <?php echo $form->getRadio('vid',2); ?>>&nbsp;<?php echo TEUTONS; ?></label></td>
			<td><label><input class="radio" type="radio" name="kid" value="1" <?php echo $form->getRadio('kid',1); ?>>&nbsp;<?php echo NW; ?> <b>(-|+)</b>&nbsp;</label></td>
			<td><label><input class="radio" type="radio" name="kid" value="2" <?php echo $form->getRadio('kid',2); ?>>&nbsp;<?php echo NE; ?> <b>(+|+)</b></label></td>
		</tr>
		<tr class="btm">
			<td><label><input class="radio" type="radio" name="vid" value="3" <?php echo $form->getRadio('vid',3); ?>>&nbsp;<?php echo GAULS; ?></label></td>
			<td><label><input class="radio" type="radio" name="kid" value="3" <?php echo $form->getRadio('kid',3); ?>>&nbsp;<?php echo SW; ?> <b>(-|-)</b></label></td>
			<td><label><input class="radio" type="radio" name="kid" value="4" <?php echo $form->getRadio('kid',4); ?>>&nbsp;<?php echo SE; ?> <b>(+|-)</b></label></td>
		</tr>
	</tbody>
</table>

<ul class="important">
<?php
echo $form->getError('tribe');
echo $form->getError('agree');
?>
		</ul>

<p>
		<input class="check" type="checkbox" name="agb" value="1" <?php echo $form->getRadio('agb',1); ?>/><?php echo ACCEPT_RULES; ?></p>

<p class="btn">
	<input type="image" value="anmelden" name="s1" id="btn_signup" class="dynamic_img" src="img/x.gif" alt="register"/>
</p>
</form>

<p class="info"><?php echo ONE_PER_SERVER; ?></p>
</div>
<?php }else{ ?>
<div id="content"  class="signup">

<h1><img src="img/x.gif" class="anmelden" alt="register for the game"></h1>
<h5><img src="img/x.gif" class="img_u05" alt="registration"/></h5>

<p><?php echo REGISTER_CLOSED; ?></p>
</div>
<?php } ?>
<div id="side_info" class="outgame">
<?php
if(NEWSBOX1) { include("Templates/News/newsbox1.tpl"); }
if(NEWSBOX2) { include("Templates/News/newsbox2.tpl"); }
if(NEWSBOX3) { include("Templates/News/newsbox3.tpl"); }
?>
			</div>

<div class="clear"></div>
			</div>

			<div class="footer-stopper outgame"></div>
			<div class="clear"></div>

<?php include("Templates/footer.tpl"); ?>
<div id="ce"></div>
</body>
</html>
