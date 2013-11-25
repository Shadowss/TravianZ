<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       version.php                                                 ##
##  Developed by:  Shadow                                                      ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################


include("GameEngine/Village.php");
$amount = $_SESSION['amount'];
$start = $generator->pageLoadTimeStart();
if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	header("Location: ".$_SERVER['PHP_SELF']);
}
else {
	$building->procBuild($_GET);
}
$automation->isWinner();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo SERVER_NAME ?></title>
	<link REL="shortcut icon" HREF="favicon.ico"/>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="mt-full.js?0faaa" type="text/javascript"></script>
	<script src="unx.js?0faaa" type="text/javascript"></script>
	<script src="new.js?0faaa" type="text/javascript"></script>
	<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7c" rel="stylesheet" type="text/css" />
	<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7c" rel="stylesheet" type="text/css" />
	<?php
	if($session->gpack == null || GP_ENABLE == false) {
	echo "
	<link href='".GP_LOCATE."travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='".GP_LOCATE."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
	} else {
	echo "
	<link href='".$session->gpack."travian.css?e21d2' rel='stylesheet' type='text/css' />
	<link href='".$session->gpack."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
	}
	?>
	<script type="text/javascript">

		window.addEvent('domready', start);
	</script>
</head>
<body class="v35 ie ie8">
<div class="wrapper">
<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" />
<div id="dynamic_header">
	</div>
<?php include("Templates/header.tpl"); ?>
<div id="mid">
<?php include("Templates/menu.tpl"); ?>
<?php include("Templates/version.tpl"); ?>
<h1>Version Changes</h1>
<div id="products">

