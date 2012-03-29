<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       deletion.tpl                                                ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<?php
$id = $_GET['uid'];
if(isset($id)){        
$user = $database->getUserArray($id,1);    
$varray = $database->getProfileVillages($id);
$varmedal = $database->getProfileMedal($id);
?>
<br />
<form action="../GameEngine/Admin/Mods/editUser.php" method="POST">
    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
<table id="profile" cellpadding="1" cellspacing="1" >
    <thead>
    <tr>
        <th colspan="2">Player <a href="admin.php?p=player&uid=<?php echo $user['id'];?>"><?php echo $user['username'];?></a></th>
    </tr>                                       
    <tr>
        <td>Details</td>
        <td>Description</td>
    </tr>
    </thead><tbody>
    <tr>
        <td class="empty"></td><td class="empty"></td>
    </tr>
    <tr>
        <td class="details">
            <table cellpadding="0" cellspacing="0">
            <tr><th>Tribe</th>
                <td><select name="tribe">
				<option value="1" <?php if($user['tribe'] == 1) { echo "selected='selected'"; } else { echo ''; } ?>>Roman</option>
				<option value="2" <?php if($user['tribe'] == 2) { echo "selected='selected'"; } else { echo ''; } ?>>Teuton</option>
				<option value="3" <?php if($user['tribe'] == 3) { echo "selected='selected'"; } else { echo ''; } ?>>Gaul</option>
				</select></td>
            </tr>
            <?php                    
            echo "<tr><th>Location</th><td><input class=\"fm\" name=\"location\" value=\"".$user['location']."\"></td></tr>";
            echo "<tr><th>Email</th><td><input class=\"fm\" name=\"email\" value=\"".$user['email']."\"></td></tr>";
            echo '<tr><td colspan="2" class="empty"></td></tr>';
            echo '<tr><td colspan="2"><a href="?p=player&uid='.$user['id'].'"><span class="rn2" >&raquo;</span> Go back</a></td></tr>';
			echo '<tr><td colspan="2" class="empty"></td></tr>';
            echo '<tr><td colspan="2" class="desc2"><textarea cols="25" rows="14" tabindex="1" name="desc1">'.nl2br($user['desc1']).'</textarea></td></tr>';
            ?>      


            </table>
        </td>
        <td class="desc1">
		<textarea tabindex="8" cols="30" rows="20" name="desc2"><?php echo nl2br($user['desc2']); ?></textarea>
        </td>
    </tr>
	<tr><td colspan="2" class="empty"></td></tr>
    </tbody>
</table>

<p>
		<table cellspacing="1" cellpadding="2" class="tbg">
		<tr><td class="rbg" colspan="4">Medals</td></tr>
		<tr>
			<td>Category</td>
			<td>Rang</td>
			<td>Week</td>
			<td>BB-Code</td>
		</tr>
				<?php
/******************************
INDELING CATEGORIEEN:
===============================
== 1. Aanvallers top 10      ==
== 2. Defence top 10         ==
== 3. Klimmers top 10        ==
== 4. Overvallers top 10     ==
== 5. In att en def tegelijk ==
== 6. in top 3 - aanval      ==
== 7. in top 3 - verdediging ==
== 8. in top 3 - klimmers    ==
== 9. in top 3 - overval     ==
******************************/				
				
				
	foreach($varmedal as $medal) {
	$titel="Bonus";
	switch ($medal['categorie']) {
    case "1":
        $titel="Attacker of the Week";
        break;
    case "2":
        $titel="Defender of the Week";
        break;
    case "3":
        $titel="Climber of the week";
        break;
    case "4":
        $titel="Robber of the week";
        break;
	}			
				 echo"<tr>
				   <td> ".$titel."</td>
				   <td>".$medal['plaats']."</td>
				   <td>".$medal['week']."</td>
				   <td>[#".$medal['id']."]</td>
			 	 </tr>";
				 } ?>
				 <tr>
				   <td>Beginners Protection</td>
				   <td></td>
				   <td></td>
				   <td>[#0]</td>
			 	 </tr>
				 </table></p>
				 
				 
	<center><button>OK</button></p>
    </center></form>
<?php } ?>