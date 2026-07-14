<?php
#################################################################################
#  Regenerates css/hero_items.css from GameEngine/Data/hero_items.php so the   #
#  sprite grid can never drift from the catalog. Run from the repo root:       #
#      php var/tools/generate_hero_sprites.php                                  #
#  Grid contract: img/hero/items.png is a 16-column sheet of 32x32 cells in    #
#  CATALOG ORDER. Replace the PNG with real art on the same grid and rerun     #
#  nothing - only rerun this script when the CATALOG changes.                  #
#################################################################################
define('TB_PREFIX', 'x');
include __DIR__ . '/../../GameEngine/Data/hero_items.php';

$cell = 48; $cols = 16; $idx = 0;
$css = "/* AUTO-GENERATED from GameEngine/Data/hero_items.php - regenerate via var/tools/generate_hero_sprites.php\n"
     . "   Placeholder art: replace img/hero/items.png with real 48x48 sprites on the SAME grid\n"
     . "   (16 columns, catalog order) and this CSS keeps working unchanged. */\n"
     . ".heroT4Item{display:inline-block;width:48px;height:48px;vertical-align:middle;\n"
     . "  background-image:url('../img/hero/items.png');background-repeat:no-repeat;}\n\n"
     . "/* Dedicated dorf1/Rally Point movement icons for hero adventures - separate\n"
     . "   from the shared img.att2/img.def1 classes so swapping this art never\n"
     . "   touches the normal raid/reinforcement icons. To change the icon: drop\n"
     . "   your own image at img/hero/adv_out.gif / adv_back.gif - no code edits. */\n"
     . "img.adv_out{background-image:url('../img/hero/adv_out.gif');height:16px;width:16px;}\n"
     . "img.adv_back{background-image:url('../img/hero/adv_back.gif');height:16px;width:16px;}\n";

foreach ($heroItemCatalog as $iid => $def) {
    $x = ($idx % $cols) * $cell;
    $y = intdiv($idx, $cols) * $cell;
    $css .= ".heroT4Item.item{$iid}{background-position:-{$x}px -{$y}px;} /* {$def['name']} */\n";
    $idx++;
}
file_put_contents(__DIR__ . '/../../css/hero_items.css', $css);
echo "css/hero_items.css written: $idx items\n";
