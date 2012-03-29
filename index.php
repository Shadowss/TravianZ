<?php

/** --------------------------------------------------- **\
| ********* DO NOT REMOVE THIS COPYRIGHT NOTICE ********* |
+---------------------------------------------------------+
| Credits:     All the developers including the leaders:  |
|              Advocaite & Dzoki & Donnchadh              |
|                                                         |
| Copyright:   TravianX Project All rights reserved       |
\** --------------------------------------------------- **/

       if(!file_exists('GameEngine/config.php')) {
        header("Location: install/");
       }

       include ("GameEngine/Database.php");
       include ("GameEngine/config.php");
       include ("GameEngine/Lang/en.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Powered by TravianX - <?php

           echo SERVER_NAME;

    ?></title>
    <link rel="stylesheet" type="text/css" href="gpack/travian/main.css" />
    <link rel="stylesheet" type="text/css" href="gpack/travian/flaggs.css" />
    <meta name="content-language" content="en" />
    <meta http-equiv="imagetoolbar" content="no" />
    <script src="mt-core.js" type="text/javascript">
</script>
    <script src="new.js" type="text/javascript">
</script>
    <style type="text/css">
/*<![CDATA[*/
    li.c4 {background-image:url('img/kr/welten/kr2_big.jpg');}
    li.c3 {background-image:url('img/kr/welten/kr2_big_g.jpg');}
    div.c2 {left:237px;}
    ul.c1 {position:absolute; left:0px; width: 686px;}
    /*]]>*/
    </style>
</head>

<body class="presto indexPage">
    <div class="wrapper">
        <!--<div id="country_select">
    <div id="flags"></div>
    <script src="flaggen.js?a" type="text/javascript"></script>
    <script type="text/javascript">
        var region_list = new Array('Europe','America','Asia','Middle East','Africa','Oceania');
        show_flags('', '', region_list);
    </script>
</div>-->

        <div id="header">
            <h1><?php

                   echo $lang['index'][0][1];

            ?></h1>
        </div>

        <div id="navigation">
            <a href="index.php" class="home"><img src="img/x.gif" alt="Travian" /></a>

            <table class="menu">
                <tr>
                    <td><a href="anleitung.php"><span><?php

                           echo $lang['index'][0][2];

                    ?></span></a></td>

                    <td><a href="#" target="_blank"><span><?php

                           echo $lang['forum'];

                    ?></span></a></td>

                    <td><a href="anmelden.php" class="mark"><span><?php

                           echo $lang['register'];

                    ?></span></a></td>

                    <td><a href="login.php"><span><?php

                           echo $lang['login'];

                    ?></span></a></td>
                </tr>
            </table>
        </div>

        <div id="register_now">
            <a href="anmelden.php"><?php

                   echo $lang['register'];

            ?></a><span><?php

                   echo $lang['index'][0][3];

            ?></span>
        </div>

        <div id="content">
            <div class="grit">
                <div class="infobox">
                    <div id="what_is_travian">
                        <h2><?php

                               echo $lang['index'][0][4];

                        ?></h2>

                        <p><?php

                               echo $lang['index'][0][5];

                        ?></p>

                        <p class="play_now"><a href="anmelden.php"><?php

                               echo $lang['index'][0][6];

                        ?></a></p>
                    </div>

                    <div id="player_counter">
                        <table>
                            <tbody>
                                <tr>
                                    <th><?php

                                           echo $lang['index'][0][7];

                                    ?>:</th>

                                    <td><?php

                                           $users = mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "users WHERE id > 0"));
                                           echo ($users)-3;

                                    ?></td>
                                </tr>

                                <tr>
                                    <th><?php

                                           echo $lang['index'][0][8];

                                    ?>:</th>

                                    <td><?php

                                           $active = mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "users WHERE " . time() . "-timestamp < (3600*24)"));
                                           echo $active;

                                    ?></td>
                                </tr>

                                <tr>
                                    <th><?php

                                           echo $lang['index'][0][9];

                                    ?>:</th>

                                    <td><?php

                                           $online = mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "users WHERE " . time() . "-timestamp < (60*5)"));
                                           echo $online;

                                    ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="about_the_game">
                        <h2><?php

                               echo $lang['index'][0][10];

                        ?>:</h2>

                        <ul>
                            <li><?php

                                   echo $lang['index'][0][11];

                            ?></li>

                            <li><?php

                                   echo $lang['index'][0][12];

                            ?></li>

                            <li><?php

                                   echo $lang['index'][0][13];

                            ?></li>
                        </ul>
                    </div>
                </div>

                <div class="secondarybox">
                    <div id="screenshots">
                        <h2>Screenshots</h2><a href="#last" class="navi prev dynamic_btn"><img class="dynamic_btn" src="img/x.gif" alt="previous" /></a>

                        <div id="screenshots_preview">
                            <ul id="screenshot_list" class="c1">
                                <li><a href="#"><img src="img/un/s/s1s.jpg" alt="Screenshot" /></a></li>

                                <li><a href="#"><img src="img/un/s/s2s.jpg" alt="Screenshot" /></a></li>

                                <li><a href="#"><img src="img/un/s/s4s.jpg" alt="Screenshot" /></a></li>

                                <li><a href="#"><img src="img/un/s/s3s.jpg" alt="Screenshot" /></a></li>

                                <li><a href="#"><img src="img/un/s/s5s.jpg" alt="Screenshot" /></a></li>

                                <li><a href="#"><img src="img/un/s/s7s.jpg" alt="Screenshot" /></a></li>

                                <li><a href="#"><img src="img/un/s/s8s.jpg" alt="Screenshot" /></a></li>
                            </ul>
                        </div><a href="#next" class="navi next"><img class="dynamic_btn" src="img/x.gif" alt="next" /></a>
                    </div>

                    <div id="newsbox">
                        <h2><?php

                               echo $lang['index'][0][14];

                        ?></h2>

                        <div class="news">
                            <p class="date">[Release by: TravianX]</p>

                            <p>Thank you for using our version!</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clear"></div>
        </div>

        <div class="container" id="footer">
            <ul class="menu">
                <li><?php

                       echo $lang['credits'];

                ?></li>
            </ul>
        </div>
    </div>

    <div id="login_layer" class="overlay">
        <div class="mask closer"></div>

        <div id="login_list" class="overlay_content">
            <h2>Choose your world</h2><a href="index.php" class="closer"><img class="dynamic_img" alt="Close" src="img/un/x.gif" /></a>

            <ul class="world_list">
                <li class="w_big c3">
                    <a href="http://tc2.travian.kr/login.php"><img class="w_button" src="img/un/x.gif" alt="kr2 ???" title="kr2 ???" /></a>

                    <div class="label_players c2">
                        ????:
                    </div>

                    <div class="label_online c2">
                        ???:
                    </div>

                    <div class="players">
                        470
                    </div>

                    <div class="online">
                        12
                    </div>
                </li>
            </ul>

            <div class="footer"></div>
        </div>
    </div>

    <div id="signup_layer" class="overlay">
        <div class="mask closer"></div>

        <div id="signup_list" class="overlay_content">
            <h2>Choose your world</h2><a href="index.php" class="closer"><img class="dynamic_img" alt="Close" src="img/un/x.gif" /></a>

            <ul class="world_list">
                <li class="w_big c4">
                    <a href="http://tc2.travian.kr/anmelden.php"><img class="w_button" src="img/un/x.gif" alt="kr2 ??" title="kr2 ??" /></a>

                    <div class="label_players c2">
                        ????:
                    </div>

                    <div class="label_online c2">
                        ???:
                    </div>

                    <div class="players">
                        470
                    </div>

                    <div class="online">
                        12
                    </div>
                </li>
            </ul>

            <div class="footer"></div>
        </div>
    </div>

    <div id="iframe_layer" class="overlay">
        <div class="mask closer"></div>

        <div class="overlay_content">
            <a href="index.php" class="closer"><img class="dynamic_img" alt="Close" src="img/un/x.gif" /></a>

            <h2>Anleitung</h2>

            <div id="frame_box"></div>

            <div class="footer"></div>
        </div>
    </div>

    <div id="screenshot_layer" class="overlay">
        <div class="mask closer"></div>

        <div class="overlay_content">
            <h3>Screenshots</h3><a href="index.php" class="closer"><img class="dynamic_img" alt="Close" src="img/x.gif" /></a>

            <div class="screenshot_view">
                <h4 id="screen_hl"></h4><img id="screen_view" src="img/x.gif" alt="Screenshot" name="screen_view" />

                <div id="screen_desc"></div>
            </div><a href="#prev" class="navi prev" onclick="galarie.showPrev();"><img class="dynamic_img" src="img/x.gif" alt="previous" /></a> <a href="#next" class="navi next" onclick="galarie.showNext();"><img class="dynamic_img" src="img/x.gif" alt="next" /></a>

            <div class="footer"></div>
        </div>
    </div><script type="text/javascript">
