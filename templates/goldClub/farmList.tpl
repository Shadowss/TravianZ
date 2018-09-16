<div id="raidList">

{include file=$smarty.const.TEMPLATES_DIR|cat:'error.tpl'}

<form action="build.php?id={$parameters['id']}&t=3" method="post" name="msg">
{foreach $villageFarmLists as $farmList}
	<div class="openedClosedSwitch switchOpened"></div>
	<div class="clear"></div>
	<div class="listContent ">
		<div class="detail">
			<table id="raidList" cellpadding="1" cellspacing="1">
				<thead>
					<tr>
						<td colspan="7">
							<a href="build.php?id={$parameters['id']}&t=3&delFarmList={$farmList.id}">
								<img class="del" src="assets/img/x.gif" alt="delete" title="delete">
							</a>
							<b>{$farmList.fromVillageName} - {$farmList.name}</b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>{$smarty.const.VILLAGE}</td>
						<td>{$smarty.const.POP}</td>
						<td>{$smarty.const.DISTANCE}</td>
						<td>{$smarty.const.TROOPS}</td>
						<td>{$smarty.const.LAST_RAID}</td>
						<td></td>
					</tr>
				</thead>
				<tbody>

        {if !empty($farmList.raidsList)}
            {foreach $farmList.raidsList as $raid}
					<tr class="slotRow">
						<td class="checkbox">
							<input id="slot" name="slot[]" value="{$raid.id}" type="checkbox" class="markSlot">
						</td>
						<td class="village">
							{if $raid.isBeingRaided}
                				<img class="att2" src="assets/img/x.gif" title="{$smarty.const.OWN_ATTACKING_TROOPS}" />
                			{/if}
                			<label for="slot{$raid.id}">
                			<span class="coordinates coordinatesWithText"> 
                			<span class="coordText">{$raid.toVillageName}</span> 
                			<span class="coordinatesWrapper"> 
								<span class="coordinateY">({$raid.toVillageCoordinates['x']}</span>
								<span class="coordinatePipe">|</span> 
								<span class="coordinateX">{$raid.toVillageCoordinates['y']})</span>
							</span>
							</span> 
							<span class="clear">‎</span>
							</label>
						</td>
						<td class="ew">
							{if isset($raid.toVillagePop)}
								{$raid.toVillagePop}
							{else}
								-
							{/if}
						</td>
						<td class="distance">{$raid.toVillageDistance}</td>
						<td class="troops">

                		{foreach $raid.units as $type => $unit}
                    		{if $unit.amount > 0}
                        		<div class="troopIcon">
                        			<img class="unit u{($tribe - 1) * 10 + $type}" title="{$unit.name}" src="assets/img/x.gif">
                        			<span class="troopIconAmount">{$unit.amount}</span>
                        		</div>
                    		{/if}
                		{/foreach}
 
            			</td>
            			
						<td class="lastRaid">
						{if !empty($raid.lastReport)}
                        	<img src="assets/img/x.gif" class="iReport iReport{$raid.lastReport.type}" title="{$raid.lastReport.topic}">
                        	<img title="{$raid.lastReport.robbedResources}/{$raid.lastReport.maxCarry}" src="assets/img/x.gif" class="carry"/>
                        	<a href="berichte.php?id={$raid.lastReport.id}">{$raid.lastReport.time[0]} {$raid.lastReport.time[1]}</a>
                				<div class="clear"></div>
                		{else}
                			-
                		{/if}
						</td>
						<td class="action">
							<a class="arrow" href="build.php?id={$parameters['id']}&t=3&raidList={$raid.id}&lid={$farmList.id}">{$smarty.const.EDIT}</a>
						</td>
					</tr>
			{/foreach}
		{else}
			<td class="noData" colspan="7">{$smarty.const.NO_VILLAGES}</td>
        {/if} 
    
			</tbody>
		</table>
			<div class="clear"></div>
			<br />
			<div class="troopSelection">
			<div class="clear"></div>
			</div>
		</div>
	</div>
{/foreach}


{if !empty($villageFarmLists)}
<div class="markAll">
	<input type="checkbox" id="raidListMarkAll" name="s10" class="markAll" onclick="Allmsg(this.form);"> 
	<label for="raidListMarkAll">{$smarty.const.SELECT_ALL}</label>
</div>
<br />
<div class="addSlot">
	<button name="action" value="addFarmListRaid" type="submit" class="trav_buttons">{$smarty.const.ADD_RAID}</button>
	<button name="action" value="startFarmListRaids" type="submit" class="trav_buttons">{$smarty.const.START_RAIDS}</button>
</div>
<br />

{/if}
<div class="options">
	<button name="action" value="addFarmList" type="submit" class="trav_buttons">{$smarty.const.CREATE_NEW_LIST}</button>
</div>

</form>
</div>