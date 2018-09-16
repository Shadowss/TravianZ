<!--/** --------------------------------------------------- **\
    | ********* DO NOT REMOVE THIS COPYRIGHT NOTICE ********* |
    +---------------------------------------------------------+
    | Credits:     All the developers including the leaders:  |
    |              Advocaite & Dzoki & Donnchadh              |
    |                                                         |
    | Copyright:   TravianX Project All rights reserved       |
    \** --------------------------------------------------- **/-->
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        div.c1 
        {
            text-align: center
        }
    </style>
</head>
<body>
	{if !$isLoggedIn}
    	<div id="side_navi">
        	<a id="logo" href="{$smarty.const.HOMEPAGE}"><img src="assetsimg/x.gif" alt="{$smarty.const.SERVER_NAME}"></a>
        	<p><a href="{$smarty.const.HOMEPAGE}">{$smarty.const.HOME}</a> <a href="login.php">{$smarty.const.LOGIN}</a> <a href="anmelden.php">{$smarty.const.REG}</a></p>
    	</div>
	{else}
    <div id="side_navi">
        <a id="logo" href="{$smarty.const.HOMEPAGE}"><img src="assets/img/x.gif" {if $plus}class="logo_plus"{/if} alt="{$smarty.const.SERVER_NAME}"></a>
        <p><a href="{$smarty.const.HOMEPAGE}">{$smarty.const.HOME}</a><a href="spieler.php?uid={$userId}">{$smarty.const.PROFILE}</a> 
        <a href="#" onclick="return Popup(0, 0, 1);">{$smarty.const.INSTRUCT}</a>
        
        {if $access == $smarty.const.MULTIHUNTER}
        	<a href="Admin/admin.php"><font color="Blue">Multihunter Panel</font></a>       
        {/if}

		{if $access == $smarty.const.ADMIN}
        	<a href="Admin/admin.php"><font color="Red">{$smarty.const.ADMIN_PANEL}</font></a>
            <a href="massmessage.php">{$smarty.const.MASS_MESSAGE}</a>
            <a href="sysmsg.php">{$smarty.const.SYSTEM_MESSAGE}</a>
		{/if}
		
        <a href="logout.php">{$smarty.const.LOGOUT}</a></p>

        {if $userId != 1}
        	<p>
            	<a href="plus.php?id=3">{$smarty.const.SERVER_NAME}<b> <span class="plus_g">P</span><span class="plus_o">l</span><span class="plus_g">u</span><span class="plus_o">s</span></b></a>
        	</p>
		{/if}

        <p>
       		<a href="allianz.php?s=2"><b>{$smarty.const.FORUM}</b></a>
            <a href="rules.php"><b>{$smarty.const.GAME_RULES}</b></a>
            {if $userId != 1}
            	<a href="spieler.php?uid=1"><b>{$smarty.const.SUPPORT}</b></a>
            {/if}

           	{include file={$smarty.const.TEMPLATES_DIR}|cat:'base/links.tpl'}
            {include file={$smarty.const.TEMPLATES_DIR}|cat:'base/natars.tpl'}
        </p>
        
        {if $deletingTimestamp}
			<br />
			<div class="count">
		
			{if $deletingTimestamp > ($smarty.now + 172800)}
				<a href="spieler.php?s=3&id={$userId}&a=1&e=4">
					<img class="del" src="assets/img/x.gif" alt="Cancel process" title="Cancel process"/> 
				</a>";
			{/if}

		  	<a href="spieler.php?s=3"> The account will be deleted in 
                <span class="timer">{($deletingTimestamp - $smarty.now)|date_format:'%H:%M:%S'}</span>
            </a>
        	</div>
        	<br />
		{/if}

    </div>

    {if $ok == 1}

    <div id="content" class="village1">
        <h1>{$smarty.const.ANNOUNCEMENT}</h1>
		<br />
        <h3>Hi {$userName},</h3>
      		{include file={$smarty.const.TEMPLATES_DIR}|cat:'text.tpl'}
        <div class="c1">
		<br />
            <h3><a href="dorf1.php?ok">&raquo; {$smarty.const.GO2MY_VILLAGE}</a></h3>
        </div>
    </div>

    <br /><br /><br /><br />
    <div id="side_info">
        {include file={$smarty.const.TEMPLATES_DIR}|cat:'village/multivillage.tpl'}
        {include file={$smarty.const.TEMPLATES_DIR}|cat:'base/quest.tpl'}
        {include file={$smarty.const.TEMPLATES_DIR}|cat:'base/news.tpl'}       
    </div>

    <div class="clear"></div>

    <div class="footer-stopper"></div>

    <div class="clear"></div>
    	{include file={$smarty.const.TEMPLATES_DIR}|cat:'base/footer.tpl'}
    	{include file={$smarty.const.TEMPLATES_DIR}|cat:'base/res.tpl'}
    <div id="stime">
        <div id="ltime">
            <div id="ltimeWrap">
                {$smarty.const.CALCULATED_IN}
                <b>{$pageLoadTime}</b> ms
				<br />{$smarty.const.SEVER_TIME} <span id="tp1" class="b">{$smarty.now|date_format:$config.time}</span>
            </div>
        </div>
    </div>

    <div id="ce"></div>
    {/if}
    {/if}
</body>
</html>