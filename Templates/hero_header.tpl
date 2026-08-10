<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : hero_header.tpl                                           ##
##  Type           : HEADER COMPONENT (Hero UI)                                ##
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
##                                                                             ##
##  Componenta Hero din bara de sus (zona incercuita cu rosu in                ##
##  RELOCARE_GOLD_LOCATIE_EROU.png). Se include din Templates/header.tpl,      ##
##  in interiorul lui #mtop.                                                   ##
##                                                                             ##
##  Structura (vezi VEDERE_GENERALA.png):                                      ##
##    - stanga sus  : casa  = "Hero at home" + numele satului -> 37.tpl        ##
##                    (craniu, cand eroul e mort -> tot 37.tpl)                ##
##    - centru      : portretul eroului + inelul Health(rosu)/Experience(albastru)
##    - dreapta sus : numarul de aventuri -> 37_adventures.tpl                 ##
##    - dreapta jos : argintul -> 37_auction.tpl                               ##
##                                                                             ##
##  Toate valorile sunt reale (nimic hardcodat). Inelul e SVG desenat din      ##
##  procentele efective, NU o imagine statica.                                 ##
##                                                                             ##
#################################################################################

/**
 * Gard 1: fara sesiune de jucator real nu afisam nimic.
 * $isRestrictedUser vine din header.tpl (contul special cu id 1).
 */
if (!isset($session) || !is_object($session)) {
    return;
}

if (isset($isRestrictedUser) && $isRestrictedUser) {
    return;
}

if (!isset($database) || !is_object($database)) {
    return;
}

$tzHeroUid = (int) $session->uid;

if ($tzHeroUid <= 0) {
    return;
}

/**
 * Functiile T4 de erou (aventuri / licitatii / argint) sunt optionale.
 * Cand steagul e stins, ramane doar cercul cu erou + casa, fiindca
 * Adventures si Silver n-ar avea unde sa duca.
 */
$tzHeroT4 = defined('NEW_FUNCTIONS_HERO_T4') && NEW_FUNCTIONS_HERO_T4;

/**
 * ---------------------------------------------------------------------------
 * 1. Randul eroului
 * ---------------------------------------------------------------------------
 * getHero($uid, 1) intoarce TOTI eroii, ordonati dupa lastupdate DESC.
 * Alegem, ca in Units::Hero(), primul erou viu si care nu e in antrenament;
 * daca nu exista, luam primul rand (cel mai recent folosit) - asa prindem
 * si eroul mort, de care avem nevoie pentru starea DEAD.
 */
$tzHeroRow  = false;
$tzHeroRows = $database->getHero($tzHeroUid, 1);

if (is_array($tzHeroRows) && count($tzHeroRows)) {

    foreach ($tzHeroRows as $tzRow) {

        if ((int) $tzRow['dead'] !== 1 && (int) $tzRow['intraining'] !== 1) {
            $tzHeroRow = $tzRow;
            break;
        }
    }

    if (!$tzHeroRow) {
        $tzHeroRow = $tzHeroRows[0];
    }
}

$tzHeroExists   = is_array($tzHeroRow);
$tzHeroDead     = $tzHeroExists ? ((int) $tzHeroRow['dead'] === 1) : false;
$tzHeroTraining = $tzHeroExists ? ((int) $tzHeroRow['intraining'] === 1) : false;
$tzHeroName     = $tzHeroExists ? (string) $tzHeroRow['name'] : '';
$tzHeroLevel    = $tzHeroExists ? (int) $tzHeroRow['level'] : 0;
$tzHeroUnit     = $tzHeroExists ? (int) $tzHeroRow['unit'] : 0;
$tzHeroWref     = $tzHeroExists ? (int) $tzHeroRow['wref'] : 0;

/**
 * health e float(12,9) in baza de date. Il rotunjim doar la afisare.
 */
$tzHeroHealth = $tzHeroExists ? (float) $tzHeroRow['health'] : 0;
$tzHeroHealth = max(0, min(100, $tzHeroHealth));

if ($tzHeroDead) {
    $tzHeroHealth = 0;
}

