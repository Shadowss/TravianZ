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
//          FRANÇAIS            //
//      Author: Dzoki           //
//     Adding: Armando          //
//     Translation: Ferywir     //
//////////////////////////////////

//MAIN MENU
define('TRIBE1', 'Romains');
define('TRIBE2', 'Teutons');
define('TRIBE3', 'Gaulois');
define('TRIBE4', 'Nature');
define('TRIBE5', 'Natars');
define('TRIBE6', 'Monstres');

define('HOME', 'Accueil');
define('INSTRUCT', 'Instructions');
define('ADMIN_PANEL', 'Panneau d\'administration');
define('MH_PANEL', 'Panneau Multihunter');
define('MASS_MESSAGE', 'Message de masse');
define('LOGOUT', 'Déconnexion');
define('PROFILE', 'Profil');
define('SUPPORT', 'Support');
define('UPDATE_T_10', 'Mettre à jour le Top 10');
define('SYSTEM_MESSAGE', 'Message système');
define('TRAVIAN_PLUS', 'Travian <b><span class="plus_g">P</span><span class="plus_o">l</span><span class="plus_g">u</span><span class="plus_o">s</span></span></span></b>');
define('CONTACT', 'Contactez-nous !');
define('GAME_RULES', 'Règles du jeu');

//MENU
define('REG', 'Inscription');
define('FORUM', 'Forum');
define('CHAT', 'Chat');
define('IMPRINT', 'Mentions légales');
define('MORE_LINKS', 'Plus de liens');
define('TOUR', 'Visite du jeu');


//ERRORS
define('USRNM_EMPTY', '(Nom d\'utilisateur vide)');
define('USRNM_TAKEN', '(Ce nom est déjà utilisé.)');
define('USRNM_SHORT', '(min. '.USRNM_MIN_LENGTH.' caractères)');
define('USRNM_CHAR', '(Caractères invalides)');
define('PW_EMPTY', '(Mot de passe vide)');
define('PW_SHORT', '(min. '.PW_MIN_LENGTH.' caractères)');
define('PW_INSECURE', '(Mot de passe non sécurisé. Veuillez en choisir un plus robuste.)');
define('EMAIL_EMPTY', '(E-mail vide)');
define('EMAIL_INVALID', '(Adresse e-mail invalide)');
define('EMAIL_TAKEN', '(Cet e-mail est déjà utilisé)');
define('WINNER_ERROR', '<li>Le serveur est terminé ! Plus aucune inscription possible.</li>');
define('TRIBE_EMPTY', '<li>Veuillez choisir une tribu.</li>');
define('AGREE_ERROR', '<li>Vous devez accepter les règles du jeu et les conditions générales pour vous inscrire.</li>');
define('LOGIN_USR_EMPTY', 'Veuillez saisir votre nom.');
define('LOGIN_PASS_EMPTY', 'Veuillez saisir votre mot de passe.');
define('LOGIN_VACATION', 'Le mode vacances est encore activé.');
define('EMAIL_ERROR', 'Les adresses e-mail ne correspondent pas');
define('PASS_MISMATCH', 'Les mots de passe ne correspondent pas');
define('ALLI_OWNER', 'Veuillez désigner un chef d\'alliance avant la suppression');
define('SIT_ERROR', 'Substitut déjà défini ou joueur introuvable');
define('USR_NT_FOUND', 'Ce nom n\'existe pas.');
define('LOGIN_PW_ERROR', 'Mot de passe incorrect.');
define('WEL_TOPIC', 'Conseils et informations utiles');
define('ATAG_EMPTY', 'Tag vide');
define('ANAME_EMPTY', 'Nom vide');
define('ATAG_EXIST', 'Tag déjà pris');
define('ANAME_EXIST', 'Nom déjà pris');
define('ALREADY_ALLY_MEMBER', 'Vous faites déjà partie d\'une alliance');
define('ALLY_TOO_LOW', 'Vous devez avoir une ambassade de niveau 3 ou supérieur');
define('USER_NOT_IN_YOUR_ALLY', 'Cet utilisateur ne fait pas partie de votre alliance !');
define('CANT_EDIT_YOUR_PERMISSIONS', 'Vous ne pouvez pas modifier vos propres permissions !');
define('CANT_EDIT_LEADER_PERMISSIONS', 'Les permissions du chef d\'alliance ne peuvent pas être modifiées !');
define('CANT_REMOVE_LEADER', 'Vous ne pouvez pas expulser le fondateur de l\'alliance !');
define('FOUNDER_LEAVE_NEW', 'Aucun fondateur n\'a été sélectionné !');
define('FOUNDER_LEAVE_INVALID', 'Fondateur invalide !');
define('NO_PERMISSION', 'Vous n\'avez pas les permissions nécessaires !');
define('NAME_OR_DIPL_EMPTY', 'Nom ou diplomatie vide');
define('ALLY_DOESNT_EXISTS', 'Cette alliance n\'existe pas');
define('CANNOT_INVITE_SAME_ALLY', 'Vous ne pouvez pas inviter votre propre alliance');
define('WRONG_DIPLOMACY', 'Choix invalide');
define('INVITE_ALREADY_SENT', 'Soit vous avez déjà envoyé un pacte à cette alliance, soit elle vous en a envoyé un, soit vous avez déjà un pacte avec elle');
define('INVITE_SENT', 'Invitation envoyée');
define('DECLARED_WAR_ON', 'a déclaré la guerre à');
define('OFFERED_NON_AGGRESION_PACT_TO', 'a proposé un pacte de non-agression à');
define('OFFERED_CONFED_TO', 'a proposé une confédération à');
define('ALLY_TOO_MUCH_PACTS', 'Soit vous ne pouvez plus proposer de pactes de ce type, soit cette alliance a atteint sa limite pour ce type de pactes');
define('ALLY_PERMISSIONS_UPDATED', 'Permissions mises à jour');
define('ALLY_FORUM_LINK_UPDATED', 'Lien du forum mis à jour');
define('NO_FORUMS_YET', 'Il n\'y a pas encore de forums.');
define('ALLY_USER_KICKED', ' a été expulsé de l\'alliance');
define('NOT_OPENED_YET', 'Le serveur n\'a pas encore démarré.');
define('REGISTER_CLOSED', 'Les inscriptions sont fermées. Vous ne pouvez pas vous inscrire sur ce serveur.');
define('NAME_EMPTY', 'Veuillez saisir un nom');
define('NAME_NO_EXIST', 'Aucun utilisateur ne porte le nom ');
define('ID_NO_EXIST', 'Aucun utilisateur ne porte l\'identifiant ');
define('SAME_NAME', 'Vous ne pouvez pas vous inviter vous-même');
define('ALREADY_INVITED', ' a déjà été invité');
define('ALREADY_IN_ALLY', ' fait déjà partie de cette alliance');
define('ALREADY_IN_AN_ALLY', ' fait déjà partie d\'une alliance');
define('NAME_OR_TAG_CHANGED', 'Nom ou tag modifié');
define('VAC_MODE_WRONG_DAYS', 'Vous avez saisi un nombre de jours incorrect');

//COPYRIGHT
define('TRAVIAN_COPYRIGHT', 'TravianZ — Clone de Travian 100 % open source.');

//BUILD.TPL
define('CUR_PROD', 'Production actuelle');
define('NEXT_PROD', 'Production au niveau ');
define('CONSTRUCT_BUILD', 'Construire le bâtiment');

//DORF1
define('LUMBER', 'Bois');
define('CLAY', 'Argile');
define('IRON', 'Fer');
define('CROP', 'Céréales');
define('LEVEL', 'Niveau');
define('CROP_COM', CROP.' consommées');
define('PER_HR', 'par heure');
define('PRODUCTION', 'Production');
define('CAPITAL1', 'Capitale');
define('VILLAGES', 'Villages');
define('ANNOUNCEMENT', 'Annonce');
define('GO2MY_VILLAGE', 'Aller à mon village');
define('VILLAGE_CENTER', 'Centre du village');
define('FINISH_GOLD', 'Terminer immédiatement toutes les constructions et recherches en cours dans ce village pour 2 ors ?');
define('WAITING_LOOP', '(en attente)');
define('CROP_NEGATIVE', 'Votre production de céréales est négative, vous n\'atteindrez jamais la quantité de ressources requise.');
define('HR', 'h.');
define('HRS', '(h.)');
define('DONE_AT', 'terminé à');
define('CANCEL', 'annuler');
define('LOYALTY', 'Loyauté');
define('CALCULATED_IN', 'Calculé en');
define('HI', 'Bonjour');
define('P_IN', 'dans');
define('MS', 'ms');
define('SERVER_TIME', 'Heure du serveur :');
define('REMAINING_GOLD', 'Or restant');

// HEADER && MENU && Messages && Reports
define('REPORTS', 'Rapports');
define('MESSAGES', 'Messages');
define('PLUS_MENU', 'Menu Plus');
define('LINKS', 'Liens');
define('CANCEL_PROCESS', 'Annuler le processus');
define('ACCOUNT_DELETING', 'Le compte sera supprimé dans');
define('INBOX', 'Boîte de réception');
define('WRITE', 'Écrire');
define('SENT', 'Envoyés');
define('SEND', 'Envoyer');
define('ARCHIVE', 'Archives');
define('NOTES', 'Notes');
define('SUBJECT', 'Sujet');
define('SENDER', 'Expéditeur');
define('RECIPIENT', 'Destinataire');
define('BACK', 'Retour');
define('NEW', 'nouveau');
define('UNREAD', 'non lu');
define('NO_MESS', 'Aucun message disponible');
define('NO_MESS_IN_ARCHIVE', NO_MESS.' dans les archives');
define('NO_MESS_SENT', 'Aucun message envoyé');
define('MESS_FOR_SUP', 'Message pour le Support');
define('MESS_FOR_MH', 'Message pour le Multihunter');
define('SEND_AS_SUP', 'Envoyer en tant que Support');
define('SEND_AS_MH', 'Envoyer en tant que Multihunter');
define('SAVE', 'Enregistrer');
define('ANSWER', 'Répondre');
define('REPLY', 'Réponse');
define('ADDRESSBOOK', 'Carnet d\'adresses');
define('CLOSE_ADDRESSBOOK', 'Fermer le carnet d\'adresses');
define('ONLINE_S1', 'En ligne maintenant');
define('ONLINE_S2', 'Hors ligne');
define('ONLINE_S3', 'Derniers 3 jours');
define('ONLINE_S4', 'Derniers 7 jours');
define('ONLINE_S5', 'Inactif');
define('WAIT_FOR_CONFIRM', 'En attente de confirmation');
define('CONFIRM', 'Confirmer');
define('WRITE_MESS_WARN', '<b>Attention :</b> vous ne pouvez pas utiliser les balises <b>[message]</b> ou <b>[/message]</b> dans votre message car cela peut causer des problèmes avec le système BBCode.');
define('NO_REPORTS', 'Aucun rapport disponible');
define('ATTACKER', 'Attaquant');
define('NATAR_COUNTERFORCE', 'Contre-attaque Natar');
define('FROM_THE_VILL', 'du village');
define('CASUALTIES', 'Pertes');
define('INFORMATION', 'Information');
define('CARRY', 'transporte');
define('DEFENDER', 'Défenseur');
define('VISITED', 'visité');
define('HIS_TROOPS', ' ses troupes');
define('WISHES_YOU', 'vous souhaite');
define('X_MAS', 'Joyeux Noël');
define('NEW_YEAR', 'Bonne année');
define('EASTER', 'Joyeuses Pâques');
if(!defined('PEACE')) define('PEACE', 'Paix');

define('GOLD', 'Or');
define('GOLD_IMG', '<img src=\"/img/x.gif\" class=\"gold\" alt=\"'.GOLD.'\" title=\"'.GOLD.'\">');

//QUEST
define('Q_CONTINUE', 'Continuez avec la tâche suivante.');
define('Q_REWARD', 'Votre récompense :');
define('Q_BUTN', 'Tâche terminée');
define('Q0', 'Bienvenue à ');
define('Q0_DESC', 'Comme je le vois, vous avez été nommé chef de ce petit village. Je serai votre conseiller pendant les premiers jours et ne quitterai jamais votre côté (droit).');
define('Q0_OPT1', 'Vers la première tâche.');
define('Q0_OPT2', 'Regarder autour de moi seul.');
define('Q0_OPT3', 'Ne pas faire les tâches.');

define('Q1', 'Tâche 1 : Bûcheron');
define('Q1_DESC', 'Quatre forêts verdoyantes entourent votre village. Construisez un bûcheron sur l\'une d\'elles. Le bois est une ressource importante pour notre nouvelle colonie.');
define('Q1_ORDER', 'Ordre :</p>Construisez un bûcheron.');
define('Q1_RESP', 'Oui, de cette façon vous gagnerez plus de bois. Je vous ai donné un petit coup de pouce et terminé l\'ordre instantanément.');
define('Q1_REWARD', 'Bûcheron terminé instantanément.');

define('Q2', 'Tâche 2 : Céréales');
define('Q2_DESC', 'Vos sujets ont faim après avoir travaillé toute la journée. Améliorez un champ de céréales pour améliorer l\'approvisionnement de vos sujets. Revenez ici une fois le bâtiment terminé.');
define('Q2_ORDER', 'Ordre :</p>Améliorez un champ de céréales.');
define('Q2_RESP', 'Très bien. Vos sujets ont à nouveau de quoi manger...');
define('Q2_REWARD', 'Votre récompense :</p>1 jour Travian');

define('Q3', 'Tâche 3 : Le nom de votre village');
define('Q3_DESC', 'Créatif comme vous l\'êtes, vous pouvez donner à votre village le nom qui lui convient.<br><br>Cliquez sur « Profil » dans le menu de gauche puis sélectionnez « Modifier le profil »...');
define('Q3_ORDER', 'Ordre :</p>Changez le nom de votre village pour quelque chose de joli.');
define('Q3_RESP', 'Wow, un beau nom pour votre village. Il aurait pu être le nom de mon village !...');

define('Q4', 'Tâche 4 : Autres joueurs');
define('Q4_DESC', 'Dans '.SERVER_NAME.', vous jouez avec des milliers d\'autres joueurs. Cliquez sur « Statistiques » dans le menu du haut pour chercher votre rang et le saisir ici.');
define('Q4_ORDER', 'Ordre :</p>Cherchez votre rang dans les statistiques et saisissez-le ici.');
define('Q4_BUTN', 'Tâche terminée');
define('Q4_RESP', 'Exactement ! C\'est votre rang.');

define('Q5', 'Tâche 5 : Deux ordres de construction');
define('Q5_DESC', 'Construisez une mine de fer et une carrière d\'argile. Le fer et l\'argile ne sont jamais suffisants.');
define('Q5_ORDER', 'Ordre :</p><ul><li>Améliorez une mine de fer.</li><li>Améliorez une carrière d\'argile.</li></ul>');
define('Q5_RESP', 'Comme vous l\'avez remarqué, les ordres de construction prennent du temps. Le monde de '.SERVER_NAME.' continuera de tourner même si vous êtes hors ligne. Même dans quelques mois, il y aura encore beaucoup de nouvelles choses à découvrir.<br><br>Le mieux est de vérifier votre village de temps en temps et de donner à vos sujets de nouvelles tâches à accomplir.');

define('Q6', 'Tâche 6 : Messages');
define('Q6_DESC', 'Vous pouvez parler avec les autres joueurs grâce au système de messagerie. Je vous ai envoyé un message. Lisez-le puis revenez ici.<br><br>P.-S. N\'oubliez pas : les rapports sont à gauche, les messages à droite.');
define('Q6_ORDER', 'Ordre :</p>Lisez votre nouveau message.');
define('Q6_RESP', 'Vous l\'avez reçu ? Très bien.<br><br>Voici un peu d\'or. Avec l\'or, vous pouvez faire différentes choses, par exemple étendre votre compte dans le menu de gauche.');
define('Q6_RESP1', '-Compte ou augmenter votre production de ressources. Pour cela, cliquez ');
define('Q6_RESP2', 'dans le menu de gauche.');
define('Q6_SUBJECT', 'Message du surveillant');
define('Q6_MESSAGE', 'Sachez qu\'une belle récompense vous attend chez le surveillant.<br><br>Astuce : ce message a été généré automatiquement. Aucune réponse n\'est nécessaire.');

define('Q7', 'Tâche 7 : Un de chaque !');
define('Q7_DESC', 'Nous devrions maintenant augmenter un peu votre production de ressources. Construisez un autre bûcheron, une autre carrière d\'argile, une autre mine de fer et un autre champ de céréales au niveau 1.');
define('Q7_ORDER', 'Ordre :</p>Améliorez une autre case de chaque ressource au niveau 1.');
define('Q7_RESP', 'Très bien, votre production de ressources progresse bien.');

define('Q8', 'Tâche 8 : Armée immense !');
define('Q8_DESC', 'Maintenant j\'ai une tâche très spéciale pour vous. J\'ai faim. Donnez-moi 200 céréales !<br><br>En échange, j\'essaierai d\'organiser une immense armée pour protéger votre village.');
define('Q8_ORDER', 'Ordre :</p>Envoyez 200 céréales au surveillant.');
define('Q8_BUTN', 'Envoyer les céréales');
define('Q8_NOCROP', 'Pas assez de céréales !');

define('Q9', 'Tâche 9 : Tout à 1.');
define('Q9_DESC', 'Dans Travian, il y a toujours quelque chose à faire ! Pendant que vous attendez l\'arrivée de l\'immense armée, nous devrions augmenter un peu votre production de ressources. Améliorez toutes vos cases de ressources au niveau 1.');
define('Q9_ORDER', 'Ordre :</p>Améliorez toutes les cases de ressources au niveau 1.');
define('Q9_RESP', 'Très bien, votre production de ressources prospère.<br><br>Bientôt nous pourrons commencer la construction de bâtiments dans le village.');

define('Q10', 'Tâche 10 : Colombe de la paix');
define('Q10_DESC', 'Pendant les premiers jours après votre inscription, vous êtes protégé contre les attaques des autres joueurs. Vous pouvez voir combien de temps dure cette protection en ajoutant le code <b>[#0]</b> à votre profil.');
define('Q10_ORDER', 'Ordre :</p>Écrivez le code <b>[#0]</b> dans votre profil en l\'ajoutant à l\'un des deux champs de description.');
define('Q10_RESP', 'Bravo ! Maintenant tout le monde peut voir quel grand guerrier rejoint le monde.');
define('Q10_REWARD', 'Votre récompense :</p>2 jours Travian');

define('Q11', 'Tâche 11 : Voisins !');
define('Q11_DESC', 'De nombreux villages différents vous entourent. L\'un d\'eux s\'appelle ');
define('Q11_DESC1', '. Cliquez sur « Carte » dans le menu supérieur et cherchez ce village. Le nom des villages voisins s\'affiche en passant la souris dessus.');
define('Q11_ORDER', 'Ordre :</p>Cherchez les coordonnées de ');
define('Q11_ORDER1', 'et saisissez-les ici.');
define('Q11_RESP', 'Exactement, voilà ');
define('Q11_RESP1', ' ! Autant de ressources qu\'on peut en atteindre dans ce village. Enfin, presque autant...');
define('Q11_BUTN', 'Tâche terminée');

define('Q12', 'Tâche 12 : Cachette');
define('Q12_DESC', 'Il est temps de construire une cachette. Le monde de '.SERVER_NAME.' est dangereux.<br><br>De nombreux joueurs vivent en pillant les ressources des autres. Construisez une cachette pour dissimuler une partie de vos ressources à vos ennemis.');
define('Q12_ORDER', 'Ordre :</p>Construisez une cachette.');
define('Q12_RESP', 'Bravo, il est désormais beaucoup plus difficile pour les autres joueurs de piller votre village.<br><br>En cas d\'attaque, vos habitants cacheront eux-mêmes les ressources dans la cachette.');

define('Q13', 'Tâche 13 : À deux.');
define('Q13_DESC', 'Dans '.SERVER_NAME.', il y a toujours quelque chose à faire ! Améliorez un bûcheron, une carrière d\'argile, une mine de fer et un champ de céréales au niveau 2 chacun.');
define('Q13_ORDER', 'Ordre :</p>Améliorez une case de chaque ressource au niveau 2.');
define('Q13_RESP', 'Très bien, votre village grandit et prospère !');

define('Q14', 'Tâche 14 : Instructions');
define('Q14_DESC', 'Dans les instructions du jeu, vous trouverez de courts textes informatifs sur différents bâtiments et types d\'unités.<br><br>Cliquez sur « Instructions » à gauche pour découvrir combien de bois est nécessaire pour la caserne.');
define('Q14_ORDER', 'Ordre :</p>Saisissez combien de bois coûte la caserne.');
define('Q14_BUTN', 'Tâche terminée');
define('Q14_RESP', 'Exactement ! La caserne coûte 210 bois.');

define('Q15', 'Tâche 15 : Bâtiment principal');
define('Q15_DESC', 'Vos maîtres d\'œuvre ont besoin d\'un bâtiment principal de niveau 3 pour ériger des bâtiments importants comme le marché ou la caserne.');
define('Q15_ORDER', 'Ordre :</p>Améliorez votre bâtiment principal au niveau 3.');
define('Q15_RESP', 'Bravo. Le bâtiment principal niveau 3 a été terminé.<br><br>Avec cette amélioration, vos maîtres d\'œuvre peuvent non seulement construire plus de types de bâtiments, mais aussi le faire plus rapidement.');

define('Q16', 'Tâche 16 : Avancement !');
define('Q16_DESC', 'Recherchez à nouveau votre rang dans les statistiques des joueurs et appréciez vos progrès.');
define('Q16_ORDER', 'Ordre :</p>Cherchez votre rang dans les statistiques et saisissez-le ici.');
define('Q16_RESP', 'Bravo ! C\'est votre rang actuel.');

define('Q17', 'Tâche 17 : Armes ou pain');
define('Q17_DESC', 'Vous devez maintenant prendre une décision : soit commercer pacifiquement, soit devenir un guerrier redouté.<br><br>Pour le marché, un grenier est nécessaire ; pour la caserne, il faut un point de rassemblement.');
define('Q17_BUTN', 'Économie');
define('Q17_BUTN1', 'Militaire');

define('Q18', 'Tâche 18 : Militaire');
define('Q18_DESC', 'Une décision courageuse. Pour pouvoir envoyer des troupes, un point de rassemblement est nécessaire.<br><br>Le point de rassemblement doit être construit sur un emplacement spécifique. L\'emplacement ');
define('Q18_DESC1', ' du chantier.');
define('Q18_DESC2', ' se trouve à droite du bâtiment principal, légèrement en dessous. Le chantier lui-même est de forme courbée.');
define('Q18_ORDER', 'Ordre :</p>Construisez un point de rassemblement.');
define('Q18_RESP', 'Votre point de rassemblement a été érigé ! Un bon pas vers la domination mondiale !');

define('Q19', 'Tâche 19 : Caserne');
define('Q19_DESC', 'Maintenant vous avez un bâtiment principal niveau 3 et un point de rassemblement. Tous les prérequis pour construire la caserne sont remplis.<br><br>Vous pouvez utiliser la caserne pour entraîner des troupes au combat.');
define('Q19_ORDER', 'Ordre :</p>Construisez une caserne.');
define('Q19_RESP', 'Bravo... Les meilleurs instructeurs de tout le pays se sont réunis pour entraîner vos hommes au combat à leur meilleur niveau.');

define('Q20', 'Tâche 20 : Entraînement.');
define('Q20_DESC', 'Maintenant que vous avez la caserne, vous pouvez commencer à entraîner des troupes. Entraînez-en deux ');
define('Q20_ORDER', 'Veuillez en entraîner 2 ');
define('Q20_RESP', 'Les bases de votre glorieuse armée sont posées.<br><br>Avant d\'envoyer votre armée piller, vous devriez vérifier avec le ');
define('Q20_RESP1', 'Simulateur de combat');
define('Q20_RESP2', 'pour voir combien de troupes vous avez besoin pour battre un rat sans pertes.');

define('Q21', 'Tâche 18 : Économie');
define('Q21_DESC', 'Commerce & Économie, c\'est votre choix. Des temps dorés vous attendent !');
define('Q21_ORDER', 'Ordre :</p>Construisez un grenier.');
define('Q21_RESP', 'Bravo ! Avec le grenier, vous pouvez stocker plus de céréales.');

define('Q22', 'Tâche 19 : Entrepôt');
define('Q22_DESC', 'Pas seulement les céréales doivent être sauvegardées. Les autres ressources peuvent aussi être perdues si elles ne sont pas stockées correctement. Construisez un entrepôt !');
define('Q22_ORDER', 'Ordre :</p>Construisez un entrepôt.');
define('Q22_RESP', '«Bravo, votre entrepôt est terminé...»<br>Maintenant vous avez rempli tous les prérequis pour construire un marché.');

define('Q23', 'Tâche 20 : Marché.');
define('Q23_DESC', 'Construisez un marché afin de pouvoir commercer avec vos compagnons joueurs.');
define('Q23_ORDER', 'Ordre :</p>Veuillez construire un marché.');
define('Q23_RESP', 'Le marché a été terminé. Vous pouvez désormais faire vos propres offres ou accepter celles des autres ! En créant vos offres, pensez à proposer ce dont les autres joueurs ont le plus besoin pour obtenir de meilleurs profits.');

define('Q24', 'Tâche 21 : Tout au niveau 2.');
define('Q24_DESC', 'Nous devrions maintenant augmenter un peu votre production de ressources. Construisez un autre bûcheron, carrière d\'argile, mine de fer et champ de céréales au niveau 1.');
define('Q24_ORDER', 'Ordre :</p>Améliorez toutes les cases de ressources au niveau 2.');
define('Q24_RESP', 'Félicitations ! Votre village grandit et prospère...');

define('Q28', 'Tâche 22 : Alliance.');
define('Q28_DESC', 'Le travail d\'équipe est important dans Travian. Les joueurs qui collaborent s\'organisent en alliances. Recevez une invitation d\'une alliance dans votre région et rejoignez-la. Sinon, vous pouvez fonder votre propre alliance. Pour cela, vous avez besoin d\'une ambassade de niveau 3.');
define('Q28_ORDER', 'Ordre :</p>Rejoignez une alliance ou fondez-en une vous-même.');
define('Q28_RESP', 'C\'est bien ! Vous voilà dans une union appelée ');
define('Q28_RESP1', ', et vous êtes membre de leur alliance — vous progresserez d\'autant plus vite...');

define('Q29', 'Tâche 23 : Bâtiment principal au niveau 5');
define('Q29_DESC', 'Pour pouvoir construire un palais ou une résidence, vous aurez besoin d\'un bâtiment principal de niveau 5.');
define('Q29_ORDER', 'Ordre :</p>Améliorez votre bâtiment principal au niveau 5.');
define('Q29_RESP', 'Le bâtiment principal est niveau 5 maintenant et vous pouvez construire un palais ou une résidence...');

define('Q30', 'Tâche 24 : Grenier au niveau 3.');
define('Q30_DESC', 'Pour ne pas perdre vos céréales, vous devriez améliorer votre grenier.');
define('Q30_ORDER', 'Ordre :</p>Améliorez votre grenier au niveau 3.');
define('Q30_RESP', 'Le grenier est niveau 3 maintenant...');

define('Q31', 'Tâche 25 : Entrepôt au niveau 7');
define('Q31_DESC', 'Pour vous assurer que vos ressources ne débordent pas, vous devriez améliorer votre entrepôt.');
define('Q31_ORDER', 'Ordre :</p>Améliorez votre entrepôt au niveau 7.');
define('Q31_RESP', 'L\'entrepôt a été amélioré au niveau 7...');

define('Q32', 'Tâche 26 : Tout à cinq !');
define('Q32_DESC', 'Vous aurez toujours besoin de plus de ressources. Les cases de ressources sont assez chères mais paieront toujours à long terme.');
define('Q32_ORDER', 'Ordre :</p>Améliorez toutes les cases de ressources au niveau 5.');
define('Q32_RESP', 'Toutes les ressources sont au niveau 5, très bien, votre village grandit et prospère !');

define('Q33', 'Tâche 27 : Palais ou résidence ?');
define('Q33_DESC', 'Pour fonder un nouveau village, vous aurez besoin de colons. Vous pouvez les entraîner dans un palais ou une résidence.');
define('Q33_ORDER', 'Ordre :</p>Construisez un palais ou une résidence au niveau 10.');
define('Q33_RESP', 'A atteint le niveau 10, vous pouvez maintenant entraîner des colons et fonder votre deuxième village. Attention aux points de culture...');

define('Q34', 'Tâche 28 : 3 colons.');
define('Q34_DESC', 'Pour fonder un nouveau village, vous aurez besoin de colons. Ils peuvent être entraînés dans un palais ou une résidence.');
define('Q34_ORDER', 'Ordre :</p>Entraînez 3 colons.');
define('Q34_RESP', '3 colons ont été entraînés. Pour fonder un nouveau village, vous avez besoin d\'au moins ');
define('Q34_RESP1', 'points de culture...');

define('Q35', 'Tâche 29 : Nouveau village.');
define('Q35_DESC', 'Il y a beaucoup de cases vides sur la carte. Trouvez celle qui vous convient et fondez-y un nouveau village.');
define('Q35_ORDER', 'Ordre :</p>Fondez un nouveau village.');
define('Q35_RESP', 'Je suis fier de vous ! Vous avez maintenant deux villages et toutes les possibilités pour construire un empire puissant. Je vous souhaite bonne chance.');

define('Q36', ' Tâche 30 : Construire un ');
define('Q36_DESC', 'Maintenant que vous avez entraîné quelques soldats, vous devriez construire un ');
define('Q36_DESC1', ' aussi. Cela augmente la défense de base et vos soldats recevront un bonus défensif.');
define('Q36_ORDER', 'Ordre :</p>Construisez un ');
define('Q36_RESP', 'C\'est de cela que je parle. Un ');
define('Q36_RESP1', ' très utile. Cela augmente la défense des troupes dans le village.');

define('Q37', 'Tâches');
define('Q37_DESC', 'Toutes les tâches sont terminées !');

define('RESOURCES_OVERVIEW', 'Aperçu des ressources');
define('YOUR_RES_DELIVERIES', 'Vos livraisons de ressources');
define('DELIVERY', 'Livraison');
define('DELIVERY_TIME', 'Temps de livraison');
define('STATUS', 'État');
define('FETCH', 'récupérer');
define('FETCHED', 'récupéré');
define('ON_HOLD', 'en attente');
define('ONE_DAY_OF_TRAVIAN', '1 jour Travian ');
define('TWO_DAYS_OF_TRAVIAN', '2 jours Travian ');

