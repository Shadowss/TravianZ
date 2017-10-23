171023 18:52:02  4315 Connect   root@localhost as anonymous on 
         4315 Init DB   travian
         4315 Query SET NAMES 'UTF8'
         4315 Query SELECT * FROM s1_users where username = 'cyberghost'
         4315 Query SELECT wref from s1_vdata where owner = 6 order by capital DESC,pop DESC
         4315 Query SELECT sit FROM s1_online where uid = 6
         4315 Query SELECT SUM(hero) from s1_enforcement where `from` = 22609
         4315 Query SELECT SUM(hero) from s1_units where `vref` = 22609
         4315 Query SELECT SUM(t11) from s1_prisoners where `from` = 22609
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
         4315 Query SELECT SUM(hero) from s1_enforcement where `from` = 23623
         4315 Query SELECT SUM(hero) from s1_units where `vref` = 23623
         4315 Query SELECT SUM(t11) from s1_prisoners where `from` = 23623
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '23623' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '23623' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
         4315 Query SELECT SUM(hero) from s1_enforcement where `from` = 23036
         4315 Query SELECT SUM(hero) from s1_units where `vref` = 23036
         4315 Query SELECT SUM(t11) from s1_prisoners where `from` = 23036
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '23036' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '23036' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
         4315 Query SELECT dead FROM s1_hero WHERE `uid` = 6
         4315 Query SELECT inrevive FROM s1_hero WHERE `uid` = 6
         4315 Query SELECT intraining FROM s1_hero WHERE `uid` = 6
         4315 Query REPLACE into s1_active values ('cyberghost',1508777522)
         4315 Query UPDATE s1_users set timestamp = '1508777522' where username = 'cyberghost'
         4315 Query REPLACE into s1_active values ('cyberghost',1508777522)
         4315 Query UPDATE s1_users set timestamp = 1508777522 where username = 'cyberghost'
         4315 Query SELECT * FROM s1_mdata WHERE target IN(6, 1) and send = 0 and archived = 0 ORDER BY time DESC
         4315 Query SELECT * FROM s1_mdata WHERE owner IN(6, 1) ORDER BY time DESC
         4315 Query SELECT * FROM s1_mdata WHERE target IN(6, 1) and send = 0 and archived = 0 and deltarget = 0 ORDER BY time DESC
         4315 Query SELECT * FROM s1_mdata WHERE owner IN(6, 1) and delowner = 0 ORDER BY time DESC
         4315 Query SELECT * FROM s1_mdata where target IN(6, 1) and send = 0 and archived = 1
         4315 Query SELECT * FROM s1_mdata where target IN(6, 1) and send = 0 and archived = 1 and deltarget = 0
         4315 Query SELECT * FROM s1_ndata where uid = 6 ORDER BY time DESC
         4315 Query SELECT * FROM s1_ndata where uid = 6 and del = 0 ORDER BY time DESC
         4315 Query SELECT * FROM s1_vdata where wref = '22609'
         4315 Query SELECT * FROM s1_vdata where wref = 22609
         4315 Query SELECT * from s1_fdata where vref = 22609
         4315 Query SELECT x,y FROM s1_wdata where id = 22609
         4315 Query SELECT id, fieldtype FROM s1_wdata where id = 22609
         4315 Query SELECT * FROM s1_odata where conqured = 22609
         4315 Query SELECT * from s1_units where vref = 22609
         4315 Query SELECT * from s1_enforcement where vref = 22609
         4315 Query SELECT * from s1_enforcement where `from` = 22609
         4315 Query SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 22609 AND e.from !=22609
         4315 Query SELECT * from s1_units where vref = 22609
         4315 Query SELECT * from s1_enforcement where vref = 22609
         4315 Query SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 22609 AND e.from !=22609
         4315 Query SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 22609
         4315 Query SELECT * FROM s1_prisoners where `from` = 22609
         4315 Query SELECT * FROM s1_vdata where wref = 22609
         4315 Query SELECT tribe FROM s1_users where id = 6
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement where s1_movement.from = '22609' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
         4315 Query SELECT * from s1_tdata where vref = 22609
         4315 Query SELECT * FROM s1_abdata where vref = 22609
         4315 Query SELECT * FROM s1_research where vref = 22609
         4315 Query SELECT * FROM s1_bdata where wid = 22609 and master = 1 order by master,timestamp ASC
         4315 Query SELECT * FROM s1_artefacts WHERE vref = '22609' AND type = '4' order by size
         4315 Query SELECT * FROM s1_artefacts WHERE owner = 6 AND type = 4 AND size=2
         4315 Query SELECT * FROM s1_artefacts WHERE owner = 6 AND type = 4 AND size=3
         4315 Query SELECT * from s1_fdata where vref = 22609
         4315 Query SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
         4315 Query SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
         4315 Query SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
         4315 Query SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
         4315 Query SELECT wood,clay,iron,crop,maxstore,maxcrop from s1_vdata where wref = 22609
         4315 Query UPDATE s1_vdata set wood = 28363, clay = 37571, iron = 28361, crop = 44702 where wref = 22609
         4315 Query UPDATE s1_vdata set lastupdate = 1508777522 where wref = 22609
         4315 Query SELECT * FROM s1_vdata where wref = 22609
         4315 Query SELECT * from s1_fdata where vref = 22609
         4315 Query SELECT x,y FROM s1_wdata where id = 22609
         4315 Query SELECT id, fieldtype FROM s1_wdata where id = 22609
         4315 Query SELECT * FROM s1_odata where conqured = 22609
         4315 Query SELECT * from s1_units where vref = 22609
         4315 Query SELECT * from s1_enforcement where vref = 22609
         4315 Query SELECT * from s1_enforcement where `from` = 22609
         4315 Query SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 22609 AND e.from !=22609
         4315 Query SELECT * from s1_units where vref = 22609
         4315 Query SELECT * from s1_enforcement where vref = 22609
         4315 Query SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 22609 AND e.from !=22609
         4315 Query SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 22609
         4315 Query SELECT * FROM s1_prisoners where `from` = 22609
         4315 Query SELECT * FROM s1_vdata where wref = 22609
         4315 Query SELECT tribe FROM s1_users where id = 6
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement where s1_movement.from = '22609' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
         4315 Query SELECT * from s1_tdata where vref = 22609
         4315 Query SELECT * FROM s1_abdata where vref = 22609
         4315 Query SELECT * FROM s1_research where vref = 22609
         4315 Query SELECT * FROM s1_bdata where wid = 22609 and master = 1 order by master,timestamp ASC
         4315 Query SELECT * FROM s1_bdata where wid = 22609 order by master,timestamp ASC
         4315 Query SELECT count(id) FROM s1_users where id > 5
         4315 Query SELECT s1_users.id userid, s1_users.username username, s1_users.oldrank oldrank, s1_users.alliance alliance, (

                    SELECT SUM( s1_vdata.pop )
                    FROM s1_vdata
                    WHERE s1_vdata.owner = userid
                    )totalpop, (

                    SELECT COUNT( s1_vdata.wref )
                    FROM s1_vdata
                    WHERE s1_vdata.owner = userid AND type != 99
                    )totalvillages, (

                    SELECT s1_alidata.tag
                    FROM s1_alidata, s1_users
                    WHERE s1_alidata.id = s1_users.alliance
                    AND s1_users.id = userid
                    )allitag
                    FROM s1_users
                    WHERE s1_users.access < 8
                    AND s1_users.tribe <= 5
                    AND s1_users.id > 5
                    ORDER BY totalpop DESC, totalvillages DESC, userid DESC
         4315 Query SELECT * FROM s1_medal order by week DESC LIMIT 0, 1
         4315 Query SELECT * FROM s1_users where oldrank = 0 and id > 5
         4315 Query DELETE FROM s1_active WHERE timestamp < 1508561522
         4315 Query SELECT * FROM s1_odata WHERE wood < 800 OR clay < 800 OR iron < 800 OR crop < 800
         4315 Query UPDATE s1_odata set wood = 183.06888888889, clay = 183.06888888889, iron = 183.06888888889, crop = 183.06888888889 where wref = 16778
         4315 Query UPDATE s1_odata set lastupdated = 1508777522 where wref = 16778
         4315 Query UPDATE s1_odata set wood = 148.06888888889, clay = 148.06888888889, iron = 148.06888888889, crop = 148.06888888889 where wref = 16780
         4315 Query UPDATE s1_odata set lastupdated = 1508777522 where wref = 16780
         4315 Query UPDATE s1_odata set wood = 335.06888888889, clay = 335.06888888889, iron = 335.06888888889, crop = 335.06888888889 where wref = 17378
         4315 Query UPDATE s1_odata set lastupdated = 1508777522 where wref = 17378
         4315 Query UPDATE s1_odata set wood = 495.06888888889, clay = 495.06888888889, iron = 495.06888888889, crop = 495.06888888889 where wref = 17984
         4315 Query UPDATE s1_odata set lastupdated = 1508777522 where wref = 17984
         4315 Query UPDATE s1_odata set wood = 555.06888888889, clay = 555.06888888889, iron = 555.06888888889, crop = 555.06888888889 where wref = 17986
         4315 Query UPDATE s1_odata set lastupdated = 1508777522 where wref = 17986
         4315 Query UPDATE s1_odata set wood = 104.06888888889, clay = 104.06888888889, iron = 104.06888888889, crop = 104.06888888889 where wref = 18390
         4315 Query UPDATE s1_odata set lastupdated = 1508777522 where wref = 18390
         4315 Query UPDATE s1_odata set wood = 472.06888888889, clay = 472.06888888889, iron = 472.06888888889, crop = 472.06888888889 where wref = 18595
         4315 Query UPDATE s1_odata set lastupdated = 1508777522 where wref = 18595
         4315 Query UPDATE s1_odata set wood = 312.06888888889, clay = 312.06888888889, iron = 312.06888888889, crop = 312.06888888889 where wref = 18799
         4315 Query UPDATE s1_odata set lastupdated = 1508777522 where wref = 18799
         4315 Query UPDATE s1_odata set wood = 558.06888888889, clay = 558.06888888889, iron = 558.06888888889, crop = 558.06888888889 where wref = 19194
         4315 Query UPDATE s1_odata set lastupdated = 1508777522 where wref = 19194
         4315 Query UPDATE s1_odata set wood = 20.068888888889, clay = 20.068888888889, iron = 20.068888888889, crop = 20.068888888889 where wref = 20198
         4315 Query UPDATE s1_odata set lastupdated = 1508777522 where wref = 20198
         4315 Query UPDATE s1_odata set wood = 230.06888888889, clay = 230.06888888889, iron = 230.06888888889, crop = 230.06888888889 where wref = 22206
         4315 Query UPDATE s1_odata set lastupdated = 1508777522 where wref = 22206
         4315 Query SELECT * FROM s1_vdata WHERE maxstore < 800 OR maxcrop < 800
         4315 Query SELECT * FROM s1_vdata WHERE wood > maxstore OR clay > maxstore OR iron > maxstore OR crop > maxcrop
         4315 Query SELECT * FROM s1_vdata WHERE wood < 0 OR clay < 0 OR iron < 0 OR crop < 0
         4315 Query SELECT * FROM s1_odata WHERE maxstore < 800 OR maxcrop < 800
         4315 Query SELECT * FROM s1_odata WHERE wood < 0 OR clay < 0 OR iron < 0 OR crop < 0
         4315 Query SELECT * FROM `s1_ww_attacks` WHERE `attack_time` <= 1508777522
         4315 Query SELECT id, lastupdate FROM s1_users WHERE lastupdate < 1508776922
         4315 Query SELECT * FROM s1_hero
         4315 Query UPDATE `s1_hero` SET health = '96' WHERE heroid = 2
         4315 Query UPDATE `s1_hero` SET lastupdate = '1508777522' WHERE heroid = 2
         4315 Query SELECT * from s1_units where vref = 20599
         4315 Query SELECT * from s1_units where vref = 22609
         4315 Query SELECT * from s1_units where vref = 18790
         4315 Query SELECT uid FROM s1_deleting where timestamp < 1508777522
         4315 Query SELECT * FROM s1_bdata where timestamp < 1508777522 and master = 0
         4315 Query SELECT * FROM s1_bdata WHERE master = 1
         4315 Query SELECT * FROM s1_demolition WHERE timetofinish<=1508777522
         4315 Query SELECT * FROM `s1_fdata`
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 216
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 594
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 1700 WHERE `wref` = 997
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 1014
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 800 WHERE `wref` = 1202
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 800 WHERE `wref` = 1204
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 11800, `maxcrop` = 7800 WHERE `wref` = 1592
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 1794
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 1801
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 1994
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 1998
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 2001
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 2009
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 2223
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 9600, `maxcrop` = 9600 WHERE `wref` = 2417
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 2603
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 2605
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 2804
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 3423
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 3804
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 6300, `maxcrop` = 4000 WHERE `wref` = 4012
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 16379
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 16570
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 16573
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 1200 WHERE `wref` = 16980
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 17004
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 4000 WHERE `wref` = 17173
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 17578
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18173
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18581
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18584
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 82300, `maxcrop` = 81700 WHERE `wref` = 18790
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 25900, `maxcrop` = 21400 WHERE `wref` = 18791
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18810
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18980
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18987
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18991
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 19013
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 800 WHERE `wref` = 19209
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 19212
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 20201
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 20587
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 37900, `maxcrop` = 21400 WHERE `wref` = 20599
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 9600, `maxcrop` = 3100 WHERE `wref` = 20801
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 20812
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 20986
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 25900, `maxcrop` = 17600 WHERE `wref` = 21002
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21187
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 21392
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21396
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21423
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21816
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21996
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 800 WHERE `wref` = 22214
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 22395
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 22430
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 80000, `maxcrop` = 80000 WHERE `wref` = 22609
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23010
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23036
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23229
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23230
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23406
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 80000, `maxcrop` = 80000 WHERE `wref` = 23623
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23635
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23636
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 24011
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 24032
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 24037
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 36389
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 36591
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 36597
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 36770
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 36787
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 36994
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 36995
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 36998
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 36999
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 81700, `maxcrop` = 81700 WHERE `wref` = 37184
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 37189
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 37192
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 37605
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 37787
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 17600, `maxcrop` = 14400 WHERE `wref` = 37988
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 800 WHERE `wref` = 38196
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 38385
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 38597
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 38607
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 38779
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 38801
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 39012
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 39013
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 39177
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 39187
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 39209
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 39585
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 1700 WHERE `wref` = 39604
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 1700 WHERE `wref` = 39792
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1200 WHERE `wref` = 39804
         4315 Query DELETE from s1_route where timeleft < 1508777522
         4315 Query SELECT * FROM s1_route where timestamp < 1508777522
         4315 Query SELECT * FROM s1_movement, s1_send where s1_movement.ref = s1_send.id and s1_movement.proc = 0 and sort_type = 0 and endtime < 1508777522.8262
         4315 Query SELECT * FROM s1_movement where proc = 0 and sort_type = 2 and endtime < 1508777522.8262
         4315 Query SELECT * FROM s1_research where timestamp < 1508777522
         4315 Query SELECT * FROM s1_training where vref IS NOT NULL
         4315 Query SELECT * FROM s1_vdata where wref = 22609
         4315 Query SELECT owner FROM s1_vdata where wref = 22609
         4315 Query SELECT b4 FROM s1_users where id = 6
         4315 Query SELECT * from s1_fdata where vref = 22609
         4315 Query SELECT type FROM `s1_odata` WHERE conqured = 22609
         4315 Query SELECT * from s1_units where vref = 22609
         4315 Query SELECT * from s1_enforcement where vref = 22609
         4315 Query SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 22609 AND e.from !=22609
         4315 Query SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 22609
         4315 Query SELECT * FROM s1_vdata where wref = 22609
         4315 Query SELECT tribe FROM s1_users where id = 6
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement where s1_movement.from = '22609' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_prisoners where `from` = 22609
         4315 Query SELECT * from s1_fdata where vref = 22609
         4315 Query SELECT owner FROM s1_vdata where wref = 22609
         4315 Query SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
         4315 Query SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
         4315 Query SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
         4315 Query SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
         4315 Query SELECT * FROM s1_vdata where starv != 0 and owner != 3
         4315 Query SELECT * from s1_units where vref = 36787
         4315 Query SELECT * from s1_enforcement where vref = 36787
         4315 Query SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 36787 AND e.from !=36787
         4315 Query SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 36787
         4315 Query SELECT * FROM s1_vdata where wref = 36787
         4315 Query SELECT tribe FROM s1_users where id = 94
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '36787' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '36787' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement where s1_movement.from = '36787' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_prisoners where `from` = 36787
         4315 Query SELECT * from s1_fdata where vref = 36787
         4315 Query SELECT owner FROM s1_vdata where wref = 36787
         4315 Query SELECT * FROM s1_artefacts WHERE owner = 94 AND active = 1 AND type = 4 AND size=3
         4315 Query SELECT * FROM s1_artefacts WHERE vref = 36787 AND active = 1 AND type = 4 AND size=1
         4315 Query SELECT * FROM s1_artefacts WHERE owner = 94 AND active = 1 AND type = 4 AND size=2
         4315 Query SELECT * FROM s1_artefacts WHERE vref = 36787 AND ((type = 8 AND kind = 4) OR (owner = 94 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
         4315 Query SELECT e.*,o.conqured,o.wref,o.high, o.owner as ownero, v.owner as ownerv FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref LEFT JOIN s1_vdata as v ON e.from=v.wref where o.conqured=36787 AND o.owner<>v.owner
         4315 Query SELECT e.*,o.conqured,o.wref,o.high, o.owner as ownero, v.owner as ownerv FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref LEFT JOIN s1_vdata as v ON e.from=v.wref where o.conqured=36787 AND o.owner=v.owner
         4315 Query SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM s1_enforcement as e LEFT JOIN s1_vdata as v ON e.from=v.wref LEFT JOIN s1_vdata as v1 ON e.vref=v1.wref where e.vref=36787 AND v.owner<>v1.owner
         4315 Query SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM s1_enforcement as e LEFT JOIN s1_vdata as v ON e.from=v.wref LEFT JOIN s1_vdata as v1 ON e.vref=v1.wref where e.vref=36787 AND v.owner=v1.owner
         4315 Query SELECT * from s1_units where vref = 36787
         4315 Query SELECT owner FROM s1_vdata where wref = 36787
         4315 Query SELECT b4 FROM s1_users where id = 94
         4315 Query SELECT * from s1_fdata where vref = 36787
         4315 Query SELECT type FROM `s1_odata` WHERE conqured = 36787
         4315 Query SELECT crop FROM s1_vdata where wref = 36787
         4315 Query UPDATE s1_vdata set crop = '627' where wref = 36787
         4315 Query SELECT owner FROM s1_vdata where wref = 36787
         4315 Query SELECT b4 FROM s1_users where id = 94
         4315 Query SELECT * from s1_fdata where vref = 36787
         4315 Query SELECT type FROM `s1_odata` WHERE conqured = 36787
         4315 Query SELECT * from s1_units where vref = 1592
         4315 Query SELECT * from s1_enforcement where vref = 1592
         4315 Query SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 1592 AND e.from !=1592
         4315 Query SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 1592
         4315 Query SELECT * FROM s1_vdata where wref = 1592
         4315 Query SELECT tribe FROM s1_users where id = 67
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '1592' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '1592' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement where s1_movement.from = '1592' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_prisoners where `from` = 1592
         4315 Query SELECT * from s1_fdata where vref = 1592
         4315 Query SELECT owner FROM s1_vdata where wref = 1592
         4315 Query SELECT * FROM s1_artefacts WHERE owner = 67 AND active = 1 AND type = 4 AND size=3
         4315 Query SELECT * FROM s1_artefacts WHERE vref = 1592 AND active = 1 AND type = 4 AND size=1
         4315 Query SELECT * FROM s1_artefacts WHERE owner = 67 AND active = 1 AND type = 4 AND size=2
         4315 Query SELECT * FROM s1_artefacts WHERE vref = 1592 AND ((type = 8 AND kind = 4) OR (owner = 67 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
         4315 Query SELECT e.*,o.conqured,o.wref,o.high, o.owner as ownero, v.owner as ownerv FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref LEFT JOIN s1_vdata as v ON e.from=v.wref where o.conqured=1592 AND o.owner<>v.owner
         4315 Query SELECT e.*,o.conqured,o.wref,o.high, o.owner as ownero, v.owner as ownerv FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref LEFT JOIN s1_vdata as v ON e.from=v.wref where o.conqured=1592 AND o.owner=v.owner
         4315 Query SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM s1_enforcement as e LEFT JOIN s1_vdata as v ON e.from=v.wref LEFT JOIN s1_vdata as v1 ON e.vref=v1.wref where e.vref=1592 AND v.owner<>v1.owner
         4315 Query SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM s1_enforcement as e LEFT JOIN s1_vdata as v ON e.from=v.wref LEFT JOIN s1_vdata as v1 ON e.vref=v1.wref where e.vref=1592 AND v.owner=v1.owner
         4315 Query SELECT * from s1_units where vref = 1592
         4315 Query SELECT owner FROM s1_vdata where wref = 1592
         4315 Query SELECT b4 FROM s1_users where id = 67
         4315 Query SELECT * from s1_fdata where vref = 1592
         4315 Query SELECT type FROM `s1_odata` WHERE conqured = 1592
         4315 Query SELECT crop FROM s1_vdata where wref = 1592
         4315 Query SELECT owner FROM s1_vdata where wref = 1592
         4315 Query SELECT b4 FROM s1_users where id = 67
         4315 Query SELECT * from s1_fdata where vref = 1592
         4315 Query SELECT type FROM `s1_odata` WHERE conqured = 1592
         4315 Query SELECT * from s1_units where vref = 20599
         4315 Query SELECT * from s1_enforcement where vref = 20599
         4315 Query SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 20599 AND e.from !=20599
         4315 Query SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 20599
         4315 Query SELECT * FROM s1_vdata where wref = 20599
         4315 Query SELECT tribe FROM s1_users where id = 46
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '20599' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '20599' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement where s1_movement.from = '20599' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_prisoners where `from` = 20599
         4315 Query SELECT * from s1_fdata where vref = 20599
         4315 Query SELECT owner FROM s1_vdata where wref = 20599
         4315 Query SELECT * FROM s1_artefacts WHERE owner = 46 AND active = 1 AND type = 4 AND size=3
         4315 Query SELECT * FROM s1_artefacts WHERE vref = 20599 AND active = 1 AND type = 4 AND size=1
         4315 Query SELECT * FROM s1_artefacts WHERE owner = 46 AND active = 1 AND type = 4 AND size=2
         4315 Query SELECT * FROM s1_artefacts WHERE vref = 20599 AND ((type = 8 AND kind = 4) OR (owner = 46 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
         4315 Query SELECT e.*,o.conqured,o.wref,o.high, o.owner as ownero, v.owner as ownerv FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref LEFT JOIN s1_vdata as v ON e.from=v.wref where o.conqured=20599 AND o.owner<>v.owner
         4315 Query SELECT e.*,o.conqured,o.wref,o.high, o.owner as ownero, v.owner as ownerv FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref LEFT JOIN s1_vdata as v ON e.from=v.wref where o.conqured=20599 AND o.owner=v.owner
         4315 Query SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM s1_enforcement as e LEFT JOIN s1_vdata as v ON e.from=v.wref LEFT JOIN s1_vdata as v1 ON e.vref=v1.wref where e.vref=20599 AND v.owner<>v1.owner
         4315 Query SELECT owner FROM s1_vdata where wref = 20599
         4315 Query SELECT b4 FROM s1_users where id = 46
         4315 Query SELECT * from s1_fdata where vref = 20599
         4315 Query SELECT type FROM `s1_odata` WHERE conqured = 20599
         4315 Query SELECT crop FROM s1_vdata where wref = 20599
         4315 Query UPDATE s1_vdata set crop = '10947' where wref = 20599
         4315 Query SELECT owner FROM s1_vdata where wref = 20599
         4315 Query SELECT b4 FROM s1_users where id = 46
         4315 Query SELECT * from s1_fdata where vref = 20599
         4315 Query SELECT type FROM `s1_odata` WHERE conqured = 20599
         4315 Query SELECT * FROM s1_vdata where celebration < 1508777522 AND celebration != 0
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.ref = s1_attacks.id and s1_movement.proc = '0' and s1_movement.sort_type = '3' and s1_attacks.attack_type != '2' and endtime < 1508777522 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.ref = s1_attacks.id and s1_movement.proc = '0' and s1_movement.sort_type = '3' and s1_attacks.attack_type = '2' and endtime < 1508777522
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.ref = s1_attacks.id and s1_movement.proc = '0' and s1_movement.sort_type = '4' and endtime < 1508777522
         4315 Query SELECT * FROM s1_movement, s1_send where s1_movement.ref = s1_send.id and s1_movement.proc = 0 and sort_type = 6 and endtime < 1508777522
         4315 Query SELECT * FROM s1_vdata WHERE maxstore < 800 OR maxcrop < 800
         4315 Query SELECT * FROM s1_vdata WHERE wood > maxstore OR clay > maxstore OR iron > maxstore OR crop > maxcrop
         4315 Query SELECT * FROM s1_vdata WHERE wood < 0 OR clay < 0 OR iron < 0 OR crop < 0
         4315 Query SELECT * FROM s1_movement where ref = 0 and proc = '0' and sort_type = '4' and endtime < 1508777522
         4315 Query SELECT * FROM s1_movement where proc = 0 and sort_type = 5 and endtime < 1508777522.8882
         4315 Query SELECT * FROM s1_general WHERE shown = 1
         4315 Query SELECT * FROM s1_users WHERE invited != 0
         4315 Query SELECT * FROM `s1_fdata`
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 216
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 594
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 1700 WHERE `wref` = 997
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 1014
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 800 WHERE `wref` = 1202
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 800 WHERE `wref` = 1204
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 11800, `maxcrop` = 7800 WHERE `wref` = 1592
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 1794
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 1801
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 1994
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 1998
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 2001
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 2009
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 2223
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 9600, `maxcrop` = 9600 WHERE `wref` = 2417
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 2603
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 2605
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 2804
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 3423
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 3804
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 6300, `maxcrop` = 4000 WHERE `wref` = 4012
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 16379
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 16570
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 16573
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 1200 WHERE `wref` = 16980
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 17004
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 4000 WHERE `wref` = 17173
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 17578
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18173
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18581
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18584
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 82300, `maxcrop` = 81700 WHERE `wref` = 18790
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 25900, `maxcrop` = 21400 WHERE `wref` = 18791
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18810
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18980
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18987
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18991
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 19013
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 800 WHERE `wref` = 19209
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 19212
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 20201
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 20587
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 37900, `maxcrop` = 21400 WHERE `wref` = 20599
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 9600, `maxcrop` = 3100 WHERE `wref` = 20801
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 20812
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 20986
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 25900, `maxcrop` = 17600 WHERE `wref` = 21002
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21187
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 21392
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21396
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21423
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21816
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21996
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 800 WHERE `wref` = 22214
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 22395
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 22430
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 80000, `maxcrop` = 80000 WHERE `wref` = 22609
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23010
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23036
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23229
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23230
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23406
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 80000, `maxcrop` = 80000 WHERE `wref` = 23623
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23635
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23636
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 24011
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 24032
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 24037
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 36389
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 36591
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 36597
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 36770
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 36787
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 36994
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 36995
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 36998
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 36999
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 81700, `maxcrop` = 81700 WHERE `wref` = 37184
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 37189
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 37192
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 37605
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 37787
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 17600, `maxcrop` = 14400 WHERE `wref` = 37988
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 800 WHERE `wref` = 38196
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 38385
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 38597
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 38607
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 38779
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 38801
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 39012
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 39013
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 39177
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 39187
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 39209
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 39585
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 1700 WHERE `wref` = 39604
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 1700 WHERE `wref` = 39792
         4315 Query UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1200 WHERE `wref` = 39804
         4315 Query SELECT * FROM s1_banlist WHERE active = 1 and end < 1508777522
         4315 Query SELECT * FROM s1_odata where conqured = 0 and lastupdated2 < 1508734322
         4315 Query SELECT * FROM s1_config
         4315 Query SELECT * FROM s1_artefacts where type = 8 and active = 1 and lastupdate <= 1508691122
         4315 Query SELECT timestamp from s1_deleting where uid = 6
         4315 Query SELECT
                    s1_wdata.id AS map_id,
                    s1_wdata.fieldtype AS map_fieldtype,
                    s1_wdata.oasistype AS map_oasis,
                    s1_wdata.x AS map_x,
                    s1_wdata.y AS map_y,
                    s1_wdata.occupied AS map_occupied,
                    s1_wdata.image AS map_image,

                    s1_odata.conqured AS oasis_conqured,
                    info_user_oasis.username AS oasis_user,
                    info_user_oasis.tribe AS oasis_tribe,
                    info_alliance_oasis.tag AS oasis_alli_name,

                    s1_vdata.wref AS ville_id,
                    s1_vdata.owner AS ville_user,
                    s1_vdata.name AS ville_name,
                    s1_vdata.capital AS ville_capital,
                    s1_vdata.pop AS ville_pop,

                    s1_users.id AS user_id,
                    s1_users.username AS user_username,
                    s1_users.tribe AS user_tribe,
                    s1_users.alliance AS user_alliance,

                    s1_alidata.id AS aliance_id,
                    s1_alidata.tag AS aliance_name

                FROM ((((((s1_wdata
                    LEFT JOIN s1_vdata ON s1_vdata.wref = s1_wdata.id )
                    LEFT JOIN s1_odata ON s1_odata.wref = s1_wdata.id )
                    LEFT JOIN s1_users AS info_user_oasis ON info_user_oasis.id = s1_odata.owner )
                    LEFT JOIN s1_alidata AS info_alliance_oasis ON info_alliance_oasis.id = info_user_oasis.alliance )
                    LEFT JOIN s1_users ON s1_users.id = s1_vdata.owner )
                    LEFT JOIN s1_alidata ON s1_alidata.id = s1_users.alliance )
            where s1_wdata.id IN ('23209','23008','22807','22606','22405','22204','22003','23210','23009','22808','22607','22406','22205','22004','23211','23010','22809','22608','22407','22206','22005','23212','23011','22810','22609','22408','22207','22006','23213','23012','22811','22610','22409','22208','22007','23214','23013','22812','22611','22410','22209','22008','23215','23014','22813','22612','22411','22210','22009')
            ORDER BY FIND_IN_SET(s1_wdata.id,'23209,23008,22807,22606,22405,22204,22003,23210,23009,22808,22607,22406,22205,22004,23211,23010,22809,22608,22407,22206,22005,23212,23011,22810,22609,22408,22207,22006,23213,23012,22811,22610,22409,22208,22007,23214,23013,22812,22611,22410,22209,22008,23215,23014,22813,22612,22411,22210,22009,')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23209 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23209 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23209 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23008 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23008 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23008 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22807 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22807 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22807 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22606 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22606 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22606 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22405 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22405 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22405 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22204 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22204 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22204 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22003 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22003 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22003 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23210 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23210 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23210 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23009 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23009 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23009 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22808 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22808 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22808 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22607 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22607 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22607 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22406 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22406 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22406 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22205 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22205 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22205 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22004 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22004 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22004 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23211 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23211 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23211 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23010 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23010 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23010 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22809 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22809 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22809 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22608 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22608 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22608 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22407 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22407 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22407 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22206 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22206 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22206 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22005 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22005 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22005 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23212 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23212 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23212 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23011 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23011 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23011 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22810 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22810 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22810 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '1' or alli2 = '1') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '1' or alli2 = '1') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '1' AND type = '3' OR alli2 = '1' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22609 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22609 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22609 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22408 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
171023 18:52:03  4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22408 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22408 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22207 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22207 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22207 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22006 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22006 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22006 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23213 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23213 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23213 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23012 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23012 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23012 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22811 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22811 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22811 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22610 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22610 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22610 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22409 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22409 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22409 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22208 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22208 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22208 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22007 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22007 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22007 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23214 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23214 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23214 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23013 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23013 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23013 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22812 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22812 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22812 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22611 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22611 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22611 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22410 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22410 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22410 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22209 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22209 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22209 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22008 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22008 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22008 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23215 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23215 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23215 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23014 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23014 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 23014 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22813 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22813 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22813 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22612 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22612 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22612 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22411 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22411 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22411 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22210 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22210 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22210 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '1' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE (alli1 = '' or alli2 = '') AND (type = '2' AND accepted = '1')
         4315 Query SELECT * FROM s1_diplomacy WHERE alli1 = '' AND type = '3' OR alli2 = '' AND type = '3' AND accepted = '1'
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22009 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and (s1_attacks.attack_type = 3 or s1_attacks.attack_type = 4) ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22009 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 2 ORDER BY endtime ASC
         4315 Query SELECT * FROM s1_movement, s1_attacks where s1_movement.from = 22609 and s1_movement.to = 22009 and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
         4315 Query SELECT a.wref, a.name, b.x, b.y from s1_vdata AS a left join s1_wdata AS b ON b.id = a.wref where owner = 6 order by capital DESC,pop DESC
         4315 Query SELECT Count(*) as Total FROM s1_users WHERE timestamp > 1508776923 AND tribe!=0 AND tribe!=4 AND tribe!=5
         4315 Query SELECT * FROM s1_users WHERE access< 8 AND id > 5 AND tribe<=3 AND tribe > 0 ORDER BY oldrank ASC Limit 1
         4315 Query SELECT * FROM `s1_links` WHERE `userid` = 6 ORDER BY `pos` ASC
         4315 Query SELECT * from s1_fdata where vref = 22609
         4315 Query SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
         4315 Query SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
         4315 Query SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
         4315 Query SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
         4315 Quit  
