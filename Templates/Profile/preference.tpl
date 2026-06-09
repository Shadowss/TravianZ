<?php 

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       06.05.2026 						       	 				   ##
##  Filename       preference.tpl                                              ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          http://travianz.org						       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

// =========================
// DELETE LINK ACTION
// =========================
if (isset($_GET['del']) && is_numeric($_GET['del'])) {

    $delId = (int)$_GET['del'];

    // remove user link safely (owner check handled inside function)
    $database->removeLinks($delId, $session->uid);

    header("Location: spieler.php?s=2");
    exit;
}

// =========================
// LEGACY EARLY EXIT
// =========================
if (isset($_POST['ft']) && $_POST['ft'] == 'p3') {
    return;
}

// =========================
// SAVE / UPDATE LINKS
// =========================
if (
    isset($_POST['nr0']) ||
    isset($_POST['id0']) ||
    isset($_POST['linkname0']) ||
    isset($_POST['linkziel0'])
) {

    $links = [];

    // =========================
    // PARSE POST DATA
    // =========================
    foreach ($_POST as $key => $value) {

        $value = trim($value);

        // position field
        if (strpos($key, 'nr') === 0) {
            $i = substr($key, 2);
            $links[$i]['nr'] = (int)$value;
        }

        // id field
        if (strpos($key, 'id') === 0) {
            $i = substr($key, 2);
            $links[$i]['id'] = (int)$value;
        }

        // link name (escaped for SQL safety)
        if (strpos($key, 'linkname') === 0) {
            $i = substr($key, 8);
            $links[$i]['linkname'] = mysqli_real_escape_string($database->dblink, $value);
        }

        // link url (escaped for SQL safety)
        if (strpos($key, 'linkziel') === 0) {
            $i = substr($key, 8);
            $links[$i]['linkziel'] = mysqli_real_escape_string($database->dblink, $value);
        }
    }

    // =========================
    // PROCESS LINKS (ADD / UPDATE / DELETE)
    // =========================
    foreach ($links as $link) {

        $nr   = isset($link['nr']) ? (int)$link['nr'] : 0;
        $id   = isset($link['id']) ? (int)$link['id'] : 0;
        $name = isset($link['linkname']) ? trim($link['linkname']) : '';
        $url  = isset($link['linkziel']) ? trim($link['linkziel']) : '';

        // =========================
        // ADD NEW LINK
        // =========================
        if ($nr !== 0 && $name !== '' && $url !== '' && $id === 0) {

            $userid = (int)$session->uid;

            mysqli_query(
                $database->dblink,
                "INSERT INTO `" . TB_PREFIX . "links`
                (`userid`, `name`, `url`, `pos`)
                VALUES
                ($userid, '$name', '$url', $nr)"
            );

        // =========================
        // UPDATE EXISTING LINK
        // =========================
        } elseif ($nr !== 0 && $name !== '' && $url !== '' && $id > 0) {

            $id = (int)$id;

            $query = mysqli_query(
                $database->dblink,
                "SELECT userid FROM `" . TB_PREFIX . "links` WHERE id = $id"
            );

            $data = mysqli_fetch_assoc($query);

            // ownership check
            if ($data && (int)$data['userid'] === (int)$session->uid) {

                mysqli_query(
                    $database->dblink,
                    "UPDATE `" . TB_PREFIX . "links`
                     SET name='$name', url='$url', pos=$nr
                     WHERE id=$id"
                );
            }

        // =========================
        // DELETE EMPTY ENTRY
        // =========================
        } elseif ($nr === 0 && $name === '' && $url === '' && $id > 0) {

            $id = (int)$id;

            $query = mysqli_query(
                $database->dblink,
                "SELECT userid FROM `" . TB_PREFIX . "links` WHERE id = $id"
            );

            $data = mysqli_fetch_assoc($query);

            // ownership check
            if ($data && (int)$data['userid'] === (int)$session->uid) {

                mysqli_query(
                    $database->dblink,
                    "DELETE FROM `" . TB_PREFIX . "links` WHERE id = $id"
                );
            }
        }
    }

    // legacy refresh behavior
    echo '<meta http-equiv="refresh" content="0">';
}

