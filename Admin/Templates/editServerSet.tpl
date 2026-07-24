<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : editServerSet.tpl                                         ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : ronix (Original)                                          ##
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
if (!isset($_SESSION)) {
 session_start();
}
if($_SESSION['access'] < 9) die(ACCESS_DENIED_ADMIN);
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
.config-table input.fm, .config-table select{padding:4px 6px;border:1px solid #cbd5e1;border-radius:4px;font-size:13px}
.tooltip{cursor:help;margin-left:4px}
.config-actions{display:flex;justify-content:space-between;align-items:center;margin-top:12px}
.btn-back,.btn-save{display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border-radius:6px;font-weight:600;font-size:13px;text-decoration:none;cursor:pointer;transition:.15s;border:1px solid transparent}
.btn-back{background:#f1f5f9;color:#0f172a;border-color:#e5e7eb}
.btn-back:hover{background:#e2e8f0}
.btn-save{background:#0f172a;color:#fff;box-shadow:0 1px 2px rgba(0,0,0,.08)}
.btn-save:hover{background:#1e293b;transform:translateY(-1px)}
.btn-save:active{transform:translateY(0)}
.btn-save svg{width:14px;height:14px}
</style>

<script LANGUAGE="JavaScript">
function refresh(tz) {
	document.getElementById('tz').innerHTML=tz;
}
</script>

<div class="config-wrap">
    <div class="config-title"><?php echo SERV_CONFIG ?></div>
    
    <form action="../GameEngine/Admin/Mods/editServerSet.php" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">
        
        <div class="config-card">
            <div class="config-head">
                <span><?php echo EDIT_SERV_SETT ?></span>
            </div>
            <table class="config-table">
                <tbody>
                <tr>
                    <td class="b"><?php echo CONF_SERV_NAME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NAME_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="servername" value="<?php echo SERVER_NAME;?>" style="width: 70%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_STARTED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_STARTED_TOOLTIP ?></span></em></td>
                    <td><?php echo "Date:".START_DATE." Time:".START_TIME;?></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_TIMEZONE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TIMEZONE_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="tzone" onChange="refresh(this.value)">
                            <option value="Africa/Dakar" <?php if (TIMEZONE=="Africa/Dakar") echo "selected";?>>Africa</option>
                            <option value="America/New_York" <?php if (TIMEZONE=="America/New_York") echo "selected";?>>America</option>
                            <option value="Antarctica/Casey" <?php if (TIMEZONE=="Antarctica/Casey") echo "selected";?>>Antarctica</option>
                            <option value="Arctic/Longyearbyen" <?php if (TIMEZONE=="Arctic/Longyearbyen") echo "selected";?>>Arctic</option>
                            <option value="Asia/Kuala_Lumpur" <?php if (TIMEZONE=="Asia/Kuala_Lumpur") echo "selected";?>>Asia</option>
                            <option value="Atlantic/Azores" <?php if (TIMEZONE=="Atlantic/Azores") echo "selected";?>>Atlantic</option>
                            <option value="Australia/Melbourne" <?php if (TIMEZONE=="Australia/Melbourne") echo "selected";?>>Australia</option>
                            <option value="Europe/Bucharest" <?php if (TIMEZONE=="Europe/Bucharest") echo "selected";?>>Europe (Bucharest)</option>
                            <option value="Europe/London" <?php if (TIMEZONE=="Europe/London") echo "selected";?>>Europe (London)</option>
                            <option value="Europe/Zurich" <?php if (TIMEZONE=="Europe/Zurich") echo "selected";?>>Europe (Switzerland)</option>
                            <option value="Indian/Maldives" <?php if (TIMEZONE=="Indian/Maldives") echo "selected";?>>Indian</option>
                            <option value="Pacific/Fiji" <?php if (TIMEZONE=="Pacific/Fiji") echo "selected";?>>Pacific</option>
                        </select>
                        <span id="tz" name="tz" style="margin-left:8px;color:#64748b;"><?php echo TIMEZONE;?></span>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_LANG ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_LANG_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="lang">
                            <option value="en" <?php if ((defined('SERVER_LANG') ? SERVER_LANG : LANG)=="en") echo "selected";?>>English</option>
                            <option value="fr" <?php if ((defined('SERVER_LANG') ? SERVER_LANG : LANG)=="fr") echo "selected";?>>French</option>
                            <option value="es" <?php if ((defined('SERVER_LANG') ? SERVER_LANG : LANG)=="it") echo "selected";?>>Italian</option>
                            <option value="ro" <?php if ((defined('SERVER_LANG') ? SERVER_LANG : LANG)=="ro") echo "selected";?>>Romanian</option>
                            <option value="zh" <?php if ((defined('SERVER_LANG') ? SERVER_LANG : LANG)=="zh") echo "selected";?>>Chinese</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_SERVSPEED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_SERVSPEED_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="speed" value="<?php echo SPEED;?>" style="width: 20%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_TROOPSPEED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TROOPSPEED_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="incspeed" value="<?php echo INCREASE_SPEED;?>" style="width: 20%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_EVASIONSPEED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_EVASIONSPEED_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="evasionspeed" value="<?php echo EVASION_SPEED;?>" style="width: 20%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_STORMULTIPLER ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_STORMULTIPLER_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="storage_multiplier" value="<?php echo STORAGE_MULTIPLIER;?>" style="width: 20%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_TRADCAPACITY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TRADCAPACITY_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="tradercap" value="<?php echo TRADER_CAPACITY;?>" style="width: 20%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_CRANCAPACITY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_CRANCAPACITY_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="crannycap" value="<?php echo CRANNY_CAPACITY;?>" style="width: 20%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_TRAPCAPACITY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TRAPCAPACITY_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="trappercap" value="<?php echo TRAPPER_CAPACITY;?>" style="width: 20%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_NATUNITSMULTIPLIER ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATUNITSMULTIPLIER_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="natars_units" value="<?php echo NATARS_UNITS;?>" style="width: 20%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_NATARS_SPAWN_TIME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATARS_SPAWN_TIME_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="natars_spawn_time" value="<?php echo NATARS_SPAWN_TIME;?>" style="width: 20%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_NATARS_WW_SPAWN_TIME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATARS_WW_SPAWN_TIME_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="natars_ww_spawn_time" value="<?php echo NATARS_WW_SPAWN_TIME;?>" style="width: 20%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="natars_ww_building_plan_spawn_time" value="<?php echo NATARS_WW_BUILDING_PLAN_SPAWN_TIME;?>" style="width: 20%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_MAPSIZE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_MAPSIZE_TOOLTIP ?></span></em></td>
                    <td><?php echo WORLD_MAX;?>x<?php echo WORLD_MAX;?></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_VILLEXPSPEED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_VILLEXPSPEED_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="village_expand">
                            <option value="1" <?php if (CP=="1") echo "selected";?>>Slow</option>
                            <option value="0" <?php if (CP=="0") echo "selected";?>>Fast</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_BEGINPROTECT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_BEGINPROTECT_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="beginner">
                            <option value="7200" <?php if (PROTECTION=="7200") echo "selected";?>>2 hours</option>
                            <option value="10800" <?php if (PROTECTION=="10800") echo "selected";?>>3 hours</option>
                            <option value="18000" <?php if (PROTECTION=="18000") echo "selected";?>>5 hours</option>
                            <option value="28800" <?php if (PROTECTION=="28800") echo "selected";?>>8 hours</option>
                            <option value="36000" <?php if (PROTECTION=="36000") echo "selected";?>>10 hours</option>
                            <option value="43200" <?php if (PROTECTION=="43200") echo "selected";?>>12 hours</option>
                            <option value="86400" <?php if (PROTECTION=="86400") echo "selected";?>>24 hours (1 day)</option>
                            <option value="172800" <?php if (PROTECTION=="172800") echo "selected";?>>48 hours (2 days)</option>
                            <option value="259200" <?php if (PROTECTION=="259200") echo "selected";?>>72 hours (3 days)</option>
                            <option value="432000" <?php if (PROTECTION=="432000") echo "selected";?>>120 hours (5 days)</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_REGOPEN ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_REGOPEN_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="reg_open">
                            <option value="True" <?php if(REG_OPEN==true) echo "selected";?>>True</option>
                            <option value="False" <?php if(REG_OPEN==false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_ACTIVMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_ACTIVMAIL_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="activate">
                            <option value="true" <?php if (AUTH_EMAIL==true) echo "selected";?>>Yes</option>
                            <option value="false" <?php if (AUTH_EMAIL==false) echo "selected";?>>No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_QUEST ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_QUEST_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="quest">
                            <option value="true" <?php if(QUEST == true) echo "selected";?>>Yes</option>
                            <option value="false" <?php if(QUEST == false) echo "selected";?>>No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_QTYPE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_QTYPE_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="qtype">
                            <option value="25" <?php if(QTYPE == 25) echo "selected";?>>Travian Official</option>
                            <option value="37" <?php if(QTYPE == 37) echo "selected";?>>TravianZ Extended</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_DLR ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_DLR_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="demolish">
                            <option value="5" <?php if(DEMOLISH_LEVEL_REQ == "5") echo "selected";?>>5</option>
                            <option value="10" <?php if(DEMOLISH_LEVEL_REQ == "10") echo "selected";?>>10 - Default</option>
                            <option value="15" <?php if(DEMOLISH_LEVEL_REQ == "15") echo "selected";?>>15</option>
                            <option value="20" <?php if(DEMOLISH_LEVEL_REQ == "20") echo "selected";?>>20</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_WWSTATS ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_WWSTATS_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="ww">
                            <option value="True" <?php if(WW == true) echo "selected";?>>True</option>
                            <option value="False" <?php if(WW == false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_NTRTIME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NTRTIME_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="nature_regtime">
                            <option value="28800" <?php if(NATURE_REGTIME == 28800) echo "selected";?>>8 hours</option>
                            <option value="36000" <?php if(NATURE_REGTIME == 36000) echo "selected";?>>10 hours</option>
                            <option value="43200" <?php if(NATURE_REGTIME == 43200) echo "selected";?>>12 hours</option>
                            <option value="57600" <?php if(NATURE_REGTIME == 57600) echo "selected";?>>16 hours</option>
                            <option value="72000" <?php if(NATURE_REGTIME == 72000) echo "selected";?>>20 hours</option>
                            <option value="86400" <?php if(NATURE_REGTIME == 86400) echo "selected";?>>24 hours (1 day)</option>
                            <option value="172800" <?php if(NATURE_REGTIME == 172800) echo "selected";?>>48 hours (2 days)</option>
                            <option value="259200" <?php if(NATURE_REGTIME == 259200) echo "selected";?>>72 hours (3 days)</option>
                            <option value="432000" <?php if(NATURE_REGTIME == 432000) echo "selected";?>>120 hours (5 days)</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_OASIS_WOOD_PROD_MULT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_OASIS_WOOD_PROD_MULT_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="oasis_wood_multiplier" value="<?php echo OASIS_WOOD_MULTIPLIER;?>" style="width: 20%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_OASIS_CLAY_PROD_MULT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_OASIS_CLAY_PROD_MULT_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="oasis_clay_multiplier" value="<?php echo OASIS_CLAY_MULTIPLIER;?>" style="width: 20%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_OASIS_IRON_PROD_MULT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_OASIS_IRON_PROD_MULT_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="oasis_iron_multiplier" value="<?php echo OASIS_IRON_MULTIPLIER;?>" style="width: 20%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_OASIS_CROP_PROD_MULT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_OASIS_CROP_PROD_MULT_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="oasis_crop_multiplier" value="<?php echo OASIS_CROP_MULTIPLIER;?>" style="width: 20%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_MEDALINTERVAL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_MEDALINTERVAL_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="medalinterval">
                            <option value="0" <?php if(MEDALINTERVAL==0) echo "selected";?>>none</option>
                            <option value="(3600*24)" <?php if(MEDALINTERVAL==86400) echo "selected";?>>1 day</option>
                            <option value="(3600*24*2)" <?php if(MEDALINTERVAL==172800) echo "selected";?>>2 days</option>
                            <option value="(3600*24*3)" <?php if(MEDALINTERVAL==259200) echo "selected";?>>3 days</option>
                            <option value="(3600*24*4)" <?php if(MEDALINTERVAL==345600) echo "selected";?>>4 days</option>
                            <option value="(3600*24*5)" <?php if(MEDALINTERVAL==432000) echo "selected";?>>5 days</option>
                            <option value="(3600*24*6)" <?php if(MEDALINTERVAL==518400) echo "selected";?>>6 days</option>
                            <option value="(3600*24*7)" <?php if(MEDALINTERVAL==604800) echo "selected";?>>7 days</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_TOURNTHRES ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TOURNTHRES_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="ts_threshold" value="<?php echo TS_THRESHOLD;?>" style="width: 20%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_GWORKSHOP ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_GWORKSHOP_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="great_wks">
                            <option value="True" <?php if(GREAT_WKS==true) echo "selected";?>>True</option>
                            <option value="False" <?php if(GREAT_WKS==false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_NATARSTAT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATARSTAT_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="show_natars">
                            <option value="True" <?php if(SHOW_NATARS==true) echo "selected";?>>True</option>
                            <option value="False" <?php if(SHOW_NATARS==false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_PEACESYST ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_PEACESYST_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="peace">
                            <option value="0" <?php if(PEACE==0) echo "selected";?>>None</option>
                            <option value="1" <?php if(PEACE==1) echo "selected";?>>Normal</option>
                            <option value="2" <?php if(PEACE==2) echo "selected";?>>Christmas</option>
                            <option value="3" <?php if(PEACE==3) echo "selected";?>>New Year</option>
                            <option value="4" <?php if(PEACE==4) echo "selected";?>>Easter</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_GRAPHICPACK ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_GRAPHICPACK_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="gpack">
                            <option value="true" <?php if(GP_ENABLE==true) echo "selected";?>>Yes</option>
                            <option value="false" <?php if(GP_ENABLE==false) echo "selected";?>>No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_SERV_ERRORREPORT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_ERRORREPORT_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="error">
                            <option value="error_reporting (E_ALL ^ E_NOTICE);" <?php if(ERROR_REPORT=="error_reporting (E_ALL ^ E_NOTICE);") echo "selected";?>>Yes</option>
                            <option value="error_reporting (0);" <?php if(ERROR_REPORT=="error_reporting (0);") echo "selected";?>>No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b">Hero base regeneration <em class="tooltip">?<span class="classic">Hit points the hero recovers per day on top of the points invested in the regeneration attribute and any equipped items. Without it, a hero with no regeneration points would never heal and would eventually die on adventures. Scales with server speed. 0 disables it.</span></em></td>
                    <td>
                        <input type="number" name="hero_base_regen" min="0" max="100" style="width:90px"
                               value="<?php echo defined('HERO_BASE_REGEN') ? (int) HERO_BASE_REGEN : 10; ?>"> HP / day
                    </td>
                </tr>
                <tr>
                    <td class="b">Hero exchange rates <em class="tooltip">?<span class="classic">Exchange office in the auction house. Keep the second value higher than the first, otherwise players could trade back and forth to create gold out of nothing.</span></em></td>
                    <td>
                        1 gold &rarr;
                        <input type="number" name="hero_silver_per_gold" min="1" max="10000" style="width:80px"
                               value="<?php echo defined('HERO_SILVER_PER_GOLD') ? (int) HERO_SILVER_PER_GOLD : 10; ?>"> silver
                        &nbsp;|&nbsp;
                        <input type="number" name="hero_silver_to_gold" min="1" max="10000" style="width:80px"
                               value="<?php echo defined('HERO_SILVER_TO_GOLD') ? (int) HERO_SILVER_TO_GOLD : 25; ?>"> silver &rarr; 1 gold
                    </td>
                </tr>
                <tr>
                    <td class="b">Hero resource production <em class="tooltip">?<span class="classic">Hourly resources per point invested in the hero's Resources attribute. The first value applies when the player spreads the bonus over all four resources, the second when it is concentrated on a single one. Both scale with server speed.</span></em></td>
                    <td>
                        <input type="number" name="hero_res_all" min="0" max="10000" style="width:80px"
                               value="<?php echo defined('HERO_RES_PER_POINT_ALL') ? (int) HERO_RES_PER_POINT_ALL : 3; ?>"> of each
                        &nbsp;|&nbsp;
                        <input type="number" name="hero_res_one" min="0" max="10000" style="width:80px"
                               value="<?php echo defined('HERO_RES_PER_POINT_ONE') ? (int) HERO_RES_PER_POINT_ONE : 10; ?>"> of one type
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
	<div class="config-actions">
		<a href="../Admin/admin.php?p=config" class="btn-back">
        ‹ <?php echo EDIT_BACK ?>
		</a>
    <button type="submit" class="btn-save">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
            <polyline points="17 21 17 13 7 13 7 21"/>
        </svg>
        SAVE
    </button>
</div>
    </form>
</div>