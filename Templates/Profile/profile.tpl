<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       06.05.2026 						       	 				   ##
##  Filename       profile.tpl                                                 ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

// =========================
// MEDALS LOAD
// =========================

$varmedal = $database->getProfileMedal($session->uid);

?>
 
 
<!-- =========================
     PAGE HEADER
========================= -->

<h1>Player profile</h1>
<?php include("menu.tpl"); ?>



<form action="spieler.php" method="POST">
<input type="hidden" name="ft" value="p1" />
<input type="hidden" name="id" value="<?php echo isset($id) ? (int)$id : 0; ?>" />

<table cellpadding="1" cellspacing="1" id="edit">

<thead>
<tr>
    <th colspan="3">Player <?php echo htmlspecialchars($session->username, ENT_QUOTES, 'UTF-8'); ?></th>
</tr>
<tr>
    <td colspan="2">Details</td>
    <td>Description</td>
</tr>
</thead>

<tbody>

<tr>
<td colspan="2" class="empty"></td>
<td class="empty"></td>
</tr>

<?php
// =========================
// BIRTHDAY SAFE PARSE
// =========================
$birthday = $session->userinfo['birthday'] ?? 0;
$bday = ($birthday != 0) ? explode("-", $birthday) : array('', '', '');
?>

<tr>
<th>Birthday</th>
<td class="birth">

<input tabindex="1" class="text day" type="text" name="tag"
value="<?php echo $bday[2] ?? ''; ?>" maxlength="2" />

<select tabindex="2" name="monat" class="dropdown">
<option value="0"></option>

<?php
$months = [
1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'June',
7=>'July',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec'
];

foreach ($months as $k => $v) {
    $sel = (isset($bday[1]) && $bday[1] == $k) ? 'selected' : '';
    echo "<option value='$k' $sel>$v</option>";
}
?>

</select>

<input tabindex="3" type="text" name="jahr"
value="<?php echo $bday[0] ?? ''; ?>"
maxlength="4" class="text year">

</td>

<!-- DESCRIPTION RIGHT -->
<td rowspan="<?php echo 7 + count($database->getProfileVillages($session->uid)); ?>" class="desc1">
<textarea tabindex="7" name="be1"><?php
echo $session->userinfo['desc2'] ?? '';
?></textarea>
</td>
</tr>

<!-- =========================
     GENDER
========================= -->
<tr>
<th>Gender</th>
<td class="gend">

<label><input class="radio" type="radio" name="mw" value="0"
<?php if (($session->userinfo['gender'] ?? 0) == 0) echo "checked"; ?>> n/a</label>

<label><input class="radio" type="radio" name="mw" value="1"
<?php if (($session->userinfo['gender'] ?? 0) == 1) echo "checked"; ?>> m</label>

<label><input class="radio" type="radio" name="mw" value="2"
<?php if (($session->userinfo['gender'] ?? 0) == 2) echo "checked"; ?>> f</label>

</td>
</tr>

<!-- LOCATION -->
<tr>
<th>Location</th>
<td>
<input tabindex="5" type="text" name="ort"
value="<?php echo $session->userinfo['location'] ?? ''; ?>"
maxlength="30" class="text">
</td>
</tr>

<tr><td colspan="2" class="empty"></td></tr>

<?php
// =========================
// VILLAGES LIST (SAFE BUT ALLOWS ')
// =========================
$varray = $database->getProfileVillages($session->uid);

for ($i = 0; $i < count($varray); $i++):
?>
<tr>
<th>Village name</th>
<td>
<input tabindex="6" type="text"
name="dname<?php echo $i; ?>"
value="<?php echo str_replace(['<','>'], '', $varray[$i]['name']); ?>"
maxlength="30" class="text">
</td>
</tr>
<?php endfor; ?>

<!-- DESCRIPTION LEFT -->
<tr>
<td colspan="2" class="desc2">
<textarea tabindex="8" name="be2"><?php
echo $session->userinfo['desc1'] ?? '';
?></textarea>
</td>
</tr>

</tbody>
</table>

<!-- =========================
     MEDALS TABLE
========================= -->
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
// =========================
// DYNAMIC MEDALS
// =========================
foreach ($varmedal as $medal) {

    $titel = "Bonus";

    switch ($medal['categorie']) {
        case "1": $titel="Attacker of the Week"; break;
        case "2": $titel="Defender of the Week"; break;
        case "3": $titel="Pop Climber of the week"; break;
        case "4": $titel="Robber of the week"; break;
        case "5": $titel="Top 10 Attack+Def"; break;
        case "6": $titel="Top Attack streak ".$medal['points']; break;
        case "7": $titel="Top Def streak ".$medal['points']; break;
        case "8": $titel="Top Pop streak ".$medal['points']; break;
        case "9": $titel="Top Rob streak ".$medal['points']; break;
        case "10": $titel="Rank Climber"; break;
        case "11": $titel="Rank streak ".$medal['points']; break;
        case "12": $titel="Top 10 Attack"; break;
        case "13": $titel="Top 10 Def"; break;
        case "14": $titel="Top 10 Pop"; break;
        case "15": $titel="Top 10 Rob"; break;
        case "16": $titel="Top 10 Rank"; break;
    }

    echo "<tr>
    <td>$titel</td>
    <td>{$medal['plaats']}</td>
    <td>{$medal['week']}</td>
    <td><a href='#' onclick=\"insertMedal('[#{$medal['id']}]'); return false;\">[#{$medal['id']}]</a></td>
    </tr>";
}
?>

