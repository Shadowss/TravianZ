<tbody>
		<tr>
			<th><?php echo TZ_OTHER; ?></th>

		</tr>
		<tr>
			<td class="details">
				<table cellpadding="1" cellspacing="1">
					<tr>
					    <td class="ico"><img src="img/x.gif" class="unit uhab" alt="<?php echo POP; ?>" title="<?php echo POP; ?>" /></td>
					    <td class="desc"><?php echo POP; ?></td>
					    <td class="value"><input class="text" type="text" name="ew2" value="<?php echo $form->getValue('ew2')==""? 1 : $form->getValue('ew2'); ?>" maxlength="4" title="<?php echo TZ_NUMBER; ?> <?php echo POP; ?>" /></td>

					    <td class="research"></td>
				    </tr>
					<tr>
					    <td class="ico"><img src="img/x.gif" class="unit upal" alt="<?php echo TZ_STONEMASON_S_LODGE; ?>" title="<?php echo TZ_STONEMASON_S_LODGE; ?>" /></td>
					    <td class="desc" title="<?php echo TZ_STONEMASON_S_LODGE; ?>"><?php echo TZ_STONEMASON_S_LODGE; ?></td>
					    <td class="value"><input class="text" type="text" name="stonemason" value="<?php echo $form->getValue('stonemason')==""? 0 : $form->getValue('stonemason'); ?>" maxlength="2" title="<?php echo LEVEL; ?> <?php echo TZ_STONEMASON_S_LODGE; ?>" /></td>
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
					    <td class="ico"><img src="img/x.gif" class="unit upal" alt="<?php echo PALACE; ?>" title="<?php echo PALACE; ?>" /></td>
					    <td class="desc" title="<?php echo TZ_PALACE_RESIDENCE; ?>"><?php echo PALACE; ?></td>
					    <td class="value"><input class="text" type="text" name="palast" value="<?php echo $form->getValue('palast')==""? 0 : $form->getValue('palast'); ?>" maxlength="2" title="<?php echo LEVEL; ?> <?php echo PALACE; ?>" /></td>
					    <td class="research"></td>
				    </tr>
				    <tr>
						<td class="ico"><img src="img/x.gif" class="unit uhero" title="<?php echo U0; ?>" alt="<?php echo U0; ?>" /></td>
						<td class="desc"><?php echo TZ_HERO_DEF_BONUS; ?></td>
						<td class="value"><input class="text" type="text" name="h_def_bonus" value="<?php echo $form->getValue('h_def_bonus')==""? 0 : $form->getValue('h_def_bonus'); ?>" maxlength="4" title="<?php echo TZ_HERO_DEF_BONUS; ?>" /></td>
						<td class="research"></td>
				    </tr>
					
					
				</table>
			</td>
		</tr></tbody></table>
