<?php

$eid = isset($_GET['eid']) ? (int)$_GET['eid'] : 0;
$action = $_GET['action'] ?? null;

$errormsg = $errormsg ?? null;

/* =====================================================
   LOAD SLOT DATA (EDIT MODE)
===================================================== */
if ($action === 'showSlot' && $eid) {

    $eiddata = $database->getRaidList($eid);

    if (!$eiddata) {
        header("Location: build.php?id=39&t=99");
        exit;
    }

    $x = $eiddata['x'];
    $y = $eiddata['y'];

    for ($i = 1; $i <= 6; $i++) {
        ${'t'.$i} = $eiddata['t'.$i];
    }

    $FLData = $database->getFLData($eiddata['lid']);

    if ($FLData['owner'] != $session->uid) {
        header("Location: build.php?id=39&t=99");
        exit;
    }
}

/* =====================================================
   HANDLE EDIT SUBMIT
===================================================== */
$postAction = $_POST['action'] ?? null;

if (
    $postAction === 'editSlot' &&
    $eid &&
    !empty($_POST['lid'])
) {

    $FLData = $database->getFLData((int)$_POST['lid']);

    /* ======================
       TARGET RESOLVE
    ====================== */
    $Wref = null;
    $WrefX = null;
    $WrefY = null;
    $vdata = null;
    $oasistype = null;

    $targetId = $_POST['target_id'] ?? '';
    $px = $_POST['x'] ?? '';
    $py = $_POST['y'] ?? '';

    if (!empty($targetId)) {

        $Wref = (int)$targetId;
        $coor = $database->getCoor($Wref);

        $WrefX = $coor['x'];
        $WrefY = $coor['y'];

    } elseif ($px !== '' && $py !== '' && is_numeric($px) && is_numeric($py)) {

        $Wref = $database->getVilWref($px, $py);
        $WrefX = (int)$px;
        $WrefY = (int)$py;
    }

    if ($Wref) {
        $oasistype = $database->getVillageType2($Wref);
        $vdata = $database->getVillage($Wref);
    }

    /* ======================
       TROOP COUNT
    ====================== */
    $troops = 0;
    for ($i = 1; $i <= 6; $i++) {
        $unitId = $i + ($session->tribe - 1) * 10;

        if (!in_array($unitId, [4, 14, 23])) {
            $troops += (int)($_POST['t'.$i] ?? 0);
        }
    }

    /* ======================
       VALIDATION
    ====================== */
    if (empty($px) && empty($py) && empty($targetId)) {
        $errormsg = "Enter coordinates.";

    } elseif (($px === '' || $py === '') && empty($targetId)) {
        $errormsg = "Enter the correct coordinates.";

    } elseif ($oasistype == 0 && !$vdata) {
        $errormsg = "There is no village on those coordinates.";

    } elseif ($troops == 0) {
        $errormsg = "No troops has been selected.";

    } elseif ($database->hasBeginnerProtection($Wref)) {
        $errormsg = "Player under protection.";

    } elseif (
        $Wref == $FLData['wref'] ||
        ($vdata['wref'] ?? null) == $FLData['wref']
    ) {
        $errormsg = "You can't attack the same village you're sending troops from.";

    } else {

        /* ======================
           UPDATE SLOT
        ====================== */
        $coor = $database->getCoor($village->wid);
        $distance = $database->getDistance($coor['x'], $coor['y'], $WrefX, $WrefY);

        $oldLid = $database->getRaidList($eid)['lid'];

        $database->editSlotFarm(
            $eid,
            (int)$_POST['lid'],
            $oldLid,
            $session->uid,
            $Wref,
            $WrefX,
            $WrefY,
            $distance,
            (int)($_POST['t1'] ?? 0),
            (int)($_POST['t2'] ?? 0),
            (int)($_POST['t3'] ?? 0),
            (int)($_POST['t4'] ?? 0),
            (int)($_POST['t5'] ?? 0),
            (int)($_POST['t6'] ?? 0)
        );

        header("Location: build.php?id=39&t=99");
        exit;
    }
}

?>

<div id="raidListSlot">
    <h4><?php echo TZ_EDIT_SLOT; ?></h4>

    <font color="#FF0000"><b><?php echo $errormsg; ?></b></font>

    <form id="edit_form" action="build.php?id=39&t=99&action=showSlot&eid=<?php echo $eid; ?>" method="post">

