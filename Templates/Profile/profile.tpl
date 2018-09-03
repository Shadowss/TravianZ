<h1>Player profile</h1>

<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       01.09.2013 						       	 				   ##
##  Filename       profile.php                                                 ##
##  Developed by:  Dzoki                                                       ##
##  Fixed by:      Shadow / Skype : cata7007                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ-by-Shadow/	       	   ##
##                                                                             ##
#################################################################################


$varmedal = $database->getProfileMedal($session->uid);

include("menu.tpl"); ?>
<form action="spieler.php" method="POST">
    <input type="hidden" name="ft" value="p1" />
    <input type="hidden" name="id" value="<?php echo (isset($id) ? $id : ''); ?>" />

    <table cellpadding="1" cellspacing="1" id="edit" ><thead>
    <tr>
        <th colspan="3">Player <?php echo $session->username; ?> </th>
    </tr>
    <tr>
        <td colspan="2">Details</td>

        <td>Description</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="2" class="empty"></td><td class="empty"></td></tr>
    <tr>
    <?php
    if($session->userinfo['birthday'] != 0) {
   $bday = explode("-",$session->userinfo['birthday']);
   }
   else {
   $bday = array('','','');
   }
   ?>
    <th>Birthday</th><td class="birth"><input tabindex="1" class="text day" type="text" name="tag" value="<?php echo $bday[2]; ?>" maxlength="2" /> <select tabindex="2" name="monat" size="" class="dropdown">

                <option value="0"></option><option value="1" <?php if($bday[1] == 1) { echo "selected"; } ?>>Jan</option><option value="2"<?php if($bday[1] == 2) { echo "selected"; } ?>>Feb</option><option value="3"<?php if($bday[1] == 3) { echo "selected"; } ?>>Mar</option><option value="4"<?php if($bday[1] == 4) { echo "selected"; } ?>>Apr</option><option value="5"<?php if($bday[1] == 5) { echo "selected"; } ?>>May</option><option value="6"<?php if($bday[1] == 6) { echo "selected"; } ?>>June</option><option value="7"<?php if($bday[1] == 7) { echo "selected"; } ?>>July</option><option value="8"<?php if($bday[1] == 8) { echo "selected"; } ?>>Aug</option><option value="9"<?php if($bday[1] == 9) { echo "selected"; } ?>>Sep</option><option value="10"<?php if($bday[1] == 10) { echo "selected"; } ?>>Oct</option><option value="11"<?php if($bday[1] == 11) { echo "selected"; } ?>>Nov</option><option value="12"<?php if($bday[1] == 12) { echo "selected"; } ?>>Dec</option></select> <input tabindex="3" type="text" name="jahr" value="<?php echo $bday[0]; ?>" maxlength="4" class="text year"></td>
    <?php
	$varray = $database->getProfileVillages($session->uid);
	$rowspan = 7+count($varray);
	?>
    <td rowspan="<?php echo $rowspan; ?>" class="desc1"><textarea tabindex="7" name="be1"><?php echo $session->userinfo['desc2']; ?></textarea></td></tr>

    <tr><th>Gender</th>
    <td class="gend">
        <label><input class="radio" type="radio" name="mw" value="0" <?php if($session->userinfo['gender'] == 0) { echo "checked"; } ?> tabindex="4">n/a</label>
        <label><input class="radio" type="radio" name="mw" value="1" <?php if($session->userinfo['gender'] == 1) { echo "checked"; } ?> >m</label>
        <label><input class="radio" type="radio" name="mw" value="2" <?php if($session->userinfo['gender'] == 2) { echo "checked"; } ?> >f</label>
    </td></tr>

    <tr><th>Location</th><td><input tabindex="5" type="text" name="ort" value="<?php echo $session->userinfo['location']; ?>" maxlength="30" class="text"></td></tr>


    <tr><td colspan="2" class="empty"></td></tr>
    <?php
    for($i=0;$i<=count($varray)-1;$i++) {
    echo "<tr><th>Village name</th><td><input tabindex=\"6\" type=\"text\" name=\"dname$i\" value=\"".$varray[$i]['name']."\" maxlength=\"30\" class=\"text\"></td></tr>";
    }
    ?>
    <tr><td colspan="2" class="desc2"><textarea tabindex="8" name="be2"><?php echo $session->userinfo['desc1']; ?></textarea></td></tr>
    </table>


	<p>
		<table cellspacing="1" cellpadding="2" class="tbg">
		<tr><td class="rbg" colspan="4">Medals</td></tr>
		<tr>
			<td>Category</td>
			<td>Rank</td>
			<td>Week</td>
			<td>BB-Code</td>
		</tr>
				<?php
