<?php

//////////////////////////////////////////////////////////////////////////////////////////////////////
//                                             TRAVIANX                                             //
//            Only for advanced users, do not edit if you dont know what are you doing!             //
//                                Made by: Dzoki & Dixie (TravianX)                                 //
//                              - TravianX = Travian Clone Project -                                //
//                                 DO NOT REMOVE COPYRIGHT NOTICE!                                  //
//                                Adding tasks, constructions and artefact  by: Armando             //
//////////////////////////////////////////////////////////////////////////////////////////////////////
									//                         //
									//         Русский         //
									//   Author: kylesv (sV)   //
								        //     Adding: Armando     //
									/////////////////////////////

//MAIN MENU
define("TRIBE1","Римляне");
define("TRIBE2","Германцы");
define("TRIBE3","Галлы");
define("TRIBE4","Природа");
define("TRIBE5","Натары");
define("TRIBE6","Монстры");

define("HOME","Главная");
define("INSTRUCT","Инструкции");
define("ADMIN_PANEL","Админка");
define("MULTIHUNTER_PAN","Мультих. панель");
define("CREATE_NAT","Создать Натар");
define("MASS_MESSAGE","Сообщение всем");
define("LOGOUT","Выйти");
define("PROFILE","Профиль");
define("SUPPORT","Поддержка");
define("UPDATE_T_10","Обновить  ТОП 10");
define("SYSTEM_MESSAGE","Сист. сообщение");
define("TRAVIAN_PLUS","Травиан <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></span></span></b>");
define("CONTACT","Связь с нами!");
define("GAME_RULES","Правила игры");

//MENU
define("REG","Регистрация");
define("FORUM","Форум");
define("CHAT","Чат");
define("IMPRINT","Распечатать");
define("MORE_LINKS","Больше");
define("TOUR","Турнир");


//ERRORS
define("USRNM_EMPTY","(пустое имя пользователя)");
define("USRNM_TAKEN","(Имя уже используется)");
define("USRNM_SHORT","(мин. ".USRNM_MIN_LENGTH." символов)");
define("USRNM_CHAR","(Неверные символы)");
define("PW_EMPTY","(Пустой пароль)");
define("PW_SHORT","(мин. ".PW_MIN_LENGTH." символов)");
define("PW_INSECURE","(Простой пароль. Придумайте более сложный)");
define("EMAIL_EMPTY","(Пустой email)");
define("EMAIL_INVALID","(Неправильный email)");
define("EMAIL_TAKEN","(Email уже используется)");
define("TRIBE_EMPTY","<li>Выберите племя.</li>");
define("AGREE_ERROR","<li>Вы должны принять правила игры и общие условия и условия для того, чтобы зарегистрироваться.</li>");
define("LOGIN_USR_EMPTY","Введите имя.");
define("LOGIN_PASS_EMPTY","Введите паролб.");
define("EMAIL_ERROR","Электронный адрес не соответствует существующему");
define("PASS_MISMATCH","Пароли не совпадают");
define("ALLI_OWNER","Пожалуйста, назначьте владельца перед удалением");
define("SIT_ERROR","Уже установленно");
define("USR_NT_FOUND","Имя пользователя не существует.");
define("LOGIN_PW_ERROR","Пароль неправильный.");
define("WEL_TOPIC","Useful tips & information ");
define("ATAG_EMPTY","Тэг пуст");
define("ANAME_EMPTY","Название пустое");
define("ATAG_EXIST","Тэг принят");
define("ANAME_EXIST","Название принято");
define("NOT_OPENED_YET","Сервер еще не запущен.");

//COPYRIGHT
define("TRAVIAN_COPYRIGHT","TravianX 100% Open Source Travian Clone.");

//BUILD.TPL
define("CUR_PROD","Текущее производство");
define("NEXT_PROD","Производство на уровне ");

//BUILDINGS
define("B1","Лесопилка");
define("B1_DESC","На лесопилке идет производство древесины. С увеличением уровня развития здания увеличивается его производительность.");
define("B2","Глиняный карьер");
define("B2_DESC","На глиняном карьере добывают сырье глину. С развитием глиняного карьера увеличивается его производительность.");
define("B3","Железный карьер");
define("B3_DESC","На железных рудниках шахтеры добывают ценное сырье – железо. С развитием рудника увеличивается его производительность.");
define("B4","Ферма");
define("B4_DESC","На фермах выращивают зерно для обеспечения продовольствием населения. С развитием фермы увеличивается ее производительность.");

//DORF1
define("LUMBER","Древесина");
define("CLAY","Глина");
define("IRON","Железо");
define("CROP","Зерно");
define("LEVEL","Уровень");
define("CROP_COM","Потребление зерна");
define("DURATION","Время строительства");
define("PER_HR","в час");
define("PROD_HEADER","Производство");
define("MULTI_V_HEADER","Деревни");
define("ANNOUNCEMENT","Объявление");
define("GO2MY_VILLAGE","Войти в мою деревню");
define("VILLAGE_CENTER","Центр деревни");
define("FINISH_GOLD","Завершить все строительство и исследования в деревне за 2 золота?");
define("WAITING_LOOP","(очередь)");
define("HRS","ч.");
define("DONE_AT","будет завершено в");
define("CANCEL","отмена");
define("LOYALTY","Лояльность:");
define("CALCULATED_IN","Создана за");
define("SEVER_TIME","Время сервера:");
define("MILISECS","мс");

//QUEST
define("Q_CONTINUE","Перейти к следующему заданию.");
define("Q_REWARD","Ваша награда:");
define("Q_BUTN","complete task");
define("Q0","Добро пожаловать ");
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
define("Q2_REWARD","Your reward:<\/p>1 day Travian");

define("Q3","Task 3: Your Village's Name");
define("Q3_DESC","Creative as you are you can grant your village the ultimate name.<br \/><br \/>Click on 'profile' in the left hand menu and then select 'change profile'...");
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
define("Q5_RESP","As you noticed, building orders take rather long. The world of ". SERVER_NAME ." will continue to spin even if you are offline. Even in a few months there will be many new things for you to discover.<br \/><br \/>The best thing to do is occasionally checking your village and giving you subjects new tasks to do.");

define("Q6","Task 6: Messages");
define("Q6_DESC","You can talk to other players using the messaging system. I sent a message to you. Read it and come back here.<br \/><br \/>P.S. Don't forget: on the left the reports, on the right the messages.");
define("Q6_ORDER","Order:<\/p>Read your new message.");
define("Q6_RESP","You received it? Very good.<br \/><br \/>Here is some Gold. With Gold you can do several things, e.g. extend your   in the left hand menu.");
define("Q6_RESP1","-Account or increase your resource production.To do so click ");
define("Q6_RESP2","in the left hand menu.");
define("Q6_SUBJECT","Message From The Taskmaster");
define("Q6_MESSAGE","You are to be informed that a nice reward is waiting for you at the taskmaster.<br /><br />Hint: The message has been generated automatically. An answer is not necessary.");

define("Q7","Task 7: One Each!");
define("Q7_DESC","Now we should increase your resource production a bit. Build an additional woodcutter, clay pit, iron mine and cropland to level 1.");
define("Q7_ORDER","Order:<\/p>Extend one more of each resource tile to level 1.");
define("Q7_RESP","Very good, great develop of resources production.");

define("Q8","Task 8: Huge Army!");
define("Q8_DESC","Now I've got a very special quest for you. I am hungry. Give me 200 crop!<br \/><br \/>In return I will try to organize a huge army to protect your village.");
define("Q8_ORDER","Order:<\/p>Send 200 crop to the taskmaster.");
define("Q8_BUTN","Send crop");
define("Q8_NOCROP","No Enough Crop!");

define("Q9","Task 9: Everything to 1.");
define("Q9_DESC","In Travian there is always something to do! While you are waiting for incoming the huge army, Now we should increase your resource production a bit. Extend all your resource tiles to level 1.");
define("Q9_ORDER","Order:<\/p>Extend all resource tiles to level 1.");
define("Q9_RESP","Very good, your resource production just thrives.<br \/><br \/>Soon we can start with constructing buildings in the village.");

