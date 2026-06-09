<?php
// 36.tpl - TRAPS
global $village, $building, $technology, $generator, $database, $session, $bid19, $bid36, $id, $loopsame, $doublebuild, $master;

include("next.tpl");

$level = (int)$village->resarray['f'.$id];
$currentCap = $level > 0? (int)$bid36[$level]['attri'] * TRAPPER_CAPACITY : 0;
?>
<div id="build" class="gid36">
    <h1><?php echo TRAPPER;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc">
        <a href="#" onClick="return Popup(36,4,'gid');" class="build_logo">
            <img class="building g36" src="img/x.gif" alt="<?php echo TRAPPER; ?>" title="<?php echo TRAPPER;?>" />
        </a>
        <?php echo TRAPPER_DESC;?>
    </p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?php echo CURRENT_TRAPS;?></th>
            <td><b><?php echo $currentCap;?></b> <?php echo TRAPS;?></td>
        </tr>
        <?php if (!$building->isMax($village->resarray['f'.$id.'t'], $id)):
            $next = $level + 1 + $loopsame + $doublebuild + $master;
            $next = $next > 20? 20 : $next;
       ?>
        <tr>
            <th><?php echo TRAPS_LEVEL;?> <?php echo $next;?>:</th>
            <td><b><?php echo (int)$bid36[$next]['attri'] * TRAPPER_CAPACITY;?></b> <?php echo TRAPS;?></td>
        </tr>
        <?php endif;?>
    </table>

    <p><?php echo CURRENT_HAVE;?> <b><?php echo (int)$village->unitarray['u99'];?></b> <?php echo TRAPS;?>, <b><?php echo (int)$village->unitarray['u99o'];?></b> <?php echo WHICH_OCCUPIED;?></p>

    <?php if ($building->getTypeLevel(36) > 0):
        $trainlist = $technology->getTrainingList(8);
        $train_amt = 0;
        foreach ($trainlist as $t) $train_amt += (int)$t['amt'];

        $max = $technology->maxUnit(99, false);
        $max1 = 0;
        for ($i = 19; $i < 41; $i++) {
            if ((int)$village->resarray['f'.$i.'t'] == 36) {
                $max1 += (int)$bid36[(int)$village->resarray['f'.$i]]['attri'] * TRAPPER_CAPACITY;
            }
        }
        $max = min($max, $max1 - ((int)$village->unitarray['u99'] + $train_amt));
        if ($max < 0) $max = 0;

        $time = $database->getArtifactsValueInfluence($session->uid, $village->wid, 5, round(($bid19[$level]['attri'] / 100) * ${'u99'}['time'] / SPEED));
   ?>
    <form method="POST" name="snd" action="build.php">
        <input type="hidden" name="id" value="<?php echo (int)$id;?>" />
        <input type="hidden" name="ft" value="t1" />
        <table cellpadding="1" cellspacing="1" class="build_details">
            <thead><tr><td><?php echo NAME;?></td><td><?php echo QUANTITY;?></td><td><?php echo MAX;?></td></tr></thead>
            <tbody>
                <tr>
                    <td class="desc">
                        <div class="tit">
                            <img class="unit u99" src="img/x.gif" alt="<?php echo U99; ?>" title="<?php echo U99; ?>" />
                            <a href="#" onClick="return Popup(36,4,'gid');"><?php echo TRAP;?></a>
                            <span class="info">(<?php echo AVAILABLE;?>: <?php echo (int)$village->unitarray['u99'];?>)</span>
                        </div>
                        <div class="details">
                            <img class="r1" src="img/x.gif" title="<?php echo LUMBER;?>"/>20|
                            <img class="r2" src="img/x.gif" title="<?php echo CLAY;?>"/>30|
                            <img class="r3" src="img/x.gif" title="<?php echo IRON;?>"/>10|
                            <img class="r4" src="img/x.gif" title="<?php echo CROP;?>"/>20|
                            <img class="r5" src="img/x.gif" title="<?php echo CROP_COM;?>"/>0|
                            <img class="clock" src="img/x.gif" title="<?php echo DURATION;?>"/><?php echo $generator->getTimeFormat($time);?>
                        </div>
                    </td>
                    <td class="val"><input type="text" class="text" name="t99" value="0" maxlength="4"></td>
                    <td class="max"><a href="#" onClick="document.snd.t99.value=<?php echo $max;?>; return false;">(<?php echo $max;?>)</a></td>
                </tr>
            </tbody>
        </table>
        <p><input type="image" id="btn_train" class="dynamic_img" value="ok" name="s1" src="img/x.gif" alt="<?php echo TRAIN; ?>" onclick="this.disabled=true;this.form.submit();"/></p>
    </form>
    <?php else:?>
        <b><?php echo TRAINING_COMMENCE_TRAPPER;?></b><br />
    <?php endif;?>

    <?php if (!empty($trainlist)): $TrainCount = 0; $NextFinished = '';?>
    <table cellpadding="1" cellspacing="1" class="under_progress">
        <thead><tr><td><?php echo TRAINING;?></td><td><?php echo DURATION;?></td><td><?php echo FINISHED;?></td></tr></thead>
        <tbody>
            <?php foreach ($trainlist as $train): $TrainCount++;?>
            <tr>
                <td class="desc"><img class="unit u<?php echo $train['unit'];?>" src="img/x.gif" alt="<?php echo U99;?>" title="<?php echo U99;?>" /><?php echo $train['amt'];?> <?php echo U99;?></td>
                <td class="dur">
                    <?php if ($TrainCount == 1): $NextFinished = $generator->getTimeFormat(($train['timestamp'] - time()) - ($train['amt'] - 1) * $train['eachtime']);?>
                        <span id="timer1"><?php echo $generator->getTimeFormat($train['timestamp'] - time());?></span>
                    <?php else:?>
                        <?php echo $generator->getTimeFormat($train['eachtime'] * $train['amt']);?>
                    <?php endif;?>
                </td>
                <td class="fin"><?php $time = $generator->procMTime($train['timestamp']); if($time[0]!="today") echo "on ".$time[0]." at "; echo $time[1];?></td>
            </tr>
            <?php endforeach;?>
            <tr class="next"><td colspan="3"><?php echo UNIT_FINISHED;?> <span id="timer2"><?php echo $NextFinished;?></span></td></tr>
        </tbody>
    </table>
    <?php endif;?>

    <?php include("upgrade.tpl");?>
</div>