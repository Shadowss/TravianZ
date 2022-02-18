<h2><?php echo ACADEMY ?></h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc"><?php echo ACADEMY_DESC ?></td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(22,4);">
				<img class="building g22" src="img/x.gif" alt="<?php echo ACADEMY ?>" title="<?php echo ACADEMY ?>" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 22;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>
