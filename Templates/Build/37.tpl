<?php

/*-------------------------------------------------------*\
| ********* DO NOT REMOVE THIS COPYRIGHT NOTICE ********* |
+---------------------------------------------------------+
| Developed by:  Manni < manuel_mannhardt@web.de >        |
|                Dzoki < dzoki.travian@gmail.com >        |
| Copyright:     TravianX Project All rights reserved     |
\*-------------------------------------------------------*/

        $hero = mysql_query("SELECT * FROM " . TB_PREFIX . "hero WHERE `uid` = " . $session->uid . "");
        $hero_info = mysql_fetch_array($hero);
        
        $define['reset_level'] = 3; // Until which level you are able to reset your points
      
?>


 <div id="build" class="gid37">
        <a href="#" onclick="return Popup(37,4, 'gid');" class="build_logo"><img class="building g37" src="img/x.gif" alt="Hero's mansion" title="Hero's mansion"></a>

        <h1>Hero's mansion <span class="level">Level <?php echo $village->resarray['f' . $id]; ?></span></h1>

        <p class="build_desc">In the Hero's mansion you can train your own hero and at level 10, 15 and 20 you can conquer oases with Hero in the immediate vicinity.</p>

        
        <?php           
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
        $name1 = $hero_info['name'];

		if(isset($_GET['land'])) {
			include("37_land.tpl");
		} else {
		if(mysql_num_rows($hero) == 0){
            include("37_train.tpl");
        }elseif($hero_info['intraining'] == 1){
		$timeleft = $generator->getTimeFormat($hero_info['trainingtime'] - time());
		?>
	<table id="distribution" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
            <?php echo "<tr class='next'><th>Hero will be ready in <span id=timer1>" . $timeleft . "</span></th></tr>"; ?>
            </tr>
        </thead>
            
            <tr>
			<?php
				   echo "<tr>
                <td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u".$hero_info['unit']."\" src=\"img/x.gif\" alt=\"".$name."\" title=\"".$name."\" />
						$name ($name1)
					</div>"
			?>
			
            </tr>
    </table>
		<?php
		}
        if(mysql_num_rows($hero) != 0 AND $hero_info['dead'] == 1 AND $hero_info['intraining'] == 0){
            include("37_revive.tpl");
        }
        if(mysql_num_rows($hero) != 0 AND $hero_info['dead'] == 0 AND $hero_info['trainingtime'] <= time() AND $hero_info['inrevive'] == 0 AND $hero_info['intraining'] == 0){
            include("37_hero.tpl");
        }
        }
        include ("upgrade.tpl"); ?>
        
    </div>