//Quest 25
define('Q25_7', 'Tâche 7 : Voisins !');
define('Q25_7_DESC', 'De nombreux villages différents vous entourent. L\'un d\'eux s\'appelle ');
define('Q25_7_DESC1', '. Cliquez sur « Carte » dans le menu du haut et cherchez ce village. Le nom des villages voisins s\'affiche en passant la souris dessus.');
define('Q25_7_ORDER', '</p><b>Ordre :</b><br>Cherchez les coordonnées de ');
define('Q25_7_ORDER1', 'et saisissez-les ici.');
define('Q25_7_RESP', 'Exactement, voilà ');
define('Q25_7_RESP1', ' ! Autant de ressources qu\'on peut en atteindre dans ce village. Enfin, presque autant...');

define('Q25_8', 'Tâche 8 : Armée immense !');
define('Q25_8_DESC', 'Maintenant j\'ai une tâche très spéciale pour vous. J\'ai faim. Donnez-moi 200 céréales !<br><br>En échange, j\'essaierai d\'organiser une immense armée pour protéger votre village.');
define('Q25_8_ORDER', 'Ordre :</p>Envoyez 200 céréales au surveillant.');
define('Q25_8_BUTN', 'Envoyer les céréales');
define('Q25_8_NOCROP', 'Pas assez de céréales !');

define('Q25_9', 'Tâche 9 : Un de chaque !');
define('Q25_9_DESC', 'Dans '.SERVER_NAME.', il y a toujours quelque chose à faire ! Pendant que vous attendez votre nouvelle armée,<br><br>améliorez un bûcheron, une carrière d\'argile, une mine de fer et un champ de céréales supplémentaires au niveau 1.');
define('Q25_9_ORDER', 'Ordre :</p>Améliorez une autre case de chaque ressource au niveau 1.');
define('Q25_9_RESP', 'Très bien, beau développement de la production de ressources.');

define('Q25_10', 'Tâche 10 : Bientôt !');
define('Q25_10_DESC', 'Vous pouvez prendre une petite pause jusqu\'à ce que l\'armée gigantesque que je vous ai envoyée arrive.<br><br>Jusque-là, vous pouvez explorer la carte ou améliorer quelques cases de ressources.');
define('Q25_10_ORDER', 'Ordre :</p>Attendez l\'arrivée de l\'armée du surveillant.');
define('Q25_10_RESP', 'Maintenant une immense armée du surveillant est arrivée pour protéger votre village.');
define('Q25_10_REWARD', 'Votre récompense :</p>2 jours de plus dans Travian');

define('Q25_11', 'Tâche 11 : Rapports');
define('Q25_11_DESC', 'Chaque fois qu\'un événement important se produit sur votre compte, vous recevez un rapport.<br><br>Vous pouvez les consulter en cliquant sur la moitié gauche du 5e bouton (de gauche à droite). Lisez le rapport et revenez ici.');
define('Q25_11_ORDER', 'Ordre :</p>Lisez votre dernier rapport.');
define('Q25_11_RESP', 'Vous l\'avez reçu ? Très bien. Voici votre récompense.');

define('Q25_12', 'Tâche 12 : Tout à 1.');
define('Q25_12_DESC', 'Nous devrions maintenant augmenter un peu votre production de ressources.');
define('Q25_12_ORDER', 'Ordre :</p>Améliorez toutes les cases de ressources au niveau 1.');
define('Q25_12_RESP', 'Très bien, votre production de ressources prospère.<br><br>Bientôt nous pourrons commencer la construction de bâtiments dans le village.');

define('Q25_13', 'Tâche 13 : Colombe de la paix');
define('Q25_13_DESC', 'Pendant les premiers jours après votre inscription, vous êtes protégé contre les attaques des autres joueurs. Vous pouvez voir combien de temps dure cette protection en ajoutant le code <b>[#0]</b> à votre profil.');
define('Q25_13_ORDER', 'Ordre :</p>Écrivez le code <b>[#0]</b> dans votre profil en l\'ajoutant à l\'un des deux champs de description.');
define('Q25_13_RESP', 'Bravo ! Maintenant tout le monde peut voir quel grand guerrier rejoint le monde.');

define('Q25_14', 'Tâche 14 : Cachette');
define('Q25_14_DESC', 'Il est temps de construire une cachette. Le monde de <b>'.SERVER_NAME.'</b> est dangereux.<br><br>De nombreux joueurs vivent en pillant les ressources des autres. Construisez une cachette pour dissimuler une partie de vos ressources à vos ennemis.');
define('Q25_14_ORDER', 'Ordre :</p>Construisez une cachette.');
define('Q25_14_RESP', 'Bravo, il est désormais beaucoup plus difficile pour les autres joueurs de piller votre village.<br><br>En cas d\'attaque, vos habitants cacheront eux-mêmes les ressources dans la cachette.');

define('Q25_15', 'Tâche 15 : À deux.');
define('Q25_15_DESC', 'Dans <b>'.SERVER_NAME.'</b>, il y a toujours quelque chose à faire ! Améliorez un bûcheron, une carrière d\'argile, une mine de fer et un champ de céréales au niveau 2 chacun.');
define('Q25_15_ORDER', 'Ordre :</p>Améliorez une case de chaque ressource au niveau 2.');
define('Q25_15_RESP', 'Très bien, votre village grandit et prospère !');

define('Q25_16', 'Tâche 16 : Instructions');
define('Q25_16_DESC', 'Dans les instructions du jeu, vous trouverez de courts textes informatifs sur différents bâtiments et types d\'unités.<br><br>Cliquez sur « Instructions » à gauche pour découvrir combien de bois est nécessaire pour la caserne.');
define('Q25_16_ORDER', 'Ordre :</p>Saisissez combien de bois coûte la caserne.');
define('Q25_16_BUTN', 'Tâche terminée');
define('Q25_16_RESP', 'Exactement ! La caserne coûte 210 bois.');

define('Q25_17', 'Tâche 17 : Bâtiment principal');
define('Q25_17_DESC', 'Vos maîtres d\'œuvre ont besoin d\'un bâtiment principal de niveau 3 pour ériger des bâtiments importants comme le marché ou la caserne.');
define('Q25_17_ORDER', 'Ordre :</p>Améliorez votre bâtiment principal au niveau 3.');
define('Q25_17_RESP', 'Bravo. Le bâtiment principal niveau 3 a été terminé.<br><br>Avec cette amélioration, vos maîtres d\'œuvre peuvent construire plus de types de bâtiments et plus rapidement.');

define('Q25_18', 'Tâche 18 : Avancement !');
define('Q25_18_DESC', 'Recherchez à nouveau votre rang dans les statistiques des joueurs et appréciez vos progrès.');
define('Q25_18_ORDER', 'Ordre :</p>Cherchez votre rang dans les statistiques et saisissez-le ici.');
define('Q25_18_RESP', 'Bravo ! C\'est votre rang actuel.');

define('Q25_19', 'Tâche 19 : Armes ou pain');
define('Q25_19_DESC', 'Vous devez maintenant prendre une décision : soit commercer pacifiquement, soit devenir un guerrier redouté.<br><br>Pour le marché, un grenier est nécessaire ; pour la caserne, il faut un point de rassemblement.');
define('Q25_19_BUTN', 'Économie');
define('Q25_19_BUTN1', 'Militaire');

define('Q25_20', 'Tâche 19 : Économie');
define('Q25_20_DESC', 'Commerce & Économie, c\'est votre choix. Des temps dorés vous attendent !');
define('Q25_20_ORDER', 'Ordre :</p>Construisez un grenier.');
define('Q25_20_RESP', 'Bravo ! Avec le grenier, vous pouvez stocker plus de céréales.');

define('Q25_21', 'Tâche 20 : Entrepôt');
define('Q25_21_DESC', 'Pas seulement les céréales doivent être sauvegardées. Les autres ressources peuvent aussi être perdues si elles ne sont pas stockées correctement. Construisez un entrepôt !');
define('Q25_21_ORDER', 'Ordre :</p>Construisez un entrepôt.');
define('Q25_21_RESP', '«Bravo, votre entrepôt est terminé...»<br>Maintenant vous avez rempli tous les prérequis pour construire un marché.');

define('Q25_22', 'Tâche 21 : Marché.');
define('Q25_22_DESC', 'Construisez un marché afin de pouvoir commercer avec vos compagnons joueurs.');
define('Q25_22_ORDER', 'Ordre :</p>Veuillez construire un marché.');
define('Q25_22_RESP', 'Le marché a été terminé. Vous pouvez désormais faire vos propres offres et accepter celles des autres ! En créant vos offres, pensez à proposer ce dont les autres joueurs ont le plus besoin pour obtenir de meilleurs profits.');

define('Q25_23', 'Tâche 19 : Militaire');
define('Q25_23_DESC', 'Une décision courageuse. Pour pouvoir envoyer des troupes, un point de rassemblement est nécessaire.<br><br>Le point de rassemblement doit être construit sur un emplacement spécifique. L\'emplacement ');
define('Q25_23_DESC1', ' du chantier.');
define('Q25_23_DESC2', ' se trouve à droite du bâtiment principal, légèrement en dessous. Le chantier lui-même est de forme courbée.');
define('Q25_23_ORDER', 'Ordre :</p>Construisez un point de rassemblement.');
define('Q25_23_RESP', 'Votre point de rassemblement a été érigé ! Un bon pas vers la domination mondiale !');

define('Q25_24', 'Tâche 20 : Caserne');
define('Q25_24_DESC', 'Maintenant vous avez un bâtiment principal niveau 3 et un point de rassemblement. Tous les prérequis pour construire la caserne sont remplis.<br><br>Vous pouvez utiliser la caserne pour entraîner des troupes au combat.');
define('Q25_24_ORDER', 'Ordre :</p>Construisez une caserne.');
define('Q25_24_RESP', 'Bravo... Les meilleurs instructeurs de tout le pays se sont réunis pour entraîner vos hommes au combat à leur meilleur niveau.');

define('Q25_25', 'Tâche 21 : Entraînement.');
define('Q25_25_DESC', 'Maintenant que vous avez la caserne, vous pouvez commencer à entraîner des troupes. Entraînez-en deux ');
define('Q25_25_ORDER', 'Veuillez en entraîner 2 ');
define('Q25_25_RESP', 'Les bases de votre glorieuse armée sont posées.<br><br>Avant d\'envoyer votre armée piller, vous devriez vérifier avec le ');
define('Q25_25_RESP1', 'Simulateur de combat');
define('Q25_25_RESP2', 'pour voir combien de troupes vous avez besoin pour battre un adversaire sans pertes.');

define('Q25_26', 'Tâche 22 : Tout au niveau 2.');
define('Q25_26_DESC', 'Il est temps d\'étendre à nouveau les fondements de la puissance et de la richesse ! Cette fois le niveau 1 ne suffit pas... cela prendra un peu de temps mais au final ça en vaudra la peine. Améliorez toutes vos cases de ressources au niveau 2 !');
define('Q25_26_ORDER', 'Ordre :</p>Améliorez toutes les cases de ressources au niveau 2.');
define('Q25_26_RESP', 'Félicitations ! Votre village grandit et prospère...');

define('Q25_27', 'Tâche 23 : Amis.');
define('Q25_27_DESC', 'En tant que joueur solitaire, il est difficile de rivaliser avec les attaquants. C\'est un avantage d\'être apprécié de vos voisins.<br><br>C\'est encore mieux si vous jouez avec des amis. Saviez-vous que vous pouvez gagner '.GOLD_IMG.' en invitant des amis ?');
define('Q25_27_ORDER', 'Ordre :</p>Combien d\''.GOLD_IMG.' gagnez-vous en invitant un ami ?');
define('Q25_27_RESP', 'Correct ! Vous obtenez 50 '.GOLD_IMG.' si votre ami invité possède 2 villages.');

define('Q25_28', 'Tâche 24 : Construire une ambassade.');
define('Q25_28_DESC', 'Le monde de Travian est dangereux. Vous avez déjà construit une cachette pour vous protéger des attaquants.<br><br>Une bonne alliance vous donnera une protection encore meilleure.');
define('Q25_28_ORDER', 'Ordre :</p>Pour accepter les invitations d\'alliances, construisez une ambassade.');
define('Q25_28_RESP', 'Oui ! Vous pouvez attendre une invitation d\'une alliance ou créer la vôtre si l\'ambassade atteint le niveau 3.');

define('Q25_29', 'Tâche 25 : Alliance.');
define('Q25_29_DESC', 'Le travail d\'équipe est important dans Travian. Les joueurs qui collaborent s\'organisent en alliances. Recevez une invitation d\'une alliance dans votre région et rejoignez-la. Sinon, vous pouvez fonder votre propre alliance. Pour cela, vous avez besoin d\'une ambassade de niveau 3.');
define('Q25_29_ORDER', 'Ordre :</p>Rejoignez une alliance ou fondez la vôtre.');
define('Q25_29_RESP', 'Bravo ! Vous voilà dans une union appelée ');
define('Q25_29_RESP1', ', et vous êtes membre de leur alliance.<br>En collaborant, vous progresserez tous plus vite...');

define('Q25_30', 'Tâches');
define('Q25_30_DESC', 'Toutes les tâches sont terminées !');

//======================================================//
//================ UNITS - DO NOT EDIT! ================//
//======================================================//
define('U0', 'Héros');

//ROMAN UNITS
define('U1', 'Légionnaire');
define('U2', 'Prétorien');
define('U3', 'Impérial');
define('U4', 'Émissaire à cheval');
define('U5', 'Cavalier impérial');
define('U6', 'Cavalier de César');
define('U7', 'Bélier');
define('U8', 'Catapulte de feu');
define('U9', 'Sénateur');
define('U10', 'Colon');

//TEUTON UNITS
define('U11', 'Massueur');
define('U12', 'Hallebardier');
define('U13', 'Combattant à la hache');
define('U14', 'Éclaireur');
define('U15', 'Paladin');
define('U16', 'Chevalier teutonique');
define('U17', 'Bélier');
define('U18', 'Catapulte');
define('U19', 'Commandant');
define('U20', 'Colon');

//GAUL UNITS
define('U21', 'Phalange');
define('U22', 'Combattant à l\'épée');
define('U23', 'Éclaireur');
define('U24', 'Foudre de Teutates');
define('U25', 'Druide cavalier');
define('U26', 'Haeduen');
define('U27', 'Bélier');
define('U28', 'Trébuchet');
define('U29', 'Chef de tribu');
define('U30', 'Colon');
define('U99', 'Piège');

//NATURE UNITS
define('U31', 'Rat');
define('U32', 'Araignée');
define('U33', 'Serpent');
define('U34', 'Chauve-souris');
define('U35', 'Sanglier');
define('U36', 'Loup');
define('U37', 'Ours');
define('U38', 'Crocodile');
define('U39', 'Tigre');
define('U40', 'Éléphant');

//NATARS UNITS
define('U41', 'Piquier');
define('U42', 'Guerrier épineux');
define('U43', 'Garde');
define('U44', 'Oiseaux de proie');
define('U45', 'Cavalier à la hache');
define('U46', 'Chevalier natarian');
define('U47', 'Éléphant de guerre');
define('U48', 'Baliste');
define('U49', 'Empereur natarian');
define('U50', 'Colon natarian');

//MONSTER UNITS
define('U51', 'Monstre péon');
define('U52', 'Chasseur de monstres');
define('U53', 'Monstre guerrier');
define('U54', 'Fantôme');
define('U55', 'Destrier monstrueux');
define('U56', 'Destrier de guerre monstrueux');
define('U57', 'Bélier monstre');
define('U58', 'Catapulte monstre');
define('U59', 'Chef des monstres');
define('U60', 'Monstre colon');

//INDEX.php
define('LOGIN', 'Connexion');
define('PLAYERS', 'Joueurs');
define('MODERATOR', 'Modérateur');
define('ACTIVE', 'Actif');
define('ONLINE', 'En ligne');
define('TUTORIAL', 'Tutoriel');
if(!defined('FAQ')) define('FAQ', 'FAQ');
if(!defined('SPIELREGELN')) define('SPIELREGELN', 'Règles du jeu');
define('PLAYER_STATISTICS', 'Statistiques des joueurs');
define('TOTAL_PLAYERS', PLAYERS.' au total');
define('ACTIVE_PLAYERS', 'Joueurs actifs');
define('ONLINE_PLAYERS', PLAYERS.' en ligne');
define('MP_STRATEGY_GAME', SERVER_NAME.' — le jeu de stratégie multijoueur');
define('WHAT_IS', SERVER_NAME.' est l\'un des jeux de navigateur les plus populaires au monde. En tant que joueur dans '.SERVER_NAME.', vous bâtirez votre propre empire, recruterez une puissante armée et combattrez avec vos alliés pour la suprématie dans le monde du jeu.');
define('REGISTER_FOR_FREE', 'Inscrivez-vous gratuitement ici !');
define('LATEST_GAME_WORLD', 'Dernier monde de jeu');
define('LATEST_GAME_WORLD2', 'Inscrivez-vous au dernier<br>monde de jeu et profitez<br>des avantages d\'être<br>parmi les premiers<br>joueurs.');
define('PLAY_NOW', 'Jouer à '.SERVER_NAME.' maintenant');
define('LEARN_MORE', 'En savoir plus <br>sur '.SERVER_NAME.' !');
define('LEARN_MORE2', 'Maintenant avec un système<br>de serveur révolutionnaire,<br>de nouveaux graphismes<br>— ce clone est extraordinaire !');
define('COMUNITY', 'Communauté');
define('BECOME_COMUNITY', 'Rejoignez notre communauté maintenant !');
define('BECOME_COMUNITY2', 'Faites partie de l\'une<br>des plus grandes<br>communautés de jeu<br>au monde.');
define('NEWS', 'Actualités');
define('SCREENSHOTS', 'Captures d\'écran');
if(!defined('FAQ')) define('FAQ', 'FAQ');
if(!defined('SPIELREGELN')) define('SPIELREGELN', 'Règles');
define('AGB', 'Conditions générales');
define('LEARN1', 'Améliorez vos champs et vos mines pour augmenter votre production de ressources. Vous aurez besoin de ressources pour construire des bâtiments et entraîner des soldats.');
define('LEARN2', 'Construisez et étendez les bâtiments de votre village. Les bâtiments améliorent votre infrastructure globale, augmentent votre production de ressources et vous permettent de rechercher, entraîner et améliorer vos troupes.');
define('LEARN3', 'Observez et interagissez avec votre environnement. Vous pouvez vous faire de nouveaux amis ou de nouveaux ennemis, exploiter les oasis proches et observer votre empire grandir et devenir plus puissant.');
define('LEARN4', 'Suivez vos progrès et vos succès et comparez-vous aux autres joueurs. Consultez les classements Top 10 et combattez pour remporter une médaille hebdomadaire.');
define('LEARN5', 'Recevez des rapports détaillés sur vos aventures, échanges et batailles. N\'oubliez pas de consulter les nouveaux rapports sur les événements qui se déroulent dans vos environs.');
define('LEARN6', 'Échangez des informations et menez votre diplomatie avec les autres joueurs. Souvenez-vous toujours que la communication est la clé pour gagner de nouveaux amis et résoudre d\'anciens conflits.');
define('LOGIN_TO', 'Se connecter à '.SERVER_NAME);
define('REGIN_TO', 'S\'inscrire à '.SERVER_NAME);
define('P_ONLINE', 'Joueurs en ligne : ');
define('P_TOTAL', 'Joueurs au total : ');
define('CHOOSE', 'Veuillez choisir un serveur.');
define('STARTED', ' Le serveur a démarré il y a '. round((time() - COMMENCE) / 86400) .' jours.');

//ANMELDEN.php
define('NICKNAME', 'Pseudonyme');
define('EMAIL', 'E-mail');
define('PASSWORD', 'Mot de passe');
define('NW', 'Nord-Ouest');
define('NE', 'Nord-Est');
define('SW', 'Sud-Ouest');
define('SE', 'Sud-Est');
define('RANDOM', 'Aléatoire');
define('ACCEPT_RULES', ' J\'accepte les règles du jeu et les conditions générales.');
define('ONE_PER_SERVER', 'Chaque joueur ne peut posséder qu\'UN seul compte par serveur.');
define('BEFORE_REGISTER', 'Avant de créer un compte, vous devriez lire les <a href="/anleitung.php" target="_blank">instructions</a> de Travian RO1 pour voir les avantages et inconvénients spécifiques des trois tribus.');
define('BUILDING_UPGRADING', 'Construction :');
define('HOURS', 'heures');


//ATTACKS ETC.
define('TROOP_MOVEMENTS', 'Mouvements de troupes :');
define('ARRIVING_REINF_TROOPS', 'Renforts en approche');
define('ARRIVING_ATTACKING_TROOPS', 'Troupes attaquantes en approche');
define('ARRIVING_REINF_TROOPS_SHORT', 'Renf.');
define('OWN_ATTACKING_TROOPS', 'Vos troupes d\'attaque');
define('ATTACK', 'Attaque');
define('OWN_REINFORCING_TROOPS', 'Vos troupes de renfort');
define('NEWVILLAGE', 'Nouveau village.');
define('FOUNDNEWVILLAGE', 'Fondation d\'un nouveau village');
define('UNDERATTACK', 'Le village est attaqué');
define('OASISATTACK', 'L\'oasis est attaquée');
define('OASISATTACKS', 'Att. oasis');
define('RETURNFROM', 'Retour de');
define('REINFORCEMENTFOR', 'Renfort vers');
define('ATTACK_ON', 'Attaque sur');
define('RAID_ON', 'Pillage sur');
define('SCOUTING', 'Espionnage');
define('PRISONERS', 'Prisonniers');
define('PRISONERSIN', 'Prisonniers à');
define('PRISONERSFROM', 'Prisonniers de');
define('TROOPS', 'Troupes');
define('BOUNTY', 'Butin');
define('ARRIVAL', 'Arrivée');
define('CATAPULT_TARGET', 'Cible(s) de catapulte');
define('INCOMING_TROOPS', 'Troupes en approche');
define('TROOPS_ON_THEIR_WAY', 'Troupes en chemin');
define('OWN_TROOPS', 'Vos troupes');
define('ON', 'sur');
define('AT', 'à');
define('UPKEEP', 'Entretien');
define('SEND_BACK', 'Renvoyer');
define('TROOPS_IN_THE_VILLAGE', 'Troupes dans le village');
define('TROOPS_IN_OTHER_VILLAGE', 'Troupes dans un autre village');
define('TROOPS_IN_OASIS', 'Troupes dans l\'oasis');
define('KILL', 'Tuer');
define('FROM', 'De');
define('SEND_TROOPS', 'Envoyer des troupes');
define('TASKMASTER', 'Surveillant');
define('TO_THE_TASK', 'Vers la tâche');
define('VILLAGE_OF_THE_ELDERS', 'Village des anciens');
define('VILLAGE_OF_THE_ELDERS_TROOPS', 'Troupes du village des anciens');

//SEND TROOP
define('REINFORCE', 'Renfort');
define('NORMALATTACK', 'Attaque normale');
define('RAID', 'Pillage');
define('OR', 'ou');
define('SENDTROOP', 'Envoyer des troupes');
define('NOTROOP', 'Aucune troupe');

//map
define('DETAIL', 'Détails');
define('ABANDVALLEY', 'Vallée abandonnée');
define('OCCUPIED', 'Occupé');
define('UNOCCUPIED', 'Inoccupé');
define('UNOCCUOASIS', 'Oasis inoccupée');
define('OCCUOASIS', 'Oasis occupée');
define('THERENOINFO', 'Aucune information<br>disponible.');
define('LANDDIST', 'Distribution des terres');
define('TRIBE', 'Tribu');
define('ALLIANCE', 'Alliance');
define('POP', 'Population');
define('REPORT', 'Rapport');
define('OPTION', 'Options');
define('CENTREMAP', 'Centrer la carte');
define('FNEWVILLAGE', 'Fonder un nouveau village');
define('CULTUREPOINT', 'Points de culture');
define('BUILDRALLY', 'Construire un point de rassemblement');
define('SETTLERSAVAIL', 'Colons disponibles');
define('BEGINPRO', 'Protection des débutants');
define('SENDMERC', 'Envoyer marchand(s)');
define('BAN', 'Joueur banni');
define('BUILDMARKET', 'Construire le marché');
define('PERHOUR', 'par heure');
define('BONUS', 'Bonus');
define('MAP', 'Carte');
define('LARGE_MAP', 'Grande carte');
define('LARGE_MAP_DESC', 'Afficher la grande carte dans une fenêtre séparée');
define('CROPFINDER', 'Recherche de céréales');
define('NORTH', 'Nord');
define('EAST', 'Est');
define('SOUTH', 'Sud');
define('WEST', 'Ouest');
define('CLOSE_MAP', 'Fermer la carte');
define('AND', 'et');

//other
define('VILLAGE', 'Village');
define('STATISTICS', 'Statistiques');
define('ALLIANCES', 'Alliances');
define('HEROES', 'Héros');
define('GENERAL', 'Général');
define('OASIS', 'Oasis');
define('NO_OASIS', 'Vous ne possédez aucune oasis.');
define('NO_VILLAGES', 'Il n\'y a pas de villages.');
define('PLAYER', 'Joueur');

//LOGIN.php
define('COOKIES', 'Vous devez avoir les cookies activés pour pouvoir vous connecter. Si vous partagez cet ordinateur avec d\'autres personnes, vous devriez vous déconnecter après chaque session pour votre sécurité.');
define('NAME', 'Nom');
define('PW_FORGOTTEN', 'Mot de passe oublié ?');
define('PW_REQUEST', 'Vous pouvez en demander un nouveau qui sera envoyé à votre adresse e-mail.');
define('PW_GENERATE', 'Générer un nouveau mot de passe.');
define('EMAIL_NOT_VERIFIED', 'E-mail non vérifiée !');
define('EMAIL_FOLLOW', 'Suivez ce lien pour activer votre compte.');
define('VERIFY_EMAIL', 'Vérifier l\'e-mail.');
define('SERVER_STARTS_IN', 'Le serveur démarrera dans : ');
define('START_NOW', 'COMMENCER MAINTENANT');


//404.php
define('NOTHING_HERE', 'Rien ici !');
define('WE_LOOKED', 'Nous avons déjà cherché 404 fois mais ne trouvons rien.');

//MASSMESSAGE.php
define('MASS', 'Contenu du message');
define('MASS_SUBJECT', 'Sujet :');
define('MASS_COLOR', 'Couleur du message :');
define('MASS_REQUIRED', 'Tous les champs sont requis');
define('MASS_UNITS', 'Images (unités) :');
define('MASS_SHOWHIDE', 'Afficher/Masquer');
define('MASS_READ', 'Lisez ceci : après avoir ajouté une émoticône, vous devez ajouter « left » ou « right » après le numéro, sinon l\'image ne fonctionnera pas.');
define('MASS_CONFIRM', 'Confirmation');
define('MASS_REALLY', 'Voulez-vous vraiment envoyer le MassIGM ?');
define('MASS_ABORT', 'Annulation immédiate');
define('MASS_SENT', 'Le MassIGM a été envoyé');

//BUILDINGS
define('WOODCUTTER', 'Bûcheron');
define('WOODCUTTER_DESC', 'Le bûcheron abat des arbres pour produire du bois. Plus son niveau est élevé, plus la production de bois augmente.<br>En construisant une scierie, vous pouvez encore augmenter la production.');
define('CLAYPIT', 'Carrière d\'argile');
define('CLAYPIT_DESC', 'L\'argile est produite ici. Plus son niveau est élevé, plus la production d\'argile augmente.<br>En construisant une briqueterie, vous pouvez encore augmenter la production.');
define('IRONMINE', 'Mine de fer');
define('IRONMINE_DESC', 'Les mineurs y extraient la précieuse ressource du fer. Plus son niveau est élevé, plus la production de fer augmente.<br>En construisant une fonderie de fer, vous pouvez encore augmenter la production.');
define('CROPLAND', 'Champ de céréales');
define('CROPLAND_DESC', 'La nourriture de votre population est produite ici. Plus le niveau du champ augmente, plus la production de céréales progresse.<br>En construisant un moulin à grain et une boulangerie, vous pouvez encore augmenter la production.');

define('SAWMILL', 'Scierie');
define('SAWMILL_DESC', 'Le bois coupé par vos bûcherons est traité ici. La scierie augmente la production de bois du village. Au niveau 1, elle augmente la production de bois de 5 %, et à chaque amélioration, la production augmente de 5 % supplémentaires, pour un total de 25 % après 5 niveaux.<br>Le bonus de la scierie et de tous les bâtiments procurant des bonus de ressources ne s\'applique qu\'au village dans lequel le bâtiment est construit.<br>Notez que le bonus de la scierie ne s\'applique pas à d\'autres bonus comme le revenu des oasis ou le bonus PLUS de 10 %.<br>Il existe aussi des villages composés de 3 ou 5 champs de bois. Plus il y a de champs dans un village, plus les niveaux de scierie peuvent être efficaces.');
define('CURRENT_WOOD_BONUS', 'Bonus bois actuel :');
define('WOOD_BONUS_LEVEL', 'Bonus bois au niveau');
define('MAX_LEVEL', 'Bâtiment déjà au niveau maximum');
define('PERCENT', 'Pour cent');

define('BRICKYARD', 'Briqueterie');
define('CURRENT_CLAY_BONUS', 'Bonus argile actuel :');
define('CLAY_BONUS_LEVEL', 'Bonus argile au niveau');
define('BRICKYARD_DESC', 'L\'argile est transformée en briques ici. La briqueterie augmente la production d\'argile du village. Au niveau 1, elle augmente la production d\'argile de 5 %, et à chaque amélioration, la production augmente de 5 % supplémentaires, pour un total de 25 % après 5 niveaux.<br>Le bonus de la briqueterie et de tous les bâtiments procurant des bonus de ressources ne s\'applique qu\'au village dans lequel le bâtiment est construit.<br>Notez que le bonus de la briqueterie ne s\'applique pas à d\'autres bonus comme le revenu des oasis ou le bonus PLUS de 10 %.<br>Il existe aussi des villages composés de 3 ou 5 champs d\'argile. Plus il y a de champs dans un village, plus les niveaux de briqueterie peuvent être efficaces.');

