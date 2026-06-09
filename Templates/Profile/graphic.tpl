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
##  URLs:          http://travianz.org						       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

if (GP_ENABLE) {
?>

<h1><?php echo PLAYER_PROFILE; ?></h1>

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
        <img class="logo unknown" src="img/x.gif" alt="<?php echo TZ_UNKNOWN; ?>" title="<?php echo TZ_UNKNOWN; ?>">

        <span class="error">
            <?php echo TZ_ML_GPACK_NOTFOUND; ?>
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
                <button class="trav_buttons" id="btn_ok"><?php echo TZ_OK_2; ?></button>
            </div>
        </form>
    </div>

    <!-- ================= SUCCESS BOX ================= -->
    <div id="gpack_activate">

        <span class="info"><?php echo TZ_GRAPHIC_PACK_FOUND; ?></span><br>

        <img id="preview" src="img/x.gif"><br>

        <?php echo TZ_THE_PATH; ?>
        <span class="path"><?php echo $gpackUrlEsc; ?></span>
        <?php echo TZ_ML_GPACK_ALLOWED_SAVE; ?>

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
                <th><?php echo TZ_GRAPHIC_PACK_SETTINGS; ?></th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td class="info">
                    <?php echo TZ_ML_GPACK_ALTER_APPEARANCE; ?>
                    <br><br>
                    <span class="alert"><?php echo TZ_ATTENTION_USE_ONLY_TRUSTWORTHY_GRA; ?></span>
                </td>
            </tr>

            <tr>
                <th class="empty"></th>
            </tr>

            <tr>
                <td>

                    <label>
                        <input type="radio" class="radio" name="gp_type" value="custom" checked="checked" />
                        <?php echo TZ_USER_DEFINED_GRAPHIC_PACK; ?>
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
                        <?php echo TZ_EXAMPLE; ?>
                        <span class="path">file:///C:/Travian/gpack/</span>
                        or
                        <span class="path">http://www.travian.org/user/gpack/</span>
                    </div>

                    <center>
                        <div class="example">
                            <?php echo TZ_DEFAULT; ?>
                            <span class="path"><?php echo GP_LOCATE; ?></span>
                        </div>
                    </center>

                </td>
            </tr>

        </tbody>
    </table>

    <p class="btn">
        <button name="gp_selection_button" value="ok" class="trav_buttons" id="btn_ok">
            <?php echo TZ_OK_2; ?>
        </button>
    </p>
</form>

<!-- ========================= AVAILABLE PACKS ========================= -->

<table cellpadding="1" cellspacing="1" id="download">

    <thead>
        <tr>
            <th colspan="4"><?php echo TZ_MORE_GRAPHIC_PACKS; ?></th>
        </tr>
        <tr>
            <td><?php echo NAME; ?></td>
            <td><?php echo TZ_SIZE_IN_MB; ?></td>
            <td><?php echo ACTIVATE; ?></td>
            <td><?php echo TZ_DOWNLOAD; ?></td>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td class="nam"><?php echo TZ_TRAVIAN_DEFAULT; ?></td>
            <td class="size">4</td>
            <td class="act">
                <a href="spieler.php?s=4&gp_type=custom&custom_url=gpack/travian_default/">
                    Activate
                </a>
            </td>
            <td class="down">
                <a href="gpack/download/travian_default.zip" target="_blank">
                    <?php echo TZ_DOWNLOAD; ?>
                </a>
            </td>
        </tr>

        <tr>
            <td class="nam"><?php echo TZ_TRAVIAN_T4_STYLE; ?></td>
            <td class="size">4</td>
            <td class="act">
                <a href="spieler.php?s=4&gp_type=custom&custom_url=gpack/travian_t4/">
                    Activate
                </a>
            </td>
            <td class="down">
                <a href="gpack/download/travian_default.zip" target="_blank">
                    <?php echo TZ_DOWNLOAD; ?>
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