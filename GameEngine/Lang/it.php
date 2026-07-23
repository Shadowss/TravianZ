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
//                                Adding tasks, constructions and artefact  by: Mario               //
//                                Modified , added , fixed , implementd  by: Mario                  //
//////////////////////////////////////////////////////////////////////////////////////////////////////
									//                         //
									//         ITALIAN         //
									//      Author: Mario      //
									//     Adding: Mario       //
									/////////////////////////////

//MAIN MENU
tz_def("TRIBE1","Romani");
tz_def("TRIBE2","Teutoni");
tz_def("TRIBE3","Galli");
tz_def("TRIBE4","Nature");
tz_def("TRIBE5","Natars");
tz_def("TRIBE6","Monstri");

tz_def("HOME","Homepage");
tz_def("INSTRUCT","Instruzioni");
tz_def("ADMIN_PANEL","Pannello Admin");
tz_def("MASS_MESSAGE","Mass Message");
tz_def("LOGOUT","Logout");
tz_def("PROFILE","Profilo");
tz_def("SUPPORT","Supporto");
tz_def("UPDATE_T_10","Aggiorna primi 10");
tz_def("SYSTEM_MESSAGE","Messaggi di sistema");
tz_def("TRAVIAN_PLUS","Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></span></span></b>");
tz_def("CONTACT","Contattaci!");
tz_def("GAME_RULES","Regole di gioco");

//MENU
tz_def("REG","Registrazione");
tz_def("FORUM","Forum");
tz_def("CHAT","Chat");
tz_def("IMPRINT","Imprint");
tz_def("MORE_LINKS","Altri Links");
tz_def("TOUR","Tour del gioco");


//ERRORS
tz_def("USRNM_EMPTY","(Username vuoto)");
tz_def("USRNM_TAKEN","(Name già in uso.)");
tz_def("USRNM_SHORT","(min. ".USRNM_MIN_LENGTH." figure)");
tz_def("USRNM_CHAR","(Caratteri non validi)");
tz_def("PW_EMPTY","(Password vuota)");
tz_def("PW_SHORT","(min. ".PW_MIN_LENGTH." figure)");
tz_def("PW_INSECURE","(Password non sicura. Si prega di sceglierne una più sicura.)");
tz_def("EMAIL_EMPTY","(Email vuota)");
tz_def("EMAIL_INVALID","(Indirizzo email non valido)");
tz_def("EMAIL_TAKEN","(Email già in uso)");
tz_def("TRIBE_EMPTY","<li>Si prega di scegliere una tribù.</li>");
tz_def("AGREE_ERROR","<li>Devi accettare le regole del gioco e i termini e le condizioni generali per registrarti.</li>");
tz_def("LOGIN_USR_EMPTY","Inserisci il nome.");
tz_def("LOGIN_PASS_EMPTY","Enter password.");
tz_def("EMAIL_ERROR","Email non corrisponde");
tz_def("PASS_MISMATCH","Passwords non corrisponde");
tz_def("ALLI_OWNER","Si prega di nominare un proprietario dell'alleanza prima dell'eliminazione");
tz_def("SIT_ERROR","Modello già impostato o giocatore non trovato");
tz_def("USR_NT_FOUND","Il Nome non esiste.");
tz_def("LOGIN_PW_ERROR","La password è sbagliata.");
tz_def("WEL_TOPIC","Consigli e informazioni utili ");
tz_def("ATAG_EMPTY","Tag vuoto");
tz_def("ANAME_EMPTY","Nome vuoto");
tz_def("ATAG_EXIST","Tag preso");
tz_def("ANAME_EXIST","Nome preso");
tz_def("ALREADY_ALLY_MEMBER","Sei già in un'alleanza");
tz_def("ALLY_TOO_LOW", "Devi avere un'ambasciata di livello 3 o superiore");
tz_def("USER_NOT_IN_YOUR_ALLY","Questo utente non è nella tua alleanza!");
tz_def("CANT_EDIT_YOUR_PERMISSIONS","Non puoi modificare le tue autorizzazioni!");
tz_def("CANT_EDIT_LEADER_PERMISSIONS","Le autorizzazioni del leader dell'alleanza non possono essere modificate!");
tz_def("NO_PERMISSION", "Non hai abbastanza autorizzazioni!");
tz_def("NAME_OR_DIPL_EMPTY", "Nome o diplomazia vuoti");
tz_def("ALLY_DOESNT_EXISTS","L'alleanza non esiste");
tz_def("CANNOT_INVITE_SAME_ALLY","Non puoi invitare la tua alleanza");
tz_def("WRONG_DIPLOMACY","Hai fatto la scelta sbagliata");
tz_def("INVITE_ALREADY_SENT","O hai già inviato un patto a questa alleanza, loro te lo hanno già inviato o hai già un patto con loro");
tz_def("INVITE_SENT","Invito inviato");
tz_def("DECLARED_WAR_ON","dichiarato guerra a");
tz_def("OFFERED_NON_AGGRESION_PACT_TO","offerto patto di non aggressione a");
tz_def("OFFERED_CONFED_TO","offerto una confederazione a");
tz_def("ALLY_TOO_MUCH_PACTS","O non puoi offrire più patti di questo tipo o questa alleanza ha raggiunto il limite per questo tipo di patti");
tz_def("ALLY_PERMISSIONS_UPDATED","Permessi aggiornati");
tz_def("ALLY_FORUM_LINK_UPDATED", "Forum link aggiornato");
tz_def("NO_FORUMS_YET","Non ci sono ancora forums.");
tz_def("ALLY_USER_KICKED"," è stato espulso dall'alleanza");
tz_def("NOT_OPENED_YET","Server non ancora avviato.");
tz_def("REGISTER_CLOSED","Il registro è chiuso. Non puoi registrarti su questo server.");
tz_def("NAME_EMPTY","Si prega di inserire il nome");
tz_def("NAME_NO_EXIST","Non c'è nessun utente con il nome ");
tz_def("ID_NO_EXIST","Non c'è nessun utente con l'id ");
tz_def("SAME_NAME","Non puoi invitare te stesso");
tz_def("ALREADY_INVITED"," già invitato");
tz_def("ALREADY_IN_ALLY"," è già in questa alleanza");
tz_def("ALREADY_IN_AN_ALLY"," è già in un'alleanza");
tz_def("NAME_OR_TAG_CHANGED","Nome o Tag cambiato");
tz_def("VAC_MODE_WRONG_DAYS","Hai inserito un numero di giorni errato");

//COPYRIGHT
tz_def("TRAVIAN_COPYRIGHT","TravianZ - Clone di Travian 100% Open Source.");

//BUILD.TPL
tz_def("CUR_PROD","Produzione attuale");
tz_def("NEXT_PROD","Produzione a livello ");
tz_def("CONSTRUCT_BUILD","Costruisci edificio");

//BUILDINGS
tz_def("B1","Falegnameria");
tz_def("B1_DESC","Il taglialegna abbatte gli alberi per produrre legname. Più si estende la falegnameria, più legname viene prodotto.");
tz_def("B2","Cava di argilla");
tz_def("B2_DESC","L'argilla viene prodotta qui. Aumentando il suo livello si aumenta la produzione di argilla.");
tz_def("B3","Miniera di ferro");
tz_def("B3_DESC","Qui i minatori producono il ferro. Aumentando il livello della miniera aumenti la sua produzione di ferro.");
tz_def("B4","Terreno coltivato");
tz_def("B4_DESC","Il cibo della tua popolazione viene prodotto qui. Aumentando il livello della fattoria, aumenti la sua produzione agricola.");

//DORF1
tz_def("LUMBER","Legname");
tz_def("CLAY","Argilla");
tz_def("IRON","Ferro");
tz_def("CROP","Raccolto");
tz_def("LEVEL","Livello");
tz_def("CROP_COM",CROP." consumo");
tz_def("PER_HR","per ora");
tz_def("PROD_HEADER","Produzione");
tz_def("MULTI_V_HEADER","Villaggi");
tz_def("ANNOUNCEMENT","Annuncio");
tz_def("GO2MY_VILLAGE","Vai al mio villaggio");
tz_def("VILLAGE_CENTER","Centro Villaggio");
tz_def("FINISH_GOLD","Completa immediatamente tutti gli ordini di costruzione e ricerca in questo villaggio per 2 oro?");
tz_def("WAITING_LOOP","(ciclo di attesa)");
tz_def("CROP_NEGATIVE","La tua produzione agricola è negativa, non raggiungerai mai la quantità di risorse richieste.");
tz_def("HRS","(ore.)");
tz_def("DONE_AT","fatto a");
tz_def("CANCEL","annulla");
tz_def("LOYALTY","Lealtà");
tz_def("CALCULATED_IN","Calcolato in");
tz_def("SEVER_TIME","Orario del server:");
tz_def("HI","Ciao");
tz_def("P_IN","nel");

//QUEST
tz_def("Q_CONTINUE","Continua con l'attività successiva.");
tz_def("Q_REWARD","Il tuo premio:");
tz_def("Q_BUTN","task completo");
tz_def("Q0","Benvenuto a ");
tz_def("Q0_DESC","Come vedo, sei stato nominato capo di questo piccolo villaggio. Sarò il tuo consigliere per i primi giorni e non lascerò mai il tuo lato (destro).");
tz_def("Q0_OPT1","Al primo compito.");
tz_def("Q0_OPT2","Guardati intorno da solo.");
tz_def("Q0_OPT3","Non svolgere attività.");

tz_def("Q1","Task 1: Falegnameria");
tz_def("Q1_DESC","Ci sono quattro foreste verdi intorno al tuo villaggio. Costruisci una falegnameria su uno di essi. Il legname è una risorsa importante per il nostro nuovo insediamento.");
tz_def("Q1_ORDER","Ordine:<\/p>Costruisci una falegnameria.");
tz_def("Q1_RESP","Sì, in questo modo guadagni più legname. Ho aiutato un po' e ho completato l'ordine all'istante.");
tz_def("Q1_REWARD","Falegnameria immediatamente completata.");

tz_def("Q2","Task 2: Raccolto");
tz_def("Q2_DESC","Ora i tuoi sudditi hanno fame per aver lavorato tutto il giorno. Estendi un terreno coltivato per migliorare l'offerta dei tuoi sudditi. Torna qui una volta che l'edificio è completo.");
tz_def("Q2_ORDER","Ordine:<\/p>Estendi un terreno coltivato.");
tz_def("Q2_RESP","Molto bene. Ora i tuoi sudditi hanno di nuovo abbastanza da mangiare...");
tz_def("Q2_REWARD","Il tuo premio:<\/p>1 giorno Travian");

tz_def("Q3","Task 3: Il nome del tuo villaggio");
tz_def("Q3_DESC","Creativo come sei, puoi dare al tuo villaggio il nome definitivo.<br \/><br \/>Clicca su 'profilo' nel menu a sinistra e quindi selezionare 'cambia profilo'...");
tz_def("Q3_ORDER","Ordine:<\/p>Cambia il nome del tuo villaggio in qualcosa di carino.");
tz_def("Q3_RESP","Wow, un bel nome per il loro villaggio. Avrebbe potuto essere il nome del mio villaggio!...");

tz_def("Q4","Task 4: Altri giocatori");
tz_def("Q4_DESC","Nel ". SERVER_NAME ." giochi insieme a miliardi di altri giocatori. Clicca 'statistiche' nel menu in alto per cercare il tuo grado e inserirlo qui.");
tz_def("Q4_ORDER","Ordine:<\/p>Cerca il tuo grado nelle statistiche e inseriscilo qui.");
tz_def("Q4_BUTN","task completato");
tz_def("Q4_RESP","Esattamente! Questo è il tuo grado.");

tz_def("Q5","Task 5: Due ordini di costruzione");
tz_def("Q5_DESC","Costruisci una miniera di ferro e una cava di argilla. Ferro e argilla non sono mai abbastanza.");
tz_def("Q5_ORDER","Ordine:<\/p><ul><li>Estendi una miniera di ferro.<\/li><li>Estendi una cava di argilla.<\/li><\/ul>");
tz_def("Q5_RESP","Come hai notato, gli ordini di costruzione richiedono piuttosto tempo. Il mondo di ". SERVER_NAME ." continuerà a girare anche se sei offline. Anche tra pochi mesi ci saranno molte cose nuove da scoprire.<br \/><br \/>La cosa migliore da fare è controllare occasionalmente il tuo villaggio e dare ai soggetti nuovi compiti da svolgere.");

tz_def("Q6","Task 6: Messaggi");
tz_def("Q6_DESC","Puoi parlare con altri giocatori usando il sistema di messaggistica. Ti ho inviato un messaggio. Leggilo e torna qui.<br \/><br \/>P.S. Non dimenticare: a sinistra i report, a destra i messaggi.");
tz_def("Q6_ORDER","Ordine:<\/p>Leggi il tuo nuovo messaggio.");
tz_def("Q6_RESP","L'hai ricevuto? Molto bene.<br \/><br \/>Ecco un po' d'oro. Con Gold puoi fare diverse cose, ad es. estendere il tuo   nel menu a sinistra.");
tz_def("Q6_RESP1","-Conta o aumenta la tua produzione di risorse. Per farlo clicca ");
tz_def("Q6_RESP2","nel menu a sinistra.");
tz_def("Q6_SUBJECT","Messaggio dal Sorvegliante");
tz_def("Q6_MESSAGE","Devi essere informato che una bella ricompensa ti sta aspettando dal sorvegliante.<br /><br />Suggerimento: Il messaggio è stato generato automaticamente. Non è necessaria una risposta.");

tz_def("Q7","Task 7: Ognuno il suo!");
tz_def("Q7_DESC","Ora dovremmo aumentare un po' la produzione di risorse. Costruisci un altra falegnameria, cava di argilla, miniera di ferro e terreno coltivato al livello 1.");
tz_def("Q7_ORDER","Ordine:<\/p>Estendi un'altra casella di ogni risorsa al livello 1.");
tz_def("Q7_RESP","Molto bene, grande sviluppo della produzione di risorse.");

tz_def("Q8","Task 8: Esercito enorme!");
tz_def("Q8_DESC","Ora ho una ricerca molto speciale per te. Ho fame. Dammi 200 risorse di grano!<br \/><br \/>In cambio cercherò di organizzare un enorme esercito per proteggere il tuo villaggio.");
tz_def("Q8_ORDER","Ordine:<\/p>Invia 200 risorse di grano al Sorvegliante.");
tz_def("Q8_BUTN","Invia grano");
tz_def("Q8_NOCROP","Non hai abbastanza grano!");

tz_def("Q9","Task 9: Tutti per 1.");
tz_def("Q9_DESC","In Travian c'è sempre qualcosa da fare! Mentre aspetti l'arrivo dell'enorme esercito, ora dovremmo aumentare un po' la tua produzione di risorse. Estendi tutte le tue caselle di risorse al livello 1.");
tz_def("Q9_ORDER","Ordine:<\/p>Estendi tutte le caselle risorse al livello 1.");
tz_def("Q9_RESP","Molto bene, la tua produzione di risorse prospera.<br \/><br \/>Presto potremo iniziare con la costruzione di edifici nel villaggio.");

tz_def("Q10","Task 10: Colomba della pace");
tz_def("Q10_DESC","I primi giorni dopo la registrazione sei protetto dagli attacchi degli altri giocatori. Puoi vedere quanto dura questa protezione aggiungendo il codice <b>[#0]<\/b> al tuo profilo.");
tz_def("Q10_ORDER","Ordine:<\/p>Scrivi il codice <b>[#0]<\/b> nel tuo profilo aggiungendolo a uno dei due campi di descrizione.");
tz_def("Q10_RESP","Ben fatto! Ora tutti possono vedere a quale grande guerriero si avvicina il mondo.");
tz_def("Q10_REWARD","Il tuo premio:<\/p>2 giorni Travian");

tz_def("Q11","Task 11: Vicini!");
tz_def("Q11_DESC","Intorno a te ci sono molti villaggi diversi. Uno di loro si chiama. ");
tz_def("Q11_DESC1"," Clicca su 'mappa' nel menu di intestazione e cerca quel villaggio. Il nome dei tuoi vicini i villaggi possono essere visti quando si passa il mouse su uno di essi.");
tz_def("Q11_ORDER","Ordine:</p>Cerca le coordinate di ");
tz_def("Q11_ORDER1","e inseriscili qui.");
tz_def("Q11_RESP","Esatto, lì ");
tz_def("Q11_RESP1"," Villaggio! Tante risorse, quante ne raggiungi su questo villaggio. Beh, quasi altrettanto ...");
tz_def("Q11_BUTN","task completato");

tz_def("Q12","Task 12: Botola");
tz_def("Q12_DESC","Sta arrivando il momento di erigere una botola. Il mondo di <?php echo SERVER_NAME; ?> è pericolso.<br \/><br \/>Molti giocatori vivono rubando le risorse di altri giocatori. Costruisci una botola per nascondere alcune delle tue risorse ai nemici.");
tz_def("Q12_ORDER","Ordine:<\/p>Costruisci una botola.");
tz_def("Q12_RESP","Ben fatto, ora è molto più difficile per i tuoi meschini compagni giocatori saccheggiare il tuo villaggio.<br \/><br \/>Se sotto attacco, i tuoi abitanti nasconderanno le risorse nel botola da soli.");

tz_def("Q13","Task 13: A due.");
tz_def("Q13_DESC","In <?php echo SERVER_NAME; ?> c'è sempre qualcosa da fare! Estendi la falegnameria, una cava di argilla, una miniera di ferro e un terreno coltivato al livello 2 ciascuno.");
tz_def("Q13_ORDER","Ordine:<\/p>Estendi una di ogni casella risorsa al livello 2.");
tz_def("Q13_RESP","Molto bene, il tuo villaggio cresce e prospera!");

tz_def("Q14","Task 14: Istruzioni");
tz_def("Q14_DESC","Nelle istruzioni di gioco puoi trovare brevi testi informativi su diversi edifici e tipi di unità.<br \/><br \/>Clicca su 'istruzioni' a sinistra per scoprire quanto legname è necessario per la caserma.");
tz_def("Q14_ORDER","Ordine:<\/p>Inserisci quanto costano le baracche di legname");
tz_def("Q14_BUTN","task completato");
tz_def("Q14_RESP","Esattamente! Le baracche costano 210 legname.");

tz_def("Q15","Task 15: Palazzo principale");
tz_def("Q15_DESC","I tuoi capomastri hanno bisogno di un edificio principale di livello 3 per erigere edifici importanti come il mercato o le baracche.");
tz_def("Q15_ORDER","Ordine:<\/p>Estendi il tuo edificio principale al livello 3.");
tz_def("Q15_RESP","Ben fatto. Il livello 3 dell'edificio principale è stato completato.<br><br>Con questo aggiornamento i tuoi maestri costruttori non solo costruiscono più tipi di edifici, ma lo fanno anche più velocemente.");

tz_def("Q16","Task 16: Avanzate!");
tz_def("Q16_DESC","Cerca di nuovo il tuo grado nelle statistiche del giocatore e goditi i tuoi progressi.");
tz_def("Q16_ORDER","Ordini:<\/p>Cerca il tuo grado nelle statistiche e inseriscilo qui.");
tz_def("Q16_RESP","Ben fatto! Questo è il tuo grado attuale.");

tz_def("Q17","Task 17: Armi o Impasto");
tz_def("Q17_DESC","Ora devi prendere una decisione: O commercia pacificamente o diventa un temuto guerriero.<br \/><br \/>Per il mercato è necessario un granaio, per la caserma è necessario un punto di raccolta.");
tz_def("Q17_BUTN","Economia");
tz_def("Q17_BUTN1","Militare");

tz_def("Q18","Task 18: Militare");
tz_def("Q18_DESC","Una decisione coraggiosa. Per poter inviare truppe è necessario un punto di raccolta.<br \/><br \/>Il punto di raccolta deve essere costruito su un cantiere specifico. Il ");
tz_def("Q18_DESC1"," cantiere.");
tz_def("Q18_DESC2"," si trova sul lato destro dell'edificio principale, leggermente al di sotto di esso. Il cantiere stesso è curvo.");
tz_def("Q18_ORDER","Ordine:<\/p>Costruisci un punto di raccolta.");
tz_def("Q18_RESP","Il tuo punto di raccolta è stato eretto! Una buona mossa verso il dominio del mondo!");

tz_def("Q19","Task 19: Caserma");
tz_def("Q19_DESC","Ora hai un edificio principale di livello 3 e un punto di raccolta. Ciò significa che tutti i prerequisiti per la costruzione di caserme sono stati soddisfatti.<br><br>You can use the barracks to train troops for fighting.");
tz_def("Q19_ORDER","Ordine:<\/p>Costruisci caserme.");
tz_def("Q19_RESP","Ben fatto... I migliori istruttori di tutto il paese si sono riuniti per allenare le tue abilità di combattimento maschili al massimo della forma.");

tz_def("Q20","Task 20: Treno.");
tz_def("Q20_DESC","Ora che hai la caserma puoi iniziare ad addestrare le truppe. Allenane due ");
tz_def("Q20_ORDER","Per favore allenati 2 ");
tz_def("Q20_RESP","Le basi per il tuo glorioso esercito sono state gettate.<br \/><br \/>Prima di mandare il tuo esercito a saccheggiare dovresti controllare con il.");
tz_def("Q20_RESP1","Simulatore di combattimento");
tz_def("Q20_RESP2","per vedere quante truppe hai bisogno per combattere con successo un topo senza perdite.");

tz_def("Q21","Task 18: Economia");
tz_def("Q21_DESC","Commercio & Economia è stata una tua scelta. I tempi d'oro ti aspettano di sicuro!");
tz_def("Q21_ORDER","Ordine:<\/p>Costruisci un granaio.");
tz_def("Q21_RESP","Ben fatto! Con il granaio puoi immagazzinare più grano.");

tz_def("Q22","Task 19: Magazzino");
tz_def("Q22_DESC","Noon solo il raccolto dev' essere salvato.  Anche altre risorse possono essere andare sprecate se non vengono immagazzinate. Costruisci un magazzino!");
tz_def("Q22_ORDER","Ordine:<\/p>Costruisci un magazzino.");
tz_def("Q22_RESP",";Ben fatto, il tuo magazzino è completato...&rdquo;<\/i><br \/>Ora hai soddisfatto tutti i prerequisiti richiesti per costruire un Mercato.");

tz_def("Q23","Task 20: Mercato.");
tz_def("Q23_DESC",";Costruisci un mercato in modo da poter commerciare con i tuoi compagni giocatori.");
tz_def("Q23_ORDER","Ordine:<\/p>Per favore costruisci un Mercato.");
tz_def("Q23_RESP",";Ill Mercato è stato completato. Ora puoi fare le tue offerte o accettare offerte esterne! Quando crei le tue offerte, dovresti pensare di offrire ciò di cui gli altri giocatori hanno più bisogno per ottenere più profitti.");

tz_def("Q24","Task 21: Everything to 2.");
tz_def("Q24_DESC","Now we should increase your resource production a bit. Build an additional woodcutter, clay pit, iron mine and cropland to level 1.");
tz_def("Q24_ORDER","Ordine:<\/p>Estendi tutte le tue caselle al livell 2.");
tz_def("Q24_RESP","Congratulazioni! Il tuo villaggio cresce e prospera...");

tz_def("Q28","Task 22: Alleanze.");
tz_def("Q28_DESC","Il lavoro di squadra è importante in Travian. I giocatori che lavorano insieme si organizzano in alleanze. Ricevi un inivito da un'alleanza nella tua regione e unisciti a questa alleanza. In alternativa, puoi fondare la tua alleanza. Per far ciò, è necessaria un ambasciata a livello 3.");
tz_def("Q28_ORDER","Ordine:<\/p>Unisciti a un alleanza o trovane una da solo.");
tz_def("Q28_RESP","Va bene! Ora che ti sei unito alla chiamata");
tz_def("Q28_RESP1",", e sei un membro della loro alleanza aumenterai i tuoi progressi più velocemente...");

tz_def("Q29","Task 23: Edificio principale di livello 5");
tz_def("Q29_DESC","Per poter costruire un palazzo o una residenza, avrai bisogno di un edificio principale al livello 5.");
tz_def("Q29_ORDER","Ordine:<\/p>Migliora il tuo edificio principale a livello 5.");
tz_def("Q29_RESP","L'edificio principale è ora di livello 5 e poi costruire un palazzo o una residenza...");

tz_def("Q30","Task 24: Granaio a livello 3.");
tz_def("Q30_DESC","Per non perdere raccolto, dovresti aggiornare il tuo granaio.");
tz_def("Q30_ORDER","Ordine:<\/p>Aggiorna il tuo granaio a livello 3.");
tz_def("Q30_RESP","Il granaio è ora a livello 3...");

