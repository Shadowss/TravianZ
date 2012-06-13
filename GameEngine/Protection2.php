<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Protection.php                                         	   ##
##  Developed by:  Songeriux												   ##
#################################################################################

function filter($txt) {
$arr_simboliu = array("#","$","!","\"","%","^","?","_","-","+","|","<",">","{","}","[","]",",","'"); 
$arr_kodu = array("&#35;","&#36;","&#33;","&quot;","&#37;","&#94;","&#63;","&#95;","&#45;","&#43;","&#124;","&lt;","&gt;","&#123;","&#125;","&#91;","&#93;","&#44;","&#039;");
return strip_tags(mysql_real_escape_string(str_replace($arr_simboliu,$arr_kodu,htmlspecialchars(trim($txt)))));
} // The script blocks out any dangorous simbols, and replaces them with an code. also protects mysql database.


## We need to put it on every GET, POST, COOKIE, SESSION and SERVER methods.
if(isset($_GET)){ foreach($_GET as $key=>$value) { $_GET[$key]=filter($value); } }
if(isset($_POST)){ foreach($_POST as $key=>$value) { $_POST[$key]=filter($value); } }
if(isset($_SESSION)){ foreach($_SESSION as $key=>$value){ $_SESSION[$key]=filter($value); } }
if(isset($_COOKIE)){ foreach($_COOKIE as $key=>$value){ $_COOKIE[$key]=filter($value); } }
if(isset($_SERVER)){ foreach($_SERVER as $key=>$value){ $_SERVER[$key]=filter($value); } }
?>