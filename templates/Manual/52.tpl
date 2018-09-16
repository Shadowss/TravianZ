<?php
$count="0";
include_once("GameEngine/Config.php");

// go max 5 levels up - we don't have folders that go deeper than that
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix.'autoloader.php')) {
        // we have our path, let's leave
        break;
    }
}

include_once($autoprefix."GameEngine/Database.php");

$q = "SELECT Count(*) as Total FROM ".TB_PREFIX."movement where endtime < ".time()." and proc = 0";
$result = mysqli_fetch_array(mysqli_query($GLOBALS["link"], $q), MYSQLI_ASSOC);
$count=$result['Total'];

?>

<h1><img class="point" src="img/x.gif" alt="" title="" /> event jam (00:00:0?)</h1>

<p>
All events occurring at a later time get calculated by an event system. In case the server is overloaded or the connection between webserver and database is bad an event jam can result of this.
<br />
As soon as more events are received per second than can be calculated per second, events (e.g."construction finished" or "troops arrived") will be put into a waiting loop.
<br />
The chronological order of troop movements stays the same, even in an event jam, so troops that would normally arrive somewhere first would still arrive there first.
<br />
As player, nothing can be done against an event jam except waiting. Normally these problems get resolved after a few minutes automatically. At the moment <b><?php echo $count; ?></b> events await
</p>
<map id="nav" name="nav">
    <area href="manual.php?s=1" title="back" coords="0,0,45,18" shape="rect" alt="" />
    <area href="manual.php?s=1" title="Overview" coords="46,0,70,18" shape="rect" alt="" />
    <area href="manual.php?s=1" title="forward" coords="71,0,116,18" shape="rect" alt="" />
</map>
<img usemap="#nav" src="img/x.gif" class="navi" alt="" />