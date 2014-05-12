<?php
include("next.tpl");
?>
<div id="build" class="gid38"><a href="#" onClick="return Popup(38,4);" class="build_logo">
	<img class="building g38" src="img/x.gif" alt="Great Warehouse" title="<?php echo GREATWAREHOUSE; ?>" />
</a>
<h1><?php echo GREATWAREHOUSE; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo GREATWAREHOUSE_DESC; ?></p>


	<table cellpadding="1" cellspacing="1" id="build_value">
	<tr>
		<th><?php echo CURRENT_CAPACITY; ?></th>
		<td><b><?php echo $bid38[$village->resarray['f'.$id]]['attri']*STORAGE_MULTIPLIER; ?></b> <?php echo RESOURCE_UNITS; ?></td>
	</tr>
	<tr>
<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
		if($next<=20){
        ?>
		<th><?php echo CAPACITY_LEVEL; ?> <?php echo $next ?>:</th>
		<td><b><?php echo $bid38[$next]['attri']*STORAGE_MULTIPLIER; ?></b> <?php echo RESOURCE_UNITS; ?></td>
        <?php
            }else{
		?>
		<th><?php echo CAPACITY_LEVEL; ?> 20:</th>
		<td><b><?php echo $bid38[20]['attri']*STORAGE_MULTIPLIER; ?></b> <?php echo RESOURCE_UNITS; ?></td>
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
