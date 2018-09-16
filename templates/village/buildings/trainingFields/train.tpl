<form method="POST" name="snd" action="?id={$parameters['id']}">
	<table cellpadding="1" cellspacing="1" class="build_details">
		<thead>
			<tr>
				<td>{$smarty.const.NAME}</td>
				<td>{$smarty.const.QUANTITY}</td>
				<td>{$smarty.const.MAX}</td>
			</tr>
		</thead>
		<tbody>

	{foreach $villageTrainableUnits[$villageUnitsToTrainClass] as $index => $unit}

	{if $villageUnitsToTrainGreat}
		{assign var=great value=3}
	{else}
		{assign var=great value=1}
	{/if}

			<tr>
				<td class="desc">
					<div class="tit">
						<img class="unit u{if $index == 12}99{else}{($tribe - 1) * 10 + $index}{/if}" src="assets/img/x.gif" alt="{$unit.name}" title="{$unit.name}" />
						 <a href="#" onClick="return Popup({if $index == 12}99{else}{($tribe - 1) * 10 + $index}{/if}, 1);">
							{$unit.name}
						</a> 
						<span class="info">({$smarty.const.AVAILABLE}: {$unit.amount})</span>
					</div>
					<div class="details">
						<img class="r1" src="assets/img/x.gif" alt="{$smarty.const.LUMBER}" title="{$smarty.const.LUMBER}" />{$unit.resources[0] * $great}|
						<img class="r2" src="assets/img/x.gif" alt="{$smarty.const.CLAY}" title="{$smarty.const.CLAY}" />{$unit.resources[1] * $great}|
						<img class="r3" src="assets/img/x.gif" alt="{$smarty.const.IRON}" title="{$smarty.const.IRON}" />{$unit.resources[2] * $great}|
						<img class="r4" src="assets/img/x.gif" alt="{$smarty.const.CROP}" title="{$smarty.const.CROP}" />{$unit.resources[3] * $great}|
						<img class="r5" src="assets/img/x.gif" alt="{$smarty.const.CROP_COM}" title="{$smarty.const.CROP_COM}" />{$unit.upkeep}|
						<img class="clock" src="assets/img/x.gif" alt="Duration" title="{$smarty.const.DURATION}" />{$unit.duration}
						{if $gold >= 3 && $villageIsMarketplaceBuilt && $villageTotalResources >= $unit.totalResources * $great}
						|<a href="build.php?gid=17&t=3&r1=&r2=&r3=&r4=">
							<img class="npc" src="assets/img/x.gif" alt="{$smarty.const.NPC_TRADE}" title="{$smarty.const.NPC_TRADE}" />
						</a>
						{/if}
					</div>
				</td>
				<td class="val">
					<input type="text" class="text" name="u{$index}" value="0" maxlength="10"></td>
				<td class="max">
					<a href="#" onClick="document.snd.u{$index}.value={floor($unit.max / $great)}; returnfalse;">({floor($unit.max / $great)})</a>
				</td>
			</tr>
	{/foreach}
			{if empty($villageTrainableUnits[$villageUnitsToTrainClass])}
			<tr>
				
				<td colspan="3">
					<div class="none" align="center">{$smarty.const.AVAILABLE_ACADEMY}</div>
				</td>
			</tr>
			{/if}
	</tbody>
	</table>
	<p>
		<button id="btn_train" class="trav_buttons" value="train" name="action" onclick="setTimeout('this.disabled=true', 1);">
			{$smarty.const.TRAIN}
		</button>
</form>