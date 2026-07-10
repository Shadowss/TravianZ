<?php
#################################################################################
#  T4 hero auction tab (37_auction.tpl) - Phase 6                               #
#  POST actions:                                                                #
#    t4action=bid  (aucid, maxbid)                                              #
#    t4action=sell (rowid, qty, price, duration)                                #
#  bid_max is only ever shown for the viewer's OWN bids (getMyBids).           #
#################################################################################

$t4Auction = new HeroAuction();
$t4Msg = '';

if (isset($_POST['t4action'])) {
    if ($_POST['t4action'] === 'bid' && isset($_POST['aucid'], $_POST['maxbid'])) {
        $t4Result = $t4Auction->placeBid($session->uid, (int) $_POST['aucid'], (int) $_POST['maxbid']);
        if ($t4Result === HeroAuction::BID_OK) {
            $t4Msg = HERO_AUC_BID_OK;
        } elseif ($t4Result === HeroAuction::BID_OUTBID) {
            $t4Msg = HERO_AUC_BID_OUTBID;
        } elseif ($t4Result === HeroAuction::BID_NO_SILVER) {
            $t4Msg = HERO_AUC_BID_NOSILVER;
        } else {
            $t4Msg = HERO_AUC_BID_FAIL;
        }
    } elseif ($_POST['t4action'] === 'sell'
        && isset($_POST['rowid'], $_POST['qty'], $_POST['price'], $_POST['duration'])) {
        $t4Result = $t4Auction->createAuction(
            $session->uid, (int) $_POST['rowid'],
            (int) $_POST['qty'], (int) $_POST['price'], (int) $_POST['duration']
        );
        $t4Msg = ($t4Result > 0) ? HERO_AUC_SELL_OK : HERO_AUC_SELL_FAIL;
    }
}

$t4Open    = $t4Auction->getOpenAuctions(50, $session->uid);
$t4MyBids  = $t4Auction->getMyBids($session->uid);
$t4MySales = $t4Auction->getMySales($session->uid);
$t4Now     = time();

// Unequipped items sellable from the inventory.
$t4Sellable = array();
foreach ($t4HeroItems->getInventory($session->uid) as $t4Row) {
    if ($t4Row['equipped'] == 0 && !$t4Row['orphan']) {
        $t4Sellable[] = $t4Row;
    }
}
?>

<?php if ($t4Msg !== '') { ?>
    <p class="message" style="font-weight:bold;"><?php echo $t4Msg; ?></p>
<?php } ?>

<table id="distribution" cellpadding="1" cellspacing="1">
    <thead>
        <tr><th colspan="5"><?php echo HERO_AUC_OPEN; ?></th></tr>
        <tr>
            <td><b><?php echo HERO_AUC_ITEM; ?></b></td>
            <td><b><?php echo HERO_QUANTITY; ?></b></td>
            <td><b><?php echo HERO_AUC_PRICE; ?></b></td>
            <td><b><?php echo HERO_AUC_TIME_LEFT; ?></b></td>
            <td><b><?php echo HERO_AUC_BID; ?></b></td>
        </tr>
    </thead>
    <tbody>
    <?php if (count($t4Open)) { ?>
        <?php foreach ($t4Open as $t4A) { ?>
        <tr>
            <td><span class="heroT4Item item<?php echo (int) $t4A['itemid']; ?>"></span> <?php echo $t4A['name']; ?>
                <?php if ((int) $t4A['seller'] === 0) { ?><small>(<?php echo HERO_AUC_SELLER_NPC; ?>)</small><?php } ?>
            </td>
            <td style="text-align:center;"><?php echo (int) $t4A['quantity']; ?></td>
            <td style="text-align:right;"><?php echo number_format((int) $t4A['silver_current']); ?></td>
            <td><span id="timer<?php echo ++$session->timer; ?>"><?php echo $generator->getTimeFormat(max(0, $t4A['time_end'] - $t4Now)); ?></span></td>
            <td style="width:170px;text-align:center;">
                <?php if ((int) $t4A['seller'] !== $session->uid) { ?>
                <form action="" method="POST" style="margin:0;">
                    <input type="hidden" name="t4action" value="bid">
                    <input type="hidden" name="aucid" value="<?php echo (int) $t4A['id']; ?>">
                    <input type="text" name="maxbid" size="6" style="text-align:right;"
                           value="<?php echo (int) $t4A['silver_current'] + ((int) $t4A['bidder'] > 0 ? 1 : 0); ?>">
                    <input type="submit" value="<?php echo HERO_AUC_BID; ?>">
                </form>
                <?php } else { ?>-<?php } ?>
            </td>
        </tr>
        <?php } ?>
    <?php } else { ?>
        <tr><td colspan="5"><?php echo HERO_AUC_NONE; ?></td></tr>
    <?php } ?>
    </tbody>
