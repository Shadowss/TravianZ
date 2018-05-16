<?php 
$start = ($session->tribe - 1) * 10 + 1;
$end = $start + 5;
?>
<table class="transparent" id="raidList" cellspacing="1" cellpadding="1">
<tr>
<?php 
for($i = $start; $i <= $end; $i++){
	if(in_array($i, [4, 14, 23])) continue;
?>
<td>
	<label for="t<?php echo $i - $start + 1; ?>"><img class="unit u<?php echo $i; ?>" title="<?php echo $technology->getUnitName($i) ?>" src="img/x.gif"></label>
</td>
<?php
}
?>
</tr>
<tr>
<?php 
for($i = $start; $i <= $end; $i++){
	if(in_array($i, [4, 14, 23])) continue;
?>
<td>
	<input class="text" id="t<?php echo $i - $start + 1; ?>" type="text" name="t<?php echo $i - $start + 1; ?>" value="<?php echo (${'t'.($i - $start + 1)} > 0) ? ${'t'.($i - $start + 1)} : 0; ?>">
</td>
<?php
}
?>
</tr>
</table>