define('IRONFOUNDRY', 'Fonderie de fer');
define('CURRENT_IRON_BONUS', 'Bonus fer actuel :');
define('IRON_BONUS_LEVEL', 'Bonus fer au niveau');
define('IRONFOUNDRY_DESC', 'Le fer est fondu ici. La fonderie augmente la production de fer du village. Au niveau 1, elle augmente la production de fer de 5 %, et à chaque amélioration, la production augmente de 5 % supplémentaires, pour un total de 25 % après 5 niveaux.<br>Le bonus de la fonderie et de tous les bâtiments procurant des bonus de ressources ne s\'applique qu\'au village dans lequel le bâtiment est construit.<br>Notez que le bonus de la fonderie ne s\'applique pas à d\'autres bonus comme le revenu des oasis ou le bonus PLUS de 10 %.<br>Il existe aussi des villages composés de 3 ou 5 champs de fer. Plus il y a de champs dans un village, plus les niveaux de fonderie peuvent être efficaces.');

define('GRAINMILL', 'Moulin à grain');
define('CURRENT_CROP_BONUS', 'Bonus céréales actuel :');
define('CROP_BONUS_LEVEL', 'Bonus céréales au niveau');
define('GRAINMILL_DESC', 'Le grain est moulu en farine ici. Le moulin à grain augmente la production de nourriture du village. Au niveau 1, il augmente la production de 5 %, et à chaque amélioration, la production augmente de 5 % supplémentaires, pour un total de 25 % après 5 niveaux.<br>Utilisé conjointement avec la boulangerie, vous pouvez augmenter la production de céréales jusqu\'à 50 %.<br>Le bonus du moulin et de tous les bâtiments procurant des bonus de ressources ne s\'applique qu\'au village dans lequel le bâtiment est construit.<br>Notez que le bonus du moulin ne s\'applique pas à d\'autres bonus comme le revenu des oasis ou le bonus PLUS de 10 %.<br>Il existe aussi des villages composés de 9 ou 15 champs de céréales. Plus il y a de champs dans un village, plus les niveaux de moulin peuvent être efficaces.');

define('BAKERY', 'Boulangerie');
define('BAKERY_DESC', 'Le pain est cuit à partir de farine ici. La boulangerie augmente la production de nourriture du village. Au niveau 1, elle augmente la production de 5 %, et à chaque amélioration, la production augmente de 5 % supplémentaires, pour un total de 25 % après 5 niveaux.<br>Utilisée conjointement avec le moulin à grain, elle peut augmenter la production de céréales jusqu\'à 50 %.<br>Le bonus de la boulangerie et de tous les bâtiments procurant des bonus de ressources ne s\'applique qu\'au village dans lequel le bâtiment est construit.<br>Notez que le bonus de la boulangerie ne s\'applique pas à d\'autres bonus comme le revenu des oasis ou le bonus PLUS de 10 %.<br>Il existe aussi des villages composés de 9 ou 15 champs de céréales. Plus il y a de champs dans un village, plus les niveaux de boulangerie peuvent être efficaces.');

define('WAREHOUSE', 'Entrepôt');
define('CURRENT_CAPACITY', 'Capacité actuelle :');
define('CAPACITY_LEVEL', 'Capacité au niveau');
define('RESOURCE_UNITS', 'Unités de ressources');
define('WAREHOUSE_DESC', 'Les ressources bois, argile et fer sont stockées dans l\'entrepôt. En augmentant son niveau, vous augmentez sa capacité. Peut être construit plusieurs fois, une fois le premier au niveau maximum.');

define('GRANARY', 'Grenier');
define('CROP_UNITS', 'Unités de céréales');
define('GRANARY_DESC', 'Les céréales produites par vos fermes sont stockées dans le grenier. En augmentant son niveau, vous augmentez sa capacité. Peut être construit plusieurs fois, une fois le premier au niveau maximum.');

define('BLACKSMITH', 'Forge');
define('ACTION', 'Action');
define('UPGRADE', 'Améliorer');
define('UPGRADE_IN_PROGRESS', 'Amélioration en<br>cours');
define('UPGRADE_BLACKSMITH', 'Améliorer la<br>forge');
define('UPGRADES_COMMENCE_BLACKSMITH', 'Les améliorations pourront commencer une fois la forge terminée.');
define('MAXIMUM_LEVEL', 'Niveau<br>maximum');
define('EXPAND_WAREHOUSE', 'Étendre<br>l\'entrepôt');
define('EXPAND_GRANARY', 'Étendre<br>le grenier');
define('ENOUGH_RESOURCES', 'Ressources suffisantes');
define('CROP_NEGATIVE ', 'La production de céréales est négative, vous n\'atteindrez jamais les ressources requises.');
define('TOO_FEW_RESOURCES', 'Trop peu de<br>ressources');
define('UPGRADING', 'Amélioration');
define('DURATION', 'Durée');
define('COMPLETE', 'Terminé');
define('BLACKSMITH_DESC', 'Les armes de vos guerriers sont améliorées dans les fours de la forge. En augmentant son niveau, vous pouvez ordonner la fabrication d\'armes encore meilleures.');

define('ARMOURY', 'Armurerie');
define('UPGRADE_ARMOURY', 'Améliorer<br>l\'armurerie');
define('UPGRADES_COMMENCE_ARMOURY', 'Les améliorations pourront commencer une fois l\'armurerie terminée.');
define('ARMOURY_DESC', 'L\'armure de vos guerriers est améliorée dans les fours de l\'armurerie. En augmentant son niveau, vous pouvez ordonner la fabrication d\'armures encore meilleures.');

define('TOURNAMENTSQUARE', 'Place du tournoi');
define('CURRENT_SPEED', 'Bonus de vitesse actuel :');
define('SPEED_LEVEL', 'Bonus de vitesse au niveau');
define('TOURNAMENTSQUARE_DESC', 'Vos troupes peuvent augmenter leur endurance à la place du tournoi. Plus le bâtiment est amélioré, plus vos troupes sont rapides au-delà d\'une distance minimale de '.TS_THRESHOLD.' cases.');

define('MAINBUILDING', 'Bâtiment principal');
define('CURRENT_CONSTRUCTION_TIME', 'Temps de construction actuel :');
define('CONSTRUCTION_TIME_LEVEL', 'Temps de construction au niveau');
define('DEMOLITION_BUILDING', 'Démolition d\'un bâtiment :</h2><p>Si vous n\'avez plus besoin d\'un bâtiment, vous pouvez en ordonner la démolition.</p>');
define('DEMOLISH', 'Démolir');
define('DEMOLITION_OF', 'Démolition de ');
define('MAINBUILDING_DESC', 'Les maîtres d\'œuvre du village habitent dans le bâtiment principal. Plus son niveau est élevé, plus vos maîtres d\'œuvre construisent rapidement de nouveaux bâtiments.');

define('RALLYPOINT', 'Point de rassemblement');
define('RALLYPOINT_COMMENCE', 'Les mouvements de troupes seront affichés une fois le '.RALLYPOINT.' terminé.');
define('OVERVIEW', 'Vue d\'ensemble');
define('REINFORCEMENT', 'Renfort');
define('EVASION_SETTINGS', 'Paramètres d\'évasion');
define('SEND_TROOPS_AWAY_MAX', 'Envoyer les troupes au maximum');
define('TIMES', 'fois');
define('PER_EVASION', 'par évasion');
define('RALLYPOINT_DESC', 'Les troupes de votre village se rassemblent ici. De là, vous pouvez les envoyer conquérir, piller ou renforcer d\'autres villages.<br>S\'il y a moins d\'unités attaquantes que le niveau du point de rassemblement, vous pouvez voir le type d\'unité qui attaque.');
define('COMBAT_SIMULATOR', 'Simulateur de combat');

define('MARKETPLACE', 'Marché');
define('MERCHANT', 'Marchands');
define('OR_', 'ou');
define('GO', 'Lancer');
define('UNITS_OF_RESOURCE', 'unités de ressources');
define('MERCHANT_CARRY', 'Chaque marchand peut transporter');
define('MERCHANT_COMING', 'Marchands en approche');
define('TRANSPORT_FROM', 'Transport depuis');
define('ARRIVAL_IN', 'Arrivée dans');
define('NO_COORDINATES_SELECTED', 'Aucune coordonnée sélectionnée');
define('CANNOT_SEND_RESOURCES', 'Vous ne pouvez pas envoyer de ressources vers le même village');
define('BANNED_CANNOT_SEND_RESOURCES', 'Le joueur est banni. Vous ne pouvez pas lui envoyer de ressources.');
define('RESOURCES_NO_SELECTED', 'Ressources non sélectionnées');
define('ENTER_COORDINATES', 'Saisissez les coordonnées ou le nom du village');
define('TOO_FEW_MERCHANTS', 'Trop peu de marchands');
define('OWN_MERCHANTS_ONWAY', 'Vos marchands en chemin');
define('MERCHANTS_RETURNING', 'Marchands en retour');
define('TRANSPORT_TO', 'Transport vers');
define('I_AN_SEARCHING', 'Je recherche');
define('I_AN_OFFERING', 'J\'offre');
define('OFFERS_MARKETPLACE', 'Offres au marché');
define('NO_AVAILABLE_OFFERS', 'Aucune offre disponible au marché');
define('OFFERED_TO_ME', 'Offert<br>par moi');
define('WANTED_TO_ME', 'Demandé<br>par moi');
define('NOT_ENOUGH_MERCHANTS', 'Pas assez de marchands');
define('ACCEP_OFFER', 'Accepter l\'offre');
define('NO_AVALIBLE_OFFERS', 'Il n\'y a aucune offre disponible sur le marché');
define('SEARCHING', 'Recherche');
define('OFFERING', 'Offre');
define('MAX_TIME_TRANSPORT', 'Durée de transport max.');
define('OWN_ALLIANCE_ONLY', 'Alliance personnelle uniquement');
define('INVALID_OFFER', 'Offre invalide');
define('INVALID_MERCHANTS_REPETITION', 'Taux de répétition des marchands invalide');
define('USER_ON_VACATION', 'Le joueur est en mode vacances');
define('VACATION_MODE', 'Mode vacances');
define('VACATION_DESC', 'Si vous prévoyez d\'être absent pendant une longue période et ne souhaitez pas désigner un substitut, vous pouvez mettre votre compte en mode vacances. Pendant cette période, votre compte cessera de produire des ressources, points de culture, recherches, troupes, etc., et cessera de recevoir attaques, renforts et pillages, gelant essentiellement votre compte. Souvenez-vous que cela ne fige que votre Travian, pas le temps. Si vous êtes membre du Gold Club, il continuera à s\'écouler pendant cette période et si vous avez l\'auto-renouvellement activé, il sera annulé en mode vacances. Note : vous devez activer le mode vacances pour un minimum de 2 jours et un maximum de 14 jours.');
define('VACATION_DESC2', 'Utilisez le mode vacances pour protéger vos villages pendant votre absence.<br>Pendant les vacances, les actions suivantes seront inactives :');
define('VAC_OP1', 'Envoyer ou recevoir des troupes');
define('VAC_OP2', 'Démarrer une nouvelle construction');
define('VAC_OP3', 'Utiliser le marché');
define('VAC_OP4', 'Entraîner de nouvelles troupes');
define('VAC_OP5', 'Rejoindre une alliance');
define('VAC_OP6', 'Supprimer le compte');
define('VAC_COND1', 'Aucune troupe en mouvement');
define('VAC_COND2', 'Aucune troupe en route vers d\'autres villages');
define('VAC_COND3', 'Aucune troupe envoyée en renfort dans d\'autres villages');
define('VAC_COND4', 'Aucun joueur n\'a de renforts dans vos villages');
define('VAC_COND5', 'Aucune Merveille du monde');
define('VAC_COND6', 'Aucun artefact');
define('VAC_COND7', 'Vous n\'êtes plus sous protection des débutants');
define('VAC_COND8', 'Aucune troupe dans vos pièges');
define('VAC_COND9', 'Votre compte n\'est pas en cours de suppression');
define('NOT_ENOUGH_RESOURCES', 'Ressources insuffisantes');
define('OFFER', 'Offrir');
define('SEARCH', 'Rechercher');
define('OWN_OFFERS', 'Mes offres');
define('ALL', 'Tout');
define('NPC_TRADE', 'Échange PNJ');
define('SUM', 'Somme');
define('REST', 'Reste');
define('TRADE_RESOURCES', 'Échanger les ressources (étape 2 sur 2)');
define('DISTRIBUTE_RESOURCES', 'Répartir les ressources (étape 1 sur 2)');
define('OF', 'de');
define('NPC_COMPLETED', 'PNJ terminé');
define('BACK_BUILDING', 'Retour à la construction');
define('YOU_CAN_NAT_NPC_WW', 'Vous ne pouvez pas utiliser l\'échange PNJ dans un village de Merveille.');
define('NPC_TRADING', 'Échange PNJ');
define('SEND_RESOURCES', 'Envoyer des ressources');
define('BUY', 'Acheter');
define('TRADE_ROUTES', 'Routes commerciales');
define('DESCRIPTION', 'Description');
define('G_DESCR', 'Description générale');
define('TIME_LEFT', 'Temps restant');
define('START', 'Démarrer');
define('NO_TRADE_ROUTES', 'Aucune route commerciale active');
define('TRADE_ROUTE_TO', 'Route commerciale vers');
define('CHECKED', 'coché');
define('DAYS', 'jours');
define('EXTEND', 'Étendre');
define('EDIT', 'Modifier');
define('EXTEND_TRADE_ROUTES', 'Étendre la route commerciale de <b>7</b> jours pour');
define('CREATE_TRADE_ROUTES', 'Créer une nouvelle route commerciale');
define('DELIVERIES', 'Livraisons');
define('START_TIME_TRADE', 'Heure de départ');
define('CREATE_TRADE_ROUTE', 'Créer une route commerciale');
define('TARGET_VILLAGE', 'Village cible');
define('EDIT_TRADE_ROUTES', 'Modifier la route commerciale');
define('TRADE_ROUTES_DESC', 'Les routes commerciales vous permettent de définir des itinéraires pour vos marchands qui les parcourront chaque jour à une heure fixe.<br><br>Par défaut, cela dure <b>7</b> jours, mais vous pouvez prolonger de <b>7</b> jours pour le coût de');
define('NPC_TRADE_DESC', 'Avec le marchand PNJ, vous pouvez répartir les ressources de votre entrepôt comme vous le souhaitez.<br><br>La première ligne affiche le stock actuel. Dans la deuxième ligne, vous pouvez choisir une autre répartition. La troisième ligne affiche la différence entre l\'ancien et le nouveau stock.');
define('MARKETPLACE_DESC', 'Au marché, vous pouvez échanger des ressources avec d\'autres joueurs. Plus son niveau est élevé, plus vos marchands peuvent transporter de ressources en même temps.');

define('EMBASSY', 'Ambassade');
define('TAG', 'Tag');
define('TO_THE_ALLIANCE', 'à l\'alliance');
define('JOIN_ALLIANCE', 'Rejoindre l\'alliance');
define('REFUSE', 'Refuser');
define('ACCEPT', 'Accepter');
define('NO_INVITATIONS', 'Aucune invitation disponible.');
define('NO_CREATE_ALLIANCE', 'Un joueur banni ne peut pas créer d\'alliance.');
define('FOUND_ALLIANCE', 'Fonder une alliance');
define('EMBASSY_DESC', 'L\'ambassade est un lieu pour les diplomates. Au niveau 1, vous pouvez rejoindre une alliance, et à partir du niveau 3, vous pouvez même en fonder une vous-même.<br>Le nombre maximum de membres dans une alliance est 60.');

define('BARRACKS', 'Caserne');
define('QUANTITY', 'Quantité');
define('MAX', 'Max');
define('TRAINING', 'Entraînement');
define('FINISHED', 'Terminé');
define('UNIT_FINISHED', 'La prochaine unité sera terminée dans');
define('AVAILABLE', 'Disponible');
define('TRAINING_COMMENCE_BARRACKS', 'L\'entraînement pourra commencer une fois la caserne terminée.');
define('BARRACKS_DESC', 'L\'infanterie peut être entraînée à la caserne. Plus son niveau est élevé, plus rapidement les troupes sont entraînées.');

define('STABLE', 'Écurie');
define('AVAILABLE_ACADEMY', 'Aucune unité disponible. Recherchez à l\'académie.');
define('TRAINING_COMMENCE_STABLE', 'L\'entraînement pourra commencer une fois l\'écurie terminée.');
define('STABLE_DESC', 'La cavalerie peut être entraînée à l\'écurie. Plus son niveau est élevé, plus rapidement les troupes sont entraînées.');

define('WORKSHOP', 'Atelier');
define('TRAINING_COMMENCE_WORKSHOP', 'L\'entraînement pourra commencer une fois l\'atelier terminé.');
define('WORKSHOP_DESC', 'Les machines de siège, comme les catapultes et les béliers, peuvent être fabriquées à l\'atelier. Plus son niveau est élevé, plus rapidement ces unités sont produites.');

define('ACADEMY', 'Académie');
define('RESEARCH_AVAILABLE', 'Aucune recherche disponible');
define('RESEARCH_COMMENCE_ACADEMY', 'La recherche pourra commencer une fois l\'académie terminée.');
define('RESEARCH', 'Recherche');
define('EXPAND_WAREHOUSE1', 'Étendre l\'entrepôt');
define('EXPAND_GRANARY1', 'Étendre le grenier');
define('RESEARCH_IN_PROGRESS', 'Recherche en<br>cours');
define('RESEARCHING', 'Recherche');
define('PREREQUISITES', 'Prérequis');
define('SHOW_MORE', 'Afficher plus');
define('HIDE_MORE', 'Masquer plus');
define('ACADEMY_DESC', 'De nouveaux types d\'unités peuvent être recherchés à l\'académie. En augmentant son niveau, vous pouvez ordonner la recherche d\'unités meilleures.');

define('CRANNY', 'Cachette');
define('CURRENT_HIDDEN_UNITS', 'Unités actuellement cachées par ressource :');
define('HIDDEN_UNITS_LEVEL', 'Unités cachées par ressource au niveau');
define('UNITS', 'unités');
define('CRANNY_DESC', 'La cachette dissimule une partie de vos ressources en cas d\'attaque du village. Ces ressources ne peuvent pas être volées.<br>Au niveau 1, la cachette peut contenir '.(100*((int)CRANNY_CAPACITY)).' de chaque ressource. La capacité des cachettes gauloises est 1,5 fois supérieure.<br>Si un héros teuton attaque un village, les cachettes ne peuvent dissimuler que 80 % de leur capacité normale.');

define('TOWNHALL', 'Hôtel de ville');
define('CELEBRATIONS_COMMENCE_TOWNHALL', 'Les célébrations pourront commencer une fois l\'hôtel de ville terminé.');
define('GREAT_CELEBRATIONS', 'Grande célébration');
define('CULTURE_POINTS', 'Points de culture');
define('HOLD', 'Tenir');
define('CELEBRATIONS_IN_PROGRESS', 'Célébration<br>en cours');
define('CELEBRATIONS', 'Célébrations');
define('TOWNHALL_DESC', 'Vous pouvez tenir des célébrations fastueuses à l\'hôtel de ville. Une telle célébration augmente vos points de culture.<br>Les points de culture sont nécessaires pour fonder ou conquérir de nouveaux villages. Chaque bâtiment produit des points de culture, et plus son niveau est élevé, plus il en produit.');

define('RESIDENCE', 'Résidence');
define('CAPITAL', 'Ceci est votre capitale');
define('RESIDENCE_TRAIN_DESC', 'Pour fonder un nouveau village, vous avez besoin d\'une résidence de niveau 10 ou 20 et de 3 colons. Pour conquérir un nouveau village, vous avez besoin d\'une résidence de niveau 10 ou 20 et d\'un sénateur, chef ou chef de tribu.');
define('PRODUCTION_POINTS', 'Production de ce village :');
define('PRODUCTION_ALL_POINTS', 'Production de tous les villages :');
define('POINTS_DAY', 'Points de culture par jour');
define('VILLAGES_PRODUCED', 'Vos villages ont produit');
define('POINTS_NEED', 'points au total. Pour fonder ou conquérir un nouveau village, vous avez besoin de');
define('POINTS', 'points');
define('INHABITANTS', 'Habitants');
define('COORDINATES', 'Coordonnées');
define('EXPANSION', 'Expansion');
define('TRAIN', 'Entraîner');
define('DATE', 'Date');
define('CONQUERED_BY_VILLAGE', 'Villages fondés ou conquis par ce village');
define('NONE_CONQUERED_BY_VILLAGE', 'Aucun autre village n\'a encore été fondé ou conquis par ce village.');
define('RESIDENCE_CULTURE_DESC', 'Pour étendre votre empire, vous avez besoin de points de culture. Ces points augmentent avec le temps et plus rapidement à mesure que vos niveaux de bâtiments augmentent.');
define('RESIDENCE_LOYALTY_DESC', 'En attaquant avec des sénateurs, chefs ou chefs de tribu, la loyauté d\'un village peut être réduite. Si elle atteint zéro, le village rejoint le royaume de l\'attaquant. La loyauté de ce village est actuellement à ');
define('RESIDENCE_DESC', 'La résidence protège le village contre les conquêtes ennemies. Vous pouvez construire une résidence par village. Les unités capables de fonder un nouveau village ou de conquérir des villages existants peuvent y être entraînées.<br>De plus, la résidence offre un emplacement d\'expansion aux niveaux 10 et 20.');

define('PALACE', 'Palais');
define('PALACE_CONSTRUCTION', 'Palais en construction');
define('PALACE_TRAIN_DESC', 'Pour fonder un nouveau village, vous avez besoin d\'un palais de niveau 10, 15 ou 20 et de 3 colons. Pour conquérir un nouveau village, vous avez besoin d\'un palais de niveau 10, 15 ou 20 et d\'un sénateur, chef ou chef de tribu.');
define('CHANGE_CAPITAL', 'Changer de capitale');
define('SECURITY_CHANGE_CAPITAL', 'Êtes-vous sûr de vouloir changer votre capitale ?<br><b>Cette action est irréversible !</b><br>Pour des raisons de sécurité, vous devez saisir votre mot de passe pour confirmer :<br>');
define('PALACE_DESC', 'Le palais est un bâtiment unique. Vous ne pouvez en construire qu\'un dans tout votre royaume et vous pouvez proclamer ce village comme capitale. Il protège aussi le village contre les conquêtes ennemies. Les unités capables de fonder un nouveau village ou de conquérir des villages existants peuvent y être entraînées.<br>De plus, le palais offre un emplacement d\'expansion aux niveaux 10, 15 et 20.');

define('TREASURY', 'Trésorerie');
define('TREASURY_COMMENCE', 'Les artefacts pourront être consultés une fois la trésorerie terminée.');
define('ARTEFACTS_AREA', 'Artefacts dans votre zone');
define('NO_ARTEFACTS_AREA', 'Il n\'y a aucun artefact dans votre zone.');
define('OWN_ARTEFACTS', 'Mes artefacts');
define('CONQUERED', 'Conquis');
define('DISTANCE', 'Distance');
define('EFFECT', 'Effet');
define('ACCOUNT', 'Compte');
define('SMALL_ARTEFACTS', 'Petits artefacts');
define('LARGE_ARTEFACTS', 'Grands artefacts');
define('NO_ARTEFACTS', 'Il n\'y a aucun artefact.');
define('ANY_ARTEFACTS', 'Vous ne possédez aucun artefact.');
define('OWNER', 'Propriétaire');
define('AREA_EFFECT', 'Zone d\'effet');
define('VILLAGE_EFFECT', 'Effet sur le village');
define('ACCOUNT_EFFECT', 'Effet sur le compte');
define('UNIQUE_EFFECT', 'Effet unique');
define('REQUIRED_LEVEL', 'Niveau requis');
define('TIME_CONQUER', 'Date de conquête');
define('TIME_ACTIVATION', 'Date d\'activation');
define('NEXT_EFFECT', ' Effet suivant');
define('FORMER_OWNER', 'Ancien(s) propriétaire(s)');
define('BUILDING_STRONGER', 'Construire plus solidement avec');
define('BUILDING_WEAKER', 'Construire moins solidement avec');
define('TROOPS_FASTER', 'Rendre les troupes plus rapides avec');
define('TROOPS_SLOWEST', 'Rendre les troupes plus lentes avec');
define('SPIES_INCREASE', 'Augmenter la capacité des espions avec');
define('SPIES_DECRESE', 'Diminuer la capacité des espions avec');
define('CONSUME_LESS', 'Toutes les troupes consomment moins avec');
define('CONSUME_HIGH', 'Toutes les troupes consomment plus avec');
define('TROOPS_MAKE_FASTER', 'Les troupes sont produites plus vite avec');
define('TROOPS_MAKE_SLOWEST', 'Les troupes sont produites plus lentement avec');
define('YOU_CONSTRUCT', 'Vous pouvez construire ');
define('CRANNY_INCREASED', 'La capacité de la cachette est augmentée de');
define('CRANNY_DECRESE', 'La capacité de la cachette est diminuée de');
define('WW_BUILDING_PLAN', 'Vous pouvez construire la Merveille du monde');
define('NO_WW', 'Il n\'y a aucune Merveille du monde');
define('NO_PREVIOUS_OWNERS', 'Il n\'y a aucun propriétaire précédent.');
define('TREASURY_DESC', 'Les richesses de votre empire sont conservées dans la trésorerie. Une trésorerie ne peut contenir qu\'un seul artefact à la fois.<br>Vous avez besoin d\'une trésorerie de niveau 10 pour un petit artefact, ou de niveau 20 pour un grand.');

define('TRADEOFFICE', 'Bureau de commerce');
define('CURRENT_MERCHANT', 'Charge actuelle des marchands :');
define('MERCHANT_LEVEL', 'Charge des marchands au niveau');
define('TRADEOFFICE_DESC', 'Au bureau de commerce, les chariots des marchands sont améliorés et équipés de chevaux plus puissants. Plus son niveau est élevé, plus vos marchands peuvent transporter.');

define('GREATBARRACKS', 'Grande caserne');
define('TRAINING_COMMENCE_GREATBARRACKS', 'L\'entraînement pourra commencer une fois la grande caserne terminée.');
define('GREATBARRACKS_DESC', 'La grande caserne vous permet de construire une deuxième caserne dans le même village, mais les troupes coûtent 3 fois le montant initial.<br>Combinée avec la caserne normale, vous pouvez entraîner vos troupes deux fois plus vite dans un village.');

define('GREATSTABLE', 'Grande écurie');
define('TRAINING_COMMENCE_GREATSTABLE', 'L\'entraînement pourra commencer une fois la grande écurie terminée.');
define('GREATSTABLE_DESC', 'La grande écurie vous permet de construire une deuxième écurie dans le même village, mais les troupes coûtent 3 fois le montant initial.<br>Combinée avec l\'écurie normale, vous pouvez entraîner vos troupes deux fois plus vite dans un village.');

define('CITYWALL', 'Muraille');
define('DEFENCE_NOW', 'Bonus de défense actuel :');
define('DEFENCE_LEVEL', 'Bonus de défense au niveau');
define('CITYWALL_DESC', 'Fournit un bonus de défense pour vos troupes (((1,03 ^ niveau) * 100) % + 10) points défensifs par niveau à la valeur défensive de base d\'un village. Plus le niveau de la muraille est élevé, plus le bonus de défense de vos troupes est élevé.<br>Spécifique à la tribu : Romains uniquement.');

define('EARTHWALL', 'Talus de terre');
define('EARTHWALL_DESC', 'Fournit un bonus de défense pour vos troupes (((1,02 ^ niveau) * 100) % + 6) points défensifs par niveau à la valeur défensive de base d\'un village. Plus le niveau du talus est élevé, plus le bonus de défense de vos troupes est élevé.<br>Spécifique à la tribu : Teutons uniquement.');

define('PALISADE', 'Palissade');
define('PALISADE_DESC', 'Fournit un bonus de défense pour vos troupes (((1,025 ^ niveau) * 100) % + 8) points défensifs par niveau à la valeur défensive de base d\'un village. Plus le niveau de la palissade est élevé, plus le bonus de défense de vos troupes est élevé.<br>Spécifique à la tribu : Gaulois uniquement.');

define('STONEMASON', 'Loge du tailleur de pierre');
define('CURRENT_STABILITY', 'Bonus de stabilité actuel :');
define('STABILITY_LEVEL', 'Bonus de stabilité au niveau');
define('STONEMASON_DESC', 'Le tailleur de pierre est un expert en taille de pierre. Plus le niveau de la loge est élevé, plus la stabilité des bâtiments de votre village est grande. À chaque niveau, ce bâtiment augmente la durabilité de 10 % jusqu\'à un maximum de 200 % de durabilité pour vos bâtiments.<br>Ce bâtiment ne peut être construit que dans la capitale d\'un compte.');

define('BREWERY', 'Brasserie');
define('CURRENT_BONUS', 'Bonus actuel :');
define('BONUS_LEVEL', 'Bonus au niveau');
define('BREWERY_DESC', 'Un savoureux hydromel est brassé ici. Les boissons rendent vos soldats plus braves et plus forts lors d\'attaques (1 % par niveau de brasserie). Malheureusement, le pouvoir de persuasion des chefs est réduit de 50 % et les catapultes ne peuvent faire que des tirs aléatoires. Ne peut être construite que dans la capitale, mais affecte tous vos villages. Les festivals d\'hydromel durent toujours 72 heures.<br>Spécifique à la tribu : Teutons uniquement.');

define('TRAPPER', 'Trappeur');
define('CURRENT_TRAPS', 'Pièges maximum à entraîner actuellement :');
define('TRAPS_LEVEL', 'Pièges maximum à entraîner au niveau');
define('TRAPS', 'Pièges');
define('TRAP', 'Piège');
define('CURRENT_HAVE', 'Vous avez actuellement');
define('WHICH_OCCUPIED', 'dont sont occupés.');
define('TRAINING_COMMENCE_TRAPPER', 'L\'entraînement pourra commencer une fois le trappeur terminé.');
define('TRAPPER_DESC', 'Le trappeur protège votre village avec des pièges bien dissimulés. Cela signifie que les ennemis imprudents peuvent être emprisonnés et ne pourront plus nuire à votre village.<br>Les troupes ne peuvent pas être libérées par un pillage. Si le propriétaire des pièges libère les captifs, tous les pièges seront réparés automatiquement.<br>Spécifique à la tribu : Gaulois uniquement.');

