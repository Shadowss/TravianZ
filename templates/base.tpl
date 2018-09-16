<!DOCTYPE html>
<html>
{include file={$smarty.const.TEMPLATES_DIR}|cat:'base/head.tpl'}
<body class="v35 ie ie8">
	<div class="wrapper">
		<img style="filter: chroma();" src="assets/img/x.gif" id="msfilter"
			alt="" />
		<div id="dynamic_header"></div>
		{include file={$smarty.const.TEMPLATES_DIR}|cat:'base/header.tpl'}
		<div id="mid">
			{include file={$smarty.const.TEMPLATES_DIR}|cat:'base/menu.tpl'}
			
			{* Template content *}
			{include file=$templateToRender}

			<br /><br /><br /><br />
			
			<div id="side_info">
			
				{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/multivillage.tpl'}
				{*include file={$smarty.const.TEMPLATES_DIR}|cat:'base/quest.tpl'*}
				{include file={$smarty.const.TEMPLATES_DIR}|cat:'base/news.tpl'}

			</div>

			<div class="clear"></div>
			{include file={$smarty.const.TEMPLATES_DIR}|cat:'base/footer.tpl'}
		</div>
		<div class="clear"></div>
		
		{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/res.tpl'}
		{include file={$smarty.const.TEMPLATES_DIR}|cat:'base/time.tpl'}

	</div>
	<div id="ce"></div>
</body>
</html>
