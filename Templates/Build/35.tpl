<?php
include("next.tpl");
?>
<div id="build" class="gid35"><a href="#" onClick="return Popup(35,4);" class="build_logo">
	<img class="building g35" src="img/x.gif" alt="Brewery" title="Brewery" />
</a>
<h1>Brewery <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">Tasty mead is brewed in the Brewery and later quaffed by the soldiers during the celebrations.</p>


	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th>Current bonus:</th>
			<td><b><?php echo $bid35[$village->resarray['f'.$id]]['attri']; ?></b> Percent</td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
		if($next<=10){
        ?>
			<th>Bonus at level <?php echo $next; ?>:</th>
			<td><b><?php echo $bid35[$next]['attri']; ?></b> Percent</td>
            <?php
            }else{
        ?>
			<th>Bonus at level 10:</th>
			<td><b><?php echo $bid35[10]['attri']; ?></b> Percent</td>
            <?php
			}}
            ?>
		</tr>
	</table>
<?php 
include("upgrade.tpl");
?>
</p></div>