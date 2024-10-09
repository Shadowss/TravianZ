<?php

//////////////////////////////////////////////////////////////////////////////////////////////////////
//                                             TRAVIANZ                                             //
//            Only for advanced users, do not edit if you dont know what are you doing!             //
//                                Made by: Dzoki & Dixie (TravianZ)                                 //
//                              - TravianZ = Travian Clone Project -                                //
//                                 DO NOT REMOVE COPYRIGHT NOTICE!                                  //
//                                Adding tasks, constructions and artefact  by: Armando             //
//                                Modified , added , fixed , implementd  by: Shadow and ronix       //
//////////////////////////////////////////////////////////////////////////////////////////////////////
									//                         //
									//         Chinese         //
									//   Author: muchen.fan    //
									//                         //
									/////////////////////////////

//MAIN MENU
define("TRIBE1","罗马");
define("TRIBE2","条顿");
define("TRIBE3","高卢");
define("TRIBE4","自然");
define("TRIBE5","纳塔");
define("TRIBE6","野兽");

define("HOME","主页");
define("INSTRUCT","说明");
define("ADMIN_PANEL","管理员面板");
define("MASS_MESSAGE","群发消息");
define("LOGOUT","登出");
define("PROFILE","档案");
define("SUPPORT","支持");
define("UPDATE_T_10","更新前十");
define("SYSTEM_MESSAGE","系统信息");
define("TRAVIAN_PLUS","Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></span></span></b>");
define("CONTACT","联系我们");
define("GAME_RULES","游戏规则");

//MENU
define("REG","注册");
define("FORUM","论坛");
define("CHAT","聊天");
define("IMPRINT","信息");
define("MORE_LINKS","更多链接");
define("TOUR","观光");


//ERRORS
define("USRNM_EMPTY","(用户名为空)");
define("USRNM_TAKEN","(用户名已被占用)");
define("USRNM_SHORT","(用户名最少 ".USRNM_MIN_LENGTH." 个字符)");
define("USRNM_CHAR","(含有不可用字符)");
define("PW_EMPTY","(密码为空)");
define("PW_SHORT","(用户名最少 ".PW_MIN_LENGTH." 个字符)");
define("PW_INSECURE","(密码不安全，请采用更复杂的密码)");
define("EMAIL_EMPTY","(邮箱地址为空)");
define("EMAIL_INVALID","(不可用的邮箱地址)");
define("EMAIL_TAKEN","(邮箱地址已被使用)");
define("TRIBE_EMPTY","<li>请选择一个种族。</li>");
define("AGREE_ERROR","<li>若要注册，请先同意游戏规则和T&C。</li>");
define("LOGIN_USR_EMPTY","请输入用户名。");
define("LOGIN_PASS_EMPTY","请输入密码。");
define("EMAIL_ERROR","邮箱地址未知。");
define("PASS_MISMATCH","密码不匹配。");
define("ALLI_OWNER","在删除前，请先指派新盟主。");
define("SIT_ERROR","代管人已经设置或不存在。");
define("USR_NT_FOUND","用户名不存在。");
define("LOGIN_PW_ERROR","密码错误。");
define("WEL_TOPIC","实用讯息");
define("ATAG_EMPTY","标签为空");
define("ANAME_EMPTY","名称为空");
define("ATAG_EXIST","标签已占用");
define("ANAME_EXIST","名称已占用");
define("ALREADY_ALLY_MEMBER","你已经在联盟中");
define("ALLY_TOO_LOW", "你必须拥有3级或更高等级的大使馆");
define("USER_NOT_IN_YOUR_ALLY","该用户不在你的联盟中。");
define("CANT_EDIT_YOUR_PERMISSIONS","你不能更改自己的权限");
define("CANT_EDIT_LEADER_PERMISSIONS","盟主的权限不能更改。");
define("NO_PERMISSION", "你的权限不够。");
define("NAME_OR_DIPL_EMPTY", "名称或外交关系为空");
define("ALLY_DOESNT_EXISTS","联盟不存在");
define("CANNOT_INVITE_SAME_ALLY","你不能邀请你自己的联盟");
define("WRONG_DIPLOMACY","选择错误");
define("INVITE_ALREADY_SENT","协定邀请已发出、或对方已发出邀请、或你已经与对方存在协定关系。");
define("INVITE_SENT","邀请已发出");
define("DECLARED_WAR_ON","宣告战争，向");
define("OFFERED_NON_AGGRESION_PACT_TO","发出互不侵略协定邀请，向");
define("OFFERED_CONFED_TO","发出联合邀请，向");
define("ALLY_TOO_MUCH_PACTS","你不能发出更多此类协定的邀请、或联盟已经到达签订此种协定数量的上限。");
define("ALLY_PERMISSIONS_UPDATED","权限已更新");
define("ALLY_FORUM_LINK_UPDATED", "论坛链接已更新");
define("NO_FORUMS_YET","目前还没有论坛");
define("ALLY_USER_KICKED"," 已经被踢出联盟");
define("NOT_OPENED_YET","服务器尚未启动");
define("REGISTER_CLOSED","注册已关闭，你不能在此服务器上注册。");
define("NAME_EMPTY","请输入名称");
define("NAME_NO_EXIST","该名称不存在 ");
define("ID_NO_EXIST","该ID不存在 ");
define("SAME_NAME","你不能邀请你自己");
define("ALREADY_INVITED"," 已被邀请");
define("ALREADY_IN_ALLY"," 已经在联盟中");
define("ALREADY_IN_AN_ALLY"," 已经在其他联盟中");
define("NAME_OR_TAG_CHANGED","名称或标签已被更改");
define("VAC_MODE_WRONG_DAYS","你输入了错误的天数");

//COPYRIGHT
define("TRAVIAN_COPYRIGHT","TravianZ 100% 开源 Travian 克隆。");

//BUILD.TPL
define("CUR_PROD","当前产量");
define("NEXT_PROD","产量，等级 ");
define("CONSTRUCT_BUILD","建造建筑");

//BUILDINGS
define("B1","伐木场");
define("B1_DESC","伐木场的工人们砍倒树木，生产木材。伐木场的等级越高，木材的产能越高。");
define("B2","黏土坑");
define("B2_DESC","黏土坑生产黏土。黏土坑的等级越高，黏土的产能越高。");
define("B3","铁矿场");
define("B3_DESC","在这里，矿工们挖出宝贵的金属。铁矿场的等级越高，铁矿的产能越高。");
define("B4","农田");
define("B4_DESC","你的人民和士兵的食物在这里产出。农田的等级越高，粮食的产能越高。");

//DORF1
define("LUMBER","木材");
define("CLAY","黏土");
define("IRON","铁矿");
define("CROP","粮食");
define("LEVEL","等级");
define("CROP_COM",CROP."消耗");
define("PER_HR","每小时");
define("PROD_HEADER","产量");
define("CAPITAL_LABEL","Capital");
define("MULTI_V_HEADER","村民");
define("ANNOUNCEMENT","公告");
define("GO2MY_VILLAGE","返回我的村庄");
define("VILLAGE_CENTER","村庄大楼");
define("FINISH_GOLD","将使用 2 金币瞬间完成本村的所有建筑和研究队列");
define("WAITING_LOOP","(队列中)");
define("CROP_NEGATIVE","你的粮食产量为负，因此不可能抵达需求的粮食数目。");
define("HRS","(小时)");
define("DONE_AT","完成于");
define("CANCEL","取消");
define("LOYALTY","忠诚度");
define("CALCULATED_IN","响应延迟");
define("SERVER_TIME","服务器时间:");
define("HI","嗨");
define("P_IN","在");

//QUEST
define("Q_CONTINUE","继续下一个任务。");
define("Q_REWARD","你的奖励:");
define("Q_BUTN","完成任务");
define("Q0","欢迎来到");
define("Q0_DESC","嘿，看起来你就是这座小村庄的首领。在刚开始的这段时间里我来指导你如何发展你的部落。");
define("Q0_OPT1","开始任务");
define("Q0_OPT2","我想自己看看");
define("Q0_OPT3","跳过任务");

define("Q1","任务 1: 伐木场");
define("Q1_DESC","你的村庄里有四片绿色的森林。在一片森林中建造一个伐木场，因为木材是我们新聚居点的重要资源。");
define("Q1_ORDER","目标:<\/p>建造一个伐木场。");
define("Q1_RESP","就是这样，现在村庄能生产更多木材了。我帮点小忙，把建造瞬间完成。");
define("Q1_REWARD","伐木场瞬间建造完成。");

define("Q2","任务 2: 粮食");
define("Q2_DESC","你的人民辛勤劳作，他们的伙食保障至关重要。开发一片农田来满足粮食需求。当建筑完成了再回来。");
define("Q2_ORDER","目标:<\/p>开发一片农田。");
define("Q2_RESP","很好，你的人民吃得饱饭了。");
define("Q2_REWARD","你的奖励:<\/p>1 天 Travian");

define("Q3","任务 3: 你村庄的名字");
define("Q3_DESC","Creative as you are you can grant your village the ultimate name.<br \/><br \/>Click on 'profile' in the left hand menu and then select 'change profile'...");
define("Q3_ORDER","Order:<\/p>Change your village's name to something nice.");
define("Q3_RESP","Wow, a great name for their village. It could have been the name of my village!...");

define("Q4","任务 4: Other Players");
define("Q4_DESC","In ". SERVER_NAME ." you play along with billions of other players. Click 'statistics' in the top menu to look up your rank and enter it here.");
define("Q4_ORDER","Order:<\/p>Look for your rank in the statistics and enter it here.");
define("Q4_BUTN","complete task");
define("Q4_RESP","Exactly! That's your rank.");

define("Q5","任务 5: Two Building Orders");
define("Q5_DESC","Build an iron mine and a clay pit. Of iron and clay one can never have enough.");
define("Q5_ORDER","Order:<\/p><ul><li>Extend one iron mine.<\/li><li>Extend one clay pit.<\/li><\/ul>");
define("Q5_RESP","As you noticed, building orders take rather long. The world of ". SERVER_NAME ." will continue to spin even if you are offline. Even in a few months there will be many new things for you to discover.<br \/><br \/>The best thing to do is occasionally checking your village and giving you subjects new tasks to do.");

define("Q6","任务 6: Messages");
define("Q6_DESC","You can talk to other players using the messaging system. I sent a message to you. Read it and come back here.<br \/><br \/>P.S. Don't forget: on the left the reports, on the right the messages.");
define("Q6_ORDER","Order:<\/p>Read your new message.");
define("Q6_RESP","You received it? Very good.<br \/><br \/>Here is some Gold. With Gold you can do several things, e.g. extend your   in the left hand menu.");
define("Q6_RESP1","-Account or increase your resource production.To do so click ");
define("Q6_RESP2","in the left hand menu.");
define("Q6_SUBJECT","Message From The Taskmaster");
define("Q6_MESSAGE","You are to be informed that a nice reward is waiting for you at the taskmaster.<br /><br />Hint: The message has been generated automatically. An answer is not necessary.");

define("Q7","任务 7: One Each!");
define("Q7_DESC","Now we should increase your resource production a bit. Build an additional woodcutter, clay pit, iron mine and cropland to level 1.");
define("Q7_ORDER","Order:<\/p>Extend one more of each resource tile to level 1.");
define("Q7_RESP","Very good, great develop of resources production.");

define("Q8","任务 8: Huge Army!");
define("Q8_DESC","Now I've got a very special quest for you. I am hungry. Give me 200 crop!<br \/><br \/>In return I will try to organize a huge army to protect your village.");
define("Q8_ORDER","Order:<\/p>Send 200 crop to the taskmaster.");
define("Q8_BUTN","Send crop");
define("Q8_NOCROP","No Enough Crop!");

