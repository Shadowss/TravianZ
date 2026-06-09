<div id="content"  class="activate">
<h1><img src="img/x.gif" class="anmelden" alt="<?php echo TZ_REGISTER_FOR_THE_GAME; ?>"></h1>

		
		<h6><?php echo TZ_NO_EMAIL_RECEIVED; ?></h6>
		<?php echo TZ_IN_ORDER_TO_PLAY_TRAVIAN_YOU_NEED; ?>
<p class="f10 e b"><?php echo TZ_FOLLOWING_CAUSES_ARE_POSSIBLE; ?></p>
<div class="f10">
<ul>
<li><?php echo TZ_TYPOS_IN_THE_EMAIL_ADDRESS; ?></li>
<li><?php echo TZ_THE_EMAIL_ACCOUNT_S_STORAGE_LIMIT; ?></li>
<li><?php echo TZ_WRONG_DOMAIN_THERE_IS_E_G_NO_AOL_D; ?></li>
<li><?php echo TZ_THE_EMAIL_HAS_BEEN_MOVED_TO_THE_SP; ?></li>
</ul>
<br /><br /><?php echo TZ_YOU_CAN_UNDO_THE_REGISTRATION_AND; ?> <u><?php echo TZ_DIFFERENT_EMAIL_ADDRESS; ?></u><?php echo TZ_ML_ACTIVATION_RESENT; ?></div>				
		<form action="activate.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
		<input type="hidden" name="ft" value="a3" />
		<table cellpadding="1" cellspacing="1">
			<tr class="top">
				<th><?php echo NICKNAME; ?></th>
				<td class="name"><?php 	$naam=$database->getActivateField($_GET['id'],"username",0); echo $naam; ?></td>
			</tr>
			<tr class="btm">
				<th><?php echo PASSWORD; ?></th>
				<td><input class="text" type="password" name="pw" maxlength="20" /></td>
			</tr>
		</table>
		<p class="btn">
			<button class="trav_buttons" id="btn_delete" alt="<?php echo DELETE; ?>" value="delete" name="delreports" /> <?php echo DELETE; ?> </button>
		</p>
		</form>
        </div>
