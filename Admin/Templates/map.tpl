<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : map.tpl 		                          			       ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : ronix (Original)                                          ##
##  Refactored by  : iopietro                                                  ##
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

// ----------------- PHP (logic unchanged, except $pixelDiv = 255) -----------------
$check1 = $check2 = $check3 = "";
$includeSize = true;
$criteria = "";

if (isset($_POST['show1']) || isset($_POST['show2']) || isset($_POST['show3'])) {
    $check1 = isset($_POST['show1']) ? "checked " : "";
    $check2 = isset($_POST['show2']) ? "checked " : "";
    $check3 = isset($_POST['show3']) ? "checked " : "";
 
    if($check1 != "" && $check2 == "" && $check3 == "") {
        $criteria = " WHERE u.tribe <> 5";
        $includeSize = false;
    }
    elseif($check1 == "" && $check2 != "" && $check3 == "") {
        $criteria = " WHERE u.tribe = 5 AND (v.capital = 1 OR v.natar = 1)";
        $includeSize = false;
    }
    elseif($check1 != "" && $check2 != "" && $check3 == "") {
        $criteria = " WHERE u.tribe <> 5 OR (u.tribe = 5 AND (v.capital = 1 OR v.natar = 1))";
        $includeSize = false;
    }
    elseif($check1 == "" && $check2 == "" && $check3 != "") {
        $criteria = " INNER JOIN ".TB_PREFIX."artefacts AS a ON a.vref = v.wref";
    }
    elseif($check1 != "" && $check2 == "" && $check3 != ""){
        $criteria = " LEFT JOIN ".TB_PREFIX."artefacts AS a ON a.vref = v.wref WHERE u.tribe <> 5 OR (u.tribe = 5 AND v.capital <> 1 AND v.natar <> 1)";
    }
    elseif($check1 == "" && $check2 != "" && $check3 != ""){
        $criteria = " LEFT JOIN ".TB_PREFIX."artefacts AS a ON a.vref = v.wref WHERE u.tribe = 5";
    }
    elseif($check1 != "" && $check2 != "" && $check3 != ""){
        $criteria = " LEFT JOIN ".TB_PREFIX."artefacts AS a ON a.vref = v.wref";
    }
}
if ($check1 == "" && $check2 == "" && $check3 == "") $criteria = "";
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo SERVER_NAME; ?> Map</title>
<style>
body{margin:0;background:#f1f5f9;font-family:system-ui,-apple-system,Segoe UI,Roboto;color:#0f172a}
.map-wrap{max-width:1200px;margin:16px auto;padding:0 12px}
.map-header{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:14px 18px;margin-bottom:14px;box-shadow:0 1px 3px rgba(0,0,0,.05)}
.map-header h2{margin:0 0 4px;font-size:20px;font-weight:800}
.map-header p{margin:0;color:#64748b;font-size:13px}
.map-filters{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:12px 16px;margin-bottom:14px;display:flex;align-items:center;gap:18px;flex-wrap:wrap}
.filter-group{display:flex;align-items:center;gap:8px}
.filter-group label{font-size:13px;font-weight:500;cursor:pointer}
.filter-group input{width:16px;height:16px;accent-color:#0f172a;cursor:pointer}
.btn-show{background:#0f172a;color:#fff;border:0;padding:7px 14px;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;transition:.2s}
.btn-show:hover{background:#1e293b;transform:translateY(-1px)}

.map-layout{display:grid;grid-template-columns:1fr 240px;gap:14px;align-items:start}
@media(max-width:900px){.map-layout{grid-template-columns:1fr}}

/* MAP CONTAINER - untouched logic */
#map {width:510px;height:510px;position:relative;overflow:hidden;border:1px solid #cbd5e1;background:#f8fafc;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.08)}
#map.grab{cursor:grab} #map.grabbing{cursor:grabbing}
#map_bg{position:absolute;inset:0;width:510px;height:510px;transform-origin:0 0;will-change:transform;transition:transform 80ms ease;--zoom:1}
#gridSvg{position:absolute;inset:0;pointer-events:none}
#gridSvg line{vector-effect:non-scaling-stroke;shape-rendering:crispEdges}
#gridSvg.minor{stroke:rgba(0,0,0,.08);stroke-width:1}
#gridSvg.major{stroke:rgba(0,0,0,.18);stroke-width:1}
.marker{position:absolute;transform:translate(-50%,-50%)}
#map_bg.pin{transform-origin:center;transform:scale(calc(1/var(--zoom)));cursor:pointer}

/* Zoom controls modern */
.zoom-controls{position:absolute;top:10px;right:10px;display:flex;gap:6px;align-items:center;z-index:1000;background:#fff;padding:6px 8px;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,.15);border:1px solid #e5e7eb}
.zoom-controls button{font-size:13px;padding:6px 9px;border-radius:6px;border:1px solid #e2e8f0;background:#f8fafc;cursor:pointer;font-weight:600;transition:.15s}
.zoom-controls button:hover{background:#e2e8f0}
.zoom-controls span{min-width:52px;text-align:center;font:12px system-ui;font-weight:600;color:#334155}

/* Axis */
.zoomlevels span{position:absolute;font:11px system-ui;color:#64748b;font-weight:600;background:rgba(255,255,255,.9);padding:2px 5px;border-radius:4px}
#zl{left:6px;top:50%;transform:translateY(-50%)} #zr{right:6px;top:50%;transform:translateY(-50%)}
#zo{right:50%;top:6px;transform:translateX(50%)} #zb{right:50%;bottom:6px;transform:translateX(50%)}
#zc{left:50%;top:50%;transform:translate(-50%,-50%)}
#lijn_hor,#lijn_ver{position:absolute;background:#94a3b8;opacity:.4}
#lijn_hor{left:0;right:0;top:50%;height:1px} #lijn_ver{top:0;bottom:0;left:50%;width:1px}

/* Legend cards */
.legend-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;margin-bottom:12px;box-shadow:0 1px 3px rgba(0,0,0,.05)}
.legend-head{background:#0f172a;color:#fff;padding:8px 12px;font-size:13px;font-weight:700}
.legend-body{padding:10px 12px}
.legend-body table{width:100%;border-collapse:collapse}
.legend-body td{padding:4px 0;font-size:12px}
.legend-body td:first-child{width:20px}
.legend-body img{width:11px;height:11px;display:block}

/* Tooltip */
.p_info{list-style:none;margin:0;padding:0}
.p_info li{margin:3px 0;font-size:12px}
.p_actions{margin-top:8px;display:flex;gap:6px}
.p_btn{display:inline-block;font:12px/1 system-ui;padding:5px 9px;border:1px solid #e2e8f0;border-radius:6px;background:#f8fafc;color:#0f172a;text-decoration:none;font-weight:500}
.p_btn:hover{background:#e2e8f0}
#tipBackdrop{position:absolute;inset:0;display:none;z-index:1099;background:transparent}
#stickyTip{position:absolute;z-index:1100;display:none;max-width:300px;background:#fff;border:1px solid #cbd5e1;border-radius:10px;box-shadow:0 8px 24px rgba(0,0,0,.18);padding:10px 12px}
.badge-tribe{display:inline-block;padding:1px 6px;border-radius:5px;font-size:10.5px;font-weight:600;background:#e2e8f0;color:#334155}
</style>
</head>
<body>

<div class="map-wrap">
  <div class="map-header">
    <h2><?php echo SERVER_NAME;?> Map</h2>
    <p>Interactive world map – search players, villages and artifacts</p>
  </div>

  <form id="show" action="admin.php?p=map" method="POST" class="map-filters">
    <div class="filter-group">
      <input id="show1" name="show1" type="checkbox" <?php echo $check1;?> value="1">
      <label for="show1">Players</label>
    </div>
    <div class="filter-group">
      <input id="show2" name="show2" type="checkbox" <?php echo $check2;?> value="2">
      <label for="show2"><?php echo TRIBE5;?></label>
    </div>
    <div class="filter-group">
      <input id="show3" name="show3" type="checkbox" <?php echo $check3;?> value="2">
      <label for="show3">Artifacts</label>
    </div>
    <button type="submit" class="btn-show">Apply Filters</button>
  </form>

  <div class="map-layout">
    <div>
      <div id="map" class="grab">
        <div class="zoom-controls">
          <button type="button" id="zoomOut">−</button>
          <span id="zoomLabel">100%</span>
          <button type="button" id="zoomIn">+</button>
          <button type="button" id="zoomReset">Reset</button>
        </div>
        <div class="zoomlevels">
          <span id="zl">-<?php echo WORLD_MAX;?></span>
          <span id="zr"><?php echo WORLD_MAX;?></span>
          <span id="zb"><?php echo WORLD_MAX;?></span>
          <span id="zo">-<?php echo WORLD_MAX;?></span>
          <span id="zc">(0,0)</span>
          <div id="lijn_hor"></div>
          <div id="lijn_ver"></div>
        </div>
        <div id="map_bg">
          <svg id="gridSvg" width="510" height="510" aria-hidden="true"></svg>
          <?php
          if ($criteria!= "") {
              $artifactsEffect = ['-', VILLAGE_EFFECT, ACCOUNT_EFFECT, UNIQUE_EFFECT];
              $array_tribe = ['-', TRIBE1, TRIBE2, TRIBE3, TRIBE4, TRIBE5, TRIBE6];
              $q = "SELECT v.wref, v.owner, v.name, v.capital, v.pop, u.username, u.tribe, u.access, w.x, w.y"
                  . ($includeSize? ", a.size" : "")
                  . " FROM ".TB_PREFIX."vdata AS v"
                  . " LEFT JOIN ".TB_PREFIX."users AS u ON v.owner = u.id"
                  . " LEFT JOIN ".TB_PREFIX."wdata AS w ON v.wref = w.id "
                  . $criteria;
              $player_info = $database->query_return($q);
              foreach ($player_info as $p_array) {
                $p_name = htmlspecialchars($p_array['username'], ENT_QUOTES);
                $p_village = htmlspecialchars($p_array['name'], ENT_QUOTES);
                $p_pop = (int)$p_array['pop'];
                $p_tribe = $array_tribe[$p_array['tribe']];
                $did = (int)$p_array['wref'];
                $uid = (int)$p_array['owner'];
                $x = (int)$p_array['x'];
                $y = (int)$p_array['y'];
                $imgName = "../img/admin/map_".(isset($p_array['size'])? "1".$p_array['size'] : ($p_array['access']!= ADMIN? $p_array['tribe'] : 0)).".gif";
                $pixelDiv = 255;
                $xdiv = $pixelDiv / WORLD_MAX;
                $p_x = $pixelDiv + ($x * $xdiv);
                $p_y = $pixelDiv - ($y * $xdiv);
                $tooltip = "<ul class='p_info'>";
                $tooltip.= "<li>Player: <b>{$p_name}</b></li>";
                $tooltip.= "<li>Village: <b>{$p_village}</b></li>";
                $tooltip.= "<li>Coord: <b>({$x}|{$y})</b></li>";
                $tooltip.= "<li>Pop: <b>{$p_pop}</b></li>";
                $tooltip.= "<li>Tribe: <b>{$p_tribe}</b></li>";
                if ($check3!= "" && isset($p_array['size'])) {
                    $tooltip.= "<li>Artifact: <b>".$artifactsEffect[$p_array['size']]."</b></li>";
                }
                $tooltip.= "</ul>";
                $tooltip.= "<div class='p_actions'>"
                        . "<a class='p_btn' href='?p=village&did={$did}' target='_blank'>Village</a>"
                        . "<a class='p_btn' href='?p=player&uid={$uid}' target='_blank'>Profile</a>"
                        . "</div>";
                $tooltipHover = str_replace(["\\", "'"], ["\\\\", "\\'"], $tooltip);
                $tooltipAttr = htmlspecialchars($tooltip, ENT_QUOTES);
                echo '<div class="marker" style="left:'.$p_x.'px; top:'.$p_y.'px;" data-tip="'.$tooltipAttr.'">'
                   . '<img class="pin" src="'.$imgName.'" border="0" '
                   . ' onmouseout="med_closeDescription()" '
                   . " onmousemove=\"med_mouseMoveHandler(arguments[0], '".$tooltipHover."')\" "
                   . '>'
                   . '</div>';
              }
}
         ?>
        </div>

        <div id="tipBackdrop"></div>
        <div id="stickyTip"></div>
      </div>

      <!-- LEGENDE MUTATE SUB HARTA -->
      <div class="legend-card" style="margin-top:14px; max-width:510px;">
        <div class="legend-head">Tribes</div>
        <div class="legend-body">
          <table>
            <tr><td><img src="../img/admin/map_1.gif"></td><td><?php echo TRIBE1;?></td></tr>
            <tr><td><img src="../img/admin/map_2.gif"></td><td><?php echo TRIBE2;?></td></tr>
            <tr><td><img src="../img/admin/map_3.gif"></td><td><?php echo TRIBE3;?></td></tr>
            <tr><td><img src="../img/admin/map_5.gif"></td><td><?php echo TRIBE5;?></td></tr>
            <tr><td><img src="../img/admin/map_0.gif"></td><td>Multihunters</td></tr>
          </table>
        </div>
      </div>
      <div class="legend-card" style="max-width:510px;">
        <div class="legend-head">Artifacts</div>
        <div class="legend-body">
          <table>
            <tr><td><img src="../img/admin/map_11.gif"></td><td><?php echo VILLAGE_EFFECT;?></td></tr>
            <tr><td><img src="../img/admin/map_12.gif"></td><td><?php echo ACCOUNT_EFFECT;?></td></tr>
            <tr><td><img src="../img/admin/map_13.gif"></td><td><?php echo UNIQUE_EFFECT;?></td></tr>
          </table>
        </div>
      </div>

    </div>

    <div>
      <!-- coloana dreapta acum goala -->
    </div>
  </div>
</div>

<!-- ===================== JS: crisp SVG grid + clamped pan + cursor zoom + sticky tooltip ===================== -->
<script>
(function () {
  const map   = document.getElementById('map');
  const layer = document.getElementById('map_bg');
  const grid  = document.getElementById('gridSvg');

  const zl = document.getElementById('zl');
  const zr = document.getElementById('zr');
  const zo = document.getElementById('zo');
  const zb = document.getElementById('zb');
  const zc = document.getElementById('zc');

  const zoomInBtn    = document.getElementById('zoomIn');
  const zoomOutBtn   = document.getElementById('zoomOut');
  const zoomResetBtn = document.getElementById('zoomReset');
  const zoomLabel    = document.getElementById('zoomLabel');

  const sticky = document.getElementById('stickyTip');
  const stickyBackdrop = document.getElementById('tipBackdrop');

  const WORLD_MAX = <?php echo json_encode(WORLD_MAX); ?>;

  // Base sizes (match CSS)
  const baseW = parseFloat(getComputedStyle(layer).getPropertyValue('--map-width'))  || 510;
  const baseH = parseFloat(getComputedStyle(layer).getPropertyValue('--map-height')) || 510;

  // World->pixel conversion (0,0 at center)
  const pixelDiv = baseW / 2;                 // 255
  const xdiv = pixelDiv / WORLD_MAX;          // px per world unit

  // Build SVG grid (even, crisp)
  function buildGrid() {
    const MAJOR_UNIT = 10;
    grid.setAttribute('viewBox', `0 0 ${baseW} ${baseH}`);
    grid.innerHTML = "";

    for (let x = -WORLD_MAX; x <= WORLD_MAX; x++) {
      const px = pixelDiv + x * xdiv;
      const v = document.createElementNS('http://www.w3.org/2000/svg','line');
      v.setAttribute('x1',px); v.setAttribute('y1',0);
      v.setAttribute('x2',px); v.setAttribute('y2',baseH);
      v.setAttribute('class', (x % MAJOR_UNIT === 0) ? 'major' : 'minor');
      grid.appendChild(v);
    }
    for (let y = -WORLD_MAX; y <= WORLD_MAX; y++) {
      const py = pixelDiv - y * xdiv;
      const h = document.createElementNS('http://www.w3.org/2000/svg','line');
      h.setAttribute('x1',0); h.setAttribute('y1',py);
      h.setAttribute('x2',baseW); h.setAttribute('y2',py);
      h.setAttribute('class', (y % MAJOR_UNIT === 0) ? 'major' : 'minor');
      grid.appendChild(h);
    }
  }
  buildGrid();

  // Zoom levels
  const STEP_SCALE = 1.25;
  const MAX_Z = 16;
  let MIN_Z = 0;
  function sFromLvl(lvl){ return Math.pow(STEP_SCALE, lvl); }

  // Clamp pan to avoid blank
  function clampPan() {
    const s = sFromLvl(zoomLevel);
    const scaledW = baseW * s;
    const scaledH = baseH * s;

    if (scaledW <= map.clientWidth) {
      tx = (map.clientWidth - scaledW) / 2;
    } else {
      const minTx = map.clientWidth - scaledW;
      tx = Math.max(minTx, Math.min(tx, 0));
    }

    if (scaledH <= map.clientHeight) {
      ty = (map.clientHeight - scaledH) / 2;
    } else {
      const minTy = map.clientHeight - scaledH;
      ty = Math.max(minTy, Math.min(ty, 0));
    }
  }

  function applyTransform(){
    clampPan();
    const s = sFromLvl(zoomLevel);
    layer.style.setProperty('--zoom', s);
    layer.style.transform = `translate(${tx}px, ${ty}px) scale(${s})`;
    zoomLabel.textContent = Math.round(s*100) + '%';
    updateAxes();
  }

  // Map-local px -> world coords
  function screenToWorld(localX, localY){
    const s = sFromLvl(zoomLevel);
    const lx = (localX - tx) / s;
    const ly = (localY - ty) / s;
    return { x: (lx - pixelDiv) / xdiv, y: (pixelDiv - ly) / xdiv };
  }

  function updateAxes(){
    const w=map.clientWidth, h=map.clientHeight;
    const left = screenToWorld(0,h/2).x, right = screenToWorld(w,h/2).x;
    const top  = screenToWorld(w/2,0).y, bottom = screenToWorld(w/2,h).y;
    const center = screenToWorld(w/2,h/2);
    zl.textContent=Math.round(left);  zr.textContent=Math.round(right);
    zo.textContent=Math.round(top);   zb.textContent=Math.round(bottom);
    zc.textContent=`(${Math.round(center.x)},${Math.round(center.y)})`;
  }

  function computeMinLevel(){
    const fit = Math.max(map.clientWidth / baseW, map.clientHeight / baseH);
    let lvl=0, s=1;
    if (fit >= 1) { while (s < fit) { s *= STEP_SCALE; lvl++; } }
    else { while (s / STEP_SCALE >= fit) { s /= STEP_SCALE; lvl--; } }
    MIN_Z = lvl;
  }

  function clampLevel(next){ return Math.min(MAX_Z, Math.max(MIN_Z, next)); }

  function toLocal(e){ const r = map.getBoundingClientRect(); return { x:e.clientX-r.left, y:e.clientY-r.top }; }

  // Zoom toward cursor
  function zoomAt(deltaLevel, localX, localY){
    const newLevel = clampLevel(zoomLevel + deltaLevel);
    if (newLevel === zoomLevel) return;
    const oldS = sFromLvl(zoomLevel), newS = sFromLvl(newLevel);
    const lx = (localX - tx) / oldS, ly = (localY - ty) / oldS;
    tx = localX - lx * newS; ty = localY - ly * newS;
    zoomLevel = newLevel; applyTransform();
  }
  function zoomBy(delta){ zoomAt(delta, map.clientWidth/2, map.clientHeight/2); }

  // State
  let zoomLevel = 0, tx = 0, ty = 0;

  // Controls
  zoomInBtn.addEventListener('click', ()=>zoomBy(+1));
  zoomOutBtn.addEventListener('click', ()=>zoomBy(-1));
  zoomResetBtn.addEventListener('click', ()=>{
    computeMinLevel(); zoomLevel = MIN_Z;
    const s = sFromLvl(zoomLevel);
    tx = (map.clientWidth  - baseW * s) / 2;
    ty = (map.clientHeight - baseH * s) / 2;
    applyTransform();
  });

  // Wheel / dblclick
  map.addEventListener('wheel', (e)=>{ e.preventDefault(); const p=toLocal(e); zoomAt(e.deltaY<0?+1:-1, p.x,p.y); }, {passive:false});
  map.addEventListener('dblclick', (e)=>{ e.preventDefault(); const p=toLocal(e); zoomAt(e.shiftKey?-1:+1, p.x,p.y); });

  // Drag pan
  let dragging=false, lastX=0, lastY=0;
  map.addEventListener('mousedown',(e)=>{ if(e.button!==0) return; dragging=true; map.classList.add('grabbing'); const p=toLocal(e); lastX=p.x; lastY=p.y; });
  window.addEventListener('mousemove',(e)=>{ if(!dragging) return; const p=toLocal(e); tx+=(p.x-lastX); ty+=(p.y-lastY); lastX=p.x; lastY=p.y; applyTransform(); });
  window.addEventListener('mouseup',()=>{ dragging=false; map.classList.remove('grabbing'); });
  map.addEventListener('mouseleave',()=>{ dragging=false; map.classList.remove('grabbing'); });

  // Touch
  map.addEventListener('touchstart',(e)=>{ if(e.touches.length===1){ const t=e.touches[0], r=map.getBoundingClientRect(); dragging=true; map.classList.add('grabbing'); lastX=t.clientX-r.left; lastY=t.clientY-r.top; } }, {passive:true});
  map.addEventListener('touchmove',(e)=>{ if(dragging && e.touches.length===1){ const t=e.touches[0], r=map.getBoundingClientRect(); const x=t.clientX-r.left, y=t.clientY-r.top; tx+=(x-lastX); ty+=(y-lastY); lastX=x; lastY=y; applyTransform(); e.preventDefault(); } }, {passive:false});
  map.addEventListener('touchend',()=>{ dragging=false; map.classList.remove('grabbing'); });

  // Init
  computeMinLevel(); zoomLevel = MIN_Z;
  tx = (map.clientWidth - baseW) / 2; ty = (map.clientHeight - baseH) / 2; applyTransform();
  window.addEventListener('resize', ()=>{ computeMinLevel(); if(zoomLevel<MIN_Z) zoomLevel=MIN_Z; applyTransform(); });

  // Sticky tooltip behavior
  function openSticky(html, localX, localY){
    sticky.innerHTML = html;
    sticky.style.display = 'block';
    const rect = sticky.getBoundingClientRect();
    const W = rect.width || 280, H = rect.height || 140;
    let left = localX + 12, top = localY + 12;
    left = Math.max(8, Math.min(left, map.clientWidth  - W - 8));
    top  = Math.max(8, Math.min(top,  map.clientHeight - H - 8));
    sticky.style.left = left + 'px';
    sticky.style.top  = top  + 'px';
    stickyBackdrop.style.display = 'block';
  }
  function closeSticky(){ sticky.style.display='none'; stickyBackdrop.style.display='none'; sticky.innerHTML=''; }
  stickyBackdrop.addEventListener('click', closeSticky);
  document.addEventListener('keydown', (e)=>{ if(e.key==='Escape') closeSticky(); });
  sticky.addEventListener('click', (e)=> e.stopPropagation());

  // Click marker -> sticky tooltip (uses clean HTML from data-tip)
  layer.addEventListener('click', (e)=>{
    const marker = e.target.closest('.marker'); if(!marker) return;
    const html = marker.getAttribute('data-tip'); if(!html) return;
    const r = map.getBoundingClientRect();
    openSticky(html, e.clientX - r.left, e.clientY - r.top);
  });
})();
</script>

</body>
</html>