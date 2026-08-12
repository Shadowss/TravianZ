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

<style type="text/css">
/* ---------------------------------------------------------------------------
   Acelasi limbaj vizual ca pagina de licitatii (37_auction.tpl): badge de tier,
   bonus palid dedesubt, butoane verzi si latimi stranse. Toate clasele au
   prefixul "t4items" / "t4it-" ca sa nu atinga nimic altceva din interfata.
   Fara CSS grid si fara "gap": jocul e deschis si din browsere vechi.
   --------------------------------------------------------------------------- */

/* Cap de tabel pentru coloane: fara el nu se intelegea ce e fiecare valoare. */
table.t4items tr.t4cols th {
    background: #e8e8ea;
    color: #444;
    font-size: 11px;
    font-weight: bold;
    text-align: center;
    padding: 3px 5px;
    border-bottom: 1px solid #d0d0d4;
}

table.t4items td { padding: 5px 4px; vertical-align: middle; }

/* Latimile, intr-un singur loc. Stranse ca sa incapa in zona de continut
   (~505px) fara scroll orizontal: 78+40+150+96 = 364px fixi, restul ramane
   coloanei cu numele. Inainte, 110+46+230+170 = 556px depaseau singuri
   latimea paginii, iar numele se rupeau pe trei randuri. */
table.t4items th.c-type { width: 78px; }
table.t4items th.c-img  { width: 40px; }
table.t4items th.c-name { width: auto; }
table.t4items th.c-tier { width: 150px; }
table.t4items th.c-act  { width: 96px; }

/* Slotul (Coif, Arma, ...) */
table.t4items td.t4slot { text-align: left; font-size: 11px; }

/* Imaginea are coloana proprie, centrata. */
table.t4items td.t4img { text-align: center; vertical-align: middle; }

/* Numele obiectului */
table.t4items td.t4name { text-align: left; font-size: 11px; }

/* Tier + bonus, ca in tabelul de licitatii */
table.t4items td.t4tier { text-align: center; white-space: normal; }

table.t4items .t4badge {
    display: inline-block;
    min-width: 30px;
    padding: 1px 6px;
    font-size: 11px;
    font-weight: bold;
    color: #5c5850;
    background: #eceae5;
    border: 1px solid #cfccc5;
    border-radius: 3px;
}

