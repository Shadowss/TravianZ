<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       map.tpl                                                     ##
##  Developed by:  ronix                                                       ##
##  Updated by:    iopietro                                                    ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################

$check1 = $check2 = $check3 = "";
$includeSize = true;

if (isset($_POST['show1']) || isset($_POST['show2']) || isset($_POST['show3'])) {
    $check1 = isset($_POST['show1']) ? "checked " : "";
    $check2 = isset($_POST['show2']) ? "checked " : "";
    $check3 = isset($_POST['show3']) ? "checked " : "";
 
    if($check1 != "" && $check2 == "" && $check3 == "") {
        $criteria = " WHERE u.tribe <> 5";
        $includeSize = false;
    }
    elseif($check1 == "" && $check2 != "" && $check3 == "") {
        $criteria = " WHERE u.tribe = 5 AND (v.capital = 1 OR v.natar = 1)";
        $includeSize = false;
    }
    elseif($check1 != "" && $check2 != "" && $check3 == "") {
        $criteria = " WHERE u.tribe <> 5 OR (u.tribe = 5 AND (v.capital = 1 OR v.natar = 1))";
        $includeSize = false;
    }
    elseif($check1 == "" && $check2 == "" && $check3 != "") {
        $criteria = " INNER JOIN ".TB_PREFIX."artefacts AS a ON a.vref = v.wref";
    }
    elseif($check1 != "" && $check2 == "" && $check3 != ""){
        $criteria = " LEFT JOIN ".TB_PREFIX."artefacts AS a ON a.vref = v.wref WHERE u.tribe <> 5 OR (u.tribe = 5 AND v.capital <> 1 AND v.natar <> 1)";
    }
    elseif($check1 == "" && $check2 != "" && $check3 != ""){
        $criteria = " LEFT JOIN ".TB_PREFIX."artefacts AS a ON a.vref = v.wref WHERE u.tribe = 5";
    }
    elseif($check1 != "" && $check2 != "" && $check3 != ""){
        $criteria = " LEFT JOIN ".TB_PREFIX."artefacts AS a ON a.vref = v.wref";
    }
}
if ($check1 == "" && $check2 == "" && $check3 == "") $criteria = "";