define("Q10","Task 10: Dove of Peace");
define("Q10_DESC","The first days after signing up you are protected against attacks by your fellow players. You can see how long this protection lasts by adding the code <b>[#0]<\/b> to your profile.");
define("Q10_ORDER","Order:<\/p>Write the code <b>[#0]<\/b> into your profile by adding it to one of the two description fields.");
define("Q10_RESP","Well done! Now everyone can see what a great warrior the world is approached by.");
define("Q10_REWARD","Your reward:<\/p>2 day Travian");

define("Q11","Task 11: Neighbours!");
define("Q11_DESC","Around you, there are many different villages. One of them is named. ");
define("Q11_DESC1"," Click on 'map' in the header menu and look for that village. The name of your neighbours' villages can be seen when hovering your mouse over any of them.");
define("Q11_ORDER","Order:</p>Look for the coordinates of ");
define("Q11_ORDER1","and enter them here.");
define("Q11_RESP","Exactly, there ");
define("Q11_RESP1"," Village! As many resources as you reach this village. Well, almost as much ...");
define("Q11_BUTN","completar misi&oacute;n");

define("Q12","Task 12: Cranny");
define("Q12_DESC","It's getting time to erect a cranny. The world of <?php echo SERVER_NAME; ?> is dangerous.<br \/><br \/>Many players live by stealing other players' resources. Build a cranny to hide some of your resources from enemies.");
define("Q12_ORDER","Order:<\/p>Construct a Cranny.");
define("Q12_RESP","Well done, now it's way harder for your mean fellow players to plunder your village.<br \/><br \/>If under attack, your villagers will hide the resources in the Cranny all on their own.");

define("Q13","Task 13: To Two.");
define("Q13_DESC","In <?php echo SERVER_NAME; ?> there is always something to do! Extend one woodcutter, one clay pit, one iron mine and one cropland to level 2 each.");
define("Q13_ORDER","Order:<\/p>Extend one of each resource tile to level 2.");
define("Q13_RESP","Very good, your village grows and thrives!");

define("Q14","Task 14: Instructions");
define("Q14_DESC","In the ingame instructions you can find short information texts about different buildings and types of units.<br \/><br \/>Click on 'instructions' at the left to find out how much lumber is required for the barracks.");
define("Q14_ORDER","Order:<\/p>Enter how much lumber barracks cost");
define("Q14_BUTN","complete task");
define("Q14_RESP","Exactly! Barracks cost 210 lumber.");

define("Q15","Task 15: Main Building");
define("Q15_DESC","Your master builders need a main building level 3 to erect important buildings such as the marketplace or barracks.");
define("Q15_ORDER","Order:<\/p>Extend your main building to level 3.");
define("Q15_RESP","Well done. The main building level 3 has been completed.<br><br>With this upgrade your master builders cannot only construct more types of buildings but also do so faster.");

define("Q16","Task 16: Advanced!");
define("Q16_DESC","Look up your rank in the player statistics again and enjoy your progress.");
define("Q16_ORDER","Order:<\/p>Look for your rank in the statistics and enter it here.");
define("Q16_RESP","Well done! That's your current rank.");

define("Q17","Task 17: Weapons or Dough");
define("Q17_DESC","Now you have to make a decision: Either trade peacefully or become a dreaded warrior.<br \/><br \/>For the marketplace you need a granary, for the barracks you need a rally point.");
define("Q17_BUTN","Economy");
define("Q17_BUTN1","Military");

define("Q18","Task 18: Military");
define("Q18_DESC","A brave decision. To be able to send troops you need a rally point.<br \/><br \/>The rally point must be built on a specific building site. The ");
define("Q18_DESC1"," building site.");
define("Q18_DESC2"," is located on the right side of the main building, slightly below it. The building site itself is curved.");
define("Q18_ORDER","Order:<\/p>Construct a rally point.");
define("Q18_RESP","Your rally point has been erected! A good move towards world domination!");

define("Q19","Task 19: Barracks");
define("Q19_DESC","Now you have a main building level 3 and a rally point. That means that all prerequisites for building barracks have been fulfilled.<br><br>You can use the barracks to train troops for fighting.");
define("Q19_ORDER","Order:<\/p>Construct barracks.");
define("Q19_RESP","Well done... The best instructors from the whole country have gathered to train your men\u2019s fighting skills to top form.");

define("Q20","Task 20: Train.");
define("Q20_DESC","Now that you have barracks you can start training troops. Train two ");
define("Q20_ORDER","Please train 2 ");
define("Q20_RESP","The foundation for your glorious army has been laid.<br \/><br \/>Before sending your army off to plunder you should check with the.");
define("Q20_RESP1","Combat Simulator");
define("Q20_RESP2","to see how many troops you need to successfully fight one rat without losses.");

define("Q21","Task 18: Economy");
define("Q21_DESC","Trade & Economy was your choice. Golden times await you for sure!");
define("Q21_ORDER","Order:<\/p>Construct a Granary.");
define("Q21_RESP","Well done! With the Granary you can store more wheat.");

define("Q22","Task 19: Warehouse");
define("Q22_DESC","Not only Crop has to be saved. Other resources can go to waste as well if they are not stored correctly. Construct a Warehouse!");
define("Q22_ORDER","Order:<\/p>Construct Warehouse.");
define("Q22_RESP",";Well done, your Warehouse is complete...&rdquo;<\/i><br \/>Now you have fulfilled all prerequisites required to construct a Marketplace.");

define("Q23","Task 20: Marketplace.");
define("Q23_DESC",";Construct a Marketplace so you can trade with your fellow players.");
define("Q23_ORDER","Order:<\/p>Please build a Marketplace.");
define("Q23_RESP",";The Marketplace has been completed. Now you can make offers of your own and accept foreign offers! When creating your own offers, you should think about offering what other players need most to get more profit.");

define("Q24","Task 21: Everything to 2.");
define("Q24_DESC","Now we should increase your resource production a bit. Build an additional woodcutter, clay pit, iron mine and cropland to level 1.");
define("Q24_ORDER","Order:<\/p>Extend all resource tiles to level 2.");
define("Q24_RESP","Congratulations! Your village grows and thrives...");

define("Q28","Task 22: Alliance.");
define("Q28_DESC","Teamwork is important in Travian. Players who work together organise themselves in alliances. Get an invitation from an alliance in your region and join this alliance. Alternatively, you can found your own alliance. To do this, you need a level 3 embassy.");
define("Q28_ORDER","Order:<\/p>Join an alliance or found one on your own.");
define("Q28_RESP","Is good! Now you're in a union called");
define("Q28_RESP1",", and you're a member of their alliance with the faster you'll progress...");

define("Q29","Task 23: Main Building to Level 5");
define("Q29_DESC","To be able to build a palace or residence, you will need a main building at level 5.");
define("Q29_ORDER","Order:<\/p>Upgrade your main building to level 5.");
define("Q29_RESP","The main building is level 5 now and you can build palace or residence...");

define("Q30","Task 24: Granary to Level 3.");
define("Q30_DESC","That you do not lose crop, you should upgrade your granary.");
define("Q30_ORDER","Order:<\/p>Upgrade your granary to level 3.");
define("Q30_RESP","Granary is level 3 now...");

define("Q31","Task 25: Warehouse to Level 7");
define("Q31_DESC"," To make sure your resources won't overflow, you should upgrade your warehouse.");
define("Q31_ORDER","Order:<\/p>Upgrade your warehouse to level 7.");
define("Q31_RESP","Warehouse has upgraded to level 7...");

define("Q32","Task 26: All to five!");
define("Q32_DESC","You will always need more resources. Resource tiles are quite expensive but will always pay out in the long term.");
define("Q32_ORDER","Order:<\/p>Upgrade all resources tiles to level 5.");
define("Q32_RESP","All resources are at level 5, very good, your village grows and thrives!");

