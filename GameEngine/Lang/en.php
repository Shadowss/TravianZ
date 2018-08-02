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
									//         ENGLISH         //
									//      Author: Dzoki      //
									//     Adding: Armando     //
									/////////////////////////////

//MAIN MENU
define("TRIBE1","Romans");
define("TRIBE2","Teutons");
define("TRIBE3","Gauls");
define("TRIBE4","Nature");
define("TRIBE5","Natars");
define("TRIBE6","Monsters");

define("HOME","Homepage");
define("INSTRUCT","Instructions");
define("ADMIN_PANEL","Admin Panel");
define("MASS_MESSAGE","Mass Message");
define("LOGOUT","Logout");
define("PROFILE","Profile");
define("SUPPORT","Support");
define("UPDATE_T_10","Update Top 10");
define("SYSTEM_MESSAGE","System message");
define("TRAVIAN_PLUS","Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></span></span></b>");
define("CONTACT","Contact us!");
define("GAME_RULES","Game Rules");

//MENU
define("REG","Register");
define("FORUM","Forum");
define("CHAT","Chat");
define("IMPRINT","Imprint");
define("MORE_LINKS","More Links");
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
define("SIT_ERROR","Sitter already set or player not found");
define("USR_NT_FOUND","Name does not exist.");
define("LOGIN_PW_ERROR","The password is wrong.");
define("WEL_TOPIC","Useful tips & information ");
define("ATAG_EMPTY","Tag empty");
define("ANAME_EMPTY","Name empty");
define("ATAG_EXIST","Tag taken");
define("ANAME_EXIST","Name taken");
define("ALREADY_ALLY_MEMBER","You're already in an alliance");
define("ALLY_TOO_LOW", "You must have a level 3 or greater embassy");
define("USER_NOT_IN_YOUR_ALLY","This user is not in your alliance!");
define("CANT_EDIT_YOUR_PERMISSIONS","You can't edit your own permissions!");
define("CANT_EDIT_LEADER_PERMISSIONS","Alliance leader's permissions can't be edited!");
define("NO_PERMISSION", "You don't have enough permissions!");
define("NAME_OR_DIPL_EMPTY", "Name or diplomacy empty");
define("ALLY_DOESNT_EXISTS","Alliance does not exist");
define("CANNOT_INVITE_SAME_ALLY","You cannot invite your own alliance");
define("WRONG_DIPLOMACY","Wrong choice made");
define("INVITE_ALREADY_SENT","Either you have already sent a pact to this alliance, they sent it to yours or you already have a pact with them");
define("INVITE_SENT","Invite sent");
define("DECLARED_WAR_ON","declared war to");
define("OFFERED_NON_AGGRESION_PACT_TO","offered non-aggression pact to");
define("OFFERED_CONFED_TO","offered a confederation to");
define("ALLY_TOO_MUCH_PACTS","Either You cannot offer more pacts of this kind or this alliance has reached the limit for this kind of patcs");
define("ALLY_PERMISSIONS_UPDATED","Permissions updated");
define("ALLY_FORUM_LINK_UPDATED", "Forum link updated");
define("NO_FORUMS_YET","There are no forums yet.");
define("ALLY_USER_KICKED"," has been kicked from the alliance");
define("NOT_OPENED_YET","Server not started yet.");
define("REGISTER_CLOSED","The register is closed. You can't register to this server.");
define("NAME_EMPTY","Please insert name");
define("NAME_NO_EXIST","There is no user with the name ");
define("ID_NO_EXIST","There is no user with the id ");
define("SAME_NAME","You can't invite yourself");
define("ALREADY_INVITED"," already invited");
define("ALREADY_IN_ALLY"," is already in this alliance");
define("ALREADY_IN_AN_ALLY"," is already in an alliance");
define("NAME_OR_TAG_CHANGED","Name or Tag changed");
define("VAC_MODE_WRONG_DAYS","You've inserted a wrong number of days");

//COPYRIGHT
define("TRAVIAN_COPYRIGHT","TravianZ 100% Open Source Travian Clone.");

//BUILD.TPL
define("CUR_PROD","Current production");
define("NEXT_PROD","Production at level ");

//BUILDINGS
define("B1","Woodcutter");
define("B1_DESC","The Woodcutter cuts down trees in order to produce lumber. The further you extend the woodcutter the more lumber is produced by him.");
define("B2","Clay Pit");
define("B2_DESC","Clay is produced here. By increasing its level you increase its clay production.");
define("B3","Iron Mine");
define("B3_DESC","Here miners produce the precious resource iron. By increasing the mine`s level you increase its iron production.");
define("B4","Cropland");
define("B4_DESC","Your population`s food is produced here. By increasing the farm`s level you increase its crop production.");

