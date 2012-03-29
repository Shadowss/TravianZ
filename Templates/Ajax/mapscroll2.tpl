<?php
session_start();
include('GameEngine/config.php');
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS) or die(mysql_error());
mysql_select_db(SQL_DB) or die(mysql_error());
include("GameEngine/Generator.php");
header("Content-Type: application/json;");

//include("GameEngine/Session.php");

if($y < $yy)	{$y = $y + (($yy - $y) /2);}
else			{$y = $yy + (($y - $yy) /2);}

$x = $x - (($x - $xx) / 2);
$x = ($x < -WORLD_MAX)? $x+WORLD_MAX*2+1 : $x;
$x = ($x > WORLD_MAX)? $x-WORLD_MAX*2-1 : $x;
$y = ($y < -WORLD_MAX)? $y+WORLD_MAX*2+1 : $y;
$y = ($y > WORLD_MAX)? $y-WORLD_MAX*2-1 : $y;
$xm6 = ($x-6) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-5 : $x-6;
$xm5 = ($x-5) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-4 : $x-5;
$xm4 = ($x-4) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-3 : $x-4;
$xm3 = ($x-3) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-2 : $x-3;
$xm2 = ($x-2) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-1 : $x-2;
$xm1 = ($x-1) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX : $x-1;
$xp1 = ($x+1) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX : $x+1;
$xp2 = ($x+2) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+1 : $x+2;
$xp3 = ($x+3) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+2: $x+3;
$xp4 = ($x+4) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+3 : $x+4;
$xp5 = ($x+5) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+4 : $x+5;
$xp6 = ($x+6) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+5: $x+6;
$ym6 = ($y-6) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-5 : $y-6;
$ym5 = ($y-5) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-4 : $y-5;
$ym4 = ($y-4) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-3 : $y-4;
$ym3 = ($y-3) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-2 : $y-3;
$ym2 = ($y-2) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-1 : $y-2;
$ym1 = ($y-1) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX : $y-1;
$yp1 = ($y+1) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX : $y+1;
$yp2 = ($y+2) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+1 : $y+2;
$yp3 = ($y+3) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+2: $y+3;
$yp4 = ($y+4) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+3: $y+4;
$yp5 = ($y+5) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+4 : $y+5;
$yp6 = ($y+6) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+5: $y+6;

$xarray = array($xm6,$xm5,$xm4,$xm3,$xm2,$xm1,$x,$xp1,$xp2,$xp3,$xp4,$xp5,$xp6);
$yarray = array($ym6,$ym5,$ym4,$ym3,$ym2,$ym1,$y,$yp1,$yp2,$yp3,$yp4,$yp5,$yp6);
$maparray = array();
$xcount = 0;
$maparray = '';
$maparray2 = '';
for($i=0; $i<=12; $i++){
	if($xcount != 13){
		$maparray .= '\''.$generator->getBaseID($xarray[$xcount],$yarray[$i]).'\',';
		$maparray2 .= $generator->getBaseID($xarray[$xcount],$yarray[$i]).',';
		if($i==12){
			$i = -1;
			$xcount +=1;
		}
	}
}

$maparray = (substr($maparray, 0, -1));
$maparray2 = (substr($maparray2, 0, -1));
//echo $maparray;

