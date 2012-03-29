<?php 
  
    for ($i=($session->tribe-1)*10+1;$i<=($session->tribe-1)*10+4;$i++) {
        if ($i <> 4 && $i <> 23 && $i <> 24 && ($technology->getTech($i) || $i%10 == 1)) {
  
echo "<tr><td class=\"desc\">
<div class=\"tit\">
<img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\" title=\"".$technology->getUnitName($i)."\" />
<a href=\"#\" onClick=\"return Popup(".$i.",1);\"> ".$technology->getUnitName($i)."</a> <span class=\"info\">(Available: ".$village->unitarray['u'.$i].")</span>
</div>
<div class=\"details\">
<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />".(${'u'.$i}['wood'])."|<img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".(${'u'.$i}['clay'])."|<img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".(${'u'.$i}['iron'])."|<img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".(${'u'.$i}['crop'])."|<img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />".${'u'.$i}['pop']."|<img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />";
$dur=$generator->getTimeFormat(round(${'u'.$i}['time'] * ($bid19[$village->resarray['f'.$id]]['attri'] / 100) / SPEED)); 
echo ($dur=="0:00:00")? "0:00:01":$dur;
if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1) {
                   echo "|<a href=\"build.php?gid=17&t=3&r1=".((${'u'.$i}['wood'])*$technology->maxUnitPlus($i))."&r2=".((${'u'.$i}['clay'])*$technology->maxUnitPlus($i))."&r3=".((${'u'.$i}['iron'])*$technology->maxUnitPlus($i))."&r4=".((${'u'.$i}['crop'])*$technology->maxUnitPlus($i))."\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
                 } 
echo "</div>
</td>
<td class=\"val\"><input type=\"text\" class=\"text\" name=\"t".$i."\" value=\"0\" maxlength=\"4\"></td>
<td class=\"max\"><a href=\"#\" onClick=\"document.snd.t".$i.".value=".$technology->maxUnit($i,false)."; return false;\">(".$technology->maxUnit($i,false).")</a></td></tr></tbody>";
		}
    }
?>
