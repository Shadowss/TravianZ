<?php
if(!isset($aid)) $aid = $session->alliance;

$allianceinfo = $database->getAlliance($aid);
echo "<h1>".$allianceinfo['tag']." - ".$allianceinfo['name']."</h1>";
include("alli_menu.tpl"); 
?>
<div class="clear"></div>
<h4 class="chartHeadline">Military events</h4>
		<div id="submenu">
			<a href="allianz.php?s=3&f=32">
				<img src="img/x.gif" class="<?php echo $_GET['f'] == 32 ? "active btn_def" : "btn_def";?>" alt="Defender" title="Defender" />
			</a>

			<a href="allianz.php?s=3&f=31">
				<img src="img/x.gif" class="<?php echo $_GET['f'] == 31 ? "active btn_off" : "btn_off";?>" alt="Attacker" title="Attacker" />
			</a>
		</div>
<?php
if($_GET['f'] == 31 || $_GET['f'] == 32) include "Templates/Alliance/attack-filtered.tpl";
else
{
		
$sql = mysqli_query($database->dblink,"SELECT * FROM ".TB_PREFIX."ndata WHERE ally = ".(int) $session->alliance." AND (ntype < 8 OR (ntype > 17 AND ntype < 22) OR (ntype = 22 AND ally = $session->alliance) OR (ntype = 23 AND ally != $session->alliance)) ORDER BY time DESC LIMIT 20");
$query = mysqli_num_rows($sql);
$outputList = '';
$name = 1;

if(!$query) $outputList .= "<td colspan=\"4\" class=\"none\">There are no reports available.</td>";
else
{

while($row = mysqli_fetch_array($sql)){ 
	$dataarray = explode(",",$row['data']);
    $id = $row["id"];
    $uid = $row["uid"];
	$toWref = $row["toWref"];
    $ally = $row["ally"];
    $topic = $row["topic"];
    $ntype = $row["ntype"];
    $data = $row["data"];
    $time = $row["time"];
    $viewed = $row["viewed"];
    $archive = $row["archive"];
	
    $outputList .= "<tr>";
	$outputList .= "<td class=\"sub\">";
	
	if($ntype >= 4 && $ntype <= 7) $type2 = 32;
	else $type2 = 31;

	$outputList .= "<a href=\"allianz.php?s=3&f=".$type2."\">";
    $type = (isset($_GET['t']) && $_GET['t'] == 5)? $archive : $ntype;
    if($type == 23) $type = 22;
    if($type >= 18 && $type <= 22){
    $outputList .= "<img src=\"gpack/travian_default/img/scouts/$type.gif\" title=\"".$topic."\" />";
	  }else{
    $outputList .= "<img src=\"img/x.gif\" class=\"iReport iReport$type\" title=\"".$topic."\">";
	}
    $outputList .= "</a>";
    $outputList .= "<div><a href=\"berichte.php?id=".$id."&aid=".$ally."\">";
    if($ntype >= 18 && $ntype <= 21) $nn = " scouts "; else $nn = " attacks ";

    $outputList .= $database->getUserField($dataarray[0], "username", 0);
       
    $outputList .= $nn;
    $outputList .= $database->getUserField($type != 22 ? $dataarray[28] : $dataarray[2], "username", 0);
	if($ntype == 0){ 
	$isoasis = $database->isVillageOases($toWref);
	if($isoasis == 0){
	if($toWref != $village->wid){
		$getUser = $database->getVillageField($toWref, "owner");
		}else{
		$getUser = $database->getVillageField($dataarray[1], "owner");
		}
    }else{
	if($toWref != $village->wid){
		$getUser = $database->getOasisField($toWref, "owner");
		}else{
		$getUser = $database->getOasisField($dataarray[1], "owner");
		}
	}
	$getUserAlly = $database->getUserField($getUser, "alliance", 0);
	}else if($ntype == 1 || $ntype == 2 || $ntype == 3 || $ntype == 18 || $ntype == 19){ 
	    $getUserAlly = $database->getUserField($type != 22 ? $dataarray[28] : $dataarray[2], "alliance", 0);
    }else{
        $getUserAlly = $database->getUserField($type != 22 ? $dataarray[28] : $dataarray[2], "alliance", 0);
    }
    $getAllyName = $database->getAllianceName($getUserAlly);
    
    if(!$getUserAlly) $allyName = "-";
    else $allyName = "<a href=\"allianz.php?aid=".$getUserAlly."\">".$getAllyName."</a>";
    
    $outputList .= "<td class=\"al\">".$allyName."</td>";
    $date = $generator->procMtime($time);
    $outputList .= "<td class=\"dat\">".$date[0]." ".date('H:i',$time)."</td>";
	$outputList .= "</tr>";
    
	$name++;
}
}
?>
<table cellpadding="1" cellspacing="1" id="offs">
<thead>
<tr>
<td>Player</td>
<td>Alliance</td>
<td>Date</td>
</tr>
</thead>

<tbody>
<?php echo $outputList; ?>
</tbody>
</table>
<?php } ?>