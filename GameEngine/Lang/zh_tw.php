<?php

//////////////////////////////////////////////////////////////////////////////////////////////////////
//                                             TRAVIANX                                             //
//            Only for advanced users, do not edit if you dont know what are you doing!             //
//                                Made by: Dzoki & Dixie (TravianX)                                 //
//                              - TravianX = Travian Clone Project -                                //
//                                 DO NOT REMOVE COPYRIGHT NOTICE!                                  //
//////////////////////////////////////////////////////////////////////////////////////////////////////
									//                         //
									//         ENGLISH         //
									//      Author: Dzoki      //
									/////////////////////////////

//MAIN MENU
define("TRIBE1","羅馬人");
define("TRIBE2","條頓人");
define("TRIBE3","高盧人");
define("TRIBE4","自然界");
define("TRIBE5","達賴族");
define("TRIBE6","Monsters");

define("HOME","首頁");
define("INSTRUCT","說明");
define("ADMIN_PANEL","管理員控制台-ACP");
define("MASS_MESSAGE","發送群信");
define("LOGOUT","登出");
define("PROFILE","個人資料");
define("SUPPORT","支援");
define("UPDATE_T_10","更新前10名");
define("SYSTEM_MESSAGE","系統公告");
define("TRAVIAN_PLUS","Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></span></span></b>");
define("CONTACT","聯絡我們!");
define("GAME_RULES","遊戲規定");

//MENU
define("REG","註冊");
define("FORUM","論壇");
define("CHAT","聊天室");
define("IMPRINT","Imprint");
define("MORE_LINKS","更多連結");
define("TOUR","Game Tour");


//ERRORS
define("USRNM_EMPTY","(Username empty)");
define("USRNM_TAKEN","(Name is already in use.)");
define("USRNM_SHORT","(min. ".USRNM_MIN_LENGTH." figures)");
define("USRNM_CHAR","(Invalid Characters)");
define("PW_EMPTY","(Password empty)");
define("PW_SHORT","(min. ".PW_MIN_LENGTH." figures)");
define("PW_INSECURE","(Password insecure. Please choose a more secure one.)");
define("EMAIL_EMPTY","(Email Empty)");
define("EMAIL_INVALID","(Invalid email address)");
define("EMAIL_TAKEN","(Email is already in use)");
define("TRIBE_EMPTY","<li>Please choose a tribe.</li>");
define("AGREE_ERROR","<li>You have to agree to the game rules and the general terms & conditions in order to register.</li>");
define("LOGIN_USR_EMPTY","Enter name.");
define("LOGIN_PASS_EMPTY","Enter password.");
define("EMAIL_ERROR","Email does not match existing");
define("PASS_MISMATCH","Passwords do not match");
define("ALLI_OWNER","Please appoint an alliance owner before deleting");
define("SIT_ERROR","Sitter already set");
define("USR_NT_FOUND","Name does not exist.");
define("LOGIN_PW_ERROR","The password is wrong.");
define("WEL_TOPIC","Useful tips & information ");
define("ATAG_EMPTY","Tag empty");
define("ANAME_EMPTY","Name empty");
define("ATAG_EXIST","Tag taken");
define("ANAME_EXIST","Name taken");
define("NOT_OPENED_YET","Server not started yet.");
define("REGISTER_CLOSED","The register is closed. You can't register to this server.");
define("NAME_EMPTY","Please insert name");
define("NAME_NO_EXIST","There is no user with the name ");
define("ID_NO_EXIST","There is no user with the id ");
define("SAME_NAME","You can't invite yourself");
define("ALREADY_INVITED"," already invited");
define("ALREADY_IN_ALLY"," already in this alliance");

//COPYRIGHT
define("TRAVIAN_COPYRIGHT","TravianZ 100% Open Source Travian Clone.");

//BUILD.TPL
define("CUR_PROD","目前的產量");
define("NEXT_PROD","產量在等級 ");

//BUILDINGS
define("B1","伐木場");
define("B1_DESC","伐木場是砍伐木材的地方.伐木場等級越高,單位時間內能砍伐的木材也就越多.");
define("B2","泥坑");
define("B2_DESC","泥坑是生產泥土的地方.泥坑等級越高,單位時間內生產的磚塊也就越多.");
define("B3","鐵礦場");
define("B3_DESC","鐵礦場是用來採集鐵礦的.鐵礦場等級越高,每小時能採集的鐵礦就越多.");
define("B4","農場");
define("B4_DESC","農場是為居民生產糧食的地方.農場等級越高,所能生產的糧食也就越多.");

