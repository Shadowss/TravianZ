<?php

#################################################################################
## TravianZ Project - Map View JSON (13x13) 									##
## Incremental Refactor (Shadow Assistant) 										##
## ---------------------------------------------------------------------------  ##
## Credits: Advocaite, yi12345, Shadow, MisterX 								##
## Refactor (readability / structure): ChatGPT 									##
## Compatibility: PHP 7+ / legacy 												##
## Note: No behavior change - only refactor, cleanup, readability 				##
#################################################################################

/* =========================
   BOOTSTRAP
========================= */
session_start();
include_once('GameEngine/config.php');
include_once("GameEngine/Lang/". LANG. ".php");
include_once("GameEngine/Generator.php");
include_once("GameEngine/Database.php");

header("Content-Type: application/json;");

/* =========================
   WORLD CONFIG SHORTCUT
========================= */
$W = WORLD_MAX;

/* =========================
   CENTER COORDINATE CALCULATION
========================= */
if ($y < $yy) {
    $y = $y + (($yy - $y) / 2);
} else {
    $y = $yy + (($y - $yy) / 2);
}

$x = $x - (($x - $xx) / 2);

/* =========================
   WORLD WRAP (original +1 logic preserved)
========================= */
$x = ($x < -$W)? $x + $W * 2 + 1 : $x;
$x = ($x > $W)? $x - $W * 2 - 1 : $x;
$y = ($y < -$W)? $y + $W * 2 + 1 : $y;
$y = ($y > $W)? $y - $W * 2 - 1 : $y;

/* =========================
   MAP COORDINATES CALCULATION (13x13)
========================= */
$xm6 = ($x - 6) < -$W? $x + $W + $W - 5 : $x - 6;
$xm5 = ($x - 5) < -$W? $x + $W + $W - 4 : $x - 5;
$xm4 = ($x - 4) < -$W? $x + $W + $W - 3 : $x - 4;
$xm3 = ($x - 3) < -$W? $x + $W + $W - 2 : $x - 3;
$xm2 = ($x - 2) < -$W? $x + $W + $W - 1 : $x - 2;
$xm1 = ($x - 1) < -$W? $x + $W + $W : $x - 1;

$xp1 = ($x + 1) > $W? $x - $W - $W : $x + 1;
$xp2 = ($x + 2) > $W? $x - $W - $W + 1 : $x + 2;
$xp3 = ($x + 3) > $W? $x - $W - $W + 2 : $x + 3;
$xp4 = ($x + 4) > $W? $x - $W - $W + 3 : $x + 4;
$xp5 = ($x + 5) > $W? $x - $W - $W + 4 : $x + 5;
$xp6 = ($x + 6) > $W? $x - $W - $W + 5 : $x + 6;

$ym6 = ($y - 6) < -$W? $y + $W + $W - 5 : $y - 6;
$ym5 = ($y - 5) < -$W? $y + $W + $W - 4 : $y - 5;
$ym4 = ($y - 4) < -$W? $y + $W + $W - 3 : $y - 4;
$ym3 = ($y - 3) < -$W? $y + $W + $W - 2 : $y - 3;
$ym2 = ($y - 2) < -$W? $y + $W + $W - 1 : $y - 2;
$ym1 = ($y - 1) < -$W? $y + $W + $W : $y - 1;

$yp1 = ($y + 1) > $W? $y - $W - $W : $y + 1;
$yp2 = ($y + 2) > $W? $y - $W - $W + 1 : $y + 2;
$yp3 = ($y + 3) > $W? $y - $W - $W + 2 : $y + 3;
$yp4 = ($y + 4) > $W? $y - $W - $W + 3 : $y + 4;
$yp5 = ($y + 5) > $W? $y - $W - $W + 4 : $y + 5;
$yp6 = ($y + 6) > $W? $y - $W - $W + 5 : $y + 6;

/* =========================
   MAP GRID ARRAYS
========================= */
$xarray = array($xm6, $xm5, $xm4, $xm3, $xm2, $xm1, $x, $xp1, $xp2, $xp3, $xp4, $xp5, $xp6);
$yarray = array($ym6, $ym5, $ym4, $ym3, $ym2, $ym1, $y, $yp1, $yp2, $yp3, $yp4, $yp5, $yp6);

$maparray = '';
$maparray2 = '';

$xcount = 0;

for ($i = 0; $i <= 12; $i++) {
    if ($xcount!= 13) {
        $id = $generator->getBaseID($xarray[$xcount], $yarray[$i]);

        $maparray.= "'". $id. "',";
        $maparray2.= $id. ",";

        if ($i == 12) {
            $i = -1;
            $xcount++;
        }
    }
}

$maparray = substr($maparray, 0, -1);
$maparray2 = substr($maparray2, 0, -1);

