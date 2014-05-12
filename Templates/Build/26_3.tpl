<div id="build" class="gid26"><h1><?php echo PALACE; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">
	<a href="#" onClick="return Popup(26,4, 'gid');"
		class="build_logo"> <img
		class="building g26"
		src="img/x.gif" alt="Palace"
		title="<?php echo PALACE; ?>" /> </a>
	<?php echo PALACE_DESC; ?></p>


<?php include("26_menu.tpl"); ?>

<?php echo RESIDENCE_LOYALTY_DESC; ?> <b><?php echo floor($database->getVillageField($village->wid,'loyalty')); ?></b> <?php echo PERCENT; ?>.</div>