define("Q9","任务 9: Everything to 1.");
define("Q9_DESC","In Travian there is always something to do! While you are waiting for incoming the huge army, Now we should increase your resource production a bit. Extend all your resource tiles to level 1.");
define("Q9_ORDER","Order:<\/p>Extend all resource tiles to level 1.");
define("Q9_RESP","Very good, your resource production just thrives.<br \/><br \/>Soon we can start with constructing buildings in the village.");

define("Q10","任务 10: Dove of Peace");
define("Q10_DESC","The first days after signing up you are protected against attacks by your fellow players. You can see how long this protection lasts by adding the code <b>[#0]<\/b> to your profile.");
define("Q10_ORDER","Order:<\/p>Write the code <b>[#0]<\/b> into your profile by adding it to one of the two description fields.");
define("Q10_RESP","Well done! Now everyone can see what a great warrior the world is approached by.");
define("Q10_REWARD","Your reward:<\/p>2 day Travian");

define("Q11","任务 11: Neighbours!");
define("Q11_DESC","Around you, there are many different villages. One of them is named. ");
define("Q11_DESC1"," Click on 'map' in the header menu and look for that village. The name of your neighbours' villages can be seen when hovering your mouse over any of them.");
define("Q11_ORDER","Order:</p>Look for the coordinates of ");
define("Q11_ORDER1","and enter them here.");
define("Q11_RESP","Exactly, there ");
define("Q11_RESP1"," Village! As many resources as you reach this village. Well, almost as much ...");
define("Q11_BUTN","complete task");

define("Q12","任务 12: Cranny");
define("Q12_DESC","It's getting time to erect a cranny. The world of <?php echo SERVER_NAME; ?> is dangerous.<br \/><br \/>Many players live by stealing other players' resources. Build a cranny to hide some of your resources from enemies.");
define("Q12_ORDER","Order:<\/p>Construct a Cranny.");
define("Q12_RESP","Well done, now it's way harder for your mean fellow players to plunder your village.<br \/><br \/>If under attack, your villagers will hide the resources in the Cranny all on their own.");

define("Q13","任务 13: To Two.");
define("Q13_DESC","In <?php echo SERVER_NAME; ?> there is always something to do! Extend one woodcutter, one clay pit, one iron mine and one cropland to level 2 each.");
define("Q13_ORDER","Order:<\/p>Extend one of each resource tile to level 2.");
define("Q13_RESP","Very good, your village grows and thrives!");

define("Q14","任务 14: Instructions");
define("Q14_DESC","In the ingame instructions you can find short information texts about different buildings and types of units.<br \/><br \/>Click on 'instructions' at the left to find out how much lumber is required for the barracks.");
define("Q14_ORDER","Order:<\/p>Enter how much lumber barracks cost");
define("Q14_BUTN","complete task");
define("Q14_RESP","Exactly! Barracks cost 210 lumber.");

define("Q15","任务 15: Main Building");
define("Q15_DESC","Your master builders need a main building level 3 to erect important buildings such as the marketplace or barracks.");
define("Q15_ORDER","Order:<\/p>Extend your main building to level 3.");
define("Q15_RESP","Well done. The main building level 3 has been completed.<br><br>With this upgrade your master builders cannot only construct more types of buildings but also do so faster.");

define("Q16","任务 16: Advanced!");
define("Q16_DESC","Look up your rank in the player statistics again and enjoy your progress.");
define("Q16_ORDER","Order:<\/p>Look for your rank in the statistics and enter it here.");
define("Q16_RESP","Well done! That's your current rank.");

define("Q17","任务 17: Weapons or Dough");
define("Q17_DESC","Now you have to make a decision: Either trade peacefully or become a dreaded warrior.<br \/><br \/>For the marketplace you need a granary, for the barracks you need a rally point.");
define("Q17_BUTN","Economy");
define("Q17_BUTN1","Military");

define("Q18","任务 18: Military");
define("Q18_DESC","A brave decision. To be able to send troops you need a rally point.<br \/><br \/>The rally point must be built on a specific building site. The ");
define("Q18_DESC1"," building site.");
define("Q18_DESC2"," is located on the right side of the main building, slightly below it. The building site itself is curved.");
define("Q18_ORDER","Order:<\/p>Construct a rally point.");
define("Q18_RESP","Your rally point has been erected! A good move towards world domination!");

define("Q19","任务 19: Barracks");
define("Q19_DESC","Now you have a main building level 3 and a rally point. That means that all prerequisites for building barracks have been fulfilled.<br><br>You can use the barracks to train troops for fighting.");
define("Q19_ORDER","Order:<\/p>Construct barracks.");
define("Q19_RESP","Well done... The best instructors from the whole country have gathered to train your men\u2019s fighting skills to top form.");

define("Q20","任务 20: Train.");
define("Q20_DESC","Now that you have barracks you can start training troops. Train two ");
define("Q20_ORDER","Please train 2 ");
define("Q20_RESP","The foundation for your glorious army has been laid.<br \/><br \/>Before sending your army off to plunder you should check with the.");
define("Q20_RESP1","Combat Simulator");
define("Q20_RESP2","to see how many troops you need to successfully fight one rat without losses.");

define("Q21","任务 18: Economy");
define("Q21_DESC","Trade & Economy was your choice. Golden times await you for sure!");
define("Q21_ORDER","Order:<\/p>Construct a Granary.");
define("Q21_RESP","Well done! With the Granary you can store more wheat.");

define("Q22","任务 19: Warehouse");
define("Q22_DESC","Not only Crop has to be saved. Other resources can go to waste as well if they are not stored correctly. Construct a Warehouse!");
define("Q22_ORDER","Order:<\/p>Construct Warehouse.");
define("Q22_RESP",";Well done, your Warehouse is complete...&rdquo;<\/i><br \/>Now you have fulfilled all prerequisites required to construct a Marketplace.");

define("Q23","任务 20: Marketplace.");
define("Q23_DESC",";Construct a Marketplace so you can trade with your fellow players.");
define("Q23_ORDER","Order:<\/p>Please build a Marketplace.");
define("Q23_RESP",";The Marketplace has been completed. Now you can make offers of your own and accept foreign offers! When creating your own offers, you should think about offering what other players need most to get more profit.");

define("Q24","任务 21: Everything to 2.");
define("Q24_DESC","Now we should increase your resource production a bit. Build an additional woodcutter, clay pit, iron mine and cropland to level 1.");
define("Q24_ORDER","Order:<\/p>Extend all resource tiles to level 2.");
define("Q24_RESP","Congratulations! Your village grows and thrives...");

define("Q28","任务 22: Alliance.");
define("Q28_DESC","Teamwork is important in Travian. Players who work together organise themselves in alliances. Get an invitation from an alliance in your region and join this alliance. Alternatively, you can found your own alliance. To do this, you need a level 3 embassy.");
define("Q28_ORDER","Order:<\/p>Join an alliance or found one on your own.");
define("Q28_RESP","Is good! Now you're in a union called");
define("Q28_RESP1",", and you're a member of their alliance with the faster you'll progress...");

define("Q29","任务 23: Main Building to Level 5");
define("Q29_DESC","To be able to build a palace or residence, you will need a main building at level 5.");
define("Q29_ORDER","Order:<\/p>Upgrade your main building to level 5.");
define("Q29_RESP","The main building is level 5 now and you can build palace or residence...");

define("Q30","任务 24: Granary to Level 3.");
define("Q30_DESC","That you do not lose crop, you should upgrade your granary.");
define("Q30_ORDER","Order:<\/p>Upgrade your granary to level 3.");
define("Q30_RESP","Granary is level 3 now...");

define("Q31","任务 25: Warehouse to Level 7");
define("Q31_DESC"," To make sure your resources won't overflow, you should upgrade your warehouse.");
define("Q31_ORDER","Order:<\/p>Upgrade your warehouse to level 7.");
define("Q31_RESP","Warehouse has upgraded to level 7...");

define("Q32","任务 26: All to five!");
define("Q32_DESC","You will always need more resources. Resource tiles are quite expensive but will always pay out in the long term.");
define("Q32_ORDER","Order:<\/p>Upgrade all resources tiles to level 5.");
define("Q32_RESP","All resources are at level 5, very good, your village grows and thrives!");

define("Q33","任务 27: Palace or Residence?");
define("Q33_DESC","To found a new village, you will need settlers. Those you can train in either a palace or a residence.");
define("Q33_ORDER","Order:<\/p>Build a palace or residence to level 10.");
define("Q33_RESP","had reached to level 10, you can now train settlers and found your second village. Notice the cultural points...");

define("Q34","任务 28: 3 settlers.");
define("Q34_DESC","To found a new village, you will need settlers. They can be trained  in either a palace or a residence.");
define("Q34_ORDER","Order:<\/p>Train 3 settlers.");
define("Q34_RESP","3 settlers were trained. To found new village you need at least");
define("Q34_RESP1","culture points...");

define("Q35","任务 29: New Village.");
define("Q35_DESC","There are a lot of empty tiles on the map. Find one that suits you and found a new village");
define("Q35_ORDER","Order:<\/p>Found a new village.");
define("Q35_RESP","I am proud of you! Now you have two villages and have all the possibilities to build a mighty empire. I wish you luck with this.");

define("Q36"," 任务 30: Build a ");
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

//Quest 25
define("Q25_7","任务 7: Neighbours!");
define("Q25_7_DESC","Around you, there are many different villages. One of them is named. ");
define("Q25_7_DESC1","Click 'Map' in the head menu and look for that village. The name of your neighbours' villages can be seen once you hover your mouse over any of them.");
define("Q25_7_ORDER","<\/p><b>Order:</b><br>Look for the coordinates of ");
define("Q25_7_ORDER1","and enter them here.");
define("Q25_7_RESP","Exactly, there ");
define("Q25_7_RESP1"," Village! As many resources as you reach this village. Well, almost as much ...");

define("Q25_8","任务 8: Huge Army!");
define("Q25_8_DESC","Now I've got a very special Quest for you. I am hungry. Give me 200 crop!<br \/><br \/>In return I will try to organize a huge army to protect your village.");
define("Q25_8_ORDER","Order:<\/p>Send 200 crop to the taskmaster.");
define("Q25_8_BUTN","Send crop");
define("Q25_8_NOCROP","No Enough Crop!");

define("Q25_9","任务 9: One each!");
define("Q25_9_DESC","In " . SERVER_NAME . " there is always something to do! While you are waiting for your new army,<br \/><br \/>extend one additional woodcutter, clay pit, iron mine and cropland to level 1");
define("Q25_9_ORDER","Order:<\/p>Extend one more of each resource tile to level 1.");
define("Q25_9_RESP","Very good, great development of resource production.");

define("Q25_10","任务 10: Comming Soon!");
define("Q25_10_DESC","Now there is time for a small break until the gigantic army I sent you arrives.<br \/><br \/>Until then you can explore the map or extend a few resource tiles.");
define("Q25_10_ORDER","Order:<\/p>Wait for the taskmaster's army to arrive");
define("Q25_10_RESP","Now a huge army from taskmaster has arrive to protect your village");
define("Q25_10_REWARD","Your reward:<\/p>2 days more of Travian");

define("Q25_11","任务 11: Reports");
define("Q25_11_DESC","Every time something important happens to your account you will receive a report.<br \/><br \/>You can see these by clicking on the left half of the 5th button (from left to right). Read the report and come back here.");
define("Q25_11_ORDER","Order:<\/p>Read your latest report.");
define("Q25_11_RESP","You received it? Very good. Here is your reward.");

