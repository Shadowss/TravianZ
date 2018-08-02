<?php
if(!is_numeric($_SESSION['search'])) {
?>
	<center><font color=orange size=2><p class=\"error\">The alliance <b>"<?php echo $_SESSION['search']; ?>"</b> does not exist.</p></font></center>
<?php
    $search = 0;
}
else $search = $_SESSION['search'];
?>
<table cellpadding="1" cellspacing="1" id="alliance" class="row_table_data">
			<thead>
				<tr>
					<th colspan="5">
						The largest alliances						<div id="submenu"><a title="Top 10" href="statistiken.php?id=43"><img class="btn_top10" src="img/x.gif" alt="Top 10"></a><a title="defender" href="statistiken.php?id=42"><img class="btn_def" src="img/x.gif" alt="defender"></a><a title="attacker" href="statistiken.php?id=41"><img class="btn_off" src="img/x.gif" alt="attacker"></a></div>		    
					</th>
				</tr>
		<tr><td></td><td>Alliance</td><td>Player</td><td>&Oslash;</td><td>Points</td></tr>
		</thead><tbody>  
        <?php
        $rankArray = $ranking->getRank();
        if(isset($_GET['rank'])){
            $multiplier = 1;
            if(is_numeric($_GET['rank'])) {
                if($_GET['rank'] > count($rankArray)) {
                    $_GET['rank'] = count($rankArray) - 1;
                }
                
                while($_GET['rank'] > (20*$multiplier))  $multiplier++;

                $start = 20 * $multiplier - 19;
            }
            else $start = ($_SESSION['start'] + 1);
        } 
        else $start = ($_SESSION['start'] + 1);

        if(count($rankArray) > 1) {
            for($i = $start; $i < $start + 20; $i++) {
                if(isset($rankArray[$i]['name']) && $rankArray[$i] != "pad") {
                    if($i == $search) echo "<tr class=\"hl\"><td class=\"ra fc\" >";
                    else echo "<tr><td class=\"ra \" >";

                    echo $i.".</td><td class=\"al \" ><a href=\"allianz.php?aid=".$rankArray[$i]['id']."\">".$rankArray[$i]['tag']."</a></td><td class=\"pla \" >";
                    echo $rankArray[$i]['players']."</td><td class=\"av \" >".$rankArray[$i]['avg']."</td><td class=\"po \">".$rankArray[$i]['totalpop']."</td></tr>";
                }
            }
        }
        else echo "<td class=\"none\" colspan=\"5\">No alliances found</td>";
        ?>
 </tbody>
</table>
<?php
include("ranksearch.tpl");
?>