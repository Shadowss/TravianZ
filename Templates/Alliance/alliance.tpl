<?php
#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                              ##
## --------------------------------------------------------------------------- ##
## Project:     TravianZ (Refactor incremental)                                ##
## File:        alliance.tpl                                                   ##
## Description: Alliance ranking table                                         ##
## Improvements:                                                               ##
##  - Safer input handling                                                     ##
##  - Removed duplicate function calls                                         ##
##  - Fixed variable overwrite ($ranking)                                      ##
##  - Cleaner pagination logic                                                 ##
##  - Added comments                                                           ##
#################################################################################

// Validare search (poziția din ranking)
if (!isset($_SESSION['search']) || !is_numeric($_SESSION['search'])) {
?>
    <center>
        <font color="orange" size="2">
            <p class="error">
                <?php echo TZ_THE_ALLIANCE; ?> <b>"<?php echo htmlspecialchars($_SESSION['search'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"</b> <?php echo TZ_DOES_NOT_EXIST; ?>
            </p>
        </font>
    </center>
<?php
    $search = (int)$session->alliance;
} else {
    $search = (int)$_SESSION['search'];
}

// Luăm ranking o singură dată (optimizare)
$rankData = $ranking->getRank();
$totalRanks = is_array($rankData) ? count($rankData) : 0;

// Calcul paginare
$start = 1;

if (isset($_GET['rank']) && is_numeric($_GET['rank'])) {

    $rankParam = (int)$_GET['rank'];

    // Limităm la max ranking
    if ($rankParam > $totalRanks) {
        $rankParam = $totalRanks - 1;
    }

    $multiplier = 1;

    // Determină pagina (20 / pagină)
    while ($rankParam > (20 * $multiplier)) {
        $multiplier++;
    }

    $start = 20 * $multiplier - 19;

} else {
    // fallback la sesiune
    $start = isset($_SESSION['start']) ? ((int)$_SESSION['start'] + 1) : 1;
}
?>

<table cellpadding="1" cellspacing="1" id="alliance" class="row_table_data">
    <thead>
        <tr>
            <th colspan="5">
                <?php echo TZ_THE_LARGEST_ALLIANCES; ?>
                <div id="submenu">
                    <a title="<?php echo TZ_TOP_10; ?>" href="statistiken.php?id=43">
                        <img class="btn_top10" src="img/x.gif" alt="<?php echo TZ_TOP_10; ?>">
                    </a>
                    <a title="<?php echo DEFENDER; ?>" href="statistiken.php?id=42">
                        <img class="btn_def" src="img/x.gif" alt="<?php echo DEFENDER; ?>">
                    </a>
                    <a title="<?php echo ATTACKER; ?>" href="statistiken.php?id=41">
                        <img class="btn_off" src="img/x.gif" alt="<?php echo ATTACKER; ?>">
                    </a>
                </div>
            </th>
        </tr>
        <tr>
            <td></td>
            <td><?php echo ALLIANCE; ?></td>
            <td><?php echo PLAYER; ?></td>
            <td>&Oslash;</td>
            <td><?php echo POINTS; ?></td>
        </tr>
    </thead>

    <tbody>
<?php
if ($totalRanks > 0) {

    // Loop pe 20 rezultate
    for ($i = $start; $i < ($start + 20); $i++) {

        if (isset($rankData[$i]['name']) && $rankData[$i] !== "pad") {

            // Highlight dacă e alianța căutată
            $rowClass = ($i === $search) ? ' class="hl"' : '';

            echo "<tr{$rowClass}>";
            echo "<td class=\"ra fc\">{$i}.</td>";
            echo "<td class=\"al\"><a href=\"allianz.php?aid=" . (int)$rankData[$i]['id'] . "\">" . htmlspecialchars($rankData[$i]['tag'], ENT_QUOTES, 'UTF-8') . "</a></td>";
            echo "<td class=\"pla\">" . (int)$rankData[$i]['players'] . "</td>";
            echo "<td class=\"av\">" . (int)$rankData[$i]['avg'] . "</td>";
            echo "<td class=\"po\">" . (int)$rankData[$i]['totalpop'] . "</td>";
            echo "</tr>";
        }
    }

} else {

    echo "<tr><td class=\"none\" colspan=\"5\">No alliance's found</td></tr>";

}
?>
    </tbody>
</table>

<?php
// Include search form
include("ranksearch.tpl");
?>