<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       ZravianX                                                    ##
##  Version:       2011.10.31                                                  ##
##  Filename:      notification/index.php                                      ##
##  Developed by:  ZZJHONS                                                     ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     ZravianX (c) 2011 - All rights reserved                     ##
##  URLs:          http://zravianx.zzjhons.com                                 ##
##  Source code:   http://www.github.com/ZZJHONS/ZravianX                      ##
##                                                                             ##
#################################################################################

include("../GameEngine/config.php");
include("../GameEngine/Lang/".LANG.".php");
include("lang/".LANG.".php");
if(T4_COMING==true){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo SERVER_NAME; ?></title>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type"	content="text/html; charset=UTF-8" />
	<meta name="content-language" content="<?php echo LANG; ?>" />
	<link href="gpack/notification_v1_zzjhons/lang/en/lang.css" rel="stylesheet" type="text/css" />
	<link href="gpack/notification_v1_zzjhons/lang/en/compact.css?f4b7i rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="crypt.js"></script>
	<script type="text/javascript">
		Travian.Translation.add({'allgemein.cancel': 'Abbrechen','allgemein.ok': 'OK','allgemein.send': 'com'});
	</script>
</head>
<body class="webkit chrome">
	<div id="backgroundLeft"></div>
	<div id="backgroundRight"></div>
	<div id="background">
		<div id="content-container">
			<img alt="Logo" id="logoMed" src="img/x.gif" />
			<div id="header">
				<img src="img/x.gif" id="brand" alt="Travian"/> <?php echo $lang['notification']['awaits_you']; ?></div>
				<div id="text-container">
				<h1 id="first"><?php echo $lang['notification']['join_now']; ?></h1>
				<div><?php echo $lang['notification']['new_challenges']; ?></div>
			</div>
			<div id="senden-container">
				<h2><?php echo $lang['notification']['notify_me']; ?>:</h2>
					<div id="form-container">
						<form method="post" action="index.php?email=error">
							<div>
								<label for="emailInput" class="maillabel"><?php echo $lang['notification']['email']; ?>:</label>
								<input type="text" class="text"  name="registerMail" id="emailInput" maxlength="50" value="" />
								<button type="submit" value="send" name="sendRegisterMail" id="sendRegisterMail" class="orange">
									<div class="button-container">
										<div class="button-position">
											<div class="btl">
												<div class="btr">
													<div class="btc"></div>
												</div>
											</div>
											<div class="bml">
												<div class="bmr">
													<div class="bmc"></div>
												</div>
											</div>
											<div class="bbl">
												<div class="bbr">
													<div class="bbc"></div>
												</div>
											</div>
										</div>
										<div class="button-contents"><?php echo $lang['notification']['send']; ?></div>
									</div>
								</button>
								<div class="clear"></div>
								<div id="errordiv" class="error">
								<?php if(!isset($_GET['email'])) { $_GET['email'] = ""; } if ($_GET['email'] == "error") { echo $lang['notification']['error']; } ?>
								</div>
								<div id="checks">
									<input type="checkbox" class="check" name="newsletter" id="newsletter" />
									<label for="newsletter" class="newslabel"><?php echo $lang['notification']['i_agree']; ?></label>
									<div class="clear"></div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div id="facebook-container">
					<div id="fb-widget">
						<div id="fb-widget-head"></div>
						<div id="fb-widget-content">
							<iframe id="fb-container" src="http://www.facebook.com/plugins/likebox.php?href=<?php echo $lang['notification']['facebook_page']; ?>&amp;width=182&amp;colorscheme=light&amp;connections=9&amp;stream=false&amp;header=false&amp;height=260" scrolling="no" frameborder="0"></iframe>
						</div>
						<div id="fb-widget-bottom"></div>
					</div>
				</div>
				<div id="js-container">
				<h2><?php echo $lang['notification']['see_features']; ?>:</h2>
				<img id="featureLookHead" src="img/x.gif" alt="<?php echo $lang['notification']['screenshots']; ?>" />
				<div id="textContainer">
					<span id="featureTitel"><?php echo $lang['notification']['new_design']; ?></span>
					<span id="featureText"><?php echo $lang['notification']['new_graphics']; ?></span>
				</div>
				<div id="screensNav-container">
					<div class="but_div_active" id="but_div_0" onmouseover="Travian.Notification.screenNav(0);" onmouseout="Travian.Notification.contslide();"></div>
					<div class="but_div" id="but_div_1" onmouseover="Travian.Notification.screenNav(1);" onmouseout="Travian.Notification.contslide();"></div>
					<div class="but_div" id="but_div_2" onmouseover="Travian.Notification.screenNav(2);" onmouseout="Travian.Notification.contslide();"></div>
					<div class="but_div" id="but_div_3" onmouseover="Travian.Notification.screenNav(3);" onmouseout="Travian.Notification.contslide();"></div>
					<div class="but_div" id="but_div_4" onmouseover="Travian.Notification.screenNav(4);" onmouseout="Travian.Notification.contslide();"></div>
				</div>
			</div>
			<div id="devBlog-container">
				<a target="_blank" href="#" class ="devlabel"><?php echo $lang['notification']['more']; ?></a>
			</div>
			<div id="fbt-container">
				<a target="_blank" href="#" title="post a message on Twitter" id="twitter"></a>
				<a target="_blank" href="#" title="post a message on Facebook" id="facebook"></a>
			</div>
			<script type="text/javascript">
				window.addEvent('domready', function()
				{
							Travian.Notification.screenTitel = new Array();
					Travian.Notification.screenTitel[0] = "<?php echo $lang['notification']['title1']; ?>";
					Travian.Notification.screenTitel[1] = "<?php echo $lang['notification']['title2']; ?>";
					Travian.Notification.screenTitel[2] = "<?php echo $lang['notification']['title3']; ?>";
					Travian.Notification.screenTitel[3] = "<?php echo $lang['notification']['title4']; ?>";
					Travian.Notification.screenTitel[4] = "<?php echo $lang['notification']['title5']; ?>";

							Travian.Notification.screenText = new Array();
					Travian.Notification.screenText[0] = "<?php echo $lang['notification']['desc1']; ?>";
					Travian.Notification.screenText[1] = "<?php echo $lang['notification']['desc2']; ?>";
					Travian.Notification.screenText[2] = "<?php echo $lang['notification']['desc3']; ?>";
					Travian.Notification.screenText[3] = "<?php echo $lang['notification']['desc4']; ?>";
					Travian.Notification.screenText[4] = "<?php echo $lang['notification']['desc5']; ?>";

					Travian.Notification.screenInit();
				});
			</script>
		</div>
		<div id="footer-container">
			<div id="footer">
				<a href="../index.php#agb" target="_blank"><?php echo AGB; ?></a> |
				<a href="../index.php#spielregeln" target="_blank"><?php echo SPIELREGELN; ?></a> |
				<a href="../index.php#impressum" target="_blank"><?php echo SPIELREGELN; ?></a>
				<br />
				© 2012 Travian
			</div>
		</div>
	</div>
</body>
</html>
<?php
}else{
header("Location: ../index.php");
exit;
}
?>