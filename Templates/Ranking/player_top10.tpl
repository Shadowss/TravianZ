<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       01.09.2013 						       	 				   ##
##  Filename       player_top10.tpl                                            ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

	$place = $place1 = $place2 = $place3 = "?";


    for($i=1;$i<=0;$i++) {
    echo "Row ".$i;
    }

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
	  
//	mysqli_close($con);
?>
         </tbody>
</table>
<div>
