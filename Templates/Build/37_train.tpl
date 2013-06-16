<?php
/*============================+
+ Travian File: 37_train.tpl  +
+ Developed by vnnbot.net     +
+=============================*/
			$artefact = count($database->getOwnUniqueArtefactInfo2($session->uid,5,3,0));
			$artefact1 = count($database->getOwnUniqueArtefactInfo2($village->wid,5,1,1));
			$artefact2 = count($database->getOwnUniqueArtefactInfo2($session->uid,5,2,0));
			if($artefact > 0){
			$artefact_bonus = 2;
			$artefact_bonus2 = 1;
			}else if($artefact1 > 0){
			$artefact_bonus = 2;
			$artefact_bonus2 = 1;
			}else if($artefact2 > 0){
			$artefact_bonus = 4;
			$artefact_bonus2 = 3;
			}else{
			$artefact_bonus = 1;
			$artefact_bonus2 = 1;
			}

//check if there is unit needed in the village

$result = mysql_query("SELECT * FROM ".TB_PREFIX."units WHERE `vref` = ".$village->wid."");
$units = mysql_fetch_array($result);

$output="<table cellpadding=1 cellspacing=1 class=\"build_details\">
        <thead>
            <tr>
                <th colspan=2>Train New Hero</th>
            </tr>
        </thead>";
        
if($session->tribe == 1) {
    $output.=" <tr>
                <td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u1\" src=\"img/x.gif\" alt=\"".U1."\" title=\"".U1."\" />
						".U1."
					</div>
					<div class=\"details\">
						<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />".$u1['wood']."|
                        <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$u1['clay']."|
                        <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$u1['iron']."|
                        <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$u1['crop']."|
                        <img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />6|
                        <img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />";
     $output.=$generator->getTimeFormat(round($u1['time'] / SPEED * $artefact_bonus2 / $artefact_bonus)*3);
     $output.="</div>
				</td>
				
                <td class=\"val\" width=\"20%\"><center>";

                
    if($village->awood < $u1['wood'] || $village->aclay < $u1['clay'] || $village->airon < $u1['iron'] || $village->acrop < $u1['crop'])      
        $output.="<span class=\"none\">Not enough resources</span>";    
    elseif($units['u1'] == 0) 
        $output.="<span class=\"none\">Not available units</span>";      
    else $output.="<a href=\"build.php?id=".$id."&train=1\">Train</a>";
        
    
    $output.="</center></td>
</tr>";
  
        
    
    if($database->checkIfResearched($village->wid, 't2') != 0){ 
        $output.="<tr>
                    <td class=\"desc\">
        				<div class=\"tit\">
        					<img class=\"unit u2\" src=\"img/x.gif\" alt=\"".U2."\" title=\"".U2."\" />
        					".U2."
        				</div>
        				<div class=\"details\">
        					<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />".$u2['wood']."|
                            <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$u2['clay']."|
                            <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$u2['iron']."|
                            <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$u2['crop']."|
                            <img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />6|
                            <img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />";
        $output.=$generator->getTimeFormat(round($u2['time'] / SPEED * $artefact_bonus2 / $artefact_bonus)*3);
        
        $output.="</div>
        				</td>
        				
                        <td class=\"val\" width=\"20%\"><center>";
                        
        if($village->awood < $u2['wood'] OR $village->aclay < $u2['clay'] OR $village->airon < $u2['iron'] OR $village->acrop < $u2['crop']) 
           $output.="<span class=\"none\">Not enough resources</span>"; 
        elseif($units['u2'] == 0)
            $output.="<span class=\"none\">Not available units</span>"; 
        else 
            $output.="<a href=\"build.php?id=".$id."&train=2\">Train</a>";
                         
        $output.="</center></td>
                    </tr>";
    } 
        
    if($database->checkIfResearched($village->wid, 't3') != 0){
            
        $output.="<tr>
                        <td class=\"desc\">
        					<div class=\"tit\">
        						<img class=\"unit u3\" src=\"img/x.gif\" alt=\"".U3."\" title=\"".U3."\" />
        						".U3."
        					</div>
        					<div class=\"details\">
        						<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />".$u3['wood']."|
                                <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$u3['clay']."|
                                <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$u3['iron']."|
                                <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$u3['crop']."|
                                <img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />6|
                                <img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />";
                                
         $output.=  $generator->getTimeFormat(round($u3['time'] / SPEED * $artefact_bonus2 / $artefact_bonus)*3);
        
        $output.= "</div>
        				</td>
        				
                        <td class=\"val\" width=\"20%\"><center>";
        
        if($village->awood < $u3['wood'] OR $village->aclay < $u3['clay'] OR $village->airon < $u3['iron'] OR $village->acrop < $u3['crop']) { 
            $output.="<span class=\"none\">Not enough resources</span>"; 
        }else if($units['u3'] == 0){ 
            $output.="<span class=\"none\">Not available units</span>"; 
        }else {
            $output.="<a href=\"build.php?id=".$id."&train=3\">Train</a>";
        }  
                 "</center></td>
                    </tr> " ;     
    }         
    
    if($database->checkIfResearched($village->wid, 't5') != 0){  
        $output.= "<tr>
                    <td class=\"desc\">
    					<div class=\"tit\">
    						<img class=\"unit u5\" src=\"img/x.gif\" alt=\"".U5."\" title=\"".U5."\" />
    						".U5."
    					</div>
    					<div class=\"details\">
    						<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />".$u5['wood']."|
                            <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$u5['clay']."|
                            <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$u5['iron']."|
                            <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$u5['crop']."|
                            <img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />6|
                            <img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />".
    				        $generator->getTimeFormat(round($u5['time'] / SPEED * $artefact_bonus2 / $artefact_bonus)*3)."
                        </div>
    				</td>
    				
                    <td class=\"val\" width=\"20%\"><center>";
        
        if($village->awood < $u5['wood'] OR $village->aclay < $u5['clay'] OR $village->airon < $u5['iron'] OR $village->acrop < $u5['crop']) { 
            $output.= "<span class=\"none\">Not enough resources</span>"; 
        }else if($units['u5'] == 0){ 
            $output.= "<span class=\"none\">Not available units</span>"; 
        }else {
            $output.= "<a href=\"build.php?id=".$id."&train=5\">Train</a>";
        } 
        $output.="</center></td>
                </tr>";
    }      
    
    if($database->checkIfResearched($village->wid, 't6') != 0){ 
        $output.="<tr>
                    <td class=\"desc\">
    					<div class=\"tit\">
    						<img class=\"unit u6\" src=\"img/x.gif\" alt=\"".U6."\" title=\"".U6."\" />
    						".U6."
    					</div>
    					<div class=\"details\">
    						<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />".$u6['wood']."|
                            <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$u6['clay']."|
                            <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$u6['iron']."|
                            <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$u6['crop']."|
                            <img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />6|
                            <img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />".
    				        $generator->getTimeFormat(round($u6['time'] / SPEED * $artefact_bonus2 / $artefact_bonus)*3)."
                        </div>
    				</td>
    				
                    <td class=\"val\" width=\"20%\"><center>   ";
      
        if($village->awood < $u6['wood'] OR $village->aclay < $u6['clay'] OR $village->airon < $u6['iron'] OR $village->acrop < $u6['crop']) { 
            $output.= "<span class=\"none\">Not enough resources</span>"; 
        }else if($units['u6'] == 0){ 
            $output.= "<span class=\"none\">Not available units</span>"; 
        }else {
            $output.= "<a href=\"build.php?id=".$id."&train=6\">Train</a>";
        }  
        
        $output.="</center></td>
                </tr>";
    }    
}    

