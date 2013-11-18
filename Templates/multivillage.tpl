<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       multivillage.tpl                                            ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

if(count($session->villages) > 1){?>
<table id="vlist" cellpadding="1" cellspacing="1">
   <thead><tr><td colspan="3"><a href="dorf3.php" accesskey="9"><?php echo MULTI_V_HEADER; ?>:</a></td></tr></thead>
	<tbody><?php
		$returnVillageArray = $database->getArrayMemberVillage($session->uid);
if(isset($_GET['w'])) {
		for($i=1;$i<=count($session->villages);++$i){echo'
		<tr>
			<td class="dot '.(($_SESSION['wid'] == $returnVillageArray[$i-1]['wref'] ) ? 'hl':'').'">●</td>
			<td class="link"><a href="?newdid='.$returnVillageArray[$i-1]['wref'].(($id>=19) ? "&id=".$id : "&w=".$_GET['w']).'">'.$returnVillageArray[$i-1]['name'].'</a></td>
			<td class="aligned_coords"><div class="cox">('.$returnVillageArray[$i-1]['x'].'</div><div class="pi">|</div><div class="coy">'.$returnVillageArray[$i-1]['y'].')</div></td></tr>';
	}
}
else if(isset($_GET['r'])) {
		for($i=1;$i<=count($session->villages);++$i){echo'
		<tr>
			<td class="dot '.(($_SESSION['wid'] == $returnVillageArray[$i-1]['wref'] ) ? 'hl':'').'">●</td>
			<td class="link"><a href="?newdid='.$returnVillageArray[$i-1]['wref'].(($id>=19) ? "&id=".$id : "&r=".$_GET['r']).'">'.$returnVillageArray[$i-1]['name'].'</a></td>
			<td class="aligned_coords"><div class="cox">('.$returnVillageArray[$i-1]['x'].'</div><div class="pi">|</div><div class="coy">'.$returnVillageArray[$i-1]['y'].')</div></td></tr>';
	}
}
else if(isset($_GET['z'])) {
        for($i=1;$i<=count($session->villages);++$i){echo'
        <tr>
            <td class="dot '.(($_SESSION['wid'] == $returnVillageArray[$i-1]['wref'] ) ? 'hl':'').'">●</td>
            <td class="link"><a href="?newdid='.$returnVillageArray[$i-1]['wref'].(($id>=19) ? "&id=".$id : "&z=".$_GET['z']).'">'.$returnVillageArray[$i-1]['name'].'</a></td>
            <td class="aligned_coords"><div class="cox">('.$returnVillageArray[$i-1]['x'].'</div><div class="pi">|</div><div class="coy">'.$returnVillageArray[$i-1]['y'].')</div></td></tr>';
    }
}
else if(isset($_GET['o'])) {
        for($i=1;$i<=count($session->villages);++$i){echo'
        <tr>
            <td class="dot '.(($_SESSION['wid'] == $returnVillageArray[$i-1]['wref'] ) ? 'hl':'').'">●</td>
            <td class="link"><a href="?newdid='.$returnVillageArray[$i-1]['wref'].(($id>=19) ? "&id=".$id : "&o=".$_GET['o']).'">'.$returnVillageArray[$i-1]['name'].'</a></td>
            <td class="aligned_coords"><div class="cox">('.$returnVillageArray[$i-1]['x'].'</div><div class="pi">|</div><div class="coy">'.$returnVillageArray[$i-1]['y'].')</div></td></tr>';
    }
}
else if(isset($_GET['s'])) {
		for($i=1;$i<=count($session->villages);++$i){echo'
		<tr>
			<td class="dot '.(($_SESSION['wid'] == $returnVillageArray[$i-1]['wref'] ) ? 'hl':'').'">●</td>
			<td class="link"><a href="?newdid='.$returnVillageArray[$i-1]['wref'].(($id>=19) ? "&id=".$id : "&s=".$_GET['s']).'">'.$returnVillageArray[$i-1]['name'].'</a></td>
			<td class="aligned_coords"><div class="cox">('.$returnVillageArray[$i-1]['x'].'</div><div class="pi">|</div><div class="coy">'.$returnVillageArray[$i-1]['y'].')</div></td></tr>';
	}
}
else if(isset($_GET['c'])) {
		for($i=1;$i<=count($session->villages);++$i){echo'
		<tr>
			<td class="dot '.(($_SESSION['wid'] == $returnVillageArray[$i-1]['wref'] ) ? 'hl':'').'">●</td>
			<td class="link"><a href="?newdid='.$returnVillageArray[$i-1]['wref'].(($id>=19) ? "&id=".$id : "&d=".$_GET['d']).(($id>=19) ? "&id=".$id : "&c=".$_GET['c']).'">'.$returnVillageArray[$i-1]['name'].'</a></td>
			<td class="aligned_coords"><div class="cox">('.$returnVillageArray[$i-1]['x'].'</div><div class="pi">|</div><div class="coy">'.$returnVillageArray[$i-1]['y'].')</div></td></tr>';
	}
}
else if(isset($_GET['t'])) {
		for($i=1;$i<=count($session->villages);++$i){echo'
		<tr>
			<td class="dot '.(($_SESSION['wid'] == $returnVillageArray[$i-1]['wref'] ) ? 'hl':'').'">●</td>
			<td class="link"><a href="?newdid='.$returnVillageArray[$i-1]['wref'].(($id>=19) ? "&id=".$id : "&t=".$_GET['t']).'">'.$returnVillageArray[$i-1]['name'].'</a></td>
			<td class="aligned_coords"><div class="cox">('.$returnVillageArray[$i-1]['x'].'</div><div class="pi">|</div><div class="coy">'.$returnVillageArray[$i-1]['y'].')</div></td></tr>';
	}
}
else if(isset($_GET['d'])) {
		for($i=1;$i<=count($session->villages);++$i){echo'
		<tr>
			<td class="dot '.(($_SESSION['wid'] == $returnVillageArray[$i-1]['wref'] ) ? 'hl':'').'">●</td>
			<td class="link"><a href="?newdid='.$returnVillageArray[$i-1]['wref'].(($id>=19) ? "&id=".$id : "&d=".$_GET['d']).'">'.$returnVillageArray[$i-1]['name'].'</a></td>
			<td class="aligned_coords"><div class="cox">('.$returnVillageArray[$i-1]['x'].'</div><div class="pi">|</div><div class="coy">'.$returnVillageArray[$i-1]['y'].')</div></td></tr>';
	}
}
else if(isset($_GET['aid'])) {
		for($i=1;$i<=count($session->villages);++$i){echo'
		<tr>
			<td class="dot '.(($_SESSION['wid'] == $returnVillageArray[$i-1]['wref'] ) ? 'hl':'').'">●</td>
			<td class="link"><a href="?newdid='.$returnVillageArray[$i-1]['wref'].(($id>=19) ? "&id=".$id : "&aid=".$_GET['aid']).'">'.$returnVillageArray[$i-1]['name'].'</a></td>
			<td class="aligned_coords"><div class="cox">('.$returnVillageArray[$i-1]['x'].'</div><div class="pi">|</div><div class="coy">'.$returnVillageArray[$i-1]['y'].')</div></td></tr>';
	}
}
else if(isset($_GET['uid'])) {
		for($i=1;$i<=count($session->villages);++$i){echo'
		<tr>
			<td class="dot '.(($_SESSION['wid'] == $returnVillageArray[$i-1]['wref'] ) ? 'hl':'').'">●</td>
			<td class="link"><a href="?newdid='.$returnVillageArray[$i-1]['wref'].(($id>=19) ? "&id=".$id : "&uid=".$_GET['uid']).'">'.$returnVillageArray[$i-1]['name'].'</a></td>
			<td class="aligned_coords"><div class="cox">('.$returnVillageArray[$i-1]['x'].'</div><div class="pi">|</div><div class="coy">'.$returnVillageArray[$i-1]['y'].')</div></td></tr>';
	}
}
else if(isset($_GET['vill']) && isset($_GET['id'])) {
		for($i=1;$i<=count($session->villages);++$i){echo'
		<tr>
			<td class="dot '.(($_SESSION['wid'] == $returnVillageArray[$i-1]['wref'] ) ? 'hl':'').'">●</td>
			<td class="link"><a href="?newdid='.$returnVillageArray[$i-1]['wref'].(($id>=19) ? "&id=".$id : "&id=".$_GET['id'])."&vill=".$_GET['vill'].'">'.$returnVillageArray[$i-1]['name'].'</a></td>
			<td class="aligned_coords"><div class="cox">('.$returnVillageArray[$i-1]['x'].'</div><div class="pi">|</div><div class="coy">'.$returnVillageArray[$i-1]['y'].')</div></td></tr>';
	}
}
else if(isset($_GET['t']) && isset($_GET['id'])) {
		for($i=1;$i<=count($session->villages);++$i){echo'
		<tr>
			<td class="dot '.(($_SESSION['wid'] == $returnVillageArray[$i-1]['wref'] ) ? 'hl':'').'">●</td>
			<td class="link"><a href="?newdid='.$returnVillageArray[$i-1]['wref'].(($id>=19) ? "&id=".$id : "&id=".$_GET['id'])."&t=".$_GET['t'].'">'.$returnVillageArray[$i-1]['name'].'</a></td>
			<td class="aligned_coords"><div class="cox">('.$returnVillageArray[$i-1]['x'].'</div><div class="pi">|</div><div class="coy">'.$returnVillageArray[$i-1]['y'].')</div></td></tr>';
	}}else{
		for($i=1;$i<=count($session->villages);++$i){echo'
		<tr>
			<td class="dot '.(($_SESSION['wid'] == $returnVillageArray[$i-1]['wref'] ) ? 'hl':'').'">●</td>
			<td class="link"><a href="?newdid='.$returnVillageArray[$i-1]['wref'].(($id>=19) ? "&id=".$id : "&id=".$_GET['id']).'">'.$returnVillageArray[$i-1]['name'].'</a></td>
			<td class="aligned_coords"><div class="cox">('.$returnVillageArray[$i-1]['x'].'</div><div class="pi">|</div><div class="coy">'.$returnVillageArray[$i-1]['y'].')</div></td></tr>';
	}}?>
	</tbody>
</table>
<?php
}
?>
