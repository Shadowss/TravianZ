    <h2>Armoury</h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc">In the armoury&#39;s melting furnaces your warriors&#39; armour is enhanced. By increasing its level you can order the fabrication of even better armour.</td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(13,4);">
				<img class="building g13" src="img/x.gif" alt="Armoury" title="Armoury" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 13;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>