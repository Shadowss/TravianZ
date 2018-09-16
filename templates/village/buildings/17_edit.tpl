<form action="build.php?id={$parameters['id']}&t=4" method="post">
	<div class="boxes boxesColor gray">
		<div class="boxes-tl"></div>
		<div class="boxes-tr"></div>
		<div class="boxes-tc"></div>
		<div class="boxes-ml"></div>
		<div class="boxes-mr"></div>
		<div class="boxes-mc"></div>
		<div class="boxes-bl"></div>
		<div class="boxes-br"></div>
		<div class="boxes-bc"></div>
		<div class="boxes-contents cf">
			<input type="hidden" name="routeid" value="{$tradeRoute['id']}">
			<table cellpadding="1" cellspacing="1" id="npc" class="transparent">
				<thead>
					<tr>
						<th colspan="2">{$smarty.const.EDIT_TRADE_ROUTES}</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>
							{$smarty.const.RESOURCES}:					
						</th>
						<td>
							<img src="{$smarty.const.GP_LOCATE}img/r/1.gif" alt="{$smarty.const.LUMBER}" title="{$smarty.const.LUMBER}">
							<input class="text" type="text" name="wood" id="r1" value="{$tradeRoute['resources'][0]}" maxlength="5" tabindex="1" style="width: 50px;">
							<img src="{$smarty.const.GP_LOCATE}img/r/2.gif" alt="{$smarty.const.CLAY}" title="{$smarty.const.CLAY}"> 
							<input class="text" type="text" name="clay" id="r2" value="{$tradeRoute['resources'][1]}" maxlength="5" tabindex="1" style="width: 50px;">
							<img src="{$smarty.const.GP_LOCATE}img/r/3.gif" alt="{$smarty.const.IRON}" title="{$smarty.const.IRON}">
							<input class="text" type="text" name="iron" id="r3" value="{$tradeRoute['resources'][2]}" maxlength="5" tabindex="1" style="width: 50px;"> 
							<img src="{$smarty.const.GP_LOCATE}img/r/4.gif" alt="{$smarty.const.CROP}" title="{$smarty.const.CROP}"> 
							<input class="text" type="text" name="crop" id="r4" value="{$tradeRoute['resources'][3]}" maxlength="5" tabindex="1" style="width: 50px;">
						</td>
					</tr>
					<tr>
						<th>
							{$smarty.const.START_TIME_TRADE}:			
						</th>
						<td>
							<select name="start">
								{for $i = 0 to 23}
								<option value="{$i}"
									{if $i == $tradeRoute['start']}selected="selected"{/if}>
									{if $i <= 9}0{/if}{$i}
								</option>
								{/for}
							</select>
						</td>
					</tr>
					<tr>
						<th>
							{$smarty.const.DELIVERIES}:					
						</th>
						<td>
							<select name="deliveries">
								{for $i = 1 to 3}
								<option value="{$i}"
									{if $i == $tradeRoute['deliveries']}selected="selected"{/if}>{$i}
								</option>
								{/for}
							</select>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<p>
		<button type="submit" name="action" value="updateTradeRoute" id="btn_id" class="trav_buttons"> {$smarty.const.SAVE} </button>
	</p>
</form>