define("Q25_12","任务 12: Everything to 1.");
define("Q25_12_DESC","Now we should increase your resource production a bit.");
define("Q25_12_ORDER","Order:<\/p>Extend all resource tiles to level 1.");
define("Q25_12_RESP","Very good, your resource production just thrives.<br \/><br \/>Soon we can start with constructing buildings in the village.");

define("Q25_13","任务 13: Dove of Peace");
define("Q25_13_DESC","The first days after signing up you are protected against attacks by your fellow players. You can see how long this protection lasts by adding the code <b>[#0]<\/b> to your profile.");
define("Q25_13_ORDER","Order:<\/p>Write the code <b>[#0]<\/b> into your profile by adding it to one of the two description fields.");
define("Q25_13_RESP","Well done! Now everyone can see what a great warrior the world is approached by.");

define("Q25_14","任务 14: Cranny");
define("Q25_14_DESC","It's getting time to erect a cranny. The world of <b>" . SERVER_NAME. "</b> is dangerous.<br \/><br \/>Many players live by stealing other players' resources. Build a cranny to hide some of your resources from enemies.");
define("Q25_14_ORDER","Order:<\/p>Construct a Cranny.");
define("Q25_14_RESP","Well done, now it's way harder for your mean fellow players to plunder your village.<br \/><br \/>If under attack, your villagers will hide the resources in the Cranny all on their own.");

define("Q25_15","任务 15: To Two.");
define("Q25_15_DESC","In <b>" . SERVER_NAME. "</b> there is always something to do! Extend one woodcutter, one clay pit, one iron mine and one cropland to level 2 each.");
define("Q25_15_ORDER","Order:<\/p>Extend one of each resource tile to level 2.");
define("Q25_15_RESP","Very good, your village grows and thrives!");

define("Q25_16","任务 16: Instructions");
define("Q25_16_DESC","In the ingame instructions you can find short information texts about different buildings and types of units.<br \/><br \/>Click on 'instructions' at the left to find out how much lumber is required for the barracks.");
define("Q25_16_ORDER","Order:<\/p>Enter how much lumber barracks cost");
define("Q25_16_BUTN","complete task");
define("Q25_16_RESP","Exactly! Barracks cost 210 lumber.");

define("Q25_17","任务 17: Main Building");
define("Q25_17_DESC","Your master builders need a main building level 3 to erect important buildings such as the marketplace or barracks.");
define("Q25_17_ORDER","Order:<\/p>Extend your main building to level 3.");
define("Q25_17_RESP","Well done. The main building level 3 has been completed.<br><br>With this upgrade your master builders can construct more types of buildings and also do so faster.");

define("Q25_18","任务 18: Advanced!");
define("Q25_18_DESC","Look up your rank in the player statistics again and enjoy your progress.");
define("Q25_18_ORDER","Order:<\/p>Look for your rank in the statistics and enter it here.");
define("Q25_18_RESP","Well done! That's your current rank.");

define("Q25_19","任务 19: Weapons or Dough");
define("Q25_19_DESC","Now you have to make a decision: Either trade peacefully or become a dreaded warrior.<br \/><br \/>For the marketplace you need a granary, for the barracks you need a rally point.");
define("Q25_19_BUTN","Economy");
define("Q25_19_BUTN1","Military");

define("Q25_20","任务 19: Economy");
define("Q25_20_DESC","Trade & Economy was your choice. Golden times await you for sure!");
define("Q25_20_ORDER","Order:<\/p>Construct a Granary.");
define("Q25_20_RESP","Well done! With the Granary you can store more wheat.");

define("Q25_21","任务 20: Warehouse");
define("Q25_21_DESC","Not only Crop has to be saved. Other resources can go to waste as well if they are not stored correctly. Construct a Warehouse!");
define("Q25_21_ORDER","Order:<\/p>Construct Warehouse.");
define("Q25_21_RESP",";Well done, your Warehouse is complete...&rdquo;<\/i><br \/>Now you have fulfilled all prerequisites required to construct a Marketplace.");

define("Q25_22","任务 21: Marketplace.");
define("Q25_22_DESC",";Construct a Marketplace so you can trade with your fellow players.");
define("Q25_22_ORDER","Order:<\/p>Please build a Marketplace.");
define("Q25_22_RESP","The Marketplace has been completed. Now you can make offers of your own and accept foreign offers! When creating your own offers, you should think about offering what other players need most to get more profit.");

define("Q25_23","任务 19: Military");
define("Q25_23_DESC","A brave decision. To be able to send troops you need a rally point.<br \/><br \/>The rally point must be built on a specific building site. The ");
define("Q25_23_DESC1"," building site.");
define("Q25_23_DESC2"," is located on the right side of the main building, slightly below it. The building site itself is curved.");
define("Q25_23_ORDER","Order:<\/p>Construct a rally point.");
define("Q25_23_RESP","Your rally point has been erected! A good move towards world domination!");

define("Q25_24","任务 20: Barracks");
define("Q25_24_DESC","Now you have a main building level 3 and a rally point. That means that all prerequisites for building barracks have been fulfilled.<br><br>You can use the barracks to train troops for fighting.");
define("Q25_24_ORDER","Order:<\/p>Construct barracks.");
define("Q25_24_RESP","Well done... The best instructors from the whole country have gathered to train your men\u2019s fighting skills to top form.");

define("Q25_25","任务 21: Train.");
define("Q25_25_DESC","Now that you have barracks you can start training troops. Train two ");
define("Q25_25_ORDER","Please train 2 ");
define("Q25_25_RESP","The foundation for your glorious army has been laid.<br \/><br \/>Before sending your army off to plunder you should check with the");
define("Q25_25_RESP1","Combat Simulator");
define("Q25_25_RESP2","to see how many troops you need to successfully fight one rat without losses.");

define("Q25_26","任务 22: Everything to 2.");
define("Q25_26_DESC","Now it's time again to extend the cornerstones of might and wealth! This time level 1 is not enough... it will take a while but in the end it will be worth it. Extend all your resource tiles to level 2!");
define("Q25_26_ORDER","Order:<\/p>Extend all resource tiles to level 2.");
define("Q25_26_RESP","Congratulations! Your village grows and thrives...");

define("Q25_27","任务 23: Friends.");
define("Q25_27_DESC","As single player it is hard to compete with attackers. It is to your advantage if your neighbours like you.<br \/><br \/>It is even better if you play together with friends. Did you know that you can earn <img src='img/x.gif' class='gold' alt='Gold' title='Gold'> by inviting friends?");
define("Q25_27_ORDER","Order:<\/p>How much <img src='img/x.gif' class='gold' alt='Gold' title='Gold'> do you earn for inviting a friend?");
define("Q25_27_RESP","Correct! You get 50 <img src='img/x.gif' class='gold' alt='Gold' title='Gold'> if your invited friend have 2 village.");

define("Q25_28","任务 24: Construct Embassy.");
define("Q25_28_DESC","The world of Travian is dangerous. You already built a cranny to protect you against attackers.<br \/><br \/>A good alliance will give you even better protection.");
define("Q25_28_ORDER","Order:<\/p>To accept invitations from alliances, build an embassy.");
define("Q25_28_RESP","Yes! You can wait invitation from an alliance or create you own if embassy has level 3");

define("Q25_29","任务 25: Alliance.");
define("Q25_29_DESC","Teamwork is important in Travian. Players who work together organise themselves in alliances. Get an invitation from an alliance in your region and join this alliance. Alternatively, you can found your own alliance. To do this, you need a level 3 embassy.");
define("Q25_29_ORDER","Order:<\/p>Join an alliance or found your own alliance.");
define("Q25_29_RESP","Well done! Now you're in a union called");
define("Q25_29_RESP1",", and you're a member of their alliance.<br>Working together you will all progress faster...");

define("Q25_30","任务");
define("Q25_30_DESC","所有任务都已经完成!");


//======================================================//
//================ UNITS - DO NOT EDIT! ================//
//======================================================//
define("U0","英雄");

//ROMAN UNITS
define("U1","古罗马步兵");
define("U2","禁卫兵");
define("U3","帝国兵");
define("U4","使节骑士");
define("U5","帝国骑士");
define("U6","将军骑士");
define("U7","攻城锤");
define("U8","火焰投石机");
define("U9","参议员");
define("U10","拓荒者");

//TEUTON UNITS
define("U11","棍棒兵");
define("U12","矛兵");
define("U13","斧头兵");
define("U14","探子");
define("U15","游骑兵");
define("U16","条顿骑士");
define("U17","冲车");
define("U18","简易投石机");
define("U19","司令官");
define("U20","拓荒者");

//GAUL UNITS
define("U21","方阵兵");
define("U22","剑客");
define("U23","寻路者");
define("U24","雷法师");
define("U25","德鲁伊骑兵");
define("U26","海顿骑士");
define("U27","冲车");
define("U28","投石机");
define("U29","族长");
define("U30","拓荒者");
define("U99","陷阱");

//NATURE UNITS
define("U31","老鼠");
define("U32","蜘蛛");
define("U33","蛇");
define("U34","蝙蝠");
define("U35","野猪");
define("U36","狼");
define("U37","熊");
define("U38","鳄鱼");
define("U39","老虎");
define("U40","大象");

//NATARS UNITS
define("U41","长枪兵");
define("U42","荆棘战士");
define("U43","禁卫兵");
define("U44","猎鹰");
define("U45","斧头骑兵");
define("U46","纳塔骑士");
define("U47","战象");
define("U48","射石机");
define("U49","纳塔帝王");
define("U50","纳塔拓荒者");

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
define("R1","木材");
define("R2","黏土");
define("R3","铁矿");
define("R4","粮食");

//INDEX.php
define("LOGIN","登录");
define("PLAYERS","玩家");
define("MODERATOR","管理员");
define("ACTIVE","活跃");
define("ONLINE","在线");
define("TUTORIAL","教程");
define("PLAYER_STATISTICS","玩家数据");
define("TOTAL_PLAYERS","共有 ".PLAYERS." 名玩家");
define("ACTIVE_PLAYERS","活跃玩家");
define("ONLINE_PLAYERS","".PLAYERS." 玩家在线");
define("MP_STRATEGY_GAME","".SERVER_NAME." - 多人在线策略游戏");
define("WHAT_IS","".SERVER_NAME." 是风靡全世界的网页游戏。 作为 ".SERVER_NAME." 的一员，你将建立你自己的帝国、组建强大的军队、与你的盟友并肩作战并最终称霸世界。");
define("REGISTER_FOR_FREE","在此免费注册!");
define("LATEST_GAME_WORLD","最新游戏世界");
define("LATEST_GAME_WORLD2","Register on the latest<br/>game world and enjoy<br/>the advantages of<br/>being one of the<br/>first players.");
define("PLAY_NOW","Play ".SERVER_NAME." now");
define("LEARN_MORE","了解更多 <br/>有关 ".SERVER_NAME."!");
define("LEARN_MORE2","Now with a revolutionised<br>server system, completely new<br>graphics <br>This clone is The Shiz!");
define("COMUNITY","Community");
define("BECOME_COMUNITY","Become part of our community now!");
define("BECOME_COMUNITY2","Become a part of one of<br>the biggest gaming<br>communities in the<br>world.");
define("NEWS","新闻");
define("SCREENSHOTS","游戏截图");
define("FAQ","FAQ");
define("SPIELREGELN","规则");
define("AGB","条款声明");
define("LEARN1","Upgrade your fields and mines to increase your resource production. You will need resources to construct buildings and train soldiers.");
define("LEARN2","Construct and expand the buildings in your village. Buildings improve your overall infrastructure, increase your resource production and allow you to research, train and upgrade your troops.");
define("LEARN3","View and interact with your surroundings. You can make new friends or new enemies, make use of the nearby oases and observe as your empire grows and becomes stronger.");
define("LEARN4","Follow your improvement and success and compare yourself to other players. Look at the Top 10 rankings and fight to win a weekly medal.");
define("LEARN5","Receive detailed reports about your adventures, trades and battles. Don't forget to check the brand new reports about the happenings taking place in your surroundings.");
define("LEARN6","Exchange information and conduct diplomacy with other players. Always remember that communication is the key to winning new friends and solving old conflicts.");
define("LOGIN_TO","登录至 ". SERVER_NAME);
define("REGIN_TO","注册于 ". SERVER_NAME);
define("P_ONLINE","在线玩家: ");
define("P_TOTAL","所有玩家: ");
define("CHOOSE","请选择一个服务器");
define("STARTED"," 服务器启动于 ". round((time()-COMMENCE)/86400) ." 天前。");

