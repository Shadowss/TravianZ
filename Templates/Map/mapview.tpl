<?php 
if(isset($_GET['z'])) {
	$currentcoor = $database->getCoor($_GET['z']);++$requse2;
    $y = $currentcoor['y'];
	$x = $currentcoor['x'];
    $bigmid = $_GET['z'];
}
else if(isset($_POST['xp']) && isset($_POST['yp'])){
	$x = $_POST['xp'];
    $y = $_POST['yp'];
    $bigmid = $generator->getBaseID($x,$y);
}
else {
    $y = $village->coor['y'];
	$x = $village->coor['x'];
    $bigmid = $village->wid;
}

$xm7 = ($x-7) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-6 : $x-7;
$xm3 = ($x-3) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-2 : $x-3;
$xm2 = ($x-2) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX-1 : $x-2;
$xm1 = ($x-1) < -WORLD_MAX? $x+WORLD_MAX+WORLD_MAX : $x-1;
$xp1 = ($x+1) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX : $x+1;
$xp2 = ($x+2) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+1 : $x+2;
$xp3 = ($x+3) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+2: $x+3;
$xp7 = ($x+7) > WORLD_MAX? $x-WORLD_MAX-WORLD_MAX+6: $x+7;
$ym7 = ($y-7) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-6 : $y-7;
$ym3 = ($y-3) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-2 : $y-3;
$ym2 = ($y-2) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX-1 : $y-2;
$ym1 = ($y-1) < -WORLD_MAX? $y+WORLD_MAX+WORLD_MAX : $y-1;
$yp1 = ($y+1) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX : $y+1;
$yp2 = ($y+2) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+1 : $y+2;
$yp3 = ($y+3) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+2: $y+3;
$yp7 = ($y+7) > WORLD_MAX? $y-WORLD_MAX-WORLD_MAX+6: $y+7;
$xarray = array($xm3,$xm2,$xm1,$x,$xp1,$xp2,$xp3);
$yarray = array($ym3,$ym2,$ym1,$y,$yp1,$yp2,$yp3);
$maparray = array();
$xcount = 0;
$maparray = '';
$maparray2 = '';
for($i=0; $i<=6; $i++){
	if($xcount != 7){
		$maparray .= '\''.$generator->getBaseID($xarray[$xcount],$yarray[$i]).'\',';
		$maparray2 .= $generator->getBaseID($xarray[$xcount],$yarray[$i]).',';
		if($i==6){
			$i = -1;
			$xcount +=1;
		}
	}
}

$maparray = (substr($maparray, 0, -1));
//echo $maparray;

$query2 = "SELECT
					".TB_PREFIX."wdata.id AS map_id,
					".TB_PREFIX."wdata.fieldtype AS map_fieldtype,
					".TB_PREFIX."wdata.oasistype AS map_oasis,
					".TB_PREFIX."wdata.x AS map_x,
					".TB_PREFIX."wdata.y AS map_y,
					".TB_PREFIX."wdata.occupied AS map_occupied,
					".TB_PREFIX."wdata.image AS map_image,

					".TB_PREFIX."odata.conqured AS oasis_conqured,
					info_user_oasis.username AS oasis_user,
					info_user_oasis.tribe AS oasis_tribe,
					info_alliance_oasis.tag AS oasis_alli_name,

					".TB_PREFIX."vdata.wref AS ville_id,
					".TB_PREFIX."vdata.owner AS ville_user,
					".TB_PREFIX."vdata.name AS ville_name,
					".TB_PREFIX."vdata.capital AS ville_capital,
					".TB_PREFIX."vdata.pop AS ville_pop,

					".TB_PREFIX."users.id AS user_id,
					".TB_PREFIX."users.username AS user_username,
					".TB_PREFIX."users.tribe AS user_tribe,
					".TB_PREFIX."users.alliance AS user_alliance,

					".TB_PREFIX."alidata.id AS aliance_id,
					".TB_PREFIX."alidata.tag AS aliance_name

				FROM ((((((".TB_PREFIX."wdata
					LEFT JOIN ".TB_PREFIX."vdata ON ".TB_PREFIX."vdata.wref = ".TB_PREFIX."wdata.id )
					LEFT JOIN ".TB_PREFIX."odata ON ".TB_PREFIX."odata.wref = ".TB_PREFIX."wdata.id )
					LEFT JOIN ".TB_PREFIX."users AS info_user_oasis ON info_user_oasis.id = ".TB_PREFIX."odata.owner )
					LEFT JOIN ".TB_PREFIX."alidata AS info_alliance_oasis ON info_alliance_oasis.id = info_user_oasis.alliance )
					LEFT JOIN ".TB_PREFIX."users ON ".TB_PREFIX."users.id = ".TB_PREFIX."vdata.owner )
					LEFT JOIN ".TB_PREFIX."alidata ON ".TB_PREFIX."alidata.id = ".TB_PREFIX."users.alliance )
			where ".TB_PREFIX."wdata.id IN ($maparray)
			ORDER BY FIND_IN_SET(".TB_PREFIX."wdata.id,'$maparray2')";

