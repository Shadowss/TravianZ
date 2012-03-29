<div id="build" class="gid36"><h1>Vallenzetter <span class="level">Niveau 1</span></h1>
<p class="build_desc">
	<a href="#" onClick="return Popup(36,4, 'gid');"
		class="build_logo"> <img
		class="building g36"
		src="img/x.gif" alt="Vallenzetter"
		title="Vallenzetter" /> </a>
	Met goed verstopte vallen, beschermt de vallenzetter zijn dorp. Onachtzame aanvallers kunnen zo gevangen genomen worden en zijn geen gevaar meer voor het dorp.</p>

<table cellpadding="1" cellspacing="1" id="build_value">
	<tr>
		<th>Actuele maximale aantal</th>

		<td><b>10</b> Vallen</td>
	</tr>
	<tr>
		<th>Maximale aantal bij niveau 2</th>
		<td><b>22</b> Vallen</td>

	</tr>
</table>
<p>Je bezit op het moment <b>0</b> vallen, daarvan zijn er <b>0</b> bezet.</p>
<form method="POST" name="snd" action="build.php"><input type="hidden"
	name="id" value="22" /> <input type="hidden"
	name="z" value="17" /> <input type="hidden" name="a"
	value="2" />

<table cellpadding="1" cellspacing="1" class="build_details">
	<thead>

		<tr>
			<td>Naam</td>
			<td>Aantal</td>
			<td>max</td>
		</tr>
	</thead>
	<tbody>

		<tr>
			<td class="desc">
			<div class="tit"><img class="unit u99" src="img/x.gif"
				alt="Val"
				title="Val" /> <a href="#"
				onClick="return Popup(36,4,'gid');">Vallen</a> <span class="info">(Aanwezig: 0)</span>
			</div>
			<div class="details">
<span><img class="r1" src="img/x.gif"
				alt="Hout" title="Hout" />20|</span><span><img class="r2" src="img/x.gif"
				alt="Klei" title="Klei" />30|</span><span><img class="r3" src="img/x.gif"
				alt="IJzer" title="IJzer" />10|</span><span><img class="r4" src="img/x.gif"
				alt="Graan" title="Graan" />20|</span><span><img class="r5" src="img/x.gif" alt="Graanverbruik"
				title="Graanverbruik" />0|<img class="clock" src="img/x.gif"
				alt="duur" title="duur" />0:10:00</span>

			</div>
			</td>
			<td class="val"><input type="text" class="text" name="t99" value="0"
				maxlength="4"></td>
			<td class="max"><a href="#"
				onClick="document.snd.t99.value=10">(10)</a></td>
		</tr>
	</tbody>
</table>

<p><input type="image" value="ok" name="s1" id="btn_train"
	class="dynamic_img" src="img/x.gif" alt="train" /></p>
</form>
<?php 
include("upgrade.tpl");
?>
</p></div>