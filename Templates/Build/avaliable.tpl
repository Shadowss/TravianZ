<?php
$normalA = $database->getOwnArtefactInfoByType($village->wid,6);  
$largeA = $database->getOwnUniqueArtefactInfo($session->uid,6,2);

$mainbuilding = $building->getTypeLevel(15);
$cranny = $building->getTypeLevel(23);
$granary = $building->getTypeLevel(11);
$warehouse = $building->getTypeLevel(10);
$embassy = $building->getTypeLevel(18);
$wall = $village->resarray['f40'];
$rallypoint = $building->getTypeLevel(16);
$hero = $building->getTypeLevel(37);
$market = $building->getTypeLevel(17);
$barrack = $building->getTypeLevel(19);
$cropland = $building->getTypeLevel(4);
$grainmill = $building->getTypeLevel(8);
$residence = $building->getTypeLevel(25);
$academy = $building->getTypeLevel(22);
$armoury = $building->getTypeLevel(13);
$woodcutter = $building->getTypeLevel(1);
$palace = $building->getTypeLevel(26);
$claypit = $building->getTypeLevel(2);
$ironmine = $building->getTypeLevel(3);
$blacksmith = $building->getTypeLevel(12);
$stable = $building->getTypeLevel(20);
$trapper = $building->getTypeLevel(36);
$treasury = $building->getTypeLevel(27);
$sawmill = $building->getTypeLevel(5);
$brickyard = $building->getTypeLevel(6);
$ironfoundry = $building->getTypeLevel(7);
$workshop = $building->getTypeLevel(21);
$stonemasonslodge = $building->getTypeLevel(34);
$townhall = $building->getTypeLevel(24);
$tournamentsquare = $building->getTypeLevel(14);
$bakery = $building->getTypeLevel(9);
$tradeoffice = $building->getTypeLevel(28);
$greatbarracks = $building->getTypeLevel(29);
$greatstable = $building->getTypeLevel(30);
$brewery = $building->getTypeLevel(35);
$horsedrinkingtrough = $building->getTypeLevel(41);
$herosmansion = $building->getTypeLevel(37);
$greatwarehouse = $building->getTypeLevel(38);
$greatgranary = $building->getTypeLevel(39);  
$greatworkshop = $building->getTypeLevel(42);

foreach ($database->getJobs($_SESSION['wid']) as $bdata) {
    $UnderConstruction = strtolower(str_replace(array(" ","'"),"",$building->procResType($bdata['type'])));
    $$UnderConstruction = ($$UnderConstruction == 0 ? -1 : $$UnderConstruction);
}


