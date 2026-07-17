<?php
// ###########################################################
// # DO NOT REMOVE THIS NOTICE ##
// # MADE BY TTMTT ##
// # FIX BY RONIX ##
// # TRAVIANZ ##
// ###########################################################

$topic_id = $_GET['tid'];
$post_id = $_GET['pod'];
$topics = reset($database->ShowTopic($topic_id));
$posts = $database->ShowPostEdit($post_id);

//Check if we're modifying a valid post
if(empty($topics) || empty($posts)) $alliance->redirect($_GET);

$title = stripslashes($topics['title']);

foreach($posts as $pos){
	$poss = stripslashes($pos['post']);
	$poss = preg_replace('/\[message\]/', '', $poss);
	$poss = preg_replace('/\[\/message\]/', '', $poss);
	$owner = $pos['owner'];
}
	?>
<form method="post" name="post"
	action="allianz.php?s=2&fid2=<?php echo $topics['cat']; ?>&tid=<?php echo $topics['id']; ?>">
	<input type="hidden" name="s" value="2"> <input type="hidden"
		name="pod" value="<?php echo $_GET['pod']; ?>"> <input type="hidden"
		type="hidden" name="editpost" value="1">
	<table cellpadding="1" cellspacing="1" id="edit_post">
		<thead>
			<tr>
				<th colspan="2"><?php echo TZ_EDIT_ANSWER; ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th><?php echo TZ_THREAD; ?></th>
				<td><?php echo $title; ?></td>

			</tr>

			<tr>
				<td></td>
				<td>

					<div bbArea="text" id="text_container" name="text_container">
						<div id="text_toolbar" name="text_toolbar">
							<a href="javascript:void(0);" bbType="d" bbTag="b">
								<div title="<?php echo TZ_BOLD; ?>" alt="<?php echo TZ_BOLD; ?>" class="bbButton bbBold"></div>
							</a> <a href="javascript:void(0);" bbType="d" bbTag="i">
								<div title="<?php echo TZ_ITALIC; ?>" alt="<?php echo TZ_ITALIC; ?>" class="bbButton bbItalic"></div>
							</a> <a href="javascript:void(0);" bbType="d" bbTag="u">
								<div title="<?php echo TZ_UNDERLINED; ?>" alt="<?php echo TZ_UNDERLINED; ?>"
									class="bbButton bbUnderscore"></div>
							</a> <a href="javascript:void(0);" bbType="d" bbTag="alliance">
								<div title="<?php echo ALLIANCE; ?>" alt="<?php echo ALLIANCE; ?>" class="bbButton bbAlliance"></div>
							</a> <a href="javascript:void(0);" bbType="d" bbTag="player">
								<div title="<?php echo PLAYER; ?>" alt="<?php echo PLAYER; ?>" class="bbButton bbPlayer"></div>
							</a> <a href="javascript:void(0);" bbType="d" bbTag="coor">
								<div title="<?php echo COORDINATES; ?>" alt="<?php echo COORDINATES; ?>"
									class="bbButton bbCoordinate"></div>
							</a> <a href="javascript:void(0);" bbType="d" bbTag="report">
								<div title="<?php echo REPORT; ?>" alt="<?php echo REPORT; ?>" class="bbButton bbReport"></div>
							</a> <a href="javascript:void(0);" bbWin="resources"
								id="text_resourceButton">
								<div title="<?php echo RESOURCES; ?>" alt="<?php echo RESOURCES; ?>"
									class="bbButton bbResource"></div>
							</a> <a href="javascript:void(0);" bbWin="smilies"
								id="text_smilieButton">
								<div title="<?php echo TZ_SMILIES; ?>" alt="<?php echo TZ_SMILIES; ?>" class="bbButton bbSmilie"></div>
							</a> <a href="javascript:void(0);" bbWin="troops"
								id="text_troopButton">
								<div title="<?php echo TROOPS; ?>" alt="<?php echo TROOPS; ?>" class="bbButton bbTroop"></div>
							</a> <a href="javascript:void(0);" id="text_previewButton"
								bbArea="text">
								<div title="<?php echo TZ_PREVIEW; ?>" alt="<?php echo TZ_PREVIEW; ?>" class="bbButton bbPreview"></div>
							</a>

							<div class="clear"></div>
							<div id="text_toolbarWindows">
								<div id="text_resources" name="text_resources">
									<a href="javascript:void(0);" bbType="o" bbTag="lumber"><img
										src="img/x.gif" class="r1" title="<?php echo TZ_WOOD; ?>" alt="<?php echo TZ_WOOD; ?>" /></a> <a
										href="javascript:void(0);" bbType="o" bbTag="clay"><img
										src="img/x.gif" class="r2" title="<?php echo CLAY; ?>" alt="<?php echo CLAY; ?>" /></a> <a
										href="javascript:void(0);" bbType="o" bbTag="iron"><img
										src="img/x.gif" class="r3" title="<?php echo IRON; ?>" alt="<?php echo IRON; ?>" /></a> <a
										href="javascript:void(0);" bbType="o" bbTag="crop"><img
										src="img/x.gif" class="r4" title="<?php echo CROP; ?>" alt="<?php echo CROP; ?>" /></a>
								</div>
								<div id="text_smilies" name="text_smilies">
									<a href="javascript:void(0);" bbType="s" bbTag="*aha*"><img
										class="smiley aha" src="img/x.gif" alt="*aha*" title="*aha*" /></a><a
										href="javascript:void(0);" bbType="s" bbTag="*angry*"><img
										class="smiley angry" src="img/x.gif" alt="*angry*"
										title="*angry*" /></a><a href="javascript:void(0);" bbType="s"
										bbTag="*cool*"><img class="smiley cool" src="img/x.gif"
										alt="*cool*" title="*cool*" /></a><a
										href="javascript:void(0);" bbType="s" bbTag="*cry*"><img
										class="smiley cry" src="img/x.gif" alt="*cry*" title="*cry*" /></a><a
										href="javascript:void(0);" bbType="s" bbTag="*cute*"><img
										class="smiley cute" src="img/x.gif" alt="*cute*"
										title="*cute*" /></a><a href="javascript:void(0);" bbType="s"
										bbTag="*depressed*"><img class="smiley depressed"
										src="img/x.gif" alt="*depressed*" title="*depressed*" /></a><a
										href="javascript:void(0);" bbType="s" bbTag="*eek*"><img
										class="smiley eek" src="img/x.gif" alt="*eek*" title="*eek*" /></a><a
										href="javascript:void(0);" bbType="s" bbTag="*ehem*"><img
										class="smiley ehem" src="img/x.gif" alt="*ehem*"
										title="*ehem*" /></a><a href="javascript:void(0);" bbType="s"
										bbTag="*emotional*"><img class="smiley emotional"
										src="img/x.gif" alt="*emotional*" title="*emotional*" /></a><a
										href="javascript:void(0);" bbType="s" bbTag=":D"><img
										class="smiley grin" src="img/x.gif" alt=":D" title=":D" /></a><a
										href="javascript:void(0);" bbType="s" bbTag=":)"><img
										class="smiley happy" src="img/x.gif" alt=":)" title=":)" /></a><a
										href="javascript:void(0);" bbType="s" bbTag="*hit*"><img
										class="smiley hit" src="img/x.gif" alt="*hit*" title="*hit*" /></a><a
										href="javascript:void(0);" bbType="s" bbTag="*hmm*"><img
										class="smiley hmm" src="img/x.gif" alt="*hmm*" title="*hmm*" /></a><a
										href="javascript:void(0);" bbType="s" bbTag="*hmpf*"><img
										class="smiley hmpf" src="img/x.gif" alt="*hmpf*"
										title="*hmpf*" /></a><a href="javascript:void(0);" bbType="s"
										bbTag="*hrhr*"><img class="smiley hrhr" src="img/x.gif"
										alt="*hrhr*" title="*hrhr*" /></a><a
										href="javascript:void(0);" bbType="s" bbTag="*huh*"><img
										class="smiley huh" src="img/x.gif" alt="*huh*" title="*huh*" /></a><a
										href="javascript:void(0);" bbType="s" bbTag="*lazy*"><img
										class="smiley lazy" src="img/x.gif" alt="*lazy*"
										title="*lazy*" /></a><a href="javascript:void(0);" bbType="s"
										bbTag="*love*"><img class="smiley love" src="img/x.gif"
										alt="*love*" title="*love*" /></a><a
										href="javascript:void(0);" bbType="s" bbTag="*nocomment*"><img
										class="smiley nocomment" src="img/x.gif" alt="*nocomment*"
										title="*nocomment*" /></a><a href="javascript:void(0);"
										bbType="s" bbTag="*noemotion*"><img class="smiley noemotion"
										src="img/x.gif" alt="*noemotion*" title="*noemotion*" /></a><a
										href="javascript:void(0);" bbType="s" bbTag="*notamused*"><img
										class="smiley notamused" src="img/x.gif" alt="*notamused*"
										title="*notamused*" /></a><a href="javascript:void(0);"
										bbType="s" bbTag="*pout*"><img class="smiley pout"
										src="img/x.gif" alt="*pout*" title="*pout*" /></a><a
										href="javascript:void(0);" bbType="s" bbTag="*redface*"><img
										class="smiley redface" src="img/x.gif" alt="*redface*"
										title="*redface*" /></a><a href="javascript:void(0);"
										bbType="s" bbTag="*rolleyes*"><img class="smiley rolleyes"
										src="img/x.gif" alt="*rolleyes*" title="*rolleyes*" /></a><a
										href="javascript:void(0);" bbType="s" bbTag=":("><img
										class="smiley sad" src="img/x.gif" alt=":(" title=":(" /></a><a
										href="javascript:void(0);" bbType="s" bbTag="*shy*"><img
										class="smiley shy" src="img/x.gif" alt="*shy*" title="*shy*" /></a><a
										href="javascript:void(0);" bbType="s" bbTag="*smile*"><img
										class="smiley smile" src="img/x.gif" alt="*smile*"
										title="*smile*" /></a><a href="javascript:void(0);" bbType="s"
										bbTag="*tongue*"><img class="smiley tongue" src="img/x.gif"
										alt="*tongue*" title="*tongue*" /></a><a
										href="javascript:void(0);" bbType="s" bbTag="*veryangry*"><img
										class="smiley veryangry" src="img/x.gif" alt="*veryangry*"
										title="*veryangry*" /></a><a href="javascript:void(0);"
										bbType="s" bbTag="*veryhappy*"><img class="smiley veryhappy"
										src="img/x.gif" alt="*veryhappy*" title="*veryhappy*" /></a><a
										href="javascript:void(0);" bbType="s" bbTag=";)"><img
										class="smiley wink" src="img/x.gif" alt=";)" title=";)" /></a>
								</div>
								<div id="text_troops" name="text_troops">
									<?php
