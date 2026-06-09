<?php
// ww.tpl - World Wonder
global $building, $village, $database, $id, $session;

$loopsame = ($building->isCurrent($id) || $building->isLoop($id)) ? 1 : 0;
$doublebuild = ($building->isCurrent($id) && $building->isLoop($id)) ? 1 : 0;

$vref = (int)$_SESSION['wid'];
$wwname = $database->getWWName($vref);
$level = (int)$village->resarray['f'.$id];
?>
<div id="build" class="gid40">
    <a href="#" onClick="return Popup(40,4);" class="build_logo">
        <img class="building g40" src="img/x.gif" alt="<?php echo WORLD_WONDER; ?>" title="<?php echo WORLD_WONDER;?>" />
    </a>
    <h1><?php echo WONDER;?><br /><span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc"><?php echo WONDER_DESC;?></p>

    <form action="GameEngine/Game/WorldWonderName.php" method="POST">
        <?php
        $disabled = ($level < 1 || $level > 10) ? 'disabled="disabled"' : '';
        $msg = $level < 0 ? WORLD_WONDER_CHANGE_NAME.'.' : ($level > 10 ? WORLD_WONDER_NOTCHANGE_NAME.'.' : '');
        if ($msg) echo $msg;
        ?>
        <center><br /><?php echo WORLD_WONDER_NAME;?>: 
            <input class="text" name="wwname" id="wwname" <?php echo $disabled;?> value="<?php echo htmlspecialchars($wwname);?>" maxlength="20">
        </center>
        <p class="btn">
            <button type="submit" tabindex="9" name="s1" id="btn_ok" class="trav_buttons" <?php echo $disabled;?> alt="OK"><?php echo TZ_OK_2; ?></button>
        </p>
    </form>

    <?php if (isset($_GET['n'])):?>
        <div style="text-align: center"><font color="Red"><b><?php echo WORLD_WONDER_NAME_CHANGED;?>.</b></font></div><br />
    <?php endif;?>

    <?php include("wwupgrade.tpl");?>
</div>