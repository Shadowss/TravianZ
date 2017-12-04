<?php
############################################################
##              DO NOT REMOVE THIS NOTICE                 ##
##                    MADE BY TTMTT                       ##
##                     FIX BY RONIX                       ##
##                       TRAVIANZ                         ##
############################################################
if($session->access!=BANNED){
$cat_id = $_GET['fid'];
$CatName = stripslashes($database->ForumCatName($cat_id));
$ChckTopic = $database->CheckCatTopic($cat_id);
$Topics = $database->ForumCatTopic($cat_id);
$TopicsStick = $database->ForumCatTopicStick($cat_id);
?>
<h4><a href="allianz.php?s=2">Alliance</a> -> <a href="allianz.php?s=2&pid=<?php echo $_GET['pid']; ?>&fid=<?php echo $cat_id; ?>"><?php echo $CatName; ?></a></h4><table cellpadding="1" cellspacing="1" id="topics"><thead>
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
	foreach($TopicsStick as $arrs) {
		$CountPosts = $database->CountPost($arrs['id']);
		$lposts = $database->LastPost($arrs['id']);
			foreach($lposts as $post) {
			}
		if($database->CheckLastPost($arrs['id'])){
			$post_dates = date('m/d/y, H:i a',$post['date']);
			$owner_topics = $database->getUserArray($post['owner'],1);
		}else{
			$post_dates = date('m/d/y, H:i a',$arrs['date']);
			$owner_topics = $database->getUserArray($arrs['owner'],1);
		}
		
		echo '<tr><td class="ico">';
		if($database->CheckEditRes($aid)=="1" && ($database->isAllianceOwner($session->uid) == $session->alliance || $arrs['owner'] == $session->uid)){
			if($database->CheckCloseTopic($arrs['id']) == 1){
				$locks = '<a class="unlock" href="?s=2&fid='.$_GET['fid'].'&idt='.$arrs['id'].'&admin=unlock" title="open topic"><img src="img/x.gif" alt="open topic" /></a>';
			}else{
				$locks = '<a class="lock" href="?s=2&fid='.$_GET['fid'].'&idt='.$arrs['id'].'&admin=lock" title="close topic"><img src="img/x.gif" alt="close topic" /></a>';
			}
			echo ''.$locks.'<a class="edit" href="?s=2&idf='.$_GET['fid'].'&idt='.$arrs['id'].'&admin=edittopic" title="edit"><img src="img/x.gif" alt="edit" /></a><br /><a class="unpin" href="?s=2&fid='.$_GET['fid'].'&idt='.$arrs['id'].'&admin=unpin" title="stick topic"><img src="img/x.gif" alt="stick topic" /></a><a class="fdel" href="?s=2&fid='.$_GET['fid'].'&idt='.$arrs['id'].'&admin=deltopic" title="delete"><img src="img/x.gif" alt="delete" onClick="return confirm(\'confirm delete?\');" /></a>';
		}elseif($arrs['close']=="1"){
			echo '<img class="folder_sticky_lock" src="img/x.gif" alt="Closed Thread without new posts" title="Closed Thread without new posts" />';
		}else{
			echo '<img class="folder_sticky" src="img/x.gif" alt="Important Thread without new posts" title="Important Thread without new posts" />';
		}
		echo '</td>
		<td class="tit"><a href="allianz.php?s=2&fid2='.$arrs['cat'].'&pid='.$aid.'&tid='.$arrs['id'].'">'.stripslashes($arrs['title']).'</a><br></td>
		<td class="cou">'.$CountPosts.'</td>
		<td class="last">'.$post_dates.'<br /><a href="spieler.php?uid='.$arrs['owner'].'">'.$owner_topics['username'].'</a> <a href="allianz.php?s=2&fid2='.$arrs['cat'].'&pid='.$aid.'&tid='.$arrs['id'].'&seite=max"><img class="latest_reply" src="img/x.gif" alt="Show last post" title="Show last post" /></a>
		</td></tr>';
	
	}

	foreach($Topics as $arr) {
		$CountPost = $database->CountPost($arr['id']);
		$lpost = $database->LastPost($arr['id']);
			foreach($lpost as $pos) {
			}
		if($database->CheckLastPost($arr['id'])){
			$post_date = date('m/d/y, H:i a',$pos['date']);
			$owner_topic = $database->getUserArray($pos['owner'],1);
		}else{
			$post_date = date('m/d/y, H:i a',$arr['date']);
			$owner_topic = $database->getUserArray($arr['owner'],1);
		}
		
		echo '<tr><td class="ico">';
		if($database->CheckEditRes($aid)=="1" && ($database->isAllianceOwner($session->uid) == $session->alliance || $arr['owner'] == $session->uid)){
			if($database->CheckCloseTopic($arr['id']) == 1){
				$lock = '<a class="unlock" href="?s=2&fid='.$_GET['fid'].'&idt='.$arr['id'].'&admin=unlock" title="open topic"><img src="img/x.gif" alt="open topic" /></a>';
			}else{
				$lock = '<a class="lock" href="?s=2&fid='.$_GET['fid'].'&idt='.$arr['id'].'&admin=lock" title="close topic"><img src="img/x.gif" alt="close topic" /></a>';
			}
			echo ''.$lock.'<a class="edit" href="?s=2&idf='.$_GET['fid'].'&idt='.$arr['id'].'&admin=edittopic" title="edit"><img src="img/x.gif" alt="edit" /></a><br /><a class="pin" href="?s=2&fid='.$_GET['fid'].'&idt='.$arr['id'].'&admin=pin" title="stick topic"><img src="img/x.gif" alt="stick topic" /></a><a class="fdel" href="?s=2&fid='.$_GET['fid'].'&idt='.$arr['id'].'&admin=deltopic" title="delete"><img src="img/x.gif" alt="delete" onClick="return confirm(\'confirm delete?\');" /></a>';
		}elseif($arr['close']=="1"){
			echo '<img class="folder_lock" src="img/x.gif" alt="Closed Thread without new posts" title="Closed Thread without new posts" />';
		}else{
			echo '<img class="folder" src="img/x.gif" title="Thread without new posts" alt="Thread without new posts">';
		}
		echo '</td>
		<td class="tit"><a href="allianz.php?s=2&fid2='.$arr['cat'].'&pid='.$aid.'&tid='.$arr['id'].'">'.stripslashes($arr['title']).'</a><br></td>
		<td class="cou">'.$CountPost.'</td>
		<td class="last">'.$post_date.'<br /><a href="spieler.php?uid='.$arr['owner'].'">'.$owner_topic['username'].'</a> <a href="allianz.php?s=2&aid='.$aid.'&tid='.$arr['id'].'&seite=max"><img class="latest_reply" src="img/x.gif" alt="Show last post" title="Show last post" /></a>
		</td></tr>';
	
	}
}else{
echo '<tr>
		<td class="none" colspan="4">No topic yet</td>
	</tr>';
}
?>
	</tbody></table><p>
	<a href="allianz.php?s=2&pid=<?php echo $aid; ?>&fid=<?php echo $cat_id; ?>&ac=newtopic"><img id="fbtn_post" class="dynamic_img" src="img/x.gif" alt="Post new thread" /></a> 
<?php
	$opt = $database->getAlliPermissions($session->uid, $aid);
	if(isset($opt['opt5']) && $opt['opt5']== 1){
		echo '<a href="allianz.php?s=2&fid='.$cat_id.'&seite=1&admin=switch_admin" title="Toggle Admin mode"><img class="switch_admin dynamic_img" src="img/x.gif" alt="Toggle Admin mode" /></a>';
	}
?>
	</p>
<?php }else{
header("Location: banned.php");
exit;
}
?>