<?php
//-- Prevent founding if not enough settlers or invalid/occupied tile
//-- fix by AL-Kateb - Simplified by iopietro
$settlers = (int)($village->unitarray['u' . $session->tribe . '0'] ?? 0);

if ($settlers < 3 || !isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("location: dorf1.php");
    exit;
}

$newvillage = $database->getMInfo((int)$_GET['id']);

// păstrăm exact verificările originale
if (!$newvillage || $newvillage['id'] == 0 || $newvillage['occupied'] > 0 || $newvillage['oasistype'] > 0) {
    header("location: dorf1.php");
    exit;
}

// resurse rotunjite
$wood = round($village->awood);
$clay = round($village->aclay);
$iron = round($village->airon);
$crop = round($village->acrop);

// timp de mers pentru coloniști (3 settlers = unitatea 10 a tribului)
$troopsTime = $units->getWalkingTroopsTime($village->wid, $newvillage['id'], 0, 0, [300], 0);
$time = $database->getArtifactsValueInfluence($session->uid, $village->wid, 2, $troopsTime);

$startUnit = ($session->tribe - 1) * 10 + 1;
$endUnit = $session->tribe * 10;
$hasResources = ($wood >= 750 && $clay >= 750 && $iron >= 750 && $crop >= 750);
?>
<h1><?php echo FNEWVILLAGE; ?></h1>
<form method="POST" action="build.php">
    <input type="hidden" name="a" value="new" />
    <input type="hidden" name="c" value="5" />
    <input type="hidden" name="s" value="<?php echo (int)$_GET['id']; ?>" />
    <input type="hidden" name="id" value="39" />

    <table class="troop_details" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
                <td class="role"><a href="spieler.php?uid=<?php echo $session->uid; ?>"><?php echo $session->username; ?></a></td>
                <td colspan="10">
                    <a href="karte.php?d=<?php echo $newvillage['id']; ?>&c=<?php echo $generator->getMapCheck($newvillage[0]); ?>">
                        Found new village (<?php echo $newvillage['x']; ?>|<?php echo $newvillage['y']; ?>)
                    </a>
                </td>
            </tr>
        </thead>
        <tbody class="units">
            <tr>
                <th>&nbsp;</th>
                <?php for ($i = $startUnit; $i <= $endUnit; $i++): ?>
                    <td><img src="img/x.gif" class="unit u<?php echo $i; ?>" title="<?php echo $technology->getUnitName($i); ?>" alt="<?php echo $technology->getUnitName($i); ?>" /></td>
                <?php endfor; ?>
            </tr>
            <tr>
                <th><?php echo TROOPS; ?></th>
                <?php
                // primele 9 unități = 0
                for ($i = 1; $i <= 9; $i++) {
                    echo '<td class="none">0</td>';
                }
                // a 10-a = coloniștii
                echo $settlers >= 3 ? '<td>3</td>' : '<td class="none">0</td>';
                ?>
            </tr>
        </tbody>
        <tbody class="infos">
            <tr>
                <th><?php echo DURATION; ?></th>
                <td colspan="10"><img class="clock" src="img/x.gif" alt="<?php echo DURATION; ?>" title="<?php echo DURATION; ?>" /> <?php echo $generator->getTimeFormat($time); ?></td>
            </tr>
        </tbody>
        <tbody class="infos">
            <tr>
                <th><?php echo RESOURCES; ?></th>
                <td colspan="10">
                    <img class="r1" src="img/x.gif" alt="<?php echo LUMBER; ?>" title="<?php echo TZ_WOOD; ?>" />750 |
                    <img class="r2" src="img/x.gif" alt="<?php echo CLAY; ?>" title="<?php echo CLAY; ?>" />750 |
                    <img class="r3" src="img/x.gif" alt="<?php echo IRON; ?>" title="<?php echo IRON; ?>" />750 |
                    <img class="r4" src="img/x.gif" alt="<?php echo CROP; ?>" title="<?php echo CROP; ?>" />750
                </td>
            </tr>
        </tbody>
    </table>

    <p class="btn">
        <?php if ($hasResources): ?>
            <button value="ok" name="s1" id="btn_ok" class="trav_buttons" alt="OK" onclick="this.disabled=true;this.form.submit();"><?php echo TZ_OK_2; ?></button>
        <?php else: ?>
            <span class="c2"><b><?php echo TZ_NOT_ENOUGH_RESOURCE; ?></b></span>
        <?php endif; ?>
    </p>
</form>
</div>
