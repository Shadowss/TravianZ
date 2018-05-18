<?php
include("next.tpl");
?>
<div id="build" class="gid14"><a href="#" onClick="return Popup(14,4);" class="build_logo">
	<img class="building g14" src="img/x.gif" alt="Tournament Square" title="<?php echo TOURNAMENTSQUARE; ?>" />
</a>
<h1><?php echo TOURNAMENTSQUARE; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo TOURNAMENTSQUARE_DESC; ?> </p>


	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th><?php echo CURRENT_SPEED; ?></th>
			<td><b><?php echo $village->resarray['f'.$id] > 0 ? $bid14[$village->resarray['f'.$id]]['attri'] : 100; ?></b> <?php echo PERCENT; ?></td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
		if($next <= 20){
        ?>
			<th><?php echo SPEED_LEVEL; ?> <?php echo $next; ?>:</th>
			<td><b><?php echo $bid14[$next]['attri']; ?></b> <?php echo PERCENT; ?></td>
            <?php
            }else{
        ?>
			<th><?php echo SPEED_LEVEL; ?> 20:</th>
			<td><b><?php echo $bid14[20]['attri']; ?></b> <?php echo PERCENT; ?></td>
            <?php
			}}
            ?>
		</tr>
	</table>
<?php 
include("upgrade.tpl");
?>
</p></div>
