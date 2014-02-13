<?php
include("Templates/Plus/pmenu.tpl");
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
    <span class="link"><?php echo HOMEPAGE.(substr(HOMEPAGE, -1)=="/" ? "":"/");?>anmelden.php?uid=ref_<?php echo $session->uid; ?></span>

    <h3>Progress of your invited friends</h3>

    <p>As soon as a player you invited has found his <b>2</b> village, you will be credited with <b>50</b> gold.</p>

    <table id="brought_in" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
                <th colspan="6">Players brought in</th>
            </tr>
            <tr>
                <td>UID</td>

                <td>Member since</td>

                <td>Inhabitants</td>

                <td>Villages</td>
            </tr>
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
