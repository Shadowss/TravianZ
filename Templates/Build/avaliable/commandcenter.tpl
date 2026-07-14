<h2><?php echo COMMANDCENTER ?></h2>
        <table class="new_building" cellpadding="1" cellspacing="1">
                <tbody><tr>
                        <td class="desc"><?php echo COMMANDCENTER_DESC ?></td>
                        <td rowspan="3" class="bimg">
                                <a href="#" onClick="return Popup(44,4);">
                                <img class="building g44" src="img/x.gif" alt="<?php echo COMMANDCENTER; ?>" title="<?php echo COMMANDCENTER; ?>" /></a>
                        </td>
                </tr>
                <tr>
                <?php
        $_GET['bid'] = 44;
        include("availupgrade.tpl");
        ?>
                </tr></tbody>
        </table>