<h2><?php echo TREASURY ?></h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc"><?php echo TREASURY_DESC ?></td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(27,4);">
				<img class="building g27" src="img/x.gif" alt="Treasury" title="Treasury" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 27;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>