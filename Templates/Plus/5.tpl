<?php
include("Templates/Plus/pmenu.tpl");



	if(!empty($_GET['gold'])) {
	
    $gold =$_GET['gold'];
	$user = $_GET['user'];
	$q= mysql_query("update ".TB_PREFIX."users set gold=gold+$R_GOLD  where id=$id");
	mysql_query($q);
	
	$q= mysql_query("update ".TB_PREFIX."users set reflink=0  where id=$user");
	mysql_query($q);
    
    }
?>

    <h2>Invite friends and receive free Gold</h2>

    <p>If you get new players to open an account and settle a second village with Travian you will receive gold. You can use this gold to purchase a plus account or plus advantages.
    <br>
    <br>
    To bring in new players, you can invite them by e-mail or have them click on your REF link.</p>

    <h2>How is it done?</h2>

    <h3>1) Invite your friends via Email</h3>
<?php if($session->access != BANNED){ ?>
    <p><a href="plus.php?id=5&amp;a=1&amp;mail">&raquo; Invite by e-mail</a></p>

<?php }else{ ?>
    <p><a href="banned.php">&raquo; Invite by e-mail</a></p>
<?php } ?>
    <h3>2) Copy your personal REF-Link and share it!</h3><span class="notice">Your personal REF Link:</span>
    <br>
    <span class="link"><?php echo HOMEPAGE; ?>anmelden.php?id=ref_<?php echo $session->uid; ?></span>

    <h3>Progress of your invited friends</h3>

    <p>As soon as a player you invited has found his <b>2</b> village, you will be credited with <b>50</b> gold.</p>

    <table id="brought_in" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
                <th colspan="6">Players brought in</th>
            </tr>
<!-- Fix Reference Link -->
<?php                         
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);
$query = mysql_query("SELECT * FROM ".TB_PREFIX."users WHERE reflink = ".$id."");
$row = mysql_num_rows($query);
?>
            <tr>
                <td>UID</td>

                <td>Member since</td>

                <td>Inhabitants</td>

                <td>Villages</td>

		    <td>Gold</td>
            </tr>
<?php
if ($row<>0){
while($reference = mysql_fetch_array($query)){
}
}
?>
        </thead>
		<tbody>
		<?php
		$invite = $database->getInvitedUser($session->uid);
		if(count($invite) > 0){
		foreach($invite as $invited) {
		$varray = $database->getProfileVillages($invited['id']);
		$totalpop = 0;
		foreach($varray as $vil) {
		$totalpop += $vil['pop'];
		}
		?>
            <tr>
                <td><?php echo $invited['id']; ?></td>

                <td><?php echo date("j.m.y",$invited['regtime']); ?></td>

                <td><?php echo $totalpop; ?></td>

                <td><?php echo count($varray); ?></td>
<td> <?php
			 if ($villaggi >= ACTIVATE4){ ?>
			 <a href="?id=<?php echo $id; ?>&gold=true&user=<?php echo $reference['id']; ?>"><img src="../img/admin/gold.gif"></a>
			 <?php
			 }else{ ?>
			 	<img src="../img/admin/gold_g.gif">
			<?php
			 } ?> </td>

            </tr>
		<?php
		}}else{
		?>
        <tr>
            <td class="none" colspan="6">You have not brought in any new players yet.</td>
        </tr>
		<?php } ?>
		</tbody>
        </table>
</div>
