<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : RESIDENCE TRAINING UNITS PROGRESS                         ##
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

global $technology, $generator, $session;

$trainlist = $technology->getTrainingList(4);
if (count($trainlist) > 0):
    $TrainCount = 0;
    $NextFinished = '';
?>
<table cellpadding="1" cellspacing="1" class="under_progress">
    <thead><tr><td><?php echo TRAINING;?></td><td><?php echo DURATION;?></td><td><?php echo FINISHED;?></td></tr></thead>
    <tbody>
        <?php foreach ($trainlist as $train): $TrainCount++;?>
        <tr>
            <td class="desc">
                <img class="unit u<?php echo $train['unit'];?>" src="img/x.gif" alt="<?php echo $train['name'];?>" title="<?php echo $train['name'];?>" />
                <?php echo $train['amt'];?> <?php echo $train['name'];?>
            </td>
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