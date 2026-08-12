<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : HERO T4 ADVENTURES PAGE                                   ##
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
##  NOTA: doar prezentarea a fost refacuta (aspect ca in Travian original).    ##
##  Logica - generarea ofertelor, pornirea aventurii, mesajele - e neschimbata.##
##  Coloana "Expires in" a fost pastrata (nu exista in originalul T4).         ##
#################################################################################

$t4Adventures = new HeroAdventure();
$t4Msg = '';

if (isset($_POST['t4action'], $_POST['advid']) && $_POST['t4action'] === 'startadv') {
    $t4Result = $t4Adventures->startAdventure($session->uid, (int) $_POST['advid']);
    if ($t4Result === HeroAdventure::START_OK) {
        $t4Msg = HERO_ADV_START_OK;
    } elseif ($t4Result === HeroAdventure::START_NO_HERO) {
        $t4Msg = HERO_ADV_START_NOHERO;
    } elseif ($t4Result === HeroAdventure::START_HERO_AWAY) {
        $t4Msg = HERO_ADV_START_AWAY;
    } else {
        $t4Msg = HERO_ADV_START_FAIL;
    }
}

// Top up the list opportunistically (respects max/refresh limits internally).
$t4Adventures->generateOffers($session->uid);

$t4Offers  = $t4Adventures->getOffers($session->uid);
$t4Running = $t4Adventures->getRunning($session->uid);
$t4Now     = time();

/**
 * Numele locului tintit de aventura, ca in Travian: "Abandoned valley" pentru
 * un teren liber, "Unoccupied oasis" pentru o oaza libera. Tintele sunt mereu
 * tile-uri neocupate (vezi HeroAdventure::generateOffers).
 * getCoor() e cache-uit per request, deci nu adauga query-uri pe rand.
 */
$t4PlaceInfo = function ($wref) use ($database, $generator) {
    $tile = $database->getCoor((int) $wref);

    if (!is_array($tile) || !isset($tile['x'])) {
        return null;
    }

    $isOasis = isset($tile['oasistype']) && (int) $tile['oasistype'] > 0;

    return array(
        'name'  => $isOasis
            ? (defined('UNOCCUPIED') && defined('OASIS') ? UNOCCUPIED . ' ' . strtolower(OASIS) : 'Unoccupied oasis')
            : (defined('ABANDVALLEY') ? ABANDVALLEY : 'Abandoned valley'),
        'x'     => (int) $tile['x'],
        'y'     => (int) $tile['y'],
        'wref'  => (int) $wref,
        'check' => $generator->getMapCheck((int) $wref),
    );
};
?>

<style type="text/css">
/* ---------------------------------------------------------------------------
   Acelasi limbaj vizual ca 37_auction.tpl si 37_items.tpl: badge-uri, text
   secundar palid, butoane verzi si latimi stranse ca sa incapa in zona de
   continut (~505px) fara scroll orizontal.
   Toate clasele au prefixul "t4adv" ca sa nu atinga nimic altceva.
   Fara CSS grid si fara "gap": jocul e deschis si din browsere vechi.
   --------------------------------------------------------------------------- */

table.t4adv tr.t4cols th {
    background: #e8e8ea;
    color: #444;
    font-size: 11px;
    font-weight: bold;
    text-align: center;
    padding: 3px 5px;
    border-bottom: 1px solid #d0d0d4;
}

table.t4adv td { padding: 5px 4px; vertical-align: middle; font-size: 11px; }

/* Latimile, intr-un singur loc: 76+58+74+90 = 298px ficsi, restul ramane
   coloanei cu locul (care contine si coordonatele). */
table.t4adv th.c-place { width: auto; }
table.t4adv th.c-dur   { width: 76px; }
table.t4adv th.c-dan   { width: 58px; }
table.t4adv th.c-exp   { width: 74px; }
table.t4adv th.c-act   { width: 90px; }

