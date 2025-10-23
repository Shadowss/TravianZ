<?php
/**
 * crop_builder.php
 * Admin UI to build/rebuild the precomputed croppers table (9c/15c + best oasis bonus).
 * The UI is rendered inside the page’s main content area with normal “player” styling.
 */

use App\Utils\AccessLogger;

include_once("GameEngine/Generator.php");
$start_timer = $generator->pageLoadTimeStart();

include_once("GameEngine/Session.php");
include_once("GameEngine/config.php");
include_once("GameEngine/Database.php");
include_once("GameEngine/Village.php");

AccessLogger::logRequest();

// ---------- Admin gate ----------
if (!isset($session) || !isset($session->access) || (int)$session->access < 8) {
    header('Location: dorf1.php');
    exit;
}

// ---------- Setup ----------
@session_start();

$TBP = defined('TB_PREFIX') ? TB_PREFIX : 's1_';
$CROP_TABLE = $TBP . 'croppers';
$WDATA = $TBP . 'wdata';

// Build an absolute-safe asset prefix for CSS/JS
$assetBase = $session->gpack ?: GP_LOCATE;
$assetBase = '/'.ltrim($assetBase, '/');

// CSRF
if (empty($_SESSION['csrf_cb'])) {
    $_SESSION['csrf_cb'] = bin2hex(random_bytes(16));
}
$csrf = $_SESSION['csrf_cb'];

function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

// Ensure table exists (minimal schema, unsigned tinyints)
mysqli_query($database->dblink, "CREATE TABLE IF NOT EXISTS `$CROP_TABLE` (
  `wref` INT UNSIGNED NOT NULL PRIMARY KEY,
  `x` INT NOT NULL,
  `y` INT NOT NULL,
  `fieldtype` TINYINT UNSIGNED NOT NULL,
  `best_oasis_bonus` TINYINT UNSIGNED NOT NULL,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CHECK (`best_oasis_bonus` IN (0,25,50,75,100,125,150))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

// Helpful indexes (ignore errors if already exist)
@mysqli_query($database->dblink, "CREATE INDEX `idx_ft_bonus_xy` ON `$CROP_TABLE` (`fieldtype`, `best_oasis_bonus`, `x`, `y`)");
@mysqli_query($database->dblink, "CREATE INDEX `idx_xy` ON `$CROP_TABLE` (`x`, `y`)");
@mysqli_query($database->dblink, "CREATE INDEX `idx_bonus` ON `$CROP_TABLE` (`best_oasis_bonus`)");

// ---------- Helpers ----------
function worldSizeLabel(): string {
    if (defined('WORLD_MIN') && defined('WORLD_MAX')) {
        $min = (int)WORLD_MIN; $max = (int)WORLD_MAX;
        return ($max - $min + 1) . "×" . ($max - $min + 1) . " (" . $min . " .. " . $max . ")";
    }
    if (defined('WORLD_MAX')) {
        $max = (int)WORLD_MAX; $min = -$max;
        return ($max - $min + 1) . "×" . ($max - $min + 1) . " (" . $min . " .. " . $max . ")";
    }
    return "unknown";
}

function getCounts($db, $WDATA, $CROP_TABLE) {
    $c1 = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) c FROM `$WDATA` WHERE fieldtype IN (1,6)"));
    $c2 = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) c FROM `$CROP_TABLE`"));
    $lu = mysqli_fetch_assoc(mysqli_query($db, "SELECT MAX(updated_at) lu FROM `$CROP_TABLE`"));
    return [
        'croppers_world' => (int)($c1['c'] ?? 0),
        'croppers_table' => (int)($c2['c'] ?? 0),
        'last_updated'   => $lu['lu'] ?? null,
    ];
}

// stream log
function startStreaming() {
    @ini_set('output_buffering','off');
    @ini_set('zlib.output_compression', 0);
    while (ob_get_level()) { @ob_end_flush(); }
    ob_implicit_flush(true);
    echo "<pre id=\"log\" style=\"background:#0b0f17;color:#d7e1f8;padding:12px;border-radius:12px;max-height:60vh;overflow:auto;\">";
    echo htmlspecialchars("[".date('H:i:s')."] Croppers builder started")."\n";
    flush();
}
function logLine($msg) { echo htmlspecialchars("[".date('H:i:s')."] ".$msg)."\n"; flush(); }
function endStreaming() { echo "</pre>"; flush(); }

// ---------- Actions ----------
$action = $_POST['action'] ?? null;
$okCsrf = isset($_POST['csrf']) && hash_equals($_SESSION['csrf_cb'], $_POST['csrf']);
$notice = null;

if ($action && !$okCsrf) {
    $notice = "Invalid CSRF token. Please reload the page.";
    $action = null;
}

