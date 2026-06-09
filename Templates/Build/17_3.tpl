<?php
// 17_3.tpl - MARKETPLACE / NPC Trade
global $database, $session, $village, $id;

if ($session->gold <= 2) {
    header("Location: build.php?id=".(int)$_GET['id']);
    exit;
}

$level = (int)$village->resarray['f'.$id];
$totalRes = floor($village->awood + $village->aclay + $village->airon + $village->acrop);
$maxstore = (int)$village->maxstore;
$maxcrop = (int)$village->maxcrop;

// valori prefill din GET
$r = [];
for ($i = 1; $i <= 4; $i++) {
    $r[$i] = isset($_GET['r'.$i])? max(0, (int)$_GET['r'.$i]) : '';
}
$newsum = ($r[1]!=='' && $r[2]!=='' && $r[3]!=='' && $r[4]!=='')? array_sum($r) : 0;
$remain = $totalRes - $newsum;

$wwvillage = $database->getResourceLevel($village->wid);
$isWW = ($wwvillage['f99t'] == 40);
$completed = isset($_GET['c']);
?>
<div id="build" class="gid17">
    <a href="#" onClick="return Popup(17,4);" class="build_logo">
        <img class="building g17" src="img/x.gif" alt="<?php echo MARKETPLACE;?>" title="<?php echo MARKETPLACE;?>" />
    </a>
    <h1><?php echo MARKETPLACE;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc"><?php echo MARKETPLACE_DESC;?></p>

    <?php include("17_menu.tpl");?>

    <?php if ($completed):?>
        <p><b><?php echo NPC_COMPLETED;?>.</b> <?php echo COSTS;?> 3<img src="img/x.gif" class="gold" alt="<?php echo GOLD;?>" title="<?php echo GOLD;?>" /></p>
        <a href="javascript: history.go(-2)"><?php echo BACK_BUILDING;?></a>

    <?php else:?>
        <p><?php echo NPC_TRADE_DESC;?></p>

        <script language="JavaScript">
        var overall;
        function calculateRes() {
            resObj=document.getElementsByName("m2");
            overall=0;
            for (i=0; i<resObj.length; i++) {
                var tmp="";
                for (j=0; j<resObj[i].value.length; j++)
                    if ((resObj[i].value.charAt(j)>="0") && (resObj[i].value.charAt(j)<="9")) tmp=tmp+resObj[i].value.charAt(j);
                resObj[i].value=tmp;
                if (tmp=="") tmp="0";
                newRes=Math.round(parseInt(tmp)*summe/100);
                if (((i<3) && (newRes<=max123)) || ((i==3) && (newRes<=max4)))
                    newHTML=newRes;
                else
                    newHTML="<span class='corr'>"+newRes+"</span>";
                document.getElementById("new"+i).innerHTML=newHTML;
                overall+=parseInt(tmp);
            }
            document.getElementById("overall").innerHTML=overall+"%";
        }
        function normalize() { calculateRes(); resObj=document.getElementsByName("m2"); for (i=0; i<resObj.length; i++) { tmp=parseInt(resObj[i].value); tmp=tmp*(100/overall); resObj[i].value=Math.round(tmp); } calculateRes(); }
        function calculateRest() {
            resObj=document.getElementsByName("m2[]"); overall=0;
            for (i=0; i<resObj.length; i++) {
                var tmp=""; for (j=0; j<resObj[i].value.length; j++) if ((resObj[i].value.charAt(j)>="0") && (resObj[i].value.charAt(j)<="9")) tmp=tmp+resObj[i].value.charAt(j);
                if (tmp=="") { tmp="0"; newRes=0; resObj[i].value=""; } else { newRes=parseInt(tmp); if ((i<3) && (newRes>max123)) newRes=max123; if ((i==3) && (newRes>max4)) newRes=max4; resObj[i].value=newRes; }
                dif=newRes-parseInt(document.getElementById("org"+i).innerHTML); newHTML=dif; if (dif>0) newHTML="+"+dif; document.getElementById("diff"+i).innerHTML=newHTML; overall+=newRes;
            }
            document.getElementById("newsum").innerHTML=overall; rest=parseInt(document.getElementById("org4").innerHTML)-overall; document.getElementById("remain").innerHTML=rest; testSum();
        }
        function fillup(nr) { resObj=document.getElementsByName("m2[]"); if (nr<3) { resObj[nr].value=max123; } else { resObj[nr].value=max4; } calculateRest(); }
        function portionOut() { /*... cod original neschimbat... */ restRes=parseInt(document.getElementById("remain").innerHTML); rest=restRes; resObj=document.getElementsByName("m2[]"); nullCount=0; notNullCount=0; for (j=0; j<resObj.length; j++) { if ((restRes>0) && (resObj[j].value=="")) nullCount++; if ((restRes<0) && (resObj[j].value!="")) notNullCount++; } nullCount2=0; if (restRes>0) { if (nullCount==0) { for (i=0; i<resObj.length; i++) { free=max123-parseInt(resObj[i].value); resObj[i].value=(parseInt(resObj[i].value)+Math.round(rest/(4-i))); rest=rest-Math.min(free,Math.round(rest/(4-i))); if ((i<3) && (parseInt(resObj[i].value)<max123)) nullCount2++; } } else { for (i=0; i<resObj.length; i++) { if (resObj[i].value=="") { resObj[i].value=Math.round(rest/nullCount); rest=rest-Math.round(rest/nullCount); nullCount--; } if ((i<3) && (parseInt(resObj[i].value)<max123)) nullCount2++; } } } else { for (j=0; j<resObj.length; j++) { if (parseInt(resObj[j].value)>0) { resObj[j].value=(parseInt(resObj[j].value)+Math.round(rest/notNullCount)); rest=rest-Math.round(rest/notNullCount); notNullCount--; } } } calculateRest(); if (rest>0) { if (max123>max4) { for (j=0; j<3; j++) { if (parseInt(resObj[j].value)<max123) { resObj[j].value=(parseInt(resObj[j].value)+Math.round(rest/nullCount2)); rest=rest-Math.round(rest/nullCount2); nullCount2--; } } } else { resObj[3].value=(parseInt(resObj[3].value)+rest); } } calculateRest(); }
        function testSum() { if (document.getElementById("remain").innerHTML!=0) { document.getElementById("submitText").innerHTML="<a href='javascript:portionOut();'><?php echo DISTRIBUTE_RESOURCES;?></a>"; document.getElementById("submitText").style.display="block"; document.getElementById("submitButton").style.display="none"; } else { document.getElementById("submitText").innerHTML=""; document.getElementById("submitText").style.display="none"; document.getElementById("submitButton").style.display="block"; } }
        </script>
        <script language="JavaScript">var summe=<?php echo $totalRes;?>;var max123=<?php echo $maxstore;?>;var max4=<?php echo $maxcrop;?>;</script>

        <?php if (!$isWW):?>
        <form method="post" name="snd" action="build.php">
            <input type="hidden" name="id" value="<?php echo (int)$id;?>" />
            <input type="hidden" name="ft" value="mk3" />
            <input type="hidden" name="t" value="3" />

            <table id="npc" cellpadding="1" cellspacing="1">
                <thead>
                    <tr><th colspan="5"><?php echo NPC_TRADE;?></th></tr>
                    <tr>
                        <?php $resData = [
                            ['wood', $village->awood, 'r1', LUMBER],
                            ['clay', $village->aclay, 'r2', CLAY],
                            ['iron', $village->airon, 'r3', IRON],
                            ['crop', $village->acrop, 'r4', CROP],
                        ];
                        foreach ($resData as $idx => $rd):?>
                        <td class="all">
                            <a href="javascript:fillup(<?php echo $idx;?>);"><img class="<?php echo $rd[2];?>" src="img/x.gif" alt="<?php echo $rd[3];?>" title="<?php echo $rd[3];?>" /></a>
                            <span id="org<?php echo $idx;?>"><?php echo floor($rd[1]);?></span>
                        </td>
                        <?php endforeach;?>
                        <td class="sum"><?php echo SUM;?>:&nbsp;<span id="org4"><?php echo $totalRes;?></span></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php for ($i = 0; $i < 4; $i++):
                            $val = $r[$i+1]!== ''? $r[$i+1] : '';
                            $orig = floor($resData[$i][1]);
                       ?>
                        <td class="sel">
                            <input class="text" onkeyup="calculateRest();" name="m2[]" size="5" maxlength="7" value="<?php echo $val;?>" />
                            <input type="hidden" name="m1[]" value="<?php echo $orig;?>" />
                        </td>
                        <?php endfor;?>
                        <td class="sum"><?php echo SUM;?>:&nbsp;<span id="newsum"><?php echo $newsum;?></span></td>
                    </tr>
                    <tr>
                        <?php for ($i = 0; $i < 4; $i++):?>
                        <td class="rem"><span id="diff<?php echo $i;?>"><?php echo 0 - floor($resData[$i][1]);?></span></td>
                        <?php endfor;?>
                        <td class="sum"><?php echo REST;?>:&nbsp;<span id="remain"><?php echo $remain;?></span></td>
                    </tr>
                </tbody>
            </table>

            <p id="submitButton">
                <?php if ($session->userinfo['gold'] >= 3):?>
                    <a href="javascript:document.snd.submit();"><?php echo TRADE_RESOURCES;?></a>
                    <span class="none">(<?php echo COSTS;?>: <img src="img/x.gif" class="gold_g" alt="<?php echo GOLD;?>" title="<?php echo GOLD;?>" /><b>3</b>)</span>
                <?php else:?>
                    <span class="none"><?php echo TRADE_RESOURCES;?></span> (<?php echo COSTS;?>: <img src='img/x.gif' class='gold' alt='<?php echo GOLD;?>' title='<?php echo GOLD;?>' /><b>3</b>)
                <?php endif;?>
            </p>
            <p id="submitText"></p>
        </form>
        <script>testSum();</script>

        <?php else:?>
            <br /><br /><?php echo YOU_CAN_NAT_NPC_WW;?>
        <?php endif;?>

    <?php endif;?>
</div>