<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : villages.tpl 		                                       ##
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
?>
<style>
.vil-wrap{font-family:system-ui;margin-top:8px}
.vil-head{width:100%;background:linear-gradient(135deg,#0f172a,#1e293b);color:#fff;padding:9px 12px;font-weight:600;text-align:center;font-size:14px;border:1px solid #0f172a;border-radius:10px 10px 0 0;box-sizing:border-box}
.vil-table{width:100%;border-collapse:separate;border-spacing:0;background:#fff;border:1px solid #e5e7eb;border-top:0;border-radius:0 0 10px 10px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04)}
.vil-table tr:first-child td{background:#f8fafc;color:#64748b;font-size:11px;text-transform:uppercase;padding:7px 10px;font-weight:600;border-bottom:1px solid #e5e7eb;text-align:center}
.vil-table td{padding:7px 10px;border-bottom:1px solid #f1f5f9;font-size:13px;color:#334155;text-align:center}
.vil-table tr:last-child td{border-bottom:0}
.vil-table tr:hover td{background:#f8fafc}
.vil-table a{color:#2563eb;text-decoration:none;font-weight:500}
.vil-table a:hover{text-decoration:underline}
.vil-table .c{color:#dc2626;font-size:11px;margin-left:4px;font-weight:600}
.vil-icon{display:inline-flex;vertical-align:middle;opacity:.7;transition:.15s}
.vil-icon:hover{opacity:1}
.vil-icon svg{width:14px;height:14px;stroke:#64748b;stroke-width:2;fill:none}
.vil-icon:hover svg{stroke:#2563eb}
.vil-icon.del:hover svg{stroke:#dc2626}
</style>

<div class="vil-wrap">
  <div class="vil-head">Villages (<?php echo count($varray);?>)</div>
  
  <table class="vil-table">
	<tr>
		<td>NAME</td>
		<td>POPULATION</td>
		<td>COORDINATES</td>
		<td>TROOPS</td>
		<td style="width:32px"></td>
	</tr>
<?php
for ($i = 0; $i < count($varray); $i++) {
  $coor = $database->getCoor($varray[$i]['wref']);
  $capital = $varray[$i]['capital'] ? '<span class="c">(Capital)</span>' : '';
  
  $canDel = ($_SESSION['access'] == ADMIN && !$varray[$i]['capital']);
  if($canDel){
    $delLink = '<a class="vil-icon del" href="?action=delVil&did='.$varray[$i]['wref'].'" onclick="return del(\'did\','.$varray[$i]['wref'].');" title="Delete village"><svg viewBox="0 0 24 24"><path d="M3 6h18M8 6V4h8v2m-1 0v14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2V6h10z"/></svg></a>';
  } else {
    $delLink = '<span class="vil-icon" style="opacity:.3" title="Cannot delete"><svg viewBox="0 0 24 24"><path d="M3 6h18M8 6V4h8v2m-1 0v14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2V6h10z"/></svg></span>';
  }
  
  $recount = '<a class="vil-icon" href="?action=recountPop&did='.$varray[$i]['wref'].'" title="Recount population"><svg viewBox="0 0 24 24"><path d="M21 12a9 9 0 1 1-3-6.7"/><path d="M21 3v6h-6"/></svg></a>';
  
  echo '
	<tr>
		<td style="text-align:left"><a href="?p=village&did='.$varray[$i]['wref'].'">'.$varray[$i]['name'].'</a> '.$capital.'</td>
		<td>'.$varray[$i]['pop'].' '.$recount.'</td>
		<td>('.$coor['x'].'|'.$coor['y'].')</td>
		<td><a href="?p=addTroops&did='.$varray[$i]['wref'].'">Edit</a></td>
		<td>'.$delLink.'</td>
	</tr>';
}
?>
  </table>
</div>