define("HEROSMANSION", "Palais du héros");
define('HERO_READY', 'Le héros sera prêt dans ');
define('NAME_CHANGED', 'Le nom du héros a été modifié');
define('NOT_UNITS', 'Aucune unité disponible');
define('NOT', 'Non ');
define('TRAIN_HERO', 'Entraîner un nouveau héros');
define('REVIVE', 'Ranimer');
define('OASES', 'Oasis');
define('DELETE', 'Supprimer');
define('RESOURCES', 'Ressources');
define('OFFENCE', 'Attaque');
define('DEFENCE', 'Défense');
define('OFF_BONUS', 'Bonus Off');
define('DEF_BONUS', 'Bonus Déf');
define('REGENERATION', 'Régénération');
define('DAY', 'Jour');
define('EXPERIENCE', 'Expérience');
define('YOU_CAN', 'Vous pouvez ');
define('RESET', 'réinitialiser');
define('YOUR_POINT_UNTIL', ' vos points jusqu\'à atteindre le niveau ');
define('OR_LOWER', ' ou inférieur !');
define('YOUR_HERO_HAS', 'Votre héros a ');
define('OF_HIT_POINTS', 'de ses points de vie');
define('ERROR_NAME_SHORT', 'Erreur : nom trop court');
define('HEROSMANSION_DESC', 'Le palais du héros est la demeure de votre glorieux héros.<br>Aux niveaux 10, 15 et 20 du bâtiment, vous pouvez utiliser votre héros pour annexer une oasis inoccupée à votre village, une par niveau respectivement. Selon l\'oasis, vous obtiendrez une augmentation de production d\'un certain type de ressource (voire deux ressources pour certaines oasis).');

define('GREATWAREHOUSE', 'Grand entrepôt');
define('GREATWAREHOUSE_DESC', 'Le grand entrepôt a 3 fois la capacité d\'un entrepôt normal.<br>Ce bâtiment ne peut être construit que dans les villages de Merveille du monde ou avec un artefact natarian spécial.');

define('GREATGRANARY', 'Grand grenier');
define('GREATGRANARY_DESC', 'Le grand grenier a 3 fois la capacité d\'un grenier normal.<br>Ce bâtiment ne peut être construit que dans les villages de Merveille du monde ou avec un artefact natarian spécial.');

define('WONDER', 'Merveille du monde');
define('WORLD_WONDER', 'Merveille du monde');
define('WONDER_DESC', 'Une Merveille du monde (aussi appelée WW) est aussi impressionnante qu\'elle en a l\'air. Chaque niveau coûte beaucoup de ressources. Il est presque impossible pour un seul joueur de construire une WW seul. La raison est que vous n\'avez pas seulement besoin de beaucoup de ressources, mais aussi de troupes pour protéger votre précieux bâtiment.<br>Pour construire une WW, vous avez besoin d\'un plan de construction antique. Vous pouvez l\'obtenir en attaquant un village Natar avec votre héros. Vous devez avoir une trésorerie vide de niveau 10 et votre héros doit survivre. Avec ces plans et un très haut niveau de ressources, vous pouvez démarrer la merveille.<br>Une fois au niveau 50, vous aurez besoin que quelqu\'un d\'autre dans votre alliance possède un deuxième plan actif. Vous ne pouvez pas tout faire vous-même.<br>Terminer une WW niveau 100, vous gagnerez le serveur Travian et c\'est la fin d\'un monde de jeu.<br>Une fois terminé, un message s\'affichera disant qui a gagné et les statistiques. Vous ne pouvez plus construire, mais vous pouvez envoyer des messages aux gens jusqu\'au redémarrage du serveur.');
define('WORLD_WONDER_CHANGE_NAME', 'Vous devez avoir une Merveille du monde de niveau 1 pour pouvoir changer son nom.');
define('WORLD_WONDER_NAME', 'Nom de la Merveille du monde');
define('WORLD_WONDER_NOTCHANGE_NAME', 'Vous ne pouvez pas changer le nom de la Merveille du monde après le niveau 10.');
define('WORLD_WONDER_NAME_CHANGED', 'Nom modifié');

define('HORSEDRINKING', 'Abreuvoir');
define('HORSEDRINKING_DESC', 'Diminue le temps d\'entraînement et l\'entretien de la cavalerie. Peut aussi être construit dans les villages de Merveille du monde des Romains.<br>Accélère le temps d\'entraînement des unités de cavalerie de 1 % par niveau et réduit la consommation de céréales de certaines unités selon son niveau.<br>Spécifique à la tribu : Romains uniquement.');

define('GREATWORKSHOP', 'Grand atelier');
define('TRAINING_COMMENCE_GREATWORKSHOP', 'L\'entraînement pourra commencer une fois le grand atelier terminé.');
define('GREATWORKSHOP_DESC', 'Le grand atelier vous permet de construire un deuxième atelier dans le même village, mais les catapultes et béliers coûtent 3 fois le montant initial.<br>Combiné avec l\'atelier normal, vous pouvez entraîner vos troupes deux fois plus vite dans un village.');

define('BUILDING_MAX_LEVEL_UNDER', 'Bâtiment au niveau maximum en construction');
define('BUILDING_BEING_DEMOLISHED', 'Bâtiment en cours de démolition');
define('COSTS_UPGRADING_LEVEL', 'Coûts</b> pour l\'amélioration au niveau');
define('WORKERS_ALREADY_WORK', 'Les ouvriers sont déjà au travail.');
define('CONSTRUCTING_MASTER_BUILDER', 'Construction avec le maître d\'œuvre ');
define('COSTS', 'Coûts');
define('WORKERS_ALREADY_WORK_WAITING', 'Les ouvriers sont déjà au travail. (en attente)');
define('ENOUGH_FOOD_EXPAND_CROPLAND', 'Nourriture insuffisante. Étendez les champs de céréales.');
define('UPGRADE_WAREHOUSE', 'Améliorer l\'entrepôt');
define('UPGRADE_GRANARY', 'Améliorer le grenier');
define('YOUR_CROP_NEGATIVE', 'Votre production de céréales est négative, vous n\'obtiendrez jamais les ressources requises.');
define('UPGRADE_LEVEL', 'Améliorer au niveau ');
define('WAITING', '(en attente)');
define('NEED_WWCONSTRUCTION_PLAN', 'Plan de construction de la Merveille nécessaire');
define('NEED_MORE_WWCONSTRUCTION_PLAN', 'Plus de plans de construction de la Merveille nécessaires');
define('CONSTRUCT_NEW_BUILDING', 'Construire un nouveau bâtiment');
define('SHOWSOON_AVAILABLE_BUILDINGS', 'Afficher les bâtiments bientôt disponibles');
define('HIDESOON_AVAILABLE_BUILDINGS', 'Masquer les bâtiments bientôt disponibles');

//artefact
define('ARCHITECTS_DESC', 'Tous les bâtiments dans la zone d\'effet sont plus solides. Cela signifie que vous aurez besoin de plus de catapultes pour endommager les bâtiments protégés par les pouvoirs de cet artefact.');
define('ARCHITECTS_SMALL', 'Le petit secret des architectes');
define('ARCHITECTS_SMALLVILLAGE', 'Ciseau de diamant');
define('ARCHITECTS_LARGE', 'Le grand secret des architectes');
define('ARCHITECTS_LARGEVILLAGE', 'Marteau de marbre géant');
define('ARCHITECTS_UNIQUE', 'Le secret unique des architectes');
define('ARCHITECTS_UNIQUEVILLAGE', 'Parchemins d\'Hémon');
define('HASTE_DESC', 'Toutes les troupes dans la zone d\'effet se déplacent plus rapidement.');
define('HASTE_SMALL', 'Les petites bottes de titan');
define('HASTE_SMALLVILLAGE', 'Fer à cheval d\'opale');
define('HASTE_LARGE', 'Les grandes bottes de titan');
define('HASTE_LARGEVILLAGE', 'Char d\'or');
define('HASTE_UNIQUE', 'Les bottes uniques de titan');
define('HASTE_UNIQUEVILLAGE', 'Sandales de Phidippide');
define('EYESIGHT_DESC', 'Tous les espions (éclaireurs, pisteurs et Equites Legati) augmentent leur capacité d\'espionnage. De plus, avec toutes les versions de cet artefact, vous pouvez voir le TYPE de troupes entrantes mais pas leur nombre.');
define('EYESIGHT_SMALL', 'Les petits yeux d\'aigle');
define('EYESIGHT_SMALLVILLAGE', 'Conte d\'un rat');
define('EYESIGHT_LARGE', 'Les grands yeux d\'aigle');
define('EYESIGHT_LARGEVILLAGE', 'Lettre des généraux');
define('EYESIGHT_UNIQUE', 'Les yeux uniques d\'aigle');
define('EYESIGHT_UNIQUEVILLAGE', 'Journal de Sun Tzu');
define('DIET_DESC', 'Toutes les troupes dans la portée de l\'artefact consomment moins de blé, ce qui permet d\'entretenir une armée plus importante.');
define('DIET_SMALL', 'Petit contrôle alimentaire');
define('DIET_SMALLVILLAGE', 'Plateau d\'argent');
define('DIET_LARGE', 'Grand contrôle alimentaire');
define('DIET_LARGEVILLAGE', 'Arc de chasse sacré');
define('DIET_UNIQUE', 'Contrôle alimentaire unique');
define('DIET_UNIQUEVILLAGE', 'Calice du Roi Arthur');
define('ACADEMIC_DESC', 'Les troupes sont produites un certain pourcentage plus rapidement dans le champ d\'action de l\'artefact.');
define('ACADEMIC_SMALL', 'Le petit talent des entraîneurs');
define('ACADEMIC_SMALLVILLAGE', 'Serment du soldat inscrit');
define('ACADEMIC_LARGE', 'Le grand talent des entraîneurs');
define('ACADEMIC_LARGEVILLAGE', 'Déclaration de guerre');
define('ACADEMIC_UNIQUE', 'Le talent unique des entraîneurs');
define('ACADEMIC_UNIQUEVILLAGE', 'Mémoires d\'Alexandre le Grand');
define('STORAGE_DESC', 'Avec ce plan de construction, vous pouvez construire le grand grenier ou le grand entrepôt dans le village contenant l\'artefact, ou pour tout le compte selon l\'artefact. Tant que vous possédez cet artefact, vous pouvez construire et agrandir ces bâtiments.');
define('STORAGE_SMALL', 'Petit plan de stockage');
define('STORAGE_SMALLVILLAGE', 'Esquisse du bâtisseur');
define('STORAGE_LARGE', 'Grand plan de stockage');
define('STORAGE_LARGEVILLAGE', 'Tablette babylonienne');
define('CONFUSION_DESC', 'La capacité de la cachette est augmentée d\'une certaine quantité par type d\'artefact. Les catapultes ne peuvent tirer qu\'aléatoirement sur les villages dans le champ de ces artefacts. Les exceptions sont la Merveille qui peut toujours être ciblée et la trésorerie qui peut toujours être ciblée, sauf avec l\'artefact unique. Quand on vise un champ de ressources, seuls des champs aléatoires peuvent être touchés ; quand on vise un bâtiment, seuls des bâtiments aléatoires peuvent l\'être.');
define('CONFUSION_SMALL', 'Petite confusion des rivaux');
define('CONFUSION_SMALLVILLAGE', 'Carte des cavernes cachées');
define('CONFUSION_LARGE', 'Grande confusion des rivaux');
define('CONFUSION_LARGEVILLAGE', 'Sacoche sans fond');
define('CONFUSION_UNIQUE', 'Confusion unique des rivaux');
define('CONFUSION_UNIQUEVILLAGE', 'Cheval de Troie');
define('FOOL_DESC', 'Toutes les 24 heures, il obtient un effet aléatoire, bonus ou pénalité (tout est possible sauf le grand entrepôt, le grand grenier et les plans de la Merveille). L\'effet ET la portée changent toutes les 24 heures. L\'artefact unique prendra toujours des bonus positifs.');
define('FOOL_SMALL', 'Artefact du petit fou');
define('FOOL_SMALLVILLAGE', 'Pendentif de malice');
define('FOOL_UNIQUE', 'Artefact du fou unique');
define('FOOL_UNIQUEVILLAGE', 'Manuscrit interdit');
define('WWVILLAGE', 'Village Merveille');
define('ARTEFACT', '<h1><b>Artefacts des Natars</b></h1>

Des rumeurs murmurent à travers les villages, partageant des légendes racontées uniquement par les meilleurs conteurs. Elles parlent des NATARS, les guerriers les plus redoutés du monde de TRAVIAN. Les tuer est le rêve de tout héros, le but de tout combattant. Personne ne sait comment les NATARS ont obtenu un tel pouvoir, ni d\'où vient la cruauté de leurs guerriers. Déterminés à découvrir la source du pouvoir des NATARS, les combattants envoient un groupe d\'élite d\'espions les espionner. Peu d\'heures s\'écoulent avant qu\'ils reviennent, la peur dans les yeux, avançant des théories fantastiques : il semble que le pouvoir vienne d\'objets mystérieux appelés artefacts, dérobés à nos ancêtres. Essayez de voler ces artefacts et vous pourrez contrôler leur pouvoir.

<img src="/img/x.gif" class="ArtefactsAnnouncement">

Le temps est venu de revendiquer les artefacts. Collaborez avec votre alliance et envoyez vos guerriers chercher ces objets convoités. Cependant, les NATARS ne se rendront pas sans guerre... vos ennemis non plus. Si vous parvenez à récupérer les artefacts et à repousser vos ennemis, vous pourrez collecter les récompenses. Vos bâtiments deviendront incroyablement puissants, et les troupes seront bien plus rapides et consommeront moins de nourriture. Capturez les artefacts, apportez la gloire à votre empire et devenez une nouvelle légende pour vos partisans.

Pour en voler un, les conditions suivantes doivent être réunies :

1. Vous devez attaquer le village (PAS un pillage !)
2. GAGNEZ l\'attaque
3. Détruisez la trésorerie
4. Une trésorerie vide de niveau 10 pour les PETITS ARTEFACTS et de niveau 20 pour les GRANDS ARTEFACTS doit se trouver dans le village d\'origine de l\'attaque
5. Avoir un héros dans l\'attaque

Sinon, la prochaine attaque sur ce village, gagnée avec un héros et une trésorerie vide, prendra l\'artefact.

Pour construire une Merveille du monde, vous devez posséder vous-même un plan (vous = le propriétaire du village Merveille) du niveau 0 au 50, du niveau 51 au 100 vous avez besoin d\'un plan supplémentaire dans votre alliance ! Deux plans dans le compte du village Merveille ne fonctionneraient pas !

Les plans de construction sont conquérables immédiatement dès qu\'ils apparaissent sur le serveur.

Un compte à rebours sera affiché dans le jeu, indiquant l\'heure exacte de la sortie, 5 jours avant le lancement.');

//WW Village Release Message
define('WWVILLAGEMSG', '<h1><b>Villages Merveille du monde</b></h1>

D\'innombrables jours se sont écoulés depuis les premières batailles aux murailles des villages maudits des terribles Natars. De nombreuses armées, tant des hommes libres que de l\'empire Natarian, ont lutté et péri devant les murs des nombreuses forteresses d\'où les Natars régnaient autrefois sur toute la création. Maintenant que la poussière retombe et qu\'un calme relatif s\'est installé, les armées commencent à compter leurs pertes et à rassembler leurs morts, l\'odeur du combat flottant encore dans l\'air nocturne, une odeur de massacre inoubliable par son ampleur et sa brutalité, qui sera bientôt éclipsée par d\'autres encore. Les plus grandes armées des hommes libres et des terribles Natars se rassemblaient pour un énième assaut renouvelé contre les ex-forteresses convoitées de l\'empire Natarian.
Bientôt les éclaireurs arrivent annonçant une vision incroyable et un rappel glaçant : une armée terrifiante d\'une taille insondable a été repérée se rassemblant à la fin du monde, la capitale Natarian, une force si grande et inarrêtable que la poussière de leur marche étoufferait toute lumière, une force si brutale et impitoyable qu\'elle écraserait tout espoir. Les hommes libres savaient qu\'ils devaient maintenant courir, courir contre le temps et les hordes infinies de l\'empire Natarian pour ériger une Merveille du monde, ramener la paix dans le monde et vaincre la menace Natarian.
Mais ériger une si grande Merveille ne serait pas une tâche aisée — il faudrait des plans de construction créés dans un passé lointain, des plans d\'une nature si arcane que même les plus sages des sages n\'en connaissaient ni le contenu ni l\'emplacement.
Des dizaines de milliers d\'éclaireurs ont arpenté toute l\'existence à la recherche en vain de ces plans mystiques, cherchant partout sauf dans la redoutable capitale Natarian, sans pouvoir les trouver. Aujourd\'hui cependant, ils reviennent porteurs de bonnes nouvelles, ils reviennent avec les emplacements des plans, dissimulés par les armées des Natars dans des forteresses secrètes construites pour être cachées aux yeux des hommes.
Maintenant commence la dernière ligne droite, où les plus grandes armées des hommes libres et des Natars s\'affronteront à travers le monde pour le destin de tout ce qui repose sous le ciel. C\'est la guerre qui résonnera à travers les âges, c\'est votre guerre, et c\'est ici que vous graverez votre nom dans l\'histoire, ici que vous deviendrez légende.

<img src="/img/x.gif" class="WWVillagesAnnouncement" title="'.WWVILLAGE.'" alt="'.WWVILLAGE.'">

Pour en conquérir un, les conditions suivantes doivent être réunies :

1. Vous devez attaquer le village (PAS un pillage !)
2. GAGNEZ l\'attaque
3. Détruisez la RÉSIDENCE
4. Vous devez réduire la loyauté à 0 avec : SÉNATEURS, COMMANDANTS, CHEFS
5. Vous devez avoir assez de points de culture pour conquérir le village

Sinon, la prochaine attaque sur ce village, gagnée avec un SÉNATEUR, COMMANDANT ou CHEF et des emplacements vides dans la RÉSIDENCE/PALAIS, prendra le village.

Pour construire une Merveille, vous devez posséder vous-même un plan (vous = le propriétaire du village Merveille) du niveau 0 au 50, du niveau 51 au 100 vous avez besoin d\'un plan supplémentaire dans votre alliance ! Deux plans dans le compte du village Merveille ne fonctionneraient pas !

Les plans de construction sont conquérables immédiatement dès qu\'ils apparaissent sur le serveur.

Un compte à rebours sera affiché dans le jeu, indiquant l\'heure exacte de la sortie, '.(5 / SPEED).' jours avant le lancement.');

//Building Plans
define('WILL_SPAWN_IN', 'apparaîtra dans');
define('PLAN', 'Plan de construction antique');
define('PLANVILLAGE', 'Plan de la Merveille');
define('PLAN_DESC', 'Avec ce plan de construction antique, vous pourrez construire une Merveille du monde jusqu\'au niveau 50. Pour aller plus loin, votre alliance doit détenir au moins deux plans.');
define('PLAN_INFO', '<h1><b>Plans de construction des Merveilles du monde</b></h1>


Il y a de nombreuses lunes, les tribus de Travian furent surprises par le retour imprévu des Natars. Cette tribu qui depuis des temps immémoriaux surpassait tous en sagesse, puissance et gloire, était sur le point de troubler à nouveau les hommes libres. Ils mirent donc toutes leurs forces dans la préparation d\'une ultime guerre contre les Natars pour les vaincre à jamais. Beaucoup pensèrent aux fameuses « Merveilles du monde », bâtiments de nombreuses légendes, comme seule solution. On disait qu\'elles rendraient quiconque invincible une fois terminées, faisant finalement de leurs constructeurs les maîtres et conquérants de tout Travian.

Cependant, on disait aussi qu\'il fallait des plans de construction pour ériger un tel bâtiment. À cause de ce fait, les architectes conçurent des plans rusés sur la façon de les conserver en sûreté. Après un certain temps, on pouvait voir des bâtiments en forme de temples dans de nombreuses villes et métropoles — les chambres du trésor (trésoreries).

Hélas, personne — pas même les sages et les érudits — ne savait où trouver ces plans de construction. Plus les gens essayaient de les localiser, plus ils semblaient n\'être que légendes.

Aujourd\'hui cependant, ce dernier secret va être révélé. Les privations et les efforts du passé n\'auront pas été vains, car aujourd\'hui les éclaireurs de plusieurs tribus ont obtenu avec succès l\'emplacement des plans de construction. Bien gardés par les Natars, ils gisent cachés dans plusieurs oasis disséminées à travers tout Travian. Seuls les héros les plus vaillants pourront sécuriser un tel plan et le ramener à la maison sain et sauf afin que la construction puisse commencer.

Au final, nous verrons si les tribus libres de Travian pourront une fois de plus déjouer les Natars et les vaincre une fois pour toutes. Ne soyez pas assez fou pour croire que les Natars partiront sans combattre !

<img src="/img/x.gif" class="WWBuildingPlansAnnouncement" title="'.PLAN.'" alt="'.PLAN.'">

Pour voler un jeu de plans de construction aux Natars, les conditions suivantes doivent être réunies :
- Vous devez ATTAQUER le village (PAS un pillage !)
- Vous devez GAGNER l\'attaque
- Vous devez DÉTRUIRE la chambre du trésor (trésorerie)
- Votre HÉROS DOIT être dans cette attaque, car il est le seul à pouvoir transporter les plans
- Une chambre du trésor (trésorerie) vide de niveau 10 DOIT être dans le village d\'origine de l\'attaque
NOTE : Si les critères ci-dessus ne sont pas remplis pendant l\'attaque, la prochaine attaque sur ce village qui remplit les critères prendra les plans de construction.



Pour construire une chambre du trésor (trésorerie), vous aurez besoin d\'un bâtiment principal de niveau 10 et le village NE DOIT PAS contenir de Merveille du monde.

Pour construire une Merveille du monde, vous devez posséder vous-même les plans de construction (vous = le propriétaire du village Merveille) du niveau 0 au 50, puis du niveau 51 au 100 vous aurez besoin d\'un jeu supplémentaire de plans dans votre alliance ! Deux jeux de plans dans le compte du village Merveille ne fonctionneront pas !');

//Admin setting - Admin/Templates/config.tpl & editServerSet.tpl
define('EDIT_BACK', 'Retour');
define('SERV_CONFIG', 'Configuration du serveur');
define('SERV_SETT', 'Paramètres du serveur');
define('EDIT_SERV_SETT', 'Modifier les paramètres du serveur');
define('SERV_VARIABLE', 'Variable');
define('SERV_VALUE', 'Valeur');
define('CONF_SERV_NAME', 'Nom du serveur');
define('CONF_SERV_NAME_TOOLTIP', 'Nom du serveur de jeu.');
define('CONF_SERV_STARTED', 'Serveur démarré');
define('CONF_SERV_STARTED_TOOLTIP', 'Date à laquelle le serveur de jeu a été démarré. Ce paramètre ne peut pas être modifié sur un serveur de jeu installé.');
define('CONF_SERV_TIMEZONE', 'Fuseau horaire du serveur');
define('CONF_SERV_TIMEZONE_TOOLTIP', 'Fuseau horaire du serveur de jeu.');
define('CONF_SERV_LANG', 'Langue');
define('CONF_SERV_LANG_TOOLTIP', 'La langue utilisée par défaut dans le panneau d\'administration et pour tous sur le serveur de jeu.');
define('CONF_SERV_SERVSPEED', 'Vitesse du serveur');
define('CONF_SERV_SERVSPEED_TOOLTIP', 'La vitesse du serveur de jeu. Plus elle est élevée, plus rapidement tous les bâtiments sont construits, les études et améliorations dans les forges sont effectuées, les troupes sont entraînées et la productivité de toutes les ressources augmente.');
define('CONF_SERV_TROOPSPEED', 'Vitesse des troupes');
define('CONF_SERV_TROOPSPEED_TOOLTIP', 'Vitesse de déplacement des troupes sur le serveur de jeu. Plus cet indicateur est élevé, plus les troupes se déplacent rapidement sur la carte.');
define('CONF_SERV_EVASIONSPEED', 'Vitesse de retour');
define('CONF_SERV_EVASIONSPEED_TOOLTIP', 'La vitesse de retour est le temps que les troupes passent sur la route pour rentrer après une attaque évitée.');
define('CONF_SERV_STORMULTIPLER', 'Multiplicateur de stockage');
define('CONF_SERV_STORMULTIPLER_TOOLTIP', 'Un multiplicateur pour la capacité de stockage de l\'entrepôt et du grenier. La valeur 1 équivaut à 80 000 de chaque ressource au niveau maximum. Si vous mettez 2, la capacité au niveau maximum sera de 160 000 par ressource.<br><b>Note :</b> la quantité de ressources générée par les oasis non occupées pour le pillage dépend de cette valeur. Par défaut 800. Si vous mettez 2, le maximum par ressource générée est 1600.');
define('CONF_SERV_TRADCAPACITY', 'Capacité du marchand');
define('CONF_SERV_TRADCAPACITY_TOOLTIP', 'Un multiplicateur pour la capacité de ressources qu\'un marchand peut transporter. La valeur 1 équivaut à 500 pour les Romains, 750 pour les Gaulois, 1000 pour les Teutons. Si vous mettez 2, la capacité transférée double : 1000, 1500, 2000.');
define('CONF_SERV_CRANCAPACITY', 'Capacité de la cachette');
define('CONF_SERV_CRANCAPACITY_TOOLTIP', 'Un multiplicateur pour la capacité de la cachette qui protège du pillage. La valeur 1 équivaut à 1000 pour Romains et Teutons, 2000 pour Gaulois. Si vous mettez 2, la capacité double : 2000 et 4000.');
define('CONF_SERV_TRAPCAPACITY', 'Capacité du trappeur');
define('CONF_SERV_TRAPCAPACITY_TOOLTIP', 'Un multiplicateur pour la capacité du piège gaulois, capable de capturer des soldats ennemis avant qu\'ils n\'attaquent. La valeur 1 équivaut à 400 au niveau 20 de construction. Si vous mettez 2, la capacité sera de 800.');
define('CONF_SERV_NATUNITSMULTIPLIER', 'Multiplicateur d\'unités Natars');
define('CONF_SERV_NATUNITSMULTIPLIER_TOOLTIP', 'Ce paramètre détermine le nombre de troupes Natars sur les artefacts et les villages WW.');
define('CONF_SERV_NATARS_SPAWN_TIME', 'Apparition des Natars');
define('CONF_SERV_NATARS_SPAWN_TIME_TOOLTIP', 'Combien de jours après le démarrage du serveur les Natars et artefacts apparaîtront.');
define('CONF_SERV_NATARS_WW_SPAWN_TIME', 'Apparition des Merveilles');
define('CONF_SERV_NATARS_WW_SPAWN_TIME_TOOLTIP', 'Combien de jours après le démarrage du serveur les villages WW apparaîtront.');
define('CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME', 'Apparition des plans WW');
define('CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME_TOOLTIP', 'Combien de jours après le démarrage du serveur les plans WW apparaîtront.');
define('CONF_SERV_MAPSIZE', 'Taille de la carte');
define('CONF_SERV_MAPSIZE_TOOLTIP', 'Taille de la carte du monde de jeu. Non modifiable sur un serveur déjà installé.');
define('CONF_SERV_VILLEXPSPEED', 'Vitesse d\'expansion des villages');
define('CONF_SERV_VILLEXPSPEED_TOOLTIP', 'Vitesse affectant l\'expansion de l\'empire. Avec une vitesse lente, plus de points de culture sont nécessaires pour fonder un village ; avec une vitesse rapide, moins.');
define('CONF_SERV_BEGINPROTECT', 'Protection des débutants');
define('CONF_SERV_BEGINPROTECT_TOOLTIP', 'Protection interdisant d\'attaquer les villages des nouveaux joueurs pendant un certain temps.');
define('CONF_SERV_REGOPEN', 'Inscriptions ouvertes');
define('CONF_SERV_REGOPEN_TOOLTIP', 'Permet d\'activer (Vrai) ou de désactiver (Faux) l\'inscription des joueurs sur le serveur de jeu.');
define('CONF_SERV_ACTIVMAIL', 'Activation par e-mail');
define('CONF_SERV_ACTIVMAIL_TOOLTIP', 'Si activé (Oui), confirmation par e-mail requise à l\'inscription. Si désactivé (Non), pas de confirmation requise.');
define('CONF_SERV_QUEST', 'Quête');
define('CONF_SERV_QUEST_TOOLTIP', 'Activer (Oui) ou désactiver (Non) les quêtes sur le serveur.');
define('CONF_SERV_QTYPE', 'Type de quête');
define('CONF_SERV_QTYPE_TOOLTIP', 'Le type de quête peut être « officiel » (un peu plus court) ou « étendu » (plus long).');
define('CONF_SERV_DLR', 'Démolition — niveau requis');
define('CONF_SERV_DLR_TOOLTIP', 'Niveau requis du bâtiment principal pour pouvoir démolir des bâtiments dans le village.');
define('CONF_SERV_WWSTATS', 'Merveille du monde — statistiques');
define('CONF_SERV_WWSTATS_TOOLTIP', 'Activer (Vrai) ou désactiver (Faux) l\'affichage dans les statistiques des villages avec une Merveille du monde.');
define('CONF_SERV_NTRTIME', 'Temps de régénération des troupes nature');
define('CONF_SERV_NTRTIME_TOOLTIP', 'Temps après lequel les troupes nature seront restaurées dans les oasis.');
define('CONF_SERV_OASIS_WOOD_PROD_MULT', 'Multiplicateur production bois oasis');
define('CONF_SERV_OASIS_WOOD_PROD_MULT_TOOLTIP', 'La production de bois de base des oasis.');
define('CONF_SERV_OASIS_CLAY_PROD_MULT', 'Multiplicateur production argile oasis');
define('CONF_SERV_OASIS_CLAY_PROD_MULT_TOOLTIP', 'La production d\'argile de base des oasis.');
define('CONF_SERV_OASIS_IRON_PROD_MULT', 'Multiplicateur production fer oasis');
define('CONF_SERV_OASIS_IRON_PROD_MULT_TOOLTIP', 'La production de fer de base des oasis.');
define('CONF_SERV_OASIS_CROP_PROD_MULT', 'Multiplicateur production céréales oasis');
define('CONF_SERV_OASIS_CROP_PROD_MULT_TOOLTIP', 'La production de céréales de base des oasis.');
define('CONF_SERV_MEDALINTERVAL', 'Intervalle des médailles');
define('CONF_SERV_MEDALINTERVAL_TOOLTIP', 'Intervalle d\'attribution des médailles pour les meilleurs joueurs et alliances. Si modifié sur un serveur installé, l\'intervalle change après l\'émission suivante.');
define('CONF_SERV_TOURNTHRES', 'Seuil du tournoi');
define('CONF_SERV_TOURNTHRES_TOOLTIP', 'Nombre de cases sur la carte au-delà duquel la place du tournoi commence à fonctionner.');
define('CONF_SERV_GWORKSHOP', 'Grand atelier');
define('CONF_SERV_GWORKSHOP_TOOLTIP', 'Activer (Vrai) ou désactiver (Faux) l\'utilisation du grand atelier dans le jeu.');
define('CONF_SERV_NATARSTAT', 'Afficher les Natars dans les statistiques');
define('CONF_SERV_NATARSTAT_TOOLTIP', 'Activer (Vrai) ou désactiver (Faux) l\'affichage du compte Natars dans les statistiques.');
define('CONF_SERV_PEACESYST', 'Système de paix');
define('CONF_SERV_PEACESYST_TOOLTIP', 'Activer ou désactiver le système de paix. Quand actif, les joueurs peuvent s\'attaquer mais à la place des actions habituelles dans les rapports, une inscription de félicitations apparaît. Les troupes ne mourront pas de faim.');
define('CONF_SERV_GRAPHICPACK', 'Pack graphique');
define('CONF_SERV_GRAPHICPACK_TOOLTIP', 'Activer (Oui) ou désactiver (Non) la possibilité d\'utiliser le pack graphique.');
define('CONF_SERV_ERRORREPORT', 'Rapport d\'erreurs');
define('CONF_SERV_ERRORREPORT_TOOLTIP', 'Activer (Oui) ou désactiver (Non) l\'affichage des rapports d\'erreurs sur le serveur de jeu.');

