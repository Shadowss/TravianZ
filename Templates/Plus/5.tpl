<?php
include("Templates/Plus/pmenu.tpl");

$refLink = rtrim(HOMEPAGE, '/') . '/anmelden.php?uid=ref_' . $session->uid;
$invited = $database->getInvitedUser($session->uid);
?>
<h2><?php echo INVITE_FRIENDS_GOLD; ?></h2>
<p><?php echo TZ_IF_YOU_GET_NEW_PLAYERS_TO_OPEN_AN; ?> <b><?php echo TZ_N_50_GOLD; ?></b><?php echo TZ_YOU_CAN_USE_THIS_GOLD_FOR_PLUS_OR; ?><br><br>
<?php echo TZ_TO_BRING_IN_NEW_PLAYERS_INVITE_THE; ?></p>

<h2><?php echo TZ_HOW_IS_IT_DONE; ?></h2>
<h3><?php echo TZ_N_1_INVITE_YOUR_FRIENDS_VIA_EMAIL; ?></h3>
<p><a href="plus.php?id=5&a=1&mail">&raquo; Invite by e-mail</a></p>

<h3><?php echo TZ_N_2_COPY_YOUR_PERSONAL_REF_LINK_AN; ?></h3>
<span class="notice"><?php echo TZ_YOUR_PERSONAL_REF_LINK; ?></span><br>
<span class="link" onclick="navigator.clipboard.writeText('<?= $refLink ?>'); this.style.color='#0a0';" title="<?php echo TZ_CLICK_TO_COPY; ?>"><?= $refLink ?></span>

<h3><?php echo TZ_PROGRESS_OF_YOUR_INVITED_FRIENDS; ?></h3>
<p><?php echo TZ_AS_SOON_AS_A_PLAYER_YOU_INVITED_FO; ?> <b>2nd</b> <?php echo TZ_VILLAGE_YOU_WILL_BE_CREDITED_WITH; ?> <b>50</b> <?php echo TZ_GOLD; ?></p>

<table id="brought_in" cellpadding="1" cellspacing="1">
    <thead>
        <tr><th colspan="4"><?php echo TZ_PLAYERS_BROUGHT_IN; ?></th></tr>
        <tr><td>UID</td><td><?php echo TZ_MEMBER_SINCE; ?></td><td><?php echo INHABITANTS; ?></td><td><?php echo VILLAGES; ?></td></tr>
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
        <tr><td class="none" colspan="4"><?php echo TZ_YOU_HAVE_NOT_BROUGHT_IN_ANY_NEW_PL; ?></td></tr>
    <?php endif; ?>
    </tbody>
</table>
</div>