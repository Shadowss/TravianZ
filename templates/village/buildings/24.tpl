<div id="build" class="gid24"><a href="#" onClick="return Popup(24,4);" class="build_logo">
	<img class="building g24" src="img/x.gif" alt="Town Hall" title="<?php echo TOWNHALL; ?>" />
</a>
<h1><?php echo TOWNHALL; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo TOWNHALL_DESC; ?>
</p>
<?php
	if ($building->getTypeLevel(24) > 0) {
		include("Templates/Build/24_1.tpl"); 
		include("Templates/Build/24_2.tpl");
	} else {
		 echo "<p><b>".CELEBRATIONS_COMMENCE_TOWNHALL."</b><br>\n";
	}

	include("upgrade.tpl");

?>
</p></div>
