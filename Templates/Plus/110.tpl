<?php
include("Templates/Plus/pmenu.tpl");

$pkg = [
    'gold' => defined('PLUS_PACKAGE_A_GOLD') ? PLUS_PACKAGE_A_GOLD : 60,
    'price' => defined('PLUS_PACKAGE_A_PRICE') ? PLUS_PACKAGE_A_PRICE : '1,99',
];
$price = str_replace(',', '.', $pkg['price']);
$currency = defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR';
$email = defined('PAYPAL_EMAIL') ? PAYPAL_EMAIL : 'novgorodschi@icloud.com';
?>
<table class="rate_details lang_ltr lang_de" cellpadding="1" cellspacing="1">
    <thead><tr><th colspan="2"><?php echo TZ_PAYPAL_PACKAGE_A; ?></th></tr></thead>
    <tbody>
    <tr>
        <td class="pic">
            <img src="img/bezahlung/paypal.jpg" style="width:99px;height:99px;" alt="<?php echo PACKAGE_A; ?>">
            <div>Gold: <?= $pkg['gold'] ?><br>Cost: <?= $pkg['price'] ?> <?= $currency ?><br><?php echo TZ_WAIT_24H; ?></div>
        </td>
        <td class="desc">
            <?php echo TZ_INITIATE_PAYMENT_BY_PAYPAL; ?><br><br>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                <input type="hidden" name="business" value="<?= $email ?>">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="item_name" value="<?= SERVER_NAME ?> Package A">
                <input type="hidden" name="amount" value="<?= $price ?>">
                <input type="hidden" name="currency_code" value="<?= $currency ?>">
                <!-- CELE MAI IMPORTANTE – identificare -->
                <input type="hidden" name="custom" value="<?= $session->uid ?>|110|<?= time() ?>">
                <input type="hidden" name="invoice" value="TX-<?= $session->uid ?>-110-<?= time() ?>">
                <input type="hidden" name="notify_url" value="<?= HOMEPAGE ?>paypal_ipn.php">
                <input type="hidden" name="return" value="<?= HOMEPAGE ?>plus.php?id=1&paid=1">
                <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_buynow_107x26.png" name="submit" alt="<?php echo BUY_NOW; ?>">
            </form>
            <br><?php echo TZ_MORE_INFO; ?> <a href="https://www.paypal.com" target="_blank"><?php echo TZ_PAYPAL; ?></a>
        </td>
    </tr>
    </tbody>
</table>
</div>
</div>