tz_def("Q31","Task 25: Magazzino a livello 7");
tz_def("Q31_DESC"," Per assicurarti che le tue risorse non trabocchino, dovresti aggiornare il tuo magazzino.");
tz_def("Q31_ORDER","Ordine:<\/p>Aggiorna il tuo magazzino al livello 7.");
tz_def("Q31_RESP","Il magazzino è stato aggiornato al livello 7...");

tz_def("Q32","Task 26: Tutti e cinque!");
tz_def("Q32_DESC","Avrai sempre bisogno di più risorse. Le caselle risorse sono piuttosto costose, ma a lungo termine pagheranno sempre.");
tz_def("Q32_ORDER","Ordine:<\/p>Aggiorna tutte le caselle risorse al livello 5.");
tz_def("Q32_RESP","Tutte le risorse sono ora a livvello 5, molto bene, il tuo villaggio cresce e prospera!");

tz_def("Q33","Task 27: Palazzo o Residenza?");
tz_def("Q33_DESC","Per fondare un nuovo villaggio, avrai bisogno di coloni. Quelli che puoi addestrare in un palazzo o in una residenza.");
tz_def("Q33_ORDER","Ordine:<\/p>Costruisci un palazzo o una residenza a livello 10.");
tz_def("Q33_RESP","aveva raggiunto il livello 10, ora puoi addestrare i coloni e fondare il tuo secondo villaggio. Notare i punti culturali...");

tz_def("Q34","Task 28: 3 Coloni.");
tz_def("Q34_DESC","Per fondare un nuovo villaggio, avrai bisogno di coloni. Possono essere addestrati in un palazzo o in una residenza.");
tz_def("Q34_ORDER","Ordine:<\/p>Addestra 3 coloni.");
tz_def("Q34_RESP","3 i coloni sono stati addestrati. Per fondare un nuovo villaggio è necessario almeno");
tz_def("Q34_RESP1","punti cultura...");

tz_def("Q35","Task 29: Nuovo villaggio.");
tz_def("Q35_DESC","Ci sono molte caselle vuote sulla mappa. Trova quello che fa per te e trova un nuovo villaggio");
tz_def("Q35_ORDER","Ordine:<\/p>Trovato un nuovo villaggio.");
tz_def("Q35_RESP","Sono fiero di te! Ora hai due villaggi e hai tutte le possibilità per costruire un potente impero. Ti auguro buona fortuna con questo.");

tz_def("Q36"," Task 30: Costruire un ");
tz_def("Q36_DESC","Ora che hai addestrato alcuni soldati, dovresti costruire un ");
tz_def("Q36_DESC1"," anche. Aumenta la difesa di base e i tuoi soldati riceveranno un bonus difensivo.");
tz_def("Q36_ORDER","Ordine:<\/p>Costruisci un ");
tz_def("Q36_RESP","È di questo che sto parlando. UN ");
tz_def("Q36_RESP1"," Molto utile. Aumenta la difesa delle truppe nel villaggio.");

tz_def("Q37","Tasks");
tz_def("Q37_DESC","Tutti i compiti raggiunti!");

tz_def("OPT3","Panoramica delle risorse");
tz_def("T","Le tue consegne di risorse");
tz_def("T1","Consegna");
tz_def("T2","Tempo di consegna");
tz_def("T3","Stato");
tz_def("T4","andare a prendere");
tz_def("T5","preso");
tz_def("T6","In attesa");
tz_def("T7","1 giorno Travian ");
tz_def("T8","2 giorni Travian ");

//Quest 25
tz_def("Q25_7","Task 7: Vicinato!");
tz_def("Q25_7_DESC","Intorno a te ci sono molti villaggi diversi. Uno di loro è stato scelto. ");
tz_def("Q25_7_DESC1","Clicca 'Mappa' nel menu principale e cerca quel villaggio. Il nome dei tuoi villaggi vicini può essere visto quando passi il mouse su uno di essi.");
tz_def("Q25_7_ORDER","<\/p><b>Ordine:</b><br>Cerca le coordinate di ");
tz_def("Q25_7_ORDER1","e inseriscili qui.");
tz_def("Q25_7_RESP","Esatto, lì ");
tz_def("Q25_7_RESP1"," Villaggio! Tante risorse quante ne aggiungi in questo villaggio. Beh, quasi altrettanto ...");

tz_def("Q25_8","Task 8: Esercito enorme!");
tz_def("Q25_8_DESC","Ora ho un Compito molto speciale per te. Sono affamato. Dammi 200 risorse di grano!<br \/><br \/>In cambio cercherò di organizzare un enorme esercito per proteggere il tuo villaggio.");
tz_def("Q25_8_ORDER","Ordine:<\/p>Invia 200 colture al sorvegliante.");
tz_def("Q25_8_BUTN","Invia grano");
tz_def("Q25_8_NOCROP","Non hai abbastanza raccolto!");

tz_def("Q25_9","Task 9: Uno ognuno!");
tz_def("Q25_9_DESC","Nel " . SERVER_NAME . " c'è sempre qualcosa da fare! Mentre aspetti il ​​tuo nuovo esercito,<br \/><br \/>estendere una falegnameria aggiuntiva, una cava di argilla, una miniera di ferro e un terreno coltivato per livello 1");
tz_def("Q25_9_ORDER","Ordine:<\/p>Estendi un'altra casella di ogni risorsa al livello 1.");
tz_def("Q25_9_RESP","Molto bene, grande sviluppo della produzione di risorse.");

tz_def("Q25_10","Task 10: Prossimamente!");
tz_def("Q25_10_DESC","Ora c'è tempo per una piccola pausa finché non arriva il gigantesco esercito che ti ho mandato.<br \/><br \/>Fino ad allora puoi esplorare la mappa o estendere alcune caselle risorsa.");
tz_def("Q25_10_ORDER","Ordine:<\/p>Aspetta che arrivi l'esercito del Sorvegliante");
tz_def("Q25_10_RESP","Ora un enorme esercito è arrivato per proteggere il tuo villaggio");
tz_def("Q25_10_REWARD","Il tuo premio:<\/p>2 giorni in più in Travian");

tz_def("Q25_11","Task 11: Rapporti");
tz_def("Q25_11_DESC","Ogni volta che succede qualcosa di importante al tuo account riceverai un rapporto.<br \/><br \/>Puoi vederli facendo clic sulla metà sinistra del 5° pulsante (da sinistra a destra). Leggi il report e torna qui.");
tz_def("Q25_11_ORDER","Ordine:<\/p>Leggi il tuo ultimo rapporto.");
tz_def("Q25_11_RESP","L'hai ricevuto? Molto buona. Ecco la tua ricompensa.");

tz_def("Q25_12","Task 12: Tutti  per 1.");
tz_def("Q25_12_DESC","Ora dovremmo aumentare un po' la produzione di risorse.");
tz_def("Q25_12_ORDER","Ordine:<\/p>Estendi tutte le caselle risorsa al livello 1.");
tz_def("Q25_12_RESP","Molto bene, la tua produzione di risorse prospera.<br \/><br \/>Presto potremo iniziare con la costruzione di edifici nel villaggio.");

tz_def("Q25_13","Task 13: Colomba della pace");
tz_def("Q25_13_DESC","I primi giorni dopo la registrazione sei protetto dagli attacchi degli altri giocatori. Puoi vedere quanto dura questa protezione aggiungendo il codice <b>[#0]<\/b> al tuo profilo.");
tz_def("Q25_13_ORDER","Ordine:<\/p>Scrivi il codice <b>[#0]<\/b> nel tuo profilo aggiungendolo a uno dei due campi di descrizione.");
tz_def("Q25_13_RESP","Ben fatto! Ora tutti possono vedere a quale grande guerriero si avvicina il mondo.");

tz_def("Q25_14","Task 14: Botola");
tz_def("Q25_14_DESC","Sta arrivando il momento di creare una botola. Il mondo di <b>" . SERVER_NAME. "</b> è pericoloso.<br \/><br \/>Molti giocatori vivono rubando le risorse di altri giocatori. Costruisci una botola per nascondere alcune delle tue risorse ai nemici.");
tz_def("Q25_14_ORDER","Ordine:<\/p>Costruisci una botola.");
tz_def("Q25_14_RESP","Ben fatto, ora è molto più difficile per gli altri meschini giocatori saccheggiare il tuo villaggio.<br \/><br \/>Se sotto attacco, i tuoi abitanti nasconderanno le risorse nella botola da soli.");

tz_def("Q25_15","Task 15: A due.");
tz_def("Q25_15_DESC","In <b>" . SERVER_NAME. "</b> c'è sempre qualcosa da fare! Estendi una falegnameria, una cava di argilla, una miniera di ferro e un terreno coltivato al livello 2 ciascuno.");
tz_def("Q25_15_ORDER","Ordine:<\/p>Estendi una di ciascuna casella risorsa al livello 2.");
tz_def("Q25_15_RESP","Molto bene, il tuo villaggio cresce e prospera!");

tz_def("Q25_16","Task 16: Istruzioni");
tz_def("Q25_16_DESC","Nelle istruzioni di gioco puoi trovare brevi testi informativi su diversi edifici e tipi di unità.<br \/><br \/>Clicca su 'istruzioni' a sinistra per sapere quanto legname è necessario per la caserma.");
tz_def("Q25_16_ORDER","Ordine:<\/p>Inserisci quanto costano le falegnamerie di legname");
tz_def("Q25_16_BUTN","task completato");
tz_def("Q25_16_RESP","Esattamente! Le falegnamerie costano 210 legname.");

tz_def("Q25_17","Task 17: Palazzo principale");
tz_def("Q25_17_DESC","I tuoi capomastri hanno bisogno di un edificio principale di livello 3 per erigere edifici importanti come il mercato o le falegnamerie.");
tz_def("Q25_17_ORDER","Ordine:<\/p>Extend your main building to level 3.");
tz_def("Q25_17_RESP","Ben fatto. Il livello 3 dell'edificio principale è stato completato.<br><br>Con questo aggiornamento i tuoi maestri costruttori possono costruire più tipi di edifici e anche farlo più velocemente.");

tz_def("Q25_18","Task 18: Avanzate!");
tz_def("Q25_18_DESC","Cerca di nuovo il tuo grado nelle statistiche del giocatore e goditi i tuoi progressi.");
tz_def("Q25_18_ORDER","Ordine:<\/p>Cerca il tuo grado nelle statistiche e inseriscilo qui.");
tz_def("Q25_18_RESP","Ben fatto! Questo è il tuo grado attuale.");

tz_def("Q25_19","Task 19: Ben fatto! Questo è il tuo grado attuale");
tz_def("Q25_19_DESC","Ora devi prendere una decisione: commercia pacificamente o diventa un temuto guerriero.<br \/><br \/>Per il mercato è necessario un granaio, per la caserma è necessario un punto di raccolta.");
tz_def("Q25_19_BUTN","Economia");
tz_def("Q25_19_BUTN1","Militare");

tz_def("Q25_20","Task 19: Economia");
tz_def("Q25_20_DESC","Commercio & economia è stata una tua scelta. I tempi d'oro ti aspettano di sicuro!");
tz_def("Q25_20_ORDER","Ordine:<\/p>Costruisci un granaio.");
tz_def("Q25_20_RESP","Ben fatto! Con il Granaio puoi immagazzinare più grano.");

tz_def("Q25_21","Task 20: Magazzino");
tz_def("Q25_21_DESC","Non solo il raccolto deve essere salvato. Anche altre risorse possono andare sprecate se non vengono immagazzinate correttamente. Costruisci un magazzino!");
tz_def("Q25_21_ORDER","Ordine:<\/p>Costruisci magazzino.");
tz_def("Q25_21_RESP",";Ben fatto, il tuo magazzino è completo...&rdquo;<\/i><br \/>Ora hai soddisfatto tutti i prerequisiti richiesti per costruire un Marketplace.");

tz_def("Q25_22","Task 21: Mercato.");
tz_def("Q25_22_DESC",";Costruisci un mercato in modo da poter commerciare con i tuoi compagni giocatori.");
tz_def("Q25_22_ORDER","Ordine:<\/p>Per favore, costruisci un mercato.");
tz_def("Q25_22_RESP","Il mercato è stato completato. Ora puoi fare le tue offerte e accettare offerte estere! Quando crei le tue offerte, dovresti pensare di offrire ciò di cui gli altri giocatori hanno più bisogno per ottenere più profitti.");

tz_def("Q25_23","Task 19: Militare");
tz_def("Q25_23_DESC","Decisione coraggiosa. Per poter inviare truppe è necessario un punto di raccolta.<br \/><br \/>Il punto di raccolta deve essere costruito su un cantiere specifico. Il ");
tz_def("Q25_23_DESC1"," cantiere.");
tz_def("Q25_23_DESC2"," si trova sul lato destro dell'edificio principale, leggermente al di sotto di esso. Il cantiere stesso è curvo.");
tz_def("Q25_23_ORDER","Ordine:<\/p>Costruisci un punto di raccolta.");
tz_def("Q25_23_RESP","Il tuo punto di raccolta è stato eretto! Una buona mossa verso il dominio del mondo!");

tz_def("Q25_24","Task 20: Caserma");
tz_def("Q25_24_DESC","Ora hai un edificio principale di livello 3 e un punto di raccolta. Ciò significa che tutti i prerequisiti per la costruzione di caserme sono stati soddisfatti.<br><br>Puoi usare la caserma per addestrare le truppe al combattimento.");
tz_def("Q25_24_ORDER","Ordine:<\/p>Costruisci caserme.");
tz_def("Q25_24_RESP","Well done... I migliori istruttori di tutto il paese si sono riuniti per addestrare i tuoi uomini\u2019s abilità di combattimento al top della forma.");

tz_def("Q25_25","Task 21: Treno.");
tz_def("Q25_25_DESC","Ora che hai la caserma puoi iniziare ad addestrare le truppe. Allena due ");
tz_def("Q25_25_ORDER","Si prega di allenarsi 2 ");
tz_def("Q25_25_RESP","Le basi per il tuo glorioso esercito sono state gettate.<br \/><br \/>Prima di mandare il tuo esercito a saccheggiare dovresti controllare con il");
tz_def("Q25_25_RESP1","Simulatore di combattimento");
tz_def("Q25_25_RESP2","per vedere quante truppe hai bisogno per combattere con successo un avversario senza perdite.");

tz_def("Q25_26","Task 22: Tutto per 2.");
tz_def("Q25_26_DESC","Ora è di nuovo il momento di estendere le pietre miliari della potenza e della ricchezza! Questa volta il livello 1 non è abbastanza... ci vorrà un po' ma alla fine ne varrà la pena. Estendi tutte le tue caselle risorsa al livello 2!");
tz_def("Q25_26_ORDER","Ordine:<\/p>Estendi tutte le caselle risorsa al livello 2.");
tz_def("Q25_26_RESP","Congratulazioni! Il tuo villaggio cresce e prospera...");

tz_def("Q25_27","Task 23: Amici.");
tz_def("Q25_27_DESC","Come giocatore singolo è difficile competere con gli attaccanti. Va a tuo vantaggio se piaci ai tuoi vicini.<br \/><br \/>È ancora meglio se giochi insieme agli amici. Lo sapevi che puoi guadagnare <img src='img/x.gif' class='gold' alt='Gold' title='Gold'> invitando amici?");
tz_def("Q25_27_ORDER","Ordine:<\/p>Quanto <img src='img/x.gif' class='gold' alt='Gold' title='Gold'> guadagni per aver invitato un amico?");
tz_def("Q25_27_RESP","Corretto! Ottieni 50 <img src='img/x.gif' class='gold' alt='Gold' title='Gold'> se il tuo amico invitato ha 2 villaggi.");

tz_def("Q25_28","Task 24: Costruisci Ambasciata.");
tz_def("Q25_28_DESC","Il mondo di Travian è pericoloso. Hai già costruito una botola per proteggerti dagli aggressori.<br \/><br \/>Una buona alleanza ti darà una protezione ancora migliore.");
tz_def("Q25_28_ORDER","Ordine:<\/p>Per accettare inviti dalle alleanze, costruisci un'ambasciata.");
tz_def("Q25_28_RESP","Sì! Puoi attendere l'invito da un'alleanza o crearne uno tuo se l'ambasciata ha un livello 3");

tz_def("Q25_29","Task 25: Alleanza.");
tz_def("Q25_29_DESC","Il lavoro di squadra è importante in Travian. I giocatori che lavorano insieme si organizzano in alleanze. Ricevi un invito da un'alleanza nella tua regione e unisciti a questa alleanza. In alternativa, puoi fondare la tua alleanza. Per fare ciò, hai bisogno di un'ambasciata di livello 3.");
tz_def("Q25_29_ORDER","Ordine:<\/p>Unisciti a un'alleanza o fonda la tua alleanza.");
tz_def("Q25_29_RESP","Ben fatto! Ora sei in un sindacato chiamato");
tz_def("Q25_29_RESP1",", e tu sei un membro della loro alleanza.<br>Lavorando insieme progredirete tutti più velocemente...");

tz_def("Q25_30","Tasks");
tz_def("Q25_30_DESC","Tutti tasks sono completi!");


//======================================================//
//================ UNITS - DO NOT EDIT! ================//
//======================================================//
tz_def("U0","Eroe");

//ROMAN UNITS
tz_def("U1","Legionario");
tz_def("U2","Pretoriano");
tz_def("U3","Imperiale");
tz_def("U4","Emissario a cavallo");
tz_def("U5","Cavalieri Imperiali");
tz_def("U6","Cavalieri di Cesare");
tz_def("U7","Ariete");
tz_def("U8","Catapulta di fuoco");
tz_def("U9","Senatore");
tz_def("U10","Colonnello");

//TEUTON UNITS
tz_def("U11","Combattente");
tz_def("U12","Alabardiere");
tz_def("U13","Combattente con ascia");
tz_def("U14","Esploratore");
tz_def("U15","Paladino");
tz_def("U16","Cavaliere teutonico");
tz_def("U17","Ariete");
tz_def("U18","Catapulta");
tz_def("U19","Comandante");
tz_def("U20","Colono");

//GAUL UNITS
tz_def("U21","Falange");
tz_def("U22","Combattente con spada");
tz_def("U23","Ricognitore");
tz_def("U24","Fulmine di Teutates");
tz_def("U25","Cavaliere druido");
tz_def("U26","Paladino di Haeduan");
tz_def("U27","Ariete");
tz_def("U28","Trabucco");
tz_def("U29","Capotribù");
tz_def("U30","Colono");
tz_def("U99","Trappola");

//NATURE UNITS
tz_def("U31","Ratto");
tz_def("U32","Ragno");
tz_def("U33","Serpente");
tz_def("U34","Pipistrello");
tz_def("U35","Cinghiale");
tz_def("U36","Lupo");
tz_def("U37","Orso");
tz_def("U38","Coccodrillo");
tz_def("U39","Tigre");
tz_def("U40","Elefante");

//NATARS UNITS
tz_def("U41","Picchiere");
tz_def("U42","Guerriero Spinato");
tz_def("U43","Guardia");
tz_def("U44","Uccelli rapaci");
tz_def("U45","Cavaliere Axerider");
tz_def("U46","Cavaliere Natarian");
tz_def("U47","Elefante da guerra");
tz_def("U48","Ballista");
tz_def("U49","Imperatore Natarian");
tz_def("U50","Colono Settler");

//MONSTER UNITS
tz_def("U51","Mostro Peon");
tz_def("U52","Cacciatore di mostri");
tz_def("U53","Mostro Guerriero");
tz_def("U54","Fantasma");
tz_def("U55","Destriero mostruoso");
tz_def("U56","Destriero da guerra mostruoso");
tz_def("U57","Ariete mostro");
tz_def("U58","Catapulta mostro");
tz_def("U59","Capo dei mostri");
tz_def("U60","Mostro Colono");

// RESOURCES
tz_def("R1","Legname");
tz_def("R2","Argilla");
tz_def("R3","Ferro");
tz_def("R4","Grano");

//INDEX.php
tz_def("LOGIN","Login");
tz_def("PLAYERS","Giocatori");
tz_def("MODERATOR","Moderatori");
tz_def("ACTIVE","Attivi");
tz_def("ONLINE","Online");
tz_def("TUTORIAL","Tutorial");
tz_def("PLAYER_STATISTICS","Statistiche dei giocatori");
tz_def("TOTAL_PLAYERS","".PLAYERS." in totale");
tz_def("ACTIVE_PLAYERS","Giocatori attivi");
tz_def("ONLINE_PLAYERS","".PLAYERS." online");
tz_def("MP_STRATEGY_GAME","".SERVER_NAME." - il gioco di strategia multiplayer");
tz_def("WHAT_IS","".SERVER_NAME." è uno dei giochi per browser più popolari al mondo. Come giocatore in ".SERVER_NAME.", costruirai il tuo impero, recluterai un potente esercito e combatterai con i tuoi alleati per l'egemonia nel mondo del gioco.");
tz_def("REGISTER_FOR_FREE","Registrati qui gratuitamente!");
tz_def("LATEST_GAME_WORLD","Ultimo mondo di gioco");
tz_def("LATEST_GAME_WORLD2","Registrati all'ultimo<br/>mondo di gioco e divertiti<br/>i vantaggi di<br/>essere uno dei<br/>primi giocatori.");
tz_def("PLAY_NOW","Gioca ".SERVER_NAME." ora");
tz_def("LEARN_MORE","Scopri di più <br/>di ".SERVER_NAME."!");
tz_def("LEARN_MORE2","Ora con una rivoluzionario<br>sistema server, grafica<br> completamente nuova<br> Questo clone è The Shiz!");
tz_def("COMUNITY","Community");
tz_def("BECOME_COMUNITY","Entra a far parte della nostra community ora!");
tz_def("BECOME_COMUNITY2","Entra a far parte della<br>più grande<br>comunità nel<br>mondo.");
tz_def("NEWS","Novità");
tz_def("SCREENSHOTS","Screenshots");
tz_def("FAQ","FAQ");
tz_def("SPIELREGELN","Regole");
tz_def("AGB","Termini e Condizioni");
tz_def("LEARN1","Aggiorna i tuoi campi e le tue miniere per aumentare la tua produzione di risorse. Avrai bisogno di risorse per costruire edifici e addestrare soldati.");
tz_def("LEARN2","Costruisci ed espandi gli edifici nel tuo villaggio. Gli edifici migliorano la tua infrastruttura complessiva, aumentano la tua produzione di risorse e ti consentono di ricercare, addestrare e potenziare le tue truppe.");
tz_def("LEARN3","Visualizza e interagisci con l'ambiente circostante. Puoi fare nuove amicizie o nuovi nemici, utilizzare le oasi vicine e osservare come il tuo impero cresce e diventa più forte.");
tz_def("LEARN4","Segui i tuoi miglioramenti e successi e confrontati con gli altri giocatori. Guarda le prime 10 classifiche e combatti per vincere una medaglia settimanale.");
tz_def("LEARN5","Ricevi rapporti dettagliati sulle tue avventure, scambi e battaglie. Non dimenticare di controllare i nuovissimi rapporti sugli avvenimenti che si svolgono nei tuoi dintorni.");
tz_def("LEARN6","Scambia informazioni e conduci diplomazia con altri giocatori. Ricorda sempre che la comunicazione è la chiave per conquistare nuovi amici e risolvere vecchi conflitti.");
tz_def("LOGIN_TO","Accedi a ". SERVER_NAME);
tz_def("REGIN_TO","Registrati ". SERVER_NAME);
tz_def("P_ONLINE","Giocatori online: ");
tz_def("P_TOTAL","Giocatori in totale: ");
tz_def("CHOOSE","Scegli un server.");
tz_def("STARTED"," Il server è stato avviato ". round((time()-COMMENCE)/86400) ." giorni fa.");

//ANMELDEN.php
tz_def("NICKNAME","Nickname");
tz_def("EMAIL","Email");
tz_def("PASSWORD","Password");
tz_def("ROMANS","Romani");
tz_def("TEUTONS","Teutoni");
tz_def("GAULS","Galli");
tz_def("NW","Nord Ovest");
tz_def("NE","Nord Est");
tz_def("SW","Sud Ovest");
tz_def("SE","Sud Est");
tz_def("RANDOM","random");
tz_def("ACCEPT_RULES"," Accetto le regole del gioco e i termini e le condizioni generali.");
tz_def("ONE_PER_SERVER","Ogni giocatore può possedere UN SOLO account per server.");
tz_def("BEFORE_REGISTER","Prima di registrare un account dovresti leggere le <a href='../anleitung.php' target='_blank'>istruzioni</a> di Travian ro1 per vedere i vantaggi e gli svantaggi specifici delle tre tribù.");
tz_def("BUILDING_UPGRADING","Costruzione:");
tz_def("HOURS","ore");


