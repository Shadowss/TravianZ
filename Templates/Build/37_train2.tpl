<?php

/*-------------------------------------------------------*\
| ********* DO NOT REMOVE THIS COPYRIGHT NOTICE ********* |
+---------------------------------------------------------+
| Developed by:  Manni < manuel_mannhardt@web.de >        |
|                Dzoki < dzoki.travian@gmail.com >        |
| Copyright:     TravianX Project All rights reserved     |
\*-------------------------------------------------------*/

    if($hero_info['unit'] == 1) {
        	$name = "Legionnaire";
        } else if($hero_info['unit'] == 2) {
        	$name = "Praetorian";
        } else if($hero_info['unit'] == 3) {
        	$name = "Imperian";
        } else if($hero_info['unit'] == 5) {
        	$name = "Equites Imperatoris";
        } else if($hero_info['unit'] == 6) {
        	$name = "Equites Caesaris";
        } else if($hero_info['unit'] == 11) {
        	$name = "Clubswinger";
        } else if($hero_info['unit'] == 12) {
        	$name = "Spearman";
        } else if($hero_info['unit'] == 13) {
        	$name = "Axeman";
        } else if($hero_info['unit'] == 15) {
        	$name = "Paladin";
        } else if($hero_info['unit'] == 16) {
        	$name = "Teutonic Knight";
        } else if($hero_info['unit'] == 21) {
        	$name = "Phalanx";
        } else if($hero_info['unit'] == 22) {
        	$name = "Swordsman";
        } else if($hero_info['unit'] == 24) {
        	$name = "Theutates Thunder";
        } else if($hero_info['unit'] == 25) {
        	$name = "Druidrider";
        } else if($hero_info['unit'] == 26) {
        	$name = "Haeduan";
        }
        
        if($hero_info['trainingtime'] <= time()) {
        		if($hero_info['trainingtime'] != 0) {
        			if($hero_info['dead'] == 0) {
        				mysql_query("UPDATE " . TB_PREFIX . "hero SET trainingtime = '0', dead = '0' WHERE uid = " . $session->uid . "");
                        mysql_query("UPDATE " . TB_PREFIX . "units SET hero = 1 WHERE vref = ".$village->wid."");
 			       }
        		}
        	} 


        	if($hero_info['trainingtime'] > time()) {
        		$timeleft = $generator->getTimeFormat($hero_info['trainingtime'] - time());
                
?>
    <table id="distribution" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
            <?php echo "<tr class='next'><th>Hero will be ready in <span id=timer1>" . $timeleft . "</span></th></tr>"; ?>
            </tr>
        </thead>
            
            <tr>
                <td><img class="u<?php echo $hero_info['unit']; ?>" src="img/x.gif" /> <?php echo $name . " (<b>" . $hero_info['name'] . "</b>) "; ?></td>
            </tr>
    </table>


<?php } ?>