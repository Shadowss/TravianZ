<h2><?php echo STONEMASON ?></h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc"><?php echo STONEMASON_DESC ?></td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(34,4);">
				<img class="building g34" src="img/x.gif" alt="Stonemason's Lodge" title="Stonemason's Lodge" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 34;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>