<div id="build" class="gid1"><a href="#" onClick="return Popup(0,4);" class="build_logo">
<img class="building g1" src="img/x.gif" alt="<?php echo B1; ?>" title="<?php echo B1; ?>" />
</a>
<h1><?php echo B1; ?> <span class="level"><?php echo LEVEL." ";  echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo B1_DESC; ?></p>
<table cellpadding="1" cellspacing="1" id="build_value">
	<tr>
		<th><?php echo CUR_PROD; ?>:</th>
		<td><b><?php echo $bid1[$village->resarray['f'.$id]]['prod']* SPEED; ?></b> <?php echo PER_HR; ?></td>
	</tr>
    <?php 
    if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
    ?>
	<tr>
		<th><?php echo NEXT_PROD; echo $village->resarray['f'.$id]+1; ?>:</th>
		<td><b><?php echo $bid1[$village->resarray['f'.$id]+1]['prod']* SPEED; ?></b> <?php echo PER_HR; ?></td>
	</tr>
    <?php 
    }
    ?>
</table>
<?php 
include("upgrade.tpl");
?>
</p></div>
