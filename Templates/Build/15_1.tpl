<?php

if($_REQUEST["cancel"] == "1") {
	$database->delDemolition($village->wid);
	header("Location: build.php?gid=15&amp;cancel=0&amp;demolish=0");
}

if(!empty($_REQUEST["demolish"]) && $_REQUEST["c"] == $session->mchecker) {
	if($_REQUEST["type"] != null) 	{
		$type = $_REQUEST['type'];
		$database->addDemolition($village->wid,$type);
		$session->changeChecker();
		header("Location: build.php?gid=15&amp;cancel=0&amp;demolish=0");
	}
}

if($village->resarray['f'.$id] >= DEMOLISH_LEVEL_REQ) {
	echo "<h2>Demolition of the building:</h2><p>If you no longer need a building, you can order the demolition of the building.</p>";
	$VillageResourceLevels = $database->getResourceLevel($village->wid);
	$DemolitionProgress = $database->getDemolition($village->wid);
	if (!empty($DemolitionProgress)) {
		$Demolition = $DemolitionProgress[0];
		echo "<b>";
		echo "<a href='build.php?id=26&cancel=1'><img src='img/x.gif' class='del' title='cancel' alt='cancel'></a> ";
		echo "Demolition of ".$building->procResType($VillageResourceLevels['f'.$Demolition['buildnumber'].'t']).": <span id=timer1>".$generator->getTimeFormat($Demolition['timetofinish']-time())."</span>";
		echo "</b>";
	} else {
		echo "
		<form action=\"build.php?gid=15&amp;demolish=1&amp;cancel=0&amp;c=".$session->mchecker."\" method=\"POST\" style=\"display:inline\">
		<select name=\"type\" class=\"dropdown\">";
		for ($i=19; $i<=41; $i++) {
			if ($VillageResourceLevels['f'.$i] >= 1 && !$building->isCurrent($i) && !$building->isLoop($i)) {
				echo "<option value=".$i.">".$i.". ".$building->procResType($VillageResourceLevels['f'.$i.'t'])." (lvl ".$VillageResourceLevels['f'.$i].")</option>";
			}
		}
		echo "</select><input id=\"btn_demolish\" name=\"demolish\" class=\"dynamic_img\" value=\"Demolish\" type=\"image\" src=\"img/x.gif\" alt=\"Demolish\" title=\"Demolish\" /></form>";
	}
}
?>
