<?php
/**
 * ==========================================================
 * menu.tpl - SAFE CLEANUP
 * ==========================================================
 * - Logică 100% păstrată
 * - Evitare NOTICE PHP (undefined $_GET)
 * - Reducere duplicare condiții
 * - Compatibil PHP 5.6 / 7+
 * ==========================================================
 */

// safe param
$section = isset($_GET['s']) ? (int)$_GET['s'] : 0;
?>

<div id="textmenu">

	<a href="dorf3.php" class="<?php echo ($section === 0 ? 'selected' : ''); ?>">
		Overview
	</a>

	|
	<a href="dorf3.php?s=2" class="<?php echo ($section === 2 ? 'selected' : ''); ?>">
		Resources
	</a>

	|
	<a href="dorf3.php?s=3" class="<?php echo ($section === 3 ? 'selected' : ''); ?>">
		Warehouse
	</a>

	|
	<a href="dorf3.php?s=4" class="<?php echo ($section === 4 ? 'selected' : ''); ?>">
		CP
	</a>

	|
	<a href="dorf3.php?s=5" class="<?php echo ($section === 5 ? 'selected' : ''); ?>">
		Troops
	</a>

</div>