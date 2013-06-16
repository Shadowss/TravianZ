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
			<th colspan="4"><?php echo PROD_HEADER; ?>:</th>
	</tr></thead><tbody>	
	<tr>
		<td class="ico"><img class="r1" src="img/x.gif" alt="<?php echo LUMBER; ?>" title="<?php echo LUMBER; ?>" /></td>
		<td class="res"><?php echo LUMBER; ?>:</td>
		<td class="num"><?php echo $village->getProd("wood"); ?></td>
		<td class="per"><?php echo PER_HR; ?></td>
	</tr>
		
	<tr>
		<td class="ico"><img class="r2" src="img/x.gif" alt="<?php echo CLAY; ?>" title="<?php echo CLAY; ?>" /></td>
		<td class="res"><?php echo CLAY; ?>:</td>
		<td class="num"><?php echo $village->getProd("clay"); ?></td>
		<td class="per"><?php echo PER_HR; ?></td>
	</tr>
		
	<tr>
		<td class="ico"><img class="r3" src="img/x.gif" alt="<?php echo IRON; ?>" title="<?php echo IRON; ?>" /></td>
		<td class="res"><?php echo IRON; ?>:</td>
		<td class="num"><?php echo $village->getProd("iron"); ?></td>
		<td class="per"><?php echo PER_HR; ?></td>
	</tr>
		
	<tr>
		<td class="ico"><img class="r4" src="img/x.gif" alt="<?php echo CROP; ?>" title="<?php echo CROP; ?>" /></td>
		<td class="res"><?php echo CROP; ?>:</td>
		<td class="num"><?php echo $village->getProd("crop"); ?></td>
		<td class="per"><?php echo PER_HR; ?></td>
	</tr>
		</tbody>	
</table>