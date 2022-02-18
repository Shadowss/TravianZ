<h2><?php echo EMBASSY ?></h2>

<table class="new_building" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="desc"><?php echo EMBASSY_DESC ?></td>
		<td rowspan="3" class="bimg">
							<a href="#" onClick="return Popup(18,4);">
				<img class="building g18" src="img/x.gif" alt="<?php echo EMBASSY ?>" title="<?php echo EMBASSY ?>" /></a>
					</td>
	</tr>
	<tr>
		<?php
        $_GET['bid'] = 18;
        include("availupgrade.tpl");
        ?>
	</tr>
</table>
