[![Code Triagers Badge](https://www.codetriage.com/shadowss/travianz/badges/users.svg)](https://www.codetriage.com/shadowss/travianz) [![Join the chat at https://gitter.im/TravianZ-V8/Lobby](https://badges.gitter.im/TravianZ-V8/Lobby.svg)](https://gitter.im/TravianZ-V8/Lobby?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

TravianZ Version v.8.3.3 BETA b3

Download and updates : https://github.com/Shadowss/TravianZ

Thank you to : Shadowss , advocaite , brainiacX , MisterX , yi12345 , ronix , Elio , martinambrus and many others that make that version posible.

First i want to say THANKS for all who worked on that version , will find a list on Version file.

TravianZ is based on TravianX v6.0.0 or TravianZ or TravianX with some grapich changes from ZravianX.


martinambrus changes:
1. PHP7 compatibility (mysql functions converted to mysqli)
2. a lot of database optimizations (not in code but in MySQL tables themselves, mostly adding indexes to speed things up)
3. fix for a nasty JavaScript bug which was killing the browser with any number of countdown(s) running on page (even one!)
4. large map not centered fix
5. WW Buildings have no aliance (PHP warning removed)
6. password in Admin area for deletion of user is now really a password field
7. Multihunter couldn't progress beyond Quest level 4
8. PLUS settings (including PayPal options) can be configured in Admin
9. installation timeouting fix
10. extra settings in admin save config correctly
11. security tightened to try and prevent MySQL injections from in-game
12. assigning link to alliance forum now works
13. alliance description now really editable
14. Admin SQL injection fixes
15. fix for map not showing natar villages
16. weak MD5 password in database converted into strong bcrypt ones
17. newsbox 1 best player can also show admin if they are enabled in config
18. Natar random attacks show attacker as ?? as intended now
19. System Message can contain quotes and no longer inserts BOM characters at the beginning
20. front-end + Admin page titles now correctly reflect where we really are (so browsing history can be navigated easily instead of showing Travian on every page)
21. Return to Server link in Admin works fine if homepage in config does not end with a slash
22. Great Workshop no longer shows as "Error" in Admin when editing Village
23. Great Workshop added to manual pages
24. new Combat Simulator link when showing details of oasis for quicker determination if we can win that fight
25. Support, Taskmaster & Multihunter no longer shown in statistics as last players with 0 villages
26. invalid `<br />` tags no longer added to description textboxes when editing User in Admin
27. editing additional user data in Admin now saves them when Enter is used instead of clicking on "Save" as well
28. fixed reports pagination always staying on "All" tab
29. fix for the "fixed" :) self-kicking from an alliance
30. fixed sending messages to player via Admin
31. Support user is now a part of the installation and can be logged into Admin and in-game (albeit in game, they have no village, so can not access fields or village views)
32. messages sent to Multihunter now have the correct recepient shown next to them (was empty)
33. new links in Admin to access in-game messages + Mass Message & System Message dialogs
34. mass messages sent out under Support rather than Multihunter (we should not be scaring people :D)
35. fixed displaying of current Quest in Admin
36. fixed OK message in Admin when resetting All Players' PLUS
37. new config option to show Support messages in Admin's mailbox
38. new feature: allowing messages to be sent as Support from in-game when user is Admin + it's allowed in config
39. not allowing installation if old data are still in database to prevent multiple worlds generation and game misbehavior
40. fixed quest 1 to reload the page and allow for immediate completion of the woodcutter
41. NPC links added to units in Hero Mansion
42. fixed random attacks attacker tribe (Natars) when building Wonder of the World
43. players who post in an Alliance forum are now notified of each subsequent post in that topic via messages
44. editing troops in Admin now saves them when Enter is used instead of clicking on "Save" as well
45. added option into Admin config to allow Administrative accounts to be raided and attacked (which also permits trading with them via Market)
46. vastly improved speed of world and oasis generation steps
47. Multihunter & Support password fields are now really password fields
48. login & logout pages redirect to install if game is not installed yet
49. Multihunter can no longer build beyond level 20
50. installation final screen shows info to remove install folder and CHMOD folders on Linux
51. fixed farms generation via Admin - these will be created all over map, not only where new players are currently being placed (players are positioned like this: middle section for first 20 days, then corners, then in between)
52. fixed logged-in check (no longer redirects to login.php from admin when not logged-in to the game itself)
53. horse drinking trough now decreases crop usage by real the amounts of how much crop Roman horse units really consume
54. fixed ability to build Great Warehouse and Great Granary in non-Natar villages
55. fixed ability to build buildings not belonging to player's tribe (trapper, brewery, horse drinking trough)
56. fixed admin help for editing village not showing IDs for all buildings
57. new feature: access log (only in config.php file to be used by advanced users to log game traffic and reveal URL hacks)
58. fixed ability to go back in quests and gain gold and resources all over again when using default quests set
59. fix for "finish immediatelly" PLUS button to decrease gold amount even when demolition alone has been insta-completed
60. fixed maximum of 3 heroes in the Hero's Mansion (+ update of the Admin interface to account for it)
61. new feature: Embassy mechanics overhaul - check out our [Wiki Page](https://github.com/Shadowss/TravianZ/wiki/New-Alliance-&-Embassy-Mechanics) or this [Google Presentation](https://docs.google.com/presentation/d/1KN1qVAlxVj7aAN6F9QkRai1oliajfxKPIaJ4MSodUac/edit?usp=sharing) to learn more about it
666. there's just a lot of stuff being worked on in this project and I'm too lazy to be writing all of it down... when the project is at lease stable, I think this will make sense... for now, it's just an "I did this" shoutout and people can see that in commits


Shadowss changes:
1. Modified Plus System with packages.</br>
2. Modified in Plus System and added Account Statement.</br>
3. Enabled Report Player in Profile. Send message to Multihunter. </br>
4. Enabled Graphic Pack in Profile (NOT CODED YET).</br>
5. Enabled in Profile : Auto Completation , Large Map , Report Filter and Time Preferences (NOT CODED YET).</br>
6. Integrate Support Section in game.</br>
7. Modified footer and menu and added version and bugs (I mean detailed version.php and bugs.php).</br>
8. Modified all admin page , now all pictures appers correctly.</br>
9. Added night / day pictures. (thanks to advocaite).</br>
10. Activate inactive player in Admin Panel.</br>
11. Added Server Maintenence in Admin Panel (Not working 100% , i mean mode ban all players).</br>
12. Activate Player Report in Admin Panel (NOT CODED YET).</br>
13. Many bug fixed in Admin Panel.</br>
14. Negative crop fixed , now units die (starvation). WORKS LIKE REAL TRAVIAN !!!</br>
15. Medal fixed.</br>
16. Added new quests (alliance , main building 5 , granary level 3 , warehouse level 5 , palace or residence , 3 settlers , new village , wall).</br>
17. Winner decoded end time fixed , 403 , 404 , 500 errors are now decoded.</br>
18. Populate and regenerate oasis automation function added and fixed.</br>
19. Fixed palace , now cannot be build more than one palace / accout.</br>
20. Now you need a warehouse and granary level 20 to build great granary and great warehouse.</br>
21. Cannot send attacks and send resource to banned players.</br>
22. Now banned palyer cannot recive resource from marketplace.</br>
23. Fix message replay , now can be viwed from who came message.</br>
24. Added in instalation Nature Regeneration Time.</br>
25. Fix oasis.tpl in instalation files.</br>
26. Fix ranking search from everyware.</br>
27. Fix "Finish all constructions for 2 gold." now you dont lose gold when you simply click.</br>
28. Fix bonus on artefacts , now show what bonus gives you.(thanks to brainiacX)</br>
29. Fix settler bug , now you cannot train settlers if you dont have resource. And also modifyResource function updated. (thanks to brainiacX)</br>
30. Fix brewerey now can be build only on capital.</br>
31. Fix treasurey and palace , now cannot be build on WW village.</br>
32. Fix greatbarraks.</br>
33. Fix eraseble hero , now you can delete your hero.</br>
34. Fix desapear hero when you send as reinforcement.</br>
35. Fix message problem with '</br>
36. Fix train hero for unit pretorian</br>
37. Fix merchant quantity</br>
38. Fix battle system for catapults</br>
39. Fix delete player in admin panel</br>
40. Added automated system for give medals and also added in instalation file</br>
41. Fix special characters when send troops</br>
45. Fix bug 10 from NarcisRO list : If you have plus account activated you cannot see the attck/deff/scout images when you attack a village (i mean img on villages : red swords etc..)</br>
43. Fix forum surveys - NOT DONE</br>
44. Fix wall image when spy someone for every tribe</br>
45. Fix the top romans/teutons/gauls icon must show you the first rank of each race,not the whole page</br>
46. Fix destroy village bug</br>
47. Fix conquer oasis.</br>
48. Fix movements.tpl (now show purple sword if your oasis is attacked or if you found new village)</br>
49. Fixed movements on rally point if your oasis is under attack</br>
50. Fixed vulnerability attack on message.</br>
51. Fixed scouting all player when create natars.</br>
52. Fixed catapult if have artefact for random target. Now can target WW even have that artefact like says.</br>
53. Fix special characters on message (script alert not work now).</br>
54. Fix mightiest bug of travian , double troops , now you won`t have any problems with double troops. Works for own units and for enforcement units.</br>
55. Fix catapult target on brewerey , now you can target brewerey.</br>
56. Added loss protection if you have beginner protection and want to attack a player you loss protection.</br>
57. Fix artefacts, will not win more artifacts from the same village.</br>
58. Fix UTF8 in database and sql.sql file.</br>
59. Fixed Username HACK on register.</br>
60. Fixed Village hack in profile . </br>
61. Fixed a Bug where Founder or a user in alliance can kick himself.</br>
62. Fixed new village must build a rally point. </br>
63. Fix sorting distance artefact village . </br>
64. Fix to conquer oasis: can conquer 1 attack if nature troop die. </br>
65. Fix report scout by Natars. Now report player can see.. </br>
66. Fix area and location like real travian. </br>
67. Fix field natar village set to type=3. </br>
68. Fix natar village area 400/400 or WORLD_MAX not the random area. </br>
69. Fix create_account : cannot create natar if already exist. </br>
70. Fix counter timer if timer < 0 = display 0:00:00 and not display like your time pc. </br>
71. Fix quest_core , now is like real travian. </br>
72. Fix update oasis unit. </br>
73. Fixed Registration hack. </br>
74. Fixed Village hack hidden village and <name> ! </br>
75. Fixed hidden Alliance name and fixed the bug of kicking your self if you are founder or anything else. </br>
76. Fix conquer artefact. </br>
77. Fix ranking and Quest 4. </br>
78. Fix finishAll building/demolition/tecknology. </br>
79. Fix conquer Occupied Oasis. </br>
80. Fix NPC trade on settler in village or palace. </br>
81. Fix bug when paste address to update building or resource , now not possible to upgrade. </br>
82. Fix spy : When defender has no spy's in his village, an incomming spy attack should be unnoticed, and the defender shouldn't get a report and also there shouldn't appear red swords in dorf.1 when there are no own spy's in village.</br>
83. Fix village to destroy and less query. </br>
84. Fix settler to raid (1 unit of settler can carry 3000 resource...wow!!)</br>
85. Fix dorf3 , now timer works corectly. </br>
86. Added timezone in instalation file , and can be edited after installation on config. </br>
87. The damage must be calculate for all troops as a defender. </br>
88. Battle system is fixed and it`s work like real travian. </br>
89. War Simulator system is fixed and it`s work like real travian. </br>
90. Fix calculation culturepoint according to the speed server.</br>
91. Fix to delete hero table when delete user from admin.</br>
92. Fix link to coor village from admin.</br>
93. Fix return troops if village destroy.</br>
94. Fix link list multivillage.</br>
95. Fix rally point to list troops own/other village/oasis.</br>
96. Fix recive report when other player send me reinforcement to my oasis</br>
97. Fix calculate defender hero</br>
98. Fix enforcement oasis</br>
99. Fix hero XP calculation by crop consumed and share point hero xp</br>
100. Fix chiefting village only normal attack can reduce loyalty</br>
101. Fix conquered oasis. Hero must use normal attack if oasis is conquered by other player</br>
102. Fix destroy village.</br>
103. Fix returntroop in oasis when destroy village</br>
104. Fix total point hero and statistics calculation by crop consumption</br>
105. Fix hero reinfocement sometimes mising in action</br>
106. Fix total of trapper bug is full trapp if 1 troop only you send.</br>
107. Fix invalid argument supplied if using masterbuilder</br>
108. Change entire database to InnoDB.

TienTN changes:
1. Change install/templates/config.tpl to deal with deprecated warning from new PHP version.
2. Fix install/data/sql.sql, to be executable in current MySQL version.
3. Fix db_MYSQL.php
	with safe_mysql_fetch_all, and safe_mysqli_fetch_array wrappers, to avoid
	Warning: mysql_fetch_all/array() expects parameter 1 to be resource, boolean given
4. Fix the db_MYSQLi.php in class object declaration(if anybody want to use db_MYSQLi.php again)
5. Fix the unx.js file for error:
	VM5051:1 Uncaught SyntaxError: Unexpected token )
	jd.onreadystatechange @ unx.js?0ac36:170
	This error arises when moving to the border of the map.
6. Fix the map loop moving bug:
	Symptom: For map not set to size 400x400, on the map page,
	when moving on and on in one direction, cross the map border(loop) two times, 
	the moving function will be crashed(freeze, you can't move any more).
	I found out that unx.js handle a static map size(400x400).
	So I fixed this with a m_c.world_max variable from mapview.tpl and changed the unx.js accordingly.
7. Fix the constructor global variable missing in Session.php


TPLinux Changes:
1. Fix FinishAll with two gold issue/bug
2. Fix Reload crush issue after building construction finished
3. Fix in_array bug in show more buldings in WWV 
4. Fix winner redirection
5. Fix winner WW image path
6. Convert '<?' To '<?php' in a2ab.php (Account transaction page)
7. Fixing ( Building shape not upgraded after Construct finish )
8. Change multihunter msg color to orange 
9. Change fetch time to server speed if > 5
10. Fixing Quest not appears if press (play no tasks)
11. Fix the redirection from rally point when attack is finished
12. Remove Rally point advantage
13. Fix fullscreen map in rtl layout
14. Fix divesion by Zero bug in general statics
--
