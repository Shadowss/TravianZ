 <?php
if($session->access!=BANNED){
            $building->finishAll();
            header("Location: plus.php?id=3");
        }else{
            header("Location: banned.php");
        }
?> 
