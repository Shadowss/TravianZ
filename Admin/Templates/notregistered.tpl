<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : notregistered.tpl 	    	                               ##
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

if(!isset($_SESSION)) session_start();
if($_SESSION['access'] < ADMIN) die("Access Denied");
?>
<style>
.notreg-wrap{max-width:100%;margin:12px auto;font-family:Tahoma,Verdana,Arial,sans-serif;padding:0 10px;box-sizing:border-box}
.notreg-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;flex-wrap:wrap;gap:8px}
.notreg-head h2{margin:0;font-size:16px;color:#c0392b;display:flex;align-items:center;gap:6px}
.notreg-search input{padding:6px 12px;border:1px solid #bbb;border-radius:14px;font-size:12px;width:200px;box-sizing:border-box}
.notreg-card{background:#fff;border:1px solid #bbb;border-radius:6px;overflow-x:auto;-webkit-overflow-scrolling:touch}
.notreg-table{width:100%;border-collapse:collapse;font-size:12px;min-width:720px}
.notreg-table th{background:#3a4f63;color:#fff;padding:8px 6px;text-align:left;font-weight:bold;font-size:11px;white-space:nowrap;position:sticky;top:0;z-index:1}
.notreg-table td{padding:7px 6px;border-bottom:1px solid #eee;vertical-align:middle}
.notreg-table tr:hover{background:#fff5f5}
.notreg-table a{color:#004a9f;text-decoration:none;word-break:break-all}
.notreg-table a:hover{text-decoration:underline}
.badge-tribe{padding:3px 6px;border-radius:3px;color:#fff;font-size:10px;font-weight:bold;white-space:nowrap;display:inline-block}
.tribe-1{background:#c0392b} .tribe-2{background:#2c3e50} .tribe-3{background:#27ae60}
.code{font-family:monospace;background:#f4f4f4;padding:2px 5px;border-radius:3px;font-size:10px;word-break:break-all}
.time{color:#666;font-size:10px;white-space:nowrap}

/* MOBILE FIX */
@media (max-width:768px){
  .notreg-wrap{padding:0 5px}
  .notreg-head{flex-direction:column;align-items:stretch}
  .notreg-search input{width:100%}
  .notreg-table{font-size:11px;min-width:650px}
  .notreg-table th,.notreg-table td{padding:6px 4px}
}
</style>

<div class="notreg-wrap">
  <div class="notreg-head">
    <h2>✉️ Players Not Activated</h2>
    <div class="notreg-search"><input type="text" id="notregSearch" placeholder="Caută username sau email..."></div>
  </div>

  <div class="notreg-card">
    <table class="notreg-table" id="notregTable">
      <thead>
        <tr>
          <th width="30">#</th>
          <th width="40">ID</th>
          <th>Username</th>
          <th>Email</th>
          <th width="70">Tribe</th>
          <th>Activation Code</th>
          <th width="60">Act2</th>
          <th width="110">Time</th>
        </tr>
      </thead>
      <tbody>
<?php
$sql = "SELECT * FROM ".TB_PREFIX."activate ORDER BY timestamp DESC";
$result = mysqli_query($GLOBALS["link"], $sql);
$i = 0;
while($row = mysqli_fetch_assoc($result)) {
    $i++;
    $tribe = $row['tribe']==1?'Roman':($row['tribe']==2?'Teuton':'Gaul');
    $tclass = 'tribe-'.$row['tribe'];
    $time = date('d.m.Y H:i', $row['timestamp']);
    echo "<tr>
      <td>{$i}</td>
      <td>{$row['id']}</td>
      <td><b>".htmlspecialchars($row['username'])."</b></td>
      <td><a href=\"mailto:{$row['email']}\">".htmlspecialchars($row['email'])."</a></td>
      <td><span class='badge-tribe {$tclass}'>{$tribe}</span></td>
      <td><span class='code'>".htmlspecialchars($row['act'])."</span></td>
      <td>".htmlspecialchars($row['act2'])."</td>
      <td class='time'>{$time}</td>
    </tr>";
}
if($i==0) echo "<tr><td colspan='8' style='text-align:center;padding:20px;color:#777'>Niciun jucător neactivat</td></tr>";
?>
      </tbody>
    </table>
  </div>
</div>

<script>
(function(){
  const search = document.getElementById('notregSearch');
  const rows = document.querySelectorAll('#notregTable tbody tr');
  search.onkeyup = function(){
    const q = this.value.toLowerCase();
    rows.forEach(r=>{
      const txt = r.innerText.toLowerCase();
      r.style.display = txt.includes(q) ? '' : 'none';
    });
  };
})();
</script>