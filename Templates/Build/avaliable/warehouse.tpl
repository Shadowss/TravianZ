<h2><?php echo WAREHOUSE ?></h2>

<table class="new_building" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="desc"><?php echo WAREHOUSE_DESC ?></td>
		<td rowspan="3" class="bimg">
							<a href="#" onClick="return Popup(10,4);">
				<img class="building g10" src="img/x.gif" alt="<?php echo WAREHOUSE ?>" title="<?php echo WAREHOUSE ?>" /></a>
					</td>
	</tr>
	<tr>
		<?php
        $_GET['bid'] = 10;
        include("availupgrade.tpl");
        ?>
	</tr>
</table>
