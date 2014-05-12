<?php
$artefact1 = $database->getOwnArtefactInfo3($session->uid);
$wref = $village->wid;
$coor = $database->getCoor($wref);
function getDistance($coorx1, $coory1, $coorx2, $coory2) {
   $max = 2 * WORLD_MAX + 1;
   $x1 = intval($coorx1);
   $y1 = intval($coory1);
   $x2 = intval($coorx2);
   $y2 = intval($coory2);
   $distanceX = min(abs($x2 - $x1), abs($max - abs($x2 - $x1)));
   $distanceY = min(abs($y2 - $y1), abs($max - abs($y2 - $y1)));
   $dist = sqrt(pow($distanceX, 2) + pow($distanceY, 2));
   return round($dist, 1);
   }
?>
<div class="gid27">
<body>
<table id="own" cellpadding="1" cellspacing="1">
<thead>
<tr>
<th colspan="4"><?php echo OWN_ARTIFACTS; ?></th>
</tr>
<tr>
<td></td>
<td><?php echo NAME; ?></td>
<td><?php echo VILLAGE; ?></td>
<td><?php echo CONQUERED; ?></td>
</tr>
</thead>

<tbody>
<?php

if (count($artefact1)==0){
                echo '<tr><td colspan="4" class="none">'.ANY_ARTIFACTS.'</td></tr>';
        } else {
                foreach($artefact1 as $artefact){
                $coor2 = $database->getCoor($artefact['vref']);
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
        echo '<tr><td class="icon"><img class="artefact_icon_' . $artefact['type'] . '" src="img/x.gif"></td>';
        echo '<td class="nam">
<a href="build.php?id=' . $id . '&show='.$artefact['id'].'">' . $artefact['name'] . '</a> <span class="bon">' . $artefact['effect'] . '</span>
<div class="info">
Treasury <b>' . $reqlvl . '</b>, Effect <b>' . $effect . '</b>
</div>
</td>';
        echo '<td class="pla"><a href="karte.php?d=' . $artefact['vref'] . '&c=' . $generator->getMapCheck($artefact['vref']) . '">' . $database->getVillageField($artefact['vref'], "name") . '</a></td>';
        echo '<td class="dist">' . date("d/m/Y H:i", $artefact['conquered']) . '</td></tr>';
}
                }

?>
</tbody>
</table>

<table id="near" cellpadding="1" cellspacing="1">
<thead>
<tr>
<th colspan="4"><?php echo ARTIFACTS_AREA; ?></th>
</tr>

<tr>
<td></td>

<td><?php echo NAME; ?></td>

<td><?php echo PLAYER; ?></td>

<td><?php echo DISTANCE; ?></td>
</tr>
</thead>

<tbody>
<?php

if(mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "artefacts")) == 0) {
                echo '<td colspan="4" class="none">'.NO_ARTIFACTS_AREA.'</td>';
        } else {


                function haversine($l1, $o1, $l2, $o2) {
                        $l1 = deg2rad($l1);
                        $sinl1 = sin($l1);
                        $l2 = deg2rad($l2);
                        $o1 = deg2rad($o1);
                        $o2 = deg2rad($o2);

                        return (7926 - 26 * $sinl1) * asin(min(1, 0.707106781186548 * sqrt((1 - (sin($l2) * $sinl1) - cos($l1) * cos($l2) * cos($o2 - $o1)))));
                }


        unset($reqlvl);
        unset($effect);
        $arts = mysql_query("SELECT * FROM " . TB_PREFIX . "artefacts");
        $rows = array();
        while($row = mysql_fetch_array($arts)) {
                        $query = mysql_query('SELECT * FROM `' . TB_PREFIX . 'wdata` WHERE `id` = ' . $row['vref']);
                        $coor2 = mysql_fetch_assoc($query);

                        
                        $dist = round(getDistance($coor['x'], $coor['y'], $coor2['x'], $coor2['y']),1);

                        $rows[$dist] = $row;

                }
        ksort($rows);
        foreach($rows as $row) {
                $wref = $village->wid;
                $coor = $database->getCoor($wref);
                $wref2 = $row['vref'];
                $coor2 = $database->getCoor($wref2);
                        echo '<tr>';
                        echo '<td class="icon"><img class="artefact_icon_' . $row['type'] . '" src="img/x.gif" alt="" title=""></td>';
                        echo '<td class="nam">';
                        echo '<a href="build.php?id=' . $id . '&show='.$row['id'].'">' . $row['name'] . '</a> <span class="bon">' . $row['effect'] . '</span>';
                        echo '<div class="info">';
                    if($row['size'] == 1 && $row['type'] != 11){
                       $reqlvl = 10;
                       $effect = VILLAGE;
                   }else{
                                         if($row['type'] != 11){
                       $reqlvl = 20;
                                         }else{
                                         $reqlvl = 10;
                                         }
$effect = ACCOUNT;
}
                echo '<div class="info">'.TREASURY.' <b>' . $reqlvl . '</b>, '.EFFECT.' <b>' . $effect . '</b>';
                echo '</div></td><td class="pla"><a href="karte.php?d=' . $row['vref'] . '&c=' . $generator->getMapCheck($row['vref']) . '">' . $database->getUserField($row['owner'], "username", 0) . '</a></td>';
                echo '<td class="dist">'.getDistance($coor['x'], $coor['y'], $coor2['x'], $coor2['y']).'</td>';
                echo '</tr>';
        }
}

?>
</tbody>
</table>
</div>