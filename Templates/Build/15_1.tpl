<?php
$ty = (isset($_GET['ty']))? $_GET['ty']:"";
if(isset($_REQUEST["cancel"]) && $_REQUEST["cancel"] == "1") {
    $database->delDemolition($village->wid);
    header("Location: build.php?gid=15&ty=$ty&cancel=0&demolish=0");
	exit;
}

if($session->alliance) $memberCount = $database->countAllianceMembers($session->alliance);
else $memberCount = 0;

if(!empty($_REQUEST["demolish"]) && $_REQUEST["c"] == $session->mchecker) {
    if($_REQUEST["type"] != null && ($_REQUEST["type"] >= 19 && $_REQUEST["type"] <= 40 || $_REQUEST["type"] == 99)) {
        $type = $_REQUEST['type'];
        $demolish_permitted = $database->addDemolition($village->wid,$type);
        if ($demolish_permitted === true) {
            $session->changeChecker();
            header("Location: build.php?gid=15&ty=$type&cancel=0&demolish=0");
        } 
        else header("Location: build.php?gid=15&ty=$type&nodemolish=".$demolish_permitted);
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
            ?> 
            <a href="?id=15&buildingFinish=1&ty=<?php echo $ty;?>" onclick="return confirm('Finish all construction and research orders in this village immediately for 2 Gold?');" title="<?php echo FINISH_GOLD; ?>"><img class="clock" alt="Finish all construction and research orders in this village immediately for 2 Gold?" src="img/x.gif"/></a>
            <?php
}
echo "</b>";
} else {
		if (isset($_GET['nodemolish'])) {
			switch ($_GET['nodemolish']) {
				case 18:
					echo '<p style="color: #ff0000; text-align: left">
					Because you are the leader of your alliance, demolition of your current Embassy cannot be started,
					since it still holds all of your <b>'.$memberCount.'</b> alliance members.
					You can, however <a href="allianz.php?s=5">quit the alliance</a>, while selecting a new leader
					in the &quot;quit alliance&quot; form, then continue the demolition.
					</p>';
					break;
			}
		}

        echo "
<form action=\"build.php?gid=15&amp;demolish=1&amp;cancel=0&amp;c=".$session->mchecker."\" method=\"POST\" style=\"display:inline\">
<select id=\"demolition_type\" name=\"type\" class=\"dropdown\">";
        for ($i=19; $i<=41; $i++) {
            $select=($i==$ty)? " SELECTED":"";
            if (isset($VillageResourceLevels['f'.$i]) && $VillageResourceLevels['f'.$i] >= 1 && !$building->isCurrent($i) && !$building->isLoop($i)) {
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
		var dType    = document.getElementById('demolition_type');
		var warnLvl3 = <?php
			if (
				$session->alliance &&
				$database->isAllianceOwner($session->uid) == $session->alliance &&
				// don't show the OK/Cancel warning if we have more members, since
				// that will be handled by the returned value
				$memberCount == 1 &&
				$database->getSingleFieldTypeCount($session->uid, 18, '>=', 3) == 1
			) {
				echo 'true';
			} else {
				echo 'false';
			}
		?>;
		var warnLvl1 = <?php
			if ($session->alliance && $database->getSingleFieldTypeCount($session->uid, 18, '>=', 1) == 1) {
				echo 'true';
			} else {
				echo 'false';
			}
		?>;

		if (warnLvl3 && dType.options[dType.selectedIndex].text.indexOf('Embassy (lvl 3)') > -1) {
			// check if we really want to demolish a lvl 3 embassy
			if (!window.confirm('WARNING!\n'
				+ 'You are about to demolish the last lvl3 Embassy!\n\n'
				+ 'Since you are the leader of your alliance and because there are no additional members left, the alliance will be disbanded once the demolition completes.\n\n'
				+ 'After that happens, you can found a new alliance or join one that already exists.\n\n'
				+ 'Click OK to confirm or Cancel to stop.')) {
				return false;
			}
		} else if (warnLvl1 && dType.options[dType.selectedIndex].text.indexOf('Embassy (lvl 1)') > -1) {
			// check if we really want to demolish a lvl 1 embassy
			if (!window.confirm('WARNING!\n'
				+ 'You are about to demolish your last Embassy!\n\n'
				+ 'Since you are in an alliance, you will automatically quit that alliance once the demolition completes.\n\n'
				+ 'After that happens, you can found or join an alliance again.\n\n'
				+ 'Click OK to confirm or Cancel to stop.')) {
				return false;
			}
		}
		
		return true;
	}
//-->
</script>