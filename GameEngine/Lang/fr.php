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
tz_def('TRIBE1', 'Romains');
tz_def('TRIBE2', 'Teutons');
tz_def('TRIBE3', 'Gaulois');
tz_def('TRIBE4', 'Nature');
tz_def('TRIBE5', 'Natars');
tz_def('TRIBE6', 'Huns');
tz_def('TRIBE7', 'Egyptiens');
tz_def('TRIBE8', 'Spartiates');
tz_def('TRIBE9', 'Vikings');

tz_def('HOME', 'Accueil');
tz_def('INSTRUCT', 'Instructions');
tz_def('ADMIN_PANEL', 'Panneau d\'administration');
tz_def('MH_PANEL', 'Panneau Multihunter');
tz_def('MASS_MESSAGE', 'Message de masse');
tz_def('LOGOUT', 'Déconnexion');
tz_def('PROFILE', 'Profil');
tz_def('SUPPORT', 'Support');
tz_def('UPDATE_T_10', 'Mettre à jour le Top 10');
tz_def('SYSTEM_MESSAGE', 'Message système');
tz_def('TRAVIAN_PLUS', 'Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></span></span></b>');
tz_def('CONTACT', 'Contactez-nous !');
tz_def('GAME_RULES', 'Règles du jeu');

//MENU
tz_def('REG', 'Inscription');
tz_def('FORUM', 'Forum');
tz_def('CHAT', 'Chat');
tz_def('IMPRINT', 'Mentions légales');
tz_def('MORE_LINKS', 'Plus de Liens');
tz_def('TOUR', 'Visite du jeu');


//ERRORS
tz_def('USRNM_EMPTY', '(Nom d\'utilisateur vide)');
tz_def('USRNM_TAKEN', '(Ce nom est déjà utilisé.)');
tz_def('USRNM_SHORT', '(min. '.USRNM_MIN_LENGTH.' caractères)');
tz_def('USRNM_CHAR', '(Caractères invalides)');
tz_def('PW_EMPTY', '(Mot de passe vide)');
tz_def('PW_SHORT', '(min. '.PW_MIN_LENGTH.' caractères)');
tz_def('PW_INSECURE', '(Mot de passe non sécurisé. Veuillez en choisir un plus robuste.)');
tz_def('EMAIL_EMPTY', '(E-mail vide)');
tz_def('EMAIL_INVALID', '(Adresse e-mail invalide)');
tz_def('EMAIL_TAKEN', '(Cet e-mail est déjà utilisé)');
tz_def('WINNER_ERROR', '<li>Le serveur est terminé ! Plus aucune inscription possible.</li>');
tz_def('TRIBE_EMPTY', '<li>Veuillez choisir une tribu.</li>');
tz_def('AGREE_ERROR', '<li>Vous devez accepter les règles du jeu et les conditions générales pour vous inscrire.</li>');
tz_def('LOGIN_USR_EMPTY', 'Veuillez saisir votre nom.');
tz_def('LOGIN_PASS_EMPTY', 'Veuillez saisir votre mot de passe.');
tz_def('LOGIN_VACATION', 'Le mode vacances est encore activé.');
tz_def('EMAIL_ERROR', 'L\'adresse e-mail ne correspond pas à un e-mail existant');
tz_def('PASS_MISMATCH', 'Les mots de passe ne correspondent pas');
tz_def('ALLI_OWNER', 'Veuillez désigner un chef d\'alliance avant la suppression');
tz_def('SIT_ERROR', 'Co-gestionnaire déjà défini ou joueur introuvable');
tz_def('USR_NT_FOUND', 'Ce nom n\'existe pas.');
tz_def('LOGIN_PW_ERROR', 'Mot de passe incorrect.');
tz_def('WEL_TOPIC', 'Conseils et informations utiles');
tz_def('ATAG_EMPTY', 'Tag vide');
tz_def('ANAME_EMPTY', 'Nom Vide');
tz_def('ATAG_EXIST', 'Ce tag existe déjà');
tz_def('ANAME_EXIST', 'Ce nom existe déjà');
tz_def('ALREADY_ALLY_MEMBER', 'Vous faites déjà partie d\'une alliance');
tz_def('ALLY_TOO_LOW', 'Vous devez avoir une ambassade de niveau 3 ou supérieur');
tz_def('USER_NOT_IN_YOUR_ALLY', "Ce joueur n'est pas dans votre alliance!");
tz_def('CANT_EDIT_YOUR_PERMISSIONS', 'Vous ne pouvez pas modifier vos propres permissions !');
tz_def('CANT_EDIT_LEADER_PERMISSIONS', 'Les permissions du chef d\'alliance ne peuvent pas être modifiées!');
tz_def('CANT_REMOVE_LEADER', 'Vous ne pouvez pas expulser le fondateur de l\'alliance !');
tz_def('FOUNDER_LEAVE_NEW', 'Aucun fondateur n\'a été sélectionné !');
tz_def('FOUNDER_LEAVE_INVALID', 'Fondateur invalide !');
tz_def('NO_PERMISSION', 'Vous n\'avez pas les permissions nécessaires !');
tz_def('NAME_OR_DIPL_EMPTY', 'Nom ou diplomatie vide');
tz_def('ALLY_DOESNT_EXISTS', 'Cette alliance n\'existe pas');
tz_def('CANNOT_INVITE_SAME_ALLY', 'Vous ne pouvez pas inviter votre propre alliance');
tz_def('WRONG_DIPLOMACY', 'Choix invalide');
tz_def('INVITE_ALREADY_SENT', 'Soit vous avez déjà envoyé un pacte à cette alliance, soit elle vous en a envoyé un, soit vous avez déjà un pacte avec elle');
tz_def('INVITE_SENT', 'Invitation envoyée');
tz_def('DECLARED_WAR_ON', 'a déclaré la guerre à');
tz_def('OFFERED_NON_AGGRESION_PACT_TO', 'a proposé un pacte de non-agression à');
tz_def('OFFERED_CONFED_TO', 'a proposé un pacte total à');
tz_def('ALLY_TOO_MUCH_PACTS', 'Soit vous ne pouvez plus proposer de pactes de ce type, soit cette alliance a atteint sa limite pour ce type de pactes');
tz_def('ALLY_PERMISSIONS_UPDATED', 'Permissions mises à jour');
tz_def('ALLY_FORUM_LINK_UPDATED', 'Lien du forum mis à jour');
tz_def('NO_FORUMS_YET', 'Il n\'y a pas encore de forums.');
tz_def('ALLY_USER_KICKED', ' a été expulsé de l\'alliance');
tz_def('NOT_OPENED_YET', 'Le serveur n\'a pas encore démarré.');
tz_def('REGISTER_CLOSED', 'Les inscriptions sont fermées. Vous ne pouvez pas vous inscrire sur ce serveur.');
tz_def('NAME_EMPTY', 'Veuillez saisir un nom');
tz_def('NAME_NO_EXIST', 'Il n\'y a pas de joueur avec ce nom');
tz_def('ID_NO_EXIST', 'Il n\'y a pas de joueur avec cet id ');
tz_def('SAME_NAME', 'Vous ne pouvez pas vous inviter');
tz_def('ALREADY_INVITED', ' a déjà été invité');
tz_def('ALREADY_IN_ALLY', ' fait déjà partie de cette alliance');
tz_def('ALREADY_IN_AN_ALLY', ' fait déjà partie d\'une alliance');
tz_def('NAME_OR_TAG_CHANGED', 'Nom ou tag modifié');
tz_def('VAC_MODE_WRONG_DAYS', 'Vous avez saisi un nombre de jours incorrect');

//COPYRIGHT
tz_def('TRAVIAN_COPYRIGHT', 'TravianZ — Clone de Travian 100 % open source.');

//BUILD.TPL
tz_def('CUR_PROD', 'Production actuelle');
tz_def('NEXT_PROD', 'Production au niveau ');
tz_def('CONSTRUCT_BUILD', 'Construire le bâtiment');

//DORF1
tz_def('LUMBER', 'Bois');
tz_def('CLAY', 'Argile');
tz_def('IRON', 'Fer');
tz_def('CROP', 'Céréales');
tz_def('LEVEL', 'Niveau');
tz_def('CROP_COM', CROP.' consommées');
tz_def('PER_HR', 'par heure');
tz_def('PRODUCTION', 'Production');
tz_def('CAPITAL1', 'Capitale');
tz_def('VILLAGES', 'Villages');
tz_def('ANNOUNCEMENT', 'Annonce');
tz_def('GO2MY_VILLAGE', 'Vers mon village');
tz_def('VILLAGE_CENTER', 'Centre ville');
tz_def('FINISH_GOLD', 'Terminer immédiatement toutes les constructions et les recherches dans ce village pour 2 Or ?');
tz_def('WAITING_LOOP', '(file d\'attente)');
tz_def('CROP_NEGATIVE', 'Votre production de céréales est négative, vous n\'atteindrez jamais la quantité de ressources demandée.');
tz_def('HR', 'h.');
tz_def('HRS', '(h.)');
tz_def('DONE_AT', 'terminé à');
tz_def('CANCEL', 'Annuler');
tz_def('LOYALTY', 'Loyauté');
tz_def('CALCULATED_IN', 'Calculé en');
tz_def('HI', 'Bonjour');
tz_def('P_IN', 'dans');
tz_def('MS', 'ms');
tz_def('SEVER_TIME', 'Heure Serveur :');
tz_def('LOCAL_TIME', 'Heure locale :');
tz_def('REMAINING_GOLD', 'Or restant');

// HEADER && MENU && Messages && Reports
tz_def('REPORTS', 'Rapports');
tz_def('MESSAGES', 'Messages');
tz_def('PLUS_MENU', 'Menu PLUS');
tz_def('LINKS', 'Liens');
tz_def('CANCEL_PROCESS', 'Annuler la tâche');
tz_def('ACCOUNT_DELETING', 'Le compte sera supprimé dans');
tz_def('INBOX', 'Réception');
tz_def('WRITE', 'Ecrire');
tz_def('SENT', 'Envoyé');
tz_def('SEND', 'Envoyer');
tz_def('ARCHIVE', 'Archives');
tz_def('NOTES', 'Notes');
tz_def('SUBJECT', 'Sujet');
tz_def('SENDER', 'Expéditeur');
tz_def('RECIPIENT', 'Destinataire');
tz_def('BACK', 'Retour');
tz_def('NEW', 'Nouveau');
tz_def('UNREAD', 'Non lu');
tz_def('NO_MESS', 'Aucun message disponible');
tz_def('NO_MESS_IN_ARCHIVE', NO_MESS.' dans les archives');
tz_def('NO_MESS_SENT', 'Aucun message envoyé');
tz_def('MESS_FOR_SUP', 'Message pour le Support');
tz_def('MESS_FOR_MH', 'Message pour le Multihunter');
tz_def('SEND_AS_SUP', 'Envoyer en tant que Support');
tz_def('SEND_AS_MH', 'Envoyer en tant que Multihunter');
tz_def('SAVE', 'Sauvegarder');
tz_def('ANSWER', 'Répondre');
tz_def('REPLY', 'Réponse');
tz_def('ADDRESSBOOK', 'Carnet d\'adresses');
tz_def('CLOSE_ADDRESSBOOK', 'Fermer le carnet d\'adresses');
tz_def('ONLINE_S1', 'En ligne');
tz_def('ONLINE_S2', 'Hors ligne');
tz_def('ONLINE_S3', 'Hors ligne depuis 3 jours');
tz_def('ONLINE_S4', 'Hors ligne depuis 7 jours');
tz_def('ONLINE_S5', 'Inactif');
tz_def('WAIT_FOR_CONFIRM', 'En attente de confirmation');
tz_def('CONFIRM', 'Confirmer');
tz_def('WRITE_MESS_WARN', '<b>Attention :</b> vous ne pouvez pas utiliser les balises <b>[message]</b> ou <b>[/message]</b> dans votre message car cela peut causer des problèmes avec le système BBCode.');
tz_def('NO_REPORTS', 'Aucun rapport disponible');
tz_def('ATTACKER', 'Attaquant');
tz_def('NATAR_COUNTERFORCE', 'Contre-offensive Natar');
tz_def('FROM_THE_VILL', 'du village');
tz_def('CASUALTIES', 'Pertes');
tz_def('INFORMATION', 'Information');
// === Battle report strings (issue: i18n of combat reports) ===
tz_def('RC_HERO', 'Héros');
tz_def('RC_CATAPULT', 'Catapulte');
tz_def('RC_TRAP', 'Piège');
tz_def('RC_WALL', 'Muraille');
tz_def('TZ_AT', 'à');
// Catapults
tz_def('RC_DESTROYED', 'détruit');
tz_def('RC_NOT_DAMAGED', "n'a pas été endommagé.");
tz_def('RC_DAMAGED_FROM_TO', 'endommagé du niveau <b>%s</b> au niveau <b>%s</b>.');
tz_def('RC_NO_BUILDINGS', 'Il ne reste aucun bâtiment à détruire');
tz_def('RC_VILLAGE_ALREADY_DESTROYED', 'Village déjà détruit.');
tz_def('RC_VILLAGE_CANT_DESTROY', 'Le village ne peut pas être détruit.');
tz_def('RC_VILLAGE_CANT_BE', 'Le village ne peut pas être');
tz_def('RC_VILLAGE_DESTROYED', 'Le village a été détruit.');
// Rams
tz_def('RC_NO_WALL', "Il n'y a pas de muraille à détruire.");
tz_def('RC_WALL_DESTROYED', 'Muraille <b>détruite</b>.');
tz_def('RC_WALL_NOT_DAMAGED', "La muraille n'a pas été endommagée.");
tz_def('RC_WALL_DAMAGED_FROM_TO', 'Muraille endommagée du niveau <b>%s</b> au niveau <b>%s</b>.');
// Conquest / chief
tz_def('RC_NO_REDUCE_CP_RAID', "Impossible de réduire les points de culture lors d'un raid");
tz_def('RC_NOT_ENOUGH_CP', 'Points de culture insuffisants.');
tz_def('RC_CANT_TAKEOVER', 'Vous ne pouvez pas conquérir ce village.');
tz_def('RC_RESIDENCE_NOT_DESTROYED', "Le Palais/la Résidence n'est pas détruit(e) !");
tz_def('RC_LOYALTY_LOWERED', 'La loyauté a été réduite de <b>%s</b> à <b>%s</b>.');
tz_def('RC_INHABITANTS_JOIN', 'Les habitants du village %s ont décidé de rejoindre votre empire.');
// Hero
tz_def('RC_HERO_NO_KILL', "Votre héros n'avait personne à tuer et ne gagne donc aucun XP.");
tz_def('RC_HERO_GAINED_XP', 'Votre héros a gagné <b>%s</b> XP.');
tz_def('RC_HERO_CONQUERED_OASIS', 'Votre héros a conquis cette oasis');
tz_def('RC_HERO_REDUCED_OASIS_LOYALTY', "Votre héros a réduit la loyauté de l'oasis à %s depuis %s");
tz_def('RC_NO_REDUCE_LOYALTY_RAID', "Impossible de réduire la loyauté lors d'un raid");
tz_def('RC_HERO_CARRYING_ARTIFACT', "Votre héros rapporte l'artefact <b>%s</b> et");
tz_def('RC_HERO_NO_ARTIFACT_RAID', "Votre héros n'a pas pu s'emparer d'un artefact lors d'un raid");
tz_def('RC_HERO_AND_GAINED_XP_BATTLE', 'et a gagné <b>%s</b> XP lors de la bataille.');
tz_def('RC_HERO_NO_XP_BATTLE', 'aucun XP lors de la bataille.');
tz_def('RC_HERO_GAINED_XP_BATTLE', 'a gagné <b>%s</b> XP lors de la bataille.');
tz_def('RC_HERO_BUT_GAINED_XP_BATTLE', 'mais a gagné <b>%s</b> XP lors de la bataille.');
tz_def('RC_HERO_TRAPPED', 'Votre héros a été capturé');
tz_def('RC_HERO_DIED', 'Votre héros est mort');
// Scout report
tz_def('RC_TOTAL_RESOURCES', 'Ressources totales :');
tz_def('RC_RESIDENCE_LEVEL', 'Niveau de la Résidence :');
tz_def('RC_PALACE_LEVEL', 'Niveau du Palais :');
tz_def('RC_WALL_LEVEL', 'Niveau de la muraille :');
tz_def('RC_CRANNY_CAPACITY', 'Capacité totale des cachettes :');
tz_def('RC_NO_INFO', 'Aucune information à afficher');
// Prisoners / traps
tz_def('RC_OF_WHICH_SAVED', 'dont <b>%s</b> ont été sauvés');
tz_def('RC_FREED_FROM_HIS_TROOPS', 'a libéré <b>%s</b> de ses troupes');
tz_def('RC_FREED_FRIENDLY_TROOPS', 'a libéré <b>%s</b> troupes alliées');
tz_def('RC_AND_FRIENDLY_TROOPS', 'et <b>%s</b> troupes alliées');
// Troop return
tz_def('RC_NONE_RETURNED', "Aucun de vos soldats n'est revenu.");
// === End battle report strings ===
// === System / alliance in-game messages (sendMessage), rendered per reader ===
tz_def('MSG_INVITE_ALLIANCE', "Invitation à l'alliance");
tz_def('MSG_FORUM_NEW_TITLE', 'Nouveau message sur le forum');
tz_def('MSG_FORUM_NEW_BODY', "Bonjour !\n\n<a href=\"%s\">%s</a> a publié un nouveau message dans votre sujet commun. Voici un lien qui vous y mènera : <a href=\"%s\">lien du forum</a>\n\nCordialement,\n<i>Robot du serveur :)</i>");
tz_def('MSG_LEFT_ALLIANCE_TITLE', "Vous avez quitté l'alliance");
tz_def('MSG_FORCED_LEAVE_TITLE', "Une attaque vous a forcé à quitter l'alliance");
tz_def('MSG_LEFT_DEMOLITION_BODY', "Bonjour, %s !\n\nNous vous informons que suite à la démolition achevée de votre dernière Ambassade, vous avez désormais quitté votre alliance.\n\nCordialement,\n<i>Robot du serveur :)</i>");
tz_def('MSG_LEFT_ATTACK_BODY', "Bonjour, %s !\n\nNous vous informons que suite à une attaque réussie et à la destruction de votre dernière Ambassade, vous avez été forcé de quitter votre alliance.\n\nPour rétablir votre position dans cette alliance, vous devrez construire une nouvelle Ambassade et demander au chef de vous envoyer une nouvelle invitation.\n\nCordialement,\n<i>Robot du serveur :)</i>");
tz_def('MSG_DISBAND_TITLE', 'Votre alliance a été dissoute');
tz_def('MSG_DISBAND_OWNER_BODY', "Bonjour, %s !\n\nNous vous informons que suite à la démolition achevée de votre dernière Ambassade de niveau 3, et du fait que vous étiez le chef de votre alliance, cette alliance a été dissoute.\n\nPour fonder une nouvelle alliance, veuillez reconstruire une Ambassade de niveau 3 dans l'un de vos villages.\n\nCordialement,\n<i>Robot du serveur :)</i>");
tz_def('MSG_DISBAND_MEMBER_BODY', "Bonjour, %s !\n\nNous vous informons que suite à la démolition de la dernière Ambassade du fondateur de votre alliance en dessous du niveau 3, cette alliance a été dissoute.\n\nVous pouvez désormais accepter des invitations d'autres alliances ou fonder vous-même une nouvelle alliance.\n\nCordialement,\n<i>Robot du serveur :)</i>");
tz_def('MSG_NOW_ALLIANCE_LEADER_TITLE', "Vous êtes désormais le chef de l'alliance");
tz_def('MSG_NOW_LEADER_TITLE', 'Vous êtes désormais le chef de votre alliance');
tz_def('MSG_PROMOTE_BODY', "Bonjour, %s !\n\nNous vous informons qu'une attaque réussie a visé le joueur <a href=\"spieler.php?uid=%s\">%s</a>, endommageant son Ambassade au point qu'il ne peut plus assumer la direction de votre alliance.\n\nComme votre Ambassade est d'un niveau suffisant, vous avez été automatiquement élu nouveau chef de votre alliance, avec tous les devoirs et responsabilités qui en découlent.\n\nCordialement,\n<i>Robot du serveur :)</i>");
tz_def('MSG_DISPERSE_TITLE', 'Votre alliance a été dispersée');
tz_def('MSG_DISPERSE_OWNER_BODY_MANY', "Bonjour, %s !\n\nNous vous informons que suite à une attaque réussie ayant rabaissé votre dernière Ambassade à un niveau incapable de contenir l'ensemble des %s membres de l'alliance, et parce qu'aucun autre membre ne disposait d'une Ambassade d'un niveau suffisant pour reprendre la direction, votre alliance a été dispersée.\n\nCordialement,\n<i>Robot du serveur :)</i>");
tz_def('MSG_DISPERSE_OWNER_BODY_FEW', "Bonjour, %s !\n\nNous vous informons que suite à une attaque réussie ayant rabaissé votre dernière Ambassade à un niveau inférieur à 3 - requis pour fonder et maintenir votre propre alliance - votre alliance a été dispersée.\n\nCordialement,\n<i>Robot du serveur :)</i>");
tz_def('MSG_DISPERSE_MEMBER_BODY', "Bonjour, %s !\n\nNous vous informons que suite à une attaque réussie d'un autre joueur sur l'Ambassade du chef de votre alliance, qui l'a rabaissée sous le seuil permettant de contenir l'ensemble des %s membres, et parce qu'aucun autre membre ne disposait d'une Ambassade d'un niveau suffisant pour reprendre la direction, votre alliance a été dispersée.\n\nCordialement,\n<i>Robot du serveur :)</i>");
tz_def('MSG_NEW_LEADER_TITLE', 'Votre alliance a un nouveau chef');
tz_def('MSG_NEWLEADER_OWNER_BODY', "Bonjour, %s !\n\nNous vous informons que suite à une attaque réussie ayant rabaissé votre dernière Ambassade à un niveau incapable de contenir l'ensemble des %s membres de l'alliance, un autre membre répondant à ces critères a été automatiquement élu nouveau chef de l'alliance.\n\nDe plus - en raison de la destruction de l'Ambassade - vous avez été expulsé de votre alliance.\n\nVeuillez rétablir le lien avec votre alliance en construisant une nouvelle Ambassade et en contactant <a href=\"spieler.php?uid=%s\">le nouveau chef</a> pour obtenir une invitation.\n\nCordialement,\n<i>Robot du serveur :)</i>");
tz_def('MSG_NEWLEADER_MEMBER_BODY', "Bonjour, %s !\n\nNous vous informons que suite à une attaque réussie d'un autre joueur sur l'Ambassade du chef de votre alliance, <a href=\"spieler.php?uid=%s\">un autre membre de l'alliance</a> disposant d'une capacité d'Ambassade suffisante a été automatiquement élu nouveau chef de l'alliance.\n\nCordialement,\n<i>Robot du serveur :)</i>");
tz_def('MSG_FORCED_LEAVE_BODY', "Bonjour, %s !\n\nNous vous informons que suite à une attaque réussie et à la destruction de votre dernière Ambassade, vous avez été forcé de quitter votre alliance.\n\nPour rétablir votre position dans cette alliance, vous devrez construire une nouvelle Ambassade et demander au <a href=\"spieler.php?uid=%s\">chef nouvellement élu</a> de vous envoyer une nouvelle invitation.\n\nCordialement,\n<i>Robot du serveur :)</i>");
tz_def('MSG_INVITE_BODY', "Bonjour, %s !\n\nNous vous informons que vous avez été invité à rejoindre une alliance. Pour accepter cette invitation, veuillez vous rendre à votre Ambassade.\n\nCordialement,\n<i>Robot du serveur :)</i>");
tz_def('MSG_QUIT_REPLACEMENT_BODY', "Bonjour !\n\nNous vous informons que l'ancien chef de votre alliance - %s - a décidé de partir et vous a désigné comme son remplaçant. Vous obtenez désormais l'accès complet, l'administration et les responsabilités de votre alliance.\n\nBonne chance !\n\nCordialement,\n<i>Robot du serveur :)</i>");
// Embassy-destruction status lines, appended to the catapult battle report.
tz_def('MSG_ALLIANCE_DISPERSED_STATUS', "L'alliance de ce joueur a été dispersée.");
tz_def('MSG_FORCED_LEAVE_STATUS', "Le joueur a été forcé de quitter son alliance.");
// Alliance news-feed notices (rendered in Templates/Alliance/news.tpl)
tz_def('MSG_INVITE_NOTICE', "%s a invité %s à rejoindre l'alliance.");
tz_def('MSG_ALLIANCE_FOUNDED', "L'alliance a été fondée par %s.");
tz_def('MSG_NEWS_REJECTED', "%s a refusé l'invitation.");
tz_def('MSG_NEWS_DELETED_INVITE', "%s a supprimé l'invitation de %s.");
tz_def('MSG_NEWS_JOINED', "%s a rejoint l'alliance.");
tz_def('MSG_NEWS_NAME_CHANGED', "%s a changé le nom de l'alliance.");
tz_def('MSG_NEWS_DESC_CHANGED', "%s a changé la description de l'alliance.");
tz_def('MSG_NEWS_PERMS_CHANGED', "%s a modifié les permissions de %s.");
tz_def('MSG_NEWS_EXPELLED', "%s a été expulsé de l'alliance par %s.");
tz_def('MSG_NEWS_QUIT', "%s a quitté l'alliance.");
tz_def('MSG_NEWS_DIPLO_CONFED', "%s a proposé une confédération à %s.");
tz_def('MSG_NEWS_DIPLO_NAP', "%s a proposé un pacte de non-agression à %s.");
tz_def('MSG_NEWS_DIPLO_WAR', "%s a déclaré la guerre à %s.");
tz_def('CARRY', 'Butin');
tz_def('DEFENDER', 'Défenseur');
tz_def('VISITED', 'visité');
tz_def('HIS_TROOPS', ' ses troupes');
tz_def('WISHES_YOU', 'vous souhaite');
tz_def('X_MAS', 'Joyeux Noël');
tz_def('NEW_YEAR', 'Bonne année');
tz_def('EASTER', 'Joyeuses Pâques');
if (!defined('PEACE')) define('PEACE', 'Paix');

tz_def('GOLD', 'Or');
tz_def('GOLD_IMG', '<img src=\"/img/x.gif\" class=\"gold\" alt=\"'.GOLD.'\" title=\"'.GOLD.'\">');

//QUEST
tz_def('Q_CONTINUE', 'Continuez avec la tâche suivante.');
tz_def('Q_REWARD', 'Votre récompense :');
tz_def('Q_BUTN', 'Tâche terminée');
tz_def('Q0', 'Bienvenue à ');
tz_def('Q0_DESC', 'Comme je le vois, vous avez été nommé chef de ce petit village. Je serai votre conseiller pendant les premiers jours et ne quitterai jamais votre côté (droit).');
tz_def('Q0_OPT1', 'Vers la première tâche.');
tz_def('Q0_OPT2', 'Regarder autour de moi seul.');
tz_def('Q0_OPT3', 'Ne pas faire les tâches.');

tz_def('Q1', 'Tâche 1 : Bûcheron');
tz_def('Q1_DESC', 'Quatre forêts verdoyantes entourent votre village. Construisez un bûcheron sur l\'une d\'elles. Le bois est une ressource importante pour notre nouvelle colonie.');
tz_def('Q1_ORDER', 'Ordre :</p>Construisez un bûcheron.');
tz_def('Q1_RESP', 'Oui, de cette façon vous gagnerez plus de bois. Je vous ai donné un petit coup de pouce et terminé l\'ordre instantanément.');
tz_def('Q1_REWARD', 'Bûcheron terminé instantanément.');

tz_def('Q2', 'Tâche 2 : Céréales');
tz_def('Q2_DESC', 'Vos sujets ont faim après avoir travaillé toute la journée. Améliorez un champ de céréales pour améliorer l\'approvisionnement de vos sujets. Revenez ici une fois le bâtiment terminé.');
tz_def('Q2_ORDER', 'Ordre :</p>Améliorez un champ de céréales.');
tz_def('Q2_RESP', 'Très bien. Vos sujets ont à nouveau de quoi manger...');
tz_def('Q2_REWARD', 'Votre récompense :</p>1 jour Travian');

tz_def('Q3', 'Tâche 3 : Le nom de votre village');
tz_def('Q3_DESC', 'Créatif comme vous l\'êtes, vous pouvez donner à votre village le nom qui lui convient.<br><br>Cliquez sur « Profil » dans le menu de gauche puis sélectionnez « Modifier le profil »...');
tz_def('Q3_ORDER', 'Ordre :</p>Changez le nom de votre village pour quelque chose de joli.');
tz_def('Q3_RESP', 'Wow, un beau nom pour votre village. Il aurait pu être le nom de mon village !...');

tz_def('Q4', 'Tâche 4 : Autres joueurs');
tz_def('Q4_DESC', 'Dans '.SERVER_NAME.', vous jouez avec des milliers d\'autres joueurs. Cliquez sur « Statistiques » dans le menu du haut pour chercher votre rang et le saisir ici.');
tz_def('Q4_ORDER', 'Ordre :</p>Cherchez votre rang dans les statistiques et saisissez-le ici.');
tz_def('Q4_BUTN', 'Tâche terminée');
tz_def('Q4_RESP', 'Exactement ! C\'est votre rang.');

tz_def('Q5', 'Tâche 5 : Deux ordres de construction');
tz_def('Q5_DESC', 'Construisez une mine de fer et une carrière d\'argile. Le fer et l\'argile ne sont jamais suffisants.');
tz_def('Q5_ORDER', 'Ordre :</p><ul><li>Améliorez une mine de fer.</li><li>Améliorez une carrière d\'argile.</li></ul>');
tz_def('Q5_RESP', 'Comme vous l\'avez remarqué, les ordres de construction prennent du temps. Le monde de '.SERVER_NAME.' continuera de tourner même si vous êtes hors ligne. Même dans quelques mois, il y aura encore beaucoup de nouvelles choses à découvrir.<br><br>Le mieux est de vérifier votre village de temps en temps et de donner à vos sujets de nouvelles tâches à accomplir.');

tz_def('Q6', 'Tâche 6 : Messages');
tz_def('Q6_DESC', 'Vous pouvez parler avec les autres joueurs grâce au système de messagerie. Je vous ai envoyé un message. Lisez-le puis revenez ici.<br><br>P.-S. N\'oubliez pas : les rapports sont à gauche, les messages à droite.');
tz_def('Q6_ORDER', 'Ordre :</p>Lisez votre nouveau message.');
tz_def('Q6_RESP', 'Vous l\'avez reçu ? Très bien.<br><br>Voici un peu d\'or. Avec l\'or, vous pouvez faire différentes choses, par exemple étendre votre compte dans le menu de gauche.');
tz_def('Q6_RESP1', '-Compte ou augmenter votre production de ressources. Pour cela, cliquez ');
tz_def('Q6_RESP2', 'dans le menu de gauche.');
tz_def('Q6_SUBJECT', 'Message du surveillant');
tz_def('Q6_MESSAGE', 'Sachez qu\'une belle récompense vous attend chez le surveillant.<br><br>Astuce : ce message a été généré automatiquement. Aucune réponse n\'est nécessaire.');

tz_def('Q7', 'Tâche 7 : Un de chaque !');
tz_def('Q7_DESC', 'Nous devrions maintenant augmenter un peu votre production de ressources. Construisez un autre bûcheron, une autre carrière d\'argile, une autre mine de fer et un autre champ de céréales au niveau 1.');
tz_def('Q7_ORDER', 'Ordre :</p>Améliorez une autre case de chaque ressource au niveau 1.');
tz_def('Q7_RESP', 'Très bien, votre production de ressources progresse bien.');

tz_def('Q8', 'Tâche 8 : Armée immense !');
tz_def('Q8_DESC', 'Maintenant j\'ai une tâche très spéciale pour vous. J\'ai faim. Donnez-moi 200 céréales !<br><br>En échange, j\'essaierai d\'organiser une immense armée pour protéger votre village.');
tz_def('Q8_ORDER', 'Ordre :</p>Envoyez 200 céréales au surveillant.');
tz_def('Q8_BUTN', 'Envoyer les céréales');
tz_def('Q8_NOCROP', 'Pas assez de céréales !');

tz_def('Q9', 'Tâche 9 : Tout à 1.');
tz_def('Q9_DESC', 'Dans Travian, il y a toujours quelque chose à faire ! Pendant que vous attendez l\'arrivée de l\'immense armée, nous devrions augmenter un peu votre production de ressources. Améliorez toutes vos cases de ressources au niveau 1.');
tz_def('Q9_ORDER', 'Ordre :</p>Améliorez toutes les cases de ressources au niveau 1.');
tz_def('Q9_RESP', 'Très bien, votre production de ressources prospère.<br><br>Bientôt nous pourrons commencer la construction de bâtiments dans le village.');

tz_def('Q10', 'Tâche 10 : Colombe de la paix');
tz_def('Q10_DESC', 'Pendant les premiers jours après votre inscription, vous êtes protégé contre les attaques des autres joueurs. Vous pouvez voir combien de temps dure cette protection en ajoutant le code <b>[#0]</b> à votre profil.');
tz_def('Q10_ORDER', 'Ordre :</p>Écrivez le code <b>[#0]</b> dans votre profil en l\'ajoutant à l\'un des deux champs de description.');
tz_def('Q10_RESP', 'Bravo ! Maintenant tout le monde peut voir quel grand guerrier rejoint le monde.');
tz_def('Q10_REWARD', 'Votre récompense :</p>2 jours Travian');

tz_def('Q11', 'Tâche 11 : Voisins !');
tz_def('Q11_DESC', 'De nombreux villages différents vous entourent. L\'un d\'eux s\'appelle ');
tz_def('Q11_DESC1', '. Cliquez sur « Carte » dans le menu supérieur et cherchez ce village. Le nom des villages voisins s\'affiche en passant la souris dessus.');
tz_def('Q11_ORDER', 'Ordre :</p>Cherchez les coordonnées de ');
tz_def('Q11_ORDER1', 'et saisissez-les ici.');
tz_def('Q11_RESP', 'Exactement, voilà ');
tz_def('Q11_RESP1', ' ! Autant de ressources qu\'on peut en atteindre dans ce village. Enfin, presque autant...');
tz_def('Q11_BUTN', 'Tâche terminée');

tz_def('Q12', 'Tâche 12 : Cachette');
tz_def('Q12_DESC', 'Il est temps de construire une cachette. Le monde de '.SERVER_NAME.' est dangereux.<br><br>De nombreux joueurs vivent en pillant les ressources des autres. Construisez une cachette pour dissimuler une partie de vos ressources à vos ennemis.');
tz_def('Q12_ORDER', 'Ordre :</p>Construisez une cachette.');
tz_def('Q12_RESP', 'Bravo, il est désormais beaucoup plus difficile pour les autres joueurs de piller votre village.<br><br>En cas d\'attaque, vos habitants cacheront eux-mêmes les ressources dans la cachette.');

tz_def('Q13', 'Tâche 13 : À deux.');
tz_def('Q13_DESC', 'Dans '.SERVER_NAME.', il y a toujours quelque chose à faire ! Améliorez un bûcheron, une carrière d\'argile, une mine de fer et un champ de céréales au niveau 2 chacun.');
tz_def('Q13_ORDER', 'Ordre :</p>Améliorez une case de chaque ressource au niveau 2.');
tz_def('Q13_RESP', 'Très bien, votre village grandit et prospère !');

tz_def('Q14', 'Tâche 14 : Instructions');
tz_def('Q14_DESC', 'Dans les instructions du jeu, vous trouverez de courts textes informatifs sur différents bâtiments et types d\'unités.<br><br>Cliquez sur « Instructions » à gauche pour découvrir combien de bois est nécessaire pour la caserne.');
tz_def('Q14_ORDER', 'Ordre :</p>Saisissez combien de bois coûte la caserne.');
tz_def('Q14_BUTN', 'Tâche terminée');
tz_def('Q14_RESP', 'Exactement ! La caserne coûte 210 bois.');

tz_def('Q15', 'Tâche 15 : Bâtiment principal');
tz_def('Q15_DESC', 'Vos maîtres d\'œuvre ont besoin d\'un bâtiment principal de niveau 3 pour ériger des bâtiments importants comme le marché ou la caserne.');
tz_def('Q15_ORDER', 'Ordre :</p>Améliorez votre bâtiment principal au niveau 3.');
tz_def('Q15_RESP', 'Bravo. Le bâtiment principal niveau 3 a été terminé.<br><br>Avec cette amélioration, vos maîtres d\'œuvre peuvent non seulement construire plus de types de bâtiments, mais aussi le faire plus rapidement.');

tz_def('Q16', 'Tâche 16 : Avancement !');
tz_def('Q16_DESC', 'Recherchez à nouveau votre rang dans les statistiques des joueurs et appréciez vos progrès.');
tz_def('Q16_ORDER', 'Ordre :</p>Cherchez votre rang dans les statistiques et saisissez-le ici.');
tz_def('Q16_RESP', 'Bravo ! C\'est votre rang actuel.');

