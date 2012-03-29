<div id="build" class="gid15"><a href="#" onClick="return Popup(15,4);" class="build_logo">
	<img class="building g15" src="img/x.gif" alt="Main Building" title="Main Building" />
</a>
<h1>Main Building <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">In the main building the village's master builders live. The higher its level the faster your master builders complete the construction of new buildings.</p>


	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th>Current construction time:</th>
			<td><b><?php echo round($bid15[$village->resarray['f'.$id]]['attri']); ?></b> Percent</td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
        ?>
			<th>Construction time at level <?php echo $village->resarray['f'.$id]+1; ?>:</th>
			<td><b><?php echo round($bid15[$village->resarray['f'.$id]+1]['attri']); ?></b> Percent</td>
            <?php
            }
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
