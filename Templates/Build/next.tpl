<?php
// next.tpl - calculează offset-ul pentru nivelul următor
global $building, $database, $village, $id;

$loopsame = ($building->isCurrent($id) || $building->isLoop($id)) ? 1 : 0;
$doublebuild = ($building->isCurrent($id) && $building->isLoop($id)) ? 1 : 0;
$master = count($database->getMasterJobsByField($village->wid, $id));
?>