<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : cleanban.tpl                                              ##
##  Type           : Admin Panel Frontend                                      ##
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
?>
<style>
.clean-card{max-width:480px;margin:12px auto;background:#fff;border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;font-family:system-ui}
.clean-head{background:#0f172a;color:#fff;padding:10px 14px;font-weight:600;font-size:14px}
.clean-body{display:flex;justify-content:space-between;align-items:center;padding:14px}
.clean-desc{font-size:13.5px;color:#334155}
.clean-desc strong{color:#dc2626}
.clean-btn{padding:8px 14px;background:#dc2626;color:#fff;border:0;border-radius:6px;font-size:13px;font-weight:500;cursor:pointer;display:flex;align-items:center;gap:6px}
.clean-btn:hover{background:#b91c1c}
.clean-btn svg{width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2}
</style>

<form action="../GameEngine/Admin/Mods/mainteneceCleanBanData.php" method="POST" onsubmit="return confirm('TRUNCATE banlist? This cannot be undone!')">
<input type="hidden" name="admid" value="<?=$_SESSION['id']?>">
<div class="clean-card">
  <div class="clean-head">Clear – Banlist - Data</div>
  <div class="clean-body">
    <div class="clean-desc">Clean Banlist Data <strong>(TRUNCATE)</strong></div>
    <button type="submit" class="clean-btn">
      <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>Clean
    </button>
  </div>
</div>
</form>