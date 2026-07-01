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
                <span>Edit New Mechanics and Functions</span>
            </div>
            <table class="config-table">
                <tbody>
                <tr>
                    <td class="b">Display oasis in profile <em class="tooltip">?<span class="classic">Enable (Disable) the display of oases of each village in the player profile</span></em></td>
                    <td>
                        <select name="new_functions_oasis">
                            <option value="True" <?php if(NEW_FUNCTIONS_OASIS == true) echo "selected";?>>True</option>
                            <option value="False" <?php if(NEW_FUNCTIONS_OASIS == false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b">Alliance invitation message <em class="tooltip">?<span class="classic">Enable (Disable) sending an in-game message to the player, if he was invited to the alliance</span></em></td>
                    <td>
                        <select name="new_functions_alliance_invitation">
                            <option value="True" <?php if(NEW_FUNCTIONS_ALLIANCE_INVITATION == true) echo "selected";?>>True</option>
                            <option value="False" <?php if(NEW_FUNCTIONS_ALLIANCE_INVITATION == false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b">New Alliance & Embassy Mechanics <em class="tooltip">?<span class="classic">For this setting, you can find more information on the link: <a href="https://github.com/Shadowss/TravianZ/wiki/New-Alliance-&-Embassy-Mechanics" target="_blank">https://github.com</a></span></em></td>
                    <td>
                        <select name="new_functions_embassy_mechanics">
                            <option value="True" <?php if(NEW_FUNCTIONS_EMBASSY_MECHANICS == true) echo "selected";?>>True</option>
                            <option value="False" <?php if(NEW_FUNCTIONS_EMBASSY_MECHANICS == false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b">New forum post message <em class="tooltip">?<span class="classic">Enable (Disable) if a player leaves at least one message in the thread on the forum, he will receive in-game messages about the fact that new messages have appeared in the same thread (i.e. is technically "subscribed to")</span></em></td>
                    <td>
                        <select name="new_functions_forum_post_message">
                            <option value="True" <?php if(NEW_FUNCTIONS_FORUM_POST_MESSAGE == true) echo "selected";?>>True</option>
                            <option value="False" <?php if(NEW_FUNCTIONS_FORUM_POST_MESSAGE == false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b">Tribes images in profile <em class="tooltip">?<span class="classic">Enable (Disable) displaying images of tribes with a description in the players profile</span></em></td>
                    <td>
                        <select name="new_functions_tribe_images">
                            <option value="True" <?php if(NEW_FUNCTIONS_TRIBE_IMAGES == true) echo "selected";?>>True</option>
                            <option value="False" <?php if(NEW_FUNCTIONS_TRIBE_IMAGES == false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b">MHs images in profile <em class="tooltip">?<span class="classic">Enable (Disable) displaying images of Multihunters with a description in the MHs profile</span></em></td>
                    <td>
                        <select name="new_functions_mhs_images">
                            <option value="True" <?php if(NEW_FUNCTIONS_MHS_IMAGES == true) echo "selected";?>>True</option>
                            <option value="False" <?php if(NEW_FUNCTIONS_MHS_IMAGES == false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b">Display artifact in profile <em class="tooltip">?<span class="classic">Enable (Disable) the display of the artifact in the player profile, opposite the corresponding village in which it is located</span></em></td>
                    <td>
                        <select name="new_functions_display_artifact">
                            <option value="True" <?php if(NEW_FUNCTIONS_DISPLAY_ARTIFACT == true) echo "selected";?>>True</option>
                            <option value="False" <?php if(NEW_FUNCTIONS_DISPLAY_ARTIFACT == false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b">Display WoW in profile <em class="tooltip">?<span class="classic">Enable (Disable) the display of the wonder in the player profile, opposite the corresponding village in which it is located</span></em></td>
                    <td>
                        <select name="new_functions_display_wonder">
                            <option value="True" <?php if(NEW_FUNCTIONS_DISPLAY_WONDER == true) echo "selected";?>>True</option>
                            <option value="False" <?php if(NEW_FUNCTIONS_DISPLAY_WONDER == false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b">Vacation Mode <em class="tooltip">?<span class="classic">Enable (Disable) vacation mode, will be displayed or hidden in the player profile menu</span></em></td>
                    <td>
                        <select name="new_functions_vacation">
                            <option value="True" <?php if(NEW_FUNCTIONS_VACATION == true) echo "selected";?>>True</option>
                            <option value="False" <?php if(NEW_FUNCTIONS_VACATION == false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b">Catapult targets <em class="tooltip">?<span class="classic">Enable (Disable) the display of the targets of the catapults in the rally point that were sent by you</span></em></td>
                    <td>
                        <select name="new_functions_display_catapult_target">
                            <option value="True" <?php if(NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET == true) echo "selected";?>>True</option>
                            <option value="False" <?php if(NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET == false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b">Manual on Nature and Natars <em class="tooltip">?<span class="classic">Enable (Disable) displaying information in the Manual about the troops of Nature and Natars</span></em></td>
                    <td>
                        <select name="new_functions_manual_naturenatars">
                            <option value="True" <?php if(NEW_FUNCTIONS_MANUAL_NATURENATARS == true) echo "selected";?>>True</option>
                            <option value="False" <?php if(NEW_FUNCTIONS_MANUAL_NATURENATARS == false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b">Direct links placement <em class="tooltip">?<span class="classic">If Enabled, then the Direct links will be placed in the left menu, if Disabled then Direct links will be placed in the right menu as in the original Travian</span></em></td>
                    <td>
                        <select name="new_functions_display_links">
                            <option value="True" <?php if(NEW_FUNCTIONS_DISPLAY_LINKS == true) echo "selected";?>>True</option>
                            <option value="False" <?php if(NEW_FUNCTIONS_DISPLAY_LINKS == false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b">Medal Veteran Player <em class="tooltip">?<span class="classic">Enable (Disable) medal achieved for playing 3 years of Travian</span></em></td>
                    <td>
                        <select name="new_functions_medal_3year">
                            <option value="True" <?php if(NEW_FUNCTIONS_MEDAL_3YEAR == true) echo "selected";?>>True</option>
                            <option value="False" <?php if(NEW_FUNCTIONS_MEDAL_3YEAR == false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b">Medal Veteran Player 5a <em class="tooltip">?<span class="classic">Enable (Disable) medal achieved for playing 5 years of Travian</span></em></td>
                    <td>
                        <select name="new_functions_medal_5year">
                            <option value="True" <?php if(NEW_FUNCTIONS_MEDAL_5YEAR == true) echo "selected";?>>True</option>
                            <option value="False" <?php if(NEW_FUNCTIONS_MEDAL_5YEAR == false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b">Medal Veteran Player 10a <em class="tooltip">?<span class="classic">Enable (Disable) medal achieved for playing 10 years of Travian</span></em></td>
                    <td>
                        <select name="new_functions_medal_10year">
                            <option value="True" <?php if(NEW_FUNCTIONS_MEDAL_10YEAR == true) echo "selected";?>>True</option>
                            <option value="False" <?php if(NEW_FUNCTIONS_MEDAL_10YEAR == false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b">Special Medals <em class="tooltip">?<span class="classic">Enable (Disable) special medals (artifact, hero, ww, wall, great store, etc.)</span></em></td>
                    <td>
                        <select name="new_functions_special_medals_system">
                            <option value="True" <?php if(NEW_FUNCTIONS_SPECIAL_MEDALS_SYSTEM == true) echo "selected";?>>True</option>
                            <option value="False" <?php if(NEW_FUNCTIONS_SPECIAL_MEDALS_SYSTEM == false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b">Server Milestones <em class="tooltip">?<span class="classic">Enable (Disable) the "Server Milestones" widget (first player to settle a 2nd village, reach 1000 population, capture an artefact, conquer a WW, conquer a WW building plan, found an alliance, or conquer a village from another player) shown at the top of Statistics &raquo; General</span></em>
                    <?php if (!defined('NEW_FUNCTIONS_MILESTONES')): ?><br><span style="color:#c0392b;font-size:11px;font-weight:normal;text-transform:none;">Not present in config.php yet &mdash; saving this form once will add it (defaults to False until then).</span><?php endif; ?>
                    </td>
                    <td>
                        <select name="new_functions_milestones">
                            <option value="True" <?php if(defined('NEW_FUNCTIONS_MILESTONES') && NEW_FUNCTIONS_MILESTONES == true) echo "selected";?>>True</option>
                            <option value="False" <?php if(!defined('NEW_FUNCTIONS_MILESTONES') || NEW_FUNCTIONS_MILESTONES == false) echo "selected";?>>False</option>
                        </select>
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
