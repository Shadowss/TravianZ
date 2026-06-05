<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : result_players.tpl 		                               ##
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
<?php $result = $admin->search_player($_POST['s']); ?>
<style>
.search-wrap{font-family:system-ui;margin-top:10px}
.search-head{width:100%;background:linear-gradient(135deg,#66CCFF,#66CCCC);color:#fff;padding:10px 12px;font-weight:600;text-align:center;font-size:14px;border-radius:10px 10px 0 0;box-shadow:0 2px 8px rgba(0,0,0,.08);box-sizing:border-box}
.search-table{width:100%;border-collapse:separate;border-spacing:0;background:#fff;border:1px solid #e5e7eb;border-top:0;border-radius:0 0 10px 10px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04);margin-bottom:12px}
.search-table tr:first-child td{background:#f8fafc;color:#64748b;font-size:11px;text-transform:uppercase;padding:7px 10px;font-weight:600;border-bottom:1px solid #e5e7eb;text-align:center}
.search-table td{padding:7px 10px;border-bottom:1px solid #f1f5f9;font-size:13px;color:#334155;text-align:center}
.search-table tr:last-child td{border-bottom:0}
.search-table tr:hover td{background:#f8fafc}
.search-table a{color:#2563eb;text-decoration:none;font-weight:500}
.search-table a:hover{text-decoration:underline}
.no-res{padding:20px;text-align:center;color:#94a3b8;font-style:italic}
</style>

<div class="search-wrap">
  <div class="search-head">Found players (<?php echo count($result);?>)</div>

  <table class="search-table">
	<tr>
		<td>UID</td>
		<td>PLAYER</td>
		<td>VILLAGES</td>
		<td>POP</td>
	</tr>
<?php
if($result){
    $userIDs = array_column($result, 'id');
    $database->getProfileVillages($userIDs);

    foreach($result as $p){
        $varray = $database->getProfileVillages($p['id']);
        $totalpop = 0;
        foreach($varray as $vil){ $totalpop += $vil['pop']; }
        echo '
	<tr>
		<td>'.$p['id'].'</td>
		<td><a href="?p=player&uid='.$p['id'].'">'.$p['username'].'</a></td>
		<td>'.count($varray).'</td>
		<td>'.$totalpop.'</td>
	</tr>
';
    }
} else {
    echo '<tr><td colspan="4" class="no-res">No results</td></tr>';
}
?>
  </table>
</div>