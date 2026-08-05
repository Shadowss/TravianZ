<?php

#################################################################################
##                -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-               ##
## --------------------------------------------------------------------------- ##
##  Filename       : 27.tpl                                                    ##
##  Type           : Hero Report - Auction Result                              ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  URLs:          : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

if (!function_exists('tz_hero_auc')) {
    function tz_hero_auc($const, $fallback) {
        return defined($const) ? constant($const) : $fallback;
    }
}

parse_str((string)($message->readingNotice['data'] ?? ''), $auc);

$role    = (string)($auc['role'] ?? '');
$expired = (int)($auc['expired'] ?? 0);
$itemId  = (int)($auc['itemid'] ?? 0);
$qty     = (int)($auc['qty']    ?? 0);
$price   = (int)($auc['price']  ?? 0);
$refund  = (int)($auc['refund'] ?? 0);
$fee     = (int)($auc['fee']    ?? 0);

if ($itemId > 0 && !function_exists('heroItemName')) {
    include_once 'GameEngine/Data/hero_items.php';
}
$itemLabel = $qty . '&times; ' . ($itemId > 0 ? heroItemName($itemId) : '?');
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

    <?php if ($role === 'winner') { ?>

    <p><?php echo tz_hero_auc('HERO_AUC_WON', 'You won the auction for'); ?> <b><?php echo $itemLabel; ?></b>.</p>
    <table class="auctionResult" cellpadding="1" cellspacing="1" style="width:100%;margin-top:8px;">
        <tr>
            <td><?php echo tz_hero_auc('HERO_AUC_PRICE', 'Final price'); ?></td>
            <td style="text-align:right;"><?php echo number_format($price); ?> <?php echo tz_hero_auc('HERO_SILVER', 'silver'); ?></td>
        </tr>
        <?php if ($refund > 0) { ?>
        <tr>
            <td><?php echo tz_hero_auc('HERO_AUC_REFUND', 'Refunded from your maximum bid'); ?></td>
            <td style="text-align:right;">+<?php echo number_format($refund); ?></td>
        </tr>
        <?php } ?>
    </table>

    <?php } elseif ($role === 'seller' && !$expired) { ?>

    <p><?php echo tz_hero_auc('HERO_AUC_SOLD', 'Your auction sold:'); ?> <b><?php echo $itemLabel; ?></b>.</p>
    <table class="auctionResult" cellpadding="1" cellspacing="1" style="width:100%;margin-top:8px;">
        <tr>
            <td><?php echo tz_hero_auc('HERO_AUC_PRICE', 'Final price'); ?></td>
            <td style="text-align:right;"><?php echo number_format($price); ?> <?php echo tz_hero_auc('HERO_SILVER', 'silver'); ?></td>
        </tr>
        <tr>
            <td><?php echo tz_hero_auc('HERO_AUC_FEE', 'Auction fee'); ?></td>
            <td style="text-align:right;color:#a00;">-<?php echo number_format($fee); ?></td>
        </tr>
        <tr>
            <td><b><?php echo tz_hero_auc('HERO_AUC_PAYOUT', 'Payout'); ?></b></td>
            <td style="text-align:right;"><b>+<?php echo number_format($price - $fee); ?></b></td>
        </tr>
    </table>

    <?php } else { ?>

    <p><?php echo tz_hero_auc('HERO_AUC_EXPIRED', 'Your auction ended without bids. The item was returned to your inventory:'); ?> <b><?php echo $itemLabel; ?></b>.</p>

    <?php } ?>

</td></tr>
</tbody>
</table>
