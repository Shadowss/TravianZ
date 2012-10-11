<?php

/** --------------------------------------------------- **\
| ********* DO NOT REMOVE THIS COPYRIGHT NOTICE ********* |
+---------------------------------------------------------+
| Credits:     All the developers including the leaders:  |
|              Advocaite & Dzoki & Donnchadh              |
|                                                         |
| Copyright:   TravianX Project All rights reserved       |
\** --------------------------------------------------- **/

   $tribe1 = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE tribe = 1");
   $tribe2 = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE tribe = 2");
   $tribe3 = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE tribe = 3");
   $tribes = array(mysql_num_rows($tribe1), mysql_num_rows($tribe2), mysql_num_rows($tribe3));
   $users = mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "users WHERE tribe!=0 AND tribe!=4 AND tribe!=5")); ?>

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
                   $active = mysql_num_rows(mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE ".time()."-timestamp < (3600*24) AND tribe!=0 AND tribe!=4 AND tribe!=5"));
                   echo $active; ?></td>
            </tr>

            <tr>
                <th>Players online</th>

                <td><?php
                   $online = mysql_num_rows(mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE ".time()."-timestamp < (60*10) AND tribe!=0 AND tribe!=4 AND tribe!=5"));
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
                   echo $tribes[0]; ?></td>

                <td><?php
                   $percents = 100 * (($tribes[0]) / $users);
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
	
    <table cellpadding="1" cellspacing="1" id="world_tribes" class="world">
        <thead>
            <tr>
                <th colspan="3">Miscellaneous</th>
            </tr>

            <tr>
                <td>Attacks</td>

                <td>Casualties</td>

                <td>Date</td>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td><?php echo $database->getAttackByDate(time()); ?></td>

                <td><?php echo $database->getAttackCasualties(time()); ?></td>

                <td><?php echo date("j. M"); ?></td>
            </tr>
			
            <tr>
                <td><?php echo $database->getAttackByDate(time()-(86400*1)); ?></td>

                <td><?php echo $database->getAttackCasualties(time()-(86400*1)); ?></td>

                <td><?php echo date("j. M",time()-(86400*1)); ?></td>
            </tr>

            <tr>
                <td><?php echo $database->getAttackByDate(time()-(86400*2)); ?></td>

                <td><?php echo $database->getAttackCasualties(time()-(86400*2)); ?></td>

                <td><?php echo date("j. M",time()-(86400*2)); ?></td>
            </tr>

            <tr>
                <td><?php echo $database->getAttackByDate(time()-(86400*3)); ?></td>

                <td><?php echo $database->getAttackCasualties(time()-(86400*3)); ?></td>

                <td><?php echo date("j. M",time()-(86400*3)); ?></td>
            </tr>
            <tr>
                <td><?php echo $database->getAttackByDate(time()-(86400*4)); ?></td>

                <td><?php echo $database->getAttackCasualties(time()-(86400*4)); ?></td>

                <td><?php echo date("j. M",time()-(86400*4)); ?></td>
            </tr>

            <tr>
                <td><?php echo $database->getAttackByDate(time()-(86400*5)); ?></td>

                <td><?php echo $database->getAttackCasualties(time()-(86400*5)); ?></td>

                <td><?php echo date("j. M",time()-(86400*5)); ?></td>
            </tr>

            <tr>
                <td><?php echo $database->getAttackByDate(time()-(86400*6)); ?></td>

                <td><?php echo $database->getAttackCasualties(time()-(86400*6)); ?></td>

                <td><?php echo date("j. M",time()-(86400*6)); ?></td>
            </tr>
        </tbody>
    </table>
	<?php  ?>
	
<table cellpadding="1" cellspacing="1" id="search_navi"> <?php //fix the problem with footer.php, don't change or remove it ?>