<div class="boxes boxesColor gray">
    <div class="boxes-tl"></div>
    <div class="boxes-tr"></div>
    <div class="boxes-tc"></div>
    <div class="boxes-ml"></div>
    <div class="boxes-mr"></div>
    <div class="boxes-mc"></div>
    <div class="boxes-bl"></div>
    <div class="boxes-br"></div>
    <div class="boxes-bc"></div>

    <div class="boxes-contents cf">

        <input type="hidden" name="action" value="editSlot">

        <table cellpadding="1" cellspacing="1" class="transparent" id="raidList">

            <tr>
                <th><?php echo TZ_LIST_NAME; ?></th>
                <td>
                    <select onchange="getTargetsByLid();" id="lid" name="lid">

                        <?php
                        $sql = mysqli_query(
                            $database->dblink,
                            "SELECT id, name, wref 
                             FROM ".TB_PREFIX."farmlist 
                             WHERE owner = ".(int)$session->uid." 
                             ORDER BY name ASC"
                        );

                        while ($row = mysqli_fetch_array($sql)) {

                            $lid = $row["id"];
                            $lname = $row["name"];
                            $lvname = $database->getVillageField($row["wref"], 'name');

                            $selected = ($lid == ($eiddata['lid'] ?? 0)) ? 'selected' : '';

                            echo '<option value="'.$lid.'" '.$selected.'>'
                                .$lvname.' - '.$lname.
                            '</option>';
                        }
                        ?>

                    </select>
                </td>
            </tr>

            <tr>
                <th><?php echo TZ_TARGET_VILLAGE; ?></th>

                <td class="target">

                    <div class="coordinatesInput">

                        <div class="xCoord">
                            <label for="xCoordInput">X:</label>
                            <input value="<?php echo $x; ?>" name="x" id="xCoordInput" class="text coordinates x">
                        </div>

                        <br />

                        <div class="yCoord">
                            <label for="yCoordInput">Y:</label>
                            <input value="<?php echo $y; ?>" name="y" id="yCoordInput" class="text coordinates y">
                        </div>

                        <div class="clear"></div>

                    </div>
					
					<br />

                    <div class="targetSelect">

                        <label class="lastTargets"><?php echo TZ_LAST_TARGETS; ?></label>

                        <select name="target_id">

                            <?php
                            $getwref = "SELECT movement.to, movement.ref, attacks.* 
                                        FROM ".TB_PREFIX."movement movement
                                        INNER JOIN ".TB_PREFIX."attacks attacks 
                                        ON attacks.id = movement.ref
                                        WHERE attacks.attack_type = 4 
                                        AND movement.proc = 1 
                                        AND movement.from = ".$village->wid;

                            $arraywref = $database->query_return($getwref);

                            echo '<option value="">Select village</option>';

                            if (mysqli_num_rows(mysqli_query($database->dblink, $getwref)) != 0) {

                                foreach ($arraywref as $row) {

                                    $towref = $row["to"];
                                    $vilInfo = $database->getVillageByWorldID($towref);

                                    if ($vilInfo['fieldtype'] > 0 && !$vilInfo['occupied']) {
                                        continue;
                                    }

                                    $tocoor = $database->getCoor($towref);

                                    if ($vilInfo['oasistype'] == 0) {
                                        $tovname = $database->getVillageField($towref, 'name');
                                    } else {
                                        $tovname = $database->getOasisField($towref, 'name');
                                    }

                                    echo '<option value="'.$towref.'">'
                                        .$tovname.' ('.$tocoor['x'].'|'.$tocoor['y'].')'
                                    .'</option>';
                                }
                            }
                            ?>

                        </select>

                    </div>

                    <div class="clear"></div>

                </td>
            </tr>

        </table>

    </div>
</div>

        <?php include "Templates/goldClub/trooplist.tpl"; ?>

        <button type="submit" class="trav_buttons"><?php echo SAVE; ?></button>
        <button type="button"
                class="trav_buttons"
                onclick="window.location.href='?gid=16&t=99&action=deleteSlot&eid=<?php echo $eid; ?>&lid=<?php echo $eiddata['lid']; ?>';">
            Delete
        </button>

    </form>
</div>