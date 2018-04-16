<?php
if(isset($_GET['u'])) {
$u = $_GET['u'];
}
else {
$u=0;
}
?>

<div id="build" class="gid17"><a href="#" onClick="return Popup(17,4);" class="build_logo"> 
	<img class="building g17" src="img/x.gif" alt="Marketplace" title="<?php echo MARKETPLACE;?>" /> 
</a> 
<h1><?php echo MARKETPLACE;?> <span class="level"><?php echo LEVEL;?> <?php echo $village->resarray['f'.$id]; ?></span></h1> 
<p class="build_desc"><?php echo MARKETPLACE_DESC;?>
</p> 
 
<?php include("17_menu.tpl");
if($session->plus) {
?>
<table id="search_select" class="buy_select" cellpadding="1" cellspacing="1">
<thead><tr>
<td colspan="4"><?php echo I_AN_SEARCHING;?></td>
</tr></thead>
<tbody><tr>
<td <?php if(isset($_GET['s']) && $_GET['s'] == 1) echo "class=\"hl\""; ?>><a href="build.php?id=<?php echo $id; ?>&t=1&s=1<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['b'])) echo "&b=".$_GET['b']; ?>"><img class="r1" src="img/x.gif" alt="Lumber" title="<?php echo LUMBER;?>" /></a></td>
<td <?php if(isset($_GET['s']) && $_GET['s'] == 2) echo "class=\"hl\""; ?>><a href="build.php?id=<?php echo $id; ?>&t=1&s=2<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['b'])) echo "&b=".$_GET['b']; ?>"><img class="r2" src="img/x.gif" alt="Clay" title="<?php echo CLAY;?>" /></a></td>
<td <?php if(isset($_GET['s']) && $_GET['s'] == 3) echo "class=\"hl\""; ?>><a href="build.php?id=<?php echo $id; ?>&t=1&s=3<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['b'])) echo "&b=".$_GET['b']; ?>"><img class="r3" src="img/x.gif" alt="Iron" title="<?php echo IRON;?>" /></a></td>
<td <?php if(isset($_GET['s']) && $_GET['s'] == 4) echo "class=\"hl\""; ?>><a href="build.php?id=<?php echo $id; ?>&t=1&s=4<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['b'])) echo "&b=".$_GET['b']; ?>"><img class="r4" src="img/x.gif" alt="Crop" title="<?php echo CROP;?>" /></a></td></tr></tbody>
</table><table id="ratio_select" class="buy_select" cellpadding="1" cellspacing="1">
<tbody>
	<tr><td <?php if(isset($_GET['v'])) echo "class=\"hl\""; ?>><a href="build.php?id=<?php echo $id; ?>&t=1&v=1:1<?php if(isset($_GET['s'])) echo "&s=".$_GET['s']; if(isset($_GET['b'])) echo "&b=".$_GET['b']; ?>">1:1</a></td>
	</tr><tr><td <?php if(!isset($_GET['v'])) echo "class=\"hl\""; ?>><a href="build.php?id=<?php echo $id; ?>&t=1<?php if(isset($_GET['s'])) echo "&s=".$_GET['s']; if(isset($_GET['b'])) echo "&b=".$_GET['b']; ?>">1:x</a></td>
	</tr>
</tbody>
</table>
<table id="bid_select" class="buy_select" cellpadding="1" cellspacing="1">
<thead><tr>
<td colspan="4"><?php echo I_AN_OFFERING;?></td>
</tr></thead>
<tbody><tr>
<td <?php if(isset($_GET['b']) && $_GET['b'] == 1) echo "class=\"hl\""; ?>><a href="build.php?id=<?php echo $id; ?>&t=1&b=1<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['s'])) echo "&s=".$_GET['s']; ?>"><img class="r1" src="img/x.gif" alt="Lumber" title="<?php echo LUMBER;?>" /></a></td>
<td <?php if(isset($_GET['b']) && $_GET['b'] == 2) echo "class=\"hl\""; ?>><a href="build.php?id=<?php echo $id; ?>&t=1&b=2<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['s'])) echo "&s=".$_GET['s']; ?>"><img class="r2" src="img/x.gif" alt="Clay" title="<?php echo CLAY;?>" /></a></td>
<td <?php if(isset($_GET['b']) && $_GET['b'] == 3) echo "class=\"hl\""; ?>><a href="build.php?id=<?php echo $id; ?>&t=1&b=3<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['s'])) echo "&s=".$_GET['s']; ?>"><img class="r3" src="img/x.gif" alt="Iron" title="<?php echo IRON;?>" /></a></td>
<td <?php if(isset($_GET['b']) && $_GET['b'] == 4) echo "class=\"hl\""; ?>><a href="build.php?id=<?php echo $id; ?>&t=1&b=4<?php if(isset($_GET['v'])) echo "&v=".$_GET['v']; if(isset($_GET['s'])) echo "&s=".$_GET['s']; ?>"><img class="r4" src="img/x.gif" alt="Crop" title="<?php echo CROP;?>" /></a></td></tr></tbody>
</table>
 <?php
 }
 ?>
<div class="clear"></div><table id="range" cellpadding="1" cellspacing="1">
<?php
if(isset($_GET['e1']))
{
    echo "<p class=\"error2\">".NOT_ENOUGH_RESOURCES."</p>";
}
elseif(isset($_GET['e2']))
{
    echo "<p class=\"error2\">".INVALID_OFFER."</p>";
}
elseif(isset($_GET['e3']))
{
    echo "<p class=\"error2\">".NOT_ENOUGH_MERCHANTS."</p>";
} 
?>
<thead><tr>
	<th colspan="5"><a name="h2"></a><?php echo OFFERS_MARKETPLACE;?></th>
