<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       anmelden.php                                                 ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
	include("GameEngine/config.php");
	include("GameEngine/Database.php");
	include("GameEngine/Lang/".LANG.".php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
	<title><?php echo SERVER_NAME; ?></title>
		<link REL="shortcut icon" HREF="favicon.ico"/>
	<meta name="content-language" content="en" />
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-core.js?0faaa" type="text/javascript"></script>
	<script src="mt-more.js?0faaa" type="text/javascript"></script>
	<script src="unx.js?0faaa" type="text/javascript"></script>
	<script src="new.js?0faaa" type="text/javascript"></script>
	<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7c" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7c" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE ?>travian.css?f4b7c" rel="stylesheet" type="text/css" />
		<link href="<?php echo GP_LOCATE ?>lang/en/lang.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
function chkFormular () {
  if (document.Formular.Username.value == "") {
    alert("Enter your username!");
    document.Formular.Username.focus();
    return false;
  }  
  if (document.Formular.Emailadress.value == "") {
    alert("Enter an emailadress!");
    document.Formular.Emailadress.focus();
    return false;
  }
  if (document.Formular.Emailadress.value.indexOf("@") == -1) {
    alert("Thats not a valid emailadress!");
    document.Formular.Emailadress.focus();
    return false;
  }
  if (document.Formular.Subject.value == "please select") {
    alert("Please select an subject!");
    document.Formular.Subject.focus();
    return false;
  }
  if (document.Formular.Message.value == "") {
    alert("Please enter a message!");
    document.Formular.Message.focus();
    return false;
  }
 
}
</script>
	   </head>

<body class="v35 ie ie7" onload="initCounter()">

<div class="wrapper">
<div id="dynamic_header">
</div>
<?php include("Templates/header.tpl"); ?>
<div id="mid">
<?php include("Templates/menu.tpl"); ?>
<div id="content" class="village1">
<h1>Support</h1>
<p>You can use the following form to submit your request to the Support.<br />Please take a bit of time to answer the form questions in as much detail as possible, so that we can answer your request quickly and in length. <br />Please note that without a valid email address, your request will not get processed.
<br><br><b>Bug reports, login errors, general questions and feedback</b></p>

<form name="Formular" class=""  method="post" action="mailme.php" onsubmit="return chkFormular()">
		
		<div id="group_support_username">
        <table class="form_table form_tablel_support" width="100%">
        <tr>
        <td class="form_table_label form_table_label_support_username"><label class="form_label" for="element_2">Username </label></td>
		<td class="form_table_element form_table_element_support_username"><input id="element_2_1" name= "Username" class="text" type="text"  maxlength="255" value=""/></td>
        </tr>
        </table>
        </div>
		<div id="group_support_email">
        <table class="form_table form_tablel_support" width="100%">
        <tr>
        <td class="form_table_label form_table_label_support_supportType"><label class="form_label" for="element_3">Email </label></td>
		<td class="form_table_element form_table_element_support_email"><input id="element_3" name="Emailadress" class="text" type="text" maxlength="255" value=""/></td>
        </tr>
        </table>
		</div>
		<div id="group_support_supportType">
		<table class="form_table form_tablel_support" width="100%">
        <tr>
        <td class="form_table_label form_table_label_support_supportType"><label class="form_label" for="element_7">Category </label></td>
		<td class="form_table_element form_table_element_support_supportType"><select id="element_7" name="Subject"> 
			<option value="please select" selected="selected">please select...</option>
			<option value="Bugreport" >Bugreport</option>
			<option value="General question" >General question</option>
			<option value="I cannot login" >I cannot login</option>
			<option value="I cannot register an account" >I cannot register an account</option>
            <option value="Feedback" >Feedback</option>
        </select></td>
        </tr>
        </table>
		</div>
		<div id="group_support_message">
		<table class="form_table form_tablel_support" width="100%">
        <tr>
        <td class="form_table_label form_table_label_support_message"><label class="form_label" for="element_6">Message </label></td>
		<td class="form_table_element form_table_element_support_message"><textarea id="element_6" name="Message" cols="43" rows="7" label="Message"></textarea></td>
        </tr>
        </table>
		</div>
        <br />
        <div id="group_support_message">
        <table class="form_table form_tablel_support" width="100%">
        <tr>
		<td><input type="hidden" name="" value="" /><input id="saveForm" class="button_text" type="submit" name="" value="Send form" /></td>
        <td><input type="hidden" name="" value="" /><input id="saveForm" class="button_text" type="reset" name="" value="Clear form" /></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
        </table>
        </div>		
		</form>	
 
</div>
<div id="side_info" class="outgame">
<?php
if(NEWSBOX1) { include("Templates/News/newsbox1.tpl"); }
if(NEWSBOX2) { include("Templates/News/newsbox2.tpl"); }
if(NEWSBOX3) { include("Templates/News/newsbox3.tpl"); }
?>
			</div>

<div class="clear"></div>
			</div>

			<div class="footer-stopper outgame"></div>
			<div class="clear"></div>

<?php include("Templates/footer.tpl"); ?>
<div id="ce"></div>
</body>
</html>