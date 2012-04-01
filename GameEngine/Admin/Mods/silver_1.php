<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       ZravianX                                                    ##
##  Version:       2011.12.03                                                  ##
##  Filename:      GameEngine/Admin/Mods/silver_1.php                          ##
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
if ($session->access < ADMIN) die("Access Denied: You are not Admin!");

$id = $_POST['id'];
$admid = $_POST['admid'];
mysql_query("UPDATE ".TB_PREFIX."users SET silver = silver + ".$_POST['silver']." WHERE id = ".$id."");

$name = $database->getUserField($id,"username",0);
mysql_query("Insert into ".TB_PREFIX."admin_log values (0,$admid,'Added <b>".$_POST['silver']."</b> silver to user <a href=\'admin.php?p=player&uid=$id\'>$name</a> ',".time().")");

header("Location: ../../../admin.php?p=player&uid=".$id."&s=ok");
?>