<h2><?php echo TRAPPER ?></h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc"><?php echo TRAPPER_DESC ?> </td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(36,4);">
				<img class="building g36" src="img/x.gif" alt="<?php echo TRAPPER ?>" title="<?php echo TRAPPER ?>" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 36;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>
