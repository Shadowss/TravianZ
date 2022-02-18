<h2><?php echo BLACKSMITH ?></h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc"><?php echo BLACKSMITH_DESC ?></td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(12,4);">
				<img class="building g12" src="img/x.gif" alt="<?php echo BLACKSMITH ?>" title="<?php echo BLACKSMITH ?>" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 12;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>