tz_def('Q17', 'Tâche 17 : Armes ou pain');
tz_def('Q17_DESC', 'Vous devez maintenant prendre une décision : soit commercer pacifiquement, soit devenir un guerrier redouté.<br><br>Pour le marché, un grenier est nécessaire ; pour la caserne, il faut un point de rassemblement.');
tz_def('Q17_BUTN', 'Économie');
tz_def('Q17_BUTN1', 'Militaire');

tz_def('Q18', 'Tâche 18 : Militaire');
tz_def('Q18_DESC', 'Une décision courageuse. Pour pouvoir envoyer des troupes, un point de rassemblement est nécessaire.<br><br>Le point de rassemblement doit être construit sur un emplacement spécifique. L\'emplacement ');
tz_def('Q18_DESC1', ' du chantier.');
tz_def('Q18_DESC2', ' se trouve à droite du bâtiment principal, légèrement en dessous. Le chantier lui-même est de forme courbée.');
tz_def('Q18_ORDER', 'Ordre :</p>Construisez un point de rassemblement.');
tz_def('Q18_RESP', 'Votre point de rassemblement a été érigé ! Un bon pas vers la domination mondiale !');

tz_def('Q19', 'Tâche 19 : Caserne');
tz_def('Q19_DESC', 'Maintenant vous avez un bâtiment principal niveau 3 et un point de rassemblement. Tous les prérequis pour construire la caserne sont remplis.<br><br>Vous pouvez utiliser la caserne pour entraîner des troupes au combat.');
tz_def('Q19_ORDER', 'Ordre :</p>Construisez une caserne.');
tz_def('Q19_RESP', 'Bravo... Les meilleurs instructeurs de tout le pays se sont réunis pour entraîner vos hommes au combat à leur meilleur niveau.');

tz_def('Q20', 'Tâche 20 : Entraînement.');
tz_def('Q20_DESC', 'Maintenant que vous avez la caserne, vous pouvez commencer à entraîner des troupes. Entraînez-en deux ');
tz_def('Q20_ORDER', 'Veuillez en entraîner 2 ');
tz_def('Q20_RESP', 'Les bases de votre glorieuse armée sont posées.<br><br>Avant d\'envoyer votre armée piller, vous devriez vérifier avec le ');
tz_def('Q20_RESP1', 'Simulateur de combat');
tz_def('Q20_RESP2', 'pour voir combien de troupes vous avez besoin pour battre un rat sans pertes.');

tz_def('Q21', 'Tâche 18 : Économie');
tz_def('Q21_DESC', 'Commerce & Économie, c\'est votre choix. Des temps dorés vous attendent !');
tz_def('Q21_ORDER', 'Ordre :</p>Construisez un grenier.');
tz_def('Q21_RESP', 'Bravo ! Avec le grenier, vous pouvez stocker plus de céréales.');

tz_def('Q22', 'Tâche 19 : Entrepôt');
tz_def('Q22_DESC', 'Pas seulement les céréales doivent être sauvegardées. Les autres ressources peuvent aussi être perdues si elles ne sont pas stockées correctement. Construisez un entrepôt !');
tz_def('Q22_ORDER', 'Ordre :</p>Construisez un entrepôt.');
tz_def('Q22_RESP', '«Bravo, votre entrepôt est terminé...»<br>Maintenant vous avez rempli tous les prérequis pour construire un marché.');

tz_def('Q23', 'Tâche 20 : Marché.');
tz_def('Q23_DESC', 'Construisez un marché afin de pouvoir commercer avec vos compagnons joueurs.');
tz_def('Q23_ORDER', 'Ordre :</p>Veuillez construire un marché.');
tz_def('Q23_RESP', 'Le marché a été terminé. Vous pouvez désormais faire vos propres offres ou accepter celles des autres ! En créant vos offres, pensez à proposer ce dont les autres joueurs ont le plus besoin pour obtenir de meilleurs profits.');

tz_def('Q24', 'Tâche 21 : Tout au niveau 2.');
tz_def('Q24_DESC', 'Nous devrions maintenant augmenter un peu votre production de ressources. Construisez un autre bûcheron, carrière d\'argile, mine de fer et champ de céréales au niveau 1.');
tz_def('Q24_ORDER', 'Ordre :</p>Améliorez toutes les cases de ressources au niveau 2.');
tz_def('Q24_RESP', 'Félicitations ! Votre village grandit et prospère...');

tz_def('Q28', 'Tâche 22 : Alliance.');
tz_def('Q28_DESC', 'Le travail d\'équipe est important dans Travian. Les joueurs qui collaborent s\'organisent en alliances. Recevez une invitation d\'une alliance dans votre région et rejoignez-la. Sinon, vous pouvez fonder votre propre alliance. Pour cela, vous avez besoin d\'une ambassade de niveau 3.');
tz_def('Q28_ORDER', 'Ordre :</p>Rejoignez une alliance ou fondez-en une vous-même.');
tz_def('Q28_RESP', 'C\'est bien ! Vous voilà dans une union appelée ');
tz_def('Q28_RESP1', ', et vous êtes membre de leur alliance — vous progresserez d\'autant plus vite...');

tz_def('Q29', 'Tâche 23 : Bâtiment principal au niveau 5');
tz_def('Q29_DESC', 'Pour pouvoir construire un palais ou une résidence, vous aurez besoin d\'un bâtiment principal de niveau 5.');
tz_def('Q29_ORDER', 'Ordre :</p>Améliorez votre bâtiment principal au niveau 5.');
tz_def('Q29_RESP', 'Le bâtiment principal est niveau 5 maintenant et vous pouvez construire un palais ou une résidence...');

tz_def('Q30', 'Tâche 24 : Grenier au niveau 3.');
tz_def('Q30_DESC', 'Pour ne pas perdre vos céréales, vous devriez améliorer votre grenier.');
tz_def('Q30_ORDER', 'Ordre :</p>Améliorez votre grenier au niveau 3.');
tz_def('Q30_RESP', 'Le grenier est niveau 3 maintenant...');

tz_def('Q31', 'Tâche 25 : Entrepôt au niveau 7');
tz_def('Q31_DESC', 'Pour vous assurer que vos ressources ne débordent pas, vous devriez améliorer votre entrepôt.');
tz_def('Q31_ORDER', 'Ordre :</p>Améliorez votre entrepôt au niveau 7.');
tz_def('Q31_RESP', 'L\'entrepôt a été amélioré au niveau 7...');

tz_def('Q32', 'Tâche 26 : Tout à cinq !');
tz_def('Q32_DESC', 'Vous aurez toujours besoin de plus de ressources. Les cases de ressources sont assez chères mais paieront toujours à long terme.');
tz_def('Q32_ORDER', 'Ordre :</p>Améliorez toutes les cases de ressources au niveau 5.');
tz_def('Q32_RESP', 'Toutes les ressources sont au niveau 5, très bien, votre village grandit et prospère !');

tz_def('Q33', 'Tâche 27 : Palais ou résidence ?');
tz_def('Q33_DESC', 'Pour fonder un nouveau village, vous aurez besoin de colons. Vous pouvez les entraîner dans un palais ou une résidence.');
tz_def('Q33_ORDER', 'Ordre :</p>Construisez un palais ou une résidence au niveau 10.');
tz_def('Q33_RESP', 'A atteint le niveau 10, vous pouvez maintenant entraîner des colons et fonder votre deuxième village. Attention aux points de culture...');

tz_def('Q34', 'Tâche 28 : 3 colons.');
tz_def('Q34_DESC', 'Pour fonder un nouveau village, vous aurez besoin de colons. Ils peuvent être entraînés dans un palais ou une résidence.');
tz_def('Q34_ORDER', 'Ordre :</p>Entraînez 3 colons.');
tz_def('Q34_RESP', '3 colons ont été entraînés. Pour fonder un nouveau village, vous avez besoin d\'au moins ');
tz_def('Q34_RESP1', 'points de culture...');

tz_def('Q35', 'Tâche 29 : Nouveau village.');
tz_def('Q35_DESC', 'Il y a beaucoup de cases vides sur la carte. Trouvez celle qui vous convient et fondez-y un nouveau village.');
tz_def('Q35_ORDER', 'Ordre :</p>Fondez un nouveau village.');
tz_def('Q35_RESP', 'Je suis fier de vous ! Vous avez maintenant deux villages et toutes les possibilités pour construire un empire puissant. Je vous souhaite bonne chance.');

tz_def('Q36', ' Tâche 30 : Construire un ');
tz_def('Q36_DESC', 'Maintenant que vous avez entraîné quelques soldats, vous devriez construire un ');
tz_def('Q36_DESC1', ' aussi. Cela augmente la défense de base et vos soldats recevront un bonus défensif.');
tz_def('Q36_ORDER', 'Ordre :</p>Construisez un ');
tz_def('Q36_RESP', 'C\'est de cela que je parle. Un ');
tz_def('Q36_RESP1', ' très utile. Cela augmente la défense des troupes dans le village.');

tz_def('Q37', 'Tâches');
tz_def('Q37_DESC', 'Toutes les tâches sont terminées !');

tz_def('RESOURCES_OVERVIEW', 'Aperçu des ressources');
tz_def('YOUR_RES_DELIVERIES', 'Vos livraisons de ressources');
tz_def('DELIVERY', 'Livraison');
tz_def('DELIVERY_TIME', 'Temps de livraison');
tz_def('STATUS', 'État');
tz_def('FETCH', 'récupérer');
tz_def('FETCHED', 'récupéré');
tz_def('ON_HOLD', 'en attente');
tz_def('ONE_DAY_OF_TRAVIAN', '1 jour Travian ');
tz_def('TWO_DAYS_OF_TRAVIAN', '2 jours Travian ');

//Quest 25
tz_def('Q25_7', 'Tâche 7 : Voisins !');
tz_def('Q25_7_DESC', 'De nombreux villages différents vous entourent. L\'un d\'eux s\'appelle ');
tz_def('Q25_7_DESC1', '. Cliquez sur « Carte » dans le menu du haut et cherchez ce village. Le nom des villages voisins s\'affiche en passant la souris dessus.');
tz_def('Q25_7_ORDER', '</p><b>Ordre :</b><br>Cherchez les coordonnées de ');
tz_def('Q25_7_ORDER1', 'et saisissez-les ici.');
tz_def('Q25_7_RESP', 'Exactement, voilà ');
tz_def('Q25_7_RESP1', ' ! Autant de ressources qu\'on peut en atteindre dans ce village. Enfin, presque autant...');

tz_def('Q25_8', 'Tâche 8 : Armée immense !');
tz_def('Q25_8_DESC', 'Maintenant j\'ai une tâche très spéciale pour vous. J\'ai faim. Donnez-moi 200 céréales !<br><br>En échange, j\'essaierai d\'organiser une immense armée pour protéger votre village.');
tz_def('Q25_8_ORDER', 'Ordre :</p>Envoyez 200 céréales au surveillant.');
tz_def('Q25_8_BUTN', 'Envoyer les céréales');
tz_def('Q25_8_NOCROP', 'Pas assez de céréales !');

tz_def('Q25_9', 'Tâche 9 : Un de chaque !');
tz_def('Q25_9_DESC', 'Dans '.SERVER_NAME.', il y a toujours quelque chose à faire ! Pendant que vous attendez votre nouvelle armée,<br><br>améliorez un bûcheron, une carrière d\'argile, une mine de fer et un champ de céréales supplémentaires au niveau 1.');
tz_def('Q25_9_ORDER', 'Ordre :</p>Améliorez une autre case de chaque ressource au niveau 1.');
tz_def('Q25_9_RESP', 'Très bien, beau développement de la production de ressources.');

tz_def('Q25_10', 'Tâche 10 : Bientôt !');
tz_def('Q25_10_DESC', 'Vous pouvez prendre une petite pause jusqu\'à ce que l\'armée gigantesque que je vous ai envoyée arrive.<br><br>Jusque-là, vous pouvez explorer la carte ou améliorer quelques cases de ressources.');
tz_def('Q25_10_ORDER', 'Ordre :</p>Attendez l\'arrivée de l\'armée du surveillant.');
tz_def('Q25_10_RESP', 'Maintenant une immense armée du surveillant est arrivée pour protéger votre village.');
tz_def('Q25_10_REWARD', 'Votre récompense :</p>2 jours de plus dans Travian');

tz_def('Q25_11', 'Tâche 11 : Rapports');
tz_def('Q25_11_DESC', 'Chaque fois qu\'un événement important se produit sur votre compte, vous recevez un rapport.<br><br>Vous pouvez les consulter en cliquant sur la moitié gauche du 5e bouton (de gauche à droite). Lisez le rapport et revenez ici.');
tz_def('Q25_11_ORDER', 'Ordre :</p>Lisez votre dernier rapport.');
tz_def('Q25_11_RESP', 'Vous l\'avez reçu ? Très bien. Voici votre récompense.');

tz_def('Q25_12', 'Tâche 12 : Tout à 1.');
tz_def('Q25_12_DESC', 'Nous devrions maintenant augmenter un peu votre production de ressources.');
tz_def('Q25_12_ORDER', 'Ordre :</p>Améliorez toutes les cases de ressources au niveau 1.');
tz_def('Q25_12_RESP', 'Très bien, votre production de ressources prospère.<br><br>Bientôt nous pourrons commencer la construction de bâtiments dans le village.');

tz_def('Q25_13', 'Tâche 13 : Colombe de la paix');
tz_def('Q25_13_DESC', 'Pendant les premiers jours après votre inscription, vous êtes protégé contre les attaques des autres joueurs. Vous pouvez voir combien de temps dure cette protection en ajoutant le code <b>[#0]</b> à votre profil.');
tz_def('Q25_13_ORDER', 'Ordre :</p>Écrivez le code <b>[#0]</b> dans votre profil en l\'ajoutant à l\'un des deux champs de description.');
tz_def('Q25_13_RESP', 'Bravo ! Maintenant tout le monde peut voir quel grand guerrier rejoint le monde.');

tz_def('Q25_14', 'Tâche 14 : Cachette');
tz_def('Q25_14_DESC', 'Il est temps de construire une cachette. Le monde de <b>'.SERVER_NAME.'</b> est dangereux.<br><br>De nombreux joueurs vivent en pillant les ressources des autres. Construisez une cachette pour dissimuler une partie de vos ressources à vos ennemis.');
tz_def('Q25_14_ORDER', 'Ordre :</p>Construisez une cachette.');
tz_def('Q25_14_RESP', 'Bravo, il est désormais beaucoup plus difficile pour les autres joueurs de piller votre village.<br><br>En cas d\'attaque, vos habitants cacheront eux-mêmes les ressources dans la cachette.');

tz_def('Q25_15', 'Tâche 15 : À deux.');
tz_def('Q25_15_DESC', 'Dans <b>'.SERVER_NAME.'</b>, il y a toujours quelque chose à faire ! Améliorez un bûcheron, une carrière d\'argile, une mine de fer et un champ de céréales au niveau 2 chacun.');
tz_def('Q25_15_ORDER', 'Ordre :</p>Améliorez une case de chaque ressource au niveau 2.');
tz_def('Q25_15_RESP', 'Très bien, votre village grandit et prospère !');

tz_def('Q25_16', 'Tâche 16 : Instructions');
tz_def('Q25_16_DESC', 'Dans les instructions du jeu, vous trouverez de courts textes informatifs sur différents bâtiments et types d\'unités.<br><br>Cliquez sur « Instructions » à gauche pour découvrir combien de bois est nécessaire pour la caserne.');
tz_def('Q25_16_ORDER', 'Ordre :</p>Saisissez combien de bois coûte la caserne.');
tz_def('Q25_16_BUTN', 'Tâche terminée');
tz_def('Q25_16_RESP', 'Exactement ! La caserne coûte 210 bois.');

tz_def('Q25_17', 'Tâche 17 : Bâtiment principal');
tz_def('Q25_17_DESC', 'Vos maîtres d\'œuvre ont besoin d\'un bâtiment principal de niveau 3 pour ériger des bâtiments importants comme le marché ou la caserne.');
tz_def('Q25_17_ORDER', 'Ordre :</p>Améliorez votre bâtiment principal au niveau 3.');
tz_def('Q25_17_RESP', 'Bravo. Le bâtiment principal niveau 3 a été terminé.<br><br>Avec cette amélioration, vos maîtres d\'œuvre peuvent construire plus de types de bâtiments et plus rapidement.');

tz_def('Q25_18', 'Tâche 18 : Avancement !');
tz_def('Q25_18_DESC', 'Recherchez à nouveau votre rang dans les statistiques des joueurs et appréciez vos progrès.');
tz_def('Q25_18_ORDER', 'Ordre :</p>Cherchez votre rang dans les statistiques et saisissez-le ici.');
tz_def('Q25_18_RESP', 'Bravo ! C\'est votre rang actuel.');

tz_def('Q25_19', 'Tâche 19 : Armes ou pain');
tz_def('Q25_19_DESC', 'Vous devez maintenant prendre une décision : soit commercer pacifiquement, soit devenir un guerrier redouté.<br><br>Pour le marché, un grenier est nécessaire ; pour la caserne, il faut un point de rassemblement.');
tz_def('Q25_19_BUTN', 'Économie');
tz_def('Q25_19_BUTN1', 'Militaire');

tz_def('Q25_20', 'Tâche 19 : Économie');
tz_def('Q25_20_DESC', 'Commerce & Économie, c\'est votre choix. Des temps dorés vous attendent !');
tz_def('Q25_20_ORDER', 'Ordre :</p>Construisez un grenier.');
tz_def('Q25_20_RESP', 'Bravo ! Avec le grenier, vous pouvez stocker plus de céréales.');

tz_def('Q25_21', 'Tâche 20 : Entrepôt');
tz_def('Q25_21_DESC', 'Pas seulement les céréales doivent être sauvegardées. Les autres ressources peuvent aussi être perdues si elles ne sont pas stockées correctement. Construisez un entrepôt !');
tz_def('Q25_21_ORDER', 'Ordre :</p>Construisez un entrepôt.');
tz_def('Q25_21_RESP', '«Bravo, votre entrepôt est terminé...»<br>Maintenant vous avez rempli tous les prérequis pour construire un marché.');

tz_def('Q25_22', 'Tâche 21 : Marché.');
tz_def('Q25_22_DESC', 'Construisez un marché afin de pouvoir commercer avec vos compagnons joueurs.');
tz_def('Q25_22_ORDER', 'Ordre :</p>Veuillez construire un marché.');
tz_def('Q25_22_RESP', 'Le marché a été terminé. Vous pouvez désormais faire vos propres offres et accepter celles des autres ! En créant vos offres, pensez à proposer ce dont les autres joueurs ont le plus besoin pour obtenir de meilleurs profits.');

tz_def('Q25_23', 'Tâche 19 : Militaire');
tz_def('Q25_23_DESC', 'Une décision courageuse. Pour pouvoir envoyer des troupes, un point de rassemblement est nécessaire.<br><br>Le point de rassemblement doit être construit sur un emplacement spécifique. L\'emplacement ');
tz_def('Q25_23_DESC1', ' du chantier.');
tz_def('Q25_23_DESC2', ' se trouve à droite du bâtiment principal, légèrement en dessous. Le chantier lui-même est de forme courbée.');
tz_def('Q25_23_ORDER', 'Ordre :</p>Construisez un point de rassemblement.');
tz_def('Q25_23_RESP', 'Votre point de rassemblement a été érigé ! Un bon pas vers la domination mondiale !');

tz_def('Q25_24', 'Tâche 20 : Caserne');
tz_def('Q25_24_DESC', 'Maintenant vous avez un bâtiment principal niveau 3 et un point de rassemblement. Tous les prérequis pour construire la caserne sont remplis.<br><br>Vous pouvez utiliser la caserne pour entraîner des troupes au combat.');
tz_def('Q25_24_ORDER', 'Ordre :</p>Construisez une caserne.');
tz_def('Q25_24_RESP', 'Bravo... Les meilleurs instructeurs de tout le pays se sont réunis pour entraîner vos hommes au combat à leur meilleur niveau.');

tz_def('Q25_25', 'Tâche 21 : Entraînement.');
tz_def('Q25_25_DESC', 'Maintenant que vous avez la caserne, vous pouvez commencer à entraîner des troupes. Entraînez-en deux ');
tz_def('Q25_25_ORDER', 'Veuillez en entraîner 2 ');
tz_def('Q25_25_RESP', 'Les bases de votre glorieuse armée sont posées.<br><br>Avant d\'envoyer votre armée piller, vous devriez vérifier avec le ');
tz_def('Q25_25_RESP1', 'Simulateur de combat');
tz_def('Q25_25_RESP2', 'pour voir combien de troupes vous avez besoin pour battre un adversaire sans pertes.');

tz_def('Q25_26', 'Tâche 22 : Tout au niveau 2.');
tz_def('Q25_26_DESC', 'Il est temps d\'étendre à nouveau les fondements de la puissance et de la richesse ! Cette fois le niveau 1 ne suffit pas... cela prendra un peu de temps mais au final ça en vaudra la peine. Améliorez toutes vos cases de ressources au niveau 2 !');
tz_def('Q25_26_ORDER', 'Ordre :</p>Améliorez toutes les cases de ressources au niveau 2.');
tz_def('Q25_26_RESP', 'Félicitations ! Votre village grandit et prospère...');

tz_def('Q25_27', 'Tâche 23 : Amis.');
tz_def('Q25_27_DESC', 'En tant que joueur solitaire, il est difficile de rivaliser avec les attaquants. C\'est un avantage d\'être apprécié de vos voisins.<br><br>C\'est encore mieux si vous jouez avec des amis. Saviez-vous que vous pouvez gagner '.GOLD_IMG.' en invitant des amis ?');
tz_def('Q25_27_ORDER', 'Ordre :</p>Combien d\''.GOLD_IMG.' gagnez-vous en invitant un ami ?');
tz_def('Q25_27_RESP', 'Correct ! Vous obtenez 50 '.GOLD_IMG.' si votre ami invité possède 2 villages.');

tz_def('Q25_28', 'Tâche 24 : Construire une ambassade.');
tz_def('Q25_28_DESC', 'Le monde de Travian est dangereux. Vous avez déjà construit une cachette pour vous protéger des attaquants.<br><br>Une bonne alliance vous donnera une protection encore meilleure.');
tz_def('Q25_28_ORDER', 'Ordre :</p>Pour accepter les invitations d\'alliances, construisez une ambassade.');
tz_def('Q25_28_RESP', 'Oui ! Vous pouvez attendre une invitation d\'une alliance ou créer la vôtre si l\'ambassade atteint le niveau 3.');

tz_def('Q25_29', 'Tâche 25 : Alliance.');
tz_def('Q25_29_DESC', 'Le travail d\'équipe est important dans Travian. Les joueurs qui collaborent s\'organisent en alliances. Recevez une invitation d\'une alliance dans votre région et rejoignez-la. Sinon, vous pouvez fonder votre propre alliance. Pour cela, vous avez besoin d\'une ambassade de niveau 3.');
tz_def('Q25_29_ORDER', 'Ordre :</p>Rejoignez une alliance ou fondez la vôtre.');
tz_def('Q25_29_RESP', 'Bravo ! Vous voilà dans une union appelée ');
tz_def('Q25_29_RESP1', ', et vous êtes membre de leur alliance.<br>En collaborant, vous progresserez tous plus vite...');

tz_def('Q25_30', 'Tâches');
tz_def('Q25_30_DESC', 'Toutes les tâches sont terminées !');

//======================================================//
//================ UNITS - DO NOT EDIT! ================//
//======================================================//
tz_def('U0', 'Héros');

//ROMAN UNITS
tz_def('U1', 'Légionnaire');
tz_def('U2', 'Prétorien');
tz_def('U3', 'Impérian');
tz_def('U4', 'Equitès Légati');
tz_def('U5', 'Equitès Impératoris');
tz_def('U6', 'Equitès Caesaris');
tz_def('U7', 'Bélier');
tz_def('U8', 'Catapulte de Feu');
tz_def('U9', 'Sénateur');
tz_def('U10', 'Colon');

//TEUTON UNITS
tz_def('U11', 'Combattant au Gourdin');
tz_def('U12', 'Combattant à la Lance');
tz_def('U13', 'Combattant à la Hache');
tz_def('U14', 'Espion');
tz_def('U15', 'Paladin');
tz_def('U16', 'Cavalier Teuton');
tz_def('U17', 'Bélier');
tz_def('U18', 'Catapulte');
tz_def('U19', 'Chef');
tz_def('U20', 'Colon');

//GAUL UNITS
tz_def('U21', 'Phalange');
tz_def('U22', "Combattant à l'Épée");
tz_def('U23', 'Éclaireur');
tz_def('U24', 'Éclair de Toutatis');
tz_def('U25', 'Cavalier Druide');
tz_def('U26', 'Hédouin');
tz_def('U27', 'Bélier');
tz_def('U28', 'Trébuchet');
tz_def('U29', 'Chef de Tribu');
tz_def('U30', 'Colon');
tz_def('U99', 'Piège');

//NATURE UNITS
tz_def('U31', 'Rat');
tz_def('U32', 'Araignée');
tz_def('U33', 'Serpent');
tz_def('U34', 'Chauve-souris');
tz_def('U35', 'Sanglier');
tz_def('U36', 'Loup');
tz_def('U37', 'Ours');
tz_def('U38', 'Crocodile');
tz_def('U39', 'Tigre');
tz_def('U40', 'Éléphant');

//NATARS UNITS
tz_def('U41', 'Piquier');
tz_def('U42', 'Guerrier Épineux');
tz_def('U43', 'Garde');
tz_def('U44', 'Oiseaux de Proie');
tz_def('U45', 'Cavalier à la Hache');
tz_def('U46', 'Chevalier Natar');
tz_def('U47', 'Éléphant de Guerre');
tz_def('U48', 'Baliste');
tz_def('U49', 'Empereur Natar');
tz_def('U50', 'Colon Natar');
//HUNS (TRIBE 6)
tz_def('U51', 'Mercenaire');
tz_def('U52', 'Archer');
tz_def('U53', 'Guetteur');
tz_def('U54', 'Cavalier des Steppes');
tz_def('U55', 'Archer Monté');
tz_def('U56', 'Maraudeur');
tz_def('U57', 'Bélier');
tz_def('U58', 'Catapulte');
tz_def('U59', 'Logades');
tz_def('U60', 'Colon');
//EGYPTIANS (TRIBE 7)
tz_def('U61', 'Milicien Esclave');
tz_def('U62', 'Sentinelle');
tz_def('U63', 'Soldat au Khopesh');
tz_def('U64', 'Explorateur de Sopdou');
tz_def('U65', "Garde d'Anhour");
tz_def('U66', 'Char de Reshep');
tz_def('U67', 'Bélier');
tz_def('U68', 'Catapulte de pierre');
tz_def('U69', 'Nomarque');
tz_def('U70', 'Colon');
//SPARTANS (TRIBE 8)
tz_def('U71', 'Hoplite Spartiate');
tz_def('U72', 'Guerrier de l\'Agogé');
tz_def('U73', 'Homoioi');
tz_def('U74', 'Éclaireur Périèque');
tz_def('U75', 'Cavalier Spartiate');
tz_def('U76', 'Cavalier Elpida');
tz_def('U77', 'Bélier');
tz_def('U78', 'Catapulte');
tz_def('U79', 'Éphore');
tz_def('U80', 'Colon');
//VIKINGS (TRIBE 9)
tz_def('U81', 'Thrall');
tz_def('U82', 'Œil de Heimdall');
tz_def('U83', 'Guerrière au Bouclier');
tz_def('U84', 'Berserker');
tz_def('U86', 'Cavalier Huscarl');
tz_def('U85', 'Bénédiction de la Valkyrie');
tz_def('U87', 'Bélier');
tz_def('U88', 'Catapulte');
tz_def('U89', 'Jarl');
tz_def('U90', 'Colon');


//INDEX.php
tz_def('LOGIN', 'Se connecter');
tz_def('PLAYERS', 'Joueurs');
tz_def('MODERATOR', 'Modérateur');
tz_def('ACTIVE', 'Actif');
tz_def('ONLINE', 'En ligne');
tz_def('TUTORIAL', 'Tutoriel');
tz_def('FAQ', 'FAQ');
tz_def('SPIELREGELN', 'Règles du jeu');
tz_def('PLAYER_STATISTICS', 'Statistiques du Joueur');
tz_def('TOTAL_PLAYERS', PLAYERS.' au total');
tz_def('ACTIVE_PLAYERS', 'Joueurs actifs');
tz_def('ONLINE_PLAYERS', PLAYERS.' en ligne');
tz_def('MP_STRATEGY_GAME', SERVER_NAME.' — le jeu de stratégie multijoueur');
tz_def('WHAT_IS', SERVER_NAME.' est l\'un des jeux de navigateur les plus populaires au monde. En tant que joueur dans '.SERVER_NAME.', vous bâtirez votre propre empire, recruterez une puissante armée et combattrez avec vos alliés pour l\'hégémonie du monde.');
tz_def('REGISTER_FOR_FREE', 'Inscrivez-vous gratuitement ici !');
tz_def('LATEST_GAME_WORLD', 'Dernier monde de jeu');
tz_def('LATEST_GAME_WORLD2', 'Inscrivez-vous au dernier<br>monde de jeu et profitez<br>des avantages d\'être<br>parmi les premiers<br>joueurs.');
tz_def('PLAY_NOW', 'Jouer à '.SERVER_NAME.' maintenant');
tz_def('LEARN_MORE', 'En savoir plus <br>sur '.SERVER_NAME.' !');
tz_def('LEARN_MORE2', 'Maintenant avec un système<br>de serveur révolutionnaire,<br>de nouveaux graphismes<br>— ce clone est extraordinaire !');
tz_def('COMUNITY', 'Communauté');
tz_def('BECOME_COMUNITY', 'Rejoignez notre communauté maintenant !');
tz_def('BECOME_COMUNITY2', 'Devenez une partie de l\'un des plus grands jeux <br> communautaire au monde.');
tz_def('NEWS','Actualités');
tz_def('SCREENSHOTS','Captures d\'écran');
tz_def('AGB', 'Conditions générales');
tz_def('LEARN1', 'Améliorez vos champs et mines afin d\'augmenter votre production de ressources. Vous aurez besoin de ressources pour construire des bâtiments et entraîner des soldats.');
tz_def('LEARN2', 'Construisez et étendez les bâtiments de votre village. Les bâtiments améliorent votre infrastructure globale, augmentent votre production de ressources et vous permettent de rechercher, entraîner et améliorer vos troupes.');
tz_def('LEARN3', 'Observez et interagissez avec votre environnement. Vous pouvez vous faire de nouveaux amis ou de nouveaux ennemis, exploiter les oasis proches et observer votre empire grandir et devenir plus puissant.');
tz_def('LEARN4', 'Suivez vos progrès et vos succès et comparez-vous aux autres joueurs. Consultez les classements Top 10 et combattez pour remporter une médaille hebdomadaire.');
tz_def('LEARN5', 'Recevez des rapports détaillés sur vos aventures, échanges et batailles. N\'oubliez pas de consulter les nouveaux rapports sur les événements qui se déroulent dans vos environs.');
tz_def('LEARN6', 'Échangez des informations et menez votre diplomatie avec les autres joueurs. Souvenez-vous toujours que la communication est la clé pour gagner de nouveaux amis et résoudre d\'anciens conflits.');
tz_def('LOGIN_TO', 'Se connecter à '.SERVER_NAME);
tz_def('REGIN_TO', 'S\'inscrire à '.SERVER_NAME);
tz_def('P_ONLINE', 'Joueurs en ligne : ');
tz_def('P_TOTAL', 'Joueurs au total : ');
tz_def('CHOOSE', 'Choisissez un serveur.');
tz_def('STARTED', ' Le serveur a démarré il y a '. round((time() - COMMENCE) / 86400) .' jours.');

//ANMELDEN.php
tz_def('NICKNAME', 'Pseudo');
tz_def('EMAIL', 'E-mail');
tz_def('PASSWORD', 'Mot de passe');
tz_def('NW', 'Nord-Ouest');
tz_def('NE', 'Nord-Est');
tz_def('SW', 'Sud-Ouest');
tz_def('SE', 'Sud-Est');
tz_def('RANDOM', 'Aléatoire');
tz_def('ACCEPT_RULES', ' J\'accepte les règles du jeu et les conditions générales.');
tz_def('ONE_PER_SERVER', 'Chaque joueur ne peut posséder qu\'UN seul compte par serveur.');
tz_def('BEFORE_REGISTER', 'Avant de créer un compte, vous devez lire les <a href="../anleitung.php" target="_blank">instructions</a> de Travian RO1 pour voir les avantages spécifiques et les inconvénients des différentes tribus.');
tz_def('BUILDING_UPGRADING', 'Construction :');
tz_def('HOURS', 'heures');


//ATTACKS ETC.
tz_def('TROOP_MOVEMENTS', 'Mouvements de troupes :');
tz_def('ARRIVING_REINF_TROOPS', 'Arrivée des renforts');
tz_def('ARRIVING_ATTACKING_TROOPS', "Arrivée de l'attaque");
tz_def('ARRIVING_REINF_TROOPS_SHORT', 'Renf.');
tz_def('OWN_ATTACKING_TROOPS', 'Vos troupes d\'attaque');
tz_def('ATTACK', 'Attaque');
tz_def('OWN_REINFORCING_TROOPS', 'Vos troupes de renfort');
tz_def('NEWVILLAGE', 'Nouveau Village');
tz_def('FOUNDNEWVILLAGE', 'Fonder un nouveau village');
tz_def('UNDERATTACK', 'Le village est attaqué');
tz_def('OASISATTACK', 'L\'Oasis est attaqué');
tz_def('OASISATTACKS', 'Att. Oasis');
tz_def('RETURNFROM', 'Retour de');
tz_def('REINFORCEMENTFOR', 'Renforts vers');
tz_def('ATTACK_ON', 'Attaque sur');
tz_def('RAID_ON', 'Pillage sur');
tz_def('MARK_ATTACK', 'Marquer cette attaque (gravité)');
tz_def('SCOUTING', 'Espionnage');
tz_def('PRISONERS', 'Prisonniers');
tz_def('PRISONERSIN', 'Prisonniers à');
tz_def('PRISONERSFROM', 'Prisonniers de');
tz_def('TROOPS', 'Troupes');
tz_def('BOUNTY', 'Butin');
tz_def('ARRIVAL', 'Arrivée');
tz_def('CATAPULT_TARGET', 'Cible(s) des Catapultes');
tz_def('INCOMING_TROOPS', 'Retour des Troupes');
tz_def('TROOPS_ON_THEIR_WAY', 'Troupes en chemin');
tz_def('OWN_TROOPS', 'Vos troupes');
tz_def('ON', 'sur');
tz_def('AT', 'à');
tz_def('UPKEEP', 'Entretien');
tz_def('SEND_BACK', 'Renvoyer');
tz_def('TROOPS_IN_THE_VILLAGE', 'Troupes dans le village');
tz_def('TROOPS_IN_OTHER_VILLAGE', 'Troupes dans d\'autres villages');
tz_def('TROOPS_IN_OASIS', 'Troupes dans les oasis');
tz_def('KILL', 'Tuer');
tz_def('FROM', 'De');
tz_def('SEND_TROOPS', 'Envoyer des Troupes');
tz_def('TASKMASTER', 'Surveillant');
tz_def('TO_THE_TASK', 'Vers la tâche');
tz_def('VILLAGE_OF_THE_ELDERS', 'Village des anciens');
tz_def('VILLAGE_OF_THE_ELDERS_TROOPS', 'Troupes du village des anciens');

//SEND TROOP
tz_def('REINFORCE', 'Renfort');
tz_def('NORMALATTACK', 'Attaque Normale');
tz_def('RAID', 'Pillage');
tz_def('OR', 'ou');
tz_def('SENDTROOP', 'Envoyer des troupes');
tz_def('NOTROOP', 'Aucune troupe');

//map
tz_def('DETAIL', 'Détails');
tz_def('ABANDVALLEY', 'Vallée abandonnée');
tz_def('OCCUPIED', 'Occupé');
tz_def('UNOCCUPIED', 'Inoccupé');
tz_def('UNOCCUOASIS', 'Oasis inoccupé');
tz_def('OCCUOASIS', 'Oasis occupé');
tz_def('THERENOINFO', 'Aucune information<br>disponible.');
tz_def('LANDDIST', 'Distribution des terres');
tz_def('TRIBE', 'Tribu');
tz_def('ALLIANCE', 'Alliance');
tz_def('POP', 'Population');
tz_def('REPORT', 'Rapport');
tz_def('OPTION', 'Options');
tz_def('CENTREMAP', 'Centrer la carte');
tz_def('FNEWVILLAGE', 'Fonder un nouveau village');
tz_def('CULTUREPOINT', 'points de culture');
tz_def('BUILDRALLY', 'Construire une place de rassemblement');
tz_def('SETTLERSAVAIL', 'Colons disponibles');
tz_def('BEGINPRO', 'Protection des débutants');
tz_def('SENDMERC', 'Envoyer marchand(s)');
tz_def('BAN', 'Joueur banni');
tz_def('BUILDMARKET', 'Construire une place du marché');
tz_def('PERHOUR', 'par heure');
tz_def('BONUS', 'Bonus');
tz_def('MAP', 'Carte');
tz_def('LARGE_MAP', 'Grande carte');
tz_def('LARGE_MAP_DESC', 'Afficher la grande carte dans une fenêtre séparée');
tz_def('CROPFINDER', 'Chercher 9C/15C');
tz_def('NORTH', 'Nord');
tz_def('EAST', 'Est');
tz_def('SOUTH', 'Sud');
tz_def('WEST', 'Ouest');
tz_def('CLOSE_MAP', 'Fermer la carte');
tz_def('AND', 'et');

