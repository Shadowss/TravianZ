    <h2><?php echo ARMOURY ?></h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc"><?php echo ARMOURY_DESC ?></td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(13,4);">
				<img class="building g13" src="img/x.gif" alt="<?php echo ARMOURY ?>" title="<?php echo ARMOURY ?>" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 13;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>
