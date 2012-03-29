<?php

$founder = $database->getVillage($village->wid);
$newvillage = $database->getMInfo($_GET['id']);
$eigen = $database->getCoor($village->wid);
$from = array('x'=>$eigen['x'], 'y'=>$eigen['y']);
$to = array('x'=>$newvillage['x'], 'y'=>$newvillage['y']);
$time = $generator->procDistanceTime($from,$to,300,0);

echo '<pre>';
//print_r($founder);
echo '</pre>';
?>

<h1>Found new village</h1>
<!--<p>De kolonisten kunnen nog niet vertrekken.<br> Voor het stichten van een nieuw dorp is er nog 750 grondstoffen hout, klei, ijzer en graan nodig.</p>-->
				<form method="POST" action="build.php">
				<input type="hidden" name="a" value="new" />
				<input type="hidden" name="c" value="5" />
				<input type="hidden" name="s" value="<?php echo $_GET['id']; ?>" />
				<input type="hidden" name="id" value="39" />
				<input type="hidden" name="timestamp" value="<?php echo time()+$time ?>" />
		<table class="troop_details" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td class="role"><a href="karte.php?d=<?php echo $founder['0']; ?>&c=<?php echo $generator->getMapCheck($founder['0']); ?>"><?php echo $session->username; ?></a></td><td colspan="10"><a href="karte.php?d=<?php echo $newvillage['id']; ?>&c=<?php echo $generator->getMapCheck($newvillage['0']) ?>">Found new village (<?php echo $newvillage['x']; ?>|<?php echo $newvillage['y']; ?>)</a></td>
		</tr>
	</thead>
	<tbody class="units">
		<tr>
			<th>&nbsp;</th>
				<?php for($i=($session->tribe-1)*10+1;$i<=$session->tribe*10;$i++) {
					echo "<td><img src=\"img/x.gif\" class=\"unit u".$i."\" title=\"".$technology->getUnitName($i)."\" alt=\"".$technology->getUnitName($i)."\" /></td>";
				} ?>
		</tr>
		<tr>
			<th>Troops</th>
				<?php for($i=1;$i<=9;$i++) {
					echo "<td class=\"none\">0</td>";
				} ?>
				<td>3</td>
		</tr>
	</tbody>
	<tbody class="infos">
		<tr>
			<th>Duration</th>
				<td colspan="10"><img class="clock" src="img/x.gif" alt="Duration" title="Duration" /> <?php echo $generator->getTimeFormat($time); ?></td>
		</tr>
	</tbody>
	<tbody class="infos">
		<tr>
			<th>Resources</th>
				<td colspan="10">
				<img class="r1" src="img/x.gif" alt="Wood" title="Wood" />750 | 
				<img class="r2" src="img/x.gif" alt="Clay" title="Clay" />750 | 
				<img class="r3" src="img/x.gif" alt="Iron" title="Iron" />750 | 
				<img class="r4" src="img/x.gif" alt="Crop" title="Crop" />750</td>
		</tr>
	</tbody>
</table>
<p class="btn">
<?php
$mode = CP; 
$total = count($database->getProfileVillages($session->uid)); 
$need_cps = ${'cp'.$mode}[$total];
$cps = $session->cp;

if($cps >= $need_cps) {
?>
<input type="image" value="ok" name="s1" id="btn_ok" class="dynamic_img"  alt="OK" src="img/x.gif" />
<?php
} else {
  print "$cps/$need_cps culture points";
}
?>
</form>
</p>
</div>


