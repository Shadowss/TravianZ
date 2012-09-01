<?php
include("next.tpl");
?>
<div id="build" class="gid39"><a href="#" onClick="return Popup(39,4);" class="build_logo">
	<img class="building g39" src="img/x.gif" alt="Great Granary" title="Great Granary" />
</a>
<h1>Great Granary <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">Crop produced by your farms is stored in the granary. The great granary offers you more space and keeps your crops drier and safer than the normal one.</p>


	<table cellpadding="1" cellspacing="1" id="build_value">
	<tr>
		<th>Current capacity:</th>
		<td><b><?php echo $bid39[$village->resarray['f'.$id]]['attri']*STORAGE_MULTIPLIER; ?></b> Crop units</td>
	</tr>
    
	<tr>
<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
		if($next<=20){
        ?>
		<th>Capacity at level <?php echo $next ?>:</th>
		<td><b><?php echo $bid39[$next]['attri']*STORAGE_MULTIPLIER; ?></b> Crop units</td>
        <?php
            }else{
		?>
		<th>Capacity at level 20:</th>
		<td><b><?php echo $bid39[20]['attri']*STORAGE_MULTIPLIER; ?></b> Crop units</td>
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
