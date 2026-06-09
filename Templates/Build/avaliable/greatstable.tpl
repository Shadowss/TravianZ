<h2><?php echo GREATSTABLE ?></h2>
        <table class="new_building" cellpadding="1" cellspacing="1">
                <tbody><tr>
                        <td class="desc"><?php echo GREATSTABLE_DESC ?></td>
                        <td rowspan="3" class="bimg">
                                <a href="#" onClick="return Popup(30,4);">
                                <img class="building g30" src="img/x.gif" alt="<?php echo GREATSTABLE; ?>" title="<?php echo GREATSTABLE; ?>" /></a>
                        </td>
                </tr>
                <tr>
                <?php
        $_GET['bid'] = 30;
        include("availupgrade.tpl");
        ?>
                </tr></tbody>
        </table>