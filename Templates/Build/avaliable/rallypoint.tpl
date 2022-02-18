	<h2><?php echo RALLYPOINT ?></h2>

<table class="new_building" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="desc"><?php echo RALLYPOINT_DESC ?></td>
		<td rowspan="3" class="bimg">
							<a href="#" onClick="return Popup(16,4);">
				<img class="g16" src="img/x.gif" alt="<?php echo RALLYPOINT ?>" title="<?php echo RALLYPOINT ?>" /></a>
					</td>
	</tr>
	<tr>
		<?php
        $_GET['bid'] = 16;
        include("availupgrade.tpl");
        ?>
	</tr>
</table>
