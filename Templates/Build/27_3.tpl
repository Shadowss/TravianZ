<body>
    <div id="build" class="gid27">
        <a href="#" onclick="return Popup(27,4);" class="build_logo"><img class="building g27" src="img/x.gif" alt="Treasury" title="<?php echo TREASURY; ?>"></a>

        <h1><?php echo TREASURY; ?> <span class="level"><?php echo LEVEL; ?> <?php

        echo $Account->resarray['f' . $id];

?></span></h1>

        <p class="build_desc"><?php echo TREASURY_DESC; ?></p>
        
        <?php

        include ("27_menu.tpl");

?>
        
        <table id="show_artefacts" cellpadding="1" cellspacing="1">
    		<thead>
    			<tr>
			    	<th colspan="4"><?php echo LARGE_ARTIFACTS; ?></th>
    			</tr>
    			<tr>
    				<td></td>
	    			<td><?php echo NAME; ?></td>
	    			<td><?php echo PLAYER; ?></td>
	    			<td><?php echo ALLIANCE; ?></td>
    			</tr>
    		</thead>
    		<tbody>
            <?php

            $artifactsArray = $database->getArtifactsBysize([2, 3]);
            if(count($artifactsArray) == 0) {
                echo '<td colspan="4" class="none">'.NO_ARTIFACTS.'</td>';
            } else {    
                $previous = "";
                foreach($artifactsArray as $artifact){
                    
                    if($previous != "" && $previous != $artifact['type']) echo '<tr><td colspan="4"></td></tr>';
                    $previous = $artifact['type'];
                    
                    echo '<tr>
                              <td class="icon"><img class="artefact_icon_'.$artifact['type'].'" src="img/x.gif" alt="" title=""></td>
                              <td class="nam">
                                  <a href="build.php?id='.$id.'&show='.$artifact['id'].'">'.$artifact['name'] . '</a> <span class="bon">'.$artifact['effect'].'</span><div class="info">'.TREASURY.' <b>20</b>, '.EFFECT.' <b>'.ACCOUNT.'</b></div>
                              </td>
                              <td class="pla"><a href="karte.php?d='.$artifact['vref'].'&c='.$generator->getMapCheck($artifact['vref']).'">'.$database->getUserField($artifact['owner'], "username", 0).'</a></td>
                              <td class="al"><a href="allianz.php?aid='.$database->getUserField($artifact['owner'], "alliance", 0).'">'.$database->getAllianceName($database->getUserField($artifact['owner'], "alliance", 0)).'</a></td>
                          </tr>';                 
                }
            }
?>
    	</tbody></table>
        
        <?php

        	include ("upgrade.tpl");

?>
        
</div>
