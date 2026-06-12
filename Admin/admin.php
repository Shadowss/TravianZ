<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       TravianZ                                                    ##
##  Version:       05.03.2026                                                  ##
##  Filename:      Admin/admin.php                                             ##
##  Developed by:  Dzoki                                                       ##
##  Refactored by: Shadow                                                      ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
##                                                                             ##
#################################################################################

session_start();
include_once("../GameEngine/config.php");
include_once("../GameEngine/Database.php");
include_once ("../GameEngine/Lang/" . LANG . ".php");
include_once("../GameEngine/Admin/database.php");
include_once("../GameEngine/Data/buidata.php");
include_once("../GameEngine/Artifacts.php");

$subpage = 'Login';
$not_include_mootools_js = false;

if (!empty($_GET['p'])) {
    switch ($_GET['p']) {
        case 'server_info':
            $subpage = 'Server Info';
            break;

        case 'online':
            $subpage = 'Online Users';
            break;

        case 'notregistered':
            $subpage = 'Players Not Activated';
            break;

        case 'inactive':
            $subpage = 'Players Inactivate';
            break;

        case 'report':
            $subpage = 'Players Report';
            break;
            
        case 'message':
            $subpage = 'Players Message';
            break;
			
		case 'massmessage':
			$subpage = 'Mass Message';
			break;	
			
		case 'sysmessage':
			$subpage = 'System Message';
			break;		

        case 'map':
            $subpage = 'Map';
            break;
        
		case 'map_tile':
			$subpage = 'Map Tile';
			$not_include_mootools_js = true;
			break;	
			
        case 'natars':
            $subpage = 'Natars Management';
            break;

        case 'search':
            $subpage = 'General Search';
            break;

        case 'message':
            $subpage = 'Search IGMs/Reports';
            break;

        case 'ban':
            $subpage = 'Ban/Unban Players';
            break;

        case 'maintenance':
            $subpage = 'Server Maintenance';
            break;

        case 'cleanban':
            $subpage = 'Clean Banlist Data';
            break;

        case 'gold':
            $subpage = 'Give All Free Gold';
            break;

        case 'usergold':
            $subpage = 'Give Free Gold To Specific User';
            break;

        case 'maintenenceResetGold':
            $subpage = 'Reset Gold';
            break;

        case 'delmedal':
            $subpage = 'Delete Player Medals';
            break;

        case 'delallymedal':
            $subpage = 'Delete Ally Medals';
            break;

        case 'givePlus':
            $subpage = 'Give All Plus';
            break;

        case 'maintenenceResetPlus':
            $subpage = 'Reset Plus';
            break;

        case 'givePlusRes':
            $subpage = 'Give All Res Bonus';
            break;

        case 'maintenenceResetPlusBonus':
            $subpage = 'Reset Res Bonus';
            break;

        case 'addUsers':
            $subpage = 'Create Users';
            break;

        case 'users':
            $subpage = 'Users List';
            break;

        case 'admin_log':
            $subpage = 'Admin Log';
            break;

        case 'config':
            $subpage = 'Server Settings';
            break;

        case 'debug_log':
            $subpage = 'Debug Error Log';
            break;

        case 'editServerSet':
            $subpage = 'Server Configuration';
            break;

        case 'editPlusSet':
            $subpage = 'PLUS Settings';
            break;

        case 'editLogSet':
            $subpage = 'Log Settings';
            break;

        case 'editNewsboxSet':
            $subpage = 'NewsBox Settings';
            break;

        case 'editExtraSet':
            $subpage = 'Extra Settings';
            break;

        case 'editAdminInfo':
            $subpage = 'Edit Admin Information';
            break;

        case 'resetServer':
            $subpage = 'Server Resetting';
            break;

        case 'player':
            if (!empty($_GET['uid'])) {
                $displayarray = $database->getUserArray($_GET['uid'],1);
                $user=$displayarray;
                $subpage = 'Player Details ('.$user['username'].')';
            } else {
                $subpage = 'Player Details (no player)';
            }
            break;

        case 'editUser':
            if (!empty($_GET['uid'])) {
                $user = $database->getUserArray($_GET['uid'],1);
                $subpage = 'Edit Player ('.$user['username'].')';
            } else {
                $subpage = 'Edit Player (no player)';
            }
            break;

        case 'deletion':
            if (!empty($_GET['uid'])) {
                $user = $database->getUserArray($_GET['uid'],1);
                $subpage = 'Delete Player ('.$user['username'].')';
            } else {
                $subpage = 'Delete Player (no player)';
            }
            break;

        case 'Newmessage':
            if (!empty($_GET['uid'])) {
                $user = $database->getUserArray($_GET['uid'],1);
                $subpage = 'Compose Message ('.$user['username'].')';
            } else {
                $subpage = 'Compose Message';
            }
            break;

        case 'editPlus':
            if (!empty($_GET['uid'])) {
                $user = $database->getUserArray($_GET['uid'],1);
                $subpage = 'Edit Plus &amp; Resources  ('.$user['username'].')';
            } else {
                $subpage = 'Edit Plus &amp; Resources';
            }
            break;

        case 'editSitter':
            if (!empty($_GET['uid'])) {
                $user = $database->getUserArray($_GET['uid'],1);
                $subpage = 'Edit Sitters ('.$user['username'].')';
            } else {
                $subpage = 'Edit Sitters ';
            }
            break;

        case 'editOverall':
            if (!empty($_GET['uid'])) {
                $user = $database->getUserArray($_GET['uid'],1);
                $subpage = 'Edit Off &amp; Def ('.$user['username'].')';
            } else {
                $subpage = 'Edit Off &amp; Def';
            }
            break;

        case 'editWeek':
            if (!empty($_GET['uid'])) {
                $user = $database->getUserArray($_GET['uid'],1);
                $subpage = 'Edit Weekly Off &amp; Def ('.$user['username'].')';
            } else {
                $subpage = 'Edit Weekly Off &amp; Def';
            }
            break;

        case 'userlogin':
            if (!empty($_GET['uid'])) {
                $player = mysqli_fetch_assoc(mysqli_query($GLOBALS["link"], "SELECT * FROM ".TB_PREFIX."users WHERE id = ".(int) $_GET['uid']));
                $subpage = 'User Logins ('.$player['username'].')';
            } else {
                $subpage = 'User Logins (no player)';
            }
            break;

        case 'userillegallog':
            if (!empty($_GET['uid'])) {
                $player = mysqli_fetch_assoc(mysqli_query($GLOBALS["link"], "SELECT * FROM ".TB_PREFIX."users WHERE id = ".(int) $_GET['uid']));
                $subpage = 'User Illegals Log ('.$player['username'].')';
            } else {
                $subpage = 'User Illegals Log (no player)';
            }
            break;

        case 'editHero':
            if (!empty($_GET['uid'])) {
                $user = $database->getUserArray($_GET['uid'],1);
                $subpage = 'Edit Hero ('.$user['username'].')';
            } else {
                $subpage = 'Edit Hero';
            }
            break;

        case 'editAdditional':
            if (!empty($_GET['uid'])) {
                $user = $database->getUserArray($_GET['uid'],1);
                $subpage = 'Edit Additional Info ('.$user['username'].')';
            } else {
                $subpage = 'Edit Additional Info';
            }
            break;

		case 'village':
			if (!empty($_GET['did'])) {
				$did = (int)$_GET['did'];
				$village = $database->getVillage($did);
			if ($village) {
				$user = $database->getUserArray($village['owner'], 1);
				$subpage = 'Edit Village ('.$village['name'].' » '.($user['username'] ?? '?').')';
			} else {
				$subpage = 'Edit Village (ID '.$did.' not found)';
				$village = null;
			}
			} else {
				$subpage = 'Edit Village (no village)';
			}
			break;

		case 'editResources':
			if (!empty($_GET['did'])) {
				$village = $database->getVillage($_GET['did']);
			if ($village) {
				$user = $database->getUserArray($village['owner'], 1);
				$subpage = 'Edit Resources ('.$village['name'].' » '.$user['username'].')';
			} else {
				$subpage = 'Edit Resources (ID '.$did.' not found)';
				$village = null;
			}	
			} else {
				$subpage = 'Edit Resources (no village)';
			}
			break;

        case 'addTroops':
            if (!empty($_GET['did'])) {
                $village = $database->getVillage($_GET['did']);
                $user = $database->getUserArray($village['owner'], 1);
                $subpage = 'Edit Troops ('.$village['name'].' » '.$user['username'].')';
            } else {
                $subpage = 'Edit Troops (no village)';
            }
            break;

        case 'addABTroops':
            if (!empty($_GET['did'])) {
                $village = $database->getVillage($_GET['did']);
                $user = $database->getUserArray($village['owner'],1);
                $subpage = 'Upgrade Troops ('.$village['name'].' » '.$user['username'].')';
            } else {
                $subpage = 'Upgrade Troops (no village)';
            }
            break;

        case 'editVillage':
            if (!empty($_GET['did'])) {
                $village = $database->getVillage($_GET['did']);
                $user = $database->getUserArray($village['owner'],1);
                $subpage = 'Edit Village ('.$village['name'].' » '.$user['username'].')';
            } else {
                $subpage = 'Edit Village (no village)';
            }
            break;

        case 'villagelog':
            if (!empty($_GET['did'])) {
                $village = $database->getVillage($_GET['did']);
                $user = $database->getUserArray($village['owner'],1);
                $subpage = 'Build Log ('.$village['name'].' » '.$user['username'].')';
            } else {
                $subpage = 'Build Log (no village)';
            }
            break;

        case 'techlog':
            if (!empty($_GET['did'])) {
                $village = $database->getVillage($_GET['did']);
                $user = $database->getUserArray($village['owner'],1);
                $subpage = 'Research Log ('.$village['name'].' » '.$user['username'].')';
            } else {
                $subpage = 'Research Log (no village)';
            }
            break;
    }
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<link rel="shortcut icon" href="favicon.ico"/>
		<title>Admin Panel - <?php echo $subpage; ?></title>
		<link rel="stylesheet" type="text/css" href="../img/admin/admin.css">
		<link rel="stylesheet" type="text/css" href="../img/admin/acp.css">
		<link rel="stylesheet" type="text/css" href="../img/img.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script type="text/javascript" src="jquery.cookie.js"></script>
		<?php if($not_include_mootools_js){}else{ ?>
		<script type="text/javascript" src="/mt-full.js?423cb"></script>
		<script type="text/javascript" src="ajax.js"></script>
		<script type="text/javascript" src="../new.js?0faab"></script>
		<?php } ?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="imagetoolbar" content="no">
		<meta name="viewport" content="width=device-width,initial-scale=1">
<style>
/* === TRAVIANZ ADMIN === */
body{margin:0;font-family:Verdana,Arial,sans-serif}
#ltop1{border-bottom:3px solid #f59e0b}
.tz-topbar{display:flex;align-items:center;justify-content:space-between;padding:14px 22px;min-height:64px}
.tz-brand{display:flex;align-items:center;gap:12px}
.tz-logo{width:38px;height:38px;background:#f59e0b;border-radius:8px;display:flex;align-items:center;justify-content:center;font-weight:bold;color:#fff;font-size:18px}
.tz-brand h1{margin:0;font-size:20px;font-weight:700}
.tz-brand h1 span{color:#f59e0b}
.tz-brand .tz-sub{display:block;font-size:10px;margin-top:2px;text-transform:uppercase;letter-spacing:.7px;opacity:.7}
.tz-user{font-size:12px}
.tz-logout{margin-left:10px;background:#ef4444;color:#fff;padding:5px 11px;border-radius:6px;text-decoration:none;font-size:11px;font-weight:bold}

body.login{background:#0f172a;color:#e2e8f0}
body.login #ltop1{background:#0b1220 !important;background-image:none !important}
body.login .tz-topbar{color:#fff !important}
body.login .tz-brand h1{color:#fff !important}
body.login .tz-brand .tz-sub{color:#94a3b8 !important}

body.app{background:#0f172a;color:#e2e8f0}
body.app #ltop1{background:#0b1220 !important;background-image:none !important;border-bottom:3px solid #f59e0b !important}
body.app .tz-topbar{color:#fff !important}
body.app .tz-brand h1{color:#fff !important}
body.app .tz-brand .tz-sub{color:#94a3b8 !important}
body.app .tz-user{color:#cbd5e1}

body.app #lleft{background:transparent!important;border-right:none !important;padding:0 12px;}
body.app #lleft .center-img{margin-top:20px;margin-bottom:12px}

body.app #menu{background:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,.3);margin-top:0;}
body.app #menu>li>a{display:block;padding:10px 16px;color:#374151!important;font-weight:600;font-size:12px;border-left:3px solid transparent;text-decoration:none}
body.app #menu>li>a:hover,body.app #menu>li>a.active{background:#f3f4f6;border-left-color:#f59e0b;color:#111827!important}
body.app #menu li.sub ul{background:#f9fafb}
body.app #menu li.sub ul li a{display:block;padding:8px 16px 8px 34px;font-size:11px;color:#6b7280!important}
body.app #menu li.sub ul li a:hover{color:#d97706!important}
body.app #menu li a{background:#ffffff !important;color:#374151 !important;border-bottom:1px solid #f3f4f6 !important}
body.app #menu li a:hover{background:#f9fafb !important}

body.app #lmid1{background:#ffffff !important;margin:16px !important;padding:24px !important;border-radius:12px !important;box-shadow:0 2px 8px rgba(0,0,0,.15) !important;border:1px solid #e5e7eb !important;}
body.app #lmid3{color:#696969 !important;}
body.app #lmid3 h1,body.app #lmid3 h2,body.app #lmid3 h3,body.app #lmid3 h4,body.app #lmid3 b,body.app #lmid3 strong{color:#696969 !important;font-weight:700 !important;}
body.app #lmid3 p,body.app #lmid3 span,body.app #lmid3 div,body.app #lmid3 td,body.app #lmid3 th,body.app #lmid3 li,body.app #lmid3 font{color:#696969 !important;font-weight:500 !important;}
body.app #lmid3 [style*="color:"]{color:#696969 !important;}
body.app #lmid3 a{color:#15803d !important;font-weight:600 !important;}
</style>
	</head>
	<body class="<?php echo $funct->CheckLogin() ? 'app' : 'login'; ?>">
    <script type="text/javascript">
                init_local();
                function getMouseCoords(e) {
                    var coords = {};
                    if (!e) var e = window.event;
                    if (e.pageX || e.pageY)     {
                        coords.x = e.pageX;
                        coords.y = e.pageY;
                    }
                    else if (e.clientX || e.clientY)     {
                        coords.x = e.clientX + document.body.scrollLeft
                            + document.documentElement.scrollLeft;
                        coords.y = e.clientY + document.body.scrollTop
                            + document.documentElement.scrollTop;
                    }
                    return coords;
                }
                function med_mouseMoveHandler(e, desc_string){
                    var coords = getMouseCoords(e);
                    med_showDescription(coords, desc_string);
                }
                function med_closeDescription(){
                    var layer = document.getElementById("medal_mouseover");
                    layer.className = "hide";
                }
                function init_local(){
                    med_init();
                }
                function med_init(){
                    layer = document.createElement("div");
                    layer.id = "medal_mouseover";
                    layer.className = "hide";
                    document.body.appendChild(layer);
                }
                function med_showDescription(coords, desc_string){
                    var layer = document.getElementById("medal_mouseover");
                    layer.style.top = (coords.y + 25)+ "px";
                    layer.style.left = (coords.x - 20) + "px";
                    layer.className = "";
                    layer.innerHTML = desc_string;
                }
               </script>
		<script language="javascript">
			function aktiv() {this.srcElement.className='fl1'; }
			function inaktiv() {event.srcElement.className='fl2'; }
			function del(e,id){
				if(e == 'arti'){ var conf = confirm('Dou you really want delete artifact id '+id+'?'); }
				if(e == 'did'){ var conf = confirm('Dou you really want delete village id '+id+'?'); }
				if(e == 'unban'){ var conf = confirm('Dou you really want unban player '+id+'?'); }
				if(e == 'stopDel'){ var conf = confirm('Dou you really want stop deleting user '+id+'?'); }
				if(e == 'oas'){ var conf = confirm('Dou you really want to delete oasis id '+id+'?'); }
				return conf;
			}
		</script>
		<script type="text/javascript">
			function showStuff(id) { document.getElementById(id).style.display = 'block'; }
			function hideStuff(id) { document.getElementById(id).style.display = 'none'; }
			function go_url(url) { location=url; return(false); }
		</script>
		<script type="text/javascript">
		$(document).ready(function () {
			var checkCookie = $.cookie("sub-nav");
			if (checkCookie != "") {
				$('#menu > li.sub > a:eq('+checkCookie+')').addClass('active').next().show();
			}
			$('#menu > li.sub > a').click(function(){
				var navIndex = $('#menu > li.sub > a').index(this);
				$.cookie("sub-nav", navIndex);
				$('#menu li ul').slideUp();
				if ($(this).next().is(":visible")){
					$(this).next().slideUp();
				} else {
					$(this).next().slideToggle();
				}
				return false;
			});
			var checkCookie = $.cookie("sub-link");
			if (checkCookie != "") {
				$('#menu > li.sub > ul li a:eq('+checkCookie+')').addClass('active');
			}
			$('.sub ul li a').click(function(){
				var subIndex = $('.sub ul li a').index(this);
				$.cookie("sub-link", subIndex);
				$('.sub ul li a').removeClass('active');
				$(this).addClass('active');
			});
	});
		</script>

		<div id="ltop1">
			<div class="tz-topbar">
				<div class="tz-brand">
					<div class="tz-logo">TZ</div>
					<div>
						<h1>TravianZ <span>Admin Panel</span></h1>
						<span class="tz-sub"><?php echo htmlspecialchars($subpage); ?> • v05.03.2026</span>
					</div>
				</div>
				<div class="tz-user">
					<?php if($funct->CheckLogin()){ ?>
						<?php 
						$adminName = $database->getUserField($_SESSION['id'], 'username', 0);
						$adminAccess = $database->getUserField($_SESSION['id'], 'access', 0);
						$rank = $adminAccess == 9 ? 'Admin' : ($adminAccess == 8 ? 'MH' : 'User');
					?>
						Logged: <b><?=$adminName?></b> <span style="color:#999;font-size:11px">(<?=$rank?>)</span> 
						<a href="?action=logout" class="tz-logout">Logout</a>
					<?php } else { ?>
						Not Logged in
					<?php } ?>
				</div>
			</div>
		</div>
    <div style="height:20px;"></div>
		<div id="lmidall">
			<div id="lmidlc">
				<div id="lleft">

					<p class="center-img">
			<a href="<?php echo HOMEPAGE; ?>">
				<img src="/Admin/img/travianz_admin_logo.png" alt="TravianZ Admin Panel" style="display:block;margin:0 auto;max-width:85%;height:auto;filter:drop-shadow(0 2px 6px rgba(0,0,0,.5));">
			</a>
					</p>
					<?php
						if($funct->CheckLogin())
						{
							if($_SESSION['access'] == ADMIN)
							{
					?>
					<ul id="menu">
						<li><a href="<?php echo HOMEPAGE; ?>">Server Homepage</a></li>
						<li><a href="index.php">Control Panel Home</a></li>
						<li><a href="<?php echo rtrim(SERVER, '/'); ?>/dorf1.php">Return to the server</a></li>
						<li><a href="?action=logout">Logout</a></li>
						<li class="sub"><a href="#">Server Info</a>
							<ul>
								<li><a href="?p=server_info">Server Info</a></li>
								<li><a href="?p=online">Online Users</a></li>
								<li><a href="?p=notregistered">Players Not Activated</a></li>
								<li><a href="?p=inactive">Players Inactivate</a></li>
								<li><a href="?p=report">Players Report</a></li>
								<li><a href="?p=msg">Players Message</a></li>
								<li><a href="?p=map">Map</a></li>
								<li><a href="?p=map_tile">Map Tile</a></li>
								<li><a href="?p=natars">Natars Management</a></li>
							</ul>
						</li>
						<li class="sub"><a href="#">Search</a>
							<ul>
								<li><a href="?p=search">General Search</a></li>
								<li><a href="?p=message">Search IGMs/Reports</a></li>
							</ul>
						</li>
						<li class="sub"><a href="#">Messages</a>
							<ul>
								<li><a href="admin.php?p=massmessage">Create Mass Message</a></li>
								<li><a href="admin.php?p=sysmessage">Create System Message</a></li>
							</ul>
						</li>
						<li class="sub"><a href="#">Ban</a>
							<ul>
								<li><a href="?p=ban">Ban/Unban Players</a></li>
								<li><a href="?p=cleanban">Clean Banlist Data</a></li>
							</ul>
						</li>
						<li class="sub"><a href="#">Gold</a>
							<ul>
								<li><a href="?p=gold">Give All Free Gold</a></li>
								<li><a href="?p=usergold">Give Free Gold To Specific User</a></li>
								<li><a href="?p=maintenenceResetGold">Reset Gold</a></li>
							</ul>
						</li>
						<li class="sub"><a href="#">Plus & Res Bonus</a>
							<ul>
								<li><a href="?p=givePlus">Give All Plus</a></li>
								<li><a href="?p=maintenenceResetPlus">Reset Plus</a></li>
								<li><a href="?p=givePlusRes">Give All Res Bonus</a></li>
								<li><a href="?p=maintenenceResetPlusBonus">Reset Res Bonus</a></li>
							</ul>
						</li>
						<li class="sub"><a href="#">Users</a>
							<ul>
                                <li><a href="?p=users">List Users</a></li>
								<li><a href="?p=addUsers">Create Users</a></li>
							</ul>
						</li>
						<li class="sub"><a href="#">Admin</a>
							<ul>
								<li><a href="?p=admin_log"><font color="Red"><b>Admin Log</b></font></a></li>
								<li><a href="?p=debug_log">Debug Error Log</a></li>
								<li><a href="?p=config">Server Settings</a></li>
								<li><a href="?p=maintenance">Server Maintenance</a></li>
								<li><a href="?p=resetServer">Server Resetting</a></li>
							</ul>
						</li>
					</ul>
					<?php
							} else if($_SESSION['access'] == MULTIHUNTER) {
					?>
					<ul id="menu">
						<li><a href="<?php echo HOMEPAGE; ?>">Server Homepage</a></li>
						<li><a href="index.php">Control Panel Home</a></li>
						<li><a href="<?php echo rtrim(SERVER, '/'); ?>/nachrichten.php">In-Game Messages</a></li>
						<li><a href="?p=server_info">Server Info</a></li>
						<li><a href="?p=online">Online users</a></li>
						<li><a href="?p=search">Search</a></li>
						<li><a href="?p=message">Msg/Rep</a></li>
						<li><a href="?p=ban">Ban</a></li>
						<li><a href="?action=logout">Logout</a></li>
					</ul>
					<?php
							}
						}
					?>
				</div>
				<div id="lmid1">
					<div id="lmid3">
						<?php
	if($funct->CheckLogin())
    {
        if($_POST || $_GET)
        {
            $p = $_GET['p'] ?? '';   
            if($p && $p != "search") 
            {
                $filename = 'Templates/'.$p.'.tpl';
                if(file_exists($filename)) include($filename);
                else include('Templates/404.tpl');
            }
            else include('Templates/search.tpl');

            if(isset($_POST['p']) && isset($_POST['s']) && $_POST['p'] && $_POST['s'])
            {
                $filename = 'Templates/results_'.$_POST['p'].'.tpl';
                if(file_exists($filename)) include($filename);
                else include('Templates/404.tpl');
            }
        }
        else include('Templates/home.tpl');
    }
    else include('Templates/login.tpl');
?>
					</div>
				</div>
			</div>
			<div id="lright1"></div>
			<div id="ce"></div>
		</div>
	</body>
</html>