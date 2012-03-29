	<h2>Rally point</h2>

<table class="new_building" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="desc">Your village's troops meet here. From here you can send them out to conquer, raid or reinforce other villages.</td>
		<td rowspan="3" class="bimg">
							<a href="#" onClick="return Popup(16,4);">
				<img class="g16" src="img/x.gif" alt="Rally point" title="Rally point" /></a>
					</td>
	</tr>
	<tr>
		<?php
        $_GET['bid'] = 16;
        include("availupgrade.tpl");
        ?>
	</tr>
</table>