define("Q33","Task 27: Palace or Residence?");
define("Q33_DESC","To found a new village, you will need settlers. They can be trained in either a palace or a residence.");
define("Q33_ORDER","Order:<\/p>Build a palace or residence to level 10.");
define("Q33_RESP","had reached to level 10, you can now train settlers and found your second village. Notice the cultural points...");

define("Q34","Task 28: 3 settlers.");
define("Q34_DESC","To found a new village, you will need settlers. You can train them in the palace or residence.");
define("Q34_ORDER","Order:<\/p>Train 3 settlers.");
define("Q34_RESP","3 settlers were trained. To found new village you need at least");
define("Q34_RESP1","culture points...");

define("Q35","Task 29: New Village.");
define("Q35_DESC","There are a lot of empty tiles on the map. Find one that suits you and found a new village");
define("Q35_ORDER","Order:<\/p>Found a new village.");
define("Q35_RESP","I am proud of you! Now you have two villages and have all the possibilities to build a mighty empire. I wish you luck with this.");

define("Q36"," Task 30: Build a ");
define("Q36_DESC","Now that you have trained some soldiers, you should build a ");
define("Q36_DESC1"," too. It increases the base defence and your soldiers will receive a defensive bonus.");
define("Q36_ORDER","Order:<\/p>Build a ");
define("Q36_RESP","That's what I'm talking about. A ");
define("Q36_RESP1"," Very useful. It increases the defence of the troops in the village.");

define("Q37","Tasks");
define("Q37_DESC","All tasks achieved!");

define("OPT3","Resource overview");
define("T","Your resource deliveries");
define("T1","Delivery");
define("T2","Delivery time");
define("T3","Status");
define("T4","fetch");
define("T5","fetched");
define("T6","on hold");
define("T7","1 day Travian ");
define("T8","2 days Travian ");


//======================================================//
//================ UNITS - DO NOT EDIT! ================//
//======================================================//
define("U0","Герой");

//ROMAN UNITS
define("U1","Легионер");
define("U2","Преторианец");
define("U3","Империанец");
define("U4","Конный разведчик");
define("U5","Конница императора");
define("U6","Конница Цезаря");
define("U7","Таран");
define("U8","Огненная катапульта");
define("U9","Сенатор");
define("U10","Поселенец");

//TEUTON UNITS
define("U11","Дубинщик");
define("U12","Копейщик");
define("U13","Топорщик");
define("U14","Скаут");
define("U15","Паладин");
define("U16","Тевтонская конница");
define("U17","Стенобитное орудие");
define("U18","Катапульта");
define("U19","Вождь");
define("U20","Поселенец");

//GAUL UNITS
define("U21","Фаланга");
define("U22","Мечник");
define("U23","Следопыт");
define("U24","Тевтатский гром");
define("U25","Друид-всадник");
define("U26","Эдуйская конница");
define("U27","Стенобитное орудие");
define("U28","Требушет");
define("U29","Предводитель");
define("U30","Поселенец");

//NATURE UNITS
define("U31","Крыса");
define("U32","Паук");
define("U33","Змея");
define("U34","Летучая мышь");
define("U35","Кабан");
define("U36","Волк");
define("U37","Медведь");
define("U38","Крокодил");
define("U39","Тигр");
define("U40","Слон");

//NATARS UNITS
define("U41","Пикейщик");
define("U42","Дубинщик с шипами");
define("U43","Гвардеец");
define("U44","Ворон");
define("U45","Всадник с топором");
define("U46","Рыцарь Натаров");
define("U47","Боевой слон");
define("U48","Балиста");
define("U49","Принц Натаров");
define("U50","Поселенец");

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

//INDEX.php
define("LOGIN","Логин");
define("PLAYERS","Игроки");
define("ONLINE","Онлайн");
define("TUTORIAL","Учебник");
define("PLAYER_STATISTICS","Статистика пользователя");
define("TOTAL_PLAYERS","Общее число игроков");
define("ACTIVE_PLAYERS","Активные пользователи");
define("ONLINE_PLAYERS",PLAYERS." онлайн");
define("MP_STRATEGY_GAME","".SERVER_NAME." - многопользовательская онлайн игра");
define("WHAT_IS","".SERVER_NAME." одна из самых популярных браузерных игр в мире. В качестве игрока вы увеличиваете и развиваете свои владения, тренируете войска и вместе с альянсом сражаетесь за господство над игровым миром.");
define("REGISTER_FOR_FREE","Зарегистрироваться!");
define("LATEST_GAME_WORLD","Новый сервер");
define("LATEST_GAME_WORLD2","Зарегистрируйтесь на самом<br/> новом сервере и наслаждайтесь<br/>преимуществом первого игрока.");
define("PLAY_NOW","Играть ".SERVER_NAME." сейчас");
define("LEARN_MORE","Узнать <br/>больше о ".SERVER_NAME."!");
define("LEARN_MORE2","Now with a revolutionised<br>server system, completely new<br>graphics <br>This clone is The Shiz!");
define("COMUNITY","Community");
define("BECOME_COMUNITY","Become part of our community now!");
define("BECOME_COMUNITY2","Become a part of one of<br>the biggest gaming<br>communities in the<br>world.");
define("NEWS","Новости");
define("SCREENSHOTS","Скриншоты");
define("LEARN1","Upgrade your fields and mines to increase your resource production. You will need resources to construct buildings and train soldiers.");
define("LEARN2","Construct and expand the buildings in your village. Buildings improve your overall infrastructure, increase your resource production and allow you to research, train and upgrade your troops.");
define("LEARN3","View and interact with your surroundings. You can make new friends or new enemies, make use of the nearby oases and observe as your empire grows and becomes stronger.");
define("LEARN4","Follow your improvement and success and compare yourself to other players. Look at the Top 10 rankings and fight to win a weekly medal.");
define("LEARN5","Receive detailed reports about your adventures, trades and battles. Don't forget to check the brand new reports about the happenings taking place in your surroundings.");
define("LEARN6","Exchange information and conduct diplomacy with other players. Always remember that communication is the key to winning new friends and solving old conflicts.");
define("LOGIN_TO","Log in to ". SERVER_NAME);
define("REGIN_TO","Зарегистрироваться на ". SERVER_NAME);
define("P_ONLINE","Players online: ");
define("P_TOTAL","Players in total: ");
define("CHOOSE","Please choose a server.");
define("STARTED"," The server started ". round((time()-COMMENCE)/86400) ." days ago.");

//ANMELDEN.php
define("NICKNAME","Логин");
define("EMAIL","Email");
define("PASSWORD","Пароль");
define("ROMANS","Римляне");
define("TEUTONS","Германцы");
define("GAULS","Галлы");
define("NW","Северо-запад");
define("NE","Северо-восток");
define("SW","Юго-запад");
define("SE","Юго-восток");
define("RANDOM","случайно");
define("ACCEPT_RULES"," Я согласен с условиями и предупреждениями.");
define("ONE_PER_SERVER","Каждый игром имеет право иметь только один аккаунт на сервере.");
define("BEFORE_REGISTER","Перед тем как зарегистрироваться прочитайте <a href='../anleitung.php' target='_blank'>инструкции</a> TravianX чтобы понять особенности различных игровых племен на сервере.");
define("BUILDING_UPGRADING","Строительство:");
define("HOURS","ч.");


