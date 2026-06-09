<?php
// 17_1.tpl - MARKETPLACE / OFFERS
global $database, $session, $village, $market, $generator, $id;

$u = isset($_GET['u']) ? max(0, (int)$_GET['u']) : 0;
$s = isset($_GET['s']) ? (int)$_GET['s'] : 0;
$b = isset($_GET['b']) ? (int)$_GET['b'] : 0;
$v = isset($_GET['v']) ? $_GET['v'] : '';

$resIcon = [
    1 => ['class' => 'r1', 'name' => LUMBER],
    2 => ['class' => 'r2', 'name' => CLAY],
    3 => ['class' => 'r3', 'name' => IRON],
    4 => ['class' => 'r4', 'name' => CROP],
];
?>
<div id="build" class="gid17">
    <a href="#" onClick="return Popup(17,4);" class="build_logo">
        <img class="building g17" src="img/x.gif" alt="<?php echo MARKETPLACE; ?>" title="<?php echo MARKETPLACE;?>" />
    </a>
    <h1><?php echo MARKETPLACE;?> <span class="level"><?php echo LEVEL;?> <?php echo (int)$village->resarray['f'.$id];?></span></h1>
    <p class="build_desc"><?php echo MARKETPLACE_DESC;?></p>

    <?php include("17_menu.tpl");?>

    <?php if ($session->plus):?>
    <table id="search_select" class="buy_select" cellpadding="1" cellspacing="1">
        <thead><tr><td colspan="4"><?php echo I_AN_SEARCHING;?></td></tr></thead>
        <tbody><tr>
            <?php for ($i = 1; $i <= 4; $i++):?>
            <td <?php if ($s === $i) echo 'class="hl"';?>>
                <a href="build.php?id=<?php echo (int)$id;?>&t=1&s=<?php echo $i;?><?php if($v) echo '&v='.urlencode($v);?><?php if($b) echo '&b='.$b;?>">
                    <img class="<?php echo $resIcon[$i]['class'];?>" src="img/x.gif" alt="<?php echo $resIcon[$i]['name'];?>" title="<?php echo $resIcon[$i]['name'];?>" />
                </a>
            </td>
            <?php endfor;?>
        </tr></tbody>
    </table>

    <table id="ratio_select" class="buy_select" cellpadding="1" cellspacing="1">
        <tbody>
            <tr><td <?php if($v) echo 'class="hl"';?>><a href="build.php?id=<?php echo (int)$id;?>&t=1&v=1:1<?php if($s) echo '&s='.$s;?><?php if($b) echo '&b='.$b;?>">1:1</a></td></tr>
            <tr><td <?php if(!$v) echo 'class="hl"';?>><a href="build.php?id=<?php echo (int)$id;?>&t=1<?php if($s) echo '&s='.$s;?><?php if($b) echo '&b='.$b;?>">1:x</a></td></tr>
        </tbody>
    </table>

    <table id="bid_select" class="buy_select" cellpadding="1" cellspacing="1">
        <thead><tr><td colspan="4"><?php echo I_AN_OFFERING;?></td></tr></thead>
        <tbody><tr>
            <?php for ($i = 1; $i <= 4; $i++):?>
            <td <?php if ($b === $i) echo 'class="hl"';?>>
                <a href="build.php?id=<?php echo (int)$id;?>&t=1&b=<?php echo $i;?><?php if($v) echo '&v='.urlencode($v);?><?php if($s) echo '&s='.$s;?>">
                    <img class="<?php echo $resIcon[$i]['class'];?>" src="img/x.gif" alt="<?php echo $resIcon[$i]['name'];?>" title="<?php echo $resIcon[$i]['name'];?>" />
                </a>
            </td>
            <?php endfor;?>
        </tr></tbody>
    </table>
    <?php endif;?>

    <div class="clear"></div>

    <?php
    // erori
    if (isset($_GET['e1'])) echo '<p class="error2">'.NOT_ENOUGH_RESOURCES.'</p>';
    elseif (isset($_GET['e2'])) echo '<p class="error2">'.INVALID_OFFER.'</p>';
    elseif (isset($_GET['e3'])) echo '<p class="error2">'.NOT_ENOUGH_MERCHANTS.'</p>';
    ?>

    <table id="range" cellpadding="1" cellspacing="1">
        <thead>
            <tr><th colspan="5"><a name="h2"></a><?php echo OFFERS_MARKETPLACE;?></th></tr>
            <tr>
                <td><?php echo OFFERED_TO_ME;?></td>
                <td><?php echo WANTED_TO_ME;?></td>
                <td><?php echo PLAYER;?></td>
                <td><?php echo DURATION;?></td>
                <td><?php echo ACTION;?></td>
            </tr>
        </thead>
        <tbody>
        <?php
        $offers = $market->onsale;
        $totalOffers = count($offers);

        if ($totalOffers > 0) {
            $end = min($u + 40, $totalOffers);
            for ($i = $u; $i < $end; $i++) {
                if (!isset($offers[$i])) continue;
                $offer = $offers[$i];

                $reqMerc = max(1, (int)ceil($offer['wamt'] / $market->maxcarry));
                $vref = (int)$offer['vref'];
                $owner = (int)$database->getVillageField($vref, "owner");
                $username = htmlspecialchars($database->getUserField($owner, "username", 0));
                $villagename = htmlspecialchars($database->getVillageField($vref, "name"));

                $hasRes = true;
                switch ($offer['wtype']) {
                    case 1: $hasRes = $village->awood > $offer['wamt']; break;
                    case 2: $hasRes = $village->aclay > $offer['wamt']; break;
                    case 3: $hasRes = $village->airon > $offer['wamt']; break;
                    case 4: $hasRes = $village->acrop > $offer['wamt']; break;
                }
                ?>
                <tr>
                    <td class="val">
                        <img src="img/x.gif" class="<?php echo $resIcon[$offer['gtype']]['class'];?>" alt="<?php echo $resIcon[$offer['gtype']]['name'];?>" title="<?php echo $resIcon[$offer['gtype']]['name'];?>" />
                        <?php echo (int)$offer['gamt'];?>
                    </td>
                    <td class="val">
                        <img src="img/x.gif" class="<?php echo $resIcon[$offer['wtype']]['class'];?>" alt="<?php echo $resIcon[$offer['wtype']]['name'];?>" title="<?php echo $resIcon[$offer['wtype']]['name'];?>" />
                        <?php echo (int)$offer['wamt'];?>
                    </td>
                    <td class="pla" title="<?php echo $villagename;?>">
                        <a href="karte.php?d=<?php echo $vref;?>&c=<?php echo $generator->getMapCheck($vref);?>"><?php echo $username;?></a>
                    </td>
                    <td class="dur"><?php echo $generator->getTimeFormat($offer['duration']);?></td>
                    <?php if (!$hasRes):?>
                        <td class="act none"><?php echo NOT_ENOUGH_RESOURCES;?></td>
                    <?php elseif ($reqMerc > $market->merchantAvail()):?>
                        <td class="act none"><?php echo NOT_ENOUGH_MERCHANTS;?></td>
                    <?php elseif ($session->access != BANNED):?>
                        <td class="act"><a href="build.php?id=<?php echo (int)$id;?>&t=1&a=<?php echo $session->mchecker;?>&g=<?php echo (int)$offer['id'];?>"><?php echo ACCEP_OFFER; ?></a></td>
                    <?php else:?>
                        <td class="act"><a href="banned.php"><?php echo ACCEP_OFFER;?></a></td>
                    <?php endif;?>
                </tr>
                <?php
            }
        } else {
            echo '<tr><td class="none" colspan="5">'.NO_AVAILABLE_OFFERS.'</td></tr>';
        }
        ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">
                    <?php
                    $prev = $u - 40;
                    $next = $u + 40;

                    if ($u == 0) echo '<span class="none"><b>&laquo;</b></span>';
                    else echo '<a href="build.php?id='.(int)$id.'&t=1&u='.$prev.'">&laquo;</a>';

                    if ($next >= $totalOffers) echo '<span class="none"><b>&raquo;</b></span>';
                    else echo '<a href="build.php?id='.(int)$id.'&t=1&u='.$next.'">&raquo;</a>';
                    ?>
                </td>
            </tr>
        </tfoot>
    </table>
</div>