
<style>
.msg-card{background:#fff;border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;font-family:system-ui}
.msg-table{width:100%;border-collapse:collapse}
.msg-table thead th{background:#0f172a;color:#fff;padding:8px 10px;font-size:12px;font-weight:600;text-align:left}
.msg-table thead th.sent{text-align:right}
.msg-table thead a{color:#93c5fd;text-decoration:none}
.msg-table thead a:hover{text-decoration:underline}
.msg-table tbody td{padding:9px 10px;font-size:13px;border-bottom:1px solid #f1f5f9;vertical-align:middle}
.msg-table tbody tr:hover{background:#f8fafc}
.msg-table tbody tr.sup td{background:#fef3c7}
.msg-table tbody tr.multihunterMsg td{background:#fff7ed}
.msg-table tbody tr.multihunterMsg td.sel{background:orange!important;color:#fff}
.msg-table.top a{color:#0f172a;text-decoration:none;font-weight:500}
.msg-table.top a:hover{color:#2563eb;text-decoration:underline}
.msg-table.send a{color:#334155;text-decoration:none}
.msg-table.send a:hover{text-decoration:underline}
.msg-table.dat{font-family:monospace;font-size:12px;color:#64748b;text-align:right;white-space:nowrap}
.msg-table.none{padding:20px;text-align:center;color:#94a3b8}
.msg-foot{display:flex;justify-content:space-between;align-items:center;padding:8px 12px;background:#f8fafc;border-top:1px solid #e5e7eb}
.msg-foot.navi a{padding:4px 8px;margin:0 2px;background:#fff;border:1px solid #d1d5db;border-radius:4px;color:#374151;text-decoration:none;font-size:12px}
.msg-foot.navi a:hover{background:#f3f4f6}
</style>

<div class="msg-card">
<table class="msg-table" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th colspan="2">Subject</th>
			<th>Sender</th>
			<th class="sent"><a href="nachrichten.php?o=1">Sent</a></th>
		</tr>
	</thead>
	<tbody>
<?php
$s = $_GET['s']?? 0;
for ($i = 1+$s; $i <= 10+$s; $i++) {
    if (count($allMessages) >= $i) {
        $m = $allMessages[$i-1];
        $cls = $m['owner']<=1? 'sup' : ($m['owner']==5? 'multihunterMsg' : '');
        echo "<tr class=\"$cls\">";
        echo "<td class=\"top\" colspan=\"2\"><a href=\"admin.php?p=msg&nid={$m['id']}\">".htmlspecialchars($m['topic'])."</a></td>";
        $date = $generator->procMtime($m['time']);
        $uname = $database->getUserField($m['owner'],'username',0);
        $link = ($m['owner']!=2 && $m['owner']!=4);
        echo "<td class=\"send\">".($link?"<a href=\"admin.php?p=player&uid={$m['owner']}\">":"<b>").htmlspecialchars($uname).($link?"</a>":"</b>")."</td>";
        echo "<td class=\"dat\">{$date[0]} {$date[1]}</td></tr>";
    }
}
if (count($allMessages)==0) echo "<tr><td colspan=\"4\" class=\"none\">There are no messages available.</td></tr>";
?>
	</tbody>
</table>
<div class="msg-foot">
  <div></div>
  <div class="navi"><?php
if (!isset($_GET['s']) && count($allMessages)<10) echo "&laquo;&raquo;";
elseif (!isset($_GET['s']) && count($allMessages)>10) echo "&laquo;<a href=\"?p=msg&".(!empty($_GET['t'])?'t='.$_GET['t'].'&amp;':'')."s=10&o=".($_GET['o']??0)."\">&raquo;</a>";
elseif (isset($_GET['s']) && count($allMessages)>$_GET['s']) {
    if (count($allMessages)>($_GET['s']+10) && $_GET['s']!=0) echo "<a href=\"?p=msg&".(!empty($_GET['t'])?'t='.$_GET['t'].'&amp;':'')."s=".($_GET['s']-10)."&o=0\">&laquo;</a><a href=\"?p=msg&".(!empty($_GET['t'])?'t='.$_GET['t'].'&amp;':'')."s=".($_GET['s']+10)."&o=0\">&raquo;</a>";
    elseif (count($allMessages)>$_GET['s']+10) echo "&laquo;<a href=\"?p=msg&".(!empty($_GET['t'])?'t='.$_GET['t'].'&amp;':'')."s=".($_GET['s']+10)."&o=0\">&raquo;</a>";
    else echo "<a href=\"?p=msg&".(!empty($_GET['t'])?'t='.$_GET['t'].'&amp;':'')."s=".($_GET['s']-10)."&o=0\">&laquo;</a>&raquo;";
}
?></div>
</div>
</div>