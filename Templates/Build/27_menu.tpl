<div id="textmenu">
   <a href="build.php?id=<?php echo $id ?? 0; ?>"<?php if(($_GET['t'] ?? 0) == 0 || ($_GET['t'] ?? 0) == 1) echo ' class="selected"'; ?>><?php echo OWN_ARTEFACTS; ?></a>
         
 | <a href="build.php?id=<?php echo $id ?? 0; ?>&t=2"<?php if(($_GET['t'] ?? 0) == 2) echo ' class="selected"'; ?>><?php echo SMALL_ARTEFACTS; ?></a>

 | <a href="build.php?id=<?php echo $id ?? 0; ?>&t=3"<?php if(($_GET['t'] ?? 0) == 3) echo ' class="selected"'; ?>><?php echo LARGE_ARTEFACTS; ?></a>
</div>