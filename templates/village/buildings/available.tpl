<?php
$artifactsSum = $database->getArtifactsSumByKind($session->uid, $village->wid, 6);
$GreatGranaryWarehouseBuildable = $artifactsSum['small'] > 0 || $artifactsSum['large'] > 0;

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

$typesArray = [];
for ($i = 1; $i <= 42; $i++) {
    $typesArray[] = $i;
}

global $typeCounts;
$typeCounts = $database->getBuildingByType2($village->wid, $typesArray);

function getTypeCount($id) {
    global $typeCounts;

    return (isset($typeCounts[$id]) ? $typeCounts[$id] : 0);
}

$mainbuilding1 = getTypeCount(15);
$cranny1 = getTypeCount(23);
$granary1 = getTypeCount(11);
$warehouse1 = getTypeCount(10);
$embassy1 = getTypeCount(18);
$wall1 = $database->getBuildingByField2($village->wid,40);
$rallypoint1 = getTypeCount(16);
$hero1 = getTypeCount(37);
$market1 = getTypeCount(17);
$barrack1 = getTypeCount(19);
$cropland1 = getTypeCount(4);
$grainmill1 = getTypeCount(8);
$residence1 = getTypeCount(25);
$academy1 = getTypeCount(22);
$armoury1 = getTypeCount(13);
$woodcutter1 = getTypeCount(1);
$palace1 = getTypeCount(26);
$claypit1 = getTypeCount(2);
$ironmine1 = getTypeCount(3);
$blacksmith1 = getTypeCount(12);
$stable1 = getTypeCount(20);
$trapper1 = getTypeCount(36);
$treasury1 = getTypeCount(27);
$sawmill1 = getTypeCount(5);
$brickyard1 = getTypeCount(6);
$ironfoundry1 = getTypeCount(7);
$workshop1 = getTypeCount(21);
$stonemasonslodge1 = getTypeCount(34);
$townhall1 = getTypeCount(24);
$tournamentsquare1 = getTypeCount(14);
$bakery1 = getTypeCount(9);
$tradeoffice1 = getTypeCount(28);
$greatbarracks1 = getTypeCount(29);
$greatstable1 = getTypeCount(30);
$brewery1 = getTypeCount(35);
$horsedrinkingtrough1 = getTypeCount(41);
$herosmansion1 = getTypeCount(37);
$greatwarehouse1 = getTypeCount(38);
$greatgranary1 = getTypeCount(39);
$greatworkshop1 = getTypeCount(42);

