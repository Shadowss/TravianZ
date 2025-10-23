<?php
// crop_finder_fast.php  — fast crop finder using precomputed <TB_PREFIX>croppers
// Fixes:
//  - Uses WORLD_MIN/WORLD_MAX from config if present (works for 0..N or -W..+W)
//  - If not defined in config, auto-detects bounds from DB
//  - Larger window cap + extra expansion
//  - Global fallback so it never returns only a few rows

include_once("GameEngine/Generator.php");
$start_timer = $generator->pageLoadTimeStart();
include_once("GameEngine/config.php");
use App\Utils\AccessLogger;
include_once("GameEngine/Village.php");
AccessLogger::logRequest();

if ($session->goldclub == 0) { header("Location: plus.php?id=3"); exit; }

// Tables
$TBP = defined('TB_PREFIX') ? TB_PREFIX : 's1_';
$CROP_TABLE = $TBP . 'croppers';
$VDATA = $TBP . 'vdata';
$USERS = $TBP . 'users';

$RENDER_MAX = 100;

// ---------- POST -> GET ----------
if (!empty($_POST['type'])) {
    $x = isset($_POST['x']) ? preg_replace("/[^0-9-]/", "", $_POST['x']) : '0';
    $y = isset($_POST['y']) ? preg_replace("/[^0-9-]/", "", $_POST['y']) : '0';
    $b = isset($_POST['bonus_getreide']) ? preg_replace("/[^0-9a-zA-Z]/", "", $_POST['bonus_getreide']) : 'all';
    if ($_POST['type'] == 15)      header("Location: " . $_SERVER['PHP_SELF'] . "?s=1&x=$x&y=$y&b=$b");
    elseif ($_POST['type'] == 9)   header("Location: " . $_SERVER['PHP_SELF'] . "?s=2&x=$x&y=$y&b=$b");
    else                           header("Location: " . $_SERVER['PHP_SELF'] . "?s=3&x=$x&y=$y&b=$b");
    exit;
}

// ---------- Helpers ----------
/**
 * Wrap-aware BETWEEN that works for arbitrary [min..max] (e.g. 0..49 or -300..300)
 */
function betweenWrapFlexible($col, $center, $R, $min, $max) {
    $span = $max - $min + 1;
    $lo = $center - $R;
    $hi = $center + $R;
    // normalize to [min,max]
    $norm = function($v) use ($min,$span) {
        $n = ($v - $min) % $span;
        if ($n < 0) $n += $span;
        return $min + $n;
    };
    $loN = $norm($lo);
    $hiN = $norm($hi);
    if ($loN <= $hiN) return "($col BETWEEN $loN AND $hiN)";
    return "(($col BETWEEN $min AND $hiN) OR ($col BETWEEN $loN AND $max))";
}

// ---------- Coordinates ----------
if (!empty($_GET['x']) && !empty($_GET['y']) && is_numeric($_GET['x']) && is_numeric($_GET['y'])) {
    $coor2 = ['x'=>(int)$_GET['x'], 'y'=>(int)$_GET['y']];
} else {
    $wref2 = $village->wid;
    $coor2 = $database->getCoor($wref2);
}
$startX = isset($coor2['x']) ? (int)$coor2['x'] : 0;
$startY = isset($coor2['y']) ? (int)$coor2['y'] : 0;

// ---------- UI selections ----------
// UI selections
$selBonus = isset($_GET['b']) ? $_GET['b'] : 'all';
$selType  = (!empty($_GET['s'])) ? (int)$_GET['s'] : 0;
$minBonus = ($selBonus !== 'all') ? (int)$selBonus : null;
$fieldWhere = ($selType === 1) ? "6" : (($selType === 2) ? "1" : "1,6");
$bonusCond  = is_null($minBonus) ? "1" : ("c.best_oasis_bonus >= ".(int)$minBonus);

// Only run the queries after the user pressed Search (i.e., we have s, x, y in the URL)
$rows = [];
$out = [];
$searchTriggered = isset($_GET['s']) && isset($_GET['x']) && isset($_GET['y']);

