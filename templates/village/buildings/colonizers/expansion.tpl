<table cellpadding="1" cellspacing="1" id="expansion">
	<thead>
		<tr>
			<th colspan="6">
				<a name="h2"></a>{$smarty.const.CONQUERED_BY_VILLAGE}
			</th>
		</tr>
		<tr>
			<td colspan="2">{$smarty.const.VILLAGE}</td>
			<td>{$smarty.const.PLAYER}</td>
			<td>{$smarty.const.INHABITANTS}</td>
			<td>{$smarty.const.COORDINATES}</td>
			<td>{$smarty.const.DATE}</td>
		</tr>
	</thead>
	<tbody>

{if !empty($villageExpansions)}
	{foreach $villageExpansions as $index => $expansion}
	<tr>
		<td class="ra">{$index + 1}.</td>
		<td class="vil">
			<a href="karte.php?d={$expansion.villageVref}&c={$expansion.villageMapCheck}">{$expansion.villageName}</a>
		</td>
		<td class="pla">
			<a href="spieler.php?uid={$expansion.owner}">{$expansion.ownerUsername}</a>
		</td>
		<td class="ha">{$expansion.villagePop}</td>
		<td class="aligned_coords">
			<div class="cox">({$expansion.villageCoordinates['x']}</div>
			<div class="pi">|</div>
			<div class="coy">{$expansion.villageCoordinates['y']})</div>
		</td>
		<td class="dat">{$expansion.villageCreated}</td>
	</tr>
	{/foreach}
{else}
    <tr>
    	<td colspan="6" class="none">{$smarty.const.NONE_CONQUERED_BY_VILLAGE}</td>
    </tr>
{/if}
	</tbody>
</table>
