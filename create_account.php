<?php
include_once("GameEngine/Generator.php");
$start_timer = $generator->pageLoadTimeStart();

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ##
##  Filename       create_account.php                                          ##
##  Developed by:  Dzoki , Advocaite , Donnchadh , yi12345 , Shadow , MisterX  ##
##  Fixed by:      Shadow & MisterX - Scouting all players , artefact names.   ##
##  Fixed by:      InCube - double troops				       ##
##  Fixed by:      ronix						       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ##
##                                                                             ##
#################################################################################


use App\Entity\User;
use App\Utils\AccessLogger;

global $autoprefix;

// go max 5 levels up - we don't have folders that go deeper than that
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix.'autoloader.php')) {
        // we have our path, let's leave
        break;
    }
}

include_once ($autoprefix."GameEngine/Session.php");
include_once ($autoprefix."GameEngine/config.php");
AccessLogger::logRequest();


/**
 * If user is not administrator, access is denied!
 */
		if($session->access < ADMIN){
			die("Access Denied: You are not Admin!");
			}else{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo SERVER_NAME ?> - Account Creation</title>
	<link rel="shortcut icon" href="favicon.ico"/>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-full.js?0faab" type="text/javascript"></script>
	<script src="unx.js?f4b7h" type="text/javascript"></script>
	<script src="new.js?0faab" type="text/javascript"></script>
	<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?e21d2" rel="stylesheet" type="text/css" />
	<?php
	if($session->gpack == null || GP_ENABLE == false) {
	echo "
	<link href='".GP_LOCATE."travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='".GP_LOCATE."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
	} else {
	echo "
	<link href='".$session->gpack."travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='".$session->gpack."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
	}
	?>
	<script type="text/javascript">
	window.addEvent('domready', start);
	</script>
</head>


<body class="v35 ie ie8">
<div class="wrapper">
<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" />
<div id="dynamic_header">
	</div>
<?php include("Templates/header.tpl"); ?>
<div id="mid">
<?php include("Templates/menu.tpl"); ?>
<div id="content"  class="village1">
<?php
/**
 * Functions
 */
if(!User::exists($database, 'Natars')){

/**
 * Creating account & capital village - Fixed by Shadow - cata7007@gmail.com / Skype : cata7007 - reworked by iopietro
 */

		$database->createNatars();

		$artifactArrays =  [ARCHITECTS_DESC => [["type" => 1, "size" => 1, "name" => ARCHITECTS_SMALL, "vname" => ARCHITECTS_SMALLVILLAGE, "effect" => "(4x)", "quantity" => 6, "img" => 2],
												["type" => 1, "size" => 2, "name" => ARCHITECTS_LARGE, "vname" => ARCHITECTS_LARGEVILLAGE, "effect" => "(3x)", "quantity" => 4, "img" => 2],
												["type" => 1, "size" => 3, "name" => ARCHITECTS_UNIQUE,"vname" => ARCHITECTS_UNIQUEVILLAGE, "effect" => "(5x)", "quantity" => 1, "img" => 2]],
				
								HASTE_DESC => [["type" => 2, "size" => 1, "name" => HASTE_SMALL, "vname" => HASTE_SMALLVILLAGE, "effect" => "(2x)", "quantity" => 6, "img" => 4],
												["type" => 2, "size" => 2, "name" => HASTE_LARGE, "vname" => HASTE_LARGEVILLAGE, "effect" => "(1.5x)", "quantity" => 4, "img" => 4],
												["type" => 2, "size" => 3, "name" => HASTE_UNIQUE, "vname" => HASTE_UNIQUEVILLAGE, "effect" => "(3x)", "quantity" => 1, "img" => 4]],
				
							 EYESIGHT_DESC => [["type" => 3, "size" => 1, "name" => EYESIGHT_SMALL, "vname" => EYESIGHT_SMALLVILLAGE, "effect" => "(5x)", "quantity" => 6, "img" => 5],
												["type" => 3, "size" => 2, "name" => EYESIGHT_LARGE, "vname" => EYESIGHT_LARGEVILLAGE, "effect" => "(3x)", "quantity" => 4, "img" => 5],
												["type" => 3, "size" => 3, "name" => EYESIGHT_UNIQUE, "vname" => EYESIGHT_UNIQUEVILLAGE, "effect" => "(10x)", "quantity" => 1, "img" => 5]],
				
								 DIET_DESC => [["type" => 4, "size" => 1, "name" => DIET_SMALL, "vname" => DIET_SMALLVILLAGE, "effect" => "(50%)", "quantity" => 6, "img" => 6],
												["type" => 4, "size" => 2, "name" => DIET_LARGE, "vname" => DIET_LARGEVILLAGE, "effect" => "(25%)", "quantity" => 4, "img" => 6],
												["type" => 4, "size" => 3, "name" => DIET_UNIQUE, "vname" => DIET_UNIQUEVILLAGE, "effect" => "(50%)", "quantity" => 1, "img" => 6]],
				
							 ACADEMIC_DESC => [["type" => 5, "size" => 1, "name" => ACADEMIC_SMALL, "vname" => ACADEMIC_SMALLVILLAGE, "effect" => "(50%)", "quantity" => 6, "img" => 8],
												["type" => 5, "size" => 2, "name" => ACADEMIC_LARGE, "vname" => ACADEMIC_LARGEVILLAGE, "effect" => "(25%)", "quantity" => 4, "img" => 8],
												["type" => 5, "size" => 3, "name" => ACADEMIC_UNIQUE, "vname" => ACADEMIC_UNIQUEVILLAGE, "effect" => "(50%)", "quantity" => 1, "img" => 8]],
				
							   STORAGE_DESC => [["type" => 6, "size" => 1, "name" => STORAGE_SMALL, "vname" => STORAGE_SMALLVILLAGE, "effect" => "(50%)", "quantity" => 6, "img" => 9],
											    ["type" => 6, "size" => 2, "name" => STORAGE_LARGE, "vname" => STORAGE_LARGEVILLAGE, "effect" => "(25%)", "quantity" => 4, "img" => 9]],
				
							 CONFUSION_DESC => [["type" => 7, "size" => 1, "name" => CONFUSION_SMALL, "vname" => CONFUSION_SMALLVILLAGE, "effect" => "(200)", "quantity" => 6, "img" => 10],
												["type" => 7, "size" => 2, "name" => CONFUSION_LARGE, "vname" => CONFUSION_LARGEVILLAGE, "effect" => "(100)", "quantity" => 4, "img" => 10],
												["type" => 7, "size" => 3, "name" => CONFUSION_UNIQUE, "vname" => CONFUSION_UNIQUEVILLAGE, "effect" => "(500)", "quantity" => 1, "img" => 10]],
				
								  FOOL_DESC => [["type" => 8, "size" => 1, "name" => FOOL_SMALL, "vname" => FOOL_SMALLVILLAGE, "effect" => "", "quantity" => 5, "img" => "fool"],
												["type" => 8, "size" => 3, "name" => FOOL_UNIQUE, "vname" => FOOL_UNIQUEVILLAGE, "effect" => "", "quantity" => 1, "img" => "fool"]]];
		
  		//Add artefacts and their villages
  		$database->addArtifactVillages($artifactArrays);
  		
  		//Write the system message
  		$database->displaySystemMessage(ARTEFACT);
        
        echo '<p><span class=\"c2\">Done: Natars created and artifacts spawned!</span></p>';
}else{
?>
<p>
<span class="c2">Error: Natar account already exists</span>
</p>
<?php
}
?>
</div>
<br /><br /><br /><br /><div id="side_info">
<?php
include("Templates/multivillage.tpl");
include("Templates/quest.tpl");
include("Templates/news.tpl");
?>
</div>
<div class="clear"></div>
</div>
<div class="footer-stopper"></div>
<div class="clear"></div>

<?php
include("Templates/footer.tpl");
include("Templates/res.tpl")
?>
<div id="stime">
<div id="ltime">
<div id="ltimeWrap">
<?php echo CALCULATED_IN;?> <b><?php
echo round(($generator->pageLoadTimeEnd()-$start_timer)*1000);
?></b> ms

<br /><?php echo SEVER_TIME;?> <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
</div>
	</div>
</div>

<div id="ce"></div>
</body>
</html>
<?php
}
?>
