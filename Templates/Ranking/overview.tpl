<?php
if(!is_numeric($_SESSION['search'])) {
	echo "<p class=\"error\">The user <b>".$_SESSION['search']."</b> does not exist.</p>";
    $search = 0;
}
else {
$search = $_SESSION['search'];
}
?>
<table cellpadding="1" cellspacing="1" id="player">
	<thead>
				<tr>
					<th colspan="5">
                        The largest players                    <div id="submenu"><a title="Top 10" href="statistiken.php?id=7"><img class="btn_top10" src="img/x.gif" alt="Top 10" /></a><a title="defender" href="statistiken.php?id=32"><img class="btn_def" src="img/x.gif" alt="defender" /></a><a title="attacker" href="statistiken.php?id=31"><img class="btn_off" src="img/x.gif" alt="attacker" /></a></div><br><div id="submenu2"><a title="Romans" href="statistiken.php?id=11"><img class="btn_v1" src="img/x.gif" alt="attacker"></a><a title="Teutons" href="statistiken.php?id=12"><img class="btn_v2" src="img/x.gif" alt="attacker"></a><a title="Gauls" href="statistiken.php?id=13"><img class="btn_v3" src="img/x.gif" alt="attacker"></a></div>            
                    </th>
				</tr>
		<tr><td></td><td>Player</td><td>Alliance</td><td>Population</td><td>Villages</td></tr>
		</thead><tbody>  
        <?php
        if(isset($_GET['rank'])){
		$multiplier = 1;
			if(is_numeric($_GET['rank'])) {
				if($_GET['rank'] > count($ranking->getRank())) {
				$_GET['rank'] = count($ranking->getRank())-1;
				}
				while($_GET['rank'] > (20*$multiplier)) {
					$multiplier +=1;
				}
			$start = 20*$multiplier-19;
			} else { $start = ($_SESSION['start']+1); }
		} else { $start = ($_SESSION['start']+1); }
        if(count($ranking->getRank()) > 0) {
        	$ranking = $ranking->getRank();
            for($i=$start;$i<($start+20);$i++) {
            	if(isset($ranking[$i]['username']) && $ranking[$i] != "pad") {
                	if($i == $search) {
                    echo "<tr class=\"hl\"><td class=\"ra fc\" >";
                    }
                    else {
                    echo "<tr><td class=\"ra \" >";
                    }
                    echo $i.".</td><td class=\"pla \" >";
						if($ranking[$i]['access'] > 2){
						echo"<u><a href=\"spieler.php?uid=".$ranking[$i]['userid']."\">".$ranking[$i]['username']."</a></u>";
						} else {
						echo"<a href=\"spieler.php?uid=".$ranking[$i]['userid']."\">".$ranking[$i]['username']."</a>";
						}
					echo"</td><td class=\"al\" >";
                    if($ranking[$i]['aname'] != "") {
                    echo "<a href=\"allianz.php?aid=".$ranking[$i]['alliance']."\">".$ranking[$i]['aname']."</a>";
                    }
                    else {
                    echo "-";
                    }
                    echo "</td><td class=\"pop\" >".$ranking[$i]['totalpop']."</td><td class=\"vil\">".$ranking[$i]['totalvillage']."</td></tr>";
                }
            }
        }
        else {
        	echo "<td class=\"none\" colspan=\"5\">No users found</td>";
        }
        ?>
 </tbody>
</table>
<?php
include("ranksearch.tpl");
?>
