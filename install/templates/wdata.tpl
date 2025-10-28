
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ## 
##  Filename       wdata.tpl                                                   ##
##  Developed by:  Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix   ## 
##  Fixed by:      Shadow - STARVATION , HERO FIXED COMPL.  		       ##
##  Fixed by:      InCube - double troops				       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ## 
##                                                                             ##
#################################################################################

<?php
// install/wdata.tpl

include_once('../GameEngine/config.php');

if (isset($_GET['c']) && $_GET['c'] == '1') {
    echo '<br /><hr /><br /><div class="headline"><span class="f10 c5">Error creating wdata. Check configuration or file.</span></div><br><br>';
}
if (isset($_GET['err']) && $_GET['err'] == '1') {
    echo '<br /><hr /><br /><div class="headline"><span class="f10 c5">Existing World Data found in the database! Please empty tables <i>'
        . TB_PREFIX . 'odata, ' . TB_PREFIX . 'units, ' . TB_PREFIX . 'vdata, ' . TB_PREFIX . 'wdata</i> before continuing.</span></div><br /><br />';
}

$autoStartCroppers = isset($_GET['startCroppers']) && $_GET['startCroppers'] === '1';
?>

<form action="process.php" method="post" id="dataform">
    <input type="hidden" name="subwdata" value="1" />

    <p>
        <span class="f10 c">Create World Data</span>

        <table>
            <tr>
                <td>
                    <b>Warning</b>: This can take some time. Please wait until the next page has been loaded.
                    Click Create to proceed...
                    <br /><br />

                    <!-- Submit block (hidden when autoStartCroppers=1) -->
                    <div id="submitWrap" style="display:<?php echo $autoStartCroppers ? 'none' : 'block'; ?>;">
                        <center>
                            <input type="submit" name="Submit" id="Submit" value="Create..." onClick="return proceed()" />
                            <br /><br />
                        </center>
                    </div>

                    <!-- Progress UI (shown when startCroppers=1) -->
                    <div id="progressBox" style="display:<?php echo $autoStartCroppers ? 'block' : 'none'; ?>; margin-top:20px;">
                        <div style="font-weight:bold;margin-bottom:6px;">Building croppers…</div>

                        <div style="background:#ddd;border-radius:8px;overflow:hidden;height:20px;max-width:500px;">
                            <!-- Orange bar to match Travian vibes -->
                            <div id="pbar" style="background:#f6a21a;height:100%;width:0%;transition:width .2s;"></div>
                        </div>

                        <div id="pinfo" style="margin-top:6px;font-size:13px;color:#333;">Starting…</div>

                        <pre id="plog" style="margin-top:10px;background:#f9f9f9;border:1px solid #ddd;border-radius:8px;padding:8px;font-size:12px;max-height:200px;overflow:auto;"></pre>

                        <!-- Continue button appears on completion -->
						<div id="autoNext" style="display:none;margin-top:10px;">
						  Proceeding to next step in <b id="cd">3</b>…
						</div>
                    </div>

<script>
(function () {
  var NEXT_URL = 'index.php?s=4'; // your next step
  var COUNTDOWN_SECS = 3;
  var finished = false;

  function startCountdown() {
    var box = document.getElementById('autoNext');
    var cdEl = document.getElementById('cd');
    var left = COUNTDOWN_SECS;
    box.style.display = 'block';
    cdEl.textContent = left;
    var t = setInterval(function(){
      left--;
      cdEl.textContent = left;
      if (left <= 0) { clearInterval(t); window.location.href = NEXT_URL; }
    }, 1000);
  }

  function startCroppersBuild() {
    var box  = document.getElementById('progressBox');
    var pbar = document.getElementById('pbar');
    var pinfo= document.getElementById('pinfo');
    var plog = document.getElementById('plog');

    var submitWrap = document.getElementById('submitWrap');
    if (submitWrap) submitWrap.style.display = 'none';
    box.style.display = 'block';

    if (!('EventSource' in window)) {
      plog.textContent += "Your browser does not support live progress.\n";
      return;
    }

    var es = new EventSource('ajax_croppers.php');

    es.onmessage = function (e) {
      // Ignore non-JSON messages (pings / blanks)
      if (!e.data || e.data.charCodeAt(0) !== 123 /* '{' */) return;

      try {
        var d = JSON.parse(e.data);
        var pct   = (d.pct  || 0)|0;
        var done  = (d.done || 0)|0;
        var total = (d.total|| 0)|0;

        // If we've already finished, ignore further events
        if (finished) return;

        pbar.style.width = pct + '%';
        pinfo.textContent = done + ' / ' + total + ' (' + pct + '%)';

        if (d.msg) {
          plog.textContent += d.msg + "\n";
          plog.scrollTop = plog.scrollHeight;
        }

        if (pct >= 100) {
          finished = true;
          plog.textContent += "✅ Completed!\n";
          es.close();
          startCountdown();
        }
      } catch (err) {
        // Silently ignore parsing problems now that we guard by '{'
        // plog.textContent += "Parse error.\n";
      }
    };

    es.onerror = function () {
      // Don’t spam after we’re done; otherwise let EventSource reconnect silently
      if (!finished) {
        plog.textContent += "Connection hiccup, retrying…\n";
      }
    };
  }

  document.addEventListener('DOMContentLoaded', function () {
    <?php if ($autoStartCroppers) { echo 'startCroppersBuild();'; } ?>
  });
})();
</script>

                </td>
            </tr>
        </table>
    </p>
</form>
</div>
