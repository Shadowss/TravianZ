<?php
############################################################
##              DO NOT REMOVE THIS NOTICE                 ##
##                    MADE BY TTMTT                       ##
##                     FIX BY RONIX                       ##
##                       TRAVIANZ                         ##
############################################################
if($session->access!=BANNED){
$displayarray = $database->getUserArray($session->uid,1);
$forumcat = $database->ForumCat(htmlspecialchars($displayarray['alliance']));
$ally = $session->alliance;
$public = mysqli_fetch_array(mysqli_query($GLOBALS['link'],"SELECT Count(*) as Total FROM ".TB_PREFIX."forum_cat WHERE alliance = $ally AND forum_area = 1"), MYSQLI_ASSOC);
$public1 = $public['Total'];
$cofederation = mysqli_fetch_array(mysqli_query($GLOBALS['link'],"SELECT Count(*) as Total FROM ".TB_PREFIX."forum_cat WHERE alliance = $ally AND forum_area = 2"), MYSQLI_ASSOC);
$cofederation1 = $cofederation['Total'];
$alliance = mysqli_fetch_array(mysqli_query($GLOBALS['link'],"SELECT Count(*) as Total FROM ".TB_PREFIX."forum_cat WHERE alliance = $ally AND forum_area = 0"), MYSQLI_ASSOC);
$alliance1 = $alliance['Total'];
$closed = mysqli_fetch_array(mysqli_query($GLOBALS['link'],"SELECT Count(*) as Total FROM ".TB_PREFIX."forum_cat WHERE alliance = $ally AND forum_area = 3"), MYSQLI_ASSOC);
$closed1 = $closed['Total'];
if($public1 != 0){
?>
<table cellpadding="1" cellspacing="1" id="public"><thead>
		<tr>
	        <th colspan="4">Public Forum</th>
		</tr>

		<tr>
			<td></td>
			<td>Forum name</td>
			<td>&nbsp;Threads&nbsp;</td>
			<td>&nbsp;Last post&nbsp;</td>
		</tr></thead><tbody>
<?php
foreach($forumcat as $arr) {
	if($arr['forum_area']==1){
			$countop = $database->CountCat($arr['id']);
			$lpost = "";
			$owner = "";
			if ($countop>0) {
				$ltopic = $database->LastTopic($arr['id']);
				foreach($ltopic as $las){}
				$lpos = $database->LastPost($las['id']);
				foreach($lpos as $pos){}
				if($database->CheckLastTopic($arr['id'])){
					if($database->CheckLastPost($las['id'])){
						$lpost = date('m/d/y H:i a',$pos['date']);
						$owner = $database->getUserArray($pos['owner'],1);
					}else{
						$lpost = date('m/d/y H:i a',$las['date']);
						$owner = $database->getUserArray($las['owner'],1);
					}
				}
			}	
		echo	'<tr><td class="ico">';
		if($database->CheckEditRes($aid)=="1" && ($database->isAllianceOwner($session->uid) == $session->alliance || $arr['owner'] == $session->uid)){
			echo '<a class="up_arr" href="allianz.php?s=2&fid='.$arr['id'].'&bid=0&admin=pos&res=-1" title="To top">
			<img src="img/x.gif" alt="To top" /></a><a class="edit" href="allianz.php?s=2&idf='.$arr['id'].'&admin=editforum" title="edit">
			<img src="img/x.gif" alt="edit" /></a><br />
			<a class="down_arr" href="allianz.php?s=2&fid='.$arr['id'].'&bid=0&admin=pos&res=1" title="To bottom">
			<img src="img/x.gif" alt="To bottom" /></a>
			<a class="fdel" href="allianz.php?s=2&idf='.$arr['id'].'&admin=delforum" onClick="return confirm(\'confirm delete?\');" title="delete">
			<img src="img/x.gif" alt="delete" /></a>';
		}else{
			echo '<img class="folder" src="img/x.gif" title="Thread without new posts" alt="Thread without new posts">';
		}		
		echo '</td><td class="tit">
		<a href="allianz.php?s=2&fid='.$arr['id'].'&pid='.$aid.'" title="'.stripslashes($arr['forum_name']).'">'.stripslashes($arr['forum_name']).'</a><br />'.stripslashes($arr['forum_des']).'</td>
		<td class="cou">'.$countop.'</td>
		<td class="last">'.$lpost.'</span><span><br />';
		if ($owner!="") {
			echo '<a href="spieler.php?uid='.$owner['id'].'">'.$owner['username'].'</a> <img class="latest_reply" src="img/x.gif" alt="Show last post" title="Show last post" />';
		}	
		echo '</td>
		</tr>';
		
	}
}
?>
		</tbody></table>
<?php
}if($cofederation1 != 0){
?>
<table cellpadding="1" cellspacing="1" id="confederation"><thead>
		<tr>
	        <th colspan="4">Confederation Forum</th>
		</tr>

		<tr>
			<td></td>
			<td>Forum name</td>
			<td>&nbsp;Threads&nbsp;</td>
			<td>&nbsp;Last post&nbsp;</td>
		</tr></thead><tbody>
<?php
foreach($forumcat as $arr) {
	if($arr['forum_area']==2){
			$countop = $database->CountCat($arr['id']);
			$lpost = "";
			$owner = "";
			if ($countop>0) {
				$ltopic = $database->LastTopic($arr['id']);
				foreach($ltopic as $las){}
				$lpos = $database->LastPost($las['id']);
				foreach($lpos as $pos){}
				if($database->CheckLastTopic($arr['id'])){
					if($database->CheckLastPost($las['id'])){
						$lpost = date('m/d/y H:i a',$pos['date']);
						$owner = $database->getUserArray($pos['owner'],1);
					}else{
						$lpost = date('m/d/y H:i a',$las['date']);
						$owner = $database->getUserArray($las['owner'],1);
					}
				}
			}	
		echo	'<tr><td class="ico">';
		if($database->CheckEditRes($aid)=="1" && ($database->isAllianceOwner($session->uid) == $session->alliance || $arr['owner'] == $session->uid)){
			echo '<a class="up_arr" href="allianz.php?s=2&fid='.$arr['id'].'&bid=0&admin=pos&res=-1" title="To top"><img src="img/x.gif" alt="To top" /></a><a class="edit" href="allianz.php?s=2&idf='.$arr['id'].'&admin=editforum" title="edit"><img src="img/x.gif" alt="edit" /></a><br /><a class="down_arr" href="allianz.php?s=2&fid='.$arr['id'].'&bid=0&admin=pos&res=1" title="To bottom"><img src="img/x.gif" alt="To bottom" /></a><a class="fdel" href="allianz.php?s=2&idf='.$arr['id'].'&admin=delforum" onClick="return confirm(\'confirm delete?\');" title="delete"><img src="img/x.gif" alt="delete" /></a>';
		}else{
			echo '<img class="folder" src="img/x.gif" title="Thread without new posts" alt="Thread without new posts">';
		}		
		echo '</td><td class="tit">
		<a href="allianz.php?s=2&fid='.$arr['id'].'&pid='.$aid.'" title="'.stripslashes($arr['forum_name']).'">'.stripslashes($arr['forum_name']).'</a><br />'.stripslashes($arr['forum_des']).'</td>
		<td class="cou">'.$countop.'</td>
		<td class="last">'.$lpost.'</span><span><br />';
		if ($owner!="") {
			echo '<a href="spieler.php?uid='.$owner['id'].'">'.$owner['username'].'</a> <img class="latest_reply" src="img/x.gif" alt="Show last post" title="Show last post" />';
		}	
		echo '</td>
		</tr>';
		
	}
}
?>
		</tbody></table>
<?php
}if($alliance1 != 0){
?>
<table cellpadding="1" cellspacing="1" id="alliance"><thead>
		<tr>
	        <th colspan="4">Alliance Forum</th>
		</tr>

		<tr>
			<td></td>
			<td>Forum name</td>
			<td>&nbsp;Threads&nbsp;</td>
			<td>&nbsp;Last post&nbsp;</td>
		</tr></thead><tbody>
<?php
	foreach($forumcat as $arr) {
		if($arr['forum_area']==0){
			$countop = $database->CountCat($arr['id']);
			$lpost = "";
			$owner = "";
			if ($countop>0) {
				$ltopic = $database->LastTopic($arr['id']);
				foreach($ltopic as $las){}
				$lpos = $database->LastPost($las['id']);
				foreach($lpos as $pos){}
				if($database->CheckLastTopic($arr['id'])){
					if($database->CheckLastPost($las['id'])){
						$lpost = date('m/d/y H:i a',$pos['date']);
						$owner = $database->getUserArray($pos['owner'],1);
					}else{
						$lpost = date('m/d/y H:i a',$las['date']);
						$owner = $database->getUserArray($las['owner'],1);
					}
				}
			}	
				echo	'<tr><td class="ico">';
				if($database->CheckEditRes($aid)=="1" && ($database->isAllianceOwner($session->uid) == $session->alliance || $arr['owner'] == $session->uid)){
					echo '<a class="up_arr" href="allianz.php?s=2&fid='.$arr['id'].'&bid=0&admin=pos&res=-1" title="To top"><img src="img/x.gif" alt="To top" /></a><a class="edit" href="allianz.php?s=2&idf='.$arr['id'].'&admin=editforum" title="edit"><img src="img/x.gif" alt="edit" /></a><br /><a class="down_arr" href="allianz.php?s=2&fid='.$arr['id'].'&bid=0&admin=pos&res=1" title="To bottom"><img src="img/x.gif" alt="To bottom" /></a><a class="fdel" href="allianz.php?s=2&idf='.$arr['id'].'&admin=delforum" onClick="return confirm(\'confirm delete?\');" title="delete"><img src="img/x.gif" alt="delete" /></a>';
				}else{
					echo '<img class="folder" src="img/x.gif" title="Thread without new posts" alt="Thread without new posts">';
				}		
				echo '</td><td class="tit"><a href="allianz.php?s=2&fid='.$arr['id'].'&pid='.$aid.'" title="'.stripslashes($arr['forum_name']).'">'.stripslashes($arr['forum_name']).'</a><br />'.stripslashes($arr['forum_des']).'</td>
				<td class="cou">'.$countop.'</td>
				<td class="last">'.$lpost.'</span><span><br />';
				if ($owner!="") {
					echo '<a href="spieler.php?uid='.$owner['id'].'">'.$owner['username'].'</a> <img class="latest_reply" src="img/x.gif" alt="Show last post" title="Show last post" />';
				}
				echo '</td>
				</tr>';
			
		}
	}	
?>
		</tbody></table>
<?php
}
if($closed1 != 0){
?>
	<table cellpadding="1" cellspacing="1" id="closed"><thead>
		<tr>
	        <th colspan="4">Closed Forum</th>
		</tr>

		<tr>
			<td></td>
			<td>Forum name</td>
			<td>&nbsp;Threads&nbsp;</td>
			<td>&nbsp;Last post&nbsp;</td>
		</tr></thead><tbody>
<?php
	foreach($forumcat as $arr) {
	if($arr['forum_area']==3){
			$countop = $database->CountCat($arr['id']);
			$lpost = "";
			$owner = "";
			if ($countop>0) {
				$ltopic = $database->LastTopic($arr['id']);
				foreach($ltopic as $las){}
				$lpos = $database->LastPost($las['id']);
				foreach($lpos as $pos){}
				if($database->CheckLastTopic($arr['id'])){
					if($database->CheckLastPost($las['id'])){
						$lpost = date('m/d/y H:i a',$pos['date']);
						$owner = $database->getUserArray($pos['owner'],1);
					}else{
						$lpost = date('m/d/y H:i a',$las['date']);
						$owner = $database->getUserArray($las['owner'],1);
					}
				}
			}	
		echo	'<tr><td class="ico">';
		if($database->CheckEditRes($aid)=="1" && ($database->isAllianceOwner($session->uid) == $session->alliance || $arr['owner'] == $session->uid)){
			echo '<a class="up_arr" href="allianz.php?s=2&fid='.$arr['id'].'&bid=0&admin=pos&res=-1" title="To top"><img src="img/x.gif" alt="To top" /></a><a class="edit" href="allianz.php?s=2&idf='.$arr['id'].'&admin=editforum" title="edit"><img src="img/x.gif" alt="edit" /></a><br /><a class="down_arr" href="allianz.php?s=2&fid='.$arr['id'].'&bid=0&admin=pos&res=1" title="To bottom"><img src="img/x.gif" alt="To bottom" /></a><a class="fdel" href="allianz.php?s=2&idf='.$arr['id'].'&admin=delforum" onClick="return confirm(\'confirm delete?\');" title="delete"><img src="img/x.gif" alt="delete" /></a>';
		}else{
			echo '<img class="folder" src="img/x.gif" title="Thread without new posts" alt="Thread without new posts">';
		}		
		echo '</td><td class="tit"><a href="allianz.php?s=2&fid='.$arr['id'].'&pid='.$aid.'" title="'.stripslashes($arr['forum_name']).'">'.stripslashes($arr['forum_name']).'</a><br />'.stripslashes($arr['forum_des']).'</td>
			<td class="cou">'.$countop.'</td>
			<td class="last">'.$lpost.'</span><span><br />';
			if ($owner!="") {
				echo '<a href="spieler.php?uid='.$owner['id'].'">'.$owner['username'].'</a> <img class="latest_reply" src="img/x.gif" alt="Show last post" title="Show last post" />';
			}	
			echo '</td>
		</tr>';
		
	}
}
?>
		</tbody></table>
		<?php
		}
		?>
		<p>
		<?php
			$opt = $database->getAlliPermissions($session->uid, $aid);
			if($opt['opt5'] == 1){
				echo '<a href="allianz.php?s=2&admin=newforum"><img id="fbtn_newforum" class="dynamic_img" src="img/x.gif" alt="New forum" /></a>
				<a href="allianz.php?s='.$ids.'&admin=switch_admin" title="Toggle Admin mode"><img class="switch_admin dynamic_img" src="img/x.gif" alt="Toggle Admin mode" /></a>';
			}
		?>
</p>
<?php }else{
header("Location: banned.php");
exit;
}
?>