<?php

//////////////////////////////////////////////////////////////////////////////////////////////////////
//                                             TRAVIANX                                             //
//            Only for advanced users, do not edit if you dont know what are you doing!             //
//                                Made by: Dzoki & Dixie (TravianX)                                 //
//                              - TravianX = Travian Clone Project -                                //
//                                 DO NOT REMOVE COPYRIGHT NOTICE!                                  //
//                                Adding tasks, constructions and artefact  by: Armando             //
//////////////////////////////////////////////////////////////////////////////////////////////////////
									//                         //
									//         SPANISH         //
									//     author: Thyphoon    //
									//     Adding: Armando    //
									/////////////////////////////

//MAIN MENU
define("HOME","P&aacute;gina Principal");
define("INSTRUCT","Instrucciones");
define("ADMIN_PANEL","Panel de control");
define("MASS_MESSAGE","Mens. en masa");
define("LOGOUT","Salir");
define("PROFILE","Perfil");
define("SUPPORT","Soporte");
define("UPDATE_T_10","Actualizar top 10");
define("SYSTEM_MESSAGE","Mens. del sistema");
define("TRAVIAN_PLUS","Travian <b><span class=\"plus_g\">P</span><span class=\"plus_o\">l</span><span class=\"plus_g\">u</span><span class=\"plus_o\">s</span></span></span></b>");
define("CONTACT","Contactenos!");

//MENU
define("REG","Registarse");
define("FORUM","Foro");
define("CHAT","Chat");
define("IMPRINT","Imprimir");
define("MORE_LINKS","Enlaces");
define("TOUR","Tutorial");

//ERRORS
define("USRNM_EMPTY","(Nombre de usuario vac&iacute;)");
define("USRNM_TAKEN","(El nombre ya esta en uso.)");
define("USRNM_SHORT","(min. ".USRNM_MIN_LENGTH." caracteres)");
define("USRNM_CHAR","(Caracteres inv&aacute;lidos)");
define("PW_EMPTY","(Contrase&ntilde;a en blanco)");
define("PW_SHORT","(min. ".PW_MIN_LENGTH." caracteres)");
define("PW_INSECURE","(Contrasena insegura. Por favor escoja una con ma&acute;s seguridad.)");
define("EMAIL_EMPTY","(Correo en blanco)");
define("EMAIL_INVALID","(Direccio&acute;n de correo inva&acute;lida)");
define("EMAIL_TAKEN","(El correo ya esta&acute; en uso)");
define("TRIBE_EMPTY","<li>Por favor escoja una tribu.</li>");
define("AGREE_ERROR","<li>Tiene que estar de acuerdo con las reglas y condicio&acute;n de uso antes de registrarse.</li>");
define("LOGIN_USR_EMPTY","Nombre vac&iacute;o.");
define("LOGIN_PASS_EMPTY","Contrase&ntilde;a.");
define("EMAIL_ERROR","El correo electr&oacute;nico no existe");
define("PASS_MISMATCH","Las contrase&ntilde;as no coinciden");
define("ALLI_OWNER","Por favor escoja un l&iacute;der de alianza antes de borrarla.");
define("SIT_ERROR","Cuidador ya configurado");
define("USR_NT_FOUND","Nombre no existente.");
define("LOGIN_PW_ERROR","La contrase&ntilde;a es incorrecta.");
define("WEL_TOPIC","Concejos &uacute;tiles e informaci&oacute;n ");
define("ATAG_EMPTY","Etiqueta vac&iacute;a");
define("ANAME_EMPTY","Nombre vac&iacute;o");
define("ATAG_EXIST","Etiqueta en uso");
define("ANAME_EXIST","Nombre en uso");

//COPYRIGHT
define("TRAVIAN_COPYRIGHT","TravianX Clon de Travian 100% C&oacute;digo Libre.");

//BUILD.TPL
define("CUR_PROD","Producci&oacute;n actual ");
define("NEXT_PROD","Producci&oacute;n al nivel ");

//BUILDINGS
define("B1","Le&ntilde;ador");
define("B1_DESC","El le&ntilde;ador tala &aacute;rboles para producir madera. Cuanto m&aacute;s se aumenta su nivel produce m&aacute;s madera.");
define("B2","Barrera");
define("B2_DESC","La arcilla se produce aqu&iacute;. Al incrementar el nivel aumentar&aacute; la producci&oacute;n de arcilla.");
define("B3","Mina de Hierro");
define("B3_DESC","Aqu&iacute; los mineros producen produce el valioso hierro. Cuanto m&aacutes se ampl&iacute;en las minas, m&aacute;s hierro se produce.");
define("B4","Granja");
define("B4_DESC","La comida de tu pobleci&oacute;n se produce aqu&iacute;. Incrementando el nivel de las granjas aumentas la producci&oacute;n de Cereal.");

//DORF1
define("LUMBER","Madera");
define("CLAY","Arcilla");
define("IRON","Hierro");
define("CROP","Cereal");
define("LEVEL","Nivel");
define("CROP_COM",CROP." consumido");
define("PER_HR","por hora");
define("PROD_HEADER","Producci&oacute;n");
define("MULTI_V_HEADER","Villas");
define("ANNOUNCEMENT","Anuncio");
define("GO2MY_VILLAGE","Ir a mi villa");
define("VILLAGE_CENTER","Centro de la Villa");
define("FINISH_GOLD","&iquest;Terminar todas las construcciones e investigaciones en esta aldea por 2 oros?");
define("WAITING_LOOP","(lazo de espera)");
define("HRS","(hrs.)");
define("DONE_AT","listo a las ");
define("CANCEL","cancelar");

//QUEST
define("Q_CONTINUE","Continuar con la siguiente misi&oacute;n.");
define("Q_REWARD","Su recompensa:");
define("Q_BUTN","completar misi&oacute;n");
define("Q0","&iexcl;Biemvenido a ");
define("Q0_DESC","Veo que se le ha nombrado jefe de este peque&ntilde;o pueblo. Ser&eacute; su concejero y mano derecha los primeros d&iacute;as.<\/i> <br \/><i>Puede empesar cumpliendo unas simples tareas por las que ser&aacute; recompensado &iquest;desea realizarlas?");
define("Q0_OPT1","Si, comenzar con las tareas.");
define("Q0_OPT2","Vuelvo\u00a0despues\u00a0en\u00a0un\u00a0rato.");
define("Q0_OPT3","No gracias, no me interesa.");

