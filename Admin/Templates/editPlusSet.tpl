<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editPlusSet.tpl                                             ##
##  Developed by:  martinambrus                                                ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2017. All rights reserved.                ##
##                                                                             ##
#################################################################################
if (!isset($_SESSION)) {
 session_start();
}
if($_SESSION['access'] < 9) die(ACCESS_DENIED_ADMIN);
?>
<script LANGUAGE="JavaScript">
function refresh(tz) {
	document.getElementById('tz').innerHTML=tz;
}
</script>
<h2><center><b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b> Configuration</center></h2>
	<form action="../GameEngine/Admin/Mods/editPlusSet.php" method="POST">
		<input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">
			<br />
			<table id="profile" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th colspan="2">Edit <b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b> Setting</th>
					</tr>
				</thead>
				<tbody>
    				<tr>
    					<td width="50%">
    					   PayPal E-Mail
    					   <br /><span style="font-size: smaller">(must be Business or Premier account)</span>
    					</td>
    					<td width="50%">
    					   <input class="fm" name="paypal-email" value="<?php echo (defined('PAYPAL_EMAIL') ? PAYPAL_EMAIL : '@'); ?>" style="width: 70%;">
    					</td>
    				</tr>
    				<tr>
                        <td width="50%">
                           Payment Currency
                        </td>
                        <td width="50%">
                           <input class="fm" name="paypal-currency" value="<?php echo (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?>" style="width: 70%;">
                        </td>
                    </tr>

                    <tr>
                        <td width="50%">
                           Package "A" Amount of Gold
                        </td>
                        <td width="50%">
                           <input class="fm" name="plus-a-gold" value="<?php echo (defined('PLUS_PACKAGE_A_GOLD') ? PLUS_PACKAGE_A_GOLD : 60); ?>" style="width: 70%;">
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                           Package "A" Price
                        </td>
                        <td width="50%">
                           <input class="fm" name="plus-a-price" value="<?php echo (defined('PLUS_PACKAGE_A_PRICE') ? PLUS_PACKAGE_A_PRICE : '1,99'); ?>" style="width: 70%;">
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="50%">
                           Package "B" Amount of Gold
                        </td>
                        <td width="50%">
                           <input class="fm" name="plus-b-gold" value="<?php echo (defined('PLUS_PACKAGE_B_GOLD') ? PLUS_PACKAGE_B_GOLD : 120); ?>" style="width: 70%;">
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                           Package "B" Price
                        </td>
                        <td width="50%">
                           <input class="fm" name="plus-b-price" value="<?php echo (defined('PLUS_PACKAGE_B_PRICE') ? PLUS_PACKAGE_B_PRICE : '4,99'); ?>" style="width: 70%;">
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="50%">
                           Package "C" Amount of Gold
                        </td>
                        <td width="50%">
                           <input class="fm" name="plus-c-gold" value="<?php echo (defined('PLUS_PACKAGE_C_GOLD') ? PLUS_PACKAGE_C_GOLD : 360); ?>" style="width: 70%;">
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                           Package "C" Price
                        </td>
                        <td width="50%">
                           <input class="fm" name="plus-c-price" value="<?php echo (defined('PLUS_PACKAGE_C_PRICE') ? PLUS_PACKAGE_C_PRICE : '9,99'); ?>" style="width: 70%;">
                        </td>
                    </tr>
                    
                    <tr>
                        <td width="50%">
                           Package "D" Amount of Gold
                        </td>
                        <td width="50%">
                           <input class="fm" name="plus-d-gold" value="<?php echo (defined('PLUS_PACKAGE_D_GOLD') ? PLUS_PACKAGE_D_GOLD : 1000); ?>" style="width: 70%;">
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                           Package "D" Price
                        </td>
                        <td width="50%">
                           <input class="fm" name="plus-d-price" value="<?php echo (defined('PLUS_PACKAGE_D_PRICE') ? PLUS_PACKAGE_D_PRICE : '19,99'); ?>" style="width: 70%;">
                        </td>
                    </tr>

                    <tr>
                        <td width="50%">
                           Package "E" Amount of Gold
                        </td>
                        <td width="50%">
                           <input class="fm" name="plus-e-gold" value="<?php echo (defined('PLUS_PACKAGE_E_GOLD') ? PLUS_PACKAGE_E_GOLD : 2000); ?>" style="width: 70%;">
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                           Package "E" Price
                        </td>
                        <td width="50%">
                           <input class="fm" name="plus-e-price" value="<?php echo (defined('PLUS_PACKAGE_E_PRICE') ? PLUS_PACKAGE_E_PRICE : '49,99'); ?>" style="width: 70%;">
                        </td>
                    </tr>

					<tr>
						<td><b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b> account duration</td>
						<td>
							<select name="plus_time">
								<option value="(3600*12)" <?php if(PLUS_TIME==43200) echo "selected";?>>12 hours</option>
								<option value="(3600*24)" <?php if(PLUS_TIME==86400) echo "selected";?>>1 day</option>
								<option value="(3600*24*2)" <?php if(PLUS_TIME==172800) echo "selected";?>>2 days</option>
								<option value="(3600*24*3)" <?php if(PLUS_TIME==259200) echo "selected";?>>3 days</option>
								<option value="(3600*24*4)" <?php if(PLUS_TIME==345600) echo "selected";?>>4 days</option>
								<option value="(3600*24*5)" <?php if(PLUS_TIME==432000) echo "selected";?>>5 days</option>
								<option value="(3600*24*6)" <?php if(PLUS_TIME==518400) echo "selected";?>>6 days</option>
								<option value="(3600*24*7)" <?php if(PLUS_TIME==604800) echo "selected";?>>7 days</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>+25% production duration</td>
						<td>
							<select name="plus_production">
								<option value="(3600*12)" <?php if(PLUS_TIME==43200) echo "selected";?>>12 hours</option>
								<option value="(3600*24)" <?php if(PLUS_TIME==86400) echo "selected";?>>1 day</option>
								<option value="(3600*24*2)" <?php if(PLUS_TIME==172800) echo "selected";?>>2 days</option>
								<option value="(3600*24*3)" <?php if(PLUS_TIME==259200) echo "selected";?>>3 days</option>
								<option value="(3600*24*4)" <?php if(PLUS_TIME==345600) echo "selected";?>>4 days</option>
								<option value="(3600*24*5)" <?php if(PLUS_TIME==432000) echo "selected";?>>5 days</option>
								<option value="(3600*24*6)" <?php if(PLUS_TIME==518400) echo "selected";?>>6 days</option>
								<option value="(3600*24*7)" <?php if(PLUS_TIME==604800) echo "selected";?>>7 days</option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			<br />
			<table width="100%">
				<tr><td align="left"><a href="../Admin/admin.php?p=config"><< back</a></td>
					<td align="right"><input type="image" border="0" src="../img/admin/b/ok1.gif"></td>
				</tr>
			</table>
		</form>
