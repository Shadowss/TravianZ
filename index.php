<?php
use App\Utils\AccessLogger;

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : index.php                      	                       ##
##  Type           : In Game Index Page                                        ##
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

//  Type : Public multi-instance homepage
//  TravianZ Multi-Instance


$installedWorlds = glob(__DIR__ . '/instances/s*/installed');
if (!$installedWorlds && @opendir(__DIR__ . '/install')) {
    header('Location: install/');
    exit;
}

require_once __DIR__ . '/GameEngine/config.php';
require_once __DIR__ . '/GameEngine/Database.php';
require_once __DIR__ . '/GameEngine/Instance/Registry.php';
require_once __DIR__ . '/GameEngine/Lang/loader.php';

tz_load_language(LANG);

if (file_exists('Security/Security.class.php')) {
    require 'Security/Security.class.php';
    Security::instance();
} else {
    die('Security: Please activate security class!');
}

error_reporting(E_ALL || E_NOTICE);
AccessLogger::logRequest();

/*
 * The homepage is deliberately independent from the currently selected game
 * database. InstanceRegistry opens a read-only connection to every installed
 * world so S1 statistics cannot accidentally be displayed for S2, etc.
 */
$worlds = InstanceRegistry::all();
$totalPlayers = 0;
$totalActive = 0;
$totalOnline = 0;

foreach ($worlds as $world) {
    $totalPlayers += (int) $world['stats']['players'];
    $totalActive  += (int) $world['stats']['active'];
    $totalOnline  += (int) $world['stats']['online'];
}

