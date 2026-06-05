<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : search2.tpl 		                                       ##
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
$array_tribe=array('-',TRIBE1,TRIBE2,TRIBE3,TRIBE4,TRIBE5,TRIBE6);
$tribename = $array_tribe[$user['tribe']];

$searchresults = $admin->search_player($user['username']);
$numsimplayers = count($searchresults);
$id = $user['id'];
$varray = $database->getProfileVillages($id);
$totalpop = 0;
foreach($varray as $vil) $totalpop += $vil['pop'];
?>
<style>
#member.search-modern{width:100%;border-collapse:separate;border-spacing:0;background:#fff;border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04);margin-bottom:12px}
#member.search-modern th{background:linear-gradient(135deg,#66CCFF,#66CCCC);color:#fff;padding:10px 12px;font-weight:600;text-align:left;font-size:13px}
#member.search-modern th font{color:#000000 !important;font-weight:500}

.s-info-wrap{display:flex;flex-direction:column;gap:10px;width:100%;margin:0 0 12px}
.s-card{width:100%;background:#fff;border:1px solid #e5e7eb;border-radius:10px;padding:12px 14px;box-shadow:0 1px 3px rgba(0,0,0,.04);box-sizing:border-box}
.s-card-title{font-size:11px;text-transform:uppercase;color:#64748b;letter-spacing:.5px;margin-bottom:4px;font-weight:600}
.s-card-main{font-size:14px;font-weight:600;color:#0f172a}
.s-card-main a{color:#2563eb;text-decoration:none}
.s-card-main a:hover{text-decoration:underline}
.s-card-sub{font-size:12px;color:#475569;margin-top:3px}
.s-card-sub b{color:#334155;font-weight:600}
</style>

<form action="" method="post">
	<table id="member" class="search-modern">
		<thead>
			<tr>
				<th colspan="3">Search <font>("<?php echo htmlspecialchars($user['username']); ?>" = <?php echo $numsimplayers; ?> Similar)</font></th>
			</tr>
		</thead>
	</table>

	<div class="s-info-wrap">
		<div class="s-card">
			<div class="s-card-title">Player</div>
			<div class="s-card-main"><a href="?p=player&uid=<?php echo $user['id'];?>"><?php echo htmlspecialchars($user['username']);?></a> <span style="color:#94a3b8;font-weight:500">(uid: <?php echo $user['id'];?>)</span></div>
			<div class="s-card-sub"><b>Tribe:</b> <?php echo $tribename; ?> • <b>Villages:</b> <?php echo count($varray);?> • <b>Pop:</b> <?php echo number_format($totalpop,0,',','.'); ?></div>
		</div>

		<?php if(isset($_GET['did']) && isset($village)) { ?>
		<div class="s-card">
			<div class="s-card-title">Village</div>
			<div class="s-card-main"><a href="?p=village&did=<?php echo $village['wref'];?>"><?php echo htmlspecialchars($village['name']);?></a> <span style="color:#94a3b8;font-weight:500">(did: <?php echo $village['wref'];?>)</span></div>
			<div class="s-card-sub"><b>Coords:</b> (<?php echo $coor['x'];?>|<?php echo $coor['y'];?>) • <b>Pop:</b> <?php echo $village['pop'];?></div>
		</div>
		<?php } ?>
	</div>
</form>