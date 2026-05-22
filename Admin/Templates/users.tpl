<?php
#################################################################################
## users.tpl - REDESIGN 2025 v3 (ultra-compact + tribe label) ##
#################################################################################
if($_SESSION['access'] < MULTIHUNTER) die("Access Denied!");

$filter = $_GET['filter']??'all';
$page = max(1, (int)($_GET['upage']??1));
$perPage = 20;
$offset = ($page - 1) * $perPage;

$where = "1=1";
if($filter=='admins') $where = "access >= 8";
elseif($filter=='normal') $where = "access = 2";
elseif($filter=='banned') $where = "access = 0";
elseif($filter=='online') $where = "timestamp > ".(time()-900);

$totalRes = mysqli_query($GLOBALS['link'], "SELECT COUNT(*) AS cnt FROM ".TB_PREFIX."users WHERE $where");
$totalUsers = (int)(mysqli_fetch_assoc($totalRes)['cnt']??0);
$totalPages = max(1, (int)ceil($totalUsers / $perPage));
if($page>$totalPages){$page=$totalPages;$offset=($page-1)*$perPage;}

$result = mysqli_query($GLOBALS['link'], "
    SELECT id, username, email, access, tribe, gold, timestamp
    FROM ".TB_PREFIX."users
    WHERE $where
    ORDER BY id DESC
    LIMIT $perPage OFFSET $offset
");

function tribeLabel($t){
    $t = (int)$t;
    switch($t){
        case 1: return array('Roman','🏛','#c0392b');
        case 2: return array('Teuton','🪓','#7f8c8d');
        case 3: return array('Gaul','🌾','#27ae60');
        case 4: return array('Nature','🌲','#16a085');
        case 5: return array('Natars','👑','#8e44ad');
        default: return array('N/A','❓','#95a5a6');
    }
}
function accessBadge($a){
    $a = (int)$a;
    if($a == 9) return array('Admin','#c0392b');
    if($a == 8) return array('MH','#e67e22');
    if($a == 2) return array('Normal','#3498db'); 
    if($a == 0) return array('Banned','#7f8c8d');
    return array('Lvl '.$a,'#95a5a6');
}
function shortEmail($e){if(!$e)return '-';if(strlen($e)>22)return substr($e,0,19).'...';return $e;}
?>
<style>
.users-wrap{max-width:100%;margin:8px 0;font-family:Tahoma,Verdana,Arial,sans-serif}
.users-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:6px}
.users-head h2{margin:0;font-size:14px;display:flex;align-items:center;gap:4px}
.users-filters{display:flex;gap:3px;margin-bottom:4px}
.users-filters a{padding:2px 7px;font-size:10px;border:1px solid #bbb;border-radius:10px;text-decoration:none;color:#333;background:#f5f5f5;line-height:14px}
.users-filters a.active{background:#2c3e50;color:#fff;border-color:#2c3e50}
.search-box{margin-bottom:4px}
.search-box input{width:180px;padding:3px 5px;border:1px solid #aaa;border-radius:3px;font-size:11px}

.table-wrap{overflow-x:auto;border:1px solid #bbb;background:#fff}
.users-table{width:100%;border-collapse:collapse;border-spacing:0;font-size:11px;table-layout:fixed}
.users-table thead th{background:#3a4f63;color:#fff;padding:2px 3px;text-align:left;white-space:nowrap;font-weight:bold;border-right:1px solid #2c3e50;font-size:10px}
.users-table thead th:last-child{border-right:0}
.users-table tbody td{padding:1px 3px;border-bottom:1px solid #e5e5e5;border-right:1px solid #f0f0f0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;line-height:16px}
.users-table tbody td:last-child{border-right:0}
.users-table tbody tr:hover{background:#eef4ff}
.users-table a{color:#004a9f;text-decoration:none}
.users-table a:hover{text-decoration:underline}

/* LATIMI MINIME */
.users-table th:nth-child(1),.users-table td:nth-child(1){width:32px;text-align:center}
.users-table th:nth-child(2),.users-table td:nth-child(2){width:85px}
.users-table th:nth-child(3),.users-table td:nth-child(3){width:125px}
.users-table th:nth-child(4),.users-table td:nth-child(4){width:48px;text-align:center}
.users-table th:nth-child(5),.users-table td:nth-child(5){width:42px;text-align:center;padding:1px 2px}
.users-table th:nth-child(6),.users-table td:nth-child(6){width:32px;text-align:right;padding-right:4px}
.users-table th:nth-child(7),.users-table td:nth-child(7){width:72px;text-align:center}

.badge{display:inline-block;padding:0 3px;border-radius:2px;color:#fff;font-size:9px;line-height:12px;font-weight:normal}
.gold{color:#8b6914;font-weight:normal}
.last{color:#444;font-size:10px}
.email-cell a{color:#004a9f}

/* TRIBE CU NUME SUB ICON */
.tribe-box{display:flex;flex-direction:column;align-items:center;gap:1px;line-height:1}
.tribe-icon{display:inline-block;width:16px;height:14px;line-height:14px;text-align:center;border-radius:2px;color:#fff;font-size:10px}
.tribe-name{font-size:8px;color:#888;text-transform:uppercase;letter-spacing:0.2px}

.pagination{display:flex;justify-content:center;align-items:center;gap:4px;margin-top:6px;font-size:10px}
.pagination a{padding:2px 5px;background:#f5f5f5;border:1px solid #bbb;border-radius:2px;text-decoration:none;color:#333}
.pagination.current{padding:2px 5px;background:#3a4f63;color:#fff;border-radius:2px}
</style>

<div class="users-wrap">
  <div class="users-head">
    <h2>👥 Users</h2>
    <div style="font-size:11px;color:#666"><?php echo number_format($totalUsers);?> found</div>
  </div>

<div class="users-filters">
  <a href="?p=users&filter=all" class="<?php echo $filter=='all'?'active':'';?>">All</a>
  <a href="?p=users&filter=admins" class="<?php echo $filter=='admins'?'active':'';?>">Admins</a>
  <a href="?p=users&filter=normal" class="<?php echo $filter=='normal'?'active':'';?>">Normal</a>
  <a href="?p=users&filter=banned" class="<?php echo $filter=='banned'?'active':'';?>">Banned</a>
  <a href="?p=users&filter=online" class="<?php echo $filter=='online'?'active':'';?>">Online</a>
</div>

  <div class="search-box"><input type="text" id="userSearch" placeholder="Search..." onkeyup="filterUsers()"></div>

  <div class="table-wrap">
    <table class="users-table" id="usersTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>Access</th>
          <th>Tribe</th>
          <th>Gold</th>
          <th>Last Activity</th>
        </tr>
      </thead>
      <tbody>
        <?php while($r=mysqli_fetch_assoc($result)){
            $t=tribeLabel($r['tribe']); $a=accessBadge($r['access']);
            $last = $r['timestamp']? date('d.m H:i',$r['timestamp']) : '-';
            $isOnline = $r['timestamp'] && $r['timestamp'] > time()-900;
            $emailTitle = htmlspecialchars($r['email']??'');
     ?>
        <tr>
          <td>#<?php echo (int)$r['id'];?></td>
          <td><a href="?p=player&uid=<?php echo (int)$r['id'];?>" title="<?php echo htmlspecialchars($r['username']).($emailTitle?' | '.$emailTitle:'');?>"><?php echo htmlspecialchars($r['username']);?></a><?php if($isOnline)echo ' <span style="color:#27ae60">●</span>';?></td>
          <td class="email-cell" title="<?php echo $emailTitle;?>"><?php echo $r['email']? '<a href="mailto:'.htmlspecialchars($r['email']).'">'.shortEmail($r['email']).'</a>' : '-';?></td>
          <td><span class="badge" style="background:<?php echo $a[1];?>"><?php echo $a[0];?></span></td>
          <td>
            <div class="tribe-box">
              <span class="tribe-icon" style="background:<?php echo $t[2];?>"><?php echo $t[1];?></span>
              <span class="tribe-name"><?php echo $t[0];?></span>
            </div>
          </td>
          <td class="gold"><?php echo (int)$r['gold'];?></td>
          <td class="last"><?php echo $last;?></td>
        </tr>
        <?php }?>
      </tbody>
    </table>
  </div>

  <div class="pagination">
    <?php if($page>1){?><a href="?p=users&filter=<?php echo $filter;?>&upage=<?php echo $page-1;?>">« Prev</a><?php }?>
    <span class="current"><?php echo $page;?> / <?php echo $totalPages;?></span>
    <?php if($page<$totalPages){?><a href="?p=users&filter=<?php echo $filter;?>&upage=<?php echo $page+1;?>">Next »</a><?php }?>
  </div>
</div>

<script>
function filterUsers(){
  var q=document.getElementById('userSearch').value.toLowerCase();
  var rows=document.querySelectorAll('#usersTable tbody tr');
  for(var i=0;i<rows.length;i++){
    rows[i].style.display = rows[i].innerText.toLowerCase().indexOf(q)>-1? '':'none';
  }
}
</script>