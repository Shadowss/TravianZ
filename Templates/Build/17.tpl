<?php
// 17.tpl - MARKETPLACE
global $database, $session, $village, $market, $generator, $form, $id;

$merchantAvail = (int)$market->merchantAvail();
$maxcarry = (int)$market->maxcarry;
$totalMerchants = (int)$market->merchant;

// --- POST sanitizat ---
$r = [];
for ($i = 1; $i <= 4; $i++) {
    $r[$i] = isset($_POST['r'.$i])? max(0, (int)$_POST['r'.$i]) : 0;
}
$allres = array_sum($r);
$x = isset($_POST['x'])? trim($_POST['x']) : '';
$y = isset($_POST['y'])? trim($_POST['y']) : '';
$dname = isset($_POST['dname'])? trim($_POST['dname']) : '';
$send3 = isset($_POST['send3'])? (int)$_POST['send3'] : 1;
$ft = $_POST['ft']?? '';

// --- target ---
$getwref = 0;
$checkexist = false;
$target = null;

if ($x!== '' && $y!== '' && is_numeric($x) && is_numeric($y)) {
    $getwref = (int)$database->getVilWref((int)$x, (int)$y);
    $checkexist = $database->checkVilExist($getwref);
} elseif ($dname!== '') {
    $getwref = (int)$database->getVillageByName($dname);
    $checkexist = $database->checkVilExist($getwref);
}

if ($checkexist) {
    $villageOwner = (int)$database->getVillageField($getwref, 'owner');
    $userAccess = (int)$database->getUserField($villageOwner, 'access', 0);
    $userVacation = (int)$database->getUserField($villageOwner, 'vac_mode', 0);
    $userID = (int)$database->getUserField($villageOwner, 'id', 0);

    $target = [
        'wref' => $getwref,
        'name' => $database->getVillageField($getwref, 'name'),
        'owner' => $villageOwner,
        'coor' => $database->getCoor($getwref),
    ];
    $target['time'] = $generator->procDistanceTime($target['coor'], $village->coor, $session->tribe, 0);
}

$maxTotalCarry = $maxcarry * $merchantAvail;
$canRepeat = ($send3 === 1) || ($send3 >= 2 && $send3 <= 3 && $session->goldclub);
$validTarget = $checkexist && $getwref!== $village->wid;
$validAccess = $checkexist && ($userAccess == 2 || $userAccess == MULTIHUNTER || (defined('ADMIN_ALLOW_INCOMING_RAIDS') && ADMIN_ALLOW_INCOMING_RAIDS && $userAccess == ADMIN));

$showConfirm = ($ft === 'check' && $canRepeat && $validTarget && $allres > 0 && $allres <= $maxTotalCarry && $validAccess && $userVacation == 0);

// coordonate prefill din GET
$coor = ['x' => '', 'y' => ''];
if (isset($_GET['z'])) {
    $coor = $database->getCoor((int)$_GET['z']);
}
?>
<div id="build" class="gid17">
    <a href="#" onClick="return Popup(17,4);" class="build_logo">
        <img class="building g17" src="img/x.gif" alt="<?php echo MARKETPLACE; ?>" title="<?php echo MARKETPLACE;?>" />
    </a>
    <h1><?php echo MARKETPLACE;?> <span class="level"><?php echo LEVEL;?> <?php echo (int)$village->resarray['f'.$id];?></span></h1>
    <p class="build_desc"><?php echo MARKETPLACE_DESC;?></p>

    <?php include("17_menu.tpl");?>

    <script language="JavaScript">
    
    </script>

