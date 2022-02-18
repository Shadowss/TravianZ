<h2><?php echo RESIDENCE ?></h2>
	<table class="new_building" cellpadding="1" cellspacing="1">
		<tbody><tr>
			<td class="desc"><?php echo RESIDENCE_DESC ?></td>
			<td rowspan="3" class="bimg">
				<a href="#" onClick="return Popup(25,4);">
				<img class="building g25" src="img/x.gif" alt="<?php echo RESIDENCE ?>" title="<?php echo RESIDENCE ?>" /></a>
			</td>
		</tr>
		<tr>
		 <?php
        $_GET['bid'] = 25;
        include("availupgrade.tpl");
        ?>
		</tr></tbody>
	</table>
