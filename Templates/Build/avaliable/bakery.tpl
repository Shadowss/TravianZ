<h2><?php echo BAKERY ?></h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc"><?php echo BAKERY_DESC ?></td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(9,4);">
				<img class="building g9" src="img/x.gif" alt="Bakery" title="Bakery" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 9;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>