<?php if ($showConfirm && $target):?>
    <form method="POST" name="snd" action="build.php">
        <input type="hidden" name="ft" value="mk1">
        <input type="hidden" name="id" value="<?php echo (int)$id;?>">
        <input type="hidden" name="send3" value="<?php echo $send3;?>">
        <table id="send_select" class="send_res" cellpadding="1" cellspacing="1">
            <?php for ($i = 1; $i <= 4; $i++):
                $resNames = [1=>LUMBER,2=>CLAY,3=>IRON,4=>CROP];
           ?>
            <tr>
                <td class="ico"><img class="r<?php echo $i;?>" src="img/x.gif" alt="<?php echo $resNames[$i];?>" title="<?php echo $resNames[$i];?>" /></td>
                <td class="nam"><?php echo $resNames[$i];?></td>
                <td class="val"><input class="text disabled" type="text" name="r<?php echo $i;?>" id="r<?php echo $i;?>" value="<?php echo $r[$i];?>" readonly="readonly"></td>
                <td class="max"> / <span class="none"><b><?php echo $maxcarry;?></b></span></td>
            </tr>
            <?php endfor;?>
        </table>
        <table id="target_validate" class="res_target" cellpadding="1" cellspacing="1">
            <tbody>
            <tr>
                <th><?php echo COORDINATES;?>:</th>
                <td><a href="karte.php?d=<?php echo $target['wref'];?>&c=<?php echo $generator->getMapCheck($target['wref']);?>"><?php echo htmlspecialchars($target['name']);?>(<?php echo (int)$target['coor']['x'];?>|<?php echo (int)$target['coor']['y'];?>)</a></td>
            </tr>
            <tr>
                <th><?php echo PLAYER;?>:</th>
                <td><a href="spieler.php?uid=<?php echo $target['owner'];?>"><?php echo htmlspecialchars($database->getUserField($target['owner'], 'username', 0));?></a></td>
            </tr>
            <tr>
                <th><?php echo DURATION;?>:</th>
                <td><?php echo $generator->getTimeFormat($target['time']);?></td>
            </tr>
            <tr>
                <th><?php echo MERCHANT;?>:</th>
                <td><?php echo ceil(($allres - 0.1) / $maxcarry);?></td>
            </tr>
            <tr><td colspan="2"></td></tr>
            </tbody>
        </table>
        <input type="hidden" name="getwref" value="<?php echo $target['wref'];?>">
        <div class="clear"></div>
        <p><input type="image" value="ok" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" tabindex="8" alt="OK" <?php if(!$merchantAvail) echo 'disabled';?> /></p>
    </form>

