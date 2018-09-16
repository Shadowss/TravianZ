<table class="transparent" id="raidList" cellspacing="1" cellpadding="1">
	<tr>
		{foreach $units as $type => $unit}
		<td>
			<label for="u{$type}">
			<img class="unit u{($tribe - 1) * 10 + $type}" title="{$unit.name}" src="assets/img/x.gif"></label>
		</td>
    	{/foreach}
	</tr>
	<tr>
		{foreach $units as $type => $unit}
		<td>
			<input class="text" id="u{$type}" type="text" name="units[{$type}]" value="{$unit.amount}" maxLength="6">
		</td>
		{/foreach}
	</tr>
</table>
