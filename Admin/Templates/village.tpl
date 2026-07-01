<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : villagelog.tpl 		                                   ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki & Advocatie (Original)                              ##
##  Thanks to      : itay2277 & ronix(Edit some additions)                     ##
##  Redesign by    : Shadow                                                    ##
##  Improved:      : aggenkeech                                                ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2025. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

include_once("../GameEngine/Generator.php");

$id = $_GET['did'];
if(isset($id)){

	$coor = $database->getCoor($village['wref']);
	$varray = $database->getProfileVillages($village['owner']);
	$type = $database->getVillageType($village['wref']);
	$fdata = $database->getResourceLevel($village['wref']);
	$units = $database->getUnit($village['wref']);
	$abtech = $database->getABTech($id);
	
	switch($type){
	    case 1: $typ = [3, 3, 3, 9]; break;
	    case 2: $typ = [3, 4, 5, 6]; break;
	    case 3: $typ = [4, 4, 4, 6]; break;
	    case 4: $typ = [4, 5, 3, 6]; break;
	    case 5: $typ = [5, 3, 4, 6]; break;
	    case 6: $typ = [1, 1, 1, 15]; break;
	    case 7: $typ = [4, 4, 3, 7]; break;
	    case 8: $typ = [3, 4, 4, 7]; break;
	    case 9: $typ = [4, 3, 4, 7]; break;
	    case 10: $typ = [3, 5, 4, 6]; break;
	    case 11: $typ = [4, 5, 3, 6]; break;
	    case 12: $typ = [5, 4, 3, 6]; break;
	}

	$ocounter = []; $wood = $clay = $iron =$crop = 0;
	$q = "SELECT o.*, w.x, w.y FROM ".TB_PREFIX."odata AS o LEFT JOIN ".TB_PREFIX."wdata AS w ON o.wref=w.id WHERE conqured = ".(int) $village['wref'];
	$result = $database->query_return($q);
	if(!empty($result)){
		    $newResult = [];
			foreach($result as $row){
				$type = $row['type'];
                if ( $type == 1 ) { $row['type'] = '<img src="../img/admin/r/1.gif"> + 25%'; $wood += 1; }
                elseif ( $type == 2 ) { $row['type'] = '<img src="../img/admin/r/1.gif"> + 25%'; $wood += 1; }
                elseif ( $type == 3 ) { $row['type'] = '<img src="../img/admin/r/1.gif"> + 25%<br /><img src="../img/admin/r/4.gif"> + 25%'; $wood += 1; $crop += 1; }
                elseif ( $type == 4 ) { $row['type'] = '<img src="../img/admin/r/2.gif"> + 25%'; $clay += 1; }
                elseif ( $type == 5 ) { $row['type'] = '<img src="../img/admin/r/2.gif"> + 25%'; $clay += 1; }
                elseif ( $type == 6 ) { $row['type'] = '<img src="../img/admin/r/2.gif"> + 25%<br /><img src="../img/admin/r/4.gif"> + 25%'; $clay += 1; $crop += 1; }
                elseif ( $type == 7 ) { $row['type'] = '<img src="../img/admin/r/3.gif"> + 25%'; $iron += 1; }
                elseif ( $type == 8 ) { $row['type'] = '<img src="../img/admin/r/3.gif"> + 25%'; $iron += 1; }
                elseif ( $type == 9 ) { $row['type'] = '<img src="../img/admin/r/3.gif"> + 25%<br /><img src="../img/admin/r/4.gif"> + 25%'; $iron += 1; $crop += 1; }
                elseif ( $type == 10 ) { $row['type'] = '<img src="../img/admin/r/4.gif"> + 25%'; $crop += 1; }
                elseif ( $type == 11 ) { $row['type'] = '<img src="../img/admin/r/4.gif"> + 25%'; $crop += 1; }
                elseif ( $type == 12 ) { $row['type'] = '<img src="../img/admin/r/4.gif"> + 50%'; $crop += 2; }
                $newResult[] = $row;
			}
		}
	$ocounter = array($wood,$clay,$iron,$crop);
	$production=$admin->calculateProduction($id,$user['id'],$user['b1'],$user['b2'],$user['b3'],$user['b4'],$fdata, $ocounter, $village['pop']);

	if($village && $user){
		include("search2.tpl"); 
        $svgEdit = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';
        $svgRefresh = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a9 9 0 1 1-3-6.7"/><path d="M21 3v6h-6"/></svg>';
        $svgDel = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M8 6V4h8v2m-1 0v14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2V6h10z"/></svg>';
?>
<link href="../<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css">
<style>
/* COMPACT V2 - centrat */
.village-page{font-family:system-ui;max-width:1000px;margin:0 auto;padding:0 6px}
.vgrid{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-top:8px}
@media(max-width:900px){.vgrid{grid-template-columns:1fr}}
.vcard{background:#fff;border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04);margin-bottom:8px}
.vhead{background:linear-gradient(135deg,#66CCFF,#66CCCC);color:#fff;padding:7px 10px;font-weight:600;font-size:13px;display:flex;justify-content:space-between;align-items:center}
.vhead a{color:#93c5fd;display:inline-flex}
.vtable{width:100%;border-collapse:collapse}
.vtable td{padding:5px 8px;border-bottom:1px solid #f1f5f9;font-size:12.5px;color:#334155;vertical-align:middle}
.vtable tr:last-child td{border-bottom:0}
.vtable tr:hover td{background:#f8fafc}
.vtable td.label{width:30%;color:#64748b;font-weight:500;background:#fcfcfd}
.input-mini{padding:4px 6px;border:1px solid #d1d5db;border-radius:5px;font-size:12.5px}
.btn-icon{background:none;border:0;padding:3px;cursor:pointer;color:#64748b;border-radius:4px;display:inline-flex}
.btn-icon:hover{color:#2563eb;background:#eff6ff}
.btn-icon.danger:hover{color:#dc2626;background:#fef2f2}
.res-row{display:flex;align-items:center;gap:6px}
.res-row img.r1,.res-row img.r2,.res-row img.r3,.res-row img.r4{width:14px;height:14px;background:url(../img/x.gif)}
.badge-field img{width:13px;height:13px;vertical-align:middle}

/* HĂRȚI CENTRATE PERFECT */
.vmap-wrap{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-top:8px}
@media(max-width:900px){.vmap-wrap{grid-template-columns:1fr}}
.map-card{background:#fff;border:1px solid #e5e7eb;border-radius:10px;padding:8px;box-shadow:0 1px 4px rgba(0,0,0,.04);text-align:center}
.map-card h3{margin:0 0 6px;font-size:12.5px;color:#0f172a;font-weight:600}
.map-card #village_map{float:none!important;margin:0 auto!important;position:relative;left:0!important;right:0!important;display:block}
.map-card .village1,.map-card .village2{min-height:auto!important}
.map-card #content{padding:0!important;margin:0!important}
</style>

<div class="village-page">

<!-- 1. VILLAGE INFORMATION - FULL WIDTH -->
<div class="vcard">
  <div class="vhead">Village Information</div>
  <table class="vtable">
    <tr><td class="label">Owner</td><td><a href="admin.php?p=player&uid=<?php echo $village['owner']; ?>" style="color:#2563eb;font-weight:600"><?php echo htmlspecialchars($user['username']); ?></a></td>
      <td style="text-align:right">
        <form action="../GameEngine/Admin/Mods/editVillageOwner.php" method="POST" style="display:flex;gap:4px;align-items:center;justify-content:flex-end">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="did" value="<?php echo (int)($_GET['did'] ?? 0); ?>">
          <input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">
          <input class="input-mini" type="text" name="newowner" value="<?php echo $user['id']; ?>" style="width:65px">
          <?php if($_SESSION['access'] == ADMIN) { ?>
		  <button class="btn-icon" title="Change"><?php echo $svgEdit; ?></button>
		  <?php } ?>
        </form>
      </td>
    </tr>
        <tr><td class="label">Name</td><td colspan="2">
          <form action="../GameEngine/Admin/Mods/renameVillage.php" method="POST" style="display:flex;gap:4px">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="did" value="<?php echo (int)($_GET['did'] ?? 0); ?>">
            <input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">
            <input class="input-mini" type="text" name="villagename" value="<?php echo htmlspecialchars($village['name']); ?>" style="flex:1">
            <?php if($_SESSION['access'] == ADMIN) { ?>
			<button class="btn-icon" title="Rename"><?php echo $svgEdit; ?></button>
			<?php } ?>
          </form>
        </td></tr>
        <tr><td class="label">Population</td><td colspan="2"><?php echo $village['pop'];?> <a href="admin.php?action=recountPop&did=<?php echo (int)($_GET['did'] ?? 0); ?>" class="btn-icon" style="margin-left:4px"><?php echo $svgRefresh; ?></a></td></tr>
        <tr><td class="label">Coords</td><td colspan="2"><a href="<?php echo HOMEPAGE ?>/karte.php?d=<?php echo $village['wref']; ?>&c=<?php echo $generator->getMapCheck($village['wref']); ?>" target="_blank" style="color:#16a34a;font-weight:600">(<?php echo $coor['x']."|".$coor['y']; ?>)</a></td></tr>
        <tr><td class="label">ID</td><td colspan="2"><?php echo $village['wref'];?></td></tr>
        <tr><td class="label">Field</td><td colspan="2" class="badge-field"><?php for ($i = 0; $i <= 3; $i++){ $a = $i + 1; echo $typ[$i].'x <img src="../img/admin/r/'.$a.'.gif">'.($i!=3?' | ':''); } ?></td></tr>
      </table>
    </div>
<!-- 2. RESOURCES - FULL WIDTH -->
<div class="vcard">
  <div class="vhead">Resources<?php if($_SESSION['access'] == ADMIN) { ?><a href="admin.php?p=editResources&did=<?php echo (int)($_GET['did'] ?? 0); ?>"><?php echo $svgEdit; ?></a><?php } ?>
	</div>
  <table class="vtable" style="text-align:center">
    <tr style="background:#f8fafc;font-size:11px;color:#64748b"><td style="text-align:left">Res</td><td>Amt</td><td>Cap</td><td>Prod</td></tr>
    <tr><td style="text-align:left"><img src="../img/admin/r/1.gif"> Wood</td><td><?php echo floor($village['wood']); ?></td><td rowspan="3"><?php echo $village['maxstore'];?></td><td><?php echo $production['wood'];?></td></tr>
    <tr><td style="text-align:left"><img src="../img/admin/r/2.gif"> Clay</td><td><?php echo floor($village['clay']); ?></td><td><?php echo $production['clay'];?></td></tr>
    <tr><td style="text-align:left"><img src="../img/admin/r/3.gif"> Iron</td><td><?php echo floor($village['iron']); ?></td><td><?php echo $production['iron'];?></td></tr>
    <tr><td style="text-align:left"><img src="../img/admin/r/4.gif"> Crop</td><td><?php echo floor($village['crop']); ?></td><td><?php echo $village['maxcrop'];?></td><td><?php echo $production['crop'];?></td></tr>
  </table>
</div>
  </div>
  <div>
    <div class="vcard">
      <div class="vhead">Expansion</div>
      <table class="vtable" style="text-align:center">
        <tr style="background:#f8fafc;font-size:11px;color:#64748b"><td>Village</td><td>Pop</td><td>CP</td></tr>
        <?php for($e = 1; $e < 4; $e++){ $exp = $village['exp'.$e.'']; if($exp == 0){ echo '<tr><td>-</td><td>-</td><td>-</td></tr>'; }else{ $vill = $database->getVillage($exp); echo '<tr><td><a href="admin.php?p=village&did='.$vill['wref'].'" style="color:#2563eb">'.htmlspecialchars($vill['name']).'</a></td><td>'.$vill['pop'].'</td><td>'.$vill['cp'].'</td></tr>'; } } ?>
      </table>
    </div>

    <div class="vcard">
      <div class="vhead">Oasis</div>
      <table class="vtable" style="text-align:center">
        <tr style="background:#f8fafc;font-size:11px;color:#64748b"><td style="width:28px"></td><td>Name</td><td>Coords</td><td>Loy</td><td>Bonus</td></tr>
        <?php if(!empty($newResult)){ foreach($newResult as $row){ echo '<tr><td><a href="?action=delOas&oid='.$row['wref'].'&did='.$_GET['did'].'" onclick="return del(\'oas\','.$row['wref'].')" class="btn-icon danger">'.$svgDel.'</a></td><td>'.$row['name'].'</td><td><a href="../karte.php?d='.$row['wref'].'&c='.$generator->getMapCheck($row['wref']).'" target="_blank" style="color:#2563eb">('.$row['x'].'|'.$row['y'].')</a></td><td>'.round($row['loyalty']).'%</td><td>'.$row['type'].'</td></tr>'; } } else { echo '<tr><td colspan="5" style="color:#94a3b8;padding:10px">No oases</td></tr>'; } ?>
      </table>
    </div>
  </div>
</div>

<div class="vcard"><div class="vhead">Troops</div><div style="padding:4px"><?php include('troops.tpl'); ?></div></div>
<div class="vcard"><div class="vhead">Upgrades</div><div style="padding:4px"><?php include('troopUpgrades.tpl'); ?></div></div>
<div class="vcard"><div class="vhead">Artifact</div><div style="padding:4px"><?php include('artifact.tpl'); ?></div></div>

<div class="vmap-wrap">
  <div class="map-card">
    <h3>Resource Fields</h3>
    <a href="admin.php?p=editVillage&did=<?php echo (int)($_GET['did'] ?? 0); ?>">
      <div id="content" class="village1">
        <div id="village_map" class="f<?php echo $database->getVillageType($village['wref']); ?>">
          <?php for($f = 1; $f < 19; $f++){ $level = $fdata['f'.($f)]; echo "<img src=\"../img/x.gif\" class=\"reslevel rf".$f." level".$level."\">"; } ?>
        </div>
      </div>
    </a>
  </div>
  </br>
  <div class="map-card">
    <h3>Village Center - <?php echo htmlspecialchars($village['name']); ?></h3>
    <?php $WWLevel = $fdata['f99t']; $wallLevel = $fdata['f40t']; if($wallLevel == 0) $wallType = "d2_0"; else { switch($user['tribe']){ case 1: case 5: default: $wallType = "d2_11"; break; case 2: $wallType = "d2_12"; break; case 3: $wallType = "d2_1"; break; } } ?>
    <div id="content" class="village2">
      <div id="village_map" class="<?php echo $wallType; ?>">
        <?php for($b = 1; $b < 21; $b++){ $gid = $fdata['f'.($b + 18).'t']; if($gid > 0) echo "<img src=\"../img/x.gif\" class=\"building d".$b." g".$gid."\">"; elseif($gid == 0) echo "<img src=\"../img/x.gif\" class=\"building d".$b." iso\">"; }
        $rplevel = $fdata['f39t']; if($rplevel > 0) echo "<img src=\"../img/x.gif\" class=\"dx1 g16\">"; elseif($rplevel == 0) echo "<img src=\"../img/x.gif\" class=\"dx1 g16e\">";
        $resourcearray = $database->getResourceLevel($village['wref']);
        if($resourcearray['f99t'] == 40){
            if($resourcearray['f99'] <= 19) echo '<img class="ww g40" src="img/x.gif">';
            elseif($resourcearray['f99'] <= 39) echo '<img class="ww g40_1" src="img/x.gif">'; 
            elseif($resourcearray['f99'] <= 59) echo '<img class="ww g40_2" src="img/x.gif">';
            elseif($resourcearray['f99'] <= 79) echo '<img class="ww g40_3" src="img/x.gif">';
            elseif($resourcearray['f99'] <= 99) echo '<img class="ww g40_4" src="img/x.gif">';
            else echo '<img class="ww g40_5" src="img/x.gif">';
        } ?>
        <div id="levels" class="on">
          <?php for($b = 1; $b < 21; $b++){ $level = $fdata['f'.($b + 18)]; if($level >0) echo "<div class=\"d$b\">$level</div>"; } if($rplevel > 0) echo "<div class=\"l39\">".$fdata['f39']."</div>"; if($wallLevel > 0) echo "<div class=\"l40\">".$fdata['f40']."</div>"; if($WWLevel > 0) echo "<div class=\"d40\">".$fdata['f99']."</div>"; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="vcard" style="margin-top:8px">
  <div class="vhead">Buildings</div>
  <table class="vtable" style="text-align:center">
    <tr style="background:#f8fafc;font-size:11px;color:#64748b"><td>ID</td><td>GID</td><td style="text-align:left">Name</td><td>Lvl</td><td>Edit</td></tr>
    <?php for ($i = 1; $i <= 41; $i++){ if($i == 41) $i = 99; if($fdata['f'.$i.'t'] == 0) $bu = "-"; else $bu = $funct->procResType($fdata['f'.$i.'t']); echo '<tr><td>'.$i.'</td><td>'.$fdata['f'.$i.'t'].'</td><td style="text-align:left">'.$bu.'</td><td>'.$fdata['f'.$i].'</td><td>'.($_SESSION['access'] == ADMIN ? '<a href="admin.php?p=editVillage&did='.$_GET['did'].'" class="btn-icon">'.$svgEdit.'</a>': '').'</td></tr>'; } ?>
  </table>
</div>

<div style="text-align:center;margin:12px 0"><a href="admin.php?p=villagelog&did=<?php echo (int)($_GET['did'] ?? 0); ?>" style="color:#2563eb;font-weight:500;font-size:13px">Village Build Log →</a></div>

</div>
<?php } else { include("404.tpl"); } } ?>