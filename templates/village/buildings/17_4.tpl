{if $createTradeRoute && $gold > 1}
		{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/17_create.tpl'}
{elseif $editTradeRoute}
		{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/17_edit.tpl'}
{else}

<p>
	{$smarty.const.TRADE_ROUTES_DESC} <img src="{$smarty.const.GP_LOCATE}img/a/gold.gif" alt="{$smarty.const.GOLD}" title="{$smarty.const.GOLD}">
	<b>2</b>
.</p>

{include file=$smarty.const.TEMPLATES_DIR|cat:'error.tpl'}

<form method="post" action ="build.php?id={$parameters['id']}&t=4">
<table id="npc" cellpadding="1" cellspacing="1"> 
<thead>
<tr>
<th></th>
<th>{$smarty.const.DESCRIPTION}</th>
<th>{$smarty.const.START}</th>
<th>{$smarty.const.MERCHANT}</th>
<th>{$smarty.const.TIME_LEFT}</th>
</tr>
	</thead>
		<tbody>
	{if empty($villageTradeRoutes)}
    <td colspan="5" class="none">{$smarty.const.NO_TRADE_ROUTES}.</td>
	{else}
    	{foreach $villageTradeRoutes as $route}
			<tr>
				<th>
					<label>
						<input class="radio" type="radio" name="routeid" value="{$route.id}" {if $route.id == $lastRouteID}checked="checked"{/if}>
					</label>
					</th>
				<th>

        		{$smarty.const.TRADE_ROUTE_TO} <a href="karte.php?d={$route.villageVref}&c={$route.villageMapCheck}">{$route.villageName}</a>

				</th>
				<th>{if $route.start <= 9}0{/if}{$route.start}:00</th>
				<th>{$route.deliveries}x{$route.merchants}</th>
				<th>{$route.timeLeft} {$smarty.const.DAYS}</th>
			</tr>
		{/foreach}
	{/if}
        </tbody>
        <tfoot>
        	<tr>
				<th colspan="5">	
    				<button type="submit" name="action" value="extendTradeRoute" id="btn_id" class="trav_buttons">
        				<b>{$smarty.const.EXTEND}*</b>
    				</button>
 					|<button type="submit" name="action" value="editTradeRoute" id="btn_id" class="trav_buttons">
        				<b>{$smarty.const.EDIT}</b>
    				</button>
 					|<button type="submit" name="action" value="deleteTradeRoute" id="btn_id" class="trav_buttons">
 						<b>{$smarty.const.DELETE}</b>
 					</button>
				</th>
			</tr>
		</tfoot>
	</table>
</form>
		* {$smarty.const.EXTEND_TRADE_ROUTES} <img src="{$smarty.const.GP_LOCATE}img/a/gold.gif" alt="{$smarty.const.GOLD}" title="{$smarty.const.GOLD}"><b>2</b>
<br />

<form method="post" name="create" action ="build.php?id={$parameters['id']}&t=4">
	<input type="hidden" value="createTradeRoute" name="action"/>
	<div class="options">
    	<a class="arrow" href="javascript:document.create.submit();">» {$smarty.const.CREATE_TRADE_ROUTES}</a>
	</div>
</form>

{/if}
