<?php
$to = $database->getVillage($enforce['from']);
$fromcoor = $database->getCoor($enforce['from']);
$tocoor = $database->getCoor($enforce['vref']);

$att_tribe = (int)$database->getUserField($to['owner'], 'tribe', 0);
$start = ($att_tribe - 1) * 10 + 1;
$end = $att_tribe * 10;

$toBaseId = $generator->getBaseID($fromcoor['x'], $fromcoor['y']);
$toMapCheck = $generator->getMapCheck($toBaseId);

// layout exact ca în original (pentru CSS)
$layout = [
    [
        ['o' => 0, 't' => 1, 'class' => 'line-first column-first large'],
        ['o' => 3, 't' => 4, 'class' => 'line-first large'],
        ['o' => 6, 't' => 7, 'class' => 'line-first regular'],
        ['o' => 8, 't' => 9, 'class' => 'line-first column-last small'],
    ],
    [
        ['o' => 1, 't' => 2, 'class' => 'column-first large'],
        ['o' => 4, 't' => 5, 'class' => 'large'],
        ['o' => 7, 't' => 8, 'class' => 'regular'],
        ['o' => 9, 't' => 10, 'class' => 'column-last small'],
    ],
    [
        ['o' => 2, 't' => 3, 'class' => 'line-last column-first large'],
        ['o' => 5, 't' => 6, 'class' => 'line-last large'],
    ],
];
?>
<h1><?php echo TZ_SEND_UNITS_BACK; ?></h1>
<form method="POST" name="snd" action="a2b.php">
    <table id="short_info" cellpadding="1" cellspacing="1">
        <tbody>
            <tr>
                <th><?php echo TZ_DESTINATION; ?></th>
                <td><a href="karte.php?d=<?php echo $toBaseId; ?>&amp;c=<?php echo $toMapCheck; ?>"><?php echo htmlspecialchars($to['name']); ?> (<?php echo $fromcoor['x']; ?>|<?php echo $fromcoor['y']; ?>)</a></td>
            </tr>
            <tr>
                <th><?php echo TZ_OWNER; ?></th>
                <td><a href="spieler.php?uid=<?php echo $to['owner']; ?>"><?php echo htmlspecialchars($database->getUserField($to['owner'], 'username', 0)); ?></a></td>
            </tr>
        </tbody>
    </table>

    <table class="troop_details" cellpadding="1" cellspacing="1">
        <thead>
            <tr><td colspan="10"><?php echo TZ_SEND_UNITS_BACK_TO; ?> <?php echo htmlspecialchars($to['name']); ?></td></tr>
        </thead>
    </table>

    <table id="troops" cellpadding="1" cellspacing="1">
        <tbody>
        <?php foreach ($layout as $rowIndex => $row): ?>
            <tr>
            <?php foreach ($row as $cell):
                $unitId = $start + $cell['o'];
                $tName = 't' . $cell['t'];
                $value = (int)($enforce['u' . $unitId] ?? 0);
                $disabled = $value <= 0 ? ' disabled="disabled"' : '';
            ?>
                <td class="<?php echo $cell['class']; ?>">
                    <img class="unit u<?php echo $unitId; ?>" src="img/x.gif" title="<?php echo $technology->getUnitName($unitId); ?>" alt="<?php echo $technology->getUnitName($unitId); ?>">
                    <input class="text"<?php echo $disabled; ?> name="<?php echo $tName; ?>" value="<?php echo $value; ?>" maxlength="6" type="text">
                    <span class="none">(<?php echo $value; ?>)</span>
                </td>
            <?php endforeach; ?>

            <?php if ($rowIndex === 2): // rândul 3 ?>
                <?php if (!empty($enforce['hero'])): ?>
                    <td class="line-last large">
                        <img class="unit uhero" src="img/x.gif" title="<?php echo TZ_HERO; ?>" alt="<?php echo TZ_HERO; ?>">
                        <input class="text" name="t11" value="<?php echo (int)$enforce['hero']; ?>" maxlength="6" type="text">
                        <span class="none">(<?php echo (int)$enforce['hero']; ?>)</span>
                    </td>
                <?php endif; ?>
                <td class="line-last regular"></td>
                <td class="line-last column-last"></td>
            <?php endif; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <table class="troop_details" cellpadding="1" cellspacing="1">
        <tbody class="infos">
            <tr>
                <th><?php echo TZ_ARRIVED; ?></th>
                <?php
                $troopsTime = $units->getWalkingTroopsTime($enforce['from'], $enforce['vref'], $to['owner'], $att_tribe, $enforce, 1);
                $time = $database->getArtifactsValueInfluence($session->uid, $village->wid, 2, $troopsTime);
                ?>
                <td colspan="10">
                    <div class="in"><?php echo P_IN; ?> <?php echo $generator->getTimeFormat($time); ?></div>
                    <div class="at"><?php echo AT; ?> <span id="tp2"><?php echo date("H:i:s", time() + $time); ?></span><span> <?php echo HOURS; ?></span></div>
                </td>
            </tr>
        </tbody>
    </table>

    <input name="ckey" value="<?php echo $ckey; ?>" type="hidden">
    <input name="id" value="39" type="hidden">
    <input name="a" value="533374" type="hidden">
    <input name="c" value="8" type="hidden">

    <p class="btn"><input value="ok" name="s1" id="btn_ok" class="dynamic_img " src="img/x.gif" alt="OK" type="image" onclick="if (this.disabled==false) {document.getElementsByTagName('form')[0].submit();} this.disabled=true;" onLoad="this.disabled=false;"></p>
</form>
</div>
