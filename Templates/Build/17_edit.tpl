<?php
// 17_edit.tpl - MARKETPLACE / EDIT ROUTES
global $database;

$routeid = isset($_POST['routeid'])? (int)$_POST['routeid'] : 0;
$edited_route = $database->getTradeRoute2($routeid);

$wood = (int)($edited_route['wood']??0);
$clay = (int)($edited_route['clay']??0);
$iron = (int)($edited_route['iron']??0);
$crop = (int)($edited_route['crop']??0);
$start = (int)($edited_route['start']??0);
$deliveries = (int)($edited_route['deliveries']??1);
?>
<form action="build.php" method="post">
    <div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents cf">
        <input type="hidden" name="action" value="editRoute2">
        <input type="hidden" name="routeid" value="<?php echo $routeid;?>">
        <table cellpadding="1" cellspacing="1" id="npc" class="transparent">
            <thead>
                <tr><th colspan="2"><?php echo EDIT_TRADE_ROUTES;?></th></tr>
            </thead>
            <tbody>
                <tr>
                    <th><?php echo RESOURCES;?>:</th>
                    <td>
                        <?php $res = [
                            ['r1', $wood, '1', LUMBER],
                            ['r2', $clay, '2', CLAY],
                            ['r3', $iron, '3', IRON],
                            ['r4', $crop, '4', CROP],
                        ];
                        foreach ($res as $r):?>
                            <img src="../../<?php echo GP_LOCATE;?>img/r/<?php echo $r[2];?>.gif" alt="<?php echo $r[3];?>" title="<?php echo $r[3];?>">
                            <input class="text" type="text" name="<?php echo $r[0];?>" id="<?php echo $r[0];?>" value="<?php echo $r[1];?>" maxlength="9" tabindex="1" style="width:50px;">
                        <?php endforeach;?>
                    </td>
                </tr>
                <tr>
                    <th><?php echo START_TIME_TRADE;?>:</th>
                    <td>
                        <select name="start">
                            <?php for ($i = 0; $i <= 23; $i++):?>
                                <option value="<?php echo $i;?>" <?php if($i === $start) echo 'selected';?>><?php echo str_pad($i,2,'0',STR_PAD_LEFT);?></option>
                            <?php endfor;?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><?php echo DELIVERIES;?>:</th>
                    <td>
                        <select name="deliveries">
                            <?php for ($i = 1; $i <= 3; $i++):?>
                                <option value="<?php echo $i;?>" <?php if($i === $deliveries) echo 'selected';?>><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
    </div></div>
    <p><input type="image" value="1" name="save" id="btn_save" class="dynamic_img" src="img/x.gif" tabindex="8" alt="OK"/></p>
</form>