?>
<div id="build" class="gid0"><h1>Construct new building</h1>
<?php
if($mainbuilding == 0 && $id != 39  && $id != 40) {
    include("avaliable/mainbuilding.tpl");
}
if(($cranny == 0 || $cranny == 10) && $mainbuilding >= 1 && $id != 39 && $id != 40) {
    include("avaliable/cranny.tpl");
}
if(($granary == 0 || $granary == 20) && $mainbuilding >= 1 && $id != 39 && $id != 40 ) {
    include("avaliable/granary.tpl");
}
if($wall == 0) {
    if($session->tribe == 1 && $id != 39) {
    include("avaliable/citywall.tpl");
    }
    if($session->tribe == 2 && $id != 39) {
    include("avaliable/earthwall.tpl");
    }
    if($session->tribe == 3 && $id != 39) {
    include("avaliable/palisade.tpl");
    }
    if($session->tribe == 4 && $id != 39) {
    include("avaliable/earthwall.tpl");
    }
     if($session->tribe == 5 && $id != 39) {
    include("avaliable/citywall.tpl");
    }
}
if(($warehouse == 0 || $warehouse == 20) && $mainbuilding >= 1 && $id != 39 && $id != 40) {
include("avaliable/warehouse.tpl");
}
if($mainbuilding >= 10 && $village->capital == 0 && $largeA['owner'] == $session->uid || $normalA['vref'] == $village->wid ) {
    include("avaliable/greatwarehouse.tpl");
}
if($mainbuilding >= 10 && $village->capital == 0 && $largeA['owner'] == $session->uid || $normalA['vref'] == $village->wid ) {
    include("avaliable/greatgranary.tpl");
}  
if(($trapper ==0 || $trapper == 20) && $rallypoint >= 1 && $session->tribe == 3 && $id != 39 && $id != 40) {
include("avaliable/trapper.tpl");
}
if($rallypoint == 0 && $id != 40) {
include("avaliable/rallypoint.tpl");
}
if($embassy == 0 && $id != 39 && $id != 40) {
include("avaliable/embassy.tpl");
}
//fix hero
if($hero == 0 && $mainbuilding >= 3 && $rallypoint >= 1 && $$UnderConstruction <> -1 && $id != 39  && $id != 40) {
include("avaliable/hero.tpl");
}
//fix barracks
if($rallypoint >= 1 && $mainbuilding >= 3 && $barrack == 0 && $$UnderConstruction <> -1 && $id != 39 && $id != 40) {
include("avaliable/barracks.tpl");
}
if($mainbuilding >= 3 && $academy >= 1 && $armoury == 0 && $id != 39 && $id != 40) {
include("avaliable/armoury.tpl");
}
if($cropland >= 5 && $grainmill == 0 && $id != 39 && $id != 40) {
include("avaliable/grainmill.tpl");
}
//fix marketplace
if($granary >= 1 && $warehouse >= 1 && $mainbuilding >= 3 && $market == 0 && $$UnderConstruction <> -1 && $id != 39 && $id != 40) {
include("avaliable/marketplace.tpl");
}
//fix residence
if($mainbuilding >= 5 && $residence == 0  && $$UnderConstruction <> -1 && $id != 39 && $id != 40 && $palace == 0) {
include("avaliable/residence.tpl");
}
if($academy == 0 && $mainbuilding >= 3 && $barrack >= 3 && $id != 39 && $id != 40) {
include("avaliable/academy.tpl");
}
//fix palace
if($palace == 0 && $embassy >= 1 && $mainbuilding >= 5 && $id != 39 && $id != 40 && $residence == 0) {

//Fix Castle
//id user
$user = $session->uid;

//connect to DB
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);

//loop search village user
$query = mysql_query("SELECT * FROM ".TB_PREFIX."vdata WHERE owner = ".$user."");
while($villaggi_array = mysql_fetch_array($query)){

	//loop structure village
	$query1 = mysql_query("SELECT * FROM ".TB_PREFIX."fdata WHERE vref = ".$villaggi_array['wref']."");
	$strutture= mysql_fetch_array($query1);

//search Castle in array structure village 
$test =	in_array(26,$strutture);
if ($test){	
	break;
	}

}


//if Castle no ready include palace.tpl
if (!$test){
	include("avaliable/palace.tpl");
}

//end Fix
}
if($blacksmith == 0 && $academy >= 3 && $mainbuilding >= 3 && $id != 39 && $id != 40) {
include("avaliable/blacksmith.tpl");
}
if($stonemasonslodge == 0 && $palace >= 3 && $mainbuilding >= 5 && $id != 39 && $id != 40 && $village->capital == 1) {
include("avaliable/stonemason.tpl");
}
if($stable == 0 && $blacksmith >= 3 && $academy >= 5 && $id != 39 && $id != 40) {
include("avaliable/stable.tpl");
}
if($treasury == 0 && $mainbuilding >= 10  && $id != 39 && $id != 40) {
include("avaliable/treasury.tpl");
}
if($brickyard == 0 && $claypit >= 10 && $mainbuilding >= 5  && $id != 39 && $id != 40 ) {
include("avaliable/brickyard.tpl");
}
if($sawmill == 0 && $woodcutter >= 10 && $mainbuilding >= 5  && $id != 39 && $id != 40) {
   include("avaliable/sawmill.tpl");
  }