//other
tz_def('VILLAGE', 'Village');
tz_def('STATISTICS', 'Statistiques');
tz_def('ALLIANCES', 'Alliances');
tz_def('HEROES', 'Héros');
tz_def('GENERAL', 'Général');
tz_def('WWS', 'Merveille du Monde');
tz_def('TOP10P', 'TOP 10 Joueurs');
tz_def('TOP10PA', 'TOP 10 Attaquants');
tz_def('TOP10PD', 'TOP 10 Défenseurs');
tz_def('TOP10A', 'TOP 10 Alliances');
tz_def('TOP10AA', 'TOP 10 Alliances Attaquantes');
tz_def('TOP10AD', 'TOP 10 Alliances Défenseures');
tz_def('MILESTONES', 'Étapes Clés');
tz_def('OASIS', 'Oasis');
tz_def('NO_OASIS', 'Vous ne possédez aucune oasis.');
tz_def('NO_VILLAGES', 'Il n\'y a pas de villages.');
tz_def('PLAYER', 'Joueur');

//LOGIN.php
tz_def('COOKIES', 'Vous devez avoir activé les cookies pour pouvoir vous connecter. Si vous partagez cet ordinateur avec d\'autres personnes, vous devez vous déconnecter après chaque session pour votre propre sécurité.');
tz_def('NAME', 'Nom');
tz_def('PW_FORGOTTEN', 'Mot de passe oublié ?');
tz_def('PW_REQUEST', 'Vous pouvez en demander un nouveau qui sera envoyé à votre adresse e-mail.');
tz_def('PW_GENERATE', 'Générer un nouveau mot de passe.');
tz_def('EMAIL_NOT_VERIFIED', 'E-mail non vérifiée !');
tz_def('EMAIL_FOLLOW', 'Suivez ce lien pour activer votre compte.');
tz_def('VERIFY_EMAIL', 'Vérifier l\'e-mail.');
tz_def('SERVER_STARTS_IN', 'Le serveur démarrera dans : ');
tz_def('START_NOW', 'COMMENCER MAINTENANT');


//404.php
tz_def('NOTHING_HERE', 'Rien ici!');
tz_def('WE_LOOKED', 'Nous avons déjà cherché 404 fois mais ne trouvons rien.');

//MASSMESSAGE.php
tz_def('MASS', 'Contenu du message');
tz_def('MASS_SUBJECT', 'Sujet :');
tz_def('MASS_COLOR', 'Couleur du message :');
tz_def('MASS_REQUIRED', 'Tous les champs sont requis');
tz_def('MASS_UNITS', 'Images (unités) :');
tz_def('MASS_SHOWHIDE', 'Afficher/Masquer');
tz_def('MASS_READ', 'Lisez ceci : après avoir ajouté une émoticône, vous devez ajouter « left » ou « right » après le numéro, sinon l\'image ne fonctionnera pas.');
tz_def('MASS_CONFIRM', 'Confirmation');
tz_def('MASS_REALLY', 'Voulez-vous vraiment envoyer un message de masse ?');
tz_def('MASS_ABORT', 'Abandonner maintenant');
tz_def('MASS_SENT', 'Le message de masse a été envoyé');

//BUILDINGS
tz_def('WOODCUTTER', 'Bûcheron');
tz_def('WOODCUTTER_DESC', 'Le bûcheron abat des arbres pour produire du bois. Plus son niveau est élevé, plus la production de bois augmente.<br>En construisant une scierie, vous pouvez encore augmenter la production.');
tz_def('CLAYPIT', 'Carrière d\'argile');
tz_def('CLAYPIT_DESC', 'L\'argile est produite ici. Plus son niveau est élevé, plus la production d\'argile augmente.<br>En construisant une briqueterie, vous pouvez encore augmenter la production.');
tz_def('IRONMINE', 'Mine de fer');
tz_def('IRONMINE_DESC', 'Les mineurs y extraient la précieuse ressource du fer. Plus son niveau est élevé, plus la production de fer augmente.<br>En construisant une fonderie de fer, vous pouvez encore augmenter la production.');
tz_def('CROPLAND', 'Champ de céréales');
tz_def('CROPLAND_DESC', 'La nourriture de votre population est produite ici. Plus le niveau du champ augmente, plus la production de céréales progresse.<br>En construisant un moulin à grain et une boulangerie, vous pouvez encore augmenter la production.');

tz_def('SAWMILL', 'Scierie');
tz_def('SAWMILL_DESC', 'Le bois coupé par vos bûcherons est traité ici. La scierie augmente la production de bois du village. Au niveau 1, elle augmente la production de bois de 5 %, et à chaque amélioration, la production augmente de 5 % supplémentaires, pour un total de 25 % après 5 niveaux.<br>Le bonus de la scierie et de tous les bâtiments procurant des bonus de ressources ne s\'applique qu\'au village dans lequel le bâtiment est construit.<br>Notez que le bonus de la scierie ne s\'applique pas à d\'autres bonus comme le revenu des oasis ou le bonus PLUS de 10 %.<br>Il existe aussi des villages composés de 3 ou 5 champs de bois. Plus il y a de champs dans un village, plus les niveaux de scierie peuvent être efficaces.');
tz_def('CURRENT_WOOD_BONUS', 'Bonus bois actuel :');
tz_def('WOOD_BONUS_LEVEL', 'Bonus bois au niveau');
tz_def('MAX_LEVEL', 'Bâtiment déjà au niveau maximum');
tz_def('PERCENT', '%');

tz_def('BRICKYARD', 'Briqueterie');
tz_def('CURRENT_CLAY_BONUS', 'Bonus argile actuel :');
tz_def('CLAY_BONUS_LEVEL', 'Bonus argile au niveau');
tz_def('BRICKYARD_DESC', 'L\'argile est transformée en briques ici. La briqueterie augmente la production d\'argile du village. Au niveau 1, elle augmente la production d\'argile de 5 %, et à chaque amélioration, la production augmente de 5 % supplémentaires, pour un total de 25 % après 5 niveaux.<br>Le bonus de la briqueterie et de tous les bâtiments procurant des bonus de ressources ne s\'applique qu\'au village dans lequel le bâtiment est construit.<br>Notez que le bonus de la briqueterie ne s\'applique pas à d\'autres bonus comme le revenu des oasis ou le bonus PLUS de 10 %.<br>Il existe aussi des villages composés de 3 ou 5 champs d\'argile. Plus il y a de champs dans un village, plus les niveaux de briqueterie peuvent être efficaces.');

tz_def('IRONFOUNDRY', 'Fonderie de fer');
tz_def('CURRENT_IRON_BONUS', 'Bonus fer actuel :');
tz_def('IRON_BONUS_LEVEL', 'Bonus fer au niveau');
tz_def('IRONFOUNDRY_DESC', 'Le fer est fondu ici. La fonderie augmente la production de fer du village. Au niveau 1, elle augmente la production de fer de 5 %, et à chaque amélioration, la production augmente de 5 % supplémentaires, pour un total de 25 % après 5 niveaux.<br>Le bonus de la fonderie et de tous les bâtiments procurant des bonus de ressources ne s\'applique qu\'au village dans lequel le bâtiment est construit.<br>Notez que le bonus de la fonderie ne s\'applique pas à d\'autres bonus comme le revenu des oasis ou le bonus PLUS de 10 %.<br>Il existe aussi des villages composés de 3 ou 5 champs de fer. Plus il y a de champs dans un village, plus les niveaux de fonderie peuvent être efficaces.');

tz_def('GRAINMILL', 'Moulin');
tz_def('CURRENT_CROP_BONUS', 'Bonus céréales actuel :');
tz_def('CROP_BONUS_LEVEL', 'Bonus céréales au niveau');
tz_def('GRAINMILL_DESC', 'Le grain est moulu en farine ici. Le moulin à grain augmente la production de nourriture du village. Au niveau 1, il augmente la production de 5 %, et à chaque amélioration, la production augmente de 5 % supplémentaires, pour un total de 25 % après 5 niveaux.<br>Utilisé conjointement avec la boulangerie, vous pouvez augmenter la production de céréales jusqu\'à 50 %.<br>Le bonus du moulin et de tous les bâtiments procurant des bonus de ressources ne s\'applique qu\'au village dans lequel le bâtiment est construit.<br>Notez que le bonus du moulin ne s\'applique pas à d\'autres bonus comme le revenu des oasis ou le bonus PLUS de 10 %.<br>Il existe aussi des villages composés de 9 ou 15 champs de céréales. Plus il y a de champs dans un village, plus les niveaux de moulin peuvent être efficaces.');

tz_def('BAKERY', 'Boulangerie');
tz_def('BAKERY_DESC', 'Le pain est cuit à partir de farine ici. La boulangerie augmente la production de nourriture du village. Au niveau 1, elle augmente la production de 5 %, et à chaque amélioration, la production augmente de 5 % supplémentaires, pour un total de 25 % après 5 niveaux.<br>Utilisée conjointement avec le moulin à grain, elle peut augmenter la production de céréales jusqu\'à 50 %.<br>Le bonus de la boulangerie et de tous les bâtiments procurant des bonus de ressources ne s\'applique qu\'au village dans lequel le bâtiment est construit.<br>Notez que le bonus de la boulangerie ne s\'applique pas à d\'autres bonus comme le revenu des oasis ou le bonus PLUS de 10 %.<br>Il existe aussi des villages composés de 9 ou 15 champs de céréales. Plus il y a de champs dans un village, plus les niveaux de boulangerie peuvent être efficaces.');

tz_def('WAREHOUSE', 'Dépôt de ressources');
tz_def('CURRENT_CAPACITY', 'Capacité actuelle:');
tz_def('CAPACITY_LEVEL', 'Capacité au niveau');
tz_def('RESOURCE_UNITS', 'Unités de ressources');
tz_def('WAREHOUSE_DESC', 'Les ressources bois, argile et fer sont stockées dans votre dépôt. En augmentant son niveau, vous augmentez la capacité de votre dépôt. Peut être construit plusieurs fois, une fois le premier au niveau maximum.');

tz_def('GRANARY', 'Silo de céréales');
tz_def('CROP_UNITS', 'Unités de céréales');
tz_def('GRANARY_DESC', 'Les céréales produites par vos fermes sont stockées dans le silo de céréales. En augmentant son niveau, vous augmentez la capacité du silo. Peut être construit plusieurs fois, une fois le premier au niveau maximum.');

tz_def('BLACKSMITH', 'Forgeron');
tz_def('ACTION', 'Action');
tz_def('UPGRADE', 'Améliorer');
tz_def('UPGRADE_IN_PROGRESS', 'Amélioration en<br>cours');
tz_def('UPGRADE_BLACKSMITH', 'Améliorer la<br>forge');
tz_def('UPGRADES_COMMENCE_BLACKSMITH', 'Les améliorations pourront commencer une fois la forge terminée.');
tz_def('MAXIMUM_LEVEL', 'Niveau<br>Maximum');
tz_def('EXPAND_WAREHOUSE', 'Agrandissez<br>le d&eacute;p&ocirc;t');
tz_def('EXPAND_GRANARY', 'Agrandissez<br>le grenier');
tz_def('ENOUGH_RESOURCES', 'Ressources suffisantes');
tz_def('CROP_NEGATIVE ', 'La production de céréales est négative, vous n\'atteindrez jamais les ressources requises');
tz_def('TOO_FEW_RESOURCES', 'Pas assez de<br>ressources');
tz_def('UPGRADING', 'Amélioration');
tz_def('DURATION', 'Durée');
tz_def('COMPLETE', 'Terminé');
tz_def('BLACKSMITH_DESC', 'Les armes de vos guerriers sont améliorées dans les fours de la forge. En augmentant son niveau, vous pouvez ordonner la fabrication d\'armes encore meilleures.');

tz_def('ARMOURY', 'Armurerie');
tz_def('UPGRADE_ARMOURY', 'Améliorer<br>l\'armurerie');
tz_def('UPGRADES_COMMENCE_ARMOURY', 'Les améliorations pourront commencer une fois l\'armurerie terminée.');
tz_def('ARMOURY_DESC', 'L\'armure de vos guerriers est améliorée dans les fours de l\'armurerie. En augmentant son niveau, vous pouvez ordonner la fabrication d\'armures encore meilleures.');

tz_def('TOURNAMENTSQUARE', 'Place du Tournoi');
tz_def('CURRENT_SPEED', 'Bonus vitesse actuel :');
tz_def('SPEED_LEVEL', 'Bonus vitesse au niveau');
tz_def('TOURNAMENTSQUARE_DESC', 'Vos troupes peuvent augmenter leur endurance à la place du tournoi. Plus le bâtiment est amélioré, plus vos troupes sont rapides au-delà d\'une distance minimale de '.TS_THRESHOLD.' cases.');

tz_def('MAINBUILDING', 'Bâtiment Principal');
tz_def('CURRENT_CONSTRUCTION_TIME', 'Temps de construction actuel :');
tz_def('CONSTRUCTION_TIME_LEVEL', 'Temps de construction au niveau');
tz_def('DEMOLITION_BUILDING', 'Démolition de Bâtiments:</h2><p>Si vous n\'avez plus besoin d\'un bâtiment, vous pouvez le démolir.</p>');
tz_def('DEMOLISH', 'Démolir');
tz_def('DEMOLITION_OF', 'Démolition de ');
tz_def('MAINBUILDING_DESC', 'Les maîtres d\'œuvre du village habitent dans le bâtiment principal. Plus son niveau est élevé, plus vos maîtres d\'œuvre construisent rapidement de nouveaux bâtiments.');

tz_def('RALLYPOINT', 'Place de Rassemblement');
tz_def('RALLYPOINT_COMMENCE', 'Les mouvements de troupes seront affichés une fois le '.RALLYPOINT.' terminé.');
tz_def('OVERVIEW', 'Vue d\'ensemble');
tz_def('REINFORCEMENT', 'Renfort');
tz_def('EVASION_SETTINGS', 'Paramètres d\'évasion');
tz_def('SEND_TROOPS_AWAY_MAX', 'Envoyer les troupes au maximum');
tz_def('TIMES', 'fois');
tz_def('PER_EVASION', 'par évasion');
tz_def('RALLYPOINT_DESC', 'Les troupes de votre village se rassemblent ici. De là, vous pouvez les envoyer conquérir, piller ou renforcer d\'autres villages.<br>S\'il y a moins d\'unités attaquantes que le niveau de la place de rassemblement, vous pouvez voir le type d\'unité qui attaque.');
tz_def('COMBAT_SIMULATOR', 'Simulateur de combat');

tz_def('MARKETPLACE', 'Place du Marché');
tz_def('MERCHANT', 'Marchands');
tz_def('OR_', 'ou');
tz_def('GO', 'Lancer');
tz_def('UNITS_OF_RESOURCE', 'ressources');
tz_def('MERCHANT_CARRY', 'Chaque marchand peut transporter');
tz_def('MERCHANT_COMING', 'Marchands arrivant');
tz_def('TRANSPORT_FROM', 'Transport depuis');
tz_def('ARRIVAL_IN', 'Arrivée dans');
tz_def('NO_COORDINATES_SELECTED', 'Aucune coordonnée sélectionnée');
tz_def('CANNOT_SEND_RESOURCES', 'Vous ne pouvez pas envoyer de ressources vers le même village');
tz_def('BANNED_CANNOT_SEND_RESOURCES', 'Joueur banni. Vous ne pouvez pas lui envoyer de ressources');
tz_def('RESOURCES_NO_SELECTED', 'Ressources non sélectionnées');
tz_def('ENTER_COORDINATES', 'Saisissez les coordonnées ou le nom du village');
tz_def('TOO_FEW_MERCHANTS', 'Pas assez de marchands');
tz_def('OWN_MERCHANTS_ONWAY', 'Vos marchands en chemin');
tz_def('MERCHANTS_RETURNING', 'Retour de marchands');
tz_def('TRANSPORT_TO', 'Transport vers');
tz_def('I_AN_SEARCHING', 'Je recherche');
tz_def('I_AN_OFFERING', 'J\'offre');
tz_def('OFFERS_MARKETPLACE', 'Offres sur la place du marché');
tz_def('NO_AVAILABLE_OFFERS', 'Aucune offre sur la place du marché');
tz_def('OFFERED_TO_ME', 'Offert<br>par moi');
tz_def('WANTED_TO_ME', 'Demandé<br>par moi');
tz_def('NOT_ENOUGH_MERCHANTS', 'Pas assez de marchands');
tz_def('ACCEP_OFFER', 'Accepter l\'offre');
tz_def('NO_AVALIBLE_OFFERS', 'Il n\'y a aucune offre disponible sur le marché');
tz_def('SEARCHING', 'Reherche');
tz_def('OFFERING', 'Offre');
tz_def('MAX_TIME_TRANSPORT', 'Durée de transport max.');
tz_def('OWN_ALLIANCE_ONLY', 'Mon alliance uniquement');
tz_def('INVALID_OFFER', 'Offre Invalide');
tz_def('INVALID_MERCHANTS_REPETITION', 'Taux de répétition des marchands invalide');
tz_def('USER_ON_VACATION', 'Le joueur est en mode vacances');
tz_def('VACATION_MODE', 'Mode vacances');
tz_def('VACATION_DESC', 'Si vous prévoyez d\'être absent pendant une longue période et ne souhaitez pas désigner un co-gestionnaire, vous pouvez mettre votre compte en mode vacances. Pendant cette période, votre compte cessera de produire des ressources, points de culture, recherches, troupes, etc., et cessera de recevoir attaques, renforts et pillages, gelant essentiellement votre compte. Souvenez-vous que cela ne fige que votre Travian, pas le temps. Si vous êtes membre du Gold Club, il continuera à s\'écouler pendant cette période et si vous avez l\'auto-renouvellement activé, il sera annulé en mode vacances. Note : vous devez activer le mode vacances pour un minimum de 2 jours et un maximum de 14 jours.');
tz_def('VACATION_DESC2', 'Utilisez le mode vacances pour protéger vos villages pendant votre absence.<br>Pendant les vacances, les actions suivantes seront inactives :');
tz_def('VAC_OP1', 'Envoyer ou recevoir des troupes');
tz_def('VAC_OP2', 'Démarrer une nouvelle construction');
tz_def('VAC_OP3', 'Utiliser le marché');
tz_def('VAC_OP4', 'Entraîner de nouvelles troupes');
tz_def('VAC_OP5', 'Rejoindre une alliance');
tz_def('VAC_OP6', 'Supprimer le compte');
tz_def('VAC_COND1', 'Aucune troupe en mouvement');
tz_def('VAC_COND2', 'Aucune troupe en route vers d\'autres villages');
tz_def('VAC_COND3', 'Aucune troupe envoyée en renfort vers d\'autres villages');
tz_def('VAC_COND4', 'Aucun joueur n\'a de renforts dans vos villages');
tz_def('VAC_COND5', 'Ne pas posséder de Merveille du Monde');
tz_def('VAC_COND6', 'Ne posséder aucun artefact'); 
tz_def('VAC_COND7', 'Vous n\'êtes plus sous protection des débutants');
tz_def('VAC_COND8', 'Vous n\'avez aucune troupe dans vos pièges');
tz_def('VAC_COND9', 'Votre compte n\'est pas en cours de suppression');
tz_def('NOT_ENOUGH_RESOURCES', 'Pas assez de ressources');
tz_def('OFFER', 'Offre');
tz_def('SEARCH', 'Reherche');
tz_def('OWN_OFFERS', 'Mes offres');
tz_def('ALL', 'Tout');
tz_def('NPC_TRADE', 'Commerce NPC');
tz_def('SUM', 'Somme');
tz_def('REST', 'Reste');
tz_def('TRADE_RESOURCES', 'Échanger les ressources (étape 2 sur 2)');
tz_def('DISTRIBUTE_RESOURCES', 'Répartir les ressources (étape 1 sur 2)');
tz_def('OF', 'de');
tz_def('NPC_COMPLETED', 'NPC terminé');
tz_def('BACK_BUILDING', 'Retour à la construction');
tz_def('YOU_CAN_NAT_NPC_WW', 'Vous ne pouvez pas utiliser le commerce NPC dans le village merveille');
tz_def('NPC_TRADING', 'Commerce NPC');
tz_def('SEND_RESOURCES', 'Envoyer les Resources');
tz_def('BUY', 'Acheter');
tz_def('TRADE_ROUTES', 'Routes commerciales');
tz_def('DESCRIPTION', 'Description');
tz_def('G_DESCR', 'Description Générale');
tz_def('TIME_LEFT', 'Temps restant');
tz_def('START', 'Démarrer');
tz_def('NO_TRADE_ROUTES', 'Aucune route commerciale active');
tz_def('TRADE_ROUTE_TO', 'Route commerciale vers');
tz_def('CHECKED', 'vérifié');
tz_def('DAYS', 'jours');
tz_def('EXTEND', 'Prolonger');
tz_def('EDIT', 'Éditer');
tz_def('EXTEND_TRADE_ROUTES', 'Prolonger la route commerciale de <b>7</b> jours pour');
tz_def('CREATE_TRADE_ROUTES', 'Créer une nouvelle route commerciale');
tz_def('DELIVERIES', 'Livraisons');
tz_def('START_TIME_TRADE', 'Heure de départ');
tz_def('CREATE_TRADE_ROUTE', 'Créer une route commerciale');
tz_def('TARGET_VILLAGE', 'Village cible');
tz_def('EDIT_TRADE_ROUTES', 'Editer route commerciale');
tz_def('TRADE_ROUTES_DESC', 'Les routes commerciales vous permettent de définir des itinéraires pour vos marchands qui les parcourront chaque jour à une heure fixe.<br><br>Par défaut, cela dure <b>7</b> jours, mais vous pouvez prolonger de <b>7</b> jours pour le coût de');
tz_def('NPC_TRADE_DESC', 'Avec le commerce NPC, vous pouvez répartir les ressources de votre entrepôt comme vous le souhaitez.<br><br>La première ligne affiche le stock actuel. Dans la deuxième ligne, vous pouvez choisir une autre répartition. La troisième ligne affiche la différence entre l\'ancien et le nouveau stock.');
tz_def('MARKETPLACE_DESC', 'Sur la place du marché, vous pouvez échanger des ressources avec d\'autres joueurs. Plus son niveau est élevé, plus le nombre de marchands l\'est aussi.');

tz_def('EMBASSY', 'Ambassade');
tz_def('TAG', 'Tag');
tz_def('TO_THE_ALLIANCE', 'Vers l\'alliance');
tz_def('JOIN_ALLIANCE', 'Rejoindre l\'alliance');
tz_def('REFUSE', 'Refuser');
tz_def('ACCEPT', 'Accepter');
tz_def('NO_INVITATIONS', 'Aucune invitation disponible.');
tz_def('NO_CREATE_ALLIANCE', 'Un joueur banni ne peut pas créer d\'alliance.');
tz_def('FOUND_ALLIANCE', 'Fonder une alliance');
tz_def('EMBASSY_DESC', 'L\'ambassade est un lieu pour les diplomates. Au niveau 1, vous pouvez rejoindre une alliance, et à partir du niveau 3, vous pouvez même en fonder une vous-même.<br>Le nombre maximum de membres dans une alliance est 60.');

tz_def('BARRACKS', 'Caserne');
tz_def('QUANTITY', 'Quantité');
tz_def('MAX', 'Max');
tz_def('TRAINING', 'Entraînement');
tz_def('FINISHED', 'Terminé');
tz_def('UNIT_FINISHED', 'La prochaine unité sera terminée dans');
tz_def('AVAILABLE', 'Disponible');
tz_def('TRAINING_COMMENCE_BARRACKS', 'L\'entraînement pourra commencer une fois la caserne terminée.');
tz_def('BARRACKS_DESC', 'L\'infanterie peut être entraînée à la caserne. Plus son niveau est élevé, plus les troupes sont entraînées rapidement.');

tz_def('STABLE', 'Écurie');
tz_def('AVAILABLE_ACADEMY', 'Aucune unité disponible. Recherche à l\'académie requise');
tz_def('TRAINING_COMMENCE_STABLE', 'L\'entraînement pourra commencer une fois l\'écurie terminée.');
tz_def('STABLE_DESC', 'La cavalerie peut être entraînée à l\'écurie. Plus son niveau est élevé, plus les troupes sont entraînées rapidement.');

tz_def('WORKSHOP', 'Atelier');
tz_def('TRAINING_COMMENCE_WORKSHOP', 'L\'entraînement pourra commencer une fois l\'atelier terminé.');
tz_def('WORKSHOP_DESC', 'Les machines de siège, comme les catapultes et les béliers, peuvent être fabriquées à l\'atelier. Plus son niveau est élevé, plus les unités sont produites rapidement.');

tz_def('ACADEMY', 'Académie');
tz_def('RESEARCH_AVAILABLE', 'Aucune recherche disponible');
tz_def('RESEARCH_COMMENCE_ACADEMY', 'La recherche pourra commencer une fois l\'académie terminée.');
tz_def('RESEARCH', 'Recherche');
tz_def('EXPAND_WAREHOUSE1', 'Développer le dépôt');
tz_def('EXPAND_GRANARY1', 'Développer le grenier');
tz_def('RESEARCH_IN_PROGRESS', 'Recherche en<br>cours');
tz_def('RESEARCHING', 'Recherche');
tz_def('PREREQUISITES', 'Prérequis');
tz_def('SHOW_MORE', 'Afficher plus');
tz_def('HIDE_MORE', 'Masquer plus');
tz_def('ACADEMY_DESC', 'De nouveaux types d\'unités peuvent être recherchés à l\'académie. En augmentant son niveau, vous pouvez ordonner la recherche de meilleures unités.');

tz_def('CRANNY', 'Cachette');
tz_def('CURRENT_HIDDEN_UNITS', 'Ressources cachés actuelles (par ressource) :');
tz_def('HIDDEN_UNITS_LEVEL', 'Ressources cachés au niveau');
tz_def('UNITS', 'unités');
tz_def('CRANNY_DESC', 'La cachette dissimule une partie de vos ressources en cas d\'attaque du village. Ces ressources ne peuvent pas être volées.<br>Au niveau 1, la cachette peut contenir '.(100*((int)CRANNY_CAPACITY)).' de chaque ressource. La capacité des cachettes gauloises est 1,5 fois supérieure.<br>Si un héros germain attaque un village, les cachettes ne peuvent dissimuler que 80 % de leur capacité normale.');

tz_def('TOWNHALL', 'Hôtel De Ville');
tz_def('CELEBRATIONS_COMMENCE_TOWNHALL', 'Les fêtes pourront commencer une fois l\'hôtel de ville terminé.');
tz_def('GREAT_CELEBRATIONS', 'Grande fête');
tz_def('CULTURE_POINTS', 'Points de Culture');
tz_def('HOLD', 'Organiser');
tz_def('CELEBRATIONS_IN_PROGRESS', 'Fête</br>en cours');
tz_def('CELEBRATIONS', 'Fête');
tz_def('TOWNHALL_DESC', 'Vous pouvez organiser des célébrations pompeuses à l\'hôtel de ville. Une telle célébration augmente vos points de culture.<br>Les points de culture sont nécessaires pour fonder ou conquérir de nouveaux villages. Chaque bâtiment produit des points de culture, et plus son niveau est élevé, plus il en produit.<br>Construire votre hôtel de ville à un niveau supérieur diminuera la durée de la célébration.');

tz_def('RESIDENCE', 'Résidence');
tz_def('CAPITAL', 'C\'est votre Capitale');
tz_def('RESIDENCE_TRAIN_DESC', 'Pour fonder un nouveau village, il faut une résidence de niveau 10 ou 20 et 3 colons. Pour conquérir un nouveau village, il faut une résidence de niveau 10 ou 20 et un sénateur, un chef, ou un chef de tribu.');
tz_def('PRODUCTION_POINTS', 'Production de ce village :');
tz_def('PRODUCTION_ALL_POINTS', 'Production de tous les villages :');
tz_def('POINTS_DAY', 'Points de Culture par jour');
tz_def('VILLAGES_PRODUCED', 'Vos villages ont produit');
tz_def('POINTS_NEED', 'points au total. Pour fonder ou conquérir un nouveau village, vous avez besoin de');
tz_def('POINTS', 'points');
tz_def('INHABITANTS', 'Habitants');
tz_def('COORDINATES', 'Coordonnées');
tz_def('EXPANSION', 'Expansion');
tz_def('TRAIN', 'Entraîner');
tz_def('DATE', 'Date');
tz_def('CONQUERED_BY_VILLAGE', 'Villages fondés ou conquis par ce village');
tz_def('NONE_CONQUERED_BY_VILLAGE', 'Aucun village n\'a encore été fondé ou conquis par ce village.');
tz_def('RESIDENCE_CULTURE_DESC','Pour étendre votre empire, vous avez besoin de points de culture. Ces points de culture augmentent au fil du temps et le font plus rapidement lorsque les niveaux de votre bâtiment augmentent.');
tz_def('RESIDENCE_LOYALTY_DESC', 'En attaquant avec des sénateurs, des chefs ou des chefs de tribu, la loyauté d\'un village peut être réduite. S\'il atteint zéro, le village rejoint le royaume de l\'attaquant. La loyauté de ce village est actuellement à ');
tz_def('RESIDENCE_DESC', 'La résidence est un petit palais, où le roi ou la reine vit quand il visite le village. La résidence protège le village contre les ennemis qui veulent le conquérir. Vous pouvez construire une résidence par village. Les unités capables de fonder un nouveau village ou de conquérir des villages existants peuvent y être entraînées.<br>De plus, la résidence offre un emplacement d\'expansion aux niveaux 10 et 20.');

tz_def('PALACE', 'Palais');
tz_def('PALACE_CONSTRUCTION', 'Palais en construction');
tz_def('PALACE_TRAIN_DESC', 'Pour fonder un nouveau village, vous avez besoin d\'un palais de niveau 10, 15 ou 20 et de 3 colons. Pour conquérir un nouveau village, vous avez besoin d\'un palais de niveau 10, 15 ou 20 et d\'un sénateur, chef ou chef de tribu.');
tz_def('CHANGE_CAPITAL', 'Changer de Capitale');
tz_def('SECURITY_CHANGE_CAPITAL', 'Êtes-vous sûr de vouloir changer votre capitale ?<br><b>Cette action est irréversible !</b><br>Pour des raisons de sécurité, vous devez saisir votre mot de passe pour confirmer :<br /> ');
tz_def('PALACE_DESC', 'Le roi ou la reine de l\'empire vit dans le palais. Seul un palais peut exister dans votre royaume. Vous avez besoin d\'un palais pour proclamer un village comme capitale. Il protège aussi le village contre les conquêtes ennemies. Les unités capables de fonder un nouveau village ou de conquérir des villages existants peuvent y être entraînées.<br>De plus, le palais offre un emplacement d\'expansion aux niveaux 10, 15 et 20.');

tz_def('TREASURY', 'Chambre du Trésor');
tz_def('TREASURY_COMMENCE', 'Les artefacts peuvent être consultés une fois la chambre du trésor terminée.');
tz_def('ARTEFACTS_AREA', 'Artefacts dans votre zone');
tz_def('NO_ARTEFACTS_AREA', 'Il n\'y a aucun artefact dans votre zone.');
tz_def('OWN_ARTEFACTS', 'Mes Artéfacts');
tz_def('CONQUERED', 'Conquis');
tz_def('DISTANCE', 'Distance');
tz_def('EFFECT', 'Effet');
tz_def('ACCOUNT', 'Compte');
tz_def('SMALL_ARTEFACTS', 'Petits Artéfacts');
tz_def('LARGE_ARTEFACTS', 'Grands Artéfacts');
tz_def('NO_ARTEFACTS', 'Il n\'y a pas d\'Artéfacts');
tz_def('ANY_ARTEFACTS', 'Vous ne possédez aucun Artéfact.');
tz_def('OWNER', 'Propriétaire');
tz_def('AREA_EFFECT', 'Zone d\'effet');
tz_def('VILLAGE_EFFECT', 'Effet sur le Village');
tz_def('ACCOUNT_EFFECT', 'Effet sur le compte');
tz_def('UNIQUE_EFFECT', 'Effet Unique');
tz_def('REQUIRED_LEVEL', 'Niveau requis');
tz_def('TIME_CONQUER', 'Date de conquête');
tz_def('TIME_ACTIVATION', 'Date d\'activation');
tz_def('NEXT_EFFECT', ' Effet suivant');
tz_def('FORMER_OWNER', 'Ancien(s) propriétaire(s)');
tz_def('BUILDING_STRONGER', 'Construire plus solidement avec');
tz_def('BUILDING_WEAKER', 'Construire moins solidement avec');
tz_def('TROOPS_FASTER', 'Rendre les troupes plus rapides avec');
tz_def('TROOPS_SLOWEST', 'Rendre les troupes plus lentes avec');
tz_def('SPIES_INCREASE', 'Augmenter la capacité des espions avec');
tz_def('SPIES_DECRESE', 'Diminuer la capacité des espions avec');
tz_def('CONSUME_LESS', 'Toutes les troupes consomment moins avec');
tz_def('CONSUME_HIGH', 'Toutes les troupes consomment plus avec');
tz_def('TROOPS_MAKE_FASTER', 'Les troupes sont produites plus vite avec');
tz_def('TROOPS_MAKE_SLOWEST', 'Les troupes sont produites plus lentement avec');
tz_def('YOU_CONSTRUCT', 'Vous pouvez construire ');
tz_def('CRANNY_INCREASED', 'La capacité de la cachette est augmentée de');
tz_def('CRANNY_DECRESE', 'La capacité de la cachette est diminuée de');
tz_def('WW_BUILDING_PLAN', 'Vous pouvez construire la Merveille du monde');
tz_def('NO_WW', 'Il n\'y a aucune Merveille du monde');
tz_def('NO_PREVIOUS_OWNERS', 'Il n\'y a aucun propriétaire précédent.');
tz_def('TREASURY_DESC', 'Les richesses de votre empire sont conservées dans la Chambre du Trésor. La Chambre du Trésor ne peut contenir qu\'un seul artefact à la fois.<br>Vous avez besoin d\'une Chambre au Trésor de niveau 10 pour un petit artefact, ou de niveau 20 pour un grand. Après avoir capturé un Artéfact, il faut 24 heures sur un serveur normal ou 12 heures sur un serveur trois fois plus rapide pour être efficace.');

tz_def('TRADEOFFICE', 'Comptoir de Commerce');
tz_def('CURRENT_MERCHANT', 'Les marchands transportent actuellement :');
tz_def('MERCHANT_LEVEL', 'Les marchands transporteront au niveau');
tz_def('TRADEOFFICE_DESC', 'Dans le Comptoir de Commerce, les charrettes des marchands sont améliorées et équipées de puissants chevaux. Plus son niveau est élevé, plus vos marchands sont capables de transporter.');

tz_def('GREATBARRACKS', 'Grande Caserne');
tz_def('TRAINING_COMMENCE_GREATBARRACKS', 'L\'entraînement pourra commencer une fois la grande caserne terminée.');
tz_def('GREATBARRACKS_DESC', 'La grande caserne vous permet de construire une deuxième caserne dans le même village, mais les troupes coûtent 3 fois le montant initial.<br>Combinée avec la caserne normale, vous pouvez entraîner vos troupes deux fois plus vite dans un village.');

tz_def('GREATSTABLE', 'Grande Écurie');
tz_def('TRAINING_COMMENCE_GREATSTABLE', 'L\'entraînement pourra commencer une fois la grande écurie terminée.');
tz_def('GREATSTABLE_DESC', 'La grande écurie vous permet de construire une deuxième écurie dans le même village, mais les troupes coûtent 3 fois le montant initial.<br>Combinée avec l\'écurie normale, vous pouvez entraîner vos troupes deux fois plus vite dans un village.');

tz_def('CITYWALL', "Mur d'Enceinte");
tz_def('DEFENCE_NOW', 'Bonus de Défense actuel :');
tz_def('DEFENCE_LEVEL', 'Bonus de défense au niveau');
tz_def('CITYWALL_DESC', 'Fournit un bonus de défense pour vos troupes (((1,03 ^ niveau) * 100) % + 10) points défensifs par niveau à la valeur défensive de base d\'un village. Plus le niveau de la muraille est élevé, plus le bonus de défense de vos troupes est élevé.<br>Spécifique à la tribu : Romains uniquement.');

