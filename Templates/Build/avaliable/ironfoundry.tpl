<h2><?php echo IRONFOUNDRY ?></h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc"><?php echo IRONFOUNDRY_DESC ?></td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(7,4);">
				<img class="building g7" src="img/x.gif" alt="Iron Foundry" title="Iron Foundry" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 7;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>