define("Q1","Misi&oacute;n 1: Construye un le&ntilde;ador");
define("Q1_DESC","Alrededor de la aldea hay cuatro bosques verdes. Construye un le&ntilde;ador en cada uno de ellos. La madera es un recurso importante para un nuevo asentamiento");
define("Q1_ORDER","Orden:<\/p> mejorar un le&ntilde;ador.");
define("Q1_RESP","Si, de esa manera usted gana mas madera. Ayud&eacute; un poquito y complet&eacute; la orden.");
define("Q1_REWARD","Finalizaci&oacute;n inmediata del le&ntilde;ador.");

define("Q2","Misi&oacute;n 2: Cereal");
define("Q2_DESC","Ahora sus s&uacute;bditos estan hambrientos por haber trabajado todo el d&iacute;a. Extienda sus granjas para mejorar sus reservas. Regrese cuando la granja est&eacute; realizada.");
define("Q2_ORDER","Order:<\/p>mejorar una granja.");
define("Q2_RESP","Muy bien. Ahora sus s&uacute;bditos tiene suficiente comida...");
define("Q2_REWARD","Su recompensa:<\/p>1 d&iacute;a Travian");

define("Q3","Misi&oacute;n 3: El Nombre de tu aldea");
define("Q3_DESC","Creativo como eres le puedes dar el nombre a tu aldea. Haz click en <b>perfil</b> en el lado izquierdo del men&uacute; y selecciona <b>cambiar perfil</b>");
define("Q3_ORDER","Order:<\/p>Change your village's name to something nice.");
define("Q3_RESP","Wow, un buen nombre para su pueblo. Podr&iacute;a haber nombrado el mio igual...");

define("Q4","Misi&oacute;n 4: Otros jugadores.");
define("Q4_DESC","En ". SERVER_NAME . " juegas junto con billones de otros jugadores. Haz click en 'Estadisticas' en el men&uacute; de arriba para ver tu ranking.");
define("Q4_ORDER","Orden: <\/p>Buscar tu ranking en las estadisticas e introducirlo aqu&iacute;.");
define("Q4_BUTN","completar misi&oacute;n");
define("Q4_RESP","&iexcl;Exactamente! Ese es tu rango.");

define("Q5","Misi&oacute;n 5: Dos ordenes de construcci&oacute;n");
define("Q5_DESC","Construye una mina de hierro y un barrera. El hierro y el barro nunca son suficientes");
define("Q5_ORDER","Orden:<\/p><ul><li>Ampliar una mina de hierro.<\/li><li>Ampliar una barrera.<\/li><\/ul>");
define("Q5_RESP","Como habr&aacute;s notado las ordenes de construcci&oacute;n toman mas tiempo. El mundo de ". SERVER_NAME ." continuar&aacute; girando incluso si est&aacute;s desconectado. En unos meses habr&aacute;n muchas cosas para descubrir. <br> Lo mejor que puedes hacer es ocacionalmente entrar a tu pueblo y asignar a sus pobladores nuevas tareas y cosas para hacer.");


define("Q6","Misi&oacute;n 6: Mensajes");
define("Q6_DESC","Puedes hablar con otros jugadores usando el sistema de mensajes (IGM). Te he enviado uno. L&eacute;elo y regresa aqu&iacute;.<br \/><br \/>P.D. No olvides: a la izquierda los reportes, a la derecha los mensajes.");
define("Q6_ORDER","Orden:<\/p>Lee tu mensaje nuevo.");
define("Q6_RESP","Lo recibiste? Muy bien.<br \/><br \/>Aqu&iacute; tienes algo de Oro. Con Oro puedes hacer muchas cosas por ejemplo extender tu cuenta-");
define("Q6_RESP1","o incrementar tu producci&oacute;n de materias. Para poder hacerlo debes hacer click en ");
define("Q6_RESP2"," a la izquierda de tu pantalla.");
define("Q6_SUBJECT","Mensaje del Amo de las Misiones");
define("Q6_MESSAGE","Has sido informado que una gran recompensa te espera con el Amo de las Misiones.<br /><br />Consejo: El mensaje ha sido generado autom&aacute;ticamente, no es necesario responder.");

define("Q7","Misi&oacute;n 7: Uno de cada materia");
define("Q7_DESC","Ahora debemos aumentar tu producci&oacute;n de recursos un poco. Construir un le&ntilde;ador, una cantera de arcilla, mina de hierro adicional y un campo de cereales en el nivel 1 adicional a los que ya construistes.");
define("Q7_ORDER","Orden:<\/p>Amplie otra casilla de cada recurso a nivel 1.");
define("Q7_RESP","Excelente, la producci&oacute;n est&aacute; aumentando los recursos en la Aldea");

define("Q8","Misi&oacute;n 8: Gran Ej&eacute;rcito!");
define("Q8_DESC","Ahora tengo una Misi&oacute;n muy especial para ti. Estoy hambriento. Dame 200 de Cereal!<br \/><br \/>A cambio voy a intentar organizar un gran ej&eacute;rcito para proteger tu pueblo.");
define("Q8_ORDER","Orden:<\/p>Enviar 200 de Cereal al Amo de las Misiones.");
define("Q8_BUTN","Enviar Cereal");
define("Q8_NOCROP","No tienes suficiente cereal!");

define("Q9","Misi&oacute;n 9: Todo a 1!.");
define("Q9_DESC","En Travian siempre hay algo que hacer! Mientras que usted est&aacute; esperando a que llegue el enorme ej&eacute;rcito, Ahora deberiamos subir el nivel de la producci&oacute;n de tus recursos un poco. Ampliar todas las casillas de recursos al nivel 1.");
define("Q9_ORDER","Orden:<\/p>Sube todas las casillas de recursos a nivel 1.");
define("Q9_RESP","Muy Bien, su producci&oacute;n de recursos aumenta.<br \/><br \/>pronto podemos empezar a construir edificios en el pueblo.");

define("Q10","Misi&oacute;n 10: Paloma de la paz");
define("Q10_DESC","Los primeros d&iacute;as despu&eacute;s del registro est&aacute;s protegido contra los ataques de los demas jugadores. Puedes ver cuanto tiempo de protecci&oacute;n te queda agregando el codigo <b>[#0]<\/b> a tu perfil.");
define("Q10_ORDER","Orden:<\/p>Escribir el c&oacute;digo <b>[#0]<\/b> en tu perfil agregando en uno de los dos campos de descripci&oacute;n.");
define("Q10_RESP","Bien hecho! ahora todo el mundo puede ver que gran guerrero se aproxima");
define("Q10_REWARD","Su recompensa:<\/p>2 d&iacute;a Travian");

