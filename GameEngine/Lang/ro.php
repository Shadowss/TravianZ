<?php

//////////////////////////////////////////////////////////////////////////////////////////////////////
//                                             TRAVIANZ                                             //
//            Only for advanced users, do not edit if you dont know what are you doing!             //
//                                Made by: Dzoki & Dixie (TravianZ)                                 //
//                              - TravianZ = Travian Clone Project -                                //
//                                 DO NOT REMOVE COPYRIGHT NOTICE!                                  //
//                                Adding tasks, constructions and artefact  by: Armando             //
//                                Modified , added , fixed , implementd  by: Shadow and ronix       //
//                                                                                                  //
//          URLs:           https://travianz.org                                                    //
//                          https://github.com/Shadowss/TravianZ                                    //
//                                                                                                  //
//////////////////////////////////////////////////////////////////////////////////////////////////////
//                              //
//          ROMANA             //
//      Author: Dzoki           //
//     Adding: Armando          //
//     Translation: Ferywir     //
//////////////////////////////////

//MAIN MENU
define('TRIBE1', 'Romani');
define('TRIBE2', 'Teutoni');
define('TRIBE3', 'Gali');
define('TRIBE4', 'Natura');
define('TRIBE5', 'Natari');
define('TRIBE6', 'Monstri');

define('HOME', 'Pagina principala');
define('INSTRUCT', 'Instructiuni');
define('ADMIN_PANEL', 'Panou Admin');
define('MH_PANEL', 'Panou Multihunter');
define('MASS_MESSAGE', 'Mesaj in masa');
define('LOGOUT', 'Deconectare');
define('PROFILE', 'Profil');
define('SUPPORT', 'Suport');
define('UPDATE_T_10', 'Actualizeaza Top 10');
define('SYSTEM_MESSAGE', 'Mesaj de sistem');
define('TRAVIAN_PLUS', 'Travian <b><span class="plus_g">P</span><span class="plus_o">l</span><span class="plus_g">u</span><span class="plus_o">s</span></span></span></b>');
define('CONTACT', 'Contacteaza-ne!');
define('GAME_RULES', 'Regulile jocului');

//MENU
define('REG', 'Inregistrare');
define('FORUM', 'Forum');
define('CHAT', 'Chat');
define('IMPRINT', 'Date legale');
define('MORE_LINKS', 'Mai multe linkuri');
define('TOUR', 'Tur al jocului');


//ERRORS
define('USRNM_EMPTY', '(Nume de utilizator gol)');
define('USRNM_TAKEN', '(Numele este deja folosit.)');
define('USRNM_SHORT', '(min. '.USRNM_MIN_LENGTH.' caractere)');
define('USRNM_CHAR', '(Caractere invalide)');
define('PW_EMPTY', '(Parola goala)');
define('PW_SHORT', '(min. '.PW_MIN_LENGTH.' caractere)');
define('PW_INSECURE', '(Parola nesigura. Te rugam alege una mai sigura.)');
define('EMAIL_EMPTY', '(Email gol)');
define('EMAIL_INVALID', '(Adresa de email invalida)');
define('EMAIL_TAKEN', '(Emailul este deja folosit)');
define('WINNER_ERROR', '<li>Serverul s-a incheiat! Nu se mai pot face inregistrari.</li>');
define('TRIBE_EMPTY', '<li>Te rugam alege un trib.</li>');
define('AGREE_ERROR', '<li>Trebuie sa accepti regulile jocului si termenii si conditiile generale pentru a te inregistra.</li>');
define('LOGIN_USR_EMPTY', 'Introdu numele.');
define('LOGIN_PASS_EMPTY', 'Introdu parola.');
define('LOGIN_VACATION', 'Modul vacanta este inca activ.');
define('EMAIL_ERROR', 'Emailul nu corespunde cu cel existent');
define('PASS_MISMATCH', 'Parolele nu corespund');
define('ALLI_OWNER', 'Te rugam numeste un lider de alianta inainte de stergere');
define('SIT_ERROR', 'Inlocuitor deja setat sau jucator negasit');
define('USR_NT_FOUND', 'Numele nu exista.');
define('LOGIN_PW_ERROR', 'Parola este gresita.');
define('WEL_TOPIC', 'Sfaturi si informatii utile ');
define('ATAG_EMPTY', 'Tag gol');
define('ANAME_EMPTY', 'Nume gol');
define('ATAG_EXIST', 'Tag ocupat');
define('ANAME_EXIST', 'Nume ocupat');
define('ALREADY_ALLY_MEMBER', 'Esti deja intr-o alianta');
define('ALLY_TOO_LOW', 'Trebuie sa ai o ambasada de nivel 3 sau mai mare');
define('USER_NOT_IN_YOUR_ALLY', 'Acest utilizator nu este in alianta ta!');
define('CANT_EDIT_YOUR_PERMISSIONS', 'Nu iti poti edita propriile permisiuni!');
define('CANT_EDIT_LEADER_PERMISSIONS', 'Permisiunile liderului de alianta nu pot fi editate!');
define('CANT_REMOVE_LEADER', 'Nu poti exclude fondatorul aliantei!');
define('FOUNDER_LEAVE_NEW', 'Fondatorul nu a fost selectat!');
define('FOUNDER_LEAVE_INVALID', 'Fondator invalid!');
define('NO_PERMISSION', 'Nu ai suficiente permisiuni!');
define('NAME_OR_DIPL_EMPTY', 'Nume sau diplomatie gol');
define('ALLY_DOESNT_EXISTS', 'Alianta nu exista');
define('CANNOT_INVITE_SAME_ALLY', 'Nu iti poti invita propria alianta');
define('WRONG_DIPLOMACY', 'Alegere gresita');
define('INVITE_ALREADY_SENT', 'Fie ai trimis deja un pact acestei aliante, fie ei l-au trimis aliantei tale, fie ai deja un pact cu ei');
define('INVITE_SENT', 'Invitatie trimisa');
define('DECLARED_WAR_ON', 'a declarat razboi catre');
define('OFFERED_NON_AGGRESION_PACT_TO', 'a oferit un pact de neagresiune catre');
define('OFFERED_CONFED_TO', 'a oferit o confederatie catre');
define('ALLY_TOO_MUCH_PACTS', 'Fie nu mai poti oferi pacte de acest tip, fie aceasta alianta a atins limita pentru acest tip de pacte');
define('ALLY_PERMISSIONS_UPDATED', 'Permisiuni actualizate');
define('ALLY_FORUM_LINK_UPDATED', 'Link forum actualizat');
define('NO_FORUMS_YET', 'Inca nu exista forumuri.');
define('ALLY_USER_KICKED', ' a fost dat afara din alianta');
define('NOT_OPENED_YET', 'Serverul nu a inceput inca.');
define('REGISTER_CLOSED', 'Inregistrarea este inchisa. Nu te poti inregistra pe acest server.');
define('NAME_EMPTY', 'Te rugam introdu un nume');
define('NAME_NO_EXIST', 'Nu exista niciun utilizator cu numele ');
define('ID_NO_EXIST', 'Nu exista niciun utilizator cu id-ul ');
define('SAME_NAME', 'Nu te poti invita pe tine insuti');
define('ALREADY_INVITED', ' deja invitat');
define('ALREADY_IN_ALLY', ' este deja in aceasta alianta');
define('ALREADY_IN_AN_ALLY', ' este deja intr-o alianta');
define('NAME_OR_TAG_CHANGED', 'Nume sau Tag schimbat');
define('VAC_MODE_WRONG_DAYS', 'Ai introdus un numar gresit de zile');

//COPYRIGHT
define('TRAVIAN_COPYRIGHT', 'TravianZ 100% Open Source Travian Clone.');

//BUILD.TPL
define('CUR_PROD', 'Productie curenta');
define('NEXT_PROD', 'Productie la nivelul ');
define('CONSTRUCT_BUILD', 'Construieste cladirea');

//DORF1
define('LUMBER', 'Lemn');
define('CLAY', 'Lut');
define('IRON', 'Fier');
define('CROP', 'Cereale');
define('LEVEL', 'Nivel');
define('CROP_COM', CROP.' consum');
define('PER_HR', 'pe ora');
define('PRODUCTION', 'Productie');
define('CAPITAL1', 'Capitala');
define('VILLAGES', 'Sate');
define('ANNOUNCEMENT', 'Anunt');
define('GO2MY_VILLAGE', 'Mergi la satul meu');
define('VILLAGE_CENTER', 'Centrul satului');
define('FINISH_GOLD', 'Termina imediat toate comenzile de constructie si cercetare din acest sat pentru 2 Aur?');
define('WAITING_LOOP', '(in asteptare)');
define('CROP_NEGATIVE', 'Productia ta de cereale este negativa, nu vei atinge niciodata cantitatea de resurse necesara.');
define('HR', 'h.');
define('HRS', '(ore)');
define('DONE_AT', 'gata la');
define('CANCEL', 'anuleaza');
define('LOYALTY', 'Loialitate');
define('CALCULATED_IN', 'Calculat in');
define('HI', 'Buna');
define('P_IN', 'in');
define('MS', 'ms');
define('SERVER_TIME', 'Ora serverului:');
define('REMAINING_GOLD', 'Aur ramas');

// HEADER && MENU && Messages && Reports
define('REPORTS', 'Rapoarte');
define('MESSAGES', 'Mesaje');
define('PLUS_MENU', 'Meniu Plus');
define('LINKS', 'Linkuri');
define('CANCEL_PROCESS', 'Anuleaza procesul');
define('ACCOUNT_DELETING', 'Contul va fi sters in');
define('INBOX', 'Mesaje primite');
define('WRITE', 'Scrie');
define('SENT', 'Trimise');
define('SEND', 'Trimite');
define('ARCHIVE', 'Arhiva');
define('NOTES', 'Notite');
define('SUBJECT', 'Subiect');
define('SENDER', 'Expeditor');
define('RECIPIENT', 'Destinatar');
define('BACK', 'Inapoi');
define('NEW', 'nou');
define('UNREAD', 'necitit');
define('NO_MESS', 'Nu exista mesaje disponibile');
define('NO_MESS_IN_ARCHIVE', NO_MESS.' in arhiva');
define('NO_MESS_SENT', 'Nu exista mesaje trimise disponibile');
define('MESS_FOR_SUP', 'Mesaj pentru Suport');
define('MESS_FOR_MH', 'Mesaj pentru Multihunter');
define('SEND_AS_SUP', 'Trimite ca Suport');
define('SEND_AS_MH', 'Trimite ca Multihunter');
define('SAVE', 'Salveaza');
define('ANSWER', 'Raspunde');
define('REPLY', 'Raspuns');
define('ADDRESSBOOK', 'Agenda');
define('CLOSE_ADDRESSBOOK', 'Inchide agenda');
define('ONLINE_S1', 'Online acum');
define('ONLINE_S2', 'Offline');
define('ONLINE_S3', 'Ultimele 3 zile');
define('ONLINE_S4', 'Ultimele 7 zile');
define('ONLINE_S5', 'Inactiv');
define('WAIT_FOR_CONFIRM', 'Asteapta confirmarea');
define('CONFIRM', 'Confirma');
define('WRITE_MESS_WARN', '<b>Atentie:</b> nu poti folosi valorile <b>[message]</b> sau <b>[/message]</b> in mesajul tau deoarece pot cauza probleme cu sistemul bbcode');
define('NO_REPORTS', 'Nu exista rapoarte disponibile');
define('ATTACKER', 'Atacator');
define('NATAR_COUNTERFORCE', 'Contraforta Natar');
define('FROM_THE_VILL', 'din satul');
define('CASUALTIES', 'Pierderi');
define('INFORMATION', 'Informatii');
define('CARRY', 'transporta');
define('DEFENDER', 'Aparator');
define('VISITED', 'vizitat');
define('HIS_TROOPS', ' trupele sale');
define('WISHES_YOU', 'iti ureaza');
define('X_MAS', 'Craciun Fericit');
define('NEW_YEAR', 'La Multi Ani');
define('EASTER', 'Paste Fericit');
if(!defined('PEACE')) define('PEACE', 'Pace');

define('GOLD', 'Aur');
define('GOLD_IMG', '<img src=\"/img/x.gif\" class=\"gold\" alt=\"'.GOLD.'\" title=\"'.GOLD.'\">');
//QUEST
define('Q_CONTINUE', 'Continua cu sarcina urmatoare.');
define('Q_REWARD', 'Recompensa ta:');
define('Q_BUTN', 'sarcina indeplinita');
define('Q0', 'Bun venit la ');
define('Q0_DESC', 'Dupa cum vad, ai fost numit conducatorul acestui mic sat. Voi fi sfatuitorul tau in primele zile si nu iti voi parasi niciodata partea (dreapta).');
define('Q0_OPT1', 'Catre prima sarcina.');
define('Q0_OPT2', 'Priveste in jur pe cont propriu.');
define('Q0_OPT3', 'Nu juca sarcinile.');

define('Q1', 'Sarcina 1: Taietor de lemne');
define('Q1_DESC', 'In jurul satului tau sunt patru paduri verzi. Construieste un taietor de lemne pe una dintre ele. Lemnul este o resursa importanta pentru noua noastra asezare.');
define('Q1_ORDER', 'Ordin:</p>Construieste un taietor de lemne.');
define('Q1_RESP', 'Da, astfel obtii mai mult lemn. Te-am ajutat putin si am terminat ordinul instantaneu.');
define('Q1_REWARD', 'Taietorul de lemne terminat instantaneu.');

define('Q2', 'Sarcina 2: Cereale');
define('Q2_DESC', 'Acum supusii tai sunt flamanzi dupa ce au muncit toata ziua. Extinde o cultura de cereale pentru a imbunatati aprovizionarea supusilor tai. Revino aici dupa ce cladirea este gata.');
define('Q2_ORDER', 'Ordin:</p>Extinde o cultura de cereale.');
define('Q2_RESP', 'Foarte bine. Acum supusii tai au din nou destul de mancare...');
define('Q2_REWARD', 'Recompensa ta:</p>1 zi Travian');

define('Q3', 'Sarcina 3: Numele satului tau');
define('Q3_DESC', 'Creativ cum esti, poti da satului tau numele perfect.<br><br>Apasa pe `profil` in meniul din stanga si apoi alege `schimba profilul`...');
define('Q3_ORDER', 'Ordin:</p>Schimba numele satului tau cu ceva frumos.');
define('Q3_RESP', 'Uau, un nume grozav pentru satul lor. Ar fi putut fi numele satului meu!...');

define('Q4', 'Sarcina 4: Alti jucatori');
define('Q4_DESC', 'In '.SERVER_NAME.' joci alaturi de miliarde de alti jucatori. Apasa `statistici` in meniul de sus pentru a-ti gasi rangul si introdu-l aici.');
define('Q4_ORDER', 'Ordin:</p>Cauta-ti rangul in statistici si introdu-l aici.');
define('Q4_BUTN', 'sarcina indeplinita');
define('Q4_RESP', 'Exact! Acesta este rangul tau.');

define('Q5', 'Sarcina 5: Doua ordine de constructie');
define('Q5_DESC', 'Construieste o mina de fier si o groapa de lut. De fier si lut nu poti avea niciodata destul.');
define('Q5_ORDER', 'Ordin:</p><ul><li>Extinde o mina de fier.</li><li>Extinde o groapa de lut.</li></ul>');
define('Q5_RESP', 'Dupa cum ai observat, ordinele de constructie dureaza destul de mult. Lumea din '.SERVER_NAME.' va continua sa se invarta chiar daca esti offline. Chiar si peste cateva luni vor fi multe lucruri noi de descoperit.<br><br>Cel mai bine este sa iti verifici ocazional satul si sa dai supusilor tai sarcini noi.');

define('Q6', 'Sarcina 6: Mesaje');
define('Q6_DESC', 'Poti vorbi cu alti jucatori folosind sistemul de mesaje. Ti-am trimis un mesaj. Citeste-l si revino aici.<br><br>P.S. Nu uita: in stanga rapoartele, in dreapta mesajele.');
define('Q6_ORDER', 'Ordin:</p>Citeste mesajul tau nou.');
define('Q6_RESP', 'L-ai primit? Foarte bine.<br><br>Iata niste Aur. Cu Aur poti face mai multe lucruri, de exemplu sa iti extinzi   in meniul din stanga.');
define('Q6_RESP1', '-Contul sau sa iti cresti productia de resurse. Pentru aceasta apasa ');
define('Q6_RESP2', 'in meniul din stanga.');
define('Q6_SUBJECT', 'Mesaj de la Maistru de sarcini');
define('Q6_MESSAGE', 'Te informam ca o recompensa frumoasa te asteapta la maistrul de sarcini.<br><br>Indiciu: Mesajul a fost generat automat. Un raspuns nu este necesar.');

define('Q7', 'Sarcina 7: Cate unul din fiecare!');
define('Q7_DESC', 'Acum ar trebui sa iti cresti putin productia de resurse. Construieste inca un taietor de lemne, o groapa de lut, o mina de fier si o cultura de cereale la nivelul 1.');
define('Q7_ORDER', 'Ordin:</p>Extinde inca o casuta din fiecare resursa la nivelul 1.');
define('Q7_RESP', 'Foarte bine, dezvoltare buna a productiei de resurse.');

define('Q8', 'Sarcina 8: Armata uriasa!');
define('Q8_DESC', 'Acum am o sarcina foarte speciala pentru tine. Mi-e foame. Da-mi 200 de cereale!<br><br>In schimb voi incerca sa organizez o armata uriasa pentru a-ti proteja satul.');
define('Q8_ORDER', 'Ordin:</p>Trimite 200 de cereale maistrului de sarcini.');
define('Q8_BUTN', 'Trimite cereale');
define('Q8_NOCROP', 'Nu sunt destule cereale!');

define('Q9', 'Sarcina 9: Totul la 1.');
define('Q9_DESC', 'In Travian este intotdeauna ceva de facut! In timp ce astepti sosirea armatei uriase, acum ar trebui sa iti cresti putin productia de resurse. Extinde toate casutele de resurse la nivelul 1.');
define('Q9_ORDER', 'Ordin:</p>Extinde toate casutele de resurse la nivelul 1.');
define('Q9_RESP', 'Foarte bine, productia ta de resurse infloreste.<br><br>In curand putem incepe constructia de cladiri in sat.');

define('Q10', 'Sarcina 10: Porumbelul pacii');
define('Q10_DESC', 'In primele zile dupa inscriere esti protejat impotriva atacurilor celorlalti jucatori. Poti vedea cat dureaza aceasta protectie adaugand codul <b>[#0]</b> in profilul tau.');
define('Q10_ORDER', 'Ordin:</p>Scrie codul <b>[#0]</b> in profilul tau adaugandu-l intr-unul dintre cele doua campuri de descriere.');
define('Q10_RESP', 'Bravo! Acum toata lumea poate vedea ce mare razboinic se apropie de lume.');
define('Q10_REWARD', 'Recompensa ta:</p>2 zile Travian');

