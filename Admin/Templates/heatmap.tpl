<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : heatmap.tpl                                               ##
##  Type           : Admin Panel Frontend for heatmap              	           ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Shadow 		                                           ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

if (!isset($_SESSION['access']) || $_SESSION['access'] < MULTIHUNTER) {
    echo '<p style="color:#f87171;padding:16px;">Access denied.</p>';
    return;
}

$res  = isset($_GET['res'])  && ctype_digit((string)$_GET['res'])  ? (int)$_GET['res']  : Heatmap::DEFAULT_RES;
$days = isset($_GET['days']) && ctype_digit((string)$_GET['days']) ? (int)$_GET['days'] : Heatmap::DEFAULT_INACTIVE_DAYS;

$data       = Heatmap::grid(['res' => $res, 'inactive_days' => $days]);
$tribeNames = Heatmap::tribeNames();

// Compact payload for the client: [cx,cy,villages,inactive,attacks,pop,dom,x0,y0,x1,y1]
$payload = [];
foreach ($data['cells'] as $c) {
    $payload[] = [$c['cx'], $c['cy'], $c['villages'], $c['inactive'], $c['attacks'], $c['pop'], $c['dom'], $c['x0'], $c['y0'], $c['x1'], $c['y1']];
}
$js = [
    'res'   => $data['res'],
    'max'   => $data['max'],
    'cells' => $payload,
    'tribeNames' => $tribeNames,
];
?>
<style>
.hm-wrap{color:#e2e8f0;font-family:Verdana,Arial,sans-serif;font-size:12px;padding:6px 4px 26px;}
.hm-wrap h2{font-size:18px;margin:0 0 4px;color:#fff;}
.hm-wrap h2 span{color:#f59e0b;}
.hm-intro{color:#94a3b8;font-size:11px;margin:0 0 14px;max-width:860px;line-height:1.5;}
.hm-filter{background:#111827;border:1px solid #1f2937;border-radius:8px;padding:12px 14px;display:flex;flex-wrap:wrap;gap:14px;align-items:flex-end;margin-bottom:14px;}
.hm-filter label{display:block;font-size:10px;text-transform:uppercase;letter-spacing:.6px;color:#94a3b8;margin-bottom:4px;}
.hm-filter input{background:#0b1220;border:1px solid #334155;border-radius:6px;color:#e2e8f0;padding:6px 8px;width:90px;}
.hm-filter button{background:#f59e0b;color:#111827;font-weight:bold;border:0;border-radius:6px;padding:8px 16px;cursor:pointer;}
.hm-layers{display:flex;gap:8px;margin-bottom:12px;flex-wrap:wrap;}
.hm-layers button{background:#1e293b;color:#cbd5e1;border:1px solid #334155;border-radius:6px;padding:8px 16px;cursor:pointer;font-size:12px;}
.hm-layers button.active{background:#f59e0b;color:#111827;border-color:#f59e0b;font-weight:bold;}
.hm-stage{display:block;}
.hm-map{position:relative;background:#0b1220;border:1px solid #1f2937;border-radius:8px;padding:8px;text-align:center;}
.hm-map svg{display:inline-block;background:#0a0f1c;border-radius:4px;width:100%;height:auto;max-width:600px;}
.hm-below{display:flex;gap:14px;align-items:flex-start;margin-top:14px;}
.hm-below .hm-card{flex:1 1 0;min-width:0;margin-bottom:0;}
.hm-tip{position:absolute;pointer-events:none;background:#0b1220;border:1px solid #475569;border-radius:6px;padding:7px 9px;font-size:11px;color:#e2e8f0;display:none;z-index:10;white-space:nowrap;box-shadow:0 4px 14px rgba(0,0,0,.5);}
.hm-side{flex:0 0 186px;min-width:0;}
.hm-card{background:#111827;border:1px solid #1f2937;border-radius:8px;padding:12px 14px;margin-bottom:14px;}
.hm-card h3{margin:0 0 8px;font-size:12px;color:#fff;text-transform:uppercase;letter-spacing:.5px;}
.hm-stat{display:flex;justify-content:space-between;padding:3px 0;color:#cbd5e1;}
.hm-stat b{color:#fff;}
.hm-legend{display:flex;flex-direction:column;gap:5px;}
.hm-legend .row{display:flex;align-items:center;gap:8px;font-size:11px;color:#cbd5e1;}
.hm-legend .sw{width:16px;height:12px;border-radius:3px;display:inline-block;}
.hm-scale{height:12px;border-radius:3px;margin:4px 0;}
.hm-note{color:#64748b;font-size:10px;margin-top:6px;line-height:1.4;}
.tribebar{display:flex;height:16px;border-radius:4px;overflow:hidden;margin-top:6px;}
.tribebar span{display:block;height:100%;}
</style>

<div class="hm-wrap">
    <h2>World Map <span>Heatmap</span></h2>
    <p class="hm-intro">
        Density overlays on the world grid to help with starting balance: where villages
        cluster, which tribes dominate a region, where inactive players sit (dead zones /
        good spawn spots), and where attacks are currently landing. North (+y) is up.
    </p>

    <form method="get" action="admin.php" class="hm-filter">
        <input type="hidden" name="p" value="heatmap">
        <div>
            <label>Grid resolution</label>
            <input type="number" name="res" min="<?php echo Heatmap::MIN_RES; ?>" max="<?php echo Heatmap::MAX_RES; ?>" value="<?php echo (int)$data['res']; ?>">
        </div>
        <div>
            <label>Inactive after (days)</label>
            <input type="number" name="days" min="1" max="365" value="<?php echo (int)$data['inactive_days']; ?>">
        </div>
        <button type="submit">Rebuild</button>
    </form>

    <div class="hm-layers">
        <button data-layer="density" class="active">Village density</button>
        <button data-layer="tribe">Tribe density</button>
        <button data-layer="inactive">Inactivity</button>
        <button data-layer="attacks">Attacks</button>
    </div>

    <div class="hm-stage">
        <div class="hm-map">
            <svg id="hm-svg" viewBox="0 0 600 600" preserveAspectRatio="xMidYMid meet"></svg>
            <div class="hm-tip" id="hm-tip"></div>
        </div>

        <div class="hm-below">
            <div class="hm-card">
                <h3>Summary</h3>
                <div class="hm-stat"><span>Player villages</span><b><?php echo number_format($data['totals']['villages']); ?></b></div>
                <div class="hm-stat"><span>Players</span><b><?php echo number_format($data['totals']['players']); ?></b></div>
                <div class="hm-stat"><span>Inactive villages</span><b><?php echo number_format($data['totals']['inactive']); ?></b></div>
                <div class="hm-stat"><span>Attacks in flight</span><b><?php echo number_format($data['totals']['attacks']); ?></b></div>
                <div class="hm-note">Map <?php echo (int)$data['world_max']; ?>&times;<?php echo (int)$data['world_max']; ?> radius, <?php echo (int)$data['res']; ?>&times;<?php echo (int)$data['res']; ?> grid (&asymp;<?php echo (int)round($data['cell_span']); ?> tiles/cell).</div>
            </div>

            <div class="hm-card">
                <h3 id="hm-legend-title">Legend</h3>
                <div class="hm-legend" id="hm-legend"></div>
            </div>

            <div class="hm-card">
                <h3>Tribe totals</h3>
                <?php
                $tt = $data['tribe_totals'];
                $sum = array_sum($tt);
                $tribeColors = [1=>'#dc2626',2=>'#2563eb',3=>'#16a34a',6=>'#a16207',7=>'#d97706',8=>'#7c3aed',9=>'#0891b2'];
                if ($sum > 0):
                ?>
                    <div class="tribebar">
                        <?php foreach ($tt as $t => $n): if ($n<=0) continue; ?>
                            <span style="width:<?php echo round($n/$sum*100,2); ?>%;background:<?php echo $tribeColors[$t]??'#64748b'; ?>;" title="<?php echo e(($tribeNames[$t]??('Tribe '.$t)).': '.$n); ?>"></span>
                        <?php endforeach; ?>
                    </div>
                    <?php foreach ($tt as $t => $n): if ($n<=0) continue; ?>
                        <div class="hm-stat"><span><span class="sw" style="background:<?php echo $tribeColors[$t]??'#64748b'; ?>;display:inline-block;width:10px;height:10px;border-radius:2px;margin-right:6px;"></span><?php echo e($tribeNames[$t]??('Tribe '.$t)); ?></span><b><?php echo number_format($n); ?></b></div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="hm-note">No player villages found.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
(function(){
    var HM = <?php echo json_encode($js); ?>;
    var SIZE = 600, res = HM.res, px = SIZE / res;
    var svg = document.getElementById('hm-svg');
    var tip = document.getElementById('hm-tip');
    var legend = document.getElementById('hm-legend');
    var legendTitle = document.getElementById('hm-legend-title');
    var SVGNS = 'http://www.w3.org/2000/svg';
    var layer = 'density';

    var tribeColors = {1:'#dc2626',2:'#2563eb',3:'#16a34a',6:'#a16207',7:'#d97706',8:'#7c3aed',9:'#0891b2'};

    // Idx map: cx,cy -> cell array. cell = [cx,cy,vil,inact,atk,pop,dom,x0,y0,x1,y1]
    var rects = [];
    function mix(a,b,t){ // hex lerp
        function h(x){return parseInt(x,16);}
        var ar=h(a.substr(1,2)),ag=h(a.substr(3,2)),ab=h(a.substr(5,2));
        var br=h(b.substr(1,2)),bg=h(b.substr(3,2)),bb=h(b.substr(5,2));
        var r=Math.round(ar+(br-ar)*t),g=Math.round(ag+(bg-ag)*t),bl=Math.round(ab+(bb-ab)*t);
        return 'rgb('+r+','+g+','+bl+')';
    }
    function colorFor(cell){
        var v=cell[2],inact=cell[3],atk=cell[4],dom=cell[6];
        if(layer==='density'){
            if(v<=0) return null;
            var t=HM.max.villages? v/HM.max.villages:0;
            return mix('#1e293b','#f97316',Math.pow(t,0.6));
        }
        if(layer==='inactive'){
            if(inact<=0) return null;
            var t=HM.max.inactive? inact/HM.max.inactive:0;
            return mix('#1e293b','#a855f7',Math.pow(t,0.6));
        }
        if(layer==='attacks'){
            if(atk<=0) return null;
            var t=HM.max.attacks? atk/HM.max.attacks:0;
            return mix('#1e293b','#ef4444',Math.pow(t,0.5));
        }
        if(layer==='tribe'){
            if(!dom||v<=0) return null;
            var base=tribeColors[dom]||'#64748b';
            var t=HM.max.villages? v/HM.max.villages:0;
            return mix('#111827',base,0.35+0.65*Math.pow(t,0.5));
        }
        return null;
    }

    // build rects once
    HM.cells.forEach(function(cell){
        var r=document.createElementNS(SVGNS,'rect');
        r.setAttribute('x',cell[0]*px);
        r.setAttribute('y',cell[1]*px);
        r.setAttribute('width',Math.ceil(px));
        r.setAttribute('height',Math.ceil(px));
        r.setAttribute('shape-rendering','crispEdges');
        r.style.cursor='crosshair';
        r._cell=cell;
        r.addEventListener('mousemove',function(e){ showTip(e,cell); });
        r.addEventListener('mouseleave',function(){ tip.style.display='none'; });
        svg.appendChild(r);
        rects.push(r);
    });

    function showTip(e,cell){
        var names=HM.tribeNames||{};
        var domName = cell[6]? (names[cell[6]]||('Tribe '+cell[6])) : '-';
        tip.innerHTML =
            '<b>x '+cell[7]+'..'+cell[9]+' , y '+cell[8]+'..'+cell[10]+'</b><br>'+
            'villages: '+cell[2]+' &nbsp; pop: '+cell[5].toLocaleString()+'<br>'+
            'inactive: '+cell[3]+' &nbsp; attacks: '+cell[4]+'<br>'+
            'dominant: '+domName;
        var host=svg.parentNode.getBoundingClientRect();
        tip.style.left=(e.clientX-host.left+12)+'px';
        tip.style.top=(e.clientY-host.top+12)+'px';
        tip.style.display='block';
    }

    function paint(){
        rects.forEach(function(r){
            var c=colorFor(r._cell);
            if(c===null){ r.setAttribute('fill','#0a0f1c'); r.setAttribute('fill-opacity','0'); }
            else { r.setAttribute('fill',c); r.setAttribute('fill-opacity','1'); }
        });
        drawLegend();
    }

    function drawLegend(){
        var titles={density:'Village density',tribe:'Tribe density',inactive:'Inactivity',attacks:'Attacks'};
        legendTitle.textContent=titles[layer]||'Legend';
        if(layer==='tribe'){
            var html=''; var names=HM.tribeNames||{};
            Object.keys(tribeColors).forEach(function(t){
                if(names[t]) html+='<div class="row"><span class="sw" style="background:'+tribeColors[t]+'"></span>'+names[t]+'</div>';
            });
            legend.innerHTML=html+'<div class="hm-note">Cell shows the dominant tribe; brighter = more villages.</div>';
            return;
        }
        var grad={density:['#1e293b','#f97316'],inactive:['#1e293b','#a855f7'],attacks:['#1e293b','#ef4444']}[layer];
        var maxKey={density:'villages',inactive:'inactive',attacks:'attacks'}[layer];
        var mx=HM.max[maxKey]||0;
        legend.innerHTML=
            '<div class="hm-scale" style="background:linear-gradient(90deg,'+grad[0]+','+grad[1]+')"></div>'+
            '<div class="row"><span>0</span><span style="margin-left:auto">'+mx+'</span></div>'+
            '<div class="hm-note">Darker/brighter cells = higher count in that region.</div>';
    }

    var btns=document.querySelectorAll('.hm-layers button');
    btns.forEach(function(b){
        b.addEventListener('click',function(){
            btns.forEach(function(x){x.classList.remove('active');});
            b.classList.add('active');
            layer=b.getAttribute('data-layer');
            paint();
        });
    });

    paint();
})();
</script>
