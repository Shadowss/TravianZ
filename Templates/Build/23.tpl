<?php
include("next.tpl");
$multiplier = (($session->tribe == 3) ? 2 : 1) * CRANNY_CAPACITY;
$actualLevel = $village->resarray['f'.$id];
$level = min($actualLevel + 1 + $loopsame + $doublebuild + $master, 10);
?>
<div id="build" class="gid23"><a href="#" onClick="return Popup(23,4);" class="build_logo">
	<img class="building g23" src="img/x.gif" alt="Cranny" title="<?php echo CRANNY; ?>" />
</a>
<h1><?php echo CRANNY; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo CRANNY_DESC; ?></p>
	<table cellpadding="1" cellspacing="1" id="build_value">
	<tr>
		<th><?php echo CURRENT_HIDDEN_UNITS; ?></th>
		<td><b><?php echo $database->getArtifactsValueInfluence($session->uid, $village->wid, 7, $bid23[$village->resarray['f'.$id]]['attri'] * $multiplier); ?></b> <?php echo UNITS; ?></td>
	</tr>
	<?php if($actualLevel < 10){?>
	<tr>
		<th><?php echo HIDDEN_UNITS_LEVEL; ?> <?php echo $level; ?>:</th>
		<td><b><?php echo $database->getArtifactsValueInfluence($session->uid, $village->wid, 7, $bid23[$level]['attri'] * $multiplier); ?></b> <?php echo UNITS; ?></td>
	</tr>
	<?php } ?>
	</table>
<?php 
include("upgrade.tpl");
?>
</div>