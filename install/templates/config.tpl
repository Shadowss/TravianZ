<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : config.tpl                                                ##
##  Type           : Install Panel Frontend & Backend                          ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki (Original)                                          ##
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

if(isset($_GET['c']) && $_GET['c'] == 1) {
echo "<div class=\"headline\"><span class=\"f10 c5\">Error creating constant.php check cmod.</span></div><br>";
}

@session_start();

$envPath = dirname(__DIR__, 2). '/.env';
$envDefaults = [];
if(file_exists($envPath)) {
    $lines = @file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if(is_array($lines)) {
        foreach($lines as $line) {
            $line = trim($line);
            if($line === '' || $line[0] === '#') {
                continue;
            }

            $eqPos = strpos($line, '=');
            if($eqPos === false) {
                continue;
            }

            $key = trim(substr($line, 0, $eqPos));
            $value = trim(substr($line, $eqPos + 1));
            if($key === '') {
                continue;
            }

            if((strlen($value) >= 2) && (($value[0] === '"' && substr($value, -1) === '"') || ($value[0] === "'" && substr($value, -1) === "'"))) {
                $value = substr($value, 1, -1);
            }

            $envDefaults[$key] = $value;
        }

        // Resolve ${VAR} references using parsed values first, then process env.
        foreach($envDefaults as $key => $value) {
            $envDefaults[$key] = preg_replace_callback('/\$\{([A-Z0-9_]+)\}/i', function($m) use ($envDefaults) {
                $ref = $m[1];
                if(isset($envDefaults[$ref])) return $envDefaults[$ref];
                $fromEnv = getenv($ref);
                return ($fromEnv!== false)? $fromEnv : '';
            }, $value);
        }
    }
}

$dbHost = $envDefaults['DB_HOST']?? 'localhost';
$dbPort = $envDefaults['DB_PORT']?? '3306';
$dbUser = $envDefaults['MARIADB_USER']?? ($envDefaults['MYSQL_USER']?? '');
$dbPass = $envDefaults['MARIADB_PASSWORD']?? ($envDefaults['MYSQL_PASSWORD']?? '');
$dbName = $envDefaults['MARIADB_DATABASE']?? ($envDefaults['MYSQL_DATABASE']?? '');

if(empty($_SESSION['install_random_prefix'])) {
    try {
        $_SESSION['install_random_prefix'] = 's'. substr(bin2hex(random_bytes(2)), 0, 4). '_';
    } catch (Throwable $e) {
        $_SESSION['install_random_prefix'] = 's'. str_pad((string) mt_rand(0, 9999), 4, '0', STR_PAD_LEFT). '_';
    }
}
$dbPrefix = $_SESSION['install_random_prefix'];
?>

<form action="process.php" method="post" id="dataform">
<input type="hidden" name="subconst" value="1">