//DORF1
define("LUMBER","Lumber");
define("CLAY","Clay");
define("IRON","Iron");
define("CROP","Crop");
define("LEVEL","Level");
define("CROP_COM",CROP." consumption");
define("PER_HR","per hour");
define("PROD_HEADER","Production");
define("MULTI_V_HEADER","Villages");
define("ANNOUNCEMENT","Announcement");
define("GO2MY_VILLAGE","Go to my village");
define("VILLAGE_CENTER","Village centre");
define("FINISH_GOLD","Finish all construction and research orders in this village immediately for 2 Gold?");
define("WAITING_LOOP","(waiting loop)");
define("CROP_NEGATIVE","Your crop production is negative, you'll neaver reach the amount of requested resources.");
define("HRS","(hrs.)");
define("DONE_AT","done at");
define("CANCEL","cancel");
define("LOYALTY","Loyalty");
define("CALCULATED_IN","Calculated in");
define("SEVER_TIME","Server time:");
define("HI","HI");

//QUEST
define("Q_CONTINUE","Continue with the next task.");
define("Q_REWARD","Your reward:");
define("Q_BUTN","complete task");
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
define("Q11_BUTN","complete task");

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
define("Q33_DESC","To found a new village, you will need settlers. Those you can train in either a palace or a residence.");
define("Q33_ORDER","Order:<\/p>Build a palace or residence to level 10.");
define("Q33_RESP","had reached to level 10, you can now train settlers and found your second village. Notice the cultural points...");

define("Q34","Task 28: 3 settlers.");
define("Q34_DESC","To found a new village, you will need settlers. They can be trained  in either a palace or a residence.");
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

//Quest 25
define("Q25_7","Task 7: Neighbours!");
define("Q25_7_DESC","Around you, there are many different villages. One of them is named. ");
define("Q25_7_DESC1","Click 'Map' in the head menu and look for that village. The name of your neighbours' villages can be seen once you hover your mouse over any of them.");
define("Q25_7_ORDER","<\/p><b>Order:</b><br>Look for the coordinates of ");
define("Q25_7_ORDER1","and enter them here.");
define("Q25_7_RESP","Exactly, there ");
define("Q25_7_RESP1"," Village! As many resources as you reach this village. Well, almost as much ...");

define("Q25_8","Task 8: Huge Army!");
define("Q25_8_DESC","Now I've got a very special Quest for you. I am hungry. Give me 200 crop!<br \/><br \/>In return I will try to organize a huge army to protect your village.");
define("Q25_8_ORDER","Order:<\/p>Send 200 crop to the taskmaster.");
define("Q25_8_BUTN","Send crop");
define("Q25_8_NOCROP","No Enough Crop!");

define("Q25_9","Task 9: One each!");
define("Q25_9_DESC","In " . SERVER_NAME . " there is always something to do! While you are waiting for your new army,<br \/><br \/>extend one additional woodcutter, clay pit, iron mine and cropland to level 1");
define("Q25_9_ORDER","Order:<\/p>Extend one more of each resource tile to level 1.");
define("Q25_9_RESP","Very good, great development of resource production.");

define("Q25_10","Task 10: Comming Soon!");
define("Q25_10_DESC","Now there is time for a small break until the gigantic army I sent you arrives.<br \/><br \/>Until then you can explore the map or extend a few resource tiles.");
define("Q25_10_ORDER","Order:<\/p>Wait for the taskmaster's army to arrive");
define("Q25_10_RESP","Now a huge army from taskmaster has arrive to protect your village");
define("Q25_10_REWARD","Your reward:<\/p>2 days more of Travian");

define("Q25_11","Task 11: Reports");
define("Q25_11_DESC","Every time something important happens to your account you will receive a report.<br \/><br \/>You can see these by clicking on the left half of the 5th button (from left to right). Read the report and come back here.");
define("Q25_11_ORDER","Order:<\/p>Read your latest report.");
define("Q25_11_RESP","You received it? Very good. Here is your reward.");

define("Q25_12","Task 12: Everything to 1.");
define("Q25_12_DESC","Now we should increase your resource production a bit.");
define("Q25_12_ORDER","Order:<\/p>Extend all resource tiles to level 1.");
define("Q25_12_RESP","Very good, your resource production just thrives.<br \/><br \/>Soon we can start with constructing buildings in the village.");

