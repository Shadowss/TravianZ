<?php
#################################################################################
##  Statistici grafice (Travian Plus)                                          ##
## --------------------------------------------------------------------------- ##
##  Arata evolutia in timp a contului: rangul, populatia si armata.             ##
##  Datele se strang pentru toti jucatorii, dar tabul se vede doar cu Plus.     ##
##                                                                             ##
##  Graficele sunt SVG generat aici, in PHP. Fara biblioteca externa si fara    ##
##  CDN: serverul poate fi in spatele unui proxy sau fara acces la internet,    ##
##  iar o pagina de statistici nu are ce cauta sa depinda de asa ceva.          ##
#################################################################################

// -------------------------------------------------
// ACCES: doar conturile cu Plus
// -------------------------------------------------
$psHasPlus = (isset($session->plus) && (int) $session->plus == 1);
$psEnabled = defined('NEW_FUNCTIONS_PLUS_STATISTICS') && NEW_FUNCTIONS_PLUS_STATISTICS;

/**
 * Deseneaza un grafic de linie ca SVG.
 *
 * $points  - lista de perechi [timestamp, valoare]
 * $invert  - true pentru rang, unde valoarea mai MICA e mai buna, deci axa se
 *            deseneaza invers (locul 1 sus)
 */
function ps_line_chart(array $points, $title, $color = '#7db72f', $invert = false)
{
    $w = 560;
    $h = 170;
    $padL = 52;
    $padR = 12;
    $padT = 22;
    $padB = 26;

    $out = '<svg width="' . $w . '" height="' . $h . '" viewBox="0 0 ' . $w . ' ' . $h . '"'
         . ' xmlns="http://www.w3.org/2000/svg" style="max-width:100%;height:auto;">';
    $out .= '<rect width="' . $w . '" height="' . $h . '" fill="#fff" stroke="#c9c9c9"/>';
    $out .= '<text x="8" y="14" font-family="Arial" font-size="11" font-weight="bold" fill="#333">'
          . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</text>';

    if (count($points) < 2) {
        $out .= '<text x="' . ($w / 2) . '" y="' . ($h / 2) . '" font-family="Arial" font-size="11"'
              . ' fill="#999" text-anchor="middle">'
              . htmlspecialchars(defined('PLUSSTATS_NODATA') ? PLUSSTATS_NODATA : 'Not enough data yet', ENT_QUOTES, 'UTF-8')
              . '</text></svg>';

        return $out;
    }

    $values = array_map(function ($p) { return (float) $p[1]; }, $points);
    $times  = array_map(function ($p) { return (int) $p[0]; }, $points);

    $minV = min($values);
    $maxV = max($values);

    // o linie perfect plata ar imparti la zero; ii dam putin spatiu
    if ($maxV - $minV < 0.0001) {
        $maxV = $minV + 1;
    }

    $minT = min($times);
    $maxT = max($times);
    $spanT = max(1, $maxT - $minT);

    $plotW = $w - $padL - $padR;
    $plotH = $h - $padT - $padB;

    $x = function ($t) use ($padL, $plotW, $minT, $spanT) {
        return $padL + ($t - $minT) / $spanT * $plotW;
    };
    $y = function ($v) use ($padT, $plotH, $minV, $maxV, $invert) {
        $frac = ($v - $minV) / ($maxV - $minV);

        // la rang, valoarea mica inseamna loc bun, deci o punem sus
        return $invert ? $padT + $frac * $plotH : $padT + (1 - $frac) * $plotH;
    };

    // grila si etichete pe axa verticala
    for ($i = 0; $i <= 3; $i++) {
        $v  = $minV + ($maxV - $minV) * $i / 3;
        $yy = $y($v);
        $out .= '<line x1="' . $padL . '" y1="' . round($yy, 1) . '" x2="' . ($w - $padR)
              . '" y2="' . round($yy, 1) . '" stroke="#eee" stroke-width="1"/>';
        $out .= '<text x="' . ($padL - 5) . '" y="' . (round($yy, 1) + 3) . '" font-family="Arial"'
              . ' font-size="9" fill="#888" text-anchor="end">' . number_format($v) . '</text>';
    }

    // linia propriu-zisa
    $d = '';

    foreach ($points as $i => $p) {
        $d .= ($i === 0 ? 'M' : 'L') . round($x($p[0]), 1) . ',' . round($y($p[1]), 1) . ' ';
    }

    // suprafata de sub linie, pentru lizibilitate
    $area = $d . 'L' . round($x($times[count($times) - 1]), 1) . ',' . ($padT + $plotH)
          . ' L' . round($x($times[0]), 1) . ',' . ($padT + $plotH) . ' Z';

    $out .= '<path d="' . $area . '" fill="' . $color . '" fill-opacity="0.15"/>';
    $out .= '<path d="' . $d . '" fill="none" stroke="' . $color . '" stroke-width="2"/>';

    // punctele de capat, cu valorile
    $first = $points[0];
    $lastP = $points[count($points) - 1];

    foreach (array($first, $lastP) as $p) {
        $out .= '<circle cx="' . round($x($p[0]), 1) . '" cy="' . round($y($p[1]), 1)
              . '" r="3" fill="' . $color . '"/>';
    }

    // datele de la capete
    $out .= '<text x="' . $padL . '" y="' . ($h - 8) . '" font-family="Arial" font-size="9" fill="#888">'
          . date('d.m', $minT) . '</text>';
    $out .= '<text x="' . ($w - $padR) . '" y="' . ($h - 8) . '" font-family="Arial" font-size="9"'
          . ' fill="#888" text-anchor="end">' . date('d.m', $maxT) . '</text>';

    // valoarea curenta, in dreapta sus
    $out .= '<text x="' . ($w - $padR) . '" y="14" font-family="Arial" font-size="11"'
          . ' font-weight="bold" fill="' . $color . '" text-anchor="end">'
          . number_format($lastP[1]) . '</text>';

    $out .= '</svg>';

    return $out;
}
?>