//DORF1
define("LUMBER","木材");
define("CLAY","磚塊");
define("IRON","鋼鐵");
define("CROP","穀物");
define("LEVEL","等級");
define("CROP_COM",CROP." consumption");
define("PER_HR","每小時");
define("PROD_HEADER","生產");
define("MULTI_V_HEADER","村莊");
define("ANNOUNCEMENT","Announcement");
define("GO2MY_VILLAGE","回到我的村莊");
define("VILLAGE_CENTER","地圖中心");
define("FINISH_GOLD","花費2金,結束這個村莊當前建築任務或者兵種研發, 升級的任務. (除了皇宮和行宮)");
define("WAITING_LOOP","(等待建築)");
define("HRS","(hrs.)");
define("DONE_AT","結束在");
define("CANCEL","取消");
define("LOYALTY","Loyalty:");
define("CALCULATED_IN","產生在");
define("SEVER_TIME","伺服器時間:");

//QUEST
define("Q_CONTINUE","Continue with the next task.");
define("Q_REWARD","Your reward:");
define("Q0","Welcome to ");
define("Q0_DESC","As I see you have been made chieftain of this little village. I will be your counselor for the first few days and never leave your (right hand) side.");
define("Q0_OPT1","To the first task.");
define("Q0_OPT2","Look around on your own.");
define("Q0_OPT3","Play no tasks.");

define("Q1","Task 1: Woodcutter");
define("Q1_DESC","There are four green forests around your village. Construct a woodcutter on one of them. Lumber is an important resource for our new settlement.");
define("Q1_ORDER","Order:<\/p>Construct a woodcutter.");
define("Q1_RESP","Yes, that way you gain more lumber.I helped a bit and completed the order instantly.");
define("Q1_REWARD","Woodcutter instantly completed.");

define("Q2","Task 2: Crop");
define("Q2_DESC","Now your subjects are hungry from working all day. Extend a cropland to improve your subjects' supply. Come back here once the building is complete.");
define("Q2_ORDER","Order:<\/p>Extend one cropland.");
define("Q2_RESP","Very good. Now your subjects have enough to eat again...");

define("Q3","Task 3: Your Village's Name");
define("Q3_DESC","Creative as you are you can grant your village the ultimate name.\r\n<br \/><br \/>\r\nClick on 'profile' in the left hand menu and then select 'change profile'...");
define("Q3_ORDER","Order:<\/p>Change your village's name to something nice.");
define("Q3_RESP","Wow, a great name for their village. It could have been the name of my village!...");

define("Q4","Task 4: Other Players");
define("Q4_DESC","In ". SERVER_NAME ." you play along with billions of other players. Click 'statistics' in the top menu to look up your rank and enter it here.");
define("Q4_ORDER","Order:<\/p>Look for your rank in the statistics and enter it here.");
define("Q4_BUTN","complete task");
define("Q4_RESP","Exactly! That's your rank.");

define("Q5","Task 5: Two Building Orders");
define("Q5_DESC","Build an iron mine and a clay pit. Of iron and clay one can never have enough.");
define("Q5_ORDER","Order:<\/p><ul><li>Extend one iron mine.<\/li><li>Extend one clay pit.<\/li><\/ul>");
define("Q5_RESP","As you noticed, building orders take rather long. The world of ". SERVER_NAME ." will continue to spin even if you are offline. Even in a few months there will be many new things for you to discover.\r\n<br \/><br \/>\r\nThe best thing to do is occasionally checking your village and giving you subjects new tasks to do.");

define("Q6","Message From The Taskmaster");
define("Q6_DESC","You are to be informed that a nice reward is waiting for you at the taskmaster.<br /><br />Hint: The message has been generated automatically. An answer is not necessary.");

define("Q5","Task 5: Two Building Orders");
define("Q5_DESC","Build an iron mine and a clay pit. Of iron and clay one can never have enough.");
define("Q5_ORDER","Order:<\/p><ul><li>Extend one iron mine.<\/li><li>Extend one clay pit.<\/li><\/ul>");
define("Q5_RESP","As you noticed, building orders take rather long. The world of ". SERVER_NAME ." will continue to spin even if you are offline. Even in a few months there will be many new things for you to discover.\r\n<br \/><br \/>\r\nThe best thing to do is occasionally checking your village and giving you subjects new tasks to do.");

//======================================================//
//================ UNITS - DO NOT EDIT! ================//
//======================================================//
define("U0","英雄");

//ROMAN UNITS
define("U1","Legionnaire");
define("U2","Praetorian");
define("U3","Imperian");
define("U4","Equites Legati");
define("U5","Equites Imperatoris");
define("U6","Equites Caesaris");
define("U7","Battering Ram");
define("U8","Fire Catapult");
define("U9","Senator");
define("U10","Settler");