define("Q11","Misi&oacute;n 11: Vecinos!");
define("Q11_DESC","A tu alrededor, hay muchas aldeas diferentes Una de ellos se llama. ");
define("Q11_DESC1"," Haga clic en 'mapa' en el men&uacute; superior y busque la coordenadas de la aldea. El nombre de las aldeas de sus vecinos se puede ver cuando se pasa el mouse sobre cualquiera de ellos.");
define("Q11_ORDER","Orden:<\/p> Busque las coordenadas de ");
define("Q11_ORDER1"," e introducelas aqu&iacute;.");
define("Q11_RESP","Muy bien, las coordenadas de ");
define("Q11_RESP1"," son correctas, ahora obtendras tantas materias como las que este  pueblo puede guardar , bueno casi tantas");
define("Q11_BUTN","completar misi&oacute;n");

define("Q12","Misi&oacute;n 12: Escondite");
define("Q12_DESC","Ya va siendo tiempo de construir un escondite. El mundo de <?php echo SERVER_NAME; ?> es peligroso.<br \/><br \/>Muchos jugadores viven de robar los recursos de otros jugadores. Construye un escondite para esconder al menos un parte de tus recursos de los enemigos.");
define("Q12_ORDER","Orden:<\/p>construir un escondite.");
define("Q12_RESP","Bien hecho, ahora les ser&aacute; mucho mas dificil a tus enemigos saquear tu aldea.<br \/><br \/>Si te atacan, tus aldeanos guardar&aacute;n las materias en el escondite atom&aacute;ticamente.");

define("Q13","Misi&oacute;n 13: Dos de cada!.");
define("Q13_DESC","En <?php echo SERVER_NAME; ?> siempre hay algo que hacer! Amplia un le&ntilde;ador, una barrera, una mina de hierro una granja a nivel 2");
define("Q13_ORDER","Orden:<\/p>Subir un campo de cada recurso a nivel 2.");
define("Q13_RESP","Muy Bien, Tu aldea crece y prospera!");

define("Q14","Misi&oacute;n 14: Instrucciones");
define("Q14_DESC","En las Instrucciones del juego encontraras informaci&oacute;n sencilla acerca de los diferentes edificios y tipos de unidades.<br \/><br \/>Haz click en 'Instrucciones' a la izquierda y busca cuanta madera necesitas para construir un cuartel.");
define("Q14_ORDER","Orden:<\/p>Ingresar cuanta madera cuesta un cuartel");
define("Q14_RESP","Exacto! El Cuartel cuesta 210 de Madera.");

define("Q15","Misi&oacute;n 15: Edificio Principal");
define("Q15_DESC","Tus constructores necesitan el edificio principal a 3 para construir edificios importantes como el mercado o el cuartel.");
define("Q15_ORDER","Orden:<\/p>Ampliar el edificio principal a nivel 3.");
define("Q15_RESP","Bien hecho. Has copmpletado el Edificio Principal a nivel 3 .<br><br>Con esta ampliaci&oacute;n los constructores no pueden construir otros edificios pero construyen mas deprisa.");

define("Q16","Misi&oacute;n 16: Avanzado!");
define("Q16_DESC","Busca tu ranking en las estadisticas de jugadores de nuevo y disfruta de tu progreso.");
define("Q16_ORDER","Orden:<\/p>Buscar tu ranking en las estadisticas e ingresarlo aqu&iacute;.");
define("Q16_RESP","Bien hecho! Ese es tu ranking actual.");

define("Q17","Misi&oacute;n 17:  Armas o Materias");
define("Q17_DESC","Ahora debes tomar una decisi&oacute;n: O bien comerciar pacificamente o convertirte en un guerrero temido.<br \/><br \/>Para el mercado, necesitas un granero, para el cuartel una plaza de reuniones.");
define("Q17_BUTN","Econom&iacute;a");
define("Q17_BUTN1","Militar");
define("Q17_ORDER","Order:<\/p>Extend one more of each resource tile to level 1.");
define("Q17_RESP","Very good, great develop of resources production.");

define("Q18","Misi&oacute;n 18: Militar");
define("Q18_DESC","Una desici&oacute;n valiente. Para poder enviar tropas necesitas la plaza de reuniones.<br \/><br \/>La plaza de reuniones puede ser construida en un unico sitio de construcci&oacute;n. El ");
define("Q18_DESC1"," lugar de construcción.");
define("Q18_DESC2"," esta localizado a la derecha del edificio principal, ligeramente debajo del mismo. El sitio de construcci&oacute;n es curvado.");
define("Q18_ORDER","Orden:<\/p>Construir la plaza de reuniones.");
define("Q18_RESP","Tu Plaza de Reuniones a sido levantada!. Un buen movimiento hacia la dominaci&oacute;n del mundo!");

define("Q19","Misi&oacute;n 19: Cuartel");
define("Q19_DESC","Ahora tienes el edificio principal a nivel 3 y una plaza de reuniones. Eso significa que todos los pre-requisitos para construir un cuartel se han cumplido.<br><br>En el cuartel puedes entrenar tropas para la batalla.");
define("Q19_ORDER","Orden:<\/p>Construir un cuartel.");
define("Q19_RESP","Bien hecho... Los mejores entrenadores de todo el pa&iacute;s se han reunido para entrenar a tus hombres\u2019s en la lucha para mantenerse en forma.");

define("Q20","Misi&oacute;n 20: Entrenar");
define("Q20_DESC","Ahora que tienes un cuartel puedes empezar a entrenar tropas. Entrena 2 ");
define("Q20_ORDER","Orden:<\/p>Por favor, entrena 2 ");
define("Q20_RESP","El fundamento de tu glorioso ejercito ha sido consolidado.<br \/><br \/>Antes de enviar tu ofensiva a saquear deberias comprobar con el ");
define("Q20_RESP1","Simulador de Combate");
define("Q20_RESP2","cuantas tropas necesitas para que tu ataque sea exitoso.");

define("Q21","Misi&oacute;n 18: Econom&iacute;a");
define("Q21_DESC","Tu elecci&oacute;n es comercio y econom&iacute;a. Seguramente te aguardan tiempos dorados!");
define("Q21_ORDER","Orden:<\/p>Construir un granero.");
define("Q21_RESP","Bien hecho! con el Granero puedes almacenar mas cereal.");

