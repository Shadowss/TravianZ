<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : HERO T4 ADVENTURES PAGE                                   ##
##  Type           : BUILDING TEMPLATE                                         ##
## --------------------------------------------------------------------------- ##
##  Created by     : Shadow                                                    ##
##  Designed by    : Shadow                                                    ##
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

$t4Adventures = new HeroAdventure();
$t4Msg = '';

if (isset($_POST['t4action'], $_POST['advid']) && $_POST['t4action'] === 'startadv') {
    $t4Result = $t4Adventures->startAdventure($session->uid, (int) $_POST['advid']);
    if ($t4Result === HeroAdventure::START_OK) {
        $t4Msg = HERO_ADV_START_OK;
    } elseif ($t4Result === HeroAdventure::START_NO_HERO) {
        $t4Msg = HERO_ADV_START_NOHERO;
    } elseif ($t4Result === HeroAdventure::START_HERO_AWAY) {
        $t4Msg = HERO_ADV_START_AWAY;
    } else {
        $t4Msg = HERO_ADV_START_FAIL;
    }
}

// Top up the list opportunistically (respects max/refresh limits internally).
$t4Adventures->generateOffers($session->uid);

$t4Offers  = $t4Adventures->getOffers($session->uid);
$t4Running = $t4Adventures->getRunning($session->uid);
$t4Now     = time();
?>

<?php if ($t4Msg !== '') { ?>
    <p class="message" style="font-weight:bold;"><?php echo $t4Msg; ?></p>
<?php } ?>

<?php if ($t4Running) { ?>
<table id="distribution" cellpadding="1" cellspacing="1">
    <thead>
        <tr><th><?php echo HERO_ADV_RUNNING; ?>
            <span id="timer<?php echo ++$session->timer; ?>"><?php echo $generator->getTimeFormat(max(0, $t4Running['endtime'] - $t4Now)); ?></span>
        </th></tr>
    </thead>
</table>
<?php } ?>

<table id="distribution" cellpadding="1" cellspacing="1" style="margin-top:10px;">
    <thead>
        <tr><th colspan="4"><?php echo HERO_ADV_LIST; ?></th></tr>
        <tr>
            <td><b><?php echo HERO_ADV_DIFFICULTY; ?></b></td>
            <td><b><?php echo HERO_ADV_DURATION; ?></b></td>
            <td><b><?php echo HERO_ADV_EXPIRES; ?></b></td>
            <td></td>
        </tr>
    </thead>
    <tbody>
    <?php if (count($t4Offers)) { ?>
        <?php foreach ($t4Offers as $t4Offer) { ?>
        <tr>
            <td>
			<?php if ((int)$t4Offer['difficulty'] === 1): ?>
			<img src="img/hero/dangerGreat.gif" alt="hard" title="<?php echo HERO_ADV_DIFF_HARD; ?>" style="vertical-align:middle; margin-right:4px; width:16px; height:16px;">
			<?php echo HERO_ADV_DIFF_HARD; ?>
			<?php else: ?>
			<img src="img/hero/danger.gif" alt="normal" title="<?php echo HERO_ADV_DIFF_NORMAL; ?>" style="vertical-align:middle; margin-right:4px; width:16px; height:16px;">
			<?php echo HERO_ADV_DIFF_NORMAL; ?>
			<?php endif; ?>
			</td>
            <td><?php echo $generator->getTimeFormat((int) $t4Offer['duration']); ?></td>
            <td><span id="timer<?php echo ++$session->timer; ?>"><?php echo $generator->getTimeFormat(max(0, $t4Offer['expire'] - $t4Now)); ?></span></td>
            <td style="width:140px;text-align:center;">
                <?php if (!$t4Running) { ?>
                <form action="" method="POST" style="margin:0;">
                    <input type="hidden" name="t4action" value="startadv">
                    <input type="hidden" name="advid" value="<?php echo (int) $t4Offer['id']; ?>">
                    <input type="submit" value="<?php echo HERO_ADV_GO; ?>">
                </form>
                <?php } else { ?>-<?php } ?>
            </td>
        </tr>
        <?php } ?>
    <?php } else { ?>
        <tr><td colspan="4"><?php echo HERO_ADV_NONE; ?></td></tr>
    <?php } ?>
    </tbody>
</table>