//Admin setting - Admin/Templates/config.tpl & editPlusSet.tpl
define('PLUS_LOGO', '<b><font color="#71D000">P</font><font color="#FF6F0F">l</font><font color="#71D000">u</font><font color="#FF6F0F">s</font></b>');
define('PLUS_CONFIGURATION', PLUS_LOGO.' Configuration');
define('PLUS_SETT', PLUS_LOGO.' Paramètres');
define('EDIT_PLUS_SETT', 'Modifier les paramètres '.PLUS_LOGO);
define('EDIT_PLUS_SETT1', 'Modifier les paramètres PLUS');
define('CONF_PLUS_PAYPALEMAIL', 'Adresse e-mail <a href="https://www.paypal.com" target="_blank">PayPal</a>');
define('CONF_PLUS_PAYPALEMAIL_TOOLTIP', 'L\'adresse e-mail spécifiée à l\'inscription sur PayPal.<br><font color="red"><b>Doit être un compte Business ou Premier !</b></font>');
define('CONF_PLUS_CURRENCY', 'Devise de paiement');
define('CONF_PLUS_CURRENCY_TOOLTIP', 'La devise à utiliser pour les paiements.');
define('CONF_PLUS_PACKAGEGOLDA', 'Pack « A » — Quantité d\'or');
define('CONF_PLUS_PACKAGEGOLDA_TOOLTIP', 'Quantité d\'or émise pour le paiement du pack « A ».');
define('CONF_PLUS_PACKAGEPRICEA', 'Pack « A » — Montant du prix');
define('CONF_PLUS_PACKAGEPRICEA_TOOLTIP', 'Montant nécessaire pour payer le pack « A ».');
define('CONF_PLUS_PACKAGEGOLDB', 'Pack « B » — Quantité d\'or');
define('CONF_PLUS_PACKAGEGOLDB_TOOLTIP', 'Quantité d\'or émise pour le paiement du pack « B ».');
define('CONF_PLUS_PACKAGEPRICEB', 'Pack « B » — Montant du prix');
define('CONF_PLUS_PACKAGEPRICEB_TOOLTIP', 'Montant nécessaire pour payer le pack « B ».');
define('CONF_PLUS_PACKAGEGOLDC', 'Pack « C » — Quantité d\'or');
define('CONF_PLUS_PACKAGEGOLDC_TOOLTIP', 'Quantité d\'or émise pour le paiement du pack « C ».');
define('CONF_PLUS_PACKAGEPRICEC', 'Pack « C » — Montant du prix');
define('CONF_PLUS_PACKAGEPRICEC_TOOLTIP', 'Montant nécessaire pour payer le pack « C ».');
define('CONF_PLUS_PACKAGEGOLDD', 'Pack « D » — Quantité d\'or');
define('CONF_PLUS_PACKAGEGOLDD_TOOLTIP', 'Quantité d\'or émise pour le paiement du pack « D ».');
define('CONF_PLUS_PACKAGEPRICED', 'Pack « D » — Montant du prix');
define('CONF_PLUS_PACKAGEPRICED_TOOLTIP', 'Montant nécessaire pour payer le pack « D ».');
define('CONF_PLUS_PACKAGEGOLDE', 'Pack « E » — Quantité d\'or');
define('CONF_PLUS_PACKAGEGOLDE_TOOLTIP', 'Quantité d\'or émise pour le paiement du pack « E ».');
define('CONF_PLUS_PACKAGEPRICEE', 'Pack « E » — Montant du prix');
define('CONF_PLUS_PACKAGEPRICEE_TOOLTIP', 'Montant nécessaire pour payer le pack « E ».');
define('CONF_PLUS_ACCDURATION', 'Durée du compte '.PLUS_LOGO);
define('CONF_PLUS_ACCDURATION_TOOLTIP', 'Durée de la fonction de jeu '.PLUS_LOGO.' pour le compte au moment de l\'activation par le joueur.');
define('CONF_PLUS_PRODUCTDURATION', '+25 % durée de production');
define('CONF_PLUS_PRODUCTDURATION_TOOLTIP', 'Durée de la fonction +25 % de production pour le compte au moment de l\'activation par le joueur.');

//Admin setting - Admin/Templates/config.tpl & editLogSet.tpl
define('LOG_SETT', 'Paramètres des journaux');
define('EDIT_LOG_SETT', 'Modifier les paramètres des journaux');
define('CONF_LOG_BUILD', 'Journal de construction');
define('CONF_LOG_BUILD_TOOLTIP', 'Activer (Oui) ou désactiver (Non) l\'affichage des journaux de construction des bâtiments dans le village.');
define('CONF_LOG_TECHNOLOGY', 'Journal de technologie');
define('CONF_LOG_TECHNOLOGY_TOOLTIP', 'Activer (Oui) ou désactiver (Non) l\'affichage des journaux d\'améliorations de troupes (forge et armurerie).');
define('CONF_LOG_LOGIN', 'Journal de connexion');
define('CONF_LOG_LOGIN_TOOLTIP', 'Activer (Oui) ou désactiver (Non) l\'affichage des journaux de connexions des joueurs.');
define('CONF_LOG_GOLD', 'Journal d\'or');
define('CONF_LOG_GOLD_TOOLTIP', 'Activer (Oui) ou désactiver (Non) l\'affichage des journaux d\'utilisation de l\'or par les joueurs.');
define('CONF_LOG_ADMIN', 'Journal admin');
define('CONF_LOG_ADMIN_TOOLTIP', 'Activer (Oui) ou désactiver (Non) l\'affichage des journaux des actions administrateur dans le panneau de contrôle.');
define('CONF_LOG_WAR', 'Journal de guerre');
define('CONF_LOG_WAR_TOOLTIP', 'Activer (Oui) ou désactiver (Non) l\'affichage des journaux d\'attaques entre joueurs.');
define('CONF_LOG_MARKET', 'Journal du marché');
define('CONF_LOG_MARKET_TOOLTIP', 'Activer (Oui) ou désactiver (Non) l\'affichage des journaux d\'utilisation du marché par les joueurs.');
define('CONF_LOG_ILLEGAL', 'Journal illégal');
define('CONF_LOG_ILLEGAL_TOOLTIP', 'Activer (Oui) ou désactiver (Non) l\'affichage des journaux illégaux.');

//Admin setting - Admin/Templates/config.tpl & editNewsboxSet.tpl
define('NEWSBOX_SETT', 'Paramètres des actualités');
define('EDIT_NEWSBOX_SETT', 'Modifier les paramètres des actualités');
define('EDIT_NEWSBOX1', 'Actualité 1');
define('EDIT_NEWSBOX1_TOOLTIP', 'Activer ou désactiver l\'affichage de l\'actualité 1. Affichée sur la page de connexion et les pages de jeu.');
define('EDIT_NEWSBOX2', 'Actualité 2');
define('EDIT_NEWSBOX2_TOOLTIP', 'Activer ou désactiver l\'affichage de l\'actualité 2.');
define('EDIT_NEWSBOX3', 'Actualité 3');
define('EDIT_NEWSBOX3_TOOLTIP', 'Activer ou désactiver l\'affichage de l\'actualité 3.');

//Admin setting - Admin/Templates/config.tpl SQL Settings
define('SQL_SETTINGS', 'Paramètres SQL');
define('CONF_SQL_HOSTNAME', 'Hôte');
define('CONF_SQL_HOSTNAME_TOOLTIP', 'Nom du serveur où MySQL est démarré (par défaut : localhost).');
define('CONF_SQL_PORT', 'Port');
define('CONF_SQL_PORT_TOOLTIP', 'Port MySQL pour la connexion distante. Port standard : 3306.');
define('CONF_SQL_DBUSER', 'Utilisateur BDD');
define('CONF_SQL_DBUSER_TOOLTIP', 'Nom d\'utilisateur pour se connecter à la base de données.');
define('CONF_SQL_DBPASS', 'Mot de passe BDD');
define('CONF_SQL_DBPASS_TOOLTIP', 'Mot de passe de l\'utilisateur pour se connecter à la base de données.');
define('CONF_SQL_DBNAME', 'Nom BDD');
define('CONF_SQL_DBNAME_TOOLTIP', 'Nom de la base de données à laquelle vous vous connectez.');
define('CONF_SQL_TBPREFIX', 'Préfixe des tables');
define('CONF_SQL_TBPREFIX_TOOLTIP', 'Préfixe utilisé pour les tables de la base de données.');
define('CONF_SQL_DBTYPE', 'Type de BDD');
define('CONF_SQL_DBTYPE_TOOLTIP', 'Type de base de données utilisée.');

//Admin setting - Admin/Templates/config.tpl & editExtraSet.tpl
define('EXTRA_SETT', 'Paramètres supplémentaires');
define('EDIT_EXTRA_SETT', 'Modifier les paramètres supplémentaires');
define('CONF_EXTRA_LIMITMAIL', 'Limite de la boîte mail');
define('CONF_EXTRA_LIMITMAIL_TOOLTIP', 'Activer (Oui) ou désactiver (Non) la limite de la boîte mail.');
define('CONF_EXTRA_MAXMAIL', 'Nombre max. de messages');
define('CONF_EXTRA_MAXMAIL_TOOLTIP', 'Nombre maximum de messages pouvant être contenus dans la boîte mail.');

//Admin setting - Admin/Templates/config.tpl & editAdminInfo.tpl
define('ADMIN_INFO', 'Informations administrateur');
define('EDIT_ADMIN_INFO', 'Modifier les informations administrateur');
define('CONF_ADMIN_NAME', 'Nom administrateur');
define('CONF_ADMIN_NAME_TOOLTIP', 'Nom pour le compte administrateur.');
define('CONF_ADMIN_EMAIL', 'E-mail administrateur');
define('CONF_ADMIN_EMAIL_TOOLTIP', 'Adresse e-mail du compte administrateur.');
define('CONF_ADMIN_SHOWSTATS', 'Inclure l\'administrateur dans les statistiques');
define('CONF_ADMIN_SHOWSTATS_TOOLTIP', 'Activer (Vrai) ou désactiver (Faux) l\'affichage du compte administrateur dans les statistiques générales.');
define('CONF_ADMIN_SUPPMESS', 'Inclure les messages de support');
define('CONF_ADMIN_SUPPMESS_TOOLTIP', 'Activer (Vrai) ou désactiver (Faux) l\'envoi de messages à la boîte de l\'administrateur adressée au Support.');
define('CONF_ADMIN_RAIDATT', 'Autoriser pillage et attaque');
define('CONF_ADMIN_RAIDATT_TOOLTIP', 'Activer (Vrai) ou désactiver (Faux) la possibilité d\'attaquer ou piller un administrateur.');

// gold plus
define('GOLD_SHOP', 'Boutique d\'or');
define('PACKAGE_A', 'Pack A');
define('PACKAGE_B', 'Pack B');
define('PACKAGE_C', 'Pack C');
define('PACKAGE_D', 'Pack D');
define('PACKAGE_E', 'Pack E');
define('PAYMENT_METHOD', 'Méthode de paiement');
define('PACKAGES_NOT_REFUND', 'Aucun pack n\'est remboursable.');
define('PLUS_FUNC', 'Fonction Plus');
define('REMAINING', 'Restant');
define('MINS', 'min');
define('ACTIVATE', 'Activer');
define('TOO_LITTLE_GOLD', 'Pas assez d\'or');
define('GOLD_ON', 'Activé');
define('PLUS_END', 'Votre avantage PLUS a pris fin');
define('NPC', 'PNJ');
define('NO_GOLD', 'Vous ne possédez actuellement pas d\'or.');
define('GOLD_CLUB', 'Gold Club');
define('NOW', 'maintenant');
define('NPC_TRADE_GOLD', 'Échanger avec le marchand PNJ');
define('COMPLETE_CONSTRUCTION_R_GOLD', 'Terminer immédiatement les ordres de construction et recherches dans ce village (ne fonctionne pas pour le palais et la résidence).');
define('FOR_GAME_SERVER', 'Tout le round de jeu');
define('HAVE_NO_INVITED', 'Vous n\'avez encore amené aucun nouveau joueur.');
define('INVITE_FRIENDS_GOLD', 'Invitez des amis et recevez de l\'or gratuit');
define('NEED_MORE_GOLD', 'Vous avez besoin de plus d\'or');
define('ADD_PLUS_FAIL', 'Tentative Plus échouée');
define('ADD_BONUS_LUMBER_FAIL', 'Tentative bois échouée');
define('ADD_BONUS_CLAY_FAIL', 'Tentative argile échouée');
define('ADD_BONUS_IRON_FAIL', 'Tentative fer échouée');
define('ADD_BONUS_CROP_FAIL', 'Tentative céréales échouée');
define('SELECT_GOLD_OPTION', 'Veuillez sélectionner l\'option à activer ou prolonger.');
define('GET_NOW', 'Obtenir maintenant');
define('BUY_NOW', 'Acheter maintenant');
define('SELECT_REWARD', 'Sélectionner la récompense');
define('VIP_ACCOUNT', 'Compte VIP');
define('USER_NOT_EXISTS', 'Le nom de compte saisi n\'existe pas.');
define('STATUS_UPDATED', 'Votre statut a été mis à jour.');

// profile
define('PREFERENCES', 'Préférences');
define('VACATION', 'Vacances');
define('ACTIVATE_VACATION', 'Voulez-vous activer le mode vacances ?');
define('GRAPH_PACK', 'Pack graphique');
define('PLAYER_PROFILE', 'Profil du joueur');
define('CHANGE_PASSWORD', 'Changer de mot de passe');
define('OLD_PASSWORD', 'Ancien mot de passe');
define('NEW_PASSWORD', 'Nouveau mot de passe');
define('CHANGE_EMAIL', 'Changer d\'e-mail');
define('CHANGE_EMAIL2', 'Veuillez saisir vos anciennes et nouvelles adresses e-mail. Vous recevrez ensuite un code à saisir ici aux deux adresses.');
define('OLD_EMAIL', 'Ancien e-mail');
define('NEW_EMAIL', 'Nouvel e-mail');
define('ACCOUNT_SITTERS', 'Substituts du compte');
define('ACCOUNT_SITTERS2', 'Un substitut peut se connecter à votre compte avec votre nom et son propre mot de passe. Vous pouvez avoir jusqu\'à deux substituts.');
define('SITTER_NAME', 'Nom du substitut');
define('NO_SITTERS', 'Vous n\'avez aucun substitut.');
define('RM_SITTER', 'Supprimer le substitut');
define('YOU_ARE_SITTER', 'Vous avez été désigné substitut sur les comptes suivants. Vous pouvez annuler cela en cliquant sur la croix rouge.');
define('DELETE_ACCOUNT', 'Supprimer le compte');
define('DELETE_ACCOUNT2', 'Vous pouvez supprimer votre compte ici. Après avoir lancé l\'annulation, il faudra trois jours pour terminer la suppression du compte. Vous pouvez annuler ce processus dans les 24 premières heures.');
define('YES', 'Oui');
define('NO', 'Non');
define('CONFIRM_W_PASS', 'Confirmer avec mot de passe');
define('MEDALS', 'Médailles');
define('PLAYER_HAS', 'Ce joueur a');
define('HOURS_OF_BG_PROT', 'heures de protection des débutants restantes');
define('PLAYER_WAS_REG_ON', 'Ce joueur a inscrit son compte le');
define('NATARS_ACC', 'Compte officiel Natar');
define('WW_V_M', 'Village officiel de la Merveille du monde');
define('ROMAN_T_M', 'Les Romains : grâce à leur haut niveau de développement social et technologique, les Romains sont des maîtres en construction et en coordination. Leurs troupes font partie de l\'élite dans Travian. Très équilibrées, elles sont utiles tant en attaque qu\'en défense.');
define('TEUTON_T_M', 'Les Teutons : les Teutons sont la tribu la plus agressive. Leurs troupes sont notoires et redoutées pour leur rage et leur frénésie au combat. Ils se déplacent comme une horde pillarde, sans même craindre la mort.');
define('GAUL_T_M', 'Les Gaulois : les Gaulois sont la tribu la plus pacifique des trois dans Travian. Leurs troupes sont entraînées pour une excellente défense, mais leur capacité d\'attaque rivalise avec les deux autres tribus. Les Gaulois sont des cavaliers nés et leurs chevaux sont réputés pour leur vitesse, ce qui leur permet de frapper l\'ennemi exactement où ils peuvent causer le plus de dégâts.');
define('ADMIN_M', 'Administrateur officiel du serveur');
define('MH_M', 'Multihunter global officiel du serveur');
define('MH_M2', 'Le Multihunter est un poste officiel Travian utilisé pour faire respecter les règles du jeu sur un serveur. Les Multihunters utilisent tous un compte nommé Multihunter avec son unique village situé en (0|0). Un Multihunter ne peut pas jouer sur le serveur où il est Multihunter, mais peut être joueur actif sur d\'autres serveurs.');
define('NATURE_M2', 'Les troupes de la nature sont les animaux vivant dans les oasis inoccupées. Vous pouvez utiliser le simulateur de combat pour voir si vous avez assez de troupes pour vaincre les animaux d\'une oasis que vous voulez conquérir, mais souvenez-vous que vous ne pouvez que piller les oasis. Gardez à l\'esprit que tous les animaux au-dessus de l\'ours peuvent tuer en combat singulier l\'unité travian de niveau maximum contemporaine.');
define('TASKMASTER_M', 'Compte du surveillant');
define('VETERAN_P', 'Joueur vétéran');
define('VETERAN_3_M', 'Médaille obtenue pour 3 ans de jeu à Travian');
define('VETERAN_5_M', 'Médaille obtenue pour 5 ans de jeu à Travian');
define('VETERAN_10_M', 'Médaille obtenue pour 10 ans de jeu à Travian');
define('ATT_W_M', 'Attaquants de la semaine');
define('DEF_W_M', 'Défenseurs de la semaine');
define('POP_W_M', 'Grimpeurs de population de la semaine');
define('ROB_W_M', 'Pilleurs de la semaine');
define('CLIMB_W_M', 'Grimpeurs de rang de la semaine');
define('ATT_DEF_10_W_M', 'Cette médaille indique que vous étiez dans le Top 10 des attaquants ET des défenseurs de la semaine.');
define('ATT_3_W_M', 'Cette médaille indique que vous étiez dans le Top 3 des attaquants de la semaine.');
define('DEF_3_W_M', 'Cette médaille indique que vous étiez dans le Top 3 des défenseurs de la semaine.');
define('POP_3_W_M', 'Cette médaille indique que vous étiez dans le Top 3 des grimpeurs de population de la semaine.');
define('ROB_3_W_M', 'Cette médaille indique que vous étiez dans le Top 3 des pilleurs de la semaine.');
define('CLIMB_3_W_M', 'Cette médaille indique que vous étiez dans le Top 3 des grimpeurs de rang de la semaine.');
define('ATT_10_W_M', 'Cette médaille indique que vous étiez dans le Top 10 des attaquants de la semaine.');
define('DEF_10_W_M', 'Cette médaille indique que vous étiez dans le Top 10 des défenseurs de la semaine.');
define('POP_10_W_M', 'Cette médaille indique que vous étiez dans le Top 10 des grimpeurs de population de la semaine.');
define('ROB_10_W_M', 'Cette médaille indique que vous étiez dans le Top 10 des pilleurs de la semaine.');
define('CLIMB_10_W_M', 'Cette médaille indique que vous étiez dans le Top 10 des grimpeurs de rang de la semaine.');
define('RECEIVED_IN_W', 'Reçue en semaine');
define('POINTS_M', 'Points');
define('RANKS', 'Rangs');
define('WEEK', 'Semaine');
define('CATEGORY', 'Catégorie');
define('RANK', 'Rang');
define('BB_CODE', 'BB-Code');
define('IN_ROW', 'd\'affilée');
define('ADMIN1', 'Administrateur');
define('MULTIH1', 'Multihunter');
define('PLAYER_ADMIN', 'Ce joueur est administrateur');
define('PLAYER_MH', 'Ce joueur est Multihunter');
define('PLAYER_BANNED', 'Ce joueur est BANNI');
define('PLAYER_VACATION', 'Ce joueur est en VACANCES');
if(!defined('BANNED')) define('BANNED', 'Banni');
define('GENDER', 'Genre');
define('GENDER0', 'N/A');
define('MALE0', 'h');
define('MALE', 'Homme');
define('FEMALE0', 'f');
define('FEMALE', 'Femme');
define('LOCATION', 'Localisation');
define('DIRECT_LINKS', 'Liens directs');
define('NUMBER0', 'N°');
define('LINK_NAME', 'Nom du lien');
define('LINK_TARGET', 'Cible du lien');
define('AUTO_COMPL', 'Auto-complétion');
define('AUTO_COMPL2', 'Utilisée pour le point de rassemblement et le marché.');
define('OWN_VILLAGES', 'Mes villages');
define('VILLAGES_NEAR', 'Villages des environs');
define('VILLAGES_ALLI_PLAYERS', 'Villages des joueurs de l\'alliance');
define('REPORT_FILTER', 'Filtre des rapports');
define('NO_REPORTS_TO_OWN', 'Aucun rapport pour les transferts vers mes villages');
define('NO_REPORTS_TO_OTH', 'Aucun rapport pour les transferts vers des villages étrangers');
define('NO_REPORTS_FROM_OTH', 'Aucun rapport pour les transferts depuis des villages étrangers');
define('CHANGE_PROFILE', 'Modifier le profil');
define('WRITE_MESSAGE', 'Écrire un message');
define('REPORT_PLAYER', 'Signaler un joueur');
define('ARTEFACT1', 'Artefact');
define('WoW1', 'WoW');
define('VILLAGE_NAME', 'Nom du village');
define('BDAY', 'Anniversaire');
define('CONDITIONS', 'Conditions');
define('TIME_PREF', 'Préférences horaires');
define('TIME_ZONES_DESC', 'Vous pouvez modifier ici l\'heure affichée par Travian pour qu\'elle corresponde à votre fuseau horaire.');
define('TIME_ZONE_L1', 'Europe');
define('TIME_ZONE_L2', 'Royaume-Uni');
define('TIME_ZONE_L3', 'Turquie');
define('TIME_ZONE_L4', 'Asie/Kolkata');
define('TIME_ZONE_L5', 'Asie/Bangkok');
define('TIME_ZONE_L6', 'USA/New York');
define('TIME_ZONE_L7', 'USA/Chicago');
define('TIME_ZONE_L8', 'Nouvelle-Zélande');
define('MONTH1', 'Jan');
define('MONTH2', 'Fév');
define('MONTH3', 'Mar');
define('MONTH4', 'Avr');
define('MONTH5', 'Mai');
define('MONTH6', 'Juin');
define('MONTH7', 'Juil');
define('MONTH8', 'Août');
define('MONTH9', 'Sep');
define('MONTH10', 'Oct');
define('MONTH11', 'Nov');
define('MONTH12', 'Déc');

/*
|--------------------------------------------------------------------------
|   Index
|--------------------------------------------------------------------------
*/

$lang['index'][0][1] = 'Bienvenue à '.SERVER_NAME;
$lang['index'][0][2] = 'Manuel';
$lang['index'][0][3] = 'Jouez maintenant, gratuitement !';
$lang['index'][0][4] = 'Qu\'est-ce que '.SERVER_NAME.' ?';
$lang['index'][0][5] = SERVER_NAME.' est un <b>jeu de navigateur</b> mettant en scène un monde antique captivant avec des milliers d\'autres vrais joueurs.</p><p>Il est <strong>gratuit</strong> et ne nécessite <strong>aucun téléchargement</strong>.';
$lang['index'][0][6] = 'Cliquez ici pour jouer à '.SERVER_NAME;
$lang['index'][0][7] = 'Joueurs au total';
$lang['index'][0][8] = 'Joueurs actifs';
$lang['index'][0][9] = 'Joueurs en ligne';
$lang['index'][0][10] = 'À propos du jeu';
$lang['index'][0][11] = 'Vous commencerez comme chef d\'un minuscule village et vous lancerez dans une aventure passionnante.';
$lang['index'][0][12] = 'Construisez des villages, menez des guerres ou établissez des routes commerciales avec vos voisins.';
$lang['index'][0][13] = 'Jouez avec et contre des milliers d\'autres vrais joueurs et partez à la conquête du monde de Travian.';
$lang['index'][0][14] = 'Actualités';
$lang['index'][0][15] = 'FAQ';
$lang['index'][0][16] = 'Captures d\'écran';
$lang['forum'] = 'Forum';
$lang['register'] = 'Inscription';
$lang['login'] = 'Connexion';
$lang['screenshots']['title1'] = 'Village';
$lang['screenshots']['desc1'] = 'Construction de village';
$lang['screenshots']['title2'] = 'Ressource';
$lang['screenshots']['desc2'] = 'Les ressources du village sont le bois, l\'argile, le fer et les céréales';
$lang['screenshots']['title3'] = 'Carte';
$lang['screenshots']['desc3'] = 'Localisez votre village sur la carte';
$lang['screenshots']['title4'] = 'Construction de bâtiment';
$lang['screenshots']['desc4'] = 'Comment construire un bâtiment ou améliorer une ressource';
$lang['screenshots']['title5'] = 'Rapport';
$lang['screenshots']['desc5'] = 'Votre rapport d\'attaque';
$lang['screenshots']['title6'] = 'Statistiques';
$lang['screenshots']['desc6'] = 'Consultez votre classement dans les statistiques';
$lang['screenshots']['title7'] = 'Armes ou pain';
$lang['screenshots']['desc7'] = 'Vous pouvez choisir de jouer en militaire ou en économiste';



