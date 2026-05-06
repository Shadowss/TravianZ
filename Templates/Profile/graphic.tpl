<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       06.05.2026 						       	 				   ##
##  Filename       graphic.tpl                                                 ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

if (GP_ENABLE) {
?>

<h1>Player profile</h1>

<?php
// =========================
// MENU INCLUDE (IMPORTANT)
// =========================
include("menu.tpl");

// =========================
// SAVE CUSTOM GPACK (POST)
// =========================
if (isset($_POST["custom_url"])) {

    // păstrăm compatibilitatea cu sistemul vechi
    $database->updateUserField(
        $session->uid,
        "gpack",
        $_POST["custom_url"],
        1
    );
}

// =========================
// PREVIEW GPACK (GET)
// =========================
if (isset($_GET["custom_url"])) {

    // NU schimbăm logica, doar securizăm output
    $gpackUrl = $_GET["custom_url"];
    $gpackUrlEsc = htmlspecialchars($gpackUrl, ENT_QUOTES, 'UTF-8');
?>

<link href="<?php echo $gpackUrlEsc; ?>lang/en/gp_check.css" rel="stylesheet" type="text/css">

<div id="gpack_popup">

    <!-- ================= ERROR BOX ================= -->
    <div id="gpack_error">
        <img class="logo unknown" src="img/x.gif" alt="unknown" title="unknown">

        <span class="error">
            Graphic Pack could not be found. This could be due to the following reasons:
        </span>

        <br>

        <ul>
            <li>
                The path must be set to the folder that contains the file
                '<b>travian.css</b>' and the folders '<b>img</b>', '<b>lang</b>' and '<b>modules</b>'.
            </li>
            <li>
                Your browser does not support Graphic Packs hosted on your computer and needs them online,
                starting with '<b>http://</b>'.
            </li>
        </ul>

        <form action="spieler.php" method="post">
            <input type="hidden" name="s" value="4">
            <div class="btn">
                <button class="trav_buttons" id="btn_ok">Ok</button>
            </div>
        </form>
    </div>

    <!-- ================= SUCCESS BOX ================= -->
    <div id="gpack_activate">

        <span class="info">Graphic Pack found.</span><br>

        <img id="preview" src="img/x.gif"><br>

        The path
        <span class="path"><?php echo $gpackUrlEsc; ?></span>
        shows an allowed Graphic Pack.

        Save your choice to activate it.

        <form action="spieler.php" method="post">
            <input type="hidden" name="s" value="4">
            <input type="hidden" name="custom_url" value="<?php echo $gpackUrlEsc; ?>">

            <div class="btn">
                <button class="trav_buttons" id="btn_save" name="gp_activate_button">
                    Save
                </button>
            </div>
        </form>

    </div>

</div>

<?php } ?>

<!-- ========================= FORM GP SETTINGS ========================= -->

<form action="spieler.php" method="post" name="gp_selection">
    <input type="hidden" name="s" value="4" />

    <table cellpadding="1" cellspacing="1" id="gpack">

        <thead>
            <tr>
                <th>Graphic pack settings</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td class="info">
                    With a graphic pack you can alter the appearance of Travian.
                    You can choose one from the list or provide a custom path.
                    <br><br>
                    <span class="alert">ATTENTION! Use only trustworthy graphic packs</span>
                </td>
            </tr>

            <tr>
                <th class="empty"></th>
            </tr>

            <tr>
                <td>

                    <label>
                        <input type="radio" class="radio" name="gp_type" value="custom" checked="checked" />
                        User-defined graphic pack
                    </label>

                    <input
                        class="text"
                        type="text"
                        name="custom_url"
                        value="<?php echo $session->gpack; ?>"
                        onclick="document.gp_selection.gp_type[1].checked = true"
                    />

                    <br />

                    <div class="example">
                        Example:
                        <span class="path">file:///C:/Travian/gpack/</span>
                        or
                        <span class="path">http://www.travian.org/user/gpack/</span>
                    </div>

                    <center>
                        <div class="example">
                            Default:
                            <span class="path"><?php echo GP_LOCATE; ?></span>
                        </div>
                    </center>

                </td>
            </tr>

        </tbody>
    </table>

    <p class="btn">
        <button name="gp_selection_button" value="ok" class="trav_buttons" id="btn_ok">
            Ok
        </button>
    </p>
</form>

<!-- ========================= AVAILABLE PACKS ========================= -->

<table cellpadding="1" cellspacing="1" id="download">

    <thead>
        <tr>
            <th colspan="4">More graphic packs</th>
        </tr>
        <tr>
            <td>Name</td>
            <td>Size in MB</td>
            <td>Activate</td>
            <td>Download</td>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td class="nam">Travian Default</td>
            <td class="size">4</td>
            <td class="act">
                <a href="spieler.php?s=4&gp_type=custom&custom_url=gpack/travian_default/">
                    Activate
                </a>
            </td>
            <td class="down">
                <a href="gpack/download/travian_default.zip" target="_blank">
                    Download
                </a>
            </td>
        </tr>

        <tr>
            <td class="nam">Travian T4 Style</td>
            <td class="size">4</td>
            <td class="act">
                <a href="spieler.php?s=4&gp_type=custom&custom_url=gpack/travian_t4/">
                    Activate
                </a>
            </td>
            <td class="down">
                <a href="gpack/download/travian_default.zip" target="_blank">
                    Download
                </a>
            </td>
        </tr>

    </tbody>

</table>

<?php
} else {
    // fallback dacă GP_ENABLE este dezactivat
    header("Location: " . $_SERVER['PHP_SELF'] . "?uid=" . $session->uid);
    exit;
}
?>