<style>
#member{width:100%;border-collapse:separate;border-spacing:0;background:#fff;border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04);margin-top:10px;font-family:system-ui}
#member thead th{background:linear-gradient(135deg,#0f172a,#1e293b) !important;color:#fff;padding:6px 10px;font-weight:600;text-align:left;font-size:13px;position:relative}
#member thead th .edit-icon{float:right;display:inline-flex;opacity:.85;transition:.15s}
#member thead th .edit-icon:hover{opacity:1}
#member thead th .edit-icon svg{width:14px;height:14px;stroke:#93c5fd;stroke-width:2;fill:none;stroke-linecap:round;stroke-linejoin:round}
#member thead th .edit-icon:hover svg{stroke:#fff}
#member tbody td{padding:3px 8px;border-bottom:1px solid #f1f5f9;font-size:12px;color:#334155;vertical-align:middle;line-height:1.2}
#member tbody tr:last-child td{border-bottom:0}
#member tbody tr:hover td{background:#f8fafc}
#member td:first-child{width:35%;color:#64748b;font-weight:500}

.badge{display:inline-block;padding:1px 6px;border-radius:5px;font-size:10.5px;font-weight:600;line-height:1.1}
.badge-banned{background:#fee2e2;color:#991b1b}
.badge-user{background:#e2e8f0;color:#334155}
.badge-mh{background:#fef3c7;color:#92400e}
.badge-admin{background:#dbeafe;color:#1e40af;font-weight:700}
.badge-on{background:#dcfce7;color:#166534}
.badge-off{background:#f1f5f9;color:#64748b}

.gold-val{display:flex;align-items:center;gap:5px;font-weight:600;color:#b45309}
.gold-val img{width:14px;height:14px}

.status-icon{display:inline-flex;vertical-align:middle;margin-right:4px}
.status-icon svg{width:14px;height:14px;stroke-width:2;fill:none;stroke-linecap:round;stroke-linejoin:round}
.status-ok svg{stroke:#16a34a}
.status-no svg{stroke:#dc2626}
</style>

<table id="member">
	<thead>
		<tr>
			<th colspan="2">Additional Information 
				<a href='admin.php?p=editAdditional&uid=<?php echo $id; ?>' class="edit-icon" title="Edit Player Additional Info">
					<svg viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
				</a>
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Access</td>
			<td>
				<?php
				if($user['access'] == 0) echo '<span class="badge badge-banned">Banned</span>';
				else if($user['access'] == 2) echo '<span class="badge badge-user">Normal user</span>';
				else if($user['access'] == 8) echo '<span class="badge badge-mh">Multihunter</span>';
				else if($user['access'] == 9) echo '<span class="badge badge-admin">Administrator</span>';
				?>
			</td>
		</tr>
		<tr>
			<td>Vacation Mode</td>
			<td><?php echo $user['vac_mode'] ? '<span class="badge badge-on">Enabled</span>' : '<span class="badge badge-off">Disabled</span>'; ?></td>
		</tr>
		<tr>
			<td>Gold</td>
			<td><span class="gold-val"><img src="../img/admin/gold.gif"> <?php echo $user['gold']; ?></span></td>
		</tr>
		<tr>
			<td>Sitter 1</td>
			<td><?php echo $user['sit1'] >= 1 ? '<a href="admin.php?p=player&uid='.$user['sit1'].'">'.$database->getUserField($user['sit1'],"username",0).'</a>' : '<span style="color:#94a3b8">No Sitter</span>'; ?></td>
		</tr>
		<tr>
			<td>Sitter 2</td>
			<td><?php echo $user['sit2'] >= 1 ? '<a href="admin.php?p=player&uid='.$user['sit2'].'">'.$database->getUserField($user['sit2'],"username",0).'</a>' : '<span style="color:#94a3b8">No Sitter</span>'; ?></td>
		</tr>
		<tr>
			<td>Beginners Protection</td>
			<td>
				<?php
				$datetime = $user['protect']; $now = time();
				if($datetime==0 || $datetime <= $now){
					echo '<span class="status-icon status-no"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M15 9l-6 6M9 9l6 6"/></svg></span> <span style="color:#dc2626;font-weight:600">No Protection</span>';
				}else{
					$tsdiffact = $datetime - $now;
					$timetoecho = \App\Utils\DateTime::getTimeFormat($tsdiffact);
					echo '<span class="status-icon status-ok" title="Ends: '.date('d.m.Y H:i',$user['protect']+3600*2).'"><svg viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg></span> <span style="color:#2563eb;font-weight:600">'.$timetoecho.'</span>';
				}
				?>
			</td>
		</tr>
		<tr><td>Culture Points</td><td><?php echo number_format($user['cp'],0,',','.');?></td></tr>
		<tr><td>Last Activity</td><td><?php echo date('d.m.Y H:i',$user['timestamp']+3600*2);?></td></tr>
		<tr><td>Attack Points (This Week)</td><td><?php echo $user['ap'];?></td></tr>
		<tr><td>Defence Points (This Week)</td><td><?php echo $user['dp'];?></td></tr>
		<tr><td>Resources Raided (This Week)</td><td><?php echo number_format($user['RR'],0,',','.');?></td></tr>
		<tr><td>Total Attack Points</td><td><b><?php echo number_format($user['apall'],0,',','.');?></b></td></tr>
		<tr><td>Total Defence Points</td><td><b><?php echo number_format($user['dpall'],0,',','.');?></b></td></tr>
	</tbody>
</table>