<div class="card">
  <span class="f10 c">SERVER RELATED</span>
  <div class="grid-2" style="margin-top:8px;">
    <div><label>Server name</label><input class="input" name="servername" id="servername" value="TravianZ"></div>
    <div><label>Timezone</label>
      <select class="input" name="tzone" onchange="refresh(this.value)">
        <option value="1,Africa/Dakar" <?=$tz==1?'selected':''?>>Africa</option>
        <option value="2,America/New_York" <?=$tz==2?'selected':''?>>America</option>
        <option value="13,America/Sao_Paulo" <?=$tz==13?'selected':''?>>Brazil</option>
        <option value="3,Antarctica/Casey" <?=$tz==3?'selected':''?>>Antarctica</option>
        <option value="4,Arctic/Longyearbyen" <?=$tz==4?'selected':''?>>Arctic</option>
        <option value="5,Asia/Kuala_Lumpur" <?=$tz==5?'selected':''?>>Asia</option>
        <option value="6,Atlantic/Azores" <?=$tz==6?'selected':''?>>Atlantic</option>
        <option value="7,Australia/Melbourne" <?=$tz==7?'selected':''?>>Australia</option>
        <option value="8,Europe/Bucharest" <?=$tz==8?'selected':''?>>Europe (Bucharest)</option>
        <option value="9,Europe/London" <?=$tz==9?'selected':''?>>Europe (London)</option>
        <option value="14,Europe/Zurich" <?=$tz==14?'selected':''?>>Europe (Switzerland)</option>
        <option value="10,Europe/Bratislava" <?=$tz==10?'selected':''?>>Europe (Bratislava)</option>
        <option value="11,Indian/Maldives" <?=$tz==11?'selected':''?>>Indian</option>
        <option value="12,Pacific/Fiji" <?=$tz==12?'selected':''?>>Pacific</option>
      </select>
    </div>
    <div><label>Server speed</label><input class="input" name="speed" id="speed" value="1"></div>
    <div><label>Troop speed</label><input class="input" name="incspeed" id="incspeed" value="1"></div>
    <div><label>Evasion speed</label><input class="input" name="evasionspeed" id="evasionspeed" value="1"></div>
    <div><label>Trader capacity</label><input class="input" name="tradercap" id="tradercap" value="1"></div>
    <div><label>Cranny capacity</label><input class="input" name="crannycap" id="crannycap" value="1"></div>
    <div><label>Trapper capacity</label><input class="input" name="trappercap" id="trappercap" value="1"></div>
    <div><label>World size</label>
      <select class="input" name="wmax">
        <option value="10">10x10</option><option value="25">25x25</option><option value="50">50x50</option>
        <option value="100" selected>100x100</option><option value="150">150x150</option><option value="200">200x200</option>
        <option value="250">250x250</option><option value="300">300x300</option><option value="350">350x350</option><option value="400">400x400</option>
      </select>
    </div>
    <div><label>Language</label>
      <select class="input" name="lang"><option value="en" selected>English</option><option value="fr">French</option><option value="it">Italian</option><option value="ro">Romanian</option><option value="zh">Chinese</option></select>
    </div>
    <div><label>Beginners protection</label>
      <select class="input" name="beginner">
        <option value="7200">2 hours</option><option value="10800">3 hours</option><option value="18000">5 hours</option><option value="28800">8 hours</option><option value="36000">10 hours</option>
        <option value="43200" selected>12 hours</option><option value="86400">24 hours (1 day)</option><option value="172800">48 hours (2 days)</option><option value="259200">72 hours (3 days)</option><option value="432000">120 hours (5 days)</option>
      </select>
    </div>
    <div><label>Register Open</label><select class="input" name="reg_open"><option value="true" selected>true</option><option value="false">false</option></select></div>
  </div>
</div>

<div class="grid-2">
  <div class="card">
    <span class="f10 c">NATARS & MAP</span>
    <div style="margin-top:12px;display:grid;gap:10px;">
      <div><label>Natars Units Multiplier</label><input class="input" name="natars_units" id="natars_units" value="100"></div>
      <div><label>Natars Spawn (days)</label><input class="input" name="natars_spawn_time" id="natars_spawn_time" value="260"></div>
      <div><label>WW Spawn (days)</label><input class="input" name="natars_ww_spawn_time" id="natars_ww_spawn_time" value="260"></div>
      <div><label>WW BP Spawn (days)</label><input class="input" name="natars_ww_building_plan_spawn_time" id="natars_ww_building_plan_spawn_time" value="260"></div>
      <div><label>Nature regen</label><select class="input" name="nature_regtime"><option value="28800">8 hours</option><option value="36000">10 hours</option><option value="43200" selected>12 hours</option><option value="57600">16 hours</option><option value="72000">20 hours</option><option value="86400">24 hours</option></select></div>
    </div>
  </div>
  <div class="card">
    <span class="f10 c">OASIS & STORAGE</span>
    <div style="margin-top:12px;display:grid;gap:10px;">
      <div><label>Wood multiplier</label><input class="input" name="oasis_wood_multiplier" id="oasis_wood_multiplier" value="40"></div>
      <div><label>Clay multiplier</label><input class="input" name="oasis_clay_multiplier" id="oasis_clay_multiplier" value="40"></div>
      <div><label>Iron multiplier</label><input class="input" name="oasis_iron_multiplier" id="oasis_iron_multiplier" value="40"></div>
      <div><label>Crop multiplier</label><input class="input" name="oasis_crop_multiplier" id="oasis_crop_multiplier" value="40"></div>
      <div><label>Storage Multiplier</label><input class="input" name="storage_multiplier" id="storage_multiplier" value="1"></div>
      <div><label>TS Threshold</label><input class="input" name="ts_threshold" id="ts_threshold" value="20"></div>
    </div>
  </div>
