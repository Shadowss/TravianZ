<form action="build.php?id={$parameters['id']}" method="post" id="start">
<input type="hidden" name="action" value="startBeerFest">
<table cellpadding="1" cellspacing="1" class="build_details">
	<thead>
		<tr>
			<td>{$smarty.const.CELEBRATION}</td>
			<td>{$smarty.const.ACTION}</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="desc">
				<div class="tit">
				    <a href="#" onClick="return Popup(0, 1);">{$smarty.const.BEER_FEST}</a>
				</div>
				<div class="details">
					<img class="r1" src="assets/img/x.gif" alt="{$smarty.const.LUMBER}" title="{$smarty.const.LUMBER}" />{$beerFest['neededResources'][0]}|
					<img class="r2" src="assets/img/x.gif" alt="{$smarty.const.CLAY}" title="{$smarty.const.CLAY}" />{$beerFest['neededResources'][1]}|
					<img class="r3" src="assets/img/x.gif" alt="{$smarty.const.IRON}" title="{$smarty.const.IRON}" />{$beerFest['neededResources'][2]}|
					<img class="r4" src="assets/img/x.gif" alt="{$smarty.const.CROP}" title="{$smarty.const.CROP}" />{$beerFest['neededResources'][3]}|
					<img class="clock" src="assets/img/x.gif" alt="{$smarty.const.DURATION}" title="{$smarty.const.DURATION}" />{$beerFest.duration}
					
					{if $gold >= 3 && $isMarketplaceBuilt && $villageTotalResources >= $beerFest['totalResources']} |
					<a href="build.php?gid=17&t=3&r1={$beerFest['neededResources'][0]}&r2={$beerFest['neededResources'][1]}&r3={$beerFest['neededResources'][2]}&r4={$beerFest['neededResources'][3]}">
						<img class="npc" src="assets/img/x.gif"alt="{$smarty.const.NPC_TRADE}" title="{$smarty.const.NPC_TRADE}" />
					</a>
					{/if}
				</div>
			</td>
				{if !empty($beerFest.error)}
					<td class="{if $beerFest.error|strstr:':'}timer{else}none{/if}">{$beerFest.error}</td>
				{else}
					<td class="act">
						<a class="research" href="#" onclick="document.getElementById('start').submit();">{$smarty.const.START}</a>
					</td>
				{/if}
			</tr>
	</tbody>
</table>
</form>