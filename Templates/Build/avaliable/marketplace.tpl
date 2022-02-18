 <h2><?php echo MARKETPLACE ?></h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc"><?php echo MARKETPLACE_DESC ?></td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(17,4);">
				<img class="building g17" src="img/x.gif" alt="<?php echo MARKETPLACE ?>" title="<?php echo MARKETPLACE ?>" /></a>
			</td>
		</tr>
		<tr>
		<?php
        $_GET['bid'] = 17;
        include("availupgrade.tpl");
        ?>
	</tr>
</table>
