<?php
include_once("GameEngine/Generator.php");
$start_timer = $generator->pageLoadTimeStart();

#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =- 			        ##
## ---------------------------------------------------------------------------  ##
## Project:     TravianZ 							##
## Version:     18.02.2014 							##
## Description: When the player builds Wonder of the World      		##
##              to level 100 the winner details are shown.      		##
##              tells the players the game is over              		##
## Authors:     aggenkeech - and a little help from Eyas95      		##
## Page:        winner.php                                      		##
## Fixed by:    Shadow  							##
## License:     TravianZ Project 						##
## Copyright:   TravianZ (c) 2010-2013. All rights reserved. 			##
## URLs:        http://travian.shadowss.ro 					##
## Source code: http://github.com/Shadowss/TravianZ-by-Shadow/ 			##
## 										##
#################################################################################

use App\Utils\AccessLogger;

if (!function_exists('mysqli_result')) {
    function mysqli_result($res, $row, $field=0) {
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
else {
	$building->procBuild($_GET);
}
	$sql = mysqli_query($GLOBALS['link'],"SELECT vref FROM ".TB_PREFIX."fdata WHERE f99 = '100' and f99t = '40'");
	$winner = mysqli_num_rows($sql);

	if($winner!=0){

        ## Get Rankings for Ranking Section
## Top 3 Population
        $q = "
	SELECT ".TB_PREFIX."users.id userid, ".TB_PREFIX."users.username username,".TB_PREFIX."users.alliance alliance, (
	SELECT SUM( ".TB_PREFIX."vdata.pop )
	FROM ".TB_PREFIX."vdata
	WHERE ".TB_PREFIX."vdata.owner = userid
	)totalpop, (
		SELECT COUNT( " . TB_PREFIX . "vdata.wref )
	FROM " . TB_PREFIX . "vdata
	WHERE " . TB_PREFIX . "vdata.owner = userid AND type != 99
	)totalvillages, (
	SELECT " . TB_PREFIX . "alidata.tag
	FROM " . TB_PREFIX . "alidata, " . TB_PREFIX . "users
	WHERE " . TB_PREFIX . "alidata.id = " . TB_PREFIX . "users.alliance
	AND " . TB_PREFIX . "users.id = userid
	)allitag
	FROM " . TB_PREFIX . "users
	WHERE " . TB_PREFIX . "users.access < " . (INCLUDE_ADMIN ? "10" : "8") . "
	ORDER BY totalpop DESC, totalvillages DESC, username ASC";

        $result = (mysqli_query($GLOBALS['link'],$q));
        while($row = mysqli_fetch_assoc($result))
        {
            $datas[] = $row;
        }
        foreach($datas as $result)
        {
            $value['userid'] = $result['userid'];
            $value['username'] = $result['username'];
            $value['alliance'] = $result['alliance'];
            $value['aname'] = $result['allitag'];
            $value['totalpop'] = $result['totalpop'];
            $value['totalvillage'] = $result['totalvillages'];
        }
        ## Top Attacker
        $q = "
	SELECT " . TB_PREFIX . "users.id userid, " . TB_PREFIX . "users.username username, " . TB_PREFIX . "users.apall,  (
	SELECT COUNT( " . TB_PREFIX . "vdata.wref )
	FROM " . TB_PREFIX . "vdata
	WHERE " . TB_PREFIX . "vdata.owner = userid AND type != 99
	)totalvillages, (
	SELECT SUM( " . TB_PREFIX . "vdata.pop )
	FROM " . TB_PREFIX . "vdata
			WHERE " . TB_PREFIX . "vdata.owner = userid
	)pop
	FROM " . TB_PREFIX . "users
	WHERE " . TB_PREFIX . "users.apall >=0 AND " . TB_PREFIX . "users.access < " . (INCLUDE_ADMIN ? "10" : "8") . " AND " . TB_PREFIX . "users.tribe <= 3
	ORDER BY " . TB_PREFIX . "users.apall DESC, pop DESC, username ASC";

        $result = mysqli_query($GLOBALS['link'],$q) or die(mysqli_error($database->dblink));
        while($row = mysqli_fetch_assoc($result))
        {
            $attacker[] = $row;
        }
        foreach($attacker as $key => $row)
        {
            $value['username'] = $row['username'];
            $value['totalvillages'] = $row['totalvillages'];
            $value['id'] = $row['userid'];
            $value['totalpop'] = $row['pop'];
            $value['apall'] = $row['apall'];
        }
        ## Top Defender
        $q = "
	SELECT " . TB_PREFIX . "users.id userid, " . TB_PREFIX . "users.username username, " . TB_PREFIX . "users.dpall,  (
	SELECT COUNT( " . TB_PREFIX . "vdata.wref )
	FROM " . TB_PREFIX . "vdata
	WHERE " . TB_PREFIX . "vdata.owner = userid AND type != 99
	)totalvillages, (
	SELECT SUM( " . TB_PREFIX . "vdata.pop )
	FROM " . TB_PREFIX . "vdata
	WHERE " . TB_PREFIX . "vdata.owner = userid
	)pop
	FROM " . TB_PREFIX . "users
	WHERE " . TB_PREFIX . "users.dpall >=0 AND " . TB_PREFIX . "users.access < " . (INCLUDE_ADMIN ? "10" : "8") . "
	ORDER BY " . TB_PREFIX . "users.dpall DESC, pop DESC, username ASC";
        $result = mysqli_query($GLOBALS['link'],$q) or die(mysqli_error($database->dblink));
        while($row = mysqli_fetch_assoc($result))
        {
            $defender[] = $row;
        }
        foreach($defender as $key => $row)
        {
            $value['username'] = $row['username'];
            $value['totalvillages'] = $row['totalvillages'];
            $value['id'] = $row['userid'];
            $value['totalpop'] = $row['pop'];
            $value['dpall'] = $row['dpall'];
        }

        ## Get WW Winner Details
        $sql = mysqli_query($GLOBALS['link'],"SELECT vref FROM ".TB_PREFIX."fdata WHERE f99 = '100' and f99t = '40'");
        $vref = mysqli_result($sql, 0);

        $winningvillagename = $database->getVillage($vref)['name'];
        $owner = $database->getVillage($vref)['owner'];

        $sql = mysqli_query($GLOBALS['link'],"SELECT username FROM ".TB_PREFIX."users WHERE id = '$owner'")or die(mysqli_error($database->dblink));
        $username = mysqli_result($sql, 0);

        $sql = mysqli_query($GLOBALS['link'],"SELECT alliance FROM ".TB_PREFIX."users WHERE id = '$owner'")or die(mysqli_error($database->dblink));
        $allianceid = mysqli_result($sql, 0);

        $sql = mysqli_query($GLOBALS['link'],"SELECT name, tag FROM ".TB_PREFIX."alidata WHERE id = '$allianceid'")or die(mysqli_error($database->dblink));
        $winningalliance = mysqli_result($sql, 0);

        $sql = mysqli_query($GLOBALS['link'],"SELECT tag FROM ".TB_PREFIX."alidata WHERE id = '$allianceid'")or die(mysqli_error($database->dblink));
        $winningalliancetag = mysqli_result($sql, 0);
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
		<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7h" rel="stylesheet" type="text/css" />
		<?php
		if($session->gpack == null || GP_ENABLE == false)
		{
			echo "
			<link href='".GP_LOCATE."travian.css?e21d2' rel='stylesheet' type='text/css' />
			<link href='".GP_LOCATE."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
		}
		else
		{
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
					<br /><br />
					All good things must come to an end, and so too must this age. Once solomon was given a ring, upon which was inscribed a message that could take away all
					the joys or sorrows of the world, that message was roughly translated "this too shall pass". It is both our joy and sorrow to announce to all Players that
					this too has now passed! We hope you enjoyed your time with us as much as we enjoyed serving you and thank you for staying until the very end!<br /><br />

					The results: Day had long since passed into night, yet the workers in <?php echo "<a href=\"karte.php?d=$vref&c=".$generator->getMapCheck($vref)."\">$winningvillagename</a>"; ?>,
					laboured on throught the wintery eve, every wary of the countless armies marching to destroy their work, knowing that they raced against time and the greatest
					threat that had ever faced the free people. Their tireless struggles were rewarded at <b><?php echo date('H:i:s'); ?></b> on <b><?php echo date('d. M. Y'); ?></b> after a
					nameless worker laid the dinal stone in what will forever known as the greatest and most magnificent creation in all of history since the fall of the Natars<br /><br />

					Together with the alliance "<?php echo "<a href=\"allianz.php?aid=$allianceid\">$winningalliancetag</a>"; ?>", "<?php echo "<a href=\"spieler.php?uid=$owner\">$username</a>"; ?>"
					was the first to finish the Wonder of the World, using millions of resources whilst also protecting it with hundereds of thousands of brave defenders. It is therefore <b><?php echo "<a href=\"spieler.php?uid=$owner\">$username</a>"; ?></b>
					who recieves the title "Winner of this era"!<br /><br />


					"<a href="spieler.php?uid=<?php echo $datas[0]['userid']; ?>" title="Total Villages: <?php echo $datas[0]['totalvillages']; echo "\n";?>Total Population: <?php echo $datas[0]['totalpop']; ?>"><?php echo $datas[0]['username']; ?></a>" was the ruler over the largest personal empire, followed closely by "<a href="spieler.php?uid=<?php echo $datas[1]['userid']; ?>" title="Total Villages: <?php echo $datas[1]['totalvillages']; echo "\n";?>Total Population: <?php echo $datas[1]['totalpop']; ?>"><?php echo $datas[1]['username']; ?></a>" and "<a href="spieler.php?uid=<?php echo $datas[2]['userid']; ?>" title="Total Villages: <?php echo $datas[2]['totalvillages']; echo "\n";?>Total Population: <?php echo $datas[2]['totalpop']; ?>"><?php echo $datas[2]['username']; ?></a>".<br />
					"<a href="spieler.php?uid=<?php echo $attacker[0]['userid']; ?>" title="Total Villages: <?php echo $attacker[0]['totalvillages']; echo "\n"; ?>Attack Points: <?php echo $attacker[0]['apall']; ?>"><?php echo $attacker[0]['username']; ?></a>" slew more than any other, and was the mightiest, most fearsome commander.<br />
					"<a href="spieler.php?uid=<?php echo $defender[0]['userid']; ?>" title="Total Villages: <?php echo $defender[0]['totalvillages']; echo "\n"; ?>Defence Points: <?php echo $defender[0]['dpall'];?>"><?php echo $defender[0]['username']; ?></a>" was the most glorious defender, slaugtering enemies at the village gates, staining the lands around those villages with their blood.
					<br /><br />
					<p>Congratulations to everyone.</p>
					<br /><br />
					Best Regards,<br />
					<?php echo SERVER_NAME; ?> Team<br /><br /><br /><br />
					<small><i>(By: Shadow v7.0.0)</i></small></p>

					<br /><br />
					<div style="text-align: center"><a href="dorf1.php">&raquo; Continue</a></div>
				</div>
				<br /><br /><br /><br /><div id="side_info">
					<?php
					include("Templates/multivillage.tpl");
					include("Templates/quest.tpl");
					include("Templates/news.tpl");
					include("Templates/links.tpl");
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
						Calculated in <b><?php echo round(($generator->pageLoadTimeEnd()-$start_timer)*1000);?></b> ms
						<br/>Server time: <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
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
