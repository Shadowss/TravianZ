{assign var=bonusTexts value=[$smarty.const.CURRENT_BONUS, $smarty.const.BONUS_LEVEL, $smarty.const.PERCENT]}
{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/showBonus.tpl'}