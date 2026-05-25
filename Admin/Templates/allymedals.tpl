<?php 

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : allymedal.tpl                                             ##
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

$varmedal = $database->getProfileMedalAlly($_GET['aid']); 

?>
<style>
.medal-card{background:#fff;border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;font-family:system-ui;margin-bottom:12px}
.medal-head{background:#0f172a;color:#fff;padding:8px 12px;font-size:13px;font-weight:600}
.medal-table{width:100%;border-collapse:collapse}
.medal-table th{background:#f8fafc;padding:7px 6px;font-size:11px;color:#64748b;text-transform:uppercase;font-weight:600;border-bottom:1px solid #e5e7eb;text-align:center}
.medal-table td{padding:8px 6px;font-size:12.5px;text-align:center;border-bottom:1px solid #f1f5f9;vertical-align:middle}
.medal-table tr:last-child td{border-bottom:0}
.medal-table img{width:28px;height:36px;display:block;margin:0 auto;border-radius:3px}
.medal-del{width:22px;height:22px;display:inline-flex;align-items:center;justify-content:center;background:#fef2f2;border-radius:5px;color:#dc2626;border:0;cursor:pointer}
.medal-del:hover{background:#fee2e2}
.medal-del svg{width:12px;height:12px;stroke:currentColor;fill:none;stroke-width:2}
.medal-empty{padding:20px;text-align:center;color:#94a3b8;font-size:13px}
.medal-avg{background:#f8fafc;font-weight:600;color:#0f172a}
</style>

<div class="medal-card">
  <div class="medal-head">Alliance Medals (<?=sizeof($varmedal)?>)</div>
  <table class="medal-table">
    <thead>
      <tr>
        <th>Category</th><th>Rank</th><th>Week</th><th>Points</th><th>Medal</th><th style="width:32px"></th>
      </tr>
    </thead>
    <tbody>
    <?php if(sizeof($varmedal)==0){ ?>
      <tr><td colspan="6" class="medal-empty">This alliance has no medals yet</td></tr>
    <?php } else {
      $i=0;$averagerank=0;
      foreach($varmedal as $medal){
        switch($medal['categorie']){case "1":$t="Attackers";break;case "2":$t="Defenders";break;case "3":$t="Climbers";break;case "4":$t="Robbers";break;default:$t="Bonus";}
        $rank=$medal['plaats']; if($rank=='0') $rank='Bonus'; else {$i++; $averagerank+=$medal['plaats'];}
        $points=$medal['points']; if($points=='') $points='Bonus';
    ?>
      <tr>
        <td><?=$t?></td>
        <td><?=$rank?></td>
        <td><?=$medal['week']?></td>
        <td><?=$points?></td>
        <td><img src="../gpack/travian_default/img/t/<?=$medal['img']?>.jpg"></td>
        <td>
          <form action="../GameEngine/Admin/Mods/delallymedal.php" method="POST" style="margin:0">
            <input type="hidden" name="aid" value="<?=$_GET['aid']?>">
            <input type="hidden" name="admid" value="<?=$_SESSION['id']?>">
            <button type="submit" name="medalid" value="<?=$medal['id']?>" class="medal-del" title="Delete">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
          </form>
        </td>
      </tr>
    <?php }
      $average = $i>0 ? round($averagerank/$i,2) : 0;
    ?>
      <tr class="medal-avg">
        <td>Average Rank</td>
        <td><?=$average?></td>
        <td></td><td></td>
        <td>Delete All</td>
        <td>
          <form action="../GameEngine/Admin/Mods/delallymedalbyaid.php" method="POST" style="margin:0">
            <input type="hidden" name="admid" value="<?=$_SESSION['id']?>">
            <input type="hidden" name="aid" value="<?=$_GET['aid']?>">
            <button type="submit" class="medal-del" title="Delete All">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
          </form>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>