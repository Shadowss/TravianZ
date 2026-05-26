<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : player.tpl 		                                       ##
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

$id = $_GET['uid'];
// --- FIX: Anulează ștergerea direct din tpl ---
if(isset($_GET['action']) && $_GET['action'] == 'StopDel' && $id > 0){
    $database->query("DELETE FROM `".TB_PREFIX."deleting` WHERE `uid` = $id");
    // redirect ca să dispară ?action din URL
    header("Location: ?p=player&uid=".$id);
    exit;
}
if(isset($id))
{
	include_once("../GameEngine/Ranking.php");
	$varmedal = $database->getProfileMedal($id);
	$profiel="".$user['desc1']."".md5('skJkev3')."".$user['desc2']."";
	$separator="../";
	require("../Templates/Profile/medal.php");
	$profiel=explode("".md5('skJkev3')."", $profiel);
	$varray = $database->getProfileVillages($id);
	$refreshiconfrm = "../img/admin/refresh.png";
	$refreshicon  = "<img src=\"".$refreshiconfrm."\">";
?>
<style>
/* PLAYER.TPL - GLOBAL 2026 COMPACT */
.player-page{font-family:system-ui}
.player-page > br,.player-page br{display:none}
#profile, .hero-wrap, #member, .ban-history{margin-bottom:10px !important}
table.ban-history{width:100%;border-collapse:separate;border-spacing:0;background:#fff;border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04);margin-top:10px;font-family:system-ui}
table.ban-history thead tr:first-child th{background:linear-gradient(135deg,#0f172a,#1e293b);color:#fff;padding:6px 10px;font-weight:600;text-align:left;font-size:13px}
table.ban-history thead tr:nth-child(2) td{background:#f8fafc;color:#64748b;font-size:11px;text-transform:uppercase;padding:4px 8px;border-bottom:1px solid #e5e7eb;font-weight:600}
table.ban-history tbody td{padding:3px 8px;border-bottom:1px solid #f1f5f9;font-size:12px;color:#334155;line-height:1.2}
table.ban-history tbody tr:last-child td{border-bottom:0}
table.ban-history tbody tr:hover td{background:#f8fafc}
table.ban-history td.hab{width:18%}
table.ban-history td.on{color:#0f172a}
.player-bottom{display:block;margin-top:10px;overflow:hidden}
.player-bottom > div:first-child{float:left;width:49%}
.player-bottom > div:last-child{float:right;width:49%}
</style>
<div class="player-page">
<?php
	if($user){
		$totalpop = 0;
		foreach($varray as $vil) $totalpop += $vil['pop'];

		include('search2.tpl');
		
$deletion = false;
$delTime = '00:00:00';

// 1. ia timestamp-ul din tabelul de ștergere
$uid = (int)$user['id'];
$sql = "SELECT `timestamp` FROM `".TB_PREFIX."deleting` WHERE `uid` = $uid LIMIT 1";
$result = $database->query($sql);

if($result && $row = mysqli_fetch_assoc($result)){
    if($row['timestamp'] > time()){
        $deletion = true;
        
        // 2. calculează cât a mai rămas
        $remaining = $row['timestamp'] - time();
        $h = floor($remaining / 3600);
        $m = floor(($remaining % 3600) / 60);
        $s = $remaining % 60;
        $delTime = sprintf("%02d:%02d:%02d", $h, $m, $s);
    }
}

// 3. afișează doar dacă e în proces
if($deletion){
    include("playerdeletion.tpl");
}

        include("playerinfo.tpl");
        include("playerheroinfo.tpl");
        include("playeradditionalinfo.tpl");
		
		include("playermedals.tpl");
		include ("villages.tpl"); ?>

<div style="display:grid;grid-template-columns:1fr;gap:12px;margin-top:12px;width:100%">
    <div>
        <?php include "punish.tpl"; ?>
    </div>
    <div>
        <?php include "add_village.tpl"; ?>
    </div>
</div>

		<?php
			$sql = "SELECT * FROM ".TB_PREFIX."banlist WHERE uid = ".(int) $id."";
			$numbans = mysqli_num_rows(mysqli_query($GLOBALS["link"], $sql));
		?>
		<table class="ban-history" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th colspan="4">Ban History (<?php echo $numbans; ?>)</th>
				</tr>
				<tr>
					<td class="hab"><b>Start</b></td>
					<td class="hab"><b>End</b></td>
					<td class="hab"><b>Duration</b></td>
					<td class="on"><b>Reason</b></td>
				</tr>
			</thead>
			<tbody>
				<?php
					$result = mysqli_query($GLOBALS["link"], $sql);
					while($row = mysqli_fetch_assoc($result))
					{
						echo '
							<tr>
								<td class="hab">'.date('d:m:Y H:i', $row['time']).'</td>
								<td class="hab">'.date('d:m:Y H:i', $row['end']).'</td>
								<td class="hab">'.round((($row['end'] - $row['time']) / 3600), 2).' hours</td>
								<td class="on">'.$row['reason'].'</td>
							</tr>';
					}
				?>
			</tbody>
		</table>
		</div>
		<?php
	}
	else include("404.tpl");
}
?>