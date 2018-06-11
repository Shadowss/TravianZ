<?php
############################################################
##              DO NOT REMOVE THIS NOTICE                 ##
##                    MADE BY TTMTT                       ##
##                     FIX BY RONIX                       ##
##                       TRAVIANZ                         ##
############################################################

$topicID = $_GET['idt'];
$showTopic = reset($database->ShowTopic($topicID));
$forumData = reset($database->ForumCatEdit($showTopic['cat']));
$title = stripslashes($showTopic['title']);
$canBeMoved = $forumData['forum_area'] == 1 && $session->access == 9;
?>
<form method="post" action="allianz.php?s=2&fid=<?php echo $_GET['fid']; ?>">
	<input type="hidden" name="s" value="2">
	<input type="hidden" name="tid" value="<?php echo $topicID; ?>">
	<?php if(!$canBeMoved){ ?>
	<input type="hidden" name="fid" value="<?php echo $showTopic['cat']; ?>">
	<?php } ?>
	<input type="hidden" name="edittopic" value="1">
	<table cellpadding="1" cellspacing="1" id="edit_topic"><thead>
		<tr>
	        <td colspan="2">Edit topic</td>
		</tr>
		</thead><tbody>
		<tr>
			<th>Thread</th>
			<td><input class="text" type="Text" name="thema" value="<?php echo $title; ?>" maxlength="35"></td>
		</tr>
		<?php if($canBeMoved){?>
		<tr>
			<td>Move topic</td>
			<td><select class="dropdown" name="fid">
<?php
	$show_cat = $database->ForumCat($forumData['alliance']);
	foreach($show_cat as $cats) {
		if($session->access == 9 && $cats['owner'] != $session->uid) continue;
		
		if($cats['id'] == $_GET['fid']) echo '<option value="'.$cats['id'].'" selected>'.stripslashes($cats['forum_name']).'</option>';
		else echo '<option value="'.$cats['id'].'">'.stripslashes($cats['forum_name']).'</option>';
	}
?>
			</select></td>
		</tr>
		<?php } ?>
	</tbody></table>

	<p class="btn"><button id="fbtn_ok" value="ok" name="s1" class="trav_buttons"> OK </button></p></form>
