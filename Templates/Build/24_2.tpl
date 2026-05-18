<?php
// 24_2.tpl - TOWNHALL TIMER
global $database, $village, $generator, $session;

$timeleft = (int)$database->getVillageField($village->wid, 'celebration');
if ($timeleft > time()):
?>
<br>
<table cellpadding="0" cellspacing="0" id="building_contract">
    <tr>
        <td>celebration still needs:</td>
        <td><span id="timer<?php echo ++$session->timer;?>"><?php echo $generator->getTimeFormat($timeleft - time());?></span> hrs.</td>
        <td>done at <?php echo date('H:i', $timeleft);?></td>
    </tr>
</table>
<?php endif;?>