//ATTACKS ETC.
define("TROOP_MOVEMENTS","Перемещения войск:");
define("ARRIVING_REINF_TROOPS","Прибытие войск");
define("ARRIVING_REINF_TROOPS_SHORT","Приб.");
define("OWN_ATTACKING_TROOPS","Собственные атакующие войска");
define("ATTACK","Атака");
define("OWN_REINFORCING_TROOPS","Собственные прибивающие войска");
define("TROOPS_DORF","Войска:");
define("NEWVILLAGE","New vill.");
define("FOUNDNEWVILLAGE","Founding New village");
define("UNDERATTACK","The village is under attack");
define("OASISATTACK","The Oasis is under attack");
define("OASISATTACKS","Oasis Att.");
define("RETURNFROM","Return from");
define("REINFORCEMENTFOR","Reinforcement to");
define("ATTACK_ON","Attack to");
define("RAID_ON","Raid to");
define("SCOUTING","Scouting");
define("PRISONERS","Prisioners");
define("PRISONERSIN","Prisioners in");
define("PRISONERSFROM","Prisioners from");
define("TROOPS","Troops");
define("TROOPSFROM","Troops");
define("BOUNTY","Bounty");
define("ARRIVAL","Arrival");
define("INCOMING_TROOPS","Incoming Troops");
define("TROOPS_ON_THEIR_WAY","Troops on their way");
define("OWN_TROOPS","Own troops");
define("ON","on");
define("AT","at");
define("UPKEEP","Upkeep");
define("SEND_BACK","Send back");
define("TROOPS_IN_THE_VILLAGE","Troops in the village");
define("TROOPS_IN_OTHER_VILLAGE","Troops in other village");
define("TROOPS_IN_OASIS","Troops in oasis");
define("KILL","Kill");
define("FROM","From");
define("SEND_TROOPS","Send troops");
define("TASKMASTER","Taskmaster");
define("VILLAGE_OF_THE_ELDERS_TROOPS","village of the elders troops");


//LOGIN.php
define("COOKIES","You must have cookies enabled to be able to log in. If you share this computer with other people you should log out after each session for your own safety.");
define("NAME","Имя");
define("PW_FORGOTTEN","Забыли пароль?");
define("PW_REQUEST","Вы можете запросить другой пароль на свой почтовый адрес.");
define("PW_GENERATE","Создать новый пароль.");
define("EMAIL_NOT_VERIFIED","Email nне принят!");
define("EMAIL_FOLLOW","Проследуйте по следующей ссылке чтобы активировать аккаунт.");
define("VERIFY_EMAIL","Email подтвержден.");
define("SERVER_STARTS_IN","Server will start in: ");
define("START_NOW","START NOW");


//404.php
define("NOTHING_HERE","Ничего тут!");
define("WE_LOOKED","Мы посмотрели 404 раза и ничего не нашли");

//TIME RELATED
define("CALCULATED","Саздана за");
define("SERVER_TIME","Время сервера:");

//MASSMESSAGE.php
define("MASS","Сообщение");
define("MASS_SUBJECT","Тема:");
define("MASS_COLOR","Цвет сообщения:");
define("MASS_REQUIRED","Все поля рекомендуемые");
define("MASS_UNITS","Картинки (еденицы):");
define("MASS_SHOWHIDE","Показать/Скрыть");
define("MASS_READ","Read this: after adding smilie, you have to add left or right after number otherwise image will won't work");
define("MASS_CONFIRM","Confirmation");
define("MASS_REALLY","Do you really want to send MassIGM?");
define("MASS_ABORT","Aborting right now");
define("MASS_SENT","Mass IGM was sent");

//BUILDINGS
define("WOODCUTTER","Woodcutter");
define("CLAYPIT","Clay Pit");
define("IRONMINE","Iron Mine");
define("CROPLAND","Cropland");

define("SAWMILL","Sawmill");
define("SAWMILL_DESC","Here wood delivered by your Woodcutters is processed. Based on its level your sawmill can increase your wood production by up to 25 percent.");
define("CURRENT_WOOD_BONUS","Current wood bonus:");
define("WOOD_BONUS_LEVEL","Wood bonus at level");
define("MAX_LEVEL","Building already at max level");
define("PERCENT","Percent");

define("BRICKYARD","Brickyard");
define("CURRENT_CLAY_BONUS","Current clay bonus:");
define("CLAY_BONUS_LEVEL","Clay bonus at level");
define("BRICKYARD_DESC","Here clay is processed into bricks. Based on its level your Brickyard can increase your clay production by up to 25 percent.");

define("IRONFOUNDRY","Iron Foundry");
define("CURRENT_IRON_BONUS","Current iron bonus:");
define("IRON_BONUS_LEVEL","Iron bonus at level");
define("IRONFOUNDRY_DESC","Iron is smelted here. Based on its level your Iron Foundry can increase your iron production by up to 25 percent.");

define("GRAINMILL","Grain Mill");
define("CURRENT_CROP_BONUS","Current crop bonus:");
define("CROP_BONUS_LEVEL","Crop bonus at level");
define("GRAINMILL_DESC","Here your grain is milled in order to produce flour. Based on its level your grain mill can increase your crop production by up to 25 percent.");

define("BAKERY","Bakery");
define("BAKERY_DESC","Here the flour produced in your mill is used to bake bread. In addition with the Grain Mill the increase in crop production can go up to 50 percent.");

define("WAREHOUSE","Warehouse");
define("CURRENT_CAPACITY","Current capacity:");
define("CAPACITY_LEVEL","Capacity at level");
define("RESOURCE_UNITS","Resource units");
define("WAREHOUSE_DESC","The resources wood, clay and iron are stored in your Warehouse. By increasing its level you increase your Warehouse's capacity.");

define("GRANARY","Granary");
define("CROP_UNITS","Crop units");
define("GRANARY_DESC","Crop produced by your farms is stored in the Granary. By increasing its level you increase the Granary's capacity.");

define("BLACKSMITH","Blacksmith");
define("ACTION","Action");
define("UPGRADE","Upgrade");
define("UPGRADE_IN_PROGRESS","Upgrade in<br>progress");
define("UPGRADE_BLACKSMITH","Upgrade<br>blacksmith");
define("UPGRADES_COMMENCE_BLACKSMITH","Upgrades can commence when blacksmith is completed.");
define("MAXIMUM_LEVEL","Maximum<br>level");
define("EXPAND_WAREHOUSE","Expand<br>warehouse");
define("EXPAND_GRANARY","Expand<br>granary");
define("ENOUGH_RESOURCES","Enough resources");
define("CROP_NEGATIVE ","Crop production is negative so you will never reach the required resources");
define("TOO_FEW_RESOURCES","Too few<br>resources");
define("UPGRADING","Upgrading");
define("DURATION","Duration");
define("COMPLETE","Complete");
define("BLACKSMITH_DESC","In the blacksmith's melting furnaces your warriors' weapons are enhanced. By increasing its level you can order the fabrication of even better weapons.");

define("ARMOURY","Armoury");
define("UPGRADE_ARMOURY","Upgrade<br>Armoury");
define("UPGRADES_COMMENCE_ARMOURY","Upgrades can commence when armoury is completed.");
define("ARMOURY_DESC","In the armoury's melting furnaces your warriors' armour is enhanced. By increasing its level you can order the fabrication of even better armour.");

define("TOURNAMENTSQUARE","Tournament Square");
define("CURRENT_SPEED","Current speed bonus:");
define("SPEED_LEVEL","Speed bonus at level");
define("TOURNAMENTSQUARE_DESC","At the Tournament Square your troops can train their stamina. The further the building is upgraded the faster your troops are beyond a minimum distance of ".TS_THRESHOLD."  squares.");

define("MAINBUILDING","Main Building");
define("CURRENT_CONSTRUCTION_TIME","Current construction time:");
define("CONSTRUCTION_TIME_LEVEL","Construction time at level");
define("DEMOLITION_BUILDING","Demolition of the building:</h2><p>If you no longer need a building, you can order the demolition of the building.</p>");
define("DEMOLISH","Demolish");
define("DEMOLITION_OF","Demolition of ");
define("MAINBUILDING_DESC","In the main building the village's master builders live. The higher its level the faster your master builders complete the construction of new buildings.");

define("RALLYPOINT","Rally Point");
define("OVERVIEW","Overview");
define("REINFORCEMENT","Reinforcement");
define("EVASION_SETTINGS","evasion settings");
define("SEND_TROOPS_AWAY_MAX","Send troops away a maximun of");
define("TIMES","times");
define("PER_EVASION","per evasion");
define("RALLYPOINT_DESC","Your village's troops meet here. From here you can send them out to conquer, raid or reinforce other villages.");

