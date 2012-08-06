<?php
if(isset($_GET['action']) == 'editSlot' && $_GET['eid']) {
$eiddata = $database->getRaidList($_GET['eid']);
$x = $eiddata['x'];
$y = $eiddata['y'];
$t1 = $eiddata['t1'];$t2 = $eiddata['t2'];$t3 = $eiddata['t3'];$t4 = $eiddata['t4'];$t5 = $eiddata['t5'];$t6 = $eiddata['t6'];$t7 = $eiddata['t7'];$t8 = $eiddata['t8'];$t9 = $eiddata['t9'];$t10 = $eiddata['t10'];
$FLData = $database->getFLData($eiddata['lid']);
}

if(isset($_POST['action']) == 'editSlot' && $_POST['eid']) {
if($_POST['target_id'] != ""){
$Wref = $_POST['target_id'];
$WrefCoor = $database->getCoor($Wref);
$WrefX = $WrefCoor['x'];
$WrefY = $WrefCoor['y'];
$type = $database->getVillageType2($Wref);
$oasistype = $type['oasistype'];
$vdata = $database->getVillage($Wref);
}elseif($_POST['x']!="" && $_POST['y']!="" && is_numeric($_POST['x']) && is_numeric($_POST['y'])){
$Wref = $database->getVilWref($_POST['x'], $_POST['y']);
$WrefX = $_POST['x'];
$WrefY = $_POST['y'];
$type = $database->getVillageType2($Wref);
$oasistype = $type['oasistype'];
$vdata = $database->getVillage($Wref);
}
$troops = "".$_POST['t1']."+".$_POST['t2']."+".$_POST['t3']."+".$_POST['t4']."+".$_POST['t5']."+".$_POST['t6']."+".$_POST['t7']."+".$_POST['t8']."+".$_POST['t9']."+".$_POST['t10']."";

    if($_POST['x']=="" && $_POST['y']=="" && $_POST['target_id'] == ""){
    	$errormsg .= "Enter coordinates.";
    }elseif(($_POST['x']=="" || $_POST['y']=="") && $_POST['target_id'] == ""){
    	$errormsg .= "Enter the correct coordinates.";
    }elseif($oasistype == 0 && $vdata == 0){
    	$errormsg .= "There is no village on those coordinates.";
    }elseif($troops == "0"){
     	$errormsg .= "No troops has been selected.";
    }else{

		if($_POST['target_id'] != ""){
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
$getlid = $database->getRaidList($_GET["eid"]);
$lid2 = $getlid['lid'];
?>
		<input type="hidden" name="action" value="editSlot">
		<input type="hidden" name="eid" value="<?php echo $_GET['eid']; ?>">
        <input type="hidden" name="lid" value="<?php echo $lid2; ?>">
			
			<table cellpadding="1" cellspacing="1" class="transparent">
				<tbody><tr>
					<th>Farm Name:</th><?php echo $_GET["lid"]; ?>
					<td>
						<select onchange="getTargetsByLid();" id="lid" name="lid">
<?php
$sql = mysql_query("SELECT * FROM ".TB_PREFIX."farmlist WHERE owner = $session->uid ORDER BY name ASC");
while($row = mysql_fetch_array($sql)){ 
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
				<div class="yCoord">
					<label for="yCoordInput">Y:</label>
					<input value="<?php echo $y; ?>" name="y" id="yCoordInput" class="text coordinates y ">
				</div>
				<div class="clear"></div>
			</div>
								<div class="targetSelect">
							<label class="lastTargets">Last targets:</label>
							<select name="target_id">
<?php
$getwref = "SELECT * FROM ".TB_PREFIX."raidlist WHERE lid = $lid2";
$arraywref = $database->query_return($getwref);
	echo '<option value="">Select village</option>';
if(mysql_num_rows(mysql_query($getwref)) != 0){
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

		
<button type="submit" value="save" name="save" id="save"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">Save</div></div></button>&nbsp;
<button type="button" value="delete" name="delete" id="delete" onclick="window.location.href = '?gid=16&t=99&action=deleteSlot&eid=<?php echo $_GET["eid"]; ?>';"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">Delete</div></div></button>
</form>
</div>
<?php
}else{
header("Location: build.php?id=39&t=99");
}
?>