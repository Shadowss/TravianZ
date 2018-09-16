<!DOCTYPE html>
<html>
{include file={$smarty.const.TEMPLATES_DIR}|cat:'base/head.tpl'}

<body class="v35 ie ie7" onload="initCounter()">
	<div class="wrapper">
		<div id="dynamic_header"></div>
		<div id="header"></div>
		<div id="mid">

			{include file={$smarty.const.TEMPLATES_DIR}|cat:'base/menu.tpl'}
			{include file=$templateToRender}

			<div id="side_info" class="outgame">
			{include file={$smarty.const.TEMPLATES_DIR}|cat:'base/news.tpl'}
			</div>
			<div class="clear"></div>
		</div>

		<div class="footer-stopper outgame"></div>
		<div class="clear"></div>
		{include file={$smarty.const.TEMPLATES_DIR}|cat:'base/footer.tpl'}
		<div id="ce"></div>
	</div>
</body>
</html>