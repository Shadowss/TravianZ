<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       results_villages.tpl                                        ##
##  Developed by:  Dzoki                                                       ##
##  Reworked:      aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################

$result = $admin->search_village($_POST['s']);
?>
<table id="member">
	<thead>
		<tr>
			<th colspan="5">
				Found villages (<?php echo count($result);?>)
			</th>
		</tr>
		<tr>
			<td colspan="5"></td>
		</tr>
		<tr>
			<td><a href="">1 «</a></td>
			<td colspan="2"></td>
			<td colspan="2"><a href="">» 100</a></td>
		</tr>
		<tr>
			<td colspan="5"></td>
		</tr>
	</thead>
	<thead>
		<tr>
			<td style="background-color: #F3F3F3;">ID</th>
			<td style="background-color: #F3F3F3;">Village Name</th>
			<td style="background-color: #F3F3F3;">Village Owner</th>
			<td style="background-color: #F3F3F3;">Population</th>
			<td style="background-color: #F3F3F3;"></th>
		</tr>
	</thead>
	<tbody>
		<?php
			if($result)
			{
				for ($i = 0; $i <= count($result)-1; $i++)
				{
					$delLink = '<a href="?action=delVil&did='.$result[$i]['wref'].'" onClick="return del(\'did\','.$result[$i]['wref'].');"><img src="../img/Admin/del.gif" class="del"></a>';
					echo '
					<tr>
						<td>'.$result[$i]["wref"].'</td>
						<td><a href="?p=village&did='.$result[$i]["wref"].'">'.$result[$i]["name"].'</a></td>
						<td><a href="?p=player&uid='.$result[$i]["owner"].'">'.$database->getUserField($result[$i]["owner"],'username',0).'</a></td>
						<td>'.$result[$i]["pop"].'</td>
						<td>'.$delLink.'</td>
					</tr>';
				}
				echo '
					<tr>
						<td colspan="5"></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="5" style="background-image: url(../../gpack/travian_default/img/f/c4.gif);">
							<center>
								<font color="red">'.count($result).'</font> Villages Found "<font color="red">'.$_POST['s'].'</font>"
							</center>
						</td>
					</tr>';
			}
			else
			{
				echo '
					<tr>
						<td></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="5" style="background-image: url(../../gpack/travian_default/img/f/c4.gif);">
							<center>
								<font color="#9F9F90">No Villages Called</font> <font color="red">'.$_POST['s'].'</font>
							</center>
						</td>
					</tr>';
			}
		?>
	</tfoot>
</table>
