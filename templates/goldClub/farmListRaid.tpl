<div class="boxes boxesColor gray">
	<div class="boxes-tl"></div>
	<div class="boxes-tr"></div>
	<div class="boxes-tc"></div>
	<div class="boxes-ml"></div>
	<div class="boxes-mr"></div>
	<div class="boxes-mc"></div>
	<div class="boxes-bl"></div>
	<div class="boxes-br"></div>
	<div class="boxes-bc"></div>
	<div class="boxes-contents cf">
		<input type="hidden" name="raidList" value="{$raidList}">
		<table cellpadding="1" cellspacing="1" class="transparent" id="raidList">
			<tbody>
				<tr>
					<th>{$smarty.const.LIST_NAME}:</th>
					<td>
						<select name="lid">
							{foreach $villageFarmLists as $farmList}
                                   <option {if $lid == $farmList.id}selected="selected"{/if} value="{$farmList.id}">{$farmList.fromVillageName} - {$farmList.name}</option>
                               {/foreach}
                        </select>
                       </td>
				</tr>
				<tr>
					<th>{$smarty.const.TARGET_VILLAGE}:</th>
					<td class="target">
						<div class="coordinatesInput">
							<div class="xCoord">
								<label for="xCoordInput">{$smarty.const.X}:</label> 
								<input value="{$x}" name="x" id="xCoordInput" class="text coordinates x" maxLength="4">
							</div>
							<br />
							<div class="yCoord">
								<label for="yCoordInput">{$smarty.const.Y}:</label> 
								<input value="{$y}" name="y" id="yCoordInput" class="text coordinates y" maxLength="4">
							</div>
							<div class="clear"></div>
						</div> 
						<br />
						<div class="targetSelect">
							<label class="lastTargets">{$smarty.const.LAST_TARGETS}:</label> 
							<select name="lastTarget">
    						{foreach $villageLastAttackedTargets as $targetVref => $target}
            					<option {if $lastTarget == $targetVref}selected="selected"{/if} value="{$targetVref}">{$target.villageName} ({$target.villageCoordinates['x']}|{$target.villageCoordinates['y']})</option>
   							{/foreach}
							</select>
						</div>
						<div class="clear"></div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
    {include file=$smarty.const.TEMPLATES_DIR|cat:'goldClub/unitsList.tpl'}
<br />