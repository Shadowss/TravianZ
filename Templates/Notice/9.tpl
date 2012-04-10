<?php
$archive = $database->getNotice2($_GET['id'], 'archive');
include("".$archive.".tpl"); 
?>