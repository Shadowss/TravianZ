<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : search.tpl 		                                       ##
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
if($_SESSION['access'] < MULTIHUNTER) die("Access Denied!");

$types = [
    'player' => ['Search Players','👤'],
    'alliances' => ['Search Alliances','🛡️'],
    'villages' => ['Search Villages','🏘️'],
    'email' => ['Search E-mails','✉️'],
    'ip' => ['Search IPs','🌐'],
    'deleted_players' => ['Search Deleted','🗑️']
];
$current = $_POST['p']?? 'player';
$search = stripslashes($_POST['s']?? '');
?>
<style>
.search-wrap{max-width:900px;margin:20px auto;font-family:Verdana}
.search-head{display:flex;align-items:center;gap:8px;margin-bottom:16px}
.search-head svg{width:24px;height:24px}
.search-head h2{margin:0;font-size:18px}
.search-card{background:#fff;border:1px solid #ddd;border-radius:8px;padding:16px;box-shadow:0 1px 3px rgba(0,0,0,.05)}
.search-form{display:flex;gap:8px;flex-wrap:wrap;align-items:center}
.search-form select,.search-form input{padding:8px 10px;border:1px solid #ccc;border-radius:6px;font-size:13px}
.search-form select{min-width:180px}
.search-form input[type="text"]{flex:1;min-width:200px}
.search-form input[type="submit"]{background:#333;color:#fff;border:0;padding:8px 16px;border-radius:6px;cursor:pointer;font-weight:bold}
.search-form input[type="submit"]:hover{background:#000}
.quick-types{display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:8px;margin-top:14px}
.qtype{border:1px solid #eee;border-radius:6px;padding:10px;text-align:center;cursor:pointer;background:#fafafa;transition:.15s;font-size:12px}
.qtype:hover{background:#f0f0f0;transform:translateY(-1px)}
.qtype.active{background:#333;color:#fff;border-color:#333}
.qtype span{display:block;font-size:18px;margin-bottom:4px}
.msg-box{margin-top:20px;padding:12px;background:#e8f5e9;border:1px solid #c8e6c9;border-radius:6px;text-align:center;color:#2e7d32;font-weight:bold}
</style>

<div class="search-wrap">
  <div class="search-head">
    <!-- ICON INLINE -->
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="11" cy="11" r="7" stroke="#555" stroke-width="2"/>
      <path d="M20 20l-3.5-3.5" stroke="#555" stroke-width="2" stroke-linecap="round"/>
    </svg>
    <h2>Admin Search</h2>
  </div>

  <div class="search-card">
    <form action="" method="post" class="search-form" id="searchForm">
      <?php echo csrf_field(); ?>
      <select name="p" id="searchType">
        <?php foreach($types as $k=>$v){?>
          <option value="<?php echo $k;?>" <?php echo $current==$k?'selected':'';?>><?php echo $v[1].' '.$v[0];?></option>
        <?php }?>
      </select>
      <input type="text" name="s" placeholder="Enter name, ID, email or IP..." value="<?php echo htmlspecialchars($search);?>" autofocus>
      <input type="submit" value="Search">
    </form>

    <div class="quick-types">
      <?php foreach($types as $k=>$v){?>
        <div class="qtype <?php echo $current==$k?'active':'';?>" onclick="setType('<?php echo $k;?>')">
          <span><?php echo $v[1];?></span>
          <?php echo str_replace('Search ','',$v[0]);?>
        </div>
      <?php }?>
    </div>
  </div>

  <?php if(!empty($_GET['msg'])){?>
    <div class="msg-box">
      <?php echo $_GET['msg']=='ursdel'? '✓ User was deleted successfully.' : htmlspecialchars($_GET['msg']);?>
    </div>
  <?php }?>
</div>

<script>
function setType(t){
  document.getElementById('searchType').value = t;
  document.getElementById('searchForm').querySelector('input[name="s"]').focus();
  document.querySelectorAll('.qtype').forEach(el=>el.classList.remove('active'));
  event.currentTarget.classList.add('active');
}
</script>