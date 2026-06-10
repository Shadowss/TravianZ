<h1><img class="unit u19" src="img/x.gif" alt="<?php echo U19; ?>" title="<?php echo U19; ?>" /> <?php echo U19; ?> <span class="tribe">(<?php echo TRIBE2; ?>)</span></h1>

<table id="troop_info" cellpadding="1" cellspacing="1">
<thead><tr>
	<th><img class="att_all" src="img/x.gif" alt="<?php echo MANUAL_ATTACK_VALUE; ?>" title="<?php echo MANUAL_ATTACK_VALUE; ?>" /></th>
	<th><img class="def_i" src="img/x.gif" alt="<?php echo MANUAL_DEF_INFANTRY; ?>" title="<?php echo MANUAL_DEF_INFANTRY; ?>" /></th>
	<th><img class="def_c" src="img/x.gif" alt="<?php echo MANUAL_DEF_CAVALRY; ?>" title="<?php echo MANUAL_DEF_CAVALRY; ?>" /></th>
    <th><img class="r1" src="img/x.gif" alt="<?php echo LUMBER; ?>" title="<?php echo LUMBER; ?>" /></th>
    <th><img class="r2" src="img/x.gif" alt="<?php echo CLAY; ?>" title="<?php echo CLAY; ?>" /></th>
    <th><img class="r3" src="img/x.gif" alt="<?php echo IRON; ?>" title="<?php echo IRON; ?>" /></th>
    <th><img class="r4" src="img/x.gif" alt="<?php echo CROP; ?>" title="<?php echo CROP; ?>" /></th>
</tr></thead>
<tbody><tr>
	<td>40</td>
	<td>60</td>
	<td>40</td>

	<td>35500</td>
	<td>26600</td>
	<td>25000</td>
	<td>27200</td>
</tr></tbody>
</table>

<table id="troop_details" cellpadding="1" cellspacing="1">
<tbody><tr>
	<th><?php echo MANUAL_VELOCITY; ?></th>
	<td><b>4</b> <?php echo MANUAL_FIELDS_HOUR; ?></td>
</tr>
<tr>
	<th><?php echo MANUAL_CAN_CARRY; ?></th>
	<td><b>0</b> <?php echo RESOURCES; ?></td>
</tr>
<tr>
	<th><?php echo UPKEEP; ?></th>
	<td><img class="r5" src="img/x.gif" alt="<?php echo CROP_CONSUMPTION; ?>" title="<?php echo CROP_CONSUMPTION; ?>" /> 4</td>
</tr>
<tr>
	<th><?php echo MANUAL_TRAINING_DURATION; ?></th>
	<td><img class="clock" src="img/x.gif" alt="<?php echo DURATION; ?>" title="<?php echo DURATION; ?>" /> 19:35:00</td>
</tr></tbody>
</table>

<img id="big_unit" class="big_u19" src="img/x.gif" alt="<?php echo U19; ?>" title="<?php echo U19; ?>" /><div id="t_desc"><?php echo MANUAL_UDESC_19; ?></div>
<div id="prereqs"><b><?php echo PREREQUISITES; ?></b><br /><a href="manual.php?typ=4&amp;gid=16"><?php echo RALLYPOINT; ?></a> <?php echo LEVEL; ?> 5, <a href="manual.php?typ=4&amp;gid=22"><?php echo ACADEMY; ?></a> <?php echo LEVEL; ?> 20</div>
<map id="nav" name="nav">
    <area href="manual.php?typ=1&amp;s=18" title="<?php echo BACK; ?>" coords="0,0,45,18" shape="rect" alt="" />
    <area href="manual.php?s=1" title="<?php echo OVERVIEW; ?>" coords="46,0,70,18" shape="rect" alt="" />
    <area href="manual.php?typ=1&amp;s=20" title="<?php echo FORWARD; ?>" coords="71,0,116,18" shape="rect" alt="" />
</map>
<img usemap="#nav" src="img/x.gif" class="navi" alt="" />