?>
<div id="build" class="gid0"><h1><?php echo CONSTRUCT_NEW_BUILDING;?></h1>
<?php
if($mainbuilding == 0 && $mainbuilding1 == 0 && $id != 39 && $id != 40) {
  templates("avaliable/mainbuilding.tpl");
}
if((($cranny == 0 && $cranny1 == 0) || $cranny == 10) && $mainbuilding >= 1 && $id != 39 && $id != 40) {
  templates("avaliable/cranny.tpl");
}
if((($granary == 0 && $granary1 == 0) || $granary == 20) && $mainbuilding >= 1 && $id != 39 && $id != 40 ) {
  templates("avaliable/granary.tpl");
}
if($wall == 0 && $wall1 == 0) {
    if($session->tribe == 1 && $id != 39) {
      templates("avaliable/citywall.tpl");
    }
    if($session->tribe == 2 && $id != 39) {
      templates("avaliable/earthwall.tpl");
    }
    if($session->tribe == 3 && $id != 39) {
      templates("avaliable/palisade.tpl");
    }
    if($session->tribe == 4 && $id != 39) {
      templates("avaliable/earthwall.tpl");
    }
    if($session->tribe == 5 && $id != 39) {
      templates("avaliable/citywall.tpl");
    }
}
if((($warehouse == 0 && $warehouse1 == 0) || $warehouse == 20) && $mainbuilding >= 1 && $id != 39 && $id != 40) {
  templates("avaliable/warehouse.tpl");
}
if((($greatwarehouse == 0 && $greatwarehouse1 == 0) || $greatwarehouse == 20) && $mainbuilding >= 10 && ($GreatGranaryWarehouseBuildable || $village->natar == 1) && ($id != 39 && $id != 40)) {
  templates("avaliable/greatwarehouse.tpl");
}
if((($greatgranary == 0 && $greatgranary1 == 0) || $greatgranary == 20) && $mainbuilding >= 10 && ($GreatGranaryWarehouseBuildable  || $village->natar == 1) && ($id != 39 && $id != 40)) {
  templates("avaliable/greatgranary.tpl");
}
if((($trapper == 0 && $trapper1 == 0) || $trapper == 20) && $rallypoint >= 1 && $session->tribe == 3 && $id != 39 && $id != 40) {
  templates("avaliable/trapper.tpl");
}
if($rallypoint == 0 && $rallypoint1 == 0 && $id != 40) {
  templates("avaliable/rallypoint.tpl");
}
if($embassy == 0 && $embassy1 == 0 && $id != 39 && $id != 40 && $mainbuilding >= 1) {
  templates("avaliable/embassy.tpl");
}
//fix hero
if($hero == 0 && $hero1 == 0 && $mainbuilding >= 3 && $rallypoint >= 1 && $id != 39 && $id != 40) {
  templates("avaliable/hero.tpl");
}
//fix barracks
if($rallypoint >= 1 && $mainbuilding >= 3 && $barrack == 0 && $barrack1 == 0 && $id != 39 && $id != 40) {
  templates("avaliable/barracks.tpl");
}
if($mainbuilding >= 3 && $academy >= 1 && $armoury == 0 && $armoury1 == 0 && $id != 39 && $id != 40) {
  templates("avaliable/armoury.tpl");
}
if($cropland >= 5 && $grainmill == 0 && $grainmill1 == 0 && $id != 39 && $id != 40) {
  templates("avaliable/grainmill.tpl");
}
//fix marketplace
if($granary >= 1 && $warehouse >= 1 && $mainbuilding >= 3 && $market == 0 && $market1 == 0 && $id != 39 && $id != 40) {
  templates("avaliable/marketplace.tpl");
}
if($mainbuilding >= 5 && $residence == 0 && $residence1 == 0 && $id != 39 && $id != 40 && $palace == 0 && $palace1 == 0) {
  templates("avaliable/residence.tpl");
}
if($academy == 0 && $academy1 == 0 && $mainbuilding >= 3 && $barrack >= 3 && $id != 39 && $id != 40) {
  templates("avaliable/academy.tpl");
}
if($palace == 0 && $palace1 == 0 && !$building->isCastleBuilt() && $village->natar == 0 && $embassy >= 1 && $mainbuilding >= 5 && $id != 39 && $id != 40 && $residence == 0 && $residence1 == 0) {
  templates("avaliable/palace.tpl");
}
if($blacksmith == 0 && $blacksmith1 == 0 && $academy >= 3 && $mainbuilding >= 3 && $id != 39 && $id != 40) {
  templates("avaliable/blacksmith.tpl");
}
if($stonemasonslodge == 0 && $stonemasonslodge1 == 0 && $palace >= 3 && $mainbuilding >= 5 && $id != 39 && $id != 40) {
  templates("avaliable/stonemason.tpl");
}
if($stable == 0 && $stable1 == 0 && $blacksmith >= 3 && $academy >= 5 && $id != 39 && $id != 40) {
  templates("avaliable/stable.tpl");
}
if($treasury == 0 && $treasury1 == 0 && $village->natar == 0 && $mainbuilding >= 10 && $id != 39 && $id != 40) {
  templates("avaliable/treasury.tpl");
}
if($brickyard == 0 && $brickyard1 == 0 && $claypit >= 10 && $mainbuilding >= 5 && $id != 39 && $id != 40 ) {
  templates("avaliable/brickyard.tpl");
}
if($sawmill == 0 && $sawmill1 == 0 && $woodcutter >= 10 && $mainbuilding >= 5 && $id != 39 && $id != 40) {
  templates("avaliable/sawmill.tpl");
}
if($ironfoundry == 0 && $ironfoundry1 == 0 && $ironmine >= 10 && $mainbuilding >= 5 && $id != 39 && $id != 40) {
  templates("avaliable/ironfoundry.tpl");
}
if($workshop == 0 && $workshop1 == 0 && $academy >= 10 && $mainbuilding >= 5 && $id != 39 && $id != 40) {
  templates("avaliable/workshop.tpl");
}
if($tournamentsquare == 0 && $tournamentsquare1 == 0 && $rallypoint >= 15 && $id != 39 && $id != 40) {
  templates("avaliable/tsquare.tpl");
}
if($bakery == 0 && $bakery1 == 0 && $grainmill >= 5 && $cropland >= 10 && $mainbuilding >= 5 && $id != 39 && $id != 40) {
  templates("avaliable/bakery.tpl");
}
if($townhall == 0 && $townhall1 == 0 && $mainbuilding >= 10 && $academy >= 10 && $id != 39 && $id != 40) {
  templates("avaliable/townhall.tpl");
}
if($tradeoffice == 0 && $tradeoffice1 == 0 && $market == 20 && $stable >= 10 && $id != 39 && $id != 40) {
  templates("avaliable/tradeoffice.tpl");
}
if($session->tribe == 1 && $horsedrinkingtrough == 0 && $horsedrinkingtrough1 == 0 && $rallypoint >= 10 && $stable == 20 && $id != 39 && $id != 40) {
  templates("avaliable/horsedrinking.tpl");
}
if($session->tribe == 2 && $village->capital == 1 && $brewery == 0 && $brewery1 == 0 && $rallypoint >= 10 && $granary == 20 && $id != 39 && $id != 40) {
  templates("avaliable/brewery.tpl");
}
if($greatbarracks == 0 && $greatbarracks1 == 0 && $barrack == 20 && $village->capital == 0 && $id != 39 && $id != 40) {
  templates("avaliable/greatbarracks.tpl");
}
if($greatstable == 0 && $greatstable1 == 0 && $stable == 20 && $village->capital == 0 && $id != 39 && $id != 40) {
  templates("avaliable/greatstable.tpl");
}
if($greatworkshop == 0 && $greatworkshop1 == 0 && $workshop == 20 && $village->capital == 0 && $id != 39 && $id != 40 && GREAT_WKS) {
  templates("avaliable/greatworkshop.tpl");
}
if($id != 39 && $id != 40) {
?>
<p class="switch"><a id="soon_link" href="javascript:show_build_list('soon');"><?php echo SHOWSOON_AVAILABLE_BUILDINGS;?></a></p>

<div id="build_list_soon" class="hide">
<?php
if($rallypoint == 0 && $session->tribe == 3 && $trapper == 0 ) {templates("soon/trapper.tpl");
}
if($mainbuilding < 10 && $warehouse < 10 && $village->capital == 0 && $GreatGranaryWarehouseBuildable) {
  templates("soon/greatwarehouse.tpl");
}
if($mainbuilding < 10 && $granary < 10 && $village->capital == 0 && $GreatGranaryWarehouseBuildable) {
  templates("soon/greatgranary.tpl");
}
if($hero == 0 && ($mainbuilding <= 2 || $rallypoint == 0)){
  templates("soon/hero.tpl");
}
if($barrack == 0 && ($rallypoint == 0 || $mainbuilding <= 2) ) {
  templates("soon/barracks.tpl");
}
if($armoury == 0 && ($mainbuilding <= 2 || $academy == 0)) {
  templates("soon/armoury.tpl");
}
if($cropland <= 4) {
  templates("soon/grainmill.tpl");
}
if($market == 0 && ($mainbuilding <= 2 || $granary <= 0 || $warehouse <= 0)) {
  templates("soon/marketplace.tpl");
}
if($residence == 0 && $mainbuilding <= 4) {
  templates("soon/residence.tpl");
}
if($academy == 0 && ($mainbuilding <= 2 || $barrack <= 2)) {
  templates("soon/academy.tpl");
}
if($embassy == 0 || $mainbuilding >= 2 && $mainbuilding <= 4 && !$building->isCastleBuilt() && $village->natar == 0) {
  templates("soon/palace.tpl");
}
if($blacksmith == 0 && ($academy <= 2 || $mainbuilding <= 2)) {
  templates("soon/blacksmith.tpl");
}
if($stonemasonslodge == 0 && $palace <= 2 && $palace != 0 && $mainbuilding >= 2 && $mainbuilding <= 4 && $residence == 0 && $village->capital == 1) {
  templates("soon/stonemason.tpl");
}
if($stable == 0 && (($blacksmith <= 2 && $blacksmith != 0) || ($academy >= 2 && $academy <= 4))) {
  templates("soon/stable.tpl");
}
if($treasury == 0 && $mainbuilding <= 9 && $mainbuilding >= 5 && $village->natar == 0) {
  templates("soon/treasury.tpl");
}
if($brickyard == 0 && $claypit <= 9 && $claypit >= 5 && $mainbuilding >= 2 && $mainbuilding <= 4) {
  templates("soon/brickyard.tpl");
}
if($sawmill == 0 && $woodcutter <= 9 && $woodcutter >= 5 && $mainbuilding >= 2 && $mainbuilding <= 4) {
  templates("soon/sawmill.tpl");
}
if($ironfoundry == 0 && $ironmine <= 9 && $ironmine >= 5 && $mainbuilding >= 2 && $mainbuilding <= 4) {
  templates("soon/ironfoundry.tpl");
}
if($workshop == 0 && $academy <= 9 && $academy >= 5 && $mainbuilding >= 2 && $mainbuilding <= 4) {
  templates("soon/workshop.tpl");
}
if($tournamentsquare == 0 && $rallypoint <= 14 && $rallypoint >= 7) {
  templates("soon/tsquare.tpl");
}
if($bakery == 0 && ($grainmill >= 1 && $cropland >= 5 || $mainbuilding >= 2 && ($grainmill >= 1 || $cropland >= 5))) {
  templates("soon/bakery.tpl");
}
if($townhall == 0 && ($mainbuilding <= 9 && $mainbuilding >= 5) || ($academy >= 5 && $academy <= 9)) {
  templates("soon/townhall.tpl");
}
if($tradeoffice == 0 && $market <= 19 && $market >= 10 || $stable >= 5 && $stable <= 9) {
  templates("soon/tradeoffice.tpl");
}
if($session->tribe == 1 && $horsedrinkingtrough == 0 && $rallypoint <= 9 && $rallypoint >= 5 || $stable <= 19 && $stable >= 10 && $session->tribe == 1) {
  templates("soon/horsedrinking.tpl");
}
if($brewery == 0 && $village->capital == 1 && $rallypoint <= 9 && $rallypoint >= 5 || $granary <= 19 && $granary >= 10 && $session->tribe == 2) {
  templates("soon/brewery.tpl");
}
if($greatbarracks == 0 && $barrack >= 18 && $village->capital == 0) {
  templates("soon/greatbarracks.tpl");
}
if($greatstable == 0 && $stable >= 18 && $village->capital == 0) {
  templates("soon/greatstable.tpl");
}
if($greatworkshop == 0 && $workshop >= 18 && $village->capital == 0 && GREAT_WKS) {
  templates("soon/greatworkshop.tpl");
}
?>
</div><p class="switch"><a id="all_link" class="hide"
href="javascript:show_build_list('all');"><?php echo SHOW_MORE;?></a></p>
<div id="build_list_all" class="hide">
<?php
if($academy == 0 && ($mainbuilding == 1 || $barrack == 0)) {
    inctemplates("soon/academy.tpl");
}
if($palace == 0 && ($embassy == 0 || $mainbuilding <= 2) && $village->natar == 0) {
    inctemplates("soon/palace.tpl");
}
if($blacksmith == 0 && ($academy == 0 || $mainbuilding == 1)) {
    inctemplates("soon/blacksmith.tpl");
}
if($stonemason == 0 && ($palace == 0 || $mainbuilding <= 2) && $residence == 0) {
    inctemplates("soon/stonemason.tpl");
}
if($stable == 0 && ($blacksmith == 0 || $academy <= 2)) {
    inctemplates("soon/stable.tpl");
}
if($treasury == 0 && $mainbuilding <= 5) {
    inctemplates("soon/treasury.tpl");
}
if($brickyard == 0 && ($claypit <= 5 || $mainbuilding <= 2)) {
    inctemplates("soon/brickyard.tpl");
}
if($sawmill == 0 && ($woodcutter <= 5 || $mainbuilding <= 2)) {
    inctemplates("soon/sawmill.tpl");
}
if($ironfoundry == 0 && ($ironmine <= 5 || $mainbuilding <= 2)) {
    inctemplates("soon/ironfoundry.tpl");
}
if($workshop == 0 && ($academy <= 5 || $mainbuilding <= 2)) {
    inctemplates("soon/workshop.tpl");
}
if($tournamentsquare == 0 && $rallypoint <= 7) {
    inctemplates("soon/tsquare.tpl");
}
if($bakery == 0 && ($grainmill == 0 || $cropland <= 5 || $mainbuilding <= 2)) {
    inctemplates("soon/bakery.tpl");
}
if($townhall == 0 && ($mainbuilding <= 5 || $academy <= 5)) {
    inctemplates("soon/townhall.tpl");
}
if($tradeoffice == 0 && ($market <= 10 || $stable <= 5)) {
    inctemplates("soon/tradeoffice.tpl");
}
if($session->tribe == 1 && $horsedrinkingtrough == 0 && ($rallypoint <= 5 || $stable <= 10)) {
    inctemplates("soon/horsedrinking.tpl");
}
if($brewery == 0 && ($rallypoint <= 5 || $granary <= 10) && $session->tribe == 2 && $village->capital == 1) {
    inctemplates("soon/brewery.tpl");
}
if($greatbarracks == 0 && $barrack >= 15 && $village->capital == 0) {
    inctemplates("soon/greatbarracks.tpl");
}
if($greatstable == 0 && $stable >= 15 && $village->capital == 0) {
    inctemplates("soon/greatstable.tpl");
}
if($greatworkshop == 0 && $workshop >= 15 && $village->capital == 0 && GREAT_WKS) {
    inctemplates("soon/greatworkshop.tpl");
}
?>
</div><script type="text/javascript">
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
            link.innerHTML = '<?php echo HIDESOON_AVAILABLE_BUILDINGS;?>';
            if (all_link !== null) {
                all_link.className = '';
            }
} else {
            link.innerHTML = '<?php echo HIDE_MORE;?>';
        }
} else {
        build_list.className = 'hide';
        if (link == soon_link) {
            link.innerHTML = '<?php echo SHOWSOON_AVAILABLE_BUILDINGS;?>';
            if (all_link !== null) {
                all_link.innerHTML = 'show more';
                all_link.className = 'hide';
                build_list_all.className = 'hide';
            }
} else {
            link.innerHTML = '<?php echo SHOW_MORE;?>';
        }
}
}
</script>
<?php
}
?>
</div>
