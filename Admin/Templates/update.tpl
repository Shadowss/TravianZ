<?php
if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");
include('ver.tpl');
if(isset($_GET['c']))
{
	copy("http://travian.gamingcrazy.net/Update/update_latest.tpl", "Templates/update_latest.tpl");
}
include('update_latest.tpl');
if(isset($_GET['u']))
{
	for ($dl=$ver+1; $dl<=$latest; $dl++)
	{
		$file = "http://travian.gamingcrazy.net/Update/$dl.zip";
		$newfile = "update.zip";
		if (!copy($file, $newfile)) 
		{
				echo "Update Files of Version $dl were not found.";
		}
		else
		{
			$zip = new ZipArchive;
			if ($zip->open('update.zip') === TRUE) 
			{
				$zip->extractTo('../');
				$zip->close();
				unlink('update.zip');
				echo "Successfully Updated to Version $dl ";;
			} 
			else 	
			{
				echo 'Failed to update to Version $dl';
			}
		}
	}
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
			<td class="hab" colspan="1"><font color="red"><?php include('ver.tpl'); echo "$ver"; ?></font></td>
		</tr>
		<tr>
			<td class="hab" colspan="2">Latest Version :</td>
			<td class="hab" colspan="1"><font color="red"><?php echo "$latest"; ?></font></td> 
		</tr>
		<tr>
			<td class="hab" colspan="2">Check for Update</td>
			<td class="hab" colspan="1"><center><a href="http://travian.gamingcrazy.net/TravianZ/Admin/admin.php?p=update&c"><img src="../img/admin/b/ok1.gif"></a></center></td>
		</tr>
		<tr>
		<td class="hab" colspan="2">Update</td>
		<td class="hab" colspan="1"><?php
			if($latest > $ver)
			{
				echo'<center><a href="http://travian.gamingcrazy.net/TravianZ/Admin/admin.php?p=update&u"><img src="../img/admin/b/update.png"></a></center>'; 
			} 
			else
			{ 
				echo "No updates Avaiable";
			}
			?></td>
		</tr>			
	</tbody>
</table>