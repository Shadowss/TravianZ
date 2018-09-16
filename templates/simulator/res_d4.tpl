<table class="results defender" cellpadding="1" cellspacing="1">
				<thead>
					<tr>

						<td class="role">
							Defender
						</td><td>
								<img src="img/x.gif" class="unit u31" title="Rat" alt="Rat" />
							</td><td>

								<img src="img/x.gif" class="unit u32" title="Spider" alt="Spider" />
							</td><td>
								<img src="img/x.gif" class="unit u33" title="Snake" alt="Snake" />
							</td><td>
								<img src="img/x.gif" class="unit u34" title="Bat" alt="Bat" />
							</td><td>
								<img src="img/x.gif" class="unit u35" title="Wild Boar" alt="Wild Boar" />
							</td><td>
								<img src="img/x.gif" class="unit u36" title="Wolf" alt="Wolf" />

							</td><td>
								<img src="img/x.gif" class="unit u37" title="Bear" alt="Bear" />
							</td><td>
								<img src="img/x.gif" class="unit u38" title="Crocodile" alt="Crocodile" />
							</td><td>
								<img src="img/x.gif" class="unit u39" title="Tiger" alt="Tiger" />
							</td><td>
								<img src="img/x.gif" class="unit u40" title="Elephant" alt="Elephant" />
							</td></tr>
				</thead>
				<tbody>
					<tr>
						<th>

							Troops
						</th>
                                <td <?php if (!$form->getValue('a2_31')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_31');} ?></td>
                                <td <?php if (!$form->getValue('a2_32')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_32');} ?></td>
                                <td <?php if (!$form->getValue('a2_33')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_33');} ?></td>
                                <td <?php if (!$form->getValue('a2_34')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_34');} ?></td>
                                <td <?php if (!$form->getValue('a2_35')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_35');} ?></td>
                                <td <?php if (!$form->getValue('a2_36')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_36');} ?></td>
                                <td <?php if (!$form->getValue('a2_37')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_37');} ?></td>
                                <td <?php if (!$form->getValue('a2_38')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_38');} ?></td>
                                <td <?php if (!$form->getValue('a2_39')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_39');} ?></td>
                                <td <?php if (!$form->getValue('a2_40')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_40');} ?></td>
                                </tr>
					<tr>

						<th>
							Casualties
						</th>
						</th>
                        <td <?php if (!$troops = $form->getValue('a2_31')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_32')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_33')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_34')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_35')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_36')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_37')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_38')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_39')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_40')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        </tr>

				</tbody>
			</table>
