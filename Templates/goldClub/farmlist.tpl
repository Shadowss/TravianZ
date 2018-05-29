<?php

if(isset($_GET['t']) == 99 && isset($_GET['action']) == 0) {

if(isset($_GET['t']) == 99 && isset($_POST['action']) == 'addList' && !empty($_POST['did']) && !empty($_POST['name']) && $database->getVillageField($_POST['did'], 'owner') == $session->uid){
    $database->createFarmList($_POST['did'], $session->uid, $_POST['name']);
}else if(isset($_GET['t']) == 99 && isset($_POST['action']) == 'addList'){
	header("Location: build.php?gid=16&t=99&action=addList");
	exit;
}

?>
<form action="build.php?id=39&t=99&action=startRaid" method="post" name="msg">
<input type="hidden" name="action" value="startRaid">
<?php 
$sql = mysqli_query($database->dblink,"SELECT id, name, owner, wref FROM ".TB_PREFIX."farmlist WHERE owner = ".(int) $session->uid." ORDER BY wref DESC");
$query = mysqli_num_rows($sql);
while($row = mysqli_fetch_array($sql)){
    $lid = $row["id"];
    $lname = $row["name"];
    $lowner = $row["owner"];
    $lwref = $row["wref"];
    $lvname = $database->getVillageField($row["wref"], 'name');
?>
                        <div class="listTitleText">
							<a href="build.php?gid=16&t=99&action=deleteList&lid=<?php echo $lid; ?>"><img class="del" src="img/x.gif" alt="delete" title="delete"></a>
                            <?php echo $lvname; ?> - <?php echo $lname; ?>
                        </div>
                        <div class="openedClosedSwitch switchOpened"></div>
                        <div class="clear"></div>
                                            </div>
	<div class="listContent ">
    <div class="detail">
    <table id="raidList" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
                <td></td>
                <td>Village</td>
                <td>Pop</td>
                <td>Distance</td>
                <td>Troops</td>
                <td>Last raid</td>
                <td></td>
            </tr>
        </thead>
        <tbody>

<?php
$sql2 = mysqli_query($database->dblink,"SELECT * FROM ".TB_PREFIX."raidlist WHERE lid = ".(int) $lid." ORDER BY distance ASC");
$query2 = mysqli_num_rows($sql2);
if(!$query2) echo '<td class="noData" colspan="7">'.NO_VILLAGES.'</td>';
else
{
	while($row = mysqli_fetch_array($sql2)){
		$id = $row['id'];
		$lid = $row['lid'];
		$towref = $row['towref'];
		$x = $row['x'];
		$y = $row['y'];
		$distance = $row['distance'];
		
		for($i = 1; $i <= 6; $i++) ${'t'.$i} = $row['t'.$i];
		
		$vdata = $database->getVillage($towref);
?>

<tr class="slotRow">
<td class="checkbox">
                <input id="slot" name="slot[]" value="<?php echo $id; ?>" type="checkbox" class="markSlot">
			</td>
            <td class="village">
            <?php

            $attacks = $database->getMovement(3, $towref, 1);      
            if (($attacksCount = count($attacks)) > 0) {
            	foreach($attacks as $attack){
            		if($attack['attack_type'] != 4) $attacksCount -= 1;
                }          
                if($attacksCount > 0) echo '<img class="att2" src="img/x.gif" title="'.OWN_ATTACKING_TROOPS.'" />';
            }
        	?>
                <label for="slot<?php echo $id; ?>">
                <?php
                    $oasistype = $database->getVillageType2($towref);
                    if($oasistype != 0) $thisVillageName = $database->getOasisField($towref, 'conqured') ? OCCUOASIS : UNOCCUOASIS;
                    else $thisVillageName = $vdata["name"];
                ?>
                <span class="coordinates coordinatesWithText">
                <span class="coordText"><?php echo $thisVillageName; ?></span>
                <span class="coordinatesWrapper">
                <span class="coordinateY">(<?php echo $x; ?></span>
                <span class="coordinatePipe">|</span>
                <span class="coordinateX"><?php echo $y; ?>)</span>
                </span></span>
                <span class="clear">‎</span>
                </label>
            </td>
            <td class="ew"><?php if($oasistype == 0){ echo $vdata['pop']; }else{ echo "<center>-</center>"; }; ?></td>
            <td class="distance"><?php echo $distance; ?></td>
            <td class="troops">

<?php
    $start = ($session->tribe - 1) * 10 + 1;
    $end = $start + 5;
    
    for($i = $start; $i <= $end; $i++){
    	if(${'t'.($i - $start + 1)} > 0){
    		echo '<div class="troopIcon"><img class="unit u'.$i.'" title="'.$technology->getUnitName($i).'" src="img/x.gif"><span class="troopIconAmount">'.${'t'.($i - $start + 1)}.'</span></div>';
    	}
    }
?>
            

                
            </td>
            <td class="lastRaid">
<?php
$noticeClass = ["Scout Report", "Won as attacker without losses", "Won as attacker with losses", "Lost as attacker with losses", "Won as defender without losses", "Won as defender with losses", "Lost as defender with losses", "Lost as defender without losses",
						"Reinforcement arrived", "", "Wood Delivered", "Clay Delivered", "Iron Delivered", "Crop Delivered", "", "Won as defender without losses", "Won as defender with losses", "Lost as defender with losses", "Won scouting as attacker", "Lost scouting as attacker",
						"Won scouting as defender", "Lost scouting as defender"];

$getnotice = mysqli_query($database->dblink,"SELECT ntype, data, time, id FROM ".TB_PREFIX."ndata WHERE ntype < 4 AND toWref = ".(int) $towref." AND uid = ".(int) $session->uid." ORDER BY time DESC Limit 1");
if(mysqli_num_rows($getnotice) > 0){
while($row2 = mysqli_fetch_array($getnotice)){
    $dataarray = explode(",",$row2['data']);
    $type2 = $row2['ntype'];
    echo "<img src=\"img/x.gif\" class=\"iReport iReport".$row2['ntype']."\" title=\"".$noticeClass[$type2]."\"> ";
    
    $allres = $dataarray[23] + $dataarray[24] + $dataarray[25] + $dataarray[26];
    $carry = $dataarray[27];

    echo "<img title=\"$allres/$carry\" src=\"img/x.gif\" class=\"carry\"/>";
    
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
<div class="clear"></div><br />
<div class="troopSelection">
<div class="clear"></div>
</div>
</div>
<?php }?>


<?php if($database->getVilFarmlist($session->uid)){ ?>
<div class="markAll">
	<input type="checkbox" id="raidListMarkAll" name="s10" class="markAll" onclick="Allmsg(this.form);">
	<label for="raidListMarkAll">Select all</label>
</div><br />
<div class="addSlot">
<button type="button" class="trav_buttons" onclick="window.location.href = '?gid=16&t=99&action=addraid';">Add Raid</button>
<button type="submit" class="trav_buttons" value="Start Raid">Start Raid</button>
</div><br />
</form>
<?php } ?>
<div class="options">
    <a class="arrow" href="build.php?gid=16&t=99&action=addList">Create a new list</a>
</div>
<?php
}

if($create == 1){
	$hideevasion = 1;
	include("Templates/goldClub/farmlist_add.tpl");
}else if($create == 2){
	$hideevasion = 1;
	include("Templates/goldClub/farmlist_addraid.tpl");
}else if($create == 3){
	$hideevasion = 1;
	include("Templates/goldClub/farmlist_editraid.tpl");
}
?>