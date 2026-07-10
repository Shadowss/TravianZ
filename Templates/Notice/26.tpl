<?php
#################################################################################
#  Hero adventure report (26.tpl) - T4 hero port, Phase 1                       #
#  Handles ntype 26. The reward payload is stored in ndata.data as a            #
#  query-string, e.g.:                                                          #
#     difficulty=1&exp=22&silver=80&wood=300&clay=0&iron=450&crop=120&hp=18     #
#     &item=HERO_ITEM_OINTMENT&itemqty=2                                        #
#  Any missing key simply renders as 0 / hidden, so partial payloads are safe.  #
#                                                                               #
#  Lang constants (HERO_ADV_*, HERO_ITEM_*) arrive in the Phase 6 lang pass;    #
#  the tz() helper below falls back to a readable literal until then so this    #
#  template never emits "Undefined constant" before the rest of the port lands. #
#################################################################################

// Tiny local fallback so this file is self-contained in Phase 1.
if (!function_exists('tz_hero_adv')) {
    function tz_hero_adv($const, $fallback) {
        return defined($const) ? constant($const) : $fallback;
    }
}

parse_str((string)($message->readingNotice['data'] ?? ''), $adv);

$difficulty = (int)($adv['difficulty'] ?? 0);
$died       = (int)($adv['died']   ?? 0);
$exp        = (int)($adv['exp']    ?? 0);
$silver     = (int)($adv['silver'] ?? 0);
$hp         = (int)($adv['hp']     ?? 0);
$wood       = (int)($adv['wood']   ?? 0);
$clay       = (int)($adv['clay']   ?? 0);
$iron       = (int)($adv['iron']   ?? 0);
$crop       = (int)($adv['crop']   ?? 0);
$itemId     = (int)($adv['itemid'] ?? 0);
$itemQty    = (int)($adv['itemqty'] ?? 0);

// Resolve the item name from the catalog (heroItemName falls back safely).
// berichte.php runs from the web root, so the relative path is stable.
if ($itemId > 0 && !function_exists('heroItemName')) {
    include_once 'GameEngine/Data/hero_items.php';
}

$diffLabel = $difficulty === 1
    ? tz_hero_adv('HERO_ADV_HARD',   'a hard adventure')
    : tz_hero_adv('HERO_ADV_NORMAL', 'a normal adventure');
?>

<table cellpadding="1" cellspacing="1" id="report_surround">
<thead>

<tr>
    <th><?php echo defined('SUBJECT') ? SUBJECT : 'Subject'; ?>:</th>
    <th><?php echo tz_loc_topic($message->readingNotice['topic']); ?></th>
</tr>

<tr>
    <?php $date = $generator->procMtime($message->readingNotice['time']); ?>
    <td class="sent"><?php echo defined('TZ_SENT') ? TZ_SENT : 'Sent'; ?></td>
    <td><?php echo (defined('ON') ? ON : 'on') . ' '; ?><span><?php echo $date[0] . " " . $date[1]; ?></span></td>
</tr>

</thead>

<tbody>
<tr><td colspan="2" class="empty"></td></tr>
<tr><td colspan="2" class="report_content">

    <?php if ($died) { ?>

    <p><?php echo tz_hero_adv('HERO_ADV_DIED', 'Your hero fell on'); ?> <b><?php echo $diffLabel; ?></b>.</p>
    <p><?php echo tz_hero_adv('HERO_ADV_DIED_INFO', 'All loot was lost. The hero can be revived at the Hero\'s Mansion.'); ?></p>

    <?php } else { ?>

    <p><?php echo tz_hero_adv('HERO_ADV_RETURNED', 'Your hero has returned from'); ?> <b><?php echo $diffLabel; ?></b>.</p>

    <table class="adventureReward" cellpadding="1" cellspacing="1" style="width:100%;margin-top:8px;">
        <tr>
            <th style="text-align:left;"><?php echo tz_hero_adv('HERO_ADV_REWARD', 'Reward'); ?></th>
            <th style="text-align:right;"><?php echo tz_hero_adv('HERO_ADV_AMOUNT', 'Amount'); ?></th>
        </tr>
        <tr>
            <td><?php echo tz_hero_adv('HERO_EXPERIENCE', 'Experience'); ?></td>
            <td style="text-align:right;">+<?php echo $exp; ?></td>
        </tr>
        <?php if ($silver > 0) { ?>
        <tr>
            <td><?php echo tz_hero_adv('HERO_SILVER', 'Silver'); ?></td>
            <td style="text-align:right;">+<?php echo number_format($silver); ?></td>
        </tr>
        <?php } ?>
        <?php if ($wood || $clay || $iron || $crop) { ?>
        <tr>
            <td><?php echo tz_hero_adv('RESOURCES', 'Resources'); ?></td>
            <td style="text-align:right;">
                <span class="res wood"><?php echo number_format($wood); ?></span>
                <span class="res clay"><?php echo number_format($clay); ?></span>
                <span class="res iron"><?php echo number_format($iron); ?></span>
                <span class="res crop"><?php echo number_format($crop); ?></span>
            </td>
        </tr>
        <?php } ?>
        <?php if ($itemId > 0 && $itemQty > 0) { ?>
        <tr>
            <td><?php echo tz_hero_adv('HERO_ADV_ITEM_FOUND', 'Item found'); ?></td>
            <td style="text-align:right;"><?php echo $itemQty; ?>&times; <?php echo heroItemName($itemId); ?></td>
        </tr>
        <?php } ?>
        <?php if ($hp > 0) { ?>
        <tr>
            <td><?php echo tz_hero_adv('HERO_ADV_HP_LOST', 'Health lost'); ?></td>
            <td style="text-align:right;color:#a00;">-<?php echo $hp; ?>%</td>
        </tr>
        <?php } ?>
    </table>

    <?php } // end survived branch ?>

</td></tr>
</tbody>
</table>
