<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : impressum.php                                             ##
## --------------------------------------------------------------------------- ##
##  Refactored by  : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Project        : TravianZ                                                  ##
#################################################################################

use App\Utils\AccessLogger;

include_once("GameEngine/config.php");
include_once("GameEngine/Database.php");
include_once("GameEngine/Lang/".LANG.".php");

AccessLogger::logRequest();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title><?php echo SERVER_NAME; ?> - Impressum</title>

    <link rel="stylesheet" type="text/css" href="img/tutorial/main.css"/>
    <link rel="stylesheet" type="text/css" href="img/tutorial/flaggs.css"/>

    <meta name="content-language" content="en"/>
    <meta http-equiv="imagetoolbar" content="no"/>

    <script src="mt-core.js" type="text/javascript"></script>
    <script src="new.js" type="text/javascript"></script>

    <!-- 🔥 INLINE CSS FIX (footer + layout safe) -->
    <style type="text/css">

        body {
            margin: 0;
            padding: 0;
        }

        .wrapper {
            min-height: 100vh;
        }

        .grit {
            overflow: hidden; /* FIX FLOAT BUG */
        }

        /* 🔥 FOOTER 100% VIZIBIL */
        .footer {
            clear: both;
            width: 100%;
            height: 60px;
            margin-top: 30px;

            display: block;

            background: #0f0f0f;
            border-top: 2px solid #333;

            text-align: center;
            color: #bbb;
            font-size: 12px;
            line-height: 60px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .footer:before {
            content: "TravianZ by Shadow © 2010-" attr(data-year);
        }

        /* optional polish */
        a {
            color: #d4b87a;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>

</head>

<body class="webkit contentPage">

<div class="wrapper">

    <div id="country_select"></div>

    <div id="header">
        <h1>Welcome to <?php echo SERVER_NAME; ?></h1>
    </div>

    <div id="navigation">

        <a href="index.php" class="home">
            <img src="img/x.gif" alt="Travian"/>
        </a>

        <table class="menu">
            <tr>
                <td><a href="tutorial.php"><span>Tutorial</span></a></td>
                <td><a href="anleitung.php"><span>Manual</span></a></td>
                <td><a href="forum.php" target="_blank"><span>Forum</span></a></td>
                <td><a href="index.php?signup"><span>Register</span></a></td>
                <td><a href="index.php?login"><span>Login</span></a></td>
            </tr>
        </table>

    </div>

    <div id="content">

        <div class="grit">

            <h1>Impressum</h1>

            <p class="submenu">

                <b>Project:</b><br/>
                TravianZ by Shadow<br/><br/>

                <b>Initiator & Lead Developer:</b><br/>
                Shadow (Catalin Novgorodschi)<br/><br/>

                <b>About this Project:</b><br/>
                Open-source Travian 3.6 engine modernization project focused on performance,
                stability and gameplay preservation.<br/><br/>

                <b>Main Goals:</b><br/>
                - Preserve classic Travian gameplay<br/>
                - Refactor legacy codebase<br/>
                - Improve performance and stability<br/>
                - Add new tribes and mechanics<br/>
                - Maintain community-driven development<br/><br/>

                <b>Source Code:</b><br/>
                <a href="https://github.com/Shadowss/TravianZ" target="_blank">
                    https://github.com/Shadowss/TravianZ
                </a><br/><br/>

                <b>Disclaimer:</b><br/>
                This is an unofficial fan-made project and is not affiliated with Travian Games GmbH.<br/><br/>

                © 2010-<?php echo date('Y'); ?> TravianZ Project

            </p>

            <!-- 🔥 FOOTER FIXED -->
            <div class="footer" data-year="<?php echo date('Y'); ?>"></div>

        </div>

    </div>

</div>

<!-- overlay -->
<div id="iframe_layer" class="overlay">

    <div class="mask closer"></div>

    <div class="overlay_content">

        <a href="index.php" class="closer">
            <img class="dynamic_img" alt="Close" src="img/un/x.gif" />
        </a>

        <h2>Anleitung</h2>

        <div id="frame_box"></div>

        <div class="footer" data-year="<?php echo date('Y'); ?>"></div>

    </div>

</div>

</body>
</html>