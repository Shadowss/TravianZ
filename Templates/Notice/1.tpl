<?php
$dataarray = explode(",",$message->readingNotice['data']);
$colspan = (isset($dataarray[168]) && $dataarray[168] > 0) ? 11 : 10;
$colspan2 = (isset($dataarray[170]) && $dataarray[170] > 0) ? 11 : 10;
$spy = !empty($dataarray[167]) && !empty($dataarray[166]) && empty($dataarray[185]);

//Attacker
if ($database->getUserField($dataarray[0], 'username', 0) != "[?]") {
    $user_url="<a href=\"spieler.php?uid=".$database->getUserField($dataarray[0], 'id', 0)."\">".$database->getUserField($dataarray[0], 'username', 0)."</a>";
}
else $user_url="<font color=\"grey\"><b>[?]</b></font>";
    

if($database->getVillageField($dataarray[1], 'name') != "[?]") {
    $from_url="<a href=\"karte.php?d=".$dataarray[1]."&c=".$generator->getMapCheck($dataarray[1])."\">".$database->getVillageField($dataarray[1], 'name')."</a>";
}else $from_url="<font color=\"grey\"><b>[?]</b></font>";

//defender
if ($database->getUserField($dataarray[28], 'username', 0) != "[?]") {
    $defuser_url="<a href=\"spieler.php?uid=".$database->getUserField($dataarray[28], 'id', 0)."\">".$database->getUserField($dataarray[28], 'username', 0)."</a>";
}
else $defuser_url="<font color=\"grey\"><b>[?]</b></font>";