define("Q22","Misi&oacute;n 19: Almacen");
define("Q22_DESC","No solo debes acumular cereal. otros recursos pueden irse a la basura si no son almacenados correctamente. Construye un almacen!");
define("Q22_ORDER","Orden:<\/p>Construye un almacen.");
define("Q22_RESP",";Bien hecho, tu almacen se ha completado...&rdquo;<\/i><br \/>Esto significa que todos los pre-requisitos para construir el mercado se han cumplido.");

define("Q23","Misi&oacute;n 20: Mercado.");
define("Q23_DESC",";Construye un mercado para que puedas comerciar con tus compa&ntilde;eros de juego.");
define("Q23_ORDER","Orden:<\/p>Por favor, construye un mercado.");
define("Q23_RESP",";El mercado se ha completado. Ahora usted puede hacer sus propias ofertas y aceptar ofertas extranjeras! Al crear sus propias ofertas, usted debe pensar en ofrecer lo que otros jugadores que m&aacute;s necesitan para obtener m&aacute;s beneficios.");

define("Q24","Misi&oacute;n 21: Todo a nivel 2.");
define("Q24_DESC","Ahora es tiempo de nuevo de ampliar la base de poder y riqueza! Esta vez el nivel 1 no es suficiente... tomara un tiempo m&aacute;s pero al final valdra la pena. Sube todas las casillas de recursos a nivel 2!");
define("Q24_ORDER","Orden:<\/p>Ampliar todos los recursos a nivel 2.");
define("Q24_RESP","Felicidades! tu aldea crece y prospera...");

define("Q28","Misi&oacute;n 22: Alianza.");
define("Q28_DESC","El trabajo en equipo es importante en Travian. Jugadores organizados que juegan juntos en una alianza.<br><br>Consigue una invitaci&oacute;n de una alianza cercana a tu regi&oacute;n y &uacute;nete a ella Puedes buscar alianzas en el Foro tambi&eacute;n<br>Puedes fundar tu propia alianza, para hacerlo debes de tener la embajada a nivel 3");
define("Q28_ORDER","Orden:<\/p>Unirte a una Alianza o fundar la tuya");
define("Q28_RESP","Es bueno! Ahora est&aacute;s en una alianza llamada ");
define("Q28_RESP1",", Tambi&eacute;n puede ayudar a los miembros de su alianza con avance con mayor rapidez...");

define("Q29","Misi&oacute;n 23: Edificio Principal a nivel 5");
define("Q29_DESC","Para poder construir un Palacio o Residencia, necesitas el Edificio Principal en nivel 5");
define("Q29_ORDER","Orden:<\/p>Mejora tu Edificio Principal a nivel 5.");
define("Q29_RESP","Genial!, ahora has desbloqueado edificios adicionales como el Palacio o Residencia.");

define("Q30","Misi&oacute;n 24: Granero a nivel 3");
define("Q30_DESC","Para no perder Cereal, deber&iacute;as mejora el granero.");
define("Q30_ORDER","Orden:<\/p> Mejorar el granero a nivel 3.");
define("Q30_RESP","Bien, ahora podr&aacute;s guardar m&aacute;s Cereal");

define("Q31","Misi&oacute;n 25: Almac&eacute;n a nivel 7");
define("Q31_DESC"," Para evitar que tus recursos se desperdicien, necesitas mejorar tu almac&eacute;n.");
define("Q31_ORDER","Orden:<\/p>Mejora el Almac&eacute;n a nivel 7.");
define("Q31_RESP","Bien hecho, con esa capacidad adicional, pronto ser&aacute;s capaz de entrenar algunos colonos.");

define("Q32","Misi&oacute;n 26: Todo a 5!");
define("Q32_DESC","Siempre necesitar&aacute;s m&aacute;s recursos. Los campos de recursos son algo caros pero siempre traen beneficios con el tiempo.");
define("Q32_ORDER","Orden:<\/p>Mejora todos tus campos de recursos a nivel 5");
define("Q32_RESP","Bien hecho, ahora tienes una producci&oacute;n decente.");

define("Q33","Misi&oacute;n 27: Palacio o Residencia a nivel 10?");
define("Q33_DESC","Para fundar una nueva aldea, necesitas colonos, estos se entrenan en la Residencia o en el Palacio.");
define("Q33_ORDER","Orden:<\/p>Construye una Residencia o Palacio a nivel 10.");
define("Q33_RESP","Bien, ahora ya podr&aacute;s empezar a entrenar algunos colonos.");

define("Q34","Misi&oacute;n 28: 3 colonos.");
define("Q34_DESC","Para fundar una nueva aldea, necesitas colonos, estos se entrenan en la Residencia o en el Palacio.");
define("Q34_ORDER","Orden:<\/p>Entrena 3 colonos.");
define("Q34_RESP","Bien, ahora podr&aacute;s fundar una nueva aldea si tienes");
define("Q34_RESP1","puntos de cultura.");

define("Q35","Misi&oacute;n 29: Nueva Aldea.");
define("Q35_DESC","Hay un mont&oacute;n de terrenos vac&iacute;os en el mapa. Encuentra uno que te guste y funda ah&iacute; una nueva aldea");
define("Q35_ORDER","Orden:<\/p>Fundar nueva aldea.");
define("Q35_RESP","Estoy orgulloso de ti, ahora tienes 2 aldeas y tienes todas las posibilidades para construir un magn&iacute;fico imperio. Te deseo mucha suerte en eso.");

define("Q36"," Misi&oacute;n 30: Construir el muro de la aldea ");
define("Q36_DESC","Ahora que usted ha entrenado a algunos soldados, se debe construir una");
define("Q36_DESC1"," tambi&eacute;n. Aumenta la defensa de la base y sus soldados recibir&aacute; una bonificaci&oacute;n defensiva.");
define("Q36_ORDER","Orden:<\/p>Construir una ");
define("Q36_RESP","Excelente. la ");
define("Q36_RESP1"," se hizo. Usted tendr&aacute; m&aacute;s poder defensivo en la aldea");

define("Q37","Misi&oacute;nes");
define("Q37_DESC","Te Felicito, terminastes todas las misiones, ahora sigue solo Adi&oacute;s");

define("OPT3","visi&oacute;n general de Recursos");
define("T","Sus entregas de recursos");
define("T1","Entregas");
define("T2","Tiempo de entrega");
define("T3","Estado");
define("T4","entregar");
define("T5","entregado");
define("T6","en espera");
define("T7","1 d&iacute;a Travian ");
define("T8","2 d&iacute;as Travian ");

