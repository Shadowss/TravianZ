<?php 
if($_GET['search_in']){
if(!$_GET['sort']){$sort = $_GET['search_in'];}
else{
$sort = $_GET['sort'];
}
$search = $database->search($_GET['search'],$_GET['search_in'],$sort);
}

?>
<form action="" method="get">
<input type="hidden" name="page" value="2">
<table id="member" >
<thead>
<tr><th colspan="3">
Search
</th></tr>
</thead>
<tbody>
<tr>                   
<td>    
<select class="dropdown" name="search_in">
<option value="player" <?php if($_GET['search_in']=="player"){echo "selected";}?>>Search player</option>
<option value="village" <?php if($_GET['search_in']=="village"){echo "selected";}?>>Search villages</option>
<option value="alliance" <?php if($_GET['search_in']=="alliance"){echo "selected";}?>>Search alliances</option>
<option value="email" <?php if($_GET['search_in']=="email"){echo "selected";}?>>Search E-Mail addresses</option>
<option value="ip" <?php if($_GET['search_in']=="ip"){echo "selected";}?>>Search Ips</option>
<option value="del_players" <?php if($_GET['search_in']=="del_players"){echo "selected";}?>>Search deleted players</option>
</select>
</td>
<td>
<input type="text" class="text" name="search" value="<?php echo $_GET['search'];?>">
</td>
<td>
<input class="text" type="submit" value="Search">
</td>
</tr>
</tbody>
</table>
</form>
<br>
<?php
if($_GET['search'] or $_GET['search_in']){
  include('Templates/Admin/backup/results.tpl');
}
?>