{assign var=bonusTexts value=[$smarty.const.CURRENT_CAPACITY, $smarty.const.CAPACITY_LEVEL, $smarty.const.RESOURCE_UNITS]}
{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/showBonus.tpl'}
