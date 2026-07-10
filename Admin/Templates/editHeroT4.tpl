<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : editHeroT4.tpl                                            ##
##  Type           : Admin Panel Frontend - T4 hero port controls              ##
## --------------------------------------------------------------------------- ##
##  Refactored by  : Shadow                                                    ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################
if (!isset($_GET['uid'])) { echo '<p>Missing uid.</p>'; return; }
$id = (int) $_GET['uid'];

include_once("../GameEngine/Data/hero_items.php");
include_once("../GameEngine/HeroItems.php");
include_once("../GameEngine/HeroAuction.php");
include_once("../GameEngine/HeroAdventure.php");

$t4HeroItems = new HeroItems();
$t4Auction   = new HeroAuction();
$t4Adv       = new HeroAdventure();

$t4Silver    = $t4HeroItems->getSilver($id);
$t4Inventory = $t4HeroItems->getInventory($id);
$t4Sales     = $t4Auction->getMySales($id);
$t4Bids      = $t4Auction->getMyBids($id);
$t4Offers    = $t4Adv->getOffers($id);
$t4Running   = $t4Adv->getRunning($id);
$t4SlotNames = [1=>'Helmet',2=>'Body',3=>'Right hand',4=>'Left hand',5=>'Shoes',6=>'Horse',7=>'Bag'];
?>
<style>
.t4a-card{background:#fff;border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.04);margin-bottom:12px;}
.t4a-card h3{margin:0;padding:9px 14px;background:#f8fafc;border-bottom:1px solid #e5e7eb;font-size:12px;text-transform:uppercase;color:#475569;letter-spacing:.4px;font-weight:600;}
.t4a-card .body{padding:14px;}
.t4a-table{width:100%;border-collapse:collapse;font-size:13px;}
.t4a-table th{background:#f8fafc;padding:8px 10px;font-size:11px;text-transform:uppercase;color:#64748b;text-align:left;border-bottom:1px solid #e5e7eb;}
.t4a-table td{padding:8px 10px;border-bottom:1px solid #f1f5f9;vertical-align:middle;}
.t4a-table tr:last-child td{border-bottom:0;}
.t4a-btn{padding:5px 12px;border-radius:6px;border:1px solid #cbd5e1;background:#fff;cursor:pointer;font-size:12px;font-weight:600;color:#475569;}
.t4a-btn:hover{background:#66CCCC;color:#fff;border-color:#66CCCC;}
.t4a-btn.danger:hover{background:#dc2626;border-color:#dc2626;}
.t4a-inline{display:flex;gap:8px;align-items:center;flex-wrap:wrap;}
.t4a-inline input[type=text],.t4a-inline select{padding:6px 8px;border:1px solid #cbd5e1;border-radius:6px;font-size:13px;}
.t4a-msg{padding:8px 12px;border-radius:8px;margin-bottom:12px;font-size:13px;font-weight:600;}
.t4a-msg.ok{background:#ecfdf5;color:#047857;border:1px solid #a7f3d0;}
.t4a-msg.err{background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;}
</style>

<h2>T4 Hero controls — user #<?php echo $id; ?>
    <small><a href="admin.php?p=editHero&uid=<?php echo $id; ?>">&laquo; classic hero editor</a></small>
</h2>

<?php if (isset($_GET['ok'])) { ?><div class="t4a-msg ok">Action completed.</div><?php } ?>
<?php if (isset($_GET['e']))  { ?><div class="t4a-msg err">Action failed (check the values and try again).</div><?php } ?>

<div class="t4a-card">
    <h3>Silver</h3>
    <div class="body">
        <form action="../GameEngine/Admin/Mods/editHeroT4.php" method="POST" class="t4a-inline">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="t4admin" value="setsilver">
            <input type="hidden" name="uid" value="<?php echo $id; ?>">
            <input type="text" name="silver" value="<?php echo $t4Silver; ?>" size="10" style="text-align:right;">
            <button type="submit" class="t4a-btn">Set balance</button>
        </form>
    </div>
</div>

<div class="t4a-card">
    <h3>Grant item</h3>
    <div class="body">
        <form action="../GameEngine/Admin/Mods/editHeroT4.php" method="POST" class="t4a-inline">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="t4admin" value="giveitem">
            <input type="hidden" name="uid" value="<?php echo $id; ?>">
            <select name="itemid">
                <?php foreach ($heroItemCatalog as $t4Iid => $t4Def) { ?>
                <option value="<?php echo $t4Iid; ?>">#<?php echo $t4Iid; ?> — <?php echo $t4Def['name']; ?> (T<?php echo $t4Def['tier']; ?>, <?php echo $t4SlotNames[$t4Def['slot']]; ?>)</option>
                <?php } ?>
            </select>
            Qty: <input type="text" name="qty" value="1" size="3" style="text-align:center;">
            <button type="submit" class="t4a-btn">Grant</button>
        </form>
    </div>
</div>

<div class="t4a-card">
    <h3>Inventory (<?php echo count($t4Inventory); ?>)</h3>
    <div class="body">
    <?php if (count($t4Inventory)) { ?>
        <table class="t4a-table">
            <tr><th>Row</th><th>Item</th><th>Slot</th><th>Qty</th><th>Equipped</th><th></th></tr>
            <?php foreach ($t4Inventory as $t4Row) { ?>
            <tr>
                <td>#<?php echo (int) $t4Row['id']; ?></td>
                <td><?php echo $t4Row['name']; ?><?php if ($t4Row['orphan']) echo ' <b style="color:#b91c1c;">(orphan itemid ' . (int) $t4Row['itemid'] . ')</b>'; ?></td>
                <td><?php echo $t4SlotNames[(int) $t4Row['slot']] ?? (int) $t4Row['slot']; ?></td>
                <td><?php echo (int) $t4Row['quantity']; ?></td>
                <td><?php echo $t4Row['equipped'] ? 'yes' : '-'; ?></td>
                <td>
                    <form action="../GameEngine/Admin/Mods/editHeroT4.php" method="POST" style="margin:0;"
                          onsubmit="return confirm('Delete this item row permanently?');">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="t4admin" value="delitem">
                        <input type="hidden" name="uid" value="<?php echo $id; ?>">
                        <input type="hidden" name="rowid" value="<?php echo (int) $t4Row['id']; ?>">
                        <button type="submit" class="t4a-btn danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    <?php } else { ?>No items.<?php } ?>
    </div>
</div>

<div class="t4a-card">
    <h3>Open auctions by this player (<?php echo count($t4Sales); ?>) / bids (<?php echo count($t4Bids); ?>)</h3>
    <div class="body">
    <?php if (count($t4Sales) || count($t4Bids)) { ?>
        <table class="t4a-table">
            <tr><th>Auction</th><th>Role</th><th>Item</th><th>Price</th><th>Ends</th><th></th></tr>
            <?php foreach ([['rows' => $t4Sales, 'role' => 'seller'], ['rows' => $t4Bids, 'role' => 'top bidder']] as $t4Group) { ?>
                <?php foreach ($t4Group['rows'] as $t4A) { ?>
                <tr>
                    <td>#<?php echo (int) $t4A['id']; ?></td>
                    <td><?php echo $t4Group['role']; ?></td>
                    <td><?php echo $t4A['name']; ?> (<?php echo (int) $t4A['quantity']; ?>x)</td>
                    <td><?php echo number_format((int) $t4A['silver_current']); ?></td>
                    <td><?php echo date('d.m H:i', (int) $t4A['time_end']); ?></td>
                    <td>
                        <form action="../GameEngine/Admin/Mods/editHeroT4.php" method="POST" style="margin:0;"
                              onsubmit="return confirm('Cancel this auction? Bidder is refunded, item returns to the seller.');">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="t4admin" value="cancelauction">
                            <input type="hidden" name="uid" value="<?php echo $id; ?>">
                            <input type="hidden" name="aucid" value="<?php echo (int) $t4A['id']; ?>">
                            <button type="submit" class="t4a-btn danger">Cancel</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        </table>
    <?php } else { ?>No open auction involvement.<?php } ?>
    </div>
</div>

<div class="t4a-card">
    <h3>Adventures</h3>
    <div class="body">
        <?php if ($t4Running) { ?>
            <p><b>Running:</b> adventure #<?php echo (int) $t4Running['id']; ?>,
               difficulty <?php echo (int) $t4Running['difficulty'] === 1 ? 'hard' : 'normal'; ?>,
               arrives <?php echo date('d.m H:i:s', (int) $t4Running['endtime']); ?> (do not delete running adventures).</p>
        <?php } ?>
        <?php if (count($t4Offers)) { ?>
        <table class="t4a-table">
            <tr><th>Offer</th><th>Difficulty</th><th>Duration</th><th>Expires</th><th></th></tr>
            <?php foreach ($t4Offers as $t4O) { ?>
            <tr>
                <td>#<?php echo (int) $t4O['id']; ?></td>
                <td><?php echo (int) $t4O['difficulty'] === 1 ? 'hard' : 'normal'; ?></td>
                <td><?php echo gmdate('H:i:s', (int) $t4O['duration']); ?></td>
                <td><?php echo date('d.m H:i', (int) $t4O['expire']); ?></td>
                <td>
                    <form action="../GameEngine/Admin/Mods/editHeroT4.php" method="POST" style="margin:0;">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="t4admin" value="deladventure">
                        <input type="hidden" name="uid" value="<?php echo $id; ?>">
                        <input type="hidden" name="advid" value="<?php echo (int) $t4O['id']; ?>">
                        <button type="submit" class="t4a-btn danger">Remove</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
        <?php } else { ?>No available offers.<?php } ?>
    </div>
</div>
