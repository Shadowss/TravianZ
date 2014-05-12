

<body>
    <div id="build" class="gid27">
        <a href="#" onclick="return Popup(27,4);" class="build_logo"><img class="building g27" src="img/x.gif" alt="Treasury" title="<?php echo TREASURY; ?>"></a>

        <h1><?php echo TREASURY; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>

        <p class="build_desc"><?php echo TREASURY_DESC; ?></p>
        <?php
        
        include("27_menu.tpl");
        if(isset($_GET['show'])){  include("27_show.tpl");  }else{
        if(!isset($_GET['t'])){
            include("27_1.tpl");     
        }elseif(isset($_GET['t']) && $_GET['t'] == 2){
            include("27_2.tpl"); 
        }elseif(isset($_GET['t']) && $_GET['t'] == 3){
            include("27_3.tpl");
        }
        }
        
        include("upgrade.tpl");
        ?>
    </div>