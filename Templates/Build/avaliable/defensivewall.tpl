<h2><?php echo DEFENSIVEWALL ?></h2>
        <table class="new_building" cellpadding="1" cellspacing="1">
                <tbody><tr>
                        <td class="desc"><?php echo DEFENSIVEWALL_DESC ?></td>
                        <td rowspan="3" class="bimg">
                                <a href="#" onClick="return Popup(47,4);">
                                <img class="building g47" src="img/x.gif" alt="<?php echo DEFENSIVEWALL; ?>" title="<?php echo DEFENSIVEWALL; ?>" /></a>
                        </td>
                </tr>
                <tr>
                <?php
        $_GET['bid'] = 47;
        include("availupgrade.tpl");
        ?>
                </tr></tbody>
        </table>