<h2><?php echo MAINBUILDING ?></h2>

<table class="new_building" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="desc"><?php echo MAINBUILDING_DESC ?></td>
		<td rowspan="3" class="bimg">
							<a href="#" onClick="return Popup(10,4);">
				<img class="building g15" src="img/x.gif" alt="Main Building" title="Main Building" /></a>
					</td>
	</tr>
	<tr>
		<?php
        $_GET['bid'] = 15;
        include("availupgrade.tpl");
        ?>
	</tr>
</table>