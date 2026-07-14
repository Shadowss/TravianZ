<h1><img class="unit ugeb" src="img/x.gif" alt="" title="" /> Buildings (Military)</h1>
<ul>
    <li><a href="manual.php?typ=4&amp;gid=12"><?php echo BLACKSMITH; ?></a></li>
    <li><a href="manual.php?typ=4&amp;gid=13"><?php echo ARMOURY; ?></a></li>
    <li><a href="manual.php?typ=4&amp;gid=14"><?php echo TOURNAMENTSQUARE; ?></a></li>
    <li><a href="manual.php?typ=4&amp;gid=16"><?php echo RALLYPOINT; ?></a></li>
    <li><a href="manual.php?typ=4&amp;gid=19"><?php echo BARRACKS; ?></a></li>
    <li><a href="manual.php?typ=4&amp;gid=20"><?php echo STABLE; ?></a></li>
    <li><a href="manual.php?typ=4&amp;gid=21"><?php echo WORKSHOP; ?></a></li>
    <li><a href="manual.php?typ=4&amp;gid=22"><?php echo ACADEMY; ?></a></li>
    <li><a href="manual.php?typ=4&amp;gid=29"><?php echo GREATBARRACKS; ?></a></li>
    <li><a href="manual.php?typ=4&amp;gid=30"><?php echo GREATSTABLE; ?></a></li>
    <li><a href="manual.php?typ=4&amp;gid=49"><?php echo GREATWORKSHOP; ?></a></li>
    <li><a href="manual.php?typ=4&amp;gid=46"><?php echo HOSPITAL; ?></a></li>
    <?php if(defined('NEW_FUNCTION_TRIBE_HUNS') && NEW_FUNCTION_TRIBE_HUNS){ ?><li><a href="manual.php?typ=4&amp;gid=44"><?php echo COMMANDCENTER; ?></a></li>
    <li><a href="manual.php?typ=4&amp;gid=43"><?php echo MAKESHIFTWALL; ?></a></li><?php } ?>
    <?php if(defined('NEW_FUNCTION_TRIBE_EGIPTEANS') && NEW_FUNCTION_TRIBE_EGIPTEANS){ ?><li><a href="manual.php?typ=4&amp;gid=45"><?php echo WATERWORKS; ?></a></li>
    <li><a href="manual.php?typ=4&amp;gid=42"><?php echo STONEWALL; ?></a></li><?php } ?>
    <?php if(defined('NEW_FUNCTION_TRIBE_SPARTANS') && NEW_FUNCTION_TRIBE_SPARTANS){ ?><li><a href="manual.php?typ=4&amp;gid=47"><?php echo DEFENSIVEWALL; ?></a></li><?php } ?>
    <?php if(defined('NEW_FUNCTION_TRIBE_VIKINGS') && NEW_FUNCTION_TRIBE_VIKINGS){ ?><li><a href="manual.php?typ=4&amp;gid=50"><?php echo BARRICADE; ?></a></li><?php } ?>
    <?php if((defined('NEW_FUNCTION_TRIBE_SPARTANS') && NEW_FUNCTION_TRIBE_SPARTANS) || (defined('NEW_FUNCTION_TRIBE_VIKINGS') && NEW_FUNCTION_TRIBE_VIKINGS)){ ?><li><a href="manual.php?typ=4&amp;gid=48"><?php echo BIGHOSPITAL; ?></a></li><?php } ?>
    <li><a href="manual.php?typ=4&amp;gid=36"><?php echo TRAPPER; ?></a></li>
    <li><a href="manual.php?typ=4&amp;gid=37"><?php echo HEROSMANSION; ?></a></li>
</ul>
<map id="nav" name="nav">
    <area href="manual.php?typ=3&amp;s=1" title="<?php echo BACK; ?>" coords="0,0,45,18" shape="rect" alt="" />
    <area href="manual.php?s=1" title="<?php echo OVERVIEW; ?>" coords="46,0,70,18" shape="rect" alt="" />
    <area href="manual.php?typ=3&amp;s=3" title="forward" coords="71,0,116,18" shape="rect" alt="" />
</map>
<img usemap="#nav" src="img/x.gif" class="navi" alt="" />