//ANMELDEN.php
define("NICKNAME","昵称");
define("EMAIL","邮箱");
define("PASSWORD","密码");
define("ROMANS","罗马");
define("TEUTONS","条顿");
define("GAULS","高卢");
define("NW","西北");
define("NE","东北");
define("SW","西南");
define("SE","东南");
define("RANDOM","随机");
define("ACCEPT_RULES"," 我接受游戏规则和条约条款。");
define("ONE_PER_SERVER","每位玩家在一个服务器上至多只能拥有1个账号。");
define("BEFORE_REGISTER","在注册账号前你应阅读 Travian <a href='../anleitung.php' target='_blank'>游戏指南</a> 来了解三个种族各自的优势和劣势。");
define("BUILDING_UPGRADING","建造中:");
define("HOURS","小时");


//ATTACKS ETC.
define("TROOP_MOVEMENTS","行军中:");
define("ARRIVING_REINF_TROOPS","到来的增援部队");
define("ARRIVING_ATTACKING_TROOPS","到来的进攻部队");
define("ARRIVING_REINF_TROOPS_SHORT","增援");
define("OWN_ATTACKING_TROOPS","己方进攻部队");
define("ATTACK","进攻");
define("OWN_REINFORCING_TROOPS","己方增援部队");
define("TROOPS_DORF","部队:");
define("NEWVILLAGE","新村庄");
define("FOUNDNEWVILLAGE","建立新村庄");
define("UNDERATTACK","村庄遭受攻击");
define("OASISATTACK","绿洲遭受攻击");
define("OASISATTACKS","绿洲攻击");
define("RETURNFROM","返回自");
define("REINFORCEMENTFOR","增援至");
define("ATTACK_ON","进攻至");
define("RAID_ON","掠夺至");
define("SCOUTING","侦查");
define("PRISONERS","俘虏");
define("PRISONERSIN","俘虏在");
define("PRISONERSFROM","俘虏从");
define("TROOPS","部队");
define("TROOPSFROM","部队");
define("BOUNTY","赏金");
define("ARRIVAL","抵达");
define("CATAPULT_TARGET","攻城器目标");
define("INCOMING_TROOPS","到来的部队");
define("TROOPS_ON_THEIR_WAY","途中的部队");
define("OWN_TROOPS","己方部队");
define("ON","在");
define("AT","在");
define("UPKEEP","消耗");
define("SEND_BACK","送还");
define("TROOPS_IN_THE_VILLAGE","村庄中的部队");
define("TROOPS_IN_OTHER_VILLAGE","其他村庄的部队");
define("TROOPS_IN_OASIS","绿洲中的部队");
define("KILL","击杀");
define("FROM","从");
define("SEND_TROOPS","派遣部队");
define("TASKMASTER","任务官");
define("VILLAGE_OF_THE_ELDERS_TROOPS","旧部队的村庄");

//SEND TROOP
define("REINFORCE","增援");
define("NORMALATTACK","强攻");
define("RAID","掠夺");
define("OR","或");
define("SENDTROOP","派遣部队");
define("TROOP","部队");
define("NOTROOP","无部队");

//map
define("DETAIL","详情");
define("ABANDVALLEY","荒地");
define("OCCUPIED","已被占领的");
define("UNOCCUPIED","未被占领的");
define("UNOCCUOASIS","未被占领的绿洲");
define("OCCUOASIS","已被占领的绿洲");
define("THERENOINFO","没有<br>可用信息。");
define("LANDDIST","资源田配比");
define("TRIBE","种族");
define("ALLIANCE","联盟");
define("POP","人口");
define("REPORT","报告");
define("OPTION","选项");
define("CENTREMAP","以此为中心显示地图");
define("FNEWVILLAGE","建立新村庄");
define("CULTUREPOINT","文化点数");
define("BUILDRALLY","建造集结点");
define("SETTLERSAVAIL","可用拓荒者");
define("BEGINPRO","新手保护");
define("SENDMERC","派出商人");
define("BAN","玩家已被封禁");
define("BUILDMARKET","建造市场");
define("PERHOUR","每小时");
define("BONUS","激励");
define("MAP","地图");
define("CROPFINDER","找田工具");
define("NORTH","北");
define("EAST","东");
define("SOUTH","南");
define("WEST","西");

//other
define("VILLAGE","村庄");
define("OASIS","绿洲");
define("NO_OASIS", "你尚未占领绿洲。");
define("NO_VILLAGES", "那里没有村庄。");
define("PLAYER","玩家");

//LOGIN.php
define("COOKIES","你必须启用Cookies才能登录。如果你与他人共用此电脑，请在游玩后登出。");
define("NAME","名称");
define("PW_FORGOTTEN","忘记密码?");
define("PW_REQUEST","你可以申请更换新密码，相关信息将发送到你的邮箱。");
define("PW_GENERATE","生成新密码。");
define("EMAIL_NOT_VERIFIED","邮箱地址尚未验证!");
define("EMAIL_FOLLOW","通过此链接激活你的账户。");
define("VERIFY_EMAIL","验证邮箱。");
define("SERVER_STARTS_IN","服务器将启动于: ");
define("START_NOW","现在启动");


//404.php
define("NOTHING_HERE","这儿什么也没有!");
define("WE_LOOKED","我们找了 404 次，但什么都没有发现");

//MASSMESSAGE.php
define("MASS","消息内容");
define("MASS_SUBJECT","主题:");
define("MASS_COLOR","消息颜色:");
define("MASS_REQUIRED","所有空白栏都需要内容");
define("MASS_UNITS","图像 (units):");
define("MASS_SHOWHIDE","显示/隐藏");
define("MASS_READ","注意: Read this: after adding smilie, you have to add left or right after number otherwise image will won't work");
define("MASS_CONFIRM","确认");
define("MASS_REALLY","你确定要发送全体 IGM 吗?");
define("MASS_ABORT","现在中止");
define("MASS_SENT","全体 IGM 已送出");

//BUILDINGS
define("WOODCUTTER","伐木场");
define("CLAYPIT","黏土坑");
define("IRONMINE","铁矿场");
define("CROPLAND","农田");

define("SAWMILL","锯木厂");
define("SAWMILL_DESC","木材被送到这里进一步处理。根据锯木厂的等级，木材产量可以提升至多 25% 。");
define("CURRENT_WOOD_BONUS","当前木材产量加成:");
define("WOOD_BONUS_LEVEL","木材产量加成于等级");
define("MAX_LEVEL","建筑已经到达最高等级");
define("PERCENT","%");

define("BRICKYARD","砖块厂");
define("CURRENT_CLAY_BONUS","当前黏土产量加成:");
define("CLAY_BONUS_LEVEL","黏土产量加成于等级");
define("BRICKYARD_DESC","黏土被送到这里进一步处理。根据砖块厂的等级，黏土产量可以提升至多 25% 。");

define("IRONFOUNDRY","铸铁厂");
define("CURRENT_IRON_BONUS","当前铁矿产量加成:");
define("IRON_BONUS_LEVEL","铁矿产量加成于等级");
define("IRONFOUNDRY_DESC","铁矿被送到这里进一步处理。根据铸铁厂的等级，铁矿产量可以提升至多 25% 。");

define("GRAINMILL","磨坊");
define("CURRENT_CROP_BONUS","当前粮食产量加成:");
define("CROP_BONUS_LEVEL","粮食产量加成于等级");
define("GRAINMILL_DESC","粮食被送到这里进一步加工成面粉。根据磨坊的等级，粮食产量可以提升至多 25% 。");

define("BAKERY","面包房");
define("BAKERY_DESC","面粉可以进一步烘烤成面包。在磨坊的基础之上，将粮食产量提升至多 50% 。");

define("WAREHOUSE","仓库");
define("CURRENT_CAPACITY","当前容量:");
define("CAPACITY_LEVEL","容量在等级");
define("RESOURCE_UNITS","资源单位");
define("WAREHOUSE_DESC","木材、黏土和铁矿存储在仓库中。仓库的等级越高，存储容量越高。");

define("GRANARY","粮仓");
define("CROP_UNITS","粮食单位");
define("GRANARY_DESC","粮食存储在粮仓中。粮仓的等级越高，存储容量越高。");

define("BLACKSMITH","铁匠铺");
define("ACTION","选项");
define("UPGRADE","升级");
define("UPGRADE_IN_PROGRESS","升级在<br>进行中");
define("UPGRADE_BLACKSMITH","升级<br>铁匠铺");
define("UPGRADES_COMMENCE_BLACKSMITH","铁匠铺建造完成后才能开始升级。");
define("MAXIMUM_LEVEL","最高<br>等级");
define("EXPAND_WAREHOUSE","扩建<br>仓库");
define("EXPAND_GRANARY","扩建<br>粮仓");
define("ENOUGH_RESOURCES","足够的资源");
define("CROP_NEGATIVE ","你的粮食产量为负，因此不可能抵达需求的粮食数目");
define("TOO_FEW_RESOURCES","缺少<br>资源");
define("UPGRADING","升级中");
define("DURATION","时长");
define("COMPLETE","完成");
define("BLACKSMITH_DESC","在铁匠铺的熔炉中，士兵们的武器得到强化。铁匠铺等级越高，士兵的攻击力将能得到更高的强化。");

define("ARMOURY","盔甲厂");
define("UPGRADE_ARMOURY","升级<br>盔甲厂");
define("UPGRADES_COMMENCE_ARMOURY","盔甲厂建造完成后才能开始升级。");
define("ARMOURY_DESC","盔甲厂的工匠能生产更好的防具。盔甲厂等级越高，士兵的防御力将能得到更高的强化。");

define("TOURNAMENTSQUARE","竞技场");
define("CURRENT_SPEED","当前行军速度加成:");
define("SPEED_LEVEL","行军速度加成在等级");
define("TOURNAMENTSQUARE_DESC","在竞技场，你的部队日复一日地训练，他们的耐力得到了提升。竞技场等级越高，士兵进行 ".TS_THRESHOLD." 格以上的行军将更快。");

define("MAINBUILDING","村庄大楼");
define("CURRENT_CONSTRUCTION_TIME","当前建造速度:");
define("CONSTRUCTION_TIME_LEVEL","建造速度在等级");
define("DEMOLITION_BUILDING","拆除建筑:</h2><p>如果你不再需要某个建筑，你可以在这里下令拆除。</p>");
define("DEMOLISH","拆除");
define("DEMOLITION_OF","拆除");
define("MAINBUILDING_DESC","村庄大楼是建筑大师的住所。村庄大楼等级越高，建筑的建造速度就越快。");

define("RALLYPOINT","集结点");
define("RALLYPOINT_COMMENCE","当 ".RALLYPOINT." 建造完毕时，将显示部队动向");
define("OVERVIEW","概览");
define("REINFORCEMENT","增援");
define("EVASION_SETTINGS","侵略设定");
define("SEND_TROOPS_AWAY_MAX","Send troops away a maximum of");
define("TIMES","times");
define("PER_EVASION","per evasion");
define("RALLYPOINT_DESC","村庄的部队在这里集合。你可以在这里派遣部队去征服、掠夺、侦查或增援其他地方。");

