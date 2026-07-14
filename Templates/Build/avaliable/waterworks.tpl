<h2><?php echo WATERWORKS ?></h2>
        <table class="new_building" cellpadding="1" cellspacing="1">
                <tbody><tr>
                        <td class="desc"><?php echo WATERWORKS_DESC ?></td>
                        <td rowspan="3" class="bimg">
                                <a href="#" onClick="return Popup(45,4);">
                                <img class="building g45" src="img/x.gif" alt="<?php echo WATERWORKS; ?>" title="<?php echo WATERWORKS; ?>" /></a>
                        </td>
                </tr>
                <tr>
                <?php
        $_GET['bid'] = 45;
        include("availupgrade.tpl");
        ?>
                </tr></tbody>
        </table>