if ($action === 'truncate') {
    mysqli_query($database->dblink, "TRUNCATE TABLE `$CROP_TABLE`");
    $notice = "Croppers table truncated.";
}
if ($action === 'reindex') {
    @mysqli_query($database->dblink, "DROP INDEX `idx_ft_bonus_xy` ON `$CROP_TABLE`");
    @mysqli_query($database->dblink, "DROP INDEX `idx_xy` ON `$CROP_TABLE`");
    @mysqli_query($database->dblink, "DROP INDEX `idx_bonus` ON `$CROP_TABLE`");
    @mysqli_query($database->dblink, "CREATE INDEX `idx_ft_bonus_xy` ON `$CROP_TABLE` (`fieldtype`, `best_oasis_bonus`, `x`, `y`)");
    @mysqli_query($database->dblink, "CREATE INDEX `idx_xy` ON `$CROP_TABLE` (`x`, `y`)");
    @mysqli_query($database->dblink, "CREATE INDEX `idx_bonus` ON `$CROP_TABLE` (`best_oasis_bonus`)");
    $notice = "Indexes rebuilt.";
}
if ($action === 'estimate') {
    $notice = "Estimated counts refreshed.";
}

$stats = getCounts($database->dblink, $WDATA, $CROP_TABLE);
$worldLabel = worldSizeLabel();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo SERVER_NAME ?> - Mass Message</title>
	<link rel="shortcut icon" href="favicon.ico"/>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

	<script src="mt-full.js?0ac37" type="text/javascript"></script>
	<script src="unx.js?f4b7h" type="text/javascript"></script>
	<script src="new.js?0ac37" type="text/javascript"></script>
	<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />
	<?php
	if($session->gpack == null || GP_ENABLE == false) {
	echo "
	<link href='".GP_LOCATE."travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='".GP_LOCATE."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
	} else {
	echo "
	<link href='".$session->gpack."travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='".$session->gpack."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
	}
	?>

	<script language="javascript" type="text/javascript">
	function smilie(text) {
		document.myform.message.value += text;
	}
	</script>

	<script language="javascript">
	function toggleDisplay(e){
		element = document.getElementById(e).style;
		element.display == 'none' ? element.display = 'block' :
		element.display='none';
	}
	</script>

	<script type="text/javascript">

		window.addEvent('domready', start);
	</script>
		<?php
	if($session->gpack == null || GP_ENABLE == false) {
	echo "
	<link href='".GP_LOCATE."travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='".GP_LOCATE."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
	} else {
	echo "
	<link href='".$session->gpack."travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='".$session->gpack."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
	}
	?>
	<script type="text/javascript">
	window.addEvent('domready', start);
	</script>
    <style>
        .cb-container{ max-width:980px;margin:0 auto;padding:0 12px; }
        .cb-grid{ display:grid; grid-template-columns:1fr 1fr; gap:12px; }
        .cb-card{ background:#fff;border:1px solid #dcdde1;border-radius:12px;padding:14px; box-shadow:0 1px 2px rgba(0,0,0,.04); }
        .cb-title{ font-size:20px;margin:0 0 8px 0; }
        .cb-muted{ color:#666;font-size:12px; }
        .cb-kpis{ display:flex; gap:16px; margin-top:8px; flex-wrap:wrap; }
        .cb-kpi{ background:#f7f9fb;border-radius:10px;padding:10px 12px; border:1px solid #e6ecf3; }
        .cb-actions form{ display:flex; flex-wrap:wrap; gap:8px; align-items:center; }
        .cb-btn{ background:#2f7d32;color:#fff;border:none;border-radius:10px;padding:10px 14px;cursor:pointer; }
        .cb-btn.red{ background:#b23b3b; }
        .cb-btn.gray{ background:#5c6b7a; }
        .cb-input{ padding:8px 10px;border:1px solid #c9d3df;border-radius:10px;width:120px; }
        .cb-note{ background:#fff4cc;border:1px solid #f5d36b;border-radius:10px;padding:10px 12px;margin-top:8px; }
        .cb-notice{ background:#e8f6ff;border:1px solid #b3e0ff;color:#0b5380;border-radius:10px;padding:10px 12px;margin:12px 0; }
        @media (max-width: 900px){ .cb-grid{ grid-template-columns:1fr; } }
        pre#log { margin-top:14px; }
    </style>
</head>

<body class="v35 ie ie8">
<div class="wrapper">
    <img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" />
    <div id="dynamic_header"></div>
    <?php include("Templates/header.tpl"); ?>
    <div id="mid">
        <?php include("Templates/menu.tpl"); ?>

        <!-- IMPORTANT: Use the normal game content style instead of "login" -->
        <div id="content" class="player">
            <div class="cb-container">
                <h1 style="text-align:center;margin:12px 0 16px;">Build crop finder</h1>

                <?php if ($notice): ?>
                    <div class="cb-notice"><?php echo h($notice); ?></div>
                <?php endif; ?>

                <div class="cb-grid">
                    <div class="cb-card">
                        <h3 class="cb-title">Status</h3>
                        <div class="cb-muted">World: <?php echo h($worldLabel); ?></div>
                        <div class="cb-kpis">
                            <div class="cb-kpi"><b>9c/15c in map:</b> <?php echo number_format($stats['croppers_world']); ?></div>
                            <div class="cb-kpi"><b>Rows in table:</b> <?php echo number_format($stats['croppers_table']); ?></div>
                            <div class="cb-kpi"><b>Last updated:</b> <?php echo $stats['last_updated'] ? h($stats['last_updated']) : '—'; ?></div>
                        </div>
                        <div class="cb-note">
                            The croppers table stores only <b>wref,x,y,fieldtype,best_oasis_bonus</b>.
                            Ownership and occupied status are pulled live from <code>vdata/users</code> by the finder.
                        </div>
                    </div>

                    <div class="cb-card cb-actions">
                        <h3 class="cb-title">Actions</h3>
                        <form method="post">
                            <input type="hidden" name="csrf" value="<?php echo h($csrf); ?>" />
                            <label>Batch size:</label>
                            <input class="cb-input" type="number" min="1000" max="20000" step="1000" name="batch" value="<?php echo isset($_POST['batch']) ? (int)$_POST['batch'] : 5000; ?>" />
                            <button class="cb-btn" name="action" value="build">Build / Rebuild</button>
                            <button class="cb-btn gray" name="action" value="estimate" type="submit">Estimate</button>
                            <button class="cb-btn gray" name="action" value="reindex" type="submit">Reindex</button>
                            <button class="cb-btn red" name="action" value="truncate" type="submit" onclick="return confirm('Really truncate the table?');">Truncate</button>
                        </form>
                        <div class="cb-muted" style="margin-top:8px;">
                            Building streams progress below. You can leave this page; the process stops when the request ends.
                        </div>
                    </div>
                </div>

<?php
// Stream build logs INSIDE the content area
if ($action === 'build' && $okCsrf) {
    $batch = max(1000, min(20000, (int)($_POST['batch'] ?? 5000)));
    startStreaming();

    $cnt = mysqli_fetch_assoc(mysqli_query($database->dblink, "SELECT COUNT(*) AS c FROM `$WDATA` WHERE `fieldtype` IN (1,6)"));
    $target = (int)($cnt['c'] ?? 0);
    logLine("Detected $target croppers.");

    $offset = 0; $total = 0;
    while (true) {
        $sql = "SELECT id AS wref, x, y, fieldtype
                FROM `$WDATA`
                WHERE `fieldtype` IN (1,6)
                LIMIT $offset, $batch";
        $res = mysqli_query($database->dblink, $sql);
        if (!$res) { logLine('Query failed: '.mysqli_error($database->dblink)); break; }

        $rows = [];
        while ($r = mysqli_fetch_assoc($res)) { $rows[] = $r; }
        if (!$rows) break;

        $values = [];
        foreach ($rows as $r) {
            $x = (int)$r['x']; $y = (int)$r['y'];
            $bonus = (int)$database->getBestOasisCropBonus($x, $y);
            if (!in_array($bonus, [0,25,50,75,100,125,150], true)) {
                $bonus = max(0, min(150, $bonus));
            }
            $values[] = sprintf("(%d,%d,%d,%d,%d)",
                (int)$r['wref'], $x, $y, (int)$r['fieldtype'], $bonus);
        }
        if ($values) {
            $sql = "REPLACE INTO `$CROP_TABLE`
                    (`wref`,`x`,`y`,`fieldtype`,`best_oasis_bonus`)
                    VALUES ".implode(',', $values);
            if (!mysqli_query($database->dblink, $sql)) {
                logLine('Upsert failed: '.mysqli_error($database->dblink));
                break;
            }
        }
        $countThis = count($rows);
        $total += $countThis;
        $offset += $batch;
        logLine("Processed $total / $target");
    }

    @mysqli_query($database->dblink, "ANALYZE TABLE `$CROP_TABLE`");
    logLine("Analyze complete.");
    logLine("Done.");
    endStreaming();

    // Refresh stats after build
    $stats = getCounts($database->dblink, $WDATA, $CROP_TABLE);
}
?>
            </div>
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

    <?php include("Templates/footer.tpl"); include("Templates/res.tpl"); ?>

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
