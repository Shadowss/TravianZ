<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       addTroops.tpl                                               ##
##  Developed by:  Dzoki & Advocatie                                           ##
##  License:       TravianZ Project                                            ##
##  Reworks by:    ronix                                                       ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################
$unarray = [1=>U1,U2,U3,U4,U5,U6,U7,U8,U9,U10,U11,U12,U13,U14,U15,U16,U17,U18,U19,U20,U21,U22,U23,U24,U25,U26,U27,U28,U29,U30,U31,U32,U33,U34,U35,U36,U37,U38,U39,U40,U41,U42,U43,U44,U45,U46,U47,U48,U49,U50,U99,U0];
if($_SESSION['access'] < 9) die(ACCESS_DENIED_ADMIN);
$id = $_GET['did'];
if(isset($id))
{
	$units = $database->getUnit($village['wref']);
	$coor = $database->getCoor($village['wref']);
	$tribe = $user['tribe'];
	$img = ($tribe - 1) * 10;

	include("search2.tpl");
?>	
<form action="../GameEngine/Admin/Mods/addTroops.php" method="POST">
<input type="hidden" name="id" id="id" value="<?php echo $_GET['did']; ?>">
<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
<table id="member">
	<thead>
	<tr>
		<th colspan="2">Edit troops</th>
	</tr></thead><tbody>
	<?php 
	for($i = 1; $i < 11; $i++) {
		echo '<tr>
			<td class="addTroops"><img src="../img/un/u/'.($img+$i).'.gif"></img> '.$unarray[$img+$i].'</td>
			<td class="addTroops"><input class="addTroops" name="u'.($img+$i).'" id="u'.($img+$i).'" value="'.$units["u".($img+$i)].'" maxlength="10">
			&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b>'.$units["u".($img+$i)].'</b><font></td>
		</tr>';
	} ?>
	</tbody>
	<thead>
	<tr>
		<td colspan="2">
			<button style="float: right" name="save" id="btn_save" class="trav_buttons" value="save" alt="save" /> Save </button>
			<button style="float: left" name="back" id="btn_back" class="trav_buttons" value="back" alt="back" onclick="return go_url('../Admin/admin.php?p=village&did=<?php echo $_GET["did"];?>')" /> Back </button>
		</td>
	</tr>
	</thead>	
	
	</table>
	</form>
	<?php
	} ?>
