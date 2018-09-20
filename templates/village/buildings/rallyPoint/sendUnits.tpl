{if !isset($prepareUnits)}
	<form method="POST" action="build.php?id={$parameters['id']}&t=1">
		{include file=$smarty.const.TEMPLATES_DIR|cat:'sendUnits/units.tpl'}
		{include file=$smarty.const.TEMPLATES_DIR|cat:'sendUnits/search.tpl'}
		{include file=$smarty.const.TEMPLATES_DIR|cat:'error.tpl'}
	</form>
{else}
	<form method="POST" action="build.php?id={$parameters['id']}">
		{include file=$smarty.const.TEMPLATES_DIR|cat:'sendUnits/attack.tpl'}
	</form>
{/if}