// ===== i18n nouvelles constantes (etape 2) =====
define('TZ_ACTIVATION_AVAILBLE_IN', 'Activation disponible dans :');
define('TZ_ACTIVATION_CODE', 'Code d\'activation :');
define('TZ_ADD', 'ajouter');
define('TZ_ADD_2', 'Ajouter');
define('TZ_ALLIANCE_ID', 'ID de l\'alliance');
define('TZ_ARRIVED', 'Arrivé :');
define('TZ_ASSIGN_TO_POSITION', 'Assigner à un poste');
define('TZ_AS_SOON_AS_A_PLAYER_YOU_INVITED_FO', 'Dès qu\'un joueur que vous avez invité fonde son');
define('TZ_ATTACKS', 'Attaques');
define('TZ_BOLD', 'gras');
define('TZ_BUILDING', 'Bâtiment');
define('TZ_CATAPULT_TARGET', 'cible de la catapulte');
define('TZ_CLICK_TO_COPY', 'Cliquez pour copier');
define('TZ_CLIMBERS_OF_THE_WEEK', 'Progressions de la semaine');
define('TZ_CLOCK', 'Horloge');
define('TZ_CONTINUE_WITH_THE_NEXT_TASK', 'Continuez avec la tâche suivante.');
define('TZ_CREATE', 'Créer');
define('TZ_CREATE_A_NEW_LIST', 'Créer une nouvelle liste');
define('TZ_DESTINATION', 'Destination :');
define('TZ_DOES_NOT_EXIST', 'n\'existe pas.');
define('TZ_DOWNLOAD', 'Télécharger');
define('TZ_EVENT', 'Événement');
define('TZ_FEATURES_OF_TRAVIAN', 'Fonctionnalités de Travian');
define('TZ_FORUM_NAME', 'Nom du forum');
define('TZ_FORWARD', 'suivant');
define('TZ_GOLD', 'or.');
define('TZ_HERO_DEF_BONUS', 'Héros (bonus de défense)');
define('TZ_HERO_FIGHTING_STRENGTH', 'Héros (force de combat)');
define('TZ_HERO_OFF_BONUS', 'Héros (bonus d\'attaque)');
define('TZ_HOUR', 'heure');
define('TZ_HOW_IS_IT_DONE', 'Comment faire ?');
define('TZ_HRS', 'h');
define('TZ_HRS_2', 'h');
define('TZ_IF_YOU_GET_NEW_PLAYERS_TO_OPEN_AN', 'Si vous amenez de nouveaux joueurs à créer un compte et à fonder un deuxième village, vous recevrez');
define('TZ_IN_YOUR_POST_BECAUSE_IT_CAN_CAUSE', 'dans votre message car cela peut causer des problèmes avec le système BBCode.');
define('TZ_ITALIC', 'italique');
define('TZ_LAST_TARGETS', 'Dernières cibles :');
define('TZ_LIST_NAME', 'Nom de la liste :');
define('TZ_LOOK_FOR_YOUR_RANK_IN_THE_STATISTI', 'Cherchez votre rang dans les statistiques et saisissez-le ici.');
define('TZ_MACEMAN', 'Massue');
define('TZ_MEMBERS', 'Membres');
define('TZ_MEMBER_SINCE', 'Membre depuis');
define('TZ_NAME', 'Nom :');
define('TZ_NO', 'N°');
define('TZ_NOT_CODED_YET', '(pas encore implémenté)');
define('TZ_NO_EMAIL_RECEIVED', 'Aucun e-mail reçu ?');
define('TZ_N_15_GOLD', '15 or');
define('TZ_N_1_INVITE_YOUR_FRIENDS_VIA_EMAIL', '1) Invitez vos amis par e-mail');
define('TZ_N_20_GOLD', '20 or');
define('TZ_N_2_COPY_YOUR_PERSONAL_REF_LINK_AN', '2) Copiez votre lien de parrainage personnel et partagez-le !');
define('TZ_N_50_GOLD', '50 or');
define('TZ_OK_2', 'OK');
define('TZ_OPEN_FORUM_FOR_THE_FOLLOWING_PLAYE', 'Forum ouvert aux joueurs suivants');
define('TZ_OPEN_FOR_MORE_ALLIANCES', 'Ouvert à d\'autres alliances');
define('TZ_ORDER', 'Ordre :');
define('TZ_OTHER', 'Autre');
define('TZ_OWNER', 'Propriétaire :');
define('TZ_PAY_SECURELY_WITH_PAYPAL', 'Payez en toute sécurité avec PayPal.');
define('TZ_PLAYERS_BROUGHT_IN', 'Joueurs parrainés');
define('TZ_POST_NEW_THREAD', 'Publier un nouveau sujet');
define('TZ_PREVIEW', 'Aperçu');
define('TZ_PREVIEW_2', 'aperçu');
define('TZ_PROGRESS_OF_YOUR_INVITED_FRIENDS', 'Progression de vos amis invités');
define('TZ_QUIT_ALLIANCE', 'Quitter l\'alliance');
define('TZ_REGISTER_FOR_THE_GAME', 's\'inscrire au jeu');
define('TZ_REGISTRATION', 'inscription');
define('TZ_SENT', 'Envoyé :');
define('TZ_SMILIES', 'Émoticônes');
define('TZ_SMILIES_2', 'émoticônes');
define('TZ_STONEMASON_S_LODGE', 'Tailleur de pierre');
define('TZ_TAG', 'Tag :');
define('TZ_TARGET_VILLAGE', 'Village cible :');
define('TZ_TASK_10_CRANNY', 'Tâche 10 : Cachette');
define('TZ_TASK_11_TO_TWO', 'Tâche 11 : Au niveau deux.');
define('TZ_TASK_12_INSTRUCTIONS', 'Tâche 12 : Instructions');
define('TZ_TASK_13_MAIN_BUILDING', 'Tâche 13 : Bâtiment principal');
define('TZ_TASK_14_ADVANCED', 'Tâche 14 : Niveau avancé !');
define('TZ_TASK_16_ECONOMY', 'Tâche 16 : Économie');
define('TZ_TASK_16_MILITARY', 'Tâche 16 : Militaire');
define('TZ_TASK_17_BARRACKS', 'Tâche 17 : Caserne');
define('TZ_TASK_17_WAREHOUSE', 'Tâche 17 : Entrepôt');
define('TZ_TASK_18_MARKETPLACE', 'Tâche 18 : Marché.');
define('TZ_TASK_18_TRAIN', 'Tâche 18 : Entraînement.');
define('TZ_TASK_19_EVERYTHING_TO_2', 'Tâche 19 : Tout au niveau 2.');
define('TZ_TASK_20_ALLIANCE', 'Tâche 20 : Alliance.');
define('TZ_TASK_21_MAIN_BUILDING_TO_LEVEL_5', 'Tâche 21 : Bâtiment principal au niveau 5');
define('TZ_TASK_22_GRANARY_TO_LEVEL_3', 'Tâche 22 : Grenier au niveau 3.');
define('TZ_TASK_23_WAREHOUSE_TO_LEVEL_7', 'Tâche 23 : Entrepôt au niveau 7.');
define('TZ_TASK_24_ALL_TO_FIVE', 'Tâche 24 : Tout au niveau cinq !');
define('TZ_TASK_25_PALACE_OR_RESIDENCE', 'Tâche 25 : Palais ou Résidence ?');
define('TZ_TASK_26_3_SETTLERS', 'Tâche 26 : 3 colons.');
define('TZ_TASK_27_NEW_VILLAGE', 'Tâche 27 : Nouveau village.');
define('TZ_TASK_3_YOUR_VILLAGE_S_NAME', 'Tâche 3 : Le nom de votre village');
define('TZ_TASK_9_DOVE_OF_PEACE', 'Tâche 9 : Colombe de la paix');
define('TZ_TERMS', 'Conditions');
define('TZ_THE_ALLIANCE', 'L\'alliance');
define('TZ_THE_LARGEST_ALLIANCES', 'Les plus grandes alliances');
define('TZ_THE_USER', 'L\'utilisateur');
define('TZ_THREAD', 'Sujet');
define('TZ_TOP_10', 'Top 10');
define('TZ_TOTAL', 'Total');
define('TZ_TOWNHALL', 'Hôtel de ville');
define('TZ_TRAVIAN', 'Travian');
define('TZ_TRAVIANX', 'TravianX');
define('TZ_TRAVIANZ', 'TravianZ');
define('TZ_TRAVIAN_GAMES', 'Travian Games');
define('TZ_UNDERLINE', 'souligné');
define('TZ_UNDERLINED', 'souligné');
define('TZ_UNKNOWN', 'inconnu');
define('TZ_UNTIL_THE_NEXT_LEVEL', 'jusqu\'au niveau suivant');
define('TZ_USER_ID', 'ID utilisateur');
define('TZ_VILLAGE', 'Village :');
define('TZ_VILLAGE_OVERVIEW', 'Aperçu du village');
define('TZ_WAIT_INSTANT', 'Attente : immédiat');
define('TZ_WARNING', 'Attention :');
define('TZ_WOOD', 'Bois');
define('TZ_YOUR_PERSONAL_REF_LINK', 'Votre lien de parrainage personnel :');
define('TZ_YOU_CAN_T_USE_THE_VALUES', 'vous ne pouvez pas utiliser les valeurs');
define('TZ_YOU_HAVE_NOT_BROUGHT_IN_ANY_NEW_PL', 'Vous n\'avez encore parrainé aucun nouveau joueur.');


// ===== i18n etape 2 (lot suivant) =====
define('TZ_ACCOUNT_IS_ADMIN_OR_MH', 'Le compte est Admin ou MH');
define('TZ_ACCOUNT_IS_NOT_SCHEDULED_FOR_DELET', 'Le compte n\'est pas programmé pour suppression');
define('TZ_ACCOUNT_STATEMENT', 'Relevé de compte');
define('TZ_ACTIVATE_VACATION_MODE', 'Activer le mode vacances');
define('TZ_ADD_RAID', 'Ajouter un raid');
define('TZ_ADD_SLOT', 'Ajouter un emplacement');
define('TZ_ADVANTAGES', 'Avantages');
define('TZ_AFTER_PAYMENT_YOU_WILL_BE_CREDITED', 'Après le paiement, votre compte sera crédité automatiquement.');
define('TZ_AGRESOR', 'Agresseur');
define('TZ_ALLIANCE_DIPLOMACY', 'Diplomatie de l\'alliance');
define('TZ_ALLIANCE_EVENTS', 'Événements de l\'alliance');
define('TZ_ALLIANCE_FORUM', 'Forum de l\'alliance');
define('TZ_ALLIANCE_MEMBERS', 'membres de l\'alliance.');
define('TZ_ALLY_CHAT', 'Chat de l\'alliance');
define('TZ_AM', 'am');
define('TZ_AND_LATER_YOUR_VILLAGE_COULD_LOOK', '...et plus tard votre village pourrait ressembler à ça.');
define('TZ_AND_QUIT_THE_ALLIANCE_AFTERWARDS', 'et quittez l\'alliance ensuite.');
define('TZ_ASSIGN_RIGHTS', 'Attribuer des droits');
define('TZ_ATTENTION_USE_ONLY_TRUSTWORTHY_GRA', 'ATTENTION ! N\'utilisez que des packs graphiques fiables');
define('TZ_AUTHOR', 'Auteur');
define('TZ_BEGINNERS_PROT', 'Prot. débutant');
define('TZ_BEST_PLAYER', 'Meilleur joueur');
define('TZ_BUILDING_SITE', 'emplacement de construction');
define('TZ_BUILD_A_PALACE_OR_RESIDENCE_TO_LEV', 'Construisez un palais ou une résidence au niveau 10.');
define('TZ_BUILD_CROPPER', 'Construire un cropper');
define('TZ_BUY_IT_IN_THE_GOLD_SHOP', 'Achetez-le dans la boutique d\'or');
define('TZ_CELEBRATION_STILL_NEEDS', 'la célébration nécessite encore :');
define('TZ_CENTRE', 'Centre :');
define('TZ_CHANGE_NAME', 'Changer le nom');
define('TZ_CHANGE_YOUR_VILLAGE_S_NAME_TO_SOME', 'Donnez un joli nom à votre village.');
define('TZ_CHINESE', 'Chinois');
define('TZ_CLAY_25_5_GOLD', 'Argile +25% (5 or)');
define('TZ_CLOSED_FORUM', 'Forum fermé');
define('TZ_CLOSE_ADRESSBOOK', 'fermer le carnet d\'adresses');
define('TZ_COMBAT_SIMULATOR', 'Simulateur de combat');
define('TZ_COMPLETE_DEMOLITION_10', 'Démolition complète (10');
define('TZ_CONFEDERATION_FORUM', 'Forum de confédération');
define('TZ_CONFIRM_WITH_PASSWORD', 'Confirmez avec le mot de passe :');
define('TZ_CONSTRUCT_A_CRANNY', 'Construisez une cachette.');
define('TZ_CONSTRUCT_A_GRANARY', 'Construisez un grenier.');
define('TZ_CONSTRUCT_A_RALLY_POINT', 'Construisez un point de ralliement.');
define('TZ_CONSTRUCT_A_WOODCUTTER', 'Construisez un bûcheron.');
define('TZ_CONSTRUCT_BARRACKS', 'Construisez une caserne.');
define('TZ_CONSTRUCT_WAREHOUSE', 'Construisez un entrepôt.');
define('TZ_CP_DAY', 'PC/jour');
define('TZ_CROP_25_5_GOLD', 'Céréales +25% (5 or)');
define('TZ_DATE_AND_TIME', 'Date et heure');
define('TZ_DECLARE_WAR', 'déclarer la guerre');
define('TZ_DEFAULT', 'Par défaut :');
define('TZ_DELETE_ACCOUNT', 'Supprimer le compte ?');
define('TZ_DIFFERENT_EMAIL_ADDRESS', 'adresse e-mail différente');
define('TZ_DOWNLOAD_FROM', 'Télécharger depuis');
define('TZ_DO_I_NEED_PLUS_TO_USE_OTHER_FEATUR', 'Ai-je besoin de Plus pour utiliser d\'autres fonctions ?');
define('TZ_EARN_GOLD', 'Gagner de l\'or');
define('TZ_EDIT_ANSWER', 'Modifier la réponse');
define('TZ_EDIT_ANSWER_2', 'modifier la réponse');
define('TZ_EDIT_FORUM', 'modifier le forum');
define('TZ_EDIT_SLOT', 'Modifier l\'emplacement');
define('TZ_EDIT_TOPIC', 'Modifier le sujet');
define('TZ_ENDS_ON', 'se termine le');
define('TZ_ENGLISH', 'Anglais');
define('TZ_ENTER_HOW_MUCH_LUMBER_THE_BARRACKS', 'Indiquez le coût en bois de la caserne');
define('TZ_EU_DD_MM_YY_24H', 'UE (jj.mm.aa 24h)');
define('TZ_EXAMPLE', 'Exemple :');
define('TZ_EXISTING_RELATIONSHIPS', 'Relations existantes');
define('TZ_EXTEND_ALL_RESOURCE_TILES_TO_LEVEL', 'Améliorez tous les champs de ressources au niveau 1.');
define('TZ_EXTEND_ALL_RESOURCE_TILES_TO_LEVEL_2', 'Améliorez tous les champs de ressources au niveau 2.');
define('TZ_EXTEND_ONE_CLAY_PIT', 'Améliorez une carrière d\'argile.');
define('TZ_EXTEND_ONE_CROPLAND', 'Améliorez un champ de céréales.');
define('TZ_EXTEND_ONE_IRON_MINE', 'Améliorez une mine de fer.');
define('TZ_EXTEND_ONE_OF_EACH_RESOURCE_TILE_T', 'Améliorez un champ de chaque ressource au niveau 2.');
define('TZ_EXTEND_YOUR_MAIN_BUILDING_TO_LEVEL', 'Améliorez votre bâtiment principal au niveau 3.');
define('TZ_FINISH', 'Terminer');
define('TZ_FOLLOWING_CAUSES_ARE_POSSIBLE', 'Les causes suivantes sont possibles :');
define('TZ_FOLLOW_THIS_LINK_TO', 'Suivez ce lien pour');
define('TZ_FOREIGN_OFFERS', 'Offres étrangères');
define('TZ_FORUM_TYPE', 'Type de forum');
define('TZ_FOUND_A_NEW_VILLAGE', 'Fondez un nouveau village.');
define('TZ_FREE', 'GRATUIT !');
define('TZ_FRENCH', 'Français');
define('TZ_FRIEND_EMAIL_COM', 'friend@email.com');
define('TZ_GAME_LANGUAGE', 'Langue du jeu');
define('TZ_GITHUB', 'Github');
define('TZ_GRAPHIC_PACK_FOUND', 'Pack graphique trouvé.');
define('TZ_GRAPHIC_PACK_SETTINGS', 'Paramètres du pack graphique');
define('TZ_GREAT_STABLES', 'Grandes écuries');
define('TZ_HERE', 'ici');
define('TZ_HERE_YOU_CAN_KICK_THE_PLAYERS_FROM', 'Ici vous pouvez exclure les joueurs de votre alliance.');
define('TZ_HERE_YOU_FIND_YOUR_RESOURCE_FIELDS', 'Ici se trouvent vos champs de ressources');
define('TZ_HINT', 'Astuce');
define('TZ_HOW_DO_I_GET_GOLD', 'Comment obtenir de l\'or ?');
define('TZ_INACTIVE_DURING_VACATION', 'Inactif pendant les vacances');
define('TZ_INFORMATION_ON_HAPPENINGS_IN_YOUR', 'Informations sur les événements de votre village');
define('TZ_INITIATE_PAYMENT_BY_PAYPAL', 'Initier le paiement par PayPal');
define('TZ_INVITATIONS', 'Invitations :');
define('TZ_INVITE_A_PLAYER_INTO_THE_ALLIANCE', 'Inviter un joueur dans l\'alliance');
define('TZ_INVITE_BY_E_MAIL_OR_SHARE_YOUR_REF', 'Invitez par e-mail ou partagez votre lien de parrainage.');
define('TZ_IN_DESCRIPTION', 'dans la description.');
define('TZ_IN_THE_VILLAGE_YOU_CAN_BUILD_BUILD', 'Dans le village vous pouvez construire des bâtiments');
define('TZ_IRON_25_5_GOLD', 'Fer +25% (5 or)');
define('TZ_ISO_YY_MM_DD_24H', 'ISO (aa/mm/jj 24h)');
define('TZ_ITALIAN', 'Italien');
define('TZ_I_ACTIVATED_PLUS_BUT_PRODUCTION_DI', 'J\'ai activé Plus, mais la production n\'a pas augmenté.');
define('TZ_JOIN_AN_ALLIANCE', 'Rejoindre une alliance');
define('TZ_JOIN_AN_ALLIANCE_OR_FOUND_ONE_ON_Y', 'Rejoignez une alliance ou fondez la vôtre.');
define('TZ_JUL', 'juil.');
define('TZ_JUN', 'juin');
define('TZ_KICK_ALL_MEMBERS', 'exclure tous les membres');
define('TZ_KICK_PLAYER', 'Exclure le joueur :');
define('TZ_LANGUAGE_SETTINGS', 'Paramètres de langue');
define('TZ_LAST_POST', 'Dernier message');
define('TZ_LAST_RAID', 'Dernier raid');
define('TZ_LINKS', 'Liens :');
define('TZ_LINK_TO_THE_FORUM', 'Lien vers le forum');
define('TZ_LOG_IN', 'se connecter');
define('TZ_LUMBER_25_5_GOLD', 'Bois +25% (5 or)');
define('TZ_MAINTENANCE_OFF', 'Maintenance DÉSACTIVÉE');
define('TZ_MAINTENANCE_ON', 'Maintenance ACTIVÉE');
define('TZ_MAJOR_CHANGES', 'Changements majeurs :');
define('TZ_MAP_2', 'Carte :');
define('TZ_MAXIMUM_VACATION', 'Vacances maximum :');
define('TZ_MESSAGES', 'Messages :');
define('TZ_MESSAGE_3', 'Message');
define('TZ_MILITARY_EVENTS', 'Événements militaires');
define('TZ_MINIMUM_VACATION', 'Vacances minimum :');
define('TZ_MINOR_CHANGES', 'Changements mineurs :');
define('TZ_MISCELLANEOUS', 'Divers');
define('TZ_MORE_GRAPHIC_PACKS', 'Plus de packs graphiques');
define('TZ_MORE_INFO', 'Plus d\'infos :');
define('TZ_MOVE_TOPIC', 'Déplacer le sujet');
define('TZ_MULTIHUNTER', 'Multichasseur :');
define('TZ_NEW_FORUM', 'Nouveau forum');
define('TZ_NONE_OF_THE_PACKAGES_ARE_REFUNDABL', 'Aucun des forfaits n\'est remboursable !');
define('TZ_NOT_ENOUGH_RESOURCE', 'Ressources insuffisantes');
define('TZ_NO_MARKETPLACE_ACTIVITY', 'Aucune activité sur le marché');
define('TZ_NO_OWNERSHIP_OF_AN_ARTIFACT_VILLAG', 'Aucune possession d\'un village artefact');
define('TZ_NO_OWNERSHIP_OF_A_WONDER_OF_THE_WO', 'Aucune possession d\'un village Merveille du Monde');
define('TZ_NO_REINFORCING_TROOPS_SENT_RECEIVE', 'Aucune troupe de renfort envoyée/reçue');
define('TZ_NO_REPORTS_FOR_TRANSFERS_FROM_FORE', 'Aucun rapport pour les transferts depuis des villages étrangers.');
define('TZ_NO_REPORTS_FOR_TRANSFERS_TO_FOREIG', 'Aucun rapport pour les transferts vers des villages étrangers.');
define('TZ_NO_REPORTS_FOR_TRANSFERS_TO_OWN_VI', 'Aucun rapport pour les transferts vers vos propres villages.');
define('TZ_N_14_DAYS', '14 jours');
define('TZ_N_1_1_TRADE_WITH_THE_NPC_MERCHANT', 'Échange 1:1 avec le marchand PNJ');
define('TZ_N_1_5_YOUR_VILLAGE', '(1/5) Votre village');
define('TZ_N_1_CHOOSE_A_RESOURCE_FIELD', '1. Choisissez un champ de ressources');
define('TZ_N_1_CHOOSE_BUILDING_SITE', '1. Choisissez un emplacement de construction');
define('TZ_N_2_5_RESOURCES', '(2/5) Ressources');
define('TZ_N_2_CONSTRUCT_A_BUILDING', '2. Construisez un bâtiment');
define('TZ_N_2_DAYS', '2 jours');
define('TZ_N_2_EXTEND_THE_RESOURCE_FIELD', '2. Améliorez le champ de ressources');
define('TZ_N_3_5_BUILDINGS', '(3/5) Bâtiments');
define('TZ_N_4_5_NEIGHBOURS', '(4/5) Voisins');
define('TZ_N_5_5_NAVIGATION', '(5/5) Navigation');
define('TZ_OFFER_A_CONFEDERATION', 'proposer une confédération');
define('TZ_OFFER_NON_AGGRESSION_PACT', 'proposer un pacte de non-agression');
define('TZ_OK_3', 'ok');
define('TZ_ONLINE_USERS', 'Utilisateurs en ligne');
define('TZ_OPTION_1', 'Option 1 :');
define('TZ_OPTION_2', 'Option 2 :');
define('TZ_OPTION_3', 'Option 3 :');
define('TZ_OPTION_4', 'Option 4 :');
define('TZ_OPTION_5', 'Option 5 :');
define('TZ_OPTION_6', 'Option 6 :');
define('TZ_OPTION_7', 'Option 7 :');
define('TZ_OPTION_8', 'Option 8 :');
define('TZ_ORDERED_PACKAGE', 'Forfait commandé');
define('TZ_OR_ASK_THE_SERVER_OWNER', 'ou demandez au propriétaire du serveur.');
define('TZ_OVERVIEW', 'Aperçu :');
define('TZ_OWN_TEXT', 'Texte personnel :');
define('TZ_PALACE_RESIDENCE', 'Palais/Résidence');
define('TZ_PASSWORD', 'mot de passe :');
define('TZ_PAYMENT_ACCOUNT', 'compte de paiement');
define('TZ_PAYPAL', 'PayPal');
define('TZ_PAYPAL_PACKAGE_A', 'PayPal – Forfait A');
define('TZ_PAYPAL_PACKAGE_B', 'PayPal – Forfait B');
define('TZ_PAYPAL_PACKAGE_C', 'PayPal – Forfait C');
define('TZ_PAYPAL_PACKAGE_D', 'PayPal – Forfait D');
define('TZ_PAYPAL_PACKAGE_E', 'PayPal – Forfait E');
define('TZ_PLAY_NO_TASKS', 'Ne pas jouer les tâches.');
define('TZ_PLEASE_BUILD_A_MARKETPLACE', 'Veuillez construire un marché.');
define('TZ_PLUS_FUNCTIONS', 'Fonctions Plus');
define('TZ_PM', 'pm');
define('TZ_POP', 'Pop');
define('TZ_POSITION', 'Poste :');
define('TZ_PRODUCTION_CLAY', 'Production : Argile');
define('TZ_PRODUCTION_CROP', 'Production : Céréales');
define('TZ_PRODUCTION_IRON', 'Production : Fer');
define('TZ_PRODUCTION_LUMBER', 'Production : Bois');
define('TZ_PUBLIC_FORUM', 'Forum public');
define('TZ_RAGEZONE_COM', 'RageZone.com');
define('TZ_RANKING_OF_ALL_PLAYERS', 'Classement de tous les joueurs');
define('TZ_RATIO', 'ratio');
define('TZ_READ_YOUR_NEW_MESSAGE', 'Lisez votre nouveau message.');
define('TZ_REGISTERED', 'Inscrit');
define('TZ_REGISTERED_PLAYERS', 'Joueurs inscrits');
define('TZ_RELEASED_BY_TRAVIANZ_TEAM', 'Publié par : l\'équipe TravianZ');
define('TZ_RELEASE_BY_TRAVIANZ', '[Publié par : TravianZ]');
define('TZ_REPLIES', 'Réponses');
define('TZ_REPORTS', 'Rapports :');
define('TZ_REQUIREMENTS', 'Prérequis');
define('TZ_ROMANIAN', 'Roumain');
define('TZ_SCOUT_DEFENCES_AND_TROOPS', 'Espionner les défenses et les troupes');
define('TZ_SCOUT_RESOURCES_AND_TROOPS', 'Espionner les ressources et les troupes');
define('TZ_SCRIPT_PRICE', 'Prix du script :');
define('TZ_SELECT_ALL', 'Tout sélectionner');
define('TZ_SELECT_REWARD', 'Sélectionner une récompense...');
define('TZ_SELECT_REWARD_2', 'Sélectionner la récompense :');
define('TZ_SEND_200_CROP_TO_THE_TASKMASTER', 'Envoyez 200 céréales au maître des tâches.');
define('TZ_SEND_AND_RECEIVE_MESSAGES', 'Envoyer et recevoir des messages');
define('TZ_SEND_UNITS_BACK', 'Renvoyer les unités');
define('TZ_SERVER_START', 'Démarrage du serveur');
define('TZ_SHOW_THE_LARGE_MAP_IN_AN_EXTRA_WIN', 'Afficher la grande carte dans une fenêtre supplémentaire.');
define('TZ_SIZE_IN_MB', 'Taille en Mo');
define('TZ_SLOTS', 'Emplacements');
define('TZ_START_RAID', 'Lancer le raid');
define('TZ_STATISTICS', 'Statistiques :');
define('TZ_SUPPORT', 'Support :');
define('TZ_SUPPORT_AND_MULTIHUNTER', 'Support et Multichasseur');
define('TZ_SURVEY', 'sondage');
define('TZ_TARIFFS', 'Tarifs');
define('TZ_TASK_7_HUGE_ARMY', 'Tâche 7 : Immense armée !');
define('TZ_TASK_8_EVERYTHING_TO_1', 'Tâche 8 : Tout au niveau 1.');
define('TZ_THANK_YOU_FOR_USING_OUR_VERSION', 'Merci d\'utiliser notre version !');
define('TZ_THERE_ARE_NO_INCOMING_TROOPS', 'Aucune troupe entrante');
define('TZ_THERE_ARE_NO_OUTGOING_TROOPS', 'Aucune troupe sortante');
define('TZ_THE_BEST_ALLIANCES_DEF', 'Les meilleures alliances (déf)');
define('TZ_THE_BEST_ALLIANCES_OFF', 'Les meilleures alliances (att)');
define('TZ_THE_BUILDING_WAS_COMPLETELY_DEMOLI', 'Le bâtiment a été entièrement démoli pour 10 or !');
define('TZ_THE_EMAIL_ACCOUNT_S_STORAGE_LIMIT', 'La limite de stockage du compte e-mail est atteinte');
define('TZ_THE_EMAIL_HAS_BEEN_MOVED_TO_THE_SP', 'L\'e-mail a été déplacé dans le dossier spam/indésirables');
define('TZ_THE_EMAIL_WILL_BE_SENT_TO_FOLLOWIN', 'L\'e-mail sera envoyé à l\'adresse suivante :');
define('TZ_THE_E_MAIL_ADDRESS_OF_THE_NEW_OWNE', 'L\'adresse e-mail du nouveau propriétaire.');
define('TZ_THE_GAME_WORLD_ON_WHICH_THE_ACCOUN', 'Le monde de jeu sur lequel se trouve le compte');
define('TZ_THE_HERO', 'Le héros');
define('TZ_THE_LARGEST_GAULS', 'Les plus grands Gaulois');
define('TZ_THE_LARGEST_PLAYERS', 'Les plus grands joueurs');
define('TZ_THE_LARGEST_ROMANS', 'Les plus grands Romains');
define('TZ_THE_LARGEST_TEUTONS', 'Les plus grands Teutons');
define('TZ_THE_LARGEST_VILLAGES', 'Les plus grands villages');
define('TZ_THE_MOST_EXPERIENCED_HEROES', 'Les héros les plus expérimentés');
define('TZ_THE_MOST_SUCCESSFUL_ATTACKERS', 'Les attaquants les plus performants');
define('TZ_THE_MOST_SUCCESSFUL_DEFENDERS', 'Les défenseurs les plus performants');
define('TZ_THE_MULTIHUNTERS_ARE_RESPONSIBLE_F', 'Les Multichasseurs sont responsables du respect de');
define('TZ_THE_NAVIGATION_BAR', 'La barre de navigation');
define('TZ_THE_NICKNAME_OF_THE_ACCOUNT', 'Le pseudonyme du compte');
define('TZ_THE_PATH', 'Le chemin');
define('TZ_THE_VILLAGE', 'Le village');
define('TZ_THIS_FEATURE_IS_NOT_INCLUDED_IN_TH', 'Cette fonction n\'est PAS incluse dans le club d\'or !');
define('TZ_THIS_IS_HOW_YOU_START', 'Voici comment commencer...');
define('TZ_THREADS', 'Sujets');
define('TZ_TIME_PREFERENCE', 'Préférence horaire');
define('TZ_TIME_ZONES', 'Fuseaux horaires');
define('TZ_TIP', 'Astuce');
define('TZ_TOP_10_ALLIANCES', 'Top 10 des alliances');
define('TZ_TOP_10_PLAYERS', 'Top 10 des joueurs');
define('TZ_TOTAL_POPULATION', 'Population totale');
define('TZ_TOTAL_VILLAGES', 'Villages au total');
define('TZ_TO_THE_FIRST_TASK', 'Vers la première tâche.');
define('TZ_TO_THE_REGISTRATION', 'vers l\'inscription');
define('TZ_TRAIN_3_SETTLERS', 'Entraînez 3 colons.');
define('TZ_TRAVIAN_DEFAULT', 'Travian Default');
define('TZ_TRAVIAN_GOLD_CLUB', 'Travian Gold Club');
define('TZ_TRAVIAN_T4_STYLE', 'Travian T4 Style');
define('TZ_TRIBES', 'Tribus');
define('TZ_TYPOS_IN_THE_EMAIL_ADDRESS', 'Fautes de frappe dans l\'adresse e-mail');
define('TZ_UK_DD_MM_YY_12H', 'RU (jj/mm/aa 12h)');
define('TZ_UPGRADE_ALL_RESOURCES_TILES_TO_LEV', 'Améliorez tous les champs de ressources au niveau 5.');
define('TZ_UPGRADE_YOUR_GRANARY_TO_LEVEL_3', 'Améliorez votre grenier au niveau 3.');
define('TZ_UPGRADE_YOUR_MAIN_BUILDING_TO_LEVE', 'Améliorez votre bâtiment principal au niveau 5.');
define('TZ_UPGRADE_YOUR_WAREHOUSE_TO_LEVEL_7', 'Améliorez votre entrepôt au niveau 7.');
define('TZ_USE', 'Utiliser');
define('TZ_USED_FOR_RALLY_POINT_AND_MARKETPLA', 'Utilisé pour le point de ralliement et le marché :');
define('TZ_USERNAME', 'Nom d\'utilisateur');
define('TZ_USER_DEFINED_GRAPHIC_PACK', 'Pack graphique personnalisé');
define('TZ_USE_IT_FOR_PLUS_OR_ANY_ADVANTAGE', '. Utilisez-le pour Plus ou tout autre avantage.');
define('TZ_US_MM_DD_YY_12H', 'US (mm/jj/aa 12h)');
define('TZ_UTC_1', 'UTC+1');
define('TZ_UTC_10', 'UTC+10');
define('TZ_UTC_10_2', 'UTC-10');
define('TZ_UTC_11', 'UTC+11');
define('TZ_UTC_11_2', 'UTC-11');
define('TZ_UTC_12', 'UTC+12');
define('TZ_UTC_1_2', 'UTC-1');
define('TZ_UTC_2', 'UTC+2');
define('TZ_UTC_2_2', 'UTC-2');
define('TZ_UTC_3', 'UTC+3');
define('TZ_UTC_3_2', 'UTC-3');
define('TZ_UTC_4', 'UTC+4');
define('TZ_UTC_4_2', 'UTC-4');
define('TZ_UTC_5', 'UTC+5');
define('TZ_UTC_5_2', 'UTC-5');
define('TZ_UTC_6', 'UTC+6');
define('TZ_UTC_6_2', 'UTC-6');
define('TZ_UTC_7', 'UTC+7');
define('TZ_UTC_7_2', 'UTC-7');
define('TZ_UTC_8', 'UTC+8');
define('TZ_UTC_8_2', 'UTC-8');
define('TZ_UTC_9', 'UTC+9');
define('TZ_UTC_9_2', 'UTC-9');
define('TZ_VERSION', 'Version :');
define('TZ_VILLAGE_EXP', 'Exp. du village');
define('TZ_VILLAGE_YOU_GET', 'village, vous obtenez');
define('TZ_VILLAGE_YOU_WILL_BE_CREDITED_WITH', 'village, votre compte sera crédité de');
define('TZ_VIP_ACCOUNT_10_GOLD_7_DAYS', 'Compte VIP (10 or – 7 jours)');
define('TZ_VISIT', 'Visiter :');
define('TZ_VOTE', 'Voter');
define('TZ_WAIT_24H', 'Attente : 24h');
define('TZ_WAIT_INSTANT_AFTER_IPN', 'Attente : immédiat après IPN');
define('TZ_WARNING_CATAPULT_WILL', 'Attention : la catapulte va');
define('TZ_WE_STRIVE_TO_ENSURE_SPEEDY_PROCESS', 'Nous nous efforçons d\'assurer un traitement rapide !');
define('TZ_WHY_CAN_T_I_FINISH_SOME_BUILDINGS', 'Pourquoi ne puis-je pas terminer certains bâtiments avec de l\'or ?');
define('TZ_WILL_BE_ATTACKED_BY_CATAPULT_S', '(sera attaqué par catapulte(s))');
define('TZ_WILL_SPAWN_IN', 'apparaîtra dans :');
define('TZ_WOODCUTTER_INSTANTLY_COMPLETED', 'Bûcheron terminé instantanément.');
define('TZ_WORLD_STATS', 'Statistiques du monde');
define('TZ_WRITE_THE_CODE', 'Saisissez le code');
define('TZ_WRONG_DOMAIN_THERE_IS_E_G_NO_AOL_D', 'Mauvais domaine : il n\'y a p. ex. pas de @aol.de, seulement @aol.com');
define('TZ_YOUR_ACCOUNT_HAS_BEEN_SUCCESSFULLY', 'Votre compte a été activé avec succès.');
define('TZ_YOUR_VILLAGE_AND_YOUR_NEIGHBOURS', 'Votre village et vos voisins');
define('TZ_YOU_CAN_UNDO_THE_REGISTRATION_AND', 'Vous pouvez annuler l\'inscription et vous réinscrire avec une');
define('TZ_YOU_CAN_USE_THIS_GOLD_FOR_PLUS_OR', '. Vous pouvez utiliser cet or pour Plus ou tout avantage en or.');


