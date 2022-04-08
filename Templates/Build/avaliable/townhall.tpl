 <h2><?php echo TOWNHALL ?></h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc"><?php echo TOWNHALL_DESC ?></td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(24,4);">
				<img class="building g24" src="img/x.gif" alt="Town Hall" title="Town Hall" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 24;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>