<div id="res">
<div id="resWrap">

	<table cellpadding="1" cellspacing="1">
		<tr>
							<td>
								<img src="assets/img/x.gif" class="r1" alt="{$smarty.const.LUMBER}" title="{$smarty.const.LUMBER}"/>
							</td>
				<td id="l4" title="{$villageProduction['wood']}">{$villageResources['wood']}/{$villageMaxStore}</td>
							<td>
								<img src="assets/img/x.gif" class="r2" alt="{$smarty.const.CLAY}" title="{$smarty.const.CLAY}" />
							</td>
				<td id="l3" title="{$villageProduction['clay']}">{$villageResources['clay']}/{$villageMaxStore}</td>
							<td>
								<img src="assets/img/x.gif" class="r3" alt="{$smarty.const.IRON}" title="{$smarty.const.IRON}" />
							</td>
				<td id="l2" title="{$villageProduction['iron']}">{$villageResources['iron']}/{$villageMaxStore}</td>
							<td>
								<img src="assets/img/x.gif" class="r4" alt="{$smarty.const.CROP}" title="{$smarty.const.CROP}" />
							</td>
							{if $villageResources['crop'] > 0}
				<td id="l1" title="{$villageProduction['crop'] - $villageCropConsumption}">{$villageResources['crop']}/{$villageMaxCrop}</td>
							{else}
				<td title="{$villageProduction['crop']}">0/{$villageMaxCrop}</td>
							{/if}
							<td>
								<img src="assets/img/x.gif" class="r5" alt="{$smarty.const.CROP_COM}" title="{$smarty.const.CROP_COM}" />
							</td>
				<td>{$villageCropConsumption}/{$villageProduction['crop']}</td>
		</tr>
	</table>
	<table cellpadding="1" cellspacing="1">
		<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td></td>
			<td>
			{if $gold <=1}
            	<font color="#B3B3B3"><img src="{$smarty.const.GP_LOCATE}img/a/gold_g.gif" alt="{$smarty.const.REMAINING_GOLD}" title="{$currentGold}"/> {$gold} <span><span>G</span><span>o</span><span>l</span><span>d</span></span></font>
			{elseif $gold >= 2}
				<img src="{$smarty.const.GP_LOCATE}img/a/gold.gif" alt="{$smarty.const.REMAINING_GOLD}" title="{$currentGold}"/> {$gold} <span><span>G</span><span>o</span><span>l</span><span>d</span></span>
			{/if}
			</td>
		</tr>
	</table>
    </div>
</div>