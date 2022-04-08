
<h2><?php echo GREATGRANARY ?></h2>

<table class="new_building" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="desc"><?php echo GREATGRANARY_DESC ?></td>
		<td rowspan="3" class="bimg">
							<a href="#" onClick="return Popup(39,4);">
				<img class="building g39" src="img/x.gif" alt="Great Granary" title="Great Granary" /></a>
					</td>
	</tr>
	<tr>
		<?php
        $_GET['bid'] = 39;
        include("availupgrade.tpl");
        ?>
	</tr>
</table>