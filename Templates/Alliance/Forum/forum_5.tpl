<?php
############################################################
##              DO NOT REMOVE THIS NOTICE                 ##
##                    MADE BY TTMTT                       ##
##                     FIX BY RONIX                       ##
##                       TRAVIANZ                         ##
############################################################

$cat_id = $_GET['fid'];
$forumData = reset($database->ForumCatEdit($cat_id));

//Check if we can create the thread or not
if($forumData['forum_area'] == 3 && !$opt['opt5']) $alliance->redirect($_GET);

?>
<form method="post" name="post" action="allianz.php?s=2&fid=<?php echo $_GET['fid']; ?>">
	<input type="hidden" name="newtopic" value="1">
	<input type="hidden" name="fid" value="<?php echo $_GET['fid']; ?>">
	<input type="hidden" name="ac" value="newtopic">

	<input type="hidden" name="checkstr" value="c4ca4238a0b923820dcc509a6f75849b"><table cellpadding="1" cellspacing="1" id="new_topic"><thead>
	<tr>
        <th colspan="3"><?php echo TZ_POST_NEW_THREAD; ?></th>
	</tr>
	</thead>
	<tfoot><tr><th colspan="3">&nbsp;</th></tr></tfoot>
	<tbody>
	<tr>

		<th><?php echo TZ_THREAD; ?></td>
		<td colspan="2"><input class="text" type="text" name="thema" maxlength="35"></td>
	</tr>
	<tr>
	<td>
	</td>
	<td colspan="2">
	
			<div bbArea="text" id="text_container" name="text_container">

				<div id="text_toolbar" name="text_toolbar">
					<a href="javascript:void(0);" bbType="d" bbTag="b" ><div title="<?php echo TZ_BOLD; ?>" alt="<?php echo TZ_BOLD; ?>" class="bbButton bbBold"></div></a>
					<a href="javascript:void(0);" bbType="d" bbTag="i" ><div title="<?php echo TZ_ITALIC; ?>" alt="<?php echo TZ_ITALIC; ?>" class="bbButton bbItalic"></div></a>
					<a href="javascript:void(0);" bbType="d" bbTag="u" ><div title="<?php echo TZ_UNDERLINED; ?>" alt="<?php echo TZ_UNDERLINED; ?>" class="bbButton bbUnderscore"></div></a>
					<a href="javascript:void(0);" bbType="d" bbTag="alliance" ><div title="<?php echo ALLIANCE; ?>" alt="<?php echo ALLIANCE; ?>" class="bbButton bbAlliance"></div></a>
					<a href="javascript:void(0);" bbType="d" bbTag="player" ><div title="<?php echo PLAYER; ?>" alt="<?php echo PLAYER; ?>" class="bbButton bbPlayer"></div></a>
					<a href="javascript:void(0);" bbType="d" bbTag="coor" ><div title="<?php echo COORDINATES; ?>" alt="<?php echo COORDINATES; ?>" class="bbButton bbCoordinate"></div></a>
					<a href="javascript:void(0);" bbType="d" bbTag="report" ><div title="<?php echo REPORT; ?>" alt="<?php echo REPORT; ?>" class="bbButton bbReport"></div></a>
					<a href="javascript:void(0);" bbWin="resources" id="text_resourceButton"><div title="<?php echo RESOURCES; ?>" alt="<?php echo RESOURCES; ?>" class="bbButton bbResource"></div></a>

					<a href="javascript:void(0);" bbWin="smilies" id="text_smilieButton"><div title="<?php echo TZ_SMILIES; ?>" alt="<?php echo TZ_SMILIES; ?>" class="bbButton bbSmilie"></div></a>
					<a href="javascript:void(0);" bbWin="troops" id="text_troopButton"><div title="<?php echo TROOPS; ?>" alt="<?php echo TROOPS; ?>" class="bbButton bbTroop"></div></a>
					<a href="javascript:void(0);" id="text_previewButton" bbArea="text"><div title="<?php echo TZ_PREVIEW; ?>" alt="<?php echo TZ_PREVIEW; ?>" class="bbButton bbPreview"></div></a>
					<div class="clear"></div>
					<div id="text_toolbarWindows">
						<div id="text_resources" name="text_resources">
								<a href="javascript:void(0);" bbType="o" bbTag="lumber" ><img src="img/x.gif" class="r1" title="<?php echo TZ_WOOD; ?>" alt="<?php echo TZ_WOOD; ?>" /></a>
								<a href="javascript:void(0);" bbType="o" bbTag="clay" ><img src="img/x.gif" class="r2" title="<?php echo CLAY; ?>" alt="<?php echo CLAY; ?>" /></a>
								<a href="javascript:void(0);" bbType="o" bbTag="iron" ><img src="img/x.gif" class="r3" title="<?php echo IRON; ?>" alt="<?php echo IRON; ?>" /></a>
							<a href="javascript:void(0);" bbType="o" bbTag="crop" ><img src="img/x.gif" class="r4" title="<?php echo CROP; ?>" alt="<?php echo CROP; ?>" /></a></div>
						<div id="text_smilies" name="text_smilies"><a href="javascript:void(0);"  bbType="s" bbTag="*aha*" ><img class="smiley aha" src="img/x.gif" alt="*aha*" title="*aha*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*angry*" ><img class="smiley angry" src="img/x.gif" alt="*angry*" title="*angry*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*cool*" ><img class="smiley cool" src="img/x.gif" alt="*cool*" title="*cool*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*cry*" ><img class="smiley cry" src="img/x.gif" alt="*cry*" title="*cry*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*cute*" ><img class="smiley cute" src="img/x.gif" alt="*cute*" title="*cute*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*depressed*" ><img class="smiley depressed" src="img/x.gif" alt="*depressed*" title="*depressed*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*eek*" ><img class="smiley eek" src="img/x.gif" alt="*eek*" title="*eek*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*ehem*" ><img class="smiley ehem" src="img/x.gif" alt="*ehem*" title="*ehem*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*emotional*" ><img class="smiley emotional" src="img/x.gif" alt="*emotional*" title="*emotional*" /></a><a href="javascript:void(0);"  bbType="s" bbTag=":D" ><img class="smiley grin" src="img/x.gif" alt=":D" title=":D" /></a><a href="javascript:void(0);"  bbType="s" bbTag=":)" ><img class="smiley happy" src="img/x.gif" alt=":)" title=":)" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*hit*" ><img class="smiley hit" src="img/x.gif" alt="*hit*" title="*hit*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*hmm*" ><img class="smiley hmm" src="img/x.gif" alt="*hmm*" title="*hmm*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*hmpf*" ><img class="smiley hmpf" src="img/x.gif" alt="*hmpf*" title="*hmpf*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*hrhr*" ><img class="smiley hrhr" src="img/x.gif" alt="*hrhr*" title="*hrhr*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*huh*" ><img class="smiley huh" src="img/x.gif" alt="*huh*" title="*huh*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*lazy*" ><img class="smiley lazy" src="img/x.gif" alt="*lazy*" title="*lazy*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*love*" ><img class="smiley love" src="img/x.gif" alt="*love*" title="*love*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*nocomment*" ><img class="smiley nocomment" src="img/x.gif" alt="*nocomment*" title="*nocomment*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*noemotion*" ><img class="smiley noemotion" src="img/x.gif" alt="*noemotion*" title="*noemotion*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*notamused*" ><img class="smiley notamused" src="img/x.gif" alt="*notamused*" title="*notamused*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*pout*" ><img class="smiley pout" src="img/x.gif" alt="*pout*" title="*pout*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*redface*" ><img class="smiley redface" src="img/x.gif" alt="*redface*" title="*redface*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*rolleyes*" ><img class="smiley rolleyes" src="img/x.gif" alt="*rolleyes*" title="*rolleyes*" /></a><a href="javascript:void(0);"  bbType="s" bbTag=":(" ><img class="smiley sad" src="img/x.gif" alt=":(" title=":(" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*shy*" ><img class="smiley shy" src="img/x.gif" alt="*shy*" title="*shy*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*smile*" ><img class="smiley smile" src="img/x.gif" alt="*smile*" title="*smile*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*tongue*" ><img class="smiley tongue" src="img/x.gif" alt="*tongue*" title="*tongue*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*veryangry*" ><img class="smiley veryangry" src="img/x.gif" alt="*veryangry*" title="*veryangry*" /></a><a href="javascript:void(0);"  bbType="s" bbTag="*veryhappy*" ><img class="smiley veryhappy" src="img/x.gif" alt="*veryhappy*" title="*veryhappy*" /></a><a href="javascript:void(0);"  bbType="s" bbTag=";)" ><img class="smiley wink" src="img/x.gif" alt=";)" title=";)" /></a></div>
						<div id="text_troops" name="text_troops"><?php
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
?><a href="javascript:void(0);" bbType="o" bbTag="hero" ><img class="unit uhero" src="img/x.gif" title="<?php echo U0; ?>" alt="<?php echo U0; ?>" /></a></div>
					</div>

				</div>
				<div class="line bbLine"></div>

				<textarea id="text" name="text"></textarea>
				<div id="text_preview" name="text_preview"></div>
			</div>

			<script>
				var bbEditor = new BBEditor("text");
			</script>
			
	</td></tr><tr>

		<th><?php echo TZ_SURVEY; ?></th>
		<td>
		<script language="JavaScript" type="text/javascript">
		<!--
			function vote() {
			if (document.post.umfrage.checked == true){
				document.post.umfrage_thema.disabled = false;
				document.getElementById('options').className = '';
				document.post.umfrage_thema.focus();

			} else {
				document.post.umfrage_thema.disabled = true;
				document.getElementById('options').className = 'hide';
			}
		}
		//-->
		</script>
			<input class="text" type="text" name="umfrage_thema" maxlength="60" disabled="disabled" /></td>
			<td class="sel"><input class="check" type="checkbox" name="umfrage" value="1" onclick="vote();" />
		</td>
	</tr>
	<tr id="options" class="hide">

		<th><?php echo OPTION; ?></th>
		<td>
<?php echo TZ_OPTION_1; ?> <input class="text" type="text" name="option_1" maxlength="100" style="width:150px"/><br>
<?php echo TZ_OPTION_2; ?> <input class="text" type="text" name="option_2" maxlength="100" style="width:150px"/><br>
<?php echo TZ_OPTION_3; ?> <input class="text" type="text" name="option_3" maxlength="100" style="width:150px"/><br>
<?php echo TZ_OPTION_4; ?> <input class="text" type="text" name="option_4" maxlength="100" style="width:150px"/><br>
<?php echo TZ_OPTION_5; ?> <input class="text" type="text" name="option_5" maxlength="100" style="width:150px"/><br>
<?php echo TZ_OPTION_6; ?> <input class="text" type="text" name="option_6" maxlength="100" style="width:150px"/><br>
<?php echo TZ_OPTION_7; ?> <input class="text" type="text" name="option_7" maxlength="100" style="width:150px"/><br>
<?php echo TZ_OPTION_8; ?> <input class="text" type="text" name="option_8" maxlength="100" style="width:150px"/><br>
</td>
<td></td>
		</tr>
<tr>
	<th><?php echo TZ_ENDS_ON; ?></th>
	<td>
<script type="text/javascript">
<!--
	function voteEnd() {
	if (document.post.umfrage_ende.checked == true){
		document.post.month.disabled = false;
		document.post.day.disabled = false;
		document.post.year.disabled = false;
		document.post.hour.disabled = false;
		document.post.minute.disabled = false;document.post.meridiem[0].disabled = false;
		document.post.meridiem[1].disabled = false;
	} else {
		document.post.month.disabled = true;
		document.post.day.disabled = true;
		document.post.year.disabled = true;
		document.post.hour.disabled = true;
		document.post.minute.disabled = true;document.post.meridiem[0].disabled = true;
		document.post.meridiem[1].disabled = true;}
}
//-->
</script><select class="dropdown" name="month" disabled="disabled"><option value="01"><?php echo MONTH1; ?></option><option value="02"><?php echo MONTH2; ?></option><option value="03"><?php echo MONTH3; ?></option><option value="04"><?php echo MONTH4; ?></option><option value="05"><?php echo MONTH5; ?></option><option value="06"><?php echo TZ_JUN; ?></option><option value="07"><?php echo TZ_JUL; ?></option><option value="08"><?php echo MONTH8; ?></option><option value="09" selected="selected"><?php echo MONTH9; ?></option><option value="10"><?php echo MONTH10; ?></option><option value="11"><?php echo MONTH11; ?></option><option value="12"><?php echo MONTH12; ?></option></select><select class="dropdown" name="day" disabled="disabled"><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19" selected="selected">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select><select class="dropdown" name="year" disabled="disabled"><option value="<?php echo date('Y'); ?>" selected="selected"><?php echo date('y'); ?></option><option value="<?php echo date('Y')+1; ?>"><?php echo date('y')+1; ?></option></select>&nbsp;&nbsp;&nbsp;<select class="dropdown" name="hour" disabled="disabled"><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10" selected="selected">10</option><option value="11">11</option></select><select class="dropdown" name="minute" disabled="disabled"><option value="0">00</option><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4" selected="selected">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>

		   <input class="radio" type="radio" name="meridiem" value="0" disabled="disabled" /><?php echo TZ_AM; ?>
		   <input class="radio" type="radio" name="meridiem" value="1" disabled="disabled" checked="checked" /><?php echo TZ_PM; ?></td><td class="sel"><input class="check" type="checkbox" name="umfrage_ende" onclick="voteEnd();" />
	</td>
</tr></tbody></table>


<p class="btn"><input type="image" id="fbtn_ok" value="ok" name="s1" class="dynamic_img" src="img/x.gif" alt="OK" /></form></p>
<span style="color: #DD0000"><b><?php echo TZ_WARNING; ?></b> <?php echo TZ_YOU_CAN_T_USE_THE_VALUES; ?> <b>[message]</b> <?php echo constant('OR'); ?> <b>[/message]</b> <?php echo TZ_IN_YOUR_POST_BECAUSE_IT_CAN_CAUSE; ?></span>