<?php
#################################################################################
## msg.tpl - REDESIGN 2025 (stil Reports) ##
#################################################################################
if($_SESSION['access'] < MULTIHUNTER) die("Access Denied!");
include_once("../GameEngine/Generator.php");
include_once("../GameEngine/Technology.php");
include_once("../GameEngine/Message.php");
include_once("../GameEngine/BBCode.php");

$nid = isset($_GET['nid'])? (int)$_GET['nid'] : 0;
$search = isset($_GET['q'])? $database->escape($_GET['q']) : '';
$filter = isset($_GET['f'])? $_GET['f'] : 'all';
$page = max(1, (int)($_GET['page']?? 1));
$limit = 50;
$offset = ($page-1)*$limit;

// ---- SINGLE MESSAGE - PĂSTRĂM VIZUALIZAREA CLASICĂ ----
if($nid > 0){
    $msg = $database->getMessage($nid, 3);
    if(empty($msg)) die("Message ID $nid doesn't exist!");
   ?>
    <link href="../<?php echo GP_LOCATE;?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css">
    <link href="../<?php echo GP_LOCATE;?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css">
    <link href="../<?php echo GP_LOCATE;?>travian.css?e21d2" rel="stylesheet" type="text/css">
    <div style="max-width:900px;margin:20px auto">
      <a href="?p=msg" style="font-size:12px">← Back to messages</a>
      <div style="margin:8px 0;font-size:12px"><span class="b">Sent to</span>: <?php echo $database->getUserField($msg[0]['target'],'username',0);?></div>
      <div id="content" class="messages">
        <h1>Message</h1>
        <div id="read_head" class="msg_head"></div>
        <div id="read_content" class="msg_content">
          <img src="../img/x.gif" id="label" class="read" alt="">
          <div id="heading">
            <div><?php echo $database->getUserField($msg[0]['owner'],'username',0);?></div>
            <div><?php echo htmlspecialchars($msg[0]['topic']);?></div>
          </div>
          <div id="time">
            <div><?php echo date('d.m.y',$msg[0]['time']);?></div>
            <div><?php echo date('H:i:s',$msg[0]['time']);?></div>
          </div>
          <div class="clear"></div>
          <div class="line"></div>
          <div class="message" style="min-height:10px;">
            <?php
            $input = $msg[0]['message'];
            $alliance = $msg[0]['alliance'];
            $player = $msg[0]['player'];
            $coor = $msg[0]['coor'];
            $report = $msg[0]['report'];
            echo stripslashes(nl2br($bbcoded));
           ?>
          </div>
        </div>
        <div id="read_foot" class="msg_foot"></div>
      </div>
    </div>
    <?php
    return;
}

// ---- LISTA MESAJE ----
$where = "1";
if($search) $where.= " AND (topic LIKE '%$search%' OR message LIKE '%$search%')";

$filterMap = [
    'inbox' => "target > 0",
    'sent' => "owner > 0",
    'system' => "owner = 0"
];
if(isset($filterMap[$filter])) $where.= " AND ".$filterMap[$filter];

