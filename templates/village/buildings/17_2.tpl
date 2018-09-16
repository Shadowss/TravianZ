<form method="POST" action="build.php?id={$parameters['id']}&t=2">     
    <table id="sell" cellpadding="1" cellspacing="1">  
        <tr>  
            <th>{$smarty.const.OFFERING}</th>  
            <td class="val"><input class="text" tabindex="1" name="m1" value="" maxlength="6" /></td>  
            <td class="res">  
                <select name="rid1" tabindex="2" class="dropdown">  
                    <option value="1" selected="selected">{$smarty.const.LUMBER}</option>  
                    <option value="2">{$smarty.const.CLAY}</option>  
                    <option value="3">{$smarty.const.IRON}</option>  
                    <option value="4">{$smarty.const.CROP}</option>  
                </select>  
            </td>  
            <td class="tra">
            	<input class="check" type="checkbox" tabindex="5" name="d1" value="1" /> {$smarty.const.MAX_TIME_TRANSPORT}: <input class="text" tabindex="6" name="d2" value="2" maxlength="2" /> {$smarty.const.HOURS}
            </td>
        </tr>  
        <tr>  
            <th>{$smarty.const.SEARCHING}</th>  
            <td class="val">
            	<input class="text" tabindex="3" name="m2" value="" maxlength="6" />
            </td>  
            <td class="res">  
                <select name="rid2" tabindex="4" class="dropdown">  
                    <option value="1">{$smarty.const.LUMBER}</option>  
                    <option value="2" selected="selected">{$smarty.const.CLAY}</option>  
                    <option value="3">{$smarty.const.IRON}</option>  
                    <option value="4">{$smarty.const.CROP}</option>  
                </select>  
            </td>  
            <td class="al"> 
                {if $alliance > 0}         
                    <input class="check" type="checkbox" tabindex="7" name="ally" value="1" /> {$smarty.const.OWN_ALLIANCE_ONLY} 
                {/if}
            </td> 
        </tr>  
    </table> 

    {include file=$smarty.const.TEMPLATES_DIR|cat:'error.tpl'}

    <p>{$smarty.const.MERCHANT}: {$villageMerchants['available']}/{$villageMerchants['total']}</p>

	<button name="action" id="btn_save" class="trav_buttons" value="addOffer" {if $villageMerchants['available'] == 0}disabled="disabled"{/if}> OK </button>
	<br />
	<br />
</form> 

{if !empty($villageOffers)}
    <table id="sell_overview" cellpadding="1" cellspacing="1">
    	<thead>
    		<tr>
    			<th colspan="7">{$smarty.const.OWN_OFFERS}</th>
    		</tr>
    		<tr>
    			<td>&nbsp;</td>
    			<td>{$smarty.const.OFFER}</td>
    			<td>{$smarty.const.RATIO}</td>
				<td>{$smarty.const.SEARCH}</td>
				<td>{$smarty.const.MERCHANT}</td>
				<td>{$smarty.const.ALLIANCE}</td>
				<td>{$smarty.const.DURATION}</td>
			</tr>
		</thead>
		<tbody> 
	{assign var=resourcesName value=[1 => $smarty.const.LUMBER, $smarty.const.CLAY, $smarty.const.IRON, $smarty.const.CROP]}
    {foreach $villageOffers as $offer}
       		<tr>
        		<td class="abo">
        			<a href="build.php?id={$parameters['id']}&t=2&del={$offer.id}">
        				<img class="del"src="assets/img/x.gif" alt="Delete" title="{$smarty.const.DELETE}" />
        			</a>
        		</td> 
        		<td class="val">

        		<img src="assets/img/x.gif" class="r{$offer.offered}" alt="{$resourcesName[$offer.offered]}" title="{$resourcesName[$offer.offered]}" />{$offer.offeredAmount}

				{assign var=ratio value=round($offer.wantedAmount / $offer.offeredAmount, 1)}
				{if $ratio < 1}
					{assign var=class value='red'}
				{else}
					{assign var=class value='green'}
				{/if}
	
				</td>
				<td class="ratio" style="color: {$class}"> {$ratio} </td> 
				<td class="val">
        			<img src="assets/img/x.gif" class="r{$offer.wanted}" alt="{$resourcesName[$offer.wanted]}" title="{$resourcesName[$offer.wanted]}" />{$offer.wantedAmount}
        		</td>
        		<td class="tra">{$offer.merchants}</td>
        		<td class="al">
        		{if $offer.alliance == 0}
        			{$smarty.const.NO}
        		{else}
        			{$smarty.const.YES}
        		{/if} 
        		</td>
        		<td class="dur">
       	 			{if $offer.maxTime > 0} 
             			{$offer.maxTime} {$smarty.const.HRS} 
        			{else} 
            			{$smarty.const.ALL} 
        			{/if} 
        		</td>
        	</tr>
        </tbody>
    {/foreach} 
    </table> 
{/if}
