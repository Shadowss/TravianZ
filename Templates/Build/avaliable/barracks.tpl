<h2><?php echo BARRACKS ?></h2>

<table class="new_building" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="desc"><?php echo BARRACKS_DESC ?></td>
		<td rowspan="3" class="bimg">
        <a href="#" onClick="return Popup(19,4);">
				<img class="building g19" src="img/x.gif" alt="<?php echo BARRACKS ?>" title="<?php echo BARRACKS ?>" /></a>
					</td>
	</tr>
	<tr>
		<?php
        $_GET['bid'] = 19;
        include("availupgrade.tpl");
        ?>
	</tr>
</table>
