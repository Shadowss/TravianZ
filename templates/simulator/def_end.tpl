<tbody>
		<tr>
			<th>Other</th>

		</tr>
		<tr>
			<td class="details">
				<table cellpadding="1" cellspacing="1">
					<tr>
					    <td class="ico"><img src="img/x.gif" class="unit uhab" alt="Population" title="Population" /></td>
					    <td class="desc">Population</td>
					    <td class="value"><input class="text" type="text" name="ew2" value="<?php echo $form->getValue('ew2')==""? 1 : $form->getValue('ew2'); ?>" maxlength="4" title="number Population" /></td>

					    <td class="research"></td>
				    </tr>
					<tr>
					    <td class="ico"><img src="img/x.gif" class="unit upal" alt="Stonemason's Lodge" title="Stonemason's Lodge" /></td>
					    <td class="desc" title="Stonemason's Lodge">Stonemason's Lodge</td>
					    <td class="value"><input class="text" type="text" name="stonemason" value="<?php echo $form->getValue('stonemason')==""? 0 : $form->getValue('stonemason'); ?>" maxlength="2" title="Level Stonemason's Lodge" /></td>
					    <td class="research"></td>
				    </tr>
                    <?php
                    if(in_array(1,$target)) {
					if(isset($_POST['wall1']) && $_POST['wall1'] != 0){
					$wall1 = $_POST['wall1'];
					}else{
					$wall1 = 0;
					}
                    echo "<tr>
						    <td class=\"ico\"><img src=\"img/x.gif\" class=\"unit uwall\" alt=\"City Wall\" title=\"City Wall\" /></td>
						    <td class=\"desc\">City Wall</td>
						    <td class=\"value\"><input class=\"text\" type=\"text\" name=\"wall1\" value=\"$wall1\" maxlength=\"2\" title=\"level City Wall\" /></td>
						    <td class=\"research\"></td>
				    	</tr>";
                    }
                    if(in_array(2,$target)) {
					if(isset($_POST['wall2']) && $_POST['wall2'] != 0){
					$wall2 = $_POST['wall2'];
					}else{
					$wall2 = 0;
					}
                    echo "<tr>
						    <td class=\"ico\"><img src=\"img/x.gif\" class=\"unit ubarr\" alt=\"Earth Wall\" title=\"Earth Wall\" /></td>

						    <td class=\"desc\">Earth Wall</td>
						    <td class=\"value\"><input class=\"text\" type=\"text\" name=\"wall2\" value=\"$wall2\" maxlength=\"2\" title=\"level Earth Wall\" /></td>
						    <td class=\"research\"></td>
					    </tr>";
                    }
                    if(in_array(3,$target)) {
					if(isset($_POST['wall3']) && $_POST['wall3'] != 0){
						$wall3 = $_POST['wall3'];
					}else{
					$wall3 = 0;
					}
                    echo "<tr>
						    <td class=\"ico\"><img src=\"img/x.gif\" class=\"unit ustock\" alt=\"Palisade\" title=\"Palisade\" /></td>
						    <td class=\"desc\">Palisade</td>
						    <td class=\"value\"><input class=\"text\" type=\"text\" name=\"wall3\" value=\"$wall3\" maxlength=\"2\" title=\"level Palisade\" /></td>
						    <td class=\"research\"></td>

					    </tr>";
                    }
                    ?>
                        <tr>
					    <td class="ico"><img src="img/x.gif" class="unit upal" alt="Palace" title="Palace" /></td>
					    <td class="desc" title="Palace/Residence">Palace</td>
					    <td class="value"><input class="text" type="text" name="palast" value="<?php echo $form->getValue('palast')==""? 0 : $form->getValue('palast'); ?>" maxlength="2" title="level Palace" /></td>
					    <td class="research"></td>
				    </tr>
				    <tr>
						<td class="ico"><img src="img/x.gif" class="unit uhero" title="Hero" alt="Hero" /></td>
						<td class="desc">Hero (def bonus)</td>
						<td class="value"><input class="text" type="text" name="h_def_bonus" value="<?php echo $form->getValue('h_def_bonus')==""? 0 : $form->getValue('h_def_bonus'); ?>" maxlength="4" title="Hero (def bonus)" /></td>
						<td class="research"></td>
				    </tr>
					
					
				</table>
			</td>
		</tr></tbody></table>
