<form action="build.php" method="post">
		<div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents cf">
        <input type="hidden" name="action" value="addRoute">
			<table cellpadding="1" cellspacing="1" id="npc" class="transparent">
			<thead>
			<tr>
			<th colspan="2"><?php echo CREATE_TRADE_ROUTE;?></th>
			</tr>
			</thead>
				<tbody>
				<tr>
					<th>
						<?php echo TARGET_VILLAGE;?>:					</th>
					<td>
                    
						<select id="tvillage" name="tvillage">
<?php
    if($session->villages[0] == $village->wid){
    	$firstvillage = 2;
    }else{
        $firstvillage = 1;
    }
	for($i=1;$i<=count($session->villages);$i++) {
    if($i == $firstvillage){
    	$select = 'selected="selected"';
    }else{
        $select = '';
    }
	if($session->villages[$i-1] != $village->wid){
		$coor = $database->getCoor($session->villages[$i-1]);
		echo "<option value=\"".$session->villages[$i-1]."\" ".$select.">".$database->getVillageField($session->villages[$i-1],'name')." (".$coor['x']."|".$coor['y'].")</option>";
    }
	}
?>						</select>
					</td>
				</tr>
				<tr>
					<th>
						<?php echo RESOURCES;?>:					</th>
					<td>
						<img src="../../<?php echo GP_LOCATE; ?>img/r/1.gif" alt="Lumber" title="<?php echo LUMBER;?>"> <input class="text" type="text" name="r1" id="r1" value="" maxlength="5" tabindex="1" style="width:50px;">  <img src="../../<?php echo GP_LOCATE; ?>img/r/2.gif" alt="Clay" title="<?php echo CLAY;?>"> <input class="text" type="text" name="r2" id="r2" value="" maxlength="5" tabindex="1" style="width:50px;">  <img src="../../<?php echo GP_LOCATE; ?>img/r/3.gif" alt="Iron" title="<?php echo IRON;?>"> <input class="text" type="text" name="r3" id="r3" value="" maxlength="5" tabindex="1" style="width:50px;">  <img src="../../<?php echo GP_LOCATE; ?>img/r/4.gif" alt="Crop" title="<?php echo CROP;?>"> <input class="text" type="text" name="r4" id="r4" value="" maxlength="5" tabindex="1" style="width:50px;">
					</td>
				</tr>
				<tr>
					<th>
						<?php echo START_TIME_TRADE;?>:					</th>
					<td>
						<select name="start"><option value="0" selected="selected">00</option><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option></select>
					</td>
				</tr>
				<tr>
					<th>
						<?php echo DELIVERIES;?>:					</th>
					<td>
						<select name="deliveries"><option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option></select>
					</td>
				</tr>
				<tr>
					<th>
						<?php echo COSTS;?>:					</th>
					<td>
						<img src="../../<?php echo GP_LOCATE; ?>img/a/gold.gif" alt="Gold" title="<?php echo GOLD;?>"> <b>2</b>
					</td>
				</tr>
				<tr>
					<th>
						<?php echo DURATION;?>:					</th>
					<td>
						<b>7</b> <?php echo DAYS;?>
					</td>
				</tr>
			</tbody></table>

			</div>
				</div>
<p><input type="image" value="1" name="save" id="btn_save" class="dynamic_img" src="img/x.gif" tabindex="8" alt="OK"/></p>
</form>
</div>