define("MARKETPLACE","市场");
define("MERCHANT","商人");
define("OR_","或");
define("GO","出发");
define("UNITS_OF_RESOURCE","单位资源");
define("MERCHANT_CARRY","每个商人可以携带");
define("MERCHANT_COMING","到来的商人");
define("TRANSPORT_FROM","运送来自");
define("ARRIVAL_IN","抵达剩余时间");
define("NO_COORDINATES_SELECTED","未输入坐标");
define("CANNOT_SEND_RESOURCES","你不能向本村运送资源");
define("BANNED_CANNOT_SEND_RESOURCES","玩家已被封禁，你不能向其运送资源。");
define("RESOURCES_NO_SELECTED","未输入资源");
define("ENTER_COORDINATES","输入坐标或村庄名称");
define("TOO_FEW_MERCHANTS","商人不足");
define("OWN_MERCHANTS_ONWAY","己方商人在途中");
define("MERCHANTS_RETURNING","商人返回中");
define("TRANSPORT_TO","运输至");
define("I_AN_SEARCHING","我寻求");
define("I_AN_OFFERING","我提供");
define("OFFERS_MARKETPLACE","市场中的报价");
define("NO_AVAILABLE_OFFERS","市场中没有报价");
define("OFFERED_TO_ME","提供<br>给我");
define("WANTED_TO_ME","我<br>提供");
define("NOT_ENOUGH_MERCHANTS","商人不足");
define("ACCEP_OFFER","接受报价");
define("NO_AVALIBLE_OFFERS","市场上没有可用的报价");
define("SEARCHING","搜索中");
define("OFFERING","发出报价");
define("MAX_TIME_TRANSPORT","运输次数达上限");
define("OWN_ALLIANCE_ONLY","仅限联盟");
define("INVALID_OFFER","报价不再可用");
define("INVALID_MERCHANTS_REPETITION","不可用的商人重复次数");
define("USER_ON_VACATION","用户正在度假");
define("NOT_ENOUGH_RESOURCES","资源不足");
define("OFFER","报价");
define("SEARCH","搜索");
define("OWN_OFFERS","我的报价");
define("ALL","所有");
define("NPC_TRADE","资源置换");
define("SUM","总计");
define("REST","余下");
define("TRADE_RESOURCES","交易资源 (第二步");
define("DISTRIBUTE_RESOURCES","分配资源 (第一步)");
define("OF","of");
define("NPC_COMPLETED","资源置换完成");
define("BACK_BUILDING","返回建筑");
define("YOU_CAN_NAT_NPC_WW","在世界奇观村庄中不能进行资源置换。");
define("NPC_TRADING","资源置换");
define("SEND_RESOURCES","运送资源");
define("BUY","购买");
define("TRADE_ROUTES","贸易路线");
define("DESCRIPTION","描述");
define("TIME_LEFT","剩余时间");
define("START","开始");
define("NO_TRADE_ROUTES","没有活跃的贸易路线");
define("TRADE_ROUTE_TO","贸易路线至");
define("CHECKED","checked");
define("DAYS","Days");
define("EXTEND","Extend");
define("EDIT","Edit");
define("EXTEND_TRADE_ROUTES","Extend the trade route by <b>7</b> days for");
define("CREATE_TRADE_ROUTES","Create new trade route");
define("DELIVERIES","Deliveries");
define("START_TIME_TRADE","Start time");
define("CREATE_TRADE_ROUTE","Create trade route");
define("TARGET_VILLAGE","Target village");
define("EDIT_TRADE_ROUTES","Edit trade route");
define("TRADE_ROUTES_DESC","Trade route allows you to set up routes for your merchant that he will walk every day at a certain hour. <br /><br /> Standard this holds on for <b>7</b> days, but you can extend it with <b>7</b> days for the cost of");
define("NPC_TRADE_DESC","With the NPC merchant you can distribute the resources in your warehouse as you desire. <br /><br /> The first line shows the current stock. In the second line you can choose another distribution. The third line shows the difference between the old and new stock.");
define("MARKETPLACE_DESC","At the Marketplace you can trade resources with other players. The higher its level, the more resources can be transported at the same time.");

define("EMBASSY","大使馆");
define("TAG","标签");
define("TO_THE_ALLIANCE","前往联盟");
define("JOIN_ALLIANCE","加入联盟");
define("REFUSE","拒绝");
define("ACCEPT","接受");
define("NO_INVITATIONS","没有有效的邀请。");
define("NO_CREATE_ALLIANCE","被封禁的玩家不能创建联盟。");
define("FOUND_ALLIANCE","创建联盟");
define("EMBASSY_DESC","大使馆是进行外交活动的场所。 The higher its level the more options the king gains.");

define("BARRACKS","兵营");
define("QUANTITY","数量");
define("MAX","最大");
define("TRAINING","训练中");
define("FINISHED","完成");
define("UNIT_FINISHED","距离下一个单位训练完成");
define("AVAILABLE","可用");
define("TRAINING_COMMENCE_BARRACKS","兵营建造完成后才能开始训练。");
define("BARRACKS_DESC","所有的步兵都在兵营中训练产生。兵营的等级越高，训练步兵的速度越快。");

define("STABLE","马厩");
define("AVAILABLE_ACADEMY","没有可训练单位。请先在学院研究。");
define("TRAINING_COMMENCE_STABLE","马厩建造完成后才能开始训练。");
define("STABLE_DESC","骑兵在马厩中训练。马厩的等级越高，训练骑兵的速度越快。");

define("WORKSHOP","攻城武器厂");
define("TRAINING_COMMENCE_WORKSHOP","攻城武器厂建造完成后才能开始生产攻城武器。");
define("WORKSHOP_DESC","诸如攻城锤、投石车等的攻城武器在攻城武器厂中生产。攻城武器厂等级越高，攻城武器的生产速度越快。");

define("ACADEMY","学院");
define("RESEARCH_AVAILABLE","当前没有可研究的项目。");
define("RESEARCH_COMMENCE_ACADEMY","当学院建造完成后才能开始研究。");
define("RESEARCH","研究");
define("EXPAND_WAREHOUSE1","扩建仓库");
define("EXPAND_GRANARY1","扩建粮仓");
define("RESEARCH_IN_PROGRESS","研究<br>进行中");
define("RESEARCHING","研究中");
define("PREREQUISITES","先决条件");
define("SHOW_MORE","显示更多");
define("HIDE_MORE","隐藏更多");
define("ACADEMY_DESC","学院里可以研究新的兵种。更好的兵种通常需要更高等级的学院来解锁。");

define("CRANNY","山洞");
define("CURRENT_HIDDEN_UNITS","目前可以保护的各类资源:");
define("HIDDEN_UNITS_LEVEL","保护的资源数量在等级");
define("UNITS","单位");
define("CRANNY_DESC","在村庄被攻击时，山洞隐藏的资源可以不被掠夺。");

define("TOWNHALL","市政厅");
define("CELEBRATIONS_COMMENCE_TOWNHALL","市政厅建造完成后才可以开始举办庆典。");
define("GREAT_CELEBRATIONS","大型庆典");
define("CULTURE_POINTS","文化点数");
define("HOLD","举办");
define("CELEBRATIONS_IN_PROGRESS","庆典<br />正在进行中");
define("CELEBRATIONS","庆典");
define("TOWNHALL_DESC","你可以在市政厅举办盛大的庆典，获得大量文明点数。市政厅等级越高，举办庆典的时间越短。");

define("RESIDENCE","行宫");
define("CAPITAL","这里是你的首都");
define("RESIDENCE_TRAIN_DESC","你需要10级或20级行宫和三个拓荒者来开辟新村庄。你需要10级或20级行宫和一个参议员、司令官或族长来征服其他村庄。");
define("PRODUCTION_POINTS","本村的生成速度:");
define("PRODUCTION_ALL_POINTS","所有村庄的生成速度:");
define("POINTS_DAY","文化点数每天");
define("VILLAGES_PRODUCED","你的村庄共计已经生成了");
define("POINTS_NEED","文化点数。为了开辟或征服新村庄，你需要");
define("POINTS","文化点数");
define("INHABITANTS","村民");
define("COORDINATES","坐标");
define("EXPANSION","扩张");
define("TRAIN","训练");
define("DATE","日期");
define("CONQUERED_BY_VILLAGE","由本村开辟或征服的村庄");
define("NONE_CONQUERED_BY_VILLAGE","本村还没有建立或开辟村庄。");
define("RESIDENCE_CULTURE_DESC","你需要文化点数来扩张你的帝国。文化点数随时间生成，你的建筑物越多、等级越高，生成文化点数的速度就越快。");
define("RESIDENCE_LOYALTY_DESC","在强攻时，部队中若有参议员、司令官或族长，被攻击的村庄忠诚度就会降低。如果忠诚度降为 0 ，村庄就会加入攻击者的国家。本村当前忠诚度为 ");
define("RESIDENCE_DESC","行宫是一座小型宫殿，供国王或王后在访问村庄时居住。行宫可以防止敌人征服村庄。");

define("PALACE","皇宫");
define("PALACE_CONSTRUCTION","皇宫已在建造中");
define("PALACE_TRAIN_DESC","你需要10级、15级或20级皇宫和三个拓荒者来开辟新村庄。你需要10级、15级或20级皇宫和一个参议员、司令官或族长来征服其他村庄。");
define("CHANGE_CAPITAL","迁都");
define("SECURITY_CHANGE_CAPITAL","你确定要迁都吗?<br /><b>该操作不可撤销!</b><br />为了安全起见，你必须输入密码来确认:<br />");
define("PALACE_DESC","帝国的国王或皇后居住在这座宫殿中。你的王国只能有一座皇宫。你需要皇宫来指定首都的所在。");

define("TREASURY","宝物库");
define("TREASURY_COMMENCE","宝物库建造完成后可以查看宝物。");
define("ARTIFACTS_AREA","你附近的宝物");
define("NO_ARTIFACTS_AREA","你附近没有宝物。");
define("OWN_ARTIFACTS","你的宝物");
define("CONQUERED","已征服");
define("DISTANCE","距离");
define("EFFECT","效果");
define("ACCOUNT","账号");
define("SMALL_ARTIFACTS","小型宝物");
define("LARGE_ARTIFACTS","大型宝物");
define("NO_ARTIFACTS","没有宝物。");
define("ANY_ARTIFACTS","你没有任何宝物。");
define("OWNER","所有者");
define("AREA_EFFECT","作用范围");
define("VILLAGE_EFFECT","村庄效果");
define("ACCOUNT_EFFECT","账号效果");
define("UNIQUE_EFFECT","独特效果");
define("REQUIRED_LEVEL","等级要求");
define("TIME_CONQUER","征服时间");
define("TIME_ACTIVATION","激活时间");
define("NEXT_EFFECT"," 下一个效果");
define("FORMER_OWNER","曾经的所有者");
define("BUILDING_STRONGER","Building stronger with");
define("BUILDING_WEAKER","Building weaker with");
define("TROOPS_FASTER","Makes troops faster with");
define("TROOPS_SLOWEST","Makes troops slowest with");
define("SPIES_INCREASE","Spies increase ability with");
define("SPIES_DECRESE","Spies decrese ability with");
define("CONSUME_LESS","All troops consume less with");
define("CONSUME_HIGH","All troops consume high with");
define("TROOPS_MAKE_FASTER","Troops make faster with");
define("TROOPS_MAKE_SLOWEST","Troops make slowest with");
define("YOU_CONSTRUCT","You can construct ");
define("CRANNY_INCREASED","Cranny capacity is increased by");
define("CRANNY_DECRESE","Cranny capacity is decrese by");
define("WW_BUILDING_PLAN","You can build the Wonder of the World");
define("NO_WW","There are no Wonders of the World");
define("NO_PREVIOUS_OWNERS","There are no previous owners.");
define("TREASURY_DESC","帝国最珍贵的财富保存在宝物库中。宝物库只能存下一件宝物。获得宝物后需要存放一段时间才开始生效。After you have captured an artefact it takes 24 hours on a normal server or 12 hours on a thrice speed server to be effective.");

