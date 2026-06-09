<div id="raidListCreate">
    <h4><?php echo TZ_CREATE_A_NEW_LIST; ?></h4>

    <form action="build.php?gid=16&t=99" method="post">

        <div class="boxes boxesColor gray">
            <div class="boxes-tl"></div><div class="boxes-tr"></div>
            <div class="boxes-tc"></div><div class="boxes-ml"></div>
            <div class="boxes-mr"></div><div class="boxes-mc"></div>
            <div class="boxes-bl"></div><div class="boxes-br"></div>
            <div class="boxes-bc"></div>

            <div class="boxes-contents cf">

                <input type="hidden" name="action" value="addList">

                <table cellpadding="1" cellspacing="1" class="transparent" id="raidList">
                    <tbody>

                    <tr>
                        <th><?php echo TZ_NAME; ?></th>
                        <td>
                            <input class="text" id="name" name="name" type="text">
                        </td>
                    </tr>

                    <tr>
                        <th><?php echo TZ_VILLAGE; ?></th>
                        <td>
                            <select id="did" name="did">

                                <?php
                                // OPTIMIZED: build list once (no DB calls in loop)
                                $villagesList = $session->villages ?? [];

                                foreach ($villagesList as $wid) {

                                    $selected = ($wid == $village->wid)
                                        ? 'selected="selected"'
                                        : '';

                                    $villageName = $database->getVillageField((int)$wid, 'name');

                                    echo '<option value="'.$wid.'" '.$selected.'>'
                                        .$villageName.
                                    '</option>';
                                }
                                ?>

                            </select>
                        </td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>

        <button class="trav_buttons" type="submit" value="create"><?php echo TZ_CREATE; ?></button>

    </form>
</div>