define("MARKETPLACE","Marketplace");
define("MERCHANT","Merchants");
define("OR_","or");
define("GO","go");
define("UNITS_OF_RESOURCE","units of resource");
define("MERCHANT_CARRY","Each merchant can carry");
define("MERCHANT_COMING","Merchants coming");
define("TRANSPORT_FROM","Transport from");
define("ARRIVAL_IN","Arrival in");
define("NO_COORDINATES_SELECTED","No Coordinates selected");
define("CANNOT_SEND_RESOURCES","You cannot send resources to the same village");
define("BANNED_CANNOT_SEND_RESOURCES","Player is Banned. You cannot send resources to him");
define("RESOURCES_NO_SELECTED","Resources not selected");
define("ENTER_COORDINATES","Enter coordinates or village name");
define("TOO_FEW_MERCHANTS","Too few merchants");
define("OWN_MERCHANTS_ONWAY","Own merchants on the way");
define("MERCHANTS_RETURNING","Merchants returning");
define("TRANSPORT_TO","Transport to");
define("I_AN_SEARCHING","I'm searching");
define("I_AN_OFFERING","I'm offering");
define("OFFERS_MARKETPLACE","Offers at the marketplace");
define("OFFERED_TO_ME","Offered<br>to me");
define("WANTED_TO_ME","Wanted<br>from me");
define("NOT_ENOUGH_MERCHANTS","Not Enough Merchant");
define("ACCEP_OFFER","Accept offer");
define("NO_AVALIBLE_OFFERS","There are no avaliable offers on the market");
define("SEARCHING","Searching");
define("OFFERING","Offering");
define("MAX_TIME_TRANSPORT","max. time of transport");
define("OWN_ALLIANCE_ONLY","own alliance only");
define("INVALID_OFFER","Invalid offer");
define("OFFER","Offer");
define("SEARCH","Search");
define("OWN_OFFERS","Own offers");
define("ALL","All");
define("NPC_TRADE","NPC Trade");
define("SUM","Sum");
define("REST","Rest");
define("TRADE_RESOURCES","Trade resources at (step 2 of 2");
define("DISTRIBUTE_RESOURCES","Distribute resources at (step 1 of 2)");
define("OF","of");
define("NPC_COMPLETED","NPC completed");
define("BACK_BUILDING","Back to building");
define("YOU_CAN_NAT_NPC_WW","You can't use NPC trade in WW village.");
define("NPC_TRADING","NPC trading");
define("SEND_RESOURCES","Send Resources");
define("BUY","Buy");
define("TRADE_ROUTES","trade routes");
define("DESCRIPTION","Description");
define("TIME_LEFT","Time left");
define("START","Start");
define("NO_TRADE_ROUTES","No active trade routes");
define("TRADE_ROUTE_TO","Trade route to");
define("CHECKED","checked");
define("DAYS","days");
define("EXTEND","extend");
define("EDIT","edit");
define("EXTEND_TRADE_ROUTES","Extend the trade route by 7 days for");
define("CREATE_TRADE_ROUTES","Create new trade route");
define("DELIVERIES","deliveries");
define("START_TIME_TRADE","start time");
define("CREATE_TRADE_ROUTE","Create trade route");
define("TARGET_VILLAGE","target village");
define("EDIT_TRADE_ROUTES","Edit trade route");
define("TRADE_ROUTES_DESC","Trade route allows you to set up routes for your merchant that he will walk every day at a certain hour. <br /><br /> Standard this holds on for 7 days, but you can extend it with 7 days for the cost of");
define("NPC_TRADE_DESC","With the NPC merchant you can distribute the resources in your warehouse as you desire. <br /><br /> The first line shows the current stock. In the second line you can choose another distribution. The third line shows the difference between the old and new stock.");
define("MARKETPLACE_DESC","At the Marketplace you can trade resources with other players. The higher its level, the more resources can be transported at the same time.");

define("EMBASSY","Embassy");
define("ALLIANCE","Alliance");
define("TAG","Tag");
define("TO_THE_ALLIANCE","to the alliance");
define("JOIN_ALLIANCE","join alliance");
define("REFUSE","refuse");
define("ACCEPT","accept");
define("NO_INVITATIONS","There are no invitations available.");
define("NO_CREATE_ALLIANCE","Banned player can't create an alliance.");
define("FOUND_ALLIANCE","found alliance");
define("EMBASSY_DESC","The embassy is a place for diplomats. The higher its level the more options the king gains.");

define("BARRACKS","Barracks");
define("QUANTITY","Quantity");
define("MAX","Max");
define("TRAINING","Training");
define("FINISHED","Finished");
define("UNIT_FINISHED","The next unit will be finished in");
define("AVAILABLE","Available");
define("TRAINING_COMMENCE_BARRACKS","Training can commence when barracks are completed.");
define("BARRACKS_DESC","All foot soldiers are trained in the barracks. The higher the level of the barracks, the faster the troops are trained.");

define("STABLE","Stable");
define("AVAILABLE_ACADEMY","No units available. Research at academy");
define("TRAINING_COMMENCE_STABLE","Training can commence when stable are completed.");
define("STABLE_DESC","Cavalry can be trained in the stable. The higher its level the faster the troops are trained.");

define("WORKSHOP","Workshop");
define("TRAINING_COMMENCE_WORKSHOP","Training can commence when workshop are completed.");
define("WORKSHOP_DESC","Siege engines like catapults and rams can be built in the workshop. The higher its level the faster the units are produced.");

define("ACADEMY","Academy");
define("RESEARCH_AVAILABLE","There are no researches available");
define("RESEARCH_COMMENCE_ACADEMY","Research can commence when academy is completed.");
define("RESEARCH","Research");
define("EXPAND_WAREHOUSE1","Expand warehouse");
define("EXPAND_GRANARY1","Expand granary");
define("RESEARCH_IN_PROGRESS","Research in<br>progress");
define("RESEARCHING","Researching");
define("PREREQUISITES","Prerequisites");
define("SHOW_MORE","show more");
define("HIDE_MORE","hide more");
define("ACADEMY_DESC","In the academy new unit types can be researched. By increasing its level you can order the research of better units.");

define("CRANNY","Cranny");
define("CURRENT_HIDDEN_UNITS","Currently hidden units per resource:");
define("HIDDEN_UNITS_LEVEL","Hidden units per resource at level");
define("UNITS","units");
define("CRANNY_DESC","The cranny is used to hide some of your resources when the village is attacked. These resources cannot be stolen.");

define("TOWNHALL","Town Hall");
define("CELEBRATIONS_COMMENCE_TOWNHALL","Celebrations can commence when the town hall is completed.");
define("GREAT_CELEBRATIONS","Great celebration");
define("CULTURE_POINTS","culture points");
define("HOLD","hold");
define("CELEBRATIONS_IN_PROGRESS","Celebration</br>in progress");
define("CELEBRATIONS","Celebrations");
define("TOWNHALL_DESC","You can hold pompous celebrations in the Town Hall. Such a celebration increases your culture points. Building up your Town Hall to a higher level will decrease the length of the celebration.");

define("RESIDENCE","Residence");
define("CAPITAL","This is your capital");
define("RESIDENCE_TRAIN_DESC","In order to found a new village you need a level 10 or 20 residence and 3 settlers. In order to conquer a new village you need a level 10 or 20 residence and a senator, chief or chieftain.");
define("PRODUCTION_POINTS","Production of this village:");
define("PRODUCTION_ALL_POINTS","Production of all villages:");
define("POINTS_DAY","Culture points per day");
define("VILLAGES_PRODUCED","Your villages have produced");
define("POINTS_NEED","points in total. To found or conquer a new village you need");
define("POINTS","points");
define("VILLAGE","Village");
define("PLAYER","Player");
define("INHABITANTS","Inhabitants");
define("COORDINATES","Coordinates");
define("EXPANSION","Expansion");
define("TRAIN","Train");
define("DATE","Date");
define("CONQUERED_BY_VILLAGE","Villages founded or conquered by this village");
define("NONE_CONQUERED_BY_VILLAGE","No other village has been founded or conquered by this village yet.");
define("RESIDENCE_CULTURE_DESC","In order to extend your empire you need culture points. These culture points increase in the course of time and do so faster as your building levels increase.");
define("RESIDENCE_LOYALTY_DESC","By attacking with senators, chiefs or chieftains a village's loyalty can be brought down. If it reaches zero, the village joins the realm of the attacker. The loyalty of this village is currently at ");
define("RESIDENCE_DESC","The residence is a small palace, where the king or queen lives when (s)he visits the village. The residence protects the village against enemies who want to conquer it.");

