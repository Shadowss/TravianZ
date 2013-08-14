<?php

    $artefact = $database->getArtefactDetails($_GET['show']);
                    if($artefact['size'] == 1 && $artefact['type'] != 11){
                       $reqlvl = 10;
                       $effect = "village";
                   }else{
					   if($artefact['type'] != 11){
                       $reqlvl = 20;
					   }else{
					   $reqlvl = 10;
					   }
                       $effect = "account";
                   }
                   if ($artefact['conquered'] >= (time()-86400)){
                   $active = "Inactive";
                   }else{
                    $active = "Active";
                   }
                   //// Added by brainiac - thank you
                    if ($artefact['type'] == 8){$kind=$artefact['kind']; $effecty=$artefact['effect2'];}else{$kind=$artefact['type']; $effecty=$artefact['effect'];}
                    	 switch($kind){
                    	 case 1:
                    	 if($artefact['type'] == 8 && $artefact['bad_effect']==1){$betterorbadder="building weaker with";}else{$betterorbadder="building stronger with";}
                    	 break;
                    	 case 2:
                    	 if($artefact['type'] == 8 && $artefact['bad_effect']==1){$betterorbadder="makes troops slowest with";}else{$betterorbadder="makes troops faster with";}
                    	 break;
                    	 case 3:
                    	 if($artefact['type'] == 8 && $artefact['bad_effect']==1){$betterorbadder="spies decrese ability with";}else{$betterorbadder="spies increase ability with";}
                    	 break;
                    	 case 4:
                    	 if($artefact['type'] == 8 && $artefact['bad_effect']==1){$betterorbadder="all troops consume high with";}else{$betterorbadder="all troops consume less with";}
                    	 break;
                    	 case 5:
                    	 if($artefact['type'] == 8 && $artefact['bad_effect']==1){$betterorbadder="troops make slowest with";}else{$betterorbadder="troops make faster with";}
                    	 break;
                    	 case 6:
                    	 if($artefact['type'] == 8 && $artefact['bad_effect']==1){$betterorbadder="you can construct ";}else{$betterorbadder="you can construct ";}
                    	 break;
                    	 case 7:
                    	 if($artefact['type'] == 8 && $artefact['bad_effect']==1){$betterorbadder="cranny capacity is decrese by";}else{$betterorbadder="cranny capacity is increased by";}
                    	 break;
                    	 case 8:
                    	 if($artefact['type'] == 8 && $artefact['bad_effect']==1){$betterorbadder="spies increase ability with";}else{$betterorbadder="spies decrease ability with";}

                    	 break;

                 }

                   $bonus=$betterorbadder." ".$effecty."";
?>

       <div class="artefact image-6">
            <table id="art_details" cellpadding="1" cellspacing="1">
                <thead>
                    <tr>
                        <th colspan="2"><?php echo $artefact['name'];?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" class="desc">

                            <span class="detail"><?php echo $artefact['desc'];?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>Owner</th>
                        <td>
                            <a href="spieler.php?uid=<?php echo $artefact['owner'];?>"><?php echo $database->getUserField($artefact['owner'],"username",0);?></a>
                        </td>
                    </tr>
                    <tr>
                        <th>Village</th>
                        <td>
                            <a href="karte.php?d=<?php echo $artefact['vref'];?>&c=<?php echo $generator->getMapCheck($artefact['vref']);?>"><?php echo $database->getVillageField($artefact['vref'], "name");?> </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Alliance</th>
                        <td><a href="allianz.php?aid=<?php echo $database->getUserField($artefact['owner'],"alliance",0);?>"><?php echo $database->getAllianceName($database->getUserField($artefact['owner'],"alliance",0)); ?></a></td>
                    </tr>
                    <tr>
                        <th>Area of effect</th>
                        <td><?php echo $effect; ?></td>
                    </tr>

                <tr>
                    <th>Bonus</th>
                    <td><?php echo $bonus; ?></td>
                </tr>

            <tr>
                <th>Required level</th>
                <td>Treasury level <b><?php echo $reqlvl; ?></b></td>
            </tr>

                <tr>
                    <th>Time of conquer</th>
                    <td><?php echo date("Y-m-d H:i:s",$artefact['conquered']);?></td>
                </tr>

                <tr>
                    <th>time of activation</th>
                    <td><?php echo $active;?></td>
                </tr>
            </tbody></table>
                <table class="art_details" cellpadding="1" cellspacing="1">
                    <thead>
                        <tr>
                            <th colspan="3">Former owner(s)</th>
                        </tr>
					<tr>
                            <td>Player</td>
                            <td>Village</td>
                            <td>conquered</td>
                        </tr>
                    </thead>
                    <tbody>

					<tr>
                        <td><span class="none"><a href="spieler.php?uid=<?php echo $artefact['owner'];?>"><?php echo $database->getUserField($artefact['owner'],"username",0);?></a></span></td>
                        <td><span class="none"><a href="karte.php?d=<?php echo $artefact['vref'];?>&c=<?php echo $generator->getMapCheck($artefact['vref']);?>"><?php echo $database->getVillageField($artefact['vref'], "name");?> </a></span></td>
                        <td><span class="none"><?php echo date("Y-m-d H:i:s",$artefact['conquered']);?></span></td>

                    </tr>

                    </tr></tbody></table></div>
