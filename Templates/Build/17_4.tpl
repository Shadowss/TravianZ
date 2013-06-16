<?php if($session->goldclub == 1 && count($database->getProfileVillages($session->uid)) > 1) { ?>
<div id="build" class="gid17"><a href="#" onClick="return Popup(17,4);" class="build_logo"> 
	<img class="building g17" src="img/x.gif" alt="Marketplace" title="Marketplace" /> 
</a> 
<h1>Marketplace <span class="level">level <?php echo $village->resarray['f'.$id]; ?></span></h1> 
<p class="build_desc">At the Marketplace you can trade resources with other players. The higher its level, the more resources can be transported at the same time.
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

<p>Trade route allows you to set up routes for your merchant that he will walk every day at a certain hour. <br /><br />
Standard this holds on for 7 days, but you can extend it with 7 days for the cost of <img src="../../<?php echo GP_LOCATE; ?>img/a/gold.gif" alt="Gold" title="Gold">2.</p>

<table id="npc" cellpadding="1" cellspacing="1"> 
<thead>
<tr>
<th></th>
<th>description</th>
<th>start</th>
<th>Merchants</th>
<th>time left</th>
</tr></thead><tbody>
<?php
$routes = $database->getTradeRoute($session->uid);
    if(count($routes) == 0) {
    echo "<td colspan=\"5\" class=\"none\">No active trade routes.</td></tr>";
    }else{
foreach($routes as $route){
?>
<tr>
<th><label><input class="radio" type="radio" onclick="window.location.href = '?id=<?php echo $id; ?>&t=4&routeid=<?php echo $route['id']; ?>';" name="routeid" value="<?php echo $route['id']; ?>" <?php if($routeid == $route['id']) { echo "checked"; } ?>></label></th>
<th>
<?php
echo "Trade route to <a href=karte.php?d=".$route['wid']."&c=".$generator->getMapCheck($route['wid']).">".$database->getVillageField($route['wid'],"name")."</a>";
?>
</th>
<th><?php if($route['start'] > 9){ echo $route['start'];}else{ echo "0".$route['start'];} echo ":00"; ?></th>
<th><?php echo $route['deliveries']."x".$route['merchant']; ?></th>
<th><?php echo ceil(($route['timeleft']-time())/86400); echo " days"; ?></th>
</tr>
<?php }} ?>
        </tbody><tfoot><tr>
<th>
</th>
	<th colspan="4">
   <?php $routeid=$routeid == 0? $routeid=0:$routeid; ?>	
   <a href="build.php?action=extendRoute&routeid=<?php echo $routeid; ?>">extend</a>*
 | <a href="build.php?id=<?php echo $id; ?>&t=4&action=editRoute&routeid=<?php echo $routeid; ?>">edit</a>
 | <a href="build.php?action=delRoute&routeid=<?php echo $routeid; ?>">delete</a>
	</th></tr></tfoot></table>
		* Extend the trade route by 7 days for <img src="../../<?php echo GP_LOCATE; ?>img/a/gold.gif" alt="Gold" title="Gold">2
<br>
<div class="options">
    <a class="arrow" href="build.php?gid=17&t=4&create">» Create new trade route</a>
</div>
	</div>
<?php
}}else{
header("Location: build.php?id=".$_GET['id']."");
}
?>