define("PALACE","Palace");
define("PALACE_CONSTRUCTION","Palace under construction");
define("PALACE_TRAIN_DESC","In order to found a new village you need a level 10, 15 or 20 palace and 3 settlers. In order to conquer a new village you need a level 10, 15 or 20 palace and a senator, chief or chieftain.");
define("CHANGE_CAPITAL","change capital");
define("SECURITY_CHANGE_CAPITAL","Are you sure, that you want to change your capital?<br /><b>You can\'t undo this!</b><br />For security you must enter your password to confirm:<br />");
define("PALACE_DESC","The king or queen of the empire lives in the palace. Only one palace can exist in your realm at a time. You need a palace in order to proclaim a village to be your capital.");

define("TREASURY","Treasury");
define("ARTIFACTS_AREA","Artefacts in your area");
define("NO_ARTIFACTS_AREA","There is no artefacts in your area.");
define("OWN_ARTIFACTS","Own artefacts");
define("CONQUERED","Conquered");
define("DISTANCE","Distance");
define("EFFECT","Effect");
define("ACCOUNT","account");
define("SMALL_ARTIFACTS","Small artefacts");
define("LARGE_ARTIFACTS","Large artefacts");
define("NO_ARTIFACTS","There is no artefacts.");
define("ANY_ARTIFACTS","You do not own any artefacts.");
define("OWNER","Owner");
define("AREA_EFFECT","Area of effect");
define("BONUS","Bonus");
define("REQUIRED_LEVEL","Required level");
define("TIME_CONQUER","Time of conquer");
define("TIME_ACTIVATION","Time of activation");
define("FORMER_OWNER","Former owner(s)");
define("BUILDING_STRONGER","building stronger with");
define("BUILDING_WEAKER","building weaker with");
define("TROOPS_FASTER","makes troops faster with");
define("TROOPS_SLOWEST","makes troops slowest with");
define("SPIES_INCREASE","spies increase ability with");
define("SPIES_DECRESE","spies decrese ability with");
define("CONSUME_LESS","all troops consume less with");
define("CONSUME_HIGH","all troops consume high with");
define("TROOPS_MAKE_FASTER","troops make faster with");
define("TROOPS_MAKE_SLOWEST","troops make slowest with");
define("YOU_CONSTRUCT","you can construct ");
define("CRANNY_INCREASED","cranny capacity is increased by");
define("CRANNY_DECRESE","cranny capacity is decrese by");
define("TREASURY_DESC","The riches of your empire are kept in the treasury. The treasury has room for one treasure. After you have captured an artefact it takes 24 hours on a normal server or 12 hours on a thrice speed server to be effective.");

define("TRADEOFFICE","Trade Office");
define("CURRENT_MERCHANT","Current merchant load:");
define("MERCHANT_LEVEL","Merchant load at level");
define("TRADEOFFICE_DESC","In the trade office the merchants' carts get improved and equipped with powerful horses. The higher its level the more your merchants are able to carry.");

define("GREATBARRACKS","Great Barracks");
define("TRAINING_COMMENCE_GREATBARRACKS","Training can commence when great barracks are completed.");
define("GREATBARRACKS_DESC","Foot soldiers are trained in the great barracks. The higher the level of the barracks, the faster the troops are trained.");

define("GREATSTABLE","Great Stable");
define("TRAINING_COMMENCE_GREATSTABLE","Training can commence when great stables are completed.");
define("GREATSTABLE_DESC","Cavalry can be trained in the great stable. The higher its level the faster the troops are trained.");

define("CITYWALL","City Wall");
define("DEFENCE_NOW","Defence Bonus now:");
define("DEFENCE_LEVEL","Defence Bonus at level");
define("CITYWALL_DESC","By building a City Wall you can protect your village against the barbarian hordes of your enemies. The higher the wall's level, the higher the bonus given to your forces' defence.");

define("EARTHWALL","Earth Wall");
define("EARTHWALL_DESC","By building a Earth Wall you can protect your village against the barbarian hordes of your enemies. The higher the wall's level, the higher the bonus given to your forces' defence.");

define("PALISADE","Palisade");
define("PALISADE_DESC","By building a Palisade you can protect your village against the barbarian hordes of your enemies. The higher the wall's level, the higher the bonus given to your forces' defence.");

define("STONEMASON","Stonemason's Lodge");
define("CURRENT_STABILITY","Current stability bonus:");
define("STABILITY_LEVEL","Stability bonus at level");
define("STONEMASON_DESC","The stonemason's lodge is an expert at cutting stone. The further the building is extended the higher the stability of the village's buildings.");

define("BREWERY","Brewery");
define("CURRENT_BONUS","Current bonus:");
define("BONUS_LEVEL","Bonus at level");
define("BREWERY_DESC","Tasty mead is brewed in the Brewery and later quaffed by the soldiers during the celebrations.");

define("TRAPPER","Trapper");
define("CURRENT_TRAPS","Currect maximum traps to train:");
define("TRAPS_LEVEL","Maximum traps to train at level");
define("TRAPS","Traps");
define("TRAP","Trap");
define("CURRENT_HAVE","Your currently have");
define("WHICH_OCCUPIED","of which are occupied.");
define("TRAINING_COMMENCE_TRAPPER","Training can commence when trapper are completed.");
define("TRAPPER_DESC","The trapper protects your village with well hidden traps. This means that unwary enemies can be imprisoned and won't be able to harm your village anymore.");

define("HEROSMANSION","Hero's Mansion");
define("HERO_READY","Hero will be ready in ");
define("NAME_CHANGED","Hero name has been changed");
define("NOT_UNITS","Not available units");
define("NOT","Not ");
define("TRAIN_HERO","Train New Hero");
define("REVIVE","Revive");
define("OASES","Oases");
define("DELETE","delete");
define("RESOURCES","Resources");
define("OFFENCE","Offence");
define("DEFENCE","Defence");
define("OFF_BONUS","Off-Bonus");
define("DEF_BONUS","Def-Bonus");
define("REGENERATION","Regeneration");
define("DAY","Day");
define("EXPERIENCE","Experience");
define("YOU_CAN","You can ");
define("RESET","reset");
define("YOUR_POINT_UNTIL"," your points until you are level ");
define("OR_LOWER"," or lower!");
define("YOUR_HERO_HAS","Your hero has ");
define("OF_HIT_POINTS","of his hit points.");
define("ERROR_NAME_SHORT","Error: name too short");
define("HEROSMANSION_DESC","In the Hero's mansion you can train your own hero and at level 10, 15 and 20 you can conquer oases with Hero in the immediate vicinity.");

define("GREATWAREHOUSE","Great Warehouse");
define("GREATWAREHOUSE_DESC","Wood, clay and iron are stored in the warehouse. The great warehouse offers you more space and keeps your goods drier and safer than the normal one.");

define("GREATGRANARY","Great Granary");
define("GREATGRANARY_DESC","Crop produced by your farms is stored in the granary. The great granary offers you more space and keeps your crops drier and safer than the normal one.");

define("WONDER","Wonder of the World");
define("WORLD_WONDER","World Wonder");
define("WONDER_DESC","The World Wonder (otherwise known as a Wonder of the World) is as wonderful as it sounds. This building is built in order to win the server. Each level of the World Wonder costs hundreds of thousands (even millions) of resources to build.");
define("WORLD_WONDER_CHANGE_NAME","You need to have World Wonder level 1 to be able to change its name");
define("WORLD_WONDER_NAME","World Wonder name");
define("WORLD_WONDER_NOTCHANGE_NAME","You can not change the name of the World Wonder after level 10");
define("WORLD_WONDER_NAME_CHANGED","Name changed");

