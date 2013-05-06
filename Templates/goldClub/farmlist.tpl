<?php

if(isset($_GET['t'])==99 && isset($_GET['action'])==0) {

if(isset($_GET['t'])==99 && isset($_POST['action'])=='addList' && $_POST['did']!="" && $_POST['name']!=""){
    $database->createFarmList($_POST['did'], $session->uid, $_POST['name']);
}else if(isset($_GET['t'])==99 && isset($_POST['action'])=='addList'){
	header("Location: build.php?gid=16&t=99&action=addList");
}

$sql = mysql_query("SELECT * FROM ".TB_PREFIX."farmlist WHERE owner = $session->uid ORDER BY wref = $village->wid DESC");
$query = mysql_num_rows($sql);
while($row = mysql_fetch_array($sql)){
    $lid = $row["id"];
    $lname = $row["name"];
    $lowner = $row["owner"];
    $lwref = $row["wref"];
    $lvname = $database->getVillageField($row["wref"], 'name');
    if($lwref == $village->wid){
?>
				<form action="build.php?id=39&t=99&action=startRaid" method="post">
					<input type="hidden" name="action" value="startRaid">
					<input type="hidden" name="a" value="c35">
					<input type="hidden" name="sort" value="distance">
                    <input type="hidden" name="tribe" value="<?php echo $session->tribe; ?>">
					<input type="hidden" name="direction" value="asc">
					<input type="hidden" name="lid" value="<?php echo $lid; ?>">
                        <div class="listTitleText">
							<a href="build.php?gid=16&t=99&action=deleteList&lid=<?php echo $lid; ?>"><img class="del" src="img/x.gif" alt="delete" title="delete"></a>
                            <?php echo $lvname; ?> - <?php echo $lname; ?>
                            <img alt="Loading..." class="loading hide" src="img/x.gif" align="absmiddle">
                        </div>
                        <div class="openedClosedSwitch switchOpened">                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="listContent ">
                                                    <div class="detail">
    <table class="list" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
                <td class="checkbox edit"></td>
                <td class="village sortable" onclick="Travian.Game.RaidList.sort(<?php echo $lid; ?>, 'village');">Village</td>
                <td class="ew sortable" onclick="Travian.Game.RaidList.sort(<?php echo $lid; ?>, 'ew');">Ew</td>
                <td class="distance sortable" onclick="Travian.Game.RaidList.sort(<?php echo $lid; ?>, 'distance');">Distance</td>
                <td class="troops sortable" onclick="Travian.Game.RaidList.sort(<?php echo $lid; ?>, 'troops');">Troops</td>
                <td class="lastRaid sortable" onclick="Travian.Game.RaidList.sort(<?php echo $lid; ?>, 'lastRaid');">LastRaid</td>
                <td class="action"></td>
            </tr>
        </thead>
        <tbody>

<?php
$sql2 = mysql_query("SELECT * FROM ".TB_PREFIX."raidlist WHERE lid = $lid ORDER BY distance ASC");
$query2 = mysql_num_rows($sql2);
if($query2 == 0) {        
    echo '<td class="noData" colspan="7">There is no any raid list.</td>';
}else{
while($row = mysql_fetch_array($sql2)){ 
$id= $row['id'];$lid = $row['lid'];$towref = $row['towref'];$x = $row['x'];$y = $row['y'];
if($village->wid == $towref){
    $distance = '0';
}else{
    $distance = $row['distance'];
}

$t1 = $row['t1'];$t2 = $row['t2'];$t3 = $row['t3'];$t4 = $row['t4'];$t5 = $row['t5'];$t6 = $row['t6'];$t7 = $row['t7'];
$t8 = $row['t8'];$t9 = $row['t9'];$t10 = $row['t10'];
$vdata = $database->getVillage($towref);

?>
<tr class="slotRow">
<td class="checkbox">
				<?php if($checked[$lid] == 0){ ?>
                <input id="slot<?php echo $id; ?>" name="slot<?php echo $id; ?>" type="checkbox" class="markSlot" onclick="Travian.Game.RaidList.markSlotForRaid(<?php echo $lid; ?>, <?php echo $id; ?>, this.checked);">
				<?php }else{ ?>
                <input id="slot<?php echo $id; ?>" name="slot<?php echo $id; ?>" type="checkbox" class="markSlot" checked>
				<?php } ?>
			</td>
            <td class="village">
            <?php

        $incoming_attacks = $database->getMovement(3,$towref,1);
        $att = '';

        if (count($incoming_attacks) > 0) {
            $inc_atts = count($incoming_attacks);
                if($incoming_attacks[$i]['attack_type'] == 2) {
                    $inc_atts -= 1;
                }
            if($inc_atts > 0) {
                echo '<img class="att2" src="img/x.gif" title="Incoming Attacker" />';
            }
        }
        ?>
                <label for="slot<?php echo $id; ?>">
                <?php
                    $type = $database->getVillageType2($towref);
                    $oasistype = $type['oasistype'];
                    if($oasistype != 0){
                ?>
                <span class="coordinates coordinatesWithText">
                <span class="coordText">Oasis</span>
                <span class="coordinatesWrapper">
                <span class="coordinateY">(<?php echo $x; ?></span>
                <span class="coordinatePipe">|</span>
                <span class="coordinateX"><?php echo $y; ?>)</span>
                </span></span><?php;}else{?>
                <span class="coordinates coordinatesWithText">
                <span class="coordText"><?php echo $vdata['name']; ?></span>
                </span>
                <?php } ?>
                
                <span class="clear">‎</span>
                </label>
            </td>
            <td class="ew"><?php if($oasistype == 0){ echo $vdata['pop']; }else{ echo "<center>-</center>"; }; ?></td>
            <td class="distance"><?php echo $distance; ?></td>
            <td class="troops">

<?php
    if($session->tribe == 1){
        if($t1 != 0){
            echo '<div class="troopIcon"><img class="unit u1" title="'.U1.'" src="img/x.gif"><span class="troopIconAmount">'.$t1.'</span></div>'; }
        if($t2 != 0){
            echo '<div class="troopIcon"><img class="unit u2" title="'.U2.'" src="img/x.gif"><span class="troopIconAmount">'.$t2.'</span></div>'; }
        if($t3 != 0){
            echo '<div class="troopIcon"><img class="unit u3" title="'.U3.'" src="img/x.gif"><span class="troopIconAmount">'.$t3.'</span></div>'; }
        if($t4 != 0){
            echo '<div class="troopIcon"><img class="unit u4" title="'.U4.'" src="img/x.gif"><span class="troopIconAmount">'.$t4.'</span></div>'; }
        if($t5 != 0){
            echo '<div class="troopIcon"><img class="unit u5" title="'.U5.'" src="img/x.gif"><span class="troopIconAmount">'.$t5.'</span></div>'; }
        if($t6 != 0){
            echo '<div class="troopIcon"><img class="unit u6" title="'.U6.'" src="img/x.gif"><span class="troopIconAmount">'.$t6.'</span></div>'; }
        if($t7 != 0){
            echo '<div class="troopIcon"><img class="unit u7" title="'.U7.'" src="img/x.gif"><span class="troopIconAmount">'.$t7.'</span></div>'; }
        if($t8 != 0){
            echo '<div class="troopIcon"><img class="unit u8" title="'.U8.'" src="img/x.gif"><span class="troopIconAmount">'.$t8.'</span></div>'; }
        if($t9 != 0){
            echo '<div class="troopIcon"><img class="unit u9" title="'.U9.'" src="img/x.gif"><span class="troopIconAmount">'.$t9.'</span></div>'; }
        if($t10 != 0){
            echo '<div class="troopIcon"><img class="unit u10" title="'.U10.'" src="img/x.gif"><span class="troopIconAmount">'.$t10.'</span></div>'; }
    }elseif($session->tribe == 2){
        if($t1 != 0){
            echo '<div class="troopIcon"><img class="unit u11" title="'.U11.'" src="img/x.gif"><span class="troopIconAmount">'.$t1.'</span></div>'; }
        if($t2 != 0){
            echo '<div class="troopIcon"><img class="unit u12" title="'.U12.'" src="img/x.gif"><span class="troopIconAmount">'.$t2.'</span></div>'; }
        if($t3 != 0){
            echo '<div class="troopIcon"><img class="unit u13" title="'.U13.'" src="img/x.gif"><span class="troopIconAmount">'.$t3.'</span></div>'; }
        if($t4 != 0){
            echo '<div class="troopIcon"><img class="unit u14" title="'.U14.'" src="img/x.gif"><span class="troopIconAmount">'.$t4.'</span></div>'; }
        if($t5 != 0){
            echo '<div class="troopIcon"><img class="unit u15" title="'.U15.'" src="img/x.gif"><span class="troopIconAmount">'.$t5.'</span></div>'; }
        if($t6 != 0){
            echo '<div class="troopIcon"><img class="unit u16" title="'.U16.'" src="img/x.gif"><span class="troopIconAmount">'.$t6.'</span></div>'; }
        if($t7 != 0){
            echo '<div class="troopIcon"><img class="unit u17" title="'.U17.'" src="img/x.gif"><span class="troopIconAmount">'.$t7.'</span></div>'; }
        if($t8 != 0){
            echo '<div class="troopIcon"><img class="unit u18" title="'.U18.'" src="img/x.gif"><span class="troopIconAmount">'.$t8.'</span></div>'; }
        if($t9 != 0){
            echo '<div class="troopIcon"><img class="unit u19" title="'.U19.'" src="img/x.gif"><span class="troopIconAmount">'.$t9.'</span></div>'; }
        if($t10 != 0){
            echo '<div class="troopIcon"><img class="unit u20" title="'.U20.'" src="img/x.gif"><span class="troopIconAmount">'.$t10.'</span></div>'; }

    }elseif($session->tribe == 3){
        if($t1 != 0){
            echo '<div class="troopIcon"><img class="unit u21" title="'.U21.'" src="img/x.gif"><span class="troopIconAmount">'.$t1.'</span></div>'; }
        if($t2 != 0){
            echo '<div class="troopIcon"><img class="unit u22" title="'.U22.'" src="img/x.gif"><span class="troopIconAmount">'.$t2.'</span></div>'; }
        if($t3 != 0){
            echo '<div class="troopIcon"><img class="unit u23" title="'.U23.'" src="img/x.gif"><span class="troopIconAmount">'.$t3.'</span></div>'; }
        if($t4 != 0){
            echo '<div class="troopIcon"><img class="unit u24" title="'.U24.'" src="img/x.gif"><span class="troopIconAmount">'.$t4.'</span></div>'; }
        if($t5 != 0){
            echo '<div class="troopIcon"><img class="unit u25" title="'.U25.'" src="img/x.gif"><span class="troopIconAmount">'.$t5.'</span></div>'; }
        if($t6 != 0){
            echo '<div class="troopIcon"><img class="unit u26" title="'.U26.'" src="img/x.gif"><span class="troopIconAmount">'.$t6.'</span></div>'; }
        if($t7 != 0){
            echo '<div class="troopIcon"><img class="unit u27" title="'.U27.'" src="img/x.gif"><span class="troopIconAmount">'.$t7.'</span></div>'; }
        if($t8 != 0){
            echo '<div class="troopIcon"><img class="unit u28" title="'.U28.'" src="img/x.gif"><span class="troopIconAmount">'.$t8.'</span></div>'; }
        if($t9 != 0){
            echo '<div class="troopIcon"><img class="unit u29" title="'.U29.'" src="img/x.gif"><span class="troopIconAmount">'.$t9.'</span></div>'; }
        if($t10 != 0){
            echo '<div class="troopIcon"><img class="unit u30" title="'.U30.'" src="img/x.gif"><span class="troopIconAmount">'.$t10.'</span></div>'; }
    }
?>
            

                
            </td>
            <td class="lastRaid">
<?php
$noticeClass = array("Scout Report","Won as attacker without losses","Won as attacker with losses","Lost as attacker with losses","Won as defender without losses","Won as defender with losses","Lost as defender with losses","Lost as defender without losses","Reinforcement arrived","","Wood Delivered","Clay Delivered","Iron Delivered","Crop Delivered","","Won as defender without losses","Won as defender with losses","Lost as defender with losses","Won scouting as attacker","Lost scouting as attacker","Won scouting as defender","Lost scouting as defender");
$limits = "(ntype=1 or ntype=2 or ntype=3 or ntype=18 or ntype=19 or ntype=22)";
$getnotice = mysql_query("SELECT * FROM ".TB_PREFIX."ndata WHERE $limits AND toWref = ".$towref." AND uid = ".$session->uid." ORDER BY time DESC Limit 1");
if(mysql_num_rows($getnotice) > 0){
while($row2 = mysql_fetch_array($getnotice)){
    $dataarray = explode(",",$row2['data']);
    $type2 = $row2['ntype'];
    echo "<img src=\"img/x.gif\" class=\"iReport iReport".$row2['ntype']."\" title=\"".$noticeClass[$type2]."\"> ";
    
    $allres = ($dataarray[25]+$dataarray[26]+$dataarray[27]+$dataarray[28]);
    $carry = $dataarray[29];
    
    if ($dataarray[25]+$dataarray[26]+$dataarray[27]+$dataarray[28] == 0) {
    echo "<img title=\"bounty: ".$allres." resouces max carry: ".$carry." resouces.\" src=\"img/x.gif\" class=\"carry empty\">";
    
    } elseif ($dataarray[25]+$dataarray[26]+$dataarray[27]+$dataarray[28] != $dataarray[29]) {
    echo "<img title=\"bounty: ".$allres." resouces. max carry: ".$carry." resouces.\" src=\"img/x.gif\" class=\"carry half\">";
    
    } else {
    echo "<img title=\"bounty: ".$allres." resouces. max carry: ".$carry." resouces.\" src=\"img/x.gif\" class=\"carry full\">";
    }
    
    $date = $generator->procMtime($row2['time']);
    echo "<a href=\"berichte.php?id=".$row2['id']."\">".$date[0]." ".date('H:i',$row2['time'])."</a> ";
}
}
?>
                <div class="clear"></div>
            </td>
            <td class="action">
                <a class="arrow" href="build.php?id=39&t=99&action=showSlot&eid=<?php echo $id; ?>">edit</a>
            </td>
            </tr>
<?php
}
}
?>
    
</tbody>
    </table>
    <div class="markAll">
		<?php if($checked[$lid] == 0){ ?>
		<input type="checkbox" id="raidListMarkAll<?php echo $lid; ?>" class="markAll" onclick="window.location.href = '?gid=16&t=99&slid=<?php echo $lid; ?>';">
		<?php }else{ ?>
        <input type="checkbox" id="raidListMarkAll<?php echo $lid; ?>" class="markAll" onclick="window.location.href = '?gid=16&t=99';" checked>
		<?php } ?>
        <label for="raidListMarkAll<?php echo $lid; ?>">Select All</label>
    </div>

    <div class="addSlot">
<a href="build.php?id=39&t=99&action=addraid&lid=<?php echo $lid; ?>">Add Raid</a>
</div>
<div class="clear"></div>

<div class="troopSelection">
<?php
$start = ($session->tribe-1)*10+1;
$end = ($session->tribe*10);
$un = 1;
for($i=$start;$i<=$end;$i++){
    echo '<span class="troopSelectionUnit">
            <img class="unit u'.$i.'" title="'.$technology->unarray[$i].'" src="img/x.gif">
            <span class="troopSelectionValue">0</span>
        </span>';
}
?>
        <div class="clear"></div>
</div>

<button type="submit" value="Start Raid"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">Start Raid</div></div></button>                                            </div>
</form>


<?php }else{ ?>
<div id="list<?php echo $lid; ?>" class="listEntry">
<div class="round spacer listTitle" onclick="Travian.Game.RaidList.toggleList(<?php echo $lid; ?>);">
                        <div class="listTitleText">
						<a href="build.php?gid=16&t=99&action=deleteList&lid=<?php echo $lid; ?>"><img class="del" src="img/x.gif" alt="delete" title="delete"></a>
                            <?php echo $lvname; ?> - <?php echo $lname; ?>
                            <img alt="Loading..." class="loading hide" src="img/x.gif" align="absmiddle">
                        </div>
                        <div class="openedClosedSwitch switchClosed">Details</div>
                        <div class="clear"></div>
                    </div>
                    <div class="listContent hide">
                                            </div>
            </div>
<?php } }?>
<div class="options">
    <a class="arrow" href="build.php?gid=16&t=99&action=addList">Create a new list</a>
</div>
<?php
}

