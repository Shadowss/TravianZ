    <?php
	$place = $place1 = $place2 = $place3 = "?";
    //$db_host=SQL_SERVER; $db_user=SQL_USER; $db_pass=SQL_PASS; $db_name=SQL_DB;

    //$con = mysql_connect($db_host, $db_user, $db_pass);
    //if (!$con)
    //  {
    //  die('Could not connect: ' . mysql_error());
    //  }

    for($i=1;$i<=0;$i++) {
    echo "Row ".$i;
    }
             
    //mysql_select_db($db_name, $con);

    $result = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE access<".(INCLUDE_ADMIN?"10":"8")." AND id > 5 AND tribe<=3 AND tribe > 0 ORDER BY ap DESC, id DESC Limit 10");
    $result2 = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id = '".$session->uid."' ORDER BY ap DESC, id DESC Limit 1");
	?>
	<table cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<th>Top 10 players<div id="submenu"><a title="Top 10" href="statistiken.php?id=7"><img class="active btn_top10" src="img/x.gif" alt="Top 10"></a><a title="defender" href="statistiken.php?id=32"><img class="btn_def" src="img/x.gif" alt="defender"></a><a title="attacker" href="statistiken.php?id=31"><img class="btn_off" src="img/x.gif" alt="attacker"></a></div><div id="submenu2"><a title="Romans" href="statistiken.php?id=11"><img class="btn_v1" src="img/x.gif" alt="attacker"></a><a title="Teutons" href="statistiken.php?id=12"><img class="btn_v2" src="img/x.gif" alt="attacker"></a><a title="Gauls" href="statistiken.php?id=13"><img class="btn_v3" src="img/x.gif" alt="attacker"></a></div></th>
		</tr>
	</thead>
</table>
<table cellpadding="1" cellspacing="1" id="top10_offs" class="top10 row_table_data">
	<thead>
		<tr>
			<th onclick="return Popup(3,5)"><img src="img/x.gif" class="help" alt="Instructions" title="Instructions">
			</th>
			<th colspan="2">Attackers of the week</th>
		</tr>
		<tr>
			<td>No.</td>
			<td>Player</td>
			<td>Points</td>
		</tr>
	</thead>
	<tbody>
<?php
    while($row = mysql_fetch_array($result))
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
    while($row = mysql_fetch_array($result2))
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
    $result = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE access<".(INCLUDE_ADMIN?"10":"8")." AND id > 5 AND tribe<=3 AND tribe > 0 ORDER BY dp DESC, id DESC Limit 10");
    $result2 = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id = '".$session->uid."' ORDER BY dp DESC Limit 1");
?>
<table cellpadding="1" cellspacing="1" id="top10_defs" class="top10 row_table_data">
	<thead>
		<tr>
			<th onclick="return Popup(3,5)"><img src="img/x.gif" class="help" alt="Instructions" title="Instructions">
			</th>
			<th colspan="2">Defenders of the week</th>
		</tr>
		<tr>
			<td>No.</td>
			<td>Player</td>
			<td>Points</td>
		</tr>
	</thead>
	<tbody>
<?php
    while($row = mysql_fetch_array($result))
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
    while($row = mysql_fetch_array($result2))
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
    $result = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE access<".(INCLUDE_ADMIN?"10":"8")." AND id > 5 AND tribe<=3 AND tribe > 0 ORDER BY clp DESC, id DESC Limit 10");
    $result2 = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id = '".$session->uid."' ORDER BY clp DESC Limit 1");
?>
<div class="clear"></div>
<table cellpadding="1" cellspacing="1" id="top10_climbers" class="top10 row_table_data">
	<thead>
		<tr>
			<th onclick="return Popup(3,5)"><img src="img/x.gif" class="help" alt="Instructions" title="Instructions">
			</th>
			<th colspan="2">Climbers of the week</th>
		</tr>
		<tr>
			<td>No.</td>
			<td>Player</td>
			<td>Ranks</td>
		</tr>
	</thead>
	<tbody>
<?php
    while($row = mysql_fetch_array($result))
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
    while($row = mysql_fetch_array($result2))
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
    $result = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE access<".(INCLUDE_ADMIN?"10":"8")." AND id > 5 AND tribe<=3 AND tribe > 0 ORDER BY RR DESC, id DESC Limit 10");
    $result2 = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE id = '".$session->uid."' ORDER BY RR DESC Limit 1");
?>
<table cellpadding="1" cellspacing="1" id="top10_raiders" class="top10 row_table_data">
	<thead>
		<tr>
			<th onclick="return Popup(3,5)"><img src="img/x.gif" class="help" alt="Instructions" title="Instructions">
			</th>
			<th colspan="2">Robbers of the week</th>
		</tr>
		<tr>
			<td>No.</td>
			<td>Player</td>
			<td>Resources</td>
		</tr>
	</thead>
	<tbody>
<?php
    while($row = mysql_fetch_array($result))
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
    while($row = mysql_fetch_array($result2))
      {
      if($row['id']==$session->uid) {
		echo "<tr class=\"none\">"; } else { echo "<tr class=\"own hl\">"; }
      echo "<td class=\"ra fc\">".$place3."&nbsp;</td>";
      if($row['id']==$session->uid) {
		echo "<td class=\"pla\">".$row['username']."</td>"; } else { echo "<td class=\"pla\"><a href='spieler.php?uid=".$row['id']."'>".$row['username']."</a></td>"; }
      echo "<td class=\"val lc\">".$row['RR']."</td>";
      echo "</tr>";
      }
	  
//	mysql_close($con);
?>
         </tbody>
</table>
<div>
