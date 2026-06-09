<?php
// 25_create.tpl - RESIDENCE TRAIN UNITS
global $id, $technology, $village, $generator;

$i = 20; // Settler (sau 19 pentru Chief la Palace)
$unit = ${'u'.$i};
$available = (int)$village->unitarray['u'.$i];
$maxTrain = $technology->maxUnit($i);
$trainlist = $technology->getTrainingList(20);
?>
<form method="POST" name="snd" action="build.php">
    <input type="hidden" name="id" value="<?php echo (int)$id;?>" />
    <input type="hidden" name="ft" value="t1" />

    <table cellpadding="1" cellspacing="1" class="build_details">
        <thead><tr><td><?php echo NAME; ?></td><td><?php echo TZ_NUMBER; ?></td><td><?php echo MAX; ?></td></tr></thead>
        <tbody>
            <tr>
                <td class="desc">
                    <div class="tit">
                        <img class="unit u<?php echo $i;?>" src="img/x.gif" alt="<?php echo $technology->getUnitName($i);?>" />
                        <a href="#" onClick="return Popup(<?php echo $i;?>,1);"><?php echo $technology->getUnitName($i);?></a>
                        <span class="info">(Available: <?php echo $available;?>)</span>
                    </div>
                    <div class="details">
                        <img class="r1" src="img/x.gif" title="<?php echo LUMBER; ?>"/><?php echo (int)$unit['wood'];?>|
                        <img class="r2" src="img/x.gif" title="<?php echo CLAY; ?>"/><?php echo (int)$unit['clay'];?>|
                        <img class="r3" src="img/x.gif" title="<?php echo IRON; ?>"/><?php echo (int)$unit['iron'];?>|
                        <img class="r4" src="img/x.gif" title="<?php echo CROP; ?>"/><?php echo (int)$unit['crop'];?>|
                        <img class="clock" src="img/x.gif" title="<?php echo DURATION; ?>"/><?php echo $generator->getTimeFormat(round($unit['time']/SPEED));?>
                    </div>
                </td>
                <td class="val"><input type="text" class="text" name="t<?php echo $i;?>" value="0" maxlength="4"></td>
                <td class="max"><a href="#" onClick="document.snd.t<?php echo $i;?>.value=<?php echo $maxTrain;?>; return false;">(<?php echo $maxTrain;?>)</a></td>
            </tr>
        </tbody>
    </table>
    <p><input type="image" id="btn_train" class="dynamic_img" value="ok" name="s1" src="img/x.gif" alt="<?php echo TRAIN; ?>" /></p>

    <?php if (count($trainlist) > 0): $timer = 2*count($trainlist);?>
    <table cellpadding="1" cellspacing="1" class="under_progress">
        <thead><tr><td><?php echo TRAINING; ?></td><td><?php echo DURATION; ?></td><td><?php echo FINISHED; ?></td></tr></thead>
        <tbody>
            <?php foreach ($trainlist as $train):?>
            <tr>
                <td class="desc"><img class="unit u<?php echo $train['unit'];?>" src="img/x.gif" alt="<?php echo $train['name'];?>"/><?php echo $train['amt'];?> <?php echo $train['name'];?></td>
                <td class="dur"><span id="timer<?php echo $timer;?>"><?php echo $generator->getTimeFormat(($train['commence']+($train['eachtime']*$train['amt']))-time());?></span></td>
                <td class="fin"><?php $time = $generator->procMTime($train['commence']+$train['amt']); if($time[0]!="today") echo "on ".$time[0]." at "; echo $time[1];?> o'clock</td>
            </tr>
            <tr class="next"><td colspan="3"><?php echo UNIT_FINISHED; ?> <span id="timer<?php echo --$timer;?>"><?php echo $generator->getTimeFormat(($train['commence']+$train['eachtime'])-time());?></span></td></tr>
            <?php $timer--; endforeach;?>
        </tbody>
    </table>
    <?php endif;?>
</form>