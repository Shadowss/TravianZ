<div id="build" class="gid4"><a href="#" onClick="return Popup(4,4);" class="build_logo">
	<img class="building g4" src="img/x.gif" alt="<?php echo B4; ?>" title="<?php echo B4; ?>" />
</a>
<h1><?php echo B4; ?> <span class="level"><?php echo LEVEL." "; echo $village->resarray['f'.$id];?></span></h1>
<p class="build_desc"><?php echo B4_DESC; ?></p>

<table cellpadding="1" cellspacing="1" id="build_value">
	<tr>
		<th><?php echo CUR_PROD; ?></th>
		<td><b><?php echo $bid4[$village->resarray['f'.$id]]['prod']* SPEED; ?></b> <?php echo PER_HR; ?></td>
	</tr>
	<tr>
	 <?php 
   	 if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
    	?>
	<tr>
		<th><?php echo NEXT_PROD; echo $village->resarray['f'.$id]+1; ?>:</th>
		<td><b><?php echo $bid4[$village->resarray['f'.$id]+1]['prod']* SPEED; ?></b> <?php echo PER_HR; ?></td>
	</tr>
    <?php 
    }
    ?>
	</tr>
</table>

<?php 
include("upgrade.tpl");
?></p></div>
