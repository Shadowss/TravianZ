<div id="build" class="gid42"><a href="#" onClick="return Popup(42,4);" class="build_logo">
    <img class="building g42" src="img/x.gif" alt="Great Workshop" title="Great Workshop" />
</a>
<h1>Great Workshop <span class="level">level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">Siege engines like catapults and rams can be built in the great workshop. The higher its level the faster the units are produced.</p>

<?php if ($building->getTypeLevel(42) > 0) { ?>
<form method="POST" name="snd" action="build.php">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <input type="hidden" name="ft" value="t3" />
                <table cellpadding="1" cellspacing="1" class="build_details">
                <thead><tr>
                    <td>Name</td>
                    <td>Quantity</td>
                    <td>Max</td>
                </tr></thead><tbody>
                <?php
                    include("42_train.tpl");
                ?></table>
    <p><input type="image" id="btn_train" class="dynamic_img" value="ok" name="s1" src="img/x.gif" alt="train" /></form></p>
    <?php
    } else {
        echo "<b>Training can commence when great workshop is completed.</b><br>\n";
    }
    $trainlist = $technology->getTrainingList(7);
    if(count($trainlist) > 0) {
        echo "
    <table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\">
        <thead><tr>
            <td>Training</td>
            <td>Duration</td>
            <td>Finished</td>
        </tr></thead>
        <tbody>";
        $TrainCount = 0;
        foreach($trainlist as $train) {
            $TrainCount++;
            echo "<tr><td class=\"desc\">";
            echo "<img class=\"unit u".$train['unit']."\" src=\"img/x.gif\" alt=\"".$train['name']."\" title=\"".$train['name']."\" />";
            echo $train['amt']." ".$train['name']."</td><td class=\"dur\">";
            if ($TrainCount == 1 ) {
                $NextFinished = $generator->getTimeFormat(($train['commence']+$train['eachtime'])-time());
                echo "<span id=timer1>".$generator->getTimeFormat(($train['commence']+($train['eachtime']*$train['amt']))-time())."</span>";
            } else {
                echo $generator->getTimeFormat($train['eachtime']*$train['amt']);
            }
            echo "</td><td class=\"fin\">";
            $time = $generator->procMTime($train['commence']+($train['eachtime']*$train['amt']));
            if($time[0] != "today") {
                echo "on ".$time[0]." at ";
            }
            echo $time[1];
        } ?>
        </tr><tr class="next"><td colspan="3">The next unit will be finished in <span id="timer2"><?php echo $NextFinished; ?></span></td></tr>
        </tbody></table>
    <?php }
include("upgrade.tpl");
?>
</p></div>