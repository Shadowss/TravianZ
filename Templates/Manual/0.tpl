<h1><img class="point" src="img/x.gif" alt="" title="" /> Overview</h1>
<p>This ingame help offers you the chance to look up important information at any time.</p>
<img class="troops" src="img/x.gif" alt="Troops" title="Troops" />
<img class="buildings" src="img/x.gif" alt="Buildings" title="Buildings" />
<ul>
<li><a href="manual.php?s=1&amp;typ=2">The troops</a></li>

<ul>
	<li><a href="manual.php?typ=2&amp;s=1">Romans</a></li>
	<li><a href="manual.php?typ=2&amp;s=2">Teutons</a></li>
	<li><a href="manual.php?typ=2&amp;s=3">Gauls</a></li>
	<?php if(NEW_FUNCTIONS_MANUAL_NATURENATARS){ ?>
	<li><a href="manual.php?typ=2&amp;s=4">Nature</a></li>
	<li><a href="manual.php?typ=2&amp;s=5">Natars</a></li>
	<?php } ?>
</ul>

<br>

<li><a href="manual.php?typ=3&amp;s=1">The buildings</a></li>

<ul>
    <li><a href="manual.php?typ=3&amp;s=1">Resources</a></li>
    <li><a href="manual.php?typ=3&amp;s=2">Military</a></li>
    <li><a href="manual.php?typ=3&amp;s=3">Infrastructure</a></li>
</ul>

<br>
<?php if(NEW_FUNCTIONS_OASIS || NEW_FUNCTIONS_ALLIANCE_INVITATION || NEW_FUNCTIONS_EMBASSY_MECHANICS || NEW_FUNCTIONS_FORUM_POST_MESSAGE || NEW_FUNCTIONS_TRIBE_IMAGES || NEW_FUNCTIONS_MHS_IMAGES || NEW_FUNCTIONS_DISPLAY_ARTIFACT || NEW_FUNCTIONS_DISPLAY_WONDER || NEW_FUNCTIONS_VACATION || NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET || NEW_FUNCTIONS_MANUAL_NATURENATARS || NEW_FUNCTIONS_DISPLAY_LINKS || NEW_FUNCTIONS_MEDAL_3YEAR || NEW_FUNCTIONS_MEDAL_5YEAR || NEW_FUNCTIONS_MEDAL_10YEAR) { ?>
<li><a href="manual.php?typ=13&amp;s=31">New features</a><br>These are new features that you will not find in the real version of the game Travian T3.6. Here you can get acquainted with all new features in more detail.</li><br>
<?php } ?>

<li><a href="anleitung.php?s=3" target="_blank">Travian FAQ <img class="external" src="img/x.gif" alt="new window" title="new window" /></a><br>This ingame help just gives you brief information. More information is available at the <a href="http://travian.wikia.com/wiki/Travian_Wiki" target=blank>Fandom Travian Wiki</a>.</li>
</ul>
<map id="nav" name="nav">
    <area href="manual.php?typ=3&amp;s=3" title="back" coords="0,0,45,18" shape="rect" alt="" />
    <area href="manual.php?s=1" title="Overview" coords="46,0,70,18" shape="rect" alt="" />
    <area href="manual.php?typ=2&amp;s=1" title="forward" coords="71,0,116,18" shape="rect" alt="" />
</map>
<img usemap="#nav" src="img/x.gif" class="navi" alt="" />