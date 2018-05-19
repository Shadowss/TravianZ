<div id="content"  class="signup"> 

<?php 
if(isset($_GET['id']) && isset($_GET['q'])) { 
$act2=$database->getActivateField($_GET['id'],"act2",0); 
    if($act2==$_GET['q']){ 
    $show='1'; 
    $naam=$database->getActivateField($_GET['id'],"username",0); 
    $email=$database->getActivateField($_GET['id'],"email",0); 

    } 
} 

if(isset($show)){ 
?> 
<h1><img src="img/x.gif" class="anmelden" alt="register for the game"></h1> 
        <h5><img src="img/x.gif" class="img_u05" alt="registration"/></h5> 
            <p> 
                Hello <?php echo $naam; ?>, 
                <br/> 
                <br/> 
                The registration was successful. In the next few minutes you will receive an email with the access information. 
<br /><br /> 
The email will be sent to following address: <span class="important"><?php echo $email; ?></span> 
            </p> 
            <p>In order to activate your account enter the code or click on the link in your email.</p> 
            <div id="activation"> 
                <form action="activate.php" method="post"> 
                    <p class="important"> 
                        Activation code: 
                    </p> 
                    <input class="text" type="text" name="id" maxlength="10" /> 
                    <p> 
                        <input type="image" value="ok" name="s1" src="img/x.gif" id="btn_send" class="dynamic_img" alt="send"/> 
                        <input type="hidden" name="ft" value="a2" /> 
                    </p> 
                </form> 
                </div> 
                <div id="no_mail"> 
                <p> 
                    <a href="activate.php?id=<?php echo $_GET['id']; ?>&amp;c=<?php echo $generator->encodeStr($email,5); ?>"><span class="important">No email received?</span></a>
                </p> 
                <p> 
                    Sometimes the email is moved to the spam folder. For further help click <a href="activate.php?id=<?php echo $_GET['id']; ?>&amp;c=<?php echo $generator->encodeStr($email,5); ?>">here</a> 
                </p> 
            </div> 
            </div> 
        <?php if(START_DATE > date('d.m.y') || START_DATE == date('d.m.y') && START_TIME <= date('H:i')){ ?> 
<br/><center><big>Activation Availble in: </big></center>
<script>
TargetDate = "<?php echo START_DATE; ?> <?php echo START_TIME; ?>";
CountActive = true;
CountStepper = -1;
LeadingZero = true;
DisplayFormat = "%%H%%:%%M%%:%%S%%";
FinishMessage = "START NOW";

function calcage(secs, num1, num2) {
  s = ((Math.floor(secs/num1))%num2).toString();
  if (LeadingZero && s.length < 2)
    s = "0" + s;
  return "" + s + "";
}

function CountBack(secs) {
  if (secs < 0) {
    document.getElementById("cntdwn").innerHTML = FinishMessage;
    return;
  }
  DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs,86400,100000));
  DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs,3600,24));
  DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
  DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));

  document.getElementById("cntdwn").innerHTML = DisplayStr;
  if (CountActive)
    setTimeout("CountBack(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
}

function putspan(backcolor, forecolor) {
  document.write("<div class='activation_time' id='cntdwn'></div>");
}

if (typeof(BackColor)=="undefined")
  BackColor = "white";
if (typeof(ForeColor)=="undefined")
  ForeColor= "black";
if (typeof(TargetDate)=="undefined")
  TargetDate = "12/31/2020 5:00 AM";
if (typeof(DisplayFormat)=="undefined")
  DisplayFormat = "%%H%%:%%M%%:%%S%%";
if (typeof(CountActive)=="undefined")
  CountActive = true;
if (typeof(FinishMessage)=="undefined")
  FinishMessage = "";
if (typeof(CountStepper)!="number")
  CountStepper = -1;
if (typeof(LeadingZero)=="undefined")
  LeadingZero = true;


CountStepper = Math.ceil(CountStepper);
if (CountStepper == 0)
  CountActive = false;
var SetTimeOutPeriod = (Math.abs(CountStepper)-1)*1000 + 990;
putspan(BackColor, ForeColor);
var dthen = new Date(TargetDate);
var dnow = new Date();
if(CountStepper>0)
  ddiff = new Date(dnow-dthen);
else
  ddiff = new Date(dthen-dnow);
gsecs = Math.floor(ddiff.valueOf()/1000);
CountBack(gsecs);

</script>
<?php }}else{ ?> 
            <p> 
                <?php  
                if(START_DATE > date('d.m.y') || START_DATE == date('d.m.y') && START_TIME <= date('H:i')){
				?>
<br/><center><big>Activation Availble in: </big></center>
<script language="JavaScript">
TargetDate = "<?php echo START_DATE; ?> <?php echo START_TIME; ?>";
CountActive = true;
CountStepper = -1;
LeadingZero = true;
DisplayFormat = "%%H%%:%%M%%:%%S%%";
FinishMessage = "START NOW";

function calcage(secs, num1, num2) {
  s = ((Math.floor(secs/num1))%num2).toString();
  if (LeadingZero && s.length < 2)
    s = "0" + s;
  return "" + s + "";
}

function CountBack(secs) {
  if (secs < 0) {
    document.getElementById("cntdwn").innerHTML = FinishMessage;
    return;
  }
  DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs,86400,100000));
  DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs,3600,24));
  DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
  DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));

  document.getElementById("cntdwn").innerHTML = DisplayStr;
  if (CountActive)
    setTimeout("CountBack(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
}

function putspan(backcolor, forecolor) {
  document.write("<div class='activation_time' id='cntdwn'></div>");
}

if (typeof(BackColor)=="undefined")
  BackColor = "white";
if (typeof(ForeColor)=="undefined")
  ForeColor= "black";
if (typeof(TargetDate)=="undefined")
  TargetDate = "12/31/2020 5:00 AM";
if (typeof(DisplayFormat)=="undefined")
  DisplayFormat = "%%H%%:%%M%%:%%S%%";
if (typeof(CountActive)=="undefined")
  CountActive = true;
if (typeof(FinishMessage)=="undefined")
  FinishMessage = "";
if (typeof(CountStepper)!="number")
  CountStepper = -1;
if (typeof(LeadingZero)=="undefined")
  LeadingZero = true;


CountStepper = Math.ceil(CountStepper);
if (CountStepper == 0)
  CountActive = false;
var SetTimeOutPeriod = (Math.abs(CountStepper)-1)*1000 + 990;
putspan(BackColor, ForeColor);
var dthen = new Date(TargetDate);
var dnow = new Date();
if(CountStepper>0)
  ddiff = new Date(dnow-dthen);
else
  ddiff = new Date(dthen-dnow);
gsecs = Math.floor(ddiff.valueOf()/1000);
CountBack(gsecs);

</script>
<?php       
}else{ ?> 
            <div id="activation"> 
                <form action="activate.php" method="post"> 
                    <p class="important"> 
                        Activation code: 
                    </p> 
                    <input class="text" type="text" name="id" maxlength="10" /> 
                    <p> 
                        <input type="image" value="ok" name="s1" src="img/x.gif" id="btn_send" class="dynamic_img" alt="send"/> 
                        <input type="hidden" name="ft" value="a2" /> 
                    </p> 
                     
                </form> <?php } ?> 
                </div> 
            </div> 
             
<?php } 
?>