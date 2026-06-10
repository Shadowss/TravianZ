<h1><img class="unit u21" src="img/x.gif" alt="<?php echo U21; ?>" title="<?php echo U21; ?>" /> <?php echo U21; ?> <span class="tribe">(<?php echo TRIBE3; ?>)</span></h1>

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
	<td>15</td>
	<td>40</td>
	<td>50</td>

	<td>100</td>
	<td>130</td>
	<td>55</td>
	<td>30</td>
</tr></tbody>
</table>

<table id="troop_details" cellpadding="1" cellspacing="1">
<tbody><tr>
	<th><?php echo MANUAL_VELOCITY; ?></th>
	<td><b>7</b> <?php echo MANUAL_FIELDS_HOUR; ?></td>
</tr>
<tr>
	<th><?php echo MANUAL_CAN_CARRY; ?></th>
	<td><b>35</b> <?php echo RESOURCES; ?></td>
</tr>
<tr>
	<th><?php echo UPKEEP; ?></th>
	<td><img class="r5" src="img/x.gif" alt="<?php echo CROP_CONSUMPTION; ?>" title="<?php echo CROP_CONSUMPTION; ?>" /> 1</td>
</tr>
<tr>
	<th><?php echo MANUAL_TRAINING_DURATION; ?></th>
	<td><img class="clock" src="img/x.gif" alt="<?php echo DURATION; ?>" title="<?php echo DURATION; ?>" /> 0:17:20</td>
</tr></tbody>
</table>

<img id="big_unit" class="big_u21" src="img/x.gif" alt="<?php echo U21; ?>" title="<?php echo U21; ?>" /><div id="t_desc"><?php echo MANUAL_UDESC_21; ?></div>
<div id="prereqs"><b><?php echo PREREQUISITES; ?></b><br /><a href="manual.php?typ=4&amp;gid=19"><?php echo BARRACKS; ?></a> <?php echo LEVEL; ?> 1</div>
<map id="nav" name="nav">
    <area href="manual.php?typ=2&amp;s=3" title="<?php echo BACK; ?>" coords="0,0,45,18" shape="rect" alt="" />
    <area href="manual.php?s=1" title="<?php echo OVERVIEW; ?>" coords="46,0,70,18" shape="rect" alt="" />
    <area href="manual.php?typ=1&amp;s=22" title="<?php echo FORWARD; ?>" coords="71,0,116,18" shape="rect" alt="" />
</map>
<img usemap="#nav" src="img/x.gif" class="navi" alt="" />