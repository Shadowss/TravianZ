<div id="content"  class="activate">
<h1><img src="img/x.gif" class="anmelden" alt="register for the game"></h1>

		
		<h6>No email received?</h6>
		In order to play Travian you need a valid email address to which the activation code can be send. There are exceptional cases when this email might not arrive.
<p class="f10 e b">Following causes are possible:</p>
<div class="f10">
<ul>
<li>Typos in the email address</li>
<li>The email account`s storage limit is reached</li>
<li>Wrong domain: There is e.g. no @aol.de, only @aol.com</li>
<li>The email has been moved to the spam/junk folder</li>
</ul>
<br /><br />You can undo the registration and re-register with a <u>different email address</u>. 
Then the activation code will be send again</div>				
		<form action="activate.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
		<input type="hidden" name="ft" value="a3" />
		<table cellpadding="1" cellspacing="1">
			<tr class="top">
				<th>Nickname</th>
				<td class="name"><?php 	$naam=$database->getActivateField($_GET['id'],"username",0); echo $naam; ?></td>
			</tr>
			<tr class="btm">
				<th>Password</th>
				<td><input class="text" type="password" name="pw" maxlength="20" /></td>
			</tr>
		</table>
		<p class="btn">
			<button class="trav_buttons" id="btn_delete" alt="delete" value="delete" name="delreports" /> Delete </button>
		</p>
		</form>
        </div>
