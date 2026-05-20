<?php
include("Templates/Plus/pmenu.tpl");

$refLink = rtrim(HOMEPAGE,'/') . '/anmelden.php?uid=ref_' . $session->uid;
$invite = $database->getInvitedUser($session->uid);
?>
<h2>Invite friends and receive free Gold</h2>
<p>If you get new players to open an account and settle a second village, you will receive <b>50 gold</b>. Use it for Plus or any advantage.<br><br>
Invite by e-mail or share your REF link.</p>

<h2>How is it done?</h2>

<h3>1) Invite your friends via Email</h3>
<form action="plus.php?id=5&a=1" method="POST">
    <p><input class="mail" name="mail" type="email" placeholder="friend@email.com" required style="width:250px"></p>
    <p>Own text:</p>
    <p><textarea name="text" rows="4" cols="40" style="width:350px">Hi,

Join me on <?= SERVER_NAME ?>! Use my link to register:
<?= $refLink ?>

See you in game!</textarea></p>
    <p><input type="submit" value="Send Invite"></p>
</form>

<h3>2) Copy your personal REF-Link and share it!</h3>
<span class="notice">Your personal REF Link:</span><br>
<span class="link" onclick="navigator.clipboard.writeText('<?= $refLink ?>'); alert('Copied!')" style="cursor:pointer" title="Click to copy"><?= $refLink ?></span>

<h3>Progress of your invited friends</h3>
<p>As soon as a player you invited founds his <b>2nd</b> village, you get <b>50</b> gold.</p>

<table id="brought_in" cellpadding="1" cellspacing="1">
    <thead>
        <tr><th colspan="4">Players brought in</th></tr>
        <tr><td>UID</td><td>Member since</td><td>Inhabitants</td><td>Villages</td></tr>
    </thead>
    <tbody>
    <?php if(!empty($invite)): ?>
        <?php foreach($invite as $inv): 
            $villages = $database->getProfileVillages($inv['id']);
            $totalPop = array_sum(array_column($villages, 'pop'));
            $vilCount = count($villages);
            $rewarded = $vilCount >= 2 ? 'style="background:#dfd"' : '';
        ?>
        <tr <?= $rewarded ?>>
            <td><?= $inv['id'] ?></td>
            <td><?= date('j.m.y', $inv['regtime']) ?></td>
            <td><?= $totalPop ?></td>
            <td><?= $vilCount ?><?= $vilCount >= 2 ? ' ✓' : '' ?></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td class="none" colspan="4">You have not brought in any new players yet.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
</div>