//TEUTON UNITS
define("U11","Clubswinger");
define("U12","Spearman");
define("U13","Axeman");
define("U14","Scout");
define("U15","Paladin");
define("U16","Teutonic Knight");
define("U17","Ram");
define("U18","Catapult");
define("U19","Chief");
define("U20","Settler");

//GAUL UNITS
define("U21","Phalanx");
define("U22","Swordsman");
define("U23","Pathfinder");
define("U24","Theutates Thunder");
define("U25","Druidrider");
define("U26","Haeduan");
define("U27","Ram");
define("U28","Trebuchet");
define("U29","Chieftain");
define("U30","Settler");
define("U99","Trap");

//NATURE UNITS
define("U31","Rat");
define("U32","Spider");
define("U33","Snake");
define("U34","Bat");
define("U35","Wild Boar");
define("U36","Wolf");
define("U37","Bear");
define("U38","Crocodile");
define("U39","Tiger");
define("U40","Elephant");

//NATARS UNITS
define("U41","Pikeman");
define("U42","Thorned Warrior");
define("U43","Guardsman");
define("U44","Birds Of Prey");
define("U45","Axerider");
define("U46","Natarian Knight");
define("U47","War Elephant");
define("U48","Ballista");
define("U49","Natarian Emperor");
define("U50","Natarian Settler");

//MONSTER UNITS
define("U51","Monster Peon");
define("U52","Monster Hunter");
define("U53","Monster Warrior");
define("U54","Ghost");
define("U55","Monster Steed");
define("U56","Monster War Steed");
define("U57","Monster Ram");
define("U58","Monster Catapult");
define("U59","Monster Chief");
define("U60","Monster Settler");

// RESOURCES
define("R1","Lumber");
define("R2","Clay");
define("R3","Iron");
define("R4","Crop");

//INDEX.php
define("LOGIN","Login");
define("PLAYERS","Players");
define("ACTIVE","Active");
define("ONLINE","Online");
define("TUTORIAL","Tutorial");
define("PLAYER_STATISTICS","Player statistics");
define("TOTAL_PLAYERS","".PLAYERS." in total");
define("ACTIVE_PLAYERS","Active players");
define("ONLINE_PLAYERS","".PLAYERS." online");
define("MP_STRATEGY_GAME","".SERVER_NAME." - the multiplayer strategy game");
define("WHAT_IS","".SERVER_NAME." is one of the most popular browser games in the world. As a player in ".SERVER_NAME.", you will build your own empire, recruit a mighty army, and fight with your allies for game world hegemony.");
define("REGISTER_FOR_FREE","Register here for free!");
define("LATEST_GAME_WORLD","Latest game world");
define("LATEST_GAME_WORLD2","Register on the latest<br/>game world and enjoy<br/>the advantages of<br/>being one of the<br/>first players.");
define("PLAY_NOW","Play ".SERVER_NAME." now");
define("LEARN_MORE","Learn more <br/>about ".SERVER_NAME."!");
define("LEARN_MORE2","Now with a revolutionised<br>server system, completely new<br>graphics <br>This clone is The Shiz!");
define("COMUNITY","Community");
define("BECOME_COMUNITY","Become part of our community now!");
define("BECOME_COMUNITY2","Become a part of one of<br>the biggest gaming<br>communities in the<br>world.");
define("NEWS","News");
define("SCREENSHOTS","Screenshots");
define("LEARN1","Upgrade your fields and mines to increase your resource production. You will need resources to construct buildings and train soldiers.");
define("LEARN2","Construct and expand the buildings in your village. Buildings improve your overall infrastructure, increase your resource production and allow you to research, train and upgrade your troops.");
define("LEARN3","View and interact with your surroundings. You can make new friends or new enemies, make use of the nearby oases and observe as your empire grows and becomes stronger.");
define("LEARN4","Follow your improvement and success and compare yourself to other players. Look at the Top 10 rankings and fight to win a weekly medal.");
define("LEARN5","Receive detailed reports about your adventures, trades and battles. Don't forget to check the brand new reports about the happenings taking place in your surroundings.");
define("LEARN6","Exchange information and conduct diplomacy with other players. Always remember that communication is the key to winning new friends and solving old conflicts.");
define("LOGIN_TO","Log in to ". SERVER_NAME);
define("REGIN_TO","Register in ". SERVER_NAME);
define("P_ONLINE","Players online: ");
define("P_TOTAL","Players in total: ");
define("CHOOSE","Please choose a server.");
define("STARTED"," The server started ". round((time()-COMMENCE)/86400) ." days ago.");