define("HORSEDRINKING","Horse Drinking Trough");
define("HORSEDRINKING_DESC","The horse drinking trough of the Romans decreases the training time of cavalry and the upkeep of these troops as well.");

define("GREATWORKSHOP","Great Workshop");
define("TRAINING_COMMENCE_GREATWORKSHOP","Training can commence when great workshop is completed.");
define("GREATWORKSHOP_DESC","Siege engines like catapults and rams can be built in the great workshop. The higher its level the faster the units are produced.");

define("BUILDING_MAX_LEVEL_UNDER","Building max level under construction");
define("BUILDING_BEING_DEMOLISHED","Building presently being demolished");
define("COSTS_UPGRADING_LEVEL","Costs</b> for upgrading to level");
define("WORKERS_ALREADY_WORK","The workers are already at work.");
define("CONSTRUCTING_MASTER_BUILDER","Constructing with master builder ");
define("COSTS","costs");
define("GOLD","Gold");
define("WORKERS_ALREADY_WORK_WAITING","The workers are already at work. (waiting loop)");
define("ENOUGH_FOOD_EXPAND_CROPLAND","Not enough food. Expand cropland.");
define("UPGRADE_WAREHOUSE","Upgrade Warehouse");
define("UPGRADE_GRANARY","Upgrade Granary");
define("YOUR_CROP_NEGATIVE","Your crop production is negative, you will never get the required resources.");
define("UPGRADE_LEVEL","Upgrade to level ");
define("WAITING","(waiting loop)");
define("NEED_WWCONSTRUCTION_PLAN","Need WW construction plan");
define("NEED_MORE_WWCONSTRUCTION_PLAN","Need more WW construction plan");
define("CONSTRUCT_NEW_BUILDING","Construct new building");
define("SHOWSOON_AVAILABLE_BUILDINGS","show soon available buildings");
define("HIDESOON_AVAILABLE_BUILDINGS","hide soon available buildings");