//$query2;

$result2 = mysql_query($query2) or die(mysql_error());

$targetalliance = array();
$neutralarray = array();
$friendarray = array();
$enemyarray = array();
$i=0;
//Load coor array
$coorarray = array("53, 137, 90, 157, 53, 177, 16, 157","89, 117, 126, 137, 89, 157, 52, 137","125, 97, 162, 117, 125, 137, 88, 117","161, 77, 198, 97, 161, 117, 124, 97","197, 57, 234, 77, 197, 97, 160, 77","233, 37, 270, 57, 233, 77, 196, 57","269, 17, 306, 37, 269, 57, 232, 37","90, 157, 127, 177, 90, 197, 53, 177","126, 137, 163, 157, 126, 177, 89, 157","162, 117, 199, 137, 162, 157, 125, 137","198, 97, 235, 117, 198, 137, 161, 117","234, 77, 271, 97, 234, 117, 197, 97","270, 57, 307, 77, 270, 97, 233, 77","306, 37, 343, 57, 306, 77, 269, 57","127, 177, 164, 197, 127, 217, 90, 197","163, 157, 200, 177, 163, 197, 126, 177","199, 137, 236, 157, 199, 177, 162, 157","235, 117, 272, 137, 235, 157, 198, 137","271, 97, 308, 117, 271, 137, 234, 117","307, 77, 344, 97, 307, 117, 270, 97","343, 57, 380, 77, 343, 97, 306, 77","164, 197, 201, 217, 164, 237, 127, 217","200, 177, 237, 197, 200, 217, 163, 197","236, 157, 273, 177, 236, 197, 199, 177","272, 137, 309, 157, 272, 177, 235, 157","308, 117, 345, 137, 308, 157, 271, 137","344, 97, 381, 117, 344, 137, 307, 117","380, 77, 417, 97, 380, 117, 343, 97","201, 217, 238, 237, 201, 257, 164, 237","237, 197, 274, 217, 237, 237, 200, 217","273, 177, 310, 197, 273, 217, 236, 197","309, 157, 346, 177, 309, 197, 272, 177","345, 137, 382, 157, 345, 177, 308, 157","381, 117, 418, 137, 381, 157, 344, 137","417, 97, 454, 117, 417, 137, 380, 117","238, 237, 275, 257, 238, 277, 201, 257","274, 217, 311, 237, 274, 257, 237, 237","310, 197, 347, 217, 310, 237, 273, 217","346, 177, 383, 197, 346, 217, 309, 197","382, 157, 419, 177, 382, 197, 345, 177","418, 137, 455, 157, 418, 177, 381, 157","454, 117, 491, 137, 454, 157, 417, 137","275, 257, 312, 277, 275, 297, 238, 277","311, 237, 348, 257, 311, 277, 274, 257","347, 217, 384, 237, 347, 257, 310, 237","383, 197, 420, 217, 383, 237, 346, 217","419, 177, 456, 197, 419, 217, 382, 197","455, 157, 492, 177, 455, 197, 418, 177","491, 137, 528, 157, 491, 177, 454, 157");
$yrow = 0;

$row = 0;
$coorindex = 0;
$map_js ='';

