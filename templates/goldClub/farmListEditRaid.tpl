<div id="raidListSlot">
	<h4>{$smarty.const.EDIT_RAID}</h4>

	{include file=$smarty.const.TEMPLATES_DIR|cat:'error.tpl'}

	<form action="build.php?id={$parameters['id']}&t=3" method="post">	
		{include file=$smarty.const.TEMPLATES_DIR|cat:'goldClub/farmListRaid.tpl'}
		<button type="submit" value="updateFarmListRaid" name="action" id="save" class="trav_buttons">{$smarty.const.SAVE}</button>
		<button type="submit" value="deleteFarmListRaid" name="action" id="delete" class="trav_buttons">{$smarty.const.DELETE}</button>
	</form>
</div>