define("Q25_13","Task 13: Dove of Peace");
define("Q25_13_DESC","The first days after signing up you are protected against attacks by your fellow players. You can see how long this protection lasts by adding the code <b>[#0]<\/b> to your profile.");
define("Q25_13_ORDER","Order:<\/p>Write the code <b>[#0]<\/b> into your profile by adding it to one of the two description fields.");
define("Q25_13_RESP","Well done! Now everyone can see what a great warrior the world is approached by.");

define("Q25_14","Task 14: Cranny");
define("Q25_14_DESC","It's getting time to erect a cranny. The world of <b>" . SERVER_NAME. "</b> is dangerous.<br \/><br \/>Many players live by stealing other players' resources. Build a cranny to hide some of your resources from enemies.");
define("Q25_14_ORDER","Order:<\/p>Construct a Cranny.");
define("Q25_14_RESP","Well done, now it's way harder for your mean fellow players to plunder your village.<br \/><br \/>If under attack, your villagers will hide the resources in the Cranny all on their own.");

define("Q25_15","Task 15: To Two.");
define("Q25_15_DESC","In <b>" . SERVER_NAME. "</b> there is always something to do! Extend one woodcutter, one clay pit, one iron mine and one cropland to level 2 each.");
define("Q25_15_ORDER","Order:<\/p>Extend one of each resource tile to level 2.");
define("Q25_15_RESP","Very good, your village grows and thrives!");

define("Q25_16","Task 16: Instructions");
define("Q25_16_DESC","In the ingame instructions you can find short information texts about different buildings and types of units.<br \/><br \/>Click on 'instructions' at the left to find out how much lumber is required for the barracks.");
define("Q25_16_ORDER","Order:<\/p>Enter how much lumber barracks cost");
define("Q25_16_BUTN","complete task");
define("Q25_16_RESP","Exactly! Barracks cost 210 lumber.");

define("Q25_17","Task 17: Main Building");
define("Q25_17_DESC","Your master builders need a main building level 3 to erect important buildings such as the marketplace or barracks.");
define("Q25_17_ORDER","Order:<\/p>Extend your main building to level 3.");
define("Q25_17_RESP","Well done. The main building level 3 has been completed.<br><br>With this upgrade your master builders can construct more types of buildings and also do so faster.");

define("Q25_18","Task 18: Advanced!");
define("Q25_18_DESC","Look up your rank in the player statistics again and enjoy your progress.");
define("Q25_18_ORDER","Order:<\/p>Look for your rank in the statistics and enter it here.");
define("Q25_18_RESP","Well done! That's your current rank.");

define("Q25_19","Task 19: Weapons or Dough");
define("Q25_19_DESC","Now you have to make a decision: Either trade peacefully or become a dreaded warrior.<br \/><br \/>For the marketplace you need a granary, for the barracks you need a rally point.");
define("Q25_19_BUTN","Economy");
define("Q25_19_BUTN1","Military");

define("Q25_20","Task 19: Economy");
define("Q25_20_DESC","Trade & Economy was your choice. Golden times await you for sure!");
define("Q25_20_ORDER","Order:<\/p>Construct a Granary.");
define("Q25_20_RESP","Well done! With the Granary you can store more wheat.");

define("Q25_21","Task 20: Warehouse");
define("Q25_21_DESC","Not only Crop has to be saved. Other resources can go to waste as well if they are not stored correctly. Construct a Warehouse!");
define("Q25_21_ORDER","Order:<\/p>Construct Warehouse.");
define("Q25_21_RESP",";Well done, your Warehouse is complete...&rdquo;<\/i><br \/>Now you have fulfilled all prerequisites required to construct a Marketplace.");

define("Q25_22","Task 21: Marketplace.");
define("Q25_22_DESC",";Construct a Marketplace so you can trade with your fellow players.");
define("Q25_22_ORDER","Order:<\/p>Please build a Marketplace.");
define("Q25_22_RESP","The Marketplace has been completed. Now you can make offers of your own and accept foreign offers! When creating your own offers, you should think about offering what other players need most to get more profit.");

define("Q25_23","Task 19: Military");
define("Q25_23_DESC","A brave decision. To be able to send troops you need a rally point.<br \/><br \/>The rally point must be built on a specific building site. The ");
define("Q25_23_DESC1"," building site.");
define("Q25_23_DESC2"," is located on the right side of the main building, slightly below it. The building site itself is curved.");
define("Q25_23_ORDER","Order:<\/p>Construct a rally point.");
define("Q25_23_RESP","Your rally point has been erected! A good move towards world domination!");

