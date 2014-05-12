<div id="build" class="gid22"><a href="#" onClick="return Popup(22,4);" class="build_logo">

	<img class="building g22" src="img/x.gif" alt="Academy" title="<?php echo ACADEMY; ?>" />
</a>
<h1><?php echo ACADEMY; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo ACADEMY_DESC; ?></p>
<?php
	if ($building->getTypeLevel(22) > 0) {
		include("22_".$session->tribe.".tpl");
	} else {
		echo "<p><b>".RESEARCH_COMMENCE_ACADEMY."</b><br>\n";
	}

	include("upgrade.tpl");
?>
        </p>
         </div>
