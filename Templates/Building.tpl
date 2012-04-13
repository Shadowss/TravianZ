<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Building.tpl                                                ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>

<table cellpadding="1" cellspacing="1" id="building_contract">
		<thead><tr>
        <th colspan="4"><?php echo BUILDING_UPGRADING;?>
			<?php
            
            if($session->gold >= 2) {
            ?> <a href="?buildingFinish=1" onclick="return confirm('<?php echo FINISH_GOLD; ?>');" title="<?php echo FINISH_GOLD; ?>"><img class="clock" alt="<?php echo FINISH_GOLD; ?>" src="img/x.gif"/></a>
		<?php
            }
            ?>
            </th>
		</tr></thead>
		<tbody>
        <?php 
        if($_GET['buildingFinish'] == 1 AND $session->gold >= 2) {
		if($session->access!=BANNED){
        	$gold=$database->getUserField($_SESSION['username'],'gold','username');
		      $gold-=2;
		      $database->updateUserField($_SESSION['username'],'gold',$gold,0);
        }else{
		header("Location: banned.php");
		}
		}
        
        if(!isset($timer)) {
        $timer = 1;
        }
		$BuildingList = array();
        foreach($building->buildArray as $jobs) {
        	echo "<tr><td class=\"ico\"><a href=\"?d=".$jobs['id']."&a=0&c=$session->checker\">";
            echo "<img src=\"img/x.gif\" class=\"del\" title=\"".CANCEL."\" alt=\"".CANCEL."\" /></a></td><td>";
			echo $building->procResType($jobs['type']).$lang['buildings'][44].($village->resarray['f'.$jobs['field']]+(in_array($jobs['field'],$BuildingList)?2:1 )).")";
			if($jobs['loopcon'] == 0) { $BuildingList[] = $jobs['field']; }
            if($jobs['loopcon'] == 1) {
            	echo "&nbsp;".WAITING_LOOP;
            }
            echo "</td><td><span id=\"timer".$timer."\">";
            echo $generator->getTimeFormat($jobs['timestamp']-time());
            echo "</span>&nbsp;".HRS."</td>";
            echo "<td>".DONE_AT."&nbsp;".date('H:i', $jobs['timestamp'])."</td></tr>";
            $timer +=1;
      	}
        ?>
            </tbody>
	</table>
	<script type="text/javascript">var bld=[{"stufe":1,"gid":"1","aid":"3"}]</script>
