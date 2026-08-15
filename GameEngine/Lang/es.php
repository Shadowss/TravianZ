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
									//         ESPAÑOL        //
									//   Author: Dzoki / ES    //
									//     Adding: Armando     //
									/////////////////////////////

//MAIN MENU
tz_def('TRIBE1', 'Romanos');
tz_def('TRIBE2', 'Germanos');
tz_def('TRIBE3', 'Galos');
tz_def('TRIBE4', 'Naturaleza');
tz_def('TRIBE5', 'Natares');
tz_def('TRIBE6', 'Hunos');
tz_def('TRIBE7', 'Egipcios');
tz_def('TRIBE8', 'Espartanos');
tz_def('TRIBE9', 'Vikingos');

tz_def('HOME', 'Página principal');
tz_def('INSTRUCT', 'Instrucciones');
tz_def('ADMIN_PANEL', 'Panel de administración');
tz_def('MH_PANEL', 'Panel Multihunter');
tz_def('MASS_MESSAGE', 'Mensaje masivo');
tz_def('LOGOUT', 'Cerrar sesión');
tz_def('PROFILE', 'Perfil');
tz_def('SUPPORT', 'Soporte');
tz_def('UPDATE_T_10', 'Actualizar Top 10');
tz_def('SYSTEM_MESSAGE', 'Mensaje del sistema');
tz_def('TRAVIAN_PLUS', 'Travian <b><span class="plus_g">P</span><span class="plus_o">l</span><span class="plus_g">u</span><span class="plus_o">s</span></span></span></b>');
tz_def('CONTACT', '¡Contáctanos!');
tz_def('GAME_RULES', 'Reglas del juego');

//MENU
tz_def('REG', 'Registrarse');
tz_def('FORUM', 'Foro');
tz_def('CHAT', 'Chat');
tz_def('IMPRINT', 'Aviso legal');
tz_def('MORE_LINKS', 'Más enlaces');
tz_def('TOUR', 'Tour del juego');


//ERRORS
tz_def('USRNM_EMPTY', '(Nombre de usuario vacío)');
tz_def('USRNM_TAKEN', '(El nombre ya está en uso.)');
tz_def('USRNM_SHORT', '(min. '.USRNM_MIN_LENGTH.' figures)');
tz_def('USRNM_CHAR', '(Caracteres no válidos)');
tz_def('PW_EMPTY', '(Contraseña vacía)');
tz_def('PW_SHORT', '(min. '.PW_MIN_LENGTH.' figures)');
tz_def('PW_INSECURE', '(Contraseña insegura. Por favor, elige una más segura.)');
tz_def('EMAIL_EMPTY', '(Email vacío)');
tz_def('EMAIL_INVALID', '(Dirección de email no válida)');
tz_def('EMAIL_TAKEN', '(El email ya está en uso)');
tz_def('WINNER_ERROR', '<li>¡El servidor ha terminado! No se pueden realizar más registros.</li>');
tz_def('TRIBE_EMPTY', '<li>Por favor, elige una tribu.</li>');
tz_def('AGREE_ERROR', '<li>Debes aceptar las reglas del juego y las condiciones generales para registrarte.</li>');
tz_def('LOGIN_USR_EMPTY', 'Introduce el nombre.');
tz_def('LOGIN_PASS_EMPTY', 'Introduce la contraseña.');
tz_def('LOGIN_VACATION', 'El modo vacaciones sigue activado.');
tz_def('EMAIL_ERROR', 'El email no coincide con el existente');
tz_def('PASS_MISMATCH', 'Las contraseñas no coinciden');
tz_def('ALLI_OWNER', 'Por favor, designa un líder de alianza antes de eliminarla');
tz_def('SIT_ERROR', 'El sustituto ya está configurado o el jugador no se encontró');
tz_def('USR_NT_FOUND', 'El nombre no existe.');
tz_def('LOGIN_PW_ERROR', 'La contraseña es incorrecta.');
tz_def('WEL_TOPIC', 'Consejos e información útiles ');
tz_def('ATAG_EMPTY', 'Etiqueta vacía');
tz_def('ANAME_EMPTY', 'Nombre vacío');
tz_def('ATAG_EXIST', 'Etiqueta en uso');
tz_def('ANAME_EXIST', 'Nombre en uso');
tz_def('ALREADY_ALLY_MEMBER', 'Ya estás en una alianza');
tz_def('ALLY_TOO_LOW', 'Debes tener una embajada de nivel 3 o superior');
tz_def('USER_NOT_IN_YOUR_ALLY', '¡Este usuario no está en tu alianza!');
tz_def('CANT_EDIT_YOUR_PERMISSIONS', '¡No puedes editar tus propios permisos!');
tz_def('CANT_EDIT_LEADER_PERMISSIONS', '¡Los permisos del líder de la alianza no se pueden editar!');
tz_def('CANT_REMOVE_LEADER', '¡No puedes expulsar al fundador de la alianza!');
tz_def('FOUNDER_LEAVE_NEW', '¡No se seleccionó un fundador!');
tz_def('FOUNDER_LEAVE_INVALID', '¡Fundador no válido!');
tz_def('NO_PERMISSION', '¡No tienes suficientes permisos!');
tz_def('NAME_OR_DIPL_EMPTY', 'Nombre o diplomacia vacíos');
tz_def('ALLY_DOESNT_EXISTS', 'La alianza no existe');
tz_def('CANNOT_INVITE_SAME_ALLY', 'No puedes invitar a tu propia alianza');
tz_def('WRONG_DIPLOMACY', 'Elección incorrecta');
tz_def('INVITE_ALREADY_SENT', 'O ya has enviado un pacto a esta alianza, ellos te lo enviaron o ya tienes un pacto con ellos');
tz_def('INVITE_SENT', 'Invitación enviada');
tz_def('DECLARED_WAR_ON', 'declaró la guerra a');
tz_def('OFFERED_NON_AGGRESION_PACT_TO', 'ofreció un pacto de no agresión a');
tz_def('OFFERED_CONFED_TO', 'ofreció una confederación a');
tz_def('ALLY_TOO_MUCH_PACTS', 'O no puedes ofrecer más pactos de este tipo o esta alianza ha alcanzado el límite para este tipo de pactos');
tz_def('ALLY_PERMISSIONS_UPDATED', 'Permisos actualizados');
tz_def('ALLY_FORUM_LINK_UPDATED', 'Enlace del foro actualizado');
tz_def('NO_FORUMS_YET', 'Aún no hay foros.');
tz_def('ALLY_USER_KICKED', ' ha sido expulsado de la alianza');
tz_def('NOT_OPENED_YET', 'El servidor aún no ha comenzado.');
tz_def('REGISTER_CLOSED', 'El registro está cerrado. No puedes registrarte en este servidor.');
tz_def('NAME_EMPTY', 'Por favor, introduce un nombre');
tz_def('NAME_NO_EXIST', 'No hay ningún usuario con el nombre ');
tz_def('ID_NO_EXIST', 'No hay ningún usuario con el id ');
tz_def('SAME_NAME', 'No puedes invitarte a ti mismo');
tz_def('ALREADY_INVITED', ' ya invitado');
tz_def('ALREADY_IN_ALLY', ' ya está en esta alianza');
tz_def('ALREADY_IN_AN_ALLY', ' ya está en una alianza');
tz_def('NAME_OR_TAG_CHANGED', 'Nombre o etiqueta cambiados');
tz_def('VAC_MODE_WRONG_DAYS', 'Has introducido un número incorrecto de días');

//COPYRIGHT
tz_def('TRAVIAN_COPYRIGHT', 'TravianZ 100% Open Source Travian Clone.');

//BUILD.TPL
tz_def('CUR_PROD', 'Producción actual');
tz_def('NEXT_PROD', 'Producción en el nivel ');
tz_def('CONSTRUCT_BUILD', 'Construir edificio');

//DORF1
tz_def('LUMBER', 'Madera');
tz_def('CLAY', 'Barro');
tz_def('IRON', 'Hierro');
tz_def('CROP', 'Cereal');
tz_def('LEVEL', 'Nivel');
tz_def('CROP_COM', CROP.' consumption');
tz_def('PER_HR', 'por hora');
tz_def('PRODUCTION', 'Producción');
tz_def('CAPITAL1', 'Capital');
tz_def('VILLAGES', 'Aldeas');
tz_def('ANNOUNCEMENT', 'Anuncio');
tz_def('GO2MY_VILLAGE', 'Ir a mi aldea');
tz_def('VILLAGE_CENTER', 'Centro de la aldea');
tz_def('FINISH_GOLD', '¿Terminar todas las órdenes de construcción e investigación en esta aldea inmediatamente por 2 de oro?');
tz_def('WAITING_LOOP', '(cola de espera)');
tz_def('CROP_NEGATIVE', 'Tu producción de cereal es negativa, nunca alcanzarás la cantidad de recursos solicitada.');
tz_def('HR', 'h.');
tz_def('HRS', '(hrs.)');
tz_def('DONE_AT', 'terminado a las');
tz_def('CANCEL', 'cancelar');
tz_def('LOYALTY', 'Lealtad');
tz_def('CALCULATED_IN', 'Calculado en');
tz_def('HI', 'Hola');
tz_def('P_IN', 'en');
tz_def('MS', 'ms');
tz_def('SERVER_TIME', 'Hora del servidor:');
tz_def('LOCAL_TIME', 'Hora local:');
tz_def('REMAINING_GOLD', 'Oro restante');

// HEADER && MENU && Messages && Reports
tz_def('REPORTS', 'Informes');
tz_def('MESSAGES', 'Mensajes');
tz_def('PLUS_MENU', 'Menú Plus');
tz_def('LINKS', 'Enlaces');
tz_def('CANCEL_PROCESS', 'Cancelar proceso');
tz_def('ACCOUNT_DELETING', 'La cuenta se eliminará en');
tz_def('INBOX', 'Bandeja de entrada');
tz_def('WRITE', 'Escribir');
tz_def('SENT', 'Enviados');
tz_def('SEND', 'Enviar');
tz_def('ARCHIVE', 'Archivo');
tz_def('NOTES', 'Notas');
tz_def('SUBJECT', 'Asunto');
tz_def('SENDER', 'Remitente');
tz_def('RECIPIENT', 'Destinatario');
tz_def('BACK', 'Atrás');
tz_def('NEW', 'nuevo');
tz_def('UNREAD', 'no leído');
tz_def('NO_MESS', 'No hay mensajes disponibles');
tz_def('NO_MESS_IN_ARCHIVE', NO_MESS.' in the archive');
tz_def('NO_MESS_SENT', 'No hay mensajes enviados disponibles');
tz_def('MESS_FOR_SUP', 'Mensaje para Soporte');
tz_def('MESS_FOR_MH', 'Mensaje para Multihunter');
tz_def('SEND_AS_SUP', 'Enviar como Soporte');
tz_def('SEND_AS_MH', 'Enviar como Multihunter');
tz_def('SAVE', 'Guardar');
tz_def('ANSWER', 'Responder');
tz_def('REPLY', 'Responder');
tz_def('ADDRESSBOOK', 'Agenda');
tz_def('CLOSE_ADDRESSBOOK', 'Cerrar agenda');
tz_def('ONLINE_S1', 'Ahora en línea');
tz_def('ONLINE_S2', 'Desconectado');
tz_def('ONLINE_S3', 'Últimos 3 días');
tz_def('ONLINE_S4', 'Últimos 7 días');
tz_def('ONLINE_S5', 'Inactivo');
tz_def('WAIT_FOR_CONFIRM', 'Esperar confirmación');
tz_def('CONFIRM', 'Confirmar');
tz_def('WRITE_MESS_WARN', '<b>Warning:</b> you can`t use the values <b>[message]</b> or <b>[/message]</b> in your message because it can cause problem with bbcode system');
tz_def('NO_REPORTS', 'No hay informes disponibles');
tz_def('ATTACKER', 'Atacante');
tz_def('NATAR_COUNTERFORCE', 'Contraataque de los Natares');
tz_def('FROM_THE_VILL', 'de la aldea');
tz_def('CASUALTIES', 'Bajas');
tz_def('INFORMATION', 'Información');
// === Battle report strings (issue: i18n of combat reports) ===
tz_def('RC_HERO', 'Héroe');
tz_def('RC_CATAPULT', 'Catapulta');
tz_def('RC_TRAP', 'Trampa');
tz_def('RC_WALL', 'Muralla');
tz_def('TZ_AT', 'en');
// Catapults
tz_def('RC_DESTROYED', 'destruido');
tz_def('RC_NOT_DAMAGED', 'no fue dañado.');
tz_def('RC_DAMAGED_FROM_TO', 'dañado del nivel <b>%s</b> al nivel <b>%s</b>.');
tz_def('RC_NO_BUILDINGS', 'No quedan edificios por destruir');
tz_def('RC_VILLAGE_ALREADY_DESTROYED', 'La aldea ya está destruida.');
tz_def('RC_VILLAGE_CANT_DESTROY', "Village can't be destroyed.");
tz_def('RC_VILLAGE_CANT_BE', "Village can't be");
tz_def('RC_VILLAGE_DESTROYED', 'La aldea ha sido destruida.');
// Rams
tz_def('RC_NO_WALL', 'No hay muralla que destruir.');
tz_def('RC_WALL_DESTROYED', 'Muralla <b>destruida</b>.');
tz_def('RC_WALL_NOT_DAMAGED', 'La muralla no fue dañada.');
tz_def('RC_WALL_DAMAGED_FROM_TO', 'Muralla dañada del nivel <b>%s</b> al nivel <b>%s</b>.');
// Conquest / chief
tz_def('RC_NO_REDUCE_CP_RAID', 'No se pudieron reducir los puntos de cultura durante el saqueo');
tz_def('RC_NOT_ENOUGH_CP', 'No hay suficientes puntos de cultura.');
tz_def('RC_CANT_TAKEOVER', 'No puedes conquistar esta aldea.');
tz_def('RC_RESIDENCE_NOT_DESTROYED', "The Palace/Residence isn't destroyed!");
tz_def('RC_LOYALTY_LOWERED', 'La lealtad se redujo de <b>%s</b> a <b>%s</b>.');
tz_def('RC_INHABITANTS_JOIN', 'Los habitantes de la aldea %s decidieron unirse a tu imperio.');
// Hero
tz_def('RC_HERO_NO_KILL', 'Tu héroe no tenía nada que matar, por lo tanto no gana XP.');
tz_def('RC_HERO_GAINED_XP', 'Tu héroe ganó <b>%s</b> XP.');
tz_def('RC_HERO_CONQUERED_OASIS', 'Tu héroe ha conquistado este oasis');
tz_def('RC_HERO_REDUCED_OASIS_LOYALTY', 'Tu héroe ha reducido la lealtad del oasis a %s desde %s');
tz_def('RC_NO_REDUCE_LOYALTY_RAID', 'No se pudo reducir la lealtad durante el saqueo');
tz_def('RC_HERO_CARRYING_ARTIFACT', 'Tu héroe trae de vuelta el artefacto <b>%s</b> y');
tz_def('RC_HERO_NO_ARTIFACT_RAID', 'Tu héroe no pudo reclamar un artefacto durante el saqueo');
tz_def('RC_HERO_AND_GAINED_XP_BATTLE', 'y ganó <b>%s</b> XP de la batalla.');
tz_def('RC_HERO_NO_XP_BATTLE', 'sin XP de la batalla.');
tz_def('RC_HERO_GAINED_XP_BATTLE', 'ganó <b>%s</b> XP de la batalla.');
tz_def('RC_HERO_BUT_GAINED_XP_BATTLE', 'pero ganó <b>%s</b> XP de la batalla.');
tz_def('RC_HERO_TRAPPED', 'Tu héroe fue atrapado');
tz_def('RC_HERO_DIED', 'Tu héroe murió');
// Scout report
tz_def('RC_TOTAL_RESOURCES', 'Recursos totales:');
tz_def('RC_RESIDENCE_LEVEL', 'Nivel de la residencia:');
tz_def('RC_PALACE_LEVEL', 'Nivel del palacio:');
tz_def('RC_WALL_LEVEL', 'Nivel de la muralla:');
tz_def('RC_CRANNY_CAPACITY', 'Capacidad total de escondites:');
tz_def('RC_NO_INFO', 'No hay información para mostrar');
// Prisoners / traps
tz_def('RC_OF_WHICH_SAVED', 'de los cuales <b>%s</b> se han salvado');
tz_def('RC_FREED_FROM_HIS_TROOPS', 'liberó <b>%s</b> de sus tropas');
tz_def('RC_FREED_FRIENDLY_TROOPS', 'liberó <b>%s</b> tropas amigas');
tz_def('RC_AND_FRIENDLY_TROOPS', 'y <b>%s</b> tropas amigas');
// Troop return
tz_def('RC_NONE_RETURNED', 'Ninguno de tus soldados regresó.');
// === End battle report strings ===
// === System / alliance in-game messages (sendMessage), rendered per reader ===
tz_def('MSG_INVITE_ALLIANCE', 'Invitación a la alianza');
tz_def('MSG_FORUM_NEW_TITLE', 'Nuevo mensaje en el foro');
tz_def('MSG_FORUM_NEW_BODY', "Hi!\n\n<a href=\"%s\">%s</a> posted a new message into your common topic. Here's a link that will get you there: <a href=\"%s\">forum link</a>\n\nYours sincerely,\n<i>Server Robot :)</i>");
tz_def('MSG_LEFT_ALLIANCE_TITLE', 'Has abandonado la alianza');
tz_def('MSG_FORCED_LEAVE_TITLE', 'Un ataque te ha obligado a abandonar la alianza');
tz_def('MSG_LEFT_DEMOLITION_BODY', "Hi, %s!\n\nThis is to inform you that due to a finished demolition of your last Embassy, you have now successfully left your alliance.\n\nYours sincerely,\n<i>Server Robot :)</i>");
tz_def('MSG_LEFT_ATTACK_BODY', "Hi, %s!\n\nThis is to inform you that due to a successful attack and destruction of your last Embassy, you have been forced to leave your alliance.\n\nTo re-establish your position in this alliance, you will need to build a new Embassy and ask the leader to send you an invite again.\n\nYours sincerely,\n<i>Server Robot :)</i>");
tz_def('MSG_DISBAND_TITLE', 'Tu alianza fue disuelta');
tz_def('MSG_DISBAND_OWNER_BODY', "Hi, %s!\n\nThis is to inform you that due to a finished demolition of your last Embassy at level 3, and the fact that you were the leader of your alliance, this alliance has been disbanded.\n\nIn order to found a new alliance, please build a level 3 Embassy again in one of your villages.\n\nYours sincerely,\n<i>Server Robot :)</i>");
tz_def('MSG_DISBAND_MEMBER_BODY', "Hi, %s!\n\nThis is to inform you that due to a demolition of your alliance founder's last Embassy below level 3, this alliance has been disbanded.\n\nYou can now accept invitations from other alliances or found a new alliance yourself.\n\nYours sincerely,\n<i>Server Robot :)</i>");
tz_def('MSG_NOW_ALLIANCE_LEADER_TITLE', 'Ahora eres el líder de la alianza');
tz_def('MSG_NOW_LEADER_TITLE', 'Ahora eres el líder de tu alianza');
tz_def('MSG_PROMOTE_BODY', "Hi, %s!\n\nThis is to inform you that there was a successful attack on player <a href=\"spieler.php?uid=%s\">%s</a> which has damaged their Embassy badly enough that they are no longer able to sustain the leadership of your alliance.\n\nSince your Embassy level is of a sufficient level, you have been auto-elected to the position of a new leader of your alliance with all duties and responsibilities thereof.\n\nYours sincerely,\n<i>Server Robot :)</i>");
tz_def('MSG_DISPERSE_TITLE', 'Tu alianza fue dispersada');
tz_def('MSG_DISPERSE_OWNER_BODY_MANY', "Hi, %s!\n\nThis is to inform you that due to a successful attack that has degraded your last Embassy to a level which is unable to hold all %s alliance members, and because there was no other alliance member with an Embassy on a high enough level to overtake the leadership, your alliance has been dispersed.\n\nYours sincerely,\n<i>Server Robot :)</i>");
tz_def('MSG_DISPERSE_OWNER_BODY_FEW', "Hi, %s!\n\nThis is to inform you that due to a successful attack that has degraded your last Embassy to a level lower then 3 - which is required to found and hold your own alliance - your alliance has been dispersed.\n\nYours sincerely,\n<i>Server Robot :)</i>");
tz_def('MSG_DISPERSE_MEMBER_BODY', "Hi, %s!\n\nThis is to inform you that due to a successful attack on your alliance leader's Embassy by another player that degraded it below threshold allowed to hold all %s alliance members, and because there was no other alliance member with an Embassy on a high enough level to overtake the leadership, your alliance has been dispersed.\n\nYours sincerely,\n<i>Server Robot :)</i>");
tz_def('MSG_NEW_LEADER_TITLE', 'Tu alianza tiene un nuevo líder');
tz_def('MSG_NEWLEADER_OWNER_BODY', "Hi, %s!\n\nThis is to inform you that due to a successful attack that has degraded your last Embassy to a level which is unable to hold all %s alliance members, another alliance member who meets these criteria has been auto-elected as a new alliance leader.\n\nAdditionally - due to the Embassy destruction - you have been forcefuly evicted from your alliance.\n\nPlease re-establish the connection with your alliance by building a new Embassy and contacting <a href=\"spieler.php?uid=%s\">the new leader</a> for an invitation.\n\nYours sincerely,\n<i>Server Robot :)</i>");
tz_def('MSG_NEWLEADER_MEMBER_BODY', "Hi, %s!\n\nThis is to inform you that due to a successful attack on your alliance leader's Embassy by another player, <a href=\"spieler.php?uid=%s\">another alliance member</a> with enough Embassy capacity has been auto-elected as the new alliance leader.\n\nYours sincerely,\n<i>Server Robot :)</i>");
tz_def('MSG_FORCED_LEAVE_BODY', "Hi, %s!\n\nThis is to inform you that due to a successful attack and destruction of your last Embassy, you have been forced to leave your alliance.\n\nTo re-establish your position in this alliance, you will need to build a new Embassy and ask the <a href=\"spieler.php?uid=%s\">newly auto-elected leader</a> to send you an invite again.\n\nYours sincerely,\n<i>Server Robot :)</i>");
tz_def('MSG_INVITE_BODY', "Hi, %s!\n\nThis is to inform you that you have been invited to join an alliance. To accept this invitation, please visit your Embassy.\n\nYours sincerely,\n<i>Server Robot :)</i>");
tz_def('MSG_QUIT_REPLACEMENT_BODY', "Hi!\n\nThis is to inform you that the former leader of your alliance - %s, has decided to quit and elected you as his replacement. You now gain full access, administration and responsibilities to your alliance.\n\nGood luck!\n\nYours sincerely,\n<i>Server Robot :)</i>");
// Embassy-destruction status lines, appended to the catapult battle report.
tz_def('MSG_ALLIANCE_DISPERSED_STATUS', "This player's alliance has been dispersed.");
tz_def('MSG_FORCED_LEAVE_STATUS', 'El jugador fue obligado a abandonar su alianza.');
// Alliance news-feed notices (rendered in Templates/Alliance/news.tpl)
tz_def('MSG_INVITE_NOTICE', '%s ha invitado a %s a la alianza.');
tz_def('MSG_ALLIANCE_FOUNDED', 'La alianza ha sido fundada por %s.');
tz_def('MSG_NEWS_REJECTED', '%s ha rechazado la invitación.');
tz_def('MSG_NEWS_DELETED_INVITE', '%s ha eliminado la invitación para %s.');
tz_def('MSG_NEWS_JOINED', '%s se ha unido a la alianza.');
tz_def('MSG_NEWS_NAME_CHANGED', '%s ha cambiado el nombre de la alianza.');
tz_def('MSG_NEWS_DESC_CHANGED', '%s ha cambiado la descripción de la alianza.');
tz_def('MSG_NEWS_PERMS_CHANGED', '%s ha cambiado los permisos de %s.');
tz_def('MSG_NEWS_EXPELLED', '%s ha sido expulsado de la alianza por %s.');
tz_def('MSG_NEWS_QUIT', '%s ha abandonado la alianza.');
tz_def('MSG_NEWS_DIPLO_CONFED', '%s ofreció una confederación a %s.');
tz_def('MSG_NEWS_DIPLO_NAP', '%s ofreció un pacto de no agresión a %s.');
tz_def('MSG_NEWS_DIPLO_WAR', '%s declaró la guerra a %s.');
tz_def('CARRY', 'carga');
tz_def('DEFENDER', 'Defensor');
tz_def('VISITED', 'visitó');
tz_def('HIS_TROOPS', ' tropas de');
tz_def('WISHES_YOU', 'te desea');
tz_def('X_MAS', 'Feliz Navidad');
tz_def('NEW_YEAR', 'Feliz Año Nuevo');
tz_def('EASTER', 'Feliz Pascua');
if(!defined('PEACE')) tz_def('PEACE', 'Paz');

tz_def('GOLD', 'Oro');
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

tz_def('RESOURCES_OVERVIEW', 'Resumen de recursos');
tz_def('YOUR_RES_DELIVERIES', 'Tus entregas de recursos');
tz_def('DELIVERY', 'Entrega');
tz_def('DELIVERY_TIME', 'Tiempo de entrega');
tz_def('STATUS', 'Estado');
tz_def('FETCH', 'recoger');
tz_def('FETCHED', 'recogido');
tz_def('ON_HOLD', 'en espera');
tz_def('ONE_DAY_OF_TRAVIAN', '1 día de Travian ');
tz_def('TWO_DAYS_OF_TRAVIAN', '2 días de Travian ');

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
tz_def('U0', 'Héroe');

//ROMAN UNITS
tz_def('U1', 'Legionario');
tz_def('U2', 'Pretoriano');
tz_def('U3', 'Imperano');
tz_def('U4', 'Equites Legati');
tz_def('U5', 'Equites Imperatoris');
tz_def('U6', 'Equites Caesaris');
tz_def('U7', 'Ariete');
tz_def('U8', 'Catapulta de fuego');
tz_def('U9', 'Senador');
tz_def('U10', 'Colono');

//TEUTON UNITS
tz_def('U11', 'Luchador de porra');
tz_def('U12', 'Lancero');
tz_def('U13', 'Hachero');
tz_def('U14', 'Explorador');
tz_def('U15', 'Paladín');
tz_def('U16', 'Caballero teutón');
tz_def('U17', 'Ariete');
tz_def('U18', 'Catapulta');
tz_def('U19', 'Jefe');
tz_def('U20', 'Colono');

//GAUL UNITS
tz_def('U21', 'Falange');
tz_def('U22', 'Espadachín');
tz_def('U23', 'Explorador');
tz_def('U24', 'Rayo de Theutates');
tz_def('U25', 'Jinete druida');
tz_def('U26', 'Haeduano');
tz_def('U27', 'Ariete');
tz_def('U28', 'Trabuco');
tz_def('U29', 'Cacique');
tz_def('U30', 'Colono');
tz_def('U99', 'Trampa');

//NATURE UNITS
tz_def('U31', 'Rata');
tz_def('U32', 'Araña');
tz_def('U33', 'Serpiente');
tz_def('U34', 'Murciélago');
tz_def('U35', 'Jabalí');
tz_def('U36', 'Lobo');
tz_def('U37', 'Oso');
tz_def('U38', 'Cocodrilo');
tz_def('U39', 'Tigre');
tz_def('U40', 'Elefante');

//NATARS UNITS
tz_def('U41', 'Piquero');
tz_def('U42', 'Guerrero de espinas');
tz_def('U43', 'Guardia');
tz_def('U44', 'Aves de presa');
tz_def('U45', 'Jinete de hacha');
tz_def('U46', 'Caballero natario');
tz_def('U47', 'Elefante de guerra');
tz_def('U48', 'Balista');
tz_def('U49', 'Emperador natario');
tz_def('U50', 'Colono natario');
//HUNS (TRIBE 6)
tz_def('U51', 'Guerrero huno');
tz_def('U52', 'Explorador a caballo');
tz_def('U53', 'Arquero a caballo');
tz_def('U54', 'Jinete de la estepa');
tz_def('U55', 'Lancero huno');
tz_def('U56', 'Jinete de élite');
tz_def('U57', 'Ariete');
tz_def('U58', 'Catapulta');
tz_def('U59', 'Jefe tribal');
tz_def('U60', 'Colono huno');
//EGYPTIANS (TRIBE 7)
tz_def('U61', 'Esclavo armado');
tz_def('U62', 'Luchador egipcio');
tz_def('U63', 'Guardián del templo');
tz_def('U64', 'Explorador a caballo');
tz_def('U65', 'Carro de guerra');
tz_def('U66', 'Carro real');
tz_def('U67', 'Ariete');
tz_def('U68', 'Catapulta');
tz_def('U69', 'Nomarca');
tz_def('U70', 'Colono egipcio');
//SPARTANS (TRIBE 8)
tz_def('U71', 'Hoplita espartano');
tz_def('U72', 'Guerrero de la Agoge');
tz_def('U73', 'Homoioi');
tz_def('U74', 'Explorador perioikoi');
tz_def('U75', 'Jinete espartano');
tz_def('U76', 'Hippeis');
tz_def('U77', 'Ariete');
tz_def('U78', 'Catapulta');
tz_def('U79', 'Éforo');
tz_def('U80', 'Colono espartano');
//VIKINGS (TRIBE 9)
tz_def('U81', 'Saqueador vikingo');
tz_def('U82', 'Explorador vikingo');
tz_def('U83', 'Hachero');
tz_def('U84', 'Berserker');
tz_def('U85', 'Jinete vikingo');
tz_def('U86', 'Huscarl');
tz_def('U87', 'Ariete');
tz_def('U88', 'Catapulta');
tz_def('U89', 'Jarl');
tz_def('U90', 'Colono vikingo');

