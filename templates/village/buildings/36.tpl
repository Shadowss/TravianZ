{assign var=bonusTexts value=[$smarty.const.CURRENT_TRAPS, $smarty.const.TRAPS_LEVEL, $smarty.const.TRAPS]}
{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/showBonus.tpl'}

<p>{$smarty.const.CURRENT_HAVE} <b>{$villageUnits[12]['amount']}</b> {$smarty.const.TRAPS}, <b>{$villageUnits[13]['amount']}</b> {$smarty.const.WHICH_OCCUPIED}</p>

{if $villageBuildings[$parameters['id']]['level'] > 0}

{include file={$smarty.const.TEMPLATES_DIR}|cat:'/village/buildings/trainingFields/train.tpl'}
{include file={$smarty.const.TEMPLATES_DIR}|cat:'/village/buildings/trainingFields/inTraining.tpl'}

{else}
    <b>{$smarty.const.TRAINING_COMMENCE_TRAPPER}</b><br />
{/if}