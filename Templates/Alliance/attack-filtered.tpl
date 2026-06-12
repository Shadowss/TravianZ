<?php
#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                              ##
## --------------------------------------------------------------------------- ##
## Project:     TravianZ (Refactor incremental)                                ##
## File:        attack-filtered.tpl                                            ##
## Description: Attack / report filtering                                      ##
## Improvements:                                                               ##
##  - Secure GET handling                                                      ##
##  - Safer SQL parameters (cast only)                                         ##
##  - Reduced duplicated conditions                                            ##
##  - Cleaner rendering                                                        ##
##  - XSS protection                                                           ##
#################################################################################

// filter type (secure cast)
$filterType = isset($_GET['f']) ? (int)$_GET['f'] : 0;

// base query
$sql = false;

// helper conditions (cleaner than long OR chains)
$allyId = (int)$session->alliance;

// FILTER 31
if ($filterType === 31) {

    $sql = mysqli_query(
        $database->dblink,
        "SELECT * FROM " . TB_PREFIX . "ndata 
         WHERE ally = $allyId 
         AND (
            (ntype != 0 AND ntype < 4) 
            OR (ntype > 17 AND ntype != 20 AND ntype != 21 AND ntype != 22)
         )
         ORDER BY time DESC 
         LIMIT 20"
    );

// FILTER 32
} elseif ($filterType === 32) {

    $sql = mysqli_query(
        $database->dblink,
        "SELECT * FROM " . TB_PREFIX . "ndata 
         WHERE ally = $allyId 
         AND (
            ntype < 1 
            OR (ntype > 3 AND ntype < 8) 
            OR ntype > 19
         )
         AND ntype != 22 
         ORDER BY time DESC 
         LIMIT 20"
    );
}

// fallback safety
$outputList = "";

if (!$sql || mysqli_num_rows($sql) == 0) {

    $outputList .= "<tr><td colspan=\"4\" class=\"none\">There are no reports available.</td></tr>";

} else {

    while ($row = mysqli_fetch_assoc($sql)) {

        $dataarray = explode(",", $row['data']);

        $id     = (int)$row["id"];
        $ally   = (int)$row["ally"];
        $ntype  = (int)$row["ntype"];
        $time   = (int)$row["time"];
        $topic  = $row["topic"];

        // detect report type group
        $type2 = ($ntype >= 4 && $ntype <= 7) ? 32 : 31;

        $type = (isset($_GET['t']) && (int)$_GET['t'] === 5)
            ? (int)$row['archive']
            : $ntype;

        if ($type == 23) {
            $type = 22;
        }

        // icon logic
        $useScoutIcon =
            (($type == 18 || $type == 19) && $filterType == 31) ||
            (($type == 20 || $type == 21) && $filterType == 32) ||
            $type == 22;

        // attacker + defender names (cache local variables to reduce DB calls)
        $attackerId = (int)$dataarray[0];
        $targetId   = ($type != 22 && $type != 23) ? (int)$dataarray[28] : (int)$dataarray[2];

        $attackerName = $database->getUserField($attackerId, "username", 0);
        $targetName   = $database->getUserField($targetId, "username", 0);

        $targetAllyId = $database->getUserField($targetId, "alliance", 0);
        $targetAllyName = $targetAllyId ? $database->getAllianceName($targetAllyId) : "-";

        $allyLink = ($targetAllyId)
            ? "<a href=\"allianz.php?aid=" . (int)$targetAllyId . "\">" . htmlspecialchars($targetAllyName, ENT_QUOTES, 'UTF-8') . "</a>"
            : "-";

        $nn = (
            (($type == 18 || $type == 19) && $filterType == 31) ||
            (($type == 20 || $type == 21) && $filterType == 32)
        ) ? " scouts " : " attacks ";

        $date = $generator->procMtime($time);

        // render row
        $outputList .= "<tr>";

        // ICON + link switch
        $outputList .= "<td class=\"sub\">";
        $outputList .= "<a href=\"allianz.php?s=3&f=" . $type2 . "\">";

        if ($useScoutIcon) {
            $outputList .= "<img src=\"gpack/travian_default/img/scouts/$type.gif\" title=\"" . htmlspecialchars($topic, ENT_QUOTES, 'UTF-8') . "\" />";
        } else {
            $outputList .= "<img src=\"img/x.gif\" class=\"iReport iReport$type\" title=\"" . htmlspecialchars($topic, ENT_QUOTES, 'UTF-8') . "\">";
        }

        $outputList .= "</a>";

        $outputList .= "<div><a href=\"berichte.php?id=$id&aid=$ally\">";

        $outputList .= htmlspecialchars($attackerName, ENT_QUOTES, 'UTF-8');
        $outputList .= $nn;
        $outputList .= htmlspecialchars($targetName, ENT_QUOTES, 'UTF-8');

        $outputList .= "</a></div>";
        $outputList .= "</td>";

        // alliance column
        $outputList .= "<td class=\"al\">" . $allyLink . "</td>";

        // date column
        $outputList .= "<td class=\"dat\">" . $date[0] . " " . substr($date[1], 0, 5) . "</td>";

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