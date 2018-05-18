<div id="build" class="gid41"><a href="#" onClick="return Popup(41,4);" class="build_logo">
	<img class="building g41" src="img/x.gif" alt="Horse Drinking Trough" title="<?php echo HORSEDRINKING; ?>" />
</a>
<h1><?php echo HORSEDRINKING; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo HORSEDRINKING_DESC; ?></p>
	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th><?php echo CURRENT_BONUS; ?></th>
			<td><b><?php echo $village->resarray['f'.$id] > 0 ? $bid41[$village->resarray['f'.$id]]['attri'] * 100 - 100 : 0; ?></b> <?php echo PERCENT; ?></td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
			$next = $village->resarray['f'.$id] + 1 + $loopsame + $doublebuild + $master;
		if($next <= 20){
        ?>
			<th><?php echo BONUS_LEVEL; ?> <?php echo $next; ?>:</th>
			<td><b><?php echo $bid41[$next]['attri'] * 100 - 100; ?></b> <?php echo PERCENT; ?></td>
            <?php
            }else{
        ?>
			<th><?php echo BONUS_LEVEL; ?> 20:</th>
			<td><b><?php echo $bid41[20]['attri']; ?></b> <?php echo PERCENT; ?></td>
            <?php
			}}
            ?>
		</tr>
	</table>
<?php 
include("upgrade.tpl");
?>
</p></div>