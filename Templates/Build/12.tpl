<div id="build" class="gid12"><a href="#" onClick="return Popup(12,4);" class="build_logo">

	<img class="building g12" src="img/x.gif" alt="Blacksmith" title="Blacksmith" />
</a>
<h1>Blacksmith <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">In the blacksmith's melting furnaces your warriors' weapons are enhanced. By increasing its level you can order the fabrication of even better weapons.
<?php
	if ($building->getTypeLevel(12) > 0) {
		include("12_upgrades.tpl");
	} else {
		echo "<p><b>Upgrades can commence when blacksmith is completed.</b><br>\n";
	}
include("upgrade.tpl");
?>
        </p>
         </div>
