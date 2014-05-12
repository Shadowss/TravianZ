<?php
include("next.tpl");
?>
<div id="build" class="gid5"><a href="#" onClick="return Popup(5,4);" class="build_logo">
	<img class="building g5" src="img/x.gif" alt="Sawmill" title="<?php echo SAWMILL; ?>" />
</a>
<h1><?php echo SAWMILL; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo SAWMILL_DESC; ?></p>


	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th><?php echo CURRENT_WOOD_BONUS; ?></th>
			<td><b><?php echo $bid5[$village->resarray['f'.$id]]['attri']; ?></b> <?php echo PERCENT; ?></td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
		if($next<=5){
        ?>
			<th><?php echo WOOD_BONUS_LEVEL; ?> <?php echo $next; ?>:</th>
			<td><b><?php echo $bid5[$next]['attri']; ?></b> <?php echo PERCENT; ?></td>
            <?php
            }else{
        ?>
			<th><?php echo WOOD_BONUS_LEVEL; ?> 5:</th>
			<td><b><?php echo $bid5[5]['attri']; ?></b> <?php echo PERCENT; ?></td>
            <?php
			}}
            ?>
		</tr>
	</table>
<?php 
include("upgrade.tpl");
?>
</p></div>
