<?php
// 26_progress.tpl - PALACE / TRAIN PROGRESS
global $technology, $generator, $session;

$trainList = $technology->getTrainingList(4); // unit 4 = pentru chief? păstrez ID-ul tău
if (!empty($trainList)):
    $trainCount = 0;
    $nextFinished = '';
?>
<table cellpadding="1" cellspacing="1" class="under_progress">
    <thead>
        <tr>
            <td><?php echo TRAINING;?></td>
            <td><?php echo DURATION;?></td>
            <td><?php echo FINISHED;?></td>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($trainList as $train):
        $trainCount++;
        $isFirst = ($trainCount === 1);

        // timp rămas
        $remaining = max(0, (int)$train['timestamp'] - time());
        $duration = $isFirst? $remaining : (int)$train['eachtime'] * (int)$train['amt'];

        $time = $generator->procMTime((int)$train['timestamp']);

        if ($isFirst) {
            $nextFinished = $generator->getTimeFormat(max(0, (int)$train['timestamp2'] - time()));
            $timerMain = ++$session->timer;
        }
   ?>
        <tr>
            <td class="desc">
                <img class="unit u<?php echo (int)$train['unit'];?>" src="img/x.gif" alt="<?php echo htmlspecialchars($train['name']);?>" title="<?php echo htmlspecialchars($train['name']);?>" />
                <?php echo (int)$train['amt'];?> <?php echo htmlspecialchars($train['name']);?>
            </td>
            <td class="dur">
                <?php if ($isFirst):?>
                    <span id="timer<?php echo $timerMain;?>"><?php echo $generator->getTimeFormat($remaining);?></span>
                <?php else:?>
                    <?php echo $generator->getTimeFormat($duration);?>
                <?php endif;?>
            </td>
            <td class="fin">
                <?php if ($time[0]!== "today") echo "on ".$time[0]." at "; echo $time[1];?>
            </td>
        </tr>
    <?php endforeach;?>
        <tr class="next">
            <td colspan="3">
                <?php echo UNIT_FINISHED;?>
                <span id="timer<?php echo ++$session->timer;?>"><?php echo $nextFinished;?></span>
            </td>
        </tr>
    </tbody>
</table>
<?php endif;?>