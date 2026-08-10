<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       header.tpl                                                  ##
##  Developed by:  Dzoki                                                       ##
##  Refactored by: Shadow Incremental Refactor 			                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
##  Refactor notes:                                                            ##
##  - păstrată logica originală 100%                                           ##
##  - compatibil PHP 5.6+ / 7+                                                 ##
##  - redus cod duplicat                                                       ##
##  - eliminat condiții repetitive                                             ##
##  - output HTML mai sigur                                                    ##
##  - CSS reorganizat                                                          ##
##  - comentarii adăugate                                                      ##
##                                                                             ##
#################################################################################

/**
 * Escape HTML compatibil PHP vechi
 */
if (!function_exists('safeHTML')) {
    function safeHTML($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}

/**
 * Verifică dacă utilizatorul este guest/admin special
 */
$isRestrictedUser = (
    isset($_SESSION['id_user']) &&
    (int)$_SESSION['id_user'] === 1
);

/**
 * Helper links
 */
$dorf1Link = $isRestrictedUser ? '#' : 'dorf1.php';
$dorf2Link = $isRestrictedUser ? '#' : 'dorf2.php';
$reportsLink = $isRestrictedUser ? '#' : 'berichte.php';

/**
 * Determinare icon state reports/messages
 *
 * i1 = ambele unread
 * i2 = reports unread
 * i3 = messages unread
 * i4 = nimic unread
 */
$class = 'i4';

if ($message->unread && !$message->nunread) {

    $class = 'i2';

} elseif (!$message->unread && $message->nunread) {

    $class = 'i3';

} elseif ($message->unread && $message->nunread) {

    $class = 'i1';
}

/**
 * Plus activ/inactiv
 */
$plusClass = 'inactive';

if (
    isset($session->plus) &&
    $session->plus == 1 &&
    isset($session->userinfo['plus']) &&
    strtotime("NOW") <= $session->userinfo['plus']
) {
    $plusClass = 'active';
}

/**
 * Day/Night mode
 */
$hour = (int)date('Hi');

/**
 * Default imagine
 */
$dayNightImage = 'day_image';

/**
 * Night mode
 */
if ($hour > 1759 || $hour < 500) {
    $dayNightImage = 'night_image';
}
?>

<!-- ===================== HEADER ===================== -->

<div id="header">

    <div id="mtop">

        <!-- Village overview -->
        <a href="<?php echo $dorf1Link; ?>"
           id="n1"
           accesskey="1">

            <img src="img/x.gif"
                 title="<?php echo TZ_VILLAGE_OVERVIEW; ?>"
                 alt="<?php echo TZ_VILLAGE_OVERVIEW; ?>" />
        </a>

        <!-- Village centre -->
        <a href="<?php echo $dorf2Link; ?>"
           id="n2"
           accesskey="2">

            <img src="img/x.gif"
                 title="<?php echo VILLAGE_CENTER; ?>"
                 alt="<?php echo VILLAGE_CENTER; ?>" />
        </a>

        <!-- Map -->
        <a href="karte.php"
           id="n3"
           accesskey="3">

            <img src="img/x.gif"
                 title="<?php echo MAP; ?>"
                 alt="<?php echo MAP; ?>" />
        </a>

        <!-- Statistics -->
        <a href="statistiken.php"
           id="n4"
           accesskey="4">

            <img src="img/x.gif"
                 title="<?php echo STATISTICS; ?>"
                 alt="<?php echo STATISTICS; ?>" />
        </a>

        <!-- Reports / Messages -->
        <div id="n5" class="<?php echo safeHTML($class); ?>">

            <!-- Reports -->
            <a href="<?php echo $reportsLink; ?>"
               accesskey="5">

                <img src="img/x.gif"
                     class="l"
                     title="<?php echo REPORTS; ?>"
                     alt="<?php echo REPORTS; ?>" />
            </a>

            <!-- Messages -->
            <a href="nachrichten.php"
               accesskey="6">

                <img src="img/x.gif"
                     class="r"
                     title="<?php echo MESSAGES; ?>"
                     alt="<?php echo MESSAGES; ?>" />
            </a>

        </div>

        <!-- ===================== HERO (CERCUL ROSU) ===================== -->
        <?php
        /**
         * Componenta Hero: casa/craniu + inelul Health/Experience + aventuri
         * + argint. Traieste in Templates/hero_header.tpl si se pozitioneaza
         * absolut in interiorul lui #mtop (vezi css/hero_header.css).
         *
         * Cautam fisierul si relativ la Templates/, ca sa mearga si daca
         * header.tpl ajunge sa fie inclus din alt director.
         */
        $tzHeroTplPath = '';

        if (file_exists('Templates/hero_header.tpl')) {
            $tzHeroTplPath = 'Templates/hero_header.tpl';
        } elseif (file_exists(dirname(__FILE__) . '/hero_header.tpl')) {
            $tzHeroTplPath = dirname(__FILE__) . '/hero_header.tpl';
        }

        if ($tzHeroTplPath !== '') {
            include($tzHeroTplPath);
        }
        ?>
        <!-- ===================== END HERO ===================== -->

        <!-- ===================== GOLD (MUTAT IN DREPTUNGHIUL ALBASTRU) ===================== -->
        <?php
        /**
         * Gold display - mutat din res.tpl
         * Afisare intre Messages si Plus
         */
        if (!$isRestrictedUser && isset($session->gold)) {
        ?>
        <div id="goldHeader">
            <?php
            /**
             * FORMAT COMPACT: iconita + valoare, fara cuvintele "Aur"/"Argint".
             * Cuvintele au ramas in title/alt, deci se vad la mouseover.
             *
             * ICONITE SVG, nu gif-uri din graphic pack: gold.gif si gold_g.gif
             * aveau alt contur si alta dimensiune decat silver.png, asa ca cele
             * doua randuri nu se aliniau. Acum ambele sunt desenate la fel -
             * acelasi cerc, aceeasi rama, aceeasi marime - si difera doar
             * culoarea monedelor. Aceleasi clase ca iconita de argint din
             * componenta Hero (css/hero_header.css), deci se potrivesc intre ele.
             */
            $goldLabel = defined('GOLD') ? GOLD : 'Gold';
            $goldValue = (int) $session->gold;

            /**
             * Un teanc de monede, desenat o singura data si refolosit.
             * $tone alege paleta: aur, aur stins (fara aur) sau argint.
             */
            if (!function_exists('tzCoinIcon')) {
            function tzCoinIcon($tone, $title)
            {
                $cls = 'tzCoinStack tzCoin-' . $tone;

                return '<svg viewBox="0 0 24 24" class="' . $cls . '" role="img">'
                     . '<title>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</title>'
                     . '<circle cx="12" cy="12" r="11" class="tzCoinBg" />'
                     . '<ellipse cx="12" cy="16.1" rx="6.2" ry="2.3" class="tzCoinDisc" />'
                     . '<ellipse cx="12" cy="13.1" rx="6.2" ry="2.3" class="tzCoinDisc" />'
                     . '<ellipse cx="12" cy="10.1" rx="6.2" ry="2.3" class="tzCoinDisc" />'
                     . '<ellipse cx="12" cy="10.1" rx="2.6" ry="0.9" class="tzCoinShine" />'
                     . '</svg>';
            }
            }

            // sub 2 monede aurul era deja afisat stins in interfata veche
            $goldTone = ($goldValue <= 1) ? 'goldOff' : 'gold';

            echo '<div id="goldHeaderRow" class="tzCoinRow tzCoinRow-' . $goldTone . '">'
               . tzCoinIcon($goldTone, $goldValue . ' ' . $goldLabel)
               . '<span class="tzCoinValue">' . $goldValue . '</span>'
               . '</div>';

            /**
             * Argintul eroului, afisat sub aur (doar cu functiile T4 pornite).
             * Valoarea sta pe randul eroului, in hero.silver. O tinem in
             * $GLOBALS, nu intr-o variabila "static": intr-un fisier inclus,
             * "static" nu persista intre includeri, deci nu ar fi un cache real.
             */
            if (defined('NEW_FUNCTIONS_HERO_T4') && NEW_FUNCTIONS_HERO_T4 && class_exists('HeroItems')) {

                if (!isset($GLOBALS['t4SilverValue'])) {
                    $t4SilverItems = new HeroItems();
                    $GLOBALS['t4SilverValue'] = (int) $t4SilverItems->getSilver($session->uid);
                }

                $t4SilverLabel = defined('HERO_SILVER') ? HERO_SILVER : 'Silver';
                $t4SilverValue = (int) $GLOBALS['t4SilverValue'];

                echo '<div id="silverHeader" class="tzCoinRow tzCoinRow-silver">'
                   . tzCoinIcon('silver', $t4SilverValue . ' ' . $t4SilverLabel)
                   . '<span class="tzCoinValue">' . $t4SilverValue . '</span>'
                   . '</div>';
            }
            ?>
        </div>
        <?php } ?>
        <!-- ===================== END GOLD ===================== -->

        <?php
        /**
         * PLUS button
         * Guest/admin special nu vede Plus
         */
        if (!$isRestrictedUser) {
        ?>

        <a href="plus.php" id="plus">

            <span class="plus_text">

                <span class="plus_g">P</span>
                <span class="plus_o">l</span>
                <span class="plus_g">u</span>
                <span class="plus_o">s</span>

            </span>

            <img src="img/x.gif"
                 id="btn_plus"
                 class="<?php echo safeHTML($plusClass); ?>"
                 title="<?php echo PLUS_MENU; ?>"
                 alt="<?php echo PLUS_MENU; ?>" />

        </a>

        <?php } ?>

        <!-- ===================== DAY/NIGHT CSS ===================== -->

        <style type="text/css">

        .day_image {
            background-image:url("../gpack/travian_default/img/l/day.gif");
            width:18px;
            height:18px;
        }

        .night_image {
            background-image:url("../gpack/travian_default/img/l/night.gif");
            width:18px;
            height:18px;
        }

        #container {
            width:30px;
            height:60px;
            position:relative;
        }

        #wrapper > #container {
            display:table;
            position:static;
        }

        #container div {
            position:absolute;
            top:50%;
        }

        #container div div {
            position:relative;
            top:-50%;
        }

        #container > div {
            display:table-cell;
            vertical-align:middle;
            position:static;
        }
		
		.dayNightIcon {
			margin-top: 22px; /* aici cobori iconița */
			text-align: center;
	}

		.dayNightIcon img {
			width: 18px;
			height: 18px;
			display: inline-block;
	}

        /* GOLD IN DREPTUNGHIUL ALBASTRU (RELOCARE_GOLD_LOCATIE_EROU.png)
           Vechea pozitie era left:370px, adica exact cercul rosu - acolo sta
           acum componenta Hero (#tzHeroBox), asa ca aurul s-a mutat la dreapta,
           dupa butonul Plus si iconita day/night.

           ANCORAT LA DREAPTA, NU LA STANGA (right, nu left):
           #mtop are 570px latime, deci right:-104px pune marginea dreapta la
           x=674, sub limita de 686 peste care pagina se taie pe mobil
           (#header are min-width:980px si #mtop incepe la ~294px absolut).
           Ancorarea la dreapta face ca valorile lungi (un jucator cu milioane
           de argint) sa creasca spre STANGA, nu spre marginea paginii - cu
           "left" ar fi iesit iar din ecran. */
        #goldHeader {
            position: absolute;
            /* ANCORAT IN INTERIORUL BARII.
               #mtop are 700px latime, nu 570: lang.css face @import la
               modules/new_layout_ltr.css, care se incarca DUPA compact.css si
               ii suprascrie regula. Cu right negativ blocul iesea din pagina
               pe mobil. right:8px il tine mereu in bara, oricat de lunga ar fi
               valoarea, si lasa ~45px fata de iconita day/night. */
            right: 8px;
            left: auto;
            white-space: nowrap;
            top: 40%;
            transform: translateY(-50%);
            width: auto;
            height: auto;
            min-height: 22px;
            line-height: 16px;
            text-align: right;
            font-size: 11px;
            font-weight: bold;
            z-index: 50;
        }

        /* Randurile de aur/argint: iconita si valoarea aliniate pe aceeasi
           linie de baza, ca sa nu mai "sara" una fata de alta. */
        #goldHeader .tzCoinRow {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 4px;
            height: 18px;
        }

        #goldHeader .tzCoinStack {
            display: block;
            width: 16px;
            height: 16px;
            flex: 0 0 16px;
        }

        #goldHeader .tzCoinValue {
            display: inline-block;
        }

        /* Rama comuna: acelasi cerc pentru toate cele trei variante */
        #goldHeader .tzCoinBg {
            fill: #f6f5f2;
            stroke: #b8b6b1;
            stroke-width: 1;
        }

        /* Aur */
        #goldHeader .tzCoin-gold .tzCoinDisc  { fill: #e3b427; stroke: #9a7512; stroke-width: .8; }
        #goldHeader .tzCoin-gold .tzCoinShine { fill: #f7e08a; }

        /* Aur epuizat: aceeasi forma, doar decolorata (inlocuieste gold_g.gif) */
        #goldHeader .tzCoin-goldOff .tzCoinDisc  { fill: #d3d2ce; stroke: #a3a19c; stroke-width: .8; }
        #goldHeader .tzCoin-goldOff .tzCoinShine { fill: #efeeeb; }
        #goldHeader .tzCoinRow-goldOff .tzCoinValue { color: #b3b3b3; }

        /* Argint */
        #goldHeader .tzCoin-silver .tzCoinDisc  { fill: #cdd2d6; stroke: #7e858b; stroke-width: .8; }
        #goldHeader .tzCoin-silver .tzCoinShine { fill: #eef1f3; }


        #goldHeader img {
            vertical-align: middle;
            margin-right: 4px;
        }

        /* ARGINT (erou T4) - pe rand propriu, chiar sub aur */
        #silverHeader {
            display: block;
            white-space: nowrap;
            line-height: 16px;
            margin-top: -4px;
        }

        #silverHeader img {
            vertical-align: middle;
            margin-right: 4px;
            width: 12px;
            height: 12px;
        }

        </style>

        <!-- ===================== DAY/NIGHT ICON ===================== -->

        <div id="wrapper">

            <div id="container">

                <div>

                    <div>

                        <p>
							
                            <div class="dayNightIcon">
								<img src="img/x.gif" class="<?php echo safeHTML($dayNightImage); ?>" alt="" />
							</div>

                        </p>

                    </div>

                </div>

            </div>

        </div>

        <div class="clear"></div>

    </div>

</div>