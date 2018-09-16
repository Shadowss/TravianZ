{assign var=bonusTexts value=[$smarty.const.CURRENT_SPEED, $smarty.const.SPEED_LEVEL, $smarty.const.PERCENT]}
{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/showBonus.tpl'}