//======================================================//
//================ UNITS - DO NOT EDIT! ================//
//======================================================//
// HEROE UNIT
define("U0","H&eacute;roe");

//ROMAN UNITS
define("U1","Legionnario");
define("U2","Pretoriano");
define("U3","Imperano");
define("U4","Equites Legati");
define("U5","Equites Imperatoris");
define("U6","Equites Caesaris");
define("U7","Ariete Romano");
define("U8","Catapulta de fuego");
define("U9","Senador");
define("U10","Colono");

//TEUTON UNITS
define("U11","Luchador de Porra");
define("U12","Lancero");
define("U13","Hachero");
define("U14","Explorador");
define("U15","Paladin");
define("U16","Caballero Teut&oacute;n");
define("U17","Ariete");
define("U18","Catapulta");
define("U19","Jefe Teut&oacute;n");
define("U20","Colono");

//GAUL UNITS
define("U21","Phalange");
define("U22","Espadach&iacute;n");
define("U23","Rastreador");
define("U24","Trueno de Tutatis");
define("U25","Jinete Druida");
define("U26","Jinete Haeduan");
define("U27","Ariete");
define("U28","Catapulta de Guerra");
define("U29","Jefe Galo");
define("U30","Colono");

//NATURE UNITS
define("U31","Rata");
define("U32","Ara&ntilde;a");
define("U33","Serpiente");
define("U34","Murci&eacute;lago");
define("U35","Javal&iacute;");
define("U36","Lobo");
define("U37","Oso");
define("U38","Cocodrilo");
define("U39","Tigre");
define("U40","Elefante");

//NATARS UNITS
define("U41","Piquero");
define("U42","Guerrero Espinoso");
define("U43","Defensor");
define("U44","P&aacute;jaro de Presa");
define("U45","Hachero Jinete");
define("U46","Caballero Natariano");
define("U47","Elefante de Guerra");
define("U48","Ballesta");
define("U49","Emperador Natariano");

//INDEX.php
define("LOGIN","Entrar");
define("PLAYERS","Jugadores");
define("ONLINE","Conectados");
define("TUTORIAL","Tutorial");
define("PLAYER_STATISTICS","Estad&iacute;sticas de Jugadores");
define("TOTAL_PLAYERS","".PLAYERS." en total");
define("ACTIVE_PLAYERS","jugadores activos");
define("ONLINE_PLAYERS","".PLAYERS." conectados");
define("MP_STRATEGY_GAME","".SERVER_NAME." - el juego de estrategia multijugador.");
define("WHAT_IS","".SERVER_NAME." es uno de los juegos onlines m&aacute;s conocidos en el mundo. Como jugador de ".SERVER_NAME." puedes construir tu propio imperio, reclutar tu propio ejercito y pelear con tus aliados para la conquista del mundo.");
define("REGISTER_FOR_FREE","Registrase aqu&iacute; gratis!");
define("LATEST_GAME_WORLD","Nuevo mundo");
define("LATEST_GAME_WORLD2","Registrate en el &uacute;ltimo<br/>mundo y disfruta<br/>las ventajas de<br/>ser uno de los<br/>primeros jugadores.");
define("PLAY_NOW","Jugar ".SERVER_NAME." ahora");
define("LEARN_MORE","Aprende m&aacute;s sobre ".SERVER_NAME."!");
define("LEARN_MORE2","Ahora con un revolucionario<br>sistema y gr&aacute;ficos<br>completamente nuevos<br>Este clon es el mejor!");
define("COMUNITY","Comunidad");
define("BECOME_COMUNITY","Unete ahora!");
define("BECOME_COMUNITY2","Forma parte de una<br>de la mayor comunida<br>de jugadores del mundo.");
define("NEWS","Noticias");
define("SCREENSHOTS","Galer&iacute;a de Im&aacute;genes");
define("LEARN1","Mejora tus sembrados y minas para aumentar la producci&oacute;n de recursos. Necesitar&aacute;s recursos para construir y entrenar soldados.");
define("LEARN2","Construlle y mejora los edificios en tu aldea. Los edificios mejoran la infraestructura, aumentan la producci&oacute;n y te permiten investigar, entrenar y equipar tus tropas.");
define("LEARN3","Observa e interact&uacute;a con tus alrededores. Puedes hacer nuevos amigos o enemigos, Utiliza los oasis cercanos y asegura que tu imperio crezca y se fortalezca.");
define("LEARN4","Sigue tus logros y comp&aacute;rate con otros jugadores. Mira la tabla de los 10 mejores y lucha por obtener una medalla de la semana.");
define("LEARN5","Recibe reportes detallados de tus aventuras, intercambio y batallas.");
define("LEARN6","Intercambia informaci&oacute;n y s&eacute; diplom&aacute;tico con otros jugadores. Siempre recuerda que la comunicaci&oacute;n es la llave para obtener nuevos amigos y resolver viejas disputas.");
define("LOGIN_TO","Entrar a ". SERVER_NAME);
define("REGIN_TO","Registrarse en ". SERVER_NAME);
define("P_ONLINE","Jugadores en l&iacute;nea: ");
define("P_TOTAL","Jugadores en total: ");
define("CHOOSE","Escoja un servidor por favor.");
define("STARTED"," El servidor empez&oacute; hace ". round((time()-COMMENCE)/86400) ." d&iacute;as.");

//ANMELDEN.php
define("NICKNAME","Sobrenombre");
define("EMAIL","Correo");
define("PASSWORD","Contrase&ntilde;a");
define("ROMANS","Romanos");
define("TEUTONS","Germanos");
define("GAULS","Galos");
define("NW","Noroeste");
define("NE","Noreste");
define("SW","Suroeste");
define("SE","Sureste");
define("RANDOM","al azar");
define("ACCEPT_RULES"," Estoy de acuerdo con las reglas y las condiciones generales de uso.");
define("ONE_PER_SERVER","Cada jugador puede tener solo una cuenta en el servidor.");
define("BEFORE_REGISTER","Si deseas ver un resumen de las ventajas y desventajas de cada raza, puedes hacerlo <a href='../anleitung.php' target='_blank'>aqu&iacute;</a>.");
define("BUILDING_UPGRADING","Construyendo:");
define("HOURS","horas");


