<?php
############################################################
## DO NOT REMOVE THIS NOTICE ##
## FIX BY RONIX ##
## TRAVIANZ ##
############################################################
$dataarray = explode(",",$rep[0]['data']);
$colspan="10";
$colspan2="10";
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
                                        <th><?php echo $rep[0]['topic']; ?></th>
                                </tr>
                                <tr>
                                        <?php
$date = $generator->procMtime($rep[0]['time']); ?>
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
if($dataarray[153] != 0 or $dataarray[154] != 0 or $dataarray[155] != 0 or $dataarray[156] != 0 or $dataarray[157] != 0 or $dataarray[158] != 0 or $dataarray[159] != 0 or $dataarray[160] != 0 or $dataarray[161] != 0 or $dataarray[162] != 0){
echo "</tr><tr><th>Prisoners</th>";
for($i=153;$i<=162;$i++) {
        if($dataarray[$i] == 0) {
            echo "<td class=\"none\">0</td>";
    }
else {
            echo "<td>".$dataarray[$i]."</td>";
    }
}
}
if(isset($dataarray[171]) && $dataarray[171] !=''){ //troop not return
?>        
        <tbody class="goods"><tr><th>Information</th><td colspan="<?php echo $colspan; ?>">
        <?php echo $dataarray[171]; ?>
    </td></tr></tbody>
<?php }?>
</table>
        
<?php
$targettribe=$dataarray['31'];


if ($dataarray[34]=='1'){
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
        if($dataarray[$i] == 0) {
            echo "<td class=\"none\">?</td>";
    }
else {
            echo "<td>".$dataarray[$i]."</td>";
    }
}
echo "<tr><th>Casualties</th>";
for($i=45;$i<=54;$i++) {
        if($dataarray[$i] == 0) {
            echo "<td class=\"none\">?</td>";
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
        if($dataarray[$i] == 0) {
            echo "<td class=\"none\">?</td>";
    }
else {
            echo "<td>".$dataarray[$i]."</td>";
    }
}
echo "<tr><th>Casualties</th>";
for($i=66;$i<=75;$i++) {
        if($dataarray[$i] == 0) {
            echo "<td class=\"none\">?</td>";
    }
else {
            echo "<td>".$dataarray[$i]."</td>";
    }
}
?>
</tr></tbody></table>
<?php } ?>
<?php if ($dataarray[76]=='1'){
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
        if($dataarray[$i] == 0) {
            echo "<td class=\"none\">?</td>";
    }
else {
            echo "<td>".$dataarray[$i]."</td>";
    }
}
echo "<tr><th>Casualties</th>";
for($i=87;$i<=96;$i++) {
        if($dataarray[$i] == 0) {
            echo "<td class=\"none\">?</td>";
    }
else {
            echo "<td>".$dataarray[$i]."</td>";
    }
}
?>
</tr></tbody></table>

<?php } ?>
<?php if ($dataarray[97]=='1'){
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
        if($dataarray[$i] == 0) {
            echo "<td class=\"none\">?</td>";
    }
else {
            echo "<td>".$dataarray[$i]."</td>";
    }
}
echo "<tr><th>Casualties</th>";
for($i=108;$i<=117;$i++) {
        if($dataarray[$i] == 0) {
            echo "<td class=\"none\">?</td>";
    }
else {
            echo "<td>".$dataarray[$i]."</td>";
    }
}
?>
</tr></tbody></table>

<?php } ?>
<?php if ($dataarray[118]=='1'){
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
        if($dataarray[$i] == 0) {
            echo "<td class=\"none\">?</td>";
    }
else {
            echo "<td>".$dataarray[$i]."</td>";
    }
}
echo "<tr><th>Casualties</th>";
for($i=129;$i<=138;$i++) {
        if($dataarray[$i] == 0) {
            echo "<td class=\"none\">?</td>";
    }
else {
            echo "<td>".$dataarray[$i]."</td>";
    }
}
?>
</tr></tbody></table>

<?php } ?>
</td></tr></tbody></table>