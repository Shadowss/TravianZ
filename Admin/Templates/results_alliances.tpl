<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       results_alliances.tpl                                       ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<?php
$result = $admin->search_alliance($_POST['s']);
?>
<table id="member">
  <thead>
    <tr>
        <th class="dtbl"><a href="">1 «</a></th><th>Found alliances (<?php echo count($result);?>)</th><th class="dtbl"><a href="">» 100</a></th>
    </tr>
  </thead> 

</table>
<table id="profile">    
    <tr>
        <td class="b">AID</td>
        <td class="b">Name</td>
        <td class="b">Tag</td>
        <td class="b">Founder</td>          
    </tr>
<?php      
if($result){  
for ($i = 0; $i <= count($result)-1; $i++) {    
echo '
    <tr>
        <td>'.$result[$i]["id"].'</td>
        <td><a href="?p=alliance&aid='.$result[$i]["id"].'">'.$result[$i]["name"].'</a></td>
        <td><a href="?p=alliance&aid='.$result[$i]["id"].'">'.$result[$i]["tag"].'</a></td>
        <td><a href="?p=player&uid='.$result[$i]["id"].'">'.$database->getUserField($result[$i]["leader"],'username',0).'</a></td>
    </tr>  
'; 
}}
else{  
echo '
    <tr>
        <td colspan="4">No results</td>  
    </tr>  
';
}
?>    
  
</table>