//INDEX.php
tz_def('LOGIN', 'Iniciar sesión');
tz_def('PLAYERS', 'Jugadores');
tz_def('MODERATOR', 'Moderador');
tz_def('ACTIVE', 'Activos');
tz_def('ONLINE', 'En línea');
tz_def('TUTORIAL', 'Tutorial');
if(!defined('FAQ')) tz_def('FAQ', 'Faq');
if(!defined('SPIELREGELN')) tz_def('SPIELREGELN', 'Reglas del juego');
tz_def('PLAYER_STATISTICS', 'Estadísticas de jugadores');
tz_def('TOTAL_PLAYERS', PLAYERS.' in total');
tz_def('ACTIVE_PLAYERS', 'Jugadores activos');
tz_def('ONLINE_PLAYERS', PLAYERS.' online');
tz_def('MP_STRATEGY_GAME', SERVER_NAME.' - the multiplayer strategy game');
tz_def('WHAT_IS', SERVER_NAME.' is one of the most popular browser games in the world. As a player in '.SERVER_NAME.', you will build your own empire, recruit a mighty army, and fight with your allies for game world hegemony.');
tz_def('REGISTER_FOR_FREE', '¡Regístrate aquí gratis!');
tz_def('LATEST_GAME_WORLD', 'Último mundo de juego');
tz_def('LATEST_GAME_WORLD2', 'Register on the latest<br>game world and enjoy<br>the advantages of<br>being one of the<br>first players.');
tz_def('PLAY_NOW', 'Play '.SERVER_NAME.' now');
tz_def('LEARN_MORE', 'Learn more <br>about '.SERVER_NAME.'!');
tz_def('LEARN_MORE2', 'Now with a revolutionised<br>server system, completely new<br>graphics <br>This clone is The Shiz!');
tz_def('COMUNITY', 'Community');
tz_def('BECOME_COMUNITY', 'Become part of our community now!');
tz_def('BECOME_COMUNITY2', 'Become a part of one of<br>the biggest gaming<br>communities in the<br>world.');
tz_def('NEWS', 'Noticias');
tz_def('SCREENSHOTS', 'Capturas de pantalla');
tz_def('AGB', 'Términos y condiciones');
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
tz_def('CHOOSE', 'Por favor, elige un servidor.');
tz_def('STARTED', ' The server started '. round((time() - COMMENCE) / 86400) .' days ago.');

//ANMELDEN.php
tz_def('NICKNAME', 'Apodo');
tz_def('EMAIL', 'Email');
tz_def('PASSWORD', 'Contraseña');
tz_def('NW', 'Noroeste');
tz_def('NE', 'Noreste');
tz_def('SW', 'Suroeste');
tz_def('SE', 'Sureste');
tz_def('RANDOM', 'aleatorio');
tz_def('ACCEPT_RULES', ' Acepto las reglas del juego y las condiciones generales.');
tz_def('ONE_PER_SERVER', 'Cada jugador solo puede tener UNA cuenta por servidor.');
tz_def('BEFORE_REGISTER', 'Before you register an account you should read the <a href="/anleitung.php" target="_blank">instructions</a> of Travian ro1 to see the specific advantages and disadvantages of the each tribes.');
tz_def('BUILDING_UPGRADING', 'Edificio:');
tz_def('HOURS', 'horas');


//ATTACKS ETC.
tz_def('TROOP_MOVEMENTS', 'Movimientos de tropas:');
tz_def('ARRIVING_REINF_TROOPS', 'Tropas de refuerzo que llegan');
tz_def('ARRIVING_ATTACKING_TROOPS', 'Tropas atacantes que llegan');
tz_def('ARRIVING_REINF_TROOPS_SHORT', 'Ref.');
tz_def('OWN_ATTACKING_TROOPS', 'Tropas propias atacando');
tz_def('ATTACK', 'Ataque');
tz_def('OWN_REINFORCING_TROOPS', 'Tropas propias reforzando');
tz_def('NEWVILLAGE', 'Nueva aldea.');
tz_def('FOUNDNEWVILLAGE', 'Fundando nueva aldea');
tz_def('UNDERATTACK', 'La aldea está bajo ataque');
tz_def('OASISATTACK', 'El oasis está bajo ataque');
tz_def('OASISATTACKS', 'Ataque al oasis');
tz_def('RETURNFROM', 'Regreso de');
tz_def('REINFORCEMENTFOR', 'Refuerzo a');
tz_def('ATTACK_ON', 'Ataque a');
tz_def('RAID_ON', 'Saqueo a');
tz_def('MARK_ATTACK', 'Marcar este ataque (gravedad)');
tz_def('SCOUTING', 'Exploración');
tz_def('PRISONERS', 'Prisioneros');
tz_def('PRISONERSIN', 'Prisioneros en');
tz_def('PRISONERSFROM', 'Prisioneros de');
tz_def('TROOPS', 'Tropas');
tz_def('BOUNTY', 'Botín');
tz_def('ARRIVAL', 'Llegada');
tz_def('CATAPULT_TARGET', 'Objetivo(s) de la catapulta');
tz_def('INCOMING_TROOPS', 'Tropas entrantes');
tz_def('TROOPS_ON_THEIR_WAY', 'Tropas en camino');
tz_def('OWN_TROOPS', 'Tropas propias');
tz_def('ON', 'en');
tz_def('AT', 'a las');
tz_def('UPKEEP', 'Mantenimiento');
tz_def('SEND_BACK', 'Enviar de vuelta');
tz_def('TROOPS_IN_THE_VILLAGE', 'Tropas en la aldea');
tz_def('TROOPS_IN_OTHER_VILLAGE', 'Tropas en otra aldea');
tz_def('TROOPS_IN_OASIS', 'Tropas en el oasis');
tz_def('KILL', 'Matar');
tz_def('FROM', 'De');
tz_def('SEND_TROOPS', 'Enviar tropas');
tz_def('TASKMASTER', 'Maestro de tareas');
tz_def('TO_THE_TASK', 'A la tarea');
tz_def('VILLAGE_OF_THE_ELDERS', 'aldea de los ancianos');
tz_def('VILLAGE_OF_THE_ELDERS_TROOPS', 'tropas de la aldea de los ancianos');

//SEND TROOP
tz_def('REINFORCE', 'Refuerzo');
tz_def('NORMALATTACK', 'Ataque normal');
tz_def('RAID', 'Saqueo');
tz_def('OR', 'o');
tz_def('SENDTROOP', 'Enviar tropas');
tz_def('NOTROOP', 'sin tropas');

//map
tz_def('DETAIL', 'Detalles');
tz_def('ABANDVALLEY', 'Valle abandonado');
tz_def('OCCUPIED', 'Ocupado');
tz_def('UNOCCUPIED', 'Desocupado');
tz_def('UNOCCUOASIS', 'Oasis desocupado');
tz_def('OCCUOASIS', 'Oasis ocupado');
tz_def('THERENOINFO', 'No hay<br>información disponible.');
tz_def('LANDDIST', 'Distribución de tierras');
tz_def('TRIBE', 'Tribu');
tz_def('ALLIANCE', 'Alianza');
tz_def('POP', 'Población');
tz_def('REPORT', 'Informe');
tz_def('OPTION', 'Opciones');
tz_def('CENTREMAP', 'Centrar mapa');
tz_def('FNEWVILLAGE', 'Fundar nueva aldea');
tz_def('CULTUREPOINT', 'puntos de cultura');
tz_def('BUILDRALLY', 'construir un punto de reunión');
tz_def('SETTLERSAVAIL', 'colonos disponibles');
tz_def('BEGINPRO', 'protección de principiantes');
tz_def('SENDMERC', 'Enviar mercader(es)');
tz_def('BAN', 'El jugador está baneado');
tz_def('BUILDMARKET', 'Construir mercado');
tz_def('PERHOUR', 'por hora');
tz_def('BONUS', 'Bonus');
tz_def('MAP', 'Mapa');
tz_def('LARGE_MAP', 'Mapa grande');
tz_def('LARGE_MAP_DESC', 'Mostrar el mapa grande en una ventana extra');
tz_def('CROPFINDER', 'Buscador de cereal');
tz_def('NORTH', 'Norte');
tz_def('EAST', 'Este');
tz_def('SOUTH', 'Sur');
tz_def('WEST', 'Oeste');
tz_def('CLOSE_MAP', 'Cerrar mapa');
tz_def('AND', 'y');

//other
tz_def('VILLAGE', 'Aldea');
tz_def('STATISTICS', 'Estadísticas');
tz_def('ALLIANCES', 'Alianzas');
tz_def('HEROES', 'Héroes');
tz_def('GENERAL', 'General');
tz_def('WWS', 'Maravilla del Mundo');
tz_def('TOP10P', 'TOP 10 Jugadores');
tz_def('TOP10PA', 'TOP 10 Atacantes');
tz_def('TOP10PD', 'TOP 10 Defensores');
tz_def('TOP10A', 'TOP 10 Alianzas');
tz_def('TOP10AA', 'TOP 10 Alianzas atacantes');
tz_def('TOP10AD', 'TOP 10 Alianzas defensoras');
tz_def('MILESTONES', 'Hitos');
tz_def('OASIS', 'Oasis');
tz_def('NO_OASIS', 'No posees ningún oasis.');
tz_def('NO_VILLAGES', 'No hay aldeas.');
tz_def('PLAYER', 'Jugador');

//LOGIN.php
tz_def('COOKIES', 'Debes tener las cookies activadas para poder iniciar sesión. Si compartes este ordenador con otras personas, deberías cerrar sesión después de cada sesión por tu propia seguridad.');
tz_def('NAME', 'Nombre');
tz_def('PW_FORGOTTEN', '¿Contraseña olvidada?');
tz_def('PW_REQUEST', 'Entonces puedes solicitar una nueva que se enviará a tu dirección de email.');
tz_def('PW_GENERATE', 'Generar nueva contraseña.');
tz_def('EMAIL_NOT_VERIFIED', '¡Email no verificado!');
tz_def('EMAIL_FOLLOW', 'Sigue este enlace para activar tu cuenta.');
tz_def('VERIFY_EMAIL', 'Verificar email.');
tz_def('SERVER_STARTS_IN', 'El servidor comenzará en: ');
tz_def('START_NOW', 'EMPEZAR AHORA');


//404.php
tz_def('NOTHING_HERE', '¡Nada aquí!');
tz_def('WE_LOOKED', 'Ya buscamos 404 veces pero no encontramos nada');

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
tz_def('WOODCUTTER', 'Leñador');
tz_def('WOODCUTTER_DESC', 'The woodcutter cuts down trees in order to produce lumber. The further you extend the woodcutter, the more lumber is produced.<br>By constructing a sawmill, you can further increase the production');
tz_def('CLAYPIT', 'Barrera de barro');
tz_def('CLAYPIT_DESC', 'Here, clay is produced. By increasing its level, you increase clay production.<br>By constructing a brickyard, you can further increase the production');
tz_def('IRONMINE', 'Mina de hierro');
tz_def('IRONMINE_DESC', 'Here, miners gather the precious resource of iron. By increasing the mine`s level, you increase its iron production.<br>By constructing an iron foundry, you can further increase the production');
tz_def('CROPLAND', 'Campo de cereal');
tz_def('CROPLAND_DESC', 'Your population`s food is produced here. By increasing the cropland`s level, you increase crop production.<br>By constructing a grain mill and a bakery, you can further increase the production');

tz_def('SAWMILL', 'Aserradero');
tz_def('SAWMILL_DESC', 'Lumber cut by your woodcutters is processed here. The Sawmill boosts wood production in the village. At Level 1, it increases wood production by 5%, and every time you upgrade it, the production is increased by 5% more, for a total of 25% after 5 levels.<br>The bonus from the Sawmill and all buildings providing resource bonuses only apply to the village in which the building is built.<br>Note that the Sawmill bonus does not apply to other bonus effects such as Oasis income or the 10% PLUS bonus.<br>There are also villages consisting of 3 or 5 wood fields. The more fields in a village, more the Sawmill levels can be efficiently');
tz_def('CURRENT_WOOD_BONUS', 'Bonus actual de madera:');
tz_def('WOOD_BONUS_LEVEL', 'Bonus de madera en el nivel');
tz_def('MAX_LEVEL', 'Edificio ya en el nivel máximo');
tz_def('PERCENT', 'Porcentaje');

tz_def('BRICKYARD', 'Ladrillería');
tz_def('CURRENT_CLAY_BONUS', 'Bonus actual de barro:');
tz_def('CLAY_BONUS_LEVEL', 'Bonus de barro en el nivel');
tz_def('BRICKYARD_DESC', 'Clay converts into bricks here. The Brickyard boosts clay production in the village. At Level 1, it increases clay production by 5%, and every time you upgrade it, the production is increased by 5% more, for a total of 25% after 5 levels.<br>The bonus from the Brickyard and all buildings providing resource bonuses only apply to the village in which the building is built.<br>Note that the Brickyard bonus does not apply to other bonus effects such as Oasis income or the 10% PLUS bonus.<br>There are also villages consisting of 3 or 5 clay fields. The more fields in a village, more the Brickyard levels can be efficiently');

tz_def('IRONFOUNDRY', 'Fundición de hierro');
tz_def('CURRENT_IRON_BONUS', 'Bonus actual de hierro:');
tz_def('IRON_BONUS_LEVEL', 'Bonus de hierro en el nivel');
tz_def('IRONFOUNDRY_DESC', 'Iron melts here. The Iron Foundry boosts iron production in the village. At Level 1, it increases iron production by 5%, and every time you upgrade it, the production is increased by 5% more, for a total of 25% after 5 levels.<br>The bonus from the Iron Foundry and all buildings providing resource bonuses only apply to the village in which the building is built.<br>Note that the Iron Foundry bonus does not apply to other bonus effects such as Oasis income or the 10% PLUS bonus.<br>There are also villages consisting of 3 or 5 iron fields. The more fields in a village, more the Iron Foundry levels can be efficiently');

tz_def('GRAINMILL', 'Molino');
tz_def('CURRENT_CROP_BONUS', 'Bonus actual de cereal:');
tz_def('CROP_BONUS_LEVEL', 'Bonus de cereal en el nivel');
tz_def('GRAINMILL_DESC', 'Grain grinds into flour here. The Grain Mill boosts food production in the village. At Level 1, it increases food production by 5%, and every time you upgrade it, the production is increased by 5% more, for a total of 25% after 5 levels.<br>Use in conjunction with the Bakery for an overall crop production increase of up to 50%.<br>The bonus from the Grain Mill and all buildings providing resource bonuses only apply to the village in which the building is built.<br>Note that the Grain Mill bonus does not apply to other bonus effects such as Oasis income or the 10% PLUS bonus.<br>There are also villages consisting of 9 or 15 crop fields. The more fields in a village, more the Grain Mill levels can be efficiently');

tz_def('BAKERY', 'Panadería');
tz_def('BAKERY_DESC', 'Bread bakes from flour here. The Bakery boosts food production in the village. At Level 1, it increases food production by 5%, and every time you upgrade it, the production is increased by 5% more, for a total of 25% after 5 levels.<br>When used in conjunction with the Grain Mill it can increase crop production by up to 50%.<br>The bonus from the Bakery and all buildings providing resource bonuses only apply to the village in which the building is built.<br>Note that the Bakery bonus does not apply to other bonus effects such as Oasis income or the 10% PLUS bonus.<br>There are also villages consisting of 9 or 15 crop fields. The more fields in a village, more the Bakery levels can be efficiently');

tz_def('WAREHOUSE', 'Almacén');
tz_def('CURRENT_CAPACITY', 'Capacidad actual:');
tz_def('CAPACITY_LEVEL', 'Capacidad en el nivel');
tz_def('RESOURCE_UNITS', 'Unidades de recursos');
tz_def('WAREHOUSE_DESC', 'The resources lumber, clay and iron are stored in the warehouse. By increasing its level, you increase your warehouse`s capacity. Can be built multiple times, once one is built to max level');

tz_def('GRANARY', 'Granero');
tz_def('CROP_UNITS', 'Unidades de cereal');
tz_def('GRANARY_DESC', 'The crop produced on your farms is stored in the granary. By increasing its level, you increase the granary`s capacity. Can be built multiple times, once one is built to max level');

tz_def('BLACKSMITH', 'Herrería');
tz_def('ACTION', 'Acción');
tz_def('UPGRADE', 'Mejorar');
tz_def('UPGRADE_IN_PROGRESS', 'Mejora en<br>progreso');
tz_def('UPGRADE_BLACKSMITH', 'Mejorar<br>herrería');
tz_def('UPGRADES_COMMENCE_BLACKSMITH', 'Las mejoras pueden comenzar cuando la herrería esté terminada.');
tz_def('MAXIMUM_LEVEL', 'Nivel<br>máximo');
tz_def('EXPAND_WAREHOUSE', 'Ampliar<br>almacén');
tz_def('EXPAND_GRANARY', 'Ampliar<br>granero');
tz_def('ENOUGH_RESOURCES', 'Recursos suficientes');
tz_def('CROP_NEGATIVE ', 'Crop production is negative so you will never reach the required resources');
tz_def('TOO_FEW_RESOURCES', 'Muy pocos<br>recursos');
tz_def('UPGRADING', 'Mejorando');
tz_def('DURATION', 'Duración');
tz_def('COMPLETE', 'Completo');
tz_def('BLACKSMITH_DESC', 'The weapons of your warriors are enhanced in the blacksmith`s melting furnaces. By increasing its level, you can order the fabrication of even better weapons');

tz_def('ARMOURY', 'Armería');
tz_def('UPGRADE_ARMOURY', 'Mejorar<br>Armería');
tz_def('UPGRADES_COMMENCE_ARMOURY', 'Las mejoras pueden comenzar cuando la armería esté terminada.');
tz_def('ARMOURY_DESC', 'The armor of your warriors are enhanced in the armoury`s melting furnaces. By increasing its level, you can order the fabrication of even better armor');

tz_def('TOURNAMENTSQUARE', 'Plaza de torneos');
tz_def('CURRENT_SPEED', 'Bonus de velocidad actual:');
tz_def('SPEED_LEVEL', 'Bonus de velocidad en el nivel');
tz_def('TOURNAMENTSQUARE_DESC', 'Your troops can increase their stamina at the Tournament Square. The further the building is upgraded, the faster your troops are beyond a minimum distance of '.TS_THRESHOLD.' squares');

tz_def('MAINBUILDING', 'Edificio principal');
tz_def('CURRENT_CONSTRUCTION_TIME', 'Tiempo de construcción actual:');
tz_def('CONSTRUCTION_TIME_LEVEL', 'Tiempo de construcción en el nivel');
tz_def('DEMOLITION_BUILDING', 'Demolition of the building:</h2><p>If you no longer need a building, you can order the demolition of the building.</p>');
tz_def('DEMOLISH', 'Demoler');
tz_def('DEMOLITION_OF', 'Demolición de ');
tz_def('MAINBUILDING_DESC', 'The village`s master builders live in the main building. The higher its level the faster your master builders complete the construction of new buildings.');

tz_def('RALLYPOINT', 'Punto de reunión');
tz_def('RALLYPOINT_COMMENCE', 'Troops movement will be displayed when the '.RALLYPOINT.' is completed');
tz_def('OVERVIEW', 'Resumen');
tz_def('REINFORCEMENT', 'Refuerzo');
tz_def('EVASION_SETTINGS', 'configuración de evasión');
tz_def('SEND_TROOPS_AWAY_MAX', 'Enviar tropas lejos un máximo de');
tz_def('TIMES', 'veces');
tz_def('PER_EVASION', 'por evasión');
tz_def('RALLYPOINT_DESC', 'Your village`s troops gather here. From here, you can send them out to conquer, raid or reinforce other villages.<br>If there are less attacking units than the level of the rally point, you can see the type of unit attacking.');
tz_def('COMBAT_SIMULATOR', 'Simulador de combate');

tz_def('MARKETPLACE', 'Mercado');
tz_def('MERCHANT', 'Mercaderes');
tz_def('OR_', 'o');
tz_def('GO', 'ir');
tz_def('UNITS_OF_RESOURCE', 'unidades de recurso');
tz_def('MERCHANT_CARRY', 'Cada mercader puede transportar');
tz_def('MERCHANT_COMING', 'Mercaderes que llegan');
tz_def('TRANSPORT_FROM', 'Transporte de');
tz_def('ARRIVAL_IN', 'Llegada en');
tz_def('NO_COORDINATES_SELECTED', 'No se seleccionaron coordenadas');
tz_def('CANNOT_SEND_RESOURCES', 'No puedes enviar recursos a la misma aldea');
tz_def('BANNED_CANNOT_SEND_RESOURCES', 'El jugador está baneado. No puedes enviarle recursos');
tz_def('RESOURCES_NO_SELECTED', 'Recursos no seleccionados');
tz_def('ENTER_COORDINATES', 'Introduce coordenadas o nombre de aldea');
tz_def('TOO_FEW_MERCHANTS', 'Muy pocos mercaderes');
tz_def('OWN_MERCHANTS_ONWAY', 'Mercaderes propios en camino');
tz_def('MERCHANTS_RETURNING', 'Mercaderes que regresan');
tz_def('TRANSPORT_TO', 'Transporte a');
tz_def('I_AN_SEARCHING', 'Estoy buscando');
tz_def('I_AN_OFFERING', 'Estoy ofreciendo');
tz_def('OFFERS_MARKETPLACE', 'Ofertas en el mercado');
tz_def('NO_AVAILABLE_OFFERS', 'No hay ofertas en el mercado');
tz_def('OFFERED_TO_ME', 'Ofrecido<br>a mí');
tz_def('WANTED_TO_ME', 'Pedido<br>de mí');
tz_def('NOT_ENOUGH_MERCHANTS', 'No hay suficientes mercaderes');
tz_def('ACCEP_OFFER', 'Aceptar oferta');
tz_def('NO_AVALIBLE_OFFERS', 'No hay ofertas disponibles en el mercado');
tz_def('SEARCHING', 'Buscando');
tz_def('OFFERING', 'Ofreciendo');
tz_def('MAX_TIME_TRANSPORT', 'tiempo máx. de transporte');
tz_def('OWN_ALLIANCE_ONLY', 'solo alianza propia');
tz_def('INVALID_OFFER', 'Oferta no válida');
tz_def('INVALID_MERCHANTS_REPETITION', 'Tasa de repetición de mercaderes no válida');
tz_def('USER_ON_VACATION', 'El jugador está en modo vacaciones');
tz_def('VACATION_MODE', 'Modo vacaciones');
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
tz_def('NOT_ENOUGH_RESOURCES', 'No hay suficientes recursos');
tz_def('OFFER', 'Oferta');
tz_def('SEARCH', 'Buscar');
tz_def('OWN_OFFERS', 'Ofertas propias');
tz_def('ALL', 'Todos');
tz_def('NPC_TRADE', 'Comercio NPC');
tz_def('SUM', 'Suma');
tz_def('REST', 'Resto');
tz_def('TRADE_RESOURCES', 'Trade resources at (step 2 of 2');
tz_def('DISTRIBUTE_RESOURCES', 'Distribute resources at (step 1 of 2)');
tz_def('OF', 'de');
tz_def('NPC_COMPLETED', 'NPC completado');
tz_def('BACK_BUILDING', 'Volver al edificio');
tz_def('YOU_CAN_NAT_NPC_WW', 'No puedes usar el comercio NPC en una aldea de la Maravilla del Mundo.');
tz_def('NPC_TRADING', 'Comercio NPC');
tz_def('SEND_RESOURCES', 'Enviar recursos');
tz_def('BUY', 'Comprar');
tz_def('TRADE_ROUTES', 'Rutas comerciales');
tz_def('DESCRIPTION', 'Descripción');
tz_def('G_DESCR', 'Descripción general');
tz_def('TIME_LEFT', 'Tiempo restante');
tz_def('START', 'Inicio');
tz_def('NO_TRADE_ROUTES', 'No hay rutas comerciales activas');
tz_def('TRADE_ROUTE_TO', 'Ruta comercial a');
tz_def('CHECKED', 'marcado');
tz_def('DAYS', 'días');
tz_def('EXTEND', 'Extender');
tz_def('EDIT', 'Editar');
tz_def('EXTEND_TRADE_ROUTES', 'Extend the trade route by <b>7</b> days for');
tz_def('CREATE_TRADE_ROUTES', 'Crear nueva ruta comercial');
tz_def('DELIVERIES', 'Entregas');
tz_def('START_TIME_TRADE', 'Hora de inicio');
tz_def('CREATE_TRADE_ROUTE', 'Crear ruta comercial');
tz_def('TARGET_VILLAGE', 'Aldea objetivo');
tz_def('EDIT_TRADE_ROUTES', 'Editar ruta comercial');
tz_def('TRADE_ROUTES_DESC', 'Trade route allows you to set up routes for your merchant that he will walk every day at a certain hour. <br><br> Standard this holds on for <b>7</b> days, but you can extend it with <b>7</b> days for the cost of');
tz_def('NPC_TRADE_DESC', 'With the NPC merchant you can distribute the resources in your warehouse as you desire. <br><br> The first line shows the current stock. In the second line you can choose another distribution. The third line shows the difference between the old and new stock.');
tz_def('MARKETPLACE_DESC', 'At the marketplace, you can trade resources with other players. The higher its level, the more resources can be transported by your merchants at the same time');

tz_def('EMBASSY', 'Embajada');
tz_def('TAG', 'Etiqueta');
tz_def('TO_THE_ALLIANCE', 'a la alianza');
tz_def('JOIN_ALLIANCE', 'unirse a la alianza');
tz_def('REFUSE', 'rechazar');
tz_def('ACCEPT', 'aceptar');
tz_def('NO_INVITATIONS', 'No hay invitaciones disponibles.');
tz_def('NO_CREATE_ALLIANCE', 'Un jugador baneado no puede crear una alianza.');
tz_def('FOUND_ALLIANCE', 'fundar alianza');
tz_def('EMBASSY_DESC', 'The embassy is a place for diplomats. At level 1 you can join an alliance, and after extending it to level 3 you may even found one yourself.<br>The maximum number of members in an alliance is 60');

tz_def('BARRACKS', 'Cuartel');
tz_def('QUANTITY', 'Cantidad');
tz_def('MAX', 'Máx');
tz_def('TRAINING', 'Entrenamiento');
tz_def('FINISHED', 'Terminado');
tz_def('UNIT_FINISHED', 'La siguiente unidad terminará en');
tz_def('AVAILABLE', 'Disponible');
tz_def('TRAINING_COMMENCE_BARRACKS', 'El entrenamiento puede comenzar cuando el cuartel esté terminado.');
tz_def('BARRACKS_DESC', 'Infantry can be trained in the barracks. The higher its level, the faster the troops are trained');

tz_def('STABLE', 'Establo');
tz_def('AVAILABLE_ACADEMY', 'No hay unidades disponibles. Investiga en la academia');
tz_def('TRAINING_COMMENCE_STABLE', 'El entrenamiento puede comenzar cuando el establo esté terminado.');
tz_def('STABLE_DESC', 'Cavalry can be trained in the stable. The higher its level, the faster the troops are trained');

tz_def('WORKSHOP', 'Taller');
tz_def('TRAINING_COMMENCE_WORKSHOP', 'El entrenamiento puede comenzar cuando el taller esté terminado.');
tz_def('WORKSHOP_DESC', 'Siege engines, like catapults and rams, can be built in the workshop. The higher its level, the faster these units are produced');

tz_def('ACADEMY', 'Academia');
tz_def('RESEARCH_AVAILABLE', 'No hay investigaciones disponibles');
tz_def('RESEARCH_COMMENCE_ACADEMY', 'La investigación puede comenzar cuando la academia esté terminada.');
tz_def('RESEARCH', 'Investigar');
tz_def('EXPAND_WAREHOUSE1', 'Ampliar almacén');
tz_def('EXPAND_GRANARY1', 'Ampliar granero');
tz_def('RESEARCH_IN_PROGRESS', 'Investigación en<br>progreso');
tz_def('RESEARCHING', 'Investigando');
tz_def('PREREQUISITES', 'Requisitos previos');
tz_def('SHOW_MORE', 'mostrar más');
tz_def('HIDE_MORE', 'ocultar más');
tz_def('ACADEMY_DESC', 'New unit types can be researched in the academy. By increasing its level, you can order the research of better units');

tz_def('CRANNY', 'Escondite');
tz_def('CURRENT_HIDDEN_UNITS', 'Unidades ocultas actualmente por recurso:');
tz_def('HIDDEN_UNITS_LEVEL', 'Unidades ocultas por recurso en el nivel');
tz_def('UNITS', 'unidades');
tz_def('CRANNY_DESC', 'The cranny hides some of your resources in case the village gets attacked. These resources cannot get stolen.<br>At level 1 the cranny can hold '.(100*((int)CRANNY_CAPACITY)).' of each resource. The capacity of Gallic crannies is 1.5 times larger.<br>If a Teutonic hero attacks a village, crannies can hide only 80% of their normal capacity');