// Selector de trupe: unitatile de baza (1-50) + triburile noi (51-90, gate-uite pe flags).
$__tribeFlags = [6=>'NEW_FUNCTION_TRIBE_HUNS',7=>'NEW_FUNCTION_TRIBE_EGIPTEANS',8=>'NEW_FUNCTION_TRIBE_SPARTANS',9=>'NEW_FUNCTION_TRIBE_VIKINGS'];
for($__u=1;$__u<=90;$__u++){
    if($__u>50){
        $__tr=intdiv($__u-1,10)+1;
        if(!isset($__tribeFlags[$__tr])||!defined($__tribeFlags[$__tr])||!constant($__tribeFlags[$__tr])) continue;
    }
    $__nm=defined('U'.$__u)?constant('U'.$__u):'';
    echo '<a href="javascript:void(0);" bbType="o" bbTag="tid'.$__u.'" ><img class="unit u'.$__u.'" src="img/x.gif" title="'.$__nm.'" alt="'.$__nm.'" /></a>';
}
?><a href="javascript:void(0);" bbType="o" bbTag="hero" ><img class="unit uhero" src="img/x.gif" title="<?php echo U0; ?>" alt="<?php echo U0; ?>" /></a>
								</div>
							</div>
						</div>
						<div class="line bbLine"></div>

						<textarea id="text" name="text"><?php echo $poss; ?></textarea>
						<div id="text_preview" name="text_preview"></div>
					</div> <script>
                            var bbEditor = new BBEditor("text");
                        </script>

				</td>
			</tr>
		</tbody>
	</table>

	<p class="btn">
		<input type="image" id="fbtn_ok" value="ok" name="s1"
			class="dynamic_img" src="img/x.gif" alt="OK" />

</form>
</p>
<span style="color: #DD0000"><b><?php echo TZ_WARNING; ?></b> <?php echo TZ_YOU_CAN_T_USE_THE_VALUES; ?> <b>[message]</b>
	or <b>[/message]</b> <?php echo TZ_IN_YOUR_POST_BECAUSE_IT_CAN_CAUSE; ?></span>