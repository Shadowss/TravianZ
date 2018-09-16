<?php 
if (WW == True) 
{ 
    $result = mysqli_query($database->dblink,"select " . TB_PREFIX . "users.id, " . TB_PREFIX . "users.username," . TB_PREFIX . "users.alliance, " . TB_PREFIX . "fdata.wwname, " . TB_PREFIX . "fdata.f99, " . TB_PREFIX . "vdata.name, " . TB_PREFIX . "fdata.vref  
                        FROM " . TB_PREFIX . "users  
                        INNER JOIN " . TB_PREFIX . "vdata ON " . TB_PREFIX . "users.id = " . TB_PREFIX . "vdata.owner 
                        INNER JOIN " . TB_PREFIX . "fdata ON " . TB_PREFIX . "fdata.vref = " . TB_PREFIX . "vdata.wref 
                        WHERE " . TB_PREFIX . "fdata.f99t = 40 ORDER BY " . TB_PREFIX . "fdata.f99 Desc, id Desc LIMIT 20"); 
?> 
<table cellpadding="1" cellspacing="1" id="villages" class="row_table_data"> 
    <thead> 
        <tr> 
            <th colspan="7">Wonder of the world</th> 
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
        while ($row = mysqli_fetch_array($result)) 
        { 
            $ally = $database->getAlliance($row['alliance']); 
            $query = @mysqli_query($database->dblink,'SELECT * FROM `' . TB_PREFIX . 'ww_attacks` WHERE `vid` = ' . $row['vref'] . ' ORDER BY `attack_time` ASC LIMIT 1'); 
            $row2 = @mysqli_fetch_assoc($query); 
        ?> 
        <tr> 
              <td><?php echo ++$count; ?>.</td> 
            <td><?php echo "<a href=\"karte.php?d=" . $row['vref'] . "&amp;c=" . $generator->getMapCheck($row['vref']) . "\">"; ?><?php echo $row['username']; ?></a></td> 
              <td><?php echo $row['wwname']; ?></td> 
            <td><a href="allianz.php?aid=<?php echo $ally['id']; ?>"><?php echo $ally['tag']; ?></a></td> 
            <td><?php echo $row['f99']; ?></td> 
            <?php if ($row2['attack_time'] != 0): ?> 
            <td><img src="gpack/travian_default/img/a/att1.gif" title="<?php print date('d.m.Y, H:i:s', $row2['attack_time']); ?>" /></td> 
            <?php else: ?> 
            <td>&nbsp;</td> 
            <?php endif; ?> 
           </tr> 
        <?php 
        } 
        
            if($count == 0){        
        ?>
        <tr>
        <td class="none" colspan="7"><?php echo NO_WW; ?></td>
        </tr>    
		<?php
            }
        }
        else
        {
            header("Location: statistiken.php");
            exit;
        } 
        ?>