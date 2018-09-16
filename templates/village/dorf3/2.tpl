<table id="resources" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<th colspan="6">Resources</th>
		</tr>
		<tr>
			<td>{$smarty.const.VILLAGE}</td>
			<td><img class="r1" src="assets/img/x.gif" title="{$smarty.const.LUMBER}" alt="{$smarty.const.LUMBER}"></td>
			<td><img class="r2" src="assets/img/x.gif" title="{$smarty.const.CLAY}" alt="{$smarty.const.CLAY}"></td>
			<td><img class="r3" src="assets/img/x.gif" title="{$smarty.const.IRON}" alt="{$smarty.const.IRON}"></td>
			<td><img class="r4" src="assets/img/x.gif" title="{$smarty.const.CROP}" alt="{$smarty.const.CROP}"></td>
			<td>{$smarty.const.MERCHANT}</td>
		</tr>
	</thead>
	<tbody>

{assign var=totalWood value=0}
{assign var=totalClay value=0}
{assign var=totalIron value=0}
{assign var=totalCrop value=0}
{assign var=totalAvailMerchants value=0}
{assign var=totalMerchants value=0}

{foreach $villages as $village}
	<tr class="{if $village.villageIsCapital}hl{/if}"> 
		<td class="vil fc"><a href="dorf1.php?newdid={$village.villageVref}">{$village.villageName}</a></td>
		<td class="lum">{$village.villageResources['wood']|number_format:0:',':'.'}</td>
		<td class="clay">{$village.villageResources['iron']|number_format:0:',':'.'}</td>
		<td class="iron">{$village.villageResources['clay']|number_format:0:',':'.'}</td>
		<td class="crop">{$village.villageResources['crop']|number_format:0:',':'.'}</td>
		<td class="tra lc">{if $village.villageMerchants['total'] > 0}<a href="build.php?newdid={$village.villageVref}&amp;gid=17">{/if} {$village.villageMerchants['available']}/{$village.villageMerchants['total']}</a></td>  
	</tr>
	{assign var=totalWood value=$totalWood + $village.villageResources['wood']}
	{assign var=totalClay value=$totalClay + $village.villageResources['clay']}
	{assign var=totalIron value=$totalIron + $village.villageResources['iron']}
	{assign var=totalCrop value=$totalCrop + $village.villageResources['crop']}
	{assign var=totalAvailMerchants value=$totalAvailMerchants + $village.villageMerchants['available']}
	{assign var=totalMerchants value=$totalMerchants + $village.villageMerchants['total']}
{/foreach}

	<tr>
		<td colspan="6" class="empty"></td>
	</tr>
	<tr class="sum">
		<th>{$smarty.const.SUM}</th>
		<td class="lum">{$totalWood|number_format:0:',':'.'}</td>
		<td class="clay">{$totalClay|number_format:0:',':'.'}</td>
		<td class="iron">{$totalIron|number_format:0:',':'.'}</td>
		<td class="crop">{$totalCrop|number_format:0:',':'.'}</td>
		<td class="tra">{$totalAvailMerchants}/{$totalMerchants}</td>
	</tr>
	</tbody>
</table>
