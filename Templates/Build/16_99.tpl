<?php
if(!$session->goldclub) include("Templates/Build/16.tpl");
else
{
?>
<div id="build" class="gid16"><a href="#" onClick="return Popup(16,4);" class="build_logo">
	<img class="g16" src="img/x.gif" alt="Rally point" title="<?php echo RALLYPOINT;?>" />
</a>
<h1><?php echo RALLYPOINT;?> <span class="level"><?php echo LEVEL;?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo RALLYPOINT_DESC;?></p>
<?php include("16_menu.tpl")?>

<div id="raidList">
	<?php  include("Templates/goldClub/farmlist.tpl"); ?>
</div>
<br />
<?php if($hideevasion == 0){ ?>
<table id="raidList" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
                <th colspan="4"><?php echo EVASION_SETTINGS;?></th>
            </tr>
            <tr>
                <td></td>
                <td><?php echo VILLAGE; ?></td>
                <td><?php echo OWN_TROOPS; ?></td>
                <td><?php echo REINFORCEMENT;?></td>
            </tr>
        </thead>
		<tbody>
		<?php
		for($i = 0; $i <= count($session->villages) - 1; $i++) {
		    $wref = $session->villages[$i];
		    $vname = $database->getVillageField($wref, "name");
		    $vchecked = $database->getVillageField($wref, "evasion");
		    $reinf = $database->getEnforceVillage($wref, 0);
		    
		    if($vchecked == 1) $checked = 'checked';
		    else $checked = '';
		?>
            <tr>
                <td><input type="checkbox" class="check" name="hideShow" onclick="window.location.href = '?gid=16&t=99&evasion=<?php echo $wref;?>';" <?php echo $checked; ?>></td>
                <td><?php echo $vname; ?></td>
                <td><div style="text-align: center"><?php echo $database->getUnitsNumber($wref); ?></div></td>
                <td><div style="text-align: center"><?php echo count($reinf); ?></div></td>
            </tr>
		<?php
		}
		$user = $database->getUserArray($session->uid, 1);
		?>
		</tbody>
</table>
<form action="build.php?id=39&t=99" method="POST">
<br />
	<?php echo SEND_TROOPS_AWAY_MAX;?> <input class="text" type="text" name="maxevasion" value="<?php echo $user['maxevasion']; ?>" maxlength="3" style="width:50px;"> <?php echo TIMES;?>
	<span class="none">(<?php echo COSTS;?>: <img src="<?php echo GP_LOCATE; ?>img/a/gold_g.gif" alt="Gold" title="<?php echo GOLD;?>"/><b>2</b> <?php echo PER_EVASION;?>)</span>
<div class="clear"></div><p><button value="ok" name="s1" id="btn_ok" class="trav_buttons" tabindex="8">OK</button></p></form>
<?php } ?>
	</div>
<?php } ?>