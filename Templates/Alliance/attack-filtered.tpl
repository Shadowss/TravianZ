<?php
$filterType = $_GET['f'];
if($filterType == 31) $sql = mysqli_query($database->dblink,"SELECT * FROM ".TB_PREFIX."ndata WHERE ally = ".(int) $session->alliance." AND (ntype != 0 AND ntype < 4 OR ntype > 17 AND ntype != 20 AND ntype != 21 AND ntype != 22) ORDER BY time DESC LIMIT 20");
elseif($filterType == 32) $sql = mysqli_query($database->dblink,"SELECT * FROM ".TB_PREFIX."ndata WHERE ally = ".(int) $session->alliance." AND (ntype < 1 OR ntype > 3 AND ntype < 8 OR ntype > 19) AND ntype != 22 ORDER BY time DESC LIMIT 20");
    
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
    if((($type == 18 || $type == 19) && $filterType == 31) || (($type == 20 || $type == 21) && $filterType == 32) || $type == 22){
    $outputList .= "<img src=\"gpack/travian_default/img/scouts/$type.gif\" title=\"".$topic."\" />";
	}else{
    $outputList .= "<img src=\"img/x.gif\" class=\"iReport iReport$type\" title=\"".$topic."\">";
	}
    $outputList .= "</a>";
    $outputList .= "<div><a href=\"berichte.php?id=".$id."&aid=".$ally."\">";
    if((($type == 18 || $type == 19) && $filterType == 31) || (($type == 20 || $type == 21) && $filterType == 32)) $nn = " scouts "; else $nn = " attacks "; 

    $outputList .= $database->getUserField($dataarray[0], "username", 0);
       
    $outputList .= $nn;
    $outputList .= $database->getUserField($type != 22 && $type != 23 ? $dataarray[28] : $dataarray[2], "username", 0);
    $getUserAlly = $database->getUserField($type != 22 && $type != 23 ? $dataarray[28] : $dataarray[2], "alliance", 0);
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