tz_def('EARTHWALL', 'Mur de Terre');
tz_def('EARTHWALL_DESC', 'Fournit un bonus de défense pour vos troupes (((1,02 ^ niveau) * 100) % + 6) points défensifs par niveau à la valeur défensive de base d\'un village. Plus le niveau du talus est élevé, plus le bonus de défense de vos troupes est élevé.<br>Spécifique à la tribu : Germains uniquement.');

tz_def('PALISADE', 'Palissade');
tz_def('PALISADE_DESC', 'Fournit un bonus de défense pour vos troupes (((1,025 ^ niveau) * 100) % + 8) points défensifs par niveau à la valeur défensive de base d\'un village. Plus le niveau de la palissade est élevé, plus le bonus de défense de vos troupes est élevé.<br>Spécifique à la tribu : Gaulois uniquement.');

tz_def('STONEMASON', 'Atelier du Tailleur de Pierre');
tz_def('CURRENT_STABILITY', 'Bonus de résistance actuel :');
tz_def('STABILITY_LEVEL', 'Bonus de résistance au niveau');
tz_def('STONEMASON_DESC', 'Le tailleur de pierre est un expert en taille de pierre. Plus le bâtiment est développé, plus la stabilité des bâtiments du village est élevée. À chaque niveau, ce bâtiment augmente la durabilité de 10 % jusqu\'à un maximum de 200 % de durabilité pour vos bâtiments.<br>Ce bâtiment ne peut être construit que dans la capitale d\'un empire.');

tz_def('BREWERY', 'Brasserie');
tz_def('CURRENT_BONUS', 'Bonus actuel :');
tz_def('WATERWORKS_HINT', '(Amélioré par le Réservoir d\'eau)');
tz_def('WATERWORKS_AFFECTED', 'Les oasis annexées bénéficient de ce bonus.');
tz_def('OASIS_EFFECTIVE_BONUS', 'Bonus d\'oasis effectif :');
tz_def('BONUS_LEVEL', 'Bonus au niveau');
tz_def('BREWERY_DESC', 'Un savoureux hydromel est brassé ici. Les boissons rendent vos soldats plus braves et plus forts lors d\'attaques (1 % par niveau de brasserie). Malheureusement, le pouvoir de persuasion des chefs est réduit de 50 % et les catapultes ne peuvent faire que des tirs aléatoires. Ne peut être construite que dans la capitale, mais affecte tous vos villages. Les festivals d\'hydromel durent toujours 72 heures.<br>Spécifique à la tribu : Germains uniquement.');
tz_def('MEAD_FESTIVAL', 'Festival de l\'hydromel');
tz_def('MEAD_FESTIVAL_IN_PROGRESS', 'Festival de l\'hydromel<br>en cours');
tz_def('MEAD_FESTIVAL_COMMENCE_BREWERY', 'Le festival de l\'hydromel peut commencer une fois la brasserie terminée.');

tz_def('TRAPPER', 'Fabricant de Pièges');
tz_def('CURRENT_TRAPS', 'Nombre maximum de pièges actuellement :');
tz_def('TRAPS_LEVEL', 'Nombre maximum de pièges au niveau');
tz_def('TRAPS', 'Pièges');
tz_def('TRAP', 'Piège');
tz_def('CURRENT_HAVE', 'Vous avez actuellement');
tz_def('WHICH_OCCUPIED', 'occupés.');
tz_def('TRAINING_COMMENCE_TRAPPER', 'Poser des pièges n\'est possible que lorsque le Fabricant de pièges est terminé.');
tz_def('TRAPPER_DESC', 'Le fabricant de pièges protège votre village avec des pièges bien cachés. Cela signifie que des ennemis imprudents peuvent être emprisonnés et ne pourront plus nuire à votre village.<br>Les troupes ne peuvent pas être libérées par un pillage. Si le propriétaire des pièges libère les captifs, tous les pièges seront réparés automatiquement.<br>Spécifique à la tribu : Gaulois uniquement.');

tz_def('HEROSMANSION', 'Manoir du Héros');
tz_def('HERO_READY', 'Le Héros sera prêt dans ');
tz_def('NAME_CHANGED', 'Le nom du Héros a été modifié');
tz_def('NOT_UNITS', 'Aucune unité disponible');
tz_def('NOT', 'Non ');
tz_def('TRAIN_HERO', 'Entrainer un nouveau Héros');
tz_def('REVIVE', 'Réssusciter');
tz_def('OASES', 'Oasis');
tz_def('DELETE', 'Supprimer');
tz_def('RESOURCES', 'Ressources');
tz_def('OFFENCE', 'Attaque');
tz_def('DEFENCE', 'Défense');
tz_def('OFF_BONUS', 'Bonus Off');
tz_def('DEF_BONUS', 'Bonus Déf');
tz_def('REGENERATION', 'Régénération');
tz_def('DAY', 'Jour');
tz_def('EXPERIENCE', 'Expérience');
tz_def('YOU_CAN', 'Vous pouvez ');
tz_def('RESET', 'réinitialiser');
tz_def('YOUR_POINT_UNTIL', ' vos points jusqu\'à atteindre le niveau ');
tz_def('OR_LOWER', ' ou inférieur !');
tz_def('YOUR_HERO_HAS', 'Votre héros a ');
tz_def('OF_HIT_POINTS', 'de ses points de vie.');
tz_def('ERROR_NAME_SHORT', 'Erreur : nom trop court');
tz_def('HEROSMANSION_DESC', 'Dans le manoir du héros, vous pouvez former votre propre héros et aux niveaux 10, 15 et 20, vous pouvez conquérir des oasis avec ce Héros dans les environs immédiats. Selon l\'oasis, vous obtiendrez une augmentation de production d\'un certain type de ressource (voire deux ressources pour certaines oasis).');

tz_def('GREATWAREHOUSE', 'Grand Dépôt');
tz_def('GREATWAREHOUSE_DESC', 'Le grand dépôt a 3 fois la capacité d\'un dépôt normal.<br>Ce bâtiment ne peut être construit que dans les villages de Merveille du monde ou avec un artefact natarien spécial.');

tz_def('GREATGRANARY', 'Grand Grenier');
tz_def('GREATGRANARY_DESC', 'Le grand grenier a 3 fois la capacité d\'un grenier normal.<br>Ce bâtiment ne peut être construit que dans les villages de Merveille du monde ou avec un artefact natarien spécial.');

tz_def('WONDER', 'Merveille Du Monde');
tz_def('WORLD_WONDER', 'Merveille');
tz_def('WONDER_DESC', 'Une Merveille du monde (aussi appelée WW) est aussi impressionnante qu\'elle en a l\'air. Chaque niveau coûte beaucoup de ressources. Il est presque impossible pour un seul joueur de construire une WW seul. La raison est que vous n\'avez pas seulement besoin de beaucoup de ressources, mais aussi de troupes pour protéger votre précieux bâtiment.<br>Pour construire une WW, vous avez besoin d\'un plan de construction antique. Vous pouvez l\'obtenir en attaquant un village Natar avec votre héros. Vous devez avoir une trésorerie vide de niveau 10 et votre héros doit survivre. Avec ces plans et un très haut niveau de ressources, vous pouvez démarrer la merveille.<br>Une fois au niveau 50, vous aurez besoin que quelqu\'un d\'autre dans votre alliance possède un deuxième plan actif. Vous ne pouvez pas tout faire vous-même.<br>Terminer une WW niveau 100, vous gagnerez le serveur Travian et c\'est la fin d\'un monde de jeu.<br>Une fois terminé, un message s\'affichera disant qui a gagné et les statistiques. Vous ne pouvez plus construire, mais vous pouvez envoyer des messages aux gens jusqu\'au redémarrage du serveur.');
tz_def('WORLD_WONDER_CHANGE_NAME', 'Vous devez avoir une Merveille niveau 1 pour pouvoir changer de nom.');
tz_def('WORLD_WONDER_NAME', 'Nom de la Merveille');
tz_def('WORLD_WONDER_NOTCHANGE_NAME', 'Vous ne pouvez pas changer le nom de la Merveille après le niveau 10');
tz_def('WORLD_WONDER_NAME_CHANGED', 'Nom changé');

tz_def('HORSEDRINKING', 'Abreuvoir');
tz_def('HORSEDRINKING_DESC', 'Diminue le temps d\'entraînement et l\'entretien de la cavalerie. Peut aussi être construit dans les villages de Merveille du monde des Romains.<br>Accélère le temps d\'entraînement des unités de cavalerie de 1 % par niveau et réduit la consommation de céréales de certaines unités selon son niveau.<br>Spécifique à la tribu : Romains uniquement.');

tz_def('GREATWORKSHOP', 'Grand Atelier');
tz_def('TRAINING_COMMENCE_GREATWORKSHOP', 'L\'entraînement pourra commencer une fois le grand atelier terminé.');
tz_def('GREATWORKSHOP_DESC', 'Le grand atelier vous permet de construire un deuxième atelier dans le même village, mais les catapultes et béliers coûtent 3 fois le montant initial.<br>Combiné avec l\'atelier normal, vous pouvez entraîner vos troupes deux fois plus vite dans un village.');

tz_def('STONEWALL', 'Mur de Pierre');
tz_def('STONEWALL_DESC', 'Le mur de pierre protège votre village contre les attaques d\'autres joueurs. Sa construction solide confère un bonus de défense élevé.<br>Spécifique à la tribu : Égyptiens uniquement');
tz_def('MAKESHIFTWALL', 'Mur de Fortune');
tz_def('MAKESHIFTWALL_DESC', 'Le mur de fortune offre une protection de base pour votre village. Il est peu coûteux et rapide à construire, mais n\'offre qu\'un faible bonus de défense.<br>Spécifique à la tribu : Huns uniquement');
tz_def('COMMANDCENTER', 'Centre de Commandement');
tz_def('COMMANDCENTER_TRAIN_DESC', 'Vous devez atteindre au moins le niveau 10 pour former des colons et des chefs dans le centre de commandement.');
tz_def('COMMANDCENTER_CULTURE_DESC', 'Les points de culture déterminent combien de villages vous pouvez fonder ou conquérir.');
tz_def('COMMANDCENTER_LOYALTY_DESC', 'Le centre de commandement protège le village contre les chefs ennemis. Loyauté actuelle :');
tz_def('COMMANDCENTER_DESC', 'Le centre de commandement est le siège du pouvoir d\'un village hun. Il vous permet de former des colons et des chefs ainsi que de contrôler votre expansion sans avoir besoin d\'une résidence ou d\'un palais.<br>Spécifique à la tribu : Huns uniquement');
tz_def('WATERWORKS', 'Réservoir d\'eau');
tz_def('WATERWORKS_DESC', 'Le réservoir d\'eau augmentent de 5 % par niveau le bonus apporté par les oasis annexées à ce village.<br>Spécifique à la tribu : Égyptiens uniquement');
tz_def('HOSPITAL', 'Hôpital');
tz_def('HOSPITAL_DESC', 'L\'hôpital soigne vos troupes blessées. Une partie des unités perdues lors de la défense ou de l\'attaque peut y être soignée au lieu d\'être perdue à jamais. Les niveaux supérieurs réduisent le temps de guérison.');
tz_def('DEFENSIVEWALL', 'Mur Défensif');
tz_def('DEFENSIVEWALL_DESC', 'Le mur défensif protège votre village contre les attaques d\'autres joueurs. Construit dans la tradition des grandes fortifications spartiates, il confère un bonus de défense important.<br>Spécifique à la tribu : Spartiates uniquement');
tz_def('BIGHOSPITAL', 'Grand hôpital');
tz_def('BIGHOSPITAL_DESC', 'Le Grand hôpital est une version améliorée de l\'hôpital ; il permet de soigner un plus grand nombre de vos troupes blessées après la bataille. Les niveaux supérieurs réduisent le temps de soin.<br>Spécifique à la tribu : Spartiates et Vikings uniquement');
tz_def('BARRICADE', 'Barricade');
tz_def('HEALING_TIME_NOW', 'Temps de soin actuel');
tz_def('WOUNDED_TROOPS', 'Troupes blessées');
tz_def('NO_WOUNDED', 'Aucune troupe blessée à l\'hôpital.');
tz_def('HEAL_BUTTON', 'Soigner');
tz_def('HEAL_COST_HINT', 'Le soin coûte 50 % du coût d\'entraînement de l\'unité.');
tz_def('HEALING_IN_PROGRESS', 'Soin en cours');
tz_def('MANUAL_UDESC_51', 'Le Guerrier hun constitue l\'épine dorsale de l\'infanterie hunnique. Peu coûteux et rapide à entraîner, c\'est un soldat polyvalent tout à fait correct pour les premiers raids et la défense de base.');
tz_def('MANUAL_UDESC_52', 'Le Cavalier éclaireur espionne les villages ennemis à grande vitesse. Il ne peut être repéré que par d\'autres éclaireurs et ne porte aucune arme de combat.');
tz_def('MANUAL_UDESC_53', 'L\'Archer monté décoche des flèches mortelles depuis sa monture. C\'est une unité de raid rapide offrant un bon équilibre entre puissance d\'attaque et capacité de transport.');
tz_def('MANUAL_UDESC_54', 'Le Cavalier des steppes est un escarmoucheur véloce des plaines. Sa rapidité en fait l\'unité idéale pour des raids éclairs sur des villages sans défense.');
tz_def('MANUAL_UDESC_55', 'Le Lancier hun charge avec une lourde lance. Une puissante unité de cavalerie offensive capable également de tenir tête à la cavalerie ennemie.');
tz_def('MANUAL_UDESC_56', 'Le Cavalier d\'élite est la fierté de la horde hunnique. Extrêmement puissant en attaque, il écrase tout sur son passage, mais son entraînement est coûteux.');
tz_def('MANUAL_UDESC_57', 'Le bélier est une lourde machine de guerre destinée à démolir les murailles ennemies. Protégez-le bien, car il est lent et sans défense s\'il est seul.');
tz_def('MANUAL_UDESC_58', 'La catapulte projette des pierres à grande distance pour détruire les bâtiments et les champs ennemis. Elle doit être bien protégée par d\'autres troupes.');
tz_def('MANUAL_UDESC_59', 'Le chef de tribu réduit la loyauté des villages ennemis grâce à sa présence redoutable, jusqu\'à ce qu\'ils rejoignent la horde des Huns.');
tz_def('MANUAL_UDESC_60', 'Les colons sont de courageux sujets qui partent fonder un nouveau village pour les Huns. Il en faut trois, accompagnés de vivres.');
tz_def('MANUAL_UDESC_61', 'L\'esclave armé est peu coûteux et rapide à former. Faible individuellement, il peut submerger les défenses à moindre coût lorsqu\'il est déployé en grand nombre.');
tz_def('MANUAL_UDESC_62', 'Le guerrier égyptien est un solide fantassin au service du pharaon, utile aussi bien pour l\'attaque que pour la défense du royaume.');
tz_def('MANUAL_UDESC_63', 'Le gardien du temple protège les lieux saints d\'Égypte. C\'est une excellente unité défensive contre l\'infanterie ennemie.');
tz_def('MANUAL_UDESC_64', 'L\'éclaireur à cheval chevauche en avant de l\'armée pour espionner les villages ennemis. Seuls les éclaireurs ennemis peuvent l\'arrêter ou le repérer.');
tz_def('MANUAL_UDESC_65', 'Le char parcourt le champ de bataille à toute allure, fauchant l\'infanterie. C\'est une puissante unité de cavalerie défensive de l\'armée égyptienne.');
tz_def('MANUAL_UDESC_66', 'Le char royal transporte l\'élite de l\'armée égyptienne. Dévastateur en attaque, il est aussi un symbole de la puissance du pharaon.');
tz_def('MANUAL_UDESC_67', 'Le bélier est une lourde machine de guerre destinée à démolir les murailles ennemies. Protégez-le bien, car elle est lente et sans défense si elle est isolée.');
tz_def('MANUAL_UDESC_68', 'La catapulte projette des pierres à grande distance pour détruire les bâtiments et les champs ennemis. Elle doit être bien protégée par d\'autres troupes.');
tz_def('MANUAL_UDESC_69', 'Le Nomarque persuade les villages ennemis à l\'aide de cadeaux et de discours, réduisant leur loyauté jusqu\'à ce qu\'ils rejoignent l\'Empire Égyptien.');
tz_def('MANUAL_UDESC_70', 'Les colons sont de courageux sujets qui partent fonder un nouveau village pour l\'Égypte. Il en faut trois, accompagnés de provisions.');
tz_def('MANUAL_UDESC_71', 'L\'hoplite spartiate combat au sein de la célèbre phalange. C\'est un fantassin polyvalent hors pair, aussi redoutable en attaque qu\'en défense.');
tz_def('MANUAL_UDESC_72', 'Le guerrier de l\'Agogé a été élevé pour la guerre dès l\'enfance. C\'est un défenseur robuste et peu coûteux de la patrie spartiate.');
tz_def('MANUAL_UDESC_73', 'Les Homoioi sont les « égaux », des citoyens spartiates à part entière. Une infanterie lourde dotée d\'une puissance d\'attaque redoutable.');
tz_def('MANUAL_UDESC_74', 'L\'éclaireur Périèque observe les mouvements ennemis pour le compte de Sparte. Seuls les éclaireurs ennemis peuvent le repérer ou l\'arrêter.');
tz_def('MANUAL_UDESC_75', 'Le Cavalier Spartiate patrouille aux frontières de la Laconie. Une unité de cavalerie rapide aux caractéristiques de combat équilibrées.');
tz_def('MANUAL_UDESC_76', 'Les Cavaliers Elpida constituent la garde royale des rois de Sparte. Une cavalerie d\'élite qui excelle en attaque.');
tz_def('MANUAL_UDESC_77', 'Le bélier est une machine de guerre lourde destinée à enfoncer les murailles ennemies. Protégez-le bien, car il est lent et sans défense s\'il est isolé.');
tz_def('MANUAL_UDESC_78', 'La catapulte projette des pierres à grande distance pour détruire les bâtiments et les champs ennemis. Elle doit être bien protégée par d\'autres troupes.');
tz_def('MANUAL_UDESC_79', 'L\'Éphore s\'exprime avec l\'autorité de Sparte, réduisant la loyauté des villages ennemis jusqu\'à ce qu\'ils se soumettent');
tz_def('MANUAL_UDESC_80', 'Les colons sont de courageux sujets qui partent fonder un nouveau village pour Sparte. Il en faut trois, accompagnés de provisions.');
tz_def('MANUAL_UDESC_81', 'Le pillard viking vit pour le pillage. Rapide à former et toujours prêt à prendre la mer pour le prochain raid.');
tz_def('MANUAL_UDESC_82', 'L\'éclaireur viking s\'infiltre discrètement en territoire ennemi pour recueillir des informations. Seuls les éclaireurs ennemis peuvent le repérer.');
tz_def('MANUAL_UDESC_83', 'Le guerrier à la hache manie sa grande hache avec une force brutale. Une puissante unité d\'infanterie offensive du Nord.');
tz_def('MANUAL_UDESC_84', 'Le berserker combat dans une frénésie guerrière, ne craignant ni la douleur ni la mort. Dévastateur en attaque, mais vulnérable en défense.');
tz_def('MANUAL_UDESC_85', 'Le cavalier viking allie la robustesse du Nord à la vitesse d\'un cheval. Une unité de cavalerie polyvalente.');
tz_def('MANUAL_UDESC_86', 'Le huscarl est le garde du corps attitré du Jarl. Une unité d\'élite de cavalerie lourde, redoutée sur toutes les mers.');
tz_def('MANUAL_UDESC_87', 'Le bélier est une lourde machine de guerre destinée à briser les murs ennemis. Protégez-le bien, car il est lent et sans défense s\'il est seul.');
tz_def('MANUAL_UDESC_88', 'La catapulte projette des pierres à grande distance pour détruire les bâtiments et les champs ennemis. Elle doit être bien protégée par d\'autres troupes.');
tz_def('MANUAL_UDESC_89', 'Le Jarl soumet les villages ennemis à sa volonté, réduisant leur loyauté jusqu\'à ce qu\'ils prêtent allégeance au Nord.');
tz_def('MANUAL_UDESC_90', 'Les colons sont de courageux sujets qui partent fonder un nouveau village pour les Vikings. Il en faut trois, accompagnés de provisions.');
tz_def('HEALING_TIME_LEVEL', 'Temps de guérison au niveau');
tz_def('BARRICADE_DESC', 'La barricade protège votre village contre les attaques des autres joueurs. Sa structure en bois multicouche confère un solide bonus de défense.<br>Spécifique à la tribu : Vikings uniquement');

tz_def('BUILDING_MAX_LEVEL_UNDER', 'Bâtiment au niveau maximum atteint');
tz_def('BUILDING_BEING_DEMOLISHED', 'Bâtiment en cours de démolition');
tz_def('COSTS_UPGRADING_LEVEL', 'Coûts </b> pour passer au niveau');
tz_def('WORKERS_ALREADY_WORK', 'Tous les ouvriers sont déjà au travail');
tz_def('CONSTRUCTING_MASTER_BUILDER', 'Construire avec le Maître constucteur');
tz_def('COSTS', 'Coûts');
tz_def('WORKERS_ALREADY_WORK_WAITING', 'Tous les ouvriers sont déjà au travail. (File d\'attente)');
tz_def('ENOUGH_FOOD_EXPAND_CROPLAND', 'Pas assez de nourriture. Développer un champ de céréales.');
tz_def('UPGRADE_WAREHOUSE', 'Développer dépôt');
tz_def('UPGRADE_GRANARY', 'Développer grenier');
tz_def('YOUR_CROP_NEGATIVE', "Votre production de céréales est négative, vous n’obtiendrez jamais les ressources nécessaires.");
tz_def('UPGRADE_LEVEL', 'Monter au niveau ');
tz_def('WAITING', '(file d\'attente)');
tz_def('NEED_WWCONSTRUCTION_PLAN', 'Plan de construction de merveille requis');
tz_def('NEED_MORE_WWCONSTRUCTION_PLAN', 'Plan de construction de la Merveille nécessaire');
tz_def('CONSTRUCT_NEW_BUILDING', 'Construire un nouveau bâtiment');
tz_def('SHOWSOON_AVAILABLE_BUILDINGS', 'Afficher les bâtiments bientôt disponibles');
tz_def('HIDESOON_AVAILABLE_BUILDINGS', 'Masquer les bâtiments bientôt disponibles');

// gold plus
tz_def('GOLD_SHOP', 'Gold Shop');
tz_def('PACKAGE_A', 'Pack A');
tz_def('PACKAGE_B', 'Pack B');
tz_def('PACKAGE_C', 'Pack C');
tz_def('PACKAGE_D', 'Pack D');
tz_def('PACKAGE_E', 'Pack E');
tz_def('PAYMENT_METHOD', 'Méthode de paiement');
tz_def('PACKAGES_NOT_REFUND', 'Aucun des forfaits n\'est remboursable');
tz_def('PLUS_FUNC', 'Fonction Plus');
tz_def('REMAINING', 'Restant');
tz_def('MINS', 'min');
tz_def('ACTIVATE', 'Activer');
tz_def('TOO_LITTLE_GOLD', 'Pas assez d\'or');
tz_def('GOLD_ON', 'Activé'); // "attack on" and "gold feature on" can be not the same in different languages
tz_def('PLUS_END', 'Vos avantages PLUS sont terminés');
tz_def('NPC', 'NPC');
tz_def('NO_GOLD', 'Vous ne possédez pas d\'or');
tz_def('GOLD_CLUB', 'Gold Club');
tz_def('NOW', 'maintenant');
tz_def('NPC_TRADE_GOLD', 'Échange NPC');
tz_def('COMPLETE_CONSTRUCTION_R_GOLD', 'Terminer les constructions et les recherches dans ce village maintenant (ne fonctionne pas pour le Palais et la Résidence)');
tz_def('FOR_GAME_SERVER', 'Partie entière');
tz_def('HAVE_NO_INVITED', 'Vous n\'avez pas encore invité de nouveaux joueurs');
tz_def('INVITE_FRIENDS_GOLD', 'Inviter des amis et recevoir de l\'or gratuitement');
tz_def('NEED_MORE_GOLD', 'Il vous faut plus d\'or');
tz_def('ADD_PLUS_FAIL', 'Tentative PLUS échouée');
tz_def('ADD_BONUS_LUMBER_FAIL', 'Tentative de bois échouée');
tz_def('ADD_BONUS_CLAY_FAIL', 'Tentative d\'argile échouée');
tz_def('ADD_BONUS_IRON_FAIL', 'Tentative de fer échouée');
tz_def('ADD_BONUS_CROP_FAIL', 'Tentative de récolte échouée');
tz_def('SELECT_GOLD_OPTION', 'Veuillez sélectionner l\'option que vous souhaitez activer ou prolonger');
tz_def('GET_NOW', 'Obtenir maintenant');
tz_def('BUY_NOW', 'Acheter maintenant');
tz_def('SELECT_REWARD', 'Sélectionner une récompense');
tz_def('VIP_ACCOUNT', 'Compte VIP');
tz_def('USER_NOT_EXISTS', 'Le nom de compte que vous avez saisi n\'existe pas');
tz_def('STATUT_STATUS_UPDATED', 'Votre statut a été mis à jour');

// profile
tz_def('PREFERENCES', 'Préférences');
tz_def('VACATION', 'Vacances');
tz_def('ACTIVATE_VACATION', 'Activer le mode vacances');
tz_def('GRAPH_PACK', 'Pack graphique');
tz_def('PLAYER_PROFILE', 'Profil du joueur');
tz_def('CHANGE_PASSWORD', 'Changer le mot de passe');
tz_def('OLD_PASSWORD', 'Ancien mot de passe');
tz_def('NEW_PASSWORD', 'Nouveau mot de passe');
tz_def('CHANGE_EMAIL', 'Changer l\'adresse e-mail');
tz_def('CHANGE_EMAIL2', 'Veuillez saisir votre ancienne et votre nouvelle adresse e-mail. Vous recevrez ensuite un extrait de code à ces deux adresses, que vous devrez saisir ici');
tz_def('CURRENT_EMAIL', 'E-mail actuel');
tz_def('OLD_EMAIL', 'Ancienne adresse e-mail');
tz_def('NEW_EMAIL', 'Nouvel e-mail');
tz_def('ACCOUNT_SITTERS', 'Co-gestionnaires du compte');
tz_def('ACCOUNT_SITTERS2', 'Un co-gestionnaire peut se connecter à votre compte en utilisant votre nom et son mot de passe. Vous pouvez avoir jusqu\'à deux co-gestionnaires');
tz_def('SITTER_NAME', 'Nom du co-gestionnaire');
tz_def('NO_SITTERS', 'Vous n\'avez aucun co-gestionnaire');
tz_def('RM_SITTER', 'Supprimer le co-gestionnaire');
tz_def('YOU_ARE_SITTER', 'Vous avez été enregistré comme co-gestionnaire sur les comptes suivants. Vous pouvez annuler cela en cliquant sur la croix rouge');
tz_def('DELETE_ACCOUNT', 'Supprimer le compte');
tz_def('DELETE_ACCOUNT2', 'Vous pouvez supprimer votre compte ici. La suppression de votre compte prendra trois jours. Vous pouvez annuler cette opération dans les 24 heures.');
tz_def('YES', 'Oui');
tz_def('NO', 'Non');
tz_def('CONFIRM_W_PASS', 'Confirmer avec le mot de passe');
tz_def('MEDALS', 'Médailles');
tz_def('PLAYER_HAS', 'Ce joueur possède'); // bird 1
tz_def('HOURS_OF_BG_PROT', 'Heures de protection débutant restantes'); // bird 1
tz_def('PLAYER_WAS_REG_ON', 'Ce joueur a enregistré son compte le'); // bird 2
tz_def('NATARS_ACC', 'Compte Natar officiel'); // Natars
tz_def('WW_V_M', 'Village officiel des Merveilles du Monde'); // WW Village
tz_def('ROMAN_T_M', 'Les Romains : Grâce à leur haut niveau de développement social et technologique, les Romains excellent dans la construction et sa coordination. De plus, leurs troupes font partie de l\'élite de Travian. Elles sont très équilibrées et efficaces en attaque comme en défense'); // roman tribe medal
tz_def('TEUTON_T_M', 'Les Teutons : Les Teutons sont la tribu la plus agressive. Leurs troupes sont réputées et craintes pour leur rage et leur frénésie lors des attaques. Ils se déplacent comme une horde de pillards, sans même craindre la mort.'); // teuton tribe medal
tz_def('GAUL_T_M', 'Les Gaulois : Les Gaulois sont la plus pacifique des trois tribus de Travian. Leurs troupes sont entraînées pour une excellente défense, mais leur capacité d\'attaque n\'a rien à envier aux deux autres tribus. Les Gaulois sont des cavaliers nés et leurs chevaux sont célèbres pour leur vitesse. Cela signifie que leurs cavaliers peuvent frapper l\'ennemi exactement là où il peut infliger le plus de dégâts et l\'éliminer rapidement.'); // gaul tribe medal
tz_def('ADMIN_M', 'Administrateur officiel du serveur');
tz_def('MH_M', 'Multihunter officiel du serveur');
tz_def('MH_M2', 'Le Multihunter est une fonction officielle de Travian, principalement utilisée pour faire respecter les règles de Travian au sein d\'un serveur. Tous les Multihunters utilisent le compte nommé Multihunter, dont le seul village est situé en (0|0). Un Multihunter ne peut pas jouer sur le serveur où il occupe ce rôle, mais peut être un joueur actif sur d\'autres serveurs.');
tz_def('NATURE_M2', 'Les troupes de la Nature sont les animaux vivant dans les oasis inoccupées. Vous pouvez utiliser le simulateur de combat pour vérifier si vous avez suffisamment de troupes pour vaincre les animaux d\'une oasis que vous souhaitez conquérir, mais n\'oubliez pas que vous ne pouvez que piller les oasis. Sachez que tous les animaux supérieurs à l\'Ours peuvent tuer toutes les troupes de Travian de niveau maximum en combat singulier.');
tz_def('TASKMASTER_M', 'Compte Maître du jeu');
tz_def('VETERAN_P', 'Joueur vétéran');
tz_def('VETERAN_3_M', 'Médaille obtenue pour 3 ans de jeu sur Travian');
tz_def('VETERAN_5_M', 'Médaille obtenue pour 5 ans de service sur Travian');
tz_def('VETERAN_10_M', 'Médaille obtenue pour 10 ans de service sur Travian');
tz_def('ATT_W_M', 'Meilleurs attaquants de la semaine');
tz_def('DEF_W_M', 'Meilleurs défenseurs de la semaine');
tz_def('POP_W_M', 'Meilleures croissances de population de la semaine');
tz_def('ROB_W_M', 'Meilleurs voleurs de la semaine');
tz_def('CLIMB_W_M', 'Meilleures progressions au classement de la semaine');
tz_def('ATT_DEF_10_W_M', 'Cette médaille récompense les joueurs ayant figuré parmi les 10 meilleurs attaquants et défenseurs de la semaine');
tz_def('ATT_3_W_M', 'Recevoir cette médaille signifie que vous figuriez parmi les 3 meilleurs attaquants de la semaine');
tz_def('DEF_3_W_M', 'Recevoir cette médaille signifie que vous figuriez parmi les 3 meilleurs défenseurs de la semaine');
tz_def('POP_3_W_M', 'Recevoir cette médaille signifie que vous figuriez parmi les 3 meilleurs joueurs ayant progressé en population de la semaine');
tz_def('ROB_3_W_M', 'Recevoir cette médaille signifie que vous figuriez parmi les 3 meilleurs voleurs de la semaine');
tz_def('CLIMB_3_W_M', 'Recevoir cette médaille signifie que vous figuriez parmi les 3 meilleurs joueurs ayant progressé dans le classement de la semaine');
tz_def('ATT_10_W_M', 'Recevoir cette médaille signifie que vous figuriez parmi les 10 meilleurs attaquants de la semaine');
tz_def('DEF_10_W_M', 'Recevoir cette médaille signifie que vous figuriez parmi les 10 meilleurs défenseurs de la semaine');
tz_def('POP_10_W_M', 'Recevoir cette médaille signifie que vous figuriez parmi les 10 meilleurs croissances de population de la semaine');
tz_def('ROB_10_W_M', 'Recevoir cette médaille signifie que vous figuriez parmi les 10 meilleurs voleurs de la semaine');
tz_def('CLIMB_10_W_M', 'Recevoir cette médaille signifie que vous figuriez parmi les 10 meilleurs croissances de classement de la semaine');
tz_def('RECEIVED_IN_W', 'Reçu dans la semaine');
tz_def('POINTS_M', 'Points');
tz_def('RANKS', 'Classements');
tz_def('WEEK', 'Semaine');
tz_def('CATÉGORIE', 'Catégorie');
tz_def('RANK', 'Rang');
tz_def('BB_CODE', 'BB-Code');
tz_def('IN_ROW', 'dans une rangée');
tz_def('ADMIN1', 'Administrateur');
tz_def('MULTIH1', 'Multihunter');
tz_def('PLAYER_ADMIN', 'Ce joueur est Administrateur');
tz_def('PLAYER_MH', 'Ce joueur est Multihunter');
tz_def('PLAYER_BANNED', 'Ce joueur est BANNI');
tz_def('PLAYER_VACATION', 'Ce joueur est en VACANCES');
if (!defined('BANNED')) define('BANNED', 'Banni');
tz_def('GENDER', 'Genre');
tz_def('GENDER0', 'n/a');
tz_def('MALE0', 'm');
tz_def('MALE', 'Homme');
tz_def('FEMALE0', 'f');
tz_def('FEMALE', 'Femme');
tz_def('LOCATION', 'Emplacement');
tz_def('DIRECT_LINKS', 'Liens directs');
tz_def('NUMBER0', 'No');
tz_def('LINK_NAME', 'Nom du lien');
tz_def('LINK_TARGET', 'Cible du lien');
tz_def('TZ_LINK_GENERATOR', 'Générateur de liens');
tz_def('TZ_LINK_GENERATOR_DESC', 'Crée un lien basé sur le type de bâtiment plutôt que sur l\'emplacement; il fonctionne donc dans n\'importe quel village, quel que soit l\'endroit où le bâtiment y est construit. Copiez le résultat ci-dessous dans le champ Cible du lien.');
tz_def('TZ_TAB_OPTIONAL', 'Tab (optionel)');
tz_def('TZ_GENERATED_LINK', 'Lien généré');
tz_def('AUTO_COMPL', 'Saisie automatique');
tz_def('AUTO_COMPL2', 'Utilisé pour la place de rassemblement et le marché');
tz_def('OWN_VILLAGES', 'Villages personnels');
tz_def('VILLAGES_NEAR', 'Villages des environs');
tz_def('VILLAGES_ALLI_PLAYERS', 'Villages des joueurs de l\'alliance');
tz_def('REPORT_FILTER', 'Filtre de signalement');
tz_def('NO_REPORTS_TO_OWN', 'Aucun signalement pour les transferts vers ses propres villages');
tz_def('NO_REPORTS_TO_OTH', 'Aucun signalement pour les transferts vers des villages étrangers');
tz_def('NO_REPORTS_FROM_OTH', 'Aucun signalement pour les transferts depuis des villages étrangers');
tz_def('CHANGE_PROFILE', 'Changer de profil');
tz_def('WRITE_MESSAGE', 'Écrire un message');
tz_def('REPORT_PLAYER', 'Signaler un joueur');
tz_def('ARTEFACT1', 'Artéfact');
tz_def('WoW1', 'WW');
tz_def('VILLAGE_NAME', 'Nom du village');
tz_def('BDAY', 'Anniversaire');
tz_def('CONDITIONS', 'Conditions');
tz_def('TIME_PREF', 'Préférences horaires');
tz_def('TIME_ZONES_DESC', 'Ici, vous pouvez modifier l\'heure affichée par Travian pour qu\'elle corresponde à votre fuseau horaire');
tz_def('TIME_ZONE_L1', 'Europe');
tz_def('TIME_ZONE_L2', 'UK');
tz_def('TIME_ZONE_L3', 'Turquie');
tz_def('TIME_ZONE_L4', 'Asie/Kolkata');
tz_def('TIME_ZONE_L5', 'Asie/Bangkok');
tz_def('TIME_ZONE_L6', 'USA/New York');
tz_def('TIME_ZONE_L7', 'USA/Chicago');
tz_def('TIME_ZONE_L8', 'Nouvelle Zélande');
tz_def('MONTH1', 'Jan');
tz_def('MONTH2', 'Fév');
tz_def('MONTH3', 'Mar');
tz_def('MONTH4', 'Avr');
tz_def('MONTH5', 'Mai');
tz_def('MONTH6', 'Juin');
tz_def('MONTH7', 'Juil');
tz_def('MONTH8', 'Août');
tz_def('MONTH9', 'Sept');
tz_def('MONTH10', 'Oct');
tz_def('MONTH11', 'Nov');
tz_def('MONTH12', 'Déc');

