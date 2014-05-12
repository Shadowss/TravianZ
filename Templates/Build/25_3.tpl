<div id="build" class="gid25"><h1><?php echo RESIDENCE; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">
	<a href="#" onClick="return Popup(25,4, 'gid');"
		class="build_logo"> <img
		class="building g25"
		src="img/x.gif" alt="Residence"
		title="<?php echo RESIDENCE; ?>" /> </a>
		<?php echo RESIDENCE_DESC; ?></p>


<?php include("25_menu.tpl"); ?>

<?php echo RESIDENCE_LOYALTY_DESC; ?> <b><?php echo floor($database->getVillageField($village->wid,'loyalty')); ?></b> <?php echo PERCENT; ?>.</div>
