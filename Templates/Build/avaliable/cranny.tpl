	<h2><?php echo CRANNY ?></h2>

<table class="new_building" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="desc"><?php echo CRANNY_DESC ?></td>
		<td rowspan="3" class="bimg">
							<a href="#" onClick="return Popup(26,4);">
				<img class="building g23" src="img/x.gif" alt="<?php echo CRANNY ?>" title="<?php echo CRANNY ?>" /></a>
					</td>
	</tr>
	<tr>
		<?php
        $_GET['bid'] = 23;
        include("availupgrade.tpl");
        ?>
	</tr>
</table>
