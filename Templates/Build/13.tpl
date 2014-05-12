<div id="build" class="gid13"><a href="#" onClick="return Popup(13,4);" class="build_logo">

	<img class="building g13" src="img/x.gif" alt="Armoury" title="<?php echo ARMOURY; ?>" />
</a>
<h1><?php echo ARMOURY; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo ARMOURY_DESC; ?></p>
<?php
	if ($building->getTypeLevel(13) > 0) {
		include("13_upgrades.tpl");
	} else {
		echo "<p><b><?php echo UPGRADES_COMMENCE_ARMOURY; ?>Upgrades can commence when armoury is completed.</b><br>\n";
	}
include("upgrade.tpl");
?>
        </p>
         </div>
