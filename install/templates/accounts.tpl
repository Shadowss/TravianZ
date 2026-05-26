<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : accounts.tpl                                              ##
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

if(isset($_GET['err']) && $_GET['err'] == 1) {
    echo '<div class="card" style="background:#fef2f2;border-color:#fecaca;color:#991b1b;margin-bottom:14px;">At least Multihunter & Support password are required.</div>';
}
if(isset($_GET['err']) && $_GET['err'] == 2) {
    echo '<div class="card" style="background:#fef2f2;border-color:#fecaca;color:#991b1b;margin-bottom:14px;">Natars is reserved. Choose different admin username.</div>';
}
?>
<form action="include/accounts.php" method="post" id="dataform">
  <div class="grid-2">
    <div class="card">
      <span class="f10 c">Multihunter account</span>
      <div style="margin-top:12px;display:grid;gap:10px;">
        <div><label>Name</label><input class="input" type="text" value="Multihunter" disabled></div>
        <div><label>Password</label><input class="input" type="password" name="mhpw" required></div>
      </div>
    </div>
    <div class="card">
      <span class="f10 c">Support account</span>
      <div style="margin-top:12px;display:grid;gap:10px;">
        <div><label>Name</label><input class="input" type="text" value="Support" disabled></div>
        <div><label>Password</label><input class="input" type="password" name="spw" required></div>
      </div>
    </div>
  </div>

  <div class="card">
    <span class="f10 c">Admin account</span>
    <div class="grid-2" style="margin-top:12px;">
      <div><label>Admin name</label><input class="input" name="aname"></div>
      <div><label>Admin email</label><input class="input" name="aemail" type="email"></div>
      <div><label>Admin password</label><input class="input" name="apass" type="password"></div>
      <div><label>Tribe</label>
        <select class="input" name="atribe">
          <option value="1" selected>Romans</option>
          <option value="2">Teutons</option>
          <option value="3">Gauls</option>
        </select>
      </div>
      <div><label>Show in stats</label>
        <select class="input" name="admin_rank">
          <option value="true">true</option>
          <option value="false" selected>false</option>
        </select>
      </div>
      <div><label>Include Support Msgs</label>
        <select class="input" name="admin_support_msgs">
          <option value="true" selected>true</option>
          <option value="false">false</option>
        </select>
      </div>
      <div><label>Allow Raidable</label>
        <select class="input" name="admin_raidable">
          <option value="true" selected>true</option>
          <option value="false">false</option>
        </select>
      </div>
    </div>
    <p style="color:#64748b;font-size:12px;margin-top:12px;">Note: leave empty if you want to skip admin creation.</p>
    <div style="text-align:center;margin-top:12px;">
      <button class="btn" type="submit">Create Accounts</button>
    </div>
  </div>
</form>