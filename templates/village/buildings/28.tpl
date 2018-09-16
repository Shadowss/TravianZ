{assign var=bonusTexts value=[$smarty.const.CURRENT_MERCHANT, $smarty.const.MERCHANT_LEVEL, $smarty.const.PERCENT]}
{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/showBonus.tpl'}