if($ironfoundry == 0 && $ironmine >= 10 && $mainbuilding >= 5  && $id != 39 && $id != 40) {
   include("avaliable/ironfoundry.tpl");
}
if($workshop == 0 && $academy >= 10 && $mainbuilding  >= 5  && $id != 39 && $id != 40) {
   include("avaliable/workshop.tpl");
}
if($tournamentsquare == 0 && $rallypoint >= 15  && $id != 39 && $id != 40) {
    include("avaliable/tsquare.tpl");
}
if($bakery == 0 && $grainmill >= 5 && $cropland >= 10 && $mainbuilding >= 5  && $id != 39 && $id != 40) {
    include("avaliable/bakery.tpl");
}
if($townhall == 0 && $mainbuilding >= 10 && $academy >= 10  && $id != 39 && $id != 40) {
    include("avaliable/townhall.tpl");
}
if($tradeoffice == 0 && $market == 20 && $stable >= 10  && $id != 39 && $id != 40) {
    include("avaliable/tradeoffice.tpl");
}
if($session->tribe == 1 && $horsedrinkingtrough == 0 && $rallypoint >= 10 && $stable == 20  && $id != 39 && $id != 40) {
    include("avaliable/horsedrinking.tpl");
}
if($session->tribe == 2 && $brewery == 0 && $rallypoint >= 10 && $granary == 20  && $id != 39 && $id != 40) {
    include("avaliable/brewery.tpl");
}
if($greatbarracks == 0 && $barrack == 20 && $village->capital == 0 && $id != 39 && $id != 40) {
    include("avaliable/greatbarracks.tpl");
}
if($greatstable == 0 && $stable == 20 && $village->capital == 0 && $id != 39 && $id != 40) {
    include("avaliable/greatstable.tpl");
}
if($greatworkshop == 0 && $workshop == 20 && $village->capital == 0 && $id != 39 && $id != 40 && GREAT_WKS) {
    include("avaliable/greatworkshop.tpl");
}
if($id != 39 && $id != 40) {
?>
<p class="switch"><a id="soon_link" href="javascript:show_build_list('soon');">show soon available buildings</a></p>

<div id="build_list_soon" class="hide">
<?php
if($rallypoint == 0 && $session->tribe == 3 && $trapper == 0 ) {
include("soon/trapper.tpl");
}
if($mainbuilding < 10 && $village->capital == 0 && $largeA['owner'] == $session->uid || $normalA['vref'] == $village->wid ) {
    include("soon/greatwarehouse.tpl");
}
if($mainbuilding < 10 && $village->capital == 0 && $largeA['owner'] == $session->uid || $normalA['vref'] == $village->wid ) {
    include("soon/greatgranary.tpl");
} 
if($hero == 0 && ($mainbuilding <= 2 || $rallypoint == 0)){
    include("soon/hero.tpl");
}
if($barrack == 0 && ($rallypoint == 0 || $mainbuilding <= 2) ) {
    include("soon/barracks.tpl");
}
if($armoury == 0 && ($mainbuilding <= 2 || $academy == 0)) {
    include("soon/armoury.tpl");
}
if($cropland <= 4) {
   include("soon/grainmill.tpl");
}
if($marketplace == 0 && ($mainbuilding <= 2 || $granary <= 0 || $warehouse <= 0)) {
   include("soon/marketplace.tpl");
}
if($residence == 0 && $mainbuilding <= 4) {
   include("soon/residence.tpl");
}
if($academy == 0 && ($mainbuilding <= 2 || $barrack <= 2)) {
   include("soon/academy.tpl");
}
if($embassy == 0 || $mainbuilding >= 2 && $mainbuilding <= 4) {

//Fix Castle
//id user
$user = $session->uid;

//connect to DB
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);

//loop search village user
$query = mysql_query("SELECT * FROM ".TB_PREFIX."vdata WHERE owner = ".$user."");
while($villaggi_array = mysql_fetch_array($query)){

	//loop structure village
	$query1 = mysql_query("SELECT * FROM ".TB_PREFIX."fdata WHERE vref = ".$villaggi_array['wref']."");
	$strutture= mysql_fetch_array($query1);

//search Castle in array structure village 
$test =	in_array(26,$strutture);
if ($test){	
	break;
	}

}


//if Castle no ready include palace.tpl
if (!$test){
	include("soon/palace.tpl");
}

   //end Fix
}
if($blacksmith == 0 && ($academy <= 2 || $mainbuilding <= 2)) {
   include("soon/blacksmith.tpl");
}
if($stonemasonslodge == 0 && $palace <= 2  && $palace != 0 && $mainbuilding >= 2 && $mainbuilding <= 4 && $residence == 0) {
   include("soon/stonemason.tpl");
}
if($stable == 0 && (($blacksmith <= 2 && $blacksmith != 0) || ($academy >= 2 && $academy <= 4))) {
   include("soon/stable.tpl");
}
if($treasury == 0 && $mainbuilding <= 9 && $mainbuilding >= 5) {
   include("soon/treasury.tpl");
}
if($brickyard == 0 && $claypit <= 9  && $claypit >= 5 && $mainbuilding >= 2  && $mainbuilding <= 4) {
   include("soon/brickyard.tpl");
}
if($sawmill == 0 && $woodcutter <= 9 && $woodcutter >= 5 && $mainbuilding >= 2 && $mainbuilding <= 4) {
   include("soon/sawmill.tpl");
}
if($ironfoundry == 0 && $ironmine <= 9 && $ironmine >= 5 && $mainbuilding >= 2 && $mainbuilding <= 4) {
   include("soon/ironfoundry.tpl");
}
if($workshop == 0 && $academy <= 9 && $academy >= 5 && $mainbuilding >= 2 && $mainbuilding <= 4) {
   include("soon/workshop.tpl");
}
if($tournamentsquare == 0 && $rallypoint <= 14 && $rallypoint >= 7) {
    include("soon/tsquare.tpl");
}
if($bakery == 0 && $grainmill <= 4 && $grainmill != 0 && $cropland >= 5 &&  $cropland <= 9 && $mainbuilding >= 2 && $mainbuilding <= 4) {
    include("soon/bakery.tpl");
}
if($townhall == 0 && ($mainbuilding <= 9 && $mainbuilding >= 5) || ($academy >= 5 && $academy <= 9)) {
    include("soon/townhall.tpl");
}
if($tradeoffice == 0 && $market <= 19 && $market >= 10 || $stable >= 5 && $stable <= 9) {
    include("soon/tradeoffice.tpl");
}
if($session->tribe == 1 && $horsedrinkingtrough == 0 && $rallypoint <= 9 && $rallypoint >= 5 || $stable <= 19 && $stable >= 10 && $session->tribe == 1) {
    include("soon/horsedrinking.tpl");
    }
