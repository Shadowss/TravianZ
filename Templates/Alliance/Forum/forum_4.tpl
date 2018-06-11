<?php
############################################################
##              DO NOT REMOVE THIS NOTICE                 ##
##                    MADE BY TTMTT                       ##
##                     FIX BY RONIX                       ##
##                       TRAVIANZ                         ##
############################################################

$cat_id = $_GET['fid'];
$forumInfo = $database->ForumCatEdit($cat_id);

//Check if we're viewing a valid forum
if(empty($forumInfo)) $alliance->redirect($_GET);

$forumData = reset($forumInfo);
$CatName = stripslashes($forumData['forum_name']);

$opt = $database->getAlliPermissions($session->uid, $aid);
$ChckTopic = $database->CheckCatTopic($cat_id);
$Topics = array_merge($database->ForumCatTopicStick($cat_id), $database->ForumCatTopic($cat_id));
?>
<h4><a href="allianz.php?s=2">Alliance</a> -> <a href="allianz.php?s=2&fid=<?php echo $cat_id; ?>"><?php echo $CatName; ?></a></h4><table cellpadding="1" cellspacing="1" id="topics"><thead>
	<tr>
       <th colspan="4"><?php echo $CatName; ?></th>
	</tr>
	<tr>
		<td></td>
		<td>Threads</td>
		<td>Replies</td>
		<td>Last post</td>
	</tr></thead><tbody>
<?php
if($ChckTopic){
	foreach($Topics as $arrs) {
		$checkArray = ['aid' => $aid, 'alliance' => $arrs['alliance'], 'forum_perm' => $opt['opt5'],
				'owner' => $arrs['owner'], 'admin' => $_GET['admin'], 'forum_owner' => $forumData['owner']];
		
		$CountPosts = $database->CountPost($arrs['id']);
		$lposts = $database->LastPost($arrs['id']);
			foreach($lposts as $post) {
			}
		if($database->CheckLastPost($arrs['id'])){
			$post_dates = date('d.m.y, H:i a',$post['date']);
			$owner_topics = $database->getUserArray($post['owner'],1);
		}else{
			$post_dates = date('d.m.y, H:i a',$arrs['date']);
			$owner_topics = $database->getUserArray($arrs['owner'],1);
		}

		echo '<tr><td class="ico">';
		if(Alliance::canAct($checkArray))
		{
			if($database->CheckCloseTopic($arrs['id']) == 1){
				$locks = '<a class="unlock" href="?s=2&fid='.$_GET['fid'].'&idt='.$arrs['id'].'&admin=unlock" title="open topic"><img src="img/x.gif" alt="open topic" /></a>';
			}else{
				$locks = '<a class="lock" href="?s=2&fid='.$_GET['fid'].'&idt='.$arrs['id'].'&admin=lock" title="close topic"><img src="img/x.gif" alt="close topic" /></a>';
			}
			if($arrs['stick'] == 1){
				$pin = '<a class="unpin" href="?s=2&fid='.$_GET['fid'].'&idt='.$arrs['id'].'&admin=unpin" title="Unstick topic"><img src="img/x.gif" alt="Unstick topic" /></a>';
			}else{
				$pin = '<a class="pin" href="?s=2&fid='.$_GET['fid'].'&idt='.$arrs['id'].'&admin=pin" title="Stick topic"><img src="img/x.gif" alt="Stick topic" /></a>';
			}
			echo $locks.'<a class="edit" href="?s=2&fid='.$_GET['fid'].'&idt='.$arrs['id'].'&admin=edittopic" title="edit"><img src="img/x.gif" alt="edit" /></a><br />'.$pin.'<a class="fdel" href="?s=2&fid='.$_GET['fid'].'&idt='.$arrs['id'].'&admin=deltopic" title="delete"><img src="img/x.gif" alt="delete" onClick="return confirm(\'confirm delete?\');" /></a>';
		}elseif($arrs['close'] == 1){
			echo '<img class="folder_'.($arrs['stick'] == 1 ? 'sticky_' : '').'lock" src="img/x.gif" alt="Closed Thread without new posts" title="Closed Thread without new posts" />';
		}else{
			echo '<img class="folder'.($arrs['stick'] == 1 ? '_sticky' : '').'" src="img/x.gif" alt="'.($arrs['stick'] == 1 ? 'Important ' : '').'Thread without new posts" title="'.($arrs['stick'] == 1 ? 'Important ' : '').'Thread without new posts" />';
		}
		echo '</td>
		<td class="tit"><a href="allianz.php?s=2&fid2='.$arrs['cat'].'&tid='.$arrs['id'].'">'.stripslashes($arrs['title']).'</a><br></td>
		<td class="cou">'.$CountPosts.'</td>
		<td class="last">'.$post_dates.'<br /><a href="spieler.php?uid='.$arrs['owner'].'">'.$owner_topics['username'].'</a> <a href="allianz.php?s=2&fid2='.$arrs['cat'].'&pid='.$aid.'&tid='.$arrs['id'].'"><img class="latest_reply" src="img/x.gif" alt="Show last post" title="Show last post" /></a>
		</td></tr>';
	
	}
}else{
echo '<tr>
		<td class="none" colspan="4">No topic yet</td>
	</tr>';
}
?>
	</tbody></table><p>
	<?php 
	if($forumData['forum_area'] != 3 || ($forumData['forum_area'] == 3 && $opt['opt5'] == 1)){
	?>
	<a href="allianz.php?s=2&pid=<?php echo $aid; ?>&fid=<?php echo $cat_id; ?>&ac=newtopic"><img id="fbtn_post" class="dynamic_img" src="img/x.gif" alt="Post new thread" /></a> 
<?php
echo '<a href="allianz.php?s=2&fid='.$cat_id.((isset($_GET['admin']) && !empty($_GET['admin']) && $_GET['admin'] == "switch_admin") ? "" : "&admin=switch_admin").'" title="Toggle Admin mode"><img class="switch_admin dynamic_img" src="img/x.gif" alt="Toggle Admin mode" /></a>';
	}
?>
	</p>