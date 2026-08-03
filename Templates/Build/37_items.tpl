<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : HERO T4 ITEMS PAGE                                        ##
##  Type           : BUILDING TEMPLATE                                         ##
## --------------------------------------------------------------------------- ##
##  Created by     : Shadow                                                    ##
##  Designed by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  Test Server    : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

$t4Msg = '';

// Eroul poate schimba echipamentul doar cat timp e in sat (ca in Travian
// original). Motivul e calculat o singura data si folosit atat pentru mesaj,
// cat si pentru ascunderea butoanelor. Regula e impusa si in HeroItems, deci
// un POST trimis manual nu o poate ocoli.
$t4AwayReason = $t4HeroItems->heroAwayReason($session->uid);

$t4AwayText = '';
if ($t4AwayReason === 'nohero') {
    $t4AwayText = defined('HERO_LOCKED_NOHERO') ? HERO_LOCKED_NOHERO
        : 'You have no hero yet. Train one in the Hero\'s Mansion before equipping items.';
} elseif ($t4AwayReason === 'adventure') {
    $t4AwayText = defined('HERO_LOCKED_ADVENTURE') ? HERO_LOCKED_ADVENTURE
        : 'Your hero is on an adventure. Equipment can only be changed while the hero is in a village.';
} elseif ($t4AwayReason === 'attack') {
    $t4AwayText = defined('HERO_LOCKED_ATTACK') ? HERO_LOCKED_ATTACK
        : 'Your hero is on the move with the army. Equipment can only be changed while the hero is in a village.';
} elseif ($t4AwayReason === 'reinforcement') {
    $t4AwayText = defined('HERO_LOCKED_REINFORCEMENT') ? HERO_LOCKED_REINFORCEMENT
        : 'Your hero is reinforcing another village. Equipment can only be changed while the hero is in a village.';
}

if (isset($_POST['t4action'], $_POST['rowid'])) {
    $t4RowId = (int) $_POST['rowid'];

    switch ($_POST['t4action']) {
        case 'equip':
            $t4Msg = $t4HeroItems->equipItem($session->uid, $t4RowId)
                ? HERO_EQUIP_OK : HERO_EQUIP_FAIL;
            break;

        case 'unequip':
            $t4Msg = $t4HeroItems->unequipItem($session->uid, $t4RowId)
                ? HERO_UNEQUIP_OK : HERO_ITEM_USE_FAIL;
            break;

        case 'useitem':
            $t4Qty    = max(1, (int) ($_POST['qty'] ?? 1));
            $t4Result = $t4HeroItems->useItem($session->uid, $t4RowId, $t4Qty, $village->wid);
            if ($t4Result === HeroItems::USE_OK) {
                $t4Msg = HERO_ITEM_USED_OK;
            } elseif ($t4Result === HeroItems::USE_DEFERRED) {
                $t4Msg = HERO_ITEM_USE_BATTLE;
            } else {
                $t4Msg = HERO_ITEM_USE_FAIL;
            }
            break;
    }
}

$t4Inventory = $t4HeroItems->getInventory($session->uid);
$t4Equipped  = $t4HeroItems->getEquipped($session->uid);
?>

<?php if ($t4AwayText !== '') { ?>
    <p class="message" style="font-weight:bold;color:#8a6d3b;background:#fcf8e3;border:1px solid #faebcc;padding:6px 9px;border-radius:4px;">
        <?php echo $t4AwayText; ?>
    </p>
<?php } ?>
<?php if ($t4Msg !== '') { ?>
    <p class="message" style="font-weight:bold;"><?php echo $t4Msg; ?></p>
<?php } ?>

