<?php
include("next.tpl");
?>
<div id="build" class="gid6"><a href="#" onClick="return Popup(6,4);" class="build_logo">
	<img class="building g6" src="img/x.gif" alt="Brickyard" title="<?php echo BRICKYARD; ?>" />
</a>
<h1><?php echo BRICKYARD; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo BRICKYARD_DESC; ?></p>


	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th><?php echo CURRENT_WOOD_BONUS; ?></th>
			<td><b><?php echo $bid6[$village->resarray['f'.$id]]['attri']; ?></b> <?php echo PERCENT; ?></td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
		if($next<=5){
        ?>
			<th><?php echo CLAY_BONUS_LEVEL; ?> <?php echo $next; ?>:</th>
			<td><b><?php echo $bid6[$next]['attri']; ?></b> <?php echo PERCENT; ?></td>
            <?php
            }else{
        ?>
			<th><?php echo CLAY_BONUS_LEVEL; ?> 5:</th>
			<td><b><?php echo $bid6[5]['attri']; ?></b> <?php echo PERCENT; ?></td>
            <?php
			}}
            ?>
		</tr>
	</table>
<?php 
include("upgrade.tpl");
?>
</p></div>
