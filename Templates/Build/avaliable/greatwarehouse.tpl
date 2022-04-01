<h2><?php echo GREATWAREHOUSE ?></h2>

<table class="new_building" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="desc"><?php echo GREATWAREHOUSE_DESC ?></td>
		<td rowspan="3" class="bimg">
							<a href="#" onClick="return Popup(38,4);">
				<img class="building g38" src="img/x.gif" alt="Great Warehouse" title="Great Warehouse" /></a>
					</td>
	</tr>
	<tr>
		<?php
        $_GET['bid'] = 38;
        include("availupgrade.tpl");
        ?>
	</tr>
</table>