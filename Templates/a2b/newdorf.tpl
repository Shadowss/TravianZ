<?php
$wood = round($village->awood);
$clay = round($village->aclay);
$iron = round($village->airon);
$crop = round($village->acrop);
$founder = $database->getVillage($village->wid);
$newvillage = $database->getMInfo($_GET['id']);
$eigen = $database->getCoor($village->wid);
$from = array('x'=>$eigen['x'], 'y'=>$eigen['y']);
$to = array('x'=>$newvillage['x'], 'y'=>$newvillage['y']);
      		
$troopsTime = $generator->procDistanceTime($from, $to, 300, 0);
$time = $database->getArtifactsValueInfluence($session->uid, $village->wid, 2, $troopsTime);

//-- Prevent user from founding a new village if there are not enough settlers
//-- fix by AL-Kateb - Semplified by iopietro
if($village->unitarray['u'.$session->tribe.'0'] < 3){
	header("location: dorf1.php");
	exit;
}
//--

echo '<pre>';
echo '</pre>';
?>
<h1>Found new village</h1>
				<form method="POST" action="build.php">
				<input type="hidden" name="a" value="new" />
				<input type="hidden" name="c" value="5" />
				<input type="hidden" name="s" value="<?php echo $_GET['id']; ?>" />
				<input type="hidden" name="id" value="39" />
				<input type="hidden" name="timestamp" value="<?php echo $time; ?>" />
		<table class="troop_details" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td class="role"><a href="karte.php?d=<?php echo (isset($founder['0']) ? $founder['0'] : ''); ?>&c=<?php echo $generator->getMapCheck((isset($founder['0']) ? $founder['0'] : '')); ?>"><?php echo $session->username; ?></a></td><td colspan="10"><a href="karte.php?d=<?php echo $newvillage['id']; ?>&c=<?php echo $generator->getMapCheck($newvillage['0']) ?>">Found new village (<?php echo $newvillage['x']; ?>|<?php echo $newvillage['y']; ?>)</a></td>
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
				} 

				if($settlers >= 3){
				  echo "<td>3</td>";
				}else{
				  echo "<td class=\"none\">0</td>";
				}
				?>
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
				<img class="r1" src="img/x.gif" alt="Lumber" title="Wood" />750 | 
				<img class="r2" src="img/x.gif" alt="Clay" title="Clay" />750 | 
				<img class="r3" src="img/x.gif" alt="Iron" title="Iron" />750 | 
				<img class="r4" src="img/x.gif" alt="Crop" title="Crop" />750</td>
		</tr>
	</tbody>
</table>
<p class="btn">
<?php
if ($wood>749 && $clay>749 && $iron>749 && $crop>749) {
?>
<input type="image" value="ok" name="s1" id="btn_ok" class="dynamic_img"  alt="OK" src="img/x.gif" onclick="this.disabled=true;this.form.submit();"/>
<?php
} else {
  echo "<span class=\"c2\"><b>Not enough resource</b></span>";
}
?>
</form>
</p>
</div>


