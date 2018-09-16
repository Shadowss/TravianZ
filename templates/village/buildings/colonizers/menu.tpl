<div id="textmenu"> 
   <a href="build.php?id={$parameters['id']}" {if !isset($parameters['s'])}class="selected"{/if}>{$smarty.const.TRAIN}</a> 
 | <a href="build.php?id={$parameters['id']}&s=1" {if isset($parameters['s']) && $parameters['s'] == 1}class="selected"{/if}>{$smarty.const.CULTURE_POINTS}</a> 
 | <a href="build.php?id={$parameters['id']}&s=2" {if isset($parameters['s']) && $parameters['s'] == 2}class="selected"{/if}>{$smarty.const.LOYALTY}</a> 
 | <a href="build.php?id={$parameters['id']}&s=3" {if isset($parameters['s']) && $parameters['s'] == 3}class="selected"{/if}>{$smarty.const.EXPANSION}</a> 
</div>