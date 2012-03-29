<div id="build" class="gid28"><a href="#" onClick="return Popup(28,4);" class="build_logo">
	<img class="building g28" src="img/x.gif" alt="Trade Office" title="Trade Office" />
</a>
<h1>Trade Office <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">In the trade office the merchants' carts get improved and equipped with powerful horses. The higher its level the more your merchants are able to carry.</p>


	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th>Current merchant load:</th>
			<td><b><?php echo $bid28[$village->resarray['f'.$id]]['attri']; ?></b> Percent</td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
        ?>
			<th>Merchant load at level <?php echo $village->resarray['f'.$id]+1; ?>:</th>
			<td><b><?php echo $bid28[$village->resarray['f'.$id]+1]['attri']; ?></b> Percent</td>
            <?php
            }
            ?>
		</tr>
	</table>
<?php 
include("upgrade.tpl");
?>
</p></div>
