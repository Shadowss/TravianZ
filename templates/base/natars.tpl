{assign var=startDate value=$smarty.const.START_DATE|@strtotime}
{assign var=daysToDisplay value= 432000}
{assign var=spawnTimeArray value= [
                            'Artifacts' => ($startDate + NATARS_SPAWN_TIME * 86400) - $smarty.now,
				            'WW villages' => ($startDate + NATARS_WW_SPAWN_TIME * 86400) - $smarty.now,
				            'WW building plans' => ($startDate + NATARS_WW_BUILDING_PLAN_SPAWN_TIME * 86400) - $smarty.now
                            ]}

{foreach $spawnTimeArray as $text => $spawnTime}
    {if $spawnTime <=$daysToDisplay and $spawnTime > 0}
<br /><br />
<div>
	<span><b>{$text}</b> will spawn in: </span>
	<span class="timer">{$spawnTime|date_format:'%H:%M:%S'}</span>
</div>
	{/if}
{/foreach}