$total = $database->query("SELECT COUNT(*) c FROM ".TB_PREFIX."mdata WHERE $where")->fetch_assoc()['c'];
$msgs = $database->query("SELECT * FROM ".TB_PREFIX."mdata WHERE $where ORDER BY time DESC LIMIT $offset,$limit")->fetch_all(MYSQLI_ASSOC);
?>
<style>
.msg-wrap{max-width:1100px;margin:20px auto;font-family:Verdana}
.msg-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;flex-wrap:wrap;gap:8px}
.msg-head h1{margin:0;font-size:18px;display:flex;align-items:center;gap:8px}
.msg-head svg{width:22px;height:22px}
.filters{display:flex;gap:6px}
.filters a{padding:6px 10px;border:1px solid #ddd;background:#f7f7f7;border-radius:4px;font-size:12px;text-decoration:none;color:#333}
.filters a.active{background:#333;color:#fff;border-color:#333}
.search-box input{padding:6px 8px;border:1px solid #ccc;border-radius:4px;font-size:12px;width:200px}
.msg-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:10px}
.msg-card{background:#fff;border:1px solid #ddd;border-radius:6px;padding:10px;font-size:12px;box-shadow:0 1px 2px rgba(0,0,0,.04);transition:.15s;border-left:4px solid #ccc}
.msg-card:hover{transform:translateY(-1px);box-shadow:0 2px 6px rgba(0,0,0,.1)}
.msg-card.system{border-left-color:#9b59b6}
.msg-card.player{border-left-color:#3498db}
.msg-top{display:flex;justify-content:space-between;margin-bottom:6px}
.msg-from{font-weight:bold;color:#222}
.msg-time{color:#888;font-size:11px}
.msg-topic{color:#333;margin:4px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.msg-preview{color:#666;font-size:11px;max-height:32px;overflow:hidden}
.msg-foot{display:flex;justify-content:space-between;margin-top:8px;font-size:11px;color:#999}
.pagination{margin-top:14px;text-align:center}
.pagination a{padding:5px 9px;margin:0 2px;border:1px solid #ddd;text-decoration:none;color:#333;font-size:12px;border-radius:3px}
.pagination a.active{background:#333;color:#fff}
</style>

<div class="msg-wrap">
  <div class="msg-head">
    <h1>
      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 5h16a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H7l-3 3v-3H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z" fill="#3498db"/></svg>
      Players Messages (<?php echo number_format($total);?>)
    </h1>
    <div class="filters">
      <?php foreach(['all'=>'All','inbox'=>'Inbox','sent'=>'Sent','system'=>'System'] as $k=>$v){?>
        <a href="?p=msg&f=<?php echo $k;?>&q=<?php echo urlencode($search);?>" class="<?php echo $filter==$k?'active':'';?>"><?php echo $v;?></a>
      <?php }?>
    </div>
    <form class="search-box" method="get">
      <input type="hidden" name="p" value="msg">
      <input type="hidden" name="f" value="<?php echo $filter;?>">
      <input type="text" name="q" placeholder="Search..." value="<?php echo htmlspecialchars($search);?>">
    </form>
  </div>

  <div class="msg-grid">
    <?php foreach($msgs as $m){
        $from = $m['owner']? $database->getUserField($m['owner'],'username',0) : 'System';
        $to = $m['target']? $database->getUserField($m['target'],'username',0) : '-';
        $time = date('d.m H:i',$m['time']);
        $preview = strip_tags($m['message']);
        $preview = mb_substr($preview,0,90);
        $cls = $m['owner']==0? 'system' : 'player';
   ?>
    <a href="?p=msg&nid=<?php echo $m['id'];?>" style="text-decoration:none;color:inherit">
      <div class="msg-card <?php echo $cls;?>">
        <div class="msg-top">
          <span class="msg-from"><?php echo htmlspecialchars($from);?> → <?php echo htmlspecialchars($to);?></span>
          <span class="msg-time"><?php echo $time;?></span>
        </div>
        <div class="msg-topic"><?php echo htmlspecialchars($m['topic']?: '(no subject)');?></div>
        <div class="msg-preview"><?php echo htmlspecialchars($preview);?>...</div>
        <div class="msg-foot">
          <span>#<?php echo $m['id'];?></span>
          <span>view →</span>
        </div>
      </div>
    </a>
    <?php }?>
  </div>

  <?php if($total > $limit){ $pages = ceil($total/$limit);?>
  <div class="pagination">
    <?php for($p=1;$p<=$pages && $p<=15;$p++){?>
      <a href="?p=msg&page=<?php echo $p;?>&f=<?php echo $filter;?>&q=<?php echo urlencode($search);?>" class="<?php echo $p==$page?'active':'';?>"><?php echo $p;?></a>
    <?php }?>
  </div>
  <?php }?>
</div>