<?php
include_once("GameEngine/Generator.php");
$start_timer = $generator->pageLoadTimeStart();

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       version.php                                                 ##
##  Developed by:  Shadow                                                      ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

use App\Utils\AccessLogger;

include_once("GameEngine/Village.php");
AccessLogger::logRequest();

$amount = $_SESSION['amount'];
if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	header("Location: ".$_SERVER['PHP_SELF']);
	exit;
}
else $building->procBuild($_GET);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo SERVER_NAME ?> - Game Version</title>
	<link rel="shortcut icon" href="favicon.ico"/>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-full.js?0faab" type="text/javascript"></script>
	<script src="unx.js?f4b7h" type="text/javascript"></script>
	<script src="new.js?0faab" type="text/javascript"></script>
	<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />
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
<?php include("Templates/version.tpl"); ?>
<div id="products">
<h1 style="text-align:center; margin-bottom:30px;">🏛️ Honoring the Original Developers</h1>

<div class="grid-container" style="
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    max-width: 900px;
    margin: 0 auto;
">
<?php
$developers = [
    ["ronix", "Developer & Contributor"],
    ["Dzoki", "Version starter"],
    ["Shadow", "Project Owner / Dev"],
    ["Advocaite", "Developer & Contributor"],
    ["yi12345", "Alumni Developer"],
    ["NarcisRO", "bug hunter"],
    ["brainiacX", "Alumni Developer"],
    ["InCube", "Alumni Developer"],
    ["akshay9", "Alumni Developer"],
    ["KFCSpike", "Alumni Developer"],
    ["nean", "Alumni Developer"],
    ["hexcoded", "Alumni Developer"],
    ["SlimZ", "Alumni Developer"],
    ["inblackhole", "Alumni Developer"],
    ["elio", "Your advise is always welcome"],
    ["AL3XAND3R or MisterX", "For keeping the faith"],
    ["Mr.php", "Alumni Developer"],
    ["Akakori", "Original Developer"],
    ["G3n3s!s", "Alumni Developer"],
    ["JimJam", "Alumni Developer"],
    ["LoppyLukas", "Alumni Developer"],
    ["Dixie", "Alumni Developer"],
    ["ZZJHONS", "Alumni Developer"],
    ["songeriux", "Alumni Developer"],
    ["TTMMTT", "Alumni Developer"],
    ["Donnchadh", "Alumni Developer"],
    ["DesPlus", "Alumni Developer"],
    ["Marvin", "Alumni Developer"],
    ["noonn", "Alumni Developer"],
    ["Armando", "Alumni Developer"],
    ["aggenkeech", "Alumni Developer"],
    ["Niko28", "Alumni Developer"],
    ["221V", "Developer"],
    ["martinambrus", "Alumni Developer"],
    ["iopietro", "Alumni Developer"],
    ["Vladyslav", "Rigorous game tester"],
    ["AL-Kateb", "Alumni Developer"]
];