define('Q11', 'Sarcina 11: Vecini!');
define('Q11_DESC', 'In jurul tau sunt multe sate diferite. Unul dintre ele se numeste. ');
define('Q11_DESC1', ' Apasa pe `harta` in meniul de sus si cauta acel sat. Numele satelor vecinilor tai pot fi vazute trecand mouse-ul peste oricare dintre ele.');
define('Q11_ORDER', 'Ordin:</p>Cauta coordonatele lui ');
define('Q11_ORDER1', 'si introdu-le aici.');
define('Q11_RESP', 'Exact, acolo ');
define('Q11_RESP1', ' sat! Cat de multe resurse poti atinge in acest sat. Ei bine, aproape la fel de multe...');
define('Q11_BUTN', 'sarcina indeplinita');

define('Q12', 'Sarcina 12: Ascunzatoare');
define('Q12_DESC', 'Este timpul sa ridici o ascunzatoare. Lumea din '.SERVER_NAME.' este periculoasa.<br><br>Multi jucatori traiesc furand resursele altora. Construieste o ascunzatoare pentru a ascunde o parte din resursele tale de dusmani.');
define('Q12_ORDER', 'Ordin:</p>Construieste o ascunzatoare.');
define('Q12_RESP', 'Bravo, acum este mult mai greu pentru ceilalti jucatori sa iti jefuiasca satul.<br><br>In caz de atac, satenii tai vor ascunde singuri resursele in ascunzatoare.');

define('Q13', 'Sarcina 13: Catre doi.');
define('Q13_DESC', 'In '.SERVER_NAME.' este intotdeauna ceva de facut! Extinde un taietor de lemne, o groapa de lut, o mina de fier si o cultura de cereale la nivelul 2 fiecare.');
define('Q13_ORDER', 'Ordin:</p>Extinde cate o casuta din fiecare resursa la nivelul 2.');
define('Q13_RESP', 'Foarte bine, satul tau creste si infloreste!');

define('Q14', 'Sarcina 14: Instructiuni');
define('Q14_DESC', 'In instructiunile din joc poti gasi texte informative scurte despre diferite cladiri si tipuri de unitati.<br><br>Apasa pe `instructiuni` in stanga pentru a afla cat lemn este necesar pentru cazarma.');
define('Q14_ORDER', 'Ordin:</p>Introdu cat lemn costa cazarma');
define('Q14_BUTN', 'sarcina indeplinita');
define('Q14_RESP', 'Exact! Cazarma costa 210 lemn.');

define('Q15', 'Sarcina 15: Cladirea principala');
define('Q15_DESC', 'Maistrii tai au nevoie de o cladire principala de nivel 3 pentru a ridica cladiri importante precum piata sau cazarma.');
define('Q15_ORDER', 'Ordin:</p>Extinde cladirea principala la nivelul 3.');
define('Q15_RESP', 'Bravo. Cladirea principala de nivel 3 a fost terminata.<br><br>Cu aceasta imbunatatire, maistrii tai pot construi nu doar mai multe tipuri de cladiri, ci o pot face si mai repede.');

define('Q16', 'Sarcina 16: Avansat!');
define('Q16_DESC', 'Cauta-ti din nou rangul in statisticile jucatorilor si bucura-te de progresul tau.');
define('Q16_ORDER', 'Ordin:</p>Cauta-ti rangul in statistici si introdu-l aici.');
define('Q16_RESP', 'Bravo! Acesta este rangul tau actual.');

define('Q17', 'Sarcina 17: Arme sau aluat');
define('Q17_DESC', 'Acum trebuie sa iei o decizie: fie sa faci comert pasnic, fie sa devii un razboinic temut.<br><br>Pentru piata ai nevoie de un hambar, pentru cazarma ai nevoie de un punct de adunare.');
define('Q17_BUTN', 'Economie');
define('Q17_BUTN1', 'Militar');

define('Q18', 'Sarcina 18: Militar');
define('Q18_DESC', 'O decizie curajoasa. Pentru a putea trimite trupe ai nevoie de un punct de adunare.<br><br>Punctul de adunare trebuie construit pe un loc de constructie specific. Locul ');
define('Q18_DESC1', ' de constructie.');
define('Q18_DESC2', ' este situat in partea dreapta a cladirii principale, putin sub ea. Locul de constructie are forma curbata.');
define('Q18_ORDER', 'Ordin:</p>Construieste un punct de adunare.');
define('Q18_RESP', 'Punctul tau de adunare a fost ridicat! O miscare buna spre dominatia lumii!');

define('Q19', 'Sarcina 19: Cazarma');
define('Q19_DESC', 'Acum ai o cladire principala de nivel 3 si un punct de adunare. Asta inseamna ca toate conditiile pentru construirea cazarmii au fost indeplinite.<br><br>Poti folosi cazarma pentru a antrena trupe pentru lupta.');
define('Q19_ORDER', 'Ordin:</p>Construieste cazarma.');
define('Q19_RESP', 'Bravo... Cei mai buni instructori din toata tara s-au adunat pentru a antrena abilitatile de lupta ale oamenilor tai la nivel maxim.');

define('Q20', 'Sarcina 20: Antreneaza.');
define('Q20_DESC', 'Acum ca ai cazarma poti incepe sa antrenezi trupe. Antreneaza doi ');
define('Q20_ORDER', 'Te rugam antreneaza 2 ');
define('Q20_RESP', 'Fundatia gloriei armatei tale a fost pusa.<br><br>Inainte de a-ti trimite armata la jaf ar trebui sa verifici cu.');
define('Q20_RESP1', 'Simulatorul de lupta');
define('Q20_RESP2', 'pentru a vedea cate trupe iti trebuie ca sa invingi un sobolan fara pierderi.');

define('Q21', 'Sarcina 18: Economie');
define('Q21_DESC', 'Comert si economie a fost alegerea ta. Vremuri de aur te asteapta cu siguranta!');
define('Q21_ORDER', 'Ordin:</p>Construieste un hambar.');
define('Q21_RESP', 'Bravo! Cu hambarul poti stoca mai mult grau.');

define('Q22', 'Sarcina 19: Depozit');
define('Q22_DESC', 'Nu doar cerealele trebuie pastrate. Si celelalte resurse se pot pierde daca nu sunt stocate corect. Construieste un depozit!');
define('Q22_ORDER', 'Ordin:</p>Construieste depozit.');
define('Q22_RESP', ';Bravo, depozitul tau este gata...&rdquo;</i><br>Acum ai indeplinit toate conditiile necesare pentru a construi o piata.');

define('Q23', 'Sarcina 20: Piata.');
define('Q23_DESC', ';Construieste o piata ca sa poti face comert cu ceilalti jucatori.');
define('Q23_ORDER', 'Ordin:</p>Te rugam construieste o piata.');
define('Q23_RESP', ';Piata a fost terminata. Acum poti face propriile oferte si accepta ofertele altora! Cand iti creezi propriile oferte, gandeste-te sa oferi ceea ce au cei mai multi jucatori nevoie pentru a obtine mai mult profit.');

define('Q24', 'Sarcina 21: Totul la 2.');
define('Q24_DESC', 'Acum ar trebui sa iti cresti putin productia de resurse. Construieste inca un taietor de lemne, o groapa de lut, o mina de fier si o cultura de cereale la nivelul 1.');
define('Q24_ORDER', 'Ordin:</p>Extinde toate casutele de resurse la nivelul 2.');
define('Q24_RESP', 'Felicitari! Satul tau creste si infloreste...');

define('Q28', 'Sarcina 22: Alianta.');
define('Q28_DESC', 'Munca in echipa este importanta in Travian. Jucatorii care lucreaza impreuna se organizeaza in aliante. Primeste o invitatie de la o alianta din regiunea ta si alatura-te ei. Alternativ, iti poti fonda propria alianta. Pentru asta ai nevoie de o ambasada de nivel 3.');
define('Q28_ORDER', 'Ordin:</p>Alatura-te unei aliante sau fondeaza una pe cont propriu.');
define('Q28_RESP', 'Bine! Acum esti intr-o uniune numita');
define('Q28_RESP1', ', si esti membru al aliantei lor, cu cat mai repede vei progresa...');

define('Q29', 'Sarcina 23: Cladirea principala la nivelul 5');
define('Q29_DESC', 'Pentru a putea construi un palat sau o resedinta, vei avea nevoie de o cladire principala de nivel 5.');
define('Q29_ORDER', 'Ordin:</p>Imbunatateste cladirea principala la nivelul 5.');
define('Q29_RESP', 'Cladirea principala este acum nivel 5 si poti construi palat sau resedinta...');

define('Q30', 'Sarcina 24: Hambar la nivelul 3.');
define('Q30_DESC', 'Ca sa nu pierzi cereale, ar trebui sa iti imbunatatesti hambarul.');
define('Q30_ORDER', 'Ordin:</p>Imbunatateste hambarul la nivelul 3.');
define('Q30_RESP', 'Hambarul este acum nivel 3...');

define('Q31', 'Sarcina 25: Depozit la nivelul 7');
define('Q31_DESC', ' Ca sa te asiguri ca resursele nu se revarsa, ar trebui sa iti imbunatatesti depozitul.');
define('Q31_ORDER', 'Ordin:</p>Imbunatateste depozitul la nivelul 7.');
define('Q31_RESP', 'Depozitul a fost imbunatatit la nivelul 7...');

define('Q32', 'Sarcina 26: Totul la cinci!');
define('Q32_DESC', 'Vei avea mereu nevoie de mai multe resurse. Casutele de resurse sunt destul de scumpe, dar se vor rentabiliza intotdeauna pe termen lung.');
define('Q32_ORDER', 'Ordin:</p>Imbunatateste toate casutele de resurse la nivelul 5.');
define('Q32_RESP', 'Toate resursele sunt la nivelul 5, foarte bine, satul tau creste si infloreste!');

define('Q33', 'Sarcina 27: Palat sau resedinta?');
define('Q33_DESC', 'Pentru a fonda un sat nou, vei avea nevoie de colonisti. Pe acestia ii poti antrena fie intr-un palat, fie intr-o resedinta.');
define('Q33_ORDER', 'Ordin:</p>Construieste un palat sau o resedinta la nivelul 10.');
define('Q33_RESP', 'a ajuns la nivelul 10, acum poti antrena colonisti si fonda al doilea sat. Atentie la punctele de cultura...');

define('Q34', 'Sarcina 28: 3 colonisti.');
define('Q34_DESC', 'Pentru a fonda un sat nou, vei avea nevoie de colonisti. Acestia pot fi antrenati fie intr-un palat, fie intr-o resedinta.');
define('Q34_ORDER', 'Ordin:</p>Antreneaza 3 colonisti.');
define('Q34_RESP', '3 colonisti au fost antrenati. Pentru a fonda un sat nou ai nevoie de cel putin');
define('Q34_RESP1', 'puncte de cultura...');

define('Q35', 'Sarcina 29: Sat nou.');
define('Q35_DESC', 'Sunt multe casute goale pe harta. Gaseste una care iti convine si fondeaza un sat nou');
define('Q35_ORDER', 'Ordin:</p>Fondeaza un sat nou.');
define('Q35_RESP', 'Sunt mandru de tine! Acum ai doua sate si toate posibilitatile de a construi un imperiu puternic. Iti urez noroc cu asta.');

define('Q36', ' Sarcina 30: Construieste un ');
define('Q36_DESC', 'Acum ca ai antrenat cativa soldati, ar trebui sa construiesti si un ');
define('Q36_DESC1', '. Creste apararea de baza, iar soldatii tai vor primi un bonus defensiv.');
define('Q36_ORDER', 'Ordin:</p>Construieste un ');
define('Q36_RESP', 'Despre asta vorbesc. Un ');
define('Q36_RESP1', ' Foarte util. Creste apararea trupelor din sat.');

define('Q37', 'Sarcini');
define('Q37_DESC', 'Toate sarcinile indeplinite!');

define('RESOURCES_OVERVIEW', 'Prezentare resurse');
define('YOUR_RES_DELIVERIES', 'Livrarile tale de resurse');
define('DELIVERY', 'Livrare');
define('DELIVERY_TIME', 'Timp de livrare');
define('STATUS', 'Stare');
define('FETCH', 'preia');
define('FETCHED', 'preluat');
define('ON_HOLD', 'in asteptare');
define('ONE_DAY_OF_TRAVIAN', '1 zi Travian ');
define('TWO_DAYS_OF_TRAVIAN', '2 zile Travian ');

//Quest 25
define('Q25_7', 'Sarcina 7: Vecini!');
define('Q25_7_DESC', 'In jurul tau sunt multe sate diferite. Unul dintre ele se numeste. ');
define('Q25_7_DESC1', 'Apasa `Harta` in meniul de sus si cauta acel sat. Numele satelor vecinilor tai pot fi vazute trecand mouse-ul peste oricare dintre ele.');
define('Q25_7_ORDER', '</p><b>Ordin:</b><br>Cauta coordonatele lui ');
define('Q25_7_ORDER1', 'si introdu-le aici.');
define('Q25_7_RESP', 'Exact, acolo ');
define('Q25_7_RESP1', ' sat! Cat de multe resurse poti atinge in acest sat. Ei bine, aproape la fel de multe...');

define('Q25_8', 'Sarcina 8: Armata uriasa!');
define('Q25_8_DESC', 'Acum am o sarcina foarte speciala pentru tine. Mi-e foame. Da-mi 200 de cereale!<br><br>In schimb voi incerca sa organizez o armata uriasa pentru a-ti proteja satul.');
define('Q25_8_ORDER', 'Ordin:</p>Trimite 200 de cereale maistrului de sarcini.');
define('Q25_8_BUTN', 'Trimite cereale');
define('Q25_8_NOCROP', 'Nu sunt destule cereale!');

define('Q25_9', 'Sarcina 9: Cate unul din fiecare!');
define('Q25_9_DESC', 'In '.SERVER_NAME.' este intotdeauna ceva de facut! In timp ce astepti noua ta armata,<br><br>extinde inca un taietor de lemne, o groapa de lut, o mina de fier si o cultura de cereale la nivelul 1');
define('Q25_9_ORDER', 'Ordin:</p>Extinde inca o casuta din fiecare resursa la nivelul 1.');
define('Q25_9_RESP', 'Foarte bine, dezvoltare buna a productiei de resurse.');

define('Q25_10', 'Sarcina 10: In curand!');
define('Q25_10_DESC', 'Acum este timp pentru o mica pauza pana cand soseste armata uriasa pe care ti-am trimis-o.<br><br>Pana atunci poti explora harta sau extinde cateva casute de resurse.');
define('Q25_10_ORDER', 'Ordin:</p>Asteapta sosirea armatei maistrului de sarcini');
define('Q25_10_RESP', 'Acum o armata uriasa de la maistrul de sarcini a sosit pentru a-ti proteja satul');
define('Q25_10_REWARD', 'Recompensa ta:</p>2 zile in plus de Travian');

define('Q25_11', 'Sarcina 11: Rapoarte');
define('Q25_11_DESC', 'De fiecare data cand se intampla ceva important cu contul tau vei primi un raport.<br><br>Le poti vedea apasand pe jumatatea din stanga a celui de-al 5-lea buton (de la stanga la dreapta). Citeste raportul si revino aici.');
define('Q25_11_ORDER', 'Ordin:</p>Citeste ultimul tau raport.');
define('Q25_11_RESP', 'L-ai primit? Foarte bine. Iata recompensa ta.');

define('Q25_12', 'Sarcina 12: Totul la 1.');
define('Q25_12_DESC', 'Acum ar trebui sa iti cresti putin productia de resurse.');
define('Q25_12_ORDER', 'Ordin:</p>Extinde toate casutele de resurse la nivelul 1.');
define('Q25_12_RESP', 'Foarte bine, productia ta de resurse infloreste.<br><br>In curand putem incepe constructia de cladiri in sat.');

define('Q25_13', 'Sarcina 13: Porumbelul pacii');
define('Q25_13_DESC', 'In primele zile dupa inscriere esti protejat impotriva atacurilor celorlalti jucatori. Poti vedea cat dureaza aceasta protectie adaugand codul <b>[#0]</b> in profilul tau.');
define('Q25_13_ORDER', 'Ordin:</p>Scrie codul <b>[#0]</b> in profilul tau adaugandu-l intr-unul dintre cele doua campuri de descriere.');
define('Q25_13_RESP', 'Bravo! Acum toata lumea poate vedea ce mare razboinic se apropie de lume.');

define('Q25_14', 'Sarcina 14: Ascunzatoare');
define('Q25_14_DESC', 'Este timpul sa ridici o ascunzatoare. Lumea din <b>'.SERVER_NAME.'</b> este periculoasa.<br><br>Multi jucatori traiesc furand resursele altora. Construieste o ascunzatoare pentru a ascunde o parte din resursele tale de dusmani.');
define('Q25_14_ORDER', 'Ordin:</p>Construieste o ascunzatoare.');
define('Q25_14_RESP', 'Bravo, acum este mult mai greu pentru ceilalti jucatori sa iti jefuiasca satul.<br><br>In caz de atac, satenii tai vor ascunde singuri resursele in ascunzatoare.');

define('Q25_15', 'Sarcina 15: Catre doi.');
define('Q25_15_DESC', 'In <b>'.SERVER_NAME.'</b> este intotdeauna ceva de facut! Extinde un taietor de lemne, o groapa de lut, o mina de fier si o cultura de cereale la nivelul 2 fiecare.');
define('Q25_15_ORDER', 'Ordin:</p>Extinde cate o casuta din fiecare resursa la nivelul 2.');
define('Q25_15_RESP', 'Foarte bine, satul tau creste si infloreste!');

define('Q25_16', 'Sarcina 16: Instructiuni');
define('Q25_16_DESC', 'In instructiunile din joc poti gasi texte informative scurte despre diferite cladiri si tipuri de unitati.<br><br>Apasa pe `instructiuni` in stanga pentru a afla cat lemn este necesar pentru cazarma.');
define('Q25_16_ORDER', 'Ordin:</p>Introdu cat lemn costa cazarma');
define('Q25_16_BUTN', 'sarcina indeplinita');
define('Q25_16_RESP', 'Exact! Cazarma costa 210 lemn.');

define('Q25_17', 'Sarcina 17: Cladirea principala');
define('Q25_17_DESC', 'Maistrii tai au nevoie de o cladire principala de nivel 3 pentru a ridica cladiri importante precum piata sau cazarma.');
define('Q25_17_ORDER', 'Ordin:</p>Extinde cladirea principala la nivelul 3.');
define('Q25_17_RESP', 'Bravo. Cladirea principala de nivel 3 a fost terminata.<br><br>Cu aceasta imbunatatire, maistrii tai pot construi mai multe tipuri de cladiri si o pot face si mai repede.');