// =========================
// LOAD LINKS
// =========================
$query = mysqli_query(
    $database->dblink,
    "SELECT * FROM `" . TB_PREFIX . "links`
     WHERE userid = " . (int)$session->uid . "
     ORDER BY pos ASC"
) or die(mysqli_error($database->dblink));

$links = [];
while ($data = mysqli_fetch_assoc($query)) {
    $links[] = $data;
}

// =========================
// USER SETTINGS SAVE
// =========================
if (isset($_POST['v1']) || isset($_POST['v2']) || isset($_POST['timezone']) || isset($_POST['lang'])) {

    $v1 = isset($_POST['v1']) ? 1 : 0;
    $v2 = isset($_POST['v2']) ? 1 : 0;
    $v3 = isset($_POST['v3']) ? 1 : 0;
    $map = isset($_POST['map']) ? 1 : 0;
    $v4 = isset($_POST['v4']) ? 1 : 0;
    $v5 = isset($_POST['v5']) ? 1 : 0;
    $v6 = isset($_POST['v6']) ? 1 : 0;

    $timezone = isset($_POST['timezone']) ? (int)$_POST['timezone'] : 1;
    $tformat  = isset($_POST['tformat']) ? (int)$_POST['tformat'] : 0;

// =========================
// LANGUAGE
// =========================

$lang = LANG;
if(isset($_POST['lang']))
{
    $allowedLangs = ['en','fr','it','ro','zh'];
    $selectedLang = strtolower(trim($_POST['lang']));
    if(in_array($selectedLang, $allowedLangs))
    {
        $lang = $selectedLang;
    }
}

    // update user preferences
    $database->query("
        UPDATE " . TB_PREFIX . "users SET
        v1=$v1,
        v2=$v2,
        v3=$v3,
        map=$map,
        v4=$v4,
        v5=$v5,
        v6=$v6,
        timezone=$timezone,
        tformat=$tformat,
        lang='$lang'
        WHERE id=" . (int)$session->uid . "
    ");

    // schimbare instant în sesiune
    $_SESSION['lang'] = $lang;

    header("Location: spieler.php?s=2");
    exit;
}
?>

<!-- =========================
     PAGE HEADER
========================= -->
<h1><?php echo PLAYER_PROFILE; ?></h1>

<?php include("menu.tpl"); ?>

<!-- =========================
     DIRECT LINKS TABLE
========================= -->
<form action="spieler.php?s=2" method="POST">
<input type="hidden" name="ft" value="p2">

<table cellpadding="1" cellspacing="1" id="links">
    <thead>
        <tr>
            <th colspan="4"><?php echo DIRECT_LINKS; ?></th>
        </tr>
        <tr>
            <td><?php echo DELETE; ?></td>
            <td><?php echo TZ_NO; ?></td>
            <td><?php echo LINK_NAME; ?></td>
            <td><?php echo LINK_TARGET; ?></td>
        </tr>
    </thead>

    <tbody>
    <?php
    $i = 0;
    $last_pos = 0;

    foreach ($links as $link):
        $last_pos = (int)$link['pos'];
    ?>

        <tr>
            <td>
                <a href="spieler.php?del=<?php echo (int)$link['id']; ?>&s=2">
                    <img class="del" src="img/x.gif" alt="<?php echo DELETE; ?>" title="<?php echo DELETE; ?>">
                </a>
            </td>

            <td class="nr">
                <input <?php if (!$session->plus) echo "disabled"; ?>
                       class="text"
                       type="text"
                       name="nr<?php echo $i; ?>"
                       value="<?php echo (int)$link['pos']; ?>"
                       size="1"
                       maxlength="3" />

                <input type="hidden"
                       name="id<?php echo $i; ?>"
                       value="<?php echo (int)$link['id']; ?>" />
            </td>

            <td class="nam">
                <input <?php if (!$session->plus) echo "disabled"; ?>
                       class="text"
                       type="text"
                       name="linkname<?php echo $i; ?>"
                       value="<?php echo htmlspecialchars($link['name'], ENT_QUOTES, 'UTF-8'); ?>"
                       maxlength="30" />
            </td>

            <td class="txt">
                <input <?php if (!$session->plus) echo "disabled"; ?>
                       class="text"
                       type="text"
                       name="linkziel<?php echo $i; ?>"
                       value="<?php echo htmlspecialchars($link['url'], ENT_QUOTES, 'UTF-8'); ?>"
                       maxlength="255" />
            </td>
        </tr>

    <?php
    $i++;
    endforeach;
    ?>

        <!-- NEW EMPTY ROW -->
        <tr>
            <td></td>
            <td class="nr">
                <input <?php if (!$session->plus) echo "disabled"; ?>
                       class="text"
                       type="text"
                       name="nr<?php echo $i; ?>"
                       value="<?php echo ($last_pos + 1); ?>"
                       size="1"
                       maxlength="3">
            </td>

            <td class="nam">
                <input <?php if (!$session->plus) echo "disabled"; ?>
                       class="text"
                       type="text"
                       name="linkname<?php echo $i; ?>"
                       value=""
                       maxlength="30">
            </td>

            <td class="txt">
                <input <?php if (!$session->plus) echo "disabled"; ?>
                       class="text"
                       type="text"
                       name="linkziel<?php echo $i; ?>"
                       value=""
                       maxlength="255">
            </td>
        </tr>

    </tbody>
</table>

<!-- =========================
     AUTO COMPLETION
========================= -->
<table cellpadding="1" cellspacing="1" id="completion" class="set">
<thead>
<tr>
  <th colspan="2">
    Auto completion 
    <span style="color:#999; font-weight:400; font-size:0.9em; font-style:italic; opacity:0.7;">
      <?php echo TZ_NOT_CODED_YET; ?>
    </span>
  </th>
</tr>
<tr><td colspan="2"><?php echo TZ_USED_FOR_RALLY_POINT_AND_MARKETPLA; ?></td></tr>
</thead>
<tbody>

<tr>
<td class="sel"><input class="check" type="checkbox" name="v1" value="1" <?php if($session->userinfo['v1']) echo 'checked'; ?>></td>
<td><?php echo OWN_VILLAGES; ?></td>
</tr>

<tr>
<td class="sel"><input class="check" type="checkbox" name="v2" value="1" <?php if($session->userinfo['v2']) echo 'checked'; ?>></td>
<td><?php echo VILLAGES_NEAR; ?></td>
</tr>

<tr>
<td class="sel"><input class="check" type="checkbox" name="v3" value="1" <?php if($session->userinfo['v3']) echo 'checked'; ?>></td>
<td><?php echo VILLAGES_ALLI_PLAYERS; ?></td>
</tr>

</tbody>
</table>

<!-- =========================
     LARGE MAP
========================= -->
<table cellpadding="1" cellspacing="1" id="big_map" class="set">
<thead>
<tr>
  <th colspan="2">
    Large map 
    <span style="color:#999; font-weight:400; font-size:0.9em; font-style:italic; opacity:0.7;">
      <?php echo TZ_NOT_CODED_YET; ?>
    </span>
  </th>
</tr>
</thead>
<tbody>
<tr>
<td class="sel">
<input class="check" type="checkbox" name="map" <?php if($session->userinfo['map']) echo 'checked'; ?>>
</td>
<td><?php echo TZ_SHOW_THE_LARGE_MAP_IN_AN_EXTRA_WIN; ?></td>
</tr>
</tbody>
</table>

<!-- =========================
     REPORT FILTER
========================= -->
<table cellpadding="1" cellspacing="1" id="report_filter" class="set">
<thead>
<tr>
  <th colspan="2">
    Report filter
    <span style="color:#999; font-weight:400; font-size:0.9em; font-style:italic; opacity:0.7;">
      <?php echo TZ_NOT_CODED_YET; ?>
    </span>
  </th>
</tr>
</thead>
<tbody>

<tr>
<td class="sel"><input class="check" type="checkbox" name="v4" value="1" <?php if($session->userinfo['v4']) echo 'checked'; ?>></td>
<td><?php echo TZ_NO_REPORTS_FOR_TRANSFERS_TO_OWN_VI; ?></td>
</tr>

<tr>
<td class="sel"><input class="check" type="checkbox" name="v5" value="1" <?php if($session->userinfo['v5']) echo 'checked'; ?>></td>
<td><?php echo TZ_NO_REPORTS_FOR_TRANSFERS_TO_FOREIG; ?></td>
</tr>

<tr>
<td class="sel"><input class="check" type="checkbox" name="v6" value="1" <?php if($session->userinfo['v6']) echo 'checked'; ?>></td>
<td><?php echo TZ_NO_REPORTS_FOR_TRANSFERS_FROM_FORE; ?></td>
</tr>

</tbody>
</table>

<!-- =========================
     TIME SETTINGS
========================= -->
<table cellpadding="1" cellspacing="1" id="time" class="set">
<thead>
<tr>
  <th colspan="2">
    <?php echo TZ_TIME_PREFERENCE; ?>
    <span style="color:#999; font-weight:400; font-size:0.9em; font-style:italic; opacity:0.7;">
      <?php echo TZ_NOT_CODED_YET; ?>
    </span>
  </th>
</tr>
<tr><td colspan="2"><?php echo TZ_HERE_YOU_CAN_CHANGE_TRAVIAN_S_DISP; ?></td></tr>
</thead>
<tbody>

<tr>
<th><?php echo TZ_TIME_ZONES; ?></th>
<td>
<select name="timezone" class="dropdown">

<optgroup label="local time zones">
    <option value="495" <?php if($session->userinfo['timezone']==495) echo 'selected'; ?>><?php echo TIME_ZONE_L1; ?></option>
    <option value="99" <?php if($session->userinfo['timezone']==99) echo 'selected'; ?>><?php echo TIME_ZONE_L2; ?></option>
    <option value="492" <?php if($session->userinfo['timezone']==492) echo 'selected'; ?>><?php echo TIME_ZONE_L3; ?></option>
    <option value="328" <?php if($session->userinfo['timezone']==328) echo 'selected'; ?>><?php echo TIME_ZONE_L4; ?></option>
    <option value="345" <?php if($session->userinfo['timezone']==345) echo 'selected'; ?>><?php echo TIME_ZONE_L5; ?></option>
    <option value="257" <?php if($session->userinfo['timezone']==257) echo 'selected'; ?>><?php echo TIME_ZONE_L6; ?></option>
    <option value="189" <?php if($session->userinfo['timezone']==189) echo 'selected'; ?>><?php echo TIME_ZONE_L7; ?></option>
    <option value="474" <?php if($session->userinfo['timezone']==474) echo 'selected'; ?>><?php echo TIME_ZONE_L8; ?></option>
</optgroup>

<optgroup label="general time zones">
    <option value="12" <?php if($session->userinfo['timezone']==12) echo 'selected'; ?>><?php echo TZ_UTC_11_2; ?></option>
    <option value="13" <?php if($session->userinfo['timezone']==13) echo 'selected'; ?>><?php echo TZ_UTC_10_2; ?></option>
    <option value="14" <?php if($session->userinfo['timezone']==14) echo 'selected'; ?>><?php echo TZ_UTC_9_2; ?></option>
    <option value="15" <?php if($session->userinfo['timezone']==15) echo 'selected'; ?>><?php echo TZ_UTC_8_2; ?></option>
    <option value="16" <?php if($session->userinfo['timezone']==16) echo 'selected'; ?>><?php echo TZ_UTC_7_2; ?></option>
    <option value="17" <?php if($session->userinfo['timezone']==17) echo 'selected'; ?>><?php echo TZ_UTC_6_2; ?></option>
    <option value="18" <?php if($session->userinfo['timezone']==18) echo 'selected'; ?>><?php echo TZ_UTC_5_2; ?></option>
    <option value="19" <?php if($session->userinfo['timezone']==19) echo 'selected'; ?>><?php echo TZ_UTC_4_2; ?></option>
    <option value="20" <?php if($session->userinfo['timezone']==20) echo 'selected'; ?>><?php echo TZ_UTC_3_2; ?></option>
    <option value="21" <?php if($session->userinfo['timezone']==21) echo 'selected'; ?>><?php echo TZ_UTC_2_2; ?></option>
    <option value="22" <?php if($session->userinfo['timezone']==22) echo 'selected'; ?>><?php echo TZ_UTC_1_2; ?></option>
    <option value="23" <?php if($session->userinfo['timezone']==23) echo 'selected'; ?>>UTC</option>
    <option value="0" <?php if($session->userinfo['timezone']==0) echo 'selected'; ?>><?php echo TZ_UTC_1; ?></option>
    <option value="1" <?php if($session->userinfo['timezone']==1) echo 'selected'; ?>><?php echo TZ_UTC_2; ?></option>
    <option value="2" <?php if($session->userinfo['timezone']==2) echo 'selected'; ?>><?php echo TZ_UTC_3; ?></option>
    <option value="3" <?php if($session->userinfo['timezone']==3) echo 'selected'; ?>><?php echo TZ_UTC_4; ?></option>
    <option value="4" <?php if($session->userinfo['timezone']==4) echo 'selected'; ?>><?php echo TZ_UTC_5; ?></option>
    <option value="5" <?php if($session->userinfo['timezone']==5) echo 'selected'; ?>><?php echo TZ_UTC_6; ?></option>
    <option value="6" <?php if($session->userinfo['timezone']==6) echo 'selected'; ?>><?php echo TZ_UTC_7; ?></option>
    <option value="7" <?php if($session->userinfo['timezone']==7) echo 'selected'; ?>><?php echo TZ_UTC_8; ?></option>
    <option value="8" <?php if($session->userinfo['timezone']==8) echo 'selected'; ?>><?php echo TZ_UTC_9; ?></option>
    <option value="9" <?php if($session->userinfo['timezone']==9) echo 'selected'; ?>><?php echo TZ_UTC_10; ?></option>
    <option value="10" <?php if($session->userinfo['timezone']==10) echo 'selected'; ?>><?php echo TZ_UTC_11; ?></option>
    <option value="11" <?php if($session->userinfo['timezone']==11) echo 'selected'; ?>><?php echo TZ_UTC_12; ?></option>
</optgroup>

</select>
</td>
</tr>

<tr>
<th><?php echo DATE; ?></th>
<td>

<label><input class="radio" type="radio" name="tformat" value="0" <?php if($session->userinfo['tformat']==0) echo 'checked'; ?>> <?php echo TZ_EU_DD_MM_YY_24H; ?></label><br>
<label><input class="radio" type="radio" name="tformat" value="1" <?php if($session->userinfo['tformat']==1) echo 'checked'; ?>> <?php echo TZ_US_MM_DD_YY_12H; ?></label><br>
<label><input class="radio" type="radio" name="tformat" value="2" <?php if($session->userinfo['tformat']==2) echo 'checked'; ?>> <?php echo TZ_UK_DD_MM_YY_12H; ?></label><br>
<label><input class="radio" type="radio" name="tformat" value="3" <?php if($session->userinfo['tformat']==3) echo 'checked'; ?>> <?php echo TZ_ISO_YY_MM_DD_24H; ?></label>

</td>
</tr>

</tbody>
</table>
<!-- =========================
     LANGUAGE SETTINGS
========================= -->
<table cellpadding="1" cellspacing="1" id="language" class="set">
<thead>
<tr>
  <th colspan="2">
    <?php echo TZ_LANGUAGE_SETTINGS; ?>
  </th>
</tr>
</thead>
<tbody>
<tr>
    <th><?php echo TZ_GAME_LANGUAGE; ?></th>
    <td>
        <select name="lang" class="dropdown">
            <option value="en" <?php if($session->userinfo['lang']=="en") echo 'selected'; ?>>
                <?php echo TZ_ENGLISH; ?>
            </option>
            <option value="ro" <?php if($session->userinfo['lang']=="ro") echo 'selected'; ?>>
                <?php echo TZ_ROMANIAN; ?>
            </option>
            <option value="zh" <?php if($session->userinfo['lang']=="zh") echo 'selected'; ?>>
                <?php echo TZ_CHINESE; ?>
            </option>
            <option value="fr" <?php if($session->userinfo['lang']=="fr") echo 'selected'; ?>>
                <?php echo TZ_FRENCH; ?>
            </option>
            <option value="it" <?php if($session->userinfo['lang']=="it") echo 'selected'; ?>>
                <?php echo TZ_ITALIAN; ?>
            </option>
        </select>
    </td>
</tr>
</tbody>
</table>
<!-- =========================
     SAVE BUTTON
========================= -->
<p class="btn">
<input type="image" value="" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" />
</p>

</form>