</tr>
<tr>
	<td><?php echo OFFERED_TO_ME;?></td>
	<td><?php echo WANTED_TO_ME;?></td>
	<td><?php echo PLAYER;?></td>
	<td><?php echo DURATION;?></td>
	<td><?php echo ACTION;?></td>
</tr></thead>
<tbody>
<?php
if(count($market->onsale) > 0) {
for($i=0+$u;$i<=40+$u;$i++) {
if(isset($market->onsale[$i])) {
echo "<tr><td class=\"val\">";
$reqMerc = 1;
if($market->onsale[$i]['wamt'] > $market->maxcarry) {
			$reqMerc = round($market->onsale[$i]['wamt']/$market->maxcarry);
			if($market->onsale[$i]['wamt'] > $market->maxcarry*$reqMerc) {
				$reqMerc += 1;
			}
		}
switch($market->onsale[$i]['gtype']) {
    case 1: echo "<img src=\"img/x.gif\" class=\"r1\" alt=\"Wood\" title=\"".LUMBER."\" />"; break;
    case 2: echo "<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"".CLAY."\" />"; break;
    case 3: echo "<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"".IRON."\" />"; break;
    case 4: echo "<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"".CROP."\" />"; break;
 	}
    echo $market->onsale[$i]['gamt'];
    echo "</td> <td class=\"val\">";
    switch($market->onsale[$i]['wtype']) {
    case 1: echo "<img src=\"img/x.gif\" class=\"r1\" alt=\"Wood\" title=\"".LUMBER."\" />"; break;
    case 2: echo "<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"".CLAY."\" />"; break;
    case 3: echo "<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"".IRON."\" />"; break;
    case 4: echo "<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"".CROP."\" />"; break;
    }
    echo $market->onsale[$i]['wamt'];
    echo "</td><td class=\"pla\" title=\"".$database->getVillageField($market->onsale[$i]['vref'],"name")."\">";
    echo "<a href=\"karte.php?d=".$market->onsale[$i]['vref']."&c=".$generator->getMapCheck($market->onsale[$i]['vref'])."\">".$database->getUserField($database->getVillageField($market->onsale[$i]['vref'],"owner"),"username",0)."</a></td>";
    echo "<td class=\"dur\">".$generator->getTimeFormat($market->onsale[$i]['duration'])."</td>";
    if(($market->onsale[$i]['wtype'] == 1 && $village->awood <= $market->onsale[$i]['wamt']) ||($market->onsale[$i]['wtype'] == 2 && $village->aclay <= $market->onsale[$i]['wamt']) ||($market->onsale[$i]['wtype'] == 3 && $village->airon <= $market->onsale[$i]['wamt']) ||($market->onsale[$i]['wtype'] == 4 && $village->acrop <= $market->onsale[$i]['wamt'])) {
    echo "<td class=\"act none\">".NOT_ENOUGH_RESOURCES."</td></tr>";
    }
    else if($reqMerc > $market->merchantAvail()) {
    echo "<td class=\"act none\">".NOT_ENOUGH_MERCHANTS."</td></tr>";
    }
    else if($session->access != BANNED){
    echo "<td class=\"act\"><a href=\"build.php?id=$id&t=1&a=".$session->mchecker."&g=".$market->onsale[$i]['id']."\">Accept offer</a></td>";
    }else{ 
	echo "<td class=\"act\"><a href=\"banned.php\">".ACCEP_OFFER."</a></td>";
	}
    echo"</tr>";
    }
}
}
else {
echo "<tr><td class=\"none\" colspan=\"5\">".NO_AVAILABLE_OFFERS."</td></tr>";
}
?>
</tbody><tfoot><tr><td colspan="5">
<span class="none">
<?php
if(!isset($_GET['u']) && count($market->onsale) < 40) {
    echo "<span class=\"none\"><b>&laquo;</b></span><span class=\"none\"><b>&raquo;</b></span>";
    }
    else if (!isset($_GET['u']) && count($market->onsale) > 40) {
    echo "<span class=\"none\"><b>&laquo;</b></span><a href=\"build.php?id=<?php echo $id; ?>&t=1&u=40\">&raquo;</a>";
    }
    else if(isset($_GET['u']) && count($market->onsale) > $_GET['u']) {
    	if(count($market->onsale) > ($_GET['u']+40) && $_GET['u']-40 < count($market->onsale) && $_GET['u'] != 0) {
         echo "<a href=\"build.php?id=<?php echo $id; ?>&t=1&u=".($_GET['u']-40)."\">&laquo;</a><a href=\"build.php?id=<?php echo $id; ?>&t=1&u=".($_GET['u']+40)."\">&raquo;</a>";
         }
         else if(count($market->onsale) > $_GET['u']+40) {
         	echo "<span class=\"none\"><b>&laquo;</b></span><a href=\"build.php?id=<?php echo $id; ?>&t=1&u=".($_GET['u']+40)."\">&raquo;</a>";
         }
        else {
        echo "<a href=\"build.php?id=<?php echo $id; ?>&t=1&u=".($_GET['u']-40)."\">&laquo;</a><span class=\"none\"><b>&raquo;</b></span>";
        }
    }
?>
</td></tr> 
</table></div> 