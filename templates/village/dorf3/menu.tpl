<div id="textmenu">
   <a href="dorf3.php" class="{if !isset($parameters['s'])}selected {/if}">{$smarty.const.OVERVIEW}</a>
 | <a href="dorf3.php?s=2" class="{if isset($parameters['s']) && $parameters['s'] == 2}selected{/if}">{$smarty.const.RESOURCES}</a>
 | <a href="dorf3.php?s=3" class="{if isset($parameters['s']) && $parameters['s'] == 3}selected{/if}">{$smarty.const.WAREHOUSE}</a>
 | <a href="dorf3.php?s=4" class="{if isset($parameters['s']) && $parameters['s'] == 4}selected{/if}">{$smarty.const.CULTUREPOINT}</a>
 | <a href="dorf3.php?s=5" class="{if isset($parameters['s']) && $parameters['s'] == 5}selected{/if}">{$smarty.const.TROOPS}</a>
</div>