define('Q25_18', 'Sarcina 18: Avansat!');
define('Q25_18_DESC', 'Cauta-ti din nou rangul in statisticile jucatorilor si bucura-te de progresul tau.');
define('Q25_18_ORDER', 'Ordin:</p>Cauta-ti rangul in statistici si introdu-l aici.');
define('Q25_18_RESP', 'Bravo! Acesta este rangul tau actual.');

define('Q25_19', 'Sarcina 19: Arme sau aluat');
define('Q25_19_DESC', 'Acum trebuie sa iei o decizie: fie sa faci comert pasnic, fie sa devii un razboinic temut.<br><br>Pentru piata ai nevoie de un hambar, pentru cazarma ai nevoie de un punct de adunare.');
define('Q25_19_BUTN', 'Economie');
define('Q25_19_BUTN1', 'Militar');

define('Q25_20', 'Sarcina 19: Economie');
define('Q25_20_DESC', 'Comert si economie a fost alegerea ta. Vremuri de aur te asteapta cu siguranta!');
define('Q25_20_ORDER', 'Ordin:</p>Construieste un hambar.');
define('Q25_20_RESP', 'Bravo! Cu hambarul poti stoca mai mult grau.');

define('Q25_21', 'Sarcina 20: Depozit');
define('Q25_21_DESC', 'Nu doar cerealele trebuie pastrate. Si celelalte resurse se pot pierde daca nu sunt stocate corect. Construieste un depozit!');
define('Q25_21_ORDER', 'Ordin:</p>Construieste depozit.');
define('Q25_21_RESP', ';Bravo, depozitul tau este gata...&rdquo;</i><br>Acum ai indeplinit toate conditiile necesare pentru a construi o piata.');

define('Q25_22', 'Sarcina 21: Piata.');
define('Q25_22_DESC', ';Construieste o piata ca sa poti face comert cu ceilalti jucatori.');
define('Q25_22_ORDER', 'Ordin:</p>Te rugam construieste o piata.');
define('Q25_22_RESP', 'Piata a fost terminata. Acum poti face propriile oferte si accepta ofertele altora! Cand iti creezi propriile oferte, gandeste-te sa oferi ceea ce au cei mai multi jucatori nevoie pentru a obtine mai mult profit.');

define('Q25_23', 'Sarcina 19: Militar');
define('Q25_23_DESC', 'O decizie curajoasa. Pentru a putea trimite trupe ai nevoie de un punct de adunare.<br><br>Punctul de adunare trebuie construit pe un loc de constructie specific. Locul ');
define('Q25_23_DESC1', ' de constructie.');
define('Q25_23_DESC2', ' este situat in partea dreapta a cladirii principale, putin sub ea. Locul de constructie are forma curbata.');
define('Q25_23_ORDER', 'Ordin:</p>Construieste un punct de adunare.');
define('Q25_23_RESP', 'Punctul tau de adunare a fost ridicat! O miscare buna spre dominatia lumii!');

define('Q25_24', 'Sarcina 20: Cazarma');
define('Q25_24_DESC', 'Acum ai o cladire principala de nivel 3 si un punct de adunare. Asta inseamna ca toate conditiile pentru construirea cazarmii au fost indeplinite.<br><br>Poti folosi cazarma pentru a antrena trupe pentru lupta.');
define('Q25_24_ORDER', 'Ordin:</p>Construieste cazarma.');
define('Q25_24_RESP', 'Bravo... Cei mai buni instructori din toata tara s-au adunat pentru a antrena abilitatile de lupta ale oamenilor tai la nivel maxim.');

define('Q25_25', 'Sarcina 21: Antreneaza.');
define('Q25_25_DESC', 'Acum ca ai cazarma poti incepe sa antrenezi trupe. Antreneaza doi ');
define('Q25_25_ORDER', 'Te rugam antreneaza 2 ');
define('Q25_25_RESP', 'Fundatia gloriei armatei tale a fost pusa.<br><br>Inainte de a-ti trimite armata la jaf ar trebui sa verifici cu');
define('Q25_25_RESP1', 'Simulatorul de lupta');
define('Q25_25_RESP2', 'pentru a vedea cate trupe iti trebuie ca sa invingi un sobolan fara pierderi.');

define('Q25_26', 'Sarcina 22: Totul la 2.');
define('Q25_26_DESC', 'Acum este din nou timpul sa extinzi pietrele de temelie ale puterii si bogatiei! De data asta nivelul 1 nu este de ajuns... va dura ceva timp, dar in final va merita. Extinde toate casutele de resurse la nivelul 2!');
define('Q25_26_ORDER', 'Ordin:</p>Extinde toate casutele de resurse la nivelul 2.');
define('Q25_26_RESP', 'Felicitari! Satul tau creste si infloreste...');

define('Q25_27', 'Sarcina 23: Prieteni.');
define('Q25_27_DESC', 'Ca jucator singur este greu sa concurezi cu atacatorii. Este in avantajul tau daca vecinii te plac.<br><br>Este si mai bine daca joci impreuna cu prieteni. Stiai ca poti castiga '.GOLD_IMG.' invitand prieteni?');
define('Q25_27_ORDER', 'Ordin:</p>Cat '.GOLD_IMG.' castigi pentru invitarea unui prieten?');
define('Q25_27_RESP', 'Corect! Primesti 50 '.GOLD_IMG.' daca prietenul invitat are 2 sate.');

define('Q25_28', 'Sarcina 24: Construieste ambasada.');
define('Q25_28_DESC', 'Lumea Travian este periculoasa. Ai construit deja o ascunzatoare ca sa te protejezi de atacatori.<br><br>O alianta buna iti va da o protectie si mai buna.');
define('Q25_28_ORDER', 'Ordin:</p>Pentru a accepta invitatii de la aliante, construieste o ambasada.');
define('Q25_28_RESP', 'Da! Poti astepta o invitatie de la o alianta sau iti poti crea propria alianta daca ambasada are nivel 3');

define('Q25_29', 'Sarcina 25: Alianta.');
define('Q25_29_DESC', 'Munca in echipa este importanta in Travian. Jucatorii care lucreaza impreuna se organizeaza in aliante. Primeste o invitatie de la o alianta din regiunea ta si alatura-te ei. Alternativ, iti poti fonda propria alianta. Pentru asta ai nevoie de o ambasada de nivel 3.');
define('Q25_29_ORDER', 'Ordin:</p>Alatura-te unei aliante sau fondeaza propria alianta.');
define('Q25_29_RESP', 'Bravo! Acum esti intr-o uniune numita');
define('Q25_29_RESP1', ', si esti membru al aliantei lor.<br>Lucrand impreuna veti progresa cu totii mai repede...');

define('Q25_30', 'Sarcini');
define('Q25_30_DESC', 'Toate sarcinile indeplinite!');
//======================================================//
//================ UNITS - DO NOT EDIT! ================//
//======================================================//
define('U0', 'Erou');

//ROMAN UNITS
define('U1', 'Legionar');
define('U2', 'Pretorian');
define('U3', 'Imperian');
define('U4', 'Equites Legati');
define('U5', 'Equites Imperatoris');
define('U6', 'Equites Caesaris');
define('U7', 'Berbec de asediu');
define('U8', 'Catapulta de foc');
define('U9', 'Senator');
define('U10', 'Colonist');

//TEUTON UNITS
define('U11', 'Razboinic cu maciuca');
define('U12', 'Sulitas');
define('U13', 'Razboinic cu topor');
define('U14', 'Cercetas');
define('U15', 'Paladin');
define('U16', 'Cavaler teuton');
define('U17', 'Berbec');
define('U18', 'Catapulta');
define('U19', 'Capetenie');
define('U20', 'Colonist');

//GAUL UNITS
define('U21', 'Falanga');
define('U22', 'Spadasin');
define('U23', 'Cercetas');
define('U24', 'Tunetul lui Theutates');
define('U25', 'Druid calaret');
define('U26', 'Haeduan');
define('U27', 'Berbec');
define('U28', 'Trebuchet');
define('U29', 'Capetenie de trib');
define('U30', 'Colonist');
define('U99', 'Capcana');

//NATURE UNITS
define('U31', 'Sobolan');
define('U32', 'Paianjen');
define('U33', 'Sarpe');
define('U34', 'Liliac');
define('U35', 'Mistret');
define('U36', 'Lup');
define('U37', 'Urs');
define('U38', 'Crocodil');
define('U39', 'Tigru');
define('U40', 'Elefant');

//NATARS UNITS
define('U41', 'Lancier');
define('U42', 'Razboinic cu spini');
define('U43', 'Gardian');
define('U44', 'Pasari de prada');
define('U45', 'Calaret cu topor');
define('U46', 'Cavaler Natarian');
define('U47', 'Elefant de razboi');
define('U48', 'Balista');
define('U49', 'Imparat Natarian');
define('U50', 'Colonist Natarian');

//MONSTER UNITS
define('U51', 'Slujitor Monstru');
define('U52', 'Vanator Monstru');
define('U53', 'Razboinic Monstru');
define('U54', 'Fantoma');
define('U55', 'Cal Monstru');
define('U56', 'Cal de razboi Monstru');
define('U57', 'Berbec Monstru');
define('U58', 'Catapulta Monstru');
define('U59', 'Capetenie Monstru');
define('U60', 'Colonist Monstru');

//INDEX.php
define('LOGIN', 'Autentificare');
define('PLAYERS', 'Jucatori');
define('MODERATOR', 'Moderator');
define('ACTIVE', 'Activ');
define('ONLINE', 'Online');
define('TUTORIAL', 'Tutorial');
if(!defined('FAQ')) define('FAQ', 'Faq');
if(!defined('SPIELREGELN')) define('SPIELREGELN', 'Regulile jocului');
define('PLAYER_STATISTICS', 'Statistici jucatori');
define('TOTAL_PLAYERS', PLAYERS.' in total');
define('ACTIVE_PLAYERS', 'Jucatori activi');
define('ONLINE_PLAYERS', PLAYERS.' online');
define('MP_STRATEGY_GAME', SERVER_NAME.' - jocul de strategie multiplayer');
define('WHAT_IS', SERVER_NAME.' este unul dintre cele mai populare jocuri de browser din lume. Ca jucator in '.SERVER_NAME.', iti vei construi propriul imperiu, vei recruta o armata puternica si vei lupta alaturi de aliatii tai pentru suprematia lumii de joc.');
define('REGISTER_FOR_FREE', 'Inregistreaza-te aici gratuit!');
define('LATEST_GAME_WORLD', 'Cea mai noua lume de joc');
define('LATEST_GAME_WORLD2', 'Inregistreaza-te pe cea mai noua<br>lume de joc si bucura-te de<br>avantajele de a fi unul dintre<br>primii jucatori.');
define('PLAY_NOW', 'Joaca '.SERVER_NAME.' acum');
define('LEARN_MORE', 'Afla mai multe <br>despre '.SERVER_NAME.'!');
define('LEARN_MORE2', 'Acum cu un sistem de server<br>revolutionat, grafica complet noua <br>Acest clone este pe val!');
define('COMUNITY', 'Comunitate');
define('BECOME_COMUNITY', 'Devino parte din comunitatea noastra acum!');
define('BECOME_COMUNITY2', 'Devino parte din una dintre<br>cele mai mari comunitati de<br>jocuri din lume.');
define('NEWS', 'Noutati');
define('SCREENSHOTS', 'Capturi de ecran');
if(!defined('FAQ')) define('FAQ', 'FAQ');
if(!defined('SPIELREGELN')) define('SPIELREGELN', 'Reguli');
define('AGB', 'Termeni si conditii');
define('LEARN1', 'Imbunatateste-ti campurile si minele pentru a creste productia de resurse. Vei avea nevoie de resurse pentru a construi cladiri si a antrena soldati.');
define('LEARN2', 'Construieste si extinde cladirile din satul tau. Cladirile iti imbunatatesc infrastructura generala, cresc productia de resurse si iti permit sa cercetezi, sa antrenezi si sa imbunatatesti trupele.');
define('LEARN3', 'Priveste si interactioneaza cu imprejurimile tale. Poti face prieteni noi sau dusmani noi, poti folosi oazele din apropiere si poti observa cum imperiul tau creste si devine mai puternic.');
define('LEARN4', 'Urmareste-ti progresul si succesul si compara-te cu alti jucatori. Priveste clasamentul Top 10 si lupta pentru a castiga o medalie saptamanala.');
define('LEARN5', 'Primeste rapoarte detaliate despre aventurile, schimburile si bataliile tale. Nu uita sa verifici noile rapoarte despre evenimentele care au loc in imprejurimile tale.');
define('LEARN6', 'Schimba informatii si fa diplomatie cu alti jucatori. Aminteste-ti mereu ca comunicarea este cheia pentru a castiga prieteni noi si a rezolva conflicte vechi.');
define('LOGIN_TO', 'Autentifica-te in '.SERVER_NAME);
define('REGIN_TO', 'Inregistreaza-te in '.SERVER_NAME);
define('P_ONLINE', 'Jucatori online: ');
define('P_TOTAL', 'Jucatori in total: ');
define('CHOOSE', 'Te rugam alege un server.');
define('STARTED', ' Serverul a inceput acum '. round((time() - COMMENCE) / 86400) .' zile.');

//ANMELDEN.php
define('NICKNAME', 'Pseudonim');
define('EMAIL', 'Email');
define('PASSWORD', 'Parola');
define('NW', 'Nord-Vest');
define('NE', 'Nord-Est');
define('SW', 'Sud-Vest');
define('SE', 'Sud-Est');
define('RANDOM', 'aleator');
define('ACCEPT_RULES', ' Accept regulile jocului si termenii si conditiile generale.');
define('ONE_PER_SERVER', 'Fiecare jucator poate detine doar UN cont pe server.');
define('BEFORE_REGISTER', 'Inainte de a iti inregistra un cont ar trebui sa citesti <a href="/anleitung.php" target="_blank">instructiunile</a> Travian ro1 pentru a vedea avantajele si dezavantajele specifice ale celor trei triburi.');
define('BUILDING_UPGRADING', 'Cladire:');
define('HOURS', 'ore');


//ATTACKS ETC.
define('TROOP_MOVEMENTS', 'Miscari de trupe:');
define('ARRIVING_REINF_TROOPS', 'Trupe de intarire care sosesc');
define('ARRIVING_ATTACKING_TROOPS', 'Trupe atacatoare care sosesc');
define('ARRIVING_REINF_TROOPS_SHORT', 'Intariri');
define('OWN_ATTACKING_TROOPS', 'Propriile trupe atacatoare');
define('ATTACK', 'Atac');
define('OWN_REINFORCING_TROOPS', 'Propriile trupe de intarire');
define('NEWVILLAGE', 'Sat nou.');
define('FOUNDNEWVILLAGE', 'Fondare sat nou');
define('UNDERATTACK', 'Satul este sub atac');
define('OASISATTACK', 'Oaza este sub atac');
define('OASISATTACKS', 'Atac oaza');
define('RETURNFROM', 'Intoarcere de la');
define('REINFORCEMENTFOR', 'Intarire pentru');
define('ATTACK_ON', 'Atac catre');
define('RAID_ON', 'Raid catre');
define('SCOUTING', 'Cercetare');
define('PRISONERS', 'Prizonieri');
define('PRISONERSIN', 'Prizonieri in');
define('PRISONERSFROM', 'Prizonieri de la');
define('TROOPS', 'Trupe');
define('BOUNTY', 'Prada');
define('ARRIVAL', 'Sosire');
define('CATAPULT_TARGET', 'Tinta catapultelor');
define('INCOMING_TROOPS', 'Trupe care vin');
define('TROOPS_ON_THEIR_WAY', 'Trupe pe drum');
define('OWN_TROOPS', 'Propriile trupe');
define('ON', 'la');
define('AT', 'la');
define('UPKEEP', 'Intretinere');
define('SEND_BACK', 'Trimite inapoi');
define('TROOPS_IN_THE_VILLAGE', 'Trupe in sat');
define('TROOPS_IN_OTHER_VILLAGE', 'Trupe in alt sat');
define('TROOPS_IN_OASIS', 'Trupe in oaza');
define('KILL', 'Ucide');
define('FROM', 'De la');
define('SEND_TROOPS', 'Trimite trupe');
define('TASKMASTER', 'Maistru de sarcini');
define('TO_THE_TASK', 'Catre sarcina');
define('VILLAGE_OF_THE_ELDERS', 'satul batranilor');
define('VILLAGE_OF_THE_ELDERS_TROOPS', 'trupele satului batranilor');

//SEND TROOP
define('REINFORCE', 'Intarire');
define('NORMALATTACK', 'Atac normal');
define('RAID', 'Raid');
define('OR', 'sau');
define('SENDTROOP', 'Trimite trupe');
define('NOTROOP', 'nicio trupa');

//map
define('DETAIL', 'Detalii');
define('ABANDVALLEY', 'Vale abandonata');
define('OCCUPIED', 'Ocupat');
define('UNOCCUPIED', 'Neocupat');
define('UNOCCUOASIS', 'Oaza neocupata');
define('OCCUOASIS', 'Oaza ocupata');
define('THERENOINFO', 'Nu exista<br>informatii disponibile.');
define('LANDDIST', 'Distributia terenului');
define('TRIBE', 'Trib');
define('ALLIANCE', 'Alianta');
define('POP', 'Populatie');
define('REPORT', 'Raport');
define('OPTION', 'Optiuni');
define('CENTREMAP', 'Centreaza harta');
define('FNEWVILLAGE', 'Fondeaza sat nou');
define('CULTUREPOINT', 'puncte de cultura');
define('BUILDRALLY', 'construieste un punct de adunare');
define('SETTLERSAVAIL', 'colonisti disponibili');
define('BEGINPRO', 'protectia incepatorilor');
define('SENDMERC', 'Trimite negustori');
define('BAN', 'Jucatorul este banat');
define('BUILDMARKET', 'Construieste piata');
define('PERHOUR', 'pe ora');
define('BONUS', 'Bonus');
define('MAP', 'Harta');
define('LARGE_MAP', 'Harta mare');
define('LARGE_MAP_DESC', 'Arata harta mare intr-o fereastra separata');
define('CROPFINDER', 'Cautator de cereale');
define('NORTH', 'Nord');
define('EAST', 'Est');
define('SOUTH', 'Sud');
define('WEST', 'Vest');
define('CLOSE_MAP', 'Inchide harta');
define('AND', 'si');

//other
define('VILLAGE', 'Sat');
define('STATISTICS', 'Statistici');
define('OASIS', 'Oaza');
define('NO_OASIS', 'Nu detii nicio oaza.');
define('NO_VILLAGES', 'Nu exista sate.');
define('PLAYER', 'Jucator');

