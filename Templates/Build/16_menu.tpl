<div id="textmenu">
	<a href="build.php?id=<?php echo $id; ?>" <?php if(!isset($_GET['t']) || (isset($_GET['t']) && $_GET['t'] == 99 && !$session->goldclub)) echo "class=\"selected\""; ?> ><?php echo OVERVIEW;?></a> |
    <a href="a2b.php"><?php echo SEND_TROOPS;?></a> |
    <a href="warsim.php"><?php echo Q20_RESP1;?></a> 
    <?php if($session->goldclub == 1){ ?>|
    <a href="build.php?id=<?php echo $id; ?>&amp;t=99" <?php if(isset($_GET['t']) && $_GET['t'] == 99) echo "class=\"selected\""; ?> >Gold Club</a>
    <?php } ?>
</div>