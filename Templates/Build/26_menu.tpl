<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : PALACE MENU                                               ##
##  Type           : BUILDING TEMPLATE                                         ##
## --------------------------------------------------------------------------- ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  Test Server    : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

global $id;

$current = $_GET['s'] ?? '';
$menu = [
    ''  => TRAIN,
    '2' => CULTURE_POINTS,
    '3' => LOYALTY,
    '4' => EXPANSION,
];
?>
<div id="textmenu">
<?php 
$first = true;
foreach ($menu as $s => $label):
    if (!$first) echo ' | ';
    $first = false;
    
    $url = 'build.php?id='.(int)$id.($s !== '' ? '&amp;s='.$s : '');
    $selected = ($current === (string)$s) ? ' class="selected"' : '';
?>
    <a href="<?php echo $url;?>"<?php echo $selected;?>><?php echo $label;?></a>
<?php endforeach; ?>
</div>