//LOGIN.php
define('COOKIES', 'Trebuie sa ai cookie-urile activate pentru a te putea autentifica. Daca imparti acest calculator cu alte persoane, ar trebui sa te deconectezi dupa fiecare sesiune pentru propria siguranta.');
define('NAME', 'Nume');
define('PW_FORGOTTEN', 'Ai uitat parola?');
define('PW_REQUEST', 'Atunci poti cere una noua care va fi trimisa la adresa ta de email.');
define('PW_GENERATE', 'Genereaza parola noua.');
define('EMAIL_NOT_VERIFIED', 'Email neverificat!');
define('EMAIL_FOLLOW', 'Urmeaza acest link pentru a-ti activa contul.');
define('VERIFY_EMAIL', 'Verifica emailul.');
define('SERVER_STARTS_IN', 'Serverul va incepe in: ');
define('START_NOW', 'INCEPE ACUM');


//404.php
define('NOTHING_HERE', 'Nimic aici!');
define('WE_LOOKED', 'Am cautat deja de 404 ori dar nu gasim nimic');

//MASSMESSAGE.php
define('MASS', 'Continutul mesajului');
define('MASS_SUBJECT', 'Subiect:');
define('MASS_COLOR', 'Culoarea mesajului:');
define('MASS_REQUIRED', 'Toate campurile sunt obligatorii');
define('MASS_UNITS', 'Imagini (unitati):');
define('MASS_SHOWHIDE', 'Arata/Ascunde');
define('MASS_READ', 'Citeste asta: dupa adaugarea unui smiley, trebuie sa adaugi left sau right dupa numar, altfel imaginea nu va functiona');
define('MASS_CONFIRM', 'Confirmare');
define('MASS_REALLY', 'Chiar vrei sa trimiti MassIGM?');
define('MASS_ABORT', 'Se anuleaza acum');
define('MASS_SENT', 'IGM in masa a fost trimis');

//BUILDINGS
define('WOODCUTTER', 'Taietor de lemne');
define('WOODCUTTER_DESC', 'Taietorul de lemne taie copaci pentru a produce lemn. Cu cat il extinzi mai mult, cu atat se produce mai mult lemn.<br>Construind un gater, poti creste si mai mult productia');
define('CLAYPIT', 'Groapa de lut');
define('CLAYPIT_DESC', 'Aici se produce lutul. Crescand nivelul, cresti productia de lut.<br>Construind o caramidarie, poti creste si mai mult productia');
define('IRONMINE', 'Mina de fier');
define('IRONMINE_DESC', 'Aici minerii aduna pretioasa resursa de fier. Crescand nivelul minei, cresti productia de fier.<br>Construind o turnatorie de fier, poti creste si mai mult productia');
define('CROPLAND', 'Cultura de cereale');
define('CROPLAND_DESC', 'Aici se produce hrana populatiei tale. Crescand nivelul culturii, cresti productia de cereale.<br>Construind o moara si o brutarie, poti creste si mai mult productia');

define('SAWMILL', 'Gater');
define('SAWMILL_DESC', 'Lemnul taiat de taietorii tai este prelucrat aici. Gaterul creste productia de lemn in sat. La nivelul 1, creste productia de lemn cu 5%, si de fiecare data cand il imbunatatesti, productia creste cu inca 5%, pentru un total de 25% dupa 5 niveluri.<br>Bonusul gaterului si al tuturor cladirilor care ofera bonusuri de resurse se aplica doar satului in care este construita cladirea.<br>Retine ca bonusul gaterului nu se aplica altor efecte bonus precum venitul din oaza sau bonusul PLUS de 10%.<br>Exista si sate formate din 3 sau 5 campuri de lemn. Cu cat mai multe campuri intr-un sat, cu atat nivelurile gaterului pot fi mai eficiente');
define('CURRENT_WOOD_BONUS', 'Bonus lemn curent:');
define('WOOD_BONUS_LEVEL', 'Bonus lemn la nivelul');
define('MAX_LEVEL', 'Cladirea este deja la nivel maxim');
define('PERCENT', 'Procent');

define('BRICKYARD', 'Caramidarie');
define('CURRENT_CLAY_BONUS', 'Bonus lut curent:');
define('CLAY_BONUS_LEVEL', 'Bonus lut la nivelul');
define('BRICKYARD_DESC', 'Aici lutul se transforma in caramizi. Caramidaria creste productia de lut in sat. La nivelul 1, creste productia de lut cu 5%, si de fiecare data cand o imbunatatesti, productia creste cu inca 5%, pentru un total de 25% dupa 5 niveluri.<br>Bonusul caramidariei si al tuturor cladirilor care ofera bonusuri de resurse se aplica doar satului in care este construita cladirea.<br>Retine ca bonusul caramidariei nu se aplica altor efecte bonus precum venitul din oaza sau bonusul PLUS de 10%.<br>Exista si sate formate din 3 sau 5 campuri de lut. Cu cat mai multe campuri intr-un sat, cu atat nivelurile caramidariei pot fi mai eficiente');

define('IRONFOUNDRY', 'Turnatorie de fier');
define('CURRENT_IRON_BONUS', 'Bonus fier curent:');
define('IRON_BONUS_LEVEL', 'Bonus fier la nivelul');
define('IRONFOUNDRY_DESC', 'Aici se topeste fierul. Turnatoria de fier creste productia de fier in sat. La nivelul 1, creste productia de fier cu 5%, si de fiecare data cand o imbunatatesti, productia creste cu inca 5%, pentru un total de 25% dupa 5 niveluri.<br>Bonusul turnatoriei si al tuturor cladirilor care ofera bonusuri de resurse se aplica doar satului in care este construita cladirea.<br>Retine ca bonusul turnatoriei nu se aplica altor efecte bonus precum venitul din oaza sau bonusul PLUS de 10%.<br>Exista si sate formate din 3 sau 5 campuri de fier. Cu cat mai multe campuri intr-un sat, cu atat nivelurile turnatoriei pot fi mai eficiente');

define('GRAINMILL', 'Moara');
define('CURRENT_CROP_BONUS', 'Bonus cereale curent:');
define('CROP_BONUS_LEVEL', 'Bonus cereale la nivelul');
define('GRAINMILL_DESC', 'Aici graul se macina in faina. Moara creste productia de hrana in sat. La nivelul 1, creste productia de hrana cu 5%, si de fiecare data cand o imbunatatesti, productia creste cu inca 5%, pentru un total de 25% dupa 5 niveluri.<br>Folosita impreuna cu brutaria pentru o crestere totala a productiei de cereale de pana la 50%.<br>Bonusul morii si al tuturor cladirilor care ofera bonusuri de resurse se aplica doar satului in care este construita cladirea.<br>Retine ca bonusul morii nu se aplica altor efecte bonus precum venitul din oaza sau bonusul PLUS de 10%.<br>Exista si sate formate din 9 sau 15 campuri de cereale. Cu cat mai multe campuri intr-un sat, cu atat nivelurile morii pot fi mai eficiente');

define('BAKERY', 'Brutarie');
define('BAKERY_DESC', 'Aici se coace painea din faina. Brutaria creste productia de hrana in sat. La nivelul 1, creste productia de hrana cu 5%, si de fiecare data cand o imbunatatesti, productia creste cu inca 5%, pentru un total de 25% dupa 5 niveluri.<br>Folosita impreuna cu moara poate creste productia de cereale cu pana la 50%.<br>Bonusul brutariei si al tuturor cladirilor care ofera bonusuri de resurse se aplica doar satului in care este construita cladirea.<br>Retine ca bonusul brutariei nu se aplica altor efecte bonus precum venitul din oaza sau bonusul PLUS de 10%.<br>Exista si sate formate din 9 sau 15 campuri de cereale. Cu cat mai multe campuri intr-un sat, cu atat nivelurile brutariei pot fi mai eficiente');

define('WAREHOUSE', 'Depozit');
define('CURRENT_CAPACITY', 'Capacitate curenta:');
define('CAPACITY_LEVEL', 'Capacitate la nivelul');
define('RESOURCE_UNITS', 'unitati de resursa');
define('WAREHOUSE_DESC', 'Resursele lemn, lut si fier sunt stocate in depozit. Crescand nivelul, cresti capacitatea depozitului. Poate fi construit de mai multe ori, dupa ce unul a fost construit la nivel maxim');

define('GRANARY', 'Hambar');
define('CROP_UNITS', 'unitati de cereale');
define('GRANARY_DESC', 'Cerealele produse pe fermele tale sunt stocate in hambar. Crescand nivelul, cresti capacitatea hambarului. Poate fi construit de mai multe ori, dupa ce unul a fost construit la nivel maxim');
define('BLACKSMITH', 'Fierarie');
define('ACTION', 'Actiune');
define('UPGRADE', 'Imbunatateste');
define('UPGRADE_IN_PROGRESS', 'Imbunatatire in<br>desfasurare');
define('UPGRADE_BLACKSMITH', 'Imbunatateste<br>fieraria');
define('UPGRADES_COMMENCE_BLACKSMITH', 'Imbunatatirile pot incepe cand fieraria este gata.');
define('MAXIMUM_LEVEL', 'Nivel<br>maxim');
define('EXPAND_WAREHOUSE', 'Extinde<br>depozitul');
define('EXPAND_GRANARY', 'Extinde<br>hambarul');
define('ENOUGH_RESOURCES', 'Resurse suficiente');
define('CROP_NEGATIVE ', 'Productia de cereale este negativa deci nu vei atinge niciodata resursele necesare');
define('TOO_FEW_RESOURCES', 'Prea putine<br>resurse');
define('UPGRADING', 'Se imbunatateste');
define('DURATION', 'Durata');
define('COMPLETE', 'Gata');
define('BLACKSMITH_DESC', 'Armele razboinicilor tai sunt imbunatatite in cuptoarele de topire ale fierariei. Crescand nivelul, poti comanda fabricarea unor arme si mai bune');

define('ARMOURY', 'Armurarie');
define('UPGRADE_ARMOURY', 'Imbunatateste<br>Armuraria');
define('UPGRADES_COMMENCE_ARMOURY', 'Imbunatatirile pot incepe cand armuraria este gata.');
define('ARMOURY_DESC', 'Armura razboinicilor tai este imbunatatita in cuptoarele de topire ale armurariei. Crescand nivelul, poti comanda fabricarea unor armuri si mai bune');

define('TOURNAMENTSQUARE', 'Piata turnirului');
define('CURRENT_SPEED', 'Bonus de viteza curent:');
define('SPEED_LEVEL', 'Bonus de viteza la nivelul');
define('TOURNAMENTSQUARE_DESC', 'Trupele tale isi pot creste rezistenta la Piata turnirului. Cu cat cladirea este mai imbunatatita, cu atat trupele tale sunt mai rapide dincolo de o distanta minima de '.TS_THRESHOLD.' patrate');

define('MAINBUILDING', 'Cladirea principala');
define('CURRENT_CONSTRUCTION_TIME', 'Timp de constructie curent:');
define('CONSTRUCTION_TIME_LEVEL', 'Timp de constructie la nivelul');
define('DEMOLITION_BUILDING', 'Demolarea cladirii:</h2><p>Daca nu mai ai nevoie de o cladire, poti comanda demolarea ei.</p>');
define('DEMOLISH', 'Demoleaza');
define('DEMOLITION_OF', 'Demolarea ');
define('MAINBUILDING_DESC', 'Maistrii satului locuiesc in cladirea principala. Cu cat nivelul este mai mare, cu atat maistrii tai termina mai repede constructia cladirilor noi.');

define('RALLYPOINT', 'Punct de adunare');
define('RALLYPOINT_COMMENCE', 'Miscarea trupelor va fi afisata cand '.RALLYPOINT.' este gata');
define('OVERVIEW', 'Prezentare generala');
define('REINFORCEMENT', 'Intarire');
define('EVASION_SETTINGS', 'setari de evaziune');
define('SEND_TROOPS_AWAY_MAX', 'Trimite trupele la o distanta maxima de');
define('TIMES', 'ori');
define('PER_EVASION', 'pe evaziune');
define('RALLYPOINT_DESC', 'Trupele satului tau se aduna aici. De aici le poti trimite sa cucereasca, sa jefuiasca sau sa intareasca alte sate.<br>Daca sunt mai putine unitati atacatoare decat nivelul punctului de adunare, poti vedea tipul de unitate care ataca.');
define('COMBAT_SIMULATOR', 'Simulator de lupta');

define('MARKETPLACE', 'Piata');
define('MERCHANT', 'Negustori');
define('OR_', 'sau');
define('GO', 'mergi');
define('UNITS_OF_RESOURCE', 'unitati de resursa');
define('MERCHANT_CARRY', 'Fiecare negustor poate transporta');
define('MERCHANT_COMING', 'Negustori care vin');
define('TRANSPORT_FROM', 'Transport de la');
define('ARRIVAL_IN', 'Sosire in');
define('NO_COORDINATES_SELECTED', 'Nu sunt selectate coordonate');
define('CANNOT_SEND_RESOURCES', 'Nu poti trimite resurse catre acelasi sat');
define('BANNED_CANNOT_SEND_RESOURCES', 'Jucatorul este banat. Nu ii poti trimite resurse');
define('RESOURCES_NO_SELECTED', 'Resurse neselectate');
define('ENTER_COORDINATES', 'Introdu coordonatele sau numele satului');
define('TOO_FEW_MERCHANTS', 'Prea putini negustori');
define('OWN_MERCHANTS_ONWAY', 'Propriii negustori pe drum');
define('MERCHANTS_RETURNING', 'Negustori care se intorc');
define('TRANSPORT_TO', 'Transport catre');
define('I_AN_SEARCHING', 'Caut');
define('I_AN_OFFERING', 'Ofer');
define('OFFERS_MARKETPLACE', 'Oferte la piata');
define('NO_AVAILABLE_OFFERS', 'Nu exista oferte la piata');
define('OFFERED_TO_ME', 'Oferit<br>catre mine');
define('WANTED_TO_ME', 'Cerut<br>de la mine');
define('NOT_ENOUGH_MERCHANTS', 'Nu sunt destui negustori');
define('ACCEP_OFFER', 'Accepta oferta');
define('NO_AVALIBLE_OFFERS', 'Nu exista oferte disponibile pe piata');
define('SEARCHING', 'Caut');
define('OFFERING', 'Ofer');
define('MAX_TIME_TRANSPORT', 'timpul maxim de transport');
define('OWN_ALLIANCE_ONLY', 'doar propria alianta');
define('INVALID_OFFER', 'Oferta invalida');
define('INVALID_MERCHANTS_REPETITION', 'Rata de repetare a negustorilor invalida');
define('USER_ON_VACATION', 'Jucatorul este in modul vacanta');
define('VACATION_MODE', 'Mod vacanta');
define('VACATION_DESC', 'Daca planuiesti sa fii plecat o perioada mai lunga si nu vrei sa setezi un inlocuitor, iti poti seta contul in Modul Vacanta. In acest timp contul tau va inceta sa produca resurse, PC, cercetare, trupe etc. si va inceta sa primeasca atacuri, intariri, raiduri, practic iti ingheata contul. Aminteste-ti, asta doar iti ingheata Travianul, nu timpul. Daca esti membru Gold Club, acesta va expira in acest timp si, daca ai selectat reinnoirea automata, functia de reinnoire automata va fi anulata in Modul Vacanta. Te rugam retine ca trebuie sa setezi minim 2 zile de mod vacanta si NU MAI MULT de 14 zile');
define('VACATION_DESC2', 'Foloseste modul vacanta pentru a-ti proteja satele in timp ce esti plecat.<br>In timpul vacantei urmatoarele actiuni vor fi inactive:');
define('VAC_OP1', 'Trimite sau primeste trupe');
define('VAC_OP2', 'Incepe o noua comanda de constructie');
define('VAC_OP3', 'Foloseste piata');
define('VAC_OP4', 'Antreneaza trupe noi');
define('VAC_OP5', 'Alatura-te unei aliante');
define('VAC_OP6', 'Sterge contul');
define('VAC_COND1', 'Nicio trupa in miscare');
define('VAC_COND2', 'Nicio trupa pe drum spre alte sate');
define('VAC_COND3', 'Nicio trupa trimisa ca intarire altor sate');
define('VAC_COND4', 'Niciun jucator nu are intariri pe satele tale');
define('VAC_COND5', 'Nu detii o Minune a Lumii');
define('VAC_COND6', 'Nu detii niciun artefact');
define('VAC_COND7', 'Nu mai esti in protectia jucatorilor');
define('VAC_COND8', 'Nu ai trupe in capcanele tale');
define('VAC_COND9', 'Contul tau nu este in proces de stergere');
define('NOT_ENOUGH_RESOURCES', 'Resurse insuficiente');
define('OFFER', 'Oferta');
define('SEARCH', 'Cauta');
define('OWN_OFFERS', 'Propriile oferte');
define('ALL', 'Toate');
define('NPC_TRADE', 'Comert NPC');
define('SUM', 'Total');
define('REST', 'Rest');
define('TRADE_RESOURCES', 'Schimba resurse la (pasul 2 din 2');
define('DISTRIBUTE_RESOURCES', 'Distribuie resurse la (pasul 1 din 2)');
define('OF', 'din');
define('NPC_COMPLETED', 'NPC finalizat');
define('BACK_BUILDING', 'Inapoi la cladire');
define('YOU_CAN_NAT_NPC_WW', 'Nu poti folosi comertul NPC in satul Minunii Lumii.');
define('NPC_TRADING', 'Comert NPC');
define('SEND_RESOURCES', 'Trimite resurse');
define('BUY', 'Cumpara');
define('TRADE_ROUTES', 'Rute comerciale');
define('DESCRIPTION', 'Descriere');
define('G_DESCR', 'Descriere generala');
define('TIME_LEFT', 'Timp ramas');
define('START', 'Start');
define('NO_TRADE_ROUTES', 'Nicio ruta comerciala activa');
define('TRADE_ROUTE_TO', 'Ruta comerciala catre');
define('CHECKED', 'bifat');
define('DAYS', 'zile');
define('EXTEND', 'Extinde');
define('EDIT', 'Editeaza');
define('EXTEND_TRADE_ROUTES', 'Extinde ruta comerciala cu <b>7</b> zile pentru');
define('CREATE_TRADE_ROUTES', 'Creeaza ruta comerciala noua');
define('DELIVERIES', 'Livrari');
define('START_TIME_TRADE', 'Ora de inceput');
define('CREATE_TRADE_ROUTE', 'Creeaza ruta comerciala');
define('TARGET_VILLAGE', 'Sat tinta');
define('EDIT_TRADE_ROUTES', 'Editeaza ruta comerciala');
define('TRADE_ROUTES_DESC', 'Ruta comerciala iti permite sa setezi rute pentru negustorul tau pe care le va parcurge zilnic la o anumita ora. <br><br> In mod standard aceasta dureaza <b>7</b> zile, dar o poti extinde cu <b>7</b> zile pentru costul de');
define('NPC_TRADE_DESC', 'Cu negustorul NPC poti distribui resursele din depozitul tau dupa cum doresti. <br><br> Primul rand arata stocul curent. In al doilea rand poti alege o alta distributie. Al treilea rand arata diferenta dintre stocul vechi si cel nou.');
define('MARKETPLACE_DESC', 'La piata poti face comert cu resurse cu alti jucatori. Cu cat nivelul este mai mare, cu atat mai multe resurse pot fi transportate de negustorii tai in acelasi timp');

