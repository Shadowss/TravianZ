<?php

// RALLY POINT TROOPS

$tribe = $session->tribe;
$start = ($tribe - 1) * 10 + 1;
$end = $tribe * 10;
$hasHero = $village->unitarray['hero'] != 0;
$colspan = $hasHero ? 11 : 10;
?>
<tr><th>&nbsp;</th>
    <?php for ($i = $start; $i <= $end; $i++): ?>
        <td><img src="img/x.gif" class="unit u<?= $i ?>" title="<?= $technology->getUnitName($i) ?>" alt="<?= $technology->getUnitName($i) ?>"></td>
    <?php endfor; ?>
    <?php if ($hasHero): ?>
        <td><img src="img/x.gif" class="unit uhero" title="<?php echo U0; ?>" alt="<?php echo U0; ?>"></td>
    <?php endif; ?>
</tr>
<tr><th><?= TROOPS ?></th>
    <?php for ($i = $start; $i <= $end; $i++):
        $cnt = $village->unitarray['u'.$i] ?? 0;
    ?>
        <td class="<?= $cnt == 0 ? 'none' : '' ?>"><?= $cnt ?></td>
    <?php endfor; ?>
    <?php if ($hasHero): ?>
        <td><?= $village->unitarray['hero'] ?></td>
    <?php endif; ?>
</tr>
</tbody>
<tbody class="infos">
    <tr>
        <th><?= UPKEEP ?></th>
        <td colspan="<?= $colspan ?>"><?= $technology->getUpkeep($village->unitarray, 0) ?><img class="r4" src="img/x.gif" title="<?php echo CROP; ?>" alt="<?php echo CROP; ?>"><?= PER_HR ?></td>
    </tr>