<h1><img class="point" src="img/x.gif" alt="" title="" /> <?php echo DIRECT_LINKS; ?></h1>

		<p>With the direct links one can set links to any target and speed up the navigation.</p>
		<table id="examples" cellpadding="1" cellspacing="1">
			<thead><tr>
				<th colspan="2">example for direct links</th>
			</tr>
			<tr>
				<td><?php echo LINK_NAME; ?></td>
				<td><?php echo LINK_TARGET; ?></td>
			</tr></thead>
			<tbody><tr>
				<th><?php echo BARRACKS; ?></th>
				<td>build.php?gid=19</td>
			</tr>
			<tr>
				<th><?php echo MARKETPLACE; ?></th>
				<td>build.php?gid=17</td>
			</tr>
			<tr>
				<th><?php echo RALLYPOINT; ?></th>
				<td>build.php?gid=16</td>
			</tr>
			<tr>
				<th><?php echo NOTES; ?></th>
				<td>nachrichten.php?t=4*</td>
			</tr></tbody>
		</table>
		<p>Adding an * to the URL will cause the direct link to open in a new window.</p>
<map id="nav" name="nav">
    <area href="manual.php?s=1" title="<?php echo BACK; ?>" coords="0,0,45,18" shape="rect" alt="" />
    <area href="manual.php?s=1" title="<?php echo OVERVIEW; ?>" coords="46,0,70,18" shape="rect" alt="" />
    <area href="manual.php?s=1" title="forward" coords="71,0,116,18" shape="rect" alt="" />
</map>
<img usemap="#nav" src="img/x.gif" class="navi" alt="" />