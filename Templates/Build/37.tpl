<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : HEROSMANSION			                                   ##
##  Type           : BUILDING TEMPLATE                                         ##
## --------------------------------------------------------------------------- ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  Test Server    : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

        $hero_info = $units->Hero($session->uid);
        $heroes = $units->Hero($session->uid, 1);
        $define['reset_level'] = 3; // Until which level you are able to reset your points
		// NOTE: $define['reset_level'] doesn't seem to be used in any of the
		// 37*.tpl files - the "3" threshold is hardcoded directly into 37_hero.tpl. Possible dead code
		// in these files; I left it unchanged (it can be read
		// in another part of the project that I don't see here).

		// Explicit lookup instead of if/elseif chain - covers all 15
		// possible hero types (5 per tribe x 3 tribes). Same behavior:
		// if $hero_info['unit'] doesn't match any (which shouldn't
		// happen), $name returns null instead of "undefined variable".
        $heroUnitNames = [
            1  => U1,
            2  => U2,
            3  => U3,
            5  => U5,
            6  => U6,
            11 => U11,
            12 => U12,
            13 => U13,
            15 => U15,
            16 => U16,
            21 => U21,
            22 => U22,
            24 => U24,
            25 => U25,
            26 => U26,
        ];
      
?>


 <div id="build" class="gid37">
        <a href="#" onclick="return Popup(37,4, 'gid');" class="build_logo"><img class="building g37" src="img/x.gif" alt="<?php echo HEROSMANSION; ?>" title="<?php echo HEROSMANSION; ?>"></a>

        <h1><?php echo HEROSMANSION; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f' . $id]; ?></span></h1>

        <p class="build_desc"><?php echo HEROSMANSION_DESC; ?></p>

        
        <?php
        if ($hero_info) {
            $name  = $heroUnitNames[$hero_info['unit']] ?? null;
            $name1 = $hero_info['name'];
        } else {
            $name = 'Mr. Nobody';
            $name1 = 'unknown';
        }

		if(isset($_GET['land']) && $village->resarray['f' . $id] >= 1) {
            include_once("37_land.tpl");
		} else if ($village->resarray['f' . $id] >= 1) {
            $include_training = true;
            $include_revive = false;
            if (isset($heroes) && is_array($heroes) && count($heroes)) {
                foreach ( $heroes as $hdata ) {
                    if ( $hdata['dead'] == 1 ) {
                        $include_revive = true;
                    }

                    if ( $hdata['inrevive'] == 1 ) {
                        $name1            = $hdata['name'];
                        $include_training = false;
                    }
                }
            }

            if($hero_info === false && $include_revive){
                include_once("37_revive.tpl");
            }

            if ($hero_info === false && $include_training) {
                include_once("37_train.tpl");
            } else if($hero_info['intraining'] == 1) {

		    $timeleft = $generator->getTimeFormat($hero_info['trainingtime'] - time());
		?>
	<table id="distribution" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
            <?php echo "<tr class='next'><th>".HERO_READY."<span id=timer".++$session->timer.">" . $timeleft . "</span></th></tr>"; ?>
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

        if($hero_info !== false AND $hero_info['dead'] == 0 AND $hero_info['trainingtime'] <= time() AND $hero_info['inrevive'] == 0 AND $hero_info['intraining'] == 0){
            include("37_hero.tpl");
        }
        }
        include ("upgrade.tpl"); ?>
        
    </div>
