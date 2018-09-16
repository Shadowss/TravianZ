{assign var=bonusTexts value=[$smarty.const.CUR_PROD, $smarty.const.NEXT_PROD, $smarty.const.PER_HR]}
{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/showBonus.tpl'}