<div id="textmenu">
   <a href="dorf3.php" class="selected ">{$smarty.const.OVERVIEW}</a>
 | <span>{$smarty.const.RESOURCES}</span>
 | <span>{$smarty.const.WAREHOUSE}</span>
 | <span>{$smarty.const.CULTUREPOINT}</span>
 | <span>{$smarty.const.TROOPS}</span>
</div>
<table cellpadding="1" cellspacing="1" id="overview">
<thead>
<tr>
	<th colspan="5">{$smarty.const.OVERVIEW}</th>
</tr>
<tr>
	<td>{$smarty.const.VILLAGE}</td>
	<td>{$smarty.const.ATTACKS}</td>
	<td>{$smarty.const.BUILDING}</td> 
	<td>{$smarty.const.TROOPS}</td>
	<td>{$smarty.const.MERCHANTS}</td>
</tr>
</thead>
<tbody> 
{foreach $villages as $village}  
  	<tr class="{if $village.capital}hl{/if}">
	    <td class="vil fc"><a href="dorf1.php?newdid={$village.vref}">{$village.name}</a></td>
	    <td class="att"><span class="none">?</span></td>
	    <td class="bui"><span class="none">?</span></td> 
		<td class="tro"><span class="none">?</span></td>
		<td class="tra lc"><a href="build.php?gid=17">?/?</a></td>
	</tr> 
{/foreach} 
</tbody>
</table>