//ATTACKS ETC.
define("TROOP_MOVEMENTS","movimientos de tropa:");
define("ARRIVING_REINF_TROOPS","Refuerzos llegando ");
define("ARRIVING_REINF_TROOPS_SHORT","Refuer.");
define("OWN_ATTACKING_TROOPS","Tropas atacando");
define("ATTACK","Ataque");
define("OWN_REINFORCING_TROOPS","Reforzando");
define("TROOPS_DORF","Tropas:");
define("NEWVILLAGE","Nueva Aldea.");
define("FOUNDNEWVILLAGE","Fundando Nueva Aldea");
define("UNDERATTACK","Tropas atacantes llegando");
define("OASISATTACK","Tropas atacantes llegando");
define("OASISATTACKS","Oasis Att.");
define("RETURNFROM","Regreso de");
define("REINFORCEMENTFOR","Refuerzo para");
define("ATTACK_ON","Ataque contra");
define("RAID_ON","Asalto contra");
define("SCOUTING","Espiando a");
define("PRISONERS","Prisioneros");
define("PRISONERSIN","Prisioneros en");
define("PRISONERSFROM","Prisioneros de");
define("TROOPS","Tropas");
define("TROOPSFROM","Tropas de");
define("BOUNTY","Bot&iacute;n");
define("ARRIVAL","Llegada");
define("INCOMING_TROOPS","Tropas llegando");
define("TROOPS_ON_THEIR_WAY","Tropas saliendo");
define("OWN_TROOPS","Tropas propias");
define("ON","el");
define("AT","a las");
define("UPKEEP","Consumo");
define("SEND_BACK","Retirar");
define("TROOPS_IN_THE_VILLAGE","Tropas en esta aldea");
define("TROOPS_IN_OTHER_VILLAGE","Tropas en otras aldeas");
define("TROOPS_IN_OASIS","Tropas en oasis");
define("KILL","Matar");
define("FROM","aldea");
define("SEND_TROOPS","Enviar tropas");
define("TASKMASTER","Amo de las Misiones");
define("VILLAGE_OF_THE_ELDERS_TROOPS","Tropas de la Aldea de los Sabios Ancianos");


//LOGIN.php
define("COOKIES","Tienes que tener las cookies habilitadas para poder entrar. Si compartes ordenador con m&aacute;s jugadores o est&aacute;s en un lugar p&uacute;blico, aseg&uacute;rate de cerrar la sesi&oacute;n cuando salgas por tu propia seguridad.");
define("NAME","Nombre");
define("PW_FORGOTTEN","Olvid&oacute; la contrase&ntilde;a?");
define("PW_REQUEST","Entonces puede solicitar una que le ser&aacute enviada a su direcci&oacute;n de correo.");
define("PW_GENERATE","Pedir nueva contrase&ntilde;a");
define("EMAIL_NOT_VERIFIED","Correo no verificado!");
define("EMAIL_FOLLOW","Sigue este v&iacute;nculo para activar este enlace.");
define("VERIFY_EMAIL","Verificar Correo.");
define("SERVER_STARTS_IN","Servidor comenzar&aacute; en: ");
define("START_NOW","EMPIEZA AHORA");


//404.php
define("NOTHING_HERE","No hay nada ah&iacute;!");
define("WE_LOOKED","Buscamos 404 veces pero no encontramos nada");

//TIME RELATED
define("CALCULATED","Calculado en");
define("SERVER_TIME","Tiempo funcionando:");

//MASSMESSAGE.php
define("MASS","Contenido del mensaje");
define("MASS_SUBJECT","Asunto:");
define("MASS_COLOR","Color del Mensaje:");
define("MASS_REQUIRED","Todos los campos son requeridos");
define("MASS_UNITS","Imagenes (unidades):");
define("MASS_SHOWHIDE","Mostrar/Ocultar");
define("MASS_READ","Lee esto: despues de enviar un smiley, hay que a&ntilde;adir a la izquierda o la derecha despu&eacute;s de un n&uacute;mero de otro modo la imagen no funciona.");
define("MASS_CONFIRM","Confirmaci&oacute;n");
define("MASS_REALLY","Realmente quieres enviar un mensaje en masa?");
define("MASS_ABORT","Abortar?");
define("MASS_SENT","El mensaje en masa fue enviado");

//BUILDINGS
define("WOODCUTTER","Le&ntilde;ador");
define("CLAYPIT","Barrera");
define("IRONMINE","Mina de Hierro");
define("CROPLAND","Granja");
define("SAWMILL","Serrer&iacute;a");
define("BRICKYARD","Ladrillar");
define("IRONFOUNDRY","Fundici&oacute;n de hierro");
define("GRAINMILL","Molino");
define("BAKERY","Panader&iacute;a");
define("WAREHOUSE","Almac&eacute;n");
define("GRANARY","Granero");
define("BLACKSMITH","Herrer&iacute;a");
define("ARMOURY","Armer&iacute;a");
define("TOURNAMENTSQUARE","Plaza de torneos");
define("MAINBUILDING","Edificio Principal");
define("RALLYPOINT","Plaza de Reuniones");
define("OVERVIEW","Resumen");
define("RALLYPOINT_DESC","Aqui se re&uacute;nen las tropas de tu aldea. Desde aqu&iacute;, pueden ser enviadas para atacar, conquistar, asaltar, fundar otras aldeas o como refuerzos. <br \/> <br \/> Si hay menos unidades atacantes que el nivel de la plaza de reuniones entonces puedo ver el tipo de unidad. ");
define("MARKETPLACE","Mercado");
define("EMBASSY","Embajada");
define("BARRACKS","Cuartel");
define("STABLE","Establo");
define("WORKSHOP","Taller");
define("ACADEMY","Academia");
define("CRANNY","Escondite");
define("TOWNHALL","Centro C&iacute;vico");
define("RESIDENCE","Residencia");
define("PALACE","Palacio");
define("TREASURY","Tesorer&iacute;a");
define("TRADEOFFICE","Oficina de Comercio");
define("GREATBARRACKS","Gran Cuartel");
define("GREATSTABLE","Gran Establo");
define("CITYWALL","Muralla de piedra");
define("EARTHWALL","Muro de tierra");
define("PALISADE","Empalizada");
define("STONEMASON","Mansión del Arquitecto");
define("BREWERY","Cervecer&iacute;a");
define("TRAPPER","Trampero");
define("HEROSMANSION","Hogar del H&eacute;roe");
define("GREATWAREHOUSE","Gran Almac&eacute;n");
define("GREATGRANARY","Gran Granero");
define("WONDER","Maravilla del Mundo");
define("HORSEDRINKING","Bebedero Equino");
define("GREATWORKSHOP","Gran Taller");

