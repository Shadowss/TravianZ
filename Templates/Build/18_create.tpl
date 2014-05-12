<?php if($session->access!=BANNED){ ?>
<table cellpadding="1" cellspacing="1" id="found">
	<form method="post" action="build.php">
	<input type="hidden" name="id" value="<?php echo $id ?>">
	<input type="hidden" name="ft" value="ali1">
	<thead><tr>
		<th colspan="2"><?php echo FOUND_ALLIANCE; ?></th>
	</tr></thead>
	<tbody><tr>
		<th><?php echo TAG; ?></th>
		<td class="tag">
			<input class="text" name="ally1" value="<?php echo $form->getValue("ally1"); ?>" maxlength="15">
			<span class="error"><?php echo $form->getError("ally1"); ?></span>

		</td>
	</tr>
	<tr>
		<th><?php echo NAME; ?></th>
		<td class="nam">
			<input class="text" name="ally2" value="<?php echo $form->getValue("ally2"); ?>" maxlength="50">
			<span class="error"><?php echo $form->getError("ally2"); ?></span>
		</td>

	</tr></tbody>
	</table>
	
	<p><input type="image" value="ok" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></form></p><table cellpadding="1" cellspacing="1" id="join">
	
	<?php }else{ ?>
	<table cellpadding="1" cellspacing="1" id="found">
	<form method="post" action="build.php">
	<input type="hidden" name="id" value="<?php echo $id ?>">
	<input type="hidden" name="ft" value="ali1">
	<thead><tr>
		<th colspan="2"><?php echo FOUND_ALLIANCE; ?></th>
	</tr></thead>
	<tbody><tr>
		<th><?php echo TAG; ?></th>
		<td class="tag">
			<input class="text" name="ally1" disabled="disabled" value="<?php echo $form->getValue("ally1"); ?>" maxlength="8">
			<span class="error"><?php echo $form->getError("ally1"); ?></span>

		</td>
	</tr>
	<tr>
		<th><?php echo NAME; ?></th>
		<td class="nam">
			<input class="text" name="ally2" disabled="disabled" value="<?php echo $form->getValue("ally2"); ?>" maxlength="25">
			<span class="error"><?php echo $form->getError("ally2"); ?></span>
		</td>

	</tr></tbody>
	</table>
	<?php
	echo "".NO_CREATE_ALLIANCE."";
	?></br><?php
	}
	?>
	