define('EMBASSY', 'Ambasada');
define('TAG', 'Tag');
define('TO_THE_ALLIANCE', 'catre alianta');
define('JOIN_ALLIANCE', 'alatura-te aliantei');
define('REFUSE', 'refuza');
define('ACCEPT', 'accepta');
define('NO_INVITATIONS', 'Nu exista invitatii disponibile.');
define('NO_CREATE_ALLIANCE', 'Un jucator banat nu poate crea o alianta.');
define('FOUND_ALLIANCE', 'fondeaza alianta');
define('EMBASSY_DESC', 'Ambasada este un loc pentru diplomati. La nivelul 1 te poti alatura unei aliante, iar dupa ce o extinzi la nivelul 3 poti chiar fonda una.<br>Numarul maxim de membri intr-o alianta este 60');

define('BARRACKS', 'Cazarma');
define('QUANTITY', 'Cantitate');
define('MAX', 'Max');
define('TRAINING', 'Antrenament');
define('FINISHED', 'Gata');
define('UNIT_FINISHED', 'Urmatoarea unitate va fi gata in');
define('AVAILABLE', 'Disponibil');
define('TRAINING_COMMENCE_BARRACKS', 'Antrenamentul poate incepe cand cazarma este gata.');
define('BARRACKS_DESC', 'Infanteria poate fi antrenata in cazarma. Cu cat nivelul este mai mare, cu atat trupele sunt antrenate mai repede');

define('STABLE', 'Grajd');
define('AVAILABLE_ACADEMY', 'Nicio unitate disponibila. Cerceteaza la academie');
define('TRAINING_COMMENCE_STABLE', 'Antrenamentul poate incepe cand grajdul este gata.');
define('STABLE_DESC', 'Cavaleria poate fi antrenata in grajd. Cu cat nivelul este mai mare, cu atat trupele sunt antrenate mai repede');

define('WORKSHOP', 'Atelier');
define('TRAINING_COMMENCE_WORKSHOP', 'Antrenamentul poate incepe cand atelierul este gata.');
define('WORKSHOP_DESC', 'Masinile de asediu, precum catapultele si berbecii, pot fi construite in atelier. Cu cat nivelul este mai mare, cu atat aceste unitati sunt produse mai repede');

define('ACADEMY', 'Academie');
define('RESEARCH_AVAILABLE', 'Nu exista cercetari disponibile');
define('RESEARCH_COMMENCE_ACADEMY', 'Cercetarea poate incepe cand academia este gata.');
define('RESEARCH', 'Cercetare');
define('EXPAND_WAREHOUSE1', 'Extinde depozitul');
define('EXPAND_GRANARY1', 'Extinde hambarul');
define('RESEARCH_IN_PROGRESS', 'Cercetare in<br>desfasurare');
define('RESEARCHING', 'Se cerceteaza');
define('PREREQUISITES', 'Conditii prealabile');
define('SHOW_MORE', 'arata mai mult');
define('HIDE_MORE', 'ascunde mai mult');
define('ACADEMY_DESC', 'Tipuri noi de unitati pot fi cercetate in academie. Crescand nivelul, poti comanda cercetarea unor unitati mai bune');

define('CRANNY', 'Ascunzatoare');
define('CURRENT_HIDDEN_UNITS', 'Unitati ascunse curent pe resursa:');
define('HIDDEN_UNITS_LEVEL', 'Unitati ascunse pe resursa la nivelul');
define('UNITS', 'unitati');
define('CRANNY_DESC', 'Ascunzatoarea ascunde o parte din resursele tale in caz ca satul este atacat. Aceste resurse nu pot fi furate.<br>La nivelul 1 ascunzatoarea poate tine '.(100*((int)CRANNY_CAPACITY)).' din fiecare resursa. Capacitatea ascunzatorilor galice este de 1.5 ori mai mare.<br>Daca un erou teuton ataca un sat, ascunzatorile pot ascunde doar 80% din capacitatea lor normala');

define('TOWNHALL', 'Primaria');
define('CELEBRATIONS_COMMENCE_TOWNHALL', 'Sarbatorile pot incepe cand primaria este gata.');
define('GREAT_CELEBRATIONS', 'Mare sarbatoare');
define('CULTURE_POINTS', 'Puncte de cultura');
define('HOLD', 'tine');
define('CELEBRATIONS_IN_PROGRESS', 'Sarbatoare<br>in desfasurare');
define('CELEBRATIONS', 'Sarbatori');
define('TOWNHALL_DESC', 'In primarie poti tine sarbatori fastuoase. O astfel de sarbatoare iti creste punctele de cultura.<br>Punctele de cultura sunt necesare pentru a fonda sau cuceri sate noi. Fiecare cladire produce puncte de cultura si cu cat nivelul este mai mare, cu atat produce mai multe');

define('RESIDENCE', 'Resedinta');
define('CAPITAL', 'Aceasta este capitala ta');
define('RESIDENCE_TRAIN_DESC', 'Pentru a fonda un sat nou ai nevoie de o resedinta de nivel 10 sau 20 si 3 colonisti. Pentru a cuceri un sat nou ai nevoie de o resedinta de nivel 10 sau 20 si un senator, capetenie sau capetenie de trib.');
define('PRODUCTION_POINTS', 'Productia acestui sat:');
define('PRODUCTION_ALL_POINTS', 'Productia tuturor satelor:');
define('POINTS_DAY', 'Puncte de cultura pe zi');
define('VILLAGES_PRODUCED', 'Satele tale au produs');
define('POINTS_NEED', 'puncte in total. Pentru a fonda sau cuceri un sat nou ai nevoie de');
define('POINTS', 'puncte');
define('INHABITANTS', 'Locuitori');
define('COORDINATES', 'Coordonate');
define('EXPANSION', 'Extindere');
define('TRAIN', 'Antreneaza');
define('DATE', 'Data');
define('CONQUERED_BY_VILLAGE', 'Sate fondate sau cucerite de acest sat');
define('NONE_CONQUERED_BY_VILLAGE', 'Niciun alt sat nu a fost inca fondat sau cucerit de acest sat.');
define('RESIDENCE_CULTURE_DESC', 'Pentru a-ti extinde imperiul ai nevoie de puncte de cultura. Aceste puncte de cultura cresc in timp si o fac mai repede pe masura ce nivelurile cladirilor tale cresc.');
define('RESIDENCE_LOYALTY_DESC', 'Atacand cu senatori, capetenii sau capetenii de trib, loialitatea unui sat poate fi scazuta. Daca ajunge la zero, satul se alatura imperiului atacatorului. Loialitatea acestui sat este in prezent la ');
define('RESIDENCE_DESC', 'Resedinta protejeaza satul impotriva cuceririlor inamice. Poti construi o resedinta pe sat. Unitatile care pot fonda un sat nou sau cuceri sate existente pot fi antrenate aici.<br>In plus, resedinta ofera un slot de extindere la nivelurile 10 si 20');

define('PALACE', 'Palat');
define('PALACE_CONSTRUCTION', 'Palat in constructie');
define('PALACE_TRAIN_DESC', 'Pentru a fonda un sat nou ai nevoie de un palat de nivel 10, 15 sau 20 si 3 colonisti. Pentru a cuceri un sat nou ai nevoie de un palat de nivel 10, 15 sau 20 si un senator, capetenie sau capetenie de trib.');
define('CHANGE_CAPITAL', 'schimba capitala');
define('SECURITY_CHANGE_CAPITAL', 'Esti sigur ca vrei sa iti schimbi capitala?<br><b>Nu poti anula asta!</b><br>Pentru securitate trebuie sa introduci parola pentru a confirma:<br>');
define('PALACE_DESC', 'Cladirea palatului este unica. Poti construi doar unul in tot imperiul tau si poti declara acel sat drept capitala ta. De asemenea, protejeaza satul impotriva cuceririlor inamice. Unitatile care pot fonda un sat nou sau cuceri sate existente pot fi antrenate aici.<br>In plus, palatul ofera un slot de extindere la nivelurile 10, 15 si 20');

define('TREASURY', 'Trezorerie');
define('TREASURY_COMMENCE', 'Artefactele pot fi vazute cand trezoreria este gata.');
define('ARTEFACTS_AREA', 'Artefacte in zona ta');
define('NO_ARTEFACTS_AREA', 'Nu exista artefacte in zona ta.');
define('OWN_ARTEFACTS', 'Propriile artefacte');
define('CONQUERED', 'Cucerit');
define('DISTANCE', 'Distanta');
define('EFFECT', 'Efect');
define('ACCOUNT', 'Cont');
define('SMALL_ARTEFACTS', 'Artefacte mici');
define('LARGE_ARTEFACTS', 'Artefacte mari');
define('NO_ARTEFACTS', 'Nu exista artefacte.');
define('ANY_ARTEFACTS', 'Nu detii niciun artefact.');
define('OWNER', 'Proprietar');
define('AREA_EFFECT', 'Zona de efect');
define('VILLAGE_EFFECT', 'Efect asupra satului');
define('ACCOUNT_EFFECT', 'Efect asupra contului');
define('UNIQUE_EFFECT', 'Efect unic');
define('REQUIRED_LEVEL', 'Nivel necesar');
define('TIME_CONQUER', 'Timpul cuceririi');
define('TIME_ACTIVATION', 'Timpul activarii');
define('NEXT_EFFECT', ' Efect urmator');
define('FORMER_OWNER', 'Fosti proprietari');
define('BUILDING_STRONGER', 'Cladire mai puternica cu');
define('BUILDING_WEAKER', 'Cladire mai slaba cu');
define('TROOPS_FASTER', 'Face trupele mai rapide cu');
define('TROOPS_SLOWEST', 'Face trupele mai lente cu');
define('SPIES_INCREASE', 'Spionii cresc abilitatea cu');
define('SPIES_DECRESE', 'Spionii scad abilitatea cu');
define('CONSUME_LESS', 'Toate trupele consuma mai putin cu');
define('CONSUME_HIGH', 'Toate trupele consuma mai mult cu');
define('TROOPS_MAKE_FASTER', 'Trupele se produc mai repede cu');
define('TROOPS_MAKE_SLOWEST', 'Trupele se produc mai lent cu');
define('YOU_CONSTRUCT', 'Poti construi ');
define('CRANNY_INCREASED', 'Capacitatea ascunzatorii este crescuta cu');
define('CRANNY_DECRESE', 'Capacitatea ascunzatorii este scazuta cu');
define('WW_BUILDING_PLAN', 'Poti construi Minunea Lumii');
define('NO_WW', 'Nu exista Minuni ale Lumii');
define('NO_PREVIOUS_OWNERS', 'Nu exista proprietari anteriori.');
define('TREASURY_DESC', 'Bogatiile imperiului tau sunt pastrate in trezorerie. O trezorerie poate stoca doar un artefact pe rand.<br>Ai nevoie de o trezorerie de nivel 10 pentru un artefact mic, sau nivel 20 pentru unul mare');

define('TRADEOFFICE', 'Birou comercial');
define('CURRENT_MERCHANT', 'Incarcatura curenta a negustorului:');
define('MERCHANT_LEVEL', 'Incarcatura negustorului la nivelul');
define('TRADEOFFICE_DESC', 'In biroul comercial, carutele negustorilor sunt imbunatatite si echipate cu cai mai puternici. Cu cat nivelul este mai mare, cu atat negustorii tai pot transporta mai mult');

define('GREATBARRACKS', 'Cazarma mare');
define('TRAINING_COMMENCE_GREATBARRACKS', 'Antrenamentul poate incepe cand cazarma mare este gata.');
define('GREATBARRACKS_DESC', 'Cazarma mare iti permite sa construiesti o a doua cazarma in acelasi sat, dar trupele costa de 3 ori cantitatea originala.<br>Combinata cu cazarma obisnuita, poti antrena trupele de doua ori mai repede intr-un sat');

define('GREATSTABLE', 'Grajd mare');
define('TRAINING_COMMENCE_GREATSTABLE', 'Antrenamentul poate incepe cand grajdul mare este gata.');
define('GREATSTABLE_DESC', 'Grajdul mare iti permite sa construiesti un al doilea grajd in acelasi sat, dar trupele costa de 3 ori cantitatea originala.<br>Combinat cu grajdul obisnuit, poti antrena trupele de doua ori mai repede intr-un sat');

define('CITYWALL', 'Zid de cetate');
define('DEFENCE_NOW', 'Bonus de aparare acum:');
define('DEFENCE_LEVEL', 'Bonus de aparare la nivelul');
define('CITYWALL_DESC', 'Ofera un bonus de aparare pentru trupele tale (((1.03 ^ nivel) * 100)% + 10) puncte defensive pe nivel la valoarea defensiva de baza a unui sat. Un zid de nivel mai mare va da trupelor tale un bonus de aparare mai mare.<br>Specific tribului: doar Romani');

define('EARTHWALL', 'Val de pamant');
define('EARTHWALL_DESC', 'Ofera un bonus de aparare pentru trupele tale (((1.02 ^ nivel) * 100)% + 6) puncte defensive pe nivel la valoarea defensiva de baza a unui sat. Un val de pamant de nivel mai mare va da trupelor tale un bonus de aparare mai mare.<br>Specific tribului: doar Teutoni');

define('PALISADE', 'Palisada');
define('PALISADE_DESC', 'Ofera un bonus de aparare pentru trupele tale (((1.025 ^ nivel) * 100)% + 8) puncte defensive pe nivel la valoarea defensiva de baza a unui sat. O palisada de nivel mai mare va da trupelor tale un bonus de aparare mai mare.<br>Specific tribului: doar Gali');

define('STONEMASON', 'Atelierul pietrarului');
define('CURRENT_STABILITY', 'Bonus de stabilitate curent:');
define('STABILITY_LEVEL', 'Bonus de stabilitate la nivelul');
define('STONEMASON_DESC', 'Pietrarul este expert in taierea pietrei. Cu cat nivelul Atelierului pietrarului este mai mare, cu atat este mai mare stabilitatea cladirilor satului tau. Pentru fiecare nivel aceasta cladire va creste durabilitatea cu 10%, pentru un maxim de 200% durabilitate pentru cladirile tale.<br>Aceasta cladire poate fi construita doar in capitala unui cont');

define('BREWERY', 'Berarie');
define('CURRENT_BONUS', 'Bonus curent:');
define('BONUS_LEVEL', 'Bonus la nivelul');
define('BREWERY_DESC', 'Aici se prepara mied gustos. Bauturile iti fac soldatii mai curajosi si mai puternici cand ataca pe altii (1% pe nivel de Berarie). Din pacate, puterea de convingere a liderilor este redusa cu 50% si catapultele pot lovi doar aleator. Poate fi construita doar in capitala, dar afecteaza toate satele tale. Festivalurile mied dureaza mereu 72 de ore.<br>Specific tribului: doar Teutoni');

define('TRAPPER', 'Capcanier');
define('CURRENT_TRAPS', 'Numarul maxim curent de capcane de antrenat:');
define('TRAPS_LEVEL', 'Numarul maxim de capcane de antrenat la nivelul');
define('TRAPS', 'Capcane');
define('TRAP', 'Capcana');
define('CURRENT_HAVE', 'Ai in prezent');
define('WHICH_OCCUPIED', 'dintre care sunt ocupate.');
define('TRAINING_COMMENCE_TRAPPER', 'Antrenamentul poate incepe cand capcanierul este gata.');
define('TRAPPER_DESC', 'Capcanierul iti protejeaza satul cu capcane bine ascunse. Asta inseamna ca dusmanii neatenti pot fi inchisi si nu vor mai putea face rau satului tau.<br>Trupele nu pot fi eliberate cu un raid. Daca proprietarul capcanelor elibereaza captivii, toate capcanele se vor repara automat.<br>Specific tribului: doar Gali');

define('HEROSMANSION', 'Conacul eroului');
define('HERO_READY', 'Eroul va fi gata in ');
define('NAME_CHANGED', 'Numele eroului a fost schimbat');
define('NOT_UNITS', 'Unitati indisponibile');
define('NOT', 'Nu ');
define('TRAIN_HERO', 'Antreneaza erou nou');
define('REVIVE', 'Invie');
define('OASES', 'Oaze');
define('DELETE', 'Sterge');
define('RESOURCES', 'Resurse');
define('OFFENCE', 'Atac');
define('DEFENCE', 'Aparare');
define('OFF_BONUS', 'Bonus atac');
define('DEF_BONUS', 'Bonus aparare');
define('REGENERATION', 'Regenerare');
define('DAY', 'Zi');
define('EXPERIENCE', 'Experienta');
define('YOU_CAN', 'Poti ');
define('RESET', 'reseta');
define('YOUR_POINT_UNTIL', ' punctele tale pana cand esti nivel ');
define('OR_LOWER', ' sau mai jos!');
define('YOUR_HERO_HAS', 'Eroul tau are ');
define('OF_HIT_POINTS', 'din punctele sale de viata');
define('ERROR_NAME_SHORT', 'Eroare: nume prea scurt');
define('HEROSMANSION_DESC', 'Conacul eroului este casa gloriosului tau erou.<br>La nivelurile 10, 15 si 20 ale cladirii, poti folosi eroul pentru a anexa o oaza neocupata satului tau, cate una pentru fiecare dintre aceste niveluri. In functie de oaza, vei primi o crestere a productiei pentru un anumit tip de resursa (sau chiar doua resurse, de la unele oaze)');

define('GREATWAREHOUSE', 'Depozit mare');
define('GREATWAREHOUSE_DESC', 'Depozitul mare are de 3 ori capacitatea unui depozit normal.<br>Aceasta cladire poate fi construita doar in satele Minunii Lumii sau cu un artefact Natarian special');

define('GREATGRANARY', 'Hambar mare');
define('GREATGRANARY_DESC', 'Hambarul mare are de 3 ori capacitatea unui hambar normal.<br>Aceasta cladire poate fi construita doar in satele Minunii Lumii sau cu un artefact Natarian special');

