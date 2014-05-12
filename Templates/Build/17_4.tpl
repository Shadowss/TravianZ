<?php if($session->goldclub == 1 && count($database->getProfileVillages($session->uid)) > 1) { ?>
<div id="build" class="gid17"><a href="#" onClick="return Popup(17,4);" class="build_logo"> 
	<img class="building g17" src="img/x.gif" alt="Marketplace" title="<?php echo MARKETPLACE;?>" /> 
</a> 
<h1><?php echo MARKETPLACE;?> <span class="level"><?php echo LEVEL;?> <?php echo $village->resarray['f'.$id]; ?></span></h1> 
<p class="build_desc"><?php echo MARKETPLACE_DESC;?>
</p> 
 
<?php include("17_menu.tpl"); 

if(isset($_GET['action'])){
$routeaccess = 1;
}
if(isset($_GET['create']) && $session->gold > 1){
$routeaccess = 1;
include("17_create.tpl");
}else if($_GET['action'] == 'editRoute' && isset($_GET['routeid']) && $_GET['routeid'] != ""){
$traderoute = $database->getTradeRouteUid($_GET['routeid']);
if($traderoute == $session->uid){
include("17_edit.tpl");
}
}else{
?>

<p><?php echo TRADE_ROUTES_DESC;?> <img src="../../<?php echo GP_LOCATE; ?>img/a/gold.gif" alt="Gold" title="<?php echo GOLD;?>">2.</p>

<table id="npc" cellpadding="1" cellspacing="1"> 
<thead>
<tr>
<th></th>
<th><?php echo DESCRIPTION;?></th>
<th><?php echo START;?></th>
<th><?php echo MERCHANT;?></th>
<th><?php echo TIME_LEFT;?></th>
</tr></thead><tbody>
<?php
$routes = $database->getTradeRoute($session->uid);
    if(count($routes) == 0) {
    echo "<td colspan=\"5\" class=\"none\">".NO_TRADE_ROUTES.".</td></tr>";
    }else{
foreach($routes as $route){
?>
<tr>
<th><label><input class="radio" type="radio" onclick="window.location.href = '?id=<?php echo $id; ?>&t=4&routeid=<?php echo $route['id']; ?>';" name="routeid" value="<?php echo $route['id']; ?>" <?php if($routeid == $route['id']) { echo "".CHECKED.""; } ?>></label></th>
<th>
<?php
echo "".TRADE_ROUTE_TO." <a href=karte.php?d=".$route['wid']."&c=".$generator->getMapCheck($route['wid']).">".$database->getVillageField($route['wid'],"name")."</a>";
?>
</th>
<th><?php if($route['start'] > 9){ echo $route['start'];}else{ echo "0".$route['start'];} echo ":00"; ?></th>
<th><?php echo $route['deliveries']."x".$route['merchant']; ?></th>
<th><?php echo ceil(($route['timeleft']-time())/86400); echo " ".DAYS.""; ?></th>
</tr>
<?php }} ?>
        </tbody><tfoot><tr>
<th>
</th>
	<th colspan="4">
   <?php $routeid=$routeid == 0? $routeid=0:$routeid; ?>	
   <a href="build.php?action=extendRoute&routeid=<?php echo $routeid; ?>"><?php echo EXTEND;?></a>*
 | <a href="build.php?id=<?php echo $id; ?>&t=4&action=editRoute&routeid=<?php echo $routeid; ?>"><?php echo EDIT;?></a>
 | <a href="build.php?action=delRoute&routeid=<?php echo $routeid; ?>"><?php echo DELETE;?></a>
	</th></tr></tfoot></table>
		* <?php echo EXTEND_TRADE_ROUTES;?> <img src="../../<?php echo GP_LOCATE; ?>img/a/gold.gif" alt="Gold" title="<?php echo GOLD;?>">2
<br>
<div class="options">
    <a class="arrow" href="build.php?gid=17&t=4&create">» <?php echo CREATE_TRADE_ROUTES;?></a>
</div>
	</div>
<?php
}}else{
header("Location: build.php?id=".$_GET['id']."");
}
?>
