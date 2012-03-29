<div id="build" class="gid25"><h1>Residence <span class="level">level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">
	<a href="#" onClick="return Popup(25,4, 'gid');"
		class="build_logo"> <img
		class="building g25"
		src="img/x.gif" alt="Residence"
		title="Residence" /> </a>
	The residence is a small palace, where the king or queen lives when (s)he visits the village. The residence protects the village against enemies who want to conquer it.</p>

<?php
if ($village->capital == 1) {
	echo "<p class=\"act\">This is your capital</p>";
}

include("25_menu.tpl");

if($village->resarray['f'.$id] >= 10){
	include ("25_train.tpl");	
}
else{
	echo '<div class="c">In order to found a new village you need a level 10 or 20 residence and 3 settlers. In order to conquer a new village you need a level 10 or 20 residence and a senator, chief or chieftain.</div>';
}

include("upgrade.tpl");
?>
</div>
