<?php
// 21.tpl - WORKSHOP
global $village, $building, $technology, $generator, $session, $database, $id, $bid21;

$level = (int)$village->resarray['f'.$id];
$canTrain = $building->getTypeLevel(21) > 0;
$trainlist = $technology->getTrainingList(3);
?>
<div id="build" class="gid21">
    <a href="#" onClick="return Popup(21,4, 'gid');" class="build_logo">
        <img class="building g21" src="img/x.gif" alt="<?php echo WORKSHOP; ?>" title="<?php echo WORKSHOP;?>" />
    </a>
    <h1><?php echo WORKSHOP;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc"><?php echo WORKSHOP_DESC;?></p>

    <?php if ($canTrain):?>
        <form method="POST" name="snd" action="build.php">
            <input type="hidden" name="id" value="<?php echo (int)$id;?>" />
            <input type="hidden" name="ft" value="t1" />
            <table cellpadding="1" cellspacing="1" class="build_details">
                <thead><tr>
                    <td><?php echo NAME;?></td>
                    <td><?php echo QUANTITY;?></td>
                    <td><?php echo MAX;?></td>
                </tr></thead>
                <tbody>
                <?php
                $success = 0;
                $tribe = (int)$session->tribe;
                if ($tribe!== 4) {
                    $starts = [1=>7, 2=>17, 3=>27, 5=>47];
                    $start = $starts[$tribe]?? 7;
                    for ($i = $start; $i <= $start+1; $i++) {
                        if (!$technology->getTech($i)) continue;
                        $unitData = ${'u'.$i};
                        $name = $technology->getUnitName($i);
                        $maxTrain = $technology->maxUnit($i);
                        $maxPlus = $technology->maxUnitPlus($i);
                        $available = (int)($village->unitarray['u'.$i]?? 0);
                        $dur = $database->getArtifactsValueInfluence($session->uid, $village->wid, 5, round($unitData['time'] * ($bid21[$level]['attri']/100) / SPEED));
                        $timeFormatted = $generator->getTimeFormat($dur);
                        $total_required = (int)($unitData['wood']+$unitData['clay']+$unitData['iron']+$unitData['crop']);
                        $showNpc = $session->userinfo['gold']>=3 && $building->getTypeLevel(17)>=1 && $village->atotal >= $total_required;
                        $success++;
               ?>
                    <tr>
                        <td class="desc">
                            <div class="tit">
                                <img class="unit u<?php echo $i;?>" src="img/x.gif" alt="<?php echo htmlspecialchars($name);?>" title="<?php echo htmlspecialchars($name);?>" />
                                <a href="#" onClick="return Popup(<?php echo $i;?>,1);"><?php echo htmlspecialchars($name);?></a>
                                <span class="info">(<?php echo AVAILABLE;?>: <?php echo $available;?>)</span>
                            </div>
                            <div class="details">
                                <img class="r1" src="img/x.gif" title="<?php echo LUMBER;?>"/><?php echo (int)$unitData['wood'];?>|
                                <img class="r2" src="img/x.gif" title="<?php echo CLAY;?>"/><?php echo (int)$unitData['clay'];?>|
                                <img class="r3" src="img/x.gif" title="<?php echo IRON;?>"/><?php echo (int)$unitData['iron'];?>|
                                <img class="r4" src="img/x.gif" title="<?php echo CROP;?>"/><?php echo (int)$unitData['crop'];?>|
                                <img class="r5" src="img/x.gif" title="<?php echo CROP_COM;?>"/><?php echo (int)$unitData['pop'];?>|
                                <img class="clock" src="img/x.gif" title="<?php echo DURATION;?>"/><?php echo $timeFormatted;?>
                                <?php if ($showNpc):?>
                                    |<a href="build.php?gid=17&t=3&r1=<?php echo (int)$unitData['wood']*$maxPlus;?>&r2=<?php echo (int)$unitData['clay']*$maxPlus;?>&r3=<?php echo (int)$unitData['iron']*$maxPlus;?>&r4=<?php echo (int)$unitData['crop']*$maxPlus;?>" title="<?php echo NPC_TRADE; ?>"><img class="npc" src="img/x.gif" alt="<?php echo NPC_TRADE; ?>"/></a>
                                <?php endif;?>
                            </div>
                        </td>
                        <td class="val"><input type="text" class="text" name="t<?php echo $i;?>" value="0" maxlength="10"></td>
                        <td class="max"><a href="#" onClick="document.snd.t<?php echo $i;?>.value=<?php echo $maxTrain;?>; return false;">(<?php echo $maxTrain;?>)</a></td>
                    </tr>
                <?php } } if ($success===0):?>
                    <tr><td class="none" colspan="3"><?php echo AVAILABLE_ACADEMY;?></td></tr>
                <?php endif;?>
                </tbody>
            </table>
            <p><input type="image" id="btn_train" class="dynamic_img" value="ok" name="s1" src="img/x.gif" alt="<?php echo TRAIN; ?>" /></p>
        </form>
    <?php else:?>
        <b><?php echo TRAINING_COMMENCE_WORKSHOP;?></b><br />
    <?php endif;?>

    <?php if (count($trainlist) > 0):
        $NextFinished = '';
  ?>
        <table cellpadding="1" cellspacing="1" class="under_progress">
            <thead><tr><td><?php echo TRAINING;?></td><td><?php echo DURATION;?></td><td><?php echo FINISHED;?></td></tr></thead>
            <tbody>
            <?php $TrainCount=0; foreach($trainlist as $train):
                $TrainCount++; $unit=(int)$train['unit']; $amt=(int)$train['amt']; $name=htmlspecialchars($train['name']);
          ?>
                <tr>
                    <td class="desc"><img class="unit u<?php echo $unit;?>" src="img/x.gif" alt="<?php echo $name;?>" title="<?php echo $name;?>"/> <?php echo $amt.' '.$name;?></td>
                    <td class="dur">
                        <?php if($TrainCount===1): $NextFinished=$generator->getTimeFormat($train['timestamp2']-time());?>
                            <span id="timer<?php echo ++$session->timer;?>"><?php echo $generator->getTimeFormat($train['timestamp']-time());?></span>
                        <?php else: echo $generator->getTimeFormat($train['eachtime']*$amt); endif;?>
                    </td>
                    <td class="fin"><?php $time=$generator->procMTime($train['timestamp']); if($time[0]!=="today") echo "on ".$time[0]." at "; echo $time[1];?></td>
                </tr>
            <?php endforeach;?>
                <tr class="next"><td colspan="3"><?php echo UNIT_FINISHED;?> <span id="timer<?php echo ++$session->timer;?>"><?php echo $NextFinished;?></span></td></tr>
            </tbody>
        </table>
    <?php endif;?>

    <?php include("upgrade.tpl");?>
</div>