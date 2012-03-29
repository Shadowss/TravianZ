<div id="build" class="gid25"><h1>Residence <span class="level">level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">
	<a href="#" onClick="return Popup(25,4, 'gid');"
		class="build_logo"> <img
		class="building g25"
		src="img/x.gif" alt="Residence"
		title="Residence" /> </a>
		The residence is a small palace, where the king or queen lives when (s)he visits the village. The residence protects the village against enemies who want to conquer it.</p>


<?php include("25_menu.tpl"); ?>

By attacking with senators, chiefs or chieftains a village's loyalty can be brought down. If it reaches zero, the village joins the realm of the attacker. The loyalty of this village is currently at <b><?php echo floor($database->getVillageField($village->wid,'loyalty')); ?></b> percent.</div>
