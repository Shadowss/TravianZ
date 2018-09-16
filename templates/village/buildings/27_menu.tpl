<div id="textmenu">
   <a href="build.php?id=<?php echo $id; ?>" <?php

        if(!isset($_GET['t']) && $_GET['id'] == $id) {
        	echo "class=\"selected\"";
        }

?>
    "><?php echo OWN_ARTIFACTS; ?></a>
         
 | <a href="build.php?id=<?php echo $id; ?>&t=2" <?php

        if(isset($_GET['t']) && $_GET['t'] == 2) {
        	echo "class=\"selected\"";
        }

?>"><?php echo SMALL_ARTIFACTS; ?></a>

 | <a href="build.php?id=<?php echo $id; ?>&t=3" <?php

        if(isset($_GET['t']) && $_GET['t'] == 3) {
        	echo "class=\"selected\"";
        }
?>"><?php echo LARGE_ARTIFACTS; ?></a>
</div>