<h2>Tournament Square</h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc">At the tournament square your troops can train to increase their stamina. The further the building is upgraded the faster your troops are beyond a minimum distance of <?php echo TS_THRESHOLD; ?> squares.</td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(14,4);">
				<img class="building g14" src="img/x.gif" alt="Tournament Square" title="Tournament Square" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 14;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>