<style>
/* Cap de tabel pentru coloane: fara el nu se intelegea ce e fiecare valoare. */
table.t4items tr.t4cols th{background:#e8e8ea;color:#444;font-size:11px;
    font-weight:bold;text-align:center;padding:3px 5px;border-bottom:1px solid #d0d0d4}
/* Imaginea are coloana proprie, centrata. */
table.t4items td.t4img{text-align:center;vertical-align:middle;width:46px}
table.t4items td.t4tier{text-align:center;white-space:normal}
/* Bonusul, discret, langa tier. */
table.t4items .t4bonus{display:block;color:#777;font-size:10px;line-height:1.3;font-weight:normal}
</style>
<table id="distribution" class="t4items" cellpadding="1" cellspacing="1">
    <thead>
        <tr><th colspan="5"><?php echo HERO_ITEMS_EQUIPPED; ?></th></tr>
        <tr class="t4cols">
            <th style="width:110px;"><?php echo HERO_COL_TYPE; ?></th>
            <th style="width:46px;"><?php echo HERO_COL_IMAGE; ?></th>
            <th><?php echo HERO_COL_NAME; ?></th>
            <th style="width:230px;"><?php echo HERO_COL_TIER; ?></th>
            <th style="width:110px;"><?php echo HERO_COL_ACTION; ?></th>
        </tr>
    </thead>
    <tbody>
    <?php for ($t4Slot = 1; $t4Slot <= 6; $t4Slot++) { ?>
        <tr>
            <td style="width:110px;"><b><?php echo constant('HERO_SLOT_' . $t4Slot); ?></b></td>
            <?php if (isset($t4Equipped[$t4Slot])) {
                $t4Row   = $t4Equipped[$t4Slot];
                $t4Bonus = heroItemBonusText((int) $t4Row['itemid']);
            ?>
            <td class="t4img"><span class="heroT4Item item<?php echo (int) $t4Row['itemid']; ?>"></span></td>
            <td><?php echo $t4Row['name']; ?></td>
            <td class="t4tier">
                T<?php echo (int) $t4Row['def']['tier']; ?>
                <?php if ($t4Bonus !== '') { ?>
                    <span class="t4bonus">(<?php echo htmlspecialchars($t4Bonus, ENT_QUOTES, 'UTF-8'); ?>)</span>
                <?php } ?>
            </td>
            <td style="width:110px;text-align:center;">
                <?php if ($t4AwayReason === '') { ?>
                <form action="" method="POST" style="margin:0;">
                    <input type="hidden" name="t4action" value="unequip">
                    <input type="hidden" name="rowid" value="<?php echo (int) $t4Row['id']; ?>">
                    <input type="submit" value="<?php echo HERO_UNEQUIP; ?>">
                </form>
                <?php } else { ?>
                <span style="color:#999;">&mdash;</span>
                <?php } ?>
            </td>
            <?php } else { ?>
            <td colspan="4" style="color:#888;">-</td>
            <?php } ?>
        </tr>
    <?php } ?>
    </tbody>
</table>

<table id="distribution" class="t4items" cellpadding="1" cellspacing="1" style="margin-top:10px;">
    <thead>
        <tr><th colspan="5"><?php echo HERO_ITEMS_BAG; ?></th></tr>
        <tr class="t4cols">
            <th style="width:110px;"><?php echo HERO_COL_TYPE; ?></th>
            <th style="width:46px;"><?php echo HERO_COL_IMAGE; ?></th>
            <th><?php echo HERO_COL_NAME; ?></th>
            <th style="width:230px;"><?php echo HERO_COL_TIER; ?></th>
            <th style="width:170px;"><?php echo HERO_COL_ACTION; ?></th>
        </tr>
    </thead>
    <tbody>
    <?php
    $t4HasUnequipped = false;
    foreach ($t4Inventory as $t4Row) {
        if ($t4Row['equipped'] == 1 || $t4Row['orphan']) {
            continue;
        }
        $t4HasUnequipped = true;
        $t4IsBag = ((int) $t4Row['def']['slot'] === HSLOT_BAG);
    ?>
        <?php $t4Bonus = heroItemBonusText((int) $t4Row['itemid']); ?>
        <tr>
            <td style="width:110px;"><b><?php echo constant('HERO_SLOT_' . (int) $t4Row['def']['slot']); ?></b></td>
            <td class="t4img"><span class="heroT4Item item<?php echo (int) $t4Row['itemid']; ?>"></span></td>
            <td><?php echo $t4Row['name']; ?></td>
            <td class="t4tier">
                <?php
                    // consumabilele n-au tier: afisam cate bucati sunt
                    echo $t4IsBag
                        ? (int) $t4Row['quantity'] . 'x'
                        : 'T' . (int) $t4Row['def']['tier'];
                ?>
                <?php if ($t4Bonus !== '') { ?>
                    <span class="t4bonus">(<?php echo htmlspecialchars($t4Bonus, ENT_QUOTES, 'UTF-8'); ?>)</span>
                <?php } ?>
            </td>
            <td style="width:170px;text-align:center;">
                <form action="" method="POST" style="margin:0;">
                    <input type="hidden" name="rowid" value="<?php echo (int) $t4Row['id']; ?>">
                    <?php if ($t4IsBag) { ?>
                        <input type="hidden" name="t4action" value="useitem">
                        <input type="text" name="qty" value="1" size="3" style="text-align:center;">
                        <input type="submit" value="<?php echo HERO_USE_ITEM; ?>">
                    <?php } elseif ($t4AwayReason === '') { ?>
                        <input type="hidden" name="t4action" value="equip">
                        <input type="submit" value="<?php echo HERO_EQUIP; ?>">
                    <?php } else { ?>
                        <span style="color:#999;">&mdash;</span>
                    <?php } ?>
                </form>
            </td>
        </tr>
    <?php } ?>
    <?php if (!$t4HasUnequipped) { ?>
        <tr><td colspan="5"><?php echo HERO_ITEMS_EMPTY; ?></td></tr>
    <?php } ?>
    </tbody>
</table>
