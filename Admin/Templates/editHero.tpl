<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : editHero.tpl         	                                   ##
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
if(isset($_GET['uid'])){
    $id = (int)$_GET['uid'];
    $hid = (int)$_GET['hid'];
    include_once("../GameEngine/Data/hero_full.php");
    include_once("../GameEngine/Units.php");
    $heroes = $units->Hero($id,1);

    foreach ($heroes as $hdata) {
        if ($hdata['heroid'] == $hid) { $hero = $hdata; break; }
    }

    $unarray = array(1=>U1,U2,U3,U4,U5,U6,U7,U8,U9,U10,U11,U12,U13,U14,U15,U16,U17,U18,U19,U20,U21,U22,U23,U24,U25,U26,U27,U28,U29,U30,U31,U32,U33,U34,U35,U36,U37,U38,U39,U40,U41,U42,U43,U44,U45,U46,U47,U48,U49,U50,U99,U0);
    $utribe = ($user['tribe']-1)*10;
?>
<style>
.hero-wrap{max-width:1000px;margin:20px auto;font-family:Verdana,Arial;}
.hero-head{background:linear-gradient(#2c3e50,#1a2530);color:#fff;border-radius:6px;padding:16px 20px;margin-bottom:14px;display:flex;align-items:center;justify-content:space-between;}
.hero-head.left{display:flex;align-items:center;gap:12px;}
.hero-head.avatar{width:48px;height:48px;border-radius:50%;background:#fff2;display:flex;align-items:center;justify-content:center;font-size:24px;}
.hero-head h2{margin:0;font-size:20px;}
.hero-head.lvl{background:#71D000;color:#000;padding:3px 8px;border-radius:12px;font-size:12px;font-weight:bold;margin-left:8px;}

.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
@media(max-width:850px){.grid-2{grid-template-columns:1fr;}}

.card{background:#fff;border:1px solid #d8d8d8;border-radius:6px;overflow:hidden;box-shadow:0 2px 4px rgba(0,0,0,.05);}
.card h3{margin:0;padding:10px 14px;background:#f5f7fa;border-bottom:1px solid #e5e7eb;font-size:13px;text-transform:uppercase;color:#374151;letter-spacing:.5px;}
.card.body{padding:14px;}

.form-row{display:flex;align-items:center;margin-bottom:12px;gap:10px;}
.form-row label{width:130px;font-size:12px;color:#374151;font-weight:600;}
.form-row.field{flex:1;}
.form-row input[type=text],.form-row select{width:100%;padding:7px 9px;border:1px solid #cbd5e1;border-radius:4px;font-size:13px;}
.form-row input:focus, select:focus{border-color:#71D000;outline:none;box-shadow:0 0 0 2px rgba(113,208,0,.2);}

.stat-table{width:100%;border-collapse:separate;border-spacing:0 6px;}
.stat-table th{background:#f9fafb;padding:8px;font-size:11px;text-transform:uppercase;color:#6b7280;text-align:left;border-bottom:1px solid #e5e7eb;}
.stat-table td{background:#fff;padding:10px;border-top:1px solid #f1f5f9;border-bottom:1px solid #f1f5f9;vertical-align:middle;}
.stat-table td:first-child{border-left:1px solid #f1f5f9;border-radius:6px 0 0 6px;font-weight:600;color:#1f2937;}
.stat-table td:last-child{border-right:1px solid #f1f5f9;border-radius:0 6px 6px 0;text-align:center;}

.ctrl{display:flex;align-items:center;justify-content:center;gap:8px;}
.btn-step{width:28px;height:28px;border-radius:50%;border:1px solid #d1d5db;background:#fff;cursor:pointer;font-weight:bold;font-size:16px;line-height:1;display:flex;align-items:center;justify-content:center;transition:.15s;}
.btn-step:hover{background:#71D000;color:#fff;border-color:#71D000;}
.btn-step:disabled{opacity:.4;cursor:not-allowed;}
.val-box{min-width:36px;text-align:center;font-weight:bold;font-size:15px;color:#111;}

.unit-preview{display:flex;align-items:center;gap:8px;padding:6px 10px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:4px;}

.actions{display:flex;justify-content:space-between;margin-top:18px;}
.btn{padding:9px 20px;border-radius:5px;font-size:13px;font-weight:600;cursor:pointer;border:1px solid;text-decoration:none;}
.btn-save{background:linear-gradient(#22c55e,#16a34a);border-color:#15803d;color:#fff;}
.btn-back{background:#f3f4f6;border-color:#d1d5db;color:#374151;}
</style>
<script>
function changeValue(u,c) {
    var objv=document.getElementById(c);
    var objd=document.getElementById(c+'2');
    var obje=document.getElementById('exp1');
    var n=parseInt(objv.value)||0;
    var l=parseInt(document.frmHero.hlvl.value)||0;
    var e=parseInt(document.frmHero.exp.value)||0;
    var v=n;
    if(u==0){ v = n<5?0:n-5; if(l>0 && n>=5) l--; else if(v==0 && l==0){ obje.innerHTML='5'; document.frmHero.exp.value='5'; } }
    if(u==1){ v = n>95?100:n+5; if(e!=0){ obje.innerHTML='0'; document.frmHero.exp.value='0'; } else if(l<99) l++; }

    document.getElementById(c+'0').innerHTML = v>0? "<button type='button' class='btn-step' onclick=\"return changeValue(0,'"+c+"')\">−</button>" : "<button type='button' class='btn-step' disabled>−</button>";
    document.getElementById(c+'1').innerHTML = v<99? "<button type='button' class='btn-step' onclick=\"return changeValue(1,'"+c+"')\">+</button>" : "<button type='button' class='btn-step' disabled>+</button>";

    document.getElementById("hlvl").innerHTML=l;
    objd.innerHTML=v;
    objv.value=v;
    document.frmHero.hlvl.value=l;
    return false;
}
function check_unit(el){
    var uname=el.options[el.selectedIndex].text;
    document.getElementById("unt").innerHTML="<img class=\"unit u"+el.value+"\" src=\"img/x.gif\" alt=\""+uname+"\" title=\""+uname+"\" />";
}
function go_url(url){ location=url; return false; }
</script>

<div class="hero-wrap">
    <div class="hero-head">
        <div class="left">
            <div class="avatar">🦸</div>
            <div>
                <h2><?php echo htmlspecialchars($hero['name']);?> <span class="lvl">Lv <?php echo $hero['level'];?></span></h2>
                <div style="font-size:12px;opacity:.8;">Player: <a href="admin.php?p=player&uid=<?php echo $id;?>" style="color:#9ae6b4;"><?php echo htmlspecialchars($user['username']);?></a></div>
            </div>
        </div>
        <div><img class="unit u<?php echo $hero['unit'];?>" src="img/x.gif" alt=""></div>
    </div>

<form name="frmHero" action="../GameEngine/Admin/Mods/editHero.php" method="POST">
    <input type="hidden" name="admid" value="<?php echo $_SESSION['id'];?>">
    <input type="hidden" name="id" value="<?php echo $id;?>" />
    <input type="hidden" name="hid" value="<?php echo $hid;?>" />
    <input name="hlvl" type="hidden" value="0">

    <div class="grid-2">
        <div class="card">
            <h3>📝 Basic Info</h3>
            <div class="body">
                <div class="form-row"><label>Hero Name</label><div class="field"><input name="hname" type="text" value="<?php echo htmlspecialchars($hero['name']);?>"></div></div>
                <div class="form-row"><label>Hero Unit</label><div class="field">
                    <div class="unit-preview"><span id="unt"><img class="unit u<?php echo $hero['unit'];?>" src="img/x.gif"></span>
                    <select name="hunit" onchange="check_unit(this)" style="flex:1;border:none;background:transparent;">
                        <?php for($i=1;$i<7;$i++){ if(($i==3&&$user['tribe']==4)||($i==4&&$user['tribe']!=3))continue; $v=$utribe+$i; echo "<option value='$v'".($hero['unit']==$v?' selected':'').">".$unarray[$v]."</option>"; }?>
                    </select></div>
                </div></div>
                <div class="form-row"><label>❤️ Health</label><div class="field"><input name="hhealth" type="text" value="<?php echo round($hero['health']);?>" style="width:80px;"> %</div></div>
                <div class="form-row"><label>✨ Experience</label><div class="field"><b><span id="exp1">5</span>%</b> <input id="exp" name="exp" type="hidden" value="5"></div></div>
            </div>
        </div>

        <div class="card">
            <h3>📈 Current Stats</h3>
            <div class="body" style="font-size:12px;line-height:1.8;">
                <div>Level: <b><?php echo $hero['level'];?></b> | Points: <b><?php echo $hero['atk']+$hero['di']+$hero['dc'];?></b></div>
                <div>Offence: <b><?php echo $hero['atk'];?></b> (Lv <?php echo $hero['attack'];?>)</div>
                <div>Defence: <b><?php echo $hero['di']."/".$hero['dc'];?></b> (Lv <?php echo $hero['defence'];?>)</div>
                <div>Off-Bonus: <b><?php echo ($hero['ob']-1)*100;?>%</b> | Def-Bonus: <b><?php echo ($hero['db']-1)*100;?>%</b></div>
                <div>Regen: <b><?php echo $hero['regeneration']*5*SPEED;?>/day</b></div>
            </div>
        </div>
    </div>

    <div class="card">
        <h3>⚔️ Add Points</h3>
        <div class="body">
            <table class="stat-table">
                <thead><tr><th>Attribute</th><th style="width:80px;text-align:center;">Current</th><th style="width:120px;text-align:center;">Add</th><th style="width:60px;text-align:center;">New</th></tr></thead>
                <tbody>
                <?php $attrs=[['hatk','Offence',$hero['attack']],['hdef','Defence',$hero['defence']],['hob','Off-Bonus',$hero['attackbonus']],['hdb','Def-Bonus',$hero['defencebonus']],['hrege','Regeneration',$hero['regeneration']]];
                foreach($attrs as $a){ echo '<tr><td>'.$a[1].'</td><td style="text-align:center;">'.$a[2].'</td><td><div class="ctrl"><span id="'.$a[0].'0"><button type="button" class="btn-step" disabled>−</button></span><div class="val-box" id="'.$a[0].'2">0</div><span id="'.$a[0].'1"><button type="button" class="btn-step" onclick="return changeValue(1,\''.$a[0].'\')">+</button></span></div></td><td><input id="'.$a[0].'" name="'.$a[0].'" type="hidden" value="0"><span id="'.$a[0].'2v">0</span></td></tr>'; }?>
                </tbody>
            </table>
            <div style="text-align:center;margin-top:10px;font-size:12px;">Level nou: <b><span id="hlvl">0</span></b></div>
        </div>
    </div>

    <div class="actions">
        <a href="admin.php?p=player&uid=<?php echo $id;?>" class="btn btn-back" onclick="return go_url(this.href)">← Back</a>
        <button type="submit" class="btn btn-save">💾 Save Hero</button>
    </div>
</form>
</div>
<?php
}
if(isset($_GET['e'])){ echo '<div style="text-align:center;color:red;margin-top:10px;"><b>Please fill hero name</b></div>'; }
?>