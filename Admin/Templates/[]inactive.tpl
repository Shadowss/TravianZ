<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       inactive.tpl                                                ##
##  Developed by:  Dzoki                                                       ##
##  Reworked:      aggenkeech                                                  ##
##  Fix by:        ronix                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##                                                                             ##
#################################################################################
global $database;
?>
<style>
    .del {width:12px; height:12px; background-image: url(img/admin/icon/del.gif);}
</style>

<table id="member">
    <thead>
        <tr>
            <th colspan="7">Inactive users</th>
        </tr>
        <tr>
            <td>Name [access]</td>
            <td>Time</td>
            <td>Tribe</td>
            <td>Population</td>
            <td>Villages</td>
            <td>Gold</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php
            for ($h=1;$h<4;$h++) {
                if ($h==1) { // 24 hours and before 3 days
                    $from_time=time() - 86400; $to_time = time() - (86400*3);
                    $q = "SELECT * FROM ".TB_PREFIX."users where ($from_time >= timestamp AND $to_time < timestamp) AND id>5";
                }elseif ($h==2) {  // 3 days  and before 7 days
                    $from_time=time() - (86400*3); $to_time = time() - (86400*7);
                    $q = "SELECT * FROM ".TB_PREFIX."users where ($from_time >= timestamp AND $to_time < timestamp) AND id>5";
                }elseif ($h==3) { //7 days and after
                    $from_time=time() - (86400*7);
                    $q = "SELECT * FROM ".TB_PREFIX."users where $from_time > timestamp AND id>5";
                }
                
                $result = $database->query($q);
                $active = $database->mysql_fetch_all($result);
                for ($i = 0; $i <= count($active)-1; $i++){
                    $uid = $database->getUserField($active[$i]['username'],'id',1);
                    $varray = $database->getProfileVillages($uid);
                    $totalpop = 0;
                    foreach($varray as $vil){
                        $totalpop += $vil['pop'];
                    }
                    if($active[$i]['tribe'] == 1){
                        $tribe = "Roman";
                        $img = "";
                    }else if($active[$i]['tribe'] == 2){
                        $tribe = "Teuton";
                        $img = "1";
                    }else if($active[$i]['tribe'] == 3){
                        $tribe = "Gaul";
                        $img = "2";
                    }
                    $getmin=((time()-$active[$i]['timestamp'])/60);
                    $gethr=((time()-$active[$i]['timestamp'])/3600);
                    $getday=intval((time()-$active[$i]['timestamp'])/86400);
            
                    echo "
                    <tr>
                        <td><a href=\"?p=player&uid=".$uid."\">".$active[$i]['username']." [".$active[$i]['access']."]</a></td>
                        <td>".$getday." days ".intval($gethr-$getday*24)." hours</td>
                        <td><img src=\"../gpack/travian_default/img/u/".$img."9.gif\" title=\"$tribe\" alt=\"$tribe\"></td>
                        <td>".$totalpop."</td>
                        <td>".count($varray)."</td>
                        <td><img src=\"../img/admin/gold.gif\" class=\"gold\" alt=\"Gold\" title=\"This user has: ".$active[$i]['gold']." gold\"/> ".$active[$i]['gold']."</td>
                        <td><img src=\"../gpack/travian_default/img/a/online".($h+2).".gif\"></td>
                    </tr>";
                }
            }    
        ?>
    </tbody>
</table>
