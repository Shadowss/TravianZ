<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       TravianZ                                                    ##
##  Version:       05.03.2014                                                  ##
##  Filename:      Admin/admin.php     				                           ##
##  Developed by:  Dzoki                                                       ##
##  Edited by:     Shadow and ronix                                            ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     TravianZ (c) 2014 - All rights reserved                     ##
##  URLs:          http://travian.shadowss/ro                                  ##
##  Source code:   https://github.com/Shadowss/TravianZ	                       ##
##                                                                             ##
#################################################################################

session_start();
include("../GameEngine/Database.php");
include("../GameEngine/Admin/database.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <link REL="shortcut icon" HREF="favicon.ico"/>
	<title>Admin Control Panel - TravianX</title>
	<link rel=stylesheet type="text/css" href="../img/admin/admin.css">
	<link rel=stylesheet type="text/css" href="../img/admin/acp.css">
	<link rel=stylesheet type="text/css" href="../img/../img.css">
		<script src="mt-full.js?423cb"  type="text/javascript"></script>
	<script src="ajax.js" type="text/javascript"></script>

	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="imagetoolbar" content="no">
</head>
<body>

<script language="javascript">
function aktiv() {this.srcElement.className='fl1'; }
function inaktiv() {event.srcElement.className='fl2'; }

function del(e,id){
if(e == 'did'){ var conf = confirm('Dou you really want delete village id '+id+'?'); }
if(e == 'unban'){ var conf = confirm('Dou you really want unban player '+id+'?'); }
if(e == 'stopDel'){ var conf = confirm('Dou you really want stop deleting user '+id+'?'); }
if(conf){return true;}else{return false;}
}

</script>

<div id="ltop1">
<div style="position:relative; width:231px; height:100px; float:left;">
	<img src="../img/x.gif" width="1" height="1">
</div>
<img class="fl2" src="../img/admin/x1.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"><img class="fl2" src="../img/admin/x2.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"><img class="fl2" src="../img/admin/x3.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"><img class="fl2" src="../img/admin/x4.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"><img class="fl2" src="../img/admin/x5.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"></div>

<div id="lmidall">
<div id="lmidlc">
<div id="lleft">
<a href="index.php"><img src="../img/en/a/travian0.gif" class="logo_plus" width="116" height="60" border="0"></a>

<table id="navi_table" cellspacing="0" cellpadding="0">
<tr>
<td class="menu">
<?php
  if($funct->CheckLogin()){?>
	  <a href="admin.php">ACP Home</a>	  <a href="<?php echo HOMEPAGE; ?>">Homepage</a>	  <a href="#"></a><a href="#"></a>	  <a href="?p=server_info">Server Info</a>
	  <a href="?p=online">Online users</a>
	  <a href="?p=search">Search</a>
	  <a href="?p=message">Msg/Rep</a>
	  <a href="?p=ban">Ban</a>
	  <a href="?p=config">Config</a>
	  <a href="?p=config_editor">Config Editor</a>	  <a href="#"></a><a href="#"></a><a href="#"></a>
	  <a href="?action=logout">Logout</a>
<?php }?>
</td>
</tr>
</table></div>
<div id="lmid1">
<div id="lmid3">

<?php

  if($funct->CheckLogin()){
	if($_POST or $_GET){
	  if($_GET['p'] and $_GET['p']!="search"){
		  $filename = '../Templates/Admin/'.$_GET['p'].'.tpl';
		  if(file_exists($filename)){
			include($filename);
		  }else{
			include('../Templates/Admin/404.tpl');
		  }
	  }else{
		include('../Templates/Admin/search.tpl');
	  }
	  if($_POST['p'] and $_POST['s']){
		$filename = '../Templates/Admin/results_'.$_POST['p'].'.tpl';
		  if(file_exists($filename)){
			include($filename);
		  }else{
			include('../Templates/Admin/404.tpl');
		  }
	  }
	}else{
	  include('../Templates/Admin/home.tpl');
	}
  }else{
	include('../Templates/Admin/login.tpl');
  }
?>

</div>
</div>

</div>
<div id="lright1"></div>

<div id="ce"></div>



</body>
</html>

