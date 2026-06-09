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