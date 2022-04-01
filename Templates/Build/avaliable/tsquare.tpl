<h2><?php echo TOURNAMENTSQUARE ?></h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc"><?php echo TOURNAMENTSQUARE_DESC ?></td>
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