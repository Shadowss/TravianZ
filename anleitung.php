<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       anleitung.php                                               ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

include("GameEngine/config.php");
include("GameEngine/Database.php");
include("GameEngine/Lang/".LANG.".php");
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
	<h1>Welcome to <?php echo SERVER_NAME; ?></h1>
</div>

<div id="navigation">

<a href="index.php" class="home"><img src="img/x.gif" alt="Travian"/></a>

	<table class="menu">

	<tr>

		<td><a href="tutorial.php"><span>Tutorial</span></a></td>

		<td><a href="anleitung.php"><span>Manual</span></a></td>

		<td><a href="http://forum.travian.com/" target="_blank"><span>Forum</span></a></td>





		<td><a href="index.php?signup"><span>Register</span></a></td>

		<td><a href="index.php?login"><span>Login</span></a></td>

</tr>

	</table>

</div>






<div id="content">

	<div class="grit">


<h1>Manual</h1>



<p class="submenu">

<a href="anleitung.php">The tribes</a> |

<a href="anleitung.php?s=1">The buildings</a> |

<a href="anleitung.php?s=3">FAQ</a>

</p>



<?php
if(!isset($_GET['s'])) {
$_GET['s'] = ""; }
if ($_GET['s'] == "") {
include("Templates/Anleitung/0.tpl"); }
if ($_GET['s'] == "1") {
include("Templates/Anleitung/1.tpl"); }
if ($_GET['s'] == "3") {
include("Templates/Anleitung/3.tpl"); }
if ($_GET['s'] == "4") {
include("Templates/Anleitung/4.tpl"); }
?>



</ul>

<div class="footer"></div>

</div>

</div>

<div id="iframe_layer" class="overlay">



<div class="mask closer"></div>







<div class="overlay_content">

<a href="index.php" class="closer"><img class="dynamic_img" alt="Close" src="img/un/x.gif" /></a>

<h2>Anleitung</h2>



<div id="frame_box" >

</div>

<div class="footer"></div>

</div>



</div>




</body>
</html>