/* =========================
   MAIN MAP QUERY
========================= */
$query2 = "
SELECT
    ". TB_PREFIX. "wdata.id AS map_id,
    ". TB_PREFIX. "wdata.fieldtype AS map_fieldtype,
    ". TB_PREFIX. "wdata.oasistype AS map_oasis,
    ". TB_PREFIX. "wdata.x AS map_x,
    ". TB_PREFIX. "wdata.y AS map_y,
    ". TB_PREFIX. "wdata.occupied AS map_occupied,
    ". TB_PREFIX. "wdata.image AS map_image,

    ". TB_PREFIX. "odata.conqured AS oasis_conqured,
    info_user_oasis.username AS oasis_user,
    info_user_oasis.tribe AS oasis_tribe,
    info_alliance_oasis.tag AS oasis_alli_name,

    ". TB_PREFIX. "vdata.wref AS ville_id,
    ". TB_PREFIX. "vdata.owner AS ville_user,
    ". TB_PREFIX. "vdata.name AS ville_name,
    ". TB_PREFIX. "vdata.capital AS ville_capital,
    ". TB_PREFIX. "vdata.pop AS ville_pop,

    ". TB_PREFIX. "users.id AS user_id,
    ". TB_PREFIX. "users.username AS user_username,
    ". TB_PREFIX. "users.tribe AS user_tribe,
    ". TB_PREFIX. "users.alliance AS user_alliance,

    ". TB_PREFIX. "alidata.id AS aliance_id,
    ". TB_PREFIX. "alidata.tag AS aliance_name

FROM ((((((". TB_PREFIX. "wdata
    LEFT JOIN ". TB_PREFIX. "vdata ON ". TB_PREFIX. "vdata.wref = ". TB_PREFIX. "wdata.id)
    LEFT JOIN ". TB_PREFIX. "odata ON ". TB_PREFIX. "odata.wref = ". TB_PREFIX. "wdata.id)
    LEFT JOIN ". TB_PREFIX. "users AS info_user_oasis ON info_user_oasis.id = ". TB_PREFIX. "odata.owner)
    LEFT JOIN ". TB_PREFIX. "alidata AS info_alliance_oasis ON info_alliance_oasis.id = info_user_oasis.alliance)
    LEFT JOIN ". TB_PREFIX. "users ON ". TB_PREFIX. "users.id = ". TB_PREFIX. "vdata.owner)
    LEFT JOIN ". TB_PREFIX. "alidata ON ". TB_PREFIX. "alidata.id = ". TB_PREFIX. "users.alliance)

WHERE ". TB_PREFIX. "wdata.id IN ($maparray)
ORDER BY FIND_IN_SET(". TB_PREFIX. "wdata.id,'$maparray2')
";

$result2 = mysqli_query($database->dblink, $query2) or die(mysqli_error($database->dblink));

/* =========================
   OUTPUT PREPARATION
========================= */
$i = 0;
$yrow = 0;
$map_js = '';

