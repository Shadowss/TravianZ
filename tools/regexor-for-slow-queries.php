<?php
    $src = file_get_contents('regexor-slow.sql');
  
    // we need to replace all escaped quotes or the regex below will go nuts
    $src = str_replace(['\\"', "\\'"], ['[Q1]', '[Q1]'], $src);
    
    $regexes = [
        // the infoline, present on every start of a slow query
        '/(# Time: \d{0,100} \d{0,100}:\d{0,100}:\d{0,100}\n)?# User@Host: [^@]+ @ [^\[]+ \[[^\]]+\]\n# Thread_id: \d{0,100}  Schema: [^ ]*  QC_hit: (Yes|No)\n# Query_time: \d{0,100}.\d{0,100}  Lock_time: \d{0,100}.\d{0,100}  Rows_sent: \d{0,100}  Rows_examined: \d{0,100}\n# Rows_affected: \d{0,100}\nSET timestamp=\d{0,100};\n/',
        
        // no index for full-table-search
        '/SELECT \* FROM [^; ]+;\n/',
        // ... and for these ...
        '/SELECT count\(id\) FROM s1_alidata where id != 0;\n/',
        '/SELECT e.\*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = \d{0,100}( AND e.from !=\d{0,100})?;\n/',
        '/SELECT s1_users.id userid, s1_users.username username, s1_users.oldrank oldrank, s1_users.alliance alliance, \(\n[^A-Za-z]+SELECT SUM\( s1_vdata.pop \)\n[^A-Za-z]+FROM s1_vdata\n[^A-Za-z]+WHERE s1_vdata.owner = userid\n[^A-Za-z]+\)totalpop, \(\n[^A-Za-z]+SELECT COUNT\( s1_vdata.wref \)\n[^A-Za-z]+FROM s1_vdata\n[^A-Za-z]+WHERE s1_vdata.owner = userid AND type != 99\n[^A-Za-z]+\)totalvillages, \(\n[^A-Za-z]+SELECT s1_alidata.tag\n[^A-Za-z]+FROM s1_alidata, s1_users\n[^A-Za-z]+WHERE s1_alidata.id = s1_users.alliance\n[^A-Za-z]+AND s1_users.id = userid\n[^A-Za-z]+\)allitag\n[^A-Za-z]+FROM s1_users\n[^A-Za-z]+WHERE s1_users.access < 8\n[^A-Za-z]+AND s1_users.tribe <= 3\n[^A-Za-z]+AND s1_users.id > 5\n[^A-Za-z]+ORDER BY totalpop DESC, totalvillages DESC, userid DESC;\n/',
        '/SELECT \* FROM s1_medal order by week DESC LIMIT 0, 1;\n/',
        '/SELECT \* FROM s1_vdata WHERE maxstore < \d{0,100} OR maxcrop < \d{0,100};\n/',
        '/SELECT \* FROM s1_vdata WHERE wood > maxstore OR clay > maxstore OR iron > maxstore OR crop > maxcrop;\n/',
        '/SELECT \* FROM s1_vdata WHERE wood < 0 OR clay < 0 OR iron < 0 OR crop < 0;\n/',
        '/SELECT uid FROM s1_deleting where timestamp < 1508874978;\n/',
        '/SELECT \* FROM s1_vdata where starv != 0 and owner != 3;\n/',
        '/SELECT \* FROM s1_vdata where celebration < \d{0,100} AND celebration != 0;\n/',
        '/SELECT \* FROM s1_vdata WHERE loyalty<>100;\n/',
        '/SELECT uid FROM s1_deleting where timestamp < \d{0,100};\n/',
        '/SELECT Count\(\*\) as Total FROM s1_users WHERE timestamp > \d{0,100} AND tribe!=0 AND tribe!=4 AND tribe!=5;\n/',
    ];
    
    echo preg_replace($regexes, '', $src);
?>