//artefact
define("ARCHITECTS_DESC","All buildings in the area of effect are stronger. This means that you will need more catapults to damage buildings protected by this artifacts powers.");
define("ARCHITECTS_SMALL","The architects slight secret");
define("ARCHITECTS_SMALLVILLAGE","Diamond Chisel");
define("ARCHITECTS_LARGE","The architects great secret");
define("ARCHITECTS_LARGEVILLAGE","Giant Marble Hammer");
define("ARCHITECTS_UNIQUE","The architects unique secret");
define("ARCHITECTS_UNIQUEVILLAGE","Hemons Scrolls");
define("HASTE_DESC","All troops in the area of effect move faster.");
define("HASTE_SMALL","The slight titan boots");
define("HASTE_SMALLVILLAGE","Opal Horseshoe");
define("HASTE_LARGE","The great titan boots");
define("HASTE_LARGEVILLAGE","Golden Chariot");
define("HASTE_UNIQUE","The unique titan boots");
define("HASTE_UNIQUEVILLAGE","Pheidippides Sandals");
define("EYESIGHT_DESC","All spies (Scouts, Pathfinders, and Equites Legati) increase their spying ability. In addition, with all versions of this artifact you can see the incoming TYPE of troops but not how many there are.");
define("EYESIGHT_SMALL","The eagles slight eyes");
define("EYESIGHT_SMALLVILLAGE","Tale of a Rat");
define("EYESIGHT_LARGE","The eagles great eyes");
define("EYESIGHT_LARGEVILLAGE","Generals Letter");
define("EYESIGHT_UNIQUE","The eagles unique eyes");
define("EYESIGHT_UNIQUEVILLAGE","Diary of Sun Tzu");
define("DIET_DESC","All troops in the artifacts range consume less wheat, making it possible to maintain a larger army.");
define("DIET_SMALL","Slight diet control");
define("DIET_SMALLVILLAGE","Silver Platter");
define("DIET_LARGE","Great diet control");
define("DIET_LARGEVILLAGE","Sacred Hunting Bow");
define("DIET_UNIQUE","Unique diet control");
define("DIET_UNIQUEVILLAGE","King Arthurs Chalice");
define("ACADEMIC_DESC","Troops are built a certain percentage faster within the scope of the artifact.");
define("ACADEMIC_SMALL","The trainers slight talent");
define("ACADEMIC_SMALLVILLAGE","Scribed Soldiers Oath");
define("ACADEMIC_LARGE","The trainers great talent");
define("ACADEMIC_LARGEVILLAGE","Declaration of War");
define("ACADEMIC_UNIQUE","The trainers unique talent");
define("ACADEMIC_UNIQUEVILLAGE","Memoirs of Alexander the Great");
define("STORAGE_DESC","With this building plan you are able to build the Great Granary or Great Warehouse in the Village with the artifact, or the whole account depending on the artifact. As long as you posses that artifact you are able to build and enlarge those buildings.");
define("STORAGE_SMALL","Slight storage masterplan");
define("STORAGE_SMALLVILLAGE","Builders Sketch");
define("STORAGE_LARGE","Great storage masterplan");
define("STORAGE_LARGEVILLAGE","Babylonian Tablet");
define("CONFUSION_DESC","Cranny capacity is increased by a certain amount for each type of artifact. Catapults can only shoot random on villages within this artifacts power. Exceptions are the WW which can always be targeted and the treasure chamber which can always be targeted, except with the unique artifact. When aiming at a resource field only random resource fields can be hit, when aiming at a building only random buildings can be hit.");
define("CONFUSION_SMALL","Rivals slight confusion");
define("CONFUSION_SMALLVILLAGE","Map of the Hidden Caverns");
define("CONFUSION_LARGE","Rivals great confusion");
define("CONFUSION_LARGEVILLAGE","Bottomless Satchel");
define("CONFUSION_UNIQUE","Rivals unique confusion");
define("CONFUSION_UNIQUEVILLAGE","Trojan Horse");
define("FOOL_DESC","Every 24 hours it gets a random effect, bonus, or penalty (all are possible with the exception of great warehouse, great granary and WW building plans). They change effect AND scope every 24 hours. The unique artifact will always take positive bonuses.");
define("FOOL_SMALL","Artefact of the slight fool");
define("FOOL_SMALLVILLAGE","Pendant of Mischief");
define("FOOL_UNIQUE","Artefact of the unique fool");
define("FOOL_UNIQUEVILLAGE","Forbidden Manuscript");
define("ARTEFACT","Construction plans



Countless days have passed since the first battles upon the walls of the cursed villages of the Dread Natars, many armies of both the free ones and the Natarian empire struggled and died before the walls of the many strongholds from which the Natars had once ruled all creation. Now with the dust settled and a relative calm having settled in, armies began to count their losses and collect their dead, the stench of combat still lingering in the night air, a smell of a slaughter unforgettable in its extent and brutality yet soon to be dwarfed by yet others. The largest armies of the free ones and the Dread Natars were marshalling for yet another renewed assault upon the coveted former strongholds of the Natarian Empire.

Soon scouts arrived telling of a most awesome sight and a chilling reminder, a dread army of an unfathomable size had been spotted marshalling at the end of the world, the Natarian capital, a force so great and unstoppable that the dust from their march would choke off all light, a force so brutal and ruthless that it would crush all hope. The free people knew that they had to race now, race against time and the endless hordes of the Natarian Empire to raise a Wonder of the World to restore the world to peace and vanquish the Natarian threat.

But to raise such a great Wonder would be no easy task, one would need construction plans created in the distant past, plans of such an arcane nature that even the very wisest of sages knew not their contents or locations.

Tens of thousands of scouts roamed across all existence searching in vain for these mystical plans, looking in all places but the dreaded Natarian Capital, yet could not find them. Today however, they return bearing good news, they return baring the locations of the plans, hidden by the armies of the Natars inside secret strongholds constructed to be hidden from the eyes of man.

Now begins the final stretch, when the greatest armies of the Free people and the Natars will clash across the world for the fate of all that lies under heaven. This is the war that will echo across the eons, this is your war, and here you shall etch your name across history, here you shall become legend.


Facts:
To steal one, the following things must happen:
You must attack the village (NO Raid!)
WIN the Attack
Destroy the treasury
An empty treasury lvl 10 MUST be in the village where that attack came from
Have a hero in an attack

If not, the next attack on that village, winning with a hero and empty treasury will take the building plan.

To build a WW, you must own a plan yourself (you = the WW village owner) from lvl 0 to 49, from 50 to 100 you need an additional plan in your alliance! Two plans in the WW village account would not work!

The construction plans are conquerable immediately when they appear to the server. 

There will be a countdown in game, showing the exact time of the release, 5 days prior to the launch. ");


//planos
define("PLAN","Ancient Construction Plan");
define("PLANVILLAGE","WW Buildingplan");
define("PLAN_DESC","With this ancient construction plan you will able to build World Wonder to level 50. to build further, your alliance must hold at least two plans.");
define("PLAN_INFO","World Wonder Construction Plans 


Many moons ago the tribes of Travian were surprised by the unforeseen return of the Natars. This tribe from immemorial times surpassing all in wisdom, might and glory was about to trouble the free ones again. Thus they put all their efforts in preparing a last war against the Natars and vanquishing them forever. Many thought about the so-called 'Wonders of the World', a construction of many legends, as the only solution. It was told that it would render anyone invincible once completed. Ultimately making the constructors the rulers and conquerors of all known Travian. 

However, it was also told that one would need construction plans to construct such a building. Due to this fact, the architects devised cunning plans about how to store these safely. After a while, one could see temple-like buildings in many a city and metropolis - the Treasure Chambers (Treasuries). 

Sadly, no one - not even the wise and well versed - knew where to find these construction plans. The harder people tried to locate them, the more it seemed as if they where only legends. 

Today, however, this last secret will be revealed. Deprivations and endeavors of the past will not have been in vain, as today scouts of several tribes have successfully obtained the whereabouts of the construction plans. Well guarded by the Natars, they lie hidden in several oases to be found all over Travian. Only the most valiant heroes will be able to secure such a plan and bring it home safely so that the construction can begin. 

In the end, we will see whether the free tribes of Travian can once again outwit the Natars and vanquish them once and for all. Do not be so foolish as to assume that the Natars will leave without a fight, though!



To steal a set of Construction Plans from the Natars, the following things must happen:
- You must Attack the village (NOT Raid!)
- You must WIN the Attack
- You must DESTROY the Treasure Chamber (Treasury)
- Your Hero MUST be in that attack, as he is the only one who may carry the Construction Plans
- An empty level 10 Treasure Chamber (Treasury) MUST be in the village where that attack came from
NOTE: If the above criteria is not met during the attack, the next attack on that village which does meet the above criteria will take the Construction Plans.



To build a Treasure Chamber (Treasury), you will need a Main Building level 10 and the village MUST NOT be a Capital or contain a World Wonder.

To build a World Wonder, you must own the Construction Plans yourself (you = the World Wonder Village Owner) from level 0 to 50, and then from level 51 to 100 you will need an additional set of Construction Plans in your Alliance! Two sets of Construction Plans in the World Wonder Village Account will not work!");
define("WWVILLAGE","WW village");

/*
|--------------------------------------------------------------------------
|   Index
|--------------------------------------------------------------------------
*/

	   $lang['index'][0][1] = "Welcome to " . SERVER_NAME . "";
	   $lang['index'][0][2] = "Manual";
	   $lang['index'][0][3] = "Play now, for free!";
	   $lang['index'][0][4] = "What is " . SERVER_NAME . "";
	   $lang['index'][0][5] = "" . SERVER_NAME . " is a <b>browser game</b> featuring an engaging ancient world with thousands of other real players.</p><p>It`s <strong>free to play</strong> and requires <strong>no downloads</strong>.";
	   $lang['index'][0][6] = "Click here to play " . SERVER_NAME . "";
	   $lang['index'][0][7] = "Total players";
	   $lang['index'][0][8] = "Players active";
	   $lang['index'][0][9] = "Players online";
	   $lang['index'][0][10] = "About the game";
	   $lang['index'][0][11] = "You will begin as the chief of a tiny village and will embark on an exciting quest.";
	   $lang['index'][0][12] = "Build up villages, wage wars or establish trade routes with your neighbours.";
	   $lang['index'][0][13] = "Play with and against thousands of other real players and conquer the the world of Travian.";
	   $lang['index'][0][14] = "News";
	   $lang['index'][0][15] = "FAQ";
	   $lang['index'][0][16] = "Screenshots";
	   $lang['forum'] = "Forum";
	   $lang['register'] = "Регистрация";
	   $lang['login'] = "Login";

/*
|--------------------------------------------------------------------------
|   top_menu
|--------------------------------------------------------------------------
*/
		$lang['header'] = array (
							0 => 'Обзор деревни',
							1 => 'Центр деревни',
							2 => 'Карта',
							3 => 'Статистика',
							4 => 'Отчеты',
							5 => 'Сообщения',
							6 => 'Plus меню');

		$lang['buildings'] = array (
							1 => "Лесопилка",
							2 => "Глиняный карьер",
							3 => "Железный рудник",
							4 => "Ферма",
							5 => "Лесопильный завод",
							6 => "Кирпичный завод",
							7 => "Сталелитейный завод",
							8 => "Мукомольная мельница",
							9 => "Пекарня",
							10 => "Склад",
							11 => "Амбар",
							12 => "Кузня",
							13 => "Оружейня",
							14 => "Арена",
							15 => "Главное здание",
							16 => "Пункт сбора",
							17 => "Рынок",
							18 => "Посольство",
							19 => "Казарма",
							20 => "Канюшня",
							21 => "Мастерская",
							22 => "Академия",
							23 => "Тайник",
							24 => "Ратуша",
							25 => "Резиденция",
							26 => "Дворец",
							27 => "Сокровищница",
							28 => "Торговая палата",
							29 => "Большая казарма",
							30 => "Большая конюшня",
							31 => "Городская стена",
							32 => "Земляной вал",
							33 => "Изгородь",
							34 => "Каменотес",
							35 => "Пивоваренный завод",
							36 => "Капканщик",
							37 => "Таверна",
							38 => "Большой склад",
							39 => "Большой амбар",
							40 => "Чудо Света",
							41 => "Водопой",
							42 => "Большая мастерская",
							43 => "Ошибка",
							44 => "&nbsp;(уровень&nbsp;");

		$lang['fields'] = array (
							0 => '&nbsp;уровень',
							1 => 'Лесопилка уровень',
							2 => 'Глиняный карьер уровень ',
							3 => 'Железный рудник уровень',
							4 => 'Ферма уровень',
							5 => 'Наружняя строительная площадка',
							6 => 'Строительная площадка',
							7 => 'Строительная площадка пункта сбора');

		$lang['npc'] = array (
							0 => 'NPC торговец');

		$lang['upgrade'] = array (
							0 => 'Здание уже на максимальном уровне',
							1 => 'Максимальный уровень здания строится',
							2 => 'Здание будет снесено',
							3 => '<b>Стоимость</b> строительства до уровня&nbsp;',
							4 => 'Рабочие заняты.',
							5 => 'Не хватает еды. Развивайте фермы.',
							6 => 'Постройте склад.',
							7 => 'Постройте амбар.',
							8 => 'Достаточно ресурсов будет&nbsp;',
							9 => '&nbsp;в&nbsp;&nbsp;',
							10 => 'Улучшить до уровня&nbsp;',
							11 => 'сегодня',
							12 => 'завтра');

		$lang['movement'] = array (
							0 => 'в&nbsp;');

		$lang['troops'] = array (
							0 => 'нет',
							1 => 'Герой');
?>
