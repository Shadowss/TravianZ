<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       01.09.2013 						       	 				   ##
##  Filename       player_top10.tpl                                            ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          http://travianz.org		  				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

	$place = $place1 = $place2 = $place3 = "?";

    for($i=1;$i<=0;$i++) {
    echo "Row ".$i;
    }

    // --- ADDED: Week and Medal Reset calculation (identical to Automation.php) ---
    $week = 1;
    $nextReset = time() + MEDALINTERVAL;
    $q = mysqli_query($database->dblink, "SELECT lastgavemedal FROM ".TB_PREFIX."config LIMIT 1");
    if($q && $rc = mysqli_fetch_assoc($q)){
        $last = (int)$rc['lastgavemedal'];
        if($last > 0){
            $nextReset = $last;
            while($nextReset <= time()){ $nextReset += MEDALINTERVAL; }
        } else {
            $setDays = round(MEDALINTERVAL/86400);
            $nextReset = $setDays < 7 ? strtotime(($setDays + 1).' day midnight') : strtotime('next monday');
        }
    }
    $wq = mysqli_query($database->dblink, "SELECT week FROM ".TB_PREFIX."medal ORDER BY week DESC LIMIT 1");
    if($wq && mysqli_num_rows($wq)){ $week = mysqli_fetch_assoc($wq)['week'] + 1; }
    $left = max(0, $nextReset - time());
    $days = floor($left / 86400);
    $timeLeft = gmdate("H:i:s", $left % 86400);
    // --- END MEDAL TIMER ---

    $result = mysqli_query($database->dblink,"SELECT * FROM ".TB_PREFIX."users WHERE access<".(INCLUDE_ADMIN?"10":"8")." AND id > 5 AND tribe<=3 AND tribe > 0 ORDER BY ap DESC, id DESC Limit 10");
    $result2 = mysqli_query($database->dblink,"SELECT * FROM ".TB_PREFIX."users WHERE id = '".$session->uid."' ORDER BY ap DESC, id DESC Limit 1");
	?>
	<table cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<th><?php echo TZ_TOP_10_PLAYERS; ?><div id="submenu"><a title="<?php echo TZ_TOP_10; ?>" href="statistiken.php?id=7"><img class="active btn_top10" src="img/x.gif" alt="<?php echo TZ_TOP_10; ?>"></a><a title="<?php echo DEFENDER; ?>" href="statistiken.php?id=32"><img class="btn_def" src="img/x.gif" alt="<?php echo DEFENDER; ?>"></a><a title="<?php echo ATTACKER; ?>" href="statistiken.php?id=31"><img class="btn_off" src="img/x.gif" alt="<?php echo ATTACKER; ?>"></a></div><div id="submenu2"></div></th>
		</tr>
	</thead>
</table>

<!-- ADDED: row with Week / Medal reset -->
<?php if (defined('NEW_FUNCTIONS_MEDAL_RESET') && NEW_FUNCTIONS_MEDAL_RESET): ?>
<table cellpadding="1" cellspacing="1" style="width:100%; margin:2px 0;">
    <tr>
        <td style="text-align:center; padding:3px;">
            <b>Week: <?php echo $week; ?></b> &nbsp;&nbsp; <b>Medal reset in:</b> <span id="medalTimer"><?php echo $days; ?>d <?php echo $timeLeft; ?></span>
        </td>
    </tr>
</table>
<?php endif; ?>
<script>
var medalSeconds = <?php echo $left; ?>;
setInterval(function(){
    if(medalSeconds <= 0) return;
    medalSeconds--;
    var d = Math.floor(medalSeconds/86400);
    var h = String(Math.floor((medalSeconds%86400)/3600)).padStart(2,'0');
    var m = String(Math.floor((medalSeconds%3600)/60)).padStart(2,'0');
    var s = String(medalSeconds%60).padStart(2,'0');
    document.getElementById('medalTimer').innerHTML = d+'d '+h+':'+m+':'+s;
},1000);
</script>

<table cellpadding="1" cellspacing="1" id="top10_offs" class="top10 row_table_data">
	<thead>
		<tr>
			<th onclick="return Popup(3,5)"><img src="img/x.gif" class="help" alt="<?php echo INSTRUCT; ?>" title="<?php echo INSTRUCT; ?>">
			</th>
			<th colspan="2"><?php echo ATT_W_M; ?></th>
		</tr>
		<tr>
			<td><?php echo TZ_NO; ?></td>
			<td><?php echo PLAYER; ?></td>
			<td><?php echo POINTS; ?></td>
		</tr>
	</thead>
	<tbody>
