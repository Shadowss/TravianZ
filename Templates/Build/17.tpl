<div id="build" class="gid17"><a href="#" onClick="return Popup(17,4);" class="build_logo"> 
	<img class="building g17" src="img/x.gif" alt="Marketplace" title="Marketplace" /> 
</a> 
<h1>Marketplace <span class="level">level <?php echo $village->resarray['f'.$id]; ?></span></h1> 
<p class="build_desc">At the Marketplace you can trade resources with other players. The higher its level, the more resources can be transported at the same time.
</p> 
 
<?php include("17_menu.tpl"); ?>

<script language="JavaScript"> 
<!--
var haendler = <?php echo $market->merchantAvail(); ?>;
var carry = <?php echo $market->maxcarry; ?>;
//-->
</script><form method="POST" name="snd" action="build.php"> 
<input type="hidden" name="ft" value="mk1">
<input type="hidden" name="id" value="<?php echo $id; ?>"> 
<table id="send_select" class="send_res" cellpadding="1" cellspacing="1"><tr> 
		<td class="ico"> 
			<a href="#" onClick="upd_res(1,1); return false;"><img class="r1" src="img/x.gif" alt="Lumber" title="Lumber" /></a> 
		</td> 
		<td class="nam"> 
			Lumber:
		</td> 
		<td class="val"> 
			<input class="text" type="text" name="r1" id="r1" value="" maxlength="5" onKeyUp="upd_res(1)" tabindex="1"> 
		</td> 
		<td class="max"> 
			<a href="#" onMouseUp="add_res(1);" onClick="return false;">(<?php echo $market->maxcarry; ?>)</a> 
		</td> 
	</tr><tr> 
		<td class="ico"> 
			<a href="#" onClick="upd_res(2,1); return false;"><img class="r2" src="img/x.gif" alt="Clay" title="Clay" /></a> 
		</td> 
		<td class="nam"> 
			Clay:
		</td> 
		<td class="val"> 
			<input class="text" type="text" name="r2" id="r2" value="" maxlength="5" onKeyUp="upd_res(2)" tabindex="2"> 
		</td> 
		<td class="max"> 
			<a href="#" onMouseUp="add_res(2);" onClick="return false;">(<?php echo$market->maxcarry; ?>)</a> 
		</td> 
	</tr><tr> 
		<td class="ico"> 
			<a href="#" onClick="upd_res(3,1); return false;"><img class="r3" src="img/x.gif" alt="Iron" title="Iron" /></a> 
		</td> 
		<td class="nam"> 
			Iron:
		</td> 
		<td class="val"> 
			<input class="text" type="text" name="r3" id="r3" value="" maxlength="5" onKeyUp="upd_res(3)" tabindex="3"> 
		</td> 
		<td class="max"> 
			<a href="#" onMouseUp="add_res(3);" onClick="return false;">(<?php echo $market->maxcarry; ?>)</a> 
		</td> 
	</tr><tr> 
		<td class="ico"> 
			<a href="#" onClick="upd_res(4,1); return false;"><img class="r4" src="img/x.gif" alt="Crop" title="Crop" /></a> 
		</td> 
		<td class="nam"> 
			Crop:
		</td> 
		<td class="val"> 
			<input class="text" type="text" name="r4" id="r4" value="" maxlength="5" onKeyUp="upd_res(4)" tabindex="4"> 
		</td> 
		<td class="max"> 
			<a href="#" onMouseUp="add_res(4);" onClick="return false;">(<?php echo $market->maxcarry; ?>)</a> 
		</td> 
	</tr></table> 
 
<table id="target_select" class="res_target" cellpadding="1" cellspacing="1"> 
	<tr> 
		<td class="mer">Merchants <?php echo $market->merchantAvail(); ?>/<?php echo $market->merchant; ?></td> 
	</tr> 
	<tr> 
		<td class="vil"> 
			<span>Villages:</span> 
			<input class="text" type="text" name="dname" value="" maxlength="20" tabindex="5"> 
		</td> 
	<tr> 
		<td class="or">or</td> 
	</tr> 
   <tr> 
<?php
if(isset($_GET['z'])){
$coor = $database->getCoor($_GET['z']);
}
else{
$coor['x'] = "";
$coor['y'] = "";
}
?>
      <td class="coo"> 
         <span>X:</span><input class="text" type="text" name="x" value="<?php echo $coor['x']; ?>" maxlength="4" tabindex="6"> 
         <span>Y:</span><input class="text" type="text" name="y" value="<?php echo $coor['y']; ?>" maxlength="4" tabindex="7"> 
      </td> 
   </tr> 
