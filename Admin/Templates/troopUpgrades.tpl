<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : troopUpgrades.tpl                           		       ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : ronix (Original)                                          ##
##  Refactored by  : iopietro                                                  ##
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

$tribe = (int)$user['tribe'];
$img = $tribe==1 ? "" : $tribe-1;
?>
<style>
.upg-modern{font-family:system-ui;background:#fff;border:0} /* scos border dublu */
.upg-head{display:grid;grid-template-columns:1fr 1fr;background:#f8fafc;border-bottom:1px solid #e5e7eb}
.upg-head div{padding:6px;text-align:center;font-size:12px;font-weight:600;color:#475569;text-transform:uppercase;letter-spacing:.3px}
.upg-icons{display:grid;grid-template-columns:repeat(16,1fr);gap:0;background:#fff;padding:8px 4px}
.upg-icons img{width:16px;height:16px;margin:0 auto;display:block} /* ORIGINAL, nu 20px */
.upg-levels{display:grid;grid-template-columns:repeat(16,1fr);gap:0;padding:2px 0 6px;background:#fff}
.upg-levels div{text-align:center;font-size:12px;font-weight:600;padding:2px 0;color:#0f172a}
.upg-levels div.zero{color:#cbd5e1;font-weight:500}
.upg-foot{display:flex;justify-content:space-between;padding:8px 2px 2px;background:#fff;font-size:12.5px;border-top:1px solid #f1f5f9}
.upg-foot a{color:#16a34a;text-decoration:none;font-weight:500}
.upg-foot a:hover{text-decoration:underline}
</style>

<div class="upg-modern">
  <div class="upg-head"><div>Armoury</div><div>Blacksmith</div></div>
  <div class="upg-icons">
    <?php for($i=1;$i<9;$i++) echo '<img src="../img/un/u/'.$img.$i.'.gif">'; for($i=1;$i<9;$i++) echo '<img src="../img/un/u/'.$img.$i.'.gif">'; ?>
  </div>
  <div class="upg-levels">
    <?php
      for($i=1;$i<9;$i++){
        $val = $tribe==5 ? '?' : (int)$abtech['a'.$i];
        $cls = ($val==0 || $val=='?')?'zero':'';
        echo '<div class="'.$cls.'">'.$val.'</div>';
      }
      for($i=1;$i<9;$i++){
        $val = $tribe==5 ? '?' : (int)$abtech['b'.$i];
        $cls = ($val==0 || $val=='?')?'zero':'';
        echo '<div class="'.$cls.'">'.$val.'</div>';
      }
    ?>
  </div>
    <?php if($_SESSION['access']==ADMIN){ ?>
  <div class="upg-foot">
    <?php if($tribe==5){ echo '<span style="color:#94a3b8">Upgrades Troops</span>'; } else { echo '<a href="admin.php?p=addABTroops&did='.$_GET['did'].'">Upgrades Troops</a>'; } ?>
    <a href="admin.php?p=techlog&did=<?=(int)($_GET['did'] ?? 0)?>" style="color:#64748b">Research Log</a>
  </div>
  <?php if(isset($_GET['ab'])) echo '<div style="text-align:right;padding:0 8px 6px;color:#dc2626;font-weight:600;font-size:12px">AB Tech updated</div>'; ?>
    <?php } ?>
</div>