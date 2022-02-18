	<h2><?php echo HEROSMANSION ?></h2>

<table class="new_building" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="desc"><?php echo HEROSMANSION_DESC ?></td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(37,4);">
				<img class="building g37" src="img/x.gif" alt="<?php echo HEROSMANSION ?>" title="<?php echo HEROSMANSION ?>" /></a>
			</td>
	</tr>
	<tr>
		<?php
        $_GET['bid'] = 37;
        include("availupgrade.tpl");
        ?>
	</tr>
</table>