$getUnit = $database->getUnit($village->wid);

if($session->tribe==1){
    $unit1 = $getUnit['u1'];$unit2 = $getUnit['u2'];$unit3 = $getUnit['u3'];$unit4 = $getUnit['u4'];$unit5 = $getUnit['u5'];
    $unit6 = $getUnit['u6'];$unit7 = $getUnit['u7'];$unit8 = $getUnit['u8'];$unit9 = $getUnit['u9'];$unit10 = $getUnit['u10'];
}elseif($session->tribe==2){
    $unit1 = $getUnit['u11'];$unit2 = $getUnit['u12'];$unit3 = $getUnit['u13'];$unit4 = $getUnit['u14'];$unit5 = $getUnit['u15'];
    $unit6 = $getUnit['u16'];$unit7 = $getUnit['u17'];$unit8 = $getUnit['u18'];$unit9 = $getUnit['u19'];$unit10 = $getUnit['u20'];
}elseif($session->tribe==3){
    $unit1 = $getUnit['u21'];$unit2 = $getUnit['u22'];$unit3 = $getUnit['u23'];$unit4 = $getUnit['u24'];$unit5 = $getUnit['u25'];
    $unit6 = $getUnit['u26'];$unit7 = $getUnit['u27'];$unit8 = $getUnit['u28'];$unit9 = $getUnit['u29'];$unit10 = $getUnit['u30'];
}
?>

