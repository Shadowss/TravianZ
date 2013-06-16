<div id="build" class="gid25"><h1>Residence <span class="level">level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">
	<a href="#" onClick="return Popup(25,4, 'gid');"
		class="build_logo"> <img
		class="building g25"
		src="img/x.gif" alt="Residence"
		title="Residence" /> </a>
	The residence is a small palace, where the king or queen lives when (s)he visits the village. The residence protects the village against enemies who want to conquer it.</p>

<?php include("25_menu.tpl"); ?>

<p>In order to extend your empire you need culture points. These culture points increase in the course of time and do so faster as your building levels increase.</p>

<table cellpadding="1" cellspacing="1" id="build_value">
<tr>
	<th>Production of this village:</th>
<?php if($database->getVillageField($village->wid, 'natar') == 0){ ?>
	<td><b><?php echo $database->getVillageField($village->wid, 'cp'); ?></b> Culture points per day</td>
<?php }else{ ?>
	<td><b>0</b> Culture points per day</td>
<?php } ?>
</tr>
<tr>
	<th>Production of all villages:</th>
	<td><b><?php echo $database->getVSumField($session->uid, 'cp'); ?></b> Culture points per day</td>
</tr>
</table><p>Your villages have produced <b><?php echo $session->cp; ?></b> points in total. To found or conquer a new village you need <b><?php $mode = CP; $total = count($database->getProfileVillages($session->uid)); echo ${'cp'.$mode}[$total+1]; ?></b> points.</p>
</div>