<style>
.ps-wrap{max-width:600px}
.ps-head{width:100%;margin-bottom:10px}
.ps-chart{margin-bottom:10px}
.ps-note{color:#777;font-size:11px;margin:6px 0 12px 0}
.ps-locked{border:1px solid #e0c86a;background:#fdf6df;padding:10px;color:#7a5c00;font-size:12px}
.ps-sum{width:100%;border-collapse:collapse;font-size:12px;margin-top:10px}
.ps-sum td,.ps-sum th{border:1px solid #dcdcdc;padding:3px 6px}
.ps-sum th{background:#f2f2f2;text-align:left}
.ps-delta-up{color:#1f7a1f;font-weight:bold}
.ps-delta-down{color:#a33;font-weight:bold}
</style>

<div class="ps-wrap">

<?php
    // Acelasi cap de tabel ca celelalte pagini de clasament, ca sa nu dispara
    // navigatia cu iconite cand intri aici. Iconita de statistici e marcata
    // "active", asa cum face si ally_top10.tpl pentru pagina curenta.
?>
<table cellpadding="1" cellspacing="1" id="player" class="ps-head">
    <thead>
        <tr>
            <th>
                <?php echo defined('PLUSSTATS_TITLE') ? PLUSSTATS_TITLE : 'Graphical statistics'; ?>

                <div id="submenu">
                    <a title="<?php echo defined('PLUSSTATS_TITLE') ? PLUSSTATS_TITLE : 'Graphical statistics'; ?>" href="statistiken.php?id=50">
                        <img class="active btn_stats" src="img/x.gif" alt="<?php echo defined('PLUSSTATS_TITLE') ? PLUSSTATS_TITLE : 'Graphical statistics'; ?>" />
                    </a>
                    <a title="<?php echo TZ_TOP_10; ?>" href="statistiken.php?id=7">
                        <img class="btn_top10" src="img/x.gif" alt="<?php echo TZ_TOP_10; ?>" />
                    </a>
                    <a title="<?php echo DEFENDER; ?>" href="statistiken.php?id=32">
                        <img class="btn_def" src="img/x.gif" alt="<?php echo DEFENDER; ?>" />
                    </a>
                    <a title="<?php echo ATTACKER; ?>" href="statistiken.php?id=31">
                        <img class="btn_off" src="img/x.gif" alt="<?php echo ATTACKER; ?>" />
                    </a>
                </div>
            </th>
        </tr>
    </thead>
</table>

<?php
if (!$psEnabled) {
    echo '<div class="ps-locked">'
       . (defined('PLUSSTATS_DISABLED') ? PLUSSTATS_DISABLED
            : 'Graphical statistics are not enabled on this server.')
       . '</div></div>';
    return;
}

if (!$psHasPlus) {
    echo '<div class="ps-locked">'
       . (defined('PLUSSTATS_NEEDPLUS') ? PLUSSTATS_NEEDPLUS
            : 'Graphical statistics are a Travian Plus feature. Activate Plus to see the development of your account.')
       . '</div></div>';
    return;
}

// -------------------------------------------------
// DATELE
// -------------------------------------------------
$psRows = array();
$psUid  = (int) $session->uid;
$psQ    = @mysqli_query($database->dblink,
    "SELECT recorded_at, `rank`, population, villages, troop_count, troop_upkeep
       FROM " . TB_PREFIX . "player_statistics_history
      WHERE uid = " . $psUid . "
      ORDER BY recorded_at ASC
      LIMIT 400");

while ($psQ && ($psRow = mysqli_fetch_assoc($psQ))) {
    $psRows[] = $psRow;
}

if (count($psRows) < 2) {
    echo '<div class="ps-locked">'
       . (defined('PLUSSTATS_WAIT') ? PLUSSTATS_WAIT
            : 'Your account is being recorded. The graphs appear once at least two snapshots exist.')
       . '</div></div>';
    return;
}

$psSeries = array('rank' => array(), 'population' => array(), 'villages' => array(),
                  'troop_upkeep' => array(), 'troop_count' => array());

foreach ($psRows as $psRow) {
    $t = (int) $psRow['recorded_at'];

    // rangul 0 inseamna "neclasat inca" - il sarim, ca sa nu strice scara
    if ((int) $psRow['rank'] > 0) {
        $psSeries['rank'][] = array($t, (int) $psRow['rank']);
    }

    $psSeries['population'][]   = array($t, (int) $psRow['population']);
    $psSeries['villages'][]     = array($t, (int) $psRow['villages']);
    $psSeries['troop_upkeep'][] = array($t, (int) $psRow['troop_upkeep']);
    $psSeries['troop_count'][]  = array($t, (int) $psRow['troop_count']);
}

echo '<div class="ps-note">'
   . (defined('PLUSSTATS_INTRO') ? PLUSSTATS_INTRO
        : 'The development of your account over time.')
   . '</div>';

echo '<div class="ps-chart">'
   . ps_line_chart($psSeries['rank'],
        defined('PLUSSTATS_RANK') ? PLUSSTATS_RANK : 'Ranking',
        '#3b7dd8', true)
   . '</div>';

echo '<div class="ps-chart">'
   . ps_line_chart($psSeries['population'],
        defined('PLUSSTATS_POP') ? PLUSSTATS_POP : 'Population',
        '#7db72f')
   . '</div>';

echo '<div class="ps-chart">'
   . ps_line_chart($psSeries['villages'],
        defined('PLUSSTATS_VILLAGES') ? PLUSSTATS_VILLAGES : 'Villages',
        '#8e6fc4')
   . '</div>';

echo '<div class="ps-chart">'
   . ps_line_chart($psSeries['troop_upkeep'],
        defined('PLUSSTATS_ARMY') ? PLUSSTATS_ARMY : 'Army strength (crop upkeep per hour)',
        '#d9822b')
   . '</div>';

// -------------------------------------------------
// REZUMAT: acum fata de primul instantaneu
// -------------------------------------------------
$psFirst = $psRows[0];
$psLast  = $psRows[count($psRows) - 1];

$psFields = array(
    'rank'         => defined('PLUSSTATS_RANK') ? PLUSSTATS_RANK : 'Ranking',
    'population'   => defined('PLUSSTATS_POP') ? PLUSSTATS_POP : 'Population',
    'villages'     => defined('PLUSSTATS_VILLAGES') ? PLUSSTATS_VILLAGES : 'Villages',
    'troop_count'  => defined('PLUSSTATS_TROOPS') ? PLUSSTATS_TROOPS : 'Troops',
    'troop_upkeep' => defined('PLUSSTATS_UPKEEP') ? PLUSSTATS_UPKEEP : 'Crop upkeep per hour',
);
?>

<table class="ps-sum">
    <tr>
        <th><?php echo defined('PLUSSTATS_METRIC') ? PLUSSTATS_METRIC : 'Metric'; ?></th>
        <th style="width:100px;text-align:right;"><?php echo date('d.m.Y', (int) $psFirst['recorded_at']); ?></th>
        <th style="width:100px;text-align:right;"><?php echo defined('PLUSSTATS_NOW') ? PLUSSTATS_NOW : 'Now'; ?></th>
        <th style="width:90px;text-align:right;"><?php echo defined('PLUSSTATS_CHANGE') ? PLUSSTATS_CHANGE : 'Change'; ?></th>
    </tr>
    <?php
        foreach ($psFields as $psKey => $psLabel) {
            $a = (int) $psFirst[$psKey];
            $b = (int) $psLast[$psKey];
            $d = $b - $a;

            // la rang, scaderea numarului inseamna urcare in clasament
            $good = ($psKey === 'rank') ? ($d < 0) : ($d > 0);
            $cls  = ($d == 0) ? '' : ($good ? 'ps-delta-up' : 'ps-delta-down');
            $sign = ($d > 0) ? '+' : '';
    ?>
    <tr>
        <td><?php echo $psLabel; ?></td>
        <td style="text-align:right;"><?php echo number_format($a); ?></td>
        <td style="text-align:right;"><b><?php echo number_format($b); ?></b></td>
        <td style="text-align:right;" class="<?php echo $cls; ?>"><?php echo $sign . number_format($d); ?></td>
    </tr>
    <?php } ?>
</table>

<div class="ps-note">
    <?php echo defined('PLUSSTATS_FOOT') ? PLUSSTATS_FOOT
        : 'Army strength is measured by crop upkeep, which is the game\'s own weighting: it counts a strong unit for more than a weak one. Troops reinforcing other players still count as yours.'; ?>
</div>

</div>