if($brewery == 0 && $rallypoint <= 9 && $rallypoint >= 5 || $granary <= 19 && $granary >= 10 && $session->tribe == 2) {
    include("soon/brewery.tpl");
}
if($greatbarracks == 0 && $barrack >= 18 && $village->capital == 0) {
    include("soon/greatbarracks.tpl");
}
if($greatstable == 0 && $stable >= 18 && $village->capital == 0) {
    include("soon/greatstable.tpl");
}
if($greatworkshop == 0 && $workshop >= 18 && $village->capital == 0 && GREAT_WKS) {
    include("soon/greatworkshop.tpl");
}
   ?>
    </div><p class="switch"><a id="all_link" class="hide"
    href="javascript:show_build_list('all');">show more</a></p>
    
    <div id="build_list_all" class="hide">
    <?php
    if($academy == 0 && ($mainbuilding == 1 || $barrack == 0)) {
    include("soon/academy.tpl");
    }
    if($palace == 0 && ($embassy == 0 || $mainbuilding <= 2)) {
    include("soon/palace.tpl");
    }
    if($blacksmith == 0 && ($academy == 0 || $mainbuilding == 1)) {
    include("soon/blacksmith.tpl");
    }
    if($stonemason == 0 && ($palace == 0 || $mainbuilding <= 2) && $residence == 0 && $village->capital == 1) {
    include("soon/stonemason.tpl");
    }
    if($stable == 0 && ($blacksmith == 0 || $academy <= 2)) {
    include("soon/stable.tpl");
    }
    if($treasury == 0 && $mainbuilding <= 5) {
    include("soon/treasury.tpl");
    }
    if($brickyard == 0 && ($claypit <= 5 || $mainbuilding <= 2)) {
    include("soon/brickyard.tpl");
    }
    if($sawmill == 0 && ($woodcutter <= 5 || $mainbuilding <= 2)) {
    include("soon/sawmill.tpl");
    }
    if($ironfoundry == 0 && ($ironmine <= 5 || $mainbuilding <= 2)) {
    include("soon/ironfoundry.tpl");
    }
    if($workshop == 0 && ($academy <= 5 || $mainbuilding <= 2)) {
    include("soon/workshop.tpl");
    }
    if($tournamentsquare == 0 && $rallypoint <= 7) {
    include("soon/tsquare.tpl");
    }
    if($bakery == 0 && ($grainmill == 0 || $cropland <= 5 || $mainbuilding <= 2)) {
    include("soon/bakery.tpl");
    }
    if($townhall == 0 && ($mainbuilding <= 5 || $academy <= 5)) {
    include("soon/townhall.tpl");
    }
    if($tradeoffice == 0 && ($market <= 10 || $stable <= 5)) {
    include("soon/tradeoffice.tpl");
    }
    if($session->tribe == 1 && $horsedrinkingtrough == 0 && ($rallypoint <= 5 || $stable <= 10)) {
    include("soon/horsedrinking.tpl");
    }
    if($brewery == 0 && ($rallypoint <= 5 || $granary <= 10) && $session->tribe == 2) {
    include("soon/brewery.tpl");
    }
    if($greatbarracks == 0 && $barrack >= 15 && $village->capital == 0) {
        include("soon/greatbarracks.tpl");
    }
    if($greatstable == 0 && $stable >= 15 && $village->capital == 0) {
        include("soon/greatstable.tpl");
    }
    if($greatworkshop == 0 && $workshop >= 15 && $village->capital == 0 && GREAT_WKS) {
        include("soon/greatworkshop.tpl");
    }
    ?>
    </div><script language="JavaScript" type="text/javascript">
function show_build_list(list) {
    // aktuelle liste, aktueller link
    var build_list = document.getElementById('build_list_'+list);
    var link = document.getElementById(list+'_link');

    var all_link = document.getElementById('all_link');
    var soon_link = document.getElementById('soon_link');

    var build_list_all = document.getElementById('build_list_all');
    var build_list_soon = document.getElementById('build_list_soon');

    if (build_list.className == 'hide') {
        build_list.className = '';
        if (link == soon_link) {
            link.innerHTML = 'hide soon available buildings';
            if (all_link !== null) {
                all_link.className = '';
            }
        } else {
            link.innerHTML = 'hide more';
        }
    } else {
        build_list.className = 'hide';
        if (link == soon_link) {
            link.innerHTML = 'show soon available buildings';
            if (all_link !== null) {
                all_link.innerHTML = 'show more';
                all_link.className = 'hide';
                build_list_all.className = 'hide';
            }
        } else {
            link.innerHTML = 'show more';
        }
    }
}
</script>
<?php 
}
?>
</div>