//ATTACKS ETC.
tz_def("TROOP_MOVEMENTS","Movimenti di truppe:");
tz_def("ARRIVING_REINF_TROOPS","Truppe di rinforzo in arrivo");
tz_def("ARRIVING_ATTACKING_TROOPS","Truppe attaccanti in arrivo");
tz_def("ARRIVING_REINF_TROOPS_SHORT","Reinf.");
tz_def("OWN_ATTACKING_TROOPS","Proprie truppe d'attacco");
tz_def("ATTACK","Attacco");
tz_def("OWN_REINFORCING_TROOPS","Proprie truppe di rinforzo");
tz_def("TROOPS_DORF","Truppe:");
tz_def("NEWVILLAGE","Nuovo villaggio");
tz_def("FOUNDNEWVILLAGE","Fondazione del nuovo villaggio");
tz_def("UNDERATTACK","Il villaggio è sotto attacco");
tz_def("OASISATTACK","L'Oasi è sotto attacco");
tz_def("OASISATTACKS","Oasi Att.");
tz_def("RETURNFROM","Ritorno da");
tz_def("REINFORCEMENTFOR","Rinforzo a");
tz_def("ATTACK_ON","Attacco a");
tz_def("RAID_ON","Raid a");
tz_def("SCOUTING","Scouting");
tz_def("PRISONERS","Prigionieri");
tz_def("PRISONERSIN","Prigionieri a");
tz_def("PRISONERSFROM","Prigionieri da");
tz_def("TROOPS","Truppe");
tz_def("TROOPSFROM","Truppe da");
tz_def("BOUNTY","Taglia");
tz_def("ARRIVAL","Arrivo");
tz_def("CATAPULT_TARGET","Bersaglio catapulta");
tz_def("INCOMING_TROOPS","Truppe in arrivo");
tz_def("TROOPS_ON_THEIR_WAY","Truppe in arrivo");
tz_def("OWN_TROOPS","Proprie truppe");
tz_def("ON","su");
tz_def("AT","a");
tz_def("UPKEEP","Manutenzione");
tz_def("SEND_BACK","Manda indietro");
tz_def("TROOPS_IN_THE_VILLAGE","Truppe nel villaggio");
tz_def("TROOPS_IN_OTHER_VILLAGE","Truppe in un altro villaggio");
tz_def("TROOPS_IN_OASIS","Truppe nell'oasi");
tz_def("KILL","Uccisione");
tz_def("FROM","Da");
tz_def("SEND_TROOPS","Invia truppe");
tz_def("TASKMASTER","Compito");
tz_def("VILLAGE_OF_THE_ELDERS_TROOPS","villaggio delle truppe degli anziani");

//SEND TROOP
tz_def("REINFORCE","Rinforzo");
tz_def("NORMALATTACK","Attacco normale");
tz_def("RAID","Raid");
tz_def("OR","o");
tz_def("SENDTROOP","Invia truppe");
tz_def("TROOP","Truppe");
tz_def("NOTROOP","nessuna truppa");

//map
tz_def("DETAIL","Dettagli");
tz_def("ABANDVALLEY","Valle abbandonata");
tz_def("OCCUPIED","Occupato");
tz_def("UNOCCUPIED","Non occupato");
tz_def("UNOCCUOASIS","Oasi non occupata");
tz_def("OCCUOASIS","Oasi occupata");
tz_def("THERENOINFO","Non ci sono<br>informazioni disponibili.");
tz_def("LANDDIST","Distribuzione della terra");
tz_def("TRIBE","Tribù");
tz_def("ALLIANCE","Alleanza");
tz_def("POP","Popolazione");
tz_def("REPORT","Rapporto");
tz_def("OPTION","Opzioni");
tz_def("CENTREMAP","Mappa centrale");
tz_def("FNEWVILLAGE","Trovato nuovo villaggio");
tz_def("CULTUREPOINT","punti di cultura");
tz_def("BUILDRALLY","costruire un punto di raccolta");
tz_def("SETTLERSAVAIL","coloni disponibili");
tz_def("BEGINPRO","protezione dei principianti");
tz_def("SENDMERC","Invia commerciante(i)");
tz_def("BAN","Il giocatore è bannato");
tz_def("BUILDMARKET","Costruisci il mercato");
tz_def("PERHOUR","all'ora");
tz_def("BONUS","Bonus");
tz_def("MAP","Mappa");
tz_def("CROPFINDER","Trovato raccolto");
tz_def("NORTH","Nord");
tz_def("EAST","Est");
tz_def("SOUTH","Sud");
tz_def("WEST","Ovest");

//other
tz_def("VILLAGE","Villaggio");
tz_def("OASIS","Oasi");
tz_def("NO_OASIS", "Non sei proprietario di nessuna oasi.");
tz_def("NO_VILLAGES", "Non ci sono villaggi.");
tz_def("PLAYER","Giocatori");

//LOGIN.php
tz_def("COOKIES","Devi avere i cookie abilitati per poter accedere. Se condividi questo computer con altre persone, dovresti disconnetterti dopo ogni sessione per la tua sicurezza.");
tz_def("NAME","Nome");
tz_def("PW_FORGOTTEN","Password dimenticata?");
tz_def("PW_REQUEST","Quindi puoi richiederne una nuova che verrà inviato al tuo indirizzo email.");
tz_def("PW_GENERATE","Generate nuova password.");
tz_def("EMAIL_NOT_VERIFIED","Email non verificata!");
tz_def("EMAIL_FOLLOW","Segui questo link per attivare il tuo account.");
tz_def("VERIFY_EMAIL","Verifica Email.");
tz_def("SERVER_STARTS_IN","Server verrà avviato in: ");
tz_def("START_NOW","Inizia Ora");


//404.php
tz_def("NOTHING_HERE","Niente qui!");
tz_def("WE_LOOKED","Abbiamo già cercato 404 volte ma non riusciamo a trovare nulla");

//TIME RELATED
tz_def("CALCULATED","Calcolato in");
tz_def("SERVER_TIME","Server time:");

//MASSMESSAGE.php
tz_def("MASS","Contenuto del messaggio");
tz_def("MASS_SUBJECT","Oggetto:");
tz_def("MASS_COLOR","Colore messaggio:");
tz_def("MASS_REQUIRED","Tutti i campi richiesti");
tz_def("MASS_UNITS","Immagini (unità):");
tz_def("MASS_SHOWHIDE","Mostra/Nascondi");
tz_def("MASS_READ","Leggi questo: dopo aver aggiunto la faccina, devi aggiungere sinistra o destra dopo il numero, altrimenti l'immagine non funzionerà");
tz_def("MASS_CONFIRM","Conferma");
tz_def("MASS_REALLY","Vuoi davvero inviare MassIGM?");
tz_def("MASS_ABORT","Interruzione in questo momento");
tz_def("MASS_SENT","Mass IGM è stata inviata");

//BUILDINGS
tz_def("WOODCUTTER","Falegnameria");
tz_def("CLAYPIT","Cava di argilla");
tz_def("IRONMINE","Miniera di ferro");
tz_def("CROPLAND","Terreno coltivato");

tz_def("SAWMILL","Segheria");
tz_def("SAWMILL_DESC","Qui viene lavorato il legno consegnato dai tuoi taglialegna. In base al suo livello, la tua segheria può aumentare la produzione di legno fino al 25%.");
tz_def("CURRENT_WOOD_BONUS","Bonus legno attuale:");
tz_def("WOOD_BONUS_LEVEL","Bonus legno a livello");
tz_def("MAX_LEVEL","Immobile già a livello massimo");
tz_def("PERCENT","Per cento");

tz_def("BRICKYARD","Mattone");
tz_def("CURRENT_CLAY_BONUS","Bonus in argilla attuale:");
tz_def("CLAY_BONUS_LEVEL","Bonus di argilla a livello");
tz_def("BRICKYARD_DESC","Qui l'argilla viene trasformata in mattoni. In base al suo livello, la tua fornace può aumentare la tua produzione di argilla fino al 25%..");

tz_def("IRONFOUNDRY","Fonderia di ferro");
tz_def("CURRENT_IRON_BONUS","Bonus di ferro attuale:");
tz_def("IRON_BONUS_LEVEL","Bonus Ferro a livello");
tz_def("IRONFOUNDRY_DESC","Il ferro viene fuso qui. In base al suo livello, la tua fonderia di ferro può aumentare la tua produzione di ferro fino al 25%.");

tz_def("GRAINMILL","Mulino per cereali");
tz_def("CURRENT_CROP_BONUS","Bonus raccolto attuale:");
tz_def("CROP_BONUS_LEVEL","Bonus raccolto a livello");
tz_def("GRAINMILL_DESC","Qui il tuo grano viene macinato per produrre farina. In base al suo livello, il tuo mulino per cereali può aumentare la produzione del raccolto fino al 25 percento.");

tz_def("BAKERY","Forno");
tz_def("BAKERY_DESC","Qui la farina prodotta nel vostro mulino viene utilizzata per cuocere il pane. Inoltre con il mulino per cereali l'aumento della produzione agricola può arrivare fino al 50 percento.");

tz_def("WAREHOUSE","Magazzino");
tz_def("CURRENT_CAPACITY","Capacità attuale:");
tz_def("CAPACITY_LEVEL","Capacità a livello");
tz_def("RESOURCE_UNITS","Unità di risorse");
tz_def("WAREHOUSE_DESC","Le risorse legno, argilla e ferro sono immagazzinate nel tuo Magazzino. Aumentando il suo livello aumenterai la capacità del tuo Magazzino.");

tz_def("GRANARY","Granaio");
tz_def("CROP_UNITS","Unità di raccolto");
tz_def("GRANARY_DESC","Il raccolto prodotto dalle tue fattorie viene immagazzinato nel Granaio. Aumentando il suo livello aumenterai la capacità del Granaio.");

tz_def("BLACKSMITH","Fabbro");
tz_def("ACTION","Azione");
tz_def("UPGRADE","Miglioramento");
tz_def("UPGRADE_IN_PROGRESS","Miglioramento in<br>corso");
tz_def("UPGRADE_BLACKSMITH","Miglioramento<br>fabbro");
tz_def("UPGRADES_COMMENCE_BLACKSMITH","I miglioramenti possono iniziare quando il fabbro è completato.");
tz_def("MAXIMUM_LEVEL","Massimo<br>livello");
tz_def("EXPAND_WAREHOUSE","Espandi<br>magazzino");
tz_def("EXPAND_GRANARY","Espandi<br>granaio");
tz_def("ENOUGH_RESOURCES","Abbastanza risorse");
tz_def("CROP_NEGATIVE ","La produzione delle colture è negativa, quindi non raggiungerai mai le risorse richieste");
tz_def("TOO_FEW_RESOURCES","Troppo poche<br>risorse");
tz_def("UPGRADING","Miglioramento");
tz_def("DURATION","Durata");
tz_def("COMPLETE","Completata");
tz_def("BLACKSMITH_DESC","Nelle fornaci del fabbro vengono potenziate le armi dei tuoi guerrieri. Aumentando il suo livello puoi ordinare la fabbricazione di armi ancora migliori.");

tz_def("ARMOURY","Armeria");
tz_def("UPGRADE_ARMOURY","Migliora<br>Armeria");
tz_def("UPGRADES_COMMENCE_ARMOURY","Gli aggiornamenti possono iniziare quando l'armeria è completata.");
tz_def("ARMOURY_DESC","Nelle fornaci dell'armeria viene potenziata l'armatura dei tuoi guerrieri. Aumentando il suo livello puoi ordinare la fabbricazione di armature ancora migliori.");

tz_def("TOURNAMENTSQUARE","Piazza del Torneo");
tz_def("CURRENT_SPEED","Bonus velocità attuale:");
tz_def("SPEED_LEVEL","Bonus livello velocità");
tz_def("TOURNAMENTSQUARE_DESC","Nella Piazza del Torneo le tue truppe possono allenare la loro resistenza. Più l'edificio viene aggiornato, più velocemente le tue truppe superano una distanza minima di ".TS_THRESHOLD."  piazze.");

tz_def("MAINBUILDING","Palazzo principale");
tz_def("CURRENT_CONSTRUCTION_TIME","Tempo di costruzione attuale:");
tz_def("CONSTRUCTION_TIME_LEVEL","Tempo di costruzione a livello");
tz_def("DEMOLITION_BUILDING","Demolizione dell'edificio:</h2><p>Se non hai più bisogno di un edificio, puoi ordinare la demolizione dell'edificio.</p>");
tz_def("DEMOLISH","Demolire");
tz_def("DEMOLITION_OF","Demolizione di ");
tz_def("MAINBUILDING_DESC","Nell'edificio principale abitano i capomastri del paese. Più alto è il suo livello, più velocemente i tuoi capomastri completeranno la costruzione di nuovi edifici.");

tz_def("RALLYPOINT","Punto di raduno");
tz_def("RALLYPOINT_COMMENCE","Il movimento delle truppe verrà visualizzato quando il ".RALLYPOINT." è completato");
tz_def("OVERVIEW","Panoramica");
tz_def("REINFORCEMENT","Rinforzo");
tz_def("EVASION_SETTINGS","impostazioni di evasione");
tz_def("SEND_TROOPS_AWAY_MAX","Manda le truppe via un massimo di");
tz_def("TIMES","volte");
tz_def("PER_EVASION","per evasione");
tz_def("RALLYPOINT_DESC","Le truppe del tuo villaggio si incontrano qui. Da qui puoi inviarli a conquistare, razziare o rinforzare altri villaggi.");

tz_def("MARKETPLACE","Mercato");
tz_def("MERCHANT","mercanti");
tz_def("OR_","o");
tz_def("GO","andare");
tz_def("UNITS_OF_RESOURCE","unità di risorse");
tz_def("MERCHANT_CARRY","Ogni commerciante può trasportare");
tz_def("MERCHANT_COMING","Mercanti in arrivo");
tz_def("TRANSPORT_FROM","Trasporto da");
tz_def("ARRIVAL_IN","Arrivo a");
tz_def("NO_COORDINATES_SELECTED","Nessuna coordinata selezionata");
tz_def("CANNOT_SEND_RESOURCES","Non puoi inviare risorse allo stesso villaggio");
tz_def("BANNED_CANNOT_SEND_RESOURCES","Il giocatore viene bannato. Non puoi inviargli risorse");
tz_def("RESOURCES_NO_SELECTED","Risorse non selezionate");
tz_def("ENTER_COORDINATES","Inserisci le coordinate o il nome del villaggio");
tz_def("TOO_FEW_MERCHANTS","Troppo pochi commercianti");
tz_def("OWN_MERCHANTS_ONWAY","Proprio mercanti in arrivo");
tz_def("MERCHANTS_RETURNING","Mercanti di ritorno");
tz_def("TRANSPORT_TO","Trasporto a");
tz_def("I_AN_SEARCHING","sto cercando");
tz_def("I_AN_OFFERING","Sto offrendo");
tz_def("OFFERS_MARKETPLACE","Offerte al mercato");
tz_def("NO_AVAILABLE_OFFERS","Nessuna offerta sul mercato");
tz_def("OFFERED_TO_ME","Offerto<br>da me");
tz_def("WANTED_TO_ME","Voleva<br>me");
tz_def("NOT_ENOUGH_MERCHANTS","Mercante non abbastanza");
tz_def("ACCEP_OFFER","Accettare un'offerta");
tz_def("NO_AVALIBLE_OFFERS","Non ci sono offerte disponibili sul mercato");
tz_def("SEARCHING","Ricerca");
tz_def("OFFERING","Offerta");
tz_def("MAX_TIME_TRANSPORT","max. tempo di trasporto");
tz_def("OWN_ALLIANCE_ONLY","solo la propria alleanza");
tz_def("INVALID_OFFER","Offerta non valida");
tz_def("INVALID_MERCHANTS_REPETITION","Tasso di ripetizione dei commercianti non valido");
tz_def("USER_ON_VACATION","L'utente è in modalità vacanza");
tz_def("NOT_ENOUGH_RESOURCES","non abbastanza risorse");
tz_def("OFFER","Offerta");
tz_def("SEARCH","Ricerca");
tz_def("OWN_OFFERS","Offerte proprie");
tz_def("ALL","Tutti");
tz_def("NPC_TRADE","Commercio di NPC");
tz_def("SUM","Somma");
tz_def("REST","riposo");
tz_def("TRADE_RESOURCES","Scambia risorse a (passaggio 2 di 2)");
tz_def("DISTRIBUTE_RESOURCES","Distribuisci risorse a (passaggio 1 di 2)");
tz_def("OF","di");
tz_def("NPC_COMPLETED","NPC completato");
tz_def("BACK_BUILDING","Torna a costruire");
tz_def("YOU_CAN_NAT_NPC_WW","Non puoi usare il commercio di NPC nel villaggio di WW.");
tz_def("NPC_TRADING","Commercio di NPC");
tz_def("SEND_RESOURCES","Invia risorse");
tz_def("BUY","Acquistare");
tz_def("TRADE_ROUTES","Rotte commerciali");
tz_def("DESCRIPTION","Descrizione");
tz_def("TIME_LEFT","Tempo rimasto");
tz_def("START","Inizio");
tz_def("NO_TRADE_ROUTES","Nessuna rotta commerciale attiva");
tz_def("TRADE_ROUTE_TO","Via commerciale verso");
tz_def("CHECKED","controllato");
tz_def("DAYS","Giorni");
tz_def("EXTEND","Estendere");
tz_def("EDIT","Modificare");
tz_def("EXTEND_TRADE_ROUTES","Estendi la rotta commerciale di <b>7</b> giorni per");
tz_def("CREATE_TRADE_ROUTES","Crea una nuova rotta commerciale");
tz_def("DELIVERIES","Consegne");
tz_def("START_TIME_TRADE","Ora di inizio");
tz_def("CREATE_TRADE_ROUTE","Crea rotta commerciale");
tz_def("TARGET_VILLAGE","Villaggio bersaglio");
tz_def("EDIT_TRADE_ROUTES","Modifica rotta commerciale");
tz_def("TRADE_ROUTES_DESC","La rotta commerciale ti consente di impostare percorsi per il tuo commerciante che percorrerà ogni giorno a una certa ora. <br /><br /> Standard per cui questo vale <b>7</b> giorni, ma puoi prolungarlo con <b>7</b> giorni al costo di");
tz_def("NPC_TRADE_DESC","Con il commerciante NPC puoi distribuire le risorse nel tuo magazzino come desideri. <br /><br /> La prima riga mostra lo stock corrente. Nella seconda riga puoi scegliere un'altra distribuzione. La terza riga mostra la differenza tra il vecchio e il nuovo stock.");
tz_def("MARKETPLACE_DESC","Al Marketplace puoi scambiare risorse con altri giocatori. Più alto è il suo livello, più risorse possono essere trasportate contemporaneamente.");

tz_def("EMBASSY","Ambasciata");
tz_def("TAG","Etichetta");
tz_def("TO_THE_ALLIANCE","all'alleanza");
tz_def("JOIN_ALLIANCE","unisciti all'alleanza");
tz_def("REFUSE","rifiuta");
tz_def("ACCEPT","accetta");
tz_def("NO_INVITATIONS","Non ci sono inviti disponibili.");
tz_def("NO_CREATE_ALLIANCE","Un utente bannato non può creare un alleanza.");
tz_def("FOUND_ALLIANCE","trova alleanza");
tz_def("EMBASSY_DESC","L'ambasciata è un posto per diplomatici. PPiù alto è il suo livello più opzioni ottiene il re.");

tz_def("BARRACKS","Caserma");
tz_def("QUANTITY","Quantità");
tz_def("MAX","Massimo");
tz_def("TRAINING","Addestramento");
tz_def("FINISHED","Finito");
tz_def("UNIT_FINISHED","La prossima unità sarà finitaLa prossima unità sarà finita in");
tz_def("AVAILABLE","Disponibile");
tz_def("TRAINING_COMMENCE_BARRACKS","La formazione può iniziare quando la caserma è completata.");
tz_def("BARRACKS_DESC","Tutti i fanti sono addestrati in caserma. Più alto è il livello della caserma, più velocemente vengono addestrate le truppe.");

tz_def("STABLE","Scuderia");
tz_def("AVAILABLE_ACADEMY","Nessuna unità disponibile. Ricerca in accademia");
tz_def("TRAINING_COMMENCE_STABLE","L'addestramento può iniziare quando la scuderia è completata.");
tz_def("STABLE_DESC","La cavalleria può essere addestrata nelle scuderie. Più alto è il suo livello, più velocemente vengono addestrate le truppe.");

tz_def("WORKSHOP","Officina");
tz_def("TRAINING_COMMENCE_WORKSHOP","L'addestramento può iniziare al termine del workshop.");
tz_def("WORKSHOP_DESC","In officina possono essere costruiti strumenti d'assedio come catapulte e arieti. Più alto è il suo livello, più velocemente vengono prodotte le unità.");

tz_def("ACADEMY","Accademia");
tz_def("RESEARCH_AVAILABLE","Non ci sono ricerche disponibili");
tz_def("RESEARCH_COMMENCE_ACADEMY","La ricerca può iniziare quando l'accademia è completata.");
tz_def("RESEARCH","Ricerca");
tz_def("EXPAND_WAREHOUSE1","Espandi magazzino");
tz_def("EXPAND_GRANARY1","Espandi granaio");
tz_def("RESEARCH_IN_PROGRESS","Research in<br>progresso");
tz_def("RESEARCHING","Ricerca");
tz_def("PREREQUISITES","Prerequisiti");
tz_def("SHOW_MORE","mostra di più");
tz_def("HIDE_MORE","nascondi di più");
tz_def("ACADEMY_DESC","Nell'accademia è possibile ricercare nuovi tipi di unità. Aumentando il suo livello puoi ordinare la ricerca di unità migliori.");

tz_def("CRANNY","Botola");
tz_def("CURRENT_HIDDEN_UNITS","Unità attualmente nascoste per risorsa:");
tz_def("HIDDEN_UNITS_LEVEL","Unità nascoste per risorsa a livello");
tz_def("UNITS","unità");
tz_def("CRANNY_DESC","La botola viene utilizzata per nascondere alcune delle tue risorse quando il villaggio viene attaccato. Queste risorse non possono essere rubate.");

tz_def("TOWNHALL","Municipio");
tz_def("CELEBRATIONS_COMMENCE_TOWNHALL","Le celebrazioni possono iniziare quando il municipio è terminato.");
tz_def("GREAT_CELEBRATIONS","Grande festa");
tz_def("CULTURE_POINTS","Punti cultura");
tz_def("HOLD","presa");
tz_def("CELEBRATIONS_IN_PROGRESS","Celebrazione<br />in corso");
tz_def("CELEBRATIONS","Celebrazioni");
tz_def("TOWNHALL_DESC","Puoi tenere feste pompose nel municipio. Una tale celebrazione aumenta i tuoi punti cultura. Portare il tuo municipio a un livello più alto ridurrà la durata della celebrazione.");

tz_def("RESIDENCE","Residenza");
tz_def("CAPITAL","Questa è la tua capitale");
tz_def("RESIDENCE_TRAIN_DESC","Per fondare un nuovo villaggio è necessaria una residenza di livello 10 o 20 e 3 coloni. Per conquistare un nuovo villaggio è necessaria una residenza di livello 10 o 20 e un senatore, capo o capotribù.");
tz_def("PRODUCTION_POINTS","Produzione di questo villaggio:");
tz_def("PRODUCTION_ALL_POINTS","Produzione di tutti i villaggi:");
tz_def("POINTS_DAY","Punti cultura al giorno");
tz_def("VILLAGES_PRODUCED","I vostri villaggi hanno prodotto");
tz_def("POINTS_NEED","punti in totale. Per fondare o conquistare un nuovo villaggio è necessario");
tz_def("POINTS","punti");
tz_def("INHABITANTS","Abitanti");
tz_def("COORDINATES","Coordinate");
tz_def("EXPANSION","Espansione");
tz_def("TRAIN","Treno");
tz_def("DATE","Data");
tz_def("CONQUERED_BY_VILLAGE","Borghi fondati o conquistati da questo villaggio");
tz_def("NONE_CONQUERED_BY_VILLAGE","Nessun altro villaggio è stato ancora fondato o conquistato da questo villaggio.");
tz_def("RESIDENCE_CULTURE_DESC","Per estendere il tuo impero hai bisogno di punti cultura. Questi punti cultura aumentano nel corso del tempo e lo fanno più velocemente all'aumentare dei livelli di costruzione.");
tz_def("RESIDENCE_LOYALTY_DESC","Attaccando con senatori, capi o capi, la lealtà di un villaggio può essere ridotta. Se raggiunge lo zero, il villaggio si unisce al regno dell'attaccante. La lealtà di questo villaggio è attualmente a ");
tz_def("RESIDENCE_DESC","La residenza è un piccolo palazzo, dove vive il re o la regina quando visita il villaggio. La residenza protegge il villaggio dai nemici che vogliono conquistarlo.");

