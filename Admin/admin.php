<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       admin.php                                                   ##
##  Developed by:  Dzoki                                                       ##
##  Reworked:      aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################

session_start();
include("../GameEngine/Database.php");
include("../GameEngine/Admin/database.php");
include("../GameEngine/config.php");
include("../GameEngine/Data/buidata.php");

class timeFormatGenerator
{
	public function getTimeFormat($time)
	{
		$min = 0;
		$hr = 0;
		$days = 0;
		while ($time >= 60): $time -= 60; $min += 1; endwhile;
		while ($min  >= 60): $min  -= 60; $hr  += 1; endwhile;
		while ($hr   >= 24): $hr   -= 24; $days +=1; endwhile;
		if ($min < 10)
		{
			$min = "0".$min;
		}
		if($time < 10)
		{
			$time = "0".$time;
		}
		return $days ." day ".$hr."h ".$min."m ".$time."s";
	}
};
$timeformat = new timeFormatGenerator;

include('Templates/ver.tpl');
include('Templates/update_latest.tpl');
$up_avl = $latest - $ver ;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<link REL="shortcut icon" HREF="favicon.ico"/>
		<title>Admin Panel</title>
		<link rel=stylesheet type="text/css" href="../img/admin/admin.css">
		<link rel=stylesheet type="text/css" href="../img/admin/acp.css">
		<link rel=stylesheet type="text/css" href="../img/img.css">
		<script src="/mt-full.js?423cb"  type="text/javascript"></script>
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
		<script type="text/javascript">
			function showStuff(id) {
				document.getElementById(id).style.display = 'block';
			}
			function hideStuff(id) {
				document.getElementById(id).style.display = 'none';
			}
		</script>
		<div id="ltop1">
			<div style="position:relative; width:231px; height:100px; float:left;">
				<img src="../img/x.gif" width="1" height="1">
			</div>
			<img class="fl2" src="../img/admin/x1.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"><img class="fl2" src="../img/admin/x2.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"><img class="fl2" src="../img/admin/x3.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"><img class="fl2" src="../img/admin/x4.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"><img class="fl2" src="../img/admin/x5.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"></div>
			<div id="lmidall">
				<div id="lmidlc">
					<div id="lleft" style="width: 160px;">
						<a href="<?php echo HOMEPAGE; ?>"><img src="../img/en/a/travian0.gif" class="logo_plus" width="116" height="60" border="0"></a>
						<table id="navi_table" cellspacing="0" cellpadding="0" style="width: 150px;">
							<tr>
								<td class="menu">
									<?php
										if($funct->CheckLogin())
										{?>
											<?php
											if($_SESSION['access'] == ADMIN)
											{ ?>
												<a href="<?php echo HOMEPAGE; ?>">Server Homepage</a>
												<a href="admin.php">Control Panel Home</a>
												<a href="<?php echo SERVER; ?>dorf1.php">Return to the server</a>
												<a href="?p=update"><font color="Red"><b>Server Update (<?php echo $up_avl; ?>)</font></b></a>
												<br />
												<a href="?action=logout">Logout</a>
												<br />
												<a href="#"><b>Server Info</b></a>
												<a href="?p=server_info">Server Info</a>
												<a href="?p=online">Online Users</a>
												<a href="?p=notregistered">Players Not Activated</a>
												<a href="?p=[]inactive">Players Inactivate</a>
												<a href="?p=report">Players Reported</a>
												<a href="?p=map">Map</a>
												<br />
												<a href="#"><b>Search</b></a>
												<a href="?p=search">General Search</a>
												<a href="?p=message">Search IGMs/Reports</a>
												<br />
												<a href="#"><b>Ban</b></a>
												<a href="?p=ban">Ban/Unban Players</a>
												<a href="?p=maintenence">Server Maintenence</a>
												<a href="?p=cleanban">Clean Banlist Data</a>
												<br />
												<a href="#"><b>Gold</b></a>
												<a href="?p=gold">Give All Free Gold</a>
												<a href="?p=usergold">Give Free Gold To Specific User</a>
												<a href="?p=maintenenceResetGold">Reset Gold</a>
												<br />
												<a href="#"><b>Medals</b></a>
												<a href="?p=delmedal">Delete Player Medals</a>
												<a href="?p=delallymedal">Delete Ally Medals</a>
												<br />
												<a href="#"><b>Plus</b></a>
												<a href="?p=givePlus">Give All Plus</a>
												<a href="?p=maintenenceResetPlus">Reset Plus</a>
												<br />
												<a href="#"><b>Res Bonus</b></a>
												<a href="?p=givePlusRes">Give All Res Bonus</a>
												<a href="?p=maintenenceResetPlusBonus">Reset Res Bonus</a>
												<br />
												<a href="#"><b>Natars</b></a>
												<a href="?p=natarend">Add WW Villages</a>
												<a href="?p=natarbuildingplan">Add WW Building Plan Villages</a>
												<br />
												<a href="#"><b>Admin:</b></a>
												<a href="?p=admin_log"><font color="Red"><b>Admin Log</font></b></a>
												<a href="?p=config">Server Settings</a>
												<?php
											}
											else if($_SESSION['access'] == MULTIHUNTER)
											{ ?>
												<a href="admin.php">MCP Home</a>
												<a href="<?php echo HOMEPAGE; ?>">Homepage</a>
												<a href="#"></a><a href="#"></a>
												<a href="?p=server_info">Server Info</a>
												<a href="?p=online">Online users</a>
												<a href="?p=search">Search</a>
												<a href="?p=message">Msg/Rep</a>
												<a href="?p=ban">Ban</a>
												<a href="#"></a><a href="#"></a><a href="#"></a>
												<a href="?action=logout">Logout</a><?php
											}
										}
									?>
								</td>
							</tr>
						</table>
					</div>
					<div id="lmid1">
						<div id="lmid3">
							<?php
								if($funct->CheckLogin())
								{
									if($_POST or $_GET)
									{
										if($_GET['p'] and $_GET['p']!="search")
										{
											$filename = 'Templates/'.$_GET['p'].'.tpl';
											if(file_exists($filename))
											{
												include($filename);
											}
											else
											{
												include('Templates/404.tpl');
											}
										}
										else
										{
											include('Templates/search.tpl');
										}
										if($_POST['p'] and $_POST['s'])
										{
											$filename = 'Templates/results_'.$_POST['p'].'.tpl';
											if(file_exists($filename))
											{
												include($filename);
											}
											else
											{
												include('Templates/404.tpl');
											}
										}
									}
									else
									{
										include('Templates/home.tpl');
									}
								}
								else
								{
									include('Templates/login.tpl');
								}
							?>
						</div>
					</div>
				</div>
			<div id="lright1"></div>
			<div id="ce"></div>
		</div>
	</body>
</html>
