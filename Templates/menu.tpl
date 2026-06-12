<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       menu.tpl                                                    ##
##  Developed by:  Dzoki                                                       ##
##  Refactored by: Shadow Incremental Refactor 			                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##                                                                             ##
##  Incremental Refactor Notes:                                                ##
##  - Preserved original logic and HTML structure                              ##
##  - Compatible with older PHP 7+ environments                                ##
##  - Reduced duplicated conditions and echoes                                 ##
##  - Added safer isset() checks for legacy compatibility                      ##
##  - Added comments for maintainability                                       ##
##  - No functional behavior changed                                           ##
##                                                                             ##
#################################################################################

include_once("GameEngine/Generator.php");

/**
 * Start page load timer
 */
$start_timer = $generator->pageLoadTimeStart();

/**
 * Helper variables
 * Avoid repeated isset() and direct $_SESSION access
 */
$isLoggedIn  = !empty($session->logged_in);
$isPlus      = !empty($session->plus);
$isAdmin     = (isset($session->access) && $session->access == ADMIN);
$isMH        = (isset($session->access) && $session->access == MULTIHUNTER);
$userId      = isset($session->uid) ? (int)$session->uid : 0;
$username    = isset($session->username) ? $session->username : '';
$sessionOk   = (isset($_SESSION['ok']) && $_SESSION['ok'] == 1);
$idUser      = isset($_SESSION['id_user']) ? (int)$_SESSION['id_user'] : 0;
?>
<?php if(!$isLoggedIn) { ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
    <title></title>

    <style type="text/css">
        div.c1 {
            text-align: center;
        }
    </style>
</head>

<body>

<div id="side_navi">

    <a id="logo" href="<?php echo HOMEPAGE; ?>" name="logo">
        <img src="img/x.gif" alt="<?php echo TZ_TRAVIAN; ?>">
    </a>

    <p>
        <a href="<?php echo HOMEPAGE; ?>">
            <?php echo HOME; ?>
        </a>

        <a href="login.php">
            <?php echo LOGIN; ?>
        </a>

        <a href="anmelden.php">
            <?php echo REG; ?>
        </a>
    </p>

</div>

<?php } else { ?>

<div id="side_navi">

    <!-- Logo -->
    <a id="logo" href="<?php echo HOMEPAGE; ?>" name="logo">
        <img
            src="img/x.gif"
            <?php if($isPlus) { echo 'class="logo_plus"'; } ?>
            alt="<?php echo TZ_TRAVIAN; ?>"
        >
    </a>

    <!-- Main navigation -->
    <p>

        <a href="<?php echo HOMEPAGE; ?>">
            <?php echo HOME; ?>
        </a>

        <a href="#" onclick="return Popup(0,0,1);">
            <?php echo $lang['index'][0][2]; ?>
        </a>

        <a href="spieler.php?uid=<?php echo $userId; ?>">
            <?php echo PROFILE; ?>
        </a>

        <?php
        /**
         * Multihunter links
         */
        if($isMH) {
            ?>
            <a href="Admin/admin.php">
                <font color="Blue"><?php echo MH_PANEL; ?></font>
            </a>
        <?php
        }

        /**
         * Admin links
         */
        if($isAdmin) {
            ?>
            <a href="Admin/admin.php">
                <font color="Red"><?php echo ADMIN_PANEL; ?></font>
            </a>

            <a href="build_croppers.php">
                <?php echo TZ_BUILD_CROPPER; ?>
            </a>
        <?php
        }
        ?>

        <a href="logout.php">
            <?php echo LOGOUT; ?>
        </a>

    </p>

    <!-- Forum -->
    <p>
        <a href="allianz.php?s=2">
            <?php echo FORUM; ?>
        </a>
    </p>

    <!-- Plus / Support / Custom links -->
    <p>

        <?php
        /**
         * Hide support-only links from support account
         */
        if($idUser != 1) {
        ?>
            <a href="plus.php?id=3">
                <?php echo TZ_TRAVIANZ; ?>
                <b>
                    <span class="plus_g">P</span>
                    <span class="plus_o">l</span>
                    <span class="plus_g">u</span>
                    <span class="plus_o">s</span>
                </b>
            </a>
        <?php
        }

        /**
         * Support profile link
         */
        if($idUser != 1) {
        ?>
            <a href="spieler.php?uid=1">
                <?php echo SUPPORT; ?>
            </a>
        <?php
        }

        /**
         * Optional external/custom links
         */
        if(defined('NEW_FUNCTIONS_DISPLAY_LINKS') && NEW_FUNCTIONS_DISPLAY_LINKS) {
            include("Templates/links.tpl");
        }

        /**
         * Natars include
         */
        include("Templates/natars.tpl");
		
		/**
		* Maintenance status for admins
		*/
		include("Templates/maintenance_status.tpl");

		/**
		* Debug Error Log quick toggle for admins
		*/
		include("Templates/debug_status.tpl");

        ?>

    </p>

    <?php
    /**
     * Account deletion countdown
     */
    $timestamp = $database->isDeleting($userId);

    if($timestamp) {

        echo '<br /><td colspan="2" class="count">';

        /**
         * Allow cancellation if more than 48h remain
         */
        if($timestamp > (time() + 172800)) {

            echo '<a href="spieler.php?s=3&id=' . $userId . '&a=1&e=4">
                    <img
                        class="del"
                        src="img/x.gif"
                        alt="'.CANCEL_PROCESS.'"
                        title="'.CANCEL_PROCESS.'"
                    />
                  </a>';
        }

        /**
         * Remaining deletion time
         */
        $time = $generator->getTimeFormat($timestamp - time());

        echo '<a href="spieler.php?s=3">
                The account will be deleted in
                <span id="timer' . ++$session->timer . '">
                    ' . $time . '
                </span>.
              </a>';

        echo '</td><br />';
    }
    ?>

</div>

<?php
/**
 * Live "local time" clock (issue #198): show a second clock next to the
 * server-time one, ticking in the player's chosen timezone. The server-time
 * block lives in each page's own footer (rendered after this menu), so we wait
 * for the DOM and target the last #tp1 (the visible one). Vanilla JS, driven by
 * Date.now() + the player's UTC offset, so it is independent of the browser
 * timezone and does not touch the unx.js tp+i counters (arrival timers).
 *
 * Skipped entirely when the player's timezone matches the server's, so no
 * redundant line is shown.
 */
$localOffset  = (int) $generator->userTimeZoneOffset();
$serverOffset = (int) date('Z');
if ($localOffset !== $serverOffset):
?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var anchors = document.querySelectorAll('#tp1');
    if (!anchors.length) return;
    var tp = anchors[anchors.length - 1];
    var off = <?php echo $localOffset; ?> * 1000;
    var label = <?php echo json_encode(LOCAL_TIME); ?>;

    var br  = document.createElement('br');
    var lbl = document.createElement('span');
    lbl.appendChild(document.createTextNode(label + ' '));
    var val = document.createElement('span');
    val.className = 'b';

    var parent = tp.parentNode, next = tp.nextSibling;
    parent.insertBefore(br, next);
    parent.insertBefore(lbl, next);
    parent.insertBefore(val, next);

    // align the local-time value vertically under the server-time value
    var delta = tp.offsetLeft - val.offsetLeft;
    if (delta > 0) {
        lbl.style.display = 'inline-block';
        lbl.style.width = (lbl.offsetWidth + delta) + 'px';
    }

    // make room for the extra line and lift the block so it stays in the frame
    var box = tp;
    while (box && box.id !== 'ltime') box = box.parentNode;
    if (box) {
        box.style.height = 'auto';
        var top = parseInt(window.getComputedStyle(box).top, 10);
        if (!isNaN(top)) box.style.top = (top - 8) + 'px';
    }

    function p(n) { return n < 10 ? '0' + n : n; }
    function tick() {
        var d = new Date(Date.now() + off);
        val.innerHTML = p(d.getUTCHours()) + ':' + p(d.getUTCMinutes()) + ':' + p(d.getUTCSeconds());
    }
    tick();
    setInterval(tick, 1000);
});
</script>
<?php endif; ?>