<tr>
<td>Beginners Protection</td><td></td><td></td>
<td><a href="#" onclick="insertMedal('[#0]'); return false;">[#0]</a></td>
</tr>

<?php if (NEW_FUNCTIONS_MEDAL_3YEAR): ?>
<tr><td>veteran</td><td></td><td></td><td><a href="#" onclick="insertMedal('[#g2300]'); return false;">[#g2300]</a></td></tr>
<?php endif; ?>

<?php if (NEW_FUNCTIONS_MEDAL_5YEAR): ?>
<tr><td>veteran_5a</td><td></td><td></td><td><a href="#" onclick="insertMedal('[#g2301]'); return false;">[#g2301]</a></td></tr>
<?php endif; ?>

<?php if (NEW_FUNCTIONS_MEDAL_10YEAR): ?>
<tr><td>veteran_10a</td><td></td><td></td><td><a href="#" onclick="insertMedal('[#g2302]'); return false;">[#g2302]</a></td></tr>
<?php endif; ?>

<?php
// =========================
// TRIBE MEDALS
// =========================
if(defined('NEW_FUNCTIONS_TRIBE_IMAGES') && NEW_FUNCTIONS_TRIBE_IMAGES){

    if(($session->userinfo['tribe'] ?? 0) == 1){
        echo "<tr><td>Tribe Romans</td><td></td><td></td>
        <td><a href='#' onclick=\"insertMedal('[#roman]'); return false;\">[#roman]</a></td></tr>";
    } elseif(($session->userinfo['tribe'] ?? 0) == 2){
        echo "<tr><td>Tribe Teutons</td><td></td><td></td>
        <td><a href='#' onclick=\"insertMedal('[#teuton]'); return false;\">[#teuton]</a></td></tr>";
    } elseif(($session->userinfo['tribe'] ?? 0) == 3){
        echo "<tr><td>Tribe Gauls</td><td></td><td></td>
        <td><a href='#' onclick=\"insertMedal('[#gaul]'); return false;\">[#gaul]</a></td></tr>";
    }
}

// =========================
// MHS MEDALS
// =========================
if(defined('NEW_FUNCTIONS_MHS_IMAGES') && NEW_FUNCTIONS_MHS_IMAGES){

    if(($session->userinfo['access'] ?? 0) == 9){

        echo "<tr><td>Administrator</td><td></td><td></td>
        <td><a href='#' onclick=\"insertMedal('[#MULTIHUNTER]'); return false;\">[#MULTIHUNTER]</a></td></tr>";

        echo "<tr><td>Administrator</td><td></td><td></td>
        <td><a href='#' onclick=\"insertMedal('[#MH]'); return false;\">[#MH]</a></td></tr>";

        echo "<tr><td>Administrator</td><td></td><td></td>
        <td><a href='#' onclick=\"insertMedal('[#TEAM]'); return false;\">[#TEAM]</a></td></tr>";

    } elseif(($session->userinfo['access'] ?? 0) == 8){

        echo "<tr><td>Multihunter</td><td></td><td></td>
        <td><a href='#' onclick=\"insertMedal('[#MULTIHUNTER]'); return false;\">[#MULTIHUNTER]</a></td></tr>";

        echo "<tr><td>Multihunter</td><td></td><td></td>
        <td><a href='#' onclick=\"insertMedal('[#MH]'); return false;\">[#MH]</a></td></tr>";

        echo "<tr><td>Multihunter</td><td></td><td></td>
        <td><a href='#' onclick=\"insertMedal('[#TEAM]'); return false;\">[#TEAM]</a></td></tr>";
    }
}

// =========================
// SHADOW SPECIAL
// =========================
if(($session->userinfo['username'] ?? '') == "Shadow"){

    echo "<tr><td>Shadow</td><td></td><td></td>
    <td><a href='#' onclick=\"insertMedal('[#SHADOW]'); return false;\">[#SHADOW]</a></td></tr>";

    echo "<tr><td>Shadow</td><td></td><td></td>
    <td><a href='#' onclick=\"insertMedal('[#MH]'); return false;\">[#MH]</a></td></tr>";

    echo "<tr><td>Shadow</td><td></td><td></td>
    <td><a href='#' onclick=\"insertMedal('[#TEAM]'); return false;\">[#TEAM]</a></td></tr>";

    echo "<tr><td>Shadow</td><td></td><td></td>
    <td><a href='#' onclick=\"insertMedal('[#EVENT]'); return false;\">[#EVENT]</a></td></tr>";
}
?>

</table>
</p>

<!-- JS -->
<script>
function insertMedal(code) {
    const textarea = document.querySelector('textarea[name="be1"]');
    if (!textarea) return;

    textarea.focus();

    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;

    textarea.value =
        textarea.value.substring(0, start) +
        code +
        textarea.value.substring(end);

    textarea.selectionStart = textarea.selectionEnd = start + code.length;
}
</script>

<p class="btn">
<input type="image" name="s1" id="btn_ok"
class="dynamic_img" src="img/x.gif" alt="OK">
</p>

</form>
