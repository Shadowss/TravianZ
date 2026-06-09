<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       01.09.2013 						       	 				   ##
##  Filename       villages.tpl                                                ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

if (WW == true) {

    // Single query replacing:
    // - users
    // - vdata
    // - fdata
    // - alliance
    // - ww_attacks (latest attack per village via subquery)

    $sql = "
        SELECT 
            u.id,
            u.username,
            u.alliance,
            v.name AS village_name,
            f.wwname,
            f.f99,
            v.wref,
            a.tag AS alliance_tag,
            a.id AS alliance_id,
            wa.attack_time
        FROM " . TB_PREFIX . "users u
        INNER JOIN " . TB_PREFIX . "vdata v 
            ON u.id = v.owner
        INNER JOIN " . TB_PREFIX . "fdata f 
            ON f.vref = v.wref
        LEFT JOIN " . TB_PREFIX . "alidata a 
            ON a.id = u.alliance
        LEFT JOIN " . TB_PREFIX . "ww_attacks wa 
            ON wa.vid = v.wref 
            AND wa.attack_time = (
                SELECT MAX(attack_time) 
                FROM " . TB_PREFIX . "ww_attacks 
                WHERE vid = v.wref
            )
        WHERE f.f99t = 40
        ORDER BY f.f99 DESC, u.id DESC
        LIMIT 20
    ";

    $result = mysqli_query($database->dblink, $sql);
?>
<table cellpadding="1" cellspacing="1" id="villages" class="row_table_data">
    <thead>
        <tr>
            <th colspan="7"><?php echo WONDER; ?></th>
        </tr>
        <tr>
            <td></td>
            <td><?php echo PLAYER; ?></td>
            <td><?php echo NAME; ?></td>
            <td><?php echo ALLIANCE; ?></td>
            <td><?php echo LEVEL; ?></td>
            <td></td>
        </tr>
    </thead>
    <tbody>

<?php
$count = 0;

if ($result && mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        $count++;

        $check = $generator->getMapCheck($row['wref']);
?>
        <tr>
            <td><?php echo $count; ?>.</td>

            <td>
                <a href="karte.php?d=<?php echo $row['wref']; ?>&amp;c=<?php echo $check; ?>">
                    <?php echo htmlspecialchars($row['username']); ?>
                </a>
            </td>

            <td><?php echo htmlspecialchars($row['wwname']); ?></td>

            <td>
                <?php if (!empty($row['alliance_id'])) { ?>
                    <a href="allianz.php?aid=<?php echo $row['alliance_id']; ?>">
                        <?php echo htmlspecialchars($row['alliance_tag']); ?>
                    </a>
                <?php } else { echo "-"; } ?>
            </td>

            <td><?php echo (int)$row['f99']; ?></td>

            <?php if (!empty($row['attack_time'])) { ?>
                <td>
                    <img src="./<?php echo GP_LOCATE; ?>img/a/att1.gif"
						title="<?php echo date('d.m.Y, H:i:s', $row['attack_time']); ?>" />
                </td>
            <?php } else { ?>
                <td>&nbsp;</td>
            <?php } ?>
        </tr>
<?php
    }
} else {
?>
        <tr>
            <td class="none" colspan="7"><?php echo NO_WW; ?></td>
        </tr>
<?php
}

?>
    </tbody>

<?php
} else {
    header("Location: statistiken.php");
    exit;
}
?>