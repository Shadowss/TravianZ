<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : troops.tpl              	             			       ##
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

if($_SESSION['access'] < MULTIHUNTER) return;
$tribe = (int)$user['tribe'];
$hero = $database->getHero($village['owner']);
$heroCount = $hero ? 1 : 0;
?>
<style>
.troops-modern{font-family:system-ui}
.troops-grid{display:grid;grid-template-columns:repeat(11,1fr);gap:4px;padding:4px 2px;background:#fff}
.troop-item{text-align:center;padding:4px 2px;border:1px solid #f1f5f9;border-radius:6px;background:#fcfdff}
.troop-item:hover{background:#f8fafc}
.troop-item img, .troop-item svg{width:18px;height:18px;margin:0 auto 2px;display:block}
.troop-num{font-size:11.5px;font-weight:600;line-height:1}
.troop-num.zero{color:#cbd5e1}
.troop-num.has{color:#0f172a}
.troop-hero{background:#fffbeb!important;border-color:#fde68a!important}
.troops-foot{display:flex;justify-content:space-between;padding:8px 2px 2px;background:transparent;font-size:12px} /* FIX: scos background și border */
.troops-foot a{color:#2563eb;text-decoration:none;font-weight:500;display:flex;gap:4px;align-items:center}
.troops-foot a:hover{text-decoration:underline}
</style>

<div class="troops-modern">
  <div class="troops-grid">
  <?php
    if($tribe>=1 && $tribe<=9){$s=($tribe-1)*10+1;$e=$tribe*10;} else {$s=41;$e=50;}
    for($i=$s;$i<=$e;$i++){ $cnt=(int)$units['u'.$i]; $cls=$cnt==0?'zero':'has'; echo '<div class="troop-item"><img src="../img/un/u/'.$i.'.gif"><div class="troop-num '.$cls.'">'.$cnt.'</div></div>'; }
    if($tribe<=3 || $tribe>=6){
      $hcls=$heroCount==0?'zero':'has';
      echo '<div class="troop-item troop-hero"><svg viewBox="0 0 24 24" fill="#facc15" stroke="#eab308" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><div class="troop-num '.$hcls.'">'.$heroCount.'</div></div>';
    }
  ?>
  </div>
  <?php if($_SESSION['access']==ADMIN){ ?>
  <div class="troops-foot">
    <a href="admin.php?p=addTroops&did=<?=(int)($_GET['did'] ?? 0)?>"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>Edit Troops</a>
    <?php if(isset($_GET['d'])) echo '<span style="color:#dc2626;font-weight:600">Troops edited</span>'; ?>
  </div>
  <?php } ?>
</div>