<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : anmelden.php                      	                       ##
##  Type           : In Game Registration Page (3 step wizard)                 ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki 						                               ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  URLs:          : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

use App\Utils\AccessLogger;

if(!file_exists('var/installed') && @opendir('install')) {
    header("Location: install/");
    exit;
}

include('GameEngine/Account.php');
AccessLogger::logRequest();

$invited=(isset($_GET['uid'])) ? filter_var($_GET['uid'], FILTER_SANITIZE_NUMBER_INT):$form->getError('invt');

/*
 * ---------------------------------------------------------------------------
 *  Registration wizard data
 * ---------------------------------------------------------------------------
 *  Every label below can be overridden from the language files: if a constant
 *  with the given name exists it wins, otherwise the English fallback is used.
 *  No changes are required in lang/*.php for the page to work.
 */
if (!function_exists('regText')) {
    function regText($constant, $fallback) {
        return defined($constant) ? constant($constant) : $fallback;
    }
}

/* id => tribe definition. The order of this array is the order of the cards. */
$regTribes = array(
    3 => array( /* Gauls   */
        'name'  => TRIBE3,
        'flag'  => true,
        'best'  => true,
        'lines' => array(
            regText('TRIBE3_L1', 'Low time requirements'),
            regText('TRIBE3_L2', 'Loot protection and good defense'),
            regText('TRIBE3_L3', 'Excellent, fast cavalry'),
            regText('TRIBE3_L4', 'Well suited to new players'),
        ),
    ),
    1 => array( /* Romans  */
        'name'  => TRIBE1,
        'flag'  => true,
        'best'  => false,
        'lines' => array(
            regText('TRIBE1_L1', 'Moderate time requirements'),
            regText('TRIBE1_L2', 'Can develop villages the fastest'),
            regText('TRIBE1_L3', 'Very strong but expensive troops'),
            regText('TRIBE1_L4', 'Hard to play for new players'),
        ),
    ),
    2 => array( /* Teutons */
        'name'  => TRIBE2,
        'flag'  => true,
        'best'  => false,
        'lines' => array(
            regText('TRIBE2_L1', 'High time requirements'),
            regText('TRIBE2_L2', 'Good at looting in early game'),
            regText('TRIBE2_L3', 'Strong, cheap infantry'),
            regText('TRIBE2_L4', 'For aggressive players'),
        ),
    ),
    7 => array( /* Egyptians */
        'name'  => defined('TRIBE7') ? TRIBE7 : 'Egyptians',
        'flag'  => (defined('NEW_FUNCTION_TRIBE_EGIPTEANS') && NEW_FUNCTION_TRIBE_EGIPTEANS),
        'best'  => false,
        'lines' => array(
            regText('TRIBE7_L1', 'Low time requirements'),
            regText('TRIBE7_L2', 'More resources available'),
            regText('TRIBE7_L3', 'Excellent defensive units'),
            regText('TRIBE7_L4', 'Well suited to new players'),
        ),
    ),
    6 => array( /* Huns */
        'name'  => defined('TRIBE6') ? TRIBE6 : 'Huns',
        'flag'  => (defined('NEW_FUNCTION_TRIBE_HUNS') && NEW_FUNCTION_TRIBE_HUNS),
        'best'  => false,
        'lines' => array(
            regText('TRIBE6_L1', 'High time requirements'),
            regText('TRIBE6_L2', 'Impressively strong cavalry'),
            regText('TRIBE6_L3', 'Reliant on others for protection'),
            regText('TRIBE6_L4', 'Not recommended for new players!'),
        ),
    ),
    8 => array( /* Spartans */
        'name'  => defined('TRIBE8') ? TRIBE8 : 'Spartans',
        'flag'  => (defined('NEW_FUNCTION_TRIBE_SPARTANS') && NEW_FUNCTION_TRIBE_SPARTANS),
        'best'  => false,
        'lines' => array(
            regText('TRIBE8_L1', 'Moderate time requirements'),
            regText('TRIBE8_L2', 'Efficient crop consumption'),
            regText('TRIBE8_L3', 'Easier recovery from battles'),
            regText('TRIBE8_L4', 'Recommended for active new players'),
        ),
    ),
    9 => array( /* Vikings */
        'name'  => defined('TRIBE9') ? TRIBE9 : 'Vikings',
        'flag'  => (defined('NEW_FUNCTION_TRIBE_VIKINGS') && NEW_FUNCTION_TRIBE_VIKINGS),
        'best'  => false,
        'lines' => array(
            regText('TRIBE9_L1', 'High time requirements'),
            regText('TRIBE9_L2', 'Fearless raiders, strong offense'),
            regText('TRIBE9_L3', 'Weak defense in the early game'),
            regText('TRIBE9_L4', 'Not recommended for new players!'),
        ),
    ),
);

