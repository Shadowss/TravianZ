{$attackType = [1 => $smarty.const.U14, $smarty.const.REINFORCE, $smarty.const.NORMALATTACK, $smarty.const.RAID]}
<input name="ckey" value="{$ckey}" type="hidden">

{$colspan = 10}
{if $units[11] > 0}
	{$colspan = 11}
{/if}

<table id="short_info" cellpadding="1" cellspacing="1">
	<tbody>
		<tr>
			<th>{$smarty.const.DESTINATION}:</th>
				<td>
					<a href="karte.php?d={$targetVillageVref}&c={$targetVillageMapCheck}">{$targetVillageName} ({$targetVillageCoordinates['x']}|{$targetVillageCoordinates['y']})</a>
				</td>
        </tr>
		<tr>
			<th>{$smarty.const.OWNER}:</th>
            	<td>
                	<a href="spieler.php?uid={$targetOwnerId}">{$targetOwnerUsername}</a>
                </td>
        </tr>
    </tbody>
</table>

<table class="troop_details" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td>{$targetVillageName}</td>
			<td colspan="{$colspan}">{$attackType[$c]} {$smarty.const.TO} {$targetVillageName}</td>
		</tr>

	</thead>

	<tbody class="units">
		<tr>
			<td></td>
			{foreach $villagePresentUnits.unitsArray as $type => $unit}
			<td>
				<img src="assets/img/x.gif" class="unit u{if $type <= 10}{($tribe - 1) * 10 + $type}{else}hero{/if}" title="{if $type <= 10}{$unit.name}{else}{$smarty.const.HERO}{/if}" alt="{if $type <= 10}{$unit.name}{else}{$smarty.const.HERO}{/if}" />
			</td>
			{/foreach}
        </tr>
		<tr>
			<th>{$smarty.const.TROOPS}</th>

			{for $i = 1 to 11}
				{if $i == 11 && $units[$i] == 0}
					{continue}
				{/if}				
			
				{if $units[$i] == 0}
					<td class="none">
						0
					</td>
				{else}
					<td>
						{$units[$i]}
					</td>
				{/if}
			{/for}

 		</tr>

	</tbody>

	{if !empty($catapultTargetBuildings)}
	    <tbody class="cata">
            <tr>
                <th>{$smarty.const.DESTINATION}:</th>
                <td colspan="{$colspan}">
                    {$targetType = 1}
                    {include file=$smarty.const.TEMPLATES_DIR|cat:'sendUnits/catapultTargets.tpl'}

        			{if $units[8] >= 20}
        				{$targetType = 2}
           				{include file=$smarty.const.TEMPLATES_DIR|cat:'sendUnits/catapultTargets.tpl'}
        			{/if}
        		</td>
             </tr>
        </tbody>
	{/if}

    {if $c == 1}
    	<tbody class="options">
			<tr>
				<th>{$smarty.const.OPTIONS}</th>
				<td colspan="{$colspan}">
				<input class="radio" name="spy" value="1" checked="checked" type="radio">{$smarty.const.SCOUT_RES_AND_UNITS}<br>
				<input class="radio" name="spy" value="2"type="radio">{$smarty.const.SCOUT_DEF_AND_UNITS}</td>
			</tr>
		</tbody>
	{/if}
	
	<tbody class="infos">
		<tr>
			<th>{$smarty.const.ARRIVED}</th>
            <td colspan="{$colspan}">
				<div class="in">{$smarty.const.IN} {$arrivalTime[0]}</div>
				<div class="at">
					{$smarty.const.AT} <span id="tp2"> {$arrivalTime[1]}</span>
				<span> {$smarty.const.HOURS}</span>
				</div>
			</td>
		</tr>
	</tbody>
</table>

{if $underBeginnerProtection}
	<span style="color: #DD0000">{$smarty.const.WARNING_UNDER_PROTECTION}</span>
{/if}

<p class="btn">
	<button value="sendUnits" name="action" id="btn_ok" class="trav_buttons"> {$smarty.const.OK} </button>
</p>