<?php
/**
 * Announcement screen
 */
if($sessionOk) {
?>

<div id="content" class="village1">

    <h1>
        <?php echo ANNOUNCEMENT; ?>
    </h1>

    <br />

    <h3>
        Hi <?php echo $username; ?>,
    </h3>

    <?php include("Templates/text.tpl"); ?>

    <div class="c1">

        <br />

        <h3>
            <a href="dorf1.php?ok">
                &raquo; <?php echo GO2MY_VILLAGE; ?>
            </a>
        </h3>

    </div>

</div>

<br /><br /><br /><br />

<div id="side_info">

    <?php
    /**
     * Right-side widgets
     */
    include("Templates/multivillage.tpl");
    include("Templates/quest.tpl");
    include("Templates/news.tpl");

    /**
     * Show links in sidebar if not displayed above
     */
    if(
        defined('NEW_FUNCTIONS_DISPLAY_LINKS')
        && !NEW_FUNCTIONS_DISPLAY_LINKS
    ) {
        echo "<br><br><br><br>";
        include("Templates/links.tpl");
    }
    ?>

</div>

<div class="clear"></div>

<div class="footer-stopper"></div>

<div class="clear"></div>

<?php
/**
 * Footer includes
 */
include("Templates/footer.tpl");
include("Templates/res.tpl");
?>

<div id="stime">

    <div id="ltime">

        <div id="ltimeWrap">

            <?php echo CALCULATED_IN; ?>

            <b>
                <?php
                echo round(
                    ($generator->pageLoadTimeEnd() - $start_timer) * 1000
                );
                ?>
            </b>

            ms

            <br />

            <?php echo SERVER_TIME; ?>

            <span id="tp1" class="b">
                <?php echo date('H:i:s'); ?>
            </span>

        </div>

    </div>

</div>

<div id="ce"></div>

<?php
    /**
     * Stop execution after announcement page
     */
    die();
}
?>

<?php } ?>

</body>
</html>