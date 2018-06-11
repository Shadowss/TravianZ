<?php
// ###########################################################
// # DO NOT REMOVE THIS NOTICE ##
// # MADE BY TTMTT ##
// # FIX BY RONIX ##
// # TRAVIANZ ##
// ###########################################################

$opt = $database->getAlliPermissions($session->uid, $aid);
$displayarray = $database->getUserArray($session->uid, 1);
$forumcat = $database->ForumCat(htmlspecialchars($displayarray['alliance']));
$forumcat = array_merge(!empty($forumcat) ? $forumcat : [], 
						$session->sharedForums['alliance'],
						$session->sharedForums['confederation'], 
						$session->sharedForums['closed']);

$countArray = [$database->countForums(0, $session->alliance) + count($session->sharedForums['alliance']), 
			   $database->countForums(1, -1),
			   $database->countForums(2, $session->alliance) + count($session->sharedForums['confederation']), 
			   $database->countForums(3, $session->alliance) + count($session->sharedForums['closed'])];

$forumArea = ["Alliance Forum(s)", "Public Forum(s)", "Confederation Forum(s)", "Closed Forum(s)"];

foreach($countArray as $index => $count){
	if($session->alliance > 0 || ($session->alliance == 0 && $index == 1)){
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
	}
foreach($forumcat as $arr){
	if($arr['forum_area'] != $index || ($session->alliance == 0 && $arr['forum_area'] != 1)) continue;
	
	$checkArray = ['aid' => $aid, 'alliance' => $arr['alliance'], 'forum_perm' => $opt['opt5'],
			'owner' => $arr['owner'], 'admin' => $_GET['admin'], 'forum_owner' => $arr['owner']];
	
	$countop = $database->CountCat($arr['id']);
	$lpost = $owner = "";
	if($countop > 0){
		$ltopic = $database->LastTopic($arr['id']);
		foreach($ltopic as $las){
			$lpos = $database->LastPost($las['id']);
			if($database->CheckLastTopic($arr['id'])){
				//If there are no posts yet, show the topic
				if($database->CheckLastPost($las['id']) == 0){
					$lpost = date('d.m.y H:i a', $las['date']);
					$owner = $database->getUserArray($las['owner'], 1);
				}else{
					foreach($lpos as $pos){
						$lpost = date('d.m.y H:i a', $pos['date']);
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
if(isset($opt['opt5']) && $opt['opt5'] == 1 || $session->access == ADMIN){
	echo '<a href="allianz.php?s=2&admin=newforum"><img id="fbtn_newforum" class="dynamic_img" src="img/x.gif" alt="New forum" /></a>';
	echo '<a href="allianz.php?s='.$ids.((isset($_GET['admin']) && !empty($_GET['admin']) && $_GET['admin'] == "switch_admin") ? "" : "&admin=switch_admin").'" title="Toggle Admin mode"><img class="switch_admin dynamic_img" src="img/x.gif" alt="Toggle Admin mode" /></a>';
}
?>
</p>