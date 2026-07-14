<table class="results defender" cellpadding="1" cellspacing="1">
				<thead>
					<tr>
						<td class="role">
							Defender
						</td><td>
								<img src="img/x.gif" class="unit u71" title="<?php echo U71; ?>" alt="<?php echo U71; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u72" title="<?php echo U72; ?>" alt="<?php echo U72; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u73" title="<?php echo U73; ?>" alt="<?php echo U73; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u74" title="<?php echo U74; ?>" alt="<?php echo U74; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u75" title="<?php echo U75; ?>" alt="<?php echo U75; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u76" title="<?php echo U76; ?>" alt="<?php echo U76; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u77" title="<?php echo U77; ?>" alt="<?php echo U77; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u78" title="<?php echo U78; ?>" alt="<?php echo U78; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u79" title="<?php echo U79; ?>" alt="<?php echo U79; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u80" title="<?php echo U80; ?>" alt="<?php echo U80; ?>" />

							</td></tr>
				</thead>
				<tbody>
					<tr>
						<th>
							Troops
						</th>
                                <td <?php if (!$form->getValue('a2_71')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_71');} ?></td>
                                <td <?php if (!$form->getValue('a2_72')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_72');} ?></td>
                                <td <?php if (!$form->getValue('a2_73')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_73');} ?></td>
                                <td <?php if (!$form->getValue('a2_74')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_74');} ?></td>
                                <td <?php if (!$form->getValue('a2_75')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_75');} ?></td>
                                <td <?php if (!$form->getValue('a2_76')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_76');} ?></td>
                                <td <?php if (!$form->getValue('a2_77')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_77');} ?></td>
                                <td <?php if (!$form->getValue('a2_78')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_78');} ?></td>
                                <td <?php if (!$form->getValue('a2_79')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_79');} ?></td>
                                <td <?php if (!$form->getValue('a2_80')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_80');} ?></td>
                  </tr>
					<tr>
						<th>
							Casualties
						</th>
                        <td <?php if (!$troops = $form->getValue('a2_71')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_72')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_73')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_74')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_75')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_76')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_77')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_78')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_79')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_80')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        </tr>
				</tbody>
			</table>