define("TRADEOFFICE","交易所");
define("CURRENT_MERCHANT","当前商人运载量:");
define("MERCHANT_LEVEL","商人运载量在等级");
define("TRADEOFFICE_DESC","商人在交易所可以获得更大的马车和更好的马。交易所等级越高，你的商人可以运送的资源越多。");

define("GREATBARRACKS","大兵营");
define("TRAINING_COMMENCE_GREATBARRACKS","大兵营建造完成后才能开始训练。");
define("GREATBARRACKS_DESC","Foot soldiers are trained in the great barracks. The higher the level of the barracks, the faster the troops are trained.");

define("GREATSTABLE","大马厩");
define("TRAINING_COMMENCE_GREATSTABLE","大马厩建造完成后才能开始训练。");
define("GREATSTABLE_DESC","Cavalry can be trained in the great stable. The higher its level the faster the troops are trained.");

define("CITYWALL","城墙");
define("DEFENCE_NOW","当前防御加成:");
define("DEFENCE_LEVEL","防御加成在等级");
define("CITYWALL_DESC","建造城墙可以保护你的村庄，你的士兵可以依托城墙更好地抵御外敌。城墙等级越高，防御加成越高。");

define("EARTHWALL","土墙");
define("EARTHWALL_DESC","建造土墙可以保护你的村庄，因为你的士兵可以依托土墙更好地抵御外敌。土墙等级越高，防御加成越高。");

define("PALISADE","木栅栏");
define("PALISADE_DESC","建造木栅栏可以保护你的村庄，因为你的士兵可以依托木栅栏更好地抵御外敌。木栅栏等级越高，防御加成越高。");

define("STONEMASON","石匠小屋");
define("CURRENT_STABILITY","当前耐久度加成:");
define("STABILITY_LEVEL","耐久度加成在等级");
define("STONEMASON_DESC","石匠是强化建筑的大师。石匠小屋等级越高，村庄建筑的耐久度越高。");

define("BREWERY","酿酒厂");
define("CURRENT_BONUS","当前加成:");
define("BONUS_LEVEL","加成在等级");
define("BREWERY_DESC","美味的蜂蜜酒……咕嘟咕嘟咕嘟……");

define("TRAPPER","陷阱机");
define("CURRENT_TRAPS","当前最大陷阱容量:");
define("TRAPS_LEVEL","最大陷阱容量在");
define("TRAPS","陷阱");
define("TRAP","陷阱");
define("CURRENT_HAVE","你目前拥有");
define("WHICH_OCCUPIED","被俘获");
define("TRAINING_COMMENCE_TRAPPER","陷阱机建造完成后才能制作陷阱。");
define("TRAPPER_DESC","陷阱机通过隐藏的陷阱来保护你的村庄。被陷阱捕获的敌人将无力攻击你的村庄。");

define("HEROSMANSION","英雄园");
define("HERO_READY","距离英雄就绪 ");
define("NAME_CHANGED","英雄名称已更改");
define("NOT_UNITS","不可用的单位");
define("NOT","不 ");
define("TRAIN_HERO","训练新的英雄");
define("REVIVE","重生");
define("OASES","绿洲");
define("DELETE","删除");
define("RESOURCES","资源");
define("OFFENCE","个体攻击力");
define("DEFENCE","个体防御力");
define("OFF_BONUS","全军攻击加成");
define("DEF_BONUS","全军防御加成");
define("REGENERATION","恢复速度");
define("DAY","天");
define("EXPERIENCE","经验值");
define("YOU_CAN","你可以 ");
define("RESET","重置");
define("YOUR_POINT_UNTIL"," 你的点数，直到等级达到 ");
define("OR_LOWER"," !");
define("YOUR_HERO_HAS","你的英雄拥有 ");
define("OF_HIT_POINTS","点生命值");
define("ERROR_NAME_SHORT","错误: 名称太短");
define("HEROSMANSION_DESC"," 在英雄园，你可以训练你的英雄。英雄园等级到达10、15和20时分别可以多攻占一片村庄附近的绿洲。");

define("GREATWAREHOUSE","大仓库");
define("GREATWAREHOUSE_DESC","Wood, clay and iron are stored in the warehouse. The great warehouse offers you more space and keeps your goods drier and safer than the normal one.");

define("GREATGRANARY","大粮仓");
define("GREATGRANARY_DESC","Crop produced by your farms is stored in the granary. The great granary offers you more space and keeps your crops drier and safer than the normal one.");

define("WONDER","世界奇观");
define("WORLD_WONDER","世界奇观");
define("WONDER_DESC","世界奇观是帝国强大和繁荣的丰碑，是赢得游戏的目标。世界奇观每提升一级都需要耗费不计其数的资源。");
define("WORLD_WONDER_CHANGE_NAME","你需要建造一级世界奇观才能更改它的名称");
define("WORLD_WONDER_NAME","世界奇观名称");
define("WORLD_WONDER_NOTCHANGE_NAME","世界奇观10级之后不能再更改名称");
define("WORLD_WONDER_NAME_CHANGED","名称已更改");

define("HORSEDRINKING","饮马槽");
define("HORSEDRINKING_DESC","饮马槽是罗马人加快骑兵训练速度、降低骑兵粮耗的独特技术。");

define("GREATWORKSHOP","大攻城武器厂");
define("TRAINING_COMMENCE_GREATWORKSHOP","Training can commence when great workshop is completed.");
define("GREATWORKSHOP_DESC","Siege engines like catapults and rams can be built in the great workshop. The higher its level the faster the units are produced.");

