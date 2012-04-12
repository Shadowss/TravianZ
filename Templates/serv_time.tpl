
<div id="stime">
<div id="ltime">
<div id="ltimeWrap">
<?php 
echo CALCULATED_IN."&nbsp;<b>";
echo round(($generator->pageLoadTimeEnd()-$start)*1000);
echo "</b>&nbsp;".MILISECS."<br />\n";
echo SERVER_TIME.'<span id="tp1" class="b">'.date('H:i:s').'</span>';
?>
</div>
	</div>
</div>