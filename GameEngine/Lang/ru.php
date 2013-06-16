<?php

//////////////////////////////////////////////////////////////////////////////////////////////////////
//                                             TRAVIANX                                             //
//            Only for advanced users, do not edit if you dont know what are you doing!             //
//                                Made by: Dzoki & Dixie (TravianX)                                 //
//                              - TravianX = Travian Clone Project -                                //
//                                 DO NOT REMOVE COPYRIGHT NOTICE!                                  //
//////////////////////////////////////////////////////////////////////////////////////////////////////
									//                         //
									//         Русский         //
									//   Author: kylesv (sV)   //
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