tz_def("PALACE","Palazzo");
tz_def("PALACE_CONSTRUCTION","Palazzo in costruzione");
tz_def("PALACE_TRAIN_DESC","Per fondare un nuovo villaggio hai bisogno di un palazzo di livello 10, 15 o 20 e 3 coloni. Per conquistare un nuovo villaggio è necessario un palazzo di livello 10, 15 o 20 e un senatore, capo o capotribù.");
tz_def("CHANGE_CAPITAL","cambiare capitale");
tz_def("SECURITY_CHANGE_CAPITAL","Sei sicuro di voler cambiare il tuo capitale?<br /><b>Non puoi annullare questo!</b><br />Per sicurezza è necessario inserire la password per confermare:<br />");
tz_def("PALACE_DESC","Il re o la regina dell'impero vive nel palazzo. Nel tuo regno può esistere un solo palazzo alla volta. Hai bisogno di un palazzo per proclamare un villaggio come tua capitale.");

tz_def("TREASURY","Tesoro");
tz_def("TREASURY_COMMENCE","Gli artefatti possono essere visualizzati una volta completata la tesoreria.");
tz_def("ARTIFACTS_AREA","Manufatti nella tua zona");
tz_def("NO_ARTIFACTS_AREA","Non ci sono manufatti nella tua zona.");
tz_def("OWN_ARTIFACTS","Propri manufatti");
tz_def("CONQUERED","Conquistato");
tz_def("DISTANCE","Distanza");
tz_def("EFFECT","Effetto");
tz_def("ACCOUNT","Account");
tz_def("SMALL_ARTIFACTS","Piccoli manufatti");
tz_def("LARGE_ARTIFACTS","Grandi manufatti");
tz_def("NO_ARTIFACTS","Non ci sono manufatti.");
tz_def("ANY_ARTIFACTS","Non possiedi alcun manufatto.");
tz_def("OWNER","Proprietario");
tz_def("AREA_EFFECT","Area d'effetto");
tz_def("VILLAGE_EFFECT","Effetto villaggio");
tz_def("ACCOUNT_EFFECT","Effetto conto");
tz_def("UNIQUE_EFFECT","Effetto unico");
tz_def("REQUIRED_LEVEL","Livello richiesto");
tz_def("TIME_CONQUER","Tempo di conquista");
tz_def("TIME_ACTIVATION","Tempo di attivazione");
tz_def("NEXT_EFFECT"," Prossimo effetto");
tz_def("FORMER_OWNER","Ex proprietario/i");
tz_def("BUILDING_STRONGER","Costruire meglio con");
tz_def("BUILDING_WEAKER","Costtruire meno con");
tz_def("TROOPS_FASTER","Rende le truppe più veloci con");
tz_def("TROOPS_SLOWEST","Rende le truppe più lente con");
tz_def("SPIES_INCREASE","Le spie aumentano l'abilità con");
tz_def("SPIES_DECRESE","Le spie diminuiscono l'abilità con");
tz_def("CONSUME_LESS","Tutte le truppe consumano meno con");
tz_def("CONSUME_HIGH","Tutte le truppe consumano di più con");
tz_def("TROOPS_MAKE_FASTER","Le truppe sono più veloci");
tz_def("TROOPS_MAKE_SLOWEST","Le truppe sono più lente");
tz_def("YOU_CONSTRUCT","Puoi costruire ");
tz_def("CRANNY_INCREASED","La capacità della botola è aumentata di");
tz_def("CRANNY_DECRESE","La capacità della botola è diminuita di");
tz_def("WW_BUILDING_PLAN","Puoi costruire la Meraviglia del Mondo");
tz_def("NO_WW","Non ci sono meraviglie del mondo");
tz_def("NO_PREVIOUS_OWNERS","Non ci sono precedenti proprietari.");
tz_def("TREASURY_DESC","Le ricchezze del tuo impero sono custodite nella tesoreria. La tesoreria ha spazio per un tesoro. Dopo aver catturato un manufatto, ci vogliono 24 ore su un server normale o 12 ore su un server a tre velocità per essere efficace.");

tz_def("TRADEOFFICE","Ufficio commerciale");
tz_def("CURRENT_MERCHANT","Carico mercantile attuale:");
tz_def("MERCHANT_LEVEL","Carico mercantile a livello");
tz_def("TRADEOFFICE_DESC","Nell'ufficio commerciale i carri dei mercanti vengono migliorati e dotati di potenti cavalli. Più alto è il suo livello, più i tuoi mercanti sono in grado di trasportare.");

tz_def("GREATBARRACKS","Grandi Caserme");
tz_def("TRAINING_COMMENCE_GREATBARRACKS","L'addestramento può iniziare quando la grande caserma è completata.");
tz_def("GREATBARRACKS_DESC","I fanti vengono addestrati nelle grandi caserme. Più alto è il livello della caserma, più velocemente vengono addestrate le truppe.");

tz_def("GREATSTABLE","Grande stabile");
tz_def("TRAINING_COMMENCE_GREATSTABLE","L'addestramento' può iniziare quando la grande scuderia è completata.");
tz_def("GREATSTABLE_DESC","La cavalleria può essere addestrata nella grande stalla. Più alto è il suo livello, più velocemente vengono addestrate le truppe.");

tz_def("CITYWALL","Mura cittadine");
tz_def("DEFENCE_NOW","Bonus Difesa:");
tz_def("DEFENCE_LEVEL","Bonus Difesa a livello");
tz_def("CITYWALL_DESC","Costruendo una cinta muraria puoi proteggere il tuo villaggio dalle orde barbariche dei tuoi nemici.Più alto è il livello del muro, maggiore sarà il bonus dato alla difesa delle tue forze.");

tz_def("EARTHWALL","Muro di Terra");
tz_def("EARTHWALL_DESC","Costruendo un muro di terra puoi proteggere il tuo villaggio dalle orde barbariche dei tuoi nemici. Più alto è il livello del muro, maggiore sarà il bonus dato alla difesa delle tue forze.");

tz_def("PALISADE","Palizzata");
tz_def("PALISADE_DESC","Costruendo una palizzata puoi proteggere il tuo villaggio dalle orde barbariche dei tuoi nemici. Più alto è il livello del muro, maggiore sarà il bonus dato alla difesa delle tue forze.");

tz_def("STONEMASON","Loggia dello scalpellino");
tz_def("CURRENT_STABILITY","Bonus di stabilità attuale:");
tz_def("STABILITY_LEVEL","Bonus di stabilità a livello");
tz_def("STONEMASON_DESC","La loggia dello scalpellino è un esperto nel tagliare la pietra. Più l'edificio aumenta di livello, maggiore è la stabilità degli edifici del villaggio.");

tz_def("BREWERY","Birrificio");
tz_def("CURRENT_BONUS","Bonus attuale:");
tz_def("BONUS_LEVEL","Bonus a livello");
tz_def("BREWERY_DESC","Il gustoso idromele viene prodotto nella fabbrica di birra e poi bevuto dai soldati durante le celebrazioni.");

tz_def("TRAPPER","Cacciatore");
tz_def("CURRENT_TRAPS","Massime trappole da addestrare:");
tz_def("TRAPS_LEVEL","Massime trappole per allenarsi a livello");
tz_def("TRAPS","Trappole");
tz_def("TRAP","Trappola");
tz_def("CURRENT_HAVE","Attualmente hai");
tz_def("WHICH_OCCUPIED","di cui sono occupati.");
tz_def("TRAINING_COMMENCE_TRAPPER","L'addestramento può iniziare quando il cacciatore è completato.");
tz_def("TRAPPER_DESC","Il cacciatore protegge il tuo villaggio con trappole ben nascoste. Ciò significa che i nemici incauti possono essere imprigionati e non saranno più in grado di danneggiare il tuo villaggio.");

tz_def("HEROSMANSION","Palazzo dell'Eroe");
tz_def("HERO_READY","L'eroe sarà pronto ");
tz_def("NAME_CHANGED","Il nome dell'eroe è stato cambiato");
tz_def("NOT_UNITS","Unità non disponibili");
tz_def("NOT","Non ");
tz_def("TRAIN_HERO","Addestra un nuovo eroe");
tz_def("REVIVE","Rianima");
tz_def("OASES","Oasi");
tz_def("DELETE","Elimina");
tz_def("RESOURCES","Risorse");
tz_def("OFFENCE","Offesa");
tz_def("DEFENCE","Difesa");
tz_def("OFF_BONUS","Bonus extra");
tz_def("DEF_BONUS","Bonus Def");
tz_def("REGENERATION","Rigenerazione");
tz_def("DAY","Giorno");
tz_def("EXPERIENCE","Esperienza");
tz_def("YOU_CAN","Puoi ");
tz_def("RESET","Ripristina");
tz_def("YOUR_POINT_UNTIL"," i tuoi punti fino a raggiungere il livello ");
tz_def("OR_LOWER"," o inferiore!");
tz_def("YOUR_HERO_HAS","Il tuo eroe ha ");
tz_def("OF_HIT_POINTS","dei suoi punti vita");
tz_def("ERROR_NAME_SHORT","Errore: nome troppo corto");
tz_def("HEROSMANSION_DESC","Nel palazzo dell'eroe puoi addestrare il tuo eroe e ai livelli 10, 15 e 20 puoi conquistare oasi con l'eroe nelle immediate vicinanze.");

tz_def("GREATWAREHOUSE","Grande Magazzino");
tz_def("GREATWAREHOUSE_DESC","Legno, argilla e ferro sono stoccati nel magazzino. Il grande magazzino ti offre più spazio e mantiene le tue merci più asciutte e sicure rispetto a quelle normali.");

tz_def("GREATGRANARY","Grande Granaio");
tz_def("GREATGRANARY_DESC","Il raccolto prodotto dalle tue fattorie viene immagazzinato nel granaio. Il grande granaio ti offre più spazio e mantiene i tuoi raccolti più asciutti e sicuri di quello normale.");

tz_def("WONDER","Meraviglia del mondo");
tz_def("WORLD_WONDER","Meraviglia del mondo");
tz_def("WONDER_DESC","La meraviglia è meravigliosa come sembra. Questo edificio è costruito per vincere il server. Ogni livello della meraviglia del mondo costa centinaia di migliaia (anche milioni) di risorse per essere costruito.");
tz_def("WORLD_WONDER_CHANGE_NAME","Devi avere Meraviglia del mondo di livello 1 per poter cambiare il suo nome");
tz_def("WORLD_WONDER_NAME","Nome meraviglia del mondo");
tz_def("WORLD_WONDER_NOTCHANGE_NAME","Non puoi cambiare il nome della Meraviglia del mondo dopo il livello 10");
tz_def("WORLD_WONDER_NAME_CHANGED","Nome cambiato");

tz_def("HORSEDRINKING","Abbeveratoio per cavalli");
tz_def("HORSEDRINKING_DESC","L'abbeveratoio per cavalli dei romani riduce il tempo di addestramento della cavalleria e anche il mantenimento di queste truppe.");

tz_def("GREATWORKSHOP","Grande Officina");
tz_def("TRAINING_COMMENCE_GREATWORKSHOP","La formazione può iniziare quando il grande workshop è completato.");
tz_def("GREATWORKSHOP_DESC","Macchine d'assedio come catapulte e arieti possono essere costruite nella grande officina. Più alto è il suo livello, più velocemente vengono prodotte le unità.");

tz_def("BUILDING_MAX_LEVEL_UNDER","Edificio di livello massimo in costruzione");
tz_def("BUILDING_BEING_DEMOLISHED","Edificio attualmente in fase di demolizione");
tz_def("COSTS_UPGRADING_LEVEL","Costi</b> per l'aggiornamento al livello");
tz_def("WORKERS_ALREADY_WORK","Gli operai sono già al lavoro.");
tz_def("CONSTRUCTING_MASTER_BUILDER","Costruire con capomastro ");
tz_def("COSTS","Costi");
tz_def("GOLD","Oro");
tz_def("WORKERS_ALREADY_WORK_WAITING","Gli operai sono già al lavoro. (ciclo di attesa)");
tz_def("ENOUGH_FOOD_EXPAND_CROPLAND","Cibo insufficiente. Espandi i terreni coltivati.");
tz_def("UPGRADE_WAREHOUSE","Migliora il magazzino");
tz_def("UPGRADE_GRANARY","Migliora il granaio");
tz_def("YOUR_CROP_NEGATIVE","La tua produzione agricola è negativa, non otterrai mai le risorse richieste.");
tz_def("UPGRADE_LEVEL","Passa al livello ");
tz_def("WAITING","(ciclo di attesa)");
tz_def("NEED_WWCONSTRUCTION_PLAN","Hai bisogno del piano di costruzione della meraviglia");
tz_def("NEED_MORE_WWCONSTRUCTION_PLAN","Hai bisogno di più piano di costruzione della meraviglia");
tz_def("CONSTRUCT_NEW_BUILDING","Costruire nuovo edificio");
tz_def("SHOWSOON_AVAILABLE_BUILDINGS","mostra presto gli edifici disponibili");
tz_def("HIDESOON_AVAILABLE_BUILDINGS","nascondere edifici presto disponibili");

