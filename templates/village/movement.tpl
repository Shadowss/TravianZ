{if !empty($villageMovements)}

<table id="movements" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<th colspan="3">{$smarty.const.TROOP_MOVEMENTS}</th>
		</tr>
	</thead>
	<tbody>

{* Units coming back and enforcements for this village*}

{if !empty($villageMovements['reinforcements']['village']['to'])}
		<tr>
			<td class="typ">
				<a href="build.php?id=39">
					<img src="assets/img/x.gif" class="def1" alt="{$smarty.const.ARRIVING_REINF_TROOPS}" title="{$smarty.const.ARRIVING_REINF_TROOPS}" />
				</a>
				<span class="d1">&raquo;</span>
			</td>
			<td>
				<div class="mov">
				<span class="d1">{$villageMovements['reinforcements']['village']['to']['amount']}&nbsp;{$smarty.const.ARRIVING_REINF_TROOPS_SHORT}</span>
			</div>
				<div class="dur_r">
					in&nbsp;<span class="timer">{$villageMovements['reinforcements']['village']['to']['timetoarrive']}</span>&nbsp;{$smarty.const.HOURS}
				</div>
			</td>
		</tr>
{/if}

{* Attacks to this village *}

{if !empty($villageMovements['attacks']['village']['to'])}
	<tr>
		<td class="typ">
			<a href="build.php?id=39">
				<img src="assets/img/x.gif" class="att1" alt="{$smarty.const.UNDERATTACK}" title="{$smarty.const.UNDERATTACK}" />
			</a>
			<span class="a1">&raquo;</span>
		</td>
		<td>
			<div class="mov">
				<span class="a1">{$villageMovements['attacks']['village']['to']['amount']}&nbsp;{$smarty.const.ATTACK}</span>
			</div>
			<div class="dur_r">
				in&nbsp;<span class="timer">{$villageMovements['attacks']['village']['to']['timetoarrive']}</span>&nbsp;{$smarty.const.HOURS}
			</div>
		</td>
	</tr>
{/if}

{* Attacks from this villages *}

{if !empty($villageMovements['attacks']['village']['from'])}
	<tr>
		<td class="typ">
			<a href="build.php?id=39">
				<img src="assets/img/x.gif" class="att2" alt="{$smarty.const.OWN_ATTACKING_TROOPS}" title="{$smarty.const.OWN_ATTACKING_TROOPS}" />
			</a>
			<span class="a2">&raquo;</span>
		</td>
		<td>
			<div class="mov">
				<span class="a2">{$villageMovements['attacks']['village']['from']['amount']}&nbsp;{$smarty.const.ATTACK}</span>
			</div>
			<div class="dur_r">
				in&nbsp;<span class="timer">{$villageMovements['attacks']['village']['from']['timetoarrive']}</span>&nbsp;{$smarty.const.HOURS}
			</div>
		</td>
	</tr>
{/if}

{* Enforcements for other villages *}

{if !empty($villageMovements['reinforcements']['village']['from'])}
	<tr>
		<td class="typ">
			<a href="build.php?id=39">
				<img src="assets/img/x.gif" class="def2" alt="{$smarty.const.OWN_REINFORCING_TROOPS}" title="{$smarty.const.OWN_REINFORCING_TROOPS}" />
			</a>
			<span class="d2">&raquo;</span>
		</td>
		<td>
			<div class="mov">
				<span class="d2">{$villageMovements['reinforcements']['village']['from']['amount']}&nbsp;{$smarty.const.ARRIVING_REINF_TROOPS_SHORT}</span>
			</div>
			<div class="dur_r">
				in&nbsp;<span class="timer">{$villageMovements['reinforcements']['village']['from']['timetoarrive']}</span>&nbsp;{$smarty.const.HOURS}
			</div>
		</td>
	</tr>
{/if}

{* Settling a new village *}

{if !empty($villageMovements['settling']['village']['from'])}
	<tr>
		<td class="typ">
			<a href="build.php?id=39">
				<img src="assets/img/x.gif" class="unit u{$tribe}0" alt="{$smarty.const.FOUNDNEWVILLAGE}" title="{$smarty.const.FOUNDNEWVILLAGE}" />
			</a>
			<span class="a5">&raquo;</span>
		</td>
		<td>
			<div class="mov">
				<span class="a5">{$villageMovements['settling']['village']['from']['amount']}&nbsp;{$smarty.const.NEWVILLAGE}</span>
			</div>
			<div class="dur_r">
				in&nbsp;<span class="timer">{$villageMovements['settling']['village']['from']['timetoarrive']}</span>&nbsp;{$smarty.const.HOURS}
			</div>
		</td>
	</tr>
{/if}

{* Attacks on this village oasis *}

{if !empty($villageMovements['attacks']['oasis']['to'])}
	<tr>
		<td class="typ">
			<a href="build.php?id=39">
				<img src="assets/img/x.gif" class="att3" alt="{$smarty.const.OASISATTACK}" title="{$smarty.const.OASISATTACK}" />
			</a>
			<span class="a3">&raquo;</span>
		</td>
		<td>
			<div class="mov">
				<span class="a3">{$villageMovements['attacks']['oasis']['to']['amount']}&nbsp;{$smarty.const.OASISATTACKS}</span>
			</div>
			<div class="dur_r">in&nbsp;<span class="timer">{$villageMovements['attacks']['oasis']['to']['timetoarrive']}</span>&nbsp;{$smarty.const.HOURS}</div>
		</td>
	</tr>
{/if}

{* Enforcements for this village oasis *}

{if !empty($villageMovements['reinforcements']['oasis']['to'])}
	<tr>
		<td class="typ">
			<a href="build.php?id=39">
				<img src="assets/img/x.gif" class="def3" alt="{$smarty.const.OASISREINFORCEMENT}" title="{$smarty.const.OASISREINFORCEMENT}" />
			</a>
			<span class="d3">&raquo;</span>
		</td>
		<td>
			<div class="mov">
				<span class="d3">{$villageMovements['reinforcements']['oasis']['to']['amount']}&nbsp;{$smarty.const.OASISREINFORCEMENTS}</span>
			</div>
			<div class="dur_r">in&nbsp;<span class="timer">{$villageMovements['reinforcements']['oasis']['to']['timetoarrive']}</span>&nbsp;{$smarty.const.HOURS}</div>
		</td>
	</tr>
{/if}
</tbody>
</table>
{/if}