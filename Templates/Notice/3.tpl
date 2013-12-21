<?php
############################################################
##                DO NOT REMOVE THIS NOTICE               ##
##              ADVOCAITE ROCKS TRAVIANX NUTS             ##
##                     FIX BY RONIX                       ##  
##                       TRAVIANZ                         ##  
############################################################
$dataarray = explode(",",$message->readingNotice['data']);
if(isset($dataarray[151]) and $dataarray[151]!=0){$colspan="11";}else{$colspan="10";}
$colspan2 = 10;
//attacker
if ($database->getUserField($dataarray[0],'username',0)!="??") {
	$user_url="<a href=\"spieler.php?uid=".$database->getUserField($dataarray[0],'id',0)."\">".$database->getUserField($dataarray[0],'username',0)."</a>";
}else{
	$user_url="<font color=\"grey\"><b>??</b></font>";
}
if($database->getVillageField($dataarray[1],'name')!="??") {
	$from_url="<a href=\"karte.php?d=".$dataarray[1]."&c=".$generator->getMapCheck($dataarray[1])."\">".$database->getVillageField($dataarray[1],'name')."</a>";
}else{
	$from_url="<font color=\"grey\"><b>??</b></font>";
}
//defender
if ($database->getUserField($dataarray[28],'username',0)!="??") {
	$defuser_url="<a href=\"spieler.php?uid=".$database->getUserField($dataarray[28],'id',0)."\">".$database->getUserField($dataarray[28],'username',0)."</a>";
}else{
	$defuser_url="<font color=\"grey\"><b>??</b></font>";
}
if($database->isVillageOases($dataarray[29])){
    $deffrom_url="<a href=\"karte.php?d=".$dataarray[29]."&c=".$generator->getMapCheck($dataarray[29])."\">".$dataarray[30]."</a>";
}elseif($database->getVillageField($dataarray[29],'name')!="??") {
    $deffrom_url="<a href=\"karte.php?d=".$dataarray[29]."&c=".$generator->getMapCheck($dataarray[29])."\">".$database->getVillageField($dataarray[29],'name')."</a>";
}else{
    $deffrom_url="<font color=\"grey\"><b>??</b></font>";
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
					<td>on <?php echo $date[0]."<span> at ".$date[1]; ?></span> <span>hour</span></td>
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
$start = ($tribe-1)*10+1;
for($i=$start;$i<=($start+9);$i++) {
	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
}
if(isset($dataarray[151]) and $dataarray[151]!=0){
	echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
}
echo "</tr><tr><th>Troops</th>";
for($i=3;$i<=12;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\">0</td>";
    }
    else {
    	echo "<td>".$dataarray[$i]."</td>";
    }
}
if(isset($dataarray[151]) and $dataarray[151]!=0){
	echo "<td>$dataarray[151]</td>";
}
echo "<tr><th>Casualties</th>";
for($i=13;$i<=22;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\">0</td>";
    }
    else {
    	echo "<td>".$dataarray[$i]."</td>";
    }
}
if(isset($dataarray[151]) and $dataarray[151]!=0){
    if ($dataarray[152]==0) $tdclass='class="none"'; else $tdclass='';
    echo "<td $tdclass>$dataarray[152]</td>";
}
if($dataarray[153] != 0 or $dataarray[154] != 0 or $dataarray[155] != 0 or $dataarray[156] != 0 or $dataarray[157] != 0 or $dataarray[158] != 0 or $dataarray[159] != 0 or $dataarray[160] != 0 or $dataarray[161] != 0 or $dataarray[162] != 0 or $dataarray[163] != 0){
echo "</tr><tr><th>Prisoners</th>";
for($i=153;$i<=162;$i++) {
    if($dataarray[$i] == 0) {
        echo "<td class=\"none\">0</td>";
    }
    else {
        echo "<td>".$dataarray[$i]."</td>";
    }
}
if(isset($dataarray[151]) and $dataarray[151]!=0){
    if ($dataarray[163]==0) $tdclass='class="none"'; else $tdclass='';
    echo "<td $tdclass>$dataarray[163]</td>";
}
}  
if ($dataarray[165]!='' and $dataarray[166]!=''){ //ram
?>
	<tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
	<img class="unit u<?php echo $dataarray[165]; ?>" src="img/x.gif" alt="Ram" title="Ram" />
	<?php echo $dataarray[166]; ?>
    </td></tr></tbody>
<?php } 
if ($dataarray[167]!='' and $dataarray[168]!=''){ //cata
?>
	<tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
	<img class="unit u<?php echo $dataarray[167]; ?>" src="img/x.gif" alt="Catapult" title="Catapult" />
	<?php echo $dataarray[168]; ?>
    </td></tr></tbody>
<?php }
if ($dataarray[169]!='' and $dataarray[170]!=''){ //chief
?>
	<tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
	<img class="unit u<?php echo $dataarray[169]; ?>" src="img/x.gif" alt="Chief" title="Chief" />
	<?php echo $dataarray[170]; ?>
    </td></tr></tbody>
<?php }
if ($dataarray[172]!='' and $dataarray[173]!=''){ //hero
?>
	<tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
	<img class="unit u<?php echo $dataarray[172]; ?>" src="img/x.gif" alt="Hero" title="Hero" />
	<?php echo $dataarray[173]; ?>
    </td></tr></tbody>
<?php }
if(isset($dataarray[171]) && $dataarray[171] !=''){ //troop not return
?>	
	<tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
	<?php echo $dataarray[171]; ?>
    </td></tr></tbody>
<?php }?>
</td></tr></tbody>
</table>
	
