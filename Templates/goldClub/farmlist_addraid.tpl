<?php

/* =====================================================
   GUARD: no farmlists
===================================================== */
if (!$database->getVilFarmlist($session->uid)) {
    header("Location: build.php?id=39&t=99");
    exit;
}

/* =====================================================
   INIT
===================================================== */
$errormsg = $errormsg ?? null;

$action = $_POST['action'] ?? null;
$lid = (int)($_POST['lid'] ?? 0);

/* =====================================================
   HANDLE ADD SLOT
===================================================== */
if ($action === 'addSlot' && $lid) {

    $FLData = $database->getFLData($lid);

    if (!$FLData || $FLData['owner'] != $session->uid) {
        $errormsg = "Invalid farm list.";
    } else {

        /* ======================
           TROOP CALC
        ====================== */
        $troops = 0;
        $tribeOffset = ($session->tribe - 1) * 10;

        for ($i = 1; $i <= 6; $i++) {
            $unitId = $i + $tribeOffset;

            if (!in_array($unitId, [4, 14, 23])) {
                $troops += (int)($_POST['t'.$i] ?? 0);
            }
        }

        /* ======================
           TARGET RESOLVE
        ====================== */
        $Wref = null;
        $WrefX = null;
        $WrefY = null;
        $vdata = null;
        $oasistype = null;

        $targetId = $_POST['target_id'] ?? '';

        $x = $_POST['x'] ?? '';
        $y = $_POST['y'] ?? '';

        if (!empty($targetId)) {

            $Wref = (int)$targetId;
            $coor = $database->getCoor($Wref);

            $WrefX = $coor['x'];
            $WrefY = $coor['y'];

        } elseif ($x !== '' && $y !== '' && is_numeric($x) && is_numeric($y)
            && $x <= WORLD_MAX && $y <= WORLD_MAX) {

            $Wref = $database->getVilWref($x, $y);
            $WrefX = (int)$x;
            $WrefY = (int)$y;
        }

        if ($Wref) {
            $oasistype = $database->getVillageType2($Wref);
            $vdata = $database->getVillage($Wref);
        }

        /* ======================
           VALIDATION
        ====================== */
        if (empty($x) && empty($y) && empty($targetId)) {
            $errormsg = "Enter coordinates.";

        } elseif (($x === '' || $y === '') && empty($targetId)) {
            $errormsg = "Enter the correct coordinates.";

        } elseif ($oasistype == 0 && !$vdata) {
            $errormsg = "There is no village on those coordinates.";

        } elseif ($troops == 0) {
            $errormsg = "No troops has been selected.";

        } elseif ($database->hasBeginnerProtection($Wref)) {
            $errormsg = "Player under protection.";

        } elseif ($targetId == $FLData['wref'] || ($vdata['wref'] ?? null) == $FLData['wref']) {
            $errormsg = "You can't attack the same village you're sending troops from.";

        } else {

            /* ======================
               FINAL INSERT
            ====================== */
            $coor = $database->getCoor($village->wid);
            $distance = $database->getDistance($coor['x'], $coor['y'], $WrefX, $WrefY);

            $database->addSlotFarm(
                $lid,
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
}

?>

<div id="raidListSlot">
    <h4><?php echo TZ_ADD_SLOT; ?></h4>

    <font color="#FF0000"><b><?php echo $errormsg; ?></b></font>

    <form action="build.php?id=39&t=99&action=addraid" method="post">

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

        <input type="hidden" name="action" value="addSlot">

        <table cellpadding="1" cellspacing="1" class="transparent" id="raidList">

            <tbody>

                <tr>
                    <th><?php echo TZ_LIST_NAME; ?></th>
                    <td>
                        <select name="lid">
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

                                echo '<option value="'.$lid.'">'.$lvname.' - '.$lname.'</option>';
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
                                <input value="<?php echo $_POST['x'] ?? ''; ?>" name="x" id="xCoordInput" class="text coordinates x">
                            </div>

                            <br />

                            <div class="yCoord">
                                <label for="yCoordInput">Y:</label>
                                <input value="<?php echo $_POST['y'] ?? ''; ?>" name="y" id="yCoordInput" class="text coordinates y">
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

                                foreach ($arraywref as $row) {

                                    $towref = $row["to"];
                                    $vilInfo = $database->getVillageByWorldID($towref);

                                    if ($vilInfo['fieldtype'] > 0 && !$vilInfo['occupied']) continue;

                                    $tocoor = $database->getCoor($towref);

                                    $tovname = ($vilInfo['oasistype'] == 0)
                                        ? $database->getVillageField($towref, 'name')
                                        : $database->getOasisField($towref, 'name');

                                    echo '<option value="'.$towref.'">'.$tovname.' ('.$tocoor['x'].'|'.$tocoor['y'].')</option>';
                                }
                                ?>
                            </select>

                        </div>

                        <div class="clear"></div>

                    </td>
                </tr>

            </tbody>

        </table>

    </div>
</div>

        <?php include("Templates/goldClub/trooplist.tpl"); ?>

        <button type="submit" class="trav_buttons"><?php echo TZ_CREATE; ?></button>

    </form>
</div>