
	<h2><?php echo GRANARY ?></h2>

<table class="new_building" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="desc"><?php echo GRANARY_DESC ?></td>
		<td rowspan="3" class="bimg">
							<a href="#" onClick="return Popup(11,4);">
				<img class="building g11" src="img/x.gif" alt="<?php echo GRANARY ?>" title="<?php echo GRANARY ?>" /></a>
					</td>
	</tr>
	<tr>
		<?php
        $_GET['bid'] = 11;
        include("availupgrade.tpl");
        ?>
	</tr>
</table>
