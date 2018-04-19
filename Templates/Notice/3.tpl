<?php
############################################################
##                DO NOT REMOVE THIS NOTICE               ##
##              ADVOCAITE ROCKS TRAVIANX NUTS             ##
##                     FIX BY RONIX                       ##  
##                       TRAVIANZ                         ##  
############################################################
$dataarray = explode(",",$message->readingNotice['data']);
$colspan = (isset($dataarray[173]) && $dataarray[173] > 0) ? 11 : 10;
$colspan2 = 10;

//Attacker
if ($database->getUserField($dataarray[0], 'username', 0) != "[?]") {
	$user_url="<a href=\"spieler.php?uid=".$database->getUserField($dataarray[0], 'id', 0)."\">".$database->getUserField($dataarray[0], 'username', 0)."</a>";
}
else $user_url="<font color=\"grey\"><b>[?]</b></font>";
	

if($database->getVillageField($dataarray[1],'name') != "[?]") {
	$from_url="<a href=\"karte.php?d=".$dataarray[1]."&c=".$generator->getMapCheck($dataarray[1])."\">".$database->getVillageField($dataarray[1], 'name')."</a>";
}
else $from_url="<font color=\"grey\"><b>[?]</b></font>";

//defender
if ($database->getUserField($dataarray[28], 'username', 0) != "[?]") {
	$defuser_url="<a href=\"spieler.php?uid=".$database->getUserField($dataarray[28], 'id', 0)."\">".$database->getUserField($dataarray[28], 'username', 0)."</a>";
}
else $defuser_url="<font color=\"grey\"><b>[?]</b></font>";
    
if($database->isVillageOases($dataarray[29])){
    $deffrom_url="<a href=\"karte.php?d=".$dataarray[29]."&c=".$generator->getMapCheck($dataarray[29])."\">".$dataarray[30]."</a>";
}elseif($database->getVillageField($dataarray[29], 'name') != "[?]") {
    $deffrom_url="<a href=\"karte.php?d=".$dataarray[29]."&c=".$generator->getMapCheck($dataarray[29])."\">".$database->getVillageField($dataarray[29], 'name')."</a>";
}
else $deffrom_url="<font color=\"grey\"><b>[?]</b></font>";
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
		<table cellpadding="1" cellspacing="1" id="attacker"><thead>
<tr>
<td class="role">Attacker</td>
<td colspan="<?php echo $colspan ?>"><?php echo $user_url;?> from the village <?php echo $from_url;?></td>
</tr>
</thead>
<tbody class="units">
<tr>
<td>&nbsp;</td>
<?php
$tribe = $dataarray[2];
$start = ($tribe - 1) * 10 + 1;
for($i = $start; $i <= ($start + 9); $i++) {
	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
}
if(isset($dataarray[173]) && $dataarray[173] > 0){
	echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
}
echo "</tr><tr><th>Troops</th>";

for($i = 3; $i <= 12; $i++) {
    if($dataarray[$i] == 0) echo "<td class=\"none\">0</td>";
    else echo "<td>".$dataarray[$i]."</td>";
}

if(isset($dataarray[173]) && $dataarray[173] > 0){
	echo "<td>$dataarray[173]</td>";
}
echo "<tr><th>Casualties</th>";
for($i = 13; $i <= 22; $i++) {
    if($dataarray[$i] == 0) echo "<td class=\"none\">0</td>";
    else echo "<td>".$dataarray[$i]."</td>";
}
if(isset($dataarray[173]) && $dataarray[173] > 0){
    if ($dataarray[174] == 0) $tdclass='class="none"'; else $tdclass='';
    echo "<td $tdclass>$dataarray[174]</td>";
}
if($dataarray[175] > 0 || $dataarray[176] > 0 || $dataarray[177] > 0 || $dataarray[178] > 0 || $dataarray[179] > 0 || $dataarray[180] > 0 || $dataarray[181] > 0 || $dataarray[182] > 0 || $dataarray[183] > 0 || $dataarray[184] > 0 || $dataarray[185] > 0){
echo "</tr><tr><th>Prisoners</th>";

for($i = 175; $i <= 184; $i++) {
    if($dataarray[$i] == 0) echo "<td class=\"none\">0</td>";
    else echo "<td>".$dataarray[$i]."</td>"; 
}

if(isset($dataarray[173]) && $dataarray[173] > 0){
    if ($dataarray[185]==0) $tdclass='class="none"'; else $tdclass='';
    echo "<td $tdclass>$dataarray[185]</td>";
}
}  
if (!empty($dataarray[187]) && !empty($dataarray[188])){ //ram
?>
	<tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
	<img class="unit u<?php echo $dataarray[187]; ?>" src="img/x.gif" alt="Ram" title="Ram" />
	<?php echo $dataarray[188]; ?>
    </td></tr></tbody>
<?php } 
if (!empty($dataarray[189]) && !empty($dataarray[190])){ //cata
?>
	<tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
	<img class="unit u<?php echo $dataarray[189]; ?>" src="img/x.gif" alt="Catapult" title="Catapult" />
	<?php echo $dataarray[190]; ?>
    </td></tr></tbody>
<?php }
if (!empty($dataarray[191]) && !empty($dataarray[192])){ //chief
?>
	<tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
	<img class="unit u<?php echo $dataarray[191]; ?>" src="img/x.gif" alt="Chief" title="Chief" />
	<?php echo $dataarray[192]; ?>
    </td></tr></tbody>
<?php }
if (!empty($dataarray[194]) && !empty($dataarray[195])){ //hero
?>
	<tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
	<img class="unit u<?php echo $dataarray[194]; ?>" src="img/x.gif" alt="Hero" title="Hero" />
	<?php echo $dataarray[195]; ?>
    </td></tr></tbody>
<?php }
if(isset($dataarray[193]) && !empty($dataarray[193])){ //No troops returned
?>	
	<tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
	<?php echo $dataarray[193]; ?>
    </td></tr></tbody>
<?php }?>
</td></tr></tbody>
</table>
	
<?php
$target = $dataarray[33] - 1;
$start = ($target * 10) + 1;
$troopsStart = ($target * 21) + 35;
?>
<table cellpadding="1" cellspacing="1" class="defender">
<thead>
<tr>
<td class="role">Defender</td>
<td colspan="<?php echo $colspan2; ?>"><?php echo $defuser_url." from the village ".$deffrom_url; ?></td>	
</tr></thead>
<tbody class="units">
<tr>
<td>&nbsp;</td>

<?php
for($i = $start; $i <= ($start + 9); $i++)
{
	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
}
echo "</tr><tr><th>Troops</th>";
for($i = $troopsStart; $i <= $troopsStart + 9; $i++) echo "<td class=\"none\">?</td>";

echo "<tr><th>Casualties</th>";
for($i = $troopsStart + 10; $i <= $troopsStart + 19; $i++) echo "<td class=\"none\">?</td>";
?>
</tr></tbody></table>
</td></tr></tbody></table>