<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : natars.tpl 	        	                               ##
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

$deletedArtifacts = $database->getDeletedArtifacts();
?>
<style>
.nat-wrap{max-width:1150px;margin:18px auto;font-family:Verdana;font-size:12px}
.nat-head{display:flex;align-items:center;gap:8px;margin-bottom:14px}
.nat-head h1{margin:0;font-size:18px;color:#ffffff} /* MODIFICAT */
.nat-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:20px}
@media(max-width:950px){.nat-grid{grid-template-columns:1fr}}
.nat-card{background:#fff;border:1px solid #ddd;border-radius:8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.05)}
.nat-card h2{margin:0;padding:8px 12px;background:#f5f7fa;border-bottom:1px solid #ddd;font-size:13px;color:#333;display:flex;align-items:center;gap:6px}
.nat-card.body{padding:12px}
.nat-card input[type="number"],.nat-card input[type="text"],.nat-card select{padding:4px 6px;border:1px solid #bbb;border-radius:4px;font-size:12px}
.nat-card button{background:#2c7be5;color:#fff;border:none;padding:6px 14px;border-radius:4px;cursor:pointer;font-size:12px}
.nat-card button:hover{background:#1a68d1}
.nat-table{width:100%;border-collapse:collapse;font-size:12px;margin-top:10px}
.nat-table th{background:#34495e;color:#fff;padding:6px;text-align:left;font-weight:normal}
.nat-table td{padding:6px;border-bottom:1px solid #eee;text-align:center;color:#000000} /* MODIFICAT */
.nat-table td a{color:#000000;text-decoration:none} /* ADAUGAT */
.nat-table tr:hover{background:#f9f9f9}
.nat-table td.icon img{width:20px;height:20px}
.bon{color:#27ae60;font-weight:bold}
.none{padding:20px;text-align:center;color:#777}
</style>

<link href="../<?php echo GP_LOCATE;?>lang/en/lang.css?f4b7d" rel="stylesheet">
<link href="../<?php echo GP_LOCATE;?>lang/en/compact.css?f4b7i" rel="stylesheet">

<div class="nat-wrap">
  <div class="nat-head">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="#7f8c8d"><path d="M12 2L2 7v10l10 5 10-5V7z"/></svg>
    <h1>Natars Management</h1>
  </div>

  <div class="nat-grid">
    <!-- WW Villages -->
    <div class="nat-card">
      <h2>🏰 WW Villages</h2>
      <div class="body">
        <form method="post" action="../Admin/admin.php?action=addWWVillages">
          <?php echo csrf_field(); ?>
          <table class="nat-table">
            <tr><th>Number</th><th>Player ID</th><th></th></tr>
            <tr>
              <td><input type="number" name="numberOfVillages" value="1" min="1" max="999" style="width:60px"></td>
              <td><input type="text" name="playerId" value="<?php echo Artifacts::NATARS_UID;?>" style="width:80px"></td>
              <td><button onclick="this.disabled=true;this.form.submit();">Add</button></td>
            </tr>
          </table>
        </form>
      </div>
    </div>

    <!-- Artifacts -->
    <div class="nat-card">
      <h2>✨ Add Artifacts</h2>
      <div class="body">
        <form method="post" action="../Admin/admin.php?action=addArtifacts">
          <?php echo csrf_field(); ?>
          <table class="nat-table">
            <tr><th>Icon</th><th>Type</th><th>Qty</th><th>Player</th><th></th></tr>
            <tr>
              <td class="icon"><img id="artifactImage" class="artefact_icon_1" src="../img/x.gif"></td>
              <td>
                <select name="selectedArtifact" id="selectedArtifact" onchange="changeArtifactImage()">
                <?php
                $artifactArrays = array_merge(Artifacts::NATARS_ARTIFACTS, Artifacts::NATARS_WW_BUILDING_PLANS);
                foreach($artifactArrays as $desc => $artifactType){
                    foreach($artifactType as $artifact){
                        echo '<option value="'.$artifact['type'].':'.$artifact['size'].':'.$desc.'">'.$artifact['name'].'</option>';
                    }
                }
               ?>
                </select>
              </td>
              <td><input type="number" name="artifactQuantity" value="1" min="1" max="999" style="width:50px"></td>
              <td><input type="text" name="playerId" value="<?php echo Artifacts::NATARS_UID;?>" style="width:70px"></td>
              <td><button onclick="this.disabled=true;this.form.submit();">Add</button></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>

  <!-- Deleted Artifacts -->
  <div class="nat-card">
    <h2>🗑️ Deleted Artifacts</h2>
    <div class="body" style="padding:0">
      <table class="nat-table">
        <tr><th></th><th></th><th>Name</th><th>Bonus</th><th>Effect</th><th>Time</th><th>Old Owner</th><th>Old Village</th></tr>
        <?php if(empty($deletedArtifacts)){ echo '<tr><td colspan="8" class="none">No artifacts</td></tr>'; } else { foreach($deletedArtifacts as $artifact){ $info=Artifacts::getArtifactInfo($artifact);?>
        <tr>
          <td><a href="?action=returnArtifact&artid=<?php echo $artifact['id'];?>&del=1"><img src="../../img/admin/acc.gif" title="Restore"></a></td>
          <td class="icon"><img class="artefact_icon_<?php echo $artifact['type'];?>" src="../img/x.gif"></td>
          <td><?php echo $artifact['name'];?></td>
          <td><?php echo $info['bonus'];?></td>
          <td><?php echo $info['effectInfluence'];?></td>
          <td><?php echo date("d.m.Y H:i:s", $artifact['conquered']);?></td>
          <td><?php $u=htmlspecialchars($database->getUserField($artifact['owner'],"username",0)); echo $u!="[?]"?'<a href="?p=player&uid='.$artifact['owner'].'">'.$u.'</a>':'<span style="color:gray">'.$u.'</span>';?></td>
          <td><?php $v=htmlspecialchars($database->getVillageField($artifact['vref'],"name")); echo $v!="[?]"?'<a href="?p=village&did='.$artifact['vref'].'">'.$v.'</a>':'<span style="color:gray">'.$v.'</span>';?></td>
        </tr>
        <?php } }?>
      </table>
    </div>
  </div>

  <!-- Overview -->
  <div class="nat-card" style="margin-top:14px">
    <h2>📊 Artifacts Overview</h2>
    <div class="body" style="padding:0">
      <table class="nat-table">
        <tr><th>Icon</th><th>Name</th><th>Effect</th><th>Player</th><th>Alliance</th></tr>
        <?php
        $small=$database->getArtifactsBysize(1); $big=$database->getArtifactsBysize(2); $unique=$database->getArtifactsBysize(3);
        if(empty($small)&&empty($big)&&empty($unique)){ echo '<tr><td colspan="5" class="none">No artifacts found</td></tr>'; }
        else { $all=array(); if(is_array($small))$all=array_merge($all,$small); if(is_array($big))$all=array_merge($all,$big); if(is_array($unique))$all=array_merge($all,$unique);
	foreach($all as $a){
    $player=$database->getUserField($a['owner'],"username",0);
    $aid=$database->getUserField($a['owner'],"alliance",0);
    $ally=$database->getAllianceName($aid);
    echo '<tr>
        <td class="icon"><img src="../img/x.gif" class="artefact_icon_'.(int)$a['type'].'"></td>
        <td>'.$a['name'].'</td>
        <td><span class="bon">'.$a['effect'].'</span></td>
        <td><a href="?p=player&uid='.$a['owner'].'">'.$player.'</a></td>
        <td><a href="?p=alliance&aid='.$aid.'">'.$ally.'</a></td>
    </tr>';
}
        }
       ?>
      </table>
    </div>
  </div>
</div>

<script>
function changeArtifactImage(){
    var v = document.getElementById("selectedArtifact").value.split(":")[0];
    document.getElementById("artifactImage").className = "artefact_icon_" + v;
}
</script>