// ===== i18n etape 2 (lot suivant) =====
define('TZ_ACCOUNT_OR_INCREASE_YOUR_RESOURCE', '-Compte ou augmentez votre production de ressources. Pour ce faire, cliquez');
define('TZ_ADDITIONALLY_THE_TRAVIAN_TEAM_WILL', 'De plus, l\'équipe Travian ne fournira d\'informations concernant les bannissements à aucune personne autre que le propriétaire du compte.');
define('TZ_ADVERTISEMENT_OF_ANY_KIND_THAT_HAS', 'Toute publicité non autorisée par l\'équipe Travian est interdite.');
define('TZ_AFTERWARDS_BOTH_PARTIES_MUST_REQUE', 'Ensuite, les deux parties doivent demander le mot de passe de leur nouveau compte via la fonction de récupération de mot de passe.');
define('TZ_AFTER_TAKING_CARE_OF_YOUR_RESOURCE', 'Après avoir assuré votre approvisionnement en ressources, vous pouvez commencer l\'expansion de votre village.');
define('TZ_ANY_SALES_OR_PURCHASES_CONCERNING', 'Toute vente ou achat impliquant de l\'argent réel concernant des comptes, unités, villages, ressources, services ou tout autre aspect de Travian est interdit. La vente de comptes Travian ainsi que tout transfert indirect (même sous forme de cadeau) en lien avec des sites d\'enchères ou d\'autres transactions monétaires est interdit.');
define('TZ_AS_A_LEADER_YOU_CAN_ONLY_CHANGE_YO', 'En tant que dirigeant, vous ne pouvez changer que votre titre. Vos droits restent au maximum.');
define('TZ_A_SITTER_CAN_LOG_INTO_YOUR_ACCOUNT', 'Un remplaçant peut se connecter à votre compte avec votre nom et son propre mot de passe. Vous pouvez avoir jusqu\'à deux remplaçants.');
define('TZ_A_WAREHOUSE_AND_A_GRANARY_ENABLE_Y', 'Un entrepôt et un grenier vous permettent de stocker plus de ressources. Une cachette protège vos ressources du vol par les pillards ennemis.');
define('TZ_BECAUSE_YOU_ARE_THE_ALLIANCE_FOUND', 'Comme vous êtes le fondateur de l\'alliance, vous devez choisir un fondateur remplaçant avant de partir.');
define('TZ_BEFORE_YOU_EXPAND_YOUR_VILLAGE_S_B', 'Avant d\'agrandir les bâtiments de votre village, vous devriez développer quelques champs de ressources pour augmenter votre approvisionnement.');
define('TZ_BLACKMAILING_PLAYERS_IN_A_WAY_THAT', 'Faire chanter des joueurs d\'une manière qui enfreint l\'une des règles de Travian conformément aux Conditions Générales.');
define('TZ_COMPLETE_CONSTRUCTION_ORDERS_AND_R', 'Terminez maintenant les ordres de construction et les recherches dans ce village');
define('TZ_DISPLAYING_BATTLE_REPORTS_OR_MESSA', 'Afficher publiquement des rapports de combat ou des messages sans le consentement des deux parties concernées.');
define('TZ_EACH_PLAYER_MAY_ONLY_OWN_AND_PLAY', 'Chaque joueur ne peut posséder et jouer qu\'un seul compte par serveur.');
define('TZ_ENGLISH_IS_THE_ONLY_LANGUAGE_TOLER', 'L\'anglais est la seule langue tolérée dans les messages et les descriptions.');
define('TZ_FOLLOWING_BEHAVIOR_IS_PUNISHABLE_A', 'Le comportement suivant est punissable et s\'applique à toutes les descriptions, au nom du compte, aux noms d\'alliance, aux noms de village et aux messages :');
define('TZ_HERE_YOU_CAN_CHANGE_TRAVIAN_S_DISP', 'Ici vous pouvez modifier l\'heure affichée de Travian pour l\'adapter à votre fuseau horaire.');
define('TZ_HERE_YOU_CAN_HAVE_A_LOOK_AT_YOUR_V', 'Ici vous pouvez observer les environs de votre village et vos voisins');
define('TZ_HOWEVER_IT_IS_PERMISSIBLE_TO_TRANS', 'Cependant, il est permis de transmettre le mot de passe d\'un compte à une ou plusieurs personnes jouant sur un monde de jeu différent (ou ne jouant pas du tout) afin de jouer ensemble un même compte.');
define('TZ_IF_INDIVIDUAL_REGULATIONS_OF_THIS', 'Si certaines dispositions de ce règlement s\'avéraient de quelque manière que ce soit inefficaces, cela n\'affecte pas la validité des autres dispositions de ce règlement. Les administrateurs s\'engagent à remplacer les dispositions inefficaces par de nouvelles dispositions dès que possible.');
define('TZ_IF_THERE_IS_AN_OFFENCE_AGAINST_THE', 'En cas d\'infraction à ces règles du jeu, les Multichasseurs et, si nécessaire, les administrateurs banniront le ou les comptes concernés et décideront d\'une sanction appropriée. Les sanctions dépasseront toujours le gain tiré de la violation des règles.');
define('TZ_IF_YOUR_ALLIANCE_WANTS_TO_USE_AN_E', 'Si votre alliance souhaite utiliser un forum externe, vous pouvez saisir l\'URL ici.');
define('TZ_IMPERSONATING_OFFICIALS_OR_OFFICIA', 'Se faire passer pour des officiels ou des fonctions officielles est illégal de quelque manière que ce soit.');
define('TZ_INCITING_MANIPULATING_ENCOURAGING', 'Inciter, manipuler, encourager, aider ou conspirer avec d\'autres pour enfreindre l\'une des règles de Travian est interdit. Ces règles s\'appliquent sans exception aux joueurs qui supprimeront leur compte ou sont en train de le supprimer.');
define('TZ_INTO_YOUR_PROFILE_BY_ADDING_IT_TO', 'dans votre profil en l\'ajoutant à l\'un des deux champs de description.');
define('TZ_IN_ORDER_TO_ACTIVATE_YOUR_ACCOUNT', 'Pour activer votre compte, saisissez le code ou cliquez sur le lien dans votre e-mail.');
define('TZ_IN_ORDER_TO_PLAY_TRAVIAN_YOU_NEED', 'Pour jouer à Travian, vous avez besoin d\'une adresse e-mail valide à laquelle le code d\'activation peut être envoyé. Dans des cas exceptionnels, cet e-mail peut ne pas arriver.');
define('TZ_IN_ORDER_TO_QUIT_THE_ALLIANCE_YOU', 'Pour quitter l\'alliance, vous devez saisir à nouveau votre mot de passe pour des raisons de sécurité.');
define('TZ_IN_ORDER_TO_SWITCH_AN_ACCOUNT_WITH', 'Pour échanger un compte avec une autre personne sur le même monde de jeu, les deux personnes doivent envoyer un e-mail à admin@travian.com depuis l\'adresse e-mail actuellement enregistrée pour le compte. L\'e-mail doit contenir les informations suivantes :');
define('TZ_IN_THE_BEGINNING_YOUR_SMALL_VILLAG', 'Au début, votre petit village n\'aura qu\'un seul bâtiment.');
define('TZ_IN_TRAVIAN_YOU_ARE_NOT_ALONE_YOU_I', 'Dans Travian, vous n\'êtes pas seul ; vous interagissez avec des milliers d\'autres joueurs dans le monde de Travian.');
define('TZ_IT_S_PART_OF_DIPLOMATIC_ETIQUETTE', 'Il fait partie de l\'étiquette diplomatique de parler à une autre alliance avant d\'envoyer une offre.');
define('TZ_MULTIACCOUNTS_ON_THE_SPEED_SERVER', 'Les multicomptes sur le serveur rapide et les multicomptes de moins de 100 habitants peuvent être supprimés à vue sans avertissement préalable.');
define('TZ_NOW_YOU_HAVE_FULFILLED_ALL_PREREQU', 'Vous avez maintenant rempli tous les prérequis nécessaires pour construire un marché.');
define('TZ_NOW_YOU_KNOW_EVERYTHING_IMPORTANT', 'Vous savez maintenant tout ce qui est important sur Travian. Après l\'inscription, vous pouvez commencer à jouer !');
define('TZ_NO_EVERY_GOLD_FEATURE_WORKS_STANDA', 'Non. Chaque fonction en or fonctionne de manière autonome tant que vous avez assez d\'or.');
define('TZ_NO_REAL_WORLD_POLITICS_ARE_ALLOWED', 'Aucune politique du monde réel n\'est autorisée dans les noms, messages et descriptions.');
define('TZ_PARTICIPATION_IN_ABUSIVE_DEFAMATOR', 'Participation à des propos injurieux, diffamatoires, sexistes, racistes ou grossiers ; dénigrement de toute religion, race, nation, sexe, tranche d\'âge ou orientation sexuelle ; menace d\'actions dans la vie réelle envers une personne.');
define('TZ_PLAYERS_MAY_TALK_TO_THE_MULTIHUNTE', 'Les joueurs peuvent s\'adresser au Multichasseur qui les a bannis ou à un administrateur via MIJ (message en jeu) ou e-mail. Les bannissements, sanctions ou suppressions ne doivent pas être discutés en public (par ex. Chat ou Forums). Les recours doivent être rédigés en anglais.');
define('TZ_PLEASE_ENTER_YOUR_OLD_AND_YOUR_NEW', 'Veuillez saisir votre ancienne et votre nouvelle adresse e-mail. Vous recevrez alors un extrait de code aux deux adresses, que vous devrez saisir ici.');
define('TZ_PLUS_DOES_NOT_INCLUDE_PRODUCTION_B', 'Plus n\'inclut pas les bonus de production. Vous devez acheter +25% pour chaque ressource séparément dans');
define('TZ_PROGRAM_ERRORS_ALSO_CALLED_BUGS_MA', 'Les erreurs de programme (aussi appelées bugs) ne doivent pas être utilisées à son avantage. L\'abus peut entraîner une sanction du compte.');
define('TZ_RESIDENCE_PALACE_AND_WORLD_WONDER', 'Les villages Résidence, Palais et Merveille du Monde sont exclus pour des raisons de gameplay.');
define('TZ_RESOURCES_BUILDINGS_VILLAGES_OR_TR', 'Les ressources, bâtiments, villages ou troupes perdus pendant la durée de suspension ne comptent pas comme une sanction et ne seront pas remplacés par l\'équipe Travian. Aucun joueur n\'a le droit de réclamer un paiement ou un remplacement pour le temps de Plus/Or perdu en raison d\'une suspension.');
define('TZ_SHOOT_WITH_A_NORMAL_ATTACK_THEY_DO', 'tirent lors d\'une attaque normale (ils ne tirent pas lors des raids !)');
define('TZ_SOMETIMES_THE_EMAIL_IS_MOVED_TO_TH', 'Parfois, l\'e-mail est déplacé dans le dossier spam. Pour plus d\'aide, cliquez');
define('TZ_THERE_ARE_FOUR_DIFFERENT_TYPES_OF', 'Il existe quatre types de ressources différents dans Travian : bois, argile, fer et céréales.');
define('TZ_THERE_IS_NO_COMPENSATION_FOR_DAMAG', 'Il n\'y a aucune compensation pour les dommages causés par un remplaçant. Les propriétaires de compte sont entièrement responsables des actions effectuées par les remplaçants choisis pour leur compte. Si les remplaçants d\'un compte ne respectent pas ces règles et les Conditions Générales de Travian, le propriétaire du compte et le remplaçant peuvent être tenus responsables et sanctionnés.');
define('TZ_THERE_IS_NO_COMPENSATION_FOR_DAMAG_2', 'Il n\'y a aucune compensation pour les dommages causés par une personne connaissant le mot de passe d\'un compte. La personne recevant le mot de passe est soumise aux règles de Travian ainsi qu\'aux Conditions Générales.');
define('TZ_THERE_IS_NO_SPECIAL_TREATMENT_FOR', 'Il n\'y a aucun traitement particulier pour les utilisateurs de Travian Plus/Or concernant les règles du jeu, ni dans le délai de traitement du dossier, ni dans la sanction.');
define('TZ_THE_E_MAIL_ADDRESS_USED_FOR_THE_RE', 'L\'adresse e-mail utilisée pour l\'inscription d\'un compte doit être sous le contrôle personnel et exclusif de la personne qui a enregistré le compte. La personne possédant l\'adresse e-mail actuellement enregistrée pour un compte est considérée comme le propriétaire du compte, indépendamment de tout autre accord personnel ou d\'alliance. Le propriétaire d\'un compte est entièrement responsable de toutes les actions effectuées par ce compte.');
define('TZ_THE_FOLLOWING_SET_OF_RULES_ARE_IN', 'Le règlement suivant s\'applique conjointement aux Conditions Générales de Travian. Vous devriez vous familiariser avec les Conditions Générales pour vérifier ce qui est autorisé et ce qui est interdit, en particulier dans le cas d\'un compte banni pour violation des règles.');
define('TZ_THE_GAME_MUST_BE_PLAYED_WITH_AN_UN', 'Le jeu doit se jouer avec un navigateur Internet non modifié. L\'utilisation de scripts ou de bots automatisant les actions du compte est contraire aux règles.');
define('TZ_THE_OWNER_OF_AN_ACCOUNT_MAY_NOT_TR', 'Le propriétaire d\'un compte ne peut transmettre le mot de passe d\'un compte à aucune personne jouant sur le même monde de jeu (serveur). De plus, choisir sciemment le même mot de passe qu\'une autre personne sur le même monde de jeu est illégal ; chacune de ces actions est considérée comme du multicompte, tel que défini dans ces règles.');
define('TZ_THE_PLAYERS_IN_YOUR_SURROUNDING_AR', 'Les joueurs autour de vous sont les plus importants pour vous. Grâce à la carte, vous avez une bonne vue d\'ensemble de qui ils sont.');
define('TZ_THE_REGISTRATION_WAS_SUCCESSFUL_IN', 'L\'inscription a réussi. Dans les prochaines minutes, vous recevrez un e-mail avec les informations d\'accès.');
define('TZ_THE_SUPPORT_IS_A_GROUP_OF_EXPERIEN', 'Le support est un groupe de joueurs expérimentés qui répondront volontiers à vos questions.');
define('TZ_THE_TRAVIAN_TEAM_RESERVES_THE_RIGH', 'L\'équipe Travian se réserve le droit de modifier les règles à tout moment.');
define('TZ_TO_BRING_IN_NEW_PLAYERS_INVITE_THE', 'Pour parrainer de nouveaux joueurs, invitez-les par e-mail ou partagez votre lien de parrainage.');
define('TZ_VACATION_MODE_CANNOT_BE_ACTIVATED', 'Le mode vacances ne peut pas être activé – conditions non remplies');
define('TZ_WE_WILL_SHOW_YOU_HOW_TO_EXPAND_YOU', 'Nous vous montrerons à la page suivante comment développer votre village pour qu\'il devienne une cité puissante et prospère.');
define('TZ_YOU_CAN_DELETE_YOUR_ACCOUNT_HERE_A', 'Vous pouvez supprimer votre compte ici. Après le début de la résiliation, la suppression de votre compte prendra trois jours. Vous pouvez annuler ce processus durant les 24 premières heures.');
define('TZ_YOU_DON_T_HAVE_ENOUGH_GOLD_YOU_NEE', 'Vous n\'avez pas assez d\'or. Il vous faut 10 or pour une démolition instantanée.');
define('TZ_YOU_HAVE_BEEN_ENTERED_AS_SITTER_ON', 'Vous avez été désigné comme remplaçant sur les comptes suivants. Vous pouvez annuler cela en cliquant sur le X rouge.');


// ===== i18n composites (Simulateur) =====
define('TZ_NUMBER', 'Nombre');
define('TZ_LVL', 'Niv.');


// ===== i18n reliquat multi-lignes =====
define('TZ_ML_LEADER_DEMOLITION_EMBASSY', 'Comme vous êtes le chef de votre alliance, la démolition de votre ambassade actuelle ne peut pas être lancée, car elle contient encore toutes vos');
define('TZ_ML_CHANGELOG_120BUGS', 'Plus de 120 bugs corrigés, artefacts entièrement corrigés, catapultes et béliers entièrement corrigés, Natars/Artefacts/villages MdM/plans de construction MdM automatisés, nouvelle formule de combat (plus précise que l\'ancienne), activation automatique des artefacts, une grande partie du code réécrite. Plus d\'infos dans le fichier readme !');
define('TZ_ML_CHANGELOG_NEWFORUM', 'Nouveau système de forum, formule du trappeur façon Travian, maître d\'œuvre corrigé, double file de recherche à la forge et à l\'armurerie avec Plus');
define('TZ_ML_GOLD_RESERVE', 'En principe, nous réservons le montant d\'or commandé immédiatement après le paiement. En cas de problème, veuillez envoyer un e-mail à notre');
define('TZ_ML_GPACK_NOTFOUND', 'Le pack graphique est introuvable. Cela peut être dû aux raisons suivantes :');
define('TZ_ML_GPACK_ALLOWED_SAVE', 'affiche un pack graphique autorisé. Enregistrez votre choix pour l\'activer.');
define('TZ_ML_GPACK_ALTER_APPEARANCE', 'Avec un pack graphique, vous pouvez modifier l\'apparence de Travian. Vous pouvez en choisir un dans la liste ou indiquer un chemin personnalisé.');
define('TZ_ML_QUESTIONS_MULTIHUNTER', '. Si vous avez des questions ou souhaitez signaler une infraction, vous pouvez écrire à un Multichasseur.');
define('TZ_ML_AWAY_NO_SITTER', 'Si vous prévoyez de vous absenter pendant une période prolongée et ne souhaitez pas désigner de remplaçant, vous pouvez activer');
define('TZ_ML_ACCOUNT_FROZEN', '. Pendant cette période, votre compte est essentiellement gelé. Aucune ressource, troupe ou recherche ne progressera et vos villages ne peuvent pas être attaqués. N\'oubliez pas : cela ne gèle que votre Travian, pas le temps.');
define('TZ_ML_ACTIVATION_RESENT', '. Le code d\'activation sera alors renvoyé');
define('TZ_ML_TWO_SITTERS_RIGHT', 'Chaque joueur a le droit de désigner deux remplaçants qui peuvent jouer le compte pendant l\'absence du propriétaire. Les remplaçants doivent jouer le compte qu\'ils gardent dans le plein intérêt de ce compte. L\'abus de cette fonction est punissable.');
define('TZ_ML_SAME_COMPUTER_SITTER', 'Les joueurs utilisant le même ordinateur et souhaitant accéder au compte de l\'autre doivent utiliser la fonction de remplacement.');
define('TZ_ML_POLITE_TONE', 'Chacun doit communiquer sur un ton poli et courtois. Les Multichasseurs peuvent modifier sans avertissement les profils et noms de village inappropriés.');
define('TZ_ML_MATERIAL_UNDERAGE', 'La publication ou la transmission de tout contenu inapproprié pour les mineurs.');


// ===== i18n reliquat final =====
define('TZ_NO_BEGINNER_PROT2', 'Pas de protection débutant');
define('TZ_SERVER_RUNNING_ON', '▶ Serveur actif sur');

// ===== task A: re-wired reverted templates =====
define('TZ_HERO', "Héros");
define('TZ_SEND_UNITS_BACK_TO', "Renvoyer les troupes vers");
define('TZ_CONFIRM_DEMOLISH_COMPLETE_1', "Voulez-vous vraiment démolir COMPLÈTEMENT ");
define('TZ_CONFIRM_DEMOLISH_COMPLETE_2', " pour 10 ORS ?\nLe bâtiment disparaîtra instantanément, c'est irréversible.");
define('TZ_CONFIRM_LAST_EMBASSY_L3', "ATTENTION !\n\nVous êtes sur le point de démolir la dernière ambassade de niveau 3 !\n\nComme vous êtes le chef de votre alliance et qu'il ne reste aucun autre membre, l'alliance sera dissoute une fois la démolition terminée.");
define('TZ_CONFIRM_LAST_EMBASSY_L1', "ATTENTION !\n\nVous êtes sur le point de démolir votre dernière ambassade !\n\nComme vous êtes dans une alliance, vous la quitterez automatiquement une fois la démolition terminée.");

define('TZ_TRADE', "Commerce");

// ===== reports section (noticeClass tooltips) =====
define('TZ_RPT_SCOUT', "Rapport d'éclaireur");
define('TZ_RPT_WON_ATK_NOLOSS', "Gagné en attaquant sans pertes");
define('TZ_RPT_WON_ATK_LOSS', "Gagné en attaquant avec pertes");
define('TZ_RPT_LOST_ATK_LOSS', "Perdu en attaquant avec pertes");
define('TZ_RPT_WON_DEF_NOLOSS', "Gagné en défendant sans pertes");
define('TZ_RPT_WON_DEF_LOSS', "Gagné en défendant avec pertes");
define('TZ_RPT_LOST_DEF_LOSS', "Perdu en défendant avec pertes");
define('TZ_RPT_LOST_DEF_NOLOSS', "Perdu en défendant sans pertes");
define('TZ_RPT_REINF_ARRIVED', "Renfort arrivé");
define('TZ_RPT_WOOD_DELIVERED', "Bois livré");
define('TZ_RPT_CLAY_DELIVERED', "Argile livrée");
define('TZ_RPT_IRON_DELIVERED', "Fer livré");
define('TZ_RPT_CROP_DELIVERED', "Céréales livrées");
define('TZ_RPT_WON_SCOUT_ATK', "Espionnage réussi en attaquant");
define('TZ_RPT_LOST_SCOUT_ATK', "Espionnage échoué en attaquant");
define('TZ_RPT_WON_SCOUT_DEF', "Espionnage réussi en défendant");
define('TZ_RPT_LOST_SCOUT_DEF', "Espionnage échoué en défendant");


// ===== report topic connectors (display-time localization) =====
define('TZ_RT_ATTACKS', "attaque");
define('TZ_RT_REINFORCEMENT', "renforce");
define('TZ_RT_SCOUTS', "espionne");
define('TZ_RT_SEND_RES_TO', "envoie des ressources à");
define('TZ_RT_WAS_ATTACKED', "a été attaqué");
define('TZ_RT_REINF_IN', "Renfort dans");
define('TZ_RT_ELDERS_REINF', "renfort du village des anciens");
define('TZ_RT_UNOCC_OASIS', "Oasis inoccupée");
define('TZ_RT_NEW_VILLAGE', "Nouveau village fondé");
define('TZ_RT_VALLEY_OCCUPIED', "Colonisation échouée (vallée occupée)");
define('TZ_NEW_VILLAGE_MSG', "Vous avez fondé un nouveau village :");
define('TZ_VALLEY_OCCUPIED_MSG', "Vos colons n'ont pas pu s'installer ici — la vallée est déjà occupée par un autre joueur. Ils sont sur le chemin du retour.");

// ===== profil du joueur (#189) =====
define('AGE', 'Âge');
define('CAPITAL_TAG', 'Capitale');
define('WRITE_MESSAGE_UNAVAILABLE', 'Écrire un message non disponible');
define('PROFILE_FLAG_ADMIN', 'Ce joueur est Administrateur.');
define('PROFILE_FLAG_MULTIHUNTER', 'Ce joueur est Multihunter.');
define('PROFILE_FLAG_BANNED', 'Ce joueur est BANNI.');
define('PROFILE_FLAG_VACATION', 'Ce joueur est en VACANCES.');

// ===== page d'accueil du manuel en jeu (#189) =====
define('BUILDINGS', 'Bâtiments');
define('INFRASTRUCTURE', 'Infrastructure');
define('FORWARD', 'suivant');
define('NEW_FEATURES', 'Nouveautés');
define('NEW_WINDOW', 'nouvelle fenêtre');
define('MANUAL_INTRO', 'Cette aide en jeu vous permet de consulter des informations importantes à tout moment.');
define('MANUAL_NEW_FEATURES_DESC', "Ce sont des nouveautés que vous ne trouverez pas dans la version originale du jeu Travian T3.6. Vous pouvez ici découvrir toutes ces nouveautés en détail.");
define('MANUAL_FAQ', 'FAQ Travian');
define('MANUAL_FAQ_DESC', "Cette aide en jeu ne donne que de brèves informations. Plus d'informations sont disponibles sur le");

