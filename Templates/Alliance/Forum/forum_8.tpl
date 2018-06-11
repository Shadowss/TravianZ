<?php
############################################################
##              DO NOT REMOVE THIS NOTICE                 ##
##                    MADE BY TTMTT                       ##
##                     FIX BY RONIX                       ##
##                       TRAVIANZ                         ##
############################################################

$forumData = reset($database->ForumCatEdit($_GET['idf']));
if(empty($forumData) || ($forumData['alliance'] == 0 && $session->access != ADMIN) ||
  ($forumData['alliance'] > 0 && ($forumData['alliance'] != $session->alliance ||
  (!$opt['opt5'] && $session->access != ADMIN)))) $alliance->redirect($_GET);

$users = $alliances = [];

$cat_name = stripslashes($forumData['forum_name']);
$cat_des = stripslashes($forumData['forum_des']);
if(!empty($forumData['display_to_alliances'])) $alliances = explode(',', $forumData['display_to_alliances']);
if(!empty($forumData['display_to_users'])) $users = explode(',', $forumData['display_to_users']);
?>
<script type="text/javascript">

    function addRow(element_id) {
    	// element_id: user_list, ally_list

    	liste = document.getElementById(element_id);
    	liste = liste.getElementsByTagName('tbody')[0];

    	var anzahl_trs = liste.getElementsByTagName('tr').length;
    	var num_fields = anzahl_trs;
    	var num_last_tr = anzahl_trs -1;

    	lastTR = liste.getElementsByTagName('tr')[num_last_tr];
		lastTD = lastTR.getElementsByTagName('td')[2];
		lastIMG = lastTD.getElementsByTagName('img')[0];
		lastTD.removeChild(lastIMG);

    	newTR = document.createElement('tr');
    	newTD1 = document.createElement('td');
    	newTD2 = document.createElement('td');
    	newTD3 = document.createElement('td');
    	newTR.appendChild(newTD1);
    	newTR.appendChild(newTD2);
    	newTR.appendChild(newTD3);
    	liste.appendChild(newTR);

		var html_input_1 = '<input class="text" type="text" ';

		if(element_id == 'ally_list') {
			newTD1.className = 'ally';
			newTD2.className = 'tag';
			newTD3.className = 'ad';
			newTD1.innerHTML = html_input_1 + 'id="allys_by_id_'+num_fields+'" class="text" maxlength="8" name="allys_by_id['+num_fields+']" onkeyup="checkInputs('+num_fields+',\'allys\')">';
			newTD2.innerHTML = html_input_1 + 'id="allys_by_name_'+num_fields+'" class="text" maxlength="8" name="allys_by_name['+num_fields+']" onkeyup="checkInputs('+num_fields+',\'allys\')">';
		}

		if(element_id == 'user_list') {
			newTD1.className = 'id';
			newTD2.className = 'pla';
			newTD3.className = 'ad';
			newTD1.innerHTML = html_input_1 + 'id="users_by_id_'+num_fields+'" class="text" maxlength="8" name="users_by_id['+num_fields+']" onkeyup="checkInputs('+num_fields+',\'users\')">';
			newTD2.innerHTML = html_input_1 + 'id="users_by_name_'+num_fields+'" class="text" maxlength="15" name="users_by_name['+num_fields+']" onkeyup="checkInputs('+num_fields+',\'users\')">';
		}

		newTD3.innerHTML = '<img class="add" src="img/x.gif" title="add" alt="add" onclick="addRow(\''+element_id+'\')">';
    }

</script>
<script language="JavaScript" type="text/javascript">
	
    function checkInputs(id, typ) {
		id_field = document.getElementById(typ+'_by_id_'+id);
		name_field = document.getElementById(typ+'_by_name_'+id);
		
		//alert(id_field.value);
		//alert(name_field.value);
		
		if (id_field.value != '' && id_field.disabled == false) {
			name_field.disabled = true;
			name_field.style.border = '1px solid #999';
		}
		else {
			name_field.disabled = false;
			name_field.style.border = '1px solid #71D000';
		}
		
		if (name_field.value != '' && name_field.disabled == false) {
			id_field.disabled = true;
			id_field.style.border = '1px solid #999';
		}
		else {
			id_field.disabled = false;
			id_field.style.border = '1px solid #71D000';
		}
	}
    
	</script><form method="post" action="allianz.php?s=2">
