<?php
##################################################################
## Page:        winner.php                                      ##
## Description: When the player builds Wonder of the World      ##
##              to level 100 the winner details are shown.      ##
##              tells the players the game is over              ##
## Authors:     aggenkeech - and a little help from Eyas95      ##
## Created:     31/03/2012                                      ##
##################################################################
include("GameEngine/Village.php");
$start = $generator->pageLoadTimeStart();
if(isset($_GET['newdid'])) {
	$_SESSION['wid'] = $_GET['newdid'];
	header("Location: ".$_SERVER['PHP_SELF']);
}
else {
	$building->procBuild($_GET);
}

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

	$result = (mysql_query($q));
	while($row = mysql_fetch_assoc($result))
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

	$result = mysql_query($q) or die(mysql_error());
	while($row = mysql_fetch_assoc($result))
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
	$result = mysql_query($q) or die(mysql_error());
	while($row = mysql_fetch_assoc($result))
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
	$sql = mysql_query("SELECT vref FROM ".TB_PREFIX."fdata WHERE f99 = '100' and f99t = '40'");
	$vref = mysql_result($sql, 0);

	$sql = mysql_query("SELECT name FROM ".TB_PREFIX."vdata WHERE wref = '$vref'")or die(mysql_error());
	$winningvillagename = mysql_result($sql, 0);

	$sql = mysql_query("SELECT owner FROM ".TB_PREFIX."vdata WHERE wref = '$vref'")or die(mysql_error());
	$owner = mysql_result($sql, 0);

	$sql = mysql_query("SELECT username FROM ".TB_PREFIX."users WHERE id = '$owner'")or die(mysql_error());
	$username = mysql_result($sql, 0);

	$sql = mysql_query("SELECT alliance FROM ".TB_PREFIX."users WHERE id = '$owner'")or die(mysql_error());
	$allianceid = mysql_result($sql, 0);

	$sql = mysql_query("SELECT name, tag FROM ".TB_PREFIX."alidata WHERE id = '$allianceid'")or die(mysql_error());
	$winningalliance = mysql_result($sql, 0);

	$sql = mysql_query("SELECT tag FROM ".TB_PREFIX."alidata WHERE id = '$allianceid'")or die(mysql_error());
	$winningalliancetag = mysql_result($sql, 0);

	$sql = mysql_query("SELECT vref FROM ".TB_PREFIX."fdata WHERE f99 = '100' and f99t = '40'");
	$winner = mysql_num_rows($sql);

	if($winner!=0){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?php echo SERVER_NAME ?></title>
		<link REL="shortcut icon" HREF="favicon.ico"/>
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="imagetoolbar" content="no" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<script src="mt-full.js?0faaa" type="text/javascript"></script>
		<script src="unx.js?0faaa" type="text/javascript"></script>
		<script src="new.js?0faaa" type="text/javascript"></script>
		<link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7c" rel="stylesheet" type="text/css" />
		<link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7c" rel="stylesheet" type="text/css" />
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
			<img style="filter: chroma();" src="img/x.gif" id="msfilter" alt="">
			<div id="dynamic_header"></div>
			<?php include("Templates/header.tpl"); ?>
			<div id="mid">
				<?php include("Templates/menu.tpl"); ?>
				<div id="content" class="village2" style="font-size: 9pt;">
					<img src="data:image/png;base64, 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" align="right" style="padding-top: 40px;">
					<p>
					<b>Dear <?php echo SERVER_NAME; ?> Players,</b>
					<br /><br />
					All good things must come to an end, and so too must this age. Once solomon was given a ring, upon which was inscribed a message that could take away all
					the joys or sorrows of the world, that message was roughly translated "this too shall pass". It is both our joy and sorrow to announce to all Players that
					this too has now passed! We hope you enjoyed your time with us as much as we enjoyed serving you and thank you for staying until the very end!<br /><br />

					The results: Day had long since passed into night, yet the workers in <?php echo "<a href=\"karte.php?d=$vref&c=".$generator->getMapCheck($vref)."\">$winningvillagename</a>"; ?>,
					laboured on throught the wintery eve, every wary of the countless armies marching to destroy their work, knowing that they raced against time and the greatest
					threat that had ever faced the free people. Their tireless struggles were rewared at <strike><b>Time</b></strike> on <strike><b>Date</b></strike> after a
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
					<small><i>(By: aggenkeech & Eyas95)</i></small></p>

					<br /><br />
					<center><a href="dorf1.php">&raquo; Continue</a></center>
				</div>
				</br></br></br></br><div id="side_info">
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
						Calculated in <b><?php echo round(($generator->pageLoadTimeEnd()-$start)*1000);?></b> ms
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
}
?>