//artefact
tz_def('ARCHITECTS_DESC', 'Tous les bâtiments dans la zone d\'effet sont plus solides. Cela signifie que vous aurez besoin de plus de catapultes pour endommager les bâtiments protégés par les pouvoirs de cet artefact.');
tz_def('ARCHITECTS_SMALL', 'Les petits secrets des architectes');
tz_def('ARCHITECTS_SMALLVILLAGE', 'Ciseau en diamant');
tz_def('ARCHITECTS_LARGE', 'Les grands secrets des architectes');
tz_def('ARCHITECTS_LARGEVILLAGE', 'Marteau en marbre géant');
tz_def('ARCHITECTS_UNIQUE', 'Le secret légendaire des architectes');
tz_def('ARCHITECTS_UNIQUEVILLAGE', "Parchemin d'Hémon");
tz_def('HASTE_DESC', 'Toutes les troupes dans la zone d\'effet se déplacent plus rapidement.');
tz_def('HASTE_SMALL', 'Les bottes légères de Titan');
tz_def('HASTE_SMALLVILLAGE', 'Fer à cheval d\'Opale');
tz_def('HASTE_LARGE', 'Les grandes bottes de Titan');
tz_def('HASTE_LARGEVILLAGE', 'La Charrue d\'Or');
tz_def('HASTE_UNIQUE', 'Les bottes légendaires de Titan');
tz_def('HASTE_UNIQUEVILLAGE', 'Les sandales de Phidippidès');
tz_def('EYESIGHT_DESC', 'Tous les espions (éclaireurs, pisteurs et Equites Legati) augmentent leur capacité d\'espionnage. De plus, avec toutes les versions de cet artefact, vous pouvez voir le TYPE de troupes entrantes mais pas leur nombre.');
tz_def('EYESIGHT_SMALL', 'Les petits yeux d\'aigle');
tz_def('EYESIGHT_SMALLVILLAGE', 'Conte d\un Rat');
tz_def('EYESIGHT_LARGE', 'Les grands yeux d\'aigle');
tz_def('EYESIGHT_LARGEVILLAGE',' Lettre des Généraux');
tz_def('EYESIGHT_UNIQUE', 'Les yeux d\'aigle légendaires');
tz_def('EYESIGHT_UNIQUEVILLAGE', 'Journal de Sun Tzu');
tz_def('DIET_DESC', 'Toutes les troupes dans la portée de l\'artefact consomment moins de blé, ce qui permet d\'entretenir une armée plus importante.');
tz_def('DIET_SMALL', 'Léger contrôle alimentaire');
tz_def('DIET_SMALLVILLAGE', 'Plateau d\'Argent');
tz_def('DIET_LARGE', 'Excellent contrôle alimentaire');
tz_def('DIET_LARGEVILLAGE', 'Arc de chasse sacré');
tz_def('DIET_UNIQUE', 'Contrôle alimentaire total');
tz_def('DIET_UNIQUEVILLAGE', 'Saint Graal du Roi Arthur');
tz_def('ACADEMIC_DESC', 'Les troupes sont produites un certain pourcentage plus rapidement dans le champ d\'action de l\'artefact.');
tz_def('ACADEMIC_SMALL', 'Entrainement légèrement amélioré');
tz_def('ACADEMIC_SMALLVILLAGE', 'Ecriture du serment des soldats');
tz_def('ACADEMIC_LARGE', 'Entrainement Supérieur');
tz_def('ACADEMIC_LARGEVILLAGE', 'Déclaration de Guerre');
tz_def('ACADEMIC_UNIQUE', 'Entrainement Ultime');
tz_def('ACADEMIC_UNIQUEVILLAGE', 'Mémoires d\'Alexandre le Grand');
tz_def('STORAGE_DESC', 'Avec ce plan de construction, vous pouvez construire le grand grenier ou le grand entrepôt dans le village contenant l\'artefact, ou pour tout le compte selon l\'artefact. Tant que vous possédez cet artefact, vous pouvez construire et agrandir ces bâtiments.');
tz_def('STORAGE_SMALL', 'Plan rudimentaire de bâtiments de stockage');
tz_def('STORAGE_SMALLVILLAGE', 'Croquis des constructeurs');
tz_def('STORAGE_LARGE', 'Plan détaillé de bâtiments de stockage');
tz_def('STORAGE_LARGEVILLAGE', 'Tablette Babylonienne');
tz_def('CONFUSION_DESC', 'La capacité de la cachette est augmentée d\'une certaine quantité par type d\'artefact. Les catapultes ne peuvent tirer qu\'aléatoirement sur les villages dans le champ de ces artefacts. Les exceptions sont la Merveille qui peut toujours être ciblée et la trésorerie qui peut toujours être ciblée, sauf avec l\'artefact unique. Quand on vise un champ de ressources, seuls des champs aléatoires peuvent être touchés ; quand on vise un bâtiment, seuls des bâtiments aléatoires peuvent l\'être.');
tz_def('CONFUSION_SMALL', 'Légère confusion des rivaux');
tz_def('CONFUSION_SMALLVILLAGE', 'Carte des cavernes oubliées');
tz_def('CONFUSION_LARGE', 'Grande confusion de rivaux');
tz_def('CONFUSION_LARGEVILLAGE', 'Baluchon sans fond');
tz_def('CONFUSION_UNIQUE', 'Confusion totale des rivaux');
tz_def('CONFUSION_UNIQUEVILLAGE', 'Cheval de Troie');
tz_def('FOOL_DESC', 'Toutes les 24 heures, il obtient un effet aléatoire, bonus ou pénalité (tout est possible sauf le grand entrepôt, le grand grenier et les plans de la Merveille). L\'effet ET la portée changent toutes les 24 heures. L\'artefact unique prendra toujours des bonus positifs.');
tz_def('FOOL_SMALL', 'Artéfact du jeune Fou');
tz_def('FOOL_SMALLVILLAGE', 'Pendentif de Malice');
tz_def('FOOL_UNIQUE', 'Artéfact du Roi Fou');
tz_def('FOOL_UNIQUEVILLAGE', ' Manuscrit Interdit');
tz_def('WWVILLAGE', ' Village Merveille');
tz_def('ARTEFACT', '<h1><b>Artefacts Natars</b></h1>

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
tz_def('WWVILLAGEMSG', '<h1><b>Villages Merveille du monde</b></h1>

D\'innombrables jours se sont écoulés depuis les premières batailles aux murailles des villages maudits des terribles Natars. De nombreuses armées, tant des hommes libres que de l\'empire natarien, ont lutté et péri devant les murs des nombreuses forteresses d\'où les Natars régnaient autrefois sur toute la création. Maintenant que la poussière retombe et qu\'un calme relatif s\'est installé, les armées commencent à compter leurs pertes et à rassembler leurs morts, l\'odeur du combat flottant encore dans l\'air nocturne, une odeur de massacre inoubliable par son ampleur et sa brutalité, qui sera bientôt éclipsée par d\'autres encore. Les plus grandes armées des hommes libres et des terribles Natars se rassemblaient pour un énième assaut renouvelé contre les ex-forteresses convoitées de l\'empire natarien.
Bientôt les éclaireurs arrivent annonçant une vision incroyable et un rappel glaçant : une armée terrifiante d\'une taille insondable a été repérée se rassemblant à la fin du monde, la capitale natarienne, une force si grande et inarrêtable que la poussière de leur marche étoufferait toute lumière, une force si brutale et impitoyable qu\'elle écraserait tout espoir. Les hommes libres savaient qu\'ils devaient maintenant courir, courir contre le temps et les hordes infinies de l\'empire natarien pour ériger une Merveille du monde, ramener la paix dans le monde et vaincre la menace natarienne.
Mais ériger une si grande Merveille ne serait pas une tâche aisée — il faudrait des plans de construction créés dans un passé lointain, des plans d\'une nature si arcane que même les plus sages des sages n\'en connaissaient ni le contenu ni l\'emplacement.
Des dizaines de milliers d\'éclaireurs ont arpenté toute l\'existence à la recherche en vain de ces plans mystiques, cherchant partout sauf dans la redoutable capitale natarienne, sans pouvoir les trouver. Aujourd\'hui cependant, ils reviennent porteurs de bonnes nouvelles, ils reviennent avec les emplacements des plans, dissimulés par les armées des Natars dans des forteresses secrètes construites pour être cachées aux yeux des hommes.
Maintenant commence la dernière ligne droite, où les plus grandes armées des hommes libres et des Natars s\'affronteront à travers le monde pour le destin de tout ce qui repose sous le ciel. C\'est la guerre qui résonnera à travers les âges, c\'est votre guerre, et c\'est ici que vous graverez votre nom dans l\'histoire, ici que vous deviendrez légende.

<img src="/img/x.gif" class="WWVillagesAnnouncement" title="'.WWVILLAGE.'" alt="'.WWVILLAGE.'">

Pour en conquérir un, les conditions suivantes doivent être réunies :

1. Vous devez attaquer le village (PAS un pillage !)
2. GAGNEZ l\'attaque
3. Détruisez la RÉSIDENCE
4. Vous devez réduire la loyauté à 0 avec : SÉNATEURS, CHEFS, CHEFS DE TRIBU
5. Vous devez avoir assez de points de culture pour conquérir le village

Sinon, la prochaine attaque sur ce village, gagnée avec un SÉNATEUR, CHEF ou CHEF DE TRIBU et des emplacements vides dans la RÉSIDENCE/PALAIS, prendra le village.

Pour construire une Merveille, vous devez posséder vous-même un plan (vous = le propriétaire du village Merveille) du niveau 0 au 50, du niveau 51 au 100 vous avez besoin d\'un plan supplémentaire dans votre alliance ! Deux plans dans le compte du village Merveille ne fonctionneraient pas !

Les plans de construction sont conquérables immédiatement dès qu\'ils apparaissent sur le serveur.

Un compte à rebours sera affiché dans le jeu, indiquant l\'heure exacte de la sortie, '.(5 / SPEED).' jours avant le lancement.');

//Building Plans
tz_def('WILL_SPAWN_IN', 'apparaîtront dans');
tz_def('PLAN', 'Plan de Construction Antique');
tz_def('PLANVILLAGE', 'Plan de la Merveille');
tz_def('PLAN_DESC', 'Avec ce Plan de Construction Antique, vous pourrez construire une Merveille du Monde jusqu\'au niveau 50. Pour construire d\'avantage, votre alliance doit avoir au moins deux plans.');
tz_def('PLAN_INFO', '<h1><b>Plans de construction de la Merveille du Monde</b></h1>


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
tz_def('EDIT_BACK', 'Retour');
tz_def('SERV_CONFIG', 'Configuration du Serveur');
tz_def('SERV_SETT', 'Paramètres du Serveur');
tz_def('EDIT_SERV_SETT', 'Editer les paramètres du serveur');
tz_def('SERV_VARIABLE', 'Variable');
tz_def('SERV_VALUE', 'Valeur');
tz_def('CONF_SERV_NAME', 'Nom du Serveur');
tz_def('CONF_SERV_NAME_TOOLTIP', 'Nom du serveur de jeu.');
tz_def('CONF_SERV_STARTED', 'Serveur démarré');
tz_def('CONF_SERV_STARTED_TOOLTIP', 'Date à laquelle le serveur de jeu a été démarré. Ce paramètre ne peut pas être modifié sur un serveur de jeu installé.');
tz_def('CONF_SERV_TIMEZONE', 'Fuseau horaire du serveur');
tz_def('CONF_SERV_TIMEZONE_TOOLTIP', 'Fuseau horaire du serveur de jeu.');
tz_def('CONF_SERV_LANG', 'Langage');
tz_def('CONF_SERV_LANG_TOOLTIP', 'Langue utilisée par défaut dans le panneau d\'administration et pour tous les utilisateurs du serveur de jeu par défaut.');
tz_def('CONF_SERV_SERVSPEED', 'Vitesse du Serveur');
tz_def('CONF_SERV_SERVSPEED_TOOLTIP', 'La vitesse du serveur de jeu. Plus la vitesse du serveur de jeu est élevée, plus tous les bâtiments sont construits rapidement, les études et améliorations des forges effectuées, les troupes sont rapidement constituées et la productivité de toutes les ressources augmentée.');
tz_def('CONF_SERV_TROOPSPEED', 'Vitesse des Troupes');
tz_def('CONF_SERV_TROOPSPEED_TOOLTIP', 'Vitesse de déplacement des troupes sur le serveur de jeu. Plus cet indicateur est élevé, plus les troupes se déplacent rapidement sur la carte.');
tz_def('CONF_SERV_EVASIONSPEED', 'Vitesse d\'évasion');
tz_def('CONF_SERV_EVASIONSPEED_TOOLTIP', 'La vitesse d\'évasion est le temps que les troupes passent sur la route pour rentrer chez elles après une évasion.');
tz_def('CONF_SERV_STORMULTIPLER', 'Multiplicateur de Stockage');
tz_def('CONF_SERV_STORMULTIPLER_TOOLTIP', 'Un multiplicateur pour la capacité de stockage de l\'entrepôt et du grenier. La valeur 1 équivaut à 80 000 de chaque ressource au niveau maximum. Si vous mettez 2, la capacité au niveau maximum sera de 160 000 par ressource.<br><b>Note :</b> la quantité de ressources générée par les oasis non occupées pour le pillage dépend de cette valeur. Par défaut 800. Si vous mettez 2, le maximum par ressource générée est 1600.');
tz_def('CONF_SERV_TRADCAPACITY', 'Capacité du marchand');
tz_def('CONF_SERV_TRADCAPACITY_TOOLTIP', 'Un multiplicateur pour la capacité de ressources pouvant être transportée par un marchand. La valeur de 1 équivaut à 500 capacités pour les Romains, 750 pour les Gaulois, 1000 pour les Teutons. Si vous définissez la valeur sur 2, la capacité des ressources transférées doublera en conséquence, 1000, 1500 et 2000.');
tz_def('CONF_SERV_CRANCAPACITY', 'Capacité de la Cachette');
tz_def('CONF_SERV_CRANCAPACITY_TOOLTIP', 'Un multiplicateur pour la capacité de ressources dans la Cachette, qui peut être sauvé du vol. La valeur de 1 est égale à 1000 pour les Romains et les Teutons, 2000 pour les Gaulois. Si vous définissez la valeur sur 2, la capacité de la Cachette doublera à 2000 et 4000 respectivement.');
tz_def('CONF_SERV_TRAPCAPACITY', 'Capacité du Fabricant de pièges');
tz_def('CONF_SERV_TRAPCAPACITY_TOOLTIP', 'Un multiplicateur pour la capacité du piège des Gaulois, qui permet de capturer des soldats ennemis avant même d\'attaquer le village. La valeur de 1 est égale à la capacité de 400 au niveau de construction 20. Si vous définissez la valeur sur 2, la capacité sera de 800.');
tz_def('CONF_SERV_NATUNITSMULTIPLIER', 'Multiplicateur Unités Natars');
tz_def('CONF_SERV_NATUNITSMULTIPLIER_TOOLTIP', 'Ce paramètre est responsable du nombre de troupes Natars, sur des villages Artefacts et Merveilles.');
tz_def('CONF_SERV_NATARS_SPAWN_TIME', 'Apparition des Natars');
tz_def('CONF_SERV_NATARS_SPAWN_TIME_TOOLTIP', 'Après combien de temps Natars et les artefacts apparaîtront à partir de la date de démarrage du serveur, en jours');
tz_def('CONF_SERV_NATARS_WW_SPAWN_TIME', 'Apparition des Villages Merveilles');
tz_def('CONF_SERV_NATARS_WW_SPAWN_TIME_TOOLTIP', 'Après combien de temps les villages Merveilles apparaîtront à partir de la date de démarrage du serveur, en jours');
tz_def('CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME', 'Apparition des Plans');
tz_def('CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME_TOOLTIP', 'Après combien de temps les plans de construction de Merveille apparaîtront à partir de la date de début du serveur, en jours');
tz_def('CONF_SERV_MAPSIZE', 'Taille de la Carte');
tz_def('CONF_SERV_MAPSIZE_TOOLTIP', 'La taille de la carte du monde du jeu. Ne peut pas être changé sur un serveur de jeu déjà installé.');
tz_def('CONF_SERV_VILLEXPSPEED', 'Vitesse d\'expansion des villages');
tz_def('CONF_SERV_VILLEXPSPEED_TOOLTIP', 'Avec une vitesse lente, plus de points de culture sont nécessaires pour fonder un nouveau village, avec une vitesse rapide, le nombre requis de points de culture est réduit.');
tz_def('CONF_SERV_BEGINPROTECT', 'Protection Débutant');
tz_def('CONF_SERV_BEGINPROTECT_TOOLTIP', 'Protection temporaire qui empêche d\'attaquer les villages de nouveaux joueurs.');
tz_def('CONF_SERV_REGOPEN', 'Enregistrement Ouvert');
tz_def('CONF_SERV_REGOPEN_TOOLTIP', 'Permet d\'activer ou de désactiver l\'inscription des joueurs sur le serveur de jeu.');
tz_def('CONF_SERV_ACTIVMAIL', 'Activation par Mail');
tz_def('CONF_SERV_ACTIVMAIL_TOOLTIP', 'Si activé (Oui), lors de l\'inscription, il sera nécessaire de confirmer l\'adresse e-mail. Si désactivé (Non), aucune confirmation de courrier électronique n\'est requise.');
tz_def('CONF_SERV_QUEST', 'Quêtes');
tz_def('CONF_SERV_QUEST_TOOLTIP', 'Activer (Oui) ou désactiver (Non) les quêtes sur le serveur de jeu.');
tz_def('CONF_SERV_QTYPE', 'Type de Quêtes');
tz_def('CONF_SERV_QTYPE_TOOLTIP', 'Le type de quête peut être officiel, ce qui est un peu plus court, et étendu, ce qui est plus long.');
tz_def('CONF_SERV_DLR', 'Niveau requis pour Démolition');
tz_def('CONF_SERV_DLR_TOOLTIP', 'Le niveau requis du bâtiment principal, pour procéder à la démolition des bâtiments dans le village.');
tz_def('CONF_SERV_WWSTATS', 'Merveille du Monde - Stats');
tz_def('CONF_SERV_WWSTATS_TOOLTIP', 'Activez (Vrai) ou désactivez (Faux) l\'affichage dans les statistiques des villages avec une merveille du monde.');
tz_def('CONF_SERV_NTRTIME', 'Temps de Régénération des Troupes Nature');
tz_def('CONF_SERV_NTRTIME_TOOLTIP', 'Temps à travers lequel les troupes Nature seront restaurées dans des oasis.');
tz_def('CONF_SERV_OASIS_WOOD_PROD_MULT', 'Multiplicateur de prod. de bois dans les oasis');
tz_def('CONF_SERV_OASIS_WOOD_PROD_MULT_TOOLTIP', 'La production de bois de base dans les oasis');
tz_def('CONF_SERV_OASIS_CLAY_PROD_MULT', 'Multiplicateur de prod. d\'argile dans les oasis');
tz_def('CONF_SERV_OASIS_CLAY_PROD_MULT_TOOLTIP', 'La production d\'argile de base dans les oasis');
tz_def('CONF_SERV_OASIS_IRON_PROD_MULT', 'Multiplicateur de prod. de fer dans les oasis');
tz_def('CONF_SERV_OASIS_IRON_PROD_MULT_TOOLTIP', 'La production de fer de base dans les oasis');
tz_def('CONF_SERV_OASIS_CROP_PROD_MULT', 'Multiplicateur de prod. de céréales dans les oasis');
tz_def('CONF_SERV_OASIS_CROP_PROD_MULT_TOOLTIP', 'La production de céréales de base dans les oasis');
tz_def('CONF_SERV_MEDALINTERVAL', 'Intervale des Médailles');
tz_def('CONF_SERV_MEDALINTERVAL_TOOLTIP', 'L\’intervalle de temps pour l\'émission de médailles pour les meilleurs joueurs et alliances. Si ce paramètre est modifié sur le serveur installé, l\'intervalle de temps change après la publication suivante des médailles.');
tz_def('CONF_SERV_TOURNTHRES', 'Limite Place du Tournoi');
tz_def('CONF_SERV_TOURNTHRES_TOOLTIP', 'Le nombre de cases sur la carte, après quoi la place du tournoi commencera à fonctionner.');
tz_def('CONF_SERV_GWORKSHOP', 'Grand Atelier');
tz_def('CONF_SERV_GWORKSHOP_TOOLTIP', 'Activez ou désactivez l\'utilisation d\'un grand atelier.');
tz_def('CONF_SERV_NATARSTAT', 'Afficher Natars dans les statistiques');
tz_def('CONF_SERV_NATARSTAT_TOOLTIP', 'Activez ou désactivez l\'affichage du compte Natars dans les statistiques.');
tz_def('CONF_SERV_PEACESYST', 'Système de Paix');
tz_def('CONF_SERV_PEACESYST_TOOLTIP', 'Activer ou désactiver le système de paix. Lorsque le système de paix sera activé, les joueurs pourront s’attaquer mais, au lieu d’agir dans les rapports, il y aura une inscription de félicitations. Les troupes ne mourront pas de faim.');
tz_def('CONF_SERV_GRAPHICPACK', 'Pack Graphique');
tz_def('CONF_SERV_GRAPHICPACK_TOOLTIP', 'Activez ou désactivez la possibilité d\'utiliser le pack graphique.');
tz_def('CONF_SERV_ERRORREPORT', 'Rapport d\'erreur');
tz_def('CONF_SERV_ERRORREPORT_TOOLTIP', 'Activer ou désactiver l\'affichage des rapports d\'erreur sur le serveur de jeu.');

//Admin setting - Admin/Templates/config.tpl & editPlusSet.tpl
tz_def('PLUS_LOGO', '<b><font color="#71D000">P</font><font color="#FF6F0F">l</font><font color="#71D000">u</font><font color="#FF6F0F">s</font></b>');
tz_def('PLUS_CONFIGURATION', PLUS_LOGO.' Configuration');
tz_def('PLUS_SETT', PLUS_LOGO.' Paramètres');
tz_def('EDIT_PLUS_SETT', 'Modifier les paramètres '.PLUS_LOGO);
tz_def('EDIT_PLUS_SETT1', 'Modifier les paramètres PLUS');
tz_def('CONF_PLUS_PAYPALEMAIL', 'Adresse e-mail <a href="https://www.paypal.com" target="_blank">PayPal</a>');
tz_def('CONF_PLUS_PAYPALEMAIL_TOOLTIP', 'L\'adresse e-mail spécifiée à l\'inscription sur PayPal.<br><font color="red"><b>Doit être un compte Business ou Premier !</b></font>');
tz_def('CONF_PLUS_CURRENCY', 'Devise de paiement');
tz_def('CONF_PLUS_CURRENCY_TOOLTIP', 'La devise à utiliser pour les paiements.');
tz_def('CONF_PLUS_PACKAGEGOLDA', 'Pack « A » — Quantité d\'or');
tz_def('CONF_PLUS_PACKAGEGOLDA_TOOLTIP', 'Quantité d\'or émise pour le paiement du pack « A ».');
tz_def('CONF_PLUS_PACKAGEPRICEA', 'Pack « A » — Montant du prix');
tz_def('CONF_PLUS_PACKAGEPRICEA_TOOLTIP', 'Montant nécessaire pour payer le pack « A ».');
tz_def('CONF_PLUS_PACKAGEGOLDB', 'Pack « B » — Quantité d\'or');
tz_def('CONF_PLUS_PACKAGEGOLDB_TOOLTIP', 'Quantité d\'or émise pour le paiement du pack « B ».');
tz_def('CONF_PLUS_PACKAGEPRICEB', 'Pack « B » — Montant du prix');
tz_def('CONF_PLUS_PACKAGEPRICEB_TOOLTIP', 'Montant nécessaire pour payer le pack « B ».');
tz_def('CONF_PLUS_PACKAGEGOLDC', 'Pack « C » — Quantité d\'or');
tz_def('CONF_PLUS_PACKAGEGOLDC_TOOLTIP', 'Quantité d\'or émise pour le paiement du pack « C ».');
tz_def('CONF_PLUS_PACKAGEPRICEC', 'Pack « C » — Montant du prix');
tz_def('CONF_PLUS_PACKAGEPRICEC_TOOLTIP', 'Montant nécessaire pour payer le pack « C ».');
tz_def('CONF_PLUS_PACKAGEGOLDD', 'Pack « D » — Quantité d\'or');
tz_def('CONF_PLUS_PACKAGEGOLDD_TOOLTIP', 'Quantité d\'or émise pour le paiement du pack « D ».');
tz_def('CONF_PLUS_PACKAGEPRICED', 'Pack « D » — Montant du prix');
tz_def('CONF_PLUS_PACKAGEPRICED_TOOLTIP', 'Montant nécessaire pour payer le pack « D ».');
tz_def('CONF_PLUS_PACKAGEGOLDE', 'Pack « E » — Quantité d\'or');
tz_def('CONF_PLUS_PACKAGEGOLDE_TOOLTIP', 'Quantité d\'or émise pour le paiement du pack « E ».');
tz_def('CONF_PLUS_PACKAGEPRICEE', 'Pack « E » — Montant du prix');
tz_def('CONF_PLUS_PACKAGEPRICEE_TOOLTIP', 'Montant nécessaire pour payer le pack « E ».');
tz_def('CONF_PLUS_ACCDURATION', 'Durée du compte '.PLUS_LOGO);
tz_def('CONF_PLUS_ACCDURATION_TOOLTIP', 'Durée de la fonction de jeu '.PLUS_LOGO.' pour le compte au moment de l\'activation par le joueur.');
tz_def('CONF_PLUS_PRODUCTDURATION', 'durée de production du bonus +25 %');
tz_def('CONF_PLUS_PRODUCTDURATION_TOOLTIP', 'Durée de la fonction +25 % de production pour le compte au moment de l\'activation par le joueur.');

//Admin setting - Admin/Templates/config.tpl & editLogSet.tpl
tz_def('LOG_SETT', 'Paramètres des Logs');
tz_def('EDIT_LOG_SETT', 'Editer les Paramètres des Logs');
tz_def('CONF_LOG_BUILD', 'Log Constuctions');
tz_def('CONF_LOG_BUILD_TOOLTIP', 'Activez ou désactivez l\'affichage des journaux pour la construction de bâtiments dans le village.');
tz_def('CONF_LOG_TECHNOLOGY', 'Log Technologie');
tz_def('CONF_LOG_TECHNOLOGY_TOOLTIP', 'Activez ou désactivez l\'affichage des journaux pour améliorer les troupes dans Forgeron et Armurerie.');
tz_def('CONF_LOG_LOGIN', 'Log des Login');
tz_def('CONF_LOG_LOGIN_TOOLTIP', 'Activer ou désactiver l\’affichage des joueurs qui se connectent au jeu.');
tz_def('CONF_LOG_GOLD', 'Log des Gold');
tz_def('CONF_LOG_GOLD_TOOLTIP', 'Activer ou désactiver l\'affichage des journaux d\'utilisation de Gold par les joueurs.');
tz_def('CONF_LOG_ADMIN', 'Log Admin');
tz_def('CONF_LOG_ADMIN_TOOLTIP', 'Activez ou désactivez l\'affichage des journaux pour les actions de l\'administrateur dans le panneau de configuration.');
tz_def('CONF_LOG_WAR', 'Log des Attaques');
tz_def('CONF_LOG_WAR_TOOLTIP', 'Activer ou désactiver l\'affichage journaux d\'attaque des joueurs.');
tz_def('CONF_LOG_MARKET', 'Log du Marché');
tz_def('CONF_LOG_MARKET_TOOLTIP', 'Activer ou désactiver l\'affichage des journaux du marché par les joueurs.');
tz_def('CONF_LOG_ILLEGAL', 'Log Illégaux');
tz_def('CONF_LOG_ILLEGAL_TOOLTIP', 'Activer (Oui) ou désactiver (Non) l\'affichage des journaux illégaux. (Je ne sais pas exactement ce que c\'est, tentative de faux log ?)');

//Admin setting - Admin/Templates/config.tpl & editNewsboxSet.tpl
tz_def('NEWSBOX_SETT', 'Paramètres Newsbox');
tz_def('EDIT_NEWSBOX_SETT', 'Editer Paramètres des Newsbox');
tz_def('EDIT_NEWSBOX1', 'Newsbox 1');
tz_def('EDIT_NEWSBOX1_TOOLTIP', 'Activer ou désactiver l\'affichage de la Newsbox 1. Affiché sur la page d\'autorisation et sur les pages de jeu.');
tz_def('EDIT_NEWSBOX2', 'Newsbox 2');
tz_def('EDIT_NEWSBOX2_TOOLTIP', 'Activer ou désactiver l\'affichage de la Newsbox 2. Affiché sur la page d\'autorisation et sur les pages de jeu.');
tz_def('EDIT_NEWSBOX3', 'Newsbox 3');
tz_def('EDIT_NEWSBOX3_TOOLTIP', 'Activer ou désactiver l\'affichage de la Newsbox 3. Affiché sur la page d\'autorisation et sur les pages de jeu.');

//Admin setting - Admin/Templates/config.tpl SQL Settings
tz_def('SQL_SETTINGS', 'Paramètres SQL');
tz_def('CONF_SQL_HOSTNAME', 'Hostname');
tz_def('CONF_SQL_HOSTNAME_TOOLTIP', 'Le nom du serveur sur lequel MySQL est démarré (par défaut: localhost).');
tz_def('CONF_SQL_PORT', 'Port');
tz_def('CONF_SQL_PORT_TOOLTIP', 'Port MySQL pour la connexion à distance. Le port standard pour la connexion est: 3306.');
tz_def('CONF_SQL_DBUSER', 'DB Username');
tz_def('CONF_SQL_DBUSER_TOOLTIP', 'Le nom d\'utilisateur pour se connecter à la base de données (par défaut: root).');
tz_def('CONF_SQL_DBPASS', 'DB Password');
tz_def('CONF_SQL_DBPASS_TOOLTIP', 'Mot de passe de l\'utilisateur pour se connecter à la base de données.');
tz_def('CONF_SQL_DBNAME', 'Nom DB');
tz_def('CONF_SQL_DBNAME_TOOLTIP', 'Nom de la base de données à laquelle vous vous connectez.');
tz_def('CONF_SQL_TBPREFIX', 'Préfixe');
tz_def('CONF_SQL_TBPREFIX_TOOLTIP', 'Le préfixe utilisé pour les tables de la base de données.');
tz_def('CONF_SQL_DBTYPE', 'Type de DB');
tz_def('CONF_SQL_DBTYPE_TOOLTIP', 'Le type de base de données utilisé.');

//Admin setting - Admin/Templates/config.tpl & editExtraSet.tpl
tz_def('EXTRA_SETT', 'Paramètres supplémentaires');
tz_def('EDIT_EXTRA_SETT', 'Editer les Paramètres supplémentaires');
tz_def('CONF_EXTRA_LIMITMAIL', 'Limite de la boîte mail');
tz_def('CONF_EXTRA_LIMITMAIL_TOOLTIP', 'Activez (Oui) ou désactivez (Non) la limite de la boîte mail.');
tz_def('CONF_EXTRA_MAXMAIL', 'Nombre max. de mails');
tz_def('CONF_EXTRA_MAXMAIL_TOOLTIP', 'Le nombre maximal de messages pouvant tenir dans la boîte mail.');

//Admin setting - Admin/Templates/config.tpl & editAdminInfo.tpl
tz_def('ADMIN_INFO', 'Infos Admin');
tz_def('EDIT_ADMIN_INFO', 'Editer infos Admin');
tz_def('CONF_ADMIN_NAME', 'Nom Admin');
tz_def('CONF_ADMIN_NAME_TOOLTIP', 'Nom pour le compte Admin');
tz_def('CONF_ADMIN_EMAIL', 'E-Mail Admin');
tz_def('CONF_ADMIN_EMAIL_TOOLTIP', 'L\'adresse email du compte administrateur.');
tz_def('CONF_ADMIN_SHOWSTATS', 'Inclure l\'Admin dans les Stats');
tz_def('CONF_ADMIN_SHOWSTATS_TOOLTIP', 'Activer (True) ou désactiver (False) l\'affichage du compte administrateur dans les statistiques générales des joueurs.');
tz_def('CONF_ADMIN_SUPPMESS', 'Inclure Messages Support');
tz_def('CONF_ADMIN_SUPPMESS_TOOLTIP', 'Activez (True) ou désactivez (False) l\'envoi de messages à la boîte aux lettres de l\'administrateur adressée au support.');
tz_def('CONF_ADMIN_RAIDATT', 'Permettre les raids et attaques');
tz_def('CONF_ADMIN_RAIDATT_TOOLTIP', 'Activez (True) ou désactivez (False) la possibilité d\'effectuer une attaque et d\'attaquer un administrateur.');

/*
|--------------------------------------------------------------------------
|   Index
|--------------------------------------------------------------------------
*/

$lang['index'][0][1] = 'Bienvenue sur le '.SERVER_NAME.'!';
$lang['index'][0][2] = 'Manuel';
$lang['index'][0][3] = 'Jouez Maintenant (Gratuit!!)';
$lang['index'][0][4] = 'Qu`est-ce que '.SERVER_NAME.'?';
$lang['index'][0][5] = SERVER_NAME.' est un <b>jeu de navigateur</b> mettant en scène un monde antique captivant avec des milliers d\'autres vrais joueurs.</p><p>Il est <strong>gratuit</strong> et ne nécessite <strong>aucun téléchargement</strong>.';
$lang['index'][0][6] = 'Clique ici pour jouer &agrave; '.SERVER_NAME;
$lang['index'][0][7] = 'Total Joueurs';
$lang['index'][0][8] = 'Joueurs actifs';
$lang['index'][0][9] = 'Joueurs en ligne';
$lang['index'][0][10] = '&Agrave; propos du jeu';
$lang['index'][0][11] = "Vous commencerez en tant que chef d'un petit village et vous vous lancerez dans une qu&ecirc;te passionnante.";
$lang['index'][0][12] = 'Construisez des villages, menez des guerres ou &eacute;tablissez des routes commerciales avec vos voisins.';
$lang['index'][0][13] = "Jouez avec et contre des milliers d'autres joueurs r&eacute;els et dominez le monde de Travian.";
$lang['index'][0][14] = 'News';
$lang['index'][0][15] = 'FAQ';
$lang['index'][0][16] = 'Screenshots';
$lang['forum'] = 'Forum';
$lang['register'] = "S'enregistrer";
$lang['login'] = 'Se Conneceter';
$lang['screenshots']['title1']='Village';
$lang['screenshots']['desc1']='B&acirc;timent du village';
$lang['screenshots']['title2']='Ressources';
$lang['screenshots']['desc2']="Les ressources du village sont le bois, l'argile, le fer et les c&eacute;r&eacute;ales";
$lang['screenshots']['title3']='Map';
$lang['screenshots']['desc3']='Localisation de votre village sur la carte';
$lang['screenshots']['title4']='Construisez des b&acirc;timents';
$lang['screenshots']['desc4']='Comment construire un niveau de b&acirc;timent ou de ressource';
$lang['screenshots']['title5']='Rapports';
$lang['screenshots']['desc5']="Vos rapports d'attaque";
$lang['screenshots']['title6']='Statistiques';
$lang['screenshots']['desc6']='Visualisez votre rang et vos stats';
$lang['screenshots']['title7']='Armes ou diplo';
$lang['screenshots']['desc7']='Vous pouvez choisir de jouer militaire ou &eacute;conomique';  

// ===== i18n nouvelles constantes (etape 2) =====
tz_def('TZ_ACTIVATION_AVAILBLE_IN', 'Activation disponible dans :');
tz_def('TZ_ACTIVATION_CODE', 'Code d\'activation :');
tz_def('TZ_ADD', 'ajouter');
tz_def('TZ_ADD_2', 'Ajouter');
tz_def('TZ_ALLIANCE_ID', 'ID de l\'alliance');
tz_def('TZ_ARRIVED', 'Arrivé :');
tz_def('TZ_ASSIGN_TO_POSITION', 'Assigner à un poste');
tz_def('TZ_AS_SOON_AS_A_PLAYER_YOU_INVITED_FO', 'Dès qu\'un joueur que vous avez invité fonde son');
tz_def('TZ_ATTACKS', 'Attaques');
tz_def('TZ_BOLD', 'gras');
tz_def('TZ_BUILDING', 'Bâtiment');
tz_def('TZ_CATAPULT_TARGET', 'cible de la catapulte');
tz_def('TZ_CLICK_TO_COPY', 'Cliquez pour copier');
tz_def('TZ_CLIMBERS_OF_THE_WEEK', 'Progressions de la semaine');
tz_def('TZ_CLOCK', 'Horloge');
tz_def('TZ_CONTINUE_WITH_THE_NEXT_TASK', 'Continuez avec la tâche suivante.');
tz_def('TZ_CREATE', 'Créer');
tz_def('TZ_CREATE_A_NEW_LIST', 'Créer une nouvelle liste');
tz_def('TZ_DESTINATION', 'Destination :');
tz_def('TZ_DOES_NOT_EXIST', 'n\'existe pas.');
tz_def('TZ_DOWNLOAD', 'Télécharger');
tz_def('TZ_EVENT', 'Événement');
tz_def('TZ_FEATURES_OF_TRAVIAN', 'Fonctionnalités de Travian');
tz_def('TZ_FORUM_NAME', 'Nom du forum');
tz_def('TZ_FORWARD', 'suivant');
tz_def('TZ_GOLD', 'or.');
tz_def('TZ_HERO_DEF_BONUS', 'Héros (bonus de défense)');
tz_def('TZ_HERO_FIGHTING_STRENGTH', 'Héros (force de combat)');
tz_def('TZ_HERO_OFF_BONUS', 'Héros (bonus d\'attaque)');
tz_def('TZ_HOUR', 'heure');
tz_def('TZ_HOW_IS_IT_DONE', 'Comment faire ?');
tz_def('TZ_HRS', 'h');
tz_def('TZ_HRS_2', 'h');
tz_def('TZ_IF_YOU_GET_NEW_PLAYERS_TO_OPEN_AN', 'Si vous amenez de nouveaux joueurs à créer un compte et à fonder un deuxième village, vous recevrez');
tz_def('TZ_IN_YOUR_POST_BECAUSE_IT_CAN_CAUSE', 'dans votre message car cela peut causer des problèmes avec le système BBCode.');
tz_def('TZ_ITALIC', 'italique');
tz_def('TZ_LAST_TARGETS', 'Dernières cibles :');
tz_def('TZ_LIST_NAME', 'Nom de la liste :');
tz_def('TZ_LOOK_FOR_YOUR_RANK_IN_THE_STATISTI', 'Cherchez votre rang dans les statistiques et saisissez-le ici.');
tz_def('TZ_MACEMAN', 'Combattant au gourdin');
tz_def('TZ_MEMBERS', 'Membres');
tz_def('TZ_MEMBER_SINCE', 'Membre depuis');
tz_def('TZ_NAME', 'Nom :');
tz_def('TZ_NO', 'N°');
tz_def('TZ_NOT_CODED_YET', '(pas encore implémenté)');
tz_def('TZ_NO_EMAIL_RECEIVED', 'Aucun e-mail reçu ?');
tz_def('TZ_N_15_GOLD', '15 or');
tz_def('TZ_N_1_INVITE_YOUR_FRIENDS_VIA_EMAIL', '1) Invitez vos amis par e-mail');
tz_def('TZ_N_20_GOLD', '20 or');
tz_def('TZ_N_2_COPY_YOUR_PERSONAL_REF_LINK_AN', '2) Copiez votre lien de parrainage personnel et partagez-le !');
tz_def('TZ_N_50_GOLD', '50 or');
tz_def('TZ_OK_2', 'OK');
tz_def('TZ_OPEN_FORUM_FOR_THE_FOLLOWING_PLAYE', 'Forum ouvert aux joueurs suivants');
tz_def('TZ_OPEN_FOR_MORE_ALLIANCES', 'Ouvert à d\'autres alliances');
tz_def('TZ_ORDER', 'Ordre :');
tz_def('TZ_OTHER', 'Autre');
tz_def('TZ_OWNER', 'Propriétaire :');
tz_def('TZ_PAY_SECURELY_WITH_PAYPAL', 'Payez en toute sécurité avec PayPal.');
tz_def('TZ_PLAYERS_BROUGHT_IN', 'Joueurs parrainés');
tz_def('TZ_POST_NEW_THREAD', 'Publier un nouveau sujet');
tz_def('TZ_PREVIEW', 'Aperçu');
tz_def('TZ_PREVIEW_2', 'aperçu');
tz_def('TZ_PROGRESS_OF_YOUR_INVITED_FRIENDS', 'Progression de vos amis invités');
tz_def('TZ_QUIT_ALLIANCE', 'Quitter l\'alliance');
tz_def('TZ_REGISTER_FOR_THE_GAME', 's\'inscrire au jeu');
tz_def('TZ_REGISTRATION', 'inscription');
tz_def('TZ_SENT', 'Envoyé :');
tz_def('TZ_SMILIES', 'Émoticônes');
tz_def('TZ_SMILIES_2', 'émoticônes');
tz_def('TZ_STONEMASON_S_LODGE', 'Tailleur de pierre');
tz_def('TZ_TAG', 'Tag :');
tz_def('TZ_TARGET_VILLAGE', 'Village cible :');
tz_def('TZ_TASK_10_CRANNY', 'Tâche 10 : Cachette');
tz_def('TZ_TASK_11_TO_TWO', 'Tâche 11 : Au niveau deux.');
tz_def('TZ_TASK_12_INSTRUCTIONS', 'Tâche 12 : Instructions');
tz_def('TZ_TASK_13_MAIN_BUILDING', 'Tâche 13 : Bâtiment principal');
tz_def('TZ_TASK_14_ADVANCED', 'Tâche 14 : Niveau avancé !');
tz_def('TZ_TASK_16_ECONOMY', 'Tâche 16 : Économie');
tz_def('TZ_TASK_16_MILITARY', 'Tâche 16 : Militaire');
tz_def('TZ_TASK_17_BARRACKS', 'Tâche 17 : Caserne');
tz_def('TZ_TASK_17_WAREHOUSE', 'Tâche 17 : Entrepôt');
tz_def('TZ_TASK_18_MARKETPLACE', 'Tâche 18 : Marché.');
tz_def('TZ_TASK_18_TRAIN', 'Tâche 18 : Entraînement.');
tz_def('TZ_TASK_19_EVERYTHING_TO_2', 'Tâche 19 : Tout au niveau 2.');
tz_def('TZ_TASK_20_ALLIANCE', 'Tâche 20 : Alliance.');
tz_def('TZ_TASK_21_MAIN_BUILDING_TO_LEVEL_5', 'Tâche 21 : Bâtiment principal au niveau 5');
tz_def('TZ_TASK_22_GRANARY_TO_LEVEL_3', 'Tâche 22 : Grenier au niveau 3.');
tz_def('TZ_TASK_23_WAREHOUSE_TO_LEVEL_7', 'Tâche 23 : Entrepôt au niveau 7.');
tz_def('TZ_TASK_24_ALL_TO_FIVE', 'Tâche 24 : Tout au niveau cinq !');
tz_def('TZ_TASK_25_PALACE_OR_RESIDENCE', 'Tâche 25 : Palais ou Résidence ?');
tz_def('TZ_TASK_26_3_SETTLERS', 'Tâche 26 : 3 colons.');
tz_def('TZ_TASK_27_NEW_VILLAGE', 'Tâche 27 : Nouveau village.');
tz_def('TZ_TASK_3_YOUR_VILLAGE_S_NAME', 'Tâche 3 : Le nom de votre village');
tz_def('TZ_TASK_9_DOVE_OF_PEACE', 'Tâche 9 : Colombe de la paix');
tz_def('TZ_TERMS', 'Conditions');
tz_def('TZ_THE_ALLIANCE', 'L\'alliance');
tz_def('TZ_THE_LARGEST_ALLIANCES', 'Les plus grandes alliances');
tz_def('TZ_THE_USER', 'L\'utilisateur');
tz_def('TZ_THREAD', 'Sujet');
tz_def('TZ_TOP_10', 'Top 10');
tz_def('TZ_TOTAL', 'Total');
tz_def('TZ_TOWNHALL', 'Hôtel de ville');
tz_def('TZ_TRAVIAN', 'Travian');
tz_def('TZ_TRAVIANX', 'TravianX');
tz_def('TZ_TRAVIANZ', 'TravianZ');
tz_def('TZ_TRAVIAN_GAMES', 'Travian Games');
tz_def('TZ_UNDERLINE', 'souligné');
tz_def('TZ_UNDERLINED', 'souligné');
tz_def('TZ_UNKNOWN', 'inconnu');
tz_def('TZ_UNTIL_THE_NEXT_LEVEL', 'jusqu\'au niveau suivant');
tz_def('TZ_USER_ID', 'ID utilisateur');
tz_def('TZ_VILLAGE', 'Village :');
tz_def('TZ_VILLAGE_OVERVIEW', 'Aperçu du village');
tz_def('TZ_WAIT_INSTANT', 'Attente : immédiat');
tz_def('TZ_WARNING', 'Attention :');
tz_def('TZ_WOOD', 'Bois');
tz_def('TZ_YOUR_PERSONAL_REF_LINK', 'Votre lien de parrainage personnel :');
tz_def('TZ_YOU_CAN_T_USE_THE_VALUES', 'vous ne pouvez pas utiliser les valeurs');
tz_def('TZ_YOU_HAVE_NOT_BROUGHT_IN_ANY_NEW_PL', 'Vous n\'avez encore parrainé aucun nouveau joueur.');


// ===== i18n etape 2 (lot suivant) =====
tz_def('TZ_ACCOUNT_IS_ADMIN_OR_MH', 'Le compte est Admin ou MH');
tz_def('TZ_ACCOUNT_IS_NOT_SCHEDULED_FOR_DELET', 'Le compte n\'est pas programmé pour suppression');
tz_def('TZ_ACCOUNT_STATEMENT', 'Relevé de compte');
tz_def('TZ_ACTIVATE_VACATION_MODE', 'Activer le mode vacances');
tz_def('TZ_ADD_RAID', 'Ajouter un raid');
tz_def('TZ_ADD_SLOT', 'Ajouter un emplacement');
tz_def('TZ_ADVANTAGES', 'Avantages');
tz_def('TZ_AFTER_PAYMENT_YOU_WILL_BE_CREDITED', 'Après le paiement, votre compte sera crédité automatiquement.');
tz_def('TZ_AGRESOR', 'Agresseur');
tz_def('TZ_ALLIANCE_DIPLOMACY', 'Diplomatie de l\'alliance');
tz_def('TZ_ALLIANCE_EVENTS', 'Événements de l\'alliance');
tz_def('TZ_ALLIANCE_FORUM', 'Forum de l\'alliance');
tz_def('TZ_ALLIANCE_MEMBERS', 'membres de l\'alliance.');
tz_def('TZ_ALLY_CHAT', 'Chat de l\'alliance');
tz_def('TZ_AM', 'am');
tz_def('TZ_AND_LATER_YOUR_VILLAGE_COULD_LOOK', '...et plus tard votre village pourrait ressembler à ça.');
tz_def('TZ_AND_QUIT_THE_ALLIANCE_AFTERWARDS', 'et quittez l\'alliance ensuite.');
tz_def('TZ_ASSIGN_RIGHTS', 'Attribuer des droits');
tz_def('TZ_ATTENTION_USE_ONLY_TRUSTWORTHY_GRA', 'ATTENTION ! N\'utilisez que des packs graphiques fiables');
tz_def('TZ_AUTHOR', 'Auteur');
tz_def('TZ_BEGINNERS_PROT', 'Prot. débutant');
tz_def('TZ_BEST_PLAYER', 'Meilleur joueur');
tz_def('TZ_BUILDING_SITE', 'emplacement de construction');
tz_def('TZ_BUILD_A_PALACE_OR_RESIDENCE_TO_LEV', 'Construisez un palais ou une résidence au niveau 10.');
tz_def('TZ_BUILD_CROPPER', 'Construire un cropper');
tz_def('TZ_BUY_IT_IN_THE_GOLD_SHOP', 'Achetez-le dans la boutique d\'or');
tz_def('TZ_CELEBRATION_STILL_NEEDS', 'la célébration nécessite encore :');
tz_def('TZ_CENTRE', 'Centre :');
tz_def('TZ_CHANGE_NAME', 'Changer le nom');
tz_def('TZ_CHANGE_YOUR_VILLAGE_S_NAME_TO_SOME', 'Donnez un joli nom à votre village.');
tz_def('TZ_CHINESE', 'Chinois');
tz_def('TZ_CLAY_25_5_GOLD', 'Argile +25% (5 or)');
tz_def('TZ_CLOSED_FORUM', 'Forum fermé');
tz_def('TZ_CLOSE_ADRESSBOOK', 'fermer le carnet d\'adresses');
tz_def('TZ_COMBAT_SIMULATOR', 'Simulateur de combat');
tz_def('TZ_COMPLETE_DEMOLITION_10', 'Démolition complète (10');
tz_def('TZ_CONFEDERATION_FORUM', 'Forum de confédération');
tz_def('TZ_CONFIRM_WITH_PASSWORD', 'Confirmez avec le mot de passe :');
tz_def('TZ_CONSTRUCT_A_CRANNY', 'Construisez une cachette.');
tz_def('TZ_CONSTRUCT_A_GRANARY', 'Construisez un grenier.');
tz_def('TZ_CONSTRUCT_A_RALLY_POINT', 'Construisez un point de ralliement.');
tz_def('TZ_CONSTRUCT_A_WOODCUTTER', 'Construisez un bûcheron.');
tz_def('TZ_CONSTRUCT_BARRACKS', 'Construisez une caserne.');
tz_def('TZ_CONSTRUCT_WAREHOUSE', 'Construisez un entrepôt.');
tz_def('TZ_CP_DAY', 'PC/jour');
tz_def('TZ_CROP_25_5_GOLD', 'Céréales +25% (5 or)');
tz_def('TZ_DATE_AND_TIME', 'Date et heure');
tz_def('TZ_DEBUG_OFF', 'Journal debug DÉSACTIVÉ');
tz_def('TZ_DEBUG_ON', 'Journal debug ACTIVÉ');
tz_def('TZ_DECLARE_WAR', 'déclarer la guerre');
tz_def('TZ_DEFAULT', 'Par défaut :');
tz_def('TZ_DELETE_ACCOUNT', 'Supprimer le compte ?');
tz_def('TZ_DIFFERENT_EMAIL_ADDRESS', 'adresse e-mail différente');
tz_def('TZ_DOWNLOAD_FROM', 'Télécharger depuis');
tz_def('TZ_DO_I_NEED_PLUS_TO_USE_OTHER_FEATUR', 'Ai-je besoin de Plus pour utiliser d\'autres fonctions ?');
tz_def('TZ_EARN_GOLD', 'Gagner de l\'or');
tz_def('TZ_EDIT_ANSWER', 'Modifier la réponse');
tz_def('TZ_EDIT_ANSWER_2', 'modifier la réponse');
tz_def('TZ_EDIT_FORUM', 'modifier le forum');
tz_def('TZ_EDIT_SLOT', 'Modifier l\'emplacement');
tz_def('TZ_EDIT_TOPIC', 'Modifier le sujet');
tz_def('TZ_ENDS_ON', 'se termine le');
tz_def('TZ_ENGLISH', 'Anglais');
tz_def('TZ_ENTER_HOW_MUCH_LUMBER_THE_BARRACKS', 'Indiquez le coût en bois de la caserne');
tz_def('TZ_EU_DD_MM_YY_24H', 'UE (jj.mm.aa 24h)');
tz_def('TZ_EXAMPLE', 'Exemple :');
tz_def('TZ_EXISTING_RELATIONSHIPS', 'Relations existantes');
tz_def('TZ_EXTEND_ALL_RESOURCE_TILES_TO_LEVEL', 'Améliorez tous les champs de ressources au niveau 1.');
tz_def('TZ_EXTEND_ALL_RESOURCE_TILES_TO_LEVEL_2', 'Améliorez tous les champs de ressources au niveau 2.');
tz_def('TZ_EXTEND_ONE_CLAY_PIT', 'Améliorez une carrière d\'argile.');
tz_def('TZ_EXTEND_ONE_CROPLAND', 'Améliorez un champ de céréales.');
tz_def('TZ_EXTEND_ONE_IRON_MINE', 'Améliorez une mine de fer.');
tz_def('TZ_EXTEND_ONE_OF_EACH_RESOURCE_TILE_T', 'Améliorez un champ de chaque ressource au niveau 2.');
tz_def('TZ_EXTEND_YOUR_MAIN_BUILDING_TO_LEVEL', 'Améliorez votre bâtiment principal au niveau 3.');
tz_def('TZ_FINISH', 'Terminer');
tz_def('TZ_FOLLOWING_CAUSES_ARE_POSSIBLE', 'Les causes suivantes sont possibles :');
tz_def('TZ_FOLLOW_THIS_LINK_TO', 'Suivez ce lien pour');
tz_def('TZ_FOREIGN_OFFERS', 'Offres étrangères');
tz_def('TZ_FORUM_TYPE', 'Type de forum');
tz_def('TZ_FOUND_A_NEW_VILLAGE', 'Fondez un nouveau village.');
tz_def('TZ_FREE', 'GRATUIT !');
tz_def('TZ_FRENCH', 'Français');
tz_def('TZ_FRIEND_EMAIL_COM', 'friend@email.com');
tz_def('TZ_GAME_LANGUAGE', 'Langue du jeu');
tz_def('TZ_GITHUB', 'Github');
tz_def('TZ_GRAPHIC_PACK_FOUND', 'Pack graphique trouvé.');
tz_def('TZ_GRAPHIC_PACK_SETTINGS', 'Paramètres du pack graphique');
tz_def('TZ_GREAT_STABLES', 'Grandes écuries');
tz_def('TZ_HERE', 'ici');
tz_def('TZ_HERE_YOU_CAN_KICK_THE_PLAYERS_FROM', 'Ici vous pouvez exclure les joueurs de votre alliance.');
tz_def('TZ_HERE_YOU_FIND_YOUR_RESOURCE_FIELDS', 'Ici se trouvent vos champs de ressources');
tz_def('TZ_HINT', 'Astuce');
tz_def('TZ_HOW_DO_I_GET_GOLD', 'Comment obtenir de l\'or ?');
tz_def('TZ_INACTIVE_DURING_VACATION', 'Inactif pendant les vacances');
tz_def('TZ_INFORMATION_ON_HAPPENINGS_IN_YOUR', 'Informations sur les événements de votre village');
tz_def('TZ_INITIATE_PAYMENT_BY_PAYPAL', 'Initier le paiement par PayPal');
tz_def('TZ_INVITATIONS', 'Invitations :');
tz_def('TZ_INVITE_A_PLAYER_INTO_THE_ALLIANCE', 'Inviter un joueur dans l\'alliance');
tz_def('TZ_INVITE_BY_E_MAIL_OR_SHARE_YOUR_REF', 'Invitez par e-mail ou partagez votre lien de parrainage.');
tz_def('TZ_IN_DESCRIPTION', 'dans la description.');
tz_def('TZ_IN_THE_VILLAGE_YOU_CAN_BUILD_BUILD', 'Dans le village vous pouvez construire des bâtiments');
tz_def('TZ_IRON_25_5_GOLD', 'Fer +25% (5 or)');
tz_def('TZ_ISO_YY_MM_DD_24H', 'ISO (aa/mm/jj 24h)');
tz_def('TZ_ITALIAN', 'Italien');
tz_def('TZ_I_ACTIVATED_PLUS_BUT_PRODUCTION_DI', 'J\'ai activé Plus, mais la production n\'a pas augmenté.');
tz_def('TZ_JOIN_AN_ALLIANCE', 'Rejoindre une alliance');
tz_def('TZ_JOIN_AN_ALLIANCE_OR_FOUND_ONE_ON_Y', 'Rejoignez une alliance ou fondez la vôtre.');
tz_def('TZ_JUL', 'juil.');
tz_def('TZ_JUN', 'juin');
tz_def('TZ_KICK_ALL_MEMBERS', 'exclure tous les membres');
tz_def('TZ_KICK_PLAYER', 'Exclure le joueur :');
tz_def('TZ_LANGUAGE_SETTINGS', 'Paramètres de langue');
tz_def('TZ_LAST_POST', 'Dernier message');
tz_def('TZ_LAST_RAID', 'Dernier raid');
tz_def('TZ_LINKS', 'Liens :');
tz_def('TZ_LINK_TO_THE_FORUM', 'Lien vers le forum');
tz_def('TZ_LOG_IN', 'se connecter');
tz_def('TZ_LUMBER_25_5_GOLD', 'Bois +25% (5 or)');
tz_def('TZ_MAINTENANCE_OFF', 'Maintenance DÉSACTIVÉE');
tz_def('TZ_MAINTENANCE_ON', 'Maintenance ACTIVÉE');
tz_def('TZ_MAJOR_CHANGES', 'Changements majeurs :');
tz_def('TZ_MAP_2', 'Carte :');
tz_def('TZ_MAXIMUM_VACATION', 'Vacances maximum :');
tz_def('TZ_MESSAGES', 'Messages :');
tz_def('TZ_MESSAGE_3', 'Message');
tz_def('TZ_MILITARY_EVENTS', 'Événements militaires');
tz_def('TZ_MINIMUM_VACATION', 'Vacances minimum :');
tz_def('TZ_MINOR_CHANGES', 'Changements mineurs :');
tz_def('TZ_MISCELLANEOUS', 'Divers');
tz_def('TZ_MORE_GRAPHIC_PACKS', 'Plus de packs graphiques');
tz_def('TZ_MORE_INFO', 'Plus d\'infos :');
tz_def('TZ_MOVE_TOPIC', 'Déplacer le sujet');
tz_def('TZ_MULTIHUNTER', 'Multichasseur :');
tz_def('TZ_NEW_FORUM', 'Nouveau forum');
tz_def('TZ_NONE_OF_THE_PACKAGES_ARE_REFUNDABL', 'Aucun des forfaits n\'est remboursable !');
tz_def('TZ_NOT_ENOUGH_RESOURCE', 'Ressources insuffisantes');
tz_def('TZ_NO_MARKETPLACE_ACTIVITY', 'Aucune activité sur le marché');
tz_def('TZ_NO_OWNERSHIP_OF_AN_ARTIFACT_VILLAG', 'Aucune possession d\'un village artefact');
tz_def('TZ_NO_OWNERSHIP_OF_A_WONDER_OF_THE_WO', 'Aucune possession d\'un village Merveille du Monde');
tz_def('TZ_NO_REINFORCING_TROOPS_SENT_RECEIVE', 'Aucune troupe de renfort envoyée/reçue');
tz_def('TZ_NO_REPORTS_FOR_TRANSFERS_FROM_FORE', 'Aucun rapport pour les transferts depuis des villages étrangers.');
tz_def('TZ_NO_REPORTS_FOR_TRANSFERS_TO_FOREIG', 'Aucun rapport pour les transferts vers des villages étrangers.');
tz_def('TZ_NO_REPORTS_FOR_TRANSFERS_TO_OWN_VI', 'Aucun rapport pour les transferts vers vos propres villages.');
tz_def('TZ_N_14_DAYS', '14 jours');
tz_def('TZ_N_1_1_TRADE_WITH_THE_NPC_MERCHANT', 'Échange 1:1 avec le marchand PNJ');
tz_def('TZ_N_1_5_YOUR_VILLAGE', '(1/5) Votre village');
tz_def('TZ_N_1_CHOOSE_A_RESOURCE_FIELD', '1. Choisissez un champ de ressources');
tz_def('TZ_N_1_CHOOSE_BUILDING_SITE', '1. Choisissez un emplacement de construction');
tz_def('TZ_N_2_5_RESOURCES', '(2/5) Ressources');
tz_def('TZ_N_2_CONSTRUCT_A_BUILDING', '2. Construisez un bâtiment');
tz_def('TZ_N_2_DAYS', '2 jours');
tz_def('TZ_N_2_EXTEND_THE_RESOURCE_FIELD', '2. Améliorez le champ de ressources');
tz_def('TZ_N_3_5_BUILDINGS', '(3/5) Bâtiments');
tz_def('TZ_N_4_5_NEIGHBOURS', '(4/5) Voisins');
tz_def('TZ_N_5_5_NAVIGATION', '(5/5) Navigation');
tz_def('TZ_OFFER_A_CONFEDERATION', 'proposer un pacte total');
tz_def('TZ_OFFER_NON_AGGRESSION_PACT', 'proposer un pacte de non-agression');
tz_def('TZ_OK_3', 'ok');
tz_def('TZ_ONLINE_USERS', 'Utilisateurs en ligne');
tz_def('TZ_OPTION_1', 'Option 1 :');
tz_def('TZ_OPTION_2', 'Option 2 :');
tz_def('TZ_OPTION_3', 'Option 3 :');
tz_def('TZ_OPTION_4', 'Option 4 :');
tz_def('TZ_OPTION_5', 'Option 5 :');
tz_def('TZ_OPTION_6', 'Option 6 :');
tz_def('TZ_OPTION_7', 'Option 7 :');
tz_def('TZ_OPTION_8', 'Option 8 :');
tz_def('TZ_ORDERED_PACKAGE', 'Pack commandé');
tz_def('TZ_OR_ASK_THE_SERVER_OWNER', 'ou demandez au propriétaire du serveur.');
tz_def('TZ_OVERVIEW', 'Aperçu :');
tz_def('TZ_OWN_TEXT', 'Texte personnel :');
tz_def('TZ_PALACE_RESIDENCE', 'Palais/Résidence');
tz_def('TZ_PASSWORD', 'mot de passe :');
tz_def('TZ_PAYMENT_ACCOUNT', 'compte de paiement');
tz_def('TZ_PAYPAL', 'PayPal');
tz_def('TZ_PAYPAL_PACKAGE_A', 'PayPal – Pack A');
tz_def('TZ_PAYPAL_PACKAGE_B', 'PayPal – Pack B');
tz_def('TZ_PAYPAL_PACKAGE_C', 'PayPal – Pack C');
tz_def('TZ_PAYPAL_PACKAGE_D', 'PayPal – Pack D');
tz_def('TZ_PAYPAL_PACKAGE_E', 'PayPal – Pack E');
tz_def('TZ_PLAY_NO_TASKS', 'Ne pas jouer les tâches.');
tz_def('TZ_PLEASE_BUILD_A_MARKETPLACE', 'Veuillez construire un marché.');
tz_def('TZ_PLUS_FUNCTIONS', 'Fonctions Plus');
tz_def('TZ_PM', 'pm');
tz_def('TZ_POP', 'Pop');
tz_def('TZ_POSITION', 'Poste :');
tz_def('TZ_PRODUCTION_CLAY', 'Production : Argile');
tz_def('TZ_PRODUCTION_CROP', 'Production : Céréales');
tz_def('TZ_PRODUCTION_IRON', 'Production : Fer');
tz_def('TZ_PRODUCTION_LUMBER', 'Production : Bois');
tz_def('TZ_PUBLIC_FORUM', 'Forum public');
tz_def('TZ_RAGEZONE_COM', 'RageZone.com');
tz_def('TZ_RANKING_OF_ALL_PLAYERS', 'Classement de tous les joueurs');
tz_def('TZ_RATIO', 'ratio');
tz_def('TZ_READ_YOUR_NEW_MESSAGE', 'Lisez votre nouveau message.');
tz_def('TZ_REGISTERED', 'Inscrit');
tz_def('TZ_REGISTERED_PLAYERS', 'Joueurs inscrits');
tz_def('TZ_RELEASED_BY_TRAVIANZ_TEAM', 'Publié par : l\'équipe TravianZ');
tz_def('TZ_RELEASE_BY_TRAVIANZ', '[Publié par : TravianZ]');
tz_def('TZ_REPLIES', 'Réponses');
tz_def('TZ_REPORTS', 'Rapports :');
tz_def('TZ_REQUIREMENTS', 'Prérequis');
tz_def('TZ_ROMANIAN', 'Roumain');
tz_def('TZ_SCOUT_DEFENCES_AND_TROOPS', 'Espionner les défenses et les troupes');
tz_def('TZ_SCOUT_RESOURCES_AND_TROOPS', 'Espionner les ressources et les troupes');
tz_def('TZ_SCRIPT_PRICE', 'Prix du script :');
tz_def('TZ_SELECT_ALL', 'Tout sélectionner');
tz_def('TZ_SELECT_REWARD', 'Sélectionner une récompense...');
tz_def('TZ_SELECT_REWARD_2', 'Sélectionner la récompense :');
tz_def('TZ_SEND_200_CROP_TO_THE_TASKMASTER', 'Envoyez 200 céréales au maître du jeu.');
tz_def('TZ_SEND_AND_RECEIVE_MESSAGES', 'Envoyer et recevoir des messages');
tz_def('TZ_SEND_UNITS_BACK', 'Renvoyer les unités');
tz_def('TZ_SERVER_START', 'Démarrage du serveur');
tz_def('TZ_SHOW_THE_LARGE_MAP_IN_AN_EXTRA_WIN', 'Afficher la grande carte dans une fenêtre supplémentaire.');
tz_def('TZ_SIZE_IN_MB', 'Taille en Mo');
tz_def('TZ_SLOTS', 'Emplacements');
tz_def('TZ_START_RAID', 'Lancer le raid');
tz_def('TZ_STATISTICS', 'Statistiques :');
tz_def('TZ_SUPPORT', 'Support :');
tz_def('TZ_SUPPORT_AND_MULTIHUNTER', 'Support et Multichasseur');
tz_def('TZ_SURVEY', 'sondage');
tz_def('TZ_TARIFFS', 'Tarifs');
tz_def('TZ_TASK_7_HUGE_ARMY', 'Tâche 7 : Immense armée !');
tz_def('TZ_TASK_8_EVERYTHING_TO_1', 'Tâche 8 : Tout au niveau 1.');
tz_def('TZ_THANK_YOU_FOR_USING_OUR_VERSION', 'Merci d\'utiliser notre version !');
tz_def('TZ_THERE_ARE_NO_INCOMING_TROOPS', 'Aucune troupe entrante');
tz_def('TZ_THERE_ARE_NO_OUTGOING_TROOPS', 'Aucune troupe sortante');
tz_def('TZ_THE_BEST_ALLIANCES_DEF', 'Les meilleures alliances (déf)');
tz_def('TZ_THE_BEST_ALLIANCES_OFF', 'Les meilleures alliances (att)');
tz_def('TZ_THE_BUILDING_WAS_COMPLETELY_DEMOLI', 'Le bâtiment a été entièrement démoli pour 10 or !');
tz_def('TZ_THE_EMAIL_ACCOUNT_S_STORAGE_LIMIT', 'La limite de stockage du compte e-mail est atteinte');
tz_def('TZ_THE_EMAIL_HAS_BEEN_MOVED_TO_THE_SP', 'L\'e-mail a été déplacé dans le dossier spam/indésirables');
tz_def('TZ_THE_EMAIL_WILL_BE_SENT_TO_FOLLOWIN', 'L\'e-mail sera envoyé à l\'adresse suivante :');
tz_def('TZ_THE_E_MAIL_ADDRESS_OF_THE_NEW_OWNE', 'L\'adresse e-mail du nouveau propriétaire.');
tz_def('TZ_THE_GAME_WORLD_ON_WHICH_THE_ACCOUN', 'Le monde de jeu sur lequel se trouve le compte');
tz_def('TZ_THE_HERO', 'Le Héros');
tz_def('TZ_THE_LARGEST_GAULS', 'Les plus grands Gaulois');
tz_def('TZ_THE_LARGEST_PLAYERS', 'Les plus grands joueurs');
tz_def('TZ_THE_LARGEST_ROMANS', 'Les plus grands Romains');
tz_def('TZ_THE_LARGEST_TEUTONS', 'Les plus grands Germains');
tz_def('TZ_THE_LARGEST_HUNS', 'Les plus grands Huns');
tz_def('TZ_THE_LARGEST_EGYPTIANS', 'Les plus grands Egyptiens');
tz_def('TZ_THE_LARGEST_SPARTANS', 'Les plus grands Spartiates');
tz_def('TZ_THE_LARGEST_VIKINGS', 'Les plus grands Vikings');
tz_def('TZ_THE_LARGEST_VILLAGES', 'Les plus grands villages');
tz_def('TZ_THE_MOST_EXPERIENCED_HEROES', 'Les héros les plus expérimentés');
tz_def('TZ_THE_MOST_SUCCESSFUL_ATTACKERS', 'Les attaquants les plus performants');
tz_def('TZ_THE_MOST_SUCCESSFUL_DEFENDERS', 'Les défenseurs les plus performants');
tz_def('TZ_THE_MULTIHUNTERS_ARE_RESPONSIBLE_F', 'Les Multihunters sont responsables du respect de');
tz_def('TZ_THE_NAVIGATION_BAR', 'La barre de navigation');
tz_def('TZ_THE_NICKNAME_OF_THE_ACCOUNT', 'Le pseudonyme du compte');
tz_def('TZ_THE_PATH', 'Le chemin');
tz_def('TZ_THE_VILLAGE', 'Le village');
tz_def('TZ_THIS_FEATURE_IS_NOT_INCLUDED_IN_TH', 'Cette fonction n\'est PAS incluse dans le club d\'or !');
tz_def('TZ_THIS_IS_HOW_YOU_START', 'Voici comment commencer...');
tz_def('TZ_THREADS', 'Sujets');
tz_def('TZ_TIME_PREFERENCE', 'Préférence horaire');
tz_def('TZ_TIME_ZONES', 'Fuseaux horaires');
tz_def('TZ_TIP', 'Astuce');
tz_def('TZ_TOP_10_ALLIANCES', 'Top 10 des alliances');
tz_def('TZ_TOP_10_PLAYERS', 'Top 10 des joueurs');
tz_def('TZ_TOTAL_POPULATION', 'Population totale');
tz_def('TZ_TOTAL_VILLAGES', 'Villages au total');
tz_def('TZ_TO_THE_FIRST_TASK', 'Vers la première tâche.');
tz_def('TZ_TO_THE_REGISTRATION', 'vers l\'inscription');
tz_def('TZ_TRAIN_3_SETTLERS', 'Entraînez 3 colons.');
tz_def('TZ_TRAVIAN_DEFAULT', 'Travian Default');
tz_def('TZ_TRAVIAN_GOLD_CLUB', 'Travian Gold Club');
tz_def('TZ_TRAVIAN_T4_STYLE', 'Travian T4 Style');
tz_def('TZ_TRIBES', 'Tribus');
tz_def('TZ_TYPOS_IN_THE_EMAIL_ADDRESS', 'Fautes de frappe dans l\'adresse e-mail');
tz_def('TZ_UK_DD_MM_YY_12H', 'RU (jj/mm/aa 12h)');
tz_def('TZ_UPGRADE_ALL_RESOURCES_TILES_TO_LEV', 'Améliorez tous les champs de ressources au niveau 5.');
tz_def('TZ_UPGRADE_YOUR_GRANARY_TO_LEVEL_3', 'Améliorez votre grenier au niveau 3.');
tz_def('TZ_UPGRADE_YOUR_MAIN_BUILDING_TO_LEVE', 'Améliorez votre bâtiment principal au niveau 5.');
tz_def('TZ_UPGRADE_YOUR_WAREHOUSE_TO_LEVEL_7', 'Améliorez votre entrepôt au niveau 7.');
tz_def('TZ_USE', 'Utiliser');
tz_def('TZ_USED_FOR_RALLY_POINT_AND_MARKETPLA', 'Utilisé pour le point de ralliement et le marché :');
tz_def('TZ_USERNAME', 'Nom d\'utilisateur');
tz_def('TZ_USER_DEFINED_GRAPHIC_PACK', 'Pack graphique personnalisé');
tz_def('TZ_USE_IT_FOR_PLUS_OR_ANY_ADVANTAGE', '. Utilisez-le pour Plus ou tout autre avantage.');
tz_def('TZ_US_MM_DD_YY_12H', 'US (mm/jj/aa 12h)');
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
tz_def('TZ_VERSION', 'Version :');
tz_def('TZ_VILLAGE_EXP', 'Exp. du village');
tz_def('TZ_VILLAGE_YOU_GET', 'village, vous obtenez');
tz_def('TZ_VILLAGE_YOU_WILL_BE_CREDITED_WITH', 'village, votre compte sera crédité de');
tz_def('TZ_VIP_ACCOUNT_10_GOLD_7_DAYS', 'Compte VIP (10 or – 7 jours)');
tz_def('TZ_VISIT', 'Visiter :');
tz_def('TZ_VOTE', 'Voter');
tz_def('TZ_WAIT_24H', 'Attente : 24h');
tz_def('TZ_WAIT_INSTANT_AFTER_IPN', 'Attente : immédiat après IPN');
tz_def('TZ_WARNING_CATAPULT_WILL', 'Attention : la catapulte va');
tz_def('TZ_WE_STRIVE_TO_ENSURE_SPEEDY_PROCESS', 'Nous nous efforçons d\'assurer un traitement rapide !');
tz_def('TZ_WHY_CAN_T_I_FINISH_SOME_BUILDINGS', 'Pourquoi ne puis-je pas terminer certains bâtiments avec de l\'or ?');
tz_def('TZ_WILL_BE_ATTACKED_BY_CATAPULT_S', '(sera attaqué par catapulte(s))');
tz_def('TZ_WILL_SPAWN_IN', 'apparaîtra dans :');
tz_def('TZ_WILL_SPAWN_IN_ARTIFACTS', 'Les artefacts');
tz_def('TZ_WILL_SPAWN_IN_WW', 'Les villages Merveille du Monde');
tz_def('TZ_WILL_SPAWN_IN_PLAN', 'Les plans de la Merveille du Monde');
tz_def('TZ_WOODCUTTER_INSTANTLY_COMPLETED', 'Bûcheron terminé instantanément.');
tz_def('TZ_WORLD_STATS', 'Statistiques du monde');
tz_def('TZ_WRITE_THE_CODE', 'Saisissez le code');
tz_def('TZ_WRONG_DOMAIN_THERE_IS_E_G_NO_AOL_D', 'Mauvais domaine : il n\'y a p. ex. pas de @aol.de, seulement @aol.com');
tz_def('TZ_YOUR_ACCOUNT_HAS_BEEN_SUCCESSFULLY', 'Votre compte a été activé avec succès.');
tz_def('TZ_YOUR_VILLAGE_AND_YOUR_NEIGHBOURS', 'Votre village et vos voisins');
tz_def('TZ_YOU_CAN_UNDO_THE_REGISTRATION_AND', 'Vous pouvez annuler l\'inscription et vous réinscrire avec une');
tz_def('TZ_YOU_CAN_USE_THIS_GOLD_FOR_PLUS_OR', '. Vous pouvez utiliser cet or pour Plus ou tout avantage en or.');

// ===== Server Milestones (NEW_FUNCTIONS_MILESTONES) =====
tz_def('TZ_MILESTONE_NOT_YET', 'Pas encore finalisé');
tz_def('TZ_MILESTONE_SECOND_VILLAGE', 'Premier à fonder un 2e village');
tz_def('TZ_MILESTONE_POPULATION_1000', 'Premier à atteindre une population de 1 000');
tz_def('TZ_MILESTONE_FIRST_ARTIFACT', 'Premier à capturer un artefact');
tz_def('TZ_MILESTONE_FIRST_WW', 'Premier à conquérir une Merveille du monde');
tz_def('TZ_MILESTONE_FIRST_WW_PLAN', 'Premier à conquérir un plan de construction de Merveille');
tz_def('TZ_MILESTONE_FIRST_ALLIANCE', 'Première alliance fondée');
tz_def('TZ_MILESTONE_FIRST_PVP_CONQUEST', 'Premier village conquis à un joueur');
tz_def('TZ_MILESTONE_FIVE_VILLAGES', 'Premier à fonder 5 villages');
tz_def('TZ_MILESTONE_FOUNDED_BY', 'Fondé par');

// ===== i18n etape 2 (lot suivant) =====
tz_def('TZ_ACCOUNT_OR_INCREASE_YOUR_RESOURCE', '-Compte ou augmentez votre production de ressources. Pour ce faire, cliquez');
tz_def('TZ_ADDITIONALLY_THE_TRAVIAN_TEAM_WILL', 'De plus, l\'équipe Travian ne fournira d\'informations concernant les bannissements à aucune personne autre que le propriétaire du compte.');
tz_def('TZ_ADVERTISEMENT_OF_ANY_KIND_THAT_HAS', 'Toute publicité non autorisée par l\'équipe Travian est interdite.');
tz_def('TZ_AFTERWARDS_BOTH_PARTIES_MUST_REQUE', 'Ensuite, les deux parties doivent demander le mot de passe de leur nouveau compte via la fonction de récupération de mot de passe.');
tz_def('TZ_AFTER_TAKING_CARE_OF_YOUR_RESOURCE', 'Après avoir assuré votre approvisionnement en ressources, vous pouvez commencer l\'expansion de votre village.');
tz_def('TZ_ANY_SALES_OR_PURCHASES_CONCERNING', 'Toute vente ou achat impliquant de l\'argent réel concernant des comptes, unités, villages, ressources, services ou tout autre aspect de Travian est interdit. La vente de comptes Travian ainsi que tout transfert indirect (même sous forme de cadeau) en lien avec des sites d\'enchères ou d\'autres transactions monétaires est interdit.');
tz_def('TZ_AS_A_LEADER_YOU_CAN_ONLY_CHANGE_YO', 'En tant que dirigeant, vous ne pouvez changer que votre titre. Vos droits restent au maximum.');
tz_def('TZ_A_SITTER_CAN_LOG_INTO_YOUR_ACCOUNT', 'Un remplaçant peut se connecter à votre compte avec votre nom et son propre mot de passe. Vous pouvez avoir jusqu\'à deux remplaçants.');
tz_def('TZ_A_WAREHOUSE_AND_A_GRANARY_ENABLE_Y', 'Un entrepôt et un grenier vous permettent de stocker plus de ressources. Une cachette protège vos ressources du vol par les pillards ennemis.');
tz_def('TZ_BECAUSE_YOU_ARE_THE_ALLIANCE_FOUND', 'Comme vous êtes le fondateur de l\'alliance, vous devez choisir un fondateur remplaçant avant de partir.');
tz_def('TZ_BEFORE_YOU_EXPAND_YOUR_VILLAGE_S_B', 'Avant d\'agrandir les bâtiments de votre village, vous devriez développer quelques champs de ressources pour augmenter votre approvisionnement.');
tz_def('TZ_BLACKMAILING_PLAYERS_IN_A_WAY_THAT', 'Faire chanter des joueurs d\'une manière qui enfreint l\'une des règles de Travian conformément aux Conditions Générales.');
tz_def('TZ_COMPLETE_CONSTRUCTION_ORDERS_AND_R', 'Terminez maintenant les ordres de construction et les recherches dans ce village');
tz_def('TZ_DISPLAYING_BATTLE_REPORTS_OR_MESSA', 'Afficher publiquement des rapports de combat ou des messages sans le consentement des deux parties concernées.');
tz_def('TZ_EACH_PLAYER_MAY_ONLY_OWN_AND_PLAY', 'Chaque joueur ne peut posséder et jouer qu\'un seul compte par serveur.');
tz_def('TZ_ENGLISH_IS_THE_ONLY_LANGUAGE_TOLER', 'L\'anglais est la seule langue tolérée dans les messages et les descriptions.');
tz_def('TZ_FOLLOWING_BEHAVIOR_IS_PUNISHABLE_A', 'Le comportement suivant est punissable et s\'applique à toutes les descriptions, au nom du compte, aux noms d\'alliance, aux noms de village et aux messages :');
tz_def('TZ_HERE_YOU_CAN_CHANGE_TRAVIAN_S_DISP', 'Ici vous pouvez modifier l\'heure affichée de Travian pour l\'adapter à votre fuseau horaire.');
tz_def('TZ_HERE_YOU_CAN_HAVE_A_LOOK_AT_YOUR_V', 'Ici vous pouvez observer les environs de votre village et vos voisins');
tz_def('TZ_HOWEVER_IT_IS_PERMISSIBLE_TO_TRANS', 'Cependant, il est permis de transmettre le mot de passe d\'un compte à une ou plusieurs personnes jouant sur un monde de jeu différent (ou ne jouant pas du tout) afin de jouer ensemble un même compte.');
tz_def('TZ_IF_INDIVIDUAL_REGULATIONS_OF_THIS', 'Si certaines dispositions de ce règlement s\'avéraient de quelque manière que ce soit inefficaces, cela n\'affecte pas la validité des autres dispositions de ce règlement. Les administrateurs s\'engagent à remplacer les dispositions inefficaces par de nouvelles dispositions dès que possible.');
tz_def('TZ_IF_THERE_IS_AN_OFFENCE_AGAINST_THE', 'En cas d\'infraction à ces règles du jeu, les Multichasseurs et, si nécessaire, les administrateurs banniront le ou les comptes concernés et décideront d\'une sanction appropriée. Les sanctions dépasseront toujours le gain tiré de la violation des règles.');
tz_def('TZ_IF_YOUR_ALLIANCE_WANTS_TO_USE_AN_E', 'Si votre alliance souhaite utiliser un forum externe, vous pouvez saisir l\'URL ici.');
tz_def('TZ_IMPERSONATING_OFFICIALS_OR_OFFICIA', 'Se faire passer pour des officiels ou des fonctions officielles est illégal de quelque manière que ce soit.');
tz_def('TZ_INCITING_MANIPULATING_ENCOURAGING', 'Inciter, manipuler, encourager, aider ou conspirer avec d\'autres pour enfreindre l\'une des règles de Travian est interdit. Ces règles s\'appliquent sans exception aux joueurs qui supprimeront leur compte ou sont en train de le supprimer.');
tz_def('TZ_INTO_YOUR_PROFILE_BY_ADDING_IT_TO', 'dans votre profil en l\'ajoutant à l\'un des deux champs de description.');
tz_def('TZ_IN_ORDER_TO_ACTIVATE_YOUR_ACCOUNT', 'Pour activer votre compte, saisissez le code ou cliquez sur le lien dans votre e-mail.');
tz_def('TZ_IN_ORDER_TO_PLAY_TRAVIAN_YOU_NEED', 'Pour jouer à Travian, vous avez besoin d\'une adresse e-mail valide à laquelle le code d\'activation peut être envoyé. Dans des cas exceptionnels, cet e-mail peut ne pas arriver.');
tz_def('TZ_IN_ORDER_TO_QUIT_THE_ALLIANCE_YOU', 'Pour quitter l\'alliance, vous devez saisir à nouveau votre mot de passe pour des raisons de sécurité.');
tz_def('TZ_IN_ORDER_TO_SWITCH_AN_ACCOUNT_WITH', 'Pour échanger un compte avec une autre personne sur le même monde de jeu, les deux personnes doivent envoyer un e-mail à admin@travian.com depuis l\'adresse e-mail actuellement enregistrée pour le compte. L\'e-mail doit contenir les informations suivantes :');
tz_def('TZ_IN_THE_BEGINNING_YOUR_SMALL_VILLAG', 'Au début, votre petit village n\'aura qu\'un seul bâtiment.');
tz_def('TZ_IN_TRAVIAN_YOU_ARE_NOT_ALONE_YOU_I', 'Dans Travian, vous n\'êtes pas seul ; vous interagissez avec des milliers d\'autres joueurs dans le monde de Travian.');
tz_def('TZ_IT_S_PART_OF_DIPLOMATIC_ETIQUETTE', 'Il fait partie de l\'étiquette diplomatique de parler à une autre alliance avant d\'envoyer une offre.');
tz_def('TZ_MULTIACCOUNTS_ON_THE_SPEED_SERVER', 'Les multicomptes sur le serveur rapide et les multicomptes de moins de 100 habitants peuvent être supprimés à vue sans avertissement préalable.');
tz_def('TZ_NOW_YOU_HAVE_FULFILLED_ALL_PREREQU', 'Vous avez maintenant rempli tous les prérequis nécessaires pour construire un marché.');
tz_def('TZ_NOW_YOU_KNOW_EVERYTHING_IMPORTANT', 'Vous savez maintenant tout ce qui est important sur Travian. Après l\'inscription, vous pouvez commencer à jouer !');
tz_def('TZ_NO_EVERY_GOLD_FEATURE_WORKS_STANDA', 'Non. Chaque fonction en or fonctionne de manière autonome tant que vous avez assez d\'or.');
tz_def('TZ_NO_REAL_WORLD_POLITICS_ARE_ALLOWED', 'Aucune politique du monde réel n\'est autorisée dans les noms, messages et descriptions.');
tz_def('TZ_PARTICIPATION_IN_ABUSIVE_DEFAMATOR', 'Participation à des propos injurieux, diffamatoires, sexistes, racistes ou grossiers ; dénigrement de toute religion, race, nation, sexe, tranche d\'âge ou orientation sexuelle ; menace d\'actions dans la vie réelle envers une personne.');
tz_def('TZ_PLAYERS_MAY_TALK_TO_THE_MULTIHUNTE', 'Les joueurs peuvent s\'adresser au Multichasseur qui les a bannis ou à un administrateur via MIJ (message en jeu) ou e-mail. Les bannissements, sanctions ou suppressions ne doivent pas être discutés en public (par ex. Chat ou Forums). Les recours doivent être rédigés en anglais.');
tz_def('TZ_PLEASE_ENTER_YOUR_OLD_AND_YOUR_NEW', 'Veuillez saisir votre ancienne et votre nouvelle adresse e-mail. Vous recevrez alors un extrait de code aux deux adresses, que vous devrez saisir ici.');
tz_def('TZ_PLUS_DOES_NOT_INCLUDE_PRODUCTION_B', 'Plus n\'inclut pas les bonus de production. Vous devez acheter +25% pour chaque ressource séparément dans');
tz_def('TZ_PROGRAM_ERRORS_ALSO_CALLED_BUGS_MA', 'Les erreurs de programme (aussi appelées bugs) ne doivent pas être utilisées à son avantage. L\'abus peut entraîner une sanction du compte.');
tz_def('TZ_RESIDENCE_PALACE_AND_WORLD_WONDER', 'Les villages Résidence, Palais et Merveille du Monde sont exclus pour des raisons de gameplay.');
tz_def('TZ_RESOURCES_BUILDINGS_VILLAGES_OR_TR', 'Les ressources, bâtiments, villages ou troupes perdus pendant la durée de suspension ne comptent pas comme une sanction et ne seront pas remplacés par l\'équipe Travian. Aucun joueur n\'a le droit de réclamer un paiement ou un remplacement pour le temps de Plus/Or perdu en raison d\'une suspension.');
tz_def('TZ_SHOOT_WITH_A_NORMAL_ATTACK_THEY_DO', 'tirent lors d\'une attaque normale (ils ne tirent pas lors des raids !)');
tz_def('TZ_SOMETIMES_THE_EMAIL_IS_MOVED_TO_TH', 'Parfois, l\'e-mail est déplacé dans le dossier spam. Pour plus d\'aide, cliquez');
tz_def('TZ_THERE_ARE_FOUR_DIFFERENT_TYPES_OF', 'Il existe quatre types de ressources différents dans Travian : bois, argile, fer et céréales.');
tz_def('TZ_THERE_IS_NO_COMPENSATION_FOR_DAMAG', 'Il n\'y a aucune compensation pour les dommages causés par un remplaçant. Les propriétaires de compte sont entièrement responsables des actions effectuées par les remplaçants choisis pour leur compte. Si les remplaçants d\'un compte ne respectent pas ces règles et les Conditions Générales de Travian, le propriétaire du compte et le remplaçant peuvent être tenus responsables et sanctionnés.');
tz_def('TZ_THERE_IS_NO_COMPENSATION_FOR_DAMAG_2', 'Il n\'y a aucune compensation pour les dommages causés par une personne connaissant le mot de passe d\'un compte. La personne recevant le mot de passe est soumise aux règles de Travian ainsi qu\'aux Conditions Générales.');
tz_def('TZ_THERE_IS_NO_SPECIAL_TREATMENT_FOR', 'Il n\'y a aucun traitement particulier pour les utilisateurs de Travian Plus/Or concernant les règles du jeu, ni dans le délai de traitement du dossier, ni dans la sanction.');
tz_def('TZ_THE_E_MAIL_ADDRESS_USED_FOR_THE_RE', 'L\'adresse e-mail utilisée pour l\'inscription d\'un compte doit être sous le contrôle personnel et exclusif de la personne qui a enregistré le compte. La personne possédant l\'adresse e-mail actuellement enregistrée pour un compte est considérée comme le propriétaire du compte, indépendamment de tout autre accord personnel ou d\'alliance. Le propriétaire d\'un compte est entièrement responsable de toutes les actions effectuées par ce compte.');
tz_def('TZ_THE_FOLLOWING_SET_OF_RULES_ARE_IN', 'Le règlement suivant s\'applique conjointement aux Conditions Générales de Travian. Vous devriez vous familiariser avec les Conditions Générales pour vérifier ce qui est autorisé et ce qui est interdit, en particulier dans le cas d\'un compte banni pour violation des règles.');
tz_def('TZ_THE_GAME_MUST_BE_PLAYED_WITH_AN_UN', 'Le jeu doit se jouer avec un navigateur Internet non modifié. L\'utilisation de scripts ou de bots automatisant les actions du compte est contraire aux règles.');
tz_def('TZ_THE_OWNER_OF_AN_ACCOUNT_MAY_NOT_TR', 'Le propriétaire d\'un compte ne peut transmettre le mot de passe d\'un compte à aucune personne jouant sur le même monde de jeu (serveur). De plus, choisir sciemment le même mot de passe qu\'une autre personne sur le même monde de jeu est illégal ; chacune de ces actions est considérée comme du multicompte, tel que défini dans ces règles.');
tz_def('TZ_THE_PLAYERS_IN_YOUR_SURROUNDING_AR', 'Les joueurs autour de vous sont les plus importants pour vous. Grâce à la carte, vous avez une bonne vue d\'ensemble de qui ils sont.');
tz_def('TZ_THE_REGISTRATION_WAS_SUCCESSFUL_IN', 'L\'inscription a réussi. Dans les prochaines minutes, vous recevrez un e-mail avec les informations d\'accès.');
tz_def('TZ_THE_SUPPORT_IS_A_GROUP_OF_EXPERIEN', 'Le support est un groupe de joueurs expérimentés qui répondront volontiers à vos questions.');
tz_def('TZ_THE_TRAVIAN_TEAM_RESERVES_THE_RIGH', 'L\'équipe Travian se réserve le droit de modifier les règles à tout moment.');
tz_def('TZ_TO_BRING_IN_NEW_PLAYERS_INVITE_THE', 'Pour parrainer de nouveaux joueurs, invitez-les par e-mail ou partagez votre lien de parrainage.');
tz_def('TZ_VACATION_MODE_CANNOT_BE_ACTIVATED', 'Le mode vacances ne peut pas être activé – conditions non remplies');
tz_def('TZ_WE_WILL_SHOW_YOU_HOW_TO_EXPAND_YOU', 'Nous vous montrerons à la page suivante comment développer votre village pour qu\'il devienne une cité puissante et prospère.');
tz_def('TZ_YOU_CAN_DELETE_YOUR_ACCOUNT_HERE_A', 'Vous pouvez supprimer votre compte ici. Après le début de la résiliation, la suppression de votre compte prendra trois jours. Vous pouvez annuler ce processus durant les 24 premières heures.');
tz_def('TZ_YOU_DON_T_HAVE_ENOUGH_GOLD_YOU_NEE', 'Vous n\'avez pas assez d\'or. Il vous faut 10 or pour une démolition instantanée.');
tz_def('TZ_YOU_HAVE_BEEN_ENTERED_AS_SITTER_ON', 'Vous avez été désigné comme remplaçant sur les comptes suivants. Vous pouvez annuler cela en cliquant sur le X rouge.');


// ===== i18n composites (Simulateur) =====
tz_def('TZ_NUMBER', 'Nombre');
tz_def('TZ_LVL', 'Niv.');


// ===== i18n reliquat multi-lignes =====
tz_def('TZ_ML_LEADER_DEMOLITION_EMBASSY', 'Comme vous êtes le chef de votre alliance, la démolition de votre ambassade actuelle ne peut pas être lancée, car elle contient encore toutes vos');
tz_def('TZ_ML_CHANGELOG_120BUGS', 'Plus de 120 bugs corrigés, artefacts entièrement corrigés, catapultes et béliers entièrement corrigés, Natars/Artefacts/villages MdM/plans de construction MdM automatisés, nouvelle formule de combat (plus précise que l\'ancienne), activation automatique des artefacts, une grande partie du code réécrite. Plus d\'infos dans le fichier readme !');
tz_def('TZ_ML_CHANGELOG_NEWFORUM', 'Nouveau système de forum, formule du trappeur façon Travian, maître d\'œuvre corrigé, double file de recherche à la forge et à l\'armurerie avec Plus');
tz_def('TZ_ML_GOLD_RESERVE', 'En principe, nous réservons le montant d\'or commandé immédiatement après le paiement. En cas de problème, veuillez envoyer un e-mail à notre');
tz_def('TZ_ML_GPACK_NOTFOUND', 'Le pack graphique est introuvable. Cela peut être dû aux raisons suivantes :');
tz_def('TZ_ML_GPACK_ALLOWED_SAVE', 'affiche un pack graphique autorisé. Enregistrez votre choix pour l\'activer.');
tz_def('TZ_ML_GPACK_ALTER_APPEARANCE', 'Avec un pack graphique, vous pouvez modifier l\'apparence de Travian. Vous pouvez en choisir un dans la liste ou indiquer un chemin personnalisé.');
tz_def('TZ_ML_QUESTIONS_MULTIHUNTER', '. Si vous avez des questions ou souhaitez signaler une infraction, vous pouvez écrire à un Multichasseur.');
tz_def('TZ_ML_AWAY_NO_SITTER', 'Si vous prévoyez de vous absenter pendant une période prolongée et ne souhaitez pas désigner de remplaçant, vous pouvez activer');
tz_def('TZ_ML_ACCOUNT_FROZEN', '. Pendant cette période, votre compte est essentiellement gelé. Aucune ressource, troupe ou recherche ne progressera et vos villages ne peuvent pas être attaqués. N\'oubliez pas : cela ne gèle que votre Travian, pas le temps.');
tz_def('TZ_ML_ACTIVATION_RESENT', '. Le code d\'activation sera alors renvoyé');
tz_def('TZ_ML_TWO_SITTERS_RIGHT', 'Chaque joueur a le droit de désigner deux remplaçants qui peuvent jouer le compte pendant l\'absence du propriétaire. Les remplaçants doivent jouer le compte qu\'ils gardent dans le plein intérêt de ce compte. L\'abus de cette fonction est punissable.');
tz_def('TZ_ML_SAME_COMPUTER_SITTER', 'Les joueurs utilisant le même ordinateur et souhaitant accéder au compte de l\'autre doivent utiliser la fonction de remplacement.');
tz_def('TZ_ML_POLITE_TONE', 'Chacun doit communiquer sur un ton poli et courtois. Les Multichasseurs peuvent modifier sans avertissement les profils et noms de village inappropriés.');
tz_def('TZ_ML_MATERIAL_UNDERAGE', 'La publication ou la transmission de tout contenu inapproprié pour les mineurs.');


// ===== i18n reliquat final =====
tz_def('TZ_NO_BEGINNER_PROT2', 'Pas de protection débutant');
tz_def('TZ_SERVER_RUNNING_ON', '▶ Serveur actif sur');

// ===== task A: re-wired reverted templates =====
tz_def('TZ_HERO', 'Héros');
tz_def('TZ_SEND_UNITS_BACK_TO', 'Renvoyer les troupes vers');
tz_def('TZ_CONFIRM_DEMOLISH_COMPLETE_1', 'Voulez-vous vraiment démolir COMPLÈTEMENT ');
tz_def('TZ_CONFIRM_DEMOLISH_COMPLETE_2', ' pour 10 ORS ?\nLe bâtiment disparaîtra instantanément, c\'est irréversible.');
tz_def('TZ_CONFIRM_LAST_EMBASSY_L3', 'ATTENTION !\n\nVous êtes sur le point de démolir la dernière ambassade de niveau 3 !\n\nComme vous êtes le chef de votre alliance et qu\'il ne reste aucun autre membre, l\'alliance sera dissoute une fois la démolition terminée.');
tz_def('TZ_CONFIRM_LAST_EMBASSY_L1', 'ATTENTION !\n\nVous êtes sur le point de démolir votre dernière ambassade !\n\nComme vous êtes dans une alliance, vous la quitterez automatiquement une fois la démolition terminée.');
tz_def('TZ_TRADE', 'Commerce');

// ===== reports section (noticeClass tooltips) =====
tz_def('TZ_RPT_SCOUT', 'Rapport d\'éclaireur');
tz_def('TZ_RPT_WON_ATK_NOLOSS', 'Gagné en attaquant sans pertes');
tz_def('TZ_RPT_WON_ATK_LOSS', 'Gagné en attaquant avec pertes');
tz_def('TZ_RPT_LOST_ATK_LOSS', 'Perdu en attaquant avec pertes');
tz_def('TZ_RPT_WON_DEF_NOLOSS', 'Gagné en défendant sans pertes');
tz_def('TZ_RPT_WON_DEF_LOSS', 'Gagné en défendant avec pertes');
tz_def('TZ_RPT_LOST_DEF_LOSS', 'Perdu en défendant avec pertes');
tz_def('TZ_RPT_LOST_DEF_NOLOSS', 'Perdu en défendant sans pertes');
tz_def('TZ_RPT_REINF_ARRIVED', 'Renfort arrivé');
tz_def('TZ_RPT_WOOD_DELIVERED', 'Bois livré');
tz_def('TZ_RPT_CLAY_DELIVERED', 'Argile livrée');
tz_def('TZ_RPT_IRON_DELIVERED', 'Fer livré');
tz_def('TZ_RPT_CROP_DELIVERED', 'Céréales livrées');
tz_def('TZ_RPT_WON_SCOUT_ATK', 'Espionnage réussi en attaquant');
tz_def('TZ_RPT_LOST_SCOUT_ATK', 'Espionnage échoué en attaquant');
tz_def('TZ_RPT_WON_SCOUT_DEF', 'Espionnage réussi en défendant');
tz_def('TZ_RPT_LOST_SCOUT_DEF', 'Espionnage échoué en défendant');

// ===== report topic connectors (display-time localization) =====
tz_def('TZ_RT_ATTACKS', 'attaque');
tz_def('TZ_RT_REINFORCEMENT', 'renforce');
tz_def('TZ_RT_SCOUTS', 'espionne');
tz_def('TZ_RT_SEND_RES_TO', 'envoie des ressources à');
tz_def('TZ_RT_WAS_ATTACKED', 'a été attaqué');
tz_def('TZ_RT_REINF_IN', 'Renfort dans');
tz_def('TZ_RT_ELDERS_REINF', 'renfort du village des anciens');
tz_def('TZ_RT_UNOCC_OASIS', 'Oasis inoccupée');

// ===== settler reports (issue #178) =====
tz_def('TZ_RT_NEW_VILLAGE', 'Nouveau village fondé');
tz_def('TZ_RT_VALLEY_OCCUPIED', 'Colonisation échouée (vallée occupée)');
tz_def('TZ_NEW_VILLAGE_MSG', 'Vous avez fondé un nouveau village :');
tz_def('TZ_VALLEY_OCCUPIED_MSG', 'Vos colons n\'ont pas pu s\'installer ici — la vallée est déjà occupée par un autre joueur. Ils sont sur le chemin du retour.');

// ===== profil du joueur (#189) =====
tz_def('AGE', 'Âge');
tz_def('CAPITAL_TAG', 'Capitale');
tz_def('WRITE_MESSAGE_UNAVAILABLE', 'Écrire un message non disponible');
tz_def('PROFILE_FLAG_ADMIN', 'Ce joueur est Administrateur.');
tz_def('PROFILE_FLAG_MULTIHUNTER', 'Ce joueur est Multihunter.');
tz_def('PROFILE_FLAG_BANNED', 'Ce joueur est BANNI.');
tz_def('PROFILE_FLAG_VACATION', 'Ce joueur est en VACANCES.');

// ===== page d'accueil du manuel en jeu (#189) =====
tz_def('BUILDINGS', 'Bâtiments');
tz_def('INFRASTRUCTURE', 'Infrastructure');
tz_def('FORWARD', 'suivant');
tz_def('NEW_FEATURES', 'Nouveautés');
tz_def('NEW_WINDOW', 'nouvelle fenêtre');
tz_def('MANUAL_INTRO', 'Cette aide en jeu vous permet de consulter des informations importantes à tout moment.');
tz_def('MANUAL_NEW_FEATURES_DESC', 'Ce sont des nouveautés que vous ne trouverez pas dans la version originale du jeu Travian T3.6. Vous pouvez ici découvrir toutes ces nouveautés en détail.');
tz_def('MANUAL_FAQ', 'FAQ Travian');
tz_def('MANUAL_FAQ_DESC', 'Cette aide en jeu ne donne que de brèves informations. Plus d\'informations sont disponibles sur le');

// ===== manuel : pages des batiments (PR-A) =====
tz_def('CONSTRUCTION_TIME', 'temps de construction');
tz_def('MANUAL_FOR_LEVEL_1', 'pour le niveau 1 :');
tz_def('CROP_CONSUMPTION', 'Consommation de céréales');
tz_def('NONE', 'aucun');
tz_def('MANUAL_DESC_TRAPPER', 'Le piégeur protège votre village avec des pièges bien dissimulés. Ainsi, les ennemis imprudents peuvent être emprisonnés et ne pourront plus nuire à votre village.');
tz_def('MANUAL_ONE_TRAP_COSTS', 'Un piège coûte');
tz_def('MANUAL_TRAPPER_FREE', 'Les troupes ne peuvent pas être libérées par un raid. Lorsque les troupes sont libérées par une attaque normale réussie, 1/3 des pièges sont automatiquement réparés. Si le propriétaire des pièges relâche les captifs, tous les pièges peuvent être réparés.');
tz_def('MANUAL_TRAPPER_GAULS', 'Notez que ce bâtiment ne peut être construit que par les Gaulois.');
tz_def('MANUAL_DESC_WOODCUTTER', 'Le bûcheron abat des arbres afin de produire du bois. Plus vous améliorez le bûcheron, plus il produit de bois.<br /><br />En construisant une scierie, vous pouvez encore augmenter la production.');
tz_def('MANUAL_DESC_CLAYPIT', 'L\'argile est extraite des carrières d\'argile. Plus le niveau de la carrière est élevé, plus elle produit d\'argile.');
tz_def('MANUAL_DESC_IRONMINE', 'Ici, les mineurs extraient le précieux fer. En augmentant le niveau de la mine, vous augmentez sa production de fer. En construisant une fonderie de fer, vous pouvez encore augmenter la production.<br /><br />');
tz_def('MANUAL_DESC_CROPLAND', 'La nourriture de votre population est produite ici. En augmentant le niveau de la ferme, vous augmentez sa production de céréales.<br /><br />En construisant un moulin et une boulangerie, vous pouvez encore augmenter la production.');
tz_def('MANUAL_DESC_SAWMILL', 'Le bois coupé par vos bûcherons est traité ici. Selon son niveau, votre scierie peut augmenter votre production de bois jusqu\'à 25 %.');
tz_def('MANUAL_DESC_BRICKYARD', 'La briqueterie transforme l\'argile en briques. Selon son niveau, votre briqueterie peut augmenter votre production d\'argile jusqu\'à 25 %.');
tz_def('MANUAL_DESC_IRONFOUNDRY', 'La fonderie de fer fait fondre le fer. Selon son niveau, votre fonderie peut augmenter votre production de fer jusqu\'à 25 %.');
tz_def('MANUAL_DESC_GRAINMILL', 'Le moulin transforme le grain en farine. Selon son niveau, votre moulin peut augmenter votre production de céréales jusqu\'à 25 %.');
tz_def('MANUAL_DESC_BAKERY', 'La boulangerie transforme la farine en pain. Associée au moulin, l\'augmentation de la production de céréales peut atteindre 50 % au total.');
tz_def('MANUAL_DESC_WAREHOUSE', 'Les ressources bois, argile et fer sont stockées dans l\'entrepôt. En augmentant son niveau, vous augmentez la capacité de votre entrepôt.');
tz_def('MANUAL_DESC_GRANARY', 'Les céréales produites par vos fermes sont stockées dans le grenier. En augmentant son niveau, vous augmentez la capacité du grenier.');
tz_def('MANUAL_DESC_BLACKSMITH', 'Les armes de vos guerriers sont améliorées dans les fourneaux du forgeron. En augmentant son niveau, vous pouvez commander la fabrication d\'armes encore meilleures.');
tz_def('MANUAL_DESC_ARMOURY', 'L\'armure de vos guerriers est améliorée dans les fourneaux de l\'armurerie. En augmentant son niveau, vous pouvez commander la fabrication d\'armures encore meilleures.');
tz_def('MANUAL_DESC_MAINBUILDING', 'Les maîtres bâtisseurs du village vivent dans le bâtiment principal. Plus son niveau est élevé, plus vos maîtres bâtisseurs achèvent rapidement la construction de nouveaux bâtiments.');
tz_def('MANUAL_DESC_RALLYPOINT', 'Les troupes de votre village se rassemblent ici. D\'ici, vous pouvez les envoyer conquérir, piller ou renforcer d\'autres villages.<br /><br />Le point de ralliement ne peut être construit que sur la prairie verte située sous votre bâtiment principal, à droite.');
tz_def('MANUAL_DESC_MARKETPLACE', 'Au marché, vous pouvez échanger des ressources avec d\'autres joueurs. Plus son niveau est élevé, plus de ressources peuvent être transportées en même temps.');
tz_def('MANUAL_DESC_EMBASSY', 'L\'ambassade est un lieu pour les diplomates. Au niveau 1, vous pouvez rejoindre une alliance ; après l\'avoir améliorée au niveau 3, vous pouvez même en fonder une.<br /><br />Le nombre maximal de membres d\'une alliance est égal à 3 fois le niveau de l\'ambassade la plus élevée de cette alliance. Ainsi, avec une ambassade de niveau 20, jusqu\'à 60 joueurs peuvent faire partie de l\'alliance.');
tz_def('MANUAL_DESC_BARRACKS', 'L\'infanterie peut être entraînée dans la caserne. Plus son niveau est élevé, plus les troupes sont entraînées rapidement.');
tz_def('MANUAL_DESC_STABLE', 'La cavalerie peut être entraînée dans l\'écurie. Plus son niveau est élevé, plus les troupes sont entraînées rapidement.');
tz_def('MANUAL_DESC_WORKSHOP', 'Les engins de siège comme les catapultes et les béliers peuvent être construits dans l\'atelier. Plus son niveau est élevé, plus les unités sont produites rapidement.');
tz_def('MANUAL_DESC_ACADEMY', 'De nouveaux types d\'unités peuvent être développés à l\'académie. En augmentant son niveau, vous pouvez ordonner la recherche de meilleures unités.');
tz_def('MANUAL_DESC_CRANNY', 'La cachette sert à dissimuler au moins une partie de vos ressources lorsque le village est attaqué. Ces ressources ne peuvent pas être volées.<br /><br />Au niveau 1, la cachette contient 100 unités de chaque ressource. Les cachettes gauloises sont deux fois plus grandes que les autres.<br /><br />CONSEILS<br />En T3, la cachette est efficace à 66% contre les Germains.<br />En T3.5, la cachette est efficace à 80% contre les Germains.');
tz_def('MANUAL_DESC_TOWNHALL', 'Dans l\'hôtel de ville, vous pouvez organiser de fastueuses célébrations. Une telle célébration augmente vos points de culture.<br /><br />Les points de culture sont nécessaires pour fonder ou conquérir de nouveaux villages. Chaque bâtiment produit des points de culture et plus son niveau est élevé, plus il en produit. Avec les célébrations, vous pouvez augmenter cette production pendant un court moment.');
tz_def('MANUAL_DESC_RESIDENCE', 'La résidence est un petit palais où le roi ou la reine séjourne lorsqu\'il ou elle visite le village. La résidence protège le village contre les ennemis qui veulent le conquérir.');
tz_def('MANUAL_DESC_PALACE', 'Le roi ou la reine de l\'empire vit dans le palais. Il ne peut exister qu\'un seul palais dans votre royaume à la fois. Vous avez besoin d\'un palais pour proclamer un village comme votre capitale.<br /><br />La capitale ne peut pas être conquise. De plus, la capitale est le seul endroit où les champs de ressources peuvent être améliorés au-delà du niveau 10, et le seul endroit où la loge du tailleur de pierre peut être construite.');
tz_def('MANUAL_DESC_TREASURY', 'Les richesses de votre empire sont conservées dans le trésor. Un trésor ne peut contenir qu\'un seul artéfact.<br /><br />Il vous faut un trésor de niveau 10 pour un petit artéfact, ou de niveau 20 pour un grand.');
tz_def('MANUAL_DESC_TRADEOFFICE', 'Au comptoir commercial, les chariots des marchands sont améliorés et équipés de chevaux puissants. Plus son niveau est élevé, plus vos marchands peuvent transporter de marchandises.');
tz_def('MANUAL_DESC_GREATBARRACKS', 'La grande caserne vous permet de produire plus d\'unités en même temps, mais elles coûtent trois fois le montant initial.<br /><br />Elle ne peut pas être construite dans la capitale.');
tz_def('MANUAL_DESC_GREATSTABLE', 'La grande écurie vous permet de produire plus d\'unités en même temps, mais elles coûtent trois fois le montant initial.<br /><br />Elle ne peut pas être construite dans la capitale.');
tz_def('MANUAL_DESC_STONEMASON', 'La loge du tailleur de pierre est experte dans la taille de la pierre. Plus le bâtiment est amélioré, plus la stabilité des bâtiments du village est élevée.<br /><br />Elle ne peut être construite que dans la capitale.');
tz_def('MANUAL_DESC_BREWERY', 'Un savoureux hydromel est brassé dans la brasserie, puis bu par les soldats lors des célébrations.<br /><br />Ces boissons rendent vos soldats plus courageux et plus forts au combat (1% par niveau). Malheureusement, le pouvoir de persuasion des chefs est réduit et les catapultes ne font que des tirs aléatoires.<br /><br />Elle ne peut être construite que par les Germains et uniquement dans leur capitale. Elle affecte tout l\'empire.');
tz_def('MANUAL_DESC_HEROSMANSION', 'Dans la demeure du héros, vous pouvez entraîner un héros. Pour cela, il vous faut un soldat ordinaire qui deviendra le héros ; vous avez donc besoin d\'une caserne ou d\'une écurie.<br /><br />Lorsque le bâtiment atteint les niveaux 10, 15 et 20, vous pouvez annexer 1, 2 et 3 oasis inoccupées avec votre héros. Selon l\'oasis, vous obtiendrez une augmentation de production pour une certaine ressource (voire deux ressources pour certaines oasis).');
tz_def('MANUAL_DESC_GREATWAREHOUSE', 'Les ressources bois, argile et fer sont stockées dans votre entrepôt. Le grand entrepôt vous offre plus de place et garde vos ressources plus au sec et plus en sécurité que l\'entrepôt normal.<br /><br />Ce bâtiment ne peut être construit que dans les anciens villages natars ou avec des artéfacts natars spéciaux.');
tz_def('MANUAL_DESC_GREATGRANARY', 'Les céréales produites par vos fermes sont stockées dans le grenier. Le grand grenier vous offre plus de place et garde vos céréales plus au sec et plus en sécurité que le grenier normal.<br /><br />Ce bâtiment ne peut être construit que dans les anciens villages natars ou avec des artéfacts natars spéciaux.');
tz_def('MANUAL_DESC_WONDER', 'La merveille du monde représente la fierté de la création. Seuls les plus puissants et les plus riches sont capables de bâtir un tel chef-d\'œuvre et de le défendre contre des ennemis envieux.<br /><br />Les merveilles du monde ne peuvent être érigées que dans les anciens villages natars. Un plan de construction est également nécessaire. À partir du niveau 50, un plan supplémentaire est requis. Celui-ci doit appartenir à un autre joueur de la même alliance.');
tz_def('MANUAL_DESC_HORSEDRINKING', 'L\'abreuvoir veille au bien-être de vos chevaux et augmente donc aussi la vitesse de leur entraînement.<br /><br />L\'abreuvoir réduit de un la consommation de céréales des soldats suivants : Equites Legati à partir du niveau 10, Equites Imperatoris à partir du niveau 15 et Equites Caesaris à partir du niveau 20.<br /><br />L\'abreuvoir ne peut être construit que par les Romains.');
tz_def('MANUAL_DESC_GREATWORKSHOP', 'Dans le grand atelier, des engins de siège comme les catapultes et les béliers peuvent être construits, mais à un coût triple de celui d\'une unité standard. Plus son niveau est élevé, plus les unités sont produites rapidement.<br /><br />Il ne peut pas être construit dans la capitale.');

tz_def('MANUAL_ATTACK_VALUE', 'valeur d\'attaque');
tz_def('MANUAL_DEF_INFANTRY', 'défense contre l\'infanterie');
tz_def('MANUAL_DEF_CAVALRY', 'défense contre la cavalerie');
tz_def('MANUAL_VELOCITY', 'Vitesse');
tz_def('MANUAL_FIELDS_HOUR', 'cases/heure');
tz_def('MANUAL_CAN_CARRY', 'Capacité de transport');
tz_def('MANUAL_TRAINING_DURATION', 'Durée d\'entraînement');
tz_def('MANUAL_NPC_NATARS', 'Cette description est fournie à titre indicatif uniquement. Les Natars sont une tribu purement PNJ et ne peuvent donc pas être incarnés.');
tz_def('MANUAL_NPC_NATURE', 'Cette description est fournie à titre indicatif uniquement. La Nature est une tribu purement PNJ et ne peut donc pas être incarnée.');
tz_def('MANUAL_UDESC_ANIMAL_EXP', 'L\'expérience qu\'un héros gagne en tuant un animal dépend de l\'entretien que cet animal nécessitait. Ainsi, %s ne rapporte que %d point(s) d\'expérience.');
tz_def('MANUAL_UDESC_1', 'Le Légionnaire est l\'infanterie simple et polyvalente de l\'Empire romain. Grâce à son entraînement complet, il est efficace aussi bien en défense qu\'en attaque. Cependant, le Légionnaire n\'atteindra jamais le niveau des troupes plus spécialisées.');
tz_def('MANUAL_UDESC_2', 'Les Prétoriens sont la garde de l\'empereur et le défendent au péril de leur vie. Comme leur entraînement est spécialisé dans la défense, ce sont de très faibles attaquants.');
tz_def('MANUAL_UDESC_3', 'L\'Imperian est l\'attaquant ultime de l\'Empire romain. Il est rapide, puissant et le cauchemar de tous les défenseurs. Cependant, son entraînement est coûteux et long.');
tz_def('MANUAL_UDESC_4', 'Les Equites Legati sont les troupes de reconnaissance romaines. Ils sont assez rapides et peuvent espionner les villages ennemis afin de voir les ressources et les troupes.<br /><br />S\'il n\'y a aucun Éclaireur, Equites Legati ou Pisteur dans le village espionné, l\'espionnage passe inaperçu.');
tz_def('MANUAL_UDESC_5', 'Les Equites Imperatoris sont la cavalerie standard de l\'armée romaine et sont très bien armés. Ce ne sont pas les troupes les plus rapides, mais ils sont un cauchemar pour les ennemis mal préparés. Gardez toutefois toujours à l\'esprit que nourrir le cheval et le cavalier coûte cher.');
tz_def('MANUAL_UDESC_6', 'Les Equites Caesaris sont la cavalerie lourde de Rome. Ils sont très bien blindés et infligent d\'énormes dégâts, mais toute cette armure et cet armement ont un prix. Ils sont lents, transportent moins de ressources et leur entretien est coûteux.');
tz_def('MANUAL_UDESC_7', 'Le Bélier est une lourde arme de soutien pour votre infanterie et votre cavalerie. Sa tâche est de détruire les murs ennemis et d\'augmenter ainsi les chances de vos troupes de franchir les fortifications adverses.');
tz_def('MANUAL_UDESC_8', 'La Catapulte est une excellente arme à longue portée ; elle sert à détruire les champs et les bâtiments des villages ennemis. Cependant, sans troupes d\'escorte, elle est presque sans défense, alors n\'oubliez pas d\'envoyer quelques troupes avec elle.<br /><br />Un point de ralliement de haut niveau rend vos catapultes plus précises et vous permet de cibler des bâtiments ennemis supplémentaires. Avec un point de ralliement de niveau 10, tous les bâtiments peuvent être visés, à l\'exception de la cachette, du tailleur de pierre et du trappeur.<br />ASTUCE : les catapultes tirant au hasard PEUVENT toucher la cachette, les trappeurs ou le tailleur de pierre.');
tz_def('MANUAL_UDESC_9', 'Le Sénateur est le chef choisi par la tribu. C\'est un bon orateur qui sait convaincre les autres. Il est capable de persuader d\'autres villages de combattre aux côtés de l\'empire.<br /><br />Chaque fois que le Sénateur s\'adresse aux habitants d\'un village, la valeur de loyauté de l\'ennemi diminue, jusqu\'à ce que le village soit à vous.');
tz_def('MANUAL_UDESC_10', 'Les Colons sont des citoyens courageux et audacieux qui, après un long entraînement, quittent le village pour en fonder un nouveau en votre honneur.<br /><br />Comme le voyage et la fondation du nouveau village sont très difficiles, trois colons doivent rester ensemble. Il leur faut une base de 750 unités par ressource.');
tz_def('MANUAL_UDESC_11', 'Les Combattants au gourdin sont l\'unité la moins chère de Travian. Ils sont entraînés rapidement et possèdent des capacités d\'attaque moyennes, mais leur armure n\'est pas la meilleure. Les Combattants au gourdin sont presque sans défense face à la cavalerie et se font piétiner avec facilité.');
tz_def('MANUAL_UDESC_12', 'Dans l\'armée germaine, la tâche du Combattant à la lance est la défense. Il est particulièrement efficace contre la cavalerie grâce à la longueur de son arme.<br /><br />Cependant, ne l\'utilisez pas comme unité d\'attaque, car ses capacités offensives sont très faibles.');
tz_def('MANUAL_UDESC_13', 'C\'est l\'unité d\'infanterie la plus puissante des Germains. Il est fort à la fois en attaque et en défense, mais il est plus lent et plus coûteux que les autres unités.');
tz_def('MANUAL_UDESC_14', 'L\'Éclaireur se déplace loin devant les troupes germaines afin de se faire une idée de la force de l\'ennemi et de ses villages. Il se déplace à pied, ce qui le rend plus lent que ses homologues romain ou gaulois. Il espionne les unités, les ressources et les fortifications ennemies.<br /><br />S\'il n\'y a aucun Éclaireur, Pisteur ou Equites Legati ennemi dans le village espionné, l\'espionnage passe inaperçu.');
tz_def('MANUAL_UDESC_15', 'Équipés d\'une lourde armure, les Paladins sont une excellente unité défensive. L\'infanterie aura particulièrement du mal à percer leur bouclier.<br /><br />Malheureusement, leurs capacités offensives sont assez faibles et leur vitesse, comparée à celle des autres unités de cavalerie, est en dessous de la moyenne. Leur entraînement est très long et plutôt coûteux.');
tz_def('MANUAL_UDESC_16', 'Le Cavalier teuton est un guerrier redoutable qui sème la peur et le désespoir parmi ses ennemis. En défense, il excelle contre la cavalerie adverse. Cependant, le coût de son entraînement et de son entretien est extraordinaire.');
tz_def('MANUAL_UDESC_17', 'Le Bélier est une lourde arme de soutien pour votre infanterie et votre cavalerie. Sa tâche est de détruire les murs ennemis et d\'augmenter ainsi les chances de vos troupes de franchir les fortifications adverses.');
tz_def('MANUAL_UDESC_18', 'La Catapulte est une excellente arme à longue portée ; elle sert à détruire les champs et les bâtiments des villages ennemis. Cependant, sans troupes d\'escorte, elle est presque sans défense, alors n\'oubliez pas d\'envoyer quelques troupes avec elle.<br /><br />Un point de ralliement de haut niveau rend vos catapultes plus précises et vous permet de cibler des bâtiments ennemis supplémentaires. Avec un point de ralliement de niveau 10, tous les bâtiments peuvent être visés, à l\'exception de la cachette, des tailleurs de pierre et du trappeur.<br />ASTUCE : les catapultes tirant au hasard PEUVENT toucher la cachette, les trappeurs ou les tailleurs de pierre.');
tz_def('MANUAL_UDESC_19', 'C\'est en leur sein que les Germains choisissent leur Chef. Pour être choisi, le courage et la stratégie ne suffisent pas ; il faut aussi être un orateur redoutable, car l\'objectif premier du Chef est de convaincre la population des villages étrangers de rejoindre sa tribu.<br /><br />Plus le Chef s\'adresse souvent à la population d\'un village, plus la loyauté de ce village diminue, jusqu\'à ce qu\'il rejoigne finalement la tribu du Chef.');
tz_def('MANUAL_UDESC_21', 'Étant de l\'infanterie, la Phalange est peu coûteuse et rapide à produire.<br /><br />Bien que sa puissance d\'attaque soit faible, en défense elle est assez solide aussi bien contre l\'infanterie que contre la cavalerie.');
tz_def('MANUAL_UDESC_22', 'Les Épéistes sont plus coûteux que la Phalange, mais ce sont des unités d\'attaque.<br /><br />En défense, ils sont assez faibles, en particulier contre la cavalerie.');
tz_def('MANUAL_UDESC_23', 'Le Pisteur est l\'unité de reconnaissance des Gaulois. Ils sont très rapides et peuvent s\'approcher prudemment des unités, ressources ou bâtiments ennemis pour les espionner.<br /><br />S\'il n\'y a aucun Éclaireur, Equites Legati ou Pisteur dans le village espionné, l\'espionnage passe inaperçu.');
tz_def('MANUAL_UDESC_24', 'Les Foudres de Teutatès sont des unités de cavalerie très rapides et puissantes. Elles peuvent transporter une grande quantité de ressources, ce qui en fait aussi d\'excellents pillards.<br /><br />En défense, leurs capacités sont au mieux moyennes.');
tz_def('MANUAL_UDESC_25', 'Cette unité de cavalerie moyenne excelle en défense. Le rôle principal du Druide cavalier est de défendre contre l\'infanterie ennemie. Son coût et son entretien sont relativement élevés.');
tz_def('MANUAL_UDESC_26', 'Les Héduens sont l\'arme ultime des Gaulois pour attaquer et se défendre contre la cavalerie. Peu d\'unités les égalent sur ces points.<br /><br />Cependant, leur entraînement et leur équipement sont eux aussi très coûteux. Ils consomment 3 unités de céréales par heure, vous devez donc bien réfléchir s\'ils en valent la peine.');
tz_def('MANUAL_UDESC_28', 'Le Trébuchet est une excellente arme à longue portée ; il sert à détruire les champs et les bâtiments des villages ennemis. Cependant, sans troupes d\'escorte, il est presque sans défense, alors n\'oubliez pas d\'envoyer quelques troupes avec lui.<br /><br />Un point de ralliement de haut niveau rend vos catapultes plus précises et vous permet de cibler des bâtiments ennemis supplémentaires. Avec un point de ralliement de niveau 10, tous les bâtiments peuvent être visés, à l\'exception de la cachette, des tailleurs de pierre et du trappeur.<br />ASTUCE : le Trébuchet tirant au hasard PEUT toucher la cachette, les trappeurs ou les tailleurs de pierre.');
tz_def('MANUAL_UDESC_29', 'Chaque tribu possède un combattant ancien et expérimenté dont la présence et les discours sont capables de convaincre la population des villages ennemis de rejoindre sa tribu.<br /><br />Plus le Chef de clan parle devant les murs d\'un village ennemi, plus sa loyauté diminue, jusqu\'à ce qu\'il rejoigne la tribu du Chef de clan.');
tz_def('MANUAL_UDESC_31', 'Les rats sont peu coûteux et se reproduisent très vite, mais ne peuvent pas transporter grand-chose.<br /><br />C\'est probablement la plus économique des unités de la nature, et la plus laide.');
tz_def('MANUAL_UDESC_44', 'Les Natars utilisent des nuées d\'oiseaux pour recueillir des renseignements sur leurs ennemis. Grâce à l\'avantage de l\'observation aérienne, il est presque impossible d\'arrêter les escadrons d\'éclaireurs natariens ; en revanche, même un villageois simple d\'esprit peut facilement remarquer ces nuées criardes et emplumées.');
tz_def('MANUAL_UDESC_41', 'Leurs longues piques pointues constituent la principale ligne de défense de toute bataille. Les Piquiers natariens sont des guerriers hardis et audacieux qui usent de leur dextérité pour abattre rapidement les cavaliers ennemis et les achever.');
tz_def('MANUAL_UDESC_42', 'Les excroissances en forme d\'épines sur leurs casques, leurs brassards et les épaulières de leur armure donnent leur nom aux Guerriers épineux. Les hommes qui combattent pour les Natars en tant que Guerriers épineux sont tenaces et bien entraînés, offrant une bataille sanglante à quiconque est assez insensé pour les attaquer.');
tz_def('MANUAL_UDESC_43', 'Adorés par leur peuple et craints par leurs ennemis, les Gardes combattent sans monture mais figurent néanmoins parmi les soldats les plus précieux de l\'armée natarienne, grâce à leur polyvalence. Considérés comme des combattants bien entraînés, ils ne laissent à leurs ennemis presque aucune chance de l\'emporter. Grâce à leur lourde armure, ils peuvent aussi servir de troupes de défense solides et fiables.');
tz_def('MANUAL_UDESC_45', 'Il ne flotte qu\'une odeur de mort et de putréfaction lorsque les Cavaliers à la hache sellent leurs montures et se préparent à partir en guerre. Avec autant d\'adresse qu\'un paysan maniant sa faux pour moissonner, le Cavalier à la hache fait tournoyer sa puissante lame. Un seul coup suffit généralement à décapiter un adversaire et à faire hurler d\'effroi les témoins.');
tz_def('MANUAL_UDESC_46', 'Seuls les guerriers les plus habiles et les plus forts des Natars survivent à l\'entraînement permettant de devenir Chevalier natarien. Les voir combattre inspire une crainte respectueuse et montre ce qu\'est la véritable guerre. Ils manient leurs lames comme si elles ne faisaient qu\'un avec leurs bras et leurs mains, et utilisent leurs boucliers comme un prolongement naturel de leur corps. Même les chevaux qu\'ils montent sont élevés et dressés spécialement — aucun cheval ordinaire ne pourrait porter l\'armure que portent les montures des chevaliers, et encore moins le chevalier lui-même, tout en étant capable d\'aller au combat. Les murmures de leur gloire ont atteint jusqu\'aux royaumes les plus lointains, répandant peur et effroi.');
tz_def('MANUAL_UDESC_47', 'Aucune autre tribu que les Natars ne sait utiliser ces créatures impressionnantes à ses fins. Ni un mur ni une palissade ne peuvent résister aux assauts de l\'Éléphant de guerre. Une machine à tuer ambulante, qui piétine tout ce qui tente de s\'opposer à elle ou de se mettre en travers de son chemin.');
tz_def('MANUAL_UDESC_48', 'Même en tant qu\'ingénieurs, les Natars ont connu un grand succès. Ils ont créé des machines de guerre bien avant tous les autres et les ont depuis perfectionnées en tout point. La Baliste, une énorme arme semblable à une arbalète, projette ses traits avec une telle force qu\'aucun mur ni bouclier ne peut les dévier. Lorsque les ingénieurs la démontent pour la déplacer vers le champ de bataille suivant, il ne reste généralement que des ruines là où les projectiles ont frappé.');
tz_def('MANUAL_UDESC_49', 'Un mélange de pure peur, d\'admiration et de crainte révérencielle anime les villageois lorsque l\'Empereur natarien s\'adresse à eux. Cette figure imposante et richement parée est pleinement consciente de l\'effet qu\'elle produit sur les autres et sait comment soumettre un village entier d\'une seule harangue.');
tz_def('MANUAL_UDESC_50', 'Compagnons audacieux et maîtres bâtisseurs, animés par l\'envie d\'agir et connaissant le moindre secret de la culture de la terre, de la construction de Palais et de la fortification des villages, les Colons natariens partent par groupes de trois pour revendiquer des terres au nom de leurs seigneurs natariens.');

// ===== manual: new-features pages (PR-C) =====
tz_def('MANUAL_NF_ENABLED', 'Activé');
tz_def('MANUAL_NF_DISABLED', 'Désactivé');
tz_def('MANUAL_NF_T_11', 'Afficher l\'oasis dans le profil');
tz_def('MANUAL_NF_T_12', 'Message d\'invitation d\'alliance');
tz_def('MANUAL_NF_T_13', 'Nouvelles mécaniques d\'alliance et d\'ambassade');
tz_def('MANUAL_NF_T_14', 'Message de nouveau message sur le forum');
tz_def('MANUAL_NF_T_15', 'Images des tribus dans le profil');
tz_def('MANUAL_NF_T_16', 'Images des MH dans le profil');
tz_def('MANUAL_NF_T_17', 'Afficher l\'artefact dans le profil');
tz_def('MANUAL_NF_T_18', 'Afficher la Merveille du monde dans le profil');
tz_def('MANUAL_NF_T_20', 'Cibles des catapultes');
tz_def('MANUAL_NF_T_21', 'Manuel sur la Nature et les Natars');
tz_def('MANUAL_NF_T_22', 'Emplacement des liens directs');
tz_def('MANUAL_NF_T_23', 'Médaille Joueur Vétéran');
tz_def('MANUAL_NF_T_24', 'Médaille Joueur Vétéran 5 ans');
tz_def('MANUAL_NF_T_25', 'Médaille Joueur Vétéran 10 ans');
tz_def('MANUAL_NF_T_26', 'Médailles spéciales');
tz_def('MANUAL_NF_D_11', 'Si une oasis conquise se trouve dans le village, elle sera affichée dans le profil du joueur en face du village correspondant, avec le type de ressource approprié et un bonus de production. Cette fonction a été présentée dans Travian T4.');
tz_def('MANUAL_NF_D_12', 'Si une invitation à rejoindre l\'alliance est envoyée à un joueur, celui-ci en sera informé par un message dans le jeu.');
tz_def('MANUAL_NF_D_13', '<h2>Introduction</h2><br> Les mécaniques de l\'Ambassade et de l\'Alliance m\'ont toujours semblé un peu comme de la triche. En particulier parce que le bâtiment de l\'Ambassade possède une « capacité » donnée, ce qui signifie que seulement 3/6/9/12/... et jusqu\'à 60 membres pouvaient faire partie de l\'alliance, selon le niveau de votre Ambassade. <br><br> Tout cela est bien beau, mais une fois que vous aviez une Ambassade de niveau 20 et que vous atteigniez 60 membres d\'alliance, vous étiez libre de démolir entièrement le bâtiment sans que rien ne se passe. Vous ne pouviez pas changer d\'alliance, mais c\'était à peu près tout. La propriété de capacité de l\'Ambassade ne s\'appliquait plus. Si elle s\'appliquait, vous ne pourriez même pas la démolir d\'un seul niveau jusqu\'à 19 — car avec 60 membres au complet, l\'Ambassade ne pourrait plus les contenir au niveau 19. <br><br> J\'ai donc décidé de pimenter un peu le jeu, en faisant de l\'Ambassade une pièce d\'échecs un peu plus visible sur l\'échiquier. <br><br> <h2>Nouvelles mécaniques</h2><br> Afin de rendre les choses intéressantes, j\'ai développé tout un nouvel ensemble de règles pour la démolition et la destruction au combat de l\'Ambassade. C\'est un peu compliqué mais cela reflète en réalité parfaitement la propriété de « capacité » de l\'alliance. <br><br> Le principal changement est que les joueurs ne peuvent pas vraiment démolir leur Ambassade sans subir l\'effet secondaire d\'être puni une fois qu\'elle descend trop bas. Pour un membre d\'alliance, cela signifie que son Ambassade ne doit jamais descendre en dessous du niveau 1. Si c\'est le cas, il est averti puis exclu de son alliance. <br><br> De même, pour les fondateurs d\'alliance, cela représente un défi encore plus grand, car ce sont eux qui doivent veiller au bon fonctionnement de leur alliance. Pour eux, la démolition d\'une Ambassade ne sera pas autorisée en dessous d\'un niveau pouvant encore contenir le nombre actuel de membres de l\'alliance. <br><br> Dans la situation particulière où d\'autres joueurs/alliances attaquent réellement le village du fondateur où se trouve son Ambassade, et ciblent ensuite cette Ambassade avec leurs catapultes et leurs béliers — cette situation peut causer beaucoup d\'ennuis. S\'il n\'y a pas d\'autres Ambassades dans les villages d\'autres fondateurs à un niveau suffisant pour contenir tous les membres de l\'alliance, l\'alliance pourrait être dispersée. La seule exception serait qu\'un autre membre de l\'alliance possède une Ambassade suffisamment développée — auquel cas ce membre sera automatiquement élu à un poste de direction et sauvera l\'alliance. Si aucun joueur de ce type n\'est trouvé, l\'alliance sera entièrement dispersée. <br><br> <h2>Informations détaillées</h2><br> Pour des informations plus visuelles et plus approfondies sur le fonctionnement de ce nouveau système, vous pouvez consulter cette <a href=\"https://docs.google.com/presentation/d/1KN1qVAlxVj7aAN6F9QkRai1oliajfxKPIaJ4MSodUac/edit#slide=id.p\" target=\"_blank\">présentation Google</a>.');
tz_def('MANUAL_NF_D_14', 'Si le joueur laisse au moins un message dans un fil de discussion du forum, il recevra des messages dans le jeu lui indiquant qu\'une autre personne a laissé un nouveau message dans le même fil (c\'est-à-dire qu\'il y est techniquement « abonné »).');
tz_def('MANUAL_NF_D_15', 'Grâce à cette innovation, tout joueur peut ajouter à la description de son profil une image de sa tribu avec une petite description (Romains, Germains, Gaulois).');
tz_def('MANUAL_NF_D_16', 'En fait, pour les joueurs, cette fonction est inutile, car elle est destinée uniquement aux Administrateurs et aux Multihunters. Grâce à elle, les Administrateurs et les Multihunters pourront ajouter à la description de leur profil diverses images intéressantes accompagnées de descriptions.');
tz_def('MANUAL_NF_D_17', 'Si un artefact se trouve dans l\'un des villages, il sera affiché dans le profil du joueur en face du village correspondant dans lequel il se trouve. Cette fonction a été présentée dans Travian T4.');
tz_def('MANUAL_NF_D_18', 'Si le village dispose d\'un emplacement pour la construction de la Merveille du monde, celui-ci sera affiché dans le profil en face du village correspondant. Cette fonction a été présentée dans Travian T4.');
tz_def('MANUAL_NF_D_19', 'Le mode vacances vous permet de protéger votre empire de toute action hostile des autres joueurs pendant votre longue absence. Certes, certaines conditions s\'appliquent et entraîneront un retard dans le développement de votre empire. Cette fonction a été présentée dans Travian T4.');
tz_def('MANUAL_NF_D_20', 'Si vous envoyez les catapultes lors d\'une attaque normale, vous pouvez voir au point de ralliement quelles cibles vous avez définies pour l\'attaque. Cette fonction a été présentée dans Travian T4.');
tz_def('MANUAL_NF_D_21', 'À l\'aide de ces informations du manuel, vous pouvez trouver une description des forces de la Nature et des Natars.');
tz_def('MANUAL_NF_D_22', 'L\'emplacement des liens directs change. Dans le Travian T3.6 d\'origine, les liens directs sont placés dans le menu de droite, sous la liste des villages, ce qui n\'est pas entièrement pratique. Si cette option est activée, les liens directs seront placés dans le menu de gauche, ce qui est bien plus pratique.');
tz_def('MANUAL_NF_D_23', 'Médaille décernée aux joueurs utilisant la même adresse e-mail depuis 3 ans ou plus. Peut être ajoutée à la description du profil. Cette fonction a été présentée dans Travian T4.');
tz_def('MANUAL_NF_D_24', 'Médaille décernée aux joueurs utilisant la même adresse e-mail depuis 5 ans ou plus. Peut être ajoutée à la description du profil. Cette fonction a été présentée dans Travian T4.');
tz_def('MANUAL_NF_D_25', 'Médaille décernée aux joueurs utilisant la même adresse e-mail depuis 10 ans ou plus. Peut être ajoutée à la description du profil. Cette fonction a été présentée dans Travian T4.');
tz_def('MANUAL_NF_D_26', 'Médaille décernée aux joueurs utilisant la même adresse e-mail depuis 10 ans ou plus. Peut être ajoutée à la description du profil. Cette fonction a été présentée dans Travian T4.');

/* =============================================================================
 * T4 HERO PORT (Phase 6) - items / adventures / auction house
 * ========================================================================== */
tz_def('HERO_T4_TAB_HERO',       'Héros');
tz_def('HERO_T4_TAB_ITEMS',      'Inventaire');
tz_def('HERO_T4_TAB_ADVENTURES', 'Aventures');
tz_def('HERO_T4_TAB_AUCTION',    'Enchères');

tz_def('HERO_SILVER',            'Argent');
tz_def('HERO_EXPERIENCE',        'Expérience');

/* Equipment slots */
tz_def('HERO_SLOT_1', 'Casque');
tz_def('HERO_SLOT_2', 'Corps');
tz_def('HERO_SLOT_3', 'Main droite');
tz_def('HERO_SLOT_4', 'Main gauche');
tz_def('HERO_SLOT_5', 'Chaussures');
tz_def('HERO_SLOT_6', 'Cheval');
tz_def('HERO_SLOT_7', 'Sac');

/* Inventory actions */
tz_def('HERO_ITEMS_EQUIPPED',    'Équipé');
tz_def('HERO_ITEMS_BAG',         'Inventaire');
tz_def('HERO_ITEMS_EMPTY',       'Votre héros ne possède encore aucun objet. Les aventures et l\'hôtel des enchères sont de bons endroits pour en trouver.');
tz_def('HERO_EQUIP',             'Équiper');
tz_def('HERO_UNEQUIP',           'Retirer');
tz_def('HERO_USE_ITEM',          'Utiliser');
tz_def('HERO_QUANTITY',          'Quantité');
tz_def('HERO_ITEM_USED_OK',      'L\'objet a été utilisé.');
tz_def('HERO_ITEM_USE_FAIL',     'Cet objet ne peut pas être utilisé pour le moment.');
tz_def('HERO_ITEM_USE_BATTLE',   'Cet objet est utilisé automatiquement (les bandages soignent les troupes de retour de bataille).');
tz_def('HERO_EQUIP_OK',          'Objet équipé.');
tz_def('HERO_EQUIP_FAIL',        'Cet objet ne peut pas être équipé (unité de héros ou type d\'objet incompatible).');
tz_def('HERO_UNEQUIP_OK',        'Objet retiré.');

/* Adventures */
tz_def('HERO_ADV_NORMAL',        'une aventure normale');
tz_def('HERO_ADV_HARD',          'une aventure difficile');
tz_def('HERO_ADV_LIST',          'Aventures disponibles');
tz_def('HERO_ADV_NONE',          'Aucune aventure disponible pour le moment. De nouvelles apparaîtront au fil du temps.');
tz_def('HERO_ADV_DIFFICULTY',    'Difficulté');
tz_def('HERO_ADV_DIFF_NORMAL',   'Normal');
tz_def('HERO_ADV_DIFF_HARD',     'Difficile');
tz_def('HERO_ADV_DURATION',      'Durée du trajet (aller simple)');
tz_def('HERO_ADV_EXPIRES',       'Expire dans');
tz_def('HERO_ADV_GO',            'Lancer l\'aventure');
tz_def('HERO_ADV_RUNNING',       'Votre héros est en aventure et arrivera dans');
tz_def('HERO_ADV_START_OK',      'Votre héros est parti à l\'aventure.');
tz_def('HERO_ADV_START_NOHERO',  'Vous avez besoin d\'un héros en vie pour commencer une aventure.');
tz_def('HERO_ADV_START_AWAY',    'Votre héros n\'est pas chez lui.');
tz_def('HERO_ADV_START_FAIL',    'Cette aventure n\'est plus disponible.');
tz_def('HERO_ADV_RETURNED',      'Votre héros est de retour de');
tz_def('HERO_ADV_REWARD',        'Récompense');
tz_def('HERO_ADV_AMOUNT',        'Montant');
tz_def('HERO_ADV_ITEM_FOUND',    'Objet trouvé');
tz_def('HERO_ADV_HP_LOST',       'Points de vie perdus');
tz_def('HERO_ADV_DIED',          'Votre héros a péri lors de');
tz_def('HERO_ADV_DIED_INFO',     'Tout le butin a été perdu. Le héros peut être ressuscité au Manoir du héros.');

/* Auction house */
tz_def('HERO_AUC_OPEN',          'Enchères en cours');
tz_def('HERO_AUC_NONE',          'Aucune enchère en cours pour le moment.');
tz_def('HERO_AUC_ITEM',          'Objet');
tz_def('HERO_AUC_PRICE',         'Prix actuel');
tz_def('HERO_AUC_FINAL_PRICE',   'Prix final');
tz_def('HERO_AUC_TIME_LEFT',     'Fin dans');
tz_def('HERO_AUC_YOUR_MAX',      'Votre maximum');
tz_def('HERO_AUC_BID',           'Enchérir');
tz_def('HERO_AUC_BID_OK',        'Votre enchère a été placée. Vous êtes le meilleur enchérisseur.');
tz_def('HERO_AUC_BID_OUTBID',    'Votre enchère a été immédiatement surenchérie par un maximum plus élevé.');
tz_def('HERO_AUC_BID_FAIL',      'Votre enchère n\'a pas été acceptée.');
tz_def('HERO_AUC_BID_NOSILVER',  'Vous n\'avez pas assez d\'argent pour cette enchère.');
tz_def('HERO_AUC_MY_BIDS',       'Mes enchères');
tz_def('HERO_AUC_MY_SALES',      'Mes ventes');
tz_def('HERO_AUC_SELL',          'Vendre un objet');
tz_def('HERO_AUC_SELL_OK',       'Votre objet a été mis en vente.');
tz_def('HERO_AUC_SELL_FAIL',     'Cet objet ne peut pas être mis en vente (les objets équipés doivent d\'abord être retirés).');
tz_def('HERO_AUC_START_PRICE',   'Prix de départ');
tz_def('HERO_AUC_DURATION',      'Durée');
tz_def('HERO_AUC_LIST',          'Mettre en vente');
tz_def('HERO_AUC_SELLER_NPC',    'Marchand');
tz_def('HERO_AUC_WON',           'Vous avez remporté l\'enchère pour');
tz_def('HERO_AUC_SOLD',          'Votre objet a été vendu :');
tz_def('HERO_AUC_REFUND',        'Remboursement sur votre enchère maximale'); tz_def('HERO_AUC_FEE',           'Frais de vente aux enchères');
tz_def('HERO_AUC_PAYOUT',        'Versement');
tz_def('HERO_AUC_EXPIRED',       'Votre vente aux enchères s\'est terminée sans offre. L\'objet a été renvoyé dans votre inventaire :');

/* Report topics (raw English strings live in ndata.topic) */
tz_def('TZ_RT_ADV_RETURNED',     'Le héros est revenu d\'une aventure');
tz_def('TZ_RT_ADV_FELL',         'Le héros a péri lors d\'une aventure');
tz_def('TZ_RT_AUC_WON',          'Enchère remportée');
tz_def('TZ_RT_AUC_SOLD',         'Objet vendu aux enchères');
tz_def('TZ_RT_AUC_EXPIRED',      'Enchère expirée');

/* T4 hero port - movement display (dorf1 + rally point) */
tz_def('HERO_ADV_MOV_OUT',   'Héros en aventure');
tz_def('HERO_ADV_MOV_BACK',  'Héros de retour d\'aventure');
tz_def('HERO_ADV_MOV_SHORT', 'Aventure');

/* T4 hero port - tooltip effect fragments (heroItemBonusText) */
tz_def('HB_TXT_FIGHT',      'puissance de combat');
tz_def('HB_TXT_UNIT_OFF',   'attaque');
tz_def('HB_TXT_UNIT_DEF',   'défense');
tz_def('HB_TXT_PER',        'par');
tz_def('HB_TXT_VS_NATARS',  'puissance contre les Natars');
tz_def('HB_TXT_RAID',       'ressources pillées');
tz_def('HB_TXT_RETURN',     'vitesse de retour des troupes');
tz_def('HB_TXT_SPEED_OWN',  'vitesse entre ses propres villages');
tz_def('HB_TXT_SPEED_ALLY', 'vitesse entre les villages alliés');
tz_def('HB_TXT_XP',         'expérience');
tz_def('HB_TXT_REGEN',      'PV par jour');
tz_def('HB_TXT_CP',         'points de culture par jour');
tz_def('HB_TXT_TRAIN_CAV',  'temps de formation de la cavalerie');
tz_def('HB_TXT_TRAIN_INF',  'temps de formation de l\'infanterie');
tz_def('HB_TXT_DMG',        'dégâts subis par le héros');
tz_def('HB_TXT_SPEED20',    'vitesse des troupes au-delà de 20 cases');
tz_def('HB_TXT_MOUNT',      'cases/heure à cheval');
tz_def('HB_TXT_HORSE',      'cases/heure (vitesse du héros)');
tz_def('HB_TXT_OINTMENT',   'Soigne 1 % de la santé du héros par unité (max. 99 %)');
tz_def('HB_TXT_SCROLL',     'expérience du héros par parchemin');
tz_def('HB_TXT_BUCKET',     'Ressuscite instantanément le héros sans frais');
tz_def('HB_TXT_TABLET',     '+1 % de loyauté du village par tablette (max. 125 %)');
tz_def('HB_TXT_BOOK',       'Réinitialise les points d\'attribut du héros');
tz_def('HB_TXT_ARTWORK',    'Points de culture équivalant à votre production quotidienne');
tz_def('HB_TXT_BANDAGE_A',  'Soigne');
tz_def('HB_TXT_BANDAGE_B',  'les troupes du héros tombées au combat');
tz_def('HB_TXT_CAGE',       'Capture 1 animal d\'oasis par cage');
tz_def('HB_TXT_NEEDS_HORSE','nécessite un cheval équipé');
tz_def('HB_TXT_ONLY',       'uniquement pour un');
tz_def('HB_TXT_HERO',       'Héros');

/* T4 hero port - captured animals release action */
tz_def('HERO_RELEASE_ANIMALS', 'Relâcher');
tz_def('HERO_RELEASE_CONFIRM', 'Relâcher ces animaux ? Ils partiront pour de bon.');
?>

//////////////////////////////////////////////////////////////////////////////////////////////////////
// COMPLETARE 1:1 dupa en.php (revizuieste traducerile)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('CATEGORY', 'Catégorie');
tz_def('SERVER_TIME', 'Heure du serveur :');
tz_def('STATUS_UPDATED', 'Votre statut a été mis à jour');
tz_def('TZ_SERVER_MILESTONES', 'Étapes du serveur');
