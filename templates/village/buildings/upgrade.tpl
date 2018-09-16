{if $villageBuildingCanBeUpgraded == 1}
    <p>
        <span class="none">{$smarty.const.MAX_LEVEL}</span>
    </p>
{elseif $villageBuildingCanBeUpgraded == 10}
    <p>
        <span class="none">{$smarty.const.BUILDING_MAX_LEVEL_UNDER}</span>
    </p>
{elseif $villageBuildingCanBeUpgraded == 11}
    <p>
        <span class="none">{$smarty.const.BUILDING_BEING_DEMOLISHED}</span>
    </p>
{else}

<p id="contract"><b>{$smarty.const.COSTS_UPGRADING_LEVEL}</b> {$villageBuildingToUpgrade['level']}:<br />
<img class="r1" src="assets/img/x.gif" alt="{$smarty.const.LUMBER}" title="{$smarty.const.LUMBER}" />
	<span class="little_res">{$villageBuildingToUpgrade['neededResources']['wood']}</span> |
<img class="r2" src="assets/img/x.gif" alt="{$smarty.const.CLAY}" title="{$smarty.const.CLAY}" />
	<span class="little_res">{$villageBuildingToUpgrade['neededResources']['clay']}</span> | 
<img class="r3" src="assets/img/x.gif" alt="{$smarty.const.IRON}" title="{$smarty.const.IRON}" />
	<span class="little_res">{$villageBuildingToUpgrade['neededResources']['iron']}</span> | 
<img class="r4" src="assets/img/x.gif" alt="{$smarty.const.CROP}" title="{$smarty.const.CROP}" />
	<span class="little_res">{$villageBuildingToUpgrade['neededResources']['crop']}</span> |
<img class="r5" src="assets/img/x.gif" alt="{$smarty.const.CROP_COM}" title="{$smarty.const.CROP_COM}" />
	{$villageBuildingToUpgrade['pop']} | 
<img class="clock" src="assets/img/x.gif" alt="{$smarty.const.DURATION}" title="{$smarty.const.DURATION}" />
	{$villageBuildingToUpgrade['neededTime']}

{if $gold >= 3 && $villageIsMarketplaceBuilt && $villageTotalResources >= $villageBuildingToUpgrade['totalResources']}
    | <a href="build.php?gid=17&t=3&r1={$villageBuildingToUpgrade['neededResources']['wood']}&r2={$villageBuildingToUpgrade['neededResources']['clay']}&r3={$villageBuildingToUpgrade['neededResources']['iron']}&r4={$villageBuildingToUpgrade['neededResources']['crop']}">
    	<img class="npc" src="assets/img/x.gif" alt="{$smarty.const.NPC_TRADE}" title="{$smarty.const.NPC_TRADE}" />
    </a>
{/if}

<br />
    {if $villageBuildingCanBeUpgraded == 2}
        <span class="none">{$smarty.const.WORKERS_ALREADY_WORK}</span>
    {elseif $villageBuildingCanBeUpgraded == 3}
        <span class="none">{$smarty.const.WORKERS_ALREADY_WORK_WAITING}</span>
    {elseif $villageBuildingCanBeUpgraded == 4}
        <span class="none">{$smarty.const.ENOUGH_FOOD_EXPAND_CROPLAND}</span>
    {elseif $villageBuildingCanBeUpgraded == 5}
        <span class="none">{$smarty.const.UPGRADE_WAREHOUSE}</span>
    {elseif $villageBuildingCanBeUpgraded == 6}
        <span class="none">{$smarty.const.UPGRADE_GRANARY}</span>
    {elseif $villageBuildingCanBeUpgraded == 7}
	   {if $villageProduction['crop'] - $villageCropConsumption > 0}
           <span class="none">{$smarty.const.ENOUGH_RESOURCES} {$villageBuildingToUpgrade['neededResourcesTime'][0]} {$smarty.const.AT} {$villageBuildingToUpgrade['neededResourcesTime'][1]}</span>
	   {else}
	       <span class="none">{$smarty.const.YOUR_CROP_NEGATIVE}</span>
	   {/if}
    {elseif $villageBuildingCanBeUpgraded == 8 || $villageBuildingCanBeUpgraded == 9}
		<a class="build" href="dorf{if $parameters['id'] <=18}1{else}2{/if}.php?a={$parameters['id']}&c={$sessionChecker}">
    		{$smarty.const.UPGRADE_LEVEL} {$villageBuildingToUpgrade['level']}
    	</a>
    	{if $villageBuildingCanBeUpgraded == 9}  	
			<span class="none">{$smarty.const.WAITING}</span>
		{/if}
    {elseif $villageBuildingCanBeUpgraded == 12}
        <span class="none">{$smarty.const.NEED_WWCONSTRUCTION_PLAN }</span>
    {elseif $villageBuildingCanBeUpgraded == 13}
        <span class="none">{$smarty.const.NEED_MORE_WWCONSTRUCTION_PLAN }</span>
    {/if}
    
    {if 
    	($villageBuildingCanBeUpgraded == 2 || 
    	$villageBuildingCanBeUpgraded == 3 || 
    	$villageBuildingCanBeUpgraded == 7) &&
    	($gold >= 1 && !$villageIsMasterBuildBusy)
   	}   
   	    <br />
        <a class="build" href="dorf{if $parameters['id'] <=18}1{else}2{/if}.php?master=$villageBuildings[$parameters['id']]['id']&id={$parameters['id']}&c={$sessionChecker}">{$smarty.const.CONSTRUCTING_MASTER_BUILDER}</a>
    	<font color="#B3B3B3">({$smarty.const.COSTS}: <img src="{$smarty.const.GP_LOCATE}img/a/gold_g.gif" alt="{$smarty.const.GOLD}" title="{$smarty.const.GOLD}"/>1)</font>
    {/if}
{/if}