<?php
$targettribe=$dataarray['31'];


if ($dataarray[31]=='1'){
$start=1; ?>	
	<table cellpadding="1" cellspacing="1" class="defender">
	<thead>
	<tr>
	<td class="role">Defender</th>
	<td colspan="<?php echo $colspan2; ?>"><?php if($targettribe=='1'){ echo $defuser_url." from the village ".$deffrom_url; } else { echo"Reinforcement"; } ?></td>	
	</tr></thead>
	<tbody class="units">
	<tr>
	<td>&nbsp;</td>
	
	
	<?php
for($i=$start;$i<=($start+9);$i++) {
	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
}
echo "</tr><tr><th>Troops</th>";
for($i=35;$i<=44;$i++) {
	if($dataarray[$i] == "?") {
        echo "<td class=\"none\">?</td>";
    }
    else {
        echo "<td class=\"none\">?</td>";
    }
}
echo "<tr><th>Casualties</th>";
for($i=45;$i<=54;$i++) {
	if($dataarray[$i] == "?") {
        echo "<td class=\"none\">?</td>";
    }
    else {
        echo "<td class=\"none\">?</td>";
    }
}
?>
</tr></tbody></table>

<?php } 
if ($dataarray[31]=='2'){ 
$start=11;?>	
	<table cellpadding="1" cellspacing="1" class="defender">
	<thead>
	<tr>
	<td class="role">Defender</th>
	<td colspan="<?php echo $colspan2; ?>"><?php if($targettribe=='2'){ echo $defuser_url." from the village ".$deffrom_url; } else { echo"Reinforcement"; } ?></td>	
	</tr></thead>
	<tbody class="units">
	<tr>
	<td>&nbsp;</td>
	
	
<?php
for($i=$start;$i<=($start+9);$i++) {
	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
}
echo "</tr><tr><th>Troops</th>";
for($i=56;$i<=65;$i++) {
	if($dataarray[$i] == "?") {
        echo "<td class=\"none\">?</td>";
    }
    else {
        echo "<td class=\"none\">?</td>";
    }
}
echo "<tr><th>Casualties</th>";
for($i=66;$i<=75;$i++) {
	if($dataarray[$i] == "?") {
        echo "<td class=\"none\">?</td>";
    }
    else {
        echo "<td class=\"none\">?</td>";
    }
}
?>
</tr></tbody></table>
<?php } ?>
<?php  if ($dataarray[31]=='3'){
$start=21; ?>	
	<table cellpadding="1" cellspacing="1" class="defender">
	<thead>
	<tr>
	<td class="role">Defender</th>
	<td colspan="<?php echo $colspan2; ?>"><?php if($targettribe=='3'){ echo $defuser_url." from the village ".$deffrom_url; } else { echo"Reinforcement"; } ?></td>	
	</tr></thead>
	<tbody class="units">
	<tr>
	<td>&nbsp;</td>
	
	
	<?php
for($i=$start;$i<=($start+9);$i++) {
	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
}
echo "</tr><tr><th>Troops</th>";
for($i=77;$i<=86;$i++) {
	if($dataarray[$i] == "?") {
        echo "<td class=\"none\">?</td>";
    }
    else {
        echo "<td class=\"none\">?</td>";
    }
}
echo "<tr><th>Casualties</th>";
for($i=87;$i<=96;$i++) {
	if($dataarray[$i] == "?") {
        echo "<td class=\"none\">?</td>";
    }
    else {
        echo "<td class=\"none\">?</td>";
    }
}
?>
</tr></tbody></table>

<?php } ?>
<?php  if ($dataarray[31]=='4'){ 
$start=31; ?>	
	<table cellpadding="1" cellspacing="1" class="defender">
	<thead>
	<tr>
	<td class="role">Defender</th>
	<td colspan="10"><?php if($targettribe=='4'){ echo'<a href="spieler.php?uid=">'.$database->getUserField($dataarray[28],"username",0).'</a> from the village <a href="karte.php?d='.$dataarray[29].'&amp;c='.$generator->getMapCheck($dataarray[29]).'">'.stripslashes($dataarray[30]).'</a>'; } else { echo"Reinforcement"; } ?></td>
	</tr></thead>
	<tbody class="units">
	<tr>
	<td>&nbsp;</td>
	
	
	<?php
for($i=$start;$i<=($start+9);$i++) {
	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
}
echo "</tr><tr><th>Troops</th>";
for($i=98;$i<=107;$i++) {
	if($dataarray[$i] == "?") {
        echo "<td class=\"none\">?</td>";
    }
    else {
        echo "<td class=\"none\">?</td>";
    }
}
echo "<tr><th>Casualties</th>";
for($i=108;$i<=117;$i++) {
	if($dataarray[$i] == "?") {
        echo "<td class=\"none\">?</td>";
    }
    else {
        echo "<td class=\"none\">?</td>";
    }
}
?>
</tr></tbody></table>

<?php } ?>
<?php  if ($dataarray[31]=='5'){
$start=41; ?>	
	<table cellpadding="1" cellspacing="1" class="defender">
	<thead>
	<tr>
	<td class="role">Defender</th>
	<td colspan="10"><?php if($targettribe=='5'){ echo $defuser_url." from the village ".$deffrom_url; } else { echo"Reinforcement"; } ?></td>	
	</tr></thead>
	<tbody class="units">
	<tr>
	<td>&nbsp;</td>
	
	
	<?php
for($i=$start;$i<=($start+9);$i++) {
	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
}
echo "</tr><tr><th>Troops</th>";
for($i=119;$i<=128;$i++) {
	if($dataarray[$i] == "?") {
        echo "<td class=\"none\">?</td>";
    }
    else {
        echo "<td class=\"none\">?</td>";
    }
}
echo "<tr><th>Casualties</th>";
for($i=129;$i<=138;$i++) {
	if($dataarray[$i] == "?") {
        echo "<td class=\"none\">?</td>";
    }
    else {
        echo "<td class=\"none\">?</td>";
    }
}
?>
</tr></tbody></table>

<?php } ?>
</td></tr></tbody></table>
