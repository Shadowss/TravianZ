<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : editPlus.tpl                                              ##
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

$id = (int)($_GET['uid']?? 0);
$uid = $id;
if($id){
?>
<style>
.plus-wrap{max-width:900px;margin:0 auto;font-family:Verdana,Arial;}
.plus-head{background:linear-gradient(135deg,#66CCFF,#66CCCC);color:#fff;border-radius:6px;padding:16px 20px;margin-bottom:14px;display:flex;justify-content:space-between;align-items:center;}
.plus-head h2{margin:0;font-size:20px;}.plus-head h2 a{color:#fff;}
.card{background:#fff;border:1px solid #e5e7eb;border-radius:6px;margin-bottom:14px;box-shadow:0 1px 3px rgba(0,0,0,.05);}
.card h3{margin:0;padding:10px 14px;background:#f9fafb;border-bottom:1px solid #e5e7eb;font-size:13px;text-transform:uppercase;color:#374151;}
.card.body{padding:14px;}
.info-box{background:#fffbeb;border:1px solid #fde68a;border-radius:4px;padding:10px;font-size:12px;color:#92400e;margin-bottom:12px;}

/* NOU: grid frumos pentru bonusuri active */
.active-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:10px;}
.active-item{background:#f8fafc;border:1px solid #e2e8f0;border-radius:6px;padding:10px;text-align:center;}
.active-item.name{font-size:12px;font-weight:600;color:#334155;margin-bottom:4px;}
.active-item.time{font-size:13px;font-weight:bold;color:#0f172a;}
.active-item.icon{font-size:20px;margin-bottom:4px;}
.active-item.plus{border-color:#fbbf24;background:#fffbeb;}
.active-item.wood{border-color:#16a34a;background:#f0fdf4;}
.active-item.clay{border-color:#ea580c;background:#fff7ed;}
.active-item.iron{border-color:#64748b;background:#f8fafc;}
.active-item.crop{border-color:#eab308;background:#fefce8;}
.active-item.none{opacity:.5;}

.bonus-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:12px;}
.bonus-item{background:#f8fafc;border:1px solid #e2e8f0;border-radius:6px;padding:12px;text-align:center;transition:.2s;}
.bonus-item.icon{font-size:26px;}
.bonus-item input{width:70px;text-align:center;padding:5px;margin-top:6px;border:1px solid #cbd5e1;border-radius:4px;font-weight:bold;}
.bonus-item input:focus{border-color:#f59e0b;outline:none;box-shadow:0 0 0 2px rgba(245,158,11,.2);}

/* BUTOANE CA LA HERO */
.actions{display:flex;justify-content:space-between;align-items:center;margin-top:18px;padding-top:14px;border-top:1px solid #e5e7eb;}
.btn-back{background:#f3f4f6;border:1px solid #d1d5db;color:#16a34a;padding:9px 18px;border-radius:5px;font-size:13px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:6px;}
.btn-back:hover{background:#e5e7eb;}
.btn-save{background:linear-gradient(#22c55e,#16a34a);border:1px solid #15803d;color:#fff;padding:9px 20px;border-radius:5px;font-size:13px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:6px;box-shadow:0 1px 2px rgba(0,0,0,.1);}
.btn-save:hover{filter:brightness(1.05);}
</style>

<div class="plus-wrap">
    <div class="plus-head">
        <h2>⭐ Plus & Bonuses: <a href="admin.php?p=player&uid=<?php echo $user['id'];?>"><?php echo htmlspecialchars($user['username']);?></a></h2>
        <div>UID: <?php echo $uid;?></div>
    </div>

    <form action="../GameEngine/Admin/Mods/editPlus.php" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="admid" value="<?php echo $_SESSION['id'];?>">
        <input type="hidden" name="uid" value="<?php echo $uid;?>">
        <input type="hidden" name="id" value="<?php echo $id;?>">

        <div class="info-box">ℹ️ The values ​​add up. Put 5 to add 5 days, -5 to remove 5 days.</div>

        <div class="card">
            <h3>📊 Current Active Bonuses</h3>
            <div class="body">
                <div class="active-grid">
                <?php
                // Citim datele direct din DB ca să nu mai depindem de playerplusbonus.tpl urât
                $p = $database->getUserField($uid, 'plus', 0);
                $b = [
                    'plus' => ['Plus','⭐',$p],
                    'b1' => ['Wood','🌲',$database->getUserField($uid,'b1',0)],
                    'b2' => ['Clay','🧱',$database->getUserField($uid,'b2',0)],
                    'b3' => ['Iron','⛏️',$database->getUserField($uid,'b3',0)],
                    'b4' => ['Crop','🌾',$database->getUserField($uid,'b4',0)],
                ];
                foreach($b as $k=>$v){
                    $end = (int)$v[2];
                    $left = $end - time();
                    $cls = strtolower($v[0]);
                    if($left > 0){
                        $d = floor($left/86400); $h = floor(($left%86400)/3600); $m = floor(($left%3600)/60);
                        echo "<div class='active-item $cls'><div class='icon'>{$v[1]}</div><div class='name'>{$v[0]}</div><div class='time'>{$d}d {$h}h {$m}m</div></div>";
                    } else {
                        echo "<div class='active-item $cls none'><div class='icon'>{$v[1]}</div><div class='name'>{$v[0]}</div><div class='time'>—</div></div>";
                    }
                }
               ?>
                </div>
            </div>
        </div>

        <div class="card">
            <h3>➕ Add / Remove Days</h3>
            <div class="body">
                <div class="bonus-grid">
                    <?php $items=['plus'=>['⭐','Travian Plus'],'wood'=>['🌲','+25% Wood'],'clay'=>['🧱','+25% Clay'],'iron'=>['⛏️','+25% Iron'],'crop'=>['🌾','+25% Crop']];
                    foreach($items as $k=>$v){ echo "<div class='bonus-item'><div class='icon'>{$v[0]}</div><div>{$v[1]}</div><input type='number' name='$k' value='0'><div style='font-size:11px;color:#666'>days</div></div>"; }?>
                </div>
            </div>
        </div>

                <div class="actions">
            <a href="admin.php?p=player&uid=<?php echo $uid;?>" class="btn-back">← Back</a>
            <button type="submit" class="btn-save">💾 Apply Bonuses</button>
        </div>
    </form>
</div>
<?php } else { include("404.tpl"); }?>