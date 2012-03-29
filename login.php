<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       login.php                                                   ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################


error_reporting(E_ALL);
include("GameEngine/Account.php");
if(isset($_GET['del_cookie'])) {
	setcookie("COOKUSR","",time()-3600*24,"/");
	header("Location: login.php");
}
if(!isset($_COOKIE['COOKUSR'])) {
	$_COOKIE['COOKUSR'] = "";
}
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
<?php include("Templates/menu.tpl"); ?>

<div id="content"  class="login">

<h1><img class="img_login" src="img/x.gif" alt="log in the game" /></h1>

<?php
$time = time();
if( COMMENCE > $time )
{
echo '<p><font color="red" size="6">'.NOT_OPENED_YET.'</font></p>' ;
}
else
{
?>
<h5><img class="img_u04" src="img/x.gif" alt="login" /></h5>
<p><?php echo COOKIES; ?></p>

<form method="post" name="snd" action="login.php">
<input type="hidden" name="ft" value="a4" />

<table cellpadding="1" cellspacing="1" id="login_form">
	<tbody>
		<tr class="top">
			<th><?php echo NAME; ?></th>
			<td><input class="text" type="text" name="user" value="<?php echo $form->getDiff("user",$_COOKIE['COOKUSR']); ?>" maxlength="15" autocomplete='off' /> <span class="error"> <?php echo $form->getError("user"); ?></span></td>
		</tr>
		<tr class="btm">
			<th><?php echo PASSWORD; ?></th>
			<td><input class="text" type="password" name="pw" value="<?php echo $form->getValue("pw");?>" maxlength="20" autocomplete='off' /> <span class="error"><?php echo $form->getError("pw"); ?></span></td>
		</tr>
	</tbody>
</table>

<p class="btn">
	<!--<input type="hidden" name="e1d9d0c" value="" />-->
		<input type="image" value="login" name="s1"	onclick="xy();" id="btn_login" class="dynamic_img" src="img/x.gif" alt="login button"	/>
</p>

</form>
<?php
}
if ($form->getError("pw") == LOGIN_PW_ERROR) {
echo "<p class=\"error_box\">
	<span class=\"error\">".PW_FORGOTTEN."</span><br>
	".PW_REQUEST."<br>
	<a href=\"password.php?npw=".$database->getUserField($form->getValue('user'), 'id', 1)."\">".PW_GENERATE."</a>
</p>";
}
if($form->getError("activate") != "") {
	echo "<p class=\"error_box\">
	<span class=\"error\">".EMAIL_NOT_VERIFIED."</span><br>
	".EMAIL_FOLLOW."<br>
	<a href=\"activate.php?usr=".$form->getError("activate")."\">".VERIFY_EMAIL."</a>
	</p>";
}
?>
</div>
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
