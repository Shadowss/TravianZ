{if $editRaid}
	{include file=$smarty.const.TEMPLATES_DIR|cat:'goldClub/farmListEditRaid.tpl'}
{elseif $addRaid}
	{include file=$smarty.const.TEMPLATES_DIR|cat:'goldClub/farmListAddRaid.tpl'}
{elseif $addFarmList}
	{include file=$smarty.const.TEMPLATES_DIR|cat:'goldClub/farmListAdd.tpl'}
{else}
	{include file=$smarty.const.TEMPLATES_DIR|cat:'goldClub/farmList.tpl'}
<br />
	{if !$hideEvasion}
		{include file=$smarty.const.TEMPLATES_DIR|cat:'village/buildings/rallyPoint/unitsEvasion.tpl'}
	{/if}
{/if}