/* Drop every tribe that is disabled by the install feature flags. */
foreach ($regTribes as $tribeId => $tribeData) {
    if (!$tribeData['flag']) {
        unset($regTribes[$tribeId]);
    }
}

/* Starting positions: 0 = random, 1 = NW (-|+), 2 = NE (+|+), 3 = SW (-|-), 4 = SE (+|-) */
$regQuadrants = array(
    0 => array('name' => RANDOM, 'coords' => ''),
    1 => array('name' => NW,     'coords' => '(-|+)'),
    2 => array('name' => NE,     'coords' => '(+|+)'),
    3 => array('name' => SW,     'coords' => '(-|-)'),
    4 => array('name' => SE,     'coords' => '(+|-)'),
);

/* Values coming back from a failed POST (Account::Signup redirects here). */
$regErrors  = ($form->returnErrors() > 0);
$regTribe   = (int) $form->getValue('vid');
if (!isset($regTribes[$regTribe])) {
    reset($regTribes);
    $regTribe = (int) key($regTribes);   // first card = Gauls (the recommended tribe)
}
$regQuad = (int) $form->getValue('kid');
if (!isset($regQuadrants[$regQuad])) {
    $regQuad = 0;
}
/* When the server rejected the form we jump straight back to the recap step. */
$regStep = $regErrors ? 3 : 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
	<title><?php echo SERVER_NAME; ?> - Registration</title>
		<link rel="shortcut icon" href="favicon.ico"/>
	<meta name="content-language" content="en" />
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-core.js?0faab" type="text/javascript"></script>
	<script src="mt-more.js?0faab" type="text/javascript"></script>
	<script src="unx.js?f4b7h" type="text/javascript"></script>
	<script src="new.js?0faab" type="text/javascript"></script>
	<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE ?>travian.css?f4b7d" rel="stylesheet" type="text/css" />
		<link href="<?php echo GP_LOCATE ?>lang/en/lang.css" rel="stylesheet" type="text/css" />

<style type="text/css">
/* ======================================================================== */
/*  Registration wizard - fits inside the original #content.signup column    */
/* ======================================================================== */
#regwiz{position:relative;width:100%;max-width:520px;margin:0 auto 10px;text-align:left;
        font-family:Arial,Helvetica,sans-serif;-webkit-box-sizing:border-box;box-sizing:border-box}
#regwiz *{-webkit-box-sizing:border-box;box-sizing:border-box}

/* --- window chrome (sliced from the original artwork) ------------------- */
.rw-hdr{position:relative;height:72px;background:url(img/reg/hdr_c.png) repeat-x left top;padding:26px 56px 0}
.rw-hdr:before,.rw-hdr:after{content:'';position:absolute;top:0;width:48px;height:72px}
.rw-hdr:before{left:0;background:url(img/reg/hdr_l.png) no-repeat left top}
.rw-hdr:after{right:0;background:url(img/reg/hdr_r.png) no-repeat left top}
.rw-hdr span{display:block;font:bold 19px/20px "Times New Roman",Georgia,serif;color:#f3ece1;
             letter-spacing:.5px;text-shadow:1px 1px 1px rgba(60,45,25,.85)}
.rw-body{position:relative;padding:12px 18px 6px;
         background:url(img/reg/side_l.png) repeat-y left top,
                    url(img/reg/side_r.png) repeat-y right top,
                    url(img/reg/silhouettes.png) no-repeat center bottom,
                    #f4efe5;
         background-size:9px auto,9px auto,100% auto,auto}
