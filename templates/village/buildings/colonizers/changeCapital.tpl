{if $canChangeCapital && !$villageIsCapital}
	{if empty($parameters['confirm'])}
    	<p>
    		<a href="?id={$parameters['id']}&confirm=yes">&raquo {$smarty.const.CHANGE_CAPITAL}</a>
    	</p>
  	{else}
   		<p>{$smarty.const.CHANGE_CAPITAL_DESC}
		
		<form method="post" action="build.php?id={$parameters['id']}&confirm=yes">
			{$smarty.const.PASSWORD}: <input type="password" name="Password" />
			
			{include file=$smarty.const.TEMPLATES_DIR|cat:'error.tpl'}

			<br />
			<button id="btn_ok" class="trav_buttons" value="changeCapital" name="action"> Ok </button>
		</form>
    {/if}
{/if}
