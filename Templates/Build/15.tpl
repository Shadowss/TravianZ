<?php
include("next.tpl");
?>
<div id="build" class="gid15"><a href="#" onClick="return Popup(15,4);" class="build_logo">
	<img class="building g15" src="img/x.gif" alt="Main Building" title="<?php echo MAINBUILDING; ?>" />
</a>
<h1><?php echo MAINBUILDING; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo MAINBUILDING_DESC; ?></p>


	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th><?php echo CURRENT_CONSTRUCTION_TIME; ?></th>
			<td><b><?php echo $village->resarray['f'.$id] > 0 ? round($bid15[$village->resarray['f'.$id]]['attri']) : 300; ?></b> <?php echo PERCENT; ?></td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id] + 1 + $loopsame + $doublebuild + $master;
		if($next <= 20){
        ?>
			<th><?php echo CONSTRUCTION_TIME_LEVEL; ?> <?php echo $next; ?>:</th>
			<td><b><?php echo round($bid15[$next]['attri']); ?></b> <?php echo PERCENT; ?></td>
            <?php
            }else{
        ?>
			<th><?php echo CONSTRUCTION_TIME_LEVEL; ?> 20:</th>
			<td><b><?php echo round($bid15[20]['attri']); ?></b> <?php echo PERCENT; ?></td>
            <?php
			}}
            ?>
		</tr>
	</table>
	
<?php 
if($village->resarray['f'.$id] >= 10){
	include("Templates/Build/15_1.tpl");
}
include("upgrade.tpl");
?>
</p></div>
