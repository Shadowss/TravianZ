<?php

/*
|--------------------------------------------------------------------------
|   PLEASE DO NOT REMOVE THIS COPYRIGHT NOTICE!
|--------------------------------------------------------------------------  
|
|   Developed by:   Dzoki < dzoki.travian@gmail.com >
|  
|   This script is property of TravianX Project. You are allowed to change
|   its source and release it, but you have no rights to remove copyright
|   notices.
|
|   TravianX All rights reserved
|
*/


    if(isset($aid)) {
        $aid = $aid;
    } else {
        $aid = $session->alliance;
    }
    $allianceinfo = $database->getAlliance($aid);
    echo "<h1>".$allianceinfo['tag']." - ".$allianceinfo['name']."</h1>";
    include("alli_menu.tpl"); 
?>
    <form method="post" action="allianz.php">
        <input type="hidden" name="a" value="6"> <input type="hidden" name="o" value="6"> <input type="hidden" name="s" value="5">

        <table cellpadding="1" cellspacing="1" id="diplomacy" class="dipl">
            <thead>
                <tr>
                    <th colspan="2">Alliance diplomacy</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <th>Alliance</th>

                    <td><input class="ally text" type="text" name="a_name" maxlength="15"></td>
                </tr>

                <tr>
                    <td colspan="2" class="empty"></td>
                </tr>

                <tr>
                    <td colspan="2"><label><input class="radio" type="radio" name="dipl" value="1"> offer a confederation</label></td>
                </tr>

                <tr>
                    <td colspan="2"><label><input class="radio" type="radio" name="dipl" value="2"> offer non-aggression pact</label></td>
                </tr>

                <tr>
                    <td colspan="2"><label><input class="radio" type="radio" name="dipl" value="3"> declare war</label></td>
                </tr>
            </tbody>
        </table>

        <table cellpadding="1" cellspacing="1" id="hint" class="infos">
            <thead>
                <tr>
                    <th colspan="2">Hint</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td colspan="2">It's part of diplomatic etiquette to talk to another alliance and negotiate before sending an offer for a non-aggression pact or a confederation.</td>
                </tr>
            </tbody>
        </table>

        <div id="box">
            <p><input type="image" value="ok" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK"></p>

            <p class="error"></p>
        </div>
    </form>

    <div class="clear"></div>

    <table cellpadding="1" cellspacing="1" id="own" class="dipl">
        <thead>
            <tr>
                <th colspan="3">Own offers</th>
            </tr>
        </thead>

        <tbody>
        <tr>
        <?php 
        $alliance = $session->alliance;
        
        if(count($database->diplomacyOwnOffers($alliance))){
            foreach($database->diplomacyOwnOffers($alliance) as $key => $value){
                if($value['type'] == 1){
                    $type = "Conf.";
                } else if($value['type'] == 2){
                    $type = "Nap";
                } else if($value['type'] == 3){
                    $type = "War";
                }
                echo '<tr><td width="18"><form method="post" action="allianz.php"><input type="hidden" name="o" value="101"><input type="hidden" name="id" value="'.$value['id'].'"><input type="image" class="cancel" src="img/x.gif" title="Cancel" /></form></td><td><a href="allianz.php?aid='.$value['alli2'].'"><center>'.$database->getAllianceName($value['alli2']).'</a></center></td><td width="80"><center>'.$type.'</center></td></tr>';
            }   
        } else {
            echo '<tr><td colspan="3" class="none">none</td></tr>';
        }
        ?>
            </tr>
        </tbody>
    </table>

    <table cellpadding="1" cellspacing="1" id="tip" class="infos">
        <thead>
            <tr>
                <th colspan="2">Tip</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td colspan="2">If you want to see connections in the alliance description automatically, type <span class="e">[diplomatie]</span> into the description, <span class="e">[ally]</span>, <span class="e">[nap]</span> and <span class="e">[war]</span> are also possible.</td>
            </tr>
        </tbody>
    </table>

    <table cellpadding="1" cellspacing="1" id="foreign" class="dipl">
        <thead>
            <tr>
                <th colspan="4">Foreign offers</th>
            </tr>
        </thead>
       
        <tbody>
             <?php 
        unset($type);
        $alliance = $session->alliance;
        
        if(count($database->diplomacyInviteCheck($alliance))){
            foreach($database->diplomacyInviteCheck($alliance) as $key => $row){
                if($row['type'] == 1){
                    $type = "Conf.";
                } else if($row['type'] == 2){
                    $type = "Nap";
                } else if($row['type'] == 3){
                    $type = "War";
                }
                echo '<tr><td width="18"><form method="post" action="allianz.php"><input type="hidden" name="o" value="102"><input type="hidden" name="id" value="'.$row['id'].'"><input type="hidden" name="alli1" value="'.$row['alli1'].'"><input type="image" class="cancel" src="img/x.gif" title="Cancel" /></td></form><form method="post" action="allianz.php"><td width="18"><input type="hidden" name="o" value="103"><input type="hidden" name="id" value="'.$row['id'].'"><input type="hidden" name="alli2" value="'.$row['alli2'].'"><input type="hidden" name="type" value="'.$row['type'].'"><input type="image" class="accept" src="img/x.gif" title="Accept" /></td></form><td><a href="allianz.php?aid='.$row['alli1'].'"><center>'.$database->getAllianceName($row['alli1']).'</a></center></td><td width="80"><center>'.$type.'</center></td></tr>';
            }   
        } else {
            echo '<tr><td colspan="3" class="none">none</td></tr>';
        }
        ?>
        </tbody>
    </table>

    <table cellpadding="1" cellspacing="1" id="existing" class="dipl">
        <thead>
            <tr>
                <th colspan="3">Existing relationships</th>
            </tr>
        </thead>

        <tbody>
             <?php 
        unset($type);
        unset($row);
        $alliance = $session->alliance;
        
        if(count($database->diplomacyExistingRelationships($alliance))){
            foreach($database->diplomacyExistingRelationships($alliance) as $key => $row){
                if($row['type'] == 1){
                    $type = "Conf.";
                } else if($row['type'] == 2){
                    $type = "Nap";
                } else if($row['type'] == 3){
                    $type = "War";
                }
                echo '<tr><td width="18"><form method="post" action="allianz.php"><input type="hidden" name="o" value="104"><input type="hidden" name="id" value="'.$row['id'].'"><input type="hidden" name="alli2" value="'.$row['alli2'].'"><input type="image" class="cancel" src="img/x.gif" title="Cancel" /></form></td><td><a href="allianz.php?aid='.$row['alli1'].'"><center>'.$database->getAllianceName($row['alli1']).'</a></center></td><td width="80"><center>'.$type.'</center></td></tr>';
            }   
        } elseif(count($database->diplomacyExistingRelationships2($alliance))){
            foreach($database->diplomacyExistingRelationships2($alliance) as $key => $row){
                if($row['type'] == 1){
                    $type = "Conf.";
                } else if($row['type'] == 2){
                    $type = "Nap";
                } else if($row['type'] == 3){
                    $type = "War";
                }
                echo '<tr><td width="18"><form method="post" action="allianz.php"><input type="hidden" name="o" value="104"><input type="hidden" name="id" value="'.$row['id'].'"><input type="hidden" name="alli2" value="'.$row['alli1'].'"><input type="image" class="cancel" src="img/x.gif" title="Cancel" /></form></td><td><a href="allianz.php?aid='.$row['alli2'].'"><center>'.$database->getAllianceName($row['alli2']).'</a></center></td><td width="80"><center>'.$type.'</center></td></tr>';
            }   
        }else {
            echo '<tr><td colspan="3" class="none">none</td></tr>';
        }
        
        ?>
        </tbody>
    </table>