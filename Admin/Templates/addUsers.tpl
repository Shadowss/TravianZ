<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : addUsers.tpl                                              ##
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
        case 'BN2S': $errorMsg = "Base Name too short (minimum 4 characters)"; break;
        case 'BN2L': $errorMsg = "Base Name too long (maximum 20 characters)"; break;
        case 'AMLO': $errorMsg = "Minimum 1 account"; break;
        case 'AMHI': $errorMsg = "Maximum 200 accounts"; break;
        case 'VILO': $errorMsg = "Minimum 1 village"; break;
        case 'VIHI': $errorMsg = "Maximum 200 villages"; break;
        default: $errorMsg = "Unknown error";
    }
}
elseif(isset($_GET['g']) && $_GET['g']=='OK'){
    $baseName = $_GET['bn']; $mode = $_GET['mo']; $skipped=(int)$_GET['sk']; $bp=(int)$_GET['bp'];
    $tribe = [0=>RANDOM,1=>TRIBE1,2=>TRIBE2,3=>TRIBE3][$_GET['tr']]??'Unknown';
    
    if($mode==='many_accounts'){
        $amount=(int)$_GET['am'];
        $successMsg = "Created <b>$amount</b> accounts with base <b>$baseName</b>";
    } else {
        $villages=(int)$_GET['vi'];
        $successMsg = "Created account <b>$baseName</b> with <b>$villages</b> villages";
    }
    $successMsg .= "<br>Protection: ".($bp?"<span style='color:#27ae60'>YES</span>":"<span style='color:#c0392b'>NO</span>")." | Tribe: <b>$tribe</b>";
    if($skipped>0) $successMsg .= "<br><span style='color:#e67e22'>$skipped existing names - skipped</span>";
}
?>
<style>
.add-wrap{max-width:520px;margin:14px auto;font-family:Tahoma,Verdana,Arial,sans-serif;color:#222}
.add-head h2{margin:0 0 8px;font-size:15px;display:flex;align-items:center;gap:5px;color:#111}
.add-card{background:#fff;border:1px solid #bbb;border-radius:5px;overflow:hidden;color:#222}
.add-top{padding:10px;background:#f5f5f5;border-bottom:1px solid #ddd;text-align:center;color:#222}
.warn-red{color:#c0392b;font-weight:bold;font-size:11px;margin:2px 0}
.warn-blue{color:#2980b9;font-size:10px;line-height:1.2}
.add-form{padding:14px;background:#fff;color:#222}
.mode-box{display:flex;gap:5px;margin-bottom:10px}
.mode-box label{flex:1;cursor:pointer}
.mode-box input{display:none}
.mode-box span{display:block;text-align:center;padding:5px;border:1px solid #aaa;border-radius:3px;background:#eee;font-size:11px;font-weight:bold;color:#222}
.mode-box input:checked+span{background:#2c3e50;color:#fff;border-color:#2c3e50}
.examples{font-size:10px;color:#444;background:#f9f9f9;border:1px dashed #ccc;padding:5px;margin:6px 0 10px;border-radius:3px;line-height:1.25}
.row{display:flex;align-items:center;margin-bottom:8px;gap:8px}
.row label{width:110px;font-size:11px;font-weight:bold;color:#111}
.row input[type=text]{width:150px;padding:4px;border:1px solid #999;border-radius:3px;font-size:12px;background:#fff;color:#111}
.hint{font-size:9px;color:#555;margin-left:118px;margin-top:-5px;margin-bottom:6px}
.check{margin:10px 0 12px;font-size:11px;color:#222}
.check label{display:flex;align-items:center;gap:5px}

/* TRIBES VERTICAL */
.tribe-wrap{margin-top:8px;}
.tribe-title{font-size:11px;font-weight:bold;margin-bottom:4px;color:#111}
.tribe-grid{display:flex;flex-direction:column;gap:4px;width:140px;}
.tribe-grid label{display:flex;align-items:center;gap:6px;padding:4px 6px;border:1px solid #bbb;border-radius:3px;background:#fff;cursor:pointer;min-height:24px;font-size:11px;color:#222}
.tribe-grid label:hover{background:#f0f0f0;}
.tribe-grid input{width:12px;height:12px;margin:0;}
.tribe-icon{font-size:12px;line-height:1;}
.tribe-text{font-size:10px;color:#222;line-height:1;}

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
      <?php echo csrf_field(); ?>
      <input type="hidden" name="id" value="<?php echo $id;?>">

      <?php if($errorMsg){?><div class="alert alert-err">✗ <?php echo $errorMsg;?></div><?php }?>
      <?php if($successMsg){?><div class="alert alert-ok">✓ <?php echo $successMsg;?></div><?php }?>

      <div class="mode-box">
        <label><input type="radio" name="mode" value="many_accounts" <?php echo $mode=='many_accounts'?'checked':'';?>><span>Many accounts (1 village)</span></label>
        <label><input type="radio" name="mode" value="single_with_villages" <?php echo $mode=='single_with_villages'?'checked':'';?>><span>1 account (many villages)</span></label>
      </div>

      <div class="examples">
        <b>Base Name</b> 4-20 characters. Ex: Farm | 5 → Farm1..Farm5. Single ex: FarmLord | 5 villages.<br>
        <b>Warning:</b> large values may freeze the server!
      </div>

      <div class="row">
        <label>Base Name</label>
        <input type="text" name="users_base_name" value="<?php echo htmlspecialchars($baseName);?>" maxlength="20">
      </div>

      <div class="row" id="accRow">
        <label>How many accounts</label>
        <input type="text" name="users_amount" value="<?php echo htmlspecialchars($amount);?>" maxlength="4">
      </div>
      <div class="hint">1 - 200</div>

      <div class="row" id="vilRow">
        <label>How many villages</label>
        <input type="text" name="villages_amount" value="<?php echo htmlspecialchars($villages);?>" maxlength="4">
      </div>
      <div class="hint">1 - 200 (single only)</div>

      <div class="check">
        <label><input type="checkbox" name="users_protection" checked> Enable beginner protection</label>
      </div>

      <div class="tribe-wrap">
        <div class="tribe-title">Tribe</div>
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