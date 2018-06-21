<div id="build" class="gid17"><a href="#" onClick="return Popup(17,4);" class="build_logo"> 
	<img class="building g17" src="img/x.gif" alt="Marketplace" title="<?php echo MARKETPLACE;?>" /> 
</a> 
<h1><?php echo MARKETPLACE;?> <span class="level"><?php echo LEVEL;?> <?php echo $village->resarray['f'.$id]; ?></span></h1> 
<p class="build_desc"><?php echo MARKETPLACE_DESC;?>
</p> 
 
<?php include("17_menu.tpl"); ?>

<script language="JavaScript"> 
<!--
var haendler = <?php echo $market->merchantAvail(); ?>;
var carry = <?php echo $market->maxcarry; ?>;
//-->
</script>
<?php
for ($a = 1; $a <= 4; $a++) {
    if (!isset($_POST['r'.$a])) {
        $_POST['r'.$a] = 0;
    }
}
$allres = (int) $_POST['r1'] + (int) $_POST['r2'] + (int) $_POST['r3'] + (int) $_POST['r4'];
if($_POST['x'] != "" && $_POST['y'] != "" && is_numeric($_POST['x']) && is_numeric($_POST['y'])){
	$getwref = $database->getVilWref($_POST['x'],$_POST['y']);
	$checkexist = $database->checkVilExist($getwref);
}
else if(!empty($_POST['dname'])){
	$getwref = $database->getVillageByName($_POST['dname']);
	$checkexist = $database->checkVilExist($getwref);
}
if(isset($checkexist) && $checkexist){
$villageOwner = $database->getVillageField($getwref,'owner');
$userAccess = $database->getUserField($villageOwner,'access',0);
$userVacation = $database->getUserField($villageOwner,'vac_mode',0);
$userID = $database->getUserField($villageOwner,'id',0);
}
$maxcarry = $market->maxcarry;
$maxcarry *= $market->merchantAvail();
if(isset($_POST['ft'])=='check' && (($_POST['send3'] > 1 && $_POST['send3'] <= 3 && $session->goldclub) || $_POST['send3'] == 1) && $getwref != $village->wid && $allres!=0 && $allres <= $maxcarry && ($_POST['x']!="" && $_POST['y']!="" or $_POST['dname']!="") && $checkexist && ($userAccess == 2 || $userAccess == MULTIHUNTER || (ADMIN_ALLOW_INCOMING_RAIDS && $userAccess == ADMIN)) && $userVacation == 0){
?>
<form method="POST" name="snd" action="build.php"> 
<input type="hidden" name="ft" value="mk1">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="send3" value="<?php echo $_POST['send3']; ?>">
<table id="send_select" class="send_res" cellpadding="1" cellspacing="1">
	<tr>
		<td class="ico"><img class="r1" src="img/x.gif" alt="Lumber" title="<?php echo LUMBER;?>" /></td> 
		<td class="nam"> <?php echo LUMBER;?></td> 
		<td class="val"><input class="text disabled" type="text" name="r1" id="r1" value="<?php echo $_POST['r1']; ?>" readonly="readonly"></td> 
		<td class="max"> / <span class="none"><B><?php echo $market->maxcarry; ?></B></span> </td> 
	</tr>
    <tr> 
		<td class="ico"><img class="r2" src="img/x.gif" alt="Clay" title="<?php echo CLAY;?>" /></td> 
		<td class="nam"> <?php echo CLAY;?></td> 
		<td class="val"><input class="text disabled" type="text" name="r2" id="r2" value="<?php echo $_POST['r2']; ?>" readonly="readonly"></td> 
		<td class="max"> / <span class="none"><b><?php echo$market->maxcarry; ?></b></span> </td> 
	</tr>
    <tr> 
		<td class="ico"><img class="r3" src="img/x.gif" alt="Iron" title="<?php echo IRON;?>" /></td> 
		<td class="nam"> <?php echo IRON;?></td> 
		<td class="val"><input class="text disabled" type="text" name="r3" id="r3" value="<?php echo $_POST['r3']; ?>" readonly="readonly"> 
		</td> 
		<td class="max"> / <span class="none"><b><?php echo $market->maxcarry; ?></b></span> </td> 
	</tr>
    <tr> 
		<td class="ico"><img class="r4" src="img/x.gif" alt="Crop" title="<?php echo CROP;?>" /></td> 
		<td class="nam"> <?php echo CROP;?></td> 
		<td class="val"> <input class="text disabled" type="text" name="r4" id="r4" value="<?php echo $_POST['r4']; ?>" readonly="readonly"> 
		</td> 
		<td class="max"> / <span class="none"><B><?php echo $market->maxcarry; ?></B></span></td> 
	</tr></table> 
<table id="target_validate" class="res_target" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<th><?php echo COORDINATES;?>:</th>
        <?php
		if($_POST['x'] != "" && $_POST['y'] != "" && is_numeric($_POST['x']) && is_numeric($_POST['y'])){
          $getwref = $database->getVilWref($_POST['x'],$_POST['y']);
		  $getvilname = $database->getVillageField($getwref, "name");
		  $getvilowner = $database->getVillageField($getwref, "owner");
		  $getvilcoor['y'] = $_POST['y'];
		  $getvilcoor['x'] = $_POST['x'];
		  $time = $generator->procDistanceTime($getvilcoor, $village->coor, $session->tribe, 0);
		}
		else if(!empty($_POST['dname'])){
		  $getwref = $database->getVillageByName($_POST['dname']);
		  $getvilcoor = $database->getCoor($getwref);
		  $getvilname = $database->getVillageField($getwref, "name");
		  $getvilowner = $database->getVillageField($getwref, "owner");
		  $time = $generator->procDistanceTime($getvilcoor, $village->coor, $session->tribe, 0);
		}
        ?>
		<td><a href="karte.php?d=<?php echo $getwref; ?>&c=<?php echo $generator->getMapCheck($getwref); ?>"><?php echo $getvilname; ?>(<?php echo $getvilcoor['x']; ?>|<?php echo $getvilcoor['y']; ?>)<span class="clear"></span></a></td>
	</tr>
	<tr>
		<th><?php echo PLAYER;?>:</th>
		<td><a href="spieler.php?uid=<?php echo $getvilowner; ?>"><?php echo $database->getUserField($getvilowner,'username',0); ?></a></td>
	</tr>
	<tr>
		<th><?php echo DURATION;?>:</th>
		<td><?php echo $generator->getTimeFormat($time); ?></td>
	</tr>
	<tr>
		<th><?php echo MERCHANT;?>:</th>
		<td><?php
        $resource = array($_POST['r1'],$_POST['r2'],$_POST['r3'],$_POST['r4']); 
        echo ceil((array_sum($resource)-0.1)/$market->maxcarry); ?></td>
	</tr>

	<tr>
		<td colspan="2">
					</td>
	</tr>

</tbody></table>
<input type="hidden" name="getwref" value="<?php echo $getwref; ?>">
<div class="clear"></div>
<p>
<div class="clear"></div><p><input type="image" value="ok" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" tabindex="8" alt="OK" <?php if(!$market->merchantAvail()) { echo "DISABLED"; }?>/></p></form>
<?php }else{ ?>
<form method="POST" name="snd" action="build.php"> 
<input type="hidden" name="ft" value="check">
<input type="hidden" name="id" value="<?php echo $id; ?>"> 
<table id="send_select" class="send_res" cellpadding="1" cellspacing="1"><tr> 
		<td class="ico"> 
			<a href="#" onClick="upd_res(1,1); return false;"><img class="r1" src="img/x.gif" alt="Lumber" title="<?php echo LUMBER;?>" /></a> 
		</td> 
		<td class="nam"> 
			<?php echo LUMBER;?>:
		</td> 
		<td class="val"> 
			<input class="text" type="text" name="r1" id="r1" value="" maxlength="5" onKeyUp="upd_res(1)" tabindex="1"> 
		</td> 
		<td class="max"> 
			<a href="#" onMouseUp="add_res(1);" onClick="return false;">(<?php echo $market->maxcarry; ?>)</a> 
		</td> 
	</tr><tr> 
		<td class="ico"> 
			<a href="#" onClick="upd_res(2,1); return false;"><img class="r2" src="img/x.gif" alt="Clay" title="<?php echo CLAY;?>" /></a> 
		</td> 
		<td class="nam"> 
			<?php echo CLAY;?>:
		</td> 
		<td class="val"> 
			<input class="text" type="text" name="r2" id="r2" value="" maxlength="5" onKeyUp="upd_res(2)" tabindex="2"> 
		</td> 
		<td class="max"> 
			<a href="#" onMouseUp="add_res(2);" onClick="return false;">(<?php echo$market->maxcarry; ?>)</a> 
		</td> 
	</tr><tr> 
		<td class="ico"> 
			<a href="#" onClick="upd_res(3,1); return false;"><img class="r3" src="img/x.gif" alt="Iron" title="<?php echo IRON;?>" /></a> 
		</td> 
		<td class="nam"> 
			<?php echo IRON;?>:
		</td> 
		<td class="val"> 
			<input class="text" type="text" name="r3" id="r3" value="" maxlength="5" onKeyUp="upd_res(3)" tabindex="3"> 
		</td> 
		<td class="max"> 
			<a href="#" onMouseUp="add_res(3);" onClick="return false;">(<?php echo $market->maxcarry; ?>)</a> 
		</td> 
	</tr><tr> 
		<td class="ico"> 
			<a href="#" onClick="upd_res(4,1); return false;"><img class="r4" src="img/x.gif" alt="Crop" title="<?php echo CROP;?>" /></a> 
		</td> 
		<td class="nam"> 
			<?php echo CROP;?>:
		</td> 
		<td class="val"> 
			<input class="text" type="text" name="r4" id="r4" value="" maxlength="5" onKeyUp="upd_res(4)" tabindex="4"> 
		</td> 
		<td class="max"> 
			<a href="#" onMouseUp="add_res(4);" onClick="return false;">(<?php echo $market->maxcarry; ?>)</a> 
		</td> 
	</tr></table> 
 
<table id="target_select" class="res_target" cellpadding="1" cellspacing="1"> 
	<tr> 
		<td class="mer"><?php echo MERCHANT;?> <?php echo $market->merchantAvail(); ?>/<?php echo $market->merchant; ?></td> 
	</tr> 
		<td class="vil"> 
			<span><?php echo MULTI_V_HEADER;?>:</span> 
			<input class="text" type="text" name="dname" value="" maxlength="30" tabindex="5"> 
		</td> 
	<tr> 
		<td class="or"><?php echo OR_;?></td> 
	</tr> 
   <tr> 
<?php
if(isset($_GET['z'])){
$coor = $database->getCoor($_GET['z']);
}
else{
$coor['x'] = "";
$coor['y'] = "";
}
?>
      <td class="coo"> 
         <span>X:</span><input class="text" type="text" name="x" value="<?php echo $coor['x']; ?>" maxlength="4" tabindex="6"> 
         <span>Y:</span><input class="text" type="text" name="y" value="<?php echo $coor['y']; ?>" maxlength="4" tabindex="7"> 
      </td> 
   </tr> 
</table>
<div class="clear"></div>
<?php if($session->goldclub == 1){?>
<p><select name="send3"><option value="1" selected="selected">1x</option><option value="2">2x</option><option value="3">3x</option></select> <?php echo GO;?></p>
<?php
}else{
?>
<input type="hidden" name="send3" value="1">
<?php
}
?>
<p><input type="image" value="ok" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" tabindex="8" alt="OK" <?php if(!$market->merchantAvail()) { echo "DISABLED"; }?>/></p></form>
<?php
$error = '';
if(isset($_POST['ft'])=='check'){

    if($form->returnErrors() > 0) $error = '<span class="error"><b>'.$form->getError("error").'</b></span>';
    elseif(!$checkexist){
		$error = '<span class="error"><b>'.NO_COORDINATES_SELECTED.'</b></span>';
	}elseif($getwref == $village->wid){
		$error = '<span class="error"><b>'.CANNOT_SEND_RESOURCES.'</b></span>';
	}elseif($_POST['send3'] < 1 || $_POST['send3'] > 3 || ($_POST['send3'] > 1 && !$session->goldclub)){
	    $error = '<span class="error"><b>'.INVALID_MERCHANTS_REPETITION.'</b></span>';
	}elseif($userAccess == '0' or ($userAccess == MULTIHUNTER && $userID == 5) or (!ADMIN_ALLOW_INCOMING_RAIDS && $userAccess == ADMIN)){
		$error = '<span class="error"><b>'.BANNED_CANNOT_SEND_RESOURCES.'.</b></span>';
    }elseif($_POST['r1']==0 && $_POST['r2']==0 && $_POST['r3']==0 && $_POST['r4']==0){
		$error = '<span class="error"><b>'.RESOURCES_NO_SELECTED.'.</b></span>';
	}elseif($userVacation == '1') {
		$error = '<span class="error"><b>Player is on vacation mode. You cannot send resources to him.</b></span>';
    }elseif(!$_POST['x'] && !$_POST['y'] && !$_POST['dname']){
		$error = '<span class="error"><b>'.ENTER_COORDINATES.'.</b></span>';
    }elseif($allres > $maxcarry){
		$error = '<span class="error"><b>'.TOO_FEW_MERCHANTS.'.</b></span>';
    }
    echo $error;
}
?>
<p>
<?php } ?>
<p><?php echo MERCHANT_CARRY;?> <b><?php echo $market->maxcarry; ?></b> <?php echo UNITS_OF_RESOURCE;?> </p>
<?php
if(count($market->recieving) > 0) { 
echo "<h4>".MERCHANT_COMING.":</h4>";
    foreach($market->recieving as $recieve) {
       echo "<table class=\"traders\" cellpadding=\"1\" cellspacing=\"1\">";
	$villageowner = $database->getVillageField($recieve['from'],"owner");
	echo "<thead><tr><td><a href=\"spieler.php?uid=$villageowner\">".$database->getUserField($villageowner,"username",0)."</a></td>";
    echo "<td><a href=\"karte.php?d=".$recieve['from']."&c=".$generator->getMapCheck($recieve['from'])."\">".TRANSPORT_FROM." ".$database->getVillageField($recieve['from'],"name")."</a></td>";
    echo "</tr></thead><tbody><tr><th>".ARRIVAL_IN."</th><td>";
    echo "<div class=\"in\"><span id=timer".++$session->timer.">".$generator->getTimeFormat($recieve['endtime']-time())."</span> h</div>";
    $datetime = $generator->procMtime($recieve['endtime']);
    echo "<div class=\"at\">";
    if($datetime[0] != "today") {
    echo "".ON." ".$datetime[0]." ";
    }
    echo "".AT." ".$datetime[1]."</div>";
    echo "</td></tr></tbody> <tr class=\"res\"> <th>".RESOURCES."</th> <td colspan=\"2\"><span class=\"f10\">";
    echo "<img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"".LUMBER."\" />".$recieve['wood']." | <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"".CLAY."\" />".$recieve['clay']." | <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"".IRON."\" />".$recieve['iron']." | <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"".CROP."\" />".$recieve['crop']."</td></tr></tbody>";
    echo "</table>";
    }
}
if(count($market->sending) > 0) {
	echo "<h4>".OWN_MERCHANTS_ONWAY.":</h4>";
    foreach($market->sending as $send) {
        $villageowner = $database->getVillageField($send['to'],"owner");
        $ownername = $database->getUserField($villageowner,"username",0);
        echo "<table class=\"traders\" cellpadding=\"1\" cellspacing=\"1\">";
        echo "<thead><tr> <td><a href=\"spieler.php?uid=$villageowner\">$ownername</a></td>";
        echo "<td><a href=\"karte.php?d=".$send['to']."&c=".$generator->getMapCheck($send['to'])."\">".TRANSPORT_TO." ".$database->getVillageField($send['to'],"name")."</a></td>";
        echo "</tr></thead> <tbody><tr> <th>".ARRIVAL_IN."</th> <td>";
        echo "<div class=\"in\"><span id=timer".++$session->timer.">".$generator->getTimeFormat($send['endtime']-time())."</span> h</div>";
        $datetime = $generator->procMtime($send['endtime']);
        echo "<div class=\"at\">";
        if($datetime[0] != "today") {
        echo "".ON." ".$datetime[0]." ";
        }
        echo "".AT." ".$datetime[1]."</div>";
        echo "</td> </tr> <tr class=\"res\"> <th>".RESOURCES."</th><td>";
        echo "<img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"".LUMBER."\" />".$send['wood']." | <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"".CLAY."\" />".$send['clay']." | <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"".IRON."\" />".$send['iron']." | <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"".CROP."\" />".$send['crop']."</td></tr></tbody>";
        echo "</table>";
    }
}
if(count($market->return) > 0) {
	echo "<h4>".MERCHANTS_RETURNING.":</h4>";
    foreach($market->return as $return) {
        $villageowner = $database->getVillageField($return['from'],"owner");
        $ownername = $database->getUserField($villageowner,"username",0);
        echo "<table class=\"traders\" cellpadding=\"1\" cellspacing=\"1\">";
        echo "<thead><tr> <td><a href=\"spieler.php?uid=$villageowner\">$ownername</a></td>";
        echo "<td><a href=\"karte.php?d=".$return['from']."&c=".$generator->getMapCheck($return['from'])."\">".RETURNFROM." ".$database->getVillageField($return['from'],"name")."</a></td>";
        echo "</tr></thead> <tbody><tr> <th>".ARRIVAL_IN."</th> <td>";
        echo "<div class=\"in\"><span id=timer".++$session->timer.">".$generator->getTimeFormat($return['endtime']-time())."</span> h</div>";
        $datetime = $generator->procMtime($return['endtime']);
        echo "<div class=\"at\">";
        if($datetime[0] != "today") {
        echo "".ON." ".$datetime[0]." ";
        }
        echo "".AT." ".$datetime[1]."</div>";
        echo "</td> </tr>";
        echo "</tbody></table>";
    }
}
include("upgrade.tpl");
?>
</p></div> 
