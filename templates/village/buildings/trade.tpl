<table class="traders" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td>
				<a href="spieler.php?uid={$trade.villageOwner}">{$trade.villageOwnerName}</a>
			</td>
			<td>
				<a href="karte.php?d={$trade.vref}c={$trade.mapCheck}">{$transportText}
					{$trade.villageName}
				</a>
			</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>{$smarty.const.ARRIVAL_IN}</th>
			<td>
				<div class="in">
					<span class="timer">{$trade.time}</span>
					{$smarty.const.SHORT_HOURS}
				</div>
				<div class="at">{$smarty.const.ON} {$trade.timeString[0]} {$smarty.const.AT} {$trade.timeString[1]}</div>
			</td>
		</tr>
	</tbody>
	<tr class="res">
		<th>{$smarty.const.RESOURCES}</th>
		<td colspan="2">
			<span class="f10">
				<img class="r1" src="assets/img/x.gif" alt="{$smarty.const.LUMBER}" title="{$smarty.const.LUMBER}" />
				<span {if $returning}class="noresources"{/if}>{$trade.resources[0]}</span>
				| <img class="r2" src="assets/img/x.gif" alt="{$smarty.const.CLAY}" title="{$smarty.const.CLAY}" />
				<span {if $returning}class="noresources"{/if}>{$trade.resources[1]}</span>
				| <img class="r3" src="assets/img/x.gif" alt="{$smarty.const.IRON}" title="{$smarty.const.IRON}" />
				<span {if $returning}class="noresources"{/if}>{$trade.resources[2]}</span>
				| <img class="r4" src="assets/img/x.gif" alt="{$smarty.const.CROP}" title="{$smarty.const.CROP}" />
				<span {if $returning}class="noresources"{/if}>{$trade.resources[3]}</span>
				{if $trade.repetitions > 1}
					<span style="float: right">x{$trade.repetitions}</span>
				{/if}
			</span>
		</td>
	</tr>
	</tbody>
</table>