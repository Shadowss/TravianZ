<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       dorf2.tpl                                                   ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<map name="map1" id="map1">
<?php
if($building->walling()) {
	$wtitle = $building->procResType($building->walling())." Level ".$village->resarray['f40'];
}
else {
	$wtitle = ($village->resarray['f40'] == 0)? "Outer building site" : $building->procResType($village->resarray['f40t'],0)." Level ".$village->resarray['f40'];
}
?>
	<area href="build.php?id=40" title="<?php echo $wtitle; ?>" coords="325,225,180" shape="circle" alt="" />
	<area href="build.php?id=40" title="<?php echo $wtitle; ?>" coords="220,230,185" shape="circle" alt="" />

</map>
<map name="map2" id="map2">
<?php
$coords = array(19=>"53,91,91,71,127,91,91,112","136,66,174,46,210,66,174,87","196,56,234,36,270,56,234,77","270,69,308,49,344,69,308,90","327,117,365,97,401,117,365,138","14,129,52,109,88,129,52,150","97,137,135,117,171,137,135,158","182,119,182,65,257,65,257,119,220,140","337,156,375,136,411,156,375,177","2,199,40,179,76,199,40,220","129,164,167,144,203,164,167,185","92,189,130,169,166,189,130,210","342,216,380,196,416,216,380,237","22,238,60,218,96,238,60,259","167,232,205,212,241,232,205,253","290,251,328,231,364,251,328,272","95,273,133,253,169,273,133,294","222,284,260,264,296,284,260,305","80,306,118,286,154,306,118,327","199,316,237,296,273,316,237,337","270,158,303,135,316,155,318,178,304,211,288,227,263,238,250,215");
for($t=19;$t<=39;$t++) {
if ($village->natar==1 && ( $t== 25 || $t == 26 || $t == 29 || $t == 30 || $t == 33 )) {
    if ($t==33) {
        if($village->resarray['f99'] != 0) {
            $title = $building->procResType(40). " Level ".$village->resarray['f99'];
        }else $title = $building->procResType(40);
        
        echo "<area href=\"build.php?id=99\" title=\"$title\" coords=\"190,170,80\" shape=\"circle\"/>";
    }    
} else {
        if($village->resarray['f'.$t.'t'] != 0) {
            $title = $building->procResType($village->resarray['f'.$t.'t']). " Level ".$village->resarray['f'.$t];
        }else{
            $title = "Building site";
            if(($t == 39) && ($village->resarray['f'.$t] == 0)) {
                $title = "Rally Point building site";
            }
        }
        echo "<area href=\"build.php?id=$t\" title=\"$title\" coords=\"$coords[$t]\" shape=\"poly\"/>";
    }
}
?>
	
    <area href="build.php?id=40" title="<?php echo $wtitle; ?>" coords="312,338,347,338,377,320,406,288,421,262,421,222,396,275,360,311" shape="poly" alt="" />
	<area href="build.php?id=40" title="<?php echo $wtitle; ?>" coords="49,338,0,274,0,240,33,286,88,338" shape="poly" alt="" />
	<area href="build.php?id=40" title="<?php echo $wtitle; ?>" coords="0,144,34,88,93,39,181,15,252,15,305,31,358,63,402,106,421,151,421,93,378,47,280,0,175,0,78,28,0,92" shape="poly" alt="" />
</map>
<?php
	if($session->tribe == 3){
		$session->tribe = '';
	}
	
