<?php

// RALLY POINT MENU

$t = isset($_GET['t']) ? (int)$_GET['t'] : 0;
$isOverview = ($t === 0) || ($t === 99 && !$session->goldclub);
$isGold = ($t === 99 && $session->goldclub);
?>
<div id="textmenu">
    <a href="build.php?id=<?= $id ?>" <?= $isOverview ? 'class="selected"' : '' ?>><?= OVERVIEW ?></a> |
    <a href="a2b.php"><?= SEND_TROOPS ?></a> |
    <a href="warsim.php"><?= Q20_RESP1 ?></a>
    <?php if ($session->goldclub == 1): ?> |
        <a href="build.php?id=<?= $id ?>&amp;t=99" <?= $isGold ? 'class="selected"' : '' ?>><?php echo GOLD_CLUB; ?></a>
    <?php endif; ?>
</div>