/* consumabilele n-au tier, arata cantitatea - alt accent, ca sa se distinga */
table.t4items .t4badge.t4qty { color: #3f5f22; background: #e4f0d0; border-color: #a3bf7c; }

/* Bonusul, discret, sub badge. */
table.t4items .t4bonus {
    display: block;
    margin-top: 3px;
    color: #9b978f;
    font-size: 10px;
    line-height: 1.35;
    font-weight: normal;
}

/* Slot gol */
table.t4items td.t4empty { color: #a5a19a; font-style: normal; }

/* --- Actiuni --- */
table.t4items td.t4act { text-align: center; }
table.t4items .t4form { margin: 0; text-align: center; }

table.t4items .t4btn {
    display: inline-block;
    padding: 4px 12px;
    font-size: 11px;
    font-weight: bold;
    color: #3f5f22;
    cursor: pointer;
    white-space: nowrap;
    background: #e4f0d0;
    background: linear-gradient(#fbfdf6, #dcebc6);
    border: 1px solid #a3bf7c;
    border-radius: 4px;
}

table.t4items .t4btn:hover {
    background: #d6e8bd;
    background: linear-gradient(#ffffff, #cfe4b0);
    border-color: #8bab61;
}

table.t4items .t4btn:active {
    background: linear-gradient(#d5e6b8, #e9f3da);
    border-color: #8bab61;
}

/* butonul de dezechipare: neutru, nu verde - e o actiune "de retragere" */
table.t4items .t4btn.t4btn-off {
    color: #6b6862;
    background: linear-gradient(#fdfdfc, #e8e6e1);
    border-color: #c3c0b9;
}

table.t4items .t4btn.t4btn-off:hover {
    background: linear-gradient(#ffffff, #dedbd4);
    border-color: #aeaba4;
}

/* casuta de cantitate stivuita peste buton, ca la licitatii */
table.t4items .t4qtynum {
    display: block;
    width: 52px;
    margin: 0 auto 4px auto;
    padding: 2px 4px;
    text-align: right;
    border: 1px solid #b9b6b0;
    border-radius: 3px;
    font-size: 11px;
}

table.t4items .t4none { color: #a5a19a; }
</style>
<table id="distribution" class="t4items" cellpadding="1" cellspacing="1">
    <thead>
        <tr><th colspan="5"><?php echo HERO_ITEMS_EQUIPPED; ?></th></tr>
        <tr class="t4cols">
            <th class="c-type"><?php echo HERO_COL_TYPE; ?></th>
            <th class="c-img"><?php echo HERO_COL_IMAGE; ?></th>
            <th class="c-name"><?php echo HERO_COL_NAME; ?></th>
            <th class="c-tier"><?php echo HERO_COL_TIER; ?></th>
            <th class="c-act"><?php echo HERO_COL_ACTION; ?></th>
        </tr>
    </thead>
    <tbody>
    <?php for ($t4Slot = 1; $t4Slot <= 6; $t4Slot++) { ?>
        <tr>
            <td class="t4slot"><b><?php echo constant('HERO_SLOT_' . $t4Slot); ?></b></td>
            <?php if (isset($t4Equipped[$t4Slot])) {
                $t4Row   = $t4Equipped[$t4Slot];
                $t4Bonus = heroItemBonusText((int) $t4Row['itemid']);
            ?>
            <td class="t4img"><span class="heroT4Item item<?php echo (int) $t4Row['itemid']; ?>"></span></td>
            <td class="t4name"><?php echo $t4Row['name']; ?></td>
            <td class="t4tier">
                <span class="t4badge"><?php echo HERO_COL_TIER; ?> <?php echo (int) $t4Row['def']['tier']; ?></span>
                <?php if ($t4Bonus !== '') { ?>
                    <span class="t4bonus"><?php echo htmlspecialchars($t4Bonus, ENT_QUOTES, 'UTF-8'); ?></span>
                <?php } ?>
            </td>
            <td class="t4act">
                <?php if ($t4AwayReason === '') { ?>
                <form action="" method="POST" class="t4form">
                    <input type="hidden" name="t4action" value="unequip">
                    <input type="hidden" name="rowid" value="<?php echo (int) $t4Row['id']; ?>">
                    <button type="submit" class="t4btn t4btn-off"><?php echo HERO_UNEQUIP; ?></button>
                </form>
                <?php } else { ?>
                <span class="t4none">&mdash;</span>
                <?php } ?>
            </td>
            <?php } else { ?>
            <td colspan="4" class="t4empty">&mdash;</td>
            <?php } ?>
        </tr>
    <?php } ?>
    </tbody>
</table>

<table id="distribution" class="t4items" cellpadding="1" cellspacing="1" style="margin-top:10px;">
    <thead>
        <tr><th colspan="5"><?php echo HERO_ITEMS_BAG; ?></th></tr>
        <tr class="t4cols">
            <th class="c-type"><?php echo HERO_COL_TYPE; ?></th>
            <th class="c-img"><?php echo HERO_COL_IMAGE; ?></th>
            <th class="c-name"><?php echo HERO_COL_NAME; ?></th>
            <th class="c-tier"><?php echo HERO_COL_TIER; ?></th>
            <th class="c-act"><?php echo HERO_COL_ACTION; ?></th>
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
            <td class="t4slot"><b><?php echo constant('HERO_SLOT_' . (int) $t4Row['def']['slot']); ?></b></td>
            <td class="t4img"><span class="heroT4Item item<?php echo (int) $t4Row['itemid']; ?>"></span></td>
            <td class="t4name"><?php echo $t4Row['name']; ?></td>
            <td class="t4tier">
                <?php if ($t4IsBag) { ?>
                    <?php // consumabilele n-au tier: afisam cate bucati sunt ?>
                    <span class="t4badge t4qty"><?php echo (int) $t4Row['quantity']; ?>x</span>
                <?php } else { ?>
                    <span class="t4badge"><?php echo HERO_COL_TIER; ?> <?php echo (int) $t4Row['def']['tier']; ?></span>
                <?php } ?>
                <?php if ($t4Bonus !== '') { ?>
                    <span class="t4bonus"><?php echo htmlspecialchars($t4Bonus, ENT_QUOTES, 'UTF-8'); ?></span>
                <?php } ?>
            </td>
            <td class="t4act">
                <form action="" method="POST" class="t4form">
                    <input type="hidden" name="rowid" value="<?php echo (int) $t4Row['id']; ?>">
                    <?php if ($t4IsBag) { ?>
                        <input type="hidden" name="t4action" value="useitem">
                        <input type="text" name="qty" value="1" class="t4qtynum">
                        <button type="submit" class="t4btn"><?php echo HERO_USE_ITEM; ?></button>
                    <?php } elseif ($t4AwayReason === '') { ?>
                        <input type="hidden" name="t4action" value="equip">
                        <button type="submit" class="t4btn"><?php echo HERO_EQUIP; ?></button>
                    <?php } else { ?>
                        <span class="t4none">&mdash;</span>
                    <?php } ?>
                </form>
            </td>
        </tr>
    <?php } ?>
    <?php if (!$t4HasUnequipped) { ?>
        <tr><td colspan="5" class="t4empty"><?php echo HERO_ITEMS_EMPTY; ?></td></tr>
    <?php } ?>
    </tbody>
</table>
