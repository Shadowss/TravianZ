<table cellpadding="1" cellspacing="1" class="build_details">
<thead><tr>
    <td><?php echo ACADEMY; ?></td>
	<td><?php echo ACTION; ?></td>
</tr></thead>
<tbody>

<?php 
$fail = $success = 0;
$acares = $technology->grabAcademyRes();
for($i=32;$i<=39;$i++) {
	if($technology->meetRRequirement($i) && !$technology->getTech($i) && !$technology->isResearch($i,1)) {
    	echo "<tr><td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\" title=\"".$technology->getUnitName($i)."\" />
						<a href=\"#\" onClick=\"return Popup(".$i.",1);\">".$technology->getUnitName($i)."</a>
					</div>
					<div class=\"details\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"".LUMBER."\" />".${'r'.$i}['wood']."|<img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"".CLAY."\" />".${'r'.$i}['clay']."|<img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"".IRON."\" />".${'r'.$i}['iron']."|<img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"".CROP."\" />".${'r'.$i}['crop']."|<img class=\"clock\" src=\"img/x.gif\" alt=\"duration\" title=\"".DURATION."\" />";
                    echo $generator->getTimeFormat(round(${'r'.$i}['time'] * ($bid22[$village->resarray['f'.$id]]['attri'] / 100)/SPEED));
                   //-- If available resources combined are not enough, remove NPC button
                   $total_required = (int)(${'r'.$i}['wood'] + ${'r'.$i}['clay'] + ${'r'.$i}['iron'] + ${'r'.$i}['crop']);
                   if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1 && $village->atotal >= $total_required) {
                   echo "|<a href=\"build.php?gid=17&t=3&r1=".${'r'.$i}['wood']."&r2=".${'r'.$i}['clay']."&r3=".${'r'.$i}['iron']."&r4=".${'r'.$i}['crop']."\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
                   }
                   if(${'r'.$i}['wood'] > $village->maxstore || ${'r'.$i}['clay'] > $village->maxstore || ${'r'.$i}['iron'] > $village->maxstore) {
                    echo "<br><span class=\"none\">".EXPAND_WAREHOUSE1."</span></div></td>";
                    echo "<td class=\"none\">
					<div class=\"none\">".EXPAND_WAREHOUSE."</div>
				</td></tr>";
                }
                else if(${'r'.$i}['crop'] > $village->maxcrop) {
                    echo "<br><span class=\"none\">".EXPAND_GRANARY1."</span></div></td>";
                    echo "<td class=\"none\">
					<div class=\"none\">".EXPAND_GRANARY."</div>
				</td></tr>";
                }
                   else if(${'r'.$i}['wood'] > $village->awood || ${'r'.$i}['clay'] > $village->aclay || ${'r'.$i}['iron'] > $village->airon || ${'r'.$i}['crop'] > $village->acrop) {
                   	$time = $technology->calculateAvaliable($i);
                    echo "<br><span class=\"none\">".ENOUGH_RESOURCES." ".$time[0]." at ".$time[1]."</span></div></td>";
                    echo "<td class=\"none\">
					<div class=\"none\">".TOO_FEW_RESOURCES."</div>
				</td></tr>";
                }
                else if ( count($acares) > 0 ) {
                     echo "</td>";
                    echo "<td class=\"none\">
					".RESEARCH_IN_PROGRESS."</td></tr>";
                }
                else if($session->access != BANNED){
                echo "</td>";
                    echo "<td class=\"act\">
					<a class=\"research\" href=\"build.php?id=$id&amp;a=$i&amp;c=".$session->mchecker."\">".RESEARCH."</a></td></tr>";
                }else{
                echo "</td>";
                    echo "<td class=\"act\">
					<a class=\"research\" href=\"banned.php\">".RESEARCH."</a></td></tr>";
					}
                $success += 1;
    }
    else {
    $fail += 1;
    }
}
if($success == 0) {
echo "<td colspan=\"2\"><div class=\"none\" align=\"center\">".RESEARCH_AVAILABLE."</div></td>";
}
?>		
			</tbody>
            </table>
