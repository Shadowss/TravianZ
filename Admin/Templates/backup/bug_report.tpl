<?php
$database->BugReportSetViewed();
?>
<table cellpadding="1" cellspacing="1" id="player">
	<thead>
				<tr>
					<th colspan="10">Bug report</th>
				</tr>
		<tr><td></td><td>Player</td><td>Page</td><td>Report</td><td>Time</td><td>IP</td><td></td></tr>
		</thead><tbody>  
        <?php
        $bug = $database->BugReport();
               
        if(count($bug)>0) {  
        for ($i = 0; $i < count($bug); $i++) {           
        if($bug[$i]==0){
        $del = "<td></td>";
        }else{
        $del = '<td ><a href="?delete='.$bug[$i]['id'].'&where=bug_report"><img src="img/x.gif" class="del" title="cancel" alt="cancel"></a></td>';
        }
        	          $id = $i+1;
                    echo "<tr><td class=\"ra \" >".$id.".</td>";                   
                    echo "<td><a href=\"?uid=".$bug[$i]['user']."\">".$database->getUserField($bug[$i]['user'],'username',0)."</a></td>"; 
                    echo "<td>".$bug[$i]['page']."</td>"; 
                    echo "<td>".$bug[$i]['report']."</td>"; 
                    echo "<td class=\"vil\">".date("H:i d.m.y",$bug[$i]['time'])."</td>";
                    echo "<td>".$bug[$i]['ip']."</td>";
                    echo $del;
                    echo "</tr>";
              }       

        }
                else {
        	echo "<tr><td class=\"none\" colspan=\"7\">No bug report</td></tr>";
        }
        ?>
 </tbody>
</table>

