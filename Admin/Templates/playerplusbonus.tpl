<th><b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b></th>
								<td>
									<?php
										$datetime = $user['plus'];
										$now = time();
										if($datetime ==0)
										{
											echo '<img src="../img/admin/del.gif">';
											echo "<font color=\"red\"> No Bonus</font>";
										}
										else
										{
											if($datetime <= $now)
											{
												echo '<img src="../img/admin/del.gif">';
												echo "<font color=\"red\"> No Bonus</font>";
											}
											else
											{
												$tsdiffact = $datetime - $now;
												$timetoecho = $timeformat->getTimeFormat($tsdiffact);
												echo '<img src="../gpack/travian_default/img/new/tick.png" title="Ends: '.date('d.m.Y H:i',$user['plus']+3600*2).'">';
												echo "<font color=\"blue\"> $timetoecho</font>";
											}
										}
										/*if(date('d.m.Y H:i',$user['plus']) == '01.01.1970 00:00')
										{
											echo "Not enabled!</tr></th>";
										}
										else
										{
											echo "".date('d.m.Y H:i',$user['plus']+3600*2)."</tr></th>";
										} */
									?>
								 <a href="admin.php?p=editPlus&uid=<?php echo $user['id']; ?>"><img src="../img/admin/edit.gif" title="Edit Plus and Bonus"></a></td>
							</tr>
							<tr>
								<th><img src="../img/admin/r/1.gif"> Bonus</th>
								<td>
									<?php
										$datetime = $user['b1'];
										$now = time();
										if($datetime ==0)
										{
											echo '<img src="../img/admin/del.gif">';
											echo "<font color=\"red\"> No Bonus</font>";
										}
										else
										{
											if($datetime <= $now)
											{
												echo '<img src="../img/admin/del.gif">';
												echo "<font color=\"red\"> No Bonus</font>";
											}
											else
											{
												$tsdiffact = $datetime - $now;
												$timetoecho = $timeformat->getTimeFormat($tsdiffact);
												echo '<img src="../gpack/travian_default/img/new/tick.png" title="Ends: '.date('d.m.Y H:i',$user['b1']+3600*2).'">';
												echo "<font color=\"blue\"> $timetoecho</font>";
											}
										}
										/*if(date('d.m.Y H:i',$user['b1']) == '01.01.1970 00:00')
										{
											echo "Not enabled!</tr></th>";
										}
										else
										{
											echo "".date('d.m.Y H:i',$user['b1']+3600*2)."</tr></th>";
										} */
									?>
								 <a href="admin.php?p=editPlus&uid=<?php echo $user['id']; ?>"><img src="../img/admin/edit.gif" title="Edit Plus and Bonus"></a></td>
							</tr>
							<tr>
								<th><img src="../img/admin/r/2.gif"> Bonus</th>
								<td>
									<?php
										$datetime = $user['b2'];
										$now = time();
										if($datetime ==0)
										{
											echo '<img src="../img/admin/del.gif">';
											echo "<font color=\"red\"> No Bonus</font>";
										}
										else
										{
											if($datetime <= $now)
											{
												echo '<img src="../img/admin/del.gif">';
												echo "<font color=\"red\"> No Bonus</font>";
											}
											else
											{
												$tsdiffact = $datetime - $now;
												$timetoecho = $timeformat->getTimeFormat($tsdiffact);
												echo '<img src="../gpack/travian_default/img/new/tick.png" title="Ends: '.date('d.m.Y H:i',$user['b2']+3600*2).'">';
												echo "<font color=\"blue\"> $timetoecho</font>";
											}
										}
									/*
										if(date('d.m.Y H:i',$user['b2']) == '01.01.1970 00:00')
										{
											echo "Not enabled!</tr></th>";
										}
										else
										{
											echo "".date('d.m.Y H:i',$user['b2']+3600*2)."</tr></th>";
										} */
									?>
								 <a href="admin.php?p=editPlus&uid=<?php echo $user['id']; ?>"><img src="../img/admin/edit.gif" title="Edit Plus and Bonus"></a></td>
							</tr>
							<tr>
								<th><img src="../img/admin/r/3.gif"> Bonus</th>
								<td>
									<?php
										$datetime = $user['b3'];
										$now = time();
										if($datetime ==0)
										{
											echo '<img src="../img/admin/del.gif">';
											echo "<font color=\"red\"> No Bonus</font>";
										}
										else
										{
											if($datetime <= $now)
											{
												echo '<img src="../img/admin/del.gif">';
												echo "<font color=\"red\"> No Bonus</font>";
											}
											else
											{
												$tsdiffact = $datetime - $now;
												$timetoecho = $timeformat->getTimeFormat($tsdiffact);
												echo '<img src="../gpack/travian_default/img/new/tick.png" title="Ends: '.date('d.m.Y H:i',$user['b3']+3600*2).'">';
												echo "<font color=\"blue\"> $timetoecho</font>";
											}
										}
									/*
										if(date('d.m.Y H:i',$user['b3']) == '01.01.1970 00:00')
										{
											echo "Not enabled!</tr></th>";
										}
										else
										{
											echo "".date('d.m.Y H:i',$user['b3']+3600*2)."</tr></th>";
										} */
									?>
								 <a href="admin.php?p=editPlus&uid=<?php echo $user['id']; ?>"><img src="../img/admin/edit.gif" title="Edit Plus and Bonus"></a></td>
							</tr>
							<tr>
								<th><img src="../img/admin/r/4.gif"> Bonus</th>
								<td>
									<?php
										$datetime = $user['b4'];
										$now = time();
										if($datetime ==0)
										{
											echo '<img src="../img/admin/del.gif">';
											echo "<font color=\"red\"> No Bonus</font>";
										}
										else
										{
											if($datetime <= $now)
											{
												echo '<img src="../img/admin/del.gif">';
												echo "<font color=\"red\"> No Bonus</font>";
											}
											else
											{
												$tsdiffact = $datetime - $now;
												$timetoecho = $timeformat->getTimeFormat($tsdiffact);
												echo '<img src="../gpack/travian_default/img/new/tick.png" title="Ends: '.date('d.m.Y H:i',$user['b4']+3600*2).'">';
												echo "<font color=\"blue\"> $timetoecho</font>";
											}
										}
									/*
										if(date('d.m.Y H:i',$user['b4']) == '01.01.1970 00:00')
										{
											echo "Not enabled!</tr></th>";
										}
										else
										{
											echo "".date('d.m.Y H:i',$user['b4']+3600*2)."</tr></th>";
										} */
									?>
								 <a href="admin.php?p=editPlus&uid=<?php echo $user['id']; ?>"><img src="../img/admin/edit.gif" title="Edit Plus and Bonus"></a></td>
							</tr>