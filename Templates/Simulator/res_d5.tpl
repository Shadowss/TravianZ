<table class="results defender" cellpadding="1" cellspacing="1">
				<thead>
					<tr>
						<td class="role">
							Defender
                        </td><td>
                            <img src="img/x.gif" class="unit u41" title="Pikeman" alt="Pikeman" />
                        </td><td>
                            <img src="img/x.gif" class="unit u42" title="Thorned Warrior" alt="Thorned Warrior" />
                        </td><td>
                            <img src="img/x.gif" class="unit u43" title="Guardsman" alt="Guardsman" />
                        </td><td>
                            <img src="img/x.gif" class="unit u44" title="Birds Of Prey" alt="Birds Of Prey"r" />
                        </td><td>
                            <img src="img/x.gif" class="unit u45" title="Axerider" alt="Axerider" />
                        </td><td>
                            <img src="img/x.gif" class="unit u46" title="Natarian Knight" alt="Natarian Knight" />
                        </td><td>
                            <img src="img/x.gif" class="unit u47" title="War Elephant" alt="War Elephant" />
                        </td><td>
                            <img src="img/x.gif" class="unit u48" title="Ballista" alt="Ballista" />
                        </td><td>
                            <img src="img/x.gif" class="unit u49" title="Natarian Emperor" alt="Natarian Emperor" />
                        </td><td>
                            <img src="img/x.gif" class="unit u50" title="Natarian Settler" alt="Natarian Settler" />
                        </td>
				</thead>
				<tbody>
					<tr>
						<th>

							Troops
						</th>
                                <td <?php if (!$form->getValue('a2_41')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_41');} ?></td>
                                <td <?php if (!$form->getValue('a2_42')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_42');} ?></td>
                                <td <?php if (!$form->getValue('a2_43')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_43');} ?></td>
                                <td <?php if (!$form->getValue('a2_44')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_44');} ?></td>
                                <td <?php if (!$form->getValue('a2_45')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_45');} ?></td>
                                <td <?php if (!$form->getValue('a2_46')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_46');} ?></td>
                                <td <?php if (!$form->getValue('a2_47')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_47');} ?></td>
                                <td <?php if (!$form->getValue('a2_48')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_48');} ?></td>
                                <td <?php if (!$form->getValue('a2_49')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_49');} ?></td>
                                <td <?php if (!$form->getValue('a2_50')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_50');} ?></td>
                                </tr>
					<tr>

						<th>
							Casualties
						</th>
						</th>
                        <td <?php if (!$troops = $form->getValue('a2_41')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_42')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_43')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_44')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_45')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_46')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_47')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_48')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_49')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_50')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        </tr>

				</tbody>
			</table>
