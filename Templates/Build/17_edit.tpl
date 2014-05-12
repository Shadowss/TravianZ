<?php $edited_route = $database->getTradeRoute2($_GET['routeid']); ?>
<form action="build.php" method="post">
		<div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents cf">
        <input type="hidden" name="action" value="editRoute">
		<input type="hidden" name="routeid" value="<?php echo $_GET['routeid']; ?>">
			<table cellpadding="1" cellspacing="1" id="npc" class="transparent">
			<thead>
			<tr>
			<th colspan="2"><?php echo EDIT_TRADE_ROUTES;?></th>
			</tr>
			</thead>
				<tbody>
				<tr>
					<th>
						<?php echo RESOURCES;?>:					</th>
					<td>
						<img src="../../<?php echo GP_LOCATE; ?>img/r/1.gif" alt="Lumber" title="<?php echo LUMBER;?>"> <input class="text" type="text" name="r1" id="r1" value="<?php echo $edited_route['wood']; ?>" maxlength="5" tabindex="1" style="width:50px;">  <img src="../../<?php echo GP_LOCATE; ?>img/r/2.gif" alt="Clay" title="<?php echo CLAY;?>"> <input class="text" type="text" name="r2" id="r2" value="<?php echo $edited_route['clay']; ?>" maxlength="5" tabindex="1" style="width:50px;">  <img src="../../<?php echo GP_LOCATE; ?>img/r/3.gif" alt="Iron" title="<?php echo IRON;?>"> <input class="text" type="text" name="r3" id="r3" value="<?php echo $edited_route['iron']; ?>" maxlength="5" tabindex="1" style="width:50px;">  <img src="../../<?php echo GP_LOCATE; ?>img/r/4.gif" alt="Crop" title="<?php echo CROP;?>"> <input class="text" type="text" name="r4" id="r4" value="<?php echo $edited_route['crop']; ?>" maxlength="5" tabindex="1" style="width:50px;">
					</td>
				</tr>
				<tr>
					<th>
						<?php echo START_TIME_TRADE;?>:					</th>
					<td>
						<select name="start"><?php for($i=0;$i<=23;$i++){?><option value="<?php echo $i; ?>" <?php if($i == $edited_route['start']){echo "selected";} ?>><?php if($i > 9){echo $i;}else{echo "0".$i;}?></option><?php } ?></select>
					</td>
				</tr>
				<tr>
					<th>
						<?php echo DELIVERIES;?>:					</th>
					<td>
						<select name="deliveries"><?php for($i=1;$i<=3;$i++){?><option value="<?php echo $i; ?>" <?php if($i == $edited_route['deliveries']){echo "selected";} ?>><?php echo $i; ?></option><?php } ?></select>
					</td>
				</tr>
			</tbody></table>

			</div>
				</div>
<p><input type="image" value="1" name="save" id="btn_save" class="dynamic_img" src="img/x.gif" tabindex="8" alt="OK"/></p>
</form>
</div>