</div>

<div class="grid-2">
  <div class="card">
    <span class="f10 c">SQL RELATED</span>
    <div style="margin-top:12px;display:grid;gap:10px;">
      <div><label>Hostname</label><input class="input" name="sserver" id="sserver" value="<?=htmlspecialchars($dbHost, ENT_QUOTES, 'UTF-8')?>"></div>
      <div><label>Port</label><input class="input" name="sport" id="sport" value="<?=htmlspecialchars($dbPort, ENT_QUOTES, 'UTF-8')?>"></div>
      <div><label>Username</label><input class="input" name="suser" id="suser" value="<?=htmlspecialchars($dbUser, ENT_QUOTES, 'UTF-8')?>"></div>
      <div><label>Password</label><input class="input" type="password" name="spass" id="spass" value="<?=htmlspecialchars($dbPass, ENT_QUOTES, 'UTF-8')?>"></div>
      <div><label>DB name</label><input class="input" name="sdb" id="sdb" value="<?=htmlspecialchars($dbName, ENT_QUOTES, 'UTF-8')?>"></div>
      <div><label>Prefix</label><input class="input" name="prefix" id="prefix" value="<?=htmlspecialchars($dbPrefix, ENT_QUOTES, 'UTF-8')?>" size="7"></div>
      <div><label>Type</label><select class="input" name="connectt"><option value="0" disabled>MYSQL (deprecated, removed in PHP 7)</option><option value="1" selected>MYSQLi</option></select></div>
    </div>
  </div>
  <div class="card">
    <span class="f10 c">SERVER URLS</span>
    <div style="margin-top:12px;display:grid;gap:10px;">
      <div><label>Server</label><input class="input" name="server" id="homepage" value="http://<?=$_SERVER['HTTP_HOST']?>/"></div>
      <div><label>Domain</label><input class="input" name="domain" id="homepage" value="http://<?=$_SERVER['HTTP_HOST']?>/"></div>
      <div><label>Homepage</label><input class="input" name="homepage" id="homepage" value="http://<?=$_SERVER['HTTP_HOST']?>/"></div>
      <div><label>Medal Interval</label><select class="input" name="medalinterval"><option value="0">none</option><option value="(3600*24)">1 day</option><option value="(3600*24*2)">2 days</option><option value="(3600*24*3)">3 days</option><option value="(3600*24*4)">4 days</option><option value="(3600*24*5)">5 days</option><option value="(3600*24*6)">6 days</option><option value="(3600*24*7)" selected>7 days</option></select></div>
      <div><label>Great Workshop</label><select class="input" name="great_wks"><option value="true">true</option><option value="false" selected>false</option></select></div>
      <div><label>WW enabled</label><select class="input" name="ww"><option value="true">true</option><option value="false" selected>false</option></select></div>
      <div><label>Show Natars</label><select class="input" name="show_natars"><option value="true">true</option><option value="false" selected>false</option></select></div>
      <div><label>Peace system</label><select class="input" name="peace"><option value="0" selected>None</option><option value="1">Normal</option><option value="2">Christmas</option><option value="3">New Year</option><option value="4">Easter</option></select></div>
    </div>
  </div>
</div>

