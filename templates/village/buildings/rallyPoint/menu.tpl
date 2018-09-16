<div id="textmenu">
	<a href="build.php?id={$parameters['id']}" {if !isset($parameters['t']) || (isset($parameters['t']) && $parameters['t'] == 99 && !$goldclub)}class="selected"{/if}>{$smarty.const.OVERVIEW}</a> |
    <a href="build.php?id={$parameters['id']}&t=1" {if isset($parameters['t']) && $parameters['t'] == 1}class="selected"{/if}>{$smarty.const.SEND_TROOPS}</a> |
    <a href="build.php?id={$parameters['id']}&t=2" {if isset($parameters['t']) && $parameters['t'] == 2}class="selected"{/if}>{$smarty.const.Q20_RESP1}</a> 
    {if $goldclub}|
    <a href="build.php?id={$parameters['id']}&t=3" {if isset($parameters['t']) && $parameters['t'] == 3}class="selected"{/if}>{$smarty.const.GOLD_CLUB}</a>
    {/if}
</div>