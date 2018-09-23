{if $villageBuildings[$parameters['id']]['level'] > 0}

{include file={$smarty.const.TEMPLATES_DIR}|cat:'/village/buildings/academy/research.tpl'}

{else}
    <b>{$smarty.const.RESEARCH_COMMENCE_ACADEMY}</b><br />
{/if}