<?php
if(!$database->getVilFarmlist($village->wid)){
?>
<script type="text/javascript">
        window.addEvent('domready', function()
        {
                Travian.Game.RaidList.setData([]);
        });
</script>
<?php }else{ ?>
<script type="text/javascript">
        window.addEvent('domready', function()
        {
            Travian.Game.RaidList.setData({
<?php
$result = mysql_query('SELECT * FROM '.TB_PREFIX.'farmlist WHERE wref = '.$village->wid.'');
$query1 = mysql_num_rows($result);
$NUM1 = 1;
while($row = mysql_fetch_array($result)){
$lid = $row['id'];

?>
                "<?php echo $lid; ?>":{
                    "troops":{"1":<?php echo $unit1; ?>,"2":<?php echo $unit2; ?>,"3":<?php echo $unit3; ?>,"4":<?php echo $unit4; ?>,"5":<?php echo $unit5; ?>,"6":<?php echo $unit6; ?>,"7":<?php echo $unit7; ?>,"8":<?php echo $unit8; ?>,"9":<?php echo $unit9; ?>,"10":<?php echo $unit10; ?>,"11":<?php echo $getUnit['hero']; ?>},
                    "directions":{"village":"none","ew":"none","distance":"asc","troops":"none","lastRaid":"none"},
                    "slots":{<?php 
$result3 = mysql_query('SELECT * FROM '.TB_PREFIX.'raidlist WHERE lid = '.$lid.'');
$query2 = mysql_num_rows($result3);
$NUM2 = 1;
while($row3 = mysql_fetch_array($result3)){
$id = $row3['id'];
$t1 = $row3['t1'];$t2 = $row3['t2'];$t3 = $row3['t3'];$t4 = $row3['t4'];$t5 = $row3['t5'];$t6 = $row3['t6'];$t7 = $row3['t7'];
$t8 = $row3['t8'];$t9 = $row3['t9'];$t10 = $row3['t10'];

echo '
                        "'.$id.'":{"troops":{"1":'.$t1.',"2":'.$t2.',"3":'.$t3.',"4":'.$t4.',"5":'.$t5.',"6":'.$t6.',"7":'.$t7.',"8":'.$t8.',"9":'.$t9.',"10":'.$t10.',"11":0}}';
if($NUM2 != $query2){
    echo ',';
}
$NUM2++;
}
echo '
                    }
                }';
if($NUM1 != $query1){
echo ',
';
}
$NUM1++;
}
?>

            });
            (new Fx.Scroll(window,{
                duration: 100
            })).toElement('list<?php echo $lid2; ?>');
        });
</script>
    <?php } ?>

<?php if($create == 1){
$hideevasion = 1;
include("Templates/goldClub/farmlist_add.tpl");
}else if($create == 2){
$hideevasion = 1;
include("Templates/goldClub/farmlist_addraid.tpl");
}else if($create == 3){
$hideevasion = 1;
include("Templates/goldClub/farmlist_editraid.tpl");
}