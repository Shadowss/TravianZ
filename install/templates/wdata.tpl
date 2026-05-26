<?php 

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : wdata.tpl                                                 ##
##  Type           : Install Panel Frontend & Backend                          ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki (Original)                                          ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2025. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

include_once('../GameEngine/config.php');
if (isset($_GET['c']) && $_GET['c'] == '1') {
    echo '<div class="card" style="background:#fef2f2;border-color:#fecaca;color:#991b1b;">Error creating wdata. Check configuration or file.</div>';
}
if (isset($_GET['err']) && $_GET['err'] == '1') {
    echo '<div class="card" style="background:#fef2f2;border-color:#fecaca;color:#991b1b;">Existing World Data found! Empty tables <i>'.TB_PREFIX.'odata, '.TB_PREFIX.'units, '.TB_PREFIX.'vdata, '.TB_PREFIX.'wdata</i>.</div>';
}
$autoStartCroppers = isset($_GET['startCroppers']) && $_GET['startCroppers'] === '1';
?>
<form action="process.php" method="post" id="dataform">
  <input type="hidden" name="subwdata" value="1" />
  <div class="card">
    <span class="f10 c">Create World Data</span>
    <p style="color:#475569;"><b>Warning</b>: This can take some time. Please wait until the next page has been loaded.</p>
    
    <div id="submitWrap" style="display:<?php echo $autoStartCroppers?'none':'block';?>;text-align:center;">
      <button class="btn" id="Submit" onclick="return proceed()">Create World...</button>
    </div>

    <div id="progressBox" style="display:<?php echo $autoStartCroppers?'block':'none';?>;">
      <div style="font-weight:600;margin:10px 0;">Building croppers…</div>
      <div style="background:#e5e7eb;border-radius:999px;overflow:hidden;height:12px;max-width:600px;">
        <div id="pbar" style="background:linear-gradient(90deg,#f59e0b,#f97316);height:100%;width:0%;transition:width .2s;"></div>
      </div>
      <div id="pinfo" style="margin-top:6px;font-size:13px;color:#475569;">Starting…</div>
      <pre id="plog" style="margin-top:10px;background:#0f172a;color:#e2e8f0;border-radius:10px;padding:10px;font-size:12px;max-height:200px;overflow:auto;"></pre>
      <div id="autoNext" style="display:none;margin-top:10px;color:#166534;font-weight:600;">Proceeding to next step in <b id="cd">3</b>…</div>
    </div>
  </div>
</form>
<script><?php include('wdata_js_here_if_needed'); ?></script>
<!-- păstrezi scriptul tău JS de mai jos exact cum era -->
<script>
(function () {
  var NEXT_URL = 'index.php?s=4'; var COUNTDOWN_SECS = 3; var finished = false;
  function startCountdown(){var box=document.getElementById('autoNext'),cd=document.getElementById('cd'),left=COUNTDOWN_SECS;box.style.display='block';cd.textContent=left;var t=setInterval(function(){left--;cd.textContent=left;if(left<=0){clearInterval(t);window.location.href=NEXT_URL}},1000)}
  function startCroppersBuild(){var box=document.getElementById('progressBox'),pbar=document.getElementById('pbar'),pinfo=document.getElementById('pinfo'),plog=document.getElementById('plog'),submitWrap=document.getElementById('submitWrap');if(submitWrap)submitWrap.style.display='none';box.style.display='block';if(!('EventSource'in window)){plog.textContent+="Browser no SSE\n";return}var MAX=3,retries=0,es=new EventSource('ajax_croppers.php');es.onopen=function(){if(!finished&&retries>0){plog.textContent+="Reconnected\n"}};es.onmessage=function(e){if(!e.data||e.data.charCodeAt(0)!==123)return;try{var d=JSON.parse(e.data),pct=d.pct|0,done=d.done|0,total=d.total|0;if(finished)return;retries=0;pbar.style.width=pct+'%';pinfo.textContent=done+' / '+total+' ('+pct+'%)';if(d.msg){plog.textContent+=d.msg+"\n";plog.scrollTop=plog.scrollHeight}if(pct>=100){finished=true;plog.textContent+="✅ Completed!\n";es.close();startCountdown()}if(d.error){finished=true;plog.textContent+="❌ "+(d.msg||"Error")+"\n";es.close();startCountdown()}}catch(err){}};es.onerror=function(){if(finished)return;retries++;plog.textContent+="⚠ hiccup ("+retries+"/"+MAX+")\n";if(retries>=MAX){finished=true;plog.textContent+="❌ Too many failures\n";es.close();startCountdown()}}}
  document.addEventListener('DOMContentLoaded',function(){<?php if($autoStartCroppers){echo 'startCroppersBuild();';} ?>});
})();
</script>