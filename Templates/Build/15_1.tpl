<?php
$ty=(isset($_GET['ty']))? $_GET['ty']:"";
if($_REQUEST["cancel"] == "1") {
if($session->access != BANNED){
    $database->delDemolition($village->wid);
    header("Location: build.php?gid=15&ty=$ty&cancel=0&demolish=0");
	exit;
}else{
	header("Location: banned.php");
	exit;
}
}

if(!empty($_REQUEST["demolish"]) && $_REQUEST["c"] == $session->mchecker) {
if($session->access != BANNED){
    if($_REQUEST["type"] != null) {
        $type = $_REQUEST['type'];
        $demolish_permitted = $database->addDemolition($village->wid,$type);
        if ($demolish_permitted === true) {
        	$session->changeChecker();
        	header("Location: build.php?gid=15&ty=$type&cancel=0&demolish=0");
        } else {
        	header("Location: build.php?gid=15&ty=$type&nodemolish=".$demolish_permitted);
        }
		exit;
    }
}else{
	header("Location: banned.php");
	exit;
}
}

if($village->resarray['f'.$id] >= DEMOLISH_LEVEL_REQ) {
    echo "<h2>".DEMOLITION_BUILDING."";
    $VillageResourceLevels = $database->getResourceLevel($village->wid);
    $DemolitionProgress = $database->getDemolition($village->wid);
    if (!empty($DemolitionProgress)) {
        $Demolition = $DemolitionProgress[0];
        echo "<b>";
        echo "<a href='build.php?id=".$_GET['id']."&ty=".$ty."&cancel=1'><img src='img/x.gif' class='del' title='".CANCEL."' alt='cancel'></a> ";
        echo "".DEMOLITION_OF." ".$building->procResType($VillageResourceLevels['f'.$Demolition['buildnumber'].'t']).": <span id=timer1>".$generator->getTimeFormat($Demolition['timetofinish']-time())."</span>";
            if($session->gold >= 2) {
            if($session->access!=BANNED){
            ?> <a href="?id=15&buildingFinish=1&ty=<?php echo $ty;?>" onclick="return confirm('Finish all construction and research orders in this village immediately for 2 Gold?');" title="<?php echo FINISH_GOLD; ?>"><img class="clock" alt="Finish all construction and research orders in this village immediately for 2 Gold?" src="img/x.gif"/></a>
            <?php
            }else{
            ?> <a href="banned.php" title="<?php echo FINISH_GOLD; ?>"><img class="clock" alt="Finish all construction and research orders in this village immediately for 2 Gold?" src="img/x.gif"/></a>
        <?php
            }
}
echo "</b>";
} else {
		if (isset($_GET['nodemolish'])) {
			switch ($_GET['nodemolish']) {
				case 18:
					echo '<p style="color: #ff0000; text-align: left">
					Because you are the founder of your alliance, demolition of a lvl 3 Embassy cannot be started.
					You can still <a href="allianz.php?s=5">quit the alliance</a>, while selecting a new leader
					in the &quot;quit alliance&quot; form.
					</p>';
					break;
			}
		}

        echo "
<form action=\"build.php?gid=15&amp;demolish=1&amp;cancel=0&amp;c=".$session->mchecker."\" method=\"POST\" style=\"display:inline\">
<select id=\"demolition_type\" name=\"type\" class=\"dropdown\">";
        for ($i=19; $i<=41; $i++) {
            $select=($i==$ty)? " SELECTED":"";
            if ($VillageResourceLevels['f'.$i] >= 1 && !$building->isCurrent($i) && !$building->isLoop($i)) {
                echo "<option value=".$i.$select.">".$i.". ".$building->procResType($VillageResourceLevels['f'.$i.'t'])." (lvl ".$VillageResourceLevels['f'.$i].")</option>";
            }
}
if ($village->natar==1) {
            $select=($ty==99)? " SELECTED":"";
            if ($VillageResourceLevels['f99'] >= 1 && !$building->isCurrent(99) && !$building->isLoop(99)) {
                echo "<option value=99".$select.">99. ".$building->procResType(40)." (lvl ".$VillageResourceLevels['f99'].")</option>";
            }
}
echo "</select><input id=\"btn_demolish\" name=\"demolish\" class=\"dynamic_img\" value=\"Demolish\" type=\"image\" src=\"img/x.gif\" alt=\"Demolish\" title=\"".DEMOLISH."\" onClick=\"javascript:return verify_demolition();\" /></form>";
}
}
?> 

<script type="text/javascript">
<!--
	function verify_demolition() {
		dType = document.getElementById('demolition_type');
		if (dType.options[dType.selectedIndex].text.indexOf('Embassy (lvl 3)') > -1) {
			// check if we really want to demolish a lvl 3 embassy
			if (!window.confirm('WARNING!\n'
				+ 'You are about to demolish an Embassy at lvl 3!\n\n'
				+ 'If you are the founder of your alliance and this is your last Embassy and your alliance has no additional members, the alliance will be deleted.\n\n'
				+ 'Click OK to confirm or Cancel to stop.')) {
				return false;
			}
		} else if (dType.options[dType.selectedIndex].text.indexOf('Embassy (lvl 1)') > -1) {
			// check if we really want to demolish a lvl 1 embassy
			if (!window.confirm('WARNING!\n'
				+ 'You are about to demolish an Embassy at lvl 1!\n\n'
				+ 'If you are in an alliance and this is your last Embassy in game, you will automatically quit that alliance when the demolition is complete.\n\n'
				+ 'Click OK to confirm or Cancel to stop.')) {
				return false;
			}
		}
		
		return true;
	}
//-->
</script>