<?php
    while($row = mysqli_fetch_array($result))
      {
	  if($row['id']==$session->uid) {
	  if($row['id']==$session->uid) {
	  $place = $i;
	  }
	  echo "<tr class=\"own hl\">"; } else { echo "<tr>"; }
      echo "<td class=\"ra fc\">".$i++.".&nbsp;</td>";
      echo "<td class=\"pla\"><a href='spieler.php?uid=".$row['id']."'>".$row['username']."</a></td>";
      echo "<td class=\"val lc\">".$row['ap']."</td>";
      echo "</tr>";
      }
?>
		 <tr>
			<td colspan="3" class="empty"></td>
		</tr>
<?php
    while($row = mysqli_fetch_array($result2))
      {
		if($row['id'] == $session->uid) {
		echo "<tr class=\"none\">"; } else { echo "<tr class=\"own hl\">"; }
      echo "<td class=\"ra fc\">".$place."&nbsp;</td>";
	  	if($row['id'] == $session->uid) {
		echo "<td class=\"pla\">".$row['username']."</td>"; } else { echo "<td class=\"pla\"><a href='spieler.php?uid=".$row['id']."'>".$row['username']."</a></td>"; }
      echo "<td class=\"val lc\">".$row['ap']."</td>";
      echo "</tr>";
      }
?>
         </tbody>
</table>

<?php
    for($i=1;$i<=0;$i++) {
    echo "Row ".$i;
    }
    $result = mysqli_query($database->dblink,"SELECT * FROM ".TB_PREFIX."users WHERE access<".(INCLUDE_ADMIN?"10":"8")." AND id > 5 AND tribe<=3 AND tribe > 0 ORDER BY dp DESC, id DESC Limit 10");
    $result2 = mysqli_query($database->dblink,"SELECT * FROM ".TB_PREFIX."users WHERE id = '".$session->uid."' ORDER BY dp DESC Limit 1");
?>
<table cellpadding="1" cellspacing="1" id="top10_defs" class="top10 row_table_data">
	<thead>
		<tr>
			<th onclick="return Popup(3,5)"><img src="img/x.gif" class="help" alt="<?php echo INSTRUCT; ?>" title="<?php echo INSTRUCT; ?>">
			</th>
			<th colspan="2"><?php echo DEF_W_M; ?></th>
		</tr>
		<tr>
			<td><?php echo TZ_NO; ?></td>
			<td><?php echo PLAYER; ?></td>
			<td><?php echo POINTS; ?></td>
		</tr>
	</thead>
	<tbody>
<?php
    while($row = mysqli_fetch_array($result))
      {
	  if($row['id']==$session->uid) {
	  $place1 = $i;
	  }
	  if($row['id']==$session->uid) {
	  echo "<tr class=\"own hl\">"; } else { echo "<tr>"; }
      echo "<td class=\"ra fc\">".$i++.".&nbsp;</td>";
	  echo "<td class=\"pla\"><a href='spieler.php?uid=".$row['id']."'>".$row['username']."</a></td>";
      echo "<td class=\"val lc\">".$row['dp']."</td>";
      echo "</tr>";
      }
?>
	
		 <tr>
			<td colspan="3" class="empty"></td>
		</tr>
<?php
    while($row = mysqli_fetch_array($result2))
      {
     if($row['id'] == $session->uid) {
		echo "<tr class=\"none\">"; } else { echo "<tr class=\"own hl\">"; }
      echo "<td class=\"ra fc\">".$place1."&nbsp;</td>";
     if($row['id'] == $session->uid) {
		echo "<td class=\"pla\">".$row['username']."</td>"; } else { echo "<td class=\"pla\"><a href='spieler.php?uid=".$row['id']."'>".$row['username']."</a></td>"; }
      echo "<td class=\"val lc\">".$row['dp']."</td>";
      echo "</tr>";
      }
?>
         </tbody>
</table>
	
<?php
    for($i=1;$i<=0;$i++) {
    echo "Row ".$i;
    }
    $result = mysqli_query($database->dblink,"SELECT * FROM ".TB_PREFIX."users WHERE access<".(INCLUDE_ADMIN?"10":"8")." AND id > 5 AND tribe<=3 AND tribe > 0 ORDER BY clp DESC, id DESC Limit 10");
    $result2 = mysqli_query($database->dblink,"SELECT * FROM ".TB_PREFIX."users WHERE id = '".$session->uid."' ORDER BY clp DESC Limit 1");
