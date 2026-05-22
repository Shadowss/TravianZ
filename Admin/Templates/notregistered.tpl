<?php
if(!isset($_SESSION)) session_start();
if($_SESSION['access'] < ADMIN) die("Access Denied");
?>
<style>
.notreg-wrap{max-width:980px;margin:12px auto;font-family:Tahoma,Verdana,Arial,sans-serif}
.notreg-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:8px}
.notreg-head h2{margin:0;font-size:16px;color:#c0392b;display:flex;align-items:center;gap:6px}
.notreg-search input{padding:4px 8px;border:1px solid #bbb;border-radius:14px;font-size:11px;width:180px}
.notreg-card{background:#fff;border:1px solid #bbb;border-radius:6px;overflow:hidden}
.notreg-table{width:100%;border-collapse:collapse;font-size:11px}
.notreg-table th{background:#3a4f63;color:#fff;padding:6px 5px;text-align:left;font-weight:bold;font-size:10px;white-space:nowrap;cursor:pointer}
.notreg-table td{padding:5px;border-bottom:1px solid #eee;vertical-align:middle}
.notreg-table tr:hover{background:#fff5f5}
.notreg-table a{color:#004a9f;text-decoration:none}
.notreg-table a:hover{text-decoration:underline}
.badge-tribe{padding:2px 5px;border-radius:3px;color:#fff;font-size:10px;font-weight:bold}
.tribe-1{background:#c0392b} .tribe-2{background:#2c3e50} .tribe-3{background:#27ae60}
.code{font-family:monospace;background:#f4f4f4;padding:1px 4px;border-radius:2px;font-size:10px}
.time{color:#666;font-size:10px}
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
      <td><a href=\"mailto:{$row['email']}\">{$row['email']}</a></td>
      <td><span class='badge-tribe {$tclass}'>{$tribe}</span></td>
      <td><span class='code'>{$row['act']}</span></td>
      <td>{$row['act2']}</td>
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