/**
 * ---------------------------------------------------------------------------
 * 2. Procentul de Experience catre nivelul urmator
 * ---------------------------------------------------------------------------
 * Aceeasi formula ca in Templates/Build/37_hero.tpl, ca sa nu existe doua
 * adevaruri diferite in interfata. $hero_levels vine din
 * GameEngine/Data/hero_full.php, incarcat de Session.php pe fiecare pagina.
 */
$tzHeroLevels = (isset($GLOBALS['hero_levels']) && is_array($GLOBALS['hero_levels']) && count($GLOBALS['hero_levels']) > 1)
    ? $GLOBALS['hero_levels']
    : array(0 => 0, 1 => 100);

$tzMaxLevel = max(array_keys($tzHeroLevels)) - 1;
$tzMaxExp   = isset($tzHeroLevels[$tzMaxLevel]) ? (int) $tzHeroLevels[$tzMaxLevel] : 0;

$tzCurExp   = $tzHeroExists ? (int) $tzHeroRow['experience'] : 0;
$tzExpCur   = isset($tzHeroLevels[$tzHeroLevel])     ? (int) $tzHeroLevels[$tzHeroLevel]     : 0;
$tzExpNext  = isset($tzHeroLevels[$tzHeroLevel + 1]) ? (int) $tzHeroLevels[$tzHeroLevel + 1] : $tzMaxExp;

if ($tzHeroExists && $tzCurExp < $tzMaxExp && $tzExpNext > $tzExpCur && $tzHeroLevel < $tzMaxLevel) {
    $tzHeroExpPct = ($tzCurExp - $tzExpCur) / ($tzExpNext - $tzExpCur) * 100;
    $tzHeroExpPct = max(0, min(100, $tzHeroExpPct));
} else {
    $tzHeroExpPct = $tzHeroExists ? 100 : 0;
}

/**
 * ---------------------------------------------------------------------------
 * 3. Unde se afla eroul acum
 * ---------------------------------------------------------------------------
 * Refolosim HeroItems::heroAwayReason(), aceeasi sursa de adevar ca pagina de
 * echipare: un singur query cu subinterogari separate, care intoarce
 * '' (acasa) | 'nohero' | 'adventure' | 'attack' | 'reinforcement'.
 *   - 'adventure'     : hero_adventure cu status = 1
 *   - 'attack'        : movement sort_type 3 (dus) sau 4 (intors) cu attacks.t11
 *   - 'reinforcement' : enforcement.hero pornit dintr-un sat al jucatorului
 * Metoda are cache static pe uid, deci daca o mai cheama cineva pe aceeasi
 * pagina nu se duce a doua oara la baza de date.
 */
$tzHeroAway    = '';
$tzHeroTarget  = 0;
$tzHeroEndtime = 0;
$tzHeroSort    = 0;

if ($tzHeroExists && !$tzHeroDead && !$tzHeroTraining && class_exists('HeroItems')) {

    $tzAwayObject = new HeroItems();

    if (method_exists($tzAwayObject, 'heroLocation')) {

        $tzLoc         = $tzAwayObject->heroLocation($tzHeroUid);
        $tzHeroAway    = (string) $tzLoc['reason'];
        $tzHeroTarget  = (int) $tzLoc['target'];
        $tzHeroEndtime = (int) $tzLoc['endtime'];
        $tzHeroSort    = (int) $tzLoc['sort'];

    } else {

        // rezerva, daca ajunge pe un server cu HeroItems.php vechi
        $tzHeroAway = (string) $tzAwayObject->heroAwayReason($tzHeroUid);
    }
}

// 'nohero' nu ne intereseaza aici - stim deja ca eroul exista
if ($tzHeroAway === 'nohero') {
    $tzHeroAway = '';
}

/**
 * Coordonatele destinatiei si secundele ramase pana la sosire.
 * La intoarcere (sort_type 4) destinatia e chiar satul jucatorului.
 */
$tzHeroTargetCoor = '';

if ($tzHeroTarget > 0) {

    $tzCoor = $database->getCoor($tzHeroTarget);

    if (is_array($tzCoor) && isset($tzCoor['x'], $tzCoor['y'])) {
        $tzHeroTargetCoor = '(' . (int) $tzCoor['x'] . '|' . (int) $tzCoor['y'] . ')';
    }
}