define('WONDER', 'Minunea Lumii');
define('WORLD_WONDER', 'Minunea Lumii');
define('WONDER_DESC', 'O Minune a Lumii (cunoscuta si ca MdL) este la fel de uimitoare pe cat suna. Fiecare nivel costa multe resurse. Este aproape imposibil pentru un singur jucator sa construiasca o MdL pe cont propriu. Motivul este ca ai nevoie nu doar de multe resurse, ci si de trupe pentru a-ti proteja pretioasa cladire.<br>Pentru a construi o MdL ai nevoie de un Plan de Constructie Antic. Il poti obtine atacand un Sat Natar cu eroul tau. Trebuie sa ai o trezorerie goala de nivel 10 si eroul tau trebuie sa supravietuiasca. Cu acel plan si un nivel extrem de ridicat de resurse, poti incepe minunea lumii.<br>Odata ce ajunge la nivelul 50, vei avea nevoie de altcineva din alianta ta care sa aiba un al doilea plan de constructie activ. Nu poti face totul singur.<br>Terminand o MdL la nivel 100, vei castiga serverul Travian si este sfarsitul unei lumi de joc.<br>Odata ce termini, va aparea un mesaj care spune cine a castigat si statisticile. Nu mai poti construi, dar poti trimite mesaje pana cand serverul reporneste');
define('WORLD_WONDER_CHANGE_NAME', 'Trebuie sa ai Minunea Lumii nivel 1 pentru a-i putea schimba numele');
define('WORLD_WONDER_NAME', 'Numele Minunii Lumii');
define('WORLD_WONDER_NOTCHANGE_NAME', 'Nu poti schimba numele Minunii Lumii dupa nivelul 10');
define('WORLD_WONDER_NAME_CHANGED', 'Nume schimbat');

define('HORSEDRINKING', 'Adapatoare pentru cai');
define('HORSEDRINKING_DESC', 'Reduce timpul de antrenament si intretinerea cavaleriei. Poate fi construita si in satele Minunii Lumii Romane.<br>Accelereaza timpul de antrenament al unitatilor de cavalerie cu 1% pe nivel si scade consumul de cereale al unor unitati in functie de nivel.<br>Specific tribului: doar Romani');

define('GREATWORKSHOP', 'Atelier mare');
define('TRAINING_COMMENCE_GREATWORKSHOP', 'Antrenamentul poate incepe cand atelierul mare este gata.');
define('GREATWORKSHOP_DESC', 'Atelierul mare iti permite sa construiesti un al doilea atelier in acelasi sat, dar catapultele si berbecii costa de 3 ori cantitatea originala.<br>Combinat cu atelierul obisnuit, poti antrena trupele de doua ori mai repede intr-un sat');

define('BUILDING_MAX_LEVEL_UNDER', 'Cladire la nivel maxim in constructie');
define('BUILDING_BEING_DEMOLISHED', 'Cladire in curs de demolare');
define('COSTS_UPGRADING_LEVEL', 'Costuri</b> pentru imbunatatire la nivelul');
define('WORKERS_ALREADY_WORK', 'Muncitorii sunt deja la lucru.');
define('CONSTRUCTING_MASTER_BUILDER', 'Se construieste cu maistrul ');
define('COSTS', 'Costuri');
define('WORKERS_ALREADY_WORK_WAITING', 'Muncitorii sunt deja la lucru. (in asteptare)');
define('ENOUGH_FOOD_EXPAND_CROPLAND', 'Nu este destula hrana. Extinde cultura de cereale.');
define('UPGRADE_WAREHOUSE', 'Imbunatateste depozitul');
define('UPGRADE_GRANARY', 'Imbunatateste hambarul');
define('YOUR_CROP_NEGATIVE', 'Productia ta de cereale este negativa, nu vei obtine niciodata resursele necesare.');
define('UPGRADE_LEVEL', 'Imbunatateste la nivelul ');
define('WAITING', '(in asteptare)');
define('NEED_WWCONSTRUCTION_PLAN', 'Ai nevoie de plan de constructie MdL');
define('NEED_MORE_WWCONSTRUCTION_PLAN', 'Ai nevoie de mai multe planuri de constructie MdL');
define('CONSTRUCT_NEW_BUILDING', 'Construieste cladire noua');
define('SHOWSOON_AVAILABLE_BUILDINGS', 'arata cladirile disponibile in curand');
define('HIDESOON_AVAILABLE_BUILDINGS', 'ascunde cladirile disponibile in curand');

// gold plus
define('GOLD_SHOP', 'Magazin de Aur');
define('PACKAGE_A', 'Pachet A');
define('PACKAGE_B', 'Pachet B');
define('PACKAGE_C', 'Pachet C');
define('PACKAGE_D', 'Pachet D');
define('PACKAGE_E', 'Pachet E');
define('PAYMENT_METHOD', 'Metoda de plata');
define('PACKAGES_NOT_REFUND', 'Niciunul dintre pachete nu este rambursabil');
define('PLUS_FUNC', 'Functie Plus');
define('REMAINING', 'Ramas');
define('MINS', 'min');
define('ACTIVATE', 'Activeaza');
define('TOO_LITTLE_GOLD', 'Prea putin aur');
define('GOLD_ON', 'Activ');
define('PLUS_END', 'Avantajul tau PLUS s-a incheiat');
define('NPC', 'NPC');
define('NO_GOLD', 'Momentan nu detii aur');
define('GOLD_CLUB', 'Gold Club');
define('NOW', 'acum');
define('NPC_TRADE_GOLD', 'Comert cu negustorul NPC');
define('COMPLETE_CONSTRUCTION_R_GOLD', 'Termina acum comenzile de constructie si cercetarile din acest sat (nu functioneaza pentru Palat si Resedinta)');
define('FOR_GAME_SERVER', 'Toata runda de joc');
define('HAVE_NO_INVITED', 'Nu ai adus inca niciun jucator nou');
define('INVITE_FRIENDS_GOLD', 'Invita prieteni si primeste Aur gratuit');
define('NEED_MORE_GOLD', 'Ai nevoie de mai mult aur');
define('ADD_PLUS_FAIL', 'Incercare plus esuata');
define('ADD_BONUS_LUMBER_FAIL', 'Incercare lemn esuata');
define('ADD_BONUS_CLAY_FAIL', 'Incercare lut esuata');
define('ADD_BONUS_IRON_FAIL', 'Incercare fier esuata');
define('ADD_BONUS_CROP_FAIL', 'Incercare cereale esuata');
define('SELECT_GOLD_OPTION', 'Te rugam selecteaza optiunea pe care vrei sa o activezi sau extinzi');
define('GET_NOW', 'Obtine acum');
define('BUY_NOW', 'Cumpara acum');
define('SELECT_REWARD', 'Selecteaza recompensa');
define('VIP_ACCOUNT', 'Cont VIP');
define('USER_NOT_EXISTS', 'Numele contului pe care l-ai introdus nu exista');
define('STATUS_UPDATED', 'Statusul tau a fost actualizat');

// profile
define('PREFERENCES', 'Preferinte');
define('VACATION', 'Vacanta');
define('ACTIVATE_VACATION', 'Vrei sa activezi Modul Vacanta');
define('GRAPH_PACK', 'Pachet grafic');
define('PLAYER_PROFILE', 'Profil jucator');
define('CHANGE_PASSWORD', 'Schimba parola');
define('OLD_PASSWORD', 'Parola veche');
define('NEW_PASSWORD', 'Parola noua');
define('CHANGE_EMAIL', 'Schimba emailul');
define('CHANGE_EMAIL2', 'Te rugam introdu vechea si noua ta adresa de email. Vei primi apoi un cod la ambele adrese de email pe care trebuie sa il introduci aici');
define('OLD_EMAIL', 'Email vechi');
define('NEW_EMAIL', 'Email nou');
define('ACCOUNT_SITTERS', 'Inlocuitori cont');
define('ACCOUNT_SITTERS2', 'Un inlocuitor se poate autentifica in contul tau folosind numele tau si parola lui. Poti avea pana la doi inlocuitori');
define('SITTER_NAME', 'Numele inlocuitorului');
define('NO_SITTERS', 'Nu ai inlocuitori');
define('RM_SITTER', 'Elimina inlocuitorul');
define('YOU_ARE_SITTER', 'Ai fost adaugat ca inlocuitor pe urmatoarele conturi. Poti anula asta apasand X-ul rosu');
define('DELETE_ACCOUNT', 'Sterge contul');
define('DELETE_ACCOUNT2', 'Iti poti sterge contul aici. Dupa inceperea anularii vor fi necesare trei zile pentru a finaliza anularea contului. Poti anula acest proces in primele 24 de ore');
define('YES', 'Da');
define('NO', 'Nu');
define('CONFIRM_W_PASS', 'Confirma cu parola');
define('MEDALS', 'Medalii');
define('PLAYER_HAS', 'Acest jucator are');
define('HOURS_OF_BG_PROT', 'ore de protectie a incepatorilor ramase');
define('PLAYER_WAS_REG_ON', 'Acest jucator si-a inregistrat contul pe');
define('NATARS_ACC', 'Cont oficial Natar');
define('WW_V_M', 'Sat oficial al Minunii Lumii');
define('ROMAN_T_M', 'Romanii : Datorita nivelului ridicat de dezvoltare sociala si tehnologica, romanii sunt maestri ai constructiei si coordonarii ei. De asemenea, trupele lor fac parte din elita din Travian. Sunt foarte echilibrate si utile in atac si aparare');
define('TEUTON_T_M', 'Teutonii : Teutonii sunt cel mai agresiv trib. Trupele lor sunt notorii si temute pentru furia si frenezia lor cand ataca. Se misca precum o hoarda jefuitoare, fara teama nici de moarte');
define('GAUL_T_M', 'Galii : Galii sunt cei mai pasnici dintre cele trei triburi din Travian. Trupele lor sunt antrenate pentru o aparare excelenta, dar capacitatea lor de atac poate inca concura cu celelalte doua triburi. Galii sunt calareti innascuti, iar caii lor sunt renumiti pentru viteza. Asta inseamna ca aceasta cavalerie poate lovi inamicul exact unde poate cauza cele mai mari pagube si se poate ocupa rapid de el');
define('ADMIN_M', 'Administrator oficial al serverului');
define('MH_M', 'Multihunter Global oficial al serverului');
define('MH_M2', 'Multihunter este o pozitie oficiala in Travian folosita in principal pentru aplicarea regulilor Travian intr-un server. Toti Multihunterii folosesc contul numit Multihunter cu singurul sau sat situat in (0|0). Un Multihunter nu poate juca pe serverul pe care este Multihunter, dar poate fi un jucator activ pe alte servere');
define('NATURE_M2', 'Trupele naturii sunt animalele care traiesc in oazele neocupate. Poti folosi simulatorul de lupta pentru a vedea daca ai destule trupe sa invingi animalele dintr-o oaza pe care vrei sa o cucceresti, dar aminteste-ti ca poti doar jefui oaze. Tine cont ca toate animalele de la Urs in sus pot ucide trupa Travian contemporana de nivel maxim intr-o lupta unu la unu');
define('TASKMASTER_M', 'Cont Maistru de sarcini');
define('VETERAN_P', 'Jucator veteran');
define('VETERAN_3_M', 'Medalie obtinuta pentru 3 ani de joc Travian');
define('VETERAN_5_M', 'Medalie obtinuta pentru 5 ani de joc Travian');
define('VETERAN_10_M', 'Medalie obtinuta pentru 10 ani de joc Travian');
define('ATT_W_M', 'Atacatorii saptamanii');
define('DEF_W_M', 'Aparatorii saptamanii');
define('POP_W_M', 'Cei mai crescuti in populatie ai saptamanii');
define('ROB_W_M', 'Jefuitorii saptamanii');
define('CLIMB_W_M', 'Cei mai urcati in rang ai saptamanii');
define('ATT_DEF_10_W_M', 'Primirea acestei medalii arata ca ai fost in top 10 atat la Atacatori cat si la Aparatori in saptamana respectiva');
define('ATT_3_W_M', 'Primirea acestei medalii arata ca ai fost in top 3 Atacatori ai saptamanii');
define('DEF_3_W_M', 'Primirea acestei medalii arata ca ai fost in top 3 Aparatori ai saptamanii');
define('POP_3_W_M', 'Primirea acestei medalii arata ca ai fost in top 3 la crestere de populatie ai saptamanii');
define('ROB_3_W_M', 'Primirea acestei medalii arata ca ai fost in top 3 Jefuitori ai saptamanii');
define('CLIMB_3_W_M', 'Primirea acestei medalii arata ca ai fost in top 3 la urcare in rang ai saptamanii');
define('ATT_10_W_M', 'Primirea acestei medalii arata ca ai fost in top 10 Atacatori ai saptamanii');
define('DEF_10_W_M', 'Primirea acestei medalii arata ca ai fost in top 10 Aparatori ai saptamanii');
define('POP_10_W_M', 'Primirea acestei medalii arata ca ai fost in top 10 la crestere de populatie ai saptamanii');
define('ROB_10_W_M', 'Primirea acestei medalii arata ca ai fost in top 10 Jefuitori ai saptamanii');
define('CLIMB_10_W_M', 'Primirea acestei medalii arata ca ai fost in top 10 la urcare in rang ai saptamanii');
define('RECEIVED_IN_W', 'Primit in saptamana');
define('POINTS_M', 'Puncte');
define('RANKS', 'Ranguri');
define('WEEK', 'Saptamana');
define('CATEGORY', 'Categorie');
define('RANK', 'Rang');
define('BB_CODE', 'BB-Code');
define('IN_ROW', 'la rand');
define('ADMIN1', 'Administrator');
define('MULTIH1', 'Multihunter');
define('PLAYER_ADMIN', 'Acest jucator este Admin');
define('PLAYER_MH', 'Acest jucator este Multihunter');
define('PLAYER_BANNED', 'Acest jucator este BANAT');
define('PLAYER_VACATION', 'Acest jucator este in VACANTA');
if(!defined('BANNED')) define('BANNED', 'Banat');
define('GENDER', 'Gen');
define('GENDER0', 'n/a');
define('MALE0', 'm');
define('MALE', 'Masculin');
define('FEMALE0', 'f');
define('FEMALE', 'Feminin');
define('LOCATION', 'Locatie');
define('DIRECT_LINKS', 'Linkuri directe');
define('NUMBER0', 'Nr');
define('LINK_NAME', 'Nume link');
define('LINK_TARGET', 'Tinta link');
define('AUTO_COMPL', 'Completare automata');
define('AUTO_COMPL2', 'Folosit pentru punctul de adunare si piata');
define('OWN_VILLAGES', 'propriile sate');
define('VILLAGES_NEAR', 'satele din imprejurimi');
define('VILLAGES_ALLI_PLAYERS', 'satele jucatorilor din alianta');
define('REPORT_FILTER', 'Filtru rapoarte');
define('NO_REPORTS_TO_OWN', 'Niciun raport pentru transferuri catre propriile sate');
define('NO_REPORTS_TO_OTH', 'Niciun raport pentru transferuri catre sate straine');
define('NO_REPORTS_FROM_OTH', 'Niciun raport pentru transferuri din sate straine');
define('CHANGE_PROFILE', 'Schimba profilul');
define('WRITE_MESSAGE', 'Scrie mesaj');
define('REPORT_PLAYER', 'Raporteaza jucatorul');
define('ARTEFACT1', 'Artefact');
define('WoW1', 'MdL');
define('VILLAGE_NAME', 'Numele satului');
define('BDAY', 'Zi de nastere');
define('CONDITIONS', 'Conditii');
define('TIME_PREF', 'Preferinte de timp');
define('TIME_ZONES_DESC', 'Aici poti schimba ora afisata in Travian pentru a se potrivi cu fusul tau orar');
define('TIME_ZONE_L1', 'Europa');
define('TIME_ZONE_L2', 'Marea Britanie');
define('TIME_ZONE_L3', 'Turcia');
define('TIME_ZONE_L4', 'Asia/Kolkata');
define('TIME_ZONE_L5', 'Asia/Bangkok');
define('TIME_ZONE_L6', 'SUA/New York');
define('TIME_ZONE_L7', 'SUA/Chicago');
define('TIME_ZONE_L8', 'Noua Zeelanda');
define('MONTH1', 'Ian');
define('MONTH2', 'Feb');
define('MONTH3', 'Mar');
define('MONTH4', 'Apr');
define('MONTH5', 'Mai');
define('MONTH6', 'Iun');
define('MONTH7', 'Iul');
define('MONTH8', 'Aug');
define('MONTH9', 'Sep');
define('MONTH10', 'Oct');
define('MONTH11', 'Noi');
define('MONTH12', 'Dec');

