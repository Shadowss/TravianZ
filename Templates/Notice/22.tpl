<?php
$dataarray = explode(",",$message->readingNotice['data']);
$colspan = (isset($dataarray[14]) && $dataarray[14] > 0) ? 11 : 10;

if($dataarray[15] == 1){
$message1 = "".$database->getUserField($dataarray[0], "username", 0)." visited ".$database->getUserField($dataarray[2],"username",0)."'s troops";
}else if($dataarray[15] == 2){
$message1 = "".$database->getUserField($dataarray[0], "username", 0)." wishes you Merry Christmas";
}else if($dataarray[15] == 3){
$message1 = "".$database->getUserField($dataarray[0], "username", 0)." wishes you Happy New Year";
}else{
$message1 = "".$database->getUserField($dataarray[0], "username", 0)." wishes you Happy Easter";
}
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
					<td>on <span><?php echo $date[0]." at ".$date[1]; ?></span> <span>hour</span></td>
				</tr>
			</thead>
			<tbody>
				<tr><td colspan="2" class="empty"></td></tr>
				<tr><td colspan="2" class="report_content">
		<table cellpadding="1" cellspacing="1" class="attacker"><thead>
<tr>
<td class="role">Attacker</td>
<td colspan="<?php echo $colspan ?>"><a href="spieler.php?uid=<?php echo $database->getUserField($dataarray[0],"id",0); ?>"><?php echo $database->getUserField($dataarray[0],"username",0); ?></a> from the village <a href="karte.php?d=<?php echo $dataarray[1]."&amp;c=".$generator->getMapCheck($dataarray[1]); ?>"><?php echo $database->getVillageField($dataarray[1],"name"); ?></a></td>
</tr>
</thead>
<tbody class="units">
<tr>
<td>&nbsp;</td>
<?php
$tribe = $dataarray[3];
$start = ($tribe - 1) * 10 + 1;
for($i = $start; $i <= ($start + 9); $i++) {
	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
}
if(isset($dataarray[14]) && $dataarray[14] > 0){
	echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
}
echo "</tr><tr><th>Troops</th>";

for($i = 4; $i <= 13; $i++) {
    if($dataarray[$i] == 0) echo "<td class=\"none\">0</td>";
    else echo "<td>".$dataarray[$i]."</td>";
}

if(isset($dataarray[14]) && $dataarray[14] > 0){
	echo "<td>$dataarray[14]</td>";
}
?>
</tbody>
	<tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
	<img src="<?php echo GP_LOCATE; ?>img/r/<?php echo (["peace", "xmas", "newy", "easter"])[$dataarray[15]-1]; ?>.gif" alt="Peace" title="Peace" />
	<?php echo $message1; ?>
    </td></tr></tbody>
</table>
</td></tr></tbody></table>