tz_def('TOWNHALL', 'Ayuntamiento');
tz_def('CELEBRATIONS_COMMENCE_TOWNHALL', 'Las celebraciones pueden comenzar cuando el ayuntamiento esté terminado.');
tz_def('GREAT_CELEBRATIONS', 'Gran celebración');
tz_def('CULTURE_POINTS', 'Puntos de cultura');
tz_def('HOLD', 'celebrar');
tz_def('CELEBRATIONS_IN_PROGRESS', 'Celebración<br>en progreso');
tz_def('CELEBRATIONS', 'Celebraciones');
tz_def('TOWNHALL_DESC', 'In the town hall, you can hold pompous celebrations. Such a celebration increases your culture points.<br>Culture points are necessary to found or conquer new villages. Each building produces culture points and the higher its level, the more culture points it produces');

tz_def('RESIDENCE', 'Residencia');
tz_def('CAPITAL', 'Esta es tu capital');
tz_def('RESIDENCE_TRAIN_DESC', 'In order to found a new village you need a level 10 or 20 residence and 3 settlers. In order to conquer a new village you need a level 10 or 20 residence and a senator, chief or chieftain.');
tz_def('PRODUCTION_POINTS', 'Producción de esta aldea:');
tz_def('PRODUCTION_ALL_POINTS', 'Producción de todas las aldeas:');
tz_def('POINTS_DAY', 'Puntos de cultura por día');
tz_def('VILLAGES_PRODUCED', 'Tus aldeas han producido');
tz_def('POINTS_NEED', 'puntos en total. Para fundar o conquistar una nueva aldea necesitas');
tz_def('POINTS', 'puntos');
tz_def('INHABITANTS', 'Habitantes');
tz_def('COORDINATES', 'Coordenadas');
tz_def('EXPANSION', 'Expansión');
tz_def('TRAIN', 'Entrenar');
tz_def('DATE', 'Fecha');
tz_def('CONQUERED_BY_VILLAGE', 'Aldeas fundadas o conquistadas por esta aldea');
tz_def('NONE_CONQUERED_BY_VILLAGE', 'Ninguna otra aldea ha sido fundada o conquistada por esta aldea todavía.');
tz_def('RESIDENCE_CULTURE_DESC', 'In order to extend your empire you need culture points. These culture points increase in the course of time and do so faster as your building levels increase.');
tz_def('RESIDENCE_LOYALTY_DESC', 'By attacking with senators, chiefs or chieftains a village`s loyalty can be brought down. If it reaches zero, the village joins the realm of the attacker. The loyalty of this village is currently at ');
tz_def('RESIDENCE_DESC', 'The Residence protects the village against enemy conquests. You can build one residence per village. Units that can found a new village or conquer existing villages can be trained here.<br>Additionally, the residence provides an expansion slot at levels 10 and 20 each');

tz_def('PALACE', 'Palacio');
tz_def('PALACE_CONSTRUCTION', 'Palacio en construcción');
tz_def('PALACE_TRAIN_DESC', 'In order to found a new village you need a level 10, 15 or 20 palace and 3 settlers. In order to conquer a new village you need a level 10, 15 or 20 palace and a senator, chief or chieftain.');
tz_def('CHANGE_CAPITAL', 'cambiar capital');
tz_def('SECURITY_CHANGE_CAPITAL', 'Are you sure, that you want to change your capital?<br><b>You can`t undo this!</b><br>For security you must enter your password to confirm:<br>');
tz_def('PALACE_DESC', 'The palace building is unique. You can only build one in your whole realm and you can proclaim that village as your capital. It also protects the village against enemy conquests. Units that can found a new village or conquer existing villages can be trained here.<br>Additionally, the palace provides an expansion slot at levels 10, 15 and 20 each');

tz_def('TREASURY', 'Tesorería');
tz_def('TREASURY_COMMENCE', 'Los artefactos se pueden ver cuando la tesorería esté terminada.');
tz_def('ARTEFACTS_AREA', 'Artefactos en tu área');
tz_def('NO_ARTEFACTS_AREA', 'No hay artefactos en tu área.');
tz_def('OWN_ARTEFACTS', 'Artefactos propios');
tz_def('CONQUERED', 'Conquistado');
tz_def('DISTANCE', 'Distancia');
tz_def('EFFECT', 'Efecto');
tz_def('ACCOUNT', 'Cuenta');
tz_def('SMALL_ARTEFACTS', 'Artefactos pequeños');
tz_def('LARGE_ARTEFACTS', 'Artefactos grandes');
tz_def('NO_ARTEFACTS', 'No hay artefactos.');
tz_def('ANY_ARTEFACTS', 'No posees ningún artefacto.');
tz_def('OWNER', 'Propietario');
tz_def('AREA_EFFECT', 'Área de efecto');
tz_def('VILLAGE_EFFECT', 'Efecto de aldea');
tz_def('ACCOUNT_EFFECT', 'Efecto de cuenta');
tz_def('UNIQUE_EFFECT', 'Efecto único');
tz_def('REQUIRED_LEVEL', 'Nivel requerido');
tz_def('TIME_CONQUER', 'Hora de conquista');
tz_def('TIME_ACTIVATION', 'Hora de activación');
tz_def('NEXT_EFFECT', ' Siguiente efecto');
tz_def('FORMER_OWNER', 'Propietario(s) anterior(es)');
tz_def('BUILDING_STRONGER', 'Edificio más fuerte con');
tz_def('BUILDING_WEAKER', 'Edificio más débil con');
tz_def('TROOPS_FASTER', 'Hace las tropas más rápidas con');
tz_def('TROOPS_SLOWEST', 'Hace las tropas más lentas con');
tz_def('SPIES_INCREASE', 'Los espías aumentan la habilidad con');
tz_def('SPIES_DECRESE', 'Los espías disminuyen la habilidad con');
tz_def('CONSUME_LESS', 'Todas las tropas consumen menos con');
tz_def('CONSUME_HIGH', 'Todas las tropas consumen más con');
tz_def('TROOPS_MAKE_FASTER', 'Las tropas se hacen más rápido con');
tz_def('TROOPS_MAKE_SLOWEST', 'Las tropas se hacen más lento con');
tz_def('YOU_CONSTRUCT', 'Puedes construir ');
tz_def('CRANNY_INCREASED', 'La capacidad del escondite se aumenta en');
tz_def('CRANNY_DECRESE', 'La capacidad del escondite se reduce en');
tz_def('WW_BUILDING_PLAN', 'Puedes construir la Maravilla del Mundo');
tz_def('NO_WW', 'No hay Maravillas del Mundo');
tz_def('NO_PREVIOUS_OWNERS', 'No hay propietarios anteriores.');
tz_def('TREASURY_DESC', 'The riches of your empire are kept in the treasury. A treasury can only store one artefact at a time.<br>You need a treasury at level 10 for a small artefact, or level 20 for a great one');

tz_def('TRADEOFFICE', 'Oficina comercial');
tz_def('CURRENT_MERCHANT', 'Carga actual del mercader:');
tz_def('MERCHANT_LEVEL', 'Carga del mercader en el nivel');
tz_def('TRADEOFFICE_DESC', 'In the trade office, the merchants carts get improved and equipped with more powerful horses. The higher its level, the more your merchants are able to carry');

tz_def('GREATBARRACKS', 'Gran cuartel');
tz_def('TRAINING_COMMENCE_GREATBARRACKS', 'El entrenamiento puede comenzar cuando el gran cuartel esté terminado.');
tz_def('GREATBARRACKS_DESC', 'The Great Barracks allows you to build a second Barracks in the same village, but the troops cost 3 times the original amount.<br>Combined with the regular Barracks, you can train your troops twice as fast in one village');

tz_def('GREATSTABLE', 'Gran establo');
tz_def('TRAINING_COMMENCE_GREATSTABLE', 'El entrenamiento puede comenzar cuando el gran establo esté terminado.');
tz_def('GREATSTABLE_DESC', 'The Great Stable allows you to build a second Stable in the same village, but the troops cost 3 times the original amount.<br>Combined with the regular Stable, you can train your troops twice as fast in one village');

tz_def('CITYWALL', 'Muralla de la ciudad');
tz_def('DEFENCE_NOW', 'Bonus de defensa ahora:');
tz_def('DEFENCE_LEVEL', 'Bonus de defensa en el nivel');
tz_def('CITYWALL_DESC', 'Provides a defense bonus for your troops (((1.03 ^ level) * 100)% + 10) defensive points per level to the basic defensive value for a village. The higher level Wall will give your troops a higher defence bonus.<br>Tribe-specific: Romans only');

tz_def('EARTHWALL', 'Muralla de tierra');
tz_def('EARTHWALL_DESC', 'Provides a defense bonus for your troops (((1.02 ^ level) * 100)% + 6) defensive points per level to the basic defensive value for a village. A higher level Earth Wall will give your troops a higher defence bonus.<br>Tribe-specific: Teutons only');

tz_def('PALISADE', 'Empalizada');
tz_def('PALISADE_DESC', 'Provides a defense bonus for your troops (((1.025 ^ level) * 100)% + 8) defensive points per level to the basic defensive value for a village. A higher level Palisade will give your troops a higher defence bonus.<br>Tribe-specific: Gauls only');

tz_def('STONEMASON', 'Cantero');
tz_def('CURRENT_STABILITY', 'Bonus de estabilidad actual:');
tz_def('STABILITY_LEVEL', 'Bonus de estabilidad en el nivel');
tz_def('STONEMASON_DESC', 'The Stonemason is an expert it cutting stone. The higher the level of the Stonemason`s Lodge, the greater the stability of your village`s buildings. For each level this building will increase durability by 10% for a maximum of 200% durability for your buildings.<br>This building can only be built in an accounts Capital');

tz_def('BREWERY', 'Cervecería');
tz_def('CURRENT_BONUS', 'Bonus actual:');
tz_def('WATERWORKS_HINT', '(Boost by Waterworks)');
tz_def('WATERWORKS_AFFECTED', 'annexed oases benefit from this bonus.');
tz_def('OASIS_EFFECTIVE_BONUS', 'Effective oasis bonus:');
tz_def('BONUS_LEVEL', 'Bonus en el nivel');
tz_def('BREWERY_DESC', 'Tasty mead is brewed here.Drinks make your soldiers braver and stronger when attacking others (1% per Brewery level). Unfortunately, the persuasive power of leaders is reduced by 50% and catapults can only make random hits. Can only be built in the capital, but affects all your villages. The mead-festivals always last 72 hours.<br>Tribe-specific: Teutons only');
tz_def('MEAD_FESTIVAL', 'Festival de hidromiel');
tz_def('MEAD_FESTIVAL_IN_PROGRESS', 'Festival de hidromiel<br>en progreso');
tz_def('MEAD_FESTIVAL_COMMENCE_BREWERY', 'El Festival de hidromiel se puede iniciar una vez que la cervecería esté terminada.');

tz_def('TRAPPER', 'Trampero');
tz_def('CURRENT_TRAPS', 'Trampas máximas actuales para entrenar:');
tz_def('TRAPS_LEVEL', 'Trampas máximas para entrenar en el nivel');
tz_def('TRAPS', 'Trampas');
tz_def('TRAP', 'Trampa');
tz_def('CURRENT_HAVE', 'Actualmente tienes');
tz_def('WHICH_OCCUPIED', 'de las cuales están ocupadas.');
tz_def('TRAINING_COMMENCE_TRAPPER', 'El entrenamiento puede comenzar cuando el trampero esté terminado.');
tz_def('TRAPPER_DESC', 'The trapper protects your village with well hidden traps. This means that unwary enemies can be imprisoned and won`t be able to harm your village any more.<br>Troops cannot be freed with a raid. If the owner of the traps release the captives all of the traps will be repaired automatically.<br>Tribe-specific: Gauls only');

tz_def("HEROSMANSION", "Hero's Mansion");
tz_def('HERO_READY', 'El héroe estará listo en ');
tz_def('NAME_CHANGED', 'El nombre del héroe ha sido cambiado');
tz_def('NOT_UNITS', 'Unidades no disponibles');
tz_def('NOT', 'No ');
tz_def('TRAIN_HERO', 'Entrenar nuevo héroe');
tz_def('REVIVE', 'Revivir');
tz_def('OASES', 'Oasis');
tz_def('DELETE', 'Eliminar');
tz_def('RESOURCES', 'Recursos');
tz_def('OFFENCE', 'Ofensiva');
tz_def('DEFENCE', 'Defensa');
tz_def('OFF_BONUS', 'Bonus ofensivo');
tz_def('DEF_BONUS', 'Bonus defensivo');
tz_def('REGENERATION', 'Regeneración');
tz_def('DAY', 'Día');
tz_def('EXPERIENCE', 'Experiencia');
tz_def('YOU_CAN', 'Puedes ');
tz_def('RESET', 'reiniciar');
tz_def('YOUR_POINT_UNTIL', ' tus puntos hasta que estés en el nivel ');
tz_def('OR_LOWER', ' o inferior!');
tz_def('YOUR_HERO_HAS', 'Tu héroe tiene ');
tz_def('OF_HIT_POINTS', 'de sus puntos de vida');
tz_def('ERROR_NAME_SHORT', 'Error: nombre demasiado corto');
tz_def('HEROSMANSION_DESC', 'The hero`s mansion is the home of your glorious hero.<br>At building levels 10, 15 and 20, you can use your hero to annex an unoccupied oasis to your village, one per each of these levels respectively. Depending on the oasis, you will get a production increase for a certain type of resource (or even two resources, from some oases)');

tz_def('GREATWAREHOUSE', 'Gran almacén');
tz_def('GREATWAREHOUSE_DESC', 'The great warehouse has 3 times the capacity of a normal warehouse.<br>This building can only be built in wonder of the world villages or with a special Natarian artefact');

tz_def('GREATGRANARY', 'Gran granero');
tz_def('GREATGRANARY_DESC', 'The great granary has 3 times the capacity of a normal granary.<br>This building can only be built in wonder of the world villages or with a special Natarian artefact');

tz_def('WONDER', 'Maravilla del Mundo');
tz_def('WORLD_WONDER', 'Maravilla del Mundo');
tz_def('WONDER_DESC', 'A Wonder of the World (also known as WW) is as astonishing as it sounds. Every level costs a lot of resources. It is nearly impossible for a single player to build a WW on their own. The reason is that you not only need a lot of resources, but also the troops to protect your precious building.<br>To build WW you need an Ancient Construction Plan. You can get this by attacking a Natar Village with your hero. You need to have an empty level 10 treasury and your hero must survive. With those plan and an extremely high level of resources, you can start the world wonder.<br>Once it gets to level 50, you will need someone else in your alliance to have a second construction plan active. You cannot do it all by yourself.<br>Finishing a WW lvl 100, you will win the Travian server and its the end of a game world.<br>Once you finish, a message will come up telling who won and statistics. You can no longer build, but you can message people until the server restarts');
tz_def('WORLD_WONDER_CHANGE_NAME', 'Necesitas tener la Maravilla del Mundo de nivel 1 para poder cambiar su nombre');
tz_def('WORLD_WONDER_NAME', 'Nombre de la Maravilla del Mundo');
tz_def('WORLD_WONDER_NOTCHANGE_NAME', 'No puedes cambiar el nombre de la Maravilla del Mundo después del nivel 10');
tz_def('WORLD_WONDER_NAME_CHANGED', 'Nombre cambiado');

tz_def('HORSEDRINKING', 'Abrevadero de caballos');
tz_def('HORSEDRINKING_DESC', 'Decreases the training time and the upkeep of cavalry. It can also be built in Roman Wonder of the World villages.<br>Speeds up the training time of cavalry units by 1% per level and lowers the crop consumption of some units depending on its level.<br>Tribe-specific: Romans only');

tz_def('GREATWORKSHOP', 'Gran taller');
tz_def('TRAINING_COMMENCE_GREATWORKSHOP', 'El entrenamiento puede comenzar cuando el gran taller esté terminado.');
tz_def('GREATWORKSHOP_DESC', 'The Great Workshop allows you to build a second Workshop in the same village, but catapults and rams cost 3 times the original amount.<br>Combined with the regular Workshop, you can train your troops twice as fast in one village');

tz_def('STONEWALL', 'Muralla de piedra');
tz_def('STONEWALL_DESC', 'The Stone Wall protects your village against the attacks of other players. Its solid construction grants a high defence bonus.<br>Tribe-specific: Egyptians only');
tz_def('MAKESHIFTWALL', 'Muralla improvisada');
tz_def('MAKESHIFTWALL_DESC', 'The Makeshift Wall offers basic protection for your village. It is cheap and quick to build, but grants only a small defence bonus.<br>Tribe-specific: Huns only');
tz_def('COMMANDCENTER', 'Centro de mando');
tz_def('COMMANDCENTER_TRAIN_DESC', 'You need at least level 10 to train settlers and chiefs in the Command Center.');
tz_def('COMMANDCENTER_CULTURE_DESC', 'Culture points determine how many villages you may found or conquer.');
tz_def('COMMANDCENTER_LOYALTY_DESC', 'The Command Center protects the village against enemy chiefs. Current loyalty:');
tz_def('COMMANDCENTER_DESC', 'The Command Center is the seat of power of a Hun village. It allows you to train settlers and chiefs and to control your expansion without needing a Residence or Palace.<br>Tribe-specific: Huns only');
tz_def('WATERWORKS', 'Obras hidráulicas');
tz_def('WATERWORKS_DESC', 'The Waterworks increases the bonus given by the oases annexed to this village by 5% per level.<br>Tribe-specific: Egyptians only');
tz_def('HOSPITAL', 'Hospital');
tz_def('HOSPITAL_DESC', 'The Hospital takes care of your wounded troops. A part of the units lost while defending or attacking can be healed here instead of being lost forever. Higher levels reduce the healing time.');
tz_def('DEFENSIVEWALL', 'Muralla defensiva');
tz_def('DEFENSIVEWALL_DESC', 'The Defensive Wall protects your village against the attacks of other players. Built in the tradition of the great Spartan fortifications, it grants a strong defence bonus.<br>Tribe-specific: Spartans only');
tz_def('BIGHOSPITAL', 'Gran hospital');
tz_def('BIGHOSPITAL_DESC', 'The Big Hospital is a larger version of the Hospital, allowing even more of your wounded troops to be healed after battle. Higher levels reduce the healing time.<br>Tribe-specific: Spartans and Vikings only');
tz_def('BARRICADE', 'Barricada');
tz_def('HEALING_TIME_NOW', 'Tiempo de curación ahora');
tz_def('WOUNDED_TROOPS', 'Tropas heridas');
tz_def('NO_WOUNDED', 'No hay tropas heridas en el hospital.');
tz_def('HEAL_BUTTON', 'Curar');
tz_def('HEAL_COST_HINT', 'La curación cuesta el 50% del coste de entrenamiento de la unidad.');
tz_def('HEALING_IN_PROGRESS', 'Curación en progreso');
tz_def('MANUAL_UDESC_51', "The Hun Warrior is the backbone of the Hun infantry. Cheap and quick to train, he is a decent all-round soldier for early raids and basic defence.");
tz_def('MANUAL_UDESC_52', "The Scout Rider spies out enemy villages at great speed. He can only be seen by other scouts and carries no weapons for battle.");
tz_def('MANUAL_UDESC_53', "The Horse Archer strikes from the saddle with deadly arrows. A fast raider with a good balance between attack power and carrying capacity.");
tz_def('MANUAL_UDESC_54', "The Steppe Rider is a swift skirmisher of the plains. His speed makes him ideal for quick raids on undefended villages.");
tz_def('MANUAL_UDESC_55', "The Hun Lancer charges with a heavy lance. A powerful offensive cavalry unit that also holds his ground against enemy horsemen.");
tz_def('MANUAL_UDESC_56', "The Elite Rider is the pride of the Hun horde. Extremely strong in attack, he crushes everything in his path, but his training is expensive.");
tz_def('MANUAL_UDESC_57', "The Ram is a heavy war machine that batters enemy walls. Protect it well, as it is slow and defenceless on its own.");
tz_def('MANUAL_UDESC_58', "The Catapult hurls stones over great distances to destroy enemy buildings and fields. It must be well protected by other troops.");
tz_def('MANUAL_UDESC_59', "The Tribal Chief lowers the loyalty of enemy villages with his fearsome presence until they join the Hun horde.");
tz_def('MANUAL_UDESC_60', "Settlers are brave subjects who move out to found a new village for the Huns. Three of them are needed, with supplies.");
tz_def('MANUAL_UDESC_61', "The Armed Slave is cheap and quick to train. Individually weak, but in great numbers he can overwhelm defences at little cost.");
tz_def('MANUAL_UDESC_62', "The Egyptian Fighter is a solid infantry soldier of the Pharaoh, useful both in attack and in the defence of the realm.");
tz_def('MANUAL_UDESC_63', "The Temple Guardian protects the holy places of Egypt. An excellent defensive unit against enemy infantry.");
tz_def('MANUAL_UDESC_64', "The Horse Scout rides ahead of the army to spy out enemy villages. Only enemy scouts can stop or see him.");
tz_def('MANUAL_UDESC_65', "The Chariot races across the battlefield, running down infantry. A strong defensive cavalry unit of the Egyptian army.");
tz_def('MANUAL_UDESC_66', "The Royal Chariot carries the elite of the Egyptian army. Devastating in attack and a symbol of the Pharaoh's power.");
tz_def('MANUAL_UDESC_67', "The Ram is a heavy war machine that batters enemy walls. Protect it well, as it is slow and defenceless on its own.");
tz_def('MANUAL_UDESC_68', "The Catapult hurls stones over great distances to destroy enemy buildings and fields. It must be well protected by other troops.");
tz_def('MANUAL_UDESC_69', "The Nomarch persuades enemy villages with gifts and speeches, lowering their loyalty until they join the Egyptian empire.");
tz_def('MANUAL_UDESC_70', "Settlers are brave subjects who move out to found a new village for Egypt. Three of them are needed, with supplies.");
tz_def('MANUAL_UDESC_71', "The Spartan Hoplite fights in the famous phalanx. An outstanding all-round infantry soldier, strong in attack and defence alike.");
tz_def('MANUAL_UDESC_72', "The Agoge Warrior was raised for war since childhood. A cheap, sturdy defender of the Spartan homeland.");
tz_def('MANUAL_UDESC_73', "The Homoioi are the equals, full citizens of Sparta. Heavy infantry with tremendous attacking power.");
tz_def('MANUAL_UDESC_74', "The Perioikoi Scout observes enemy movements for Sparta. Only enemy scouts can see or stop him.");
tz_def('MANUAL_UDESC_75', "The Spartan Rider patrols the borders of Lacedaemon. A fast cavalry unit with balanced combat values.");
tz_def('MANUAL_UDESC_76', "The Hippeis are the royal guard of the Spartan kings. Elite cavalry that excels in attack.");
tz_def('MANUAL_UDESC_77', "The Ram is a heavy war machine that batters enemy walls. Protect it well, as it is slow and defenceless on its own.");
tz_def('MANUAL_UDESC_78', "The Catapult hurls stones over great distances to destroy enemy buildings and fields. It must be well protected by other troops.");
tz_def('MANUAL_UDESC_79', "The Ephor speaks with the authority of Sparta, lowering the loyalty of enemy villages until they submit.");
tz_def('MANUAL_UDESC_80', "Settlers are brave subjects who move out to found a new village for Sparta. Three of them are needed, with supplies.");
tz_def('MANUAL_UDESC_81', "The Viking Raider lives for plunder. Quick to train and always ready to sail out for the next raid.");
tz_def('MANUAL_UDESC_82', "The Viking Scout slips unseen into enemy lands to gather information. Only enemy scouts can catch him.");
tz_def('MANUAL_UDESC_83', "The Axeman swings his great axe with brutal force. A strong offensive infantry unit of the North.");
tz_def('MANUAL_UDESC_84', "The Berserker fights in a battle frenzy, fearing neither pain nor death. Devastating in attack, weak in defence.");
tz_def('MANUAL_UDESC_85', "The Viking Rider combines northern toughness with the speed of a horse. A versatile cavalry unit.");
tz_def('MANUAL_UDESC_86', "The Huscarl is the sworn bodyguard of the Jarl. Elite heavy cavalry, feared across all the seas.");
tz_def('MANUAL_UDESC_87', "The Ram is a heavy war machine that batters enemy walls. Protect it well, as it is slow and defenceless on its own.");
tz_def('MANUAL_UDESC_88', "The Catapult hurls stones over great distances to destroy enemy buildings and fields. It must be well protected by other troops.");
tz_def('MANUAL_UDESC_89', "The Jarl bends enemy villages to his will, lowering their loyalty until they swear allegiance to the North.");
tz_def('MANUAL_UDESC_90', "Settlers are brave subjects who move out to found a new village for the Vikings. Three of them are needed, with supplies.");
tz_def('HEALING_TIME_LEVEL', 'Tiempo de curación en el nivel');
tz_def('BARRICADE_DESC', 'The Barricade protects your village against the attacks of other players. Its layered wooden construction grants a solid defence bonus.<br>Tribe-specific: Vikings only');

tz_def('BUILDING_MAX_LEVEL_UNDER', 'Nivel máximo del edificio en construcción');
tz_def('BUILDING_BEING_DEMOLISHED', 'Edificio actualmente siendo demolido');
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
tz_def('CURRENT_EMAIL', 'Current email');
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
tz_def('TZ_LINK_GENERATOR', 'Game link generator');
tz_def('TZ_LINK_GENERATOR_DESC', 'Builds a link by building type instead of slot location, so it works in every village regardless of where that building is built there. Copy the result below into the Link target field.');
tz_def('TZ_TAB_OPTIONAL', 'Tab (optional)');
tz_def('TZ_GENERATED_LINK', 'Generated link');
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
tz_def('TZ_OVERVIEW', 'Overview');
tz_def('TZ_FORUM', 'Forum');
tz_def('TZ_CHAT', 'Chat');
tz_def('TZ_NEWS', 'News');
tz_def('TZ_OPTIONS', 'Options');
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
tz_def('TZ_DEBUG_OFF', 'Debug log OFF');
tz_def('TZ_DEBUG_ON', 'Debug log ON');
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
tz_def('TZ_THE_LARGEST_HUNS', 'The largest Huns');
tz_def('TZ_THE_LARGEST_EGYPTIANS', 'The largest Egyptians');
tz_def('TZ_THE_LARGEST_SPARTANS', 'The largest Spartans');
tz_def('TZ_THE_LARGEST_VIKINGS', 'The largest Vikings');
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
tz_def('TZ_WILL_SPAWN_IN_ARTIFACTS', 'Artifacts');
tz_def('TZ_WILL_SPAWN_IN_WW', 'WW villages');
tz_def('TZ_WILL_SPAWN_IN_PLAN', 'WW building plans');
tz_def('TZ_WOODCUTTER_INSTANTLY_COMPLETED', 'Woodcutter instantly completed.');
tz_def('TZ_WORLD_STATS', 'World Stats');
tz_def('TZ_WRITE_THE_CODE', 'Write the code');
tz_def('TZ_WRONG_DOMAIN_THERE_IS_E_G_NO_AOL_D', 'Wrong domain: There is e.g. no @aol.de, only @aol.com');
tz_def('TZ_YOUR_ACCOUNT_HAS_BEEN_SUCCESSFULLY', 'Your account has been successfully activated.');
tz_def('TZ_YOUR_VILLAGE_AND_YOUR_NEIGHBOURS', 'Your village and your neighbours');
tz_def('TZ_YOU_CAN_UNDO_THE_REGISTRATION_AND', 'You can undo the registration and re-register with a');
tz_def('TZ_YOU_CAN_USE_THIS_GOLD_FOR_PLUS_OR', '. You can use this gold for Plus or any gold advantage.');

// ===== Server Milestones (NEW_FUNCTIONS_MILESTONES) =====
tz_def('TZ_SERVER_MILESTONES', 'Server Milestones');
tz_def('TZ_MILESTONE_NOT_YET', 'Not yet achieved');
tz_def('TZ_MILESTONE_SECOND_VILLAGE', 'First to Settle a 2nd Village');
tz_def('TZ_MILESTONE_POPULATION_1000', 'First to reach 1,000 Population');
tz_def('TZ_MILESTONE_FIRST_ARTIFACT', 'First to Capture an Artefact');
tz_def('TZ_MILESTONE_FIRST_WW', 'First to Conquer a Wonder of the World');
tz_def('TZ_MILESTONE_FIRST_WW_PLAN', 'First to Conquer a WW Building Plan');
tz_def('TZ_MILESTONE_FIRST_ALLIANCE', 'First Alliance Founded');
tz_def('TZ_MILESTONE_FIRST_PVP_CONQUEST', 'First Village Conquered from a Player');
tz_def('TZ_MILESTONE_FIVE_VILLAGES', 'First to Found 5 Villages');
tz_def('TZ_MILESTONE_FOUNDED_BY', 'Founded by');

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

