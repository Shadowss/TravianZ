<div id="build" class="gid17"><a href="#" onClick="return Popup(17,4);" class="build_logo"> 
	<img class="building g17" src="img/x.gif" alt="Marketplace" title="Marketplace" /> 
</a> 
<h1>Marketplace <span class="level">level <?php echo $village->resarray['f'.$id]; ?></span></h1> 
<p class="build_desc">At the Marketplace you can trade resources with other players. The higher its level, the more resources can be transported at the same time.
</p> 
 
<?php include("17_menu.tpl"); 


if(isset($_GET['c'])){
?>

<p><b>NPC completed.</b> Cost 3<img src="img/x.gif" class="gold" alt="Gold" title="Gold" /></p> 
<a href="javascript: history.go(-2)">Back to building</a> 
<?php } else { ?>

<p>With the NPC merchant you can distribute the resources in your warehouse as you desire. <br /><br />
The first line shows the current stock. In the second line you can choose another distribution. The third line shows the difference between the old and new stock.</p>


<script language="JavaScript"> 
var overall;
function calculateRes() {
	resObj=document.getElementsByName("m2");
	overall=0;
	for (i=0; i<resObj.length; i++) {
		var tmp="";
		for (j=0; j<resObj[i].value.length; j++)
			if ((resObj[i].value.charAt(j)>="0") && (resObj[i].value.charAt(j)<="9")) tmp=tmp+resObj[i].value.charAt(j);
		resObj[i].value=tmp;
		if (tmp=="") tmp="0";
		newRes=Math.round(parseInt(tmp)*summe/100);
		if (((i<3) && (newRes<=max123)) || ((i==3) && (newRes<=max4)))
			newHTML=newRes;
		else
			newHTML="<span class='corr'>"+newRes+"</span>";
		document.getElementById("new"+i).innerHTML=newHTML;
		overall+=parseInt(tmp);
	}
	document.getElementById("overall").innerHTML=overall+"%";
}
function normalize() {
	calculateRes();
	resObj=document.getElementsByName("m2");
	for (i=0; i<resObj.length; i++) {
		tmp=parseInt(resObj[i].value);
		tmp=tmp*(100/overall);
		resObj[i].value=Math.round(tmp);
	}
	calculateRes();
}
 
 
function calculateRest() {
	resObj=document.getElementsByName("m2[]");
	overall=0;
	for (i=0; i<resObj.length; i++) {
		var tmp="";
		for (j=0; j<resObj[i].value.length; j++)
			if ((resObj[i].value.charAt(j)>="0") && (resObj[i].value.charAt(j)<="9")) tmp=tmp+resObj[i].value.charAt(j);
		if (tmp=="") {
			tmp="0";
			newRes=0;
			resObj[i].value="";
		} else {
			newRes=parseInt(tmp);
			if ((i<3) && (newRes>max123)) newRes=max123;
			if ((i==3) && (newRes>max4)) newRes=max4;
			resObj[i].value=newRes;
		}
		dif=newRes-parseInt(document.getElementById("org"+i).innerHTML);
		newHTML=dif;
		if (dif>0) newHTML="+"+dif;
		document.getElementById("diff"+i).innerHTML=newHTML;
		overall+=newRes;
	}
	document.getElementById("newsum").innerHTML=overall;
	rest=parseInt(document.getElementById("org4").innerHTML)-overall;
	document.getElementById("remain").innerHTML=rest;
	testSum();
}
 
function fillup(nr) {
	resObj=document.getElementsByName("m2[]");
	if (nr<3) {
		resObj[nr].value=max123;
	} else {
		resObj[nr].value=max4;
	}
	calculateRest();
}
function portionOut() {
	restRes=parseInt(document.getElementById("remain").innerHTML);
	rest=restRes;
	resObj=document.getElementsByName("m2[]");
	nullCount=0;
	notNullCount=0;
	// Z&#65533;hlen
	for (j=0; j<resObj.length; j++) {
		if ((restRes>0) && (resObj[j].value=="")) nullCount++;
		if ((restRes<0) && (resObj[j].value!="")) notNullCount++;
	}
	// Verteilen
	nullCount2=0;
	if (restRes>0) {
		// In allen Feldern schon Zahlen?
		if (nullCount==0) {
			for (i=0; i<resObj.length; i++) {
				free=max123-parseInt(resObj[i].value);
				resObj[i].value=(parseInt(resObj[i].value)+Math.round(rest/(4-i)));
				rest=rest-Math.min(free,Math.round(rest/(4-i)));
				if ((i<3) && (parseInt(resObj[i].value)<max123)) nullCount2++;
			}
		} else {
			for (i=0; i<resObj.length; i++) {
				if (resObj[i].value=="") {
					resObj[i].value=Math.round(rest/nullCount);
					rest=rest-Math.round(rest/nullCount);
					nullCount--;
				}
				if ((i<3) && (parseInt(resObj[i].value)<max123)) nullCount2++;
			}
		}
	} else {
		for (j=0; j<resObj.length; j++) {
			if (parseInt(resObj[j].value)>0) {
				resObj[j].value=(parseInt(resObj[j].value)+Math.round(rest/notNullCount));
				rest=rest-Math.round(rest/notNullCount);
				notNullCount--;
			}
		}
	}
	calculateRest();
	// Noch irgendein Rest?
	if (rest>0) {
		if (max123>max4) {
			for (j=0; j<3; j++) {
				if (parseInt(resObj[j].value)<max123) {
					resObj[j].value=(parseInt(resObj[j].value)+Math.round(rest/nullCount2));
					rest=rest-Math.round(rest/nullCount2);
					nullCount2--;
				}
			}
		} else {
			resObj[3].value=(parseInt(resObj[3].value)+rest);
		}
	}
	calculateRest();
}
 
function testSum() {
	if (document.getElementById("remain").innerHTML!=0) {
		document.getElementById("submitText").innerHTML="<a href='javascript:portionOut();'>Distribute resources at (step 1 of 2)</a>";
		document.getElementById("submitText").style.display="block";
		document.getElementById("submitButton").style.display="none";
	} else {
		document.getElementById("submitText").innerHTML="";
		document.getElementById("submitText").style.display="none";
		document.getElementById("submitButton").style.display="block";
	}
}
</script> 
<script language="JavaScript">var summe=<?php echo floor($village->awood+$village->acrop+$village->airon+$village->aclay); ?>;var max123=<?php echo $village->maxstore; ?>;var max4=<?php echo $village->maxcrop; ?>;</script> 
		<form method="post" name="snd" action="build.php"> 
			<input type="hidden" name="id" value="<?php echo $id; ?>" /> 
			<input type="hidden" name="ft" value="mk3" /> 
			<input type="hidden" name="t" value="3" /> 

		<table id="npc" cellpadding="1" cellspacing="1"> 
			<thead> 
				<tr> 
					<th colspan="5">NPC Trade</th> 
				</tr> 
				<tr> 
	
			<td class="all"> 
				<a href="javascript:fillup(0);"><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /></a> 
				<span id="org0"><?php echo floor($village->awood); ?></span> 
			</td> 
		
			<td class="all"> 
				<a href="javascript:fillup(1);"><img class="r2" src="img/x.gif" alt="Clay" title="Clay" /></a> 
				<span id="org1"><?php echo floor($village->aclay); ?></span> 
			</td> 
		
			<td class="all"> 
				<a href="javascript:fillup(2);"><img class="r3" src="img/x.gif" alt="Iron" title="Iron" /></a> 
				<span id="org2"><?php echo floor($village->airon); ?></span> 
			</td> 
		
			<td class="all"> 
				<a href="javascript:fillup(3);"><img class="r4" src="img/x.gif" alt="Crop" title="Crop" /></a> 
				<span id="org3"><?php echo floor($village->acrop); ?></span> 
			</td> 
		
				<td class="sum">Sum:&nbsp;<span id="org4"><?php echo floor($village->awood+$village->acrop+$village->airon+$village->aclay); ?></span></td> 
			</tr> 
		</thead> 
		<tbody> 
			<tr> 
	
			<td class="sel"> 
				<input class="text" onkeyup="calculateRest();" name="m2[]" size="5" maxlength="7" <?php if(isset($_GET['r1'])) { echo "value=\"".$_GET['r1']."\""; } ?>/> 
				<input type="hidden" name="m1[]" value="<?php echo floor($village->awood); ?>" /> 
			</td> 
		
			<td class="sel"> 
				<input class="text" onkeyup="calculateRest();" name="m2[]" size="5" maxlength="7" <?php if(isset($_GET['r2'])) { echo "value=\"".$_GET['r2']."\""; } ?>/> 
				<input type="hidden" name="m1[]" value="<?php echo floor($village->aclay); ?>" /> 
			</td> 
		
			<td class="sel"> 
				<input class="text" onkeyup="calculateRest();" name="m2[]" size="5" maxlength="7" <?php if(isset($_GET['r3'])) { echo "value=\"".$_GET['r3']."\""; } ?>/> 
				<input type="hidden" name="m1[]" value="<?php echo floor($village->airon); ?>" /> 
			</td> 
		
			<td class="sel"> 
				<input class="text" onkeyup="calculateRest();" name="m2[]" size="5" maxlength="7" <?php if(isset($_GET['r4'])) { echo "value=\"".$_GET['r4']."\""; } ?>/> 
				<input type="hidden" name="m1[]" value="<?php echo floor($village->acrop); ?>" /> 
			</td> 
		
			<td class="sum">Sum:&nbsp;<span id="newsum"><?php if(isset($_GET['r1']) && isset($_GET['r2']) && isset($_GET['r3']) && isset($_GET['r4'])) { echo $_GET['r1']+$_GET['r2']+$_GET['r3']+$_GET['r4']; } else { echo 0; } ?></span></td> 
		</tr> 
		<tr> 
	
			<td class="rem"> 
				<span id="diff0"><?php echo 0-floor($village->awood); ?></span> 
			</td> 
		
			<td class="rem"> 
				<span id="diff1"><?php echo 0-floor($village->aclay); ?></span> 
			</td> 
		
			<td class="rem"> 
				<span id="diff2"><?php echo 0-floor($village->airon); ?></span> 
			</td> 
		
			<td class="rem"> 
				<span id="diff3"><?php echo 0-floor($village->acrop); ?></span> 
			</td> 
		
					<td class="sum">Rest:&nbsp;<span id="remain">
                    <?php if(isset($_GET['r1']) && isset($_GET['r2']) && isset($_GET['r3']) && isset($_GET['r4'])) { 
                    echo floor($village->awood+$village->acrop+$village->airon+$village->aclay)-($_GET['r1']+$_GET['r2']+$_GET['r3']+$_GET['r4']); 
                    } else { echo floor($village->awood+$village->acrop+$village->airon+$village->aclay); } ?></span></td> 
				</tr> 
			</tbody> 
		</table> 
		<p id="submitButton"> 
	<?php if($session->userinfo['gold'] > 3) { ?><a href="javascript:document.snd.submit();">Trade resources at (step 2 of 2)</a> <span class="none">(Costs: <img src="img/x.gif" class="gold_g" alt="Gold" title="Gold" /><b>3</b>)</span><?php } else { echo"<span class='none'>Trade resources at (step 2 of 2)</span> (Costs: <img src='img/x.gif' class='gold' alt='Gold' title='Gold' /><b>3</b>)"; }?>	</p>
		<p id="submitText"></p> 
		</form> 
		<script> 
			testSum();
		</script> 
        
		<?php } ?>
	</div>