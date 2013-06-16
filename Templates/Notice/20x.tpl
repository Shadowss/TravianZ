<?php
$topic = $database->getNotice2($_GET['id'], 'topic');
$time = $database->getNotice2($_GET['id'], 'time');
$data = $database->getNotice2($_GET['id'], 'data');
$dataarray = explode(",",$data);
?>
<table cellpadding="1" cellspacing="1" id="report_surround">
			<thead>
				<tr>
					<th>Subject:</th>
					<th><?php echo $topic; ?></th>
				</tr>
 
				<tr>
					<?php
                $date = $generator->procMtime($time); ?>
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
<td colspan="10"><a href="spieler.php?uid=<?php echo $database->getUserField($dataarray[0],"id",0); ?>"><?php echo $database->getUserField($dataarray[0],"username",0); ?></a> from the village <a href="karte.php?d=<?php echo $dataarray[1]."&amp;c=".$generator->getMapCheck($dataarray[1]); ?>"><?php echo $database->getVillageField($dataarray[1],"name"); ?></a></td>
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
echo "</tr><tr><th>Troops</th>";
for($i=3;$i<=12;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\">0</td>";
    }
    else {
    	echo "<td>".$dataarray[$i]."</td>";
    }
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
if($dataarray[152] != 0 or $dataarray[153] != 0 or $dataarray[154] != 0 or $dataarray[155] != 0 or $dataarray[156] != 0 or $dataarray[157] != 0 or $dataarray[158] != 0 or $dataarray[159] != 0 or $dataarray[160] != 0 or $dataarray[161] != 0){
echo "</tr><tr><th>Prisoners</th>";
for($i=152;$i<=161;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\">0</td>";
    }
    else {
    	echo "<td>".$dataarray[$i]."</td>";
    }
}
if(isset($dataarray[147]) and $dataarray[147]!=0){
	if ($dataarray[161]==0){$tdclass='class="none"';}
	echo "<td $tdclass>$dataarray[161]</td>";
}
}
echo "</tr></tbody>";
if ($dataarray[139]!='' and $dataarray[140]!=''){ //ram
?>
	<tbody class="goods"><tr><th>Information</th><td colspan="10">
	<img class="unit u<?php echo $dataarray[139]; ?>" src="img/x.gif" alt="Ram" title="Ram" />
	<?php echo $dataarray[140]; ?>
    </td></tr></tbody>
<?php } 
if ($dataarray[141]!='' and $dataarray[142]!=''){ //cata
?>
	<tbody class="goods"><tr><th>Information</th><td colspan="10">
	<img class="unit u<?php echo $dataarray[141]; ?>" src="img/x.gif" alt="Catapult" title="Catapult" />
	<?php echo $dataarray[142]; ?>
    </td></tr></tbody>
<?php }
if ($dataarray[143]!='' and $dataarray[144]!=''){ //chief
?>
	<tbody class="goods"><tr><th>Information</th><td colspan="10">
	<img class="unit u<?php echo $dataarray[143]; ?>" src="img/x.gif" alt="Chief" title="Chief" />
	<?php echo $dataarray[144]; ?>
    </td></tr></tbody>
<?php } ?>
<?php if ($dataarray[145]!='' and $dataarray[146]!=''){ //spy
?>
    <tbody class="goods"><tr><th>Information</th><td colspan="10">
    
    <?php echo $dataarray[146]; ?>
    </td></tr></tbody>
<?php } ?>
</table>
	
<?php
$targettribe=$dataarray['31'];


if ($dataarray[34]=='1'){
$start=1; ?>	
	<table cellpadding="1" cellspacing="1" class="defender">
	<thead>
	<tr>
	<td class="role">Defender</th>
	<td colspan="10"><?php if($targettribe=='1'){ echo'<a href="spieler.php?uid='.$database->getUserField($dataarray[28],"id",0).'">'.$database->getUserField($dataarray[28],"username",0).'</a> from the village <a href="karte.php?d='.$dataarray[29].'&amp;c='.$generator->getMapCheck($dataarray[29]).'">'.stripslashes($dataarray[30]).'</a>'; } else { echo"Reinforcement"; } ?></td>
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
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\">0</td>";
    }
    else {
    	echo "<td>".$dataarray[$i]."</td>";
    }
}
echo "<tr><th>Casualties</th>";
for($i=45;$i<=54;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\">0</td>";
    }
    else {
    	echo "<td>".$dataarray[$i]."</td>";
    }
}
?>
</tr></tbody></table>

