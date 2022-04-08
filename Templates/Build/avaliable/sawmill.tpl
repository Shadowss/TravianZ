<h2><?php echo SAWMILL ?></h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc"><?php echo SAWMILL_DESC ?></td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(5,4);">
				<img class="building g5" src="img/x.gif" alt="Sawmill" title="Sawmill" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 5;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>