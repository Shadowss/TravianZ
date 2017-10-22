 <?php
if($session->access!=BANNED){
            $building->finishAll('plus.php?id=3');
			exit;
        }else{
            header("Location: banned.php");
			exit;
        }
?> 
