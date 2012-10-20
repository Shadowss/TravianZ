<div id="content"  class="messages">
<h1>Messages</h1>
<?php 
include("menu.tpl");
$user = $database->getUserArray($session->uid, 1);
?>
<script language="JavaScript" type="text/javascript">
		function setReceiver(name) {
			document.getElementById('receiver').value = name;
			copyElement('receiver');
		}

		function closeFriendsList() {
			document.getElementById('adressbook').className = 'hide';
		}

		function toggleFriendsList() {
			var book = document.getElementById('adressbook');
			if (book.className == 'hide')
				book.className = '';
			else
				book.className = 'hide';
		}

		function copyElement(element) {
			if (element == 'receiver') {
				document.getElementById('copy_receiver').value = document.getElementById('receiver').value;
			} else if (element == 'subject') {
				document.getElementById('copy_subject').value = document.getElementById('subject').value;
			} else if (element == 'body') {
				document.getElementById('copy_igm').value = document.getElementById('message').value;
			}
		}

		function submitDefault (type,uid) {
			var book = document.abform;
			book.sbmtype.value = type;
			book.sbmvalue.value = uid;
			book.submit();
		}

	</script>
<div id="write_head" class="msg_head"></div>
<div id="write_content" class="msg_content">
	<form method="post" action="nachrichten.php" accept-charset="UTF-8" name="msg">
	<input type="hidden" name="c" value="3e9" />
	<input type="hidden" name="p" value="" />
		<img src="img/x.gif" id="label" class="send" alt="" />
	<div id="heading">
		<input class="text" type="text" name="an" id="receiver" value="<?php if(isset($id)) { echo $database->getUserField($id,'username',0); } ?>" maxlength="20" onkeyup="copyElement('receiver')" tabindex=1; /><br />
<input class="text" type="text" name="be" id="subject" value="<?php if(isset($message->reply['topic'])) 
{ 
   if (preg_match("/re([0-9]+)/i",$message->reply['topic'],$c)) 
   { 
       $c = $c[1]+1; 
       echo $message->reply['topic'] = preg_replace("/re[0-9]+/i","re".($c),$message->reply['topic']); 
}else{ 
echo "re1:".$message->reply['topic']; }} ?>" maxlength="35" onkeyup="copyElement('subject')" tabindex=2/>
	</div>
