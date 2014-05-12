<?php
include("next.tpl");
?>
<div id="build" class="gid10"><a href="#" onClick="return Popup(10,4);" class="build_logo">
	<img class="building g10" src="img/x.gif" alt="Warehouse" title="<?php echo WAREHOUSE; ?>" />
</a>
<h1><?php echo WAREHOUSE; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo WAREHOUSE_DESC; ?></p>


	<table cellpadding="1" cellspacing="1" id="build_value">
	<tr>
		<th><?php echo CURRENT_CAPACITY; ?></th>
		<td><b><?php echo $bid10[$village->resarray['f'.$id]]['attri']*STORAGE_MULTIPLIER; ?></b> <?php echo RESOURCE_UNITS; ?></td>
	</tr>
	<tr>
<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
		if($next<=20){
        ?>
		<th><?php echo CAPACITY_LEVEL; ?> <?php echo $next ?>:</th>
		<td><b><?php echo $bid10[$next]['attri']*STORAGE_MULTIPLIER; ?></b> <?php echo RESOURCE_UNITS; ?></td>
        <?php
            }else{
		?>
		<th><?php echo CAPACITY_LEVEL; ?> 20:</th>
		<td><b><?php echo $bid10[20]['attri']*STORAGE_MULTIPLIER; ?></b> <?php echo RESOURCE_UNITS; ?></td>
		<?php
			}
			}
        ?>
	</tr>
	</table>
 <?php 
include("upgrade.tpl");
?>
</p></div>
