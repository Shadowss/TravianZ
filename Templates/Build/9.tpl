<?php
include("next.tpl");
?>
<div id="build" class="gid9"><a href="#" onClick="return Popup(9,4);" class="build_logo">
	<img class="building g9" src="img/x.gif" alt="Bakery" title="<?php echo BAKERY; ?>" />
</a>
<h1><?php echo BAKERY; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo BAKERY_DESC; ?></p>


	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th><?php echo CURRENT_CROP_BONUS; ?></th>
			<td><b><?php echo $village->resarray['f'.$id] > 0 ? $bid9[$village->resarray['f'.$id]]['attri'] : 0; ?></b> <?php echo PERCENT; ?></td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
		if($next <= 5){
        ?>
			<th><?php echo CROP_BONUS_LEVEL; ?> <?php echo $next; ?>:</th>
			<td><b><?php echo $bid9[$next]['attri']; ?></b> <?php echo PERCENT; ?></td>
            <?php
            }else{
        ?>
			<th><?php echo CROP_BONUS_LEVEL; ?> 5:</th>
			<td><b><?php echo $bid9[5]['attri']; ?></b> <?php echo PERCENT; ?></td>
            <?php
			}}
            ?>
		</tr>
	</table>
<?php 
include("upgrade.tpl");
?>
</p></div>
