<?php
 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       general    .tpl                                             ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2011. All rights reserved.                ##
##  Enhanced:      saulyzas                                                    ##
#################################################################################
 
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
                <th colspan="2">World Stats</th>
            </tr>
            <tr>
                <td>Total Villages</td>
                
                <td>Total Population</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                
                <td>
<?php
$result2 = mysqli_query($database->dblink,"SELECT * FROM ".TB_PREFIX."vdata");
$num_rows2 = mysqli_num_rows($result2);
echo $num_rows2;
?></td>
                <td>
<?php
$pop = mysqli_query($database->dblink,"SELECT SUM(pop) AS sumofpop FROM ".TB_PREFIX."vdata"); 
$getpop = mysqli_fetch_assoc($pop); 
echo $getpop['sumofpop'];
?></td>
</tr>
</tbody>
</table>
<br />
 
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
                <th colspan="3">Total <?php echo SERVER_NAME ?> <img src="./<?php echo GP_LOCATE; ?>img/a/gold.gif" alt="Gold" title="Gold"> Gold</th> 
            </tr> 
            <tr> 
                <td></td> 
                <td>Total</td> 
                
            </tr> 
        </thead> 
        <tbody>
            <tr>
                <td><img src="./<?php echo GP_LOCATE; ?>img/a/gold.gif" alt="Gold" title="Gold"> Gold</td>
                <td><?php $gold = mysqli_query($GLOBALS["link"], "SELECT SUM(gold) AS sumofgold FROM ".TB_PREFIX."users"); $getgold=mysqli_fetch_assoc($gold); echo $getgold['sumofgold']; ?></td>
                
            </tr>
        </tbody>
    </table> 
        <table cellpadding="1" cellspacing="1" id="world_player" class="world">
        <thead>
            <tr>
                <th colspan="6">Troops</th>
            </tr>
            <tr>
                <td><img src='img/romenai.png'></td>
                <td>Total</td>
                <td><img src='img/germanai.png'></td>
                <td>Total</td>
                <td><img src='img/galai.png'></td>
                <td>Total</td>
            </tr>
        </thead>
        <tbody>
 
 
            <tr>
                <td><img src="img/x.gif" class="unit u1"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u1) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                   <td><img src="img/x.gif" class="unit u11"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u11) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                <td><img src="img/x.gif" class="unit u21"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u21) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
            </tr>
 
            <tr>
                <td><img src="img/x.gif" class="unit u2"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u2) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                   <td><img src="img/x.gif" class="unit u12"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u12) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                <td><img src="img/x.gif" class="unit u22"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u22) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
            </tr>
 
            <tr>
                <td><img src="img/x.gif" class="unit u3"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u3) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                   <td><img src="img/x.gif" class="unit u13"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u13) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                <td><img src="img/x.gif" class="unit u23"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u23) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
            </tr>
 
            <tr>
                <td><img src="img/x.gif" class="unit u4"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u4) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                   <td><img src="img/x.gif" class="unit u14"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u14) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                <td><img src="img/x.gif" class="unit u24"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u24) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
            </tr>
 
            <tr>
                <td><img src="img/x.gif" class="unit u5"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u5) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                   <td><img src="img/x.gif" class="unit u15"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u15) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                <td><img src="img/x.gif" class="unit u25"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u25) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
            </tr>
 
            <tr>
                <td><img src="img/x.gif" class="unit u6"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u6) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                   <td><img src="img/x.gif" class="unit u16"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u16) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                <td><img src="img/x.gif" class="unit u26"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u26) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
            </tr>
 
            <tr>
                <td><img src="img/x.gif" class="unit u7"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u7) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                   <td><img src="img/x.gif" class="unit u17"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u17) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                <td><img src="img/x.gif" class="unit u27"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u27) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
            </tr>
 
            <tr>
                <td><img src="img/x.gif" class="unit u8"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u8) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                   <td><img src="img/x.gif" class="unit u18"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u18) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                <td><img src="img/x.gif" class="unit u28"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u28) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
            </tr>
 
            <tr>
                <td><img src="img/x.gif" class="unit u9"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u9) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                   <td><img src="img/x.gif" class="unit u19"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u19) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                <td><img src="img/x.gif" class="unit u29"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u29) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
            </tr>
 
            <tr>
                <td><img src="img/x.gif" class="unit u10"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u10) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                   <td><img src="img/x.gif" class="unit u20"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u20) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
                <td><img src="img/x.gif" class="unit u30"></td>
                <td>
                   <?php
                   $orat = mysqli_query($database->dblink,"SELECT SUM(u30) AS sumofrats FROM ".TB_PREFIX."units"); 
           $getorat = mysqli_fetch_assoc($orat); 
           echo $getorat['sumofrats'];
           ?></td>
           
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
