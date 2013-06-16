<div id="build" class="gid22"><a href="#" onClick="return Popup(22,4);" class="build_logo">

	<img class="building g22" src="img/x.gif" alt="Academy" title="Academy" />
</a>
<h1>Academy <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">In the academy new unit types can be researched. By increasing its level you can order the research of better units.</p>
<?php
	if ($building->getTypeLevel(22) > 0) {
		include("22_".$session->tribe.".tpl");
	} else {
		echo "<p><b>Research can commence when academy is completed.</b><br>\n";
	}

	include("upgrade.tpl");
?>
        </p>
         </div>
