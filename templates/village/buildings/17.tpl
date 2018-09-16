{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/17_menu.tpl'}
{if isset($parameters['t'])}
	{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/17_'|cat:$parameters['t']|cat:'.tpl'}
{else}
<script> 
var haendler =  {$villageMerchants['available']}
var carry = {$villageMerchants['maxCarry']}
</script>

{if $tradeSecondPhase}
<form method="POST" action="?id={$parameters['id']}"> 
{if $goldclub}
<input type="hidden" name="repetitions" value="{$tradeRepetitions}">
{/if}
<input type="hidden" name="villageVref" value="{$tradeVref}">
<table id="send_select" class="send_res" cellpadding="1" cellspacing="1">
	<tr>
		<td class="ico">
			<img class="r1" src="assets/img/x.gif" alt="{$smarty.const.LUMBER}" title="{$smarty.const.LUMBER}" />
		</td> 
		<td class="nam"> {$smarty.const.LUMBER}</td> 
		<td class="val">
			<input class="text disabled" type="text" name="wood" id="wood" value="{$wood}" readonly="readonly">
		</td> 
		<td class="max"> / 
			<span class="none">
				<b>{$villageMerchants['maxCarry']}</b>
			</span> 
		</td> 
	</tr>
    <tr> 
		<td class="ico">
			<img class="r2" src="assets/img/x.gif" alt="{$smarty.const.CLAY}" title="{$smarty.const.CLAY}" />
		</td> 
		<td class="nam"> {$smarty.const.CLAY}</td> 
		<td class="val">
			<input class="text disabled" type="text" name="clay" id="clay" value="{$clay}" readonly="readonly">
		</td> 
		<td class="max"> / 
			<span class="none">
				<b>{$villageMerchants['maxCarry']}</b>
			</span> 
		</td> 
	</tr>
    <tr> 
		<td class="ico">
			<img class="r3" src="assets/img/x.gif" alt="{$smarty.const.IRON}" title="{$smarty.const.IRON}" />
		</td> 
		<td class="nam"> {$smarty.const.IRON}</td> 
		<td class="val">
			<input class="text disabled" type="text" name="iron" id="iron" value="{$iron}" readonly="readonly"> 
		</td> 
		<td class="max"> / 
			<span class="none">
				<b>{$villageMerchants['maxCarry']}</b>
			</span> 
		</td> 
	</tr>
    <tr> 
		<td class="ico">
			<img class="r4" src="assets/img/x.gif" alt="{$smarty.const.CROP}" title="{$smarty.const.CROP}" />
		</td> 
		<td class="nam"> {$smarty.const.CROP}</td> 
		<td class="val"> 
			<input class="text disabled" type="text" name="crop" id="crop" value="{$crop}" readonly="readonly"> 
		</td> 
		<td class="max"> / 
			<span class="none">
				<b>{$villageMerchants['maxCarry']}</b>
			</span>
		</td> 
	</tr>
</table> 

<table id="target_validate" class="res_target" cellpadding="1" cellspacing="1">
	<tbody>
	<tr>
		<th>{$smarty.const.COORDINATES}:</th>
		<td>
			<a href="karte.php?d={$tradeVref}&c={$tradeMapCheck}">({$tradeVillageCoordinates['x']}|{$tradeVillageCoordinates['y']})
				<span class="clear"></span>
			</a>
		</td>
	</tr>
	<tr>
		<th>{$smarty.const.PLAYER}:</th>
		<td><a href="spieler.php?uid={$tradeOwner}">{$tradeOwnerUsername}</a></td>
	</tr>
	<tr>
		<th>{$smarty.const.DURATION}:</th>
		<td>{$tradeDuration}</td>
	</tr>
	<tr>
		<th>{$smarty.const.MERCHANT}:</th>
		<td>{$tradeNeededMerchants}</td>
	</tr>
	<tr>
		<th>{$smarty.const.REPETITIONS}:</th>
		<td>{$tradeRepetitions}</td>
	</tr>

	<tr>
		<td colspan="2"></td>
	</tr>

</tbody>
</table>

<div class="clear"></div>
<p>
<div class="clear"></div>
<p>
	<button name="action" id="btn_save" class="trav_buttons" value="sendTrade" {if $villageMerchants['available'] == 0}disabled="disabled"{/if}> OK </button>
</p>
</form>

{else}

<form method="POST" name="snd" action="?id={$parameters['id']}"> 
<table id="send_select" class="send_res" cellpadding="1" cellspacing="1"><tr> 
		<td class="ico"> 
			<a href="#" onClick="upd_res('wood', 1, 1); return false;"><img class="r1" src="assets/img/x.gif" alt="{$smarty.const.LUMBER}" title="{$smarty.const.LUMBER}" /></a> 
		</td> 
		<td class="nam"> 
			{$smarty.const.LUMBER}:
		</td> 
		<td class="val"> 
			<input class="text" type="text" name="wood" id="wood" value="" maxlength="5" onKeyUp="upd_res('wood', 1)" tabindex="1"> 
		</td> 
		<td class="max"> 
			<a href="#" onMouseUp="add_res('wood', 1);" onClick="return false;">({$villageMerchants['maxCarry']})</a> 
		</td> 
	</tr><tr> 
		<td class="ico"> 
			<a href="#" onClick="upd_res('clay', 2, 1); return false;"><img class="r2" src="assets/img/x.gif" alt="{$smarty.const.CLAY}" title="{$smarty.const.CLAY}" /></a> 
		</td> 
		<td class="nam"> 
			{$smarty.const.CLAY}:
		</td> 
		<td class="val"> 
			<input class="text" type="text" name="clay" id="clay" value="" maxlength="5" onKeyUp="upd_res('clay', 2)" tabindex="2"> 
		</td> 
		<td class="max"> 
			<a href="#" onMouseUp="add_res('clay', 2);" onClick="return false;">({$villageMerchants['maxCarry']})</a> 
		</td> 
	</tr><tr> 
		<td class="ico"> 
			<a href="#" onClick="upd_res('iron', 3, 1); return false;"><img class="r3" src="assets/img/x.gif" alt="{$smarty.const.IRON}" title="{$smarty.const.IRON}" /></a> 
		</td> 
		<td class="nam"> 
			{$smarty.const.IRON}:
		</td> 
		<td class="val"> 
			<input class="text" type="text" name="iron" id="iron" value="" maxlength="5" onKeyUp="upd_res('iron', 3)" tabindex="3"> 
		</td> 
		<td class="max"> 
			<a href="#" onMouseUp="add_res('iron', 3);" onClick="return false;">({$villageMerchants['maxCarry']})</a> 
		</td> 
	</tr><tr> 
		<td class="ico"> 
			<a href="#" onClick="upd_res('crop', 4, 1); return false;"><img class="r4" src="assets/img/x.gif" alt="{$smarty.const.CROP}" title="{$smarty.const.CROP}" /></a> 
		</td> 
		<td class="nam"> 
			{$smarty.const.CROP}:
		</td> 
		<td class="val"> 
			<input class="text" type="text" name="crop" id="crop" value="" maxlength="5" onKeyUp="upd_res('crop', 4)" tabindex="4"> 
		</td> 
		<td class="max"> 
			<a href="#" onMouseUp="add_res('crop', 4);" onClick="return false;">({$villageMerchants['maxCarry']})</a> 
		</td> 
	</tr></table> 
 
<table id="target_select" class="res_target" cellpadding="1" cellspacing="1"> 
	<tr> 
		<td class="mer">{$smarty.const.MERCHANT} {$villageMerchants['available']}/{$villageMerchants['total']}</td> 
	</tr> 
	<tr>
		<td class="vil"> 
			<span>{$smarty.const.MULTI_V_HEADER}:</span> 
			<input class="text" type="text" name="villageName" value="" maxlength="30" tabindex="5"> 
		</td> 
	</tr>
	<tr> 
		<td class="or">{$smarty.const.OR_}</td> 
	</tr> 
   <tr> 
      <td class="coo"> 
         <span>{$smarty.const.X}:</span><input class="text" type="text" name="x" maxlength="4" tabindex="6"> 
         <span>{$smarty.const.Y}:</span><input class="text" type="text" name="y" maxlength="4" tabindex="7"> 
      </td> 
   </tr> 
</table>

<div class="clear"></div>

{if $goldclub}
<p>
	<select name="repetitions">
		<option value="1" selected="selected">1x</option>
		<option value="2">2x</option>
		<option value="3">3x</option>
	</select> 
	{$smarty.const.GO}
</p>
{/if}

<p>
	<button name="action" id="btn_save" class="trav_buttons" value="prepareTrade" {if $villageMerchants['available'] == 0}disabled="disabled"{/if}> OK </button>
</p>
</form>

{include file=$smarty.const.TEMPLATES_DIR|cat:'error.tpl'}

<p>
{/if}

<p>{$smarty.const.MERCHANT_CARRY} <b>{$villageMerchants['maxCarry']}</b> {$smarty.const.UNITS_OF_RESOURCE} </p>


{* Trades coming to this village *}

{if !empty($villageMarketplaceTrades['from'])}

<h4>{$smarty.const.MERCHANT_COMING}:</h4>

{assign var=transportText value=$smarty.const.TRANSPORT_FROM}
{foreach $villageMarketplaceTrades['from'] as $trade}
	{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/trade.tpl'}
{/foreach}

{/if}


{* Trades coming from this village *}

{if !empty($villageMarketplaceTrades['to'])}

<h4>{$smarty.const.MERCHANT_ON_WAY}:</h4>
{assign var=transportText value=$smarty.const.TRANSPORT_TO}
{foreach $villageMarketplaceTrades['to'] as $trade}
	{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/trade.tpl'}
{/foreach}

{/if}


{* Trades returning to this village *}

{if !empty($villageMarketplaceTrades['returning'])}

<h4>{$smarty.const.MERCHANT_RETURNING}:</h4>
{assign var=transportText value=$smarty.const.RETURNING_FROM}
{assign var=returning value=true}
{foreach $villageMarketplaceTrades['returning'] as $trade}
	{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/trade.tpl'}
{/foreach}

{/if}

{/if}