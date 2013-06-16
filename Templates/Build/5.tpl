<?php
include("next.tpl");
?>
<div id="build" class="gid5"><a href="#" onClick="return Popup(5,4);" class="build_logo">
	<img class="building g5" src="img/x.gif" alt="Sawmill" title="Sawmill" />
</a>
<h1>Sawmill <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">Here wood delivered by your Woodcutters is processed. Based on its level your sawmill can increase your wood production by up to 25 percent.</p>


	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th>Current wood bonus:</th>
			<td><b><?php echo $bid5[$village->resarray['f'.$id]]['attri']; ?></b> Percent</td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
		if($next<=5){
        ?>
			<th>Wood bonus at level <?php echo $next; ?>:</th>
			<td><b><?php echo $bid5[$next]['attri']; ?></b> Percent</td>
            <?php
            }else{
        ?>
			<th>Wood bonus at level 5:</th>
			<td><b><?php echo $bid5[5]['attri']; ?></b> Percent</td>
            <?php
			}}
            ?>
		</tr>
	</table>
<?php 
include("upgrade.tpl");
?>
</p></div>