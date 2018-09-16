<table cellpadding="1" cellspacing="1" id="building_contract">
    <thead>
    	<tr>
    		<th colspan="4">{$smarty.const.BUILDING_UPGRADING}
				{if $gold >= 2}
            		<a href="?buildingFinish=1" onclick="return confirm('Finish all construction and research orders in this village immediately for 2 Gold?');" title="Finish all construction and research orders in this village immediately for 2 Gold?">
            			<img class="clock" alt="Finish all construction and research orders in this village immediately for 2 Gold?" src="assets/img/x.gif"/>
            		</a>
           		{/if}
            </th>
		</tr>
	</thead>
	<tbody>
        {foreach $villageBuildingJobs as $job}
			{if $job.sort != 2}
        	<tr>
        		<td class="ico">
        			<a href="?d={$job.id}&c={$sessionChecker}">
            			<img src="assets/img/x.gif" class="del" title="cancel" alt="cancel" />
            		</a>
            	</td>
            	<td>
				{$job.name} ({$smarty.const.LEVEL} {$job.level})

				{if $job.sort == 1} {$smarty.const.WAITING_LOOP} {/if}
            	</td>
            	<td>in <span class="timer">{$job.time}</span> {$smarty.const.HRS}</td>
            	<td>done at {$job.doneAt}</td>
            </tr>
			{else}
        	<tr>
        		<td class="ico">
        			<a href="?d={$job.id}&c={$sessionChecker}">
            			<img src="assets/img/x.gif" class="del" title="cancel" alt="cancel" />
            		</a>
            	</td>
            	<td>
            		{$job.name} <span class="none">({$smarty.const.LEVEL} {$job.level})</span>
            	</td>
            </tr>
			{/if}
      	{/foreach}
    </tbody>
</table>

{literal}
<script>
	var bld=[{"stufe":1,"gid":"1","aid":"3"}];
</script>
{/literal}
