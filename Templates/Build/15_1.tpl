<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : MAIN BUILDING DEMOLISH                                    ##
##  Type           : BUILDING TEMPLATE                                         ##
## --------------------------------------------------------------------------- ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  Test Server    : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

$ty = isset($_GET['ty'])? $_GET['ty'] : '';

// cancel demolition
if (isset($_REQUEST['cancel']) && $_REQUEST['cancel'] == '1') {
    $database->delDemolition($village->wid);
    header("Location: build.php?gid=15&ty=$ty&cancel=0&demolish=0");
    exit;
}

$memberCount = $session->alliance? $database->countAllianceMembers($session->alliance) : 0;
$VillageLevels = $database->getResourceLevel($village->wid);

// start demolition
if (!empty($_REQUEST['demolish']) && $_REQUEST['c'] == $session->mchecker) {
    $type = (int)($_REQUEST['type']?? 0);
    $instant = isset($_POST['instant']) && $_POST['instant'] == '1';

    if ($type >= 19 && $type <= 40 || $type == 99) {
        $field = 'f'.$type;
        $buildType = $VillageLevels[$field.'t'];
        $currentLvl = $VillageLevels[$field];

        // blocaj ambasada - la fel ca originalul
        if($buildType == 18 && $session->alliance && $database->isAllianceOwner($session->uid) == $session->alliance && $memberCount > 1){
            header("Location: build.php?gid=15&ty=$type&nodemolish=18");
            exit;
        }

        if($instant){
            // DEMOLARE COMPLETA CU GOLD
            if($session->gold < 10){
                header("Location: build.php?gid=15&ty=$type&notenoughgold=1");
                exit;
            }
            if($currentLvl > 0){
                // sterge orice demolare in curs
                $database->delDemolition($village->wid);

                // FIX 2: populatia nu era scazuta deloc la demolarea instant, deci
                // satul ramanea cu locuitorii unei cladiri care nu mai exista.
                // Cladirea dispare de la nivelul curent pana la 0, deci trebuie
                // scazuta populatia TUTUROR nivelurilor, nu doar a ultimului
                // (demolarea clasica scade cate un nivel pe rand - vezi
                // Automation::demolitionComplete).
                $demolishPop = 0;
                $demolishData = $GLOBALS['bid'.$buildType] ?? null;

                if (is_array($demolishData)) {
                    for ($demolishLvl = 1; $demolishLvl <= $currentLvl; $demolishLvl++) {
                        if (isset($demolishData[$demolishLvl]['pop'])) {
                            $demolishPop += (int) $demolishData[$demolishLvl]['pop'];
                        }
                    }
                }

                // setare nivel 0 direct in DB
                $database->query("UPDATE ".TB_PREFIX."fdata SET `$field` = 0, `{$field}t` = 0 WHERE `vref` = ".$village->wid);

                // Capacitatea de depozitare nu era ajustata deloc pe calea cu aur:
                // demolarea instant a unui Depozit sau Hambar lasa satul cu
                // capacitatea cladirii disparute. Recalculam din ce a ramas.
                if (in_array((int) $buildType, [10, 11, 38, 39], true)) {
                    $database->recalculateStorage($village->wid);
                }

                if ($demolishPop > 0) {
                    // modul 1 = scade (vezi Database::modifyPop)
                    $database->modifyPop($village->wid, $demolishPop, 1);
                }

                // Punctele de cultura se recalculeaza din cladirile ramase: fara
                // asta satul ar produce in continuare cultura pentru cladirea
                // demolata. recountCP citeste starea proaspata din baza de date.
                if (class_exists('Building')) {
                    Building::recountCP($database, $village->wid);
                }

                // FIX 1: modul 0 al lui modifyGold SCADE deja (gold = gold - $amt),
                // deci valoarea trebuie sa fie POZITIVA. Cu -10 iesea
                // "gold - (-10)", adica jucatorul PRIMEA 10 aur in loc sa plateasca.
                $database->modifyGold($session->uid, 10, 0);
                $session->gold -= 10;

                // soldul din sesiune se poate reciti la urmatoarea cerere din
                // cache-ul de utilizator; il invalidam ca sa nu reapara vechea valoare
                unset($_SESSION['cache_user_' . (isset($_SESSION['username']) ? $_SESSION['username'] : '')]);

                $session->changeChecker();
                header("Location: build.php?gid=15&ty=$type&demolished=1");
                exit;
            }
        }else{
            // DEMOLARE CLASICA
            $ok = $database->addDemolition($village->wid, $type);
            if ($ok === true) {
                $session->changeChecker();
                header("Location: build.php?gid=15&ty=$type&cancel=0&demolish=0");
            } else {
                header("Location: build.php?gid=15&ty=$type&nodemolish=$ok");
            }
            exit;
        }
    }
}

if ($village->resarray['f'.$id] < DEMOLISH_LEVEL_REQ) return;

$Demolition = $database->getDemolition($village->wid);
$inProgress =!empty($Demolition)? $Demolition[0] : null;
?>
<h2><?= DEMOLITION_BUILDING?></h2>

