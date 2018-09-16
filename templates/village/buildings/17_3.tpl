{if !empty($npcCompleted)}
<p>
	<b>{$smarty.const.NPC_COMPLETED}.</b> 
	{$smarty.const.COSTS} 3<img src="assets/img/x.gif" class="gold" alt="{$smarty.const.GOLD}" title="{$smarty.const.GOLD}" />
</p> 
<a href="javascript: history.go(-2)">{$smarty.const.BACK_BUILDING}</a> 
{else}
<p>{$smarty.const.NPC_TRADE_DESC}</p>

{include file=$smarty.const.TEMPLATES_DIR|cat:'error.tpl'}

<script> 
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
	if (document.getElementById("remain").innerHTML > 0) {
		document.getElementById("submitText").innerHTML="<a href='javascript:portionOut();'>{$smarty.const.DISTRIBUTE_RESOURCES}</a>";
		document.getElementById("submitText").style.display="block";
		document.getElementById("submitButton").style.display="none";
	} else {
		document.getElementById("submitText").innerHTML="";
		document.getElementById("submitText").style.display="none";
		document.getElementById("submitButton").style.display="block";
	}
}

	var summe={$villageTotalResources};
	var max123={$villageMaxStore};
	var max4={$villageMaxCrop};
</script>

<form method="post" name="snd" action="build.php?id={$parameters['id']}&t=3">
		<input type="hidden" value="tradeNPCResources" name="action"/>
        {if !$villageIsNatar}
		<table id="npc" cellpadding="1" cellspacing="1"> 
			<thead> 
				<tr> 
					<th colspan="5">{$smarty.const.NPC_TRADE}</th> 
				</tr> 
				<tr>
			<td class="all"> 
				<a href="javascript:fillup(0);">
					<img class="r1" src="assets/img/x.gif" alt="{$smarty.const.LUMBER}" title="{$smarty.const.LUMBER}" />
				</a> 
				<span id="org0">{$villageResources['wood']}</span> 
			</td> 
		
			<td class="all"> 
				<a href="javascript:fillup(1);">
					<img class="r2" src="assets/img/x.gif" alt="{$smarty.const.CLAY}" title="{$smarty.const.CLAY}" />
				</a> 
				<span id="org1">{$villageResources['clay']}</span> 
			</td> 
		
			<td class="all"> 
				<a href="javascript:fillup(2);">
					<img class="r3" src="assets/img/x.gif" alt="{$smarty.const.IRON}" title="{$smarty.const.IRON}" />
				</a> 
				<span id="org2">{$villageResources['iron']}</span> 
			</td> 
		
			<td class="all"> 
				<a href="javascript:fillup(3);">
					<img class="r4" src="assets/img/x.gif" alt="{$smarty.const.CROP}" title="{$smarty.const.CROP}" />
				</a> 
				<span id="org3">{$villageResources['crop']}</span> 
			</td> 
		
				<td class="sum">{$smarty.const.SUM}:&nbsp;<span id="org4">{$villageTotalResources}</span></td> 
			</tr> 
		</thead> 
		<tbody> 
			<tr> 
				<td class="sel"> 
					<input class="text" onkeyup="calculateRest();" name="m2[]" size="5" maxlength="7" {if isset($parameters['r1'])}value="{$parameters['r1']}"{/if} /> 
					<input type="hidden" name="m1[]" value="{$villageResources['wood']}" /> 
				</td> 
		
				<td class="sel"> 
					<input class="text" onkeyup="calculateRest();" name="m2[]" size="5" maxlength="7" {if isset($parameters['r2'])}value="{$parameters['r2']}"{/if} /> 
					<input type="hidden" name="m1[]" value="{$villageResources['clay']}" /> 
				</td> 
		
				<td class="sel"> 
					<input class="text" onkeyup="calculateRest();" name="m2[]" size="5" maxlength="7" {if isset($parameters['r3'])}value="{$parameters['r3']}"{/if} /> 
					<input type="hidden" name="m1[]" value="{$villageResources['iron']}" /> 
				</td> 
		
				<td class="sel"> 
					<input class="text" onkeyup="calculateRest();" name="m2[]" size="5" maxlength="7" {if isset($parameters['r4'])}value="{$parameters['r4']}"{/if} /> 
					<input type="hidden" name="m1[]" value="{$villageResources['crop']}" /> 
				</td> 
		
				<td class="sum">{$smarty.const.SUM}:&nbsp;<span id="newsum">
				        {if isset($parameters['r1']) && isset($parameters['r2']) && isset($parameters['r3']) && isset($parameters['r4'])}
				            {$parameters['r1'] + $parameters['r2'] + $parameters['r3'] + $parameters['r4']}
				        {else}
				            0
				        {/if}
				    </span>
				</td> 
			</tr> 
			
			<tr> 
				<td class="rem"> 
					<span id="diff0">{-$villageResources['wood']}</span> 
				</td> 
		
				<td class="rem"> 
					<span id="diff1">{-$villageResources['clay']}</span> 
				</td> 
		
				<td class="rem"> 
					<span id="diff2">{-$villageResources['iron']}</span> 
				</td> 
		
				<td class="rem"> 
					<span id="diff3">{-$villageResources['crop']}</span> 
				</td>
				<td class="sum">{$smarty.const.REST}:&nbsp;<span id="remain">
                	{if isset($parameters['r1']) && isset($parameters['r2']) && isset($parameters['r3']) && isset($parameters['r4'])} 
                		{$villageTotalResources - $parameters['r1'] + $parameters['r2'] + $parameters['r3'] + $parameters['r4']} 
                	{else} 
                		{$villageTotalResources}
                	{/if}
                	</span>
                </td> 
			</tr> 
			</tbody> 
		</table> 
		<p id="submitButton"> 
	    	{if $gold >= 3}
				<a href="javascript:document.snd.submit();">{$smarty.const.TRADE_RESOURCES}</a> 
				<span class="none">({$smarty.const.COSTS}: <img src="assets/img/x.gif" class="gold_g" alt="{$smarty.const.GOLD}" title="{$smarty.const.GOLD}" /><b>3</b>)</span>
			{else} 
				<span class='none'>{$smarty.const.TRADE_RESOURCES}</span> ({$smarty.const.COSTS}: <img src="assets/img/x.gif" class="gold" alt="{$smarty.const.GOLD}" title="{$smarty.const.GOLD}" /><b>3</b>)
			{/if}
		</p>
		<p id="submitText"></p> 
		</form>

		<script> 
			testSum();
		</script> 
        
		{else}
			<b>{$smarty.const.YOU_CAN_NAT_NPC_WW}</b>
		{/if}
	{/if}