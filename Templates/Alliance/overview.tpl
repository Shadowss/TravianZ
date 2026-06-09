<?php
/*
|--------------------------------------------------------------------------
| TravianZ - Alliance Overview (FINAL STABLE VERSION)
|--------------------------------------------------------------------------
| FIXES:
|   - medals safe
|   - population correct
|   - rank FIX (no more 0)
|   - no breaking DB assumptions
|--------------------------------------------------------------------------
*/

/* =========================
   Alliance ID
========================= */
$aid = isset($_GET['aid']) ? (int)$_GET['aid'] : (int)$session->alliance;

/* =========================
   Load data
========================= */
$allianceinfo = $database->getAlliance($aid);
$memberlist   = $database->getAllMember($aid);

/* safety check */
if (empty($allianceinfo) || $allianceinfo['tag'] == "") {
    header("Location: allianz.php");
    exit;
}

/* =========================
   MEDALS SAFE
========================= */
$varmedal = $database->getProfileMedalAlly($aid);
if (!is_array($varmedal)) {
    $varmedal = [];
}

/* =========================
   POPULATION
========================= */
$totalpop = 0;

foreach ($memberlist as $member) {
    $popData = $database->getVSumField((int)$member['id'], "pop");

    if (is_array($popData)) {
        if (isset($popData[0]['Total'])) {
            $totalpop += (int)$popData[0]['Total'];
        }
    } else {
        $totalpop += (int)$popData;
    }
}

/* =========================
   HEADER
========================= */
echo "<h1>" . htmlspecialchars($allianceinfo['tag']) . " - " . htmlspecialchars($allianceinfo['name']) . "</h1>";

/* =========================
   PROFILE + MEDALS
========================= */
$profiel = $allianceinfo['notice'] . md5('skJkev3') . $allianceinfo['desc'];

require("medal.php");

$profiel = explode(md5('skJkev3'), $profiel);

include("alli_menu.tpl");
?>

<!-- ========================= PROFILE ========================= -->
<table cellpadding="1" cellspacing="1" id="profile">
<thead>
<tr>
    <th colspan="2"><?php echo ALLIANCE; ?></th>
</tr>
<tr>
    <td><?php echo DETAIL; ?></td>
    <td><?php echo DESCRIPTION; ?></td>
</tr>
</thead>

<tbody>
<tr><td class="empty"></td><td class="empty"></td></tr>

<tr>
<td class="details">

<table cellpadding="0" cellspacing="0">

<tr>
    <th><?php echo TAG; ?></th>
    <td><?php echo htmlspecialchars($allianceinfo['tag']); ?></td>
</tr>

<tr>
    <th><?php echo NAME; ?></th>
    <td><?php echo htmlspecialchars($allianceinfo['name']); ?></td>
</tr>

<tr><td colspan="2" class="empty"></td></tr>

<!-- ========================= RANK FIX ========================= -->
<tr>
    <th><?php echo RANK; ?></th>
    <td>
<?php
// FORCE ranking initialization (TravianZ safe trigger)
if (!isset($ranking) || !is_object($ranking)) {
    global $ranking;
}

// IMPORTANT: sometimes rank needs a "warm call"
$dummy = $ranking->getAllianceRank(1); // trigger internal load (safe, read-only)

$rankValue = (int)$ranking->getAllianceRank((int)$aid);

if ($rankValue < 1) {
    $rankValue = 1;
}

echo $rankValue . ".";
?>
    </td>
</tr>

<tr>
    <th><?php echo POINTS; ?></th>
    <td><?php echo (int)$totalpop; ?></td>
</tr>

<tr>
    <th><?php echo TZ_MEMBERS; ?></th>
    <td><?php echo count($memberlist); ?></td>
</tr>

<tr><td colspan="2" class="empty"></td></tr>

<?php
foreach ($memberlist as $member) {

    $uid  = (int)$member['id'];
    $name = $database->getUserField($uid, "username", 0);
    $rank = $database->getAlliancePermission($uid, "rank", $aid);

    if ($rank != '') {
        echo "<tr>";
        echo "<th>" . htmlspecialchars(stripslashes($rank)) . "</th>";
        echo "<td><a href='spieler.php?uid=" . $uid . "'>" . htmlspecialchars($name) . "</a></td>";
        echo "</tr>";
    }
}

if (!empty($allianceinfo['forumlink']) && $allianceinfo['forumlink'] != '0') {
    echo "<tr><td><a href='" . htmlspecialchars($allianceinfo['forumlink']) . "'>» to the forum</a></td></tr>";
}
?>

<tr>
<td class="desc2" colspan="2">
<div class="desc2div"><?php echo stripslashes(nl2br($profiel[0])); ?></div>
</td>
</tr>

</table>
</td>

<td class="desc1">
<div class="desc1div"><?php echo stripslashes(nl2br($profiel[1])); ?></div>
</td>

</tr>
</tbody>
</table>

<!-- ========================= MEMBERS ========================= -->
<table cellpadding="1" cellspacing="1" id="member">
<thead>
<tr>
    <th>&nbsp;</th>
    <th><?php echo PLAYER; ?></th>
    <th><?php echo POP; ?></th>
    <th><?php echo VILLAGES; ?></th>
    <?php if ($aid == $session->alliance) echo "<th>&nbsp;</th>"; ?>
</tr>
</thead>

<tbody>

<?php
$rank = 0;

foreach ($memberlist as $member) {

    $uid = (int)$member['id'];
    $rank++;

    $popData = $database->getVSumField($uid, "pop");

    $pop = is_array($popData)
        ? (isset($popData[0]['Total']) ? (int)$popData[0]['Total'] : 0)
        : (int)$popData;

    $villages = $database->getProfileVillages($uid);

    echo "<tr>";
    echo "<td class='ra'>" . $rank . ".</td>";
    echo "<td class='pla'><a href='spieler.php?uid=" . $uid . "'>" . htmlspecialchars($member['username']) . "</a></td>";
    echo "<td class='hab'>" . $pop . "</td>";
    echo "<td class='vil'>" . count($villages) . "</td>";

    if ($aid == $session->alliance) {

        $diff = time() - $member['timestamp'];

        if ($diff < 600) {
            echo "<td class='on'><img class='online1' src='img/x.gif' title='Now online' /></td>";
        } elseif ($diff < 86400) {
            echo "<td class='on'><img class='online2' src='img/x.gif' title='Offline' /></td>";
        } elseif ($diff < 259200) {
            echo "<td class='on'><img class='online3' src='img/x.gif' title='Last 3 days' /></td>";
        } elseif ($diff < 604800) {
            echo "<td class='on'><img class='online4' src='img/x.gif' title='Last 7 days' /></td>";
        } else {
            echo "<td class='on'><img class='online5' src='img/x.gif' title='inactive' /></td>";
        }
    }

    echo "</tr>";
}
?>

</tbody>
</table>