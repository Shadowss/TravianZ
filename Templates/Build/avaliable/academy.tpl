<h2>Academy</h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc">In the academy new unit types can be researched. By increasing its level you can order the research of better units.</td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(22,4);">
				<img class="building g22" src="img/x.gif" alt="Academy" title="Academy" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 22;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>