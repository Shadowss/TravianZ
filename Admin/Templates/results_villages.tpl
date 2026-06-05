<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : results_villages.tpl 		                               ##
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
<?php $result = $admin->search_village($_POST['s']); ?>
<style>
.search-wrap{font-family:system-ui;margin-top:10px}
.search-head{width:100%;background:linear-gradient(135deg,#66CCFF,#66CCCC);color:#fff;padding:10px 12px;font-weight:600;text-align:center;font-size:14px;border-radius:10px 10px 0 0;box-shadow:0 2px 8px rgba(0,0,0,.08);box-sizing:border-box}
.search-table{width:100%;border-collapse:separate;border-spacing:0;background:#fff;border:1px solid #e5e7eb;border-top:0;border-radius:0 0 10px 10px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04);margin-bottom:12px}
.search-table tr:first-child td{background:#f8fafc;color:#64748b;font-size:11px;text-transform:uppercase;padding:7px 8px;font-weight:600;border-bottom:1px solid #e5e7eb;text-align:center}
.search-table td{padding:7px 8px;border-bottom:1px solid #f1f5f9;font-size:13px;color:#334155;text-align:center}
.search-table tr:last-child td{border-bottom:0}
.search-table tr:hover td{background:#f8fafc}
.search-table a{color:#2563eb;text-decoration:none;font-weight:500}
.search-table a:hover{text-decoration:underline}
.search-table .del{width:12px;height:12px;vertical-align:middle;opacity:.7}
.search-table .del:hover{opacity:1}
.search-foot{padding:8px;text-align:center;font-size:12px;color:#64748b;background:#f8fafc;border-top:1px solid #e5e7eb}
.search-foot font{color:#dc2626 !important;font-weight:600}
.no-res{padding:20px;text-align:center;color:#94a3b8;font-style:italic}
</style>

<div class="search-wrap">
  <div class="search-head">Found villages (<?php echo count($result);?>)</div>

  <table class="search-table">
	<tr>
		<td>ID</td>
		<td>VILLAGE NAME</td>
		<td>OWNER</td>
		<td>POP</td>
		<td style="width:30px"></td>
	</tr>
<?php if($result){
    foreach($result as $v){
        $owner = $database->getUserField($v['owner'],'username',0);
        $delLink = '<a href="?action=delVil&did='.$v['wref'].'" onclick="return del(\'did\','.$v['wref'].');"><img src="../img/admin/del.gif" class="del"></a>';
        echo '
	<tr>
		<td>'.$v['wref'].'</td>
		<td><a href="?p=village&did='.$v['wref'].'">'.$v['name'].'</a></td>
		<td><a href="?p=player&uid='.$v['owner'].'">'.$owner.'</a></td>
		<td>'.$v['pop'].'</td>
		<td>'.$delLink.'</td>
	</tr>';
    }
    echo '</table><div class="search-foot"><font>'.count($result).'</font> Villages Found "<font>'.$_POST['s'].'</font>"</div>';
} else {
    echo '<tr><td colspan="5" class="no-res">No results</td></tr></table>';
    echo '<div class="search-foot">No Villages Called "<font>'.$_POST['s'].'</font>"</div>';
}
?>
</div>