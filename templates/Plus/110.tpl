<?php
include("Templates/Plus/pmenu.tpl");
$name = $session->uid;
//echo"<br>Benutzer-Id : $name<br>";
//$free = $session->uid;
//echo"<br>Veriable free : ?account=56387&project=trvnx&theme=default&gfx=x-surfer&bgcolor=ffffff&title=travianix-30+Gold&amount=150&free=$free<br>";
?>
<!-- Hinweis -->
<!--
<table class="rate_details lang_ltr lang_de" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<th colspan="2">1. Call2Pay</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="pic"><img src="img/bezahlung/call2pay.png" style="99px; height:99px;" alt="Paket A" />

			<div>Gold : 60<br />Cost : 1,99 Euro<br />Wait: Instant</div>
			</td>
			<td class="desc">
							Pay by Phone               <br />
                
            				<a href="#"
					onclick="window.open('http://billing.micropayment.ch/call2pay/event/?account=56387&project=trvnx&theme=default&gfx=x-surfer&bgcolor=ffffff&title=travianix-60+Gold&amount=199','nsrpay','scrollbars=yes,status=yes,resizable=yes,toolbar=yes,width=800,height=600');return false;">
				<img src="img/bezahlung/call2pay1.png" style="width:126px; height:38px;" alt="call2pay" /></a>
						
			<br />
                More Info about micropayment can be found here:                                <a href="https://www.micropayment.ch/" target="_blank"><br />More Info</a>
                            </td>

		</tr>
	</tbody>
</table>
<table class="rate_details lang_ltr lang_de" cellpadding="1" cellspacing="1">
	<thead>

		<tr>
			<th colspan="2">2. Handy2Pay</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="pic"><img src="img/bezahlung/handy2pay.png" style="99px; height:99px;" alt="Paket A" />

			<div>Gold : 60<br />Cost : 1,99 Euro<br />Wait: Instant</div>
			</td>
			<td class="desc">
							Pay with SMS                <br />
                
            				<a href="#"
					onclick="window.open('http://billing.micropayment.ch/handypay/event/?account=56387&project=trvnx&theme=default&gfx=x-surfer&bgcolor=ffffff&title=travianix-60+Gold&amount=199&paytext=TravianiX+60+Gold&smstext=travianix60gold','nsrpay','scrollbars=yes,status=yes,resizable=yes,toolbar=yes,width=800,height=600');return false;">
				<img src="img/bezahlung/handy2pay2.png" style="width:126px; height:38px;" alt="handy2pay" /></a>
						
			<br />
				More Info about micropayment can be found here:                                <a href="https://www.micropayment.ch/" target="_blank"><br />More Info</a>
                            </td>

		</tr>
	</tbody>
</table>
<table class="rate_details lang_ltr lang_de" cellpadding="1" cellspacing="1">
	<thead>

		<tr>
			<th colspan="2">3. Ebank2Pay</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="pic"><img src="img/bezahlung/ebank2pay.png" style="99px; height:99px;" alt="Paket A" />

			<div>Gold : 60<br />Cost : 1,99 Euro<br />Wait: Sofort</div>
			</td>
			<td class="desc">
							Pay by online banktransfer                <br />
                
            				<a href="#"
					onclick="window.open('http://billing.micropayment.ch/ebank2pay/event/?account=56387&project=trvnx&theme=default&gfx=x-surfer&bgcolor=ffffff&title=travianix+60+Gold&amount=199&currency=EUR&paytext=travianix+60+Gold','nsrpay','scrollbars=yes,status=yes,resizable=yes,toolbar=yes,width=800,height=600');return false;">
				<img src="img/bezahlung/ebank2pay2.png" style="width:181px; height:38px;" alt="ebank2pay" /></a>
						
			<br />
                More Info about micropayment can be found here:                                <a href="https://www.micropayment.ch/" target="_blank"><br />More Info</a>
                                            </td>

		</tr>
	</tbody>
</table>
-->
<table class="rate_details lang_ltr lang_de" cellpadding="1" cellspacing="1">
	<thead>

		<tr>
			<th colspan="2">Paypal</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="pic">
    			<img src="img/bezahlung/paypal.jpg" style="99px; height:99px;" alt="Package A" />
    
    			<div>
        			Gold : <?php echo (defined('PLUS_PACKAGE_A_GOLD') ? PLUS_PACKAGE_A_GOLD : 60); ?>
        			<br />
        			Cost : <?php echo (defined('PLUS_PACKAGE_A_PRICE') ? PLUS_PACKAGE_A_PRICE : '1,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?>
        			<br />
        			Wait: 24 hours
    			</div>
    			</td>
    			<td class="desc">
    			    Initiate Payment by Paypal
    			    <br /><br />
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    
                      <!-- Identify your business so that you can collect the payments. -->
                      <input type="hidden" name="business" value="<?php echo (defined('PAYPAL_EMAIL') ? PAYPAL_EMAIL : 'novgorodschi@icloud.com'); ?>">
                    
                      <!-- Specify a Buy Now button. -->
                      <input type="hidden" name="cmd" value="_xclick">
                    
                      <!-- Specify details about the item that buyers will purchase. -->
                      <input type="hidden" name="item_name" value="<?php echo SERVER_NAME . ' Package A Gold Pack'; ?>">
                      <input type="hidden" name="amount" value="<?php echo (defined('PLUS_PACKAGE_A_PRICE') ? str_replace(",", ".", PLUS_PACKAGE_A_PRICE) : '1,99'); ?>">
                      <input type="hidden" name="currency_code" value="<?php echo (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?>">
                    
                      <!-- Display the payment button. -->
                      <input type="image" name="submit" border="0"
                      src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_buynow_107x26.png"
                      alt="Buy Now">
                      <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
        
                    </form>
    
                <br />
    			More Info about PayPal can be found here: <br />
    			<a href="#" onclick="window.open('https://www.paypal.com/en/cgi-bin/webscr?cmd=xpt/cps/popup/OLCWhatIsPayPal-outside','external','scrollbars=yes,status=yes,resizable=yes,toolbar=yes,width=800,height=600');return false;">More Info</a>
    			<br />
    		</td>
		</tr>
	</tbody>
</table>
<br /><br /><br /><br /><br /><br />
</div>

</div>