?>
<div class="clear"></div>
<table cellpadding="1" cellspacing="1" id="top10_climbers" class="top10 row_table_data">
	<thead>
		<tr>
			<th onclick="return Popup(3,5)"><img src="img/x.gif" class="help" alt="<?php echo INSTRUCT; ?>" title="<?php echo INSTRUCT; ?>">
			</th>
			<th colspan="2"><?php echo TZ_CLIMBERS_OF_THE_WEEK; ?></th>
		</tr>
		<tr>
			<td><?php echo TZ_NO; ?></td>
			<td><?php echo PLAYER; ?></td>
			<td><?php echo RANKS; ?></td>
		</tr>
	</thead>
	<tbody>
<?php
    while($row = mysqli_fetch_array($result))
      {
	  if($row['id']==$session->uid) {
	  $place2 = $i;
	  }
	  if($row['id']==$session->uid) {
	  echo "<tr class=\"own hl\">"; } else { echo "<tr>"; }
      echo "<td class=\"ra fc\">".$i++.".&nbsp;</td>";
      echo "<td class=\"pla\"><a href='spieler.php?uid=".$row['id']."'>".$row['username']."</a></td>";
      echo "<td class=\"val lc\">".$row['clp']."</td>";
      echo "</tr>";
      }
?>
		 <tr>
			<td colspan="3" class="empty"></td>
		</tr>
<?php
    while($row = mysqli_fetch_array($result2))
      {
		if($row['id'] == $session->uid) {
		echo "<tr class=\"none\">"; } else { echo "<tr class=\"own hl\">"; }
      echo "<td class=\"ra fc\">".$place2."&nbsp;</td>";
		if($row['id'] == $session->uid) {
		echo "<td class=\"pla\">".$row['username']."</td>"; } else { echo "<td class=\"pla\"><a href='spieler.php?uid=".$row['id']."'>".$row['username']."</a></td>"; }      echo "<td class=\"val lc\">".$row['clp']."</td>";
      echo "</tr>";
      }
?>
         </tbody>
</table>
<?php
    for($i=1;$i<=0;$i++) {
    echo "Row ".$i;
    }
    $result = mysqli_query($database->dblink,"SELECT * FROM ".TB_PREFIX."users WHERE access<".(INCLUDE_ADMIN?"10":"8")." AND id > 5 AND tribe<=3 AND tribe > 0 ORDER BY RR DESC, id DESC Limit 10");
    $result2 = mysqli_query($database->dblink,"SELECT * FROM ".TB_PREFIX."users WHERE id = '".$session->uid."' ORDER BY RR DESC Limit 1");
?>
<table cellpadding="1" cellspacing="1" id="top10_raiders" class="top10 row_table_data">
	<thead>
		<tr>
			<th onclick="return Popup(3,5)"><img src="img/x.gif" class="help" alt="<?php echo INSTRUCT; ?>" title="<?php echo INSTRUCT; ?>">
			</th>
			<th colspan="2"><?php echo ROB_W_M; ?></th>
		</tr>
		<tr>
			<td><?php echo TZ_NO; ?></td>
			<td><?php echo PLAYER; ?></td>
			<td><?php echo RESOURCES; ?></td>
		</tr>
	</thead>
	<tbody>
<?php
    while($row = mysqli_fetch_array($result))
      {
	  if($row['RR'] >= 0) {
	  if($row['id']==$session->uid) {
	  $place3 = $i;
	  }
	  if($row['id']==$session->uid) {
	  echo "<tr class=\"own hl\">"; } else { echo "<tr>"; }
      echo "<td class=\"ra fc\">".$i++.".&nbsp;</td>";
      echo "<td class=\"pla\"><a href='spieler.php?uid=".$row['id']."'>".$row['username']."</a></td>";
      echo "<td class=\"val lc\">".$row['RR']."</td>";
      echo "</tr>";
	  }
      }
?>
		 <tr>
			<td colspan="3" class="empty"></td>
		</tr>
<?php
    while($row = mysqli_fetch_array($result2))
      {
      if($row['id']==$session->uid) {
		echo "<tr class=\"none\">"; } else { echo "<tr class=\"own hl\">"; }
      echo "<td class=\"ra fc\">".$place3."&nbsp;</td>";
      if($row['id']==$session->uid) {
		echo "<td class=\"pla\">".$row['username']."</td>"; } else { echo "<td class=\"pla\"><a href='spieler.php?uid=".$row['id']."'>".$row['username']."</a></td>"; }
      echo "<td class=\"val lc\">".$row['RR']."</td>";
      echo "</tr>";
      }
?>
         </tbody>
</table>
<div>