.rw-bot{position:relative;height:16px;background:url(img/reg/bot_c.png) repeat-x left top}
.rw-bot:before,.rw-bot:after{content:'';position:absolute;top:0;width:48px;height:16px}
.rw-bot:before{left:0;background:url(img/reg/bot_l.png) no-repeat left top}
.rw-bot:after{right:0;background:url(img/reg/bot_r.png) no-repeat left top}

.rw-step{display:none}
.rw-step.on{display:block}
.rw-intro{margin:2px 0 12px;font:bold 12px/17px Arial,Helvetica,sans-serif;color:#6a5c4a}

/* --- step 1 : tribe cards ----------------------------------------------- */
.rw-thumbs{display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;
           -webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;margin:0 0 16px;padding:0;list-style:none}
.rw-thumb{position:relative;-webkit-box-flex:1;-ms-flex:1 1 44px;flex:1 1 44px;max-width:64px;margin:0 2px;
          padding:2px;background:#f6f0e2;border:2px solid #a58e60;border-radius:3px;cursor:pointer;
          box-shadow:inset 0 0 2px rgba(0,0,0,.15)}
.rw-thumb img{display:block;width:100%;height:auto;border:0}
.rw-thumb:hover{border-color:#c9ad72}
.rw-thumb.sel{border-color:#5e8c2d;box-shadow:0 0 4px rgba(94,140,45,.65)}
.rw-thumb.sel:before,.rw-thumb.sel:after{content:'';position:absolute;left:50%;width:0;height:0}
.rw-thumb.sel:before{bottom:-16px;margin-left:-11px;border-left:11px solid transparent;
                     border-right:11px solid transparent;border-bottom:14px solid #a58e60}
.rw-thumb.sel:after{bottom:-13px;margin-left:-8px;border-left:8px solid transparent;
                    border-right:8px solid transparent;border-bottom:10px solid #6fa03a}

.rw-panel{position:relative;height:212px;padding:14px 16px;background:#eee4cc;border:1px solid #bfaf9c;
          border-radius:4px;box-shadow:0 2px 3px rgba(0,0,0,.16);overflow:hidden}
.rw-info{display:none}
.rw-info.on{display:block}
.rw-name{margin:2px 0 12px;font:bold 26px/26px "Times New Roman",Georgia,serif;color:#7c2f22;
         text-transform:uppercase;letter-spacing:1px}
.rw-lines{margin:0;padding:0;list-style:none;position:relative;z-index:2}
.rw-lines li{min-height:24px;padding:3px 0 3px 30px;font:bold 12px/18px Arial,Helvetica,sans-serif;color:#5b4a36;
             background-repeat:no-repeat;background-position:0 50%;background-size:20px auto}
.rw-portrait{position:absolute;right:0;bottom:0;height:100%;width:auto;z-index:1;border:0}
.rw-badge{position:absolute;top:-2px;right:38%;width:150px;max-width:31%;z-index:3;border:0}

/* --- step 2 : starting position ----------------------------------------- */
.rw-map{position:relative;width:340px;max-width:100%;margin:0 auto 4px}
.rw-map img.rw-mapbg{display:block;width:100%;height:auto;border:0}
.rw-q{position:absolute;cursor:pointer;border-radius:2px}
.rw-q1{left:7.3%;top:7.9%;width:43.5%;height:43.6%}
.rw-q2{left:51.1%;top:7.9%;width:44.2%;height:43.6%}
.rw-q3{left:7.3%;top:51.8%;width:43.5%;height:42.9%}
.rw-q4{left:51.1%;top:51.8%;width:44.2%;height:42.9%}
.rw-q:hover{background:rgba(255,255,255,.22)}
.rw-map.picked .rw-q{background:rgba(0,0,0,.075)}
.rw-map.picked .rw-q:hover{background:rgba(0,0,0,.03)}
.rw-map.picked .rw-q.sel{background:none;box-shadow:inset 0 0 0 2px rgba(95,140,45,.85)}
.rw-rand{display:block;width:200px;margin:10px auto 0;padding:5px 0;text-align:center;cursor:pointer;
         font:bold 12px Arial,Helvetica,sans-serif;color:#5b4a36;background:#eee4cc;border:1px solid #bfaf9c;
         border-radius:3px}
.rw-rand.sel{border-color:#5e8c2d;color:#3f5d1e;box-shadow:0 0 3px rgba(94,140,45,.5)}

/* --- step 3 : recap ------------------------------------------------------ */
.rw-cards{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;
          justify-content:center;margin:4px 0 14px}
.rw-card{position:relative;width:47%;margin:0 2.5%;padding:8px 8px 26px;background:#eee4cc;border:1px solid #bfaf9c;
         border-radius:4px;box-shadow:0 2px 3px rgba(0,0,0,.16);text-align:center}
.rw-card h3{margin:2px 0 6px;font:bold 20px/22px "Times New Roman",Georgia,serif;color:#7c2f22;
            text-transform:uppercase;letter-spacing:1px}
.rw-pic{height:172px;background-position:center bottom;background-repeat:no-repeat;background-size:cover;border-radius:2px}
.rw-pic-tribe{background-size:auto 100%}
.rw-change{position:absolute;left:0;bottom:6px;width:100%;text-align:center;cursor:pointer;
           font:bold 12px Arial,Helvetica,sans-serif;color:#5c8a1f}
.rw-change:hover{text-decoration:underline}
.rw-field{margin:0 0 8px}
.rw-field label{display:block;margin:0 0 3px;font:bold 12px Arial,Helvetica,sans-serif;color:#5b4a36}
.rw-field input.rw-text{width:100%;height:32px;padding:0 8px;border:1px solid #b9ab93;border-radius:3px;
                        background:#fff;font:14px Arial,Helvetica,sans-serif;color:#3f3628}
.rw-field .error{display:block;font:bold 11px Arial;color:#c0392b}
.rw-note{margin:8px 0 10px;padding:9px 10px 9px 36px;background:#dfe7f5;border:1px solid #b9c9e2;border-radius:3px;
         font:12px/16px Arial,Helvetica,sans-serif;color:#3f4a5c;position:relative}
.rw-note:before{content:'i';position:absolute;left:10px;top:50%;margin-top:-8px;width:16px;height:16px;
                border-radius:8px;background:#3f6fb5;color:#fff;font:bold 11px/16px Georgia,serif;text-align:center}
.rw-agree{margin:0 0 4px;font:bold 12px/16px Arial,Helvetica,sans-serif;color:#5b4a36}
.rw-agree input{vertical-align:middle;margin:0 5px 2px 0}
ul.rw-err{margin:0 0 6px;padding:0 0 0 16px;color:#c0392b;font:bold 12px/17px Arial}

/* --- buttons ------------------------------------------------------------- */
.rw-btn{display:block;width:260px;max-width:90%;height:49px;margin:14px auto 6px;padding:0;border:0;cursor:pointer;
        background:url(img/reg/btn_green.png) no-repeat center center;background-size:100% 100%;
        font:bold 17px/49px "Times New Roman",Georgia,serif;color:#fff;letter-spacing:.5px;
        text-shadow:0 1px 2px rgba(0,0,0,.55)}
.rw-btn:hover{-webkit-filter:brightness(1.08);filter:brightness(1.08)}
.rw-back{display:block;margin:4px 0 0;font:bold 12px Arial;color:#5c8a1f;cursor:pointer}
.rw-back:hover{text-decoration:underline}
.rw-foot{margin:2px 0 0;text-align:center;font:11px Arial;color:#8a7a63}
</style>
	   </head>

<body class="v35 ie ie7" onload="initCounter()">

<div class="wrapper">
<div id="dynamic_header">
</div>
<div id="header"></div>
<div id="mid">
<?php include("Templates/menu.tpl");
if(REG_OPEN == true){ ?>
<div id="content"  class="signup">

<h1><img src="img/x.gif" class="anmelden" alt="register for the game" /></h1>

<form name="snd" method="post" action="anmelden.php" id="regform">
<input type="hidden" name="invited" value="<?php echo htmlspecialchars($invited, ENT_QUOTES, 'UTF-8'); ?>" />
<input type="hidden" name="ft" value="a1" />
<input type="hidden" name="vid" id="rw_vid" value="<?php echo (int) $regTribe; ?>" />
<input type="hidden" name="kid" id="rw_kid" value="<?php echo (int) $regQuad; ?>" />

<div id="regwiz" data-step="<?php echo (int) $regStep; ?>">
	<div class="rw-hdr"><span id="rw_title">&nbsp;</span></div>
	<div class="rw-body">

	<!-- =============== STEP 1 : tribe =============== -->
	<div class="rw-step" id="rw_step1">
		<p class="rw-intro"><?php echo regText('REG_TRIBE_INTRO', 'Great empires begin with important decisions! Are you an attacker who loves competition? Or is your time investment rather low? Are you a team player who enjoys building up a thriving economy to forge the anvil?'); ?></p>

		<ul class="rw-thumbs">
<?php foreach ($regTribes as $tribeId => $tribeData) { ?>
			<li class="rw-thumb<?php echo ($tribeId == $regTribe) ? ' sel' : ''; ?>" data-vid="<?php echo (int) $tribeId; ?>" title="<?php echo htmlspecialchars($tribeData['name'], ENT_QUOTES, 'UTF-8'); ?>">
				<img src="img/reg/thumb_v<?php echo (int) $tribeId; ?>.png" alt="<?php echo htmlspecialchars($tribeData['name'], ENT_QUOTES, 'UTF-8'); ?>" />
			</li>
<?php } ?>
		</ul>

		<div class="rw-panel">
<?php foreach ($regTribes as $tribeId => $tribeData) { ?>
			<div class="rw-info<?php echo ($tribeId == $regTribe) ? ' on' : ''; ?>" id="rw_info<?php echo (int) $tribeId; ?>">
				<img class="rw-portrait" src="img/reg/portrait_v<?php echo (int) $tribeId; ?>.png" alt="" />
<?php     if ($tribeData['best']) { ?>
				<img class="rw-badge" src="img/reg/badge_new.png" alt="recommended for new players" />
<?php     } ?>
				<h2 class="rw-name"><?php echo htmlspecialchars($tribeData['name'], ENT_QUOTES, 'UTF-8'); ?></h2>
				<ul class="rw-lines">
<?php     foreach ($tribeData['lines'] as $line) { ?>
					<li style="background-image:url(img/reg/bullet_v<?php echo (int) $tribeId; ?>.png)"><?php echo htmlspecialchars($line, ENT_QUOTES, 'UTF-8'); ?></li>
<?php     } ?>
				</ul>
			</div>
<?php } ?>
		</div>

		<button type="button" class="rw-btn" id="rw_next1"><?php echo regText('REG_CONFIRM', 'Confirm'); ?></button>
	</div>

	<!-- =============== STEP 2 : starting position =============== -->
	<div class="rw-step" id="rw_step2">
		<p class="rw-intro"><?php echo regText('REG_POS_INTRO', 'Where do you want to start building up your empire? Use the "recommended" area for the most ideal location. Or select the area where your friends are located and team up!'); ?></p>

		<div class="rw-map<?php echo ($regQuad > 0) ? ' picked' : ''; ?>" id="rw_map">
			<img class="rw-mapbg" src="img/reg/map.png" alt="world map" />
<?php for ($k = 1; $k <= 4; $k++) { ?>
			<div class="rw-q rw-q<?php echo $k; ?><?php echo ($regQuad == $k) ? ' sel' : ''; ?>" data-kid="<?php echo $k; ?>" title="<?php echo htmlspecialchars($regQuadrants[$k]['name'] . ' ' . $regQuadrants[$k]['coords'], ENT_QUOTES, 'UTF-8'); ?>"></div>
<?php } ?>
		</div>

		<div class="rw-rand<?php echo ($regQuad == 0) ? ' sel' : ''; ?>" id="rw_rand"><?php echo RANDOM; ?></div>

		<button type="button" class="rw-btn" id="rw_next2"><?php echo regText('REG_CONFIRM', 'Confirm'); ?></button>
		<span class="rw-back" id="rw_back2">&laquo; <?php echo regText('REG_BACK', 'Back'); ?></span>
	</div>

	<!-- =============== STEP 3 : recap + account data =============== -->
	<div class="rw-step" id="rw_step3">
		<p class="rw-intro"><?php echo regText('REG_RECAP_INTRO', 'Confirm your choices, choose your avatar name, and start your adventure'); ?></p>

		<div class="rw-cards">
			<div class="rw-card">
				<h3 id="rw_r_tribe">&nbsp;</h3>
				<div class="rw-pic rw-pic-tribe" id="rw_r_tribepic"></div>
				<span class="rw-change" data-goto="1"><?php echo regText('REG_CHANGE', 'Change'); ?></span>
			</div>
			<div class="rw-card">
				<h3 id="rw_r_quad">&nbsp;</h3>
				<div class="rw-pic" id="rw_r_quadpic"></div>
				<span class="rw-change" data-goto="2"><?php echo regText('REG_CHANGE', 'Change'); ?></span>
			</div>
		</div>

		<div class="rw-field">
			<label for="rw_name"><?php echo regText('REG_AVATAR', 'Enter your avatar name:'); ?></label>
			<input class="rw-text" type="text" id="rw_name" name="name" maxlength="30" value="<?php echo htmlspecialchars($form->getValue('name'), ENT_QUOTES, 'UTF-8'); ?>" />
			<span class="error"><?php echo $form->getError('name'); ?></span>
		</div>

		<div class="rw-note"><?php echo regText('REG_AVATAR_HINT', 'This is your avatar name in the game world.'); ?></div>

		<div class="rw-field">
			<label for="rw_email"><?php echo EMAIL; ?></label>
			<input class="rw-text" type="text" id="rw_email" name="email" value="<?php echo htmlspecialchars(stripslashes($form->getValue('email')), ENT_QUOTES, 'UTF-8'); ?>" />
			<span class="error"><?php echo $form->getError('email'); ?></span>
		</div>

		<div class="rw-field">
			<label for="rw_pw"><?php echo PASSWORD; ?></label>
			<input class="rw-text" type="password" id="rw_pw" name="pw" maxlength="100" value="" />
			<span class="error"><?php echo $form->getError('pw'); ?></span>
		</div>

		<ul class="rw-err">
<?php
echo $form->getError('winner');
echo $form->getError('tribe');
echo $form->getError('agree');
?>
		</ul>

		<p class="rw-agree">
			<input class="check" type="checkbox" name="agb" value="1" <?php echo $form->getRadio('agb',1); ?>/><?php echo ACCEPT_RULES; ?>
		</p>

		<button type="submit" class="rw-btn" value="anmelden" name="s1" id="rw_submit"><?php echo regText('REG_PLAY', "Let's play"); ?></button>
		<span class="rw-back" id="rw_back3">&laquo; <?php echo regText('REG_BACK', 'Back'); ?></span>
	</div>

	<p class="rw-foot"><?php echo ONE_PER_SERVER; ?></p>
	</div>
	<div class="rw-bot"></div>
</div>
</form>
</div>

<script type="text/javascript">
/* ------------------------------------------------------------------ */
/*  Registration wizard - 3 steps, one single POST at the end          */
/* ------------------------------------------------------------------ */
(function () {
	var TRIBES = <?php
		$jsTribes = array();
		foreach ($regTribes as $tribeId => $tribeData) {
			$jsTribes[$tribeId] = $tribeData['name'];
		}
		echo json_encode($jsTribes);
	?>;
	var QUADS = <?php
		$jsQuads = array();
		foreach ($regQuadrants as $quadId => $quadData) {
			$jsQuads[$quadId] = $quadData['name'];
		}
		echo json_encode($jsQuads);
	?>;
	var TITLES = <?php echo json_encode(array(
		1 => regText('REG_STEP1_TITLE', 'Select your tribe'),
		2 => regText('REG_STEP2_TITLE', 'Select Starting Position'),
		3 => regText('REG_STEP3_TITLE', 'Confirm your selection'),
	)); ?>;

	var wiz = document.getElementById('regwiz');
	if (!wiz) { return; }

	var fVid   = document.getElementById('rw_vid'),
	    fKid   = document.getElementById('rw_kid'),
	    title  = document.getElementById('rw_title'),
	    map    = document.getElementById('rw_map'),
	    rand   = document.getElementById('rw_rand'),
	    rTribe = document.getElementById('rw_r_tribe'),
	    rQuad  = document.getElementById('rw_r_quad'),
	    pTribe = document.getElementById('rw_r_tribepic'),
	    pQuad  = document.getElementById('rw_r_quadpic'),
	    step   = parseInt(wiz.getAttribute('data-step'), 10) || 1;

	function showStep(n) {
		step = n;
		for (var i = 1; i <= 3; i++) {
			var el = document.getElementById('rw_step' + i);
			if (el) { el.className = 'rw-step' + (i === n ? ' on' : ''); }
		}
		title.innerHTML = TITLES[n];
		if (n === 3) { refreshRecap(); }
		if (window.scrollTo) { window.scrollTo(0, 0); }
	}

	function refreshRecap() {
		var v = fVid.value, k = fKid.value;
		rTribe.innerHTML = TRIBES[v] || '';
		rQuad.innerHTML  = QUADS[k] || '';
		pTribe.style.backgroundImage = 'url(img/reg/portrait_v' + v + '.png)';
		pQuad.style.backgroundImage  = 'url(img/reg/quad_' + k + '.png)';
	}

	/* ---- step 1 : tribe cards ---- */
	var thumbs = wiz.getElementsByClassName('rw-thumb');
	for (var t = 0; t < thumbs.length; t++) {
		thumbs[t].onclick = (function (node) {
			return function () {
				var vid = node.getAttribute('data-vid'), i;
				fVid.value = vid;
				for (i = 0; i < thumbs.length; i++) {
					thumbs[i].className = 'rw-thumb' + (thumbs[i] === node ? ' sel' : '');
				}
				var infos = wiz.getElementsByClassName('rw-info');
				for (i = 0; i < infos.length; i++) {
					infos[i].className = 'rw-info' + (infos[i].id === 'rw_info' + vid ? ' on' : '');
				}
			};
		})(thumbs[t]);
	}

	/* ---- step 2 : quadrants ---- */
	var quads = wiz.getElementsByClassName('rw-q');
	function markQuad(kid) {
		fKid.value = kid;
		for (var i = 0; i < quads.length; i++) {
			var on = (quads[i].getAttribute('data-kid') === String(kid));
			quads[i].className = 'rw-q rw-q' + quads[i].getAttribute('data-kid') + (on ? ' sel' : '');
		}
		map.className = 'rw-map' + (kid > 0 ? ' picked' : '');
		rand.className = 'rw-rand' + (kid > 0 ? '' : ' sel');
	}
	for (var q = 0; q < quads.length; q++) {
		quads[q].onclick = (function (node) {
			return function () { markQuad(parseInt(node.getAttribute('data-kid'), 10)); };
		})(quads[q]);
	}
	rand.onclick = function () { markQuad(0); };

	/* ---- navigation ---- */
	document.getElementById('rw_next1').onclick = function () { showStep(2); };
	document.getElementById('rw_next2').onclick = function () { showStep(3); };
	document.getElementById('rw_back2').onclick = function () { showStep(1); };
	document.getElementById('rw_back3').onclick = function () { showStep(2); };

	var changes = wiz.getElementsByClassName('rw-change');
	for (var c = 0; c < changes.length; c++) {
		changes[c].onclick = (function (node) {
			return function () { showStep(parseInt(node.getAttribute('data-goto'), 10)); };
		})(changes[c]);
	}

	showStep(step);
})();
</script>
<noscript>
	<style type="text/css">.rw-step{display:block !important}</style>
</noscript>

<?php }else{ ?>
<div id="content"  class="signup">

<h1><img src="img/x.gif" class="anmelden" alt="register for the game" /></h1>
<h5><img src="img/x.gif" class="img_u05" alt="registration"/></h5>

<p><?php echo REGISTER_CLOSED; ?></p>
</div>
<?php } ?>
<div id="side_info" class="outgame">
<?php
if(NEWSBOX1) { include("Templates/News/newsbox1.tpl"); }
if(NEWSBOX2) { include("Templates/News/newsbox2.tpl"); }
if(NEWSBOX3) { include("Templates/News/newsbox3.tpl"); }
?>
			</div>

<div class="clear"></div>
			</div>

			<div class="footer-stopper outgame"></div>
			<div class="clear"></div>

<?php include("Templates/footer.tpl"); ?>
<div id="ce"></div>
</body>
</html>
