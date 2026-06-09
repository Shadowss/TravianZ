<?php
// 18_create.tpl - EMBESSY / CREATE
global $form, $session;

$isBanned = $session->access == BANNED;
$disabled = $isBanned ? 'disabled' : '';
$tagValue = htmlspecialchars($form->getValue("ally1"));
$nameValue = htmlspecialchars($form->getValue("ally2"));
$maxTag = $isBanned ? 8 : 15;
$maxName = $isBanned ? 25 : 50;
?>
<table cellpadding="1" cellspacing="1" id="found">
    <form method="post" action="build.php">
        <input type="hidden" name="ft" value="ali1">
        <thead><tr><th colspan="2"><?php echo FOUND_ALLIANCE;?></th></tr></thead>
        <tbody>
            <tr>
                <th><?php echo TAG;?></th>
                <td class="tag">
                    <input class="text" name="ally1" value="<?php echo $tagValue;?>" maxlength="<?php echo $maxTag;?>" <?php echo $disabled;?>>
                    <span class="error"><?php echo $form->getError("ally1");?></span>
                </td>
            </tr>
            <tr>
                <th><?php echo NAME;?></th>
                <td class="nam">
                    <input class="text" name="ally2" value="<?php echo $nameValue;?>" maxlength="<?php echo $maxName;?>" <?php echo $disabled;?>>
                    <span class="error"><?php echo $form->getError("ally2");?></span>
                </td>
            </tr>
        </tbody>
    </table>

    <?php if (!$isBanned):?>
        <p><button type="submit" name="s1" id="btn_ok" class="trav_buttons"><?php echo TZ_OK_2; ?></button></p>
    </form>
    <?php else:?>
    </form>
    <p><?php echo NO_CREATE_ALLIANCE;?></p>
    <?php endif;?>