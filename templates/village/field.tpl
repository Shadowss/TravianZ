<!--#################################################################################
    ##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
    ## --------------------------------------------------------------------------- ##
    ##  Filename       field.tpl                                                   ##
    ##  Developed by:  Dzoki                                                       ##
    ##  License:       TravianX Project                                            ##
    ##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
    ##                                                                             ##
    #################################################################################-->
<map name="rx" id="rx">
{for $i = 1 to 18}
	<area href="build.php?id={$i}" coords="{$resourcesFieldCoordinatesArray[$i]}" shape="circle" title="{$villageBuildings[$i]['name']} {$smarty.const.LEVEL} {$villageBuildings[$i]['level']}{if $buildingJobs[$i]['inBuilding']}{$smarty.const.UPGRADE_IN_PROGRESS}{/if}"/>
{/for}
	<area href="dorf2.php" coords="144,131,36" shape="circle" title="{$smarty.const.VILLAGE_CENTER}"/>
</map>

<div id="village_map" class="f{$villageType}">

{for $i = 1 to 18}
	<img src="assets/img/x.gif" class="reslevel rf{$i} level{$villageBuildings[$i]['level']}{if $buildingJobs[$i]['inBuilding']}_active{/if}" alt="{$villageBuildings[$i]['name']} {$smarty.const.LEVEL} {$villageBuildings[$i]['level']}{if $buildingJobs[$i]['inBuilding']} {$smarty.const.UPGRADE_IN_PROGRESS}{/if}"/>
{/for}
	<img id="resfeld" usemap="#rx" src="assets/img/x.gif" />
</div>