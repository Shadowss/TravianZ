<table id="search_select" class="buy_select" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td colspan="4">{$smarty.const.I_AM_SEARCHING}</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td {if isset($parameters['s']) && $parameters['s'] == 1}class="hl"{/if} >
				<a href="build.php?id={$parameters['id']}&t=1&s=1{if isset($parameters['v'])}&v={$parameters['v']}{/if}{if isset($parameters['b'])}&b={$parameters['b']}{/if}">
					<img class="r1" src="assets/img/x.gif" alt="{$smarty.const.LUMBER}" title="{$smarty.const.LUMBER}" />
				</a>
			</td>
			<td {if isset($parameters['s']) && $parameters['s'] == 2}class="hl"{/if} >
				<a href="build.php?id={$parameters['id']}&t=1&s=2{if isset($parameters['v'])}&v={$parameters['v']}{/if}{if isset($parameters['b'])}&b={$parameters['b']}{/if}">
					<img class="r2" src="assets/img/x.gif" alt="{$smarty.const.CLAY}" title="{$smarty.const.CLAY}" />
				</a>
			</td>
			<td {if isset($parameters['s']) && $parameters['s'] == 3}class="hl"{/if} >
				<a href="build.php?id={$parameters['id']}&t=1&s=3{if isset($parameters['v'])}&v={$parameters['v']}{/if}{if isset($parameters['b'])}&b={$parameters['b']}{/if}">
					<img class="r3" src="assets/img/x.gif" alt="{$smarty.const.IRON}" title="{$smarty.const.IRON}" />
				</a>
			</td>
			<td {if isset($parameters['s']) && $parameters['s'] == 4}class="hl"{/if} >
				<a href="build.php?id={$parameters['id']}&t=1&s=4{if isset($parameters['v'])}&v={$parameters['v']}{/if}{if isset($parameters['b'])}&b={$parameters['b']}{/if}">
					<img class="r4" src="assets/img/x.gif" alt="{$smarty.const.CROP}" title="{$smarty.const.CROP}" />
				</a>
			</td>
		</tr>
	</tbody>
</table>

<table id="ratio_select" class="buy_select" cellpadding="1" cellspacing="1">
	<tbody>
		<tr>
			<td {if isset($parameters['v']) && $parameters['v'] == 1}class="hl"{/if}>
				<a href="build.php?id={$parameters['id']}&t=1&v=1{if isset($parameters['s'])}&s={$parameters['s']}{/if}{if isset($parameters['b'])}&b={$parameters['b']}{/if}">1:1</a>
			</td>
		</tr>
		<tr>
			<td {if !isset($parameters['v'])}class="hl"{/if}>
				<a href="build.php?id={$parameters['id']}&t=1{if isset($parameters['s'])}&s={$parameters['s']}{/if}{if isset($parameters['b'])}&b={$parameters['b']}{/if}">1:x</a>
			</td>
		</tr>
	</tbody>
</table>

<table id="bid_select" class="buy_select" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td colspan="4">{$smarty.const.I_AM_OFFERING}</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td {if isset($parameters['b']) && $parameters['b'] == 1}class="hl"{/if} >
				<a href="build.php?id={$parameters['id']}&t=1&b=1{if isset($parameters['v'])}&v={$parameters['v']}{/if}{if isset($parameters['s'])}&s={$parameters['s']}{/if}">
					<img class="r1" src="assets/img/x.gif" alt="{$smarty.const.LUMBER}" title="{$smarty.const.LUMBER}" />
				</a>
			</td>
			<td {if isset($parameters['b']) && $parameters['b'] == 2}class="hl"{/if} >
				<a href="build.php?id={$parameters['id']}&t=1&b=2{if isset($parameters['v'])}&v={$parameters['v']}{/if}{if isset($parameters['s'])}&s={$parameters['s']}{/if}">
					<img class="r2" src="assets/img/x.gif" alt="{$smarty.const.CLAY}" title="{$smarty.const.CLAY}" />
				</a>
			</td>
			<td {if isset($parameters['b']) && $parameters['b'] == 3}class="hl"{/if} >
				<a href="build.php?id={$parameters['id']}&t=1&b=3{if isset($parameters['v'])}&v={$parameters['v']}{/if}{if isset($parameters['s'])}&s={$parameters['s']}{/if}">
					<img class="r3" src="assets/img/x.gif" alt="{$smarty.const.IRON}" title="{$smarty.const.IRON}" />
				</a>
			</td>
			<td {if isset($parameters['b']) && $parameters['b'] == 4}class="hl"{/if} >
				<a href="build.php?id={$parameters['id']}&t=1&b=4{if isset($parameters['v'])}&v={$parameters['v']}{/if}{if isset($parameters['s'])}&s={$parameters['s']}{/if}">
					<img class="r4" src="assets/img/x.gif" alt="{$smarty.const.CROP}" title="{$smarty.const.CROP}" />
				</a>
			</td>
		</tr>
	</tbody>
