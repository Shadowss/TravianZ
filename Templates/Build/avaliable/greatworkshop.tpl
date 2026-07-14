<h2><?php echo GREATWORKSHOP ?></h2>
        <table class="new_building" cellpadding="1" cellspacing="1">
                <tbody><tr>
                        <td class="desc"><?php echo GREATWORKSHOP_DESC ?></td>
                        <td rowspan="3" class="bimg">
                                <a href="#" onClick="return Popup(49,4);">
                                <img class="building g49" src="img/x.gif" alt="<?php echo GREATWORKSHOP; ?>" title="<?php echo GREATWORKSHOP; ?>" /></a>
                        </td>
                </tr>
                <tr>
                <?php
        $_GET['bid'] = 49;
        include("availupgrade.tpl");
        ?>
                </tr></tbody>
        </table>