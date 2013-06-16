<?php
$prefix = "".TB_PREFIX."ndata";
$limit = "ntype!=1 AND ntype!=2 AND ntype!=3 AND ntype!=8 AND ntype!=9 AND ntype!=10 AND ntype!=11 AND ntype!=12 AND ntype!=13 AND ntype!=14 AND ntype!=15 AND ntype!=16 AND ntype!=17 AND ntype!=18 AND ntype!=19";
$sql = mysql_query("SELECT * FROM $prefix WHERE ally = $session->alliance AND $limit ORDER BY time DESC LIMIT 20");
$query = mysql_num_rows($sql);
$outputList = '';
$name = 1;
if($query == 0) {
    $outputList .= "<td colspan=\"4\" class=\"none\">There are no reports available.</td>";
}else{
while($row = mysql_fetch_array($sql)){ 
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
if($ntype==4 || $ntype==5 || $ntype==6 || $ntype==7){
    $type2 = '32';
}else{
    $type2 = '31';
}
	$outputList .= "<a href=\"allianz.php?s=3&f=".$type2."\">";
    $type = (isset($_GET['t']) && $_GET['t'] == 5)? $archive : $ntype;
	if($type==20 or $type==21){
    $outputList .= "<img src=\"gpack/travian_default/img/scouts/$type.gif\" title=\"".$topic."\" />";
	  }else{
    $outputList .= "<img src=\"img/x.gif\" class=\"iReport iReport$type\" title=\"".$topic."\">";
	}
    $outputList .= "</a>";
    $outputList .= "<div><a href=\"berichte.php?id=".$id."&aid=".$ally."\">";
    if($ntype==0){ $nn = " scouts "; }else{ $nn = " attacks "; }

    $outputList .= $database->getUserField($dataarray[0],username,0);
       
    $outputList .= $nn;
    $outputList .= $database->getUserField($dataarray[28],username,0);
    $getUserAlly = $database->getUserField($dataarray[0],alliance,0);
    $getAllyName = $database->getAllianceName($getUserAlly);
    
    if($getUserAlly==$session->alliance || !$getUserAlly){
    	$allyName = "-";
    }else{
    	$allyName = "<a href=\"allianz.php?aid=".$getUserAlly."\">".$getAllyName."</a>";
    }
    
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