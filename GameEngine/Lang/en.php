<?php

if (!function_exists('tz_def')) {
    function tz_def($k, $v) { if (!defined($k)) { define($k, $v); } }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////
//                                             TRAVIANZ                                             //
//            Only for advanced users, do not edit if you dont know what are you doing!             //
//                                Made by: Dzoki & Dixie (TravianZ)                                 //
//                              - TravianZ = Travian Clone Project -                                //
//                                 DO NOT REMOVE COPYRIGHT NOTICE!                                  //
//                                Adding tasks, constructions and artefact  by: Armando             //
//                                Modified , added , fixed , implementd  by: Shadow and ronix       //
//                                                                             						//
//  					URLs:           https://travianz.org                                        //
//                 						https://github.com/Shadowss/TravianZ                        //
//                                                                             						//
//////////////////////////////////////////////////////////////////////////////////////////////////////
									//                         //
									//         ENGLISH         //
									//      Author: Dzoki      //
									//     Adding: Armando     //
									/////////////////////////////

//MAIN MENU
tz_def('TRIBE1', 'Romans');
tz_def('TRIBE2', 'Teutons');
tz_def('TRIBE3', 'Gauls');
tz_def('TRIBE4', 'Nature');
tz_def('TRIBE5', 'Natars');
tz_def('TRIBE6', 'Monsters');

tz_def('HOME', 'Homepage');
tz_def('INSTRUCT', 'Instructions');
tz_def('ADMIN_PANEL', 'Admin Panel');
tz_def('MH_PANEL', 'Multihunter Panel');
tz_def('MASS_MESSAGE', 'Mass Message');
tz_def('LOGOUT', 'Logout');
tz_def('PROFILE', 'Profile');
tz_def('SUPPORT', 'Support');
tz_def('UPDATE_T_10', 'Update Top 10');
tz_def('SYSTEM_MESSAGE', 'System message');
tz_def('TRAVIAN_PLUS', 'Travian <b><span class="plus_g">P</span><span class="plus_o">l</span><span class="plus_g">u</span><span class="plus_o">s</span></span></span></b>');
tz_def('CONTACT', 'Contact us!');
tz_def('GAME_RULES', 'Game Rules');

//MENU
tz_def('REG', 'Register');
tz_def('FORUM', 'Forum');
tz_def('CHAT', 'Chat');
tz_def('IMPRINT', 'Imprint');
tz_def('MORE_LINKS', 'More Links');
tz_def('TOUR', 'Game Tour');


//ERRORS
tz_def('USRNM_EMPTY', '(Username empty)');
tz_def('USRNM_TAKEN', '(Name is already in use.)');
tz_def('USRNM_SHORT', '(min. '.USRNM_MIN_LENGTH.' figures)');
tz_def('USRNM_CHAR', '(Invalid Characters)');
tz_def('PW_EMPTY', '(Password empty)');
tz_def('PW_SHORT', '(min. '.PW_MIN_LENGTH.' figures)');
tz_def('PW_INSECURE', '(Password insecure. Please choose a more secure one.)');
tz_def('EMAIL_EMPTY', '(Email Empty)');
tz_def('EMAIL_INVALID', '(Invalid email address)');
tz_def('EMAIL_TAKEN', '(Email is already in use)');
tz_def('WINNER_ERROR', '<li>The server has ended! No more registrations can be made.</li>');
tz_def('TRIBE_EMPTY', '<li>Please choose a tribe.</li>');
tz_def('AGREE_ERROR', '<li>You have to agree to the game rules and the general terms & conditions in order to register.</li>');
tz_def('LOGIN_USR_EMPTY', 'Enter name.');
tz_def('LOGIN_PASS_EMPTY', 'Enter password.');
tz_def('LOGIN_VACATION', 'Vacation mode is still enable.');
tz_def('EMAIL_ERROR', 'Email does not match existing');
tz_def('PASS_MISMATCH', 'Passwords do not match');
tz_def('ALLI_OWNER', 'Please appoint an alliance owner before deleting');
tz_def('SIT_ERROR', 'Sitter already set or player not found');
tz_def('USR_NT_FOUND', 'Name does not exist.');
tz_def('LOGIN_PW_ERROR', 'The password is wrong.');
tz_def('WEL_TOPIC', 'Useful tips & information ');
tz_def('ATAG_EMPTY', 'Tag empty');
tz_def('ANAME_EMPTY', 'Name empty');
tz_def('ATAG_EXIST', 'Tag taken');
tz_def('ANAME_EXIST', 'Name taken');
tz_def('ALREADY_ALLY_MEMBER', 'You`re already in an alliance');
tz_def('ALLY_TOO_LOW', 'You must have a level 3 or greater embassy');
tz_def('USER_NOT_IN_YOUR_ALLY', 'This user is not in your alliance!');
tz_def('CANT_EDIT_YOUR_PERMISSIONS', 'You can`t edit your own permissions!');
tz_def('CANT_EDIT_LEADER_PERMISSIONS', 'Alliance leader`s permissions can`t be edited!');
tz_def('CANT_REMOVE_LEADER', 'You cannot expel the alliance founder!');
tz_def('FOUNDER_LEAVE_NEW', 'Founder was not selected!');
tz_def('FOUNDER_LEAVE_INVALID', 'Invalid founder!');
tz_def('NO_PERMISSION', 'You don`t have enough permissions!');
tz_def('NAME_OR_DIPL_EMPTY', 'Name or diplomacy empty');
tz_def('ALLY_DOESNT_EXISTS', 'Alliance does not exist');
tz_def('CANNOT_INVITE_SAME_ALLY', 'You cannot invite your own alliance');
tz_def('WRONG_DIPLOMACY', 'Wrong choice made');
tz_def('INVITE_ALREADY_SENT', 'Either you have already sent a pact to this alliance, they sent it to yours or you already have a pact with them');
tz_def('INVITE_SENT', 'Invite sent');
tz_def('DECLARED_WAR_ON', 'declared war to');
tz_def('OFFERED_NON_AGGRESION_PACT_TO', 'offered non-aggression pact to');
tz_def('OFFERED_CONFED_TO', 'offered a confederation to');
tz_def('ALLY_TOO_MUCH_PACTS', 'Either You cannot offer more pacts of this kind or this alliance has reached the limit for this kind of patcs');
tz_def('ALLY_PERMISSIONS_UPDATED', 'Permissions updated');
tz_def('ALLY_FORUM_LINK_UPDATED', 'Forum link updated');
tz_def('NO_FORUMS_YET', 'There are no forums yet.');
tz_def('ALLY_USER_KICKED', ' has been kicked from the alliance');
tz_def('NOT_OPENED_YET', 'Server not started yet.');
tz_def('REGISTER_CLOSED', 'The register is closed. You can`t register to this server.');
tz_def('NAME_EMPTY', 'Please insert name');
tz_def('NAME_NO_EXIST', 'There is no user with the name ');
tz_def('ID_NO_EXIST', 'There is no user with the id ');
tz_def('SAME_NAME', 'You can`t invite yourself');
tz_def('ALREADY_INVITED', ' already invited');
tz_def('ALREADY_IN_ALLY', ' is already in this alliance');
tz_def('ALREADY_IN_AN_ALLY', ' is already in an alliance');
tz_def('NAME_OR_TAG_CHANGED', 'Name or Tag changed');
tz_def('VAC_MODE_WRONG_DAYS', 'You`ve inserted a wrong number of days');

//COPYRIGHT
tz_def('TRAVIAN_COPYRIGHT', 'TravianZ 100% Open Source Travian Clone.');

//BUILD.TPL
tz_def('CUR_PROD', 'Current production');
tz_def('NEXT_PROD', 'Production at level ');
tz_def('CONSTRUCT_BUILD', 'Construct Building');

//DORF1
tz_def('LUMBER', 'Lumber');
tz_def('CLAY', 'Clay');
tz_def('IRON', 'Iron');
tz_def('CROP', 'Crop');
tz_def('LEVEL', 'Level');
tz_def('CROP_COM', CROP.' consumption');
tz_def('PER_HR', 'per hour');
tz_def('PRODUCTION', 'Production');
tz_def('CAPITAL1', 'Capital');
tz_def('VILLAGES', 'Villages');
tz_def('ANNOUNCEMENT', 'Announcement');
tz_def('GO2MY_VILLAGE', 'Go to my village');
tz_def('VILLAGE_CENTER', 'Village centre');
tz_def('FINISH_GOLD', 'Finish all construction and research orders in this village immediately for 2 Gold?');
tz_def('WAITING_LOOP', '(waiting loop)');
tz_def('CROP_NEGATIVE', 'Your crop production is negative, you`ll neaver reach the amount of requested resources.');
tz_def('HR', 'h.');
tz_def('HRS', '(hrs.)');
tz_def('DONE_AT', 'done at');
tz_def('CANCEL', 'cancel');
tz_def('LOYALTY', 'Loyalty');
tz_def('CALCULATED_IN', 'Calculated in');
tz_def('HI', 'HI');
tz_def('P_IN', 'in');
tz_def('MS', 'ms');
tz_def('SERVER_TIME', 'Server time:');
tz_def('REMAINING_GOLD', 'Remaining gold');

// HEADER && MENU && Messages && Reports
tz_def('REPORTS', 'Reports');
tz_def('MESSAGES', 'Messages');
tz_def('PLUS_MENU', 'Plus menu');
tz_def('LINKS', 'Links');
tz_def('CANCEL_PROCESS', 'Cancel process');
tz_def('ACCOUNT_DELETING', 'The account will be deleted in');
tz_def('INBOX', 'Inbox');
tz_def('WRITE', 'Write');
tz_def('SENT', 'Sent');
tz_def('SEND', 'Send');
tz_def('ARCHIVE', 'Archive');
tz_def('NOTES', 'Notes');
tz_def('SUBJECT', 'Subject');
tz_def('SENDER', 'Sender');
tz_def('RECIPIENT', 'Recipient');
tz_def('BACK', 'Back');
tz_def('NEW', 'new');
tz_def('UNREAD', 'unread');
tz_def('NO_MESS', 'There are no messages available');
tz_def('NO_MESS_IN_ARCHIVE', NO_MESS.' in the archive');
tz_def('NO_MESS_SENT', 'There are no sent messages available');
tz_def('MESS_FOR_SUP', 'Message for Support');
tz_def('MESS_FOR_MH', 'Message for Multihunter');
tz_def('SEND_AS_SUP', 'Send as Support');
tz_def('SEND_AS_MH', 'Send as Multihunter');
tz_def('SAVE', 'Save');
tz_def('ANSWER', 'Answer');
tz_def('REPLY', 'Reply');
tz_def('ADDRESSBOOK', 'Addressbook');
tz_def('CLOSE_ADDRESSBOOK', 'Close Addressbook');
tz_def('ONLINE_S1', 'Now online');
tz_def('ONLINE_S2', 'Offline');
tz_def('ONLINE_S3', 'Last 3 days');
tz_def('ONLINE_S4', 'Last 7 days');
tz_def('ONLINE_S5', 'Inactive');
tz_def('WAIT_FOR_CONFIRM', 'Wait for confirm');
tz_def('CONFIRM', 'Confirm');
tz_def('WRITE_MESS_WARN', '<b>Warning:</b> you can`t use the values <b>[message]</b> or <b>[/message]</b> in your message because it can cause problem with bbcode system');
tz_def('NO_REPORTS', 'There are no reports available');
tz_def('ATTACKER', 'Attacker');
tz_def('NATAR_COUNTERFORCE', 'Natar Counterforce');
tz_def('FROM_THE_VILL', 'from the village');
tz_def('CASUALTIES', 'Casualties');
tz_def('INFORMATION', 'Information');
tz_def('CARRY', 'carry');
tz_def('DEFENDER', 'Defender');
tz_def('VISITED', 'visited');
tz_def('HIS_TROOPS', '`s troops');
tz_def('WISHES_YOU', 'wishes you');
tz_def('X_MAS', 'Merry Christmas');
tz_def('NEW_YEAR', 'Happy New Year');
tz_def('EASTER', 'Happy Easter');
if(!defined('PEACE')) tz_def('PEACE', 'Peace');

tz_def('GOLD', 'Gold');
tz_def('GOLD_IMG', '<img src=\"/img/x.gif\" class=\"gold\" alt=\"'.GOLD.'\" title=\"'.GOLD.'\">');

//QUEST
tz_def('Q_CONTINUE', 'Continue with the next task.');
tz_def('Q_REWARD', 'Your reward:');
tz_def('Q_BUTN', 'complete task');
tz_def('Q0', 'Welcome to ');
tz_def('Q0_DESC', 'As I see you have been made chieftain of this little village. I will be your counselor for the first few days and never leave your (right hand) side.');
tz_def('Q0_OPT1', 'To the first task.');
tz_def('Q0_OPT2', 'Look around on your own.');
tz_def('Q0_OPT3', 'Play no tasks.');

tz_def('Q1', 'Task 1: Woodcutter');
tz_def('Q1_DESC', 'There are four green forests around your village. Construct a woodcutter on one of them. Lumber is an important resource for our new settlement.');
tz_def('Q1_ORDER', 'Order:</p>Construct a woodcutter.');
tz_def('Q1_RESP', 'Yes, that way you gain more lumber.I helped a bit and completed the order instantly.');
tz_def('Q1_REWARD', 'Woodcutter instantly completed.');

tz_def('Q2', 'Task 2: Crop');
tz_def('Q2_DESC', 'Now your subjects are hungry from working all day. Extend a cropland to improve your subjects supply. Come back here once the building is complete.');
tz_def('Q2_ORDER', 'Order:</p>Extend one cropland.');
tz_def('Q2_RESP', 'Very good. Now your subjects have enough to eat again...');
tz_def('Q2_REWARD', 'Your reward:</p>1 day Travian');

tz_def('Q3', 'Task 3: Your Village`s Name');
tz_def('Q3_DESC', 'Creative as you are you can grant your village the ultimate name.<br><br>Click on `profile` in the left hand menu and then select `change profile`...');
tz_def('Q3_ORDER', 'Order:</p>Change your village`s name to something nice.');
tz_def('Q3_RESP', 'Wow, a great name for their village. It could have been the name of my village!...');

tz_def('Q4', 'Task 4: Other Players');
tz_def('Q4_DESC', 'In '.SERVER_NAME.' you play along with billions of other players. Click `statistics` in the top menu to look up your rank and enter it here.');
tz_def('Q4_ORDER', 'Order:</p>Look for your rank in the statistics and enter it here.');
tz_def('Q4_BUTN', 'complete task');
tz_def('Q4_RESP', 'Exactly! That`s your rank.');

tz_def('Q5', 'Task 5: Two Building Orders');
tz_def('Q5_DESC', 'Build an iron mine and a clay pit. Of iron and clay one can never have enough.');
tz_def('Q5_ORDER', 'Order:</p><ul><li>Extend one iron mine.</li><li>Extend one clay pit.</li></ul>');
tz_def('Q5_RESP', 'As you noticed, building orders take rather long. The world of '.SERVER_NAME.' will continue to spin even if you are offline. Even in a few months there will be many new things for you to discover.<br><br>The best thing to do is occasionally checking your village and giving you subjects new tasks to do.');

tz_def('Q6', 'Task 6: Messages');
tz_def('Q6_DESC', 'You can talk to other players using the messaging system. I sent a message to you. Read it and come back here.<br><br>P.S. Don`t forget: on the left the reports, on the right the messages.');
tz_def('Q6_ORDER', 'Order:</p>Read your new message.');
tz_def('Q6_RESP', 'You received it? Very good.<br><br>Here is some Gold. With Gold you can do several things, e.g. extend your   in the left hand menu.');
tz_def('Q6_RESP1', '-Account or increase your resource production.To do so click ');
tz_def('Q6_RESP2', 'in the left hand menu.');
tz_def('Q6_SUBJECT', 'Message From The Taskmaster');
tz_def('Q6_MESSAGE', 'You are to be informed that a nice reward is waiting for you at the taskmaster.<br><br>Hint: The message has been generated automatically. An answer is not necessary.');

tz_def('Q7', 'Task 7: One Each!');
tz_def('Q7_DESC', 'Now we should increase your resource production a bit. Build an additional woodcutter, clay pit, iron mine and cropland to level 1.');
tz_def('Q7_ORDER', 'Order:</p>Extend one more of each resource tile to level 1.');
tz_def('Q7_RESP', 'Very good, great develop of resources production.');

tz_def('Q8', 'Task 8: Huge Army!');
tz_def('Q8_DESC', 'Now I`ve got a very special quest for you. I am hungry. Give me 200 crop!<br><br>In return I will try to organize a huge army to protect your village.');
tz_def('Q8_ORDER', 'Order:</p>Send 200 crop to the taskmaster.');
tz_def('Q8_BUTN', 'Send crop');
tz_def('Q8_NOCROP', 'No Enough Crop!');

tz_def('Q9', 'Task 9: Everything to 1.');
tz_def('Q9_DESC', 'In Travian there is always something to do! While you are waiting for incoming the huge army, Now we should increase your resource production a bit. Extend all your resource tiles to level 1.');
tz_def('Q9_ORDER', 'Order:</p>Extend all resource tiles to level 1.');
tz_def('Q9_RESP', 'Very good, your resource production just thrives.<br><br>Soon we can start with constructing buildings in the village.');

tz_def('Q10', 'Task 10: Dove of Peace');
tz_def('Q10_DESC', 'The first days after signing up you are protected against attacks by your fellow players. You can see how long this protection lasts by adding the code <b>[#0]</b> to your profile.');
tz_def('Q10_ORDER', 'Order:</p>Write the code <b>[#0]</b> into your profile by adding it to one of the two description fields.');
tz_def('Q10_RESP', 'Well done! Now everyone can see what a great warrior the world is approached by.');
tz_def('Q10_REWARD', 'Your reward:</p>2 day Travian');

tz_def('Q11', 'Task 11: Neighbours!');
tz_def('Q11_DESC', 'Around you, there are many different villages. One of them is named. ');
tz_def('Q11_DESC1', ' Click on `map` in the header menu and look for that village. The name of your neighbours` villages can be seen when hovering your mouse over any of them.');
tz_def('Q11_ORDER', 'Order:</p>Look for the coordinates of ');
tz_def('Q11_ORDER1', 'and enter them here.');
tz_def('Q11_RESP', 'Exactly, there ');
tz_def('Q11_RESP1', ' Village! As many resources as you reach this village. Well, almost as much ...');
tz_def('Q11_BUTN', 'complete task');

tz_def('Q12', 'Task 12: Cranny');
tz_def('Q12_DESC', 'It`s getting time to erect a cranny. The world of '.SERVER_NAME.' is dangerous.<br><br>Many players live by stealing other players resources. Build a cranny to hide some of your resources from enemies.');
tz_def('Q12_ORDER', 'Order:</p>Construct a Cranny.');
tz_def('Q12_RESP', 'Well done, now it`s way harder for your mean fellow players to plunder your village.<br><br>If under attack, your villagers will hide the resources in the Cranny all on their own.');

tz_def('Q13', 'Task 13: To Two.');
tz_def('Q13_DESC', 'In '.SERVER_NAME.' there is always something to do! Extend one woodcutter, one clay pit, one iron mine and one cropland to level 2 each.');
tz_def('Q13_ORDER', 'Order:</p>Extend one of each resource tile to level 2.');
tz_def('Q13_RESP', 'Very good, your village grows and thrives!');

tz_def('Q14', 'Task 14: Instructions');
tz_def('Q14_DESC', 'In the ingame instructions you can find short information texts about different buildings and types of units.<br><br>Click on `instructions` at the left to find out how much lumber is required for the barracks.');
tz_def('Q14_ORDER', 'Order:</p>Enter how much lumber barracks cost');
tz_def('Q14_BUTN', 'complete task');
tz_def('Q14_RESP', 'Exactly! Barracks cost 210 lumber.');

tz_def('Q15', 'Task 15: Main Building');
tz_def('Q15_DESC', 'Your master builders need a main building level 3 to erect important buildings such as the marketplace or barracks.');
tz_def('Q15_ORDER', 'Order:</p>Extend your main building to level 3.');
tz_def('Q15_RESP', 'Well done. The main building level 3 has been completed.<br><br>With this upgrade your master builders cannot only construct more types of buildings but also do so faster.');

tz_def('Q16', 'Task 16: Advanced!');
tz_def('Q16_DESC', 'Look up your rank in the player statistics again and enjoy your progress.');
tz_def('Q16_ORDER', 'Order:</p>Look for your rank in the statistics and enter it here.');
tz_def('Q16_RESP', 'Well done! That`s your current rank.');

tz_def('Q17', 'Task 17: Weapons or Dough');
tz_def('Q17_DESC', 'Now you have to make a decision: Either trade peacefully or become a dreaded warrior.<br><br>For the marketplace you need a granary, for the barracks you need a rally point.');
tz_def('Q17_BUTN', 'Economy');
tz_def('Q17_BUTN1', 'Military');

tz_def('Q18', 'Task 18: Military');
tz_def('Q18_DESC', 'A brave decision. To be able to send troops you need a rally point.<br><br>The rally point must be built on a specific building site. The ');
tz_def('Q18_DESC1', ' building site.');
tz_def('Q18_DESC2', ' is located on the right side of the main building, slightly below it. The building site itself is curved.');
tz_def('Q18_ORDER', 'Order:</p>Construct a rally point.');
tz_def('Q18_RESP', 'Your rally point has been erected! A good move towards world domination!');

tz_def('Q19', 'Task 19: Barracks');
tz_def('Q19_DESC', 'Now you have a main building level 3 and a rally point. That means that all prerequisites for building barracks have been fulfilled.<br><br>You can use the barracks to train troops for fighting.');
tz_def('Q19_ORDER', 'Order:</p>Construct barracks.');
tz_def('Q19_RESP', 'Well done... The best instructors from the whole country have gathered to train your men\u2019s fighting skills to top form.');

tz_def('Q20', 'Task 20: Train.');
tz_def('Q20_DESC', 'Now that you have barracks you can start training troops. Train two ');
tz_def('Q20_ORDER', 'Please train 2 ');
tz_def('Q20_RESP', 'The foundation for your glorious army has been laid.<br><br>Before sending your army off to plunder you should check with the.');
tz_def('Q20_RESP1', 'Combat Simulator');
tz_def('Q20_RESP2', 'to see how many troops you need to successfully fight one rat without losses.');

tz_def('Q21', 'Task 18: Economy');
tz_def('Q21_DESC', 'Trade & Economy was your choice. Golden times await you for sure!');
tz_def('Q21_ORDER', 'Order:</p>Construct a Granary.');
tz_def('Q21_RESP', 'Well done! With the Granary you can store more wheat.');

tz_def('Q22', 'Task 19: Warehouse');
tz_def('Q22_DESC', 'Not only Crop has to be saved. Other resources can go to waste as well if they are not stored correctly. Construct a Warehouse!');
tz_def('Q22_ORDER', 'Order:</p>Construct Warehouse.');
tz_def('Q22_RESP', ';Well done, your Warehouse is complete...&rdquo;</i><br>Now you have fulfilled all prerequisites required to construct a Marketplace.');

tz_def('Q23', 'Task 20: Marketplace.');
tz_def('Q23_DESC', ';Construct a Marketplace so you can trade with your fellow players.');
tz_def('Q23_ORDER', 'Order:</p>Please build a Marketplace.');
tz_def('Q23_RESP', ';The Marketplace has been completed. Now you can make offers of your own and accept foreign offers! When creating your own offers, you should think about offering what other players need most to get more profit.');

tz_def('Q24', 'Task 21: Everything to 2.');
tz_def('Q24_DESC', 'Now we should increase your resource production a bit. Build an additional woodcutter, clay pit, iron mine and cropland to level 1.');
tz_def('Q24_ORDER', 'Order:</p>Extend all resource tiles to level 2.');
tz_def('Q24_RESP', 'Congratulations! Your village grows and thrives...');

tz_def('Q28', 'Task 22: Alliance.');
tz_def('Q28_DESC', 'Teamwork is important in Travian. Players who work together organise themselves in alliances. Get an invitation from an alliance in your region and join this alliance. Alternatively, you can found your own alliance. To do this, you need a level 3 embassy.');
tz_def('Q28_ORDER', 'Order:</p>Join an alliance or found one on your own.');
tz_def('Q28_RESP', 'Is good! Now you`re in a union called');
tz_def('Q28_RESP1', ', and you`re a member of their alliance with the faster you`ll progress...');

tz_def('Q29', 'Task 23: Main Building to Level 5');
tz_def('Q29_DESC', 'To be able to build a palace or residence, you will need a main building at level 5.');
tz_def('Q29_ORDER', 'Order:</p>Upgrade your main building to level 5.');
tz_def('Q29_RESP', 'The main building is level 5 now and you can build palace or residence...');

tz_def('Q30', 'Task 24: Granary to Level 3.');
tz_def('Q30_DESC', 'That you do not lose crop, you should upgrade your granary.');
tz_def('Q30_ORDER', 'Order:</p>Upgrade your granary to level 3.');
tz_def('Q30_RESP', 'Granary is level 3 now...');

tz_def('Q31', 'Task 25: Warehouse to Level 7');
tz_def('Q31_DESC', ' To make sure your resources won`t overflow, you should upgrade your warehouse.');
tz_def('Q31_ORDER', 'Order:</p>Upgrade your warehouse to level 7.');
tz_def('Q31_RESP', 'Warehouse has upgraded to level 7...');

tz_def('Q32', 'Task 26: All to five!');
tz_def('Q32_DESC', 'You will always need more resources. Resource tiles are quite expensive but will always pay out in the long term.');
tz_def('Q32_ORDER', 'Order:</p>Upgrade all resources tiles to level 5.');
tz_def('Q32_RESP', 'All resources are at level 5, very good, your village grows and thrives!');

tz_def('Q33', 'Task 27: Palace or Residence?');
tz_def('Q33_DESC', 'To found a new village, you will need settlers. Those you can train in either a palace or a residence.');
tz_def('Q33_ORDER', 'Order:</p>Build a palace or residence to level 10.');
tz_def('Q33_RESP', 'had reached to level 10, you can now train settlers and found your second village. Notice the cultural points...');

tz_def('Q34', 'Task 28: 3 settlers.');
tz_def('Q34_DESC', 'To found a new village, you will need settlers. They can be trained  in either a palace or a residence.');
tz_def('Q34_ORDER', 'Order:</p>Train 3 settlers.');
tz_def('Q34_RESP', '3 settlers were trained. To found new village you need at least');
tz_def('Q34_RESP1', 'culture points...');

tz_def('Q35', 'Task 29: New Village.');
tz_def('Q35_DESC', 'There are a lot of empty tiles on the map. Find one that suits you and found a new village');
tz_def('Q35_ORDER', 'Order:</p>Found a new village.');
tz_def('Q35_RESP', 'I am proud of you! Now you have two villages and have all the possibilities to build a mighty empire. I wish you luck with this.');

tz_def('Q36', ' Task 30: Build a ');
tz_def('Q36_DESC', 'Now that you have trained some soldiers, you should build a ');
tz_def('Q36_DESC1', ' too. It increases the base defence and your soldiers will receive a defensive bonus.');
tz_def('Q36_ORDER', 'Order:</p>Build a ');
tz_def('Q36_RESP', 'That`s what I`m talking about. A ');
tz_def('Q36_RESP1', ' Very useful. It increases the defence of the troops in the village.');

tz_def('Q37', 'Tasks');
tz_def('Q37_DESC', 'All tasks achieved!');

tz_def('RESOURCES_OVERVIEW', 'Resource overview');
tz_def('YOUR_RES_DELIVERIES', 'Your resource deliveries');
tz_def('DELIVERY', 'Delivery');
tz_def('DELIVERY_TIME', 'Delivery time');
tz_def('STATUS', 'Status');
tz_def('FETCH', 'fetch');
tz_def('FETCHED', 'fetched');
tz_def('ON_HOLD', 'on hold');
tz_def('ONE_DAY_OF_TRAVIAN', '1 day Travian ');
tz_def('TWO_DAYS_OF_TRAVIAN', '2 days Travian ');

//Quest 25
tz_def('Q25_7', 'Task 7: Neighbours!');
tz_def('Q25_7_DESC', 'Around you, there are many different villages. One of them is named. ');
tz_def('Q25_7_DESC1', 'Click `Map` in the head menu and look for that village. The name of your neighbours villages can be seen once you hover your mouse over any of them.');
tz_def('Q25_7_ORDER', '</p><b>Order:</b><br>Look for the coordinates of ');
tz_def('Q25_7_ORDER1', 'and enter them here.');
tz_def('Q25_7_RESP', 'Exactly, there ');
tz_def('Q25_7_RESP1', ' Village! As many resources as you reach this village. Well, almost as much ...');

tz_def('Q25_8', 'Task 8: Huge Army!');
tz_def('Q25_8_DESC', 'Now I`ve got a very special Quest for you. I am hungry. Give me 200 crop!<br><br>In return I will try to organize a huge army to protect your village.');
tz_def('Q25_8_ORDER', 'Order:</p>Send 200 crop to the taskmaster.');
tz_def('Q25_8_BUTN', 'Send crop');
tz_def('Q25_8_NOCROP', 'No Enough Crop!');

tz_def('Q25_9', 'Task 9: One each!');
tz_def('Q25_9_DESC', 'In '.SERVER_NAME.' there is always something to do! While you are waiting for your new army,<br><br>extend one additional woodcutter, clay pit, iron mine and cropland to level 1');
tz_def('Q25_9_ORDER', 'Order:</p>Extend one more of each resource tile to level 1.');
tz_def('Q25_9_RESP', 'Very good, great development of resource production.');

tz_def('Q25_10', 'Task 10: Comming Soon!');
tz_def('Q25_10_DESC', 'Now there is time for a small break until the gigantic army I sent you arrives.<br><br>Until then you can explore the map or extend a few resource tiles.');
tz_def('Q25_10_ORDER', 'Order:</p>Wait for the taskmaster`s army to arrive');
tz_def('Q25_10_RESP', 'Now a huge army from taskmaster has arrive to protect your village');
tz_def('Q25_10_REWARD', 'Your reward:</p>2 days more of Travian');

tz_def('Q25_11', 'Task 11: Reports');
tz_def('Q25_11_DESC', 'Every time something important happens to your account you will receive a report.<br><br>You can see these by clicking on the left half of the 5th button (from left to right). Read the report and come back here.');
tz_def('Q25_11_ORDER', 'Order:</p>Read your latest report.');
tz_def('Q25_11_RESP', 'You received it? Very good. Here is your reward.');

tz_def('Q25_12', 'Task 12: Everything to 1.');
tz_def('Q25_12_DESC', 'Now we should increase your resource production a bit.');
tz_def('Q25_12_ORDER', 'Order:</p>Extend all resource tiles to level 1.');
tz_def('Q25_12_RESP', 'Very good, your resource production just thrives.<br><br>Soon we can start with constructing buildings in the village.');

tz_def('Q25_13', 'Task 13: Dove of Peace');
tz_def('Q25_13_DESC', 'The first days after signing up you are protected against attacks by your fellow players. You can see how long this protection lasts by adding the code <b>[#0]</b> to your profile.');
tz_def('Q25_13_ORDER', 'Order:</p>Write the code <b>[#0]</b> into your profile by adding it to one of the two description fields.');
tz_def('Q25_13_RESP', 'Well done! Now everyone can see what a great warrior the world is approached by.');

tz_def('Q25_14', 'Task 14: Cranny');
tz_def('Q25_14_DESC', 'It`s getting time to erect a cranny. The world of <b>'.SERVER_NAME.'</b> is dangerous.<br><br>Many players live by stealing other player`s resources. Build a cranny to hide some of your resources from enemies.');
tz_def('Q25_14_ORDER', 'Order:</p>Construct a Cranny.');
tz_def('Q25_14_RESP', 'Well done, now it`s way harder for your mean fellow players to plunder your village.<br><br>If under attack, your villagers will hide the resources in the Cranny all on their own.');

tz_def('Q25_15', 'Task 15: To Two.');
tz_def('Q25_15_DESC', 'In <b>'.SERVER_NAME.'</b> there is always something to do! Extend one woodcutter, one clay pit, one iron mine and one cropland to level 2 each.');
tz_def('Q25_15_ORDER', 'Order:</p>Extend one of each resource tile to level 2.');
tz_def('Q25_15_RESP', 'Very good, your village grows and thrives!');

tz_def('Q25_16', 'Task 16: Instructions');
tz_def('Q25_16_DESC', 'In the ingame instructions you can find short information texts about different buildings and types of units.<br><br>Click on `instructions` at the left to find out how much lumber is required for the barracks.');
tz_def('Q25_16_ORDER', 'Order:</p>Enter how much lumber barracks cost');
tz_def('Q25_16_BUTN', 'complete task');
tz_def('Q25_16_RESP', 'Exactly! Barracks cost 210 lumber.');

tz_def('Q25_17', 'Task 17: Main Building');
tz_def('Q25_17_DESC', 'Your master builders need a main building level 3 to erect important buildings such as the marketplace or barracks.');
tz_def('Q25_17_ORDER', 'Order:</p>Extend your main building to level 3.');
tz_def('Q25_17_RESP', 'Well done. The main building level 3 has been completed.<br><br>With this upgrade your master builders can construct more types of buildings and also do so faster.');

tz_def('Q25_18', 'Task 18: Advanced!');
tz_def('Q25_18_DESC', 'Look up your rank in the player statistics again and enjoy your progress.');
tz_def('Q25_18_ORDER', 'Order:</p>Look for your rank in the statistics and enter it here.');
tz_def('Q25_18_RESP', 'Well done! That`s your current rank.');

tz_def('Q25_19', 'Task 19: Weapons or Dough');
tz_def('Q25_19_DESC', 'Now you have to make a decision: Either trade peacefully or become a dreaded warrior.<br><br>For the marketplace you need a granary, for the barracks you need a rally point.');
tz_def('Q25_19_BUTN', 'Economy');
tz_def('Q25_19_BUTN1', 'Military');

tz_def('Q25_20', 'Task 19: Economy');
tz_def('Q25_20_DESC', 'Trade & Economy was your choice. Golden times await you for sure!');
tz_def('Q25_20_ORDER', 'Order:</p>Construct a Granary.');
tz_def('Q25_20_RESP', 'Well done! With the Granary you can store more wheat.');

tz_def('Q25_21', 'Task 20: Warehouse');
tz_def('Q25_21_DESC', 'Not only Crop has to be saved. Other resources can go to waste as well if they are not stored correctly. Construct a Warehouse!');
tz_def('Q25_21_ORDER', 'Order:</p>Construct Warehouse.');
tz_def('Q25_21_RESP', ';Well done, your Warehouse is complete...&rdquo;</i><br>Now you have fulfilled all prerequisites required to construct a Marketplace.');

tz_def('Q25_22', 'Task 21: Marketplace.');
tz_def('Q25_22_DESC', ';Construct a Marketplace so you can trade with your fellow players.');
tz_def('Q25_22_ORDER', 'Order:</p>Please build a Marketplace.');
tz_def('Q25_22_RESP', 'The Marketplace has been completed. Now you can make offers of your own and accept foreign offers! When creating your own offers, you should think about offering what other players need most to get more profit.');

tz_def('Q25_23', 'Task 19: Military');
tz_def('Q25_23_DESC', 'A brave decision. To be able to send troops you need a rally point.<br><br>The rally point must be built on a specific building site. The ');
tz_def('Q25_23_DESC1', ' building site.');
tz_def('Q25_23_DESC2', ' is located on the right side of the main building, slightly below it. The building site itself is curved.');
tz_def('Q25_23_ORDER', 'Order:</p>Construct a rally point.');
tz_def('Q25_23_RESP', 'Your rally point has been erected! A good move towards world domination!');

tz_def('Q25_24', 'Task 20: Barracks');
tz_def('Q25_24_DESC', 'Now you have a main building level 3 and a rally point. That means that all prerequisites for building barracks have been fulfilled.<br><br>You can use the barracks to train troops for fighting.');
tz_def('Q25_24_ORDER', 'Order:</p>Construct barracks.');
tz_def('Q25_24_RESP', 'Well done... The best instructors from the whole country have gathered to train your men\u2019s fighting skills to top form.');

tz_def('Q25_25', 'Task 21: Train.');
tz_def('Q25_25_DESC', 'Now that you have barracks you can start training troops. Train two ');
tz_def('Q25_25_ORDER', 'Please train 2 ');
tz_def('Q25_25_RESP', 'The foundation for your glorious army has been laid.<br><br>Before sending your army off to plunder you should check with the');
tz_def('Q25_25_RESP1', 'Combat Simulator');
tz_def('Q25_25_RESP2', 'to see how many troops you need to successfully fight one rat without losses.');

tz_def('Q25_26', 'Task 22: Everything to 2.');
tz_def('Q25_26_DESC', 'Now it`s time again to extend the cornerstones of might and wealth! This time level 1 is not enough... it will take a while but in the end it will be worth it. Extend all your resource tiles to level 2!');
tz_def('Q25_26_ORDER', 'Order:</p>Extend all resource tiles to level 2.');
tz_def('Q25_26_RESP', 'Congratulations! Your village grows and thrives...');

tz_def('Q25_27', 'Task 23: Friends.');
tz_def('Q25_27_DESC', 'As single player it is hard to compete with attackers. It is to your advantage if your neighbours like you.<br><br>It is even better if you play together with friends. Did you know that you can earn '.GOLD_IMG.' by inviting friends?');
tz_def('Q25_27_ORDER', 'Order:</p>How much '.GOLD_IMG.' do you earn for inviting a friend?');
tz_def('Q25_27_RESP', 'Correct! You get 50 '.GOLD_IMG.' if your invited friend have 2 village.');

tz_def('Q25_28', 'Task 24: Construct Embassy.');
tz_def('Q25_28_DESC', 'The world of Travian is dangerous. You already built a cranny to protect you against attackers.<br><br>A good alliance will give you even better protection.');
tz_def('Q25_28_ORDER', 'Order:</p>To accept invitations from alliances, build an embassy.');
tz_def('Q25_28_RESP', 'Yes! You can wait invitation from an alliance or create you own if embassy has level 3');

tz_def('Q25_29', 'Task 25: Alliance.');
tz_def('Q25_29_DESC', 'Teamwork is important in Travian. Players who work together organise themselves in alliances. Get an invitation from an alliance in your region and join this alliance. Alternatively, you can found your own alliance. To do this, you need a level 3 embassy.');
tz_def('Q25_29_ORDER', 'Order:</p>Join an alliance or found your own alliance.');
tz_def('Q25_29_RESP', 'Well done! Now you`re in a union called');
tz_def('Q25_29_RESP1', ', and you`re a member of their alliance.<br>Working together you will all progress faster...');

tz_def('Q25_30', 'Tasks');
tz_def('Q25_30_DESC', 'All tasks achieved!');


//======================================================//
//================ UNITS - DO NOT EDIT! ================//
//======================================================//
tz_def('U0', 'Hero');

//ROMAN UNITS
tz_def('U1', 'Legionnaire');
tz_def('U2', 'Praetorian');
tz_def('U3', 'Imperian');
tz_def('U4', 'Equites Legati');
tz_def('U5', 'Equites Imperatoris');
tz_def('U6', 'Equites Caesaris');
tz_def('U7', 'Battering Ram');
tz_def('U8', 'Fire Catapult');
tz_def('U9', 'Senator');
tz_def('U10', 'Settler');

//TEUTON UNITS
tz_def('U11', 'Clubswinger');
tz_def('U12', 'Spearman');
tz_def('U13', 'Axeman');
tz_def('U14', 'Scout');
tz_def('U15', 'Paladin');
tz_def('U16', 'Teutonic Knight');
tz_def('U17', 'Ram');
tz_def('U18', 'Catapult');
tz_def('U19', 'Chief');
tz_def('U20', 'Settler');

//GAUL UNITS
tz_def('U21', 'Phalanx');
tz_def('U22', 'Swordsman');
tz_def('U23', 'Pathfinder');
tz_def('U24', 'Theutates Thunder');
tz_def('U25', 'Druidrider');
tz_def('U26', 'Haeduan');
tz_def('U27', 'Ram');
tz_def('U28', 'Trebuchet');
tz_def('U29', 'Chieftain');
tz_def('U30', 'Settler');
tz_def('U99', 'Trap');

//NATURE UNITS
tz_def('U31', 'Rat');
tz_def('U32', 'Spider');
tz_def('U33', 'Snake');
tz_def('U34', 'Bat');
tz_def('U35', 'Wild Boar');
tz_def('U36', 'Wolf');
tz_def('U37', 'Bear');
tz_def('U38', 'Crocodile');
tz_def('U39', 'Tiger');
tz_def('U40', 'Elephant');

//NATARS UNITS
tz_def('U41', 'Pikeman');
tz_def('U42', 'Thorned Warrior');
tz_def('U43', 'Guardsman');
tz_def('U44', 'Birds Of Prey');
tz_def('U45', 'Axerider');
tz_def('U46', 'Natarian Knight');
tz_def('U47', 'War Elephant');
tz_def('U48', 'Ballista');
tz_def('U49', 'Natarian Emperor');
tz_def('U50', 'Natarian Settler');

//MONSTER UNITS
tz_def('U51', 'Monster Peon');
tz_def('U52', 'Monster Hunter');
tz_def('U53', 'Monster Warrior');
tz_def('U54', 'Ghost');
tz_def('U55', 'Monster Steed');
tz_def('U56', 'Monster War Steed');
tz_def('U57', 'Monster Ram');
tz_def('U58', 'Monster Catapult');
tz_def('U59', 'Monster Chief');
tz_def('U60', 'Monster Settler');

//INDEX.php
tz_def('LOGIN', 'Login');
tz_def('PLAYERS', 'Players');
tz_def('MODERATOR', 'Moderator');
tz_def('ACTIVE', 'Active');
tz_def('ONLINE', 'Online');
tz_def('TUTORIAL', 'Tutorial');
if(!defined('FAQ')) tz_def('FAQ', 'Faq');
if(!defined('SPIELREGELN')) tz_def('SPIELREGELN', 'Game Rules');
tz_def('PLAYER_STATISTICS', 'Player statistics');
tz_def('TOTAL_PLAYERS', PLAYERS.' in total');
tz_def('ACTIVE_PLAYERS', 'Active players');
tz_def('ONLINE_PLAYERS', PLAYERS.' online');
tz_def('MP_STRATEGY_GAME', SERVER_NAME.' - the multiplayer strategy game');
tz_def('WHAT_IS', SERVER_NAME.' is one of the most popular browser games in the world. As a player in '.SERVER_NAME.', you will build your own empire, recruit a mighty army, and fight with your allies for game world hegemony.');
tz_def('REGISTER_FOR_FREE', 'Register here for free!');
tz_def('LATEST_GAME_WORLD', 'Latest game world');
tz_def('LATEST_GAME_WORLD2', 'Register on the latest<br>game world and enjoy<br>the advantages of<br>being one of the<br>first players.');
tz_def('PLAY_NOW', 'Play '.SERVER_NAME.' now');
tz_def('LEARN_MORE', 'Learn more <br>about '.SERVER_NAME.'!');
tz_def('LEARN_MORE2', 'Now with a revolutionised<br>server system, completely new<br>graphics <br>This clone is The Shiz!');
tz_def('COMUNITY', 'Community');
tz_def('BECOME_COMUNITY', 'Become part of our community now!');
tz_def('BECOME_COMUNITY2', 'Become a part of one of<br>the biggest gaming<br>communities in the<br>world.');
tz_def('NEWS', 'News');
tz_def('SCREENSHOTS', 'Screenshots');
if(!defined('FAQ')) tz_def('FAQ', 'FAQ');
if(!defined('SPIELREGELN')) tz_def('SPIELREGELN', 'Rules');
tz_def('AGB', 'Terms and Conditions');
tz_def('LEARN1', 'Upgrade your fields and mines to increase your resource production. You will need resources to construct buildings and train soldiers.');
tz_def('LEARN2', 'Construct and expand the buildings in your village. Buildings improve your overall infrastructure, increase your resource production and allow you to research, train and upgrade your troops.');
tz_def('LEARN3', 'View and interact with your surroundings. You can make new friends or new enemies, make use of the nearby oases and observe as your empire grows and becomes stronger.');
tz_def('LEARN4', 'Follow your improvement and success and compare yourself to other players. Look at the Top 10 rankings and fight to win a weekly medal.');
tz_def('LEARN5', 'Receive detailed reports about your adventures, trades and battles. Don`t forget to check the brand new reports about the happenings taking place in your surroundings.');
tz_def('LEARN6', 'Exchange information and conduct diplomacy with other players. Always remember that communication is the key to winning new friends and solving old conflicts.');
tz_def('LOGIN_TO', 'Log in to '.SERVER_NAME);
tz_def('REGIN_TO', 'Register in '.SERVER_NAME);
tz_def('P_ONLINE', 'Players online: ');
tz_def('P_TOTAL', 'Players in total: ');
tz_def('CHOOSE', 'Please choose a server.');
tz_def('STARTED', ' The server started '. round((time() - COMMENCE) / 86400) .' days ago.');

//ANMELDEN.php
tz_def('NICKNAME', 'Nickname');
tz_def('EMAIL', 'Email');
tz_def('PASSWORD', 'Password');
tz_def('NW', 'North West');
tz_def('NE', 'North East');
tz_def('SW', 'South West');
tz_def('SE', 'South East');
tz_def('RANDOM', 'random');
tz_def('ACCEPT_RULES', ' I accept the game rules and general terms and conditions.');
tz_def('ONE_PER_SERVER', 'Each player may only own ONE account per server.');
tz_def('BEFORE_REGISTER', 'Before you register an account you should read the <a href="/anleitung.php" target="_blank">instructions</a> of Travian ro1 to see the specific advantages and disadvantages of the three tribes.');
tz_def('BUILDING_UPGRADING', 'Building:');
tz_def('HOURS', 'hours');


//ATTACKS ETC.
tz_def('TROOP_MOVEMENTS', 'Troop Movements:');
tz_def('ARRIVING_REINF_TROOPS', 'Arriving reinforcing troops');
tz_def('ARRIVING_ATTACKING_TROOPS', 'Arriving attacker troops');
tz_def('ARRIVING_REINF_TROOPS_SHORT', 'Reinf.');
tz_def('OWN_ATTACKING_TROOPS', 'Own attacking troops');
tz_def('ATTACK', 'Attack');
tz_def('OWN_REINFORCING_TROOPS', 'Own reinforcing troops');
tz_def('NEWVILLAGE', 'New village.');
tz_def('FOUNDNEWVILLAGE', 'Founding New village');
tz_def('UNDERATTACK', 'The village is under attack');
tz_def('OASISATTACK', 'The Oasis is under attack');
tz_def('OASISATTACKS', 'Oasis Att.');
tz_def('RETURNFROM', 'Return from');
tz_def('REINFORCEMENTFOR', 'Reinforcement to');
tz_def('ATTACK_ON', 'Attack to');
tz_def('RAID_ON', 'Raid to');
tz_def('SCOUTING', 'Scouting');
tz_def('PRISONERS', 'Prisoners');
tz_def('PRISONERSIN', 'Prisoners in');
tz_def('PRISONERSFROM', 'Prisoners from');
tz_def('TROOPS', 'Troops');
tz_def('BOUNTY', 'Bounty');
tz_def('ARRIVAL', 'Arrival');
tz_def('CATAPULT_TARGET', 'Catapult target(s)');
tz_def('INCOMING_TROOPS', 'Incoming Troops');
tz_def('TROOPS_ON_THEIR_WAY', 'Troops on their way');
tz_def('OWN_TROOPS', 'Own troops');
tz_def('ON', 'on');
tz_def('AT', 'at');
tz_def('UPKEEP', 'Upkeep');
tz_def('SEND_BACK', 'Send back');
tz_def('TROOPS_IN_THE_VILLAGE', 'Troops in the village');
tz_def('TROOPS_IN_OTHER_VILLAGE', 'Troops in other village');
tz_def('TROOPS_IN_OASIS', 'Troops in oasis');
tz_def('KILL', 'Kill');
tz_def('FROM', 'From');
tz_def('SEND_TROOPS', 'Send troops');
tz_def('TASKMASTER', 'Taskmaster');
tz_def('TO_THE_TASK', 'To the task');
tz_def('VILLAGE_OF_THE_ELDERS', 'village of the elders');
tz_def('VILLAGE_OF_THE_ELDERS_TROOPS', 'village of the elders troops');

//SEND TROOP
tz_def('REINFORCE', 'Reinforcement');
tz_def('NORMALATTACK', 'Normal Attack');
tz_def('RAID', 'Raid');
tz_def('OR', 'or');
tz_def('SENDTROOP', 'Send troops');
tz_def('NOTROOP', 'no troops');

//map
tz_def('DETAIL', 'Details');
tz_def('ABANDVALLEY', 'Abandoned valley');
tz_def('OCCUPIED', 'Occupied');
tz_def('UNOCCUPIED', 'Unoccupied');
tz_def('UNOCCUOASIS', 'Unoccupied oasis');
tz_def('OCCUOASIS', 'Occupied oasis');
tz_def('THERENOINFO', 'There is no<br>information available.');
tz_def('LANDDIST', 'Land distribution');
tz_def('TRIBE', 'Tribe');
tz_def('ALLIANCE', 'Alliance');
tz_def('POP', 'Population');
tz_def('REPORT', 'Report');
tz_def('OPTION', 'Options');
tz_def('CENTREMAP', 'Centre map');
tz_def('FNEWVILLAGE', 'Found new village');
tz_def('CULTUREPOINT', 'culture points');
tz_def('BUILDRALLY', 'build a rally point');
tz_def('SETTLERSAVAIL', 'settlers available');
tz_def('BEGINPRO', 'beginners protection');
tz_def('SENDMERC', 'Send merchant(s)');
tz_def('BAN', 'Player is banned');
tz_def('BUILDMARKET', 'Build marketplace');
tz_def('PERHOUR', 'per hour');
tz_def('BONUS', 'Bonus');
tz_def('MAP', 'Map');
tz_def('LARGE_MAP', 'Large Map');
tz_def('LARGE_MAP_DESC', 'Show the large map in an extra window');
tz_def('CROPFINDER', 'Crop Finder');
tz_def('NORTH', 'North');
tz_def('EAST', 'East');
tz_def('SOUTH', 'South');
tz_def('WEST', 'West');
tz_def('CLOSE_MAP', 'Close Map');
tz_def('AND', 'and');

//other
tz_def('VILLAGE', 'Village');
tz_def('STATISTICS', 'Statistics');
tz_def('OASIS', 'Oasis');
tz_def('NO_OASIS', 'You do not own any oases.');
tz_def('NO_VILLAGES', 'There are no villages.');
tz_def('PLAYER', 'Player');

//LOGIN.php
tz_def('COOKIES', 'You must have cookies enabled to be able to log in. If you share this computer with other people you should log out after each session for your own safety.');
tz_def('NAME', 'Name');
tz_def('PW_FORGOTTEN', 'Password forgotten?');
tz_def('PW_REQUEST', 'Then you can request a new one which will be sent to your email address.');
tz_def('PW_GENERATE', 'Generate new password.');
tz_def('EMAIL_NOT_VERIFIED', 'Email not verified!');
tz_def('EMAIL_FOLLOW', 'Follow this link to activate your account.');
tz_def('VERIFY_EMAIL', 'Verify Email.');
tz_def('SERVER_STARTS_IN', 'Server will start in: ');
tz_def('START_NOW', 'START NOW');


//404.php
tz_def('NOTHING_HERE', 'Nothing here!');
tz_def('WE_LOOKED', 'We looked 404 times already but can`t find anything');

//MASSMESSAGE.php
tz_def('MASS', 'Message Content');
tz_def('MASS_SUBJECT', 'Subject:');
tz_def('MASS_COLOR', 'Message color:');
tz_def('MASS_REQUIRED', 'All fields required');
tz_def('MASS_UNITS', 'Images (units):');
tz_def('MASS_SHOWHIDE', 'Show/Hide');
tz_def('MASS_READ', 'Read this: after adding smilie, you have to add left or right after number otherwise image will won`t work');
tz_def('MASS_CONFIRM', 'Confirmation');
tz_def('MASS_REALLY', 'Do you really want to send MassIGM?');
tz_def('MASS_ABORT', 'Aborting right now');
tz_def('MASS_SENT', 'Mass IGM was sent');

//BUILDINGS
tz_def('WOODCUTTER', 'Woodcutter');
tz_def('WOODCUTTER_DESC', 'The woodcutter cuts down trees in order to produce lumber. The further you extend the woodcutter, the more lumber is produced.<br>By constructing a sawmill, you can further increase the production');
tz_def('CLAYPIT', 'Clay Pit');
tz_def('CLAYPIT_DESC', 'Here, clay is produced. By increasing its level, you increase clay production.<br>By constructing a brickyard, you can further increase the production');
tz_def('IRONMINE', 'Iron Mine');
tz_def('IRONMINE_DESC', 'Here, miners gather the precious resource of iron. By increasing the mine`s level, you increase its iron production.<br>By constructing an iron foundry, you can further increase the production');
tz_def('CROPLAND', 'Cropland');
tz_def('CROPLAND_DESC', 'Your population`s food is produced here. By increasing the cropland`s level, you increase crop production.<br>By constructing a grain mill and a bakery, you can further increase the production');

tz_def('SAWMILL', 'Sawmill');
tz_def('SAWMILL_DESC', 'Lumber cut by your woodcutters is processed here. The Sawmill boosts wood production in the village. At Level 1, it increases wood production by 5%, and every time you upgrade it, the production is increased by 5% more, for a total of 25% after 5 levels.<br>The bonus from the Sawmill and all buildings providing resource bonuses only apply to the village in which the building is built.<br>Note that the Sawmill bonus does not apply to other bonus effects such as Oasis income or the 10% PLUS bonus.<br>There are also villages consisting of 3 or 5 wood fields. The more fields in a village, more the Sawmill levels can be efficiently');
tz_def('CURRENT_WOOD_BONUS', 'Current wood bonus:');
tz_def('WOOD_BONUS_LEVEL', 'Wood bonus at level');
tz_def('MAX_LEVEL', 'Building already at max level');
tz_def('PERCENT', 'Percent');

tz_def('BRICKYARD', 'Brickyard');
tz_def('CURRENT_CLAY_BONUS', 'Current clay bonus:');
tz_def('CLAY_BONUS_LEVEL', 'Clay bonus at level');
tz_def('BRICKYARD_DESC', 'Clay converts into bricks here. The Brickyard boosts clay production in the village. At Level 1, it increases clay production by 5%, and every time you upgrade it, the production is increased by 5% more, for a total of 25% after 5 levels.<br>The bonus from the Brickyard and all buildings providing resource bonuses only apply to the village in which the building is built.<br>Note that the Brickyard bonus does not apply to other bonus effects such as Oasis income or the 10% PLUS bonus.<br>There are also villages consisting of 3 or 5 clay fields. The more fields in a village, more the Brickyard levels can be efficiently');

tz_def('IRONFOUNDRY', 'Iron Foundry');
tz_def('CURRENT_IRON_BONUS', 'Current iron bonus:');
tz_def('IRON_BONUS_LEVEL', 'Iron bonus at level');
tz_def('IRONFOUNDRY_DESC', 'Iron melts here. The Iron Foundry boosts iron production in the village. At Level 1, it increases iron production by 5%, and every time you upgrade it, the production is increased by 5% more, for a total of 25% after 5 levels.<br>The bonus from the Iron Foundry and all buildings providing resource bonuses only apply to the village in which the building is built.<br>Note that the Iron Foundry bonus does not apply to other bonus effects such as Oasis income or the 10% PLUS bonus.<br>There are also villages consisting of 3 or 5 iron fields. The more fields in a village, more the Iron Foundry levels can be efficiently');

tz_def('GRAINMILL', 'Grain Mill');
tz_def('CURRENT_CROP_BONUS', 'Current crop bonus:');
tz_def('CROP_BONUS_LEVEL', 'Crop bonus at level');
tz_def('GRAINMILL_DESC', 'Grain grinds into flour here. The Grain Mill boosts food production in the village. At Level 1, it increases food production by 5%, and every time you upgrade it, the production is increased by 5% more, for a total of 25% after 5 levels.<br>Use in conjunction with the Bakery for an overall crop production increase of up to 50%.<br>The bonus from the Grain Mill and all buildings providing resource bonuses only apply to the village in which the building is built.<br>Note that the Grain Mill bonus does not apply to other bonus effects such as Oasis income or the 10% PLUS bonus.<br>There are also villages consisting of 9 or 15 crop fields. The more fields in a village, more the Grain Mill levels can be efficiently');

tz_def('BAKERY', 'Bakery');
tz_def('BAKERY_DESC', 'Bread bakes from flour here. The Bakery boosts food production in the village. At Level 1, it increases food production by 5%, and every time you upgrade it, the production is increased by 5% more, for a total of 25% after 5 levels.<br>When used in conjunction with the Grain Mill it can increase crop production by up to 50%.<br>The bonus from the Bakery and all buildings providing resource bonuses only apply to the village in which the building is built.<br>Note that the Bakery bonus does not apply to other bonus effects such as Oasis income or the 10% PLUS bonus.<br>There are also villages consisting of 9 or 15 crop fields. The more fields in a village, more the Bakery levels can be efficiently');

tz_def('WAREHOUSE', 'Warehouse');
tz_def('CURRENT_CAPACITY', 'Current capacity:');
tz_def('CAPACITY_LEVEL', 'Capacity at level');
tz_def('RESOURCE_UNITS', 'Resource units');
tz_def('WAREHOUSE_DESC', 'The resources lumber, clay and iron are stored in the warehouse. By increasing its level, you increase your warehouse`s capacity. Can be built multiple times, once one is built to max level');

tz_def('GRANARY', 'Granary');
tz_def('CROP_UNITS', 'Crop units');
tz_def('GRANARY_DESC', 'The crop produced on your farms is stored in the granary. By increasing its level, you increase the granary`s capacity. Can be built multiple times, once one is built to max level');

tz_def('BLACKSMITH', 'Blacksmith');
tz_def('ACTION', 'Action');
tz_def('UPGRADE', 'Upgrade');
tz_def('UPGRADE_IN_PROGRESS', 'Upgrade in<br>progress');
tz_def('UPGRADE_BLACKSMITH', 'Upgrade<br>blacksmith');
tz_def('UPGRADES_COMMENCE_BLACKSMITH', 'Upgrades can commence when blacksmith is completed.');
tz_def('MAXIMUM_LEVEL', 'Maximum<br>level');
tz_def('EXPAND_WAREHOUSE', 'Expand<br>warehouse');
tz_def('EXPAND_GRANARY', 'Expand<br>granary');
tz_def('ENOUGH_RESOURCES', 'Enough resources');
tz_def('CROP_NEGATIVE ', 'Crop production is negative so you will never reach the required resources');
tz_def('TOO_FEW_RESOURCES', 'Too few<br>resources');
tz_def('UPGRADING', 'Upgrading');
tz_def('DURATION', 'Duration');
tz_def('COMPLETE', 'Complete');
tz_def('BLACKSMITH_DESC', 'The weapons of your warriors are enhanced in the blacksmith`s melting furnaces. By increasing its level, you can order the fabrication of even better weapons');

tz_def('ARMOURY', 'Armoury');
tz_def('UPGRADE_ARMOURY', 'Upgrade<br>Armoury');
tz_def('UPGRADES_COMMENCE_ARMOURY', 'Upgrades can commence when armoury is completed.');
tz_def('ARMOURY_DESC', 'The armor of your warriors are enhanced in the armoury`s melting furnaces. By increasing its level, you can order the fabrication of even better armor');

tz_def('TOURNAMENTSQUARE', 'Tournament Square');
tz_def('CURRENT_SPEED', 'Current speed bonus:');
tz_def('SPEED_LEVEL', 'Speed bonus at level');
tz_def('TOURNAMENTSQUARE_DESC', 'Your troops can increase their stamina at the Tournament Square. The further the building is upgraded, the faster your troops are beyond a minimum distance of '.TS_THRESHOLD.' squares');

tz_def('MAINBUILDING', 'Main Building');
tz_def('CURRENT_CONSTRUCTION_TIME', 'Current construction time:');
tz_def('CONSTRUCTION_TIME_LEVEL', 'Construction time at level');
tz_def('DEMOLITION_BUILDING', 'Demolition of the building:</h2><p>If you no longer need a building, you can order the demolition of the building.</p>');
tz_def('DEMOLISH', 'Demolish');
tz_def('DEMOLITION_OF', 'Demolition of ');
tz_def('MAINBUILDING_DESC', 'The village`s master builders live in the main building. The higher its level the faster your master builders complete the construction of new buildings.');

tz_def('RALLYPOINT', 'Rally Point');
tz_def('RALLYPOINT_COMMENCE', 'Troops movement will be displayed when the '.RALLYPOINT.' is completed');
tz_def('OVERVIEW', 'Overview');
tz_def('REINFORCEMENT', 'Reinforcement');
tz_def('EVASION_SETTINGS', 'evasion settings');
tz_def('SEND_TROOPS_AWAY_MAX', 'Send troops away a maximum of');
tz_def('TIMES', 'times');
tz_def('PER_EVASION', 'per evasion');
tz_def('RALLYPOINT_DESC', 'Your village`s troops gather here. From here, you can send them out to conquer, raid or reinforce other villages.<br>If there are less attacking units than the level of the rally point, you can see the type of unit attacking.');
tz_def('COMBAT_SIMULATOR', 'Combat Simulator');

tz_def('MARKETPLACE', 'Marketplace');
tz_def('MERCHANT', 'Merchants');
tz_def('OR_', 'or');
tz_def('GO', 'go');
tz_def('UNITS_OF_RESOURCE', 'units of resource');
tz_def('MERCHANT_CARRY', 'Each merchant can carry');
tz_def('MERCHANT_COMING', 'Merchants coming');
tz_def('TRANSPORT_FROM', 'Transport from');
tz_def('ARRIVAL_IN', 'Arrival in');
tz_def('NO_COORDINATES_SELECTED', 'No Coordinates selected');
tz_def('CANNOT_SEND_RESOURCES', 'You cannot send resources to the same village');
tz_def('BANNED_CANNOT_SEND_RESOURCES', 'Player is Banned. You cannot send resources to him');
tz_def('RESOURCES_NO_SELECTED', 'Resources not selected');
tz_def('ENTER_COORDINATES', 'Enter coordinates or village name');
tz_def('TOO_FEW_MERCHANTS', 'Too few merchants');
tz_def('OWN_MERCHANTS_ONWAY', 'Own merchants on the way');
tz_def('MERCHANTS_RETURNING', 'Merchants returning');
tz_def('TRANSPORT_TO', 'Transport to');
tz_def('I_AN_SEARCHING', 'I`m searching');
tz_def('I_AN_OFFERING', 'I`m offering');
tz_def('OFFERS_MARKETPLACE', 'Offers at the marketplace');
tz_def('NO_AVAILABLE_OFFERS', 'No offers at the marketplace');
tz_def('OFFERED_TO_ME', 'Offered<br>to me');
tz_def('WANTED_TO_ME', 'Wanted<br>from me');
tz_def('NOT_ENOUGH_MERCHANTS', 'Not Enough Merchant');
tz_def('ACCEP_OFFER', 'Accept offer');
tz_def('NO_AVALIBLE_OFFERS', 'There are no avaliable offers on the market');
tz_def('SEARCHING', 'Searching');
tz_def('OFFERING', 'Offering');
tz_def('MAX_TIME_TRANSPORT', 'max. time of transport');
tz_def('OWN_ALLIANCE_ONLY', 'own alliance only');
tz_def('INVALID_OFFER', 'Invalid offer');
tz_def('INVALID_MERCHANTS_REPETITION', 'Invalid merchants repetition rate');
tz_def('USER_ON_VACATION', 'Player is on vacation mode');
tz_def('VACATION_MODE', 'Vacation mode');
tz_def('VACATION_DESC', 'If you plan on being away for an extended period of time and do not wish to set a sitter, you can set your account to Holiday Mode. During this time your account will stop produceing resource, CP, research, trops, etc, and stop receiving attacks, reinforcements, raid, essentially freezing your account. Remember, this just freezes your Travian, not time. If you are a member of Gold Club it will run out during this time and if you have automatic renewal selected, the automatic renewal feature will be cancelled while in Holiday Mode. Please Note you must set min of 2 days vaction mode and NO MORE THEN 14 days');
tz_def('VACATION_DESC2', 'Use vacation mode to protect your villages during you are away.<br>During the vacation will be inactive next actions:');
tz_def('VAC_OP1', 'Send or receive troops');
tz_def('VAC_OP2', 'Start new construction order');
tz_def('VAC_OP3', 'Use market');
tz_def('VAC_OP4', 'Train new troops');
tz_def('VAC_OP5', 'Join to an alliance');
tz_def('VAC_OP6', 'Delete account');
tz_def('VAC_COND1', 'No troops in movement');
tz_def('VAC_COND2', 'No troops on way to other villages');
tz_def('VAC_COND3', 'No troops send to reinforcements other villages');
tz_def('VAC_COND4', 'No player have reinforcements on your villages');
tz_def('VAC_COND5', 'Do not have Wonder World');
tz_def('VAC_COND6', 'Do not have any artefacts');
tz_def('VAC_COND7', 'You are no longer in player protections');
tz_def('VAC_COND8', 'Do not have any troops in your traps');
tz_def('VAC_COND9', 'Your account is not in deletion process');
tz_def('NOT_ENOUGH_RESOURCES', 'Not enough resources');
tz_def('OFFER', 'Offer');
tz_def('SEARCH', 'Search');
tz_def('OWN_OFFERS', 'Own offers');
tz_def('ALL', 'All');
tz_def('NPC_TRADE', 'NPC Trade');
tz_def('SUM', 'Sum');
tz_def('REST', 'Rest');
tz_def('TRADE_RESOURCES', 'Trade resources at (step 2 of 2');
tz_def('DISTRIBUTE_RESOURCES', 'Distribute resources at (step 1 of 2)');
tz_def('OF', 'of');
tz_def('NPC_COMPLETED', 'NPC completed');
tz_def('BACK_BUILDING', 'Back to building');
tz_def('YOU_CAN_NAT_NPC_WW', 'You can`t use NPC trade in WW village.');
tz_def('NPC_TRADING', 'NPC trading');
tz_def('SEND_RESOURCES', 'Send Resources');
tz_def('BUY', 'Buy');
tz_def('TRADE_ROUTES', 'Trade routes');
tz_def('DESCRIPTION', 'Description');
tz_def('G_DESCR', 'General description');
tz_def('TIME_LEFT', 'Time left');
tz_def('START', 'Start');
tz_def('NO_TRADE_ROUTES', 'No active trade routes');
tz_def('TRADE_ROUTE_TO', 'Trade route to');
tz_def('CHECKED', 'checked');
tz_def('DAYS', 'days');
tz_def('EXTEND', 'Extend');
tz_def('EDIT', 'Edit');
tz_def('EXTEND_TRADE_ROUTES', 'Extend the trade route by <b>7</b> days for');
tz_def('CREATE_TRADE_ROUTES', 'Create new trade route');
tz_def('DELIVERIES', 'Deliveries');
tz_def('START_TIME_TRADE', 'Start time');
tz_def('CREATE_TRADE_ROUTE', 'Create trade route');
tz_def('TARGET_VILLAGE', 'Target village');
tz_def('EDIT_TRADE_ROUTES', 'Edit trade route');
tz_def('TRADE_ROUTES_DESC', 'Trade route allows you to set up routes for your merchant that he will walk every day at a certain hour. <br><br> Standard this holds on for <b>7</b> days, but you can extend it with <b>7</b> days for the cost of');
tz_def('NPC_TRADE_DESC', 'With the NPC merchant you can distribute the resources in your warehouse as you desire. <br><br> The first line shows the current stock. In the second line you can choose another distribution. The third line shows the difference between the old and new stock.');
tz_def('MARKETPLACE_DESC', 'At the marketplace, you can trade resources with other players. The higher its level, the more resources can be transported by your merchants at the same time');

tz_def('EMBASSY', 'Embassy');
tz_def('TAG', 'Tag');
tz_def('TO_THE_ALLIANCE', 'to the alliance');
tz_def('JOIN_ALLIANCE', 'join alliance');
tz_def('REFUSE', 'refuse');
tz_def('ACCEPT', 'accept');
tz_def('NO_INVITATIONS', 'There are no invitations available.');
tz_def('NO_CREATE_ALLIANCE', 'Banned player can`t create an alliance.');
tz_def('FOUND_ALLIANCE', 'found alliance');
tz_def('EMBASSY_DESC', 'The embassy is a place for diplomats. At level 1 you can join an alliance, and after extending it to level 3 you may even found one yourself.<br>The maximum number of members in an alliance is 60');

tz_def('BARRACKS', 'Barracks');
tz_def('QUANTITY', 'Quantity');
tz_def('MAX', 'Max');
tz_def('TRAINING', 'Training');
tz_def('FINISHED', 'Finished');
tz_def('UNIT_FINISHED', 'The next unit will be finished in');
tz_def('AVAILABLE', 'Available');
tz_def('TRAINING_COMMENCE_BARRACKS', 'Training can commence when barracks is completed.');
tz_def('BARRACKS_DESC', 'Infantry can be trained in the barracks. The higher its level, the faster the troops are trained');

tz_def('STABLE', 'Stable');
tz_def('AVAILABLE_ACADEMY', 'No units available. Research at academy');
tz_def('TRAINING_COMMENCE_STABLE', 'Training can commence when stable is completed.');
tz_def('STABLE_DESC', 'Cavalry can be trained in the stable. The higher its level, the faster the troops are trained');

tz_def('WORKSHOP', 'Workshop');
tz_def('TRAINING_COMMENCE_WORKSHOP', 'Training can commence when workshop is completed.');
tz_def('WORKSHOP_DESC', 'Siege engines, like catapults and rams, can be built in the workshop. The higher its level, the faster these units are produced');

tz_def('ACADEMY', 'Academy');
tz_def('RESEARCH_AVAILABLE', 'There are no researches available');
tz_def('RESEARCH_COMMENCE_ACADEMY', 'Research can commence when academy is completed.');
tz_def('RESEARCH', 'Research');
tz_def('EXPAND_WAREHOUSE1', 'Expand warehouse');
tz_def('EXPAND_GRANARY1', 'Expand granary');
tz_def('RESEARCH_IN_PROGRESS', 'Research in<br>progress');
tz_def('RESEARCHING', 'Researching');
tz_def('PREREQUISITES', 'Prerequisites');
tz_def('SHOW_MORE', 'show more');
tz_def('HIDE_MORE', 'hide more');
tz_def('ACADEMY_DESC', 'New unit types can be researched in the academy. By increasing its level, you can order the research of better units');

tz_def('CRANNY', 'Cranny');
tz_def('CURRENT_HIDDEN_UNITS', 'Currently hidden units per resource:');
tz_def('HIDDEN_UNITS_LEVEL', 'Hidden units per resource at level');
tz_def('UNITS', 'units');
tz_def('CRANNY_DESC', 'The cranny hides some of your resources in case the village gets attacked. These resources cannot get stolen.<br>At level 1 the cranny can hold '.(100*((int)CRANNY_CAPACITY)).' of each resource. The capacity of Gallic crannies is 1.5 times larger.<br>If a Teutonic hero attacks a village, crannies can hide only 80% of their normal capacity');

tz_def('TOWNHALL', 'Town Hall');
tz_def('CELEBRATIONS_COMMENCE_TOWNHALL', 'Celebrations can commence when the town hall is completed.');
tz_def('GREAT_CELEBRATIONS', 'Great celebration');
tz_def('CULTURE_POINTS', 'Culture points');
tz_def('HOLD', 'hold');
tz_def('CELEBRATIONS_IN_PROGRESS', 'Celebration<br>in progress');
tz_def('CELEBRATIONS', 'Celebrations');
tz_def('TOWNHALL_DESC', 'In the town hall, you can hold pompous celebrations. Such a celebration increases your culture points.<br>Culture points are necessary to found or conquer new villages. Each building produces culture points and the higher its level, the more culture points it produces');

tz_def('RESIDENCE', 'Residence');
tz_def('CAPITAL', 'This is your capital');
tz_def('RESIDENCE_TRAIN_DESC', 'In order to found a new village you need a level 10 or 20 residence and 3 settlers. In order to conquer a new village you need a level 10 or 20 residence and a senator, chief or chieftain.');
tz_def('PRODUCTION_POINTS', 'Production of this village:');
tz_def('PRODUCTION_ALL_POINTS', 'Production of all villages:');
tz_def('POINTS_DAY', 'Culture points per day');
tz_def('VILLAGES_PRODUCED', 'Your villages have produced');
tz_def('POINTS_NEED', 'points in total. To found or conquer a new village you need');
tz_def('POINTS', 'points');
tz_def('INHABITANTS', 'Inhabitants');
tz_def('COORDINATES', 'Coordinates');
tz_def('EXPANSION', 'Expansion');
tz_def('TRAIN', 'Train');
tz_def('DATE', 'Date');
tz_def('CONQUERED_BY_VILLAGE', 'Villages founded or conquered by this village');
tz_def('NONE_CONQUERED_BY_VILLAGE', 'No other village has been founded or conquered by this village yet.');
tz_def('RESIDENCE_CULTURE_DESC', 'In order to extend your empire you need culture points. These culture points increase in the course of time and do so faster as your building levels increase.');
tz_def('RESIDENCE_LOYALTY_DESC', 'By attacking with senators, chiefs or chieftains a village`s loyalty can be brought down. If it reaches zero, the village joins the realm of the attacker. The loyalty of this village is currently at ');
tz_def('RESIDENCE_DESC', 'The Residence protects the village against enemy conquests. You can build one residence per village. Units that can found a new village or conquer existing villages can be trained here.<br>Additionally, the residence provides an expansion slot at levels 10 and 20 each');

tz_def('PALACE', 'Palace');
tz_def('PALACE_CONSTRUCTION', 'Palace under construction');
tz_def('PALACE_TRAIN_DESC', 'In order to found a new village you need a level 10, 15 or 20 palace and 3 settlers. In order to conquer a new village you need a level 10, 15 or 20 palace and a senator, chief or chieftain.');
tz_def('CHANGE_CAPITAL', 'change capital');
tz_def('SECURITY_CHANGE_CAPITAL', 'Are you sure, that you want to change your capital?<br><b>You can`t undo this!</b><br>For security you must enter your password to confirm:<br>');
tz_def('PALACE_DESC', 'The palace building is unique. You can only build one in your whole realm and you can proclaim that village as your capital. It also protects the village against enemy conquests. Units that can found a new village or conquer existing villages can be trained here.<br>Additionally, the palace provides an expansion slot at levels 10, 15 and 20 each');

tz_def('TREASURY', 'Treasury');
tz_def('TREASURY_COMMENCE', 'Artefacts can be viewed when treasury is completed.');
tz_def('ARTEFACTS_AREA', 'Artefacts in your area');
tz_def('NO_ARTEFACTS_AREA', 'There are no artefacts in your area.');
tz_def('OWN_ARTEFACTS', 'Own artefacts');
tz_def('CONQUERED', 'Conquered');
tz_def('DISTANCE', 'Distance');
tz_def('EFFECT', 'Effect');
tz_def('ACCOUNT', 'Account');
tz_def('SMALL_ARTEFACTS', 'Small artefacts');
tz_def('LARGE_ARTEFACTS', 'Large artefacts');
tz_def('NO_ARTEFACTS', 'There are no artefacts.');
tz_def('ANY_ARTEFACTS', 'You do not own any artefacts.');
tz_def('OWNER', 'Owner');
tz_def('AREA_EFFECT', 'Area of effect');
tz_def('VILLAGE_EFFECT', 'Village effect');
tz_def('ACCOUNT_EFFECT', 'Account effect');
tz_def('UNIQUE_EFFECT', 'Unique effect');
tz_def('REQUIRED_LEVEL', 'Required level');
tz_def('TIME_CONQUER', 'Time of conquer');
tz_def('TIME_ACTIVATION', 'Time of activation');
tz_def('NEXT_EFFECT', ' Next effect');
tz_def('FORMER_OWNER', 'Former owner(s)');
tz_def('BUILDING_STRONGER', 'Building stronger with');
tz_def('BUILDING_WEAKER', 'Building weaker with');
tz_def('TROOPS_FASTER', 'Makes troops faster with');
tz_def('TROOPS_SLOWEST', 'Makes troops slowest with');
tz_def('SPIES_INCREASE', 'Spies increase ability with');
tz_def('SPIES_DECRESE', 'Spies decrese ability with');
tz_def('CONSUME_LESS', 'All troops consume less with');
tz_def('CONSUME_HIGH', 'All troops consume high with');
tz_def('TROOPS_MAKE_FASTER', 'Troops make faster with');
tz_def('TROOPS_MAKE_SLOWEST', 'Troops make slowest with');
tz_def('YOU_CONSTRUCT', 'You can construct ');
tz_def('CRANNY_INCREASED', 'Cranny capacity is increased by');
tz_def('CRANNY_DECRESE', 'Cranny capacity is decrese by');
tz_def('WW_BUILDING_PLAN', 'You can build the Wonder of the World');
tz_def('NO_WW', 'There are no Wonders of the World');
tz_def('NO_PREVIOUS_OWNERS', 'There are no previous owners.');
tz_def('TREASURY_DESC', 'The riches of your empire are kept in the treasury. A treasury can only store one artefact at a time.<br>You need a treasury at level 10 for a small artefact, or level 20 for a great one');

tz_def('TRADEOFFICE', 'Trade Office');
tz_def('CURRENT_MERCHANT', 'Current merchant load:');
tz_def('MERCHANT_LEVEL', 'Merchant load at level');
tz_def('TRADEOFFICE_DESC', 'In the trade office, the merchants carts get improved and equipped with more powerful horses. The higher its level, the more your merchants are able to carry');

tz_def('GREATBARRACKS', 'Great Barracks');
tz_def('TRAINING_COMMENCE_GREATBARRACKS', 'Training can commence when great barracks is completed.');
tz_def('GREATBARRACKS_DESC', 'The Great Barracks allows you to build a second Barracks in the same village, but the troops cost 3 times the original amount.<br>Combined with the regular Barracks, you can train your troops twice as fast in one village');

tz_def('GREATSTABLE', 'Great Stable');
tz_def('TRAINING_COMMENCE_GREATSTABLE', 'Training can commence when great stable is completed.');
tz_def('GREATSTABLE_DESC', 'The Great Stable allows you to build a second Stable in the same village, but the troops cost 3 times the original amount.<br>Combined with the regular Stable, you can train your troops twice as fast in one village');

tz_def('CITYWALL', 'City Wall');
tz_def('DEFENCE_NOW', 'Defence Bonus now:');
tz_def('DEFENCE_LEVEL', 'Defence Bonus at level');
tz_def('CITYWALL_DESC', 'Provides a defense bonus for your troops (((1.03 ^ level) * 100)% + 10) defensive points per level to the basic defensive value for a village. The higher level Wall will give your troops a higher defence bonus.<br>Tribe-specific: Romans only');

tz_def('EARTHWALL', 'Earth Wall');
tz_def('EARTHWALL_DESC', 'Provides a defense bonus for your troops (((1.02 ^ level) * 100)% + 6) defensive points per level to the basic defensive value for a village. A higher level Earth Wall will give your troops a higher defence bonus.<br>Tribe-specific: Teutons only');

tz_def('PALISADE', 'Palisade');
tz_def('PALISADE_DESC', 'Provides a defense bonus for your troops (((1.025 ^ level) * 100)% + 8) defensive points per level to the basic defensive value for a village. A higher level Palisade will give your troops a higher defence bonus.<br>Tribe-specific: Gauls only');

tz_def('STONEMASON', 'Stonemason`s Lodge');
tz_def('CURRENT_STABILITY', 'Current stability bonus:');
tz_def('STABILITY_LEVEL', 'Stability bonus at level');
tz_def('STONEMASON_DESC', 'The Stonemason is an expert it cutting stone. The higher the level of the Stonemason`s Lodge, the greater the stability of your village`s buildings. For each level this building will increase durability by 10% for a maximum of 200% durability for your buildings.<br>This building can only be built in an accounts Capital');

tz_def('BREWERY', 'Brewery');
tz_def('CURRENT_BONUS', 'Current bonus:');
tz_def('BONUS_LEVEL', 'Bonus at level');
tz_def('BREWERY_DESC', 'Tasty mead is brewed here.Drinks make your soldiers braver and stronger when attacking others (1% per Brewery level). Unfortunately, the persuasive power of leaders is reduced by 50% and catapults can only make random hits. Can only be built in the capital, but affects all your villages. The mead-festivals always last 72 hours.<br>Tribe-specific: Teutons only');

tz_def('TRAPPER', 'Trapper');
tz_def('CURRENT_TRAPS', 'Currect maximum traps to train:');
tz_def('TRAPS_LEVEL', 'Maximum traps to train at level');
tz_def('TRAPS', 'Traps');
tz_def('TRAP', 'Trap');
tz_def('CURRENT_HAVE', 'You currently have');
tz_def('WHICH_OCCUPIED', 'of which are occupied.');
tz_def('TRAINING_COMMENCE_TRAPPER', 'Training can commence when trapper is completed.');
tz_def('TRAPPER_DESC', 'The trapper protects your village with well hidden traps. This means that unwary enemies can be imprisoned and won`t be able to harm your village any more.<br>Troops cannot be freed with a raid. If the owner of the traps release the captives all of the traps will be repaired automatically.<br>Tribe-specific: Gauls only');

tz_def("HEROSMANSION", "Hero's Mansion");
tz_def('HERO_READY', 'Hero will be ready in ');
tz_def('NAME_CHANGED', 'Hero name has been changed');
tz_def('NOT_UNITS', 'Not available units');
tz_def('NOT', 'Not ');
tz_def('TRAIN_HERO', 'Train New Hero');
tz_def('REVIVE', 'Revive');
tz_def('OASES', 'Oases');
tz_def('DELETE', 'Delete');
tz_def('RESOURCES', 'Resources');
tz_def('OFFENCE', 'Offence');
tz_def('DEFENCE', 'Defence');
tz_def('OFF_BONUS', 'Off-Bonus');
tz_def('DEF_BONUS', 'Def-Bonus');
tz_def('REGENERATION', 'Regeneration');
tz_def('DAY', 'Day');
tz_def('EXPERIENCE', 'Experience');
tz_def('YOU_CAN', 'You can ');
tz_def('RESET', 'reset');
tz_def('YOUR_POINT_UNTIL', ' your points until you are level ');
tz_def('OR_LOWER', ' or lower!');
tz_def('YOUR_HERO_HAS', 'Your hero has ');
tz_def('OF_HIT_POINTS', 'of his life points');
tz_def('ERROR_NAME_SHORT', 'Error: name too short');
tz_def('HEROSMANSION_DESC', 'The hero`s mansion is the home of your glorious hero.<br>At building levels 10, 15 and 20, you can use your hero to annex an unoccupied oasis to your village, one per each of these levels respectively. Depending on the oasis, you will get a production increase for a certain type of resource (or even two resources, from some oases)');

tz_def('GREATWAREHOUSE', 'Great Warehouse');
tz_def('GREATWAREHOUSE_DESC', 'The great warehouse has 3 times the capacity of a normal warehouse.<br>This building can only be built in wonder of the world villages or with a special Natarian artefact');

tz_def('GREATGRANARY', 'Great Granary');
tz_def('GREATGRANARY_DESC', 'The great granary has 3 times the capacity of a normal granary.<br>This building can only be built in wonder of the world villages or with a special Natarian artefact');

tz_def('WONDER', 'Wonder of the World');
tz_def('WORLD_WONDER', 'World Wonder');
tz_def('WONDER_DESC', 'A Wonder of the World (also known as WW) is as astonishing as it sounds. Every level costs a lot of resources. It is nearly impossible for a single player to build a WW on their own. The reason is that you not only need a lot of resources, but also the troops to protect your precious building.<br>To build WW you need an Ancient Construction Plan. You can get this by attacking a Natar Village with your hero. You need to have an empty level 10 treasury and your hero must survive. With those plan and an extremely high level of resources, you can start the world wonder.<br>Once it gets to level 50, you will need someone else in your alliance to have a second construction plan active. You cannot do it all by yourself.<br>Finishing a WW lvl 100, you will win the Travian server and its the end of a game world.<br>Once you finish, a message will come up telling who won and statistics. You can no longer build, but you can message people until the server restarts');
tz_def('WORLD_WONDER_CHANGE_NAME', 'You need to have World Wonder level 1 to be able to change its name');
tz_def('WORLD_WONDER_NAME', 'World Wonder name');
tz_def('WORLD_WONDER_NOTCHANGE_NAME', 'You can not change the name of the World Wonder after level 10');
tz_def('WORLD_WONDER_NAME_CHANGED', 'Name changed');

tz_def('HORSEDRINKING', 'Horse Drinking Trough');
tz_def('HORSEDRINKING_DESC', 'Decreases the training time and the upkeep of cavalry. It can also be built in Roman Wonder of the World villages.<br>Speeds up the training time of cavalry units by 1% per level and lowers the crop consumption of some units depending on its level.<br>Tribe-specific: Romans only');

tz_def('GREATWORKSHOP', 'Great Workshop');
tz_def('TRAINING_COMMENCE_GREATWORKSHOP', 'Training can commence when great workshop is completed.');
tz_def('GREATWORKSHOP_DESC', 'The Great Workshop allows you to build a second Workshop in the same village, but catapults and rams cost 3 times the original amount.<br>Combined with the regular Workshop, you can train your troops twice as fast in one village');

tz_def('BUILDING_MAX_LEVEL_UNDER', 'Building max level under construction');
tz_def('BUILDING_BEING_DEMOLISHED', 'Building presently being demolished');
tz_def('COSTS_UPGRADING_LEVEL', 'Costs</b> for upgrading to level');
tz_def('WORKERS_ALREADY_WORK', 'The workers are already at work.');
tz_def('CONSTRUCTING_MASTER_BUILDER', 'Constructing with master builder ');
tz_def('COSTS', 'Costs');
tz_def('WORKERS_ALREADY_WORK_WAITING', 'The workers are already at work. (waiting loop)');
tz_def('ENOUGH_FOOD_EXPAND_CROPLAND', 'Not enough food. Expand cropland.');
tz_def('UPGRADE_WAREHOUSE', 'Upgrade Warehouse');
tz_def('UPGRADE_GRANARY', 'Upgrade Granary');
tz_def('YOUR_CROP_NEGATIVE', 'Your crop production is negative, you will never get the required resources.');
tz_def('UPGRADE_LEVEL', 'Upgrade to level ');
tz_def('WAITING', '(waiting loop)');
tz_def('NEED_WWCONSTRUCTION_PLAN', 'Need WW construction plan');
tz_def('NEED_MORE_WWCONSTRUCTION_PLAN', 'Need more WW construction plan');
tz_def('CONSTRUCT_NEW_BUILDING', 'Construct new building');
tz_def('SHOWSOON_AVAILABLE_BUILDINGS', 'show soon available buildings');
tz_def('HIDESOON_AVAILABLE_BUILDINGS', 'hide soon available buildings');

// gold plus
tz_def('GOLD_SHOP', 'Gold Shop');
tz_def('PACKAGE_A', 'Package A');
tz_def('PACKAGE_B', 'Package B');
tz_def('PACKAGE_C', 'Package C');
tz_def('PACKAGE_D', 'Package D');
tz_def('PACKAGE_E', 'Package E');
tz_def('PAYMENT_METHOD', 'Payment Method');
tz_def('PACKAGES_NOT_REFUND', 'None of the packages are refundable');
tz_def('PLUS_FUNC', 'Plus function');
tz_def('REMAINING', 'Remaining');
tz_def('MINS', 'mins');
tz_def('ACTIVATE', 'Activate');
tz_def('TOO_LITTLE_GOLD', 'Too little gold');
tz_def('GOLD_ON', 'On'); // "attack on" and "gold feature on" can be not the same in different languages
tz_def('PLUS_END', 'Your PLUS advantage has ended');
tz_def('NPC', 'NPC');
tz_def('NO_GOLD', 'You currently don`t own gold');
tz_def('GOLD_CLUB', 'Gold Club');
tz_def('NOW', 'now');
tz_def('NPC_TRADE_GOLD', 'Trade with the NPC merchant');
tz_def('COMPLETE_CONSTRUCTION_R_GOLD', 'Complete construction orders and researches in this village now (does not work for Palace and Residence)');
tz_def('FOR_GAME_SERVER', 'Whole game round');
tz_def('HAVE_NO_INVITED', 'You have not brought in any new players yet');
tz_def('INVITE_FRIENDS_GOLD', 'Invite friends and receive free Gold');
tz_def('NEED_MORE_GOLD', 'You need more gold');
tz_def('ADD_PLUS_FAIL', 'Failed plus attempt');
tz_def('ADD_BONUS_LUMBER_FAIL', 'Failed lumber attempt');
tz_def('ADD_BONUS_CLAY_FAIL', 'Failed clay attempt');
tz_def('ADD_BONUS_IRON_FAIL', 'Failed iron attempt');
tz_def('ADD_BONUS_CROP_FAIL', 'Failed crop attempt');
tz_def('SELECT_GOLD_OPTION', 'Please select the option you wish to activate or extend');
tz_def('GET_NOW', 'Get Now');
tz_def('BUY_NOW', 'Buy Now');
tz_def('SELECT_REWARD', 'Select reward');
tz_def('VIP_ACCOUNT', 'VIP Account');
tz_def('USER_NOT_EXISTS', 'The account name you entered does not exist');
tz_def('STATUS_UPDATED', 'Your Status has been updated');

// profile
tz_def('PREFERENCES', 'Preferences');
tz_def('VACATION', 'Vacation');
tz_def('ACTIVATE_VACATION', 'Want to activate Vacation Mode');
tz_def('GRAPH_PACK', 'Graphic Pack');
tz_def('PLAYER_PROFILE', 'Player profile');
tz_def('CHANGE_PASSWORD', 'Change password');
tz_def('OLD_PASSWORD', 'Old password');
tz_def('NEW_PASSWORD', 'New password');
tz_def('CHANGE_EMAIL', 'Change email');
tz_def('CHANGE_EMAIL2', 'Please enter your old and your new e-mail addresses. You will then receive a code snippet at both e-mail addresses which you have to enter here');
tz_def('OLD_EMAIL', 'Old email');
tz_def('NEW_EMAIL', 'New email');
tz_def('ACCOUNT_SITTERS', 'Account sitters');
tz_def('ACCOUNT_SITTERS2', 'A sitter can log into your account by using your name and his/her password. You can have up to two sitters');
tz_def('SITTER_NAME', 'Name of the sitter');
tz_def('NO_SITTERS', 'You have no sitters');
tz_def('RM_SITTER', 'Remove sitter');
tz_def('YOU_ARE_SITTER', 'You have been entered as sitter on the following accounts. You can cancel this by clicking the red X');
tz_def('DELETE_ACCOUNT', 'Delete account');
tz_def('DELETE_ACCOUNT2', 'You can delete your account here. After starting the cancellation it will take three days to complete the cancellation of your account. You can cancel this process within the first 24 hours');
tz_def('YES', 'Yes');
tz_def('NO', 'No');
tz_def('CONFIRM_W_PASS', 'Confirm with password');
tz_def('MEDALS', 'Medals');
tz_def('PLAYER_HAS', 'This player has'); // bird 1
tz_def('HOURS_OF_BG_PROT', 'hours of beginners protection left'); // bird 1
tz_def('PLAYER_WAS_REG_ON', 'This player registered his account on'); // bird 2
tz_def('NATARS_ACC', 'Official Natar account'); // natars
tz_def('WW_V_M', 'Official World Wonder Village'); // WW Village
tz_def('ROMAN_T_M', 'The Romans : Because of its high level of social and technological development the Romans are masters at building and its coordination. Also, their troops are part of the elite in Travian. They are very balanced and useful in attacking and defending'); // roman tribe medal
tz_def('TEUTON_T_M', 'The Teutons : The Teutons are the most aggressive tribe. Their troops are notorious and feared for their rage and frenzy when they attack. They move around as a plundering horde, not even afraid of death'); // teuton tribe medal
tz_def('GAUL_T_M', 'The Gauls : The Gauls are the most peaceful of all three tribes in Travian. Their troops are trained for an excellent defence, but their ability to attack can still compete with the other two tribes. The Gauls are born riders and their horses are famous for their speed. This means that their riders can hit the enemy exactly where they can cause the most damage and swiftly take care of them'); // gaul tribe medal
tz_def('ADMIN_M', 'Official Server Administrator');
tz_def('MH_M', 'Official Server Global Multihunter');
tz_def('MH_M2', 'The Multihunter is an official Travian position mainly used for enforcement of Travian rules within a server. Multihunters all use the account named Multihunter with its only village located in (0|0). A Multihunter may not play on the server on which they are the Multihunter, but be an active player on other servers');
tz_def('NATURE_M2', 'Natures troops are the animals living in unoccupied oases. You can use the combat simulator to see whether you have enough troops to defeat the animals in an oasis you want to conquer, but remember that you can only raid oasis. Keep in mind that all the animals above Bear can kill its contemporary max tier travian troop in single combat');
tz_def('TASKMASTER_M', 'Taskmaster Account');
tz_def('VETERAN_P', 'Veteran Player');
tz_def('VETERAN_3_M', 'Medal achieved for playing 3 years of Travian');
tz_def('VETERAN_5_M', 'Medal achieved for playing 5 years of Travian');
tz_def('VETERAN_10_M', 'Medal achieved for playing 10 years of Travian');
tz_def('ATT_W_M', 'Attackers of the Week');
tz_def('DEF_W_M', 'Defenders of the Week');
tz_def('POP_W_M', 'Pop Climbers of the week');
tz_def('ROB_W_M', 'Robbers of the week');
tz_def('CLIMB_W_M', 'Rank Climbers of the week');
tz_def('ATT_DEF_10_W_M', 'Receiving this medal shows that you where in the top 10 of both Attackers and Defenders of the week');
tz_def('ATT_3_W_M', 'Receiving this medal shows that you were in the top 3 Attackers of the week');
tz_def('DEF_3_W_M', 'Receiving this medal shows that you were in the top 3 Defenders of the week');
tz_def('POP_3_W_M', 'Receiving this medal shows that you were in the top 3 Pop Climbers of the week');
tz_def('ROB_3_W_M', 'Receiving this medal shows that you were in the top 3 Robbers of the week');
tz_def('CLIMB_3_W_M', 'Receiving this medal shows that you were in the top 3 Rank Climbers of the week');
tz_def('ATT_10_W_M', 'Receiving this medal shows that you were in the top 10 Attackers of the week');
tz_def('DEF_10_W_M', 'Receiving this medal shows that you were in the top 10 Defenders of the week');
tz_def('POP_10_W_M', 'Receiving this medal shows that you were in the top 10 Pop Climbers of the week');
tz_def('ROB_10_W_M', 'Receiving this medal shows that you were in the top 10 Robbers of the week');
tz_def('CLIMB_10_W_M', 'Receiving this medal shows that you were in the top 10 Rank Climbers of the week');
tz_def('RECEIVED_IN_W', 'Received in week');
tz_def('POINTS_M', 'Points');
tz_def('RANKS', 'Ranks');
tz_def('WEEK', 'Week');
tz_def('CATEGORY', 'Category');
tz_def('RANK', 'Rank');
tz_def('BB_CODE', 'BB-Code');
tz_def('IN_ROW', 'in a row');
tz_def('ADMIN1', 'Administrator');
tz_def('MULTIH1', 'Multihunter');
tz_def('PLAYER_ADMIN', 'This player is Admin');
tz_def('PLAYER_MH', 'This player is Multihunter');
tz_def('PLAYER_BANNED', 'This player is BANNED');
tz_def('PLAYER_VACATION', 'This player is on VACATION');
if(!defined('BANNED')) tz_def('BANNED', 'Banned');
tz_def('GENDER', 'Gender');
tz_def('GENDER0', 'n/a');
tz_def('MALE0', 'm');
tz_def('MALE', 'Male');
tz_def('FEMALE0', 'f');
tz_def('FEMALE', 'Female');
tz_def('LOCATION', 'Location');
tz_def('DIRECT_LINKS', 'Direct links');
tz_def('NUMBER0', 'No');
tz_def('LINK_NAME', 'Link name');
tz_def('LINK_TARGET', 'Link target');
tz_def('AUTO_COMPL', 'Auto completion');
tz_def('AUTO_COMPL2', 'Used for rally point and marketplace');
tz_def('OWN_VILLAGES', 'own villages');
tz_def('VILLAGES_NEAR', 'villages of the surroundings');
tz_def('VILLAGES_ALLI_PLAYERS', 'villages from players of the alliance');
tz_def('REPORT_FILTER', 'Report filter');
tz_def('NO_REPORTS_TO_OWN', 'No reports for transfers to own villages');
tz_def('NO_REPORTS_TO_OTH', 'No reports for transfers to foreign villages');
tz_def('NO_REPORTS_FROM_OTH', 'No reports for transfers from foreign villages');
tz_def('CHANGE_PROFILE', 'Change profile');
tz_def('WRITE_MESSAGE', 'Write message');
tz_def('REPORT_PLAYER', 'Report Player');
tz_def('ARTEFACT1', 'Artefact');
tz_def('WoW1', 'WoW');
tz_def('VILLAGE_NAME', 'Village name');
tz_def('BDAY', 'Birthday');
tz_def('CONDITIONS', 'Conditions');
tz_def('TIME_PREF', 'Time preferences');
tz_def('TIME_ZONES_DESC', 'Here you can change Travian`s displayed time to fit your time zone');
tz_def('TIME_ZONE_L1', 'Europe');
tz_def('TIME_ZONE_L2', 'UK');
tz_def('TIME_ZONE_L3', 'Turkey');
tz_def('TIME_ZONE_L4', 'Asia/Kolkata');
tz_def('TIME_ZONE_L5', 'Asia/Bangkok');
tz_def('TIME_ZONE_L6', 'USA/New York');
tz_def('TIME_ZONE_L7', 'USA/Chicago');
tz_def('TIME_ZONE_L8', 'New Zealand');
tz_def('MONTH1', 'Jan');
tz_def('MONTH2', 'Feb');
tz_def('MONTH3', 'Mar');
tz_def('MONTH4', 'Apr');
tz_def('MONTH5', 'May');
tz_def('MONTH6', 'June');
tz_def('MONTH7', 'July');
tz_def('MONTH8', 'Aug');
tz_def('MONTH9', 'Sep');
tz_def('MONTH10', 'Oct');
tz_def('MONTH11', 'Nov');
tz_def('MONTH12', 'Dec');

//artefact
tz_def('ARCHITECTS_DESC', 'All buildings in the area of effect are stronger. This means that you will need more catapults to damage buildings protected by this artefacts powers.');
tz_def('ARCHITECTS_SMALL', 'The architects slight secret');
tz_def('ARCHITECTS_SMALLVILLAGE', 'Diamond Chisel');
tz_def('ARCHITECTS_LARGE', 'The architects great secret');
tz_def('ARCHITECTS_LARGEVILLAGE', 'Giant Marble Hammer');
tz_def('ARCHITECTS_UNIQUE', 'The architects unique secret');
tz_def('ARCHITECTS_UNIQUEVILLAGE', 'Hemons Scrolls');
tz_def('HASTE_DESC', 'All troops in the area of effect move faster.');
tz_def('HASTE_SMALL', 'The slight titan boots');
tz_def('HASTE_SMALLVILLAGE', 'Opal Horseshoe');
tz_def('HASTE_LARGE', 'The great titan boots');
tz_def('HASTE_LARGEVILLAGE', 'Golden Chariot');
tz_def('HASTE_UNIQUE', 'The unique titan boots');
tz_def('HASTE_UNIQUEVILLAGE', 'Pheidippides Sandals');
tz_def('EYESIGHT_DESC', 'All spies (Scouts, Pathfinders, and Equites Legati) increase their spying ability. In addition, with all versions of this artefact you can see the incoming TYPE of troops but not how many there are.');
tz_def('EYESIGHT_SMALL', 'The eagles slight eyes');
tz_def('EYESIGHT_SMALLVILLAGE', 'Tale of a Rat');
tz_def('EYESIGHT_LARGE', 'The eagles great eyes');
tz_def('EYESIGHT_LARGEVILLAGE', 'Generals Letter');
tz_def('EYESIGHT_UNIQUE', 'The eagles unique eyes');
tz_def('EYESIGHT_UNIQUEVILLAGE', 'Diary of Sun Tzu');
tz_def('DIET_DESC', 'All troops in the artefacts range consume less wheat, making it possible to maintain a larger army.');
tz_def('DIET_SMALL', 'Slight diet control');
tz_def('DIET_SMALLVILLAGE', 'Silver Platter');
tz_def('DIET_LARGE', 'Great diet control');
tz_def('DIET_LARGEVILLAGE', 'Sacred Hunting Bow');
tz_def('DIET_UNIQUE', 'Unique diet control');
tz_def('DIET_UNIQUEVILLAGE', 'King Arthurs Chalice');
tz_def('ACADEMIC_DESC', 'Troops are built a certain percentage faster within the scope of the artefact.');
tz_def('ACADEMIC_SMALL', 'The trainers slight talent');
tz_def('ACADEMIC_SMALLVILLAGE', 'Scribed Soldiers Oath');
tz_def('ACADEMIC_LARGE', 'The trainers great talent');
tz_def('ACADEMIC_LARGEVILLAGE', 'Declaration of War');
tz_def('ACADEMIC_UNIQUE', 'The trainers unique talent');
tz_def('ACADEMIC_UNIQUEVILLAGE', 'Memoirs of Alexander the Great');
tz_def('STORAGE_DESC', 'With this building plan you are able to build the Great Granary or Great Warehouse in the Village with the artefact, or the whole account depending on the artefact. As long as you posses that artefact you are able to build and enlarge those buildings.');
tz_def('STORAGE_SMALL', 'Slight storage masterplan');
tz_def('STORAGE_SMALLVILLAGE', 'Builders Sketch');
tz_def('STORAGE_LARGE', 'Great storage masterplan');
tz_def('STORAGE_LARGEVILLAGE', 'Babylonian Tablet');
tz_def('CONFUSION_DESC', 'Cranny capacity is increased by a certain amount for each type of artefact. Catapults can only shoot random on villages within this artefacts power. Exceptions are the WW which can always be targeted and the treasure chamber which can always be targeted, except with the unique artefact. When aiming at a resource field only random resource fields can be hit, when aiming at a building only random buildings can be hit.');
tz_def('CONFUSION_SMALL', 'Rivals slight confusion');
tz_def('CONFUSION_SMALLVILLAGE', 'Map of the Hidden Caverns');
tz_def('CONFUSION_LARGE', 'Rivals great confusion');
tz_def('CONFUSION_LARGEVILLAGE', 'Bottomless Satchel');
tz_def('CONFUSION_UNIQUE', 'Rivals unique confusion');
tz_def('CONFUSION_UNIQUEVILLAGE', 'Trojan Horse');
tz_def('FOOL_DESC', 'Every 24 hours it gets a random effect, bonus, or penalty (all are possible with the exception of great warehouse, great granary and WW building plans). They change effect AND scope every 24 hours. The unique artefact will always take positive bonuses.');
tz_def('FOOL_SMALL', 'Artefact of the slight fool');
tz_def('FOOL_SMALLVILLAGE', 'Pendant of Mischief');
tz_def('FOOL_UNIQUE', 'Artefact of the unique fool');
tz_def('FOOL_UNIQUEVILLAGE', 'Forbidden Manuscript');
tz_def('WWVILLAGE', 'WW village');
tz_def('ARTEFACT', '<h1><b>Natars Artefacts</b></h1>

Whispering rumors echo through the villages, sharing legends told only by the best storytellers. It refers to NATARS, the most feared warrior of the TRAVIAN world. Their killing is the dream of any hero, the purpose of any fighter. No one knows how NATARS got to get such power, and their warriors so cruel. Determined to discover the source of the NATARS power, the fighters send a group of elite spies to spy them. I do not go through many hours and come back with fear in their eyes and balancing fantastic theories: it seems that the natural power comes from the mysterious objects they call artefacts that they stole from our ancestors. Try to steal the artefacts of her, and you can control their power.

<img src="/img/x.gif" class="ArtefactsAnnouncement">

The time has come for claiming artefacts. Collaborate with your alliance and bring your worriors to get these wanted objects. However, NATARS will not give up without war to the artefacts ... nor your enemies. If you are successful in retrieving artefacts and you will be able to reject enemies, you will be able to collect the rewards. Your buildings will become incredibly strong and mightest, and the troops will be much faster and will consume less food. Capture the artefacts, bring glory over your empire and become new legends for your followers.

To steal one, the following things must happen:

1. You must attack the village (NO Raid!)
2. WIN the Attack
3. Destroy the treasury
4. An empty treasury level 10 for SMALL ARTEFACTS and level 20 for LARGE ARTEFACT must be in the village where that attack came from
5. Have a hero in an attack

If not, the next attack on that village, winning with a hero and empty treasury will take the artefact.

To build a WW, you must own a plan yourself (you = the WW village owner) from lvl 0 to 50, from 51 to 100 you need an additional plan in your alliance! Two plans in the WW village account would not work!

The construction plans are conquerable immediately when they appear to the server. 

There will be a countdown in game, showing the exact time of the release, 5 days prior to the launch. ');

//WW Village Release Message
tz_def('WWVILLAGEMSG', '<h1><b>Wonder of the World Villages</b></h1>

Countless days have passed since the first battles upon the walls of the cursed villages of the Dread Natars, many armies of both the free ones and the Natarian empire struggled and died before the walls of the many strongholds from which the Natars had once ruled all creation. Now with the dust settled and a relative calm having settled in, armies began to count their losses and collect their dead, the stench of combat still lingering in the night air, a smell of a slaughter unforgettable in its extent and brutality yet soon to be dwarfed by yet others. The largest armies of the free ones and the Dread Natars were marshalling for yet another renewed assault upon the coveted former strongholds of the Natarian Empire.
Soon scouts arrived telling of a most awesome sight and a chilling reminder, a dread army of an unfathomable size had been spotted marshalling at the end of the world, the Natarian capital, a force so great and unstoppable that the dust from their march would choke off all light, a force so brutal and ruthless that it would crush all hope. The free people knew that they had to race now, race against time and the endless hordes of the Natarian Empire to raise a Wonder of the World to restore the world to peace and vanquish the Natarian threat.
But to raise such a great Wonder would be no easy task, one would need construction plans created in the distant past, plans of such an arcane nature that even the very wisest of sages knew not their contents or locations.
Tens of thousands of scouts roamed across all existence searching in vain for these mystical plans, looking in all places but the dreaded Natarian Capital, yet could not find them. Today however, they return bearing good news, they return baring the locations of the plans, hidden by the armies of the Natars inside secret strongholds constructed to be hidden from the eyes of man.
Now begins the final stretch, when the greatest armies of the Free people and the Natars will clash across the world for the fate of all that lies under heaven. This is the war that will echo across the eons, this is your war, and here you shall etch your name across history, here you shall become legend.

<img src="/img/x.gif" class="WWVillagesAnnouncement" title="'.WWVILLAGE.'" alt="'.WWVILLAGE.'">

To conquer one, the following things must happen:

1. You must attack the village (NO Raid!)
2. WIN the Attack
3. Destroy the RESIDENCE
4. You must decrease the loyalty to 0 with : SENATORS , CHIEF , CHIEFTAIN
5. You must have enough culture points to conquer the village

If not, the next attack on that village, winning with a SENATORS , CHIEF , CHIEFTAIN and empty slots in RESIDENCE/PALACE will take the village.

To build a WW, you must own a plan yourself (you = the WW village owner) from lvl 0 to 50, from 51 to 100 you need an additional plan in your alliance! Two plans in the WW village account would not work!

The construction plans are conquerable immediately when they appear to the server. 

There will be a countdown in game, showing the exact time of the release, '.(5 / SPEED).' days prior to the launch.');

//Building Plans
tz_def('WILL_SPAWN_IN', 'will spawn in');
tz_def('PLAN', 'Ancient Construction Plan');
tz_def('PLANVILLAGE', 'WW Buildingplan');
tz_def('PLAN_DESC', 'With this ancient construction plan you will able to build World Wonder to level 50. to build further, your alliance must hold at least two plans.');
tz_def('PLAN_INFO', '<h1><b>World Wonder Construction Plans</b></h1>


Many moons ago the tribes of Travian were surprised by the unforeseen return of the Natars. This tribe from immemorial times surpassing all in wisdom, might and glory was about to trouble the free ones again. Thus they put all their efforts in preparing a last war against the Natars and vanquishing them forever. Many thought about the so-called "Wonders of the World", a construction of many legends, as the only solution. It was told that it would render anyone invincible once completed. Ultimately making the constructors the rulers and conquerors of all known Travian. 

However, it was also told that one would need construction plans to construct such a building. Due to this fact, the architects devised cunning plans about how to store these safely. After a while, one could see temple-like buildings in many a city and metropolis - the Treasure Chambers (Treasuries). 

Sadly, no one - not even the wise and well versed - knew where to find these construction plans. The harder people tried to locate them, the more it seemed as if they where only legends. 

Today, however, this last secret will be revealed. Deprivations and endeavors of the past will not have been in vain, as today scouts of several tribes have successfully obtained the whereabouts of the construction plans. Well guarded by the Natars, they lie hidden in several oases to be found all over Travian. Only the most valiant heroes will be able to secure such a plan and bring it home safely so that the construction can begin. 

In the end, we will see whether the free tribes of Travian can once again outwit the Natars and vanquish them once and for all. Do not be so foolish as to assume that the Natars will leave without a fight, though!

<img src="/img/x.gif" class="WWBuildingPlansAnnouncement" title="'.PLAN.'" alt="'.PLAN.'">

To steal a set of Construction Plans from the Natars, the following things must happen:
- You must Attack the village (NOT Raid!)
- You must WIN the Attack
- You must DESTROY the Treasure Chamber (Treasury)
- Your Hero MUST be in that attack, as he is the only one who may carry the Construction Plans
- An empty level 10 Treasure Chamber (Treasury) MUST be in the village where that attack came from
NOTE: If the above criteria is not met during the attack, the next attack on that village which does meet the above criteria will take the Construction Plans.



To build a Treasure Chamber (Treasury), you will need a Main Building level 10 and the village MUST NOT be  contain a World Wonder.

To build a World Wonder, you must own the Construction Plans yourself (you = the World Wonder Village Owner) from level 0 to 50, and then from level 51 to 100 you will need an additional set of Construction Plans in your Alliance! Two sets of Construction Plans in the World Wonder Village Account will not work!');

//Admin setting - Admin/Templates/config.tpl & editServerSet.tpl
tz_def('EDIT_BACK', 'Back');
tz_def('SERV_CONFIG', 'Server Configuration');
tz_def('SERV_SETT', 'Server Settings');
tz_def('EDIT_SERV_SETT', 'Edit Server Settings');
tz_def('SERV_VARIABLE', 'Variable');
tz_def('SERV_VALUE', 'Value');
tz_def('CONF_SERV_NAME', 'Server Name');
tz_def('CONF_SERV_NAME_TOOLTIP', 'Name of the game server.');
tz_def('CONF_SERV_STARTED', 'Server Started');
tz_def('CONF_SERV_STARTED_TOOLTIP', 'Time when the game server was started. This parameter can not be changed on the installed game server.');
tz_def('CONF_SERV_TIMEZONE', 'Server Timezone');
tz_def('CONF_SERV_TIMEZONE_TOOLTIP', 'Timezone of the game server.');
tz_def('CONF_SERV_LANG', 'Language');
tz_def('CONF_SERV_LANG_TOOLTIP', 'The language that is used in the admin panel and for everyone on the game server by default.');
tz_def('CONF_SERV_SERVSPEED', 'Server Speed');
tz_def('CONF_SERV_SERVSPEED_TOOLTIP', 'The speed of the game server. The higher the speed of the game server, the faster all buildings are built, the studies and improvements in the smithies are carried out, the troops are quickly built and the productivity of all resources is increased.');
tz_def('CONF_SERV_TROOPSPEED', 'Troop Speed');
tz_def('CONF_SERV_TROOPSPEED_TOOLTIP', 'Speed of movement of troops on the game server. The higher this indicator, the faster the troops move across the map.');
tz_def('CONF_SERV_EVASIONSPEED', 'Evasion Speed');
tz_def('CONF_SERV_EVASIONSPEED_TOOLTIP', 'The evasion speed is the time that troops spend on the road to return home after evasion an attack.');
tz_def('CONF_SERV_STORMULTIPLER', 'Storage Multipler');
tz_def('CONF_SERV_STORMULTIPLER_TOOLTIP', 'A multiplier for the storage capacity warehouse and granary. The value 1 is equal to the capacity of 80,000 of each resource at the maximum level. If you set the value to 2, then the capacity at the maximum level will be 160,000 of each resource.<br><b>Note:</b> the amount of resources that will be generated by unoccupied oases for robbery depends on this value. The default is 800. If you set the value to 2, the maximum number for each resource being generated is 1600.');
tz_def('CONF_SERV_TRADCAPACITY', 'Trader Capacity');
tz_def('CONF_SERV_TRADCAPACITY_TOOLTIP', 'A multiplier for the capacity of resources that can be carried by one trader. The value of 1 equals 500 capacity for the Romans, 750 for the Gauls, 1000 for the Teutons. If you set the value to 2, then the capacity of the transferred resources will double accordingly, 1000, 1500, 2000.');
tz_def('CONF_SERV_CRANCAPACITY', 'Cranny Capacity');
tz_def('CONF_SERV_CRANCAPACITY_TOOLTIP', 'A multiplier for the capacity of resources in Cranny, which can be saved from robbery. The value of 1 is equal to 1000 for Romans and Teutons, 2000 for Gauls. If you set the value to 2, then the capacity of the Cranny will double to 2000 and 4000 respectively.');
tz_def('CONF_SERV_TRAPCAPACITY', 'Trapper Capacity');
tz_def('CONF_SERV_TRAPCAPACITY_TOOLTIP', 'A multiplier for the capacity of the trap of the Gauls, which can capture enemy soldiers even before attacking the village. The value of 1 is equal to the capacity of 400 at the 20 level of construction. If you set the value to 2, then the capacity will be 800.');
tz_def('CONF_SERV_NATUNITSMULTIPLIER', 'Natars Units Multiplier');
tz_def('CONF_SERV_NATUNITSMULTIPLIER_TOOLTIP', 'This parameter is responsible for the number of troops of Natars, on artefacts and WW villages.');
tz_def('CONF_SERV_NATARS_SPAWN_TIME', 'Natars Spawn');
tz_def('CONF_SERV_NATARS_SPAWN_TIME_TOOLTIP', 'After how long Natars and artefacts will spawn from the start date of the server, in days');
tz_def('CONF_SERV_NATARS_WW_SPAWN_TIME', 'World Wonders Spawn');
tz_def('CONF_SERV_NATARS_WW_SPAWN_TIME_TOOLTIP', 'After how long WW villages will spawn from the start date of the server, in days');
tz_def('CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME', 'WW Building Plan Spawn');
tz_def('CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME_TOOLTIP', 'After how long WW building plans will spawn from the start date of the server, in days');
tz_def('CONF_SERV_MAPSIZE', 'Map Size');
tz_def('CONF_SERV_MAPSIZE_TOOLTIP', 'The size of the map of the game world. Can not be changed on an already installed game server.');
tz_def('CONF_SERV_VILLEXPSPEED', 'Village Expanding Speed');
tz_def('CONF_SERV_VILLEXPSPEED_TOOLTIP', 'Speed, which affects the expansion of the empire. With a slow speed more culture points are needed to found new village, with a fast speed the required number of culture points is reduced.');
tz_def('CONF_SERV_BEGINPROTECT', 'Beginners Protection');
tz_def('CONF_SERV_BEGINPROTECT_TOOLTIP', 'Protection, which prohibits a certain time to attack the villages of new players.');
tz_def('CONF_SERV_REGOPEN', 'Register Open');
tz_def('CONF_SERV_REGOPEN_TOOLTIP', 'Allows to enable (True) or disable (False) the registration of players on the game server.');
tz_def('CONF_SERV_ACTIVMAIL', 'Activation Mail');
tz_def('CONF_SERV_ACTIVMAIL_TOOLTIP', 'If enabled (Yes), during registration it will be necessary to confirm email address. If disabled (No) does not require confirmation of e-mail.');
tz_def('CONF_SERV_QUEST', 'Quest');
tz_def('CONF_SERV_QUEST_TOOLTIP', 'Enable (Yes) or disable (No) the quest on the game server.');
tz_def('CONF_SERV_QTYPE', 'Quest Type');
tz_def('CONF_SERV_QTYPE_TOOLTIP', 'The quest type can be official which is a bit shorter, and extended which is longer.');
tz_def('CONF_SERV_DLR', 'Demolish - Level required');
tz_def('CONF_SERV_DLR_TOOLTIP', 'The required level of the main building, on which can carry out the demolition of buildings in the village.');
tz_def('CONF_SERV_WWSTATS', 'World Wonder - Statistics');
tz_def('CONF_SERV_WWSTATS_TOOLTIP', 'Enable (True) or disable (False) the display in the statistics of villages with a Wonder of the World.');
tz_def('CONF_SERV_NTRTIME', 'Nature Troops Regeneration Time');
tz_def('CONF_SERV_NTRTIME_TOOLTIP', 'Time through which the nature troops will be restored in oases.');
tz_def('CONF_SERV_OASIS_WOOD_PROD_MULT', 'Oasis Wood Production Multiplier');
tz_def('CONF_SERV_OASIS_WOOD_PROD_MULT_TOOLTIP', 'The base wood oasis production');
tz_def('CONF_SERV_OASIS_CLAY_PROD_MULT', 'Oasis Clay Production Multiplier');
tz_def('CONF_SERV_OASIS_CLAY_PROD_MULT_TOOLTIP', 'The base clay oasis production');
tz_def('CONF_SERV_OASIS_IRON_PROD_MULT', 'Oasis Iron Production Multiplier');
tz_def('CONF_SERV_OASIS_IRON_PROD_MULT_TOOLTIP', 'The base iron oasis production');
tz_def('CONF_SERV_OASIS_CROP_PROD_MULT', 'Oasis Crop Production Multiplier');
tz_def('CONF_SERV_OASIS_CROP_PROD_MULT_TOOLTIP', 'The base crop oasis production');
tz_def('CONF_SERV_MEDALINTERVAL', 'Medal Interval');
tz_def('CONF_SERV_MEDALINTERVAL_TOOLTIP', 'The time interval for issuing medals for the top players and alliances. If this parameter is changed on the installed server, the time interval changes after the subsequent issuance of the medals.');
tz_def('CONF_SERV_TOURNTHRES', 'Tourn Threshold');
tz_def('CONF_SERV_TOURNTHRES_TOOLTIP', 'The number of squares on the game map, after which Tournament Square will start working.');
tz_def('CONF_SERV_GWORKSHOP', 'Great Workshop');
tz_def('CONF_SERV_GWORKSHOP_TOOLTIP', 'Enable (True) or disable (False) the use of a Great Workshop in the game.');
tz_def('CONF_SERV_NATARSTAT', 'Show Natars in Statistics');
tz_def('CONF_SERV_NATARSTAT_TOOLTIP', 'Enable (True) or disable (False) the display of the Natars account in statistics.');
tz_def('CONF_SERV_PEACESYST', 'Peace system');
tz_def('CONF_SERV_PEACESYST_TOOLTIP', 'Enable or disable the Peace system. When the peace system is activated, players will be able to attack each other but instead of any actions in the reports there will be a congratulatory inscription. The troops will not die of hunger.');
tz_def('CONF_SERV_GRAPHICPACK', 'Graphic Pack');
tz_def('CONF_SERV_GRAPHICPACK_TOOLTIP', 'Enable (Yes) or disable (No) the ability to use the graphics package.');
tz_def('CONF_SERV_ERRORREPORT', 'Error Reporting');
tz_def('CONF_SERV_ERRORREPORT_TOOLTIP', 'Enable (Yes) or disable (No) the display of error reports on the game server.');

//Admin setting - Admin/Templates/config.tpl & editPlusSet.tpl
tz_def('PLUS_LOGO', '<b><font color="#71D000">P</font><font color="#FF6F0F">l</font><font color="#71D000">u</font><font color="#FF6F0F">s</font></b>');
tz_def('PLUS_CONFIGURATION', PLUS_LOGO.' Configuration');
tz_def('PLUS_SETT', PLUS_LOGO.' Settings');
tz_def('EDIT_PLUS_SETT', 'Edit '.PLUS_LOGO.' Setting');
tz_def('EDIT_PLUS_SETT1', 'Edit PLUS Setting');
tz_def('CONF_PLUS_PAYPALEMAIL', '<a href="https://www.paypal.com" target="_blank">PayPal</a> E-Mail Address');
tz_def('CONF_PLUS_PAYPALEMAIL_TOOLTIP', 'The E-Mail Address specified at registration on PayPal.<br><font color="red"><b>Must be Business or Premier account!</b></font>');
tz_def('CONF_PLUS_CURRENCY', 'Payment Currency');
tz_def('CONF_PLUS_CURRENCY_TOOLTIP', 'The currency to be used for payment.');
tz_def('CONF_PLUS_PACKAGEGOLDA', 'Package &#34;A&#34; Amount of Gold');
tz_def('CONF_PLUS_PACKAGEGOLDA_TOOLTIP', 'The amount of gold issued for the payment of the package &#34;A&#34;.');
tz_def('CONF_PLUS_PACKAGEPRICEA', 'Package &#34;A&#34; Amount of Price');
tz_def('CONF_PLUS_PACKAGEPRICEA_TOOLTIP', 'The amount necessary to pay the cost of package &#34;A&#34;.');
tz_def('CONF_PLUS_PACKAGEGOLDB', 'Package &#34;B&#34; Amount of Gold');
tz_def('CONF_PLUS_PACKAGEGOLDB_TOOLTIP', 'The amount of gold issued for the payment of the package &#34;B&#34;.');
tz_def('CONF_PLUS_PACKAGEPRICEB', 'Package &#34;B&#34; Amount of Price');
tz_def('CONF_PLUS_PACKAGEPRICEB_TOOLTIP', 'The amount necessary to pay the cost of package &#34;B&#34;.');
tz_def('CONF_PLUS_PACKAGEGOLDC', 'Package &#34;C&#34; Amount of Gold');
tz_def('CONF_PLUS_PACKAGEGOLDC_TOOLTIP', 'The amount of gold issued for the payment of the package &#34;C&#34;.');
tz_def('CONF_PLUS_PACKAGEPRICEC', 'Package &#34;C&#34; Amount of Price');
tz_def('CONF_PLUS_PACKAGEPRICEC_TOOLTIP', 'The amount necessary to pay the cost of package &#34;C&#34;.');
tz_def('CONF_PLUS_PACKAGEGOLDD', 'Package &#34;D&#34; Amount of Gold');
tz_def('CONF_PLUS_PACKAGEGOLDD_TOOLTIP', 'The amount of gold issued for the payment of the package &#34;D&#34;.');
tz_def('CONF_PLUS_PACKAGEPRICED', 'Package &#34;D&#34; Amount of Price');
tz_def('CONF_PLUS_PACKAGEPRICED_TOOLTIP', 'The amount necessary to pay the cost of package &#34;D&#34;.');
tz_def('CONF_PLUS_PACKAGEGOLDE', 'Package &#34;E&#34; Amount of Gold');
tz_def('CONF_PLUS_PACKAGEGOLDE_TOOLTIP', 'The amount of gold issued for the payment of the package &#34;E&#34;.');
tz_def('CONF_PLUS_PACKAGEPRICEE', 'Package &#34;E&#34; Amount of Price');
tz_def('CONF_PLUS_PACKAGEPRICEE_TOOLTIP', 'The amount necessary to pay the cost of package &#34;E&#34;.');
tz_def('CONF_PLUS_ACCDURATION', PLUS_LOGO.' account duration');
tz_def('CONF_PLUS_ACCDURATION_TOOLTIP', 'The duration of the game function '.PLUS_LOGO.' for the account at the time of activation by the player.');
tz_def('CONF_PLUS_PRODUCTDURATION', '+25% production duration');
tz_def('CONF_PLUS_PRODUCTDURATION_TOOLTIP', 'The duration of the game function +25% production duration for the account at the time of activation by the player.');

//Admin setting - Admin/Templates/config.tpl & editLogSet.tpl
tz_def('LOG_SETT', 'Log Settings');
tz_def('EDIT_LOG_SETT', 'Edit Log Setting');
tz_def('CONF_LOG_BUILD', 'Log Build');
tz_def('CONF_LOG_BUILD_TOOLTIP', 'Enable (Yes) or disable (No) the display of logs for the construction of buildings in the village.');
tz_def('CONF_LOG_TECHNOLOGY', 'Log Technology');
tz_def('CONF_LOG_TECHNOLOGY_TOOLTIP', 'Enable (Yes) or disable (No) display logs to improve troops in Blacksmith and Armoury.');
tz_def('CONF_LOG_LOGIN', 'Log Login');
tz_def('CONF_LOG_LOGIN_TOOLTIP', 'Enable (Yes) or disable (No) the display logs players login the game.');
tz_def('CONF_LOG_GOLD', 'Log Gold');
tz_def('CONF_LOG_GOLD_TOOLTIP', 'Enable (Yes) or disable (No) the display of gold use logs in-game by players.');
tz_def('CONF_LOG_ADMIN', 'Log Admin');
tz_def('CONF_LOG_ADMIN_TOOLTIP', 'Enable (Yes) or disable (No) the display of logs for administrator actions in the control panel.');
tz_def('CONF_LOG_WAR', 'Log War');
tz_def('CONF_LOG_WAR_TOOLTIP', 'Enable (Yes) or disable (No) the display of logs attacks on players in the game.');
tz_def('CONF_LOG_MARKET', 'Log Market');
tz_def('CONF_LOG_MARKET_TOOLTIP', 'Enable (Yes) or disable (No) the display of the logs of the use of the market in the game by the players.');
tz_def('CONF_LOG_ILLEGAL', 'Log Illegal');
tz_def('CONF_LOG_ILLEGAL_TOOLTIP', 'Enable (Yes) or disable (No) the display of illegal logs. (I do not know exactly what it is)');

//Admin setting - Admin/Templates/config.tpl & editNewsboxSet.tpl
tz_def('NEWSBOX_SETT', 'Newsbox Settings');
tz_def('EDIT_NEWSBOX_SETT', 'Edit Newsbox Setting');
tz_def('EDIT_NEWSBOX1', 'Newsbox 1');
tz_def('EDIT_NEWSBOX1_TOOLTIP', 'Enable or disable the display of the Newsbox 1. Displayed on the authorization page and on the game pages.');
tz_def('EDIT_NEWSBOX2', 'Newsbox 2');
tz_def('EDIT_NEWSBOX2_TOOLTIP', 'Enable or disable the display of the Newsbox 2. Displayed on the authorization page and on the game pages.');
tz_def('EDIT_NEWSBOX3', 'Newsbox 3');
tz_def('EDIT_NEWSBOX3_TOOLTIP', 'Enable or disable the display of the Newsbox 3. Displayed on the authorization page and on the game pages.');

//Admin setting - Admin/Templates/config.tpl SQL Settings
tz_def('SQL_SETTINGS', 'SQL Settings');
tz_def('CONF_SQL_HOSTNAME', 'Hostname');
tz_def('CONF_SQL_HOSTNAME_TOOLTIP', 'The name of the server where MySQL is started (by default is: localhost).');
tz_def('CONF_SQL_PORT', 'Port');
tz_def('CONF_SQL_PORT_TOOLTIP', 'MySQL port for remote connection. The standard port for connecting is: 3306.');
tz_def('CONF_SQL_DBUSER', 'DB Username');
tz_def('CONF_SQL_DBUSER_TOOLTIP', 'The user name to connect to the database.');
tz_def('CONF_SQL_DBPASS', 'DB Password');
tz_def('CONF_SQL_DBPASS_TOOLTIP', 'Password from the user to connect to the database.');
tz_def('CONF_SQL_DBNAME', 'DB Name');
tz_def('CONF_SQL_DBNAME_TOOLTIP', 'Name of the database to which you are connecting.');
tz_def('CONF_SQL_TBPREFIX', 'Table Prefix');
tz_def('CONF_SQL_TBPREFIX_TOOLTIP', 'The prefix used for the database tables.');
tz_def('CONF_SQL_DBTYPE', 'DB Type');
tz_def('CONF_SQL_DBTYPE_TOOLTIP', 'The type of database used.');

//Admin setting - Admin/Templates/config.tpl & editExtraSet.tpl
tz_def('EXTRA_SETT', 'Extra Settings');
tz_def('EDIT_EXTRA_SETT', 'Edit Extra Settings');
tz_def('CONF_EXTRA_LIMITMAIL', 'Limit Mailbox');
tz_def('CONF_EXTRA_LIMITMAIL_TOOLTIP', 'Enable (Yes) or disable (No) the mailbox limit.');
tz_def('CONF_EXTRA_MAXMAIL', 'Max number of mails');
tz_def('CONF_EXTRA_MAXMAIL_TOOLTIP', 'The maximum number of messages that can fit in the mailbox.');

//Admin setting - Admin/Templates/config.tpl & editAdminInfo.tpl
tz_def('ADMIN_INFO', 'Admin Information');
tz_def('EDIT_ADMIN_INFO', 'Edit Admin Information');
tz_def('CONF_ADMIN_NAME', 'Admin Name');
tz_def('CONF_ADMIN_NAME_TOOLTIP', 'Name for the administrator account.');
tz_def('CONF_ADMIN_EMAIL', 'Admin E-Mail');
tz_def('CONF_ADMIN_EMAIL_TOOLTIP', 'The email address for the administrator account.');
tz_def('CONF_ADMIN_SHOWSTATS', 'Include Admin in Stats');
tz_def('CONF_ADMIN_SHOWSTATS_TOOLTIP', 'Enable (True) or disable (False) the display of the administrator account in the general statistics of players.');
tz_def('CONF_ADMIN_SUPPMESS', 'Include Support Messages');
tz_def('CONF_ADMIN_SUPPMESS_TOOLTIP', 'Enable (True) or disable (False) the sending of messages to the mailbox of the administrator addressed to Support.');
tz_def('CONF_ADMIN_RAIDATT', 'Allow Raided and Attacked');
tz_def('CONF_ADMIN_RAIDATT_TOOLTIP', 'Enable (True) or disable (False) the ability to Raided and Attacked an administrator.');

/*
|--------------------------------------------------------------------------
|   Index
|--------------------------------------------------------------------------
*/

$lang['index'][0][1] = 'Welcome to '.SERVER_NAME;
$lang['index'][0][2] = 'Manual';
$lang['index'][0][3] = 'Play now, for free!';
$lang['index'][0][4] = 'What is '.SERVER_NAME;
$lang['index'][0][5] = SERVER_NAME.' is a <b>browser game</b> featuring an engaging ancient world with thousands of other real players.</p><p>It`s <strong>free to play</strong> and requires <strong>no downloads</strong>.';
$lang['index'][0][6] = 'Click here to play '.SERVER_NAME;
$lang['index'][0][7] = 'Total players';
$lang['index'][0][8] = 'Players active';
$lang['index'][0][9] = 'Players online';
$lang['index'][0][10] = 'About the game';
$lang['index'][0][11] = 'You will begin as the chief of a tiny village and will embark on an exciting quest.';
$lang['index'][0][12] = 'Build up villages, wage wars or establish trade routes with your neighbours.';
$lang['index'][0][13] = 'Play with and against thousands of other real players and conquer the the world of Travian.';
$lang['index'][0][14] = 'News';
$lang['index'][0][15] = 'FAQ';
$lang['index'][0][16] = 'Screenshots';
$lang['forum'] = 'Forum';
$lang['register'] = 'Register';
$lang['login'] = 'Login';
$lang['screenshots']['title1'] = 'Village';
$lang['screenshots']['desc1'] = 'Village building';
$lang['screenshots']['title2'] = 'Resource';
$lang['screenshots']['desc2'] = 'Village resource is wood, clay, iron and crop';
$lang['screenshots']['title3'] = 'Map';
$lang['screenshots']['desc3'] = 'Location your village in map';
$lang['screenshots']['title4'] = 'Contruct Building';
$lang['screenshots']['desc4'] = 'How to contruct building or resource level';
$lang['screenshots']['title5'] = 'Report';
$lang['screenshots']['desc5'] = 'Your attack report';
$lang['screenshots']['title6'] = 'Statistics';
$lang['screenshots']['desc6'] = 'View your ranking in statistics';
$lang['screenshots']['title7'] = 'Weapons or dough';
$lang['screenshots']['desc7'] = 'You can choose to play as military or economy';

// ===== i18n nouvelles constantes (etape 2) =====
tz_def('TZ_ACTIVATION_AVAILBLE_IN', 'Activation Availble in:');
tz_def('TZ_ACTIVATION_CODE', 'Activation code:');
tz_def('TZ_ADD', 'add');
tz_def('TZ_ADD_2', 'Add');
tz_def('TZ_ALLIANCE_ID', 'Alliance ID');
tz_def('TZ_ARRIVED', 'Arrived:');
tz_def('TZ_ASSIGN_TO_POSITION', 'Assign to position');
tz_def('TZ_AS_SOON_AS_A_PLAYER_YOU_INVITED_FO', 'As soon as a player you invited founds his');
tz_def('TZ_ATTACKS', 'Attacks');
tz_def('TZ_BOLD', 'bold');
tz_def('TZ_BUILDING', 'Building');
tz_def('TZ_CATAPULT_TARGET', 'catapult target');
tz_def('TZ_CLICK_TO_COPY', 'Click to copy');
tz_def('TZ_CLIMBERS_OF_THE_WEEK', 'Climbers of the week');
tz_def('TZ_CLOCK', 'Clock');
tz_def('TZ_CONTINUE_WITH_THE_NEXT_TASK', 'Continue with the next task.');
tz_def('TZ_CREATE', 'Create');
tz_def('TZ_CREATE_A_NEW_LIST', 'Create a new list');
tz_def('TZ_DESTINATION', 'Destination:');
tz_def('TZ_DOES_NOT_EXIST', 'does not exist.');
tz_def('TZ_DOWNLOAD', 'Download');
tz_def('TZ_EVENT', 'Event');
tz_def('TZ_FEATURES_OF_TRAVIAN', 'Features of Travian');
tz_def('TZ_FORUM_NAME', 'Forum name');
tz_def('TZ_FORWARD', 'forward');
tz_def('TZ_GOLD', 'gold.');
tz_def('TZ_HERO_DEF_BONUS', 'Hero (def bonus)');
tz_def('TZ_HERO_FIGHTING_STRENGTH', 'Hero (fighting strength)');
tz_def('TZ_HERO_OFF_BONUS', 'Hero (off bonus)');
tz_def('TZ_HOUR', 'hour');
tz_def('TZ_HOW_IS_IT_DONE', 'How is it done?');
tz_def('TZ_HRS', 'hrs');
tz_def('TZ_HRS_2', 'hrs.');
tz_def('TZ_IF_YOU_GET_NEW_PLAYERS_TO_OPEN_AN', 'If you get new players to open an account and settle a second village, you will receive');
tz_def('TZ_IN_YOUR_POST_BECAUSE_IT_CAN_CAUSE', 'in your post because it can cause problem with bbcode system.');
tz_def('TZ_ITALIC', 'italic');
tz_def('TZ_LAST_TARGETS', 'Last targets:');
tz_def('TZ_LIST_NAME', 'List name:');
tz_def('TZ_LOOK_FOR_YOUR_RANK_IN_THE_STATISTI', 'Look for your rank in the statistics and enter it here.');
tz_def('TZ_MACEMAN', 'Maceman');
tz_def('TZ_MEMBERS', 'Members');
tz_def('TZ_MEMBER_SINCE', 'Member since');
tz_def('TZ_NAME', 'Name:');
tz_def('TZ_NO', 'No.');
tz_def('TZ_NOT_CODED_YET', '(not coded yet)');
tz_def('TZ_NO_EMAIL_RECEIVED', 'No email received?');
tz_def('TZ_N_15_GOLD', '15 Gold');
tz_def('TZ_N_1_INVITE_YOUR_FRIENDS_VIA_EMAIL', '1) Invite your friends via Email');
tz_def('TZ_N_20_GOLD', '20 Gold');
tz_def('TZ_N_2_COPY_YOUR_PERSONAL_REF_LINK_AN', '2) Copy your personal REF-Link and share it!');
tz_def('TZ_N_50_GOLD', '50 gold');
tz_def('TZ_OK_2', 'Ok');
tz_def('TZ_OPEN_FORUM_FOR_THE_FOLLOWING_PLAYE', 'Open forum for the following players');
tz_def('TZ_OPEN_FOR_MORE_ALLIANCES', 'Open for more alliances');
tz_def('TZ_ORDER', 'Order:');
tz_def('TZ_OTHER', 'Other');
tz_def('TZ_OWNER', 'Owner:');
tz_def('TZ_PAY_SECURELY_WITH_PAYPAL', 'Pay securely with PayPal.');
tz_def('TZ_PLAYERS_BROUGHT_IN', 'Players brought in');
tz_def('TZ_POST_NEW_THREAD', 'Post new thread');
tz_def('TZ_PREVIEW', 'Preview');
tz_def('TZ_PREVIEW_2', 'preview');
tz_def('TZ_PROGRESS_OF_YOUR_INVITED_FRIENDS', 'Progress of your invited friends');
tz_def('TZ_QUIT_ALLIANCE', 'Quit alliance');
tz_def('TZ_REGISTER_FOR_THE_GAME', 'register for the game');
tz_def('TZ_REGISTRATION', 'registration');
tz_def('TZ_SENT', 'Sent:');
tz_def('TZ_SMILIES', 'Smilies');
tz_def('TZ_SMILIES_2', 'smilies');
tz_def('TZ_STONEMASON_S_LODGE', 'Stonemason\'s Lodge');
tz_def('TZ_TAG', 'Tag:');
tz_def('TZ_TARGET_VILLAGE', 'Target village:');
tz_def('TZ_TASK_10_CRANNY', 'Task 10: Cranny');
tz_def('TZ_TASK_11_TO_TWO', 'Task 11: To Two.');
tz_def('TZ_TASK_12_INSTRUCTIONS', 'Task 12: Instructions');
tz_def('TZ_TASK_13_MAIN_BUILDING', 'Task 13: Main Building');
tz_def('TZ_TASK_14_ADVANCED', 'Task 14: Advanced!');
tz_def('TZ_TASK_16_ECONOMY', 'Task 16: Economy');
tz_def('TZ_TASK_16_MILITARY', 'Task 16: Military');
tz_def('TZ_TASK_17_BARRACKS', 'Task 17: Barracks');
tz_def('TZ_TASK_17_WAREHOUSE', 'Task 17: Warehouse');
tz_def('TZ_TASK_18_MARKETPLACE', 'Task 18: Marketplace.');
tz_def('TZ_TASK_18_TRAIN', 'Task 18: Train.');
tz_def('TZ_TASK_19_EVERYTHING_TO_2', 'Task 19: Everything to 2.');
tz_def('TZ_TASK_20_ALLIANCE', 'Task 20: Alliance.');
tz_def('TZ_TASK_21_MAIN_BUILDING_TO_LEVEL_5', 'Task 21: Main Building to Level 5');
tz_def('TZ_TASK_22_GRANARY_TO_LEVEL_3', 'Task 22: Granary to Level 3.');
tz_def('TZ_TASK_23_WAREHOUSE_TO_LEVEL_7', 'Task 23: Warehouse to Level 7.');
tz_def('TZ_TASK_24_ALL_TO_FIVE', 'Task 24: All to five!');
tz_def('TZ_TASK_25_PALACE_OR_RESIDENCE', 'Task 25: Palace or Residence?');
tz_def('TZ_TASK_26_3_SETTLERS', 'Task 26: 3 settlers.');
tz_def('TZ_TASK_27_NEW_VILLAGE', 'Task 27: New Village.');
tz_def('TZ_TASK_3_YOUR_VILLAGE_S_NAME', 'Task 3: Your Village\'s Name');
tz_def('TZ_TASK_9_DOVE_OF_PEACE', 'Task 9: Dove of Peace');
tz_def('TZ_TERMS', 'Terms');
tz_def('TZ_THE_ALLIANCE', 'The alliance');
tz_def('TZ_THE_LARGEST_ALLIANCES', 'The largest alliances');
tz_def('TZ_THE_USER', 'The user');
tz_def('TZ_THREAD', 'Thread');
tz_def('TZ_TOP_10', 'Top 10');
tz_def('TZ_TOTAL', 'Total');
tz_def('TZ_TOWNHALL', 'Townhall');
tz_def('TZ_TRAVIAN', 'Travian');
tz_def('TZ_TRAVIANX', 'TravianX');
tz_def('TZ_TRAVIANZ', 'TravianZ');
tz_def('TZ_TRAVIAN_GAMES', 'Travian Games');
tz_def('TZ_UNDERLINE', 'underline');
tz_def('TZ_UNDERLINED', 'underlined');
tz_def('TZ_UNKNOWN', 'unknown');
tz_def('TZ_UNTIL_THE_NEXT_LEVEL', 'until the next level');
tz_def('TZ_USER_ID', 'User ID');
tz_def('TZ_VILLAGE', 'Village:');
tz_def('TZ_VILLAGE_OVERVIEW', 'Village overview');
tz_def('TZ_WAIT_INSTANT', 'Wait: instant');
tz_def('TZ_WARNING', 'Warning:');
tz_def('TZ_WOOD', 'Wood');
tz_def('TZ_YOUR_PERSONAL_REF_LINK', 'Your personal REF Link:');
tz_def('TZ_YOU_CAN_T_USE_THE_VALUES', 'you can\'t use the values');
tz_def('TZ_YOU_HAVE_NOT_BROUGHT_IN_ANY_NEW_PL', 'You have not brought in any new players yet.');

// ===== i18n etape 2 (lot suivant) =====
tz_def('TZ_ACCOUNT_IS_ADMIN_OR_MH', 'Account is Admin or MH');
tz_def('TZ_ACCOUNT_IS_NOT_SCHEDULED_FOR_DELET', 'Account is not scheduled for deletion');
tz_def('TZ_ACCOUNT_STATEMENT', 'Account Statement');
tz_def('TZ_ACTIVATE_VACATION_MODE', 'Activate Vacation Mode');
tz_def('TZ_ADD_RAID', 'Add Raid');
tz_def('TZ_ADD_SLOT', 'Add Slot');
tz_def('TZ_ADVANTAGES', 'Advantages');
tz_def('TZ_AFTER_PAYMENT_YOU_WILL_BE_CREDITED', 'After payment you will be credited automatically.');
tz_def('TZ_AGRESOR', 'Agresor');
tz_def('TZ_ALLIANCE_DIPLOMACY', 'Alliance diplomacy');
tz_def('TZ_ALLIANCE_EVENTS', 'Alliance events');
tz_def('TZ_ALLIANCE_FORUM', 'Alliance Forum');
tz_def('TZ_ALLIANCE_MEMBERS', 'alliance members.');
tz_def('TZ_ALLY_CHAT', 'Ally-Chat');
tz_def('TZ_AM', 'am');
tz_def('TZ_AND_LATER_YOUR_VILLAGE_COULD_LOOK', '...and later your village could look like that.');
tz_def('TZ_AND_QUIT_THE_ALLIANCE_AFTERWARDS', 'and quit the alliance afterwards.');
tz_def('TZ_ASSIGN_RIGHTS', 'Assign rights');
tz_def('TZ_ATTENTION_USE_ONLY_TRUSTWORTHY_GRA', 'ATTENTION! Use only trustworthy graphic packs');
tz_def('TZ_AUTHOR', 'Author');
tz_def('TZ_BEGINNERS_PROT', 'Beginners Prot.');
tz_def('TZ_BEST_PLAYER', 'Best Player');
tz_def('TZ_BUILDING_SITE', 'building site');
tz_def('TZ_BUILD_A_PALACE_OR_RESIDENCE_TO_LEV', 'Build a palace or residence to level 10.');
tz_def('TZ_BUILD_CROPPER', 'Build Cropper');
tz_def('TZ_BUY_IT_IN_THE_GOLD_SHOP', 'Buy it in the Gold Shop');
tz_def('TZ_CELEBRATION_STILL_NEEDS', 'celebration still needs:');
tz_def('TZ_CENTRE', 'Centre:');
tz_def('TZ_CHANGE_NAME', 'Change name');
tz_def('TZ_CHANGE_YOUR_VILLAGE_S_NAME_TO_SOME', 'Change your village\'s name to something nice.');
tz_def('TZ_CHINESE', 'Chinese');
tz_def('TZ_CLAY_25_5_GOLD', 'Clay +25% (5 gold)');
tz_def('TZ_CLOSED_FORUM', 'Closed Forum');
tz_def('TZ_CLOSE_ADRESSBOOK', 'close adressbook');
tz_def('TZ_COMBAT_SIMULATOR', 'Combat-Simulator');
tz_def('TZ_COMPLETE_DEMOLITION_10', 'Complete demolition (10');
tz_def('TZ_CONFEDERATION_FORUM', 'Confederation Forum');
tz_def('TZ_CONFIRM_WITH_PASSWORD', 'Confirm with password:');
tz_def('TZ_CONSTRUCT_A_CRANNY', 'Construct a Cranny.');
tz_def('TZ_CONSTRUCT_A_GRANARY', 'Construct a Granary.');
tz_def('TZ_CONSTRUCT_A_RALLY_POINT', 'Construct a rally point.');
tz_def('TZ_CONSTRUCT_A_WOODCUTTER', 'Construct a woodcutter.');
tz_def('TZ_CONSTRUCT_BARRACKS', 'Construct barracks.');
tz_def('TZ_CONSTRUCT_WAREHOUSE', 'Construct Warehouse.');
tz_def('TZ_CP_DAY', 'CP/day');
tz_def('TZ_CROP_25_5_GOLD', 'Crop +25% (5 gold)');
tz_def('TZ_DATE_AND_TIME', 'Date and time');
tz_def('TZ_DECLARE_WAR', 'declare war');
tz_def('TZ_DEFAULT', 'Default:');
tz_def('TZ_DELETE_ACCOUNT', 'Delete account?');
tz_def('TZ_DIFFERENT_EMAIL_ADDRESS', 'different email address');
tz_def('TZ_DOWNLOAD_FROM', 'Download from');
tz_def('TZ_DO_I_NEED_PLUS_TO_USE_OTHER_FEATUR', 'Do I need Plus to use other features?');
tz_def('TZ_EARN_GOLD', 'Earn gold');
tz_def('TZ_EDIT_ANSWER', 'Edit answer');
tz_def('TZ_EDIT_ANSWER_2', 'edit answer');
tz_def('TZ_EDIT_FORUM', 'edit forum');
tz_def('TZ_EDIT_SLOT', 'Edit Slot');
tz_def('TZ_EDIT_TOPIC', 'Edit topic');
tz_def('TZ_ENDS_ON', 'ends on');
tz_def('TZ_ENGLISH', 'English');
tz_def('TZ_ENTER_HOW_MUCH_LUMBER_THE_BARRACKS', 'Enter how much lumber the barracks cost');
tz_def('TZ_EU_DD_MM_YY_24H', 'EU (dd.mm.yy 24h)');
tz_def('TZ_EXAMPLE', 'Example:');
tz_def('TZ_EXISTING_RELATIONSHIPS', 'Existing relationships');
tz_def('TZ_EXTEND_ALL_RESOURCE_TILES_TO_LEVEL', 'Extend all resource tiles to level 1.');
tz_def('TZ_EXTEND_ALL_RESOURCE_TILES_TO_LEVEL_2', 'Extend all resource tiles to level 2.');
tz_def('TZ_EXTEND_ONE_CLAY_PIT', 'Extend one clay pit.');
tz_def('TZ_EXTEND_ONE_CROPLAND', 'Extend one cropland.');
tz_def('TZ_EXTEND_ONE_IRON_MINE', 'Extend one iron mine.');
tz_def('TZ_EXTEND_ONE_OF_EACH_RESOURCE_TILE_T', 'Extend one of each resource tile to level 2.');
tz_def('TZ_EXTEND_YOUR_MAIN_BUILDING_TO_LEVEL', 'Extend your main building to level 3.');
tz_def('TZ_FINISH', 'Finish');
tz_def('TZ_FOLLOWING_CAUSES_ARE_POSSIBLE', 'Following causes are possible:');
tz_def('TZ_FOLLOW_THIS_LINK_TO', 'Follow this link to');
tz_def('TZ_FOREIGN_OFFERS', 'Foreign offers');
tz_def('TZ_FORUM_TYPE', 'Forum type');
tz_def('TZ_FOUND_A_NEW_VILLAGE', 'Found a new village.');
tz_def('TZ_FREE', 'FREE!');
tz_def('TZ_FRENCH', 'French');
tz_def('TZ_FRIEND_EMAIL_COM', 'friend@email.com');
tz_def('TZ_GAME_LANGUAGE', 'Game language');
tz_def('TZ_GITHUB', 'Github');
tz_def('TZ_GRAPHIC_PACK_FOUND', 'Graphic Pack found.');
tz_def('TZ_GRAPHIC_PACK_SETTINGS', 'Graphic pack settings');
tz_def('TZ_GREAT_STABLES', 'Great Stables');
tz_def('TZ_HERE', 'here');
tz_def('TZ_HERE_YOU_CAN_KICK_THE_PLAYERS_FROM', 'Here you can kick the players from your alliance.');
tz_def('TZ_HERE_YOU_FIND_YOUR_RESOURCE_FIELDS', 'Here you find your resource fields');
tz_def('TZ_HINT', 'Hint');
tz_def('TZ_HOW_DO_I_GET_GOLD', 'How do I get Gold?');
tz_def('TZ_INACTIVE_DURING_VACATION', 'Inactive during vacation');
tz_def('TZ_INFORMATION_ON_HAPPENINGS_IN_YOUR', 'Information on happenings in your village');
tz_def('TZ_INITIATE_PAYMENT_BY_PAYPAL', 'Initiate Payment by PayPal');
tz_def('TZ_INVITATIONS', 'Invitations:');
tz_def('TZ_INVITE_A_PLAYER_INTO_THE_ALLIANCE', 'Invite a player into the alliance');
tz_def('TZ_INVITE_BY_E_MAIL_OR_SHARE_YOUR_REF', 'Invite by e-mail or share your REF link.');
tz_def('TZ_IN_DESCRIPTION', 'in description.');
tz_def('TZ_IN_THE_VILLAGE_YOU_CAN_BUILD_BUILD', 'In the village you can build buildings');
tz_def('TZ_IRON_25_5_GOLD', 'Iron +25% (5 gold)');
tz_def('TZ_ISO_YY_MM_DD_24H', 'ISO (yy/mm/dd 24h)');
tz_def('TZ_ITALIAN', 'Italian');
tz_def('TZ_I_ACTIVATED_PLUS_BUT_PRODUCTION_DI', 'I activated Plus, but production did not increase.');
tz_def('TZ_JOIN_AN_ALLIANCE', 'Join an alliance');
tz_def('TZ_JOIN_AN_ALLIANCE_OR_FOUND_ONE_ON_Y', 'Join an alliance or found one on your own.');
tz_def('TZ_JUL', 'Jul');
tz_def('TZ_JUN', 'Jun');
tz_def('TZ_KICK_ALL_MEMBERS', 'kick all members');
tz_def('TZ_KICK_PLAYER', 'Kick Player:');
tz_def('TZ_LANGUAGE_SETTINGS', 'Language settings');
tz_def('TZ_LAST_POST', 'Last post');
tz_def('TZ_LAST_RAID', 'Last raid');
tz_def('TZ_LINKS', 'Links:');
tz_def('TZ_LINK_TO_THE_FORUM', 'Link to the forum');
tz_def('TZ_LOG_IN', 'log in');
tz_def('TZ_LUMBER_25_5_GOLD', 'Lumber +25% (5 gold)');
tz_def('TZ_MAINTENANCE_OFF', 'Maintenance OFF');
tz_def('TZ_MAINTENANCE_ON', 'Maintenance ON');
tz_def('TZ_MAJOR_CHANGES', 'Major Changes:');
tz_def('TZ_MAP_2', 'Map:');
tz_def('TZ_MAXIMUM_VACATION', 'Maximum vacation:');
tz_def('TZ_MESSAGES', 'Messages:');
tz_def('TZ_MESSAGE_3', 'Message');
tz_def('TZ_MILITARY_EVENTS', 'Military events');
tz_def('TZ_MINIMUM_VACATION', 'Minimum vacation:');
tz_def('TZ_MINOR_CHANGES', 'Minor Changes:');
tz_def('TZ_MISCELLANEOUS', 'Miscellaneous');
tz_def('TZ_MORE_GRAPHIC_PACKS', 'More graphic packs');
tz_def('TZ_MORE_INFO', 'More info:');
tz_def('TZ_MOVE_TOPIC', 'Move topic');
tz_def('TZ_MULTIHUNTER', 'Multihunter:');
tz_def('TZ_NEW_FORUM', 'New forum');
tz_def('TZ_NONE_OF_THE_PACKAGES_ARE_REFUNDABL', 'None of the packages are refundable!');
tz_def('TZ_NOT_ENOUGH_RESOURCE', 'Not enough resource');
tz_def('TZ_NO_MARKETPLACE_ACTIVITY', 'No marketplace activity');
tz_def('TZ_NO_OWNERSHIP_OF_AN_ARTIFACT_VILLAG', 'No ownership of an artifact village');
tz_def('TZ_NO_OWNERSHIP_OF_A_WONDER_OF_THE_WO', 'No ownership of a Wonder of the World village');
tz_def('TZ_NO_REINFORCING_TROOPS_SENT_RECEIVE', 'No reinforcing troops sent/receive');
tz_def('TZ_NO_REPORTS_FOR_TRANSFERS_FROM_FORE', 'No reports for transfers from foreign villages.');
tz_def('TZ_NO_REPORTS_FOR_TRANSFERS_TO_FOREIG', 'No reports for transfers to foreign villages.');
tz_def('TZ_NO_REPORTS_FOR_TRANSFERS_TO_OWN_VI', 'No reports for transfers to own villages.');
tz_def('TZ_N_14_DAYS', '14 days');
tz_def('TZ_N_1_1_TRADE_WITH_THE_NPC_MERCHANT', '1:1 Trade with the NPC merchant');
tz_def('TZ_N_1_5_YOUR_VILLAGE', '(1/5) Your village');
tz_def('TZ_N_1_CHOOSE_A_RESOURCE_FIELD', '1. Choose a resource field');
tz_def('TZ_N_1_CHOOSE_BUILDING_SITE', '1. Choose building site');
tz_def('TZ_N_2_5_RESOURCES', '(2/5) Resources');
tz_def('TZ_N_2_CONSTRUCT_A_BUILDING', '2. Construct a building');
tz_def('TZ_N_2_DAYS', '2 days');
tz_def('TZ_N_2_EXTEND_THE_RESOURCE_FIELD', '2. Extend the resource field');
tz_def('TZ_N_3_5_BUILDINGS', '(3/5) Buildings');
tz_def('TZ_N_4_5_NEIGHBOURS', '(4/5) Neighbours');
tz_def('TZ_N_5_5_NAVIGATION', '(5/5) Navigation');
tz_def('TZ_OFFER_A_CONFEDERATION', 'offer a confederation');
tz_def('TZ_OFFER_NON_AGGRESSION_PACT', 'offer non-aggression pact');
tz_def('TZ_OK_3', 'ok');
tz_def('TZ_ONLINE_USERS', 'Online Users');
tz_def('TZ_OPTION_1', 'Option 1:');
tz_def('TZ_OPTION_2', 'Option 2:');
tz_def('TZ_OPTION_3', 'Option 3:');
tz_def('TZ_OPTION_4', 'Option 4:');
tz_def('TZ_OPTION_5', 'Option 5:');
tz_def('TZ_OPTION_6', 'Option 6:');
tz_def('TZ_OPTION_7', 'Option 7:');
tz_def('TZ_OPTION_8', 'Option 8:');
tz_def('TZ_ORDERED_PACKAGE', 'Ordered Package');
tz_def('TZ_OR_ASK_THE_SERVER_OWNER', 'or ask the server owner.');
tz_def('TZ_OVERVIEW', 'Overview:');
tz_def('TZ_OWN_TEXT', 'Own text:');
tz_def('TZ_PALACE_RESIDENCE', 'Palace/Residence');
tz_def('TZ_PASSWORD', 'password:');
tz_def('TZ_PAYMENT_ACCOUNT', 'payment account');
tz_def('TZ_PAYPAL', 'PayPal');
tz_def('TZ_PAYPAL_PACKAGE_A', 'PayPal – Package A');
tz_def('TZ_PAYPAL_PACKAGE_B', 'PayPal – Package B');
tz_def('TZ_PAYPAL_PACKAGE_C', 'PayPal – Package C');
tz_def('TZ_PAYPAL_PACKAGE_D', 'PayPal – Package D');
tz_def('TZ_PAYPAL_PACKAGE_E', 'PayPal – Package E');
tz_def('TZ_PLAY_NO_TASKS', 'Play no tasks.');
tz_def('TZ_PLEASE_BUILD_A_MARKETPLACE', 'Please build a Marketplace.');
tz_def('TZ_PLUS_FUNCTIONS', 'Plus functions');
tz_def('TZ_PM', 'pm');
tz_def('TZ_POP', 'Pop');
tz_def('TZ_POSITION', 'Position:');
tz_def('TZ_PRODUCTION_CLAY', 'Production: Clay');
tz_def('TZ_PRODUCTION_CROP', 'Production: Crop');
tz_def('TZ_PRODUCTION_IRON', 'Production: Iron');
tz_def('TZ_PRODUCTION_LUMBER', 'Production: Lumber');
tz_def('TZ_PUBLIC_FORUM', 'Public Forum');
tz_def('TZ_RAGEZONE_COM', 'RageZone.com');
tz_def('TZ_RANKING_OF_ALL_PLAYERS', 'Ranking of all players');
tz_def('TZ_RATIO', 'ratio');
tz_def('TZ_READ_YOUR_NEW_MESSAGE', 'Read your new message.');
tz_def('TZ_REGISTERED', 'Registered');
tz_def('TZ_REGISTERED_PLAYERS', 'Registered players');
tz_def('TZ_RELEASED_BY_TRAVIANZ_TEAM', 'Released by: TravianZ Team');
tz_def('TZ_RELEASE_BY_TRAVIANZ', '[Release by: TravianZ]');
tz_def('TZ_REPLIES', 'Replies');
tz_def('TZ_REPORTS', 'Reports:');
tz_def('TZ_REQUIREMENTS', 'Requirements');
tz_def('TZ_ROMANIAN', 'Romanian');
tz_def('TZ_SCOUT_DEFENCES_AND_TROOPS', 'Scout defences and troops');
tz_def('TZ_SCOUT_RESOURCES_AND_TROOPS', 'Scout resources and troops');
tz_def('TZ_SCRIPT_PRICE', 'Script Price:');
tz_def('TZ_SELECT_ALL', 'Select all');
tz_def('TZ_SELECT_REWARD', 'Select reward...');
tz_def('TZ_SELECT_REWARD_2', 'Select Reward:');
tz_def('TZ_SEND_200_CROP_TO_THE_TASKMASTER', 'Send 200 crop to the taskmaster.');
tz_def('TZ_SEND_AND_RECEIVE_MESSAGES', 'Send and receive messages');
tz_def('TZ_SEND_UNITS_BACK', 'Send units back');
tz_def('TZ_SERVER_START', 'Server Start');
tz_def('TZ_SHOW_THE_LARGE_MAP_IN_AN_EXTRA_WIN', 'Show the large map in an extra window.');
tz_def('TZ_SIZE_IN_MB', 'Size in MB');
tz_def('TZ_SLOTS', 'Slots');
tz_def('TZ_START_RAID', 'Start Raid');
tz_def('TZ_STATISTICS', 'Statistics:');
tz_def('TZ_SUPPORT', 'Support:');
tz_def('TZ_SUPPORT_AND_MULTIHUNTER', 'Support and Multihunter');
tz_def('TZ_SURVEY', 'survey');
tz_def('TZ_TARIFFS', 'Tariffs');
tz_def('TZ_TASK_7_HUGE_ARMY', 'Task 7: Huge Army!');
tz_def('TZ_TASK_8_EVERYTHING_TO_1', 'Task 8: Everything to 1.');
tz_def('TZ_THANK_YOU_FOR_USING_OUR_VERSION', 'Thank you for using our version!');
tz_def('TZ_THERE_ARE_NO_INCOMING_TROOPS', 'There are no incoming troops');
tz_def('TZ_THERE_ARE_NO_OUTGOING_TROOPS', 'There are no outgoing troops');
tz_def('TZ_THE_BEST_ALLIANCES_DEF', 'The best alliances (def)');
tz_def('TZ_THE_BEST_ALLIANCES_OFF', 'The best alliances (off)');
tz_def('TZ_THE_BUILDING_WAS_COMPLETELY_DEMOLI', 'The building was completely demolished for 10 gold!');
tz_def('TZ_THE_EMAIL_ACCOUNT_S_STORAGE_LIMIT', 'The email account`s storage limit is reached');
tz_def('TZ_THE_EMAIL_HAS_BEEN_MOVED_TO_THE_SP', 'The email has been moved to the spam/junk folder');
tz_def('TZ_THE_EMAIL_WILL_BE_SENT_TO_FOLLOWIN', 'The email will be sent to following address:');
tz_def('TZ_THE_E_MAIL_ADDRESS_OF_THE_NEW_OWNE', 'The e-mail address of the new owner.');
tz_def('TZ_THE_GAME_WORLD_ON_WHICH_THE_ACCOUN', 'The game world on which the account resides');
tz_def('TZ_THE_HERO', 'The hero');
tz_def('TZ_THE_LARGEST_GAULS', 'The largest Gauls');
tz_def('TZ_THE_LARGEST_PLAYERS', 'The largest players');
tz_def('TZ_THE_LARGEST_ROMANS', 'The largest Romans');
tz_def('TZ_THE_LARGEST_TEUTONS', 'The largest Teutons');
tz_def('TZ_THE_LARGEST_VILLAGES', 'The largest villages');
tz_def('TZ_THE_MOST_EXPERIENCED_HEROES', 'The most experienced heroes');
tz_def('TZ_THE_MOST_SUCCESSFUL_ATTACKERS', 'The most successful attackers');
tz_def('TZ_THE_MOST_SUCCESSFUL_DEFENDERS', 'The most successful defenders');
tz_def('TZ_THE_MULTIHUNTERS_ARE_RESPONSIBLE_F', 'The Multihunters are responsible for compliance with');
tz_def('TZ_THE_NAVIGATION_BAR', 'The navigation bar');
tz_def('TZ_THE_NICKNAME_OF_THE_ACCOUNT', 'The nickname of the account');
tz_def('TZ_THE_PATH', 'The path');
tz_def('TZ_THE_VILLAGE', 'The village');
tz_def('TZ_THIS_FEATURE_IS_NOT_INCLUDED_IN_TH', 'This feature is NOT included in the gold club!');
tz_def('TZ_THIS_IS_HOW_YOU_START', 'This is how you start...');
tz_def('TZ_THREADS', 'Threads');
tz_def('TZ_TIME_PREFERENCE', 'Time Preference');
tz_def('TZ_TIME_ZONES', 'Time zones');
tz_def('TZ_TIP', 'Tip');
tz_def('TZ_TOP_10_ALLIANCES', 'Top 10 Alliances');
tz_def('TZ_TOP_10_PLAYERS', 'Top 10 players');
tz_def('TZ_TOTAL_POPULATION', 'Total Population');
tz_def('TZ_TOTAL_VILLAGES', 'Total Villages');
tz_def('TZ_TO_THE_FIRST_TASK', 'To the first task.');
tz_def('TZ_TO_THE_REGISTRATION', 'to the registration');
tz_def('TZ_TRAIN_3_SETTLERS', 'Train 3 settlers.');
tz_def('TZ_TRAVIAN_DEFAULT', 'Travian Default');
tz_def('TZ_TRAVIAN_GOLD_CLUB', 'Travian Gold Club');
tz_def('TZ_TRAVIAN_T4_STYLE', 'Travian T4 Style');
tz_def('TZ_TRIBES', 'Tribes');
tz_def('TZ_TYPOS_IN_THE_EMAIL_ADDRESS', 'Typos in the email address');
tz_def('TZ_UK_DD_MM_YY_12H', 'UK (dd/mm/yy 12h)');
tz_def('TZ_UPGRADE_ALL_RESOURCES_TILES_TO_LEV', 'Upgrade all resources tiles to level 5.');
tz_def('TZ_UPGRADE_YOUR_GRANARY_TO_LEVEL_3', 'Upgrade your granary to level 3.');
tz_def('TZ_UPGRADE_YOUR_MAIN_BUILDING_TO_LEVE', 'Upgrade your main building to level 5.');
tz_def('TZ_UPGRADE_YOUR_WAREHOUSE_TO_LEVEL_7', 'Upgrade your warehouse to level 7.');
tz_def('TZ_USE', 'Use');
tz_def('TZ_USED_FOR_RALLY_POINT_AND_MARKETPLA', 'Used for rally point and marketplace:');
tz_def('TZ_USERNAME', 'Username');
tz_def('TZ_USER_DEFINED_GRAPHIC_PACK', 'User-defined graphic pack');
tz_def('TZ_USE_IT_FOR_PLUS_OR_ANY_ADVANTAGE', '. Use it for Plus or any advantage.');
tz_def('TZ_US_MM_DD_YY_12H', 'US (mm/dd/yy 12h)');
tz_def('TZ_UTC_1', 'UTC+1');
tz_def('TZ_UTC_10', 'UTC+10');
tz_def('TZ_UTC_10_2', 'UTC-10');
tz_def('TZ_UTC_11', 'UTC+11');
tz_def('TZ_UTC_11_2', 'UTC-11');
tz_def('TZ_UTC_12', 'UTC+12');
tz_def('TZ_UTC_1_2', 'UTC-1');
tz_def('TZ_UTC_2', 'UTC+2');
tz_def('TZ_UTC_2_2', 'UTC-2');
tz_def('TZ_UTC_3', 'UTC+3');
tz_def('TZ_UTC_3_2', 'UTC-3');
tz_def('TZ_UTC_4', 'UTC+4');
tz_def('TZ_UTC_4_2', 'UTC-4');
tz_def('TZ_UTC_5', 'UTC+5');
tz_def('TZ_UTC_5_2', 'UTC-5');
tz_def('TZ_UTC_6', 'UTC+6');
tz_def('TZ_UTC_6_2', 'UTC-6');
tz_def('TZ_UTC_7', 'UTC+7');
tz_def('TZ_UTC_7_2', 'UTC-7');
tz_def('TZ_UTC_8', 'UTC+8');
tz_def('TZ_UTC_8_2', 'UTC-8');
tz_def('TZ_UTC_9', 'UTC+9');
tz_def('TZ_UTC_9_2', 'UTC-9');
tz_def('TZ_VERSION', 'Version:');
tz_def('TZ_VILLAGE_EXP', 'Village Exp.');
tz_def('TZ_VILLAGE_YOU_GET', 'village, you get');
tz_def('TZ_VILLAGE_YOU_WILL_BE_CREDITED_WITH', 'village, you will be credited with');
tz_def('TZ_VIP_ACCOUNT_10_GOLD_7_DAYS', 'VIP Account (10 gold – 7 days)');
tz_def('TZ_VISIT', 'Visit:');
tz_def('TZ_VOTE', 'Vote');
tz_def('TZ_WAIT_24H', 'Wait: 24h');
tz_def('TZ_WAIT_INSTANT_AFTER_IPN', 'Wait: instant after IPN');
tz_def('TZ_WARNING_CATAPULT_WILL', 'Warning: Catapult will');
tz_def('TZ_WE_STRIVE_TO_ENSURE_SPEEDY_PROCESS', 'We strive to ensure speedy processing!');
tz_def('TZ_WHY_CAN_T_I_FINISH_SOME_BUILDINGS', 'Why can\'t I finish some buildings with Gold?');
tz_def('TZ_WILL_BE_ATTACKED_BY_CATAPULT_S', '(will be attacked by catapult(s))');
tz_def('TZ_WILL_SPAWN_IN', 'will spawn in:');
tz_def('TZ_WOODCUTTER_INSTANTLY_COMPLETED', 'Woodcutter instantly completed.');
tz_def('TZ_WORLD_STATS', 'World Stats');
tz_def('TZ_WRITE_THE_CODE', 'Write the code');
tz_def('TZ_WRONG_DOMAIN_THERE_IS_E_G_NO_AOL_D', 'Wrong domain: There is e.g. no @aol.de, only @aol.com');
tz_def('TZ_YOUR_ACCOUNT_HAS_BEEN_SUCCESSFULLY', 'Your account has been successfully activated.');
tz_def('TZ_YOUR_VILLAGE_AND_YOUR_NEIGHBOURS', 'Your village and your neighbours');
tz_def('TZ_YOU_CAN_UNDO_THE_REGISTRATION_AND', 'You can undo the registration and re-register with a');
tz_def('TZ_YOU_CAN_USE_THIS_GOLD_FOR_PLUS_OR', '. You can use this gold for Plus or any gold advantage.');

// ===== i18n etape 2 (lot suivant) =====
tz_def('TZ_ACCOUNT_OR_INCREASE_YOUR_RESOURCE', '-Account or increase your resource production.To do so click');
tz_def('TZ_ADDITIONALLY_THE_TRAVIAN_TEAM_WILL', 'Additionally, the Travian Team will not provide information concerning bans to any person, other than the account owner.');
tz_def('TZ_ADVERTISEMENT_OF_ANY_KIND_THAT_HAS', 'Advertisement of any kind that has not been permitted by the Travian Team is impermissible.');
tz_def('TZ_AFTERWARDS_BOTH_PARTIES_MUST_REQUE', 'Afterwards, both parties must request the password for their new account via the password retrieval function.');
tz_def('TZ_AFTER_TAKING_CARE_OF_YOUR_RESOURCE', 'After taking care of your resource supply you can start the expansion of your village.');
tz_def('TZ_ANY_SALES_OR_PURCHASES_CONCERNING', 'Any sales or purchases concerning real money regarding accounts, units, villages, resources, services or any other aspect of Travian are impermissible. The sale of Travian accounts as well as any indirect transfer (even as gifts) in connection with auction sites or other money transactions is impermissible.');
tz_def('TZ_AS_A_LEADER_YOU_CAN_ONLY_CHANGE_YO', 'As a leader, you can only change your title. Your rights remain at their maximum.');
tz_def('TZ_A_SITTER_CAN_LOG_INTO_YOUR_ACCOUNT', 'A sitter can log into your account by using your name and his/her password. You can have up to two sitters.');
tz_def('TZ_A_WAREHOUSE_AND_A_GRANARY_ENABLE_Y', 'A warehouse and a granary enable you to store more resources. A cranny saves your resources from getting stolen by enemy raiders.');
tz_def('TZ_BECAUSE_YOU_ARE_THE_ALLIANCE_FOUND', 'Because you are the alliance founder, you need to select a replacement founder before you leave.');
tz_def('TZ_BEFORE_YOU_EXPAND_YOUR_VILLAGE_S_B', 'Before you expand your village\'s buildings, you should develop some resource fields to increase your resource supply.');
tz_def('TZ_BLACKMAILING_PLAYERS_IN_A_WAY_THAT', 'Blackmailing players in a way that violates any of Travian\'s rules in accordance with the General Terms and Conditions.');
tz_def('TZ_COMPLETE_CONSTRUCTION_ORDERS_AND_R', 'Complete construction orders and researches in this village now');
tz_def('TZ_DISPLAYING_BATTLE_REPORTS_OR_MESSA', 'Displaying battle reports or messages in public without consent of both concerned parties.');
tz_def('TZ_EACH_PLAYER_MAY_ONLY_OWN_AND_PLAY', 'Each player may only own and play one account per server.');
tz_def('TZ_ENGLISH_IS_THE_ONLY_LANGUAGE_TOLER', 'English is the only language tolerated in messages and descriptions.');
tz_def('TZ_FOLLOWING_BEHAVIOR_IS_PUNISHABLE_A', 'Following behavior is punishable and applies to all descriptions, the account name, alliance names, village names and messages:');
tz_def('TZ_HERE_YOU_CAN_CHANGE_TRAVIAN_S_DISP', 'Here you can change Travian\'s displayed time to fit your time zone.');
tz_def('TZ_HERE_YOU_CAN_HAVE_A_LOOK_AT_YOUR_V', 'Here you can have a look at your village\'s surrounding area and your neighbours');
tz_def('TZ_HOWEVER_IT_IS_PERMISSIBLE_TO_TRANS', 'However, it is permissible to transfer the password of an account to a person or persons playing on a different game world (or not playing at all) in order to play a single account together.');
tz_def('TZ_IF_INDIVIDUAL_REGULATIONS_OF_THIS', 'If individual regulations of this set of rules should prove to be in any way ineffective, it does not affect the validity of the remaining regulations of this set of rules. The Administrators commit themselves to replace ineffective regulations with new regulations which replace the ineffective regulations as fast as possible.');
tz_def('TZ_IF_THERE_IS_AN_OFFENCE_AGAINST_THE', 'If there is an offence against these game rules, the Multihunters and, if necessary, the Administrators will ban the account(s) in question and decide on a proper punishment. Punishments will always exceed the gain of the violation of the rules.');
tz_def('TZ_IF_YOUR_ALLIANCE_WANTS_TO_USE_AN_E', 'If your alliance wants to use an external forum, you can enter the url here.');
tz_def('TZ_IMPERSONATING_OFFICIALS_OR_OFFICIA', 'Impersonating officials or official positions is illegal in any way.');
tz_def('TZ_INCITING_MANIPULATING_ENCOURAGING', 'Inciting, manipulating, encouraging, assisting or conspiring with others to violate any of Travian Rules is impermissible. These rules apply for players that will delete their accounts or are currently deleting their accounts without exception.');
tz_def('TZ_INTO_YOUR_PROFILE_BY_ADDING_IT_TO', 'into your profile by adding it to one of the two description fields.');
tz_def('TZ_IN_ORDER_TO_ACTIVATE_YOUR_ACCOUNT', 'In order to activate your account enter the code or click on the link in your email.');
tz_def('TZ_IN_ORDER_TO_PLAY_TRAVIAN_YOU_NEED', 'In order to play Travian you need a valid email address to which the activation code can be send. There are exceptional cases when this email might not arrive.');
tz_def('TZ_IN_ORDER_TO_QUIT_THE_ALLIANCE_YOU', 'In order to quit the alliance you have to enter your password again for safety reasons.');
tz_def('TZ_IN_ORDER_TO_SWITCH_AN_ACCOUNT_WITH', 'In order to switch an account with another person on the same game world, both persons must send an e-mail message to admin@travian.com from the e-mail address currently registered to the account. The e-mail must contain the following information:');
tz_def('TZ_IN_THE_BEGINNING_YOUR_SMALL_VILLAG', 'In the beginning your small village will have just one building.');
tz_def('TZ_IN_TRAVIAN_YOU_ARE_NOT_ALONE_YOU_I', 'In Travian you are not alone; you interact with thousands of other players in the Travian world.');
tz_def('TZ_IT_S_PART_OF_DIPLOMATIC_ETIQUETTE', 'It\'s part of diplomatic etiquette to talk to another alliance before sending an offer.');
tz_def('TZ_MULTIACCOUNTS_ON_THE_SPEED_SERVER', 'Multiaccounts on the speed server and multiaccounts with less than 100 population may be deleted on sight with no prior warning.');
tz_def('TZ_NOW_YOU_HAVE_FULFILLED_ALL_PREREQU', 'Now you have fulfilled all prerequisites required to construct a Marketplace.');
tz_def('TZ_NOW_YOU_KNOW_EVERYTHING_IMPORTANT', 'Now you know everything important about Travian. After registration you can start playing!');
tz_def('TZ_NO_EVERY_GOLD_FEATURE_WORKS_STANDA', 'No. Every gold feature works standalone as long as you have enough gold.');
tz_def('TZ_NO_REAL_WORLD_POLITICS_ARE_ALLOWED', 'No real world politics are allowed in names, messages and descriptions.');
tz_def('TZ_PARTICIPATION_IN_ABUSIVE_DEFAMATOR', 'Participation in abusive, defamatory, sexist, racist or profane language; disparaging any religion, race, nation, gender, age group, or sexual orientation; threatening a person with actions in real life.');
tz_def('TZ_PLAYERS_MAY_TALK_TO_THE_MULTIHUNTE', 'Players may talk to the Multihunter who banned them or an Administrator either via IGM (ingame message) or e-mail. Bans, punishments or deletions are not to be discussed in public (e.g. Chat or Forums). Appeals must be written in English.');
tz_def('TZ_PLEASE_ENTER_YOUR_OLD_AND_YOUR_NEW', 'Please enter your old and your new e-mail addresses. You will then receive a code snippet at both e-mail addresses which you have to enter here.');
tz_def('TZ_PLUS_DOES_NOT_INCLUDE_PRODUCTION_B', 'Plus does not include production bonuses. You must buy +25% for each resource separately in');
tz_def('TZ_PROGRAM_ERRORS_ALSO_CALLED_BUGS_MA', 'Program errors (also called bugs) may not be used to one\'s benefit. Abuse can lead to a punishment of the account.');
tz_def('TZ_RESIDENCE_PALACE_AND_WORLD_WONDER', 'Residence, Palace and World Wonder villages are excluded for gameplay reasons.');
tz_def('TZ_RESOURCES_BUILDINGS_VILLAGES_OR_TR', 'Resources, buildings, villages or troops lost during the time of suspension do not count as punishment and will not be replaced by the Travian Team. No player has the right to claim payment or replacement for Plus/Gold time lost due to suspension.');
tz_def('TZ_SHOOT_WITH_A_NORMAL_ATTACK_THEY_DO', 'shoot with a normal attack (they dont shoot with raids!)');
tz_def('TZ_SOMETIMES_THE_EMAIL_IS_MOVED_TO_TH', 'Sometimes the email is moved to the spam folder. For further help click');
tz_def('TZ_THERE_ARE_FOUR_DIFFERENT_TYPES_OF', 'There are four different types of resources in Travian: lumber, clay, iron and crop.');
tz_def('TZ_THERE_IS_NO_COMPENSATION_FOR_DAMAG', 'There is no compensation for damages done by a sitter. Account owners are fully responsible for the actions done by the chosen sitters of their account. In the event that sitters of an account do not follow these rules and the General Terms and Conditions of Travian, both the account owner and the sitter may be held responsible and punished.');
tz_def('TZ_THERE_IS_NO_COMPENSATION_FOR_DAMAG_2', 'There is no compensation for damages done by someone knowing the password of an account. The person receiving the password is subjected to the rules of Travian as well as the General Terms and Conditions.');
tz_def('TZ_THERE_IS_NO_SPECIAL_TREATMENT_FOR', 'There is no special treatment for Travian Plus/Gold users regarding the game rules neither in the time needed to deal with the case nor in the punishment.');
tz_def('TZ_THE_E_MAIL_ADDRESS_USED_FOR_THE_RE', 'The e-mail address used for the registration of an account must be under the personal and exclusive control of the person who registered the account. The person owning the e-mail address currently registered for an account is considered the owner of the account, regardless of any other personal or alliance agreements. The owner of an account is fully responsible for all actions taken by the account.');
tz_def('TZ_THE_FOLLOWING_SET_OF_RULES_ARE_IN', 'The following set of rules are in conjunction to the General Terms and Conditions of Travian. You should familiarize yourself with the General Terms and Conditions to verify what is allowed and what is prohibited, especially in case of an account that has been banned for a rule violation.');
tz_def('TZ_THE_GAME_MUST_BE_PLAYED_WITH_AN_UN', 'The game must be played with an unmodified internet browser. The use of scripts or bots which automate account actions is against the rules.');
tz_def('TZ_THE_OWNER_OF_AN_ACCOUNT_MAY_NOT_TR', 'The owner of an account may not transfer the password of an account to any person playing on the same game world (server). Additionally, knowingly choosing the same password on the same game world as another person is illegal; any of these actions is considered multiaccounting, as defined in these rules.');
tz_def('TZ_THE_PLAYERS_IN_YOUR_SURROUNDING_AR', 'The players in your surrounding area are most important to you. Thanks to the map you have a good overview of who they are.');
tz_def('TZ_THE_REGISTRATION_WAS_SUCCESSFUL_IN', 'The registration was successful. In the next few minutes you will receive an email with the access information.');
tz_def('TZ_THE_SUPPORT_IS_A_GROUP_OF_EXPERIEN', 'The support is a group of experienced players who will answer your questions gladly.');
tz_def('TZ_THE_TRAVIAN_TEAM_RESERVES_THE_RIGH', 'The Travian Team reserves the right to change the rules at any time.');
tz_def('TZ_TO_BRING_IN_NEW_PLAYERS_INVITE_THE', 'To bring in new players, invite them by e-mail or share your REF link.');
tz_def('TZ_VACATION_MODE_CANNOT_BE_ACTIVATED', 'Vacation mode cannot be activated – requirements not met');
tz_def('TZ_WE_WILL_SHOW_YOU_HOW_TO_EXPAND_YOU', 'We will show you how to expand your village so that it becomes a mighty and prosperous city on the next page.');
tz_def('TZ_YOU_CAN_DELETE_YOUR_ACCOUNT_HERE_A', 'You can delete your account here. After starting the cancellation it will take three days to complete the cancellation of your account. You can cancel this process within the first 24 hours.');
tz_def('TZ_YOU_DON_T_HAVE_ENOUGH_GOLD_YOU_NEE', 'You don\'t have enough gold. You need 10 gold for instant demolition.');
tz_def('TZ_YOU_HAVE_BEEN_ENTERED_AS_SITTER_ON', 'You have been entered as sitter on the following accounts. You can cancel this by clicking the red X.');

// ===== i18n composites (Simulateur) =====
tz_def('TZ_NUMBER', 'Number');
tz_def('TZ_LVL', 'Lvl');

// ===== i18n reliquat multi-lignes =====
tz_def('TZ_ML_LEADER_DEMOLITION_EMBASSY', 'Because you are the leader of your alliance, demolition of your current Embassy cannot be started, since it still holds all of your');
tz_def('TZ_ML_CHANGELOG_120BUGS', 'Over 120 bugs fixed, artifacts fully fixed, catapults and rams fully fixed, automated Natars/Artifacts/WW villages/WW building plans, new battle formula (more precise than the old one), automatic artifacts activation, rewritten a lot of code. See more in readme file!');
tz_def('TZ_ML_CHANGELOG_NEWFORUM', 'New forum system, Travian-like trapper formula, fixed master builder, double research queue in blacksmith and armoury with plus');
tz_def('TZ_ML_GOLD_RESERVE', 'Basically, we reserve the ordered amount of gold immediately after the payment. If there are any problems, please send an email to our');
tz_def('TZ_ML_GPACK_NOTFOUND', 'Graphic Pack could not be found. This could be due to the following reasons:');
tz_def('TZ_ML_GPACK_ALLOWED_SAVE', 'shows an allowed Graphic Pack. Save your choice to activate it.');
tz_def('TZ_ML_GPACK_ALTER_APPEARANCE', 'With a graphic pack you can alter the appearance of Travian. You can choose one from the list or provide a custom path.');
tz_def('TZ_ML_QUESTIONS_MULTIHUNTER', '. If you have questions or want to report a violation, you can message a Multihunter.');
tz_def('TZ_ML_AWAY_NO_SITTER', 'If you plan on being away for an extended period of time and do not wish to set a sitter, you can activate');
tz_def('TZ_ML_ACCOUNT_FROZEN', '. During this time your account is essentially frozen. No resources, troops or research will progress and your villages cannot be attacked. Remember, this just freezes your Travian, not time.');
tz_def('TZ_ML_ACTIVATION_RESENT', '. Then the activation code will be send again');
tz_def('TZ_ML_TWO_SITTERS_RIGHT', 'Every player has the right to name two sitters who may play the account during the owner\'s absence. Sitters must play the account they are sitting to the account’s full benefit. Abuse of this function is punishable.');
tz_def('TZ_ML_SAME_COMPUTER_SITTER', 'Players using the same computer and wanting to access each other\'s account must use the sitter function.');
tz_def('TZ_ML_POLITE_TONE', 'Everyone must communicate in a polite, conversational tone. Multihunters may change inappropriate profiles and village names without warning.');
tz_def('TZ_ML_MATERIAL_UNDERAGE', 'Posting or transmission of any material not suitable for underage persons.');

// ===== i18n reliquat final =====
tz_def('TZ_NO_BEGINNER_PROT2', 'No beginner’s protection');
tz_def('TZ_SERVER_RUNNING_ON', '▶ Server running on');

// ===== task A: re-wired reverted templates =====
tz_def('TZ_HERO', "Hero");
tz_def('TZ_SEND_UNITS_BACK_TO', "Send units back to");
tz_def('TZ_CONFIRM_DEMOLISH_COMPLETE_1', "Surely you want to demolish COMPLETELY ");
tz_def('TZ_CONFIRM_DEMOLISH_COMPLETE_2', " for 10 GOLD?\nThe building will disappear instantly, it cannot be undone.");
tz_def('TZ_CONFIRM_LAST_EMBASSY_L3', "WARNING!\n\nYou are about to demolish the last lvl3 Embassy!\n\nSince you are the leader of your alliance and because there are no additional members left, the alliance will be disbanded once the demolition completes.");
tz_def('TZ_CONFIRM_LAST_EMBASSY_L1', "WARNING!\n\nYou are about to demolish your last Embassy!\n\nSince you are in an alliance, you will automatically quit that alliance once the demolition completes.");
tz_def('TZ_TRADE', "Trade");

// ===== reports section (noticeClass tooltips) =====
tz_def('TZ_RPT_SCOUT', "Scout Report");
tz_def('TZ_RPT_WON_ATK_NOLOSS', "Won as attacker without losses");
tz_def('TZ_RPT_WON_ATK_LOSS', "Won as attacker with losses");
tz_def('TZ_RPT_LOST_ATK_LOSS', "Lost as attacker with losses");
tz_def('TZ_RPT_WON_DEF_NOLOSS', "Won as defender without losses");
tz_def('TZ_RPT_WON_DEF_LOSS', "Won as defender with losses");
tz_def('TZ_RPT_LOST_DEF_LOSS', "Lost as defender with losses");
tz_def('TZ_RPT_LOST_DEF_NOLOSS', "Lost as defender without losses");
tz_def('TZ_RPT_REINF_ARRIVED', "Reinforcement arrived");
tz_def('TZ_RPT_WOOD_DELIVERED', "Wood Delivered");
tz_def('TZ_RPT_CLAY_DELIVERED', "Clay Delivered");
tz_def('TZ_RPT_IRON_DELIVERED', "Iron Delivered");
tz_def('TZ_RPT_CROP_DELIVERED', "Crop Delivered");
tz_def('TZ_RPT_WON_SCOUT_ATK', "Won scouting as attacker");
tz_def('TZ_RPT_LOST_SCOUT_ATK', "Lost scouting as attacker");
tz_def('TZ_RPT_WON_SCOUT_DEF', "Won scouting as defender");
tz_def('TZ_RPT_LOST_SCOUT_DEF', "Lost scouting as defender");

// ===== report topic connectors (display-time localization) =====
tz_def('TZ_RT_ATTACKS', "attacks");
tz_def('TZ_RT_REINFORCEMENT', "reinforcement");
tz_def('TZ_RT_SCOUTS', "scouts");
tz_def('TZ_RT_SEND_RES_TO', "send resources to");
tz_def('TZ_RT_WAS_ATTACKED', "was attacked");
tz_def('TZ_RT_REINF_IN', "Reinforcement in");
tz_def('TZ_RT_ELDERS_REINF', "village of the elders reinforcement");
tz_def('TZ_RT_UNOCC_OASIS', "Unoccupied Oasis");

// ===== settler reports (issue #178) =====
tz_def('TZ_RT_NEW_VILLAGE', "New village founded");
tz_def('TZ_RT_VALLEY_OCCUPIED', "Settling failed (valley occupied)");
tz_def('TZ_NEW_VILLAGE_MSG', "You have founded a new village:");
tz_def('TZ_VALLEY_OCCUPIED_MSG', "Your settlers could not settle here - the valley is already occupied by another player. They are on their way back.");

// ===== player profile page (#189) =====
tz_def('AGE', 'Age');
tz_def('CAPITAL_TAG', 'Capital');
tz_def('WRITE_MESSAGE_UNAVAILABLE', 'Write message not available');
tz_def('PROFILE_FLAG_ADMIN', 'This player is Admin.');
tz_def('PROFILE_FLAG_MULTIHUNTER', 'This player is Multihunter.');
tz_def('PROFILE_FLAG_BANNED', 'This player is BANNED.');
tz_def('PROFILE_FLAG_VACATION', 'This player is on VACATION.');

// ===== in-game manual overview page (#189) =====
tz_def('BUILDINGS', 'Buildings');
tz_def('INFRASTRUCTURE', 'Infrastructure');
tz_def('FORWARD', 'forward');
tz_def('NEW_FEATURES', 'New features');
tz_def('NEW_WINDOW', 'new window');
tz_def('MANUAL_INTRO', 'This ingame help offers you the chance to look up important information at any time.');
tz_def('MANUAL_NEW_FEATURES_DESC', 'These are new features that you will not find in the real version of the game Travian T3.6. Here you can get acquainted with all new features in more detail.');
tz_def('MANUAL_FAQ', 'Travian FAQ');
tz_def('MANUAL_FAQ_DESC', 'This ingame help just gives you brief information. More information is available at the');

// ===== manual: building pages (PR-A) =====
tz_def('CONSTRUCTION_TIME', "construction time");
tz_def('MANUAL_FOR_LEVEL_1', "for level 1:");
tz_def('CROP_CONSUMPTION', "Crop consumption");
tz_def('NONE', "none");
tz_def('MANUAL_DESC_TRAPPER', "The trapper protects your village with well hidden traps. This means that unwary enemies can be imprisoned and won't be able to harm your village anymore.");
tz_def('MANUAL_ONE_TRAP_COSTS', "One trap costs");
tz_def('MANUAL_TRAPPER_FREE', "Troops cannot be freed with a raid. When the troops get freed with a successful normal attack, 1/3 of the traps are automatically repaired. If the owner of the traps release the captives all of the traps can be repaired.");
tz_def('MANUAL_TRAPPER_GAULS', "Note that this building can only be constructed by Gauls.");
tz_def('MANUAL_DESC_WOODCUTTER', "The woodcutter cuts down trees in order to produce lumber. The further you extend the woodcutter the more lumber is produced by it.<br /><br />By constructing a Sawmill you can increase the production further.");
tz_def('MANUAL_DESC_CLAYPIT', "Clay is collected from clay pits. The higher the clay pit's level, the more clay is produced.");
tz_def('MANUAL_DESC_IRONMINE', "Here miners gather the precious resource iron. By increasing the mine's level you increase its iron production. By constructing an Iron Foundry you can increase the production further.<br /><br />");
tz_def('MANUAL_DESC_CROPLAND', "Your population's food is produced here. By increasing the cropland's level you increase its crop production.<br /><br />By constructing a grain mill and a bakery you can increase the production further.");
tz_def('MANUAL_DESC_SAWMILL', "Lumber cut by your woodcutters is processed here. Based on its level your sawmill can increase your wood production by up to 25 percent.");
tz_def('MANUAL_DESC_BRICKYARD', "The brickyard converts clay into bricks. Based on its level your brickyard can increase your clay production by up to 25 percent.");
tz_def('MANUAL_DESC_IRONFOUNDRY', "The iron foundry melts iron. Based on its level your iron foundry can increase your iron production by up to 25 percent.");
tz_def('MANUAL_DESC_GRAINMILL', "The grain mill changes grain into flour. Based on its level your grain mill can increase your crop production by up to 25 percent.");
tz_def('MANUAL_DESC_BAKERY', "The bakery changes flour into bread. In conjunction to the grain mill the increase in crop production can go up to 50 percent in total.");
tz_def('MANUAL_DESC_WAREHOUSE', "The resources lumber, clay and iron are stored in the warehouse. By increasing its level you increase your warehouse's capacity.");
tz_def('MANUAL_DESC_GRANARY', "The crop produced in your farms is stored in the granary. By increasing its level you increase the granary's capacity.");
tz_def('MANUAL_DESC_BLACKSMITH', "Your warriors' weapons are enhanced in the blacksmith's melting furnaces. By increasing its level you can order the fabrication of even better weapons.");
tz_def('MANUAL_DESC_ARMOURY', "Your warriors' armour is enhanced in the armoury's melting furnaces. By increasing its level you can order the fabrication of even better armour.");
tz_def('MANUAL_DESC_MAINBUILDING', "The village's master builders live in the main building. The higher its level the faster your master builders complete the construction of new buildings.");
tz_def('MANUAL_DESC_RALLYPOINT', "Your village's troops meet here. From here you can send them out to conquer, raid or reinforce other villages.<br /><br />The rally point can only be built on the green grassland below your main building and to the right.");
tz_def('MANUAL_DESC_MARKETPLACE', "At the marketplace you can trade resources with other players. The higher its level, the more resources can be transported at the same time.");
tz_def('MANUAL_DESC_EMBASSY', "The embassy is a place for diplomats. At level 1 you can join an alliance, after extending it to level 3 you may even found one yourself.<br /><br />The maximum number of possible members in an alliance is equal to 3 times the level of the highest level embassy within that alliance. Therefore with a level 20 embassy up to 60 players can be in the alliance.");
tz_def('MANUAL_DESC_BARRACKS', "Infantry can be trained in the barracks. The higher its level the faster the troops are trained.");
tz_def('MANUAL_DESC_STABLE', "Cavalry can be trained in the stable. The higher its level the faster the troops are trained.");
tz_def('MANUAL_DESC_WORKSHOP', "Siege engines like catapults and rams can be built in the workshop. The higher its level the faster the units are produced.");
tz_def('MANUAL_DESC_ACADEMY', "New unit types can be developed in the academy. By increasing its level you can order the research of better units.");
tz_def('MANUAL_DESC_CRANNY', "The cranny is used to hide at least some of your resources when the village is attacked. These resources cannot be stolen.<br /><br />At level 1 the cranny holds 100 units of each resource. Gaulic crannies are twice as big as the others.<br /><br />HINTS<br />In T3 the cranny is 66% as effective against Teutons.<br />In T3.5 the cranny is 80% as effective against Teutons.");
tz_def('MANUAL_DESC_TOWNHALL', "In the town hall you can hold pompous celebrations. Such a celebration increases your culture points.<br /><br />Culture points are necessary to found or conquer new villages. Each building produces culture points and the higher its level the more it produces. With celebrations you can increase this production for a short while.");
tz_def('MANUAL_DESC_RESIDENCE', "The residence is a small palace where the King or Queen lives when he or she visits the village. The residence protects the village against enemies who want to conquer it.");
tz_def('MANUAL_DESC_PALACE', "The King or Queen of the empire lives in the palace. Only one palace can exist in your realm at a time. You need a palace in order to proclaim a village to be your capital.<br /><br />The capital can not be conquered. Additionally, the capital is the only place where resource fields can be extended beyond level 10 and the only place where the stonemason's lodge can be built.");
tz_def('MANUAL_DESC_TREASURY', "The riches of your empire are kept in the treasury. A treasury can only store one artefact.<br /><br />You need a treasury level 10 for a small artefact, or level 20 for a great one.");
tz_def('MANUAL_DESC_TRADEOFFICE', "In the trade office the merchants' carts get improved and equipped with powerful horses. The higher its level the more your merchants are able to carry.");
tz_def('MANUAL_DESC_GREATBARRACKS', "The great barracks allows you to build more units at the same time but they cost thrice the original amount.<br /><br />It cannot be built in the capital.");
tz_def('MANUAL_DESC_GREATSTABLE', "The great stable allows you to build more units at the same time but they cost thrice the original amount.<br /><br />It cannot be built in the capital.");
tz_def('MANUAL_DESC_STONEMASON', "The stonemason's lodge is an expert at cutting stone. The further the building is extended the higher the stability of the village's buildings.<br /><br />It can only be built in the capital.");
tz_def('MANUAL_DESC_BREWERY', "Tasty mead is brewed in the brewery and later quaffed by the soldiers during the celebrations.<br /><br />These drinks make your soldiers braver and stronger in battles (1% per level). Unfortunately the chiefs' power of persuasion is decreased and catapults can only do random hits.<br /><br />It can only be built by Teutons and only in their capital. It affects the whole empire.");
tz_def('MANUAL_DESC_HEROSMANSION', "In the hero's mansion you can train a hero. For this you need a normal soldier who will become the hero and therefore you need a barracks or a stable.<br /><br />When the building reaches levels 10, 15 and 20 you can annex 1, 2 and 3 unoccupied oases with your hero. Depending on the oasis you will get an increase in production for a certain resource (or even two resources for some oases).");
tz_def('MANUAL_DESC_GREATWAREHOUSE', "The resources lumber, clay and iron are stored in your warehouse. The great warehouse offers you more space and keeps your resources drier and safer than the normal warehouse.<br /><br />This building can only be built in the old natarian villages or with special natarian artefacts.");
tz_def('MANUAL_DESC_GREATGRANARY', "The crop produced by your farms is stored in the granary. The great granary offers you more space and keeps your crops drier and safer than the normal one.<br /><br />This building can only be built in the old natarian villages or with special natarian artefacts.");
tz_def('MANUAL_DESC_WONDER', "The wonder of the world represents the pride of creation. Only the mightiest and richest are able to build such a masterwork and defend it against envious enemies.<br /><br />Wonders of the world can only be erected in the old natarian villages. Also a construction plan is necessary. Starting with level 50 an additional plan is needed. This one has to be owned by another player in the same alliance.");
tz_def('MANUAL_DESC_HORSEDRINKING', "The horse drinking trough cares for the wellbeing of your horses and therefore also increases the speed of their training.<br /><br />The horse drinking trough reduces the crop usage by one for the following soldiers: Equites Legati from level 10, Equites Imperatoris from level 15 and Equites Caesaris from level 20.<br /><br />The horse drinking trough can only be built by Romans.");
tz_def('MANUAL_DESC_GREATWORKSHOP', "In the great workshop siege engines like catapults and rams can be built, albeit at triple the cost of a standard unit. The higher its level the faster units are produced.<br /><br />It cannot be built in the capital.");

tz_def('MANUAL_ATTACK_VALUE', "attack value");
tz_def('MANUAL_DEF_INFANTRY', "defence against infantry");
tz_def('MANUAL_DEF_CAVALRY', "defence against cavalry");
tz_def('MANUAL_VELOCITY', "Velocity");
tz_def('MANUAL_FIELDS_HOUR', "fields/hour");
tz_def('MANUAL_CAN_CARRY', "Can carry");
tz_def('MANUAL_TRAINING_DURATION', "Duration of training");
tz_def('MANUAL_NPC_NATARS', "Description is intended for reference only. The Natars are a pure NPC tribe and thus cannot be played by oneself.");
tz_def('MANUAL_NPC_NATURE', "Description is intended for reference only. The Nature are a pure NPC tribe and thus cannot be played by oneself.");
tz_def('MANUAL_UDESC_ANIMAL_EXP', "The experience a hero gains by killing an animal is determined by the upkeep the animal needed. This means a %s will give just %d experience point.");
tz_def('MANUAL_UDESC_1', "The Legionnaire is the simple and all-purpose infantry of the Roman Empire. With his well-rounded training, he is good at both defence and attack. However, the Legionnaire will never reach the levels of the more specialized troops.");
tz_def('MANUAL_UDESC_2', "The Praetorians are the emperor's guard and they defend him with their life. Because their training is specialized for defence, they are very weak attackers.");
tz_def('MANUAL_UDESC_3', "The Imperian is the ultimate attacker of the Roman Empire. He is quick, strong, and the nightmare of all defenders. However, his training is expensive and time-intensive.");
tz_def('MANUAL_UDESC_4', "The Equites Legati are the roman reconnaissance troops. They are pretty fast and can spy on enemy villages in order to see resources and troops. <br /><br /> If there are no Scouts, Equites Legati or Pathfinders in the scouted village, the scouting remains unnoticed.");
tz_def('MANUAL_UDESC_5', "The Equites Imperatoris are the standard cavalry of the roman army and are very well armed. They are not the fastest troops, but are a horror for unprepared enemies. You should, however, always keep in mind that catering for horse and rider isn't cheap.");
tz_def('MANUAL_UDESC_6', "The Equites Caesaris are the heavy cavalry of Rome. They are very well armoured and deal great amounts of damage, but all that armour and weaponry comes with a price. They are slow, carry less resources and feeding them is expensive.");
tz_def('MANUAL_UDESC_7', "The Battering Ram is a heavy support weapon for your infantry and cavalry. Its task is to destroy the enemy walls and therefore increase your troops’ chances of overcoming the enemy's fortifications.");
tz_def('MANUAL_UDESC_8', "The Catapult is an excellent long-distance weapon; it is used to destroy the fields and buildings of enemy villages. However, without escorting troops it is almost defenceless so don't forget to send some of your troops with it. <br /><br /> Having a high level rally point makes your catapults more accurate and gives you the option to target additional enemy buildings. With a level 10 rally point each building except for the cranny, stonemason's lodge and trapper can be targeted. <br /> HINT: Fire catapults CAN hit the cranny, trappers or stonemason's lodge when they target randomly.");
tz_def('MANUAL_UDESC_9', "The Senator is the tribe's chosen leader. He's a good speaker and knows how to convince others. He is able to persuade other villages to fight with the empire. <br /><br /> Every time the Senator speaks to the inhabitants of a village the enemy's loyalty value decreases until the village is yours.");
tz_def('MANUAL_UDESC_10', "Settlers are brave and daring citizens who move out of the village after a long training session to found a new village in your honour. <br /><br /> As the journey and the founding of the new village are very difficult, three settlers are bound to stick together. They need a basis of 750 units per resource.");
tz_def('MANUAL_UDESC_11', "Clubswingers are the cheapest unit in Travian. They are quickly trained and have medium attack capabilities but their armour isn’t the best. Clubswingers are almost defenceless against cavalry and will be ridden down with ease.");
tz_def('MANUAL_UDESC_12', "In the Teuton army the Spearman’s task is defence. He is especially good against cavalry thanks to his weapons length. <br /><br /> However, don't use him as an attacking unit because his offensive capabilities are very low.");
tz_def('MANUAL_UDESC_13', "This is the Teuton's strongest infantry unit. He is strong at both offence and defence but he is slower and more expensive than other units.");
tz_def('MANUAL_UDESC_14', "The Scout moves far ahead of the Teuton troops in order to get an impression of the enemy's strength and his villages. He moves on foot, which makes him slower than his Roman or Gaul counterparts. He scouts the enemy units, resources and fortifications. <br /><br /> If there are no enemy Scouts, Pathfinders or Equites Legati in the scouted village then the scouting remains unnoticed.");
tz_def('MANUAL_UDESC_15', "As they are equipped with heavy armour Paladins are a great defensive unit. Infantry will find it especially hard to get through his shield. <br /><br /> Unfortunately their attacking capabilities are rather low and their speed, compared to other cavalry units, is below the average. Their training takes very long and is rather expensive..");
tz_def('MANUAL_UDESC_16', "The Teutonic Knight is a formidable warrior and brings fear and despair over his foes. In defence he stands out against enemy cavalry. However, the cost of training and feeding him is extraordinary.");
tz_def('MANUAL_UDESC_17', "The Ram is a heavy support weapon for your infantry and cavalry. Its task is to destroy the enemy walls and therefore increase your troops’ chances of overcoming the enemy's fortifications.");
tz_def('MANUAL_UDESC_18', "The Catapult is an excellent long-distance weapon; it is used to destroy the fields and buildings of enemy villages. However, without escorting troops it is almost defenceless so don't forget to send some of your troops with it. <br /><br /> Having a high level rally point makes your catapults more accurate and gives you the option to target additional enemy buildings. With a level 10 rally point each building except for the cranny, stonemason's lodge and trapper can be targeted. <br /> HINT: Catapults CAN hit the cranny, trappers or stonemason's lodges when they target randomly.");
tz_def('MANUAL_UDESC_19', "Out of their midst the Teutons choose their Chief. To be chosen, bravery and strategy aren't enough; you also have to be a formidable speaker as it is the Chief's primary objective to convince the population of foreign villages to join the Chief's tribe. <br /><br /> The more often the Chief speaks to the population of a village the more the loyalty of the village sinks until it finally joins the chief's tribe.");
tz_def('MANUAL_UDESC_21', "As they are infantry, the Phalanx is cheap and fast to produce. <br /><br /> Though their attack power is low, in defence they are quite strong against both infantry and cavalry.");
tz_def('MANUAL_UDESC_22', "The Swordsmen are more expensive than the Phalanx, but they are an attacking unit. <br /><br /> Defensively they are quite weak, especially against cavalry.");
tz_def('MANUAL_UDESC_23', "The Pathfinder is the Gaul's reconnaissance unit. They are very fast and they can carefully advance on the enemy units, resources or buildings to spy on them. <br /><br /> If there aren't any Scouts, Equites Legati or Pathfinders in the scouted village, the scouting remains unnoticed.");
tz_def('MANUAL_UDESC_24', "Theutates Thunders are very fast and powerful cavalry units. They can carry a large amount of resources which makes them excellent raiders too. <br /><br /> In defence their abilities are average at best.");
tz_def('MANUAL_UDESC_25', "This medium cavalry unit is brilliant at defence. The main purpose of the Druidrider is to defend against enemy infantry. Its costs and supply are relatively expensive.");
tz_def('MANUAL_UDESC_26', "The Haeduans are the Gaul's ultimate weapon for attacking and defending against cavalry. Few can match them in these points. <br /><br /> However, their training and equipment is also very expensive. They eat 3 units of crop per hour so you should think very carefully if they will be worth it.");
tz_def('MANUAL_UDESC_28', "The Trebuchet is an excellent long-distance weapon; it is used to destroy the fields and buildings of enemy villages. However, without escorting troops it is almost defenceless so don't forget to send some of your troops with it. <br /><br /> Having a high level rally point makes your catapults more accurate and gives you the option to target additional enemy buildings. With a level 10 rally point each building except for the cranny, stonemason's lodges and trapper can be targeted. <br /> HINT: The Trebuchet CAN hit the cranny, trappers or stonemason's lodges when it targets randomly.");
tz_def('MANUAL_UDESC_29', "Each tribe has an ancient and experienced fighter whose presence and speeches are able to convince the population of enemy villages to join his tribe. <br /><br /> The more often the Chieftain speaks in front of the walls of an enemy village the more its loyalty sinks until it joins the Chieftain's tribe.");
tz_def('MANUAL_UDESC_31', "Rats are cheap and breed really fast but can't carry much.<br /><br />This is probably the cheapest of the nature units and the ugliest.");
tz_def('MANUAL_UDESC_44', "The Natars use flocks of birds to gather intelligence about their enemies. Thanks to the advantage of scouting from the air, it is almost impossible to stop the Natarian scouting squads; on the other hand, even a simple-minded villager can easily notice the screeching and feathered flocks.");
tz_def('MANUAL_UDESC_41', "Their long and pointed pikes are used as the main line of defence in any battle. The Natarian Pikemen are bold and daring warriors who use their dexterity to quickly down enemy horsemen and finish them off.");
tz_def('MANUAL_UDESC_42', "The thorn-like extensions on their helmets, bracers and shoulder-parts of their armour give the Thorned Warriors their name. The men who fight for the Natars as Thorned Warriors are persistent and well trained, offering a bloody battle to anyone who is foolish enough to attack them.");
tz_def('MANUAL_UDESC_43', "Adored by their people and feared by their enemies, a Guardsman fights without a mount but is nevertheless one of the most valuable soldiers in the Natarian army, thanks to his versatility. They are deemed as well trained fighters, leaving their enemies with almost no chances to win. Due to their heavy armour, they can be used as strong and reliable defence troops too.");
tz_def('MANUAL_UDESC_45', "It smells only of death and decay when the Axeriders saddle up and prepare to go to war. As skillfully as a farmer uses his scythe to reap, an Axerider swings his mighty blade. A single blow is normally sufficient to behead an opponent and make the bystanders cry out in anguish.");
tz_def('MANUAL_UDESC_46', "Only the most skilful and strongest warriors of the Natars survive the training to become a Natarian Knight. Seeing them fight fills one with awe and shows what true warfare is. They wield their blades as if they were one with their arms and hands and use their shields seemingly as a natural extension of their bodies. Even the horses they ride are specially bred and trained - no normal horse would be able to wear the armour the knights' horses wear, let alone the knight himself, and still be able to go to war. Whispers of their glory have even reached the most distant kingdoms, spreading fear and horror.");
tz_def('MANUAL_UDESC_47', "No other tribe but the Natars knows how to use these impressive creatures for their purposes. Neither a wall nor a palisade can withstand the War elephant’s attacks. A walking killing machine, trampling down anything that tries to oppose it or tries to come its way.");
tz_def('MANUAL_UDESC_48', "Even as engineers, the Natars were very successful. They created machinery of war long before anyone else and have since then perfected it in every way. The Ballista, a huge crossbow-like weapon, fires its projectiles with such a force that no wall or shield can deflect them. When the engineers dismantle it to move it to the next battlefield, here is usually nothing but ruins left where the projectiles hit.");
tz_def('MANUAL_UDESC_49', "A mixture of pure fear, admiration and awe moves the villagers when the Natarian Emperor speaks to them. This commanding and well outfitted figure is fully aware of his effect on others and knows how to subjugate an entire village with a single harangue.");
tz_def('MANUAL_UDESC_50', "Daring journeymen and master builders, driven by zest for action and knowing every little secret about cultivating land, building Palaces and fortifying villages, the Natarian Settlers go out in parties of three to claim land in the name of their Natarian lords.");
// ===== display-time localization of stored report topics =====
// Reports are generated server-side at battle resolution and stored in the DB
// (column `topic`) with English connectors. This rewrites them to the viewing
// player's language at display time (works for old AND new reports).
if (!function_exists('tz_loc_topic')) {
    function tz_loc_topic($s) {
        if (!is_string($s) || $s === '') return $s;
        // strtr does longest-match, single-pass (no double substitution).
        $map = array(
            'village of the elders reinforcement ' => TZ_RT_ELDERS_REINF.' ',
            'Reinforcement in '                    => TZ_RT_REINF_IN.' ',
            ' was attacked'                        => ' '.TZ_RT_WAS_ATTACKED,
            ' send resources to '                  => ' '.TZ_RT_SEND_RES_TO.' ',
            ' scouts '                             => ' '.TZ_RT_SCOUTS.' ',
            ' attacks '                            => ' '.TZ_RT_ATTACKS.' ',
            ' reinforcement '                      => ' '.TZ_RT_REINFORCEMENT.' ',
            'Unoccupied Oasis'                     => TZ_RT_UNOCC_OASIS,
            'New village founded'                  => TZ_RT_NEW_VILLAGE,
            'Settlers returned - valley occupied'  => TZ_RT_VALLEY_OCCUPIED,
        );
        return strtr($s, $map);
    }
}