//artefact
tz_def("ARCHITECTS_DESC","Tutti gli edifici nell'area d'effetto sono più forti. Ciò significa che avrai bisogno di più catapulte per danneggiare gli edifici protetti da questi poteri artefatti.");
tz_def("ARCHITECTS_SMALL","Gli architetti leggero segreto");
tz_def("ARCHITECTS_SMALLVILLAGE","Scalpello diamantato");
tz_def("ARCHITECTS_LARGE","Il grande segreto degli architetti");
tz_def("ARCHITECTS_LARGEVILLAGE","Martello di marmo gigante");
tz_def("ARCHITECTS_UNIQUE","Il segreto unico degli architetti");
tz_def("ARCHITECTS_UNIQUEVILLAGE","Rotoli di Hemon");
tz_def("HASTE_DESC","Tutte le truppe nell'area d'effetto si muovono più velocemente.");
tz_def("HASTE_SMALL","I leggeri stivali di titano");
tz_def("HASTE_SMALLVILLAGE","Opale a ferro di cavallo");
tz_def("HASTE_LARGE","I grandi stivali di titano");
tz_def("HASTE_LARGEVILLAGE","Carro d'Oro");
tz_def("HASTE_UNIQUE","Gli esclusivi stivali di titano");
tz_def("HASTE_UNIQUEVILLAGE","Sandali Fidippide");
tz_def("EYESIGHT_DESC","Tutte le spie aumentano la loro capacità di spionaggio. Inoltre, con tutte le versioni di questo manufatto puoi vedere il TIPO di truppe in arrivo ma non quante sono.");
tz_def("EYESIGHT_SMALL","Le aquile occhi leggeri");
tz_def("EYESIGHT_SMALLVILLAGE","Racconto di un topo");
tz_def("EYESIGHT_LARGE","I grandi occhi delle aquile");
tz_def("EYESIGHT_LARGEVILLAGE","Lettera dei Generali");
tz_def("EYESIGHT_UNIQUE","Gli occhi unici delle aquile");
tz_def("EYESIGHT_UNIQUEVILLAGE","Diaio di Sun Tzu");
tz_def("DIET_DESC","Tutte le truppe nel raggio dei manufatti consumano meno grano, rendendo possibile mantenere un esercito più grande.");
tz_def("DIET_SMALL","Leggero controllo della dieta");
tz_def("DIET_SMALLVILLAGE","Piatto d'argento");
tz_def("DIET_LARGE","Ottimo controllo della dieta");
tz_def("DIET_LARGEVILLAGE","Arco da caccia sacro");
tz_def("DIET_UNIQUE","Controllo della dieta unico");
tz_def("DIET_UNIQUEVILLAGE","Calice di Re Arthur");
tz_def("ACADEMIC_DESC","Le truppe vengono costruite una certa percentuale più velocemente nell'ambito del manufatto.");
tz_def("ACADEMIC_SMALL","Gli allenatori poco talento");
tz_def("ACADEMIC_SMALLVILLAGE","Giuramento dei soldati Oath");
tz_def("ACADEMIC_LARGE","Grande talento degli allenatori");
tz_def("ACADEMIC_LARGEVILLAGE","Dichiarazione di guerra");
tz_def("ACADEMIC_UNIQUE","Il talento unico degli allenatori");
tz_def("ACADEMIC_UNIQUEVILLAGE","Memorie di Alessandro Magno");
tz_def("STORAGE_DESC","Con questo piano di costruzione puoi costruire il Grande Granaio o il Grande Magazzino nel Villaggio con il manufatto, o l'intero account a seconda del manufatto. Finché possiedi quell'artefatto, puoi costruire e ingrandire quegli edifici.");
tz_def("STORAGE_SMALL","Piano generale di stoccaggio leggero");
tz_def("STORAGE_SMALLVILLAGE","Schizzo dei costruttori");
tz_def("STORAGE_LARGE","Grande piano generale di archiviazione");
tz_def("STORAGE_LARGEVILLAGE","Tavoletta babilonese");
tz_def("CONFUSION_DESC","La capacità della botola è aumentata di una certa quantità per ogni tipo di manufatto. Le catapulte possono sparare casualmente solo sui villaggi all'interno di questo potere di artefatti. Le eccezioni sono la Meraviglia che può sempre essere presa di mira e la camera del tesoro che può sempre essere presa di mira, tranne che con l'artefatto unico. Quando si mira a un campo di risorse possono essere colpiti solo campi di risorse casuali, quando si mira a un edificio possono essere colpiti solo edifici casuali.");
tz_def("CONFUSION_SMALL","Rivali leggera confusione");
tz_def("CONFUSION_SMALLVILLAGE","Mappa delle caverne nascoste");
tz_def("CONFUSION_LARGE","Rivali grande confusione");
tz_def("CONFUSION_LARGEVILLAGE","Borsa senza fondo");
tz_def("CONFUSION_UNIQUE","Rivali confusione unica");
tz_def("CONFUSION_UNIQUEVILLAGE","Cavallo di Troia");
tz_def("FOOL_DESC","Ogni 24 ore ottiene un effetto casuale, un bonus o una penalità (tutti sono possibili con l'eccezione del grande magazzino, del grande granaio e dei piani di costruzione della Meraviglia). Cambiano effetto E portata ogni 24 ore. L'artefatto unico riceverà sempre bonus positivi.");
tz_def("FOOL_SMALL","Artefatto del piccolo sciocco");
tz_def("FOOL_SMALLVILLAGE","Ciondolo della malizia");
tz_def("FOOL_UNIQUE","Artefatto dell'unico sciocco");
tz_def("FOOL_UNIQUEVILLAGE","Manoscritto proibito");
tz_def("WWVILLAGE","Villaggio Meraviglia");
tz_def("ARTEFACT","<h1><b>Artefatti di Natar</b></h1>

Voci sussurrate riecheggiano nei villaggi, condividendo leggende raccontate solo dai migliori narratori. Si riferisce a NATARS, il guerriero più temuto del mondo TRAVIAN. La loro uccisione è il sogno di ogni eroe, lo scopo di ogni combattente. Nessuno sa come i NATARS siano riusciti a ottenere un tale potere e i loro guerrieri così crudeli. Determinati a scoprire la fonte del potere NATARS, i combattenti inviano un gruppo di spie d'élite per spiarli. Non passo molte ore e torno con la paura negli occhi e bilanciando teorie fantastiche: sembra che il potere naturale provenga dagli oggetti misteriosi che chiamano artefatti che hanno rubato ai nostri antenati. Cerca di rubare i loro artefatti e potrai controllarne il potere.

<img src=\"img/x.gif\" class=\"ArtifactsAnnouncement\">

È giunto il momento di reclamare i manufatti. Collabora con la tua alleanza e porta i tuoi guerrieri a ottenere questi oggetti ricercati. Tuttavia, NATARS non si arrenderà senza guerra ai manufatti ... né ai tuoi nemici. Se riesci a recuperare gli artefatti e sarai in grado di respingere i nemici, sarai in grado di raccogliere le ricompense. I tuoi edifici diventeranno incredibilmente forti e potenti, e le truppe saranno molto più veloci e consumeranno meno cibo. Cattura i manufatti, porta gloria al tuo impero e diventa una nuova leggenda per i tuoi seguaci.

Per rubarne uno, devono accadere le seguenti cose:

1. Devi attaccare il villaggio (NO Raid!)
2. VINCI l'attacco
3. Distruggi il tesoro
4. Una tesoreria vuota di livello 10 per PICCOLI MANUFATTI e di livello 20 per GRANDI MANUFATTI deve trovarsi nel villaggio da cui proveniva l'attacco
5. Avere un eroe in un attacco

In caso contrario, il prossimo attacco a quel villaggio, vincendo con un eroe e il tesoro vuoto, prenderà il manufatto.

Per costruire la Meraviglia, devi possedere tu stesso un piano (tu = il proprietario del villaggio Meraviglia) dal livello 0 al 50, dal 51 al 100 hai bisogno di un piano aggiuntivo nella tua alleanza! Due piani nell'account del villaggio Meraviglia non funzionerebbero!

I piani di costruzione sono conquistabili immediatamente quando compaiono sul server. 

Ci sarà un conto alla rovescia nel gioco, che mostra l'ora esatta del rilascio, 5 giorni prima del lancio. ");

//WW Village Release Message
tz_def("WWVILLAGEMSG","<h1><b>Meraviglia dei villaggi del mondo</b></h1>

Sono trascorsi innumerevoli giorni dalle prime battaglie sulle mura dei villaggi maledetti dei Dread Natars, molti eserciti sia di quelli liberi che dell'impero Natarian hanno lottato e sono morti davanti alle mura delle numerose roccaforti da cui un tempo i Natar avevano governato tutta la creazione . Ora che la polvere si era calmata e si era instaurata una relativa calma, gli eserciti cominciarono a contare le loro perdite e a raccogliere i loro morti, il fetore del combattimento ancora aleggiava nell'aria della notte, un odore di un massacro indimenticabile per la sua estensione e brutalità che presto sarebbe stato sminuito da altri ancora. I più grandi eserciti dei Liberi e dei Dread Natar si stavano schierando per l'ennesimo rinnovato assalto alle ambite ex roccaforti dell'Impero Natarian.
Presto arrivarono gli esploratori raccontando uno spettacolo fantastico e un ricordo agghiacciante, un terribile esercito di dimensioni insondabili era stato avvistato schierarsi alla fine del mondo, la capitale Natarian, una forza così grande e inarrestabile che la polvere della loro marcia avrebbe soffocato spegnere ogni luce, una forza così brutale e spietata che avrebbe schiacciato ogni speranza. Le persone libere sapevano che dovevano correre ora, correre contro il tempo e le infinite orde dell'Impero Natarian per sollevare una Meraviglia del Mondo per riportare il mondo alla pace e sconfiggere la minaccia Natarian.
Ma costruire una meraviglia così grande non sarebbe un compito facile, sarebbero necessari piani di costruzione creati in un lontano passato, piani di natura così arcana che anche il più saggio dei saggi non ne conosceva il contenuto o l'ubicazione.
Decine di migliaia di esploratori hanno vagato per tutta l'esistenza cercando invano questi piani mistici, cercando in tutti i luoghi tranne la temuta capitale Natarian, ma non sono riusciti a trovarli. Oggi però tornano portando buone notizie, tornano mettendo a nudo i luoghi dei piani, nascosti dagli eserciti dei Natar all'interno di roccaforti segrete costruite per essere celate agli occhi dell'uomo.
Ora inizia il tratto finale, quando i più grandi eserciti del Popolo Libero e dei Natar si scontreranno in tutto il mondo per il destino di tutto ciò che giace sotto il cielo. This is the war that will echo across the eons, this is your war, and here you shall etch your name across history, here you shall become legend.

<img src=\"img/x.gif\" class=\"WWVillagesAnnouncement\" title=\"".WWVILLAGE."\" alt=\"".WWVILLAGE."\">

Per conquistarne uno, devono accadere le seguenti cose:

1. Devi attaccare il villaggio (NO Raid!)
2. VINCI l'attacco
3. Distruggi la RESIDENZA
4. Devi ridurre la lealtà a 0 con : SENATORI , COMANDANTI , CAPI
5. Devi avere abbastanza punti cultura per conquistare il villaggio

In caso contrario, il prossimo attacco a quel villaggio, vincendo con SENATORI , COMANDANTI , CAPI e gli spazi vuoti in RESIDENZEE/PALAZZI occuperanno il villaggio.

Per costruire una meraviglia, devi possedere tu stesso un piano (tu = il proprietario del villaggio Meraviglia) dal livello 0 al 50, dal 51 al 100 hai bisogno di un piano aggiuntivo nella tua alleanza! Due piani nell'account del villaggio Meraviglia non funzionerebbero!

I piani di costruzione sono conquistabili immediatamente quando compaiono sul server. 

Ci sarà un conto alla rovescia nel gioco, che mostra l'ora esatta del rilascio, ".(5 / SPEED)." giorni prima del lancio. ");

//Building Plans
tz_def("PLAN","Piano di costruzione antico");
tz_def("PLANVILLAGE","Meraviglia Planimetria");
tz_def("PLAN_DESC","Con questo antico piano di costruzione sarai in grado di costruire una Meraviglia fino al livello 50. Per costruire ulteriormente, la tua alleanza deve contenere almeno due piani.");
tz_def("PLAN_INFO","<h1><b>Piani di costruzione delle meraviglie del mondo</b></h1>


Molte lune fa le tribù di Travian furono sorprese dall'imprevisto ritorno dei Natar. Questa tribù da tempi immemorabili che superava tutti in saggezza, potenza e gloria stava per turbare di nuovo i liberi. Così hanno messo tutti i loro sforzi nel preparare un'ultima guerra contro i Natar e sconfiggerli per sempre. Molti hanno pensato alle cosiddette 'Meraviglie del Mondo', costruzione di tante leggende, come unica soluzione. È stato detto che avrebbe reso chiunque invincibile una volta completato. Alla fine, i costruttori sono diventati i dominatori e i conquistatori di tutti i Travian conosciuti.

Tuttavia, è stato anche detto che sarebbero stati necessari piani di costruzione per costruire un edificio del genere. A causa di questo fatto, gli architetti hanno escogitato piani astuti su come conservarli in modo sicuro. Dopo un po', si potevano vedere edifici simili a templi in molte città e metropoli: le Camere del Tesoro (Tesoro). 

Purtroppo, nessuno - nemmeno i saggi e gli esperti - sapeva dove trovare questi piani di costruzione. Più le persone cercavano di localizzarli, più sembrava che fossero solo leggende. 

Oggi, però, quest'ultimo segreto verrà svelato. Le privazioni e gli sforzi del passato non saranno stati vani, poiché oggi gli esploratori di diverse tribù hanno ottenuto con successo dove si trovavano i piani di costruzione. Ben sorvegliati dai Natar, giacciono nascosti in diverse oasi che si trovano in tutta Travian. Solo gli eroi più valorosi saranno in grado di assicurarsi un tale piano e portarlo a casa sano e salvo in modo che la costruzione possa iniziare. 

Alla fine, vedremo se le tribù libere di Travian potranno ancora una volta superare in astuzia i Natar e sconfiggerli una volta per tutte. Non essere così sciocco da presumere che i Natar se ne andranno senza combattere!

<img src=\"img/x.gif\" class=\"WWBuildingPlansAnnouncement\" title=\"".PLAN."\" alt=\"".PLAN."\">

Per rubare una serie di piani di costruzione ai Natar, devono accadere le seguenti cose:
- Devi attaccare il villaggio (NON fare irruzione!)
- VINCI l'attacco
- Devi DISTRUGGERE la Camera del Tesoro (Tesoro)
- Il tuo eroe DEVE partecipare a quell'attacco, poiché è l'unico che può portare i piani di costruzione
- Una Camera del Tesoro (Tesoro) di livello 10 vuota DEVE trovarsi nel villaggio da cui proveniva l'attacco
NOTA: Se i criteri di cui sopra non vengono soddisfatti durante l'attacco, il prossimo attacco a quel villaggio che soddisfa i criteri di cui sopra prenderà i Piani di Costruzione.



Per costruire una Camera del Tesoro (Tesoro), avrai bisogno di un Edificio Principale di livello 10 e il villaggio NON DEVE contenere una Meraviglia del Mondo.

Per costruire una meraviglia del mondo, devi possedere tu stesso i piani di costruzione (tu = il proprietario del villaggio delle meraviglie del mondo) dal livello 0 al 50, quindi dal livello 51 al 100 avrai bisogno di un set aggiuntivo di piani di costruzione nella tua alleanza! Due serie di piani di costruzione nell'account Villaggio Meraviglia del Mondo non funzioneranno!");

//Admin setting - Admin/Templates/config.tpl & editServerSet.tpl
tz_def("EDIT_BACK","Indietro");
tz_def("SERV_CONFIG","Configurazione del server");
tz_def("SERV_SETT","Impostazioni del server");
tz_def("EDIT_SERV_SETT","Modifica le impostazioni del server");
tz_def("SERV_VARIABLE","Variabile");
tz_def("SERV_VALUE","Valore");
tz_def("CONF_SERV_NAME","Nome Server");
tz_def("CONF_SERV_NAME_TOOLTIP","Nome del server di gioco.");
tz_def("CONF_SERV_STARTED","Server avviato");
tz_def("CONF_SERV_STARTED_TOOLTIP","Ora in cui è stato avviato il server di gioco. Questo parametro non può essere modificato sul server di gioco installato.");
tz_def("CONF_SERV_TIMEZONE","Fuso orario del server");
tz_def("CONF_SERV_TIMEZONE_TOOLTIP","Fuso orario del server di gioco.");
tz_def("CONF_SERV_LANG","Lingua");
tz_def("CONF_SERV_LANG_TOOLTIP","La lingua utilizzata per impostazione predefinita nel pannello di amministrazione e per tutti sul server di gioco.");
tz_def("CONF_SERV_SERVSPEED","Velocità del server");
tz_def("CONF_SERV_SERVSPEED_TOOLTIP","La velocità del server di gioco. Maggiore è la velocità del server di gioco, più velocemente vengono costruiti tutti gli edifici, vengono effettuati gli studi e i miglioramenti nelle fucine, le truppe vengono costruite rapidamente e la produttività di tutte le risorse aumenta.");
tz_def("CONF_SERV_TROOPSPEED","Velocità delle truppe");
tz_def("CONF_SERV_TROOPSPEED_TOOLTIP","Velocità di movimento delle truppe sul server di gioco. Più alto è questo indicatore, più velocemente le truppe si muovono sulla mappa.");
tz_def("CONF_SERV_EVASIONSPEED","Velocità di ritorno");
tz_def("CONF_SERV_EVASIONSPEED_TOOLTIP","La velocità di ritorno è il tempo che le truppe trascorrono sulla strada per tornare a casa dopo aver effettuato un attacco.");
tz_def("CONF_SERV_STORMULTIPLER","Multiplo di archiviazione");
tz_def("CONF_SERV_STORMULTIPLER_TOOLTIP","Un moltiplicatore per la capacità di stoccaggio magazzino e granaio. Il valore 1 è pari alla capacità di 80.000 di ciascuna risorsa al livello massimo. Se imposti il ​​valore su 2, la capacità al livello massimo sarà 160.000 per ogni risorsa.<br><b>Note:</b> la quantità di risorse che verranno generate dalle oasi non occupate per il furto dipende da questo valore. Il valore predefinito è 800. Se si imposta il valore su 2, il numero massimo per ciascuna risorsa generata è 1600.");
tz_def("CONF_SERV_TRADCAPACITY","Capacità del commerciante");
tz_def("CONF_SERV_TRADCAPACITY_TOOLTIP","Un moltiplicatore per la capacità delle risorse che possono essere trasportate da un commerciante. Il valore di 1 equivale a 500 capacità per i Romani, 750 per i Galli, 1000 per i Teutoni. Se imposti il ​​valore su 2, la capacità delle risorse trasferite raddoppierà di conseguenza, 1000, 1500, 2000.");
tz_def("CONF_SERV_CRANCAPACITY","Capacità botola");
tz_def("CONF_SERV_CRANCAPACITY_TOOLTIP","Un moltiplicatore per la capacità delle risorse nella botola, che possono essere salvate dalla rapina. Il valore di 1 è pari a 1000 per Romani e Teutoni, 2000 per Galli. Se imposti il ​​valore su 2, la capacità della botola raddoppierà rispettivamente a 2000 e 4000.");
tz_def("CONF_SERV_TRAPCAPACITY","Capacità del cacciatore");
tz_def("CONF_SERV_TRAPCAPACITY_TOOLTIP","Un moltiplicatore per la capacità della trappola dei Galli, che può catturare i soldati nemici ancor prima di attaccare il villaggio. Il valore di 1 è pari alla capacità di 400 al livello 20 di costruzione. Se imposti il ​​valore su 2, la capacità sarà 800.");
tz_def("CONF_SERV_NATUNITSMULTIPLIER","Moltiplicatore unità natars");
tz_def("CONF_SERV_NATUNITSMULTIPLIER_TOOLTIP","Questo parametro è responsabile del numero di truppe di natars, su artefatti e villaggi meraviglia nel mondo.");
tz_def("CONF_SERV_NATARS_SPAWN_TIME","Generazione Natar");
tz_def("CONF_SERV_NATARS_SPAWN_TIME_TOOLTIP","Dopo quanto tempo Natar e artefatti verranno generati dalla data di inizio del server, in giorni");
tz_def("CONF_SERV_NATARS_WW_SPAWN_TIME","Generazione di meraviglie del mondo");
tz_def("CONF_SERV_NATARS_WW_SPAWN_TIME_TOOLTIP","Dopo quanto tempo verranno generati i villaggi WW dalla data di inizio del server, in giorni");
tz_def("CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME","Generazione del piano di costruzione WW");
tz_def("CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME_TOOLTIP","Dopo quanto tempo verranno generati i piani di costruzione WW dalla data di inizio del server, in giorni");
tz_def("CONF_SERV_MAPSIZE","Dimensione della mappa");
tz_def("CONF_SERV_MAPSIZE_TOOLTIP","La dimensione della mappa del mondo di gioco. Non può essere modificato su un server di gioco già installato.");
tz_def("CONF_SERV_VILLEXPSPEED","Velocità di espansione del villaggio");
tz_def("CONF_SERV_VILLEXPSPEED_TOOLTIP","Velocità, che influisce sull'espansione dell'impero. Con una velocità lenta sono necessari più punti cultura per fondare un nuovo villaggio, con una velocità elevata il numero richiesto di punti cultura è ridotto.");
tz_def("CONF_SERV_BEGINPROTECT","Protezione per principianti");
tz_def("CONF_SERV_BEGINPROTECT_TOOLTIP","Protezione, che vieta un certo tempo per attaccare i villaggi di nuovi giocatori.");
tz_def("CONF_SERV_REGOPEN","Registrazione aperta");
tz_def("CONF_SERV_REGOPEN_TOOLTIP","Permette di abilitare (Vero) o disabilitare (Falso) la registrazione dei giocatori sul server di gioco.");
tz_def("CONF_SERV_ACTIVMAIL","Attivazione Mail");
tz_def("CONF_SERV_ACTIVMAIL_TOOLTIP","Se abilitato (Si), in fase di registrazione sarà necessario confermare l'indirizzo email. Se disabilitato (No) non necessita di conferma via e-mail.");
tz_def("CONF_SERV_QUEST","Quest");
tz_def("CONF_SERV_QUEST_TOOLTIP","Abilita (Sì) o disabilita (No) la missione sul server di gioco.");
tz_def("CONF_SERV_QTYPE","Tipo di Quest");
tz_def("CONF_SERV_QTYPE_TOOLTIP","Il tipo di quest può essere ufficiale, che è un po' più breve, ed esteso, che è più lungo.");
tz_def("CONF_SERV_DLR","Demolire - Livello richiesto");
tz_def("CONF_SERV_DLR_TOOLTIP","Il livello richiesto dell'edificio principale, sul quale è possibile eseguire la demolizione di edifici nel villaggio.");
tz_def("CONF_SERV_WWSTATS","Meraviglia del mondo - Statistiche");
tz_def("CONF_SERV_WWSTATS_TOOLTIP","Abilita (True) o disabilita (False) la visualizzazione nelle statistiche dei villaggi con una Meraviglia del Mondo.");
tz_def("CONF_SERV_NTRTIME","Tempo di rigenerazione delle truppe della natura");
tz_def("CONF_SERV_NTRTIME_TOOLTIP","Tempo attraverso il quale le truppe della natura saranno ripristinate nelle oasi.");
tz_def("CONF_SERV_OASIS_WOOD_PROD_MULT","Moltiplicatore della produzione di legno Oasis");
tz_def("CONF_SERV_OASIS_WOOD_PROD_MULT_TOOLTIP","La base della produzione dell'oasi del legno");
tz_def("CONF_SERV_OASIS_CLAY_PROD_MULT","Moltiplicatore di produzione di argilla Oasis");
tz_def("CONF_SERV_OASIS_CLAY_PROD_MULT_TOOLTIP","La produzione dell'oasi di argilla di base");
tz_def("CONF_SERV_OASIS_IRON_PROD_MULT","Moltiplicatore della produzione di ferro Oasis");
tz_def("CONF_SERV_OASIS_IRON_PROD_MULT_TOOLTIP","La produzione di oasi di ferro di base");
tz_def("CONF_SERV_OASIS_CROP_PROD_MULT","Moltiplicatore della produzione di colture Oasis");
tz_def("CONF_SERV_OASIS_CROP_PROD_MULT_TOOLTIP","La produzione delle oasi del raccolto di base");
tz_def("CONF_SERV_MEDALINTERVAL","Intervallo medaglia");
tz_def("CONF_SERV_MEDALINTERVAL_TOOLTIP","L'intervallo di tempo per l'assegnazione delle medaglie per i migliori giocatori e alleanze. Se questo parametro viene modificato sul server installato, l'intervallo di tempo cambia dopo la successiva emissione delle medaglie.");
tz_def("CONF_SERV_TOURNTHRES","Soglia di Tourn");
tz_def("CONF_SERV_TOURNTHRES_TOOLTIP","Il numero di caselle sulla mappa di gioco, dopodiché la Piazza del torneo inizierà a funzionare.");
tz_def("CONF_SERV_GWORKSHOP","Grande Officina");
tz_def("CONF_SERV_GWORKSHOP_TOOLTIP","Abilita (Vero) o disabilita (Falso) l'uso di una Grande Officina nel gioco.");
tz_def("CONF_SERV_NATARSTAT","Mostra natars nelle statistiche");
tz_def("CONF_SERV_NATARSTAT_TOOLTIP","Abilita (True) o disabilita (False) la visualizzazione dell'account Natars nelle statistiche.");
tz_def("CONF_SERV_PEACESYST","Sistema di pace");
tz_def("CONF_SERV_PEACESYST_TOOLTIP","Abilita o disabilita il sistema Peace. Quando il sistema di pace è attivato, i giocatori potranno attaccarsi a vicenda ma invece di qualsiasi azione nei rapporti ci sarà un'iscrizione di congratulazioni. Le truppe non moriranno di fame.");
tz_def("CONF_SERV_GRAPHICPACK","Pacchetto grafico");
tz_def("CONF_SERV_GRAPHICPACK_TOOLTIP","Abilita (Sì) o disabilita (No) la possibilità di utilizzare il pacchetto grafico.");
tz_def("CONF_SERV_ERRORREPORT","Segnalazione errori");
tz_def("CONF_SERV_ERRORREPORT_TOOLTIP","Abilita (Sì) o disabilita (No) la visualizzazione dei rapporti di errore sul server di gioco.");

//Admin setting - Admin/Templates/config.tpl & editPlusSet.tpl
tz_def("PLUS_CONFIGURATION","Configurazioni <b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b>");
tz_def("PLUS_SETT","Impostazioni <b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b> ");
tz_def("EDIT_PLUS_SETT","Modifica Impostazioni<b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b>");
tz_def("EDIT_PLUS_SETT1","Modifica Impostazioni PLUS");
tz_def("CONF_PLUS_PAYPALEMAIL","Indirizzo<a href='https://www.paypal.com' target='_blank'>PayPal</a> E-Mail");
tz_def("CONF_PLUS_PAYPALEMAIL_TOOLTIP","L'indirizzo e-mail specificato al momento della registrazione su PayPal.<br><font color='red'><b>Deve essere un account Business o Premier!</b></font>");
tz_def("CONF_PLUS_CURRENCY","Valuta del pagamento");
tz_def("CONF_PLUS_CURRENCY_TOOLTIP","La valuta da utilizzare per il pagamento.");
tz_def("CONF_PLUS_PACKAGEGOLDA","Pacchetto \"A\" Quantità d'oro");
tz_def("CONF_PLUS_PACKAGEGOLDA_TOOLTIP","La quantità di oro emesso per il pagamento del pacchetto \"A\".");
tz_def("CONF_PLUS_PACKAGEPRICEA","Pacchetto \"A\" Importo del prezzo");
tz_def("CONF_PLUS_PACKAGEPRICEA_TOOLTIP","L'importo necessario per pagare il costo del pacchetto \"A\".");
tz_def("CONF_PLUS_PACKAGEGOLDB","Pacchetto \"B\" Quantità d'oro");
tz_def("CONF_PLUS_PACKAGEGOLDB_TOOLTIP","La quantità di oro emesso per il pagamento del pacchetto \"B\".");
tz_def("CONF_PLUS_PACKAGEPRICEB","Pacchetto \"B\" Importo del prezzo");
tz_def("CONF_PLUS_PACKAGEPRICEB_TOOLTIP","L'importo necessario per pagare il costo del pacchetto \"B\".");
tz_def("CONF_PLUS_PACKAGEGOLDC","Pacchetto \"C\" Quantità d'oro");
tz_def("CONF_PLUS_PACKAGEGOLDC_TOOLTIP","La quantità di oro emesso per il pagamento del pacchetto \"C\".");
tz_def("CONF_PLUS_PACKAGEPRICEC","Pacchetto \"C\" Importo del prezzo");
tz_def("CONF_PLUS_PACKAGEPRICEC_TOOLTIP","L'importo necessario per pagare il costo del pacchetto \"C\".");
tz_def("CONF_PLUS_PACKAGEGOLDD","Pacchetto \"D\" Quantità d'oro");
tz_def("CONF_PLUS_PACKAGEGOLDD_TOOLTIP","La quantità di oro emesso per il pagamento del pacchetto \"D\".");
tz_def("CONF_PLUS_PACKAGEPRICED","Pacchetto \"D\" Importo del prezzo");
tz_def("CONF_PLUS_PACKAGEPRICED_TOOLTIP","L'importo necessario per pagare il costo del pacchetto \"D\".");
tz_def("CONF_PLUS_PACKAGEGOLDE","Pacchetto \"E\" Quantità d'oro");
tz_def("CONF_PLUS_PACKAGEGOLDE_TOOLTIP","La quantità di oro emesso per il pagamento del pacchetto \"E\".");
tz_def("CONF_PLUS_PACKAGEPRICEE","Pacchetto \"E\" Importo del prezzo");
tz_def("CONF_PLUS_PACKAGEPRICEE_TOOLTIP","L'importo necessario per pagare il costo del pacchetto \"E\".");
tz_def("CONF_PLUS_ACCDURATION","Durata del conto<b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b>");
tz_def("CONF_PLUS_ACCDURATION_TOOLTIP","La durata della funzione di gioco <b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b> per l'account al momento dell'attivazione da parte del giocatore.");
tz_def("CONF_PLUS_PRODUCTDURATION","+25% durata della produzione");
tz_def("CONF_PLUS_PRODUCTDURATION_TOOLTIP","La durata della funzione di gioco +25% della durata di produzione dell'account al momento dell'attivazione da parte del giocatore.");

//Admin setting - Admin/Templates/config.tpl & editLogSet.tpl
tz_def("LOG_SETT","Log Impostazioni");
tz_def("EDIT_LOG_SETT","Modifica Log Impostazioni");
tz_def("CONF_LOG_BUILD","Log Build");
tz_def("CONF_LOG_BUILD_TOOLTIP","Abilita (Sì) o disabilita (No) la visualizzazione dei registri per la costruzione degli edifici nel villaggio.");
tz_def("CONF_LOG_TECHNOLOGY","Tecnologia del Log");
tz_def("CONF_LOG_TECHNOLOGY_TOOLTIP","Abilita (Sì) o disabilita (No) la visualizzazione dei registri per migliorare le truppe in Fabbro e Armeria.");
tz_def("CONF_LOG_LOGIN","Log Login");
tz_def("CONF_LOG_LOGIN_TOOLTIP","Abilita (Sì) o disabilita (No) la visualizzazione dei registri dei giocatori che accedono al gioco.");
tz_def("CONF_LOG_GOLD","Log Oro");
tz_def("CONF_LOG_GOLD_TOOLTIP","Abilita (Sì) o disabilita (No) la visualizzazione dei registri di utilizzo dell'oro nel gioco da parte dei giocatori.");
tz_def("CONF_LOG_ADMIN","Log Admin");
tz_def("CONF_LOG_ADMIN_TOOLTIP","Abilitare (Sì) o disabilitare (No) la visualizzazione dei registri per le azioni dell'amministratore nel pannello di controllo.");
tz_def("CONF_LOG_WAR","Log Guerra");
tz_def("CONF_LOG_WAR_TOOLTIP","Abilita (Sì) o disabilita (No) la visualizzazione dei log degli attacchi ai giocatori nel gioco.");
tz_def("CONF_LOG_MARKET","Log Mercato");
tz_def("CONF_LOG_MARKET_TOOLTIP","Abilita (Sì) o disabilita (No) la visualizzazione dei log di utilizzo del mercato nel gioco da parte dei giocatori.");
tz_def("CONF_LOG_ILLEGAL","Log Illegali");
tz_def("CONF_LOG_ILLEGAL_TOOLTIP","Abilita (Sì) o disabilita (No) la visualizzazione dei log illegali. (non so esattamente cosa sia)");

//Admin setting - Admin/Templates/config.tpl & editNewsboxSet.tpl
tz_def("NEWSBOX_SETT","Impostazioni della casella delle notizie");
tz_def("EDIT_NEWSBOX_SETT","Modifica impostazione casella notizie");
tz_def("EDIT_NEWSBOX1","Casella notizie 1");
tz_def("EDIT_NEWSBOX1_TOOLTIP","Abilitare o disabilitare la visualizzazione della casella notizie 1. Visualizzata nella pagina di autorizzazione e nelle pagine di gioco.");
tz_def("EDIT_NEWSBOX2","Casella notizie 2");
tz_def("EDIT_NEWSBOX2_TOOLTIP","Abilitare o disabilitare la visualizzazione della casella notizie 2. Visualizzata nella pagina di autorizzazione e nelle pagine di gioco.");
tz_def("EDIT_NEWSBOX3","Casella notizie 3");
tz_def("EDIT_NEWSBOX3_TOOLTIP","Abilitare o disabilitare la visualizzazione della casella notizie 3. Visualizzata nella pagina di autorizzazione e nelle pagine di gioco.");

//Admin setting - Admin/Templates/config.tpl SQL Settings
tz_def("SQL_SETTINGS","Impostazioni SQL");
tz_def("CONF_SQL_HOSTNAME","Nome host");
tz_def("CONF_SQL_HOSTNAME_TOOLTIP","Il nome del server su cui viene avviato MySQL (di default è: localhost).");
tz_def("CONF_SQL_PORT","Porta");
tz_def("CONF_SQL_PORT_TOOLTIP","Porta MySQL per connessione remota. La porta standard per la connessione è: 3306.");
tz_def("CONF_SQL_DBUSER","DB Username");
tz_def("CONF_SQL_DBUSER_TOOLTIP","Il nome utente per connettersi al database.");
tz_def("CONF_SQL_DBPASS","DB Password");
tz_def("CONF_SQL_DBPASS_TOOLTIP","Password dell'utente per connettersi al database.");
tz_def("CONF_SQL_DBNAME","DB Name");
tz_def("CONF_SQL_DBNAME_TOOLTIP","Nome del database a cui ti stai connettendo.");
tz_def("CONF_SQL_TBPREFIX","Prefisso tabella");
tz_def("CONF_SQL_TBPREFIX_TOOLTIP","Il prefisso utilizzato per le tabelle del database.");
tz_def("CONF_SQL_DBTYPE","DB Type");
tz_def("CONF_SQL_DBTYPE_TOOLTIP","Il tipo di database utilizzato.");

//Admin setting - Admin/Templates/config.tpl & editExtraSet.tpl
tz_def("EXTRA_SETT","Impostazioni Extra");
tz_def("EDIT_EXTRA_SETT","Modifica impostazioni Extra");
tz_def("CONF_EXTRA_LIMITMAIL","Limite cassetta postale");
tz_def("CONF_EXTRA_LIMITMAIL_TOOLTIP","Abilita (Sì) o disabilita (No) il limite della casella di posta.");
tz_def("CONF_EXTRA_MAXMAIL","Numero massimo di mail");
tz_def("CONF_EXTRA_MAXMAIL_TOOLTIP","Il numero massimo di messaggi che possono essere contenuti nella cassetta postale.");

//Admin setting - Admin/Templates/config.tpl & editAdminInfo.tpl
tz_def("ADMIN_INFO","Informazioni sull'amministratore");
tz_def("EDIT_ADMIN_INFO","Modifica le informazioni dell'amministratore");
tz_def("CONF_ADMIN_NAME","Nome Amministratore");
tz_def("CONF_ADMIN_NAME_TOOLTIP","Nome per l'account amministratore.");
tz_def("CONF_ADMIN_EMAIL","Admin E-Mail");
tz_def("CONF_ADMIN_EMAIL_TOOLTIP","L'indirizzo e-mail dell'account amministratore.");
tz_def("CONF_ADMIN_SHOWSTATS","Includi l'amministratore nelle statistiche");
tz_def("CONF_ADMIN_SHOWSTATS_TOOLTIP","Abilita (True) o disabilita (False) la visualizzazione dell'account amministratore nelle statistiche generali dei giocatori.");
tz_def("CONF_ADMIN_SUPPMESS","Includi messaggi di supporto");
tz_def("CONF_ADMIN_SUPPMESS_TOOLTIP","Abilita (True) o disabilita (False) l'invio di messaggi alla casella di posta dell'amministratore indirizzata al Supporto.");
tz_def("CONF_ADMIN_RAIDATT","Consenti razzia e attacco");
tz_def("CONF_ADMIN_RAIDATT_TOOLTIP","Abilita (True) o disabilita (False) la possibilità di fare irruzione e attaccare un amministratore.");

/*
|--------------------------------------------------------------------------
|   Index
|--------------------------------------------------------------------------
*/

	   $lang['index'][0][1] = "Benvenuto in " . SERVER_NAME . "";
	   $lang['index'][0][2] = "Manuale";
	   $lang['index'][0][3] = "Gioca ora, gratis!";
	   $lang['index'][0][4] = "Cosa è " . SERVER_NAME . "";
	   $lang['index'][0][5] = "" . SERVER_NAME . " è un <b>browser game</b> fcaratterizzato da un coinvolgente mondo antico con migliaia di altri giocatori reali.</p><p>Esso è <strong>gratuito</strong> e non richiede <strong>downloads</strong>.";
	   $lang['index'][0][6] = "Clicca qui per giocare " . SERVER_NAME . "";
	   $lang['index'][0][7] = "Totale giocatori";
	   $lang['index'][0][8] = "Giocatori active";
	   $lang['index'][0][9] = "Giocatori online";
	   $lang['index'][0][10] = "Riguardo al gioco";
	   $lang['index'][0][11] = "Inizierai come capo di un minuscolo villaggio e ti imbarcherai in un'entusiasmante ricerca.";
	   $lang['index'][0][12] = "Costruisci villaggi, intraprendi guerre o stabilisci rotte commerciali con i tuoi vicini.";
	   $lang['index'][0][13] = "Gioca con e contro migliaia di altri giocatori reali e conquista il mondo di Travian.";
	   $lang['index'][0][14] = "News";
	   $lang['index'][0][15] = "FAQ";
	   $lang['index'][0][16] = "Screenshots";
	   $lang['forum'] = "Forum";
	   $lang['register'] = "Registrazione";
	   $lang['login'] = "Login";
	   $lang['screenshots']['title1']="Villaggio";
	   $lang['screenshots']['desc1']="Costruzione del villaggio";
           $lang['screenshots']['title2']="Risorsa";
           $lang['screenshots']['desc2']="La risorsa del villaggio è il legno, l'argilla, il ferro e il raccolto";
           $lang['screenshots']['title3']="Mappa";
           $lang['screenshots']['desc3']="Posiziona il tuo villaggio sulla mappa";
           $lang['screenshots']['title4']="Costruisci Edificio";
           $lang['screenshots']['desc4']="Come costruire un edificio o un livello di risorsa";
           $lang['screenshots']['title5']="Rapporto";
           $lang['screenshots']['desc5']="Il tuo rapporto sull'attacco";
           $lang['screenshots']['title6']="Statistiche";
           $lang['screenshots']['desc6']="Visualizza il tuo posizionamento nelle statistiche";
           $lang['screenshots']['title7']="Armi o pasta";
           $lang['screenshots']['desc7']="Puoi scegliere di giocare come militare o economista";




// ===== AUTO-BACKFILL i18n (valeurs EN, a traduire en italien) =====
tz_def('ACCOUNT_SITTERS', 'Account sitters');
tz_def('ACTIVATE', 'Activate');
tz_def('ADDRESSBOOK', 'Addressbook');
tz_def('ADMIN1', 'Administrator');
tz_def('AND', 'and');
tz_def('ANSWER', 'Answer');
tz_def('ARCHIVE', "Archivio");
tz_def('ATTACKER', 'Attacker');
tz_def('ATT_W_M', 'Attackers of the Week');
tz_def('BACK', 'Back');
tz_def('BANNED', 'Banned');
tz_def('BB_CODE', 'BB-Code');
tz_def('BDAY', 'Birthday');
tz_def('BUY_NOW', 'Buy Now');
tz_def('CANCEL_PROCESS', 'Cancel process');
tz_def('CASUALTIES', 'Casualties');
tz_def('CATEGORY', 'Category');
tz_def('CHANGE_EMAIL', 'Change email');
tz_def('CHANGE_PASSWORD', 'Change password');
tz_def('CHANGE_PROFILE', 'Change profile');
tz_def('CLOSE_MAP', 'Close Map');
tz_def('DEFENDER', 'Defender');
tz_def('DEF_W_M', 'Defenders of the Week');
tz_def('DELIVERY', 'Delivery');
tz_def('DELIVERY_TIME', 'Delivery time');
tz_def('DIRECT_LINKS', 'Direct links');
tz_def('FETCH', 'fetch');
tz_def('FETCHED', 'fetched');
tz_def('FOR_GAME_SERVER', 'Whole game round');
tz_def('FROM_THE_VILL', "dal villaggio");
tz_def('GENDER', 'Gender');
tz_def('GOLD_CLUB', 'Gold Club');
tz_def('GOLD_SHOP', 'Gold Shop');
tz_def('GRAPH_PACK', 'Graphic Pack');
tz_def('INBOX', 'Inbox');
tz_def('INFORMATION', 'Information');
tz_def('INVITE_FRIENDS_GOLD', 'Invite friends and receive free Gold');
tz_def('LARGE_MAP', 'Large Map');
tz_def('LINK_NAME', 'Link name');
tz_def('LINK_TARGET', 'Link target');
tz_def('LOCATION', 'Location');
tz_def('MEDALS', 'Medals');
tz_def('MESSAGES', 'Messages');
tz_def('MESS_FOR_MH', 'Message for Multihunter');
tz_def('MESS_FOR_SUP', 'Message for Support');
tz_def('MH_PANEL', 'Multihunter Panel');
tz_def('MINS', 'mins');
tz_def('MONTH1', 'Jan');
tz_def('MONTH10', 'Oct');
tz_def('MONTH11', 'Nov');
tz_def('MONTH12', 'Dec');
tz_def('MONTH2', 'Feb');
tz_def('MONTH3', 'Mar');
tz_def('MONTH4', 'Apr');
tz_def('MONTH5', 'May');
tz_def('MONTH8', 'Aug');
tz_def('MONTH9', 'Sep');
tz_def('MULTIH1', 'Multihunter');
tz_def('NEW_EMAIL', 'New email');
tz_def('NEW_PASSWORD', 'New password');
tz_def('NO', 'No');
tz_def('NOTES', 'Notes');
tz_def('NOW', 'now');
tz_def('NPC', 'NPC');
tz_def('OLD_EMAIL', 'Old email');
tz_def('OLD_PASSWORD', 'Old password');
tz_def('ONE_DAY_OF_TRAVIAN', '1 day Travian ');
tz_def('ON_HOLD', 'on hold');
tz_def('OWN_VILLAGES', 'own villages');
tz_def('PACKAGE_A', 'Package A');
tz_def('PACKAGE_B', 'Package B');
tz_def('PACKAGE_C', 'Package C');
tz_def('PACKAGE_D', 'Package D');
tz_def('PACKAGE_E', 'Package E');
tz_def('PAYMENT_METHOD', 'Payment Method');
tz_def('PLAYER_PROFILE', 'Player profile');
tz_def('PLUS_MENU', 'Plus menu');
tz_def('PREFERENCES', 'Preferences');
tz_def('PRODUCTION', 'Production');
tz_def('RANK', 'Rank');
tz_def('RANKS', 'Ranks');
tz_def('RECIPIENT', 'Recipient');
tz_def('REPLY', 'Reply');
tz_def('REPORTS', "Rapporti");
tz_def('REPORT_FILTER', 'Report filter');
tz_def('RESOURCES_OVERVIEW', 'Resource overview');
tz_def('ROB_W_M', 'Robbers of the week');
tz_def('SAVE', 'Save');
tz_def('SEND', 'Send');
tz_def('SENDER', 'Sender');
tz_def('SENT', 'Sent');
tz_def('SITTER_NAME', 'Name of the sitter');
tz_def('STATISTICS', 'Statistics');
tz_def('STATUS', 'Status');
tz_def('SUBJECT', "Oggetto");
tz_def('TIME_ZONE_L1', 'Europe');
tz_def('TIME_ZONE_L2', 'UK');
tz_def('TIME_ZONE_L3', 'Turkey');
tz_def('TIME_ZONE_L4', 'Asia/Kolkata');
tz_def('TIME_ZONE_L5', 'Asia/Bangkok');
tz_def('TIME_ZONE_L6', 'USA/New York');
tz_def('TIME_ZONE_L7', 'USA/Chicago');
tz_def('TIME_ZONE_L8', 'New Zealand');
tz_def('TOO_LITTLE_GOLD', 'Too little gold');
tz_def('TO_THE_TASK', 'To the task');
tz_def('TWO_DAYS_OF_TRAVIAN', '2 days Travian ');
tz_def('VACATION', 'Vacation');
tz_def('VACATION_MODE', 'Vacation mode');
tz_def('VAC_OP1', 'Send or receive troops');
tz_def('VAC_OP2', 'Start new construction order');
tz_def('VAC_OP3', 'Use market');
tz_def('VAC_OP4', 'Train new troops');
tz_def('VAC_OP6', 'Delete account');
tz_def('VILLAGES', 'Villages');
tz_def('VILLAGES_ALLI_PLAYERS', 'villages from players of the alliance');
tz_def('VILLAGES_NEAR', 'villages of the surroundings');
tz_def('VILLAGE_NAME', 'Village name');
tz_def('VILLAGE_OF_THE_ELDERS', 'village of the elders');
tz_def('WEEK', 'Week');
tz_def('WRITE', 'Write');
tz_def('YES', 'Yes');
tz_def('YOUR_RES_DELIVERIES', 'Your resource deliveries');


// ===== i18n nouvelles constantes (etape 2) =====
tz_def('TZ_ACTIVATION_AVAILBLE_IN', 'Attivazione disponibile tra:');
tz_def('TZ_ACTIVATION_CODE', 'Codice di attivazione:');
tz_def('TZ_ADD', 'aggiungi');
tz_def('TZ_ADD_2', 'Aggiungi');
tz_def('TZ_ALLIANCE_ID', 'ID dell\'alleanza');
tz_def('TZ_ARRIVED', 'Arrivato:');
tz_def('TZ_ASSIGN_TO_POSITION', 'Assegna alla posizione');
tz_def('TZ_AS_SOON_AS_A_PLAYER_YOU_INVITED_FO', 'Non appena un giocatore da te invitato fonda il suo');
tz_def('TZ_ATTACKS', 'Attacchi');
tz_def('TZ_BOLD', 'grassetto');
tz_def('TZ_BUILDING', 'Edificio');
tz_def('TZ_CATAPULT_TARGET', 'bersaglio della catapulta');
tz_def('TZ_CLICK_TO_COPY', 'Clicca per copiare');
tz_def('TZ_CLIMBERS_OF_THE_WEEK', 'Scalatori della settimana');
tz_def('TZ_CLOCK', 'Orologio');
tz_def('TZ_CONTINUE_WITH_THE_NEXT_TASK', 'Continua con il prossimo compito.');
tz_def('TZ_CREATE', 'Crea');
tz_def('TZ_CREATE_A_NEW_LIST', 'Crea una nuova lista');
tz_def('TZ_DESTINATION', 'Destinazione:');
tz_def('TZ_DOES_NOT_EXIST', 'non esiste.');
tz_def('TZ_DOWNLOAD', 'Scarica');
tz_def('TZ_EVENT', 'Evento');
tz_def('TZ_FEATURES_OF_TRAVIAN', 'Caratteristiche di Travian');
tz_def('TZ_FORUM_NAME', 'Nome del forum');
tz_def('TZ_FORWARD', 'avanti');
tz_def('TZ_GOLD', 'oro.');
tz_def('TZ_HERO_DEF_BONUS', 'Eroe (bonus difensivo)');
tz_def('TZ_HERO_FIGHTING_STRENGTH', 'Eroe (forza di combattimento)');
tz_def('TZ_HERO_OFF_BONUS', 'Eroe (bonus offensivo)');
tz_def('TZ_HOUR', 'ora');
tz_def('TZ_HOW_IS_IT_DONE', 'Come si fa?');
tz_def('TZ_HRS', 'ore');
tz_def('TZ_HRS_2', 'ore');
tz_def('TZ_IF_YOU_GET_NEW_PLAYERS_TO_OPEN_AN', 'Se porti nuovi giocatori ad aprire un account e fondare un secondo villaggio, riceverai');
tz_def('TZ_IN_YOUR_POST_BECAUSE_IT_CAN_CAUSE', 'nel tuo messaggio perché può causare problemi con il sistema BBCode.');
tz_def('TZ_ITALIC', 'corsivo');
tz_def('TZ_LAST_TARGETS', 'Ultimi bersagli:');
tz_def('TZ_LIST_NAME', 'Nome della lista:');
tz_def('TZ_LOOK_FOR_YOUR_RANK_IN_THE_STATISTI', 'Cerca la tua posizione nelle statistiche e inseriscila qui.');
tz_def('TZ_MACEMAN', 'Mazziere');
tz_def('TZ_MEMBERS', 'Membri');
tz_def('TZ_MEMBER_SINCE', 'Membro dal');
tz_def('TZ_NAME', 'Nome:');
tz_def('TZ_NO', 'N.');
tz_def('TZ_NOT_CODED_YET', '(non ancora implementato)');
tz_def('TZ_NO_EMAIL_RECEIVED', 'Nessuna e-mail ricevuta?');
tz_def('TZ_N_15_GOLD', '15 oro');
tz_def('TZ_N_1_INVITE_YOUR_FRIENDS_VIA_EMAIL', '1) Invita i tuoi amici via e-mail');
tz_def('TZ_N_20_GOLD', '20 oro');
tz_def('TZ_N_2_COPY_YOUR_PERSONAL_REF_LINK_AN', '2) Copia il tuo link referral personale e condividilo!');
tz_def('TZ_N_50_GOLD', '50 oro');
tz_def('TZ_OK_2', 'OK');
tz_def('TZ_OPEN_FORUM_FOR_THE_FOLLOWING_PLAYE', 'Forum aperto ai seguenti giocatori');
tz_def('TZ_OPEN_FOR_MORE_ALLIANCES', 'Aperto ad altre alleanze');
tz_def('TZ_ORDER', 'Ordine:');
tz_def('TZ_OTHER', 'Altro');
tz_def('TZ_OWNER', 'Proprietario:');
tz_def('TZ_PAY_SECURELY_WITH_PAYPAL', 'Paga in sicurezza con PayPal.');
tz_def('TZ_PLAYERS_BROUGHT_IN', 'Giocatori portati');
tz_def('TZ_POST_NEW_THREAD', 'Pubblica una nuova discussione');
tz_def('TZ_PREVIEW', 'Anteprima');
tz_def('TZ_PREVIEW_2', 'anteprima');
tz_def('TZ_PROGRESS_OF_YOUR_INVITED_FRIENDS', 'Progressi dei tuoi amici invitati');
tz_def('TZ_QUIT_ALLIANCE', 'Lascia l\'alleanza');
tz_def('TZ_REGISTER_FOR_THE_GAME', 'registrati al gioco');
tz_def('TZ_REGISTRATION', 'registrazione');
tz_def('TZ_SENT', 'Inviato:');
tz_def('TZ_SMILIES', 'Faccine');
tz_def('TZ_SMILIES_2', 'faccine');
tz_def('TZ_STONEMASON_S_LODGE', 'Scalpellino');
tz_def('TZ_TAG', 'Tag:');
tz_def('TZ_TARGET_VILLAGE', 'Villaggio bersaglio:');
tz_def('TZ_TASK_10_CRANNY', 'Compito 10: Nascondiglio');
tz_def('TZ_TASK_11_TO_TWO', 'Compito 11: A due.');
tz_def('TZ_TASK_12_INSTRUCTIONS', 'Compito 12: Istruzioni');
tz_def('TZ_TASK_13_MAIN_BUILDING', 'Compito 13: Edificio principale');
tz_def('TZ_TASK_14_ADVANCED', 'Compito 14: Avanzato!');
tz_def('TZ_TASK_16_ECONOMY', 'Compito 16: Economia');
tz_def('TZ_TASK_16_MILITARY', 'Compito 16: Militare');
tz_def('TZ_TASK_17_BARRACKS', 'Compito 17: Caserma');
tz_def('TZ_TASK_17_WAREHOUSE', 'Compito 17: Magazzino');
tz_def('TZ_TASK_18_MARKETPLACE', 'Compito 18: Mercato.');
tz_def('TZ_TASK_18_TRAIN', 'Compito 18: Addestramento.');
tz_def('TZ_TASK_19_EVERYTHING_TO_2', 'Compito 19: Tutto a 2.');
tz_def('TZ_TASK_20_ALLIANCE', 'Compito 20: Alleanza.');
tz_def('TZ_TASK_21_MAIN_BUILDING_TO_LEVEL_5', 'Compito 21: Edificio principale al livello 5');
tz_def('TZ_TASK_22_GRANARY_TO_LEVEL_3', 'Compito 22: Granaio al livello 3.');
tz_def('TZ_TASK_23_WAREHOUSE_TO_LEVEL_7', 'Compito 23: Magazzino al livello 7.');
tz_def('TZ_TASK_24_ALL_TO_FIVE', 'Compito 24: Tutto a cinque!');
tz_def('TZ_TASK_25_PALACE_OR_RESIDENCE', 'Compito 25: Palazzo o Residenza?');
tz_def('TZ_TASK_26_3_SETTLERS', 'Compito 26: 3 coloni.');
tz_def('TZ_TASK_27_NEW_VILLAGE', 'Compito 27: Nuovo villaggio.');
tz_def('TZ_TASK_3_YOUR_VILLAGE_S_NAME', 'Compito 3: Il nome del tuo villaggio');
tz_def('TZ_TASK_9_DOVE_OF_PEACE', 'Compito 9: Colomba della pace');
tz_def('TZ_TERMS', 'Termini');
tz_def('TZ_THE_ALLIANCE', 'L\'alleanza');
tz_def('TZ_THE_LARGEST_ALLIANCES', 'Le alleanze più grandi');
tz_def('TZ_THE_USER', 'L\'utente');
tz_def('TZ_THREAD', 'Discussione');
tz_def('TZ_TOP_10', 'Top 10');
tz_def('TZ_TOTAL', 'Totale');
tz_def('TZ_TOWNHALL', 'Municipio');
tz_def('TZ_TRAVIAN', 'Travian');
tz_def('TZ_TRAVIANX', 'TravianX');
tz_def('TZ_TRAVIANZ', 'TravianZ');
tz_def('TZ_TRAVIAN_GAMES', 'Travian Games');
tz_def('TZ_UNDERLINE', 'sottolineato');
tz_def('TZ_UNDERLINED', 'sottolineato');
tz_def('TZ_UNKNOWN', 'sconosciuto');
tz_def('TZ_UNTIL_THE_NEXT_LEVEL', 'fino al livello successivo');
tz_def('TZ_USER_ID', 'ID utente');
tz_def('TZ_VILLAGE', 'Villaggio:');
tz_def('TZ_VILLAGE_OVERVIEW', 'Panoramica del villaggio');
tz_def('TZ_WAIT_INSTANT', 'Attesa: immediato');
tz_def('TZ_WARNING', 'Attenzione:');
tz_def('TZ_WOOD', 'Legno');
tz_def('TZ_YOUR_PERSONAL_REF_LINK', 'Il tuo link referral personale:');
tz_def('TZ_YOU_CAN_T_USE_THE_VALUES', 'non puoi usare i valori');
tz_def('TZ_YOU_HAVE_NOT_BROUGHT_IN_ANY_NEW_PL', 'Non hai ancora portato nuovi giocatori.');


// ===== i18n etape 2 (lot suivant) =====
tz_def('TZ_ACCOUNT_IS_ADMIN_OR_MH', 'L\'account è Admin o MH');
tz_def('TZ_ACCOUNT_IS_NOT_SCHEDULED_FOR_DELET', 'L\'account non è programmato per l\'eliminazione');
tz_def('TZ_ACCOUNT_STATEMENT', 'Estratto conto');
tz_def('TZ_ACTIVATE_VACATION_MODE', 'Attiva la modalità vacanza');
tz_def('TZ_ADD_RAID', 'Aggiungi raid');
tz_def('TZ_ADD_SLOT', 'Aggiungi slot');
tz_def('TZ_ADVANTAGES', 'Vantaggi');
tz_def('TZ_AFTER_PAYMENT_YOU_WILL_BE_CREDITED', 'Dopo il pagamento ti verrà accreditato automaticamente.');
tz_def('TZ_AGRESOR', 'Aggressore');
tz_def('TZ_ALLIANCE_DIPLOMACY', 'Diplomazia dell\'alleanza');
tz_def('TZ_ALLIANCE_EVENTS', 'Eventi dell\'alleanza');
tz_def('TZ_ALLIANCE_FORUM', 'Forum dell\'alleanza');
tz_def('TZ_ALLIANCE_MEMBERS', 'membri dell\'alleanza.');
tz_def('TZ_ALLY_CHAT', 'Chat dell\'alleanza');
tz_def('TZ_AM', 'am');
tz_def('TZ_AND_LATER_YOUR_VILLAGE_COULD_LOOK', '...e più tardi il tuo villaggio potrebbe apparire così.');
tz_def('TZ_AND_QUIT_THE_ALLIANCE_AFTERWARDS', 'e poi lascia l\'alleanza.');
tz_def('TZ_ASSIGN_RIGHTS', 'Assegna diritti');
tz_def('TZ_ATTENTION_USE_ONLY_TRUSTWORTHY_GRA', 'ATTENZIONE! Usa solo pacchetti grafici affidabili');
tz_def('TZ_AUTHOR', 'Autore');
tz_def('TZ_BEGINNERS_PROT', 'Prot. principianti');
tz_def('TZ_BEST_PLAYER', 'Miglior giocatore');
tz_def('TZ_BUILDING_SITE', 'sito di costruzione');
tz_def('TZ_BUILD_A_PALACE_OR_RESIDENCE_TO_LEV', 'Costruisci un palazzo o una residenza al livello 10.');
tz_def('TZ_BUILD_CROPPER', 'Costruisci cropper');
tz_def('TZ_BUY_IT_IN_THE_GOLD_SHOP', 'Acquistalo nel negozio d\'oro');
tz_def('TZ_CELEBRATION_STILL_NEEDS', 'la celebrazione necessita ancora di:');
tz_def('TZ_CENTRE', 'Centro:');
tz_def('TZ_CHANGE_NAME', 'Cambia nome');
tz_def('TZ_CHANGE_YOUR_VILLAGE_S_NAME_TO_SOME', 'Cambia il nome del tuo villaggio in qualcosa di bello.');
tz_def('TZ_CHINESE', 'Cinese');
tz_def('TZ_CLAY_25_5_GOLD', 'Argilla +25% (5 oro)');
tz_def('TZ_CLOSED_FORUM', 'Forum chiuso');
tz_def('TZ_CLOSE_ADRESSBOOK', 'chiudi la rubrica');
tz_def('TZ_COMBAT_SIMULATOR', 'Simulatore di combattimento');
tz_def('TZ_COMPLETE_DEMOLITION_10', 'Demolizione completa (10');
tz_def('TZ_CONFEDERATION_FORUM', 'Forum della confederazione');
tz_def('TZ_CONFIRM_WITH_PASSWORD', 'Conferma con la password:');
tz_def('TZ_CONSTRUCT_A_CRANNY', 'Costruisci un nascondiglio.');
tz_def('TZ_CONSTRUCT_A_GRANARY', 'Costruisci un granaio.');
tz_def('TZ_CONSTRUCT_A_RALLY_POINT', 'Costruisci un punto di raduno.');
tz_def('TZ_CONSTRUCT_A_WOODCUTTER', 'Costruisci un boscaiolo.');
tz_def('TZ_CONSTRUCT_BARRACKS', 'Costruisci una caserma.');
tz_def('TZ_CONSTRUCT_WAREHOUSE', 'Costruisci un magazzino.');
tz_def('TZ_CP_DAY', 'PC/giorno');
tz_def('TZ_CROP_25_5_GOLD', 'Grano +25% (5 oro)');
tz_def('TZ_DATE_AND_TIME', 'Data e ora');
tz_def('TZ_DECLARE_WAR', 'dichiara guerra');
tz_def('TZ_DEFAULT', 'Predefinito:');
tz_def('TZ_DELETE_ACCOUNT', 'Eliminare l\'account?');
tz_def('TZ_DIFFERENT_EMAIL_ADDRESS', 'indirizzo e-mail diverso');
tz_def('TZ_DOWNLOAD_FROM', 'Scarica da');
tz_def('TZ_DO_I_NEED_PLUS_TO_USE_OTHER_FEATUR', 'Mi serve Plus per usare altre funzioni?');
tz_def('TZ_EARN_GOLD', 'Guadagna oro');
tz_def('TZ_EDIT_ANSWER', 'Modifica risposta');
tz_def('TZ_EDIT_ANSWER_2', 'modifica risposta');
tz_def('TZ_EDIT_FORUM', 'modifica forum');
tz_def('TZ_EDIT_SLOT', 'Modifica slot');
tz_def('TZ_EDIT_TOPIC', 'Modifica argomento');
tz_def('TZ_ENDS_ON', 'termina il');
tz_def('TZ_ENGLISH', 'Inglese');
tz_def('TZ_ENTER_HOW_MUCH_LUMBER_THE_BARRACKS', 'Inserisci quanto legno costa la caserma');
tz_def('TZ_EU_DD_MM_YY_24H', 'UE (gg.mm.aa 24h)');
tz_def('TZ_EXAMPLE', 'Esempio:');
tz_def('TZ_EXISTING_RELATIONSHIPS', 'Relazioni esistenti');
tz_def('TZ_EXTEND_ALL_RESOURCE_TILES_TO_LEVEL', 'Potenzia tutti i campi di risorse al livello 1.');
tz_def('TZ_EXTEND_ALL_RESOURCE_TILES_TO_LEVEL_2', 'Potenzia tutti i campi di risorse al livello 2.');
tz_def('TZ_EXTEND_ONE_CLAY_PIT', 'Potenzia una cava d\'argilla.');
tz_def('TZ_EXTEND_ONE_CROPLAND', 'Potenzia un campo di grano.');
tz_def('TZ_EXTEND_ONE_IRON_MINE', 'Potenzia una miniera di ferro.');
tz_def('TZ_EXTEND_ONE_OF_EACH_RESOURCE_TILE_T', 'Potenzia un campo di ogni risorsa al livello 2.');
tz_def('TZ_EXTEND_YOUR_MAIN_BUILDING_TO_LEVEL', 'Potenzia il tuo edificio principale al livello 3.');
tz_def('TZ_FINISH', 'Termina');
tz_def('TZ_FOLLOWING_CAUSES_ARE_POSSIBLE', 'Le seguenti cause sono possibili:');
tz_def('TZ_FOLLOW_THIS_LINK_TO', 'Segui questo link per');
tz_def('TZ_FOREIGN_OFFERS', 'Offerte esterne');
tz_def('TZ_FORUM_TYPE', 'Tipo di forum');
tz_def('TZ_FOUND_A_NEW_VILLAGE', 'Fonda un nuovo villaggio.');
tz_def('TZ_FREE', 'GRATIS!');
tz_def('TZ_FRENCH', 'Francese');
tz_def('TZ_FRIEND_EMAIL_COM', 'friend@email.com');
tz_def('TZ_GAME_LANGUAGE', 'Lingua del gioco');
tz_def('TZ_GITHUB', 'Github');
tz_def('TZ_GRAPHIC_PACK_FOUND', 'Pacchetto grafico trovato.');
tz_def('TZ_GRAPHIC_PACK_SETTINGS', 'Impostazioni pacchetto grafico');
tz_def('TZ_GREAT_STABLES', 'Grandi Scuderie');
tz_def('TZ_HERE', 'qui');
tz_def('TZ_HERE_YOU_CAN_KICK_THE_PLAYERS_FROM', 'Qui puoi espellere i giocatori dalla tua alleanza.');
tz_def('TZ_HERE_YOU_FIND_YOUR_RESOURCE_FIELDS', 'Qui trovi i tuoi campi di risorse');
tz_def('TZ_HINT', 'Suggerimento');
tz_def('TZ_HOW_DO_I_GET_GOLD', 'Come ottengo l\'oro?');
tz_def('TZ_INACTIVE_DURING_VACATION', 'Inattivo durante la vacanza');
tz_def('TZ_INFORMATION_ON_HAPPENINGS_IN_YOUR', 'Informazioni sugli eventi nel tuo villaggio');
tz_def('TZ_INITIATE_PAYMENT_BY_PAYPAL', 'Avvia il pagamento con PayPal');
tz_def('TZ_INVITATIONS', 'Inviti:');
tz_def('TZ_INVITE_A_PLAYER_INTO_THE_ALLIANCE', 'Invita un giocatore nell\'alleanza');
tz_def('TZ_INVITE_BY_E_MAIL_OR_SHARE_YOUR_REF', 'Invita via e-mail o condividi il tuo link referral.');
tz_def('TZ_IN_DESCRIPTION', 'nella descrizione.');
tz_def('TZ_IN_THE_VILLAGE_YOU_CAN_BUILD_BUILD', 'Nel villaggio puoi costruire edifici');
tz_def('TZ_IRON_25_5_GOLD', 'Ferro +25% (5 oro)');
tz_def('TZ_ISO_YY_MM_DD_24H', 'ISO (aa/mm/gg 24h)');
tz_def('TZ_ITALIAN', 'Italiano');
tz_def('TZ_I_ACTIVATED_PLUS_BUT_PRODUCTION_DI', 'Ho attivato Plus, ma la produzione non è aumentata.');
tz_def('TZ_JOIN_AN_ALLIANCE', 'Unisciti a un\'alleanza');
tz_def('TZ_JOIN_AN_ALLIANCE_OR_FOUND_ONE_ON_Y', 'Unisciti a un\'alleanza o fondane una tua.');
tz_def('TZ_JUL', 'lug.');
tz_def('TZ_JUN', 'giu.');
tz_def('TZ_KICK_ALL_MEMBERS', 'espelli tutti i membri');
tz_def('TZ_KICK_PLAYER', 'Espelli giocatore:');
tz_def('TZ_LANGUAGE_SETTINGS', 'Impostazioni lingua');
tz_def('TZ_LAST_POST', 'Ultimo messaggio');
tz_def('TZ_LAST_RAID', 'Ultimo raid');
tz_def('TZ_LINKS', 'Link:');
tz_def('TZ_LINK_TO_THE_FORUM', 'Link al forum');
tz_def('TZ_LOG_IN', 'accedi');
tz_def('TZ_LUMBER_25_5_GOLD', 'Legno +25% (5 oro)');
tz_def('TZ_MAINTENANCE_OFF', 'Manutenzione DISATTIVATA');
tz_def('TZ_MAINTENANCE_ON', 'Manutenzione ATTIVATA');
tz_def('TZ_MAJOR_CHANGES', 'Modifiche principali:');
tz_def('TZ_MAP_2', 'Mappa:');
tz_def('TZ_MAXIMUM_VACATION', 'Vacanza massima:');
tz_def('TZ_MESSAGES', 'Messaggi:');
tz_def('TZ_MESSAGE_3', 'Messaggio');
tz_def('TZ_MILITARY_EVENTS', 'Eventi militari');
tz_def('TZ_MINIMUM_VACATION', 'Vacanza minima:');
tz_def('TZ_MINOR_CHANGES', 'Modifiche minori:');
tz_def('TZ_MISCELLANEOUS', 'Varie');
tz_def('TZ_MORE_GRAPHIC_PACKS', 'Altri pacchetti grafici');
tz_def('TZ_MORE_INFO', 'Maggiori info:');
tz_def('TZ_MOVE_TOPIC', 'Sposta argomento');
tz_def('TZ_MULTIHUNTER', 'Multihunter:');
tz_def('TZ_NEW_FORUM', 'Nuovo forum');
tz_def('TZ_NONE_OF_THE_PACKAGES_ARE_REFUNDABL', 'Nessuno dei pacchetti è rimborsabile!');
tz_def('TZ_NOT_ENOUGH_RESOURCE', 'Risorse insufficienti');
tz_def('TZ_NO_MARKETPLACE_ACTIVITY', 'Nessuna attività al mercato');
tz_def('TZ_NO_OWNERSHIP_OF_AN_ARTIFACT_VILLAG', 'Nessun possesso di un villaggio con artefatto');
tz_def('TZ_NO_OWNERSHIP_OF_A_WONDER_OF_THE_WO', 'Nessun possesso di un villaggio Meraviglia del Mondo');
tz_def('TZ_NO_REINFORCING_TROOPS_SENT_RECEIVE', 'Nessuna truppa di rinforzo inviata/ricevuta');
tz_def('TZ_NO_REPORTS_FOR_TRANSFERS_FROM_FORE', 'Nessun rapporto per i trasferimenti da villaggi esterni.');
tz_def('TZ_NO_REPORTS_FOR_TRANSFERS_TO_FOREIG', 'Nessun rapporto per i trasferimenti verso villaggi esterni.');
tz_def('TZ_NO_REPORTS_FOR_TRANSFERS_TO_OWN_VI', 'Nessun rapporto per i trasferimenti verso i propri villaggi.');
tz_def('TZ_N_14_DAYS', '14 giorni');
tz_def('TZ_N_1_1_TRADE_WITH_THE_NPC_MERCHANT', 'Scambio 1:1 con il mercante PNG');
tz_def('TZ_N_1_5_YOUR_VILLAGE', '(1/5) Il tuo villaggio');
tz_def('TZ_N_1_CHOOSE_A_RESOURCE_FIELD', '1. Scegli un campo di risorse');
tz_def('TZ_N_1_CHOOSE_BUILDING_SITE', '1. Scegli un sito di costruzione');
tz_def('TZ_N_2_5_RESOURCES', '(2/5) Risorse');
tz_def('TZ_N_2_CONSTRUCT_A_BUILDING', '2. Costruisci un edificio');
tz_def('TZ_N_2_DAYS', '2 giorni');
tz_def('TZ_N_2_EXTEND_THE_RESOURCE_FIELD', '2. Potenzia il campo di risorse');
tz_def('TZ_N_3_5_BUILDINGS', '(3/5) Edifici');
tz_def('TZ_N_4_5_NEIGHBOURS', '(4/5) Vicini');
tz_def('TZ_N_5_5_NAVIGATION', '(5/5) Navigazione');
tz_def('TZ_OFFER_A_CONFEDERATION', 'offri una confederazione');
tz_def('TZ_OFFER_NON_AGGRESSION_PACT', 'offri un patto di non aggressione');
tz_def('TZ_OK_3', 'ok');
tz_def('TZ_ONLINE_USERS', 'Utenti online');
tz_def('TZ_OPTION_1', 'Opzione 1:');
tz_def('TZ_OPTION_2', 'Opzione 2:');
tz_def('TZ_OPTION_3', 'Opzione 3:');
tz_def('TZ_OPTION_4', 'Opzione 4:');
tz_def('TZ_OPTION_5', 'Opzione 5:');
tz_def('TZ_OPTION_6', 'Opzione 6:');
tz_def('TZ_OPTION_7', 'Opzione 7:');
tz_def('TZ_OPTION_8', 'Opzione 8:');
tz_def('TZ_ORDERED_PACKAGE', 'Pacchetto ordinato');
tz_def('TZ_OR_ASK_THE_SERVER_OWNER', 'o chiedi al proprietario del server.');
tz_def('TZ_OVERVIEW', 'Panoramica:');
tz_def('TZ_OWN_TEXT', 'Testo personale:');
tz_def('TZ_PALACE_RESIDENCE', 'Palazzo/Residenza');
tz_def('TZ_PASSWORD', 'password:');
tz_def('TZ_PAYMENT_ACCOUNT', 'conto di pagamento');
tz_def('TZ_PAYPAL', 'PayPal');
tz_def('TZ_PAYPAL_PACKAGE_A', 'PayPal – Pacchetto A');
tz_def('TZ_PAYPAL_PACKAGE_B', 'PayPal – Pacchetto B');
tz_def('TZ_PAYPAL_PACKAGE_C', 'PayPal – Pacchetto C');
tz_def('TZ_PAYPAL_PACKAGE_D', 'PayPal – Pacchetto D');
tz_def('TZ_PAYPAL_PACKAGE_E', 'PayPal – Pacchetto E');
tz_def('TZ_PLAY_NO_TASKS', 'Non giocare i compiti.');
tz_def('TZ_PLEASE_BUILD_A_MARKETPLACE', 'Costruisci un mercato.');
tz_def('TZ_PLUS_FUNCTIONS', 'Funzioni Plus');
tz_def('TZ_PM', 'pm');
tz_def('TZ_POP', 'Pop');
tz_def('TZ_POSITION', 'Posizione:');
tz_def('TZ_PRODUCTION_CLAY', 'Produzione: Argilla');
tz_def('TZ_PRODUCTION_CROP', 'Produzione: Grano');
tz_def('TZ_PRODUCTION_IRON', 'Produzione: Ferro');
tz_def('TZ_PRODUCTION_LUMBER', 'Produzione: Legno');
tz_def('TZ_PUBLIC_FORUM', 'Forum pubblico');
tz_def('TZ_RAGEZONE_COM', 'RageZone.com');
tz_def('TZ_RANKING_OF_ALL_PLAYERS', 'Classifica di tutti i giocatori');
tz_def('TZ_RATIO', 'rapporto');
tz_def('TZ_READ_YOUR_NEW_MESSAGE', 'Leggi il tuo nuovo messaggio.');
tz_def('TZ_REGISTERED', 'Registrato');
tz_def('TZ_REGISTERED_PLAYERS', 'Giocatori registrati');
tz_def('TZ_RELEASED_BY_TRAVIANZ_TEAM', 'Rilasciato da: il team TravianZ');
tz_def('TZ_RELEASE_BY_TRAVIANZ', '[Rilasciato da: TravianZ]');
tz_def('TZ_REPLIES', 'Risposte');
tz_def('TZ_REPORTS', 'Rapporti:');
tz_def('TZ_REQUIREMENTS', 'Requisiti');
tz_def('TZ_ROMANIAN', 'Rumeno');
tz_def('TZ_SCOUT_DEFENCES_AND_TROOPS', 'Spia difese e truppe');
tz_def('TZ_SCOUT_RESOURCES_AND_TROOPS', 'Spia risorse e truppe');
tz_def('TZ_SCRIPT_PRICE', 'Prezzo dello script:');
tz_def('TZ_SELECT_ALL', 'Seleziona tutto');
tz_def('TZ_SELECT_REWARD', 'Seleziona ricompensa...');
tz_def('TZ_SELECT_REWARD_2', 'Seleziona ricompensa:');
tz_def('TZ_SEND_200_CROP_TO_THE_TASKMASTER', 'Invia 200 grano al sovrintendente.');
tz_def('TZ_SEND_AND_RECEIVE_MESSAGES', 'Invia e ricevi messaggi');
tz_def('TZ_SEND_UNITS_BACK', 'Rimanda indietro le unità');
tz_def('TZ_SERVER_START', 'Avvio del server');
tz_def('TZ_SHOW_THE_LARGE_MAP_IN_AN_EXTRA_WIN', 'Mostra la mappa grande in una finestra aggiuntiva.');
tz_def('TZ_SIZE_IN_MB', 'Dimensione in MB');
tz_def('TZ_SLOTS', 'Slot');
tz_def('TZ_START_RAID', 'Avvia raid');
tz_def('TZ_STATISTICS', 'Statistiche:');
tz_def('TZ_SUPPORT', 'Supporto:');
tz_def('TZ_SUPPORT_AND_MULTIHUNTER', 'Supporto e Multihunter');
tz_def('TZ_SURVEY', 'sondaggio');
tz_def('TZ_TARIFFS', 'Tariffe');
tz_def('TZ_TASK_7_HUGE_ARMY', 'Compito 7: Esercito enorme!');
tz_def('TZ_TASK_8_EVERYTHING_TO_1', 'Compito 8: Tutto a 1.');
tz_def('TZ_THANK_YOU_FOR_USING_OUR_VERSION', 'Grazie per aver usato la nostra versione!');
tz_def('TZ_THERE_ARE_NO_INCOMING_TROOPS', 'Non ci sono truppe in arrivo');
tz_def('TZ_THERE_ARE_NO_OUTGOING_TROOPS', 'Non ci sono truppe in partenza');
tz_def('TZ_THE_BEST_ALLIANCES_DEF', 'Le migliori alleanze (dif)');
tz_def('TZ_THE_BEST_ALLIANCES_OFF', 'Le migliori alleanze (att)');
tz_def('TZ_THE_BUILDING_WAS_COMPLETELY_DEMOLI', 'L\'edificio è stato completamente demolito per 10 oro!');
tz_def('TZ_THE_EMAIL_ACCOUNT_S_STORAGE_LIMIT', 'Il limite di spazio dell\'account e-mail è stato raggiunto');
tz_def('TZ_THE_EMAIL_HAS_BEEN_MOVED_TO_THE_SP', 'L\'e-mail è stata spostata nella cartella spam/posta indesiderata');
tz_def('TZ_THE_EMAIL_WILL_BE_SENT_TO_FOLLOWIN', 'L\'e-mail sarà inviata al seguente indirizzo:');
tz_def('TZ_THE_E_MAIL_ADDRESS_OF_THE_NEW_OWNE', 'L\'indirizzo e-mail del nuovo proprietario.');
tz_def('TZ_THE_GAME_WORLD_ON_WHICH_THE_ACCOUN', 'Il mondo di gioco in cui risiede l\'account');
tz_def('TZ_THE_HERO', 'L\'eroe');
tz_def('TZ_THE_LARGEST_GAULS', 'I Galli più grandi');
tz_def('TZ_THE_LARGEST_PLAYERS', 'I giocatori più grandi');
tz_def('TZ_THE_LARGEST_ROMANS', 'I Romani più grandi');
tz_def('TZ_THE_LARGEST_TEUTONS', 'I Teutoni più grandi');
tz_def('TZ_THE_LARGEST_VILLAGES', 'I villaggi più grandi');
tz_def('TZ_THE_MOST_EXPERIENCED_HEROES', 'Gli eroi più esperti');
tz_def('TZ_THE_MOST_SUCCESSFUL_ATTACKERS', 'Gli attaccanti di maggior successo');
tz_def('TZ_THE_MOST_SUCCESSFUL_DEFENDERS', 'I difensori di maggior successo');
tz_def('TZ_THE_MULTIHUNTERS_ARE_RESPONSIBLE_F', 'I Multihunter sono responsabili del rispetto di');
tz_def('TZ_THE_NAVIGATION_BAR', 'La barra di navigazione');
tz_def('TZ_THE_NICKNAME_OF_THE_ACCOUNT', 'Il soprannome dell\'account');
tz_def('TZ_THE_PATH', 'Il percorso');
tz_def('TZ_THE_VILLAGE', 'Il villaggio');
tz_def('TZ_THIS_FEATURE_IS_NOT_INCLUDED_IN_TH', 'Questa funzione NON è inclusa nel gold club!');
tz_def('TZ_THIS_IS_HOW_YOU_START', 'Ecco come iniziare...');
tz_def('TZ_THREADS', 'Discussioni');
tz_def('TZ_TIME_PREFERENCE', 'Preferenza oraria');
tz_def('TZ_TIME_ZONES', 'Fusi orari');
tz_def('TZ_TIP', 'Consiglio');
tz_def('TZ_TOP_10_ALLIANCES', 'Top 10 alleanze');
tz_def('TZ_TOP_10_PLAYERS', 'Top 10 giocatori');
tz_def('TZ_TOTAL_POPULATION', 'Popolazione totale');
tz_def('TZ_TOTAL_VILLAGES', 'Villaggi totali');
tz_def('TZ_TO_THE_FIRST_TASK', 'Al primo compito.');
tz_def('TZ_TO_THE_REGISTRATION', 'alla registrazione');
tz_def('TZ_TRAIN_3_SETTLERS', 'Addestra 3 coloni.');
tz_def('TZ_TRAVIAN_DEFAULT', 'Travian Default');
tz_def('TZ_TRAVIAN_GOLD_CLUB', 'Travian Gold Club');
tz_def('TZ_TRAVIAN_T4_STYLE', 'Travian T4 Style');
tz_def('TZ_TRIBES', 'Tribù');
tz_def('TZ_TYPOS_IN_THE_EMAIL_ADDRESS', 'Errori di battitura nell\'indirizzo e-mail');
tz_def('TZ_UK_DD_MM_YY_12H', 'UK (gg/mm/aa 12h)');
tz_def('TZ_UPGRADE_ALL_RESOURCES_TILES_TO_LEV', 'Potenzia tutti i campi di risorse al livello 5.');
tz_def('TZ_UPGRADE_YOUR_GRANARY_TO_LEVEL_3', 'Potenzia il tuo granaio al livello 3.');
tz_def('TZ_UPGRADE_YOUR_MAIN_BUILDING_TO_LEVE', 'Potenzia il tuo edificio principale al livello 5.');
tz_def('TZ_UPGRADE_YOUR_WAREHOUSE_TO_LEVEL_7', 'Potenzia il tuo magazzino al livello 7.');
tz_def('TZ_USE', 'Usa');
tz_def('TZ_USED_FOR_RALLY_POINT_AND_MARKETPLA', 'Usato per punto di raduno e mercato:');
tz_def('TZ_USERNAME', 'Nome utente');
tz_def('TZ_USER_DEFINED_GRAPHIC_PACK', 'Pacchetto grafico personalizzato');
tz_def('TZ_USE_IT_FOR_PLUS_OR_ANY_ADVANTAGE', '. Usalo per Plus o qualsiasi vantaggio.');
tz_def('TZ_US_MM_DD_YY_12H', 'US (mm/gg/aa 12h)');
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
tz_def('TZ_VERSION', 'Versione:');
tz_def('TZ_VILLAGE_EXP', 'Exp. villaggio');
tz_def('TZ_VILLAGE_YOU_GET', 'villaggio, ottieni');
tz_def('TZ_VILLAGE_YOU_WILL_BE_CREDITED_WITH', 'villaggio, ti verrà accreditato');
tz_def('TZ_VIP_ACCOUNT_10_GOLD_7_DAYS', 'Account VIP (10 oro – 7 giorni)');
tz_def('TZ_VISIT', 'Visita:');
tz_def('TZ_VOTE', 'Vota');
tz_def('TZ_WAIT_24H', 'Attesa: 24h');
tz_def('TZ_WAIT_INSTANT_AFTER_IPN', 'Attesa: immediato dopo IPN');
tz_def('TZ_WARNING_CATAPULT_WILL', 'Attenzione: la catapulta');
tz_def('TZ_WE_STRIVE_TO_ENSURE_SPEEDY_PROCESS', 'Ci impegniamo a garantire un\'elaborazione rapida!');
tz_def('TZ_WHY_CAN_T_I_FINISH_SOME_BUILDINGS', 'Perché non posso completare alcuni edifici con l\'oro?');
tz_def('TZ_WILL_BE_ATTACKED_BY_CATAPULT_S', '(sarà attaccato da catapulta/e)');
tz_def('TZ_WILL_SPAWN_IN', 'apparirà tra:');
tz_def('TZ_WOODCUTTER_INSTANTLY_COMPLETED', 'Boscaiolo completato istantaneamente.');
tz_def('TZ_WORLD_STATS', 'Statistiche del mondo');
tz_def('TZ_WRITE_THE_CODE', 'Scrivi il codice');
tz_def('TZ_WRONG_DOMAIN_THERE_IS_E_G_NO_AOL_D', 'Dominio errato: non esiste ad es. @aol.de, solo @aol.com');
tz_def('TZ_YOUR_ACCOUNT_HAS_BEEN_SUCCESSFULLY', 'Il tuo account è stato attivato con successo.');
tz_def('TZ_YOUR_VILLAGE_AND_YOUR_NEIGHBOURS', 'Il tuo villaggio e i tuoi vicini');
tz_def('TZ_YOU_CAN_UNDO_THE_REGISTRATION_AND', 'Puoi annullare la registrazione e registrarti di nuovo con un');
tz_def('TZ_YOU_CAN_USE_THIS_GOLD_FOR_PLUS_OR', '. Puoi usare questo oro per Plus o qualsiasi vantaggio in oro.');


// ===== i18n etape 2 (lot suivant) =====
tz_def('TZ_ACCOUNT_OR_INCREASE_YOUR_RESOURCE', '-Account o aumenta la tua produzione di risorse. Per farlo clicca');
tz_def('TZ_ADDITIONALLY_THE_TRAVIAN_TEAM_WILL', 'Inoltre, il team Travian non fornirà informazioni sui ban a nessuno, tranne al proprietario dell\'account.');
tz_def('TZ_ADVERTISEMENT_OF_ANY_KIND_THAT_HAS', 'Qualsiasi pubblicità non autorizzata dal team Travian non è consentita.');
tz_def('TZ_AFTERWARDS_BOTH_PARTIES_MUST_REQUE', 'Successivamente, entrambe le parti devono richiedere la password del nuovo account tramite la funzione di recupero password.');
tz_def('TZ_AFTER_TAKING_CARE_OF_YOUR_RESOURCE', 'Dopo aver curato l\'approvvigionamento di risorse puoi iniziare l\'espansione del tuo villaggio.');
tz_def('TZ_ANY_SALES_OR_PURCHASES_CONCERNING', 'Qualsiasi vendita o acquisto con denaro reale riguardante account, unità, villaggi, risorse, servizi o qualsiasi altro aspetto di Travian non è consentito. La vendita di account Travian così come qualsiasi trasferimento indiretto (anche come regalo) in connessione con siti d\'asta o altre transazioni di denaro non è consentita.');
tz_def('TZ_AS_A_LEADER_YOU_CAN_ONLY_CHANGE_YO', 'Come leader, puoi cambiare solo il tuo titolo. I tuoi diritti rimangono al massimo.');
tz_def('TZ_A_SITTER_CAN_LOG_INTO_YOUR_ACCOUNT', 'Un sostituto può accedere al tuo account usando il tuo nome e la propria password. Puoi avere fino a due sostituti.');
tz_def('TZ_A_WAREHOUSE_AND_A_GRANARY_ENABLE_Y', 'Un magazzino e un granaio ti permettono di immagazzinare più risorse. Un nascondiglio protegge le tue risorse dal furto dei predoni nemici.');
tz_def('TZ_BECAUSE_YOU_ARE_THE_ALLIANCE_FOUND', 'Poiché sei il fondatore dell\'alleanza, devi selezionare un fondatore sostitutivo prima di andartene.');
tz_def('TZ_BEFORE_YOU_EXPAND_YOUR_VILLAGE_S_B', 'Prima di espandere gli edifici del tuo villaggio, dovresti sviluppare alcuni campi di risorse per aumentare l\'approvvigionamento.');
tz_def('TZ_BLACKMAILING_PLAYERS_IN_A_WAY_THAT', 'Ricattare i giocatori in un modo che viola una qualsiasi delle regole di Travian secondo i Termini e le Condizioni Generali.');
tz_def('TZ_COMPLETE_CONSTRUCTION_ORDERS_AND_R', 'Completa ora gli ordini di costruzione e le ricerche in questo villaggio');
tz_def('TZ_DISPLAYING_BATTLE_REPORTS_OR_MESSA', 'Mostrare in pubblico rapporti di battaglia o messaggi senza il consenso di entrambe le parti interessate.');
tz_def('TZ_EACH_PLAYER_MAY_ONLY_OWN_AND_PLAY', 'Ogni giocatore può possedere e giocare un solo account per server.');
tz_def('TZ_ENGLISH_IS_THE_ONLY_LANGUAGE_TOLER', 'L\'inglese è l\'unica lingua tollerata nei messaggi e nelle descrizioni.');
tz_def('TZ_FOLLOWING_BEHAVIOR_IS_PUNISHABLE_A', 'Il seguente comportamento è punibile e si applica a tutte le descrizioni, al nome dell\'account, ai nomi delle alleanze, ai nomi dei villaggi e ai messaggi:');
tz_def('TZ_HERE_YOU_CAN_CHANGE_TRAVIAN_S_DISP', 'Qui puoi cambiare l\'ora visualizzata di Travian per adattarla al tuo fuso orario.');
tz_def('TZ_HERE_YOU_CAN_HAVE_A_LOOK_AT_YOUR_V', 'Qui puoi dare un\'occhiata all\'area circostante il tuo villaggio e ai tuoi vicini');
tz_def('TZ_HOWEVER_IT_IS_PERMISSIBLE_TO_TRANS', 'Tuttavia, è consentito trasferire la password di un account a una o più persone che giocano in un mondo di gioco diverso (o che non giocano affatto) per giocare insieme un singolo account.');
tz_def('TZ_IF_INDIVIDUAL_REGULATIONS_OF_THIS', 'Se singole disposizioni di questo regolamento dovessero risultare in qualche modo inefficaci, ciò non pregiudica la validità delle restanti disposizioni del regolamento. Gli amministratori si impegnano a sostituire le disposizioni inefficaci con nuove disposizioni il più rapidamente possibile.');
tz_def('TZ_IF_THERE_IS_AN_OFFENCE_AGAINST_THE', 'In caso di violazione di queste regole di gioco, i Multihunter e, se necessario, gli amministratori banneranno l\'account/gli account in questione e decideranno una punizione adeguata. Le punizioni supereranno sempre il guadagno ottenuto dalla violazione delle regole.');
tz_def('TZ_IF_YOUR_ALLIANCE_WANTS_TO_USE_AN_E', 'Se la tua alleanza vuole usare un forum esterno, puoi inserire l\'URL qui.');
tz_def('TZ_IMPERSONATING_OFFICIALS_OR_OFFICIA', 'Spacciarsi per funzionari o cariche ufficiali è illegale in qualsiasi modo.');
tz_def('TZ_INCITING_MANIPULATING_ENCOURAGING', 'Incitare, manipolare, incoraggiare, assistere o cospirare con altri per violare una qualsiasi delle regole di Travian non è consentito. Queste regole si applicano senza eccezioni ai giocatori che elimineranno i loro account o li stanno eliminando.');
tz_def('TZ_INTO_YOUR_PROFILE_BY_ADDING_IT_TO', 'nel tuo profilo aggiungendolo a uno dei due campi di descrizione.');
tz_def('TZ_IN_ORDER_TO_ACTIVATE_YOUR_ACCOUNT', 'Per attivare il tuo account inserisci il codice o clicca sul link nella tua e-mail.');
tz_def('TZ_IN_ORDER_TO_PLAY_TRAVIAN_YOU_NEED', 'Per giocare a Travian ti serve un indirizzo e-mail valido a cui inviare il codice di attivazione. In casi eccezionali questa e-mail potrebbe non arrivare.');
tz_def('TZ_IN_ORDER_TO_QUIT_THE_ALLIANCE_YOU', 'Per lasciare l\'alleanza devi inserire di nuovo la tua password per motivi di sicurezza.');
tz_def('TZ_IN_ORDER_TO_SWITCH_AN_ACCOUNT_WITH', 'Per scambiare un account con un\'altra persona nello stesso mondo di gioco, entrambe le persone devono inviare un\'e-mail a admin@travian.com dall\'indirizzo e-mail attualmente registrato per l\'account. L\'e-mail deve contenere le seguenti informazioni:');
tz_def('TZ_IN_THE_BEGINNING_YOUR_SMALL_VILLAG', 'All\'inizio il tuo piccolo villaggio avrà un solo edificio.');
tz_def('TZ_IN_TRAVIAN_YOU_ARE_NOT_ALONE_YOU_I', 'In Travian non sei solo; interagisci con migliaia di altri giocatori nel mondo di Travian.');
tz_def('TZ_IT_S_PART_OF_DIPLOMATIC_ETIQUETTE', 'Fa parte dell\'etichetta diplomatica parlare con un\'altra alleanza prima di inviare un\'offerta.');
tz_def('TZ_MULTIACCOUNTS_ON_THE_SPEED_SERVER', 'I multiaccount sul server veloce e i multiaccount con meno di 100 di popolazione possono essere eliminati a vista senza preavviso.');
tz_def('TZ_NOW_YOU_HAVE_FULFILLED_ALL_PREREQU', 'Ora hai soddisfatto tutti i requisiti necessari per costruire un mercato.');
tz_def('TZ_NOW_YOU_KNOW_EVERYTHING_IMPORTANT', 'Ora sai tutto ciò che è importante su Travian. Dopo la registrazione puoi iniziare a giocare!');
tz_def('TZ_NO_EVERY_GOLD_FEATURE_WORKS_STANDA', 'No. Ogni funzione in oro funziona in modo autonomo finché hai abbastanza oro.');
tz_def('TZ_NO_REAL_WORLD_POLITICS_ARE_ALLOWED', 'Nessuna politica del mondo reale è consentita in nomi, messaggi e descrizioni.');
tz_def('TZ_PARTICIPATION_IN_ABUSIVE_DEFAMATOR', 'Partecipazione a linguaggio offensivo, diffamatorio, sessista, razzista o volgare; denigrazione di qualsiasi religione, razza, nazione, genere, fascia d\'età o orientamento sessuale; minacciare una persona con azioni nella vita reale.');
tz_def('TZ_PLAYERS_MAY_TALK_TO_THE_MULTIHUNTE', 'I giocatori possono parlare con il Multihunter che li ha bannati o con un amministratore tramite IGM (messaggio di gioco) o e-mail. Ban, punizioni o eliminazioni non devono essere discussi in pubblico (es. Chat o Forum). I ricorsi devono essere scritti in inglese.');
tz_def('TZ_PLEASE_ENTER_YOUR_OLD_AND_YOUR_NEW', 'Inserisci il tuo vecchio e il tuo nuovo indirizzo e-mail. Riceverai poi un frammento di codice a entrambi gli indirizzi, che dovrai inserire qui.');
tz_def('TZ_PLUS_DOES_NOT_INCLUDE_PRODUCTION_B', 'Plus non include i bonus di produzione. Devi acquistare +25% per ogni risorsa separatamente in');
tz_def('TZ_PROGRAM_ERRORS_ALSO_CALLED_BUGS_MA', 'Gli errori di programma (chiamati anche bug) non possono essere usati a proprio vantaggio. L\'abuso può portare a una punizione dell\'account.');
tz_def('TZ_RESIDENCE_PALACE_AND_WORLD_WONDER', 'I villaggi con Residenza, Palazzo e Meraviglia del Mondo sono esclusi per motivi di gameplay.');
tz_def('TZ_RESOURCES_BUILDINGS_VILLAGES_OR_TR', 'Risorse, edifici, villaggi o truppe perse durante il periodo di sospensione non contano come punizione e non verranno sostituite dal team Travian. Nessun giocatore ha il diritto di richiedere pagamenti o sostituzioni per il tempo di Plus/Oro perso a causa della sospensione.');
tz_def('TZ_SHOOT_WITH_A_NORMAL_ATTACK_THEY_DO', 'sparano con un attacco normale (non sparano con i raid!)');
tz_def('TZ_SOMETIMES_THE_EMAIL_IS_MOVED_TO_TH', 'A volte l\'e-mail viene spostata nella cartella spam. Per ulteriore aiuto clicca');
tz_def('TZ_THERE_ARE_FOUR_DIFFERENT_TYPES_OF', 'In Travian ci sono quattro diversi tipi di risorse: legno, argilla, ferro e grano.');
tz_def('TZ_THERE_IS_NO_COMPENSATION_FOR_DAMAG', 'Non c\'è alcun risarcimento per i danni causati da un sostituto. I proprietari dell\'account sono pienamente responsabili delle azioni compiute dai sostituti scelti per il loro account. Nel caso in cui i sostituti di un account non rispettino queste regole e i Termini e le Condizioni Generali di Travian, sia il proprietario dell\'account sia il sostituto possono essere ritenuti responsabili e puniti.');
tz_def('TZ_THERE_IS_NO_COMPENSATION_FOR_DAMAG_2', 'Non c\'è alcun risarcimento per i danni causati da qualcuno che conosce la password di un account. La persona che riceve la password è soggetta alle regole di Travian e ai Termini e Condizioni Generali.');
tz_def('TZ_THERE_IS_NO_SPECIAL_TREATMENT_FOR', 'Non c\'è alcun trattamento speciale per gli utenti Travian Plus/Oro riguardo alle regole di gioco, né nel tempo necessario per gestire il caso né nella punizione.');
tz_def('TZ_THE_E_MAIL_ADDRESS_USED_FOR_THE_RE', 'L\'indirizzo e-mail usato per la registrazione di un account deve essere sotto il controllo personale ed esclusivo della persona che ha registrato l\'account. La persona che possiede l\'indirizzo e-mail attualmente registrato per un account è considerata il proprietario dell\'account, indipendentemente da qualsiasi altro accordo personale o di alleanza. Il proprietario di un account è pienamente responsabile di tutte le azioni compiute dall\'account.');
tz_def('TZ_THE_FOLLOWING_SET_OF_RULES_ARE_IN', 'Il seguente regolamento è in combinazione con i Termini e le Condizioni Generali di Travian. Dovresti familiarizzare con i Termini e le Condizioni Generali per verificare cosa è consentito e cosa è proibito, specialmente nel caso di un account bannato per violazione delle regole.');
tz_def('TZ_THE_GAME_MUST_BE_PLAYED_WITH_AN_UN', 'Il gioco deve essere giocato con un browser internet non modificato. L\'uso di script o bot che automatizzano le azioni dell\'account è contro le regole.');
tz_def('TZ_THE_OWNER_OF_AN_ACCOUNT_MAY_NOT_TR', 'Il proprietario di un account non può trasferire la password di un account a nessuna persona che gioca nello stesso mondo di gioco (server). Inoltre, scegliere consapevolmente la stessa password nello stesso mondo di gioco di un\'altra persona è illegale; ognuna di queste azioni è considerata multiaccount, come definito in queste regole.');
tz_def('TZ_THE_PLAYERS_IN_YOUR_SURROUNDING_AR', 'I giocatori nella tua area circostante sono i più importanti per te. Grazie alla mappa hai una buona panoramica di chi sono.');
tz_def('TZ_THE_REGISTRATION_WAS_SUCCESSFUL_IN', 'La registrazione è andata a buon fine. Nei prossimi minuti riceverai un\'e-mail con le informazioni di accesso.');
tz_def('TZ_THE_SUPPORT_IS_A_GROUP_OF_EXPERIEN', 'Il supporto è un gruppo di giocatori esperti che risponderà volentieri alle tue domande.');
tz_def('TZ_THE_TRAVIAN_TEAM_RESERVES_THE_RIGH', 'Il team Travian si riserva il diritto di modificare le regole in qualsiasi momento.');
tz_def('TZ_TO_BRING_IN_NEW_PLAYERS_INVITE_THE', 'Per portare nuovi giocatori, invitali via e-mail o condividi il tuo link referral.');
tz_def('TZ_VACATION_MODE_CANNOT_BE_ACTIVATED', 'La modalità vacanza non può essere attivata – requisiti non soddisfatti');
tz_def('TZ_WE_WILL_SHOW_YOU_HOW_TO_EXPAND_YOU', 'Nella pagina successiva ti mostreremo come espandere il tuo villaggio affinché diventi una città potente e prospera.');
tz_def('TZ_YOU_CAN_DELETE_YOUR_ACCOUNT_HERE_A', 'Puoi eliminare il tuo account qui. Dopo aver avviato la cancellazione, occorreranno tre giorni per completare l\'eliminazione dell\'account. Puoi annullare questo processo entro le prime 24 ore.');
tz_def('TZ_YOU_DON_T_HAVE_ENOUGH_GOLD_YOU_NEE', 'Non hai abbastanza oro. Ti servono 10 oro per la demolizione istantanea.');
tz_def('TZ_YOU_HAVE_BEEN_ENTERED_AS_SITTER_ON', 'Sei stato inserito come sostituto sui seguenti account. Puoi annullare ciò cliccando sulla X rossa.');


// ===== i18n composites (Simulateur) =====
tz_def('TZ_NUMBER', 'Numero');
tz_def('TZ_LVL', 'Liv.');


// ===== i18n reliquat multi-lignes =====
tz_def('TZ_ML_LEADER_DEMOLITION_EMBASSY', 'Poiché sei il leader della tua alleanza, la demolizione della tua attuale Ambasciata non può essere avviata, poiché contiene ancora tutte le tue');
tz_def('TZ_ML_CHANGELOG_120BUGS', 'Oltre 120 bug corretti, artefatti completamente corretti, catapulte e arieti completamente corretti, Natari/Artefatti/villaggi MdM/piani di costruzione MdM automatizzati, nuova formula di battaglia (più precisa della vecchia), attivazione automatica degli artefatti, gran parte del codice riscritta. Maggiori dettagli nel file readme!');
tz_def('TZ_ML_CHANGELOG_NEWFORUM', 'Nuovo sistema di forum, formula del trappola in stile Travian, mastro costruttore corretto, doppia coda di ricerca in fucina e armeria con Plus');
tz_def('TZ_ML_GOLD_RESERVE', 'In pratica, riserviamo la quantità di oro ordinata subito dopo il pagamento. In caso di problemi, invia un\'e-mail al nostro');
tz_def('TZ_ML_GPACK_NOTFOUND', 'Impossibile trovare il pacchetto grafico. Ciò potrebbe essere dovuto ai seguenti motivi:');
tz_def('TZ_ML_GPACK_ALLOWED_SAVE', 'mostra un pacchetto grafico consentito. Salva la tua scelta per attivarlo.');
tz_def('TZ_ML_GPACK_ALTER_APPEARANCE', 'Con un pacchetto grafico puoi modificare l\'aspetto di Travian. Puoi sceglierne uno dalla lista o fornire un percorso personalizzato.');
tz_def('TZ_ML_QUESTIONS_MULTIHUNTER', '. Se hai domande o vuoi segnalare una violazione, puoi scrivere a un Multihunter.');
tz_def('TZ_ML_AWAY_NO_SITTER', 'Se prevedi di assentarti per un periodo prolungato e non desideri impostare un sostituto, puoi attivare');
tz_def('TZ_ML_ACCOUNT_FROZEN', '. Durante questo periodo il tuo account è essenzialmente congelato. Nessuna risorsa, truppa o ricerca progredirà e i tuoi villaggi non possono essere attaccati. Ricorda, questo congela solo il tuo Travian, non il tempo.');
tz_def('TZ_ML_ACTIVATION_RESENT', '. Poi il codice di attivazione verrà inviato di nuovo');
tz_def('TZ_ML_TWO_SITTERS_RIGHT', 'Ogni giocatore ha il diritto di nominare due sostituti che possono giocare l\'account durante l\'assenza del proprietario. I sostituti devono giocare l\'account che gestiscono nel pieno interesse dell\'account. L\'abuso di questa funzione è punibile.');
tz_def('TZ_ML_SAME_COMPUTER_SITTER', 'I giocatori che usano lo stesso computer e desiderano accedere all\'account dell\'altro devono usare la funzione sostituto.');
tz_def('TZ_ML_POLITE_TONE', 'Tutti devono comunicare con un tono educato e cortese. I Multihunter possono modificare senza preavviso profili e nomi di villaggio inappropriati.');
tz_def('TZ_ML_MATERIAL_UNDERAGE', 'La pubblicazione o la trasmissione di qualsiasi materiale non adatto ai minori.');


// ===== i18n reliquat final =====
tz_def('TZ_NO_BEGINNER_PROT2', 'Nessuna protezione principianti');
tz_def('TZ_SERVER_RUNNING_ON', '▶ Server attivo su');

tz_def('OR', 'o');

// ===== task A: re-wired reverted templates =====
tz_def('TZ_HERO', "Eroe");
tz_def('TZ_SEND_UNITS_BACK_TO', "Rimanda le truppe a");
tz_def('TZ_CONFIRM_DEMOLISH_COMPLETE_1', "Vuoi davvero demolire COMPLETAMENTE ");
tz_def('TZ_CONFIRM_DEMOLISH_COMPLETE_2', " per 10 ORO?\nL'edificio scomparirà istantaneamente, non può essere annullato.");
tz_def('TZ_CONFIRM_LAST_EMBASSY_L3', "ATTENZIONE!\n\nStai per demolire l'ultima Ambasciata di livello 3!\n\nPoiché sei il leader della tua alleanza e non restano altri membri, l'alleanza verrà sciolta al termine della demolizione.");
tz_def('TZ_CONFIRM_LAST_EMBASSY_L1', "ATTENZIONE!\n\nStai per demolire la tua ultima Ambasciata!\n\nPoiché fai parte di un'alleanza, la lascerai automaticamente al termine della demolizione.");

tz_def('TZ_TRADE', "Commercio");

// ===== reports section (noticeClass tooltips) =====
tz_def('TZ_RPT_SCOUT', "Rapporto di esplorazione");
tz_def('TZ_RPT_WON_ATK_NOLOSS', "Vinto come attaccante senza perdite");
tz_def('TZ_RPT_WON_ATK_LOSS', "Vinto come attaccante con perdite");
tz_def('TZ_RPT_LOST_ATK_LOSS', "Perso come attaccante con perdite");
tz_def('TZ_RPT_WON_DEF_NOLOSS', "Vinto come difensore senza perdite");
tz_def('TZ_RPT_WON_DEF_LOSS', "Vinto come difensore con perdite");
tz_def('TZ_RPT_LOST_DEF_LOSS', "Perso come difensore con perdite");
tz_def('TZ_RPT_LOST_DEF_NOLOSS', "Perso come difensore senza perdite");
tz_def('TZ_RPT_REINF_ARRIVED', "Rinforzi arrivati");
tz_def('TZ_RPT_WOOD_DELIVERED', "Legno consegnato");
tz_def('TZ_RPT_CLAY_DELIVERED', "Argilla consegnata");
tz_def('TZ_RPT_IRON_DELIVERED', "Ferro consegnato");
tz_def('TZ_RPT_CROP_DELIVERED', "Grano consegnato");
tz_def('TZ_RPT_WON_SCOUT_ATK', "Spionaggio riuscito come attaccante");
tz_def('TZ_RPT_LOST_SCOUT_ATK', "Spionaggio fallito come attaccante");
tz_def('TZ_RPT_WON_SCOUT_DEF', "Spionaggio riuscito come difensore");
tz_def('TZ_RPT_LOST_SCOUT_DEF', "Spionaggio fallito come difensore");

tz_def('NO_REPORTS', "Non ci sono rapporti disponibili");

// ===== report topic connectors (display-time localization) =====
tz_def('TZ_RT_ATTACKS', "attacca");
tz_def('TZ_RT_REINFORCEMENT', "rinforza");
tz_def('TZ_RT_SCOUTS', "spia");
tz_def('TZ_RT_SEND_RES_TO', "invia risorse a");
tz_def('TZ_RT_WAS_ATTACKED', "è stato attaccato");
tz_def('TZ_RT_REINF_IN', "Rinforzo in");
tz_def('TZ_RT_ELDERS_REINF', "rinforzo del villaggio degli anziani");
tz_def('TZ_RT_UNOCC_OASIS', "Oasi non occupata");
tz_def('TZ_RT_NEW_VILLAGE', "Nuovo villaggio fondato");
tz_def('TZ_RT_VALLEY_OCCUPIED', "Colonizzazione fallita (valle occupata)");
tz_def('TZ_NEW_VILLAGE_MSG', "Hai fondato un nuovo villaggio:");
tz_def('TZ_VALLEY_OCCUPIED_MSG', "I tuoi coloni non hanno potuto insediarsi qui — la valle è già occupata da un altro giocatore. Stanno tornando indietro.");

// ===== profilo del giocatore (#189) =====
tz_def('AGE', 'Età');
tz_def('CAPITAL_TAG', 'Capitale');
tz_def('WRITE_MESSAGE_UNAVAILABLE', 'Invio messaggio non disponibile');
tz_def('PROFILE_FLAG_ADMIN', 'Questo giocatore è Amministratore.');
tz_def('PROFILE_FLAG_MULTIHUNTER', 'Questo giocatore è Multihunter.');
tz_def('PROFILE_FLAG_BANNED', 'Questo giocatore è BANNATO.');
tz_def('PROFILE_FLAG_VACATION', 'Questo giocatore è in VACANZA.');

// ===== pagina principale del manuale di gioco (#189) =====
tz_def('BUILDINGS', 'Edifici');
tz_def('INFRASTRUCTURE', 'Infrastruttura');
tz_def('FORWARD', 'avanti');
tz_def('NEW_FEATURES', 'Novità');
tz_def('NEW_WINDOW', 'nuova finestra');
tz_def('MANUAL_INTRO', "Questo aiuto di gioco ti permette di consultare informazioni importanti in qualsiasi momento.");
tz_def('MANUAL_NEW_FEATURES_DESC', "Queste sono novità che non troverai nella versione reale del gioco Travian T3.6. Qui puoi conoscere tutte le novità in dettaglio.");
tz_def('MANUAL_FAQ', 'FAQ Travian');
tz_def('MANUAL_FAQ_DESC', "Questo aiuto di gioco fornisce solo brevi informazioni. Maggiori informazioni sono disponibili sul");

?>
