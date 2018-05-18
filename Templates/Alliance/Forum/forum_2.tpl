<?php
// ###########################################################
// # DO NOT REMOVE THIS NOTICE ##
// # MADE BY TTMTT ##
// # FIX BY RONIX ##
// # TRAVIANZ ##
// ###########################################################
if($session->access == BANNED){
	header("Location: banned.php");
	exit();
}

$opt = $database->getAlliPermissions($session->uid, $aid);
$displayarray = $database->getUserArray($session->uid, 1);
$forumcat = $database->ForumCat(htmlspecialchars($displayarray['alliance']));
$ally = $session->alliance;
$public = mysqli_fetch_array(mysqli_query($database->dblink, "SELECT Count(*) as Total FROM ".TB_PREFIX."forum_cat WHERE forum_area = 1"), MYSQLI_ASSOC);
$confederation = mysqli_fetch_array(mysqli_query($database->dblink, "SELECT Count(*) as Total FROM ".TB_PREFIX."forum_cat WHERE alliance = $ally AND forum_area = 2"), MYSQLI_ASSOC);
$alliance = mysqli_fetch_array(mysqli_query($database->dblink, "SELECT Count(*) as Total FROM ".TB_PREFIX."forum_cat WHERE alliance = $ally AND forum_area = 0"), MYSQLI_ASSOC);
$closed = mysqli_fetch_array(mysqli_query($database->dblink, "SELECT Count(*) as Total FROM ".TB_PREFIX."forum_cat WHERE alliance = $ally AND forum_area = 3"), MYSQLI_ASSOC);
$countArray = [$alliance['Total'], $public['Total'], $confederation['Total'], $closed['Total']];
$forumArea = ["Alliance Forum", "Public Forum", "Confederation Forum", "Closed Forum"];

foreach($countArray as $index => $count){
?>
<table cellpadding="1" cellspacing="1" id="public">
	<thead>
		<tr>
			<th colspan="4"><?php echo $forumArea[$index]; ?></th>
		</tr>

		<tr>
			<td></td>
			<td>Forum name</td>
			<td>&nbsp;Threads&nbsp;</td>
			<td>&nbsp;Last post&nbsp;</td>
		</tr>
	</thead>
	<tbody>
<?php
if($count == 0) echo "<tr><td colspan=\"4\" style=\"text-align: center\">".NO_FORUMS_YET."</td></tr>";

foreach($forumcat as $arr){
	if($arr['forum_area'] != $index) continue;
	
	$checkArray = ['aid' => $aid, 'alliance' => $arr['alliance'], 'forum_perm' => $opt['opt5'],
			'owner' => 0, 'admin' => $_GET['admin']];
	
	$countop = $database->CountCat($arr['id']);
	$lpost = $owner = "";
	if($countop > 0){
		$ltopic = $database->LastTopic($arr['id']);
		foreach($ltopic as $las){
			$lpos = $database->LastPost($las['id']);
			if($database->CheckLastTopic($arr['id'])){
				//If there are no posts yet, show the topic
				if($database->CheckLastPost($las['id']) == 0){
					$lpost = date('m/d/y H:i a', $las['date']);
					$owner = $database->getUserArray($las['owner'], 1);
				}else{
					foreach($lpos as $pos){
						$lpost = date('m/d/y H:i a', $pos['date']);
						$owner = $database->getUserArray($pos['owner'], 1);
					}
				}			
			}
		}
	}

	echo '<tr><td class="ico">';
	if(Alliance::canAct($checkArray)){
		echo '<a class="up_arr" href="allianz.php?s=2&fid='.$arr['id'].'&res=1&admin=pos" title="To top">
			<img src="img/x.gif" alt="To top" /></a><a class="edit" href="allianz.php?s=2&idf='.$arr['id'].'&admin=editforum" title="edit">
			<img src="img/x.gif" alt="edit" /></a><br /><a class="down_arr" href="allianz.php?s=2&fid='.$arr['id'].'&res=0&admin=pos" title="To bottom">
			<img src="img/x.gif" alt="To bottom" /></a><a class="fdel" href="allianz.php?s=2&idf='.$arr['id'].'&admin=delforum" onClick="return confirm(\'confirm delete?\');" title="delete">
			<img src="img/x.gif" alt="delete" /></a>';
	}
	else echo '<img class="folder" src="img/x.gif" title="Thread without new posts" alt="Thread without new posts">';

	echo '</td><td class="tit">
		<a href="allianz.php?s=2&fid='.$arr['id'].'&pid='.$aid.'" title="'.stripslashes($arr['forum_name']).'">'.stripslashes($arr['forum_name']).'</a><br />'.stripslashes($arr['forum_des']).'</td>
		<td class="cou">'.$countop.'</td>
		<td class="last">'.$lpost.'</span><span><br />';
	if(!empty($owner)){
		echo '<a href="spieler.php?uid='.$owner['id'].'">'.$owner['username'].'</a> <img class="latest_reply" src="img/x.gif" alt="Show last post" title="Show last post" />';
	}
	echo '</td>
		</tr>';
}
?>
		</tbody>
</table>
<?php } ?>
<p>
		<?php
		if(isset($opt['opt5']) && $opt['opt5'] == 1){
			echo '<a href="allianz.php?s=2&admin=newforum"><img id="fbtn_newforum" class="dynamic_img" src="img/x.gif" alt="New forum" /></a>
				<a href="allianz.php?s='.$ids.((isset($_GET['admin']) && !empty($_GET['admin']) && $_GET['admin'] == "switch_admin") ? "" : "&admin=switch_admin").'" title="Toggle Admin mode"><img class="switch_admin dynamic_img" src="img/x.gif" alt="Toggle Admin mode" /></a>';
		}
		?>
</p>