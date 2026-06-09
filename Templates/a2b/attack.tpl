<?php
$ckey = $generator->generateRandStr(6);

// --- 1. Normalizare trupe t1..t11 (păstrăm exact logica originală) ---
$t = [];
for ($i = 1; $i <= 11; $i++) {
    $key = 't' . $i;
    $t[$i] = (isset($process[$key]) && $process[$key] !== '') ? $process[$key] : 0;
}

// --- 2. Detectare scout / hero (exact ca originalul) ---
$scout = 0;
if (!empty($t[3]) && $session->tribe == 3) { $scout = 1; }
if (!empty($t[4]) && in_array($session->tribe, [1,2,4,5])) { $scout = 1; }

$showhero = !empty($t[11]) ? 1 : 0;

// --- 3. Total unități fără cercetași (pentru forțarea tipului de atac) ---
$totalunits = 0;
for ($i = 1; $i <= 11; $i++) {
    $isScout = ($session->tribe == 3 && $i == 3) || ($session->tribe != 3 && $i == 4);
    if (!$isScout) {
        $totalunits += (!empty($process['t'.$i]) ? (int)$process['t'.$i] : 0);
    }
}

// Dacă sunt doar cercetași și nu e întărire, forțează c=1 (Scout)
if ($scout == 1 && $totalunits == 0 && $process['c'] != 2) {
    $process['c'] = 1;
}

// --- 4. Salvare în a2b (aceeași ordine de parametri) ---
$id = $database->addA2b(
    $ckey, time(), $process['0'],
    $t[1], $t[2], $t[3], $t[4], $t[5], $t[6], $t[7], $t[8], $t[9], $t[10], $t[11],
    $process['c']
);

$actionTypes = [1 => 'Scout', 2 => 'Reinforcement', 3 => 'Normal attack', 4 => 'Raid'];
$actionType = $actionTypes[(int)$process['c']] ?? 'Normal attack';

$uid = $session->uid;
$tribe = $session->tribe;
$start = ($tribe - 1) * 10 + 1;
$end = $tribe * 10;

