<h1><img class="unit u30" src="img/x.gif" alt="<?php echo U10; ?>" title="<?php echo U10; ?>" /> <?php echo U10; ?> <span class="tribe">(<?php echo TRIBE3; ?>)</span></h1>

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
	<td>—</td>
	<td>80</td>
	<td>80</td>

	<td>5500</td>
	<td>7000</td>
	<td>5300</td>
	<td>4900</td>
</tr></tbody>
</table>

<table id="troop_details" cellpadding="1" cellspacing="1">
<tbody><tr>
	<th><?php echo MANUAL_VELOCITY; ?></th>
	<td><b>5</b> <?php echo MANUAL_FIELDS_HOUR; ?></td>
</tr>
<tr>
	<th><?php echo MANUAL_CAN_CARRY; ?></th>
	<td><b>3000</b> <?php echo RESOURCES; ?></td>
</tr>
<tr>
	<th><?php echo UPKEEP; ?></th>
	<td><img class="r5" src="img/x.gif" alt="<?php echo CROP_CONSUMPTION; ?>" title="<?php echo CROP_CONSUMPTION; ?>" /> 1</td>
</tr>
<tr>
	<th><?php echo MANUAL_TRAINING_DURATION; ?></th>
	<td><img class="clock" src="img/x.gif" alt="<?php echo DURATION; ?>" title="<?php echo DURATION; ?>" /> 6:18:20</td>
</tr></tbody>
</table>

<img id="big_unit" class="big_u30" src="img/x.gif" alt="<?php echo U10; ?>" title="<?php echo U10; ?>" /><div id="t_desc"><?php echo MANUAL_UDESC_10; ?></div>
<div id="prereqs"><b><?php echo PREREQUISITES; ?></b><br /><a href="manual.php?typ=4&amp;gid=26"><?php echo PALACE; ?></a> <?php echo LEVEL; ?> 10 or <a href="manual.php?typ=4&amp;gid=25"><?php echo RESIDENCE; ?></a> <?php echo LEVEL; ?> 10</div>
<map id="nav" name="nav">
    <area href="manual.php?typ=1&amp;s=29" title="<?php echo BACK; ?>" coords="0,0,45,18" shape="rect" alt="" />
    <area href="manual.php?s=1" title="<?php echo OVERVIEW; ?>" coords="46,0,70,18" shape="rect" alt="" />
    <area href="manual.php?s=3&amp;typ=2" title="<?php echo FORWARD; ?>" coords="71,0,116,18" shape="rect" alt="" />
</map>
<img usemap="#nav" src="img/x.gif" class="navi" alt="" />