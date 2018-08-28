<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ##
##  Filename       multihunter.tpl                                             ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix   ##
##  Fixed by:      Shadow - STARVATION , HERO FIXED COMPL.  		       ##
##  Fixed by:      InCube - double troops				       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ##
##                                                                             ##
#################################################################################

if(isset($_GET['err']) && $_GET['err'] == 1) {
	echo "<br /><hr /><br /><div class=\"headline\"><span class=\"f10 c5\">At least Multihunter &amp; Support password are required in this form.</span></div><br /><br />";
}

if(isset($_GET['err']) && $_GET['err'] == 2) {
    echo "<br /><hr /><br /><div class=\"headline\"><span class=\"f10 c5\">Natars is a reserved username for an in-game NPC tribe. Please choose a different admin username.</span></div><br /><br />";
}

?>

<form action="include/accounts.php" method="post" id="dataform">

<p>
	<span class="f10 c">Multihunter account</span>
		<table>
			<tr><td>Name:</td><td><input type="text" name="mhuser" id="mhuser" value="Multihunter" disabled="disabled"></td></tr>
			<tr><td>Password:</td><td><input type="password" name="mhpw" id="mhpw" value=""></td></tr>
			<tr><td>Note: Rember this password! You need it for the Admin</td><td></td></tr>
		</table>
</p>

<p>
	<span class="f10 c">Support account</span>
		<table>
			<tr><td>Name:</td><td><input type="text" name="suser" id="suser" value="Support" disabled="disabled"></td></tr>
			<tr><td>Password:</td><td><input type="password" name="spw" id="spw" value=""></td></tr>
			<tr><td>Note: Rember this password! You need it for the Admin</td><td></td></tr>
		</table>
</p>

	<p>
        <span class="f10 c">Admin account</span>
    <table>
        <tr>
            <td><span class="f9 c6">Admin name:</span></td>
            <td><input type="text" name="aname" id="aname" value=""></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Admin email:</span></td>
            <td><input type="text" name="aemail" id="aemail" value=""></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Admin password:</span></td>
            <td><input type="password" name="apass" id="apass" value=""></td>
        </tr>
        <tr>
            <td><span class="f9 c6">Admin tribe:</span></td>
            <td>
				<select name="atribe" id="atribe">
					<option value="1" selected="selected">Romans</option>
					<option value="2">Teutons</option>
					<option value="3">Gauls</option>
				</select>
			</td>
        </tr>
		<tr>
        <td><span class="f9 c6">Show admin in stats:</span></td>
        <td>
            <select name="admin_rank">
                <option value="true">true</option>
                <option value="false" selected="selected">false</option>
            </select>
        </td>
        </tr>
		<tr>
        <td><span class="f9 c6">Include Support Messages in Admin Mailbox:</span></td>
        <td>
            <select name="admin_support_msgs">
                <option value="true" selected="selected">true</option>
                <option value="false">false</option>
            </select>
        </td>
        </tr>
        <tr>
        <td><span class="f9 c6">Allow Administrative Accounts to be Raided and Attacked:</span></td>
        <td>
            <select name="admin_raidable">
                <option value="true" selected="selected">true</option>
                <option value="false">false</option>
            </select>
        </td>
        </tr>
        <tr><td colspan="2">Note: this will add a first user and will set them up as an Admin</td><td></td></tr>
        <tr><td colspan="2">Note: you can leave this section empty, if you want</td><td></td></tr>
    </table>
    </p>

	<center>
	<input type="submit" name="Submit" id="Submit" value="Submit"></center>
</form>

</div>