$tzHeroSecondsLeft = ($tzHeroEndtime > 0) ? max(0, $tzHeroEndtime - time()) : 0;

/**
 * Starea unica a componentei, din care ies si iconita, si tooltip-ul.
 * Ordinea conteaza: mort > inexistent > in antrenament > plecat > acasa.
 */
if (!$tzHeroExists) {
    $tzHeroState = 'nohero';
} elseif ($tzHeroDead) {
    $tzHeroState = 'dead';
} elseif ($tzHeroTraining) {
    $tzHeroState = 'training';
} elseif ($tzHeroAway !== '') {
    $tzHeroState = $tzHeroAway;
} else {
    $tzHeroState = 'home';
}

/**
 * ---------------------------------------------------------------------------
 * 4. Satul eroului
 * ---------------------------------------------------------------------------
 */
$tzHeroVillage = '';

if ($tzHeroWref > 0) {
    $tzHeroVillage = (string) $database->getVillageField($tzHeroWref, 'name');
}

/**
 * ---------------------------------------------------------------------------
 * 5. Aventuri disponibile
 * ---------------------------------------------------------------------------
 * Un erou mort nu poate pleca in aventura, deci afisam 0 (cerinta 7),
 * dar zona ramane clickabila.
 */
$tzHeroAdv = 0;

if ($tzHeroT4 && !$tzHeroDead && class_exists('HeroAdventure')) {

    $tzAdvObject = new HeroAdventure();
    $tzAdvOffers = $tzAdvObject->getOffers($tzHeroUid);
    $tzHeroAdv   = is_array($tzAdvOffers) ? count($tzAdvOffers) : 0;
}

/**
 * ---------------------------------------------------------------------------
 * 6. Argintul
 * ---------------------------------------------------------------------------
 * Refolosim exact acelasi cache ca blocul de aur din header.tpl
 * ($GLOBALS['t4SilverValue']), ca sa nu iasa doua interogari pe pagina.
 */
$tzHeroSilver = 0;

if ($tzHeroT4 && class_exists('HeroItems')) {

    if (!isset($GLOBALS['t4SilverValue'])) {
        $tzSilverObject            = new HeroItems();
        $GLOBALS['t4SilverValue'] = (int) $tzSilverObject->getSilver($tzHeroUid);
    }

    $tzHeroSilver = (int) $GLOBALS['t4SilverValue'];
}

/**
 * ---------------------------------------------------------------------------
 * 7. Link-urile catre Resedinta Eroului
 * ---------------------------------------------------------------------------
 * 37.tpl / 37_adventures.tpl / 37_auction.tpl nu sunt URL-uri: se ajunge
 * la ele prin build.php pe campul unde e cladirea 37, cu parametrul t4tab.
 *
 * getTypeField() cauta DOAR in satul curent. Daca jucatorul se uita la un
 * sat fara Resedinta Eroului, trimitem catre satul unde sta eroul, cu
 * newdid + gid=37 (build.php pastreaza t4tab peste redirect - vezi patch-ul
 * din build.php livrat impreuna cu acest fisier).
 */
$tzHeroField = 0;

if (isset($building) && is_object($building) && method_exists($building, 'getTypeField')) {
    $tzHeroField = (int) $building->getTypeField(37);
}

if ($tzHeroField > 0) {
    $tzHeroBase = 'build.php?id=' . $tzHeroField;
} elseif ($tzHeroWref > 0) {
    $tzHeroBase = 'build.php?newdid=' . $tzHeroWref . '&amp;gid=37';
} else {
    $tzHeroBase = 'build.php?gid=37';
}

$tzLinkHero = $tzHeroBase;
$tzLinkAdv  = $tzHeroBase . '&amp;t4tab=adventures';
$tzLinkAuc  = $tzHeroBase . '&amp;t4tab=auction';

/**
 * ---------------------------------------------------------------------------
 * 8. Portretul eroului
 * ---------------------------------------------------------------------------
 * img/u2/uN.gif sunt portretele mari (150x120), existente pentru toate
 * unitatile de erou, inclusiv triburile noi 6-9 (u51..u90). Daca lipseste
 * fisierul, cadem pe iconita mica img/u/N.gif.
 */
