<div id="build" class="gid25"><h1><?php echo RESIDENCE; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">
	<a href="#" onClick="return Popup(25,4, 'gid');"
		class="build_logo"> <img
		class="building g25"
		src="img/x.gif" alt="Residence"
		title="<?php echo RESIDENCE; ?>" /> </a>
	<?php echo RESIDENCE_DESC; ?></p>

<?php
if ($village->capital == 1) {
	echo "<p class=\"act\">".CAPITAL."</p>";
}

include("25_menu.tpl");

if($village->resarray['f'.$id] >= 10){
	include ("25_train.tpl");	
}
else{
	echo '<div class="c">'.RESIDENCE_TRAIN_DESC.'</div>';
}

include("upgrade.tpl");
?>
</div>