<div class="card">
  <span class="f10 c">NEW MECHANICS AND FUNCTIONS</span>
	<div class="grid-1" style="margin-top:12px;display:flex;flex-direction:column;gap:10px;">

<?php
$mechs = [
    'new_functions_oasis'                 => 'Display oasis in profile',
    'new_functions_alliance_invitation'   => 'Alliance invitation',
    'new_functions_embassy_mechanics'     => 'Embassy mechanics',
    'new_functions_forum_post_message'    => 'Forum post message',
    'new_functions_tribe_images'          => 'Tribes images',
    'new_functions_mhs_images'            => 'MHs images',
    'new_functions_display_artifact'      => 'Display artifact',
    'new_functions_display_wonder'        => 'Display wonder',
    'new_functions_vacation'              => 'Vacation Mode',
    'new_functions_display_catapult_target'=> 'Catapult targets',
    'new_functions_manual_naturenatars'   => 'Manual Nature/Natars',
    'new_functions_display_links'         => 'Direct links',
    'new_functions_medal_3year'           => 'Medal 3y',
    'new_functions_medal_5year'           => 'Medal 5y',
    'new_functions_medal_10year'          => 'Medal 10y',
	'new_functions_special_medals_system' => 'Special Medals System',
	'new_functions_milestones'            => 'Server Milestones'
];

foreach($mechs as $k => $l){
    echo "
    <div style='display:flex;flex-direction:column;gap:4px;'>
        <label>$l</label>
        <select class='input' name='$k'>
            <option value='true'>true</option>
            <option value='false' selected>false</option>
        </select>
    </div>";
}
?>

</div>
</div>

<div class="card">
  <span class="f10 c">PLUS GOLD PACKAGES</span>
  <div class="grid-2" style="margin-top:12px;">
    <div><label>PayPal Email</label><input class="input" name="paypal-email" id="paypal-email" value="@"></div>
    <div><label>Currency</label><input class="input" name="paypal-currency" id="paypal-currency" value="EUR"></div>
    <div><label>Package A Gold</label><input class="input" name="plus-a-gold" id="plus-a-gold" value="60"></div>
    <div><label>Package A Price</label><input class="input" name="plus-a-price" id="plus-a-price" value="1,99"></div>
    <div><label>Package B Gold</label><input class="input" name="plus-b-gold" id="plus-b-gold" value="120"></div>
    <div><label>Package B Price</label><input class="input" name="plus-b-price" id="plus-b-price" value="4,99"></div>
    <div><label>Package C Gold</label><input class="input" name="plus-c-gold" id="plus-c-gold" value="360"></div>
    <div><label>Package C Price</label><input class="input" name="plus-c-price" id="plus-c-price" value="9,99"></div>
    <div><label>Package D Gold</label><input class="input" name="plus-d-gold" id="plus-d-gold" value="1000"></div>
    <div><label>Package D Price</label><input class="input" name="plus-d-price" id="plus-d-price" value="19,99"></div>
    <div><label>Package E Gold</label><input class="input" name="plus-e-gold" id="plus-e-gold" value="2000"></div>
    <div><label>Package E Price</label><input class="input" name="plus-e-price" id="plus-e-price" value="49,99"></div>
    <div><label>Plus length</label><select class="input" name="plus_time"><option value="(3600*12)">12 hours</option><option value="(3600*24)">1 day</option><option value="(3600*24*2)">2 days</option><option value="(3600*24*3)">3 days</option><option value="(3600*24*4)">4 days</option><option value="(3600*24*5)">5 days</option><option value="(3600*24*6)">6 days</option><option value="(3600*24*7)" selected>7 days</option></select></div>
    <div><label>+25% production</label><select class="input" name="plus_production"><option value="(3600*12)">12 hours</option><option value="(3600*24)">1 day</option><option value="(3600*24*2)">2 days</option><option value="(3600*24*3)">3 days</option><option value="(3600*24*4)">4 days</option><option value="(3600*24*5)">5 days</option><option value="(3600*24*6)">6 days</option><option value="(3600*24*7)" selected>7 days</option></select></div>
  </div>
