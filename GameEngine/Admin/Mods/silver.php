<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       ZravianX                                                    ##
##  Version:       2011.12.03                                                  ##
##  Filename:      GameEngine/Admin/Mods/silver.php                            ##
##  Developed by:  ZZJHONS                                                     ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     ZravianX (c) 2011 - All rights reserved                     ##
##  URLs:          http://zravianx.zzjhons.com                                 ##
##  Source code:   http://www.github.com/ZZJHONS/ZravianX                      ##
##                                                                             ##
#################################################################################

include_once("../../Account.php");
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);
if ($session->access < ADMIN) die("Access Denied: You aren't Admin!");
$id = $_POST['id'];
$silver = $_POST['silver'];
$q = "UPDATE ".TB_PREFIX."users SET silver = silver + ".$_POST['silver']." WHERE id != '0'";
mysql_query($q);
mysql_query("Insert into ".TB_PREFIX."admin_log values (0,$id,'Added <b>$silver</b> silver to all users',".time().")");
header("Location: ../../../admin.php?p=give&s=$silver");
?>