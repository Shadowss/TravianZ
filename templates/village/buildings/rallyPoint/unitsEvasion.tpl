<form action="build.php?id={$parameters['id']}&t=3" method="POST">
<table id="raidList" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<th colspan="4">{$smarty.const.EVASION_SETTINGS}</th>
		</tr>
		<tr>
			<td></td>
			<td>{$smarty.const.VILLAGE}</td>
			<td>{$smarty.const.OWN_TROOPS}</td>
			<td>{$smarty.const.REINFORCEMENT}</td>
		</tr>
	</thead>
	<tbody>
		{foreach $villages as $village}
        <tr>
			<td>
				<input type="checkbox" class="check" name="evasionCheck[{$village.villageVref}]" {if $village.villageEvasion}checked="checked"{/if}>
			</td>
			<td>{$village.villageName}</td>
			<td>
				<div style="text-align: center">{$village.villageTotalUnits|@array_sum}</div>
			</td>
			<td>
				<div style="text-align: center">{$village.villageTotalEnforcementsUnit|@array_sum}</div>
			</td>
		</tr>
		{/foreach}
		</tbody>
</table>

	<br />
	{$smarty.const.SEND_TROOPS_AWAY_MAX} <input class="text" type="text" name="maxEvasion" value="{$maxEvasion}" maxlength="3" style="width: 50px;"> {$smarty.const.TIMES}
	<span class="none">({$smarty.const.COSTS}: <img src="{$smarty.const.GP_LOCATE}img/a/gold_g.gif" alt="{$smarty.const.GOLD}" title="{$smarty.const.GOLD}" /><b>2</b> {$smarty.const.PER_EVASION})</span>
	<div class="clear"></div>

	{include file=$smarty.const.TEMPLATES_DIR|cat:'error.tpl'}

	{include file=$smarty.const.TEMPLATES_DIR|cat:'success.tpl'}

	<p>
		<button value="updateEvasionSettings" name="action" id="btn_ok" class="trav_buttons" tabindex="8">{$smarty.const.SAVE}</button>
	</p>
</form>