<?php else:?>
    <form method="POST" name="snd" action="build.php">
        <input type="hidden" name="ft" value="check">
        <input type="hidden" name="id" value="<?php echo (int)$id;?>">
        <table id="send_select" class="send_res" cellpadding="1" cellspacing="1">
            <?php for ($i = 1; $i <= 4; $i++):
                $resNames = [1=>LUMBER,2=>CLAY,3=>IRON,4=>CROP];
           ?>
            <tr>
                <td class="ico"><a href="#" onClick="upd_res(<?php echo $i;?>,1); return false;"><img class="r<?php echo $i;?>" src="img/x.gif" alt="<?php echo $resNames[$i];?>" title="<?php echo $resNames[$i];?>" /></a></td>
                <td class="nam"><?php echo $resNames[$i];?>:</td>
                <td class="val"><input class="text" type="text" name="r<?php echo $i;?>" id="r<?php echo $i;?>" value="" maxlength="9" onKeyUp="upd_res(<?php echo $i;?>)" tabindex="<?php echo $i;?>"></td>
                <td class="max"><a href="#" onMouseUp="add_res(<?php echo $i;?>);" onClick="return false;">(<?php echo $maxcarry;?>)</a></td>
            </tr>
            <?php endfor;?>
        </table>

        <table id="target_select" class="res_target" cellpadding="1" cellspacing="1">
            <tr><td class="mer"><?php echo MERCHANT;?> <?php echo $merchantAvail;?>/<?php echo $totalMerchants;?></td></tr>
            <tr><td class="vil"><span><?php echo VILLAGES;?>:</span> <input class="text" type="text" name="dname" value="" maxlength="30" tabindex="5" list="dnameSuggest" autocomplete="off"><?php include("Templates/villageAutocomplete.tpl"); ?></td></tr>
            <tr><td class="or"><?php echo OR_;?></td></tr>
            <tr>
                <td class="coo">
                    <span>X:</span><input class="text" type="text" name="x" value="<?php echo htmlspecialchars($coor['x']);?>" maxlength="4" tabindex="6">
                    <span>Y:</span><input class="text" type="text" name="y" value="<?php echo htmlspecialchars($coor['y']);?>" maxlength="4" tabindex="7">
                </td>
            </tr>
        </table>
        <div class="clear"></div>
        <?php if ($session->goldclub == 1):?>
            <p><select name="send3"><option value="1" selected>1x</option><option value="2">2x</option><option value="3">3x</option></select> <?php echo GO;?></p>
        <?php else:?>
            <input type="hidden" name="send3" value="1">
        <?php endif;?>
        <p><input type="image" value="ok" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" tabindex="8" alt="OK" <?php if(!$merchantAvail) echo 'disabled';?> /></p>
    </form>

    <?php
    // --- erori ---
    $error = '';
    if ($ft === 'check') {
        if ($form->returnErrors() > 0) {
            $error = '<span class="error"><b>'.$form->getError("error").'</b></span>';
        } elseif (!$checkexist) {
            $error = '<span class="error"><b>'.NO_COORDINATES_SELECTED.'</b></span>';
        } elseif ($getwref == $village->wid) {
            $error = '<span class="error"><b>'.CANNOT_SEND_RESOURCES.'</b></span>';
        } elseif (!$canRepeat) {
            $error = '<span class="error"><b>'.INVALID_MERCHANTS_REPETITION.'</b></span>';
        } elseif (!$validAccess) {
            $error = '<span class="error"><b>'.BANNED_CANNOT_SEND_RESOURCES.'.</b></span>';
        } elseif ($allres == 0) {
            $error = '<span class="error"><b>'.RESOURCES_NO_SELECTED.'.</b></span>';
        } elseif ($userVacation == 1) {
            $error = '<span class="error"><b>Player is on vacation mode. You cannot send resources to him.</b></span>';
        } elseif ($x === '' && $y === '' && $dname === '') {
            $error = '<span class="error"><b>'.ENTER_COORDINATES.'.</b></span>';
        } elseif ($allres > $maxTotalCarry) {
            $error = '<span class="error"><b>'.TOO_FEW_MERCHANTS.'.</b></span>';
        }
        echo $error;
    }
   ?>
<?php endif;?>

<p><?php echo MERCHANT_CARRY;?> <b><?php echo $maxcarry;?></b> <?php echo UNITS_OF_RESOURCE;?></p>

<?php
// --- comercianți care vin ---
if (count($market->recieving) > 0) {
    echo "<h4>".MERCHANT_COMING.":</h4>";
    foreach ($market->recieving as $recieve) {
        $villageowner = (int)$database->getVillageField($recieve['from'], "owner");
        echo '<table class="traders" cellpadding="1" cellspacing="1">';
        echo '<thead><tr><td><a href="spieler.php?uid='.$villageowner.'">'.htmlspecialchars($database->getUserField($villageowner,"username",0)).'</a></td>';
        echo '<td><a href="karte.php?d='.$recieve['from'].'&c='.$generator->getMapCheck($recieve['from']).'">'.TRANSPORT_FROM.' '.htmlspecialchars($database->getVillageField($recieve['from'],"name")).'</a></td></tr></thead>';
        echo '<tbody><tr><th>'.ARRIVAL_IN.'</th><td>';
        echo '<div class="in"><span id="timer'.(++$session->timer).'">'.$generator->getTimeFormat($recieve['endtime']-time()).'</span> h</div>';
        $datetime = $generator->procMtime($recieve['endtime']);
        echo '<div class="at">'.($datetime[0]!= "today"? ON." ".$datetime[0]." " : "").AT." ".$datetime[1].'</div>';
        echo '</td></tr></tbody><tr class="res"><th>'.RESOURCES.'</th><td colspan="2"><span class="f10">';
        echo '<img class="r1" src="img/x.gif" alt="'.LUMBER.'" title="'.LUMBER.'" />'.$recieve['wood'].' | ';
        echo '<img class="r2" src="img/x.gif" alt="'.CLAY.'" title="'.CLAY.'" />'.$recieve['clay'].' | ';
        echo '<img class="r3" src="img/x.gif" alt="'.IRON.'" title="'.IRON.'" />'.$recieve['iron'].' | ';
        echo '<img class="r4" src="img/x.gif" alt="'.CROP.'" title="'.CROP.'" />'.$recieve['crop'];
        echo '</span></td></tr></table>';
    }
}