$query2 = "SELECT
					s1_wdata.id AS map_id,
					s1_wdata.fieldtype AS map_fieldtype,
					s1_wdata.oasistype AS map_oasis,
					s1_wdata.x AS map_x,
					s1_wdata.y AS map_y,
					s1_wdata.occupied AS map_occupied,
					s1_wdata.image AS map_image,

					s1_odata.conqured AS oasis_conqured,
					info_user_oasis.username AS oasis_user,
					info_user_oasis.tribe AS oasis_tribe,
					info_alliance_oasis.tag AS oasis_alli_name,

					s1_vdata.wref AS ville_id,
					s1_vdata.owner AS ville_user,
					s1_vdata.name AS ville_name,
					s1_vdata.capital AS ville_capital,
					s1_vdata.pop AS ville_pop,

					s1_users.id AS user_id,
					s1_users.username AS user_username,
					s1_users.tribe AS user_tribe,
					s1_users.alliance AS user_alliance,

					s1_alidata.id AS aliance_id,
					s1_alidata.tag AS aliance_name

				FROM ((((((s1_wdata
					LEFT JOIN s1_vdata ON s1_vdata.wref = s1_wdata.id )
					LEFT JOIN s1_odata ON s1_odata.wref = s1_wdata.id )
					LEFT JOIN s1_users AS info_user_oasis ON info_user_oasis.id = s1_odata.owner )
					LEFT JOIN s1_alidata AS info_alliance_oasis ON info_alliance_oasis.id = info_user_oasis.alliance )
					LEFT JOIN s1_users ON s1_users.id = s1_vdata.owner )
					LEFT JOIN s1_alidata ON s1_alidata.id = s1_users.alliance )
			where s1_wdata.id IN ($maparray)
			ORDER BY FIND_IN_SET(s1_wdata.id,'$maparray2')";
//echo $query2;
$result2 = mysql_query($query2) or die(mysql_error());

$targetalliance = array();
$neutralarray = array();
$friendarray = array();
$enemyarray = array();
$i=0;
$i2=0;
$yrow = 0;
$row = 0;
$coorindex = 0;
$map_js ='';

while ($donnees = mysql_fetch_assoc($result2)){
$image = ($donnees['map_occupied'] == 1 && $donnees['map_fieldtype'] > 0)?(($donnees['ville_user'] == $_SESSION['id_user'])? ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b30': 'b20' :'b10' : 'b00') : (($targetalliance != 0)? (in_array($targetalliance,$friendarray)? ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b31': 'b21' :'b11' : 'b01') : (in_array($targetalliance,$enemyarray)? ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b32': 'b22' :'b12' : 'b02') : (in_array($targetalliance,$neutralarray)? ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b35': 'b25' :'b15' : 'b05') : ($targetalliance == $_SESSION['alliance_user']? ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b33': 'b23' :'b13' : 'b03') : ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b34': 'b24' :'b14' : 'b04'))))) : ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b34': 'b24' :'b14' : 'b04'))) : $donnees['map_image'];




	//Javascript map info
	if($yrow!=13){
		$map_js .= "[".$donnees['map_x'].",".$donnees['map_y'].",".$donnees['map_fieldtype'].",". ((!empty($donnees['map_oasis'])) ? $donnees['map_oasis'] : 0) .",\"d=".$donnees['map_id']."&c=".$generator->getMapCheck($donnees['map_id'])."\",\"".$image."\"";
		if($donnees['map_occupied']){
			if($donnees['map_fieldtype'] != 0){
				$map_js.= ",\"".htmlspecialchars($donnees['ville_name'])."\",\"".htmlspecialchars($donnees['user_username'])."\",\"".$donnees['ville_pop']."\",\"".htmlspecialchars($donnees['aliance_name'])."\",\"".$donnees['user_tribe']."\"]\n";
			}
		}
		elseif($donnees['map_oasis'] != 0){
			if ($donnees['oasis_conqured'] != 0){
					$map_js.= ",\"\",\"".$donnees['oasis_user']."\",\"-\",\"".$donnees['oasis_alli_name']."\",\"".$donnees['oasis_tribe']."\"]";
			} 
			else{
				$map_js.="]";
			}
		}
		else{$map_js .= "]";}

		if($i == 12 && $yrow !=12){
			$i = -1;
			$yrow +=1;
			$map_js .= "],[";
		}
		else {
			if($yrow == 12 && $i == 12) {$map_js .= "]";}
			else {$map_js .= ",";}
		}
		$regcount += 1;
	}
	else {$map_js .= "]";}
	++$i;
}
echo '[['.$map_js.']';