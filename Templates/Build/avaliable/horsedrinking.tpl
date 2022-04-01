<h2><?php echo HORSEDRINKING ?></h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc"><?php echo HORSEDRINKING_DESC ?></td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(41,4);">
				<img class="building g41" src="img/x.gif" alt="Horse Drinking Trough" title="Horse Drinking Trough" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 41;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>