//artefact
define('ARCHITECTS_DESC', 'Toate cladirile din zona de efect sunt mai puternice. Asta inseamna ca vei avea nevoie de mai multe catapulte pentru a deteriora cladirile protejate de puterile acestui artefact.');
define('ARCHITECTS_SMALL', 'Secretul minor al arhitectilor');
define('ARCHITECTS_SMALLVILLAGE', 'Dalta de diamant');
define('ARCHITECTS_LARGE', 'Secretul mare al arhitectilor');
define('ARCHITECTS_LARGEVILLAGE', 'Ciocan urias de marmura');
define('ARCHITECTS_UNIQUE', 'Secretul unic al arhitectilor');
define('ARCHITECTS_UNIQUEVILLAGE', 'Suluri ale lui Hemon');
define('HASTE_DESC', 'Toate trupele din zona de efect se misca mai repede.');
define('HASTE_SMALL', 'Cizmele titanului minore');
define('HASTE_SMALLVILLAGE', 'Potcoava de opal');
define('HASTE_LARGE', 'Cizmele titanului mari');
define('HASTE_LARGEVILLAGE', 'Car de aur');
define('HASTE_UNIQUE', 'Cizmele titanului unice');
define('HASTE_UNIQUEVILLAGE', 'Sandalele lui Pheidippides');
define('EYESIGHT_DESC', 'Toti spionii (Cercetasi, Cercetasi gali si Equites Legati) isi cresc abilitatea de spionaj. In plus, cu toate versiunile acestui artefact poti vedea TIPUL trupelor care vin, dar nu si cate sunt.');
define('EYESIGHT_SMALL', 'Ochii vulturului minori');
define('EYESIGHT_SMALLVILLAGE', 'Povestea unui sobolan');
define('EYESIGHT_LARGE', 'Ochii vulturului mari');
define('EYESIGHT_LARGEVILLAGE', 'Scrisoarea generalului');
define('EYESIGHT_UNIQUE', 'Ochii vulturului unici');
define('EYESIGHT_UNIQUEVILLAGE', 'Jurnalul lui Sun Tzu');
define('DIET_DESC', 'Toate trupele din raza artefactului consuma mai putin grau, facand posibila intretinerea unei armate mai mari.');
define('DIET_SMALL', 'Control minor al dietei');
define('DIET_SMALLVILLAGE', 'Platou de argint');
define('DIET_LARGE', 'Control mare al dietei');
define('DIET_LARGEVILLAGE', 'Arc sacru de vanatoare');
define('DIET_UNIQUE', 'Control unic al dietei');
define('DIET_UNIQUEVILLAGE', 'Potirul Regelui Arthur');
define('ACADEMIC_DESC', 'Trupele sunt construite cu un anumit procent mai repede in raza de actiune a artefactului.');
define('ACADEMIC_SMALL', 'Talentul minor al instructorilor');
define('ACADEMIC_SMALLVILLAGE', 'Juramantul scris al soldatilor');
define('ACADEMIC_LARGE', 'Talentul mare al instructorilor');
define('ACADEMIC_LARGEVILLAGE', 'Declaratie de razboi');
define('ACADEMIC_UNIQUE', 'Talentul unic al instructorilor');
define('ACADEMIC_UNIQUEVILLAGE', 'Memoriile lui Alexandru cel Mare');
define('STORAGE_DESC', 'Cu acest plan de constructie poti construi Hambarul Mare sau Depozitul Mare in satul cu artefactul, sau in tot contul in functie de artefact. Cat timp detii acel artefact poti construi si extinde acele cladiri.');
define('STORAGE_SMALL', 'Plan minor de depozitare');
define('STORAGE_SMALLVILLAGE', 'Schita constructorilor');
define('STORAGE_LARGE', 'Plan mare de depozitare');
define('STORAGE_LARGEVILLAGE', 'Tablita babiloniana');
define('CONFUSION_DESC', 'Capacitatea ascunzatorii este crescuta cu o anumita cantitate pentru fiecare tip de artefact. Catapultele pot lovi doar aleator satele aflate sub puterea acestui artefact. Exceptiile sunt MdL care poate fi mereu tintita si camera comorii care poate fi mereu tintita, cu exceptia artefactului unic. Cand tintesti un camp de resurse pot fi lovite doar campuri aleatoare, cand tintesti o cladire pot fi lovite doar cladiri aleatoare.');
define('CONFUSION_SMALL', 'Confuzia minora a rivalilor');
define('CONFUSION_SMALLVILLAGE', 'Harta pesterilor ascunse');
define('CONFUSION_LARGE', 'Confuzia mare a rivalilor');
define('CONFUSION_LARGEVILLAGE', 'Sac fara fund');
define('CONFUSION_UNIQUE', 'Confuzia unica a rivalilor');
define('CONFUSION_UNIQUEVILLAGE', 'Calul Troian');
define('FOOL_DESC', 'La fiecare 24 de ore primeste un efect aleator, bonus sau penalizare (toate sunt posibile cu exceptia planurilor de depozit mare, hambar mare si MdL). Isi schimba efectul SI raza la fiecare 24 de ore. Artefactul unic va lua mereu bonusuri pozitive.');
define('FOOL_SMALL', 'Artefactul nebunului minor');
define('FOOL_SMALLVILLAGE', 'Pandantivul ravaselii');
define('FOOL_UNIQUE', 'Artefactul nebunului unic');
define('FOOL_UNIQUEVILLAGE', 'Manuscris interzis');
define('WWVILLAGE', 'sat MdL');
define('ARTEFACT', '<h1><b>Artefactele Natarilor</b></h1>

Zvonuri soptite rasuna prin sate, impartasind legende spuse doar de cei mai buni povestitori. Se refera la NATARI, cei mai temuti razboinici ai lumii TRAVIAN. Uciderea lor este visul oricarui erou, scopul oricarui luptator. Nimeni nu stie cum au ajuns NATARII sa obtina o asemenea putere si razboinicii lor sa fie atat de cruzi. Hotarati sa descopere sursa puterii NATARILOR, luptatorii trimit un grup de spioni de elita sa ii spioneze. Nu trec multe ore si se intorc cu frica in ochi, echilibrand teorii fantastice: se pare ca puterea vine din obiectele misterioase pe care ei le numesc artefacte, pe care le-au furat de la stramosii nostri. Incearca sa ii furi artefactele si vei putea controla puterea lor.

<img src="/img/x.gif" class="ArtefactsAnnouncement">

A sosit timpul pentru revendicarea artefactelor. Colaboreaza cu alianta ta si adu-ti razboinicii pentru a obtine aceste obiecte dorite. Totusi, NATARII nu vor renunta fara razboi la artefacte... nici dusmanii tai. Daca reusesti sa recuperezi artefactele si vei putea respinge dusmanii, vei putea colecta recompensele. Cladirile tale vor deveni incredibil de puternice si trupele vor fi mult mai rapide si vor consuma mai putina hrana. Captureaza artefactele, adu glorie imperiului tau si devino o noua legenda pentru sustinatorii tai.

Pentru a fura unul, urmatoarele lucruri trebuie sa se intample:

1. Trebuie sa ataci satul (NU Raid!)
2. CASTIGA atacul
3. Distruge trezoreria
4. O trezorerie goala de nivel 10 pentru ARTEFACTE MICI si nivel 20 pentru ARTEFACT MARE trebuie sa fie in satul de unde a venit atacul
5. Sa ai un erou in atac

Daca nu, urmatorul atac asupra acelui sat, castigat cu un erou si trezorerie goala, va lua artefactul.

Pentru a construi o MdL, trebuie sa detii tu insuti un plan (tu = proprietarul satului MdL) de la nivelul 0 la 50, de la 51 la 100 ai nevoie de un plan suplimentar in alianta ta! Doua planuri in contul satului MdL nu ar functiona!

Planurile de constructie pot fi cucerite imediat cand apar pe server.

Va fi un cronometru in joc, aratand ora exacta a lansarii, cu 5 zile inainte de lansare. ');

//WW Village Release Message
define('WWVILLAGEMSG', '<h1><b>Satele Minunii Lumii</b></h1>

Nenumarate zile au trecut de la primele batalii de pe zidurile satelor blestemate ale Natarilor Cumpliti, multe armate atat ale celor liberi cat si ale imperiului Natarian s-au luptat si au murit in fata zidurilor numeroaselor fortarete din care Natarii conduceau candva toata creatia. Acum, cu praful asezat si o liniste relativa instaurata, armatele au inceput sa isi numere pierderile si sa isi adune mortii, mirosul luptei staruind inca in aerul noptii, un miros al unui macel de neuitat prin amploarea si brutalitatea sa, dar care urma sa fie curand depasit de altele. Cele mai mari armate ale celor liberi si ale Natarilor Cumpliti se adunau pentru un nou asalt asupra fostelor fortarete ravnite ale Imperiului Natarian.
In curand au sosit cercetasi povestind despre o priveliste uluitoare si o amintire infioratoare, o armata cumplita de o marime de nepatruns fusese zarita adunandu-se la capatul lumii, capitala Natariana, o forta atat de mare si de neoprit incat praful marsului lor ar inabusi toata lumina, o forta atat de brutala si nemiloasa incat ar zdrobi orice speranta. Oamenii liberi stiau ca trebuie sa se grabeasca acum, sa se intreaca cu timpul si cu hoardele nesfarsite ale Imperiului Natarian pentru a ridica o Minune a Lumii care sa readuca pacea in lume si sa invinga amenintarea Natariana.
Dar a ridica o Minune atat de mare nu ar fi o sarcina usoara, ar fi nevoie de planuri de constructie create in trecutul indepartat, planuri de o natura atat de tainica incat nici cei mai intelepti dintre intelepti nu le cunosteau continutul sau locatiile.
Zeci de mii de cercetasi au cutreierat toata existenta cautand in zadar aceste planuri mistice, privind in toate locurile in afara de cumplita Capitala Natariana, dar nu le-au putut gasi. Astazi insa, se intorc aducand vesti bune, se intorc aducand locatiile planurilor, ascunse de armatele Natarilor in fortarete secrete construite sa fie ascunse de ochii oamenilor.
Acum incepe ultima etapa, cand cele mai mari armate ale Oamenilor Liberi si ale Natarilor se vor ciocni in toata lumea pentru soarta a tot ce se afla sub cer. Acesta este razboiul care va rasuna peste veacuri, acesta este razboiul tau, si aici iti vei grava numele in istorie, aici vei deveni legenda.

<img src="/img/x.gif" class="WWVillagesAnnouncement" title="'.WWVILLAGE.'" alt="'.WWVILLAGE.'">

Pentru a cuceri unul, urmatoarele lucruri trebuie sa se intample:

1. Trebuie sa ataci satul (NU Raid!)
2. CASTIGA atacul
3. Distruge RESEDINTA
4. Trebuie sa scazi loialitatea la 0 cu : SENATORI , CAPETENIE , CAPETENIE DE TRIB
5. Trebuie sa ai destule puncte de cultura pentru a cuceri satul

Daca nu, urmatorul atac asupra acelui sat, castigat cu un SENATOR , CAPETENIE , CAPETENIE DE TRIB si sloturi libere in RESEDINTA/PALAT, va lua satul.

Pentru a construi o MdL, trebuie sa detii tu insuti un plan (tu = proprietarul satului MdL) de la nivelul 0 la 50, de la 51 la 100 ai nevoie de un plan suplimentar in alianta ta! Doua planuri in contul satului MdL nu ar functiona!

Planurile de constructie pot fi cucerite imediat cand apar pe server.

Va fi un cronometru in joc, aratand ora exacta a lansarii, cu '.(5 / SPEED).' zile inainte de lansare.');

//Building Plans
define('WILL_SPAWN_IN', 'va aparea in');
define('PLAN', 'Plan de Constructie Antic');
define('PLANVILLAGE', 'Plan de constructie MdL');
define('PLAN_DESC', 'Cu acest plan de constructie antic vei putea construi Minunea Lumii pana la nivelul 50. Pentru a construi mai departe, alianta ta trebuie sa detina cel putin doua planuri.');
define('PLAN_INFO', '<h1><b>Planuri de constructie ale Minunii Lumii</b></h1>


Cu multe luni in urma, triburile din Travian au fost surprinse de intoarcerea neprevazuta a Natarilor. Acest trib din timpuri imemoriale, depasindu-i pe toti in intelepciune, putere si glorie, era pe cale sa tulbure din nou pe cei liberi. Astfel si-au pus toate eforturile in pregatirea unui ultim razboi impotriva Natarilor si in invingerea lor pentru totdeauna. Multi s-au gandit la asa-numitele "Minuni ale Lumii", o constructie a multor legende, drept singura solutie. Se spunea ca ar face pe oricine invincibil odata terminata. In cele din urma, facandu-i pe constructori conducatorii si cuceritorii intregului Travian cunoscut.

Totusi, se spunea de asemenea ca ar fi nevoie de planuri de constructie pentru a construi o astfel de cladire. Din acest motiv, arhitectii au conceput planuri viclene despre cum sa le pastreze in siguranta. Dupa o vreme, se puteau vedea cladiri in forma de temple in multe orase si metropole - Camerele Comorii (Trezoreriile).

Din pacate, nimeni - nici macar cei intelepti si priceputi - nu stia unde sa gaseasca aceste planuri de constructie. Cu cat oamenii incercau mai mult sa le localizeze, cu atat parea ca sunt doar legende.

Astazi insa, acest ultim secret va fi dezvaluit. Privatiunile si stradaniile trecutului nu vor fi fost in zadar, caci astazi cercetasii mai multor triburi au obtinut cu succes locatiile planurilor de constructie. Bine pazite de Natari, ele zac ascunse in mai multe oaze raspandite in tot Travianul. Doar cei mai viteji eroi vor putea asigura un astfel de plan si il vor aduce acasa in siguranta pentru ca constructia sa poata incepe.

In final, vom vedea daca triburile libere din Travian pot inca o data sa ii pacaleasca pe Natari si sa ii invinga o data pentru totdeauna. Nu fi atat de nesabuit incat sa presupui ca Natarii vor pleca fara lupta, totusi!

<img src="/img/x.gif" class="WWBuildingPlansAnnouncement" title="'.PLAN.'" alt="'.PLAN.'">

Pentru a fura un set de Planuri de Constructie de la Natari, urmatoarele lucruri trebuie sa se intample:
- Trebuie sa Ataci satul (NU Raid!)
- Trebuie sa CASTIGI atacul
- Trebuie sa DISTRUGI Camera Comorii (Trezoreria)
- Eroul tau TREBUIE sa fie in acel atac, deoarece el este singurul care poate purta Planurile de Constructie
- O Camera a Comorii (Trezorerie) goala de nivel 10 TREBUIE sa fie in satul de unde a venit atacul
NOTA: Daca criteriile de mai sus nu sunt indeplinite in timpul atacului, urmatorul atac asupra acelui sat care le indeplineste va lua Planurile de Constructie.



Pentru a construi o Camera a Comorii (Trezorerie), vei avea nevoie de o Cladire Principala de nivel 10 si satul NU TREBUIE sa contina o Minune a Lumii.

Pentru a construi o Minune a Lumii, trebuie sa detii tu insuti Planurile de Constructie (tu = Proprietarul Satului Minunii Lumii) de la nivelul 0 la 50, iar apoi de la nivelul 51 la 100 vei avea nevoie de un set suplimentar de Planuri de Constructie in Alianta ta! Doua seturi de Planuri de Constructie in Contul Satului Minunii Lumii nu vor functiona!');
//Admin setting - Admin/Templates/config.tpl & editServerSet.tpl
define('EDIT_BACK', 'Inapoi');
define('SERV_CONFIG', 'Configurare server');
define('SERV_SETT', 'Setari server');
define('EDIT_SERV_SETT', 'Editeaza setarile serverului');
define('SERV_VARIABLE', 'Variabila');
define('SERV_VALUE', 'Valoare');
define('CONF_SERV_NAME', 'Numele serverului');
define('CONF_SERV_NAME_TOOLTIP', 'Numele serverului de joc.');
define('CONF_SERV_STARTED', 'Server pornit');
define('CONF_SERV_STARTED_TOOLTIP', 'Momentul cand serverul de joc a fost pornit. Acest parametru nu poate fi schimbat pe serverul de joc instalat.');
define('CONF_SERV_TIMEZONE', 'Fus orar server');
define('CONF_SERV_TIMEZONE_TOOLTIP', 'Fusul orar al serverului de joc.');
define('CONF_SERV_LANG', 'Limba');
define('CONF_SERV_LANG_TOOLTIP', 'Limba folosita in panoul de admin si pentru toata lumea de pe serverul de joc in mod implicit.');
define('CONF_SERV_SERVSPEED', 'Viteza server');
define('CONF_SERV_SERVSPEED_TOOLTIP', 'Viteza serverului de joc. Cu cat viteza este mai mare, cu atat toate cladirile sunt construite mai repede, studiile si imbunatatirile in fierarii sunt facute mai repede, trupele sunt construite rapid si productivitatea tuturor resurselor este crescuta.');
define('CONF_SERV_TROOPSPEED', 'Viteza trupe');
define('CONF_SERV_TROOPSPEED_TOOLTIP', 'Viteza de miscare a trupelor pe serverul de joc. Cu cat acest indicator este mai mare, cu atat trupele se misca mai repede pe harta.');
define('CONF_SERV_EVASIONSPEED', 'Viteza de evaziune');
define('CONF_SERV_EVASIONSPEED_TOOLTIP', 'Viteza de evaziune este timpul pe care trupele il petrec pe drum pentru a se intoarce acasa dupa evitarea unui atac.');
define('CONF_SERV_STORMULTIPLER', 'Multiplicator stocare');
define('CONF_SERV_STORMULTIPLER_TOOLTIP', 'Un multiplicator pentru capacitatea de stocare a depozitului si hambarului. Valoarea 1 este egala cu capacitatea de 80.000 din fiecare resursa la nivelul maxim. Daca setezi valoarea la 2, atunci capacitatea la nivelul maxim va fi 160.000 din fiecare resursa.<br><b>Nota:</b> cantitatea de resurse generata de oazele neocupate pentru jaf depinde de aceasta valoare. Implicit este 800. Daca setezi valoarea la 2, numarul maxim pentru fiecare resursa generata este 1600.');
define('CONF_SERV_TRADCAPACITY', 'Capacitate negustor');
define('CONF_SERV_TRADCAPACITY_TOOLTIP', 'Un multiplicator pentru capacitatea de resurse care poate fi transportata de un negustor. Valoarea 1 este egala cu 500 capacitate pentru Romani, 750 pentru Gali, 1000 pentru Teutoni. Daca setezi valoarea la 2, atunci capacitatea resurselor transferate se va dubla corespunzator, 1000, 1500, 2000.');
define('CONF_SERV_CRANCAPACITY', 'Capacitate ascunzatoare');
define('CONF_SERV_CRANCAPACITY_TOOLTIP', 'Un multiplicator pentru capacitatea de resurse din Ascunzatoare, care poate fi salvata de la jaf. Valoarea 1 este egala cu 1000 pentru Romani si Teutoni, 2000 pentru Gali. Daca setezi valoarea la 2, atunci capacitatea Ascunzatorii se va dubla la 2000 si respectiv 4000.');
define('CONF_SERV_TRAPCAPACITY', 'Capacitate capcanier');
define('CONF_SERV_TRAPCAPACITY_TOOLTIP', 'Un multiplicator pentru capacitatea capcanei Galilor, care poate captura soldati inamici chiar inainte de atacarea satului. Valoarea 1 este egala cu capacitatea de 400 la nivelul 20 de constructie. Daca setezi valoarea la 2, atunci capacitatea va fi 800.');
define('CONF_SERV_NATUNITSMULTIPLIER', 'Multiplicator unitati Natari');
define('CONF_SERV_NATUNITSMULTIPLIER_TOOLTIP', 'Acest parametru este responsabil de numarul de trupe ale Natarilor, pe artefacte si satele MdL.');
define('CONF_SERV_NATARS_SPAWN_TIME', 'Aparitie Natari');
define('CONF_SERV_NATARS_SPAWN_TIME_TOOLTIP', 'Dupa cat timp vor aparea Natarii si artefactele de la data de start a serverului, in zile');
define('CONF_SERV_NATARS_WW_SPAWN_TIME', 'Aparitie Minuni ale Lumii');
define('CONF_SERV_NATARS_WW_SPAWN_TIME_TOOLTIP', 'Dupa cat timp vor aparea satele MdL de la data de start a serverului, in zile');
define('CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME', 'Aparitie planuri de constructie MdL');
define('CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME_TOOLTIP', 'Dupa cat timp vor aparea planurile de constructie MdL de la data de start a serverului, in zile');
define('CONF_SERV_MAPSIZE', 'Marime harta');
define('CONF_SERV_MAPSIZE_TOOLTIP', 'Marimea hartii lumii de joc. Nu poate fi schimbata pe un server de joc deja instalat.');
define('CONF_SERV_VILLEXPSPEED', 'Viteza de extindere a satelor');
define('CONF_SERV_VILLEXPSPEED_TOOLTIP', 'Viteza care afecteaza extinderea imperiului. Cu o viteza mica sunt necesare mai multe puncte de cultura pentru a fonda sate noi, cu o viteza mare numarul necesar de puncte de cultura este redus.');
define('CONF_SERV_BEGINPROTECT', 'Protectia incepatorilor');
define('CONF_SERV_BEGINPROTECT_TOOLTIP', 'Protectie care interzice un anumit timp atacarea satelor jucatorilor noi.');
define('CONF_SERV_REGOPEN', 'Inregistrare deschisa');
define('CONF_SERV_REGOPEN_TOOLTIP', 'Permite activarea (True) sau dezactivarea (False) inregistrarii jucatorilor pe serverul de joc.');
define('CONF_SERV_ACTIVMAIL', 'Email de activare');
define('CONF_SERV_ACTIVMAIL_TOOLTIP', 'Daca este activat (Yes), in timpul inregistrarii va fi necesara confirmarea adresei de email. Daca este dezactivat (No) nu necesita confirmarea emailului.');
define('CONF_SERV_QUEST', 'Sarcini');
define('CONF_SERV_QUEST_TOOLTIP', 'Activeaza (Yes) sau dezactiveaza (No) sarcinile pe serverul de joc.');
define('CONF_SERV_QTYPE', 'Tip sarcini');
define('CONF_SERV_QTYPE_TOOLTIP', 'Tipul sarcinilor poate fi oficial care este putin mai scurt, si extins care este mai lung.');
define('CONF_SERV_DLR', 'Demolare - Nivel necesar');
define('CONF_SERV_DLR_TOOLTIP', 'Nivelul necesar al cladirii principale, la care se poate efectua demolarea cladirilor din sat.');
define('CONF_SERV_WWSTATS', 'Minunea Lumii - Statistici');
define('CONF_SERV_WWSTATS_TOOLTIP', 'Activeaza (True) sau dezactiveaza (False) afisarea in statistici a satelor cu o Minune a Lumii.');
define('CONF_SERV_NTRTIME', 'Timp de regenerare a trupelor naturii');
define('CONF_SERV_NTRTIME_TOOLTIP', 'Timpul dupa care trupele naturii vor fi restaurate in oaze.');
define('CONF_SERV_OASIS_WOOD_PROD_MULT', 'Multiplicator productie lemn oaza');
define('CONF_SERV_OASIS_WOOD_PROD_MULT_TOOLTIP', 'Productia de baza de lemn a oazei');
define('CONF_SERV_OASIS_CLAY_PROD_MULT', 'Multiplicator productie lut oaza');
define('CONF_SERV_OASIS_CLAY_PROD_MULT_TOOLTIP', 'Productia de baza de lut a oazei');
define('CONF_SERV_OASIS_IRON_PROD_MULT', 'Multiplicator productie fier oaza');
define('CONF_SERV_OASIS_IRON_PROD_MULT_TOOLTIP', 'Productia de baza de fier a oazei');
define('CONF_SERV_OASIS_CROP_PROD_MULT', 'Multiplicator productie cereale oaza');
define('CONF_SERV_OASIS_CROP_PROD_MULT_TOOLTIP', 'Productia de baza de cereale a oazei');
define('CONF_SERV_MEDALINTERVAL', 'Interval medalii');
define('CONF_SERV_MEDALINTERVAL_TOOLTIP', 'Intervalul de timp pentru acordarea medaliilor celor mai buni jucatori si aliante. Daca acest parametru este schimbat pe serverul instalat, intervalul de timp se schimba dupa acordarea ulterioara a medaliilor.');
define('CONF_SERV_TOURNTHRES', 'Prag turnir');
define('CONF_SERV_TOURNTHRES_TOOLTIP', 'Numarul de patrate de pe harta jocului, dupa care Piata turnirului va incepe sa functioneze.');
define('CONF_SERV_GWORKSHOP', 'Atelier mare');
define('CONF_SERV_GWORKSHOP_TOOLTIP', 'Activeaza (True) sau dezactiveaza (False) folosirea unui Atelier mare in joc.');
define('CONF_SERV_NATARSTAT', 'Arata Natarii in statistici');
define('CONF_SERV_NATARSTAT_TOOLTIP', 'Activeaza (True) sau dezactiveaza (False) afisarea contului Natarilor in statistici.');
define('CONF_SERV_PEACESYST', 'Sistem de pace');
define('CONF_SERV_PEACESYST_TOOLTIP', 'Activeaza sau dezactiveaza sistemul de pace. Cand sistemul de pace este activat, jucatorii se vor putea ataca, dar in loc de orice actiuni in rapoarte va aparea o inscriptie de felicitare. Trupele nu vor muri de foame.');
define('CONF_SERV_GRAPHICPACK', 'Pachet grafic');
define('CONF_SERV_GRAPHICPACK_TOOLTIP', 'Activeaza (Yes) sau dezactiveaza (No) posibilitatea de a folosi pachetul grafic.');
define('CONF_SERV_ERRORREPORT', 'Raportare erori');
define('CONF_SERV_ERRORREPORT_TOOLTIP', 'Activeaza (Yes) sau dezactiveaza (No) afisarea rapoartelor de erori pe serverul de joc.');

//Admin setting - Admin/Templates/config.tpl & editPlusSet.tpl
define('PLUS_LOGO', '<b><font color="#71D000">P</font><font color="#FF6F0F">l</font><font color="#71D000">u</font><font color="#FF6F0F">s</font></b>');
define('PLUS_CONFIGURATION', PLUS_LOGO.' Configurare');
define('PLUS_SETT', PLUS_LOGO.' Setari');
define('EDIT_PLUS_SETT', 'Editeaza setarile '.PLUS_LOGO);
define('EDIT_PLUS_SETT1', 'Editeaza setarile PLUS');
define('CONF_PLUS_PAYPALEMAIL', 'Adresa de e-mail <a href="https://www.paypal.com" target="_blank">PayPal</a>');
define('CONF_PLUS_PAYPALEMAIL_TOOLTIP', 'Adresa de e-mail specificata la inregistrarea pe PayPal.<br><font color="red"><b>Trebuie sa fie cont Business sau Premier!</b></font>');
define('CONF_PLUS_CURRENCY', 'Moneda de plata');
define('CONF_PLUS_CURRENCY_TOOLTIP', 'Moneda folosita pentru plata.');
define('CONF_PLUS_PACKAGEGOLDA', 'Pachet &#34;A&#34; Cantitate de Aur');
define('CONF_PLUS_PACKAGEGOLDA_TOOLTIP', 'Cantitatea de aur acordata pentru plata pachetului &#34;A&#34;.');
define('CONF_PLUS_PACKAGEPRICEA', 'Pachet &#34;A&#34; Pret');
define('CONF_PLUS_PACKAGEPRICEA_TOOLTIP', 'Suma necesara pentru a plati costul pachetului &#34;A&#34;.');
define('CONF_PLUS_PACKAGEGOLDB', 'Pachet &#34;B&#34; Cantitate de Aur');
define('CONF_PLUS_PACKAGEGOLDB_TOOLTIP', 'Cantitatea de aur acordata pentru plata pachetului &#34;B&#34;.');
define('CONF_PLUS_PACKAGEPRICEB', 'Pachet &#34;B&#34; Pret');
define('CONF_PLUS_PACKAGEPRICEB_TOOLTIP', 'Suma necesara pentru a plati costul pachetului &#34;B&#34;.');
define('CONF_PLUS_PACKAGEGOLDC', 'Pachet &#34;C&#34; Cantitate de Aur');
define('CONF_PLUS_PACKAGEGOLDC_TOOLTIP', 'Cantitatea de aur acordata pentru plata pachetului &#34;C&#34;.');
define('CONF_PLUS_PACKAGEPRICEC', 'Pachet &#34;C&#34; Pret');
define('CONF_PLUS_PACKAGEPRICEC_TOOLTIP', 'Suma necesara pentru a plati costul pachetului &#34;C&#34;.');
define('CONF_PLUS_PACKAGEGOLDD', 'Pachet &#34;D&#34; Cantitate de Aur');
define('CONF_PLUS_PACKAGEGOLDD_TOOLTIP', 'Cantitatea de aur acordata pentru plata pachetului &#34;D&#34;.');
define('CONF_PLUS_PACKAGEPRICED', 'Pachet &#34;D&#34; Pret');
define('CONF_PLUS_PACKAGEPRICED_TOOLTIP', 'Suma necesara pentru a plati costul pachetului &#34;D&#34;.');
define('CONF_PLUS_PACKAGEGOLDE', 'Pachet &#34;E&#34; Cantitate de Aur');
define('CONF_PLUS_PACKAGEGOLDE_TOOLTIP', 'Cantitatea de aur acordata pentru plata pachetului &#34;E&#34;.');
define('CONF_PLUS_PACKAGEPRICEE', 'Pachet &#34;E&#34; Pret');
define('CONF_PLUS_PACKAGEPRICEE_TOOLTIP', 'Suma necesara pentru a plati costul pachetului &#34;E&#34;.');
define('CONF_PLUS_ACCDURATION', PLUS_LOGO.' durata cont');
define('CONF_PLUS_ACCDURATION_TOOLTIP', 'Durata functiei de joc '.PLUS_LOGO.' pentru cont la momentul activarii de catre jucator.');
define('CONF_PLUS_PRODUCTDURATION', '+25% durata productie');
define('CONF_PLUS_PRODUCTDURATION_TOOLTIP', 'Durata functiei de joc +25% durata productie pentru cont la momentul activarii de catre jucator.');

//Admin setting - Admin/Templates/config.tpl & editLogSet.tpl
define('LOG_SETT', 'Setari jurnale');
define('EDIT_LOG_SETT', 'Editeaza setarile jurnalelor');
define('CONF_LOG_BUILD', 'Jurnal constructii');
define('CONF_LOG_BUILD_TOOLTIP', 'Activeaza (Yes) sau dezactiveaza (No) afisarea jurnalelor pentru constructia cladirilor in sat.');
define('CONF_LOG_TECHNOLOGY', 'Jurnal tehnologie');
define('CONF_LOG_TECHNOLOGY_TOOLTIP', 'Activeaza (Yes) sau dezactiveaza (No) afisarea jurnalelor pentru imbunatatirea trupelor in Fierarie si Armurarie.');
define('CONF_LOG_LOGIN', 'Jurnal autentificare');
define('CONF_LOG_LOGIN_TOOLTIP', 'Activeaza (Yes) sau dezactiveaza (No) afisarea jurnalelor de autentificare ale jucatorilor in joc.');
define('CONF_LOG_GOLD', 'Jurnal aur');
define('CONF_LOG_GOLD_TOOLTIP', 'Activeaza (Yes) sau dezactiveaza (No) afisarea jurnalelor de folosire a aurului in joc de catre jucatori.');
define('CONF_LOG_ADMIN', 'Jurnal admin');
define('CONF_LOG_ADMIN_TOOLTIP', 'Activeaza (Yes) sau dezactiveaza (No) afisarea jurnalelor pentru actiunile administratorului in panoul de control.');
define('CONF_LOG_WAR', 'Jurnal razboi');
define('CONF_LOG_WAR_TOOLTIP', 'Activeaza (Yes) sau dezactiveaza (No) afisarea jurnalelor de atacuri asupra jucatorilor in joc.');
define('CONF_LOG_MARKET', 'Jurnal piata');
define('CONF_LOG_MARKET_TOOLTIP', 'Activeaza (Yes) sau dezactiveaza (No) afisarea jurnalelor de folosire a pietei in joc de catre jucatori.');
define('CONF_LOG_ILLEGAL', 'Jurnal ilegal');
define('CONF_LOG_ILLEGAL_TOOLTIP', 'Activeaza (Yes) sau dezactiveaza (No) afisarea jurnalelor ilegale. (Nu stiu exact ce este)');

//Admin setting - Admin/Templates/config.tpl & editNewsboxSet.tpl
define('NEWSBOX_SETT', 'Setari Newsbox');
define('EDIT_NEWSBOX_SETT', 'Editeaza setarile Newsbox');
define('EDIT_NEWSBOX1', 'Newsbox 1');
define('EDIT_NEWSBOX1_TOOLTIP', 'Activeaza sau dezactiveaza afisarea Newsbox 1. Afisat pe pagina de autentificare si pe paginile de joc.');
define('EDIT_NEWSBOX2', 'Newsbox 2');
define('EDIT_NEWSBOX2_TOOLTIP', 'Activeaza sau dezactiveaza afisarea Newsbox 2. Afisat pe pagina de autentificare si pe paginile de joc.');
define('EDIT_NEWSBOX3', 'Newsbox 3');
define('EDIT_NEWSBOX3_TOOLTIP', 'Activeaza sau dezactiveaza afisarea Newsbox 3. Afisat pe pagina de autentificare si pe paginile de joc.');

//Admin setting - Admin/Templates/config.tpl SQL Settings
define('SQL_SETTINGS', 'Setari SQL');
define('CONF_SQL_HOSTNAME', 'Hostname');
define('CONF_SQL_HOSTNAME_TOOLTIP', 'Numele serverului unde este pornit MySQL (implicit este: localhost).');
define('CONF_SQL_PORT', 'Port');
define('CONF_SQL_PORT_TOOLTIP', 'Portul MySQL pentru conexiune la distanta. Portul standard pentru conectare este: 3306.');
define('CONF_SQL_DBUSER', 'Utilizator BD');
define('CONF_SQL_DBUSER_TOOLTIP', 'Numele de utilizator pentru conectarea la baza de date.');
define('CONF_SQL_DBPASS', 'Parola BD');
define('CONF_SQL_DBPASS_TOOLTIP', 'Parola utilizatorului pentru conectarea la baza de date.');
define('CONF_SQL_DBNAME', 'Nume BD');
define('CONF_SQL_DBNAME_TOOLTIP', 'Numele bazei de date la care te conectezi.');
define('CONF_SQL_TBPREFIX', 'Prefix tabele');
define('CONF_SQL_TBPREFIX_TOOLTIP', 'Prefixul folosit pentru tabelele bazei de date.');
define('CONF_SQL_DBTYPE', 'Tip BD');
define('CONF_SQL_DBTYPE_TOOLTIP', 'Tipul bazei de date folosite.');

//Admin setting - Admin/Templates/config.tpl & editExtraSet.tpl
define('EXTRA_SETT', 'Setari suplimentare');
define('EDIT_EXTRA_SETT', 'Editeaza setarile suplimentare');
define('CONF_EXTRA_LIMITMAIL', 'Limita casuta postala');
define('CONF_EXTRA_LIMITMAIL_TOOLTIP', 'Activeaza (Yes) sau dezactiveaza (No) limita casutei postale.');
define('CONF_EXTRA_MAXMAIL', 'Numar maxim de mesaje');
define('CONF_EXTRA_MAXMAIL_TOOLTIP', 'Numarul maxim de mesaje care incap in casuta postala.');

//Admin setting - Admin/Templates/config.tpl & editAdminInfo.tpl
define('ADMIN_INFO', 'Informatii admin');
define('EDIT_ADMIN_INFO', 'Editeaza informatiile admin');
define('CONF_ADMIN_NAME', 'Nume admin');
define('CONF_ADMIN_NAME_TOOLTIP', 'Numele pentru contul de administrator.');
define('CONF_ADMIN_EMAIL', 'E-Mail admin');
define('CONF_ADMIN_EMAIL_TOOLTIP', 'Adresa de email pentru contul de administrator.');
define('CONF_ADMIN_SHOWSTATS', 'Include adminul in statistici');
define('CONF_ADMIN_SHOWSTATS_TOOLTIP', 'Activeaza (True) sau dezactiveaza (False) afisarea contului de administrator in statisticile generale ale jucatorilor.');
define('CONF_ADMIN_SUPPMESS', 'Include mesajele de suport');
define('CONF_ADMIN_SUPPMESS_TOOLTIP', 'Activeaza (True) sau dezactiveaza (False) trimiterea mesajelor catre casuta postala a administratorului adresate Suportului.');
define('CONF_ADMIN_RAIDATT', 'Permite jefuirea si atacarea');
define('CONF_ADMIN_RAIDATT_TOOLTIP', 'Activeaza (True) sau dezactiveaza (False) posibilitatea de a jefui si ataca un administrator.');

/*
|--------------------------------------------------------------------------
|   Index
|--------------------------------------------------------------------------
*/

$lang['index'][0][1] = 'Bun venit la '.SERVER_NAME;
$lang['index'][0][2] = 'Manual';
$lang['index'][0][3] = 'Joaca acum, gratuit!';
$lang['index'][0][4] = 'Ce este '.SERVER_NAME;
$lang['index'][0][5] = SERVER_NAME.' este un <b>joc de browser</b> care prezinta o lume antica captivanta cu mii de alti jucatori reali.</p><p>Este <strong>gratuit de jucat</strong> si nu necesita <strong>niciun download</strong>.';
$lang['index'][0][6] = 'Apasa aici pentru a juca '.SERVER_NAME;
$lang['index'][0][7] = 'Total jucatori';
$lang['index'][0][8] = 'Jucatori activi';
$lang['index'][0][9] = 'Jucatori online';
$lang['index'][0][10] = 'Despre joc';
$lang['index'][0][11] = 'Vei incepe ca sef al unui sat mic si vei porni intr-o aventura captivanta.';
$lang['index'][0][12] = 'Construieste sate, poarta razboaie sau stabileste rute comerciale cu vecinii tai.';
$lang['index'][0][13] = 'Joaca cu si impotriva a mii de alti jucatori reali si cucereste lumea Travian.';
$lang['index'][0][14] = 'Noutati';
$lang['index'][0][15] = 'FAQ';
$lang['index'][0][16] = 'Capturi de ecran';
$lang['forum'] = 'Forum';
$lang['register'] = 'Inregistrare';
$lang['login'] = 'Autentificare';
$lang['screenshots']['title1'] = 'Sat';
$lang['screenshots']['desc1'] = 'Constructia satului';
$lang['screenshots']['title2'] = 'Resursa';
$lang['screenshots']['desc2'] = 'Resursele satului sunt lemn, lut, fier si cereale';
$lang['screenshots']['title3'] = 'Harta';
$lang['screenshots']['desc3'] = 'Localizeaza satul tau pe harta';
$lang['screenshots']['title4'] = 'Construieste cladire';
$lang['screenshots']['desc4'] = 'Cum sa construiesti o cladire sau nivelul unei resurse';
$lang['screenshots']['title5'] = 'Raport';
$lang['screenshots']['desc5'] = 'Raportul tau de atac';
$lang['screenshots']['title6'] = 'Statistici';
$lang['screenshots']['desc6'] = 'Vezi clasamentul tau in statistici';
$lang['screenshots']['title7'] = 'Arme sau aluat';
$lang['screenshots']['desc7'] = 'Poti alege sa joci ca militar sau economic';
