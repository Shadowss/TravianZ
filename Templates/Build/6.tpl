<div id="build" class="gid6"><a href="#" onClick="return Popup(6,4);" class="build_logo">
	<img class="building g6" src="img/x.gif" alt="Brickyard" title="Brickyard" />
</a>
<h1>Brickyard <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">Here clay is processed into bricks. Based on its level your Brickyard can increase your clay production by up to 25 percent.</p>


	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th>Current clay bonus:</th>
			<td><b><?php echo $bid6[$village->resarray['f'.$id]]['attri']; ?></b> Percent</td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
        ?>
			<th>Clay bonus at level <?php echo $village->resarray['f'.$id]+1; ?>:</th>
			<td><b><?php echo $bid6[$village->resarray['f'.$id]+1]['attri']; ?></b> Percent</td>
            <?php
            }
            ?>
		</tr>
	</table>
<?php 
include("upgrade.tpl");
?>
</p></div>