<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : playerheroinfo.tpl 		                               ##
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

include_once("../GameEngine/Data/hero_full.php"); 
include_once("../GameEngine/Units.php");
$id = (int) $_GET['uid'];
$hero = $units->Hero($id,1);

$heroAliveIndex = -1;
if ($hero !== false) {
	foreach ($hero as $hid => $h) {
		if (!$h['dead']) { $heroAliveIndex = $hid; break; }
	}
}
?>
<style>
.hero-wrap{width:100%;margin-top:15px;font-family:system-ui}
.hero-table{width:100%;border-collapse:separate;border-spacing:0;background:#fff;border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04)}
.hero-table th,.hero-table td{vertical-align:middle;padding:3px 8px;border-bottom:1px solid #f1f5f9;font-size:12px;color:#1e293b;line-height:1.2}
.hero-table thead th{background:linear-gradient(180deg,#f8fafc,#eef2f7);text-align:center;font-weight:600;color:#334155;border-bottom:1px solid #e2e8f0;padding:4px 8px}
.hero-table tr:last-child td{border-bottom:0}
.hero-table thead th.hero-head{background:linear-gradient(135deg,#66CCFF,#66CCCC) !important;color:#fff !important;padding:6px 10px !important;font-size:13px}
.hero-sub{background:#e2e8f0 !important;font-weight:600;color:#1e293b;text-align:center;padding:3px 8px !important}
.hero-name{font-weight:600;color:#0f172a}
.badge{display:inline-block;padding:1px 6px;border-radius:5px;font-size:10.5px;font-weight:600}
.badge-alive{background:#dcfce7;color:#166534}
.badge-dead{background:#fee2e2;color:#991b1b}
.hero-actions{display:flex;align-items:center;gap:8px}
.hero-icon{display:inline-flex;opacity:.8;transition:.15s}
.hero-icon:hover{opacity:1}
.hero-icon svg{width:14px;height:14px;stroke:#64748b;stroke-width:2;fill:none;stroke-linecap:round;stroke-linejoin:round}
.hero-icon.edit:hover svg{stroke:#2563eb}
.hero-icon.kill:hover svg{stroke:#dc2626}
.hero-icon.revive:hover svg{stroke:#16a34a}
.hero-unit img{vertical-align:middle;margin-right:3px;width:16px;height:16px}
.hero-bar{height:4px;background:#e5e7eb;border-radius:2px;overflow:hidden;margin-top:2px}
.hero-bar-fill{height:100%;background:linear-gradient(90deg,#22c55e,#16a34a)}
.add-hero a{margin:0 2px;opacity:.9}
.add-hero a:hover{opacity:1}
.add-hero img{width:18px;height:18px}
.notice{margin-top:6px;text-align:center;font-size:12px;padding:4px;border-radius:5px}
.notice-blue{background:#eff6ff;color:#1d4ed8}
.notice-red{background:#fef2f2;color:#b91c1c}
</style>

<div class="hero-wrap">
<table class="hero-table">
	<thead>
	<tr><th colspan="3" class="hero-head">Player Heroes</th></tr>
	</thead>
	
	<?php if ($hero === false) {?>
	<tr>
		<td colspan="3" align="center" class="add-hero">
			None &nbsp;&nbsp;<span style="color:#2563eb;font-weight:600">Add Hero</span>
			<?php
			$utribe=($user['tribe']-1)*10;
			echo "&nbsp;<a href='?action=addHero&uid=".$id."&u=".($utribe+1)."'><img class=\"unit u".($utribe+1)."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($utribe+1)."\" title=\"".$technology->getUnitName($utribe+1)."\" /></a>";
			echo "&nbsp;<a href='?action=addHero&uid=".$id."&u=".($utribe+2)."'><img class=\"unit u".($utribe+2)."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($utribe+2)."\" title=\"".$technology->getUnitName($utribe+2)."\" /></a>";
			if ($utribe!=20) {
				echo "&nbsp;<a href='?action=addHero&uid=".$id."&u=".($utribe+3)."'><img class=\"unit u".($utribe+3)."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($utribe+3)."\" title=\"".$technology->getUnitName($utribe+3)."\" /></a>";
			}else{
				echo "&nbsp;<a href='?action=addHero&uid=".$id."&u=".($utribe+4)."'><img class=\"unit u".($utribe+4)."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($utribe+4)."\" title=\"".$technology->getUnitName($utribe+4)."\" /></a>";
			}
			echo "&nbsp;<a href='?action=addHero&uid=".$id."&u=".($utribe+5)."'><img class=\"unit u".($utribe+5)."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($utribe+5)."\" title=\"".$technology->getUnitName($utribe+5)."\" /></a>";
			echo "&nbsp;<a href='?action=addHero&uid=".$id."&u=".($utribe+6)."'><img class=\"unit u".($utribe+6)."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($utribe+6)."\" title=\"".$technology->getUnitName($utribe+6)."\" /></a>";
			?>
		</td>
	</tr>	
	<?php } else {
	$x = 1;
	foreach ($hero as $h) { ?>
	<tr><td colspan="3" class="hero-sub" style="text-align:center">Hero #<?php echo $x++; ?></td></tr>
	<tr>
		<td width="35%">Hero Name</td> 
		<td colspan="2" class="hero-name"><?php echo $h['name']; ?></td> 
	</tr>
	<tr>
		<td>Hero Level</td> 
		<td colspan="2"><?php echo $h['level']; ?></td> 
	</tr>
	<tr>
		<td>Hero Unit</td> 
		<td colspan="2" class="hero-unit"><?php echo "<img class=\"unit u".$h['unit']."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($h['unit'])."\" title=\"".$technology->getUnitName($h['unit'])."\" /> ".$technology->getUnitName($h['unit']); ?></td> 
	</tr>
	<tr> 
		<td>Status</td> 
		<td colspan="2" class="hero-actions">
		<?php if (!$h['dead']) { ?>
			<span class="badge badge-alive">Alive</span>
			<a class="hero-icon edit" href='admin.php?p=editHero&uid=<?php echo $id; ?>&amp;hid=<?php echo $h['heroid'] ?>' title="Edit">
				<svg viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
			</a>
			<a class="hero-icon kill" href='?action=killHero&uid=<?php echo $id; ?>' title="Kill">
				<svg viewBox="0 0 24 24"><path d="M3 6h18M8 6V4h8v2m-1 0v14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2V6h10z"/></svg>
			</a>
		<?php } else { ?>
			<span class="badge badge-dead">Dead</span>
			<?php if ($heroAliveIndex === -1) { ?>
				<a class="hero-icon revive" href="?action=reviveHero&uid=<?php echo $id;?>&amp;hid=<?php echo $h['heroid'] ?>" title="Revive">
					<svg viewBox="0 0 24 24"><path d="M21 12a9 9 0 1 1-3-6.7"/><path d="M21 3v6h-6"/></svg>
				</a>
			<?php } else { echo '<span style="color:#64748b;font-size:11px">(kill living hero first)</span>'; } ?>
		<?php } ?>
		</td>
	</tr>

	<?php if (!$h['dead']) { ?>
	<tr><th>Details</th><th>Point</th><th>Level</th></tr>
	<tr><td>Offence</td><td><?php echo $h['atk']; ?></td><td><?php echo $h['attack']; ?></td></tr> 
	<tr><td>Defence</td><td><?php echo $h['di']."/".$h['dc']; ?></td><td><?php echo $h['defence']; ?></td></tr> 
	<tr><td>Off-Bonus</td><td><?php echo ($h['ob']-1)*100; ?>%</td><td><?php echo $h['attackbonus']; ?></td></tr> 
	<tr><td>Def-Bonus</td><td><?php echo ($h['db']-1)*100; ?>%</td><td><?php echo $h['defencebonus']; ?></td></tr> 
	<tr><td>Regeneration</td><td><?php echo ($h['regeneration']*5*SPEED); ?>/Day</td><td><?php echo $h['regeneration']; ?></td></tr>
	<tr>
		<?php 
		$count_level_exp=500-intval($h['attack']+$h['defence']+$h['attackbonus']+$h['defencebonus']+$h['regeneration']);
		if ($h['points']>$count_level_exp) $h['points']=$count_level_exp;
		$expPct = ($h['experience'] < 495000) ? (int)(($h['experience'] - $hero_levels[$h['level']]) / ($hero_levels[$h['level']+1] - $hero_levels[$h['level']])*100) : 100;
		?>
		<td>Experience: <?php echo $expPct; ?>%</td> 
		<td colspan="2"><?php echo $h['points']; ?><div class="hero-bar"><div class="hero-bar-fill" style="width:<?php echo $expPct; ?>%"></div></div></td> 
	</tr>
	<tr><td>Health</td><td colspan="2"><?php echo round($h['health']); ?>%<div class="hero-bar"><div class="hero-bar-fill" style="width:<?php echo round($h['health']); ?>%"></div></div></td></tr>
	<tr><td colspan="3" style="height:8px;background:#f8fafc"></td></tr>
	<?php } else { ?>
	<tr><td colspan="3" style="height:8px;background:#f8fafc"></td></tr>
	<?php } } } ?>
</table>

<?php
if(isset($_GET['e'])) echo '<div class="notice notice-red"><b>Hero could not be killed.</b></div>';
elseif(isset($_GET['kc'])) echo '<div class="notice notice-blue"><b>Hero has been killed.</b></div>';
elseif(isset($_GET['rc'])) echo '<div class="notice notice-blue"><b>Hero has been revived.</b></div>';
elseif(isset($_GET['re'])) echo '<div class="notice notice-red"><b>Cannot revive – another hero lives.</b></div>';
elseif(isset($_GET['ac'])) echo '<div class="notice notice-blue"><b>New hero added.</b></div>';
elseif(isset($_GET['cs'])) echo '<div class="notice notice-blue"><b>Hero information saved.</b></div>';
elseif(isset($_GET['ce'])) echo '<div class="notice notice-red"><b>Edit failed.</b></div>';
?>
</div>