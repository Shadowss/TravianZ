<?php
#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                              ##
## --------------------------------------------------------------------------- ##
## Project:     TravianZ (Refactor incremental)                                ##
## File:        attacks.tpl                                                    ##
## Description: Alliance military events                                       ##
## Improvements:                                                               ##
##  - Secure GET handling                                                      ##
##  - Reduced duplicated logic                                                 ##
##  - Cleaner SQL usage                                                        ##
##  - Safer output (XSS protection)                                            ##
##  - Simplified condition branches                                             ##
#################################################################################

// fallback alliance id
if (!isset($aid)) {
    $aid = $session->alliance;
}

// load alliance info
$allianceinfo = $database->getAlliance($aid);

// header
echo "<h1>" . htmlspecialchars($allianceinfo['tag'], ENT_QUOTES, 'UTF-8') .
     " - " .
     htmlspecialchars($allianceinfo['name'], ENT_QUOTES, 'UTF-8') .
     "</h1>";

// menu
include("alli_menu.tpl");

// safe filter input
$f = isset($_GET['f']) ? (int)$_GET['f'] : 0;
$t = isset($_GET['t']) ? (int)$_GET['t'] : 0;
?>

<div class="clear"></div>

<h4 class="chartHeadline"><?php echo TZ_MILITARY_EVENTS; ?></h4>

<div id="submenu">

    <!-- DEFENDER -->
    <a href="allianz.php?s=3&f=32">
        <img src="img/x.gif"
             class="<?php echo ($f === 32 ? 'active btn_def' : 'btn_def'); ?>"
             alt="<?php echo DEFENDER; ?>" title="<?php echo DEFENDER; ?>" />
    </a>

    <!-- ATTACKER -->
    <a href="allianz.php?s=3&f=31">
        <img src="img/x.gif"
             class="<?php echo ($f === 31 ? 'active btn_off' : 'btn_off'); ?>"
             alt="<?php echo ATTACKER; ?>" title="<?php echo ATTACKER; ?>" />
    </a>

</div>

<?php
// filtered view
if ($f === 31 || $f === 32) {

    include "Templates/Alliance/attack-filtered.tpl";

} else {

    // main query
    $allyId = (int)$session->alliance;

    $sql = mysqli_query(
        $database->dblink,
        "SELECT * FROM " . TB_PREFIX . "ndata
         WHERE ally = $allyId
         AND (
            ntype < 8
            OR (ntype > 17 AND ntype < 22)
            OR (ntype = 22 AND ally = $allyId)
            OR (ntype = 23 AND ally != $allyId)
         )
         ORDER BY time DESC
         LIMIT 20"
    );

    $outputList = "";

    if (!$sql || mysqli_num_rows($sql) == 0) {

        $outputList .= "<tr><td colspan=\"4\" class=\"none\">There are no reports available.</td></tr>";

    } else {

        while ($row = mysqli_fetch_assoc($sql)) {

            $dataarray = explode(",", $row['data']);

            $id     = (int)$row['id'];
            $ally   = (int)$row['ally'];
            $ntype  = (int)$row['ntype'];
            $time   = (int)$row['time'];
            $topic  = $row['topic'];
            $toWref = (int)$row['toWref'];

            // type mapping
            $type2 = ($ntype >= 4 && $ntype <= 7) ? 32 : 31;

            $type = ($t === 5) ? (int)$row['archive'] : $ntype;

            if ($type == 23) {
                $type = 22;
            }

            // scout icon logic
            $isScout = ($type >= 18 && $type <= 22);

            // attacker / defender
            $attackerId = (int)$dataarray[0];
            $defenderId = ($type != 22) ? (int)$dataarray[28] : (int)$dataarray[2];

            $attackerName = $database->getUserField($attackerId, "username", 0);
            $defenderName = $database->getUserField($defenderId, "username", 0);

            // alliance resolve (simplified safe fallback)
            if ($ntype == 0) {

                $isOasis = $database->isVillageOases($toWref);

                if ($isOasis == 0) {
                    $owner = ($toWref != $village->wid)
                        ? $database->getVillageField($toWref, "owner")
                        : $database->getVillageField($dataarray[1], "owner");
                } else {
                    $owner = ($toWref != $village->wid)
                        ? $database->getOasisField($toWref, "owner")
                        : $database->getOasisField($dataarray[1], "owner");
                }

                $getUserAlly = $database->getUserField($owner, "alliance", 0);

            } else {
                $getUserAlly = $database->getUserField($defenderId, "alliance", 0);
            }

            $allyName = "-";

            if ($getUserAlly) {
                $allyName = "<a href=\"allianz.php?aid=" . (int)$getUserAlly . "\">"
                          . htmlspecialchars($database->getAllianceName($getUserAlly), ENT_QUOTES, 'UTF-8')
                          . "</a>";
            }

            // date
            $date = $generator->procMtime($time);

            // attack/scout label
            $nn = ($ntype >= 18 && $ntype <= 21) ? " scouts " : " attacks ";

            // render row
            $outputList .= "<tr>";

            $outputList .= "<td class=\"sub\">";
            $outputList .= "<a href=\"allianz.php?s=3&f=$type2\">";

            if ($isScout) {
                $outputList .= "<img src=\"gpack/travian_default/img/scouts/$type.gif\" title=\"" .
                               htmlspecialchars($topic, ENT_QUOTES, 'UTF-8') . "\" />";
            } else {
                $outputList .= "<img src=\"img/x.gif\" class=\"iReport iReport$type\" title=\"" .
                               htmlspecialchars($topic, ENT_QUOTES, 'UTF-8') . "\">";
            }

            $outputList .= "</a>";

            $outputList .= "<div><a href=\"berichte.php?id=$id&aid=$ally\">";

            $outputList .= htmlspecialchars($attackerName, ENT_QUOTES, 'UTF-8');
            $outputList .= $nn;
            $outputList .= htmlspecialchars($defenderName, ENT_QUOTES, 'UTF-8');

            $outputList .= "</a></div></td>";

            $outputList .= "<td class=\"al\">" . $allyName . "</td>";
            $outputList .= "<td class=\"dat\">" . $date[0] . " " . date('H:i', $time) . "</td>";

            $outputList .= "</tr>";
        }
    }
?>
<table cellpadding="1" cellspacing="1" id="offs">
<thead>
<tr>
    <td><?php echo PLAYER; ?></td>
    <td><?php echo ALLIANCE; ?></td>
    <td><?php echo DATE; ?></td>
</tr>
</thead>

<tbody>
<?php echo $outputList; ?>
</tbody>
</table>

<?php } ?>