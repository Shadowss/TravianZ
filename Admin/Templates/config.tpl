<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : config.tpl                                                ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki (Original)                                          ##
##  Rework by      : ronix                                                     ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2025. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################
if(!isset($_SESSION)) session_start();
if($_SESSION['access'] < 9) die(ACCESS_DENIED_ADMIN);

$editIcon = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#93c5fd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>';
?>
<style>
.config-wrap{max-width:1100px;margin:0 auto;font-family:system-ui,-apple-system,Segoe UI,Roboto}
.config-title{text-align:center;font-size:20px;font-weight:800;margin:8px 0 12px;color:#ffffff}
.config-card{background:#fff;border:1px solid #e5e7eb;border-radius:8px;margin-bottom:10px;overflow:hidden;box-shadow:0 1px 2px rgba(0,0,0,.04)}
.config-head{display:flex;justify-content:space-between;align-items:center;padding:7px 10px;background:#0f172a;color:#fff;font-weight:600;font-size:13px;line-height:1}
.edit-btn{display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:4px;transition:.15s}
.edit-btn:hover{background:rgba(255,255,255,.12)}
.edit-btn svg{width:14px;height:14px;transition:.15s}
.edit-btn:hover svg{stroke:#fff;transform:scale(1.05)}
.config-table{width:100%;border-collapse:collapse}
.config-table tr{border-top:1px solid #f1f5f9}
.config-table tr:first-child{border-top:0}
.config-table td{padding:5px 8px;vertical-align:middle;font-size:13px;line-height:1.25}
.config-table td.b{background:#f8fafc;font-weight:700;color:#334155;text-transform:uppercase;font-size:11px;letter-spacing:.3px;padding:4px 8px}
.config-table td:first-child{color:#475569;width:60%}
.config-table td:last-child{color:#0f172a;font-weight:500}
.badge.green{background:#dcfce7;color:#166534}
.badge.red{background:#fee2e2;color:#991b1b}
.badge.blue{background:#dbeafe;color:#1e40af}
.badge.gray{background:#f1f5f9;color:#475569}
</style>

<div class="config-wrap">
<h2 class="config-title"><?php echo SERV_CONFIG ?></h2>

<!-- SERVER SETTINGS -->
<div class="config-card">
  <div class="config-head">
    <span><?php echo SERV_SETT ?></span>
    <a href="admin.php?p=editServerSet" title="<?php echo EDIT_SERV_SETT ?>" class="edit-btn"><?php echo $editIcon; ?></a>
  </div>
  <table class="config-table">
    <tr><td class="b"><?php echo SERV_VARIABLE ?></td><td class="b"><?php echo SERV_VALUE ?></td></tr>
    <tr><td><?php echo CONF_SERV_NAME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NAME_TOOLTIP ?></span></em></td><td><?php echo SERVER_NAME;?></td></tr>
    <tr><td><?php echo CONF_SERV_STARTED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_STARTED_TOOLTIP ?></span></em></td><td><?php echo "Date:".START_DATE." Time:".START_TIME;?></td></tr>
    <tr><td><?php echo CONF_SERV_TIMEZONE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TIMEZONE_TOOLTIP ?></span></em></td><td><?php echo TIMEZONE;?></td></tr>
    <tr><td><?php echo CONF_SERV_LANG ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_LANG_TOOLTIP ?></span></em></td><td><?php if((defined('SERVER_LANG') ? SERVER_LANG : LANG) == 'en') echo "English"; elseif((defined('SERVER_LANG') ? SERVER_LANG : LANG) == 'fr') echo "French"; elseif((defined('SERVER_LANG') ? SERVER_LANG : LANG) == 'it') echo "Italian"; elseif((defined('SERVER_LANG') ? SERVER_LANG : LANG) == 'ro') echo "Romanian"; elseif((defined('SERVER_LANG') ? SERVER_LANG : LANG) == 'zh') echo "Chinese"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_SERVSPEED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_SERVSPEED_TOOLTIP ?></span></em></td><td><?php echo ''.SPEED.'x';?></td></tr>
    <tr><td><?php echo CONF_SERV_TROOPSPEED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TROOPSPEED_TOOLTIP ?></span></em></td><td><?php echo INCREASE_SPEED;?>x</td></tr>
    <tr><td><?php echo CONF_SERV_EVASIONSPEED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_EVASIONSPEED_TOOLTIP ?></span></em></td><td><?php echo EVASION_SPEED;?></td></tr>
    <tr><td><?php echo CONF_SERV_STORMULTIPLER ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_STORMULTIPLER_TOOLTIP ?></span></em></td><td><?php echo STORAGE_MULTIPLIER;?></td></tr>
    <tr><td><?php echo CONF_SERV_TRADCAPACITY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TRADCAPACITY_TOOLTIP ?></span></em></td><td><?php echo TRADER_CAPACITY;?></td></tr>
    <tr><td><?php echo CONF_SERV_CRANCAPACITY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_CRANCAPACITY_TOOLTIP ?></span></em></td><td><?php echo CRANNY_CAPACITY;?></td></tr>
    <tr><td><?php echo CONF_SERV_TRAPCAPACITY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TRAPCAPACITY_TOOLTIP ?></span></em></td><td><?php echo TRAPPER_CAPACITY;?></td></tr>
    <tr><td><?php echo CONF_SERV_NATUNITSMULTIPLIER ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATUNITSMULTIPLIER_TOOLTIP ?></span></em></td><td><?php echo NATARS_UNITS;?></td></tr>
    <tr><td><?php echo CONF_SERV_NATARS_SPAWN_TIME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATARS_SPAWN_TIME_TOOLTIP ?></span></em></td><td><?php echo NATARS_SPAWN_TIME;?></td></tr>
    <tr><td><?php echo CONF_SERV_NATARS_WW_SPAWN_TIME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATARS_WW_SPAWN_TIME_TOOLTIP ?></span></em></td><td><?php echo NATARS_WW_SPAWN_TIME;?></td></tr>
    <tr><td><?php echo CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME_TOOLTIP ?></span></em></td><td><?php echo NATARS_WW_BUILDING_PLAN_SPAWN_TIME;?></td></tr>
    <tr><td><?php echo CONF_SERV_MAPSIZE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_MAPSIZE_TOOLTIP ?></span></em></td><td><?php echo WORLD_MAX;?>x<?php echo WORLD_MAX;?></td></tr>
    <tr><td><?php echo CONF_SERV_VILLEXPSPEED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_VILLEXPSPEED_TOOLTIP ?></span></em></td><td><?php echo CP == 0 ? "Fast" : "Slow"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_BEGINPROTECT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_BEGINPROTECT_TOOLTIP ?></span></em></td><td><?php echo (PROTECTION / 3600);?> hour/s</td></tr>
    <tr><td><?php echo CONF_SERV_REGOPEN ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_REGOPEN_TOOLTIP ?></span></em></td><td><?php echo REG_OPEN ? "<span class='badge blue'>True</span>" : "<span class='badge red'>False</span>"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_ACTIVMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_ACTIVMAIL_TOOLTIP ?></span></em></td><td><?php echo AUTH_EMAIL ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_QUEST ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_QUEST_TOOLTIP ?></span></em></td><td><?php echo QUEST ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_QTYPE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_QTYPE_TOOLTIP ?></span></em></td><td><?php echo QTYPE == 25 ? "<span class='badge blue'>Travian Official</span>" : "<span class='badge blue'>TravianZ Extended</span>"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_DLR ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_DLR_TOOLTIP ?></span></em></td><td><?php echo DEMOLISH_LEVEL_REQ; ?></td></tr>
    <tr><td><?php echo CONF_SERV_WWSTATS ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_WWSTATS_TOOLTIP ?></span></em></td><td><?php echo WW ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_NTRTIME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NTRTIME_TOOLTIP ?></span></em></td><td><?php echo NATURE_REGTIME >= 86400 ? (NATURE_REGTIME/86400).' Days' : (NATURE_REGTIME/3600).' Hours'; ?></td></tr>
    <tr><td><?php echo CONF_SERV_OASIS_WOOD_PROD_MULT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_OASIS_WOOD_PROD_MULT_TOOLTIP ?></span></em></td><td><?php echo OASIS_WOOD_MULTIPLIER ?></td></tr>
    <tr><td><?php echo CONF_SERV_OASIS_CLAY_PROD_MULT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_OASIS_CLAY_PROD_MULT_TOOLTIP ?></span></em></td><td><?php echo OASIS_CLAY_MULTIPLIER ?></td></tr>
    <tr><td><?php echo CONF_SERV_OASIS_IRON_PROD_MULT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_OASIS_IRON_PROD_MULT_TOOLTIP ?></span></em></td><td><?php echo OASIS_IRON_MULTIPLIER ?></td></tr>
    <tr><td><?php echo CONF_SERV_OASIS_CROP_PROD_MULT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_OASIS_CROP_PROD_MULT_TOOLTIP ?></span></em></td><td><?php echo OASIS_CROP_MULTIPLIER ?></td></tr>
    <tr><td><?php echo CONF_SERV_MEDALINTERVAL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_MEDALINTERVAL_TOOLTIP ?></span></em></td><td><?php echo MEDALINTERVAL >= 86400 ? (MEDALINTERVAL/86400).' Days' : (MEDALINTERVAL/3600).' Hours'; ?></td></tr>
    <tr><td><?php echo CONF_SERV_TOURNTHRES ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TOURNTHRES_TOOLTIP ?></span></em></td><td><?php echo TS_THRESHOLD;?></td></tr>
    <tr><td><?php echo CONF_SERV_GWORKSHOP ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_GWORKSHOP_TOOLTIP ?></span></em></td><td><?php echo GREAT_WKS ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_NATARSTAT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATARSTAT_TOOLTIP ?></span></em></td><td><?php echo SHOW_NATARS ? "<span class='badge blue'>True</span>" : "<span class='badge red'>False</span>"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_PEACESYST ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_PEACESYST_TOOLTIP ?></span></em></td><td><?php echo (["None", "Normal", "Christmas", "New Year", "Easter"])[PEACE]; ?></td></tr>
    <tr><td><?php echo CONF_SERV_GRAPHICPACK ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_GRAPHICPACK_TOOLTIP ?></span></em></td><td><?php echo GP_ENABLE ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_ERRORREPORT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_ERRORREPORT_TOOLTIP ?></span></em></td><td><b><?php echo (ERROR_REPORT=="error_reporting (0);")? "No": "Yes";?></b></td></tr>
  </table>
</div>

<!-- NEW FUNCTIONS -->
<div class="config-card">
  <div class="config-head"><span>New Mechanics and Functions</span><a href="admin.php?p=editNewFunctions" title="Edit New Mechanics and Functions" class="edit-btn"><?php echo $editIcon; ?></a></div>
  <table class="config-table">
    <tr><td class="b"><?php echo SERV_VARIABLE ?></td><td class="b"><?php echo SERV_VALUE ?></td></tr>
    <tr><td>Display oasis in profile <em class="tooltip">?<span class="classic">Enable (Disable) the display of oases of each village in the player profile</span></em></td><td><?php echo NEW_FUNCTIONS_OASIS ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td>Alliance invitation message <em class="tooltip">?<span class="classic">Enable (Disable) sending an in-game message to the player, if he was invited to the alliance</span></em></td><td><?php echo NEW_FUNCTIONS_ALLIANCE_INVITATION ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td>New Alliance & Embassy Mechanics <em class="tooltip">?<span class="classic">https://github.com/Shadowss/TravianZ/wiki/New-Alliance-&-Embassy-Mechanics</span></em></td><td><?php echo NEW_FUNCTIONS_EMBASSY_MECHANICS ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td>New forum post message <em class="tooltip">?<span class="classic">Enable (Disable) forum subscription messages</span></em></td><td><?php echo NEW_FUNCTIONS_FORUM_POST_MESSAGE ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td>Tribes images in profile <em class="tooltip">?<span class="classic">Enable (Disable) displaying images of tribes</span></em></td><td><?php echo NEW_FUNCTIONS_TRIBE_IMAGES ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td>MHs images in profile <em class="tooltip">?<span class="classic">Enable (Disable) displaying images of Multihunters</span></em></td><td><?php echo NEW_FUNCTIONS_MHS_IMAGES ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td>Display artifact in profile <em class="tooltip">?<span class="classic">Enable (Disable) the display of the artifact</span></em></td><td><?php echo NEW_FUNCTIONS_DISPLAY_ARTIFACT ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td>Display WoW in profile <em class="tooltip">?<span class="classic">Enable (Disable) the display of the wonder</span></em></td><td><?php echo NEW_FUNCTIONS_DISPLAY_WONDER ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td>Vacation Mode <em class="tooltip">?<span class="classic">Enable (Disable) vacation mode</span></em></td><td><?php echo NEW_FUNCTIONS_VACATION ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td>Catapult targets <em class="tooltip">?<span class="classic">Enable (Disable) the display of catapult targets</span></em></td><td><?php echo NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td>Manual on Nature and Natars <em class="tooltip">?<span class="classic">Enable (Disable) manual info</span></em></td><td><?php echo NEW_FUNCTIONS_MANUAL_NATURENATARS ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td>Direct links placement <em class="tooltip">?<span class="classic">Left menu vs right menu</span></em></td><td><?php echo NEW_FUNCTIONS_DISPLAY_LINKS ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td>Medal Veteran Player <em class="tooltip">?<span class="classic">3 years</span></em></td><td><?php echo NEW_FUNCTIONS_MEDAL_3YEAR ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td>Medal Veteran Player 5a <em class="tooltip">?<span class="classic">5 years</span></em></td><td><?php echo NEW_FUNCTIONS_MEDAL_5YEAR ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td>Medal Veteran Player 10a <em class="tooltip">?<span class="classic">10 years</span></em></td><td><?php echo NEW_FUNCTIONS_MEDAL_10YEAR ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
	<tr><td>Special Medals<em class="tooltip">?<span class="classic">Special Medals</span></em></td><td><?php echo NEW_FUNCTIONS_SPECIAL_MEDALS_SYSTEM ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
	<tr><td>Server Milestones<em class="tooltip">?<span class="classic">Server Milestones</span></em></td><td><?php echo NEW_FUNCTIONS_MILESTONES ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
  </table>
</div>

<!-- PLUS -->
<div class="config-card">
  <div class="config-head"><span><?php echo PLUS_SETT ?></span><a href="admin.php?p=editPlusSet" title="<?php echo EDIT_PLUS_SETT1 ?>" class="edit-btn"><?php echo $editIcon; ?></a></div>
  <table class="config-table">
    <tr><td><?php echo CONF_PLUS_PAYPALEMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PAYPALEMAIL_TOOLTIP ?></span></em></td><td><?php echo (defined('PAYPAL_EMAIL') ? PAYPAL_EMAIL : 'martin@martinambrus.com'); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_CURRENCY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_CURRENCY_TOOLTIP ?></span></em></td><td><?php echo (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEGOLDA ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDA_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_A_GOLD') ? PLUS_PACKAGE_A_GOLD : 60); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEPRICEA ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICEA_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_A_PRICE') ? PLUS_PACKAGE_A_PRICE : '1,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEGOLDB ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDB_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_B_GOLD') ? PLUS_PACKAGE_B_GOLD : 120); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEPRICEB ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICEB_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_B_PRICE') ? PLUS_PACKAGE_B_PRICE : '4,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEGOLDC ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDC_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_C_GOLD') ? PLUS_PACKAGE_C_GOLD : 360); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEPRICEC ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICEC_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_C_PRICE') ? PLUS_PACKAGE_C_PRICE : '9,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEGOLDD ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDD_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_D_GOLD') ? PLUS_PACKAGE_D_GOLD : 1000); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEPRICED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICED_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_D_PRICE') ? PLUS_PACKAGE_D_PRICE : '19,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEGOLDE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDE_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_E_GOLD') ? PLUS_PACKAGE_E_GOLD : 2000); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEPRICEE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICEE_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_E_PRICE') ? PLUS_PACKAGE_E_PRICE : '49,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_ACCDURATION ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_ACCDURATION_TOOLTIP ?></span></em></td><td><?php echo PLUS_TIME >= 86400 ? (PLUS_TIME/86400).' Days' : (PLUS_TIME/3600).' Hours'; ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PRODUCTDURATION ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PRODUCTDURATION_TOOLTIP ?></span></em></td><td><?php echo PLUS_PRODUCTION >= 86400 ? (PLUS_PRODUCTION/86400).' Days' : (PLUS_PRODUCTION/3600).' Hours'; ?></td></tr>
  </table>
</div>

<!-- LOG -->
<div class="config-card">
  <div class="config-head"><span><?php echo LOG_SETT ?></span><a href="admin.php?p=editLogSet" title="<?php echo EDIT_LOG_SETT ?>" class="edit-btn"><?php echo $editIcon; ?></a></div>
  <table class="config-table">
    <tr><td class="b"><?php echo SERV_VARIABLE ?></td><td class="b"><?php echo SERV_VALUE ?></td></tr>
    <tr><td><?php echo CONF_LOG_BUILD ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_BUILD_TOOLTIP ?></span></em></td><td><?php echo LOG_BUILD ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_LOG_TECHNOLOGY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_TECHNOLOGY_TOOLTIP ?></span></em></td><td><?php echo LOG_TECH ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_LOG_LOGIN ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_LOGIN_TOOLTIP ?></span></em></td><td><?php echo LOG_LOGIN ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_LOG_GOLD ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_GOLD_TOOLTIP ?></span></em></td><td><?php echo LOG_GOLD_FIN ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_LOG_ADMIN ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_ADMIN_TOOLTIP ?></span></em></td><td><?php echo LOG_ADMIN ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_LOG_WAR ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_WAR_TOOLTIP ?></span></em></td><td><?php echo LOG_WAR ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_LOG_MARKET ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_MARKET_TOOLTIP ?></span></em></td><td><?php echo LOG_MARKET ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_LOG_ILLEGAL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_ILLEGAL_TOOLTIP ?></span></em></td><td><?php echo LOG_ILLEGAL ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
  </table>
</div>

<!-- NEWSBOX -->
<div class="config-card">
  <div class="config-head"><span><?php echo NEWSBOX_SETT ?></span><a href="admin.php?p=editNewsboxSet" title="<?php echo EDIT_NEWSBOX_SETT ?>" class="edit-btn"><?php echo $editIcon; ?></a></div>
  <table class="config-table">
    <tr><td class="b"><?php echo SERV_VARIABLE ?></td><td class="b"><?php echo SERV_VALUE ?></td></tr>
    <tr><td><?php echo EDIT_NEWSBOX1 ?> <em class="tooltip">?<span class="classic"><?php echo EDIT_NEWSBOX1_TOOLTIP ?></span></em></td><td><?php echo NEWSBOX1 ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo EDIT_NEWSBOX2 ?> <em class="tooltip">?<span class="classic"><?php echo EDIT_NEWSBOX2_TOOLTIP ?></span></em></td><td><?php echo NEWSBOX2 ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo EDIT_NEWSBOX3 ?> <em class="tooltip">?<span class="classic"><?php echo EDIT_NEWSBOX3_TOOLTIP ?></span></em></td><td><?php echo NEWSBOX3 ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
  </table>
</div>

<!-- SQL -->
<div class="config-card">
  <div class="config-head"><span><?php echo SQL_SETTINGS ?></span></div>
  <table class="config-table">
    <tr><td class="b"><?php echo SERV_VARIABLE ?></td><td class="b"><?php echo SERV_VALUE ?></td></tr>
    <tr><td><?php echo CONF_SQL_HOSTNAME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_HOSTNAME_TOOLTIP ?></span></em></td><td><?php echo SQL_SERVER;?></td></tr>
    <tr><td><?php echo CONF_SQL_PORT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_PORT_TOOLTIP ?></span></em></td><td><?php echo SQL_PORT;?></td></tr>
    <tr><td><?php echo CONF_SQL_DBUSER ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_DBUSER_TOOLTIP ?></span></em></td><td><?php echo SQL_USER;?></td></tr>
    <tr><td><?php echo CONF_SQL_DBPASS ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_DBPASS_TOOLTIP ?></span></em></td><td>*********</td></tr>
    <tr><td><?php echo CONF_SQL_DBNAME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_DBNAME_TOOLTIP ?></span></em></td><td><?php echo SQL_DB;?></td></tr>
    <tr><td><?php echo CONF_SQL_TBPREFIX ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_TBPREFIX_TOOLTIP ?></span></em></td><td><?php echo TB_PREFIX;?></td></tr>
    <tr><td><?php echo CONF_SQL_DBTYPE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_DBTYPE_TOOLTIP ?></span></em></td><td><?php echo DB_TYPE == 0 ? "MYSQL" : "MYSQLi"; ?></td></tr>
  </table>
</div>

<!-- EXTRA -->
<div class="config-card">
  <div class="config-head"><span><?php echo EXTRA_SETT ?></span><a href="admin.php?p=editExtraSet" title="<?php echo EDIT_EXTRA_SETT ?>" class="edit-btn"><?php echo $editIcon; ?></a></div>
  <table class="config-table">
    <tr><td class="b"><?php echo SERV_VARIABLE ?></td><td class="b"><?php echo SERV_VALUE ?></td></tr>
    <tr><td><?php echo CONF_EXTRA_LIMITMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_EXTRA_LIMITMAIL_TOOLTIP ?></span></em></td><td><?php echo LIMIT_MAILBOX ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_EXTRA_MAXMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_EXTRA_MAXMAIL_TOOLTIP ?></span></em></td><td><?php echo LIMIT_MAILBOX ? MAX_MAIL : "<span class='badge gray'>Limit mailbox disabled</span>"; ?></td></tr>
  </table>
</div>

<!-- ADMIN INFO -->
<div class="config-card">
  <div class="config-head"><span><?php echo ADMIN_INFO ?></span><a href="admin.php?p=editAdminInfo" title="<?php echo EDIT_ADMIN_INFO ?>" class="edit-btn"><?php echo $editIcon; ?></a></div>
  <table class="config-table">
    <tr><td class="b"><?php echo SERV_VARIABLE ?></td><td class="b"><?php echo SERV_VALUE ?></td></tr>
    <tr><td><?php echo CONF_ADMIN_NAME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_NAME_TOOLTIP ?></span></em></td><td><?php echo empty(ADMIN_NAME) ? "<span class='badge red'>No admin name defined!</span>" : ADMIN_NAME; ?></td></tr>
    <tr><td><?php echo CONF_ADMIN_EMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_EMAIL_TOOLTIP ?></span></em></td><td><?php echo empty(ADMIN_EMAIL) ? "<span class='badge red'>No admin email defined!</span>" : ADMIN_EMAIL; ?></td></tr>
    <tr><td><?php echo CONF_ADMIN_SHOWSTATS ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_SHOWSTATS_TOOLTIP ?></span></em></td><td><?php echo INCLUDE_ADMIN ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_ADMIN_SUPPMESS ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_SUPPMESS_TOOLTIP ?></span></em></td><td><?php echo ADMIN_RECEIVE_SUPPORT_MESSAGES ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_ADMIN_RAIDATT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_RAIDATT_TOOLTIP ?></span></em></td><td><?php echo ADMIN_ALLOW_INCOMING_RAIDS ? "<span class='badge green'>Yes</span>" : "<span class='badge red'>No</span>"; ?></td></tr>
  </table>
</div>

</div>
<?php
function define_array($array, $keys = null){
	foreach($array as $key => $value){
		$keyname = ($keys ? $keys."_" : "").$key;
		if(is_array($array[$key])) define_array($array[$key], $keyname);
		else define($keyname, $value);
	}
}
?>