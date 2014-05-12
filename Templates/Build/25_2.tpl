<div id="build" class="gid25"><h1><?php echo RESIDENCE; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">
	<a href="#" onClick="return Popup(25,4, 'gid');"
		class="build_logo"> <img
		class="building g25"
		src="img/x.gif" alt="Residence"
		title="<?php echo RESIDENCE; ?>" /> </a>
	<?php echo RESIDENCE_DESC; ?></p>

<?php include("25_menu.tpl"); ?>

<p><?php echo RESIDENCE_CULTURE_DESC; ?></p>

<table cellpadding="1" cellspacing="1" id="build_value">
<tr>
	<th><?php echo PRODUCTION_POINTS; ?></th>
<?php if($database->getVillageField($village->wid, 'natar') == 0){ ?>
	<td><b><?php echo $database->getVillageField($village->wid, 'cp'); ?></b> <?php echo POINTS_DAY; ?></td>
<?php }else{ ?>
	<td><b>0</b> <?php echo POINTS_DAY; ?></td>
<?php } ?>
</tr>
<tr>
	<th><?php echo PRODUCTION_ALL_POINTS; ?></th>
	<td><b><?php echo $database->getVSumField($session->uid, 'cp'); ?></b> <?php echo POINTS_DAY; ?></td>
</tr>
</table><p><?php echo VILLAGES_PRODUCED; ?> <b><?php echo $session->cp; ?></b> <?php echo POINTS_NEED; ?> <b><?php $mode = CP; $total = count($database->getProfileVillages($session->uid)); echo ${'cp'.$mode}[$total+1]; ?></b> <?php echo POINTS; ?>.</p>
</div>
