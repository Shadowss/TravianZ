<?php

/** --------------------------------------------------- **\
| ********* DO NOT REMOVE THIS COPYRIGHT NOTICE ********* |
+---------------------------------------------------------+
| Credits:     All the developers including the leaders:  |
|              Advocaite & Dzoki & Donnchadh              |
|                                                         |
| Copyright:   TravianX Project All rights reserved       |
\** --------------------------------------------------- **/

   $tribe1 = mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."users WHERE tribe = 1");
   $tribe2 = mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."users WHERE tribe = 2");
   $tribe3 = mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."users WHERE tribe = 3");
   $tribes = array(mysql_num_rows($tribe1), mysql_num_rows($tribe2), mysql_num_rows($tribe3));
   $users = mysql_num_rows(mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."users")) - 4; ?>

    <table cellpadding="1" cellspacing="1" id="world_player" class="world">
        <thead>
            <tr>
                <th colspan="2">Players</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>Registered players</th>

                <td><?php
                   echo $users; ?></td>
            </tr>

            <tr>
                <th>Active players</th>

                <td><?php
                   $active = mysql_num_rows(mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE ".time()."-timestamp < (3600*24)"));
                   echo $active; ?></td>
            </tr>

            <tr>
                <th>Players online</th>

                <td><?php
                   $online = mysql_num_rows(mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE ".time()."-timestamp < (60*5)"));
                   echo $online; ?></td>
            </tr>
        </tbody>
    </table>

    <table cellpadding="1" cellspacing="1" id="world_tribes" class="world">
        <thead>
            <tr>
                <th colspan="3">Tribes</th>
            </tr>

            <tr>
                <td>Tribe</td>

                <td>Registered</td>

                <td>Percent</td>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Romans</td>

                <td><?php
                   echo $tribes[0] - 2; ?></td>

                <td><?php
                   $percents = 100 * (($tribes[0]-2) / $users);
                   echo $percents = intval($percents);
                   echo "%"; ?></td>
            </tr>

            <tr>
                <td>Teutons</td>

                <td><?php
                   echo $tribes[1]; ?></td>

                <td><?php
                   $percents = 100 * ($tribes[1] / $users);
                   echo $percents = intval($percents);
                   echo "%"; ?></td>
            </tr>

            <tr>
                <td>Gauls</td>

                <td><?php
                   echo $tribes[2]; ?></td>

                <td><?php
                   $percents = 100 * ($tribes[2] / $users);
                   echo $percents = intval($percents);
                   echo "%"; ?></td>
            </tr>
        </tbody>
    </table>       
