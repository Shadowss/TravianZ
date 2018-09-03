<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       config.tpl                                                  ##
##  Developed by:  Dzoki                                                       ##
##  Rework by:     ronix                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################
if(!isset($_SESSION)) session_start();
if($_SESSION['access'] < 9) die(ACCESS_DENIED_ADMIN);
?>
<style>
	.del {width:12px; height:12px; background-image: url(img/admin/icon/del.gif);}
</style>
<h2><center><?php echo SERV_CONFIG ?></center></h2>
<table id="member">
	<thead>
		<tr>
		<th><?php echo SERV_SETT ?> <a href="admin.php?p=editServerSet"><img src="../img/admin/edit.gif" title="<?php echo EDIT_SERV_SETT ?>"></a></th>
		</tr>
	</thead>
</table>

<table id="profile">
	<tr>
		<td class="b"><?php echo SERV_VARIABLE ?></td>
		<td class="b"><?php echo SERV_VALUE ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_NAME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NAME_TOOLTIP ?></span></em></td>
		<td><?php echo SERVER_NAME;?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_STARTED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_STARTED_TOOLTIP ?></span></em></td>
		<td><?php echo "Date:".START_DATE." Time:".START_TIME; //date("d.m.y H:i",COMMENCE);?></td>
	</tr>
	<tr>	
		<td><?php echo CONF_SERV_TIMEZONE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TIMEZONE_TOOLTIP ?></span></em></td>
		<td><?php echo TIMEZONE;?></td>
	</tr>
        	<td><?php echo CONF_SERV_LANG ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_LANG_TOOLTIP ?></span></em></td>
        	<td><?php if(LANG == 'en') echo "English";
        			  elseif(LANG == 'es') echo "Spain";
        	 		  elseif(LANG == 'rs') echo "Serbian";
        	 		  elseif(LANG == 'ru') echo "Russian";
        			  elseif(LANG == 'zh_tw') echo "Taiwanese"; ?>
        	</td>
	<tr>
		<td><?php echo CONF_SERV_SERVSPEED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_SERVSPEED_TOOLTIP ?></span></em></td>
		<td><?php echo ''.SPEED.'x';?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_TROOPSPEED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TROOPSPEED_TOOLTIP ?></span></em></td>
		<td><?php echo INCREASE_SPEED;?>x</td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_EVASIONSPEED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_EVASIONSPEED_TOOLTIP ?></span></em></td>
		<td><?php echo EVASION_SPEED;?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_STORMULTIPLER ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_STORMULTIPLER_TOOLTIP ?></span></em></td>
		<td><?php echo STORAGE_MULTIPLIER;?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_TRADCAPACITY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TRADCAPACITY_TOOLTIP ?></span></em></td>
		<td><?php echo TRADER_CAPACITY;?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_CRANCAPACITY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_CRANCAPACITY_TOOLTIP ?></span></em></td>
		<td><?php echo CRANNY_CAPACITY;?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_TRAPCAPACITY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TRAPCAPACITY_TOOLTIP ?></span></em></td>
		<td><?php echo TRAPPER_CAPACITY;?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_NATUNITSMULTIPLIER ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATUNITSMULTIPLIER_TOOLTIP ?></span></em></td>
		<td><?php echo NATARS_UNITS;?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_NATARS_SPAWN_TIME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATARS_SPAWN_TIME_TOOLTIP ?></span></em></td>
		<td><?php echo NATARS_SPAWN_TIME;?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_NATARS_WW_SPAWN_TIME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATARS_WW_SPAWN_TIME_TOOLTIP ?></span></em></td>
		<td><?php echo NATARS_WW_SPAWN_TIME;?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME_TOOLTIP ?></span></em></td>
		<td><?php echo NATARS_WW_BUILDING_PLAN_SPAWN_TIME;?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_MAPSIZE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_MAPSIZE_TOOLTIP ?></span></em></td>
		<td><?php echo WORLD_MAX;?>x<?php echo WORLD_MAX;?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_VILLEXPSPEED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_VILLEXPSPEED_TOOLTIP ?></span></em></td>
		<td><?php echo CP == 0 ? "Fast" : "Slow"; ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_BEGINPROTECT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_BEGINPROTECT_TOOLTIP ?></span></em></td>
		<td><?php echo (PROTECTION / 3600);?> hour/s</td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_REGOPEN ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_REGOPEN_TOOLTIP ?></span></em></td>
		<td><?php echo REG_OPEN ? "<b><font color='blue'>True</font></b>" : "<b><font color='Red'>False</font></b>"; ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_ACTIVMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_ACTIVMAIL_TOOLTIP ?></span></em></td>
		<td><?php echo AUTH_EMAIL ? "<b><font color='Green'>Enabled</font></b>" : "<b><font color='Red'>Disabled</font></b>"; ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_QUEST ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_QUEST_TOOLTIP ?></span></em></td>
		<td><?php echo QUEST ? "<b><font color='Green'>Enabled</font></b>" : "<b><font color='Red'>Disabled</font></b>"; ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_QTYPE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_QTYPE_TOOLTIP ?></span></em></td>
		<td><?php echo QTYPE == 25 ? "<b><font color='Blue'>Travian Official</font></b>" : "<b><font color='Blue'>TravianZ Extended</font></b>"; ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_DLR ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_DLR_TOOLTIP ?></span></em></td>
		<td><?php echo DEMOLISH_LEVEL_REQ; ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_WWSTATS ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_WWSTATS_TOOLTIP ?></span></em></td>
		<td><?php if(WW) { echo "<b><font color='Green'>Enabled</font></b>"; } else if(WW == false) { echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>	
		<td><?php echo CONF_SERV_NTRTIME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NTRTIME_TOOLTIP ?></span></em></td>
		<td><?php if(NATURE_REGTIME >= 86400){ echo ''.(NATURE_REGTIME/86400).' Days'; } else if(NATURE_REGTIME < 86400){ echo ''.(NATURE_REGTIME/3600).' Hours'; } ?></td>
	</tr>
	<tr>	
		<td><?php echo CONF_SERV_OASIS_WOOD_PROD_MULT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_OASIS_WOOD_PROD_MULT_TOOLTIP ?></span></em></td>
		<td><?php echo OASIS_WOOD_MULTIPLIER ?></td>
	</tr>
	<tr>	
		<td><?php echo CONF_SERV_OASIS_CLAY_PROD_MULT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_OASIS_CLAY_PROD_MULT_TOOLTIP ?></span></em></td>
		<td><?php echo OASIS_CLAY_MULTIPLIER ?></td>
	</tr>
	<tr>	
		<td><?php echo CONF_SERV_OASIS_IRON_PROD_MULT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_OASIS_IRON_PROD_MULT_TOOLTIP ?></span></em></td>
		<td><?php echo OASIS_IRON_MULTIPLIER ?></td>
	</tr>
	<tr>	
		<td><?php echo CONF_SERV_OASIS_CROP_PROD_MULT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_OASIS_CROP_PROD_MULT_TOOLTIP ?></span></em></td>
		<td><?php echo OASIS_CROP_MULTIPLIER ?></td>
	</tr>
    <tr>
		<td><?php echo CONF_SERV_MEDALINTERVAL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_MEDALINTERVAL_TOOLTIP ?></span></em></td>
		<td><?php if(MEDALINTERVAL >= 86400){ echo ''.(MEDALINTERVAL/86400).' Days'; } else if(MEDALINTERVAL < 86400){ echo ''.(MEDALINTERVAL/3600).' Hours'; } ?></td>
    </tr>
	<tr>
		<td><?php echo CONF_SERV_TOURNTHRES ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TOURNTHRES_TOOLTIP ?></span></em></td>
		<td><?php echo TS_THRESHOLD;?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_GWORKSHOP ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_GWORKSHOP_TOOLTIP ?></span></em></td>
		<td><?php if(GREAT_WKS) { echo "<b><font color='Green'>Enabled</font></b>"; } else { echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_NATARSTAT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATARSTAT_TOOLTIP ?></span></em></td>
		<td><?php if(SHOW_NATARS) { echo "<b><font color='blue'>True</font></b>"; } else { echo "<b><font color='Red'>False</font></b>"; } ?></td>
	<tr>
		<td><?php echo CONF_SERV_PEACESYST ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_PEACESYST_TOOLTIP ?></span></em></td>
		<td>
			<?php echo (["None", "Normal", "Christmas", "New Year", "Easter"])[PEACE]; ?>
		</td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_GRAPHICPACK ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_GRAPHICPACK_TOOLTIP ?></span></em></td>
		<td><?php if(GP_ENABLE) { echo "<b><font color='Green'>Enabled</font></b>"; } else { echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
	<tr>
		<td><?php echo CONF_SERV_ERRORREPORT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_ERRORREPORT_TOOLTIP ?></span></em></td>
		<td><b><?php echo (ERROR_REPORT=="error_reporting (0);")? "No": "Yes";?></b></td>
	</tr>
	</table>
    <table id="member">
        <thead>
            <tr>
                <th>New Mechanics and Functions <a href="admin.php?p=editNewFunctions"><img src="../img/admin/edit.gif" title="Edit New Mechanics and Functions"></a></th>
            </tr>
        </thead>
    </table>

    <table id="profile">
        <tr>
            <td class="b"><?php echo SERV_VARIABLE ?></td>
            <td class="b"><?php echo SERV_VALUE ?></td>
        </tr>
        <tr>
            <td>Display oasis in profile <em class="tooltip">?<span class="classic">Enable (Disable) the display of oases of each village in the player profile</span></em></td>
            <td><?php echo NEW_FUNCTIONS_OASIS ? "<b><font color='Green'>Enabled</font></b>" : "<b><font color='Red'>Disabled</font></b>"; ?></td>
        </tr>
        <tr>
            <td>Alliance invitation message <em class="tooltip">?<span class="classic">Enable (Disable) sending an in-game message to the player, if he was invited to the alliance</span></em></td>
            <td><?php echo NEW_FUNCTIONS_ALLIANCE_INVITATION ? "<b><font color='Green'>Enabled</font></b>" : "<b><font color='Red'>Disabled</font></b>"; ?></td>
        </tr>
        <tr>
            <td>New Alliance & Embassy Mechanics <em class="tooltip">?<span class="classic">For this setting, you can find more information on the link: <a href="https://github.com/Shadowss/TravianZ/wiki/New-Alliance-&-Embassy-Mechanics" target="_blank">https://github.com</a></span></em></td>
            <td><?php echo NEW_FUNCTIONS_EMBASSY_MECHANICS ? "<b><font color='Green'>Enabled</font></b>" : "<b><font color='Red'>Disabled</font></b>"; ?></td>
        </tr>
        <tr>
            <td>New forum post message <em class="tooltip">?<span class="classic">Enable (Disable) if a player leaves at least one message in the thread on the forum, he will receive in-game messages about the fact that new messages have appeared in the same thread (i.e. is technically "subscribed to")</span></em></td>
            <td><?php echo NEW_FUNCTIONS_FORUM_POST_MESSAGE ? "<b><font color='Green'>Enabled</font></b>" : "<b><font color='Red'>Disabled</font></b>"; ?></td>
        </tr>
        <tr>
            <td>Tribes images in profile <em class="tooltip">?<span class="classic">Enable (Disable) displaying images of tribes with a description in the players profile</span></em></td>
            <td><?php echo NEW_FUNCTIONS_TRIBE_IMAGES ? "<b><font color='Green'>Enabled</font></b>" : "<b><font color='Red'>Disabled</font></b>"; ?></td>
        </tr>
        <tr>
            <td>MHs images in profile <em class="tooltip">?<span class="classic">Enable (Disable) displaying images of Multihunters with a description in the MHs profile</span></em></td>
            <td><?php echo NEW_FUNCTIONS_MHS_IMAGES ? "<b><font color='Green'>Enabled</font></b>" : "<b><font color='Red'>Disabled</font></b>"; ?></td>
        </tr>
        <tr>
            <td>Display artifact in profile <em class="tooltip">?<span class="classic">Enable (Disable) the display of the artifact in the player profile, opposite the corresponding village in which it is located</span></em></td>
            <td><?php echo NEW_FUNCTIONS_DISPLAY_ARTIFACT ? "<b><font color='Green'>Enabled</font></b>" : "<b><font color='Red'>Disabled</font></b>"; ?></td>
        </tr>
		<tr>
            <td>Display WoW in profile <em class="tooltip">?<span class="classic">Enable (Disable) the display of the wonder in the player profile, opposite the corresponding village in which it is located</span></em></td>
            <td><?php echo NEW_FUNCTIONS_DISPLAY_WONDER ? "<b><font color='Green'>Enabled</font></b>" : "<b><font color='Red'>Disabled</font></b>"; ?></td>
        </tr>
		<tr>
            <td>Vacation Mode <em class="tooltip">?<span class="classic">Enable (Disable) vacation mode, will be displayed or hidden in the player profile menu</span></em></td>
            <td><?php echo NEW_FUNCTIONS_VACATION ? "<b><font color='Green'>Enabled</font></b>" : "<b><font color='Red'>Disabled</font></b>"; ?></td>
        </tr>
		<tr>
            <td>Catapult targets <em class="tooltip">?<span class="classic">Enable (Disable) the display of the targets of the catapults in the rally point that were sent by you</span></em></td>
            <td><?php echo NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET ? "<b><font color='Green'>Enabled</font></b>" : "<b><font color='Red'>Disabled</font></b>"; ?></td>
        </tr>
		<tr>
            <td>Manual on Nature and Natars <em class="tooltip">?<span class="classic">Enable (Disable) displaying information in the Manual about the troops of Nature and Natars</span></em></td>
            <td><?php echo NEW_FUNCTIONS_MANUAL_NATURENATARS ? "<b><font color='Green'>Enabled</font></b>" : "<b><font color='Red'>Disabled</font></b>"; ?></td>
        </tr>
		<tr>
            <td>Direct links placement <em class="tooltip">?<span class="classic">If Enabled, then the Direct links will be placed in the left menu, if Disabled then Direct links will be placed in the right menu as in the original Travian</span></em></td>
            <td><?php echo NEW_FUNCTIONS_DISPLAY_LINKS ? "<b><font color='Green'>Enabled</font></b>" : "<b><font color='Red'>Disabled</font></b>"; ?></td>
        </tr>
		<tr>
            <td>Medal Veteran Player <em class="tooltip">?<span class="classic">Enable (Disable) medal achieved for playing 3 years of Travian</span></em></td>
            <td><?php echo NEW_FUNCTIONS_MEDAL_3YEAR ? "<b><font color='Green'>Enabled</font></b>" : "<b><font color='Red'>Disabled</font></b>"; ?></td>
        </tr>
		<tr>
            <td>Medal Veteran Player 5a <em class="tooltip">?<span class="classic">Enable (Disable) medal achieved for playing 5 years of Travian</span></em></td>
            <td><?php echo NEW_FUNCTIONS_MEDAL_5YEAR ? "<b><font color='Green'>Enabled</font></b>" : "<b><font color='Red'>Disabled</font></b>"; ?></td>
        </tr>
		<tr>
            <td>Medal Veteran Player 10a <em class="tooltip">?<span class="classic">Enable (Disable) medal achieved for playing 10 years of Travian</span></em></td>
            <td><?php echo NEW_FUNCTIONS_MEDAL_10YEAR ? "<b><font color='Green'>Enabled</font></b>" : "<b><font color='Red'>Disabled</font></b>"; ?></td>
        </tr>
    </table>
    <table id="member">
        <thead>
            <tr>
                <th><?php echo PLUS_SETT ?> <a href="admin.php?p=editPlusSet"><img src="../img/admin/edit.gif" title="<?php echo EDIT_PLUS_SETT1 ?>"></a></th>
            </tr>
        </thead>
    </table>

  <table id="profile">
    <tr>
        <td><?php echo CONF_PLUS_PAYPALEMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PAYPALEMAIL_TOOLTIP ?></span></em></td>
        <td><?php echo (defined('PAYPAL_EMAIL') ? PAYPAL_EMAIL : 'martin@martinambrus.com'); ?></td>
    </tr>
    <tr>
        <td><?php echo CONF_PLUS_CURRENCY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_CURRENCY_TOOLTIP ?></span></em></td>
        <td><?php echo (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td>
    </tr>
    <tr>
        <td><?php echo CONF_PLUS_PACKAGEGOLDA ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDA_TOOLTIP ?></span></em></td>
        <td><?php echo (defined('PLUS_PACKAGE_A_GOLD') ? PLUS_PACKAGE_A_GOLD : 60); ?></td>
    </tr>
    <tr>
        <td><?php echo CONF_PLUS_PACKAGEPRICEA ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICEA_TOOLTIP ?></span></em></td>
        <td><?php echo (defined('PLUS_PACKAGE_A_PRICE') ? PLUS_PACKAGE_A_PRICE : '1,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td>
    </tr>
    <tr>
        <td><?php echo CONF_PLUS_PACKAGEGOLDB ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDB_TOOLTIP ?></span></em></td>
        <td><?php echo (defined('PLUS_PACKAGE_B_GOLD') ? PLUS_PACKAGE_B_GOLD : 120); ?></td>
    </tr>
    <tr>
        <td><?php echo CONF_PLUS_PACKAGEPRICEB ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICEB_TOOLTIP ?></span></em></td>
        <td><?php echo (defined('PLUS_PACKAGE_B_PRICE') ? PLUS_PACKAGE_B_PRICE : '4,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td>
    </tr>
    <tr>
        <td><?php echo CONF_PLUS_PACKAGEGOLDC ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDC_TOOLTIP ?></span></em></td>
        <td><?php echo (defined('PLUS_PACKAGE_C_GOLD') ? PLUS_PACKAGE_C_GOLD : 360); ?></td>
    </tr>
    <tr>
        <td><?php echo CONF_PLUS_PACKAGEPRICEC ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICEC_TOOLTIP ?></span></em></td>
        <td><?php echo (defined('PLUS_PACKAGE_C_PRICE') ? PLUS_PACKAGE_C_PRICE : '9,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td>
    </tr>
    <tr>
        <td><?php echo CONF_PLUS_PACKAGEGOLDD ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDD_TOOLTIP ?></span></em></td>
        <td><?php echo (defined('PLUS_PACKAGE_D_GOLD') ? PLUS_PACKAGE_D_GOLD : 1000); ?></td>
    </tr>
    <tr>
        <td><?php echo CONF_PLUS_PACKAGEPRICED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICED_TOOLTIP ?></span></em></td>
        <td><?php echo (defined('PLUS_PACKAGE_D_PRICE') ? PLUS_PACKAGE_D_PRICE : '19,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td>
    </tr>
    <tr>
        <td><?php echo CONF_PLUS_PACKAGEGOLDE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDE_TOOLTIP ?></span></em></td>
        <td><?php echo (defined('PLUS_PACKAGE_E_GOLD') ? PLUS_PACKAGE_E_GOLD : 2000); ?></td>
    </tr>
    <tr>
        <td><?php echo CONF_PLUS_PACKAGEPRICEE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICEE_TOOLTIP ?></span></em></td>
        <td><?php echo (defined('PLUS_PACKAGE_E_PRICE') ? PLUS_PACKAGE_E_PRICE : '49,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td>
    </tr>
    <tr>
        <td><?php echo CONF_PLUS_ACCDURATION ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_ACCDURATION_TOOLTIP ?></span></em></td>
        <td><?php if(PLUS_TIME >= 86400){ echo ''.(PLUS_TIME/86400).' Days'; } else if(PLUS_TIME < 86400){ echo ''.(PLUS_TIME / 3600).' Hours'; } ?></td>
    </tr>
    <tr>
        <td><?php echo CONF_PLUS_PRODUCTDURATION ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PRODUCTDURATION_TOOLTIP ?></span></em></td>
        <td><?php if(PLUS_PRODUCTION >= 86400){ echo ''.(PLUS_PRODUCTION/86400).' Days'; } else if(PLUS_PRODUCTION < 86400){ echo ''.(PLUS_PRODUCTION/3600).' Hours'; } ?></td>
    </tr>
</table>

	<table id="member">
		<thead>
			<tr>
				<th><?php echo LOG_SETT ?> <a href="admin.php?p=editLogSet"><img src="../img/admin/edit.gif" title="<?php echo EDIT_LOG_SETT ?>"></a></th>
			</tr>
		</thead>
	</table>

  <table id="profile">
  <tr>
		<td class="b"><?php echo SERV_VARIABLE ?></td>
		<td class="b"><?php echo SERV_VALUE ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_LOG_BUILD ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_BUILD_TOOLTIP ?></span></em></td>
		<td><?php if(LOG_BUILD) { echo "<b><font color='Green'>Enabled</font></b>"; } elseif(!LOG_BUILD){ echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_LOG_TECHNOLOGY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_TECHNOLOGY_TOOLTIP ?></span></em></td>
		<td><?php if(LOG_TECH) { echo "<b><font color='Green'>Enabled</font></b>"; } elseif(!LOG_TECH){ echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_LOG_LOGIN ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_LOGIN_TOOLTIP ?></span></em></td>
		<td><?php if(LOG_LOGIN) { echo "<b><font color='Green'>Enabled</font></b>"; } elseif(!LOG_LOGIN){ echo "<b><font color='Red'>Disabled</font></b>";  } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_LOG_GOLD ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_GOLD_TOOLTIP ?></span></em></td>
		<td><?php if(LOG_GOLD_FIN) { echo "<b><font color='Green'>Enabled</font></b>"; } elseif(!LOG_GOLD_FIN){ echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_LOG_ADMIN ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_ADMIN_TOOLTIP ?></span></em></td>
		<td><?php if(LOG_ADMIN) { echo "<b><font color='Green'>Enabled</font></b>"; } elseif(!LOG_ADMIN){ echo "<b><font color='Red'>Disabled</font></b>";  } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_LOG_WAR ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_WAR_TOOLTIP ?></span></em></td>
		<td><?php if(LOG_WAR) {	echo "<b><font color='Green'>Enabled</font></b>"; } elseif(!LOG_WAR){ echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_LOG_MARKET ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_MARKET_TOOLTIP ?></span></em></td>
		<td><?php if(LOG_MARKET) { echo "<b><font color='Green'>Enabled</font></b>"; } elseif(!LOG_MARKET){ echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_LOG_ILLEGAL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_ILLEGAL_TOOLTIP ?></span></em></td>
		<td><?php if(LOG_ILLEGAL) { echo "<b><font color='Green'>Enabled</font></b>"; } elseif(!LOG_ILLEGAL){ echo "<b><font color='Red'>Disabled</font></b>";  } ?></td>
	</tr>
</table>

<table id="member">
	<thead>
		<tr>
			<th><?php echo NEWSBOX_SETT ?> <a href="admin.php?p=editNewsboxSet"><img src="../img/admin/edit.gif" title="<?php echo EDIT_NEWSBOX_SETT ?>"></a></th>
		</tr>
	</thead>
</table>

<table id="profile">
	<tr>
		<td class="b"><?php echo SERV_VARIABLE ?></td>
		<td class="b"><?php echo SERV_VALUE ?></td>
	</tr>
	<tr>
		<td><?php echo EDIT_NEWSBOX1 ?> <em class="tooltip">?<span class="classic"><?php echo EDIT_NEWSBOX1_TOOLTIP ?></span></em></td>
		<td><?php if(NEWSBOX1){ echo "<b><font color='Green'>Enabled</font></b>"; } elseif(!NEWSBOX1){ echo "<b><font color='Red'>Disabled</font></b>"; } ?> </td>
	</tr>
	<tr>
		<td><?php echo EDIT_NEWSBOX2 ?> <em class="tooltip">?<span class="classic"><?php echo EDIT_NEWSBOX2_TOOLTIP ?></span></em></td>
		<td><?php if(NEWSBOX2){ echo "<b><font color='Green'>Enabled</font></b>"; } elseif(!NEWSBOX2){ echo "<b><font color='Red'>Disabled</font></b>"; } ?> </td>
	</tr>
	<tr>
		<td><?php echo EDIT_NEWSBOX3 ?> <em class="tooltip">?<span class="classic"><?php echo EDIT_NEWSBOX3_TOOLTIP ?></span></em></td>
		<td><?php if(NEWSBOX3){ echo "<b><font color='Green'>Enabled</font></b>"; } elseif(!NEWSBOX3){ echo "<b><font color='Red'>Disabled</font></b>"; } ?> </td>
	</tr>
	<tr>
	<!--<td>Home 1</td>
		<td><?php if(HOME1){ echo "<b><font color='Green'>Enabled</font></b>"; } else if(HOME1 == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?> </td>
	</tr>
	<tr>
	<td>Home 2</td>
		<td><?php if(HOME2){ echo "<b><font color='Green'>Enabled</font></b>"; } else if(HOME2 == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?> </td>
	</tr>
	<tr>
	<td>Home 3</td>
		<td><?php if(HOME3){ echo "<b><font color='Green'>Enabled</font></b>"; } else if(HOME3 == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?> </td>
	</tr>-->
</table>

<table id="member">
	<thead>
		<tr>
			<th><?php echo SQL_SETTINGS ?></th>
		</tr>
	</thead>
</table>

<table id="profile">
	<tr>
		<td class="b"><?php echo SERV_VARIABLE ?></td>
		<td class="b"><?php echo SERV_VALUE ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SQL_HOSTNAME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_HOSTNAME_TOOLTIP ?></span></em></td>
		<td><?php echo SQL_SERVER;?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SQL_PORT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_PORT_TOOLTIP ?></span></em></td>
		<td><?php echo SQL_PORT;?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SQL_DBUSER ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_DBUSER_TOOLTIP ?></span></em></td>
		<td><?php echo SQL_USER;?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SQL_DBPASS ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_DBPASS_TOOLTIP ?></span></em></td>
		<td>*********</td>
	</tr>
	<tr>
		<td><?php echo CONF_SQL_DBNAME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_DBNAME_TOOLTIP ?></span></em></td>
		<td><?php echo SQL_DB;?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SQL_TBPREFIX ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_TBPREFIX_TOOLTIP ?></span></em></td>
		<td><?php echo TB_PREFIX;?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SQL_DBTYPE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_DBTYPE_TOOLTIP ?></span></em></td>
		<td><?php if(DB_TYPE == 0) { echo "MYSQL"; } else if(DB_TYPE == 1) { echo "MYSQLi"; } ?></td>
	</tr>
</table>

<table id="member">
  <thead>
		<tr>
			<th><?php echo EXTRA_SETT ?> <a href="admin.php?p=editExtraSet"><img src="../img/admin/edit.gif" title="<?php echo EDIT_EXTRA_SETT ?>"></a></th>
		</tr>
	</thead>
</table>

<table id="profile">
	<tr>
		<td class="b"><?php echo SERV_VARIABLE ?></td>
		<td class="b"><?php echo SERV_VALUE ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_EXTRA_LIMITMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_EXTRA_LIMITMAIL_TOOLTIP ?></span></em></td>
		<td><?php if(LIMIT_MAILBOX){ echo "<b><font color='Green'>Enabled</font></b>"; } else if(LIMIT_MAILBOX == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_EXTRA_MAXMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_EXTRA_MAXMAIL_TOOLTIP ?></span></em></td>
		<td><?php if(LIMIT_MAILBOX){ echo MAX_MAIL; } else if(LIMIT_MAILBOX == false){ echo "<font color='Gray'>Limit mailbox disabled</font>"; } ?></td>
	</tr>
</table>

<table id="member">
	<thead>
		<tr>
			<th><?php echo ADMIN_INFO ?> <a href="admin.php?p=editAdminInfo"><img src="../img/admin/edit.gif" title="<?php echo EDIT_ADMIN_INFO ?>"></a></th>
		</tr>
	</thead>
</table>
<table id="profile">
  <tr>
		<td class="b"><?php echo SERV_VARIABLE ?></td>
		<td class="b"><?php echo SERV_VALUE ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_ADMIN_NAME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_NAME_TOOLTIP ?></span></em></td>
		<td><?php if(empty(ADMIN_NAME)){ echo "<b><font color='Red'>No admin name defined!</b></font>"; } else if(ADMIN_NAME != ''){ echo ADMIN_NAME; } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_ADMIN_EMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_EMAIL_TOOLTIP ?></span></em></td>
		<td><?php if(empty(ADMIN_EMAIL)){ echo "<b><font color='Red'>No admin email defined!</b></font>"; } else if(ADMIN_EMAIL != ''){ echo ADMIN_EMAIL; } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_ADMIN_SHOWSTATS ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_SHOWSTATS_TOOLTIP ?></span></em></td>
		<td><?php if(INCLUDE_ADMIN){ echo "<b><font color='Green'>Enabled</font></b>"; } else if(INCLUDE_ADMIN == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_ADMIN_SUPPMESS ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_SUPPMESS_TOOLTIP ?></span></em></td>
		<td><?php if(ADMIN_RECEIVE_SUPPORT_MESSAGES){ echo "<b><font color='Green'>Enabled</font></b>"; } else if(ADMIN_RECEIVE_SUPPORT_MESSAGES == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_ADMIN_RAIDATT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_RAIDATT_TOOLTIP ?></span></em></td>
		<td><?php if(ADMIN_ALLOW_INCOMING_RAIDS){ echo "<b><font color='Green'>Yes</font></b>"; } else if(ADMIN_ALLOW_INCOMING_RAIDS == false){ echo "<b><font color='Red'>No</font></b>"; } ?></td>
	</tr>
</table>

<?php
function define_array($array, $keys = null){
	foreach($array as $key => $value){
		$keyname = ($keys ? $keys."_" : "").$key;
		if(is_array($array[$key])) define_array($array[$key], $keyname);
		else define($keyname, $value);
	}
}
//define_array($array);
?>
