<!--#################################################################################
    ##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
    ## --------------------------------------------------------------------------- ##
    ##  Filename       troops.tpl                                                  ##
    ##  Developed by:  Dzoki                                                       ##
    ##  License:       TravianX Project                                            ##
    ##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
    ##                                                                             ##
    #################################################################################-->
<table id="troops" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<th colspan="3">{$smarty.const.TROOPS_DORF}</th>
		</tr>
	</thead>
	<tbody>

{if $villageAreUnitsPresent}
	{foreach $villageTotalPresentUnits as $unitsTribe => $villageUnits}
		{for $i = 1 to 10}
    		{if $villageUnits[$i]['amount'] > 0}
        		<tr>
        			<td class="ico">
        				<a href="build.php?id=39">
        					<img class="unit u{$i + ($unitsTribe - 1) * 10}" src="assets/img/x.gif" alt="{$villageUnits[$i]['name']}" title="{$villageUnits[$i]['name']}"/>
        				</a>
        			</td>
        			<td class="num">
        				{$villageUnits[$i]['amount']}
        			</td>
        			<td class="un">
        				{$villageUnits[$i]['name']}
        			</td>
        		</tr>
    		{/if}
		{/for}
		{if $villageUnits[11]['amount'] > 0}
        		<tr>
        			<td class="ico">
        				<a href="build.php?id=39">
        					<img class="unit uhero" src="assets/img/x.gif" alt="{$smarty.const.U0}" title="{$smarty.const.U0}"/>
        				</a>
        			</td>
        			<td class="num">
        				{$villageUnits[11]['amount']}
        			</td>
        			<td class="un">
        				{$smarty.const.U0}
        			</td>
        		</tr>
    		{/if}
	{/foreach}
{else}
    	<tr>
    		<td>none</td>
    	</tr>
{/if}
	</tbody>
</table>
</div>
