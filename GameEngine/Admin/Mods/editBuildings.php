<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editBuildings.php                                           ##
##  Developed by:  aggenkeech                                                  ##
##  Fix by:        ronix                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2011-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################

if(!isset($_SESSION)) session_start();
if($_SESSION['access'] < 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

include_once("../../config.php");

// go max 5 levels up - we don't have folders that go deeper than that
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix.'autoloader.php')) {
        // we have our path, let's leave
        break;
    }
}

include_once($autoprefix."GameEngine/Database.php");

foreach ($_POST as $key => $value) {
    $_POST[$key] = $database->escape($value);
}

$id = (int) $_POST['id'];

mysqli_query($GLOBALS["link"], "UPDATE ".TB_PREFIX."fdata SET 
	f1  = '".$_POST['id1level']."', 
	f1t = '".$_POST['id1gid']."', 
	f2  = '".$_POST['id2level']."', 
	f2t = '".$_POST['id2gid']."', 
	f3  = '".$_POST['id3level']."', 
	f3t = '".$_POST['id3gid']."', 
	f4  = '".$_POST['id4level']."', 
	f4t = '".$_POST['id4gid']."', 
	f5  = '".$_POST['id5level']."', 
	f5t = '".$_POST['id5gid']."', 
	f6  = '".$_POST['id6level']."', 
	f6t = '".$_POST['id6gid']."', 
	f7  = '".$_POST['id7level']."', 
	f7t = '".$_POST['id7gid']."', 
	f8  = '".$_POST['id8level']."', 
	f8t = '".$_POST['id8gid']."', 
	f9  = '".$_POST['id9level']."', 
	f9t = '".$_POST['id9gid']."', 
	f10  = '".$_POST['id10level']."', 
	f10t = '".$_POST['id10gid']."', 
	f11  = '".$_POST['id11level']."', 
	f11t = '".$_POST['id11gid']."', 
	f12  = '".$_POST['id12level']."', 
	f12t = '".$_POST['id12gid']."', 
	f13  = '".$_POST['id13level']."', 
	f13t = '".$_POST['id13gid']."', 
	f14  = '".$_POST['id14level']."', 
	f14t = '".$_POST['id14gid']."', 
	f15  = '".$_POST['id15level']."', 
	f15t = '".$_POST['id15gid']."', 
	f16  = '".$_POST['id16level']."', 
	f16t = '".$_POST['id16gid']."', 
	f17  = '".$_POST['id17level']."', 
	f17t = '".$_POST['id17gid']."', 
	f18  = '".$_POST['id18level']."', 
	f18t = '".$_POST['id18gid']."', 
	f19  = '".$_POST['id19level']."', 
	f19t = '".$_POST['id19gid']."', 
	f20  = '".$_POST['id20level']."', 
	f20t = '".$_POST['id20gid']."', 
	f21  = '".$_POST['id21level']."', 
	f21t = '".$_POST['id21gid']."', 
	f22  = '".$_POST['id22level']."', 
	f22t = '".$_POST['id22gid']."', 
	f23  = '".$_POST['id23level']."', 
	f23t = '".$_POST['id23gid']."', 
	f24  = '".$_POST['id24level']."', 
	f24t = '".$_POST['id24gid']."', 
	f25  = '".$_POST['id25level']."', 
	f25t = '".$_POST['id25gid']."', 
	f26  = '".$_POST['id26level']."', 
	f26t = '".$_POST['id26gid']."', 
	f27  = '".$_POST['id27level']."', 
	f27t = '".$_POST['id27gid']."', 
	f28  = '".$_POST['id28level']."', 
	f28t = '".$_POST['id28gid']."', 
	f29  = '".$_POST['id29level']."', 
	f29t = '".$_POST['id29gid']."', 
	f30  = '".$_POST['id30level']."', 
	f30t = '".$_POST['id30gid']."', 
	f31  = '".$_POST['id31level']."', 
	f31t = '".$_POST['id31gid']."', 
	f32  = '".$_POST['id32level']."', 
	f32t = '".$_POST['id32gid']."', 
	f33  = '".$_POST['id33level']."', 
	f33t = '".$_POST['id33gid']."', 
	f34  = '".$_POST['id34level']."', 
	f34t = '".$_POST['id34gid']."', 
	f35  = '".$_POST['id35level']."', 
	f35t = '".$_POST['id35gid']."', 
	f36  = '".$_POST['id36level']."', 
	f36t = '".$_POST['id36gid']."', 
	f37  = '".$_POST['id37level']."', 
	f37t = '".$_POST['id37gid']."', 
	f38  = '".$_POST['id38level']."', 
	f38t = '".$_POST['id38gid']."', 
	f39  = '".$_POST['id39level']."', 
	f39t = '".$_POST['id39gid']."', 
	f40  = '".$_POST['id40level']."', 
	f40t = '".$_POST['id40gid']."',
    f99 = '".$_POST['id99level']."',
    f99t = '".$_POST['id99gid']."' 
	WHERE vref = $id") or die(mysqli_error($database->dblink));

header("Location: ../../../Admin/admin.php?p=village&did=".$id."");
?>
