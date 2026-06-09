<?php
#################################################################################
##  SAFE INCREMENTAL REFACTOR - Write Messages                                 ##
##  Credits: optimized structure, same logic preserved                         ##
##  Compatibility: PHP 5.6+ / PHP 7+                                           ##
#################################################################################
?>

<div id="content" class="messages">
<h1><?php echo MESSAGES; ?></h1>

<?php
include("menu.tpl");

// ======================================================
// USER DATA (single load)
// ======================================================
$user = $database->getUserArray($session->uid, 1);

// cache username (reduce SQL calls)
$userCache = [];

function getCachedUsername($uid, $database, &$cache) {
    $uid = (int)$uid;
    if (!isset($cache[$uid])) {
        $cache[$uid] = $database->getUserField($uid, 'username', 0);
    }
    return $cache[$uid];
}
?>

<script language="JavaScript" type="text/javascript">
// JS rămâne IDENTIC (nu modificăm comportament)
function setReceiver(name) {
    document.getElementById('receiver').value = name;
    copyElement('receiver');
}
function closeFriendsList() {
    document.getElementById('adressbook').className = 'hide';
}
function toggleFriendsList() {
    var book = document.getElementById('adressbook');
    if (book.className == 'hide') book.className = '';
    else book.className = 'hide';
}
function copyElement(element) {}
function submitDefault(type,uid) {
    var book = document.abform;
    book.sbmtype.value = type;
    book.sbmvalue.value = uid;
    book.submit();
}
</script>

<div id="write_head" class="msg_head"></div>
<div id="write_content" class="msg_content">

<form method="post" action="nachrichten.php" accept-charset="UTF-8" name="msg">
<input type="hidden" name="c" value="3e9" />
<input type="hidden" name="p" value="" />

<img src="img/x.gif" id="label" class="send" alt="" />

<div id="heading">

<!-- ======================================================
     RECEIVER
====================================================== -->
<input class="text" type="text" name="an" id="receiver"
value="<?php
if (isset($id)) {
    echo getCachedUsername($id, $database, $userCache);
}
?>"
maxlength="20" tabindex="1" /><br />

<!-- ======================================================
     SUBJECT (reply logic păstrată 100%)
====================================================== -->
<input class="text" type="text" name="be" id="subject"
value="<?php
if (isset($message->reply['topic'])) {

    if (preg_match("/re([0-9]+)/i", $message->reply['topic'], $c)) {
        $c = $c[1] + 1;
        echo strip_tags(preg_replace("/re[0-9]+/i", "re" . ($c), $message->reply['topic']));
    } else {
        echo "re1:" . strip_tags($message->reply['topic']);
    }
}
?>"
maxlength="35" tabindex="2" />

</div>

<a id="adbook" href="#" onclick="toggleFriendsList(); return false;">
    <img src="img/x.gif" alt="<?php echo ADDRESSBOOK; ?>" title="<?php echo ADDRESSBOOK; ?>" />
</a>

<div class="clear"></div>
<div class="line"></div>

<!-- ======================================================
     MESSAGE AREA (NU MODIFICĂM BB EDITOR)
