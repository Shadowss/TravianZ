<h2>Warehouse</h2>

<table class="new_building" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="desc">In your warehouse the resources lumber, clay and iron are stored. By increasing its level you increase your warehouse's capacity.</td>
		<td rowspan="3" class="bimg">
							<a href="#" onClick="return Popup(10,4);">
				<img class="building g10" src="img/x.gif" alt="Warehouse" title="Warehouse" /></a>
					</td>
	</tr>
	<tr>
		<?php
        $_GET['bid'] = 10;
        include("availupgrade.tpl");
        ?>
	</tr>
</table>