<?php if($fail > 0) { 
	echo "<p class=\"switch\"><a id=\"researchFutureLink\" href=\"#\" onclick=\"return $('researchFuture').toggle();\">".SHOW_MORE."</a></p>
		<table id=\"researchFuture\" class=\"build_details hide\" cellspacing=\"1\" cellpadding=\"1\">
			<thead><tr><td colspan=\"2\">".PREREQUISITES."</td></tr><tbody>";
     if(!$technology->meetRRequirement(33) && !$technology->getTech(33)) {
     echo"<tr><td class=\"desc\"><div class=\"tit\"><img class=\"unit u33\" title=\"".U33."\" alt=\"".U33."\" src=\"img/x.gif\"/>
			<a onclick=\"return Popup(33, 1);\" href=\"#\">".U33."</a></div></td><td class=\"cond\"><a href=\"#\" onclick=\"return Popup(22, 4);\">".ACADEMY." </a>
			<span title=\"+2\">".LEVEL." 3</span><br /><a href=\"#\" onclick=\"return Popup(12, 4);\">".BLACKSMITH." </a><span title=\"+1\">".LEVEL." 1</span>	</td></tr>";
     }
     if(!$technology->meetRRequirement(34) && !$technology->getTech(34)) {
     echo "<tr><td class=\"desc\"><div class=\"tit\"><img class=\"unit u34\" title=\"".U34."\" alt=\"".U34."\" src=\"img/x.gif\"/>
		 	<a onclick=\"return Popup(34, 1);\" href=\"#\">".U34."</a></div></td><td class=\"cond\">
            <a href=\"#\" onclick=\"return Popup(22, 4);\">".ACADEMY." </a><span title=\"+2\">".LEVEL." 1</span><br /><a href=\"#\" onclick=\"return Popup(15, 4);\">".MAINBUILDING."</a>
			<span title=\"+3\">".LEVEL." 5</span>	</td></tr>";
     }
     if(!$technology->meetRRequirement(35) && !$technology->getTech(35)) {
     echo "<tr><td class=\"desc\"><div class=\"tit\"><img class=\"unit u35\" title=\"".U35."\" alt=\"".U35."\" src=\"img/x.gif\"/>
			<a onclick=\"return Popup(35, 1);\" href=\"#\">".U35."</a></div></td><td class=\"cond\">
			<a href=\"#\" onclick=\"return Popup(22, 4);\">".ACADEMY." </a><span title=\"+2\">".LEVEL." 5</span><br /><a href=\"#\" onclick=\"return Popup(20, 4);\">".STABLE." </a>
			<span title=\"+5\">".LEVEL." 5</span>	</td></tr>";
     }
     if(!$technology->meetRRequirement(36) && !$technology->getTech(36)) {
     echo "<tr><td class=\"desc\"><div class=\"tit\"><img class=\"unit u36\" title=\"".U36."\" alt=\"".U36."\" src=\"img/x.gif\"/>
			<a onclick=\"return Popup(36, 1);\" href=\"#\">".U36."</a></div></td><td class=\"cond\">
			<a href=\"#\" onclick=\"return Popup(22, 4);\">".ACADEMY." </a><span title=\"+2\">".LEVEL." 15</span><br /><a href=\"#\" onclick=\"return Popup(20, 4);\">
            ".STABLE." </a><span title=\"+3\">".LEVEL." 10</span>	</td></tr>";
     }
     if(!$technology->meetRRequirement(17) && !$technology->getTech(17)) {
     echo "
			<tr><td class=\"desc\"><div class=\"tit\"><img class=\"unit u37\" title=\"".U37."\" alt=\"".U37."\" src=\"img/x.gif\"/>
			<a onclick=\"return Popup(37, 1);\" href=\"#\">".U37."</a></div></td><td class=\"cond\"><a href=\"#\" onclick=\"return Popup(22, 4);\">".ACADEMY." </a>
			<span title=\"+7\">".LEVEL." 10</span><br /><a href=\"#\" onclick=\"return Popup(21, 4);\">".WORKSHOP." </a><span title=\"+1\">".LEVEL." 1</span></td></tr>";
     }
     if(!$technology->meetRRequirement(38) && !$technology->getTech(38)) {
     echo "<tr><td class=\"desc\"><div class=\"tit\"><img class=\"unit u38\" title=\"".U38."\" alt=\"".U38."\" src=\"img/x.gif\"/>
            <a onclick=\"return Popup(38, 1);\" href=\"#\">".U38."</a></div></td><td class=\"cond\"><a href=\"#\" onclick=\"return Popup(21, 4);\">".WORKSHOP."</a>
            <span title=\"+10\">".LEVEL." 10</span><br /><a href=\"#\" onclick=\"return Popup(22, 4);\">".ACADEMY." </a><span title=\"+12\">".LEVEL." 15</span>	</td>
			</tr>";
     }
     if(!$technology->meetRRequirement(39) && !$technology->getTech(39)) {
     echo "	<tr><td class=\"desc\"><div class=\"tit\"><img class=\"unit u39\" title=\"".U33."\" alt=\"".U33."\" src=\"img/x.gif\"/>
			<a onclick=\"return Popup(39, 1);\" href=\"#\">".U39."</a></div></td><td class=\"cond\">
			<a href=\"#\" onclick=\"return Popup(16, 4);\">".RALLYPOINT." </a><span title=\"+4\">".LEVEL." 5</span><br /><a href=\"#\" onclick=\"return Popup(22, 4);\">
            ".ACADEMY." </a><span title=\"+17\">".LEVEL." 20</span></td></tr>";
     }
     echo " <script type=\"text/javascript\">
		//<![CDATA[
			$(\"researchFuture\").toggle = (function()
			{
				this.toggleClass(\"hide\");

				$(\"researchFutureLink\").set(\"text\",
					this.hasClass(\"hide\")
					?	\"".SHOW_MORE."\"
					:	\"".HIDE_MORE."\"
				);

				return false;
			}).bind($(\"researchFuture\"));
		//]]>
		</script>";
     echo "</tbody></table>";
}
//$acares = $technology->grabAcademyRes();
if(count($acares) > 0) {
	echo "<table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\"><thead><tr><td>".RESEARCHING."</td><td>".DURATION."</td><td>".COMPLETE."</td></tr>
	</thead><tbody>";
	foreach($acares as $aca) {
		$unit = substr($aca['tech'],1,2);
		echo "<tr><td class=\"desc\"><img class=\"unit u$unit\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($unit)."\" title=\"".$technology->getUnitName($unit)."\" />".$technology->getUnitName($unit)."</td>";
		echo "<td class=\"dur\"><span id=\"timer".++$session->timer."\">".$generator->getTimeFormat($aca['timestamp']-time())."</span></td>";
		$date = $generator->procMtime($aca['timestamp']);
		echo "<td class=\"fin\"><span>".$date[1]."</span><span> hrs</span></td>";
		echo "</tr>";
	}
	echo "</tbody></table>";
}
?>
