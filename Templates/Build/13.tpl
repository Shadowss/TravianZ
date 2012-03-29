<div id="build" class="gid13"><a href="#" onClick="return Popup(13,4);" class="build_logo">

	<img class="building g13" src="img/x.gif" alt="Armoury" title="Armoury" />
</a>
<h1>Armoury <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">In the armoury&#39;s melting furnaces your warriors&#39; armour is enhanced. By increasing its level you can order the fabrication of even better armour.
<?php
	if ($building->getTypeLevel(13) > 0) {
		include("13_upgrades.tpl");
	} else {
		echo "<p><b>Upgrades can commence when armoury is completed.</b><br>\n";
	}
include("upgrade.tpl");
?>
        </p>
         </div>
