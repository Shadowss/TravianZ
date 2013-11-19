<h5><img src="img/en/t2/newsbox2.gif" alt="newsbox 2"></h5>
<?php

$online = mysql_num_rows(mysql_query("SELECT * FROM " . TB_PREFIX . "users WHERE " . time() . "-timestamp < (60*10) AND tribe!=0 AND tribe!=4 AND tribe!=5"));


?>

<div class="news">
<b><center>Online Users: <?php echo $online ?> </center></b>
</div>
