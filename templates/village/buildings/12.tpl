<div id="build" class="gid12"><a href="#" onClick="return Popup(12,4);" class="build_logo">

	<img class="building g12" src="img/x.gif" alt="Blacksmith" title="<?php echo BLACKSMITH; ?>" />
</a>
<h1><?php echo BLACKSMITH; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo BLACKSMITH_DESC; ?></p>
<?php
	if ($building->getTypeLevel(12) > 0) {
		include("12_upgrades.tpl");
	} else {
		echo "<p><b><?php echo UPGRADES_COMMENCE_BLACKSMITH; ?></b><br>\n";
	}
include("upgrade.tpl");
?>
        </p>
         </div>