if($session->tribe == 2) {

$output.="<tr>
                <td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u11\" src=\"img/x.gif\" alt=\"".U11."\" title=\"".U11."\" />
						".U11."
					</div>
					<div class=\"details\">
						<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />".$u11['wood']."|
                        <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$u11['clay']."|
                        <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$u11['iron']."|
                        <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$u11['crop']."|
                        <img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />6|
                        <img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />".
				        $generator->getTimeFormat(round($u11['time'] / SPEED * $artefact_bonus2 / $artefact_bonus)*3)."
                    </div>
				</td>
				
                <td class=\"val\" width=\"20%\"><center>";

        if($village->awood < $u11['wood'] OR $village->aclay < $u11['clay'] OR $village->airon < $u11['iron'] OR $village->acrop < $u11['crop']) { 
            $output.= "<span class=\"none\">Not enough resources</span>"; 
        }else if($units['u11'] == 0){ 
            $output.= "<span class=\"none\">Not available units</span>"; 
        }else {
            $output.= "<a href=\"build.php?id=".$id."&train=11\">Train</a>";
        }  
    $output.="</center></td>
            </tr>";
            
            
    if($database->checkIfResearched($village->wid, 't12') != 0){    
        $output.="<tr>
                <td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u12\" src=\"img/x.gif\" alt=\"".U12."\" title=\"".U12."\" />
						".U12."
					</div>
					<div class=\"details\">
						<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />".$u12['wood']."|
                        <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$u12['clay']."|
                        <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$u12['iron']."|
                        <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$u12['crop']."|
                        <img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />6|
                        <img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />".
				        $generator->getTimeFormat(round($u12['time'] / SPEED * $artefact_bonus2 / $artefact_bonus)*3)."
                    </div>
				</td>
				
                <td class=\"val\" width=\"20%\"><center>";

        if($village->awood < $u12['wood'] OR $village->aclay < $u12['clay'] OR $village->airon < $u12['iron'] OR $village->acrop < $u12['crop']) { 
            $output.= "<span class=\"none\">Not enough resources</span>"; 
        }else if($units['u12'] == 0){ 
            $output.= "<span class=\"none\">Not available units</span>"; 
        }else {
            $output.= "<a href=\"build.php?id=".$id."&train=12\">Train</a>";
        }  
        $output.="</center></td>
            </tr>";
    }    

  
    if($database->checkIfResearched($village->wid, 't13') != 0){    
        $output.="<tr>
                <td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u13\" src=\"img/x.gif\" alt=\"".U13."\" title=\"".U13."\" />
						".U13."
					</div>
					<div class=\"details\">
						<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />".$u13['wood']."|
                        <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$u13['clay']."|
                        <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$u13['iron']."|
                        <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$u13['crop']."|
                        <img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />6|
                        <img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />".
				        $generator->getTimeFormat(round($u13['time'] / SPEED * $artefact_bonus2 / $artefact_bonus)*3)."
                    </div>
				</td>
				
                <td class=\"val\" width=\"20%\"><center>";

        if($village->awood < $u13['wood'] OR $village->aclay < $u13['clay'] OR $village->airon < $u13['iron'] OR $village->acrop < $u13['crop']) { 
            $output.= "<span class=\"none\">Not enough resources</span>"; 
        }else if($units['u13'] == 0){ 
            $output.= "<span class=\"none\">Not available units</span>"; 
        }else {
            $output.= "<a href=\"build.php?id=".$id."&train=13\">Train</a>";
        }  
        $output.="</center></td>
            </tr>";
    }   
    
    if($database->checkIfResearched($village->wid, 't15') != 0){    
        $output.="<tr>
                <td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u15\" src=\"img/x.gif\" alt=\"".U15."\" title=\"".U15."\" />
						".U15."
					</div>
					<div class=\"details\">
						<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />".$u15['wood']."|
                        <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$u15['clay']."|
                        <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$u15['iron']."|
                        <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$u15['crop']."|
                        <img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />6|
                        <img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />".
				        $generator->getTimeFormat(round($u15['time'] / SPEED * $artefact_bonus2 / $artefact_bonus)*3)."
                    </div>
				</td>
				
                <td class=\"val\" width=\"20%\"><center>";

        if($village->awood < $u15['wood'] OR $village->aclay < $u15['clay'] OR $village->airon < $u15['iron'] OR $village->acrop < $u15['crop']) { 
            $output.= "<span class=\"none\">Not enough resources</span>"; 
        }else if($units['u15'] == 0){ 
            $output.= "<span class=\"none\">Not available units</span>"; 
        }else {
            $output.= "<a href=\"build.php?id=".$id."&train=15\">Train</a>";
        }  
        $output.="</center></td>
            </tr>";
    }  
    
    
    if($database->checkIfResearched($village->wid, 't16') != 0){    
        $output.="<tr>
                <td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u16\" src=\"img/x.gif\" alt=\"".U16."\" title=\"".U16."\" />
						".U16."
					</div>
					<div class=\"details\">
						<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />".$u16['wood']."|
                        <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$u16['clay']."|
                        <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$u16['iron']."|
                        <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$u16['crop']."|
                        <img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />6|
                        <img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />".
				        $generator->getTimeFormat(round($u16['time'] / SPEED * $artefact_bonus2 / $artefact_bonus)*3)."
                    </div>
				</td>
				
                <td class=\"val\" width=\"20%\"><center>";

        if($village->awood < $u16['wood'] OR $village->aclay < $u16['clay'] OR $village->airon < $u16['iron'] OR $village->acrop < $u16['crop']) { 
            $output.= "<span class=\"none\">Not enough resources</span>"; 
        }else if($units['u16'] == 0){ 
            $output.= "<span class=\"none\">Not available units</span>"; 
        }else {
            $output.= "<a href=\"build.php?id=".$id."&train=16\">Train</a>";
        }  
        $output.="</center></td>
            </tr>";
    }  
}


