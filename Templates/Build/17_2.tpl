<?php
// 17_2.tpl - MARKETPLACE / SELL
global $database, $session, $village, $market, $id;

$res = [
    1 => ['class' => 'r1', 'name' => LUMBER],
    2 => ['class' => 'r2', 'name' => CLAY],
    3 => ['class' => 'r3', 'name' => IRON],
    4 => ['class' => 'r4', 'name' => CROP],
];

$merchantAvail = (int)$market->merchantAvail();
$totalMerchants = (int)$market->merchant;
?>
<div id="build" class="gid17">
    <a href="#" onClick="return Popup(17,4);" class="build_logo">
        <img class="building g17" src="img/x.gif" alt="<?php echo MARKETPLACE; ?>" title="<?php echo MARKETPLACE;?>" />
    </a>
    <h1><?php echo MARKETPLACE;?> <span class="level"><?php echo LEVEL;?> <?php echo (int)$village->resarray['f'.$id];?></span></h1>
    <p class="build_desc"><?php echo MARKETPLACE_DESC;?></p>

    <?php include("17_menu.tpl");?>

    <form method="POST" action="build.php">
        <input type="hidden" name="id" value="<?php echo (int)$id;?>" />
        <input type="hidden" name="ft" value="mk2" />

        <table id="sell" cellpadding="1" cellspacing="1">
            <tr>
                <th><?php echo OFFERING;?></th>
                <td class="val"><input class="text" tabindex="1" name="m1" value="" maxlength="6" /></td>
                <td class="res">
                    <select name="rid1" tabindex="2" class="dropdown">
                        <?php foreach ($res as $k => $r):?>
                        <option value="<?php echo $k;?>" <?php if($k==1) echo 'selected';?>><?php echo $r['name'];?></option>
                        <?php endforeach;?>
                    </select>
                </td>
                <td class="tra">
                    <input class="check" type="checkbox" tabindex="5" name="d1" value="1" /> <?php echo MAX_TIME_TRANSPORT;?>:
                    <input class="text" tabindex="6" name="d2" value="2" maxlength="2" /> <?php echo HOURS;?>
                </td>
            </tr>
            <tr>
                <th><?php echo SEARCHING;?></th>
                <td class="val"><input class="text" tabindex="3" name="m2" value="" maxlength="6" /></td>
                <td class="res">
                    <select name="rid2" tabindex="4" class="dropdown">
                        <?php foreach ($res as $k => $r):?>
                        <option value="<?php echo $k;?>" <?php if($k==2) echo 'selected';?>><?php echo $r['name'];?></option>
                        <?php endforeach;?>
                    </select>
                </td>
                <td class="al">
                    <?php if ((int)$session->userinfo['alliance'] !== 0):?>
                        <input class="check" type="checkbox" tabindex="7" name="ally" value="1" /> <?php echo OWN_ALLIANCE_ONLY;?>
                    <?php endif;?>
                </td>
            </tr>
        </table>

        <?php
        if (isset($_GET['e1'])) echo '<p class="error2">'.NOT_ENOUGH_RESOURCES.'</p>';
        elseif (isset($_GET['e2'])) echo '<p class="error2">'.INVALID_OFFER.'</p>';
        elseif (isset($_GET['e3'])) echo '<p class="error2">'.NOT_ENOUGH_MERCHANTS.'</p>';
        ?>

        <br /><p><?php echo MERCHANT;?>: <?php echo $merchantAvail;?>/<?php echo $totalMerchants;?></p>
        <p><input type="image" tabindex="8" value="ok" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" <?php if(!$merchantAvail) echo 'disabled';?> /></p>
    </form>

    <?php if (count($market->onmarket) > 0):?>
    <table id="sell_overview" cellpadding="1" cellspacing="1">
        <thead>
            <tr><th colspan="7"><?php echo OWN_OFFERS;?></th></tr>
            <tr>
                <td>&nbsp;</td>
                <td><?php echo OFFER;?></td>
                <td><?php echo TZ_RATIO; ?></td>
                <td><?php echo SEARCH;?></td>
                <td><?php echo MERCHANT;?></td>
                <td><?php echo ALLIANCE;?></td>
                <td><?php echo DURATION;?></td>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($market->onmarket as $offer):
            $offerId = (int)$offer['id'];
            $gtype = (int)$offer['gtype'];
            $wtype = (int)$offer['wtype'];
            $ratio = $offer['gamt'] > 0 ? round($offer['wamt'] / $offer['gamt'], 1) : 0;
            $ratioClass = $ratio <= 1 ? 'red' : ($ratio < 2 ? 'orange' : 'green');
            $delLink = $session->access != BANNED ? "build.php?id=".(int)$id."&t=2&a=5&del=".$offerId : "banned.php";
        ?>
            <tr>
                <td class="abo"><a href="<?php echo $delLink;?>"><img class="del" src="img/x.gif" alt="<?php echo DELETE; ?>" title="<?php echo DELETE;?>" /></a></td>
                <td class="val">
                    <img src="img/x.gif" class="<?php echo $res[$gtype]['class'];?>" alt="<?php echo $res[$gtype]['name'];?>" title="<?php echo $res[$gtype]['name'];?>" />
                    <?php echo (int)$offer['gamt'];?>
                </td>
                <td class="ratio <?php echo $ratioClass;?>"><?php echo $ratio;?></td>
                <td class="val">
                    <img src="img/x.gif" class="<?php echo $res[$wtype]['class'];?>" alt="<?php echo $res[$wtype]['name'];?>" title="<?php echo $res[$wtype]['name'];?>" />
                    <?php echo (int)$offer['wamt'];?>
                </td>
                <td class="tra"><?php echo (int)$offer['merchant'];?></td>
                <td class="al"><?php echo $offer['alliance'] == 0 ? 'No' : 'Yes';?></td>
                <td class="dur"><?php echo $offer['maxtime'] != 0 ? ((int)$offer['maxtime']/3600).' hrs.' : ALL;?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php endif;?>
</div>
