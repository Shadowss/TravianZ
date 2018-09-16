{assign var=bonusTexts value=[$smarty.const.CURRENT_STABILITY, $smarty.const.STABILITY_LEVEL, $smarty.const.PERCENT]}
{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/showBonus.tpl'}