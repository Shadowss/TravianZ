<div id="build" class="gid26"><h1>Palace <span class="level">level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">
	<a href="#" onClick="return Popup(26,4, 'gid');"
		class="build_logo"> <img
		class="building g26"
		src="img/x.gif" alt="Palace"
		title="Palace" /> </a>
	The king or queen of the empire lives in the palace. Only one palace can exist in your realm at a time. You need a palace in order to proclaim a village to be your capital.</p>


<?php include("26_menu.tpl"); ?>

By attacking with senators, chiefs or chieftains a village's loyalty can be brought down. If it reaches zero, the village joins the realm of the attacker. The loyalty of this village is currently at <b><?php echo floor($database->getVillageField($village->wid,'loyalty')); ?></b> percent.</div>
