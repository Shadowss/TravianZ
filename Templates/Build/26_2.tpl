<div id="build" class="gid26"><h1>Palace <span class="level">level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">
	<a href="#" onClick="return Popup(26,4, 'gid');"
		class="build_logo"> <img
		class="building g26"
		src="img/x.gif" alt="Palace"
		title="Palace" /> </a>
	The king or queen of the empire lives in the palace. Only one palace can exist in your realm at a time. You need a palace in order to proclaim a village to be your capital.</p>

<?php include("26_menu.tpl"); ?>

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
