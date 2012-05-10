<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       index.php                                                   ##
##  Developed by:  Dzoki                                                       ##
##  Reworked:      aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################
include("../GameEngine/config.php");
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
		<div id="ltop1">
			<div style="position:relative; width:231px; height:100px; float:left;">
				<img src="../img/x.gif" width="1" height="1">
			</div>
			<img class="fl2" src="../img/admin/x1.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"><img class="fl2" src="../img/admin/x2.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"><img class="fl2" src="../img/admin/x3.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"><img class="fl2" src="../img/admin/x4.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"><img class="fl2" src="../img/admin/x5.gif" width="70" height="100" border="0" onmouseover="this.className='fl1'" onmouseout="this.className='fl2'"></div>
			<div id="lmidall">
				<div id="lmidlc">
					<div id="lleft">
						<a href="<?php echo HOMEPAGE; ?>"><img src="../img/en/a/travian0.gif" class="logo_plus" width="116" height="60" border="0"></a>
					</div>
					<div id="lmid1">
						<div id="lmid3">
							<center>
								<img src="../gpack/travian_default/img/misc/403.gif"><br /><br />
								<table id="member">
									<thead>
										<tr>
											<th colspan="2">Who are you?</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<center><a href="admin.php">Server Admin</a></center>
											</td>
											<td>
												<center><a href="multihunter.php">Multihunter</a></center>
											</td>
										</tr>
									</tbody>
								</table>
							</center>
						</div>  
					</div>
				</div>  
			<div id="lright1"></div>
			<div id="ce"></div>
		</div>
	</body>
</html>

