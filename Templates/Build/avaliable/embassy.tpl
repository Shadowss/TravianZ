<h2>Embassy</h2>

<table class="new_building" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="desc">The embassy is a place for diplomats. The higher its level the more options the king gains.</td>
		<td rowspan="3" class="bimg">
							<a href="#" onClick="return Popup(18,4);">
				<img class="building g18" src="img/x.gif" alt="Embassy" title="Embassy" /></a>
					</td>
	</tr>
	<tr>
		<?php
        $_GET['bid'] = 18;
        include("availupgrade.tpl");
        ?>
	</tr>
</table>