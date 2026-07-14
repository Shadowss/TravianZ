<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : unitdata.php                      	                       ##
##  Type           : Data Page for Units                                       ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki 						                               ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  URLs:          : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

$unitsbytype=array('infantry'=>array(1,2,3,11,12,13,14,21,22,31,32,33,34,41,42,43,44,51,52,61,62,63,71,72,73,74,81,82,83,84),'cavalry'=>array(4,5,6,15,16,23,24,25,26,35,36,45,46,53,54,55,56,64,65,66,75,76,85,86),'siege'=>array(7,8,17,18,27,28,37,38,47,48,57,58,67,68,77,78,87,88),'ram'=>array(7,17,27,47,57,67,77,87),'catapult'=>array(8,18,28,48,58,68,78,88),'expansion'=>array(9,10,19,20,29,30,39,40,49,50,59,60,69,70,79,80,89,90),'scout'=>array(4,14,23,44,52,64,74,82),'chief'=>array(9,19,29,49,59,69,79,89));

$u1=array('atk'=>40,'di'=>35,'dc'=>50,'wood'=>120,'clay'=>100,'iron'=>150,'crop'=>30,'pop'=>1,'speed'=>6,'time'=>1600,'cap'=>50);
$u2=array('atk'=>30,'di'=>65,'dc'=>35,'wood'=>100,'clay'=>130,'iron'=>160,'crop'=>70,'pop'=>1,'speed'=>5,'time'=>1760,'cap'=>20);
$u3=array('atk'=>70,'di'=>40,'dc'=>25,'wood'=>150,'clay'=>160,'iron'=>210,'crop'=>80,'pop'=>1,'speed'=>7,'time'=>1920,'cap'=>50);
$u4=array('atk'=>0,'di'=>20,'dc'=>10,'wood'=>140,'clay'=>160,'iron'=>20,'crop'=>40,'pop'=>2,'speed'=>16,'time'=>1360,'cap'=>0,'drinking'=>10);
$u5=array('atk'=>120,'di'=>65,'dc'=>50,'wood'=>550,'clay'=>440,'iron'=>320,'crop'=>100,'pop'=>3,'speed'=>14,'time'=>2640,'cap'=>100,'drinking'=>15);
$u6=array('atk'=>180,'di'=>80,'dc'=>105,'wood'=>550,'clay'=>640,'iron'=>800,'crop'=>180,'pop'=>4,'speed'=>10,'time'=>3520,'cap'=>70,'drinking'=>20);
$u7=array('atk'=>60,'di'=>30,'dc'=>75,'wood'=>900,'clay'=>360,'iron'=>500,'crop'=>70,'pop'=>3,'speed'=>4,'time'=>4600,'cap'=>0);
$u8=array('atk'=>75,'di'=>60,'dc'=>10,'wood'=>950,'clay'=>1350,'iron'=>600,'crop'=>90,'pop'=>6,'speed'=>3,'time'=>9000,'cap'=>0);
$u9=array('atk'=>50,'di'=>40,'dc'=>30,'wood'=>30750,'clay'=>27200,'iron'=>45000,'crop'=>37500,'pop'=>5,'speed'=>5,'time'=>90700,'cap'=>0);
$u10=array('atk'=>0,'di'=>80,'dc'=>80,'wood'=>5800,'clay'=>5300,'iron'=>7200,'crop'=>5500,'pop'=>1,'speed'=>5,'time'=>26900,'cap'=>3000);
$u11=array('atk'=>40,'di'=>20,'dc'=>5,'wood'=>95,'clay'=>75,'iron'=>40,'crop'=>40,'pop'=>1,'speed'=>7,'time'=>720,'cap'=>60);
$u12=array('atk'=>10,'di'=>35,'dc'=>60,'wood'=>145,'clay'=>70,'iron'=>85,'crop'=>40,'pop'=>1,'speed'=>7,'time'=>1120,'cap'=>40);
$u13=array('atk'=>60,'di'=>30,'dc'=>30,'wood'=>130,'clay'=>120,'iron'=>170,'crop'=>70,'pop'=>1,'speed'=>6,'time'=>1200,'cap'=>50);
$u14=array('atk'=>0,'di'=>10,'dc'=>5,'wood'=>160,'clay'=>100,'iron'=>50,'crop'=>50,'pop'=>1,'speed'=>9,'time'=>1120,'cap'=>0);
$u15=array('atk'=>55,'di'=>100,'dc'=>40,'wood'=>370,'clay'=>270,'iron'=>290,'crop'=>75,'pop'=>2,'speed'=>10,'time'=>2400,'cap'=>110);
$u16=array('atk'=>150,'di'=>50,'dc'=>75,'wood'=>450,'clay'=>515,'iron'=>480,'crop'=>80,'pop'=>3,'speed'=>9,'time'=>2960,'cap'=>80);
$u17=array('atk'=>65,'di'=>30,'dc'=>80,'wood'=>1000,'clay'=>300,'iron'=>350,'crop'=>70,'pop'=>3,'speed'=>4,'time'=>4200,'cap'=>0);
$u18=array('atk'=>50,'di'=>60,'dc'=>10,'wood'=>900,'clay'=>1200,'iron'=>600,'crop'=>60,'pop'=>6,'speed'=>3,'time'=>9000,'cap'=>0);
$u19=array('atk'=>40,'di'=>60,'dc'=>40,'wood'=>35500,'clay'=>26600,'iron'=>25000,'crop'=>27200,'pop'=>4,'speed'=>5,'time'=>70500,'cap'=>0);
$u20=array('atk'=>10,'di'=>80,'dc'=>80,'wood'=>7200,'clay'=>5500,'iron'=>5800,'crop'=>6500,'pop'=>1,'speed'=>5,'time'=>31000,'cap'=>3000);
$u21=array('atk'=>15,'di'=>40,'dc'=>50,'wood'=>100,'clay'=>130,'iron'=>55,'crop'=>30,'pop'=>1,'speed'=>7,'time'=>1040,'cap'=>35);
$u22=array('atk'=>65,'di'=>35,'dc'=>20,'wood'=>140,'clay'=>150,'iron'=>185,'crop'=>60,'pop'=>1,'speed'=>6,'time'=>1440,'cap'=>45);
$u23=array('atk'=>0,'di'=>20,'dc'=>10,'wood'=>170,'clay'=>150,'iron'=>20,'crop'=>40,'pop'=>2,'speed'=>17,'time'=>1360,'cap'=>0);
$u24=array('atk'=>90,'di'=>25,'dc'=>40,'wood'=>350,'clay'=>450,'iron'=>230,'crop'=>60,'pop'=>2,'speed'=>19,'time'=>2480,'cap'=>75);
$u25=array('atk'=>45,'di'=>115,'dc'=>55,'wood'=>360,'clay'=>330,'iron'=>280,'crop'=>120,'pop'=>2,'speed'=>16,'time'=>2560,'cap'=>35);
$u26=array('atk'=>140,'di'=>50,'dc'=>165,'wood'=>500,'clay'=>620,'iron'=>675,'crop'=>170,'pop'=>3,'speed'=>13,'time'=>3120,'cap'=>65);
$u27=array('atk'=>50,'di'=>30,'dc'=>105,'wood'=>950,'clay'=>555,'iron'=>330,'crop'=>75,'pop'=>3,'speed'=>4,'time'=>5000,'cap'=>0);
$u28=array('atk'=>70,'di'=>45,'dc'=>10,'wood'=>960,'clay'=>1450,'iron'=>630,'crop'=>90,'pop'=>6,'speed'=>3,'time'=>9000,'cap'=>0);
$u29=array('atk'=>40,'di'=>50,'dc'=>50,'wood'=>30750,'clay'=>45400,'iron'=>31000,'crop'=>37500,'pop'=>4,'speed'=>4,'time'=>90700,'cap'=>0);
$u30=array('atk'=>0,'di'=>80,'dc'=>80,'wood'=>5500,'clay'=>7000,'iron'=>5300,'crop'=>4900,'pop'=>1,'speed'=>5,'time'=>22700,'cap'=>3000);
$u31=array('atk'=>10,'di'=>25,'dc'=>20,'wood'=>85,'clay'=>75,'iron'=>120,'crop'=>25,'speed'=>7,'pop'=>1,'time'=>1600,'cap'=>45);
$u32=array('atk'=>20,'di'=>35,'dc'=>40,'wood'=>125,'clay'=>130,'iron'=>60,'crop'=>40,'speed'=>7,'pop'=>1,'time'=>1800,'cap'=>65);
$u33=array('atk'=>60,'di'=>40,'dc'=>60,'wood'=>140,'clay'=>150,'iron'=>40,'crop'=>60,'speed'=>6,'pop'=>1,'time'=>1900,'cap'=>80);
$u34=array('atk'=>10,'di'=>66,'dc'=>50,'wood'=>95,'clay'=>120,'iron'=>65,'crop'=>25,'speed'=>9,'pop'=>1,'time'=>2000,'cap'=>0);
$u35=array('atk'=>50,'di'=>70,'dc'=>33,'wood'=>250,'clay'=>200,'iron'=>125,'crop'=>45,'speed'=>10,'pop'=>2,'time'=>2000,'cap'=>120);
$u36=array('atk'=>100,'di'=>80,'dc'=>70,'wood'=>250,'clay'=>125,'iron'=>250,'crop'=>150,'speed'=>9,'pop'=>2,'time'=>2000,'cap'=>150);
$u37=array('atk'=>250,'di'=>140,'dc'=>200,'wood'=>250,'clay'=>220,'iron'=>135,'crop'=>50,'speed'=>4,'pop'=>3,'time'=>2000,'cap'=>125);
$u38=array('atk'=>450,'di'=>380,'dc'=>240,'wood'=>125,'clay'=>250,'iron'=>300,'crop'=>65,'speed'=>3,'pop'=>3,'time'=>2000,'cap'=>0);
$u39=array('atk'=>200,'di'=>170,'dc'=>250,'wood'=>350,'clay'=>350,'iron'=>125,'crop'=>80,'speed'=>5,'pop'=>3,'time'=>70500,'cap'=>0);
$u40=array('atk'=>600,'di'=>440,'dc'=>520,'wood'=>350,'clay'=>250,'iron'=>135,'crop'=>100,'speed'=>5,'pop'=>5,'time'=>31000,'cap'=>3000);
$u41=array('atk'=>20,'di'=>35,'dc'=>50,'wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'pop'=>1,'speed'=>6,'time'=>0,'cap'=>0);
$u42=array('atk'=>65,'di'=>30,'dc'=>10,'wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'pop'=>1,'speed'=>7,'time'=>0,'cap'=>0);
$u43=array('atk'=>100,'di'=>90,'dc'=>75,'wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'pop'=>1,'speed'=>6,'time'=>0,'cap'=>0);
$u44=array('atk'=>0,'di'=>50,'dc'=>25,'wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'pop'=>2,'speed'=>25,'time'=>0,'cap'=>0);
$u45=array('atk'=>155,'di'=>80,'dc'=>50,'wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'pop'=>2,'speed'=>14,'time'=>0,'cap'=>0);
$u46=array('atk'=>170,'di'=>140,'dc'=>80,'wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'pop'=>3,'speed'=>12,'time'=>0,'cap'=>0);
$u47=array('atk'=>250,'di'=>120,'dc'=>150,'wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'pop'=>4,'speed'=>5,'time'=>0,'cap'=>0);
$u48=array('atk'=>60,'di'=>45,'dc'=>10,'wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'pop'=>5,'speed'=>3,'time'=>0,'cap'=>0);
$u49=array('atk'=>80,'di'=>50,'dc'=>50,'wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'pop'=>1,'speed'=>5,'time'=>0,'cap'=>0);
$u50=array('atk'=>30,'di'=>40,'dc'=>40,'wood'=>0,'clay'=>0,'iron'=>0,'crop'=>0,'pop'=>1,'speed'=>5,'time'=>0,'cap'=>0);
//HUN UNITS (TRIBE 6)
$u51=array('atk'=>35,'di'=>40,'dc'=>30,'wood'=>130,'clay'=>80,'iron'=>40,'crop'=>40,'pop'=>1,'speed'=>6,'time'=>1120,'cap'=>50);
$u52=array('atk'=>0,'di'=>20,'dc'=>10,'wood'=>170,'clay'=>150,'iron'=>20,'crop'=>40,'pop'=>2,'speed'=>19,'time'=>1360,'cap'=>0);
$u53=array('atk'=>120,'di'=>30,'dc'=>15,'wood'=>290,'clay'=>370,'iron'=>190,'crop'=>45,'pop'=>2,'speed'=>16,'time'=>2400,'cap'=>75);
$u54=array('atk'=>110,'di'=>80,'dc'=>70,'wood'=>320,'clay'=>350,'iron'=>330,'crop'=>50,'pop'=>2,'speed'=>15,'time'=>2480,'cap'=>105);
$u55=array('atk'=>180,'di'=>60,'dc'=>40,'wood'=>450,'clay'=>560,'iron'=>610,'crop'=>140,'pop'=>3,'speed'=>14,'time'=>2960,'cap'=>80);
$u56=array('atk'=>230,'di'=>90,'dc'=>65,'wood'=>660,'clay'=>750,'iron'=>800,'crop'=>180,'pop'=>4,'speed'=>13,'time'=>3520,'cap'=>70);
$u57=array('atk'=>65,'di'=>30,'dc'=>90,'wood'=>1060,'clay'=>330,'iron'=>360,'crop'=>70,'pop'=>3,'speed'=>4,'time'=>4400,'cap'=>0);
$u58=array('atk'=>45,'di'=>55,'dc'=>10,'wood'=>950,'clay'=>1280,'iron'=>620,'crop'=>60,'pop'=>6,'speed'=>3,'time'=>9000,'cap'=>0);
$u59=array('atk'=>50,'di'=>40,'dc'=>30,'wood'=>37200,'clay'=>27600,'iron'=>25200,'crop'=>27600,'pop'=>5,'speed'=>5,'time'=>90700,'cap'=>0);
$u60=array('atk'=>10,'di'=>80,'dc'=>80,'wood'=>6100,'clay'=>4600,'iron'=>4800,'crop'=>5400,'pop'=>1,'speed'=>5,'time'=>28950,'cap'=>3000);
//EGYPTIAN UNITS (TRIBE 7)
$u61=array('atk'=>10,'di'=>30,'dc'=>20,'wood'=>45,'clay'=>60,'iron'=>30,'crop'=>30,'pop'=>1,'speed'=>7,'time'=>640,'cap'=>20);
$u62=array('atk'=>30,'di'=>55,'dc'=>40,'wood'=>115,'clay'=>100,'iron'=>145,'crop'=>60,'pop'=>1,'speed'=>6,'time'=>1450,'cap'=>45);
$u63=array('atk'=>25,'di'=>110,'dc'=>80,'wood'=>170,'clay'=>180,'iron'=>220,'crop'=>80,'pop'=>1,'speed'=>6,'time'=>1760,'cap'=>35);
$u64=array('atk'=>0,'di'=>20,'dc'=>10,'wood'=>170,'clay'=>150,'iron'=>20,'crop'=>40,'pop'=>2,'speed'=>16,'time'=>1360,'cap'=>0);
$u65=array('atk'=>50,'di'=>110,'dc'=>50,'wood'=>360,'clay'=>330,'iron'=>280,'crop'=>120,'pop'=>2,'speed'=>15,'time'=>2560,'cap'=>50);
$u66=array('atk'=>110,'di'=>120,'dc'=>150,'wood'=>450,'clay'=>560,'iron'=>610,'crop'=>180,'pop'=>3,'speed'=>10,'time'=>3120,'cap'=>70);
$u67=array('atk'=>55,'di'=>30,'dc'=>95,'wood'=>995,'clay'=>575,'iron'=>340,'crop'=>80,'pop'=>3,'speed'=>4,'time'=>4800,'cap'=>0);
$u68=array('atk'=>65,'di'=>55,'dc'=>10,'wood'=>980,'clay'=>1510,'iron'=>660,'crop'=>100,'pop'=>6,'speed'=>3,'time'=>9000,'cap'=>0);
$u69=array('atk'=>40,'di'=>50,'dc'=>50,'wood'=>34000,'clay'=>50000,'iron'=>34000,'crop'=>42000,'pop'=>4,'speed'=>4,'time'=>90700,'cap'=>0);
$u70=array('atk'=>0,'di'=>80,'dc'=>80,'wood'=>5040,'clay'=>6510,'iron'=>4830,'crop'=>4620,'pop'=>1,'speed'=>5,'time'=>24800,'cap'=>3000);
//SPARTAN UNITS (TRIBE 8)
$u71=array('atk'=>50,'di'=>35,'dc'=>30,'wood'=>110,'clay'=>185,'iron'=>110,'crop'=>35,'pop'=>1,'speed'=>6,'time'=>1700,'cap'=>60);
$u72=array('atk'=>40,'di'=>85,'dc'=>45,'wood'=>145,'clay'=>95,'iron'=>245,'crop'=>45,'pop'=>1,'speed'=>6,'time'=>1950,'cap'=>40);
$u73=array('atk'=>95,'di'=>80,'dc'=>75,'wood'=>130,'clay'=>200,'iron'=>400,'crop'=>65,'pop'=>1,'speed'=>5,'time'=>2200,'cap'=>50);
$u74=array('atk'=>0,'di'=>25,'dc'=>12,'wood'=>185,'clay'=>150,'iron'=>35,'crop'=>75,'pop'=>2,'speed'=>16,'time'=>1360,'cap'=>0);
$u75=array('atk'=>55,'di'=>120,'dc'=>90,'wood'=>555,'clay'=>445,'iron'=>330,'crop'=>110,'pop'=>2,'speed'=>16,'time'=>2600,'cap'=>110);
$u76=array('atk'=>195,'di'=>55,'dc'=>80,'wood'=>660,'clay'=>495,'iron'=>995,'crop'=>165,'pop'=>3,'speed'=>9,'time'=>3450,'cap'=>80);
$u77=array('atk'=>65,'di'=>30,'dc'=>85,'wood'=>980,'clay'=>545,'iron'=>390,'crop'=>80,'pop'=>3,'speed'=>4,'time'=>4600,'cap'=>0);
$u78=array('atk'=>60,'di'=>55,'dc'=>10,'wood'=>1200,'clay'=>1240,'iron'=>610,'crop'=>80,'pop'=>6,'speed'=>3,'time'=>9000,'cap'=>0);
$u79=array('atk'=>45,'di'=>50,'dc'=>45,'wood'=>33450,'clay'=>30665,'iron'=>36240,'crop'=>27375,'pop'=>4,'speed'=>4,'time'=>90700,'cap'=>0);
$u80=array('atk'=>10,'di'=>80,'dc'=>80,'wood'=>5115,'clay'=>5580,'iron'=>6360,'crop'=>4485,'pop'=>1,'speed'=>5,'time'=>26900,'cap'=>3000);
//VIKING UNITS (TRIBE 9)
$u81=array('atk'=>45,'di'=>30,'dc'=>15,'wood'=>105,'clay'=>85,'iron'=>65,'crop'=>35,'pop'=>1,'speed'=>7,'time'=>960,'cap'=>70);
$u82=array('atk'=>0,'di'=>15,'dc'=>8,'wood'=>155,'clay'=>110,'iron'=>45,'crop'=>45,'pop'=>1,'speed'=>10,'time'=>1120,'cap'=>0);
$u83=array('atk'=>70,'di'=>35,'dc'=>25,'wood'=>145,'clay'=>135,'iron'=>185,'crop'=>70,'pop'=>1,'speed'=>6,'time'=>1400,'cap'=>55);
$u84=array('atk'=>105,'di'=>45,'dc'=>30,'wood'=>190,'clay'=>220,'iron'=>340,'crop'=>90,'pop'=>2,'speed'=>6,'time'=>1960,'cap'=>60);
$u85=array('atk'=>100,'di'=>70,'dc'=>55,'wood'=>415,'clay'=>380,'iron'=>305,'crop'=>85,'pop'=>2,'speed'=>12,'time'=>2640,'cap'=>90);
$u86=array('atk'=>165,'di'=>95,'dc'=>100,'wood'=>590,'clay'=>640,'iron'=>715,'crop'=>160,'pop'=>3,'speed'=>10,'time'=>3300,'cap'=>75);
$u87=array('atk'=>65,'di'=>35,'dc'=>80,'wood'=>1010,'clay'=>415,'iron'=>440,'crop'=>75,'pop'=>3,'speed'=>4,'time'=>4700,'cap'=>0);
$u88=array('atk'=>55,'di'=>60,'dc'=>10,'wood'=>930,'clay'=>1350,'iron'=>640,'crop'=>80,'pop'=>6,'speed'=>3,'time'=>9000,'cap'=>0);
$u89=array('atk'=>50,'di'=>45,'dc'=>40,'wood'=>35800,'clay'=>29200,'iron'=>28600,'crop'=>31500,'pop'=>4,'speed'=>5,'time'=>90700,'cap'=>0);
$u90=array('atk'=>10,'di'=>80,'dc'=>80,'wood'=>5900,'clay'=>5200,'iron'=>5700,'crop'=>5800,'pop'=>1,'speed'=>5,'time'=>27500,'cap'=>3000);
$u99=array('atk'=>0,'di'=>0,'dc'=>0,'wood'=>20,'clay'=>30,'iron'=>10,'crop'=>20,'speed'=>0,'pop'=>0,'time'=>600,'cap'=>0);
// Hero data base values and increase per point
$h1=array('atk'=>50,'atkp'=>54,'di'=>60,'dip'=>49,'dc'=>85,'dcp'=>62.5);
$h2=array('atk'=>40,'atkp'=>46.5,'di'=>100,'dip'=>75.5,'dc'=>60,'dcp'=>47.5);
$h3=array('atk'=>90,'atkp'=>74,'di'=>65,'dip'=>57,'dc'=>40,'dcp'=>42);
$h5=array('atk'=>150,'atkp'=>107.5,'di'=>100,'dip'=>73,'dc'=>85,'dcp'=>59);
$h6=array('atk'=>225,'atkp'=>147.5,'di'=>135,'dip'=>79,'dc'=>175,'dcp'=>99);
$h11=array('atk'=>50,'atkp'=>54,'di'=>35,'dip'=>49.5,'dc'=>10,'dcp'=>24);
$h12=array('atk'=>15,'atkp'=>34,'di'=>60,'dip'=>48,'dc'=>100,'dcp'=>70.5);
$h13=array('atk'=>75,'atkp'=>67.5,'di'=>50,'dip'=>47.5,'dc'=>50,'dcp'=>47.5);
$h15=array('atk'=>70,'atkp'=>64,'di'=>165,'dip'=>100,'dc'=>65,'dcp'=>39.5);
$h16=array('atk'=>190,'atkp'=>127.5,'di'=>85,'dip'=>58.5,'dc'=>125,'dcp'=>80);
$h21=array('atk'=>20,'atkp'=>37.5,'di'=>65,'dip'=>53,'dc'=>85,'dcp'=>62);
$h22=array('atk'=>80,'atkp'=>71,'di'=>60,'dip'=>54,'dc'=>35,'dcp'=>38);
$h24=array('atk'=>115,'atkp'=>87.5,'di'=>40,'dip'=>42,'dc'=>65,'dcp'=>57);
$h25=array('atk'=>55,'atkp'=>57.5,'di'=>190,'dip'=>108.5,'dc'=>90,'dcp'=>60.5);
$h26=array('atk'=>175,'atkp'=>121,'di'=>85,'dip'=>55,'dc'=>275,'dcp'=>145);
// New tribe heroes - scaled from templates h1/h2/h3/h5/h6 by unit stat ratio
//HUN HEROES (TRIBE 6) - no hero for scout u52
$h51=array('atk'=>44,'atkp'=>47.5,'di'=>68.5,'dip'=>56,'dc'=>51,'dcp'=>37.5);
$h53=array('atk'=>150,'atkp'=>107.5,'di'=>46,'dip'=>33.5,'dc'=>25.5,'dcp'=>17.5);
$h54=array('atk'=>137.5,'atkp'=>98.5,'di'=>123,'dip'=>90,'dc'=>119,'dcp'=>82.5);
$h55=array('atk'=>225,'atkp'=>147.5,'di'=>101.5,'dip'=>59.5,'dc'=>66.5,'dcp'=>37.5);
$h56=array('atk'=>287.5,'atkp'=>188.5,'di'=>152,'dip'=>89,'dc'=>108.5,'dcp'=>61.5);
//EGYPTIAN HEROES (TRIBE 7) - no hero for scout u64
$h61=array('atk'=>12.5,'atkp'=>13.5,'di'=>51.5,'dip'=>42,'dc'=>34,'dcp'=>25);
$h62=array('atk'=>40,'atkp'=>46.5,'di'=>84.5,'dip'=>64,'dc'=>68.5,'dcp'=>54.5);
$h63=array('atk'=>33.5,'atkp'=>39,'di'=>169,'dip'=>128,'dc'=>137,'dcp'=>108.5);
$h65=array('atk'=>62.5,'atkp'=>45,'di'=>169,'dip'=>123.5,'dc'=>85,'dcp'=>59);
$h66=array('atk'=>137.5,'atkp'=>90,'di'=>202.5,'dip'=>118.5,'dc'=>250,'dcp'=>141.5);
//SPARTAN HEROES (TRIBE 8) - no hero for scout u74
$h71=array('atk'=>62.5,'atkp'=>67.5,'di'=>60,'dip'=>49,'dc'=>51,'dcp'=>37.5);
$h72=array('atk'=>53.5,'atkp'=>62,'di'=>131,'dip'=>98.5,'dc'=>77,'dcp'=>61);
$h73=array('atk'=>122,'atkp'=>100.5,'di'=>130,'dip'=>114,'dc'=>120,'dcp'=>126);
$h75=array('atk'=>69,'atkp'=>49.5,'di'=>184.5,'dip'=>135,'dc'=>153,'dcp'=>106);
$h76=array('atk'=>244,'atkp'=>160,'di'=>93,'dip'=>54.5,'dc'=>133.5,'dcp'=>75.5);
//VIKING HEROES (TRIBE 9) - no hero for scout u82
$h81=array('atk'=>56.5,'atkp'=>61,'di'=>51.5,'dip'=>42,'dc'=>25.5,'dcp'=>19);
$h83=array('atk'=>90,'atkp'=>74,'di'=>57,'dip'=>50,'dc'=>40,'dcp'=>42);
$h84=array('atk'=>135,'atkp'=>111,'di'=>73,'dip'=>64,'dc'=>48,'dcp'=>50.5);
$h85=array('atk'=>125,'atkp'=>89.5,'di'=>107.5,'dip'=>78.5,'dc'=>93.5,'dcp'=>65);
$h86=array('atk'=>206.5,'atkp'=>135,'di'=>160.5,'dip'=>94,'dc'=>166.5,'dcp'=>94.5);
?>
