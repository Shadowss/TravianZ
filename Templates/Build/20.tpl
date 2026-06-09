<?php
// 20.tpl - STABLE
global $village, $building, $technology, $generator, $session, $id;

$level = (int)$village->resarray['f'.$id];
$canTrain = $building->getTypeLevel(20) > 0;
$trainlist = $technology->getTrainingList(2);
?>
<div id="build" class="gid20">
    <a href="#" onClick="return Popup(20,4);" class="build_logo">
        <img class="building g20" src="img/x.gif" alt="<?php echo STABLE; ?>" title="<?php echo STABLE;?>" />
    </a>
    <h1><?php echo STABLE;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc"><?php echo STABLE_DESC;?><br /></p>

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
                    <?php if ($session->tribe!= 4) include("20_train.tpl");?>
                </tbody>
            </table>
            <p><input type="image" id="btn_train" class="dynamic_img" value="ok" name="s1" src="img/x.gif" alt="<?php echo TRAIN; ?>" /></p>
        </form>
    <?php else:?>
        <b><?php echo TRAINING_COMMENCE_STABLE;?></b><br />
    <?php endif;?>

    <?php if (count($trainlist) > 0):
        $NextFinished = '';
  ?>
        <table cellpadding="1" cellspacing="1" class="under_progress">
            <thead><tr>
                <td><?php echo TRAINING;?></td>
                <td><?php echo DURATION;?></td>
                <td><?php echo FINISHED;?></td>
            </tr></thead>
            <tbody>
            <?php $TrainCount = 0; foreach ($trainlist as $train):
                $TrainCount++;
                $unit = (int)$train['unit'];
                $amt = (int)$train['amt'];
                $name = htmlspecialchars($train['name']);
          ?>
                <tr>
                    <td class="desc">
                        <img class="unit u<?php echo $unit;?>" src="img/x.gif" alt="<?php echo $name;?>" title="<?php echo $name;?>" />
                        <?php echo $amt.' '.$name;?>
                    </td>
                    <td class="dur">
                        <?php if ($TrainCount === 1):
                            $NextFinished = $generator->getTimeFormat($train['timestamp2'] - time());
                      ?>
                            <span id="timer<?php echo ++$session->timer;?>"><?php echo $generator->getTimeFormat($train['timestamp'] - time());?></span>
                        <?php else:?>
                            <?php echo $generator->getTimeFormat($train['eachtime'] * $amt);?>
                        <?php endif;?>
                    </td>
                    <td class="fin">
                        <?php
                        $time = $generator->procMTime($train['timestamp']);
                        if ($time[0]!== "today") echo "on ".$time[0]." at ";
                        echo $time[1];
                      ?>
                    </td>
                </tr>
            <?php endforeach;?>
                <tr class="next"><td colspan="3"><?php echo UNIT_FINISHED;?> <span id="timer<?php echo ++$session->timer;?>"><?php echo $NextFinished;?></span></td></tr>
            </tbody>
        </table>
    <?php endif;?>

    <?php include("upgrade.tpl");?>
</div>