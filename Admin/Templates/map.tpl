<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       map.tpl                                                     ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>

comming soon
<div>
<img style="border: 1px solid blue;" src="img/x.gif" usemap="#mymap" alt="imagemap" border="0" height="525 width="525">
</div>

<map name="mymap">

<?php
function line($x,$W){
$a = 0;
for ($i = 0; $i <= $x; $i++) {
$X = $W.'-'.$i;
$c += 25;
$d = $W*25+25;
$b = 25*($W-1);
echo '<area shape="rect" coords="'.$a.','.$b.','.$c.','.$d.'" href="?x='.$W.'&y='.$i.'" alt="frames">';
$a += 25;
}
}

function map($x,$y){
for ($i = 0; $i <= $y; $i++) {
line($x,$i);
}
}


map(20,20);


?>
</map>