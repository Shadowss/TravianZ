<!--#################################################################################
    ##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
    ## --------------------------------------------------------------------------- ##
    ##  Filename       multivillage.tpl                                            ##
    ##  Developed by:  Dzoki                                                       ##
    ##  License:       TravianX Project                                            ##
    ##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
    ##                                                                             ##
    #################################################################################-->

<table id="vlist" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td colspan="3"><a href="dorf3.php" accesskey="9">{$smarty.const.MULTI_V_HEADER}:</a></td>
		</tr>
	</thead>
	<tbody>
		{foreach $villages as $village}
		<tr>
			<td class="dot {if $selectedVillage == $village.villageVref}hl{/if}">●</td>
			<td class="link">
				<a href="?newdid={$village.villageVref}">{$village.villageName}</a>
			</td>
			<td class="aligned_coords">
				<div class="cox">({$village.villageCoordinates['x']}</div>
				<div class="pi">|</div>
				<div class="coy">{$village.villageCoordinates['y']})</div>
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>
