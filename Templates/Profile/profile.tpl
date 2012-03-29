<h1>Player profile</h1>

<?php 
$varmedal = $database->getProfileMedal($session->uid);

include("menu.tpl"); ?>
<form action="spieler.php" method="POST">
    <input type="hidden" name="ft" value="p1" />
    <input type="hidden" name="uid" value="<?php echo $session->uid; ?>" />
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    
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

    <td rowspan="7" class="desc1"><textarea tabindex="7" name="be1"><?php echo $session->userinfo['desc2']; ?></textarea></td></tr>

    <tr><th>Gender</th>
    <td class="gend">
        <label><input class="radio" type="radio" name="mw" value="0" <?php if($session->userinfo['gender'] == 0) { echo "checked"; } ?> tabindex="4">n/a</label>
        <label><input class="radio" type="radio" name="mw" value="1" <?php if($session->userinfo['gender'] == 1) { echo "checked"; } ?> >m</label>
        <label><input class="radio" type="radio" name="mw" value="2" <?php if($session->userinfo['gender'] == 2) { echo "checked"; } ?> >f</label>
    </td></tr>
    
    <tr><th>Location</th><td><input tabindex="5" type="text" name="ort" value="<?php echo $session->userinfo['location']; ?>" maxlength="30" class="text"></td></tr>

    
    <tr><td colspan="2" class="empty"></td></tr>
    <?php
	$varray = $database->getProfileVillages($session->uid);
    for($i=0;$i<=count($varray)-1;$i++) {
    echo "<tr><th>Village name</th><td><input tabindex=\"6\" type=\"text\" name=\"dname$i\" value=\"".$varray[$i]['name']."\" maxlength=\"20\" class=\"text\"></td></tr>";
    }
    ?>
    <tr><td colspan="2" class="desc2"><textarea tabindex="8" name="be2"><?php echo $session->userinfo['desc1']; ?></textarea></td></tr>
    </table>

	
	<p>
		<table cellspacing="1" cellpadding="2" class="tbg">
		<tr><td class="rbg" colspan="4">Medals</td></tr>
		<tr>
			<td>Category</td>
			<td>Rang</td>
			<td>Week</td>
			<td>BB-Code</td>
		</tr>
				<?php
/******************************
INDELING CATEGORIEEN:
===============================
== 1. Aanvallers top 10      ==
== 2. Defence top 10         ==
== 3. Klimmers top 10        ==
== 4. Overvallers top 10     ==
== 5. In att en def tegelijk ==
== 6. in top 3 - aanval      ==
== 7. in top 3 - verdediging ==
== 8. in top 3 - klimmers    ==
== 9. in top 3 - overval     ==
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
        $titel="Top 10 of both attacckers and defenders";
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
        $titel="Top 10 of Rank Attackers of week ".$medal['points']." in a row";
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
				 </table></p>
				 
				 
	<p class="btn"><input type="image" value="" tabindex="9" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></p>
    </form>
   