</table>

<div class="clear"></div>

<table id="range" cellpadding="1" cellspacing="1">
<thead>
		<tr>
			<th colspan="5">{$smarty.const.OFFERS_MARKETPLACE}</th>
		</tr>
		<tr>
			<td>{$smarty.const.OFFERED_TO_ME}</td>
			<td>{$smarty.const.WANTED_TO_ME}</td>
			<td>{$smarty.const.PLAYER}</td>
			<td>{$smarty.const.DURATION}</td>
			<td>{$smarty.const.ACTION}</td>
		</tr>
	</thead>
	<tbody>

{if !empty($villageOffers)}
	{assign var=resourcesName value=[1 => $smarty.const.LUMBER, $smarty.const.CLAY, $smarty.const.IRON, $smarty.const.CROP]}
{for $i = 0 + $parameters['u'] to 40 + $parameters['u']}
{if isset($villageOffers[$i])}
<tr>
	<td class="val">
    	<img src="assets/img/x.gif" class="r{$villageOffers[$i]['offered']}" alt="{$resourcesName[$villageOffers[$i]['offered']]}" title="{$resourcesName[$villageOffers[$i]['offered']]}" />{$villageOffers[$i]['offeredAmount']}
    </td> 

    <td class="val">
    	<img src="assets/img/x.gif" class="r{$villageOffers[$i]['wanted']}" alt="{$resourcesName[$villageOffers[$i]['wanted']]}" title="{$resourcesName[$villageOffers[$i]['wanted']]}" />{$villageOffers[$i]['wantedAmount']}
    </td>
    
    <td class="pla" title="{$villageOffers[$i]['villageName']}">
    	<a href="karte.php?d={$villageOffers[$i]['villageVref']}&c={$villageOffers[$i]['villageMapCheck']}">{$villageOffers[$i]['ownerUsername']}</a>
    </td>
    
    <td class="dur">{$villageOffers[$i]['duration']}</td>
    
    {if empty($villageOffers[$i]['error'])}
    	<td class="act">
    		<a href="build.php?id={$parameters['id']}&t=1&g={$villageOffers[$i]['id']}&c={$sessionChecker}">{$smarty.const.ACCEPT_OFFER}</a>
    	</td>
    {else}
    	<td class="act none">
    		{$villageOffers[$i]['error']}
    	</td>
    {/if}
{/if}
{/for}
{else}
<tr>
    <td class="none" colspan="5">{$smarty.const.NO_AVAILABLE_OFFERS}</td>
</tr>
{/if}

</tbody>
<tfoot>
		<tr>
			<td colspan="5">
				<span class="none">
					{if !isset($parameters['u']) && $villageOffersCount < 40}
					    <span class="none"><b>&laquo;</b></span><span class="none"><b>&raquo;</b></span>
					{elseif !isset($parameters['u']) && $villageOffersCount > 40}
					    <span class="none"><b>&laquo;</b></span><a href="build.php?id={$parameters['id']}&t=1&u=40">&raquo;</a>";
					{elseif isset($parameters['u']) && $villageOffersCount > $parameters['u']}
 					   {if $villageOffersCount > $parameters['u'] + 40 && $parameters - 40 < $villageOffersCount && $parameters['u'] > 0}
 					       <a href="build.php?id={$parameters['id']}&t=1&u={$parameters['u'] - 40}">&laquo;</a><a href="build.php?id={$parameters['id']}&t=1&u={$parameters['u'] + 40}">&raquo;</a>
 					   {elseif $villageOffersCount > $_GET['u'] + 40}
  					     	<span class="none"><b>&laquo;</b></span><a href="build.php?id={$parameters['id']}&t=1&u={$parameters['u'] + 40}">&raquo;</a>
  					  {else}
  					      <a href="build.php?id={$parameters['id']}&t=1&u={$parameters['u'] - 40}">&laquo;</a><span class="none"><b>&raquo;</b></span>
  					  {/if}
					{/if}
				</span>
			</td>
		</tr>
</tfoot>
</table>
