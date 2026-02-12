<?php
$ckey = $generator->generateRandStr(6);

 if (!isset($process['t1']) || $process['t1'] == ''){  $t1 = 0; }else{  $t1 = $process['t1']; }
 if (!isset($process['t2']) || $process['t2'] == ''){  $t2 = 0; }else{  $t2 = $process['t2']; }
 if (!isset($process['t3']) || $process['t3'] == ''){  $t3 = 0; }else{  $t3 = $process['t3']; if ($session->tribe == 3) $scout=1; }
 if (!isset($process['t4']) || $process['t4'] == ''){  $t4 = 0; }else{  $t4 = $process['t4']; if ($session->tribe == 1 || $session->tribe == 2 || $session->tribe == 4 || $session->tribe == 5) $scout=1; }
 if (!isset($process['t5']) || $process['t5'] == ''){  $t5 = 0; }else{  $t5 = $process['t5']; }
 if (!isset($process['t6']) || $process['t6'] == ''){  $t6 = 0; }else{  $t6 = $process['t6']; }
 if (!isset($process['t7']) || $process['t7'] == ''){  $t7 = 0; }else{  $t7 = $process['t7']; }
 if (!isset($process['t8']) || $process['t8'] == ''){  $t8 = 0; }else{  $t8 = $process['t8']; }
 if (!isset($process['t9']) || $process['t9'] == ''){  $t9 = 0; }else{  $t9 = $process['t9']; }
 if (!isset($process['t10']) || $process['t10'] == ''){  $t10 = 0; }else{  $t10 = $process['t10']; }
 if (!isset($process['t11']) || $process['t11'] == ''){  $t11 = 0; }else{  $t11 = $process['t11']; $showhero=1; }
 

for($i = 1; $i <= 11; $i++){
    $totalunits += (($i != 3 && $session->tribe == 3) ||
                    ($i != 4 && $session->tribe != 3)) ? (!empty($process['t'.$i]) ? $process['t'.$i] : 0) : 0;
}
 
if (isset($scout) && $scout == 1 && isset($totalunits) && $totalunits == 0 && $process['c'] != 2) {
    $process['c'] = 1;
}
$id = $database->addA2b($ckey, time(), $process['0'], $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11, $process['c']);

$actionType = (["Scout", "Reinforcement", "Normal attack", "Raid"])[$process['c'] - 1];

$uid = $session->uid;
$tribe = $session->tribe;
$start = ($tribe - 1) * 10 + 1;
$end = $tribe * 10;
?>

