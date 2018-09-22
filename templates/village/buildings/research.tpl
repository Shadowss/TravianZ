<table cellpadding="1" cellspacing="1" class="build_details">
	<thead>
		<tr>
			<td>{$smarty.const.ACADEMY}</td>
			<td>{$smarty.const.ACTION}</td>
		</tr>
	</thead>
	<tbody>
        {if empty($villageResearches['available'])}
        	<td colspan="2">
        		<div class="none" align="center">{$smarty.const.RESEARCH_AVAILABLE}</div>
        	</td>
        {else}

		{foreach $villageResearches['available'] as $unit => $research}
		<tr>
			<td class="desc">
				<div class="tit">
					<img class="unit u{($tribe - 1) * 10 + $unit}" src="assets/img/x.gif" alt="{$research.name}" title="{$research.name}" />
				    <a href="#" onClick="return Popup({$unit}, 1);">{$research.name}</a>
				</div>
				<div class="details">
					<img class="r1" src="assets/img/x.gif" alt="{$smarty.const.LUMBER}" title="{$smarty.const.LUMBER}" />{$research['neededResources'][0]}|
					<img class="r2" src="assets/img/x.gif" alt="{$smarty.const.CLAY}" title="{$smarty.const.CLAY}" />{$research['neededResources'][1]}|
					<img class="r3" src="assets/img/x.gif" alt="{$smarty.const.IRON}" title="{$smarty.const.IRON}" />{$research['neededResources'][2]}|
					<img class="r4" src="assets/img/x.gif" alt="{$smarty.const.CROP}" title="{$smarty.const.CROP}" />{$research['neededResources'][3]}|
					<img class="clock" src="assets/img/x.gif" alt="{$smarty.const.DURATION}" title="{$smarty.const.DURATION}" />{$research['neededTime']}
					
					{if $gold >= 3 && $isMarketplaceBuilt && $villageTotalResources >= $research['totalResources']} |
					<a href="build.php?gid=17&t=3&r1={$research['neededResources'][0]}&r2={$research['neededResources'][1]}&r3={$research['neededResources'][2]}&r4={$research['neededResources'][3]}">
						<img class="npc" src="assets/img/x.gif"alt="{$smarty.const.NPC_TRADE}" title="{$smarty.const.NPC_TRADE}" />
					</a>
					{/if}
				</div>
			</td>
				{if !empty($research.error)}
					<td class="none">{$research.error}</td>
				{else}
					<td class="act">
						<a class="research" href="build.php?id={$parameters['id']}&a={$unit}&c={$sessionChecker}">{$smarty.const.RESEARCH}</a>
					</td>
				{/if}
			</tr>
			{/foreach}
		{/if}
	</tbody>
</table>

{if $villageResearches['notAvailable']}
<p class="switch">
	<a id="researchFutureLink" href="#" onclick="return $('researchFuture').toggle();">{$smarty.const.SHOW_MORE}</a>
</p>
<table id="researchFuture" class="build_details hide" cellspacing="1" cellpadding="1">
	<thead>
		<tr>
			<td colspan="2">{$smarty.const.PREREQUISITES}</td>
		</tr>
	<tbody>
	{foreach $villageResearches['notAvailable'] as $unit => $research}
		<tr>
			<td class="desc">
			<div class="tit">
					<img class="unit u{($tribe - 1) * 10 + $unit}" title="{$research.name}" alt="{$research.name}" src="assets/img/x.gif" /> 
					<a onclick="return Popup({($tribe - 1) * 10 + $unit}, 1);" href="#">{$research.name}</a>
				</div></td>
			<td class="cond">
				{foreach $research['buildingsNeeded'] as $buildingID => $building}
					<img src="{$smarty.const.GP_LOCATE}img/g/g{$buildingID}.gif" height="20" width="15" title="{$building.name}" alt="{$building.name}"/>
					<a href="#" onclick="return Popup({$buildingID}, 4);">{$building.name}</a>
					<span>&nbsp;{$smarty.const.LEVEL} {$building.level}</span><br />
				{/foreach}
			</td>
		</tr>
	{/foreach}
	</tbody>
</table>

{/if} 

{if $villageResearches['inResearch'] > 0}
<table cellpadding="1" cellspacing="1" class="under_progress">
	<thead>
		<tr>
			<td>{$smarty.const.RESEARCHING}</td>
			<td>{$smarty.const.DURATION}</td>
			<td>{$smarty.const.COMPLETE}</td>
		</tr>
	</thead>
	<tbody>
		{foreach $villageResearches['inResearch'] as $unit => $research}
		<tr>
			<td class="desc"><img class="unit u{($tribe - 1) * 10 + $unit}" src="assets/img/x.gif" alt="{$research.name}" title="{$research.name}"/>{$research.name}</td>
			<td class="dur"><span class="timer">{$research.time}</span></td>
			<td class="fin"><span>{$research.finishTime}</span><span> hrs</span></td>
		</tr>
		{/foreach}
	</tbody>
</table>
{/if}

<script type="text/javascript">
	//<![CDATA[
		$("researchFuture").toggle = (function()
		{
			this.toggleClass("hide");

			$("researchFutureLink").set("text",
				this.hasClass("hide")
				?	"{$smarty.const.SHOW_MORE}"
				:	"{$smarty.const.HIDE_MORE}"
			);

			return false;
		}).bind($("researchFuture"));
	//]]>
</script>