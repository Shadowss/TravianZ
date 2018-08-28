<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       01.09.2013 						       	 				   ##
##  Filename       overview.php                                                ##
##  Developed by:  Dzoki                                                       ##
##  Fixed by:      Shadow / Skype : cata7007                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/	       	   			   ##
##                                                                             ##
#################################################################################

$ranking->procRankReq($_GET);
$_GET['uid'] = preg_replace("/[^0-9]/","",$_GET['uid']);
$displayarray = $database->getUserArray($_GET['uid'],1);


$varmedal = $database->getProfileMedal($_GET['uid']);

$profiel="".$displayarray['desc1']."".md5('skJkev3')."".$displayarray['desc2']."";
require("medal.php");
$profiel=explode("".md5('skJkev3')."", $profiel);

$varray = $database->getProfileVillages($_GET['uid']);
$totalpop = 0;
foreach($varray as $vil) {
    $totalpop += $vil['pop'];
}
?>
<h1>Player profile</h1>

<?php
if($_GET['uid'] == $session->uid) {
if($session->sit == 0){
include("menu.tpl");
}else{
include("menu2.tpl");
}
}
?>
<table id="profile" cellpadding="1" cellspacing="1" >
    <thead>
    <tr>
        <th colspan="2">Player <?php echo $displayarray['username']; ?></th>
    </tr>
<?php 
if($displayarray['access'] == ADMIN) echo "<tr><th colspan='2'><font color='Red'><center><b>This player is Admin.</b></font></center></th></tr>";  
if($displayarray['access'] == MULTIHUNTER) echo "<tr><th colspan='2'><font color='Blue'><center><b>This player is Multihunter.</b></font></center></th></tr>";
if($displayarray['access'] == BANNED) echo "<tr><th colspan='2'><font color='Green'><center><b>This player is BANNED.</b></font></center></th></tr>";
if($displayarray['vac_mode'] == 1) echo "<tr><th colspan='2'><font color='Maroon'><center><b>This player is on VACATION.</b></font></center></th></tr>"; 
?>
    <tr>
        <td>Details</td>
        <td>Description</td>

    </tr>
    </thead><tbody>
    <tr>
        <td class="empty"></td><td class="empty"></td>
    </tr>
    <tr>
        <td class="details">
            <table cellpadding="0" cellspacing="0">
 
<?php if($displayarray['access'] == BANNED){ echo "<tr><td colspan='2'><center><b>Banned</b></center></td></tr>"; } ?>

			<tr>

                <th>Rank</th>
                <td><?php echo $ranking->getUserRank($displayarray['id']); ?></td>
            </tr>
            <tr>
                <th>Tribe</th>
                <td><?php 
                $tribeArrays = [TRIBE1, TRIBE2, TRIBE3, TRIBE4, TRIBE5];
                echo $tribeArrays[$displayarray['tribe'] - 1];
                ?></td>
            </tr>

            <tr>
                <th>Alliance</th>
                <td><?php
                if($displayarray['alliance'] == 0) echo "-";
                else 
                {
                $displayalliance = $database->getAllianceName($displayarray['alliance']);
                echo "<a href=\"allianz.php?aid=".$displayarray['alliance']."\">".$displayalliance."</a>";
                } ?></td>
            </tr>
            <tr>
                <th>Villages</th>
                <td><?php echo count($varray);?></td>

            </tr>
            <tr>
                <th>Population</th>
                <td><?php echo $totalpop; ?></td>
            </tr>
            <?php 
			//Date of Birth
            if(isset($displayarray['birthday']) && $displayarray['birthday'] != 0) {
			    $age = date('Y') - substr($displayarray['birthday'], 0, 4);
				if ((date('m') - substr($displayarray['birthday'], 5, 2)) < 0) $age --;
				elseif ((date('m') - substr($displayarray['birthday'], 5, 2)) == 0){
					if(date('d') < substr($displayarray['birthday'], 8, 2)) $age --;
				}
            echo "<tr><th>Age</th><td>$age</td></tr>";
            }
			//Gender
            if(isset($displayarray['gender']) && $displayarray['gender'] != 0) {
                $gender = ($displayarray['gender']== 1)? "Male" : "Female";
                echo "<tr><th>Gender</th><td>".$gender."</td></tr>";
            }
			//Location
            if($displayarray['location'] != "") {
                echo "<tr><th>Location</th><td>".$displayarray['location']."</td></tr>";
            }
            ?>
            <tr>
                <td colspan="2" class="empty"></td>
            </tr>
            <tr>
				<?php if(preg_replace("/[^0-9]/","",$_GET['uid']) == $session->uid) {
				if($session->sit == 0){
                echo "<td colspan=\"2\"> <a href=\"spieler.php?s=1\">&raquo; Change profile</a></td>";
				}else{
                echo "<td colspan=\"2\"> <span class=none><b>&raquo; Change profile</b></span></td>";
				}
                } else {
             echo "<td colspan=\"2\"> <a href=\"nachrichten.php?t=1&amp;id=".$_GET['uid']."\">&raquo; Write message</a></td>";
			 }
                ?>                
            </tr>
			<!--<tr><td colspan="2"><a href="nachrichten.php?t=1&id=0"><font color="Red">&raquo; Report Player</font></a></td></tr>-->
            <tr>
							<td colspan="2" class="desc2">
								<div class="desc2div"><?php echo nl2br($profiel[0]); ?></div>
							</td>
						</tr>
            </table>

        </td>
        <td class="desc1" >
            <div class="desc1div"><?php echo nl2br($profiel[1]); ?>
            
            </div>
        </td>
    </tr>
    </tbody>
