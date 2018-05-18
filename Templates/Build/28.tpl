<?php
include("next.tpl");
?>
<div id="build" class="gid28"><a href="#" onClick="return Popup(28,4);" class="build_logo">
	<img class="building g28" src="img/x.gif" alt="Trade Office" title="<?php echo TRADEOFFICE; ?>" />
</a>
<h1><?php echo TRADEOFFICE; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo TRADEOFFICE_DESC; ?></p>


	<table cellpadding="1" cellspacing="1" id="build_value">
		<tr>
			<th><?php echo CURRENT_MERCHANT; ?></th>
			<td><b><?php echo $village->resarray['f'.$id] > 0 ? $bid28[$village->resarray['f'.$id]]['attri'] : 100; ?></b> <?php echo PERCENT; ?></td>
		</tr>
		<tr>
		<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id] + 1 + $loopsame + $doublebuild + $master;
		if($next<=20){
        ?>
			<th><?php echo MERCHANT_LEVEL; ?> <?php echo $next; ?>:</th>
			<td><b><?php echo $bid28[$next]['attri']; ?></b> <?php echo PERCENT; ?></td>
            <?php
            }else{
        ?>
			<th><?php echo MERCHANT_LEVEL; ?> 20:</th>
			<td><b><?php echo $bid28[20]['attri']; ?></b> <?php echo PERCENT; ?></td>
            <?php
			}}
            ?>
		</tr>
	</table>
<?php 
include("upgrade.tpl");
?>
</p></div>
