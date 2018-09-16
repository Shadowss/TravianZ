{assign var=bonusTexts value=[$smarty.const.DEFENCE_NOW, $smarty.const.DEFENCE_LEVEL, $smarty.const.PERCENT]}
{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/showBonus.tpl'}