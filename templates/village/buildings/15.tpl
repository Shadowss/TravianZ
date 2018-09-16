{assign var=bonusTexts value=[$smarty.const.CURRENT_CONSTRUCTION_TIME, $smarty.const.CONSTRUCTION_TIME_LEVEL, $smarty.const.PERCENT]}
{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/showBonus.tpl'}
{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/demolition.tpl'}
