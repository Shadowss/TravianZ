<div id="textmenu">
   <a href="dorf3.php" class="<?php if(!isset($_GET['s'])){echo 'selected';}?>">Overview</a>
 | <a href="dorf3.php?s=2" class="<?php if($_GET['s'] == 2){echo 'selected';}?>">Resources</a>             
 | <a href="dorf3.php?s=3" class="<?php if($_GET['s'] == 3){echo 'selected';}?>">Warehouse</a>
 | <a href="dorf3.php?s=4" class="<?php if($_GET['s'] == 4){echo 'selected';}?>">CP</a>  
 | <a href="dorf3.php?s=5" class="<?php if($_GET['s'] == 5){echo 'selected';}?>">Troops</a>
</div>