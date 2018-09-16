<form action="build.php?id={$parameters['id']}&t=4" method="post">
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
			<input type="hidden" name="action" value="addRoute">
			<table cellpadding="1" cellspacing="1" id="npc" class="transparent">
				<thead>
					<tr>
						<th colspan="2">{$smarty.const.CREATE_TRADE_ROUTE}</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>
							{$smarty.const.TARGET_VILLAGE}:					
						</th>
						<td>
							<select id="tvillage" name="tvillage">
							{foreach $villages as $village}
 							   {if $village.villageVref != $villageVref}
 							       <option value="{$village.villageVref}"> {$village.villageName} ({$village.villageCoordinates['x']}|{$village.villageCoordinates['y']})</option>
 							   {/if}
							{/foreach}
							</select>
						</td>
					</tr>
					<tr>
						<th>
							{$smarty.const.RESOURCES}:					
						</th>
						<td>
							<img src="{$smarty.const.GP_LOCATE}img/r/1.gif" alt="{$smarty.const.LUMBER}" title="{$smarty.const.LUMBER}">
							<input class="text" type="text" name="wood" id="r1" value="" maxlength="5" tabindex="1" style="width: 50px;">
							<img src="{$smarty.const.GP_LOCATE}img/r/2.gif" alt="{$smarty.const.CLAY}" title="{$smarty.const.CLAY}"> 
							<input class="text" type="text" name="clay" id="r2" value="" maxlength="5" tabindex="1" style="width: 50px;">
							<img src="{$smarty.const.GP_LOCATE}img/r/3.gif" alt="{$smarty.const.IRON}" title="{$smarty.const.IRON}">
							<input class="text" type="text" name="iron" id="r3" value="" maxlength="5" tabindex="1" style="width: 50px;"> 
							<img src="{$smarty.const.GP_LOCATE}img/r/4.gif" alt="{$smarty.const.CROP}" title="{$smarty.const.CROP}"> 
							<input class="text" type="text" name="crop" id="r4" value="" maxlength="5" tabindex="1" style="width: 50px;">
						</td>
					</tr>
					<tr>
						<th>
							{$smarty.const.START_TIME_TRADE}:
						</th>
						<td>
							<select name="start">
							<option value="0" selected="selected">00</option>
							<option value="1">01</option>
							<option value="2">02</option>
							<option value="3">03</option>
							<option value="4">04</option>
							<option value="5">05</option>
							<option value="6">06</option>
							<option value="7">07</option>
							<option value="8">08</option>
							<option value="9">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							{$smarty.const.DELIVERIES}:	
						</th>
						<td>
							<select name="deliveries">
							<option value="1" selected="selected">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							{$smarty.const.COSTS}:					
						</th>
						<td><img src="{$smarty.const.GP_LOCATE}img/a/gold.gif"
							alt="{$smarty.const.GOLD}" title="{$smarty.const.GOLD}"> <b>2</b></td>
					</tr>
					<tr>
						<th>
							{$smarty.const.DURATION}:					
						</th>
						<td><b>7</b> {$smarty.const.DAYS}
					</td>
					</tr>
				</tbody>
			</table>

		</div>
	</div>
	
	{include file=$smarty.const.TEMPLATES_DIR|cat:'error.tpl'}

	<p>
		<button type="submit" name="action" value="addTradeRoute" id="btn_id" class="trav_buttons"> {$smarty.const.SAVE} </button>
	</p>
</form>
