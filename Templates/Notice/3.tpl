<?php
############################################################
##           DO NOT REMOVE THIS NOTICE                    ##
##          ADVOCAITE ROCKS TRAVIANX NUTS                 ##
##                  GIT HUB REV                           ##  
############################################################
$dataarray = explode(",",$message->readingNotice['data']);
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
<td colspan="10"><a href="spieler.php?uid=<?php echo $database->getUserField($dataarray[0],"id",0); ?>"><?php echo $database->getUserField($dataarray[0],"username",0); ?></a> from the village <a href="karte.php?d=<?php echo $dataarray[1]."&amp;c=".$generator->getMapCheck($dataarray[1]); ?>"><?php echo $database->getVillageField($dataarray[1],"name"); ?></a></td>
</tr>
</thead>
<tbody class="units">
<tr>
<td>&nbsp;</td>
<?php
$start = $dataarray[2] == 1? 1 : (($dataarray[2] == 2)? 11 : (($dataarray[2] == 3)? 21 : 31));
for($i=$start;$i<=($start+9);$i++) {
	echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
}
echo "<td><img src=\"img/x.gif\" class=\"unit hero\" title=\"Hero\" /></td>";
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

echo "</tr></tbody>"; ?>
</td></tr></tbody></table>
	
<?php
$targettribe=$dataarray['31'];


if ($dataarray[31]=='1'){
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
