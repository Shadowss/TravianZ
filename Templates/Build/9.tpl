<?php
include("next.tpl");
?>
<div id="build" class="gid9"><a href="#" onClick="return Popup(9,4);" class="build_logo">
	<img class="building g9" src="img/x.gif" alt="Bakery" title="Bakery" />
</a>
<h1>Bakery <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">Here the flour produced in your mill is used to bake bread. In addition with the Grain Mill the increase in crop production can go up to 50 percent.</p>


	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th>Current crop bonus:</th>
			<td><b><?php echo $bid9[$village->resarray['f'.$id]]['attri']; ?></b> Percent</td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
		if($next<=5){
        ?>
			<th>Crop bonus at level <?php echo $next; ?>:</th>
			<td><b><?php echo $bid9[$next]['attri']; ?></b> Percent</td>
            <?php
            }else{
        ?>
			<th>Crop bonus at level 5:</th>
			<td><b><?php echo $bid9[5]['attri']; ?></b> Percent</td>
            <?php
			}}
            ?>
		</tr>
	</table>
<?php 
include("upgrade.tpl");
?>
</p></div>