<h2><?php echo STONEWALL ?></h2>
        <table class="new_building" cellpadding="1" cellspacing="1">
                <tbody><tr>
                        <td class="desc"><?php echo STONEWALL_DESC ?></td>
                        <td rowspan="3" class="bimg">
                                <a href="#" onClick="return Popup(42,4);">
                                <img class="building g42" src="img/x.gif" alt="<?php echo STONEWALL; ?>" title="<?php echo STONEWALL; ?>" /></a>
                        </td>
                </tr>
                <tr>
                <?php
        $_GET['bid'] = 42;
        include("availupgrade.tpl");
        ?>
                </tr></tbody>
        </table>