define("BUILDING_MAX_LEVEL_UNDER","建筑正在升级至最高等级");
define("BUILDING_BEING_DEMOLISHED","建筑正在被拆除");
define("COSTS_UPGRADING_LEVEL","消耗下列资源</b> 以升至等级");
define("WORKERS_ALREADY_WORK","工人已经在工作中。");
define("CONSTRUCTING_MASTER_BUILDER","令建筑大师等待建造 ");
define("COSTS","消耗");
define("GOLD","金币");
define("WORKERS_ALREADY_WORK_WAITING","工人已经在工作中。 (加入建造队列)");
define("ENOUGH_FOOD_EXPAND_CROPLAND","粮食产量不足，请先扩建农田。");
define("UPGRADE_WAREHOUSE","升级仓库");
define("UPGRADE_GRANARY","升级粮仓");
define("YOUR_CROP_NEGATIVE","你的粮食产量为负，你不可能达到所需的资源。");
define("UPGRADE_LEVEL","升至等级 ");
define("WAITING","(等待队列)");
define("NEED_WWCONSTRUCTION_PLAN","需要世界奇观蓝图");
define("NEED_MORE_WWCONSTRUCTION_PLAN","需要更多世界奇观蓝图");
define("CONSTRUCT_NEW_BUILDING","建造新建筑");
define("SHOWSOON_AVAILABLE_BUILDINGS","显示即将可用的建筑");
define("HIDESOON_AVAILABLE_BUILDINGS","隐藏即将可用的建筑");

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
define("WWVILLAGE","WW village");
define("ARTEFACT","<h1><b>Natars Artifacts</b></h1>

Whispering rumors echo through the villages, sharing legends told only by the best storytellers. It refers to NATARS, the most feared warrior of the TRAVIAN world. Their killing is the dream of any hero, the purpose of any fighter. No one knows how NATARS got to get such power, and their warriors so cruel. Determined to discover the source of the NATARS power, the fighters send a group of elite spies to spy them. I do not go through many hours and come back with fear in their eyes and balancing fantastic theories: it seems that the natural power comes from the mysterious objects they call artifacts that they stole from our ancestors. Try to steal the artefacts of her, and you can control their power.

<img src=\"img/x.gif\" class=\"ArtifactsAnnouncement\">

The time has come for claiming artifacts. Collaborate with your alliance and bring your worriors to get these wanted objects. However, NATARS will not give up without war to the artefacts ... nor your enemies. If you are successful in retrieving artifacts and you will be able to reject enemies, you will be able to collect the rewards. Your buildings will become incredibly strong and mightest, and the troops will be much faster and will consume less food. Capture the artifacts, bring glory over your empire and become new legends for your followers.

To steal one, the following things must happen:

1. You must attack the village (NO Raid!)
2. WIN the Attack
3. Destroy the treasury
4. An empty treasury level 10 for SMALL ARTIFACTS and level 20 for LARGE ARTIFACT must be in the village where that attack came from
5. Have a hero in an attack

If not, the next attack on that village, winning with a hero and empty treasury will take the artifact.

To build a WW, you must own a plan yourself (you = the WW village owner) from lvl 0 to 50, from 51 to 100 you need an additional plan in your alliance! Two plans in the WW village account would not work!

The construction plans are conquerable immediately when they appear to the server. 

There will be a countdown in game, showing the exact time of the release, 5 days prior to the launch. ");

//WW Village Release Message
define("WWVILLAGEMSG","<h1><b>Wonder of the World Villages</b></h1>

Countless days have passed since the first battles upon the walls of the cursed villages of the Dread Natars, many armies of both the free ones and the Natarian empire struggled and died before the walls of the many strongholds from which the Natars had once ruled all creation. Now with the dust settled and a relative calm having settled in, armies began to count their losses and collect their dead, the stench of combat still lingering in the night air, a smell of a slaughter unforgettable in its extent and brutality yet soon to be dwarfed by yet others. The largest armies of the free ones and the Dread Natars were marshalling for yet another renewed assault upon the coveted former strongholds of the Natarian Empire.
Soon scouts arrived telling of a most awesome sight and a chilling reminder, a dread army of an unfathomable size had been spotted marshalling at the end of the world, the Natarian capital, a force so great and unstoppable that the dust from their march would choke off all light, a force so brutal and ruthless that it would crush all hope. The free people knew that they had to race now, race against time and the endless hordes of the Natarian Empire to raise a Wonder of the World to restore the world to peace and vanquish the Natarian threat.
But to raise such a great Wonder would be no easy task, one would need construction plans created in the distant past, plans of such an arcane nature that even the very wisest of sages knew not their contents or locations.
Tens of thousands of scouts roamed across all existence searching in vain for these mystical plans, looking in all places but the dreaded Natarian Capital, yet could not find them. Today however, they return bearing good news, they return baring the locations of the plans, hidden by the armies of the Natars inside secret strongholds constructed to be hidden from the eyes of man.
Now begins the final stretch, when the greatest armies of the Free people and the Natars will clash across the world for the fate of all that lies under heaven. This is the war that will echo across the eons, this is your war, and here you shall etch your name across history, here you shall become legend.

<img src=\"img/x.gif\" class=\"WWVillagesAnnouncement\" title=\"".WWVILLAGE."\" alt=\"".WWVILLAGE."\">

To conquer one, the following things must happen:

1. You must attack the village (NO Raid!)
2. WIN the Attack
3. Destroy the RESIDENCE
4. You must decrease the loyalty to 0 with : SENATORS , CHIEF , CHIEFTAIN
5. You must have enough culture points to conquer the village

If not, the next attack on that village, winning with a SENATORS , CHIEF , CHIEFTAIN and empty slots in RESIDENCE/PALACE will take the village.

To build a WW, you must own a plan yourself (you = the WW village owner) from lvl 0 to 50, from 51 to 100 you need an additional plan in your alliance! Two plans in the WW village account would not work!

The construction plans are conquerable immediately when they appear to the server. 

There will be a countdown in game, showing the exact time of the release, ".(5 / SPEED)." days prior to the launch. ");

//Building Plans
define("PLAN","Ancient Construction Plan");
define("PLANVILLAGE","WW Buildingplan");
define("PLAN_DESC","With this ancient construction plan you will able to build World Wonder to level 50. to build further, your alliance must hold at least two plans.");
define("PLAN_INFO","<h1><b>World Wonder Construction Plans</b></h1>


Many moons ago the tribes of Travian were surprised by the unforeseen return of the Natars. This tribe from immemorial times surpassing all in wisdom, might and glory was about to trouble the free ones again. Thus they put all their efforts in preparing a last war against the Natars and vanquishing them forever. Many thought about the so-called 'Wonders of the World', a construction of many legends, as the only solution. It was told that it would render anyone invincible once completed. Ultimately making the constructors the rulers and conquerors of all known Travian. 

However, it was also told that one would need construction plans to construct such a building. Due to this fact, the architects devised cunning plans about how to store these safely. After a while, one could see temple-like buildings in many a city and metropolis - the Treasure Chambers (Treasuries). 

Sadly, no one - not even the wise and well versed - knew where to find these construction plans. The harder people tried to locate them, the more it seemed as if they where only legends. 

Today, however, this last secret will be revealed. Deprivations and endeavors of the past will not have been in vain, as today scouts of several tribes have successfully obtained the whereabouts of the construction plans. Well guarded by the Natars, they lie hidden in several oases to be found all over Travian. Only the most valiant heroes will be able to secure such a plan and bring it home safely so that the construction can begin. 

In the end, we will see whether the free tribes of Travian can once again outwit the Natars and vanquish them once and for all. Do not be so foolish as to assume that the Natars will leave without a fight, though!

<img src=\"img/x.gif\" class=\"WWBuildingPlansAnnouncement\" title=\"".PLAN."\" alt=\"".PLAN."\">

To steal a set of Construction Plans from the Natars, the following things must happen:
- You must Attack the village (NOT Raid!)
- You must WIN the Attack
- You must DESTROY the Treasure Chamber (Treasury)
- Your Hero MUST be in that attack, as he is the only one who may carry the Construction Plans
- An empty level 10 Treasure Chamber (Treasury) MUST be in the village where that attack came from
NOTE: If the above criteria is not met during the attack, the next attack on that village which does meet the above criteria will take the Construction Plans.



To build a Treasure Chamber (Treasury), you will need a Main Building level 10 and the village MUST NOT be  contain a World Wonder.

To build a World Wonder, you must own the Construction Plans yourself (you = the World Wonder Village Owner) from level 0 to 50, and then from level 51 to 100 you will need an additional set of Construction Plans in your Alliance! Two sets of Construction Plans in the World Wonder Village Account will not work!");

//Admin setting - Admin/Templates/config.tpl & editServerSet.tpl
define("EDIT_BACK","返回");
define("SERV_CONFIG","服务器配置");
define("SERV_SETT","服务器设置");
define("EDIT_SERV_SETT","编辑服务器设置");
define("SERV_VARIABLE","变量");
define("SERV_VALUE","值");
define("CONF_SERV_NAME","Server Name");
define("CONF_SERV_NAME_TOOLTIP","Name of the game server.");
define("CONF_SERV_STARTED","Server Started");
define("CONF_SERV_STARTED_TOOLTIP","Time when the game server was started. This parameter can not be changed on the installed game server.");
define("CONF_SERV_TIMEZONE","Server Timezone");
define("CONF_SERV_TIMEZONE_TOOLTIP","Timezone of the game server.");
define("CONF_SERV_LANG","Language");
define("CONF_SERV_LANG_TOOLTIP","The language that is used in the admin panel and for everyone on the game server by default.");
define("CONF_SERV_SERVSPEED","Server Speed");
define("CONF_SERV_SERVSPEED_TOOLTIP","The speed of the game server. The higher the speed of the game server, the faster all buildings are built, the studies and improvements in the smithies are carried out, the troops are quickly built and the productivity of all resources is increased.");
define("CONF_SERV_TROOPSPEED","Troop Speed");
define("CONF_SERV_TROOPSPEED_TOOLTIP","Speed of movement of troops on the game server. The higher this indicator, the faster the troops move across the map.");
define("CONF_SERV_EVASIONSPEED","Evasion Speed");
define("CONF_SERV_EVASIONSPEED_TOOLTIP","The evasion speed is the time that troops spend on the road to return home after evasion an attack.");
define("CONF_SERV_STORMULTIPLER","Storage Multipler");
define("CONF_SERV_STORMULTIPLER_TOOLTIP","A multiplier for the storage capacity warehouse and granary. The value 1 is equal to the capacity of 80,000 of each resource at the maximum level. If you set the value to 2, then the capacity at the maximum level will be 160,000 of each resource.<br><b>Note:</b> the amount of resources that will be generated by unoccupied oases for robbery depends on this value. The default is 800. If you set the value to 2, the maximum number for each resource being generated is 1600.");
define("CONF_SERV_TRADCAPACITY","Trader Capacity");
define("CONF_SERV_TRADCAPACITY_TOOLTIP","A multiplier for the capacity of resources that can be carried by one trader. The value of 1 equals 500 capacity for the Romans, 750 for the Gauls, 1000 for the Teutons. If you set the value to 2, then the capacity of the transferred resources will double accordingly, 1000, 1500, 2000.");
define("CONF_SERV_CRANCAPACITY","Cranny Capacity");
define("CONF_SERV_CRANCAPACITY_TOOLTIP","A multiplier for the capacity of resources in Cranny, which can be saved from robbery. The value of 1 is equal to 1000 for Romans and Teutons, 2000 for Gauls. If you set the value to 2, then the capacity of the Cranny will double to 2000 and 4000 respectively.");
define("CONF_SERV_TRAPCAPACITY","Trapper Capacity");
define("CONF_SERV_TRAPCAPACITY_TOOLTIP","A multiplier for the capacity of the trap of the Gauls, which can capture enemy soldiers even before attacking the village. The value of 1 is equal to the capacity of 400 at the 20 level of construction. If you set the value to 2, then the capacity will be 800.");
define("CONF_SERV_NATUNITSMULTIPLIER","Natars Units Multiplier");
define("CONF_SERV_NATUNITSMULTIPLIER_TOOLTIP","This parameter is responsible for the number of troops of Natars, on artifacts and WW villages.");
define("CONF_SERV_NATARS_SPAWN_TIME","Natars Spawn");
define("CONF_SERV_NATARS_SPAWN_TIME_TOOLTIP","After how long Natars and artifacts will spawn from the start date of the server, in days");
define("CONF_SERV_NATARS_WW_SPAWN_TIME","World Wonders Spawn");
define("CONF_SERV_NATARS_WW_SPAWN_TIME_TOOLTIP","After how long WW villages will spawn from the start date of the server, in days");
define("CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME","WW Building Plan Spawn");
define("CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME_TOOLTIP","After how long WW building plans will spawn from the start date of the server, in days");
define("CONF_SERV_MAPSIZE","Map Size");
define("CONF_SERV_MAPSIZE_TOOLTIP","The size of the map of the game world. Can not be changed on an already installed game server.");
define("CONF_SERV_VILLEXPSPEED","Village Expanding Speed");
define("CONF_SERV_VILLEXPSPEED_TOOLTIP","Speed, which affects the expansion of the empire. With a slow speed more culture points are needed to found new village, with a fast speed the required number of culture points is reduced.");
define("CONF_SERV_BEGINPROTECT","Beginners Protection");
define("CONF_SERV_BEGINPROTECT_TOOLTIP","Protection, which prohibits a certain time to attack the villages of new players.");
define("CONF_SERV_REGOPEN","Register Open");
define("CONF_SERV_REGOPEN_TOOLTIP","Allows to enable (True) or disable (False) the registration of players on the game server.");
define("CONF_SERV_ACTIVMAIL","Activation Mail");
define("CONF_SERV_ACTIVMAIL_TOOLTIP","If enabled (Yes), during registration it will be necessary to confirm email address. If disabled (No) does not require confirmation of e-mail.");
define("CONF_SERV_QUEST","Quest");
define("CONF_SERV_QUEST_TOOLTIP","Enable (Yes) or disable (No) the quest on the game server.");
define("CONF_SERV_QTYPE","Quest Type");
define("CONF_SERV_QTYPE_TOOLTIP","The quest type can be official which is a bit shorter, and extended which is longer.");
define("CONF_SERV_DLR","Demolish - Level required");
define("CONF_SERV_DLR_TOOLTIP","The required level of the main building, on which can carry out the demolition of buildings in the village.");
define("CONF_SERV_WWSTATS","World Wonder - Statistics");
define("CONF_SERV_WWSTATS_TOOLTIP","Enable (True) or disable (False) the display in the statistics of villages with a Wonder of the World.");
define("CONF_SERV_NTRTIME","Nature Troops Regeneration Time");
define("CONF_SERV_NTRTIME_TOOLTIP","Time through which the nature troops will be restored in oases.");
define("CONF_SERV_OASIS_WOOD_PROD_MULT","Oasis Wood Production Multiplier");
define("CONF_SERV_OASIS_WOOD_PROD_MULT_TOOLTIP","The base wood oasis production");
define("CONF_SERV_OASIS_CLAY_PROD_MULT","Oasis Clay Production Multiplier");
define("CONF_SERV_OASIS_CLAY_PROD_MULT_TOOLTIP","The base clay oasis production");
define("CONF_SERV_OASIS_IRON_PROD_MULT","Oasis Iron Production Multiplier");
define("CONF_SERV_OASIS_IRON_PROD_MULT_TOOLTIP","The base iron oasis production");
define("CONF_SERV_OASIS_CROP_PROD_MULT","Oasis Crop Production Multiplier");
define("CONF_SERV_OASIS_CROP_PROD_MULT_TOOLTIP","The base crop oasis production");
define("CONF_SERV_MEDALINTERVAL","Medal Interval");
define("CONF_SERV_MEDALINTERVAL_TOOLTIP","The time interval for issuing medals for the top players and alliances. If this parameter is changed on the installed server, the time interval changes after the subsequent issuance of the medals.");
define("CONF_SERV_TOURNTHRES","Tourn Threshold");
define("CONF_SERV_TOURNTHRES_TOOLTIP","The number of squares on the game map, after which Tournament Square will start working.");
define("CONF_SERV_GWORKSHOP","Great Workshop");
define("CONF_SERV_GWORKSHOP_TOOLTIP","Enable (True) or disable (False) the use of a Great Workshop in the game.");
define("CONF_SERV_NATARSTAT","Show Natars in Statistics");
define("CONF_SERV_NATARSTAT_TOOLTIP","Enable (True) or disable (False) the display of the Natars account in statistics.");
define("CONF_SERV_PEACESYST","Peace system");
define("CONF_SERV_PEACESYST_TOOLTIP","Enable or disable the Peace system. When the peace system is activated, players will be able to attack each other but instead of any actions in the reports there will be a congratulatory inscription. The troops will not die of hunger.");
define("CONF_SERV_GRAPHICPACK","Graphic Pack");
define("CONF_SERV_GRAPHICPACK_TOOLTIP","Enable (Yes) or disable (No) the ability to use the graphics package.");
define("CONF_SERV_ERRORREPORT","Error Reporting");
define("CONF_SERV_ERRORREPORT_TOOLTIP","Enable (Yes) or disable (No) the display of error reports on the game server.");

//Admin setting - Admin/Templates/config.tpl & editPlusSet.tpl
define("PLUS_CONFIGURATION","<b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b> Configuration");
define("PLUS_SETT","<b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b> Settings");
define("EDIT_PLUS_SETT","Edit <b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b> Setting");
define("EDIT_PLUS_SETT1","Edit PLUS Setting");
define("CONF_PLUS_PAYPALEMAIL","<a href='https://www.paypal.com' target='_blank'>PayPal</a> E-Mail Address");
define("CONF_PLUS_PAYPALEMAIL_TOOLTIP","The E-Mail Address specified at registration on PayPal.<br><font color='red'><b>Must be Business or Premier account!</b></font>");
define("CONF_PLUS_CURRENCY","Payment Currency");
define("CONF_PLUS_CURRENCY_TOOLTIP","The currency to be used for payment.");
define("CONF_PLUS_PACKAGEGOLDA","Package \"A\" Amount of Gold");
define("CONF_PLUS_PACKAGEGOLDA_TOOLTIP","The amount of gold issued for the payment of the package \"A\".");
define("CONF_PLUS_PACKAGEPRICEA","Package \"A\" Amount of Price");
define("CONF_PLUS_PACKAGEPRICEA_TOOLTIP","The amount necessary to pay the cost of package \"A\".");
define("CONF_PLUS_PACKAGEGOLDB","Package \"B\" Amount of Gold");
define("CONF_PLUS_PACKAGEGOLDB_TOOLTIP","The amount of gold issued for the payment of the package \"B\".");
define("CONF_PLUS_PACKAGEPRICEB","Package \"B\" Amount of Price");
define("CONF_PLUS_PACKAGEPRICEB_TOOLTIP","The amount necessary to pay the cost of package \"B\".");
define("CONF_PLUS_PACKAGEGOLDC","Package \"C\" Amount of Gold");
define("CONF_PLUS_PACKAGEGOLDC_TOOLTIP","The amount of gold issued for the payment of the package \"C\".");
define("CONF_PLUS_PACKAGEPRICEC","Package \"C\" Amount of Price");
define("CONF_PLUS_PACKAGEPRICEC_TOOLTIP","The amount necessary to pay the cost of package \"C\".");
define("CONF_PLUS_PACKAGEGOLDD","Package \"D\" Amount of Gold");
define("CONF_PLUS_PACKAGEGOLDD_TOOLTIP","The amount of gold issued for the payment of the package \"D\".");
define("CONF_PLUS_PACKAGEPRICED","Package \"D\" Amount of Price");
define("CONF_PLUS_PACKAGEPRICED_TOOLTIP","The amount necessary to pay the cost of package \"D\".");
define("CONF_PLUS_PACKAGEGOLDE","Package \"E\" Amount of Gold");
define("CONF_PLUS_PACKAGEGOLDE_TOOLTIP","The amount of gold issued for the payment of the package \"E\".");
define("CONF_PLUS_PACKAGEPRICEE","Package \"E\" Amount of Price");
define("CONF_PLUS_PACKAGEPRICEE_TOOLTIP","The amount necessary to pay the cost of package \"E\".");
define("CONF_PLUS_ACCDURATION","<b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b> account duration");
define("CONF_PLUS_ACCDURATION_TOOLTIP","The duration of the game function <b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b> for the account at the time of activation by the player.");
define("CONF_PLUS_PRODUCTDURATION","+25% production duration");
define("CONF_PLUS_PRODUCTDURATION_TOOLTIP","The duration of the game function +25% production duration for the account at the time of activation by the player.");

//Admin setting - Admin/Templates/config.tpl & editLogSet.tpl
define("LOG_SETT","Log Settings");
define("EDIT_LOG_SETT","Edit Log Setting");
define("CONF_LOG_BUILD","Log Build");
define("CONF_LOG_BUILD_TOOLTIP","Enable (Yes) or disable (No) the display of logs for the construction of buildings in the village.");
define("CONF_LOG_TECHNOLOGY","Log Technology");
define("CONF_LOG_TECHNOLOGY_TOOLTIP","Enable (Yes) or disable (No) display logs to improve troops in Blacksmith and Armoury.");
define("CONF_LOG_LOGIN","Log Login");
define("CONF_LOG_LOGIN_TOOLTIP","Enable (Yes) or disable (No) the display logs players login the game.");
define("CONF_LOG_GOLD","Log Gold");
define("CONF_LOG_GOLD_TOOLTIP","Enable (Yes) or disable (No) the display of gold use logs in-game by players.");
define("CONF_LOG_ADMIN","Log Admin");
define("CONF_LOG_ADMIN_TOOLTIP","Enable (Yes) or disable (No) the display of logs for administrator actions in the control panel.");
define("CONF_LOG_WAR","Log War");
define("CONF_LOG_WAR_TOOLTIP","Enable (Yes) or disable (No) the display of logs attacks on players in the game.");
define("CONF_LOG_MARKET","Log Market");
define("CONF_LOG_MARKET_TOOLTIP","Enable (Yes) or disable (No) the display of the logs of the use of the market in the game by the players.");
define("CONF_LOG_ILLEGAL","Log Illegal");
define("CONF_LOG_ILLEGAL_TOOLTIP","Enable (Yes) or disable (No) the display of illegal logs. (I do not know exactly what it is)");

//Admin setting - Admin/Templates/config.tpl & editNewsboxSet.tpl
define("NEWSBOX_SETT","Newsbox Settings");
define("EDIT_NEWSBOX_SETT","Edit Newsbox Setting");
define("EDIT_NEWSBOX1","Newsbox 1");
define("EDIT_NEWSBOX1_TOOLTIP","Enable or disable the display of the Newsbox 1. Displayed on the authorization page and on the game pages.");
define("EDIT_NEWSBOX2","Newsbox 2");
define("EDIT_NEWSBOX2_TOOLTIP","Enable or disable the display of the Newsbox 2. Displayed on the authorization page and on the game pages.");
define("EDIT_NEWSBOX3","Newsbox 3");
define("EDIT_NEWSBOX3_TOOLTIP","Enable or disable the display of the Newsbox 3. Displayed on the authorization page and on the game pages.");

//Admin setting - Admin/Templates/config.tpl SQL Settings
define("SQL_SETTINGS","SQL Settings");
define("CONF_SQL_HOSTNAME","Hostname");
define("CONF_SQL_HOSTNAME_TOOLTIP","The name of the server where MySQL is started (by default is: localhost).");
define("CONF_SQL_PORT","Port");
define("CONF_SQL_PORT_TOOLTIP","MySQL port for remote connection. The standard port for connecting is: 3306.");
define("CONF_SQL_DBUSER","DB Username");
define("CONF_SQL_DBUSER_TOOLTIP","The user name to connect to the database.");
define("CONF_SQL_DBPASS","DB Password");
define("CONF_SQL_DBPASS_TOOLTIP","Password from the user to connect to the database.");
define("CONF_SQL_DBNAME","DB Name");
define("CONF_SQL_DBNAME_TOOLTIP","Name of the database to which you are connecting.");
define("CONF_SQL_TBPREFIX","Table Prefix");
define("CONF_SQL_TBPREFIX_TOOLTIP","The prefix used for the database tables.");
define("CONF_SQL_DBTYPE","DB Type");
define("CONF_SQL_DBTYPE_TOOLTIP","The type of database used.");

//Admin setting - Admin/Templates/config.tpl & editExtraSet.tpl
define("EXTRA_SETT","Extra Settings");
define("EDIT_EXTRA_SETT","Edit Extra Settings");
define("CONF_EXTRA_LIMITMAIL","Limit Mailbox");
define("CONF_EXTRA_LIMITMAIL_TOOLTIP","Enable (Yes) or disable (No) the mailbox limit.");
define("CONF_EXTRA_MAXMAIL","Max number of mails");
define("CONF_EXTRA_MAXMAIL_TOOLTIP","The maximum number of messages that can fit in the mailbox.");

//Admin setting - Admin/Templates/config.tpl & editAdminInfo.tpl
define("ADMIN_INFO","Admin Information");
define("EDIT_ADMIN_INFO","Edit Admin Information");
define("CONF_ADMIN_NAME","Admin Name");
define("CONF_ADMIN_NAME_TOOLTIP","Name for the administrator account.");
define("CONF_ADMIN_EMAIL","Admin E-Mail");
define("CONF_ADMIN_EMAIL_TOOLTIP","The email address for the administrator account.");
define("CONF_ADMIN_SHOWSTATS","Include Admin in Stats");
define("CONF_ADMIN_SHOWSTATS_TOOLTIP","Enable (True) or disable (False) the display of the administrator account in the general statistics of players.");
define("CONF_ADMIN_SUPPMESS","Include Support Messages");
define("CONF_ADMIN_SUPPMESS_TOOLTIP","Enable (True) or disable (False) the sending of messages to the mailbox of the administrator addressed to Support.");
define("CONF_ADMIN_RAIDATT","Allow Raided and Attacked");
define("CONF_ADMIN_RAIDATT_TOOLTIP","Enable (True) or disable (False) the ability to Raided and Attacked an administrator.");

/*
|--------------------------------------------------------------------------
|   Index
|--------------------------------------------------------------------------
*/

	   $lang['index'][0][1] = "欢迎来到 " . SERVER_NAME . "";
	   $lang['index'][0][2] = "手册";
	   $lang['index'][0][3] = "现在就能免费游玩!";
	   $lang['index'][0][4] = "什么是 " . SERVER_NAME . "";
	   $lang['index'][0][5] = "Travian曾是风靡全球的网页游戏，此版本是由开源社区开发者贡献的经典T3.6版本TravianZ，详见GitHub。汉化文本由Muchen Fan完成。本服务器仅供测试、交流、学习之用。请不要使用游戏内的充值接口。" . SERVER_NAME . " is a <b>browser game</b> featuring an engaging ancient world with thousands of other real players.</p><p>It`s <strong>free to play</strong> and requires <strong>no downloads</strong>.";
	   $lang['index'][0][6] = "点击此处即刻开始游玩 " . SERVER_NAME . "";
	   $lang['index'][0][7] = "玩家总数";
	   $lang['index'][0][8] = "活跃玩家";
	   $lang['index'][0][9] = "在线玩家";
	   $lang['index'][0][10] = "关于游戏";
	   $lang['index'][0][11] = "你将从一个小村庄的头领开始，谱写英雄的故事。";
	   $lang['index'][0][12] = "建立村庄，发动战争，与邻居建立贸易路线。";
	   $lang['index'][0][13] = "与其他真实玩家或对抗、或合作，征服Travian游戏世界。";
	   $lang['index'][0][14] = "新闻";
	   $lang['index'][0][15] = "FAQ";
	   $lang['index'][0][16] = "截图";
	   $lang['forum'] = "论坛";
	   $lang['register'] = "注册";
	   $lang['login'] = "登录";
	   $lang['screenshots']['title1']="村庄";
	   $lang['screenshots']['desc1']="村庄建筑";
           $lang['screenshots']['title2']="资源";
           $lang['screenshots']['desc2']="村庄资源分为木材、黏土、铁矿和粮食";
           $lang['screenshots']['title3']="地图";
           $lang['screenshots']['desc3']="你的村庄在地图上的位置";
           $lang['screenshots']['title4']="建造建筑";
           $lang['screenshots']['desc4']="建造建筑和提升等级的方式";
           $lang['screenshots']['title5']="报告";
           $lang['screenshots']['desc5']="你的攻击报告";
           $lang['screenshots']['title6']="统计";
           $lang['screenshots']['desc6']="在统计中查看你的排名";
           $lang['screenshots']['title7']="狼或羊";
           $lang['screenshots']['desc7']="你可以选择发展军事或是发展经济、或是两者齐头并进";


?>
