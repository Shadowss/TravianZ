
<!--#################################################################################
    ##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
    ## --------------------------------------------------------------------------- ##
    ##  Filename       header.tpl                                                  ##
    ##  Developed by:  Dzoki                                                       ##
    ##  License:       TravianX Project                                            ##
    ##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
    ##                                                                             ##
    #################################################################################-->

<style>

.day_image {
    background-image: url("../assets/gpack/travian_default/img/l/day.gif");
width: 18px;
height:18px;
}
.night_image {
      background-image: url("../assets/gpack/travian_default/img/l/night.gif");
width: 18px;
height:18px;
}
  #container {
    width: 30px;
    height: 60px;
    position: relative;
  }
  #wrapper > #container {
    display: table;
    position: static;
  }
  #container div {
    position: absolute;
    top: 50%;
  }
  #container div div {
    position: relative;
    top: -50%;
  }
  #container > div {
    display: table-cell;
    vertical-align: middle;
    position: static;
  }
</style>
<div id="header">
    <div id="mtop">
        <a href="{if $userId != 1}dorf1.php{else}#{/if}" id="n1" accesskey="1">
        	<img src="assets/img/x.gif" title="{$smarty.const.VILLAGE_OVERVIEW}" alt="{$smarty.const.VILLAGE_OVERVIEW}"/>
        </a>
        <a href="{if $userId != 1}dorf2.php{else}#{/if}" id="n2" accesskey="2">
        	<img src="assets/img/x.gif" title="{$smarty.const.VILLAGE_CENTER}" alt="{$smarty.const.VILLAGE_CENTER}"/>
        	</a>
        <a href="karte.php" id="n3" accesskey="3">
        	<img src="assets/img/x.gif" title="{$smarty.const.MAP}" alt="{$smarty.const.MAP}" />
        	</a>
        <a href="statistiken.php" id="n4" accesskey="4">
        	<img src="assets/img/x.gif" title="{$smarty.const.STATISTICS}" alt="{$smarty.const.STATISTICS}" />
        </a>
        {if $messageUnread and !$reportUnread}
            {assign var='class' value='i2'}
        {elseif !$messageUnread and $reportUnread}
            {assign var='class' value='i3'}
        {elseif $messageUnread and $reportUnread}
            {assign var='class' value='i1'}
        {else}
            {assign var='class' value='i4'}
        {/if}
          <div id="n5" class="{$class}">
            <a href="{if $userId != 1}berichte.php{else}#{/if}" accesskey="5">
            	<img src="assets/img/x.gif" class="l" title="{$smarty.const.REPORTS}" alt="{$smarty.const.REPORTS}"/>
            </a>
            <a href="nachrichten.php" accesskey="6">
            	<img src="assets/img/x.gif" class="r" title="{$smarty.const.MESSAGES}" alt="{$smarty.const.MESSAGES}"/>
            </a>
        </div>

		{if $userId != 1}
        <a href="plus.php" id="plus">
           <span class="plus_text">
               <span class="plus_g">P</span>
               <span class="plus_o">l</span>
               <span class="plus_g">u</span>
               <span class="plus_o">s</span>
           </span>
           <img src="assets/img/x.gif" id="btn_plus" class="{if $plus}active{else}inactive{/if}" title="{$smarty.const.PLUS_MENU}" alt="{$smarty.const.PLUS_MENU}" />
       </a>
       {/if}

{assign var='hour' value='$smarty.now|date_format:{%H%M}'} 
{if $hour > 1759 or $hour < 500}
	{assign var='dayNightImage' value='night_image'} 
{elseif $hour > 1200}
	{assign var='dayNightImage' value='day_image'} 
{else}
	{assign var='dayNightImage' value='day_image'} 
{/if}

<div id="wrapper">
  <div id="container">
 <div><div><p><img src="assets/img/x.gif" style="display: block; margin: 0 auto; vertical-align:middle;" class="{$dayNightImage}"/></p></div></div>
  </div>
</div>
        <div class="clear"></div>
    </div>
</div>