// ===== manual: new-features pages (PR-C) =====
tz_def('MANUAL_NF_ENABLED', "Enabled");
tz_def('MANUAL_NF_DISABLED', "Disabled");
tz_def('MANUAL_NF_T_11', "Display oasis in profile");
tz_def('MANUAL_NF_T_12', "Alliance invitation message");
tz_def('MANUAL_NF_T_13', "New Alliance & Embassy Mechanics");
tz_def('MANUAL_NF_T_14', "New forum post message");
tz_def('MANUAL_NF_T_15', "Tribes images in profile");
tz_def('MANUAL_NF_T_16', "MHs images in profile");
tz_def('MANUAL_NF_T_17', "Display artifact in profile");
tz_def('MANUAL_NF_T_18', "Display WoW in profile");
tz_def('MANUAL_NF_T_20', "Catapult targets");
tz_def('MANUAL_NF_T_21', "Manual on Nature and Natars");
tz_def('MANUAL_NF_T_22', "Direct links placement");
tz_def('MANUAL_NF_T_23', "Medal Veteran Player");
tz_def('MANUAL_NF_T_24', "Medal Veteran Player 5a");
tz_def('MANUAL_NF_T_25', "Medal Veteran Player 10a");
tz_def('MANUAL_NF_T_26', "Special Medals");
tz_def('MANUAL_NF_D_11', "If there is a captured oasis in the village, it will be displayed in the player's profile in front of the corresponding village with the appropriate type of resource and a bonus for production. This function was presented in Travian T4.");
tz_def('MANUAL_NF_D_12', "If someone from the players will be sent an invitation to join the alliance, then the player will be notified an in-game message.");
tz_def('MANUAL_NF_D_13', "<h2>Introduction</h2><br> The Embassy and Alliance mechanics always felt a bit like cheating to me. Especially with the Embassy building having a given \"capacity\", which means only 3/6/9/12/... and up to 60 members could be in the alliance, depending on the level of your Embassy. <br><br> Now, this is all cool and dandy but once you had an Embassy on level 20 and you reached 60 alliance members, you were free to demolish the building completely and nothing ever happened. You wouldn't be able to switch alliances but that was about it. The capacity property for Embassy no longer applied. If it did, you would not be able to demolish it even a single level down to 19 - because with full 60 members, the Embassy wouldn't be able to hold them at level 19 anymore. <br><br> So I decided to pepper the game a little, making Embassy a somewhat more visible chess-piece on the board. <br><br> <h2>New Mechanics</h2><br> In order to make things interesting, I've developed a whole new set of rules for demolition and battle-destruction of the Embassy. It's a little bit complicated but actually mirrors the \"capacity\" property of the alliance perfectly. <br><br> The main change is that people can't really demolish their Embassies without a side-effect of being punished once it goes too low. For an alliance member, this would mean their Embassy must never go below level 1. If it does, they are warned and subsequently removed from their alliance. <br><br> Similarly, for alliance founders, this actually presents even more of a challenge, since they are the ones who need to keep their alliance running smoothly. For them, demolition of an Embassy will not be allowed below a level that can still hold the current number of alliance members. <br><br> Now, in the peculiar situation when other players/alliances actually attack the founder's village where their Embassy stands, and subsequently target that Embassy with their catapults and rams - that situation can bring a whole lot of trouble. If there are no other Embassies in other founder's villages on a sufficient level to hold all the alliance members, the alliance could be dispersed. The only exception would be if any other member of the alliance had a sufficiently developed Embassy - in which case that member will be auto-elected to a leadership position and will save the alliance. If no such player is found, the alliance will be completely dispersed. <br><br> <h2>Detailed information</h2><br> For a more graphical and in-depth information about how this new system works, you can visit this <a href=\"https://docs.google.com/presentation/d/1KN1qVAlxVj7aAN6F9QkRai1oliajfxKPIaJ4MSodUac/edit#slide=id.p\" target=\"_blank\">Google Presentation</a>.");
tz_def('MANUAL_NF_D_14', "If the player leaves at least one message in the forum thread, he will receive in-game messages that someone else has left a new message in the same thread (i.e. is technically \"subscribed to\").");
tz_def('MANUAL_NF_D_15', "Using this innovation, any player can add to the description of his profile an image of his tribe with a small description (Romans, Teutons, Gauls).");
tz_def('MANUAL_NF_D_16', "In fact, for players this is a useless function, since it is intended only for Administrators and Multihunters. With it, Administrators and Multihunters will be able to add to their profile descriptions various interesting images with descriptions to them.");
tz_def('MANUAL_NF_D_17', "If there is an artifact in one of the villages, this will be displayed in the player's profile in front of the corresponding village in which it is located. This function was presented in Travian T4.");
tz_def('MANUAL_NF_D_18', "If in the village there is a playground for the construction of the Wonder of the World, this will be displayed in the profile opposite the corresponding village. This function was presented in Travian T4.");
tz_def('MANUAL_NF_D_19', "Vacation mode allows you to protect your empire from any hostile actions of other players during your long absence. True, for this there are certain conditions that will entail a backlog in the development of your empire. This function was presented in Travian T4.");
tz_def('MANUAL_NF_D_20', "If you send the catapults to a normal attack, you can see in the rally point which targets you set for the attack. This function was presented in Travian T4.");
tz_def('MANUAL_NF_D_21', "With the help of this information in the manual, you can find a description of the forces of Nature and Natars.");
tz_def('MANUAL_NF_D_22', "The location of the Direct links is changing. In the original Travian T3.6 Direct links are placed in the right menu below the list of villages which is not entirely convenient. If this option is enabled then Direct links will be placed in the left menu that is much more convenient.");
tz_def('MANUAL_NF_D_23', "The medal of which is awarded to players losing by the same email address of 3 or more years. Can be added to the profile description. This function was presented in Travian T4.");
tz_def('MANUAL_NF_D_24', "The medal of which is awarded to players losing by the same email address of 5 or more years. Can be added to the profile description. This function was presented in Travian T4.");
tz_def('MANUAL_NF_D_25', "The medal of which is awarded to players losing by the same email address of 10 or more years. Can be added to the profile description. This function was presented in Travian T4.");
tz_def('MANUAL_NF_D_26', "The medal of which is awarded to players losing by the same email address of 10 or more years. Can be added to the profile description. This function was presented in Travian T4.");

// ===== per-reader localization of battle reports (token layer) =====
// Battle reports are generated server-side at resolution time, in whichever
// player's language happened to trigger the automation tick. To make the
// *body* read in each viewer's own language instead, the report builders store
// language-neutral TOKENS in the notice payload and tz_expand_report() expands
// them at display time in the reader's LANG. Token grammar (no commas, so it
// survives the CSV payload):
//   {{KEY}}            -> CONST                              (e.g. {{RC_WALL_NOT_DAMAGED}})
//   {{KEY|a|b}}        -> vsprintf(CONST, [a, b])            (args are rawurlencoded)
//   {{BLD|type|mode}}  -> building name in the reader's language
// rc_tok()/rc_bld() are the emit-side helpers (used by the report builders).
// Unknown / undefined tokens are left untouched, and old reports stored as
// plain text (pre-token) pass through unchanged.
if (!function_exists('rc_tok')) {
    function rc_tok($key /* , ...$args */) {
        $args = array_slice(func_get_args(), 1);
        if (!$args) return '{{' . $key . '}}';
        return '{{' . $key . '|' . implode('|', array_map('rawurlencode', $args)) . '}}';
    }
}
if (!function_exists('rc_bld')) {
    function rc_bld($type, $mode = 0) {
        return '{{BLD|' . (int) $type . '|' . (int) $mode . '}}';
    }
}
if (!function_exists('tz_build_name')) {
    function tz_build_name($type, $mode = 0) {
        $b = Building::procResType((int) $type);
        return ($b === '' && !$mode) ? RC_VILLAGE_CANT_BE : $b;
    }
}
if (!function_exists('tz_expand_report')) {
    function tz_expand_report($s) {
        if (!is_string($s) || strpos($s, '{{') === false) return $s;
        return preg_replace_callback('/\{\{([A-Z0-9_]+)((?:\|[^|{}]*)*)\}\}/', function ($m) {
            $key  = $m[1];
            $args = ($m[2] === '') ? [] : array_map('rawurldecode', explode('|', substr($m[2], 1)));
            if ($key === 'BLD') {
                return tz_build_name($args[0] ?? 0, $args[1] ?? 0);
            }
            if (!defined($key)) return $m[0];
            return $args ? vsprintf(constant($key), $args) : constant($key);
        }, $s);
    }
}

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
            // T4 hero port (Phase 6)
            'Hero returned from an adventure'      => TZ_RT_ADV_RETURNED,
            'Hero fell on an adventure'            => TZ_RT_ADV_FELL,
            'Auction won'                          => TZ_RT_AUC_WON,
            'Auction sold'                         => TZ_RT_AUC_SOLD,
            'Auction expired'                      => TZ_RT_AUC_EXPIRED,
        );
        return strtr($s, $map);
    }
}

/* =============================================================================
 * T4 HERO PORT (Phase 6) - items / adventures / auction house
 * ========================================================================== */
tz_def('HERO_T4_TAB_HERO',       'Hero');
tz_def('HERO_T4_TAB_OASIS',      'Oasis');
tz_def('HERO_T4_TAB_ITEMS',      'Inventory');
tz_def('HERO_T4_TAB_ADVENTURES', 'Adventures');
tz_def('HERO_T4_TAB_AUCTION',    'Auctions');

tz_def('HERO_EXCHANGE', 'Exchange office');
tz_def('HERO_EXCHANGE_G2S', 'Gold to silver');
tz_def('HERO_EXCHANGE_S2G', 'Silver to gold');
tz_def('HERO_EXCHANGE_OK', 'Exchange completed.');
tz_def('HERO_EXCHANGE_NOTENOUGH', 'You do not have enough for this exchange.');
tz_def('HERO_EXCHANGE_FAIL', 'The exchange could not be completed.');
tz_def('HERO_EXCHANGE_HINT', 'You type the amount you give. Silver left over below one unit of gold stays with you.');
tz_def('HERO_RES_PRODUCTION', 'Resources');
tz_def('HERO_RES_TYPE', 'Produced resource');
tz_def('HERO_RES_ALL', 'All resources');
tz_def('HERO_RES_TYPE_HINT', 'Can be changed at any time, free of charge.');
tz_def('HERO_SILVER',            'Silver');
tz_def('HERO_EXPERIENCE',        'Experience');
tz_def('RESOURCES', 'Recursos');

/* Equipment slots */
tz_def('HERO_SLOT_1', 'Helmet');
tz_def('HERO_SLOT_2', 'Body');
tz_def('HERO_SLOT_3', 'Right hand');
tz_def('HERO_SLOT_4', 'Left hand');
tz_def('HERO_SLOT_5', 'Shoes');
tz_def('HERO_SLOT_6', 'Horse');
tz_def('HERO_SLOT_7', 'Bag');

/* Inventory actions */
tz_def('HERO_ITEMS_EQUIPPED',    'Equipped');
tz_def('HERO_ITEMS_BAG',         'Inventory');
tz_def('HERO_ITEMS_EMPTY',       'Your hero owns no items yet. Adventures and the auction house are good places to find some.');
tz_def('HERO_EQUIP',             'Equip');
tz_def('HERO_UNEQUIP',           'Take off');
tz_def('HERO_USE_ITEM',          'Use');
tz_def('HERO_QUANTITY',          'Amount');
tz_def('HERO_ITEM_USED_OK',      'The item has been used.');
tz_def('HERO_ITEM_USE_FAIL',     'This item cannot be used right now.');
tz_def('HERO_ITEM_USE_BATTLE',   'This item is used automatically (bandages heal returning troops after battles).');
tz_def('HERO_EQUIP_OK',          'Item equipped.');
tz_def('HERO_LOCKED_NOHERO', 'You have no hero yet. Train one in the Hero\'s Mansion before equipping items.');
tz_def('HERO_EQUIP_FAIL',        'This item cannot be equipped (wrong hero unit or item type).');
tz_def('HERO_UNEQUIP_OK',        'Item taken off.');

/* Adventures */
tz_def('HERO_ADV_NORMAL',        'a normal adventure');
tz_def('HERO_ADV_HARD',          'a hard adventure');
tz_def('HERO_ADV_LIST',          'Available adventures');
tz_def('HERO_ADV_NONE',          'No adventures available right now. New ones appear over time.');
tz_def('HERO_ADV_DIFFICULTY',    'Difficulty');
tz_def('HERO_ADV_DIFF_NORMAL',   'Normal');
tz_def('HERO_ADV_DIFF_HARD',     'Hard');
tz_def('HERO_ADV_PLACE', 'Place');
tz_def('HERO_ADV_DANGER', 'Danger');
tz_def('HERO_ADV_LINK', 'Link');
tz_def('HERO_ADV_DURATION',      'Travel time (one way)');
tz_def('HERO_ADV_EXPIRES',       'Expires in');
tz_def('HERO_ADV_GO',            'Start adventure');
tz_def('HERO_ADV_RUNNING',       'Your hero is on an adventure and will arrive in');
tz_def('HERO_ADV_START_OK',      'Your hero has set off on the adventure.');
tz_def('HERO_ADV_START_NOHERO',  'You need a living hero to start an adventure.');
tz_def('HERO_ADV_START_AWAY',    'Your hero is not at home.');
tz_def('HERO_ADV_START_FAIL',    'This adventure is no longer available.');
tz_def('HERO_ADV_RETURNED',      'Your hero has returned from');
tz_def('HERO_ADV_REWARD',        'Reward');
tz_def('HERO_ADV_AMOUNT',        'Amount');
tz_def('HERO_ADV_ITEM_FOUND',    'Item found');
tz_def('HERO_ADV_HP_LOST',       'Health lost');
tz_def('HERO_ADV_DIED',          'Your hero fell on');
tz_def('HERO_ADV_DIED_INFO',     "All loot was lost. The hero can be revived at the Hero's Mansion.");

/* Auction house */
tz_def('HERO_AUC_OPEN',          'Open auctions');
tz_def('HERO_AUC_NONE',          'There are no open auctions at the moment.');
tz_def('HERO_AUC_ITEM',          'Item');
tz_def('HERO_AUC_PRICE',         'Current price');
tz_def('HERO_AUC_FINAL_PRICE',   'Final price');
tz_def('HERO_AUC_TIME_LEFT',     'Ends in');
tz_def('HERO_AUC_YOUR_MAX',      'Your maximum');
tz_def('HERO_AUC_BID',           'Bid');
tz_def('HERO_AUC_BID_OK',        'Your bid was placed. You are the highest bidder.');
tz_def('HERO_AUC_BID_OUTBID',    'Your bid was immediately outbid by a higher maximum.');
tz_def('HERO_AUC_BID_FAIL',      'Your bid was not accepted.');
tz_def('HERO_AUC_BID_NOSILVER',  'You do not have enough silver for this bid.');
tz_def('HERO_AUC_MY_BIDS',       'My bids');
tz_def('HERO_AUC_MY_SALES',      'My sales');
tz_def('HERO_AUC_SELL',          'Sell an item');
tz_def('HERO_AUC_SELL_OK',       'Your item has been listed.');
tz_def('HERO_AUC_SELL_FAIL',     'This item cannot be listed (equipped items must be taken off first).');
tz_def('HERO_AUC_START_PRICE',   'Starting price');
tz_def('HERO_AUC_DURATION',      'Duration');
tz_def('HERO_AUC_LIST',          'List item');
tz_def('HERO_AUC_SELLER_NPC',    'Merchant');
tz_def('HERO_AUC_WON',           'You won the auction for');
tz_def('HERO_AUC_SOLD',          'Your auction sold:');
tz_def('HERO_AUC_REFUND',        'Refunded from your maximum bid');
tz_def('HERO_AUC_FEE',           'Auction fee');
tz_def('HERO_AUC_PAYOUT',        'Payout');
tz_def('HERO_AUC_EXPIRED',       'Your auction ended without bids. The item was returned to your inventory:');

/* Report topics (raw English strings live in ndata.topic) */
tz_def('TZ_RT_ADV_RETURNED',     'Hero returned from an adventure');
tz_def('TZ_RT_ADV_FELL',         'Hero fell on an adventure');
tz_def('TZ_RT_AUC_WON',          'Auction won');
tz_def('TZ_RT_AUC_SOLD',         'Auction sold');
tz_def('TZ_RT_AUC_EXPIRED',      'Auction expired');

/* T4 hero port - movement display (dorf1 + rally point) */
tz_def('HERO_ADV_MOV_OUT',   'Hero on an adventure');
tz_def('HERO_ADV_MOV_BACK',  'Hero returning from an adventure');
tz_def('HERO_ADV_MOV_SHORT', 'Adventure');

/* T4 hero port - tooltip effect fragments (heroItemBonusText) */
tz_def('HB_TXT_FIGHT',      'fighting strength');
tz_def('HB_TXT_UNIT_OFF',   'attack');
tz_def('HB_TXT_UNIT_DEF',   'defense');
tz_def('HB_TXT_PER',        'per');
tz_def('HB_TXT_VS_NATARS',  'strength vs Natars');
tz_def('HB_TXT_RAID',       'raided resources');
tz_def('HB_TXT_RETURN',     'troop return speed');
tz_def('HB_TXT_SPEED_OWN',  'speed between own villages');
tz_def('HB_TXT_SPEED_ALLY', 'speed between ally villages');
tz_def('HB_TXT_XP',         'experience');
tz_def('HB_TXT_REGEN',      'HP per day');
tz_def('HB_TXT_CP',         'culture points per day');
tz_def('HB_TXT_TRAIN_CAV',  'cavalry training time');
tz_def('HB_TXT_TRAIN_INF',  'infantry training time');
tz_def('HB_TXT_DMG',        'damage taken by the hero');
tz_def('HB_TXT_SPEED20',    'troop speed beyond 20 tiles');
tz_def('HB_TXT_MOUNT',      'fields/hour while mounted');
tz_def('HB_TXT_HORSE',      'fields/hour hero speed');
tz_def('HB_TXT_OINTMENT',   'Heals 1% hero health per unit (max 99%)');
tz_def('HB_TXT_SCROLL',     'hero experience each');
tz_def('HB_TXT_BUCKET',     'Instantly revives the hero at no cost');
tz_def('HB_TXT_TABLET',     '+1% own village loyalty each (max 125%)');
tz_def('HB_TXT_BOOK',       'Resets the hero attribute points');
tz_def('HB_TXT_ARTWORK',    'Culture points equal to your daily production');
tz_def('HB_TXT_BANDAGE_A',  'Heals');
tz_def('HB_TXT_BANDAGE_B',  "of the hero's fallen troops after battle");
tz_def('HB_TXT_CAGE',       'Captures 1 oasis animal per cage');
tz_def('HB_TXT_NEEDS_HORSE','requires an equipped horse');
tz_def('HB_TXT_ONLY',       'only for a');
tz_def('HB_TXT_HERO',       'hero');

