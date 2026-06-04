<?php
include_once("GameEngine/Generator.php");
$start_timer = $generator->pageLoadTimeStart();

#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =- 			        			##
## ---------------------------------------------------------------------------  ##
## Project:     TravianZ 														##
## Version:     18.02.2014 														##
## Description: When the player builds Wonder of the World      				##
##              to level 100 the winner details are shown.      				##
##              tells the players the game is over              				##
## Authors:     aggenkeech - and a little help from Eyas95      				##
## Page:        winner.php                                      				##
## Fixed by:    Shadow  														##
## License:     TravianZ Project 												##
## Copyright:   TravianZ (c) 2010-2026. All rights reserved. 					##
## URLs:        http://travianz.org      										##
## Source code: https://github.com/Shadowss/TravianZ/	 						##
## 																				##
#################################################################################

use App\Utils\AccessLogger;

if (!function_exists('mysqli_result')) {
    function mysqli_result($res, $row, $field = 0) {
        $res->data_seek($row);
        $datarow = $res->fetch_array();
        return $datarow[$field];
    }
}

include_once("GameEngine/Village.php");
AccessLogger::logRequest();

if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	header("Location: ".$_SERVER['PHP_SELF']);
	exit;
}

/*
|--------------------------------------------------------------------------
| CHECK WW WINNER EXISTS
|--------------------------------------------------------------------------
*/

