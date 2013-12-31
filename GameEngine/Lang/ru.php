<?php

//////////////////////////////////////////////////////////////////////////////////////////////////////
//                                             TRAVIANX                                             //
//            Only for advanced users, do not edit if you dont know what are you doing!             //
//                                Made by: Dzoki & Dixie (TravianX)                                 //
//                              - TravianX = Travian Clone Project -                                //
//                                 DO NOT REMOVE COPYRIGHT NOTICE!                                  //
//                                Adding tasks and constructions  by: Armando                       //
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
define("Q18_DESC1"," is located on the right side of the main building, slightly below it. The building site itself is curved.");
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
define("Q20_RESP1","to see how many troops you need to successfully fight one rat without losses.");

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
define("Q32_RESP","All resources were to level 5, the village's products have gone up and take a step forward...");

define("Q33","Task 27: Palace or Residence?");
define("Q33_DESC","To found a new village, you will need settlers. Those you can train in either a palace or a residence.");
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


//LOGIN.php
define("COOKIES","You must have cookies enabled to be able to log in. If you share this computer with other people you should log out after each session for your own safety.");
define("NAME","Имя");
define("PW_FORGOTTEN","Забыли пароль?");
define("PW_REQUEST","Вы можете запросить другой пароль на свой почтовый адрес.");
define("PW_GENERATE","Создать новый пароль.");
define("EMAIL_NOT_VERIFIED","Email nне принят!");
define("EMAIL_FOLLOW","Проследуйте по следующей ссылке чтобы активировать аккаунт.");
define("VERIFY_EMAIL","Email подтвержден.");


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
define("BRICKYARD","Brickyard");
define("IRONFOUNDRY","Iron Foundry");
define("GRAINMILL","Grain Mill");
define("BAKERY","Bakery");
define("WAREHOUSE","Warehouse");
define("GRANARY","Granary");
define("BLACKSMITH","Blacksmith");
define("ARMOURY","Armoury");
define("TOURNAMENTSQUARE","Tournament Square");
define("MAINBUILDING","Main Building");
define("RALLYPOINT","Rally Point");
define("MARKETPLACE","Marketplace");
define("EMBASSY","Embassy");
define("BARRACKS","Barracks");
define("STABLE","Stable");
define("WORKSHOP","Workshop");
define("ACADEMY","Academy");
define("CRANNY","Cranny");
define("TOWNHALL","Town Hall");
define("RESIDENCE","Residence");
define("PALACE","Palace");
define("TREASURY","Treasury");
define("TRADEOFFICE","Trade Office");
define("GREATBARRACKS","Great Barracks");
define("GREATSTABLE","Great Stable");
define("CITYWALL","City Wall");
define("EARTHWALL","Earth Wall");
define("PALISADE","Palisade");
define("STONEMASON","Stonemason's Lodge");
define("BREWERY","Brewery");
define("TRAPPER","Trapper");
define("HEROSMANSION","Hero's Mansion");
define("GREATWAREHOUSE","Great Warehouse");
define("GREATGRANARY","Great Granary");
define("WONDER","Wonder of the World");
define("HORSEDRINKING","Horse Drinking Trough");
define("GREATWORKSHOP","Great Workshop");

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
