<?php
#################################################################################
##  SAFE INCREMENTAL REFACTOR - Read Message                                   ##
##  Credits: cleaned structure, same logic preserved                           ##
##  Compatibility: PHP 5.6+ / PHP 7+                                           ##
#################################################################################

// ======================================================
// LOAD MESSAGE DATA (UNCHANGED)
// ======================================================
$reading  = $message->reading;

$input    = $reading['message'];
$alliance = $reading['alliance'];
$player   = $reading['player'];
$coor     = $reading['coor'];
$report   = $reading['report'];

// ======================================================
// BBCODE PARSER (IMPORTANT - NU MODIFICĂM)
// ======================================================
include("GameEngine/BBCode.php");

// ======================================================
// CACHE USERNAME (reduce SQL calls)
// ======================================================
$userCache = [];
function getCachedUsername($uid, $database, &$cache) {
    $uid = (int)$uid;
    if (!isset($cache[$uid])) {
        $cache[$uid] = $database->getUserField($uid, "username", 0);
    }
    return $cache[$uid];
}

// ======================================================
// BASIC VARIABLES
// ======================================================
$ownerId = (int)$reading['owner'];
$linkSender = ($ownerId != 2 && $ownerId != 4);

// date format
$date = $generator->procMtime($reading['time']);
?>

<div id="content" class="messages">
<h1><?php echo MESSAGES; ?></h1>

<?php include("menu.tpl"); ?>

<form method="post" action="nachrichten.php">

<div id="read_head" class="msg_head"></div>

<div id="read_content" class="msg_content">

<img src="img/x.gif" id="label" class="read" alt="" />

<!-- ======================================================
     HEADER (SENDER + SUBJECT)
====================================================== -->
<div id="heading">

    <!-- Sender -->
    <div>
        <?php
        if ($linkSender) {
            echo '<a href="' . rtrim(SERVER, '/') . '/spieler.php?uid=' . $ownerId . '">';
        }

        echo getCachedUsername($ownerId, $database, $userCache);

        if ($linkSender) {
            echo '</a>';
        }
        ?>
    </div>

    <!-- Subject -->
    <div><?php echo $reading['topic']; ?></div>

</div>

<!-- ======================================================
     DATE / TIME
====================================================== -->
<div id="time">
    <div><?php echo $date[0]; ?></div>
    <div><?php echo $date[1]; ?></div>
</div>

<div class="clear"></div>
<div class="line"></div>

<!-- ======================================================
     MESSAGE CONTENT (CRITICAL: NU MODIFICĂM FLOW)
====================================================== -->
<div class="message">
<?php
// păstrăm exact ordinea: stripslashes -> nl2br -> bbcoded
echo stripslashes(nl2br($bbcoded));
?>
</div>

<!-- ======================================================
     HIDDEN INPUTS (UNCHANGED)
====================================================== -->
<input type="hidden" name="id" value="<?php echo $reading['id']; ?>" />
<input type="hidden" name="ft" value="m1" />
<input type="hidden" name="t" value="1" />

<p class="btn">
    <button name="s1" id="btn_reply" class="trav_buttons"><?php echo ANSWER; ?></button>
</p>

</div>

<div id="read_foot" class="msg_foot"></div>

</form>

</div>