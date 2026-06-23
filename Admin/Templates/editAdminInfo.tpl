<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : editAdminInfo.tpl                                         ##
##  Type           : Admin Panel Frontend                                      ##
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
    
    <form action="../GameEngine/Admin/Mods/editAdminInfo.php" method="POST">
        <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">
        
        <div class="config-card">
            <div class="config-head">
                <span><?php echo EDIT_ADMIN_INFO ?></span>
            </div>
            <table class="config-table">
                <tbody>
                <tr>
                    <td class="b"><?php echo CONF_ADMIN_NAME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_NAME_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="aname" id="aname" value="<?php echo ADMIN_NAME;?>" style="width: 90%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_ADMIN_EMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_EMAIL_TOOLTIP ?></span></em></td>
                    <td><input class="fm" name="aemail" id="aemail" value="<?php echo ADMIN_EMAIL;?>" style="width: 90%;"></td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_ADMIN_SHOWSTATS ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_SHOWSTATS_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="admin_rank">
                            <option value="true" <?php if (INCLUDE_ADMIN==true) echo "selected";?>>True</option>
                            <option value="false" <?php if (INCLUDE_ADMIN==false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_ADMIN_SUPPMESS ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_SUPPMESS_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="admin_support_msgs">
                            <option value="True" <?php if (ADMIN_RECEIVE_SUPPORT_MESSAGES==true) echo "selected";?>>True</option>
                            <option value="False" <?php if (ADMIN_RECEIVE_SUPPORT_MESSAGES==false) echo "selected";?>>False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_ADMIN_RAIDATT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_RAIDATT_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="admin_raidable">
                            <option value="True" <?php if (ADMIN_ALLOW_INCOMING_RAIDS==true) echo "selected";?>>True</option>
                            <option value="False" <?php if (ADMIN_ALLOW_INCOMING_RAIDS==false) echo "selected";?>>False</option>
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
