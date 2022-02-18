<h2><?php echo STABLE ?></h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc"><?php echo STABLE_DESC ?></td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(20,4);">
				<img class="building g20" src="img/x.gif" alt="<?php echo STABLE ?>" title="<?php echo STABLE ?>" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 20;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>
