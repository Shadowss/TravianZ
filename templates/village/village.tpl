
<map name="map1" id="map1">
{if $villageBuildings[40]['id'] > 0}
	{assign var=wallTitle value={$villageBuildings[40]['name']}|cat:' '|cat:{$smarty.const.LEVEL}|cat:' '|cat:{$villageBuildings[40]['level']}}
{else}
	{assign var=wallTitle value=$smarty.const.OUTER_BUILDING_SITE}
{/if}

<area href="build.php?id=40" title="{$wallTitle}" coords="325,225,180" shape="circle"/>
<area href="build.php?id=40" title="{$wallTitle}" coords="220,230,185" shape="circle"/>

</map>
<map name="map2" id="map2">

{for $i = 19 to 39}
    {if $villageIsNatar && ($i == 25 || $i == 26 || $i == 29 || $i == 30 || $i == 33)}
        {if $i == 33}
            {if $villageBuildings[99]['level'] > 0}
            	<area href="build.php?id=99" title="{$villageBuildings[99]['name']}  {$smarty.const.LEVEL}  {$villageBuildings[99]['level']}" coords="190,170,80" shape="circle"/>
            {else}
            	<area href="build.php?id=99" title="{$villageBuildings[99]['name']}" coords="190,170,80" shape="circle"/>
        	{/if}
        {/if}
    {else}
        {if $villageBuildings[$i]['id'] > 0}
            {assign var=title value=$villageBuildings[$i]['name']|cat:' '|cat:{$smarty.const.LEVEL}|cat:' '|cat:{$villageBuildings[$i]['level']}}
        {else}
            {assign var=title value=$smarty.const.BUILDING_SITE}
            {if $i == 39 && $villageBuildings[$i]['level'] == 0}
            	{assign var=title value={$smarty.const.RALLYPOINT}|cat:' '|cat:{$smarty.const.BUILDING_SITE}}
            {/if}
        {/if}
        <area href="build.php?id={$i}" title="{$title}" coords="{$villageCoordinatesArray[$i]}" shape="poly"/>
    {/if}
{/for}
	
    <area href="build.php?id=40" title="{$wallTitle}" coords="312,338,347,338,377,320,406,288,421,262,421,222,396,275,360,311"shape="poly" />
	<area href="build.php?id=40" title="{$wallTitle}" coords="49,338,0,274,0,240,33,286,88,338" shape="poly" />
	<area href="build.php?id=40" title="{$wallTitle}" coords="0,144,34,88,93,39,181,15,252,15,305,31,358,63,402,106,421,151,421,93,378,47,280,0,175,0,78,28,0,92"shape="poly" />
</map>

{if $tribe == 3}
	{assign var=tribe value=''}
{/if}

{if $villageBuildings[40]['id'] > 0 || $villageBuildings[40]['level'] > 0}
    {assign var=villageImage value=d2_1|cat:{$tribe}}
{else}
    {assign var=villageImage value='d2_0'}
{/if}

<div id="village_map" class="{$villageImage}">

{for $i = 19 to 38}
    {if !$villageIsNatar || $villageIsNatar && ($i != 25 && $i != 26 && $i != 29 && $i != 30 && $i != 33)}
        {assign var=text value={$smarty.const.BUILDING_SITE}}
        {assign var=img value='iso'}
  
        {if $villageBuildings[$i]['level'] > 0}
            {assign var=text value={$villageBuildings[$i]['name']}|cat:' '|cat:{$smarty.const.LEVEL}|cat:' '|cat:{$villageBuildings[$i]['level']}}
            {assign var=img value='g'|cat:{$villageBuildings[$i]['id']}}
        {/if}

        {foreach $villageBuildingJobs as $job}
            {if $job.position == $i}
                {assign var=img  value='g'|cat:$job.type|cat:'b'}
                {assign var=text value={$job.name}|cat:' '|cat:{$smarty.const.LEVEL}|cat:' '|cat:{$job.level}}
            {/if}
        {/foreach}
        <img src="assets/img/x.gif" class="building d{$i - 18} {$img}" alt="{$text}"/>
        {if ($questNumber == 38 && $smarty.const.QTYPE == 37) || ($questNumber == 31 && $smarty.const.QTYPE == 25)}
            {if $i < 8}
                {assign var=rocketColor value=['tur', 'purp', 'yell', 'oran', 'green', 'red', 'dark']}
                <img src="assets/img/x.gif" class="building e{$i} rocket {$rocketColor[$i - 1]}" alt="{$text}"/>
            {/if}
        {/if}
    {/if}
{/for}

{if $villageBuildings[39]['id'] == 0}
    <img src="assets/img/x.gif" class="dx1 g16e"/>
{elseif $villageBuildings[39]['level'] > 0}
	<img src="assets/img/x.gif" class="dx1 g16"/>
{else}
    <img src="assets/img/x.gif" class="dx1 g16b"/>
{/if}

{if $villageBuildings[99]['id'] == 40}
    {if $villageBuildings[99]['level'] >= 0 && $villageBuildings[99]['level'] <=19}
        <img class="ww g40" src="assets/img/x.gif" alt="Worldwonder"/>
    {/if}
    {if $villageBuildings[99]['level'] >= 20 && $villageBuildings[99]['level'] <=39}
        <img class="ww g40_1" src="assets/img/x.gif" alt="Worldwonder"/>
    {/if}
    {if $villageBuildings[99]['level'] >= 40 && $villageBuildings[99]['level'] <=59}
        <img class="ww g40_2" src="assets/img/x.gif" alt="Worldwonder"/>
    {/if}
    {if $villageBuildings[99]['level'] >= 60 && $villageBuildings[99]['level'] <=79}
        <img class="ww g40_3" src="assets/img/x.gif" alt="Worldwonder"/>
    {/if}
    {if $villageBuildings[99]['level'] >= 80 && $villageBuildings[99]['level'] <=99}
        <img class="ww g40_4" src="assets/img/x.gif" alt="Worldwonder"/>
    {/if}
    {if $villageBuildings[99]['level'] == 100}
        <img class="ww g40_5" src="assets/img/x.gif" alt="Worldwonder"/>
    {/if}
{/if}

<div id="levels" {if $showLevels} class="on" {/if}>

{for $i = 19 to 38}
    {if $villageBuildings[$i]['id'] > 0}
        <div class="d{$i - 18}">{$villageBuildings[$i]['level']}</div>
    {/if}
{/for}

{if $villageBuildings[39]['id'] > 0}
    <div class="l39">{$villageBuildings[39]['level']}</div>
{/if}

{if $villageBuildings[40]['id'] > 0}
    <div class="l40">{$villageBuildings[40]['level']}</div>
{/if}

{if $villageBuildings[99]['id'] > 0}
    <div class="d40">{$villageBuildings[99]['level']}</div>
{/if}

</div>
<img class="map1" usemap="#map1" src="assets/img/x.gif"/>
<img class="map2" usemap="#map2" src="assets/img/x.gif"/>
</div>
<img src="assets/img/x.gif" id="lswitch" {if $showLevels} class="on" {/if} onclick="vil_levels_toggle()"/>
