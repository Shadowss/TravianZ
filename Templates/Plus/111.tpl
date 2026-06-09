<?php
include("Templates/Plus/pmenu.tpl");

$uid = (int)$session->uid;
$gold = defined('PLUS_PACKAGE_B_GOLD')? PLUS_PACKAGE_B_GOLD : 120;
$price = defined('PLUS_PACKAGE_B_PRICE')? str_replace(',', '.', PLUS_PACKAGE_B_PRICE) : '4.99';
$currency = defined('PAYPAL_CURRENCY')? PAYPAL_CURRENCY : 'EUR';
$paypal = defined('PAYPAL_EMAIL')? PAYPAL_EMAIL : 'novgorodschi@icloud.com';

// link-uri pentru IPN
$notify = rtrim(HOMEPAGE,'/'). '/paypal_ipn.php';
$return = rtrim(HOMEPAGE,'/'). '/plus.php?id=1&paid=1';
$cancel = rtrim(HOMEPAGE,'/'). '/plus.php?id=1&cancel=1';
?>
<table class="rate_details" cellpadding="1" cellspacing="1">
    <thead><tr><th colspan="2"><?php echo TZ_PAYPAL_PACKAGE_B; ?></th></tr></thead>
    <tbody>
    <tr>
        <td class="pic">
            <img src="img/bezahlung/paypal.jpg" style="width:99px;height:99px;" alt="<?php echo PACKAGE_B; ?>" />
            <div>Gold: <?= $gold?><br>Cost: <?= $price?> <?= $currency?><br><?php echo TZ_WAIT_INSTANT_AFTER_IPN; ?></div>
        </td>
        <td class="desc">
            <?php echo TZ_PAY_SECURELY_WITH_PAYPAL; ?><br><br>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="<?= $paypal?>">
                <input type="hidden" name="item_name" value="<?= SERVER_NAME?> Package B">
                <input type="hidden" name="item_number" value="B-<?= $gold?>">
                <input type="hidden" name="amount" value="<?= $price?>">
                <input type="hidden" name="currency_code" value="<?= $currency?>">

                <!-- IDENTIFICARE JUCĂTOR -->
                <input type="hidden" name="custom" value="<?= $uid?>">
                <input type="hidden" name="notify_url" value="<?= $notify?>">
                <input type="hidden" name="return" value="<?= $return?>">
                <input type="hidden" name="cancel_return" value="<?= $cancel?>">
                <input type="hidden" name="no_shipping" value="1">

                <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_buynow_107x26.png" name="submit" alt="<?php echo BUY_NOW; ?>">
            </form>
            <br><?php echo TZ_AFTER_PAYMENT_YOU_WILL_BE_CREDITED; ?>
        </td>
    </tr>
    </tbody>
</table>
</div>
</div>