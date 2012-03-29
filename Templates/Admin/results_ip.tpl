<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       results_ip.tpl                                              ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<?php
$result = $admin->search_ip($_POST['s']);
$newArray = array();   
function arr($arr,$el){
global $newArray;
for ($i = 0; $i <= count($arr)-1; $i++) {
    if(in_array($el,$newArray)){
      return false;
    }else{           
      array_push($newArray,$el);         
      return true;
    }
}
}            

?>
<table id="member">
  <thead>
    <tr>
        <th class="dtbl"><a href="">1 «</a></th><th>Found IPs (<?php echo count($newArray);?>)</th><th class="dtbl"><a href="">» 100</a></th>
    </tr>
  </thead> 

</table>
<table id="profile">    
    <tr>
        <td class="b">IP</td>
        <td class="b">Name</td>            
    </tr>
<?php      
if($result){                       
for ($i = 0; $i <= count($result)-1; $i++) {   
if(arr($result,$result[$i]["ip"].$result[$i]["uid"])){          
echo '
    <tr>
        <td>'.$result[$i]["ip"].'</td>
        <td><a href="?p=player&uid='.$result[$i]["uid"].'">'.$database->getUserField($result[$i]["uid"],'username',0).'</a></td>
    </tr>  
';    
}
}
}
else{  
echo '
    <tr>
        <td colspan="4">No results</td>  
    </tr>  
';
}
?>    
  
</table>
