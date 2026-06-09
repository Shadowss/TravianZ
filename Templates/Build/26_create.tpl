<?php
// 26_create.tpl - PALACE / TRAIN SETTLERS
global $village, $technology, $generator, $id;

$unitId = 20; // colonist
$unitName = $technology->getUnitName($unitId);
$costs = $GLOBALS['u'.$unitId]; // $u20 din config
$maxTrain = $technology->maxUnit($unitId);
$available = (int)($village->unitarray['u'.$unitId]?? 0);
$trainTime = $generator->getTimeFormat(round($costs['time'] / SPEED));
$trainList = $technology->getTrainingList($unitId);
?>
<form method="POST" name="snd" action="build.php">
    <input type="hidden" name="id" value="<?php echo (int)$id;?>" />
    <input type="hidden" name="ft" value="t1" />

    <table cellpadding="1" cellspacing="1" class="build_details">
        <thead>
            <tr>
                <td><?php echo NAME; ?></td>
                <td><?php echo TZ_NUMBER; ?></td>
                <td><?php echo MAX; ?></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="desc">
                    <div class="tit">
                        <img class="unit u<?php echo $unitId;?>" src="img/x.gif" alt="<?php echo htmlspecialchars($unitName);?>" title="<?php echo htmlspecialchars($unitName);?>" />
                        <a href="#" onclick="return Popup(<?php echo $unitId;?>,1);"><?php echo htmlspecialchars($unitName);?></a>
                        <span class="info">(Available: <?php echo $available;?>)</span>
                    </div>
                    <div class="details">
                        <img class="r1" src="img/x.gif" alt="<?php echo LUMBER; ?>" title="<?php echo LUMBER; ?>" /><?php echo $costs['wood'];?>|
                        <img class="r2" src="img/x.gif" alt="<?php echo CLAY; ?>" title="<?php echo CLAY; ?>" /><?php echo $costs['clay'];?>|
                        <img class="r3" src="img/x.gif" alt="<?php echo IRON; ?>" title="<?php echo IRON; ?>" /><?php echo $costs['iron'];?>|
                        <img class="r4" src="img/x.gif" alt="<?php echo CROP; ?>" title="<?php echo CROP; ?>" /><?php echo $costs['crop'];?>|
                        <img class="clock" src="img/x.gif" alt="<?php echo DURATION; ?>" title="<?php echo DURATION; ?>" /><?php echo $trainTime;?>
                    </div>
                </td>
                <td class="val">
                    <input type="text" class="text" name="t<?php echo $unitId;?>" value="0" maxlength="4">
                </td>
                <td class="max">
                    <a href="#" onclick="document.snd.t<?php echo $unitId;?>.value=<?php echo $maxTrain;?>; return false;">(<?php echo $maxTrain;?>)</a>
                </td>
            </tr>
        </tbody>
    </table>

    <p>
        <input type="image" id="btn_train" class="dynamic_img" value="ok" name="s1" src="img/x.gif" alt="<?php echo TRAIN; ?>" />
    </p>

    <?php if (!empty($trainList)):
        $timer = count($trainList) * 2;
   ?>
    <table cellpadding="1" cellspacing="1" class="under_progress">
        <thead>
            <tr>
                <td><?php echo TRAINING; ?></td>
                <td><?php echo DURATION; ?></td>
                <td><?php echo FINISHED; ?></td>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($trainList as $train):
            $totalFinish = $train['commence'] + ($train['eachtime'] * $train['amt']);
            $nextFinish = $train['commence'] + $train['eachtime'];
            $remainingTotal = max(0, $totalFinish - time());
            $remainingNext = max(0, $nextFinish - time());
            $time = $generator->procMTime($totalFinish);
       ?>
            <tr>
                <td class="desc">
                    <img class="unit u<?php echo (int)$train['unit'];?>" src="img/x.gif" alt="<?php echo htmlspecialchars($train['name']);?>" title="<?php echo htmlspecialchars($train['name']);?>" />
                    <?php echo (int)$train['amt'];?> <?php echo htmlspecialchars($train['name']);?>
                </td>
                <td class="dur">
                    <span id="timer<?php echo $timer;?>"><?php echo $generator->getTimeFormat($remainingTotal);?></span>
                </td>
                <td class="fin">
                    <?php if ($time[0]!= "today") echo "on ".$time[0]." at "; echo $time[1];?> o'clock
                </td>
            </tr>
            <tr class="next">
                <td colspan="3">
                    The next unit will be finished in <span id="timer<?php echo $timer-1;?>"><?php echo $generator->getTimeFormat($remainingNext);?></span>
                </td>
            </tr>
        <?php
            $timer -= 2;
        endforeach;?>
        </tbody>
    </table>
    <?php endif;?>
</form>