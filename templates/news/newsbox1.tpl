<h5><img src="assets/img/en/t2/newsbox1.gif" alt="newsbox 1"></h5>

{assign var=peaceSystem value=[
						{$smarty.const.PEACE_NONE},
						{$smarty.const.PEACE_NORMAL},
						{$smarty.const.PEACE_CHRISTMAS}, 
						{$smarty.const.PEACE_NEW_YEAR}, 
						{$smarty.const.PEACE_EASTER}, 
						{$smarty.const.PEACE_MAINTENANCE}
						]}

<div class="news">
	<table>
		<tr>
			<td align="left"><b>Online Users</b></td>
			<td>: <font color="Red"><b>{$onlineUsers|default:0} users</b></font></td>
		</tr>
		<tr>
			<td><b>Server Speed</b></td>
			<td><b>: <font color="Red">{$smarty.const.SPEED}x</font></b></td>
		</tr>
		<tr>
			<td><b>Troop Speed</b></td>
			<td><b>: <font color="Red">{$smarty.const.INCREASE_SPEED}x</font></b></td>
		</tr>
		<tr>
			<td><b>Evasion Speed</b></td>
			<td><b>: <font color="Red">{$smarty.const.EVASION_SPEED}</font></b></td>
		</tr>
		<tr>
			<td><b>Map Size</b></td>
			<td><b>: <font color="Red">{$smarty.const.WORLD_MAX}x{$smarty.const.WORLD_MAX}</font></b></td>
		</tr>
		<tr>
			<td><b>Village Exp.</b></td>
			<td><b>: <font color="Red">{if $smarty.const.cp} {$smarty.const.EXP_FAST} {else} {$smarty.const.EXP_SLOW} {/if}</font></b></td>
		</tr>
		<tr>
			<td><b>Beginners Prot.</b></td>
			<td><b>: <font color="Red">{$smarty.const.PROTECTION / 3600} hrs</font></b></td>
		</tr>
		<tr>
			<td><b>Medal Interval</b></td>
			<td><b>: <font color="Red">{$smarty.const.MEDALINTERVAL / 86400} {if $smarty.const.MEDALINTERVAL >= 86400} Days {else} Hours {/if}</font></b></td>
		</tr>
		<tr>
			<td><b>Server Start</b></td>
			<td><b>: <font color="Red">{$smarty.const.START_DATE}</font></b></td>
		</tr>
		<tr>
			<td><b>Peace system</b></td>
			<td><b>: <font color="Red">{$peaceSystem[$smarty.const.PEACE]}</font></b></td>
		</tr>
		<tr>
			<td><b>Best Player</b></td>
			<td><b>:  <font color="Red">{$topRanked|default:$smarty.const.NOBODY}</font></b></td>
		</tr>
	</table>
</div>