/* T4 hero port - captured animals release action */
tz_def('HERO_RELEASE_ANIMALS', 'Release');
tz_def('HERO_RELEASE_CONFIRM', 'Release these animals? They will be gone for good.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - etichete de meniu si titluri de pagina
// (erau scrise direct in Admin/admin.php, deci meniul ramanea in engleza)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADMIN_LOGOUT', 'Logout');
tz_def('ADMIN_SERVER_HOMEPAGE', 'Server Homepage');
tz_def('ADMIN_CONTROL_PANEL_HOME', 'Control Panel Home');
tz_def('ADMIN_RETURN_TO_THE_SERVER', 'Return to the server');
tz_def('ADMIN_SERVER_INFO', 'Server Info');
tz_def('ADMIN_ONLINE_USERS', 'Online Users');
tz_def('ADMIN_PLAYERS_NOT_ACTIVATED', 'Players Not Activated');
tz_def('ADMIN_PLAYERS_INACTIVATE', 'Players Inactivate');
tz_def('ADMIN_PLAYERS_REPORT', 'Players Report');
tz_def('ADMIN_PLAYERS_MESSAGE', 'Players Message');
tz_def('ADMIN_MAP', 'Map');
tz_def('ADMIN_MAP_TILE', 'Map Tile');
tz_def('ADMIN_NATARS_MANAGEMENT', 'Natars Management');
tz_def('ADMIN_SEARCH', 'Search');
tz_def('ADMIN_GENERAL_SEARCH', 'General Search');
tz_def('ADMIN_SEARCH_IGMS_REPORTS', 'Search IGMs/Reports');
tz_def('ADMIN_MESSAGES', 'Messages');
tz_def('ADMIN_CREATE_MASS_MESSAGE', 'Create Mass Message');
tz_def('ADMIN_CREATE_SYSTEM_MESSAGE', 'Create System Message');
tz_def('ADMIN_BAN', 'Ban');
tz_def('ADMIN_BAN_UNBAN_PLAYERS', 'Ban/Unban Players');
tz_def('ADMIN_CLEAN_BANLIST_DATA', 'Clean Banlist Data');
tz_def('ADMIN_GOLD', 'Gold');
tz_def('ADMIN_GIVE_ALL_FREE_GOLD', 'Give All Free Gold');
tz_def('ADMIN_GIVE_FREE_GOLD_TO_SPECIFIC_USER', 'Give Free Gold To Specific User');
tz_def('ADMIN_GOLD_SHOP_PROMO_CODES', 'Gold Shop &amp; Promo Codes');
tz_def('ADMIN_RESET_GOLD', 'Reset Gold');
tz_def('ADMIN_PLUS_RES_BONUS', 'Plus &amp; Res Bonus');
tz_def('ADMIN_GIVE_ALL_PLUS', 'Give All Plus');
tz_def('ADMIN_RESET_PLUS', 'Reset Plus');
tz_def('ADMIN_GIVE_ALL_RES_BONUS', 'Give All Res Bonus');
tz_def('ADMIN_RESET_RES_BONUS', 'Reset Res Bonus');
tz_def('ADMIN_USERS', 'Users');
tz_def('ADMIN_LIST_USERS', 'List Users');
tz_def('ADMIN_CREATE_USERS', 'Create Users');
tz_def('ADMIN_MULTI_ACCOUNT_DETECTION', 'Multi-Account Detection');
tz_def('ADMIN_PUSH_PROTECTION', 'Push Protection');
tz_def('ADMIN_REGISTRATION_BLOCKLIST', 'Registration Blocklist');
tz_def('ADMIN_ADMIN', 'Admin');
tz_def('ADMIN_ADMIN_LOG', 'Admin Log');
tz_def('ADMIN_QUEST_EDITOR', 'Quest Editor');
tz_def('ADMIN_WORLD_MAP_HEATMAP', 'World Map Heatmap');
tz_def('ADMIN_DEBUG_ERROR_LOG', 'Debug Error Log');
tz_def('ADMIN_SERVER_SETTINGS', 'Server Settings');
tz_def('ADMIN_SERVER_MAINTENANCE', 'Server Maintenance');
tz_def('ADMIN_SERVER_RESETTING', 'Server Resetting');
tz_def('ADMIN_IN_GAME_MESSAGES', 'In-Game Messages');
tz_def('ADMIN_MSG_REP', 'Msg/Rep');
tz_def('ADMIN_MASS_MESSAGE', 'Mass Message');
tz_def('ADMIN_SYSTEM_MESSAGE', 'System Message');
tz_def('ADMIN_DELETE_PLAYER_MEDALS', 'Delete Player Medals');
tz_def('ADMIN_DELETE_ALLY_MEDALS', 'Delete Ally Medals');
tz_def('ADMIN_USERS_LIST', 'Users List');
tz_def('ADMIN_SERVER_CONFIGURATION', 'Server Configuration');
tz_def('ADMIN_CRON_AUTOMATION', 'Cron &amp; Automation');
tz_def('ADMIN_PLUS_SETTINGS', 'PLUS Settings');
tz_def('ADMIN_LOG_SETTINGS', 'Log Settings');
tz_def('ADMIN_NEWSBOX_SETTINGS', 'NewsBox Settings');
tz_def('ADMIN_NEW_FUNCTIONS_SETTINGS', 'New Functions Settings');
tz_def('ADMIN_EXTRA_SETTINGS', 'Extra Settings');
tz_def('ADMIN_EDIT_ADMIN_INFORMATION', 'Edit Admin Information');
tz_def('ADMIN_PLAYER_DETAILS', 'Player Details');
tz_def('ADMIN_EDIT_PLAYER', 'Edit Player');
tz_def('ADMIN_DELETE_PLAYER', 'Delete Player');
tz_def('ADMIN_COMPOSE_MESSAGE', 'Compose Message');
tz_def('ADMIN_EDIT_PLUS_RESOURCES', 'Edit Plus &amp; Resources');
tz_def('ADMIN_EDIT_SITTERS', 'Edit Sitters');
tz_def('ADMIN_EDIT_PASSWORD', 'Edit Password');
tz_def('ADMIN_EDIT_PROTECTION', 'Edit Protection');
tz_def('ADMIN_EDIT_OFF_DEF', 'Edit Off &amp; Def');
tz_def('ADMIN_EDIT_WEEKLY_OFF_DEF', 'Edit Weekly Off &amp; Def');
tz_def('ADMIN_USER_LOGINS', 'User Logins');
tz_def('ADMIN_USER_ILLEGALS_LOG', 'User Illegals Log');
tz_def('ADMIN_EDIT_HERO', 'Edit Hero');
tz_def('ADMIN_T4_HERO_CONTROLS', 'T4 Hero Controls');
tz_def('ADMIN_EDIT_ADDITIONAL_INFO', 'Edit Additional Info');
tz_def('ADMIN_EDIT_VILLAGE', 'Edit Village');
tz_def('ADMIN_EDIT_RESOURCES', 'Edit Resources');
tz_def('ADMIN_EDIT_TROOPS', 'Edit Troops');
tz_def('ADMIN_UPGRADE_TROOPS', 'Upgrade Troops');
tz_def('ADMIN_ALLIANCE', 'Alliance');
tz_def('ADMIN_EDIT_ALLIANCE', 'Edit Alliance');
tz_def('ADMIN_DELETE_ALLIANCE', 'Delete Alliance');
tz_def('ADMIN_BUILD_LOG', 'Build Log');
tz_def('ADMIN_RESEARCH_LOG', 'Research Log');
tz_def('ADMIN_NO_PLAYER', 'no player');
tz_def('ADMIN_NO_VILLAGE', 'no village');

// Public interface and manual translations
tz_def('PUBLIC_WELCOME_TO', 'Bienvenido a');
tz_def('PUBLIC_MANUAL', 'Manual');
tz_def('PUBLIC_REGISTER', 'Registrarse');
tz_def('PUBLIC_TRIBES', 'Las tribus');
tz_def('PUBLIC_CLOSE', 'Cerrar');
tz_def('PUBLIC_BACK', 'atrás');
tz_def('PUBLIC_FORWARD', 'adelante');
tz_def('PUBLIC_TO_REGISTRATION', 'al registro');
tz_def('ANL_ROMANS', 'Los Romanos');
tz_def('ANL_GAULS', 'Los Galos');
tz_def('ANL_TEUTONS', 'Los Germanos');
tz_def('ANL_ROMAN_TROOPS', 'Las tropas romanas');
tz_def('ANL_GALLIC_TROOPS', 'Las tropas galas');
tz_def('ANL_TEUTONIC_TROOPS', 'Las tropas germanas');
tz_def('ANL_SPECIALTIES', 'Las especialidades');
tz_def('ANL_ROMAN_DUAL_BUILD', 'Can raise or extend a building and resource field simultaneously');
tz_def('ANL_ROMAN_WALL_BONUS', 'The City Wall gives a high defence bonus');
tz_def('ANL_GAUL_SPEED_BONUS', 'Speed bonus: Fastest troops in the game');
tz_def('ANL_GAUL_PALISADE_BONUS', 'The palisade gives an average defence bonus');
tz_def('ANL_TEUTON_EARTH_WALL', 'The earth wall is almost indestructible but only gives a minimal defence bonus');
tz_def('ANL_TEUTON_CHEAP_TROOPS', 'Cheap, fast troops which are excellent plunderers');
tz_def('ANL_TEUTON_WEAK_DEFENCE', 'Weak defence');
tz_def('ANL_ROMAN_DESC_1', 'Because of its high level of social and technological development the Romans are masters at building and its coordination. Also, their troops are part of the elite in Travian. They are very balanced and useful in attacking and defending.');
tz_def('ANL_ROMAN_DESC_2', 'To guarantee this variety the Roman troops are trained for a very long time and their training is expensive. Their infantry is a living legend, but their defence against enemy cavalry isn\'t as good as that of the other tribes. The amount of resources a Roman merchant is able to carry is very low.');
tz_def('ANL_ROMAN_DESC_3', 'Because they are weak at the beginning of the game, they are a bad choice for beginners.');
tz_def('ANL_GAUL_DESC_1', 'The Gauls are the most peaceful of all three tribes in Travian. Their troops are trained for an excellent defence, but their ability to attack can still compete with the other two tribes. The Gauls are born riders and their horses are famous for their speed. This means that their riders can hit the enemy exactly where they can cause the most damage and swiftly take care of them.');
tz_def('ANL_GAUL_DESC_2', 'This tribe is very easy to defend, but an aggressive tactic is possible too. This gives you the opportunity to develop into any possible strategic direction (defensive or aggressive, lone wolf or reliable helper, merchant or plunderer, infantry or cavalry, settler or conqueror), but you need a bit of experience and talent.');
tz_def('ANL_GAUL_DESC_3', 'For beginners and those players who don\'t know exactly what they want to play, the Gauls are the ideal choice.');
tz_def('ANL_TEUTON_DESC_1', 'The Teutons are the most aggressive tribe. Their troops are notorious and feared for their rage and frenzy when they attack. They move around as a plundering horde, not even afraid of death.');
tz_def('ANL_TEUTON_DESC_2', 'However, they lack the military discipline of the Gauls or Romans which causes them to be weak in speed and defence.');
tz_def('ANL_TEUTON_DESC_3', 'For aggressive and experienced players the Teutons are an excellent choice!');
tz_def('ANL_TRIBES_INTRO', 'You can choose between three tribes in Travian: Romans, Gauls and Teutons. Each tribe has advantages and disadvantages and their troops are also very different. It is important to choose the tribe that fits you perfectly.');
tz_def('ANL_ROMAN_MERCHANT', 'Merchants can carry 500 units of resources (speed: 16 fields/hour)');
tz_def('ANL_GAUL_MERCHANT', 'Merchants can carry 750 units of resources (speed: 24 fields/hour)');
tz_def('ANL_TEUTON_MERCHANT', 'Merchants can carry 1000 units of resources (speed: 12 fields/hour)');
tz_def('ANL_TEUTON_PLUNDER_BONUS', 'Plunder bonus: enemy crannies only hides 66% of the normal amount in Travian version 2.5 and 3, and 80% of the normal amount in Travian version 3.5.');
tz_def('ANL_ATTACK_VALUE', 'Attack value');
tz_def('ANL_DEF_INFANTRY', 'Defence value against infantry');
tz_def('ANL_DEF_CAVALRY', 'Defence value against cavalry');
tz_def('ANL_SPEED', 'Speed');
tz_def('ANL_BUILDINGS_INTRO_1', 'At the beginning you should try to get a good economic basis. In order to do so you have to extend the 18 resource fields (village overview). There are four different types of resource fields: Woodcutter, Clay pit, Iron mine and Cropland. If you click one of them, you will get more information and the option to extend it.');
tz_def('ANL_BUILDINGS_INTRO_2', 'Later in the game the buildings in the village become important too. In order to construct a new building you have to click on one of the green ovals. A list with every building that is available will appear.');
tz_def('ANL_BUILDINGS_INTRO_3', 'Some buildings can only be built if you fulfil the prerequisites which are other buildings.');
tz_def('ANL_TRIBE_ADVANTAGE', 'Tribe advantage:');
tz_def('ANL_ROMAN_BUILD_ADVANTAGE', 'Romans: Can build/extend a resource field and a village building at the same time.');
tz_def('ANL_MAIN_BUILDING_DESC', 'The village\'s master builders live in the main building. The higher its level the faster your master builders complete the construction of new buildings.');
tz_def('ANL_WAREHOUSE_DESC', 'The resources lumber, clay and iron are stored in your warehouse. By increasing its level you increase your warehouse\'s capacity.');
tz_def('ANL_GRANARY_DESC', 'The crop produced by your farms is stored in the granary. By increasing its level you increase the granary?s capacity.');
tz_def('ANL_CRANNY_DESC', 'The cranny is used to hide some of your resources when the village is attacked. These resources cannot be stolen. At level 1 100 resources are hidden.');
tz_def('ANL_GAUL_CRANNY', 'Gauls: The cranny is twice as big.');
tz_def('ANL_TEUTON_CRANNY', 'Teutons: Enemy crannies only hides 66% of the normal amount in Travian version 2.5 and 3, and 80% of the normal amount in Travian version 3.5.');
tz_def('ANL_EMBASSY_DESC', 'In order to join an alliance you need an embassy. With an embassy level 3 you can even found one yourself. With each higher level the maximum size of the alliance increases by 3.');
tz_def('ANL_RALLY_POINT_DESC', 'At the rally point you can instruct your troops and can see the sender of oncoming troops. The rally point can only be build at the building site right of the village centre. The higher its level the more targets for the catapults become available.');
tz_def('ANL_MARKETPLACE_DESC', 'At the marketplace you can trade resources with other players. The higher its level, the more resources can be transported at the same time.');
tz_def('ANL_BARRACKS_DESC', 'Infantry can be trained in the barracks. The higher its level the faster the troops are trained.');
tz_def('ANL_STABLE_DESC', 'Cavalry is trained in the stable. The higher its level the faster the troops are trained.');
tz_def('ANL_WORKSHOP_DESC', 'Siege engines like catapults and rams can be built in the workshop. The higher its level the faster the units are produced.');
tz_def('ANL_ACADEMY_DESC', 'New unit types can be developed in the academy. By increasing its level you can order the research of better units.');
tz_def('ANL_BLACKSMITH_DESC', 'Your warriors\' weapons are enhanced in the blacksmith?s melting furnaces. By increasing its level you can order the fabrication of even better weapons.');
tz_def('ANL_ARMOURY_DESC', 'Your warriors\' armour is enhanced in the armoury\'s melting furnaces. By increasing its level you can order the fabrication of even better armour.');
tz_def('ANL_PALACE_DESC', 'The King or Queen of the empire lives in the palace. The palace can only be built in one village at a time and can be used to make a village the capital. Capitals cannot be conquered.');
tz_def('ANL_CAPITAL_DESC', 'The Capital is the only place a stonemason\'s lodge can be erected. Also the capital is the only village where resource fields can be extended beyond level 10.');
tz_def('ANL_RESIDENCE_DESC', 'The residence is a small palace where the king or queen lives when he or she visits the village. The residence protects the village against enemies who want to conquer it as long as it is not destroyed.');
tz_def('ANL_TRADE_OFFICE_DESC', 'In the trade office the merchants\' carts get improved and equipped with powerful horses. The higher its level the more your merchants are able to carry.');
tz_def('ANL_TRADE_OFFICE_CAPACITY', 'With each level the capacity increases by 10%. At level 20 your merchants can carry thrice as much as normal.');
tz_def('ANL_ROMAN_TRADE_OFFICE', 'Romans: In Travian version 3.5 the Roman trade office increases the capacity by 20% per level.');
tz_def('ANL_TOURNAMENT_SQUARE_DESC', 'Your troops can train to increase their stamina at the tournament square. The further the building is upgraded the faster your troops are beyond a minimum distance of 30 squares.');
tz_def('ANL_FAQ_RALLY_POINT_LOCATION', 'The rally point can only be built at one location. This location is found to the right of your villages centre on the meadow.');
tz_def('ANL_FAQ_ALLIANCE', 'To found an alliance you need an embassy at level 3. To be able to join an alliance you just need an embassy at level 1 and, of course, an invitation to join the alliance.');
tz_def('ANL_FAQ_RENAME_VILLAGE_Q', 'How can I change the name of my village?');
tz_def('ANL_FAQ_RENAME_VILLAGE_A', 'First select the village you wish to remain by clicking it under <i><?php echo VILLAGES; ?></i>. Next click <i><?php echo PROFILE; ?></i> at the left then <i><?php echo CHANGE_PROFILE; ?></i>. Change the name in the <i><?php echo VILLAGE_NAME; ?></i> box and click OK.');
tz_def('ANL_FAQ_TRAIN_TROOPS_Q', 'How do I train troops?');
tz_def('ANL_FAQ_TRAIN_TROOPS_A', 'You need a rally point which is at least level 1 and a main building which is at least level 3. When you have those you can raise Barracks and there you can train infantry.');
tz_def('ANL_FAQ_DEFEND_VILLAGE_Q', 'How do I defend my village?');
tz_def('ANL_FAQ_DEFEND_VILLAGE_A', 'As long as there are troops (your own or troops sent to reinforce you) in your village they defend your village automatically.');
tz_def('ANL_FAQ_LOW_PLUNDER_Q', 'Why do my troops plunder so few resources?');
tz_def('ANL_FAQ_LOW_PLUNDER_A', 'There are two explanations. Firstly, each troop type can only carry a certain number of resources. Secondly, your victim might have a <i><?php echo CRANNY; ?></i> where his or her villagers automatically hide a certain number of resources that your plundering hordes cannot find.');
tz_def('ANL_FAQ_LOSE_VILLAGE_Q', 'Can I lose a village?');
tz_def('ANL_FAQ_LOSE_VILLAGE_A', 'Every village can be catapulted to 0 inhabitants and as long as it is not the last of your account it will disappear after a short time. The only village that cannot be conquered is the capital. Note that destroying the capital is still possible.');
tz_def('ANL_FAQ_BUILD_RALLY_POINT_Q', 'How can I build a rally point?');
tz_def('ANL_FAQ_FOUND_ALLIANCE_Q', 'How can I found an alliance?');
tz_def('ANL_FAQ_FOUND_CONQUER_Q', 'How can I found or conquer new villages?');
tz_def('PUBLIC_ABOUT_PROJECT', 'About this Project:');
tz_def('PUBLIC_ADD_TRIBES', '- Add new tribes and mechanics');
tz_def('PUBLIC_UNOFFICIAL_PROJECT', 'This is an unofficial fan-made project and is not affiliated with Travian Games GmbH.');
tz_def('PUBLIC_DELETE_COOKIES_NOTICE', 'If other people use this computer too, you should delete your cookies for your own safety:');
tz_def('PUBLIC_DELETE_COOKIES', 'delete cookies');
tz_def('ANL_ROMAN_MERCHANT_500', 'Romans: Each merchant can carry 500 resources.');
tz_def('ANL_TEUTON_MERCHANT_1000', 'Teutons: Each merchant can carry 1000 resources.');
tz_def('ANL_GAUL_MERCHANT_750', 'Gauls: Each merchant can carry 750 resources.');
tz_def('ANL_ROMAN_ALT', 'Roman');
tz_def('ANL_GAUL_ALT', 'The Gauls');
tz_def('ANL_TEUTON_ALT', 'Teuton');
tz_def('ANL_CRANNY_DOUBLE', 'Cranny is twice as big');
tz_def('ANL_POPULATION_EXPLAIN', 'Each building increases the population of your village by a certain number of new inhabitants. How many new inhabitants are produced by raising/extending a building is shown next to the symbol .');
tz_def('ANL_CROP_EXAMPLE_1', '(e.g. 10) your crop production minus your use of crop because of (e.g. 5) and is shown. Your total crop production is shown in the upper right corner. e.g. 5/15');
tz_def('ANL_CROP_EXAMPLE_2', 'In the example 8 would be your use of crop, 15 your total crop production, 15 - 8 = 7 units of crop per hour.');
tz_def('PUBLIC_LOGOUT_SUCCESS_TITLE', 'Cierre de sesión exitoso.');
tz_def('PUBLIC_LOGOUT_THANKS', 'Gracias por tu visita.');
tz_def('ANL_POPULATION_EXPLAIN_HTML', 'Each building increases the population of your village by a certain number of new inhabitants. How many new inhabitants are produced by raising/extending a building is shown next to the symbol.');
tz_def('ANL_CROP_EXPLAIN_HTML', 'At production, your crop production minus your use of crop because of population and troops is shown. Your total crop production is shown in the upper right corner.');
tz_def('ANL_CROP_EXAMPLE_HTML', 'In the example 8 would be your use of crop, 15 your total crop production, 15 - 8 = 7 units of crop per hour.');
tz_def('ANL_USE_OF_CROP', 'Use of crop');
tz_def('PUBLIC_TERMS_TITLE', 'Términos y condiciones');
tz_def('PUBLIC_TERMS_GENERAL_RULES', '1. General Rules');
tz_def('PUBLIC_TERMS_PROJECT', 'This is a fan-made open-source project called TravianZ by Shadow.');
tz_def('PUBLIC_TERMS_ACCEPTANCE', 'By using this game server you agree to follow all rules stated here.');
tz_def('PUBLIC_TERMS_ACCOUNT_RESPONSIBILITY', '2. Account Responsibility');
tz_def('PUBLIC_TERMS_ACCOUNT_FULL_RESPONSIBILITY', 'You are fully responsible for your account.');
tz_def('PUBLIC_TERMS_ACCOUNT_SHARING', 'Sharing accounts is allowed only if game rules permit it.');
tz_def('PUBLIC_TERMS_CHEATING', 'Cheating, botting, multi-account abuse or exploiting game mechanics');
tz_def('PUBLIC_TERMS_SERVER_STATUS', '4. Server Status');
tz_def('PUBLIC_TERMS_AS_IS', 'This server is provided "as-is" without guarantees of uptime or stability.');
tz_def('PUBLIC_TERMS_RESET', 'The developer reserves the right to reset or modify the server at any time.');
tz_def('PUBLIC_TERMS_NO_AFFILIATION', 'This project is not affiliated with Travian Games.');
tz_def('PUBLIC_TERMS_UPDATES', 'These terms may be updated at any time without prior notice.');
tz_def('PUBLIC_RULES_TITLE', 'Reglas del juego');
tz_def('PUBLIC_RULES_INTRO_1', 'The below set of rules are in addition to the General Terms and Conditions of Travian. You should familiarize yourself with the General Terms and Conditions to verify what is allowed, especially in the case of an account that has been banned for a rule violation.');
tz_def('PUBLIC_RULES_INTRO_2', 'Inciting, manipulating, encouraging, assisting or conspiring with others to violate any of Travian Rules is impermissible. These rules apply for players that will delete their accounts or are currently deleting their accounts without exception.');
tz_def('PUBLIC_RULES_SECTION_1', '&sect;1 Password, Registration ownership');
tz_def('PUBLIC_RULES_ONE_ACCOUNT', 'Each player may only own and play one account per server.');
tz_def('PUBLIC_RULES_EMAIL_OWNER', 'The e-mail address used for the registration of an account must be under the personal and exclusive control of the person who registered the account. The person owning the e-mail address used to register an account is considered the owner of the account, regardless of any other personal or alliance agreements. The owner of an account is fully responsible for all actions taken with the account.');
tz_def('PUBLIC_RULES_SECTION_1_2', '&sect;1.2 Password');
tz_def('PUBLIC_RULES_PASSWORD_SAME_WORLD', 'The owner of an account may not transfer the password of an account to any person playing on the same game world (server). Additionally, knowingly choosing the same password on the same game world as another person is illegal; any of these actions is considered multiaccounting, as defined in these rules.');
tz_def('PUBLIC_RULES_PASSWORD_OTHER_WORLD', 'However, it is permissible to transfer the password of an account to a person or persons playing on different game world (or not playing at all) in order to play a single account together.');
tz_def('PUBLIC_RULES_PASSWORD_DAMAGE', 'There is no compensation for damages done by someone knowing the password for an account. The person receiving the password is subject to the rules of Travian as well as the General Terms and Conditions.');
tz_def('PUBLIC_RULES_SECTION_1_3', '&sect;1.3 Email changes / account transfers');
tz_def('PUBLIC_RULES_EMAIL_CHANGE', 'In order to change the email address of your account or to transfer your account to another player NOT playing on the same server, go into your account profile (/spieler.php?s=3) and fill out the new email information.');
tz_def('PUBLIC_RULES_SAME_WORLD_TRANSFER', 'In order to switch an account with a person on the same game world, both persons must send an e-mail message to admin@travian.com from the e-mail address currently registered for the account. The e-mail must contain the following information:');
tz_def('PUBLIC_RULES_WORLD_NAME', 'The game world on which the account resides');
tz_def('PUBLIC_RULES_ACCOUNT_NICKNAME', 'The nickname of the account');
tz_def('PUBLIC_RULES_NEW_OWNER_EMAIL', 'The e-mail address of the new owner.');
tz_def('PUBLIC_RULES_PASSWORD_REQUEST_AFTER_TRANSFER', 'Afterwards both persons must request the password for their new account via the password retrieval function.');
tz_def('PUBLIC_RULES_SITTERS', 'Every player has the right to name two sitters who may play the account during an owner\'s absence. Sitters must play the account they are sitting to the account�s full benefit. Abuse of this function is punishable.');
tz_def('PUBLIC_RULES_SITTER_LOGIN', 'The sitter of an account must sit the account using the account sitting function in game. The sitter of an account may not tend to an account by logging on with the password of the account they are sitting (see &sect;1.2).');
tz_def('PUBLIC_RULES_SITTER_DAMAGE', 'There is no compensation for damages done by a sitter. Owners of an account are fully responsible for the actions of any sitters for their account. In the event that sitters of an account do not follow these rules and the General Terms and Conditions of Travian, both the account owner and the sitter may be punished.');
tz_def('PUBLIC_RULES_SHARED_COMPUTER', 'Players using the same computer and wanting to access each other\'s account must use the sitter function.');
tz_def('PUBLIC_RULES_BROWSER', 'The game must be played with an unmodified internet browser. The use of scripts or bots which automate is against the rules.');
tz_def('PUBLIC_RULES_BUGS', 'Program errors (also called bugs) may not be used to one\'s benefit. Abuse can lead to a punishment of the account.');
tz_def('PUBLIC_RULES_REAL_MONEY', 'Any sales or purchases concerning real money regarding accounts, units, villages, resources, services or any other aspect of Travian are impermissible. The sale of Travian accounts as well as any indirect transfer (even as gifts) in connection with auction sites or other money transactions is impermissible.');
tz_def('PUBLIC_RULES_POLITE_COMMUNICATION', 'Everyone must communicate in a polite, conversational tone. Multihunters may change inappropriate profiles and village names without warning.');
tz_def('PUBLIC_RULES_BEHAVIOUR_INTRO', 'Following behavior is punishable and applies to all descriptions, the account name, alliance names, village names and messages:');
tz_def('PUBLIC_RULES_LANGUAGE', 'English is the only official language tolerated.');
tz_def('PUBLIC_RULES_BLACKMAIL', 'Blackmailing players in a way that violates any of Travian\'s rules respective the general terms and conditions.');
tz_def('PUBLIC_RULES_ADVERTISING', 'Advertisement of any kind that has not been permitted by the Travian Team is impermissible.');
tz_def('ANL_FOUND_VILLAGE_Q', 'How can I found a new village?');
tz_def('ANL_FOUND_VILLAGE_A', 'In order to found a new village you need 3 settlers, an empty spot on the map and enough culture points. You do not have to research settlers as you can directly build them with a palace level 10, 15 or 20 or a residence level 10 or 20. To build the palace you need a main building level 5 and an embassy. To build the residence you only need a level 5 main building. After training the 3 settlers you can choose an empty spot on the map and click "Found new village" (Hint: you need 750 units of each resource!) then your settlers will leave their home village and found the new village for you.');
tz_def('ANL_CONQUER_VILLAGE_Q', 'How can I conquer a village?');
tz_def('ANL_CONQUER_VILLAGE_A1', 'For this, too, one needs at least a residence/palace level 10 as well as an enemy village one can conquer. Additionally enough culture points are needed - like for founding a new village. One cannot conquer the last of a player\'s villages and neither their capital.');
tz_def('ANL_CONQUER_VILLAGE_A2', 'As soon as the steward of a town (senator, chief, chieftain) as been researched in the academy one can train him in the residence/palace like a settler. However, one may not have already trained settlers in order to be able to train a steward. To conquer a village the steward needs to attack the desired village a couple of times after the enemy residence/palace has been demolished. Once the village\'s loyalty reached zero the village will become one\'s own. Once this happened one should build a palace or a residence to raise the loyalty again.');
tz_def('ANL_CULTURE_POINTS_A', 'One gets culture points (CPs) by constructing and extending buildings. Already produced culture points can be seen in the residence and palace. Additionally information about the required culture points for additional villages is displayed there.');
tz_def('PUBLIC_RULES_PROGRAM_ERRORS_HEADING', '&sect;4 Program errors');
tz_def('PUBLIC_RULES_PUNISHMENT', 'If there is an offence against these game rules, the Multihunters and, if necessary, the Administrators will ban the account(s) in question and decide on a proper punishment. Punishments will always exceed the gain of the violation of the rules.');
tz_def('PUBLIC_RULES_NO_REPLACEMENT', 'Resources, buildings, villages or troops lost during the time of suspension do not count as punishment and will not be replaced by the Travian Team. No player has the right to claim payment or replacement for Plus/Gold time lost due to suspension.');
tz_def('PUBLIC_RULES_NO_SPECIAL_TREATMENT', 'here is no special treatment for Travian Plus/Gold users regarding the game rules neither in the time needed to deal with the case nor in the punishment.');
tz_def('PUBLIC_RULES_APPEALS', 'Players may talk to the Multihunter who banned them or an Administrator either via IGM (ingame message) or e-mail. Bans, punishments or deletions are not to be discussed in public (e.g. Chat or Forums). Appeals must be written in English.');
tz_def('PUBLIC_RULES_OWNER_INFORMATION', 'Additionally, the Travian Team will not provide information to persons other than the account owner.');
tz_def('PUBLIC_RULES_MULTI_DELETE', 'Multi accounts on the speed server and multi accounts with less than 100 population may be deleted on sight with no warning.');
tz_def('PUBLIC_RULES_SECTION_8', '&sect;8 Changing of rules');
tz_def('PUBLIC_RULES_CHANGE_ANY_TIME', 'The Travian Team reserves the right to change the rules at any time.');
tz_def('PUBLIC_RULES_SEVERABILITY', 'If individual regulations of this set of rules should be ineffective, it does not affect the validity of the remaining regulations of this set of rules. The Administrators commit themselves to replace ineffective regulations with new regulations which replace the ineffective regulations as fast as possible.');
tz_def('ANL_BUILDINGS', 'Buildings');
tz_def('ANL_WAREHOUSE', 'Warehouse');
tz_def('ANL_GRANARY', 'Granary');
tz_def('ANL_MAIN_BUILDING', 'Main Building');
tz_def('ANL_MARKETPLACE', 'Marketplace');
tz_def('ANL_BARRACKS', 'Barracks');
tz_def('ANL_STABLE', 'Stable');
tz_def('ANL_ACADEMY', 'Academy');
tz_def('ANL_CRANNY', 'Cranny');
tz_def('ANL_RESIDENCE', 'Residence');
tz_def('ANL_PALACE', 'Palace');
tz_def('ANL_GREAT_BARRACKS', 'Great Barracks');
tz_def('ANL_GREAT_STABLE', 'Great Stable');
tz_def('ANL_CULTURE_POINTS_MORE_VILLAGES', 'The more villages one has, the more culture points are necessary to found or conquer additional villages. One cannot lose culture points, however, one needs more for additional villages.');
tz_def('ANL_REQ_MAIN_BUILDING_1', 'Main Building Level 1');
tz_def('ANL_REQ_MB3_WH1_GR1', 'Main Building Level 3, Warehouse Level 1, Granary Level 1');
tz_def('ANL_REQ_RP1_MB3', 'Rally Point Level 1, Main Building Level 3');
tz_def('ANL_REQ_BLACKSMITH3_ACADEMY5', 'Blacksmith Level 3, Academy Level 5');
tz_def('ANL_REQ_ACADEMY10_MB5', 'Academy Level 10, Main Building Level 5');
tz_def('ANL_REQ_BARRACKS3_MB3', 'Barracks Level 3, Main Building Level 3');
tz_def('ANL_REQ_MB3_ACADEMY3', 'Main Building Level 3, Academy Level 3');
tz_def('ANL_REQ_MB3_ACADEMY1', 'Main Building Level 3, Academy Level 1');
tz_def('ANL_REQ_EMBASSY1_MB5', 'Embassy Level 1, Main Building Level 5,');
tz_def('ANL_REQ_MB5', 'Main Building Level 5,');
tz_def('ANL_REQ_MARKET20_STABLE10', 'Marketplace Level 20, Stable Level 10');
tz_def('ANL_SPEED_LABEL', 'Speed');
tz_def('ANL_FAQ_FOUND_CONQUER_FULL', 'You need three settlers to found a new village. To conquer a village you need an administrator (senator, chief or chieftain) which can be trained in your palace/residence at level 10. Additionally you need a certain number of .');
tz_def('ANL_CONSTRUCTION_TIME_LEVEL1', 'construction time for level 1:');
tz_def('ANL_PALACE_SETTLERS_ADMIN', 'At level 10, 15 and 20 three settlers or one administrator (Senator, Chief or Chieftain) can be trained.');
tz_def('ANL_RESIDENCE_SETTLERS_ADMIN', 'At level 10 and 20 three settlers or one administrator (Senator, Chief or Chieftain) can be trained.');
tz_def('ANL_REQ_RALLY_POINT_15', 'Rally Point Level 15');
tz_def('ANL_FAQ_FOUND_CONQUER_PREFIX', 'You need three settlers to found a new village. To conquer a village you need an administrator (senator, chief or chieftain) which can be trained in your palace/residence at level 10. Additionally you need a certain number of ');
tz_def('ANL_HOW_GET_CULTURE_POINTS', 'How do I get culture points?');
tz_def('ANL_LEVEL', 'Level');
tz_def('ANL_GREAT', 'Great');
tz_def('ANL_CULTURE_POINTS_NEEDED', 'Culture points needed for additional villages');
tz_def('PUBLIC_MAIN_GOALS', 'Objetivos principales:');
tz_def('PUBLIC_TERMS_SHORT', 'Términos');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - sabloane (lot 1: home, server_info, online, users,
// search, ban, notregistered, inactive, report, msg)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_HELLO', 'Hello');
tz_def('ADM_TOTAL_PLAYERS', 'Total Players');
tz_def('ADM_ONLINE_NOW', 'Online Now');
tz_def('ADM_LAST_5_MIN', 'last 5 minutes');
tz_def('ADM_VILLAGES', 'Villages');
tz_def('ADM_GOLD_IN_GAME', 'Gold in Game');
tz_def('ADM_ACTIVE_BANS', 'Active Bans');
tz_def('ADM_MANAGE', 'manage');
tz_def('ADM_LAST_REGISTRATION', 'Last Registration');
tz_def('ADM_SERVER_CLOCK', 'Server Clock');
tz_def('ADM_SERVER_TIMELINE', 'Server Timeline');
tz_def('ADM_START_DATE', 'Start Date:');
tz_def('ADM_NATARS_C', 'Natars:');
tz_def('ADM_ARTEFACTS_C', 'Artefacts:');
tz_def('ADM_WW_PLANS_C', 'WW Plans:');
tz_def('ADM_SERVER_AGE', 'Server Age:');
tz_def('ADM_NEXT_EVENT', 'Next Event:');
tz_def('ADM_LAST_5_ACTIONS', 'Last 5 Admin Actions');
tz_def('ADM_VIEW_FULL_LOG', 'view full log →');
tz_def('ADM_QUICK_ACTIONS', 'Quick Actions');
tz_def('ADM_QA_SEARCH', '🔍 Search Player');
tz_def('ADM_QA_BAN', '🔨 Ban Manager');
tz_def('ADM_QA_MAP', '🗺 Map');
tz_def('ADM_QA_NATARS', '🏰 Natars');
tz_def('ADM_QA_ADD_USER', '👤 Add User');
tz_def('ADM_QA_SERVER_INFO', '⚙ Server Info');
tz_def('ADM_WORLD_INFO', '🌍 World Information');
tz_def('ADM_REGISTERED_PLAYERS', 'Registered players');
tz_def('ADM_ACTIVE_PLAYERS', 'Active players');
tz_def('ADM_PLAYERS_ONLINE', 'Players online');
tz_def('ADM_PLAYERS_BANNED', 'Players banned');
tz_def('ADM_VILLAGES_SETTLED', 'Villages settled');
tz_def('ADM_TOTAL_POPULATION', 'Total population');
tz_def('ADM_PLAYER_DISTRIBUTION', '👥 Player Distribution');
tz_def('ADM_SERVER_ECONOMY', '💰 Server Economy');
tz_def('ADM_TOTAL_GOLD', 'Total Gold');
tz_def('ADM_AVG_GOLD', 'Avg Gold/player');
tz_def('ADM_SERVER_STARTED', 'Server started');
tz_def('ADM_UPTIME', 'Uptime');
tz_def('ADM_TROOPS_ON_SERVER', '⚔️ Troops on Server (villages + reinforcements)');
tz_def('ADM_ONLINE_USERS_H', '🟢 Online Users');
tz_def('ADM_NO_ONLINE_USERS', 'No online users in last 5 minutes');
tz_def('ADM_USERS_H', '👥 Users');
tz_def('ADM_ALL', 'All');
tz_def('ADM_ADMINS', 'Admins');
tz_def('ADM_NORMAL', 'Normal');
tz_def('ADM_BANNED', 'Banned');
tz_def('ADM_ONLINE', 'Online');
tz_def('ADM_ID', 'ID');
tz_def('ADM_USERNAME', 'Username');
tz_def('ADM_EMAIL', 'Email');
tz_def('ADM_ACCESS', 'Access');
tz_def('ADM_TRIBE', 'Tribe');
tz_def('ADM_GOLD', 'Gold');
tz_def('ADM_LAST_ACTIVITY', 'Last Activity');
tz_def('ADM_PREV', '« Prev');
tz_def('ADM_NEXT', 'Next »');
tz_def('ADM_SEARCH_PH', 'Search...');
tz_def('ADM_ADMIN_SEARCH', 'Admin Search');
tz_def('ADM_SEARCH_HINT', 'Enter name, ID, email or IP...');
tz_def('ADM_SEARCH_BTN', 'Search');
tz_def('ADM_BAN_MANAGEMENT', 'Ban Management');
tz_def('ADM_ACTIVE_USER_BANS', 'Active User Bans');
tz_def('ADM_ACTIVE_IP_BANS', 'Active IP Bans');
tz_def('ADM_HISTORY_50', 'History (last 50)');
tz_def('ADM_ADD_NEW_BAN', 'Add New Ban');
tz_def('ADM_FOREVER', 'Forever');
tz_def('ADM_BAN_USER', 'Ban User');
tz_def('ADM_BAN_IP_ADDRESS', 'Ban IP Address');
tz_def('ADM_BAN_IP', 'Ban IP');
tz_def('ADM_BAN_HISTORY', 'Ban History');
tz_def('ADM_USER_ID', 'User ID');
tz_def('ADM_IPV4_OR_IPV6', 'IPv4 or IPv6');
tz_def('ADM_NOT_ACTIVATED_H', '✉️ Players Not Activated');
tz_def('ADM_ACTIVATION_CODE', 'Activation Code');
tz_def('ADM_ACT2', 'Act2');
tz_def('ADM_TIME', 'Time');
tz_def('ADM_SEARCH_USER_EMAIL', 'Search username or email...');
tz_def('ADM_INACTIVE_USERS', 'Inactive Users');
tz_def('ADM_DELETE_L', 'delete');
tz_def('ADM_BACK_TO_REPORTS', '← Back to reports');
tz_def('ADM_REPORT', 'Report');
tz_def('ADM_VIEW_ARROW', 'view →');
tz_def('ADM_BACK_TO_MESSAGES', '← Back to messages');
tz_def('ADM_SENT_TO', 'Sent to');
tz_def('ADM_MESSAGE', 'Message');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - sabloane (lot 2: config, editServerSet, editNewFunctions,
// editCronSet, editPlusSet, editLogSet, editNewsboxSet, editExtraSet)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_CRON_AUTOMATION', 'Cron &amp; Automation');
tz_def('ADM_AUTOMATION_SOURCE', 'Automation source');
tz_def('ADM_WHERE_THE_GAME_TICK_BATTLES_MOVEMENTS_TRAINI', 'Where the game tick (battles, movements, training, construction) is processed from. When the cron job is running, players\' page loads no longer carry the processing.');
tz_def('ADM_LAST_CRON_TICK', 'Last cron tick');
tz_def('ADM_WRITTEN_BY_CRON_PHP_ON_EVERY_TICK_INTO_GAMEE', 'Written by cron.php on every tick into GameEngine/Prevention/cron_active.txt. Under 90 seconds means the cron is alive.');
tz_def('ADM_INVOCATION_LENGTH', 'Invocation length');
tz_def('ADM_CRON_LOOP_SECONDS_HOW_LONG_ONE_CRON_PHP_INVO', 'CRON_LOOP_SECONDS - how long one cron.php invocation keeps running. Hosts that only allow a cron every 5 minutes still get a tick every minute this way. 0 = a single tick per invocation.');
tz_def('ADM_TICK_INTERVAL', 'Tick interval');
tz_def('ADM_CRON_TICK_SECONDS_HOW_OFTEN_AUTOMATION_RUNS', 'CRON_TICK_SECONDS - how often Automation runs inside one invocation. Automation itself expects to run about every 60 seconds.');
tz_def('ADM_HTTP_TRIGGER_KEY', 'HTTP trigger key');
tz_def('ADM_CRON_KEY_ONLY_NEEDED_TO_CALL_CRON_PHP_OVER_H', 'CRON_KEY - only needed to call cron.php over HTTP (external cron service). Running it from the server\'s own cron job does not use this key. Generated automatically at install.');
tz_def('ADM_NOT_SET', 'Not set');
tz_def('ADM_SHOW', 'show');
tz_def('ADM_HTTP_TRIGGER_URL', 'HTTP trigger URL');
tz_def('ADM_OPTIONAL_USE_THIS_WITH_AN_EXTERNAL_CRON_SERV', 'Optional. Use this with an external cron service if the host cannot run a local cron job. One HTTP call = one tick.');
tz_def('ADM_HIDDEN_USE_SHOW_ABOVE', 'hidden &ndash; use "show" above');
tz_def('ADM_DATABASE_CLEANUP', 'Database cleanup');
tz_def('ADM_AUTOMATION_TRIMS_TABLES_THAT_WOULD_OTHERWISE', 'Automation trims tables that would otherwise grow forever. Archived reports are never deleted. 0 disables a rule.');
tz_def('ADM_LAST_CLEANUP_RUN', 'Last cleanup run');
tz_def('ADM_CLEANUP_RUNS_ONCE_PER_HOUR_FROM_AUTOMATION_A', 'Cleanup runs once per hour from Automation and deletes in batches, so a first run on an old server catches up over several passes.');
tz_def('ADM_CRON_JOB_COMMAND', 'Cron job command');
tz_def('ADM_ADD_THIS_IN_CPANEL_CRON_JOBS_THE_PATH_IS_DET', 'Add this in cPanel &rarr; Cron Jobs. The path is detected from this installation.');
tz_def('ADM_CURRENT_STATUS', 'Current status');
tz_def('ADM_WHEN_THE_CRON_JOB_IS_NOT_RUNNING_THE_GAME_ST', 'When the cron job is not running, the game still works: players\' page loads process the tick, exactly as before the cron was introduced.');
tz_def('ADM_ADD_THIS_IN_CPANEL_CRON_JOBS_WRITING_TO_CRON', 'Add this in cPanel &rarr; Cron Jobs. Writing to cron.log instead of /dev/null lets you see errors if it fails to start.');
tz_def('ADM_SETTINGS', 'Settings');
tz_def('ADM_INVOCATION_LENGTH_SECONDS', 'Invocation length (seconds)');
tz_def('ADM_0_A_SINGLE_TICK_PER_INVOCATION_MAXIMUM_3300', '0 = a single tick per invocation. Maximum 3300 (55 minutes).');
tz_def('ADM_TICK_INTERVAL_SECONDS', 'Tick interval (seconds)');
tz_def('ADM_HOW_OFTEN_AUTOMATION_RUNS_INSIDE_ONE_INVOCAT', 'How often Automation runs inside one invocation. Automation\'s own guard expects roughly 60 seconds; going lower mostly adds load without processing anything new.');
tz_def('ADM_RECOMMENDED_60_ALLOWED_RANGE_15_900', 'Recommended: 60. Allowed range 15&ndash;900.');
tz_def('ADM_ONLY_NEEDED_WHEN_CALLING_CRON_PHP_OVER_HTTP', 'Only needed when calling cron.php over HTTP (for example from an external cron service). The server\'s own cron job does not use it. Regenerating invalidates any URL you configured elsewhere.');
tz_def('ADM_GENERATE_A_NEW_KEY_ON_SAVE', 'Generate a new key on save');
tz_def('ADM_RUNS_FROM_AUTOMATION_ONCE_PER_HOUR_ROWS_ARE', 'Runs from Automation once per hour. Rows are removed in batches, so the first run on an old server catches up over several passes.');
tz_def('ADM_BATTLE_REPORTS_DAYS', 'Battle reports (days)');
tz_def('ADM_UNARCHIVED_REPORTS_OLDER_THAN_THIS_ARE_DELET', 'Unarchived reports older than this are deleted. Reports a player archived are never touched. 0 disables the rule.');
tz_def('ADM_0_KEEP_FOREVER', '0 = keep forever.');
tz_def('ADM_CHAT_MESSAGES_DAYS', 'Chat messages (days)');
tz_def('ADM_THE_CHAT_WINDOW_ONLY_EVER_SHOWS_THE_LAST_13', 'The chat window only ever shows the last 13 messages per alliance, so older history is not used anywhere in the game.');
tz_def('ADM_DELETED_MESSAGES_DAYS', 'Deleted messages (days)');
tz_def('ADM_ONLY_MESSAGES_DELETED_BY_BOTH_THE_SENDER_AND', 'Only messages deleted by BOTH the sender and the recipient are removed &mdash; they are no longer visible to anyone in the game. Disabled by default.');
tz_def('ADM_0_DISABLED_DEFAULT', '0 = disabled (default).');
tz_def('ADM_NEW_MECHANICS_AND_FUNCTIONS', 'New Mechanics and Functions');
tz_def('ADM_HERO_BASE_REGENERATION', 'Hero base regeneration');
tz_def('ADM_HIT_POINTS_THE_HERO_RECOVERS_PER_DAY_INDEPEN', 'Hit points the hero recovers per day, independent of the regeneration attribute and of equipped items. 0 disables it.');
tz_def('ADM_HP_DAY', 'HP / day');
tz_def('ADM_HERO_EXCHANGE_RATES', 'Hero exchange rates');
tz_def('ADM_RATES_OF_THE_EXCHANGE_OFFICE_IN_THE_AUCTION', 'Rates of the exchange office in the auction house. The difference between the two directions is the house margin, so trading back and forth loses value instead of creating it.');
tz_def('ADM_EXCHANGE_OFFICE_IN_THE_AUCTION_HOUSE_KEEP_TH', 'Exchange office in the auction house. Keep the second value higher than the first, otherwise players could trade back and forth to create gold out of nothing.');
tz_def('ADM_1_GOLD', '1 gold &rarr;');
tz_def('ADM_SILVER_1_GOLD', 'silver &rarr; 1 gold');
tz_def('ADM_HERO_RESOURCE_PRODUCTION', 'Hero resource production');
tz_def('ADM_OF_ONE_TYPE', 'of one type');
tz_def('ADM_DISPLAY_OASIS_IN_PROFILE', 'Display oasis in profile');
tz_def('ADM_ENABLE_DISABLE_THE_DISPLAY_OF_OASES_OF_EACH', 'Enable (Disable) the display of oases of each village in the player profile');
tz_def('ADM_ALLIANCE_INVITATION_MESSAGE', 'Alliance invitation message');
tz_def('ADM_ENABLE_DISABLE_SENDING_AN_IN_GAME_MESSAGE_TO', 'Enable (Disable) sending an in-game message to the player, if he was invited to the alliance');
tz_def('ADM_NEW_ALLIANCE_EMBASSY_MECHANICS', 'New Alliance & Embassy Mechanics');
tz_def('ADM_NEW_FORUM_POST_MESSAGE', 'New forum post message');
tz_def('ADM_ENABLE_DISABLE_FORUM_SUBSCRIPTION_MESSAGES', 'Enable (Disable) forum subscription messages');
tz_def('ADM_TRIBES_IMAGES_IN_PROFILE', 'Tribes images in profile');
tz_def('ADM_ENABLE_DISABLE_DISPLAYING_IMAGES_OF_TRIBES', 'Enable (Disable) displaying images of tribes');
tz_def('ADM_ENABLE_DISABLE_DISPLAYING_IMAGES_OF_TRIBES_W', 'Enable (Disable) displaying images of tribes with a description in the players profile');
tz_def('ADM_NEW_TRIBE_HUNS', 'New Tribe: Huns');
tz_def('ADM_ENABLE_DISABLE_THE_HUNS_TRIBE', 'Enable (Disable) the Huns tribe');
tz_def('ADM_ENABLE_DISABLE_TRIBE_HUNS', 'Enable (Disable) tribe Huns');
tz_def('ADM_NEW_TRIBE_EGYPTIANS', 'New Tribe: Egyptians');
tz_def('ADM_ENABLE_DISABLE_THE_EGYPTIANS_TRIBE', 'Enable (Disable) the Egyptians tribe');
tz_def('ADM_ENABLE_DISABLE_TRIBE_EGYPTIANS', 'Enable (Disable) tribe Egyptians');
tz_def('ADM_NEW_TRIBE_SPARTANS', 'New Tribe: Spartans');
tz_def('ADM_ENABLE_DISABLE_THE_SPARTANS_TRIBE', 'Enable (Disable) the Spartans tribe');
tz_def('ADM_ENABLE_DISABLE_TRIBE_SPARTANS', 'Enable (Disable) tribe Spartans');
tz_def('ADM_NEW_TRIBE_VIKINGS', 'New Tribe: Vikings');
tz_def('ADM_ENABLE_DISABLE_THE_VIKINGS_TRIBE', 'Enable (Disable) the Vikings tribe');
tz_def('ADM_ENABLE_DISABLE_TRIBE_VIKINGS', 'Enable (Disable) tribe Vikings');
tz_def('ADM_MHS_IMAGES_IN_PROFILE', 'MHs images in profile');
tz_def('ADM_ENABLE_DISABLE_DISPLAYING_IMAGES_OF_MULTIHUN', 'Enable (Disable) displaying images of Multihunters');
tz_def('ADM_ENABLE_DISABLE_DISPLAYING_IMAGES_OF_MULTIHUN_2', 'Enable (Disable) displaying images of Multihunters with a description in the MHs profile');
tz_def('ADM_DISPLAY_ARTIFACT_IN_PROFILE', 'Display artifact in profile');
tz_def('ADM_ENABLE_DISABLE_THE_DISPLAY_OF_THE_ARTIFACT', 'Enable (Disable) the display of the artifact');
tz_def('ADM_ENABLE_DISABLE_THE_DISPLAY_OF_THE_ARTIFACT_I', 'Enable (Disable) the display of the artifact in the player profile, opposite the corresponding village in which it is located');
tz_def('ADM_DISPLAY_WOW_IN_PROFILE', 'Display WoW in profile');
tz_def('ADM_ENABLE_DISABLE_THE_DISPLAY_OF_THE_WONDER', 'Enable (Disable) the display of the wonder');
tz_def('ADM_ENABLE_DISABLE_THE_DISPLAY_OF_THE_WONDER_IN', 'Enable (Disable) the display of the wonder in the player profile, opposite the corresponding village in which it is located');
tz_def('ADM_VACATION_MODE', 'Vacation Mode');
tz_def('ADM_ENABLE_DISABLE_VACATION_MODE', 'Enable (Disable) vacation mode');
tz_def('ADM_ENABLE_DISABLE_VACATION_MODE_WILL_BE_DISPLAY', 'Enable (Disable) vacation mode, will be displayed or hidden in the player profile menu');
tz_def('ADM_CATAPULT_TARGETS', 'Catapult targets');
tz_def('ADM_ENABLE_DISABLE_THE_DISPLAY_OF_CATAPULT_TARGE', 'Enable (Disable) the display of catapult targets');
tz_def('ADM_ENABLE_DISABLE_THE_DISPLAY_OF_THE_TARGETS_OF', 'Enable (Disable) the display of the targets of the catapults in the rally point that were sent by you');
tz_def('ADM_MANUAL_ON_NATURE_AND_NATARS', 'Manual on Nature and Natars');
tz_def('ADM_ENABLE_DISABLE_MANUAL_INFO', 'Enable (Disable) manual info');
tz_def('ADM_ENABLE_DISABLE_DISPLAYING_INFORMATION_IN_THE', 'Enable (Disable) displaying information in the Manual about the troops of Nature and Natars');
tz_def('ADM_DIRECT_LINKS_PLACEMENT', 'Direct links placement');
tz_def('ADM_LEFT_MENU_VS_RIGHT_MENU', 'Left menu vs right menu');
tz_def('ADM_IF_ENABLED_THEN_THE_DIRECT_LINKS_WILL_BE_PLA', 'If Enabled, then the Direct links will be placed in the left menu, if Disabled then Direct links will be placed in the right menu as in the original Travian');
tz_def('ADM_MEDAL_VETERAN_PLAYER', 'Medal Veteran Player');
tz_def('ADM_3_YEARS', '3 years');
tz_def('ADM_ENABLE_DISABLE_MEDAL_ACHIEVED_FOR_PLAYING_3', 'Enable (Disable) medal achieved for playing 3 years of Travian');
tz_def('ADM_MEDAL_VETERAN_PLAYER_5A', 'Medal Veteran Player 5a');
tz_def('ADM_5_YEARS', '5 years');
tz_def('ADM_ENABLE_DISABLE_MEDAL_ACHIEVED_FOR_PLAYING_5', 'Enable (Disable) medal achieved for playing 5 years of Travian');
tz_def('ADM_MEDAL_VETERAN_PLAYER_10A', 'Medal Veteran Player 10a');
tz_def('ADM_10_YEARS', '10 years');
tz_def('ADM_ENABLE_DISABLE_MEDAL_ACHIEVED_FOR_PLAYING_10', 'Enable (Disable) medal achieved for playing 10 years of Travian');
tz_def('ADM_SPECIAL_MEDALS', 'Special Medals');
tz_def('ADM_ENABLE_DISABLE_SPECIAL_MEDALS_ARTIFACT_HERO', 'Enable (Disable) special medals (artifact, hero, ww, wall, great store, etc.)');
tz_def('ADM_SERVER_MILESTONES', 'Server Milestones');
tz_def('ADM_NOT_PRESENT_IN_CONFIG_PHP_YET_SAVING_THIS_FO', 'Not present in config.php yet &mdash; saving this form once will add it (defaults to False until then).');
tz_def('ADM_SERVER_MEDAL_RESET_TIMER', 'Server Medal Reset Timer');
tz_def('ADM_ENABLE_DISABLE_THE_SERVER_MEDAL_RESET_TIMER', 'Enable (Disable) the "Server Medal Reset Timer" widget in Player Top 10 and Alliance Top 10');
tz_def('ADM_T4_HERO_ITEMS_ADVENTURES_AUCTION', 'T4 Hero (items, adventures, auction)');
tz_def('ADM_ENABLE_DISABLE_THE_T4_HERO_ITEMS_ADVENTURES', 'Enable (Disable) the "T4 Hero (items, adventures, auction)" System');
tz_def('ADM_REGISTRATION_BONUS_GOLD', 'Registration Bonus Gold');
tz_def('ADM_GIVE_EVERY_NEWLY_REGISTERED_PLAYER_A_ONE_TIM', 'Give every newly registered player a one-time gold bonus at account creation');
tz_def('ADM_REGISTRATION_BONUS_GOLD_AMOUNT', 'Registration Bonus Gold &ndash; amount');
tz_def('ADM_HOW_MUCH_GOLD_EACH_NEW_PLAYER_RECEIVES_WHEN', 'How much gold each new player receives when the bonus is enabled');
tz_def('ADM_ENABLE_DISABLE_A_ONE_TIME_GOLD_BONUS_GRANTED', 'Enable (Disable) a one-time gold bonus granted to every newly registered player at account creation (system accounts id&le;3 are skipped). The amount is set in the field below.');
tz_def('ADM_HOW_MUCH_GOLD_EACH_NEW_PLAYER_RECEIVES_WHEN_2', 'How much gold each new player receives when the toggle above is True. Default: 200.');
tz_def('ADM_FOR_THIS_SETTING_YOU_CAN_FIND_MORE_INFORMATI', 'For this setting, you can find more information on the link:');
tz_def('ADM_EDIT_CRON_AUTOMATION', 'Edit Cron &amp; Automation');
tz_def('ADM_EDIT_NEW_MECHANICS_AND_FUNCTIONS', 'Edit New Mechanics and Functions');
tz_def('ADM_ENGLISH', 'English');
tz_def('ADM_FRENCH', 'French');
tz_def('ADM_ITALIAN', 'Italian');
tz_def('ADM_ROMANIAN', 'Romanian');
tz_def('ADM_SPANISH', 'Espanol');
tz_def('ADM_CHINESE', 'Chinese');
tz_def('ADM_SLOW', 'Slow');
tz_def('ADM_FAST', 'Fast');
tz_def('ADM_2_HOURS', '2 hours');
tz_def('ADM_3_HOURS', '3 hours');
tz_def('ADM_5_HOURS', '5 hours');
tz_def('ADM_8_HOURS', '8 hours');
tz_def('ADM_10_HOURS', '10 hours');
tz_def('ADM_12_HOURS', '12 hours');
tz_def('ADM_16_HOURS', '16 hours');
tz_def('ADM_20_HOURS', '20 hours');
tz_def('ADM_24_HOURS_1_DAY', '24 hours (1 day)');
tz_def('ADM_48_HOURS_2_DAYS', '48 hours (2 days)');
tz_def('ADM_72_HOURS_3_DAYS', '72 hours (3 days)');
tz_def('ADM_120_HOURS_5_DAYS', '120 hours (5 days)');
tz_def('ADM_TRUE', 'True');
tz_def('ADM_FALSE', 'False');
tz_def('ADM_YES', 'Yes');
tz_def('ADM_NO', 'No');
tz_def('ADM_TRAVIAN_OFFICIAL', 'Travian Official');
tz_def('ADM_TRAVIANZ_EXTENDED', 'TravianZ Extended');
tz_def('ADM_10_DEFAULT', '10 - Default');
tz_def('ADM_NONE', 'none');
tz_def('ADM_1_DAY', '1 day');
tz_def('ADM_2_DAYS', '2 days');
tz_def('ADM_3_DAYS', '3 days');
tz_def('ADM_4_DAYS', '4 days');
tz_def('ADM_5_DAYS', '5 days');
tz_def('ADM_6_DAYS', '6 days');
tz_def('ADM_7_DAYS', '7 days');
tz_def('ADM_NONE_2', 'None');
tz_def('ADM_CHRISTMAS', 'Christmas');
tz_def('ADM_NEW_YEAR', 'New Year');
tz_def('ADM_EASTER', 'Easter');
tz_def('ADM_ENABLE', 'Enable');
tz_def('ADM_DISABLE', 'Disable');
tz_def('ADM_SAVE', 'SAVE');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - sabloane (lot 3: player, editHero, editHeroT4,
// playerheroinfo, village, troops, editVillage, editUser, deletion, editSitter)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_START', 'Start');
tz_def('ADM_END', 'End');
tz_def('ADM_DURATION', 'Duration');
tz_def('ADM_REASON', 'Reason');
tz_def('ADM_PLAYER', 'Player:');
tz_def('ADM_BASIC_INFO', '📝 Basic Info');
tz_def('ADM_HERO_NAME', 'Hero Name');
tz_def('ADM_HERO_UNIT', 'Hero Unit');
tz_def('ADM_HEALTH', '❤ Health');
tz_def('ADM_EXPERIENCE', '✨ Experience');
tz_def('ADM_CURRENT_STATS', '📈 Current Stats');
tz_def('ADM_LEVEL', 'Level:');
tz_def('ADM_OF', 'of');
tz_def('ADM_FREE', '(free:');
tz_def('ADM_OFFENCE', 'Offence:');
tz_def('ADM_DEFENCE', 'Defence:');
tz_def('ADM_OFF_BONUS', 'Off-Bonus:');
tz_def('ADM_DEF_BONUS', '| Def-Bonus:');
tz_def('ADM_REGEN', 'Regen:');
tz_def('ADM_RESOURCES', 'Resources:');
tz_def('ADM_ADD_POINTS', '⚔ Add Points');
tz_def('ADM_ATTRIBUTE', 'Attribute');
tz_def('ADM_CURRENT', 'Current');
tz_def('ADM_ADD', 'Add');
tz_def('ADM_NEW', 'New');
tz_def('ADM_PRODUCED_RESOURCE', 'Produced resource');
tz_def('ADM_LEVEL_NOU', 'Level nou:');
tz_def('ADM_BACK', '← Back');
tz_def('ADM_SAVE_HERO', '💾 Save Hero');
tz_def('ADM_CLASSIC_HERO_EDITOR', '&laquo; classic hero editor');
tz_def('ADM_ACTION_COMPLETED', 'Action completed.');
tz_def('ADM_ACTION_FAILED_CHECK_THE_VALUES_AND_TRY_AGAIN', 'Action failed (check the values and try again).');
tz_def('ADM_SILVER', 'Silver');
tz_def('ADM_SET_BALANCE', 'Set balance');
tz_def('ADM_GRANT_ITEM', 'Grant item');
tz_def('ADM_QTY', 'Qty:');
tz_def('ADM_GRANT', 'Grant');
tz_def('ADM_ROW', 'Row');
tz_def('ADM_ITEM', 'Item');
tz_def('ADM_SLOT', 'Slot');
tz_def('ADM_QTY_2', 'Qty');
tz_def('ADM_EQUIPPED', 'Equipped');
tz_def('ADM_DELETE', 'Delete');
tz_def('ADM_AUCTION', 'Auction');
tz_def('ADM_ROLE', 'Role');
tz_def('ADM_PRICE', 'Price');
tz_def('ADM_ENDS', 'Ends');
tz_def('ADM_CANCEL', 'Cancel');
tz_def('ADM_ADVENTURES', 'Adventures');
tz_def('ADM_RUNNING', 'Running:');
tz_def('ADM_OFFER', 'Offer');
tz_def('ADM_DIFFICULTY', 'Difficulty');
tz_def('ADM_EXPIRES', 'Expires');
tz_def('ADM_REMOVE', 'Remove');
tz_def('ADM_PLAYER_HEROES', 'Player Heroes');
tz_def('ADM_NONE_3', 'None &nbsp;&nbsp;');
tz_def('ADM_ADD_HERO', 'Add Hero');
tz_def('ADM_HERO_LEVEL', 'Hero Level');
tz_def('ADM_STATUS', 'Status');
tz_def('ADM_ALIVE', 'Alive');
tz_def('ADM_DEAD', 'Dead');
tz_def('ADM_DETAILS', 'Details');
tz_def('ADM_POINT', 'Point');
tz_def('ADM_LEVEL_2', 'Level');
tz_def('ADM_OFFENCE_2', 'Offence');
tz_def('ADM_DEFENCE_2', 'Defence');
tz_def('ADM_OFF_BONUS_2', 'Off-Bonus');
tz_def('ADM_DEF_BONUS_2', 'Def-Bonus');
tz_def('ADM_REGENERATION', 'Regeneration');
tz_def('ADM_RESOURCES_2', 'Resources');
tz_def('ADM_HEALTH_2', 'Health');
tz_def('ADM_EDIT', 'Edit');
tz_def('ADM_T4_ITEMS_SILVER_AUCTIONS', 'T4 items / silver / auctions');
tz_def('ADM_KILL', 'Kill');
tz_def('ADM_REVIVE', 'Revive');
tz_def('ADM_VILLAGE_INFORMATION', 'Village Information');
tz_def('ADM_OWNER', 'Owner');
tz_def('ADM_NAME', 'Name');
tz_def('ADM_POPULATION', 'Population');
tz_def('ADM_COORDS', 'Coords');
tz_def('ADM_FIELD', 'Field');
tz_def('ADM_RES', 'Res');
tz_def('ADM_AMT', 'Amt');
tz_def('ADM_CAP', 'Cap');
tz_def('ADM_PROD', 'Prod');
tz_def('ADM_WOOD', 'Wood');
tz_def('ADM_CLAY', 'Clay');
tz_def('ADM_IRON', 'Iron');
tz_def('ADM_CROP', 'Crop');
tz_def('ADM_EXPANSION', 'Expansion');
tz_def('ADM_VILLAGE', 'Village');
tz_def('ADM_POP', 'Pop');
tz_def('ADM_CP', 'CP');
tz_def('ADM_OASIS', 'Oasis');
tz_def('ADM_LOY', 'Loy');
tz_def('ADM_BONUS', 'Bonus');
tz_def('ADM_TROOPS', 'Troops');
tz_def('ADM_UPGRADES', 'Upgrades');
tz_def('ADM_ARTIFACT', 'Artifact');
tz_def('ADM_RESOURCE_FIELDS', 'Resource Fields');
tz_def('ADM_BUILDINGS', 'Buildings');
tz_def('ADM_GID', 'GID');
tz_def('ADM_LVL', 'Lvl');
tz_def('ADM_VILLAGE_BUILD_LOG', 'Village Build Log →');
tz_def('ADM_CHANGE', 'Change');
tz_def('ADM_RENAME', 'Rename');
tz_def('ADM_SHOW_INSTRUCTIONS', 'Show Instructions');
tz_def('ADM_RESOURCE_FIELDS_1_18', 'Resource Fields (1-18)');
tz_def('ADM_VILLAGE_CENTER_19_38', 'Village Center (19-38)');
tz_def('ADM_MODIFY_BUILDINGS', 'Modify Buildings');
tz_def('ADM_SAVE_CHANGES', 'Save Changes');
tz_def('ADM_CURRENT_LAYOUT_PREVIEW', 'Current Layout Preview');
tz_def('ADM_VILLAGE_CENTER', 'Village Center');
tz_def('ADM_EDIT_PLAYER', '✏️ Edit Player:');
tz_def('ADM_ACCOUNT_DETAILS', '👤 Account Details');
tz_def('ADM_USERNAME_2', '👤 Username');
tz_def('ADM_SAVE_2', '💾 Save');
tz_def('ADM_TRIBE_2', '⚔️ Tribe');
tz_def('ADM_1_ROMAN', '1. Roman');
tz_def('ADM_2_TEUTON', '2. Teuton');
tz_def('ADM_3_GAUL', '3. Gaul');
tz_def('ADM_4_NATURE', '4. Nature');
tz_def('ADM_5_NATARS', '5. Natars');
tz_def('ADM_6_HUN', '6. Hun');
tz_def('ADM_7_EGYPTIAN', '7. Egyptian');
tz_def('ADM_8_SPARTAN', '8. Spartan');
tz_def('ADM_9_VIKING', '9. Viking');
tz_def('ADM_LOCATION', '📍 Location');
tz_def('ADM_E_MAIL', '✉️ E-mail');
tz_def('ADM_QUEST', '🎯 Quest');
tz_def('ADM_PROFILE_DESCRIPTION_LEFT', '📝 Profile Description (left)');
tz_def('ADM_PROFILE_DESCRIPTION_RIGHT', '📄 Profile Description (right)');
tz_def('ADM_SUPORT_BBCODE_FOLOSE_TE_ENTER_PENTRU_LINII_N', 'Suport BBCode. Folosește Enter pentru linii noi.');
tz_def('ADM_MEDALS', '🏅 Medals');
tz_def('ADM_CATEGORY', 'Category');
tz_def('ADM_RANK', 'Rank');
tz_def('ADM_WEEK', 'Week');
tz_def('ADM_BB_CODE', 'BB-Code');
tz_def('ADM_BEGINNERS_PROTECTION', 'Beginners Protection');
tz_def('ADM_SAVE_CHANGES_2', '💾 Save Changes');
tz_def('ADM_GO_BACK_TO_PLAYER', '« Go back to player');
tz_def('ADM_CHANGE_USERNAME', 'Change Username');
tz_def('ADM_DELETE_PLAYER_PERMANENTLY', 'DELETE PLAYER PERMANENTLY');
tz_def('ADM_THIS_ACTION_CANNOT_BE_UNDONE', 'This action cannot be undone!');
tz_def('ADM_PLAYER_TO_DELETE', '🗑️ Player to delete');
tz_def('ADM_PLUS_ENDS', 'Plus ends');
tz_def('ADM_WARNING', 'WARNING:');
tz_def('ADM_PERMANENTLY', 'permanently');
tz_def('ADM_DELETED_THERE_IS_NO_RECOVERY', 'deleted. There is no recovery!');
tz_def('ADM_CONFIRM_WITH_YOUR_ADMIN_PASSWORD', 'Confirm with your admin password:');
tz_def('ADM_CANCEL_2', '← Cancel');
tz_def('ADM_DELETE_PLAYER', '🗑️ DELETE PLAYER');
tz_def('ADM_EDIT_SITTERS', 'Edit Sitters:');
tz_def('ADM_SITTER_SETTINGS', '⚙️ Sitter Settings');
tz_def('ADM_USE_THE_PLAYER_S_UID_ENTER', '💡 Use the player\'s UID. Enter');
tz_def('ADM_TO_DELETE_THE_SITTER_YOU_CAN_FIND_THE_UID_IN', 'to delete the sitter. You can find the UID in Search.');
tz_def('ADM_SITTER_1', '👤 Sitter 1');
tz_def('ADM_SITTER_2', '👤 Sitter 2');
tz_def('ADM_SAVE_SITTERS', '💾 Save Sitters');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - sabloane (lot 4: gold, usergold, givePlus, givePlusRes,
// punish, maintenance, resetServer, cleanban, massmessage, sysmessage)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_GOLD_MANAGEMENT', 'Gold Management');
tz_def('ADM_GIVE_EVERYONE_FREE_GOLD', 'Give Everyone Free Gold');
tz_def('ADM_THIS_GOLD_WILL_BE_ADDED_TO_ALL_ACTIVE_PLAYER', 'This gold will be added to ALL active players on the server.');
tz_def('ADM_GIVE_GOLD', 'Give Gold');
tz_def('ADM_GOLD_HAS_BEEN_SUCCESSFULLY_ADDED_TO_ALL_PLAY', '✓ Gold has been successfully added to all players!');
tz_def('ADM_USER_GOLD', 'User Gold');
tz_def('ADM_GIVE_GOLD_TO_SPECIFIC_PLAYER', 'Give Gold to Specific Player');
tz_def('ADM_ADD_GOLD_ONLY_FOR_SINGLE_ACCOUNT_AFTER_ID', 'Add gold only for single account (after ID).');
tz_def('ADM_AMOUNT_GOLD', 'Amount Gold');
tz_def('ADM_GOLD_SUCCESSFULLY_ADDED_FOR_USER', '✓ Gold successfully added for user!');
tz_def('ADM_PLUS_MANAGEMENT', 'Plus Management');
tz_def('ADM_GIVE_EVERYONE_FREE_PLUS', 'Give Everyone Free Plus');
tz_def('ADM_ACTIVATE_TRAVIAN_PLUS_FOR_ALL_PLAYERS_ON_THE', 'Activate Travian Plus for ALL players on the server.');
tz_def('ADM_DAYS', 'Days');
tz_def('ADM_GIVE_PLUS', 'Give Plus');
tz_def('ADM_PLUS_HAS_BEEN_SUCCESSFULLY_ACTIVATED_FOR_ALL', '✓ Plus has been successfully activated for all players!');
tz_def('ADM_RESOURCE_BONUS', 'Resource Bonus');
tz_def('ADM_GIVE_EVERYONE_RESOURCE_BONUS', 'Give Everyone Resource Bonus');
tz_def('ADM_ACTIVATE_A_25_BONUS_FOR_ALL_RESOURCES_FOR_AL', 'Activate a 25% bonus for all resources for ALL players.');
tz_def('ADM_DAYS_2', 'days');
tz_def('ADM_GIVE_RESOURCE_BONUS', 'Give Resource Bonus');
tz_def('ADM_RESOURCE_BONUSES_HAVE_BEEN_ACTIVATED_FOR_ALL', '✓ Resource bonuses have been activated for all players!');
tz_def('ADM_PUNISH_PLAYER', 'Punish Player');
tz_def('ADM_OK', 'OK');
tz_def('ADM_DELETE_TROOPS', 'Delete Troops');
tz_def('ADM_EMPTY_WAREHOUSES', 'Empty Warehouses');
tz_def('ADM_STARTED_BY', 'Started by:');
tz_def('ADM_UID', '(UID:');
tz_def('ADM_ENABLE_MAINTENANCE', 'Enable maintenance');
tz_def('ADM_DISABLE_MAINTENANCE', 'Disable maintenance');
tz_def('ADM_STOP', 'Stop');
tz_def('ADM_SERVER_RESETTING', '⚠️ Server Resetting');
tz_def('ADM_WARNING_IRREVERSIBLE_ACTION', 'WARNING! Irreversible action');
tz_def('ADM_THIS_OPERATION_WILL_DELETE_ALL_DATA_PLAYERS', 'This operation will delete ALL data: players, watches, allies, reports. The server will be reset for a new game.');
tz_def('ADM_THIS_SERVER_WILL_BE_RESET_TO_CREATE_NEW_GAME', 'This server will be reset to create new game server.');
tz_def('ADM_CLICK_BUTTON', 'Click button');
tz_def('ADM_RESET', 'Reset');
tz_def('ADM_TO_PROCEED', 'to proceed.');
tz_def('ADM_PLEASE_WAIT_WHILE_THE_SERVER_IS_BEING_RESET', 'Please wait... while the server is being reset');
tz_def('ADM_BACK_2', '« Back');
tz_def('ADM_RESET_SERVER', 'Reset Server');
tz_def('ADM_CLEAR_BANLIST_DATA', 'Clear – Banlist - Data');
tz_def('ADM_TRUNCATE', '(TRUNCATE)');
tz_def('ADM_CLEAN', 'Clean');
tz_def('ADM_SEND_MESSAGE_TO_ALL_PLAYERS', 'Send Message to All Players');
tz_def('ADM_CONFIRM', 'Confirm:');
tz_def('ADM_ARE_YOU_SURE_YOU_WANT_TO_SEND', 'Are you sure you want to send?');
tz_def('ADM_SUBJECT', 'Subject:');
tz_def('ADM_YES_SEND', '✓ Yes, Send');
tz_def('ADM_SENDING_MESSAGES', 'Sending messages...');
tz_def('ADM_SUBJECT_2', 'Subject');
tz_def('ADM_MESSAGE_COLOR', 'Message Color');
tz_def('ADM_MESSAGE_CONTENT', 'Message Content');
tz_def('ADM_CONTINUA', 'Continua');
tz_def('ADM_MASS_MESSAGE_SUCCESSFULLY_SENT_TO_ALL_PLAYER', '✓ Mass message successfully sent to all players!');
tz_def('ADM_EX_MAINTENANCE', 'ex: Maintenance');
tz_def('ADM_BLACK_SAU_E67E22', 'black sau #e67e22');
tz_def('ADM_WRITE_THE_MESSAGE_YOU_CAN_USE_URL_IMG', 'Write the message... you can use [url][img]');
tz_def('ADM_CONFIRMARE_SYSTEM_MESSAGE', 'Confirmare system message');
tz_def('ADM_COLOR', 'Color:');
tz_def('ADM_SEND_SYSTEM_MESSAGE', '✓ Send System Message');
tz_def('ADM_SENDING_SYSTEM_MESSAGE', 'Sending system message...');
tz_def('ADM_COLOR_2', 'Color');
tz_def('ADM_CONTINUE', 'Continue');
tz_def('ADM_SYSTEM_MESSAGE_SENT_SUCCESSFULLY', '✓ System message sent successfully');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - sabloane (lot 5: alliance, editAli, delAli, allymedals,
// delallymedal, playermedals, delmedal, admin_log, debug_log, techlog)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_FOUNDER', '👑 Founder:');
tz_def('ADM_MEMBERS', '👥 Members:');
tz_def('ADM_POINTS', '🏆 Points:');
tz_def('ADM_ALLIANCE_DETAILS', '📋 Alliance Details');
tz_def('ADM_TAG', 'Tag');
tz_def('ADM_POINTS_2', 'Points');
tz_def('ADM_CAPACITY', 'Capacity');
tz_def('ADM_ALLIANCE_POSITIONS', '🛡 Alliance Positions');
tz_def('ADM_EDIT_ALLIANCE', '✏ Edit Alliance');
tz_def('ADM_DELETE_2', '🗑 Delete');
tz_def('ADM_ALLIANCE_DESCRIPTION', '📖 Alliance Description');
tz_def('ADM_ALLIANCE_NOTICE', '📢 Alliance Notice');
tz_def('ADM_PLAYER_2', 'Player');
tz_def('ADM_ALLIANCE_NEWS', '📰 Alliance News');
tz_def('ADM_EVENT', 'Event');
tz_def('ADM_DIPLOMACY', '🤝 Diplomacy');
tz_def('ADM_TYPE', 'Type');
tz_def('ADM_EDIT_ALLIANCE_2', '✏️ Edit Alliance:');
tz_def('ADM_BASIC_SETTINGS', '⚙️ Basic Settings');
tz_def('ADM_ALLIANCE_TAG_MAX_8', 'Alliance Tag (max 8)');
tz_def('ADM_ALLIANCE_NAME', 'Alliance Name');
tz_def('ADM_LEADER_FOUNDER', '👑 Leader (Founder)');
tz_def('ADM_SCHIMB_FONDATORUL_ALIAN_EI', 'Schimbă fondatorul alianței');
tz_def('ADM_MAX_MEMBERS', '👥 Max Members');
tz_def('ADM_ALLIANCE_NOTICE_APARE_SUS', '📢 Alliance Notice (apare sus)');
tz_def('ADM_ALLIANCE_DESCRIPTION_PAGINA_PUBLIC', '📖 Alliance Description (pagina publică)');
tz_def('ADM_SAVE_ALLIANCE', '💾 Save Alliance');
tz_def('ADM_MESAJ_SCURT_PENTRU_MEMBRI', 'Mesaj scurt pentru membri...');
tz_def('ADM_DESCRIERE_LUNG_BBCODE_PERMIS', 'Descriere lungă, BBCode permis...');
tz_def('ADM_DELETE_ALLIANCE', '🗑 Delete Alliance');
tz_def('ADM_ARE_YOU_SURE_YOU_WANT_TO_PERMANENTLY_DELETE', 'Are you sure you want to permanently delete?:');
tz_def('ADM_MEMBERS_2', 'Members:');
tz_def('ADM_POINTS_3', '| Points:');
tz_def('ADM_ALL_MEMBERS_WILL_BE_REMOVED_FROM_THE_ALLIANC', '⚠ All members will be removed from the alliance, permissions, diplomacy, logs and the alliance forum will be deleted. The action is irreversible!');
tz_def('ADM_YES_DELETE', 'YES, DELETE');
tz_def('ADM_MEDAL', 'Medal');
tz_def('ADM_THIS_ALLIANCE_HAS_NO_MEDALS_YET', 'This alliance has no medals yet');
tz_def('ADM_AVERAGE_RANK', 'Average Rank');
tz_def('ADM_DELETE_ALL', 'Delete All');
tz_def('ADM_MEDAL_INFORMATION', 'Medal Information');
tz_def('ADM_MEDALS_2', 'Medals');
tz_def('ADM_MEDAL_WEEK_BY_WEEK', 'Medal Week by Week');
tz_def('ADM_CATEGORY_2', 'CATEGORY');
tz_def('ADM_RANK_2', 'RANK');
tz_def('ADM_WEEK_2', 'WEEK');
tz_def('ADM_POINTS_4', 'POINTS');
tz_def('ADM_MEDAL_2', 'MEDAL');
tz_def('ADM_THIS_PLAYER_HAS_NO_MEDALS_YET', 'This player has no medals yet');
tz_def('ADM_UNIFIED_ADMIN_LOG_LAST_300_ACTIONS', '📋 Unified Admin Log – last 300 actions');
tz_def('ADM_CATEGORIE', 'Categorie');
tz_def('ADM_DETALII', 'Detalii');
tz_def('ADM_DATA', 'Data');
tz_def('ADM_DEBUG_ERROR_LOG', '🐞 Debug Error Log');
tz_def('ADM_CAPTURE_IS', 'Capture is');
tz_def('ADM_AUTO_OFF', 'Auto-off:');
tz_def('ADM_LOG_SIZE', 'Log size:');
tz_def('ADM_TRANSPARENT_TO_PLAYERS_ERRORS_ARE_ONLY_WRITT', 'Transparent to players: errors are only written to the log file, never shown in-game and gameplay is unaffected.');
tz_def('ADM_CAPTURE_SETTINGS', 'Capture settings');
tz_def('ADM_WARNINGS', 'Warnings');
tz_def('ADM_NOTICES', 'Notices');
tz_def('ADM_DEPRECATED', 'Deprecated');
tz_def('ADM_FATAL_ERRORS', 'Fatal errors');
tz_def('ADM_MAX_FILE_SIZE_MB', 'Max file size (MB):');
tz_def('ADM_AUTO_OFF_AFTER_HOURS_0_NEVER', 'Auto-off after (hours, 0 = never):');
tz_def('ADM_SAVE_SETTINGS', 'Save settings');
tz_def('ADM_BEYOND_THE_SIZE_CAP_THE_FILE_IS_ROTATED_TO_A', 'Beyond the size cap the file is rotated to a single');
tz_def('ADM_BACKUP_SO_THE_TOTAL_VOLUME_STAYS_BOUNDED', 'backup, so the total volume stays bounded.');
tz_def('ADM_DOWNLOAD_FULL_LOG', '⬇ Download full log');
tz_def('ADM_CLEAR_LOG', '🗑 Clear log');
tz_def('ADM_REFRESH', '↻ Refresh');
tz_def('ADM_BACK_TO_VILLAGE', '← Back to Village');
tz_def('ADM_RESEARCH_LOG', '— Research Log');
tz_def('ADM_LATEST_200_SEARCHES', 'Latest 200 searches');
tz_def('ADM_NO_REGISTERED_SEARCHES', 'No registered searches.');
tz_def('ADM_TECH', 'TECH');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - sabloane (lot 6: editAccess, editPassword, editProtection,
// editPlus, editWeek, editOverall, editAdditional, results_player/alliances/villages)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_CHANGE_ACCESS', 'Change Access');
tz_def('ADM_NORMAL_USER', 'Normal User');
tz_def('ADM_MULTIHUNTER', 'Multihunter');
tz_def('ADM_GIVE_PLAYERS_FREE_GOLD', 'Give Players Free Gold');
tz_def('ADM_CHANGE_PASSWORD', 'Change Password:');
tz_def('ADM_THE_PASSWORD_IS_CHANGED_INSTANTLY_THE_PLAYER', 'The password is changed instantly. The player will be logged out. No automatic email is sent.');
tz_def('ADM_NEW_PASSWORD', 'New Password');
tz_def('ADM_GENERATE_SECURE_PASSWORD', '🎲 Generate secure password');
tz_def('ADM_CHANGE_PASSWORD_2', '🔐 Change Password');
tz_def('ADM_INTRODU_PAROLA_NOU', 'Introdu parola nouă');
tz_def('ADM_SHOW_HIDE', 'Show/Hide');
tz_def('ADM_PROTECTION', 'Protection:');
tz_def('ADM_CURRENT_STATUS_2', 'Current Status');
tz_def('ADM_1_DAY_2', '+1 day');
tz_def('ADM_3_DAYS_2', '+3 days');
tz_def('ADM_7_DAYS_2', '+7 days');
tz_def('ADM_SET_TO_0_TO_REMOVE_PROTECTION_PROTECTION_IS', '💡 Set to 0 to remove protection. Protection is added from the time of saving.');
tz_def('ADM_SAVE_PROTECTION', '💾 Save Protection');
tz_def('ADM_PLUS_BONUSES', '⭐ Plus & Bonuses:');
tz_def('ADM_THE_VALUES_ADD_UP_PUT_5_TO_ADD_5_DAYS_5_TO_R', 'ℹ️ The values ​​add up. Put 5 to add 5 days, -5 to remove 5 days.');
tz_def('ADM_CURRENT_ACTIVE_BONUSES', '📊 Current Active Bonuses');
tz_def('ADM_ADD_REMOVE_DAYS', '➕ Add / Remove Days');
tz_def('ADM_APPLY_BONUSES', '💾 Apply Bonuses');
tz_def('ADM_WEEKLY_STATS', 'Weekly Stats:');
tz_def('ADM_ACESTEA_SUNT_PUNCTELE', '📊 Acestea sunt punctele');
tz_def('ADM_DIN_S_PT_M_NA_CURENT', 'din săptămâna curentă');
tz_def('ADM_PENTRU_TOP_10_SE_RESETEAZ_AUTOMAT', 'pentru top 10. Se resetează automat.');
tz_def('ADM_ATTACK', 'Attack');
tz_def('ADM_RAID', 'Raid');
tz_def('ADM_SAVE_WEEK', '💾 Save Week');
tz_def('ADM_OVERALL_POINTS', 'Overall Points:');
tz_def('ADM_ACESTEA_SUNT_PUNCTELE_2', '🛡️ Acestea sunt punctele');
tz_def('ADM_TOTALE', 'totale');
tz_def('ADM_DIN_STATISTICI_NU_CELE_S_PT_M_NALE_SE_ADUN_D', 'din statistici (nu cele săptămânale). Se adună din toate atacurile.');
tz_def('ADM_ATTACK_POINTS', 'Attack Points');
tz_def('ADM_DEFENCE_POINTS', 'Defence Points');
tz_def('ADM_SAVE_POINTS', '💾 Save Points');
tz_def('ADM_EDIT_ADDITIONAL', '⚙️ Edit Additional:');
tz_def('ADM_ACCOUNT_CONTROL', '🔐 Account Control');
tz_def('ADM_ACCESS_LEVEL', 'Access Level');
tz_def('ADM_0_BANNED', '0 - Banned');
tz_def('ADM_2_NORMAL_USER', '2 - Normal User');
tz_def('ADM_8_MULTIHUNTER', '8 - Multihunter');
tz_def('ADM_9_ADMIN', '9 - Admin');
tz_def('ADM_VACATION_MODE_2', '🏖 Vacation Mode');
tz_def('ADM_0_DISABLED', '0 - Disabled');
tz_def('ADM_1_ENABLED', '1 - Enabled');
tz_def('ADM_PROTECTION_2', '🛡️ Protection');
tz_def('ADM_ZILE', 'zile');
tz_def('ADM_SITTERS', '👥 Sitters');
tz_def('ADM_SITTER_1_UID', 'Sitter 1 (UID)');
tz_def('ADM_SITTER_2_UID', 'Sitter 2 (UID)');
tz_def('ADM_STATISTICS_POINTS', '📊 Statistics & Points');
tz_def('ADM_CULTURE_POINTS', '🏛️ Culture Points');
tz_def('ADM_ATTACK_POINTS_2', '⚔️ Attack Points');
tz_def('ADM_DEFENCE_POINTS_2', '🛡️ Defence Points');
tz_def('ADM_RESOURCES_RAIDED', '💎 Resources Raided');
tz_def('ADM_TOTAL_ATTACK', '⚔️ Total Attack');
tz_def('ADM_TOTAL_DEFENCE', '🛡️ Total Defence');
tz_def('ADM_GOLD_2', 'gold');
tz_def('ADM_UID_2', 'UID');
tz_def('ADM_PLAYER_3', 'PLAYER');
tz_def('ADM_VILLAGES_2', 'VILLAGES');
tz_def('ADM_POP_2', 'POP');
tz_def('ADM_AID', 'AID');
tz_def('ADM_NAME_2', 'NAME');
tz_def('ADM_TAG_2', 'TAG');
tz_def('ADM_FOUNDER_2', 'FOUNDER');
tz_def('ADM_VILLAGE_NAME', 'VILLAGE NAME');
tz_def('ADM_OWNER_2', 'OWNER');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - sabloane (lot 7: natars, map, map_tile, artifact,
// goldShop, questEditor, multiacc, pushprot, blockReg, heatmap)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_WW_VILLAGES', '🏰 WW Villages');
tz_def('ADM_NUMBER', 'Number');
tz_def('ADM_PLAYER_ID', 'Player ID');
tz_def('ADM_ADD_ARTIFACTS', '✨ Add Artifacts');
tz_def('ADM_ICON', 'Icon');
tz_def('ADM_DELETED_ARTIFACTS', '🗑️ Deleted Artifacts');
tz_def('ADM_EFFECT', 'Effect');
tz_def('ADM_OLD_OWNER', 'Old Owner');
tz_def('ADM_OLD_VILLAGE', 'Old Village');
tz_def('ADM_ARTIFACTS_OVERVIEW', '📊 Artifacts Overview');
tz_def('ADM_RESTORE', 'Restore');
tz_def('ADM_INTERACTIVE_WORLD_MAP_SEARCH_PLAYERS_VILLAGE', 'Interactive world map – search players, villages and artifacts');
tz_def('ADM_PLAYERS', 'Players');
tz_def('ADM_ARTIFACTS', 'Artifacts');
tz_def('ADM_APPLY_FILTERS', 'Apply Filters');
tz_def('ADM_TRIBES', 'Tribes');
tz_def('ADM_MULTIHUNTERS', 'Multihunters');
tz_def('ADM_CHECK_EDIT_MAP_TILE', 'Check & Edit Map Tile');
tz_def('ADM_CHECK_TILE', 'Check Tile');
tz_def('ADM_AREA_OF_EFFECT', 'Area of effect');
tz_def('ADM_TIME_OF_CONQUER', 'Time of conquer');
tz_def('ADM_TIME_OF_ACTIVATION', 'Time of activation');
tz_def('ADM_RETURN_TO_NATARS', 'Return to Natars');
tz_def('ADM_SHOP_PROMO_CODES', 'Shop &amp; Promo Codes');
tz_def('ADM_DIRECTLY', 'directly.');
tz_def('ADM_CREATE_A_CODE', 'Create a code');
tz_def('ADM_CODE', 'Code');
tz_def('ADM_MAX_USES_0', 'Max uses (0 = &infin;)');
tz_def('ADM_EXPIRES_IN_DAYS_0_NEVER', 'Expires in (days, 0 = never)');
tz_def('ADM_ONCE_PER_PLAYER', 'once per player');
tz_def('ADM_NOTE_OPTIONAL', 'Note (optional)');
tz_def('ADM_CREATE', 'Create');
tz_def('ADM_CODES_ARE_CASE_INSENSITIVE_ALLOWED_CHARACTER', 'Codes are case-insensitive; allowed characters: A-Z 0-9 . _ &ndash;');
tz_def('ADM_NO_PROMO_CODES_YET', 'No promo codes yet.');
tz_def('ADM_USES', 'Uses');
tz_def('ADM_SCOPE', 'Scope');
tz_def('ADM_NOTE', 'Note');
tz_def('ADM_RECENT_REDEMPTIONS', 'Recent redemptions');
tz_def('ADM_NO_REDEMPTIONS_YET', 'No redemptions yet.');
tz_def('ADM_WHEN', 'When');
tz_def('ADM_REASON_CAMPAIGN', 'reason / campaign');
tz_def('ADM_QUEST_2', 'Quest');
tz_def('ADM_EDITOR', 'Editor');
tz_def('ADM_QTYP_37', 'qtyp&nbsp;37');
tz_def('ADM_GET', 'get');
tz_def('ADM_EXTENDED', 'extended');
tz_def('ADM_EVERYONE_ELSE', ', everyone else');
tz_def('ADM_STANDARD', 'standard');
tz_def('ADM_REWARD_VALUES_ARE_LIVE_VIA', 'Reward values are live via');
tz_def('ADM_FIXED', 'fixed');
tz_def('ADM_STANDARD_QUEST_CORE25', 'Standard (quest_core25)');
tz_def('ADM_EXTENDED_QUEST_CORE', 'Extended (quest_core)');
tz_def('ADM_ON', 'On');
tz_def('ADM_PLUS_DAYS', 'Plus (days)');
tz_def('ADM_REQ_LEVEL', 'Req.&nbsp;level');
tz_def('ADM_QUEST_HOVER', 'Quest (hover)');
tz_def('ADM_SAVE_ALL_CHANGES', 'Save all changes');
tz_def('ADM_SAVES_EVERY_ROW_FOR_THE', 'Saves every row for the');
tz_def('ADM_VARIANT', 'variant.');
tz_def('ADM_RESET_THIS_VARIANT_TO_DEFAULTS', 'Reset this variant to defaults');
tz_def('ADM_MULTI_ACCOUNT', 'Multi-Account');
tz_def('ADM_DETECTION', 'Detection');
tz_def('ADM_RISK_SCORE_NOT_PROOF', 'risk score, not proof');
tz_def('ADM_WINDOW_DAYS', 'Window (days)');
tz_def('ADM_MIN_SCORE', 'Min score');
tz_def('ADM_FOCUS_ON_UID_OPTIONAL', 'Focus on UID (optional)');
tz_def('ADM_ANALYSE', 'Analyse');
tz_def('ADM_NO_ACCOUNT_PAIRS_AT_OR_ABOVE_THE_CURRENT_SCO', 'No account pairs at or above the current score threshold.');
tz_def('ADM_RISK', 'Risk');
tz_def('ADM_ACCOUNT_A', 'Account A');
tz_def('ADM_ACCOUNT_B', 'Account B');
tz_def('ADM_WHY', 'Why');
tz_def('ADM_LOGIN_LOG', 'login log');
tz_def('ADM_FOCUS', 'focus');
tz_def('ADM_RESET_2', 'reset');
tz_def('ADM_DASHBOARD', 'Dashboard');
tz_def('ADM_PER_PLAYER', 'Per-player');
tz_def('ADM_7_DAY_RESOURCE_BALANCE', '7-day resource balance');
tz_def('ADM_HOURS_OF_PROD_ALLOWED', 'Hours of prod. allowed');
tz_def('ADM_SHOW_2', 'Show');
tz_def('ADM_ALL_WITH_ACTIVITY', 'All with activity');
tz_def('ADM_OVER_LIMIT_ONLY', 'Over limit only');
tz_def('ADM_WW_ARTEFACT_OVERRIDDEN', 'WW / artefact / overridden');
tz_def('ADM_REFRESH_2', 'Refresh');
tz_def('ADM_NO_INTER_PLAYER_TRANSFERS_RECORDED_IN_THIS_W', 'No inter-player transfers recorded in this window yet.');
tz_def('ADM_VILLAGES_POP', 'Villages / Pop');
tz_def('ADM_PROD_H', 'Prod/h');
tz_def('ADM_RECEIVED_7D', 'Received (7d)');
tz_def('ADM_LIMIT', 'Limit');
tz_def('ADM_USAGE', 'Usage');
tz_def('ADM_OVERRIDE', 'Override');
tz_def('ADM_AUTO', 'Auto');
tz_def('ADM_CUSTOM_CAP', 'Custom cap');
tz_def('ADM_SAVE_3', 'Save');
tz_def('ADM_REGISTRATION', 'Registration');
tz_def('ADM_BLOCKLIST', 'Blocklist');
tz_def('ADM_BLOCK_NEW_REGISTRATIONS_BY_A_SPECIFIC', 'Block new registrations by a specific');
tz_def('ADM_USERNAME_3', 'username');
tz_def('ADM_A_SPECIFIC', ', a specific');
tz_def('ADM_OR_A_WHOLE', ', or a whole');
tz_def('ADM_E_MAIL_DOMAIN', 'e-mail domain');
tz_def('ADM_ADD_A_BLOCK', 'Add a block');
tz_def('ADM_E_MAIL_ADDRESS', 'E-mail address');
tz_def('ADM_E_MAIL_DOMAIN_2', 'E-mail domain');
tz_def('ADM_VALUE', 'Value');
tz_def('ADM_ADD_BLOCK', 'Add block');
tz_def('ADM_DOMAIN_ENTER_JUST_THE_DOMAIN', 'Domain: enter just the domain (');
tz_def('ADM_NO_REGISTRATION_BLOCKS_YET', 'No registration blocks yet.');
tz_def('ADM_ADDED', 'Added');
tz_def('ADM_REASON_2', 'reason');
tz_def('ADM_REMOVE_2', 'remove');
tz_def('ADM_WORLD_MAP', 'World Map');
tz_def('ADM_HEATMAP', 'Heatmap');
tz_def('ADM_GRID_RESOLUTION', 'Grid resolution');
tz_def('ADM_INACTIVE_AFTER_DAYS', 'Inactive after (days)');
tz_def('ADM_REBUILD', 'Rebuild');
tz_def('ADM_VILLAGE_DENSITY', 'Village density');
tz_def('ADM_TRIBE_DENSITY', 'Tribe density');
tz_def('ADM_INACTIVITY', 'Inactivity');
tz_def('ADM_ATTACKS', 'Attacks');
tz_def('ADM_SUMMARY', 'Summary');
tz_def('ADM_PLAYER_VILLAGES', 'Player villages');
tz_def('ADM_INACTIVE_VILLAGES', 'Inactive villages');
tz_def('ADM_ATTACKS_IN_FLIGHT', 'Attacks in flight');
tz_def('ADM_LEGEND', 'Legend');
tz_def('ADM_TRIBE_TOTALS', 'Tribe totals');
tz_def('ADM_NO_PLAYER_VILLAGES_FOUND', 'No player villages found.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - sabloane (lot 8, final: restul de 26 de sabloane)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_404_FILE_NOT_FOUND', '404 - File not found');
tz_def('ADM_WE_LOOKED_404_TIMES_ALREADY_BUT_CAN_T_FIND_A', 'We looked 404 times already but can\'t find anything, Not even an X marking the spot.');
tz_def('ADM_THIS_SYSTEM_IS_NOT_COMPLETE_YET_SO_THE_PAGE', 'This system is not complete yet. So the page probably does not exist.');
tz_def('ADM_NOT_FOUND', 'Not Found');
tz_def('ADM_NEW_MESSAGE', 'New Message');
tz_def('ADM_TO', 'to');
tz_def('ADM_RECIPIENT', 'Recipient');
tz_def('ADM_SEND_MESSAGE', 'Send Message');
tz_def('ADM_PLAYER_NOT_FOUND', 'Player not found.');
tz_def('ADM_GO_BACK', 'Go Back');
tz_def('ADM_MESSAGE_FROM_ADMIN', 'Message From Admin');
tz_def('ADM_WRITE_YOUR_MESSAGE_HERE', 'Write your message here...');
tz_def('ADM_TROOP', 'Troop');
tz_def('ADM_ARMOURY', 'Armoury');
tz_def('ADM_BLACKSMITH', 'Blacksmith');
tz_def('ADM_BACK_3', 'Back');
tz_def('ADM_NOW', 'Now:');
tz_def('ADM_CREATE_USERS', '👤 Create Users');
tz_def('ADM_SUBMITTING_THIS_FORM_WILL_CREATE_NEW_USERS_A', 'Submitting this form will create new Users and/or Villages on your server!');
tz_def('ADM_MANY_ACCOUNTS_1_VILLAGE', 'Many accounts (1 village)');
tz_def('ADM_1_ACCOUNT_MANY_VILLAGES', '1 account (many villages)');
tz_def('ADM_BASE_NAME', 'Base Name');
tz_def('ADM_4_20_CHARACTERS_EX_FARM_5_FARM1_FARM5_SINGLE', '4-20 characters. Ex: Farm | 5 → Farm1..Farm5. Single ex: FarmLord | 5 villages.');
tz_def('ADM_WARNING_2', 'Warning:');
tz_def('ADM_LARGE_VALUES_MAY_FREEZE_THE_SERVER', 'large values may freeze the server!');
tz_def('ADM_HOW_MANY_ACCOUNTS', 'How many accounts');
tz_def('ADM_HOW_MANY_VILLAGES', 'How many villages');
tz_def('ADM_1_200_SINGLE_ONLY', '1 - 200 (single only)');
tz_def('ADM_ENABLE_BEGINNER_PROTECTION', 'Enable beginner protection');
tz_def('ADM_CREATE_2', '+ Create');
tz_def('ADM_ADD_VILLAGE', 'Add Village');
tz_def('ADM_COORDINATES_X_Y', 'Coordinates (X|Y)');
tz_def('ADM_ADD_VILLAGE_2', 'ADD VILLAGE');
tz_def('ADM_TO_ENSURE_THAT_YOU_WON_T_GET_BANNED_AGAIN_IN', 'To ensure that you won\'t get banned again in the future, you should read the rules carefully:');
tz_def('ADM_GAME_RULES', '» Game rules');
tz_def('ADM_TO_CONTINUE_PLAYING_CONTACT_THE_MULTIHUNTER', 'To continue playing contact the Multihunter and put things straight with him/her');
tz_def('ADM_WRITE_MESSAGE', '» Write Message');
tz_def('ADM_HEED_THE_FOLLOWING_ADVICE_WHEN_WRITING_YOUR', 'Heed the following advice when writing your message:');
tz_def('ADM_THERE_IS_ALWAYS_A_REASON_FOR_A_BAN', '● There is always a reason for a ban.');
tz_def('ADM_TRY_TO_THINK_ABOUT_POSSIBLE_REASONS_FOR_THIS', 'Try to think about possible reasons for this ban');
tz_def('ADM_AND_PUT_THINGS_STRAIGHT_WITH_THE_MULTIHUNTER', 'and put things straight with the Multihunter.');
tz_def('ADM_MULTIHUNTERS_CAN_REVIEW_ENORMOUS_AMOUNTS_OF', '● Multihunters can review enormous amounts of information about accounts.');
tz_def('ADM_STICK_TO_THE_TRUTH', 'Stick to the truth');
tz_def('ADM_AND_DO_NOT_MAKE_EXCUSES_TO_JUSTIFY_YOUR_VIOL', 'and do not make excuses to justify your violation of the rules.');
tz_def('ADM_BE_COOPERATIVE_AND_INSIGHTFUL_THIS_MIGHT_RED', '● Be cooperative and insightful, this might reduce the punishment.');
tz_def('ADM_CALM_AND_POLITE', 'calm and polite');
tz_def('ADM_WHILE_TALKING_TO_THE_MULTIHUNTER_AND_TELLING', 'while talking to the Multihunter and telling him/her about your point of view.');
tz_def('ADM_INCLUDES_RESOURCES_MAIN_BUILDING_RALLY_POINT', 'Includes resources, main building, rally point, warehouse, granary, wall, market, residence, troops (for hero level-up), and one cranny.');
tz_def('ADM_IF_THE_MULTIHUNTER_DOES_NOT_ANSWER_IMMEDIATE', '● If the Multihunter does not answer immediately, then he/she is probably not online. The issue will not be resolved any faster by sending multiple messages, especially if he/she did not even read the first one yet.');
tz_def('ADM_IF_YOU_HAVE_REALLY_BEEN_BANNED_UNJUSTLY_TRY', '● If you have really been banned unjustly, try to stay');
tz_def('ADM_RESOURCE', 'Resource');
tz_def('ADM_AMOUNT', 'Amount');
tz_def('ADM_MAXIMUM_CAPACITY', 'Maximum Capacity');
tz_def('ADM_BACK_TO_VILLAGE_2', '← Back to village');
tz_def('ADM_ADMIN_CONTROL', 'Admin Control');
tz_def('ADM_SERVER_ADMINISTRATION', 'Server Administration');
tz_def('ADM_SECURE_ACCESS_TO_TRAVIANZ_PANEL', 'Secure access to TravianZ panel');
tz_def('ADM_PASSWORD', 'Password');
tz_def('ADM_ACCESS_PANEL', 'Access Panel');
tz_def('ADM_ENTER_ADMIN_USERNAME', 'Enter admin username');
tz_def('ADM_ROMANS', 'Romans');
tz_def('ADM_TEUTONS', 'Teutons');
tz_def('ADM_GAULS', 'Gauls');
tz_def('ADM_RESET_GOLD_FOR_ALL_PLAYERS', 'Reset Gold for all players');
tz_def('ADM_RESET_ALL_PLAYERS_GOLD', 'Reset All Players Gold');
tz_def('ADM_THIS_ACTION_WILL_SET_THE_GOLD_TO', 'This action will set the gold to');
tz_def('ADM_FOR_ALL_PLAYERS_FROM_THE_SERVER', 'for ALL players from the server.');
tz_def('ADM_WARNING_THE_ACTION_IS_IRREVERSIBLE_MAKE_SURE', '⚠️ WARNING: The action is irreversible! Make sure you have backup first.');
tz_def('ADM_RESET_GOLD_NOW', 'RESET GOLD NOW');
tz_def('ADM_ALL_PLAYERS_GOLD_HAS_BEEN_RESET', '✓ All players gold has been reset!');
tz_def('ADM_RESET_ALL_PLAYERS_PLUS', 'Reset All Players Plus');
tz_def('ADM_THIS_ACTION_WILL_DISABLE_TRAVIAN_PLUS_FOR_AL', 'This action will disable Travian Plus for ALL players.');
tz_def('ADM_PLUS_IT_WILL_BE_SET_TO_0_DAYS_FOR_EVERYONE', '⚠️ Plus it will be set to 0 days for everyone.');
tz_def('ADM_RESET_PLUS_NOW', 'RESET PLUS NOW');
tz_def('ADM_PLUS_ALL_THE_PLAYERS_HAVE_BEEN_RESET', '✓ Plus all the players have been reset!');
tz_def('ADM_RESET_ALL_RESOURCE_BONUSES', 'Reset All Resource Bonuses');
tz_def('ADM_THIS_ACTION_WILL_DISABLE_THE_25_BONUS_FOR_AL', 'This action will disable the 25% bonus for ALL resources at all players.');
tz_def('ADM_ALL_RESOURCE_BONUSES_WILL_BE_SET_TO_0_DAYS', '⚠️ All resource bonuses will be set to 0 days.');
tz_def('ADM_RESET_RESOURCE_BONUS', 'RESET RESOURCE BONUS');
tz_def('ADM_RESOURCE_BONUSES_HAVE_BEEN_RESET_FOR_ALL_PLA', '✓ Resource bonuses have been reset for all players!');
tz_def('ADM_IGM_REPORTS_LOOKUP', 'IGM / Reports Lookup');
tz_def('ADM_IGM_BY_ID', 'IGM by ID');
tz_def('ADM_GO', 'Go');
tz_def('ADM_REPORT_BY_ID', 'Report by ID');
tz_def('ADM_ENTER_MESSAGE_ID', 'Enter message ID...');
tz_def('ADM_ENTER_REPORT_ID', 'Enter report ID...');
tz_def('ADM_SITTER_1_2', 'Sitter 1');
tz_def('ADM_SITTER_2_2', 'Sitter 2');
tz_def('ADM_CULTURE_POINTS_2', 'Culture Points');
tz_def('ADM_ATTACK_POINTS_THIS_WEEK', 'Attack Points (This Week)');
tz_def('ADM_DEFENCE_POINTS_THIS_WEEK', 'Defence Points (This Week)');
tz_def('ADM_RESOURCES_RAIDED_THIS_WEEK', 'Resources Raided (This Week)');
tz_def('ADM_TOTAL_ATTACK_POINTS', 'Total Attack Points');
tz_def('ADM_TOTAL_DEFENCE_POINTS', 'Total Defence Points');
tz_def('ADM_EDIT_PLAYER_ADDITIONAL_INFO', 'Edit Player Additional Info');
tz_def('ADM_THE_ACCOUNT_WILL_BE_DELETED_IN', 'The account will be deleted in');
tz_def('ADM_CANCEL_3', '✖ Cancel');
tz_def('ADM_CANCEL_DELETION', 'Cancel deletion');
tz_def('ADM_DESCRIPTION', 'Description');
tz_def('ADM_AGE', 'Age');
tz_def('ADM_GENDER', 'Gender');
tz_def('ADM_LOCATION_2', 'Location');
tz_def('ADM_LAST_IP', 'Last IP');
tz_def('ADM_LANGUAGE', 'Language');
tz_def('ADM_BAN_USER_2', '&raquo; Ban User');
tz_def('ADM_SEND_MESSAGE_2', '&raquo; Send Message');
tz_def('ADM_EDIT_PLUS_RES_BONUS', '&raquo; Edit Plus & Res Bonus');
tz_def('ADM_EDIT_SITTERS_2', '&raquo; Edit Sitters');
tz_def('ADM_EDIT_PROTECTION', '&raquo; Edit Protection');
tz_def('ADM_EDIT_PASSWORD', '&raquo; Edit Password');
tz_def('ADM_EDIT_OVERALL_OFF_DEF', '&raquo; Edit Overall Off & Def');
tz_def('ADM_EDIT_WEEKLY_OFF_DEF_RAID', '&raquo; Edit Weekly Off, Def, Raid');
tz_def('ADM_USER_LOGIN_LOG', '&raquo; User Login Log');
tz_def('ADM_USER_ILLEGAL_LOG', '&raquo; User Illegal Log');
tz_def('ADM_RECOUNT_POPULATION', 'Recount population');
tz_def('ADM_EMAIL_2', 'EMAIL');
tz_def('ADM_IP', 'IP');
tz_def('ADM_TRIBE_3', 'Tribe:');
tz_def('ADM_VILLAGES_3', 'Villages:');
tz_def('ADM_POP_3', 'Pop:');
tz_def('ADM_COORDS_2', 'Coords:');
tz_def('ADM_ILLEGALS_LOG', '🚨 Illegals Log:');
tz_def('ADM_DETECTED_OFFENCES', 'Detected Offences');
tz_def('ADM_BACK_TO_PLAYER', '← Back to player');
tz_def('ADM_LOGIN_LOG_2', '🔐 Login Log:');
tz_def('ADM_RECENT_LOGIN_ATTEMPTS', 'Recent Login Attempts');
tz_def('ADM_LOG_ID', 'Log ID');
tz_def('ADM_IP_ADDRESS', 'IP Address');
tz_def('ADM_INFO', 'Info');
tz_def('ADM_BUILD_LOG', '— Build Log');
tz_def('ADM_LATEST_200_ACTION', 'Latest 200 action');
tz_def('ADM_NO_ACTION_RECORDED_YET', 'No action recorded yet.');
tz_def('ADM_POPULATION_2', 'POPULATION');
tz_def('ADM_COORDINATES', 'COORDINATES');
tz_def('ADM_TROOPS_2', 'TROOPS');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - texte lungi si pe mai multe randuri (curatare finala)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_E_MAIL_ADDRESS_2', 'e-mail address');
tz_def('ADM_E_G_AN_OBSCENE_USERNAME_OR_THE_ENTIRE', '(e.g. an obscene username, or the entire');
tz_def('ADM_DOMAIN_MATCHING_IS_EXACT_AND_CASE_INSENSITIV', 'domain). Matching is exact and case-insensitive. Existing accounts are not affected &mdash; only new sign-ups.');
tz_def('ADM_WITH_OR_WITHOUT_THE_LEADING_E_MAIL_THE_FULL', '), with or without the leading &ldquo;@&rdquo;. E-mail: the full address. Username: the exact name.');
tz_def('ADM_SILVER_2', 'silver &nbsp;|&nbsp;');
tz_def('ADM_OF_EACH', 'of each &nbsp;|&nbsp;');
tz_def('ADM_HOURLY_RESOURCES_PRODUCED_BY_EACH_POINT_THE', 'Hourly resources produced by each point the hero invested in the Resources attribute, in the village where the hero is. Players choose freely between spreading it over all four resources or concentrating it on one.');
tz_def('ADM_HOURLY_RESOURCES_PER_POINT_INVESTED_IN_THE_H', 'Hourly resources per point invested in the hero\'s Resources attribute. The first value applies when the player spreads the bonus over all four resources, the second when it is concentrated on a single one. Both scale with server speed.');
tz_def('ADM_HIT_POINTS_THE_HERO_RECOVERS_PER_DAY_ON_TOP', 'Hit points the hero recovers per day on top of the points invested in the regeneration attribute and any equipped items. Without it, a hero with no regeneration points would never heal and would eventually die on adventures. Scales with server speed. 0 disables it.');
tz_def('ADM_HOW_LONG_ONE_CRON_PHP_INVOCATION_KEEPS_WORKI', 'How long one cron.php invocation keeps working. Most shared hosts only allow a cron every 5 minutes, while Automation expects to run about every minute &mdash; so one invocation runs several ticks in a row. Use 300 for a "*/5" cron. Set 0 only if your host allows a cron every minute.');
tz_def('ADM_ENABLE_DISABLE_IF_A_PLAYER_LEAVES_AT_LEAST_O', 'Enable (Disable) if a player leaves at least one message in the thread on the forum, he will receive in-game messages about the fact that new messages have appeared in the same thread (i.e. is technically "subscribed to")');
tz_def('ADM_ENABLE_DISABLE_THE_SERVER_MILESTONES_WIDGET', 'Enable (Disable) the "Server Milestones" widget (first player to settle a 2nd village, reach 1000 population, capture an artefact, conquer a WW, conquer a WW building plan, found an alliance, or conquer a village from another player) shown at the top of Statistics &raquo; General');
tz_def('ADM_CREATE_PROMO_VOUCHER_CODES_PLAYERS_REDEEM_FO', 'Create promo / voucher codes players redeem for gold on the Plus page. Set a fixed gold amount, an optional total use-limit, whether each player may redeem it once, and an optional expiry. For a one-off bug-hunter reward, create a code with max-uses&nbsp;1 &mdash; or use');
tz_def('ADM_DENSITY_OVERLAYS_ON_THE_WORLD_GRID_TO_HELP_W', 'Density overlays on the world grid to help with starting balance: where villages cluster, which tribes dominate a region, where inactive players sit (dead zones / good spawn spots), and where attacks are currently landing. North (+y) is up.');
tz_def('ADM_HEURISTIC_CORRELATION_OF_ACCOUNT_PAIRS_BY_SH', 'Heuristic correlation of account pairs by shared IP, subnet, device/browser fingerprint (User-Agent), overlapping login times, and resource-transfer flow. This is a');
tz_def('ADM_USE_IT_TO_PRIORITISE_WHICH_PAIRS_A_HUMAN_SHO', '&mdash; use it to prioritise which pairs a human should investigate. Nothing is banned automatically.');
tz_def('ADM_ROW_CAP_REACHED_WHILE_SCANNING_LOGIN_HISTORY', 'Row cap reached while scanning login history (window is large / very busy server). Results still valid but may be incomplete &mdash; narrow the window for full coverage.');
tz_def('ADM_RECEIVED_FROM_OTHER_PLAYERS_VERSUS_AN_AUTOMA', '(received from other players) versus an automatic limit derived from the player\'s hourly production (');
tz_def('ADM_OF_PRODUCTION_PER_WINDOW_WW_VILLAGES_AND_ART', 'of production per window). WW villages and artefact villages are flagged as supply exceptions. Set a manual override to exempt a player (WW / trusted) or give a custom cap. Nothing is blocked automatically &mdash; this is visibility &amp; control for a human moderator.');
tz_def('ADM_THE_7_DAY_BALANCE_FILLS_IN_AS_MERCHANT_DELIV', 'The 7-day balance fills in as merchant deliveries between different players are processed after this feature is deployed.');
tz_def('ADM_EDIT_THE_REWARD_EACH_QUEST_GRANTS_WOOD_CLAY', 'Edit the reward each quest grants (wood / clay / iron / crop / gold / Plus days) and the requirement level (e.g. main-building level for building quests). Values are seeded from the shipped defaults, so nothing changes until you edit. The two quest variants have different quests and rewards &mdash; pick the one your server uses (players on');
tz_def('ADM_IN_THE_QUEST_TEMPLATES_QUESTS_MARKED', 'in the quest templates. Quests marked');
tz_def('ADM_KEEP_THEIR_ORIGINAL_HARDCODED_LOGIC_CONDITIO', 'keep their original hardcoded logic (conditional rewards, atomic milestone claims, special mechanics) and are not affected by edits here. The reward numbers shown inside each quest\'s on-screen text are separate template strings &mdash; edits here change what is actually granted; update the quest language strings if you want the preview to match.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// BONUSURI DE ALIANTA (port T4)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ALLYBONUS_TAB', 'Bonificaciones');
tz_def('ALLYBONUS_RECRUITMENT', 'Reclutamiento');
tz_def('ALLYBONUS_PHILOSOPHY', 'Filosofía');
tz_def('ALLYBONUS_METALLURGY', 'Metalurgia');
tz_def('ALLYBONUS_COMMERCE', 'Comercio');
tz_def('ALLYBONUS_LEVEL', 'Nivel');
tz_def('ALLYBONUS_NEXT', 'siguiente');
tz_def('ALLYBONUS_MAXED', 'Completamente desbloqueado');
tz_def('ALLYBONUS_UNLOCKING', 'Desbloqueando nivel');
tz_def('ALLYBONUS_DONATE', 'Donar');
tz_def('ALLYBONUS_TRIPLE', 'Triplicar esta donación');
tz_def('ALLYBONUS_DAILY_LEFT', 'Tu límite de donación restante hoy');
tz_def('ALLYBONUS_CONTRIBUTORS', 'Contribuciones');
tz_def('ALLYBONUS_MEMBER', 'Miembro');
tz_def('ALLYBONUS_TOTAL', 'Donado');
tz_def('ALLYBONUS_MSG_OK', 'Recursos donados.');
tz_def('ALLYBONUS_MSG_UPGRADING', 'Esta bonificación se está desbloqueando actualmente; las donaciones están pausadas.');
tz_def('ALLYBONUS_MSG_LIMIT', 'Eso excedería tu límite de donación diario.');
tz_def('ALLYBONUS_MSG_RESOURCES', 'No hay suficientes recursos en esta aldea.');
tz_def('ALLYBONUS_MSG_NOGOLD', 'No hay suficiente oro para triplicar esta donación.');
tz_def('ALLYBONUS_MSG_NOALLY', 'No estás en una alianza.');
tz_def('ALLYBONUS_MSG_INVALID', 'Donación no válida.');
tz_def('ALLYBONUS_HINT', 'El tipo de recurso no importa, solo la cantidad total. Mientras se desbloquea un nivel, esa bonificación no puede recibir donaciones.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// PANOU DE ADMINISTRARE - pachet grafic si bonusuri de alianta
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_SERVER_GRAPHIC_PACK', 'Server graphic pack');
tz_def('ADM_SERVER_GRAPHIC_PACK_TIP', 'The graphic pack every player sees by default, read from the gpack/ folder.');
tz_def('ADM_PLAYER_GRAPHIC_PACKS', 'Player graphic packs');
tz_def('ADM_PLAYER_GRAPHIC_PACKS_TIP', 'When enabled, players can point their profile at their own graphic pack (Profile &rarr; Graphics). When disabled, everyone sees the server pack.');
tz_def('ADM_ALLIANCE_BONUSES', 'Alliance bonuses');
tz_def('ADM_ALLIANCE_BONUSES_TIP', 'T4 alliance bonuses: members donate resources to unlock Recruitment, Philosophy, Metallurgy and Commerce.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// BONUSURI DE ALIANTA - descrierile fiecarui bonus
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ALLYBONUS_RECRUITMENT_DESC', 'Acelera el entrenamiento de tropas en todos los edificios productores de tropas. Se multiplica con los cascos del héroe.');
tz_def('ALLYBONUS_PHILOSOPHY_DESC', 'Aumenta la producción de puntos de cultura de edificios y cascos del héroe. Las celebraciones del ayuntamiento no se ven afectadas.');
tz_def('ALLYBONUS_METALLURGY_DESC', 'Aumenta la fuerza ofensiva y defensiva de tus tropas, además de las mejoras de tu herrería.');
tz_def('ALLYBONUS_COMMERCE_DESC', 'Aumenta cuánto puede transportar cada mercader. Se multiplica con la oficina comercial.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// STATISTICI GRAFICE (Travian Plus)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('PLUSSTATS_TITLE', 'Estadísticas gráficas');
tz_def('PLUSSTATS_INTRO', 'El desarrollo de tu cuenta a lo largo del tiempo.');
tz_def('PLUSSTATS_RANK', 'Clasificación');
tz_def('PLUSSTATS_POP', 'Población');
tz_def('PLUSSTATS_ARMY', 'Fuerza del ejército (consumo de cereal por hora)');
tz_def('PLUSSTATS_VILLAGES', 'Aldeas');
tz_def('PLUSSTATS_TROOPS', 'Tropas');
tz_def('PLUSSTATS_UPKEEP', 'Consumo de cereal por hora');
tz_def('PLUSSTATS_METRIC', 'Métrica');
tz_def('PLUSSTATS_NOW', 'Ahora');
tz_def('PLUSSTATS_CHANGE', 'Cambio');
tz_def('PLUSSTATS_NODATA', 'Aún no hay suficientes datos');
tz_def('PLUSSTATS_WAIT', 'Tu cuenta se está registrando. Los gráficos aparecen una vez que existen al menos dos capturas.');
tz_def('PLUSSTATS_NEEDPLUS', 'Las estadísticas gráficas son una función de Travian Plus. Activa Plus para ver el desarrollo de tu cuenta.');
tz_def('PLUSSTATS_DISABLED', 'Las estadísticas gráficas no están habilitadas en este servidor.');
tz_def('PLUSSTATS_FOOT', 'La fuerza del ejército se mide por el consumo de cereal, que es la propia ponderación del juego: cuenta una unidad fuerte más que una débil. Las tropas que refuerzan a otros jugadores siguen contando como tuyas.');
tz_def('ADM_PLUS_STATISTICS', 'Plus graphical statistics');
tz_def('ADM_PLUS_STATISTICS_TIP', 'Records rank, population, villages and army for every player, so Plus players can see how their account developed. The tab is only visible with an active Plus account.');
tz_def('ADM_PLUS_STATISTICS_INTERVAL', 'Statistics snapshot interval (hours)');
tz_def('ADM_PLUS_STATISTICS_INTERVAL_TIP', 'How often a snapshot is taken. On a fast server a day is a lot of play, so a few hours gives a readable curve.');
tz_def('ADM_PLUS_STATISTICS_KEEP', 'Statistics history kept (days)');
tz_def('ADM_PLUS_STATISTICS_KEEP_TIP', '0 keeps everything, so players see the full history of their account since recording began.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// BONUSURI DE ALIANTA - disponibilitate pentru membrii noi
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ALLYBONUS_YOURLEVEL', 'Tu nivel');
tz_def('ALLYBONUS_UNLOCKS_IN', 'siguiente se desbloquea en');
tz_def('ALLYBONUS_NEWMEMBER', 'Los nuevos miembros obtienen acceso a niveles superiores gradualmente: nivel 2 después de 24 horas en la alianza, nivel 3 después de 48 horas, y así sucesivamente.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// RAPOARTE - filtru dupa rezultatul luptei
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('TZ_RPT_ALL_RESULTS', 'Todos los resultados');
tz_def('TZ_RPT_F_WON_NOLOSS', 'Ganado sin pérdidas');
tz_def('TZ_RPT_F_WON_LOSS', 'Ganado con pérdidas');
tz_def('TZ_RPT_F_LOST', 'Perdido');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// EROU - regenerarea totala (baza + iteme)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('TZ_HERO_REGEN_TOTAL', 'Regeneración de salud');
tz_def('TZ_HERO_REGEN_BASE', 'base');
tz_def('TZ_HERO_REGEN_ITEMS', 'de objetos');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// MINUNEA LUMII A NATARILOR
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('TZ_WW_NATARS', 'Natares');
tz_def('CONF_SERV_NATARS_WW_START_DELAY', 'Natars\' World Wonder start');
tz_def('CONF_SERV_NATARS_WW_START_DELAY_TOOLTIP', 'How many days after the construction plans appear the Natars start building their own World Wonder. Scaled by server speed. 0 disables it.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// SIMULATOR - bonusuri proprii incluse automat
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('TZ_WS_APPLIED', 'Incluido automáticamente en esta simulación:');
tz_def('TZ_WS_ITEM_STRENGTH', 'Fuerza del equipo');
tz_def('TZ_WS_ITEM_UNIT', 'Bonus de arma');
tz_def('TZ_WS_VS_NATARS', 'Contra Natares');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// MESAJ DE SISTEM - previzualizare
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_PREVIEW', 'Vista previa');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// REGULI DE INREGISTRARE (Server Configuration)
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('CONF_SERV_USRNM_MIN', 'Minimum username length');
tz_def('CONF_SERV_USRNM_MAX', 'Maximum username length');
tz_def('CONF_SERV_PW_MIN', 'Minimum password length');
tz_def('CONF_SERV_USRNM_SPECIAL', 'Allow . - _ in usernames');
tz_def('CONF_SERV_USRNM_SPECIAL_TOOLTIP', 'With True, usernames may contain a dot, hyphen or underscore, and single spaces between words. With False, only letters and digits are accepted.');
tz_def('CONF_SERV_REGRULES_TOOLTIP', 'Rules checked when a player registers. Changing them does not affect existing accounts.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// STATISTICI - sectiunea de alianta
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('PLUSSTATS_ALLIANCE', 'Tu alianza');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// EROU - capetele de coloana din pagina de iteme
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('HERO_COL_TYPE', 'Tipo');
tz_def('HERO_COL_IMAGE', 'Imagen');
tz_def('HERO_COL_NAME', 'Nombre del objeto');
tz_def('HERO_COL_TIER', 'Nivel (bonus)');
tz_def('HERO_COL_ACTION', 'Acción');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// MINUNEA LUMII - stil pe trib
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADM_WW_IMAGE', 'Per-tribe World Wonder');
tz_def('ADM_WW_IMAGE_TIP', 'Each tribe sees its own World Wonder artwork, both on the village map and on the construction page. Tribes without artwork on disk keep the original image regardless of this setting.');

//////////////////////////////////////////////////////////////////////////////////////////////////////
// FOR MULTI-INSTANCE SERVER
//////////////////////////////////////////////////////////////////////////////////////////////////////
tz_def('ADMIN_ADD_SERVER', 'Add Server');
tz_def('SERVER_STATUS_TITLE', 'SERVERS STATUS');
tz_def('SERVER_STATUS_OPERATIONAL', 'OPERATIONAL');
tz_def('SERVER_STATUS_CLOSED', 'CLOSE');
tz_def('SERVER_STATUS_MAINTENANCE', 'IN MAINTENANCE');
tz_def('SERVER_REGISTER_OPEN', 'OPEN');
tz_def('SERVER_REGISTER_CLOSED', 'CLOSE'); // different from SERVER_STATUS_CLOSED for other language
tz_def('SERVER_LABEL', 'SERVER');
tz_def('SERVER_STATUS_LABEL', 'STATUS');
tz_def('SERVER_REGISTER_LABEL', 'REGISTER');
tz_def('SERVER_PLAYERS_LABEL', 'Nbr of players');
tz_def('SERVER_ONLINE_LABEL', 'Online');