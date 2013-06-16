<?php
include("next.tpl");
?>
<div id="build" class="gid11"><a href="#" onClick="return Popup(11,4);" class="build_logo">
	<img class="building g11" src="img/x.gif" alt="Granary" title="Granary" />
</a>
<h1>Granary <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">Crop produced by your farms is stored in the Granary. By increasing its level you increase the Granary's capacity.</p>


	<table cellpadding="1" cellspacing="1" id="build_value">
	<tr>
		<th>Current capacity:</th>
		<td><b><?php echo $bid11[$village->resarray['f'.$id]]['attri']*STORAGE_MULTIPLIER; ?></b> Crop units</td>
	</tr>
    
	<tr>
<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
		if($next<=20){
        ?>
		<th>Capacity at level <?php echo $next ?>:</th>
		<td><b><?php echo $bid11[$next]['attri']*STORAGE_MULTIPLIER; ?></b> Crop units</td>
        <?php
            }else{
		?>
		<th>Capacity at level 20:</th>
		<td><b><?php echo $bid11[20]['attri']*STORAGE_MULTIPLIER; ?></b> Crop units</td>
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
