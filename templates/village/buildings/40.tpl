<form action="?build.php&id={$parameters['id']}" method="POST">

{if $villageBuildings[$parameters['id']]['level'] == 0 || $villageBuildings[$parameters['id']]['level'] > 10}
	{if $villageBuildings[$parameters['id']]['level'] == 0}
		{$smarty.const.WORLD_WONDER_CHANGE_NAME}
	{else}
		{$smarty.const.WORLD_WONDER_NOTCHANGE_NAME}
	{/if}

			<div style="text-align:center">
				<br />{$smarty.const.WORLD_WONDER_NAME} 
				<input class="text" name="wwname" id="wwname" disabled="disabled" value="" maxlength="20">
			</div>
			<p class="btn">
				<button tabindex="9" name="s1" disabled="disabled" id="btn_ok" class="trav_buttons"> Change </button>
			</p>
{else}
			<div style="text-align:center">
				<br />{$smarty.const.WORLD_WONDER_NAME} 
				<input class="text" name="wwname" id="wwname" value="" maxlength="20">
			</div>
			<p class="btn">
				<button tabindex="9" name="action" value="changeWWName" id="btn_ok" class="trav_buttons"> Change </button>
			</p>
{/if}

</form>

{if $wwNameChanged}
	<div style="text-align: center">
		<font color="Red">
			<b>{$smarty.const.WORLD_WONDER_NAME_CHANGED}</b>
		</font>
	</div><br />
{/if}
