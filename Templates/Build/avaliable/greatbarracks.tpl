<h2><?php echo GREATBARRACKS ?></h2>

<table class="new_building" cellpadding="1" cellspacing="1">
        <tbody><tr>
                <td class="desc"><?php echo GREATBARRACKS_DESC ?></td>
                <td rowspan="3" class="bimg">
        <a href="#" onClick="return Popup(29,4);">
                                <img class="building g29" src="img/x.gif" alt="Great Barracks" title="Great Barracks" /></a>
                                        </td>
        </tr>
        <tr>
                <?php
        $_GET['bid'] = 29;
        include("availupgrade.tpl");
        ?>
        </tr>
</table>