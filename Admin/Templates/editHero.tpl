<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       playerheroinfo.tpl                                          ##
##  Developed by:  ronix                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################
if(isset($_GET['uid'])){
	$id = (int) $_GET['uid'];
	$hid = (int) $_GET['hid'];
	include_once("../GameEngine/Data/hero_full.php"); 
	include_once("../GameEngine/Units.php");
	$heroes = $units->Hero($id,1);

	foreach ($heroes as $hdata) {
		if ($hdata['heroid'] == $hid) {
			$hero = $hdata;
			break;
		}
	}

	$unarray = array(1=>U1,U2,U3,U4,U5,U6,U7,U8,U9,U10,U11,U12,U13,U14,U15,U16,U17,U18,U19,U20,U21,U22,U23,U24,U25,U26,U27,U28,U29,U30,U31,U32,U33,U34,U35,U36,U37,U38,U39,U40,U41,U42,U43,U44,U45,U46,U47,U48,U49,U50,U99,U0);
	$utribe=($user['tribe']-1)*10;
?>
<style>
td {
	vertical-align:middle; padding:2px 7px; border:1px solid silver; font-size:13px; color:black;
}
th {
	vertical-align:middle; padding:2px 7px; border:1px solid silver; font-size:13px; color:black;
}
.thead {
	background-image:url(../img/un/a/c2.gif); background-repeat:repeat; text-align:center; font-weight:bold;
}
</style>
<script LANGUAGE="JavaScript">
function changeValue(u,c) {
	var objv=document.getElementById(c);
	var objd=document.getElementById(c+'2');
	var obje=document.getElementById('exp1');
	n=objv.value;
	l=document.frmHero.hlvl.value;
	e=document.frmHero.exp.value;
	if (u==0) {
		if (n<5){
			v=0;
		}else{
			v=n-5;
			if (l>0){
				l-=1;
			}else if (v==0 && l==0) {
				obje.innerHTML='5';
				document.frmHero.exp.value='5';
			}
		}

	}
	if (u==1) {
		if (n>95){
			v=100;
		}else{
			if(e!=0) {
				obje.innerHTML='0';
				document.frmHero.exp.value='0';
			}else{
				if (l<99) l++;
			}	
			v=parseInt(n) + 5;
		}
	}
if (v>0) document.getElementById(c+'0').innerHTML="<a href=\"#\" onclick=\"return changeValue(0,'"+c+"')\">(-)</a>";	
if (v<99) document.getElementById(c+'1').innerHTML="<a href=\"#\" onclick=\"return changeValue(1,'"+c+"')\">(+)</a>";
if (v<1) document.getElementById(c+'0').innerHTML="<font color=\"grey\">(-)</font>";
if (v>98) document.getElementById(c+'1').innerHTML="<font color=\"grey\">(+)</font>";
document.getElementById("hlvl").innerHTML=l;
objd.innerHTML=v;
objv.value=v;
document.frmHero.hlvl.value=l;
return(true);
}
function go_url(url) {
	location=url;
	return(false);
}
function check_unit(el) {
	var obj=el;
	var uname=obj.options[obj.options.selectedIndex].text;
	document.getElementById("unt").innerHTML=""+
	"<span><img class=\"unit u"+obj.value+"\" src=\"img/x.gif\" alt=\""+uname+"\" title=\""+uname+"\" /></span>";
}
</script>
	<form name="frmHero" action="../GameEngine/Admin/Mods/editHero.php" method="POST">
		<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<input type="hidden" name="hid" value="<?php echo $hid; ?>" />
<table style="border-collapse:collapse; margin-top:25px; line-height:16px; width:100%;">
	<tr>
		<td colspan="6" align="center"><b>Edit Player Hero</b></td>
	</tr>

	<tr class="thead">
		<td width="30%">Details</td>
		<td width="35%" colspan="2">Old Value</td>
		<td width="35%" colspan="3">New Value</td>
	</tr>
	<tr>
		<td>Hero Name</td> 
		<td colspan="2"><?php echo $hero['name'];?></td>
		<td colspan="3"><input name="hname" class="fm" value="<?php echo $hero['name'];?>"></td> 
	</tr>
	<tr>
		<td>Hero Level</td> 
		<td colspan="2"><?php echo $hero['level']; ?></td> 
		<td colspan="3" style="font-weight:bold"><div id="hlvl">0</div><input name="hlvl" type="hidden" value="0"</td> 
	</tr>
	<tr>
		<td>Hero Unit</td> 
		<td colspan="2"><?php echo "<img class=\"unit u".$hero['unit']."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($hero['unit'])."\" title=\"".$technology->getUnitName($hero['unit'])."\" /> (".$technology->getUnitName($hero['unit']); ?>)</td>
		<td width="10%" align="center" style="border-right:none"><div id="unt"><?php echo "<img class=\"unit u".$hero['unit']."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($hero['unit'])."\" title=\"".$technology->getUnitName($hero['unit'])."\" />";?></div></td>
		<td width="25%" colspan="2" style="border-left:none" align="left"><select name="hunit" class="dropdown" onchange="check_unit(this)">
						<?php
						for ($i=1;$i<7;$i++) {
							if (($i==3 && $user['tribe']==4) || ($i==4 && $user['tribe']!=3)) {
							}else{
								echo "<option value='".($utribe+$i)."'".($hero['unit'] == ($utribe+$i)? 'selected':'').">".$unarray[($utribe+$i)]."</option>\<br>";
							}
						}
						?>		
					</select>
		</td> 
	</tr>
	<tr class="thead">
		<td>Items</td>
		<td width="18%">Point</td>
		<td width="17%">Level</td>
		<td colspan="3" width="35%">Level</td>
	</tr>
	<tr>
		<td>Offence</td> 
		<td align="center"><?php echo $hero['atk']; ?></td> 
		<td align="center"><?php echo $hero['attack'];?></td> 		
		<td width="10%" align="center" id="hatk0"><font color="grey">(-)</font></td>
		<td width="10%" align="center" id="hatk1"><a href="#" onclick="return changeValue(1,'hatk')">(+)</a></td> 
		<td width="15%" align="center" style="font-weight:bold"><div id="hatk2">0</div><input id="hatk" name="hatk" type="hidden" value="0"></td> 
	</tr> 
	<tr> 
		<td>Defence</td> 
		<td align="center"><?php echo $hero['di'] . "/" . $hero['dc']; ?></td>
		<td align="center"><?php echo $hero['defence'];?></td>	
		<td align="center" id="hdef0"><font color="grey">(-)</font></td>
		<td align="center" id="hdef1"><a href="#" onclick="return changeValue(1,'hdef')">(+)</a></td> 
		<td align="center" style="font-weight:bold"><div id="hdef2">0</div><input id="hdef" name="hdef" type="hidden" value="0"></td>
		</tr> 
        <tr> 
			<td>Off-Bonus</td> 
			<td align="center"><?php echo ($hero['ob']-1)*100; ?>%</td> 
			<td align="center"><?php echo $hero['attackbonus'];?></td>			
			<td align="center" id="hob0"><font color="grey">(-)</font></td>
			<td align="center" id="hob1"><a href="#" onclick="return changeValue(1,'hob')">(+)</a></td> 
			<td align="center" style="font-weight:bold"><div id="hob2">0</div><input id="hob" name="hob" type="hidden" value="0"></td>
		</tr> 
		<tr> 
			<td>Def-Bonus</td> 
			<td align="center"><?php echo ($hero['db']-1)*100; ?>%</td> 
			<td align="center"><?php echo $hero['defencebonus'];?></td>			
			<td align="center" id="hdb0"><font color="grey">(-)</font></td>
			<td align="center" id="hdb1"><a href="#" onclick="return changeValue(1,'hdb')">(+)</a></td> 
			<td align="center" style="font-weight:bold"><div id="hdb2">0</div><input id="hdb" name="hdb" type="hidden" value="0"></td>
		</tr> 
		<tr> 
			<td>Regeneration</td> 
			<td align="center"><?php echo ($hero['regeneration']*5*SPEED); ?>/Day</font></td> 
			<td align="center"><?php echo $hero['regeneration'];?></td>			
			<td align="center" id="hrege0"><font color="grey">(-)</font></td>
			<td align="center" id="hrege1"><a href="#" onclick="return changeValue(1,'hrege')">(+)</a></td> 
			<td align="center" style="font-weight:bold"><div id="hrege2">0</div><input id="hrege" name="hrege" type="hidden" value="0"></td>
		<tr> 
			<?php 
			$count_level_exp=500-intval($hero['attack']+$hero['defence']+$hero['attackbonus']+$hero['defencebonus']+$hero['regeneration']);
			if ($hero['points']>$count_level_exp) $hero['points']=$count_level_exp;
			if($hero['experience'] < 495000){ ?>
				<td>Experience</td>
				<td colspan="2" align="center"><?php echo (int) (($hero['experience'] - $hero_levels[$hero['level']]) / ($hero_levels[$hero['level']+1] - $hero_levels[$hero['level']])*100) ?>% (
				<?php echo $hero['points']; ?>)</td> 
			<?php }else{ ?>
				<td>Experience</td>
				<td colspan="2" align="center">100% (<?php echo $hero['points']; ?>)</td> 
			<?php } ?>
			<td align="center" style="font-weight:bold" colspan="3"><div id="exp1">5</div><input id="exp" name="exp" type="hidden" value="5"></td> 
			
		</tr>
		<tr> 
			<td>Health</td>
			<td colspan="2" align="center"><?php echo round($hero['health']);?>%</td>			
			<td colspan="3" align="center"><input name="hhealth" class="fm fm40" maxlength="3" value="<?php echo round($hero['health']);?>">%</td> 
		</tr>
		<tr class="thead">
			<td style="border-right:none" align="left"><input name="back" type="image" id="btn_back" class="dynamic_img" src="img/x.gif" value="back" alt="back" onclick="return go_url('../Admin/admin.php?p=player&uid=<?php echo $_GET["uid"];?>')" /></td>
			<td style="border-left:none" colspan="5" align="right"><input name="save" type="image" id="btn_save" class="dynamic_img" src="img/x.gif" value="save" alt="save" /></td>
		</tr>
	</table>
	</form>
	<?php
	}	
	if(isset($_GET['e'])){
		echo '<div align="center"><font color="Red"><b>Please fill hero name</font></b></div>';
	}
	?>