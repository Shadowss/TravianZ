<?php
if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");
include_once('ver.tpl');
if(isset($_GET['c']))
{
copy("http://travian.gamingcrazy.net/Update/update_latest.tpl", "Templates/update_latest.tpl");
}
if(isset($_GET['u']))
{
	$dl=$ver+1;
	$file = "http://travian.gamingcrazy.net/Update/$dl.zip";
	$newfile = "update.zip";
	if (!copy($file, $newfile)) 
	{
    		echo "Failed Update";
	}
	$zip = new ZipArchive;
	if ($zip->open('update.zip') === TRUE) 
	{
	    $zip->extractTo('../');
	    $zip->close();
	    unlink('update.zip');
	    header("Location: admin.php?p=update&s");
	} else 	{echo 'Update Failed';}
}
?>
<table id="member" cellpadding="1" cellspacing="1" >
		<thead>
			<tr>
				<th colspan="3">System Updates</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="hab" colspan="2">Current Version :</td>
				<td class="hab" colspan="1"><font color="red"><?php echo "$ver"; ?></font></td>
			</tr>
			<tr>
				<td class="hab" colspan="2">Latest Version :</td>
				<td class="hab" colspan="1"><font color="red"><?php include('update_latest.tpl'); echo "$latest" ?></font></td> 
			</tr>
			<tr>
				<td class="hab" colspan="2">Check for Update</td>
				<td class="hab" colspan="1"><center><a href="?p=update&c"><img src="../img/admin/b/ok1.gif"></a></center></td>
			</tr>
			<tr>
			<td class="hab" colspan="2">Update</td>
			<td class="hab" colspan="1"><?php
				if(isset($_GET['s']))
				{echo '<font color="red">Update Success</font>';}
				elseif($latest > $ver) 
				{echo'<center><a href="?p=update&u"><img src="../img/admin/b/update.png"></a></center>'; } 
				else { echo "No updates Avaiable";}?></td>
			</tr>
			<tr>
				<td class="hab" colspan="2">Visit Forum</td>
				<td class="hab" colspan="1"><center><a href="http://travian.gamingcrazy.net/forum/"><img src="../img/admin/b/ok1.gif"></a></center></td>
			</tr>
		</tbody>
	</table><br /><br />
	<p><font color="red">Guys don`t forget to register at the forum to receive information of the updates"</font></p>