</div>

<div class="grid-2">
  <div class="card">
    <span class="f10 c">NEWSBOX OPTIONS</span>
    <div style="margin-top:12px;display:grid;gap:10px;">
      <div><label>Newsbox 1</label><select class="input" name="box1"><option value="true">Enabled</option><option value="false" selected>Disabled</option></select></div>
      <div><label>Newsbox 2</label><select class="input" name="box2"><option value="true">Enabled</option><option value="false" selected>Disabled</option></select></div>
      <div><label>Newsbox 3</label><select class="input" name="box3"><option value="true">Enabled</option><option value="false" selected>Disabled</option></select></div>
    </div>
  </div>
  <div class="card">
    <span class="f10 c">LOG RELATED (You should disable them)</span>
    <div style="margin-top:12px;display:grid;gap:10px;">
      <div><label>Log Building</label><select class="input" name="log_build"><option value="true">Yes</option><option value="false" selected>No</option></select></div>
      <div><label>Log Tech</label><select class="input" name="log_tech"><option value="true">Yes</option><option value="false" selected>No</option></select></div>
      <div><label>Log Login</label><select class="input" name="log_login"><option value="true">Yes</option><option value="false" selected>No</option></select></div>
      <div><label>Log Gold</label><select class="input" name="log_gold_fin"><option value="true">Yes</option><option value="false" selected>No</option></select></div>
      <div><label>Log Admin</label><select class="input" name="log_admin"><option value="true">Yes</option><option value="false" selected>No</option></select></div>
      <div><label>Log War</label><select class="input" name="log_war"><option value="true">Yes</option><option value="false" selected>No</option></select></div>
      <div><label>Log Market</label><select class="input" name="log_market"><option value="true">Yes</option><option value="false" selected>No</option></select></div>
      <div><label>Log Illegal</label><select class="input" name="log_illegal"><option value="true">Yes</option><option value="false" selected>No</option></select></div>
    </div>
  </div>
</div>

<div class="card">
  <span class="f10 c">EXTRA OPTIONS</span>
  <div class="grid-2" style="margin-top:12px;">
    <div><label>Quest</label><select class="input" name="quest"><option value="true" selected>Yes</option><option value="false">No</option></select></div>
    <div><label>Quest Type</label><select class="input" name="qtype"><option value="25" selected>Official Travian</option><option value="37">TravianZ Extended</option></select></div>
    <div><label>Activate</label><select class="input" name="activate"><option value="true">Yes</option><option value="false" selected>No</option></select></div>
    <div><label>Limit Mailbox</label><select class="input" name="limit_mailbox"><option value="true">Yes</option><option value="false" selected>No</option></select></div>
    <div><label>Max mails</label><input class="input" name="max_mails" id="max_mails" value="30"></div>
    <div><label>Demolish - lvl required</label><select class="input" name="demolish"><option value="5">5</option><option value="10" selected>10 - Default</option><option value="15">15</option><option value="20">20</option></select></div>
    <div><label>Village Expand</label><select class="input" name="village_expand"><option value="1" selected>Slow</option><option value="0">Fast</option></select></div>
    <div><label>Error Reporting</label><select class="input" name="error"><option value="error_reporting (E_ALL ^ E_NOTICE ^ E_DEPRECATED);" selected>Yes</option><option value="error_reporting (0);">No</option></select></div>
    <div><label>T4 is Coming screen</label><select class="input" name="t4_coming"><option value="true">Yes</option><option value="false" selected>No</option></select></div>
    <div><label>Start Date</label><input class="input" name="start_date" id="start_date" value="<?=date('d.m.Y')?>"></div>
    <div><label>Start Time</label><input class="input" name="start_time" id="start_time" value="<?=date('H:i')?>"></div>
  </div>
</div>

<div style="text-align:center;margin:18px 0;">
  <button class="btn" type="submit" name="Submit" id="Submit">Save Configuration →</button>
</div>
</form>