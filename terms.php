<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : terms.php                      	                       ##
##  Type           : In Game Terms Page                                        ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki 						                               ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  URLs:          : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
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
    <title><?php echo SERVER_NAME; ?> - <?php echo PUBLIC_TERMS_TITLE; ?></title>

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
        <h1><?php echo PUBLIC_WELCOME_TO; ?> <?php echo SERVER_NAME; ?></h1>
    </div>

    <div id="navigation">

        <a href="index.php" class="home">
            <img src="img/x.gif" alt="Travian"/>
        </a>

        <table class="menu">
            <tr>
                <td><a href="tutorial.php"><span><?php echo TUTORIAL; ?></span></a></td>
                <td><a href="anleitung.php"><span><?php echo PUBLIC_MANUAL; ?></span></a></td>
                <td><a href="https://github.com/Shadowss/TravianZ/discussions" target="_blank"><span><?php echo FORUM; ?></span></a></td>
                <td><a href="index.php?signup"><span><?php echo PUBLIC_REGISTER; ?></span></a></td>
                <td><a href="index.php?login"><span><?php echo LOGIN; ?></span></a></td>
            </tr>
        </table>

    </div>

    <div id="content">

        <div class="grit">

            <h1><?php echo PUBLIC_TERMS_TITLE; ?></h1>

            <div class="terms-box">

                <h3 class="pop popgreen bold"><?php echo PUBLIC_TERMS_GENERAL_RULES; ?></h3>
                <p>
                    <?php echo PUBLIC_TERMS_PROJECT; ?>
                    <?php echo PUBLIC_TERMS_ACCEPTANCE; ?>
                </p>

                <br/>

                <h3 class="pop popgreen bold"><?php echo PUBLIC_TERMS_ACCOUNT_RESPONSIBILITY; ?></h3>
                <p>
                    <?php echo PUBLIC_TERMS_ACCOUNT_FULL_RESPONSIBILITY; ?>
                    <?php echo PUBLIC_TERMS_ACCOUNT_SHARING; ?>
                    Any abuse or exploitation of bugs is strictly forbidden.
                </p>

                <br/>

                <h3 class="pop popgreen bold">3. Fair Play</h3>
                <p>
                    <?php echo PUBLIC_TERMS_CHEATING; ?>
                    is not allowed and may result in permanent ban.
                </p>

                <br/>

                <h3 class="pop popgreen bold"><?php echo PUBLIC_TERMS_SERVER_STATUS; ?></h3>
                <p>
                    <?php echo PUBLIC_TERMS_AS_IS; ?>
                    <?php echo PUBLIC_TERMS_RESET; ?>
                </p>

                <br/>

                <h3 class="pop popgreen bold">5. Intellectual Property</h3>
                <p>
                    Travian® is a registered trademark of Travian Games GmbH.
                    <?php echo PUBLIC_TERMS_NO_AFFILIATION; ?>
                    All custom code and modifications belong to TravianZ by Shadow.
                </p>

                <br/>

                <h3 class="pop popgreen bold">6. Changes</h3>
                <p>
                    <?php echo PUBLIC_TERMS_UPDATES; ?>
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
            <img class="dynamic_img" alt="<?php echo PUBLIC_CLOSE; ?>" src="img/un/x.gif" />
        </a>

        <h2><?php echo PUBLIC_TERMS_SHORT; ?></h2>

        <div id="frame_box"></div>

        <div class="footer" data-year="<?php echo date('Y'); ?>"></div>

    </div>

</div>

</body>
</html>