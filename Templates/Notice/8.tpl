<?php
$dataarray = explode(",",$message->readingNotice['data']);
if($dataarray[13]!='' or $dataarray!=0){$colspan="11";}else{$colspan="10";}
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
					<td>on <?php echo $date[0]."<span> at ".$date[1]; ?></span><span> </span></td>
				</tr>
			</thead>
			<tbody>
				<tr><td colspan="2" class="empty"></td></tr>
				<tr><td colspan="2" class="report_content">
		<table cellpadding="1" cellspacing="1" id="reinforcement">
		
<thead><tr>
<td class="role">sender</td><td colspan="<?php echo $colspan; ?>"><a href="spieler.php?uid=<?php echo $database->getUserField($dataarray[1],"id",0); ?>"><?php echo ($dataarray[1] == 0)? "taskmaster" : $database->getUserField($dataarray[1],"username",0); ?></a> from the village <?php echo ($dataarray[0] == 0)? "village of the elders" : "<a href='karte.php?d=".$dataarray[0]."&amp;c=".$generator->getMapCheck($dataarray[0])."'>".$database->getVillageField($dataarray[0],name)."</a>"; ?></td></tr></thead>
<tbody class="units"><tr>
<td>&nbsp;</td>
<?php
$tribe = $dataarray[2];
$start = ($tribe-1)*10+1;
for($i=$start;$i<=($start+9);$i++) {
	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
}
if($dataarray[13]!=0){
echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" /></td>";
}
echo "</tr><tr><th>Troops</th>";
for($i=3;$i<13;$i++) {
$unitarray['u'.($i-3+$start).''] = $dataarray[$i];
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\">0</td>";
    }
    else {
    echo "<td>".$dataarray[$i]."</td>";
    }
}
if($dataarray[13] != 0) {
	echo "<td>".$dataarray[13]."</td>";
	$unitarray['hero'] = 1;
}
	
?></tr></tbody>
<tbody class="infos"><tr><th>upkeep</th><td colspan="11">
<?php echo $technology->getUpkeep($unitarray,$dataarray[2]); ?><img src="img/x.gif" class="r4" title="Crop" alt="Crop" />per hour</td>
</tr></tbody>
</table></td></tr></tbody></table>
