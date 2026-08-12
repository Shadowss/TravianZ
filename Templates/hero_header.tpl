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
##  Componenta Hero din bara de sus. Se include din Templates/header.tpl,      ##
##  in interiorul lui #mtop.                                                   ##
##                                                                             ##
##  Structura:                                                                 ##
##  - stanga sus  : casa  = "Hero at home" + numele satului -> 37.tpl          ##
##                    (craniu, cand eroul e mort -> tot 37.tpl)                ##
##  - centru      : portretul eroului + inelul Health(rosu)/Experience(albastru)#
##  - dreapta sus : numarul de aventuri -> 37_adventures.tpl                   ##
##  - dreapta jos : argintul -> 37_auction.tpl                                 ##
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
$tzHeroAway      = '';
$tzHeroTarget    = 0;
$tzHeroEndtime   = 0;
$tzHeroSort      = 0;
$tzHeroReturning = false;

if ($tzHeroExists && !$tzHeroDead && !$tzHeroTraining && class_exists('HeroItems')) {

    $tzAwayObject = new HeroItems();

    if (method_exists($tzAwayObject, 'heroLocation')) {

        $tzLoc           = $tzAwayObject->heroLocation($tzHeroUid);
        $tzHeroAway      = (string) $tzLoc['reason'];
        $tzHeroTarget    = (int) $tzLoc['target'];
        $tzHeroEndtime   = (int) $tzLoc['endtime'];
        $tzHeroSort      = (int) $tzLoc['sort'];
        $tzHeroReturning = !empty($tzLoc['returning']);

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
} elseif ($tzHeroReturning) {
    /**
     * O singura stare pentru toate intoarcerile acasa: din aventura, din
     * atac sau dupa rechemarea dintr-o intarire. Motivul brut ramane in
     * $tzHeroAway, ca sa alegem textul potrivit mai jos.
     */
    $tzHeroState = 'returning';
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
 * 6b. Resursa produsa de erou (atributul T4 "Resources")
 * ---------------------------------------------------------------------------
 * Aceleasi formule ca in 37_hero.tpl, ca sa nu apara doua cifre diferite
 * pentru acelasi lucru:
 *   res_type 0     -> produce din TOATE, cate HERO_RES_PER_POINT_ALL / punct
 *   res_type 1..4  -> o singura resursa, HERO_RES_PER_POINT_ONE / punct
 * Totul inmultit cu SPEED, ca in pagina Resedintei.
 *
 * Coloanele "resources" si "res_type" lipsesc pe serverele care n-au rulat
 * inca add-hero-resources.sql, de aceea sunt citite cu ?? 0.
 */
$tzResPoints = $tzHeroExists ? (int) ($tzHeroRow['resources'] ?? 0) : 0;
$tzResType   = $tzHeroExists ? (int) ($tzHeroRow['res_type'] ?? 0) : 0;

$tzResPerAll = defined('HERO_RES_PER_POINT_ALL') ? (int) HERO_RES_PER_POINT_ALL : 3;
$tzResPerOne = defined('HERO_RES_PER_POINT_ONE') ? (int) HERO_RES_PER_POINT_ONE : 10;
$tzResSpeed  = defined('SPEED') ? SPEED : 1;

$tzResSingle = ($tzResType >= 1 && $tzResType <= 4);
$tzResAmount = $tzResSingle
    ? (int) round($tzResPoints * $tzResPerOne * $tzResSpeed)
    : (int) round($tzResPoints * $tzResPerAll * $tzResSpeed);

$tzResNames = array(
    1 => (defined('LUMBER') ? LUMBER : 'Lumber'),
    2 => (defined('CLAY')   ? CLAY   : 'Clay'),
    3 => (defined('IRON')   ? IRON   : 'Iron'),
    4 => (defined('CROP')   ? CROP   : 'Crop'),
);

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

/**
 * ATENTIE la varianta "build.php?gid=37" fara nimic in spate: build.php
 * rezolva gid-ul in satul CURENT, iar daca nu gaseste cladirea pune id = 1,
 * adica primul camp de resurse. Cine nu avea nici erou, nici Resedinta,
 * ajungea pe Padure cand apasa pe cerc. De aceea nu mai construim niciodata
 * linkul "orb": daca nu stim un camp valid, componenta ramane needclickabila.
 *
 * $tzHeroClickable spune daca avem o tinta reala:
 *   - cladirea 37 exista in satul curent            -> link direct
 *   - altfel, stim satul eroului                    -> newdid + gid=37
 *   - altfel (fara erou SI fara Resedinta nicaieri) -> fara link
 */
$tzHeroClickable = true;

if ($tzHeroField > 0) {
    $tzHeroBase = 'build.php?id=' . $tzHeroField;
} elseif ($tzHeroWref > 0) {
    $tzHeroBase = 'build.php?newdid=' . $tzHeroWref . '&amp;gid=37';
} else {
    $tzHeroBase      = '';
    $tzHeroClickable = false;
}

$tzLinkHero = $tzHeroBase;
$tzLinkAdv  = $tzHeroClickable ? $tzHeroBase . '&amp;t4tab=adventures' : '';
$tzLinkAuc  = $tzHeroClickable ? $tzHeroBase . '&amp;t4tab=auction'    : '';

/**
 * Cand nu e clickabil folosim <span> in loc de <a>: fara href gol, fara
 * cursor de link, fara intrare in ordinea de tabulare. Tooltip-ul ramane.
 */
$tzTag = $tzHeroClickable ? 'a' : 'span';

/**
 * Deschide slotul ca <a href=...> sau ca <span>, dupa caz.
 * function_exists: un template inclus de doua ori intr-un request ar da
 * fatal error la redeclarare.
 */
if (!function_exists('tzHeroSlotOpen')) {
function tzHeroSlotOpen($link, $classes, $clickable)
{
    if ($clickable && $link !== '') {
        return '<a href="' . $link . '" class="' . $classes . '">';
    }

    return '<span class="' . $classes . ' tzHeroNoLink">';
}
}

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
$tzTxtRetAdv     = defined('HERO_HEADER_RETURN_ADV')  ? HERO_HEADER_RETURN_ADV  : 'Hero returning from adventure';
$tzTxtRetHome    = defined('HERO_HEADER_RETURN_HOME') ? HERO_HEADER_RETURN_HOME : 'Hero returning home';
$tzTxtResources  = defined('RESOURCES')            ? RESOURCES            : 'Resources';
$tzTxtPerHour    = defined('HERO_HEADER_PER_HOUR') ? HERO_HEADER_PER_HOUR : 'per hour';
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
<?php
/**
 * ?v=<data fisierului>: fara asta, browserul pastra CSS-ul vechi din cache
 * dupa fiecare deploy. Efectul e insidios - HTML-ul nou apare, dar regulile
 * noi lipsesc, asa ca elementele isi pierd pozitia (position:absolute fara
 * left/top cade in coltul din stanga sus) si SVG-urile raman negre, fiindca
 * fill-ul vine din CSS. filemtime se schimba singur la fiecare incarcare.
 */
$tzCssVer = @filemtime('css/hero_header.css');
?>
<link rel="stylesheet" type="text/css"
      href="css/hero_header.css<?php echo $tzCssVer ? '?v=' . $tzCssVer : ''; ?>" />

<div id="tzHeroBox" class="<?php echo $tzHeroDead ? 'tzHeroDeadState' : ''; ?>">

    <!-- ============ STANGA: locatia eroului -> 37.tpl ============ -->
    <?php echo tzHeroSlotOpen($tzLinkHero, 'tzHeroSlot tzHeroHome', $tzHeroClickable); ?>

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

            <!-- indicator cu doua sageti: eroul e plecat in aventura -->
            <svg viewBox="0 0 24 24" class="tzHeroIco" aria-hidden="true">
                <circle cx="12" cy="12" r="11" class="tzHeroIcoBg" />
                <rect x="11.2" y="6.2" width="1.6" height="12" rx="0.4" class="tzHeroPost" />
                <path d="M5.4 7.6h10.2l2.6 2-2.6 2H5.4z" class="tzHeroSign" />
                <path d="M18.6 12.6H8.4l-2.6 2 2.6 2h10.2z" class="tzHeroSign" />
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

        <?php } elseif ($tzHeroState === 'returning') { ?>

            <!-- casa cu sageata care intra in ea: eroul e pe drumul spre casa,
                 indiferent daca vine din aventura, din atac sau dintr-o
                 intarire de la care a fost rechemat -->
            <svg viewBox="0 0 24 24" class="tzHeroIco" aria-hidden="true">
                <circle cx="12" cy="12" r="11" class="tzHeroIcoBg" />
                <path class="tzHeroRoof" d="M13.5 5.6 6.9 11.2h1.9v5.9h9.2v-5.9h1.9z" />
                <rect x="10.4" y="12.1" width="6.3" height="5" class="tzHeroWall" />
                <path class="tzHeroBackArrow" d="M3.2 13.6h6.4v-2.4l4 3.6-4 3.6v-2.4H3.2z" />
            </svg>

        <?php } elseif ($tzHeroState === 'training') { ?>

            <!-- clepsidra: eroul e in antrenament, inca nu e disponibil -->
            <svg viewBox="0 0 24 24" class="tzHeroIco" aria-hidden="true">
                <circle cx="12" cy="12" r="11" class="tzHeroIcoBg" />
                <rect x="7.2" y="5.4" width="9.6" height="1.7" rx="0.6" class="tzHeroGlassFrame" />
                <rect x="7.2" y="16.9" width="9.6" height="1.7" rx="0.6" class="tzHeroGlassFrame" />
                <path d="M8.9 7.1h6.2L12 12z" class="tzHeroGlass" />
                <path d="M8.9 16.9h6.2L12 12z" class="tzHeroGlass" />
                <path d="M9.9 8.4h4.2L12 11z" class="tzHeroSand" />
                <path d="M10.3 16.9h3.4L12 14.6z" class="tzHeroSand" />
            </svg>

        <?php } elseif ($tzHeroState === 'nohero') { ?>

            <!-- silueta stinsa: jucatorul nu are inca niciun erou.
                 Acelasi desen ca portretul gol din centru, ca sa se citeasca
                 imediat ca "aici inca nu e nimeni". -->
            <svg viewBox="0 0 24 24" class="tzHeroIco" aria-hidden="true">
                <circle cx="12" cy="12" r="11" class="tzHeroIcoBg" />
                <circle cx="12" cy="9.8" r="3.5" class="tzHeroNone" />
                <path d="M5.6 19.2c0-3.7 2.9-5.8 6.4-5.8s6.4 2.1 6.4 5.8z" class="tzHeroNone" />
            </svg>

        <?php } else { ?>

            <!-- casuta: eroul e in satul lui -->
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
                // din aventura stim sigur de unde vine; la sort_type 4 nu se
                // poate deosebi atacul de rechemarea dintr-o intarire, deci
                // textul ramane generic
                'returning'     => ($tzHeroAway === 'adventure') ? $tzTxtRetAdv : $tzTxtRetHome,
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
    <?php echo $tzHeroClickable ? '</a>' : '</span>'; ?>

    <!-- ============ CENTRU: portret + inel Health/Experience -> 37.tpl ============ -->
    <?php echo tzHeroSlotOpen($tzLinkHero, 'tzHeroSlot tzHeroCenter', $tzHeroClickable); ?>

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
    <?php echo $tzHeroClickable ? '</a>' : '</span>'; ?>

    <?php if ($tzHeroT4) { ?>

    <!-- ============ DREAPTA SUS: aventuri -> 37_adventures.tpl ============ -->
    <?php echo tzHeroSlotOpen($tzLinkAdv, 'tzHeroSlot tzHeroAdv ' . ($tzHeroAdv > 0 ? 'tzHeroAdvOn' : 'tzHeroAdvOff'), $tzHeroClickable); ?>
        <span class="tzHeroAdvNum"><?php echo (int) $tzHeroAdv; ?></span>
        <span class="tzHeroTip tzHeroTipAdv">
            <b><?php echo $tzTxtAdventures; ?>: <?php echo (int) $tzHeroAdv; ?></b>
        </span>
    <?php echo $tzHeroClickable ? '</a>' : '</span>'; ?>

    <!-- ============ STANGA JOS: resursa produsa de erou -> 37.tpl ============ -->
    <?php echo tzHeroSlotOpen($tzLinkHero, 'tzHeroSlot tzHeroRes', $tzHeroClickable); ?>

        <?php
        /**
         * Exact aceleasi iconite ca in 37_hero.tpl, ca sa nu existe doua
         * seturi de grafica pentru acelasi lucru:
         *   - "toate"  -> img/hero/res_all.png (iconita combinata)
         *   - 1..4     -> clasele r1..r4, care decupeaza sprite-ul
         *                 img/a/res2.gif din graphic pack, peste img/x.gif
         */
        if ($tzResSingle) {
            echo '<img class="tzHeroResOne r' . $tzResType . '" src="img/x.gif" alt="" />';
        } else {
            echo '<img class="tzHeroResAll" src="img/hero/res_all.png" alt="" />';
        }
        ?>

        <span class="tzHeroTip tzHeroTipRes">
            <?php if ($tzResPoints <= 0) { ?>
                <b><?php echo $tzTxtResources; ?>: 0</b>
            <?php } elseif ($tzResSingle) { ?>
                <b><?php echo $tzResNames[$tzResType]; ?>:
                   +<?php echo number_format($tzResAmount); ?> <?php echo $tzTxtPerHour; ?></b>
            <?php } else { ?>
                <?php
                /**
                 * res_type 0 inseamna ca eroul produce suma asta din FIECARE
                 * resursa, nu impartita intre ele - de aceea o listam pe fiecare
                 * rand, in loc s-o repetam si in titlu.
                 */
                ?>
                <b><?php echo $tzTxtResources; ?> <?php echo $tzTxtPerHour; ?></b>
                <?php foreach ($tzResNames as $tzResName) { ?>
                    <i><?php echo $tzResName; ?>: +<?php echo number_format($tzResAmount); ?></i>
                <?php } ?>
            <?php } ?>
        </span>
    <?php echo $tzHeroClickable ? '</a>' : '</span>'; ?>

    <!-- ============ DREAPTA JOS: argint -> 37_auction.tpl ============ -->
    <?php echo tzHeroSlotOpen($tzLinkAuc, 'tzHeroSlot tzHeroSilver', $tzHeroClickable); ?>
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
    <?php echo $tzHeroClickable ? '</a>' : '</span>'; ?>

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
