<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : users.tpl 		                                           ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki (Original)                                          ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2025. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
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
        case 6: return array('Huns','🐎','#a16207');
        case 7: return array('Egyptians','🏺','#d97706');
        case 8: return array('Spartans','🛡','#7c3aed');
        case 9: return array('Vikings','🪓','#0891b2');
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
.users-wrap{max-width:100%;margin:8px 0;font-family:Tahoma,Verdana,Arial,sans-serif;color:#e2e8f0}
.users-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px}
.users-head h2{margin:0;font-size:15px;display:flex;align-items:center;gap:6px;color:#f1f5f9}
.users-filters{display:flex;gap:5px;margin-bottom:6px;flex-wrap:wrap}
.users-filters a{padding:3px 10px;font-size:10px;border:1px solid #334155;border-radius:12px;text-decoration:none;color:#cbd5e1;background:#111827;line-height:15px}
.users-filters a:hover{border-color:#f59e0b;color:#fde68a}
.users-filters a.active{background:#f59e0b;color:#1a1a2e;border-color:#f59e0b;font-weight:bold}
.search-box{margin-bottom:6px}
.search-box input{width:200px;padding:5px 8px;border:1px solid #334155;border-radius:5px;font-size:11px;background:#0b1220;color:#e2e8f0}

.table-wrap{overflow-x:auto;border:1px solid #1f2937;border-radius:8px;background:#0b1220}
.users-table{width:100%;border-collapse:collapse;border-spacing:0;font-size:11px;table-layout:fixed}
.users-table thead th{background:#111827;color:#94a3b8;padding:6px 5px;text-align:left;white-space:nowrap;font-weight:bold;border-bottom:1px solid #1f2937;font-size:9px;text-transform:uppercase;letter-spacing:.3px}
.users-table tbody td{padding:4px 5px;border-bottom:1px solid #14203a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;line-height:18px;color:#cbd5e1}
.users-table tbody tr:hover td{background:#0f1a30}
.users-table a{color:#7dd3fc;text-decoration:none}
.users-table a:hover{text-decoration:underline;color:#bae6fd}

/* LATIMI MINIME */
.users-table th:nth-child(1),.users-table td:nth-child(1){width:34px;text-align:center}
.users-table th:nth-child(2),.users-table td:nth-child(2){width:90px}
.users-table th:nth-child(3),.users-table td:nth-child(3){width:130px}
.users-table th:nth-child(4),.users-table td:nth-child(4){width:50px;text-align:center}
.users-table th:nth-child(5),.users-table td:nth-child(5){width:52px;text-align:center;padding:2px}
.users-table th:nth-child(6),.users-table td:nth-child(6){width:44px;text-align:right;padding-right:6px}
.users-table th:nth-child(7),.users-table td:nth-child(7){width:78px;text-align:center}

.badge{display:inline-block;padding:1px 5px;border-radius:3px;color:#fff;font-size:9px;line-height:13px;font-weight:bold}
.gold{color:#fde68a;font-weight:bold}
.last{color:#64748b;font-size:10px}
.email-cell a{color:#7dd3fc}

/* TRIBE CU NUME SUB ICON */
.tribe-box{display:flex;flex-direction:column;align-items:center;gap:2px;line-height:1}
.tribe-icon{display:inline-block;width:18px;height:16px;line-height:16px;text-align:center;border-radius:3px;color:#fff;font-size:11px}
.tribe-name{font-size:8px;color:#94a3b8;text-transform:uppercase;letter-spacing:.2px}

.pagination{display:flex;justify-content:center;align-items:center;gap:5px;margin-top:10px;font-size:10px}
.pagination a{padding:3px 8px;background:#111827;border:1px solid #334155;border-radius:4px;text-decoration:none;color:#cbd5e1}
.pagination a:hover{border-color:#f59e0b;color:#fde68a}
.pagination .current{padding:3px 8px;background:#f59e0b;color:#1a1a2e;border-radius:4px;font-weight:bold}
</style>

<div class="users-wrap">
  <div class="users-head">
    <h2>👥 Users</h2>
    <div style="font-size:11px;color:#94a3b8"><?php echo number_format($totalUsers);?> found</div>
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