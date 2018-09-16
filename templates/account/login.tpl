<div id="content" class="login">
	<h1>
		<img class="img_login" src="assets/img/x.gif" alt="log in the game" />
	</h1>

	{if $smarty.const.COMMENCE > $smarty.now}

	<p>
		<font color="red" size="6">{$smarty.const.NOT_OPENED_YET}</font>
	</p>

	{else}

	<h5>
		<img class="img_u04" src="assets/img/x.gif" alt="login" />
	</h5>
	<p>{$smarty.const.COOKIES}</p>

	{if !$isServerStarted} <br />
	<div style="text-align: center; font-size: 25px">{$smarty.const.SERVER_NAME}
		will start in:</div>
	<div class="timer" id="activation_time">{$serverStartsIn}</div>

	{else}

	<form method="post" action="login.php">
	{literal}
	<script>
	Element.implement({
	 //imgid: if an arrow belongs to the link this can be "opened"
	 showOrHide: function(imgid) {
		 //insert
		 if (this.getStyle('display') == 'none')
		 {
			 if (imgid != '')
			 {
				 $(imgid).className = 'open';
			 }
		 }
		 //hide
		 else
		 {
			 if (imgid != '')
			 {
				 $(imgid).className = 'close';
			 }
		 }
		 this.toggleClass('hide');
	}
	});
	</script>
	{/literal}
		<table id="login_form">
			<tbody>
				<tr class="top">
					<th>{$smarty.const.NAME}</th>
					<td><input class="text" type="text" name="Username"
						value="{if isset($Username)}{$Username}{else}{$UsernameCookie}{/if}"
						maxlength="30" /> <span class="error">{$UsernameError}</span></td>
				</tr>
				<tr class="btm">
					<th>{$smarty.const.PASSWORD}</th>
					<td><input class="text" type="password" name="Password"
						value="{$Password}" maxlength="100" /> <span class="error">{$PasswordError}</span>
					</td>
				</tr>
			</tbody>
		</table>

		<p class="btn">
			<button value="login" name="action" onclick="xy();" id="btn_login"
				class="trav_buttons">Login</button>
		</p>
	</form>

	{/if}
		{/if}

	{if !empty($Password) and !empty($Username) and !empty($PasswordError)}
	<p class="error_box">
		<span class="error">{$smarty.const.PW_FORGOTTEN}</span><br>{$smarty.const.PW_REQUEST}<br>
		<a href="password.php">{$smarty.const.PW_GENERATE}</a>
	</p>
	{elseif !empty($EmailError)}
	<p class="error_box">
		<span class="error">{$EmailError}</span><br>{$smarty.const.EMAIL_FOLLOW}<br>
		<a href="activate.php?usr={$Username}">{$smarty.const.VERIFY_EMAIL}</a>
	</p>
	{elseif !empty($VacationError)}
	<p class="error_box">
		<span class="error">{$VacationError}</span>
	</p>
	{/if}

</div>