$sql = mysqli_query($database->dblink,"SELECT 1 FROM " . TB_PREFIX . "fdata WHERE f99 = '100' AND f99t = '40' LIMIT 1");
$winner = mysqli_fetch_row($sql);
if ($winner) {

    /*
    |--------------------------------------------------------------------------
    | TOP POPULATION
    |--------------------------------------------------------------------------
    */

    $q = "SELECT 
        u.id AS userid,
        u.username,
        u.alliance,
        (SELECT SUM(v.pop) FROM " . TB_PREFIX . "vdata v WHERE v.owner = u.id) AS totalpop,
        (SELECT COUNT(v.wref) FROM " . TB_PREFIX . "vdata v WHERE v.owner = u.id AND v.type != 99) AS totalvillages,
        (SELECT a.tag FROM " . TB_PREFIX . "alidata a WHERE a.id = u.alliance) AS allitag
    FROM " . TB_PREFIX . "users u
    WHERE u.access < " . (INCLUDE_ADMIN ? "10" : "8") . " AND u.tribe <= 3
    ORDER BY totalpop DESC, totalvillages DESC, u.username ASC";

        $result = (mysqli_query($database->dblink,$q));
        while($row = mysqli_fetch_assoc($result)) $datas[] = $row;

        foreach($datas as $result){
            $value['userid'] = $result['userid'];
            $value['username'] = $result['username'];
            $value['alliance'] = $result['alliance'];
            $value['aname'] = $result['allitag'];
            $value['totalpop'] = $result['totalpop'];
            $value['totalvillage'] = $result['totalvillages'];
		}

    /*
    |--------------------------------------------------------------------------
    | TOP ATTACKER
    |--------------------------------------------------------------------------
    */

    $q = "SELECT 
        u.id AS userid,
        u.username,
        u.apall,
        (SELECT COUNT(v.wref) FROM " . TB_PREFIX . "vdata v WHERE v.owner = u.id AND v.type != 99) AS totalvillages,
        (SELECT SUM(v.pop) FROM " . TB_PREFIX . "vdata v WHERE v.owner = u.id) AS pop
    FROM " . TB_PREFIX . "users u
    WHERE u.apall >= 0 AND u.access < " . (INCLUDE_ADMIN ? "10" : "8") . " AND u.tribe <= 3
    ORDER BY u.apall DESC, pop DESC, u.username ASC";

        $result = mysqli_query($database->dblink,$q);
        while($row = mysqli_fetch_assoc($result)) $attacker[] = $row;

        foreach($attacker as $key => $row){
            $value['username'] = $row['username'];
            $value['totalvillages'] = $row['totalvillages'];
            $value['id'] = $row['userid'];
            $value['totalpop'] = $row['pop'];
            $value['apall'] = $row['apall'];
        }

    /*
    |--------------------------------------------------------------------------
    | TOP DEFENDER
    |--------------------------------------------------------------------------
    */

    $q = "SELECT 
        u.id AS userid,
        u.username,
        u.dpall,
        (SELECT COUNT(v.wref) FROM " . TB_PREFIX . "vdata v WHERE v.owner = u.id AND v.type != 99) AS totalvillages,
        (SELECT SUM(v.pop) FROM " . TB_PREFIX . "vdata v WHERE v.owner = u.id) AS pop
    FROM " . TB_PREFIX . "users u
    WHERE u.dpall >= 0 AND u.access < " . (INCLUDE_ADMIN ? "10" : "8") . " AND u.tribe <= 3
    ORDER BY u.dpall DESC, pop DESC, u.username ASC";

        $result = mysqli_query($database->dblink,$q);
        while($row = mysqli_fetch_assoc($result)) $defender[] = $row;

        foreach($defender as $key => $row){
            $value['username'] = $row['username'];
            $value['totalvillages'] = $row['totalvillages'];
            $value['id'] = $row['userid'];
            $value['totalpop'] = $row['pop'];
            $value['dpall'] = $row['dpall'];
        }

    /*
    |--------------------------------------------------------------------------
    | WW WINNER DETAILS
    |--------------------------------------------------------------------------
    */

    $q = "SELECT 
        f.vref,
        f.ww_lastupdate,
        v.name AS village_name,
        v.owner AS owner_id,
        u.username,
        a.id AS alliance_id,
        a.name AS alliance_name,
        a.tag AS alliance_tag
    FROM " . TB_PREFIX . "fdata f
    LEFT JOIN " . TB_PREFIX . "vdata v ON v.wref = f.vref
    LEFT JOIN " . TB_PREFIX . "users u ON u.id = v.owner
    LEFT JOIN " . TB_PREFIX . "alidata a ON a.id = u.alliance
    WHERE f.f99 = '100' AND f.f99t = '40'
    LIMIT 1";

    $result = mysqli_query($database->dblink, $q);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $vref = $row['vref'];
        $winningvillagename = $row['village_name'];
        $owner = $row['owner_id'];
        $username = $row['username'];
        $allianceid = $row['alliance_id'];
        $winningalliance = $row['alliance_name'];
        $winningalliancetag = $row['alliance_tag'];
        $finishconstruction = $row['ww_lastupdate'];
    } else {
        $vref = 0;
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?php echo SERVER_NAME ?> - Game Over</title>
		<link rel="shortcut icon" href="favicon.ico"/>
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="imagetoolbar" content="no" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<script src="mt-full.js?0faab" type="text/javascript"></script>
		<script src="unx.js?f4b7h" type="text/javascript"></script>
		<script src="new.js?0faab" type="text/javascript"></script>
		<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css" />
		<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />
		<?php
		if($session->gpack == null || GP_ENABLE == false){
			echo "
			<link href='".GP_LOCATE."travian.css?e21d2' rel='stylesheet' type='text/css' />
			<link href='".GP_LOCATE."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
		}else{
			echo "
			<link href='".$session->gpack."travian.css?e21d2' rel='stylesheet' type='text/css' />
			<link href='".$session->gpack."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
		}
		?>
		<script type="text/javascript">window.addEvent('domready', start);</script>
		<style type="text/css">
		.style1 {
		 text-align: center;
		}
		.style2 {
		 border-width: 0px;
		}
		</style>
	</head>
	<body class="v35 ie ie8">
		<div class="wrapper">
			<img style="filter: chroma();" src="img/x.gif" id="msfilter" alt="" />
			<div id="dynamic_header"></div>
			<?php include("Templates/header.tpl"); ?>
			<div id="mid">
				<?php include("Templates/menu.tpl"); ?>
				<div id="content" class="village2" style="font-size: 9pt;">
					<img src="./gpack/travian_default/img/misc/win.png" align="right" style="padding-top: 40px;" />
					<p>
					<b>Dear <?php echo SERVER_NAME; ?> Players,</b>
					<br /><br /><br /><br />
					All good things must come to an end, and so too must this age. Once solomon was given a ring, upon which was inscribed a message that could take away all
					the joys or sorrows of the world, that message was roughly translated "this too shall pass". It is both our joy and sorrow to announce to all Players that
					this too has now passed! We hope you enjoyed your time with us as much as we enjoyed serving you and thank you for staying until the very end!<br />
					<center><h3 style="color:#3498db;">📜 The Results</h3></center>
					Day had long since passed into night, yet the workers in <?php echo "<a href=\"karte.php?d=$vref&c=".$generator->getMapCheck($vref)."\">$winningvillagename</a>"; ?>,
					laboured on throught the wintery eve, every wary of the countless armies marching to destroy their work, knowing that they raced against time and the greatest
					threat that had ever faced the free people. Their tireless struggles were rewarded at <b><?php echo date('H:i:s', $finishconstruction); ?></b> on <b><?php echo date('d. M. Y', $finishconstruction); ?></b> after a
					nameless worker laid the dinal stone in what will forever known as the greatest and most magnificent creation in all of history since the fall of the Natars<br />
					Together with the alliance "<?php echo "<a href=\"allianz.php?aid=$allianceid\">$winningalliancetag</a>"; ?>", "<?php echo "<a href=\"spieler.php?uid=$owner\">$username</a>"; ?>"
					was the first to finish the Wonder of the World, using millions of resources whilst also protecting it with hundereds of thousands of brave defenders. It is therefore <b><?php echo "<a href=\"spieler.php?uid=$owner\">$username</a>"; ?></b>
					who recieves the title "Winner of this era"!<br />
					<center><h3 style="color:#f39c12;">👑 Top Players</h3></center>
					"<a href="spieler.php?uid=<?php echo $datas[0]['userid']; ?>" title="Total Villages: <?php echo $datas[0]['totalvillages']; echo "\n";?>Total Population: <?php echo $datas[0]['totalpop']; ?>"><?php echo $datas[0]['username']; ?></a>" was the ruler over the largest personal empire, followed closely by "<a href="spieler.php?uid=<?php echo $datas[1]['userid']; ?>" title="Total Villages: <?php echo $datas[1]['totalvillages']; echo "\n";?>Total Population: <?php echo $datas[1]['totalpop']; ?>"><?php echo $datas[1]['username']; ?></a>" and "<a href="spieler.php?uid=<?php echo $datas[2]['userid']; ?>" title="Total Villages: <?php echo $datas[2]['totalvillages']; echo "\n";?>Total Population: <?php echo $datas[2]['totalpop']; ?>"><?php echo $datas[2]['username']; ?></a>".<br />
					<center><h3 style="color:#e74c3c;">⚔️ Top Attackers</h3></center>
					Without requiring any introduction, "<a href="spieler.php?uid=<?php echo $attacker[0]['userid']; ?>" title="Total Villages: <?php echo $attacker[0]['totalvillages']; echo "\n"; ?>Attack Points: <?php echo $attacker[0]['apall']; ?>"><?php echo $attacker[0]['username']; ?></a>" was quickly recognized in the gathered crowd, with shades of awe and fear. Building a reputation for cunning and cruel tactics on the battlefield, he is known as the most ruthless of the attackers. Together, with glancing gaze and the glory of the won battles, there are "<a href="spieler.php?uid=<?php echo $attacker[1]['userid']; ?>" title="Total Villages: <?php echo $attacker[1]['totalvillages']; echo "\n"; ?>Attack Points: <?php echo $attacker[1]['apall']; ?>"><?php echo $attacker[1]['username']; ?></a>" and "<a href="spieler.php?uid=<?php echo $attacker[2]['userid']; ?>" title="Total Villages: <?php echo $attacker[2]['totalvillages']; echo "\n"; ?>Attack Points: <?php echo $attacker[2]['apall']; ?>"><?php echo $attacker[2]['username']; ?></a>" commanders of the second and third army of attack. Their skill in the battle will inspire legends in the coming era.<br />
					<center><h3 style="color:#2ecc71;">🛡️ Top Defenders</h3></center>
					"<a href="spieler.php?uid=<?php echo $defender[0]['userid']; ?>" title="Total Villages: <?php echo $defender[0]['totalvillages']; echo "\n"; ?>Defence Points: <?php echo $defender[0]['dpall'];?>"><?php echo $defender[0]['username']; ?></a>" was greeted by the gathered, while following the procession to the top. A brilliant strategist and champion of the people, he is known throughout the world as the greatest defender ever to protect a city. Next to honor, "<a href="spieler.php?uid=<?php echo $defender[1]['userid']; ?>" title="Total Villages: <?php echo $defender[1]['totalvillages']; echo "\n"; ?>Defence Points: <?php echo $defender[1]['dpall'];?>"><?php echo $defender[1]['username']; ?></a> and "<a href="spieler.php?uid=<?php echo $defender[2]['userid']; ?>" title="Total Villages: <?php echo $defender[2]['totalvillages']; echo "\n"; ?>Defence Points: <?php echo $defender[2]['dpall'];?>"><?php echo $defender[2]['username']; ?></a>" the commanders of the second and third armies of brave defenders look proudly at the grateful crowd.
					<p>Warriors, leaders, heroes, stood together, looking over the world they explored and conquered. Although the feast will end and people will go back to their daily lives again, this day will remain in their memory forever.</p>
					<p>We, the TravianZ Team, thank you and we look forward to a new adventure in a new TravianZ world.</p>
					Best Regards,
					<?php echo SERVER_NAME; ?> Team<br />
					 <p style="text-align:center;font-size:12px;color:#777;">
					(By: TravianZ team v8.3.5)</p>
					</p>
					<br /><br />
					<div style="text-align: center"><a href="dorf1.php">&raquo; Continue</a></div>
				</div>
				<br /><br /><br /><br /><div id="side_info">
					<?php
					include("Templates/multivillage.tpl");
					include("Templates/quest.tpl");
					include("Templates/news.tpl");
					if(!NEW_FUNCTIONS_DISPLAY_LINKS) {
						echo "<br><br><br><br>";
						include("Templates/links.tpl");
					}
					?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="footer-stopper"></div>
			<div class="clear"></div>
			<?php
			include("Templates/res.tpl");
			include("Templates/footer.tpl");
			?>
			<div id="stime">
				<div id="ltime">
					<div id="ltimeWrap">
						<?php echo CALCULATED_IN;?> <b><?php
				echo round(($generator->pageLoadTimeEnd()-$start_timer)*1000);
				?>
</b> ms
<br /><?php echo SERVER_TIME;?> <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
					</div>
				</div>
			</div>
		<div id="ce">
	</body>
</html>
<?php
}else{
header("Location: dorf1.php");
exit;
}
?>