$hasHero = !empty($process['t11']);
$colspan = $hasHero ? 11 : 10;
$kata = !empty($process['t8']);
?>
<h1><?php echo $actionType . " to " . $process[1]; ?></h1>
<form method="post" action="a2b.php">
    <table id="short_info" cellpadding="1" cellspacing="1">
        <tbody>
            <tr>
                <th><?php echo TZ_DESTINATION; ?></th>
                <td><a href="karte.php?d=<?php echo $process[0]; ?>&c=<?php echo $generator->getMapCheck($process[0]); ?>"><?php echo $process[1]; ?> (<?php echo $coor['x']; ?>|<?php echo $coor['y']; ?>)</a></td>
            </tr>
            <tr>
                <th><?php echo TZ_OWNER; ?></th>
                <td><a href="spieler.php?uid=<?php echo $process['2']; ?>"><?php echo $database->getUserField($process['2'], 'username', 0); ?></a></td>
            </tr>
        </tbody>
    </table>

    <table class="troop_details" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
                <td><?php echo $process[1]; ?></td>
                <td colspan="<?php echo $colspan; ?>"><?php echo $actionType . " to " . $process['1']; ?></td>
            </tr>
        </thead>
        <tbody class="units">
            <tr>
                <td></td>
                <?php
                for ($i = $start; $i <= $end; $i++) {
                    echo '<td><img src="img/x.gif" class="unit u' . $i . '" title="' . $technology->getUnitName($i) . '" alt="' . $technology->getUnitName($i) . '" /></td>';
                }
                if ($hasHero) {
                    echo '<td><img src="img/x.gif" class="unit uhero" title="'.U0.'" alt="'.U0.'" /></td>';
                }
                ?>
            </tr>
            <tr>
                <th><?php echo TROOPS; ?></th>
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <td <?php if (!isset($process['t'.$i]) || $process['t'.$i] == '') { echo 'class="none">0'; } else { echo '>' . $process['t'.$i]; } ?></td>
                <?php endfor; ?>
                <?php if ($hasHero) { echo '<td>' . $process['t11'] . '</td>'; } ?>
            </tr>
        </tbody>

        <?php if ($process['c'] == 1): ?>
        <tbody class="options">
            <tr>
                <th><?php echo OPTION; ?></th>
                <td colspan="<?php echo $colspan; ?>">
                    <input class="radio" name="spy" value="1" checked="checked" type="radio"><?php echo TZ_SCOUT_RESOURCES_AND_TROOPS; ?><br>
                    <input class="radio" name="spy" value="2" type="radio"><?php echo TZ_SCOUT_DEFENCES_AND_TROOPS; ?>
                </td>
            </tr>
        </tbody>
        <?php endif; ?>

        <?php if ($kata && $process['c'] != 2): ?>
            <?php if ($process['c'] == 3): ?>
            <tbody class="cata">
                <tr>
                    <th><?php echo TZ_DESTINATION; ?></th>
                    <td colspan="<?php echo $colspan; ?>">
                        <select name="ctar1" class="dropdown">
                            <option value="0"><?php echo RANDOM; ?></option>
                            <?php if ($building->getTypeLevel(16) >= 5): ?>
                            <optgroup label="Resources">
                                <option value="1"><?php echo WOODCUTTER; ?></option>
                                <option value="2"><?php echo CLAYPIT; ?></option>
                                <option value="3"><?php echo IRONMINE; ?></option>
                                <option value="4"><?php echo CROPLAND; ?></option>
                                <option value="5"><?php echo SAWMILL; ?></option>
                                <option value="6"><?php echo BRICKYARD; ?></option>
                                <option value="7"><?php echo IRONFOUNDRY; ?></option>
                                <option value="8"><?php echo GRAINMILL; ?></option>
                                <option value="9"><?php echo BAKERY; ?></option>
                            </optgroup>
                            <?php endif; ?>
                            <?php if ($building->getTypeLevel(16) >= 3): ?>
                            <optgroup label="Infrastructure">
                                <option value="10"><?php echo WAREHOUSE; ?></option>
                                <option value="11"><?php echo GRANARY; ?></option>
                                <?php if ($building->getTypeLevel(16) >= 10): ?>
                                <option value="15"><?php echo MAINBUILDING; ?></option>
                                <option value="17"><?php echo MARKETPLACE; ?></option>
                                <option value="18"><?php echo EMBASSY; ?></option>
                                <option value="24"><?php echo TZ_TOWNHALL; ?></option>
                                <option value="25"><?php echo RESIDENCE; ?></option>
                                <option value="26"><?php echo PALACE; ?></option>
                                <option value="27"><?php echo TREASURY; ?></option>
                                <option value="28"><?php echo TRADEOFFICE; ?></option>
                                <option value="35"><?php echo BREWERY; ?></option>
                                <?php endif; ?>
                                <option value="38"><?php echo GREATWAREHOUSE; ?></option>
                                <option value="39"><?php echo GREATGRANARY; ?></option>
                                <option value="40"><?php echo WONDER; ?></option>
                            </optgroup>
                            <?php endif; ?>
                            <?php if ($building->getTypeLevel(16) >= 10): ?>
                            <optgroup label="Military">
                                <option value="12"><?php echo BLACKSMITH; ?></option>
                                <option value="13"><?php echo ARMOURY; ?></option>
                                <option value="14"><?php echo TOURNAMENTSQUARE; ?></option>
                                <option value="16"><?php echo RALLYPOINT; ?></option>
                                <option value="19"><?php echo BARRACKS; ?></option>
                                <option value="20"><?php echo STABLE; ?></option>
                                <option value="21"><?php echo WORKSHOP; ?></option>
                                <option value="22"><?php echo ACADEMY; ?></option>
                                <option value="29"><?php echo GREATBARRACKS; ?></option>
                                <option value="30"><?php echo GREATSTABLE; ?></option>
                                <option value="37"><?php echo HEROSMANSION; ?></option>
                            </optgroup>
                            <?php endif; ?>
                        </select>

                        <?php if ($building->getTypeLevel(16) == 20 && $process['t8'] >= 20): ?>
                        <select name="ctar2" class="dropdown">
                            <option value="0">-</option>
                            <option value="99"><?php echo RANDOM; ?></option>
                            <?php if ($building->getTypeLevel(16) >= 5): ?>
                            <optgroup label="Resources">
                                <option value="1"><?php echo WOODCUTTER; ?></option><option value="2"><?php echo CLAYPIT; ?></option><option value="3"><?php echo IRONMINE; ?></option>
                                <option value="4"><?php echo CROPLAND; ?></option><option value="5"><?php echo SAWMILL; ?></option><option value="6"><?php echo BRICKYARD; ?></option>
                                <option value="7"><?php echo IRONFOUNDRY; ?></option><option value="8"><?php echo GRAINMILL; ?></option><option value="9"><?php echo BAKERY; ?></option>
                            </optgroup>
                            <?php endif; ?>
                            <?php if ($building->getTypeLevel(16) >= 3): ?>
                            <optgroup label="Infrastructure">
                                <option value="10"><?php echo WAREHOUSE; ?></option><option value="11"><?php echo GRANARY; ?></option>
                                <?php if ($building->getTypeLevel(16) >= 10): ?>
                                <option value="15"><?php echo MAINBUILDING; ?></option><option value="17"><?php echo MARKETPLACE; ?></option><option value="18"><?php echo EMBASSY; ?></option>
                                <option value="24"><?php echo TZ_TOWNHALL; ?></option><option value="25"><?php echo RESIDENCE; ?></option><option value="26"><?php echo PALACE; ?></option>
                                <option value="27"><?php echo TREASURY; ?></option><option value="28"><?php echo TRADEOFFICE; ?></option><option value="35"><?php echo BREWERY; ?></option>
                                <?php endif; ?>
                                <option value="38"><?php echo GREATWAREHOUSE; ?></option><option value="39"><?php echo GREATGRANARY; ?></option><option value="40"><?php echo WONDER; ?></option>
                            </optgroup>
                            <?php endif; ?>
                            <?php if ($building->getTypeLevel(16) >= 10): ?>
                            <optgroup label="Military">
                                <option value="12"><?php echo BLACKSMITH; ?></option><option value="13"><?php echo ARMOURY; ?></option><option value="14"><?php echo TOURNAMENTSQUARE; ?></option>
                                <option value="16"><?php echo RALLYPOINT; ?></option><option value="19"><?php echo BARRACKS; ?></option><option value="20"><?php echo STABLE; ?></option>
                                <option value="21"><?php echo WORKSHOP; ?></option><option value="22"><?php echo ACADEMY; ?></option><option value="29"><?php echo GREATBARRACKS; ?></option>
                                <option value="30"><?php echo GREATSTABLE; ?></option><option value="37"><?php echo HEROSMANSION; ?></option>
                            </optgroup>
                            <?php endif; ?>
                        </select>
                        <?php endif; ?>
                        <span class="info"><?php echo TZ_WILL_BE_ATTACKED_BY_CATAPULT_S; ?></span>
                    </td>
                </tr>
            </tbody>
            <?php elseif ($process['c'] == '4'): ?>
            <tbody class="infos">
                <tr>
                    <th><?php echo TZ_DESTINATION; ?></th>
                    <td colspan="<?php echo $colspan; ?>"><?php echo TZ_WARNING_CATAPULT_WILL; ?> <b>ONLY</b> <?php echo TZ_SHOOT_WITH_A_NORMAL_ATTACK_THEY_DO; ?></td>
                </tr>
            </tbody>
            <?php endif; ?>
        <?php endif; ?>

        <tbody class="infos">
            <tr>
                <th><?php echo TZ_ARRIVED; ?></th>
                <?php
                $troopsTime = $units->getWalkingTroopsTime($village->wid, $process[0], $session->uid, $session->tribe, $process, 1, 't');
                $time = $database->getArtifactsValueInfluence($session->uid, $village->wid, 2, $troopsTime);
                ?>
                <td colspan="<?php echo $colspan; ?>">
                    <div class="in"><?php echo P_IN; ?> <?php echo $generator->getTimeFormat($time); ?></div>
                    <div class="at"><?php echo AT; ?> <span id="tp2"><?php echo $generator->procMtime(date('U') + $time, 9) ?></span><span> <?php echo HOURS; ?></span></div>
                </td>
            </tr>
        </tbody>
    </table>

    <input name="timestamp" value="<?php echo time(); ?>" type="hidden">
    <input name="timestamp_checksum" value="<?php echo $ckey; ?>" type="hidden">
    <input name="ckey" value="<?php echo $id; ?>" type="hidden">
    <input name="id" value="39" type="hidden">
    <input name="a" value="533374" type="hidden">
    <input name="c" value="3" type="hidden">

    <?php
    if ($database->hasBeginnerProtection($village->wid) == 1 && $database->hasBeginnerProtection($process['0']) == 0) {
        echo '<span style="color: #DD0000"><b>Caution:</b> Attacking a player will lose the protection!</span>';
    }
    if ($database->hasBeginnerProtection($process['0']) == 1) {
        echo '<b>User presently has beginners protection</b>';
    } else {
    ?>
        <p class="btn"><input value="ok" name="s1" id="btn_ok" class="dynamic_img " src="img/x.gif" alt="OK" type="image" onclick="if (this.disabled==false) {document.getElementsByTagName('form')[0].submit();} this.disabled=true;" onLoad="this.disabled=false;"></p>
    <?php } ?>
</form>
</div>
