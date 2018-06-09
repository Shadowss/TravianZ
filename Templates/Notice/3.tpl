<?php
############################################################
##                DO NOT REMOVE THIS NOTICE               ##
##              ADVOCAITE ROCKS TRAVIANX NUTS             ##
##                     FIX BY RONIX                       ##  
##                       TRAVIANZ                         ##  
############################################################
$dataarray = explode(",",$message->readingNotice['data']);
$colspan = (isset($dataarray[184]) && $dataarray[184] > 0) ? 11 : 10;
$colspan2 = 10;

if(!isset($isAdmin)){
    $mapUrl = "karte.php?d=";
    $playerUrl = "spieler.php?uid=";
}elseif($isAdmin){
    $mapUrl = "admin.php?p=village&did=";
    $playerUrl = "admin.php?p=player&uid=";
}

//Attacker
if ($database->getUserField($dataarray[0], 'username', 0) != "[?]") {
	$user_url="<a href=\"".$playerUrl.$database->getUserField($dataarray[0], 'id', 0)."\">".$database->getUserField($dataarray[0], 'username', 0)."</a>";
}
else $user_url="<font color=\"grey\"><b>[?]</b></font>";
	

if($database->getVillageField($dataarray[1],'name') != "[?]") {
	$from_url="<a href=\"".$mapUrl.$dataarray[1]."&c=".$generator->getMapCheck($dataarray[1])."\">".$database->getVillageField($dataarray[1], 'name')."</a>";
}
else $from_url="<font color=\"grey\"><b>[?]</b></font>";

//defender
if ($database->getUserField($dataarray[28], 'username', 0) != "[?]") {
	$defuser_url="<a href=\"".$playerUrl.$database->getUserField($dataarray[28], 'id', 0)."\">".$database->getUserField($dataarray[28], 'username', 0)."</a>";
}
else $defuser_url="<font color=\"grey\"><b>[?]</b></font>";
    
if($database->isVillageOases($dataarray[29])){
    $deffrom_url="<a href=\"".$mapUrl.$dataarray[29]."&c=".$generator->getMapCheck($dataarray[29])."\">".$dataarray[30]."</a>";
}elseif($database->getVillageField($dataarray[29], 'name') != "[?]") {
    $deffrom_url="<a href=\"".$mapUrl.$dataarray[29]."&c=".$generator->getMapCheck($dataarray[29])."\">".$database->getVillageField($dataarray[29], 'name')."</a>";
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
if(isset($dataarray[184]) && $dataarray[184] > 0){
	echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
}
echo "</tr><tr><th>Troops</th>";

for($i = 3; $i <= 12; $i++) {
    if($dataarray[$i] == 0) echo "<td class=\"none\">0</td>";
    else echo "<td>".$dataarray[$i]."</td>";
}

if(isset($dataarray[184]) && $dataarray[184] > 0){
	echo "<td>$dataarray[184]</td>";
}
echo "<tr><th>Casualties</th>";
for($i = 13; $i <= 22; $i++) {
    if($dataarray[$i] == 0) echo "<td class=\"none\">0</td>";
    else echo "<td>".$dataarray[$i]."</td>";
}
if(isset($dataarray[184]) && $dataarray[184] > 0){
    if ($dataarray[185] == 0) $tdclass='class="none"'; else $tdclass='';
    echo "<td $tdclass>$dataarray[185]</td>";
}
if(array_sum(array_slice($dataarray, 186, 11)) > 0){
echo "</tr><tr><th>Prisoners</th>";

for($i = 186; $i <= 195; $i++) {
    if($dataarray[$i] == 0) echo "<td class=\"none\">0</td>";
    else echo "<td>".$dataarray[$i]."</td>"; 
}

if(isset($dataarray[184]) && $dataarray[184] > 0){
    if ($dataarray[196] == 0) $tdclass='class="none"'; else $tdclass='';
    echo "<td $tdclass>$dataarray[196]</td>";
}
}  
if (!empty($dataarray[198]) && !empty($dataarray[199])){ //ram
?>
	<tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
	<img class="unit u<?php echo $dataarray[198]; ?>" src="img/x.gif" alt="Ram" title="Ram" />
	<?php echo $dataarray[199]; ?>
    </td></tr></tbody>
<?php } 
if (!empty($dataarray[200]) && !empty($dataarray[201])){ //cata
?>
	<tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
	<img class="unit u<?php echo $dataarray[200]; ?>" src="img/x.gif" alt="Catapult" title="Catapult" />
	<?php echo $dataarray[201]; ?>
    </td></tr></tbody>
<?php }
if (!empty($dataarray[202]) && !empty($dataarray[203])){ //chief
?>
	<tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
	<img class="unit u<?php echo $dataarray[202]; ?>" src="img/x.gif" alt="Chief" title="Chief" />
	<?php echo $dataarray[203]; ?>
    </td></tr></tbody>
<?php }
if (!empty($dataarray[205]) && !empty($dataarray[206])){ //hero
?>
	<tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
	<img class="unit u<?php echo $dataarray[205]; ?>" src="img/x.gif" alt="Hero" title="Hero" />
	<?php echo $dataarray[206]; ?>
    </td></tr></tbody>
<?php }
if(isset($dataarray[204]) && !empty($dataarray[204])){ //No troops returned
?>	
	<tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
	<?php echo $dataarray[204]; ?>
    </td></tr></tbody>
<?php }?>
</td></tr></tbody>
</table>
	
<?php
$target = $dataarray[34] - 1;
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