if ($searchTriggered) {
    // --- Windowed fetch with bigger cap and one more expansion ---
    $R    = 40;         // start radius
    $tries= 0;
    $CAP  = 2000;       // increased cap per window

    do {
        $tries++;
        $condX = betweenWrapFlexible('c.x', $startX, $R, $MIN_X, $MAX_X);
        $condY = betweenWrapFlexible('c.y', $startY, $R, $MIN_Y, $MAX_Y);

        $sql = "SELECT c.wref, c.x, c.y, c.fieldtype, c.best_oasis_bonus
                FROM `$CROP_TABLE` c
                WHERE c.fieldtype IN ($fieldWhere) AND $bonusCond AND $condX AND $condY
                LIMIT $CAP";
        $res = mysqli_query($database->dblink, $sql);

        $rows = [];
        if ($res) {
            while ($r = mysqli_fetch_assoc($res)) {
                $r['__dist'] = $database->getDistance($startX, $startY, (int)$r['x'], (int)$r['y']);
                $rows[] = $r;
            }
        }

        if (count($rows) < $RENDER_MAX && $tries < 4) { // 40 -> 80 -> 160 -> 320
            $R *= 2;
        } else {
            break;
        }
    } while (true);

    // --- Global fallback if window was too sparse ---
    if (count($rows) < $RENDER_MAX) {
        $sql = "SELECT c.wref, c.x, c.y, c.fieldtype, c.best_oasis_bonus
                FROM `$CROP_TABLE` c
                WHERE c.fieldtype IN ($fieldWhere) AND $bonusCond
                LIMIT 5000";
        $res = mysqli_query($database->dblink, $sql);
        $rows = [];
        if ($res) {
            while ($r = mysqli_fetch_assoc($res)) {
                $r['__dist'] = $database->getDistance($startX, $startY, (int)$r['x'], (int)$r['y']);
                $rows[] = $r;
            }
        }
    }

    // Sort by distance and keep first RENDER_MAX
    usort($rows, function($a,$b){ return $a['__dist'] <=> $b['__dist']; });
    $out = array_slice($rows, 0, $RENDER_MAX);
}

