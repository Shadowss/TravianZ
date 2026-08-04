<?php
#################################################################################
##  Bonusuri de alianta (port T4)                                              ##
## --------------------------------------------------------------------------- ##
##  Membrii doneaza resurse, alianta deblocheaza patru bonusuri de cate cinci   ##
##  niveluri. Toata logica sta in GameEngine/AllianceBonus.php; aici doar       ##
##  afisam starea si preluam formularul de donatie.                            ##
#################################################################################

if (!class_exists('AllianceBonus')) {
    include_once('GameEngine/AllianceBonus.php');
}

// -------------------------------------------------
// ID-UL ALIANTEI SI DATELE EI
// -------------------------------------------------
// Fiecare pagina de alianta si le incarca singura (vezi chat.tpl, option.tpl),
// pentru ca allianz.php nu le pune la dispozitie global.
if (!isset($aid)) {
    $aid = (int) $session->alliance;
}

$allianceinfo = $database->getAlliance($aid);

// Titlul si bara de taburi, exact ca in celelalte pagini de alianta.
// Fara ele, intrarea pe tabul de bonusuri facea sa dispara navigatia si nu
// mai aveai cum sa te intorci la Overview.
echo "<h1>"
    . htmlspecialchars($allianceinfo['tag'], ENT_QUOTES, 'UTF-8')
    . " - "
    . htmlspecialchars($allianceinfo['name'], ENT_QUOTES, 'UTF-8')
    . "</h1>";

include("alli_menu.tpl");

$abEngine  = new AllianceBonus();
$abMessage = '';
$abError   = false;

/* ---------------------------------------------------------------- donatie */
if (isset($_POST['ab_donate'])) {

    $abType   = (int) ($_POST['ab_type'] ?? 0);
    $abTriple = isset($_POST['ab_triple']) && $_POST['ab_triple'] === '1';

    $abAmounts = array(
        (float) ($_POST['ab_wood'] ?? 0),
        (float) ($_POST['ab_clay'] ?? 0),
        (float) ($_POST['ab_iron'] ?? 0),
        (float) ($_POST['ab_crop'] ?? 0),
    );

    $abResult = $abEngine->donate($session->uid, $village->wid, $abType, $abAmounts, $abTriple);

    switch ($abResult) {
        case AllianceBonus::DONATE_OK:
            $abMessage = defined('ALLYBONUS_MSG_OK') ? ALLYBONUS_MSG_OK : 'Resources donated.';
            break;
        case AllianceBonus::DONATE_UPGRADING:
            $abMessage = defined('ALLYBONUS_MSG_UPGRADING') ? ALLYBONUS_MSG_UPGRADING
                : 'This bonus is currently being unlocked; donations are paused.';
            $abError = true;
            break;
        case AllianceBonus::DONATE_LIMIT:
            $abMessage = defined('ALLYBONUS_MSG_LIMIT') ? ALLYBONUS_MSG_LIMIT
                : 'That would exceed your daily donation limit.';
            $abError = true;
            break;
        case AllianceBonus::DONATE_RESOURCES:
            $abMessage = defined('ALLYBONUS_MSG_RESOURCES') ? ALLYBONUS_MSG_RESOURCES
                : 'Not enough resources in this village.';
            $abError = true;
            break;
        case AllianceBonus::DONATE_OVER_MAX:
            // La ultimul nivel surplusul ar ramane blocat, deci spunem exact
            // cat se mai poate dona.
            $abMessage = sprintf(
                defined('ALLYBONUS_MSG_OVERMAX') ? ALLYBONUS_MSG_OVERMAX
                    : 'This is the final level: you can donate at most %s more resources.',
                number_format(AllianceBonus::$overMaxAllowed)
            );
            $abError = true;
            break;
        case AllianceBonus::DONATE_NO_GOLD:
            $abMessage = defined('ALLYBONUS_MSG_NOGOLD') ? ALLYBONUS_MSG_NOGOLD
                : 'Not enough gold to triple this donation.';
            $abError = true;
            break;
        case AllianceBonus::DONATE_NO_ALLIANCE:
            $abMessage = defined('ALLYBONUS_MSG_NOALLY') ? ALLYBONUS_MSG_NOALLY
                : 'You are not in an alliance.';
            $abError = true;
            break;
        default:
            $abMessage = defined('ALLYBONUS_MSG_INVALID') ? ALLYBONUS_MSG_INVALID
                : 'Invalid donation.';
            $abError = true;
    }
}

/* ------------------------------------------------------------------ stare */
$abAid     = $aid;
$abState   = $abEngine->getState($abAid);
$abHighest = $abEngine->highestLevel($abAid);
$abLimit   = AllianceBonus::dailyLimit($abHighest);
$abUsed    = $abEngine->donatedToday($session->uid);
$abLeft    = max(0, $abLimit - $abUsed);
$abTypes   = AllianceBonus::types();
$abGpack   = defined('GP_LOCATE') ? GP_LOCATE : 'gpack/travian_default/';
?>

