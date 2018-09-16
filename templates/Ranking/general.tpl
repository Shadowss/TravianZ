<?php

/** --------------------------------------------------- **\
| ********* DO NOT REMOVE THIS COPYRIGHT NOTICE ********* |
+---------------------------------------------------------+
| Credits:     All the developers including the leaders:  |
|              Advocaite & Dzoki & Donnchadh              |
|                                                         |
| Copyright:   TravianX Project All rights reserved       |
\** --------------------------------------------------- **/

   $tribe1 = mysqli_fetch_array(mysqli_query($database->dblink,"SELECT Count(*) as Total FROM ".TB_PREFIX."users WHERE tribe = 1"), MYSQLI_ASSOC);
   $tribe2 = mysqli_fetch_array(mysqli_query($database->dblink,"SELECT Count(*) as Total FROM ".TB_PREFIX."users WHERE tribe = 2"), MYSQLI_ASSOC);
   $tribe3 = mysqli_fetch_array(mysqli_query($database->dblink,"SELECT Count(*) as Total FROM ".TB_PREFIX."users WHERE tribe = 3"), MYSQLI_ASSOC);
   $tribes = [$tribe1['Total'], $tribe2['Total'], $tribe3['Total']];
   $users = mysqli_fetch_array(mysqli_query($database->dblink,"SELECT Count(*) as Total FROM " . TB_PREFIX . "users WHERE tribe > 0 AND tribe < 4"), MYSQLI_ASSOC);
   $users = $users['Total'];
?>

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
                   $active = mysqli_num_rows(mysqli_query($database->dblink,"SELECT * FROM ".TB_PREFIX."users WHERE timestamp > ".(time() - (3600*24))." AND tribe!=0 AND tribe!=4 AND tribe!=5"));
                   echo $active; ?></td>
            </tr>

            <tr>
                <th>Players online</th>

                <td><?php
                    $online = mysqli_query($database->dblink,"SELECT Count(*) as Total FROM ".TB_PREFIX."users WHERE timestamp > ".(time() - (60*10))." AND tribe!=0 AND tribe!=4 AND tribe!=5");
                    if (!empty($online)) {
                   		echo mysqli_fetch_assoc($online)['Total'];
                   	} else {
                   		echo 0;
                   	}
                   ?></td>
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

                <td><?php echo $tribes[0]; ?></td>
				<td><?php echo ($users > 0) ? ($percents[0] = round(100 * ($tribes[0] / $users), 2))."%" : '---'; ?></td>
            </tr>
            <tr>
                <td>Teutons</td>

                <td><?php echo $tribes[1]; ?></td>
				<td><?php echo ($users > 0) ? ($percents[1] = round(100 * ($tribes[1] / $users), 2))."%" : "---"; ?></td>
            </tr>
            <tr>
                <td>Gauls</td>
                <td><?php echo $tribes[2]; ?></td>
                <td><?php echo ($users > 0) ? (100-$percents[0]-$percents[1])."%" : '---'; ?></td>
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
