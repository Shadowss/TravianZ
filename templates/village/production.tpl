<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       production.tpl                                              ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<table id="production" cellpadding="1" cellspacing="1">
	<thead><tr>
			<th colspan="4">{$smarty.const.PROD_HEADER}:</th>
	</tr></thead><tbody>	
	<tr>
		<td class="ico"><img class="r1" src="assets/img/x.gif" alt="{$smarty.const.LUMBER}" title="{$smarty.const.LUMBER}" /></td>
		<td class="res">{$smarty.const.LUMBER}:</td>
		<td class="num">{$villageProduction['wood']}</td>
		<td class="per">{$smarty.const.PER_HR}</td>
	</tr>
		
	<tr>
		<td class="ico"><img class="r2" src="assets/img/x.gif" alt="{$smarty.const.CLAY}" title="{$smarty.const.CLAY}" /></td>
		<td class="res">{$smarty.const.CLAY}:</td>
		<td class="num">{$villageProduction['clay']}</td>
		<td class="per">{$smarty.const.PER_HR}</td>
	</tr>
		
	<tr>
		<td class="ico"><img class="r3" src="assets/img/x.gif" alt="{$smarty.const.IRON}" title="{$smarty.const.IRON}" /></td>
		<td class="res">{$smarty.const.IRON}:</td>
		<td class="num">{$villageProduction['iron']}</td>
		<td class="per">{$smarty.const.PER_HR}</td>
	</tr>
		
	<tr>
		<td class="ico"><img class="r4" src="assets/img/x.gif" alt="{$smarty.const.CROP}" title="{$smarty.const.CROP}" /></td>
		<td class="res">{$smarty.const.CROP}:</td>
		<td class="num">{$villageProduction['crop'] - $villageCropConsumption}</td>
		<td class="per">{$smarty.const.PER_HR}</td>
	</tr>
		</tbody>	
</table>