//artefact
define("ARCHITECTS_DESC","Los edificios son m&aacute;s resistentes a los ataques de las catapultas y arietes.");
define("ARCHITECTS_SMALL","Peque&ntilde;os secretos  de la arquitectura");
define("ARCHITECTS_SMALLVILLAGE","Diamante Cincel");
define("ARCHITECTS_LARGE","Grandes secretos  de la arquitectura");
define("ARCHITECTS_LARGEVILLAGE","Martillo de M&aacute;rmol Gigante");
define("ARCHITECTS_UNIQUE","El gran secreto &uacute;nico de los arquitectos");
define("ARCHITECTS_UNIQUEVILLAGE","Pergaminos de Hemon");
define("HASTE_DESC","Las tropas recorrer&aacute;n las distancias en menor tiempo.");
define("HASTE_SMALL","Las botas ligeras de Titan");
define("HASTE_SMALLVILLAGE","Opalo de herradura");
define("HASTE_LARGE","Las grandes botas de Titan");
define("HASTE_LARGEVILLAGE","Carroza de Oro");
define("HASTE_UNIQUE","Las botas &uacute;nica de Titan ");
define("HASTE_UNIQUEVILLAGE","Sandalias Fil&iacute;pides");
define("EYESIGHT_DESC","Los emisarios, Equites Legati y Batidores son m&aacute;s efectivos espiando, y defendiendo contra ataques de espionaje. Todas las unidades esp&iacute;as en la aldea/cuenta as&iacute; como los esp&iacute;as enviados a realizar espionaje desde la aldea/cuenta se ver&aacute;n beneficiados. Adicionalmente, podr&aacute;s ver los diferentes tipos de tropas atacando a tu aldea/cuenta, pero no la cantidad de las mismas.");
define("EYESIGHT_SMALL","Peque&ntilde;os ojos de &aacute;guila");
define("EYESIGHT_SMALLVILLAGE","Historia de una rata");
define("EYESIGHT_LARGE","Grandes ojos de &aacute;guila");
define("EYESIGHT_LARGEVILLAGE","Carta de Generales");
define("EYESIGHT_UNIQUE","Ojos &uacute;nicos de la &aacute;guila");
define("EYESIGHT_UNIQUEVILLAGE","Diario de Sun Tzu");
define("DIET_DESC","Las tropas consumen menos cereal.");
define("DIET_SMALL","ligero Control de la dieta");
define("DIET_SMALLVILLAGE","Plato de Plata");
define("DIET_LARGE","Gran control de la dieta");
define("DIET_LARGEVILLAGE","Arco de Caza Sagrado");
define("DIET_UNIQUE","Control de la dieta &uacute;nica");
define("DIET_UNIQUEVILLAGE","C&aacute;liz del Rey Arthurs");
define("ACADEMIC_DESC","Las tropas son entrenadas m&aacute;s r&aacute;pido.");
define("ACADEMIC_SMALL","Entrenadores con ligero talento");
define("ACADEMIC_SMALLVILLAGE","Soldados de Sagrado Juramento");
define("ACADEMIC_LARGE","Entrenadores con gran talento");
define("ACADEMIC_LARGEVILLAGE","Declaraci&oacute;n de Guerra");
define("ACADEMIC_UNIQUE","Entrenadores con talento &uacute;nico");
define("ACADEMIC_UNIQUEVILLAGE","Memorias de Alejandro Magno");
define("STORAGE_DESC","Estos planos te Concede la habilidad para construir el almac&eacute;n grande y el granero grande");
define("STORAGE_SMALL","Peque&ntilde;o Plano de construcci&oacute;n para Gran Almac&eacute;n y Gran Granero");
define("STORAGE_SMALLVILLAGE","Bosquejo de Constructores");
define("STORAGE_LARGE","Gran Plano de construcci&oacute;n para Gran Almac&eacute;n y Gran Granero");
define("STORAGE_LARGEVILLAGE","Tableta de de Babilonia");
define("CONFUSION_DESC","El artefacto multiplica la capacidad del escondite y fuerza a las catapultas enemigas disparar a casualidad. El edificio de la maravilla podr&aacute; ser siempre seleccionado.");
define("CONFUSION_SMALL","Peque&ntilde;a Confusi&oacute;n de los Rivales");
define("CONFUSION_SMALLVILLAGE","Mapa de las Cavernas Ocultas");
define("CONFUSION_LARGE","Gran Confusi&oacute;n de los Rivales");
define("CONFUSION_LARGEVILLAGE","Taleguilla del Abismo");
define("CONFUSION_UNIQUE","Gran Confusi&oacute;n &uacute;nica de los Rivales");
define("CONFUSION_UNIQUEVILLAGE","Caballo de Troya");
define("FOOL_DESC","Este artefacto cambia el efecto cada 24 horas, y puede obtener el efecto de cualquier otro artefacto. El rango de acci&oacute;n del efecto tambi&eacute;n es determinado cada 24 horas. La versi&oacute;n normal de este artefacto puede garantizar tambi&eacute;n efectos negativos, como por ejemplo que las tropas sean m&aacute;s lentas, o que consuman m&aacute;s cereal. La versi&oacute;n &uacute;nica de este artefacto s&oacute;lo proporciona efectos positivos, pero el alcance de los efectos sigue siendo aleatorio. Puede garantizar un incremento de velocidad de 1% en las tropas, por ejemplo.");
define("FOOL_SMALL","Artefacto del Loco");
define("FOOL_SMALLVILLAGE","Colgante de la Travesura");
define("FOOL_UNIQUE","Artefacto &uacute;nico del Loco");
define("FOOL_UNIQUEVILLAGE","Manuscritos Prohibidos");
define("ARTEFACT","Misteriosas Reliquias
Mi se&ntilde;or, han aparecido misteriosas aldeas donde se dice que existen unos artefactos de gran poder, los ancianos del consejo las llaman reliquias.

Completamente resguardadas por la poderosa raza Natares y su temido ej&eacute;rcito, pero no ser&aacute; impedimento para vos valeroso emperador, O s&iacute;. 

Vuestros generales me han comentado que su ej&eacute;rcito crece y crece m&aacute;s, pronto podremos apoderarnos de esas reliquias, los talleres fabrican vuestras catapultas para destruir el tesoro que guarda la reliquia y vuestro mejor soldado nuestro h&eacute;roe se entrena cada vez m&aacute;s fuerte para poder traerle esta reliquia.

Pero las tropas y los aldeanos necesitan de motivaci&oacute;n, usted mi se&ntilde;or debe de generar esa fuerza necesaria para llevarnos a todos al triunfo y a la gloria. 

La mitad del camino ha llegado, la victoria est&aacute; en sus manos mi se&ntilde;or. ");


//planos
define("PLAN","Planos de construcci&oacute;n antigua");
define("PLANVILLAGE","Planos de Construcci&oacute;n MM");
define("PLAN_DESC","Con este plano de construcci&oacute;n antigua usted ser&aacute; capaz de construir una Maravilla del Mundo a nivel 50. para construir un mayor nivel, su alianza debe tener por lo menos dos planos.");
define("PLAN_INFO","El tiempo ha llegado.

Ahora que los d&iacute;as son m&aacute;s cortos y las noches m&aacute;s fr&iacute;as, la gente de Travian se da cuenta que el final de esta era se acerca. La leyenda de gloriosas batallas y lujosos edificios de eras pasadas... parec&iacute;a ser todo lo que queda de aquel entonces. Pero las masas decidieron que este no ser&iacute;a el modo como esta era terminar&iacute;a.

Una maravilla deber&iacute;a ser construida, un edificio de infinita grandeza y poder. Esta maravilla deber&iacute;a unir a todos los habitantes de Travian.

Tristemente, el conocimiento de las gloriosas maravillas se hab&iacute;a perdido, llevado a la tumba por sus ya desaparecidos antepasados. Justo antes de que la gente perdiera toda esperanza, el destino gui&oacute; su atenci&oacute;n hacia la ancestral tribu de los Natares. Esa tribu ancestral, superviviente a muchas eras y sangrientas batallas, puede poseer a&uacute;n algunos de los planos de construcci&oacute;n necesarios para las maravillas, pero una sensaci&oacute;n extra&ntilde;a parece emanar de ellos...

La Leyenda de los Natares.

Una vez, antes de que los Romanos invadieran Travian, las ahora libres razas Galas y Germanas estaban esclavizadas por los Natares. Los Natares eran una raza muy especial, que habr&iacute;a sido olvidada en el tiempo de no ser por las historias a&uacute;n contadas por ancianas, nodrizas y vagabundos.

Ellos dominaban todo Travian y entre todo su poder y crueldad pose&iacute;an un conocimiento completo acerca de las fuerzas elementales que nunca ser&iacute;a superado. Muy poco se sabe de esta raza, s&oacute;lo quedan los informes de un testigo que vivi&oacute; el poder Natare, y sobrevivi&oacute; el paso de las eras.

Quien lea este informe, encontrar&aacute; la descripci&oacute;n de una Ciudad de Oro con un templo situado en el centro de la ciudad, una maravilla de indescriptible grandeza y poder. Tambi&eacute;n habla de secretos y arcaicos lugares donde estos templos pueden ser erguidos. Lugares donde toda la sabidur&iacute;a y conocimiento de los Natares puede ser encontrado para, una vez m&aacute;s, esclavizar Travian.

Los planes de los Natares.

Los Natares tienes planes propios y quieren esclavizar las razas libres para construir una maravilla. Sin embargo, quien sea que construya una maravilla en su lugar conseguir&aacute; la &uacute;ltima gesta de convertir Travian en un mundo de paz y unidad. Al final de esta era, podremos ver si la gente libre de Travian consigue llevar a cabo esta intr&eacute;pida y gloriosa haza&ntilde;a, si las futuras historias, ser&aacute;n acerca de valientes alianzas o de los odiados Natares.


Para robar un conjunto de Planes de la construcci&oacute;n de los Natares , las siguientes cosas deben suceder :
- Usted debe atacar la aldea ( NO en Asalto !)
- Usted debe ganar el ataque
- Debes destruir a la C&aacute;mara del Tesoro (Hacienda)
- Tu h&eacute;roe debe ser en ese ataque , ya que es el &uacute;nico que puede llevar a los planes de construcci&oacute;n
- Un nivel de vac&iacute;o 10 C&aacute;mara del Tesoro ( Tesoro ) DEBE estar en el pueblo donde el ataque provino de
NOTA : Si no se cumplen los criterios mencionados en el ataque , el pr&oacute;ximo ataque a ese pueblo que no cumple con los criterios anteriores se llevar&aacute; a los planes de construcci&oacute;n.


Construir una C&aacute;mara del Tesoro (Hacienda) , se necesita un nivel de Edificio Principal 10 y el pueblo no debe ser una capital o contener una Maravilla del Mundo .

Para construir una Maravilla del Mundo , debe poseer los Planes de construcci&oacute;n a ti mismo ( que = la Maravilla del Mundo Village propietario ) desde el nivel 0 a 49, y luego desde el nivel de 50 a 100 se necesita un conjunto adicional de Planes de la construcci&oacute;n en su Alianza ! Dos juegos de planos de construcci&oacute;n en la Cuenta de World Village Wonder no funcionan !");
define("WWVILLAGE","Aldea MM");

/*
|--------------------------------------------------------------------------
|   Index
|--------------------------------------------------------------------------
*/

	   $lang['index'][0][1] = "Bienvenido a " . SERVER_NAME . "";
	   $lang['index'][0][2] = "Manual";
	   $lang['index'][0][3] = "Juega ahora, gratis!";
	   $lang['index'][0][4] = "¿Qué es" . SERVER_NAME . "";
	   $lang['index'][0][5] = "" . SERVER_NAME . " Es un <b>juego de navegador</b> con un mundo antiguo atractivo con miles de otros jugadores reales.</p><p>Es <strong>libre para jugar </strong> y no requiere <strong>descargar nada</strong>.";
	   $lang['index'][0][6] = "Haga clic aquí para jugar" . SERVER_NAME . "";
	   $lang['index'][0][7] = "Total de jugadores";
	   $lang['index'][0][8] = "Jugadores activos";
	   $lang['index'][0][9] = "Jugadores en línea";
	   $lang['index'][0][10] = "Sobre el juego";
	   $lang['index'][0][11] = "Usted va a comenzar como el jefe de una pequeña aldea y se embarcan en una emocionante aventura.";
	   $lang['index'][0][12] = "Construye aldeas, luchar o establecer rutas de comercio con sus vecinos.";
	   $lang['index'][0][13] = "Juega con y contra miles de jugadores reales, y conquistar el mundo de Travian.";
	   $lang['index'][0][14] = "Noticias";
	   $lang['index'][0][15] = "FAQ";
	   $lang['index'][0][16] = "Screenshots";
	   $lang['forum'] = "Foro";
	   $lang['register'] = "Registro";
	   $lang['login'] = "Login";


?>
