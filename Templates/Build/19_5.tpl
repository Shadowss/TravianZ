<?php
echo "<tr><td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u11\" src=\"img/x.gif\" alt=\"Clubswinger\" title=\"Pikemanm\" />
						<a href=\"#\" onClick=\"return Popup(11,1);\"> Clubswinger</a> <span class=\"info\">(Available: ".$village->unitarray['u41'].")</span>
					</div>
					<div class=\"details\">
						<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />95|<img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />75|<img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />40|<img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />40|<img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />1|<img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />";
				echo $generator->getTimeFormat(round($u11['time'] * ($bid19[$village->resarray['f'.$id]]['attri'] / 100) / SPEED));
				echo "</div>
				</td>
				<td class=\"val\"><input type=\"text\" class=\"text\" name=\"t11\" value=\"0\" maxlength=\"4\"></td>
				<td class=\"max\"><a href=\"#\" onClick=\"document.snd.t11.value=".$technology->maxUnit(11)."; return false;\">(".$technology->maxUnit(11).")</a></td></tr></tbody>
				";
                if($technology->getTech(12)) {
                echo "<tr><td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u12\" src=\"img/x.gif\" alt=\"Spearman\" title=\"Spearman\" />
						<a href=\"#\" onClick=\"return Popup(12,1);\"> Spearman</a> <span class=\"info\">(Available: ".$village->unitarray['u12'].")</span>
					</div>
					<div class=\"details\">
						<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />145|<img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />70|<img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />85|<img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />40|<img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />1|<img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />";
				echo $generator->getTimeFormat(round($u12['time'] * ($bid19[$village->resarray['f'.$id]]['attri'] / 100) / SPEED));
				echo "</div>
				</td>
				<td class=\"val\"><input type=\"text\" class=\"text\" name=\"t12\" value=\"0\" maxlength=\"4\"></td>
				<td class=\"max\"><a href=\"#\" onClick=\"document.snd.t12.value=".$technology->maxUnit(12)."; return false;\">(".$technology->maxUnit(12).")</a></td></tr></tbody>
				";
                }
                if($technology->getTech(13)){
                echo "<tr><td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u13\" src=\"img/x.gif\" alt=\"Axeman\" title=\"Axeman\" />
						<a href=\"#\" onClick=\"return Popup(13,1);\"> Axeman</a> <span class=\"info\">(Available: ".$village->unitarray['u13'].")</span>
					</div>
					<div class=\"details\">
						<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />130|<img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />120|<img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />170|<img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />70|<img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />1|<img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />";
				echo $generator->getTimeFormat(round($u13['time'] * ($bid19[$village->resarray['f'.$id]]['attri'] / 100) / SPEED));
				echo "</div>
				</td>
				<td class=\"val\"><input type=\"text\" class=\"text\" name=\"t13\" value=\"0\" maxlength=\"4\"></td>
				<td class=\"max\"><a href=\"#\" onClick=\"document.snd.t13.value=".$technology->maxUnit(13)."; return false;\">(".$technology->maxUnit(13).")</a></td></tr></tbody>
				";
                }
                if($technology->getTech(14)) {
                echo "<tr><td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u14\" src=\"img/x.gif\" alt=\"Scout\" title=\"Scout\" />
						<a href=\"#\" onClick=\"return Popup(14,1);\"> Scout</a> <span class=\"info\">(Available: ".$village->unitarray['u14'].")</span>
					</div>
					<div class=\"details\">
						<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />160|<img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />100|<img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />50|<img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />50|<img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />1|<img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />";
				echo $generator->getTimeFormat(round($u14['time'] * ($bid19[$village->resarray['f'.$id]]['attri'] / 100) / SPEED));
				echo "</div>
				</td>
				<td class=\"val\"><input type=\"text\" class=\"text\" name=\"t14\" value=\"0\" maxlength=\"4\"></td>
				<td class=\"max\"><a href=\"#\" onClick=\"document.snd.t14.value=".$technology->maxUnit(14)."; return false;\">(".$technology->maxUnit(14).")</a></td></tr></tbody>
				";
}
?>