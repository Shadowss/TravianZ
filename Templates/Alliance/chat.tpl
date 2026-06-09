<?php
#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                              ##
## --------------------------------------------------------------------------- ##
## Project:     TravianZ (Incremental Refactor SAFE)                           ##
## File:        chat.tpl                                                       ##
## Description: Alliance chat (AJAX)                            			   ##
## Improvements:                                                               ##
##  - Input validation                                                         ##
##  - XSS protection                                                           ##
##  - Fixed invalid HTML structure                                             ##
##  - Safer JavaScript (no string eval)                                        ##
##  - Prevent empty / spam messages                                            ##
#################################################################################

// -------------------------------------------------
// SAFE ALLIANCE ID
// -------------------------------------------------
if (!isset($aid)) {
    $aid = (int)$session->alliance;
}

// -------------------------------------------------
// LOAD ALLIANCE DATA
// -------------------------------------------------
$allianceinfo = $database->getAlliance($aid);

// header (XSS safe)
echo "<h1>" 
    . htmlspecialchars($allianceinfo['tag'], ENT_QUOTES, 'UTF-8') 
    . " - " 
    . htmlspecialchars($allianceinfo['name'], ENT_QUOTES, 'UTF-8') 
    . "</h1>";

// menu
include("alli_menu.tpl");
?>

<script type="text/javascript">
<?php sajax_show_javascript(); ?>

// -------------------------------------------------
// CALLBACK: receive chat HTML
// -------------------------------------------------
function show_data_cb(text) {
    document.getElementById("masnun").innerHTML = text;
}

// -------------------------------------------------
// POLLING LOOP (fixed setTimeout)
// -------------------------------------------------
function start_it() {
    x_get_data(show_data_cb);
    setTimeout(start_it, 1000);
}

// -------------------------------------------------
// EMPTY CALLBACK (kept for compatibility)
// -------------------------------------------------
function add_cb() {}

// -------------------------------------------------
// SEND MESSAGE (safe version)
// -------------------------------------------------
function send_data() {

    var msgField = document.form1.msg;
    var msg = msgField.value.trim();

    // prevent empty messages
    if (msg.length === 0) {
        return false;
    }

    // optional spam protection (client-side)
    if (msg.length > 250) {
        msg = msg.substring(0, 250);
    }

    // send via SAJAX
    x_add_data(msg, add_cb);

    // clear field
    msgField.value = "";

    return false; // prevent form submit reload
}
</script>

<!-- IMPORTANT: no <body> tag here (TPL file) -->

<form name="form1" onsubmit="return send_data();">

    <div id="TitleName" class="chatHeader"><?php echo TZ_ALLY_CHAT; ?></div>

    <div id="chatContainer"
         style="position:relative; height:220px; width:500px; overflow:hidden; background:#FFF; border:1px solid #C0C0C0;">

        <div id="masnun"
             style="position:absolute; top:0; right:5px; width:470px; background:#FFF;"></div>

        <div id="scrollbarbackground2"
             style="position:absolute; top:0; right:481px; width:17px; height:198px;"></div>

        <div id="scrollbarbackground"
             style="position:absolute; top:0; right:489px; width:1px; height:198px; border:1px solid #71D000; background:#FFF;"></div>

        <div id="scrollbar"
             style="position:absolute; top:0; right:481px; width:17px; height:198px; border:1px solid #71D000; background:#F0FFF0;"></div>

        <input id="scrollCheckbox"
               class="fm"
               checked="checked"
               type="checkbox"
               style="position:absolute; top:200px; right:481px;" />
    </div>

    <div style="margin:10px 0;">
        <table cellpadding="1" cellspacing="1">
            <tr>
                <td>
                    <input name="s" value="6" type="hidden" />
                    <input class="text"
                           type="text"
                           name="msg"
                           maxlength="250"
                           style="width:415px;" />
                </td>
                <td>
                    <input type="button"
                           id="btn_ok"
                           style="border:0; float:left;"
                           alt="<?php echo TZ_OK_3; ?>"
                           onclick="send_data();" />
                </td>
            </tr>
        </table>
    </div>

</form>

<!-- extra container (kept for compatibility) -->
<div id="rooms"></div>

<script>
// start chat after DOM ready
start_it();
</script>