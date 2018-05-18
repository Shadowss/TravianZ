<?php
include("next.tpl");
?>
<div id="build" class="gid35"><a href="#" onClick="return Popup(35,4);" class="build_logo">
	<img class="building g35" src="img/x.gif" alt="Brewery" title="<?php echo BREWERY; ?>" />
</a>
<h1><?php echo BREWERY; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo BREWERY_DESC; ?></p>


	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th><?php echo CURRENT_BONUS; ?></th>
			<td><b><?php echo $village->resarray['f'.$id] > 0 ? $bid35[$village->resarray['f'.$id]]['attri'] : 0; ?></b> <?php echo PERCENT; ?></td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
			$next = $village->resarray['f'.$id] + 1 + $loopsame + $doublebuild + $master;
		if($next <= 10){
        ?>
			<th><?php echo BONUS_LEVEL; ?> <?php echo $next; ?>:</th>
			<td><b><?php echo $bid35[$next]['attri']; ?></b> <?php echo PERCENT; ?></td>
            <?php
            }else{
        ?>
			<th><?php echo BONUS_LEVEL; ?> 10:</th>
			<td><b><?php echo $bid35[10]['attri']; ?></b> <?php echo PERCENT; ?></td>
            <?php
			}}
            ?>
		</tr>
	</table>
<?php 
include("upgrade.tpl");
?>
</p></div>