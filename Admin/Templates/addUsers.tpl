<?php
#################################################################################
## addUsers.tpl - REDESIGN 2025 v2 ##
#################################################################################
if($_SESSION['access'] < ADMIN) die("Access Denied!");
$id = $_SESSION['id'];

$baseName = "Farm"; $amount = 20; $villages = 5; $mode = "many_accounts";
$errorMsg = ""; $successMsg = "";

if(isset($_GET['e'])) {
    $baseName = $_GET['bn']??$baseName;
    $amount   = $_GET['am']??$amount;
    $villages = $_GET['vi']??$villages;
    $mode     = $_GET['mo']??$mode;
    switch ($_GET['e']) {
        case 'BN2S': $errorMsg = "Base Name prea scurt (minim 4 caractere)"; break;
        case 'BN2L': $errorMsg = "Base Name prea lung (maxim 20 caractere)"; break;
        case 'AMLO': $errorMsg = "Minim 1 cont"; break;
        case 'AMHI': $errorMsg = "Maxim 200 conturi"; break;
        case 'VILO': $errorMsg = "Minim 1 sat"; break;
        case 'VIHI': $errorMsg = "Maxim 200 sate"; break;
        default: $errorMsg = "Eroare necunoscută";
    }
}
elseif(isset($_GET['g']) && $_GET['g']=='OK'){
    $baseName = $_GET['bn']; $mode = $_GET['mo']; $skipped=(int)$_GET['sk']; $bp=(int)$_GET['bp'];
    $tribe = [0=>RANDOM,1=>TRIBE1,2=>TRIBE2,3=>TRIBE3][$_GET['tr']]??'Unknown';
    
    if($mode==='many_accounts'){
        $amount=(int)$_GET['am'];
        $successMsg = "Creat <b>$amount</b> conturi cu baza <b>$baseName</b>";
    } else {
        $villages=(int)$_GET['vi'];
        $successMsg = "Creat contul <b>$baseName</b> cu <b>$villages</b> sate";
    }
    $successMsg .= "<br>Protecție: ".($bp?"<span style='color:#27ae60'>DA</span>":"<span style='color:#c0392b'>NU</span>")." | Trib: <b>$tribe</b>";
    if($skipped>0) $successMsg .= "<br><span style='color:#e67e22'>$skipped nume existente - sărite</span>";
}
?>
<style>
.add-wrap{max-width:520px;margin:14px auto;font-family:Tahoma,Verdana,Arial,sans-serif}
.add-head h2{margin:0 0 8px;font-size:15px;display:flex;align-items:center;gap:5px}
.add-card{background:#fff;border:1px solid #bbb;border-radius:5px;overflow:hidden}
.add-top{padding:10px;background:#f5f5f5;border-bottom:1px solid #ddd;text-align:center}
.warn-red{color:#c0392b;font-weight:bold;font-size:11px;margin:2px 0}
.warn-blue{color:#2980b9;font-size:10px;line-height:1.2}
.add-form{padding:14px}
.mode-box{display:flex;gap:5px;margin-bottom:10px}
.mode-box label{flex:1;cursor:pointer}
.mode-box input{display:none}
.mode-box span{display:block;text-align:center;padding:5px;border:1px solid #aaa;border-radius:3px;background:#eee;font-size:11px;font-weight:bold}
.mode-box input:checked+span{background:#2c3e50;color:#fff;border-color:#2c3e50}
.examples{font-size:10px;color:#555;background:#f9f9f9;border:1px dashed #ccc;padding:5px;margin:6px 0 10px;border-radius:3px;line-height:1.25}
.row{display:flex;align-items:center;margin-bottom:8px;gap:8px}
.row label{width:110px;font-size:11px;font-weight:bold}
.row input[type=text]{width:150px;padding:4px;border:1px solid #999;border-radius:3px;font-size:12px}
.hint{font-size:9px;color:#777;margin-left:118px;margin-top:-5px;margin-bottom:6px}
.check{margin:10px 0 12px;font-size:11px}
.check label{display:flex;align-items:center;gap:5px}

/* TRIBURI VERTICAL */
.tribe-wrap{margin-top:8px;}
.tribe-title{font-size:11px;font-weight:bold;margin-bottom:4px;}
.tribe-grid{display:flex;flex-direction:column;gap:4px;width:140px; /* poti modifica */}
.tribe-grid label{display:flex;align-items:center;gap:6px;padding:4px 6px;border:1px solid #bbb;border-radius:3px;background:#fcfcfc;cursor:pointer;min-height:24px;font-size:11px;}
.tribe-grid label:hover{background:#f0f0f0;}
.tribe-grid input{width:12px;height:12px;margin:0;}
.tribe-icon{font-size:12px;line-height:1;}
.tribe-text{font-size:10px;color:#333;line-height:1;}

.submit{text-align:center;margin-top:12px}
.submit button{background:#27ae60;color:#fff;border:0;padding:7px 22px;border-radius:4px;font-weight:bold;cursor:pointer;font-size:12px}
.submit button:hover{background:#1e8449}
.alert{padding:6px 8px;border-radius:3px;margin-bottom:8px;font-size:11px}
.alert-err{background:#fdecea;border:1px solid #e74c3c;color:#c0392b}
.alert-ok{background:#eafaf1;border:1px solid #27ae60;color:#145a32}
.block-off{opacity:.4;pointer-events:none}
</style>

<div class="add-wrap">
  <div class="add-head"><h2>👤 Create Users</h2></div>
  
  <div class="add-card">
    <div class="add-top">
      <div class="warn-red">Submitting this form will create new Users and/or Villages on your server!</div>
      <div class="warn-blue">Includes resources, main building, rally point, warehouse, granary, wall, market, residence, troops (for hero level-up), and one cranny.</div>
    </div>

    <form action="../GameEngine/Admin/Mods/addUsers.php" method="POST" class="add-form">
      <input type="hidden" name="id" value="<?php echo $id;?>">

      <?php if($errorMsg){?><div class="alert alert-err">✗ <?php echo $errorMsg;?></div><?php }?>
      <?php if($successMsg){?><div class="alert alert-ok">✓ <?php echo $successMsg;?></div><?php }?>

      <div class="mode-box">
        <label><input type="radio" name="mode" value="many_accounts" <?php echo $mode=='many_accounts'?'checked':'';?>><span>Multe conturi (1 sat)</span></label>
        <label><input type="radio" name="mode" value="single_with_villages" <?php echo $mode=='single_with_villages'?'checked':'';?>><span>1 cont (multe sate)</span></label>
      </div>

      <div class="examples">
        <b>Base Name</b> 4-20 caractere. Ex: Farm | 5 → Farm1..Farm5. Ex single: FarmLord | 5 sate.<br>
        <b>Atenție:</b> valori mari pot bloca serverul!
      </div>

      <div class="row">
        <label>Base Name</label>
        <input type="text" name="users_base_name" value="<?php echo htmlspecialchars($baseName);?>" maxlength="20">
      </div>

      <div class="row" id="accRow">
        <label>Câte conturi</label>
        <input type="text" name="users_amount" value="<?php echo htmlspecialchars($amount);?>" maxlength="4">
      </div>
      <div class="hint">1 - 200</div>

      <div class="row" id="vilRow">
        <label>Câte sate</label>
        <input type="text" name="villages_amount" value="<?php echo htmlspecialchars($villages);?>" maxlength="4">
      </div>
      <div class="hint">1 - 200 (doar single)</div>

      <div class="check">
        <label><input type="checkbox" name="users_protection" checked> Activează protecție începători</label>
      </div>

      <div class="tribe-wrap">
        <div class="tribe-title">Trib</div>
        <div class="tribe-grid">
          <label><input type="radio" name="tribe" value="0" checked><span class="tribe-icon">🎲</span><span class="tribe-text"><?php echo RANDOM;?></span></label>
          <label><input type="radio" name="tribe" value="1"><span class="tribe-icon">🏛</span><span class="tribe-text"><?php echo TRIBE1;?></span></label>
          <label><input type="radio" name="tribe" value="2"><span class="tribe-icon">🪓</span><span class="tribe-text"><?php echo TRIBE2;?></span></label>
          <label><input type="radio" name="tribe" value="3"><span class="tribe-icon">🌾</span><span class="tribe-text"><?php echo TRIBE3;?></span></label>
        </div>
      </div>

      <div class="submit"><button type="submit">+ Create</button></div>
    </form>
  </div>
</div>

<script>
(function(){
 function sync(){
   var m=document.querySelector('input[name="mode"]:checked').value;
   document.getElementById('accRow').className='row'+(m==='many_accounts'?'':' block-off');
   document.getElementById('vilRow').className='row'+(m==='single_with_villages'?'':' block-off');
 }
 document.querySelectorAll('input[name="mode"]').forEach(r=>r.onchange=sync);
 sync();
})();
</script>