//ANMELDEN.php
define("NICKNAME","暱稱");
define("EMAIL","電郵信箱");
define("PASSWORD","密碼");
define("ROMANS","羅馬人");
define("TEUTONS","條頓人");
define("GAULS","高盧人");
define("NW","西北方");
define("NE","東北方");
define("SW","西南方");
define("SE","東南方");
define("RANDOM","隨機");
define("ACCEPT_RULES"," 我接受本遊戲的 遊戲規定 和 條款.");
define("ONE_PER_SERVER","每個服務器，每個玩家只能擁有一個帳戶.");
define("BEFORE_REGISTER","在你創造帳號之前請你務必閱讀 <a href='../anleitung.php' target='_blank'>遊戲說明</a> 了解 TravianX 3個種族的優點和缺點");
define("BUILDING_UPGRADING","建築:");
define("HOURS","小時");


//ATTACKS ETC.
define("TROOP_MOVEMENTS","軍隊移動:");
define("ARRIVING_REINF_TROOPS","Arriving reinforcing troops");
define("ARRIVING_REINF_TROOPS_SHORT","Reinf.");
define("OWN_ATTACKING_TROOPS","Own attacking troops");
define("ATTACK","攻擊");
define("OWN_REINFORCING_TROOPS","Own reinforcing troops");
define("TROOPS_DORF","軍隊:");


//LOGIN.php
define("COOKIES","You must have cookies enabled to be able to log in. If you share this computer with other people you should log out after each session for your own safety.");
define("NAME","名稱");
define("PW_FORGOTTEN","忘記密碼?");
define("PW_REQUEST","Then you can request a new one which will be sent to your email address.");
define("PW_GENERATE","產生一組新密碼.");
define("EMAIL_NOT_VERIFIED","電子郵件帳號不正確!");
define("EMAIL_FOLLOW","Follow this link to activate your account.");
define("VERIFY_EMAIL","驗證郵件.");


//404.php
define("NOTHING_HERE","Nothing here!");
define("WE_LOOKED","We looked 404 times already but can't find anything");

//TIME RELATED
define("CALCULATED","產生在");
define("SERVER_TIME","伺服器時間:");

//MASSMESSAGE.php
define("MASS","Message Content");
define("MASS_SUBJECT","主旨:");
define("MASS_COLOR","Message color:");
define("MASS_REQUIRED","All fields required");
define("MASS_UNITS","Images (units):");
define("MASS_SHOWHIDE","Show/Hide");
define("MASS_READ","Read this: after adding smilie, you have to add left or right after number otherwise image will won't work");
define("MASS_CONFIRM","Confirmation");
define("MASS_REALLY","Do you really want to send MassIGM?");
define("MASS_ABORT","Aborting right now");
define("MASS_SENT","Mass IGM was sent");


/*
|--------------------------------------------------------------------------
|   Index
|--------------------------------------------------------------------------
*/

	   $lang['index'][0][1] = "Welcome to " . SERVER_NAME . "";
	   $lang['index'][0][2] = "Manual";
	   $lang['index'][0][3] = "這是免費的, 現在就加入!";
	   $lang['index'][0][4] = "What is " . SERVER_NAME . "";
	   $lang['index'][0][5] = "" . SERVER_NAME . " 是 <b>網頁遊戲</b> 是架構於瀏覽器的遊戲<BR />TRAVIAN世界內有數千至數萬名玩家，一名玩家就是一個村莊的領主，以外交、權謀、諜戰、結盟、分工等等謀略，成為中世紀霸主<br /><p>這是 <strong>免費的</strong> 而且 <strong>不用下載</strong>.";
	   $lang['index'][0][6] = "點擊這裡玩 " . SERVER_NAME . "";
	   $lang['index'][0][7] = "總人數";
	   $lang['index'][0][8] = "活躍的玩家";
	   $lang['index'][0][9] = "在線的玩家";
	   $lang['index'][0][10] = "About the game";
	   $lang['index'][0][11] = "You will begin as the chief of a tiny village and will embark on an exciting quest.";
	   $lang['index'][0][12] = "Build up villages, wage wars or establish trade routes with your neighbours.";
	   $lang['index'][0][13] = "Play with and against thousands of other real players and conquer the the world of Travian.";
	   $lang['index'][0][14] = "新聞";
	   $lang['index'][0][15] = "說明";
	   $lang['index'][0][16] = "遊戲截圖";
	   $lang['forum'] = "論壇";
	   $lang['register'] = "註冊";
	   $lang['login'] = "登入";


?>