define("Q25_24","Task 20: Barracks");
define("Q25_24_DESC","Now you have a main building level 3 and a rally point. That means that all prerequisites for building barracks have been fulfilled.<br><br>You can use the barracks to train troops for fighting.");
define("Q25_24_ORDER","Order:<\/p>Construct barracks.");
define("Q25_24_RESP","Well done... The best instructors from the whole country have gathered to train your men\u2019s fighting skills to top form.");

define("Q25_25","Task 21: Train.");
define("Q25_25_DESC","Now that you have barracks you can start training troops. Train two ");
define("Q25_25_ORDER","Please train 2 ");
define("Q25_25_RESP","The foundation for your glorious army has been laid.<br \/><br \/>Before sending your army off to plunder you should check with the");
define("Q25_25_RESP1","Combat Simulator");
define("Q25_25_RESP2","to see how many troops you need to successfully fight one rat without losses.");

define("Q25_26","Task 22: Everything to 2.");
define("Q25_26_DESC","Now it's time again to extend the cornerstones of might and wealth! This time level 1 is not enough... it will take a while but in the end it will be worth it. Extend all your resource tiles to level 2!");
define("Q25_26_ORDER","Order:<\/p>Extend all resource tiles to level 2.");
define("Q25_26_RESP","Congratulations! Your village grows and thrives...");

define("Q25_27","Task 23: Friends.");
define("Q25_27_DESC","As single player it is hard to compete with attackers. It is to your advantage if your neighbours like you.<br \/><br \/>It is even better if you play together with friends. Did you know that you can earn <img src='img/x.gif' class='gold' alt='Gold' title='Gold'> by inviting friends?");
define("Q25_27_ORDER","Order:<\/p>How much <img src='img/x.gif' class='gold' alt='Gold' title='Gold'> do you earn for inviting a friend?");
define("Q25_27_RESP","Correct! You get 50 <img src='img/x.gif' class='gold' alt='Gold' title='Gold'> if your invited friend have 2 village.");

define("Q25_28","Task 24: Construct Embassy.");
define("Q25_28_DESC","The world of Travian is dangerous. You already built a cranny to protect you against attackers.<br \/><br \/>A good alliance will give you even better protection.");
define("Q25_28_ORDER","Order:<\/p>To accept invitations from alliances, build an embassy.");
define("Q25_28_RESP","Yes! You can wait invitation from an alliance or create you own if embassy has level 3");

define("Q25_29","Task 25: Alliance.");
define("Q25_29_DESC","Teamwork is important in Travian. Players who work together organise themselves in alliances. Get an invitation from an alliance in your region and join this alliance. Alternatively, you can found your own alliance. To do this, you need a level 3 embassy.");
define("Q25_29_ORDER","Order:<\/p>Join an alliance or found your own alliance.");
define("Q25_29_RESP","Well done! Now you're in a union called");
define("Q25_29_RESP1",", and you're a member of their alliance.<br>Working together you will all progress faster...");

define("Q25_30","Tasks");
define("Q25_30_DESC","All tasks achieved!");


//======================================================//
//================ UNITS - DO NOT EDIT! ================//
//======================================================//
define("U0","Hero");

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
define("MODERATOR","Moderator");
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
define("NICKNAME","Nickname");
define("EMAIL","Email");
define("PASSWORD","Password");
define("ROMANS","Romans");
define("TEUTONS","Teutons");
define("GAULS","Gauls");
define("NW","North West");
define("NE","North East");
define("SW","South West");
define("SE","South East");
define("RANDOM","random");
define("ACCEPT_RULES"," I accept the game rules and general terms and conditions.");
define("ONE_PER_SERVER","Each player may only own ONE account per server.");
define("BEFORE_REGISTER","Before you register an account you should read the <a href='../anleitung.php' target='_blank'>instructions</a> of Travian ro1 to see the specific advantages and disadvantages of the three tribes.");
define("BUILDING_UPGRADING","Building:");
define("HOURS","hours");