while ($donnees = mysql_fetch_assoc($result2)){

$targetalliance=$donnees["aliance_id"];
$friendarray=$database->getAllianceAlly($donnees["aliance_id"],1);
$neutralarray=$database->getAllianceAlly($donnees["aliance_id"],2);
$enemyarray=$database->getAllianceWar2($donnees["aliance_id"]);
//var_dump($friendarray);
//echo "(".$friendarray[0]['alli1'].">0 or ".$donnees["aliance_id"].">0) and (".$friendarray[0]['alli1']."==".$donnees["aliance_id"]." or ".$friendarray[0]['alli2']."==".$donnees["aliance_id"].") and (".$session->alliance." != ".$targetalliance." and ".$session->alliance." and ".$targetalliance.")<br>\n";

$friend = (($friendarray[0]['alli1']>0 and $friendarray[0]['alli2']>0 and $donnees["aliance_id"]>0) and ($friendarray[0]['alli1']==$session->alliance or $friendarray[0]['alli2']==$session->alliance) and ($session->alliance != $targetalliance and $session->alliance and $targetalliance)) ? '1':'0';

$war = (($enemyarray[0]['alli1']>0 and $enemyarray[0]['alli2']>0 and $donnees["aliance_id"]>0) and ($enemyarray[0]['alli1']==$session->alliance or $enemyarray[0]['alli2']==$session->alliance) and ($session->alliance != $targetalliance and $session->alliance and $targetalliance)) ? '1':'0';

$neutral = (($neutralarray[0]['alli1']>0 and $neutralarray[0]['alli2']>0 and $donnees["aliance_id"]>0) and ($neutralarray[0]['alli1']==$session->alliance or $neutralarray[0]['alli2']==$session->alliance) and ($session->alliance != $targetalliance and $session->alliance and $targetalliance)) ? '1':'0';

//echo $targetalliance.">>";
//var_dump($friendarray);
//echo"|||<br>";
//var_dump($arraydiplo);
//echo in_array($targetalliance,$friendarray);
	$image = ($donnees['map_occupied'] == 1 && $donnees['map_fieldtype'] > 0)?(($donnees['ville_user'] == $session->uid)? ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b30': 'b20' :'b10' : 'b00') : (($targetalliance != 0)? ($friend==1? ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b31': 'b21' :'b11' : 'b01') : ($war==1? ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b32': 'b22' :'b12' : 'b02') : ($neutral==1? ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b35': 'b25' :'b15' : 'b05') : ($targetalliance == $session->alliance? ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b33': 'b23' :'b13' : 'b03') : ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b34': 'b24' :'b14' : 'b04'))))) : ($donnees['ville_pop']>=100? $donnees['ville_pop']>= 250?$donnees['ville_pop']>=500? 'b34': 'b24' :'b14' : 'b04'))) : $donnees['map_image'];

	// Map content
	if($donnees['ville_user']==3 && $donnees['ville_name']=='WW Buildingplan'){
	$map_content .= "<div id='i_".$row."_".$i."' class='o99'></div>\r";
	}else{
	$map_content .= "<div id='i_".$row."_".$i."' class='".$image."'></div>\r";
	}
	//Map create
	$map_gen .= "<area id='a_".$row."_".$i."' shape='poly' coords='".$coorarray[$coorindex]."' title='".$donnees['ville_name']."' href='karte.php?d=".$donnees['map_id']."&c=".$generator->getMapCheck($donnees['map_id'])."' />\n";
	
	//Javascript map info
	if($yrow!=7){
		$map_js .= "[".$donnees['map_x'].",".$donnees['map_y'].",".$donnees['map_fieldtype'].",". ((!empty($donnees['map_oasis'])) ? $donnees['map_oasis'] : 0) .",\"d=".$donnees['map_id']."&c=".$generator->getMapCheck($donnees['map_id'])."\",\"".$image."\"";
		if($donnees['map_occupied']){
			if($donnees['map_fieldtype'] != 0){
				$map_js.= ",\"".$donnees['ville_name']."\",\"".$donnees['user_username']."\",\"".$donnees['ville_pop']."\",\"".$donnees['aliance_name']."\",\"".$donnees['user_tribe']."\"]\n";
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
		else{$map_js .= "]\n";}

		if($i2 == 6 && $yrow !=6){
			$i2 = -1;
			$yrow +=1;
			$map_js .= "],\n[";
		}
		else {
			if($yrow == 6 && $i2 == 6) {$map_js .= "]\n";}
			else {$map_js .= ",";}
		}
		$regcount += 1;
	}
	else {$map_js .= "]";}
	
	if($i == 6 && $row <= 5){	$row += 1;	$i = -1;}
	$i++;
	$i2++;
	$coorindex+=1;
}
?>
<div id="content"  class="map">
	<h1>Map(<span id="x"><?php echo $x;?></span>|<span id="y"><?php echo $y;?></span>)</h1>
	<div id="map">
		<script type="text/javascript">
			var text_k = {}
			text_k.details = 'Details';
			text_k.spieler = 'Player';
			text_k.einwohner = 'Population';
			text_k.allianz = 'Alliance';
			text_k.verlassenes_tal = 'Abandoned valley';
			text_k.besetztes_tal = 'Occupied oasis';
			text_k.freie_oase = 'Unoccupied oasis';
			var text_x = {}
			text_x.r1 = 'Lumber';
			text_x.r2 = 'Clay';
			text_x.r3 = 'Iron';
			text_x.r4 = 'Crop';
		</script>
		<div id="map_content"><?php echo $map_content;?></div>
		<div id="map_rulers"><?php
			for($i=0;$i<=6;$i++) {
				echo "<div id=\"mx".$i."\">".$xarray[$i]."</div>\n";
				echo "<div id=\"my".$i."\">".$yarray[$i]."</div>\n";
			}?>
		</div>
		<map id="map_overlay" name="map_overlay">
			<?php echo $map_gen;?>
			<area id="ma_n1" href="karte.php?z=<?php echo $generator->getBaseID($x,$yp1);?>" coords="422,67,25" shape="circle" title="North"/>
			<area id="ma_n2" href="karte.php?z=<?php echo $generator->getBaseID($xp1,$y);?>" coords="427,254,25" shape="circle" title="East"/>
			<area id="ma_n3" href="karte.php?z=<?php echo $generator->getBaseID($x,$ym1);?>" coords="119,255,25" shape="circle" title="South"/>
			<area id="ma_n4" href="karte.php?z=<?php echo $generator->getBaseID($xm1,$y);?>" coords="114,63,25" shape="circle" title="West"/>
		</map>
		<img id="map_links" src="img/x.gif" usemap="#map_overlay" />
		<script type="text/javascript">
			m_c.az = {<?php echo '"n1":'.$generator->getBaseID($x,$yp1).',"n1p7":'.$generator->getBaseID($x,$yp7).',"n2":'.$generator->getBaseID($xp1,$y).',"n2p7":'.$generator->getBaseID($xm7,$y).',"n3":'.$generator->getBaseID($x,$ym1).',"n3p7":'.$generator->getBaseID($x,$ym7).',"n4":'.$generator->getBaseID($xm1,$y).',"n4p7":'.$generator->getBaseID($xp7,$y); ?>};
			m_c.ad = [<?php echo '['.$map_js;?>];
			m_c.z = {"x":<?php echo $x ?>,"y":<?php echo $y ?>};
			m_c.size = 7;
			var mdim = {"x":7,"y":7,"rad":3}
			var mmode = 0;
			function init_local(){map_init();}
		</script><?php
		if($session->plus){
			echo '<a id="map_makelarge" href="#" onclick="PopupMap('.$bigmid.');" ><img class="ml" src="img/x.gif" alt="large map" title="large map"/></a>';
		}?>
		<img id="map_navibox" src="img/x.gif" usemap="#map_navibox"/>
		<map name="map_navibox">
			<area id="ma_n1p7" href="karte.php?z=<?php echo $generator->getBaseID($x,$yp7) ?>" coords="51,15,73,3,95,15,73,27" shape="poly" title="North"/>
			<area id="ma_n2p7" href="karte.php?z=<?php echo $generator->getBaseID($xm7,$y) ?>" coords="51,41,73,29,95,41,73,53" shape="poly" title="East"/>
			<area id="ma_n3p7" href="karte.php?z=<?php echo $generator->getBaseID($x,$ym7) ?>" coords="4,41,26,29,48,41,26,53" shape="poly" title="South"/>
			<area id="ma_n4p7" href="karte.php?z=<?php echo $generator->getBaseID($xp7,$y) ?>" coords="4,15,26,3,48,15,26,27" shape="poly" title="West"/>
		</map>
		<div id="map_coords">
			<form name="map_coords" method="post" action="karte.php">
				<span>x </span><input id="mcx" class="text" name="xp" value="<?php echo $x ?>" maxlength="4"/>
				<span>y </span><input id="mcy" class="text" name="yp" value="<?php echo $y ?>" maxlength="4"/>
				<input type="image" id="btn_ok" class="dynamic_img" value="ok" name="s1" src="img/x.gif" alt="OK" /><br />
				<?php if($session->goldclub != 0){echo "<a href=\"crop_finder.php\"><img src=\"".GP_LOCATE."img/misc/cropfinder.gif\" /> Crop Finder</a>";}?>
			</form>
		</div>
		<table cellpadding="1" cellspacing="1" id="map_infobox" class="default"><thead><tr><th colspan="2">Details</th></tr></thead><tbody><tr><th>Player</th><td>-</td></tr><tr><th>Population</th><td>-</td></tr><tr><th>Alliance</th><td></td></tr></tbody></table>
	</div>            
</div>