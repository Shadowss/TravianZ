<div id="raidListCreate">
	<h4>{$smarty.const.CREATE_NEW_LIST}</h4>
	
	{include file=$smarty.const.TEMPLATES_DIR|cat:'error.tpl'}
	
	<form action="build.php?id={$parameters['id']}&t=3" method="post">
		<div class="boxes boxesColor gray">
			<div class="boxes-tl"></div>
			<div class="boxes-tr"></div>
			<div class="boxes-tc"></div>
			<div class="boxes-ml"></div>
			<div class="boxes-mr"></div>
			<div class="boxes-mc"></div>
			<div class="boxes-bl"></div>
			<div class="boxes-br"></div>
			<div class="boxes-bc"></div>
			<div class="boxes-contents cf">
				<input type="hidden" name="action" value="addList">
				<table cellpadding="1" cellspacing="1" class="transparent"
					id="raidList">
					<tbody>
						<tr>
							<th>{$smarty.const.NAME}:</th>
							<td>
								<input class="text" id="name" name="name" type="text" maxLength="30">
							</td>
						</tr>
						<tr>
							<th>{$smarty.const.VILLAGE}:</th>
							<td>
								<select id="did" name="fromVref">
								{foreach $villages as $village}
    								<option value="{$village.villageVref}" {if $village.villageVref == $villageVref}selected="selected"{/if}>{$village.villageName}</option>
								{/foreach}
								</select>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<button class="trav_buttons" type="submit" value="createFarmList" name="action">{$smarty.const.CREATE}</button>
	</form>
</div>
