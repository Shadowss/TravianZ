<?php
////////////// made by TTMTT //////////////
if(!isset($aid)) $aid = $session->alliance;

$allianceinfo = $database->getAlliance($aid);
echo "<h1>".$allianceinfo['tag']." - ".$allianceinfo['name']."</h1>";
include("alli_menu.tpl"); 


?>

<script type="text/javascript">
<?php sajax_show_javascript();?>
function show_data_cb(text) { document.getElementById("masnun").innerHTML = text; }
function start_it() { x_get_data(show_data_cb); setTimeout("start_it()",1000); }
function add_cb() {}
function send_data() {
//alert( document.form1.msg.value);
msg = document.form1.msg.value;
//alert(msg);
//x_add_data(name +"|"+msg,add_cb); 
x_add_data(msg,add_cb); 
document.form1.msg.value="";
}

</script>


<body onload="start_it()">
<form name="form1" onSubmit="send_data()">
	<div id="TitleName" class="chatHeader">Ally-Chat</div>
			<div id="chatContainer" style="position:relative; top:0; right:0; height: 220px; width: 500px; overflow: hidden; background-color: #FFF; border: 1px solid #C0C0C0;">
				<div id="masnun" style="position:absolute; top:0; right:5px; width:470px; background-color: #FFF; "></div>
				<div id="scrollbarbackground2" style="position:absolute; top:0; right:481px; width:17px; height:198px;"></div>
				<div id="scrollbarbackground" style="position:absolute; top:0; right:489px; width:1px; height:198px; border-width:1px; border-style:solid; border-color:#71D000;  background-color: #FFF; "></div>
				<div id="scrollbar" style="position:absolute; top:0; right:481px; width:17px; height:198px; border-width:1px; border-style:solid; border-color:#71D000;  background-color: #F0FFF0; "></div>
				<input id="scrollCheckbox" class="fm" checked="checked" type="checkbox" style="position:absolute; top:200px; right:481px; " />
			</div>
			<div style="margin-top:10px; margin-bottom:10px;">
				<table cellpadding="1" cellspacing="1"><tr><td>
				<input name="s" value="6" type="hidden" />
				<input class="text" type="text" name="msg" style="width: 415px;" />
				</td><td>
				<input type="button" src="img/x.gif" id="btn_ok" style="border: 0px; float:left;" alt="ok" onClick="send_data()" />
				</td></tr></table>
			</div>
</form>


</body> 
			<div id="rooms">
			</div>