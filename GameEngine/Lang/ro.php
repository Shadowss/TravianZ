<?php

// tz_def(): define cu gard - nu redefineste o constanta deja setata, deci nu mai
// arunca "Constant X already defined" (warning pe fiecare request, fatal pe PHP 9).
// Gardul function_exists face fisierul auto-suficient indiferent de ordinea de
// incarcare a limbilor (LANG apoi en.php ca fallback in Session.php).
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
									//        ROMANIAN         //
									//      Author: Dzoki      //
									//     Adding: Armando     //
									//     Translate: Shadow   //
									/////////////////////////////

//MAIN MENU
tz_def('TRIBE1', 'Romani');
tz_def('TRIBE2', 'Barbari');
tz_def('TRIBE3', 'Daci');
tz_def('TRIBE4', 'Natura');
tz_def('TRIBE5', 'Natari');

tz_def('HOME', 'Pagina principală');
tz_def('INSTRUCT', 'Instrucțiuni');
tz_def('ADMIN_PANEL', 'Panou Admin');
tz_def('MH_PANEL', 'Panou Multihunter');
tz_def('MASS_MESSAGE', 'Mesaj în masă');
tz_def('LOGOUT', 'Deconectare');
tz_def('PROFILE', 'Profil');
tz_def('SUPPORT', 'Asistență');
tz_def('UPDATE_T_10', 'Actualizează Top 10');
tz_def('SYSTEM_MESSAGE', 'Mesaj de sistem');
tz_def('TRAVIAN_PLUS', 'Travian <b><span class="plus_g">P</span><span class="plus_o">l</span><span class="plus_g">u</span><span class="plus_o">s</span></span></span></b>');
tz_def('CONTACT', 'Contactează-ne!');
tz_def('GAME_RULES', 'Regulile jocului');

//MENU
tz_def('REG', 'Înregistrare');
tz_def('FORUM', 'Forum');
tz_def('CHAT', 'Chat');
tz_def('IMPRINT', 'Mențiuni legale');
tz_def('MORE_LINKS', 'Linkuri utile');
tz_def('TOUR', 'Turul jocului');


//ERRORS
tz_def('USRNM_EMPTY', '(Nume utilizator gol)');
tz_def('USRNM_TAKEN', '(Numele este deja folosit.)');
tz_def('USRNM_SHORT', '(min. '.USRNM_MIN_LENGTH.' caractere)');
tz_def('USRNM_CHAR', '(Caractere nepermise)');
tz_def('PW_EMPTY', '(Parolă goală)');
tz_def('PW_SHORT', '(min. '.PW_MIN_LENGTH.' caractere)');
tz_def('PW_INSECURE', '(Parolă nesigură. Alege una mai puternică.)');
tz_def('EMAIL_EMPTY', '(Email gol)');
tz_def('EMAIL_INVALID', '(Adresă de email invalidă)');
tz_def('EMAIL_TAKEN', '(Email deja folosit)');
tz_def('WINNER_ERROR', '<li>Serverul s-a încheiat! Nu se mai pot face înregistrări.</li>');
tz_def('TRIBE_EMPTY', '<li>Te rugăm să alegi un trib.</li>');
tz_def('AGREE_ERROR', '<li>Trebuie să accepți regulamentul jocului și termenii și condițiile generale pentru a te înregistra.</li>');
tz_def('LOGIN_USR_EMPTY', 'Introdu numele.');
tz_def('LOGIN_PASS_EMPTY', 'Introdu parola.');
tz_def('LOGIN_VACATION', 'Modul vacanță este încă activ.');
tz_def('EMAIL_ERROR', 'Emailul nu corespunde cu cel existent');
tz_def('PASS_MISMATCH', 'Parolele nu coincid');
tz_def('ALLI_OWNER', 'Te rugăm să numești un nou lider înainte de a șterge alianța');
tz_def('SIT_ERROR', 'Sitter deja setat sau jucătorul nu a fost găsit');
tz_def('USR_NT_FOUND', 'Numele nu există.');
tz_def('LOGIN_PW_ERROR', 'Parola este greșită.');
tz_def('WEL_TOPIC', 'Sfaturi utile & informații ');
tz_def('ATAG_EMPTY', 'Tag gol');
tz_def('ANAME_EMPTY', 'Nume gol');
tz_def('ATAG_EXIST', 'Tag deja folosit');
tz_def('ANAME_EXIST', 'Nume deja folosit');
tz_def('ALREADY_ALLY_MEMBER', 'Ești deja într-o alianță');
tz_def('ALLY_TOO_LOW', 'Trebuie să ai ambasada la nivelul 3 sau mai mare');
tz_def('USER_NOT_IN_YOUR_ALLY', 'Acest jucător nu este în alianța ta!');
tz_def('CANT_EDIT_YOUR_PERMISSIONS', 'Nu îți poți edita propriile permisiuni!');
tz_def('CANT_EDIT_LEADER_PERMISSIONS', 'Permisiunile liderului nu pot fi modificate!');
tz_def('CANT_REMOVE_LEADER', 'Nu poți exclude fondatorul alianței!');
tz_def('FOUNDER_LEAVE_NEW', 'Nu a fost selectat un fondator!');
tz_def('FOUNDER_LEAVE_INVALID', 'Fondator invalid!');
tz_def('NO_PERMISSION', 'Nu ai suficiente drepturi!');
tz_def('NAME_OR_DIPL_EMPTY', 'Nume sau diplomație goală');
tz_def('ALLY_DOESNT_EXISTS', 'Alianța nu există');
tz_def('CANNOT_INVITE_SAME_ALLY', 'Nu poți invita propria alianță');
tz_def('WRONG_DIPLOMACY', 'Alegere greșită');
tz_def('INVITE_ALREADY_SENT', 'Ai trimis deja un pact acestei alianțe, ei ți-au trimis unul sau aveți deja un pact');
tz_def('INVITE_SENT', 'Invitație trimisă');
tz_def('DECLARED_WAR_ON', 'a declarat război către');
tz_def('OFFERED_NON_AGGRESION_PACT_TO', 'a oferit pact de neagresiune către');
tz_def('OFFERED_CONFED_TO', 'a oferit confederație către');
tz_def('ALLY_TOO_MUCH_PACTS', 'Nu mai poți oferi pacte de acest tip sau această alianță a atins limita pentru acest tip de pacte');
tz_def('ALLY_PERMISSIONS_UPDATED', 'Permisiuni actualizate');
tz_def('ALLY_FORUM_LINK_UPDATED', 'Link forum actualizat');
tz_def('NO_FORUMS_YET', 'Nu există forumuri încă.');
tz_def('ALLY_USER_KICKED', ' a fost exclus din alianță');
tz_def('NOT_OPENED_YET', 'Serverul nu a pornit încă.');
tz_def('REGISTER_CLOSED', 'Înregistrările sunt închise. Nu te poți înregistra pe acest server.');
tz_def('NAME_EMPTY', 'Te rugăm să introduci numele');
tz_def('NAME_NO_EXIST', 'Nu există niciun jucător cu numele ');
tz_def('ID_NO_EXIST', 'Nu există niciun jucător cu ID-ul ');
tz_def('SAME_NAME', 'Nu te poți invita pe tine însuți');
tz_def('ALREADY_INVITED', ' deja invitat');
tz_def('ALREADY_IN_ALLY', ' este deja în această alianță');
tz_def('ALREADY_IN_AN_ALLY', ' este deja într-o alianță');
tz_def('NAME_OR_TAG_CHANGED', 'Nume sau Tag schimbat');
tz_def('VAC_MODE_WRONG_DAYS', 'Ai introdus un număr greșit de zile');

//COPYRIGHT
tz_def('TRAVIAN_COPYRIGHT', 'TravianZ 100% Clonă Travian Open Source.');

//BUILD.TPL
tz_def('CUR_PROD', 'Producție actuală');
tz_def('NEXT_PROD', 'Producție la nivelul ');
tz_def('CONSTRUCT_BUILD', 'Construiește clădirea');

//DORF1
tz_def('LUMBER', 'Lemn');
tz_def('CLAY', 'Argilă');
tz_def('IRON', 'Fier');
tz_def('CROP', 'Grâu');
tz_def('LEVEL', 'Nivel');
tz_def('CROP_COM', 'Consum de '.CROP);
tz_def('PER_HR', 'pe oră');
tz_def('PRODUCTION', 'Producție');
tz_def('CAPITAL1', 'Capitală');
tz_def('VILLAGES', 'Sate');
tz_def('ANNOUNCEMENT', 'Anunț');
tz_def('GO2MY_VILLAGE', 'Mergi la satul meu');
tz_def('VILLAGE_CENTER', 'Centru sat');
tz_def('FINISH_GOLD', 'Finalizezi instant toate construcțiile și cercetările din acest sat pentru 2 Aur?');
tz_def('WAITING_LOOP', '(în așteptare)');
tz_def('CROP_NEGATIVE', 'Producția ta de grâu este negativă, nu vei atinge niciodată cantitatea de resurse necesară.');
tz_def('HR', 'h');
tz_def('HRS', '(ore)');
tz_def('DONE_AT', 'finalizat la');
tz_def('CANCEL', 'anulează');
tz_def('LOYALTY', 'Loialitate');
tz_def('CALCULATED_IN', 'Calculat în');
tz_def('HI', 'Salut');
tz_def('P_IN', 'în');
tz_def('MS', 'ms');
tz_def('SERVER_TIME', 'Ora serverului:');
tz_def('LOCAL_TIME', 'Ora locală:');
tz_def('REMAINING_GOLD', 'Aur rămas');

// HEADER && MENU && Messages && Reports
tz_def('REPORTS', 'Rapoarte');
tz_def('MESSAGES', 'Mesaje');
tz_def('PLUS_MENU', 'Meniu Plus');
tz_def('LINKS', 'Linkuri');
tz_def('CANCEL_PROCESS', 'Anulează procesul');
tz_def('ACCOUNT_DELETING', 'Contul va fi șters în');
tz_def('INBOX', 'Primite');
tz_def('WRITE', 'Scrie');
tz_def('SENT', 'Trimise');
tz_def('SEND', 'Trimite');
tz_def('ARCHIVE', 'Arhivă');
tz_def('NOTES', 'Notițe');
tz_def('SUBJECT', 'Subiect');
tz_def('SENDER', 'Expeditor');
tz_def('RECIPIENT', 'Destinatar');
tz_def('BACK', 'Înapoi');
tz_def('NEW', 'nou');
tz_def('UNREAD', 'necitit');
tz_def('NO_MESS', 'Nu există mesaje disponibile');
tz_def('NO_MESS_IN_ARCHIVE', NO_MESS.' în arhivă');
tz_def('NO_MESS_SENT', 'Nu există mesaje trimise');
tz_def('MESS_FOR_SUP', 'Mesaj pentru Suport');
tz_def('MESS_FOR_MH', 'Mesaj pentru Multihunter');
tz_def('SEND_AS_SUP', 'Trimite ca Suport');
tz_def('SEND_AS_MH', 'Trimite ca Multihunter');
tz_def('SAVE', 'Salvează');
tz_def('ANSWER', 'Răspunde');
tz_def('REPLY', 'Răspuns');
tz_def('ADDRESSBOOK', 'Agendă');
tz_def('CLOSE_ADDRESSBOOK', 'Închide agenda');
tz_def('ONLINE_S1', 'Online acum');
tz_def('ONLINE_S2', 'Offline');
tz_def('ONLINE_S3', 'Ultimele 3 zile');
tz_def('ONLINE_S4', 'Ultimele 7 zile');
tz_def('ONLINE_S5', 'Inactiv');
tz_def('WAIT_FOR_CONFIRM', 'Așteaptă confirmarea');
tz_def('CONFIRM', 'Confirmă');
tz_def('WRITE_MESS_WARN', '<b>Atenție:</b> nu poți folosi <b>[message]</b> sau <b>[/message]</b> în mesaj deoarece pot cauza probleme cu sistemul BBCode');
tz_def('NO_REPORTS', 'Nu există rapoarte disponibile');
tz_def('READ_ALL_REPORTS', 'Marchează toate ca citite');
tz_def('ATTACKER', 'Atacator');
tz_def('NATAR_COUNTERFORCE', 'Contraatac Natari');
tz_def('FROM_THE_VILL', 'din satul');
tz_def('CASUALTIES', 'Pierderi');
tz_def('INFORMATION', 'Informații');
// === Battle report strings (issue: i18n of combat reports) ===
tz_def('RC_HERO', 'Erou');
tz_def('RC_CATAPULT', 'Catapultă');
tz_def('RC_TRAP', 'Capcană');
tz_def('RC_WALL', 'Zid');
tz_def('TZ_AT', 'la');
// Catapults
tz_def('RC_DESTROYED', 'distrus');
tz_def('RC_NOT_DAMAGED', 'nu a fost avariat.');
tz_def('RC_DAMAGED_FROM_TO', 'avariat de la nivelul <b>%s</b> la nivelul <b>%s</b>.');
tz_def('RC_NO_BUILDINGS', 'Nu mai sunt clădiri de distrus');
tz_def('RC_VILLAGE_ALREADY_DESTROYED', 'Sat deja distrus.');
tz_def('RC_VILLAGE_CANT_DESTROY', 'Satul nu poate fi distrus.');
tz_def('RC_VILLAGE_CANT_BE', 'Satul nu poate fi');
tz_def('RC_VILLAGE_DESTROYED', 'Satul a fost distrus.');
// Rams
tz_def('RC_NO_WALL', 'Nu există zid de distrus.');
tz_def('RC_WALL_DESTROYED', 'Zid <b>distrus</b>.');
tz_def('RC_WALL_NOT_DAMAGED', 'Zidul nu a fost avariat.');
tz_def('RC_WALL_DAMAGED_FROM_TO', 'Zid avariat de la nivelul <b>%s</b> la nivelul <b>%s</b>.');
// Conquest / chief
tz_def('RC_NO_REDUCE_CP_RAID', 'Nu s-au putut reduce punctele de cultură în timpul unui raid');
tz_def('RC_NOT_ENOUGH_CP', 'Puncte de cultură insuficiente.');
tz_def('RC_CANT_TAKEOVER', 'Nu poți cuceri acest sat.');
tz_def('RC_RESIDENCE_NOT_DESTROYED', 'Palatul/Reședința nu este distrus(ă)!');
tz_def('RC_LOYALTY_LOWERED', 'Loialitatea a fost redusă de la <b>%s</b> la <b>%s</b>.');
tz_def('RC_INHABITANTS_JOIN', 'Locuitorii satului %s au decis să se alăture imperiului tău.');
// Hero
tz_def('RC_HERO_NO_KILL', 'Eroul tău nu a avut pe cine ucide, deci nu câștigă niciun XP.');
tz_def('RC_HERO_GAINED_XP', 'Eroul tău a câștigat <b>%s</b> XP.');
tz_def('RC_HERO_CONQUERED_OASIS', 'Eroul tău a cucerit această oază');
tz_def('RC_HERO_REDUCED_OASIS_LOYALTY', 'Eroul tău a redus loialitatea oazei la %s de la %s');
tz_def('RC_NO_REDUCE_LOYALTY_RAID', 'Nu s-a putut reduce loialitatea în timpul unui raid');
tz_def('RC_HERO_CARRYING_ARTIFACT', 'Eroul tău aduce acasă artefactul <b>%s</b> și');
tz_def('RC_HERO_NO_ARTIFACT_RAID', 'Eroul tău nu a putut revendica un artefact în timpul unui raid');
tz_def('RC_HERO_AND_GAINED_XP_BATTLE', 'și a câștigat <b>%s</b> XP din luptă.');
tz_def('RC_HERO_NO_XP_BATTLE', 'niciun XP din luptă.');
tz_def('RC_HERO_GAINED_XP_BATTLE', 'a câștigat <b>%s</b> XP din luptă.');
tz_def('RC_HERO_BUT_GAINED_XP_BATTLE', 'dar a câștigat <b>%s</b> XP din luptă.');
tz_def('RC_HERO_TRAPPED', 'Eroul tău a fost capturat');
tz_def('RC_HERO_DIED', 'Eroul tău a murit');
// Scout report
tz_def('RC_TOTAL_RESOURCES', 'Resurse totale:');
tz_def('RC_RESIDENCE_LEVEL', 'Nivel Reședință:');
tz_def('RC_PALACE_LEVEL', 'Nivel Palat:');
tz_def('RC_WALL_LEVEL', 'Nivel zid:');
tz_def('RC_CRANNY_CAPACITY', 'Capacitate totală ascunzători:');
tz_def('RC_NO_INFO', 'Nu există informații de afișat');
// Prisoners / traps
tz_def('RC_OF_WHICH_SAVED', 'dintre care <b>%s</b> au fost salvați');
tz_def('RC_FREED_FROM_HIS_TROOPS', 'a eliberat <b>%s</b> din trupele sale');
tz_def('RC_FREED_FRIENDLY_TROOPS', 'a eliberat <b>%s</b> trupe aliate');
tz_def('RC_AND_FRIENDLY_TROOPS', 'și <b>%s</b> trupe aliate');
// Troop return
tz_def('RC_NONE_RETURNED', 'Niciunul dintre soldații tăi nu s-a întors.');
// === End battle report strings ===
// === System / alliance in-game messages (sendMessage), rendered per reader ===
tz_def('MSG_INVITE_ALLIANCE', 'Invitație în alianță');
tz_def('MSG_FORUM_NEW_TITLE', 'Mesaj nou pe forum');
tz_def('MSG_FORUM_NEW_BODY', "Salut!\n\n<a href=\"%s\">%s</a> a publicat un mesaj nou în subiectul vostru comun. Iată un link care te va duce acolo: <a href=\"%s\">link forum</a>\n\nCu stimă,\n<i>Robotul serverului :)</i>");
tz_def('MSG_LEFT_ALLIANCE_TITLE', 'Ai părăsit alianța');
tz_def('MSG_FORCED_LEAVE_TITLE', 'Un atac te-a forțat să părăsești alianța');
tz_def('MSG_LEFT_DEMOLITION_BODY', "Salut, %s!\n\nTe informăm că, în urma demolării finalizate a ultimei tale Ambasade, ai părăsit acum cu succes alianța.\n\nCu stimă,\n<i>Robotul serverului :)</i>");
tz_def('MSG_LEFT_ATTACK_BODY', "Salut, %s!\n\nTe informăm că, în urma unui atac reușit și a distrugerii ultimei tale Ambasade, ai fost forțat să părăsești alianța.\n\nPentru a-ți restabili poziția în această alianță, va trebui să construiești o nouă Ambasadă și să-i ceri liderului să-ți trimită din nou o invitație.\n\nCu stimă,\n<i>Robotul serverului :)</i>");
tz_def('MSG_DISBAND_TITLE', 'Alianța ta a fost desființată');
tz_def('MSG_DISBAND_OWNER_BODY', "Salut, %s!\n\nTe informăm că, în urma demolării finalizate a ultimei tale Ambasade de nivel 3 și a faptului că erai liderul alianței, această alianță a fost desființată.\n\nPentru a fonda o nouă alianță, te rugăm să construiești din nou o Ambasadă de nivel 3 într-unul dintre satele tale.\n\nCu stimă,\n<i>Robotul serverului :)</i>");
tz_def('MSG_DISBAND_MEMBER_BODY', "Salut, %s!\n\nTe informăm că, în urma demolării ultimei Ambasade a fondatorului alianței tale sub nivelul 3, această alianță a fost desființată.\n\nAcum poți accepta invitații de la alte alianțe sau poți fonda tu însuți o nouă alianță.\n\nCu stimă,\n<i>Robotul serverului :)</i>");
tz_def('MSG_NOW_ALLIANCE_LEADER_TITLE', 'Acum ești liderul alianței');
tz_def('MSG_NOW_LEADER_TITLE', 'Acum ești liderul alianței tale');
tz_def('MSG_PROMOTE_BODY', "Salut, %s!\n\nTe informăm că a avut loc un atac reușit asupra jucătorului <a href=\"spieler.php?uid=%s\">%s</a>, care i-a avariat Ambasada suficient de mult încât nu mai poate susține conducerea alianței tale.\n\nDeoarece nivelul Ambasadei tale este suficient, ai fost ales automat în poziția de nou lider al alianței, cu toate îndatoririle și responsabilitățile aferente.\n\nCu stimă,\n<i>Robotul serverului :)</i>");
tz_def('MSG_DISPERSE_TITLE', 'Alianța ta a fost dispersată');
tz_def('MSG_DISPERSE_OWNER_BODY_MANY', "Salut, %s!\n\nTe informăm că, în urma unui atac reușit care ți-a degradat ultima Ambasadă la un nivel care nu poate susține toți cei %s membri ai alianței și deoarece niciun alt membru nu avea o Ambasadă de nivel suficient de înalt pentru a prelua conducerea, alianța ta a fost dispersată.\n\nCu stimă,\n<i>Robotul serverului :)</i>");
tz_def('MSG_DISPERSE_OWNER_BODY_FEW', "Salut, %s!\n\nTe informăm că, în urma unui atac reușit care ți-a degradat ultima Ambasadă la un nivel sub 3 - necesar pentru a fonda și menține propria alianță - alianța ta a fost dispersată.\n\nCu stimă,\n<i>Robotul serverului :)</i>");
tz_def('MSG_DISPERSE_MEMBER_BODY', "Salut, %s!\n\nTe informăm că, în urma unui atac reușit al altui jucător asupra Ambasadei liderului alianței tale, care a degradat-o sub pragul necesar pentru a susține toți cei %s membri, și deoarece niciun alt membru nu avea o Ambasadă de nivel suficient de înalt pentru a prelua conducerea, alianța ta a fost dispersată.\n\nCu stimă,\n<i>Robotul serverului :)</i>");
tz_def('MSG_NEW_LEADER_TITLE', 'Alianța ta are un nou lider');
tz_def('MSG_NEWLEADER_OWNER_BODY', "Salut, %s!\n\nTe informăm că, în urma unui atac reușit care ți-a degradat ultima Ambasadă la un nivel ce nu poate susține toți cei %s membri ai alianței, un alt membru care îndeplinește aceste criterii a fost ales automat ca nou lider al alianței.\n\nÎn plus - din cauza distrugerii Ambasadei - ai fost expulzat din alianța ta.\n\nTe rugăm să restabilești legătura cu alianța ta construind o nouă Ambasadă și contactând <a href=\"spieler.php?uid=%s\">noul lider</a> pentru o invitație.\n\nCu stimă,\n<i>Robotul serverului :)</i>");
tz_def('MSG_NEWLEADER_MEMBER_BODY', "Salut, %s!\n\nTe informăm că, în urma unui atac reușit al altui jucător asupra Ambasadei liderului alianței tale, <a href=\"spieler.php?uid=%s\">un alt membru al alianței</a> cu o capacitate de Ambasadă suficientă a fost ales automat ca nou lider al alianței.\n\nCu stimă,\n<i>Robotul serverului :)</i>");
tz_def('MSG_FORCED_LEAVE_BODY', "Salut, %s!\n\nTe informăm că, în urma unui atac reușit și a distrugerii ultimei tale Ambasade, ai fost forțat să părăsești alianța.\n\nPentru a-ți restabili poziția în această alianță, va trebui să construiești o nouă Ambasadă și să-i ceri <a href=\"spieler.php?uid=%s\">noului lider ales</a> să-ți trimită din nou o invitație.\n\nCu stimă,\n<i>Robotul serverului :)</i>");
tz_def('MSG_INVITE_BODY', "Salut, %s!\n\nTe informăm că ai fost invitat să te alături unei alianțe. Pentru a accepta această invitație, te rugăm să vizitezi Ambasada ta.\n\nCu stimă,\n<i>Robotul serverului :)</i>");
tz_def('MSG_QUIT_REPLACEMENT_BODY', "Salut!\n\nTe informăm că fostul lider al alianței tale - %s - a decis să plece și te-a ales ca înlocuitor. Acum primești acces complet, administrare și responsabilități asupra alianței tale.\n\nMult succes!\n\nCu stimă,\n<i>Robotul serverului :)</i>");
// Embassy-destruction status lines, appended to the catapult battle report.
tz_def('MSG_ALLIANCE_DISPERSED_STATUS', 'Alianța acestui jucător a fost dispersată.');
tz_def('MSG_FORCED_LEAVE_STATUS', 'Jucătorul a fost forțat să-și părăsească alianța.');
// Alliance news-feed notices (rendered in Templates/Alliance/news.tpl)
tz_def('MSG_INVITE_NOTICE', '%s l-a invitat pe %s în alianță.');
tz_def('MSG_ALLIANCE_FOUNDED', 'Alianța a fost fondată de %s.');
tz_def('MSG_NEWS_REJECTED', '%s a refuzat invitația.');
tz_def('MSG_NEWS_DELETED_INVITE', '%s a șters invitația pentru %s.');
tz_def('MSG_NEWS_JOINED', '%s s-a alăturat alianței.');
tz_def('MSG_NEWS_NAME_CHANGED', '%s a schimbat numele alianței.');
tz_def('MSG_NEWS_DESC_CHANGED', '%s a schimbat descrierea alianței.');
tz_def('MSG_NEWS_PERMS_CHANGED', '%s a modificat permisiunile lui %s.');
tz_def('MSG_NEWS_EXPELLED', '%s a fost exclus din alianță de către %s.');
tz_def('MSG_NEWS_QUIT', '%s a părăsit alianța.');
tz_def('MSG_NEWS_DIPLO_CONFED', '%s a oferit o confederație către %s.');
tz_def('MSG_NEWS_DIPLO_NAP', '%s a oferit un pact de neagresiune către %s.');
tz_def('MSG_NEWS_DIPLO_WAR', '%s a declarat război către %s.');
tz_def('CARRY', 'transportă');
tz_def('DEFENDER', 'Apărător');
tz_def('VISITED', 'vizitat');
tz_def('HIS_TROOPS', '`s trupe');
tz_def('WISHES_YOU', 'îți urează');
tz_def('X_MAS', 'Crăciun Fericit');
tz_def('NEW_YEAR', 'An Nou Fericit');
tz_def('EASTER', 'Paște Fericit');
if(!defined('PEACE')) define('PEACE', 'Pace');

tz_def('GOLD', 'Aur');
tz_def('GOLD_IMG', '<img src="/img/x.gif" class="gold" alt="'.GOLD.'" title="'.GOLD.'">');

//QUEST
tz_def('Q_CONTINUE', 'Continuă cu următoarea sarcină.');
tz_def('Q_REWARD', 'Recompensa ta:');
tz_def('Q_BUTN', 'finalizează sarcina');
tz_def('Q0', 'Bine ai venit în ');
tz_def('Q0_DESC', 'Văd că ai fost numit conducător al acestui mic sat. Eu voi fi sfătuitorul tău în primele zile și nu mă voi depărta de partea ta dreaptă.');
tz_def('Q0_OPT1', 'Către prima sarcină.');
tz_def('Q0_OPT2', 'Privește în jur pe cont propriu.');
tz_def('Q0_OPT3', 'Joacă fără sarcini.');

tz_def('Q1', 'Sarcina 1: Tăietor de lemne');
tz_def('Q1_DESC', 'În jurul satului tău sunt patru păduri verzi. Construiește un tăietor de lemne pe una dintre ele. Lemnul este o resursă importantă pentru noua noastră așezare.');
tz_def('Q1_ORDER', 'Ordin:</p>Construiește un tăietor de lemne.');
tz_def('Q1_RESP', 'Da, astfel obții mai mult lemn. Te-am ajutat puțin și am finalizat ordinul instant.');
tz_def('Q1_REWARD', 'Tăietor de lemne finalizat instant.');

tz_def('Q2', 'Sarcina 2: Grâu');
tz_def('Q2_DESC', 'Acum supușii tăi sunt flămânzi după o zi de muncă. Extinde un lan de grâu pentru a îmbunătăți aprovizionarea. Revino aici după ce clădirea este gata.');
tz_def('Q2_ORDER', 'Ordin:</p>Extinde un lan de grâu.');
tz_def('Q2_RESP', 'Foarte bine. Acum supușii tăi au din nou suficient de mâncare...');
tz_def('Q2_REWARD', 'Recompensa ta:</p>1 zi Travian Plus');

tz_def('Q3', 'Sarcina 3: Numele satului tău');
tz_def('Q3_DESC', 'Creativ cum ești, poți oferi satului tău un nume deosebit.<br><br>Apasă pe `profil` în meniul din stânga și apoi selectează `schimbă profilul`...');
tz_def('Q3_ORDER', 'Ordin:</p>Schimbă numele satului tău cu ceva frumos.');
tz_def('Q3_RESP', 'Wow, ce nume grozav pentru satul tău. Ar fi putut fi numele satului meu!...');

tz_def('Q4', 'Sarcina 4: Alți jucători');
tz_def('Q4_DESC', 'În '.SERVER_NAME.' joci alături de mii de alți jucători. Apasă pe `statistici` în meniul de sus pentru a-ți vedea rangul și introdu-l aici.');
tz_def('Q4_ORDER', 'Ordin:</p>Caută-ți rangul în statistici și introdu-l aici.');
tz_def('Q4_BUTN', 'finalizează sarcina');
tz_def('Q4_RESP', 'Exact! Acesta este rangul tău.');

tz_def('Q5', 'Sarcina 5: Două ordine de construcție');
tz_def('Q5_DESC', 'Construiește o mină de fier și o carieră de argilă. De fier și argilă nu ai niciodată destul.');
tz_def('Q5_ORDER', 'Ordin:</p><ul><li>Extinde o mină de fier.</li><li>Extinde o carieră de argilă.</li></ul>');
tz_def('Q5_RESP', 'După cum ai observat, construcțiile durează destul de mult. Lumea din '.SERVER_NAME.' continuă să existe chiar și când ești offline. Chiar și peste câteva luni vei avea multe lucruri noi de descoperit.<br><br>Cel mai bine este să-ți verifici satul din când în când și să le dai supușilor noi sarcini.');

tz_def('Q6', 'Sarcina 6: Mesaje');
tz_def('Q6_DESC', 'Poți vorbi cu alți jucători folosind sistemul de mesagerie. Ți-am trimis un mesaj. Citește-l și revino aici.<br><br>P.S. Nu uita: în stânga sunt rapoartele, în dreapta mesajele.');
tz_def('Q6_ORDER', 'Ordin:</p>Citește noul tău mesaj.');
tz_def('Q6_RESP', 'L-ai primit? Foarte bine.<br><br>Primești puțin Aur. Cu Aur poți face mai multe lucruri, de ex. să-ți extinzi Plus-ul');
tz_def('Q6_RESP1', '-contul sau să-ți crești producția de resurse. Pentru asta apasă pe ');
tz_def('Q6_RESP2', 'în meniul din stânga.');
tz_def('Q6_SUBJECT', 'Mesaj de la Maestrul de sarcini');
tz_def('Q6_MESSAGE', 'Ești informat că o recompensă frumoasă te așteaptă la maestrul de sarcini.<br><br>Notă: Mesajul a fost generat automat. Nu este necesar un răspuns.');

tz_def('Q7', 'Sarcina 7: Câte unul!');
tz_def('Q7_DESC', 'Acum ar trebui să creștem puțin producția de resurse. Construiește încă un tăietor de lemne, o carieră de argilă, o mină de fier și un lan de grâu la nivelul 1.');
tz_def('Q7_ORDER', 'Ordin:</p>Extinde încă o dată fiecare tip de resursă la nivelul 1.');
tz_def('Q7_RESP', 'Foarte bine, producția de resurse se dezvoltă excelent.');

tz_def('Q8', 'Sarcina 8: Armată uriașă!');
tz_def('Q8_DESC', 'Acum am o misiune foarte specială pentru tine. Mi-e foame. Dă-mi 200 grâu!<br><br>În schimb voi încerca să organizez o armată uriașă să-ți protejeze satul.');
tz_def('Q8_ORDER', 'Ordin:</p>Trimite 200 grâu maestrului de sarcini.');
tz_def('Q8_BUTN', 'Trimite grâu');
tz_def('Q8_NOCROP', 'Nu ai suficient grâu!');

tz_def('Q9', 'Sarcina 9: Totul la 1.');
tz_def('Q9_DESC', 'În Travian este mereu ceva de făcut! În timp ce aștepți sosirea armatei uriașe, ar trebui să creștem puțin producția. Extinde toate câmpurile de resurse la nivelul 1.');
tz_def('Q9_ORDER', 'Ordin:</p>Extinde toate câmpurile de resurse la nivelul 1.');
tz_def('Q9_RESP', 'Foarte bine, producția ta de resurse prosperă.<br><br>În curând putem începe construcția clădirilor în sat.');

tz_def('Q10', 'Sarcina 10: Porumbelul păcii');
tz_def('Q10_DESC', 'În primele zile după înregistrare ești protejat împotriva atacurilor altor jucători. Poți vedea cât durează protecția adăugând codul <b>[#0]</b> în profilul tău.');
tz_def('Q10_ORDER', 'Ordin:</p>Scrie codul <b>[#0]</b> în profilul tău, adăugându-l într-unul din cele două câmpuri de descriere.');
tz_def('Q10_RESP', 'Bravo! Acum toată lumea poate vedea ce mare războinic se apropie.');
tz_def('Q10_REWARD', 'Recompensa ta:</p>2 zile Travian Plus');

tz_def('Q11', 'Sarcina 11: Vecini!');
tz_def('Q11_DESC', 'În jurul tău sunt multe sate diferite. Unul dintre ele se numește ');
tz_def('Q11_DESC1', ' Apasă pe `hartă` în meniul de sus și caută acel sat. Numele satelor vecinilor îl vezi când treci cu mouse-ul peste ele.');
tz_def('Q11_ORDER', 'Ordin:</p>Caută coordonatele pentru ');
tz_def('Q11_ORDER1', 'și introdu-le aici.');
tz_def('Q11_RESP', 'Exact, acolo este ');
tz_def('Q11_RESP1', ' satul! Aproape la fel de multe resurse vei avea când vei ajunge acolo. Ei bine, aproape...');
tz_def('Q11_BUTN', 'finalizează sarcina');

tz_def('Q12', 'Sarcina 12: Ascunzătoare');
tz_def('Q12_DESC', 'Este timpul să construiești o ascunzătoare. Lumea din '.SERVER_NAME.' este periculoasă.<br><br>Mulți jucători trăiesc furând resursele altora. Construiește o ascunzătoare pentru a-ți proteja o parte din resurse de inamici.');
tz_def('Q12_ORDER', 'Ordin:</p>Construiește o ascunzătoare.');
tz_def('Q12_RESP', 'Bravo, acum le va fi mult mai greu jucătorilor răutăcioși să-ți jefuiască satul.<br><br>În caz de atac, sătenii tăi vor ascunde singuri resursele în ascunzătoare.');

tz_def('Q13', 'Sarcina 13: La nivelul 2.');
tz_def('Q13_DESC', 'În '.SERVER_NAME.' este mereu ceva de făcut! Extinde un tăietor de lemne, o carieră de argilă, o mină de fier și un lan de grâu fiecare la nivelul 2.');
tz_def('Q13_ORDER', 'Ordin:</p>Extinde câte unul din fiecare câmp de resursă la nivelul 2.');
tz_def('Q13_RESP', 'Foarte bine, satul tău crește și prosperă!');

tz_def('Q14', 'Sarcina 14: Instrucțiuni');
tz_def('Q14_DESC', 'În instrucțiunile din joc găsești informații scurte despre clădiri și tipuri de trupe.<br><br>Apasă pe `instrucțiuni` în stânga pentru a afla cât lemn necesită cazarma.');
tz_def('Q14_ORDER', 'Ordin:</p>Introdu cât lemn costă cazarma');
tz_def('Q14_BUTN', 'finalizează sarcina');
tz_def('Q14_RESP', 'Exact! Cazarma costă 210 lemn.');

tz_def('Q15', 'Sarcina 15: Clădirea Principală');
tz_def('Q15_DESC', 'Meșterii tăi constructori au nevoie de clădirea principală la nivelul 3 pentru a ridica clădiri importante precum piața sau cazarma.');
tz_def('Q15_ORDER', 'Ordin:</p>Extinde clădirea principală la nivelul 3.');
tz_def('Q15_RESP', 'Bravo. Clădirea principală nivelul 3 a fost finalizată.<br><br>Cu acest upgrade meșterii tăi nu doar că pot construi mai multe tipuri de clădiri, dar o fac și mai rapid.');

tz_def('Q16', 'Sarcina 16: Avansat!');
tz_def('Q16_DESC', 'Verifică-ți din nou rangul în statisticile jucătorilor și bucură-te de progresul tău.');
tz_def('Q16_ORDER', 'Ordin:</p>Caută-ți rangul în statistici și introdu-l aici.');
tz_def('Q16_RESP', 'Bravo! Acesta este rangul tău actual.');

tz_def('Q17', 'Sarcina 17: Arme sau Bani');
tz_def('Q17_DESC', 'Acum trebuie să iei o decizie: fie faci comerț pașnic, fie devii un războinic de temut.<br><br>Pentru piață ai nevoie de un grânar, pentru cazarmă ai nevoie de un punct de adunare.');
tz_def('Q17_BUTN', 'Economie');
tz_def('Q17_BUTN1', 'Militar');

tz_def('Q18', 'Sarcina 18: Militar');
tz_def('Q18_DESC', 'O decizie curajoasă. Pentru a putea trimite trupe ai nevoie de un punct de adunare.<br><br>Punctul de adunare trebuie construit pe un loc special. ');
tz_def('Q18_DESC1', 'locul de construcție');
tz_def('Q18_DESC2', ' se află în partea dreaptă a clădirii principale, puțin mai jos. Locul în sine este curbat.');
tz_def('Q18_ORDER', 'Ordin:</p>Construiește un punct de adunare.');
tz_def('Q18_RESP', 'Punctul tău de adunare a fost ridicat! Un pas bun spre dominația lumii!');

tz_def('Q19', 'Sarcina 19: Cazarma');
tz_def('Q19_DESC', 'Acum ai clădirea principală la nivelul 3 și un punct de adunare. Asta înseamnă că toate condițiile pentru construirea cazarmei sunt îndeplinite.<br><br>Poți folosi cazarma pentru a antrena trupe de luptă.');
tz_def('Q19_ORDER', 'Ordin:</p>Construiește cazarma.');
tz_def('Q19_RESP', 'Bravo... Cei mai buni instructori din toată țara s-au adunat pentru a antrena abilitățile de luptă ale oamenilor tăi la nivel maxim.');

tz_def('Q20', 'Sarcina 20: Antrenează.');
tz_def('Q20_DESC', 'Acum că ai cazarmă poți începe să antrenezi trupe. Antrenează două ');
tz_def('Q20_ORDER', 'Te rog antrenează 2 ');
tz_def('Q20_RESP', 'Bazele glorioasei tale armate au fost puse.<br><br>Înainte de a-ți trimite armata la jaf ar trebui să verifici cu');
tz_def('Q20_RESP1', 'Simulatorul de luptă');
tz_def('Q20_RESP2', 'pentru a vedea de câte trupe ai nevoie ca să învingi un șobolan fără pierderi.');

tz_def('Q21', 'Sarcina 18: Economie');
tz_def('Q21_DESC', 'Comerțul și economia au fost alegerea ta. Cu siguranță te așteaptă vremuri de aur!');
tz_def('Q21_ORDER', 'Ordin:</p>Construiește un grânar.');
tz_def('Q21_RESP', 'Bravo! Cu grânarul poți stoca mai mult grâu.');

tz_def('Q22', 'Sarcina 19: Magazie');
tz_def('Q22_DESC', 'Nu doar grâul trebuie salvat. Și celelalte resurse se pot pierde dacă nu sunt depozitate corect. Construiește o magazie!');
tz_def('Q22_ORDER', 'Ordin:</p>Construiește magazia.');
tz_def('Q22_RESP', 'Bravo, magazia ta este completă...</i><br>Acum ai îndeplinit toate condițiile necesare pentru a construi o piață.');

tz_def('Q23', 'Sarcina 20: Piața.');
tz_def('Q23_DESC', 'Construiește o piață ca să poți face comerț cu ceilalți jucători.');
tz_def('Q23_ORDER', 'Ordin:</p>Te rog construiește o piață.');
tz_def('Q23_RESP', 'Piața a fost finalizată. Acum poți crea oferte proprii și accepta ofertele străine! Când creezi oferte, gândește-te să oferi ceea ce au nevoie ceilalți jucători cel mai mult pentru profit mai mare.');

tz_def('Q24', 'Sarcina 21: Totul la 2.');
tz_def('Q24_DESC', 'Acum ar trebui să creștem puțin producția de resurse. Extinde toate câmpurile de resurse la nivelul 2.');
tz_def('Q24_ORDER', 'Ordin:</p>Extinde toate câmpurile de resurse la nivelul 2.');
tz_def('Q24_RESP', 'Felicitări! Satul tău crește și prosperă...');

tz_def('Q28', 'Sarcina 22: Alianță.');
tz_def('Q28_DESC', 'Munca în echipă este importantă în Travian. Jucătorii care colaborează se organizează în alianțe. Primește o invitație de la o alianță din regiunea ta și alătură-te. Alternativ, poți fonda propria alianță. Pentru asta ai nevoie de ambasadă nivel 3.');
tz_def('Q28_ORDER', 'Ordin:</p>Alătură-te unei alianțe sau fondează una.');
tz_def('Q28_RESP', 'Foarte bine! Acum ești într-o alianță numită');
tz_def('Q28_RESP1', ', și cu cât cooperezi mai mult, cu atât progresezi mai repede...');

tz_def('Q29', 'Sarcina 23: Clădirea Principală la nivelul 5');
tz_def('Q29_DESC', 'Pentru a putea construi un palat sau o reședință, ai nevoie de clădirea principală la nivelul 5.');
tz_def('Q29_ORDER', 'Ordin:</p>Îmbunătățește clădirea principală la nivelul 5.');
tz_def('Q29_RESP', 'Clădirea principală este acum nivelul 5 și poți construi palat sau reședință...');

tz_def('Q30', 'Sarcina 24: Grânar la nivelul 3.');
tz_def('Q30_DESC', 'Ca să nu pierzi grâu, ar trebui să-ți îmbunătățești grânarul.');
tz_def('Q30_ORDER', 'Ordin:</p>Îmbunătățește grânarul la nivelul 3.');
tz_def('Q30_RESP', 'Grânarul este acum nivelul 3...');

tz_def('Q31', 'Sarcina 25: Magazie la nivelul 7');
tz_def('Q31_DESC', 'Pentru ca resursele tale să nu dea pe afară, ar trebui să-ți îmbunătățești magazia.');
tz_def('Q31_ORDER', 'Ordin:</p>Îmbunătățește magazia la nivelul 7.');
tz_def('Q31_RESP', 'Magazia a fost îmbunătățită la nivelul 7...');

tz_def('Q32', 'Sarcina 26: Toate la cinci!');
tz_def('Q32_DESC', 'Vei avea mereu nevoie de mai multe resurse. Câmpurile de resurse sunt destul de scumpe, dar se amortizează pe termen lung.');
tz_def('Q32_ORDER', 'Ordin:</p>Îmbunătățește toate câmpurile de resurse la nivelul 5.');
tz_def('Q32_RESP', 'Toate resursele sunt la nivelul 5, foarte bine, satul tău crește și prosperă!');

tz_def('Q33', 'Sarcina 27: Palat sau Reședință?');
tz_def('Q33_DESC', 'Pentru a întemeia un sat nou, ai nevoie de coloniști. Îi poți antrena fie într-un palat, fie într-o reședință.');
tz_def('Q33_ORDER', 'Ordin:</p>Construiește un palat sau o reședință la nivelul 10.');
tz_def('Q33_RESP', 'a ajuns la nivelul 10, acum poți antrena coloniști și să-ți întemeiezi al doilea sat. Ține cont de punctele culturale...');

tz_def('Q34', 'Sarcina 28: 3 coloniști.');
tz_def('Q34_DESC', 'Pentru a întemeia un sat nou, ai nevoie de coloniști. Ei pot fi antrenați într-un palat sau o reședință.');
tz_def('Q34_ORDER', 'Ordin:</p>Antrenează 3 coloniști.');
tz_def('Q34_RESP', 'Au fost antrenați 3 coloniști. Pentru a întemeia un sat nou ai nevoie de cel puțin');
tz_def('Q34_RESP1', 'puncte culturale...');

tz_def('Q35', 'Sarcina 29: Sat nou.');
tz_def('Q35_DESC', 'Sunt multe căsuțe libere pe hartă. Găsește una potrivită și întemeiază un sat nou');
tz_def('Q35_ORDER', 'Ordin:</p>Întemeiază un sat nou.');
tz_def('Q35_RESP', 'Sunt mândru de tine! Acum ai două sate și ai toate posibilitățile să construiești un imperiu puternic. Îți urez mult noroc!');

tz_def('Q36', ' Sarcina 30: Construiește un ');
tz_def('Q36_DESC', 'Acum că ai antrenat câțiva soldați, ar trebui să construiești și un ');
tz_def('Q36_DESC1', ' de asemenea. Acesta crește apărarea de bază și soldații tăi vor primi un bonus defensiv.');
tz_def('Q36_ORDER', 'Ordin:</p>Construiește un ');
tz_def('Q36_RESP', 'Exact despre asta vorbeam. Un ');
tz_def('Q36_RESP1', ' Foarte util. Crește apărarea trupelor din sat.');

tz_def('Q37', 'Sarcini');
tz_def('Q37_DESC', 'Toate sarcinile îndeplinite!');

tz_def('RESOURCES_OVERVIEW', 'Prezentare resurse');
tz_def('YOUR_RES_DELIVERIES', 'Livrările tale de resurse');
tz_def('DELIVERY', 'Livrare');
tz_def('DELIVERY_TIME', 'Timp livrare');
tz_def('STATUS', 'Status');
tz_def('FETCH', 'preia');
tz_def('FETCHED', 'preluat');
tz_def('ON_HOLD', 'în așteptare');
tz_def('ONE_DAY_OF_TRAVIAN', '1 zi Travian Plus ');
tz_def('TWO_DAYS_OF_TRAVIAN', '2 zile Travian Plus ');

//Quest 25
tz_def('Q25_7', 'Sarcina 7: Vecini!');
tz_def('Q25_7_DESC', 'În jurul tău sunt multe sate diferite. Unul dintre ele se numește ');
tz_def('Q25_7_DESC1', 'Apasă pe `Hartă` în meniul de sus și caută acel sat. Numele satelor vecinilor îl vezi când treci cu mouse-ul peste ele.');
tz_def('Q25_7_ORDER', '</p><b>Ordin:</b><br>Caută coordonatele pentru ');
tz_def('Q25_7_ORDER1', 'și introdu-le aici.');
tz_def('Q25_7_RESP', 'Exact, acolo este ');
tz_def('Q25_7_RESP1', ' satul! Aproape la fel de multe resurse vei avea când ajungi acolo. Ei bine, aproape...');

tz_def('Q25_8', 'Sarcina 8: Armată uriașă!');
tz_def('Q25_8_DESC', 'Acum am o misiune foarte specială pentru tine. Mi-e foame. Dă-mi 200 grâu!<br><br>În schimb voi încerca să organizez o armată uriașă să-ți protejeze satul.');
tz_def('Q25_8_ORDER', 'Ordin:</p>Trimite 200 grâu maestrului de sarcini.');
tz_def('Q25_8_BUTN', 'Trimite grâu');
tz_def('Q25_8_NOCROP', 'Nu ai suficient grâu!');

tz_def('Q25_9', 'Sarcina 9: Câte unul!');
tz_def('Q25_9_DESC', 'În '.SERVER_NAME.' este mereu ceva de făcut! În timp ce aștepți noua ta armată,<br><br>extinde încă un tăietor de lemne, o carieră de argilă, o mină de fier și un lan de grâu la nivelul 1');
tz_def('Q25_9_ORDER', 'Ordin:</p>Extinde încă unul din fiecare câmp de resursă la nivelul 1.');
tz_def('Q25_9_RESP', 'Foarte bine, dezvoltare excelentă a producției de resurse.');

tz_def('Q25_10', 'Sarcina 10: În curând!');
tz_def('Q25_10_DESC', 'Acum este timp pentru o mică pauză până sosește armata gigantică pe care ți-am trimis-o.<br><br>Până atunci poți explora harta sau extinde câteva câmpuri de resurse.');
tz_def('Q25_10_ORDER', 'Ordin:</p>Așteaptă sosirea armatei maestrului de sarcini');
tz_def('Q25_10_RESP', 'Acum o armată uriașă de la maestrul de sarcini a sosit să-ți protejeze satul');
tz_def('Q25_10_REWARD', 'Recompensa ta:</p>încă 2 zile de Travian Plus');

tz_def('Q25_11', 'Sarcina 11: Rapoarte');
tz_def('Q25_11_DESC', 'De fiecare dată când se întâmplă ceva important în contul tău vei primi un raport.<br><br>Le poți vedea apăsând pe jumătatea stângă a celui de-al 5-lea buton (de la stânga la dreapta). Citește raportul și revino aici.');
tz_def('Q25_11_ORDER', 'Ordin:</p>Citește ultimul tău raport.');
tz_def('Q25_11_RESP', 'L-ai primit? Foarte bine. Iată recompensa ta.');

tz_def('Q25_12', 'Sarcina 12: Totul la 1.');
tz_def('Q25_12_DESC', 'Acum ar trebui să creștem puțin producția de resurse.');
tz_def('Q25_12_ORDER', 'Ordin:</p>Extinde toate câmpurile de resurse la nivelul 1.');
tz_def('Q25_12_RESP', 'Foarte bine, producția ta de resurse prosperă.<br><br>În curând putem începe construcția clădirilor în sat.');

tz_def('Q25_13', 'Sarcina 13: Porumbelul păcii');
tz_def('Q25_13_DESC', 'În primele zile după înregistrare ești protejat împotriva atacurilor altor jucători. Poți vedea cât durează protecția adăugând codul <b>[#0]</b> în profilul tău.');
tz_def('Q25_13_ORDER', 'Ordin:</p>Scrie codul <b>[#0]</b> în profilul tău, adăugându-l într-unul din cele două câmpuri de descriere.');
tz_def('Q25_13_RESP', 'Bravo! Acum toată lumea poate vedea ce mare războinic se apropie.');

tz_def('Q25_14', 'Sarcina 14: Ascunzătoare');
tz_def('Q25_14_DESC', 'Este timpul să construiești o ascunzătoare. Lumea din <b>'.SERVER_NAME.'</b> este periculoasă.<br><br>Mulți jucători trăiesc furând resursele altora. Construiește o ascunzătoare pentru a-ți ascunde o parte din resurse de inamici.');
tz_def('Q25_14_ORDER', 'Ordin:</p>Construiește o ascunzătoare.');
tz_def('Q25_14_RESP', 'Bravo, acum le va fi mult mai greu jucătorilor răutăcioși să-ți jefuiască satul.<br><br>În caz de atac, sătenii tăi vor ascunde singuri resursele în ascunzătoare.');

tz_def('Q25_15', 'Sarcina 15: La nivelul 2.');
tz_def('Q25_15_DESC', 'În <b>'.SERVER_NAME.'</b> este mereu ceva de făcut! Extinde un tăietor de lemne, o carieră de argilă, o mină de fier și un lan de grâu fiecare la nivelul 2.');
tz_def('Q25_15_ORDER', 'Ordin:</p>Extinde câte unul din fiecare câmp de resursă la nivelul 2.');
tz_def('Q25_15_RESP', 'Foarte bine, satul tău crește și prosperă!');

tz_def('Q25_16', 'Sarcina 16: Instrucțiuni');
tz_def('Q25_16_DESC', 'În instrucțiunile din joc găsești informații scurte despre clădiri și tipuri de trupe.<br><br>Apasă pe `instrucțiuni` în stânga pentru a afla cât lemn necesită cazarma.');
tz_def('Q25_16_ORDER', 'Ordin:</p>Introdu cât lemn costă cazarma');
tz_def('Q25_16_BUTN', 'finalizează sarcina');
tz_def('Q25_16_RESP', 'Exact! Cazarma costă 210 lemn.');

tz_def('Q25_17', 'Sarcina 17: Clădirea Principală');
tz_def('Q25_17_DESC', 'Meșterii tăi constructori au nevoie de clădirea principală la nivelul 3 pentru a ridica clădiri importante precum piața sau cazarma.');
tz_def('Q25_17_ORDER', 'Ordin:</p>Extinde clădirea principală la nivelul 3.');
tz_def('Q25_17_RESP', 'Bravo. Clădirea principală nivelul 3 a fost finalizată.<br><br>Cu acest upgrade meșterii tăi pot construi mai multe tipuri de clădiri și o fac și mai rapid.');

tz_def('Q25_18', 'Sarcina 18: Avansat!');
tz_def('Q25_18_DESC', 'Verifică-ți din nou rangul în statisticile jucătorilor și bucură-te de progres.');
tz_def('Q25_18_ORDER', 'Ordin:</p>Caută-ți rangul în statistici și introdu-l aici.');
tz_def('Q25_18_RESP', 'Bravo! Acesta este rangul tău actual.');

tz_def('Q25_19', 'Sarcina 19: Arme sau Bani');
tz_def('Q25_19_DESC', 'Acum trebuie să iei o decizie: fie faci comerț pașnic, fie devii un războinic de temut.<br><br>Pentru piață ai nevoie de un grânar, pentru cazarmă ai nevoie de un punct de adunare.');
tz_def('Q25_19_BUTN', 'Economie');
tz_def('Q25_19_BUTN1', 'Militar');

tz_def('Q25_20', 'Sarcina 19: Economie');
tz_def('Q25_20_DESC', 'Comerțul și economia au fost alegerea ta. Cu siguranță te așteaptă vremuri de aur!');
tz_def('Q25_20_ORDER', 'Ordin:</p>Construiește un grânar.');
tz_def('Q25_20_RESP', 'Bravo! Cu grânarul poți stoca mai mult grâu.');

tz_def('Q25_21', 'Sarcina 20: Magazie');
tz_def('Q25_21_DESC', 'Nu doar grâul trebuie salvat. Și celelalte resurse se pot pierde dacă nu sunt depozitate corect. Construiește o magazie!');
tz_def('Q25_21_ORDER', 'Ordin:</p>Construiește magazia.');
tz_def('Q25_21_RESP', 'Bravo, magazia ta este completă...</i><br>Acum ai îndeplinit toate condițiile necesare pentru a construi o piață.');

tz_def('Q25_22', 'Sarcina 21: Piața.');
tz_def('Q25_22_DESC', 'Construiește o piață ca să poți face comerț cu ceilalți jucători.');
tz_def('Q25_22_ORDER', 'Ordin:</p>Te rog construiește o piață.');
tz_def('Q25_22_RESP', 'Piața a fost finalizată. Acum poți crea oferte proprii și accepta oferte străine! Când creezi oferte, gândește-te să oferi ceea ce au nevoie ceilalți jucători cel mai mult pentru profit mai mare.');

tz_def('Q25_23', 'Sarcina 19: Militar');
tz_def('Q25_23_DESC', 'O decizie curajoasă. Pentru a putea trimite trupe ai nevoie de un punct de adunare.<br><br>Punctul de adunare trebuie construit pe un loc special. ');
tz_def('Q25_23_DESC1', 'locul de construcție');
tz_def('Q25_23_DESC2', ' se află în partea dreaptă a clădirii principale, puțin mai jos. Locul în sine este curbat.');
tz_def('Q25_23_ORDER', 'Ordin:</p>Construiește un punct de adunare.');
tz_def('Q25_23_RESP', 'Punctul tău de adunare a fost ridicat! Un pas bun spre dominația lumii!');

tz_def('Q25_24', 'Sarcina 20: Cazarma');
tz_def('Q25_24_DESC', 'Acum ai clădirea principală la nivelul 3 și un punct de adunare. Asta înseamnă că toate condițiile pentru construirea cazarmei sunt îndeplinite.<br><br>Poți folosi cazarma pentru a antrena trupe de luptă.');
tz_def('Q25_24_ORDER', 'Ordin:</p>Construiește cazarma.');
tz_def('Q25_24_RESP', 'Bravo... Cei mai buni instructori din toată țara s-au adunat pentru a antrena abilitățile de luptă ale oamenilor tăi la nivel maxim.');

tz_def('Q25_25', 'Sarcina 21: Antrenează.');
tz_def('Q25_25_DESC', 'Acum că ai cazarmă poți începe să antrenezi trupe. Antrenează două ');
tz_def('Q25_25_ORDER', 'Te rog antrenează 2 ');
tz_def('Q25_25_RESP', 'Bazele glorioasei tale armate au fost puse.<br><br>Înainte de a-ți trimite armata la jaf ar trebui să verifici cu');
tz_def('Q25_25_RESP1', 'Simulatorul de luptă');
tz_def('Q25_25_RESP2', 'pentru a vedea de câte trupe ai nevoie ca să învingi un șobolan fără pierderi.');

tz_def('Q25_26', 'Sarcina 22: Totul la 2.');
tz_def('Q25_26_DESC', 'Acum este din nou timpul să extinzi pietrele de temelie ale puterii și bogăției! De data asta nivelul 1 nu este suficient... va dura puțin, dar va merita. Extinde toate câmpurile tale de resurse la nivelul 2!');
tz_def('Q25_26_ORDER', 'Ordin:</p>Extinde toate câmpurile de resurse la nivelul 2.');
tz_def('Q25_26_RESP', 'Felicitări! Satul tău crește și prosperă...');

tz_def('Q25_27', 'Sarcina 23: Prieteni.');
tz_def('Q25_27_DESC', 'Ca jucător singur este greu să concurezi cu atacatorii. Este în avantajul tău dacă vecinii te plac.<br><br>Este și mai bine dacă joci împreună cu prietenii. Știai că poți câștiga '.GOLD_IMG.' invitând prieteni?');
tz_def('Q25_27_ORDER', 'Ordin:</p>Cât '.GOLD_IMG.' câștigi pentru invitarea unui prieten?');
tz_def('Q25_27_RESP', 'Corect! Primești 50 '.GOLD_IMG.' dacă prietenul invitat are 2 sate.');

tz_def('Q25_28', 'Sarcina 24: Construiește Ambasada.');
tz_def('Q25_28_DESC', 'Lumea Travian este periculoasă. Ai construit deja o ascunzătoare pentru protecție împotriva atacatorilor.<br><br>O alianță bună îți va oferi o protecție și mai bună.');
tz_def('Q25_28_ORDER', 'Ordin:</p>Pentru a accepta invitații de la alianțe, construiește o ambasadă.');
tz_def('Q25_28_RESP', 'Da! Poți aștepta invitația de la o alianță sau îți poți crea propria alianță dacă ambasada are nivelul 3');

tz_def('Q25_29', 'Sarcina 25: Alianță.');
tz_def('Q25_29_DESC', 'Munca în echipă este importantă în Travian. Jucătorii care colaborează se organizează în alianțe. Primește o invitație de la o alianță din regiunea ta și alătură-te. Alternativ, poți fonda propria alianță. Pentru asta ai nevoie de ambasadă nivel 3.');
tz_def('Q25_29_ORDER', 'Ordin:</p>Alătură-te unei alianțe sau fondează-ți propria alianță.');
tz_def('Q25_29_RESP', 'Bravo! Acum ești într-o alianță numită');
tz_def('Q25_29_RESP1', ', și ești membru al alianței lor.<br>Lucrând împreună veți progresa cu toții mai repede...');

tz_def('Q25_30', 'Sarcini');
tz_def('Q25_30_DESC', 'Toate sarcinile îndeplinite!');


//======================================================//
//================ UNITS - DO NOT EDIT! ================//
//======================================================//
tz_def('U0', 'Erou');

//ROMAN UNITS
tz_def('U1', 'Legionar');
tz_def('U2', 'Pretorian');
tz_def('U3', 'Imperian');
tz_def('U4', 'Equites Legati');
tz_def('U5', 'Equites Imperatoris');
tz_def('U6', 'Equites Caesaris');
tz_def('U7', 'Berbec');
tz_def('U8', 'Catapultă de foc');
tz_def('U9', 'Senator');
tz_def('U10', 'Coloniști');

//TEUTON UNITS
tz_def('U11', 'Bâtă');
tz_def('U12', 'Lăncier');
tz_def('U13', 'Topor');
tz_def('U14', 'Cercetaș');
tz_def('U15', 'Paladin');
tz_def('U16', 'Cavaler teuton');
tz_def('U17', 'Berbec');
tz_def('U18', 'Catapultă');
tz_def('U19', 'Căpetenie');
tz_def('U20', 'Coloniști');

//GAUL UNITS
tz_def('U21', 'Falanga');
tz_def('U22', 'Spadasin');
tz_def('U23', 'Potecar');
tz_def('U24', 'Tunetul lui Teutates');
tz_def('U25', 'Druid călare');
tz_def('U26', 'Haeduan');
tz_def('U27', 'Berbec');
tz_def('U28', 'Trebuchet');
tz_def('U29', 'Căpetenie');
tz_def('U30', 'Coloniști');
tz_def('U99', 'Capcană');

//NATURE UNITS
tz_def('U31', 'Șobolan');
tz_def('U32', 'Păianjen');
tz_def('U33', 'Șarpe');
tz_def('U34', 'Liliac');
tz_def('U35', 'Mistreț');
tz_def('U36', 'Lup');
tz_def('U37', 'Urs');
tz_def('U38', 'Crocodil');
tz_def('U39', 'Tigru');
tz_def('U40', 'Elefant');

//NATARS UNITS
tz_def('U41', 'Lăncier natar');
tz_def('U42', 'Războinic cu spini');
tz_def('U43', 'Gardian');
tz_def('U44', 'Păsări de pradă');
tz_def('U45', 'Călăreț cu topor');
tz_def('U46', 'Cavaler natar');
tz_def('U47', 'Elefant de război');
tz_def('U48', 'Balistă');
tz_def('U49', 'Împărat natar');
tz_def('U50', 'Coloniști natari');

//INDEX.php
tz_def('LOGIN', 'Autentificare');
tz_def('PLAYERS', 'Jucători');
tz_def('MODERATOR', 'Moderator');
tz_def('ACTIVE', 'Activi');
tz_def('ONLINE', 'Online');
tz_def('TUTORIAL', 'Tutorial');
if(!defined('FAQ')) define('FAQ', 'Întrebări frecvente');
if(!defined('SPIELREGELN')) define('SPIELREGELN', 'Regulament');
tz_def('PLAYER_STATISTICS', 'Statistici jucători');
tz_def('TOTAL_PLAYERS', PLAYERS.' în total');
tz_def('ACTIVE_PLAYERS', 'Jucători activi');
tz_def('ONLINE_PLAYERS', PLAYERS.' online');
tz_def('MP_STRATEGY_GAME', SERVER_NAME.' - jocul de strategie multiplayer');
tz_def('WHAT_IS', SERVER_NAME.' este unul dintre cele mai populare jocuri de browser din lume. Ca jucător în '.SERVER_NAME.', îți vei construi propriul imperiu, vei recruta o armată puternică și vei lupta alături de aliații tăi pentru supremația lumii.');
tz_def('REGISTER_FOR_FREE', 'Înregistrează-te gratuit aici!');
tz_def('LATEST_GAME_WORLD', 'Ultima lume de joc');
tz_def('LATEST_GAME_WORLD2', 'Înregistrează-te pe cea mai nouă<br>lume de joc și bucură-te<br>de avantajele<br>de a fi printre<br>primii jucători.');
tz_def('PLAY_NOW', 'Joacă '.SERVER_NAME.' acum');
tz_def('LEARN_MORE', 'Află mai multe <br>despre '.SERVER_NAME.'!');
tz_def('LEARN_MORE2', 'Acum cu un sistem de server<br>revoluționar, grafică complet nouă<br><br>Această clonă este The Shiz!');
tz_def('COMUNITY', 'Comunitate');
tz_def('BECOME_COMUNITY', 'Devino parte din comunitatea noastră acum!');
tz_def('BECOME_COMUNITY2', 'Alătură-te uneia dintre<br>cele mai mari comunități<br>de gaming din<br>lume.');
tz_def('NEWS', 'Știri');
tz_def('SCREENSHOTS', 'Capturi de ecran');
if(!defined('FAQ')) define('FAQ', 'Întrebări frecvente');
if(!defined('SPIELREGELN')) define('SPIELREGELN', 'Reguli');
tz_def('AGB', 'Termeni și Condiții');
tz_def('LEARN1', 'Îmbunătățește-ți câmpurile și minele pentru a crește producția de resurse. Vei avea nevoie de resurse pentru a construi clădiri și a antrena soldați.');
tz_def('LEARN2', 'Construiește și extinde clădirile din satul tău. Clădirile îmbunătățesc infrastructura, cresc producția de resurse și îți permit să cercetezi, să antrenezi și să îmbunătățești trupele.');
tz_def('LEARN3', 'Explorează și interacționează cu împrejurimile. Poți face noi prieteni sau dușmani, poți folosi oazele din apropiere și poți observa cum imperiul tău crește și devine mai puternic.');
tz_def('LEARN4', 'Urmărește-ți progresul și compară-te cu alți jucători. Consultă clasamentul Top 10 și luptă pentru o medalie săptămânală.');
tz_def('LEARN5', 'Primește rapoarte detaliate despre aventurile, comerțul și bătăliile tale. Nu uita să verifici noile rapoarte despre evenimentele din împrejurimi.');
tz_def('LEARN6', 'Schimbă informații și fă diplomație cu alți jucători. Amintește-ți mereu că comunicarea este cheia pentru a câștiga prieteni noi și a rezolva conflicte vechi.');
tz_def('LOGIN_TO', 'Autentifică-te în '.SERVER_NAME);
tz_def('REGIN_TO', 'Înregistrează-te în '.SERVER_NAME);
tz_def('P_ONLINE', 'Jucători online: ');
tz_def('P_TOTAL', 'Jucători în total: ');
tz_def('CHOOSE', 'Te rugăm să alegi un server.');
tz_def('STARTED', ' Serverul a pornit acum '. round((time() - COMMENCE) / 86400) .' zile.');

//ANMELDEN.php
tz_def('NICKNAME', 'Nume jucător');
tz_def('EMAIL', 'Email');
tz_def('PASSWORD', 'Parolă');
tz_def('NW', 'Nord-Vest');
tz_def('NE', 'Nord-Est');
tz_def('SW', 'Sud-Vest');
tz_def('SE', 'Sud-Est');
tz_def('RANDOM', 'aleatoriu');
tz_def('ACCEPT_RULES', ' Accept regulamentul jocului și termenii și condițiile generale.');
tz_def('ONE_PER_SERVER', 'Fiecare jucător poate deține UN SINGUR cont pe server.');
tz_def('BEFORE_REGISTER', 'Înainte să te înregistrezi ar trebui să citești <a href="/anleitung.php" target="_blank">instrucțiunile</a> Travian ro1 pentru a vedea avantajele și dezavantajele specifice ale celor trei triburi.');
tz_def('BUILDING_UPGRADING', 'Construcție:');
tz_def('HOURS', 'ore');

//ATTACKS ETC.
tz_def('TROOP_MOVEMENTS', 'Mișcări trupe:');
tz_def('ARRIVING_REINF_TROOPS', 'Trupe de întărire în sosire');
tz_def('ARRIVING_ATTACKING_TROOPS', 'Trupe atacante în sosire');
tz_def('ARRIVING_REINF_TROOPS_SHORT', 'Înt.');
tz_def('OWN_ATTACKING_TROOPS', 'Trupe proprii de atac');
tz_def('ATTACK', 'Atac');
tz_def('OWN_REINFORCING_TROOPS', 'Trupe proprii de întărire');
tz_def('NEWVILLAGE', 'Sat nou.');
tz_def('FOUNDNEWVILLAGE', 'Întemeiere sat nou');
tz_def('UNDERATTACK', 'Satul este sub atac');
tz_def('OASISATTACK', 'Oaza este sub atac');
tz_def('OASISATTACKS', 'Atac oază');
tz_def('RETURNFROM', 'Întoarcere din');
tz_def('REINFORCEMENTFOR', 'Întărire către');
tz_def('ATTACK_ON', 'Atac către');
tz_def('RAID_ON', 'Raid către');
tz_def('MARK_ATTACK', 'Marchează acest atac (gravitate)');
tz_def('SCOUTING', 'Explorare');
tz_def('PRISONERS', 'Prizonieri');
tz_def('PRISONERSIN', 'Prizonieri în');
tz_def('PRISONERSFROM', 'Prizonieri din');
tz_def('TROOPS', 'Trupe');
tz_def('BOUNTY', 'Pradă');
tz_def('ARRIVAL', 'Sosire');
tz_def('CATAPULT_TARGET', 'Țintă catapultă');
tz_def('INCOMING_TROOPS', 'Trupe în sosire');
tz_def('TROOPS_ON_THEIR_WAY', 'Trupe în drum');
tz_def('OWN_TROOPS', 'Trupe proprii');
tz_def('ON', 'Activeaza');
tz_def('AT', 'la');
tz_def('UPKEEP', 'Consum');
tz_def('SEND_BACK', 'Trimite înapoi');
tz_def('TROOPS_IN_THE_VILLAGE', 'Trupe în sat');
tz_def('TROOPS_IN_OTHER_VILLAGE', 'Trupe în alt sat');
tz_def('TROOPS_IN_OASIS', 'Trupe în oază');
tz_def('KILL', 'Ucide');
tz_def('FROM', 'De la');
tz_def('SEND_TROOPS', 'Trimite trupe');
tz_def('TASKMASTER', 'Maestru de sarcini');
tz_def('TO_THE_TASK', 'La sarcină');
tz_def('VILLAGE_OF_THE_ELDERS', 'satul bătrânilor');
tz_def('VILLAGE_OF_THE_ELDERS_TROOPS', 'trupele satului bătrânilor');

//SEND TROOP
tz_def('REINFORCE', 'Întărire');
tz_def('NORMALATTACK', 'Atac normal');
tz_def('RAID', 'Raid');
tz_def('OR', 'sau');
tz_def('SENDTROOP', 'Trimite trupe');
tz_def('NOTROOP', 'fără trupe');

//map
tz_def('DETAIL', 'Detalii');
tz_def('ABANDVALLEY', 'Vale abandonată');
tz_def('OCCUPIED', 'Ocupat');
tz_def('UNOCCUPIED', 'Neocupat');
tz_def('UNOCCUOASIS', 'Oază neocupată');
tz_def('OCCUOASIS', 'Oază ocupată');
tz_def('THERENOINFO', 'Nu există<br>informații disponibile.');
tz_def('LANDDIST', 'Distribuție teren');
tz_def('TRIBE', 'Trib');
tz_def('ALLIANCE', 'Alianță');
tz_def('POP', 'Populație');
tz_def('REPORT', 'Raport');
tz_def('OPTION', 'Opțiuni');
tz_def('CENTREMAP', 'Centrează harta');
tz_def('FNEWVILLAGE', 'Întemeiază sat nou');
tz_def('CULTUREPOINT', 'puncte culturale');
tz_def('BUILDRALLY', 'construiește un punct de adunare');
tz_def('SETTLERSAVAIL', 'coloniști disponibili');
tz_def('BEGINPRO', 'protecție începători');
tz_def('SENDMERC', 'Trimite negustor(i)');
tz_def('BAN', 'Jucător blocat');
tz_def('BUILDMARKET', 'Construiește piață');
tz_def('PERHOUR', 'pe oră');
tz_def('BONUS', 'Bonus');
tz_def('MAP', 'Hartă');
tz_def('LARGE_MAP', 'Hartă mare');
tz_def('LARGE_MAP_DESC', 'Afișează harta mare într-o fereastră nouă');
tz_def('CROPFINDER', 'Căutător 15c');
tz_def('NORTH', 'Nord');
tz_def('EAST', 'Est');
tz_def('SOUTH', 'Sud');
tz_def('WEST', 'Vest');
tz_def('CLOSE_MAP', 'Închide harta');
tz_def('AND', 'și');

//other
tz_def('VILLAGE', 'Sat');
tz_def('STATISTICS', 'Statistici');
tz_def('ALLIANCES', 'Alianțe');
tz_def('HEROES', 'Eroi');
tz_def('GENERAL', 'General');
tz_def('WWS', 'Minunea Lumii');
tz_def('TOP10P', 'TOP 10 Jucatori');
tz_def('TOP10PA', 'TOP 10 Atacatori');
tz_def('TOP10PD', 'TOP 10 Aparatori');
tz_def('TOP10A', 'TOP 10 Aliante');
tz_def('TOP10AA', 'TOP 10 Atacatori Aliante');
tz_def('TOP10AD', 'TOP 10 Aparatori Aliante');
tz_def('MILESTONES', 'Milestones');
tz_def('OASIS', 'Oază');
tz_def('NO_OASIS', 'Nu deții nicio oază.');
tz_def('NO_VILLAGES', 'Nu există sate.');
tz_def('PLAYER', 'Jucător');

//LOGIN.php
tz_def('COOKIES', 'Trebuie să ai cookie-urile activate pentru a te putea autentifica. Dacă împarți acest calculator cu alte persoane, ar trebui să te deloghezi după fiecare sesiune pentru siguranța ta.');
tz_def('NAME', 'Nume');
tz_def('PW_FORGOTTEN', 'Ai uitat parola?');
tz_def('PW_REQUEST', 'Atunci poți solicita una nouă care va fi trimisă pe adresa ta de email.');
tz_def('PW_GENERATE', 'Generează parolă nouă.');
tz_def('EMAIL_NOT_VERIFIED', 'Email neverificat!');
tz_def('EMAIL_FOLLOW', 'Urmează acest link pentru a-ți activa contul.');
tz_def('VERIFY_EMAIL', 'Verifică Email.');
tz_def('SERVER_STARTS_IN', 'Serverul va porni în: ');
tz_def('START_NOW', 'PORNEȘTE ACUM');

//404.php
tz_def('NOTHING_HERE', 'Nimic aici!');
tz_def('WE_LOOKED', 'Am căutat deja de 404 ori dar nu găsim nimic');

//MASSMESSAGE.php
tz_def('MASS', 'Conținut mesaj');
tz_def('MASS_SUBJECT', 'Subiect:');
tz_def('MASS_COLOR', 'Culoare mesaj:');
tz_def('MASS_REQUIRED', 'Toate câmpurile sunt obligatorii');
tz_def('MASS_UNITS', 'Imagini (unități):');
tz_def('MASS_SHOWHIDE', 'Arată/Ascunde');
tz_def('MASS_READ', 'Citește asta: după ce adaugi un smiley, trebuie să adaugi left sau right după număr, altfel imaginea nu va funcționa');
tz_def('MASS_CONFIRM', 'Confirmare');
tz_def('MASS_REALLY', 'Chiar vrei să trimiți Mesaj în Masă?');
tz_def('MASS_ABORT', 'Se anulează acum');
tz_def('MASS_SENT', 'Mesajul în Masă a fost trimis');

//BUILDINGS
tz_def('WOODCUTTER', 'Tăietor de lemne');
tz_def('WOODCUTTER_DESC', 'Tăietorul de lemne taie copaci pentru a produce lemn. Cu cât îl extinzi mai mult, cu atât se produce mai mult lemn.<br>Construind o fabrică de cherestea, poți crește și mai mult producția');
tz_def('CLAYPIT', 'Carieră de argilă');
tz_def('CLAYPIT_DESC', 'Aici se produce argilă. Prin creșterea nivelului, crești producția de argilă.<br>Construind o cărămidărie, poți crește și mai mult producția');
tz_def('IRONMINE', 'Mină de fier');
tz_def('IRONMINE_DESC', 'Aici minerii extrag prețiosul fier. Prin creșterea nivelului minei, crești producția de fier.<br>Construind o turnătorie de fier, poți crește și mai mult producția');
tz_def('CROPLAND', 'Lan de grâu');
tz_def('CROPLAND_DESC', 'Aici se produce hrana populației tale. Prin creșterea nivelului lanului, crești producția de grâu.<br>Construind o moară și o brutărie, poți crește și mai mult producția');

tz_def('SAWMILL', 'Fabrică de cherestea');
tz_def('SAWMILL_DESC', 'Lemnul tăiat de tăietorii tăi este prelucrat aici. Fabrica de cherestea crește producția de lemn în sat. La nivelul 1, crește producția cu 5%, iar la fiecare upgrade crește cu încă 5%, pentru un total de 25% după 5 niveluri.<br>Bonusul de la fabrică și de la toate clădirile care oferă bonusuri de resurse se aplică doar satului în care este construită clădirea.<br>Reține că bonusul fabricii nu se aplică altor efecte bonus precum venitul din oaze sau bonusul PLUS de 10%.<br>Există și sate cu 3 sau 5 câmpuri de lemn. Cu cât sunt mai multe câmpuri într-un sat, cu atât nivelurile fabricii pot fi folosite mai eficient');
tz_def('CURRENT_WOOD_BONUS', 'Bonus actual lemn:');
tz_def('WOOD_BONUS_LEVEL', 'Bonus lemn la nivelul');
tz_def('MAX_LEVEL', 'Clădirea este deja la nivel maxim');
tz_def('PERCENT', 'Procent');

tz_def('BRICKYARD', 'Fabrică de lut');
tz_def('CURRENT_CLAY_BONUS', 'Bonus actual argilă:');
tz_def('CLAY_BONUS_LEVEL', 'Bonus argilă la nivelul');
tz_def('BRICKYARD_DESC', 'Argila este transformată în cărămizi aici. Fabrica de lut crește producția de argilă în sat. La nivelul 1, crește producția cu 5%, iar la fiecare upgrade crește cu încă 5%, pentru un total de 25% după 5 niveluri.<br>Bonusul de la cărămidărie și de la toate clădirile care oferă bonusuri de resurse se aplică doar satului în care este construită.<br>Reține că bonusul cărămidăriei nu se aplică altor efecte bonus precum venitul din oaze sau bonusul PLUS de 10%.<br>Există și sate cu 3 sau 5 câmpuri de argilă. Cu cât sunt mai multe câmpuri, cu atât nivelurile pot fi folosite mai eficient');

tz_def('IRONFOUNDRY', 'Turnătorie de fier');
tz_def('CURRENT_IRON_BONUS', 'Bonus actual fier:');
tz_def('IRON_BONUS_LEVEL', 'Bonus fier la nivelul');
tz_def('IRONFOUNDRY_DESC', 'Fierul este topit aici. Turnătoria de fier crește producția de fier în sat. La nivelul 1, crește producția cu 5%, iar la fiecare upgrade crește cu încă 5%, pentru un total de 25% după 5 niveluri.<br>Bonusul de la turnătorie și de la toate clădirile care oferă bonusuri de resurse se aplică doar satului în care este construită.<br>Reține că bonusul turnătoriei nu se aplică altor efecte bonus precum venitul din oaze sau bonusul PLUS de 10%.<br>Există și sate cu 3 sau 5 câmpuri de fier. Cu cât sunt mai multe câmpuri, cu atât nivelurile pot fi folosite mai eficient');

tz_def('GRAINMILL', 'Moară');
tz_def('CURRENT_CROP_BONUS', 'Bonus actual grâu:');
tz_def('CROP_BONUS_LEVEL', 'Bonus grâu la nivelul');
tz_def('GRAINMILL_DESC', 'Grâul este măcinat în făină aici. Moara crește producția de hrană în sat. La nivelul 1, crește producția cu 5%, iar la fiecare upgrade crește cu încă 5%, pentru un total de 25% după 5 niveluri.<br>Folosește-o împreună cu brutăria pentru o creștere totală de până la 50%.<br>Bonusul de la moară și de la toate clădirile care oferă bonusuri de resurse se aplică doar satului în care este construită.<br>Reține că bonusul morii nu se aplică altor efecte bonus precum venitul din oaze sau bonusul PLUS de 10%.<br>Există și sate cu 9 sau 15 câmpuri de grâu. Cu cât sunt mai multe câmpuri, cu atât nivelurile pot fi folosite mai eficient');

tz_def('BAKERY', 'Brutărie');
tz_def('BAKERY_DESC', 'Pâinea este coaptă din făină aici. Brutăria crește producția de hrană în sat. La nivelul 1, crește producția cu 5%, iar la fiecare upgrade crește cu încă 5%, pentru un total de 25% după 5 niveluri.<br>Folosită împreună cu moara poate crește producția de grâu cu până la 50%.<br>Bonusul de la brutărie și de la toate clădirile care oferă bonusuri de resurse se aplică doar satului în care este construită.<br>Reține că bonusul brutăriei nu se aplică altor efecte bonus precum venitul din oaze sau bonusul PLUS de 10%.<br>Există și sate cu 9 sau 15 câmpuri de grâu. Cu cât sunt mai multe câmpuri, cu atât nivelurile pot fi folosite mai eficient');

tz_def('WAREHOUSE', 'Hambar');
tz_def('CURRENT_CAPACITY', 'Capacitate actuală:');
tz_def('CAPACITY_LEVEL', 'Capacitate la nivelul');
tz_def('RESOURCE_UNITS', 'unități resursă');
tz_def('WAREHOUSE_DESC', 'Resursele lemn, argilă și fier sunt stocate în hambar. Prin creșterea nivelului, crești capacitatea hambarului. Poate fi construită de mai multe ori, după ce una ajunge la nivel maxim');

tz_def('GRANARY', 'Grânar');
tz_def('CROP_UNITS', 'unități grâu');
tz_def('GRANARY_DESC', 'Grâul produs în ferme este stocat în grânar. Prin creșterea nivelului, crești capacitatea grânarului. Poate fi construit de mai multe ori, după ce unul ajunge la nivel maxim');

tz_def('BLACKSMITH', 'Fierărie');
tz_def('ACTION', 'Acțiune');
tz_def('UPGRADE', 'Îmbunătățește');
tz_def('UPGRADE_IN_PROGRESS', 'Îmbunătățire în<br>curs');
tz_def('UPGRADE_BLACKSMITH', 'Îmbunătățește<br>fierăria');
tz_def('UPGRADES_COMMENCE_BLACKSMITH', 'Îmbunătățirile pot începe când fierăria este finalizată.');
tz_def('MAXIMUM_LEVEL', 'Nivel<br>maxim');
tz_def('EXPAND_WAREHOUSE', 'Extinde<br>magazia');
tz_def('EXPAND_GRANARY', 'Extinde<br>grânarul');
tz_def('ENOUGH_RESOURCES', 'Destule resurse');
tz_def('CROP_NEGATIVE ', 'Producția de grâu este negativă, deci nu vei ajunge niciodată la resursele necesare');
tz_def('TOO_FEW_RESOURCES', 'Prea puține<br>resurse');
tz_def('UPGRADING', 'Se îmbunătățește');
tz_def('DURATION', 'Durată');
tz_def('COMPLETE', 'Finalizare');
tz_def('BLACKSMITH_DESC', 'Armele războinicilor tăi sunt îmbunătățite în cuptoarele fierăriei. Prin creșterea nivelului, poți comanda fabricarea unor arme și mai bune');

tz_def('ARMOURY', 'Atelier armuri');
tz_def('UPGRADE_ARMOURY', 'Îmbunătățește<br>atelierul');
tz_def('UPGRADES_COMMENCE_ARMOURY', 'Îmbunătățirile pot începe când atelierul este finalizat.');
tz_def('ARMOURY_DESC', 'Armurile războinicilor tăi sunt îmbunătățite în cuptoarele atelierului. Prin creșterea nivelului, poți comanda fabricarea unor armuri și mai bune');

tz_def('TOURNAMENTSQUARE', 'Piața turnirului');
tz_def('CURRENT_SPEED', 'Bonus actual viteză:');
tz_def('SPEED_LEVEL', 'Bonus viteză la nivelul');
tz_def('TOURNAMENTSQUARE_DESC', 'Trupele tale își pot crește rezistența în piața turnirului. Cu cât clădirea este mai avansată, cu atât trupele tale sunt mai rapide dincolo de o distanță minimă de '.TS_THRESHOLD.' căsuțe');

tz_def('MAINBUILDING', 'Clădirea Principală');
tz_def('CURRENT_CONSTRUCTION_TIME', 'Timp actual de construcție:');
tz_def('CONSTRUCTION_TIME_LEVEL', 'Timp de construcție la nivelul');
tz_def('DEMOLITION_BUILDING', 'Demolarea clădirii:</h2><p>Dacă nu mai ai nevoie de o clădire, poți ordona demolarea acesteia.</p>');
tz_def('DEMOLISH', 'Demolează');
tz_def('DEMOLITION_OF', 'Demolarea ');
tz_def('MAINBUILDING_DESC', 'Meșterii constructori ai satului locuiesc în clădirea principală. Cu cât nivelul este mai mare, cu atât mai repede finalizează construcția clădirilor noi.');

tz_def('RALLYPOINT', 'Adunare');
tz_def('RALLYPOINT_COMMENCE', 'Mișcările trupelor vor fi afișate când '.RALLYPOINT.'a este finalizat');
tz_def('OVERVIEW', 'Prezentare generală');
tz_def('REINFORCEMENT', 'Întărire');
tz_def('EVASION_SETTINGS', 'setări evitare');
tz_def('SEND_TROOPS_AWAY_MAX', 'Trimite trupele de maxim');
tz_def('TIMES', 'ori');
tz_def('PER_EVASION', 'per evitare');
tz_def('RALLYPOINT_DESC', 'Aici se adună trupele satului tău. De aici le poți trimite să cucerească, să facă raid sau să întărească alte sate.<br>Dacă sunt mai puține unități atacante decât nivelul punctului de adunare, poți vedea tipul unității care atacă.');
tz_def('COMBAT_SIMULATOR', 'Simulator de luptă');

tz_def('MARKETPLACE', 'Piață');
tz_def('MERCHANT', 'Negustori');
tz_def('OR_', 'sau');
tz_def('GO', 'merg');
tz_def('UNITS_OF_RESOURCE', 'unități de resursă');
tz_def('MERCHANT_CARRY', 'Fiecare negustor poate transporta');
tz_def('MERCHANT_COMING', 'Negustori în sosire');
tz_def('TRANSPORT_FROM', 'Transport din');
tz_def('ARRIVAL_IN', 'Sosire în');
tz_def('NO_COORDINATES_SELECTED', 'Nicio coordonată selectată');
tz_def('CANNOT_SEND_RESOURCES', 'Nu poți trimite resurse către același sat');
tz_def('BANNED_CANNOT_SEND_RESOURCES', 'Jucătorul este blocat. Nu poți trimite resurse către el');
tz_def('RESOURCES_NO_SELECTED', 'Resurse neselectate');
tz_def('ENTER_COORDINATES', 'Introdu coordonatele sau numele satului');
tz_def('TOO_FEW_MERCHANTS', 'Prea puțini negustori');
tz_def('OWN_MERCHANTS_ONWAY', 'Negustori proprii în drum');
tz_def('MERCHANTS_RETURNING', 'Negustori care se întorc');
tz_def('TRANSPORT_TO', 'Transport către');
tz_def('I_AN_SEARCHING', 'Caut');
tz_def('I_AN_OFFERING', 'Ofer');
tz_def('OFFERS_MARKETPLACE', 'Oferte la piață');
tz_def('NO_AVAILABLE_OFFERS', 'Nicio ofertă la piață');
tz_def('OFFERED_TO_ME', 'Oferit<br>mie');
tz_def('WANTED_TO_ME', 'Cerut<br>de la mine');
tz_def('NOT_ENOUGH_MERCHANTS', 'Negustori insuficienți');
tz_def('ACCEP_OFFER', 'Acceptă oferta');
tz_def('NO_AVALIBLE_OFFERS', 'Nu există oferte disponibile pe piață');
tz_def('SEARCHING', 'Căutare');
tz_def('OFFERING', 'Ofertare');
tz_def('MAX_TIME_TRANSPORT', 'timp max. transport');
tz_def('OWN_ALLIANCE_ONLY', 'doar alianța proprie');
tz_def('INVALID_OFFER', 'Ofertă invalidă');
tz_def('INVALID_MERCHANTS_REPETITION', 'Rată invalidă de repetare negustori');
tz_def('USER_ON_VACATION', 'Jucătorul este în modul vacanță');
tz_def('VACATION_MODE', 'Mod vacanță');
tz_def('VACATION_DESC', 'Dacă plănuiești să lipsești o perioadă mai lungă și nu vrei să setezi un sitter, poți activa Modul Vacanță. În acest timp contul tău nu va mai produce resurse, PC, cercetări, trupe etc., și nu va primi atacuri, întăriri, raiduri, practic înghețând contul. Ține minte, îngheață doar Travianul, nu și timpul. Dacă ești membru Gold Club, acesta va expira în acest timp, iar dacă ai reînnoire automată, aceasta va fi anulată în Modul Vacanță. Reține că trebuie să setezi minim 2 zile de vacanță și NU MAI MULT de 14 zile');
tz_def('VACATION_DESC2', 'Folosește modul vacanță pentru a-ți proteja satele cât ești plecat.<br>În timpul vacanței vor fi inactive următoarele acțiuni:');
tz_def('VAC_OP1', 'Trimiterea sau primirea trupelor');
tz_def('VAC_OP2', 'Pornirea unei noi construcții');
tz_def('VAC_OP3', 'Folosirea pieței');
tz_def('VAC_OP4', 'Antrenarea de trupe noi');
tz_def('VAC_OP5', 'Alăturarea la o alianță');
tz_def('VAC_OP6', 'Ștergerea contului');
tz_def('VAC_COND1', 'Fără trupe în mișcare');
tz_def('VAC_COND2', 'Fără trupe în drum spre alte sate');
tz_def('VAC_COND3', 'Fără trupe trimise ca întăriri în alte sate');
tz_def('VAC_COND4', 'Niciun jucător nu are întăriri în satele tale');
tz_def('VAC_COND5', 'Nu deții Minunea Lumii');
tz_def('VAC_COND6', 'Nu deții niciun artefact');
tz_def('VAC_COND7', 'Nu mai ești în protecția începătorilor');
tz_def('VAC_COND8', 'Nu ai trupe în capcane');
tz_def('VAC_COND9', 'Contul tău nu este în proces de ștergere');
tz_def('NOT_ENOUGH_RESOURCES', 'Resurse insuficiente');
tz_def('OFFER', 'Ofertă');
tz_def('SEARCH', 'Caută');
tz_def('OWN_OFFERS', 'Ofertele mele');
tz_def('ALL', 'Toate');
tz_def('NPC_TRADE', 'Comerț NPC');
tz_def('SUM', 'Sumă');
tz_def('REST', 'Rest');
tz_def('TRADE_RESOURCES', 'Comerț resurse la (pasul 2 din 2');
tz_def('DISTRIBUTE_RESOURCES', 'Distribuie resurse la (pasul 1 din 2)');
tz_def('OF', 'din');
tz_def('NPC_COMPLETED', 'NPC finalizat');
tz_def('BACK_BUILDING', 'Înapoi la clădire');
tz_def('YOU_CAN_NAT_NPC_WW', 'Nu poți folosi comerțul NPC în satul cu Minunea Lumii.');
tz_def('NPC_TRADING', 'Comerț NPC');
tz_def('SEND_RESOURCES', 'Trimite resurse');
tz_def('BUY', 'Cumpără');
tz_def('TRADE_ROUTES', 'Rute comerciale');
tz_def('DESCRIPTION', 'Descriere');
tz_def('G_DESCR', 'Descriere generală');
tz_def('TIME_LEFT', 'Timp rămas');
tz_def('START', 'Start');
tz_def('NO_TRADE_ROUTES', 'Nicio rută comercială activă');
tz_def('TRADE_ROUTE_TO', 'Rută comercială către');
tz_def('CHECKED', 'bifat');
tz_def('DAYS', 'zile');
tz_def('EXTEND', 'Prelungește');
tz_def('EDIT', 'Editează');
tz_def('EXTEND_TRADE_ROUTES', 'Prelungește ruta comercială cu <b>7</b> zile pentru');
tz_def('CREATE_TRADE_ROUTES', 'Creează rută comercială nouă');
tz_def('DELIVERIES', 'Livrări');
tz_def('START_TIME_TRADE', 'Oră de start');
tz_def('CREATE_TRADE_ROUTE', 'Creează rută comercială');
tz_def('TARGET_VILLAGE', 'Sat țintă');
tz_def('EDIT_TRADE_ROUTES', 'Editează ruta comercială');
tz_def('TRADE_ROUTES_DESC', 'Ruta comercială îți permite să setezi trasee pentru negustorii tăi pe care le vor parcurge zilnic la o anumită oră. <br><br> Standard durează <b>7</b> zile, dar o poți prelungi cu <b>7</b> zile pentru costul de');
tz_def('NPC_TRADE_DESC', 'Cu negustorul NPC poți distribui resursele din depozit după dorință. <br><br> Prima linie arată stocul actual. În a doua linie poți alege o altă distribuție. A treia linie arată diferența dintre stocul vechi și cel nou.');
tz_def('MARKETPLACE_DESC', 'La piață poți face comerț cu resurse cu alți jucători. Cu cât nivelul este mai mare, cu atât mai multe resurse pot fi transportate de negustorii tăi simultan');

tz_def('EMBASSY', 'Ambasadă');
tz_def('TAG', 'Tag');
tz_def('TO_THE_ALLIANCE', 'către alianță');
tz_def('JOIN_ALLIANCE', 'alătură-te alianței');
tz_def('REFUSE', 'refuză');
tz_def('ACCEPT', 'acceptă');
tz_def('NO_INVITATIONS', 'Nu există invitații disponibile.');
tz_def('NO_CREATE_ALLIANCE', 'Jucătorul blocat nu poate crea o alianță.');
tz_def('FOUND_ALLIANCE', 'fondează alianță');
tz_def('EMBASSY_DESC', 'Ambasada este locul diplomaților. La nivelul 1 poți intra într-o alianță, iar după ce o extinzi la nivelul 3 poți chiar să fondezi una.<br>Numărul maxim de membri într-o alianță este 60');

tz_def('BARRACKS', 'Cazarmă');
tz_def('QUANTITY', 'Cantitate');
tz_def('MAX', 'Max');
tz_def('TRAINING', 'Antrenament');
tz_def('FINISHED', 'Finalizat');
tz_def('UNIT_FINISHED', 'Următoarea unitate va fi gata în');
tz_def('AVAILABLE', 'Disponibil');
tz_def('TRAINING_COMMENCE_BARRACKS', 'Antrenamentul poate începe când cazarma este finalizată.');
tz_def('BARRACKS_DESC', 'Infanteria poate fi antrenată în cazarmă. Cu cât nivelul este mai mare, cu atât trupele sunt antrenate mai repede');

tz_def('STABLE', 'Grajd');
tz_def('AVAILABLE_ACADEMY', 'Nicio unitate disponibilă. Cercetează la academie');
tz_def('TRAINING_COMMENCE_STABLE', 'Antrenamentul poate începe când grajdul este finalizat.');
tz_def('STABLE_DESC', 'Cavaleria poate fi antrenată în grajd. Cu cât nivelul este mai mare, cu atât trupele sunt antrenate mai repede');

tz_def('WORKSHOP', 'Atelier');
tz_def('TRAINING_COMMENCE_WORKSHOP', 'Antrenamentul poate începe când atelierul este finalizat.');
tz_def('WORKSHOP_DESC', 'Mașinile de asediu, precum catapultele și berbecii, pot fi construite în atelier. Cu cât nivelul este mai mare, cu atât aceste unități sunt produse mai repede');

tz_def('ACADEMY', 'Academie');
tz_def('RESEARCH_AVAILABLE', 'Nu există cercetări disponibile');
tz_def('RESEARCH_COMMENCE_ACADEMY', 'Cercetarea poate începe când academia este finalizată.');
tz_def('RESEARCH', 'Cercetează');
tz_def('EXPAND_WAREHOUSE1', 'Extinde magazia');
tz_def('EXPAND_GRANARY1', 'Extinde grânarul');
tz_def('RESEARCH_IN_PROGRESS', 'Cercetare în<br>curs');
tz_def('RESEARCHING', 'Se cercetează');
tz_def('PREREQUISITES', 'Condiții prealabile');
tz_def('SHOW_MORE', 'arată mai mult');
tz_def('HIDE_MORE', 'ascunde');
tz_def('ACADEMY_DESC', 'Tipuri noi de unități pot fi cercetate în academie. Prin creșterea nivelului, poți ordona cercetarea unor unități mai bune');

tz_def('CRANNY', 'Ascunzătoare');
tz_def('CURRENT_HIDDEN_UNITS', 'Unități ascunse în prezent per resursă:');
tz_def('HIDDEN_UNITS_LEVEL', 'Unități ascunse per resursă la nivelul');
tz_def('UNITS', 'unități');
tz_def('CRANNY_DESC', 'Ascunzătoarea îți ascunde o parte din resurse în caz de atac asupra satului. Aceste resurse nu pot fi furate.<br>La nivelul 1 ascunzătoarea poate păstra '.(100*((int)CRANNY_CAPACITY)).' din fiecare resursă. Capacitatea ascunzătorilor galice este de 1,5 ori mai mare.<br>Dacă un erou teuton atacă un sat, ascunzătorile pot ascunde doar 80% din capacitatea lor normală');

tz_def('TOWNHALL', 'Casă de cultură');
tz_def('CELEBRATIONS_COMMENCE_TOWNHALL', 'Sărbătorile pot începe când primăria este finalizată.');
tz_def('GREAT_CELEBRATIONS', 'Sărbătoare mare');
tz_def('CULTURE_POINTS', 'Puncte culturale');
tz_def('HOLD', 'ține');
tz_def('CELEBRATIONS_IN_PROGRESS', 'Sărbătoare în<br>curs');
tz_def('CELEBRATIONS', 'Sărbători');
tz_def('TOWNHALL_DESC', 'În casa de cultură poți organiza sărbători pompoase. O astfel de sărbătoare îți crește punctele culturale.<br>Punctele culturale sunt necesare pentru a întemeia sau cuceri sate noi. Fiecare clădire produce puncte culturale, iar cu cât nivelul este mai mare, cu atât produce mai multe');

tz_def('RESIDENCE', 'Reședință');
tz_def('CAPITAL', 'Aceasta este capitala ta');
tz_def('RESIDENCE_TRAIN_DESC', 'Pentru a întemeia un sat nou ai nevoie de o reședință nivel 10 sau 20 și 3 coloniști. Pentru a cuceri un sat nou ai nevoie de o reședință nivel 10 sau 20 și un senator, căpetenie sau șef.');
tz_def('PRODUCTION_POINTS', 'Producția acestui sat:');
tz_def('PRODUCTION_ALL_POINTS', 'Producția tuturor satelor:');
tz_def('POINTS_DAY', 'Puncte culturale pe zi');
tz_def('VILLAGES_PRODUCED', 'Satele tale au produs');
tz_def('POINTS_NEED', 'puncte în total. Pentru a întemeia sau cuceri un sat nou ai nevoie de');
tz_def('POINTS', 'puncte');
tz_def('INHABITANTS', 'Locuitori');
tz_def('COORDINATES', 'Coordonate');
tz_def('EXPANSION', 'Expansiune');
tz_def('TRAIN', 'Antrenează');
tz_def('DATE', 'Data');
tz_def('CONQUERED_BY_VILLAGE', 'Sate întemeiate sau cucerite de acest sat');
tz_def('NONE_CONQUERED_BY_VILLAGE', 'Niciun alt sat nu a fost încă întemeiat sau cucerit de acest sat.');
tz_def('RESIDENCE_CULTURE_DESC', 'Pentru a-ți extinde imperiul ai nevoie de puncte culturale. Aceste puncte cresc în timp și o fac mai repede pe măsură ce nivelurile clădirilor cresc.');
tz_def('RESIDENCE_LOYALTY_DESC', 'Atacând cu senatori, căpetenii sau șefi, loialitatea unui sat poate fi redusă. Dacă ajunge la zero, satul se alătură regatului atacatorului. Loialitatea acestui sat este în prezent la ');
tz_def('RESIDENCE_DESC', 'Reședința protejează satul împotriva cuceririlor inamice. Poți construi o reședință per sat. Unitățile care pot întemeia un sat nou sau cuceri sate existente pot fi antrenate aici.<br>În plus, reședința oferă un slot de expansiune la nivelurile 10 și 20');

tz_def('PALACE', 'Palat');
tz_def('PALACE_CONSTRUCTION', 'Palat în construcție');
tz_def('PALACE_TRAIN_DESC', 'Pentru a întemeia un sat nou ai nevoie de un palat nivel 10, 15 sau 20 și 3 coloniști. Pentru a cuceri un sat nou ai nevoie de un palat nivel 10, 15 sau 20 și un senator, căpetenie sau șef.');
tz_def('CHANGE_CAPITAL', 'schimbă capitala');
tz_def('SECURITY_CHANGE_CAPITAL', 'Ești sigur că vrei să schimbi capitala?<br><b>Nu poți anula această acțiune!</b><br>Pentru securitate trebuie să introduci parola pentru confirmare:<br>');
tz_def('PALACE_DESC', 'Clădirea palatului este unică. Poți construi doar unul în tot regatul tău și poți proclama acel sat drept capitală. De asemenea, protejează satul împotriva cuceririlor inamice. Unitățile care pot întemeia un sat nou sau cuceri sate existente pot fi antrenate aici.<br>În plus, palatul oferă un slot de expansiune la nivelurile 10, 15 și 20');

tz_def('TREASURY', 'Trezorerie');
tz_def('TREASURY_COMMENCE', 'Artefactele pot fi văzute când trezoreria este finalizată.');
tz_def('ARTEFACTS_AREA', 'Artefacte în zona ta');
tz_def('NO_ARTEFACTS_AREA', 'Nu există artefacte în zona ta.');
tz_def('OWN_ARTEFACTS', 'Artefacte proprii');
tz_def('CONQUERED', 'Cucerit');
tz_def('DISTANCE', 'Distanță');
tz_def('EFFECT', 'Efect');
tz_def('ACCOUNT', 'Cont');
tz_def('SMALL_ARTEFACTS', 'Artefacte mici');
tz_def('LARGE_ARTEFACTS', 'Artefacte mari');
tz_def('NO_ARTEFACTS', 'Nu există artefacte.');
tz_def('ANY_ARTEFACTS', 'Nu deții niciun artefact.');
tz_def('OWNER', 'Proprietar');
tz_def('AREA_EFFECT', 'Zonă de efect');
tz_def('VILLAGE_EFFECT', 'Efect sat');
tz_def('ACCOUNT_EFFECT', 'Efect cont');
tz_def('UNIQUE_EFFECT', 'Efect unic');
tz_def('REQUIRED_LEVEL', 'Nivel necesar');
tz_def('TIME_CONQUER', 'Timp cucerire');
tz_def('TIME_ACTIVATION', 'Timp activare');
tz_def('NEXT_EFFECT', ' Următorul efect');
tz_def('FORMER_OWNER', 'Fost(i) proprietar(i)');
tz_def('BUILDING_STRONGER', 'Clădiri mai puternice cu');
tz_def('BUILDING_WEAKER', 'Clădiri mai slabe cu');
tz_def('TROOPS_FASTER', 'Face trupele mai rapide cu');
tz_def('TROOPS_SLOWEST', 'Face trupele mai lente cu');
tz_def('SPIES_INCREASE', 'Spionii își cresc abilitatea cu');
tz_def('SPIES_DECRESE', 'Spionii își scad abilitatea cu');
tz_def('CONSUME_LESS', 'Toate trupele consumă mai puțin cu');
tz_def('CONSUME_HIGH', 'Toate trupele consumă mai mult cu');
tz_def('TROOPS_MAKE_FASTER', 'Trupele se antrenează mai repede cu');
tz_def('TROOPS_MAKE_SLOWEST', 'Trupele se antrenează mai lent cu');
tz_def('YOU_CONSTRUCT', 'Poți construi ');
tz_def('CRANNY_INCREASED', 'Capacitatea ascunzătorii este crescută cu');
tz_def('CRANNY_DECRESE', 'Capacitatea ascunzătorii este scăzută cu');
tz_def('WW_BUILDING_PLAN', 'Poți construi Minunea Lumii');
tz_def('NO_WW', 'Nu există Minuni ale Lumii');
tz_def('NO_PREVIOUS_OWNERS', 'Nu există foști proprietari.');
tz_def('TREASURY_DESC', 'Bogățiile imperiului tău sunt păstrate în trezorerie. O trezorerie poate stoca un singur artefact odată.<br>Ai nevoie de trezorerie nivel 10 pentru un artefact mic, sau nivel 20 pentru unul mare');

tz_def('TRADEOFFICE', 'Oficiu comercial');
tz_def('CURRENT_MERCHANT', 'Încărcătură actuală negustor:');
tz_def('MERCHANT_LEVEL', 'Încărcătură negustor la nivelul');
tz_def('TRADEOFFICE_DESC', 'În oficiul comercial, căruțele negustorilor sunt îmbunătățite și echipate cu cai mai puternici. Cu cât nivelul este mai mare, cu atât negustorii tăi pot transporta mai mult');

tz_def('GREATBARRACKS', 'Cazarmă mare');
tz_def('TRAINING_COMMENCE_GREATBARRACKS', 'Antrenamentul poate începe când cazarma mare este finalizată.');
tz_def('GREATBARRACKS_DESC', 'Cazarma mare îți permite să construiești o a doua cazarmă în același sat, dar trupele costă de 3 ori mai mult.<br>Împreună cu cazarma normală, poți antrena trupele de două ori mai repede într-un sat');

tz_def('GREATSTABLE', 'Grajd mare');
tz_def('TRAINING_COMMENCE_GREATSTABLE', 'Antrenamentul poate începe când grajdul mare este finalizat.');
tz_def('GREATSTABLE_DESC', 'Grajdul mare îți permite să construiești un al doilea grajd în același sat, dar trupele costă de 3 ori mai mult.<br>Împreună cu grajdul normal, poți antrena trupele de două ori mai repede într-un sat');

tz_def('CITYWALL', 'Zid de oraș');
tz_def('DEFENCE_NOW', 'Bonus apărare acum:');
tz_def('DEFENCE_LEVEL', 'Bonus apărare la nivelul');
tz_def('CITYWALL_DESC', 'Oferă un bonus defensiv trupelor tale (((1.03 ^ nivel) * 100)% + 10) puncte defensive pe nivel la valoarea de bază a satului. Cu cât nivelul zidului este mai mare, cu atât bonusul defensiv este mai mare.<br>Specific tribului: doar romanii');

tz_def('EARTHWALL', 'Zid de pământ');
tz_def('EARTHWALL_DESC', 'Oferă un bonus defensiv trupelor tale (((1.02 ^ nivel) * 100)% + 6) puncte defensive pe nivel la valoarea de bază a satului. Cu cât nivelul este mai mare, cu atât bonusul este mai mare.<br>Specific tribului: doar teutonii');

tz_def('PALISADE', 'Palissadă');
tz_def('PALISADE_DESC', 'Oferă un bonus defensiv trupelor tale (((1.025 ^ nivel) * 100)% + 8) puncte defensive pe nivel la valoarea de bază a satului. Cu cât nivelul este mai mare, cu atât bonusul este mai mare.<br>Specific tribului: doar galii');

tz_def('STONEMASON', 'Atelierul pietrarului');
tz_def('CURRENT_STABILITY', 'Bonus actual stabilitate:');
tz_def('STABILITY_LEVEL', 'Bonus stabilitate la nivelul');
tz_def('STONEMASON_DESC', 'Pietrarul este expert în tăierea pietrei. Cu cât nivelul atelierului pietrarului este mai mare, cu atât stabilitatea clădirilor satului tău este mai mare. Pentru fiecare nivel, această clădire crește durabilitatea cu 10% pentru un maxim de 200% durabilitate.<br>Această clădire poate fi construită doar în capitala contului');

tz_def('BREWERY', 'Berărie');
tz_def('CURRENT_BONUS', 'Bonus actual:');
tz_def('BONUS_LEVEL', 'Bonus la nivelul');
tz_def('BREWERY_DESC', 'Aici se fabrică hidromel gustos. Băuturile îți fac soldații mai curajoși și mai puternici la atac (1% per nivel berărie). Din păcate, puterea de convingere a conducătorilor este redusă cu 50% și catapultele pot lovi doar aleatoriu. Poate fi construită doar în capitală, dar afectează toate satele tale. Festivalurile hidromelului durează mereu 72 de ore.<br>Specific tribului: doar teutonii');
tz_def('MEAD_FESTIVAL', 'Festivalul Hidromelului');
tz_def('MEAD_FESTIVAL_IN_PROGRESS', 'Festivalul Hidromelului<br>în desfășurare');
tz_def('MEAD_FESTIVAL_COMMENCE_BREWERY', 'Festivalul Hidromelului poate fi pornit după finalizarea Berăriei.');

tz_def('TRAPPER', 'Capcană');
tz_def('CURRENT_TRAPS', 'Număr maxim actual de capcane de antrenat:');
tz_def('TRAPS_LEVEL', 'Număr maxim de capcane la nivelul');
tz_def('TRAPS', 'Capcane');
tz_def('TRAP', 'Capcană');
tz_def('CURRENT_HAVE', 'În prezent ai');
tz_def('WHICH_OCCUPIED', 'dintre care sunt ocupate.');
tz_def('TRAINING_COMMENCE_TRAPPER', 'Antrenamentul poate începe când capcana este finalizată.');
tz_def('TRAPPER_DESC', 'Capcana îți protejează satul cu capcane bine ascunse. Asta înseamnă că inamicii neatenți pot fi închiși și nu îți vor mai putea face rău.<br>Trupele nu pot fi eliberate printr-un raid. Dacă proprietarul capcanelor eliberează prizonierii, toate capcanele vor fi reparate automat.<br>Specific tribului: doar galii');

tz_def("HEROSMANSION", "Conacul eroului");
tz_def('HERO_READY', 'Eroul va fi gata în ');
tz_def('NAME_CHANGED', 'Numele eroului a fost schimbat');
tz_def('NOT_UNITS', 'Unități indisponibile');
tz_def('NOT', 'Nu ');
tz_def('TRAIN_HERO', 'Antrenează erou nou');
tz_def('REVIVE', 'Reînvie');
tz_def('OASES', 'Oaze');
tz_def('DELETE', 'Șterge');
tz_def('RESOURCES', 'Resurse');
tz_def('OFFENCE', 'Atac');
tz_def('DEFENCE', 'Apărare');
tz_def('OFF_BONUS', 'Bonus atac');
tz_def('DEF_BONUS', 'Bonus apărare');
tz_def('REGENERATION', 'Regenerare');
tz_def('DAY', 'Zi');
tz_def('EXPERIENCE', 'Experiență');
tz_def('YOU_CAN', 'Poți ');
tz_def('RESET', 'reseta');
tz_def('YOUR_POINT_UNTIL', ' punctele până ești nivel ');
tz_def('OR_LOWER', ' sau mai mic!');
tz_def('YOUR_HERO_HAS', 'Eroul tău are ');
tz_def('OF_HIT_POINTS', 'din punctele sale de viață');
tz_def('ERROR_NAME_SHORT', 'Eroare: nume prea scurt');
tz_def('HEROSMANSION_DESC', 'Conacul eroului este casa gloriosului tău erou.<br>La nivelurile 10, 15 și 20 ale clădirii, poți folosi eroul pentru a anexa o oază neocupată la satul tău, câte una pentru fiecare nivel. În funcție de oază, vei primi o creștere de producție pentru un anumit tip de resursă (sau chiar două resurse, la unele oaze)');

tz_def('GREATWAREHOUSE', 'Hambar mare');
tz_def('GREATWAREHOUSE_DESC', 'Hambarul mare are de 3 ori capacitatea unui hambar normal.<br>Această clădire poate fi construită doar în satele cu Minunea Lumii sau cu un artefact natar special');

tz_def('GREATGRANARY', 'Grânar mare');
tz_def('GREATGRANARY_DESC', 'Grânarul mare are de 3 ori capacitatea unui grânar normal.<br>Această clădire poate fi construită doar în satele cu Minunea Lumii sau cu un artefact natar special');

tz_def('WONDER', 'Minunea Lumii');
tz_def('WORLD_WONDER', 'Minune Mondială');
tz_def('WONDER_DESC', 'O Minune a Lumii (cunoscută și ca WW) este pe cât de impresionantă sună. Fiecare nivel costă o mulțime de resurse. Este aproape imposibil ca un singur jucător să construiască o WW de unul singur. Motivul este că nu ai nevoie doar de multe resurse, ci și de trupe pentru a-ți proteja prețioasa clădire.<br>Pentru a construi WW ai nevoie de un Plan de Construcție Antic. Îl poți obține atacând un sat natar cu eroul tău. Trebuie să ai o trezorerie goală nivel 10 și eroul trebuie să supraviețuiască. Cu acel plan și o cantitate extrem de mare de resurse, poți începe minunea lumii.<br>Odată ce ajunge la nivelul 50, vei avea nevoie ca altcineva din alianța ta să aibă un al doilea plan de construcție activ. Nu poți face totul singur.<br>Finalizând o WW la nivelul 100, vei câștiga serverul Travian și acesta este sfârșitul lumii de joc.<br>Odată terminată, va apărea un mesaj care arată cine a câștigat și statisticile. Nu mai poți construi, dar poți trimite mesaje până la restartarea serverului');
tz_def('WORLD_WONDER_CHANGE_NAME', 'Ai nevoie de Minunea Lumii nivel 1 pentru a-i putea schimba numele');
tz_def('WORLD_WONDER_NAME', 'Nume Minune Mondială');
tz_def('WORLD_WONDER_NOTCHANGE_NAME', 'Nu poți schimba numele Minunii Lumii după nivelul 10');
tz_def('WORLD_WONDER_NAME_CHANGED', 'Nume schimbat');

tz_def('HORSEDRINKING', 'Adăpătoare pentru cai');
tz_def('HORSEDRINKING_DESC', 'Reduce timpul de antrenament și consumul cavaleriei. Poate fi construită și în satele romane cu Minunea Lumii.<br>Accelerează antrenamentul unităților de cavalerie cu 1% pe nivel și reduce consumul de grâu al unor unități în funcție de nivel.<br>Specific tribului: doar romanii');

tz_def('GREATWORKSHOP', 'Atelier mare');
tz_def('TRAINING_COMMENCE_GREATWORKSHOP', 'Antrenamentul poate începe când atelierul mare este finalizat.');
tz_def('GREATWORKSHOP_DESC', 'Atelierul mare îți permite să construiești un al doilea atelier în același sat, dar catapultele și berbecii costă de 3 ori mai mult.<br>Împreună cu atelierul normal, poți antrena trupele de două ori mai repede într-un sat');

tz_def('STONEWALL', 'Zid de Piatră');
tz_def('STONEWALL_DESC', 'Zidul de Piatră protejează satul împotriva atacurilor altor jucători. Construcția sa solidă oferă un bonus ridicat de apărare.<br>Specific tribului: doar Egipteni');

tz_def('MAKESHIFTWALL', 'Palisadă Improvizată');
tz_def('MAKESHIFTWALL_DESC', 'Palisada Improvizată oferă protecție de bază satului tău. Este ieftină și rapid de construit, dar oferă doar un bonus redus de apărare.<br>Specific tribului: doar Huni');

tz_def('COMMANDCENTER', 'Centru de Comandă');
tz_def('COMMANDCENTER_TRAIN_DESC', 'Ai nevoie de cel puțin nivelul 10 pentru a antrena coloniști și conducători în Centrul de Comandă.');
tz_def('COMMANDCENTER_CULTURE_DESC', 'Punctele de cultură determină câte sate poți fonda sau cuceri.');
tz_def('COMMANDCENTER_LOYALTY_DESC', 'Centrul de Comandă protejează satul împotriva conducătorilor inamici. Loialitate curentă:');
tz_def('COMMANDCENTER_DESC', 'Centrul de Comandă este sediul puterii unui sat hun. Permite antrenarea coloniștilor și conducătorilor și controlul expansiunii fără a fi nevoie de Reședință sau Palat.<br>Specific tribului: doar Huni');

tz_def('WATERWORKS', 'Apeduct');
tz_def('WATERWORKS_DESC', 'Apeductul mărește cu 5% pe nivel bonusul oferit de oazele anexate acestui sat.<br>Specific tribului: doar Egipteni');

tz_def('HOSPITAL', 'Spital');
tz_def('HOSPITAL_DESC', 'Spitalul îngrijește trupele rănite. O parte dintre unitățile pierdute în apărare sau atac pot fi vindecate aici în loc să fie pierdute definitiv. Nivelurile mai mari reduc timpul de vindecare.');

tz_def('DEFENSIVEWALL', 'Zid Defensiv');
tz_def('DEFENSIVEWALL_DESC', 'Zidul Defensiv protejează satul împotriva atacurilor altor jucători. Construit după tradiția marilor fortificații spartane, oferă un bonus puternic de apărare.<br>Specific tribului: doar Spartani');

tz_def('BIGHOSPITAL', 'Spital Mare');
tz_def('BIGHOSPITAL_DESC', 'Spitalul Mare este o versiune extinsă a Spitalului, permițând vindecarea unui număr și mai mare de trupe rănite după luptă. Nivelurile mai mari reduc timpul de vindecare.<br>Specific tribului: Spartani și Vechingi');

tz_def('BARRICADE', 'Baricadă');

tz_def('HEALING_TIME_NOW', 'Timp de vindecare curent');
tz_def('WOUNDED_TROOPS', 'Trupe rănite');
tz_def('NO_WOUNDED', 'Nu există trupe rănite în spital.');
tz_def('HEAL_BUTTON', 'Vindecă');
tz_def('HEAL_COST_HINT', 'Vindecarea costă 50% din costul de antrenare al unității.');
tz_def('HEALING_IN_PROGRESS', 'Vindecare în curs');

tz_def('MANUAL_UDESC_51', "Războinicul Hun reprezintă baza infanteriei hunilor. Ieftin și rapid de antrenat, este un soldat echilibrat, ideal pentru raidurile timpurii și apărarea de bază.");
tz_def('MANUAL_UDESC_52', "Cercetașul Călare spionează satele inamice cu o viteză impresionantă. Poate fi observat doar de alți cercetași și nu poartă arme pentru luptă.");
tz_def('MANUAL_UDESC_53', "Arcașul Călare atacă din șa cu săgeți mortale. Este un raider rapid, cu un echilibru excelent între puterea de atac și capacitatea de transport.");
tz_def('MANUAL_UDESC_54', "Călărețul Stepelor este un luptător agil al câmpiilor. Viteza sa îl face ideal pentru raiduri rapide asupra satelor neapărate.");
tz_def('MANUAL_UDESC_55', "Lăncierul Hun atacă cu o lance grea. Este o unitate de cavalerie ofensivă puternică, capabilă să țină piept și cavaleriei inamice.");
tz_def('MANUAL_UDESC_56', "Călărețul de Elită este mândria hoardei hunilor. Extrem de puternic în atac, distruge tot ce îi stă în cale, însă antrenarea sa este costisitoare.");
tz_def('MANUAL_UDESC_57', "Berbecul este o mașină grea de război folosită pentru distrugerea zidurilor inamice. Protejează-l bine, deoarece este lent și lipsit de apărare.");
tz_def('MANUAL_UDESC_58', "Catapulta aruncă bolovani la distanțe mari pentru a distruge clădirile și câmpurile inamice. Trebuie protejată de alte trupe.");
tz_def('MANUAL_UDESC_59', "Conducătorul Tribal reduce loialitatea satelor inamice prin prezența sa impunătoare până când acestea se alătură hoardei hunilor.");
tz_def('MANUAL_UDESC_60', "Coloniștii sunt supuși curajoși care pleacă pentru a întemeia un nou sat al hunilor. Sunt necesari trei, împreună cu proviziile.");

tz_def('MANUAL_UDESC_61', "Sclavul Înarmat este ieftin și rapid de antrenat. Individual este slab, dar în număr mare poate copleși apărarea cu costuri reduse.");
tz_def('MANUAL_UDESC_62', "Luptătorul Egiptean este un soldat solid al faraonului, util atât în atac, cât și în apărarea regatului.");
tz_def('MANUAL_UDESC_63', "Gardianul Templului protejează locurile sfinte ale Egiptului. Este o unitate defensivă excelentă împotriva infanteriei inamice.");
tz_def('MANUAL_UDESC_64', "Cercetașul Călare merge înaintea armatei pentru a spiona satele inamice. Doar cercetașii inamici îl pot vedea sau opri.");
tz_def('MANUAL_UDESC_65', "Carul de Luptă străbate câmpul de luptă doborând infanteria. Este o unitate de cavalerie defensivă puternică a armatei egiptene.");
tz_def('MANUAL_UDESC_66', "Carul Regal transportă elita armatei egiptene. Devastator în atac și simbol al puterii faraonului.");
tz_def('MANUAL_UDESC_67', "Berbecul este o mașină grea de război folosită pentru distrugerea zidurilor inamice. Protejează-l bine, deoarece este lent și lipsit de apărare.");
tz_def('MANUAL_UDESC_68', "Catapulta aruncă bolovani la distanțe mari pentru a distruge clădirile și câmpurile inamice. Trebuie protejată de alte trupe.");
tz_def('MANUAL_UDESC_69', "Nomarhul convinge satele inamice prin daruri și discursuri, reducându-le loialitatea până când se alătură imperiului egiptean.");
tz_def('MANUAL_UDESC_70', "Coloniștii sunt supuși curajoși care pleacă pentru a întemeia un nou sat al Egiptului. Sunt necesari trei, împreună cu proviziile.");

tz_def('MANUAL_UDESC_71', "Hoplitul Spartan luptă în celebra falangă. Este un excelent soldat de infanterie, puternic atât în atac, cât și în apărare.");
tz_def('MANUAL_UDESC_72', "Războinicul Agoge a fost crescut pentru război încă din copilărie. Este un apărător ieftin și rezistent al Spartei.");
tz_def('MANUAL_UDESC_73', "Homoioi sunt cetățenii deplini ai Spartei. Infanterie grea cu o putere de atac impresionantă.");
tz_def('MANUAL_UDESC_74', "Cercetașul Perioikos urmărește mișcările inamicului pentru Sparta. Doar cercetașii inamici îl pot vedea sau opri.");
tz_def('MANUAL_UDESC_75', "Călărețul Spartan patrulează granițele Lacedemoniei. Este o unitate rapidă de cavalerie cu valori echilibrate.");
tz_def('MANUAL_UDESC_76', "Hippeis sunt garda regală a regilor Spartei. Cavalerie de elită care excelează în atac.");
tz_def('MANUAL_UDESC_77', "Berbecul este o mașină grea de război folosită pentru distrugerea zidurilor inamice. Protejează-l bine, deoarece este lent și lipsit de apărare.");
tz_def('MANUAL_UDESC_78', "Catapulta aruncă bolovani la distanțe mari pentru a distruge clădirile și câmpurile inamice. Trebuie protejată de alte trupe.");
tz_def('MANUAL_UDESC_79', "Eforul vorbește cu autoritatea Spartei, reducând loialitatea satelor inamice până când acestea se supun.");
tz_def('MANUAL_UDESC_80', "Coloniștii sunt supuși curajoși care pleacă pentru a întemeia un nou sat al Spartei. Sunt necesari trei, împreună cu proviziile.");

tz_def('MANUAL_UDESC_81', "Jefuitorul Viking trăiește pentru pradă. Este rapid de antrenat și întotdeauna pregătit pentru următorul raid.");
tz_def('MANUAL_UDESC_82', "Cercetașul Viking pătrunde neobservat în teritoriile inamice pentru a aduna informații. Doar cercetașii inamici îl pot captura.");
tz_def('MANUAL_UDESC_83', "Toporașul mânuiește un topor uriaș cu o forță brutală. Este o unitate ofensivă puternică a Nordului.");
tz_def('MANUAL_UDESC_84', "Berserkerul luptă într-o furie necontrolată, fără teamă de durere sau moarte. Devastator în atac, dar slab în apărare.");
tz_def('MANUAL_UDESC_85', "Călărețul Viking îmbină rezistența nordică cu viteza calului. Este o unitate versatilă de cavalerie.");
tz_def('MANUAL_UDESC_86', "Huscarlul este garda de corp credincioasă a Jarlului. Cavalerie grea de elită, temută pe toate mările.");
tz_def('MANUAL_UDESC_87', "Berbecul este o mașină grea de război folosită pentru distrugerea zidurilor inamice. Protejează-l bine, deoarece este lent și lipsit de apărare.");
tz_def('MANUAL_UDESC_88', "Catapulta aruncă bolovani la distanțe mari pentru a distruge clădirile și câmpurile inamice. Trebuie protejată de alte trupe.");
tz_def('MANUAL_UDESC_89', "Jarlul supune satele inamice voinței sale, reducându-le loialitatea până când jură credință Nordului.");
tz_def('MANUAL_UDESC_90', "Coloniștii sunt supuși curajoși care pleacă pentru a întemeia un nou sat al vikingilor. Sunt necesari trei, împreună cu proviziile.");

tz_def('HEALING_TIME_LEVEL', 'Timp de vindecare la nivelul');
tz_def('BARRICADE_DESC', 'Baricada protejează satul împotriva atacurilor altor jucători. Construcția sa stratificată din lemn oferă un bonus solid de apărare.<br>Specific tribului: doar Vechingi');

tz_def('BUILDING_MAX_LEVEL_UNDER', 'Clădire la nivel maxim în construcție');
tz_def('BUILDING_BEING_DEMOLISHED', 'Clădire în curs de demolare');
tz_def('COSTS_UPGRADING_LEVEL', 'Costuri</b> pentru upgrade la nivelul');
tz_def('WORKERS_ALREADY_WORK', 'Muncitorii sunt deja la lucru.');
tz_def('CONSTRUCTING_MASTER_BUILDER', 'Construiește cu meșter constructor ');
tz_def('COSTS', 'Costuri');
tz_def('WORKERS_ALREADY_WORK_WAITING', 'Muncitorii sunt deja la lucru. (în așteptare)');
tz_def('ENOUGH_FOOD_EXPAND_CROPLAND', 'Nu este suficientă hrană. Extinde lanul de grâu.');
tz_def('UPGRADE_WAREHOUSE', 'Îmbunătățește magazia');
tz_def('UPGRADE_GRANARY', 'Îmbunătățește grânarul');
tz_def('YOUR_CROP_NEGATIVE', 'Producția ta de grâu este negativă, nu vei obține niciodată resursele necesare.');
tz_def('UPGRADE_LEVEL', 'Upgrade la nivelul ');
tz_def('WAITING', '(în așteptare)');
tz_def('NEED_WWCONSTRUCTION_PLAN', 'Ai nevoie de plan de construcție WW');
tz_def('NEED_MORE_WWCONSTRUCTION_PLAN', 'Ai nevoie de mai multe planuri de construcție WW');
tz_def('CONSTRUCT_NEW_BUILDING', 'Construiește clădire nouă');
tz_def('SHOWSOON_AVAILABLE_BUILDINGS', 'arată clădirile disponibile în curând');
tz_def('HIDESOON_AVAILABLE_BUILDINGS', 'ascunde clădirile disponibile în curând');

// gold plus
tz_def('GOLD_SHOP', 'Magazin Aur');
tz_def('PACKAGE_A', 'Pachet A');
tz_def('PACKAGE_B', 'Pachet B');
tz_def('PACKAGE_C', 'Pachet C');
tz_def('PACKAGE_D', 'Pachet D');
tz_def('PACKAGE_E', 'Pachet E');
tz_def('PAYMENT_METHOD', 'Metodă de plată');
tz_def('PACKAGES_NOT_REFUND', 'Niciun pachet nu este rambursabil');
tz_def('PLUS_FUNC', 'Funcție Plus');
tz_def('REMAINING', 'Rămas');
tz_def('MINS', 'min');
tz_def('ACTIVATE', 'Activează');
tz_def('TOO_LITTLE_GOLD', 'Prea puțin aur');
tz_def('GOLD_ON', 'Activat');
tz_def('PLUS_END', 'Avantajul tău PLUS s-a încheiat');
tz_def('NPC', 'NPC');
tz_def('NO_GOLD', 'Momentan nu deții aur');
tz_def('GOLD_CLUB', 'Gold Club');
tz_def('NOW', 'acum');
tz_def('NPC_TRADE_GOLD', 'Comerț cu negustorul NPC');
tz_def('COMPLETE_CONSTRUCTION_R_GOLD', 'Finalizează construcțiile și cercetările din acest sat acum (nu funcționează pentru Palat și Reședință)');
tz_def('FOR_GAME_SERVER', 'Întreaga rundă de joc');
tz_def('HAVE_NO_INVITED', 'Nu ai adus încă niciun jucător nou');
tz_def('INVITE_FRIENDS_GOLD', 'Invită prieteni și primește Aur gratuit');
tz_def('NEED_MORE_GOLD', 'Ai nevoie de mai mult aur');
tz_def('ADD_PLUS_FAIL', 'Încercare Plus eșuată');
tz_def('ADD_BONUS_LUMBER_FAIL', 'Încercare lemn eșuată');
tz_def('ADD_BONUS_CLAY_FAIL', 'Încercare argilă eșuată');
tz_def('ADD_BONUS_IRON_FAIL', 'Încercare fier eșuată');
tz_def('ADD_BONUS_CROP_FAIL', 'Încercare grâu eșuată');
tz_def('SELECT_GOLD_OPTION', 'Te rugăm selectează opțiunea pe care vrei să o activezi sau extinzi');
tz_def('GET_NOW', 'Obține acum');
tz_def('BUY_NOW', 'Cumpără acum');
tz_def('SELECT_REWARD', 'Selectează recompensa');
tz_def('VIP_ACCOUNT', 'Cont VIP');
tz_def('USER_NOT_EXISTS', 'Numele de cont introdus nu există');
tz_def('STATUS_UPDATED', 'Statusul tău a fost actualizat');

// profile
tz_def('PREFERENCES', 'Preferințe');
tz_def('VACATION', 'Vacanță');
tz_def('ACTIVATE_VACATION', 'Vrei să activezi Modul Vacanță');
tz_def('GRAPH_PACK', 'Pachet grafic');
tz_def('PLAYER_PROFILE', 'Profil jucător');
tz_def('CHANGE_PASSWORD', 'Schimbă parola');
tz_def('OLD_PASSWORD', 'Parolă veche');
tz_def('NEW_PASSWORD', 'Parolă nouă');
tz_def('CHANGE_EMAIL', 'Schimbă email');
tz_def('CHANGE_EMAIL2', 'Introdu adresa veche și cea nouă de email. Vei primi un cod pe ambele adrese pe care trebuie să-l introduci aici');
tz_def('CURRENT_EMAIL', 'Email actual');
tz_def('OLD_EMAIL', 'Email vechi');
tz_def('NEW_EMAIL', 'Email nou');
tz_def('ACCOUNT_SITTERS', 'Sitteri cont');
tz_def('ACCOUNT_SITTERS2', 'Un sitter se poate conecta la contul tău folosind numele tău și parola lui/ei. Poți avea până la doi sitteri');
tz_def('SITTER_NAME', 'Numele sitterului');
tz_def('NO_SITTERS', 'Nu ai sitteri');
tz_def('RM_SITTER', 'Elimină sitter');
tz_def('YOU_ARE_SITTER', 'Ai fost adăugat ca sitter la următoarele conturi. Poți anula dând click pe X-ul roșu');
tz_def('DELETE_ACCOUNT', 'Șterge cont');
tz_def('DELETE_ACCOUNT2', 'Poți șterge contul aici. După inițierea anulării, durează trei zile pentru finalizare. Poți anula procesul în primele 24 de ore');
tz_def('YES', 'Da');
tz_def('NO', 'Nu');
tz_def('CONFIRM_W_PASS', 'Confirmă cu parola');
tz_def('MEDALS', 'Medalii');
tz_def('PLAYER_HAS', 'Acest jucător are');
tz_def('HOURS_OF_BG_PROT', 'ore de protecție începători rămase');
tz_def('PLAYER_WAS_REG_ON', 'Acest jucător și-a înregistrat contul pe');
tz_def('NATARS_ACC', 'Cont oficial Natari');
tz_def('WW_V_M', 'Sat oficial Minunea Lumii');
tz_def('ROMAN_T_M', 'Romanii: Datorită nivelului ridicat de dezvoltare socială și tehnologică, romanii sunt maeștri în construcție și coordonare. De asemenea, trupele lor fac parte din elita din Travian. Sunt foarte echilibrați și utili atât în atac cât și în apărare');
tz_def('TEUTON_T_M', 'Teutonii: Teutonii sunt cel mai agresiv trib. Trupele lor sunt notorii și temute pentru furia și frenezia lor la atac. Se mișcă ca o hoardă de jefuitori, fără frică de moarte');
tz_def('GAUL_T_M', 'Galii: Galii sunt cel mai pașnic trib dintre cele trei din Travian. Trupele lor sunt antrenate pentru o apărare excelentă, dar abilitatea lor de atac poate concura cu celelalte două triburi. Galii sunt călăreți înnăscuți și caii lor sunt faimoși pentru viteză. Asta înseamnă că pot lovi inamicul exact unde provoacă cel mai mult rău și rapid');
tz_def('ADMIN_M', 'Administrator oficial server');
tz_def('MH_M', 'Multihunter global oficial server');
tz_def('MH_M2', 'Multihunter este o poziție oficială Travian folosită în principal pentru aplicarea regulilor pe server. Toți Multihunterii folosesc contul numit Multihunter cu singurul sat la (0|0). Un Multihunter nu poate juca pe serverul unde este Multihunter, dar poate fi jucător activ pe alte servere');
tz_def('NATURE_M2', 'Trupele naturii sunt animalele care trăiesc în oazele neocupate. Poți folosi simulatorul de luptă pentru a vedea dacă ai suficiente trupe să învingi animalele dintr-o oază pe care vrei să o cucerești, dar amintește-ți că poți doar face raid pe oaze. Ține minte că toate animalele peste Urs pot ucide într-o luptă 1 la 1 trupa de nivel maxim contemporană din Travian');
tz_def('TASKMASTER_M', 'Cont Maestru de sarcini');
tz_def('VETERAN_P', 'Jucător veteran');
tz_def('VETERAN_3_M', 'Medalie obținută pentru 3 ani de joc Travian');
tz_def('VETERAN_5_M', 'Medalie obținută pentru 5 ani de joc Travian');
tz_def('VETERAN_10_M', 'Medalie obținută pentru 10 ani de joc Travian');
tz_def('ATT_W_M', 'Atacatorii săptămânii');
tz_def('DEF_W_M', 'Apărătorii săptămânii');
tz_def('POP_W_M', 'Crescători de populație ai săptămânii');
tz_def('ROB_W_M', 'Jefuitorii săptămânii');
tz_def('CLIMB_W_M', 'Urcători în clasament ai săptămânii');
tz_def('ATT_DEF_10_W_M', 'Primirea acestei medalii arată că ai fost în top 10 atât la Atacatori cât și la Apărători ai săptămânii');
tz_def('ATT_3_W_M', 'Primirea acestei medalii arată că ai fost în top 3 Atacatori ai săptămânii');
tz_def('DEF_3_W_M', 'Primirea acestei medalii arată că ai fost în top 3 Apărători ai săptămânii');
tz_def('POP_3_W_M', 'Primirea acestei medalii arată că ai fost în top 3 Crescători de populație ai săptămânii');
tz_def('ROB_3_W_M', 'Primirea acestei medalii arată că ai fost în top 3 Jefuitori ai săptămânii');
tz_def('CLIMB_3_W_M', 'Primirea acestei medalii arată că ai fost în top 3 Urcători în clasament ai săptămânii');
tz_def('ATT_10_W_M', 'Primirea acestei medalii arată că ai fost în top 10 Atacatori ai săptămânii');
tz_def('DEF_10_W_M', 'Primirea acestei medalii arată că ai fost în top 10 Apărători ai săptămânii');
tz_def('POP_10_W_M', 'Primirea acestei medalii arată că ai fost în top 10 Crescători de populație ai săptămânii');
tz_def('ROB_10_W_M', 'Primirea acestei medalii arată că ai fost în top 10 Jefuitori ai săptămânii');
tz_def('CLIMB_10_W_M', 'Primirea acestei medalii arată că ai fost în top 10 Urcători în clasament ai săptămânii');
tz_def('RECEIVED_IN_W', 'Primită în săptămâna');
tz_def('POINTS_M', 'Puncte');
tz_def('RANKS', 'Clasamente');
tz_def('WEEK', 'Săptămână');
tz_def('CATEGORY', 'Categorie');
tz_def('RANK', 'Loc');
tz_def('BB_CODE', 'Cod BB');
tz_def('IN_ROW', 'la rând');
tz_def('ADMIN1', 'Administrator');
tz_def('MULTIH1', 'Multihunter');
tz_def('PLAYER_ADMIN', 'Acest jucător este Admin');
tz_def('PLAYER_MH', 'Acest jucător este Multihunter');
tz_def('PLAYER_BANNED', 'Acest jucător este BLOCAT');
tz_def('PLAYER_VACATION', 'Acest jucător este în VACANȚĂ');
if(!defined('BANNED')) define('BANNED', 'Blocat');
tz_def('GENDER', 'Gen');
tz_def('GENDER0', 'n/d');
tz_def('MALE0', 'm');
tz_def('MALE', 'Masculin');
tz_def('FEMALE0', 'f');
tz_def('FEMALE', 'Feminin');
tz_def('LOCATION', 'Locație');
tz_def('DIRECT_LINKS', 'Linkuri directe');
tz_def('NUMBER0', 'Nr');
tz_def('LINK_NAME', 'Nume link');
tz_def('LINK_TARGET', 'Țintă link');
tz_def('TZ_LINK_GENERATOR', 'Generator de link-uri de joc');
tz_def('TZ_LINK_GENERATOR_DESC', 'Construiește un link după tipul clădirii, nu după locația din sat, deci funcționează în orice sat indiferent unde e construită clădirea acolo. Copiază rezultatul de mai jos în câmpul Țintă link.');
tz_def('TZ_TAB_OPTIONAL', 'Tab (opțional)');
tz_def('TZ_GENERATED_LINK', 'Link generat');
tz_def('AUTO_COMPL', 'Autocompletare');
tz_def('AUTO_COMPL2', 'Folosit pentru punct de adunare și piață');
tz_def('OWN_VILLAGES', 'satele proprii');
tz_def('VILLAGES_NEAR', 'sate din împrejurimi');
tz_def('VILLAGES_ALLI_PLAYERS', 'sate de la jucători din alianță');
tz_def('REPORT_FILTER', 'Filtru rapoarte');
tz_def('NO_REPORTS_TO_OWN', 'Fără rapoarte pentru transferuri către satele proprii');
tz_def('NO_REPORTS_TO_OTH', 'Fără rapoarte pentru transferuri către sate străine');
tz_def('NO_REPORTS_FROM_OTH', 'Fără rapoarte pentru transferuri din sate străine');
tz_def('CHANGE_PROFILE', 'Schimbă profil');
tz_def('WRITE_MESSAGE', 'Scrie mesaj');
tz_def('REPORT_PLAYER', 'Raportează jucător');
tz_def('ARTEFACT1', 'Artefact');
tz_def('WoW1', 'ML');
tz_def('VILLAGE_NAME', 'Nume sat');
tz_def('BDAY', 'Zi de naștere');
tz_def('CONDITIONS', 'Condiții');
tz_def('TIME_PREF', 'Preferințe oră');
tz_def('TIME_ZONES_DESC', 'Aici poți schimba ora afișată în Travian pentru a se potrivi fusului tău orar');
tz_def('TIME_ZONE_L1', 'Europa');
tz_def('TIME_ZONE_L2', 'UK');
tz_def('TIME_ZONE_L3', 'Turcia');
tz_def('TIME_ZONE_L4', 'Asia/Kolkata');
tz_def('TIME_ZONE_L5', 'Asia/Bangkok');
tz_def('TIME_ZONE_L6', 'SUA/New York');
tz_def('TIME_ZONE_L7', 'SUA/Chicago');
tz_def('TIME_ZONE_L8', 'Noua Zeelandă');
tz_def('MONTH1', 'Ian');
tz_def('MONTH2', 'Feb');
tz_def('MONTH3', 'Mar');
tz_def('MONTH4', 'Apr');
tz_def('MONTH5', 'Mai');
tz_def('MONTH6', 'Iun');
tz_def('MONTH7', 'Iul');
tz_def('MONTH8', 'Aug');
tz_def('MONTH9', 'Sep');
tz_def('MONTH10', 'Oct');
tz_def('MONTH11', 'Noi');
tz_def('MONTH12', 'Dec');

//artefact
tz_def('ARCHITECTS_DESC', 'Toate clădirile din zona de efect sunt mai puternice. Asta înseamnă că vei avea nevoie de mai multe catapulte pentru a avaria clădirile protejate de puterea acestui artefact.');
tz_def('ARCHITECTS_SMALL', 'Micul secret al arhitectului');
tz_def('ARCHITECTS_SMALLVILLAGE', 'Daltă de diamant');
tz_def('ARCHITECTS_LARGE', 'Marele secret al arhitectului');
tz_def('ARCHITECTS_LARGEVILLAGE', 'Ciocan uriaș de marmură');
tz_def('ARCHITECTS_UNIQUE', 'Secretul unic al arhitectului');
tz_def('ARCHITECTS_UNIQUEVILLAGE', 'Pergamentele lui Hemon');
tz_def('HASTE_DESC', 'Toate trupele din zona de efect se mișcă mai repede.');
tz_def('HASTE_SMALL', 'Cizmele ușoare ale titanului');
tz_def('HASTE_SMALLVILLAGE', 'Potcoavă de opal');
tz_def('HASTE_LARGE', 'Cizmele mari ale titanului');
tz_def('HASTE_LARGEVILLAGE', 'Car de aur');
tz_def('HASTE_UNIQUE', 'Cizmele unice ale titanului');
tz_def('HASTE_UNIQUEVILLAGE', 'Sandalele lui Pheidippides');
tz_def('EYESIGHT_DESC', 'Toți spionii (Cercetași, Potecari și Equites Legati) își cresc abilitatea de spionaj. În plus, cu toate versiunile acestui artefact poți vedea TIPUL trupelor care vin, dar nu și câte sunt.');
tz_def('EYESIGHT_SMALL', 'Ochii ușori ai vulturului');
tz_def('EYESIGHT_SMALLVILLAGE', 'Povestea unui șobolan');
tz_def('EYESIGHT_LARGE', 'Ochii mari ai vulturului');
tz_def('EYESIGHT_LARGEVILLAGE', 'Scrisoarea generalului');
tz_def('EYESIGHT_UNIQUE', 'Ochii unici ai vulturului');
tz_def('EYESIGHT_UNIQUEVILLAGE', 'Jurnalul lui Sun Tzu');
tz_def('DIET_DESC', 'Toate trupele din raza artefactului consumă mai puțin grâu, făcând posibilă întreținerea unei armate mai mari.');
tz_def('DIET_SMALL', 'Control ușor al dietei');
tz_def('DIET_SMALLVILLAGE', 'Platou de argint');
tz_def('DIET_LARGE', 'Control mare al dietei');
tz_def('DIET_LARGEVILLAGE', 'Arcul sacru de vânătoare');
tz_def('DIET_UNIQUE', 'Control unic al dietei');
tz_def('DIET_UNIQUEVILLAGE', 'Potirul Regelui Arthur');
tz_def('ACADEMIC_DESC', 'Trupele sunt antrenate cu un anumit procent mai repede în raza artefactului.');
tz_def('ACADEMIC_SMALL', 'Talentul ușor al antrenorului');
tz_def('ACADEMIC_SMALLVILLAGE', 'Jurământul soldatului scris');
tz_def('ACADEMIC_LARGE', 'Talentul mare al antrenorului');
tz_def('ACADEMIC_LARGEVILLAGE', 'Declarație de război');
tz_def('ACADEMIC_UNIQUE', 'Talentul unic al antrenorului');
tz_def('ACADEMIC_UNIQUEVILLAGE', 'Memoriile lui Alexandru cel Mare');
tz_def('STORAGE_DESC', 'Cu acest plan de construcție poți construi Grânar Mare sau Magazie Mare în satul cu artefactul, sau pe tot contul în funcție de artefact. Atâta timp cât deții acel artefact poți construi și extinde acele clădiri.');
tz_def('STORAGE_SMALL', 'Plan mic de depozitare');
tz_def('STORAGE_SMALLVILLAGE', 'Schița constructorului');
tz_def('STORAGE_LARGE', 'Plan mare de depozitare');
tz_def('STORAGE_LARGEVILLAGE', 'Tăbliță babiloniană');
tz_def('CONFUSION_DESC', 'Capacitatea ascunzătorii este crescută cu o anumită valoare pentru fiecare tip de artefact. Catapultele pot lovi doar aleatoriu satele din raza acestui artefact. Excepții sunt WW care poate fi mereu țintită și camera comorilor care poate fi mereu țintită, cu excepția artefactului unic. Când țintești un câmp de resursă, doar câmpuri aleatorii pot fi lovite, când țintești o clădire, doar clădiri aleatorii pot fi lovite.');
tz_def('CONFUSION_SMALL', 'Confuzia ușoară a rivalilor');
tz_def('CONFUSION_SMALLVILLAGE', 'Harta cavernelor ascunse');
tz_def('CONFUSION_LARGE', 'Confuzia mare a rivalilor');
tz_def('CONFUSION_LARGEVILLAGE', 'Traistă fără fund');
tz_def('CONFUSION_UNIQUE', 'Confuzia unică a rivalilor');
tz_def('CONFUSION_UNIQUEVILLAGE', 'Calul troian');
tz_def('FOOL_DESC', 'La fiecare 24 de ore primește un efect aleatoriu, bonus sau penalizare (toate sunt posibile cu excepția planurilor pentru magazie mare, grânar mare și WW). Își schimbă efectul ȘI raza la fiecare 24 de ore. Artefactul unic va avea mereu bonusuri pozitive.');
tz_def('FOOL_SMALL', 'Artefactul prostului mic');
tz_def('FOOL_SMALLVILLAGE', 'Pandantivul ștrengăriei');
tz_def('FOOL_UNIQUE', 'Artefactul prostului unic');
tz_def('FOOL_UNIQUEVILLAGE', 'Manuscris interzis');
tz_def('WWVILLAGE', 'Sat WW');
tz_def('ARTEFACT', '<h1><b>Artefactele Natarilor</b></h1>

Zvonuri șoptite răsună prin sate, împărtășind legende spuse doar de cei mai buni povestitori. Se referă la NATARI, cei mai temuți războinici din lumea TRAVIAN. Uciderea lor este visul oricărui erou, scopul oricărui luptător. Nimeni nu știe cum au obținut NATARII o asemenea putere, iar războinicii lor sunt atât de cruzi. Hotărâți să descopere sursa puterii NATARILOR, luptătorii trimit un grup de spioni de elită să-i urmărească. Nu trec multe ore și se întorc cu frică în ochi, balansând teorii fantastice: se pare că puterea natarilor vine din obiectele misterioase pe care le numesc artefacte, pe care le-au furat de la strămoșii noștri. Încearcă să furi artefactele de la ei, și vei putea controla puterea lor.

<img src="/img/x.gif" class="ArtefactsAnnouncement">

A venit timpul să revendici artefactele. Colaborează cu alianța ta și adu-ți războinicii pentru a obține aceste obiecte râvnite. Totuși, NATARII nu vor renunța la artefacte fără luptă... nici dușmanii tăi. Dacă reușești să recuperezi artefactele și să respingi inamicii, vei putea culege recompensele. Clădirile tale vor deveni incredibil de puternice, iar trupele vor fi mult mai rapide și vor consuma mai puțină hrană. Capturează artefactele, adu glorie imperiului tău și devino o nouă legendă pentru urmașii tăi.

Pentru a fura unul, trebuie să se întâmple următoarele:

1. Trebuie să ataci satul (NU Raid!).
2. Trebuie să CÂȘTIGI atacul.
3. Trebuie să distrugi trezoreria.
4. Trebuie să deții o trezorerie goală nivel 10 pentru ARTEFACTE MICI și nivel 20 pentru ARTEFACT MARE trebuie să fie în satul de unde a plecat atacul.
5. Asigură-te ca ai un erou în atac.

Dacă nu, următorul atac asupra acelui sat, câștigat cu un erou și trezorerie goală, va lua artefactul.

Pentru a construi o Minune a Lumii, trebuie să deții tu însuți un plan (tu = proprietarul satului WW) de la nivelul 0 la 50, de la 51 la 100 ai nevoie de un plan suplimentar în alianța ta! Două planuri în contul satului WW nu vor funcționa!

Planurile de construcție pot fi cucerite imediat ce apar pe server.

Va exista un cronometru în joc, care arată timpul exact al lansării, cu '.(5 / SPEED).' zile înainte de apariție.');

//WW Village Release Message
tz_def('WWVILLAGEMSG', '<h1><b>Satele Minunea Lumii</b></h1>

Au trecut nenumărate zile de la primele bătălii de pe zidurile satelor blestemate ale înfricoșătorilor Natari, multe armate atât ale celor liberi cât și ale imperiului natar s-au luptat și au murit în fața zidurilor multor fortărețe de unde Natarii au condus cândva toată creația. Acum, cu praful așezat și o relativă liniște instalată, armatele au început să-și numere pierderile și să-și adune morții, mirosul luptei încă plutind în aerul nopții, un miros de măcel de neuitat prin amploare și brutalitate, dar care în curând va fi umbrit de altele. Cele mai mari armate ale celor liberi și ale înfricoșătorilor Natari se pregăteau pentru încă un asalt reînnoit asupra râvnitelor foste fortărețe ale Imperiului Natar.
Curând au sosit cercetași povestind despre o priveliște impresionantă și o amintire înfiorătoare, o armată de temut de o mărime de neînchipuit fusese văzută adunându-se la capătul lumii, capitala natară, o forță atât de mare și de neoprit încât praful marșului lor ar sufoca toată lumina, o forță atât de brutală și nemiloasă încât ar zdrobi orice speranță. Oamenii liberi știau că trebuie să alerge acum, să alerge contra timpului și hoardelor nesfârșite ale Imperiului Natar pentru a ridica o Minune a Lumii care să readucă pacea și să învingă amenințarea natară.
Dar ridicarea unei asemenea Minuni nu ar fi o sarcină ușoară, ar fi nevoie de planuri de construcție create în trecutul îndepărtat, planuri de o natură atât de arcana încât nici cei mai înțelepți nu le cunoșteau conținutul sau locațiile.
Zeci de mii de cercetași au cutreierat toată existența căutând în zadar aceste planuri mistice, căutând peste tot mai puțin în temuta Capitală Natară, dar nu le-au găsit. Astăzi însă, se întorc cu vești bune, se întorc aducând locațiile planurilor, ascunse de armatele Natarilor în fortărețe secrete construite pentru a fi ascunse de ochii oamenilor.
Acum începe ultima etapă, când cele mai mari armate ale Oamenilor Liberi și ale Natarilor se vor ciocni în toată lumea pentru soarta a tot ce se află sub ceruri. Acesta este războiul care va răsuna peste eoni, acesta este războiul tău, și aici îți vei grava numele în istorie, aici vei deveni legendă.

<img src="/img/x.gif" class="WWVillagesAnnouncement" title="'.WWVILLAGE.'" alt="'.WWVILLAGE.'">

Pentru a cuceri unul, trebuie să se întâmple următoarele:

1. Trebuie să ataci satul (NU Raid!).
2. Trebuie să  CÂȘTIGI atacul.
3. Trebuie să distrugi REȘEDINȚA.
4. Trebuie să scazi loialitatea la 0 cu: SENATORI, CĂPETENIE, ȘEF.
5. Trebuie să ai suficiente puncte culturale pentru a cuceri satul.

Dacă nu, următorul atac asupra acelui sat, câștigat cu SENATORI, CĂPETENIE, ȘEF și sloturi libere în REȘEDINȚĂ/PALAT va lua satul.

Pentru a construi o Minune a Lumii, trebuie să deții tu însuți un plan (tu = proprietarul satului WW) de la nivelul 0 la 50, de la 51 la 100 ai nevoie de un plan suplimentar în alianța ta! Două planuri în contul satului WW nu vor funcționa!

Planurile de construcție pot fi cucerite imediat ce apar pe server.

Va exista un cronometru în joc, care arată timpul exact al lansării, cu '.(5 / SPEED).' zile înainte de apariție.');

//Building Plans
tz_def('WILL_SPAWN_IN', 'va apărea în');
tz_def('PLAN', 'Plan de Construcție Antic');
tz_def('PLANVILLAGE', 'Plan construcție WW');
tz_def('PLAN_DESC', 'Cu acest plan de construcție antic vei putea construi Minunea Lumii până la nivelul 50. Pentru a construi mai departe, alianța ta trebuie să dețină cel puțin două planuri.');
tz_def('PLAN_INFO', '<h1><b>Planurile de Construcție ale Minunii Lumii</b></h1>

Cu multe luni în urmă triburile din Travian au fost surprinse de întoarcerea neașteptată a Natarilor. Acest trib din timpuri imemoriale, care îi depășește pe toți în înțelepciune, putere și glorie, era pe cale să tulbure din nou pe cei liberi. Astfel și-au pus toate eforturile în pregătirea unui ultim război împotriva Natarilor și în înfrângerea lor pentru totdeauna. Mulți s-au gândit la așa-numitele "Minuni ale Lumii", o construcție din multe legende, ca singura soluție. Se spunea că odată finalizată ar face pe oricine invincibil. În cele din urmă făcând constructorii conducători și cuceritori ai întregului Travian cunoscut.

Totuși, se spunea și că ai avea nevoie de planuri de construcție pentru a construi o astfel de clădire. Din acest motiv, arhitecții au conceput planuri viclene despre cum să le păstreze în siguranță. După o vreme, se puteau vedea clădiri asemănătoare templelor în multe orașe și metropole - Camerele Comorilor (Trezoreriile).

Din păcate, nimeni - nici măcar cei înțelepți și versați - nu știa unde să găsească aceste planuri de construcție. Cu cât oamenii încercau mai mult să le localizeze, cu atât părea că sunt doar legende.

Astăzi, însă, acest ultim secret va fi dezvăluit. Lipsurile și eforturile trecutului nu vor fi fost în zadar, căci astăzi cercetașii mai multor triburi au obținut cu succes locațiile planurilor de construcție. Bine păzite de Natari, ele zac ascunse în mai multe oaze ce pot fi găsite în tot Travianul. Doar cei mai viteji eroi vor putea asigura un astfel de plan și îl vor aduce acasă în siguranță pentru ca construcția să înceapă.

În cele din urmă, vom vedea dacă triburile libere din Travian pot din nou să-i depășească pe Natari și să-i învingă odată pentru totdeauna. Nu fi atât de prost încât să presupui că Natarii vor pleca fără luptă, totuși!

<img src="/img/x.gif" class="WWBuildingPlansAnnouncement" title="'.PLAN.'" alt="'.PLAN.'">

Pentru a fura un set de Planuri de Construcție de la Natari, trebuie să se întâmple următoarele:

1. Trebuie să ataci satul (NU Raid!).
2. Trebuie să  CÂȘTIGI atacul.
3. Trebuie să DISTRUGI Camera Comorilor (Trezoreria).
4. EROUL TĂU TREBUIE să fie în acel atac, deoarece doar el poate transporta Planurile de Construcție.
5. O Cameră a Comorilor (Trezorerie) goală nivel 10 TREBUIE să fie în satul de unde a plecat atacul.

NOTĂ: Dacă criteriile de mai sus nu sunt îndeplinite în timpul atacului, următorul atac asupra acelui sat care îndeplinește criteriile va lua Planurile de Construcție.

Pentru a construi o Cameră a Comorilor (Trezorerie), vei avea nevoie de Clădire Principală nivel 10 și satul NU TREBUIE să conțină o Minune a Lumii.

Pentru a construi o Minune a Lumii, trebuie să deții Planurile de Construcție tu însuți (tu = Proprietarul Satului Minunea Lumii) de la nivelul 0 la 50, iar apoi de la nivelul 51 la 100 vei avea nevoie de un set suplimentar de Planuri de Construcție în Alianța ta! Două seturi de Planuri de Construcție în contul Satului Minunea Lumii nu vor funcționa!');

//Admin setting - Admin/Templates/config.tpl & editServerSet.tpl
tz_def('EDIT_BACK', 'Înapoi');
tz_def('SERV_CONFIG', 'Configurare Server');
tz_def('SERV_SETT', 'Setări Server');
tz_def('EDIT_SERV_SETT', 'Editează Setările Serverului');
tz_def('SERV_VARIABLE', 'Variabilă');
tz_def('SERV_VALUE', 'Valoare');
tz_def('CONF_SERV_NAME', 'Nume Server');
tz_def('CONF_SERV_NAME_TOOLTIP', 'Numele serverului de joc.');
tz_def('CONF_SERV_STARTED', 'Server Pornit');
tz_def('CONF_SERV_STARTED_TOOLTIP', 'Momentul când serverul de joc a fost pornit. Acest parametru nu poate fi schimbat pe serverul deja instalat.');
tz_def('CONF_SERV_TIMEZONE', 'Fus Orar Server');
tz_def('CONF_SERV_TIMEZONE_TOOLTIP', 'Fusul orar al serverului de joc.');
tz_def('CONF_SERV_LANG', 'Limbă');
tz_def('CONF_SERV_LANG_TOOLTIP', 'Limba folosită în panoul de admin și pentru toți pe server în mod implicit.');
tz_def('CONF_SERV_SERVSPEED', 'Viteză Server');
tz_def('CONF_SERV_SERVSPEED_TOOLTIP', 'Viteza serverului de joc. Cu cât viteza este mai mare, cu atât clădirile se construiesc mai repede, studiile și îmbunătățirile în fierării se fac mai rapid, trupele se antrenează mai repede și productivitatea tuturor resurselor crește.');
tz_def('CONF_SERV_TROOPSPEED', 'Viteză Trupe');
tz_def('CONF_SERV_TROOPSPEED_TOOLTIP', 'Viteza de deplasare a trupelor pe server. Cu cât indicatorul este mai mare, cu atât trupele se mișcă mai repede pe hartă.');
tz_def('CONF_SERV_EVASIONSPEED', 'Viteză Evitare');
tz_def('CONF_SERV_EVASIONSPEED_TOOLTIP', 'Viteza de evitare este timpul petrecut de trupe pe drum pentru a se întoarce acasă după evitarea unui atac.');
tz_def('CONF_SERV_STORMULTIPLER', 'Multiplicator Depozitare');
tz_def('CONF_SERV_STORMULTIPLER_TOOLTIP', 'Un multiplicator pentru capacitatea magaziei și grânarului. Valoarea 1 este egală cu capacitatea de 80.000 din fiecare resursă la nivel maxim. Dacă setezi valoarea la 2, capacitatea la nivel maxim va fi 160.000 din fiecare resursă.<br><b>Notă:</b> cantitatea de resurse generată de oazele neocupate pentru jaf depinde de această valoare. Implicit este 800. Dacă setezi valoarea la 2, numărul maxim pentru fiecare resursă generată este 1600.');
tz_def('CONF_SERV_TRADCAPACITY', 'Capacitate Negustor');
tz_def('CONF_SERV_TRADCAPACITY_TOOLTIP', 'Un multiplicator pentru capacitatea de resurse transportată de un negustor. Valoarea 1 este 500 pentru romani, 750 pentru gali, 1000 pentru teutoni. Dacă setezi valoarea la 2, capacitatea se dublează corespunzător, 1000, 1500, 2000.');
tz_def('CONF_SERV_CRANCAPACITY', 'Capacitate Ascunzătoare');
tz_def('CONF_SERV_CRANCAPACITY_TOOLTIP', 'Un multiplicator pentru capacitatea resurselor din ascunzătoare, care pot fi salvate de la jaf. Valoarea 1 este 1000 pentru romani și teutoni, 2000 pentru gali. Dacă setezi valoarea la 2, capacitatea se dublează la 2000 și respectiv 4000.');
tz_def('CONF_SERV_TRAPCAPACITY', 'Capacitate Capcană');
tz_def('CONF_SERV_TRAPCAPACITY_TOOLTIP', 'Un multiplicator pentru capacitatea capcanei galilor, care poate captura soldați inamici înainte de atac. Valoarea 1 este 400 la nivelul 20. Dacă setezi valoarea la 2, capacitatea va fi 800.');
tz_def('CONF_SERV_NATUNITSMULTIPLIER', 'Multiplicator Unități Natari');
tz_def('CONF_SERV_NATUNITSMULTIPLIER_TOOLTIP', 'Acest parametru este responsabil pentru numărul trupelor natarilor, pe artefacte și sate WW.');
tz_def('CONF_SERV_NATARS_SPAWN_TIME', 'Apariție Natari');
tz_def('CONF_SERV_NATARS_SPAWN_TIME_TOOLTIP', 'După câte zile de la startul serverului vor apărea Natarii și artefactele');
tz_def('CONF_SERV_NATARS_WW_SPAWN_TIME', 'Apariție Minuni ale Lumii');
tz_def('CONF_SERV_NATARS_WW_SPAWN_TIME_TOOLTIP', 'După câte zile de la start vor apărea satele WW');
tz_def('CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME', 'Apariție Planuri WW');
tz_def('CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME_TOOLTIP', 'După câte zile de la start vor apărea planurile WW');
tz_def('CONF_SERV_MAPSIZE', 'Dimensiune Hartă');
tz_def('CONF_SERV_MAPSIZE_TOOLTIP', 'Dimensiunea hărții lumii de joc. Nu poate fi schimbată pe un server deja instalat.');
tz_def('CONF_SERV_VILLEXPSPEED', 'Viteză Expansiune Sate');
tz_def('CONF_SERV_VILLEXPSPEED_TOOLTIP', 'Viteza care afectează expansiunea imperiului. Cu viteză lentă sunt necesare mai multe puncte culturale pentru a fonda un sat nou, cu viteză rapidă numărul necesar scade.');
tz_def('CONF_SERV_BEGINPROTECT', 'Protecție Începători');
tz_def('CONF_SERV_BEGINPROTECT_TOOLTIP', 'Protecție care interzice pentru o perioadă atacarea satelor jucătorilor noi.');
tz_def('CONF_SERV_REGOPEN', 'Înregistrare Deschisă');
tz_def('CONF_SERV_REGOPEN_TOOLTIP', 'Permite activarea (True) sau dezactivarea (False) înregistrării jucătorilor pe server.');
tz_def('CONF_SERV_ACTIVMAIL', 'Mail Activare');
tz_def('CONF_SERV_ACTIVMAIL_TOOLTIP', 'Dacă este activat (Da), la înregistrare va fi necesară confirmarea adresei de email. Dacă este dezactivat (Nu) nu necesită confirmare.');
tz_def('CONF_SERV_QUEST', 'Quest');
tz_def('CONF_SERV_QUEST_TOOLTIP', 'Activează (Da) sau dezactivează (Nu) questul pe server.');
tz_def('CONF_SERV_QTYPE', 'Tip Quest');
tz_def('CONF_SERV_QTYPE_TOOLTIP', 'Tipul de quest poate fi oficial, care este mai scurt, și extins, care este mai lung.');
tz_def('CONF_SERV_DLR', 'Demolare - Nivel necesar');
tz_def('CONF_SERV_DLR_TOOLTIP', 'Nivelul necesar al clădirii principale pentru a putea demola clădiri în sat.');
tz_def('CONF_SERV_WWSTATS', 'Minunea Lumii - Statistici');
tz_def('CONF_SERV_WWSTATS_TOOLTIP', 'Activează (True) sau dezactivează (False) afișarea în statistici a satelor cu Minunea Lumii.');
tz_def('CONF_SERV_NTRTIME', 'Timp Regenerare Trupe Natură');
tz_def('CONF_SERV_NTRTIME_TOOLTIP', 'Timpul după care trupele naturii se regenerează în oaze.');
tz_def('CONF_SERV_OASIS_WOOD_PROD_MULT', 'Multiplicator Producție Lemn Oază');
tz_def('CONF_SERV_OASIS_WOOD_PROD_MULT_TOOLTIP', 'Producția de bază lemn din oază');
tz_def('CONF_SERV_OASIS_CLAY_PROD_MULT', 'Multiplicator Producție Argilă Oază');
tz_def('CONF_SERV_OASIS_CLAY_PROD_MULT_TOOLTIP', 'Producția de bază argilă din oază');
tz_def('CONF_SERV_OASIS_IRON_PROD_MULT', 'Multiplicator Producție Fier Oază');
tz_def('CONF_SERV_OASIS_IRON_PROD_MULT_TOOLTIP', 'Producția de bază fier din oază');
tz_def('CONF_SERV_OASIS_CROP_PROD_MULT', 'Multiplicator Producție Grâu Oază');
tz_def('CONF_SERV_OASIS_CROP_PROD_MULT_TOOLTIP', 'Producția de bază grâu din oază');
tz_def('CONF_SERV_MEDALINTERVAL', 'Interval Medalii');
tz_def('CONF_SERV_MEDALINTERVAL_TOOLTIP', 'Intervalul de timp pentru acordarea medaliilor pentru top jucători și alianțe. Dacă parametrul este schimbat, intervalul se modifică după următoarea acordare.');
tz_def('CONF_SERV_TOURNTHRES', 'Prag Piață Turnir');
tz_def('CONF_SERV_TOURNTHRES_TOOLTIP', 'Numărul de căsuțe pe hartă după care Piața Turnirului începe să funcționeze.');
tz_def('CONF_SERV_GWORKSHOP', 'Atelier Mare');
tz_def('CONF_SERV_GWORKSHOP_TOOLTIP', 'Activează (True) sau dezactivează (False) folosirea Atelierului Mare în joc.');
tz_def('CONF_SERV_NATARSTAT', 'Arată Natarii în Statistici');
tz_def('CONF_SERV_NATARSTAT_TOOLTIP', 'Activează (True) sau dezactivează (False) afișarea contului Natarilor în statistici.');
tz_def('CONF_SERV_PEACESYST', 'Sistem Pace');
tz_def('CONF_SERV_PEACESYST_TOOLTIP', 'Activează sau dezactivează sistemul de pace. Când este activ, jucătorii pot ataca dar în rapoarte va apărea o inscripție de felicitare. Trupele nu vor muri de foame.');
tz_def('CONF_SERV_GRAPHICPACK', 'Pachet Grafic');
tz_def('CONF_SERV_GRAPHICPACK_TOOLTIP', 'Activează (Da) sau dezactivează (Nu) posibilitatea de a folosi pachetul grafic.');
tz_def('CONF_SERV_ERRORREPORT', 'Raportare Erori');
tz_def('CONF_SERV_ERRORREPORT_TOOLTIP', 'Activează (Da) sau dezactivează (Nu) afișarea rapoartelor de eroare pe server.');

//Admin setting - Admin/Templates/config.tpl & editPlusSet.tpl
tz_def('PLUS_LOGO', '<b><font color="#71D000">P</font><font color="#FF6F0F">l</font><font color="#71D000">u</font><font color="#FF6F0F">s</font></b>');
tz_def('PLUS_CONFIGURATION', PLUS_LOGO.' Configurare');
tz_def('PLUS_SETT', PLUS_LOGO.' Setări');
tz_def('EDIT_PLUS_SETT', 'Editează Setarea '.PLUS_LOGO);
tz_def('EDIT_PLUS_SETT1', 'Editează Setarea PLUS');
tz_def('CONF_PLUS_PAYPALEMAIL', '<a href="https://www.paypal.com" target="_blank">PayPal</a> Adresă E-Mail');
tz_def('CONF_PLUS_PAYPALEMAIL_TOOLTIP', 'Adresa de email specificată la înregistrarea pe PayPal.<br><font color="red"><b>Trebuie să fie cont Business sau Premier!</b></font>');
tz_def('CONF_PLUS_CURRENCY', 'Monedă Plată');
tz_def('CONF_PLUS_CURRENCY_TOOLTIP', 'Moneda folosită pentru plată.');
tz_def('CONF_PLUS_PACKAGEGOLDA', 'Pachet &#34;A&#34; Cantitate Aur');
tz_def('CONF_PLUS_PACKAGEGOLDA_TOOLTIP', 'Cantitatea de aur acordată pentru plata pachetului &#34;A&#34;.');
tz_def('CONF_PLUS_PACKAGEPRICEA', 'Pachet &#34;A&#34; Preț');
tz_def('CONF_PLUS_PACKAGEPRICEA_TOOLTIP', 'Suma necesară pentru plata pachetului &#34;A&#34;.');
tz_def('CONF_PLUS_PACKAGEGOLDB', 'Pachet &#34;B&#34; Cantitate Aur');
tz_def('CONF_PLUS_PACKAGEGOLDB_TOOLTIP', 'Cantitatea de aur acordată pentru plata pachetului &#34;B&#34;.');
tz_def('CONF_PLUS_PACKAGEPRICEB', 'Pachet &#34;B&#34; Preț');
tz_def('CONF_PLUS_PACKAGEPRICEB_TOOLTIP', 'Suma necesară pentru plata pachetului &#34;B&#34;.');
tz_def('CONF_PLUS_PACKAGEGOLDC', 'Pachet &#34;C&#34; Cantitate Aur');
tz_def('CONF_PLUS_PACKAGEGOLDC_TOOLTIP', 'Cantitatea de aur acordată pentru plata pachetului &#34;C&#34;.');
tz_def('CONF_PLUS_PACKAGEPRICEC', 'Pachet &#34;C&#34; Preț');
tz_def('CONF_PLUS_PACKAGEPRICEC_TOOLTIP', 'Suma necesară pentru plata pachetului &#34;C&#34;.');
tz_def('CONF_PLUS_PACKAGEGOLDD', 'Pachet &#34;D&#34; Cantitate Aur');
tz_def('CONF_PLUS_PACKAGEGOLDD_TOOLTIP', 'Cantitatea de aur acordată pentru plata pachetului &#34;D&#34;.');
tz_def('CONF_PLUS_PACKAGEPRICED', 'Pachet &#34;D&#34; Preț');
tz_def('CONF_PLUS_PACKAGEPRICED_TOOLTIP', 'Suma necesară pentru plata pachetului &#34;D&#34;.');
tz_def('CONF_PLUS_PACKAGEGOLDE', 'Pachet &#34;E&#34; Cantitate Aur');
tz_def('CONF_PLUS_PACKAGEGOLDE_TOOLTIP', 'Cantitatea de aur acordată pentru plata pachetului &#34;E&#34;.');
tz_def('CONF_PLUS_PACKAGEPRICEE', 'Pachet &#34;E&#34; Preț');
tz_def('CONF_PLUS_PACKAGEPRICEE_TOOLTIP', 'Suma necesară pentru plata pachetului &#34;E&#34;.');
tz_def('CONF_PLUS_ACCDURATION', PLUS_LOGO.' durată cont');
tz_def('CONF_PLUS_ACCDURATION_TOOLTIP', 'Durata funcției de joc '.PLUS_LOGO.' pentru cont la activarea de către jucător.');
tz_def('CONF_PLUS_PRODUCTDURATION', '+25% durată producție');
tz_def('CONF_PLUS_PRODUCTDURATION_TOOLTIP', 'Durata funcției de joc +25% producție pentru cont la activarea de către jucător.');

//Admin setting - Admin/Templates/config.tpl & editLogSet.tpl
tz_def('LOG_SETT', 'Setări Loguri');
tz_def('EDIT_LOG_SETT', 'Editează Setarea Log');
tz_def('CONF_LOG_BUILD', 'Log Construcții');
tz_def('CONF_LOG_BUILD_TOOLTIP', 'Activează (Da) sau dezactivează (Nu) afișarea logurilor pentru construcția clădirilor în sat.');
tz_def('CONF_LOG_TECHNOLOGY', 'Log Tehnologie');
tz_def('CONF_LOG_TECHNOLOGY_TOOLTIP', 'Activează (Da) sau dezactivează (Nu) afișarea logurilor pentru îmbunătățirea trupelor în Fierărie și Atelier armuri.');
tz_def('CONF_LOG_LOGIN', 'Log Autentificări');
tz_def('CONF_LOG_LOGIN_TOOLTIP', 'Activează (Da) sau dezactivează (Nu) afișarea logurilor de autentificare ale jucătorilor.');
tz_def('CONF_LOG_GOLD', 'Log Aur');
tz_def('CONF_LOG_GOLD_TOOLTIP', 'Activează (Da) sau dezactivează (Nu) afișarea logurilor de utilizare a aurului de către jucători.');
tz_def('CONF_LOG_ADMIN', 'Log Admin');
tz_def('CONF_LOG_ADMIN_TOOLTIP', 'Activează (Da) sau dezactivează (Nu) afișarea logurilor pentru acțiunile administratorului în panou.');
tz_def('CONF_LOG_WAR', 'Log Război');
tz_def('CONF_LOG_WAR_TOOLTIP', 'Activează (Da) sau dezactivează (Nu) afișarea logurilor de atacuri asupra jucătorilor.');
tz_def('CONF_LOG_MARKET', 'Log Piață');
tz_def('CONF_LOG_MARKET_TOOLTIP', 'Activează (Da) sau dezactivează (Nu) afișarea logurilor de utilizare a pieței de către jucători.');
tz_def('CONF_LOG_ILLEGAL', 'Log Ilegal');
tz_def('CONF_LOG_ILLEGAL_TOOLTIP', 'Activează (Da) sau dezactivează (Nu) afișarea logurilor ilegale. (Nu știu exact ce este)');

//Admin setting - Admin/Templates/config.tpl & editNewsboxSet.tpl
tz_def('NEWSBOX_SETT', 'Setări Newsbox');
tz_def('EDIT_NEWSBOX_SETT', 'Editează Setarea Newsbox');
tz_def('EDIT_NEWSBOX1', 'Newsbox 1');
tz_def('EDIT_NEWSBOX1_TOOLTIP', 'Activează sau dezactivează afișarea Newsbox 1. Afișat pe pagina de autentificare și pe paginile jocului.');
tz_def('EDIT_NEWSBOX2', 'Newsbox 2');
tz_def('EDIT_NEWSBOX2_TOOLTIP', 'Activează sau dezactivează afișarea Newsbox 2. Afișat pe pagina de autentificare și pe paginile jocului.');
tz_def('EDIT_NEWSBOX3', 'Newsbox 3');
tz_def('EDIT_NEWSBOX3_TOOLTIP', 'Activează sau dezactivează afișarea Newsbox 3. Afișat pe pagina de autentificare și pe paginile jocului.');

//Admin setting - Admin/Templates/config.tpl SQL Settings
tz_def('SQL_SETTINGS', 'Setări SQL');
tz_def('CONF_SQL_HOSTNAME', 'Hostname');
tz_def('CONF_SQL_HOSTNAME_TOOLTIP', 'Numele serverului unde rulează MySQL (implicit: localhost).');
tz_def('CONF_SQL_PORT', 'Port');
tz_def('CONF_SQL_PORT_TOOLTIP', 'Portul MySQL pentru conexiune la distanță. Portul standard este: 3306.');
tz_def('CONF_SQL_DBUSER', 'Utilizator DB');
tz_def('CONF_SQL_DBUSER_TOOLTIP', 'Numele de utilizator pentru conectarea la baza de date.');
tz_def('CONF_SQL_DBPASS', 'Parolă DB');
tz_def('CONF_SQL_DBPASS_TOOLTIP', 'Parola utilizatorului pentru conectarea la baza de date.');
tz_def('CONF_SQL_DBNAME', 'Nume DB');
tz_def('CONF_SQL_DBNAME_TOOLTIP', 'Numele bazei de date la care te conectezi.');
tz_def('CONF_SQL_TBPREFIX', 'Prefix Tabele');
tz_def('CONF_SQL_TBPREFIX_TOOLTIP', 'Prefixul folosit pentru tabelele bazei de date.');
tz_def('CONF_SQL_DBTYPE', 'Tip DB');
tz_def('CONF_SQL_DBTYPE_TOOLTIP', 'Tipul bazei de date folosite.');

//Admin setting - Admin/Templates/config.tpl & editExtraSet.tpl
tz_def('EXTRA_SETT', 'Setări Extra');
tz_def('EDIT_EXTRA_SETT', 'Editează Setările Extra');
tz_def('CONF_EXTRA_LIMITMAIL', 'Limitează Căsuța Poștală');
tz_def('CONF_EXTRA_LIMITMAIL_TOOLTIP', 'Activează (Da) sau dezactivează (Nu) limita căsuței poștale.');
tz_def('CONF_EXTRA_MAXMAIL', 'Număr maxim mesaje');
tz_def('CONF_EXTRA_MAXMAIL_TOOLTIP', 'Numărul maxim de mesaje care pot încăpea în căsuța poștală.');

//Admin setting - Admin/Templates/config.tpl & editAdminInfo.tpl
tz_def('ADMIN_INFO', 'Informații Admin');
tz_def('EDIT_ADMIN_INFO', 'Editează Informațiile Admin');
tz_def('CONF_ADMIN_NAME', 'Nume Admin');
tz_def('CONF_ADMIN_NAME_TOOLTIP', 'Numele pentru contul de administrator.');
tz_def('CONF_ADMIN_EMAIL', 'E-Mail Admin');
tz_def('CONF_ADMIN_EMAIL_TOOLTIP', 'Adresa de email pentru contul de administrator.');
tz_def('CONF_ADMIN_SHOWSTATS', 'Include Admin în Statistici');
tz_def('CONF_ADMIN_SHOWSTATS_TOOLTIP', 'Activează (True) sau dezactivează (False) afișarea contului de administrator în statisticile generale.');
tz_def('CONF_ADMIN_SUPPMESS', 'Include Mesaje Suport');
tz_def('CONF_ADMIN_SUPPMESS_TOOLTIP', 'Activează (True) sau dezactivează (False) trimiterea mesajelor către căsuța administratorului adresate Suportului.');
tz_def('CONF_ADMIN_RAIDATT', 'Permite Jefuire și Atacare');
tz_def('CONF_ADMIN_RAIDATT_TOOLTIP', 'Activează (True) sau dezactivează (False) posibilitatea de a jefui și ataca administratorul.');

/*
|--------------------------------------------------------------------------
| Index
|--------------------------------------------------------------------------
*/

$lang['index'][0][1] = 'Bine ai venit pe '.SERVER_NAME;
$lang['index'][0][2] = 'Manual';
$lang['index'][0][3] = 'Joacă acum, gratuit!';
$lang['index'][0][4] = 'Ce este '.SERVER_NAME;
$lang['index'][0][5] = SERVER_NAME.' este un <b>joc de browser</b> cu o lume antică captivantă alături de mii de alți jucători reali.</p><p>Este <strong>gratuit</strong> și <strong>nu necesită descărcări</strong>.';
$lang['index'][0][6] = 'Click aici pentru a juca '.SERVER_NAME;
$lang['index'][0][7] = 'Total jucători';
$lang['index'][0][8] = 'Jucători activi';
$lang['index'][0][9] = 'Jucători online';
$lang['index'][0][10] = 'Despre joc';
$lang['index'][0][11] = 'Vei începe ca șef al unui mic sat și vei porni într-o aventură captivantă.';
$lang['index'][0][12] = 'Construiește sate, poartă războaie sau stabilește rute comerciale cu vecinii tăi.';
$lang['index'][0][13] = 'Joacă alături și împotriva a mii de alți jucători reali și cucerește lumea Travian.';
$lang['index'][0][14] = 'Noutăți';
$lang['index'][0][15] = 'Întrebări frecvente';
$lang['index'][0][16] = 'Capturi ecran';
$lang['forum'] = 'Forum';
$lang['register'] = 'Înregistrare';
$lang['login'] = 'Autentificare';
$lang['screenshots']['title1'] = 'Sat';
$lang['screenshots']['desc1'] = 'Construcție sat';
$lang['screenshots']['title2'] = 'Resursă';
$lang['screenshots']['desc2'] = 'Resursele satului sunt lemn, argilă, fier și grâu';
$lang['screenshots']['title3'] = 'Hartă';
$lang['screenshots']['desc3'] = 'Localizarea satului tău pe hartă';
$lang['screenshots']['title4'] = 'Construiește Clădire';
$lang['screenshots']['desc4'] = 'Cum să construiești o clădire sau să crești nivelul unei resurse';
$lang['screenshots']['title5'] = 'Raport';
$lang['screenshots']['desc5'] = 'Raportul tău de atac';
$lang['screenshots']['title6'] = 'Statistici';
$lang['screenshots']['desc6'] = 'Vezi clasamentul tău în statistici';
$lang['screenshots']['title7'] = 'Arme sau economie';
$lang['screenshots']['desc7'] = 'Poți alege să joci militar sau economic';

// ===== i18n nouvelles constantes (etape 2) =====
tz_def('TZ_ACTIVATION_AVAILBLE_IN', 'Activare disponibilă în:');
tz_def('TZ_ACTIVATION_CODE', 'Cod de activare:');
tz_def('TZ_ADD', 'adaugă');
tz_def('TZ_ADD_2', 'Adaugă');
tz_def('TZ_ALLIANCE_ID', 'ID-ul alianței');
tz_def('TZ_ARRIVED', 'Sosit:');
tz_def('TZ_ASSIGN_TO_POSITION', 'Atribuie la poziție');
tz_def('TZ_AS_SOON_AS_A_PLAYER_YOU_INVITED_FO', 'De îndată ce un jucător invitat de tine își întemeiază');
tz_def('TZ_ATTACKS', 'Atacuri');
tz_def('TZ_OVERVIEW', 'Prezentare');
tz_def('TZ_FORUM', 'Forum');
tz_def('TZ_CHAT', 'Chat');
tz_def('TZ_NEWS', 'Noutăți');
tz_def('TZ_OPTIONS', 'Opțiuni');
tz_def('TZ_BOLD', 'îngroșat');
tz_def('TZ_BUILDING', 'Clădire');
tz_def('TZ_CATAPULT_TARGET', 'ținta catapultei');
tz_def('TZ_CLICK_TO_COPY', 'Click pentru a copia');
tz_def('TZ_CLIMBERS_OF_THE_WEEK', 'Ascensiunile săptămânii');
tz_def('TZ_CLOCK', 'Ceas');
tz_def('TZ_CONTINUE_WITH_THE_NEXT_TASK', 'Continuă cu sarcina următoare.');
tz_def('TZ_CREATE', 'Creează');
tz_def('TZ_CREATE_A_NEW_LIST', 'Creează o listă nouă');
tz_def('TZ_DESTINATION', 'Destinație:');
tz_def('TZ_DOES_NOT_EXIST', 'nu există.');
tz_def('TZ_DOWNLOAD', 'Descarcă');
tz_def('TZ_EVENT', 'Eveniment');
tz_def('TZ_FEATURES_OF_TRAVIAN', 'Caracteristicile Travian');
tz_def('TZ_FORUM_NAME', 'Numele forumului');
tz_def('TZ_FORWARD', 'înainte');
tz_def('TZ_GOLD', 'aur.');
tz_def('TZ_HERO_DEF_BONUS', 'Erou (bonus de apărare)');
tz_def('TZ_HERO_FIGHTING_STRENGTH', 'Erou (forță de luptă)');
tz_def('TZ_HERO_OFF_BONUS', 'Erou (bonus de atac)');
tz_def('TZ_HOUR', 'oră');
tz_def('TZ_HOW_IS_IT_DONE', 'Cum se face?');
tz_def('TZ_HRS', 'ore');
tz_def('TZ_HRS_2', 'ore');
tz_def('TZ_IF_YOU_GET_NEW_PLAYERS_TO_OPEN_AN', 'Dacă aduci jucători noi care își creează un cont și întemeiază un al doilea sat, vei primi');
tz_def('TZ_IN_YOUR_POST_BECAUSE_IT_CAN_CAUSE', 'în mesajul tău deoarece poate cauza probleme cu sistemul BBCode.');
tz_def('TZ_ITALIC', 'cursiv');
tz_def('TZ_LAST_TARGETS', 'Ultimele ținte:');
tz_def('TZ_LIST_NAME', 'Numele listei:');
tz_def('TZ_LOOK_FOR_YOUR_RANK_IN_THE_STATISTI', 'Caută-ți rangul în statistici și introdu-l aici.');
tz_def('TZ_MACEMAN', 'Măciucaș');
tz_def('TZ_MEMBERS', 'Membri');
tz_def('TZ_MEMBER_SINCE', 'Membru din');
tz_def('TZ_NAME', 'Nume:');
tz_def('TZ_NO', 'Nr.');
tz_def('TZ_NOT_CODED_YET', '(încă neimplementat)');
tz_def('TZ_NO_EMAIL_RECEIVED', 'Nu ai primit e-mailul?');
tz_def('TZ_N_15_GOLD', '15 aur');
tz_def('TZ_N_1_INVITE_YOUR_FRIENDS_VIA_EMAIL', '1) Invită-ți prietenii prin e-mail');
tz_def('TZ_N_20_GOLD', '20 aur');
tz_def('TZ_N_2_COPY_YOUR_PERSONAL_REF_LINK_AN', '2) Copiază-ți link-ul personal de recomandare și distribuie-l!');
tz_def('TZ_N_50_GOLD', '50 aur');
tz_def('TZ_OK_2', 'OK');
tz_def('TZ_OPEN_FORUM_FOR_THE_FOLLOWING_PLAYE', 'Forum deschis pentru următorii jucători');
tz_def('TZ_OPEN_FOR_MORE_ALLIANCES', 'Deschis pentru mai multe alianțe');
tz_def('TZ_ORDER', 'Ordine:');
tz_def('TZ_OTHER', 'Altele');
tz_def('TZ_OWNER', 'Proprietar:');
tz_def('TZ_PAY_SECURELY_WITH_PAYPAL', 'Plătește în siguranță cu PayPal.');
tz_def('TZ_PLAYERS_BROUGHT_IN', 'Jucători aduși');
tz_def('TZ_POST_NEW_THREAD', 'Postează un subiect nou');
tz_def('TZ_PREVIEW', 'Previzualizare');
tz_def('TZ_PREVIEW_2', 'previzualizare');
tz_def('TZ_PROGRESS_OF_YOUR_INVITED_FRIENDS', 'Progresul prietenilor invitați');
tz_def('TZ_QUIT_ALLIANCE', 'Părăsește alianța');
tz_def('TZ_REGISTER_FOR_THE_GAME', 'înregistrează-te la joc');
tz_def('TZ_REGISTRATION', 'înregistrare');
tz_def('TZ_SENT', 'Trimis:');
tz_def('TZ_SMILIES', 'Emoticoane');
tz_def('TZ_SMILIES_2', 'emoticoane');
tz_def('TZ_STONEMASON_S_LODGE', 'Atelierul pietrarului');
tz_def('TZ_TAG', 'Tag:');
tz_def('TZ_TARGET_VILLAGE', 'Satul țintă:');
tz_def('TZ_TASK_10_CRANNY', 'Sarcina 10: Ascunzătoare');
tz_def('TZ_TASK_11_TO_TWO', 'Sarcina 11: La doi.');
tz_def('TZ_TASK_12_INSTRUCTIONS', 'Sarcina 12: Instrucțiuni');
tz_def('TZ_TASK_13_MAIN_BUILDING', 'Sarcina 13: Clădirea principală');
tz_def('TZ_TASK_14_ADVANCED', 'Sarcina 14: Avansat!');
tz_def('TZ_TASK_16_ECONOMY', 'Sarcina 16: Economie');
tz_def('TZ_TASK_16_MILITARY', 'Sarcina 16: Militar');
tz_def('TZ_TASK_17_BARRACKS', 'Sarcina 17: Cazarmă');
tz_def('TZ_TASK_17_WAREHOUSE', 'Sarcina 17: Depozit');
tz_def('TZ_TASK_18_MARKETPLACE', 'Sarcina 18: Piață.');
tz_def('TZ_TASK_18_TRAIN', 'Sarcina 18: Antrenament.');
tz_def('TZ_TASK_19_EVERYTHING_TO_2', 'Sarcina 19: Totul la 2.');
tz_def('TZ_TASK_20_ALLIANCE', 'Sarcina 20: Alianță.');
tz_def('TZ_TASK_21_MAIN_BUILDING_TO_LEVEL_5', 'Sarcina 21: Clădirea principală la nivelul 5');
tz_def('TZ_TASK_22_GRANARY_TO_LEVEL_3', 'Sarcina 22: Hambar la nivelul 3.');
tz_def('TZ_TASK_23_WAREHOUSE_TO_LEVEL_7', 'Sarcina 23: Depozit la nivelul 7.');
tz_def('TZ_TASK_24_ALL_TO_FIVE', 'Sarcina 24: Totul la cinci!');
tz_def('TZ_TASK_25_PALACE_OR_RESIDENCE', 'Sarcina 25: Palat sau Reședință?');
tz_def('TZ_TASK_26_3_SETTLERS', 'Sarcina 26: 3 coloniști.');
tz_def('TZ_TASK_27_NEW_VILLAGE', 'Sarcina 27: Sat nou.');
tz_def('TZ_TASK_3_YOUR_VILLAGE_S_NAME', 'Sarcina 3: Numele satului tău');
tz_def('TZ_TASK_9_DOVE_OF_PEACE', 'Sarcina 9: Porumbelul păcii');
tz_def('TZ_TERMS', 'Termeni');
tz_def('TZ_THE_ALLIANCE', 'Alianța');
tz_def('TZ_THE_LARGEST_ALLIANCES', 'Cele mai mari alianțe');
tz_def('TZ_THE_USER', 'Utilizatorul');
tz_def('TZ_THREAD', 'Subiect');
tz_def('TZ_TOP_10', 'Top 10');
tz_def('TZ_TOTAL', 'Total');
tz_def('TZ_TOWNHALL', 'Primărie');
tz_def('TZ_TRAVIAN', 'Travian');
tz_def('TZ_TRAVIANX', 'TravianX');
tz_def('TZ_TRAVIANZ', 'TravianZ');
tz_def('TZ_TRAVIAN_GAMES', 'Travian Games');
tz_def('TZ_UNDERLINE', 'subliniere');
tz_def('TZ_UNDERLINED', 'subliniat');
tz_def('TZ_UNKNOWN', 'necunoscut');
tz_def('TZ_UNTIL_THE_NEXT_LEVEL', 'până la nivelul următor');
tz_def('TZ_USER_ID', 'ID utilizator');
tz_def('TZ_VILLAGE', 'Sat:');
tz_def('TZ_VILLAGE_OVERVIEW', 'Prezentarea satului');
tz_def('TZ_WAIT_INSTANT', 'Așteptare: imediat');
tz_def('TZ_WARNING', 'Atenție:');
tz_def('TZ_WOOD', 'Lemn');
tz_def('TZ_YOUR_PERSONAL_REF_LINK', 'Link-ul tău personal de recomandare:');
tz_def('TZ_YOU_CAN_T_USE_THE_VALUES', 'nu poți folosi valorile');
tz_def('TZ_YOU_HAVE_NOT_BROUGHT_IN_ANY_NEW_PL', 'Nu ai adus încă niciun jucător nou.');

// ===== i18n etape 2 (lot suivant) =====
tz_def('TZ_ACCOUNT_IS_ADMIN_OR_MH', 'Contul este Admin sau MH');
tz_def('TZ_ACCOUNT_IS_NOT_SCHEDULED_FOR_DELET', 'Contul nu este programat pentru ștergere');
tz_def('TZ_ACCOUNT_STATEMENT', 'Situația contului');
tz_def('TZ_ACTIVATE_VACATION_MODE', 'Activează modul vacanță');
tz_def('TZ_ADD_RAID', 'Adaugă raid');
tz_def('TZ_ADD_SLOT', 'Adaugă slot');
tz_def('TZ_ADVANTAGES', 'Avantaje');
tz_def('TZ_AFTER_PAYMENT_YOU_WILL_BE_CREDITED', 'După plată vei fi creditat automat.');
tz_def('TZ_AGRESOR', 'Agresor');
tz_def('TZ_ALLIANCE_DIPLOMACY', 'Diplomația alianței');
tz_def('TZ_ALLIANCE_EVENTS', 'Evenimentele alianței');
tz_def('TZ_ALLIANCE_FORUM', 'Forumul alianței');
tz_def('TZ_ALLIANCE_MEMBERS', 'membrii alianței.');
tz_def('TZ_ALLY_CHAT', 'Chat-ul alianței');
tz_def('TZ_AM', 'am');
tz_def('TZ_AND_LATER_YOUR_VILLAGE_COULD_LOOK', '...iar mai târziu satul tău ar putea arăta așa.');
tz_def('TZ_AND_QUIT_THE_ALLIANCE_AFTERWARDS', 'și părăsește alianța după aceea.');
tz_def('TZ_ASSIGN_RIGHTS', 'Atribuie drepturi');
tz_def('TZ_ATTENTION_USE_ONLY_TRUSTWORTHY_GRA', 'ATENȚIE! Folosește doar pachete grafice de încredere');
tz_def('TZ_AUTHOR', 'Autor');
tz_def('TZ_BEGINNERS_PROT', 'Prot. începători');
tz_def('TZ_BEST_PLAYER', 'Cel mai bun jucător');
tz_def('TZ_BUILDING_SITE', 'loc de construcție');
tz_def('TZ_BUILD_A_PALACE_OR_RESIDENCE_TO_LEV', 'Construiește un palat sau o reședință la nivelul 10.');
tz_def('TZ_BUILD_CROPPER', 'Construiește cropper');
tz_def('TZ_BUY_IT_IN_THE_GOLD_SHOP', 'Cumpără-l din magazinul de aur');
tz_def('TZ_CELEBRATION_STILL_NEEDS', 'celebrarea mai are nevoie de:');
tz_def('TZ_CENTRE', 'Centru:');
tz_def('TZ_CHANGE_NAME', 'Schimbă numele');
tz_def('TZ_CHANGE_YOUR_VILLAGE_S_NAME_TO_SOME', 'Schimbă numele satului tău în ceva frumos.');
tz_def('TZ_CHINESE', 'Chineză');
tz_def('TZ_CLAY_25_5_GOLD', 'Lut +25% (5 aur)');
tz_def('TZ_CLOSED_FORUM', 'Forum închis');
tz_def('TZ_CLOSE_ADRESSBOOK', 'închide agenda');
tz_def('TZ_COMBAT_SIMULATOR', 'Simulator de luptă');
tz_def('TZ_COMPLETE_DEMOLITION_10', 'Demolare completă (10');
tz_def('TZ_CONFEDERATION_FORUM', 'Forum de confederație');
tz_def('TZ_CONFIRM_WITH_PASSWORD', 'Confirmă cu parola:');
tz_def('TZ_CONSTRUCT_A_CRANNY', 'Construiește o ascunzătoare.');
tz_def('TZ_CONSTRUCT_A_GRANARY', 'Construiește un hambar.');
tz_def('TZ_CONSTRUCT_A_RALLY_POINT', 'Construiește un punct de adunare.');
tz_def('TZ_CONSTRUCT_A_WOODCUTTER', 'Construiește un tăietor de lemne.');
tz_def('TZ_CONSTRUCT_BARRACKS', 'Construiește o cazarmă.');
tz_def('TZ_CONSTRUCT_WAREHOUSE', 'Construiește un depozit.');
tz_def('TZ_CP_DAY', 'PC/zi');
tz_def('TZ_CROP_25_5_GOLD', 'Grâne +25% (5 aur)');
tz_def('TZ_DATE_AND_TIME', 'Data și ora');
tz_def('TZ_DEBUG_OFF', 'Jurnal debug OPRIT');
tz_def('TZ_DEBUG_ON', 'Jurnal debug PORNIT');
tz_def('TZ_DECLARE_WAR', 'declară război');
tz_def('TZ_DEFAULT', 'Implicit:');
tz_def('TZ_DELETE_ACCOUNT', 'Ștergi contul?');
tz_def('TZ_DIFFERENT_EMAIL_ADDRESS', 'altă adresă de e-mail');
tz_def('TZ_DOWNLOAD_FROM', 'Descarcă de la');
tz_def('TZ_DO_I_NEED_PLUS_TO_USE_OTHER_FEATUR', 'Am nevoie de Plus pentru a folosi alte funcții?');
tz_def('TZ_EARN_GOLD', 'Câștigă aur');
tz_def('TZ_EDIT_ANSWER', 'Editează răspunsul');
tz_def('TZ_EDIT_ANSWER_2', 'editează răspunsul');
tz_def('TZ_EDIT_FORUM', 'editează forumul');
tz_def('TZ_EDIT_SLOT', 'Editează slotul');
tz_def('TZ_EDIT_TOPIC', 'Editează subiectul');
tz_def('TZ_ENDS_ON', 'se termină pe');
tz_def('TZ_ENGLISH', 'Engleză');
tz_def('TZ_ENTER_HOW_MUCH_LUMBER_THE_BARRACKS', 'Introdu cât lemn costă cazarma');
tz_def('TZ_EU_DD_MM_YY_24H', 'UE (zz.ll.aa 24h)');
tz_def('TZ_EXAMPLE', 'Exemplu:');
tz_def('TZ_EXISTING_RELATIONSHIPS', 'Relații existente');
tz_def('TZ_EXTEND_ALL_RESOURCE_TILES_TO_LEVEL', 'Extinde toate câmpurile de resurse la nivelul 1.');
tz_def('TZ_EXTEND_ALL_RESOURCE_TILES_TO_LEVEL_2', 'Extinde toate câmpurile de resurse la nivelul 2.');
tz_def('TZ_EXTEND_ONE_CLAY_PIT', 'Extinde o groapă de lut.');
tz_def('TZ_EXTEND_ONE_CROPLAND', 'Extinde un câmp de grâne.');
tz_def('TZ_EXTEND_ONE_IRON_MINE', 'Extinde o mină de fier.');
tz_def('TZ_EXTEND_ONE_OF_EACH_RESOURCE_TILE_T', 'Extinde câte un câmp din fiecare resursă la nivelul 2.');
tz_def('TZ_EXTEND_YOUR_MAIN_BUILDING_TO_LEVEL', 'Extinde clădirea principală la nivelul 3.');
tz_def('TZ_FINISH', 'Termină');
tz_def('TZ_FOLLOWING_CAUSES_ARE_POSSIBLE', 'Următoarele cauze sunt posibile:');
tz_def('TZ_FOLLOW_THIS_LINK_TO', 'Urmează acest link pentru a');
tz_def('TZ_FOREIGN_OFFERS', 'Oferte străine');
tz_def('TZ_FORUM_TYPE', 'Tipul forumului');
tz_def('TZ_FOUND_A_NEW_VILLAGE', 'Întemeiază un sat nou.');
tz_def('TZ_FREE', 'GRATUIT!');
tz_def('TZ_FRENCH', 'Franceză');
tz_def('TZ_FRIEND_EMAIL_COM', 'friend@email.com');
tz_def('TZ_GAME_LANGUAGE', 'Limba jocului');
tz_def('TZ_GITHUB', 'Github');
tz_def('TZ_GRAPHIC_PACK_FOUND', 'Pachet grafic găsit.');
tz_def('TZ_GRAPHIC_PACK_SETTINGS', 'Setări pachet grafic');
tz_def('TZ_GREAT_STABLES', 'Grajduri Mari');
tz_def('TZ_HERE', 'aici');
tz_def('TZ_HERE_YOU_CAN_KICK_THE_PLAYERS_FROM', 'Aici poți da afară jucătorii din alianța ta.');
tz_def('TZ_HERE_YOU_FIND_YOUR_RESOURCE_FIELDS', 'Aici găsești câmpurile tale de resurse');
tz_def('TZ_HINT', 'Sfat');
tz_def('TZ_HOW_DO_I_GET_GOLD', 'Cum obțin aur?');
tz_def('TZ_INACTIVE_DURING_VACATION', 'Inactiv în timpul vacanței');
tz_def('TZ_INFORMATION_ON_HAPPENINGS_IN_YOUR', 'Informații despre ce se întâmplă în satul tău');
tz_def('TZ_INITIATE_PAYMENT_BY_PAYPAL', 'Inițiază plata prin PayPal');
tz_def('TZ_INVITATIONS', 'Invitații:');
tz_def('TZ_INVITE_A_PLAYER_INTO_THE_ALLIANCE', 'Invită un jucător în alianță');
tz_def('TZ_INVITE_BY_E_MAIL_OR_SHARE_YOUR_REF', 'Invită prin e-mail sau distribuie link-ul tău de recomandare.');
tz_def('TZ_IN_DESCRIPTION', 'în descriere.');
tz_def('TZ_IN_THE_VILLAGE_YOU_CAN_BUILD_BUILD', 'În sat poți construi clădiri');
tz_def('TZ_IRON_25_5_GOLD', 'Fier +25% (5 aur)');
tz_def('TZ_ISO_YY_MM_DD_24H', 'ISO (aa/ll/zz 24h)');
tz_def('TZ_ITALIAN', 'Italiană');
tz_def('TZ_SPANISH', 'Spaniolă');
tz_def('TZ_I_ACTIVATED_PLUS_BUT_PRODUCTION_DI', 'Am activat Plus, dar producția nu a crescut.');
tz_def('TZ_JOIN_AN_ALLIANCE', 'Alătură-te unei alianțe');
tz_def('TZ_JOIN_AN_ALLIANCE_OR_FOUND_ONE_ON_Y', 'Alătură-te unei alianțe sau întemeiază una proprie.');
tz_def('TZ_JUL', 'iul.');
tz_def('TZ_JUN', 'iun.');
tz_def('TZ_KICK_ALL_MEMBERS', 'dă afară toți membrii');
tz_def('TZ_KICK_PLAYER', 'Dă afară jucătorul:');
tz_def('TZ_LANGUAGE_SETTINGS', 'Setări de limbă');
tz_def('TZ_LAST_POST', 'Ultimul mesaj');
tz_def('TZ_LAST_RAID', 'Ultimul raid');
tz_def('TZ_LINKS', 'Linkuri:');
tz_def('TZ_LINK_TO_THE_FORUM', 'Link către forum');
tz_def('TZ_LOG_IN', 'autentificare');
tz_def('TZ_LUMBER_25_5_GOLD', 'Lemn +25% (5 aur)');
tz_def('TZ_MAINTENANCE_OFF', 'Mentenanță OPRITĂ');
tz_def('TZ_MAINTENANCE_ON', 'Mentenanță PORNITĂ');
tz_def('TZ_MAJOR_CHANGES', 'Modificări majore:');
tz_def('TZ_MAP_2', 'Hartă:');
tz_def('TZ_MAXIMUM_VACATION', 'Vacanță maximă:');
tz_def('TZ_MESSAGES', 'Mesaje:');
tz_def('TZ_MESSAGE_3', 'Mesaj');
tz_def('TZ_MILITARY_EVENTS', 'Evenimente militare');
tz_def('TZ_MINIMUM_VACATION', 'Vacanță minimă:');
tz_def('TZ_MINOR_CHANGES', 'Modificări minore:');
tz_def('TZ_MISCELLANEOUS', 'Diverse');
tz_def('TZ_MORE_GRAPHIC_PACKS', 'Mai multe pachete grafice');
tz_def('TZ_MORE_INFO', 'Mai multe informații:');
tz_def('TZ_MOVE_TOPIC', 'Mută subiectul');
tz_def('TZ_MULTIHUNTER', 'Multihunter:');
tz_def('TZ_NEW_FORUM', 'Forum nou');
tz_def('TZ_NONE_OF_THE_PACKAGES_ARE_REFUNDABL', 'Niciun pachet nu este rambursabil!');
tz_def('TZ_NOT_ENOUGH_RESOURCE', 'Resurse insuficiente');
tz_def('TZ_NO_MARKETPLACE_ACTIVITY', 'Fără activitate pe piață');
tz_def('TZ_NO_OWNERSHIP_OF_AN_ARTIFACT_VILLAG', 'Fără deținerea unui sat cu artefact');
tz_def('TZ_NO_OWNERSHIP_OF_A_WONDER_OF_THE_WO', 'Fără deținerea unui sat Minunea Lumii');
tz_def('TZ_NO_REINFORCING_TROOPS_SENT_RECEIVE', 'Fără trupe de întărire trimise/primite');
tz_def('TZ_NO_REPORTS_FOR_TRANSFERS_FROM_FORE', 'Fără rapoarte pentru transferuri din sate străine.');
tz_def('TZ_NO_REPORTS_FOR_TRANSFERS_TO_FOREIG', 'Fără rapoarte pentru transferuri către sate străine.');
tz_def('TZ_NO_REPORTS_FOR_TRANSFERS_TO_OWN_VI', 'Fără rapoarte pentru transferuri către satele proprii.');
tz_def('TZ_N_14_DAYS', '14 zile');
tz_def('TZ_N_1_1_TRADE_WITH_THE_NPC_MERCHANT', 'Schimb 1:1 cu negustorul NPC');
tz_def('TZ_N_1_5_YOUR_VILLAGE', '(1/5) Satul tău');
tz_def('TZ_N_1_CHOOSE_A_RESOURCE_FIELD', '1. Alege un câmp de resurse');
tz_def('TZ_N_1_CHOOSE_BUILDING_SITE', '1. Alege un loc de construcție');
tz_def('TZ_N_2_5_RESOURCES', '(2/5) Resurse');
tz_def('TZ_N_2_CONSTRUCT_A_BUILDING', '2. Construiește o clădire');
tz_def('TZ_N_2_DAYS', '2 zile');
tz_def('TZ_N_2_EXTEND_THE_RESOURCE_FIELD', '2. Extinde câmpul de resurse');
tz_def('TZ_N_3_5_BUILDINGS', '(3/5) Clădiri');
tz_def('TZ_N_4_5_NEIGHBOURS', '(4/5) Vecini');
tz_def('TZ_N_5_5_NAVIGATION', '(5/5) Navigare');
tz_def('TZ_OFFER_A_CONFEDERATION', 'oferă o confederație');
tz_def('TZ_OFFER_NON_AGGRESSION_PACT', 'oferă un pact de neagresiune');
tz_def('TZ_OK_3', 'ok');
tz_def('TZ_ONLINE_USERS', 'Utilizatori online');
tz_def('TZ_OPTION_1', 'Opțiunea 1:');
tz_def('TZ_OPTION_2', 'Opțiunea 2:');
tz_def('TZ_OPTION_3', 'Opțiunea 3:');
tz_def('TZ_OPTION_4', 'Opțiunea 4:');
tz_def('TZ_OPTION_5', 'Opțiunea 5:');
tz_def('TZ_OPTION_6', 'Opțiunea 6:');
tz_def('TZ_OPTION_7', 'Opțiunea 7:');
tz_def('TZ_OPTION_8', 'Opțiunea 8:');
tz_def('TZ_ORDERED_PACKAGE', 'Pachet comandat');
tz_def('TZ_OR_ASK_THE_SERVER_OWNER', 'sau întreabă administratorul serverului.');
tz_def('TZ_OVERVIEW', 'Prezentare:');
tz_def('TZ_OWN_TEXT', 'Text propriu:');
tz_def('TZ_PALACE_RESIDENCE', 'Palat/Reședință');
tz_def('TZ_PASSWORD', 'parolă:');
tz_def('TZ_PAYMENT_ACCOUNT', 'cont de plată');
tz_def('TZ_PAYPAL', 'PayPal');
tz_def('TZ_PAYPAL_PACKAGE_A', 'PayPal – Pachet A');
tz_def('TZ_PAYPAL_PACKAGE_B', 'PayPal – Pachet B');
tz_def('TZ_PAYPAL_PACKAGE_C', 'PayPal – Pachet C');
tz_def('TZ_PAYPAL_PACKAGE_D', 'PayPal – Pachet D');
tz_def('TZ_PAYPAL_PACKAGE_E', 'PayPal – Pachet E');
tz_def('TZ_PLAY_NO_TASKS', 'Nu juca sarcinile.');
tz_def('TZ_PLEASE_BUILD_A_MARKETPLACE', 'Te rog construiește o piață.');
tz_def('TZ_PLUS_FUNCTIONS', 'Funcții Plus');
tz_def('TZ_PM', 'pm');
tz_def('TZ_POP', 'Pop');
tz_def('TZ_POSITION', 'Poziție:');
tz_def('TZ_PRODUCTION_CLAY', 'Producție: Lut');
tz_def('TZ_PRODUCTION_CROP', 'Producție: Grâne');
tz_def('TZ_PRODUCTION_IRON', 'Producție: Fier');
tz_def('TZ_PRODUCTION_LUMBER', 'Producție: Lemn');
tz_def('TZ_PUBLIC_FORUM', 'Forum public');
tz_def('TZ_RAGEZONE_COM', 'RageZone.com');
tz_def('TZ_RANKING_OF_ALL_PLAYERS', 'Clasamentul tuturor jucătorilor');
tz_def('TZ_RATIO', 'raport');
tz_def('TZ_READ_YOUR_NEW_MESSAGE', 'Citește mesajul tău nou.');
tz_def('TZ_REGISTERED', 'Înregistrat');
tz_def('TZ_REGISTERED_PLAYERS', 'Jucători înregistrați');
tz_def('TZ_RELEASED_BY_TRAVIANZ_TEAM', 'Lansat de: echipa TravianZ');
tz_def('TZ_RELEASE_BY_TRAVIANZ', '[Lansat de: TravianZ]');
tz_def('TZ_REPLIES', 'Răspunsuri');
tz_def('TZ_REPORTS', 'Rapoarte:');
tz_def('TZ_REQUIREMENTS', 'Cerințe');
tz_def('TZ_ROMANIAN', 'Română');
tz_def('TZ_SCOUT_DEFENCES_AND_TROOPS', 'Spionează apărările și trupele');
tz_def('TZ_SCOUT_RESOURCES_AND_TROOPS', 'Spionează resursele și trupele');
tz_def('TZ_SCRIPT_PRICE', 'Prețul scriptului:');
tz_def('TZ_SELECT_ALL', 'Selectează tot');
tz_def('TZ_SELECT_REWARD', 'Selectează recompensa...');
tz_def('TZ_SELECT_REWARD_2', 'Selectează recompensa:');
tz_def('TZ_SEND_200_CROP_TO_THE_TASKMASTER', 'Trimite 200 grâne către maistru.');
tz_def('TZ_SEND_AND_RECEIVE_MESSAGES', 'Trimite și primește mesaje');
tz_def('TZ_SEND_UNITS_BACK', 'Trimite unitățile înapoi');
tz_def('TZ_SERVER_START', 'Pornirea serverului');
tz_def('TZ_SHOW_THE_LARGE_MAP_IN_AN_EXTRA_WIN', 'Afișează harta mare într-o fereastră separată.');
tz_def('TZ_SIZE_IN_MB', 'Dimensiune în MB');
tz_def('TZ_SLOTS', 'Sloturi');
tz_def('TZ_START_RAID', 'Pornește raidul');
tz_def('TZ_STATISTICS', 'Statistici:');
tz_def('TZ_SUPPORT', 'Suport:');
tz_def('TZ_SUPPORT_AND_MULTIHUNTER', 'Suport și Multihunter');
tz_def('TZ_SURVEY', 'sondaj');
tz_def('TZ_TARIFFS', 'Tarife');
tz_def('TZ_TASK_7_HUGE_ARMY', 'Sarcina 7: Armată uriașă!');
tz_def('TZ_TASK_8_EVERYTHING_TO_1', 'Sarcina 8: Totul la 1.');
tz_def('TZ_THANK_YOU_FOR_USING_OUR_VERSION', 'Mulțumim că folosești versiunea noastră!');
tz_def('TZ_THERE_ARE_NO_INCOMING_TROOPS', 'Nu există trupe care sosesc');
tz_def('TZ_THERE_ARE_NO_OUTGOING_TROOPS', 'Nu există trupe care pleacă');
tz_def('TZ_THE_BEST_ALLIANCES_DEF', 'Cele mai bune alianțe (def)');
tz_def('TZ_THE_BEST_ALLIANCES_OFF', 'Cele mai bune alianțe (atac)');
tz_def('TZ_THE_BUILDING_WAS_COMPLETELY_DEMOLI', 'Clădirea a fost demolată complet pentru 10 aur!');
tz_def('TZ_THE_EMAIL_ACCOUNT_S_STORAGE_LIMIT', 'Limita de stocare a contului de e-mail a fost atinsă');
tz_def('TZ_THE_EMAIL_HAS_BEEN_MOVED_TO_THE_SP', 'E-mailul a fost mutat în folderul spam/junk');
tz_def('TZ_THE_EMAIL_WILL_BE_SENT_TO_FOLLOWIN', 'E-mailul va fi trimis la următoarea adresă:');
tz_def('TZ_THE_E_MAIL_ADDRESS_OF_THE_NEW_OWNE', 'Adresa de e-mail a noului proprietar.');
tz_def('TZ_THE_GAME_WORLD_ON_WHICH_THE_ACCOUN', 'Lumea de joc în care se află contul');
tz_def('TZ_THE_HERO', 'Eroul');
tz_def('TZ_THE_LARGEST_GAULS', 'Cei mai mari Gali');
tz_def('TZ_THE_LARGEST_PLAYERS', 'Cei mai mari jucători');
tz_def('TZ_THE_LARGEST_ROMANS', 'Cei mai mari Romani');
tz_def('TZ_THE_LARGEST_TEUTONS', 'Cei mai mari Teutoni');
tz_def('TZ_THE_LARGEST_VILLAGES', 'Cele mai mari sate');
tz_def('TZ_THE_MOST_EXPERIENCED_HEROES', 'Cei mai experimentați eroi');
tz_def('TZ_THE_MOST_SUCCESSFUL_ATTACKERS', 'Cei mai de succes atacatori');
tz_def('TZ_THE_MOST_SUCCESSFUL_DEFENDERS', 'Cei mai de succes apărători');
tz_def('TZ_THE_MULTIHUNTERS_ARE_RESPONSIBLE_F', 'Multihunterii sunt responsabili de respectarea');
tz_def('TZ_THE_NAVIGATION_BAR', 'Bara de navigare');
tz_def('TZ_THE_NICKNAME_OF_THE_ACCOUNT', 'Porecla contului');
tz_def('TZ_THE_PATH', 'Calea');
tz_def('TZ_THE_VILLAGE', 'Satul');
tz_def('TZ_THIS_FEATURE_IS_NOT_INCLUDED_IN_TH', 'Această funcție NU este inclusă în clubul de aur!');
tz_def('TZ_THIS_IS_HOW_YOU_START', 'Așa începi...');
tz_def('TZ_THREADS', 'Subiecte');
tz_def('TZ_TIME_PREFERENCE', 'Preferință de timp');
tz_def('TZ_TIME_ZONES', 'Fusuri orare');
tz_def('TZ_TIP', 'Sfat');
tz_def('TZ_TOP_10_ALLIANCES', 'Top 10 alianțe');
tz_def('TZ_TOP_10_PLAYERS', 'Top 10 jucători');
tz_def('TZ_TOTAL_POPULATION', 'Populație totală');
tz_def('TZ_TOTAL_VILLAGES', 'Total sate');
tz_def('TZ_TO_THE_FIRST_TASK', 'Spre prima sarcină.');
tz_def('TZ_TO_THE_REGISTRATION', 'spre înregistrare');
tz_def('TZ_TRAIN_3_SETTLERS', 'Antrenează 3 coloniști.');
tz_def('TZ_TRAVIAN_DEFAULT', 'Travian Default');
tz_def('TZ_TRAVIAN_GOLD_CLUB', 'Travian Gold Club');
tz_def('TZ_TRAVIAN_T4_STYLE', 'Travian T4 Style');
tz_def('TZ_TRIBES', 'Triburi');
tz_def('TZ_TYPOS_IN_THE_EMAIL_ADDRESS', 'Greșeli în adresa de e-mail');
tz_def('TZ_UK_DD_MM_YY_12H', 'UK (zz/ll/aa 12h)');
tz_def('TZ_UPGRADE_ALL_RESOURCES_TILES_TO_LEV', 'Îmbunătățește toate câmpurile de resurse la nivelul 5.');
tz_def('TZ_UPGRADE_YOUR_GRANARY_TO_LEVEL_3', 'Îmbunătățește hambarul la nivelul 3.');
tz_def('TZ_UPGRADE_YOUR_MAIN_BUILDING_TO_LEVE', 'Îmbunătățește clădirea principală la nivelul 5.');
tz_def('TZ_UPGRADE_YOUR_WAREHOUSE_TO_LEVEL_7', 'Îmbunătățește depozitul la nivelul 7.');
tz_def('TZ_USE', 'Folosește');
tz_def('TZ_USED_FOR_RALLY_POINT_AND_MARKETPLA', 'Folosit pentru punctul de adunare și piață:');
tz_def('TZ_USERNAME', 'Nume de utilizator');
tz_def('TZ_USER_DEFINED_GRAPHIC_PACK', 'Pachet grafic personalizat');
tz_def('TZ_USE_IT_FOR_PLUS_OR_ANY_ADVANTAGE', '. Folosește-l pentru Plus sau orice avantaj.');
tz_def('TZ_US_MM_DD_YY_12H', 'US (ll/zz/aa 12h)');
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
tz_def('TZ_VERSION', 'Versiune:');
tz_def('TZ_VILLAGE_EXP', 'Exp. sat');
tz_def('TZ_VILLAGE_YOU_GET', 'sat, primești');
tz_def('TZ_VILLAGE_YOU_WILL_BE_CREDITED_WITH', 'sat, vei fi creditat cu');
tz_def('TZ_VIP_ACCOUNT_10_GOLD_7_DAYS', 'Cont VIP (10 aur – 7 zile)');
tz_def('TZ_VISIT', 'Vizitează:');
tz_def('TZ_VOTE', 'Votează');
tz_def('TZ_WAIT_24H', 'Așteptare: 24h');
tz_def('TZ_WAIT_INSTANT_AFTER_IPN', 'Așteptare: imediat după IPN');
tz_def('TZ_WARNING_CATAPULT_WILL', 'Atenție: catapulta va');
tz_def('TZ_WE_STRIVE_TO_ENSURE_SPEEDY_PROCESS', 'Ne străduim să asigurăm o procesare rapidă!');
tz_def('TZ_WHY_CAN_T_I_FINISH_SOME_BUILDINGS', 'De ce nu pot termina unele clădiri cu aur?');
tz_def('TZ_WILL_BE_ATTACKED_BY_CATAPULT_S', '(va fi atacat de catapulte)');
tz_def('TZ_WILL_SPAWN_IN', 'vor apărea în:');
tz_def('TZ_WILL_SPAWN_IN_ARTIFACTS', 'Artefactele');
tz_def('TZ_WILL_SPAWN_IN_WW', 'Satele WW');
tz_def('TZ_WILL_SPAWN_IN_PLAN', 'Planurile WW');
tz_def('TZ_WOODCUTTER_INSTANTLY_COMPLETED', 'Tăietorul de lemne finalizat instant.');
tz_def('TZ_WORLD_STATS', 'Statistici mondiale');
tz_def('TZ_WRITE_THE_CODE', 'Scrie codul');
tz_def('TZ_WRONG_DOMAIN_THERE_IS_E_G_NO_AOL_D', 'Domeniu greșit: nu există de ex. @aol.de, doar @aol.com');
tz_def('TZ_YOUR_ACCOUNT_HAS_BEEN_SUCCESSFULLY', 'Contul tău a fost activat cu succes.');
tz_def('TZ_YOUR_VILLAGE_AND_YOUR_NEIGHBOURS', 'Satul tău și vecinii tăi');
tz_def('TZ_YOU_CAN_UNDO_THE_REGISTRATION_AND', 'Poți anula înregistrarea și te poți reînregistra cu o');
tz_def('TZ_YOU_CAN_USE_THIS_GOLD_FOR_PLUS_OR', '. Poți folosi acest aur pentru Plus sau orice avantaj cu aur.');

// ===== i18n etape 2 (lot suivant) =====
tz_def('TZ_ACCOUNT_OR_INCREASE_YOUR_RESOURCE', '-Cont sau crește-ți producția de resurse. Pentru asta dă click');
tz_def('TZ_ADDITIONALLY_THE_TRAVIAN_TEAM_WILL', 'În plus, echipa Travian nu va furniza informații despre interdicții niciunei persoane, în afară de proprietarul contului.');
tz_def('TZ_ADVERTISEMENT_OF_ANY_KIND_THAT_HAS', 'Orice fel de publicitate care nu a fost permisă de echipa Travian este interzisă.');
tz_def('TZ_AFTERWARDS_BOTH_PARTIES_MUST_REQUE', 'Ulterior, ambele părți trebuie să solicite parola noului cont prin funcția de recuperare a parolei.');
tz_def('TZ_AFTER_TAKING_CARE_OF_YOUR_RESOURCE', 'După ce te ocupi de aprovizionarea cu resurse, poți începe extinderea satului tău.');
tz_def('TZ_ANY_SALES_OR_PURCHASES_CONCERNING', 'Orice vânzare sau cumpărare cu bani reali privind conturi, unități, sate, resurse, servicii sau orice alt aspect al Travian este interzisă. Vânzarea conturilor Travian, precum și orice transfer indirect (chiar și ca dar) în legătură cu site-uri de licitații sau alte tranzacții monetare este interzisă.');
tz_def('TZ_AS_A_LEADER_YOU_CAN_ONLY_CHANGE_YO', 'Ca lider, poți schimba doar titlul. Drepturile tale rămân la maxim.');
tz_def('TZ_A_SITTER_CAN_LOG_INTO_YOUR_ACCOUNT', 'Un înlocuitor se poate conecta la contul tău folosind numele tău și parola lui/ei. Poți avea până la doi înlocuitori.');
tz_def('TZ_A_WAREHOUSE_AND_A_GRANARY_ENABLE_Y', 'Un depozit și un hambar îți permit să stochezi mai multe resurse. O ascunzătoare îți protejează resursele de furtul atacatorilor inamici.');
tz_def('TZ_BECAUSE_YOU_ARE_THE_ALLIANCE_FOUND', 'Deoarece ești fondatorul alianței, trebuie să alegi un fondator înlocuitor înainte de a pleca.');
tz_def('TZ_BEFORE_YOU_EXPAND_YOUR_VILLAGE_S_B', 'Înainte de a extinde clădirile satului, ar trebui să dezvolți câteva câmpuri de resurse pentru a-ți crește aprovizionarea.');
tz_def('TZ_BLACKMAILING_PLAYERS_IN_A_WAY_THAT', 'Șantajarea jucătorilor într-un mod care încalcă oricare dintre regulile Travian conform Termenilor și Condițiilor Generale.');
tz_def('TZ_COMPLETE_CONSTRUCTION_ORDERS_AND_R', 'Finalizează acum ordinele de construcție și cercetările din acest sat');
tz_def('TZ_DISPLAYING_BATTLE_REPORTS_OR_MESSA', 'Afișarea publică a rapoartelor de luptă sau a mesajelor fără consimțământul ambelor părți implicate.');
tz_def('TZ_EACH_PLAYER_MAY_ONLY_OWN_AND_PLAY', 'Fiecare jucător poate deține și juca un singur cont pe server.');
tz_def('TZ_ENGLISH_IS_THE_ONLY_LANGUAGE_TOLER', 'Engleza este singura limbă tolerată în mesaje și descrieri.');
tz_def('TZ_FOLLOWING_BEHAVIOR_IS_PUNISHABLE_A', 'Următorul comportament este pedepsibil și se aplică tuturor descrierilor, numelui contului, numelor de alianță, numelor de sate și mesajelor:');
tz_def('TZ_HERE_YOU_CAN_CHANGE_TRAVIAN_S_DISP', 'Aici poți schimba ora afișată de Travian pentru a se potrivi cu fusul tău orar.');
tz_def('TZ_HERE_YOU_CAN_HAVE_A_LOOK_AT_YOUR_V', 'Aici poți arunca o privire asupra zonei din jurul satului tău și a vecinilor');
tz_def('TZ_HOWEVER_IT_IS_PERMISSIBLE_TO_TRANS', 'Totuși, este permis să transmiți parola unui cont unei persoane sau unor persoane care joacă pe o altă lume de joc (sau care nu joacă deloc) pentru a juca împreună un singur cont.');
tz_def('TZ_IF_INDIVIDUAL_REGULATIONS_OF_THIS', 'Dacă anumite reglementări din acest set de reguli se dovedesc a fi în vreun fel ineficiente, acest lucru nu afectează valabilitatea celorlalte reglementări din acest set. Administratorii se angajează să înlocuiască reglementările ineficiente cu altele noi cât mai repede posibil.');
tz_def('TZ_IF_THERE_IS_AN_OFFENCE_AGAINST_THE', 'În cazul unei încălcări a acestor reguli de joc, Multihunterii și, dacă este necesar, administratorii vor interzice contul/conturile în cauză și vor decide o pedeapsă potrivită. Pedepsele vor depăși întotdeauna câștigul obținut din încălcarea regulilor.');
tz_def('TZ_IF_YOUR_ALLIANCE_WANTS_TO_USE_AN_E', 'Dacă alianța ta dorește să folosească un forum extern, poți introduce URL-ul aici.');
tz_def('TZ_IMPERSONATING_OFFICIALS_OR_OFFICIA', 'Impersonarea oficialilor sau a funcțiilor oficiale este ilegală în orice mod.');
tz_def('TZ_INCITING_MANIPULATING_ENCOURAGING', 'Incitarea, manipularea, încurajarea, asistarea sau conspirarea cu alții pentru a încălca oricare dintre regulile Travian este interzisă. Aceste reguli se aplică fără excepție jucătorilor care își vor șterge conturile sau le șterg în prezent.');
tz_def('TZ_INTO_YOUR_PROFILE_BY_ADDING_IT_TO', 'în profilul tău adăugându-l într-unul dintre cele două câmpuri de descriere.');
tz_def('TZ_IN_ORDER_TO_ACTIVATE_YOUR_ACCOUNT', 'Pentru a-ți activa contul, introdu codul sau dă click pe link-ul din e-mail.');
tz_def('TZ_IN_ORDER_TO_PLAY_TRAVIAN_YOU_NEED', 'Pentru a juca Travian ai nevoie de o adresă de e-mail validă la care poate fi trimis codul de activare. Există cazuri excepționale în care acest e-mail ar putea să nu ajungă.');
tz_def('TZ_IN_ORDER_TO_QUIT_THE_ALLIANCE_YOU', 'Pentru a părăsi alianța trebuie să îți introduci din nou parola din motive de siguranță.');
tz_def('TZ_IN_ORDER_TO_SWITCH_AN_ACCOUNT_WITH', 'Pentru a schimba un cont cu o altă persoană pe aceeași lume de joc, ambele persoane trebuie să trimită un e-mail la admin@travian.com de la adresa de e-mail înregistrată în prezent pentru cont. E-mailul trebuie să conțină următoarele informații:');
tz_def('TZ_IN_THE_BEGINNING_YOUR_SMALL_VILLAG', 'La început, micul tău sat va avea doar o singură clădire.');
tz_def('TZ_IN_TRAVIAN_YOU_ARE_NOT_ALONE_YOU_I', 'În Travian nu ești singur; interacționezi cu mii de alți jucători în lumea Travian.');
tz_def('TZ_IT_S_PART_OF_DIPLOMATIC_ETIQUETTE', 'Face parte din eticheta diplomatică să discuți cu o altă alianță înainte de a trimite o ofertă.');
tz_def('TZ_MULTIACCOUNTS_ON_THE_SPEED_SERVER', 'Conturile multiple pe serverul rapid și conturile multiple cu mai puțin de 100 populație pot fi șterse pe loc fără avertisment prealabil.');
tz_def('TZ_NOW_YOU_HAVE_FULFILLED_ALL_PREREQU', 'Acum ai îndeplinit toate cerințele necesare pentru a construi o piață.');
tz_def('TZ_NOW_YOU_KNOW_EVERYTHING_IMPORTANT', 'Acum știi tot ce este important despre Travian. După înregistrare poți începe să joci!');
tz_def('TZ_NO_EVERY_GOLD_FEATURE_WORKS_STANDA', 'Nu. Fiecare funcție cu aur funcționează independent atâta timp cât ai suficient aur.');
tz_def('TZ_NO_REAL_WORLD_POLITICS_ARE_ALLOWED', 'Nu este permisă politica din lumea reală în nume, mesaje și descrieri.');
tz_def('TZ_PARTICIPATION_IN_ABUSIVE_DEFAMATOR', 'Participarea la limbaj abuziv, defăimător, sexist, rasist sau vulgar; denigrarea oricărei religii, rase, națiuni, sex, grupe de vârstă sau orientări sexuale; amenințarea unei persoane cu acțiuni în viața reală.');
tz_def('TZ_PLAYERS_MAY_TALK_TO_THE_MULTIHUNTE', 'Jucătorii pot vorbi cu Multihunterul care i-a interzis sau cu un administrator fie prin IGM (mesaj în joc), fie prin e-mail. Interdicțiile, pedepsele sau ștergerile nu trebuie discutate în public (de ex. Chat sau Forumuri). Contestațiile trebuie scrise în engleză.');
tz_def('TZ_PLEASE_ENTER_YOUR_OLD_AND_YOUR_NEW', 'Te rugăm să introduci adresa de e-mail veche și pe cea nouă. Vei primi apoi un fragment de cod la ambele adrese, pe care trebuie să-l introduci aici.');
tz_def('TZ_PLUS_DOES_NOT_INCLUDE_PRODUCTION_B', 'Plus nu include bonusuri de producție. Trebuie să cumperi +25% pentru fiecare resursă separat în');
tz_def('TZ_PROGRAM_ERRORS_ALSO_CALLED_BUGS_MA', 'Erorile de program (numite și bug-uri) nu pot fi folosite în avantajul propriu. Abuzul poate duce la pedepsirea contului.');
tz_def('TZ_RESIDENCE_PALACE_AND_WORLD_WONDER', 'Satele cu Reședință, Palat și Minunea Lumii sunt excluse din motive de joc.');
tz_def('TZ_RESOURCES_BUILDINGS_VILLAGES_OR_TR', 'Resursele, clădirile, satele sau trupele pierdute în perioada de suspendare nu contează ca pedeapsă și nu vor fi înlocuite de echipa Travian. Niciun jucător nu are dreptul să ceară plată sau înlocuire pentru timpul de Plus/Aur pierdut din cauza suspendării.');
tz_def('TZ_SHOOT_WITH_A_NORMAL_ATTACK_THEY_DO', 'trag cu un atac normal (nu trag la raiduri!)');
tz_def('TZ_SOMETIMES_THE_EMAIL_IS_MOVED_TO_TH', 'Uneori e-mailul este mutat în folderul spam. Pentru ajutor suplimentar dă click');
tz_def('TZ_THERE_ARE_FOUR_DIFFERENT_TYPES_OF', 'Există patru tipuri diferite de resurse în Travian: lemn, lut, fier și grâne.');
tz_def('TZ_THERE_IS_NO_COMPENSATION_FOR_DAMAG', 'Nu există compensație pentru daunele provocate de un înlocuitor. Proprietarii de cont sunt pe deplin responsabili pentru acțiunile efectuate de înlocuitorii aleși ai contului lor. În cazul în care înlocuitorii unui cont nu respectă aceste reguli și Termenii și Condițiile Generale ale Travian, atât proprietarul contului, cât și înlocuitorul pot fi considerați responsabili și pedepsiți.');
tz_def('TZ_THERE_IS_NO_COMPENSATION_FOR_DAMAG_2', 'Nu există compensație pentru daunele provocate de cineva care cunoaște parola unui cont. Persoana care primește parola este supusă regulilor Travian, precum și Termenilor și Condițiilor Generale.');
tz_def('TZ_THERE_IS_NO_SPECIAL_TREATMENT_FOR', 'Nu există un tratament special pentru utilizatorii Travian Plus/Aur în privința regulilor jocului, nici în timpul necesar pentru a trata cazul, nici în pedeapsă.');
tz_def('TZ_THE_E_MAIL_ADDRESS_USED_FOR_THE_RE', 'Adresa de e-mail folosită pentru înregistrarea unui cont trebuie să fie sub controlul personal și exclusiv al persoanei care a înregistrat contul. Persoana care deține adresa de e-mail înregistrată în prezent pentru un cont este considerată proprietarul contului, indiferent de orice alte înțelegeri personale sau de alianță. Proprietarul unui cont este pe deplin responsabil pentru toate acțiunile efectuate de cont.');
tz_def('TZ_THE_FOLLOWING_SET_OF_RULES_ARE_IN', 'Următorul set de reguli este în legătură cu Termenii și Condițiile Generale ale Travian. Ar trebui să te familiarizezi cu Termenii și Condițiile Generale pentru a verifica ce este permis și ce este interzis, în special în cazul unui cont interzis pentru încălcarea regulilor.');
tz_def('TZ_THE_GAME_MUST_BE_PLAYED_WITH_AN_UN', 'Jocul trebuie jucat cu un browser de internet nemodificat. Utilizarea de scripturi sau boți care automatizează acțiunile contului este împotriva regulilor.');
tz_def('TZ_THE_OWNER_OF_AN_ACCOUNT_MAY_NOT_TR', 'Proprietarul unui cont nu poate transmite parola unui cont niciunei persoane care joacă pe aceeași lume de joc (server). În plus, alegerea cu bună știință a aceleiași parole pe aceeași lume de joc ca o altă persoană este ilegală; oricare dintre aceste acțiuni este considerată multiconting, așa cum este definit în aceste reguli.');
tz_def('TZ_THE_PLAYERS_IN_YOUR_SURROUNDING_AR', 'Jucătorii din zona ta sunt cei mai importanți pentru tine. Datorită hărții ai o bună imagine de ansamblu asupra cine sunt aceștia.');
tz_def('TZ_THE_REGISTRATION_WAS_SUCCESSFUL_IN', 'Înregistrarea a reușit. În următoarele minute vei primi un e-mail cu informațiile de acces.');
tz_def('TZ_THE_SUPPORT_IS_A_GROUP_OF_EXPERIEN', 'Suportul este un grup de jucători experimentați care vor răspunde cu plăcere la întrebările tale.');
tz_def('TZ_THE_TRAVIAN_TEAM_RESERVES_THE_RIGH', 'Echipa Travian își rezervă dreptul de a modifica regulile în orice moment.');
tz_def('TZ_TO_BRING_IN_NEW_PLAYERS_INVITE_THE', 'Pentru a aduce jucători noi, invită-i prin e-mail sau distribuie link-ul tău de recomandare.');
tz_def('TZ_VACATION_MODE_CANNOT_BE_ACTIVATED', 'Modul vacanță nu poate fi activat – cerințele nu sunt îndeplinite');
tz_def('TZ_WE_WILL_SHOW_YOU_HOW_TO_EXPAND_YOU', 'Îți vom arăta pe pagina următoare cum să-ți extinzi satul astfel încât să devină un oraș puternic și prosper.');
tz_def('TZ_YOU_CAN_DELETE_YOUR_ACCOUNT_HERE_A', 'Îți poți șterge contul aici. După începerea anulării, finalizarea ștergerii contului va dura trei zile. Poți anula acest proces în primele 24 de ore.');
tz_def('TZ_YOU_DON_T_HAVE_ENOUGH_GOLD_YOU_NEE', 'Nu ai suficient aur. Ai nevoie de 10 aur pentru demolare instantanee.');
tz_def('TZ_YOU_HAVE_BEEN_ENTERED_AS_SITTER_ON', 'Ai fost adăugat ca înlocuitor pe următoarele conturi. Poți anula acest lucru dând click pe X-ul roșu.');

// ===== i18n composites (Simulateur) =====
tz_def('TZ_NUMBER', 'Număr');
tz_def('TZ_LVL', 'Niv.');

// ===== i18n reliquat multi-lignes =====
tz_def('TZ_ML_LEADER_DEMOLITION_EMBASSY', 'Deoarece ești liderul alianței tale, demolarea ambasadei actuale nu poate fi începută, deoarece încă deține toate');
tz_def('TZ_ML_CHANGELOG_120BUGS', 'Peste 120 de bug-uri reparate, artefacte complet reparate, catapulte și berbeci complet reparați, Natari/Artefacte/sate MdL/planuri de construcție MdL automatizate, nouă formulă de luptă (mai precisă decât cea veche), activare automată a artefactelor, mult cod rescris. Mai multe în fișierul readme!');
tz_def('TZ_ML_CHANGELOG_NEWFORUM', 'Sistem nou de forum, formulă a capcanelor în stil Travian, maistru constructor reparat, coadă dublă de cercetare în fierărie și armurărie cu Plus');
tz_def('TZ_ML_GOLD_RESERVE', 'În principiu, rezervăm cantitatea de aur comandată imediat după plată. Dacă există probleme, te rugăm să trimiți un e-mail la');
tz_def('TZ_ML_GPACK_NOTFOUND', 'Pachetul grafic nu a putut fi găsit. Acest lucru se poate datora următoarelor motive:');
tz_def('TZ_ML_GPACK_ALLOWED_SAVE', 'afișează un pachet grafic permis. Salvează alegerea pentru a-l activa.');
tz_def('TZ_ML_GPACK_ALTER_APPEARANCE', 'Cu un pachet grafic poți schimba aspectul Travian. Poți alege unul din listă sau furniza o cale personalizată.');
tz_def('TZ_ML_QUESTIONS_MULTIHUNTER', '. Dacă ai întrebări sau vrei să raportezi o încălcare, poți trimite un mesaj unui Multihunter.');
tz_def('TZ_ML_AWAY_NO_SITTER', 'Dacă plănuiești să lipsești o perioadă mai lungă și nu vrei să setezi un înlocuitor, poți activa');
tz_def('TZ_ML_ACCOUNT_FROZEN', '. În acest timp contul tău este practic înghețat. Nu vor progresa resurse, trupe sau cercetări, iar satele tale nu pot fi atacate. Amintește-ți, asta îți îngheață doar Travianul, nu timpul.');
tz_def('TZ_ML_ACTIVATION_RESENT', '. Apoi codul de activare va fi trimis din nou');
tz_def('TZ_ML_TWO_SITTERS_RIGHT', 'Fiecare jucător are dreptul de a numi doi înlocuitori care pot juca contul în absența proprietarului. Înlocuitorii trebuie să joace contul pe care îl supraveghează în beneficiul deplin al acestuia. Abuzul acestei funcții este pedepsibil.');
tz_def('TZ_ML_SAME_COMPUTER_SITTER', 'Jucătorii care folosesc același computer și doresc să acceseze contul celuilalt trebuie să folosească funcția de înlocuitor.');
tz_def('TZ_ML_POLITE_TONE', 'Toată lumea trebuie să comunice pe un ton politicos și civilizat. Multihunterii pot modifica fără avertisment profilurile și numele de sate nepotrivite.');
tz_def('TZ_ML_MATERIAL_UNDERAGE', 'Postarea sau transmiterea oricărui material nepotrivit pentru minori.');

// ===== i18n reliquat final =====
tz_def('TZ_NO_BEGINNER_PROT2', 'Fără protecție pentru începători');
tz_def('TZ_SERVER_RUNNING_ON', '▶ Server activ pe');

// ===== task A: re-wired reverted templates =====
tz_def('TZ_HERO', "Erou");
tz_def('TZ_SEND_UNITS_BACK_TO', "Trimite trupele înapoi la");
tz_def('TZ_CONFIRM_DEMOLISH_COMPLETE_1', "Sigur vrei să demolezi COMPLET ");
tz_def('TZ_CONFIRM_DEMOLISH_COMPLETE_2', " pentru 10 AUR?\nClădirea va dispărea instantaneu, acțiunea nu poate fi anulată.");
tz_def('TZ_CONFIRM_LAST_EMBASSY_L3', "ATENȚIE!\n\nEști pe cale să demolezi ultima Ambasadă de nivel 3!\n\nDeoarece ești liderul alianței și nu mai există alți membri, alianța va fi desființată după finalizarea demolării.");
tz_def('TZ_CONFIRM_LAST_EMBASSY_L1', "ATENȚIE!\n\nEști pe cale să demolezi ultima ta Ambasadă!\n\nDeoarece faci parte dintr-o alianță, vei părăsi automat acea alianță după finalizarea demolării.");
tz_def('TZ_TRADE', "Comerț");

// ===== reports section (noticeClass tooltips) =====
tz_def('TZ_RPT_SCOUT', "Raport de cercetare");
tz_def('TZ_RPT_WON_ATK_NOLOSS', "Câștigat ca atacator fără pierderi");
tz_def('TZ_RPT_WON_ATK_LOSS', "Câștigat ca atacator cu pierderi");
tz_def('TZ_RPT_LOST_ATK_LOSS', "Pierdut ca atacator cu pierderi");
tz_def('TZ_RPT_WON_DEF_NOLOSS', "Câștigat ca apărător fără pierderi");
tz_def('TZ_RPT_WON_DEF_LOSS', "Câștigat ca apărător cu pierderi");
tz_def('TZ_RPT_LOST_DEF_LOSS', "Pierdut ca apărător cu pierderi");
tz_def('TZ_RPT_LOST_DEF_NOLOSS', "Pierdut ca apărător fără pierderi");
tz_def('TZ_RPT_REINF_ARRIVED', "Întăriri sosite");
tz_def('TZ_RPT_WOOD_DELIVERED', "Lemn livrat");
tz_def('TZ_RPT_CLAY_DELIVERED', "Lut livrat");
tz_def('TZ_RPT_IRON_DELIVERED', "Fier livrat");
tz_def('TZ_RPT_CROP_DELIVERED', "Grâne livrate");
tz_def('TZ_RPT_WON_SCOUT_ATK', "Spionaj reușit ca atacator");
tz_def('TZ_RPT_LOST_SCOUT_ATK', "Spionaj eșuat ca atacator");
tz_def('TZ_RPT_WON_SCOUT_DEF', "Spionaj reușit ca apărător");
tz_def('TZ_RPT_LOST_SCOUT_DEF', "Spionaj eșuat ca apărător");

// ===== report topic connectors (display-time localization) =====
tz_def('TZ_RT_ATTACKS', "atacă");
tz_def('TZ_RT_REINFORCEMENT', "întărește");
tz_def('TZ_RT_SCOUTS', "cercetează");
tz_def('TZ_RT_SEND_RES_TO', "trimite resurse către");
tz_def('TZ_RT_WAS_ATTACKED', "a fost atacat");
tz_def('TZ_RT_REINF_IN', "Întărire în");
tz_def('TZ_RT_ELDERS_REINF', "întărire a satului bătrânilor");
tz_def('TZ_RT_UNOCC_OASIS', "Oază neocupată");
tz_def('TZ_RT_NEW_VILLAGE', "Sat nou întemeiat");
tz_def('TZ_RT_VALLEY_OCCUPIED', "Colonizare eșuată (vale ocupată)");
tz_def('TZ_NEW_VILLAGE_MSG', "Ai întemeiat un sat nou:");
tz_def('TZ_VALLEY_OCCUPIED_MSG', "Coloniștii tăi nu s-au putut stabili aici — valea este deja ocupată de alt jucător. Se întorc acasă.");

// ===== profilul jucătorului (#189) =====
tz_def('AGE', 'Vârstă');
tz_def('CAPITAL_TAG', 'Capitală');
tz_def('WRITE_MESSAGE_UNAVAILABLE', 'Trimitere mesaj indisponibilă');
tz_def('PROFILE_FLAG_ADMIN', 'Acest jucător este Administrator.');
tz_def('PROFILE_FLAG_MULTIHUNTER', 'Acest jucător este Multihunter.');
tz_def('PROFILE_FLAG_BANNED', 'Acest jucător este BANAT.');
tz_def('PROFILE_FLAG_VACATION', 'Acest jucător este în VACANȚĂ.');

// ===== pagina principală a manualului din joc (#189) =====
tz_def('BUILDINGS', 'Clădiri');
tz_def('INFRASTRUCTURE', 'Infrastructură');
tz_def('FORWARD', 'înainte');
tz_def('NEW_FEATURES', 'Funcții noi');
tz_def('NEW_WINDOW', 'fereastră nouă');
tz_def('MANUAL_INTRO', 'Acest ajutor din joc îți oferă posibilitatea de a consulta informații importante oricând.');
tz_def('MANUAL_NEW_FEATURES_DESC', "Acestea sunt funcții noi pe care nu le vei găsi în versiunea reală a jocului Travian T3.6. Aici te poți familiariza cu toate funcțiile noi în detaliu.");
tz_def('MANUAL_FAQ', 'Întrebări frecvente Travian');
tz_def('MANUAL_FAQ_DESC', "Acest ajutor din joc îți oferă doar informații scurte. Mai multe informații sunt disponibile pe");

// ===== manuel : pages des batiments (PR-A) =====
tz_def('CONSTRUCTION_TIME', "timp de construcție");
tz_def('MANUAL_FOR_LEVEL_1', "pentru nivelul 1:");
tz_def('CROP_CONSUMPTION', "Consum de cereale");
tz_def('NONE', "niciunul");
tz_def('MANUAL_DESC_TRAPPER', "Vânătorul de capcane îți protejează satul cu capcane bine ascunse. Astfel, inamicii neatenți pot fi capturați și nu vor mai putea face rău satului tău.");
tz_def('MANUAL_ONE_TRAP_COSTS', "O capcană costă");
tz_def('MANUAL_TRAPPER_FREE', "Trupele nu pot fi eliberate printr-un raid. Când trupele sunt eliberate printr-un atac normal reușit, 1/3 dintre capcane sunt reparate automat. Dacă proprietarul capcanelor eliberează captivii, toate capcanele pot fi reparate.");
tz_def('MANUAL_TRAPPER_GAULS', "Reține că această clădire poate fi construită doar de gali.");
tz_def('MANUAL_DESC_WOODCUTTER', "Tăietorul de lemne doboară copaci pentru a produce lemn. Cu cât îmbunătățești tăietorul de lemne, cu atât produce mai mult lemn.<br /><br />Construind un Gater, poți crește și mai mult producția.");
tz_def('MANUAL_DESC_CLAYPIT', "Lutul este extras din gropile de lut. Cu cât nivelul gropii de lut este mai mare, cu atât se produce mai mult lut.");
tz_def('MANUAL_DESC_IRONMINE', "Aici minerii extrag prețioasa resursă fier. Crescând nivelul minei, crești producția de fier. Construind o Turnătorie de fier, poți crește și mai mult producția.<br /><br />");
tz_def('MANUAL_DESC_CROPLAND', "Aici se produce hrana populației tale. Crescând nivelul fermei, crești producția de cereale.<br /><br />Construind o moară și o brutărie, poți crește și mai mult producția.");
tz_def('MANUAL_DESC_SAWMILL', "Lemnul tăiat de tăietorii tăi este prelucrat aici. În funcție de nivel, gaterul tău poate crește producția de lemn cu până la 25 la sută.");
tz_def('MANUAL_DESC_BRICKYARD', "Cărămidăria transformă lutul în cărămizi. În funcție de nivel, cărămidăria ta poate crește producția de lut cu până la 25 la sută.");
tz_def('MANUAL_DESC_IRONFOUNDRY', "Turnătoria de fier topește fierul. În funcție de nivel, turnătoria ta poate crește producția de fier cu până la 25 la sută.");
tz_def('MANUAL_DESC_GRAINMILL', "Moara transformă grâul în făină. În funcție de nivel, moara ta poate crește producția de cereale cu până la 25 la sută.");
tz_def('MANUAL_DESC_BAKERY', "Brutăria transformă făina în pâine. Împreună cu moara, creșterea producției de cereale poate ajunge la 50 la sută în total.");
tz_def('MANUAL_DESC_WAREHOUSE', "Resursele lemn, lut și fier sunt depozitate în depozit. Crescând nivelul, crești capacitatea depozitului tău.");
tz_def('MANUAL_DESC_GRANARY', "Cerealele produse de fermele tale sunt depozitate în hambar. Crescând nivelul, crești capacitatea hambarului.");
tz_def('MANUAL_DESC_BLACKSMITH', "Armele războinicilor tăi sunt îmbunătățite în cuptoarele fierarului. Crescând nivelul, poți comanda fabricarea unor arme și mai bune.");
tz_def('MANUAL_DESC_ARMOURY', "Armura războinicilor tăi este îmbunătățită în cuptoarele armurăriei. Crescând nivelul, poți comanda fabricarea unor armuri și mai bune.");
tz_def('MANUAL_DESC_MAINBUILDING', "Maeștrii constructori ai satului locuiesc în clădirea principală. Cu cât nivelul ei este mai mare, cu atât maeștrii constructori termină mai repede construcția de noi clădiri.");
tz_def('MANUAL_DESC_RALLYPOINT', "Trupele satului tău se adună aici. De aici le poți trimite să cucerească, să jefuiască sau să întărească alte sate.<br /><br />Punctul de adunare poate fi construit doar pe pajiștea verde de sub clădirea principală, în dreapta.");
tz_def('MANUAL_DESC_MARKETPLACE', "În piață poți face schimb de resurse cu alți jucători. Cu cât nivelul este mai mare, cu atât mai multe resurse pot fi transportate în același timp.");
tz_def('MANUAL_DESC_EMBASSY', "Ambasada este un loc pentru diplomați. La nivelul 1 te poți alătura unei alianțe, iar după ce o extinzi la nivelul 3 poți chiar să fondezi una.<br /><br />Numărul maxim de membri ai unei alianțe este egal cu de 3 ori nivelul celei mai înalte ambasade din acea alianță. Astfel, cu o ambasadă de nivel 20, până la 60 de jucători pot fi în alianță.");
tz_def('MANUAL_DESC_BARRACKS', "Infanteria poate fi antrenată în cazarmă. Cu cât nivelul este mai mare, cu atât trupele sunt antrenate mai repede.");
tz_def('MANUAL_DESC_STABLE', "Cavaleria poate fi antrenată în grajd. Cu cât nivelul este mai mare, cu atât trupele sunt antrenate mai repede.");
tz_def('MANUAL_DESC_WORKSHOP', "Mașinile de asediu precum catapultele și berbecii pot fi construite în atelier. Cu cât nivelul este mai mare, cu atât unitățile sunt produse mai repede.");
tz_def('MANUAL_DESC_ACADEMY', "Noi tipuri de unități pot fi dezvoltate în academie. Crescând nivelul, poți comanda cercetarea unor unități mai bune.");
tz_def('MANUAL_DESC_CRANNY', "Ascunzătoarea este folosită pentru a ascunde cel puțin o parte din resursele tale când satul este atacat. Aceste resurse nu pot fi furate.<br /><br />La nivelul 1, ascunzătoarea conține 100 de unități din fiecare resursă. Ascunzătorile galilor sunt de două ori mai mari decât celelalte.<br /><br />SFATURI<br />În T3, ascunzătoarea este eficientă 66% împotriva teutonilor.<br />În T3.5, ascunzătoarea este eficientă 80% împotriva teutonilor.");
tz_def('MANUAL_DESC_TOWNHALL', "În primărie poți organiza sărbători fastuoase. O astfel de sărbătoare îți crește punctele de cultură.<br /><br />Punctele de cultură sunt necesare pentru a fonda sau cuceri noi sate. Fiecare clădire produce puncte de cultură și cu cât nivelul este mai mare, cu atât produce mai multe. Cu sărbători poți crește această producție pentru scurt timp.");
tz_def('MANUAL_DESC_RESIDENCE', "Reședința este un mic palat unde regele sau regina locuiește când vizitează satul. Reședința protejează satul împotriva inamicilor care vor să îl cucerească.");
tz_def('MANUAL_DESC_PALACE', "Regele sau regina imperiului locuiește în palat. Poate exista un singur palat în regatul tău la un moment dat. Ai nevoie de un palat pentru a proclama un sat drept capitala ta.<br /><br />Capitala nu poate fi cucerită. În plus, capitala este singurul loc unde câmpurile de resurse pot fi extinse peste nivelul 10 și singurul loc unde poate fi construit atelierul pietrarului.");
tz_def('MANUAL_DESC_TREASURY', "Bogățiile imperiului tău sunt păstrate în trezorerie. O trezorerie poate păstra un singur artefact.<br /><br />Ai nevoie de o trezorerie de nivel 10 pentru un artefact mic, sau de nivel 20 pentru unul mare.");
tz_def('MANUAL_DESC_TRADEOFFICE', "La biroul comercial, căruțele negustorilor sunt îmbunătățite și echipate cu cai puternici. Cu cât nivelul este mai mare, cu atât negustorii tăi pot transporta mai mult.");
tz_def('MANUAL_DESC_GREATBARRACKS', "Marea cazarmă îți permite să produci mai multe unități în același timp, dar acestea costă de trei ori suma inițială.<br /><br />Nu poate fi construită în capitală.");
tz_def('MANUAL_DESC_GREATSTABLE', "Marele grajd îți permite să produci mai multe unități în același timp, dar acestea costă de trei ori suma inițială.<br /><br />Nu poate fi construit în capitală.");
tz_def('MANUAL_DESC_STONEMASON', "Atelierul pietrarului este expert în tăierea pietrei. Cu cât clădirea este extinsă mai mult, cu atât stabilitatea clădirilor satului este mai mare.<br /><br />Poate fi construit doar în capitală.");
tz_def('MANUAL_DESC_BREWERY', "În berărie se prepară mied gustos, băut apoi de soldați în timpul sărbătorilor.<br /><br />Aceste băuturi îți fac soldații mai curajoși și mai puternici în lupte (1% pe nivel). Din păcate, puterea de convingere a căpeteniilor scade, iar catapultele pot lovi doar aleatoriu.<br /><br />Poate fi construită doar de teutoni și doar în capitala lor. Afectează întregul imperiu.");
tz_def('MANUAL_DESC_HEROSMANSION', "În conacul eroului poți antrena un erou. Pentru aceasta ai nevoie de un soldat obișnuit care va deveni eroul, deci ai nevoie de o cazarmă sau de un grajd.<br /><br />Când clădirea atinge nivelurile 10, 15 și 20, poți anexa 1, 2 și 3 oaze neocupate cu eroul tău. În funcție de oază, vei primi o creștere a producției pentru o anumită resursă (sau chiar două resurse pentru unele oaze).");
tz_def('MANUAL_DESC_GREATWAREHOUSE', "Resursele lemn, lut și fier sunt depozitate în depozitul tău. Marele depozit îți oferă mai mult spațiu și îți păstrează resursele mai uscate și mai sigure decât depozitul normal.<br /><br />Această clădire poate fi construită doar în vechile sate natariene sau cu artefacte natariene speciale.");
tz_def('MANUAL_DESC_GREATGRANARY', "Cerealele produse de fermele tale sunt depozitate în hambar. Marele hambar îți oferă mai mult spațiu și îți păstrează cerealele mai uscate și mai sigure decât hambarul normal.<br /><br />Această clădire poate fi construită doar în vechile sate natariene sau cu artefacte natariene speciale.");
tz_def('MANUAL_DESC_WONDER', "Minunea lumii reprezintă mândria creației. Doar cei mai puternici și mai bogați sunt capabili să construiască o asemenea capodoperă și să o apere de inamicii invidioși.<br /><br />Minunile lumii pot fi ridicate doar în vechile sate natariene. Este nevoie și de un plan de construcție. Începând cu nivelul 50, este necesar un plan suplimentar. Acesta trebuie să aparțină altui jucător din aceeași alianță.");
tz_def('MANUAL_DESC_HORSEDRINKING', "Adăpătoarea pentru cai are grijă de bunăstarea cailor tăi și, prin urmare, crește și viteza antrenamentului lor.<br /><br />Adăpătoarea reduce cu unu consumul de cereale al următorilor soldați: Equites Legati de la nivelul 10, Equites Imperatoris de la nivelul 15 și Equites Caesaris de la nivelul 20.<br /><br />Adăpătoarea poate fi construită doar de romani.");
tz_def('MANUAL_DESC_GREATWORKSHOP', "În marele atelier pot fi construite mașini de asediu precum catapultele și berbecii, însă la un cost triplu față de o unitate standard. Cu cât nivelul este mai mare, cu atât unitățile sunt produse mai repede.<br /><br />Nu poate fi construit în capitală.");
tz_def('MANUAL_ATTACK_VALUE', "valoare de atac");
tz_def('MANUAL_DEF_INFANTRY', "apărare împotriva infanteriei");
tz_def('MANUAL_DEF_CAVALRY', "apărare împotriva cavaleriei");
tz_def('MANUAL_VELOCITY', "Viteză");
tz_def('MANUAL_FIELDS_HOUR', "câmpuri/oră");
tz_def('MANUAL_CAN_CARRY', "Capacitate de transport");
tz_def('MANUAL_TRAINING_DURATION', "Durata antrenamentului");
tz_def('MANUAL_NPC_NATARS', "Această descriere are doar rol informativ. Natarii sunt un trib pur NPC și, prin urmare, nu pot fi jucați.");
tz_def('MANUAL_NPC_NATURE', "Această descriere are doar rol informativ. Natura este un trib pur NPC și, prin urmare, nu poate fi jucată.");
tz_def('MANUAL_UDESC_ANIMAL_EXP', "Experiența pe care un erou o câștigă ucigând un animal este determinată de întreținerea de care animalul avea nevoie. Astfel, %s oferă doar %d punct(e) de experiență.");
tz_def('MANUAL_UDESC_1', "Legionarul este infanteria simplă și universală a Imperiului Roman. Datorită antrenamentului său echilibrat, este bun atât în apărare, cât și în atac. Totuși, Legionarul nu va atinge niciodată nivelul trupelor mai specializate.");
tz_def('MANUAL_UDESC_2', "Pretorienii sunt garda împăratului și îl apără cu prețul vieții. Deoarece antrenamentul lor este specializat pentru apărare, sunt atacatori foarte slabi.");
tz_def('MANUAL_UDESC_3', "Imperianul este atacatorul suprem al Imperiului Roman. Este rapid, puternic și coșmarul tuturor apărătorilor. Totuși, antrenamentul său este costisitor și de durată.");
tz_def('MANUAL_UDESC_4', "Equites Legati sunt trupele de recunoaștere romane. Sunt destul de rapizi și pot spiona satele inamice pentru a vedea resursele și trupele.<br /><br />Dacă în satul spionat nu se află niciun Cercetaș, Equites Legati sau Iscoadă, spionajul rămâne neobservat.");
tz_def('MANUAL_UDESC_5', "Equites Imperatoris sunt cavaleria standard a armatei romane și sunt foarte bine înarmați. Nu sunt cele mai rapide trupe, dar sunt o teroare pentru inamicii nepregătiți. Totuși, trebuie să ții mereu cont că hrănirea calului și a călărețului nu este ieftină.");
tz_def('MANUAL_UDESC_6', "Equites Caesaris sunt cavaleria grea a Romei. Sunt foarte bine blindați și provoacă pagube uriașe, dar toată această armură și acest armament au un preț. Sunt lenți, cară mai puține resurse, iar hrănirea lor este costisitoare.");
tz_def('MANUAL_UDESC_7', "Berbecul este o armă grea de sprijin pentru infanteria și cavaleria ta. Sarcina sa este să distrugă zidurile inamice și astfel să mărească șansele trupelor tale de a depăși fortificațiile dușmanului.");
tz_def('MANUAL_UDESC_8', "Catapulta este o excelentă armă cu rază lungă; este folosită pentru a distruge câmpurile și clădirile satelor inamice. Totuși, fără trupe de escortă este aproape lipsită de apărare, așa că nu uita să trimiți câteva trupe alături de ea.<br /><br />Un punct de adunare de nivel înalt face catapultele mai precise și îți oferă posibilitatea de a ținti clădiri inamice suplimentare. Cu un punct de adunare de nivel 10, poate fi țintită orice clădire, cu excepția ascunzătorii, a pietrarului și a capcanierului.<br />SFAT: catapultele care țintesc la întâmplare POT lovi ascunzătoarea, capcanierii sau pietrarul.");
tz_def('MANUAL_UDESC_9', "Senatorul este conducătorul ales al tribului. Este un bun orator și știe cum să-i convingă pe ceilalți. Este capabil să convingă alte sate să lupte de partea imperiului.<br /><br />De fiecare dată când Senatorul se adresează locuitorilor unui sat, valoarea loialității inamicului scade, până când satul devine al tău.");
tz_def('MANUAL_UDESC_10', "Colonii sunt cetățeni curajoși și îndrăzneți care, după un antrenament îndelungat, pleacă din sat pentru a întemeia un sat nou în onoarea ta.<br /><br />Deoarece călătoria și întemeierea noului sat sunt foarte dificile, trei coloni trebuie să rămână împreună. Au nevoie de o bază de 750 de unități din fiecare resursă.");
tz_def('MANUAL_UDESC_11', "Bâtașii sunt cea mai ieftină unitate din Travian. Sunt antrenați rapid și au capacități de atac medii, dar armura lor nu este cea mai bună. Bâtașii sunt aproape lipsiți de apărare în fața cavaleriei și sunt călcați în picioare cu ușurință.");
tz_def('MANUAL_UDESC_12', "În armata teutonă, sarcina Lăncierului este apărarea. Este deosebit de eficient împotriva cavaleriei datorită lungimii armei sale.<br /><br />Totuși, nu îl folosi ca unitate de atac, deoarece capacitățile sale ofensive sunt foarte scăzute.");
tz_def('MANUAL_UDESC_13', "Aceasta este cea mai puternică unitate de infanterie a Teutonilor. Este puternic atât în atac, cât și în apărare, dar este mai lent și mai costisitor decât celelalte unități.");
tz_def('MANUAL_UDESC_14', "Cercetașul se deplasează mult înaintea trupelor teutone pentru a-și face o idee despre forța inamicului și satele sale. Se deplasează pe jos, ceea ce îl face mai lent decât omologii săi romani sau gali. El cercetează unitățile, resursele și fortificațiile inamice.<br /><br />Dacă în satul spionat nu se află niciun Cercetaș, Iscoadă sau Equites Legati inamic, spionajul rămâne neobservat.");
tz_def('MANUAL_UDESC_15', "Fiind echipați cu armură grea, Paladinii sunt o unitate defensivă excelentă. Infanteriei îi va fi deosebit de greu să le străpungă scutul.<br /><br />Din păcate, capacitățile lor de atac sunt destul de scăzute, iar viteza lor, comparativ cu alte unități de cavalerie, este sub medie. Antrenamentul lor durează foarte mult și este destul de costisitor.");
tz_def('MANUAL_UDESC_16', "Cavalerul Teuton este un războinic formidabil care aduce frică și disperare asupra dușmanilor săi. În apărare, se remarcă împotriva cavaleriei inamice. Totuși, costul antrenării și hrănirii sale este extraordinar.");
tz_def('MANUAL_UDESC_17', "Berbecul este o armă grea de sprijin pentru infanteria și cavaleria ta. Sarcina sa este să distrugă zidurile inamice și astfel să mărească șansele trupelor tale de a depăși fortificațiile dușmanului.");
tz_def('MANUAL_UDESC_18', "Catapulta este o excelentă armă cu rază lungă; este folosită pentru a distruge câmpurile și clădirile satelor inamice. Totuși, fără trupe de escortă este aproape lipsită de apărare, așa că nu uita să trimiți câteva trupe alături de ea.<br /><br />Un punct de adunare de nivel înalt face catapultele mai precise și îți oferă posibilitatea de a ținti clădiri inamice suplimentare. Cu un punct de adunare de nivel 10, poate fi țintită orice clădire, cu excepția ascunzătorii, a pietrarilor și a capcanierului.<br />SFAT: catapultele care țintesc la întâmplare POT lovi ascunzătoarea, capcanierii sau pietrarii.");
tz_def('MANUAL_UDESC_19', "Din rândurile lor, Teutonii își aleg Căpetenia. Pentru a fi ales, curajul și strategia nu sunt de ajuns; trebuie să fii și un orator redutabil, deoarece obiectivul principal al Căpeteniei este să convingă populația satelor străine să se alăture tribului său.<br /><br />Cu cât Căpetenia se adresează mai des populației unui sat, cu atât loialitatea satului scade, până când acesta se alătură în cele din urmă tribului Căpeteniei.");
tz_def('MANUAL_UDESC_21', "Fiind infanterie, Falanga este ieftină și rapid de produs.<br /><br />Deși puterea sa de atac este scăzută, în apărare este destul de puternică atât împotriva infanteriei, cât și a cavaleriei.");
tz_def('MANUAL_UDESC_22', "Spadasinii sunt mai scumpi decât Falanga, dar sunt o unitate de atac.<br /><br />În apărare sunt destul de slabi, mai ales împotriva cavaleriei.");
tz_def('MANUAL_UDESC_23', "Iscoada este unitatea de recunoaștere a Galilor. Sunt foarte rapizi și se pot apropia cu prudență de unitățile, resursele sau clădirile inamice pentru a le spiona.<br /><br />Dacă în satul spionat nu se află niciun Cercetaș, Equites Legati sau Iscoadă, spionajul rămâne neobservat.");
tz_def('MANUAL_UDESC_24', "Tunetele lui Teutates sunt unități de cavalerie foarte rapide și puternice. Pot căra o cantitate mare de resurse, ceea ce le face și excelenți jefuitori.<br /><br />În apărare, abilitățile lor sunt cel mult medii.");
tz_def('MANUAL_UDESC_25', "Această unitate de cavalerie medie este excelentă în apărare. Scopul principal al Druidului călăreț este să apere împotriva infanteriei inamice. Costul și întreținerea sa sunt relativ ridicate.");
tz_def('MANUAL_UDESC_26', "Haeduanii sunt arma supremă a Galilor pentru atac și apărare împotriva cavaleriei. Puțini îi pot egala în aceste privințe.<br /><br />Totuși, antrenamentul și echipamentul lor sunt, de asemenea, foarte costisitoare. Consumă 3 unități de cereale pe oră, așa că trebuie să te gândești bine dacă merită.");
tz_def('MANUAL_UDESC_28', "Trebușetul este o excelentă armă cu rază lungă; este folosit pentru a distruge câmpurile și clădirile satelor inamice. Totuși, fără trupe de escortă este aproape lipsit de apărare, așa că nu uita să trimiți câteva trupe alături de el.<br /><br />Un punct de adunare de nivel înalt face catapultele mai precise și îți oferă posibilitatea de a ținti clădiri inamice suplimentare. Cu un punct de adunare de nivel 10, poate fi țintită orice clădire, cu excepția ascunzătorii, a pietrarilor și a capcanierului.<br />SFAT: Trebușetul care țintește la întâmplare POATE lovi ascunzătoarea, capcanierii sau pietrarii.");
tz_def('MANUAL_UDESC_29', "Fiecare trib are un luptător bătrân și experimentat a cărui prezență și ale cărui discursuri pot convinge populația satelor inamice să se alăture tribului său.<br /><br />Cu cât Căpetenia de clan vorbește mai des în fața zidurilor unui sat inamic, cu atât loialitatea acestuia scade, până când se alătură tribului Căpeteniei de clan.");
tz_def('MANUAL_UDESC_31', "Șobolanii sunt ieftini și se înmulțesc foarte repede, dar nu pot căra mare lucru.<br /><br />Este probabil cea mai ieftină dintre unitățile naturii și cea mai urâtă.");
tz_def('MANUAL_UDESC_44', "Natarii folosesc stoluri de păsări pentru a aduna informații despre dușmanii lor. Datorită avantajului cercetării din aer, este aproape imposibil să oprești escadroanele de cercetași natarieni; pe de altă parte, chiar și un sătean simplu poate observa cu ușurință stolurile țipătoare și împănate.");
tz_def('MANUAL_UDESC_41', "Sulițele lor lungi și ascuțite sunt folosite ca principală linie de apărare în orice bătălie. Sulițașii natarieni sunt războinici îndrăzneți și curajoși care își folosesc dexteritatea pentru a doborî rapid călăreții inamici și a-i răpune.");
tz_def('MANUAL_UDESC_42', "Prelungirile în formă de spini de pe coifurile, brățările și apărătorile de umăr ale armurii lor le dau Războinicilor cu spini numele. Bărbații care luptă pentru Natari ca Războinici cu spini sunt perseverenți și bine antrenați, oferind o bătălie sângeroasă oricui este destul de nesăbuit să îi atace.");
tz_def('MANUAL_UDESC_43', "Adorați de poporul lor și temuți de dușmani, Gardienii luptă fără cal, dar sunt totuși printre cei mai valoroși soldați din armata natariană, datorită versatilității lor. Sunt considerați luptători bine antrenați, lăsându-le inamicilor aproape nicio șansă de victorie. Datorită armurii lor grele, pot fi folosiți și ca trupe de apărare puternice și de încredere.");
tz_def('MANUAL_UDESC_45', "Miroase doar a moarte și putregai când Călăreții cu topor își înșeuază caii și se pregătesc de război. La fel de iscusit cum un țăran își folosește coasa pentru a secera, un Călăreț cu topor își rotește lama puternică. O singură lovitură este de obicei suficientă pentru a decapita un adversar și a-i face pe martori să strige de groază.");
tz_def('MANUAL_UDESC_46', "Doar cei mai pricepuți și mai puternici războinici ai Natarilor supraviețuiesc antrenamentului pentru a deveni Cavaler natarian. A-i vedea luptând te umple de uimire și arată ce înseamnă adevăratul război. Își mânuiesc lamele de parcă ar fi una cu brațele și mâinile lor și își folosesc scuturile parcă drept o prelungire firească a trupului. Chiar și caii pe care îi călăresc sunt crescuți și dresați special — niciun cal obișnuit nu ar putea purta armura pe care o poartă caii cavalerilor, cu atât mai puțin cavalerul însuși, și totuși să poată merge la luptă. Șoaptele despre gloria lor au ajuns până în cele mai îndepărtate regate, răspândind frică și groază.");
tz_def('MANUAL_UDESC_47', "Niciun alt trib în afară de Natari nu știe să folosească aceste creaturi impresionante în scopurile sale. Nici un zid, nici o palisadă nu pot rezista atacurilor Elefantului de război. O mașină de ucis ambulantă, care calcă în picioare tot ce încearcă să i se opună sau să-i stea în cale.");
tz_def('MANUAL_UDESC_48', "Chiar și ca ingineri, Natarii au avut mare succes. Au creat mașini de război cu mult înaintea tuturor și de atunci le-au perfecționat în toate privințele. Balista, o armă uriașă asemănătoare unei arbalete, își lansează proiectilele cu o asemenea forță încât niciun zid sau scut nu le poate devia. Când inginerii o demontează pentru a o muta pe următorul câmp de luptă, de obicei nu rămâne decât ruine acolo unde au lovit proiectilele.");
tz_def('MANUAL_UDESC_49', "Un amestec de frică pură, admirație și venerație îi cuprinde pe săteni atunci când Împăratul natarian le vorbește. Această figură impunătoare și bine echipată este pe deplin conștientă de efectul pe care îl are asupra celorlalți și știe cum să supună un sat întreg printr-o singură cuvântare.");
tz_def('MANUAL_UDESC_50', "Calfe îndrăznețe și maeștri constructori, mânați de pofta de acțiune și cunoscând fiecare mic secret despre cultivarea pământului, construirea Palatelor și fortificarea satelor, Colonii natarieni pleacă în grupuri de câte trei pentru a revendica pământ în numele stăpânilor lor natarieni.");

// ===== manual: new-features pages (PR-C) =====
tz_def('MANUAL_NF_ENABLED', "Activat");
tz_def('MANUAL_NF_DISABLED', "Dezactivat");
tz_def('MANUAL_NF_T_11', "Afișează oaza în profil");
tz_def('MANUAL_NF_T_12', "Mesaj de invitație în alianță");
tz_def('MANUAL_NF_T_13', "Noi mecanici de alianță și ambasadă");
tz_def('MANUAL_NF_T_14', "Mesaj de postare nouă pe forum");
tz_def('MANUAL_NF_T_15', "Imagini ale triburilor în profil");
tz_def('MANUAL_NF_T_16', "Imagini ale MH în profil");
tz_def('MANUAL_NF_T_17', "Afișează artefactul în profil");
tz_def('MANUAL_NF_T_18', "Afișează Minunea Lumii în profil");
tz_def('MANUAL_NF_T_20', "Țintele catapultelor");
tz_def('MANUAL_NF_T_21', "Manual despre Natură și Natari");
tz_def('MANUAL_NF_T_22', "Plasarea linkurilor directe");
tz_def('MANUAL_NF_T_23', "Medalie Jucător Veteran");
tz_def('MANUAL_NF_T_24', "Medalie Jucător Veteran 5 ani");
tz_def('MANUAL_NF_T_25', "Medalie Jucător Veteran 10 ani");
tz_def('MANUAL_NF_T_26', "Medalii speciale");
tz_def('MANUAL_NF_D_11', "Dacă în sat există o oază capturată, aceasta va fi afișată în profilul jucătorului în dreptul satului corespunzător, cu tipul de resursă corespunzător și un bonus de producție. Această funcție a fost prezentată în Travian T4.");
tz_def('MANUAL_NF_D_12', "Dacă unui jucător i se trimite o invitație de a se alătura alianței, acesta va fi notificat printr-un mesaj în joc.");
tz_def('MANUAL_NF_D_13', "<h2>Introducere</h2><br> Mecanicile Ambasadei și ale Alianței mi s-au părut întotdeauna un pic ca o trișare. În special pentru că clădirea Ambasadei are o anumită „capacitate”, ceea ce înseamnă că doar 3/6/9/12/... și până la 60 de membri puteau face parte din alianță, în funcție de nivelul Ambasadei tale. <br><br> Toate acestea sunt foarte frumoase, dar odată ce aveai o Ambasadă la nivelul 20 și ajungeai la 60 de membri ai alianței, erai liber să demolezi complet clădirea fără să se întâmple nimic. Nu puteai schimba alianța, dar cam asta era tot. Proprietatea de capacitate a Ambasadei nu se mai aplica. Dacă s-ar fi aplicat, nu ai fi putut să o demolezi nici măcar cu un singur nivel până la 19 — pentru că, având 60 de membri compleți, Ambasada nu i-ar mai fi putut găzdui la nivelul 19. <br><br> Așa că am decis să condimentez puțin jocul, făcând din Ambasadă o piesă de șah ceva mai vizibilă pe tablă. <br><br> <h2>Mecanici noi</h2><br> Pentru a face lucrurile interesante, am dezvoltat un set complet nou de reguli pentru demolarea și distrugerea în luptă a Ambasadei. Este puțin complicat, dar de fapt reflectă perfect proprietatea de „capacitate” a alianței. <br><br> Principala schimbare este că jucătorii nu își pot demola cu adevărat Ambasadele fără efectul secundar de a fi pedepsiți odată ce aceasta scade prea mult. Pentru un membru al alianței, asta ar însemna că Ambasada sa nu trebuie să scadă niciodată sub nivelul 1. Dacă se întâmplă, este avertizat și ulterior eliminat din alianța sa. <br><br> În mod similar, pentru fondatorii de alianță, acest lucru reprezintă o provocare și mai mare, deoarece ei sunt cei care trebuie să mențină alianța funcționând fără probleme. Pentru ei, demolarea unei Ambasade nu va fi permisă sub un nivel care poate găzdui în continuare numărul actual de membri ai alianței. <br><br> În situația deosebită în care alți jucători/alianțe atacă efectiv satul fondatorului unde se află Ambasada sa și apoi țintesc acea Ambasadă cu catapultele și berbecii lor — această situație poate aduce o mulțime de necazuri. Dacă nu există alte Ambasade în satele altor fondatori la un nivel suficient pentru a găzdui toți membrii alianței, alianța ar putea fi dispersată. Singura excepție ar fi dacă oricare alt membru al alianței ar avea o Ambasadă suficient de dezvoltată — caz în care acel membru va fi ales automat într-o poziție de conducere și va salva alianța. Dacă nu se găsește un astfel de jucător, alianța va fi complet dispersată. <br><br> <h2>Informații detaliate</h2><br> Pentru informații mai vizuale și mai detaliate despre cum funcționează acest nou sistem, poți vizita această <a href=\"https://docs.google.com/presentation/d/1KN1qVAlxVj7aAN6F9QkRai1oliajfxKPIaJ4MSodUac/edit#slide=id.p\" target=\"_blank\">Prezentare Google</a>.");
tz_def('MANUAL_NF_D_14', "Dacă jucătorul lasă cel puțin un mesaj într-un fir de discuții de pe forum, va primi mesaje în joc care îl anunță că altcineva a lăsat un mesaj nou în același fir (adică este, din punct de vedere tehnic, „abonat”).");
tz_def('MANUAL_NF_D_15', "Folosind această inovație, orice jucător poate adăuga la descrierea profilului său o imagine a tribului său cu o scurtă descriere (Romani, Teutoni, Gali).");
tz_def('MANUAL_NF_D_16', "De fapt, pentru jucători această funcție este inutilă, deoarece este destinată doar Administratorilor și Multihunterilor. Cu ajutorul ei, Administratorii și Multihunterii vor putea adăuga la descrierile profilurilor lor diverse imagini interesante însoțite de descrieri.");
tz_def('MANUAL_NF_D_17', "Dacă într-unul dintre sate există un artefact, acesta va fi afișat în profilul jucătorului în dreptul satului corespunzător în care se află. Această funcție a fost prezentată în Travian T4.");
tz_def('MANUAL_NF_D_18', "Dacă în sat există un loc pentru construirea Minunii Lumii, acesta va fi afișat în profil în dreptul satului corespunzător. Această funcție a fost prezentată în Travian T4.");
tz_def('MANUAL_NF_D_19', "Modul vacanță îți permite să îți protejezi imperiul de orice acțiune ostilă a altor jucători în timpul absenței tale îndelungate. Este adevărat, există anumite condiții care vor duce la o întârziere în dezvoltarea imperiului tău. Această funcție a fost prezentată în Travian T4.");
tz_def('MANUAL_NF_D_20', "Dacă trimiți catapultele într-un atac normal, poți vedea în punctul de adunare ce ținte ai stabilit pentru atac. Această funcție a fost prezentată în Travian T4.");
tz_def('MANUAL_NF_D_21', "Cu ajutorul acestor informații din manual, poți găsi o descriere a forțelor Naturii și ale Natarilor.");
tz_def('MANUAL_NF_D_22', "Locația linkurilor directe se schimbă. În Travian T3.6 original, linkurile directe sunt plasate în meniul din dreapta, sub lista satelor, ceea ce nu este pe deplin convenabil. Dacă această opțiune este activată, linkurile directe vor fi plasate în meniul din stânga, ceea ce este mult mai convenabil.");
tz_def('MANUAL_NF_D_23', "Medalie acordată jucătorilor care folosesc aceeași adresă de e-mail de 3 ani sau mai mult. Poate fi adăugată la descrierea profilului. Această funcție a fost prezentată în Travian T4.");
tz_def('MANUAL_NF_D_24', "Medalie acordată jucătorilor care folosesc aceeași adresă de e-mail de 5 ani sau mai mult. Poate fi adăugată la descrierea profilului. Această funcție a fost prezentată în Travian T4.");
tz_def('MANUAL_NF_D_25', "Medalie acordată jucătorilor care folosesc aceeași adresă de e-mail de 10 ani sau mai mult. Poate fi adăugată la descrierea profilului. Această funcție a fost prezentată în Travian T4.");
tz_def('MANUAL_NF_D_26', "Medalie acordată jucătorilor care folosesc aceeași adresă de e-mail de 10 ani sau mai mult. Poate fi adăugată la descrierea profilului. Această funcție a fost prezentată în Travian T4.");

// ===== Server Milestones (NEW_FUNCTIONS_MILESTONES) =====
tz_def('TZ_SERVER_MILESTONES', 'Recorduri de Server');
tz_def('TZ_MILESTONE_NOT_YET', 'Neatins încă');
tz_def('TZ_MILESTONE_SECOND_VILLAGE', 'Primul care a fondat al 2-lea sat');
tz_def('TZ_MILESTONE_POPULATION_1000', 'Primul care a atins 1.000 populație');
tz_def('TZ_MILESTONE_FIRST_ARTIFACT', 'Primul care a capturat un artefact');
tz_def('TZ_MILESTONE_FIRST_WW', 'Primul care a cucerit un Wonder of the World');
tz_def('TZ_MILESTONE_FIRST_WW_PLAN', 'Primul care a cucerit un Plan WW');
tz_def('TZ_MILESTONE_FIRST_ALLIANCE', 'Prima alianță fondată');
tz_def('TZ_MILESTONE_FIRST_PVP_CONQUEST', 'Primul sat cucerit de la un jucător');
tz_def('TZ_MILESTONE_FIVE_VILLAGES', 'Primul care a fondat 5 sate');
tz_def('TZ_MILESTONE_FOUNDED_BY', 'Fondată de');
tz_def('TZ_MILESTONE_HERO_MASTER', 'Primul Erou Maestru (echipament complet tier 3)');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// COMPLETARE 1:1 dupa en.php - Hero T4, triburi noi, milestones, Waterworks (revizuieste traducerile)
//////////////////////////////////////////////////////////////////////////////////////////////////////

// Hero battle bonus - texte descriptive
tz_def('HB_TXT_ARTWORK',    'Puncte de cultura egale cu productia ta zilnica');
tz_def('HB_TXT_BANDAGE_A',  'Vindeca');
tz_def('HB_TXT_BANDAGE_B',  'din trupele cazute ale eroului dupa lupta');
tz_def('HB_TXT_BOOK',       'Reseteaza punctele de atribut ale eroului');
tz_def('HB_TXT_BUCKET',     'Invie instant eroul, fara cost');
tz_def('HB_TXT_CAGE',       'Captureaza 1 animal de oaza per cusca');
tz_def('HB_TXT_CP',         'puncte de cultura pe zi');
tz_def('HB_TXT_DMG',        'daune primite de erou');
tz_def('HB_TXT_FIGHT',      'forta de lupta');
tz_def('HB_TXT_HERO',       'erou');
tz_def('HB_TXT_HORSE',      'campuri/ora viteza erou');
tz_def('HB_TXT_MOUNT',      'campuri/ora calare');
tz_def('HB_TXT_NEEDS_HORSE','necesita un cal echipat');
tz_def('HB_TXT_OINTMENT',   'Vindeca 1% din viata eroului per unitate (max 99%)');
tz_def('HB_TXT_ONLY',       'doar pentru un');
tz_def('HB_TXT_PER',        'per');
tz_def('HB_TXT_RAID',       'resurse jefuite');
tz_def('HB_TXT_REGEN',      'HP pe zi');
tz_def('HB_TXT_RETURN',     'viteza de intoarcere a trupelor');
tz_def('HB_TXT_SCROLL',     'experienta eroului fiecare');
tz_def('HB_TXT_SPEED20',    'viteza trupelor peste 20 de campuri');
tz_def('HB_TXT_SPEED_ALLY', 'viteza intre satele aliantei');
tz_def('HB_TXT_SPEED_OWN',  'viteza intre satele proprii');
tz_def('HB_TXT_TABLET',     '+1% loialitate sat propriu fiecare (max 125%)');
tz_def('HB_TXT_TRAIN_CAV',  'timp de instruire cavalerie');
tz_def('HB_TXT_TRAIN_INF',  'timp de instruire infanterie');
tz_def('HB_TXT_UNIT_DEF',   'aparare');
tz_def('HB_TXT_UNIT_OFF',   'atac');
tz_def('HB_TXT_VS_NATARS',  'forta impotriva Natarilor');
tz_def('HB_TXT_XP',         'experienta');

// Hero - aventuri
tz_def('HERO_ADV_AMOUNT',        'Cantitate');
tz_def('HERO_ADV_DIED',          'Eroul tau a cazut pe');
tz_def('HERO_ADV_DIED_INFO',     'Toata prada a fost pierduta. Eroul poate fi inviat la Resedinta Eroului.');
tz_def('HERO_ADV_DIFFICULTY',    'Dificultate');
tz_def('HERO_ADV_DIFF_HARD',     'Grea');
tz_def('HERO_ADV_DIFF_NORMAL',   'Normala');
tz_def('HERO_ADV_PLACE', 'Loc');
tz_def('HERO_ADV_DANGER', 'Pericol');
tz_def('HERO_ADV_LINK', 'Actiune');
tz_def('HERO_ADV_DURATION',      'Timp de calatorie (dus)');
tz_def('HERO_ADV_EXPIRES',       'Expira in');
tz_def('HERO_ADV_GO',            'Incepe aventura');
tz_def('HERO_ADV_HARD',          'o aventura grea');
tz_def('HERO_ADV_HP_LOST',       'Viata pierduta');
tz_def('HERO_ADV_ITEM_FOUND',    'Obiect gasit');
tz_def('HERO_ADV_LIST',          'Aventuri disponibile');
tz_def('HERO_ADV_MOV_BACK',  'Erou care se intoarce dintr-o aventura');
tz_def('HERO_ADV_MOV_OUT',   'Erou plecat in aventura');
tz_def('HERO_ADV_MOV_SHORT', 'Aventura');
tz_def('HERO_ADV_NONE',          'Nicio aventura disponibila acum. Apar altele in timp.');
tz_def('HERO_ADV_NORMAL',        'o aventura normala');
tz_def('HERO_ADV_RETURNED',      'Eroul tau s-a intors din');
tz_def('HERO_ADV_REWARD',        'Recompensa');
tz_def('HERO_ADV_RUNNING',       'Eroul tau este intr-o aventura si va ajunge in');
tz_def('HERO_ADV_START_AWAY',    'Eroul tau nu este acasa.');
tz_def('HERO_ADV_START_FAIL',    'Aceasta aventura nu mai este disponibila.');
tz_def('HERO_ADV_START_NOHERO',  'Ai nevoie de un erou in viata pentru a incepe o aventura.');
tz_def('HERO_ADV_START_OK',      'Eroul tau a pornit in aventura.');

// Hero - casa de licitatii
tz_def('HERO_AUC_BID',           'Oferta');
tz_def('HERO_AUC_BID_FAIL',      'Oferta ta nu a fost acceptata.');
tz_def('HERO_AUC_BID_NOSILVER',  'Nu ai suficient argint pentru aceasta oferta.');
tz_def('HERO_AUC_BID_OK',        'Oferta ta a fost plasata. Esti ofertantul cel mai mare.');
tz_def('HERO_AUC_BID_OUTBID',    'Oferta ta a fost imediat depasita de un maxim mai mare.');
tz_def('HERO_AUC_DURATION',      'Durata');
tz_def('HERO_AUC_EXPIRED',       'Licitatia ta s-a incheiat fara oferte. Obiectul a fost returnat in inventar:');
tz_def('HERO_AUC_FEE',           'Taxa de licitatie');
tz_def('HERO_AUC_FINAL_PRICE',   'Pret final');
tz_def('HERO_AUC_ITEM',          'Obiect');
tz_def('HERO_AUC_LIST',          'Listeaza obiect');
tz_def('HERO_AUC_MY_BIDS',       'Ofertele mele');
tz_def('HERO_AUC_MY_SALES',      'Vanzarile mele');
tz_def('HERO_AUC_NONE',          'Nu exista licitatii deschise in acest moment.');
tz_def('HERO_AUC_OPEN',          'Licitatii deschise');
tz_def('HERO_AUC_PAYOUT',        'Plata');
tz_def('HERO_AUC_PRICE',         'Pret curent');
tz_def('HERO_AUC_REFUND',        'Rambursat din oferta ta maxima');
tz_def('HERO_AUC_SELL',          'Vinde un obiect');
tz_def('HERO_AUC_SELLER_NPC',    'Negustor');
tz_def('HERO_AUC_SELL_FAIL',     'Acest obiect nu poate fi listat (obiectele echipate trebuie scoase intai).');
tz_def('HERO_AUC_SELL_OK',       'Obiectul tau a fost listat.');
tz_def('HERO_AUC_SOLD',          'Licitatia ta s-a vandut:');
tz_def('HERO_AUC_START_PRICE',   'Pret de pornire');
tz_def('HERO_AUC_TIME_LEFT',     'Se incheie');
tz_def('HERO_AUC_WON',           'Ai castigat licitatia pentru');
tz_def('HERO_AUC_YOUR_MAX',      'Maximul tau');

// Hero - echipare / inventar
tz_def('HERO_EQUIP',             'Echipeaza');
tz_def('HERO_LOCKED_NOHERO', 'Nu ai inca un erou. Antreneaza unul in Resedinta Eroului inainte de a echipa iteme.');
tz_def('HERO_EQUIP_FAIL',        'Acest obiect nu poate fi echipat (unitate de erou gresita sau tip de obiect gresit).');
tz_def('HERO_EQUIP_OK',          'Obiect echipat.');
tz_def('HERO_EXPERIENCE',        'Experienta');
tz_def('HERO_ITEMS_BAG',         'Inventar');
tz_def('HERO_ITEMS_EMPTY',       'Eroul tau nu detine inca niciun obiect. Aventurile si casa de licitatii sunt locuri bune de gasit.');
tz_def('HERO_ITEMS_EQUIPPED',    'Echipat');
tz_def('HERO_ITEM_USED_OK',      'Obiectul a fost folosit.');
tz_def('HERO_ITEM_USE_BATTLE',   'Acest obiect se foloseste automat (bandajele vindeca trupele care se intorc dupa lupta).');
tz_def('HERO_ITEM_USE_FAIL',     'Acest obiect nu poate fi folosit acum.');
tz_def('HERO_QUANTITY',          'Cantitate');
tz_def('HERO_RELEASE_ANIMALS', 'Elibereaza');
tz_def('HERO_RELEASE_CONFIRM', 'Eliberezi aceste animale? Vor disparea definitiv.');
tz_def('HERO_EXCHANGE', 'Casa de schimb');
tz_def('HERO_EXCHANGE_G2S', 'Aur in argint');
tz_def('HERO_EXCHANGE_S2G', 'Argint in aur');
tz_def('HERO_EXCHANGE_OK', 'Schimb efectuat.');
tz_def('HERO_EXCHANGE_NOTENOUGH', 'Nu ai suficient pentru acest schimb.');
tz_def('HERO_EXCHANGE_FAIL', 'Schimbul nu a putut fi efectuat.');
tz_def('HERO_EXCHANGE_HINT', 'Introduci suma pe care o dai. Argintul ramas sub o unitate de aur ramane la tine.');
tz_def('HERO_RES_PRODUCTION', 'Resurse');
tz_def('HERO_RES_TYPE', 'Resursa produsa');
tz_def('HERO_RES_ALL', 'Toate resursele');
tz_def('HERO_RES_TYPE_HINT', 'Se poate schimba oricand, gratuit.');
tz_def('HERO_SILVER',            'Argint');
tz_def('HERO_SLOT_1', 'Coif');
tz_def('HERO_SLOT_2', 'Armura');
tz_def('HERO_SLOT_3', 'Mana dreapta');
tz_def('HERO_SLOT_4', 'Mana stanga');
tz_def('HERO_SLOT_5', 'Incaltaminte');
tz_def('HERO_SLOT_6', 'Cal');
tz_def('HERO_SLOT_7', 'Desaga');
tz_def('HERO_T4_TAB_OASIS',      'Oaze');
tz_def('HERO_T4_TAB_ADVENTURES', 'Aventuri');
tz_def('HERO_T4_TAB_AUCTION',    'Licitatii');
tz_def('HERO_T4_TAB_HERO',       'Erou');
tz_def('HERO_T4_TAB_ITEMS',      'Inventar');
tz_def('HERO_UNEQUIP',           'Scoate');
tz_def('HERO_UNEQUIP_OK',        'Obiect scos.');
tz_def('HERO_USE_ITEM',          'Foloseste');

// Oaza / Waterworks
tz_def('OASIS_EFFECTIVE_BONUS', 'Bonus efectiv de oaza:');
tz_def('WATERWORKS_AFFECTED', 'oazele anexate beneficiaza de acest bonus.');
tz_def('WATERWORKS_HINT', '(Amplificat de Uzina de Apa)');

// Triburi noi
tz_def('TRIBE6', 'Huni');
tz_def('TRIBE7', 'Egipteni');
tz_def('TRIBE8', 'Spartani');
tz_def('TRIBE9', 'Vikingi');

// Rapoarte / notificari erou + licitatii
tz_def('TZ_RT_ADV_FELL',         'Eroul a cazut intr-o aventura');
tz_def('TZ_RT_ADV_RETURNED',     'Eroul s-a intors dintr-o aventura');
tz_def('TZ_RT_AUC_EXPIRED',      'Licitatie expirata');
tz_def('TZ_RT_AUC_SOLD',         'Licitatie vanduta');
tz_def('TZ_RT_AUC_WON',          'Licitatie castigata');

// Statistici - cei mai mari pe trib
tz_def('TZ_THE_LARGEST_EGYPTIANS', 'Cei mai mari Egipteni');
tz_def('TZ_THE_LARGEST_HUNS', 'Cei mai mari Huni');
tz_def('TZ_THE_LARGEST_SPARTANS', 'Cei mai mari Spartani');
tz_def('TZ_THE_LARGEST_VIKINGS', 'Cei mai mari Vikingi');

// Unitati Huni (51-60)
tz_def('U51', 'Razboinic Hun');
tz_def('U52', 'Calaret Cercetas');
tz_def('U53', 'Arcas Calare');
tz_def('U54', 'Calaret al Stepei');
tz_def('U55', 'Lancier Hun');
tz_def('U56', 'Calaret de Elita');
tz_def('U57', 'Berbec');
tz_def('U58', 'Catapulta');
tz_def('U59', 'Capetenie de Trib');
tz_def('U60', 'Colonist Hun');

// Unitati Egipteni (61-70)
tz_def('U61', 'Sclav Inarmat');
tz_def('U62', 'Luptator Egiptean');
tz_def('U63', 'Gardian al Templului');
tz_def('U64', 'Cercetas Calare');
tz_def('U65', 'Car de Lupta');
tz_def('U66', 'Car de Lupta Regal');
tz_def('U67', 'Berbec');
tz_def('U68', 'Catapulta');
tz_def('U69', 'Nomarh');
tz_def('U70', 'Colonist Egiptean');

// Unitati Spartani (71-80)
tz_def('U71', 'Hoplit Spartan');
tz_def('U72', 'Razboinic Agoge');
tz_def('U73', 'Homoioi');
tz_def('U74', 'Cercetas Perioikoi');
tz_def('U75', 'Calaret Spartan');
tz_def('U76', 'Hippeis');
tz_def('U77', 'Berbec');
tz_def('U78', 'Catapulta');
tz_def('U79', 'Efor');
tz_def('U80', 'Colonist Spartan');

// Unitati Vikingi (81-90)
tz_def('U81', 'Jefuitor Viking');
tz_def('U82', 'Cercetas Viking');
tz_def('U83', 'Luptator cu Toporul');
tz_def('U84', 'Berserker');
tz_def('U85', 'Calaret Viking');
tz_def('U86', 'Huscarl');
tz_def('U87', 'Berbec');
tz_def('U88', 'Catapulta');
tz_def('U89', 'Jarl');
tz_def('U90', 'Colonist Viking');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - etichete de meniu si titluri de pagina
// (erau scrise direct in Admin/admin.php, deci meniul ramanea in engleza)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADMIN_LOGOUT', 'Deconectare');
tz_def('ADMIN_SERVER_HOMEPAGE', 'Pagina serverului');
tz_def('ADMIN_CONTROL_PANEL_HOME', 'Panoul principal');
tz_def('ADMIN_RETURN_TO_THE_SERVER', 'Inapoi la server');
tz_def('ADMIN_SERVER_INFO', 'Informatii server');
tz_def('ADMIN_ONLINE_USERS', 'Jucatori conectati');
tz_def('ADMIN_PLAYERS_NOT_ACTIVATED', 'Jucatori neactivati');
tz_def('ADMIN_PLAYERS_INACTIVATE', 'Jucatori inactivi');
tz_def('ADMIN_PLAYERS_REPORT', 'Reclamatii jucatori');
tz_def('ADMIN_PLAYERS_MESSAGE', 'Mesaje jucatori');
tz_def('ADMIN_MAP', 'Harta');
tz_def('ADMIN_MAP_TILE', 'Casuta de harta');
tz_def('ADMIN_NATARS_MANAGEMENT', 'Administrare Natari');
tz_def('ADMIN_SEARCH', 'Cautare');
tz_def('ADMIN_GENERAL_SEARCH', 'Cautare generala');
tz_def('ADMIN_SEARCH_IGMS_REPORTS', 'Cauta mesaje/rapoarte');
tz_def('ADMIN_MESSAGES', 'Mesaje');
tz_def('ADMIN_CREATE_MASS_MESSAGE', 'Creeaza mesaj in masa');
tz_def('ADMIN_CREATE_SYSTEM_MESSAGE', 'Creeaza mesaj de sistem');
tz_def('ADMIN_BAN', 'Blocare');
tz_def('ADMIN_BAN_UNBAN_PLAYERS', 'Blocare/deblocare jucatori');
tz_def('ADMIN_CLEAN_BANLIST_DATA', 'Curata lista de blocari');
tz_def('ADMIN_GOLD', 'Aur');
tz_def('ADMIN_GIVE_ALL_FREE_GOLD', 'Ofera aur tuturor');
tz_def('ADMIN_GIVE_FREE_GOLD_TO_SPECIFIC_USER', 'Ofera aur unui jucator');
tz_def('ADMIN_GOLD_SHOP_PROMO_CODES', 'Magazin de aur si coduri promo');
tz_def('ADMIN_RESET_GOLD', 'Reseteaza aurul');
tz_def('ADMIN_PLUS_RES_BONUS', 'Plus si bonus de resurse');
tz_def('ADMIN_GIVE_ALL_PLUS', 'Ofera Plus tuturor');
tz_def('ADMIN_RESET_PLUS', 'Reseteaza Plus');
tz_def('ADMIN_GIVE_ALL_RES_BONUS', 'Ofera bonus de resurse tuturor');
tz_def('ADMIN_RESET_RES_BONUS', 'Reseteaza bonusul de resurse');
tz_def('ADMIN_USERS', 'Jucatori');
tz_def('ADMIN_LIST_USERS', 'Lista jucatorilor');
tz_def('ADMIN_CREATE_USERS', 'Creeaza jucatori');
tz_def('ADMIN_MULTI_ACCOUNT_DETECTION', 'Detectare conturi multiple');
tz_def('ADMIN_PUSH_PROTECTION', 'Protectie anti-push');
tz_def('ADMIN_REGISTRATION_BLOCKLIST', 'Lista de blocare la inregistrare');
tz_def('ADMIN_ADMIN', 'Administrare');
tz_def('ADMIN_ADMIN_LOG', 'Jurnal de administrare');
tz_def('ADMIN_QUEST_EDITOR', 'Editor de misiuni');
tz_def('ADMIN_WORLD_MAP_HEATMAP', 'Harta termica a lumii');
tz_def('ADMIN_DEBUG_ERROR_LOG', 'Jurnal de erori');
tz_def('ADMIN_SERVER_SETTINGS', 'Setari server');
tz_def('ADMIN_SERVER_MAINTENANCE', 'Mentenanta server');
tz_def('ADMIN_SERVER_RESETTING', 'Resetare server');
tz_def('ADMIN_IN_GAME_MESSAGES', 'Mesaje in joc');
tz_def('ADMIN_MSG_REP', 'Mesaje/Rapoarte');
tz_def('ADMIN_MASS_MESSAGE', 'Mesaj in masa');
tz_def('ADMIN_SYSTEM_MESSAGE', 'Mesaj de sistem');
tz_def('ADMIN_DELETE_PLAYER_MEDALS', 'Sterge medaliile jucatorului');
tz_def('ADMIN_DELETE_ALLY_MEDALS', 'Sterge medaliile aliantei');
tz_def('ADMIN_USERS_LIST', 'Lista jucatorilor');
tz_def('ADMIN_SERVER_CONFIGURATION', 'Configurare server');
tz_def('ADMIN_CRON_AUTOMATION', 'Cron si automatizare');
tz_def('ADMIN_PLUS_SETTINGS', 'Setari PLUS');
tz_def('ADMIN_LOG_SETTINGS', 'Setari jurnale');
tz_def('ADMIN_NEWSBOX_SETTINGS', 'Setari NewsBox');
tz_def('ADMIN_NEW_FUNCTIONS_SETTINGS', 'Setari functii noi');
tz_def('ADMIN_EXTRA_SETTINGS', 'Setari suplimentare');
tz_def('ADMIN_EDIT_ADMIN_INFORMATION', 'Editeaza informatiile de administrator');
tz_def('ADMIN_PLAYER_DETAILS', 'Detalii jucator');
tz_def('ADMIN_EDIT_PLAYER', 'Editeaza jucatorul');
tz_def('ADMIN_DELETE_PLAYER', 'Sterge jucatorul');
tz_def('ADMIN_COMPOSE_MESSAGE', 'Compune mesaj');
tz_def('ADMIN_EDIT_PLUS_RESOURCES', 'Editeaza Plus si resurse');
tz_def('ADMIN_EDIT_SITTERS', 'Editeaza inlocuitorii');
tz_def('ADMIN_EDIT_PASSWORD', 'Editeaza parola');
tz_def('ADMIN_EDIT_PROTECTION', 'Editeaza protectia');
tz_def('ADMIN_EDIT_OFF_DEF', 'Editeaza atac si aparare');
tz_def('ADMIN_EDIT_WEEKLY_OFF_DEF', 'Editeaza atac si aparare saptamanal');
tz_def('ADMIN_USER_LOGINS', 'Autentificarile jucatorului');
tz_def('ADMIN_USER_ILLEGALS_LOG', 'Jurnal de nereguli');
tz_def('ADMIN_EDIT_HERO', 'Editeaza eroul');
tz_def('ADMIN_T4_HERO_CONTROLS', 'Control erou T4');
tz_def('ADMIN_EDIT_ADDITIONAL_INFO', 'Editeaza informatii suplimentare');
tz_def('ADMIN_EDIT_VILLAGE', 'Editeaza satul');
tz_def('ADMIN_EDIT_RESOURCES', 'Editeaza resursele');
tz_def('ADMIN_EDIT_TROOPS', 'Editeaza trupele');
tz_def('ADMIN_UPGRADE_TROOPS', 'Imbunatateste trupele');
tz_def('ADMIN_ALLIANCE', 'Alianta');
tz_def('ADMIN_EDIT_ALLIANCE', 'Editeaza alianta');
tz_def('ADMIN_DELETE_ALLIANCE', 'Sterge alianta');
tz_def('ADMIN_BUILD_LOG', 'Jurnal de constructii');
tz_def('ADMIN_RESEARCH_LOG', 'Jurnal de cercetare');
tz_def('ADMIN_NO_PLAYER', 'niciun jucator');
tz_def('ADMIN_NO_VILLAGE', 'niciun sat');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - sabloane (lot 1: home, server_info, online, users,
// search, ban, notregistered, inactive, report, msg)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_HELLO', 'Salut');
tz_def('ADM_TOTAL_PLAYERS', 'Total jucatori');
tz_def('ADM_ONLINE_NOW', 'Online acum');
tz_def('ADM_LAST_5_MIN', 'ultimele 5 minute');
tz_def('ADM_VILLAGES', 'Sate');
tz_def('ADM_GOLD_IN_GAME', 'Aur in joc');
tz_def('ADM_ACTIVE_BANS', 'Blocari active');
tz_def('ADM_MANAGE', 'administreaza');
tz_def('ADM_LAST_REGISTRATION', 'Ultima inregistrare');
tz_def('ADM_SERVER_CLOCK', 'Ceasul serverului');
tz_def('ADM_SERVER_TIMELINE', 'Cronologia serverului');
tz_def('ADM_START_DATE', 'Data de start:');
tz_def('ADM_NATARS_C', 'Natari:');
tz_def('ADM_ARTEFACTS_C', 'Artefacte:');
tz_def('ADM_WW_PLANS_C', 'Planuri MdL:');
tz_def('ADM_SERVER_AGE', 'Vechimea serverului:');
tz_def('ADM_NEXT_EVENT', 'Urmatorul eveniment:');
tz_def('ADM_LAST_5_ACTIONS', 'Ultimele 5 actiuni');
tz_def('ADM_VIEW_FULL_LOG', 'vezi jurnalul →');
tz_def('ADM_QUICK_ACTIONS', 'Actiuni rapide');
tz_def('ADM_QA_SEARCH', '🔍 Cauta jucator');
tz_def('ADM_QA_BAN', '🔨 Blocari');
tz_def('ADM_QA_MAP', '🗺 Harta');
tz_def('ADM_QA_NATARS', '🏰 Natari');
tz_def('ADM_QA_ADD_USER', '👤 Adauga jucator');
tz_def('ADM_QA_SERVER_INFO', '⚙ Informatii server');
tz_def('ADM_WORLD_INFO', '🌍 Informatii despre lume');
tz_def('ADM_REGISTERED_PLAYERS', 'Jucatori inregistrati');
tz_def('ADM_ACTIVE_PLAYERS', 'Jucatori activi');
tz_def('ADM_PLAYERS_ONLINE', 'Jucatori conectati');
tz_def('ADM_PLAYERS_BANNED', 'Jucatori blocati');
tz_def('ADM_VILLAGES_SETTLED', 'Sate intemeiate');
tz_def('ADM_TOTAL_POPULATION', 'Populatie totala');
tz_def('ADM_PLAYER_DISTRIBUTION', '👥 Distributia jucatorilor');
tz_def('ADM_SERVER_ECONOMY', '💰 Economia serverului');
tz_def('ADM_TOTAL_GOLD', 'Aur total');
tz_def('ADM_AVG_GOLD', 'Aur mediu/jucator');
tz_def('ADM_SERVER_STARTED', 'Server pornit');
tz_def('ADM_UPTIME', 'Timp de functionare');
tz_def('ADM_TROOPS_ON_SERVER', '⚔️ Trupe pe server (sate + intariri)');
tz_def('ADM_ONLINE_USERS_H', '🟢 Jucatori conectati');
tz_def('ADM_NO_ONLINE_USERS', 'Niciun jucator conectat in ultimele 5 minute');
tz_def('ADM_USERS_H', '👥 Jucatori');
tz_def('ADM_ALL', 'Toti');
tz_def('ADM_ADMINS', 'Administratori');
tz_def('ADM_NORMAL', 'Normali');
tz_def('ADM_BANNED', 'Blocati');
tz_def('ADM_ONLINE', 'Conectati');
tz_def('ADM_ID', 'ID');
tz_def('ADM_USERNAME', 'Nume utilizator');
tz_def('ADM_EMAIL', 'E-mail');
tz_def('ADM_ACCESS', 'Acces');
tz_def('ADM_TRIBE', 'Trib');
tz_def('ADM_GOLD', 'Aur');
tz_def('ADM_LAST_ACTIVITY', 'Ultima activitate');
tz_def('ADM_PREV', '« Inapoi');
tz_def('ADM_NEXT', 'Inainte »');
tz_def('ADM_SEARCH_PH', 'Cauta...');
tz_def('ADM_ADMIN_SEARCH', 'Cautare');
tz_def('ADM_SEARCH_HINT', 'Nume, ID, e-mail sau IP...');
tz_def('ADM_SEARCH_BTN', 'Cauta');
tz_def('ADM_BAN_MANAGEMENT', 'Administrare blocari');
tz_def('ADM_ACTIVE_USER_BANS', 'Jucatori blocati');
tz_def('ADM_ACTIVE_IP_BANS', 'IP-uri blocate');
tz_def('ADM_HISTORY_50', 'Istoric (ultimele 50)');
tz_def('ADM_ADD_NEW_BAN', 'Blocare noua');
tz_def('ADM_FOREVER', 'Permanent');
tz_def('ADM_BAN_USER', 'Blocheaza jucatorul');
tz_def('ADM_BAN_IP_ADDRESS', 'Blocheaza o adresa IP');
tz_def('ADM_BAN_IP', 'Blocheaza IP-ul');
tz_def('ADM_BAN_HISTORY', 'Istoricul blocarilor');
tz_def('ADM_USER_ID', 'ID jucator');
tz_def('ADM_IPV4_OR_IPV6', 'IPv4 sau IPv6');
tz_def('ADM_NOT_ACTIVATED_H', '✉️ Jucatori neactivati');
tz_def('ADM_ACTIVATION_CODE', 'Cod de activare');
tz_def('ADM_ACT2', 'Act2');
tz_def('ADM_TIME', 'Ora');
tz_def('ADM_SEARCH_USER_EMAIL', 'Cauta username sau email...');
tz_def('ADM_INACTIVE_USERS', 'Jucatori inactivi');
tz_def('ADM_DELETE_L', 'sterge');
tz_def('ADM_BACK_TO_REPORTS', '← Inapoi la rapoarte');
tz_def('ADM_REPORT', 'Raport');
tz_def('ADM_VIEW_ARROW', 'vezi →');
tz_def('ADM_BACK_TO_MESSAGES', '← Inapoi la mesaje');
tz_def('ADM_SENT_TO', 'Trimis catre');
tz_def('ADM_MESSAGE', 'Mesaj');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - sabloane (lot 2: config, editServerSet, editNewFunctions,
// editCronSet, editPlusSet, editLogSet, editNewsboxSet, editExtraSet)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_CRON_AUTOMATION', 'Cron si automatizare');
tz_def('ADM_AUTOMATION_SOURCE', 'Sursa automatizarii');
tz_def('ADM_WHERE_THE_GAME_TICK_BATTLES_MOVEMENTS_TRAINI', 'De unde se proceseaza tick-ul jocului (batalii, miscari, instruire, constructii). Cand cron-ul ruleaza, paginile jucatorilor nu mai cara procesarea.');
tz_def('ADM_LAST_CRON_TICK', 'Ultima rulare a cron-ului');
tz_def('ADM_WRITTEN_BY_CRON_PHP_ON_EVERY_TICK_INTO_GAMEE', 'Scris de cron.php la fiecare tick in GameEngine/Prevention/cron_active.txt. Sub 90 de secunde inseamna ca cron-ul e activ.');
tz_def('ADM_INVOCATION_LENGTH', 'Durata unei invocari');
tz_def('ADM_CRON_LOOP_SECONDS_HOW_LONG_ONE_CRON_PHP_INVO', 'CRON_LOOP_SECONDS - cat timp continua sa lucreze o invocare de cron.php. Hosturile care permit cron doar la 5 minute obtin astfel un tick pe minut. 0 = un singur tick per invocare.');
tz_def('ADM_TICK_INTERVAL', 'Intervalul dintre tick-uri');
tz_def('ADM_CRON_TICK_SECONDS_HOW_OFTEN_AUTOMATION_RUNS', 'CRON_TICK_SECONDS - cat de des ruleaza Automation in interiorul unei invocari. Automation se asteapta la un tick la circa 60 de secunde.');
tz_def('ADM_HTTP_TRIGGER_KEY', 'Cheie de declansare HTTP');
tz_def('ADM_CRON_KEY_ONLY_NEEDED_TO_CALL_CRON_PHP_OVER_H', 'CRON_KEY - necesara doar pentru apelarea lui cron.php prin HTTP (serviciu extern de cron). Cron-ul propriu al serverului nu o foloseste. Generata automat la instalare.');
tz_def('ADM_NOT_SET', 'Nesetata');
tz_def('ADM_SHOW', 'arata');
tz_def('ADM_HTTP_TRIGGER_URL', 'URL de declansare HTTP');
tz_def('ADM_OPTIONAL_USE_THIS_WITH_AN_EXTERNAL_CRON_SERV', 'Optional. De folosit cu un serviciu extern de cron daca hostul nu poate rula cron local. Un apel HTTP = un tick.');
tz_def('ADM_HIDDEN_USE_SHOW_ABOVE', 'ascunsa &ndash; foloseste "arata" mai sus');
tz_def('ADM_DATABASE_CLEANUP', 'Curatarea bazei de date');
tz_def('ADM_AUTOMATION_TRIMS_TABLES_THAT_WOULD_OTHERWISE', 'Automation reduce tabelele care ar creste la nesfarsit. Rapoartele arhivate nu se sterg niciodata. 0 dezactiveaza o regula.');
tz_def('ADM_LAST_CLEANUP_RUN', 'Ultima curatare');
tz_def('ADM_CLEANUP_RUNS_ONCE_PER_HOUR_FROM_AUTOMATION_A', 'Curatarea ruleaza o data pe ora din Automation si sterge in loturi, deci pe un server vechi prima rulare recupereaza treptat.');
tz_def('ADM_CRON_JOB_COMMAND', 'Comanda pentru cron');
tz_def('ADM_ADD_THIS_IN_CPANEL_CRON_JOBS_THE_PATH_IS_DET', 'De adaugat in cPanel &rarr; Cron Jobs. Calea e detectata din aceasta instalare.');
tz_def('ADM_CURRENT_STATUS', 'Stare curenta');
tz_def('ADM_WHEN_THE_CRON_JOB_IS_NOT_RUNNING_THE_GAME_ST', 'Daca cron-ul nu ruleaza, jocul functioneaza oricum: paginile jucatorilor proceseaza tick-ul, exact ca inainte de introducerea cron-ului.');
tz_def('ADM_ADD_THIS_IN_CPANEL_CRON_JOBS_WRITING_TO_CRON', 'De adaugat in cPanel &rarr; Cron Jobs. Scrierea in cron.log in loc de /dev/null iti arata erorile daca nu porneste.');
tz_def('ADM_SETTINGS', 'Setari');
tz_def('ADM_INVOCATION_LENGTH_SECONDS', 'Durata unei invocari (secunde)');
tz_def('ADM_0_A_SINGLE_TICK_PER_INVOCATION_MAXIMUM_3300', '0 = un singur tick per invocare. Maximum 3300 (55 de minute).');
tz_def('ADM_TICK_INTERVAL_SECONDS', 'Intervalul dintre tick-uri (secunde)');
tz_def('ADM_HOW_OFTEN_AUTOMATION_RUNS_INSIDE_ONE_INVOCAT', 'Cat de des ruleaza Automation intr-o invocare. Garda lui interna asteapta circa 60 de secunde; sub aceasta valoare adaugi mai ales incarcare, fara sa procesezi ceva nou.');
tz_def('ADM_RECOMMENDED_60_ALLOWED_RANGE_15_900', 'Recomandat: 60. Interval permis 15&ndash;900.');
tz_def('ADM_ONLY_NEEDED_WHEN_CALLING_CRON_PHP_OVER_HTTP', 'Necesara doar la apelarea lui cron.php prin HTTP (de exemplu dintr-un serviciu extern de cron). Cron-ul propriu al serverului nu o foloseste. Regenerarea invalideaza orice URL configurat in alta parte.');
tz_def('ADM_GENERATE_A_NEW_KEY_ON_SAVE', 'Genereaza o cheie noua la salvare');
tz_def('ADM_RUNS_FROM_AUTOMATION_ONCE_PER_HOUR_ROWS_ARE', 'Ruleaza din Automation o data pe ora. Randurile se sterg in loturi, deci pe un server vechi prima rulare recupereaza treptat.');
tz_def('ADM_BATTLE_REPORTS_DAYS', 'Rapoarte de lupta (zile)');
tz_def('ADM_UNARCHIVED_REPORTS_OLDER_THAN_THIS_ARE_DELET', 'Rapoartele nearhivate mai vechi de atat se sterg. Rapoartele arhivate de jucator nu se ating niciodata. 0 dezactiveaza regula.');
tz_def('ADM_0_KEEP_FOREVER', '0 = pastreaza permanent.');
tz_def('ADM_CHAT_MESSAGES_DAYS', 'Mesaje de chat (zile)');
tz_def('ADM_THE_CHAT_WINDOW_ONLY_EVER_SHOWS_THE_LAST_13', 'Fereastra de chat afiseaza doar ultimele 13 mesaje per alianta, deci istoricul mai vechi nu e folosit nicaieri in joc.');
tz_def('ADM_DELETED_MESSAGES_DAYS', 'Mesaje sterse (zile)');
tz_def('ADM_ONLY_MESSAGES_DELETED_BY_BOTH_THE_SENDER_AND', 'Se sterg doar mesajele sterse de AMBELE parti &mdash; nu mai sunt vizibile pentru nimeni in joc. Dezactivat implicit.');
tz_def('ADM_0_DISABLED_DEFAULT', '0 = dezactivat (implicit).');
tz_def('ADM_NEW_MECHANICS_AND_FUNCTIONS', 'Mecanici si functii noi');
tz_def('ADM_HERO_BASE_REGENERATION', 'Regenerarea de baza a eroului');
tz_def('ADM_HIT_POINTS_THE_HERO_RECOVERS_PER_DAY_INDEPEN', 'Puncte de viata recuperate zilnic de erou, independent de atributul de regenerare si de itemele echipate. 0 dezactiveaza.');
tz_def('ADM_HP_DAY', 'HP / zi');
tz_def('ADM_HERO_EXCHANGE_RATES', 'Ratele de schimb ale eroului');
tz_def('ADM_RATES_OF_THE_EXCHANGE_OFFICE_IN_THE_AUCTION', 'Ratele casei de schimb din casa de licitatii. Diferenta dintre cele doua sensuri e marja casei, deci schimbul dus-intors pierde valoare in loc sa creeze.');
tz_def('ADM_EXCHANGE_OFFICE_IN_THE_AUCTION_HOUSE_KEEP_TH', 'Casa de schimb din casa de licitatii. Tine a doua valoare mai mare decat prima, altfel jucatorii ar putea fabrica aur din nimic.');
tz_def('ADM_1_GOLD', '1 aur &rarr;');
tz_def('ADM_SILVER_1_GOLD', 'argint &rarr; 1 aur');
tz_def('ADM_HERO_RESOURCE_PRODUCTION', 'Productia de resurse a eroului');
tz_def('ADM_OF_ONE_TYPE', 'dintr-un singur tip');
tz_def('ADM_DISPLAY_OASIS_IN_PROFILE', 'Afiseaza oazele in profil');
tz_def('ADM_ENABLE_DISABLE_THE_DISPLAY_OF_OASES_OF_EACH', 'Activeaza (dezactiveaza) afisarea oazelor fiecarui sat in profilul jucatorului');
tz_def('ADM_ALLIANCE_INVITATION_MESSAGE', 'Mesaj de invitatie in alianta');
tz_def('ADM_ENABLE_DISABLE_SENDING_AN_IN_GAME_MESSAGE_TO', 'Activeaza (dezactiveaza) trimiterea unui mesaj in joc jucatorului invitat in alianta');
tz_def('ADM_NEW_ALLIANCE_EMBASSY_MECHANICS', 'Mecanici noi de alianta si ambasada');
tz_def('ADM_NEW_FORUM_POST_MESSAGE', 'Mesaj la postare noua pe forum');
tz_def('ADM_ENABLE_DISABLE_FORUM_SUBSCRIPTION_MESSAGES', 'Activeaza (dezactiveaza) mesajele de abonare la forum');
tz_def('ADM_TRIBES_IMAGES_IN_PROFILE', 'Imagini cu triburile in profil');
tz_def('ADM_ENABLE_DISABLE_DISPLAYING_IMAGES_OF_TRIBES', 'Activeaza (dezactiveaza) afisarea imaginilor cu triburile');
tz_def('ADM_ENABLE_DISABLE_DISPLAYING_IMAGES_OF_TRIBES_W', 'Activeaza (dezactiveaza) afisarea imaginilor cu triburile, cu descriere, in profilul jucatorilor');
tz_def('ADM_NEW_TRIBE_HUNS', 'Trib nou: Huni');
tz_def('ADM_ENABLE_DISABLE_THE_HUNS_TRIBE', 'Activeaza (dezactiveaza) tribul Hunilor');
tz_def('ADM_ENABLE_DISABLE_TRIBE_HUNS', 'Activeaza (dezactiveaza) tribul Hunilor');
tz_def('ADM_NEW_TRIBE_EGYPTIANS', 'Trib nou: Egipteni');
tz_def('ADM_ENABLE_DISABLE_THE_EGYPTIANS_TRIBE', 'Activeaza (dezactiveaza) tribul Egiptenilor');
tz_def('ADM_ENABLE_DISABLE_TRIBE_EGYPTIANS', 'Activeaza (dezactiveaza) tribul Egiptenilor');
tz_def('ADM_NEW_TRIBE_SPARTANS', 'Trib nou: Spartani');
tz_def('ADM_ENABLE_DISABLE_THE_SPARTANS_TRIBE', 'Activeaza (dezactiveaza) tribul Spartanilor');
tz_def('ADM_ENABLE_DISABLE_TRIBE_SPARTANS', 'Activeaza (dezactiveaza) tribul Spartanilor');
tz_def('ADM_NEW_TRIBE_VIKINGS', 'Trib nou: Vikingi');
tz_def('ADM_ENABLE_DISABLE_THE_VIKINGS_TRIBE', 'Activeaza (dezactiveaza) tribul Vikingilor');
tz_def('ADM_ENABLE_DISABLE_TRIBE_VIKINGS', 'Activeaza (dezactiveaza) tribul Vikingilor');
tz_def('ADM_MHS_IMAGES_IN_PROFILE', 'Imagini cu MH-urile in profil');
tz_def('ADM_ENABLE_DISABLE_DISPLAYING_IMAGES_OF_MULTIHUN', 'Activeaza (dezactiveaza) afisarea imaginilor cu Multihunterii');
tz_def('ADM_ENABLE_DISABLE_DISPLAYING_IMAGES_OF_MULTIHUN_2', 'Activeaza (dezactiveaza) afisarea imaginilor cu Multihunterii, cu descriere, in profilul lor');
tz_def('ADM_DISPLAY_ARTIFACT_IN_PROFILE', 'Afiseaza artefactul in profil');
tz_def('ADM_ENABLE_DISABLE_THE_DISPLAY_OF_THE_ARTIFACT', 'Activeaza (dezactiveaza) afisarea artefactului');
tz_def('ADM_ENABLE_DISABLE_THE_DISPLAY_OF_THE_ARTIFACT_I', 'Activeaza (dezactiveaza) afisarea artefactului in profilul jucatorului, in dreptul satului in care se afla');
tz_def('ADM_DISPLAY_WOW_IN_PROFILE', 'Afiseaza MdL in profil');
tz_def('ADM_ENABLE_DISABLE_THE_DISPLAY_OF_THE_WONDER', 'Activeaza (dezactiveaza) afisarea minunii');
tz_def('ADM_ENABLE_DISABLE_THE_DISPLAY_OF_THE_WONDER_IN', 'Activeaza (dezactiveaza) afisarea minunii in profilul jucatorului, in dreptul satului in care se afla');
tz_def('ADM_VACATION_MODE', 'Mod vacanta');
tz_def('ADM_ENABLE_DISABLE_VACATION_MODE', 'Activeaza (dezactiveaza) modul vacanta');
tz_def('ADM_ENABLE_DISABLE_VACATION_MODE_WILL_BE_DISPLAY', 'Activeaza (dezactiveaza) modul vacanta; va fi afisat sau ascuns in meniul profilului jucatorului');
tz_def('ADM_CATAPULT_TARGETS', 'Tinte de catapulta');
tz_def('ADM_ENABLE_DISABLE_THE_DISPLAY_OF_CATAPULT_TARGE', 'Activeaza (dezactiveaza) afisarea tintelor de catapulta');
tz_def('ADM_ENABLE_DISABLE_THE_DISPLAY_OF_THE_TARGETS_OF', 'Activeaza (dezactiveaza) afisarea, in punctul de adunare, a tintelor catapultelor trimise de tine');
tz_def('ADM_MANUAL_ON_NATURE_AND_NATARS', 'Manual despre Natura si Natari');
tz_def('ADM_ENABLE_DISABLE_MANUAL_INFO', 'Activeaza (dezactiveaza) informatiile din manual');
tz_def('ADM_ENABLE_DISABLE_DISPLAYING_INFORMATION_IN_THE', 'Activeaza (dezactiveaza) afisarea in Manual a informatiilor despre trupele Naturii si ale Natarilor');
tz_def('ADM_DIRECT_LINKS_PLACEMENT', 'Pozitia linkurilor directe');
tz_def('ADM_LEFT_MENU_VS_RIGHT_MENU', 'Meniul din stanga sau din dreapta');
tz_def('ADM_IF_ENABLED_THEN_THE_DIRECT_LINKS_WILL_BE_PLA', 'Daca e activat, linkurile directe apar in meniul din stanga; daca e dezactivat, in meniul din dreapta, ca in Travian-ul original');
tz_def('ADM_MEDAL_VETERAN_PLAYER', 'Medalie de jucator veteran');
tz_def('ADM_3_YEARS', '3 ani');
tz_def('ADM_ENABLE_DISABLE_MEDAL_ACHIEVED_FOR_PLAYING_3', 'Activeaza (dezactiveaza) medalia pentru 3 ani de joc');
tz_def('ADM_MEDAL_VETERAN_PLAYER_5A', 'Medalie de jucator veteran 5a');
tz_def('ADM_5_YEARS', '5 ani');
tz_def('ADM_ENABLE_DISABLE_MEDAL_ACHIEVED_FOR_PLAYING_5', 'Activeaza (dezactiveaza) medalia pentru 5 ani de joc');
tz_def('ADM_MEDAL_VETERAN_PLAYER_10A', 'Medalie de jucator veteran 10a');
tz_def('ADM_10_YEARS', '10 ani');
tz_def('ADM_ENABLE_DISABLE_MEDAL_ACHIEVED_FOR_PLAYING_10', 'Activeaza (dezactiveaza) medalia pentru 10 ani de joc');
tz_def('ADM_SPECIAL_MEDALS', 'Medalii speciale');
tz_def('ADM_ENABLE_DISABLE_SPECIAL_MEDALS_ARTIFACT_HERO', 'Activeaza (dezactiveaza) medaliile speciale (artefact, erou, minune, zid, mare depozit etc.)');
tz_def('ADM_SERVER_MILESTONES', 'Etape ale serverului');
tz_def('ADM_NOT_PRESENT_IN_CONFIG_PHP_YET_SAVING_THIS_FO', 'Inca nu exista in config.php &mdash; salvarea o data a acestui formular il va adauga (pana atunci e False).');
tz_def('ADM_SERVER_MEDAL_RESET_TIMER', 'Cronometru de resetare a medaliilor');
tz_def('ADM_ENABLE_DISABLE_THE_SERVER_MEDAL_RESET_TIMER', 'Activeaza (dezactiveaza) widgetul "Cronometru de resetare a medaliilor" in Top 10 jucatori si Top 10 aliante');
tz_def('ADM_T4_HERO_ITEMS_ADVENTURES_AUCTION', 'Erou T4 (iteme, aventuri, licitatii)');
tz_def('ADM_ENABLE_DISABLE_THE_T4_HERO_ITEMS_ADVENTURES', 'Activeaza (dezactiveaza) sistemul "Erou T4 (iteme, aventuri, licitatii)"');
tz_def('ADM_REGISTRATION_BONUS_GOLD', 'Aur bonus la inregistrare');
tz_def('ADM_GIVE_EVERY_NEWLY_REGISTERED_PLAYER_A_ONE_TIM', 'Ofera fiecarui jucator nou un bonus unic de aur la crearea contului');
tz_def('ADM_REGISTRATION_BONUS_GOLD_AMOUNT', 'Aur bonus la inregistrare &ndash; cantitate');
tz_def('ADM_HOW_MUCH_GOLD_EACH_NEW_PLAYER_RECEIVES_WHEN', 'Cat aur primeste fiecare jucator nou cand bonusul e activ');
tz_def('ADM_ENABLE_DISABLE_A_ONE_TIME_GOLD_BONUS_GRANTED', 'Activeaza (dezactiveaza) un bonus unic de aur acordat fiecarui jucator nou la crearea contului (conturile de sistem cu id&le;3 sunt sarite). Cantitatea se seteaza in campul de mai jos.');
tz_def('ADM_HOW_MUCH_GOLD_EACH_NEW_PLAYER_RECEIVES_WHEN_2', 'Cat aur primeste fiecare jucator nou cand optiunea de mai sus e True. Implicit: 200.');
tz_def('ADM_FOR_THIS_SETTING_YOU_CAN_FIND_MORE_INFORMATI', 'Pentru aceasta setare, gasesti mai multe informatii la linkul:');
tz_def('ADM_EDIT_CRON_AUTOMATION', 'Editeaza Cron si automatizare');
tz_def('ADM_EDIT_NEW_MECHANICS_AND_FUNCTIONS', 'Editeaza mecanicile si functiile noi');
tz_def('ADM_ENGLISH', 'Engleza');
tz_def('ADM_FRENCH', 'Franceza');
tz_def('ADM_ITALIAN', 'Italiana');
tz_def('ADM_ROMANIAN', 'Romana');
tz_def('ADM_SPANISH', 'Spaniola');
tz_def('ADM_CHINESE', 'Chineza');
tz_def('ADM_SLOW', 'Lent');
tz_def('ADM_FAST', 'Rapid');
tz_def('ADM_2_HOURS', '2 ore');
tz_def('ADM_3_HOURS', '3 ore');
tz_def('ADM_5_HOURS', '5 ore');
tz_def('ADM_8_HOURS', '8 ore');
tz_def('ADM_10_HOURS', '10 ore');
tz_def('ADM_12_HOURS', '12 ore');
tz_def('ADM_16_HOURS', '16 ore');
tz_def('ADM_20_HOURS', '20 de ore');
tz_def('ADM_24_HOURS_1_DAY', '24 de ore (1 zi)');
tz_def('ADM_48_HOURS_2_DAYS', '48 de ore (2 zile)');
tz_def('ADM_72_HOURS_3_DAYS', '72 de ore (3 zile)');
tz_def('ADM_120_HOURS_5_DAYS', '120 de ore (5 zile)');
tz_def('ADM_TRUE', 'True');
tz_def('ADM_FALSE', 'False');
tz_def('ADM_YES', 'Da');
tz_def('ADM_NO', 'Nu');
tz_def('ADM_TRAVIAN_OFFICIAL', 'Travian oficial');
tz_def('ADM_TRAVIANZ_EXTENDED', 'TravianZ extins');
tz_def('ADM_10_DEFAULT', '10 - implicit');
tz_def('ADM_NONE', 'niciunul');
tz_def('ADM_1_DAY', '1 zi');
tz_def('ADM_2_DAYS', '2 zile');
tz_def('ADM_3_DAYS', '3 zile');
tz_def('ADM_4_DAYS', '4 zile');
tz_def('ADM_5_DAYS', '5 zile');
tz_def('ADM_6_DAYS', '6 zile');
tz_def('ADM_7_DAYS', '7 zile');
tz_def('ADM_NONE_2', 'Niciunul');
tz_def('ADM_CHRISTMAS', 'Craciun');
tz_def('ADM_NEW_YEAR', 'Anul Nou');
tz_def('ADM_EASTER', 'Paste');
tz_def('ADM_ENABLE', 'Activeaza');
tz_def('ADM_DISABLE', 'Dezactiveaza');
tz_def('ADM_SAVE', 'SALVEAZA');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - sabloane (lot 3: player, editHero, editHeroT4,
// playerheroinfo, village, troops, editVillage, editUser, deletion, editSitter)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_START', 'Inceput');
tz_def('ADM_END', 'Sfarsit');
tz_def('ADM_DURATION', 'Durata');
tz_def('ADM_REASON', 'Motiv');
tz_def('ADM_PLAYER', 'Jucator:');
tz_def('ADM_BASIC_INFO', '📝 Informatii de baza');
tz_def('ADM_HERO_NAME', 'Numele eroului');
tz_def('ADM_HERO_UNIT', 'Unitatea eroului');
tz_def('ADM_HEALTH', '❤ Viata');
tz_def('ADM_EXPERIENCE', '✨ Experienta');
tz_def('ADM_CURRENT_STATS', '📈 Statistici curente');
tz_def('ADM_LEVEL', 'Nivel:');
tz_def('ADM_OF', 'din');
tz_def('ADM_FREE', '(libere:');
tz_def('ADM_OFFENCE', 'Atac:');
tz_def('ADM_DEFENCE', 'Aparare:');
tz_def('ADM_OFF_BONUS', 'Bonus atac:');
tz_def('ADM_DEF_BONUS', '| Bonus aparare:');
tz_def('ADM_REGEN', 'Regen.:');
tz_def('ADM_RESOURCES', 'Resurse:');
tz_def('ADM_ADD_POINTS', '⚔ Adauga puncte');
tz_def('ADM_ATTRIBUTE', 'Atribut');
tz_def('ADM_CURRENT', 'Curent');
tz_def('ADM_ADD', 'Adauga');
tz_def('ADM_NEW', 'Nou');
tz_def('ADM_PRODUCED_RESOURCE', 'Resursa produsa');
tz_def('ADM_LEVEL_NOU', 'Nivel nou:');
tz_def('ADM_BACK', '← Inapoi');
tz_def('ADM_SAVE_HERO', '💾 Salveaza eroul');
tz_def('ADM_CLASSIC_HERO_EDITOR', '&laquo; editorul clasic de erou');
tz_def('ADM_ACTION_COMPLETED', 'Actiune efectuata.');
tz_def('ADM_ACTION_FAILED_CHECK_THE_VALUES_AND_TRY_AGAIN', 'Actiunea a esuat (verifica valorile si incearca din nou).');
tz_def('ADM_SILVER', 'Argint');
tz_def('ADM_SET_BALANCE', 'Seteaza soldul');
tz_def('ADM_GRANT_ITEM', 'Acorda un item');
tz_def('ADM_QTY', 'Cant.:');
tz_def('ADM_GRANT', 'Acorda');
tz_def('ADM_ROW', 'Rand');
tz_def('ADM_ITEM', 'Item');
tz_def('ADM_SLOT', 'Slot');
tz_def('ADM_QTY_2', 'Cant.');
tz_def('ADM_EQUIPPED', 'Echipat');
tz_def('ADM_DELETE', 'Sterge');
tz_def('ADM_AUCTION', 'Licitatie');
tz_def('ADM_ROLE', 'Rol');
tz_def('ADM_PRICE', 'Pret');
tz_def('ADM_ENDS', 'Se incheie');
tz_def('ADM_CANCEL', 'Anuleaza');
tz_def('ADM_ADVENTURES', 'Aventuri');
tz_def('ADM_RUNNING', 'In curs:');
tz_def('ADM_OFFER', 'Oferta');
tz_def('ADM_DIFFICULTY', 'Dificultate');
tz_def('ADM_EXPIRES', 'Expira');
tz_def('ADM_REMOVE', 'Elimina');
tz_def('ADM_PLAYER_HEROES', 'Eroii jucatorului');
tz_def('ADM_NONE_3', 'Niciunul &nbsp;&nbsp;');
tz_def('ADM_ADD_HERO', 'Adauga erou');
tz_def('ADM_HERO_LEVEL', 'Nivelul eroului');
tz_def('ADM_STATUS', 'Stare');
tz_def('ADM_ALIVE', 'Viu');
tz_def('ADM_DEAD', 'Mort');
tz_def('ADM_DETAILS', 'Detalii');
tz_def('ADM_POINT', 'Puncte');
tz_def('ADM_LEVEL_2', 'Nivel');
tz_def('ADM_OFFENCE_2', 'Atac');
tz_def('ADM_DEFENCE_2', 'Aparare');
tz_def('ADM_OFF_BONUS_2', 'Bonus atac');
tz_def('ADM_DEF_BONUS_2', 'Bonus aparare');
tz_def('ADM_REGENERATION', 'Regenerare');
tz_def('ADM_RESOURCES_2', 'Resurse');
tz_def('ADM_HEALTH_2', 'Viata');
tz_def('ADM_EDIT', 'Editeaza');
tz_def('ADM_T4_ITEMS_SILVER_AUCTIONS', 'Iteme T4 / argint / licitatii');
tz_def('ADM_KILL', 'Ucide');
tz_def('ADM_REVIVE', 'Inviaza');
tz_def('ADM_VILLAGE_INFORMATION', 'Informatii despre sat');
tz_def('ADM_OWNER', 'Proprietar');
tz_def('ADM_NAME', 'Nume');
tz_def('ADM_POPULATION', 'Populatie');
tz_def('ADM_COORDS', 'Coordonate');
tz_def('ADM_FIELD', 'Camp');
tz_def('ADM_RES', 'Res');
tz_def('ADM_AMT', 'Cant.');
tz_def('ADM_CAP', 'Cap.');
tz_def('ADM_PROD', 'Prod.');
tz_def('ADM_WOOD', 'Lemn');
tz_def('ADM_CLAY', 'Lut');
tz_def('ADM_IRON', 'Fier');
tz_def('ADM_CROP', 'Cereale');
tz_def('ADM_EXPANSION', 'Expansiune');
tz_def('ADM_VILLAGE', 'Sat');
tz_def('ADM_POP', 'Pop.');
tz_def('ADM_CP', 'PC');
tz_def('ADM_OASIS', 'Oaza');
tz_def('ADM_LOY', 'Loial.');
tz_def('ADM_BONUS', 'Bonus');
tz_def('ADM_TROOPS', 'Trupe');
tz_def('ADM_UPGRADES', 'Imbunatatiri');
tz_def('ADM_ARTIFACT', 'Artefact');
tz_def('ADM_RESOURCE_FIELDS', 'Campuri de resurse');
tz_def('ADM_BUILDINGS', 'Cladiri');
tz_def('ADM_GID', 'GID');
tz_def('ADM_LVL', 'Niv.');
tz_def('ADM_VILLAGE_BUILD_LOG', 'Jurnalul de constructii al satului →');
tz_def('ADM_CHANGE', 'Schimba');
tz_def('ADM_RENAME', 'Redenumeste');
tz_def('ADM_SHOW_INSTRUCTIONS', 'Arata instructiunile');
tz_def('ADM_RESOURCE_FIELDS_1_18', 'Campuri de resurse (1-18)');
tz_def('ADM_VILLAGE_CENTER_19_38', 'Centrul satului (19-38)');
tz_def('ADM_MODIFY_BUILDINGS', 'Modifica cladirile');
tz_def('ADM_SAVE_CHANGES', 'Salveaza modificarile');
tz_def('ADM_CURRENT_LAYOUT_PREVIEW', 'Previzualizarea dispunerii curente');
tz_def('ADM_VILLAGE_CENTER', 'Centrul satului');
tz_def('ADM_EDIT_PLAYER', '✏️ Editeaza jucatorul:');
tz_def('ADM_ACCOUNT_DETAILS', '👤 Detaliile contului');
tz_def('ADM_USERNAME_2', '👤 Nume utilizator');
tz_def('ADM_SAVE_2', '💾 Salveaza');
tz_def('ADM_TRIBE_2', '⚔️ Trib');
tz_def('ADM_1_ROMAN', '1. Romani');
tz_def('ADM_2_TEUTON', '2. Teutoni');
tz_def('ADM_3_GAUL', '3. Gali');
tz_def('ADM_4_NATURE', '4. Natura');
tz_def('ADM_5_NATARS', '5. Natari');
tz_def('ADM_6_HUN', '6. Huni');
tz_def('ADM_7_EGYPTIAN', '7. Egipteni');
tz_def('ADM_8_SPARTAN', '8. Spartani');
tz_def('ADM_9_VIKING', '9. Vikingi');
tz_def('ADM_LOCATION', '📍 Locatie');
tz_def('ADM_E_MAIL', '✉️ E-mail');
tz_def('ADM_QUEST', '🎯 Misiune');
tz_def('ADM_PROFILE_DESCRIPTION_LEFT', '📝 Descrierea profilului (stanga)');
tz_def('ADM_PROFILE_DESCRIPTION_RIGHT', '📄 Descrierea profilului (dreapta)');
tz_def('ADM_SUPORT_BBCODE_FOLOSE_TE_ENTER_PENTRU_LINII_N', 'Suporta BBCode. Foloseste Enter pentru linii noi.');
tz_def('ADM_MEDALS', '🏅 Medalii');
tz_def('ADM_CATEGORY', 'Categorie');
tz_def('ADM_RANK', 'Rang');
tz_def('ADM_WEEK', 'Saptamana');
tz_def('ADM_BB_CODE', 'BB-Code');
tz_def('ADM_BEGINNERS_PROTECTION', 'Protectia incepatorilor');
tz_def('ADM_SAVE_CHANGES_2', '💾 Salveaza modificarile');
tz_def('ADM_GO_BACK_TO_PLAYER', '« Inapoi la jucator');
tz_def('ADM_CHANGE_USERNAME', 'Schimba numele de utilizator');
tz_def('ADM_DELETE_PLAYER_PERMANENTLY', 'STERGE JUCATORUL DEFINITIV');
tz_def('ADM_THIS_ACTION_CANNOT_BE_UNDONE', 'Aceasta actiune nu poate fi anulata!');
tz_def('ADM_PLAYER_TO_DELETE', '🗑️ Jucatorul de sters');
tz_def('ADM_PLUS_ENDS', 'Plus se incheie');
tz_def('ADM_WARNING', 'ATENTIE:');
tz_def('ADM_PERMANENTLY', 'definitiv');
tz_def('ADM_DELETED_THERE_IS_NO_RECOVERY', 'sters. Nu exista recuperare!');
tz_def('ADM_CONFIRM_WITH_YOUR_ADMIN_PASSWORD', 'Confirma cu parola ta de administrator:');
tz_def('ADM_CANCEL_2', '← Anuleaza');
tz_def('ADM_DELETE_PLAYER', '🗑️ STERGE JUCATORUL');
tz_def('ADM_EDIT_SITTERS', 'Editeaza inlocuitorii:');
tz_def('ADM_SITTER_SETTINGS', '⚙️ Setarile inlocuitorilor');
tz_def('ADM_USE_THE_PLAYER_S_UID_ENTER', '💡 Foloseste UID-ul jucatorului. Introdu');
tz_def('ADM_TO_DELETE_THE_SITTER_YOU_CAN_FIND_THE_UID_IN', 'pentru a sterge inlocuitorul. Gasesti UID-ul in Cautare.');
tz_def('ADM_SITTER_1', '👤 Inlocuitor 1');
tz_def('ADM_SITTER_2', '👤 Inlocuitor 2');
tz_def('ADM_SAVE_SITTERS', '💾 Salveaza inlocuitorii');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - sabloane (lot 4: gold, usergold, givePlus, givePlusRes,
// punish, maintenance, resetServer, cleanban, massmessage, sysmessage)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_GOLD_MANAGEMENT', 'Administrarea aurului');
tz_def('ADM_GIVE_EVERYONE_FREE_GOLD', 'Ofera aur tuturor');
tz_def('ADM_THIS_GOLD_WILL_BE_ADDED_TO_ALL_ACTIVE_PLAYER', 'Acest aur va fi adaugat TUTUROR jucatorilor activi de pe server.');
tz_def('ADM_GIVE_GOLD', 'Ofera aur');
tz_def('ADM_GOLD_HAS_BEEN_SUCCESSFULLY_ADDED_TO_ALL_PLAY', '✓ Aurul a fost adaugat cu succes tuturor jucatorilor!');
tz_def('ADM_USER_GOLD', 'Aurul jucatorului');
tz_def('ADM_GIVE_GOLD_TO_SPECIFIC_PLAYER', 'Ofera aur unui anumit jucator');
tz_def('ADM_ADD_GOLD_ONLY_FOR_SINGLE_ACCOUNT_AFTER_ID', 'Adauga aur unui singur cont (dupa ID).');
tz_def('ADM_AMOUNT_GOLD', 'Cantitate de aur');
tz_def('ADM_GOLD_SUCCESSFULLY_ADDED_FOR_USER', '✓ Aur adaugat cu succes jucatorului!');
tz_def('ADM_PLUS_MANAGEMENT', 'Administrarea Plus');
tz_def('ADM_GIVE_EVERYONE_FREE_PLUS', 'Ofera Plus tuturor');
tz_def('ADM_ACTIVATE_TRAVIAN_PLUS_FOR_ALL_PLAYERS_ON_THE', 'Activeaza Travian Plus pentru TOTI jucatorii de pe server.');
tz_def('ADM_DAYS', 'Zile');
tz_def('ADM_GIVE_PLUS', 'Ofera Plus');
tz_def('ADM_PLUS_HAS_BEEN_SUCCESSFULLY_ACTIVATED_FOR_ALL', '✓ Plus a fost activat cu succes pentru toti jucatorii!');
tz_def('ADM_RESOURCE_BONUS', 'Bonus de resurse');
tz_def('ADM_GIVE_EVERYONE_RESOURCE_BONUS', 'Ofera bonusul de resurse tuturor');
tz_def('ADM_ACTIVATE_A_25_BONUS_FOR_ALL_RESOURCES_FOR_AL', 'Activeaza un bonus de 25% la toate resursele pentru TOTI jucatorii.');
tz_def('ADM_DAYS_2', 'zile');
tz_def('ADM_GIVE_RESOURCE_BONUS', 'Ofera bonusul de resurse');
tz_def('ADM_RESOURCE_BONUSES_HAVE_BEEN_ACTIVATED_FOR_ALL', '✓ Bonusurile de resurse au fost activate pentru toti jucatorii!');
tz_def('ADM_PUNISH_PLAYER', 'Pedepseste jucatorul');
tz_def('ADM_OK', 'OK');
tz_def('ADM_DELETE_TROOPS', 'Sterge trupele');
tz_def('ADM_EMPTY_WAREHOUSES', 'Goleste depozitele');
tz_def('ADM_STARTED_BY', 'Pornita de:');
tz_def('ADM_UID', '(UID:');
tz_def('ADM_ENABLE_MAINTENANCE', 'Activeaza mentenanta');
tz_def('ADM_DISABLE_MAINTENANCE', 'Dezactiveaza mentenanta');
tz_def('ADM_STOP', 'Opreste');
tz_def('ADM_SERVER_RESETTING', '⚠️ Resetarea serverului');
tz_def('ADM_WARNING_IRREVERSIBLE_ACTION', 'ATENTIE! Actiune ireversibila');
tz_def('ADM_THIS_OPERATION_WILL_DELETE_ALL_DATA_PLAYERS', 'Aceasta operatiune va sterge TOATE datele: jucatori, sate, aliante, rapoarte. Serverul va reveni la starea initiala.');
tz_def('ADM_THIS_SERVER_WILL_BE_RESET_TO_CREATE_NEW_GAME', 'Acest server va fi resetat pentru a crea un server de joc nou.');
tz_def('ADM_CLICK_BUTTON', 'Apasa butonul');
tz_def('ADM_RESET', 'Reseteaza');
tz_def('ADM_TO_PROCEED', 'pentru a continua.');
tz_def('ADM_PLEASE_WAIT_WHILE_THE_SERVER_IS_BEING_RESET', 'Te rugam sa astepti... serverul se reseteaza');
tz_def('ADM_BACK_2', '« Inapoi');
tz_def('ADM_RESET_SERVER', 'Reseteaza serverul');
tz_def('ADM_CLEAR_BANLIST_DATA', 'Curatare – lista de blocari');
tz_def('ADM_TRUNCATE', '(TRUNCATE)');
tz_def('ADM_CLEAN', 'Curata');
tz_def('ADM_SEND_MESSAGE_TO_ALL_PLAYERS', 'Trimite mesaj tuturor jucatorilor');
tz_def('ADM_CONFIRM', 'Confirma:');
tz_def('ADM_ARE_YOU_SURE_YOU_WANT_TO_SEND', 'Sigur vrei sa trimiti?');
tz_def('ADM_SUBJECT', 'Subiect:');
tz_def('ADM_YES_SEND', '✓ Da, trimite');
tz_def('ADM_SENDING_MESSAGES', 'Se trimit mesajele...');
tz_def('ADM_SUBJECT_2', 'Subiect');
tz_def('ADM_MESSAGE_COLOR', 'Culoarea mesajului');
tz_def('ADM_MESSAGE_CONTENT', 'Continutul mesajului');
tz_def('ADM_CONTINUA', 'Continua');
tz_def('ADM_MASS_MESSAGE_SUCCESSFULLY_SENT_TO_ALL_PLAYER', '✓ Mesajul in masa a fost trimis tuturor jucatorilor!');
tz_def('ADM_EX_MAINTENANCE', 'ex.: Mentenanta');
tz_def('ADM_BLACK_SAU_E67E22', 'black sau #e67e22');
tz_def('ADM_WRITE_THE_MESSAGE_YOU_CAN_USE_URL_IMG', 'Scrie mesajul... poti folosi [url][img]');
tz_def('ADM_CONFIRMARE_SYSTEM_MESSAGE', 'Confirmare mesaj de sistem');
tz_def('ADM_COLOR', 'Culoare:');
tz_def('ADM_SEND_SYSTEM_MESSAGE', '✓ Trimite mesajul de sistem');
tz_def('ADM_SENDING_SYSTEM_MESSAGE', 'Se trimite mesajul de sistem...');
tz_def('ADM_COLOR_2', 'Culoare');
tz_def('ADM_CONTINUE', 'Continua');
tz_def('ADM_SYSTEM_MESSAGE_SENT_SUCCESSFULLY', '✓ Mesajul de sistem a fost trimis cu succes');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - sabloane (lot 5: alliance, editAli, delAli, allymedals,
// delallymedal, playermedals, delmedal, admin_log, debug_log, techlog)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_FOUNDER', '👑 Fondator:');
tz_def('ADM_MEMBERS', '👥 Membri:');
tz_def('ADM_POINTS', '🏆 Puncte:');
tz_def('ADM_ALLIANCE_DETAILS', '📋 Detaliile aliantei');
tz_def('ADM_TAG', 'Tag');
tz_def('ADM_POINTS_2', 'Puncte');
tz_def('ADM_CAPACITY', 'Capacitate');
tz_def('ADM_ALLIANCE_POSITIONS', '🛡 Rangurile aliantei');
tz_def('ADM_EDIT_ALLIANCE', '✏ Editeaza alianta');
tz_def('ADM_DELETE_2', '🗑 Sterge');
tz_def('ADM_ALLIANCE_DESCRIPTION', '📖 Descrierea aliantei');
tz_def('ADM_ALLIANCE_NOTICE', '📢 Anuntul aliantei');
tz_def('ADM_PLAYER_2', 'Jucator');
tz_def('ADM_ALLIANCE_NEWS', '📰 Noutatile aliantei');
tz_def('ADM_EVENT', 'Eveniment');
tz_def('ADM_DIPLOMACY', '🤝 Diplomatie');
tz_def('ADM_TYPE', 'Tip');
tz_def('ADM_EDIT_ALLIANCE_2', '✏️ Editeaza alianta:');
tz_def('ADM_BASIC_SETTINGS', '⚙️ Setari de baza');
tz_def('ADM_ALLIANCE_TAG_MAX_8', 'Tag-ul aliantei (max 8)');
tz_def('ADM_ALLIANCE_NAME', 'Numele aliantei');
tz_def('ADM_LEADER_FOUNDER', '👑 Lider (fondator)');
tz_def('ADM_SCHIMB_FONDATORUL_ALIAN_EI', 'Schimba fondatorul aliantei');
tz_def('ADM_MAX_MEMBERS', '👥 Numar maxim de membri');
tz_def('ADM_ALLIANCE_NOTICE_APARE_SUS', '📢 Anuntul aliantei (apare sus)');
tz_def('ADM_ALLIANCE_DESCRIPTION_PAGINA_PUBLIC', '📖 Descrierea aliantei (pagina publica)');
tz_def('ADM_SAVE_ALLIANCE', '💾 Salveaza alianta');
tz_def('ADM_MESAJ_SCURT_PENTRU_MEMBRI', 'Mesaj scurt pentru membri...');
tz_def('ADM_DESCRIERE_LUNG_BBCODE_PERMIS', 'Descriere lunga, BBCode permis...');
tz_def('ADM_DELETE_ALLIANCE', '🗑 Sterge alianta');
tz_def('ADM_ARE_YOU_SURE_YOU_WANT_TO_PERMANENTLY_DELETE', 'Sigur vrei sa stergi definitiv?:');
tz_def('ADM_MEMBERS_2', 'Membri:');
tz_def('ADM_POINTS_3', '| Puncte:');
tz_def('ADM_ALL_MEMBERS_WILL_BE_REMOVED_FROM_THE_ALLIANC', '⚠ Toti membrii vor fi scosi din alianta; permisiunile, diplomatia, jurnalele si forumul aliantei vor fi sterse. Actiunea e ireversibila!');
tz_def('ADM_YES_DELETE', 'DA, STERGE');
tz_def('ADM_MEDAL', 'Medalie');
tz_def('ADM_THIS_ALLIANCE_HAS_NO_MEDALS_YET', 'Aceasta alianta nu are inca medalii');
tz_def('ADM_AVERAGE_RANK', 'Rang mediu');
tz_def('ADM_DELETE_ALL', 'Sterge tot');
tz_def('ADM_MEDAL_INFORMATION', 'Informatii despre medalie');
tz_def('ADM_MEDALS_2', 'Medalii');
tz_def('ADM_MEDAL_WEEK_BY_WEEK', 'Medalii saptamana cu saptamana');
tz_def('ADM_CATEGORY_2', 'CATEGORIE');
tz_def('ADM_RANK_2', 'RANG');
tz_def('ADM_WEEK_2', 'SAPTAMANA');
tz_def('ADM_POINTS_4', 'PUNCTE');
tz_def('ADM_MEDAL_2', 'MEDALIE');
tz_def('ADM_THIS_PLAYER_HAS_NO_MEDALS_YET', 'Acest jucator nu are inca medalii');
tz_def('ADM_UNIFIED_ADMIN_LOG_LAST_300_ACTIONS', '📋 Jurnal de administrare – ultimele 300 de actiuni');
tz_def('ADM_CATEGORIE', 'Categorie');
tz_def('ADM_DETALII', 'Detalii');
tz_def('ADM_DATA', 'Data');
tz_def('ADM_DEBUG_ERROR_LOG', '🐞 Jurnal de erori');
tz_def('ADM_CAPTURE_IS', 'Capturarea este');
tz_def('ADM_AUTO_OFF', 'Oprire automata:');
tz_def('ADM_LOG_SIZE', 'Dimensiunea jurnalului:');
tz_def('ADM_TRANSPARENT_TO_PLAYERS_ERRORS_ARE_ONLY_WRITT', 'Transparent pentru jucatori: erorile se scriu doar in fisierul de jurnal, nu se afiseaza in joc, iar jocul nu e afectat.');
tz_def('ADM_CAPTURE_SETTINGS', 'Setari de capturare');
tz_def('ADM_WARNINGS', 'Avertismente');
tz_def('ADM_NOTICES', 'Notificari');
tz_def('ADM_DEPRECATED', 'Depreciat');
tz_def('ADM_FATAL_ERRORS', 'Erori fatale');
tz_def('ADM_MAX_FILE_SIZE_MB', 'Dimensiune maxima a fisierului (MB):');
tz_def('ADM_AUTO_OFF_AFTER_HOURS_0_NEVER', 'Oprire automata dupa (ore, 0 = niciodata):');
tz_def('ADM_SAVE_SETTINGS', 'Salveaza setarile');
tz_def('ADM_BEYOND_THE_SIZE_CAP_THE_FILE_IS_ROTATED_TO_A', 'Peste limita de dimensiune, fisierul e rotit intr-o singura');
tz_def('ADM_BACKUP_SO_THE_TOTAL_VOLUME_STAYS_BOUNDED', 'copie de rezerva, deci volumul total ramane limitat.');
tz_def('ADM_DOWNLOAD_FULL_LOG', '⬇ Descarca jurnalul complet');
tz_def('ADM_CLEAR_LOG', '🗑 Goleste jurnalul');
tz_def('ADM_REFRESH', '↻ Reimprospateaza');
tz_def('ADM_BACK_TO_VILLAGE', '← Inapoi la sat');
tz_def('ADM_RESEARCH_LOG', '— Jurnal de cercetare');
tz_def('ADM_LATEST_200_SEARCHES', 'Ultimele 200 de cercetari');
tz_def('ADM_NO_REGISTERED_SEARCHES', 'Nicio cercetare inregistrata.');
tz_def('ADM_TECH', 'TEHN');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - sabloane (lot 6: editAccess, editPassword, editProtection,
// editPlus, editWeek, editOverall, editAdditional, results_player/alliances/villages)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_CHANGE_ACCESS', 'Schimba accesul');
tz_def('ADM_NORMAL_USER', 'Utilizator normal');
tz_def('ADM_MULTIHUNTER', 'Multihunter');
tz_def('ADM_GIVE_PLAYERS_FREE_GOLD', 'Ofera aur jucatorilor');
tz_def('ADM_CHANGE_PASSWORD', 'Schimba parola:');
tz_def('ADM_THE_PASSWORD_IS_CHANGED_INSTANTLY_THE_PLAYER', 'Parola se schimba imediat. Jucatorul va fi deconectat. Nu se trimite niciun e-mail automat.');
tz_def('ADM_NEW_PASSWORD', 'Parola noua');
tz_def('ADM_GENERATE_SECURE_PASSWORD', '🎲 Genereaza o parola sigura');
tz_def('ADM_CHANGE_PASSWORD_2', '🔐 Schimba parola');
tz_def('ADM_INTRODU_PAROLA_NOU', 'Introdu parola noua');
tz_def('ADM_SHOW_HIDE', 'Arata/Ascunde');
tz_def('ADM_PROTECTION', 'Protectie:');
tz_def('ADM_CURRENT_STATUS_2', 'Stare curenta');
tz_def('ADM_1_DAY_2', '+1 zi');
tz_def('ADM_3_DAYS_2', '+3 zile');
tz_def('ADM_7_DAYS_2', '+7 zile');
tz_def('ADM_SET_TO_0_TO_REMOVE_PROTECTION_PROTECTION_IS', '💡 Pune 0 pentru a elimina protectia. Protectia se calculeaza din momentul salvarii.');
tz_def('ADM_SAVE_PROTECTION', '💾 Salveaza protectia');
tz_def('ADM_PLUS_BONUSES', '⭐ Plus si bonusuri:');
tz_def('ADM_THE_VALUES_ADD_UP_PUT_5_TO_ADD_5_DAYS_5_TO_R', 'ℹ️ Valorile se aduna. Pune 5 pentru a adauga 5 zile, -5 pentru a scadea 5 zile.');
tz_def('ADM_CURRENT_ACTIVE_BONUSES', '📊 Bonusuri active in prezent');
tz_def('ADM_ADD_REMOVE_DAYS', '➕ Adauga / scade zile');
tz_def('ADM_APPLY_BONUSES', '💾 Aplica bonusurile');
tz_def('ADM_WEEKLY_STATS', 'Statistici saptamanale:');
tz_def('ADM_ACESTEA_SUNT_PUNCTELE', '📊 Acestea sunt punctele');
tz_def('ADM_DIN_S_PT_M_NA_CURENT', 'din saptamana curenta');
tz_def('ADM_PENTRU_TOP_10_SE_RESETEAZ_AUTOMAT', 'pentru top 10. Se reseteaza automat.');
tz_def('ADM_ATTACK', 'Atac');
tz_def('ADM_RAID', 'Jaf');
tz_def('ADM_SAVE_WEEK', '💾 Salveaza saptamana');
tz_def('ADM_OVERALL_POINTS', 'Puncte totale:');
tz_def('ADM_ACESTEA_SUNT_PUNCTELE_2', '🛡️ Acestea sunt punctele');
tz_def('ADM_TOTALE', 'totale');
tz_def('ADM_DIN_STATISTICI_NU_CELE_S_PT_M_NALE_SE_ADUN_D', 'din statistici (nu cele saptamanale). Se aduna din toate atacurile.');
tz_def('ADM_ATTACK_POINTS', 'Puncte de atac');
tz_def('ADM_DEFENCE_POINTS', 'Puncte de aparare');
tz_def('ADM_SAVE_POINTS', '💾 Salveaza punctele');
tz_def('ADM_EDIT_ADDITIONAL', '⚙️ Informatii suplimentare:');
tz_def('ADM_ACCOUNT_CONTROL', '🔐 Controlul contului');
tz_def('ADM_ACCESS_LEVEL', 'Nivel de acces');
tz_def('ADM_0_BANNED', '0 - Blocat');
tz_def('ADM_2_NORMAL_USER', '2 - Utilizator normal');
tz_def('ADM_8_MULTIHUNTER', '8 - Multihunter');
tz_def('ADM_9_ADMIN', '9 - Administrator');
tz_def('ADM_VACATION_MODE_2', '🏖 Mod vacanta');
tz_def('ADM_0_DISABLED', '0 - Dezactivat');
tz_def('ADM_1_ENABLED', '1 - Activat');
tz_def('ADM_PROTECTION_2', '🛡️ Protectie');
tz_def('ADM_ZILE', 'zile');
tz_def('ADM_SITTERS', '👥 Inlocuitori');
tz_def('ADM_SITTER_1_UID', 'Inlocuitor 1 (UID)');
tz_def('ADM_SITTER_2_UID', 'Inlocuitor 2 (UID)');
tz_def('ADM_STATISTICS_POINTS', '📊 Statistici si puncte');
tz_def('ADM_CULTURE_POINTS', '🏛️ Puncte de cultura');
tz_def('ADM_ATTACK_POINTS_2', '⚔️ Puncte de atac');
tz_def('ADM_DEFENCE_POINTS_2', '🛡️ Puncte de aparare');
tz_def('ADM_RESOURCES_RAIDED', '💎 Resurse jefuite');
tz_def('ADM_TOTAL_ATTACK', '⚔️ Atac total');
tz_def('ADM_TOTAL_DEFENCE', '🛡️ Aparare totala');
tz_def('ADM_GOLD_2', 'aur');
tz_def('ADM_UID_2', 'UID');
tz_def('ADM_PLAYER_3', 'JUCATOR');
tz_def('ADM_VILLAGES_2', 'SATE');
tz_def('ADM_POP_2', 'POP.');
tz_def('ADM_AID', 'AID');
tz_def('ADM_NAME_2', 'NUME');
tz_def('ADM_TAG_2', 'TAG');
tz_def('ADM_FOUNDER_2', 'FONDATOR');
tz_def('ADM_VILLAGE_NAME', 'NUMELE SATULUI');
tz_def('ADM_OWNER_2', 'PROPRIETAR');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - sabloane (lot 7: natars, map, map_tile, artifact,
// goldShop, questEditor, multiacc, pushprot, blockReg, heatmap)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_WW_VILLAGES', '🏰 Sate MdL');
tz_def('ADM_NUMBER', 'Numar');
tz_def('ADM_PLAYER_ID', 'ID jucator');
tz_def('ADM_ADD_ARTIFACTS', '✨ Adauga artefacte');
tz_def('ADM_ICON', 'Iconita');
tz_def('ADM_DELETED_ARTIFACTS', '🗑️ Artefacte sterse');
tz_def('ADM_EFFECT', 'Efect');
tz_def('ADM_OLD_OWNER', 'Fostul proprietar');
tz_def('ADM_OLD_VILLAGE', 'Fostul sat');
tz_def('ADM_ARTIFACTS_OVERVIEW', '📊 Privire de ansamblu asupra artefactelor');
tz_def('ADM_RESTORE', 'Restaureaza');
tz_def('ADM_INTERACTIVE_WORLD_MAP_SEARCH_PLAYERS_VILLAGE', 'Harta interactiva a lumii – cauta jucatori, sate si artefacte');
tz_def('ADM_PLAYERS', 'Jucatori');
tz_def('ADM_ARTIFACTS', 'Artefacte');
tz_def('ADM_APPLY_FILTERS', 'Aplica filtrele');
tz_def('ADM_TRIBES', 'Triburi');
tz_def('ADM_MULTIHUNTERS', 'Multihunteri');
tz_def('ADM_CHECK_EDIT_MAP_TILE', 'Verifica si editeaza o casuta');
tz_def('ADM_CHECK_TILE', 'Verifica casuta');
tz_def('ADM_AREA_OF_EFFECT', 'Zona de efect');
tz_def('ADM_TIME_OF_CONQUER', 'Momentul cuceririi');
tz_def('ADM_TIME_OF_ACTIVATION', 'Momentul activarii');
tz_def('ADM_RETURN_TO_NATARS', 'Returneaza Natarilor');
tz_def('ADM_SHOP_PROMO_CODES', 'Magazin si coduri promo');
tz_def('ADM_DIRECTLY', 'direct.');
tz_def('ADM_CREATE_A_CODE', 'Creeaza un cod');
tz_def('ADM_CODE', 'Cod');
tz_def('ADM_MAX_USES_0', 'Utilizari maxime (0 = &infin;)');
tz_def('ADM_EXPIRES_IN_DAYS_0_NEVER', 'Expira in (zile, 0 = niciodata)');
tz_def('ADM_ONCE_PER_PLAYER', 'o data per jucator');
tz_def('ADM_NOTE_OPTIONAL', 'Nota (optional)');
tz_def('ADM_CREATE', 'Creeaza');
tz_def('ADM_CODES_ARE_CASE_INSENSITIVE_ALLOWED_CHARACTER', 'Codurile nu tin cont de majuscule; caractere permise: A-Z 0-9 . _ &ndash;');
tz_def('ADM_NO_PROMO_CODES_YET', 'Niciun cod promo inca.');
tz_def('ADM_USES', 'Utilizari');
tz_def('ADM_SCOPE', 'Domeniu');
tz_def('ADM_NOTE', 'Nota');
tz_def('ADM_RECENT_REDEMPTIONS', 'Utilizari recente');
tz_def('ADM_NO_REDEMPTIONS_YET', 'Nicio utilizare inca.');
tz_def('ADM_WHEN', 'Cand');
tz_def('ADM_REASON_CAMPAIGN', 'motiv / campanie');
tz_def('ADM_QUEST_2', 'Misiune');
tz_def('ADM_EDITOR', 'Editor');
tz_def('ADM_QTYP_37', 'qtyp&nbsp;37');
tz_def('ADM_GET', 'primesc');
tz_def('ADM_EXTENDED', 'extinsa');
tz_def('ADM_EVERYONE_ELSE', ', toti ceilalti');
tz_def('ADM_STANDARD', 'standard');
tz_def('ADM_REWARD_VALUES_ARE_LIVE_VIA', 'Valorile recompenselor sunt aplicate prin');
tz_def('ADM_FIXED', 'fix');
tz_def('ADM_STANDARD_QUEST_CORE25', 'Standard (quest_core25)');
tz_def('ADM_EXTENDED_QUEST_CORE', 'Extinsa (quest_core)');
tz_def('ADM_ON', 'Activ');
tz_def('ADM_PLUS_DAYS', 'Plus (zile)');
tz_def('ADM_REQ_LEVEL', 'Nivel&nbsp;necesar');
tz_def('ADM_QUEST_HOVER', 'Misiune (la trecerea cursorului)');
tz_def('ADM_SAVE_ALL_CHANGES', 'Salveaza toate modificarile');
tz_def('ADM_SAVES_EVERY_ROW_FOR_THE', 'Salveaza fiecare rand pentru varianta');
tz_def('ADM_VARIANT', 'varianta.');
tz_def('ADM_RESET_THIS_VARIANT_TO_DEFAULTS', 'Reseteaza aceasta varianta la valorile implicite');
tz_def('ADM_MULTI_ACCOUNT', 'Conturi multiple');
tz_def('ADM_DETECTION', 'Detectare');
tz_def('ADM_RISK_SCORE_NOT_PROOF', 'scor de risc, nu o dovada');
tz_def('ADM_WINDOW_DAYS', 'Fereastra (zile)');
tz_def('ADM_MIN_SCORE', 'Scor minim');
tz_def('ADM_FOCUS_ON_UID_OPTIONAL', 'Concentreaza-te pe un UID (optional)');
tz_def('ADM_ANALYSE', 'Analizeaza');
tz_def('ADM_NO_ACCOUNT_PAIRS_AT_OR_ABOVE_THE_CURRENT_SCO', 'Nicio pereche de conturi la sau peste pragul curent de scor.');
tz_def('ADM_RISK', 'Risc');
tz_def('ADM_ACCOUNT_A', 'Contul A');
tz_def('ADM_ACCOUNT_B', 'Contul B');
tz_def('ADM_WHY', 'De ce');
tz_def('ADM_LOGIN_LOG', 'jurnal de autentificare');
tz_def('ADM_FOCUS', 'concentreaza');
tz_def('ADM_RESET_2', 'reseteaza');
tz_def('ADM_DASHBOARD', 'Panou general');
tz_def('ADM_PER_PLAYER', 'Per jucator');
tz_def('ADM_7_DAY_RESOURCE_BALANCE', 'Bilantul resurselor pe 7 zile');
tz_def('ADM_HOURS_OF_PROD_ALLOWED', 'Ore de productie permise');
tz_def('ADM_SHOW_2', 'Arata');
tz_def('ADM_ALL_WITH_ACTIVITY', 'Toti cu activitate');
tz_def('ADM_OVER_LIMIT_ONLY', 'Doar peste limita');
tz_def('ADM_WW_ARTEFACT_OVERRIDDEN', 'MdL / artefact / cu exceptie');
tz_def('ADM_REFRESH_2', 'Reimprospateaza');
tz_def('ADM_NO_INTER_PLAYER_TRANSFERS_RECORDED_IN_THIS_W', 'Niciun transfer intre jucatori inregistrat in aceasta fereastra.');
tz_def('ADM_VILLAGES_POP', 'Sate / Pop.');
tz_def('ADM_PROD_H', 'Prod./h');
tz_def('ADM_RECEIVED_7D', 'Primit (7 zile)');
tz_def('ADM_LIMIT', 'Limita');
tz_def('ADM_USAGE', 'Utilizare');
tz_def('ADM_OVERRIDE', 'Exceptie');
tz_def('ADM_AUTO', 'Auto');
tz_def('ADM_CUSTOM_CAP', 'Plafon personalizat');
tz_def('ADM_SAVE_3', 'Salveaza');
tz_def('ADM_REGISTRATION', 'Inregistrare');
tz_def('ADM_BLOCKLIST', 'Lista de blocare');
tz_def('ADM_BLOCK_NEW_REGISTRATIONS_BY_A_SPECIFIC', 'Blocheaza inregistrarile noi dupa un anumit');
tz_def('ADM_USERNAME_3', 'nume de utilizator');
tz_def('ADM_A_SPECIFIC', ', o anumita');
tz_def('ADM_OR_A_WHOLE', ', sau un intreg');
tz_def('ADM_E_MAIL_DOMAIN', 'domeniu de e-mail');
tz_def('ADM_ADD_A_BLOCK', 'Adauga o blocare');
tz_def('ADM_E_MAIL_ADDRESS', 'Adresa de e-mail');
tz_def('ADM_E_MAIL_DOMAIN_2', 'Domeniu de e-mail');
tz_def('ADM_VALUE', 'Valoare');
tz_def('ADM_ADD_BLOCK', 'Adauga blocarea');
tz_def('ADM_DOMAIN_ENTER_JUST_THE_DOMAIN', 'Domeniu: introdu doar domeniul (');
tz_def('ADM_NO_REGISTRATION_BLOCKS_YET', 'Nicio blocare la inregistrare inca.');
tz_def('ADM_ADDED', 'Adaugat');
tz_def('ADM_REASON_2', 'motiv');
tz_def('ADM_REMOVE_2', 'elimina');
tz_def('ADM_WORLD_MAP', 'Harta lumii');
tz_def('ADM_HEATMAP', 'Harta termica');
tz_def('ADM_GRID_RESOLUTION', 'Rezolutia grilei');
tz_def('ADM_INACTIVE_AFTER_DAYS', 'Inactiv dupa (zile)');
tz_def('ADM_REBUILD', 'Reconstruieste');
tz_def('ADM_VILLAGE_DENSITY', 'Densitatea satelor');
tz_def('ADM_TRIBE_DENSITY', 'Densitatea triburilor');
tz_def('ADM_INACTIVITY', 'Inactivitate');
tz_def('ADM_ATTACKS', 'Atacuri');
tz_def('ADM_SUMMARY', 'Rezumat');
tz_def('ADM_PLAYER_VILLAGES', 'Satele jucatorilor');
tz_def('ADM_INACTIVE_VILLAGES', 'Sate inactive');
tz_def('ADM_ATTACKS_IN_FLIGHT', 'Atacuri in desfasurare');
tz_def('ADM_LEGEND', 'Legenda');
tz_def('ADM_TRIBE_TOTALS', 'Totaluri pe triburi');
tz_def('ADM_NO_PLAYER_VILLAGES_FOUND', 'Niciun sat de jucator gasit.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - sabloane (lot 8, final: restul de 26 de sabloane)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_404_FILE_NOT_FOUND', '404 - Fisier negasit');
tz_def('ADM_WE_LOOKED_404_TIMES_ALREADY_BUT_CAN_T_FIND_A', 'Am cautat deja de 404 ori si nu gasim nimic, nici macar un X care sa marcheze locul.');
tz_def('ADM_THIS_SYSTEM_IS_NOT_COMPLETE_YET_SO_THE_PAGE', 'Acest sistem nu e inca terminat. Deci pagina probabil nu exista.');
tz_def('ADM_NOT_FOUND', 'Negasit');
tz_def('ADM_NEW_MESSAGE', 'Mesaj nou');
tz_def('ADM_TO', 'catre');
tz_def('ADM_RECIPIENT', 'Destinatar');
tz_def('ADM_SEND_MESSAGE', 'Trimite mesajul');
tz_def('ADM_PLAYER_NOT_FOUND', 'Jucatorul nu a fost gasit.');
tz_def('ADM_GO_BACK', 'Inapoi');
tz_def('ADM_MESSAGE_FROM_ADMIN', 'Mesaj de la administrator');
tz_def('ADM_WRITE_YOUR_MESSAGE_HERE', 'Scrie mesajul aici...');
tz_def('ADM_TROOP', 'Trupa');
tz_def('ADM_ARMOURY', 'Armurarie');
tz_def('ADM_BLACKSMITH', 'Fierarie');
tz_def('ADM_BACK_3', 'Inapoi');
tz_def('ADM_NOW', 'Acum:');
tz_def('ADM_CREATE_USERS', '👤 Creeaza jucatori');
tz_def('ADM_SUBMITTING_THIS_FORM_WILL_CREATE_NEW_USERS_A', 'Trimiterea acestui formular va crea jucatori si/sau sate noi pe serverul tau!');
tz_def('ADM_MANY_ACCOUNTS_1_VILLAGE', 'Mai multe conturi (1 sat)');
tz_def('ADM_1_ACCOUNT_MANY_VILLAGES', '1 cont (mai multe sate)');
tz_def('ADM_BASE_NAME', 'Nume de baza');
tz_def('ADM_4_20_CHARACTERS_EX_FARM_5_FARM1_FARM5_SINGLE', '4-20 caractere. Ex.: Farm | 5 → Farm1..Farm5. Cont unic: FarmLord | 5 sate.');
tz_def('ADM_WARNING_2', 'Atentie:');
tz_def('ADM_LARGE_VALUES_MAY_FREEZE_THE_SERVER', 'valorile mari pot bloca serverul!');
tz_def('ADM_HOW_MANY_ACCOUNTS', 'Cate conturi');
tz_def('ADM_HOW_MANY_VILLAGES', 'Cate sate');
tz_def('ADM_1_200_SINGLE_ONLY', '1 - 200 (doar cont unic)');
tz_def('ADM_ENABLE_BEGINNER_PROTECTION', 'Activeaza protectia incepatorilor');
tz_def('ADM_CREATE_2', '+ Creeaza');
tz_def('ADM_ADD_VILLAGE', 'Adauga un sat');
tz_def('ADM_COORDINATES_X_Y', 'Coordonate (X|Y)');
tz_def('ADM_ADD_VILLAGE_2', 'ADAUGA SATUL');
tz_def('ADM_TO_ENSURE_THAT_YOU_WON_T_GET_BANNED_AGAIN_IN', 'Pentru a nu mai fi blocat pe viitor, citeste cu atentie regulamentul');
tz_def('ADM_GAME_RULES', '» Regulile jocului');
tz_def('ADM_TO_CONTINUE_PLAYING_CONTACT_THE_MULTIHUNTER', 'Pentru a continua sa joci, contacteaza Multihunterul si lamureste situatia cu el');
tz_def('ADM_WRITE_MESSAGE', '» Scrie un mesaj');
tz_def('ADM_HEED_THE_FOLLOWING_ADVICE_WHEN_WRITING_YOUR', 'Tine cont de urmatoarele sfaturi cand scrii mesajul:');
tz_def('ADM_THERE_IS_ALWAYS_A_REASON_FOR_A_BAN', '● Exista intotdeauna un motiv pentru o blocare.');
tz_def('ADM_TRY_TO_THINK_ABOUT_POSSIBLE_REASONS_FOR_THIS', 'Gandeste-te la motivele posibile ale acestei blocari');
tz_def('ADM_AND_PUT_THINGS_STRAIGHT_WITH_THE_MULTIHUNTER', 'si lamureste situatia cu Multihunterul.');
tz_def('ADM_MULTIHUNTERS_CAN_REVIEW_ENORMOUS_AMOUNTS_OF', '● Multihunterii pot analiza cantitati enorme de informatii despre conturi.');
tz_def('ADM_STICK_TO_THE_TRUTH', 'Spune adevarul');
tz_def('ADM_AND_DO_NOT_MAKE_EXCUSES_TO_JUSTIFY_YOUR_VIOL', 'si nu cauta scuze ca sa justifici incalcarea regulilor.');
tz_def('ADM_BE_COOPERATIVE_AND_INSIGHTFUL_THIS_MIGHT_RED', '● Fii cooperant si intelegator, asta poate reduce pedeapsa.');
tz_def('ADM_CALM_AND_POLITE', 'calm si politicos');
tz_def('ADM_WHILE_TALKING_TO_THE_MULTIHUNTER_AND_TELLING', 'cand vorbesti cu Multihunterul si ii prezinti punctul tau de vedere.');
tz_def('ADM_INCLUDES_RESOURCES_MAIN_BUILDING_RALLY_POINT', 'Include resurse, cladirea principala, punctul de adunare, depozitul, hambarul, zidul, piata, resedinta, trupe (pentru cresterea eroului) si o ascunzatoare.');
tz_def('ADM_IF_THE_MULTIHUNTER_DOES_NOT_ANSWER_IMMEDIATE', '● Daca Multihunterul nu raspunde imediat, probabil nu e online. Trimiterea mai multor mesaje nu va rezolva problema mai repede, mai ales daca nici primul nu a fost citit.');
tz_def('ADM_IF_YOU_HAVE_REALLY_BEEN_BANNED_UNJUSTLY_TRY', '● Daca ai fost blocat pe nedrept, incearca sa ramai');
tz_def('ADM_RESOURCE', 'Resursa');
tz_def('ADM_AMOUNT', 'Cantitate');
tz_def('ADM_MAXIMUM_CAPACITY', 'Capacitate maxima');
tz_def('ADM_BACK_TO_VILLAGE_2', '← Inapoi la sat');
tz_def('ADM_ADMIN_CONTROL', 'Control administrare');
tz_def('ADM_SERVER_ADMINISTRATION', 'Administrarea serverului');
tz_def('ADM_SECURE_ACCESS_TO_TRAVIANZ_PANEL', 'Acces securizat la panoul TravianZ');
tz_def('ADM_PASSWORD', 'Parola');
tz_def('ADM_ACCESS_PANEL', 'Acceseaza panoul');
tz_def('ADM_ENTER_ADMIN_USERNAME', 'Introdu numele de administrator');
tz_def('ADM_ROMANS', 'Romani');
tz_def('ADM_TEUTONS', 'Teutoni');
tz_def('ADM_GAULS', 'Gali');
tz_def('ADM_RESET_GOLD_FOR_ALL_PLAYERS', 'Reseteaza aurul tuturor jucatorilor');
tz_def('ADM_RESET_ALL_PLAYERS_GOLD', 'Reseteaza aurul tuturor jucatorilor');
tz_def('ADM_THIS_ACTION_WILL_SET_THE_GOLD_TO', 'Aceasta actiune va seta aurul la');
tz_def('ADM_FOR_ALL_PLAYERS_FROM_THE_SERVER', 'pentru TOTI jucatorii de pe server.');
tz_def('ADM_WARNING_THE_ACTION_IS_IRREVERSIBLE_MAKE_SURE', '⚠️ ATENTIE: actiunea e ireversibila! Asigura-te ca ai o copie de rezerva.');
tz_def('ADM_RESET_GOLD_NOW', 'RESETEAZA AURUL ACUM');
tz_def('ADM_ALL_PLAYERS_GOLD_HAS_BEEN_RESET', '✓ Aurul tuturor jucatorilor a fost resetat!');
tz_def('ADM_RESET_ALL_PLAYERS_PLUS', 'Reseteaza Plus pentru toti jucatorii');
tz_def('ADM_THIS_ACTION_WILL_DISABLE_TRAVIAN_PLUS_FOR_AL', 'Aceasta actiune va dezactiva Travian Plus pentru TOTI jucatorii.');
tz_def('ADM_PLUS_IT_WILL_BE_SET_TO_0_DAYS_FOR_EVERYONE', '⚠️ Plus va fi setat la 0 zile pentru toata lumea.');
tz_def('ADM_RESET_PLUS_NOW', 'RESETEAZA PLUS ACUM');
tz_def('ADM_PLUS_ALL_THE_PLAYERS_HAVE_BEEN_RESET', '✓ Plus a fost resetat pentru toti jucatorii!');
tz_def('ADM_RESET_ALL_RESOURCE_BONUSES', 'Reseteaza toate bonusurile de resurse');
tz_def('ADM_THIS_ACTION_WILL_DISABLE_THE_25_BONUS_FOR_AL', 'Aceasta actiune va dezactiva bonusul de 25% la TOATE resursele, pentru toti jucatorii.');
tz_def('ADM_ALL_RESOURCE_BONUSES_WILL_BE_SET_TO_0_DAYS', '⚠️ Toate bonusurile de resurse vor fi setate la 0 zile.');
tz_def('ADM_RESET_RESOURCE_BONUS', 'RESETEAZA BONUSUL DE RESURSE');
tz_def('ADM_RESOURCE_BONUSES_HAVE_BEEN_RESET_FOR_ALL_PLA', '✓ Bonusurile de resurse au fost resetate pentru toti jucatorii!');
tz_def('ADM_IGM_REPORTS_LOOKUP', 'Cautare mesaje / rapoarte');
tz_def('ADM_IGM_BY_ID', 'Mesaj dupa ID');
tz_def('ADM_GO', 'Mergi');
tz_def('ADM_REPORT_BY_ID', 'Raport dupa ID');
tz_def('ADM_ENTER_MESSAGE_ID', 'Introdu ID-ul mesajului...');
tz_def('ADM_ENTER_REPORT_ID', 'Introdu ID-ul raportului...');
tz_def('ADM_SITTER_1_2', 'Inlocuitor 1');
tz_def('ADM_SITTER_2_2', 'Inlocuitor 2');
tz_def('ADM_CULTURE_POINTS_2', 'Puncte de cultura');
tz_def('ADM_ATTACK_POINTS_THIS_WEEK', 'Puncte de atac (saptamana aceasta)');
tz_def('ADM_DEFENCE_POINTS_THIS_WEEK', 'Puncte de aparare (saptamana aceasta)');
tz_def('ADM_RESOURCES_RAIDED_THIS_WEEK', 'Resurse jefuite (saptamana aceasta)');
tz_def('ADM_TOTAL_ATTACK_POINTS', 'Puncte de atac totale');
tz_def('ADM_TOTAL_DEFENCE_POINTS', 'Puncte de aparare totale');
tz_def('ADM_EDIT_PLAYER_ADDITIONAL_INFO', 'Editeaza informatiile suplimentare ale jucatorului');
tz_def('ADM_THE_ACCOUNT_WILL_BE_DELETED_IN', 'Contul va fi sters in');
tz_def('ADM_CANCEL_3', '✖ Anuleaza');
tz_def('ADM_CANCEL_DELETION', 'Anuleaza stergerea');
tz_def('ADM_DESCRIPTION', 'Descriere');
tz_def('ADM_AGE', 'Varsta');
tz_def('ADM_GENDER', 'Sex');
tz_def('ADM_LOCATION_2', 'Locatie');
tz_def('ADM_LAST_IP', 'Ultimul IP');
tz_def('ADM_LANGUAGE', 'Limba');
tz_def('ADM_BAN_USER_2', '&raquo; Blocheaza jucatorul');
tz_def('ADM_SEND_MESSAGE_2', '&raquo; Trimite un mesaj');
tz_def('ADM_EDIT_PLUS_RES_BONUS', '&raquo; Editeaza Plus si bonusul de resurse');
tz_def('ADM_EDIT_SITTERS_2', '&raquo; Editeaza inlocuitorii');
tz_def('ADM_EDIT_PROTECTION', '&raquo; Editeaza protectia');
tz_def('ADM_EDIT_PASSWORD', '&raquo; Editeaza parola');
tz_def('ADM_EDIT_OVERALL_OFF_DEF', '&raquo; Editeaza atacul si apararea totale');
tz_def('ADM_EDIT_WEEKLY_OFF_DEF_RAID', '&raquo; Editeaza atac, aparare, jaf saptamanal');
tz_def('ADM_USER_LOGIN_LOG', '&raquo; Jurnal de autentificare');
tz_def('ADM_USER_ILLEGAL_LOG', '&raquo; Jurnal de nereguli');
tz_def('ADM_RECOUNT_POPULATION', 'Recalculeaza populatia');
tz_def('ADM_EMAIL_2', 'E-MAIL');
tz_def('ADM_IP', 'IP');
tz_def('ADM_TRIBE_3', 'Trib:');
tz_def('ADM_VILLAGES_3', 'Sate:');
tz_def('ADM_POP_3', 'Pop.:');
tz_def('ADM_COORDS_2', 'Coordonate:');
tz_def('ADM_ILLEGALS_LOG', '🚨 Jurnal de nereguli:');
tz_def('ADM_DETECTED_OFFENCES', 'Nereguli detectate');
tz_def('ADM_BACK_TO_PLAYER', '← Inapoi la jucator');
tz_def('ADM_LOGIN_LOG_2', '🔐 Jurnal de autentificare:');
tz_def('ADM_RECENT_LOGIN_ATTEMPTS', 'Incercari recente de autentificare');
tz_def('ADM_LOG_ID', 'ID jurnal');
tz_def('ADM_IP_ADDRESS', 'Adresa IP');
tz_def('ADM_INFO', 'Info');
tz_def('ADM_BUILD_LOG', '— Jurnal de constructii');
tz_def('ADM_LATEST_200_ACTION', 'Ultimele 200 de actiuni');
tz_def('ADM_NO_ACTION_RECORDED_YET', 'Nicio actiune inregistrata.');
tz_def('ADM_POPULATION_2', 'POPULATIE');
tz_def('ADM_COORDINATES', 'COORDONATE');
tz_def('ADM_TROOPS_2', 'TRUPE');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - texte lungi si pe mai multe randuri (curatare finala)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_E_MAIL_ADDRESS_2', 'adresa de e-mail');
tz_def('ADM_E_G_AN_OBSCENE_USERNAME_OR_THE_ENTIRE', '(de ex. un nume obscen, sau intregul');
tz_def('ADM_DOMAIN_MATCHING_IS_EXACT_AND_CASE_INSENSITIV', 'domeniu). Potrivirea e exacta si nu tine cont de majuscule. Conturile existente nu sunt afectate &mdash; doar inregistrarile noi.');
tz_def('ADM_WITH_OR_WITHOUT_THE_LEADING_E_MAIL_THE_FULL', '), cu sau fara &ldquo;@&rdquo; la inceput. E-mail: adresa completa. Nume de utilizator: numele exact.');
tz_def('ADM_SILVER_2', 'argint &nbsp;|&nbsp;');
tz_def('ADM_OF_EACH', 'din fiecare &nbsp;|&nbsp;');
tz_def('ADM_HOURLY_RESOURCES_PRODUCED_BY_EACH_POINT_THE', 'Resurse pe ora produse de fiecare punct investit in atributul Resurse al eroului, in satul in care se afla. Jucatorii aleg liber intre a le raspandi pe toate patru sau a le concentra pe una singura.');
tz_def('ADM_HOURLY_RESOURCES_PER_POINT_INVESTED_IN_THE_H', 'Resurse pe ora pentru fiecare punct investit in atributul Resurse al eroului. Prima valoare se aplica atunci cand bonusul e raspandit pe toate patru, a doua cand e concentrat pe una singura. Ambele se scaleaza cu viteza serverului.');
tz_def('ADM_HIT_POINTS_THE_HERO_RECOVERS_PER_DAY_ON_TOP', 'Puncte de viata recuperate zilnic de erou, peste punctele investite in atributul de regenerare si peste itemele echipate. Fara asta, un erou fara puncte de regenerare nu s-ar vindeca niciodata si ar muri in cele din urma in aventuri. Se scaleaza cu viteza serverului. 0 dezactiveaza.');
tz_def('ADM_HOW_LONG_ONE_CRON_PHP_INVOCATION_KEEPS_WORKI', 'Cat timp continua sa lucreze o invocare de cron.php. Majoritatea hosturilor partajate permit cron doar la 5 minute, in timp ce Automation se asteapta sa ruleze cam la un minut &mdash; deci o invocare face mai multe tick-uri la rand. Foloseste 300 pentru un cron "*/5". Pune 0 doar daca hostul tau permite cron la fiecare minut.');
tz_def('ADM_ENABLE_DISABLE_IF_A_PLAYER_LEAVES_AT_LEAST_O', 'Activeaza (dezactiveaza): daca un jucator lasa cel putin un mesaj intr-un subiect de pe forum, va primi mesaje in joc despre aparitia unor mesaje noi in acelasi subiect (adica e tehnic "abonat")');
tz_def('ADM_ENABLE_DISABLE_THE_SERVER_MILESTONES_WIDGET', 'Activeaza (dezactiveaza) widgetul "Etape ale serverului" (primul jucator care intemeiaza al 2-lea sat, atinge 1000 de populatie, captureaza un artefact, cucereste o MdL, cucereste un plan de MdL, fondeaza o alianta sau cucereste satul altui jucator), afisat sus in Statistici &raquo; General');
tz_def('ADM_CREATE_PROMO_VOUCHER_CODES_PLAYERS_REDEEM_FO', 'Creeaza coduri promo pe care jucatorii le schimba pe aur in pagina Plus. Stabileste o cantitate fixa de aur, o limita optionala de utilizari, daca fiecare jucator il poate folosi o singura data si o expirare optionala. Pentru o recompensa unica de vanator de buguri, creeaza un cod cu maxim 1 utilizare &mdash; sau foloseste');
tz_def('ADM_DENSITY_OVERLAYS_ON_THE_WORLD_GRID_TO_HELP_W', 'Straturi de densitate peste grila lumii, utile pentru echilibrul de start: unde se aglomereaza satele, ce triburi domina o regiune, unde stau jucatorii inactivi (zone moarte / locuri bune de aparitie) si unde aterizeaza atacurile in prezent. Nordul (+y) e in sus.');
tz_def('ADM_HEURISTIC_CORRELATION_OF_ACCOUNT_PAIRS_BY_SH', 'Corelare euristica a perechilor de conturi dupa IP comun, subretea, amprenta de dispozitiv/browser (User-Agent), suprapunerea orelor de conectare si fluxul de transferuri de resurse. Acesta e un');
tz_def('ADM_USE_IT_TO_PRIORITISE_WHICH_PAIRS_A_HUMAN_SHO', '&mdash; foloseste-l ca sa stabilesti ce perechi merita investigate de un om. Nimic nu se blocheaza automat.');
tz_def('ADM_ROW_CAP_REACHED_WHILE_SCANNING_LOGIN_HISTORY', 'S-a atins limita de randuri la scanarea istoricului de autentificari (fereastra e mare / serverul e foarte incarcat). Rezultatele raman valide, dar pot fi incomplete &mdash; ingusteaza fereastra pentru acoperire completa.');
tz_def('ADM_RECEIVED_FROM_OTHER_PLAYERS_VERSUS_AN_AUTOMA', '(primite de la alti jucatori) fata de o limita automata derivata din productia orara a jucatorului (');
tz_def('ADM_OF_PRODUCTION_PER_WINDOW_WW_VILLAGES_AND_ART', 'de productie per fereastra). Satele MdL si satele cu artefact sunt marcate ca exceptii de aprovizionare. Seteaza o exceptie manuala ca sa scutesti un jucator (MdL / de incredere) sau ca sa-i dai un plafon personalizat. Nimic nu se blocheaza automat &mdash; asta ofera vizibilitate si control unui moderator uman.');
tz_def('ADM_THE_7_DAY_BALANCE_FILLS_IN_AS_MERCHANT_DELIV', 'Bilantul pe 7 zile se completeaza pe masura ce livrarile de negustori intre jucatori diferiti sunt procesate dupa activarea acestei functii.');
tz_def('ADM_EDIT_THE_REWARD_EACH_QUEST_GRANTS_WOOD_CLAY', 'Editeaza recompensa acordata de fiecare misiune (lemn / lut / fier / cereale / aur / zile de Plus) si nivelul necesar (de ex. nivelul cladirii principale pentru misiunile de constructie). Valorile pornesc de la cele implicite livrate, deci nu se schimba nimic pana nu editezi. Cele doua variante de misiuni au misiuni si recompense diferite &mdash; alege-o pe cea folosita de serverul tau (jucatorii pe');
tz_def('ADM_IN_THE_QUEST_TEMPLATES_QUESTS_MARKED', 'in sabloanele de misiuni. Misiunile marcate');
tz_def('ADM_KEEP_THEIR_ORIGINAL_HARDCODED_LOGIC_CONDITIO', 'isi pastreaza logica originala scrisa in cod (recompense conditionate, revendicari atomice de etape, mecanici speciale) si nu sunt afectate de modificarile de aici. Sumele afisate in textul fiecarei misiuni sunt siruri separate de sablon &mdash; modificarile de aici schimba ce se acorda efectiv; actualizeaza sirurile de limba daca vrei ca previzualizarea sa corespunda.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// BONUSURI DE ALIANTA (port T4)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ALLYBONUS_TAB', 'Bonusuri');
tz_def('ALLYBONUS_RECRUITMENT', 'Recrutare');
tz_def('ALLYBONUS_PHILOSOPHY', 'Filosofie');
tz_def('ALLYBONUS_METALLURGY', 'Metalurgie');
tz_def('ALLYBONUS_COMMERCE', 'Comert');
tz_def('ALLYBONUS_LEVEL', 'Nivel');
tz_def('ALLYBONUS_NEXT', 'urmator');
tz_def('ALLYBONUS_MAXED', 'Deblocat complet');
tz_def('ALLYBONUS_UNLOCKING', 'Se deblocheaza nivelul');
tz_def('ALLYBONUS_DONATE', 'Doneaza');
tz_def('ALLYBONUS_TRIPLE', 'Tripleaza aceasta donatie');
tz_def('ALLYBONUS_DAILY_LEFT', 'Cat mai poti dona azi');
tz_def('ALLYBONUS_CONTRIBUTORS', 'Contributii');
tz_def('ALLYBONUS_MEMBER', 'Membru');
tz_def('ALLYBONUS_TOTAL', 'Donat');
tz_def('ALLYBONUS_MSG_OK', 'Resurse donate.');
tz_def('ALLYBONUS_MSG_UPGRADING', 'Acest bonus se deblocheaza acum; donatiile sunt oprite.');
tz_def('ALLYBONUS_MSG_LIMIT', 'Ai depasi plafonul zilnic de donatie.');
tz_def('ALLYBONUS_MSG_RESOURCES', 'Nu ai destule resurse in acest sat.');
tz_def('ALLYBONUS_MSG_NOGOLD', 'Nu ai destul aur ca sa triplezi donatia.');
tz_def('ALLYBONUS_MSG_NOALLY', 'Nu esti intr-o alianta.');
tz_def('ALLYBONUS_MSG_INVALID', 'Donatie invalida.');
tz_def('ALLYBONUS_HINT', 'Tipul resursei nu conteaza, ci doar totalul. Cat timp un nivel se deblocheaza, bonusul acela nu mai primeste donatii.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - pachet grafic si bonusuri de alianta
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_SERVER_GRAPHIC_PACK', 'Pachetul grafic al serverului');
tz_def('ADM_SERVER_GRAPHIC_PACK_TIP', 'Pachetul grafic pe care il vad implicit toti jucatorii, citit din folderul gpack/.');
tz_def('ADM_PLAYER_GRAPHIC_PACKS', 'Pachete grafice ale jucatorilor');
tz_def('ADM_PLAYER_GRAPHIC_PACKS_TIP', 'Daca e activat, jucatorii isi pot alege propriul pachet grafic din profil (Profil &rarr; Grafica). Daca e dezactivat, toata lumea vede pachetul serverului.');
tz_def('ADM_ALLIANCE_BONUSES', 'Bonusuri de alianta');
tz_def('ADM_ALLIANCE_BONUSES_TIP', 'Bonusuri de alianta T4: membrii doneaza resurse ca sa deblocheze Recrutare, Filosofie, Metalurgie si Comert.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// BONUSURI DE ALIANTA - descrierile fiecarui bonus
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ALLYBONUS_RECRUITMENT_DESC', 'Grabeste instruirea trupelor in toate cladirile care produc trupe. Se inmulteste cu coifurile eroului.');
tz_def('ALLYBONUS_PHILOSOPHY_DESC', 'Creste productia de puncte de cultura de la cladiri si de la coifurile eroului. Serbarile din primarie nu sunt afectate.');
tz_def('ALLYBONUS_METALLURGY_DESC', 'Creste forta de atac si de aparare a trupelor, peste imbunatatirile din fierarie.');
tz_def('ALLYBONUS_COMMERCE_DESC', 'Creste cat poate cara fiecare negustor. Se inmulteste cu biroul comercial.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// STATISTICI GRAFICE (Travian Plus)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('PLUSSTATS_TITLE', 'Statistici grafice');
tz_def('PLUSSTATS_INTRO', 'Evolutia contului tau in timp.');
tz_def('PLUSSTATS_RANK', 'Clasament');
tz_def('PLUSSTATS_POP', 'Populatie');
tz_def('PLUSSTATS_ARMY', 'Puterea armatei (cereale consumate pe ora)');
tz_def('PLUSSTATS_VILLAGES', 'Sate');
tz_def('PLUSSTATS_TROOPS', 'Trupe');
tz_def('PLUSSTATS_UPKEEP', 'Cereale consumate pe ora');
tz_def('PLUSSTATS_METRIC', 'Indicator');
tz_def('PLUSSTATS_NOW', 'Acum');
tz_def('PLUSSTATS_CHANGE', 'Evolutie');
tz_def('PLUSSTATS_NODATA', 'Inca nu sunt destule date');
tz_def('PLUSSTATS_WAIT', 'Contul tau se inregistreaza. Graficele apar dupa ce exista cel putin doua masuratori.');
tz_def('PLUSSTATS_NEEDPLUS', 'Statisticile grafice sunt o functie Travian Plus. Activeaza Plus ca sa vezi evolutia contului.');
tz_def('PLUSSTATS_DISABLED', 'Statisticile grafice nu sunt activate pe acest server.');
tz_def('PLUSSTATS_FOOT', 'Puterea armatei se masoara prin cerealele consumate, cantarul propriu al jocului: o unitate puternica valoreaza mai mult decat una slaba. Trupele trimise ca intarire la alti jucatori raman ale tale.');
tz_def('ADM_PLUS_STATISTICS', 'Statistici grafice Plus');
tz_def('ADM_PLUS_STATISTICS_TIP', 'Inregistreaza rangul, populatia, satele si armata fiecarui jucator, ca jucatorii cu Plus sa vada cum a evoluat contul. Tabul se vede doar cu Plus activ.');
tz_def('ADM_PLUS_STATISTICS_INTERVAL', 'Intervalul intre masuratori (ore)');
tz_def('ADM_PLUS_STATISTICS_INTERVAL_TIP', 'Cat de des se ia o masuratoare. Pe un server rapid o zi inseamna mult joc, asa ca cateva ore dau o curba lizibila.');
tz_def('ADM_PLUS_STATISTICS_KEEP', 'Istoric pastrat (zile)');
tz_def('ADM_PLUS_STATISTICS_KEEP_TIP', '0 pastreaza tot, ca jucatorii sa vada istoricul complet al contului de la inceputul inregistrarii.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// BONUSURI DE ALIANTA - disponibilitate pentru membrii noi
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ALLYBONUS_YOURLEVEL', 'Nivelul tau');
tz_def('ALLYBONUS_UNLOCKS_IN', 'urmatorul in');
tz_def('ALLYBONUS_NEWMEMBER', 'Membrii noi capata acces treptat la nivelurile mari: nivelul 2 dupa 24 de ore in alianta, nivelul 3 dupa 48 de ore si asa mai departe.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// RAPOARTE - filtru dupa rezultatul luptei
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('TZ_RPT_ALL_RESULTS', 'Toate rezultatele');
tz_def('TZ_RPT_F_WON_NOLOSS', 'Castigat fara pierderi');
tz_def('TZ_RPT_F_WON_LOSS', 'Castigat cu pierderi');
tz_def('TZ_RPT_F_LOST', 'Pierdut');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// EROU - regenerarea totala (baza + iteme)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('TZ_HERO_REGEN_TOTAL', 'Regenerarea vietii');
tz_def('TZ_HERO_REGEN_BASE', 'de baza');
tz_def('TZ_HERO_REGEN_ITEMS', 'din iteme');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// MINUNEA LUMII A NATARILOR
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('TZ_WW_NATARS', 'Natari');
tz_def('CONF_SERV_NATARS_WW_START_DELAY', 'Pornirea Minunii Natarilor');
tz_def('CONF_SERV_NATARS_WW_START_DELAY_TOOLTIP', 'Dupa cate zile de la aparitia planurilor incep Natarii propria Minune a Lumii. Se scaleaza cu viteza serverului. 0 dezactiveaza.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// SIMULATOR - bonusuri proprii incluse automat
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('TZ_WS_APPLIED', 'Incluse automat in aceasta simulare:');
tz_def('TZ_WS_ITEM_STRENGTH', 'Forta echipamentului');
tz_def('TZ_WS_ITEM_UNIT', 'Bonus de arma');
tz_def('TZ_WS_VS_NATARS', 'Contra Natarilor');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// MESAJ DE SISTEM - previzualizare
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_PREVIEW', 'Previzualizare');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// REGULI DE INREGISTRARE (Server Configuration)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('CONF_SERV_USRNM_MIN', 'Lungimea minima a numelui');
tz_def('CONF_SERV_USRNM_MAX', 'Lungimea maxima a numelui');
tz_def('CONF_SERV_PW_MIN', 'Lungimea minima a parolei');
tz_def('CONF_SERV_USRNM_SPECIAL', 'Permite . - _ in nume');
tz_def('CONF_SERV_USRNM_SPECIAL_TOOLTIP', 'Cu True, numele pot contine punct, liniuta sau underscore, si spatii simple intre cuvinte. Cu False, se accepta doar litere si cifre.');
tz_def('CONF_SERV_REGRULES_TOOLTIP', 'Reguli verificate la inregistrare. Schimbarea lor nu afecteaza conturile existente.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// STATISTICI - sectiunea de alianta
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('PLUSSTATS_ALLIANCE', 'Alianta ta');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// EROU - capetele de coloana din pagina de iteme
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('HERO_COL_TYPE', 'Tip');
tz_def('HERO_COL_IMAGE', 'Imagine');
tz_def('HERO_COL_NAME', 'Numele itemului');
tz_def('HERO_COL_TIER', 'Nivel (bonus)');
tz_def('HERO_COL_ACTION', 'Actiune');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// MINUNEA LUMII - stil pe trib
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_WW_IMAGE', 'Minune pe trib');
tz_def('ADM_WW_IMAGE_TIP', 'Fiecare trib isi vede propria Minune a Lumii, atat pe harta satului cat si in pagina de constructie. Triburile fara imagini pe disc raman pe imaginea originala, indiferent de setare.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// MINUNEA LUMII - satul nu poate fi capitala
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('TZ_WW_NO_CAPITAL', 'Satul Minunii Lumii nu poate deveni capitala.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// BONUSURI DE ALIANTA - donatie peste necesarul ultimului nivel
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ALLYBONUS_MSG_OVERMAX', 'Acesta e ultimul nivel: poti dona cel mult %s resurse.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// JUCATORI PROTEJATI IMPOTRIVA ATACURILOR
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_PROTECTED_PLAYERS', 'Jucatori protejati');
tz_def('ADM_PROTECTED_PLAYERS_TIP', 'Nume de jucatori separate prin virgula, care nu pot fi atacati sau jefuiti de nimeni. Intaririle raman permise. Lasa gol ca sa dezactivezi.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// COMPONENTA HERO DIN BARA DE SUS
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('HERO_HEADER_AT_HOME',   'Eroul este acasa');
tz_def('HERO_HEADER_DEAD',      'Eroul este mort');
tz_def('HERO_HEADER_TRAINING',  'Eroul este in antrenament');
tz_def('HERO_HEADER_NOHERO',    'Inca nu ai erou');
tz_def('HERO_HEADER_ADVENTURE', 'Eroul este in aventura');
tz_def('HERO_HEADER_ATTACK',    'Eroul este plecat cu armata');
tz_def('HERO_HEADER_REINFORCE', 'Eroul este intr-o intarire');
tz_def('HERO_HEADER_IN',        'in');
tz_def('TZ_HEALTH',             'Sanatate');


//////////////////////////////////////////////////////////////////////////////////////////////////////
// PERMISIUNI SITTER
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('SITTER_P_ATTACK', 'trimite atacuri');
tz_def('SITTER_P_RAID',   'trimite raiduri');
tz_def('SITTER_P_REINF',  'trimite intariri');
tz_def('SITTER_P_RES',    'trimite resurse altor jucatori');
tz_def('SITTER_P_GOLD',   'cheltuie aur');
tz_def('SITTER_P_DENIED', 'Permisiunile tale de sitter nu iti permit aceasta actiune.');
tz_def('SITTER_P_HINT',        'Permisiuni pentru noul sitter:');
tz_def('SITTER_P_NOT_SITTING', 'Nu esti sitter pe niciun cont.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// REDUCERI TIMP INSTRUIRE (cazarma / grajd)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('TRAIN_BONUS_ARTIFACT', 'Bonus artefact');
tz_def('TRAIN_BONUS_HERO',     'Bonus erou');
tz_def('TRAIN_BONUS_ALLIANCE', 'Bonus alianta');
tz_def('TRAIN_BONUS_FINAL',    'Timp instruire');