if($database->isVillageOases($dataarray[29])){
    $deffrom_url="<a href=\"karte.php?d=".$dataarray[29]."&c=".$generator->getMapCheck($dataarray[29])."\">".$dataarray[30]."</a>";
}elseif($database->getVillageField($dataarray[29],'name') != "[?]") {
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
<td colspan="<?php echo $colspan ?>"><?php echo ($user_url ? $user_url : 'Natar Counterforce'); ?> <?php echo ($from_url ? 'from the village '.$from_url : '');?></td>
</tr>
</thead>
<tbody class="units">
<tr>
<td>&nbsp;</td>
<?php
$tribe = $dataarray[2] ? $dataarray[2] : 5;
$start = ($tribe - 1) * 10 + 1;
for($i = $start; $i <= ($start + 9); $i++) {
    echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
}
if (isset($dataarray[168]) && $dataarray[168] > 0){
    echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
}
echo "</tr><tr><th>Troops</th>";

for($i = 3; $i <= 12; $i++) {
    if($dataarray[$i] == 0) echo "<td class=\"none\">0</td>"; 
    else echo "<td>".$dataarray[$i]."</td>";  
}

if (isset($dataarray[168]) && $dataarray[168] > 0){
    echo "<td>$dataarray[168]</td>";
}
echo "<tr><th>Casualties</th>";

for($i = 13; $i <= 22; $i++) {
    if($dataarray[$i] == 0) echo "<td class=\"none\">0</td>";
    else echo "<td>".$dataarray[$i]."</td>";
}

if(isset($dataarray[168]) && $dataarray[168] > 0){
    if ($dataarray[169] == 0) $tdclass='class="none"'; else $tdclass='';
    echo "<td $tdclass>$dataarray[169]</td>";
}
if(!$spy && ($dataarray[172] > 0 || $dataarray[173] > 0 || $dataarray[174] > 0 || $dataarray[175] > 0 || $dataarray[176] > 0 || $dataarray[177] > 0 || $dataarray[178] > 0 || $dataarray[179] > 0 || $dataarray[180] > 0 || $dataarray[181] > 0 || $dataarray[182] > 0)){
echo "</tr><tr><th>Prisoners</th>";
for($i = 172; $i <= 181; $i++) {
    if($dataarray[$i] == 0) echo "<td class=\"none\">0</td>";
    else echo "<td>".$dataarray[$i]."</td>";
}
if(isset($dataarray[168]) && $dataarray[168] > 0){
    if ($dataarray[182] == 0) $tdclass='class="none"'; else $tdclass='';
    echo "<td $tdclass>$dataarray[182]</td>";
}
}  
echo "</tr></tbody>";
if (!empty($dataarray[160]) && !empty($dataarray[161])){ //ram
?>
    <tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
    <img class="unit u<?php echo $dataarray[160]; ?>" src="img/x.gif" alt="Ram" title="Ram" />
    <?php echo $dataarray[161]; ?>
    </td></tr></tbody>
<?php } 
if (!empty($dataarray[162]) && !empty($dataarray[163])){ //cata
?>
    <tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
    <img class="unit u<?php echo $dataarray[162]; ?>" src="img/x.gif" alt="Catapult" title="Catapult" />
    <?php echo $dataarray[163]; ?>
    </td></tr></tbody>
<?php }
if (!empty($dataarray[164]) && !empty($dataarray[165])){ //chief
?>
    <tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
    <img class="unit u<?php echo $dataarray[164]; ?>" src="img/x.gif" alt="Chief" title="Chief" />
    <?php echo $dataarray[165]; ?>
    </td></tr></tbody>
<?php }
if ($spy){ //spy
?>
    <tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
    
    <?php echo $dataarray[167]; ?>
    </td></tr></tbody>
<?php } 
if (!empty($dataarray[183])){ //release prisoners
?>
    <tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
    
    <?php echo $dataarray[183]; ?>
    </td></tr></tbody>
<?php } 
if (!empty($dataarray[186]) && !empty($dataarray[187])){ //hero
?>
    <tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
    <img class="unit u<?php echo $dataarray[186]; ?>" src="img/x.gif" alt="Hero" title="Hero" />
    <?php echo $dataarray[187]; ?>
    </td></tr></tbody>
<?php }
if(isset($dataarray[185]) && !empty($dataarray[185])){ //No troops returned
?>	
	<tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
	<?php echo $dataarray[185]; ?>
    </td></tr></tbody>
<?php }elseif(empty($dataarray[166]) && empty($dataarray[167])){?>
     <tbody class="goods"><tr><th>Bounty</th><td colspan="<?php echo $colspan; ?>">
    <div class="res"><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /><?php echo $dataarray[23]; ?> | <img class="r2" src="img/x.gif" alt="Clay" title="Clay" /><?php echo $dataarray[24]; ?> | <img class="r3" src="img/x.gif" alt="Iron" title="Iron" /><?php echo $dataarray[25]; ?> | <img class="r4" src="img/x.gif" alt="Crop" title="Crop" /><?php echo $dataarray[26]; ?></div><div class="carry"><img class="car" src="img/x.gif" alt="carry" title="carry" /><?php echo ($dataarray[23]+$dataarray[24]+$dataarray[25]+$dataarray[26])."/".$dataarray[27]; ?></div>
    </td></tr></tbody></table>
<?php } //Defender(s)
$defArray = [1, $dataarray[55], $dataarray[76], $dataarray[97], $dataarray[118], $dataarray[139]];
$targetTribe = $dataarray[33];
foreach($defArray as $index => $value){
    if($value == 0) continue;

    $target = ($index == 0 ? $targetTribe : $index) - 1;
    $start = $target * 10 + 1;
    $troopsStart = $index * 21 + 35 - ($index == 0 ? 1 : 0);
?>    
    <table cellpadding="1" cellspacing="1" class="defender">
    <thead>
    <tr>
    <td class="role">Defender</td>
	<td colspan="<?php echo $colspan2; ?>"><?php echo ($index == 0) ? $defuser_url." from the village ".$deffrom_url : "Reinforcement"; ?></td>	
    </tr></thead>
    <tbody class="units">
    <tr>
    <td>&nbsp;</td>
    
<?php
for($i = $start; $i <= ($start + 9); $i++) {
    echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
}
if(isset($dataarray[170]) && $dataarray[170] > 0){
	echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
}
echo "</tr><tr><th>Troops</th>";

for($i = $troopsStart; $i <= $troopsStart + 9; $i++) {
    if($dataarray[$i] == 0) echo "<td class=\"none\">0</td>";
    else echo "<td>".$dataarray[$i]."</td>";
}

if(isset($dataarray[170]) && $dataarray[170] > 0){
	echo "<td>$dataarray[170]</td>";
}
echo "<tr><th>Casualties</th>";

for($i = $troopsStart + 10; $i <= $troopsStart + 19; $i++) {
    if($dataarray[$i] == 0) echo "<td class=\"none\">0</td>";
    else echo "<td>".$dataarray[$i]."</td>";
}

if(isset($dataarray[170]) && $dataarray[170] > 0){
	if ($dataarray[171] == 0){$tdclass1='class="none"';}
	echo "<td $tdclass1>$dataarray[171]</td>";
}
}
?>
</tr></tbody></table>
</td></tr></tbody></table>