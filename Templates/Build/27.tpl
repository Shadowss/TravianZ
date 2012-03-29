

<body>
    <div id="build" class="gid27">
        <a href="#" onclick="return Popup(27,4);" class="build_logo"><img class="building g27" src="img/x.gif" alt="Treasury" title="Treasury"></a>

        <h1>Treasury <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>

        <p class="build_desc">The riches of your empire are kept in the treasury. The treasury has room for one treasure. After you have captured an artefact it takes 24 hours on a normal server or 12 hours on a thrice speed server to be effective.</p>
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