/* Locul: numele pe primul rand, coordonatele dedesubt, palide */
table.t4adv td.t4place { text-align: left; }
table.t4adv .t4placeName { display: block; }
table.t4adv .t4coord {
    display: block;
    margin-top: 2px;
    font-size: 10px;
    color: #9b978f;
}
table.t4adv .t4coord a { color: #7d7a73; text-decoration: none; }
table.t4adv .t4coord a:hover { text-decoration: underline; }

/* Durata / expirarea, centrate si cu cifre de latime fixa (ceasul nu tresare) */
table.t4adv td.t4dur,
table.t4adv td.t4exp { text-align: center; font-variant-numeric: tabular-nums; }
table.t4adv td.t4exp { color: #8a877f; }

/* Dificultatea */
table.t4adv td.t4dan { text-align: center; }
table.t4adv .t4danIco { width: 16px; height: 16px; vertical-align: middle; }

/* Actiunea */
table.t4adv td.t4act { text-align: center; }
table.t4adv .t4form { margin: 0; }

table.t4adv .t4btn {
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

table.t4adv .t4btn:hover {
    background: #d6e8bd;
    background: linear-gradient(#ffffff, #cfe4b0);
    border-color: #8bab61;
}

table.t4adv .t4btn:active {
    background: linear-gradient(#d5e6b8, #e9f3da);
    border-color: #8bab61;
}

table.t4adv .t4none  { color: #a5a19a; }
table.t4adv td.t4empty { color: #a5a19a; text-align: center; }

/* --- Bara "aventura in desfasurare" --- */
.t4advRunning {
    margin: 0 0 10px 0;
    padding: 7px 10px;
    background: #f3f7ec;
    border: 1px solid #c3d9a4;
    border-radius: 4px;
    font-size: 11px;
    color: #4a6b2a;
}

.t4advRunning b { color: #3f6b1c; }

.t4advRunning .t4advClock {
    font-weight: bold;
    font-variant-numeric: tabular-nums;
}
</style>

<?php if ($t4Msg !== '') { ?>
    <p class="message" style="font-weight:bold;"><?php echo $t4Msg; ?></p>
<?php } ?>

<?php if ($t4Running) { ?>
    <?php
    /**
     * Aventura in desfasurare: era un tabel cu un singur cap de tabel, ceea ce
     * arata ca un al doilea tabel gol. Acum e o bara de stare, in acelasi ton
     * verde ca butoanele - se citeste dintr-o privire ca eroul e plecat.
     * Id-ul "timer<N>" ramane neschimbat, deci ceasul din JS-ul jocului merge
     * exact ca inainte.
     */
    ?>
<div class="t4advRunning">
    <b><?php echo HERO_ADV_RUNNING; ?></b>
    <span class="t4advClock" id="timer<?php echo ++$session->timer; ?>"><?php echo $generator->getTimeFormat(max(0, $t4Running['endtime'] - $t4Now)); ?></span>
</div>
<?php } ?>

<table id="distribution" class="t4adv" cellpadding="1" cellspacing="1">
    <thead>
        <tr><th colspan="5"><?php echo HERO_ADV_LIST; ?></th></tr>
        <?php // capul de coloane era <td><b>, deci nu se stila ca antet ?>
        <tr class="t4cols">
            <th class="c-place"><?php echo defined('HERO_ADV_PLACE') ? HERO_ADV_PLACE : 'Place'; ?></th>
            <th class="c-dur"><?php echo HERO_ADV_DURATION; ?></th>
            <th class="c-dan"><?php echo defined('HERO_ADV_DANGER') ? HERO_ADV_DANGER : 'Danger'; ?></th>
            <th class="c-exp"><?php echo HERO_ADV_EXPIRES; ?></th>
            <th class="c-act">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
    <?php if (count($t4Offers)) { ?>
        <?php foreach ($t4Offers as $t4Offer) { ?>
            <?php
                $t4Place = $t4PlaceInfo($t4Offer['wref']);
                $t4Hard  = ((int) $t4Offer['difficulty'] === 1);
            ?>
        <tr>
            <td class="t4place">
                <span class="t4placeName"><?php echo $t4Place ? $t4Place['name'] : '&mdash;'; ?></span>
                <?php if ($t4Place) { ?>
                <span class="t4coord">
                    <a href="karte.php?d=<?php echo $t4Place['wref']; ?>&amp;c=<?php echo $t4Place['check']; ?>">(<?php echo $t4Place['x']; ?>|<?php echo $t4Place['y']; ?>)</a>
                </span>
                <?php } ?>
            </td>

            <td class="t4dur"><?php echo $generator->getTimeFormat((int) $t4Offer['duration']); ?></td>

            <td class="t4dan">
                <img class="t4danIco" src="img/hero/<?php echo $t4Hard ? 'dangerGreat.gif' : 'danger.gif'; ?>"
                     alt="<?php echo $t4Hard ? HERO_ADV_DIFF_HARD : HERO_ADV_DIFF_NORMAL; ?>"
                     title="<?php echo $t4Hard ? HERO_ADV_DIFF_HARD : HERO_ADV_DIFF_NORMAL; ?>">
            </td>

            <td class="t4exp"><span id="timer<?php echo ++$session->timer; ?>"><?php echo $generator->getTimeFormat(max(0, $t4Offer['expire'] - $t4Now)); ?></span></td>

            <td class="t4act">
                <?php if (!$t4Running) { ?>
                <form action="" method="POST" class="t4form">
                    <input type="hidden" name="t4action" value="startadv">
                    <input type="hidden" name="advid" value="<?php echo (int) $t4Offer['id']; ?>">
                    <button type="submit" class="t4btn"><?php echo HERO_ADV_GO; ?></button>
                </form>
                <?php } else { ?>
                <span class="t4none">&mdash;</span>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    <?php } else { ?>
        <tr><td colspan="5" class="t4empty"><?php echo HERO_ADV_NONE; ?></td></tr>
    <?php } ?>
    </tbody>
</table>
