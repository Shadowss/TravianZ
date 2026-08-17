<?php

#################################################################################
##                -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-               ##
## --------------------------------------------------------------------------- ##
##  Filename       : 1.tpl                                                     ##
##  Type           : Plus Overview - Landing Page                              ##
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

// TravianZ - DO NOT REMOVE COPYRIGHT NOTICE!
include("Templates/Plus/pmenu.tpl");

$packages = [
    ['id' => 110,  'key' => 'A', 'img' => 'Travian_paket_a.jpg', 'gold' => defined('PLUS_PACKAGE_A_GOLD') ? PLUS_PACKAGE_A_GOLD : 60,   'price' => defined('PLUS_PACKAGE_A_PRICE') ? PLUS_PACKAGE_A_PRICE : '1,99'],
    ['id' => 111,  'key' => 'B', 'img' => 'Travian_paket_b.jpg', 'gold' => defined('PLUS_PACKAGE_B_GOLD') ? PLUS_PACKAGE_B_GOLD : 120,  'price' => defined('PLUS_PACKAGE_B_PRICE') ? PLUS_PACKAGE_B_PRICE : '4,99'],
    ['id' => 112,  'key' => 'C', 'img' => 'Travian_paket_c.jpg', 'gold' => defined('PLUS_PACKAGE_C_GOLD') ? PLUS_PACKAGE_C_GOLD : 360,  'price' => defined('PLUS_PACKAGE_C_PRICE') ? PLUS_PACKAGE_C_PRICE : '9,99'],
    ['id' => 113,  'key' => 'D', 'img' => 'Travian_paket_d.jpg', 'gold' => defined('PLUS_PACKAGE_D_GOLD') ? PLUS_PACKAGE_D_GOLD : 1000, 'price' => defined('PLUS_PACKAGE_D_PRICE') ? PLUS_PACKAGE_D_PRICE : '19,99'],
    ['id' => 3110, 'key' => 'E', 'img' => 'Travian_paket_e.jpg', 'gold' => defined('PLUS_PACKAGE_E_GOLD') ? PLUS_PACKAGE_E_GOLD : 2000, 'price' => defined('PLUS_PACKAGE_E_PRICE') ? PLUS_PACKAGE_E_PRICE : '49,99'],
];

$currency = defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR';
$payEmail = trim((string) (defined('PAYPAL_EMAIL') ? PAYPAL_EMAIL : ''));
$paymentsEnabled = $payEmail !== '';
?>
<table class="rate_details lang_ltr lang_de" cellpadding="1" cellspacing="1">
	<thead><tr><th colspan="2"><?php echo GOLD_SHOP; ?></th></tr></thead>
	<tbody>
		<tr>
			<td class="pic"><img src="img/bezahlung/Travian_verdienen.jpg" style="width:99px;height:99px;" alt="<?php echo GOLD_SHOP; ?>" /><div><?php echo GOLD_SHOP; ?></div></td>
			<td class="desc">
				<?php if ($paymentsEnabled): ?>
					<?php echo TZ_ML_GOLD_RESERVE; ?> <a href="mailto:<?= htmlspecialchars($payEmail, ENT_QUOTES, 'UTF-8') ?>"><?php echo TZ_PAYMENT_ACCOUNT; ?></a>.<br><br>
				<?php else: ?>
					<strong><?php echo TZ_PAYMENTS_DISABLED; ?></strong><br><br>
				<?php endif; ?>
				<b><?php echo TZ_USERNAME; ?><br><?php echo PAYMENT_METHOD; ?><br><?php echo TZ_ORDERED_PACKAGE; ?><br><?php echo TZ_DATE_AND_TIME; ?></b><br><br>
				<?php echo TZ_WE_STRIVE_TO_ENSURE_SPEEDY_PROCESS; ?>
			</td>
		</tr>
	</tbody>
</table>

<div id="products">
<?php foreach($packages as $p): ?>
    <table class="product lang_ltr lang_de" cellpadding="1" cellspacing="1">
        <thead><tr><th>Package <?= $p['key'] ?></th></tr></thead>
        <tbody>
            <tr><td class="pic"><a href="plus1.php?id=<?= $p['id'] ?>"><img src="img/bezahlung/<?= $p['img'] ?>" style="width:99px;height:99px;" alt="Package <?= $p['key'] ?>" /></a></td></tr>
            <tr><td><?= $p['gold'] ?>&nbsp;Gold</td></tr>
            <tr><td><?= $p['price'] ?>&nbsp;<?= $currency ?></td></tr>
			<tr><td><?php if ($paymentsEnabled): ?><a href="plus1.php?id=<?= $p['id'] ?>" onclick="if(this.dataset.c) return false; this.dataset.c=1;">&raquo; <?php echo BUY_NOW; ?></a><?php else: ?><span><?php echo TZ_PAYMENTS_DISABLED; ?></span><?php endif; ?></td></tr>
        </tbody>
    </table>
<?php endforeach; ?>
<div class="clear"></div>
<div style="padding:10px;font-style:italic;font-size:10px;color:#F00;"><b><?php echo TZ_NONE_OF_THE_PACKAGES_ARE_REFUNDABL; ?></b></div>
</div>
</div>
