<?php
include("Templates/Plus/pmenu.tpl");

$uid = (int)$session->uid;
$gold = defined('PLUS_PACKAGE_C_GOLD') ? PLUS_PACKAGE_C_GOLD : 360;
$price = defined('PLUS_PACKAGE_C_PRICE') ? str_replace(',', '.', PLUS_PACKAGE_C_PRICE) : '9.99';
$currency = defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR';
$paypal = defined('PAYPAL_EMAIL') ? PAYPAL_EMAIL : 'novgorodschi@icloud.com';

$base = rtrim(HOMEPAGE,'/');
?>
<table class="rate_details" cellpadding="1" cellspacing="1">
    <thead><tr><th colspan="2"><?php echo TZ_PAYPAL_PACKAGE_C; ?></th></tr></thead>
    <tbody>
    <tr>
        <td class="pic">
            <img src="img/bezahlung/paypal.jpg" style="width:99px;height:99px;" alt="<?php echo PACKAGE_C; ?>">
            <div>Gold: <?= $gold ?><br>Cost: <?= $price ?> <?= $currency ?><br><?php echo TZ_WAIT_INSTANT; ?></div>
        </td>
        <td class="desc">
            <?php echo TZ_PAY_SECURELY_WITH_PAYPAL; ?><br><br>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="<?= $paypal ?>">
                <input type="hidden" name="item_name" value="<?= SERVER_NAME ?> Package C">
                <input type="hidden" name="item_number" value="C-<?= $gold ?>">
                <input type="hidden" name="amount" value="<?= $price ?>">
                <input type="hidden" name="currency_code" value="<?= $currency ?>">
                
                <!-- IDENTIFICARE -->
                <input type="hidden" name="custom" value="<?= $uid ?>|112|<?= $gold ?>">
                <input type="hidden" name="invoice" value="TX-<?= $uid ?>-<?= time() ?>">
                <input type="hidden" name="notify_url" value="<?= $base ?>/paypal_ipn.php">
                <input type="hidden" name="return" value="<?= $base ?>/plus.php?id=1&paid=1">
                <input type="hidden" name="cancel_return" value="<?= $base ?>/plus.php?id=1">
                
                <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_buynow_107x26.png" name="submit" alt="<?php echo BUY_NOW; ?>">
            </form>
        </td>
    </tr>
    </tbody>
</table>
</div></div>