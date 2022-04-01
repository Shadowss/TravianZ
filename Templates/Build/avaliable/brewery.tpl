<h2><?php echo BREWERY ?></h2> 
<table class="new_building" cellpadding="1" cellspacing="1"> 
    <tbody><tr> 
        <td class="desc"><?php echo BREWERY_DESC ?></td> 
        <td rowspan="3" class="bimg"> 
            <a href="#" onClick="return Popup(19,4);"> 
            <img class="building g35" src="img/x.gif" alt="Brewery" title="Brewery" /></a> 
        </td> 
    </tr> 
    <tr> 
        <?php 
        $_GET['bid'] = 35; 
        include("availupgrade.tpl"); 
        ?> 
    </tr> 
</table>