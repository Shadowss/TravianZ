<?php
include("Templates/Plus/pmenu.tpl");

$refLink = rtrim(HOMEPAGE, '/') . '/anmelden.php?uid=ref_' . $session->uid;
$invited = $database->getInvitedUser($session->uid);
?>
<h2>Invite friends and receive free Gold</h2>
<p>If you get new players to open an account and settle a second village, you will receive <b>50 gold</b>. You can use this gold for Plus or any gold advantage.<br><br>
To bring in new players, invite them by e-mail or share your REF link.</p>

<h2>How is it done?</h2>
<h3>1) Invite your friends via Email</h3>
<p><a href="plus.php?id=5&a=1&mail">&raquo; Invite by e-mail</a></p>

<h3>2) Copy your personal REF-Link and share it!</h3>
<span class="notice">Your personal REF Link:</span><br>
<span class="link" onclick="navigator.clipboard.writeText('<?= $refLink ?>'); this.style.color='#0a0';" title="Click to copy"><?= $refLink ?></span>

<h3>Progress of your invited friends</h3>
<p>As soon as a player you invited founds his <b>2nd</b> village, you will be credited with <b>50</b> gold.</p>

<table id="brought_in" cellpadding="1" cellspacing="1">
    <thead>
        <tr><th colspan="4">Players brought in</th></tr>
        <tr><td>UID</td><td>Member since</td><td>Inhabitants</td><td>Villages</td></tr>
    </thead>
    <tbody>
    <?php if(!empty($invited)): ?>
        <?php foreach($invited as $inv): 
            $villages = $database->getProfileVillages($inv['id']);
            $totalPop = array_sum(array_column($villages, 'pop'));
            $vilCount = count($villages);
        ?>
        <tr>
            <td><?= $inv['id'] ?></td>
            <td><?= date('j.m.y', $inv['regtime']) ?></td>
            <td><?= $totalPop ?></td>
            <td><?= $vilCount ?> <?= $vilCount >= 2 ? '<span style="color:#0a0">✓</span>' : '' ?></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td class="none" colspan="4">You have not brought in any new players yet.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
</div>