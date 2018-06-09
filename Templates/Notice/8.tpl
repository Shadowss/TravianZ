<?php
$dataarray = explode(",",$message->readingNotice['data']);
$colspan = (!empty($dataarray[13]) && $dataarray[13] > 0) ? 11 : 10;

if(!isset($isAdmin)){
    $mapUrl = "karte.php?d=";
    $playerUrl = "spieler.php?uid=";
}elseif($isAdmin){
    $mapUrl = "admin.php?p=village&did=";
    $playerUrl = "admin.php?p=player&uid=";
}

if ($database->getUserField($dataarray[1], 'username', 0) != "[?]" || $dataarray[1] == 0) {
    $user_url="<a href=\"".$playerUrl.$database->getUserField($dataarray[1], "id", 0)."\">".($dataarray[1] == 0 ? "taskmaster" : $database->getUserField($dataarray[1], 'username', 0))."</a>";
}
else $user_url="<font color=\"grey\"><b>[?]</b></font>";

if($database->getVillageField($dataarray[0],'name') != "[?]" || $dataarray[0] == 0) {
     $from_url=($dataarray[0] == 0)? "village of the elders" : "<a href=\"".$mapUrl.$dataarray[0]."&c=".$generator->getMapCheck($dataarray[0])."\">".$database->getVillageField($dataarray[0], 'name')."</a>";
}
else $from_url="<font color=\"grey\"><b>[?]</b></font>";
?>
<table cellpadding="1" cellspacing="1" id="report_surround">
			<thead>
				<tr>
					<th>Subject:</th>
					<th><?php echo $message->readingNotice['topic']; ?></th>
				</tr>
 
				<tr>
                <?php
                $date = $generator->procMtime($message->readingNotice['time']); ?>
					<td class="sent">Sent:</td>
					<td>on <span><?php echo $date[0]." at ".$date[1]; ?></span><span> </span></td>
				</tr>
			</thead>
			<tbody>
				<tr><td colspan="2" class="empty"></td></tr>
				<tr><td colspan="2" class="report_content">
		<table cellpadding="1" cellspacing="1" id="reinforcement">
		
<thead><tr>
<td class="role">sender</td><td colspan="<?php echo $colspan ?>"><?php echo $user_url;?> from the village <?php echo $from_url;?></td></tr></thead>
<tbody class="units"><tr>
<td>&nbsp;</td>
<?php
$tribe = $dataarray[2];
$start = ($tribe - 1) * 10 + 1;
for($i = $start; $i <= ($start + 9); $i++) {
	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
}
if($dataarray[13] > 0) echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" /></td>";

echo "</tr><tr><th>Troops</th>";
for($i = 3; $i < 13; $i++) {
    $unitarray['u'.($i - 3 + $start)] = $dataarray[$i];

    if($dataarray[$i] == 0) echo "<td class=\"none\">0</td>"; 
    else echo "<td>".$dataarray[$i]."</td>";

}
if($dataarray[13] > 0) {
    echo "<td>".$dataarray[13]."</td>";
    $unitarray['hero'] = 1;
}
	
?></tr></tbody>
<tbody class="infos"><tr><th>upkeep</th><td colspan="11">
<?php echo $technology->getUpkeep($unitarray, $dataarray[2]); ?><img src="img/x.gif" class="r4" title="Crop" alt="Crop" />per hour</td>
</tr></tbody>
</table></td></tr></tbody></table>