<?php
// 26_menu.tpl - PALACE / MENU
global $id;

$current = $_GET['s'] ?? '';
$menu = [
    ''  => TRAIN,
    '2' => CULTURE_POINTS,
    '3' => LOYALTY,
    '4' => EXPANSION,
];
?>
<div id="textmenu">
<?php 
$first = true;
foreach ($menu as $s => $label):
    if (!$first) echo ' | ';
    $first = false;
    
    $url = 'build.php?id='.(int)$id.($s !== '' ? '&amp;s='.$s : '');
    $selected = ($current === (string)$s) ? ' class="selected"' : '';
?>
    <a href="<?php echo $url;?>"<?php echo $selected;?>><?php echo $label;?></a>
<?php endforeach; ?>
</div>