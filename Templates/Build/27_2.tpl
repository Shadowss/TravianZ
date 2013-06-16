<body>
    <div id="build" class="gid27">
        <a href="#" onclick="return Popup(27,4);" class="build_logo"><img class="building g27" src="img/x.gif" alt="Treasury" title="Treasury"></a>

        <h1>Treasury <span class="level">Level <?php

        echo $village->resarray['f' . $id];

?></span></h1>

        <p class="build_desc">The riches of your empire are kept in the treasury. The treasury has room for one treasure. After you have captured an artefact it takes 24 hours on a normal server or 12 hours on a thrice speed server to be effective.</p>
        
        <?php

        include ("27_menu.tpl");

?>
        
        <table id="show_artefacts" cellpadding="1" cellspacing="1">
    		<thead>
    			<tr>
			    	<th colspan="4">Small artefacts</th>
    			</tr>
    			<tr>
    				<td></td>
	    			<td>Name</td>
	    			<td>Player</td>
	    			<td>Alliance</td>
    			</tr>
    		</thead>
    		<tbody>
            <?php

        if(mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "artefacts")) == 0) {
        	echo '<td colspan="4" class="none">There is no artefacts.</td>';
        } else {


        	$artefact = mysql_query("SELECT * FROM `" . TB_PREFIX . "artefacts` WHERE size = 1 AND type = 1");
        	while($row = mysql_fetch_array($artefact)) {
        		echo '<tr>';
        		echo '<td class="icon"><img class="artefact_icon_' . $row['type'] . '" src="img/x.gif" alt="" title=""></td>';
        		echo '<td class="nam">';
        		echo '<a href="build.php?id=' . $id . '&show='.$row['id'].'">' . $row['name'] . '</a> <span class="bon">' . $row['effect'] . '</span><div class="info">Treasury <b>10</b>, Effect <b>Village</b></div>';
        		echo '</td>';
        		echo '<td class="pla"><a href="karte.php?d=' . $row['vref'] . '&c=' . $generator->getMapCheck($row['vref']) . '">' . $database->getUserField($row['owner'], "username", 0) . '</a></td>';
        		echo '<td class="al"><a href="allianz.php?aid=' . $database->getUserField($row['owner'], "alliance", 0) . '">' . $database->getAllianceName($database->getUserField($row['owner'], "alliance", 0)) . '</a></td>';
        		echo '</tr>';
        	}

?>
            <tr><td colspan="4"></td></tr>
            
            
            <?php

        	unset($artefact);
        	unset($row);
        	$artefact = mysql_query("SELECT * FROM `" . TB_PREFIX . "artefacts` WHERE size = 1 AND type = 2");
        	while($row = mysql_fetch_array($artefact)) {
        		echo '<tr>';
        		echo '<td class="icon"><img class="artefact_icon_' . $row['type'] . '" src="img/x.gif" alt="" title=""></td>';
        		echo '<td class="nam">';
        		echo '<a href="build.php?id=' . $id . '&show='.$row['id'].'">' . $row['name'] . '</a> <span class="bon">' . $row['effect'] . '</span><div class="info">Treasury <b>10</b>, Effect <b>Village</b></div>';
        		echo '</td>';
        		echo '<td class="pla"><a href="karte.php?d=' . $row['vref'] . '&c=' . $generator->getMapCheck($row['vref']) . '">' . $database->getUserField($row['owner'], "username", 0) . '</a></td>';
        		echo '<td class="al"><a href="allianz.php?aid=' . $database->getUserField($row['owner'], "alliance", 0) . '">' . $database->getAllianceName($database->getUserField($row['owner'], "alliance", 0)) . '</a></td>';
        		echo '</tr>';
        	}

?>
            <tr><td colspan="4"></td></tr>
            
            
            <?php

        	unset($artefact);
        	unset($row);
        	$artefact = mysql_query("SELECT * FROM `" . TB_PREFIX . "artefacts` WHERE size = 1 AND type = 3");
        	while($row = mysql_fetch_array($artefact)) {
        		echo '<tr>';
        		echo '<td class="icon"><img class="artefact_icon_' . $row['type'] . '" src="img/x.gif" alt="" title=""></td>';
        		echo '<td class="nam">';
        		echo '<a href="build.php?id=' . $id . '&show='.$row['id'].'">' . $row['name'] . '</a> <span class="bon">' . $row['effect'] . '</span><div class="info">Treasury <b>10</b>, Effect <b>Village</b></div>';
        		echo '</td>';
        		echo '<td class="pla"><a href="karte.php?d=' . $row['vref'] . '&c=' . $generator->getMapCheck($row['vref']) . '">' . $database->getUserField($row['owner'], "username", 0) . '</a></td>';
        		echo '<td class="al"><a href="allianz.php?aid=' . $database->getUserField($row['owner'], "alliance", 0) . '">' . $database->getAllianceName($database->getUserField($row['owner'], "alliance", 0)) . '</a></td>';
        		echo '</tr>';
        	}

?>
            <tr><td colspan="4"></td></tr>
            
            
            <?php

        	unset($artefact);
        	unset($row);
        	$artefact = mysql_query("SELECT * FROM `" . TB_PREFIX . "artefacts` WHERE size = 1 AND type = 4");
        	while($row = mysql_fetch_array($artefact)) {
        		echo '<tr>';
        		echo '<td class="icon"><img class="artefact_icon_' . $row['type'] . '" src="img/x.gif" alt="" title=""></td>';
        		echo '<td class="nam">';
        		echo '<a href="build.php?id=' . $id . '&show='.$row['id'].'">' . $row['name'] . '</a> <span class="bon">' . $row['effect'] . '</span><div class="info">Treasury <b>10</b>, Effect <b>Village</b></div>';
        		echo '</td>';
        		echo '<td class="pla"><a href="karte.php?d=' . $row['vref'] . '&c=' . $generator->getMapCheck($row['vref']) . '">' . $database->getUserField($row['owner'], "username", 0) . '</a></td>';
        		echo '<td class="al"><a href="allianz.php?aid=' . $database->getUserField($row['owner'], "alliance", 0) . '">' . $database->getAllianceName($database->getUserField($row['owner'], "alliance", 0)) . '</a></td>';
        		echo '</tr>';
        	}

?>
            <tr><td colspan="4"></td></tr>
            
            <?php

        	unset($artefact);
        	unset($row);
        	$artefact = mysql_query("SELECT * FROM `" . TB_PREFIX . "artefacts` WHERE size = 1 AND type = 5");
        	while($row = mysql_fetch_array($artefact)) {
        		echo '<tr>';
        		echo '<td class="icon"><img class="artefact_icon_' . $row['type'] . '" src="img/x.gif" alt="" title=""></td>';
        		echo '<td class="nam">';
        		echo '<a href="build.php?id=' . $id . '&show='.$row['id'].'">' . $row['name'] . '</a> <span class="bon">' . $row['effect'] . '</span><div class="info">Treasury <b>10</b>, Effect <b>Village</b></div>';
        		echo '</td>';
        		echo '<td class="pla"><a href="karte.php?d=' . $row['vref'] . '&c=' . $generator->getMapCheck($row['vref']) . '">' . $database->getUserField($row['owner'], "username", 0) . '</a></td>';
        		echo '<td class="al"><a href="allianz.php?aid=' . $database->getUserField($row['owner'], "alliance", 0) . '">' . $database->getAllianceName($database->getUserField($row['owner'], "alliance", 0)) . '</a></td>';
        		echo '</tr>';
        	}

?>
            <tr><td colspan="4"></td></tr>
            
            <?php

        	unset($artefact);
        	unset($row);
        	$artefact = mysql_query("SELECT * FROM `" . TB_PREFIX . "artefacts` WHERE size = 1 AND type = 6");
        	while($row = mysql_fetch_array($artefact)) {
        		echo '<tr>';
        		echo '<td class="icon"><img class="artefact_icon_' . $row['type'] . '" src="img/x.gif" alt="" title=""></td>';
        		echo '<td class="nam">';
        		echo '<a href="build.php?id=' . $id . '&show='.$row['id'].'">' . $row['name'] . '</a> <span class="bon">' . $row['effect'] . '</span><div class="info">Treasury <b>10</b>, Effect <b>Village</b></div>';
        		echo '</td>';
        		echo '<td class="pla"><a href="karte.php?d=' . $row['vref'] . '&c=' . $generator->getMapCheck($row['vref']) . '">' . $database->getUserField($row['owner'], "username", 0) . '</a></td>';
        		echo '<td class="al"><a href="allianz.php?aid=' . $database->getUserField($row['owner'], "alliance", 0) . '">' . $database->getAllianceName($database->getUserField($row['owner'], "alliance", 0)) . '</a></td>';
        		echo '</tr>';
        	}

?>
            <tr><td colspan="4"></td></tr>
            
            <?php

        	unset($artefact);
        	unset($row);
        	$artefact = mysql_query("SELECT * FROM `" . TB_PREFIX . "artefacts` WHERE size = 1 AND type = 7");
        	while($row = mysql_fetch_array($artefact)) {
        		echo '<tr>';
        		echo '<td class="icon"><img class="artefact_icon_' . $row['type'] . '" src="img/x.gif" alt="" title=""></td>';
        		echo '<td class="nam">';
        		echo '<a href="build.php?id=' . $id . '&show='.$row['id'].'">' . $row['name'] . '</a> <span class="bon">' . $row['effect'] . '</span><div class="info">Treasury <b>10</b>, Effect <b>Village</b></div>';
        		echo '</td>';
        		echo '<td class="pla"><a href="karte.php?d=' . $row['vref'] . '&c=' . $generator->getMapCheck($row['vref']) . '">' . $database->getUserField($row['owner'], "username", 0) . '</a></td>';
        		echo '<td class="al"><a href="allianz.php?aid=' . $database->getUserField($row['owner'], "alliance", 0) . '">' . $database->getAllianceName($database->getUserField($row['owner'], "alliance", 0)) . '</a></td>';
        		echo '</tr>';
        	}

?>
            <tr><td colspan="4"></td></tr>
            
            <?php

        	unset($artefact);
        	unset($row);
        	$artefact = mysql_query("SELECT * FROM `" . TB_PREFIX . "artefacts` WHERE size = 2 AND type = 8");
        	while($row = mysql_fetch_array($artefact)) {
        		echo '<tr>';
        		echo '<td class="icon"><img class="artefact_icon_' . $row['type'] . '" src="img/x.gif" alt="" title=""></td>';
        		echo '<td class="nam">';
        		echo '<a href="build.php?id=' . $id . '&show='.$row['id'].'">' . $row['name'] . '</a> <span class="bon">' . $row['effect'] . '</span><div class="info">Treasury <b>10</b>, Effect <b>Account</b></div>';
        		echo '</td>';
        		echo '<td class="pla"><a href="karte.php?d=' . $row['vref'] . '&c=' . $generator->getMapCheck($row['vref']) . '">' . $database->getUserField($row['owner'], "username", 0) . '</a></td>';
        		echo '<td class="al"><a href="allianz.php?aid=' . $database->getUserField($row['owner'], "alliance", 0) . '">' . $database->getAllianceName($database->getUserField($row['owner'], "alliance", 0)) . '</a></td>';
        		echo '</tr>';
        	}

        	unset($artefact);
        	unset($row);
        	$artefact = mysql_query("SELECT * FROM `" . TB_PREFIX . "artefacts` WHERE size = 1 AND type = 8");
        	while($row = mysql_fetch_array($artefact)) {
        		echo '<tr>';
        		echo '<td class="icon"><img class="artefact_icon_' . $row['type'] . '" src="img/x.gif" alt="" title=""></td>';
        		echo '<td class="nam">';
        		echo '<a href="build.php?id=' . $id . '&show='.$row['id'].'">' . $row['name'] . '</a> <span class="bon">' . $row['effect'] . '</span><div class="info">Treasury <b>10</b>, Effect <b>Village</b></div>';
        		echo '</td>';
        		echo '<td class="pla"><a href="karte.php?d=' . $row['vref'] . '&c=' . $generator->getMapCheck($row['vref']) . '">' . $database->getUserField($row['owner'], "username", 0) . '</a></td>';
        		echo '<td class="al"><a href="allianz.php?aid=' . $database->getUserField($row['owner'], "alliance", 0) . '">' . $database->getAllianceName($database->getUserField($row['owner'], "alliance", 0)) . '</a></td>';
        		echo '</tr>';
        	}

?>
            <tr><td colspan="4"></td></tr>
        <?php

        }

?>
            
    	</tbody></table></div>
        
        <?php

        include ("upgrade.tpl");

?>
        
</div>