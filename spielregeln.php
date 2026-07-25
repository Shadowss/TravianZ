<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename       spieleregeln.php                                            ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		           ##
##  Source code:   https://github.com/Shadowss/TravianZ		                   ##
##                                                                             ##
#################################################################################

use App\Utils\AccessLogger;

include_once("GameEngine/config.php");
include_once("GameEngine/Database.php");
include_once("GameEngine/Lang/".LANG.".php");
AccessLogger::logRequest();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo SERVER_NAME; ?></title>
	<link rel="stylesheet" type="text/css" href="img/tutorial/main.css"/>
	<link rel="stylesheet" type="text/css" href="img/tutorial/flaggs.css"/>
	<meta name="content-language" content="en"/>
	<meta http-equiv="imagetoolbar" content="no"/>
	<script src="mt-core.js" type="text/javascript"></script>
	<script src="new.js" type="text/javascript"></script>
	<style type="text/css" media="screen">

	</style>
</head>
<body class="webkit contentPage">
<div class="wrapper">
<div id="country_select">

</div>
<div id="header">
	<h1><?php echo PUBLIC_WELCOME_TO; ?> <?php echo SERVER_NAME; ?></h1>
</div>

<div id="navigation">

<a href="index.php" class="home"><img src="img/x.gif" alt="Travian"/></a>

	<table class="menu">

	<tr>

		<td><a href="tutorial.php"><span><?php echo TUTORIAL; ?></span></a></td>

		<td><a href="anleitung.php"><span><?php echo PUBLIC_MANUAL; ?></span></a></td>

		<td><a href="https://github.com/Shadowss/TravianZ/discussions" target="_blank"><span><?php echo FORUM; ?></span></a></td>





		<td><a href="index.php?signup"><span><?php echo PUBLIC_REGISTER; ?></span></a></td>

		<td><a href="index.php?login"><span><?php echo LOGIN; ?></span></a></td>

</tr>

	</table>

</div>

<div id="content">

	<div class="grit">


<h1><?php echo PUBLIC_RULES_TITLE; ?></h1>

<p class="submenu">

<?php echo PUBLIC_RULES_INTRO_1; ?>
<br /><br />
<?php echo PUBLIC_RULES_INTRO_2; ?>
</p>
<ul class="rules">
 <li><strong style="color: #2A720B">&sect;1 Password, Registration &amp; ownership</strong><br />
<?php echo PUBLIC_RULES_ONE_ACCOUNT; ?>
<ul>
<li><strong style="color: #3BAE18">&sect;1.1 Registration</strong><br />
<?php echo PUBLIC_RULES_EMAIL_OWNER; ?>
</li>
<li><strong style="color: #3BAE18"><?php echo PUBLIC_RULES_SECTION_1_2; ?></strong><br />
<?php echo PUBLIC_RULES_PASSWORD_SAME_WORLD; ?>
<br /><br />
<?php echo PUBLIC_RULES_PASSWORD_OTHER_WORLD; ?>
<br /><br />
<?php echo PUBLIC_RULES_PASSWORD_DAMAGE; ?>
</li>
<li><strong style="color: #3BAE18"><?php echo PUBLIC_RULES_SECTION_1_3; ?></strong><br />
<?php echo PUBLIC_RULES_EMAIL_CHANGE; ?>
</li>
<li><strong style="color: #3BAE18">&sect;1.4 Switching accounts</strong><br />
<?php echo PUBLIC_RULES_SAME_WORLD_TRANSFER; ?>
<ol>
<li><?php echo PUBLIC_RULES_WORLD_NAME; ?></li>
<li><?php echo PUBLIC_RULES_ACCOUNT_NICKNAME; ?></li>
<li><?php echo PUBLIC_RULES_NEW_OWNER_EMAIL; ?> </li>
</ol>
<?php echo PUBLIC_RULES_PASSWORD_REQUEST_AFTER_TRANSFER; ?>
</li>
</ul>
</li>
<li><strong style="color: #2A720B">&sect;2 Sitting &amp; same pc usage</strong><br />
<ul>
<li><strong style="color: #3BAE18">&sect;2.1 Sitting</strong><br />
<?php echo PUBLIC_RULES_SITTERS; ?>
<br />
<?php echo PUBLIC_RULES_SITTER_LOGIN; ?>
<br />
<?php echo PUBLIC_RULES_SITTER_DAMAGE; ?>
</li>
<li><strong style="color: #3BAE18">&sect;2.2 Same pc usage</strong><br />
<?php echo PUBLIC_RULES_SHARED_COMPUTER; ?>
</li>
</ul>
</li>
<li><strong style="color: #2A720B">&sect;3 Use of externals</strong><br />
<?php echo PUBLIC_RULES_BROWSER; ?>
</li>
<li><strong style="color: #2A720B"><?php echo PUBLIC_RULES_PROGRAM_ERRORS_HEADING; ?></strong><br />
<?php echo PUBLIC_RULES_BUGS; ?>
</li>
<li><strong style="color: #2A720B">&sect;5 Money transactions</strong><br />
<?php echo PUBLIC_RULES_REAL_MONEY; ?>
</li>
<li><strong style="color: #2A720B">&sect;6 Netiquette</strong><br />
<?php echo PUBLIC_RULES_POLITE_COMMUNICATION; ?>
<ol>
<li><?php echo PUBLIC_RULES_BEHAVIOUR_INTRO; ?> <br />
<?php echo PUBLIC_RULES_LANGUAGE; ?>
<br />
Participation in abusive, defamatory, sexist, racist or profane language; disparaging any religion, race, nation, gender, age group, or sexual orientation; threatening persons with actions in real life.
<br />
Posting or transmission of any material not suitable for underage persons.
<br />
<?php echo PUBLIC_RULES_BLACKMAIL; ?>
<br />
Displaying battle reports or messages in public without consent of both concerned persons.
</li>
<li>No real world politics are allowed in names, messages and descriptions. </li>
<li>Impersonation of officials or official positions is illegal in any way.
</li>
<li><?php echo PUBLIC_RULES_ADVERTISING; ?> </li>
</ol>
</li>
<li><strong style="color: #2A720B">&sect;7 Punishments</strong><br />
<?php echo PUBLIC_RULES_PUNISHMENT; ?>
<br />
<?php echo PUBLIC_RULES_NO_REPLACEMENT; ?>
<br />
<?php echo PUBLIC_RULES_NO_SPECIAL_TREATMENT; ?>
<br /><br />
<?php echo PUBLIC_RULES_APPEALS; ?>
<br />
<?php echo PUBLIC_RULES_OWNER_INFORMATION; ?>
<br /><br />
<?php echo PUBLIC_RULES_MULTI_DELETE; ?>
</li>
<li><strong style="color: #2A720B"><?php echo PUBLIC_RULES_SECTION_8; ?></strong><br />
<?php echo PUBLIC_RULES_CHANGE_ANY_TIME; ?>
</li>
<li><strong style="color: #2A720B">&sect;9 Correction clause</strong><br />
<?php echo PUBLIC_RULES_SEVERABILITY; ?>
</li>
</ul>
	</div>

<div class="footer"></div>

</div>

</div>

<div id="iframe_layer" class="overlay">



<div class="mask closer"></div>







<div class="overlay_content">

<a href="index.php" class="closer"><img class="dynamic_img" alt="<?php echo PUBLIC_CLOSE; ?>" src="img/un/x.gif" /></a>

<h2>Anleitung</h2>



<div id="frame_box" >

</div>

<div class="footer"></div>

</div>



</div>




</body>
</html>