$tzHeroPortrait = '';

if ($tzHeroUnit > 0) {

    $tzBig   = GP_LOCATE . 'img/u2/u' . $tzHeroUnit . '.gif';
    $tzSmall = GP_LOCATE . 'img/u/' . $tzHeroUnit . '.gif';

    if (@file_exists($tzBig)) {
        $tzHeroPortrait = $tzBig;
    } elseif (@file_exists($tzSmall)) {
        $tzHeroPortrait = $tzSmall;
    }
}

/**
 * ---------------------------------------------------------------------------
 * 9. Geometria inelului
 * ---------------------------------------------------------------------------
 * Doua arce concentrice, in acelasi SVG: exterior = Health (rosu),
 * interior = Experience (albastru). Lungimea vizibila se obtine cu
 * stroke-dasharray, iar rotate(-90) porneste arcele de sus.
 */
$tzRingR1 = 26.5;                          // raza arcului de Health
$tzRingR2 = 21;                            // raza arcului de Experience
$tzRingC1 = 2 * M_PI * $tzRingR1;          // circumferinte
$tzRingC2 = 2 * M_PI * $tzRingR2;

$tzDashHealth = round($tzRingC1 * $tzHeroHealth / 100, 2);
$tzDashExp    = round($tzRingC2 * $tzHeroExpPct / 100, 2);

/**
 * ---------------------------------------------------------------------------
 * 10. Texte
 * ---------------------------------------------------------------------------
 * Tiparul defined()?: e cel folosit deja in 37_hero.tpl / 37_t4nav.tpl -
 * componenta merge si pe servere care n-au inca noile constante de limba.
 */
$tzTxtAtHome     = defined('HERO_HEADER_AT_HOME')  ? HERO_HEADER_AT_HOME  : 'Hero at home';
$tzTxtDead       = defined('HERO_HEADER_DEAD')     ? HERO_HEADER_DEAD     : 'Hero is dead';
$tzTxtTraining   = defined('HERO_HEADER_TRAINING') ? HERO_HEADER_TRAINING : 'Hero in training';
$tzTxtNoHero     = defined('HERO_HEADER_NOHERO')   ? HERO_HEADER_NOHERO   : 'No hero yet';
$tzTxtAdventure  = defined('HERO_HEADER_ADVENTURE') ? HERO_HEADER_ADVENTURE : 'Hero on adventure';
$tzTxtAttack     = defined('HERO_HEADER_ATTACK')    ? HERO_HEADER_ATTACK    : 'Hero is with the army';
$tzTxtReinforce  = defined('HERO_HEADER_REINFORCE') ? HERO_HEADER_REINFORCE : 'Hero is reinforcing';
$tzTxtIn         = defined('HERO_HEADER_IN')        ? HERO_HEADER_IN        : 'in';
$tzTxtVillage    = defined('VILLAGE')              ? VILLAGE              : 'Village';
$tzTxtLevel      = defined('LEVEL')                ? LEVEL                : 'Level';
$tzTxtHealth     = defined('TZ_HEALTH')            ? TZ_HEALTH            : 'Health';
$tzTxtExperience = defined('EXPERIENCE')           ? EXPERIENCE           : 'Experience';
$tzTxtSilver     = defined('HERO_SILVER')          ? HERO_SILVER          : 'Silver';
$tzTxtAdventures = defined('HERO_T4_TAB_ADVENTURES') ? HERO_T4_TAB_ADVENTURES : 'Adventures';

/**
 * Numele afisate vin din baza de date, deci trec obligatoriu prin escape.
 */
$tzHeroNameSafe    = htmlspecialchars($tzHeroName,    ENT_QUOTES, 'UTF-8');
$tzHeroVillageSafe = htmlspecialchars($tzHeroVillage, ENT_QUOTES, 'UTF-8');

?>
<link rel="stylesheet" href="css/hero_header.css" type="text/css" />

