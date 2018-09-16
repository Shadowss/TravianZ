{if !empty($villageTrainableUnits[$villageUnitsToTrainClass])}
	{include file={$smarty.const.TEMPLATES_DIR}|cat:'/village/buildings/trainingFields/train.tpl'}	
{else}
	<div class="c">{$description}</div>
{/if}

{include file={$smarty.const.TEMPLATES_DIR}|cat:'/village/buildings/trainingFields/inTraining.tpl'}	

{if $villageIsCapital}
	<p class="none">
		{$smarty.const.CAPITAL}
	</p>
{/if}

{include file={$smarty.const.TEMPLATES_DIR}|cat:'/village/buildings/colonizers/changeCapital.tpl'}
