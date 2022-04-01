<h2><?php echo PALACE ?></h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc"><?php echo PALACE_DESC ?></td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(26,4);">
				<img class="building g26" src="img/x.gif" alt="Palace" title="Palace" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 26;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>