//ATTACKS ETC.
define("TROOP_MOVEMENTS","Troop Movements:");
define("ARRIVING_REINF_TROOPS","Arriving reinforcing troops");
define("ARRIVING_ATTACKING_TROOPS","Arriving attacker troops");
define("ARRIVING_REINF_TROOPS_SHORT","Reinf.");
define("OWN_ATTACKING_TROOPS","Own attacking troops");
define("ATTACK","Attack");
define("OWN_REINFORCING_TROOPS","Own reinforcing troops");
define("TROOPS_DORF","Troops:");
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
define("PRISONERS","Prisoners");
define("PRISONERSIN","Prisoners in");
define("PRISONERSFROM","Prisoners from");
define("TROOPS","Troops");
define("TROOPSFROM","Troops");
define("BOUNTY","Bounty");
define("ARRIVAL","Arrival");
define("CATAPULT_TARGET","Catapult target(s)");
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

//SEND TROOP
define("REINFORCE","Reinforcement");
define("NORMALATTACK","Normal Attack");
define("RAID","Raid");
define("OR","or");
define("SENDTROOP","Send troops");
define("TROOP","Troops");
define("NOTROOP","no troops");

//map
define("DETAIL","Details");
define("ABANDVALLEY","Abandoned valley");
define("OCCUPIED","Occupied");
define("UNOCCUPIED","Unoccupied");
define("UNOCCUOASIS","Unoccupied oasis");
define("OCCUOASIS","Occupied oasis");
define("THERENOINFO","There is no<br>information available.");
define("LANDDIST","Land distribution");
define("TRIBE","Tribe");
define("ALLIANCE","Alliance");
define("POP","Population");
define("REPORT","Report");
define("OPTION","Options");
define("CENTREMAP","Centre map");
define("FNEWVILLAGE","Found new village");
define("CULTUREPOINT","culture points");
define("BUILDRALLY","build a rally point");
define("SETTLERSAVAIL","settlers available");
define("BEGINPRO","beginners protection");
define("SENDMERC","Send merchant(s)");
define("BAN","Player is banned");
define("BUILDMARKET","Build marketplace");
define("PERHOUR","per hour");
define("BONUS","Bonus");
define("MAP","Map");
define("CROPFINDER","Crop Finder");
define("NORTH","North");
define("EAST","East");
define("SOUTH","South");
define("WEST","West");

//other
define("VILLAGE","Village");
define("OASIS","Oasis");
define("NO_OASIS", "You do not own any oases.");
define("NO_VILLAGES", "There are no villages.");
define("PLAYER","Player");

//LOGIN.php
define("COOKIES","You must have cookies enabled to be able to log in. If you share this computer with other people you should log out after each session for your own safety.");
define("NAME","Name");
define("PW_FORGOTTEN","Password forgotten?");
define("PW_REQUEST","Then you can request a new one which will be sent to your email address.");
define("PW_GENERATE","Generate new password.");
define("EMAIL_NOT_VERIFIED","Email not verified!");
define("EMAIL_FOLLOW","Follow this link to activate your account.");
define("VERIFY_EMAIL","Verify Email.");
define("SERVER_STARTS_IN","Server will start in: ");
define("START_NOW","START NOW");


//404.php
define("NOTHING_HERE","Nothing here!");
define("WE_LOOKED","We looked 404 times already but can't find anything");

//TIME RELATED
define("CALCULATED","Calculated in");
define("SERVER_TIME","Server time:");

//MASSMESSAGE.php
define("MASS","Message Content");
define("MASS_SUBJECT","Subject:");
define("MASS_COLOR","Message color:");
define("MASS_REQUIRED","All fields required");
define("MASS_UNITS","Images (units):");
define("MASS_SHOWHIDE","Show/Hide");
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
define("RALLYPOINT_COMMENCE","Troops movement will be displayed when the ".RALLYPOINT." is completed");
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
define("NO_AVAILABLE_OFFERS","No offers at the marketplace");
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
define("INVALID_MERCHANTS_REPETITION","Invalid merchants repetition rate");
define("USER_ON_VACATION","User is on vacation mode");
define("NOT_ENOUGH_RESOURCES","Not enough resources");
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
define("TRADE_ROUTES","Trade routes");
define("DESCRIPTION","Description");
define("TIME_LEFT","Time left");
define("START","Start");
define("NO_TRADE_ROUTES","No active trade routes");
define("TRADE_ROUTE_TO","Trade route to");
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

define("EMBASSY","Embassy");
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
define("TRAINING_COMMENCE_BARRACKS","Training can commence when barracks is completed.");
define("BARRACKS_DESC","All foot soldiers are trained in the barracks. The higher the level of the barracks, the faster the troops are trained.");

define("STABLE","Stable");
define("AVAILABLE_ACADEMY","No units available. Research at academy");
define("TRAINING_COMMENCE_STABLE","Training can commence when stable is completed.");
define("STABLE_DESC","Cavalry can be trained in the stable. The higher its level the faster the troops are trained.");

