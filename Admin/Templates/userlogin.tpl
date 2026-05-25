<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : userlogin.tpl 		                                       ##
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

$id = (int)($_GET['uid'] ?? 0);
if($id){
    $player = $database->getUserArray($id,1);
?>
<style>
.log-wrap{max-width:800px;margin:0 auto;font-family:Verdana,Arial;}
.log-head{background:linear-gradient(135deg,#1e40af,#1e3a8a);color:#fff;border-radius:6px;padding:14px 18px;margin-bottom:12px;display:flex;justify-content:space-between;align-items:center;}
.log-head h2{margin:0;font-size:17px;}
.log-head h2 a{color:#fff;text-decoration:none;}
.log-head .uid{font-size:12px;opacity:.85;}

.card{background:#fff;border:1px solid #e5e7eb;border-radius:6px;box-shadow:0 1px 3px rgba(0,0,0,.05);overflow:hidden;}
.card h3{margin:0;padding:10px 14px;background:#f9fafb;border-bottom:1px solid #e5e7eb;font-size:12px;text-transform:uppercase;color:#374151;display:flex;justify-content:space-between;align-items:center;}
.badge{background:#dbeafe;color:#1e40af;padding:2px 8px;border-radius:12px;font-size:11px;font-weight:600;}

.log-table{width:100%;border-collapse:collapse;font-size:13px;}
.log-table thead{background:#f3f4f6;}
.log-table th{padding:8px 10px;text-align:left;font-size:11px;text-transform:uppercase;color:#6b7280;font-weight:600;border-bottom:1px solid #e5e7eb;}
.log-table td{padding:9px 10px;border-bottom:1px solid #f1f5f9;}
.log-table tr:hover{background:#f9fafb;}
.log-table td:nth-child(1){width:60px;color:#6b7280;}
.log-table td:nth-child(2){width:80px;font-family:monospace;}
.ip-link{color:#2563eb;text-decoration:none;font-family:monospace;font-weight:600;}
.ip-link:hover{text-decoration:underline;}
.empty{padding:30px;text-align:center;color:#9ca3af;font-size:13px;}

.actions{margin-top:14px;text-align:left;}
.btn-back{background:#f3f4f6;border:1px solid #d1d5db;color:#16a34a;padding:8px 16px;border-radius:5px;font-size:13px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:6px;}
.btn-back:hover{background:#e5e7eb;}
</style>

<div class="log-wrap">
    <div class="log-head">
        <h2>🔐 Login Log: <a href="admin.php?p=player&uid=<?php echo $player['id'];?>"><?php echo htmlspecialchars($player['username']);?></a></h2>
        <div class="uid">UID: <?php echo $id; ?></div>
    </div>

    <div class="card">
        <h3>
            <span>Recent Login Attempts</span>
            <?php
            $count = mysqli_num_rows(mysqli_query($GLOBALS["link"], "SELECT id FROM ".TB_PREFIX."login_log WHERE uid = $id"));
            echo '<span class="badge">'.$count.' total</span>';
            ?>
        </h3>
        <?php
        $sql = "SELECT * FROM ".TB_PREFIX."login_log WHERE uid = $id ORDER BY id DESC LIMIT 100";
        $result = mysqli_query($GLOBALS["link"], $sql);
        if(mysqli_num_rows($result) > 0){
        ?>
        <table class="log-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Log ID</th>
                    <th>IP Address</th>
                    <th>Info</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            while($row = mysqli_fetch_assoc($result)){
                $i++;
                $ip = htmlspecialchars($row['ip']);
                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td><a class="ip-link" href="https://ipinfo.io/'.$ip.'" target="_blank">'.$ip.'</a></td>';
                echo '<td><span style="color:#9ca3af;font-size:11px;">—</span></td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
        <?php } else { echo '<div class="empty">No login records found.</div>'; } ?>
    </div>

    <div class="actions">
        <a href="admin.php?p=player&uid=<?php echo $id;?>" class="btn-back">← Back to player</a>
    </div>
</div>
<?php
} else {
    include("404.tpl");
}
?>