if($session->tribe == 3) {

$output.="<tr>
                <td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u21\" src=\"img/x.gif\" alt=\"".U21."\" title=\"".U21."\" />
						".U21."
					</div>
					<div class=\"details\">
						<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />".$u21['wood']."|
                        <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$u21['clay']."|
                        <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$u21['iron']."|
                        <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$u21['crop']."|
                        <img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />6|
                        <img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />".
				        $generator->getTimeFormat(round($u21['time'] / SPEED * $artefact_bonus2 / $artefact_bonus)*3)."
                    </div>
				</td>
				
                <td class=\"val\" width=\"20%\"><center>";

        if($village->awood < $u21['wood'] OR $village->aclay < $u21['clay'] OR $village->airon < $u21['iron'] OR $village->acrop < $u21['crop']) { 
            $output.= "<span class=\"none\">Not enough resources</span>"; 
        }else if($units['u21'] == 0){ 
            $output.= "<span class=\"none\">Not available units</span>"; 
        }else {
            $output.= "<a href=\"build.php?id=".$id."&train=21\">Train</a>";
        }  
    $output.="</center></td>
            </tr>";
            
            
    if($database->checkIfResearched($village->wid, 't22') != 0){    
        $output.="<tr>
                <td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u22\" src=\"img/x.gif\" alt=\"".U22."\" title=\"".U22."\" />
						".U22."
					</div>
					<div class=\"details\">
						<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />".$u22['wood']."|
                        <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$u22['clay']."|
                        <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$u22['iron']."|
                        <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$u22['crop']."|
                        <img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />6|
                        <img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />".
				        $generator->getTimeFormat(round($u22['time'] / SPEED * $artefact_bonus2 / $artefact_bonus)*3)."
                    </div>
				</td>
				
                <td class=\"val\" width=\"20%\"><center>";

        if($village->awood < $u22['wood'] OR $village->aclay < $u22['clay'] OR $village->airon < $u22['iron'] OR $village->acrop < $u22['crop']) { 
            $output.= "<span class=\"none\">Not enough resources</span>"; 
        }else if($units['u22'] == 0){ 
            $output.= "<span class=\"none\">Not available units</span>"; 
        }else {
            $output.= "<a href=\"build.php?id=".$id."&train=22\">Train</a>";
        }  
        $output.="</center></td>
            </tr>";
    }    

  
    if($database->checkIfResearched($village->wid, 't24') != 0){    
        $output.="<tr>
                <td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u24\" src=\"img/x.gif\" alt=\"".U24."\" title=\"".U24."\" />
						".U24."
					</div>
					<div class=\"details\">
						<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />".$u24['wood']."|
                        <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$u24['clay']."|
                        <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$u24['iron']."|
                        <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$u24['crop']."|
                        <img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />6|
                        <img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />".
				        $generator->getTimeFormat(round($u24['time'] / SPEED * $artefact_bonus2 / $artefact_bonus)*3)."
                    </div>
				</td>
				
                <td class=\"val\" width=\"20%\"><center>";

        if($village->awood < $u24['wood'] OR $village->aclay < $u24['clay'] OR $village->airon < $u24['iron'] OR $village->acrop < $u24['crop']) { 
            $output.= "<span class=\"none\">Not enough resources</span>"; 
        }else if($units['u24'] == 0){ 
            $output.= "<span class=\"none\">Not available units</span>"; 
        }else {
            $output.= "<a href=\"build.php?id=".$id."&train=24\">Train</a>";
        }  
        $output.="</center></td>
            </tr>";
    }   
    
    if($database->checkIfResearched($village->wid, 't25') != 0){    
        $output.="<tr>
                <td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u25\" src=\"img/x.gif\" alt=\"".U25."\" title=\"".U25."\" />
						".U25."
					</div>
					<div class=\"details\">
						<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />".$u25['wood']."|
                        <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$u25['clay']."|
                        <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$u25['iron']."|
                        <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$u25['crop']."|
                        <img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />6|
                        <img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />".
				        $generator->getTimeFormat(round($u25['time'] / SPEED * $artefact_bonus2 / $artefact_bonus)*3)."
                    </div>
				</td>
				
                <td class=\"val\" width=\"20%\"><center>";

        if($village->awood < $u25['wood'] OR $village->aclay < $u25['clay'] OR $village->airon < $u25['iron'] OR $village->acrop < $u25['crop']) { 
            $output.= "<span class=\"none\">Not enough resources</span>"; 
        }else if($units['u25'] == 0){ 
            $output.= "<span class=\"none\">Not available units</span>"; 
        }else {
            $output.= "<a href=\"build.php?id=".$id."&train=25\">Train</a>";
        }  
        $output.="</center></td>
            </tr>";
    }  
    
    
    if($database->checkIfResearched($village->wid, 't26') != 0){    
        $output.="<tr>
                <td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u26\" src=\"img/x.gif\" alt=\"".U26."\" title=\"".U26."\" />
						".U26."
					</div>
					<div class=\"details\">
						<img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />".$u26['wood']."|
                        <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".$u26['clay']."|
                        <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".$u26['iron']."|
                        <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".$u26['crop']."|
                        <img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />6|
                        <img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />".
				        $generator->getTimeFormat(round($u26['time'] / SPEED * $artefact_bonus2 / $artefact_bonus)*3)."
                    </div>
				</td>
				
                <td class=\"val\" width=\"20%\"><center>";

        if($village->awood < $u26['wood'] OR $village->aclay < $u26['clay'] OR $village->airon < $u26['iron'] OR $village->acrop < $u26['crop']) { 
            $output.= "<span class=\"none\">Not enough resources</span>"; 
        }else if($units['u26'] == 0){ 
            $output.= "<span class=\"none\">Not available units</span>"; 
        }else {
            $output.= "<a href=\"build.php?id=".$id."&train=26\">Train</a>";
        }  
        $output.="</center></td>
            </tr>";
    }  
}



        //HERO TRAINING
		$count_hero = mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "hero WHERE `uid` = " . $session->uid . "")); 
        if($session->tribe == 1){
                if($_GET['train'] == 1){
				if($session->access != BANNED){
					mysql_query("DELETE from " . TB_PREFIX . "hero WHERE `dead` = 1 AND `uid` = '" . $session->uid . "'");
					if($count_hero == 0){
					mysql_query("INSERT INTO ".TB_PREFIX."hero (`uid`, `wref`, `regeneration`, `unit`, `name`, `level`, `points`, `experience`, `dead`, `health`, `attack`, `defence`, `attackbonus`, `defencebonus`, `trainingtime`, `autoregen`, `intraining`) VALUES ('".$session->uid."', '" . $village->wid . "', '0', '1', '".addslashes($session->username)."', '0', '10', '0', '0', '100', '0', '0', '0', '0', '".round((time() + ($u1['time'] / SPEED)*3))."', '50', '1')");
					mysql_query("UPDATE " . TB_PREFIX . "units SET `u1` = `u1` - 1 WHERE `vref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `wood` = `wood` - ".$u1['wood']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `clay` = `clay` - ".$u1['clay']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `iron` = `iron` - ".$u1['iron']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `crop` = `crop` - ".$u1['crop']." WHERE `wref` = '" . $village->wid . "'");
					}
					header("Location: build.php?id=".$id."");
					}else{
					header("Location: banned.php"); 
					}
					}
                if($_GET['train'] == 2){
				if($session->access != BANNED){
					mysql_query("DELETE from " . TB_PREFIX . "hero WHERE `dead` = 1 AND `uid` = '" . $session->uid . "'");
					if($count_hero == 0){
					mysql_query("INSERT INTO ".TB_PREFIX."hero (`uid`, `wref`, `regeneration`, `unit`, `name`, `level`, `points`, `experience`, `dead`, `health`, `attack`, `defence`, `attackbonus`, `defencebonus`, `trainingtime`, `autoregen`, `intraining`) VALUES ('".$session->uid."', '" . $village->wid . "', '0', '1', '".addslashes($session->username)."', '0', '10', '0', '0', '100', '0', '0', '0', '0', '".round((time() + ($u1['time'] / SPEED)*3))."', '50', '1')");
                    mysql_query("UPDATE " . TB_PREFIX . "units SET `u2` = `u2` - 1 WHERE `vref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `wood` = `wood` - ".$u2['wood']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `clay` = `clay` - ".$u2['clay']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `iron` = `iron` - ".$u2['iron']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `crop` = `crop` - ".$u2['crop']." WHERE `wref` = '" . $village->wid . "'");
					}
					header("Location: build.php?id=".$id."");
					}else{
					header("Location: banned.php"); 
					}
					}
                if($_GET['train'] == 3){
				if($session->access != BANNED){
					mysql_query("DELETE from " . TB_PREFIX . "hero WHERE `dead` = 1 AND `uid` = '" . $session->uid . "'");
					mysql_query("INSERT INTO ".TB_PREFIX."hero (`uid`, `wref`, `regeneration`, `unit`, `name`, `level`, `points`, `experience`, `dead`, `health`, `attack`, `defence`, `attackbonus`, `defencebonus`, `trainingtime`, `autoregen`, `intraining`) VALUES ('".$session->uid."', '" . $village->wid . "', '0', '3', '".addslashes($session->username)."', '0', '10', '0', '0', '100', '0', '0', '0', '0', '".round((time() + ($u3['time'] / SPEED)*3))."', '50', '1')");
                    mysql_query("UPDATE " . TB_PREFIX . "units SET `u3` = `u3` - 1 WHERE `vref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `wood` = `wood` - ".$u3['wood']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `clay` = `clay` - ".$u3['clay']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `iron` = `iron` - ".$u3['iron']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `crop` = `crop` - ".$u3['crop']." WHERE `wref` = '" . $village->wid . "'");
					header("Location: build.php?id=".$id."");
					}else{
					header("Location: banned.php"); 
					}
					}
                if($_GET['train'] == 5){
				if($session->access != BANNED){
					mysql_query("DELETE from " . TB_PREFIX . "hero WHERE `dead` = 1 AND `uid` = '" . $session->uid . "'");
					if($count_hero == 0){
					mysql_query("INSERT INTO ".TB_PREFIX."hero (`uid`, `wref`, `regeneration`, `unit`, `name`, `level`, `points`, `experience`, `dead`, `health`, `attack`, `defence`, `attackbonus`, `defencebonus`, `trainingtime`, `autoregen`, `intraining`) VALUES ('".$session->uid."', '" . $village->wid . "', '0', '5', '".addslashes($session->username)."', '0', '10', '0', '0', '100', '0', '0', '0', '0', '".round((time() + ($u5['time'] / SPEED)*3))."', '50', '1')");
                    mysql_query("UPDATE " . TB_PREFIX . "units SET `u5` = `u5` - 1 WHERE `vref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `wood` = `wood` - ".$u5['wood']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `clay` = `clay` - ".$u5['clay']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `iron` = `iron` - ".$u5['iron']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `crop` = `crop` - ".$u5['crop']." WHERE `wref` = '" . $village->wid . "'");
					}
					header("Location: build.php?id=".$id."");
					}else{
					header("Location: banned.php"); 
					}
					}
                if($_GET['train'] == 6){
				if($session->access != BANNED){
					mysql_query("DELETE from " . TB_PREFIX . "hero WHERE `dead` = 1 AND `uid` = '" . $session->uid . "'");
					if($count_hero == 0){
					mysql_query("INSERT INTO ".TB_PREFIX."hero (`uid`, `wref`, `regeneration`, `unit`, `name`, `level`, `points`, `experience`, `dead`, `health`, `attack`, `defence`, `attackbonus`, `defencebonus`, `trainingtime`, `autoregen`, `intraining`) VALUES ('".$session->uid."', '" . $village->wid . "', '0', '6', '".addslashes($session->username)."', '0', '10', '0', '0', '100', '0', '0', '0', '0', '".round((time() + ($u6['time'] / SPEED)*3))."', '50', '1')");
                    mysql_query("UPDATE " . TB_PREFIX . "units SET `u6` = `u6` - 1 WHERE `vref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `wood` = `wood` - ".$u6['wood']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `clay` = `clay` - ".$u6['clay']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `iron` = `iron` - ".$u6['iron']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `crop` = `crop` - ".$u6['crop']." WHERE `wref` = '" . $village->wid . "'");
					}
					header("Location: build.php?id=".$id."");
					}else{
					header("Location: banned.php"); 
					}
				}
			}
        if($session->tribe == 2){
                if($_GET['train'] == 11){
				if($session->access != BANNED){
					mysql_query("DELETE from " . TB_PREFIX . "hero WHERE `dead` = 1 AND `uid` = '" . $session->uid . "'");
					if($count_hero == 0){
					mysql_query("INSERT INTO ".TB_PREFIX."hero (`uid`, `wref`, `regeneration`, `unit`, `name`, `level`, `points`, `experience`, `dead`, `health`, `attack`, `defence`, `attackbonus`, `defencebonus`, `trainingtime`, `autoregen`, `intraining`) VALUES ('".$session->uid."', '" . $village->wid . "', '0', '11', '".addslashes($session->username)."', '0', '10', '0', '0', '100', '0', '0', '0', '0', '".round((time() + ($u11['time'] / SPEED)*3))."', '50', '1')");
                    mysql_query("UPDATE " . TB_PREFIX . "units SET `u11` = `u11` - 1 WHERE `vref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `wood` = `wood` - ".$u11['wood']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `clay` = `clay` - ".$u11['clay']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `iron` = `iron` - ".$u11['iron']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `crop` = `crop` - ".$u11['crop']." WHERE `wref` = '" . $village->wid . "'");
					}
                    header("Location: build.php?id=".$id."");
					}else{
					header("Location: banned.php"); 
					}
                }
                if($_GET['train'] == 12){
				if($session->access != BANNED){
					mysql_query("DELETE from " . TB_PREFIX . "hero WHERE `dead` = 1 AND `uid` = '" . $session->uid . "'");
					if($count_hero == 0){
					mysql_query("INSERT INTO ".TB_PREFIX."hero (`uid`, `wref`, `regeneration`, `unit`, `name`, `level`, `points`, `experience`, `dead`, `health`, `attack`, `defence`, `attackbonus`, `defencebonus`, `trainingtime`, `autoregen`, `intraining`) VALUES ('".$session->uid."', '" . $village->wid . "', '0', '12', '".addslashes($session->username)."', '0', '10', '0', '0', '100', '0', '0', '0', '0', '".round((time() + ($u12['time'] / SPEED)*3))."', '50', '1')");
                    mysql_query("UPDATE " . TB_PREFIX . "units SET `u12` = `u12` - 1 WHERE `vref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `wood` = `wood` - ".$u12['wood']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `clay` = `clay` - ".$u12['clay']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `iron` = `iron` - ".$u12['iron']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `crop` = `crop` - ".$u12['crop']." WHERE `wref` = '" . $village->wid . "'");
					}
					header("Location: build.php?id=".$id."");
					}else{
					header("Location: banned.php"); 
					}
					}
                if($_GET['train'] == 13){
				if($session->access != BANNED){
					mysql_query("DELETE from " . TB_PREFIX . "hero WHERE `dead` = 1 AND `uid` = '" . $session->uid . "'");
					if($count_hero == 0){
					mysql_query("INSERT INTO ".TB_PREFIX."hero (`uid`, `wref`, `regeneration`, `unit`, `name`, `level`, `points`, `experience`, `dead`, `health`, `attack`, `defence`, `attackbonus`, `defencebonus`, `trainingtime`, `autoregen`, `intraining`) VALUES ('".$session->uid."', '" . $village->wid . "', '0', '13', '".addslashes($session->username)."', '0', '10', '0', '0', '100', '0', '0', '0', '0', '".round((time() + ($u13['time'] / SPEED)*3))."', '50', '1')");
                    mysql_query("UPDATE " . TB_PREFIX . "units SET `u13` = `u13` - 1 WHERE `vref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `wood` = `wood` - ".$u13['wood']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `clay` = `clay` - ".$u13['clay']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `iron` = `iron` - ".$u13['iron']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `crop` = `crop` - ".$u13['crop']." WHERE `wref` = '" . $village->wid . "'");
					}
					header("Location: build.php?id=".$id."");
					}else{
					header("Location: banned.php"); 
					}
					}
                if($_GET['train'] == 15){
				if($session->access != BANNED){
					mysql_query("DELETE from " . TB_PREFIX . "hero WHERE `dead` = 1 AND `uid` = '" . $session->uid . "'");
					if($count_hero == 0){
					mysql_query("INSERT INTO ".TB_PREFIX."hero (`uid`, `wref`, `regeneration`, `unit`, `name`, `level`, `points`, `experience`, `dead`, `health`, `attack`, `defence`, `attackbonus`, `defencebonus`, `trainingtime`, `autoregen`, `intraining`) VALUES ('".$session->uid."', '" . $village->wid . "', '0', '15', '".addslashes($session->username)."', '0', '10', '0', '0', '100', '0', '0', '0', '0', '".round((time() + ($u15['time'] / SPEED)*3))."', '50', '1')");
                    mysql_query("UPDATE " . TB_PREFIX . "units SET `u15` = `u15` - 1 WHERE `vref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `wood` = `wood` - ".$u15['wood']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `clay` = `clay` - ".$u15['clay']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `iron` = `iron` - ".$u15['iron']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `crop` = `crop` - ".$u15['crop']." WHERE `wref` = '" . $village->wid . "'");
					}
					header("Location: build.php?id=".$id."");
					}else{
					header("Location: banned.php"); 
					}
					}
                if($_GET['train'] == 16){
				if($session->access != BANNED){
					mysql_query("DELETE from " . TB_PREFIX . "hero WHERE `dead` = 1 AND `uid` = '" . $session->uid . "'");
					if($count_hero == 0){
					mysql_query("INSERT INTO ".TB_PREFIX."hero (`uid`, `wref`, `regeneration`, `unit`, `name`, `level`, `points`, `experience`, `dead`, `health`, `attack`, `defence`, `attackbonus`, `defencebonus`, `trainingtime`, `autoregen`, `intraining`) VALUES ('".$session->uid."', '" . $village->wid . "', '0', '16', '".addslashes($session->username)."', '0', '10', '0', '0', '100', '0', '0', '0', '0', '".round((time() + ($u16['time'] / SPEED)*3))."', '50', '1')");
                    mysql_query("UPDATE " . TB_PREFIX . "units SET `u16` = `u16` - 1 WHERE `vref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `wood` = `wood` - ".$u16['wood']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `clay` = `clay` - ".$u16['clay']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `iron` = `iron` - ".$u16['iron']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `crop` = `crop` - ".$u16['crop']." WHERE `wref` = '" . $village->wid . "'");
					}
					header("Location: build.php?id=".$id."");
					}else{
					header("Location: banned.php"); 
					}
					}
            }
        if($session->tribe == 3){
                if($_GET['train'] == 21){
				if($session->access != BANNED){
					mysql_query("DELETE from " . TB_PREFIX . "hero WHERE `dead` = 1 AND `uid` = '" . $session->uid . "'");
					if($count_hero == 0){
					mysql_query("INSERT INTO ".TB_PREFIX."hero (`uid`, `wref`, `regeneration`, `unit`, `name`, `level`, `points`, `experience`, `dead`, `health`, `attack`, `defence`, `attackbonus`, `defencebonus`, `trainingtime`, `autoregen`, `intraining`) VALUES ('".$session->uid."', '" . $village->wid . "', '0', '21', '".addslashes($session->username)."', '0', '10', '0', '0', '100', '0', '0', '0', '0', '".round((time() + ($u21['time'] / SPEED)*3))."', '50', '1')");
                    mysql_query("UPDATE " . TB_PREFIX . "units SET `u21` = `u21` - 1 WHERE `vref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `wood` = `wood` - ".$u21['wood']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `clay` = `clay` - ".$u21['clay']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `iron` = `iron` - ".$u21['iron']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `crop` = `crop` - ".$u21['crop']." WHERE `wref` = '" . $village->wid . "'");
					}
					header("Location: build.php?id=".$id."");
					}else{
					header("Location: banned.php"); 
					}
					}
                if($_GET['train'] == 22){
				if($session->access != BANNED){
					mysql_query("DELETE from " . TB_PREFIX . "hero WHERE `dead` = 1 AND `uid` = '" . $session->uid . "'");
					if($count_hero == 0){
					mysql_query("INSERT INTO ".TB_PREFIX."hero (`uid`, `wref`, `regeneration`, `unit`, `name`, `level`, `points`, `experience`, `dead`, `health`, `attack`, `defence`, `attackbonus`, `defencebonus`, `trainingtime`, `autoregen`, `intraining`) VALUES ('".$session->uid."', '" . $village->wid . "', '0', '22', '".addslashes($session->username)."', '0', '10', '0', '0', '100', '0', '0', '0', '0', '".round((time() + ($u22['time'] / SPEED)*3))."', '50', '1')");
                    mysql_query("UPDATE " . TB_PREFIX . "units SET `u22` = `u22` - 1 WHERE `vref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `wood` = `wood` - ".$u22['wood']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `clay` = `clay` - ".$u22['clay']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `iron` = `iron` - ".$u22['iron']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `crop` = `crop` - ".$u22['crop']." WHERE `wref` = '" . $village->wid . "'");
					}
					header("Location: build.php?id=".$id."");
					}else{
					header("Location: banned.php"); 
					}
					}
                if($_GET['train'] == 24){
				if($session->access != BANNED){
					mysql_query("DELETE from " . TB_PREFIX . "hero WHERE `dead` = 1 AND `uid` = '" . $session->uid . "'");
					if($count_hero == 0){
					mysql_query("INSERT INTO ".TB_PREFIX."hero (`uid`, `wref`, `regeneration`, `unit`, `name`, `level`, `points`, `experience`, `dead`, `health`, `attack`, `defence`, `attackbonus`, `defencebonus`, `trainingtime`, `autoregen`, `intraining`) VALUES ('".$session->uid."', '" . $village->wid . "', '0', '24', '".addslashes($session->username)."', '0', '10', '0', '0', '100', '0', '0', '0', '0', '".round((time() + ($u24['time'] / SPEED)*3))."', '50', '1')");
                    mysql_query("UPDATE " . TB_PREFIX . "units SET `u24` = `u24` - 1 WHERE `vref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `wood` = `wood` - ".$u24['wood']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `clay` = `clay` - ".$u24['clay']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `iron` = `iron` - ".$u24['iron']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `crop` = `crop` - ".$u24['crop']." WHERE `wref` = '" . $village->wid . "'");
					}
					header("Location: build.php?id=".$id."");
					}else{
					header("Location: banned.php"); 
					}
					}
                if($_GET['train'] == 25){
				if($session->access != BANNED){
					mysql_query("DELETE from " . TB_PREFIX . "hero WHERE `dead` = 1 AND `uid` = '" . $session->uid . "'");
					if($count_hero == 0){
					mysql_query("INSERT INTO ".TB_PREFIX."hero (`uid`, `wref`, `regeneration`, `unit`, `name`, `level`, `points`, `experience`, `dead`, `health`, `attack`, `defence`, `attackbonus`, `defencebonus`, `trainingtime`, `autoregen`, `intraining`) VALUES ('".$session->uid."', '" . $village->wid . "', '0', '25', '".addslashes($session->username)."', '0', '10', '0', '0', '100', '0', '0', '0', '0', '".round((time() + ($u25['time'] / SPEED)*3))."', '50', '1')");
                    mysql_query("UPDATE " . TB_PREFIX . "units SET `u25` = `u25` - 1 WHERE `vref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `wood` = `wood` - ".$u25['wood']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `clay` = `clay` - ".$u25['clay']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `iron` = `iron` - ".$u25['iron']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `crop` = `crop` - ".$u25['crop']." WHERE `wref` = '" . $village->wid . "'");
					}
					header("Location: build.php?id=".$id."");
					}else{
					header("Location: banned.php"); 
					}
					}
                if($_GET['train'] == 26){
				if($session->access != BANNED){
					mysql_query("DELETE from " . TB_PREFIX . "hero WHERE `dead` = 1 AND `uid` = '" . $session->uid . "'");
					if($count_hero == 0){
					mysql_query("INSERT INTO ".TB_PREFIX."hero (`uid`, `wref`, `regeneration`, `unit`, `name`, `level`, `points`, `experience`, `dead`, `health`, `attack`, `defence`, `attackbonus`, `defencebonus`, `trainingtime`, `autoregen`, `intraining`) VALUES ('".$session->uid."', '" . $village->wid . "', '0', '26', '".addslashes($session->username)."', '0', '10', '0', '0', '100', '0', '0', '0', '0', '".round((time() + ($u26['time'] / SPEED)*3))."', '50', '1')");
                    mysql_query("UPDATE " . TB_PREFIX . "units SET `u26` = `u26` - 1 WHERE `vref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `wood` = `wood` - ".$u26['wood']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `clay` = `clay` - ".$u26['clay']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `iron` = `iron` - ".$u26['iron']." WHERE `wref` = '" . $village->wid . "'");
					mysql_query("UPDATE " . TB_PREFIX . "vdata SET `crop` = `crop` - ".$u26['crop']." WHERE `wref` = '" . $village->wid . "'");
					}
					header("Location: build.php?id=".$id."");
					}else{
					header("Location: banned.php"); 
					}
					}
			}
            
        
        

echo  $output;  

?>
</table>