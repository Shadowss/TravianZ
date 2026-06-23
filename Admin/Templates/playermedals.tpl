<style>
.medals-wrap{font-family:system-ui;margin-top:12px}
.medals-head{width:100%;background:linear-gradient(135deg,#66CCFF,#66CCCC);color:#fff;padding:8px 12px;font-weight:600;text-align:center;font-size:13px;border-radius:10px 10px 0 0;box-sizing:border-box}
.medals-table{width:100%;border-collapse:separate;border-spacing:0;background:#fff;border:1px solid #e5e7eb;border-top:0;border-radius:0 0 10px 10px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04)}
.medals-table tr.head td{background:#f8fafc;color:#64748b;font-size:11px;text-transform:uppercase;padding:6px 8px;font-weight:600;border-bottom:1px solid #e5e7eb;text-align:center}
.medals-table td{padding:6px 8px;border-bottom:1px solid #f1f5f9;font-size:12px;color:#334155;text-align:center;vertical-align:middle}
.medals-table tr:last-child td{border-bottom:0}
.medals-table tr:hover td{background:#f8fafc}
.medals-table img.medal{width:28px;height:40px;object-fit:contain}
.medals-del{background:none;border:0;padding:0;cursor:pointer;display:inline-flex;opacity:.7;transition:.15s}
.medals-del:hover{opacity:1}
.medals-del svg{width:14px;height:14px;stroke:#dc2626;stroke-width:2;fill:none;stroke-linecap:round}
.no-medals{padding:20px;text-align:center;color:#94a3b8;font-style:italic}
.avg-row td{background:#f8fafc !important;font-weight:600;color:#0f172a}
</style>

<div class="medals-wrap">
  <div class="medals-head">Player Medals (<?php echo sizeof($varmedal); ?>)</div>
  <table class="medals-table">
    <tr class="head">
      <td>CATEGORY</td>
      <td>RANK</td>
      <td>WEEK</td>
      <td>POINTS</td>
      <td>MEDAL</td>
      <td style="width:30px"></td>
    </tr>
    <?php
    if(empty($varmedal)){ ?>
      <tr><td colspan="6" class="no-medals">This player has no medals yet</td></tr>
    <?php } else {
      foreach($varmedal as $medal){
        $title = "Bonus";
        switch ($medal['categorie']){
          case 1: $title = "Attackers"; break;
          case 2: $title = "Defenders"; break;
          case 3: $title = "Climbers"; break;
          case 4: $title = "Robbers"; break;
          case 5: $title = "Top 10 Att and Def"; break;
          case 6: $title = "Top 3 Att, ".$medal['points']." in a row"; break;
          case 7: $title = "Top 3 Def,".$medal['points']." in a row"; break;
          case 8: $title = "Top 3 Climber, ".$medal['points']." in a row"; break;
          case 9: $title = "Top 3 Robber, ".$medal['points']." in a row"; break;
          case 10: $title = "Climber of the week"; break;
          case 11: $title = "Top 3 Climber, ".$medal['points']." in a row"; break;
          case 12: $title = "Top 10 Attacker, ".$medal['points']." in a row"; break;
        }
        $rank = $medal['plaats'] == 0 ? "Bonus" : $medal['plaats'];
        $points = $medal['points'] == '' ? "Bonus" : $medal['points'];
        echo '
        <tr>
          <td style="text-align:left">'.$title.'</td>
          <td>'.$rank.'</td>
          <td>'.$medal['week'].'</td>
          <td>'.$points.'</td>
          <td><img class="medal" src="../gpack/travian_default/img/t/'.$medal['img'].'.jpg"></td>
          <td>
            <form action="../GameEngine/Admin/Mods/medals.php" method="POST" style="margin:0">
              '.csrf_field().'
              <input type="hidden" name="uid" value="'.$_GET['uid'].'">
              <input type="hidden" name="medalid" value="'.$medal['id'].'">
              <button type="submit" class="medals-del" title="Delete medal">
                <svg viewBox="0 0 24 24"><path d="M3 6h18M8 6V4h8v2m-1 0v14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2V6h10z"/></svg>
              </button>
            </form>
          </td>
        </tr>';
      }
      $averagerank = 0; $i = 0;
      foreach($varmedal as $m){ if($m['plaats']>0){ $i++; $averagerank += $m['plaats']; } }
      $average = $i ? round($averagerank/$i,1) : 0;
      echo '<tr class="avg-row"><td style="text-align:left"><b>Average Rank</b></td><td>'.$average.'</td><td></td><td></td><td>Delete All</td>
        <td>
          <form action="../GameEngine/Admin/Mods/medals.php" method="POST" style="margin:0">
            '.csrf_field().'
            <input type="hidden" name="uid" value="'.$_GET['uid'].'">
            <input type="hidden" name="userid" value="'.$id.'">
            <button type="submit" class="medals-del" title="Delete all medals">
              <svg viewBox="0 0 24 24"><path d="M3 6h18M8 6V4h8v2m-1 0v14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2V6h10z"/></svg>
            </button>
          </form>
        </td></tr>';
    } ?>
  </table>
</div>