/** Escape dynamic values before they enter the public homepage. */
function tz_index_e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Build an instance-specific game URL from its public SERVER URL. */
function tz_index_server_link(array $world, $page)
{
    $base = rtrim((string) $world['server_url'], '/') . '/';
    return $base . ltrim($page, '/');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo SERVER_NAME; ?></title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" type="text/css" href="gpack/travian/main.css" />
    <link rel="stylesheet" type="text/css" href="gpack/travian/flaggs.css" />
    <link rel="stylesheet" type="text/css" href="gpack/travian/main_en.css" />
    <meta name="content-language" content="<?php echo LANG; ?>" />
    <meta http-equiv="imagetoolbar" content="no" />
    <script src="mt-core.js" type="text/javascript"></script>
    <script src="new.js?22102017" type="text/javascript"></script>
    <script src="new2.js?22102017" type="text/javascript"></script>
    <style type="text/css">
        ul.c1 { position:absolute; left:0px; width:686px; }
        div.c2 { left:237px; }
    </style>
</head>

<body class="presto indexPage">
<div class="wrapper">
    <div id="country_select">
        <div id="flags"></div>
        <script src="flaggen.js?a" type="text/javascript"></script>
        <script type="text/javascript">
            var region_list = new Array('Europe','America','Asia','Middle East','Africa','Oceania');
            show_flags('', '', region_list);
        </script>
    </div>

    <div id="header"><h1><?php echo $lang['index'][0][1]; ?></h1></div>

    <div id="navigation">
        <a href="index.php" class="home"><img src="img/x.gif" alt="Travian" /></a>
        <table class="menu">
            <tr>
                <td><a href="tutorial.php"><span><?php echo TUTORIAL; ?></span></a></td>
                <td><a href="anleitung.php"><span><?php echo $lang['index'][0][2]; ?></span></a></td>
                <td><a href="https://github.com/Shadowss/TravianZ/discussions" target="_blank"><span><?php echo FORUM; ?></span></a></td>
                <td><a href="?signup" class="signup_link mark"><span><?php echo $lang['register']; ?></span></a></td>
                <td><a href="?login" class="login_link"><span><?php echo LOGIN; ?></span></a></td>
            </tr>
        </table>
    </div>

    <?php if (T4_COMING == true) { ?>
    <div id="t4play">
        <a href="notification/"><img src="img/t4n/Teaser_Prelandingpage_EN.png" alt="Travian 4" /></a>
    </div>
    <?php } ?>

    <div id="register_now">
        <a href="?signup" class="signup_link"><?php echo $lang['register']; ?></a>
        <span><?php echo PLAY_NOW; ?></span>
    </div>

    <div id="content">
        <div class="grit">
            <div class="infobox">
                <div id="what_is_travian">
                    <h2><?php echo $lang['index'][0][4]; ?></h2>
                    <p><?php echo $lang['index'][0][5]; ?></p>
                    <p class="play_now"><a href="?signup" class="signup_link"><?php echo $lang['index'][0][6]; ?></a></p>
                </div>

                <div id="player_counter">
                    <table>
                        <tbody>
                            <tr>
                                <th><?php echo $lang['index'][0][7]; ?>:</th>
                                <td><?php echo $totalPlayers; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $lang['index'][0][8]; ?>:</th>
                                <td><?php echo $totalActive; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $lang['index'][0][9]; ?>:</th>
                                <td><?php echo $totalOnline; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div id="about_the_game">
                    <h2><?php echo $lang['index'][0][10]; ?>:</h2>
                    <ul>
                        <li><?php echo $lang['index'][0][11]; ?></li>
                        <li><?php echo $lang['index'][0][12]; ?></li>
                        <li><?php echo $lang['index'][0][13]; ?></li>
                    </ul>
                </div>
            </div>

            <div class="secondarybox">
                <div id="screenshots">
                    <h2><?php echo SCREENSHOTS; ?></h2>
                    <a href="#last" class="navi prev dynamic_btn"><img class="dynamic_btn" src="img/x.gif" alt="previous" /></a>
                    <div id="screenshots_preview">
                        <ul id="screenshot_list" class="c1">
                            <li><a href="#"><img src="img/un/s/s1s.jpg" alt="Screenshot" /></a></li>
                            <li><a href="#"><img src="img/un/s/s2s.jpg" alt="Screenshot" /></a></li>
                            <li><a href="#"><img src="img/un/s/s4s.jpg" alt="Screenshot" /></a></li>
                            <li><a href="#"><img src="img/un/s/s3s.jpg" alt="Screenshot" /></a></li>
                            <li><a href="#"><img src="img/un/s/s5s.jpg" alt="Screenshot" /></a></li>
                            <li><a href="#"><img src="img/un/s/s7s.jpg" alt="Screenshot" /></a></li>
                            <li><a href="#"><img src="img/un/s/s8s.jpg" alt="Screenshot" /></a></li>
                        </ul>
                    </div>
                    <a href="#next" class="navi next"><img class="dynamic_btn" src="img/x.gif" alt="next" /></a>
                </div>

                <div id="newsbox">
                    <h2><?php echo NEWS; ?></h2>
                    <div class="news"><?php include 'Templates/indexnews.tpl'; ?></div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <div id="footer">
        <div class="container">
            <ul class="menu">
                <li><a href="anleitung.php?s=3"><?php echo FAQ; ?></a>|</li>
                <li><a href="index.php?screenshots"><?php echo SCREENSHOTS; ?></a>|</li>
                <li><a href="spielregeln.php"><?php echo SPIELREGELN; ?></a>|</li>
                <li><a href="agb.php"><?php echo AGB; ?></a>|</li>
                <li><a href="impressum.php"><?php echo IMPRINT; ?></a></li>
                <li class="copyright">&copy; 2011-<?php echo date('Y'); ?> - TravianZ - All rights reserved</li>
            </ul>
        </div>
    </div>
</div>

<!-- LOGIN: every installed world gets its own entry. -->
<div id="login_layer" class="overlay">
    <div class="mask closer"></div>
    <div id="login_list" class="overlay_content">
        <h2><?php echo CHOOSE; ?></h2>
        <a href="#" class="closer"><img class="dynamic_img" alt="Close" src="img/un/x.gif" /></a>
        <ul class="world_list">
<?php foreach ($worlds as $world):
    $operational = ($world['stats']['status'] === 'OPERATIONAL');
    $loginClass = $operational ? 'c4' : 'c3';
    $loginUrl = $operational ? tz_index_server_link($world, 'login.php') : '#';
    $loginOnClick = $operational ? '' : ' onclick="return false;"';
    $title = $world['name'] . ' | ' . $world['stats']['players'] . ' ' . PLAYERS . ' | ' . $world['stats']['active'] . ' ' . ACTIVE . ' | ' . $world['stats']['online'] . ' ' . ONLINE;
?>
            <li class="w_big <?php echo $loginClass; ?>" style="background-image:url('<?php echo tz_index_e($operational ? $world['image'] : $world['image_grey']); ?>');">
                <a href="<?php echo tz_index_e($loginUrl); ?>"<?php echo $loginOnClick; ?>><img class="w_button" src="img/un/x.gif" alt="<?php echo tz_index_e($world['name']); ?>" title="<?php echo tz_index_e($title); ?>" /></a>
                <div class="label_players c0"><?php echo PLAYERS; ?>:</div>
                <div class="label_online c0"><?php echo ONLINE; ?>:</div>
                <div class="players c1"><?php echo (int) $world['stats']['players']; ?></div>
                <div class="online c1"><?php echo (int) $world['stats']['online']; ?></div>
            </li>
<?php endforeach; ?>
        </ul>
        <div class="footer"></div>
    </div>
</div>

<!-- SIGNUP: a world is selectable only when operational AND registration is open. -->
<div id="signup_layer" class="overlay">
    <div class="mask closer"></div>
    <div id="signup_list" class="overlay_content">
        <h2><?php echo CHOOSE; ?></h2>
        <a href="#" class="closer"><img class="dynamic_img" alt="Close" src="img/un/x.gif" /></a>
        <ul class="world_list">
<?php foreach ($worlds as $world):
    $signupOpen = ($world['stats']['status'] === 'OPERATIONAL' && $world['reg_open']);
    $signupClass = $signupOpen ? 'c4' : 'c3';
    $signupUrl = $signupOpen ? tz_index_server_link($world, 'anmelden.php') : '#';
    $signupOnClick = $signupOpen ? '' : ' onclick="return false;"';
    $title = $world['name'] . ' | ' . $world['stats']['players'] . ' ' . PLAYERS . ' | ' . $world['stats']['active'] . ' ' . ACTIVE . ' | ' . $world['stats']['online'] . ' ' . ONLINE;
?>
            <li class="w_big <?php echo $signupClass; ?>" style="background-image:url('<?php echo tz_index_e($signupOpen ? $world['image'] : $world['image_grey']); ?>');">
                <a href="<?php echo tz_index_e($signupUrl); ?>"<?php echo $signupOnClick; ?>><img class="w_button" src="img/un/x.gif" alt="<?php echo tz_index_e($world['name']); ?>" title="<?php echo tz_index_e($title); ?>" /></a>
                <div class="label_players c0"><?php echo PLAYERS; ?>:</div>
                <div class="label_online c0"><?php echo ONLINE; ?>:</div>
                <div class="players c1"><?php echo (int) $world['stats']['players']; ?></div>
                <div class="online c1"><?php echo (int) $world['stats']['online']; ?></div>
            </li>
<?php endforeach; ?>
        </ul>
        <div class="footer"></div>
    </div>
</div>

</body>
</html>
