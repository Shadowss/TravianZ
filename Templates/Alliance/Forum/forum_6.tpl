<?php
############################################################
##              DO NOT REMOVE THIS NOTICE                 ##
##                    MADE BY TTMTT                       ##
##                     FIX BY RONIX                       ##
##                       TRAVIANZ                         ##
############################################################
if($session->access!=BANNED){
$tid = $_GET['tid'];
$opt = $database->getAlliPermissions($session->uid, $aid);
$topics = $database->ShowTopic($tid);
$posts = $database->ShowPost($tid);
foreach($topics as $arr) {
$cat_id = $arr['cat'];
	$owner = $database->getUserArray($arr['owner'],1);
	$CatName = stripslashes($database->ForumCatName($cat_id));
	$allianceinfo = $database->getAlliance($owner['alliance']);
}
$date = date('m/d/y H:i a',$arr['date']);
$varray = $database->getProfileVillages($arr['owner']);
$totalpop = 0;
foreach($varray as $vil) {
	$totalpop += $vil['pop'];
}
$countAu = $database->CountTopic($arr['owner']);
$displayarray = $database->getUserArray($arr['owner'],1);
if($displayarray['tribe'] == 1) {
    $trip = "Fire";
}else if($displayarray['tribe'] == 2) {
	$trip = "Water";
}else if($displayarray['tribe'] == 3) {
    $trip = "Earth";
}else if($displayarray['tribe'] == 4) {
	$trip = "Air";
}else if($displayarray['tribe'] == 5) {
    $trip = "Lightning";
}
$input = $arr['post'];
$alliance = $arr['alliance0'];
$player = $arr['player0'];
$coor = $arr['coor0'];
$report = $arr['report0'];
$bbcoded = $input;
include("GameEngine/BBCode.php");
$bbcode_topic = stripslashes(nl2br($bbcoded));
?>
<h4><a href="allianz.php?s=2&pid=<?php echo $arr['alliance']; ?>">Alliance</a> -> <a href="allianz.php?s=2&pid=<?php echo $arr['alliance']; ?>&fid=<?php echo $arr['cat']; ?>"><?php echo $CatName; ?></a></h4><table cellpadding="1" cellspacing="1" id="posts"><thead>
<tr>
	<th colspan="2"><?php echo stripslashes($arr['title']); ?></th>

</tr><tr>
	<td>Author</td>
	<td>Message</td>
</tr></thead><tbody>
	<tr><td class="pinfo"><a class="name" href="spieler.php?uid=<?php echo $arr['owner']; ?>"><?php echo $owner['username']; ?></a><br /><a href="allianz.php?aid=<?php echo $allianceinfo['id']; ?>"><?php echo $allianceinfo['tag']; ?></a><br />
		Posts: <?php echo $countAu; ?><br />
		<br />
		Pop.: <?php echo $totalpop; ?><br />
		Villages: <?php echo count($varray);?><br />
		<?php echo $trip; ?>
		</td>
		<td class="pcontent"><div class="posted">created: <?php echo $date; ?></div>
<?php
if($database->CheckEditRes($aid)=="1" && ($database->isAllianceOwner($session->uid) == $session->alliance || $arr['owner'] == $session->uid)){
	echo '<div class="admin"><a class="edit" href="allianz.php?s=2&pid='.$arr['alliance'].'&fid2='.$_GET['fid2'].'&idf='.$arr['cat'].'&idt='.$arr['id'].'&admin=editans"><img src="img/x.gif" title="edit" alt="edit" /></a><a class="fdel" href="?s=2&pid='.$arr['alliance'].'&tid='.$arr['id'].'&admin=deltopic" onClick="return confirm(\'confirm delete?\');"><img src="img/x.gif" title="delete" alt="delete" /></a></div><br />';
}
?>
		<div class="clear dotted"></div><div class="text"><?php echo $bbcode_topic; ?></div></td>
	</tr>
	<?php if($database->checkSurvey($arr['id'])){
	$survey = $database->getSurvey($arr['id']);
	if(!$database->checkVote($arr['id'], $session->uid) && ($survey['ends'] > time() || $survey['ends'] == 0)){
	?>
	<tr><td colspan="2"><div><center>Survey: <?php echo $survey['title']; ?></center></div>
		<div class="clear dotted"></div>
		<form method="post" name="post" action="allianz.php?s=2&fid2=<?php echo $_GET['fid2']; ?>&pid=<?php echo $_GET['pid']; ?>&tid=<?php echo $_GET['tid']; ?>">
		<table width="100%" border="0" align="left" cellPadding="0" style="border-collapse: collapse">
		<?php
		for($i=1;$i<=8;$i++){
		if (!empty($survey['option'.$i])) {
		?>
		<tr>
		<td width="5%">
		<input class="radio" type="radio" name="vote" value="<?php echo $i; ?>" /></td>
		<td width="95%">
		<?php echo $survey['option'.$i]; ?>
		</td>
		<?php
		}
		}
		?>
		</table>
		<div class="text">
		<input type="hidden" name="fid2" value="<?php echo $_GET['fid2']; ?>" />
		<input type="hidden" name="pid" value="<?php echo $_GET['pid']; ?>" />
		<input type="hidden" name="tid" value="<?php echo $_GET['tid']; ?>" />
		<p class="btn"><input type="image" id="fbtn_vote" value="ok" name="s1" class="dynamic_img" src="img/x.gif" alt="Vote" /></form></p>
		</div></td>
	</tr>
	<?php }else{ ?>
	<tr><td class="pcontent" colspan="2"><div><center>Survey: <?php echo $survey['title']; ?></center></div>
		<div class="clear dotted"></div><div class="text">
		<?php
		$sum = $database->getVoteSum($arr['id']);
		for($i=1;$i<=8;$i++){
		if($survey['option'.$i] != ""){
		if($sum > 0){
		$width = 100 * ($survey['vote'.$i] / $sum);
		}else{
		$width = 0;
		}
		?>
		<?php echo $survey['option'.$i]." "; ?><img src="<?php echo GP_LOCATE; ?>/img/f/c4.gif" width="<?php echo $width; ?>" /><?php echo " ".$survey['vote'.$i]; ?></br>
		<?php
		}
		}
		?>
		</div></td>
	</tr>
	<?php }} ?>
<?php
foreach($posts as $po) {

	$date = date('m/d/y H:i a',$po['date']);
	$countAu = $database->CountTopic($po['owner']);
	$varray = $database->getProfileVillages($po['owner']);
	$totalpop = 0;
	foreach($varray as $vil) {
		$totalpop += $vil['pop'];
	}
	$displayarray = $database->getUserArray($po['owner'],1);
	if($displayarray['tribe'] == 1) {
		$trip = "Roman";
	}else if($displayarray['tribe'] == 2) {
		$trip = "Teutons";
	}else if($displayarray['tribe'] == 3) {
		$trip = "Gauls";
	}
	$owner = $database->getUserArray($po['owner'],1);
	$allianceinfo = $database->getAlliance($owner['alliance']);
	$input = $po['post'];
	$alliance = $po['alliance0'];
	$player = $po['player0'];
	$coor = $po['coor0'];
	$report = $po['report0'];
	include("GameEngine/BBCode.php");
	$bbcode_post = stripslashes(nl2br($bbcoded));

echo '<tr><td class="pinfo"><a class="name" href="spieler.php?uid='.$po['owner'].'">'.$owner['username'].'</a><br /><a href="allianz.php?aid='.$allianceinfo['id'].'">'.$allianceinfo['tag'].'</a><br />
		Posts: '.$countAu.'<br />
		<br />
		Inhbs.: '.$totalpop.'<br />
		Villages: '.count($varray).'<br />
		'.$trip.'
		</td>
		<td class="pcontent"><div class="posted">created: '.$date.'</div>';
	if($database->CheckEditRes($aid)=="1" && ($database->isAllianceOwner($session->uid) == $session->alliance || $po['owner'] == $session->uid)){
		echo '<div class="admin"><a class="edit" href="allianz.php?s=2&pid='.$arr['alliance'].'&fid2='.$_GET['fid2'].'&idt='.$_GET['tid'].'&pod='.$po['id'].'&admin=editpost"><img src="img/x.gif" title="edit" alt="edit" /></a><a class="fdel" href="?s=2&pid='.$arr['alliance'].'&pod='.$po['id'].'&tid='.$_GET['tid'].'&admin=delpost" onClick="return confirm(\'confirm delete?\');"><img src="img/x.gif" title="delete" alt="delete" /></a></div><br />';
	}
echo '<div class="clear dotted"></div><div class="text">'.$bbcode_post.'</div></td>
	</tr>';
}
?>
	</tbody></table><div style="margin-top: 15px;">
	<?php
	if(empty($arr['close'])){
		echo '<a href="allianz.php?s=2&fid2='.$arr['cat'].'&pid='.$arr['alliance'].'&tid='.$arr['id'].'&ac=newpost"><img id="fbtn_reply" class="dynamic_img"src="img/x.gif" alt="Replies" /></a>';
	}
	if($opt['opt5'] == 1){
		echo '<a href="allianz.php?s=2&pid='.$aid.'&tid='.$arr['id'].'&admin=switch_admin" title="Toggle Admin mode"><img class="switch_admin dynamic_img" src="img/x.gif" alt="Toggle Admin mode" /></a>';
	}

	 echo '</div>';
}else{
header("Location: banned.php");
exit;
}
	 ?>