//<![CDATA[
    var screenshots = [ 
    {'img':'img/en/s/s1.png','hl':'Village centre', 'desc':'This is how your village will look before you start to expand to form your empire.'},{'img':'img/en/s/s2.png','hl':'Village overview', 'desc':'Lumber, clay, iron and crop is needed to supply your village with food, building material and troops.'},{'img':'img/en/s/s4.png','hl':'Surrounding territory', 'desc':'Explore the map to meet new friends or encounter new enemies. Look for nearby oases to gather more resources, but watch out for wild animals there.'},{'img':'img/en/s/s3.png','hl':'Building information', 'desc':'There are lots of buildings to be built in your villages. Choose wisely or ask the Taskmaster for his opinion.'},{'img':'img/en/s/s5.png','hl':'Battle report', 'desc':'Do not forget to build up your own army. You will need it to protect yourself and of course for attacks to gather resources from opposing players.'},{'img':'img/en/s/s7.png','hl':'Medals', 'desc':'Gain honourable medals in several categories. The top 10 players and alliances of each week will gain such an achievement.'},{'img':'img/en/s/s8.png','hl':'Tasks', 'desc':'Do not miss the Taskmaster. He will guide you through the first steps of Travian and will help you with free resources. Just click on the image on the right side of the screen to activate him.'}];
    var galarie = new Fx.Screenshots('screen_view', 'screen_hl', 'screen_desc', screenshots);

    //]]>
    </script>
</body>
</html>