</table> 
<div class="clear"></div><p><input type="image" value="ok" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" tabindex="8" alt="OK" <?php if(!$market->merchantAvail()) { echo "DISABLED"; }?>/></form></p><script language="JavaScript" type="text/javascript"> 
//<!--
document.snd.r1.focus();
//-->
</script>
<p>Each merchant can carry <b><?php echo $market->maxcarry; ?></b> units of resource</p>
<?php
$timer = 1;
if(count($market->recieving) > 0) { 
echo "<h4>Merchants coming:</h4>";
    foreach($market->recieving as $recieve) {
       echo "<table class=\"traders\" cellpadding=\"1\" cellspacing=\"1\">";
	$villageowner = $database->getVillageField($recieve['from'],"owner");
	echo "<thead><tr><td><a href=\"spieler.php?uid=$villageowner\">".$database->getUserField($villageowner,"username",0)."</a></td>";
    echo "<td><a href=\"karte.php?d=".$recieve['from']."&c=".$generator->getMapCheck($recieve['from'])."\">Transport from ".$database->getVillageField($recieve['from'],"name")."</a></td>";
    echo "</tr></thead><tbody><tr><th>Arrival in</th><td>";
    echo "<div class=\"in\"><span id=timer$timer>".$generator->getTimeFormat($recieve['endtime']-time())."</span> h</div>";
    $datetime = $generator->procMtime($recieve['endtime']);
    echo "<div class=\"at\">";
    if($datetime[0] != "today") {
    echo "on ".$datetime[0]." ";
    }
    echo "at ".$datetime[1]."</div>";
    echo "</td></tr></tbody> <tr class=\"res\"> <th>Resource</th> <td colspan=\"2\"><span class=\"f10\">";
    echo "<img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" />".$recieve['wood']." | <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$recieve['clay']." | <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$recieve['iron']." | <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$recieve['crop']."</td></tr></tbody>";
    echo "</table>";
    $timer +=1;
    }
}
if(count($market->sending) > 0) {
	echo "<h4>Own merchants on the way:</h4>";
    foreach($market->sending as $send) {
        $villageowner = $database->getVillageField($send['to'],"owner");
        $ownername = $database->getUserField($villageowner,"username",0);
        echo "<table class=\"traders\" cellpadding=\"1\" cellspacing=\"1\">";
        echo "<thead><tr> <td><a href=\"spieler.php?uid=$villageowner\">$ownername</a></td>";
        echo "<td><a href=\"karte.php?d=".$send['to']."&c=".$generator->getMapCheck($send['to'])."\">Transport to ".$database->getVillageField($send['to'],"name")."</a></td>";
        echo "</tr></thead> <tbody><tr> <th>Arrival in</th> <td>";
        echo "<div class=\"in\"><span id=timer".$timer.">".$generator->getTimeFormat($send['endtime']-time())."</span> h</div>";
        $datetime = $generator->procMtime($send['endtime']);
        echo "<div class=\"at\">";
        if($datetime[0] != "today") {
        echo "on ".$datetime[0]." ";
        }
        echo "at ".$datetime[1]."</div>";
        echo "</td> </tr> <tr class=\"res\"> <th>Resource</th><td>";
        echo "<img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" />".$send['wood']." | <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$send['clay']." | <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$send['iron']." | <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$send['crop']."</td></tr></tbody>";
        echo "</table>";
        $timer += 1;
    }
}
if(count($market->return) > 0) {
	echo "<h4>Merchants returning:</h4>";
    foreach($market->return as $return) {
        $villageowner = $database->getVillageField($return['from'],"owner");
        $ownername = $database->getUserField($villageowner,"username",0);
        echo "<table class=\"traders\" cellpadding=\"1\" cellspacing=\"1\">";
        echo "<thead><tr> <td><a href=\"spieler.php?uid=$villageowner\">$ownername</a></td>";
        echo "<td><a href=\"karte.php?d=".$return['from']."&c=".$generator->getMapCheck($return['from'])."\">Return from ".$database->getVillageField($return['from'],"name")."</a></td>";
        echo "</tr></thead> <tbody><tr> <th>Arrival in</th> <td>";
        echo "<div class=\"in\"><span id=timer".$timer.">".$generator->getTimeFormat($return['endtime']-time())."</span> h</div>";
        $datetime = $generator->procMtime($return['endtime']);
        echo "<div class=\"at\">";
        if($datetime[0] != "today") {
        echo "on ".$datetime[0]." ";
        }
        echo "at ".$datetime[1]."</div>";
        echo "</td> </tr>";
        echo "</tbody></table>";
        $timer += 1;
    }
}
include("upgrade.tpl");
?>
</p></div> 
