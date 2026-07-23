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

<?php if ($t4Msg !== '') { ?>
    <p class="message" style="font-weight:bold;"><?php echo $t4Msg; ?></p>
<?php } ?>

<?php if ($t4Running) { ?>
<table id="distribution" cellpadding="1" cellspacing="1">
    <thead>
        <tr><th><?php echo HERO_ADV_RUNNING; ?>
            <span id="timer<?php echo ++$session->timer; ?>"><?php echo $generator->getTimeFormat(max(0, $t4Running['endtime'] - $t4Now)); ?></span>
        </th></tr>
    </thead>
</table>
<?php } ?>

<table id="distribution" cellpadding="1" cellspacing="1" style="margin-top:10px;">
    <thead>
        <tr><th colspan="5"><?php echo HERO_ADV_LIST; ?></th></tr>
        <tr>
            <td><b><?php echo defined('HERO_ADV_PLACE') ? HERO_ADV_PLACE : 'Place'; ?></b></td>
            <td><b><?php echo HERO_ADV_DURATION; ?></b></td>
            <td><b><?php echo defined('HERO_ADV_DANGER') ? HERO_ADV_DANGER : 'Danger'; ?></b></td>
            <td><b><?php echo HERO_ADV_EXPIRES; ?></b></td>
            <td></td>
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
            <td>
                <?php echo $t4Place ? $t4Place['name'] : '&mdash;'; ?>
                <?php if ($t4Place) { ?>
                <a href="karte.php?d=<?php echo $t4Place['wref']; ?>&amp;c=<?php echo $t4Place['check']; ?>"><b>(<?php echo $t4Place['x']; ?>|<?php echo $t4Place['y']; ?>)</b></a>
                <?php } ?>
            </td>

            <td><?php echo $generator->getTimeFormat((int) $t4Offer['duration']); ?></td>

            <td style="text-align:center;">
                <img src="img/hero/<?php echo $t4Hard ? 'dangerGreat.gif' : 'danger.gif'; ?>"
                     alt="<?php echo $t4Hard ? HERO_ADV_DIFF_HARD : HERO_ADV_DIFF_NORMAL; ?>"
                     title="<?php echo $t4Hard ? HERO_ADV_DIFF_HARD : HERO_ADV_DIFF_NORMAL; ?>"
                     style="width:16px;height:16px;vertical-align:middle;">
            </td>

            <td><span id="timer<?php echo ++$session->timer; ?>"><?php echo $generator->getTimeFormat(max(0, $t4Offer['expire'] - $t4Now)); ?></span></td>

            <td style="width:150px;">
                <?php if (!$t4Running) { ?>
                <form action="" method="POST" style="margin:0;display:inline;">
                    <input type="hidden" name="t4action" value="startadv">
                    <input type="hidden" name="advid" value="<?php echo (int) $t4Offer['id']; ?>">
                    <button type="submit" style="background:none;border:0;padding:0;cursor:pointer;font-size:inherit;font-family:inherit;color:#3a6f1e;font-weight:bold;">&#9658; <?php echo HERO_ADV_GO; ?></button>
                </form>
                <?php } else { ?>-<?php } ?>
            </td>
        </tr>
        <?php } ?>
    <?php } else { ?>
        <tr><td colspan="5"><?php echo HERO_ADV_NONE; ?></td></tr>
    <?php } ?>
    </tbody>
</table>
