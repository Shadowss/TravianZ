<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       ZravianX                                                    ##
##  Version:       2011.12.03                                                  ##
##  Filename:      admin.php                                                   ##
##  Developed by:  Dzoki                                                       ##
##  Reworked by:   ZZJHONS                                                     ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     ZravianX (c) 2011 - All rights reserved                     ##
##  URLs:          http://zravianx.zzjhons.com                                 ##
##  Source code:   http://www.github.com/ZZJHONS/ZravianX                      ##
##                                                                             ##
#################################################################################

session_start();
include("GameEngine/Database.php");
include("GameEngine/Admin/database.php");  

        if($session->access < ADMIN)
        	die("Access Denied: You are not Admin!");
?>                                             
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <link rel="shortcut icon" href="../favicon.ico" />
    <title><?php if($_SESSION['access'] == ADMIN){ echo 'Admin Control Panel - '.SERVER_NAME; } else if($_SESSION['access'] == MULTIHUNTER){ echo 'Multihunter Control Panel - '.SERVER_NAME; } ?></title>    
	<link href="gpack/travian_default/lang/en/compact.css" rel="stylesheet" type="text/css" />
	<link href="gpack/travian_default/lang/en/lang.css" rel="stylesheet" type="text/css" />
    <link href="gpack/travian_default/travian.css" rel='stylesheet' type='text/css' />
    <link rel=stylesheet type="text/css" href="img/admin/admin.css">
    <link rel=stylesheet type="text/css" href="img/admin/acp.css">
    <link rel=stylesheet type="text/css" href="img/img.css">
    <script src="mt-full.js"  type="text/javascript"></script>
    <script src="GameEngine/Admin/ajax.js" type="text/javascript"></script>
	<script src="unx.js" type="text/javascript"></script>
	<script src="new.js" type="text/javascript"></script>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="imagetoolbar" content="no">
</head>
<body class="v35">
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
	<div class="wrapper">
		<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" />
		<div id="dynamic_header"></div>
        <div id="header">
            <div id="mtop">
                <a href="admin.php" title="ACP Home"><img class="fl2" src="img/admin/x1.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"></a>
                <a href="?p=online" title="Online Users"><img class="fl2" src="img/admin/x2.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"></a>
                <a href="?p=search" title="Search"><img class="fl2" src="img/admin/x3.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"></a>
                <a href="?p=message" title="Messages/Reports"><img class="fl2" src="img/admin/x4.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"></a>
                <a href="?p=config" title="Server Config"><img class="fl2" src="img/admin/x5.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"></a>
                <div class="clear"></div>
            </div>
        </div>
        <div id="mid">
			<?php include ("Templates/Admin/menu.tpl"); ?>
        </div>
        <div id="content"  class="player">
			<?php     
              if($funct->CheckLogin()){            
                if($_POST or $_GET){  
                  if($_GET['p'] and $_GET['p']!="search"){
                      $filename = 'Templates/Admin/'.$_GET['p'].'.tpl';
                      if(file_exists($filename)){
                        include($filename);
                      }else{
                        include('Templates/Admin/404.tpl');
                      }
                  }else{
                    include('Templates/Admin/search.tpl');
                  }  
                  if($_POST['p'] and $_POST['s']){
                    $filename = 'Templates/Admin/results_'.$_POST['p'].'.tpl';
                      if(file_exists($filename)){
                        include($filename);
                      }else{
                        include('Templates/Admin/404.tpl');
                      }        
                  }
                }else{
                  include('Templates/Admin/home.tpl');  
                }
              }else{           
                include('Templates/Admin/login.tpl');
              }    
            ?>
	</div>  
            <div id="side_info" class="outgame">
				<?php include("Templates/news.tpl"); ?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="footer-stopper outgame"></div>
		<center>
        	<br />
            <p><font color="#999999">This ACP has been reworked by <a href="http://zzjhons.com">ZZJHONS</a></font></p>
            <br />
        </center>
        <div class="clear"></div>
    <div id="ce"></div>
</body>
</html>