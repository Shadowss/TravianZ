<h5><img src="img/en/t2/newsbox1.gif" alt="<?php echo EDIT_NEWSBOX1; ?>"></h5>

<?php
/**
 * ==========================================================
 * TravianZ Newsbox1 - SAFE REFACTOR
 * ==========================================================
 * - păstrează logica originală
 * - reduce apeluri mysqli duplicate
 * - adaugă fallback-uri sigure
 * - compatibil PHP 5+ / 7+
 * ==========================================================
 */

// ======================================================
// ONLINE USERS QUERY (optimizat + fallback)
// ======================================================
$online_total = 0;

$online_query = mysqli_query(
    $database->dblink,
    "SELECT COUNT(*) AS Total 
     FROM " . TB_PREFIX . "users 
     WHERE timestamp > " . (time() - (60 * 10)) . " 
     AND tribe != 0 AND tribe != 4 AND tribe != 5"
);

if ($online_query) {
    $row = mysqli_fetch_assoc($online_query);
    if ($row && isset($row['Total'])) {
        $online_total = (int)$row['Total'];
    }
}

// ======================================================
// TOP PLAYER QUERY (cu LIMIT 1 + fallback)
// ======================================================
$top_username = '-';

$top_query = mysqli_query(
    $database->dblink,
    "SELECT username 
     FROM " . TB_PREFIX . "users 
     WHERE " . (INCLUDE_ADMIN ? '' : 'access < 8 AND ') . "
     id > 5 
     AND tribe <= 3 
     AND tribe > 0 
     ORDER BY oldrank ASC 
     LIMIT 1"
);

if ($top_query) {
    $row = mysqli_fetch_assoc($top_query);
    if ($row && !empty($row['username'])) {
        $top_username = $row['username'];
    }
}
?>

<div class="news">
<table width="100%">

<tr>
<td align="left"><b><?php echo TZ_ONLINE_USERS; ?></b></td>
<td>: <font color="Red"><b><?php echo $online_total; ?> users</b></font></td>
</tr>

<tr>
<td><b><?php echo CONF_SERV_SERVSPEED; ?></b></td>
<td><b>: <font color="Red"><?php echo SPEED; ?>x</font></b></td>
</tr>

<tr>
<td><b><?php echo CONF_SERV_TROOPSPEED; ?></b></td>
<td><b>: <font color="Red"><?php echo INCREASE_SPEED; ?>x</font></b></td>
</tr>

<tr>
<td><b><?php echo CONF_SERV_EVASIONSPEED; ?></b></td>
<td><b>: <font color="Red"><?php echo EVASION_SPEED; ?></font></b></td>
</tr>

<tr>
<td><b><?php echo CONF_SERV_MAPSIZE; ?></b></td>
<td><b>: <font color="Red"><?php echo WORLD_MAX; ?>x<?php echo WORLD_MAX; ?></font></b></td>
</tr>

<tr>
<td><b><?php echo TZ_VILLAGE_EXP; ?></b></td>
<td><b>: <font color="Red">
<?php
// păstrăm exact logica originală
if (CP == 0) {
    echo "Fast";
} else if (CP == 1) {
    echo "Slow";
}
?>
</font></b></td>
</tr>

<tr>
<td><b><?php echo TZ_BEGINNERS_PROT; ?></b></td>
<td><b>: <font color="Red"><?php echo (PROTECTION / 3600); ?> <?php echo TZ_HRS; ?></font></b></td>
</tr>

<tr>
<td><b><?php echo CONF_SERV_MEDALINTERVAL; ?></b></td>
<td><b>: <font color="Red">
<?php
// logică identică, doar structurată mai clar
if (MEDALINTERVAL >= 86400) {
    echo (MEDALINTERVAL / 86400) . ' Days';
} else {
    echo (MEDALINTERVAL / 3600) . ' Hours';
}
?>
</font></b></td>
</tr>

<tr>
<td><b><?php echo TZ_SERVER_START; ?></b></td>
<td><b>: <font color="Red"><?php echo START_DATE; ?></font></b></td>
</tr>

<tr>
<td><b><?php echo CONF_SERV_PEACESYST; ?></b></td>
<td><b>: <font color="Red">
<?php
// fallback safe pentru index
$peaceTypes = array("None", "Normal", "Christmas", "New Year", "Easter");
echo isset($peaceTypes[PEACE]) ? $peaceTypes[PEACE] : "Unknown";
?>
</font></b></td>
</tr>

<tr>
<td><b><?php echo TZ_BEST_PLAYER; ?></b></td>
<td><b>: <font color="Red"><?php echo $top_username; ?></font></b></td>
</tr>

</table>
</div>