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
                    <td>NOT CODED</td>
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