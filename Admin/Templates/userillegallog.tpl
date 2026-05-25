<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : userillegallog.tpl 		                               ##
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
.illegal-wrap{max-width:900px;margin:0 auto;font-family:Verdana,Arial;}
.illegal-head{background:linear-gradient(135deg,#b91c1c,#7f1d1d);color:#fff;border-radius:6px;padding:14px 18px;margin-bottom:12px;display:flex;justify-content:space-between;align-items:center;}
.illegal-head h2{margin:0;font-size:17px;}
.illegal-head h2 a{color:#fff;text-decoration:none;}
.illegal-head .uid{font-size:12px;opacity:.85;}

.card{background:#fff;border:1px solid #e5e7eb;border-radius:6px;box-shadow:0 1px 3px rgba(0,0,0,.05);overflow:hidden;}
.card h3{margin:0;padding:10px 14px;background:#fef2f2;border-bottom:1px solid #fecaca;font-size:12px;text-transform:uppercase;color:#991b1b;display:flex;justify-content:space-between;align-items:center;}
.badge{background:#fee2e2;color:#b91c1c;padding:2px 8px;border-radius:12px;font-size:11px;font-weight:600;}

.illegal-table{width:100%;border-collapse:collapse;font-size:13px;}
.illegal-table thead{background:#fff1f2;}
.illegal-table th{padding:8px 10px;text-align:left;font-size:11px;text-transform:uppercase;color:#991b1b;font-weight:600;border-bottom:1px solid #fecaca;}
.illegal-table td{padding:10px;border-bottom:1px solid #fef2f2;vertical-align:top;}
.illegal-table tr:hover{background:#fffafa;}
.illegal-table td:nth-child(1){width:50px;color:#6b7280;text-align:center;font-weight:600;}
.illegal-table td:nth-child(2){width:70px;font-family:monospace;color:#6b7280;}
.illegal-table td:nth-child(3){font-family:monospace;font-size:12px;color:#1f2937;word-break:break-word;}

.empty{padding:40px;text-align:center;color:#16a34a;font-size:14px;}
.empty .icon{font-size:32px;margin-bottom:8px;}

.actions{margin-top:14px;text-align:left;}
.btn-back{background:#f3f4f6;border:1px solid #d1d5db;color:#16a34a;padding:8px 16px;border-radius:5px;font-size:13px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:6px;}
.btn-back:hover{background:#e5e7eb;}
</style>

<div class="illegal-wrap">
    <div class="illegal-head">
        <h2>🚨 Illegals Log: <a href="admin.php?p=player&uid=<?php echo $player['id'];?>"><?php echo htmlspecialchars($player['username']);?></a></h2>
        <div class="uid">UID: <?php echo $id; ?></div>
    </div>

    <div class="card">
        <h3>
            <span>Detected Offences</span>
            <?php
            $count = mysqli_num_rows(mysqli_query($GLOBALS["link"], "SELECT id FROM ".TB_PREFIX."illegal_log WHERE user = $id"));
            echo '<span class="badge">'.$count.' records</span>';
            ?>
        </h3>
        <?php
        $sql = "SELECT * FROM ".TB_PREFIX."illegal_log WHERE user = $id ORDER BY id DESC LIMIT 200";
        $result = mysqli_query($GLOBALS["link"], $sql);
        if(mysqli_num_rows($result) > 0){
        ?>
        <table class="illegal-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            while($row = mysqli_fetch_assoc($result)){
                $i++;
                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.htmlspecialchars($row['log']).'</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
        <?php } else { 
            echo '<div class="empty"><div class="icon">✅</div><div>No illegal activities recorded.<br><span style="font-size:12px;color:#6b7280;">Player is clean</span></div></div>'; 
        } ?>
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