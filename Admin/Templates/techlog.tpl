<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : techlog.tpl 		                                       ##
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

$id = (int)($_GET['did'] ?? 0);
if(!$id){ include("404.tpl"); return; }

$logs = $database->query("SELECT * FROM ".TB_PREFIX."tech_log WHERE wid = $id ORDER BY id DESC LIMIT 200");
?>
<style>
.back-btn{display:inline-flex;align-items:center;gap:6px;background:#fff;border:1px solid #e5e7eb;padding:8px 14px;border-radius:8px;color:#334155;text-decoration:none;font-size:13px;font-weight:500;margin-bottom:12px;box-shadow:0 1px 2px rgba(0,0,0,.05)}
.back-btn:hover{background:#f8fafc}
.tlog-wrap{max-width:900px;margin:20px auto;font-family:system-ui}
.tlog-head{background:linear-gradient(135deg,#1e3a8a,#3b82f6);color:#fff;padding:16px 20px;border-radius:12px 12px 0 0;display:flex;align-items:center;gap:12px}
.tlog-head .icon{width:36px;height:36px;background:#ffffff20;border-radius:8px;display:grid;place-items:center;font-size:20px}
.tlog-head h2{margin:0;font-size:18px;font-weight:600}
.tlog-head span{opacity:.8;font-size:13px}
.tlog-card{background:#fff;border:1px solid #e5e7eb;border-radius:0 0 12px 12px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,.05)}
.tlog-table{width:100%;border-collapse:collapse}
.tlog-table th{background:#f8fafc;color:#64748b;font-size:12px;text-transform:uppercase;letter-spacing:.5px;padding:12px 16px;text-align:left;border-bottom:1px solid #e5e7eb}
.tlog-table td{padding:14px 16px;border-bottom:1px solid #f1f5f9;font-size:14px;color:#334155}
.tlog-table tr:hover td{background:#f0f7ff}
.tlog-table tr:last-child td{border-bottom:0}
.badge{display:inline-block;padding:3px 8px;border-radius:6px;font-size:11px;font-weight:600;margin-right:6px}
.badge-research{background:#dbeafe;color:#1e40af}
.badge-academy{background:#fef3c7;color:#92400e}
.badge-complete{background:#dcfce7;color:#166534}
.tlog-num{width:50px;color:#94a3b8;font-variant-numeric:tabular-nums}
.tlog-date{white-space:nowrap;color:#64748b;font-size:13px;width:160px}
.empty{padding:40px;text-align:center;color:#94a3b8}
</style>

<div class="tlog-wrap">
    <a href="admin.php?p=village&did=<?php echo $id; ?>" class="back-btn">← Back to Village</a>
    
    <div class="tlog-head">
        <div class="icon">🔬</div>
        <div>
            <h2><?php echo htmlspecialchars($village['name']); ?> <span style="opacity:.7">— Research Log</span></h2>
            <span>Latest 200 searches</span>
        </div>
    </div>
    
    <div class="tlog-card">
        <?php if(mysqli_num_rows($logs) == 0): ?>
            <div class="empty">No registered searches.</div>
        <?php else: ?>
        <table class="tlog-table">
            <thead>
                <tr>
                    <th class="tlog-num">#</th>
                    <th>Event</th>
                    <th class="tlog-date">Data</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $i = mysqli_num_rows($logs);
            while($row = mysqli_fetch_assoc($logs)):
                $log = htmlspecialchars($row['log']);
                $badge = 'badge-research';
                if(stripos($log,'academy')!==false) $badge='badge-academy';
                if(stripos($log,'completed')!==false || stripos($log,'finished')!==false) $badge='badge-complete';
                $date = date('d.m.Y H:i', strtotime($row['date']));
            ?>
                <tr>
                    <td class="tlog-num"><?php echo $i--; ?></td>
                    <td><span class="badge <?php echo $badge; ?>">TECH</span> <?php echo $log; ?></td>
                    <td class="tlog-date"><?php echo $date; ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>