<?php } 
if ($dataarray[55]=='1'){ 
$start=11;?>	
	<table cellpadding="1" cellspacing="1" class="defender">
	<thead>
	<tr>
	<td class="role">Defender</th>
	<td colspan="10"><?php if($targettribe=='2'){ echo'<a href="spieler.php?uid='.$database->getUserField($dataarray[28],"id",0).'">'.$database->getUserField($dataarray[28],"username",0).'</a> from the village <a href="karte.php?d='.$dataarray[29].'&amp;c='.$generator->getMapCheck($dataarray[29]).'">'.stripslashes($dataarray[30]).'</a>'; } else { echo"Reinforcement"; } ?></td>
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
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\">0</td>";
    }
    else {
    	echo "<td>".$dataarray[$i]."</td>";
    }
}
echo "<tr><th>Casualties</th>";
for($i=66;$i<=75;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\">0</td>";
    }
    else {
    	echo "<td>".$dataarray[$i]."</td>";
    }
}
?>
</tr></tbody></table>
<?php } ?>
<?php  if ($dataarray[76]=='1'){
$start=21; ?>	
	<table cellpadding="1" cellspacing="1" class="defender">
	<thead>
	<tr>
	<td class="role">Defender</th>
	<td colspan="10"><?php if($targettribe=='3'){ echo'<a href="spieler.php?uid='.$database->getUserField($dataarray[28],"id",0).'">'.$database->getUserField($dataarray[28],"username",0).'</a> from the village <a href="karte.php?d='.$dataarray[29].'&amp;c='.$generator->getMapCheck($dataarray[29]).'">'.stripslashes($dataarray[30]).'</a>'; } else { echo"Reinforcement"; } ?></td>
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
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\">0</td>";
    }
    else {
    	echo "<td>".$dataarray[$i]."</td>";
    }
}
echo "<tr><th>Casualties</th>";
for($i=87;$i<=96;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\">0</td>";
    }
    else {
    	echo "<td>".$dataarray[$i]."</td>";
    }
}
?>
</tr></tbody></table>

<?php } ?>
<?php  if ($dataarray[97]=='1'){ 
$start=31; ?>	
	<table cellpadding="1" cellspacing="1" class="defender">
	<thead>
	<tr>
	<td class="role">Defender</th>
	<td colspan="10"><?php if($targettribe=='4'){ echo'<a href="spieler.php?uid='.$database->getUserField($dataarray[28],"id",0).'">'.$database->getUserField($dataarray[28],"username",0).'</a> from the village <a href="karte.php?d='.$dataarray[29].'&amp;c='.$generator->getMapCheck($dataarray[29]).'">'.stripslashes($dataarray[30]).'</a>'; } else { echo"Reinforcement"; } ?></td>
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
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\">0</td>";
    }
    else {
    	echo "<td>".$dataarray[$i]."</td>";
    }
}
echo "<tr><th>Casualties</th>";
for($i=108;$i<=117;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\">0</td>";
    }
    else {
    	echo "<td>".$dataarray[$i]."</td>";
    }
}
?>
</tr></tbody></table>

<?php } ?>
<?php  if ($dataarray[118]=='1'){
$start=41; ?>	
	<table cellpadding="1" cellspacing="1" class="defender">
	<thead>
	<tr>
	<td class="role">Defender</th>
	<td colspan="10"><?php if($targettribe=='5'){ echo'<a href="spieler.php?uid='.$database->getUserField($dataarray[28],"id",0).'">'.$database->getUserField($dataarray[28],"username",0).'</a> from the village <a href="karte.php?d='.$dataarray[29].'&amp;c='.$generator->getMapCheck($dataarray[29]).'">'.stripslashes($dataarray[30]).'</a>'; } else { echo"Reinforcement"; } ?></td>
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
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\">0</td>";
    }
    else {
    	echo "<td>".$dataarray[$i]."</td>";
    }
}
echo "<tr><th>Casualties</th>";
for($i=129;$i<=138;$i++) {
	if($dataarray[$i] == 0) {
    	echo "<td class=\"none\">0</td>";
    }
    else {
    	echo "<td>".$dataarray[$i]."</td>";
    }
}
?>
</tr></tbody></table>

<?php } ?>
</td></tr></tbody></table>