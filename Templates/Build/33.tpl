<?php
include("next.tpl");
?>
<div id="build" class="gid33">
<h1><?php echo PALISADE; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo PALISADE_DESC; ?></p>

<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th><?php echo DEFENCE_NOW; ?></th>
			<td><b><?php echo $village->resarray['f'.$id] > 0 ? $bid33[$village->resarray['f'.$id]]['attri'] : 0; ?></b> <?php echo PERCENT; ?></td>
		</tr><tr>
        <?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
			$next = $village->resarray['f'.$id] + 1 + $loopsame + $doublebuild + $master;
		if($next <= 20){
        ?>
			<th><?php echo DEFENCE_LEVEL; ?> <?php echo $next; ?>:</th>

			<td><b><?php echo $bid33[$next]['attri']; ?></b> <?php echo PERCENT; ?></td>
            <?php
            }else{
		?>
		<th><?php echo DEFENCE_LEVEL; ?> 20:</th>
		<td><b><?php echo $bid33[20]['attri']; ?></b> <?php echo PERCENT; ?></td>
		<?php
			}
			}
            ?>
		</tr></table>
<?php 
include("upgrade.tpl");
?>
        </p>
         </div>