<h1><?php echo $actionType." to ".$process[1]; ?></h1>
<form method="post" action="a2b.php">

            <table id="short_info" cellpadding="1" cellspacing="1">

                <tbody>

                    <tr>

                        <th>Destination:</th>

                        <td><a href="karte.php?d=<?php echo $process[0]; ?>&c=<?php echo $generator->getMapCheck($process[0]); ?>"><?php echo $process[1]; ?> (<?php echo $coor['x']; ?>|<?php echo $coor['y']; ?>)</a></td>

                    </tr>

                    <tr>

                        <th>Owner:</th>

                        <td><a href="spieler.php?uid=<?php echo $process['2']; ?>"><?php echo $database->getUserField($process['2'],'username',0); ?></a></td>

                    </tr>

                </tbody>

            </table>



            <table class="troop_details" cellpadding="1" cellspacing="1">

                <thead>

                    <tr>

                        <td><?php echo $process[1]; ?></td>

                        <td colspan="<?php if(!empty($process['t11'])){ echo"11"; }else{ echo"10"; } ?>"><?php echo $actionType." to ".$process['1']; ?></td>

                    </tr>

                </thead>

                <tbody class="units">

                    <tr>

                        <td></td>
                 <?php
                for($i=$start;$i<=($end);$i++) {
                      echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
                  } if (!empty($process['t11'])){
                  echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";

                  }?>

                    </tr>

                    <tr>

                        <th>Troops</th>

                        <td <?php if (!isset($process['t1']) || $process['t1'] == ''){ echo "class=\"none\">0"; }else{ echo ">".$process['t1'];} ?></td>

                        <td <?php if (!isset($process['t2']) || $process['t2'] == ''){ echo "class=\"none\">0"; }else{ echo ">".$process['t2'];} ?></td>

                        <td <?php if (!isset($process['t3']) || $process['t3'] == ''){ echo "class=\"none\">0"; }else{ echo ">".$process['t3'];} ?></td>

                        <td <?php if (!isset($process['t4']) || $process['t4'] == ''){ echo "class=\"none\">0"; }else{ echo ">".$process['t4'];} ?></td>

                        <td <?php if (!isset($process['t5']) || $process['t5'] == ''){ echo "class=\"none\">0"; }else{ echo ">".$process['t5'];} ?></td>

                        <td <?php if (!isset($process['t6']) || $process['t6'] == ''){ echo "class=\"none\">0"; }else{ echo ">".$process['t6'];} ?></td>

                        <td <?php if (!isset($process['t7']) || $process['t7'] == ''){ echo "class=\"none\">0"; }else{ echo ">".$process['t7'];} ?></td>

                        <td <?php if (!isset($process['t8']) || $process['t8'] == ''){ echo "class=\"none\">0"; }else{ $kata='1'; echo ">".$process['t8'];} ?></td>

                        <td <?php if (!isset($process['t9']) || $process['t9'] == ''){ echo "class=\"none\">0"; }else{ echo ">".$process['t9'];} ?></td>

                        <td <?php if (!isset($process['t10']) || $process['t10'] == ''){ echo "class=\"none\">0"; }else{ echo ">".$process['t10'];} ?></td>

                        <?php if (!isset($process['t11']) || $process['t11'] == ''){ echo ""; }else{ echo "<td>".$process['t11']."</td>";} ?>

                     </tr>

                </tbody>
                                         <?php                if ($process['c']==1){

?>
                <tbody class="options">
        <tr>
            <th>Options</th>
            <td colspan="<?php if(!empty($process['t11'])){ echo"11"; }else{ echo"10"; } ?>"><input class="radio" name="spy" value="1" checked="checked" type="radio">Scout resources and troops<br>
            <input class="radio" name="spy" value="2" type="radio">Scout defences and troops                                            </td>
        </tr>
    </tbody>
    <?php } ?>


        <?php if(isset($kata) && $process['c'] != 2){?><tr>

            <?php if($process['c']== 3){ ?><tbody class="cata">
                <tr>
                    <th>Destination:</th>
                    <td colspan="<?php echo !empty($process['t11']) ? 11 : 10; ?>">

                        <select name="ctar1" class="dropdown">
                            <option value="0">Random</option>
                            <?php if($building->getTypeLevel(16) >= 5) { ?>
                <optgroup label="Resources">
                <option value="1">Woodcutter</option>
                                <option value="2">Clay Pit</option>
                                <option value="3">Iron Mine</option>
                                <option value="4">Cropland</option>
                                <option value="5">Sawmill</option>
                                <option value="6">Brickyard</option>

                                <option value="7">Iron Foundry</option>
                                <option value="8">Grain Mill</option>
                                <option value="9">Bakery</option>
                            </optgroup>
                            <?php } ?>
                            <?php if($building->getTypeLevel(16) >= 3) { ?>
                            <optgroup label="Infrastructure">
                                <option value="10">Warehouse</option>
                                <option value="11">Granary</option>
                                <?php if($building->getTypeLevel(16) >= 10) { ?>
                                <option value="15">Main building</option>
                                <option value="17">Marketplace</option>
                                <option value="18">Embassy</option>
                                <option value="24">Townhall</option>
                                <option value="25">Residence</option>
                                <option value="26">Palace</option>
                                <option value="27">Treasury</option>
                                <option value="28">Trade office</option>
                                <option value="35">Brewery</option>
                                <?php } ?>
                                <option value="38">Great warehouse</option>
                                <option value="39">Great granary</option>
                                <option value="40">Wonder of the World</option>
                            </optgroup>
                            <?php } ?>
                            <?php if($building->getTypeLevel(16) >= 10) { ?>
                            <optgroup label="Military">
                                <option value="12">Blacksmith</option>
                                <option value="13">Armoury</option>
                                <option value="14">Tournament square</option>
                                <option value="16">Rally point</option>
                                <option value="19">Barracks</option>
                                <option value="20">Stable</option>
                                <option value="21">Workshop</option>

                                <option value="22">Academy</option>
                                <option value="29">Great barracks</option>
                                <option value="30">Great stable</option>
                                <option value="37">Hero's mansion</option>
                            </optgroup>
                            <?php } ?>
                        </select>

            <?php if($building->getTypeLevel(16) == 20 && $process['t8'] >= 20) { ?>
                     <select name="ctar2" class="dropdown">
                <option value="0">-</option>
                <option value="99">Random</option>
                            <?php if($building->getTypeLevel(16) >= 5) { ?>
                            <optgroup label="Resources">
                                <option value="1">Woodcutter</option>
                                <option value="2">Clay Pit</option>
                                <option value="3">Iron Mine</option>
                                <option value="4">Cropland</option>
                                <option value="5">Sawmill</option>
                                <option value="6">Brickyard</option>

                                <option value="7">Iron Foundry</option>
                                <option value="8">Grain Mill</option>
                                <option value="9">Bakery</option>
                            </optgroup>
                            <?php } ?>
                            <?php if($building->getTypeLevel(16) >= 3) { ?>
                            <optgroup label="Infrastructure">
                                <option value="10">Warehouse</option>
                                <option value="11">Granary</option>
                                <?php if($building->getTypeLevel(16) >= 10) { ?>
                                <option value="15">Main building</option>
                                <option value="17">Marketplace</option>
                                <option value="18">Embassy</option>
                                <option value="24">Townhall</option>
                                <option value="25">Residence</option>
                                <option value="26">Palace</option>

                                <option value="27">Treasury</option>
                                <option value="28">Trade office</option>
                                <option value="35">Brewery</option>
                                <?php } ?>
                                <option value="38">Great warehouse</option>
                                <option value="39">Great granary</option>
								<option value="40">Wonder of the World</option>
                            </optgroup>
                            <?php } ?>
                            <?php if($building->getTypeLevel(16) >= 10) { ?>
                            <optgroup label="Military">
                                <option value="12">Blacksmith</option>
                                <option value="13">Armoury</option>
                                <option value="14">Tournament square</option>
                                <option value="16">Rally point</option>
                                <option value="19">Barracks</option>
                                <option value="20">Stable</option>
                                <option value="21">Workshop</option>

                                <option value="22">Academy</option>
                                <option value="29">Great barracks</option>
                                <option value="30">Great stable</option>
                                <option value="37">Hero's mansion</option>
                            </optgroup>
                            <?php } ?>
                        </select>
                    <?php }?>

                    <span class="info">(will be attacked by catapult(s))</span>
                     </td>
                </tr>
            </tbody><?PHP
            }
            else if($process['c']=='4')
            {
                ?><tbody class="infos">               
		<tr>
		<th>Destination:</th>
        <td colspan="<?php echo !empty($process['t11']) ? 11 : 10; ?>">
                <?php

                echo"Warning: Catapult will <b>ONLY</b> shoot with a normal attack (they dont shoot with raids!)";
                ?>
        </td>
        </tr>
                <?php
            }
            ?>

        <?php } ?>



             <tbody class="infos">
    <tr>

   <th>Arrived:</th>



            <?php               
            $troopsTime = $units->getWalkingTroopsTime($village->wid, $process[0], $session->uid, $session->tribe, $process, 1, 't');
            $time = $database->getArtifactsValueInfluence($session->uid, $village->wid, 2, $troopsTime);
            ?>

            <td colspan="<?php echo !empty($process['t11']) ? 11 : 10; ?>">

            <div class="in">in <?php echo $generator->getTimeFormat($time); ?></div>

            <div class="at">at <span id="tp2"> <?php echo $generator->procMtime(date('U') + $time, 9)?></span><span> hours</span></div>

            </td>

        </tr>

    </tbody>

</table>

<input name="timestamp" value="<?php echo time(); ?>" type="hidden">

<input name="timestamp_checksum" value="<?php echo $ckey; ?>" type="hidden">

<input name="ckey" value="<?php echo $id; ?>" type="hidden">

<input name="id" value="39" type="hidden">

<input name="a" value="533374" type="hidden">
<input name="c" value="3" type="hidden">

<?php
    if($database->hasBeginnerProtection($village->wid) == 1 && $database->hasBeginnerProtection($process['0']) == 0){
        echo"<span style=\"color: #DD0000\"><b>Caution:</b> Attacking a player will lose the protection!</span>";
    }
    if($database->hasBeginnerProtection($process['0']) == 1) {
        echo"<b>User presently has beginners protection</b>";
    } else {
?>
        <p class="btn"><input value="ok" name="s1" id="btn_ok"

class="dynamic_img " src="img/x.gif" alt="OK" type="image" onclick="if (this.disabled==false) {document.getElementsByTagName('form')[0].submit();} this.disabled=true;" onLoad="this.disabled=false;"></p>

<?php } ?>
</form>
</div>
