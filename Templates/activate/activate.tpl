<div id="content"  class="signup">

<?php
if(isset($_GET['id']) && isset($_GET['q'])) {
$act2=$database->getActivateField($_GET['id'],"act2",0);
	if($act2==$_GET['q']){
	$show='1';
	$naam=$database->getActivateField($_GET['id'],"username",0);
	$email=$database->getActivateField($_GET['id'],"email",0);

	}
}

if(isset($show)){
?>
<h1><img src="img/x.gif" class="anmelden" alt="register for the game"></h1>
		<h5><img src="img/x.gif" class="img_u05" alt="registration"/></h5>
			<p>
				Hello <?php echo $naam; ?>,
				<br/>
				<br/>
				The registration was successful. In the next few minutes you will receive an email with the access information.
<br /><br />
The email will be sent to following address: <span class="important"><?php echo $email; ?></span>
			</p>
			<p>In order to activate your account enter the code or click on the link in your email.</p>
			<div id="activation">
				<form action="activate.php" method="post">
					<p class="important">
						Activation code:
					</p>
					<input class="text" type="text" name="id" maxlength="10" />
					<p>
						<input type="image" value="ok" name="s1" src="img/x.gif" id="btn_send" class="dynamic_img" alt="send"/>
                        <input type="hidden" name="ft" value="a2" />
					</p>
				</form>
                </div>
                <div id="no_mail">
				<p>
					<a href="activate.php?id=<?php echo $_GET['id']; ?>&amp;c=<?php echo $generator->encodeStr($email,5); ?>"><span class="important">No email received?</span></a>
				</p>
				<p>
					Sometimes the email is moved to the spam folder. For further help click <a href="activate.php?id=<?php echo $_GET['id']; ?>&amp;c=<?php echo $generator->encodeStr($email,5); ?>">here</a>
				</p>
			</div>
            </div>
<?php } else {
?>
			<p>
				
			<div id="activation">
				<form action="activate.php" method="post">
					<p class="important">
						Activation code:
					</p>
					<input class="text" type="text" name="id" maxlength="10" />
					<p>
						<input type="image" value="ok" name="s1" src="img/x.gif" id="btn_send" class="dynamic_img" alt="send"/>
                        <input type="hidden" name="ft" value="a2" />
					</p>
				</form>
                </div>
            </div>
			
<?php }
?>