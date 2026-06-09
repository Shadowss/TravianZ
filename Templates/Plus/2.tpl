<?php
include("Templates/Plus/pmenu.tpl");

$plusFeatures = [
    ['title'=>'Waiting loop for constructions', 'img'=>'p1', 'text'=>'The waiting loop enables you to give your builders another order to raise or extend a second building. After completing their first task and a short break (60s), they will start to take care of this second job.'],
    ['title'=>'Larger map', 'img'=>'xxl_map', 'text'=>'You can enlarge the map to get a better overview. Instead of 7x7 fields you can have a map of 13x13 fields. Other alliances which are allied or have a non-aggression pact (NAP) with you are shown in special colours.'],
    ['title'=>'Archive function for reports and messages', 'img'=>'p5', 'text'=>'Important reports and messages can be archived and thereby be looked up faster. Additionally, you can choose several messages or reports and archive or delete them at once.'],
    ['title'=>'Sorting function for reports and messages', 'img'=>'sort', 'text'=>'By clicking the table heading "Sent" you can reverse the sorting of reports and messages. If you get many messages a day and need to look up older ones you are able to do so very fast with this function. It can also be used in the archives.'],
    ['title'=>'Sorting function for the marketplace', 'img'=>'p6', 'text'=>'To use the marketplace more efficiently, you can filter the offers for certain resources only. Additionally you can use a ratio filter to only see 1:1 offers.'],
    ['title'=>'Auto-completion', 'img'=>'autovv', 'text'=>'By using the auto-completion you can easily "write" a whole village name by using very few figures. Depending on your preferences you can use this function in any combination for own villages, villages of alliance members or villages of your surroundings.'],
    ['title'=>'Report filter', 'img'=>'bfilter', 'text'=>'Thanks to the report filter unwanted reports concerning marketplace transactions are a problem of the past. Depending on your personal preferences you can easily switch off reports concerning trades from/to other villages or between your own villages.'],
    ['title'=>'Freely definable direct links', 'img'=>'p7', 'text'=>'Thanks to these links, you can reach every page you want with just one click. Just create a link to every destination you want and get directly to your alliance\'s overview, to your barracks or to the tempting 1:1 biddings at the marketplace.'],
    ['title'=>'Graphical statistics', 'img'=>'st1', 'text'=>'These statistics show you the chronological development of your account, e.g. the ranking, your army\'s strength or your population\'s development.'],
    ['title'=>'Central account overview', 'img'=>'dorf3', 'text'=>'Anyone who reigns over several villages might easily miss something going on within his realm: where are those troops I built, are all my workers at work or are some of them lazy, do I lose resources because one of my warehouses isn\'t big enough? Just take a look at your central village overview and you can check out all your villages at once.'],
    ['title'=>'Notepad', 'img'=>'p8', 'text'=>'Paper and pencil aren\'t always at hand. In order to make you don\'t forget important things or if you simply want to make a few notes, use your notebook.'],
];

$goldFeatures = [
    ['title'=>'Production bonus for lumber', 'img'=>'p1_25', 'text'=>'With this Gold advantage all your villages\' lumber production will be increased by 25%.<br><br>The bonus will not be added to the single resource fields but to the sum of the production.'],
    ['title'=>'Production bonus for clay', 'img'=>'p2_25', 'text'=>'With this Gold advantage all your villages\' clay production will be increased by 25%.<br><br>The bonus will not be added to the single resource fields but to the sum of the production.'],
    ['title'=>'Production bonus for iron', 'img'=>'p3_25', 'text'=>'With this Gold advantage all your villages\' iron production will be increased by 25%.<br><br>The bonus will not be added to the single resource fields but to the sum of the production.'],
    ['title'=>'Production bonus for crop', 'img'=>'p4_25', 'text'=>'With this Gold advantage all your villages\' crop production will be increased by 25%.<br><br>The bonus will not be added to the single resource fields but to the sum of the production.'],
    ['title'=>'Complete construction orders & research immediately.', 'img'=>'bau0', 'text'=>'In the current village all construction orders and research in the academy as well as the blacksmith and armoury will be completed immediately.<br><br>However, the <i>buildings</i> Residence and Palace and <i>'.VILLAGES.'</i> with a wonder of the world inside them are excluded.'],
    ['title'=>'NPC Merchant', 'img'=>'npc', 'text'=>'The NPC Merchant will exchange any desired amount of resources in a village with other resources at a ratio of 1:1.'],
];
?>
<table id="plus_features" class="features" cellpadding="1" cellspacing="1">
<thead><tr><th colspan="2"><?php echo TZ_FEATURES_OF_TRAVIAN; ?> <span class="plus_g">P</span><span class="plus_o">l</span><span class="plus_g">u</span><span class="plus_o">s</span></th></tr></thead>
<tbody>
<tr><td colspan="2" class="empty"></td></tr>
<?php foreach($plusFeatures as $f): ?>
<tr><th colspan="2"><?= $f['title'] ?></th></tr>
<tr>
    <td class="preview"><a href="plus.php?id=3"><img class="<?= $f['img'] ?>" src="img/x.gif" alt="<?= $f['title'] ?>" /></a></td>
    <td class="text"><?= $f['text'] ?></td>
</tr>
<tr><td colspan="2" class="empty"></td></tr>
<?php endforeach; ?>
</tbody></table>

<table id="gold_features" class="features" cellpadding="1" cellspacing="1">
<thead><tr><th colspan="2"><?php echo TZ_FEATURES_OF_TRAVIAN; ?> <font color="#71D000">G</font><font color="#FF6F0F">o</font><font color="#71D000">l</font><font color="#FF6F0F">d</font></th></tr></thead>
<tbody>
<tr><td colspan="2" class="empty"></td></tr>
<?php foreach($goldFeatures as $f): ?>
<tr><th colspan="2"><?= $f['title'] ?></th></tr>
<tr>
    <td class="preview"><a href="plus.php?id=3"><img class="<?= $f['img'] ?>" src="img/x.gif" alt="<?= $f['title'] ?>" /></a></td>
    <td class="text"><?= $f['text'] ?><br><br><span style="color:#F00"><?php echo TZ_THIS_FEATURE_IS_NOT_INCLUDED_IN_TH; ?></span></td>
</tr>
<tr><td colspan="2" class="empty"></td></tr>
<?php endforeach; ?>
</tbody></table>
</div>