<?php
if(isset($_GET['action']) == 'editSlot' && $_GET['eid']) {
    $eiddata = $database->getRaidList($_GET['eid']);
    $x = $eiddata['x'];
    $y = $eiddata['y'];
    for($i = 1; $i <= 10; $i++) ${'t'.$i} = $eiddata['t'.$i];
    $FLData = $database->getFLData($eiddata['lid']);
}

if(isset($_POST['action']) == 'editSlot' && $_POST['eid']) {
    if(!empty($_POST['target_id'])){
        $Wref = $_POST['target_id'];
        $WrefCoor = $database->getCoor($Wref);
        $WrefX = $WrefCoor['x'];
        $WrefY = $WrefCoor['y'];
        $type = $database->getVillageType2($Wref);
        $oasistype = $type;
        $vdata = $database->getVillage($Wref);
    }elseif(!empty($_POST['x']) && !empty($_POST['y']) && is_numeric($_POST['x']) && is_numeric($_POST['y'])){
        $Wref = $database->getVilWref($_POST['x'], $_POST['y']);
        $WrefX = $_POST['x'];
        $WrefY = $_POST['y'];
        $type = $database->getVillageType2($Wref);
        $oasistype = $type;
        $vdata = $database->getVillage($Wref);
    }

    $troops = 0;
    for($i = 1; $i <= 10; $i++) $troops += $_POST['t'.$i];
    
    if(empty($_POST['x']) && empty($_POST['y']) && empty($_POST['target_id'])) $errormsg = "Enter coordinates.";
    elseif((empty($_POST['x']) || empty($_POST['y'])) && empty($_POST['target_id'])) $errormsg = "Enter the correct coordinates.";  	
    elseif($oasistype == 0 && $vdata == 0) $errormsg = "There is no village on those coordinates."; 	
    elseif($troops == 0) $errormsg = "No troops has been selected.";
    elseif($database->hasBeginnerProtection($Wref) == 1) $errormsg = "Player under protection."; 
    elseif($_POST['target_id'] == $village->wid || $vdata['wref'] == $village->wid) $errormsg = "You can't attack the same village you send troops from.";
    else
    {

		if(!empty($_POST['target_id'])){
		    $Wref = $_POST['target_id'];
		    $WrefCoor = $database->getCoor($Wref);
		    $WrefX = $WrefCoor['x'];
		    $WrefY = $WrefCoor['y'];
		}else{
		    $Wref = $database->getVilWref($_POST['x'], $_POST['y']);
		    $WrefX = $_POST['x'];
		    $WrefY = $_POST['y'];
		}
		$coor = $database->getCoor($village->wid);

		function getDistance($coorx1, $coory1, $coorx2, $coory2) {
		    $max = 2 * WORLD_MAX + 1;
		    $x1 = intval($coorx1);
		    $y1 = intval($coory1);
		    $x2 = intval($coorx2);
		    $y2 = intval($coory2);
		    $distanceX = min(abs($x2 - $x1), abs($max - abs($x2 - $x1)));
		    $distanceY = min(abs($y2 - $y1), abs($max - abs($y2 - $y1)));
		    $dist = sqrt(pow($distanceX, 2) + pow($distanceY, 2));
		    return round($dist, 1);
		}
		
		$distance = getDistance($coor['x'], $coor['y'], $WrefX, $WrefY);
            
		$database->editSlotFarm($_GET['eid'], $_POST['lid'], $Wref, $WrefX, $WrefY, $distance, $_POST['t1'], $_POST['t2'], $_POST['t3'], $_POST['t4'], $_POST['t5'], $_POST['t6'], $_POST['t7'], $_POST['t8'], $_POST['t9'], $_POST['t10']);
        
        header("Location: build.php?id=39&t=99");
		exit;
}
}
if($FLData['owner'] == $session->uid){
?>

<div id="raidListSlot">
	<h4>Add Slot</h4>
<font color="#FF0000"><b>    
<?php echo $errormsg; ?>
</b></font>
	
	<form id="edit_form" action="build.php?id=39&t=99&action=showSlot&eid=<?php echo $_GET['eid']; ?>" method="post">
		<div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents cf">

<?php
$getlid = $database->getRaidList($database->escape($_GET["eid"]));
$lid2 = $getlid['lid'];
?>
		<input type="hidden" name="action" value="editSlot">
		<input type="hidden" name="eid" value="<?php echo $_GET['eid']; ?>">
        <input type="hidden" name="lid" value="<?php echo $lid2; ?>">
			
			<table cellpadding="1" cellspacing="1" class="transparent" id="raidList">
				<tbody><tr>
					<th>Farm Name:</th><?php echo $_GET["lid"]; ?>
					<td>
						<select onchange="getTargetsByLid();" id="lid" name="lid">
<?php
$sql = mysqli_query($database->dblink,"SELECT id, name, owner, wref FROM ".TB_PREFIX."farmlist WHERE owner = ".(int) $session->uid." ORDER BY name ASC");
while($row = mysqli_fetch_array($sql)){ 
$lid = $row["id"];
$lname = $row["name"];
$lowner = $row["owner"];
$lwref = $row["wref"];
$lvname = $database->getVillageField($row["wref"], 'name');

	if($lid==$lid2){ $selected = 'selected=""'; }else{ $selected = ''; }
	echo '<option value="'.$lid.'" '.$selected.'>'.$lvname.' - '.$lname.'</option>';
}
?>	
						</select>
					</td>
				</tr>
				<tr>
					<th>Select target:</th>
					<td class="target">
						
			<div class="coordinatesInput">
				<div class="xCoord">
					<label for="xCoordInput">X:</label>
					<input value="<?php echo $x; ?>" name="x" id="xCoordInput" class="text coordinates x ">
				</div>
				<br />
				<div class="yCoord">
					<label for="yCoordInput">Y:</label>
					<input value="<?php echo $y; ?>" name="y" id="yCoordInput" class="text coordinates y ">
				</div>
				<div class="clear"></div>
			</div>
								<div class="targetSelect"><br />
							<label class="lastTargets">Last targets:</label>
							<select name="target_id">
<?php
$getwref = "SELECT id, towref FROM ".TB_PREFIX."raidlist WHERE lid = ".(int) $lid2;
$arraywref = $database->query_return($getwref);
	echo '<option value="">Select village</option>';
if(mysqli_num_rows(mysqli_query($database->dblink,$getwref)) != 0){
foreach($arraywref as $row){
$towref = $row["towref"];
$tocoor = $database->getCoor($towref);
$totype = $database->getVillageType2($towref);
$tooasistype = $type['oasistype'];
if($tooasistype == 0){
$tovname = $database->getVillageField($towref, 'name');
}else{
$tovname = $database->getOasisField($towref, 'name');
}
if($row["id"] == $_GET['eid']){ $selected = 'selected=""'; }else{ $selected = ''; }
if($vill[$towref] == 0){
	echo '<option value="'.$towref.'" '.$selected.'>'.$tovname.'('.$tocoor['x'].'|'.$tocoor['y'].')</option>';
}
$vill[$towref] = 1;
}
}
?>
							</select>
						</div>
						<div class="clear"></div>
					</td>
				</tr>
			</tbody></table>
			</div>
				</div>
		<?php include "Templates/goldClub/trooplist.tpl"; ?>

<br />		
<button type="submit" value="save" name="save" id="save" class="trav_buttons">Save</button>&nbsp;
<button type="button" value="delete" name="delete" id="delete" class="trav_buttons" onclick="window.location.href = '?gid=16&t=99&action=deleteSlot&eid=<?php echo $_GET["eid"]; ?>&lid=<?php echo $eiddata['lid']; ?>';">Delete</button>
</form>
</div>
<?php
}else{
header("Location: build.php?id=39&t=99");
exit;
}
?>