<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       village.php                                                 ##
##  Developed by:  Dzoki & Advocatie                                           ##
##  License:       TravianX Project                                            ##
##  Thanks to:     Dzoki & itay2277(Edit some additions)                       ##
##  Fix by:        ronix (some additions)                                      ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
##  Improved:      aggenkeech                                                  ##
#################################################################################
if($_SESSION['access'] < 8) die("Access Denied: You are not Admin!");
error_reporting(0);
$id = $_GET['did'];
if(isset($id))
{
	$coor = $database->getCoor($village['wref']);
	$varray = $database->getProfileVillages($village['owner']);
	$type = $database->getVillageType($village['wref']);
	$fdata = $database->getResourceLevel($village['wref']);
	$units = $database->getUnit($village['wref']);
	$abtech = $database->getABTech($id); // Armory/blacksmith level
	if($type == 1){ $typ = array(3,3,3,9); }
	elseif($type == 2){ $typ = array(3,4,5,6); }
	elseif($type == 3){ $typ = array(4,4,4,6); }
	elseif($type == 4){ $typ = array(4,5,3,6); }
	elseif($type == 5){ $typ = array(5,3,4,6); }
	elseif($type == 6){ $typ = array(1,1,1,15); }
	elseif($type == 7){ $typ = array(4,4,3,7); }
	elseif($type == 8){ $typ = array(3,4,4,7); }
	elseif($type == 9){ $typ = array(4,3,4,7); }
	elseif($type == 10){ $typ = array(3,5,4,6); }
	elseif($type == 11){ $typ = array(4,5,3,6); }
	elseif($type == 12){ $typ = array(5,4,3,6); }
	$ocounter = array();
	$wood = $clay = $iron =$crop = 0;
	$q = "SELECT o.*, w.x, w.y FROM ".TB_PREFIX."odata AS o LEFT JOIN ".TB_PREFIX."wdata AS w ON o.wref=w.id WHERE conqured = ".(int) $village['wref'];
	$result = $database->query_return($q);
	if(count($result) >0)
		{
		    $newResult = [];
			foreach($result as $row)
			{
				$type = $row['type'];
                if ( $type == 1 ) {
                    $row['type'] = '<img src="../img/admin/r/1.gif"> + 25%';
                    $wood        += 1;
                } elseif ( $type == 2 ) {
                    $row['type'] = '<img src="../img/admin/r/1.gif"> + 25%';
                    $wood        += 1;
                } elseif ( $type == 3 ) {
                    $row['type'] = '<img src="../img/admin/r/1.gif"> + 25%<br /><img src="../img/admin/r/4.gif"> + 25%';
                    $wood        += 1;
                    $crop        += 1;
                } elseif ( $type == 4 ) {
                    $row['type'] = '<img src="../img/admin/r/2.gif"> + 25%';
                    $clay        += 1;
                } elseif ( $type == 5 ) {
                    $row['type'] = '<img src="../img/admin/r/2.gif"> + 25%';
                    $clay        += 1;
                } elseif ( $type == 6 ) {
                    $row['type'] = '<img src="../img/admin/r/2.gif"> + 25%<br /><img src="../img/admin/r/4.gif"> + 25%';
                    $clay        += 1;
                    $crop        += 1;
                } elseif ( $type == 7 ) {
                    $row['type'] = '<img src="../img/admin/r/3.gif"> + 25%';
                    $iron        += 1;
                } elseif ( $type == 8 ) {
                    $row['type'] = '<img src="../img/admin/r/3.gif"> + 25%';
                    $iron        += 1;
                } elseif ( $type == 9 ) {
                    $row['type'] = '<img src="../img/admin/r/3.gif"> + 25%<br /><img src="../img/admin/r/4.gif"> + 25%';
                    $iron        += 1;
                    $crop        += 1;
                } elseif ( $type == 10 ) {
                    $row['type'] = '<img src="../img/admin/r/4.gif"> + 25%';
                    $crop        += 1;
                } elseif ( $type == 11 ) {
                    $row['type'] = '<img src="../img/admin/r/4.gif"> + 25%';
                    $crop        += 1;
                } elseif ( $type == 12 ) {
                    $row['type'] = '<img src="../img/admin/r/4.gif"> + 50%';
                    $crop        += 2;
                }

                $newResult[] = $row;
			}
		}
	$ocounter = array($wood,$clay,$iron,$crop);
	$production=$admin->calculateProduction($id,$user['id'],$user['b1'],$user['b2'],$user['b3'],$user['b4'],$fdata, $ocounter, $village['pop']);
	$refreshiconfrm = "../img/admin/refresh.png";
	$refreshicon  = "<img src=\"".$refreshiconfrm."\">";

	class MyGenerator
	{
		public function getMapCheck($wref)
		{
			return substr(md5($wref),5,2);
		}
	};
	$generator = new MyGenerator;

	if($village and $user)
	{
		include("search2.tpl"); ?>
		<style>
			.del {width:12px; height:12px; background-image: url(img/admin/icon/del.gif);}
		</style>
		<link href="../<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css">
		<br />

		<table id="profile" cellpadding="1" cellspacing="1" >
			<thead>
				<tr>
					<th colspan="3">Village Information</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Village owner:</td>
					<td><a href="admin.php?p=player&uid=<?php echo $village['owner']; ?>"><?php echo $user['username']; ?></a></td>
					<td>
						<form action="../GameEngine/Admin/Mods/editVillageOwner.php" method="POST" accept-charset="UTF-8">
							<input type="hidden" name="did" value="<?php echo $_GET['did']; ?>">
							<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
							Owner(uid): <input class="text" type="text" name="newowner" value="<?php echo $user['id']; ?>"><input type="image" value="submit" src="../img/admin/edit.gif">
						</form>
					</td>
				<tr>
					<td>Village name:</td>
					<form action="../GameEngine/Admin/Mods/renameVillage.php" method="POST" accept-charset="UTF-8">
						<input type="hidden" name="did" value="<?php echo $_GET['did']; ?>">
						<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
						<td colspan="2">
							<input class="text" type="text" name="villagename" value="<?php echo $village['name']; ?>"> <input type="image" value="submit" src="../img/admin/edit.gif">
						</td>
					</form>
				</tr>
				<tr>
					<td>Population</td>
					<td colspan="2"><?php echo $village['pop'];?> <a href="admin.php?action=recountPop&did=<?php echo $_GET['did']; ?>"><?php echo $refreshicon; ?></a></td>
				</tr>
				<tr>
					<td>Coordinates:</td>
					<td colspan="2"><a href="<?php echo HOMEPAGE ?>/karte.php?d=<?php echo $village['wref']; ?>&c=<?php echo $generator->getMapCheck($village['wref']); ?>" target="blank">(<?php echo $coor['x']."|".$coor['y']; ?>)</a></td>
				</tr>
				<tr>
					<td>Village ID</td>
					<td colspan="2"><?php echo $village['wref'];?></td>
				</tr>
				<tr>
					<td>Field type</td>
					<td colspan="2">
						<?php
							for ($i = 0; $i <= 3; $i++)
							{
								$a = $i+1;
								if($i != 3)
								{
									echo $typ[$i].'x <img src="../img/admin/r/'.$a.'.gif">| ';
								}
								else
								{
									echo $typ[$i].'x <img src="../img/admin/r/'.$a.'.gif"> ';
								}
							}
						?>
					</td>
				</tr>
			</tbody>
		</table>

		<table id="member">
			<thead>
				<tr>
					<th colspan="7">Resources <a href="admin.php?p=editResources&did=<?php echo $_GET['did']; ?>"><img src="../img/admin/edit.gif" title="Edit Resources and Capacity"></a></th>
				</tr>
				<tr>
					<td>Resource</td>
					<td colspan="2">Warehouse</td>
					<td>Production</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><img class="r1" src="../img/x.gif"> Lumber</td>
					<td><center><?php echo floor($village['wood']); ?></center></td>
					<td rowspan="3"><center><?php echo $village['maxstore'];?></center></td>
					<td><center><?php echo $production['wood'];?></td>
				</tr>
				</tr>
				<tr>
					<td><img class="r2" src="../img/x.gif"> Clay</td>
					<td><center><?php echo floor($village['clay']); ?></center></td>
					<td><center><?php echo $production['clay'];?></center></td>
				</tr>
				<tr>
					<td><img class="r3" src="../img/x.gif"> Iron</td>
					<td><center><?php echo floor($village['iron']); ?></center></td>
					<td><center><?php echo $production['iron'];?></center></td>
				</tr>
				<tr>
					<td><img class="r4" src="../img/x.gif"> Crop</td>
					<td><center><?php echo floor($village['crop']); ?></center></td>
					<td><center><?php echo $village['maxcrop'];?></center></td>
					<td><center><?php echo $production['crop'];?></center></td>
				</tr>
			</tbody>
		</table>


		<table id="member">
			<thead>
				<tr>
					<th colspan="5">Village Expansion</th>
				</tr>
				<tr>
					<td class="hab">Village</td>
					<td class="hab">Inhabitants</td>
					<td class="hab">CP Production</td>
				</tr>
			</thead>
			<tbody>
				<?php
					for($e=1; $e<4; $e++)
					{
						$exp = $village['exp'.$e.''];
						if($exp == 0)
						{
							echo '
								<tr>
									<td class="hab"><center> - </center></td>
									<td class="hab"><center> - </center></td>
									<td class="hab"><center> - </center></td>
								</tr>';
						}
						else
						{
							$vill = $database->getVillage($exp);
							$link = '<a href="admin.php?p=village&did='.$vill['wref'].'">'.$vill['name'].'</a>';
							echo '
								<tr>
									<td class="hab">'.$link.'</td>
									<td class="ra"><center>'.$vill['pop'].'<center></td>
									<td class="ra"><center>'.$vill['cp'].'</center></td>
								</tr>';
						}
					}
				?>
					</td>
				</tr>
			</tbody>
		</table>

		<table id="member" cellpadding="1" cellspacing="1" >
			<thead>
				<tr>
					<th colspan="6">Oasis</th>
				</tr>
				<tr>
					<td class="ra"></td>
					<td class="hab">Name</td>
					<td class="hab">Coordinates</td>
					<td class="hab">Loyalty</td>
					<td class="hab">Resources</td>
				</tr>
			</thead>
			<tbody>
				<?php
					if(count($newResult))
					{
						foreach($newResult as $row)
						{
							echo "
							<tr>
								<td><a href=\"?action=delOas&oid=".$row['wref']."\" onClick=\"return del('oas',".$row['wref'].")\"><img src=\"../img/admin/del.gif\"></a></td>
								<td class=\"hab\">".$row['name']."</td>
								<td class=\"hab\"><a href=\"../karte.php?d=".$row['wref']."&c=".$generator->getMapCheck($row['wref'])."\" target=\"blank\">(".$row['x']."|".$row['y'].")</a></td>
								<td class=\"hab\">".round($row['loyalty'])."%</td>
								<td class=\"hab\">".$row['type']."</td>
							</tr>";
						}
					}
					elseif($result ==0)
					{
						echo '<td colspan="5"><center>This village has no oases</center></td>';
					}
				?>
			</tbody>
		</table>

		<?php
			include('troops.tpl');
		?>

		<?php
			include('troopUpgrades.tpl');
		?>


		<a href="admin.php?p=editVillage&did=<?php echo $_GET['did']; ?>" title="Edit Village">
		<div id="content" class="village1" style="min-height: 264px;">
			<div id="village_map" class="f<?php echo $database->getVillageType($village['wref']); ?>" style="float: left;">
				<?php
					for($f = 1; $f <19; $f++)
					{
						$gid = $fdata['f'.($f).'t'];
						$level = $fdata['f'.($f)];
						echo "<img src=\"../img/x.gif\" class=\"reslevel rf".$f." level".$level."\">";
					}

				?>
			</div>
			<div id="map_details">
			<!--	<table>
					<tbody>
						<tr>
							<td class="ico"><img class="r1" src="../img/x.gif"></td>
							<td class="res">Lumber:</td>
							<td class="num">Coming</td>
							<td class="per">/hr</td>
						</tr>
						<tr>
							<td class="ico"><img class="r2" src="../img/x.gif"></td>
							<td class="res">Clay:</td>
							<td class="num">Coming</td>
							<td class="per">/hr</td>
						</tr>
						<tr>
							<td class="ico"><img class="r3" src="../img/x.gif"></td>
							<td class="res">Iron:</td>
							<td class="num">Coming</td>
							<td class="per">/hr</td>
						</tr>
						<tr>
							<td class="ico"><img class="r4" src="../img/x.gif"></td>
							<td class="res">Crop:</td>
							<td class="num">Coming</td>
							<td class="per">/hr</td>
						</tr>
					</tbody>
				</table> -->
		</div>
		</div></a>
	<div id="content" class="village2" style="padding: 0; margin-left: -20px;">
		<h1><?php echo $village['name']; ?></h1>
		<div id="village_map" class="d2_0">
			<?php
			for($b =1; $b <21; $b++)
			{
				$gid = $fdata['f'.($b + 18).'t'];
				if($gid >0)
				{
					echo "<img src=\"../img/x.gif\" class=\"building d".$b." g".$gid."\">";
				}
				elseif($gid ==0)
				{
					echo "<img src=\"../img/x.gif\" class=\"building d".$b." iso\">";
				}
			}
			$rp=16;
			$rplevel = $fdata['f'.$rp];
			if($rplevel > 0)
			{
				echo "<img src=\"../img/x.gif\" class=\"dx1 g16\">";
			}
			elseif($rplevel ==0)
			{
				echo "<img src=\"../img/x.gif\" class=\"dx1 g16e\">";
			}

            $resourcearray = $database->getResourceLevel($village['wref']);
            if($resourcearray['f99t'] == 40) {
                if($resourcearray['f99'] >= 0 && $resourcearray['f99'] <= 19) {
                    echo '<img class="ww g40" src="img/x.gif" alt="Worldwonder">'; }
                if($resourcearray['f99'] >= 20 && $resourcearray['f99'] <= 39) {
                    echo '<img class="ww g40_1" src="img/x.gif" alt="Worldwonder">'; }
                if($resourcearray['f99'] >= 40 && $resourcearray['f99'] <= 59) {
                    echo '<img class="ww g40_2" src="img/x.gif" alt="Worldwonder">'; }
                if($resourcearray['f99'] >= 60 && $resourcearray['f99'] <= 79) {
                    echo '<img class="ww g40_3" src="img/x.gif" alt="Worldwonder">'; }
                if($resourcearray['f99'] >= 80 && $resourcearray['f99'] <= 99) {
                    echo '<img class="ww g40_4" src="img/x.gif" alt="Worldwonder">'; }
                if($resourcearray['f99'] == 100) {
                    echo '<img class="ww g40_5" src="img/x.gif" alt="Worldwonder">'; }
            }

			?>
			<div id="levels" class="on">
				<?php
					for($b =1; $b <21; $b++)
					{
						$level = $fdata['f'.($b + 18)];
						if($level >0)
						{
							echo "<div class=\"d$b\">$level</div>";
						}
					}
					if($rplevel >0)
					{
						echo "<div class=\"l39\">".$fdata['f'.($b + 18)]."</div>";
					}
				?>
	</div>
</div>
</div>

<table id="member" cellpadding="1" cellspacing="1" >
	<thead>
		<tr>
			<th colspan="5">Buildings</th>
		</tr>
		<tr>
			<td class="on">ID</td>
			<td class="on">GID</td>
			<td class="hab">Name</td>
			<td class="on">Level</td>
			<td class="on">Edit</td>
		</tr>
	</thead>
	<tbody>
	<?php
	for ($i = 1; $i <= 40; $i++)
	{
		if($fdata['f'.$i.'t'] == 0)
		{
			$bu = "-";
		}
		else
		{
			$bu = $funct->procResType($fdata['f'.$i.'t']);
		}
		echo '
			<tr>
				<td class="on">'.$i.'</td>
				<td class="on">'.$fdata['f'.$i.'t'].'</td>
				<td class="hab">'.$bu.'</td>
				<td class="on">'.$fdata['f'.$i].'</td>
				<td class="on"><a href="admin.php?p=editVillage&did='.$_GET['did'].'"><img src="../img/admin/edit.gif" title="Edit Building & Level"></a></td>
			</tr>';
	}
	?>
	</tbody>
</table>

<br /><br />

	<a href="admin.php?p=villagelog&did=<?php echo $_GET['did']; ?>">Village Build Log</a>
	<br />
</div>
<?php
}
else
{
	include("404.tpl");
}
}
?>
