<?php
if(!is_numeric($_SESSION['search'])) {
?>
	<center><font color=orange size=2><p class=\"error\">The village <b>"<?php echo $_SESSION['search']; ?>"</b> does not exist.</p></font></center>
<?php
    $search = 0;
}
else $search = $_SESSION['search'];
?>
<table cellpadding="1" cellspacing="1" id="villages" class="row_table_data">
			<thead>
				<tr>
					<th colspan="5">
						The largest villages								    
					</th>
				</tr>
		<tr><td></td><td>Village</td><td>Player</td><td>Inhabitants</td><td>Coordinates</td></tr>
		</thead><tbody>  
         <?php
         $rankArray = $ranking->getRank();
         if(isset($_GET['rank'])){
             $multiplier = 1;
             if(is_numeric($_GET['rank'])) {
                 if($_GET['rank'] > count($rankArray)) {
                     $_GET['rank'] = count($rankArray) - 1;
                 }
                 
                 while($_GET['rank'] > (20*$multiplier)) $multiplier++;
                 
                 $start = 20 * $multiplier - 19;
             } 
             else $start = ($_SESSION['start'] + 1);
         } 
         else $start = ($_SESSION['start'] + 1);         
         
         if(count($rankArray) > 1) {
             for($i = $start; $i < $start + 20; $i++) {
                 if(isset($rankArray[$i]['wref']) && $rankArray[$i] != "pad") {
                     if($i == $search) echo "<tr class=\"hl\"><td class=\"ra fc\" >";
                     else echo "<tr><td class=\"ra \" >";
                     
                     echo $i.".</td><td class=\"vil \" ><a href=\"karte.php?d=".$rankArray[$i]['wref']."&amp;c=".$generator->getMapCheck($rankArray[$i]['wref'])."\">".$rankArray[$i]['name']."</a></td>";
                     echo "<td class=\"pla \" ><a href=\"spieler.php?uid=".$rankArray[$i]['owner']."\">".$rankArray[$i]['user']."</a></td>";
                     echo "<td class=\"hab\">".$rankArray[$i]['pop']."</td><td class=\"aligned_coords \" ><div class=\"cox\">(".$rankArray[$i]['x']."</div><div class=\"pi\">|</div><div class=\"coy\">".$rankArray[$i]['y'].")</div></td></tr>";
                 }
             }
         }
         else echo "<td class=\"none\" colspan=\"5\">No villages found</td>";
		 ?>
 </tbody>
</table>
<?php
include("ranksearch.tpl");
?>
