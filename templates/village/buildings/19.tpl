{if $villageBuildings[$parameters['id']]['level'] > 0}

{include file={$smarty.const.TEMPLATES_DIR}|cat:'/village/buildings/trainingFields/train.tpl'}
{include file={$smarty.const.TEMPLATES_DIR}|cat:'/village/buildings/trainingFields/inTraining.tpl'}

{else}
    <b>{$smarty.const.TRAINING_COMMENCE_BARRACKS}</b><br />
{/if}