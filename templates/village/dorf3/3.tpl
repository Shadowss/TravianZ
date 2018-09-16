<table id="warehouse" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<th colspan="7">{$smarty.const.WAREHOUSE}</th>
		</tr>
		<tr>
			<td>{$smarty.const.VILLAGE}</td>
			<td><img class="r1" src="assets/img/x.gif" title="{$smarty.const.LUMBER}" alt="{$smarty.const.LUMBER}"></td>
			<td><img class="r2" src="assets/img/x.gif" title="{$smarty.const.CLAY}" alt="{$smarty.const.CLAY}"></td>
			<td><img class="r3" src="assets/img/x.gif" title="{$smarty.const.IRON}" alt="{$smarty.const.IRON}"></td>
			<td><img class="clock" src="assets/img/x.gif" title="{$smarty.const.CLOCK}" alt="{$smarty.const.CLOCK}"></td>
			<td><img class="r4" src="assets/img/x.gif" title="{$smarty.const.CROP}" alt="{$smarty.const.CROP}"></td>
			<td><img class="clock" src="assets/img/x.gif" title="{$smarty.const.CLOCK}" alt="{$smarty.const.CLOCK}"></td>
		</tr>
	</thead>
	<tbody>

{foreach $villages as $village}
	{assign var=woodPercentage value=round($village.villageResources['wood'] / $village.villageMaxStore * 100)}
	{assign var=clayPercentage value=round($village.villageResources['clay'] / $village.villageMaxStore * 100)}
	{assign var=ironPercentage value=round($village.villageResources['iron'] / $village.villageMaxStore * 100)}
	{assign var=cropPercentage value=round($village.villageResources['crop'] / $village.villageMaxCrop * 100)}
	<tr class="{if $village.villageIsCapital}hl{/if}">
		<td class="vil fc"><a href="dorf1.php?newdid={$village.vref}">{$village.villageName}</a></td>
		<td class="lum {if $woodPercentage >= 95}crit{/if}" title="{$village.villageResources['wood']}/{$village.villageMaxStore}">
			{$woodPercentage}%
		</td> 
		<td class="clay {if $clayPercentage >= 95}crit{/if}" title="{$village.villageResources['clay']}/{$village.villageMaxStore}">
			{$clayPercentage}%
		</td>
		<td class="iron {if $ironPercentage >= 95}crit{/if}" title="{$village.villageResources['iron']}/{$village.villageMaxStore}">
			{$ironPercentage}%
		</td>
		<td class="max123 {if $village.villageMaxStoreTime == 0}crit{/if}">
		  <span {if $village.villageMaxStoreTime > 0}class="timer"{/if}>
		  	{if $village.villageMaxStoreTime == 0}
		  		{$smarty.const.FULL}
		  	{else}
				{$village.villageMaxStoreTimeString}
		  	{/if}
		  </span>
		</td>
		
		<td class="crop {if $cropPercentage >= 95 || $village.villageMaxCropTime == 0}crit{/if}" title="{$village.villageResources['crop']}/{$village.villageMaxCrop}">
			{$cropPercentage}%
		</td>

		<td class="max4 {if $village.villageProduction['crop'] - $village.villageCropConsumption < 0 || $village.villageMaxCropTime == 0}crit{/if}">
			<span {if $village.villageMaxCropTime > 0}class="timer"{/if}>
			{if $village.villageProduction['crop'] - $village.villageCropConsumption <=0}
				{$smarty.const.NEVER}
			{elseif $village.villageMaxCropTime == 0}
				{$smarty.const.FULL}
			{else}
				{$village.villageMaxCropTimeString}
			{/if}
			</span>
		</td>
	</tr>
{/foreach}

</tbody>
</table>