// ===== manuel : pages des batiments (PR-A) =====
define('CONSTRUCTION_TIME', "temps de construction");
define('MANUAL_FOR_LEVEL_1', "pour le niveau 1 :");
define('CROP_CONSUMPTION', "Consommation de céréales");
define('NONE', "aucun");
define('MANUAL_DESC_TRAPPER', "Le piégeur protège votre village avec des pièges bien dissimulés. Ainsi, les ennemis imprudents peuvent être emprisonnés et ne pourront plus nuire à votre village.");
define('MANUAL_ONE_TRAP_COSTS', "Un piège coûte");
define('MANUAL_TRAPPER_FREE', "Les troupes ne peuvent pas être libérées par un raid. Lorsque les troupes sont libérées par une attaque normale réussie, 1/3 des pièges sont automatiquement réparés. Si le propriétaire des pièges relâche les captifs, tous les pièges peuvent être réparés.");
define('MANUAL_TRAPPER_GAULS', "Notez que ce bâtiment ne peut être construit que par les Gaulois.");
define('MANUAL_DESC_WOODCUTTER', "Le bûcheron abat des arbres afin de produire du bois. Plus vous améliorez le bûcheron, plus il produit de bois.<br /><br />En construisant une scierie, vous pouvez encore augmenter la production.");
define('MANUAL_DESC_CLAYPIT', "L'argile est extraite des carrières d'argile. Plus le niveau de la carrière est élevé, plus elle produit d'argile.");
define('MANUAL_DESC_IRONMINE', "Ici, les mineurs extraient le précieux fer. En augmentant le niveau de la mine, vous augmentez sa production de fer. En construisant une fonderie de fer, vous pouvez encore augmenter la production.<br /><br />");
define('MANUAL_DESC_CROPLAND', "La nourriture de votre population est produite ici. En augmentant le niveau de la ferme, vous augmentez sa production de céréales.<br /><br />En construisant un moulin et une boulangerie, vous pouvez encore augmenter la production.");
define('MANUAL_DESC_SAWMILL', "Le bois coupé par vos bûcherons est traité ici. Selon son niveau, votre scierie peut augmenter votre production de bois jusqu'à 25 pour cent.");
define('MANUAL_DESC_BRICKYARD', "La briqueterie transforme l'argile en briques. Selon son niveau, votre briqueterie peut augmenter votre production d'argile jusqu'à 25 pour cent.");
define('MANUAL_DESC_IRONFOUNDRY', "La fonderie de fer fait fondre le fer. Selon son niveau, votre fonderie peut augmenter votre production de fer jusqu'à 25 pour cent.");
define('MANUAL_DESC_GRAINMILL', "Le moulin transforme le grain en farine. Selon son niveau, votre moulin peut augmenter votre production de céréales jusqu'à 25 pour cent.");
define('MANUAL_DESC_BAKERY', "La boulangerie transforme la farine en pain. Associée au moulin, l'augmentation de la production de céréales peut atteindre 50 pour cent au total.");
define('MANUAL_DESC_WAREHOUSE', "Les ressources bois, argile et fer sont stockées dans l'entrepôt. En augmentant son niveau, vous augmentez la capacité de votre entrepôt.");
define('MANUAL_DESC_GRANARY', "Les céréales produites par vos fermes sont stockées dans le grenier. En augmentant son niveau, vous augmentez la capacité du grenier.");
define('MANUAL_DESC_BLACKSMITH', "Les armes de vos guerriers sont améliorées dans les fourneaux du forgeron. En augmentant son niveau, vous pouvez commander la fabrication d'armes encore meilleures.");
define('MANUAL_DESC_ARMOURY', "L'armure de vos guerriers est améliorée dans les fourneaux de l'armurerie. En augmentant son niveau, vous pouvez commander la fabrication d'armures encore meilleures.");
define('MANUAL_DESC_MAINBUILDING', "Les maîtres bâtisseurs du village vivent dans le bâtiment principal. Plus son niveau est élevé, plus vos maîtres bâtisseurs achèvent rapidement la construction de nouveaux bâtiments.");
define('MANUAL_DESC_RALLYPOINT', "Les troupes de votre village se rassemblent ici. D'ici, vous pouvez les envoyer conquérir, piller ou renforcer d'autres villages.<br /><br />Le point de ralliement ne peut être construit que sur la prairie verte située sous votre bâtiment principal, à droite.");
define('MANUAL_DESC_MARKETPLACE', "Au marché, vous pouvez échanger des ressources avec d'autres joueurs. Plus son niveau est élevé, plus de ressources peuvent être transportées en même temps.");
define('MANUAL_DESC_EMBASSY', "L'ambassade est un lieu pour les diplomates. Au niveau 1, vous pouvez rejoindre une alliance ; après l'avoir améliorée au niveau 3, vous pouvez même en fonder une.<br /><br />Le nombre maximal de membres d'une alliance est égal à 3 fois le niveau de l'ambassade la plus élevée de cette alliance. Ainsi, avec une ambassade de niveau 20, jusqu'à 60 joueurs peuvent faire partie de l'alliance.");
define('MANUAL_DESC_BARRACKS', "L'infanterie peut être entraînée dans la caserne. Plus son niveau est élevé, plus les troupes sont entraînées rapidement.");
define('MANUAL_DESC_STABLE', "La cavalerie peut être entraînée dans l'écurie. Plus son niveau est élevé, plus les troupes sont entraînées rapidement.");
define('MANUAL_DESC_WORKSHOP', "Les engins de siège comme les catapultes et les béliers peuvent être construits dans l'atelier. Plus son niveau est élevé, plus les unités sont produites rapidement.");
define('MANUAL_DESC_ACADEMY', "De nouveaux types d'unités peuvent être développés à l'académie. En augmentant son niveau, vous pouvez ordonner la recherche de meilleures unités.");
define('MANUAL_DESC_CRANNY', "La cachette sert à dissimuler au moins une partie de vos ressources lorsque le village est attaqué. Ces ressources ne peuvent pas être volées.<br /><br />Au niveau 1, la cachette contient 100 unités de chaque ressource. Les cachettes gauloises sont deux fois plus grandes que les autres.<br /><br />CONSEILS<br />En T3, la cachette est efficace à 66% contre les Teutons.<br />En T3.5, la cachette est efficace à 80% contre les Teutons.");
define('MANUAL_DESC_TOWNHALL', "Dans l'hôtel de ville, vous pouvez organiser de fastueuses célébrations. Une telle célébration augmente vos points de culture.<br /><br />Les points de culture sont nécessaires pour fonder ou conquérir de nouveaux villages. Chaque bâtiment produit des points de culture et plus son niveau est élevé, plus il en produit. Avec les célébrations, vous pouvez augmenter cette production pendant un court moment.");
define('MANUAL_DESC_RESIDENCE', "La résidence est un petit palais où le roi ou la reine séjourne lorsqu'il ou elle visite le village. La résidence protège le village contre les ennemis qui veulent le conquérir.");
define('MANUAL_DESC_PALACE', "Le roi ou la reine de l'empire vit dans le palais. Il ne peut exister qu'un seul palais dans votre royaume à la fois. Vous avez besoin d'un palais pour proclamer un village comme votre capitale.<br /><br />La capitale ne peut pas être conquise. De plus, la capitale est le seul endroit où les champs de ressources peuvent être améliorés au-delà du niveau 10, et le seul endroit où la loge du tailleur de pierre peut être construite.");
define('MANUAL_DESC_TREASURY', "Les richesses de votre empire sont conservées dans le trésor. Un trésor ne peut contenir qu'un seul artéfact.<br /><br />Il vous faut un trésor de niveau 10 pour un petit artéfact, ou de niveau 20 pour un grand.");
define('MANUAL_DESC_TRADEOFFICE', "Au comptoir commercial, les chariots des marchands sont améliorés et équipés de chevaux puissants. Plus son niveau est élevé, plus vos marchands peuvent transporter de marchandises.");
define('MANUAL_DESC_GREATBARRACKS', "La grande caserne vous permet de produire plus d'unités en même temps, mais elles coûtent trois fois le montant initial.<br /><br />Elle ne peut pas être construite dans la capitale.");
define('MANUAL_DESC_GREATSTABLE', "La grande écurie vous permet de produire plus d'unités en même temps, mais elles coûtent trois fois le montant initial.<br /><br />Elle ne peut pas être construite dans la capitale.");
define('MANUAL_DESC_STONEMASON', "La loge du tailleur de pierre est experte dans la taille de la pierre. Plus le bâtiment est amélioré, plus la stabilité des bâtiments du village est élevée.<br /><br />Elle ne peut être construite que dans la capitale.");
define('MANUAL_DESC_BREWERY', "Un savoureux hydromel est brassé dans la brasserie, puis bu par les soldats lors des célébrations.<br /><br />Ces boissons rendent vos soldats plus courageux et plus forts au combat (1% par niveau). Malheureusement, le pouvoir de persuasion des chefs est réduit et les catapultes ne font que des tirs aléatoires.<br /><br />Elle ne peut être construite que par les Teutons et uniquement dans leur capitale. Elle affecte tout l'empire.");
define('MANUAL_DESC_HEROSMANSION', "Dans la demeure du héros, vous pouvez entraîner un héros. Pour cela, il vous faut un soldat ordinaire qui deviendra le héros ; vous avez donc besoin d'une caserne ou d'une écurie.<br /><br />Lorsque le bâtiment atteint les niveaux 10, 15 et 20, vous pouvez annexer 1, 2 et 3 oasis inoccupées avec votre héros. Selon l'oasis, vous obtiendrez une augmentation de production pour une certaine ressource (voire deux ressources pour certaines oasis).");
define('MANUAL_DESC_GREATWAREHOUSE', "Les ressources bois, argile et fer sont stockées dans votre entrepôt. Le grand entrepôt vous offre plus de place et garde vos ressources plus au sec et plus en sécurité que l'entrepôt normal.<br /><br />Ce bâtiment ne peut être construit que dans les anciens villages natars ou avec des artéfacts natars spéciaux.");
define('MANUAL_DESC_GREATGRANARY', "Les céréales produites par vos fermes sont stockées dans le grenier. Le grand grenier vous offre plus de place et garde vos céréales plus au sec et plus en sécurité que le grenier normal.<br /><br />Ce bâtiment ne peut être construit que dans les anciens villages natars ou avec des artéfacts natars spéciaux.");
define('MANUAL_DESC_WONDER', "La merveille du monde représente la fierté de la création. Seuls les plus puissants et les plus riches sont capables de bâtir un tel chef-d'œuvre et de le défendre contre des ennemis envieux.<br /><br />Les merveilles du monde ne peuvent être érigées que dans les anciens villages natars. Un plan de construction est également nécessaire. À partir du niveau 50, un plan supplémentaire est requis. Celui-ci doit appartenir à un autre joueur de la même alliance.");
define('MANUAL_DESC_HORSEDRINKING', "L'abreuvoir veille au bien-être de vos chevaux et augmente donc aussi la vitesse de leur entraînement.<br /><br />L'abreuvoir réduit de un la consommation de céréales des soldats suivants : Equites Legati à partir du niveau 10, Equites Imperatoris à partir du niveau 15 et Equites Caesaris à partir du niveau 20.<br /><br />L'abreuvoir ne peut être construit que par les Romains.");
define('MANUAL_DESC_GREATWORKSHOP', "Dans le grand atelier, des engins de siège comme les catapultes et les béliers peuvent être construits, mais à un coût triple de celui d'une unité standard. Plus son niveau est élevé, plus les unités sont produites rapidement.<br /><br />Il ne peut pas être construit dans la capitale.");

define('MANUAL_ATTACK_VALUE', "valeur d'attaque");
define('MANUAL_DEF_INFANTRY', "défense contre l'infanterie");
define('MANUAL_DEF_CAVALRY', "défense contre la cavalerie");
define('MANUAL_VELOCITY', "Vitesse");
define('MANUAL_FIELDS_HOUR', "cases/heure");
define('MANUAL_CAN_CARRY', "Capacité de transport");
define('MANUAL_TRAINING_DURATION', "Durée d'entraînement");
define('MANUAL_NPC_NATARS', "Cette description est fournie à titre indicatif uniquement. Les Natars sont une tribu purement PNJ et ne peuvent donc pas être incarnés.");
define('MANUAL_NPC_NATURE', "Cette description est fournie à titre indicatif uniquement. La Nature est une tribu purement PNJ et ne peut donc pas être incarnée.");
define('MANUAL_UDESC_ANIMAL_EXP', "L'expérience qu'un héros gagne en tuant un animal dépend de l'entretien que cet animal nécessitait. Ainsi, %s ne rapporte que %d point(s) d'expérience.");
define('MANUAL_UDESC_1', "Le Légionnaire est l'infanterie simple et polyvalente de l'Empire romain. Grâce à son entraînement complet, il est efficace aussi bien en défense qu'en attaque. Cependant, le Légionnaire n'atteindra jamais le niveau des troupes plus spécialisées.");
define('MANUAL_UDESC_2', "Les Prétoriens sont la garde de l'empereur et le défendent au péril de leur vie. Comme leur entraînement est spécialisé dans la défense, ce sont de très faibles attaquants.");
define('MANUAL_UDESC_3', "L'Imperian est l'attaquant ultime de l'Empire romain. Il est rapide, puissant et le cauchemar de tous les défenseurs. Cependant, son entraînement est coûteux et long.");
define('MANUAL_UDESC_4', "Les Equites Legati sont les troupes de reconnaissance romaines. Ils sont assez rapides et peuvent espionner les villages ennemis afin de voir les ressources et les troupes.<br /><br />S'il n'y a aucun Éclaireur, Equites Legati ou Pisteur dans le village espionné, l'espionnage passe inaperçu.");
define('MANUAL_UDESC_5', "Les Equites Imperatoris sont la cavalerie standard de l'armée romaine et sont très bien armés. Ce ne sont pas les troupes les plus rapides, mais ils sont un cauchemar pour les ennemis mal préparés. Gardez toutefois toujours à l'esprit que nourrir le cheval et le cavalier coûte cher.");
define('MANUAL_UDESC_6', "Les Equites Caesaris sont la cavalerie lourde de Rome. Ils sont très bien blindés et infligent d'énormes dégâts, mais toute cette armure et cet armement ont un prix. Ils sont lents, transportent moins de ressources et leur entretien est coûteux.");
define('MANUAL_UDESC_7', "Le Bélier est une lourde arme de soutien pour votre infanterie et votre cavalerie. Sa tâche est de détruire les murs ennemis et d'augmenter ainsi les chances de vos troupes de franchir les fortifications adverses.");
define('MANUAL_UDESC_8', "La Catapulte est une excellente arme à longue portée ; elle sert à détruire les champs et les bâtiments des villages ennemis. Cependant, sans troupes d'escorte, elle est presque sans défense, alors n'oubliez pas d'envoyer quelques troupes avec elle.<br /><br />Un point de ralliement de haut niveau rend vos catapultes plus précises et vous permet de cibler des bâtiments ennemis supplémentaires. Avec un point de ralliement de niveau 10, tous les bâtiments peuvent être visés, à l'exception de la cachette, du tailleur de pierre et du trappeur.<br />ASTUCE : les catapultes tirant au hasard PEUVENT toucher la cachette, les trappeurs ou le tailleur de pierre.");
define('MANUAL_UDESC_9', "Le Sénateur est le chef choisi par la tribu. C'est un bon orateur qui sait convaincre les autres. Il est capable de persuader d'autres villages de combattre aux côtés de l'empire.<br /><br />Chaque fois que le Sénateur s'adresse aux habitants d'un village, la valeur de loyauté de l'ennemi diminue, jusqu'à ce que le village soit à vous.");
define('MANUAL_UDESC_10', "Les Colons sont des citoyens courageux et audacieux qui, après un long entraînement, quittent le village pour en fonder un nouveau en votre honneur.<br /><br />Comme le voyage et la fondation du nouveau village sont très difficiles, trois colons doivent rester ensemble. Il leur faut une base de 750 unités par ressource.");
define('MANUAL_UDESC_11', "Les Massues sont l'unité la moins chère de Travian. Ils sont entraînés rapidement et possèdent des capacités d'attaque moyennes, mais leur armure n'est pas la meilleure. Les Massues sont presque sans défense face à la cavalerie et se font piétiner avec facilité.");
define('MANUAL_UDESC_12', "Dans l'armée teutonne, la tâche du Lancier est la défense. Il est particulièrement efficace contre la cavalerie grâce à la longueur de son arme.<br /><br />Cependant, ne l'utilisez pas comme unité d'attaque, car ses capacités offensives sont très faibles.");
define('MANUAL_UDESC_13', "C'est l'unité d'infanterie la plus puissante des Teutons. Il est fort à la fois en attaque et en défense, mais il est plus lent et plus coûteux que les autres unités.");
define('MANUAL_UDESC_14', "L'Éclaireur se déplace loin devant les troupes teutonnes afin de se faire une idée de la force de l'ennemi et de ses villages. Il se déplace à pied, ce qui le rend plus lent que ses homologues romain ou gaulois. Il espionne les unités, les ressources et les fortifications ennemies.<br /><br />S'il n'y a aucun Éclaireur, Pisteur ou Equites Legati ennemi dans le village espionné, l'espionnage passe inaperçu.");
define('MANUAL_UDESC_15', "Équipés d'une lourde armure, les Paladins sont une excellente unité défensive. L'infanterie aura particulièrement du mal à percer leur bouclier.<br /><br />Malheureusement, leurs capacités offensives sont assez faibles et leur vitesse, comparée à celle des autres unités de cavalerie, est en dessous de la moyenne. Leur entraînement est très long et plutôt coûteux.");
define('MANUAL_UDESC_16', "Le Chevalier teutonique est un guerrier redoutable qui sème la peur et le désespoir parmi ses ennemis. En défense, il excelle contre la cavalerie adverse. Cependant, le coût de son entraînement et de son entretien est extraordinaire.");
define('MANUAL_UDESC_17', "Le Bélier est une lourde arme de soutien pour votre infanterie et votre cavalerie. Sa tâche est de détruire les murs ennemis et d'augmenter ainsi les chances de vos troupes de franchir les fortifications adverses.");
define('MANUAL_UDESC_18', "La Catapulte est une excellente arme à longue portée ; elle sert à détruire les champs et les bâtiments des villages ennemis. Cependant, sans troupes d'escorte, elle est presque sans défense, alors n'oubliez pas d'envoyer quelques troupes avec elle.<br /><br />Un point de ralliement de haut niveau rend vos catapultes plus précises et vous permet de cibler des bâtiments ennemis supplémentaires. Avec un point de ralliement de niveau 10, tous les bâtiments peuvent être visés, à l'exception de la cachette, des tailleurs de pierre et du trappeur.<br />ASTUCE : les catapultes tirant au hasard PEUVENT toucher la cachette, les trappeurs ou les tailleurs de pierre.");
define('MANUAL_UDESC_19', "C'est en leur sein que les Teutons choisissent leur Chef. Pour être choisi, le courage et la stratégie ne suffisent pas ; il faut aussi être un orateur redoutable, car l'objectif premier du Chef est de convaincre la population des villages étrangers de rejoindre sa tribu.<br /><br />Plus le Chef s'adresse souvent à la population d'un village, plus la loyauté de ce village diminue, jusqu'à ce qu'il rejoigne finalement la tribu du Chef.");
define('MANUAL_UDESC_21', "Étant de l'infanterie, la Phalange est peu coûteuse et rapide à produire.<br /><br />Bien que sa puissance d'attaque soit faible, en défense elle est assez solide aussi bien contre l'infanterie que contre la cavalerie.");
define('MANUAL_UDESC_22', "Les Épéistes sont plus coûteux que la Phalange, mais ce sont des unités d'attaque.<br /><br />En défense, ils sont assez faibles, en particulier contre la cavalerie.");
define('MANUAL_UDESC_23', "Le Pisteur est l'unité de reconnaissance des Gaulois. Ils sont très rapides et peuvent s'approcher prudemment des unités, ressources ou bâtiments ennemis pour les espionner.<br /><br />S'il n'y a aucun Éclaireur, Equites Legati ou Pisteur dans le village espionné, l'espionnage passe inaperçu.");
define('MANUAL_UDESC_24', "Les Foudres de Teutatès sont des unités de cavalerie très rapides et puissantes. Elles peuvent transporter une grande quantité de ressources, ce qui en fait aussi d'excellents pillards.<br /><br />En défense, leurs capacités sont au mieux moyennes.");
define('MANUAL_UDESC_25', "Cette unité de cavalerie moyenne excelle en défense. Le rôle principal du Druide cavalier est de défendre contre l'infanterie ennemie. Son coût et son entretien sont relativement élevés.");
define('MANUAL_UDESC_26', "Les Héduens sont l'arme ultime des Gaulois pour attaquer et se défendre contre la cavalerie. Peu d'unités les égalent sur ces points.<br /><br />Cependant, leur entraînement et leur équipement sont eux aussi très coûteux. Ils consomment 3 unités de céréales par heure, vous devez donc bien réfléchir s'ils en valent la peine.");
define('MANUAL_UDESC_28', "Le Trébuchet est une excellente arme à longue portée ; il sert à détruire les champs et les bâtiments des villages ennemis. Cependant, sans troupes d'escorte, il est presque sans défense, alors n'oubliez pas d'envoyer quelques troupes avec lui.<br /><br />Un point de ralliement de haut niveau rend vos catapultes plus précises et vous permet de cibler des bâtiments ennemis supplémentaires. Avec un point de ralliement de niveau 10, tous les bâtiments peuvent être visés, à l'exception de la cachette, des tailleurs de pierre et du trappeur.<br />ASTUCE : le Trébuchet tirant au hasard PEUT toucher la cachette, les trappeurs ou les tailleurs de pierre.");
define('MANUAL_UDESC_29', "Chaque tribu possède un combattant ancien et expérimenté dont la présence et les discours sont capables de convaincre la population des villages ennemis de rejoindre sa tribu.<br /><br />Plus le Chef de clan parle devant les murs d'un village ennemi, plus sa loyauté diminue, jusqu'à ce qu'il rejoigne la tribu du Chef de clan.");
define('MANUAL_UDESC_31', "Les rats sont peu coûteux et se reproduisent très vite, mais ne peuvent pas transporter grand-chose.<br /><br />C'est probablement la plus économique des unités de la nature, et la plus laide.");
define('MANUAL_UDESC_44', "Les Natars utilisent des nuées d'oiseaux pour recueillir des renseignements sur leurs ennemis. Grâce à l'avantage de l'observation aérienne, il est presque impossible d'arrêter les escadrons d'éclaireurs natariens ; en revanche, même un villageois simple d'esprit peut facilement remarquer ces nuées criardes et emplumées.");
define('MANUAL_UDESC_41', "Leurs longues piques pointues constituent la principale ligne de défense de toute bataille. Les Piquiers natariens sont des guerriers hardis et audacieux qui usent de leur dextérité pour abattre rapidement les cavaliers ennemis et les achever.");
define('MANUAL_UDESC_42', "Les excroissances en forme d'épines sur leurs casques, leurs brassards et les épaulières de leur armure donnent leur nom aux Guerriers épineux. Les hommes qui combattent pour les Natars en tant que Guerriers épineux sont tenaces et bien entraînés, offrant une bataille sanglante à quiconque est assez insensé pour les attaquer.");
define('MANUAL_UDESC_43', "Adorés par leur peuple et craints par leurs ennemis, les Gardes combattent sans monture mais figurent néanmoins parmi les soldats les plus précieux de l'armée natarienne, grâce à leur polyvalence. Considérés comme des combattants bien entraînés, ils ne laissent à leurs ennemis presque aucune chance de l'emporter. Grâce à leur lourde armure, ils peuvent aussi servir de troupes de défense solides et fiables.");
define('MANUAL_UDESC_45', "Il ne flotte qu'une odeur de mort et de putréfaction lorsque les Cavaliers à la hache sellent leurs montures et se préparent à partir en guerre. Avec autant d'adresse qu'un paysan maniant sa faux pour moissonner, le Cavalier à la hache fait tournoyer sa puissante lame. Un seul coup suffit généralement à décapiter un adversaire et à faire hurler d'effroi les témoins.");
define('MANUAL_UDESC_46', "Seuls les guerriers les plus habiles et les plus forts des Natars survivent à l'entraînement permettant de devenir Chevalier natarien. Les voir combattre inspire une crainte respectueuse et montre ce qu'est la véritable guerre. Ils manient leurs lames comme si elles ne faisaient qu'un avec leurs bras et leurs mains, et utilisent leurs boucliers comme un prolongement naturel de leur corps. Même les chevaux qu'ils montent sont élevés et dressés spécialement — aucun cheval ordinaire ne pourrait porter l'armure que portent les montures des chevaliers, et encore moins le chevalier lui-même, tout en étant capable d'aller au combat. Les murmures de leur gloire ont atteint jusqu'aux royaumes les plus lointains, répandant peur et effroi.");
define('MANUAL_UDESC_47', "Aucune autre tribu que les Natars ne sait utiliser ces créatures impressionnantes à ses fins. Ni un mur ni une palissade ne peuvent résister aux assauts de l'Éléphant de guerre. Une machine à tuer ambulante, qui piétine tout ce qui tente de s'opposer à elle ou de se mettre en travers de son chemin.");
define('MANUAL_UDESC_48', "Même en tant qu'ingénieurs, les Natars ont connu un grand succès. Ils ont créé des machines de guerre bien avant tous les autres et les ont depuis perfectionnées en tout point. La Baliste, une énorme arme semblable à une arbalète, projette ses traits avec une telle force qu'aucun mur ni bouclier ne peut les dévier. Lorsque les ingénieurs la démontent pour la déplacer vers le champ de bataille suivant, il ne reste généralement que des ruines là où les projectiles ont frappé.");
define('MANUAL_UDESC_49', "Un mélange de pure peur, d'admiration et de crainte révérencielle anime les villageois lorsque l'Empereur natarien s'adresse à eux. Cette figure imposante et richement parée est pleinement consciente de l'effet qu'elle produit sur les autres et sait comment soumettre un village entier d'une seule harangue.");
define('MANUAL_UDESC_50', "Compagnons audacieux et maîtres bâtisseurs, animés par l'envie d'agir et connaissant le moindre secret de la culture de la terre, de la construction de Palais et de la fortification des villages, les Colons natariens partent par groupes de trois pour revendiquer des terres au nom de leurs seigneurs natariens.");

// ===== manual: new-features pages (PR-C) =====
define('MANUAL_NF_ENABLED', "Activé");
define('MANUAL_NF_DISABLED', "Désactivé");
define('MANUAL_NF_T_11', "Afficher l'oasis dans le profil");
define('MANUAL_NF_T_12', "Message d'invitation d'alliance");
define('MANUAL_NF_T_13', "Nouvelles mécaniques d'alliance et d'ambassade");
define('MANUAL_NF_T_14', "Message de nouveau message sur le forum");
define('MANUAL_NF_T_15', "Images des tribus dans le profil");
define('MANUAL_NF_T_16', "Images des MH dans le profil");
define('MANUAL_NF_T_17', "Afficher l'artefact dans le profil");
define('MANUAL_NF_T_18', "Afficher la Merveille du monde dans le profil");
define('MANUAL_NF_T_20', "Cibles des catapultes");
define('MANUAL_NF_T_21', "Manuel sur la Nature et les Natars");
define('MANUAL_NF_T_22', "Emplacement des liens directs");
define('MANUAL_NF_T_23', "Médaille Joueur Vétéran");
define('MANUAL_NF_T_24', "Médaille Joueur Vétéran 5 ans");
define('MANUAL_NF_T_25', "Médaille Joueur Vétéran 10 ans");
define('MANUAL_NF_T_26', "Médailles spéciales");
define('MANUAL_NF_D_11', "Si une oasis conquise se trouve dans le village, elle sera affichée dans le profil du joueur en face du village correspondant, avec le type de ressource approprié et un bonus de production. Cette fonction a été présentée dans Travian T4.");
define('MANUAL_NF_D_12', "Si une invitation à rejoindre l'alliance est envoyée à un joueur, celui-ci en sera informé par un message dans le jeu.");
define('MANUAL_NF_D_13', "<h2>Introduction</h2><br> Les mécaniques de l'Ambassade et de l'Alliance m'ont toujours semblé un peu comme de la triche. En particulier parce que le bâtiment de l'Ambassade possède une « capacité » donnée, ce qui signifie que seulement 3/6/9/12/... et jusqu'à 60 membres pouvaient faire partie de l'alliance, selon le niveau de votre Ambassade. <br><br> Tout cela est bien beau, mais une fois que vous aviez une Ambassade de niveau 20 et que vous atteigniez 60 membres d'alliance, vous étiez libre de démolir entièrement le bâtiment sans que rien ne se passe. Vous ne pouviez pas changer d'alliance, mais c'était à peu près tout. La propriété de capacité de l'Ambassade ne s'appliquait plus. Si elle s'appliquait, vous ne pourriez même pas la démolir d'un seul niveau jusqu'à 19 — car avec 60 membres au complet, l'Ambassade ne pourrait plus les contenir au niveau 19. <br><br> J'ai donc décidé de pimenter un peu le jeu, en faisant de l'Ambassade une pièce d'échecs un peu plus visible sur l'échiquier. <br><br> <h2>Nouvelles mécaniques</h2><br> Afin de rendre les choses intéressantes, j'ai développé tout un nouvel ensemble de règles pour la démolition et la destruction au combat de l'Ambassade. C'est un peu compliqué mais cela reflète en réalité parfaitement la propriété de « capacité » de l'alliance. <br><br> Le principal changement est que les joueurs ne peuvent pas vraiment démolir leur Ambassade sans subir l'effet secondaire d'être puni une fois qu'elle descend trop bas. Pour un membre d'alliance, cela signifie que son Ambassade ne doit jamais descendre en dessous du niveau 1. Si c'est le cas, il est averti puis exclu de son alliance. <br><br> De même, pour les fondateurs d'alliance, cela représente un défi encore plus grand, car ce sont eux qui doivent veiller au bon fonctionnement de leur alliance. Pour eux, la démolition d'une Ambassade ne sera pas autorisée en dessous d'un niveau pouvant encore contenir le nombre actuel de membres de l'alliance. <br><br> Dans la situation particulière où d'autres joueurs/alliances attaquent réellement le village du fondateur où se trouve son Ambassade, et ciblent ensuite cette Ambassade avec leurs catapultes et leurs béliers — cette situation peut causer beaucoup d'ennuis. S'il n'y a pas d'autres Ambassades dans les villages d'autres fondateurs à un niveau suffisant pour contenir tous les membres de l'alliance, l'alliance pourrait être dispersée. La seule exception serait qu'un autre membre de l'alliance possède une Ambassade suffisamment développée — auquel cas ce membre sera automatiquement élu à un poste de direction et sauvera l'alliance. Si aucun joueur de ce type n'est trouvé, l'alliance sera entièrement dispersée. <br><br> <h2>Informations détaillées</h2><br> Pour des informations plus visuelles et plus approfondies sur le fonctionnement de ce nouveau système, vous pouvez consulter cette <a href=\"https://docs.google.com/presentation/d/1KN1qVAlxVj7aAN6F9QkRai1oliajfxKPIaJ4MSodUac/edit#slide=id.p\" target=\"_blank\">présentation Google</a>.");
define('MANUAL_NF_D_14', "Si le joueur laisse au moins un message dans un fil de discussion du forum, il recevra des messages dans le jeu lui indiquant qu'une autre personne a laissé un nouveau message dans le même fil (c'est-à-dire qu'il y est techniquement « abonné »).");
define('MANUAL_NF_D_15', "Grâce à cette innovation, tout joueur peut ajouter à la description de son profil une image de sa tribu avec une petite description (Romains, Teutons, Gaulois).");
define('MANUAL_NF_D_16', "En fait, pour les joueurs, cette fonction est inutile, car elle est destinée uniquement aux Administrateurs et aux Multihunters. Grâce à elle, les Administrateurs et les Multihunters pourront ajouter à la description de leur profil diverses images intéressantes accompagnées de descriptions.");
define('MANUAL_NF_D_17', "Si un artefact se trouve dans l'un des villages, il sera affiché dans le profil du joueur en face du village correspondant dans lequel il se trouve. Cette fonction a été présentée dans Travian T4.");
define('MANUAL_NF_D_18', "Si le village dispose d'un emplacement pour la construction de la Merveille du monde, celui-ci sera affiché dans le profil en face du village correspondant. Cette fonction a été présentée dans Travian T4.");
define('MANUAL_NF_D_19', "Le mode vacances vous permet de protéger votre empire de toute action hostile des autres joueurs pendant votre longue absence. Certes, certaines conditions s'appliquent et entraîneront un retard dans le développement de votre empire. Cette fonction a été présentée dans Travian T4.");
define('MANUAL_NF_D_20', "Si vous envoyez les catapultes lors d'une attaque normale, vous pouvez voir au point de ralliement quelles cibles vous avez définies pour l'attaque. Cette fonction a été présentée dans Travian T4.");
define('MANUAL_NF_D_21', "À l'aide de ces informations du manuel, vous pouvez trouver une description des forces de la Nature et des Natars.");
define('MANUAL_NF_D_22', "L'emplacement des liens directs change. Dans le Travian T3.6 d'origine, les liens directs sont placés dans le menu de droite, sous la liste des villages, ce qui n'est pas entièrement pratique. Si cette option est activée, les liens directs seront placés dans le menu de gauche, ce qui est bien plus pratique.");
define('MANUAL_NF_D_23', "Médaille décernée aux joueurs utilisant la même adresse e-mail depuis 3 ans ou plus. Peut être ajoutée à la description du profil. Cette fonction a été présentée dans Travian T4.");
define('MANUAL_NF_D_24', "Médaille décernée aux joueurs utilisant la même adresse e-mail depuis 5 ans ou plus. Peut être ajoutée à la description du profil. Cette fonction a été présentée dans Travian T4.");
define('MANUAL_NF_D_25', "Médaille décernée aux joueurs utilisant la même adresse e-mail depuis 10 ans ou plus. Peut être ajoutée à la description du profil. Cette fonction a été présentée dans Travian T4.");
define('MANUAL_NF_D_26', "Médaille décernée aux joueurs utilisant la même adresse e-mail depuis 10 ans ou plus. Peut être ajoutée à la description du profil. Cette fonction a été présentée dans Travian T4.");
?>
