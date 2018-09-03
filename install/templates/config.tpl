<?php

##############################################################################################
##                      -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                      ##
## ---------------------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                                 ##
##  Version:       22.06.2015                    			                                ##
##  Filename       config.tpl                                                               ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix, martinambrus  ##
##  Fixed by:      Shadow - STARVATION , HERO FIXED COMPL.  		                        ##
##  Fixed by:      InCube - double troops				                                    ##
##  License:       TravianZ Project                                                         ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                             ##
##  URLs:          http://travian.shadowss.ro                		                        ##
##  Source code:   https://github.com/Shadowss/TravianZ		                                ##
##                                                                                          ##
##############################################################################################

if(isset($_GET['c']) && $_GET['c'] == 1) {
echo "<div class=\"headline\"><span class=\"f10 c5\">Error creating constant.php check cmod.</span></div><br>";
}
?>

<form action="process.php" method="post" id="dataform">
    <p>
        <span class="f10 c">SERVER RELATED</span>
    <table>
        <tr>
            <td>
                <span class="f9 c6">Server name:</span>
            </td>
            <td width="140">
                <input type="text" name="servername" id="servername" value="TravianZ">
            </td>
        </tr>
        <tr>
            <td>
                <span class="f9 c6">Server Timezone:</span>
            </td>
            <td>
                <select name="tzone" onChange="refresh(this.value)">
                    <option value="1,Africa/Dakar" <?php if ($tz==1) echo "selected";?>>Africa</option>
                    <option value="2,America/New_York" <?php if ($tz==2) echo "selected";?>>America</option>
                    <option value="3,Antarctica/Casey" <?php if ($tz==3) echo "selected";?>>Antarctica</option>
                    <option value="4,Arctic/Longyearbyen" <?php if ($tz==4) echo "selected";?>>Arctic</option>
                    <option value="5,Asia/Kuala_Lumpur" <?php if ($tz==5) echo "selected";?>>Asia</option>
                    <option value="6,Atlantic/Azores" <?php if ($tz==6) echo "selected";?>>Atlantic</option>
                    <option value="7,Australia/Melbourne" <?php if ($tz==7) echo "selected";?>>Australia</option>
                    <option value="8,Europe/Bucharest" <?php if ($tz==8) echo "selected";?>>Europe (Bucharest)</option>
                    <option value="9,Europe/London" <?php if ($tz==9) echo "selected";?>>Europe (London)</option>
                    <option value="10,Indian/Maldives" <?php if ($tz==10) echo "selected";?>>Indian</option>
                    <option value="11,Pacific/Fiji" <?php if ($tz==11) echo "selected";?>>Pacific</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <span class="f9 c6">Server speed:</span>
            </td>
            <td>
                <input name="speed" type="text" id="speed" value="1" size="2">
            </td>
        </tr>
        <tr>
            <td>
                <span class="f9 c6">Troop speed:</span>
            </td>
            <td width="140">
                <input type="text" name="incspeed" id="incspeed" value="1" size="2">
            </td>
        </tr>
        <tr>
            <td>
                <span class="f9 c6">Evasion speed:</span>
            </td>
            <td>
                <input name="evasionspeed" type="text" id="evasionspeed" value="1" size="2">
            </td>
        </tr>
        <tr>
            <td>
                <span class="f9 c6">Trader capacity (1 = 1x...):</span>
            </td>
            <td width="140">
                <input type="text" name="tradercap" id="tradercap" value="1" size="2">
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Cranny capacity:</span></td>
            <td width="140"><input type="text" name="crannycap" id="crannycap" value="1" size="2"></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Trapper capacity:</span></td>
            <td width="140"><input type="text" name="trappercap" id="trappercap" value="1" size="2"></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Natars Units Multiplier:</span></td>
            <td width="140"><input type="text" name="natars_units" id="natars_units" value="100" size="3"></td>         
        </tr>
        <tr>
        	<td><span class="f9 c6">Natars Spawn (Days):</span></td>
            <td width="140"><input type="text" name="natars_spawn_time" id="natars_spawn_time" value="260" size="3"></td>
        </tr>
        <tr>
        	<td><span class="f9 c6">WW spawn (Days):</span></td>
            <td width="140"><input type="text" name="natars_ww_spawn_time" id="natars_ww_spawn_time" value="260" size="3"></td>
        </tr>
        <tr>
        	<td><span class="f9 c6">WW building plan spawn (Days):</span></td>
            <td width="140"><input type="text" name="natars_ww_building_plan_spawn_time" id="natars_ww_building_plan_spawn_time" value="260" size="3"></td>           
        </tr>      
        <tr>
            <td><span class="f9 c6">World size:</span></td>
            <td>
                <select name="wmax">
                    <option value="10">10x10</option>
                    <option value="25">25x25</option>
                    <option value="50">50x50</option>
                    <option value="100" selected="selected">100x100</option>
                    <option value="150">150x150</option>
                    <option value="200">200x200</option>
                    <option value="250">250x250</option>
                    <option value="300">300x300</option>
                    <option value="350">350x350</option>
                    <option value="400">400x400</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Register Open:</span></td>
            <td>
                <select name="reg_open">
                    <option value="true" selected="selected">true</option>
                    <option value="false">false</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Server:</span></td>
            <td><input name="server" type="text" id="homepage" value="http://<?php echo $_SERVER['HTTP_HOST']; ?>/"></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Domain:</span></td>
            <td><input name="domain" type="text" id="homepage" value="http://<?php echo $_SERVER['HTTP_HOST']; ?>/"></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Homepage:</span></td>
            <td><input name="homepage" type="text" id="homepage" value="http://<?php echo $_SERVER['HTTP_HOST']; ?>/"></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Language:</span></td>
            <td>
                <select name="lang">
                    <option value="en" selected="selected">English</option>
                    <option value="es">Spanish</option>
                    <option value="rs">Serbian</option>
                    <option value="ru">Rusian</option>
                    <option value="zh_tw">Taiwanese</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Beginners protection length:</span></td>
            <td>
                <select name="beginner">
                    <option value="7200">2 hours</option>
                    <option value="10800">3 hours</option>
                    <option value="18000">5 hours</option>
                    <option value="28800">8 hours</option>
                    <option value="36000">10 hours</option>
                    <option value="43200" selected="selected">12 hours</option>
                    <option value="86400">24 hours (1 day)</option>
                    <option value="172800">48 hours (2 days)</option>
                    <option value="259200">72 hours (3 days)</option>
                    <option value="432000">120 hours (5 days)</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Nature troops regeneration time:</span></td>
            <td>
                <select name="nature_regtime">
                    <option value="28800">8 hours</option>
                    <option value="36000">10 hours</option>
                    <option value="43200" selected="selected">12 hours</option>
                    <option value="57600">16 hours</option>
                    <option value="72000">20 hours</option>
                    <option value="86400">24 hours</option>
                </select>
            </td>
        </tr>
        <tr>
        	<td><span class="f9 c6">Oasis wood production multiplier:</span></td>
            <td width="140"><input type="text" name="oasis_wood_multiplier" id="oasis_wood_multiplier" value="40"></td>                    
        </tr>
        <tr>
        	<td><span class="f9 c6">Oasis clay production multiplier:</span></td>
            <td width="140"><input type="text" name="oasis_clay_multiplier" id="oasis_clay_multiplier" value="40"></td>
        </tr>
        <tr>
        	<td><span class="f9 c6">Oasis iron production multiplier:</span></td>
            <td width="140"><input type="text" name="oasis_iron_multiplier" id="oasis_iron_multiplier" value="40"></td>
        </tr>
        <tr>
        	<td><span class="f9 c6">Oasis crop production multiplier:</span></td>
            <td width="140"><input type="text" name="oasis_crop_multiplier" id="oasis_crop_multiplier" value="40"></td>
        </tr>
        <tr>
        <tr class="hover">
            <td><span class="f9 c6">Medal Interval:</span></td>
            <td>
                <select name="medalinterval">
                    <option value="0">none</option>
                    <option value="(3600*24)">1 day</option>
                    <option value="(3600*24*2)">2 days</option>
                    <option value="(3600*24*3)">3 days</option>
                    <option value="(3600*24*4)">4 days</option>
                    <option value="(3600*24*5)">5 days</option>
                    <option value="(3600*24*6)">6 days</option>
                    <option value="(3600*24*7)" selected="selected">7 days</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Storage Multipler:</span></td>
            <td width="140"><input type="text" name="storage_multiplier" id="storage_multiplier" value="1"></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Tourn Threshold:</span></td>
            <td width="140"><input type="text" name="ts_threshold" id="ts_threshold" value="20"></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Great Workshop:</span></td>
            <td>
                <select name="great_wks">
                    <option value="true">true</option>
                    <option value="false" selected="selected">false</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">ww:</span></td>
            <td>
                <select name="ww">
                    <option value="true">true</option>
                    <option value="false" selected="selected">false</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Show Natars in Statistics:</span></td>
            <td>
                <select name="show_natars">
                    <option value="true">true</option>
                    <option value="false" selected="selected">false</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Peace system:</span></td>
            <td>
                <select name="peace">
                    <option value="0" selected="selected">None</option>
                    <option value="1">Normal</option>
                    <option value="2">Christmas</option>
                    <option value="3">New Year</option>
                    <option value="4">Easter</option>
                </select>
            </td>
        </tr>
    </table>
    </p>
    <p>
        <span class="f10 c">NEW MECHANICS AND FUNCTIONS RELATED</span>
    <table>
        <tr>
            <td><span class="f9 c6">Display oasis in profile:</span></td>
            <td>
                <select name="new_functions_oasis">
                    <option value="true">true</option>
                    <option value="false" selected="selected">false</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Alliance invitation message:</span></td>
            <td>
                <select name="new_functions_alliance_invitation">
                    <option value="true">true</option>
                    <option value="false" selected="selected">false</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">New Alliance & Embassy Mechanics:</span></td>
            <td>
                <select name="new_functions_embassy_mechanics">
                    <option value="true">true</option>
                    <option value="false" selected="selected">false</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">New forum post message:</span></td>
            <td>
                <select name="new_functions_forum_post_message">
                    <option value="true">true</option>
                    <option value="false" selected="selected">false</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Tribes images in profile:</span></td>
            <td>
                <select name="new_functions_tribe_images">
                    <option value="true">true</option>
                    <option value="false" selected="selected">false</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">MHs images in profile:</span></td>
            <td>
                <select name="new_functions_mhs_images">
                    <option value="true">true</option>
                    <option value="false" selected="selected">false</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Display artifact in profile:</span></td>
            <td>
                <select name="new_functions_display_artifact">
                    <option value="true">true</option>
                    <option value="false" selected="selected">false</option>
                </select>
            </td>
        </tr>
		<tr>
            <td><span class="f9 c6">Display wonder in profile:</span></td>
            <td>
                <select name="new_functions_display_wonder">
                    <option value="true">true</option>
                    <option value="false" selected="selected">false</option>
                </select>
            </td>
        </tr>
		<tr>
            <td><span class="f9 c6">Vacation Mode:</span></td>
            <td>
                <select name="new_functions_vacation">
                    <option value="true">true</option>
                    <option value="false" selected="selected">false</option>
                </select>
            </td>
        </tr>
		<tr>
            <td><span class="f9 c6">Catapult targets:</span></td>
            <td>
                <select name="new_functions_display_catapult_target">
                    <option value="true">true</option>
                    <option value="false" selected="selected">false</option>
                </select>
            </td>
        </tr>
		<tr>
            <td><span class="f9 c6">Manual on Nature and Natars:</span></td>
            <td>
                <select name="new_functions_manual_naturenatars">
                    <option value="true">true</option>
                    <option value="false" selected="selected">false</option>
                </select>
            </td>
        </tr>
		<tr>
            <td><span class="f9 c6">Direct links placement:</span></td>
            <td>
                <select name="new_functions_display_links">
                    <option value="true">true</option>
                    <option value="false" selected="selected">false</option>
                </select>
            </td>
        </tr>
		<tr>
            <td><span class="f9 c6">Medal Veteran Player:</span></td>
            <td>
                <select name="new_functions_medal_3year">
                    <option value="true">true</option>
                    <option value="false" selected="selected">false</option>
                </select>
            </td>
        </tr>
		<tr>
            <td><span class="f9 c6">Medal Veteran Player 5a:</span></td>
            <td>
                <select name="new_functions_medal_5year">
                    <option value="true">true</option>
                    <option value="false" selected="selected">false</option>
                </select>
            </td>
        </tr>
		<tr>
            <td><span class="f9 c6">Medal Veteran Player 10a:</span></td>
            <td>
                <select name="new_functions_medal_10year">
                    <option value="true">true</option>
                    <option value="false" selected="selected">false</option>
                </select>
            </td>
        </tr>
    </table>
    </p>
    <p>
        <span class="f10 c">SQL RELATED</span>
    <table>
        <tr>
            <td><span class="f9 c6">Hostname:</span></td>
            <td><input name="sserver" type="text" id="sserver" value="localhost"></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Port:</span></td>
            <td><input name="sport" type="text" id="sport" value="3306"></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Username:</span></td>
            <td><input name="suser" type="text" id="suser" value=""></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Password:</span></td>
            <td><input type="password" name="spass" id="spass"></td>
        </tr>
        <tr>
            <td><span class="f9 c6">DB name:</span></td>
            <td><input type="text" name="sdb" id="sdb"></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Prefix:</span></td>
            <td><input type="text" name="prefix" id="prefix" value="s1_" size="5"></td>
        </tr>
        <td><span class="f9 c6">Type:</span></td>
        <td>
            <select name="connectt">
                <option value="0" disabled="disabled">MYSQL (deprecated, removed in PHP 7)</option>
                <option value="1" selected="selected">MYSQLi</option>
            </select>
        </td>
        </tr>
    </table>
    </p>
    <!-- <RIGHT BOX - GPACK RELATED>
        <span><center><strong>GPACK RELATED</strong></center></span><br />


        <span class="f9 c6 c2">GPack:</span><span class="c3"><select name="gpack">
          <option value="false" selected="selected">No</option>
          <option value="true" disabled="disabled">Yes</option></select></span><br /><br />
        <span class="f9 c6 c2">GPack Design:</span><span class="c3"><select name="gp_locate">
          <option value="gpack/travian_default/" selected="selected">Travian Default
          <option value="gpack/travianx_v1/">TravianX v1 by Dzoki</option></select></span><br /><br />

        -->
    <!-- </RIGHT BOX - GPACK RELATED> -->
    <p>
        <span class="f10 c">PLUS GOLD PACKAGES</span>
    <table>
        <tr>
            <td><span class="f9 c6">Your PayPal E-Mail Address:</span>
            <br />(must be either <b>Business</b> or <b>Premier</b> account)</td>
            <td><input type="text" name="paypal-email" id="paypal-email" value="@"></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><span class="f9 c6">Payment Currency:</span>
            <br />(your PayPal account must be able to receive this currency)</td>
            <td><input type="text" name="paypal-currency" id="paypal-currency" value="EUR"></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><span class="f9 c6">Package "A" Amount of Gold:</span></td>
            <td><input type="text" name="plus-a-gold" id="plus-a-gold" value="60"></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Package "A" Price:</span></td>
            <td><input type="text" name="plus-a-price" id="plus-a-price" value="1,99"></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><span class="f9 c6">Package "B" Amount of Gold:</span></td>
            <td><input type="text" name="plus-b-gold" id="plus-b-gold" value="120"></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Package "B" Price:</span></td>
            <td><input type="text" name="plus-b-price" id="plus-b-price" value="4,99"></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><span class="f9 c6">Package "C" Amount of Gold:</span></td>
            <td><input type="text" name="plus-c-gold" id="plus-c-gold" value="360"></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Package "C" Price:</span></td>
            <td><input type="text" name="plus-c-price" id="plus-c-price" value="9,99"></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><span class="f9 c6">Package "D" Amount of Gold:</span></td>
            <td><input type="text" name="plus-d-gold" id="plus-d-gold" value="1000"></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Package "D" Price:</span></td>
            <td><input type="text" name="plus-d-price" id="plus-d-price" value="19,99"></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><span class="f9 c6">Package "E" Amount of Gold:</span></td>
            <td><input type="text" name="plus-e-gold" id="plus-e-gold" value="2000"></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Package "E" Price:</span></td>
            <td><input type="text" name="plus-e-price" id="plus-e-price" value="49,99"></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><span class="f9 c6">Plus account length:</span></td>
            <td>
                <select name="plus_time">
                    <option value="(3600*12)">12 hours</option>
                    <option value="(3600*24)">1 day</option>
                    <option value="(3600*24*2)">2 days</option>
                    <option value="(3600*24*3)">3 days</option>
                    <option value="(3600*24*4)">4 days</option>
                    <option value="(3600*24*5)">5 days</option>
                    <option value="(3600*24*6)">6 days</option>
                    <option value="(3600*24*7)" selected="selected">7 days</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">+25% production length:</span></td>
            <td>
                <select name="plus_production">
                    <option value="(3600*12)">12 hours</option>
                    <option value="(3600*24)">1 day</option>
                    <option value="(3600*24*2)">2 days</option>
                    <option value="(3600*24*3)">3 days</option>
                    <option value="(3600*24*4)">4 days</option>
                    <option value="(3600*24*5)">5 days</option>
                    <option value="(3600*24*6)">6 days</option>
                    <option value="(3600*24*7)" selected="selected">7 days</option>
                </select>
            </td>
        </tr>
    </table>
    </p>
    <p>
        <span class="f10 c">NEWSBOX OPTIONS</span>
    <table>
        <tr>
            <td><span class="f9 c6">Newsbox 1:</span></td>
            <td>
                <select name="box1">
                    <option value="true">Enabled</option>
                    <option value="false" selected="selected">Disabled</option>
                </select>
            </td>
        </tr>
        <td><span class="f9 c6">Newsbox 2:</span></td>
        <td>
            <select name="box2">
                <option value="true">Enabled</option>
                <option value="false" selected="selected">Disabled</option>
            </select>
        </td>
        </tr>
        <td><span class="f9 c6">Newsbox 3:</span></td>
        <td>
            <select name="box3">
                <option value="true">Enabled</option>
                <option value="false" selected="selected">Disabled</option>
            </select>
        </td>
        </tr>
    </table>
    </p>
    <p>
        <span class="f10 c">LOG RELATED (You should disable them)</span>
    <table>
        <tr>
            <td><span class="f9 c6">Log Building:</span></td>
            <td>
                <select name="log_build">
                    <option value="true">Yes</option>
                    <option value="false" selected="selected">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Log Tech:</span></td>
            <td>
                <select name="log_tech">
                    <option value="true">Yes</option>
                    <option value="false" selected="selected">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Log Login:</span></td>
            <td>
                <select name="log_login">
                    <option value="true">Yes</option>
                    <option value="false" selected="selected">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Log Gold:</span></td>
            <td>
                <select name="log_gold_fin">
                    <option value="true">Yes</option>
                    <option value="false" selected="selected">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Log Admin:</span></td>
            <td>
                <select name="log_admin">
                    <option value="true">Yes</option>
                    <option value="false" selected="selected">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Log War:</span></td>
            <td>
                <select name="log_war">
                    <option value="true">Yes</option>
                    <option value="false" selected="selected">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Log Market:</span></td>
            <td>
                <select name="log_market">
                    <option value="true">Yes</option>
                    <option value="false" selected="selected">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Log Illegal:</span></td>
            <td>
                <select name="log_illegal">
                    <option value="true">Yes</option>
                    <option value="false" selected="selected">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Log :</span></td>
            <td>
                <select name="">
                    <option value="true">Yes</option>
                    <option value="false" selected="selected">No</option>
                </select>
            </td>
        </tr>
    </table>
    </p>
    <p>
        <span class="f10 c">EXTRA OPTIONS</span>
    <table>
        <tr>
            <td><span class="f9 c6">Quest:</span></td>
            <td>
                <select name="quest">
                    <option value="true" selected="selected">Yes</option>
                    <option value="false">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Quest Type:</span></td>
            <td>
                <select name="qtype">
                    <option value="25" selected="selected">Official Travian</option>
                    <option value="37">TravianZ Extended</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Activate:</span></td>
            <td>
                <select name="activate">
                    <option value="true">Yes</option>
                    <option value="false" selected="selected">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Limit Mailbox:</span></td>
            <td>
                <select name="limit_mailbox">
                    <option value="true">Yes</option>
                    <option value="false" selected="selected">No</option>
                </select>
                (NOT DONE)
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Max mails:</span></td>
            <td><input type="text" name="max_mails" id="max_mails" value="30" size="4"> (NOT DONE)</td>
        </tr>
        <tr>
            <td><span class="f9 c6">Demolish - lvl required:</span></td>
            <td>
                <select name="demolish">
                    <option value="5">5</option>
                    <option value="10" selected="selected">10 - Default</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Village Expand:</span></td>
            <td>
                <select name="village_expand">
                    <option value="1" selected="selected">Slow</option>
                    <option value="0">Fast</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">Error Reporting:</span></td>
            <td>
                <select name="error">
                    <option value="error_reporting (E_ALL ^ E_NOTICE ^ E_DEPRECATED);" selected="selected">Yes</option>
                    <option value="error_reporting (0);">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><span class="f9 c6">T4 is Coming screen:</span></td>
            <td>
                <select name="t4_coming">
                    <option value="true">Yes</option>
                    <option value="false" selected="selected">No</option>
                </select>
            </td>
        </tr>
    </table>
    </p>
    <br />
    <span class="f10 c">Server Start Settings</span>
    <table>
        <tr>
            <td><span class="f9 c6">Start Date:</span></td>
            <td width="140"><input type="text" name="start_date" id="start_date" value="<?php echo date('d.m.Y'); ?>"></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Start Time:</span></td>
            <td width="140"><input type="text" name="start_time" id="start_time" value="<?php echo date('H:i'); ?>"></td>
        </tr>
    </table>
    <center>
        <input type="submit" name="Submit" id="Submit" value="Submit">
        <input type="hidden" name="subconst" value="1">
    </center>
</form>

</div>
