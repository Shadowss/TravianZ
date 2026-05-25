<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : playerplusbonus.tpl                     			       ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : ronix (Original)                                          ##
##  Refactored by  : iopietro                                                  ##
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

function fmt_bonus($ts){
    $now = time();
    $ts = (int)$ts;
    if($ts == 0 || $ts <= $now){
        return '<span style="color:#cc0000;">✗ No Bonus</span>';
    }
    $diff = $ts - $now;
    $days = floor($diff / 86400);
    $hours = floor(($diff % 86400) / 3600);
    $mins = floor(($diff % 3600) / 60);
    
    $out = '';
    if($days > 0) $out .= $days.'d ';
    $out .= $hours.'h '.sprintf('%02dm', $mins);
    
    return '<span style="color:#0066cc;font-weight:bold;white-space:nowrap;">✓ '.$out.'</span>';
}
?>
<tr>
    <th><b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b></th>
    <td><?php echo fmt_bonus($user['plus']); ?></td>
</tr>
<tr>
    <th><img src="../img/admin/r/1.gif"> Bonus</th>
    <td><?php echo fmt_bonus($user['b1']); ?></td>
</tr>
<tr>
    <th><img src="../img/admin/r/2.gif"> Bonus</th>
    <td><?php echo fmt_bonus($user['b2']); ?></td>
</tr>
<tr>
    <th><img src="../img/admin/r/3.gif"> Bonus</th>
    <td><?php echo fmt_bonus($user['b3']); ?></td>
</tr>
<tr>
    <th><img src="../img/admin/r/4.gif"> Bonus</th>
    <td><?php echo fmt_bonus($user['b4']); ?></td>
</tr>