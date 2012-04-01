<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       ZravianX                                                    ##
##  Version:       2011.11.05                                                  ##
##  Filename:      Templates/homenews.tpl                                      ##
##  Developed by:  ZZJHONS                                                     ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     ZravianX (c) 2011 - All rights reserved                     ##
##  URLs:          http://zravianx.zzjhons.com                                 ##
##  Source code:   http://www.github.com/ZZJHONS/ZravianX                      ##
##                                                                             ##
#################################################################################

if (HOME1 or HOME2 or HOME3){
?>
<div id="news">
    <div id="news-head"></div>
    <div id="news-content">
        <h3 class="news bold"><?php echo NEWS; ?></h3>
        <?php
            if(HOME1){echo '<div class="news-items"><div class="news">'; include("Templates/News/home/home1.tpl"); echo '</div></div>';};
                if(HOME1 & HOME2 == true){echo '<div class="news-divider"></div>';}
                else if(HOME1 & HOME3 == true){echo '<div class="news-divider"></div>';}
                else echo '';
            
            if(HOME2){echo '<div class="news-items"><div class="news">'; include("Templates/News/home/home2.tpl"); echo '</div></div>';};
                if(HOME2 & HOME3 == true){echo '<div class="news-divider"></div>';}
                else echo '';
            
            if(HOME3){echo '<div class="news-items"><div class="news">'; include("Templates/News/home/home3.tpl"); echo '</div></div>';};
        ?>
    </div>
    <div id="news-bottom"></div>
</div>
<?php } ?>