<div id="content"  class="activate">

<h1><img src="assets/img/x.gif" class="passwort" alt="{$smarty.const.NEW_PASSWORD}" /></h1>
<h5><img src="assets/img/x.gif" class="img_u22" alt="{$smarty.const.FORGOTTEN_PASSWORD}" /></h5>
    {if $password == 'sent'}
        <p>{$smarty.const.PASSWORD_SENT}</p>
    {elseif $password == 'error'}
    	<p>
			{$smarty.const.NEW_PASSWORD_ERROR}
		</p>
    {elseif $password == 'success'}
    	<p>
			{$smarty.const.PASSWORD_SET_SUCCESS}
		</p>
    {else}
		<p>{$smarty.const.NEW_PASSWORD_DESC}</p>
		<form action="password.php" method="post">
			<p>
				<b>{$smarty.const.EMAIL}</b><br />
				<input class="text" type="text" name="Email" value="{$Email}" maxlength="30" />
				<span class="error">{$EmailError}</span>
			</p>
			<p>
				<button value="generateNewPassword" name="action" class="trav_buttons" id="btn_ok"> OK </button>
			</p>
		</form>
	{/if}
</div>