<style>
/* Prefix "ab-" ca stilurile sa nu atinga restul paginilor de alianta. */
.ab-wrap{font-size:12px}
.ab-msg{padding:6px 9px;margin-bottom:9px;border:1px solid #b7d78a;background:#eaf6da;color:#33691e}
.ab-msg.err{border-color:#e0b4b4;background:#fdeaea;color:#a33}
.ab-grid{display:flex;flex-wrap:wrap;gap:9px;margin-bottom:10px}
.ab-card{flex:1 1 250px;border:1px solid #c9c9c9;background:#f2f2f2;padding:8px}
.ab-head{display:flex;align-items:flex-start;gap:8px;margin-bottom:6px}
.ab-head img{width:44px;height:44px}
.ab-name{font-weight:bold;color:#333}
.ab-lvl{color:#666;font-size:11px}
/* descrierea sta in dreapta numelui si ocupa spatiul ramas */
.ab-desc{flex:1;color:#666;font-size:11px;line-height:1.35;padding-left:4px}
.ab-eff{color:#1f7a1f;font-weight:bold}
.ab-wait{color:#a60;font-size:10px}
.ab-bar{background:#fff;border:1px solid #c9c9c9;height:13px;overflow:hidden;margin:4px 0}
.ab-bar i{display:block;height:100%;background:#7db72f}
.ab-num{font-size:11px;color:#555}
.ab-form input[type=text]{width:74px}
.ab-status{font-size:11px;color:#a60;font-weight:bold}
.ab-tbl{width:100%;border-collapse:collapse;font-size:12px}
.ab-tbl td,.ab-tbl th{border:1px solid #dcdcdc;padding:3px 5px}
.ab-note{color:#777;font-size:11px;margin-top:4px}
</style>

<div class="ab-wrap">

<?php if ($abMessage !== '') { ?>
    <div class="ab-msg<?php echo $abError ? ' err' : ''; ?>"><?php echo $abMessage; ?></div>
<?php } ?>

<p class="ab-num">
    <?php echo defined('ALLYBONUS_DAILY_LEFT') ? ALLYBONUS_DAILY_LEFT : 'Your donation allowance left today'; ?>:
    <b><?php echo number_format($abLeft); ?></b>
    / <?php echo number_format($abLimit); ?>
</p>

<div class="ab-grid">
<?php
    foreach ($abTypes as $abT => $abInfo) {
        $abRow   = $abState[$abT];
        $abLevel = (int) $abRow['level'];
        $abNext  = $abLevel + 1;
        $abCost  = AllianceBonus::costFor($abLevel);
        $abPool  = (float) $abRow['pool'];
        $abBusy  = $abRow['upgrade_end'] > time();
        $abPct   = ($abCost > 0) ? max(0, min(100, $abPool / $abCost * 100)) : 100;
        $abName  = defined($abInfo['lang']) ? constant($abInfo['lang']) : ucfirst($abInfo['key']);
?>
    <div class="ab-card">
        <div class="ab-head">
            <img src="<?php echo $abGpack; ?>img/ally/bonus<?php echo ucfirst($abInfo['key']); ?>.png"
                 alt="<?php echo $abName; ?>" title="<?php echo $abName; ?>" />
            <span>
                <span class="ab-name"><?php echo $abName; ?></span><br>
                <span class="ab-lvl">
                    <?php echo defined('ALLYBONUS_LEVEL') ? ALLYBONUS_LEVEL : 'Level'; ?>
                    <?php echo $abLevel; ?> / <?php echo AllianceBonus::MAX_LEVEL; ?>
                    <?php
                        // Nivelul de care beneficiezi TU poate fi mai mic decat cel
                        // al aliantei: membrii noi capata acces treptat. Aratam
                        // amandoua valorile, altfel bonusul pare ca nu se aplica.
                        $abMine = $abEngine->effectiveLevel($session->uid, $abT);
                        $abWait = $abEngine->waitingFor($session->uid, $abT);
                    ?>
                    &nbsp;<span class="ab-eff">+<?php echo (int) AllianceBonus::percentFor($abT, $abMine); ?>%</span>
                    <?php if ($abMine < $abLevel) { ?>
                        <br><span class="ab-wait">
                            <?php echo defined('ALLYBONUS_YOURLEVEL') ? ALLYBONUS_YOURLEVEL : 'Your level'; ?>:
                            <b><?php echo $abMine; ?></b>
                            <?php if ($abWait > 0) { ?>
                                &ndash; <?php echo defined('ALLYBONUS_UNLOCKS_IN') ? ALLYBONUS_UNLOCKS_IN : 'next in'; ?>
                                <?php echo $generator->getTimeFormat($abWait); ?>
                            <?php } ?>
                        </span>
                    <?php } ?>
                </span>
            </span>
            <span class="ab-desc"><?php
                // descrierea bonusului, langa nume si nivel
                $abDescKey = strtoupper($abInfo['key']) . '_DESC';
                $abDescKey = 'ALLYBONUS_' . $abDescKey;
                echo defined($abDescKey) ? constant($abDescKey) : '';
            ?></span>
        </div>

        <?php if ($abLevel >= AllianceBonus::MAX_LEVEL) { ?>
            <div class="ab-status"><?php echo defined('ALLYBONUS_MAXED') ? ALLYBONUS_MAXED : 'Fully unlocked'; ?></div>
        <?php } elseif ($abBusy) { ?>
            <div class="ab-bar"><i style="width:100%"></i></div>
            <div class="ab-status">
                <?php echo defined('ALLYBONUS_UNLOCKING') ? ALLYBONUS_UNLOCKING : 'Unlocking level'; ?>
                <?php echo $abNext; ?> &ndash;
                <?php echo $generator->getTimeFormat($abRow['upgrade_end'] - time()); ?>
            </div>
        <?php } else { ?>
            <div class="ab-bar"><i style="width:<?php echo (int) $abPct; ?>%"></i></div>
            <div class="ab-num">
                <?php echo number_format($abPool); ?> / <?php echo number_format($abCost); ?>
                &nbsp;(<?php echo defined('ALLYBONUS_NEXT') ? ALLYBONUS_NEXT : 'next'; ?>:
                +<?php echo (int) AllianceBonus::percentFor($abT, $abNext); ?>%)
            </div>

            <form class="ab-form" action="allianz.php?s=7" method="POST" style="margin-top:5px;">
                <input type="hidden" name="ab_donate" value="1">
                <input type="hidden" name="ab_type" value="<?php echo $abT; ?>">
                <img class="r1" src="img/x.gif" alt="" /> <input type="text" name="ab_wood" value="0" size="7">
                <img class="r2" src="img/x.gif" alt="" /> <input type="text" name="ab_clay" value="0" size="7"><br>
                <img class="r3" src="img/x.gif" alt="" /> <input type="text" name="ab_iron" value="0" size="7">
                <img class="r4" src="img/x.gif" alt="" /> <input type="text" name="ab_crop" value="0" size="7"><br>
                <label style="font-size:11px;">
                    <input type="checkbox" name="ab_triple" value="1">
                    <?php echo defined('ALLYBONUS_TRIPLE') ? ALLYBONUS_TRIPLE : 'Triple this donation'; ?>
                    (<?php echo defined('ALLIANCE_BONUS_TRIPLE_GOLD') ? (int) ALLIANCE_BONUS_TRIPLE_GOLD : 3; ?>
                    <?php echo defined('GOLD') ? GOLD : 'gold'; ?>)
                </label><br>
                <input type="submit" value="<?php echo defined('ALLYBONUS_DONATE') ? ALLYBONUS_DONATE : 'Donate'; ?>">
            </form>
        <?php } ?>
    </div>
<?php } ?>
</div>

<div class="ab-note">
    <?php echo defined('ALLYBONUS_NEWMEMBER') ? ALLYBONUS_NEWMEMBER
        : 'New members gain access to higher levels gradually: level 2 after 24 hours in the alliance, level 3 after 48 hours, and so on.'; ?>
</div>

<div class="ab-note">
    <?php echo defined('ALLYBONUS_HINT') ? ALLYBONUS_HINT
        : 'The resource type does not matter, only the total amount. While a level is unlocking, that bonus cannot receive donations.'; ?>
</div>

<?php
    $abTop = $abEngine->contributions($abAid, 20);

    if ($abTop) {
?>
<h4 style="margin-top:12px;"><?php echo defined('ALLYBONUS_CONTRIBUTORS') ? ALLYBONUS_CONTRIBUTORS : 'Contributions'; ?></h4>
<table class="ab-tbl">
    <tr>
        <th><?php echo defined('ALLYBONUS_MEMBER') ? ALLYBONUS_MEMBER : 'Member'; ?></th>
        <th style="width:140px;text-align:right;"><?php echo defined('ALLYBONUS_TOTAL') ? ALLYBONUS_TOTAL : 'Donated'; ?></th>
    </tr>
    <?php foreach ($abTop as $abC) { ?>
    <tr>
        <td><a href="spieler.php?uid=<?php echo (int) $abC['uid']; ?>"><?php echo htmlspecialchars($abC['username'], ENT_QUOTES, 'UTF-8'); ?></a></td>
        <td style="text-align:right;"><?php echo number_format($abC['total']); ?></td>
    </tr>
    <?php } ?>
</table>
<?php } ?>

</div>
