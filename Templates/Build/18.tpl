<?php
// 18.tpl - EMBESSY
global $village, $session, $id, $alliance, $database, $form;

$level = (int)$village->resarray['f'.$id];
$inAlliance = (int)$session->alliance !== 0;
?>
<div id="build" class="gid18">
    <a href="#" onClick="return Popup(18,4);" class="build_logo">
        <img class="building g18" src="img/x.gif" alt="<?php echo EMBASSY; ?>" title="<?php echo EMBASSY;?>" />
    </a>
    <h1><?php echo EMBASSY;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc"><?php echo EMBASSY_DESC;?></p>

    <?php if ($level >= 3 && !$inAlliance) include("18_create.tpl");?>

    <?php if ($inAlliance):?>
        <table cellpadding="1" cellspacing="1" id="ally_info">
            <thead><tr><th colspan="2"><?php echo ALLIANCE;?></th></tr></thead>
            <tbody>
                <tr>
                    <th><?php echo TAG;?></th>
                    <td><?php echo htmlspecialchars($alliance->allianceArray['tag']);?></td>
                </tr>
                <tr>
                    <th><?php echo NAME;?></th>
                    <td>
                        <?php echo htmlspecialchars($alliance->allianceArray['name']);?>
                        <span class="error"><?php echo $form->getError("ally3");?></span>
                    </td>
                </tr>
                <tr><td class="empty" colspan="2"></td></tr>
                <tr><td colspan="2"><a href="allianz.php">&nbsp;&raquo; <?php echo TO_THE_ALLIANCE;?></a></td></tr>
            </tbody>
        </table>

    <?php elseif ($level >= 1):?>
        <table cellpadding="1" cellspacing="1" id="join">
            <thead><tr><th colspan="3"><?php echo JOIN_ALLIANCE;?></th></tr></thead>
            <tbody>
                <?php if ($alliance->gotInvite && !empty($alliance->inviteArray)):
                    foreach ($alliance->inviteArray as $invite):
                        $invId = (int)$invite['id'];
                        $allyId = (int)$invite['alliance'];
                        $allyName = htmlspecialchars($database->getAllianceName($allyId));
                ?>
                    <tr>
                        <td class="abo"><a href="build.php?id=<?php echo (int)$id;?>&a=2&d=<?php echo $invId;?>"><img class="del" src="img/x.gif" alt="<?php echo REFUSE; ?>" title="<?php echo REFUSE;?>" /></a></td>
                        <td class="nam"><a href="allianz.php?aid=<?php echo $allyId;?>">&nbsp;<?php echo $allyName;?></a></td>
                        <td class="acc"><a href="build.php?id=<?php echo (int)$id;?>&a=3&d=<?php echo $invId;?>">&nbsp;<?php echo ACCEPT;?></a></td>
                    </tr>
                <?php endforeach; else:?>
                    <tr><td colspan="3" class="none"><?php echo NO_INVITATIONS;?></td></tr>
                <?php endif;?>
            </tbody>
        </table>
        <p class="error"><?php echo $form->getError("ally4");?></p>
        <?php if ($alliance->gotInvite):?>
            <p class="error2" style="color: #DD0000"><?php echo $form->getError("ally_accept");?></p>
        <?php endif;?>
    <?php endif;?>

    <?php include("upgrade.tpl");?>
</div>