<?php include("templates/script.tpl");

if(!isset($_GET['s'])) {
	$_GET['s']=0;
}
?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>TravianX Installation</title>
	<link rel="shortcut icon" href="favicon.ico" />
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="content-type" content="text/html; charset=us-ascii" />
	<script src="mt-full.js?0ac36" type="text/javascript"></script>
	<script src="unx.js?0ac36" type="text/javascript"></script>
	<script src="new.js?0ac36" type="text/javascript"></script>
	<link href="../gpack/travian_default/lang/en/lang.css?f4b7c" rel="stylesheet" type="text/css" />
	<link href="../gpack/travian_default/lang/en/compact.css?f4b7c" rel="stylesheet" type="text/css" />
	<link href="../gpack/travian_default/travian.css?e21d2" rel="stylesheet" type="text/css" />
	<link href="../gpack/travian_default/lang/en/lang.css?e21d2" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="wrapper">
		<img class="c1" src="img/x.gif" id="msfilter" alt="" name="msfilter" />

		<div id="dynamic_header"></div>

		<div id="header">
			<div id="mtop"></div>
		</div>

		<div id="mid">
			<div id="side_navi">
				<?php include("templates/menu.tpl"); ?>
			</div>

				<div id="content" class="login">
					<?php
					IHG_Progressbar::draw_css();
					$bar = new IHG_Progressbar(7, 'Step %d from %d ');
					$bar->draw();
					for($i = 0; $i < ($_GET['s']+1); $i++) {
						$bar->tick();
					}
					?>
				<div class="headline"><center>
				<span class="f18 c5">TravianX Installation Script</span>
				</center></div>

				<?php
				if(substr(sprintf('%o', fileperms('../')), -4)<'700'){
					echo"<span class='f18 c5'>ERROR!</span><br />It's not possible to write the config file. Change the permission to '777'. After that, refresh this page!";
				} else
					switch($_GET['s']){
						case 0:
						include("templates/greet.tpl");
						break;
						case 1:
						include("templates/config.tpl");
						break;
						case 2:
						include("templates/dataform.tpl");
						break;
						case 3:
						include("templates/field.tpl");
						break;
						case 4:
						include("templates/multihunter.tpl");
						break;
						case 5:
						include("templates/oasis.tpl");
						break;
						case 6:
						include("templates/end.tpl");
						break;
					}
				?>

			<div id="side_info" class="outgame"></div>

			<div class="clear"></div>
		</div>

		<div class="footer-stopper outgame"></div>

		<div class="clear"></div>

<?php include("../Templates/footer.tpl"); ?>
	</div>

	<div id="ce"></div>
</body>
</html>