<a id="adbook" href="#" onclick="toggleFriendsList(); return false;"><img src="img/x.gif" alt="Addressbook" title="Addressbook" /></a>
<div class="clear"></div>
<div class="line"></div>

			<div bbArea="message" id="message_container" name="message_container">
				<div id="message_toolbar" name="message_toolbar">
					<a href="javascript:void(0);" bbType="d" bbTag="b" ><div title="bold" alt="bold" class="bbButton bbBold"></div></a>
					<a href="javascript:void(0);" bbType="d" bbTag="i" ><div title="italic" alt="italic" class="bbButton bbItalic"></div></a>
					<a href="javascript:void(0);" bbType="d" bbTag="u" ><div title="underline" alt="underline" class="bbButton bbUnderscore"></div></a>
					<a href="javascript:void(0);" bbType="d" bbTag="alliance0" ><div title="alliance" alt="alliance" class="bbButton bbAlliance"></div></a>
					<a href="javascript:void(0);" bbType="d" bbTag="player0" ><div title="player" alt="player" class="bbButton bbPlayer"></div></a>
					<a href="javascript:void(0);" bbType="d" bbTag="coor0" ><div title="coordinates" alt="coordinates" class="bbButton bbCoordinate" onclick="this.form.submit(); window.location.href = '?t=1&coor=<?php echo $coor+1; ?>';"></div></a>
					<a href="javascript:void(0);" bbType="d" bbTag="report0" ><div title="report" alt="report" class="bbButton bbReport"></div></a>
					<a href="javascript:void(0);" bbWin="resources" id="message_resourceButton"><div title="resources" alt="resources" class="bbButton bbResource"></div></a>
					<a href="javascript:void(0);" bbWin="smilies" id="message_smilieButton"><div title="smilies" alt="smilies" class="bbButton bbSmilie"></div></a>
					<a href="javascript:void(0);" bbWin="troops" id="message_troopButton"><div title="troops" alt="troops" class="bbButton bbTroop"></div></a>
					<a href="javascript:void(0);" id="message_previewButton" bbArea="message"><div title="preview" alt="preview" class="bbButton bbPreview"></div></a>
					<div class="clear"></div>
					<div id="message_toolbarWindows">
						<div id="message_resources" name="message_resources"><a href="javascript:void(0);" bbType="o" bbTag="l" ><img src="img/x.gif" class="r1" title="Lumber" alt="Lumber" /></a><a href="javascript:void(0);" bbType="o" bbTag="cl" ><img src="img/x.gif" class="r2" title="Clay" alt="Clay" /></a><a href="javascript:void(0);" bbType="o" bbTag="i" ><img src="img/x.gif" class="r3" title="Iron" alt="Iron" /></a><a href="javascript:void(0);" bbType="o" bbTag="c" ><img src="img/x.gif" class="r4" title="Crop" alt="Crop" /></a></div>
						<div id="message_smilies" name="message_smilies"><a href="javascript:void(0);"  bbType="s" bbTag="*aha*" ><img class="smiley aha" src="img/x.gif" alt="*aha*" title="*aha*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*angry*" ><img class="smiley angry" src="img/x.gif" alt="*angry*" title="*angry*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*cool*" ><img class="smiley cool" src="img/x.gif" alt="*cool*" title="*cool*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*cry*" ><img class="smiley cry" src="img/x.gif" alt="*cry*" title="*cry*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*cute*" ><img class="smiley cute" src="img/x.gif" alt="*cute*" title="*cute*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*depressed*" ><img class="smiley depressed" src="img/x.gif" alt="*depressed*" title="*depressed*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*eek*" ><img class="smiley eek" src="img/x.gif" alt="*eek*" title="*eek*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*ehem*" ><img class="smiley ehem" src="img/x.gif" alt="*ehem*" title="*ehem*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*emotional*" ><img class="smiley emotional" src="img/x.gif" alt="*emotional*" title="*emotional*" /></a><a href="javascript:void(0);"  bbType="s" bbTag=":D" ><img class="smiley grin" src="img/x.gif" alt=":D" title=":D" /></a><a href="javascript:void(0);"  bbType="s" bbTag=":)" ><img class="smiley happy" src="img/x.gif" alt=":)" title=":)" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*hit*" ><img class="smiley hit" src="img/x.gif" alt="*hit*" title="*hit*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*hmm*" ><img class="smiley hmm" src="img/x.gif" alt="*hmm*" title="*hmm*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*hmpf*" ><img class="smiley hmpf" src="img/x.gif" alt="*hmpf*" title="*hmpf*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*hrhr*" ><img class="smiley hrhr" src="img/x.gif" alt="*hrhr*" title="*hrhr*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*huh*" ><img class="smiley huh" src="img/x.gif" alt="*huh*" title="*huh*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*lazy*" ><img class="smiley lazy" src="img/x.gif" alt="*lazy*" title="*lazy*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*love*" ><img class="smiley love" src="img/x.gif" alt="*love*" title="*love*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*nocomment*" ><img class="smiley nocomment" src="img/x.gif" alt="*nocomment*" title="*nocomment*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*noemotion*" ><img class="smiley noemotion" src="img/x.gif" alt="*noemotion*" title="*noemotion*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*notamused*" ><img class="smiley notamused" src="img/x.gif" alt="*notamused*" title="*notamused*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*pout*" ><img class="smiley pout" src="img/x.gif" alt="*pout*" title="*pout*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*redface*" ><img class="smiley redface" src="img/x.gif" alt="*redface*" title="*redface*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*rolleyes*" ><img class="smiley rolleyes" src="img/x.gif" alt="*rolleyes*" title="*rolleyes*" /></a><a href="javascript:void(0);"  bbType="s" bbTag=":(" ><img class="smiley sad" src="img/x.gif" alt=":(" title=":(" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*shy*" ><img class="smiley shy" src="img/x.gif" alt="*shy*" title="*shy*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*smile*" ><img class="smiley smile" src="img/x.gif" alt="*smile*" title="*smile*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*tongue*" ><img class="smiley tongue" src="img/x.gif" alt="*tongue*" title="*tongue*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*veryangry*" ><img class="smiley veryangry" src="img/x.gif" alt="*veryangry*" title="*veryangry*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*veryhappy*" ><img class="smiley veryhappy" src="img/x.gif" alt="*veryhappy*" title="*veryhappy*" /></a><a href="javascript:void(0);"  bbType="s" bbTag=";)" ><img class="smiley wink" src="img/x.gif" alt=";)" title=";)" /></a></div>
						<div id="message_troops" name="message_troops"><a href="javascript:void(0);" bbType="o" bbTag="tid1" ><img class="unit u1" src="img/x.gif"  title="Legionnaire" alt="Legionnaire" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid2" ><img class="unit u2" src="img/x.gif"  title="Praetorian" alt="Praetorian" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid3" ><img class="unit u3" src="img/x.gif"  title="Imperian" alt="Imperian" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid4" ><img class="unit u4" src="img/x.gif"  title="Equites Legati" alt="Equites Legati" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid5" ><img class="unit u5" src="img/x.gif"  title="Equites Imperatoris" alt="Equites Imperatoris" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid6" ><img class="unit u6" src="img/x.gif"  title="Equites Caesaris" alt="Equites Caesaris" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid7" ><img class="unit u7" src="img/x.gif"  title="Battering Ram" alt="Battering Ram" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid8" ><img class="unit u8" src="img/x.gif"  title="Fire Catapult" alt="Fire Catapult" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid9" ><img class="unit u9" src="img/x.gif"  title="Senator" alt="Senator" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid10" ><img class="unit u10" src="img/x.gif"  title="Settler" alt="Settler" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid11" ><img class="unit u11" src="img/x.gif"  title="Clubswinger" alt="Clubswinger" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid12" ><img class="unit u12" src="img/x.gif"  title="Spearman" alt="Spearman" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid13" ><img class="unit u13" src="img/x.gif"  title="Axeman" alt="Axeman" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid14" ><img class="unit u14" src="img/x.gif"  title="Scout" alt="Scout" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid15" ><img class="unit u15" src="img/x.gif"  title="Paladin" alt="Paladin" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid16" ><img class="unit u16" src="img/x.gif"  title="Teutonic Knight" alt="Teutonic Knight" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid17" ><img class="unit u17" src="img/x.gif"  title="Ram" alt="Ram" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid18" ><img class="unit u18" src="img/x.gif"  title="Catapult" alt="Catapult" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid19" ><img class="unit u19" src="img/x.gif"  title="Chief" alt="Chief" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid20" ><img class="unit u20" src="img/x.gif"  title="Settler" alt="Settler" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid21" ><img class="unit u21" src="img/x.gif"  title="Phalanx" alt="Phalanx" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid22" ><img class="unit u22" src="img/x.gif"  title="Swordsman" alt="Swordsman" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid23" ><img class="unit u23" src="img/x.gif"  title="Pathfinder" alt="Pathfinder" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid24" ><img class="unit u24" src="img/x.gif"  title="Theutates Thunder" alt="Theutates Thunder" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid25" ><img class="unit u25" src="img/x.gif"  title="Druidrider" alt="Druidrider" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid26" ><img class="unit u26" src="img/x.gif"  title="Haeduan" alt="Haeduan" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid27" ><img class="unit u27" src="img/x.gif"  title="Ram" alt="Ram" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid28" ><img class="unit u28" src="img/x.gif"  title="Trebuchet" alt="Trebuchet" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid29" ><img class="unit u29" src="img/x.gif"  title="Chieftain" alt="Chieftain" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid30" ><img class="unit u30" src="img/x.gif"  title="Settler" alt="Settler" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid31" ><img class="unit u31" src="img/x.gif"  title="Rat" alt="Rat" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid32" ><img class="unit u32" src="img/x.gif"  title="Spider" alt="Spider" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid33" ><img class="unit u33" src="img/x.gif"  title="Snake" alt="Snake" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid34" ><img class="unit u34" src="img/x.gif"  title="Bat" alt="Bat" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid35" ><img class="unit u35" src="img/x.gif"  title="Wild Boar" alt="Wild Boar" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid36" ><img class="unit u36" src="img/x.gif"  title="Wolf" alt="Wolf" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid37" ><img class="unit u37" src="img/x.gif"  title="Bear" alt="Bear" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid38" ><img class="unit u38" src="img/x.gif"  title="Crocodile" alt="Crocodile" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid39" ><img class="unit u39" src="img/x.gif"  title="Tiger" alt="Tiger" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid40" ><img class="unit u40" src="img/x.gif"  title="Elephant" alt="Elephant" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid41" ><img class="unit u41" src="img/x.gif"  title="Pikeman" alt="Pikeman" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid42" ><img class="unit u42" src="img/x.gif"  title="Thorned Warrior" alt="Thorned Warrior" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid43" ><img class="unit u43" src="img/x.gif"  title="Guardsman" alt="Guardsman" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid44" ><img class="unit u44" src="img/x.gif"  title="Birds Of Prey" alt="Birds Of Prey" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid45" ><img class="unit u45" src="img/x.gif"  title="Axerider" alt="Axerider" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid46" ><img class="unit u46" src="img/x.gif"  title="Natarian Knight" alt="Natarian Knight" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid47" ><img class="unit u47" src="img/x.gif"  title="War Elephant" alt="War Elephant" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid48" ><img class="unit u48" src="img/x.gif"  title="Ballista" alt="Ballista" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid49" ><img class="unit u49" src="img/x.gif"  title="Natarian Emperor" alt="Natarian Emperor" /></a><a href="javascript:void(0);" bbType="o" bbTag="tid50" ><img class="unit u50" src="img/x.gif"  title="Settler" alt="Settler" /></a><a href="javascript:void(0);" bbType="o" bbTag="hero" ><img class="unit uhero" src="img/x.gif" title="Hero" alt="Hero" /></a></div>
					</div>
				</div>
				<div class="line bbLine"></div>
	
				<textarea id="message" name="message" onkeyup="copyElement('body')" tabindex="3" class="textarea write message"><?php if(isset($message->reply['message'])) { echo " \n\n_________________________
Reply:
\n".stripslashes($message->reply['message']); } ?></textarea>
				<div id="message_preview" name="message_preview" class="message"></div>
			</div>
			
				<script>
				var bbEditor = new BBEditor("message");
			</script>
					<p class="btn">
		<input type="hidden" name="ft" value="m2" />
		<input type="image" value="" name="s1" id="btn_send" class="dynamic_img" src="img/x.gif" alt="send" onclick="this.disabled=true;this.form.submit();" tabindex=4; />			
	</p>
	</form>
	<div id="adressbook" class="hide"><h2>Addressbook</h2>
    <form method="post" action="nachrichten.php">
	<input type="hidden" name="ft" value="m7" />
	<input type="hidden" name="myid" value="<?php echo $session->uid; ?>" />
 <table cellpadding="1" cellspacing="1" id="friendlist">
<?php for($i=0;$i<20;$i++) {
if($user['friend'.$i] == 0 && $user['friend'.$i.'wait'] == 0){
if(is_int($i/2)){ echo "<tr>"; } ?><td class="end"></td>
  <td class="pla">
    <input class="text" type="text" name="addfriends<?php echo $i; ?>" value="" maxlength="20" />
  </td>
  <td class="on"></td><?php if(!is_int($i/2)){ echo "</tr>"; }else{ echo "<td></td>";}}else if($user['friend'.$i.'wait'] == 0){
if(is_int($i/2)){ echo "<tr>"; } ?><td class="end"><a href="nachrichten.php?delfriend=<?php echo $i; ?>"><img class="del" src="img/x.gif" alt="delete" title="delete"></td>
  <td class="pla">
  <?php echo "<a href=\"nachrichten.php?t=1&id=".$user['friend'.$i]."\">".$database->getUserField($user['friend'.$i],"username",0)."</a>"; ?>
  </td>
		<?php
		$friend = $database->getUserArray($user['friend'.$i], 1);
		if ((time()-600) < $friend['timestamp']){ // 0 Min - 10 Min
            echo "    <td class=on><img class=online1 src=img/x.gif title='Now online' alt='Now online' /></td>";
        }elseif ((time()-86400) < $friend['timestamp'] && (time()-600) > $friend['timestamp']){ // 10 Min - 1 Days
            echo "    <td class=on><img class=online2 src=img/x.gif title='Offline' alt='Offline' /></td>";              
            }elseif ((time()-259200) < $friend['timestamp'] && (time()-86400) > $friend['timestamp']){ // 1-3 Days
            echo "    <td class=on><img class=online3 src=img/x.gif title='Last 3 days' alt='Last 3 days' /></td>";    
        }elseif ((time()-604800) < $friend['timestamp'] && (time()-259200) > $friend['timestamp']){
            echo "    <td class=on><img class=online4 src=img/x.gif title='Last 7 days' alt='Last 7 days' /></td>";    
        }else{
             echo "    <td class=on><img class=online5 src=img/x.gif title=inactive alt=inactive /></td>";   
        }
if(!is_int($i/2)){ echo "</tr>"; }else{ echo "<td></td>";}
  }else{
$friend = $database->getUserArray($user['friend'.$i.'wait'], 1);
$friendwait = 0;
for($j=0;$j<20;$j++) {
if($friend['friend'.$j.'wait'] == $session->uid){
$wait = $friend['friend'.$j];
$friendwait = $friend['id'];
}
}
if($wait == 0){
if(is_int($i/2)){ echo "<tr>"; } ?><td class="end"><a href="nachrichten.php?delfriend=<?php echo $i; ?>"><img class="del" src="img/x.gif" alt="delete" title="delete"></td>
  <td class="pla">
  <?php echo "<img src=\"../../".GP_LOCATE."img/a/clock-inactive.gif\" alt=\"wait for confirm\" title=\"wait for confirm\"><a href=\"nachrichten.php?t=1&id=".$user['friend'.$i]."\"> ".$database->getUserField($user['friend'.$i],"username",0)."</a>"; ?>
  </td>
		<?php
            echo "<td class=on></td>";
if(!is_int($i/2)){ echo "</tr>"; }else{ echo "<td></td>";}
}else{
if(is_int($i/2)){ echo "<tr>"; } ?><td class="end"><a href="nachrichten.php?delfriend=<?php echo $i; ?>"><img class="del" src="img/x.gif" alt="delete" title="delete"></td>
  <td class="pla">
  <?php echo "<a href=\"nachrichten.php?t=1&id=".$friendwait."\">".$database->getUserField($friendwait,"username",0)."</a>"; ?>
  </td>		
            <td class="on"><a href="nachrichten.php?confirm=<?php echo $i; ?>"><img src="../../<?php echo GP_LOCATE; ?>img/a/online6.gif" alt="confirm" title="confirm"></a></td>
<?php
if(!is_int($i/2)){ echo "</tr>"; }else{ echo "<td></td>";}
}
  }} ?>
  </tr></table>
  <p class="btn">
  <input type="image" value="" name="s1" id="btn_save" class="dynamic_img" src="img/x.gif" alt="save" />  
  </p>
  </form><a href="#" onclick="closeFriendsList(); return false;"><img src="img/x.gif" id="close" alt="close adressbook" title="close adressbook"/></a></div></div>
<div id="write_foot" class="msg_foot">
</div>
<br />
<span style="color: #DD0000"><b>Warning:</b> you can't use the values <b>[message]</b> or <b>[/message]</b> in your message because it can cause problem with bbcode system.</span>
</div>