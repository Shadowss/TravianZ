<h2><?php echo HOSPITAL ?></h2>
        <table class="new_building" cellpadding="1" cellspacing="1">
                <tbody><tr>
                        <td class="desc"><?php echo HOSPITAL_DESC ?></td>
                        <td rowspan="3" class="bimg">
                                <a href="#" onClick="return Popup(46,4);">
                                <img class="building g46" src="img/x.gif" alt="<?php echo HOSPITAL; ?>" title="<?php echo HOSPITAL; ?>" /></a>
                        </td>
                </tr>
                <tr>
                <?php
        $_GET['bid'] = 46;
        include("availupgrade.tpl");
        ?>
                </tr></tbody>
        </table>