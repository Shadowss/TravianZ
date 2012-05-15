<?php
include("next.tpl");
?>
<div id="build" class="gid7"><a href="#" onClick="return Popup(7,4);" class="build_logo">
	<img class="building g7" src="img/x.gif" alt="Iron Foundry" title="Iron Foundry" />
</a>
<h1>Iron Foundry <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">Iron is smelted here. Based on its level your Iron Foundry can increase your iron production by up to 25 percent.</p>


	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th>Current iron bonus:</th>
			<td><b><?php echo $bid7[$village->resarray['f'.$id]]['attri']; ?></b> Percent</td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
		if($next<=5){
        ?>
			<th>Iron bonus at level <?php echo $next; ?>:</th>
			<td><b><?php echo $bid7[$next]['attri']; ?></b> Percent</td>
            <?php
            }else{
        ?>
			<th>Iron bonus at level 5:</th>
			<td><b><?php echo $bid7[5]['attri']; ?></b> Percent</td>
            <?php
			}}
            ?>
		</tr>
	</table>
<?php 
include("upgrade.tpl");
?>
</p></div>