<?php if ($inProgress):?>
    <b>
        <a href="build.php?id=<?= $_GET['id']?? 15?>&ty=<?= $ty?>&cancel=1">
            <img src="img/x.gif" class="del" title="<?= CANCEL?>" alt="cancel">
        </a>
        <?= DEMOLITION_OF?> <?= $building->procResType($VillageLevels['f'.$inProgress['buildnumber'].'t'])?>:
        <span id="timer1"><?= $generator->getTimeFormat($inProgress['timetofinish'] - time())?></span>
        <?php if ($session->gold >= 2):?>
            <a href="?id=15&buildingFinish=1&ty=<?= $ty?>" onclick="return confirm('<?php echo addslashes(FINISH_GOLD); ?>');" title="<?= FINISH_GOLD?>">
                <img class="clock" alt="<?= TZ_FINISH?>" src="img/x.gif">
            </a>
        <?php endif;?>
    </b>

<?php else:?>

    <?php if (isset($_GET['nodemolish']) && $_GET['nodemolish'] == 18):?>
        <p style="color:#ff0000; text-align:left">
            <?= TZ_ML_LEADER_DEMOLITION_EMBASSY?> <b><?= $memberCount?></b> <?= TZ_ALLIANCE_MEMBERS?>
        </p>
    <?php endif;?>
    <?php if (isset($_GET['notenoughgold'])):?>
        <p style="color:#ff0000"><?= TZ_YOU_DON_T_HAVE_ENOUGH_GOLD_YOU_NEE?></p>
    <?php endif;?>
    <?php if (isset($_GET['demolished'])):?>
        <p style="color:#008000"><?= TZ_THE_BUILDING_WAS_COMPLETELY_DEMOLI?></p>
    <?php endif;?>

    <form action="build.php?gid=15&amp;demolish=1&amp;cancel=0&amp;c=<?= $session->mchecker?>" method="POST" style="display:inline">
        <select id="demolition_type" name="type" class="dropdown">
            <?php for ($i = 19; $i <= 41; $i++):
                if (!isset($VillageLevels['f'.$i]) || $VillageLevels['f'.$i] < 1) continue;
                if ($building->isCurrent($i) || $building->isLoop($i)) continue;
                $selected = ($i == $ty)? ' selected' : '';
           ?>
                <option value="<?= $i?>"<?= $selected?>><?= $i?>. <?= $building->procResType($VillageLevels['f'.$i.'t'])?> (lvl <?= $VillageLevels['f'.$i]?>)</option>
            <?php endfor;?>
            <?php if ($village->natar == 1 && isset($VillageLevels['f99']) && $VillageLevels['f99'] >= 1 &&!$building->isCurrent(99) &&!$building->isLoop(99)):
                $selected = ($ty == 99)? ' selected' : '';
           ?>
                <option value="99"<?= $selected?>>99. <?= $building->procResType(40)?> (lvl <?= $VillageLevels['f99']?>)</option>
            <?php endif;?>
        </select>

        <label style="margin:0 10px;">
            <input type="checkbox" name="instant" value="1" id="instant_demolish" <?= $session->gold < 10 ? 'disabled' : ''?>>
            <?= TZ_COMPLETE_DEMOLITION_10?> <img src="img/x.gif" class="gold" style="vertical-align:middle">)
        </label>

        <input id="btn_demolish" name="demolish" class="dynamic_img" value="<?= DEMOLISH?>" type="image" src="img/x.gif" alt="<?= DEMOLISH?>" title="<?= DEMOLISH?>" onclick="return verify_demolition();">
    </form>
<?php endif;?>

<script>
function verify_demolition() {
    var dType = document.getElementById('demolition_type');
    var instant = document.getElementById('instant_demolish').checked;
    var warnLvl3 = <?= ($session->alliance && $database->isAllianceOwner($session->uid) == $session->alliance && $memberCount == 1 && $database->getSingleFieldTypeCount($session->uid, 18, '>=', 3) == 1)? 'true' : 'false'?>;
    var warnLvl1 = <?= ($session->alliance && $database->getSingleFieldTypeCount($session->uid, 18, '>=', 1) == 1)? 'true' : 'false'?>;

    var text = dType.options[dType.selectedIndex].text;

    if (instant) {
        return confirm(<?= json_encode(TZ_CONFIRM_DEMOLISH_COMPLETE_1)?>+text+<?= json_encode(TZ_CONFIRM_DEMOLISH_COMPLETE_2)?>);
    }

    if (warnLvl3 && text.indexOf('Embassy (lvl 3)') > -1) {
        return confirm(<?= json_encode(TZ_CONFIRM_LAST_EMBASSY_L3)?>);
    }
    if (warnLvl1 && text.indexOf('Embassy (lvl 1)') > -1) {
        return confirm(<?= json_encode(TZ_CONFIRM_LAST_EMBASSY_L1)?>);
    }
    return true;
}
</script>