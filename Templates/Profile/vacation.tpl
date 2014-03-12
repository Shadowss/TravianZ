<h1>Player profile</h1>

<?php 

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       01.09.2013 						       	 				   ##
##  Filename       vacation.php                                                ##
##  Developed by:  Advocaite                                                   ##
##  Fixed by:      Shadow / Skype : cata7007                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ-by-Shadow/	       	   ##
##                                                                             ##
#################################################################################

include("menu.tpl"); ?>
<form action="spieler.php" method="POST">
<input type="hidden" name="ft" value="p4">
<input type="hidden" name="uid" value="<?php echo $session->uid; ?>" />

    <table cellpadding="1" cellspacing="1" id="del_acc" class="account"><thead>
<tr>
    <th colspan="2">Vacation Mode</th>
</tr>
</thead><tbody>
<tr>
	<td class="note" colspan="2">If you plan on being away for an extended period of time and do not wish to set a sitter, you can set your account to Holiday Mode. During this time your account will stop produceing resource , CP , research , trops , etc , and stop receiving attacks , reinforcements, raid , essentially freezing your account. Remember, this just freezes your Travian, not time. If you are a member of Gold Club it will run out during this time and if you have automatic renewal selected, the automatic renewal feature will be cancelled while in Holiday Mode.Please Note you must set min of 2 days vaction mode and NO MORE THEN 14 days.</td>
</tr><tr>

<th>Want to activate Vacation Mode?</th>
        <td class="del_selection">
            <label><input class="radio" type="radio" name="vac" value="1" /> Yes</label>
            <label><input class="text" type="text" name="vac_days" value="2" /></label>
        </td>
    </tr>
  
     </tbody></table>
    <?php
// Added by Shadow - cata7007@gmail.com / Skype : cata7007
if($form->getError("vac") != "") {
echo "<span class=\"error\">".$form->getError("vac")."</span>";
}
?>
    <p class="btn"><input type="image" value="" name="s1" id="btn_save" class="dynamic_img" src="img/x.gif" alt="save" /></p>
</form>