1. Modified register page with pictures.</br>
2. Modified names of tribes with colours.</br>
3. Modified Plus System with packages.</br>
4. Modified in Plus System and added Account Statement.</br>
5. Enabled Report Player in Profile. Send message to Multihunter. </br>
6. Enabled Graphic Pack in Profile (NOT CODED YET).</br>
7. Enabled in Profile : Auto Completation , Large Map , Report Filter and Time Preferences (NOT CODED YET).</br>
8. Added Vacation Mod . Can be set from profile , cannot attack player on vacation mode , can view on profile (overview), cannot login on vacation mode. (thanks to advocaite).</br>
9. Integrate Support Section in game.</br>
10. Modified footer and menu and added version and bugs (I mean detailed version.php and bugs.php).</br>
11. Modified all admin page , now all pictures appers correctly.</br>
12. Added night / day pictures. (thanks to advocaite).</br>
13. Activate inactive player in Admin Panel.</br>
14. Added Server Maintenence in Admin Panel (Not working 100% , i mean mode ban all players).</br>
15. Activate Player Report in Admin Panel (NOT CODED YET).</br>
16. Many bug fixed in Admin Panel.</br>
17. Negative crop fixed , now units die (starvation). WORKS LIKE REAL TRAVIAN !!!</br>
18. Medal fixed.</br>
19. Added image in Profile (like beginner protection) for tribes [#roman] , [#gaul] , [#teuton]</br>
20. Added image in profile for Multihunter and Admin [#MH] automaticaly set on install.</br>
21. Added image in profile for Taskmaster and Nature [#TASKMASTER] , [#NATURE] , automaticaly set on install.</br>
22. Added numbers of village in overview Villages  [ 35 ]</br>
23. Added oassis type in Profile / Overview </br>
24. Added in karte.php (vilview.tpl) if you are in vacation mode , you cannot send resource.</br>
25. Added in reports images for every report (reinforcement , attacks , resource , peace).</br>
26. Added new quests (alliance , main building 5 , granary level 3 , warehouse level 5 , palace or residence , 3 settlers , new village , wall).</br>
27. Winner decoded end time fixed , 403 , 404 , 500 errors are now decoded.</br>
28. Populate and regenerate oasis automation function added and fixed.</br>
29. Fixed palace , now cannot be build more than one palace / accout.</br>
30. Now you need a warehouse and granary level 20 to build great granary and great warehouse.</br>
31. Cannot send attacks and send resource to banned / vacation players.</br>
32. Now banned palyer and vacation mode player cannot recive resource from marketplace.</br>
33. Fix message replay , now can be viwed from who came message.</br>
34. Added in instalation Nature Regeneration Time.</br>
35. Fix oasis.tpl in instalation files.</br>
36. Fix ranking search from everyware.</br>
37. Fix "Finish all constructions for 2 gold." now you dont lose gold when you simply click.</br>
38. Fix bonus on artefacts , now show what bonus gives you.(thanks to brainiacX)</br>
39. Fix settler bug , now you cannot train settlers if you dont have resource. And also modifyResource function updated. (thanks to brainiacX)</br>
40. Fix brewerey now can be build only on capital.</br>
41. Fix treasurey and palace , now cannot be build on WW village.</br>
42. Fix greatbarraks.</br>
43. Fix eraseble hero , now you can delete your hero.</br>
44. Fix desapear hero when you send as reinforcement.</br>
45. Fix message problem with '</br>
46. Fix train hero for unit pretorian</br>
47. Fix merchant quantity</br>
48. Fix battle system for catapults</br>
49. Fix delete player in admin panel</br>
50. Added automated system for give medals and also added in instalation file</br>
51. Fix special characters when send troops</br>
52. Fix reference link</br>
53. Fix bug 10 from NarcisRO list : If you have plus account activated you cannot see the attck/deff/scout images when you attack a village (i mean img on villages : red swords etc..)</br>
54. Fix forum surveys - NOT DONE</br>
55. Fix wall image when spy someone for every tribe</br>
56. Fix the top romans/teutons/gauls icon must show you the first rank of each race,not the whole page</br>
57. Fix destroy village bug</br>
58. Fix conquer oasis.</br>
59. Fix movements.tpl (now show purple sword if your oasis is attacked or if you found new village)</br>
60. Fixed movements on rally point if your oasis is under attack</br>
61. Fixed vulnerability attack on message.</br>
62. Fixed scouting all player when create natars.</br>
63. Fixed catapult if have artefact for random target. Now can target WW even have that artefact like says.</br>
64. Added graphic pack T4 (buildings , village view , building in construction , etc.)</br>
65. Fix special characters on message (script alert not work now).</br>
66. Fix mightiest bug of travian , double troops , now you won`t have any problems with double troops. Works for own units and for enforcement units.</br>
67. Fix catapult target on brewerey , now you can target brewerey.</br>
68. Added loss protection if you have beginner protection and want to attack a player you loss protection.</br>
69. Fix artefacts, will not win more artifacts from the same village.</br>
70. Fix UTF8 in database and sql.sql file.</br>
71. Fixed Username HACK on register.</br>
72. Fixed Village hack in profile . </br>
73. Fixed a Bug where Founder or a user in alliance can kick himself.</br>
74. Fixed new village must build a rally point. </br>
75. Fix sorting distance artefact village . </br>
76. Fix to conquer oasis: can conquer 1 attack if nature troop die. </br>
77. Fix report scout by Natars. Now report player can see.. </br>
78. Fix area and location like real travian. </br>
79. Fix field natar village set to type=3. </br>
80. Fix natar village area 400/400 or WORLD_MAX not the random area. </br>
81. Fix create_account : cannot create natar if already exist. </br>
82. Fix counter timer if timer < 0 = display 0:00:00 and not display like your time pc. </br>
83. Fix quest_core , now is like real travian. </br>
84. Fix update oasis unit. </br>
85. Fixed Registration hack. </br>
86. Fixed Village hack hidden village and <name> ! </br>
87. Fixed hidden Alliance name  and fixed the bug of kicking your self if you are founder or anything else. </br>
88. Fix conquer artefact. </br>
89. Fix ranking and Quest 4. </br>
90. Fix finishAll building/demolition/tecknology. </br>
91. Fix conquer Occupied Oasis. </br>
92. Fix NPC trade on settler in village or palace. </br>
93. Fix bug when paste address to update building or resource , now not possible to upgrade. </br>
94. Fix spy : When defender has no spy's in his village, an incomming spy attack should be unnoticed, and the defender shouldn't get a report and also there shouldn't appear red swords in dorf.1 when there are no own spy's in village.</br>
95. Fix village to destroy and less query. </br>
96. Fix settler to raid (1 unit of settler can carry 3000 resource...wow!!)</br>
97. Fix dorf3 , now timer works corectly. </br>
98. Added timezone in instalation file , and can be edited after installation on config. </br>
99. The damage must be calculate for all troops as a defender. </br>
100. Battle system is fixed and it`s work like real travian. </br>
101. War Simulator system is fixed and it`s work like real travian. </br>
102. Fix calculation culturepoint according to the speed server.</br>
103. Fix to delete hero table when delete user from admin.</br>
104. Fix link to coor village from admin.</br>
105. Fix return troops if village destroy.</br>
106. Fix link list multivillage.</br>
107. Fix rally point to list troops own/other village/oasis.</br>
108. Fix recive report when other player send me reinforcement to my oasis</br>
109. Fix calculate defender hero</br>
110. Fix enforcement oasis</br>
111. Fix hero XP calculation by crop consumed and share point hero xp</br>
112. Fix chiefting village only normal attack can reduce loyalty</br>
113. Fix conquered oasis. Hero must use normal attack if oasis is conquered by other player</br>
114. Fix destroy village.</br>
115. Fix returntroop in oasis when destroy village</br>
116. Fix total point hero and statistics calculation by crop consumption</br>
117. Fix hero reinfocement sometimes mising in action</br>
118. Fix total of trapper bug is full trapp if 1 troop only you send.</br>
119. Fix invalid argument supplied if using masterbuilder</br>

</div>
</div>
</br></br></br></br><div id="side_info">
<?php
include("Templates/multivillage.tpl");
include("Templates/quest.tpl");
include("Templates/news.tpl");
include("Templates/links.tpl");
?>
</div>
<div class="clear"></div>
</div>
<div class="footer-stopper"></div>
<div class="clear"></div>

<?php
include("Templates/footer.tpl");
include("Templates/res.tpl");
?>
<div id="stime">
<div id="ltime">
<div id="ltimeWrap">
Calculated in <b><?php
echo round(($generator->pageLoadTimeEnd()-$start)*1000);
?></b> ms

<br />Server time: <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
</div>
	</div>
</div>

<div id="ce"></div>
</body>
</html>
