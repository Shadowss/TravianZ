<div class="stepper">
<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : menu.tpl                                                  ##
##  Type           : Install Panel Frontend & Backend                          ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki (Original)                                          ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2025. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

$steps = ['Intro','Configuration','Database','World Data','Accounts','End'];
$cur = (int)($_GET['s'] ?? 0);
foreach($steps as $i=>$name){
  $state = $i < $cur ? 'done' : ($i == $cur ? 'active' : '');
  echo "<div class='step $state'><span class='num'>".($i+1)."</span><span>$name</span></div>";
}
?>
</div>