<body>
    <div id="build" class="gid27">
        <a href="#" onclick="return Popup(27,4);" class="build_logo"><img class="building g27" src="img/x.gif" alt="<?php echo TREASURY; ?>" title="<?php echo TREASURY; ?>"></a>

        <h1><?php echo TREASURY; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id] ?? 0; ?></span></h1>

        <p class="build_desc"><?php echo TREASURY_DESC; ?></p>
        <?php     
        $treasuryLevel = $building->getTypeLevel(27) ?? 0;
        
        if($treasuryLevel > 0){
            include("27_menu.tpl");
            
            $show = (int)($_GET['show'] ?? 0);
            $t = (int)($_GET['t'] ?? 0);
            
            if($show > 0) {
                include("27_show.tpl");
            } else {
                if($t === 0 || $t === 1) {
                    include("27_1.tpl");
                } elseif($t === 2) {
                    include("27_2.tpl");
                } elseif($t === 3) {
                    include("27_3.tpl");
                } else {
                    include("27_1.tpl");
                }
            }       
        } else {
            echo '<b>'.TREASURY_COMMENCE.'</b><br>';
        }
        
        include("upgrade.tpl");
        ?>
    </div>