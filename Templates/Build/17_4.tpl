<?php
// 17_4.tpl - MARKETPLACE / COMERCIAL ROUTE
global $database, $session, $village, $generator, $id;

if (!($session->goldclub == 1 && count($database->getProfileVillages($session->uid)) > 1)) {
    header("Location: build.php?id=".(int)$_GET['id']);
    exit;
}

$action = $_POST['action'] ?? '';
$routeid = isset($_POST['routeid']) ? (int)$_POST['routeid'] : 0;
$create = isset($_GET['create']) && $session->gold > 1;
$edit = ($action === 'editRoute' && $routeid > 0 && $database->getTradeRouteUid($routeid) == $session->uid);
?>
<div id="build" class="gid17">
    <a href="#" onClick="return Popup(17,4);" class="build_logo">
        <img class="building g17" src="img/x.gif" alt="<?php echo MARKETPLACE; ?>" title="<?php echo MARKETPLACE;?>" />
    </a>
    <h1><?php echo MARKETPLACE;?> <span class="level"><?php echo LEVEL;?> <?php echo (int)$village->resarray['f'.$id];?></span></h1>
    <p class="build_desc"><?php echo MARKETPLACE_DESC;?></p>

    <?php include("17_menu.tpl");?>

    <?php if ($create):?>
        <?php include("17_create.tpl");?>

    <?php elseif ($edit):?>
        <?php include("17_edit.tpl");?>

    <?php else:?>
        <p><?php echo TRADE_ROUTES_DESC;?> <img src="../../<?php echo GP_LOCATE;?>img/a/gold.gif" alt="<?php echo GOLD; ?>" title="<?php echo GOLD;?>"><b>2</b>.</p>

        <form method="post" action="build.php?gid=17&t=4">
            <table id="npc" cellpadding="1" cellspacing="1">
                <thead>
                    <tr>
                        <th></th>
                        <th><?php echo DESCRIPTION;?></th>
                        <th><?php echo START;?></th>
                        <th><?php echo MERCHANT;?></th>
                        <th><?php echo TIME_LEFT;?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $routes = $database->getTradeRoute($village->wid);
                if (empty($routes)):
                ?>
                    <tr><td colspan="5" class="none"><?php echo NO_TRADE_ROUTES;?>.</td></tr>
                <?php else:
                    foreach ($routes as $route):
                        $rid = (int)$route['id'];
                        $wid = (int)$route['wid'];
                        $vname = htmlspecialchars($database->getVillageField($wid, "name"));
                        $start = str_pad((int)$route['start'], 2, '0', STR_PAD_LEFT).":00";
                        $deliveries = (int)$route['deliveries']."x".(int)$route['merchant'];
                        $daysLeft = max(0, ceil(($route['timeleft'] - time()) / 86400));
                ?>
                    <tr>
                        <th><label><input class="radio" type="radio" name="routeid" value="<?php echo $rid;?>" <?php if($routeid === $rid) echo 'checked';?>></label></th>
                        <th><?php echo TRADE_ROUTE_TO;?> <a href="karte.php?d=<?php echo $wid;?>&c=<?php echo $generator->getMapCheck($wid);?>"><?php echo $vname;?></a></th>
                        <th><?php echo $start;?></th>
                        <th><?php echo $deliveries;?></th>
                        <th><?php echo $daysLeft.' '.DAYS;?></th>
                    </tr>
                <?php endforeach; endif;?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th colspan="4">
                            <button type="submit" name="action" value="extendRoute" class="trav_buttons"><b><?php echo EXTEND;?>*</b></button>
                            | <button type="submit" name="action" value="editRoute" class="trav_buttons"><b><?php echo EDIT;?></b></button>
                            | <button type="submit" name="action" value="delRoute" class="trav_buttons"><b><?php echo DELETE;?></b></button>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </form>

        * <?php echo EXTEND_TRADE_ROUTES;?> <img src="../../<?php echo GP_LOCATE;?>img/a/gold.gif" alt="<?php echo GOLD; ?>" title="<?php echo GOLD;?>"><b>2</b>
        <br>
        <div class="options">
            <a class="arrow" href="build.php?gid=17&t=4&create">» <?php echo CREATE_TRADE_ROUTES;?></a>
        </div>
    <?php endif;?>
</div>