<input type="hidden" name="s" value="2">
<input type="hidden" name="fid" value="<?php echo $_GET['idf']; ?>">
<input type="hidden" name="editforum" value="1">

<table cellpadding="1" cellspacing="1" id="edit_forum"><thead>
	<tr>
    	<th colspan="2">edit forum</th>
	</tr>
	</thead><tbody>
	<tr>
		<th>Forum name</th>

		<td><input class="text" type="text" name="u1" value="<?php echo $cat_name; ?>" maxlength="30"></td>
	</tr>

	<tr>
		<th>Description</th>
		<td><input class="text" type="text" name="u2" value="<?php echo $cat_des; ?>" maxlength="38"></td>
	</tr>
</table>
<?php if($forumData['forum_area'] != 1){ ?>
<table cellpadding="1" cellspacing="1" id="ally_list"><thead>
	<tr>

        <th colspan="3">Open for more alliances</th>
	</tr>
	<tr>
		<td>Alliance ID</td>
		<td>Tag:</td>
		<td>Add</td>
	</tr>

	</thead><tbody>
	<?php for($i = 0; $i < count($alliances); $i++){?>
	<tr>
		<td class="ally">
			<input class="text" type="text" id="allys_by_id_<?php echo $i; ?>" disabled="disabled" maxlength="15" name="allys_by_id[<?php echo $i; ?>]" onkeyup="checkInputs(<?php echo $i; ?>,'allys');" />
		</td>
		<td class="tag">
			<input class="text" type="text" id="allys_by_name_<?php echo $i; ?>" value="<?php echo $database->getAlliance($alliances[$i])['tag']; ?>" maxlength="15" name="allys_by_name[<?php echo $i; ?>]" onkeyup="checkInputs(<?php echo $i; ?>,'allys');" />
		</td>
		<td class="ad"></td>
	</tr>
	<?php } ?>
	<tr>
		<td class="ally">
			<input class="text" type="text" id="allys_by_id_<?php echo $i; ?>" name="allys_by_id[<?php echo $i; ?>]" maxlength="15" onkeyup="checkInputs(<?php echo $i; ?>,'allys');" />
		</td>
		<td class="tag">
			<input class="text" type="text" id="allys_by_name_<?php echo $i; ?>" name="allys_by_name[<?php echo $i; ?>]" maxlength="15" onkeyup="checkInputs(<?php echo $i; ?>,'allys');" />
		</td>
		<td class="ad">
			<img class="add" src="img/x.gif" title="add" alt="add" onclick="addRow('ally_list')" />
		</td>
	</tr>
</table><table cellpadding="1" cellspacing="1" id="user_list"><thead>
	<tr>
        <th colspan="3">Open forum for the following players</th>
	</tr>
	<tr>
		<td>User ID</td>
		<td>Name:</td>
		<td>Add</td>
	</tr>
	</thead><tbody>
	<?php for($i = 0; $i < count($users); $i++){?>
	<tr>
		<td class="id">
			<input class="text" type="text" id="users_by_id_<?php echo $i; ?>" disabled="disabled" name="users_by_id[<?php echo $i; ?>]" maxlength="15" onkeyup="checkInputs(<?php echo $i; ?>,'users');" />
		</td>

		<td class="pla">
			<input class="text" type="text" id="users_by_name_<?php echo $i; ?>" value="<?php echo $database->getUserField($users[$i], 'username', 0); ?>" name="users_by_name[<?php echo $i; ?>]" maxlength="50" onkeyup="checkInputs(<?php echo $i; ?>,'users');" />
		</td>
		<td class="ad"></td>
	</tr>
	<?php } ?>
	<tr>
		<td class="id">
			<input class="text" type="text" id="users_by_id_<?php echo $i; ?>" maxlength="15" name="users_by_id[<?php echo $i; ?>]" onkeyup="checkInputs(<?php echo $i; ?>,'users');" />
		</td>

		<td class="pla">
			<input class="text" type="text" id="users_by_name_<?php echo $i; ?>" maxlength="50" name="users_by_name[<?php echo $i; ?>]" onkeyup="checkInputs(<?php echo $i; ?>,'users');" />
		</td>
		<td class="ad">
			<img class="add" src="img/x.gif" title="add" alt="add" onclick="addRow('user_list')" />
		</td>
	</tr>
</tbody></table>

<script type="text/javascript">
	showCheckList();
</script>
<?php } ?>
<p class="btn"><input type="image" value="ok" name="s1" id="fbtn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></p></form>