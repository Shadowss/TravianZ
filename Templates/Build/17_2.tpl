<div id="build" class="gid17"><a href="#" onClick="return Popup(17,4);" class="build_logo">  
    <img class="building g17" src="img/x.gif" alt="Marketplace" title="<?php echo MARKETPLACE;?>" />  
</a>  
<h1><span class="level"><?php echo MARKETPLACE;?> <?php echo LEVEL;?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo MARKETPLACE_DESC;?></p>  
  
<?php include("17_menu.tpl"); ?> 
<form method="POST" action="build.php">  
    <input type="hidden" name="id" value="<?php echo $id; ?>" />  
    <input type="hidden" name="ft" value="mk2" />  
  
    <table id="sell" cellpadding="1" cellspacing="1">  
        <tr>  
            <th><?php echo OFFERING;?></th>  
            <td class="val"><input class="text" tabindex="1" name="m1" value="" maxlength="6" /></td>  
            <td class="res">  
                <select name="rid1" tabindex="2" class="dropdown">  
                    <option value="1" selected="selected"><?php echo LUMBER;?></option>  
                    <option value="2"><?php echo CLAY;?></option>  
                    <option value="3"><?php echo IRON;?></option>  
                    <option value="4"><?php echo CROP;?></option>  
                </select>  
            </td>  
            <td class="tra"><input class="check" type="checkbox" tabindex="5" name="d1" value="1" /> <?php echo MAX_TIME_TRANSPORT;?>: <input class="text" tabindex="6" name="d2" value="2" maxlength="2" /> <?php echo HOURS;?></td> 
        </tr>  
        <tr>  
            <th><?php echo SEARCHING;?></th>  
            <td class="val"><input class="text" tabindex="3" name="m2" value="" maxlength="6" /></td>  
            <td class="res">  
                <select name="rid2" tabindex="4" class="dropdown">  
                    <option value="1"><?php echo LUMBER;?></option>  
                    <option value="2" selected="selected"><?php echo CLAY;?></option>  
                    <option value="3"><?php echo IRON;?></option>  
                    <option value="4"><?php echo CROP;?></option>  
                </select>  
            </td>  
            <td class="al"> 
                <?php  
                    if($session->userinfo['alliance'] != 0) 
                    { 
                        echo "<input class=\"check\" type=\"checkbox\" tabindex=\"7\" name=\"ally\" value=\"1\" /> ".OWN_ALLIANCE_ONLY.""; 
                    } 
                ?>  
            </td> 
        </tr>  
    </table> 

    <?php 
        if(isset($_GET['e1'])) 
        { 
            echo "<p class=\"error2\">".NOT_ENOUGH_RESOURCES."</p>"; 
        } 
        elseif(isset($_GET['e2'])) 
        { 
            echo "<p class=\"error2\">".INVALID_OFFER."</p>"; 
        } 
        elseif(isset($_GET['e3'])) 
        { 
            echo "<p class=\"error2\">".NOT_ENOUGH_MERCHANTS."</p>"; 
        } 
        else 
        { 
            echo "<p>Merchants: ".$market->merchantAvail()."/".$market->merchant."</p>"; 
        } 
    ?> 
    <input type="image" tabindex="8" value="ok" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" <?php //if(!$market->merchantAvail()) { echo "DISABLED"; }?>/></p> 
</form> 
<?php 
if(count($market->onmarket) > 0) 
{ 
    echo "<table id=\"sell_overview\" cellpadding=\"1\" cellspacing=\"1\"><thead><tr><th colspan=\"7\">".OWN_OFFERS."</th></tr><tr><td>&nbsp;</td><td>".OFFER."</td><td>ratio</td><td>".SEARCH."</td><td>".MERCHANT."</td><td>".ALLIANCE."</td><td>".DURATION."</td></tr></thead><tbody>"; 
    foreach($market->onmarket as $offer) 
    { 
        if($session->access != BANNED) 
        { 
            echo "<tr><td class=\"abo\"><a href=\"build.php?id=$id&t=2&a=5&del=".$offer['id']."\"><img class=\"del\"src=\"img/x.gif\" alt=\"Delete\" title=\"".DELETE."\" /></a></td>"; 
            echo "<td class=\"val\">"; 
        } 
        else 
        { 
            echo "<tr><td class=\"abo\"><a href=\"banned.php\"><img class=\"del\"src=\"img/x.gif\" alt=\"Delete\" title=\"".DELETE."\" /></a></td>"; 
            echo "<td class=\"val\">"; 
        } 
        switch($offer['gtype']) 
        { 
            case 1: echo "<img src=\"img/x.gif\" class=\"r1\" alt=\"Wood\" title=\"".LUMBER."\" />"; break; 
            case 2: echo "<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"".CLAY."\" />"; break; 
            case 3: echo "<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"".IRON."\" />"; break; 
            case 4: echo "<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"".CROP."\" />"; break; 
        } 
        echo $offer['gamt']; 
		$sss = ($offer['wamt']/$offer['gamt']);
		$ratio = round($sss, 1);
		if($ratio <= 1){
			$class = 'red';
		}elseif($ratio > 1 && $ratio < 2){
			$class = 'orange';
		}elseif($ratio >= 2){
			$class = 'green';
		}
		echo "</td><td class=\"ratio\"> ".$ratio." </td> <td class=\"val\">";
        switch($offer['wtype']) 
        { 
            case 1: echo "<img src=\"img/x.gif\" class=\"r1\" alt=\"Wood\" title=\"".LUMBER."\" />"; break; 
            case 2: echo "<img src=\"img/x.gif\" class=\"r2\" alt=\"Clay\" title=\"".CLAY."\" />"; break; 
            case 3: echo "<img src=\"img/x.gif\" class=\"r3\" alt=\"Iron\" title=\"".IRON."\" />"; break; 
            case 4: echo "<img src=\"img/x.gif\" class=\"r4\" alt=\"Crop\" title=\"".CROP."\" />"; break; 
        } 
        echo $offer['wamt']; 
        echo "</td><td class=\"tra\">".$offer['merchant']." </td><td class=\"al\">"; 
        echo ($offer['alliance'] == 0)? 'No' : 'Yes'; 
        echo "</td><td class=\"dur\">"; 
        if($offer['maxtime'] != 0) 
        { 
            echo $offer['maxtime']/3600; 
            echo " hrs."; 
        } 
        else 
        { 
            echo "".ALL.""; 
        } 
        echo "</td></tr>"; 
    } 
    echo "</table>"; 
} 
?> 
</div>
