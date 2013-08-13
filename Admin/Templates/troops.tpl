<table id="member">
	<thead>
		<tr>
			<th colspan="10">Troops in village</th>
				<?php
					## Roman
					if($units['u1'] == 0){$u1 = '<font color="gray">'.$units['u1'].'';}
					else if($units['u1'] > 0){$u1 = '<font color="black">'.$units['u1'].'';}
					if($units['u2'] == 0){$u2 = '<font color="gray">'.$units['u2'].'';}
					else if($units['u2'] > 0){$u2 = '<font color="black">'.$units['u2'].'';}
					if($units['u3'] == 0){$u3 = '<font color="gray">'.$units['u3'].'';}
					else if($units['u3'] > 0){$u3 = '<font color="black">'.$units['u3'].'';}
					if($units['u4'] == 0){$u4 = '<font color="gray">'.$units['u4'].'';}
					else if($units['u4'] > 0){$u4 = '<font color="black">'.$units['u4'].'';}
					if($units['u5'] == 0){$u5 = '<font color="gray">'.$units['u5'].'';}
					else if($units['u5'] > 0){$u5 = '<font color="black">'.$units['u5'].'';}
					if($units['u6'] == 0){$u6 = '<font color="gray">'.$units['u6'].'';}
					else if($units['u6'] > 0){$u6 = '<font color="black">'.$units['u6'].'';}
					if($units['u7'] == 0){$u7 = '<font color="gray">'.$units['u7'].'';}
					else if($units['u7'] > 0){$u7 = '<font color="black">'.$units['u7'].'';}
					if($units['u8'] == 0){$u8 = '<font color="gray">'.$units['u8'].'';}
					else if($units['u8'] > 0){$u8 = '<font color="black">'.$units['u8'].'';}
					if($units['u9'] == 0){$u9 = '<font color="gray">'.$units['u9'].'';}
					else if($units['u9'] > 0){$u9 = '<font color="black">'.$units['u9'].'';}
					if($units['u10'] == 0){$u10 = '<font color="gray">'.$units['u10'].'';}
					else if($units['u10'] > 0){$u10 = '<font color="black">'.$units['u10'].'';}
					## Teuton
					if($units['u11'] == 0){$u11 = '<font color="gray">'.$units['u11'].'';}
					else if($units['u11'] > 0){$u11 = '<font color="black">'.$units['u11'].'';}
					if($units['u12'] == 0){$u12 = '<font color="gray">'.$units['u12'].'';}
					else if($units['u12'] > 0){$u12 = '<font color="black">'.$units['u12'].'';}
					if($units['u13'] == 0){$u13 = '<font color="gray">'.$units['u13'].'';}
					else if($units['u13'] > 0){$u13 = '<font color="black">'.$units['u13'].'';}
					if($units['u14'] == 0){$u14 = '<font color="gray">'.$units['u14'].'';}
					else if($units['u14'] > 0){$u14 = '<font color="black">'.$units['u14'].'';}
					if($units['u15'] == 0){$u15 = '<font color="gray">'.$units['u15'].'';}
					else if($units['u15'] > 0){$u15 = '<font color="black">'.$units['u15'].'';}
					if($units['u16'] == 0){$u16 = '<font color="gray">'.$units['u16'].'';}
					else if($units['u16'] > 0){$u16 = '<font color="black">'.$units['u16'].'';}
					if($units['u17'] == 0){$u17 = '<font color="gray">'.$units['u17'].'';}
					else if($units['u17'] > 0){$u17 = '<font color="black">'.$units['u17'].'';}
					if($units['u18'] == 0){$u18 = '<font color="gray">'.$units['u18'].'';}
					else if($units['u18'] > 0){$u18 = '<font color="black">'.$units['u18'].'';}
					if($units['u19'] == 0){$u19 = '<font color="gray">'.$units['u19'].'';}
					else if($units['u19'] > 0){$u19 = '<font color="black">'.$units['u19'].'';}
					if($units['u20'] == 0){$u20 = '<font color="gray">'.$units['u20'].'';}
					else if($units['u20'] > 0){$u20 = '<font color="black">'.$units['u20'].'';}
					## Gaul
					if($units['u21'] == 0){$u21 = '<font color="gray">'.$units['u21'].'';}
					else if($units['u21'] > 0){$u21 = '<font color="black">'.$units['u21'].'';}
					if($units['u22'] == 0){$u22 = '<font color="gray">'.$units['u22'].'';}
					else if($units['u22'] > 0){$u22 = '<font color="black">'.$units['u22'].'';}
					if($units['u23'] == 0){$u23 = '<font color="gray">'.$units['u23'].'';}
					else if($units['u23'] > 0){$u23 = '<font color="black">'.$units['u23'].'';}
					if($units['u24'] == 0){$u24 = '<font color="gray">'.$units['u24'].'';}
					else if($units['u24'] > 0){$u24 = '<font color="black">'.$units['u24'].'';}
					if($units['u25'] == 0){$u25 = '<font color="gray">'.$units['u25'].'';}
					else if($units['u25'] > 0){$u25 = '<font color="black">'.$units['u25'].'';}
					if($units['u26'] == 0){$u26 = '<font color="gray">'.$units['u26'].'';}
					else if($units['u26'] > 0){$u26 = '<font color="black">'.$units['u26'].'';}
					if($units['u27'] == 0){$u27 = '<font color="gray">'.$units['u27'].'';}
					else if($units['u27'] > 0){$u27 = '<font color="black">'.$units['u27'].'';}
					if($units['u28'] == 0){$u28 = '<font color="gray">'.$units['u28'].'';}
					else if($units['u28'] > 0){$u28 = '<font color="black">'.$units['u28'].'';}
					if($units['u29'] == 0){$u29 = '<font color="gray">'.$units['u29'].'';}
					else if($units['u29'] > 0){$u29 = '<font color="black">'.$units['u29'].'';}
					if($units['u30'] == 0){$u30 = '<font color="gray">'.$units['u30'].'';}
					else if($units['u30'] > 0){$u30 = '<font color="black">'.$units['u30'].'';}
					## Nature
					if($units['u31'] == 0){$u31 = '<font color="gray">'.$units['u31'].'';}
					else if($units['u31'] > 0){$u31 = '<font color="black">'.$units['u31'].'';}
					if($units['u32'] == 0){$u32 = '<font color="gray">'.$units['u32'].'';}
					else if($units['u32'] > 0){$u32 = '<font color="black">'.$units['u32'].'';}
					if($units['u33'] == 0){$u33 = '<font color="gray">'.$units['u33'].'';}
					else if($units['u33'] > 0){$u33 = '<font color="black">'.$units['u33'].'';}
					if($units['u34'] == 0){$u34 = '<font color="gray">'.$units['u34'].'';}
					else if($units['u34'] > 0){$u34 = '<font color="black">'.$units['u34'].'';}
					if($units['u35'] == 0){$u35 = '<font color="gray">'.$units['u35'].'';}
					else if($units['u35'] > 0){$u35 = '<font color="black">'.$units['u35'].'';}
					if($units['u36'] == 0){$u36 = '<font color="gray">'.$units['u36'].'';}
					else if($units['u36'] > 0){$u36 = '<font color="black">'.$units['u36'].'';}
					if($units['u37'] == 0){$u37 = '<font color="gray">'.$units['u37'].'';}
					else if($units['u37'] > 0){$u37 = '<font color="black">'.$units['u37'].'';}
					if($units['u38'] == 0){$u38 = '<font color="gray">'.$units['u38'].'';}
					else if($units['u38'] > 0){$u38 = '<font color="black">'.$units['u38'].'';}
					if($units['u39'] == 0){$u39 = '<font color="gray">'.$units['u39'].'';}
					else if($units['u39'] > 0){$u39 = '<font color="black">'.$units['u39'].'';}
					## Natars
					if($units['u40'] == 0){$u40 = '<font color="gray">'.$units['u40'].'';}
					else if($units['u40'] > 0){$u40 = '<font color="black">'.$units['u40'].'';}
					if($units['u41'] == 0){$u41 = '<font color="gray">'.$units['u41'].'';}
					else if($units['u41'] > 0){$u41 = '<font color="black">'.$units['u41'].'';}
					if($units['u42'] == 0){$u42 = '<font color="gray">'.$units['u42'].'';}
					else if($units['u42'] > 0){$u42 = '<font color="black">'.$units['u42'].'';}
					if($units['u43'] == 0){$u43 = '<font color="gray">'.$units['u43'].'';}
					else if($units['u43'] > 0){$u43 = '<font color="black">'.$units['u43'].'';}
					if($units['u44'] == 0){$u44 = '<font color="gray">'.$units['u44'].'';}
					else if($units['u44'] > 0){$u44 = '<font color="black">'.$units['u44'].'';}
					if($units['u45'] == 0){$u45 = '<font color="gray">'.$units['u45'].'';}
					else if($units['u45'] > 0){$u45 = '<font color="black">'.$units['u45'].'';}
					if($units['u46'] == 0){$u46 = '<font color="gray">'.$units['u46'].'';}
					else if($units['u46'] > 0){$u46 = '<font color="black">'.$units['u46'].'';}
					if($units['u47'] == 0){$u47 = '<font color="gray">'.$units['u47'].'';}
					else if($units['u47'] > 0){$u47 = '<font color="black">'.$units['u47'].'';}
					if($units['u48'] == 0){$u48 = '<font color="gray">'.$units['u48'].'';}
					else if($units['u48'] > 0){$u48 = '<font color="black">'.$units['u48'].'';}
					if($units['u49'] == 0){$u49 = '<font color="gray">'.$units['u49'].'';}
					else if($units['u49'] > 0){$u49 = '<font color="black">'.$units['u49'].'';}
					if($units['u50'] == 0){$u50 = '<font color="gray">'.$units['u50'].'';}
					else if($units['u50'] > 0){$u50 = '<font color="black">'.$units['u50'].'';}
					if($_SESSION['access'] == ADMIN)
					{
						if($user['tribe'] == 1)
						{
							echo '
							</tr></thead><tbody>
							<tr>
								<td><center /><img src="../img/un/u/1.gif"></img></td>
								<td><center /><img src="../img/un/u/2.gif"></img></td>
								<td><center /><img src="../img/un/u/3.gif"></img></td>
								<td><center /><img src="../img/un/u/4.gif"></img></td>
								<td><center /><img src="../img/un/u/5.gif"></img></td>
								<td><center /><img src="../img/un/u/6.gif"></img></td>
								<td><center /><img src="../img/un/u/7.gif"></img></td>
								<td><center /><img src="../img/un/u/8.gif"></img></td>
								<td><center /><img src="../img/un/u/9.gif"></img></td>
								<td><center /><img src="../img/un/u/10.gif"></img></td>
							</tr>
							<tr>
								<td><center />'.$u1.'</td>
								<td><center />'.$u2.'</td>
								<td><center />'.$u3.'</td>
								<td><center />'.$u4.'</td>
								<td><center />'.$u5.'</td>
								<td><center />'.$u6.'</td>
								<td><center />'.$u7.'</td>
								<td><center />'.$u8.'</td>
								<td><center />'.$u9.'</td>
								<td><center />'.$u10.'</td>
							 </tr>';
						}
						// TEUTON UNITS
						else if($user['tribe'] == 2)
						{
							echo '
							</tr></thead><tbody>
							<tr>
								<td><center /><img src="../img/un/u/11.gif"></img></td>
								<td><center /><img src="../img/un/u/12.gif"></img></td>
								<td><center /><img src="../img/un/u/13.gif"></img></td>
								<td><center /><img src="../img/un/u/14.gif"></img></td>
								<td><center /><img src="../img/un/u/15.gif"></img></td>
								<td><center /><img src="../img/un/u/16.gif"></img></td>
								<td><center /><img src="../img/un/u/17.gif"></img></td>
								<td><center /><img src="../img/un/u/18.gif"></img></td>
								<td><center /><img src="../img/un/u/19.gif"></img></td>
								<td><center /><img src="../img/un/u/20.gif"></img></td>
							</tr>
							<tr>
								<td><center />'.$u11.'</td>
								<td><center />'.$u12.'</td>
								<td><center />'.$u13.'</td>
								<td><center />'.$u14.'</td>
								<td><center />'.$u15.'</td>
								<td><center />'.$u16.'</td>
								<td><center />'.$u17.'</td>
								<td><center />'.$u18.'</td>
								<td><center />'.$u19.'</td>
								<td><center />'.$u20.'</td>
							</tr>';
						}
						// GAUL UNITS
						else if($user['tribe'] == 3)
						{
							echo '
							</tr></thead><tbody>
							<tr>
								<td><center /><img src="../img/un/u/21.gif"></img></td>
							<td><center /><img src="../img/un/u/22.gif"></img></td>
								<td><center /><img src="../img/un/u/23.gif"></img></td>
								<td><center /><img src="../img/un/u/24.gif"></img></td>
								<td><center /><img src="../img/un/u/25.gif"></img></td>
								<td><center /><img src="../img/un/u/26.gif"></img></td>
								<td><center /><img src="../img/un/u/27.gif"></img></td>
								<td><center /><img src="../img/un/u/28.gif"></img></td>
								<td><center /><img src="../img/un/u/29.gif"></img></td>
								<td><center /><img src="../img/un/u/30.gif"></img></td>
							</tr>


							<tr>
								<td><center />'.$u21.'</td>
								<td><center />'.$u22.'</td>
								<td><center />'.$u23.'</td>
								<td><center />'.$u24.'</td>
								<td><center />'.$u25.'</td>
								<td><center />'.$u26.'</td>
								<td><center />'.$u27.'</td>
								<td><center />'.$u28.'</td>
								<td><center />'.$u29.'</td>
								<td><center />'.$u30.'</td>
							</tr>';
						}
						// Nature UNITS
						else if($user['tribe'] == 4)
						{
							echo '
							</tr></thead><tbody>
							<tr>
								<td><center /><img src="../img/un/u/31.gif"></img></td>
								<td><center /><img src="../img/un/u/32.gif"></img></td>
								<td><center /><img src="../img/un/u/33.gif"></img></td>
								<td><center /><img src="../img/un/u/34.gif"></img></td>
								<td><center /><img src="../img/un/u/35.gif"></img></td>
								<td><center /><img src="../img/un/u/36.gif"></img></td>
								<td><center /><img src="../img/un/u/37.gif"></img></td>
								<td><center /><img src="../img/un/u/38.gif"></img></td>
								<td><center /><img src="../img/un/u/39.gif"></img></td>
								<td><center /><img src="../img/un/u/40.gif"></img></td>
							</tr>
						   <tr>
								<td><center />'.$u31.'</td>
								<td><center />'.$u32.'</td>
								<td><center />'.$u33.'</td>
								<td><center />'.$u34.'</td>
								<td><center />'.$u35.'</td>
								<td><center />'.$u36.'</td>
								<td><center />'.$u37.'</td>
								<td><center />'.$u38.'</td>
								<td><center />'.$u39.'</td>
								<td><center />'.$u40.'</td>
							</tr>';
						}
						// Natar Units
						else if($user['tribe'] == 5)
						{
							echo '
							</tr></thead><tbody>
							<tr>
								<td><center /><img src="../img/un/u/41.gif"></img></td>
								<td><center /><img src="../img/un/u/42.gif"></img></td>
								<td><center /><img src="../img/un/u/43.gif"></img></td>
								<td><center /><img src="../img/un/u/44.gif"></img></td>
								<td><center /><img src="../img/un/u/45.gif"></img></td>
								<td><center /><img src="../img/un/u/46.gif"></img></td>
								<td><center /><img src="../img/un/u/47.gif"></img></td>
								<td><center /><img src="../img/un/u/48.gif"></img></td>
								<td><center /><img src="../img/un/u/49.gif"></img></td>
								<td><center /><img src="../img/un/u/50.gif"></img></td>
							</tr>


						   <tr>
								<td><center />'.$u41.'</td>
								<td><center />'.$u42.'</td>
								<td><center />'.$u43.'</td>
								<td><center />'.$u44.'</td>
								<td><center />'.$u45.'</td>
								<td><center />'.$u46.'</td>
								<td><center />'.$u47.'</td>
								<td><center />'.$u48.'</td>
								<td><center />'.$u49.'</td>
								<td><center />'.$u50.'</td>
							</tr>';
						}
					}
				?>
			</tbody>
		</table>
	<?php
		if($_SESSION['access'] == ADMIN)
		{
			echo '<a href="admin.php?p=addTroops&did='.$_GET['did'].'">Edit Troops</a>';
		}

	?>