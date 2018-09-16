<div id="textmenu"> 
   <a href="build.php?id={$parameters['id']}"{if !isset($parameters['t'])}class="selected"{/if}>{$smarty.const.SEND_RESOURCES}</a> 
 | <a href="build.php?id={$parameters['id']}&amp;t=1" {if isset($parameters['t']) && $parameters['t'] == 1}class="selected"{/if}>{$smarty.const.BUY}</a> 
 | <a href="build.php?id={$parameters['id']}&amp;t=2" {if isset($parameters['t']) && $parameters['t'] == 2}class="selected"{/if}>{$smarty.const.OFFER}</a> 
 
 {if $gold > 2}
 | <a href="build.php?id={$parameters['id']}&amp;t=3" {if isset($parameters['t']) && $parameters['t'] == 3}class="selected"{/if}>{$smarty.const.NPC_TRADING}</a> 
 {/if}

 {if $goldclub && $numberOfVillages > 1}
 | <a href="build.php?id={$parameters['id']}&amp;t=4" {if isset($parameters['t']) && $parameters['t'] == 4}class="selected"{/if}>{$smarty.const.TRADE_ROUTES}</a> 
 {/if}
</div> 