<div style="background:#fff8e6; border:1px solid #ffcc80; color:#333; padding:12px 16px; margin:12px 0; border-radius:10px; display:flex; justify-content:space-between; align-items:center; font-size:14px;">
    <div>
        <i class="fa fa-exclamation-triangle" style="color:#e67e22; margin-right:6px;"></i>
        The account will be deleted in 
        <strong style="color:#e67e22;"><?php echo $delTime; ?></strong>
    </div>
    <a href="?p=player&uid=<?php echo $user['id']; ?>&action=StopDel" 
       onclick="return confirm('Cancel deletion for <?php echo $user['username']; ?>?');"
       title="Cancel deletion"
       style="background:#e74c3c; color:#fff; text-decoration:none; padding:6px 10px; border-radius:6px; font-weight:bold;">
       ✖ Cancel
    </a>
</div>