</table>

<table cellpadding="1" cellspacing="1" id="villages">
<thead>
	 <tr>
		<th colspan="<?php echo NEW_FUNCTIONS_OASIS ? 4 : 3; ?>">Villages</th>
     </tr>
     <tr>
    	<td>Name</td>
    	<?php if(NEW_FUNCTIONS_OASIS){ ?> 	
    	<td>Oasis</td>
    	<?php } ?>	
    	<td>Inhabitants</td>
    	<td>Coordinates</td>	
	</tr>
</thead>
<tbody>
<?php 
        foreach($varray as $vil) {
            $hasArtifact = $database->villageHasArtefact($vil['wref']);
            $coor = $database->getCoor($vil['wref']);
            echo "<tr><td class=\"nam\"><a href=\"karte.php?d=".$vil['wref']."&amp;c=".$generator->getMapCheck($vil['wref'])."\">".$vil['name']."</a>";
            if($vil['capital'] == 1) echo "<span class=\"none3\"> (Capital)</span>";
            if(NEW_FUNCTIONS_DISPLAY_ARTIFACT){
                if($hasArtifact) echo "<span class=\"none3\"> (Artifact)</span>";
            }
			if(NEW_FUNCTIONS_DISPLAY_WONDER){
				if($vil['natar'] == 1) echo "<span class=\"none3\"> (WoW)</span>";
			}
            
            if(NEW_FUNCTIONS_OASIS){
                echo "<td class=\"hab\">";
                $oases = $database->getOasis($vil['wref']);
                foreach ($oases as $oasis) {
                    switch ($oasis['type']) {
                        case 1:
                        case 2:
                            echo "<img class='r100' src='img/x.gif' title='+25% Lumber'> ";
                            break;
                        case 3:
                            echo "<img class='r200' src='img/x.gif' title='+25% Lumber +25% Crop'> ";
                            break;
                        case 4:
                        case 5:
                            echo "<img class='r400' src='img/x.gif' title='+25% Clay'> ";
                            break;
                        case 6:
                            echo "<img class='r500' src='img/x.gif' title='+25% Clay +25% Crop'> ";
                            break;
                        case 7:
                        case 8:
                            echo "<img class='r700' src='img/x.gif' title='+25% Iron'> ";
                            break;
                        case 9:
                            echo "<img class='r800' src='img/x.gif' title='+25% Iron +25% Crop'> ";
                            break;
                        case 10:
                        case 11:
                            echo "<img class='r1000' src='img/x.gif' title='+25% Crop'> ";
                            break;
                        case 12:
                            echo "<img class='r1100' src='img/x.gif' title='+50% Crop'> ";
                            break;
                    }
                }
                echo "</td>";
            }      
            echo "<td class=\"hab\">".$vil['pop']."</td><td class=\"aligned_coords\">";
            echo "<div class=\"cox\">(".$coor['x']."</div><div class=\"pi\">|</div><div class=\"coy\">".$coor['y'].")</div></td></tr>";
        }
        echo "</tbody></table>";
?>
