<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : HERO T4 AUCTION PAGE                                      ##
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

$t4Auction = new HeroAuction();
$t4Msg = '';

if (isset($_POST['t4action'])) {
    // --- SCHIMB AUR <-> ARGINT -------------------------------------------
    // Validarea si atomicitatea sunt in HeroItems::exchange*(); aici doar
    // afisam rezultatul si tinem sesiunea sincronizata cu noul sold de aur.
    if (($_POST['t4action'] === 'g2s' || $_POST['t4action'] === 's2g') && isset($_POST['amount'])) {
        $t4Items  = new HeroItems();
        $t4Amount = (int) $_POST['amount'];

        $t4Ex = ($_POST['t4action'] === 'g2s')
            ? $t4Items->exchangeGoldToSilver($session->uid, $t4Amount)
            : $t4Items->exchangeSilverToGold($session->uid, $t4Amount);

        if ($t4Ex === HeroItems::EXCHANGE_OK) {
            $t4Msg = defined('HERO_EXCHANGE_OK') ? HERO_EXCHANGE_OK : 'Exchange completed.';

            // soldul de aur din sesiune trebuie reimprospatat, altfel pagina ar
            // arata vechea valoare pana la expirarea cache-ului de utilizator
            $t4NewGold = (int) $database->getUserField($session->uid, 'gold', 0);
            $session->gold  = $t4NewGold;
            $_SESSION['gold'] = $t4NewGold;
            unset($_SESSION['cache_user_' . (isset($_SESSION['username']) ? $_SESSION['username'] : '')]);

        } elseif ($t4Ex === HeroItems::EXCHANGE_NOT_ENOUGH) {
            $t4Msg = defined('HERO_EXCHANGE_NOTENOUGH') ? HERO_EXCHANGE_NOTENOUGH : 'You do not have enough for this exchange.';
        } elseif ($t4Ex === HeroItems::EXCHANGE_NO_HERO) {
            $t4Msg = defined('HERO_LOCKED_NOHERO') ? HERO_LOCKED_NOHERO : 'You have no hero yet.';
        } else {
            $t4Msg = defined('HERO_EXCHANGE_FAIL') ? HERO_EXCHANGE_FAIL : 'The exchange could not be completed.';
        }
    }

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

<style type="text/css">
/* ---------------------------------------------------------------------------
   Stiluri locale pentru pagina de licitatii. Toate clasele au prefixul
   "t4auc-" ca sa nu atinga nimic altceva din interfata.
   --------------------------------------------------------------------------- */

/* --- Casa de schimb: cele doua celule egale pe inaltime, continut centrat --- */
.t4auc-ex td { vertical-align: middle; }
.t4auc-ex-cell { width: 50%; padding: 12px 10px; }

.t4auc-ex-inner {
    max-width: 290px;
    margin: 0 auto;          /* centrat pe orizontala in celula */
    text-align: left;
}

.t4auc-balance {
    display: flex;
    justify-content: center;
    gap: 18px;
    margin: 0 0 12px 0;
    padding: 0 0 10px 0;
    border-bottom: 1px solid #dcd9d3;
}

.t4auc-bal {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    white-space: nowrap;
}

.t4auc-bal b { font-size: 13px; }

/* Aceleasi monede desenate ca in bara de sus (header.tpl) */
.t4auc-coin { display: block; width: 18px; height: 18px; flex: 0 0 18px; }
.t4auc-coin .t4auc-coinBg    { fill: #f6f5f2; stroke: #b8b6b1; stroke-width: 1; }
.t4auc-coin-gold   .t4auc-coinDisc  { fill: #e3b427; stroke: #9a7512; stroke-width: .8; }
.t4auc-coin-gold   .t4auc-coinShine { fill: #f7e08a; }
.t4auc-coin-silver .t4auc-coinDisc  { fill: #cdd2d6; stroke: #7e858b; stroke-width: .8; }
.t4auc-coin-silver .t4auc-coinShine { fill: #eef1f3; }

.t4auc-form {
    display: flex;
    align-items: center;
    gap: 7px;
    margin: 0 0 9px 0;
}

.t4auc-num {
    width: 76px;
    padding: 3px 5px;
    text-align: right;
    border: 1px solid #b9b6b0;
    border-radius: 3px;
    font-size: 12px;
}

.t4auc-rate {
    color: #8a877f;
    font-size: 11px;
    white-space: nowrap;
}

.t4auc-hint {
    margin: 10px 0 0 0;
    color: #8a877f;
    font-size: 11px;
    line-height: 1.45;
}

.t4auc-merchant { max-width: 100%; max-height: 230px; }

/* --- Butoane --- */
.t4auc-btn {
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

.t4auc-btn:hover {
    background: #d6e8bd;
    background: linear-gradient(#ffffff, #cfe4b0);
    border-color: #8bab61;
}

.t4auc-btn:active {
    background: linear-gradient(#d5e6b8, #e9f3da);
    border-color: #8bab61;
}

/* --- Tabelul de licitatii deschise ---------------------------------------
   Latimile sunt stranse la minimul in care incape headerul, ca tabelul sa nu
   mai depaseasca zona de continut (~505px) si sa nu mai apara scroll
   orizontal. Total: 78+96+66+46+66+74 = 426px + padding. */
.t4auc-tbl th { text-align: center; }

/* fara white-space:nowrap pe th: "Se incheie in" se rupe pe doua randuri
   in loc sa forteze latirea coloanei */
.t4auc-tbl td, .t4auc-tbl th { padding: 4px 3px; }

.t4auc-col-item  { width: 78px; text-align: center; }
.t4auc-col-tier  { width: 96px; text-align: center; }
.t4auc-col-qty   { width: 66px; text-align: center; }
.t4auc-col-price { width: 46px; text-align: center; }
.t4auc-col-time  { width: 66px; text-align: center; }
.t4auc-col-bid   { width: 74px; text-align: center; }

/* Obiect: iconita sus, numele dedesubt cu scris palid */
.t4auc-itemname {
    display: block;
    margin-top: 2px;
    color: #9b978f;
    font-size: 10px;
    line-height: 1.3;
    word-wrap: break-word;
}

/* Tier: numarul sus, abilitatea dedesubt cu scris mai pal */
.t4auc-tier {
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

.t4auc-ability {
    display: block;
    margin-top: 3px;
    color: #9b978f;      /* palid, ca sa nu concureze cu numele obiectului */
    font-size: 9px;
    line-height: 1.3;
    word-wrap: break-word;
}

/* Oferta: casuta SUS, butonul DEDESUBT - una langa alta cereau ~116px,
   stivuite incap in 74px */
.t4auc-bidform { margin: 0; text-align: center; }

.t4auc-bidnum {
    display: block;
    width: 56px;
    margin: 0 auto 3px auto;
    padding: 2px 4px;
    text-align: right;
    border: 1px solid #b9b6b0;
    border-radius: 3px;
    font-size: 11px;
}

.t4auc-bidform .t4auc-btn { padding: 3px 9px; }
</style>

<?php if ($t4Msg !== '') { ?>
    <p class="message" style="font-weight:bold;"><?php echo $t4Msg; ?></p>
<?php } ?>

<?php
// Soldurile curente si ratele de schimb (configurabile din config.php).
$t4ExItems  = isset($t4ExItems) ? $t4ExItems : new HeroItems();
$t4Silver   = $t4ExItems->getSilver($session->uid);
$t4Gold     = (int) $session->gold;
$t4RateG2S  = HeroItems::silverPerGold();
$t4RateS2G  = HeroItems::silverForOneGold();
?>
<?php
/**
 * Aceleasi monede desenate ca in bara de sus, ca sa nu existe doua
 * reprezentari diferite pentru aur si argint. Culorile vin din blocul
 * <style> de mai sus, nu din atribute inline.
 */
if (!function_exists('t4AucCoin')) {
function t4AucCoin($tone, $title)
{
    return '<svg viewBox="0 0 24 24" class="t4auc-coin t4auc-coin-' . $tone . '" role="img">'
         . '<title>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</title>'
         . '<circle cx="12" cy="12" r="11" class="t4auc-coinBg" />'
         . '<ellipse cx="12" cy="16.1" rx="6.2" ry="2.3" class="t4auc-coinDisc" />'
         . '<ellipse cx="12" cy="13.1" rx="6.2" ry="2.3" class="t4auc-coinDisc" />'
         . '<ellipse cx="12" cy="10.1" rx="6.2" ry="2.3" class="t4auc-coinDisc" />'
         . '<ellipse cx="12" cy="10.1" rx="2.6" ry="0.9" class="t4auc-coinShine" />'
         . '</svg>';
}
}

$t4LblGold   = defined('GOLD') ? GOLD : 'Gold';
$t4LblSilver = defined('HERO_SILVER') ? HERO_SILVER : 'Silver';
?>
<table id="distribution" class="t4auc-ex" cellpadding="1" cellspacing="1">
    <thead>
        <tr><th colspan="2"><?php echo defined('HERO_EXCHANGE') ? HERO_EXCHANGE : 'Exchange office'; ?></th></tr>
    </thead>
    <tbody>
        <tr>
            <td class="t4auc-ex-cell">
                <div class="t4auc-ex-inner">

                    <div class="t4auc-balance">
                        <span class="t4auc-bal">
                            <?php echo t4AucCoin('silver', $t4LblSilver); ?>
                            <b><?php echo number_format((int) $t4Silver); ?></b>
                        </span>
                        <span class="t4auc-bal">
                            <?php echo t4AucCoin('gold', $t4LblGold); ?>
                            <b><?php echo number_format((int) $t4Gold); ?></b>
                        </span>
                    </div>

                    <form action="" method="POST" class="t4auc-form">
                        <input type="hidden" name="t4action" value="g2s">
                        <input type="number" name="amount" min="1" max="100000" value="1" class="t4auc-num">
                        <?php echo t4AucCoin('gold', $t4LblGold); ?>
                        <button type="submit" class="t4auc-btn"><?php
                            echo defined('HERO_EXCHANGE_G2S') ? HERO_EXCHANGE_G2S : 'Gold to silver';
                        ?></button>
                        <span class="t4auc-rate">1 : <?php echo $t4RateG2S; ?></span>
                    </form>

                    <form action="" method="POST" class="t4auc-form">
                        <input type="hidden" name="t4action" value="s2g">
                        <input type="number" name="amount" min="1" max="100000000" value="<?php echo $t4RateS2G; ?>" class="t4auc-num">
                        <?php echo t4AucCoin('silver', $t4LblSilver); ?>
                        <button type="submit" class="t4auc-btn"><?php
                            echo defined('HERO_EXCHANGE_S2G') ? HERO_EXCHANGE_S2G : 'Silver to gold';
                        ?></button>
                        <span class="t4auc-rate"><?php echo $t4RateS2G; ?> : 1</span>
                    </form>

                    <p class="t4auc-hint">
                        <?php echo defined('HERO_EXCHANGE_HINT') ? HERO_EXCHANGE_HINT
                            : 'You type the amount you give. Silver left over below one unit of gold stays with you.'; ?>
                    </p>
                </div>
            </td>
            <td class="t4auc-ex-cell" style="text-align:center;">
                <?php
                /**
                 * Negustorul casei de licitatii, pe trib.
                 *
                 * Inainte era o singura imagine (img/hero/merchant.png) pentru
                 * toata lumea. Acum fiecare trib isi vede propriul personaj.
                 * Triburile 4 (Natura) si 5 (Natari) nu sunt jucabile, deci nu
                 * au imagine proprie - la fel si orice valoare neasteptata din
                 * baza de date: toate cad pe imaginea veche, care ramane in
                 * repo tocmai ca rezerva.
                 *
                 * Numele fisierelor sunt cele urcate in img/hero/, exact asa
                 * cum sunt scrise mai jos (atentie: "egiptean", nu "egyptian",
                 * si "vikings"/"huns" la plural).
                 */
                $t4MerchantByTribe = [
                    1 => 'roman.png',     // Romani
                    2 => 'teuton.png',    // Teutoni
                    3 => 'gaul.png',      // Gali
                    6 => 'huns.png',      // Huni
                    7 => 'egiptean.png',  // Egipteni
                    8 => 'spartan.png',   // Spartani
                    9 => 'vikings.png',   // Vikingi
                ];

                $t4Tribe = 0;

                if (isset($session->tribe)) {
                    $t4Tribe = (int) $session->tribe;
                } elseif (isset($session->userinfo['tribe'])) {
                    $t4Tribe = (int) $session->userinfo['tribe'];
                }

                $t4MerchantFile = isset($t4MerchantByTribe[$t4Tribe])
                    ? $t4MerchantByTribe[$t4Tribe]
                    : 'merchant.png';

                // Daca fisierul tribului inca n-a fost urcat pe server, nu
                // lasam un patrat gol - revenim la negustorul generic.
                if (!@file_exists('img/hero/' . $t4MerchantFile)) {
                    $t4MerchantFile = 'merchant.png';
                }
                ?>
                <img class="t4auc-merchant" src="img/hero/<?php echo $t4MerchantFile; ?>" alt="">
            </td>
        </tr>
    </tbody>
</table>

<?php
/**
 * Tier-ul obiectului vine din catalogul de iteme ($heroItemCatalog), acolo
 * unde e definit si bonusul - deci o singura sursa de adevar, nu o lista
 * paralela care s-ar desincroniza la prima modificare de balans.
 */
if (!function_exists('t4AucItemTier')) {
function t4AucItemTier($itemid)
{
    global $heroItemCatalog;

    return isset($heroItemCatalog[(int) $itemid]['tier'])
        ? (int) $heroItemCatalog[(int) $itemid]['tier']
        : 0;
}
}

$t4LblTier = defined('HERO_AUC_TIER') ? HERO_AUC_TIER : 'Tier';

/**
 * Eticheta scurta pentru coloana de pret: HERO_AUC_PRICE e "Pret curent" /
 * "Current price" si latea coloana degeaba. Daca HERO_AUC_PRICE_SHORT nu e
 * definita inca, ramanem pe cea lunga - nu vrem sa apara brusc engleza
 * intr-o interfata romaneasca.
 */
$t4LblPrice = defined('HERO_AUC_PRICE_SHORT') ? HERO_AUC_PRICE_SHORT : HERO_AUC_PRICE;
?>
<table id="distribution" class="t4auc-tbl" cellpadding="1" cellspacing="1">
    <thead>
        <tr><th colspan="6"><?php echo HERO_AUC_OPEN; ?></th></tr>
        <tr>
            <th class="t4auc-col-item"><?php echo HERO_AUC_ITEM; ?></th>
            <th class="t4auc-col-tier"><?php echo $t4LblTier; ?></th>
            <th class="t4auc-col-qty"><?php echo HERO_QUANTITY; ?></th>
            <th class="t4auc-col-price"><?php echo $t4LblPrice; ?></th>
            <th class="t4auc-col-time"><?php echo HERO_AUC_TIME_LEFT; ?></th>
            <th class="t4auc-col-bid"><?php echo HERO_AUC_BID; ?></th>
        </tr>
    </thead>
    <tbody>
    <?php if (count($t4Open)) { ?>
        <?php foreach ($t4Open as $t4A) { ?>
        <?php
            $t4ItemId  = (int) $t4A['itemid'];
            $t4Tier    = t4AucItemTier($t4ItemId);
            $t4Ability = heroItemBonusText($t4ItemId);
        ?>
        <tr>
            <td class="t4auc-col-item" title="<?php echo htmlspecialchars($t4Ability); ?>">
                <span class="heroT4Item item<?php echo $t4ItemId; ?>"></span>
                <span class="t4auc-itemname">
                    <?php echo $t4A['name']; ?><?php if ((int) $t4A['seller'] === 0) { ?> (<?php echo HERO_AUC_SELLER_NPC; ?>)<?php } ?>
                </span>
            </td>
            <td class="t4auc-col-tier" style="text-align:center;">
                <?php if ($t4Tier > 0) { ?>
                    <span class="t4auc-tier"><?php echo $t4LblTier; ?> <?php echo $t4Tier; ?></span>
                <?php } else { ?>
                    <span class="t4auc-tier">&ndash;</span>
                <?php } ?>
                <?php if ($t4Ability !== '') { ?>
                    <span class="t4auc-ability"><?php echo htmlspecialchars($t4Ability); ?></span>
                <?php } ?>
            </td>
            <td class="t4auc-col-qty"><?php echo (int) $t4A['quantity']; ?></td>
            <td class="t4auc-col-price"><?php echo number_format((int) $t4A['silver_current']); ?></td>
            <td class="t4auc-col-time">
                <span id="timer<?php echo ++$session->timer; ?>"><?php echo $generator->getTimeFormat(max(0, $t4A['time_end'] - $t4Now)); ?></span>
            </td>
            <td class="t4auc-col-bid">
                <?php if ((int) $t4A['seller'] !== $session->uid) { ?>
                <form action="" method="POST" class="t4auc-bidform">
                    <input type="hidden" name="t4action" value="bid">
                    <input type="hidden" name="aucid" value="<?php echo (int) $t4A['id']; ?>">
                    <input type="text" name="maxbid" class="t4auc-bidnum"
                           value="<?php echo (int) $t4A['silver_current'] + ((int) $t4A['bidder'] > 0 ? 1 : 0); ?>">
                    <button type="submit" class="t4auc-btn"><?php echo HERO_AUC_BID; ?></button>
                </form>
                <?php } else { ?>&ndash;<?php } ?>
            </td>
        </tr>
        <?php } ?>
    <?php } else { ?>
        <tr><td colspan="6"><?php echo HERO_AUC_NONE; ?></td></tr>
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
            <td title="<?php echo htmlspecialchars(heroItemBonusText((int) $t4A['itemid'])); ?>"><?php echo $t4A['name']; ?> (<?php echo (int) $t4A['quantity']; ?>x)</td>
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
            <td title="<?php echo htmlspecialchars(heroItemBonusText((int) $t4A['itemid'])); ?>"><?php echo $t4A['name']; ?> (<?php echo (int) $t4A['quantity']; ?>x)</td>
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
                    <option value="<?php echo (int) $t4Row['id']; ?>" title="<?php echo htmlspecialchars(heroItemBonusText((int) $t4Row['itemid'])); ?>">
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
