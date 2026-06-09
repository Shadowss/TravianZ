<?php
include("Templates/Plus/pmenu.tpl");

$refLink = rtrim(HOMEPAGE,'/') . '/anmelden.php?uid=ref_' . $session->uid;
$invite = $database->getInvitedUser($session->uid);
?>
<h2><?php echo INVITE_FRIENDS_GOLD; ?></h2>
<p><?php echo TZ_IF_YOU_GET_NEW_PLAYERS_TO_OPEN_AN; ?> <b><?php echo TZ_N_50_GOLD; ?></b><?php echo TZ_USE_IT_FOR_PLUS_OR_ANY_ADVANTAGE; ?><br><br>
<?php echo TZ_INVITE_BY_E_MAIL_OR_SHARE_YOUR_REF; ?></p>

<h2><?php echo TZ_HOW_IS_IT_DONE; ?></h2>

<h3><?php echo TZ_N_1_INVITE_YOUR_FRIENDS_VIA_EMAIL; ?></h3>
<form action="plus.php?id=5&a=1" method="POST">
    <p><input class="mail" name="mail" type="email" placeholder="<?php echo TZ_FRIEND_EMAIL_COM; ?>" required style="width:250px"></p>
    <p><?php echo TZ_OWN_TEXT; ?></p>
    <p><textarea name="text" rows="4" cols="40" style="width:350px">Hi,

Join me on <?= SERVER_NAME ?>! Use my link to register:
<?= $refLink ?>

See you in game!</textarea></p>
    <p><input type="submit" value="Send Invite"></p>
</form>

<h3><?php echo TZ_N_2_COPY_YOUR_PERSONAL_REF_LINK_AN; ?></h3>
<span class="notice"><?php echo TZ_YOUR_PERSONAL_REF_LINK; ?></span><br>
<span class="link" onclick="navigator.clipboard.writeText('<?= $refLink ?>'); alert('Copied!')" style="cursor:pointer" title="<?php echo TZ_CLICK_TO_COPY; ?>"><?= $refLink ?></span>

<h3><?php echo TZ_PROGRESS_OF_YOUR_INVITED_FRIENDS; ?></h3>
<p><?php echo TZ_AS_SOON_AS_A_PLAYER_YOU_INVITED_FO; ?> <b>2nd</b> <?php echo TZ_VILLAGE_YOU_GET; ?> <b>50</b> <?php echo TZ_GOLD; ?></p>

<table id="brought_in" cellpadding="1" cellspacing="1">
    <thead>
        <tr><th colspan="4"><?php echo TZ_PLAYERS_BROUGHT_IN; ?></th></tr>
        <tr><td>UID</td><td><?php echo TZ_MEMBER_SINCE; ?></td><td><?php echo INHABITANTS; ?></td><td><?php echo VILLAGES; ?></td></tr>
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
        <tr><td class="none" colspan="4"><?php echo TZ_YOU_HAVE_NOT_BROUGHT_IN_ANY_NEW_PL; ?></td></tr>
    <?php endif; ?>
    </tbody>
</table>
</div>