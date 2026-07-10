<?php
#################################################################################
#  T4 hero inventory & equipment tab (37_items.tpl) - Phase 6                   #
#  Inline POST handling (same convention as 37_hero.tpl's rename form):        #
#    t4action=equip|unequip|useitem, rowid, qty                                 #
#  Law tablets target the CURRENT village ($village->wid).                     #
#################################################################################

$t4Msg = '';

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

<?php if ($t4Msg !== '') { ?>
    <p class="message" style="font-weight:bold;"><?php echo $t4Msg; ?></p>
<?php } ?>

<table id="distribution" cellpadding="1" cellspacing="1">
    <thead>
        <tr><th colspan="4"><?php echo HERO_ITEMS_EQUIPPED; ?></th></tr>
    </thead>
    <tbody>
    <?php for ($t4Slot = 1; $t4Slot <= 6; $t4Slot++) { ?>
        <tr>
            <td style="width:110px;"><b><?php echo constant('HERO_SLOT_' . $t4Slot); ?></b></td>
            <?php if (isset($t4Equipped[$t4Slot])) { $t4Row = $t4Equipped[$t4Slot]; ?>
            <td title="<?php echo htmlspecialchars(heroItemBonusText((int) $t4Row['itemid'])); ?>"><span class="heroT4Item item<?php echo (int) $t4Row['itemid']; ?>"></span> <?php echo $t4Row['name']; ?></td>
            <td style="width:60px;text-align:center;"><?php echo 'T' . (int) $t4Row['def']['tier']; ?></td>
            <td style="width:110px;text-align:center;">
                <form action="" method="POST" style="margin:0;">
                    <input type="hidden" name="t4action" value="unequip">
                    <input type="hidden" name="rowid" value="<?php echo (int) $t4Row['id']; ?>">
                    <input type="submit" value="<?php echo HERO_UNEQUIP; ?>">
                </form>
            </td>
            <?php } else { ?>
            <td colspan="3" style="color:#888;">-</td>
            <?php } ?>
        </tr>
    <?php } ?>
    </tbody>
</table>

<table id="distribution" cellpadding="1" cellspacing="1" style="margin-top:10px;">
    <thead>
        <tr><th colspan="4"><?php echo HERO_ITEMS_BAG; ?></th></tr>
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
        <tr>
            <td title="<?php echo htmlspecialchars(heroItemBonusText((int) $t4Row['itemid'])); ?>"><span class="heroT4Item item<?php echo (int) $t4Row['itemid']; ?>"></span> <?php echo $t4Row['name']; ?></td>
            <td style="width:80px;text-align:center;">
                <?php echo $t4IsBag ? (int) $t4Row['quantity'] . 'x' : 'T' . (int) $t4Row['def']['tier']; ?>
            </td>
            <td style="width:110px;text-align:center;"><?php echo constant('HERO_SLOT_' . (int) $t4Row['def']['slot']); ?></td>
            <td style="width:170px;text-align:center;">
                <form action="" method="POST" style="margin:0;">
                    <input type="hidden" name="rowid" value="<?php echo (int) $t4Row['id']; ?>">
                    <?php if ($t4IsBag) { ?>
                        <input type="hidden" name="t4action" value="useitem">
                        <input type="text" name="qty" value="1" size="3" style="text-align:center;">
                        <input type="submit" value="<?php echo HERO_USE_ITEM; ?>">
                    <?php } else { ?>
                        <input type="hidden" name="t4action" value="equip">
                        <input type="submit" value="<?php echo HERO_EQUIP; ?>">
                    <?php } ?>
                </form>
            </td>
        </tr>
    <?php } ?>
    <?php if (!$t4HasUnequipped) { ?>
        <tr><td colspan="4"><?php echo HERO_ITEMS_EMPTY; ?></td></tr>
    <?php } ?>
    </tbody>
</table>
