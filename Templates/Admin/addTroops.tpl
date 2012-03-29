<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       addTroops.tpl                                               ##
##  Developed by:  Dzoki & Advocatie                                           ##
##  License:       TravianX Project                                            ##
##  Thanks to:     Dzoki & itay2277(Edit troops)                               ## 
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>

<?php
include("../GameEngine/Lang/".LANG.".php");

if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");


$id = $_GET['did'];

if(isset($id)){
$village = $database->getVillage($id);  
$user = $database->getUserArray($village['owner'],1);  
$coor = $database->getCoor($village['wref']); 
$varray = $database->getProfileVillages($village['owner']); 
$type = $database->getVillageType($village['wref']);
$fdata = $database->getResourceLevel($village['wref']);
$units = $database->getUnit($village['wref']);


?>
<form action="../GameEngine/Admin/Mods/addTroops.php" method="POST">
<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
<table id="member">

    <thead>

    <tr>

        <th colspan="2">Edit troops</th>
		
		<?php if($user['tribe'] == 1){ ?>
    </tr></thead><tbody> 
    <tr>
		<td class="addTroops"><img src="../img/un/u/1.gif"></img> <?php echo U1; ?></td>
		<td class="addTroops"><input class="addTroops" name="u1" id="u1" value="<?php echo $units['u1']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u1']; ?></b><font></td>
	</tr>
	
	<tr>
		<td><img src="../img/un/u/2.gif"></img> <?php echo U2; ?></td>
		<td><input class="addTroops" name="u2" id="u2" value="<?php echo $units['u2']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u2']; ?></b><font></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/3.gif"></img> <?php echo U3; ?></td>
		<td><input class="addTroops" name="u3" id="u3" value="<?php echo $units['u3']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u3']; ?></b><font></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/4.gif"></img> <?php echo U4; ?></td>
		<td><input class="addTroops" name="u4" id="u4" value="<?php echo $units['u4']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u4']; ?></b><font></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/5.gif"></img> <?php echo U5; ?></td>
		<td><input class="addTroops" name="u5" id="u5" value="<?php echo $units['u5']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u5']; ?></b><font></td>
	</tr>
	
	<tr>
		<td><img src="../img/un/u/6.gif"></img> <?php echo U6; ?></td>
		<td><input class="addTroops" name="u6" id="u6" value="<?php echo $units['u6']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u6']; ?></b><font></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/7.gif"></img> <?php echo U7; ?></td>
		<td><input class="addTroops" name="u7" id="u7" value="<?php echo $units['u7']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u7']; ?></b><font></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/8.gif"></img> <?php echo U8; ?></td>
		<td><input class="addTroops" name="u8" id="u8" value="<?php echo $units['u8']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u8']; ?></b><font></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/9.gif"></img> <?php echo U9; ?></td>
		<td><input class="addTroops" name="u9" id="u9" value="<?php echo $units['u9']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u9']; ?></b><font></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/10.gif"></img> <?php echo U10; ?></td>
		<td><input class="addTroops" name="u10" id="u10" value="<?php echo $units['u10']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u10']; ?></b><font></td>
    </tr>
	
	<?php }
	else if($user['tribe'] == 2){ ?>
    </tr></thead><tbody> 
        <tr>
		<td class="addTroops"><img src="../img/un/u/11.gif"></img> <?php echo U11; ?></td>
		<td class="addTroops"><input class="addTroops" name="u11" id="u11" value="<?php echo $units['u11']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u11']; ?></td>
	</tr>
	
	<tr>
		<td><img src="../img/un/u/12.gif"></img> <?php echo U12; ?></td>
		<td><input class="addTroops" name="u12" id="u12" value="<?php echo $units['u12']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u12']; ?></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/13.gif"></img> <?php echo U13; ?></td>
		<td><input class="addTroops" name="u13" id="u13" value="<?php echo $units['u13']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u13']; ?></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/14.gif"></img> <?php echo U14; ?></td>
		<td><input class="addTroops" name="u14" id="u14" value="<?php echo $units['u14']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u14']; ?></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/15.gif"></img> <?php echo U15; ?></td>
		<td><input class="addTroops" name="u15" id="u15" value="<?php echo $units['u15']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u15']; ?></td>
	</tr>
	
	<tr>
		<td><img src="../img/un/u/16.gif"></img> <?php echo U16; ?></td>
		<td><input class="addTroops" name="u16" id="u16" value="<?php echo $units['u16']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u16']; ?></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/17.gif"></img> <?php echo U17; ?></td>
		<td><input class="addTroops" name="u17" id="u17" value="<?php echo $units['u17']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u17']; ?></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/18.gif"></img> <?php echo U18; ?></td>
		<td><input class="addTroops" name="u18" id="u18" value="<?php echo $units['u18']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u18']; ?></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/19.gif"></img> <?php echo U19; ?></td>
		<td><input class="addTroops" name="u19" id="u19" value="<?php echo $units['u19']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u19']; ?></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/20.gif"></img> <?php echo U20; ?></td>
		<td><input class="addTroops" name="u20" id="u20" value="<?php echo $units['u20']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u20']; ?></td>
    </tr>
	<?php }
	else if($user['tribe'] == 3){ ?>
    </tr></thead><tbody> 
        <tr>
		<td class="addTroops"><img src="../img/un/u/21.gif"></img> <?php echo U21; ?></td>
		<td class="addTroops"><input class="addTroops" name="u21" id="u21" value="<?php echo $units['u21']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u21']; ?></td>
	</tr>
	
	<tr>
		<td><img src="../img/un/u/22.gif"></img> <?php echo U22; ?></td>
		<td><input class="addTroops" name="u22" id="u22" value="<?php echo $units['u22']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u22']; ?></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/23.gif"></img> <?php echo U23; ?></td>
		<td><input class="addTroops" name="u23" id="u23" value="<?php echo $units['u23']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u23']; ?></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/24.gif"></img> <?php echo U24; ?></td>
		<td><input class="addTroops" name="u24" id="u24" value="<?php echo $units['u24']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u24']; ?></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/25.gif"></img> <?php echo U25; ?></td>
		<td><input class="addTroops" name="u25" id="u25" value="<?php echo $units['u25']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u25']; ?></td>
	</tr>
	
	<tr>
		<td><img src="../img/un/u/26.gif"></img> <?php echo U26; ?></td>
		<td><input class="addTroops" name="u26" id="u26" value="<?php echo $units['u26']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u26']; ?></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/27.gif"></img> <?php echo U27; ?></td>
		<td><input class="addTroops" name="u27" id="u27" value="<?php echo $units['u27']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u27']; ?></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/28.gif"></img> <?php echo U28; ?></td>
		<td><input class="addTroops" name="u28" id="u28" value="<?php echo $units['u28']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u28']; ?></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/29.gif"></img> <?php echo U29; ?></td>
		<td><input class="addTroops" name="u29" id="u29" value="<?php echo $units['u29']; ?>"" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u29']; ?></td>
	</tr>
	
	<tr>
        <td><img src="../img/un/u/30.gif"></img> <?php echo U30; ?></td>
		<td><input class="addTroops" name="u30" id="u30" value="<?php echo $units['u30']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u30']; ?></td>
    </tr>
    <?php }
    else if($user['tribe'] == 4){ ?>
    </tr></thead><tbody> 
        <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/31.gif"></img> <?php echo U31; ?></td>
        <td class="addTroops"><input class="addTroops" name="u31" id="u31" value="<?php echo $units['u31']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u31']; ?></td>
    </tr>
    
    
    <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/32.gif"></img> <?php echo U32; ?></td>
        <td><input class="addTroops" name="u32" id="u32" value="<?php echo $units['u32']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u32']; ?></td>
    </tr>
    
    <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/33.gif"></img> <?php echo U33; ?></td>
        <td><input class="addTroops" name="u33" id="u33" value="<?php echo $units['u33']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u33']; ?></td>
    </tr>
    
    <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/34.gif"></img> <?php echo U34; ?></td>
        <td><input class="addTroops" name="u34" id="u34" value="<?php echo $units['u34']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u34']; ?></td>
    </tr>
    
    <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/35.gif"></img> <?php echo U35; ?></td>
        <td><input class="addTroops" name="u35" id="u35" value="<?php echo $units['u35']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u35']; ?></td>
    </tr>
    
    <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/36.gif"></img> <?php echo U36; ?></td>
        <td><input class="addTroops" name="u36" id="u36" value="<?php echo $units['u36']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u36']; ?></td>
    </tr>
    
    <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/37.gif"></img> <?php echo U37; ?></td>
        <td><input class="addTroops" name="u37" id="u37" value="<?php echo $units['u37']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u37']; ?></td>
    </tr>
    <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/38.gif"></img> <?php echo U38; ?></td>
        <td><input class="addTroops" name="u38" id="u38" value="<?php echo $units['u38']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u38']; ?></td>
    </tr>
    
    <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/39.gif"></img> <?php echo U39; ?></td>
        <td><input class="addTroops" name="u39" id="u39" value="<?php echo $units['u39']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u39']; ?></td>
    </tr>
    
    <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/40.gif"></img> <?php echo U40; ?></td>
        <td><input class="addTroops" name="u40" id="u40" value="<?php echo $units['u40']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u40']; ?></td>
    </tr>
      <?php }
    else if($user['tribe'] == 5){ ?>
    </tr></thead><tbody> 
        <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/41.gif"></img> <?php echo U41; ?></td>
        <td class="addTroops"><input class="addTroops" name="u41" id="u41" value="<?php echo $units['u41']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u41']; ?></td>
    </tr>
    
    
    <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/42.gif"></img> <?php echo U42; ?></td>
        <td><input class="addTroops" name="u42" id="u42" value="<?php echo $units['u42']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u42']; ?></td>
    </tr>
    
    <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/43.gif"></img> <?php echo U43; ?></td>
        <td><input class="addTroops" name="u43" id="u43" value="<?php echo $units['u43']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u43']; ?></td>
    </tr>
    
    <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/44.gif"></img> <?php echo U44; ?></td>
        <td><input class="addTroops" name="u44" id="u44" value="<?php echo $units['u44']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u44']; ?></td>
    </tr>
    
    <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/45.gif"></img> <?php echo U45; ?></td>
        <td><input class="addTroops" name="u45" id="u45" value="<?php echo $units['u45']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u45']; ?></td>
    </tr>
    
    <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/46.gif"></img> <?php echo U46; ?></td>
        <td><input class="addTroops" name="u46" id="u46" value="<?php echo $units['u46']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u46']; ?></td>
    </tr>
    
    <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/47.gif"></img> <?php echo U47; ?></td>
        <td><input class="addTroops" name="u47" id="u47" value="<?php echo $units['u47']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u47']; ?></td>
    </tr>
    <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/48.gif"></img> <?php echo U48; ?></td>
        <td><input class="addTroops" name="u48" id="u48" value="<?php echo $units['u48']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u48']; ?></td>
    </tr>
    
    <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/49.gif"></img> <?php echo U49; ?></td>
        <td><input class="addTroops" name="u49" id="u49" value="<?php echo $units['u49']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u49']; ?></td>
    </tr>
    
    <tr>
        <td class="addTroops"><img src="../gpack/travian_default/img/u/50.gif"></img> <?php echo U50; ?></td>
        <td><input class="addTroops" name="u50" id="u50" value="<?php echo $units['u50']; ?>" maxlength="10">&nbsp;&nbsp;&nbsp;<font color="#bcbcbc" size="1">Currently: <b><?php echo $units['u50']; ?></td>
    </tr>
	<?php } ?>
	</tbody></table>
	<br />
	<div align="right"><input type="image" border="0" src="../img/admin/b/ok1.gif">
	</form>
	<?php } ?>
	<br /><br /><div align="right"><?php if(isset($_GET['d'])) { echo '<font color="Red"><b>Troops edited</font></b>';
	} ?>
