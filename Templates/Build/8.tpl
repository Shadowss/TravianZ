<?php
include("next.tpl");
?>
<div id="build" class="gid8"><a href="#" onClick="return Popup(8,4);" class="build_logo">
	<img class="building g8" src="img/x.gif" alt="Grain Mill" title="<?php echo GRAINMILL; ?>" />
</a>
<h1><?php echo GRAINMILL; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo GRAINMILL_DESC; ?></p>


	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th><?php echo CURRENT_CROP_BONUS; ?></th>
			<td><b><?php echo $bid8[$village->resarray['f'.$id]]['attri']; ?></b> <?php echo PERCENT; ?></td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
		if($next<=5){
        ?>
			<th><?php echo CROP_BONUS_LEVEL; ?> <?php echo $next; ?>:</th>
			<td><b><?php echo $bid8[$next]['attri']; ?></b> <?php echo PERCENT; ?></td>
            <?php
            }else{
        ?>
			<th><?php echo CROP_BONUS_LEVEL; ?> 5:</th>
			<td><b><?php echo $bid8[5]['attri']; ?></b> <?php echo PERCENT; ?></td>
            <?php
			}}
            ?>
		</tr>
	</table>
<?php 
include("upgrade.tpl");
?>
</p></div>
