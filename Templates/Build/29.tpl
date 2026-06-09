<?php
// 29.tpl - GREATBARRACKS
global $village, $building, $technology, $generator, $session, $id;

$level = (int)$village->resarray['f'.$id];
?>
<div id="build" class="gid29">
    <a href="#" onClick="return Popup(29,4);" class="build_logo">
        <img class="building g29" src="img/x.gif" alt="<?php echo GREATBARRACKS; ?>" title="<?php echo GREATBARRACKS;?>" />
    </a>
    <h1><?php echo GREATBARRACKS;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc"><?php echo GREATBARRACKS_DESC;?></p>

    <?php if ($building->getTypeLevel(29) > 0):?>
    <form method="POST" name="snd" action="build.php">
        <input type="hidden" name="id" value="<?php echo (int)$id;?>" />
        <input type="hidden" name="ft" value="t3" />
        <table cellpadding="1" cellspacing="1" class="build_details">
            <thead><tr><td><?php echo NAME;?></td><td><?php echo QUANTITY;?></td><td><?php echo MAX;?></td></tr></thead>
            <tbody><?php include("29_train.tpl");?></tbody>
        </table>
        <p><input type="image" id="btn_train" class="dynamic_img" value="ok" name="s1" src="img/x.gif" alt="<?php echo TRAIN; ?>" /></p>
    </form>
    <?php else:?>
        <b><?php echo TRAINING_COMMENCE_GREATBARRACKS;?></b><br />
    <?php endif;?>

    <?php $trainlist = $technology->getTrainingList(5); if (count($trainlist) > 0): $TrainCount = 0; $NextFinished = '';?>
    <table cellpadding="1" cellspacing="1" class="under_progress">
        <thead><tr><td><?php echo TRAINING;?></td><td><?php echo DURATION;?></td><td><?php echo FINISHED;?></td></tr></thead>
        <tbody>
            <?php foreach ($trainlist as $train): $TrainCount++;?>
            <tr>
                <td class="desc"><img class="unit u<?php echo $train['unit'];?>" src="img/x.gif" alt="<?php echo $train['name'];?>" title="<?php echo $train['name'];?>" /><?php echo $train['amt'];?> <?php echo $train['name'];?></td>
                <td class="dur">
                    <?php if ($TrainCount == 1): $NextFinished = $generator->getTimeFormat($train['timestamp2']-time());?>
                        <span id="timer<?php echo ++$session->timer;?>"><?php echo $generator->getTimeFormat($train['timestamp']-time());?></span>
                    <?php else:?>
                        <?php echo $generator->getTimeFormat($train['eachtime']*$train['amt']);?>
                    <?php endif;?>
                </td>
                <td class="fin"><?php $time = $generator->procMTime($train['timestamp']); if($time[0]!="today") echo "on ".$time[0]." at "; echo $time[1];?></td>
            </tr>
            <?php endforeach;?>
            <tr class="next"><td colspan="3"><?php echo UNIT_FINISHED;?> <span id="timer<?php echo ++$session->timer;?>"><?php echo $NextFinished;?></span></td></tr>
        </tbody>
    </table>
    <?php endif;?>

    <?php include("upgrade.tpl");?>
</div>