====================================================== -->
			<div bbArea="message" id="message_container" name="message_container">
				<div id="message_toolbar" name="message_toolbar">
					<a href="javascript:void(0);" bbType="d" bbTag="b" ><div title="<?php echo TZ_BOLD; ?>" alt="<?php echo TZ_BOLD; ?>" class="bbButton bbBold"></div></a>
					<a href="javascript:void(0);" bbType="d" bbTag="i" ><div title="<?php echo TZ_ITALIC; ?>" alt="<?php echo TZ_ITALIC; ?>" class="bbButton bbItalic"></div></a>
					<a href="javascript:void(0);" bbType="d" bbTag="u" ><div title="<?php echo TZ_UNDERLINE; ?>" alt="<?php echo TZ_UNDERLINE; ?>" class="bbButton bbUnderscore"></div></a>
					<a href="javascript:void(0);" bbType="d" bbTag="alliance0" ><div title="<?php echo ALLIANCE; ?>" alt="<?php echo ALLIANCE; ?>" class="bbButton bbAlliance"></div></a>
					<a href="javascript:void(0);" bbType="d" bbTag="player0" ><div title="<?php echo PLAYER; ?>" alt="<?php echo PLAYER; ?>" class="bbButton bbPlayer"></div></a>
					<a href="javascript:void(0);" bbType="d" bbTag="coor0" ><div title="<?php echo COORDINATES; ?>" alt="<?php echo COORDINATES; ?>" class="bbButton bbCoordinate" onclick="this.form.submit(); window.location.href = '?t=1&coor=<?php echo ($coor ?? 0)+1; ?>';"></div></a>
					<a href="javascript:void(0);" bbType="d" bbTag="report0" ><div title="<?php echo REPORT; ?>" alt="<?php echo REPORT; ?>" class="bbButton bbReport"></div></a>
					<a href="javascript:void(0);" bbWin="resources" id="message_resourceButton"><div title="<?php echo RESOURCES; ?>" alt="<?php echo RESOURCES; ?>" class="bbButton bbResource"></div></a>
					<a href="javascript:void(0);" bbWin="smilies" id="message_smilieButton"><div title="<?php echo TZ_SMILIES_2; ?>" alt="<?php echo TZ_SMILIES_2; ?>" class="bbButton bbSmilie"></div></a>
					<a href="javascript:void(0);" bbWin="troops" id="message_troopButton"><div title="<?php echo TROOPS; ?>" alt="<?php echo TROOPS; ?>" class="bbButton bbTroop"></div></a>
					<a href="javascript:void(0);" id="message_previewButton" bbArea="message">
					<div title="<?php echo TZ_PREVIEW_2; ?>" alt="<?php echo TZ_PREVIEW_2; ?>" class="bbButton bbPreview"></div>
					</a>
					<div class="clear"></div>
					<div id="message_toolbarWindows">
						<div id="message_resources" name="message_resources"><a href="javascript:void(0);" bbType="o" bbTag="l" ><img src="img/x.gif" class="r1" title="<?php echo LUMBER; ?>" alt="<?php echo LUMBER; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="cl" ><img src="img/x.gif" class="r2" title="<?php echo CLAY; ?>" alt="<?php echo CLAY; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="i" ><img src="img/x.gif" class="r3" title="<?php echo IRON; ?>" alt="<?php echo IRON; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="c" ><img src="img/x.gif" class="r4" title="<?php echo CROP; ?>" alt="<?php echo CROP; ?>" /></a></div>
						<div id="message_smilies" name="message_smilies"><a href="javascript:void(0);"  bbType="s" bbTag="*aha*" ><img class="smiley aha" src="img/x.gif" alt="*aha*" title="*aha*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*angry*" ><img class="smiley angry" src="img/x.gif" alt="*angry*" title="*angry*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*cool*" ><img class="smiley cool" src="img/x.gif" alt="*cool*" title="*cool*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*cry*" ><img class="smiley cry" src="img/x.gif" alt="*cry*" title="*cry*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*cute*" ><img class="smiley cute" src="img/x.gif" alt="*cute*" title="*cute*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*depressed*" ><img class="smiley depressed" src="img/x.gif" alt="*depressed*" title="*depressed*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*eek*" ><img class="smiley eek" src="img/x.gif" alt="*eek*" title="*eek*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*ehem*" ><img class="smiley ehem" src="img/x.gif" alt="*ehem*" title="*ehem*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*emotional*" ><img class="smiley emotional" src="img/x.gif" alt="*emotional*" title="*emotional*" /></a><a href="javascript:void(0);"  bbType="s" bbTag=":D" ><img class="smiley grin" src="img/x.gif" alt=":D" title=":D" /></a><a href="javascript:void(0);"  bbType="s" bbTag=":)" ><img class="smiley happy" src="img/x.gif" alt=":)" title=":)" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*hit*" ><img class="smiley hit" src="img/x.gif" alt="*hit*" title="*hit*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*hmm*" ><img class="smiley hmm" src="img/x.gif" alt="*hmm*" title="*hmm*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*hmpf*" ><img class="smiley hmpf" src="img/x.gif" alt="*hmpf*" title="*hmpf*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*hrhr*" ><img class="smiley hrhr" src="img/x.gif" alt="*hrhr*" title="*hrhr*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*huh*" ><img class="smiley huh" src="img/x.gif" alt="*huh*" title="*huh*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*lazy*" ><img class="smiley lazy" src="img/x.gif" alt="*lazy*" title="*lazy*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*love*" ><img class="smiley love" src="img/x.gif" alt="*love*" title="*love*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*nocomment*" ><img class="smiley nocomment" src="img/x.gif" alt="*nocomment*" title="*nocomment*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*noemotion*" ><img class="smiley noemotion" src="img/x.gif" alt="*noemotion*" title="*noemotion*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*notamused*" ><img class="smiley notamused" src="img/x.gif" alt="*notamused*" title="*notamused*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*pout*" ><img class="smiley pout" src="img/x.gif" alt="*pout*" title="*pout*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*redface*" ><img class="smiley redface" src="img/x.gif" alt="*redface*" title="*redface*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*rolleyes*" ><img class="smiley rolleyes" src="img/x.gif" alt="*rolleyes*" title="*rolleyes*" /></a><a href="javascript:void(0);"  bbType="s" bbTag=":(" ><img class="smiley sad" src="img/x.gif" alt=":(" title=":(" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*shy*" ><img class="smiley shy" src="img/x.gif" alt="*shy*" title="*shy*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*smile*" ><img class="smiley smile" src="img/x.gif" alt="*smile*" title="*smile*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*tongue*" ><img class="smiley tongue" src="img/x.gif" alt="*tongue*" title="*tongue*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*veryangry*" ><img class="smiley veryangry" src="img/x.gif" alt="*veryangry*" title="*veryangry*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*veryhappy*" ><img class="smiley veryhappy" src="img/x.gif" alt="*veryhappy*" title="*veryhappy*" /></a><a href="javascript:void(0);"  bbType="s" bbTag=";)" ><img class="smiley wink" src="img/x.gif" alt=";)" title=";)" /></a></div>
						<div id="message_troops" name="message_troops"><a href="javascript:void(0);" bbType="o" bbTag="tid1" ><img class="unit u1" src="img/x.gif"  title="<?php echo U1; ?>" alt="<?php echo U1; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid2" ><img class="unit u2" src="img/x.gif"  title="<?php echo U2; ?>" alt="<?php echo U2; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid3" ><img class="unit u3" src="img/x.gif"  title="<?php echo U3; ?>" alt="<?php echo U3; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid4" ><img class="unit u4" src="img/x.gif"  title="<?php echo U4; ?>" alt="<?php echo U4; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid5" ><img class="unit u5" src="img/x.gif"  title="<?php echo U5; ?>" alt="<?php echo U5; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid6" ><img class="unit u6" src="img/x.gif"  title="<?php echo U6; ?>" alt="<?php echo U6; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid7" ><img class="unit u7" src="img/x.gif"  title="<?php echo U7; ?>" alt="<?php echo U7; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid8" ><img class="unit u8" src="img/x.gif"  title="<?php echo U8; ?>" alt="<?php echo U8; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid9" ><img class="unit u9" src="img/x.gif"  title="<?php echo U9; ?>" alt="<?php echo U9; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid10" ><img class="unit u10" src="img/x.gif"  title="<?php echo U10; ?>" alt="<?php echo U10; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid11" ><img class="unit u11" src="img/x.gif"  title="<?php echo U11; ?>" alt="<?php echo U11; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid12" ><img class="unit u12" src="img/x.gif"  title="<?php echo U12; ?>" alt="<?php echo U12; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid13" ><img class="unit u13" src="img/x.gif"  title="<?php echo U13; ?>" alt="<?php echo U13; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid14" ><img class="unit u14" src="img/x.gif"  title="<?php echo U14; ?>" alt="<?php echo U14; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid15" ><img class="unit u15" src="img/x.gif"  title="<?php echo U15; ?>" alt="<?php echo U15; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid16" ><img class="unit u16" src="img/x.gif"  title="<?php echo U16; ?>" alt="<?php echo U16; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid17" ><img class="unit u17" src="img/x.gif"  title="<?php echo U17; ?>" alt="<?php echo U17; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid18" ><img class="unit u18" src="img/x.gif"  title="<?php echo U18; ?>" alt="<?php echo U18; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid19" ><img class="unit u19" src="img/x.gif"  title="<?php echo U19; ?>" alt="<?php echo U19; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid20" ><img class="unit u20" src="img/x.gif"  title="<?php echo U10; ?>" alt="<?php echo U10; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid21" ><img class="unit u21" src="img/x.gif"  title="<?php echo U21; ?>" alt="<?php echo U21; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid22" ><img class="unit u22" src="img/x.gif"  title="<?php echo U22; ?>" alt="<?php echo U22; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid23" ><img class="unit u23" src="img/x.gif"  title="<?php echo U23; ?>" alt="<?php echo U23; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid24" ><img class="unit u24" src="img/x.gif"  title="<?php echo U24; ?>" alt="<?php echo U24; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid25" ><img class="unit u25" src="img/x.gif"  title="<?php echo U25; ?>" alt="<?php echo U25; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid26" ><img class="unit u26" src="img/x.gif"  title="<?php echo U26; ?>" alt="<?php echo U26; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid27" ><img class="unit u27" src="img/x.gif"  title="<?php echo U17; ?>" alt="<?php echo U17; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid28" ><img class="unit u28" src="img/x.gif"  title="<?php echo U28; ?>" alt="<?php echo U28; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid29" ><img class="unit u29" src="img/x.gif"  title="<?php echo U29; ?>" alt="<?php echo U29; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid30" ><img class="unit u30" src="img/x.gif"  title="<?php echo U10; ?>" alt="<?php echo U10; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid31" ><img class="unit u31" src="img/x.gif"  title="<?php echo U31; ?>" alt="<?php echo U31; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid32" ><img class="unit u32" src="img/x.gif"  title="<?php echo U32; ?>" alt="<?php echo U32; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid33" ><img class="unit u33" src="img/x.gif"  title="<?php echo U33; ?>" alt="<?php echo U33; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid34" ><img class="unit u34" src="img/x.gif"  title="<?php echo U34; ?>" alt="<?php echo U34; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid35" ><img class="unit u35" src="img/x.gif"  title="<?php echo U35; ?>" alt="<?php echo U35; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid36" ><img class="unit u36" src="img/x.gif"  title="<?php echo U36; ?>" alt="<?php echo U36; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid37" ><img class="unit u37" src="img/x.gif"  title="<?php echo U37; ?>" alt="<?php echo U37; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid38" ><img class="unit u38" src="img/x.gif"  title="<?php echo U38; ?>" alt="<?php echo U38; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid39" ><img class="unit u39" src="img/x.gif"  title="<?php echo U39; ?>" alt="<?php echo U39; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid40" ><img class="unit u40" src="img/x.gif"  title="<?php echo U40; ?>" alt="<?php echo U40; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid41" ><img class="unit u41" src="img/x.gif"  title="<?php echo U41; ?>" alt="<?php echo U41; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid42" ><img class="unit u42" src="img/x.gif"  title="<?php echo U42; ?>" alt="<?php echo U42; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid43" ><img class="unit u43" src="img/x.gif"  title="<?php echo U43; ?>" alt="<?php echo U43; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid44" ><img class="unit u44" src="img/x.gif"  title="<?php echo U44; ?>" alt="<?php echo U44; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid45" ><img class="unit u45" src="img/x.gif"  title="<?php echo U45; ?>" alt="<?php echo U45; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid46" ><img class="unit u46" src="img/x.gif"  title="<?php echo U46; ?>" alt="<?php echo U46; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid47" ><img class="unit u47" src="img/x.gif"  title="<?php echo U47; ?>" alt="<?php echo U47; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid48" ><img class="unit u48" src="img/x.gif"  title="<?php echo U48; ?>" alt="<?php echo U48; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid49" ><img class="unit u49" src="img/x.gif"  title="<?php echo U49; ?>" alt="<?php echo U49; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid50" ><img class="unit u50" src="img/x.gif"  title="<?php echo U10; ?>" alt="<?php echo U10; ?>" /></a><a href="javascript:void(0);" bbType="o" bbTag="hero" ><img class="unit uhero" src="img/x.gif" title="<?php echo U0; ?>" alt="<?php echo U0; ?>" /></a></div>
					</div>
				</div>
				<div class="line bbLine"></div>

<textarea id="message" name="message" tabindex="3" class="textarea write message"><?php
if (isset($message->reply['message'])) {
    echo "\n\n_________________________\nReply: "
        . getCachedUsername($id, $database, $userCache)
        . "\n"
        . stripslashes($message->reply['message']);
}
?></textarea>

<div id="message_preview" class="message"></div>
</div>

<script>
var bbEditor = new BBEditor("message");
</script>

<p class="btn">
<input type="hidden" name="ft" value="m2" />
<button name="delmsg" id="btn_save" class="trav_buttons"
onclick="this.disabled=true;this.form.submit();" tabindex="4"><?php echo SEND; ?></button>

<?php
// ======================================================
// ADMIN / MULTIHUNTER OPTIONS
// ======================================================
if ($session->access == ADMIN && ADMIN_RECEIVE_SUPPORT_MESSAGES && !empty($_GET['mid'])) {
?>
<br />
<input type="checkbox" name="as_support"
<?php echo ((!empty($_GET['tid']) && $_GET['tid'] == 1) ? 'checked="checked"' : ''); ?> />
Send as Support
<?php
} elseif ($session->access == MULTIHUNTER) {
?>
<br />
<input type="checkbox" name="as_multihunter"
<?php echo ((!empty($_GET['tid']) && $_GET['tid'] == 5) ? 'checked="checked"' : ''); ?> />
Send as Multihunter
<?php } ?>
</p>

</form>

<!-- ======================================================
     ADDRESSBOOK (OPTIMIZAT CU CACHE)
====================================================== -->
<div id="adressbook" class="hide">
<h2><?php echo ADDRESSBOOK; ?></h2>

<form method="post" action="nachrichten.php">
<input type="hidden" name="ft" value="m7" />
<input type="hidden" name="myid" value="<?php echo (int)$session->uid; ?>" />

<table cellpadding="1" cellspacing="1" id="friendlist">

<?php
for ($i = 0; $i < 20; $i++) {

    $friendId = (int)$user['friend' . $i];
    $waitId   = (int)$user['friend' . $i . 'wait'];

    if ($friendId == 0 && $waitId == 0) {

        if ($i % 2 == 0) echo "<tr>";

        echo '<td class="end"></td>
              <td class="pla">
                <input class="text" type="text" name="addfriends'.$i.'" maxlength="20" />
              </td>
              <td class="on"></td>';

        if ($i % 2 != 0) echo "</tr>";

    } elseif ($waitId == 0) {

        if ($i % 2 == 0) echo "<tr>";

        $username = getCachedUsername($friendId, $database, $userCache);
        $friend = $database->getUserArray($friendId, 1);

        echo '<td class="end"><a href="nachrichten.php?delfriend='.$i.'">
              <img class="del" src="img/x.gif" alt="'.DELETE.'"></a></td>
              <td class="pla">
              <a href="nachrichten.php?t=1&id='.$friendId.'">'.$username.'</a>
              </td>';

        // ONLINE STATUS (logică identică)
        $time = time() - $friend['timestamp'];

        if ($time < 600) {
            echo "<td class=on><img class=online1 src=img/x.gif /></td>";
        } elseif ($time < 86400) {
            echo "<td class=on><img class=online2 src=img/x.gif /></td>";
        } elseif ($time < 259200) {
            echo "<td class=on><img class=online3 src=img/x.gif /></td>";
        } elseif ($time < 604800) {
            echo "<td class=on><img class=online4 src=img/x.gif /></td>";
        } else {
            echo "<td class=on><img class=online5 src=img/x.gif /></td>";
        }

        if ($i % 2 != 0) echo "</tr>";

    } else {

        // WAIT / CONFIRM logic (neatinsă)
        $friend = $database->getUserArray($waitId, 1);

        if ($i % 2 == 0) echo "<tr>";

        echo '<td class="end"><a href="nachrichten.php?delfriend='.$i.'">
              <img class="del" src="img/x.gif"></a></td>
              <td class="pla">
              <img src="../../'.GP_LOCATE.'img/a/clock-inactive.gif">
              <a href="nachrichten.php?t=1&id='.$waitId.'">'
              . getCachedUsername($waitId, $database, $userCache) .
              '</a></td>
              <td class="on"></td>';

        if ($i % 2 != 0) echo "</tr>";
    }
}
?>

</table>

<p class="btn">
<input type="image" id="btn_save" class="dynamic_img" src="img/x.gif" alt="<?php echo SAVE; ?>" />
</p>

</form>

<a href="#" onclick="closeFriendsList(); return false;">
<img src="img/x.gif" id="close" alt="<?php echo TZ_CLOSE_ADRESSBOOK; ?>" />
</a>

</div>
</div>

<div id="write_foot" class="msg_foot"></div>

<br />

<span style="color: #DD0000">
<b><?php echo TZ_WARNING; ?></b> <?php echo TZ_YOU_CAN_T_USE_THE_VALUES; ?> <b>[message]</b> <?php echo constant('OR'); ?> <b>[/message]</b>
</span>

</div>