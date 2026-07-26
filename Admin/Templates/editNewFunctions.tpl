<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : editNewFunctions.tpl                                      ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : velhbxtyrj (Original)                                     ##
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

<div class="config-wrap">
    <div class="config-title"><?php echo SERV_CONFIG ?></div>
    
    <form action="../GameEngine/Admin/Mods/editNewFunctions.php" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">
        
        <div class="config-card">
            <div class="config-head">
                <span><?php echo ADM_EDIT_NEW_MECHANICS_AND_FUNCTIONS; ?></span>
            </div>
            <table class="config-table">
                <tbody>
                <tr>
                    <td class="b"><?php echo ADM_DISPLAY_OASIS_IN_PROFILE; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_THE_DISPLAY_OF_OASES_OF_EACH; ?></span></em></td>
                    <td>
                        <select name="new_functions_oasis">
                            <option value="True" <?php if(NEW_FUNCTIONS_OASIS == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(NEW_FUNCTIONS_OASIS == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_ALLIANCE_INVITATION_MESSAGE; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_SENDING_AN_IN_GAME_MESSAGE_TO; ?></span></em></td>
                    <td>
                        <select name="new_functions_alliance_invitation">
                            <option value="True" <?php if(NEW_FUNCTIONS_ALLIANCE_INVITATION == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(NEW_FUNCTIONS_ALLIANCE_INVITATION == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_NEW_ALLIANCE_EMBASSY_MECHANICS; ?><em class="tooltip">?<span class="classic"><?php echo ADM_FOR_THIS_SETTING_YOU_CAN_FIND_MORE_INFORMATI; ?><a href="https://github.com/Shadowss/TravianZ/wiki/New-Alliance-&-Embassy-Mechanics" target="_blank">https://github.com</a></span></em></td>
                    <td>
                        <select name="new_functions_embassy_mechanics">
                            <option value="True" <?php if(NEW_FUNCTIONS_EMBASSY_MECHANICS == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(NEW_FUNCTIONS_EMBASSY_MECHANICS == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_NEW_FORUM_POST_MESSAGE; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_IF_A_PLAYER_LEAVES_AT_LEAST_O; ?></span></em></td>
                    <td>
                        <select name="new_functions_forum_post_message">
                            <option value="True" <?php if(NEW_FUNCTIONS_FORUM_POST_MESSAGE == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(NEW_FUNCTIONS_FORUM_POST_MESSAGE == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_TRIBES_IMAGES_IN_PROFILE; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_DISPLAYING_IMAGES_OF_TRIBES_W; ?></span></em></td>
                    <td>
                        <select name="new_functions_tribe_images">
                            <option value="True" <?php if(NEW_FUNCTIONS_TRIBE_IMAGES == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(NEW_FUNCTIONS_TRIBE_IMAGES == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_MHS_IMAGES_IN_PROFILE; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_DISPLAYING_IMAGES_OF_MULTIHUN_2; ?></span></em></td>
                    <td>
                        <select name="new_functions_mhs_images">
                            <option value="True" <?php if(NEW_FUNCTIONS_MHS_IMAGES == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(NEW_FUNCTIONS_MHS_IMAGES == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_DISPLAY_ARTIFACT_IN_PROFILE; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_THE_DISPLAY_OF_THE_ARTIFACT_I; ?></span></em></td>
                    <td>
                        <select name="new_functions_display_artifact">
                            <option value="True" <?php if(NEW_FUNCTIONS_DISPLAY_ARTIFACT == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(NEW_FUNCTIONS_DISPLAY_ARTIFACT == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_DISPLAY_WOW_IN_PROFILE; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_THE_DISPLAY_OF_THE_WONDER_IN; ?></span></em></td>
                    <td>
                        <select name="new_functions_display_wonder">
                            <option value="True" <?php if(NEW_FUNCTIONS_DISPLAY_WONDER == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(NEW_FUNCTIONS_DISPLAY_WONDER == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_VACATION_MODE; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_VACATION_MODE_WILL_BE_DISPLAY; ?></span></em></td>
                    <td>
                        <select name="new_functions_vacation">
                            <option value="True" <?php if(NEW_FUNCTIONS_VACATION == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(NEW_FUNCTIONS_VACATION == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_CATAPULT_TARGETS; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_THE_DISPLAY_OF_THE_TARGETS_OF; ?></span></em></td>
                    <td>
                        <select name="new_functions_display_catapult_target">
                            <option value="True" <?php if(NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_MANUAL_ON_NATURE_AND_NATARS; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_DISPLAYING_INFORMATION_IN_THE; ?></span></em></td>
                    <td>
                        <select name="new_functions_manual_naturenatars">
                            <option value="True" <?php if(NEW_FUNCTIONS_MANUAL_NATURENATARS == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(NEW_FUNCTIONS_MANUAL_NATURENATARS == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_DIRECT_LINKS_PLACEMENT; ?><em class="tooltip">?<span class="classic"><?php echo ADM_IF_ENABLED_THEN_THE_DIRECT_LINKS_WILL_BE_PLA; ?></span></em></td>
                    <td>
                        <select name="new_functions_display_links">
                            <option value="True" <?php if(NEW_FUNCTIONS_DISPLAY_LINKS == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(NEW_FUNCTIONS_DISPLAY_LINKS == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_MEDAL_VETERAN_PLAYER; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_MEDAL_ACHIEVED_FOR_PLAYING_3; ?></span></em></td>
                    <td>
                        <select name="new_functions_medal_3year">
                            <option value="True" <?php if(NEW_FUNCTIONS_MEDAL_3YEAR == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(NEW_FUNCTIONS_MEDAL_3YEAR == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_MEDAL_VETERAN_PLAYER_5A; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_MEDAL_ACHIEVED_FOR_PLAYING_5; ?></span></em></td>
                    <td>
                        <select name="new_functions_medal_5year">
                            <option value="True" <?php if(NEW_FUNCTIONS_MEDAL_5YEAR == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(NEW_FUNCTIONS_MEDAL_5YEAR == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_MEDAL_VETERAN_PLAYER_10A; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_MEDAL_ACHIEVED_FOR_PLAYING_10; ?></span></em></td>
                    <td>
                        <select name="new_functions_medal_10year">
                            <option value="True" <?php if(NEW_FUNCTIONS_MEDAL_10YEAR == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(NEW_FUNCTIONS_MEDAL_10YEAR == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_SPECIAL_MEDALS; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_SPECIAL_MEDALS_ARTIFACT_HERO; ?></span></em></td>
                    <td>
                        <select name="new_functions_special_medals_system">
                            <option value="True" <?php if(NEW_FUNCTIONS_SPECIAL_MEDALS_SYSTEM == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(NEW_FUNCTIONS_SPECIAL_MEDALS_SYSTEM == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_SERVER_MILESTONES; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_THE_SERVER_MILESTONES_WIDGET; ?></span></em>
                    <?php if (!defined('NEW_FUNCTIONS_MILESTONES')): ?><br><span style="color:#c0392b;font-size:11px;font-weight:normal;text-transform:none;"><?php echo ADM_NOT_PRESENT_IN_CONFIG_PHP_YET_SAVING_THIS_FO; ?></span><?php endif; ?>
                    </td>
                    <td>
                        <select name="new_functions_milestones">
                            <option value="True" <?php if(defined('NEW_FUNCTIONS_MILESTONES') && NEW_FUNCTIONS_MILESTONES == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(!defined('NEW_FUNCTIONS_MILESTONES') || NEW_FUNCTIONS_MILESTONES == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
				 <tr>
                    <td class="b"><?php echo ADM_SERVER_MEDAL_RESET_TIMER; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_THE_SERVER_MEDAL_RESET_TIMER; ?></span></em>
                    <?php if (!defined('NEW_FUNCTIONS_MEDAL_RESET')): ?><br><span style="color:#c0392b;font-size:11px;font-weight:normal;text-transform:none;"><?php echo ADM_NOT_PRESENT_IN_CONFIG_PHP_YET_SAVING_THIS_FO; ?></span><?php endif; ?>
                    </td>
                    <td>
                        <select name="new_functions_medal_reset">
                            <option value="True" <?php if(defined('NEW_FUNCTIONS_MEDAL_RESET') && NEW_FUNCTIONS_MEDAL_RESET == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(!defined('NEW_FUNCTIONS_MEDAL_RESET') || NEW_FUNCTIONS_MEDAL_RESET == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td class="b"><?php echo ADM_T4_HERO_ITEMS_ADVENTURES_AUCTION; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_THE_T4_HERO_ITEMS_ADVENTURES; ?></span></em>
                    <?php if (!defined('NEW_FUNCTIONS_HERO_T4')): ?><br><span style="color:#c0392b;font-size:11px;font-weight:normal;text-transform:none;"><?php echo ADM_NOT_PRESENT_IN_CONFIG_PHP_YET_SAVING_THIS_FO; ?></span><?php endif; ?>
                    </td>
                    <td>
                        <select name="new_functions_hero_t4">
                            <option value="True" <?php if(defined('NEW_FUNCTIONS_HERO_T4') && NEW_FUNCTIONS_HERO_T4 == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(!defined('NEW_FUNCTIONS_HERO_T4') || NEW_FUNCTIONS_HERO_T4 == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_NEW_TRIBE_HUNS; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_TRIBE_HUNS; ?></span></em>
                    <?php if (!defined('NEW_FUNCTION_TRIBE_HUNS')): ?><br><span style="color:#c0392b;font-size:11px;font-weight:normal;text-transform:none;"><?php echo ADM_NOT_PRESENT_IN_CONFIG_PHP_YET_SAVING_THIS_FO; ?></span><?php endif; ?>
                    </td>
                    <td>
                        <select name="new_function_tribe_huns">
                            <option value="True" <?php if(defined('NEW_FUNCTION_TRIBE_HUNS') && NEW_FUNCTION_TRIBE_HUNS == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(!defined('NEW_FUNCTION_TRIBE_HUNS') || NEW_FUNCTION_TRIBE_HUNS == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_NEW_TRIBE_EGYPTIANS; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_TRIBE_EGYPTIANS; ?></span></em>
                    <?php if (!defined('NEW_FUNCTION_TRIBE_EGIPTEANS')): ?><br><span style="color:#c0392b;font-size:11px;font-weight:normal;text-transform:none;"><?php echo ADM_NOT_PRESENT_IN_CONFIG_PHP_YET_SAVING_THIS_FO; ?></span><?php endif; ?>
                    </td>
                    <td>
                        <select name="new_function_tribe_egipteans">
                            <option value="True" <?php if(defined('NEW_FUNCTION_TRIBE_EGIPTEANS') && NEW_FUNCTION_TRIBE_EGIPTEANS == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(!defined('NEW_FUNCTION_TRIBE_EGIPTEANS') || NEW_FUNCTION_TRIBE_EGIPTEANS == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_NEW_TRIBE_SPARTANS; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_TRIBE_SPARTANS; ?></span></em>
                    <?php if (!defined('NEW_FUNCTION_TRIBE_SPARTANS')): ?><br><span style="color:#c0392b;font-size:11px;font-weight:normal;text-transform:none;"><?php echo ADM_NOT_PRESENT_IN_CONFIG_PHP_YET_SAVING_THIS_FO; ?></span><?php endif; ?>
                    </td>
                    <td>
                        <select name="new_function_tribe_spartans">
                            <option value="True" <?php if(defined('NEW_FUNCTION_TRIBE_SPARTANS') && NEW_FUNCTION_TRIBE_SPARTANS == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(!defined('NEW_FUNCTION_TRIBE_SPARTANS') || NEW_FUNCTION_TRIBE_SPARTANS == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_NEW_TRIBE_VIKINGS; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_TRIBE_VIKINGS; ?></span></em>
                    <?php if (!defined('NEW_FUNCTION_TRIBE_VIKINGS')): ?><br><span style="color:#c0392b;font-size:11px;font-weight:normal;text-transform:none;"><?php echo ADM_NOT_PRESENT_IN_CONFIG_PHP_YET_SAVING_THIS_FO; ?></span><?php endif; ?>
                    </td>
                    <td>
                        <select name="new_function_tribe_vikings">
                            <option value="True" <?php if(defined('NEW_FUNCTION_TRIBE_VIKINGS') && NEW_FUNCTION_TRIBE_VIKINGS == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(!defined('NEW_FUNCTION_TRIBE_VIKINGS') || NEW_FUNCTION_TRIBE_VIKINGS == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td class="b"><?php echo ADM_REGISTRATION_BONUS_GOLD; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_A_ONE_TIME_GOLD_BONUS_GRANTED; ?></span></em>
                    <?php if (!defined('NEW_FUNCTION_REGISTRATION_GOLD')): ?><br><span style="color:#c0392b;font-size:11px;font-weight:normal;text-transform:none;"><?php echo ADM_NOT_PRESENT_IN_CONFIG_PHP_YET_SAVING_THIS_FO; ?></span><?php endif; ?>
                    </td>
                    <td>
                        <select name="new_function_registration_gold">
                            <option value="True" <?php if(defined('NEW_FUNCTION_REGISTRATION_GOLD') && NEW_FUNCTION_REGISTRATION_GOLD == true) echo "selected";?>><?php echo ADM_TRUE; ?></option>
                            <option value="False" <?php if(!defined('NEW_FUNCTION_REGISTRATION_GOLD') || NEW_FUNCTION_REGISTRATION_GOLD == false) echo "selected";?>><?php echo ADM_FALSE; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo ADM_REGISTRATION_BONUS_GOLD_AMOUNT; ?><em class="tooltip">?<span class="classic"><?php echo ADM_HOW_MUCH_GOLD_EACH_NEW_PLAYER_RECEIVES_WHEN_2; ?></span></em></td>
                    <td>
                        <input type="number" min="0" step="1" name="new_function_registration_gold_value" value="<?php echo (defined('NEW_FUNCTION_REGISTRATION_GOLD_VALUE') ? (int) NEW_FUNCTION_REGISTRATION_GOLD_VALUE : 200); ?>">
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
        </svg><?php echo ADM_SAVE; ?></button>
</div>
    </form>
</div>
