<?php
include("next.tpl");
?>
<div id="build" class="gid32">
<h1>Earth Wall <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">By building a Earth Wall you can protect your village against the barbarian hordes of your enemies. The higher the wall's level, the higher the bonus given to your forces' defence.</p>

<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th>Defence Bonus now:</th>
			<td><b><?php echo $bid32[$village->resarray['f'.$id]]['attri']; ?></b> Percent</td>
		</tr><tr>
        <?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
		if($next<=20){
        ?>
			<th>Defence Bonus at level <?php echo $next; ?>:</th>

			<td><b><?php echo $bid32[$next]['attri']; ?></b> Percent</td>
            <?php
            }else{
		?>
		<th>Defence Bonus at level 20:</th>
		<td><b><?php echo $bid32[20]['attri']; ?></b> Percent</td>
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