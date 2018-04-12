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
        	<td><?php if(LANG == 'en'){ echo "English"; } ?>
        	<?php if(LANG == 'nl'){ echo "Dutch"; } ?>
        	<?php if(LANG == 'es'){ echo "Spain"; } ?>
        	<?php if(LANG == 'my'){ echo "Malay"; } ?>
        	<?php if(LANG == 'ru'){ echo "Russian"; } ?>
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
		<td><?php echo CONF_SERV_MAPSIZE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_MAPSIZE_TOOLTIP ?></span></em></td>
		<td><?php echo WORLD_MAX;?>x<?php echo WORLD_MAX;?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_VILLEXPSPEED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_VILLEXPSPEED_TOOLTIP ?></span></em></td>
		<td><?php if(CP == 0){ echo "Fast"; } else if(CP == 1){ echo "Slow"; } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_BEGINPROTECT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_BEGINPROTECT_TOOLTIP ?></span></em></td>
		<td><?php echo (PROTECTION/3600);?> hour/s</td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_REGOPEN ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_REGOPEN_TOOLTIP ?></span></em></td>
		<td><?php if(REG_OPEN == true) { echo "<b><font color='blue'>True</font></b>"; } else { echo "<b><font color='Red'>False</font></b>"; } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_ACTIVMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_ACTIVMAIL_TOOLTIP ?></span></em></td>
		<td><?php if(AUTH_EMAIL == true) { echo "<b><font color='Green'>Enabled</font></b>"; } else { echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_QUEST ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_QUEST_TOOLTIP ?></span></em></td>
		<td><?php if(QUEST == true) { echo "<b><font color='Green'>Enabled</font></b>"; } else { echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_QTYPE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_QTYPE_TOOLTIP ?></span></em></td>
		<td><?php if(QTYPE == 25) { echo "<b><font color='Blue'>Travian Official</font></b>"; } else { echo "<b><font color='Blue'>TravianZ Extended</font></b>"; } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_DLR ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_DLR_TOOLTIP ?></span></em></td>
		<td><?php echo DEMOLISH_LEVEL_REQ; ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_WWSTATS ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_WWSTATS_TOOLTIP ?></span></em></td>
		<td><?php if(WW == true) { echo "<b><font color='Green'>Enabled</font></b>"; } else if(WW == false) { echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>	
		<td><?php echo CONF_SERV_NTRTIME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NTRTIME_TOOLTIP ?></span></em></td>
		<td><?php if(NATURE_REGTIME >= 86400){ echo ''.(NATURE_REGTIME/86400).' Days'; } else if(NATURE_REGTIME < 86400){ echo ''.(NATURE_REGTIME/3600).' Hours'; } ?></td>
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
		<td><?php if(GREAT_WKS == true) { echo "<b><font color='Green'>Enabled</font></b>"; } else { echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_NATARSTAT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATARSTAT_TOOLTIP ?></span></em></td>
		<td><?php if(SHOW_NATARS == true) { echo "<b><font color='blue'>True</font></b>"; } else { echo "<b><font color='Red'>False</font></b>"; } ?></td>
	<tr>
		<td><?php echo CONF_SERV_PEACESYST ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_PEACESYST_TOOLTIP ?></span></em></td>
		<td>
			<?php
			$peace_array=array("None","Normal","Christmas","New Year","Easter");
			echo $peace_array[intval(PEACE)];
			?>
		</td>
	</tr>
	<tr>
		<td><?php echo CONF_SERV_GRAPHICPACK ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_GRAPHICPACK_TOOLTIP ?></span></em></td>
		<td><?php if(GP_ENABLE == true) { echo "<b><font color='Green'>Enabled</font></b>"; } else { echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
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
                <th><b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b> Settings <a href="admin.php?p=editPlusSet"><img src="../img/admin/edit.gif" title="Edit PLUS Setting"></a></th>
            </tr>
        </thead>
    </table>

  <table id="profile">
    <tr>
        <td>PayPal E-Mail Address</td>
        <td><?php echo (defined('PAYPAL_EMAIL') ? PAYPAL_EMAIL : 'martin@martinambrus.com'); ?></td>
    </tr>
    <tr>
        <td>Payment Currency</td>
        <td><?php echo (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td>
    </tr>
    <tr>
        <td>Package "A" Amount of Gold</td>
        <td><?php echo (defined('PLUS_PACKAGE_A_GOLD') ? PLUS_PACKAGE_A_GOLD : 60); ?></td>
    </tr>
    <tr>
        <td>Package "A" Amount of Price</td>
        <td><?php echo (defined('PLUS_PACKAGE_A_PRICE') ? PLUS_PACKAGE_A_PRICE : '1,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td>
    </tr>
    <tr>
        <td>Package "B" Amount of Gold</td>
        <td><?php echo (defined('PLUS_PACKAGE_B_GOLD') ? PLUS_PACKAGE_B_GOLD : 120); ?></td>
    </tr>
    <tr>
        <td>Package "B" Amount of Price</td>
        <td><?php echo (defined('PLUS_PACKAGE_B_PRICE') ? PLUS_PACKAGE_B_PRICE : '4,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td>
    </tr>
    <tr>
        <td>Package "C" Amount of Gold</td>
        <td><?php echo (defined('PLUS_PACKAGE_C_GOLD') ? PLUS_PACKAGE_C_GOLD : 360); ?></td>
    </tr>
    <tr>
        <td>Package "C" Amount of Price</td>
        <td><?php echo (defined('PLUS_PACKAGE_C_PRICE') ? PLUS_PACKAGE_C_PRICE : '9,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td>
    </tr>
    <tr>
        <td>Package "D" Amount of Gold</td>
        <td><?php echo (defined('PLUS_PACKAGE_D_GOLD') ? PLUS_PACKAGE_D_GOLD : 1000); ?></td>
    </tr>
    <tr>
        <td>Package "D" Amount of Price</td>
        <td><?php echo (defined('PLUS_PACKAGE_D_PRICE') ? PLUS_PACKAGE_D_PRICE : '19,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td>
    </tr>
    <tr>
        <td>Package "E" Amount of Gold</td>
        <td><?php echo (defined('PLUS_PACKAGE_E_GOLD') ? PLUS_PACKAGE_E_GOLD : 2000); ?></td>
    </tr>
    <tr>
        <td>Package "E" Amount of Price</td>
        <td><?php echo (defined('PLUS_PACKAGE_E_PRICE') ? PLUS_PACKAGE_E_PRICE : '49,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td>
    </tr>
    <tr>
        <td><b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b> account duration</td>
        <td><?php if(PLUS_TIME >= 86400){ echo ''.(PLUS_TIME/86400).' Days'; } else if(PLUS_TIME < 86400){ echo ''.(PLUS_TIME/3600).' Hours'; } ?></td>
    </tr>
    <tr>
        <td>+25% production duration</td>
        <td><?php if(PLUS_PRODUCTION >= 86400){ echo ''.(PLUS_PRODUCTION/86400).' Days'; } else if(PLUS_PRODUCTION < 86400){ echo ''.(PLUS_PRODUCTION/3600).' Hours'; } ?></td>
    </tr>
</table>

	<table id="member">
		<thead>
			<tr>
				<th>Log Settings <a href="admin.php?p=editLogSet"><img src="../img/admin/edit.gif" title="Edit Log Setting"></a></th>
			</tr>
		</thead>
	</table>

  <table id="profile">
  <tr>
		<td class="b">Variable</td>
		<td class="b">Value</td>
	</tr>
	<tr>
		<td>Log Build</td>
		<td><?php if(LOG_BUILD == true) { echo "<b><font color='Green'>Enabled</font></b>"; } else if(LOG_BUILD == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td>Log Technology</td>
		<td><?php if(LOG_TECH == true) { echo "<b><font color='Green'>Enabled</font></b>"; } else if(LOG_TECH == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td>Log Login</td>
		<td><?php if(LOG_LOGIN == true) { echo "<b><font color='Green'>Enabled</font></b>"; } else if(LOG_LOGIN == false){ echo "<b><font color='Red'>Disabled</font></b>";  } ?></td>
	</tr>
	<tr>
		<td>Log Gold</td>
		<td><?php if(LOG_GOLD_FIN == true) { echo "<b><font color='Green'>Enabled</font></b>"; } else if(LOG_GOLD_FIN == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td>Log Admin</td>
		<td><?php if(LOG_ADMIN == true) { echo "<b><font color='Green'>Enabled</font></b>"; } else if(LOG_ADMIN == false){ echo "<b><font color='Red'>Disabled</font></b>";  } ?></td>
	</tr>
	<tr>
		<td>Log War</td>
		<td><?php if(LOG_WAR == true) {	echo "<b><font color='Green'>Enabled</font></b>"; } else if(LOG_WAR == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td>Log Market</td>
		<td><?php if(LOG_MARKET == true) { echo "<b><font color='Green'>Enabled</font></b>"; } else if(LOG_MARKET == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td>Log Illegal</td>
		<td><?php if(LOG_ILLEGAL == true) { echo "<b><font color='Green'>Enabled</font></b>"; } else if(LOG_ILLEGAL == false){ echo "<b><font color='Red'>Disabled</font></b>";  } ?></td>
	</tr>
</table>

<table id="member">
	<thead>
		<tr>
			<th>Newsbox Settings <a href="admin.php?p=editNewsboxSet"><img src="../img/admin/edit.gif" title="Edit Newsbox Setting"></a></th>
		</tr>
	</thead>
</table>

<table id="profile">
	<tr>
		<td class="b">Variable</td>
		<td class="b">Value</td>
	</tr>
	<tr>
		<td>Newsbox 1</td>
		<td><?php if(NEWSBOX1 == true){ echo "<b><font color='Green'>Enabled</font></b>"; } else if(NEWSBOX1 == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?> </td>
	</tr>
	<tr>
		<td>Newsbox 2</td>
		<td><?php if(NEWSBOX2 == true){ echo "<b><font color='Green'>Enabled</font></b>"; } else if(NEWSBOX2 == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?> </td>
	</tr>
	<tr>
		<td>Newsbox 3</td>
		<td><?php if(NEWSBOX3 == true){ echo "<b><font color='Green'>Enabled</font></b>"; } else if(NEWSBOX3 == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?> </td>
	</tr>
	<tr>
	<!--<td>Home 1</td>
		<td><?php if(HOME1 == true){ echo "<b><font color='Green'>Enabled</font></b>"; } else if(HOME1 == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?> </td>
	</tr>
	<tr>
	<td>Home 2</td>
		<td><?php if(HOME2 == true){ echo "<b><font color='Green'>Enabled</font></b>"; } else if(HOME2 == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?> </td>
	</tr>
	<tr>
	<td>Home 3</td>
		<td><?php if(HOME3 == true){ echo "<b><font color='Green'>Enabled</font></b>"; } else if(HOME3 == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?> </td>
	</tr>-->
</table>

<table id="member">
	<thead>
		<tr>
			<th>SQL Settings</th>
		</tr>
	</thead>
</table>

<table id="profile">
	<tr>
		<td class="b">Variable</td>
		<td class="b">Value</td>
	</tr>
	<tr>
		<td>Hostname</td>
		<td><?php echo SQL_SERVER;?></td>
	</tr>
	<tr>
		<td>Port</td>
		<td><?php echo SQL_PORT;?></td>
	</tr>
	<tr>
		<td>DB Username</td>
		<td><?php echo SQL_USER;?></td>
	</tr>
	<tr>
		<td>DB Password</td>
		<td>*********</td>
	</tr>
	<tr>
		<td>DB Name</td>
		<td><?php echo SQL_DB;?></td>
	</tr>
	<tr>
		<td>Table Prefix</td>
		<td><?php echo TB_PREFIX;?></td>
	</tr>
	<tr>
		<td>DB Type</td>
		<td><?php if(DB_TYPE == 0) { echo "MYSQL"; } else if(DB_TYPE == 1) { echo "MYSQLi"; } ?></td>
	</tr>
</table>

<table id="member">
  <thead>
		<tr>
			<th>Extra Settings <a href="admin.php?p=editExtraSet"><img src="../img/admin/edit.gif" title="Edit Extra Settings"></a></th>
		</tr>
	</thead>
</table>

<table id="profile">
	<tr>
		<td class="b">Variable</td>
		<td class="b">Value</td>
	</tr>
	<tr>
		<td>Limit Mailbox</td>
		<td><?php if(LIMIT_MAILBOX == true){ echo "<b><font color='Green'>Enabled</font></b>"; } else if(LIMIT_MAILBOX == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td>Max number of mails</td>
		<td><?php if(LIMIT_MAILBOX == true){ echo MAX_MAIL; } else if(LIMIT_MAILBOX == false){ echo "<font color='Gray'>Limit mailbox disabled</font>"; } ?></td>
	</tr>
</table>

<table id="member">
	<thead>
		<tr>
			<th>Admin Information <a href="admin.php?p=editAdminInfo"><img src="../img/admin/edit.gif" title="Edit Admin Info"></a></th>
		</tr>
	</thead>
</table>
<table id="profile">
  <tr>
		<td class="b">Variable</td>
		<td class="b">Value</td>
	</tr>
	<tr>
		<td>Admin Email</td>
		<td><?php if(ADMIN_EMAIL == ''){ echo "<b><font color='Red'>No admin email defined!</b></font>"; } else if(ADMIN_EMAIL != ''){ echo ADMIN_EMAIL; } ?></td>
	</tr>
	<tr>
		<td>Admin Name</td>
		<td><?php if(ADMIN_NAME == ''){ echo "<b><font color='Red'>No admin name defined!</b></font>"; } else if(ADMIN_NAME != ''){ echo ADMIN_NAME; } ?></td>
	</tr>
	<tr>
		<td>Include Admin in Rank</td>
		<td><?php if(INCLUDE_ADMIN == true){ echo "<b><font color='Green'>Enabled</font></b>"; } else if(INCLUDE_ADMIN == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td>Include Support Messages in Admin Mailbox</td>
		<td><?php if(ADMIN_RECEIVE_SUPPORT_MESSAGES == true){ echo "<b><font color='Green'>Enabled</font></b>"; } else if(ADMIN_RECEIVE_SUPPORT_MESSAGES == false){ echo "<b><font color='Red'>Disabled</font></b>"; } ?></td>
	</tr>
	<tr>
		<td>Allow Administrative Accounts to be Raided and Attacked</td>
		<td><?php if(ADMIN_ALLOW_INCOMING_RAIDS == true){ echo "<b><font color='Green'>Yes</font></b>"; } else if(ADMIN_ALLOW_INCOMING_RAIDS == false){ echo "<b><font color='Red'>No</font></b>"; } ?></td>
	</tr>
</table>

<?php
function define_array( $array, $keys = NULL )
{
	foreach( $array as $key => $value )
	{
		$keyname = ($keys ? $keys . "_" : "") . $key;
		if( is_array( $array[$key] ) )
			define_array( $array[$key], $keyname );
		else
			define( $keyname, $value );
	}
}
//define_array($array);
?>
