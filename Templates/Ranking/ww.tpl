  <?php
 
    $result = mysql_query("select ".TB_PREFIX."users.id, ".TB_PREFIX."users.username,".TB_PREFIX."users.alliance, ".TB_PREFIX."fdata.wwname, ".TB_PREFIX."fdata.f99, ".TB_PREFIX."vdata.name
                        FROM ".TB_PREFIX."users 
                        INNER JOIN ".TB_PREFIX."vdata ON ".TB_PREFIX."users.id = ".TB_PREFIX."vdata.owner
                        INNER JOIN ".TB_PREFIX."fdata ON ".TB_PREFIX."fdata.vref = ".TB_PREFIX."vdata.wref
                        WHERE ".TB_PREFIX."fdata.f99t = 40 ORDER BY ".TB_PREFIX."fdata.f99 Desc ");
?>
<table cellpadding="1" cellspacing="1" id="villages" class="row_table_data">
            <thead>
                <tr>
                    <th colspan="6">
                        Wonder of the world                                    
                    </th>
                </tr>
        <tr>
                <td></td>
                <td>Player</td>
                <td>Name</td>
                <td>Alliance</td>
                <td>Level</td>
                
        </tr>
        
        </thead><tbody> 
        <?php
        $cont = 1;
    while($row = mysql_fetch_array($result))
    
      { 
      $ally = $database->getAlliance($row[alliance]);
      ?>
        <tr>
                <td><?php echo $cont; $cont++;?>.</td>
                <td><a href="spieler.php?uid=<?php echo $row['id'];?>"><?php echo $row['username'];?></a></td>
                <td><?php echo $row['wwname'];?></td>
                <td><a href="allianz.php?aid=<?php echo $ally['id'];?>"><?php echo $ally['tag'];?></a></td>
                <td><?php echo $row['f99'];?></td>
                

        </tr>
        <?php }
        ?>