</table>

<?php if (count($t4MyBids)) { ?>
<table id="distribution" cellpadding="1" cellspacing="1" style="margin-top:10px;">
    <thead>
        <tr><th colspan="4"><?php echo HERO_AUC_MY_BIDS; ?></th></tr>
    </thead>
    <tbody>
    <?php foreach ($t4MyBids as $t4A) { ?>
        <tr>
            <td><?php echo $t4A['name']; ?> (<?php echo (int) $t4A['quantity']; ?>x)</td>
            <td style="text-align:right;"><?php echo HERO_AUC_PRICE; ?>: <?php echo number_format((int) $t4A['silver_current']); ?></td>
            <td style="text-align:right;"><?php echo HERO_AUC_YOUR_MAX; ?>: <?php echo number_format((int) $t4A['bid_max']); ?></td>
            <td><span id="timer<?php echo ++$session->timer; ?>"><?php echo $generator->getTimeFormat(max(0, $t4A['time_end'] - $t4Now)); ?></span></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php } ?>

<?php if (count($t4MySales)) { ?>
<table id="distribution" cellpadding="1" cellspacing="1" style="margin-top:10px;">
    <thead>
        <tr><th colspan="3"><?php echo HERO_AUC_MY_SALES; ?></th></tr>
    </thead>
    <tbody>
    <?php foreach ($t4MySales as $t4A) { ?>
        <tr>
            <td><?php echo $t4A['name']; ?> (<?php echo (int) $t4A['quantity']; ?>x)</td>
            <td style="text-align:right;"><?php echo HERO_AUC_PRICE; ?>: <?php echo number_format((int) $t4A['silver_current']); ?></td>
            <td><span id="timer<?php echo ++$session->timer; ?>"><?php echo $generator->getTimeFormat(max(0, $t4A['time_end'] - $t4Now)); ?></span></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php } ?>

<?php if (count($t4Sellable)) { ?>
<table id="distribution" cellpadding="1" cellspacing="1" style="margin-top:10px;">
    <thead>
        <tr><th colspan="5"><?php echo HERO_AUC_SELL; ?></th></tr>
    </thead>
    <tbody>
        <tr>
            <form action="" method="POST" style="margin:0;">
            <input type="hidden" name="t4action" value="sell">
            <td>
                <select name="rowid">
                <?php foreach ($t4Sellable as $t4Row) { ?>
                    <option value="<?php echo (int) $t4Row['id']; ?>">
                        <?php echo $t4Row['name']; ?><?php if ((int) $t4Row['quantity'] > 1) echo ' (' . (int) $t4Row['quantity'] . 'x)'; ?>
                    </option>
                <?php } ?>
                </select>
            </td>
            <td><?php echo HERO_QUANTITY; ?>: <input type="text" name="qty" value="1" size="3" style="text-align:center;"></td>
            <td><?php echo HERO_AUC_START_PRICE; ?>: <input type="text" name="price" value="10" size="5" style="text-align:right;"></td>
            <td><?php echo HERO_AUC_DURATION; ?>:
                <select name="duration">
                    <option value="14400">4h</option>
                    <option value="28800">8h</option>
                    <option value="86400">24h</option>
                </select>
            </td>
            <td style="text-align:center;"><input type="submit" value="<?php echo HERO_AUC_LIST; ?>"></td>
            </form>
        </tr>
    </tbody>
</table>
<?php } ?>
