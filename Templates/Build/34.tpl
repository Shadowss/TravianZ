<?php
include("next.tpl");
?>
<div id="build" class="gid34"><a href="#" onClick="return Popup(34,4);" class="build_logo">
	<img class="building g34" src="img/x.gif" alt="Stonemason's Lodge" title="<?php echo STONEMASON; ?>" />
</a>
<h1><?php echo STONEMASON; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo STONEMASON_DESC; ?></p>


	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th><?php echo CURRENT_STABILITY; ?></th>
			<td><b><?php echo $bid34[$village->resarray['f'.$id]]['attri']; ?></b> <?php echo PERCENT; ?></td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
		if($next<=20){
        ?>
			<th><?php echo STABILITY_LEVEL; ?> <?php echo $next; ?>:</th>
			<td><b><?php echo $bid34[$next]['attri']; ?></b> <?php echo PERCENT; ?></td>
            <?php
            }else{
        ?>
			<th><?php echo STABILITY_LEVEL; ?> 20:</th>
			<td><b><?php echo $bid34[20]['attri']; ?></b> <?php echo PERCENT; ?></td>
            <?php
			}}
            ?>
		</tr>
	</table>
<?php 
include("upgrade.tpl");
?>
</p></div>