// --- comercianți trimiși ---
if (count($market->sending) > 0) {
    echo "<h4>".OWN_MERCHANTS_ONWAY.":</h4>";
    foreach ($market->sending as $send) {
        $villageowner = (int)$database->getVillageField($send['to'],"owner");
        echo '<table class="traders" cellpadding="1" cellspacing="1">';
        echo '<thead><tr><td><a href="spieler.php?uid='.$villageowner.'">'.htmlspecialchars($database->getUserField($villageowner,"username",0)).'</a></td>';
        echo '<td><a href="karte.php?d='.$send['to'].'&c='.$generator->getMapCheck($send['to']).'">'.TRANSPORT_TO.' '.htmlspecialchars($database->getVillageField($send['to'],"name")).'</a></td></tr></thead>';
        echo '<tbody><tr><th>'.ARRIVAL_IN.'</th><td>';
        echo '<div class="in"><span id="timer'.(++$session->timer).'">'.$generator->getTimeFormat($send['endtime']-time()).'</span> h</div>';
        $datetime = $generator->procMtime($send['endtime']);
        echo '<div class="at">'.($datetime[0]!= "today"? ON." ".$datetime[0]." " : "").AT." ".$datetime[1].'</div>';
        echo '</td></tr><tr class="res"><th>'.RESOURCES.'</th><td>';
        echo '<img class="r1" src="img/x.gif" alt="'.LUMBER.'" />'.$send['wood'].' | ';
        echo '<img class="r2" src="img/x.gif" alt="'.CLAY.'" />'.$send['clay'].' | ';
        echo '<img class="r3" src="img/x.gif" alt="'.IRON.'" />'.$send['iron'].' | ';
        echo '<img class="r4" src="img/x.gif" alt="'.CROP.'" />'.$send['crop'];
        echo '</td></tr></tbody></table>';
    }
}

// --- comercianți care se întorc ---
if (count($market->return) > 0) {
    echo "<h4>".MERCHANTS_RETURNING.":</h4>";
    foreach ($market->return as $return) {
        $villageowner = (int)$database->getVillageField($return['from'],"owner");
        echo '<table class="traders" cellpadding="1" cellspacing="1">';
        echo '<thead><tr><td><a href="spieler.php?uid='.$villageowner.'">'.htmlspecialchars($database->getUserField($villageowner,"username",0)).'</a></td>';
        echo '<td><a href="karte.php?d='.$return['from'].'&c='.$generator->getMapCheck($return['from']).'">'.RETURNFROM.' '.htmlspecialchars($database->getVillageField($return['from'],"name")).'</a></td></tr></thead>';
        echo '<tbody><tr><th>'.ARRIVAL_IN.'</th><td>';
        echo '<div class="in"><span id="timer'.(++$session->timer).'">'.$generator->getTimeFormat($return['endtime']-time()).'</span> h</div>';
        $datetime = $generator->procMtime($return['endtime']);
        echo '<div class="at">'.($datetime[0]!= "today"? ON." ".$datetime[0]." " : "").AT." ".$datetime[1].'</div>';
        echo '</td></tr></tbody></table>';
    }
}

include("upgrade.tpl");
?>
</div>