<div id="tzHeroBox" class="<?php echo $tzHeroDead ? 'tzHeroDeadState' : ''; ?>">

    <!-- ============ STANGA: locatia eroului -> 37.tpl ============ -->
    <a href="<?php echo $tzLinkHero; ?>" class="tzHeroSlot tzHeroHome">

        <?php if ($tzHeroState === 'dead') { ?>

            <!-- craniu: eroul e mort -->
            <svg viewBox="0 0 24 24" class="tzHeroIco" aria-hidden="true">
                <circle cx="12" cy="12" r="11" class="tzHeroIcoBg" />
                <path class="tzHeroSkull"
                      d="M12 4.8c-3.7 0-6.6 2.6-6.6 6.1 0 2.1 1 3.5 2.3 4.4v1.9c0 .7.5 1.2 1.2 1.2h6.2c.7 0 1.2-.5 1.2-1.2v-1.9c1.3-.9 2.3-2.3 2.3-4.4 0-3.5-2.9-6.1-6.6-6.1z" />
                <circle cx="9.5" cy="10.8" r="1.7" class="tzHeroSkullEye" />
                <circle cx="14.5" cy="10.8" r="1.7" class="tzHeroSkullEye" />
                <rect x="11.1" y="13.3" width="1.8" height="2.3" rx="0.6" class="tzHeroSkullEye" />
            </svg>

        <?php } elseif ($tzHeroState === 'adventure') { ?>

            <!-- cizma de drum: eroul e plecat in aventura (ca in referinta) -->
            <svg viewBox="0 0 24 24" class="tzHeroIco" aria-hidden="true">
                <circle cx="12" cy="12" r="11" class="tzHeroIcoBg" />
                <path class="tzHeroBoot"
                      d="M8.4 4.6h3.9c.5 0 .9.4.9.9v5.2c0 1.5.7 2.4 2 3.1l2.6 1.4c.9.5 1.4 1.2 1.4 2.1v1.2c0 .5-.4.9-.9.9H8.4c-.5 0-.9-.4-.9-.9V5.5c0-.5.4-.9.9-.9z" />
                <path class="tzHeroBootSole" d="M7.5 17.2h11.7v1.3c0 .5-.4.9-.9.9H8.4c-.5 0-.9-.4-.9-.9z" />
                <path class="tzHeroBootCuff" d="M7.5 5.5c0-.5.4-.9.9-.9h3.9c.5 0 .9.4.9.9v1.6H7.5z" />
            </svg>

        <?php } elseif ($tzHeroState === 'attack') { ?>

            <!-- sabii incrucisate: eroul e plecat cu armata -->
            <svg viewBox="0 0 24 24" class="tzHeroIco" aria-hidden="true">
                <circle cx="12" cy="12" r="11" class="tzHeroIcoBg" />
                <path d="M7.2 6.4 16.8 16" class="tzHeroBlade" />
                <path d="M16.8 6.4 7.2 16" class="tzHeroBlade" />
                <path d="M6 15.6 8.8 18.4" class="tzHeroHilt" />
                <path d="M18 15.6 15.2 18.4" class="tzHeroHilt" />
            </svg>

        <?php } elseif ($tzHeroState === 'reinforcement') { ?>

            <!-- scut: eroul e intr-o intarire -->
            <svg viewBox="0 0 24 24" class="tzHeroIco" aria-hidden="true">
                <circle cx="12" cy="12" r="11" class="tzHeroIcoBg" />
                <path d="M12 5.2 5.9 7.5v4.4c0 3.6 2.6 6.1 6.1 7.3 3.5-1.2 6.1-3.7 6.1-7.3V7.5z" class="tzHeroShield" />
                <path d="M12 5.2v14c3.5-1.2 6.1-3.7 6.1-7.3V7.5z" class="tzHeroShieldDark" />
            </svg>

        <?php } else { ?>

            <!-- casuta: eroul e in satul lui (sau in antrenament) -->
            <svg viewBox="0 0 24 24" class="tzHeroIco" aria-hidden="true">
                <circle cx="12" cy="12" r="11" class="tzHeroIcoBg" />
                <path class="tzHeroRoof" d="M12 5 4.3 11.3h2.3v6.8h10.8v-6.8h2.3z" />
                <rect x="8.3" y="12.3" width="7.4" height="5.8" class="tzHeroWall" />
                <rect x="10.5" y="14.1" width="3" height="4" class="tzHeroDoor" />
            </svg>

        <?php } ?>

        <span class="tzHeroTip tzHeroTipHome">
            <?php
            /**
             * Prima linie = starea, a doua = satul de bastina al eroului
             * (hero.wref ramane satul lui si cat timp e plecat).
             */
            $tzStateLabels = [
                'dead'          => $tzTxtDead,
                'nohero'        => $tzTxtNoHero,
                'training'      => $tzTxtTraining,
                'adventure'     => $tzTxtAdventure,
                'attack'        => $tzTxtAttack,
                'reinforcement' => $tzTxtReinforce,
                'home'          => $tzTxtAtHome,
            ];
            ?>
            <b><?php echo $tzStateLabels[$tzHeroState]; ?></b>

            <?php if ($tzHeroState !== 'nohero' && $tzHeroVillageSafe !== '') { ?>
                <i>
                    <?php echo $tzTxtVillage; ?> <?php echo $tzHeroVillageSafe; ?>
                    <?php if ($tzHeroTargetCoor !== '') { ?>
                        &rarr; <?php echo $tzHeroTargetCoor; ?>
                    <?php } ?>
                </i>
            <?php } ?>

            <?php if ($tzHeroSecondsLeft > 0) { ?>
                <?php
                /**
                 * Ceasul porneste de la valoarea calculata pe server; JS-ul de
                 * mai jos doar scade o secunda pe secunda, ca sa nu inghete
                 * pana la urmatoarea incarcare de pagina. Fara JS ramane
                 * valoarea de la incarcare, deci tot corecta, doar statica.
                 */
                $tzH = (int) floor($tzHeroSecondsLeft / 3600);
                $tzM = (int) floor(($tzHeroSecondsLeft % 3600) / 60);
                $tzS = (int) ($tzHeroSecondsLeft % 60);
                ?>
                <i class="tzHeroTipTime">
                    <?php echo $tzTxtIn; ?>
                    <span class="tzHeroTimer" data-left="<?php echo (int) $tzHeroSecondsLeft; ?>"><?php
                        echo $tzH . ':' . str_pad($tzM, 2, '0', STR_PAD_LEFT) . ':' . str_pad($tzS, 2, '0', STR_PAD_LEFT);
                    ?></span>
                </i>
            <?php } ?>
        </span>
    </a>

    <!-- ============ CENTRU: portret + inel Health/Experience -> 37.tpl ============ -->
    <a href="<?php echo $tzLinkHero; ?>" class="tzHeroSlot tzHeroCenter">

        <svg viewBox="0 0 64 64" class="tzHeroRing" aria-hidden="true">

            <!-- discul de fundal si rama -->
            <circle cx="32" cy="32" r="31" class="tzHeroRingBg" />

            <g transform="rotate(-90 32 32)">

                <!-- pista + arcul de Health (rosu) -->
                <circle cx="32" cy="32" r="<?php echo $tzRingR1; ?>" class="tzHeroTrack" />
                <circle cx="32" cy="32" r="<?php echo $tzRingR1; ?>" class="tzHeroArcHealth"
                        stroke-dasharray="<?php echo $tzDashHealth; ?> <?php echo round($tzRingC1, 2); ?>" />

                <!-- pista + arcul de Experience (albastru) -->
                <circle cx="32" cy="32" r="<?php echo $tzRingR2; ?>" class="tzHeroTrack" />
                <circle cx="32" cy="32" r="<?php echo $tzRingR2; ?>" class="tzHeroArcExp"
                        stroke-dasharray="<?php echo $tzDashExp; ?> <?php echo round($tzRingC2, 2); ?>" />
            </g>

            <!-- discul alb pe care sta portretul -->
            <circle cx="32" cy="32" r="17.5" class="tzHeroInner" />
        </svg>

        <?php if ($tzHeroPortrait !== '') { ?>
            <img class="tzHeroPortrait" src="<?php echo $tzHeroPortrait; ?>" alt="" />
        <?php } else { ?>
            <svg viewBox="0 0 32 32" class="tzHeroPortrait tzHeroPortraitEmpty" aria-hidden="true">
                <circle cx="16" cy="11.2" r="5.4" />
                <path d="M5.9 27.3c0-5.6 4.5-8.8 10.1-8.8s10.1 3.2 10.1 8.8z" />
            </svg>
        <?php } ?>

        <span class="tzHeroTip tzHeroTipCenter">
            <?php if (!$tzHeroExists) { ?>
                <b><?php echo $tzTxtNoHero; ?></b>
            <?php } else { ?>
                <b><?php echo $tzHeroNameSafe; ?> (<?php echo $tzTxtLevel; ?> <?php echo $tzHeroLevel; ?>)</b>
                <i><?php echo $tzTxtHealth; ?>: <?php echo (int) round($tzHeroHealth); ?>%</i>
                <i><?php echo $tzTxtExperience; ?>: <?php echo (int) round($tzHeroExpPct); ?>%
                   (<?php echo number_format($tzCurExp); ?>/<?php echo number_format($tzExpNext); ?> XP)</i>
                <?php if ($tzHeroDead) { ?>
                    <i class="tzHeroTipWarn"><?php echo $tzTxtDead; ?></i>
                <?php } ?>
            <?php } ?>
        </span>
    </a>

    <?php if ($tzHeroT4) { ?>

    <!-- ============ DREAPTA SUS: aventuri -> 37_adventures.tpl ============ -->
    <a href="<?php echo $tzLinkAdv; ?>" class="tzHeroSlot tzHeroAdv <?php echo $tzHeroAdv > 0 ? 'tzHeroAdvOn' : 'tzHeroAdvOff'; ?>">
        <span class="tzHeroAdvNum"><?php echo (int) $tzHeroAdv; ?></span>
        <span class="tzHeroTip tzHeroTipAdv">
            <b><?php echo $tzTxtAdventures; ?>: <?php echo (int) $tzHeroAdv; ?></b>
        </span>
    </a>

    <!-- ============ DREAPTA JOS: argint -> 37_auction.tpl ============ -->
    <a href="<?php echo $tzLinkAuc; ?>" class="tzHeroSlot tzHeroSilver">
        <!-- Teanc de monede desenat, in acelasi stil ca iconita de casa.
             Inlocuieste img/hero/silver.png din graphic pack. -->
        <svg viewBox="0 0 24 24" class="tzHeroIco" aria-hidden="true">
            <circle cx="12" cy="12" r="11" class="tzHeroIcoBg" />
            <ellipse cx="12" cy="16.1" rx="6.2" ry="2.3" class="tzHeroCoin" />
            <ellipse cx="12" cy="13.1" rx="6.2" ry="2.3" class="tzHeroCoin" />
            <ellipse cx="12" cy="10.1" rx="6.2" ry="2.3" class="tzHeroCoin" />
            <ellipse cx="12" cy="10.1" rx="2.6" ry="0.9" class="tzHeroCoinTop" />
        </svg>
        <span class="tzHeroTip tzHeroTipSilver">
            <b><?php echo $tzTxtSilver; ?>: <?php echo number_format($tzHeroSilver); ?></b>
        </span>
    </a>

    <?php } ?>

</div>

<?php if ($tzHeroSecondsLeft > 0) { ?>
<script type="text/javascript">
/* Numaratoare inversa pentru ceasul din tooltip-ul eroului.
   Nu atinge nimic altceva din pagina: cauta doar span-urile .tzHeroTimer
   din componenta si le rescrie textul o data pe secunda. */
(function () {
    var spans = document.getElementsByClassName('tzHeroTimer');

    if (!spans.length) {
        return;
    }

    function pad(n) { return (n < 10 ? '0' : '') + n; }

    setInterval(function () {
        for (var i = 0; i < spans.length; i++) {
            var left = parseInt(spans[i].getAttribute('data-left'), 10) - 1;

            if (isNaN(left) || left < 0) { left = 0; }

            spans[i].setAttribute('data-left', left);
            spans[i].innerHTML = Math.floor(left / 3600) + ':'
                               + pad(Math.floor((left % 3600) / 60)) + ':'
                               + pad(left % 60);
        }
    }, 1000);
})();
</script>
<?php } ?>