/******************************
MEDAL CATEGORY:
===============================
== 1. Attackers top 10       ==
== 2. Defender top 10         ==
== 3. Climbers top 10        ==
== 4. Robbers top 10     ==
== 5. In att and def simultaneously ==
== 6. in top 3 - Attacker      ==
== 7. in top 3 - Defender ==
== 8. in top 3 - Climbers    ==
== 9. in top 3 - Robbers     ==
******************************/


	foreach($varmedal as $medal) {
	$titel="Bonus";
	switch ($medal['categorie']) {
    case "1":
        $titel="Attacker of the Week";
        break;
    case "2":
        $titel="Defender of the Week";
        break;
    case "3":
        $titel="Pop Climber of the week";
        break;
    case "4":
        $titel="Robber of the week";
        break;
    case "5":
        $titel="Top 10 of both Attackers and Defenders";
        break;
    case "6":
        $titel="Top 3 of Attackers of week ".$medal['points']." in a row";
        break;
    case "7":
        $titel="Top 3 of Defenders of week ".$medal['points']." in a row";
        break;
    case "8":
        $titel="Top 3 of Pop climbers of week ".$medal['points']." in a row";
        break;
    case "9":
        $titel="Top 3 of Robbers of week ".$medal['points']." in a row";
        break;
    case "10":
        $titel="Rank Climber of the week";
        break;
    case "11":
        $titel="Top 3 of Rank climbers of week ".$medal['points']." in a row";
        break;
    case "12":
        $titel="Top 10 of Attackers of week ".$medal['points']." in a row";
        break;
	case "13":
        $titel="Top 10 of Defenders of week ".$medal['points']." in a row";
        break;
	case "14":
        $titel="Top 10 of Pop climbers of week ".$medal['points']." in a row";
        break;
	case "15":
        $titel="Top 10 of Robbers of week ".$medal['points']." in a row";
        break;
	case "16":
        $titel="Top 10 of Rank climbers of week ".$medal['points']." in a row";
        break;
	}
				 echo"<tr>
				   <td> ".$titel."</td>
				   <td>".$medal['plaats']."</td>
				   <td>".$medal['week']."</td>
				   <td>[#".$medal['id']."]</td>
			 	 </tr>";
				 } ?>
				 <tr>
				   <td>Beginners Protection</td>
				   <td></td>
				   <td></td>
				   <td>[#0]</td>
			 	 </tr>
				 <?php
				 if(NEW_FUNCTIONS_MEDAL_3YEAR){
					 echo "<tr>
						<td>veteran</td>
						<td></td>
						<td></td>
						<td>[#g2300]</td>
					 </tr>";
				 }
				 
				 if(NEW_FUNCTIONS_MEDAL_5YEAR){
					 echo "<tr>
						<td>veteran_5a</td>
						<td></td>
						<td></td>
						<td>[#g2301]</td>
					 </tr>";
				 }
				 
				 if(NEW_FUNCTIONS_MEDAL_10YEAR){
					 echo "<tr>
						<td>veteran_10a</td>
						<td></td>
						<td></td>
						<td>[#g2302]</td>
					 </tr>";
				 }
				 
				// Added by Shadow - cata7007@gmail.com / Skype : cata7007
				if(NEW_FUNCTIONS_TRIBE_IMAGES){
					if($session->userinfo['tribe'] == 1){
						echo"<tr><td>Tribe Romans</td><td></td><td></td><td>[#roman]</td></tr>";
					}elseif($session->userinfo['tribe'] == 2){
						echo"<tr><td>Tribe Teutons</td><td></td><td></td><td>[#teuton]</td></tr>";
					}elseif($session->userinfo['tribe'] == 3){
						echo"<tr><td>Tribe Gauls</td><td></td><td></td><td>[#gaul]</td></tr>";
					}
				}
				if(NEW_FUNCTIONS_MHS_IMAGES){
					if($session->userinfo['access'] == 9){
						echo"<tr><td>Administrator</td><td></td><td></td><td>[#MULTIHUNTER]</td></tr>";
						echo"<tr><td>Administrator</td><td></td><td></td><td>[#MH]</td></tr>";
						echo"<tr><td>Administrator</td><td></td><td></td><td>[#TEAM]</td></tr>";
					}elseif($session->userinfo['access'] == 8){
						echo"<tr><td>Multihunter</td><td></td><td></td><td>[#MULTIHUNTER]</td></tr>";
						echo"<tr><td>Multihunter</td><td></td><td></td><td>[#MH]</td></tr>";
						echo"<tr><td>Multihunter</td><td></td><td></td><td>[#TEAM]</td></tr>";
					}
				}
				if($session->userinfo['username'] == "Shadow"){
					echo"<tr><td>Shadow</td><td></td><td></td><td>[#SHADOW]</td></tr>";
					echo"<tr><td>Shadow</td><td></td><td></td><td>[#MH]</td></tr>";
					echo"<tr><td>Shadow</td><td></td><td></td><td>[#TEAM]</td></tr>";
					echo"<tr><td>Shadow</td><td></td><td></td><td>[#EVENT]</td></tr>";
				}?>
				 </table></p>


	<p class="btn"><input type="image" value="" tabindex="9" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></p>
    </form>