// Primele 9 carduri normale
for ($i = 0; $i < 9; $i++) {
    $dev = $developers[$i];
    echo '<div class="developer-card" style="
        background: linear-gradient(135deg, #fefefe, #e6f0ff);
        border: 2px solid #3399ff;
        border-radius: 12px;
        padding: 15px;
        box-shadow: 3px 3px 10px rgba(0,0,0,0.2);
        text-align: center;
        transition: all 0.3s ease;
    " onmouseover="this.style.transform=\'translateY(-8px) scale(1.03)\'; this.style.boxShadow=\'6px 6px 20px rgba(0,0,0,0.3)\';" onmouseout="this.style.transform=\'translateY(0) scale(1)\'; this.style.boxShadow=\'3px 3px 10px rgba(0,0,0,0.2)\';">
        <div class="developer-name" style="font-weight:bold; font-size:1.2em; color:#004080;">'.$dev[0].'</div>
        <div class="developer-role" style="margin-top:8px; font-size:1em; color:#003366;">'.$dev[1].'</div>
    </div>';
}

// Cardul "Others" pentru restul
$others = array_slice($developers, 9);
$others_text = '';
foreach($others as $dev){
    $others_text .= $dev[0] . " — " . $dev[1] . "<br>";
}

echo '<div class="developer-card" style="
        background: linear-gradient(135deg, #fefefe, #e6f0ff);
        border: 2px solid #3399ff;
        border-radius: 12px;
        padding: 15px;
        box-shadow: 3px 3px 10px rgba(0,0,0,0.2);
        text-align: center;
        transition: all 0.3s ease;
        grid-column: span 3;
    " onmouseover="this.style.transform=\'translateY(-8px) scale(1.03)\'; this.style.boxShadow=\'6px 6px 20px rgba(0,0,0,0.3)\';" onmouseout="this.style.transform=\'translateY(0) scale(1)\'; this.style.boxShadow=\'3px 3px 10px rgba(0,0,0,0.2)\';">
        <div class="developer-name" style="font-weight:bold; font-size:1.2em; color:#004080;">+ '.count($others).' Others</div>
        <div class="developer-role" style="margin-top:8px; font-size:1em; color:#003366; text-align:left; max-height:250px; overflow-y:auto;">'.$others_text.'</div>
    </div>';
?>
</div>

<div class="footer-cards" style="
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 40px;
    flex-wrap: nowrap;
">

    <!-- TravianZ Team -->
    <a href="#" style="text-decoration:none; flex:1;">
        <div style="
            background: linear-gradient(135deg, #fff3e6, #ffe6ff);
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            box-shadow: 3px 3px 10px rgba(0,0,0,0.2);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100px; /* egal cu cardurile developerilor */
        " onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='6px 6px 20px rgba(0,0,0,0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='3px 3px 10px rgba(0,0,0,0.2)';">
            <div style="font-weight:bold; font-size:0.95em; color:#cc6600;">Released by</div>
            <div style="font-weight:bold; font-size:1.2em; margin-top:5px;">
                <span style="color:orange;">T</span><span style="color:green;">r</span><span style="color:orange;">a</span><span style="color:green;">v</span><span style="color:orange;">i</span><span style="color:green;">a</span><span style="color:orange;">n</span><span style="color:green;">Z</span>
            </div>
            <div style="font-weight:bold; font-size:1em; color:#800000; margin-top:5px;">Team</div>
        </div>
    </a>

    <!-- PayPal Donate -->
    <a href="https://paypal.me/cata7007" target="_blank" style="text-decoration:none; flex:1;">
        <div style="
            background: #e6f7ff;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            box-shadow: 3px 3px 10px rgba(0,0,0,0.2);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100px;
        " onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='6px 6px 20px rgba(0,0,0,0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='3px 3px 10px rgba(0,0,0,0.2)';">
            <img src="https://www.paypalobjects.com/webstatic/icon/pp258.png" alt="PayPal Donate" style="width:40px; height:40px; margin-bottom:8px;">
            <div style="font-weight:bold; font-size:1.1em; color:#004080;">Donate</div>
        </div>
    </a>

    <!-- GitHub -->
    <a href="https://github.com/Shadowss/TravianZ/archive/master.zip" target="_blank" style="text-decoration:none; flex:1;">
        <div style="
            background: #f0f0f0;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            box-shadow: 3px 3px 10px rgba(0,0,0,0.2);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100px;
        " onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='6px 6px 20px rgba(0,0,0,0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='3px 3px 10px rgba(0,0,0,0.2)';">
            <img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" alt="GitHub" style="width:35px; height:35px; margin-bottom:8px;">
            <div style="font-weight:bold; font-size:1.1em; color:#24292f;">GitHub</div>
            <div style="margin-top:3px; font-size:0.9em; color:#333;">Download</div>
        </div>
    </a>

</div>
</div>
</div>
<br /><br /><br /><br /><div id="side_info">
<?php
include("Templates/multivillage.tpl");
include("Templates/quest.tpl");
include("Templates/news.tpl");
if(!NEW_FUNCTIONS_DISPLAY_LINKS) {
	echo "<br><br><br><br>";
	include("Templates/links.tpl");
}
?>
</div>
<div class="clear"></div>
</div>
<div class="footer-stopper"></div>
<div class="clear"></div>

<?php
include("Templates/footer.tpl");
include("Templates/res.tpl");
?>
<div id="stime">
<div id="ltime">
<div id="ltimeWrap">
<?php echo CALCULATED_IN;?> <b><?php
echo round(($generator->pageLoadTimeEnd()-$start_timer)*1000);
?></b> ms

<br /><?php echo SERVER_TIME;?> <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
</div>
	</div>
</div>

<div id="ce"></div>
</body>
</html>
