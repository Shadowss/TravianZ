<?php
// 17_create.tpl - MARKETPLACE / CREATE ROUTE
global $database, $session, $village;

$villages = $session->villages?? [];
$firstSelect = ($villages[0]?? 0) == $village->wid? 1 : 0;
?>
<form action="build.php" method="post">
    <div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents cf">
        <input type="hidden" name="action" value="addRoute">
        <table cellpadding="1" cellspacing="1" id="npc" class="transparent">
            <thead>
                <tr><th colspan="2"><?php echo CREATE_TRADE_ROUTE;?></th></tr>
            </thead>
            <tbody>
                <tr>
                    <th><?php echo TARGET_VILLAGE;?>:</th>
                    <td>
                        <select id="tvillage" name="tvillage">
                            <?php
                            $idx = 0;
                            foreach ($villages as $vid) {
                                $vid = (int)$vid;
                                if ($vid === (int)$village->wid) continue;
                                $coor = $database->getCoor($vid);
                                $name = htmlspecialchars($database->getVillageField($vid, 'name'));
                                $selected = ($idx === $firstSelect)? 'selected' : '';
                                echo '<option value="'.$vid.'" '.$selected.'>'.$name.' ('.(int)$coor['x'].'|'.(int)$coor['y'].')</option>';
                                $idx++;
                            }
                           ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><?php echo RESOURCES;?>:</th>
                    <td>
                        <?php $icons = [1=>'1',2=>'2',3=>'3',4=>'4']; $names = [1=>LUMBER,2=>CLAY,3=>IRON,4=>CROP];
                        foreach ($icons as $i => $img):?>
                            <img src="../../<?php echo GP_LOCATE;?>img/r/<?php echo $img;?>.gif" alt="<?php echo $names[$i];?>" title="<?php echo $names[$i];?>">
                            <input class="text" type="text" name="r<?php echo $i;?>" id="r<?php echo $i;?>" value="" maxlength="5" tabindex="1" style="width:50px;">
                        <?php endforeach;?>
                    </td>
                </tr>
                <tr>
                    <th><?php echo START_TIME_TRADE;?>:</th>
                    <td>
                        <select name="start">
                            <?php for ($h = 0; $h < 24; $h++):?>
                                <option value="<?php echo $h;?>" <?php if($h===0) echo 'selected';?>><?php echo str_pad($h,2,'0',STR_PAD_LEFT);?></option>
                            <?php endfor;?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><?php echo DELIVERIES;?>:</th>
                    <td>
                        <select name="deliveries">
                            <?php for ($d = 1; $d <= 3; $d++):?>
                                <option value="<?php echo $d;?>" <?php if($d===1) echo 'selected';?>><?php echo $d;?></option>
                            <?php endfor;?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><?php echo COSTS;?>:</th>
                    <td><img src="../../<?php echo GP_LOCATE;?>img/a/gold.gif" alt="<?php echo GOLD; ?>" title="<?php echo GOLD;?>"> <b>2</b></td>
                </tr>
                <tr>
                    <th><?php echo DURATION;?>:</th>
                    <td><b>7</b> <?php echo DAYS;?></td>
                </tr>
            </tbody>
        </table>
    </div></div>
    <p><input type="image" value="1" name="save" id="btn_save" class="dynamic_img" src="img/x.gif" tabindex="8" alt="OK"/></p>
</form>