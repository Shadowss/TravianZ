<h1><img class="point" src="img/x.gif" alt="" title="" /> <?php echo OVERVIEW; ?></h1>
<p><?php echo MANUAL_INTRO; ?></p>
<img class="troops" src="img/x.gif" alt="<?php echo TROOPS; ?>" title="<?php echo TROOPS; ?>" />
<img class="buildings" src="img/x.gif" alt="<?php echo BUILDINGS; ?>" title="<?php echo BUILDINGS; ?>" />
<ul>
<li><a href="manual.php?s=1&amp;typ=2"><?php echo TROOPS; ?></a></li>

<ul>
	<li><a href="manual.php?typ=2&amp;s=1"><?php echo TRIBE1; ?></a></li>
	<li><a href="manual.php?typ=2&amp;s=2"><?php echo TRIBE2; ?></a></li>
	<li><a href="manual.php?typ=2&amp;s=3"><?php echo TRIBE3; ?></a></li>
	<?php if(NEW_FUNCTIONS_MANUAL_NATURENATARS){ ?>
	<li><a href="manual.php?typ=2&amp;s=4"><?php echo TRIBE4; ?></a></li>
	<li><a href="manual.php?typ=2&amp;s=5"><?php echo TRIBE5; ?></a></li>
	<?php } ?>
</ul>

<br>

<li><a href="manual.php?typ=3&amp;s=1"><?php echo BUILDINGS; ?></a></li>

<ul>
	<li><a href="manual.php?typ=3&amp;s=1"><?php echo RESOURCES; ?></a></li>
	<li><a href="manual.php?typ=3&amp;s=2"><?php echo Q17_BUTN1; ?></a></li>
	<li><a href="manual.php?typ=3&amp;s=3"><?php echo INFRASTRUCTURE; ?></a></li>
</ul>

<br>
<?php if(NEW_FUNCTIONS_OASIS || NEW_FUNCTIONS_ALLIANCE_INVITATION || NEW_FUNCTIONS_EMBASSY_MECHANICS || NEW_FUNCTIONS_FORUM_POST_MESSAGE || NEW_FUNCTIONS_TRIBE_IMAGES || NEW_FUNCTIONS_MHS_IMAGES || NEW_FUNCTIONS_DISPLAY_ARTIFACT || NEW_FUNCTIONS_DISPLAY_WONDER || NEW_FUNCTIONS_VACATION || NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET || NEW_FUNCTIONS_MANUAL_NATURENATARS || NEW_FUNCTIONS_DISPLAY_LINKS || NEW_FUNCTIONS_MEDAL_3YEAR || NEW_FUNCTIONS_MEDAL_5YEAR || NEW_FUNCTIONS_MEDAL_10YEAR) { ?>
<li><a href="manual.php?typ=13&amp;s=31"><?php echo NEW_FEATURES; ?></a><br><?php echo MANUAL_NEW_FEATURES_DESC; ?></li><br>
<?php } ?>

<li><a href="anleitung.php?s=3" target="_blank"><?php echo MANUAL_FAQ; ?> <img class="external" src="img/x.gif" alt="<?php echo NEW_WINDOW; ?>" title="<?php echo NEW_WINDOW; ?>" /></a><br><?php echo MANUAL_FAQ_DESC; ?> <a href="http://travian.wikia.com/wiki/Travian_Wiki" target=blank>Fandom Travian Wiki</a>.</li>
</ul>
<map id="nav" name="nav">
    <area href="manual.php?typ=3&amp;s=3" title="<?php echo BACK; ?>" coords="0,0,45,18" shape="rect" alt="" />
    <area href="manual.php?s=1" title="<?php echo OVERVIEW; ?>" coords="46,0,70,18" shape="rect" alt="" />
    <area href="manual.php?typ=2&amp;s=1" title="<?php echo FORWARD; ?>" coords="71,0,116,18" shape="rect" alt="" />
</map>
<img usemap="#nav" src="img/x.gif" class="navi" alt="" />