?>
<link rel="stylesheet" href="../img/admin/map.css" type="text/css" media="all">
			<div id="start">

			<div class="clear">
					<h2 class="left"><?php echo SERVER_NAME;?> Map!</h2>
				</div>
				<p>This is the map of <?php echo SERVER_NAME;?>. Search and find players.</p>
				<h1>Show Option</h1>
				<form id="show" name="show" action="admin.php?p=map" method="POST">
				<table width="70%">
					<tr><td>
						<input id="show1" name="show1" type="checkbox" <?php echo $check1;?>value="1">Players
						</td>
						<td>
						<input id="show2" name="show2" type="checkbox" <?php echo $check2;?>value="2"><?php echo TRIBE5; ?>
						</td>
						<td>
						<input id="show3" name="show3" type="checkbox" <?php echo $check3;?>value="2">Artifacts
						</td>
						<td>
						<input id="btnshow" type="button" value="Show" style="font-size:9px" onclick=submit()>
						</td>
					</tr>
				</table>
				</form>
			</div>

			<div id="kaart">

				<div id="map" title="">

					<div class="zoomlevels">
						<span id="zl">-<?php echo WORLD_MAX;?></span>
						<span id="zr"><?php echo WORLD_MAX;?></span>
						<span id="zb"><?php echo WORLD_MAX;?></span>
						<span id="zo">-<?php echo WORLD_MAX;?></span>
						<span id="zc">(0,0)</span>
						<div id="lijn_hor"></div>
						<div id="lijn_ver"></div>
					</div>

					<div style="top: 0px; left: 0px;" id="map_bg">
					<?php
					if($criteria != ""){				    
					    $artifactsEffect = ['-', VILLAGE_EFFECT, ACCOUNT_EFFECT, UNIQUE_EFFECT];
					    $array_tribe = ['-', TRIBE1, TRIBE2, TRIBE3, TRIBE4, TRIBE5, TRIBE6];
					    $q = "SELECT v.wref, v.owner, v.name, v.capital, v.pop, u.username, u.tribe, u.access, w.x, w.y".($includeSize ? ", a.size" : "")." FROM ".TB_PREFIX."vdata AS v LEFT JOIN ".TB_PREFIX."users AS u ON v.owner = u.id LEFT JOIN ".TB_PREFIX."wdata AS w ON v.wref = w.id  ".$criteria;
					    $player_info = $database->query_return($q);
					    
					    foreach($player_info as $p_array) {
					        $p_name = htmlspecialchars(mysqli_escape_string($database->dblink, $p_array['username']));
					        $p_village = htmlspecialchars(mysqli_escape_string($database->dblink, $p_array['name']));
					        $p_coor = "(".$p_array['x']."|".$p_array['y'].")";
					        $p_pop = $p_array['pop'];
                            $p_tribe = $array_tribe[$p_array['tribe']];
					        
					        $p_info ="<a href=\"?p=village&did=".$p_array['wref']."\" target=\"_blank\"><img src=\"../img/admin/map_".(isset($p_array['size']) ? "1".$p_array['size'] : ($p_array['access'] != ADMIN ? $p_array['tribe'] : 0)).".gif\" border=\"0\" onmouseout=\"med_closeDescription()\" onmousemove=\"med_mouseMoveHandler(arguments[0],'<ul class=\'p_info\'><li>Player name: <b>$p_name</b></li><li>Village name : <b>$p_village</b></li><li>Coordinate: <b>$p_coor</b></li><li>Population: <b>$p_pop</b></li><li>Tribe: <b>$p_tribe</b></li>".($check3 != "" && isset($p_array['size']) ? "<li>Artifact effect: <b>".$artifactsEffect[$p_array['size']]."</b></li>" : "")."</ul>')\"></a>";
					        
					        //245px = 0
					        $pixelDiv = 245;
					        $xdiv = $pixelDiv / WORLD_MAX;
					        if($p_array['x'] <= 0) $p_x = $pixelDiv - intval(abs($p_array['x']) * $xdiv); //-x
					        elseif($p_array['x'] >= 0) $p_x = $pixelDiv + intval(abs($p_array['x']) * $xdiv); //+x		
					        
					        if($p_array['y'] <= 0) $p_y = $pixelDiv + intval(abs($p_array['y']) * $xdiv); //-y			        
					        elseif($p_array['y'] >= 0) $p_y = $pixelDiv - intval(abs($p_array['y']) * $xdiv); //+y
					        
					        echo '<div style="left:'.$p_x.'px; top:'.$p_y.'px; position:absolute">'.$p_info.'</div>';
					    }
					}
					?>
					</div>
					
				</div>
				<div id="legenda">
					<div class="content">
						<h3>Legend</h3>
						<div id="items">
							<div class="first"></div>
							<table>
							<tr>
							<td><img src="../img/admin/map_1.gif" height="11" width="11"></td><td class="show"><?php echo TRIBE1;?></td>
							</tr>
							<tr>
							<td><img src="../img/admin/map_2.gif" height="11" width="11"></td><td class="show"><?php echo TRIBE2;?></td>
							</tr>
							<tr>
							<td><img src="../img/admin/map_3.gif" height="11" width="11"></td><td class="show"><?php echo TRIBE3;?></td>
							</tr>
							<tr>
							<td><img src="../img/admin/map_5.gif" height="11" width="11"></td><td class="show"><?php echo TRIBE5;?></td>
							</tr>
							<tr>
							<td><img src="../img/admin/map_0.gif" height="11" width="11"></td><td class="show">Multihunters</td>
							</tr>
							</table>		
						</div>
						
					</div>
				</div>

				<div id="legenda">
					<div class="content">
						<h3>Artifacts Legend</h3>
						<div id="items">
							<div class="first"></div>
							<table>
							<tr>
							<td><img src="../img/admin/map_11.gif" height="11" width="11"></td><td class="show"><?php echo VILLAGE_EFFECT;?></td>
							</tr>
							<tr>
							<td><img src="../img/admin/map_12.gif" height="11" width="11"></td><td class="show"><?php echo ACCOUNT_EFFECT;?></td>
							</tr>
							<tr>
							<td><img src="../img/admin/map_13.gif" height="11" width="11"></td><td class="show"><?php echo UNIQUE_EFFECT;?></td>
							</tr>
							</table>		
						</div>
						
					</div>
				</div>
			</div>