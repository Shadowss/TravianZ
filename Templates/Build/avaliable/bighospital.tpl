<h2><?php echo BIGHOSPITAL ?></h2>
        <table class="new_building" cellpadding="1" cellspacing="1">
                <tbody><tr>
                        <td class="desc"><?php echo BIGHOSPITAL_DESC ?></td>
                        <td rowspan="3" class="bimg">
                                <a href="#" onClick="return Popup(48,4);">
                                <img class="building g48" src="img/x.gif" alt="<?php echo BIGHOSPITAL; ?>" title="<?php echo BIGHOSPITAL; ?>" /></a>
                        </td>
                </tr>
                <tr>
                <?php
        $_GET['bid'] = 48;
        include("availupgrade.tpl");
        ?>
                </tr></tbody>
        </table>