define("WORKSHOP","Workshop");
define("TRAINING_COMMENCE_WORKSHOP","Training can commence when workshop is completed.");
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
define("CULTURE_POINTS","Culture points");
define("HOLD","hold");
define("CELEBRATIONS_IN_PROGRESS","Celebration<br />in progress");
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
define("TREASURY_COMMENCE","Artifacts can be viewed when treasury is completed.");
define("ARTIFACTS_AREA","Artefacts in your area");
define("NO_ARTIFACTS_AREA","There are no artefacts in your area.");
define("OWN_ARTIFACTS","Own artefacts");
define("CONQUERED","Conquered");
define("DISTANCE","Distance");
define("EFFECT","Effect");
define("ACCOUNT","Account");
define("SMALL_ARTIFACTS","Small artefacts");
define("LARGE_ARTIFACTS","Large artefacts");
define("NO_ARTIFACTS","There are no artefacts.");
define("ANY_ARTIFACTS","You do not own any artefacts.");
define("OWNER","Owner");
define("AREA_EFFECT","Area of effect");
define("VILLAGE_EFFECT","Village effect");
define("ACCOUNT_EFFECT","Account effect");
define("UNIQUE_EFFECT","Unique effect");
define("REQUIRED_LEVEL","Required level");
define("TIME_CONQUER","Time of conquer");
define("TIME_ACTIVATION","Time of activation");
define("NEXT_EFFECT"," Next effect");
define("FORMER_OWNER","Former owner(s)");
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
define("TREASURY_DESC","The riches of your empire are kept in the treasury. The treasury has room for one treasure. After you have captured an artefact it takes 24 hours on a normal server or 12 hours on a thrice speed server to be effective.");

define("TRADEOFFICE","Trade Office");
define("CURRENT_MERCHANT","Current merchant load:");
define("MERCHANT_LEVEL","Merchant load at level");
define("TRADEOFFICE_DESC","In the trade office the merchants' carts get improved and equipped with powerful horses. The higher its level the more your merchants are able to carry.");

define("GREATBARRACKS","Great Barracks");
define("TRAINING_COMMENCE_GREATBARRACKS","Training can commence when great barracks is completed.");
define("GREATBARRACKS_DESC","Foot soldiers are trained in the great barracks. The higher the level of the barracks, the faster the troops are trained.");

define("GREATSTABLE","Great Stable");
define("TRAINING_COMMENCE_GREATSTABLE","Training can commence when great stable is completed.");
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
define("TRAINING_COMMENCE_TRAPPER","Training can commence when trapper is completed.");
define("TRAPPER_DESC","The trapper protects your village with well hidden traps. This means that unwary enemies can be imprisoned and won't be able to harm your village anymore.");

define("HEROSMANSION","Hero's Mansion");
define("HERO_READY","Hero will be ready in ");
define("NAME_CHANGED","Hero name has been changed");
define("NOT_UNITS","Not available units");
define("NOT","Not ");
define("TRAIN_HERO","Train New Hero");
define("REVIVE","Revive");
define("OASES","Oases");
define("DELETE","Delete");
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
define("OF_HIT_POINTS","of his life points");
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
define("COSTS","Costs");
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
define("EDIT_BACK","Back");
define("SERV_CONFIG","Server Configuration");
define("SERV_SETT","Server Settings");
define("EDIT_SERV_SETT","Edit Server Settings");
define("SERV_VARIABLE","Variable");
define("SERV_VALUE","Value");
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
	   $lang['register'] = "Register";
	   $lang['login'] = "Login";
	   $lang['screenshots']['title1']="Village";
	   $lang['screenshots']['desc1']="Village building";
           $lang['screenshots']['title2']="Resource";
           $lang['screenshots']['desc2']="Village resource is wood, clay, iron and crop";
           $lang['screenshots']['title3']="Map";
           $lang['screenshots']['desc3']="Location your village in map";
           $lang['screenshots']['title4']="Contruct Building";
           $lang['screenshots']['desc4']="How to contruct building or resource level";
           $lang['screenshots']['title5']="Report";
           $lang['screenshots']['desc5']="Your attack report";
           $lang['screenshots']['title6']="Statistics";
           $lang['screenshots']['desc6']="View your ranking in statistics";
           $lang['screenshots']['title7']="Weapons or dough";
           $lang['screenshots']['desc7']="You can choose to play as military or economy";


?>