/* =========================
   MAIN LOOP (UNCHANGED LOGIC)
========================= */
while ($donnees = mysqli_fetch_assoc($result2)) {

    $targetalliance = $donnees["aliance_id"];

    $friendarray = $database->getAllianceAlly($donnees["aliance_id"], 1);
    $neutralarray = $database->getAllianceAlly($donnees["aliance_id"], 2);
    $enemyarray = $database->getAllianceWar2($donnees["aliance_id"]);

    $sessionAlliance = $_SESSION['alliance_user'];

    $friend = ((isset($friendarray[0]) && isset($friendarray[0]['alli1']) && isset($friendarray[0]['alli2']) && $friendarray[0]['alli1'] > 0 && $friendarray[0]['alli2'] > 0 && $donnees["aliance_id"] > 0) && ($friendarray[0]['alli1'] == $sessionAlliance || $friendarray[0]['alli2'] == $sessionAlliance) && ($sessionAlliance!= $targetalliance && $sessionAlliance && $targetalliance))? '1' : '0';

    $war = ((isset($enemyarray[0]) && isset($enemyarray[0]['alli1']) && isset($enemyarray[0]['alli2']) && $enemyarray[0]['alli1'] > 0 && $enemyarray[0]['alli2'] > 0 && $donnees["aliance_id"] > 0) && ($enemyarray[0]['alli1'] == $sessionAlliance || $enemyarray[0]['alli2'] == $sessionAlliance) && ($sessionAlliance!= $targetalliance && $sessionAlliance && $targetalliance))? '1' : '0';

    $neutral = ((isset($neutralarray[0]) && isset($neutralarray[0]['alli1']) && isset($neutralarray[0]['alli2']) && $neutralarray[0]['alli1'] > 0 && $neutralarray[0]['alli2'] > 0 && $donnees["aliance_id"] > 0) && ($neutralarray[0]['alli1'] == $sessionAlliance || $neutralarray[0]['alli2'] == $sessionAlliance) && ($sessionAlliance!= $targetalliance && $sessionAlliance && $targetalliance))? '1' : '0';

    /* IMAGE DECISION */
    $image = ($donnees['map_occupied'] == 1 && $donnees['map_fieldtype'] > 0)
      ? (($donnees['ville_user'] == $_SESSION['id_user'])
          ? ($donnees['ville_pop'] >= 100
              ? ($donnees['ville_pop'] >= 250
                  ? ($donnees['ville_pop'] >= 500? 'b30' : 'b20')
                    : 'b10')
                : 'b00')
            : (($targetalliance!= 0)
              ? ($friend == 1
                  ? ($donnees['ville_pop'] >= 100
                      ? ($donnees['ville_pop'] >= 250
                          ? ($donnees['ville_pop'] >= 500? 'b31' : 'b21')
                            : 'b11')
                        : 'b01')
                    : ($war == 1
                      ? ($donnees['ville_pop'] >= 100
                          ? ($donnees['ville_pop'] >= 250
                              ? ($donnees['ville_pop'] >= 500? 'b32' : 'b22')
                                : 'b12')
                            : 'b02')
                        : ($neutral == 1
                          ? ($donnees['ville_pop'] >= 100
                              ? ($donnees['ville_pop'] >= 250
                                  ? ($donnees['ville_pop'] >= 500? 'b35' : 'b25')
                                    : 'b15')
                                : 'b05')
                            : ($targetalliance == $sessionAlliance
                              ? ($donnees['ville_pop'] >= 100
                                  ? ($donnees['ville_pop'] >= 250
                                      ? ($donnees['ville_pop'] >= 500? 'b33' : 'b23')
                                        : 'b13')
                                    : 'b03')
                                : ($donnees['ville_pop'] >= 100
                                  ? ($donnees['ville_pop'] >= 250
                                      ? ($donnees['ville_pop'] >= 500? 'b34' : 'b24')
                                        : 'b14')
                                    : 'b04')))))
                : ($donnees['ville_pop'] >= 100
                  ? ($donnees['ville_pop'] >= 250
                      ? ($donnees['ville_pop'] >= 500? 'b34' : 'b24')
                        : 'b14')
                    : 'b04')))
        : $donnees['map_image'];

    if ($donnees['ville_user'] == 3 && $donnees['ville_name'] == PLANVILLAGE) {
        $image = "o99";
    }

    /* ATTACK MARKERS */
    $att = "";
    if (isset($_SESSION['troops_movement'])) {
        if (isset($_SESSION['troops_movement']['attacks']) && in_array($donnees['map_id'], $_SESSION['troops_movement']['attacks'])) {
            $att = 3;
        } elseif (isset($_SESSION['troops_movement']['scouts']) && in_array($donnees['map_id'], $_SESSION['troops_movement']['scouts'])) {
            $att = 6;
        } elseif (isset($_SESSION['troops_movement']['enforcements']) && in_array($donnees['map_id'], $_SESSION['troops_movement']['enforcements'])) {
            $att = 9;
        }
    }

    /* JS MAP DATA */
    if ($yrow!= 13) {
        $map_js.= "[". $donnees['map_x']. ",". $donnees['map_y']. ",". $donnees['map_fieldtype']. ",". ((!empty($donnees['map_oasis']))? $donnees['map_oasis'] : 0). ",\"d=". $donnees['map_id']. "&c=". $generator->getMapCheck($donnees['map_id']). "\",\"". $image. "\",\"". $att. "\"";

        if ($donnees['map_occupied']) {
            if ($donnees['map_fieldtype']!= 0) {
                $map_js.= ",\"". $donnees['ville_name']. "\",\"". $donnees['user_username']. "\",\"". $donnees['ville_pop']. "\",\"". $donnees['aliance_name']. "\",\"". $donnees['user_tribe']. "\"]\n";
            }
        } elseif ($donnees['map_oasis']!= 0) {
            if ($donnees['oasis_conqured']!= 0) {
                $map_js.= ",\"\",\"". $donnees['oasis_user']. "\",\"-\",\"". $donnees['oasis_alli_name']. "\",\"". $donnees['oasis_tribe']. "\"]";
            } else {
                $map_js.= "]";
            }
        } else {
            $map_js.= "]";
        }

        if ($i == 12 && $yrow!= 12) {
            $i = -1;
            $yrow++;
            $map_js.= "],[";
        } else {
            $map_js.= ($yrow == 12 && $i == 12)? "]" : ",";
        }
    } else {
        $map_js.= "]";
    }

    $i++;
}

echo '[['. $map_js. ']';