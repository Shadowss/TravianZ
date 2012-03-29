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
            
            if($hero_info['trainingtime'] <= time()) {
        		if($hero_info['trainingtime'] != 0) {
        			if($hero_info['dead'] == 0) {
        				mysql_query("UPDATE " . TB_PREFIX . "hero SET trainingtime = '0' WHERE uid = " . $session->uid . "");
                        mysql_query("UPDATE " . TB_PREFIX . "units SET hero = 1 WHERE vref = ".$village->wid."");
 			       }
        		}
        	}  
            
		if(isset($_GET['land'])) {
			include("37_land.tpl");
		} else {
		if(mysql_num_rows($hero) == 0){
            include("37_train.tpl");
        }
        if(mysql_num_rows($hero) != 0 AND $hero_info['trainingtime'] > time()){
            include("37_train2.tpl");
        }
        if(mysql_num_rows($hero) != 0 AND $hero_info['dead'] == 1){
            include("37_revive.tpl");
        }
        if(mysql_num_rows($hero) != 0 AND $hero_info['dead'] == 0 AND $hero_info['trainingtime'] <= time()){
            include("37_hero.tpl");
        }
        }
        include ("upgrade.tpl"); ?>
        
    </div>
