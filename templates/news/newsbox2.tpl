<h5><img src="assets/img/en/t2/newsbox2.gif" alt="newsbox 2"></h5>
<div class="news">
<table>
{foreach $natarsSpawnTimeArray as $index => $natarsSpawnTime}
<tr>
	<td>
		<b>
    {if $natarsSpawnArray[$index]}
    
    	{$natarsTextArray[1][$index]}
    
    {else}
    
    	{$natarsTextArray[0][$index]}
    
    {/if}
    	</b>
    </td>
	<td>
		<b>: 
			<font color="Red">
    {if $natarsSpawnArray[$index]}
    	{$smarty.const.RELEASED}
    {else}
        {assign var=time value=$smarty.const.START_DATE|@strtotime}
        {assign var=interval value=$natarsSpawnTime * 86400 + $time}
        {$interval|date_format:'%d.%m.%y'}
    {/if}
			</font>
    	</b>
    </td>
</tr>
{/foreach}
</table>
</div>