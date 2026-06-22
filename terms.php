<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : terms.php                                                 ##
##  Type           : Info Page                                                 ##
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
    <title><?php echo SERVER_NAME; ?> - Terms and Conditions</title>

    <link rel="stylesheet" type="text/css" href="img/tutorial/main.css"/>
    <link rel="stylesheet" type="text/css" href="img/tutorial/flaggs.css"/>

    <meta name="content-language" content="en"/>
    <meta http-equiv="imagetoolbar" content="no"/>

    <script src="mt-core.js" type="text/javascript"></script>
    <script src="new.js" type="text/javascript"></script>

    <style type="text/css">
        .grit {
            overflow: hidden;
        }

        .footer {
            clear: both;
            width: 100%;
            height: 60px;
            margin-top: 30px;
            background: #0f0f0f;
            border-top: 2px solid #333;
            text-align: center;
            color: #bbb;
            font-size: 12px;
            line-height: 60px;
        }

        .footer:before {
            content: "TravianZ by Shadow © 2010-" attr(data-year);
        }

        .terms-box {
            padding: 10px;
            color: #333;
            font-size: 12px;
            line-height: 1.6;
        }

        h1 {
            margin-bottom: 15px;
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

            <h1>Terms and Conditions</h1>

            <div class="terms-box">

                <h3 class="pop popgreen bold">1. General Rules</h3>
                <p>
                    This is a fan-made open-source project called TravianZ by Shadow.
                    By using this game server you agree to follow all rules stated here.
                </p>

                <br/>

                <h3 class="pop popgreen bold">2. Account Responsibility</h3>
                <p>
                    You are fully responsible for your account.
                    Sharing accounts is allowed only if game rules permit it.
                    Any abuse or exploitation of bugs is strictly forbidden.
                </p>

                <br/>

                <h3 class="pop popgreen bold">3. Fair Play</h3>
                <p>
                    Cheating, botting, multi-account abuse or exploiting game mechanics
                    is not allowed and may result in permanent ban.
                </p>

                <br/>

                <h3 class="pop popgreen bold">4. Server Status</h3>
                <p>
                    This server is provided "as-is" without guarantees of uptime or stability.
                    The developer reserves the right to reset or modify the server at any time.
                </p>

                <br/>

                <h3 class="pop popgreen bold">5. Intellectual Property</h3>
                <p>
                    Travian® is a registered trademark of Travian Games GmbH.
                    This project is not affiliated with Travian Games.
                    All custom code and modifications belong to TravianZ by Shadow.
                </p>

                <br/>

                <h3 class="pop popgreen bold">6. Changes</h3>
                <p>
                    These terms may be updated at any time without prior notice.
                </p>

            </div>

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

        <h2>Terms</h2>

        <div id="frame_box"></div>

        <div class="footer" data-year="<?php echo date('Y'); ?>"></div>

    </div>

</div>

</body>
</html>