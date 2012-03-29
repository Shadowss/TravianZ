<div id="build" class="gid33">
<h1>Palisade <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">By building a Palisade you can protect your village against the barbarian hordes of your enemies. The higher the wall's level, the higher the bonus given to your forces' defence.</p>

<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th>Defence Bonus now:</th>
			<td><b><?php echo $bid33[$village->resarray['f'.$id]]['attri']; ?></b> Percent</td>
		</tr><tr>
        <?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
        ?>
			<th>Defence Bonus at level <?php echo $village->resarray['f'.$id]+1; ?>:</th>

			<td><b><?php echo $bid33[$village->resarray['f'.$id]+1]['attri']; ?></b> Percent</td>
            <?php
            }
            ?>
		</tr></table>
<?php 
include("upgrade.tpl");
?>
        </p>
         </div>