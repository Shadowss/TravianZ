{if $villageBuildings[$parameters['id']]['level'] >= DEMOLISH_LEVEL_REQ}
    <h2>{$smarty.const.DEMOLITION_BUILDING}</h2>
    {if !empty($villageBuildingsInDemolition)}
    	{foreach $villageBuildingsInDemolition as $building}
       	<b>
       	<a href="build.php?id={$parameters['id']}&cancel={$building.id}">
       		<img src="assets/img/x.gif" class="del" title="{$smarty.const.CANCEL}" alt="{$smarty.const.CANCEL}">
        </a>
        {$smarty.const.DEMOLITION_OF} {$building.name}: <span class="timer">{$building.finished}</span>
            {if $gold >= 2}
            <a href="?id={$parameters['id']}&buildingFinish=1" onclick="return confirm('{$smarty.const.FINISH_GOLD}');">
            	<img class="clock" alt="{$smarty.const.FINISH_GOLD}" title="{$smarty.const.FINISH_GOLD}" src="assets/img/x.gif"/>
            </a>
            {/if}
        </b>
        <br />
		{/foreach}
	{else}

<form action="build.php?id={$parameters['id']}" method="POST" style="display:inline">
	<select id="demolition_type" name="demolish" class="dropdown">
        {foreach $villageBuildings as $position => $building}
            {if $building.level > 0 && $position > 18 && !$villageBuildingsInConstruction[$position]}
                <option value="{$position}{if $parameters['demolish'] == $position}selected='selected'{/if}">{$position}. {$building.name} ({$smarty.const.SHORT_LEVEL} {$building.level})</option>
        	{/if}
        {/foreach}
	</select>
	<button id="btn_demolish" class="trav_buttons" name="action"  value="startDemolition"> Demolish </button>
</form>
	{/if}
{/if}
 