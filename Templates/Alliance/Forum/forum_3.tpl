<?php
//////////////// made by TTMTT ////////////////
if($session->access!=BANNED){
$topic_id = $_GET['idt'];
$show_topic = $database->ShowTopic($topic_id);
foreach($show_topic as $topi) {
	$title = stripslashes($topi['title']);
}
?>
<form method="post" action="allianz.php?s=2&fid=<?php echo $_GET['idf']; ?>&pid=<?php echo $aid; ?>">
	<input type="hidden" name="s" value="2">
	<input type="hidden" name="tid" value="<?php echo $topic_id; ?>">
	<input type="hidden" name="edittopic" value="1">

	<table cellpadding="1" cellspacing="1" id="edit_topic"><thead>
		<tr>
	        <th colspan="2">Edit topic</td>
		</tr>
		</thead><tbody>
		<tr>
			<th>Thread</th>

			<td><input class="text" type="Text" name="thema" value="<?php echo $title; ?>" maxlength="35"></td>
		</tr>
		<tr>
			<th>Move topic</td>
			<td><select class="dropdown" name="fid">
<?php
$show_cat = $database->ForumCat($session->alliance);
	foreach($show_cat as $cats) {
		if($cats['id'] == $_GET['idf']){
			echo '<option value="'.$cats['id'].'" selected>'.stripslashes($cats['forum_name']).'</option>';
		}else{
			echo '<option value="'.$cats['id'].'">'.stripslashes($cats['forum_name']).'</option>';
		}
	}
?>
			</select></td>
		</tr>
	</tbody></table>

	<p class="btn"><input type="image" id="fbtn_ok" value="ok" name="s1" class="dynamic_img" src="img/x.gif" alt="OK" /></form></p>
<?php }else{
header("Location: banned.php");
}
?>