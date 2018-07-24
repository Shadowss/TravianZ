<?php
if(!isset($_GET['id'])){ $_GET['id']='1'; }
?>
<table cellpadding="1" cellspacing="1" id="search_navi">
					<tr>						
						<td>
							<form method="post" action="statistiken.php?id=<?php echo isset($_GET['id'])? $_GET['id'] : 1; ?>">	
							<div class="search">											
								<span>rank<input type="text" class="text ra" maxlength="5" name="rank" value="<?php echo ($search == 0)? $start : $search; ?>" /></span>
								<span class="or">or</span>
								<span>name<input type="text" class="text name" maxlength="30" name="name" value="<?php if(!is_numeric($search)) {echo $search; } ?>" /></span>
                                <input type="hidden" name="ft" value="r<?php echo isset($_GET['id'])? $_GET['id'] : 1; ?>" />
								<button value="submit" name="submit" id="btn_ok" class="trav_buttons" alt="OK" /> Ok </button>
							</div>
							</form>
							<div class="navi">
<?php
if(count($rankArray) < 22){
    echo "&laquo; back | forward &raquo;";
}else if($start != 1 && $start + 20 < count($rankArray)) {
    echo "<a href=\"statistiken.php?id=".$_GET['id']."&amp;rank=".($start - 20)."\">&laquo; back</a> | <a href=\"statistiken.php?id=".$_GET['id']."&amp;rank=".($start + 20)."\">forward &raquo;</a>";
}else if($start == 1 && $start + 20 < count($rankArray)) {
    echo "&laquo; back | <a href=\"statistiken.php?id=".$_GET['id']."&amp;rank=".($start + 20)."\">forward &raquo;</a>";
}else if($start != 1 && $start - 20 < count($rankArray)) {
    echo "<a href=\"statistiken.php?id=".$_GET['id']."&amp;rank=".($start - 20)."\">&laquo; back</a> | forward &raquo;";
}
?>
