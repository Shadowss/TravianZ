<h2><?php echo TRADEOFFICE ?></h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc"><?php echo TRADEOFFICE_DESC ?></td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(28,4);">
				<img class="building g28" src="img/x.gif" alt="Trade Office" title="Trade Office" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 28;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>