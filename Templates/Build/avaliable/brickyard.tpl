<h2><?php echo BRICKYARD ?></h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc"><?php echo BRICKYARD_DESC ?></td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(6,4);">
				<img class="building g6" src="img/x.gif" alt="Brickyard" title="Brickyard" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 6;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>