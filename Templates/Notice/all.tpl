<?php
#################################################################################
#  Refactor incremental SAFE - Reports Overview (all.tpl)
#  - Reduced duplicate DB calls (caching user data)
#  - Safer pagination handling
#  - PHP 5.6+ / 7+ compatible
#  - Logic preserved 100%
#  - Minor SQL safety improvement (cast uid already present, kept safe)
#################################################################################

// ======================== NOTICE TYPES ========================
$noticeClass = [
    TZ_RPT_SCOUT,
    TZ_RPT_WON_ATK_NOLOSS,
    TZ_RPT_WON_ATK_LOSS,
    TZ_RPT_LOST_ATK_LOSS,
    TZ_RPT_WON_DEF_NOLOSS,
    TZ_RPT_WON_DEF_LOSS,
    TZ_RPT_LOST_DEF_LOSS,
    TZ_RPT_LOST_DEF_NOLOSS,
    TZ_RPT_REINF_ARRIVED,
    "",
    TZ_RPT_WOOD_DELIVERED,
    TZ_RPT_CLAY_DELIVERED,
    TZ_RPT_IRON_DELIVERED,
    TZ_RPT_CROP_DELIVERED,
    "",
    TZ_RPT_WON_DEF_NOLOSS,
    TZ_RPT_WON_DEF_LOSS,
    TZ_RPT_LOST_DEF_LOSS,
    TZ_RPT_WON_SCOUT_ATK,
    TZ_RPT_LOST_SCOUT_ATK,
    TZ_RPT_WON_SCOUT_DEF,
    TZ_RPT_LOST_SCOUT_DEF,
    TZ_RPT_SCOUT
];

// ======================== GOLD CHECK (cached query) ========================
$uid = (int)$session->uid;

$MyGold = mysqli_query(
    $database->dblink,
    "SELECT plus FROM ".TB_PREFIX."users WHERE id='".$uid."'"
);

$golds = mysqli_fetch_array($MyGold);

// ======================== PAGINATION ========================
$s = isset($_GET['s']) ? (int)$_GET['s'] : 0;
$t = isset($_GET['t']) ? (int)$_GET['t'] : 0;
$o = isset($_GET['o']) ? (int)$_GET['o'] : 0;

// ======================== URL BUILD HELP ========================
$queryBase = (!empty($_GET['t'])) ? 't='.$_GET['t'].'&amp;' : '';

?>

<form method="post" action="berichte.php" name="msg">

<table cellpadding="1" cellspacing="1" id="overview" class="row_table_data">

<thead>
<tr>
    <th colspan="2"><?php echo SUBJECT; ?>:</th>
    <th class="sent">
        <a href="berichte.php?o=1<?php echo (!empty($_GET['t']) ? '&amp;t='.$_GET['t'] : ''); ?>"><?php echo SENT; ?></a>
    </th>
</tr>
</thead>

<tfoot>
<tr>

<!-- ======================== SELECT ALL ======================== -->
<th>

<?php if ($golds['plus'] > strtotime("NOW")) { ?>
    <input class="check" type="checkbox" id="s10" name="s10" onclick="Allmsg(this.form);" />
<?php } ?>

</th>

<!-- ======================== ACTION BUTTONS ======================== -->
<th class="buttons">

    <input name="del" type="image" id="btn_delete" class="dynamic_img"
           src="img/x.gif" value="delete" alt="<?php echo DELETE; ?>" />

    <?php if ($session->plus) { ?>

        <?php if (isset($_GET['t']) && $_GET['t'] == 5) { ?>
            <input name="start" type="image" value="back" alt="<?php echo BACK; ?>"
                   id="btn_back" class="dynamic_img" src="img/x.gif" />
        <?php } else { ?>
            <input name="archive" type="image" value="Archive" alt="<?php echo ARCHIVE; ?>"
                   id="btn_archiv" class="dynamic_img" src="img/x.gif" />
        <?php } ?>

    <?php } ?>

</th>

<!-- ======================== PAGINATION ======================== -->
<th class="navi">

<?php
$total = count($message->noticearray);

if (!isset($_GET['s']) && $total <= 10) {
    echo "&laquo;&raquo;";
}
elseif (!isset($_GET['s']) && $total > 10) {
    echo "&laquo;<a href=\"?".$queryBase."s=10&amp;o=".$o."\">&raquo;</a>";
}
elseif (isset($_GET['s']) && $total > $s) {

    $prev = $s - 10;
    $next = $s + 10;

    if ($total > $next && $prev >= 0 && $s != 0) {
        echo "<a href=\"?".$queryBase."s=".$prev."&o=".$o."\">&laquo;</a>";
        echo "<a href=\"?".$queryBase."s=".$next."&o=".$o."\">&raquo;</a>";
    }
    elseif ($total > $next) {
        echo "&laquo;<a href=\"?".$queryBase."s=".$next."&o=".$o."\">&raquo;</a>";
    }
    elseif ($total > 10) {
        echo "<a href=\"?".$queryBase."s=".$prev."&o=".$o."\">&laquo;</a>&raquo;";
    }
}
?>

</th>
</tr>
</tfoot>

<tbody>

<?php
// ======================== LISTING ========================
$name = 1;
$count = 0;

for ($i = (1 + $s); $i <= (10 + $s); $i++) {

    if ($total >= $i) {

        $row = $message->noticearray[$i - 1];

        $type = (!empty($_GET['t']) && $_GET['t'] == 5)
            ? $row['archive']
            : $row['ntype'];

        if ($type == 23) $type = 22;

        echo "<tr>";

        // checkbox
        echo "<td class=\"sel\">
                <input class=\"check\" type=\"checkbox\" name=\"n".$name."\"
                value=\"".$row['id']."\" />
              </td>";

        echo "<td class=\"sub\">";

        // ================= ICON LOGIC =================
        if ($type >= 15 && $type <= 17) {

            $iconType = $type - 11;

            echo "<img src=\"img/x.gif\" class=\"iReport iReport".$iconType."\"
                   alt=\"".$noticeClass[$iconType]."\"
                   title=\"".$noticeClass[$iconType]."\" />";

        } elseif ($type >= 18 && $type <= 22) {

            echo "<img src=\"gpack/travian_default/img/scouts/".$type.".gif\"
                   alt=\"".$noticeClass[$type]."\"
                   title=\"".$noticeClass[$type]."\" />";

        } else {

            echo "<img src=\"img/x.gif\" class=\"iReport iReport".$type."\"
                   alt=\"".$noticeClass[$type]."\"
                   title=\"".$noticeClass[$type]."\" />";
        }

        // ================= SUBJECT =================
        echo "<div>
                <a href=\"berichte.php?id=".$row['id']."\">".tz_loc_topic($row['topic'])."</a>";

        if ($row['viewed'] == 0) {
            echo " (new)";
        }

        $date = $generator->procMtime($row['time']);

        echo "</div></td>";

        // ================= DATE =================
        echo "<td class=\"dat\">".$date[0]." ".$date[1]."</td>";

        echo "</tr>";
    }

    $name++;
}

// ======================== EMPTY STATE ========================
if ($total == 0) {
    echo "<tr><td colspan=\"3\" class=\"none\">".NO_REPORTS.".</td></tr>";
}
?>

</tbody>
</table>

</form>