<?php
include("next.tpl");
?>
<div id="build" class="gid8"><a href="#" onClick="return Popup(8,4);" class="build_logo">
	<img class="building g8" src="img/x.gif" alt="Grain Mill" title="Grain Mill" />
</a>
<h1>Grain Mill <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">Here your grain is milled in order to produce flour. Based on its level your grain mill can increase your crop production by up to 25 percent.</p>


	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th>Current crop bonus:</th>
			<td><b><?php echo $bid8[$village->resarray['f'.$id]]['attri']; ?></b> Percent</td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
		if($next<=5){
        ?>
			<th>Crop bonus at level <?php echo $next; ?>:</th>
			<td><b><?php echo $bid8[$next]['attri']; ?></b> Percent</td>
            <?php
            }else{
        ?>
			<th>Crop bonus at level 5:</th>
			<td><b><?php echo $bid8[5]['attri']; ?></b> Percent</td>
            <?php
			}}
            ?>
		</tr>
	</table>
<?php 
include("upgrade.tpl");
?>
</p></div>