<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : message.tpl 		 		                               ##
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

$nid = $_GET['nid']?? '';
$bid = $_GET['bid']?? '';
?>
<style>
.message-wrap{max-width:900px;margin:20px auto;font-family:Verdana}
.message-head{display:flex;align-items:center;gap:8px;margin-bottom:16px}
.message-head svg{width:24px;height:24px}
.message-head h2{margin:0;font-size:18px}
.message-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:12px}
.msg-card{background:#fff;border:1px solid #ddd;border-radius:8px;padding:14px;box-shadow:0 1px 3px rgba(0,0,0,.05)}
.msg-card h3{margin:0 0 10px;font-size:14px;display:flex;align-items:center;gap:6px;color:#333}
.msg-card form{display:flex;gap:6px}
.msg-card input[type="text"]{flex:1;padding:8px 10px;border:1px solid #ccc;border-radius:6px;font-size:13px}
.msg-card button{background:#333;color:#fff;border:0;padding:8px 12px;border-radius:6px;cursor:pointer;font-weight:bold}
.msg-card button:hover{background:#000}
.msg-card.igm{border-left:4px solid #3498db}
.msg-card.report{border-left:4px solid #e67e22}
.result-wrap{margin-top:20px}
</style>

<div class="message-wrap">
  <div class="message-head">
    <!-- ICON INLINE -->
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M4 6h16v10H7l-3 3V6z" fill="#555"/>
    </svg>
    <h2>IGM / Reports Lookup</h2>
  </div>

  <div class="message-grid">
    <div class="msg-card igm">
      <h3>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M4 5h16v10H7l-3 3V5z" fill="#3498db"/></svg>
        IGM by ID
      </h3>
      <form action="" method="get">
        <input type="hidden" name="p" value="message">
        <input type="text" name="nid" placeholder="Enter message ID..." value="<?php echo htmlspecialchars($nid);?>" autofocus>
        <button type="submit">Go</button>
      </form>
    </div>

    <div class="msg-card report">
      <h3>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M6 2h9l5 5v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z" fill="#e67e22"/><path d="M14 2v6h6" fill="#d35400"/></svg>
        Report by ID
      </h3>
      <form action="" method="get">
        <input type="hidden" name="p" value="message">
        <input type="text" name="bid" placeholder="Enter report ID..." value="<?php echo htmlspecialchars($bid);?>">
        <button type="submit">Go</button>
      </form>
    </div>
  </div>

  <div class="result-wrap">
    <?php
    if($nid && is_numeric($nid)) include('msg.tpl');
    elseif($bid && is_numeric($bid)) include('report.tpl');
    ?>
  </div>
</div>