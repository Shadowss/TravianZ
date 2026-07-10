<?php
#################################################################################
#  T4 hero mansion tab navigation (37_t4nav.tpl) - Phase 6                      #
#  Included by 37.tpl with $t4tab set to 'hero'|'items'|'adventures'|'auction'. #
#  Silver balance shown on the right; reuses existing anchor styling.          #
#################################################################################

$t4HeroItems  = new HeroItems();
$t4Silver     = $t4HeroItems->getSilver($session->uid);
$t4Tabs = [
    'hero'       => ['label' => HERO_T4_TAB_HERO,       'url' => 'build.php?id=' . $id],
    'items'      => ['label' => HERO_T4_TAB_ITEMS,      'url' => 'build.php?id=' . $id . '&t4tab=items'],
    'adventures' => ['label' => HERO_T4_TAB_ADVENTURES, 'url' => 'build.php?id=' . $id . '&t4tab=adventures'],
    'auction'    => ['label' => HERO_T4_TAB_AUCTION,    'url' => 'build.php?id=' . $id . '&t4tab=auction'],
];
?>
<link rel="stylesheet" href="css/hero_items.css" type="text/css">
<div class="heroT4Nav" style="margin:6px 0 10px 0;">
    <?php foreach ($t4Tabs as $key => $tab) { ?>
        <?php if ($key === $t4tab) { ?>
            <span style="font-weight:bold;margin-right:14px;"><?php echo $tab['label']; ?></span>
        <?php } else { ?>
            <a href="<?php echo $tab['url']; ?>" style="margin-right:14px;"><?php echo $tab['label']; ?></a>
        <?php } ?>
    <?php } ?>
    <span style="float:right;"><b><?php echo HERO_SILVER; ?>:</b> <?php echo number_format($t4Silver); ?></span>
    <div style="clear:both;"></div>
</div>