// Live owner info for visible rows
$wrefs = array_map(function($r){ return (int)$r['wref']; }, $out);
$owners = [];
if ($wrefs) {
    $in = implode(',', array_unique($wrefs));
    $sql = "SELECT v.wref, v.name AS vname, v.owner AS owner_id, u.username
            FROM `$VDATA` v
            JOIN `$USERS` u ON u.id = v.owner
            WHERE v.wref IN ($in)";
    $res = mysqli_query($database->dblink, $sql);
    if ($res) while ($row = mysqli_fetch_assoc($res)) { $owners[(int)$row['wref']] = $row; }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo SERVER_NAME ?> - Crop Finder</title>
<link rel="shortcut icon" href="favicon.ico"/>
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="imagetoolbar" content="no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<script src="mt-full.js?0faab" type="text/javascript"></script>
<script src="unx.js?f4b7h" type="text/javascript"></script>
<script src="new.js?0faab" type="text/javascript"></script>
<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css" />
<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />
<?php if($session->gpack == null || GP_ENABLE == false) {
    echo " <link href='".GP_LOCATE."travian.css?e21d2' rel='stylesheet' type='text/css' />";
    echo " <link href='".GP_LOCATE."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
} else {
    echo " <link href='".$session->gpack."travian.css?e21d2' rel='stylesheet' type='text/css' />";
    echo " <link href='".$session->gpack."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
} ?>
<script type="text/javascript">window.addEvent('domready', start);</script>
</head>
<body class="v35 ie ie8">
<div class="wrapper">
<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" />
<div id="dynamic_header"></div>
<?php include ("Templates/header.tpl"); ?>
<div id="mid">
<?php include ("Templates/menu.tpl"); ?>

<div id="content" class="player">
<h1>Crop Finder</h1>
<div style="text-align: center">
    <img width="200" src="gpack/travian_default/img/g/f6.jpg" />
    <img width="200" src="gpack/travian_default/img/g/f1.jpg" />
</div>
<br /><br />
<form action="<?php echo $_SERVER['PHP_SELF']; ?>?s" method="post">
<table>
<tr>
  <td width="120">Cropper Type:</td>
  <td width="400">
    <input type="radio" class="radio" name="type" value="15" <?php if ($selType === 1) echo 'checked="checked"'; ?> /> 15 crop
    <input type="radio" class="radio" name="type" value="9"  <?php if ($selType === 2) echo 'checked="checked"'; ?> /> 9 crop
    <input type="radio" class="radio" name="type" value="both" <?php if ($selType === 3 || $selType === 0) echo 'checked="checked"'; ?> /> both<br />
  </td>
</tr>
<tr>
  <td>Oasis Crop Bonus (min):</td>
  <td>
    <select class="dropdown" name="bonus_getreide">
      <option value="all"  <?php if($selBonus==='all')  echo 'selected="selected"'; ?>>either</option>
      <option value="25"   <?php if($selBonus==='25')   echo 'selected="selected"'; ?>>+25%</option>
      <option value="50"   <?php if($selBonus==='50')   echo 'selected="selected"'; ?>>+50%</option>
      <option value="75"   <?php if($selBonus==='75')   echo 'selected="selected"'; ?>>+75%</option>
      <option value="100"  <?php if($selBonus==='100')  echo 'selected="selected"'; ?>>+100%</option>
      <option value="125"  <?php if($selBonus==='125')  echo 'selected="selected"'; ?>>+125%</option>
      <option value="150"  <?php if($selBonus==='150')  echo 'selected="selected"'; ?>>+150%</option>
    </select>
  </td>
</tr>
<tr>
  <td>Start position:</td>
  <td>x: <input type="text" name="x" value="<?php print $startX; ?>" size="4" />
      y: <input type="text" name="y" value="<?php print $startY; ?>" size="4" /></td>
</tr>
<tr>
  <td colspan="2"><button type="submit" class="trav_buttons" value="Search">Search</button></td>
</tr>
</table>
</form>

<?php
// Debug panel (toggle with ?debug=1)
if (!empty($_GET['debug'])) {
    echo "<div style='margin:8px 0;padding:6px 8px;background:#fffbe6;border:1px solid #ffe58f;border-radius:8px'>";
    echo "<strong>Debug:</strong> bounds=[$MIN_X..$MAX_X]x[$MIN_Y..$MAX_Y], R=$R, tries=$tries, fetched=".count($rows).", render=".count($out).", type={$selType}, minBonus=".($minBonus??'all');
    echo "</div>";
}
?>
<?php if ($searchTriggered) { ?>
<table id="member">
<thead>
<tr><th colspan='6'>Crop Finder - <?php if($selType === 1) echo '15c'; elseif($selType === 2) echo '9c'; else echo '9c and 15c'; if($selBonus==='all') echo ' and any bonus'; elseif($selBonus==='25') echo ' and atleast 25% bonus';
elseif($selBonus==='50') echo ' and atleast 50% bonus'; elseif($selBonus==='75') echo ' and atleast 75% bonus'; elseif($selBonus==='100') echo ' and atleast 100% bonus'; elseif($selBonus==='125') echo ' and atleast 125% bonus'; else echo ' and atleast 150% bonus';
 ?></th></tr>
<tr>
  <td>Type</td>
  <td>Coordinates</td>
  <td>Owner</td>
  <td>Occupied</td>
  <td>Distance</td>
  <td>Oasis</td>
</tr>
</thead>
<tbody>
<?php
if (empty($out)) {
    echo "<tr><td colspan='6' style='text-align:center; padding:10px;'>
            <em style=\"color:#999;\">No crops fields found for the selected filters.</em>
          </td></tr>";
} else {
    foreach ($out as $row) {
        $field = ($row['fieldtype'] == 1) ? '9c' : '15c';
        $x=(int)$row['x']; $y=(int)$row['y']; $id=(int)$row['wref'];
        $ov = $owners[$id] ?? null;
        $isOcc = $ov !== null;
        echo "<tr><td>$field</td>";
        if (!$isOcc) {
            echo "<td><a href=\"karte.php?d=".$id."&c=".$generator->getMapCheck($id)."\">".ABANDVALLEY." ($x|$y)</a></td>";
            echo "<td>-</td>";
            echo "<td><b><font color=\"green\">".UNOCCUPIED."</font></b></td>";
        } else {
            $vname = htmlspecialchars($ov['vname'] ?? '', ENT_QUOTES, 'UTF-8');
            $owner = (int)($ov['owner_id'] ?? 0);
            $uname = htmlspecialchars($ov['username'] ?? '', ENT_QUOTES, 'UTF-8');
            echo "<td><a href=\"karte.php?d=".$id."&c=".$generator->getMapCheck($id)."\">".$vname." ($x|$y)</a></td>";
            echo "<td><a href=\"spieler.php?uid=".$owner."\">".$uname."</a></td>";
            echo "<td><b><font color=\"red\">".OCCUPIED."</font></b></td>";
        }
        echo "<td><div style=\"text-align: center\">".(int)$row['__dist']."</div></td>";
        echo "<td>+".(int)$row['best_oasis_bonus']."%</td>";
        echo "</tr>";
    }
}
?>
</tbody>

</table>
<?php } ?>
</div>

<br /><br /><br /><br />
<div id="side_info">
<?php
include("Templates/multivillage.tpl");
include("Templates/quest.tpl");
include("Templates/news.tpl");
if(!NEW_FUNCTIONS_DISPLAY_LINKS) {
    echo "<br><br><br><br>";
    include("Templates/links.tpl");
}
?>
</div>
<div class="clear"></div>
</div>
<div class="footer-stopper"></div>
<div class="clear"></div>
<?php include ("Templates/footer.tpl"); include ("Templates/res.tpl"); ?>
<div id="stime">
<div id="ltime">
<div id="ltimeWrap">
<?php echo CALCULATED_IN;?> <b><?php echo round(($generator->pageLoadTimeEnd()-$start_timer)*1000); ?></b> ms
<br /><?php echo SERVER_TIME;?> <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
</div>
</div>
</div>
<div id="ce"></div>
</div>
</body>
</html>
