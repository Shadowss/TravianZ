<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : editPlusSet.tpl                                           ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : martinambrus (Original)                                   ##
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
    <div class="config-title"><?php echo PLUS_CONFIGURATION ?></div>
    
    <form action="../GameEngine/Admin/Mods/editPlusSet.php" method="POST">
        <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">
        
        <div class="config-card">
            <div class="config-head">
                <span><?php echo EDIT_PLUS_SETT ?></span>
            </div>
            <table class="config-table">
                <tbody>
                <tr>
                    <td class="b"><?php echo CONF_PLUS_PAYPALEMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PAYPALEMAIL_TOOLTIP ?></span></em></td>
                    <td>
                        <input class="fm" name="paypal-email" value="<?php echo (defined('PAYPAL_EMAIL') ? PAYPAL_EMAIL : '@'); ?>" style="width: 70%;">
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_PLUS_CURRENCY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_CURRENCY_TOOLTIP ?></span></em></td>
                    <td>
                        <input class="fm" name="paypal-currency" value="<?php echo (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?>" style="width: 70%;">
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_PLUS_PACKAGEGOLDA ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDA_TOOLTIP ?></span></em></td>
                    <td>
                        <input class="fm" name="plus-a-gold" value="<?php echo (defined('PLUS_PACKAGE_A_GOLD') ? PLUS_PACKAGE_A_GOLD : 60); ?>" style="width: 70%;">
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_PLUS_PACKAGEPRICEA ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICEA_TOOLTIP ?></span></em></td>
                    <td>
                        <input class="fm" name="plus-a-price" value="<?php echo (defined('PLUS_PACKAGE_A_PRICE') ? PLUS_PACKAGE_A_PRICE : '1,99'); ?>" style="width: 70%;">
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_PLUS_PACKAGEGOLDB ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDB_TOOLTIP ?></span></em></td>
                    <td>
                        <input class="fm" name="plus-b-gold" value="<?php echo (defined('PLUS_PACKAGE_B_GOLD') ? PLUS_PACKAGE_B_GOLD : 120); ?>" style="width: 70%;">
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_PLUS_PACKAGEPRICEB ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICEB_TOOLTIP ?></span></em></td>
                    <td>
                        <input class="fm" name="plus-b-price" value="<?php echo (defined('PLUS_PACKAGE_B_PRICE') ? PLUS_PACKAGE_B_PRICE : '4,99'); ?>" style="width: 70%;">
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_PLUS_PACKAGEGOLDC ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDC_TOOLTIP ?></span></em></td>
                    <td>
                        <input class="fm" name="plus-c-gold" value="<?php echo (defined('PLUS_PACKAGE_C_GOLD') ? PLUS_PACKAGE_C_GOLD : 360); ?>" style="width: 70%;">
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_PLUS_PACKAGEPRICEC ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICEC_TOOLTIP ?></span></em></td>
                    <td>
                        <input class="fm" name="plus-c-price" value="<?php echo (defined('PLUS_PACKAGE_C_PRICE') ? PLUS_PACKAGE_C_PRICE : '9,99'); ?>" style="width: 70%;">
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_PLUS_PACKAGEGOLDD ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDD_TOOLTIP ?></span></em></td>
                    <td>
                        <input class="fm" name="plus-d-gold" value="<?php echo (defined('PLUS_PACKAGE_D_GOLD') ? PLUS_PACKAGE_D_GOLD : 1000); ?>" style="width: 70%;">
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_PLUS_PACKAGEPRICED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICED_TOOLTIP ?></span></em></td>
                    <td>
                        <input class="fm" name="plus-d-price" value="<?php echo (defined('PLUS_PACKAGE_D_PRICE') ? PLUS_PACKAGE_D_PRICE : '19,99'); ?>" style="width: 70%;">
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_PLUS_PACKAGEGOLDE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDE_TOOLTIP ?></span></em></td>
                    <td>
                        <input class="fm" name="plus-e-gold" value="<?php echo (defined('PLUS_PACKAGE_E_GOLD') ? PLUS_PACKAGE_E_GOLD : 2000); ?>" style="width: 70%;">
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_PLUS_PACKAGEPRICEE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICEE_TOOLTIP ?></span></em></td>
                    <td>
                        <input class="fm" name="plus-e-price" value="<?php echo (defined('PLUS_PACKAGE_E_PRICE') ? PLUS_PACKAGE_E_PRICE : '49,99'); ?>" style="width: 70%;">
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_PLUS_ACCDURATION ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_ACCDURATION_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="plus_time">
                            <option value="(3600*12)" <?php if(PLUS_TIME==43200) echo "selected";?>>12 hours</option>
                            <option value="(3600*24)" <?php if(PLUS_TIME==86400) echo "selected";?>>1 day</option>
                            <option value="(3600*24*2)" <?php if(PLUS_TIME==172800) echo "selected";?>>2 days</option>
                            <option value="(3600*24*3)" <?php if(PLUS_TIME==259200) echo "selected";?>>3 days</option>
                            <option value="(3600*24*4)" <?php if(PLUS_TIME==345600) echo "selected";?>>4 days</option>
                            <option value="(3600*24*5)" <?php if(PLUS_TIME==432000) echo "selected";?>>5 days</option>
                            <option value="(3600*24*6)" <?php if(PLUS_TIME==518400) echo "selected";?>>6 days</option>
                            <option value="(3600*24*7)" <?php if(PLUS_TIME==604800) echo "selected";?>>7 days</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="b"><?php echo CONF_PLUS_PRODUCTDURATION ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PRODUCTDURATION_TOOLTIP ?></span></em></td>
                    <td>
                        <select name="plus_production">
                            <option value="(3600*12)" <?php if(PLUS_TIME==43200) echo "selected";?>>12 hours</option>
                            <option value="(3600*24)" <?php if(PLUS_TIME==86400) echo "selected";?>>1 day</option>
                            <option value="(3600*24*2)" <?php if(PLUS_TIME==172800) echo "selected";?>>2 days</option>
                            <option value="(3600*24*3)" <?php if(PLUS_TIME==259200) echo "selected";?>>3 days</option>
                            <option value="(3600*24*4)" <?php if(PLUS_TIME==345600) echo "selected";?>>4 days</option>
                            <option value="(3600*24*5)" <?php if(PLUS_TIME==432000) echo "selected";?>>5 days</option>
                            <option value="(3600*24*6)" <?php if(PLUS_TIME==518400) echo "selected";?>>6 days</option>
                            <option value="(3600*24*7)" <?php if(PLUS_TIME==604800) echo "selected";?>>7 days</option>
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