if($building->walling()) {
$vmapc = "d2_1".$session->tribe;
}
else {
$vmapc = ($village->resarray['f40'] == 0)? "d2_0" : "d2_1".$session->tribe;
}
?>
<div id="village_map" class="<?php echo $vmapc; ?>">
<?php
for ($i=1;$i<=20;$i++) {
    if($village->natar==1 AND (($i+18)=='25' || ($i+18)=='26' || ($i+18)=='29' || ($i+18)=='30' || ($i+18)=='33')) {
        } else {
    $text = "Building site";
    $img = "iso";
        if($village->resarray['f'.($i+18).'t'] != 0) {
            $text = $building->procResType($village->resarray['f'.($i+18).'t'])." Level ".$village->resarray['f'.($i+18)];
            $img = "g".$village->resarray['f'.($i+18).'t'];
       }
    foreach($building->buildArray as $job) {
    	if($job['field'] == ($i+18)) {
        	$img = 'g'.$job['type'].'b';
            $text = $building->procResType($job['type'])." Level ".$village->resarray['f'.$job['field']];
        }
    }
	echo "<img src=\"img/x.gif\" class=\"building d$i $img\" alt=\"$text\" />";
	//set event last quest
    if (($_SESSION['qst']==38 && QTYPE==37) || ($_SESSION['qst']==31 && QTYPE==25)){
        if ($i<8) {
            $dte=array("tur","purp","yell","oran","green","red","dark");
            $im=$dte[$i-1];
            echo "<img src=\"img/x.gif\" class=\"building e$i rocket $im\" alt=\"$text\" />";
        }
    }
}    
}
    if (($_SESSION['qst']==38 && QTYPE==37) || ($_SESSION['qst']==31 && QTYPE==25)){
        $database->updateUserField($_SESSION['username'],'quest','40',0);
        $_SESSION['qst']=40;
    }  
    if($village->resarray['f39'] == 0) {
            if($building->rallying()) {
            echo "<img src=\"img/x.gif\" class=\"dx1 g16b\" alt=\"Rally Point Level ".$village->resarray['f39']."\" />";
            }
            else {
            echo "<img src=\"img/x.gif\" class=\"dx1 g16e\" alt=\"Rally Point building site\" />";
            }
        }
      else {
      	echo "<img src=\"img/x.gif\" class=\"dx1 g16\" alt=\"Rally Point Level ".$village->resarray['f39']."\" />";
      }
?>
<?php
if($village->resarray['f99t'] == 40) {
if($village->resarray['f99'] >= 0 && $village->resarray['f99'] <= 19) {
echo '<img class="ww g40" src="img/x.gif" alt="Worldwonder">'; }
if($village->resarray['f99'] >= 20 && $village->resarray['f99'] <= 39) {
echo '<img class="ww g40_1" src="img/x.gif" alt="Worldwonder">'; }
if($village->resarray['f99'] >= 40 && $village->resarray['f99'] <= 59) {
echo '<img class="ww g40_2" src="img/x.gif" alt="Worldwonder">'; }
if($village->resarray['f99'] >= 60 && $village->resarray['f99'] <= 79) {
echo '<img class="ww g40_3" src="img/x.gif" alt="Worldwonder">'; }
if($village->resarray['f99'] >= 80 && $village->resarray['f99'] <= 99) {
echo '<img class="ww g40_4" src="img/x.gif" alt="Worldwonder">'; }
if($village->resarray['f99'] == 100) {
echo '<img class="ww g40_5" src="img/x.gif" alt="Worldwonder">'; }
}
?>
    <div id="levels" <?php if(isset($_COOKIE['t3l'])) { echo "class=\"on\""; } ?> >
<?php
for($i=1;$i<=20;$i++) {
if ($village->resarray['f'.($i+18).'t'] != 0) {
echo "<div class=\"d$i\">".$village->resarray['f'.($i+18)]."</div>";
}
}
if($village->resarray['f39t'] != 0) {
echo "<div class=\"l39\">".$village->resarray['f39']."</div>";
}
if($village->resarray['f40t'] != 0) {
echo "<div class=\"l40\">".$village->resarray['f40']."</div>";
}
if($village->resarray['f99t'] != 0) {
echo "<div class=\"d40\">".$village->resarray['f99']."</div>";
} 
?>
		</div>
	<img class="map1" usemap="#map1" src="img/x.gif" alt="" />
	<img class="map2" usemap="#map2" src="img/x.gif" alt="" />
</div>
<img src="img/x.gif" id="lswitch"  <?php if(isset($_COOKIE['t3l'])) { echo "class=\"on\""; } ?> onclick="vil_levels_toggle()" />
