<?php
//reinforcement is underattack
$dataarray = explode(",",$rep[0]['data']);
if(isset($dataarray[24]) and $dataarray[24]!=0){$colspan="11";}else{$colspan="10";}
if ($database->getUserField($dataarray[0],'username',0)!="??") {
    $user_url="<a href=\"spieler.php?uid=".$database->getUserField($dataarray[0],'id',0)."\">".$database->getUserField($dataarray[0],'username',0)."</a>";
}else{
    $user_url="<font color=\"grey\"><b>??</b></font>";
}
if($database->getVillageField($dataarray[26],'name')!="??") {
    $from_url="<a href=\"karte.php?d=".$dataarray[26]."&c=".$generator->getMapCheck($dataarray[26])."\">".$database->getVillageField($dataarray[26],'name')."</a>";
}else{
    $from_url="<font color=\"grey\"><b>??</b></font>";
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
                <table cellpadding="1" cellspacing="1" class="defender"><thead>
<tr>
<td class="role">Defender</td>
<td colspan="<?php echo $colspan ?>"><?php echo $user_url;?> from the village <?php echo $from_url;?></td>
</tr>
</thead>
<tbody class="units">
<tr>
<td>&nbsp;</td>
<?php
$tribe = $dataarray[3];
$start = ($tribe-1)*10+1;
for($i=$start;$i<=($start+9);$i++) {
        echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
}
if(isset($dataarray[24]) and $dataarray[24]!=0){
        echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
}
echo "</tr><tr><th>Troops</th>";
for($i=4;$i<=13;$i++) {
        if($dataarray[$i] == 0) {
            echo "<td class=\"none\">0</td>";
    }
else {
            echo "<td>".$dataarray[$i]."</td>";
    }
}
if(isset($dataarray[24]) and $dataarray[24]!=0){
        echo "<td>$dataarray[24]</td>";
}
echo "<tr><th>Casualties</th>";
for($i=14;$i<=23;$i++) {
        if($dataarray[$i] == 0) {
            echo "<td class=\"none\">0</td>";
    }
else {
            echo "<td>".$dataarray[$i]."</td>";
    }
}
if(isset($dataarray[24]) and $dataarray[24]!=0){
        if ($dataarray[25]==0){$tdclass='class="none"';}
        echo "<td $tdclass>$dataarray[25]</td>";
}
?>
</tr></tbody>
</table>
</td></tr></tbody></table>