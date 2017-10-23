<?php
    $src = "		   39 Init DB	travian
		   39 Query	SET NAMES 'UTF8'
		   39 Query	SELECT username FROM s1_users where username = 'cyberghost' LIMIT 1
		   39 Query	SELECT id,password,sessid,is_bcrypt FROM s1_users where username = 'cyberghost'
           39 Query	SELECT act FROM s1_users where username = 'cyberghost'
		   39 Query	SELECT vac_mode FROM s1_users where username = 'cyberghost'
		   39 Query	SELECT * FROM s1_users where username = 'cyberghost'
		   39 Query	UPDATE s1_users SET vac_mode = '0' , vac_time='0' WHERE id=6
		   39 Query	SELECT id,password,sessid,is_bcrypt FROM s1_users where username = 'cyberghost'
		   39 Query	INSERT IGNORE INTO s1_online (name, uid, time, sit) VALUES ('cyberghost', 6, '1508760539', 0)
		   39 Query	SELECT quest FROM s1_users where username = 'cyberghost'
		   39 Query	SELECT id, village_select FROM `s1_users` WHERE `username`='cyberghost'
		   39 Query	SELECT * FROM `s1_vdata` WHERE `wref` = 22609
		   39 Query	SELECT * FROM s1_users where username = 'cyberghost'
		   39 Query	SELECT wref from s1_vdata where owner = 6 order by capital DESC,pop DESC
		   39 Query	SELECT sit FROM s1_online where uid = 6
		   39 Query	SELECT SUM(hero) from s1_enforcement where `from` = 22609
		   39 Query	SELECT SUM(hero) from s1_units where `vref` = 22609
		   39 Query	SELECT SUM(t11) from s1_prisoners where `from` = 22609
		   39 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   39 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   39 Query	SELECT SUM(hero) from s1_enforcement where `from` = 23623
		   39 Query	SELECT SUM(hero) from s1_units where `vref` = 23623
		   39 Query	SELECT SUM(t11) from s1_prisoners where `from` = 23623
		   39 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '23623' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   39 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '23623' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   39 Query	SELECT SUM(hero) from s1_enforcement where `from` = 23036
		   39 Query	SELECT SUM(hero) from s1_units where `vref` = 23036
		   39 Query	SELECT SUM(t11) from s1_prisoners where `from` = 23036
		   39 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '23036' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   39 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '23036' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   39 Query	SELECT dead FROM s1_hero WHERE `uid` = 6
		   39 Query	SELECT inrevive FROM s1_hero WHERE `uid` = 6
		   39 Query	SELECT intraining FROM s1_hero WHERE `uid` = 6
		   39 Query	REPLACE into s1_active values ('cyberghost',1508760538)
		   39 Query	UPDATE s1_users set sessid = '6ae0fce2ef4f60001efccea596a993e6' where username = 'cyberghost'
		   39 Query	Insert into s1_login_log values (0,6,'127.0.0.1')
		   39 Quit	
		   40 Connect	root@localhost as anonymous on 
		   40 Init DB	travian
		   40 Query	SET NAMES 'UTF8'
		   40 Query	SELECT * FROM s1_users where username = 'cyberghost'
		   40 Query	SELECT wref from s1_vdata where owner = 6 order by capital DESC,pop DESC
		   40 Query	SELECT sit FROM s1_online where uid = 6
		   40 Query	SELECT SUM(hero) from s1_enforcement where `from` = 22609
		   40 Query	SELECT SUM(hero) from s1_units where `vref` = 22609
		   40 Query	SELECT SUM(t11) from s1_prisoners where `from` = 22609
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT SUM(hero) from s1_enforcement where `from` = 23623
		   40 Query	SELECT SUM(hero) from s1_units where `vref` = 23623
		   40 Query	SELECT SUM(t11) from s1_prisoners where `from` = 23623
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '23623' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '23623' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT SUM(hero) from s1_enforcement where `from` = 23036
		   40 Query	SELECT SUM(hero) from s1_units where `vref` = 23036
		   40 Query	SELECT SUM(t11) from s1_prisoners where `from` = 23036
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '23036' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '23036' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT dead FROM s1_hero WHERE `uid` = 6
		   40 Query	SELECT inrevive FROM s1_hero WHERE `uid` = 6
		   40 Query	SELECT intraining FROM s1_hero WHERE `uid` = 6
		   40 Query	REPLACE into s1_active values ('cyberghost',1508760539)
		   40 Query	UPDATE s1_users set timestamp = '1508760539' where username = 'cyberghost'
		   40 Query	REPLACE into s1_active values ('cyberghost',1508760539)
		   40 Query	UPDATE s1_users set timestamp = 1508760539 where username = 'cyberghost'
		   40 Query	SELECT * FROM s1_mdata WHERE target IN(6, 1) and send = 0 and archived = 0 ORDER BY time DESC
		   40 Query	SELECT * FROM s1_mdata WHERE owner IN(6, 1) ORDER BY time DESC
		   40 Query	SELECT * FROM s1_mdata WHERE target IN(6, 1) and send = 0 and archived = 0 and deltarget = 0 ORDER BY time DESC
		   40 Query	SELECT * FROM s1_mdata WHERE owner IN(6, 1) and delowner = 0 ORDER BY time DESC
		   40 Query	SELECT * FROM s1_mdata where target IN(6, 1) and send = 0 and archived = 1
		   40 Query	SELECT * FROM s1_mdata where target IN(6, 1) and send = 0 and archived = 1 and deltarget = 0
		   40 Query	SELECT * FROM s1_ndata where uid = 6 ORDER BY time DESC
171023 14:09:00	   40 Query	SELECT * FROM s1_ndata where uid = 6 and del = 0 ORDER BY time DESC
		   40 Query	SELECT * FROM s1_vdata where wref = '22609'
		   40 Query	SELECT * FROM s1_vdata where wref = 22609
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT x,y FROM s1_wdata where id = 22609
		   40 Query	SELECT id, fieldtype FROM s1_wdata where id = 22609
		   40 Query	SELECT * FROM s1_odata where conqured = 22609
		   40 Query	SELECT * from s1_units where vref = 22609
		   40 Query	SELECT * from s1_enforcement where vref = 22609
		   40 Query	SELECT * from s1_enforcement where `from` = 22609
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 22609 AND e.from !=22609
		   40 Query	SELECT * from s1_units where vref = 22609
		   40 Query	SELECT * from s1_enforcement where vref = 22609
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 22609 AND e.from !=22609
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 22609
		   40 Query	SELECT * FROM s1_prisoners where `from` = 22609
		   40 Query	SELECT * FROM s1_vdata where wref = 22609
		   40 Query	SELECT tribe FROM s1_users where id = 6
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '22609' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * from s1_tdata where vref = 22609
		   40 Query	SELECT * FROM s1_abdata where vref = 22609
		   40 Query	SELECT * FROM s1_research where vref = 22609
		   40 Query	SELECT * FROM s1_bdata where wid = 22609 and master = 1 order by master,timestamp ASC
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = '22609' AND type = '4' order by size
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND type = 4 AND size=3
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT wood,clay,iron,crop,maxstore,maxcrop from s1_vdata where wref = 22609
		   40 Query	UPDATE s1_vdata set wood = 1921, clay = 2806, iron = 2546, crop = 5788 where wref = 22609
		   40 Query	UPDATE s1_vdata set lastupdate = 1508760540 where wref = 22609
		   40 Query	SELECT * FROM s1_vdata where wref = 22609
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT x,y FROM s1_wdata where id = 22609
		   40 Query	SELECT id, fieldtype FROM s1_wdata where id = 22609
		   40 Query	SELECT * FROM s1_odata where conqured = 22609
		   40 Query	SELECT * from s1_units where vref = 22609
		   40 Query	SELECT * from s1_enforcement where vref = 22609
		   40 Query	SELECT * from s1_enforcement where `from` = 22609
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 22609 AND e.from !=22609
		   40 Query	SELECT * from s1_units where vref = 22609
		   40 Query	SELECT * from s1_enforcement where vref = 22609
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 22609 AND e.from !=22609
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 22609
		   40 Query	SELECT * FROM s1_prisoners where `from` = 22609
		   40 Query	SELECT * FROM s1_vdata where wref = 22609
		   40 Query	SELECT tribe FROM s1_users where id = 6
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '22609' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * from s1_tdata where vref = 22609
		   40 Query	SELECT * FROM s1_abdata where vref = 22609
		   40 Query	SELECT * FROM s1_research where vref = 22609
		   40 Query	SELECT * FROM s1_bdata where wid = 22609 and master = 1 order by master,timestamp ASC
		   40 Query	SELECT * FROM s1_bdata where wid = 22609 order by master,timestamp ASC
		   40 Query	SELECT count(id) FROM s1_users where id > 5
		   40 Query	SELECT s1_users.id userid, s1_users.username username, s1_users.oldrank oldrank, s1_users.alliance alliance, (

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
		   40 Query	SELECT * FROM s1_medal order by week DESC LIMIT 0, 1
		   40 Query	SELECT * FROM s1_users where oldrank = 0 and id > 5
		   40 Query	DELETE FROM s1_active WHERE timestamp < 1508544540
		   40 Query	SELECT * FROM s1_odata WHERE wood < 800 OR clay < 800 OR iron < 800 OR crop < 800
		   40 Query	UPDATE s1_odata set wood = 28.64, clay = 28.64, iron = 28.64, crop = 28.64 where wref = 16778
		   40 Query	UPDATE s1_odata set lastupdated = 1508760540 where wref = 16778
		   40 Query	UPDATE s1_odata set wood = 180.64, clay = 180.64, iron = 180.64, crop = 180.64 where wref = 17378
		   40 Query	UPDATE s1_odata set lastupdated = 1508760540 where wref = 17378
		   40 Query	UPDATE s1_odata set wood = 340.64, clay = 340.64, iron = 340.64, crop = 340.64 where wref = 17984
		   40 Query	UPDATE s1_odata set lastupdated = 1508760540 where wref = 17984
		   40 Query	UPDATE s1_odata set wood = 400.64, clay = 400.64, iron = 400.64, crop = 400.64 where wref = 17986
		   40 Query	UPDATE s1_odata set lastupdated = 1508760540 where wref = 17986
		   40 Query	UPDATE s1_odata set wood = 403.64, clay = 403.64, iron = 403.64, crop = 403.64 where wref = 18390
		   40 Query	UPDATE s1_odata set lastupdated = 1508760540 where wref = 18390
		   40 Query	UPDATE s1_odata set wood = 317.64, clay = 317.64, iron = 317.64, crop = 317.64 where wref = 18595
		   40 Query	UPDATE s1_odata set lastupdated = 1508760540 where wref = 18595
		   40 Query	UPDATE s1_odata set wood = 157.64, clay = 157.64, iron = 157.64, crop = 157.64 where wref = 18799
		   40 Query	UPDATE s1_odata set lastupdated = 1508760540 where wref = 18799
		   40 Query	UPDATE s1_odata set wood = 403.64, clay = 403.64, iron = 403.64, crop = 403.64 where wref = 19194
		   40 Query	UPDATE s1_odata set lastupdated = 1508760540 where wref = 19194
		   40 Query	UPDATE s1_odata set wood = 75.64, clay = 75.64, iron = 75.64, crop = 75.64 where wref = 22206
		   40 Query	UPDATE s1_odata set lastupdated = 1508760540 where wref = 22206
		   40 Query	SELECT * FROM s1_vdata WHERE maxstore < 800 OR maxcrop < 800
		   40 Query	SELECT * FROM s1_vdata WHERE wood > maxstore OR clay > maxstore OR iron > maxstore OR crop > maxcrop
		   40 Query	SELECT * FROM s1_vdata WHERE wood < 0 OR clay < 0 OR iron < 0 OR crop < 0
		   40 Query	SELECT * FROM s1_odata WHERE maxstore < 800 OR maxcrop < 800
		   40 Query	SELECT * FROM s1_odata WHERE wood < 0 OR clay < 0 OR iron < 0 OR crop < 0
		   40 Query	SELECT * FROM `s1_ww_attacks` WHERE `attack_time` <= 1508760540
		   40 Query	SELECT id, lastupdate FROM s1_users WHERE lastupdate < 1508759940
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 6 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 61.477291666667, lastupdate = 1508760540 where id = '6'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 7 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 30.884722222222, lastupdate = 1508760540 where id = '7'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 8 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.43127314814815, lastupdate = 1508760540 where id = '8'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 9 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.31997685185185, lastupdate = 1508760540 where id = '9'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 10 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.33388888888889, lastupdate = 1508760540 where id = '10'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 11 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.16694444444444, lastupdate = 1508760540 where id = '11'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 12 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.13912037037037, lastupdate = 1508760540 where id = '12'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 13 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.055648148148148, lastupdate = 1508760540 where id = '13'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 14 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.12520833333333, lastupdate = 1508760540 where id = '14'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 15 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.055648148148148, lastupdate = 1508760540 where id = '15'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 16 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.041736111111111, lastupdate = 1508760540 where id = '16'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 17 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.055648148148148, lastupdate = 1508760540 where id = '17'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 18 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.041736111111111, lastupdate = 1508760540 where id = '18'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 19 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.041736111111111, lastupdate = 1508760540 where id = '19'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 20 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.041736111111111, lastupdate = 1508760540 where id = '20'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 21 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.041736111111111, lastupdate = 1508760540 where id = '21'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 22 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.1112962962963, lastupdate = 1508760540 where id = '22'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 23 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.041736111111111, lastupdate = 1508760540 where id = '23'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 24 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.083472222222222, lastupdate = 1508760540 where id = '24'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 25 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.041736111111111, lastupdate = 1508760540 where id = '25'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 26 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.041736111111111, lastupdate = 1508760540 where id = '26'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 27 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.041736111111111, lastupdate = 1508760540 where id = '27'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 28 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.041736111111111, lastupdate = 1508760540 where id = '28'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 29 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.069560185185185, lastupdate = 1508760540 where id = '29'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 30 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.041736111111111, lastupdate = 1508760540 where id = '30'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 31 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 1.516412037037, lastupdate = 1508760540 where id = '31'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 32 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.041736111111111, lastupdate = 1508760540 where id = '32'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 33 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.069560185185185, lastupdate = 1508760540 where id = '33'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 34 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.013912037037037, lastupdate = 1508760540 where id = '34'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 35 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.013912037037037, lastupdate = 1508760540 where id = '35'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 36 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.013912037037037, lastupdate = 1508760540 where id = '36'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 37 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.013912037037037, lastupdate = 1508760540 where id = '37'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 38 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.013912037037037, lastupdate = 1508760540 where id = '38'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 39 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.013912037037037, lastupdate = 1508760540 where id = '39'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 40 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.013912037037037, lastupdate = 1508760540 where id = '40'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 41 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.013912037037037, lastupdate = 1508760540 where id = '41'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 42 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.013912037037037, lastupdate = 1508760540 where id = '42'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 43 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.041736111111111, lastupdate = 1508760540 where id = '43'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 44 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.013912037037037, lastupdate = 1508760540 where id = '44'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 45 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.013912037037037, lastupdate = 1508760540 where id = '45'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 46 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 34.223611111111, lastupdate = 1508760540 where id = '46'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 48 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.013912037037037, lastupdate = 1508760540 where id = '48'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 49 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.15303240740741, lastupdate = 1508760540 where id = '49'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 50 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.013912037037037, lastupdate = 1508760540 where id = '50'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 51 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 24.874722222222, lastupdate = 1508760540 where id = '51'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 52 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.041736111111111, lastupdate = 1508760540 where id = '52'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 53 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.29215277777778, lastupdate = 1508760540 where id = '53'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 54 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.083472222222222, lastupdate = 1508760540 where id = '54'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 55 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.013912037037037, lastupdate = 1508760540 where id = '55'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 56 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.84863425925926, lastupdate = 1508760540 where id = '56'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 57 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.59821759259259, lastupdate = 1508760540 where id = '57'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 58 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.61212962962963, lastupdate = 1508760540 where id = '58'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 59 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.65386574074074, lastupdate = 1508760540 where id = '59'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 60 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.66777777777778, lastupdate = 1508760540 where id = '60'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 61 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.52865740740741, lastupdate = 1508760540 where id = '61'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 62 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.55648148148148, lastupdate = 1508760540 where id = '62'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 63 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 1.0434027777778, lastupdate = 1508760540 where id = '63'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 64 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.20868055555556, lastupdate = 1508760540 where id = '64'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 65 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.65386574074074, lastupdate = 1508760540 where id = '65'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 66 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.68168981481481, lastupdate = 1508760540 where id = '66'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 67 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 4.4240277777778, lastupdate = 1508760540 where id = '67'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 68 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.41736111111111, lastupdate = 1508760540 where id = '68'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 69 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.38953703703704, lastupdate = 1508760540 where id = '69'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 70 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.041736111111111, lastupdate = 1508760540 where id = '70'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 71 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.013912037037037, lastupdate = 1508760540 where id = '71'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 72 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.72342592592593, lastupdate = 1508760540 where id = '72'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 73 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.61212962962963, lastupdate = 1508760540 where id = '73'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 74 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.013912037037037, lastupdate = 1508760540 where id = '74'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 75 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.69560185185185, lastupdate = 1508760540 where id = '75'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 76 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.18085648148148, lastupdate = 1508760540 where id = '76'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 78 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.29215277777778, lastupdate = 1508760540 where id = '78'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 80 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.23650462962963, lastupdate = 1508760540 where id = '80'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 81 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 5.5369907407407, lastupdate = 1508760540 where id = '81'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 82 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.013912037037037, lastupdate = 1508760540 where id = '82'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 83 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.013912037037037, lastupdate = 1508760540 where id = '83'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 84 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.23650462962963, lastupdate = 1508760540 where id = '84'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 85 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.097384259259259, lastupdate = 1508760540 where id = '85'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 86 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.83472222222222, lastupdate = 1508760540 where id = '86'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 87 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.65386574074074, lastupdate = 1508760540 where id = '87'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 88 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.98775462962963, lastupdate = 1508760540 where id = '88'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 89 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.25041666666667, lastupdate = 1508760540 where id = '89'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 90 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.44518518518519, lastupdate = 1508760540 where id = '90'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 91 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.76516203703704, lastupdate = 1508760540 where id = '91'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 92 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.25041666666667, lastupdate = 1508760540 where id = '92'
		   40 Query	SELECT sum(cp) FROM s1_vdata where owner = 93 and natar = 0
		   40 Query	UPDATE s1_users set cp = cp + 0.13912037037037, lastupdate = 1508760540 where id = '93'
		   40 Query	SELECT * FROM s1_hero
		   40 Query	UPDATE `s1_hero` SET health = '97' WHERE heroid = 2
		   40 Query	UPDATE `s1_hero` SET lastupdate = '1508760540' WHERE heroid = 2
		   40 Query	SELECT * from s1_units where vref = 20599
		   40 Query	UPDATE `s1_hero` SET health = '96.133228047333' WHERE heroid = 3
		   40 Query	UPDATE `s1_hero` SET lastupdate = '1508760540' WHERE heroid = 3
		   40 Query	SELECT * from s1_units where vref = 22609
		   40 Query	SELECT * from s1_units where vref = 18790
		   40 Query	SELECT uid FROM s1_deleting where timestamp < 1508760540
		   40 Query	SELECT * FROM s1_bdata where timestamp < 1508760540 and master = 0
		   40 Query	SELECT f26 from s1_fdata where vref = 37988 LIMIT 1
		   40 Query	UPDATE s1_fdata set f26 = 10, f26t = 15 where vref = 37988
		   40 Query	SELECT f26 from s1_fdata where vref = 37988 LIMIT 1
		   40 Query	SELECT * from s1_fdata where vref = 37988
		   40 Query	SELECT * from s1_fdata where vref = 37988
		   40 Query	UPDATE s1_vdata set cp = 280 where wref = 37988
		   40 Query	UPDATE s1_vdata set pop = 146 where wref = 37988
		   40 Query	SELECT owner FROM s1_vdata where wref = 37988
		   40 Query	SELECT count(id) FROM s1_users where id > 5
		   40 Query	SELECT s1_users.id userid, s1_users.username username, s1_users.oldrank oldrank, s1_users.alliance alliance, (

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
		   40 Query	SELECT * FROM s1_medal order by week DESC LIMIT 0, 1
		   40 Query	SELECT * FROM s1_users WHERE access < 8
		   40 Query	SELECT * FROM s1_users WHERE access < 8
		   40 Query	UPDATE s1_users set clp = clp - -1 where id = 81
		   40 Query	UPDATE s1_users set oldrank = 4 where id = 81
		   40 Query	UPDATE s1_users set clp = clp + 1 where id = 51
		   40 Query	UPDATE s1_users set oldrank = 3 where id = 51
		   40 Query	SELECT id,name,tag,oldrank,Aap,Adp FROM s1_alidata where id != '' ORDER BY id DESC
		   40 Query	SELECT * FROM s1_users where alliance = 3 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 81
		   40 Query	SELECT * FROM s1_users where alliance = 1 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 46
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 6
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 7
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 67
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 31
		   40 Query	SELECT alliance FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 37988
		   40 Query	SELECT count(id) FROM s1_users where id > 5
		   40 Query	SELECT s1_users.id userid, s1_users.username username, s1_users.oldrank oldrank, s1_users.alliance alliance, (

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
		   40 Query	SELECT * FROM s1_medal order by week DESC LIMIT 0, 1
		   40 Query	SELECT * FROM s1_users WHERE access < 8
		   40 Query	SELECT id,name,tag,oldrank,Aap,Adp FROM s1_alidata where id != '' ORDER BY id DESC
		   40 Query	SELECT * FROM s1_users where alliance = 3 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 81
		   40 Query	SELECT * FROM s1_users where alliance = 1 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 46
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 6
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 7
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 67
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 31
		   40 Query	SELECT alliance FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 37988
		   40 Query	SELECT tribe FROM s1_users where id = 51
		   40 Query	UPDATE s1_bdata set loopcon = 0 where loopcon = 1 and master = 0 and wid = 37988
		   40 Query	DELETE FROM s1_bdata where id = 2755
		   40 Query	SELECT owner FROM s1_vdata where wref = 37988
		   40 Query	SELECT b4 FROM s1_users where id = 51
		   40 Query	SELECT * from s1_fdata where vref = 37988
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 37988
		   40 Query	SELECT * from s1_units where vref = 37988
		   40 Query	SELECT * from s1_enforcement where vref = 37988
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 37988 AND e.from !=37988
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 37988
		   40 Query	SELECT * FROM s1_vdata where wref = 37988
		   40 Query	SELECT tribe FROM s1_users where id = 51
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '37988' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '37988' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '37988' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 37988
		   40 Query	SELECT * FROM s1_vdata where wref = 37988
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT starv FROM s1_vdata where wref = 37988
		   40 Query	UPDATE s1_vdata set starv = '146' where wref = 37988
		   40 Query	UPDATE s1_vdata set starvupdate = '1508760540' where wref = 37988
		   40 Query	SELECT f5 from s1_fdata where vref = 18791 LIMIT 1
		   40 Query	UPDATE s1_fdata set f5 = 6, f5t = 2 where vref = 18791
		   40 Query	SELECT f5 from s1_fdata where vref = 18791 LIMIT 1
		   40 Query	SELECT * from s1_fdata where vref = 18791
		   40 Query	SELECT * from s1_fdata where vref = 18791
		   40 Query	UPDATE s1_vdata set cp = 313 where wref = 18791
		   40 Query	UPDATE s1_vdata set pop = 163 where wref = 18791
		   40 Query	SELECT owner FROM s1_vdata where wref = 18791
		   40 Query	SELECT count(id) FROM s1_users where id > 5
		   40 Query	SELECT s1_users.id userid, s1_users.username username, s1_users.oldrank oldrank, s1_users.alliance alliance, (

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
		   40 Query	SELECT * FROM s1_medal order by week DESC LIMIT 0, 1
		   40 Query	SELECT * FROM s1_users WHERE access < 8
		   40 Query	SELECT * FROM s1_users WHERE access < 8
		   40 Query	UPDATE s1_users set clp = clp - 0 where id = 51
		   40 Query	UPDATE s1_users set oldrank = 3 where id = 51
		   40 Query	UPDATE s1_users set clp = clp + 1 where id = 7
		   40 Query	UPDATE s1_users set oldrank = 2 where id = 7
		   40 Query	SELECT id,name,tag,oldrank,Aap,Adp FROM s1_alidata where id != '' ORDER BY id DESC
		   40 Query	SELECT * FROM s1_users where alliance = 3 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 81
		   40 Query	SELECT * FROM s1_users where alliance = 1 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 46
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 6
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 7
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 67
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 31
		   40 Query	SELECT alliance FROM s1_users where id = 7
		   40 Query	SELECT * from s1_alidata where id = 1
		   40 Query	SELECT * FROM s1_users where alliance = 1 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 46
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 6
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 7
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 67
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 31
		   40 Query	UPDATE s1_alidata set clp = clp + 2 where id = 1
		   40 Query	UPDATE s1_alidata set oldrank = 2813 where id = 1
		   40 Query	SELECT owner FROM s1_vdata where wref = 18791
		   40 Query	SELECT count(id) FROM s1_users where id > 5
		   40 Query	SELECT s1_users.id userid, s1_users.username username, s1_users.oldrank oldrank, s1_users.alliance alliance, (

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
		   40 Query	SELECT * FROM s1_medal order by week DESC LIMIT 0, 1
		   40 Query	SELECT * FROM s1_users WHERE access < 8
		   40 Query	SELECT id,name,tag,oldrank,Aap,Adp FROM s1_alidata where id != '' ORDER BY id DESC
		   40 Query	SELECT * FROM s1_users where alliance = 3 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 81
		   40 Query	SELECT * FROM s1_users where alliance = 1 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 46
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 6
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 7
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 67
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 31
		   40 Query	SELECT alliance FROM s1_users where id = 7
		   40 Query	SELECT * from s1_alidata where id = 1
		   40 Query	SELECT * FROM s1_users where alliance = 1 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 46
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 6
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 7
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 67
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 31
		   40 Query	SELECT owner FROM s1_vdata where wref = 18791
		   40 Query	SELECT tribe FROM s1_users where id = 7
		   40 Query	UPDATE s1_bdata set loopcon = 0 where loopcon = 1 and master = 0 and wid = 18791 and field < 19
		   40 Query	DELETE FROM s1_bdata where id = 2762
		   40 Query	SELECT owner FROM s1_vdata where wref = 18791
		   40 Query	SELECT b4 FROM s1_users where id = 7
		   40 Query	SELECT * from s1_fdata where vref = 18791
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 18791
		   40 Query	SELECT * from s1_units where vref = 18791
		   40 Query	SELECT * from s1_enforcement where vref = 18791
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 18791 AND e.from !=18791
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 18791
		   40 Query	SELECT * FROM s1_vdata where wref = 18791
		   40 Query	SELECT tribe FROM s1_users where id = 7
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '18791' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '18791' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '18791' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 18791
		   40 Query	SELECT * FROM s1_vdata where wref = 18791
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT starv FROM s1_vdata where wref = 18791
		   40 Query	UPDATE s1_vdata set starv = '163' where wref = 18791
		   40 Query	UPDATE s1_vdata set starvupdate = '1508760540' where wref = 18791
		   40 Query	SELECT f24 from s1_fdata where vref = 18790 LIMIT 1
		   40 Query	UPDATE s1_fdata set f24 = 13, f24t = 37 where vref = 18790
		   40 Query	SELECT f24 from s1_fdata where vref = 18790 LIMIT 1
		   40 Query	SELECT * from s1_fdata where vref = 18790
		   40 Query	SELECT * from s1_fdata where vref = 18790
		   40 Query	UPDATE s1_vdata set cp = 1921 where wref = 18790
		   40 Query	UPDATE s1_vdata set pop = 562 where wref = 18790
		   40 Query	SELECT owner FROM s1_vdata where wref = 18790
		   40 Query	SELECT count(id) FROM s1_users where id > 5
		   40 Query	SELECT s1_users.id userid, s1_users.username username, s1_users.oldrank oldrank, s1_users.alliance alliance, (

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
		   40 Query	SELECT * FROM s1_medal order by week DESC LIMIT 0, 1
		   40 Query	SELECT * FROM s1_users WHERE access < 8
		   40 Query	SELECT id,name,tag,oldrank,Aap,Adp FROM s1_alidata where id != '' ORDER BY id DESC
		   40 Query	SELECT * FROM s1_users where alliance = 3 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 81
		   40 Query	SELECT * FROM s1_users where alliance = 1 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 46
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 6
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 7
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 67
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 31
		   40 Query	SELECT alliance FROM s1_users where id = 7
		   40 Query	SELECT * from s1_alidata where id = 1
		   40 Query	SELECT * FROM s1_users where alliance = 1 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 46
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 6
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 7
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 67
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 31
		   40 Query	UPDATE s1_alidata set clp = clp + 2 where id = 1
		   40 Query	UPDATE s1_alidata set oldrank = 2815 where id = 1
		   40 Query	SELECT owner FROM s1_vdata where wref = 18790
		   40 Query	SELECT count(id) FROM s1_users where id > 5
		   40 Query	SELECT s1_users.id userid, s1_users.username username, s1_users.oldrank oldrank, s1_users.alliance alliance, (

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
		   40 Query	SELECT * FROM s1_medal order by week DESC LIMIT 0, 1
		   40 Query	SELECT * FROM s1_users WHERE access < 8
		   40 Query	SELECT id,name,tag,oldrank,Aap,Adp FROM s1_alidata where id != '' ORDER BY id DESC
		   40 Query	SELECT * FROM s1_users where alliance = 3 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 81
		   40 Query	SELECT * FROM s1_users where alliance = 1 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 46
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 6
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 7
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 67
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 31
		   40 Query	SELECT alliance FROM s1_users where id = 7
		   40 Query	SELECT * from s1_alidata where id = 1
		   40 Query	SELECT * FROM s1_users where alliance = 1 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 46
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 6
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 7
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 67
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 31
		   40 Query	SELECT owner FROM s1_vdata where wref = 18790
		   40 Query	SELECT tribe FROM s1_users where id = 7
		   40 Query	UPDATE s1_bdata set loopcon = 0 where loopcon = 1 and master = 0 and wid = 18790 and field > 18
		   40 Query	DELETE FROM s1_bdata where id = 2764
		   40 Query	SELECT owner FROM s1_vdata where wref = 18790
		   40 Query	SELECT b4 FROM s1_users where id = 7
		   40 Query	SELECT * from s1_fdata where vref = 18790
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 18790
		   40 Query	SELECT * from s1_units where vref = 18790
		   40 Query	SELECT * from s1_enforcement where vref = 18790
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 18790 AND e.from !=18790
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 18790
		   40 Query	SELECT * FROM s1_vdata where wref = 18790
		   40 Query	SELECT tribe FROM s1_users where id = 7
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '18790' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '18790' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '18790' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 18790
		   40 Query	SELECT * FROM s1_vdata where wref = 18790
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT starv FROM s1_vdata where wref = 18790
		   40 Query	UPDATE s1_vdata set starv = '2215' where wref = 18790
		   40 Query	UPDATE s1_vdata set starvupdate = '1508760540' where wref = 18790
		   40 Query	SELECT f33 from s1_fdata where vref = 37184 LIMIT 1
		   40 Query	UPDATE s1_fdata set f33 = 10, f33t = 19 where vref = 37184
		   40 Query	SELECT f33 from s1_fdata where vref = 37184 LIMIT 1
		   40 Query	SELECT * from s1_fdata where vref = 37184
		   40 Query	SELECT * from s1_fdata where vref = 37184
		   40 Query	UPDATE s1_vdata set cp = 1526 where wref = 37184
		   40 Query	UPDATE s1_vdata set pop = 498 where wref = 37184
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT count(id) FROM s1_users where id > 5
		   40 Query	SELECT s1_users.id userid, s1_users.username username, s1_users.oldrank oldrank, s1_users.alliance alliance, (

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
		   40 Query	SELECT * FROM s1_medal order by week DESC LIMIT 0, 1
		   40 Query	SELECT * FROM s1_users WHERE access < 8
		   40 Query	SELECT id,name,tag,oldrank,Aap,Adp FROM s1_alidata where id != '' ORDER BY id DESC
		   40 Query	SELECT * FROM s1_users where alliance = 3 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 81
		   40 Query	SELECT * FROM s1_users where alliance = 1 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 46
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 6
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 7
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 67
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 31
		   40 Query	SELECT alliance FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT count(id) FROM s1_users where id > 5
		   40 Query	SELECT s1_users.id userid, s1_users.username username, s1_users.oldrank oldrank, s1_users.alliance alliance, (

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
		   40 Query	SELECT * FROM s1_medal order by week DESC LIMIT 0, 1
		   40 Query	SELECT * FROM s1_users WHERE access < 8
		   40 Query	SELECT id,name,tag,oldrank,Aap,Adp FROM s1_alidata where id != '' ORDER BY id DESC
		   40 Query	SELECT * FROM s1_users where alliance = 3 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 81
		   40 Query	SELECT * FROM s1_users where alliance = 1 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 46
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 6
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 7
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 67
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 31
		   40 Query	SELECT alliance FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT tribe FROM s1_users where id = 51
		   40 Query	UPDATE s1_bdata set loopcon = 0 where loopcon = 1 and master = 0 and wid = 37184
		   40 Query	DELETE FROM s1_bdata where id = 2772
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT b4 FROM s1_users where id = 51
		   40 Query	SELECT * from s1_fdata where vref = 37184
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 37184
		   40 Query	SELECT * from s1_units where vref = 37184
		   40 Query	SELECT * from s1_enforcement where vref = 37184
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 37184 AND e.from !=37184
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 37184
		   40 Query	SELECT * FROM s1_vdata where wref = 37184
		   40 Query	SELECT tribe FROM s1_users where id = 51
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '37184' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '37184' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '37184' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 37184
		   40 Query	SELECT * FROM s1_vdata where wref = 37184
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT starv FROM s1_vdata where wref = 37184
		   40 Query	SELECT f19 from s1_fdata where vref = 37988 LIMIT 1
		   40 Query	UPDATE s1_fdata set f19 = 3, f19t = 25 where vref = 37988
		   40 Query	SELECT f19 from s1_fdata where vref = 37988 LIMIT 1
		   40 Query	SELECT * from s1_fdata where vref = 37988
		   40 Query	SELECT * from s1_fdata where vref = 37988
		   40 Query	UPDATE s1_vdata set cp = 283 where wref = 37988
		   40 Query	UPDATE s1_vdata set pop = 147 where wref = 37988
		   40 Query	SELECT owner FROM s1_vdata where wref = 37988
		   40 Query	SELECT count(id) FROM s1_users where id > 5
		   40 Query	SELECT s1_users.id userid, s1_users.username username, s1_users.oldrank oldrank, s1_users.alliance alliance, (

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
		   40 Query	SELECT * FROM s1_medal order by week DESC LIMIT 0, 1
		   40 Query	SELECT * FROM s1_users WHERE access < 8
		   40 Query	SELECT id,name,tag,oldrank,Aap,Adp FROM s1_alidata where id != '' ORDER BY id DESC
		   40 Query	SELECT * FROM s1_users where alliance = 3 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 81
		   40 Query	SELECT * FROM s1_users where alliance = 1 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 46
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 6
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 7
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 67
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 31
		   40 Query	SELECT alliance FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 37988
		   40 Query	SELECT count(id) FROM s1_users where id > 5
		   40 Query	SELECT s1_users.id userid, s1_users.username username, s1_users.oldrank oldrank, s1_users.alliance alliance, (

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
		   40 Query	SELECT * FROM s1_medal order by week DESC LIMIT 0, 1
		   40 Query	SELECT * FROM s1_users WHERE access < 8
		   40 Query	SELECT id,name,tag,oldrank,Aap,Adp FROM s1_alidata where id != '' ORDER BY id DESC
		   40 Query	SELECT * FROM s1_users where alliance = 3 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 81
		   40 Query	SELECT * FROM s1_users where alliance = 1 order  by (SELECT sum(pop) FROM s1_vdata WHERE owner =  s1_users.id) desc, s1_users.id desc
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 46
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 6
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 7
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 67
		   40 Query	SELECT sum(pop) FROM s1_vdata where owner = 31
		   40 Query	SELECT alliance FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 37988
		   40 Query	SELECT tribe FROM s1_users where id = 51
		   40 Query	UPDATE s1_bdata set loopcon = 0 where loopcon = 1 and master = 0 and wid = 37988
		   40 Query	DELETE FROM s1_bdata where id = 2775
		   40 Query	SELECT owner FROM s1_vdata where wref = 37988
		   40 Query	SELECT b4 FROM s1_users where id = 51
		   40 Query	SELECT * from s1_fdata where vref = 37988
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 37988
		   40 Query	SELECT * from s1_units where vref = 37988
		   40 Query	SELECT * from s1_enforcement where vref = 37988
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 37988 AND e.from !=37988
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 37988
		   40 Query	SELECT * FROM s1_vdata where wref = 37988
		   40 Query	SELECT tribe FROM s1_users where id = 51
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '37988' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '37988' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '37988' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 37988
		   40 Query	SELECT * FROM s1_vdata where wref = 37988
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT starv FROM s1_vdata where wref = 37988
		   40 Query	UPDATE s1_vdata set starv = '147' where wref = 37988
		   40 Query	SELECT * FROM s1_bdata WHERE master = 1
		   40 Query	SELECT owner FROM s1_vdata where wref = 21002
		   40 Query	SELECT tribe FROM s1_users where id = 46
		   40 Query	SELECT wood FROM s1_vdata where wref = 21002
		   40 Query	SELECT clay FROM s1_vdata where wref = 21002
		   40 Query	SELECT iron FROM s1_vdata where wref = 21002
		   40 Query	SELECT crop FROM s1_vdata where wref = 21002
		   40 Query	SELECT * FROM s1_bdata where wid = 21002 and type = 40 and master = 0
		   40 Query	SELECT * FROM s1_bdata where wid = 21002 and field < 19 and master = 0
		   40 Query	SELECT * FROM s1_bdata where wid = 21002 and field > 18 and master = 0
		   40 Query	SELECT * FROM s1_bdata where wid = 21002 and field < 19 and master = 0
		   40 Query	SELECT plus FROM s1_users where id = 46
		   40 Query	SELECT gold FROM s1_users where id = 46
		   40 Query	SELECT owner FROM s1_vdata where wref = 18790
		   40 Query	SELECT tribe FROM s1_users where id = 7
		   40 Query	SELECT wood FROM s1_vdata where wref = 18790
		   40 Query	SELECT clay FROM s1_vdata where wref = 18790
		   40 Query	SELECT iron FROM s1_vdata where wref = 18790
		   40 Query	SELECT crop FROM s1_vdata where wref = 18790
		   40 Query	SELECT * FROM s1_bdata where wid = 18790 and type = 40 and master = 0
		   40 Query	SELECT * FROM s1_bdata where wid = 18790 and field > 18 and master = 0
		   40 Query	SELECT * FROM s1_bdata where wid = 18790 and field < 19 and master = 0
		   40 Query	SELECT * FROM s1_bdata where wid = 18790 and field > 18 and master = 0
		   40 Query	SELECT plus FROM s1_users where id = 7
		   40 Query	SELECT gold FROM s1_users where id = 7
		   40 Query	SELECT * FROM s1_demolition WHERE timetofinish<=1508760540
		   40 Query	SELECT * FROM `s1_fdata`
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 216
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 594
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 1700 WHERE `wref` = 997
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 1014
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 800 WHERE `wref` = 1202
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 11800, `maxcrop` = 4000 WHERE `wref` = 1592
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 1794
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 1801
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 1994
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 1998
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 2001
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 2009
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 2223
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 9600, `maxcrop` = 9600 WHERE `wref` = 2417
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 2603
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 2605
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 2804
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 3423
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 3804
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 3100, `maxcrop` = 3100 WHERE `wref` = 4012
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 16379
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 16570
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 16573
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 1200 WHERE `wref` = 16980
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 17004
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 4000 WHERE `wref` = 17173
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 17578
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18173
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18581
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18584
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 80000, `maxcrop` = 80000 WHERE `wref` = 18790
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 25900, `maxcrop` = 17600 WHERE `wref` = 18791
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18810
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18980
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18987
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18991
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 19013
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 800 WHERE `wref` = 19209
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 19212
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 20201
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 20587
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 37900, `maxcrop` = 21400 WHERE `wref` = 20599
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 9600, `maxcrop` = 3100 WHERE `wref` = 20801
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 20812
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 20986
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 25900, `maxcrop` = 17600 WHERE `wref` = 21002
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21187
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 21392
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21396
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21423
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21816
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21996
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 800 WHERE `wref` = 22214
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 22395
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 22430
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 80000, `maxcrop` = 80000 WHERE `wref` = 22609
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23010
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23036
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23229
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23230
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23406
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 66400, `maxcrop` = 80000 WHERE `wref` = 23623
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23635
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23636
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 24011
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 24032
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 24037
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 36591
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 36597
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 36770
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 36994
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 36995
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 36998
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 36999
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 80000, `maxcrop` = 80000 WHERE `wref` = 37184
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 37189
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 37192
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 37605
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 17600, `maxcrop` = 11800 WHERE `wref` = 37988
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 800 WHERE `wref` = 38196
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 38385
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 38607
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 38779
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 38801
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 39012
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 39177
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 39187
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 39209
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 39585
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 1700 WHERE `wref` = 39604
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 39792
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1200 WHERE `wref` = 39804
		   40 Query	DELETE from s1_route where timeleft < 1508760540
		   40 Query	SELECT * FROM s1_route where timestamp < 1508760540
		   40 Query	SELECT * FROM s1_movement, s1_send where s1_movement.ref = s1_send.id and s1_movement.proc = 0 and sort_type = 0 and endtime < 1508760540.5849
		   40 Query	SELECT * FROM s1_movement where proc = 0 and sort_type = 2 and endtime < 1508760540.5849
		   40 Query	SELECT * FROM s1_research where timestamp < 1508760540
		   40 Query	SELECT * FROM s1_training where vref IS NOT NULL
		   40 Query	UPDATE s1_units set u25 = u25 +  8 WHERE vref = 22609
		   40 Query	UPDATE s1_training set amt = amt - 8, timestamp2 = timestamp2 + 792 where id = 405
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT b4 FROM s1_users where id = 6
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 22609
		   40 Query	SELECT * from s1_units where vref = 22609
		   40 Query	SELECT * from s1_enforcement where vref = 22609
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 22609 AND e.from !=22609
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 22609
		   40 Query	SELECT * FROM s1_vdata where wref = 22609
		   40 Query	SELECT tribe FROM s1_users where id = 6
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '22609' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 22609
		   40 Query	SELECT * FROM s1_vdata where wref = 22609
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT starv FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_vdata where wref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT b4 FROM s1_users where id = 6
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 22609
		   40 Query	SELECT * from s1_units where vref = 22609
		   40 Query	SELECT * from s1_enforcement where vref = 22609
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 22609 AND e.from !=22609
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 22609
		   40 Query	SELECT * FROM s1_vdata where wref = 22609
		   40 Query	SELECT tribe FROM s1_users where id = 6
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '22609' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 22609
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT * FROM s1_vdata where starv != 0 and owner != 3
		   40 Query	SELECT * from s1_units where vref = 37988
		   40 Query	SELECT * from s1_enforcement where vref = 37988
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 37988 AND e.from !=37988
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 37988
		   40 Query	SELECT * FROM s1_vdata where wref = 37988
		   40 Query	SELECT tribe FROM s1_users where id = 51
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '37988' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '37988' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '37988' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 37988
		   40 Query	SELECT * from s1_fdata where vref = 37988
		   40 Query	SELECT owner FROM s1_vdata where wref = 37988
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37988 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37988 AND ((type = 8 AND kind = 4) OR (owner = 51 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT e.*,o.conqured,o.wref,o.high, o.owner as ownero, v.owner as ownerv FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref LEFT JOIN s1_vdata as v ON e.from=v.wref where o.conqured=37988 AND o.owner<>v.owner
		   40 Query	SELECT e.*,o.conqured,o.wref,o.high, o.owner as ownero, v.owner as ownerv FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref LEFT JOIN s1_vdata as v ON e.from=v.wref where o.conqured=37988 AND o.owner=v.owner
		   40 Query	SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM s1_enforcement as e LEFT JOIN s1_vdata as v ON e.from=v.wref LEFT JOIN s1_vdata as v1 ON e.vref=v1.wref where e.vref=37988 AND v.owner<>v1.owner
		   40 Query	SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM s1_enforcement as e LEFT JOIN s1_vdata as v ON e.from=v.wref LEFT JOIN s1_vdata as v1 ON e.vref=v1.wref where e.vref=37988 AND v.owner=v1.owner
		   40 Query	SELECT * from s1_units where vref = 37988
		   40 Query	SELECT owner FROM s1_vdata where wref = 37988
		   40 Query	SELECT b4 FROM s1_users where id = 51
		   40 Query	SELECT * from s1_fdata where vref = 37988
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 37988
		   40 Query	SELECT crop FROM s1_vdata where wref = 37988
		   40 Query	UPDATE s1_vdata set crop = '8049' where wref = 37988
		   40 Query	SELECT owner FROM s1_vdata where wref = 37988
		   40 Query	SELECT b4 FROM s1_users where id = 51
		   40 Query	SELECT * from s1_fdata where vref = 37988
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 37988
		   40 Query	SELECT * from s1_units where vref = 18791
		   40 Query	SELECT * from s1_enforcement where vref = 18791
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 18791 AND e.from !=18791
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 18791
		   40 Query	SELECT * FROM s1_vdata where wref = 18791
		   40 Query	SELECT tribe FROM s1_users where id = 7
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '18791' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '18791' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '18791' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 18791
		   40 Query	SELECT * from s1_fdata where vref = 18791
		   40 Query	SELECT owner FROM s1_vdata where wref = 18791
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 7 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 18791 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 7 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 18791 AND ((type = 8 AND kind = 4) OR (owner = 7 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT e.*,o.conqured,o.wref,o.high, o.owner as ownero, v.owner as ownerv FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref LEFT JOIN s1_vdata as v ON e.from=v.wref where o.conqured=18791 AND o.owner<>v.owner
		   40 Query	SELECT e.*,o.conqured,o.wref,o.high, o.owner as ownero, v.owner as ownerv FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref LEFT JOIN s1_vdata as v ON e.from=v.wref where o.conqured=18791 AND o.owner=v.owner
		   40 Query	SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM s1_enforcement as e LEFT JOIN s1_vdata as v ON e.from=v.wref LEFT JOIN s1_vdata as v1 ON e.vref=v1.wref where e.vref=18791 AND v.owner<>v1.owner
		   40 Query	SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM s1_enforcement as e LEFT JOIN s1_vdata as v ON e.from=v.wref LEFT JOIN s1_vdata as v1 ON e.vref=v1.wref where e.vref=18791 AND v.owner=v1.owner
		   40 Query	SELECT * from s1_units where vref = 18791
		   40 Query	SELECT owner FROM s1_vdata where wref = 18791
		   40 Query	SELECT b4 FROM s1_users where id = 7
		   40 Query	SELECT * from s1_fdata where vref = 18791
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 18791
		   40 Query	SELECT crop FROM s1_vdata where wref = 18791
		   40 Query	UPDATE s1_vdata set crop = '10397' where wref = 18791
		   40 Query	SELECT owner FROM s1_vdata where wref = 18791
		   40 Query	SELECT b4 FROM s1_users where id = 7
		   40 Query	SELECT * from s1_fdata where vref = 18791
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 18791
		   40 Query	SELECT * from s1_units where vref = 18790
		   40 Query	SELECT * from s1_enforcement where vref = 18790
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 18790 AND e.from !=18790
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 18790
		   40 Query	SELECT * FROM s1_vdata where wref = 18790
		   40 Query	SELECT tribe FROM s1_users where id = 7
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '18790' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '18790' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '18790' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 18790
		   40 Query	SELECT * from s1_fdata where vref = 18790
		   40 Query	SELECT owner FROM s1_vdata where wref = 18790
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 7 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 18790 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 7 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 18790 AND ((type = 8 AND kind = 4) OR (owner = 7 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT e.*,o.conqured,o.wref,o.high, o.owner as ownero, v.owner as ownerv FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref LEFT JOIN s1_vdata as v ON e.from=v.wref where o.conqured=18790 AND o.owner<>v.owner
		   40 Query	SELECT e.*,o.conqured,o.wref,o.high, o.owner as ownero, v.owner as ownerv FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref LEFT JOIN s1_vdata as v ON e.from=v.wref where o.conqured=18790 AND o.owner=v.owner
		   40 Query	SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM s1_enforcement as e LEFT JOIN s1_vdata as v ON e.from=v.wref LEFT JOIN s1_vdata as v1 ON e.vref=v1.wref where e.vref=18790 AND v.owner<>v1.owner
		   40 Query	SELECT e.*, v.owner as ownerv, v1.owner as owner1 FROM s1_enforcement as e LEFT JOIN s1_vdata as v ON e.from=v.wref LEFT JOIN s1_vdata as v1 ON e.vref=v1.wref where e.vref=18790 AND v.owner=v1.owner
		   40 Query	SELECT * from s1_units where vref = 18790
		   40 Query	SELECT owner FROM s1_vdata where wref = 18790
		   40 Query	SELECT b4 FROM s1_users where id = 7
		   40 Query	SELECT * from s1_fdata where vref = 18790
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 18790
		   40 Query	SELECT crop FROM s1_vdata where wref = 18790
		   40 Query	UPDATE s1_vdata set crop = '64414' where wref = 18790
		   40 Query	SELECT owner FROM s1_vdata where wref = 18790
		   40 Query	SELECT b4 FROM s1_users where id = 7
		   40 Query	SELECT * from s1_fdata where vref = 18790
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 18790
		   40 Query	SELECT * FROM s1_vdata where celebration < 1508760540 AND celebration != 0
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.ref = s1_attacks.id and s1_movement.proc = '0' and s1_movement.sort_type = '3' and s1_attacks.attack_type != '2' and endtime < 1508760540 ORDER BY endtime ASC
		   40 Query	SELECT x,y FROM s1_wdata where id = 37184
		   40 Query	SELECT x,y FROM s1_wdata where id = 1998
		   40 Query	SELECT id, oasistype FROM s1_wdata where id = 1998
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT id FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 1998
		   40 Query	SELECT id FROM s1_users where id = 54
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT tribe FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 1998
		   40 Query	SELECT tribe FROM s1_users where id = 54
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT alliance FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 1998
		   40 Query	SELECT alliance FROM s1_users where id = 54
		   40 Query	SELECT * FROM s1_wdata left JOIN s1_vdata ON s1_vdata.wref = s1_wdata.id where s1_wdata.id = 1998
		   40 Query	SELECT * FROM s1_wdata left JOIN s1_vdata ON s1_vdata.wref = s1_wdata.id where s1_wdata.id = 37184
		   40 Query	SELECT * FROM s1_vdata where wref = 1998
		   40 Query	SELECT * FROM s1_vdata where wref = 37184
		   40 Query	SELECT * from s1_units where vref = 1998
		   40 Query	SELECT evasion FROM s1_vdata where wref = 1998
		   40 Query	SELECT maxevasion FROM s1_users where id = 54
		   40 Query	SELECT gold FROM s1_users where id = 54
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '1998' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 or s1_movement.to = '1998' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * from s1_units where vref = 1998
		   40 Query	SELECT * from s1_enforcement where vref = 1998
		   40 Query	SELECT f40 from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f19t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f19t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f20t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f20t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f21t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f21t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f22t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f22t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f23t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f23t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f24t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f24t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f25t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f25t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f26t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f26t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f27t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f27t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f28t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f28t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f29t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f29t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f30t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f30t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f31t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f31t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f32t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f32t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f33t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f33t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f34t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f34t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f35t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f35t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f36t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f36t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f37t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f37t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f38t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f38t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f39t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT f39t from s1_fdata where vref = 1998 LIMIT 1
		   40 Query	SELECT * FROM s1_abdata where vref = 37184
		   40 Query	SELECT * FROM s1_abdata where vref = 1998
		   40 Query	UPDATE s1_units set u99o = u99o +  0 WHERE vref = 1998
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 3 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37184 AND active = 1 AND type = 3 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 3 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 54 AND active = 1 AND type = 3 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 1998 AND active = 1 AND type = 3 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 54 AND active = 1 AND type = 3 AND size=2
		   40 Query	SELECT * from s1_enforcement where vref = 1998
		   40 Query	SELECT * from s1_fdata where vref = 37184
		   40 Query	SELECT * from s1_enforcement where vref = 1998
		   40 Query	SELECT * from s1_enforcement where vref = 1998
		   40 Query	SELECT * FROM s1_units WHERE vref='1998'
		   40 Query	UPDATE s1_units set u21 = u21 -  0 WHERE vref = 1998
		   40 Query	UPDATE s1_units set u22 = u22 -  0 WHERE vref = 1998
		   40 Query	UPDATE s1_units set u23 = u23 -  0 WHERE vref = 1998
		   40 Query	UPDATE s1_units set u24 = u24 -  0 WHERE vref = 1998
		   40 Query	UPDATE s1_units set u25 = u25 -  0 WHERE vref = 1998
		   40 Query	UPDATE s1_units set u26 = u26 -  0 WHERE vref = 1998
		   40 Query	UPDATE s1_units set u27 = u27 -  0 WHERE vref = 1998
		   40 Query	UPDATE s1_units set u28 = u28 -  0 WHERE vref = 1998
		   40 Query	UPDATE s1_units set u29 = u29 -  0 WHERE vref = 1998
		   40 Query	UPDATE s1_units set u30 = u30 -  0 WHERE vref = 1998
		   40 Query	UPDATE s1_units set hero = hero -   WHERE vref = 1998
		   40 Query	SELECT * from s1_enforcement where vref = 1998
		   40 Query	UPDATE s1_attacks set t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0 WHERE id = 2052
		   40 Query	UPDATE s1_attacks set t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0 WHERE id = 2052
		   40 Query	UPDATE s1_users set dpall = dpall + 0 where id = 54
		   40 Query	UPDATE s1_users set apall = apall + 0 where id = 51
		   40 Query	UPDATE s1_users set dp = dp + 0 where id = 54
		   40 Query	UPDATE s1_users set ap = ap + 0 where id = 51
		   40 Query	UPDATE s1_alidata set Adp = Adp + 0 where id = 0
		   40 Query	UPDATE s1_alidata set Aap = Aap + 0 where id = 0
		   40 Query	UPDATE s1_alidata set dp = dp + 0 where id = 0
		   40 Query	UPDATE s1_alidata set ap = ap + 0 where id = 0
		   40 Query	SELECT * from s1_fdata where vref = 1998
		   40 Query	SELECT owner FROM s1_vdata where wref = 1998
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 54 AND active = 1 AND type = 7 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 1998 AND active = 1 AND type = 7 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 54 AND active = 1 AND type = 7 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 0 AND ((type = 8 AND kind = 7) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 7))
		   40 Query	SELECT * FROM s1_vdata where wref = 1998
		   40 Query	SELECT * from s1_fdata where vref = 1998
		   40 Query	SELECT * FROM s1_odata where conqured = 1998
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = '1998' AND type = '4' order by size
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 54 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 54 AND type = 4 AND size=3
		   40 Query	SELECT * from s1_units where vref = 1998
		   40 Query	SELECT * from s1_enforcement where vref = 1998
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 1998 AND e.from !=1998
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 1998
		   40 Query	SELECT * FROM s1_vdata where wref = 1998
		   40 Query	SELECT tribe FROM s1_users where id = 54
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '1998' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '1998' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '1998' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 1998
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT wood,clay,iron,crop,maxstore,maxcrop from s1_vdata where wref = 1998
		   40 Query	UPDATE s1_vdata set wood = 548, clay = 551, iron = 551, crop = 714 where wref = 1998
		   40 Query	UPDATE s1_vdata set lastupdate = 1508760540 where wref = 1998
		   40 Query	SELECT * FROM s1_vdata WHERE maxstore < 800 OR maxcrop < 800
		   40 Query	SELECT * FROM s1_vdata WHERE wood > maxstore OR clay > maxstore OR iron > maxstore OR crop > maxcrop
		   40 Query	SELECT * FROM s1_vdata WHERE wood < 0 OR clay < 0 OR iron < 0 OR crop < 0
		   40 Query	SELECT clay FROM s1_vdata where wref = 1998
		   40 Query	SELECT iron FROM s1_vdata where wref = 1998
		   40 Query	SELECT wood FROM s1_vdata where wref = 1998
		   40 Query	SELECT crop FROM s1_vdata where wref = 1998
		   40 Query	SELECT capital,wref,name,pop,created from s1_vdata where owner = 54 order by pop desc
		   40 Query	INSERT INTO s1_ndata (id, uid, toWref, ally, topic, ntype, data, time, viewed) values (0,'54','1998','0','01.homok attacks A village',7,'51,37184,2,0,0,0,0,30,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,548,551,551,714,3300,54,1998,A village,3,,,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,,,,,,,,,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,,,,,',1508760044,0)
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 2 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37184 AND active = 1 AND type = 2 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 2 AND size=2
		   40 Query	SELECT * from s1_fdata where vref = 37184
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37184 AND ((type = 8 AND kind = 2) OR (owner = 51 AND size > 1 AND active = 1 AND type = 8 AND kind = 2))
		   40 Query	INSERT INTO s1_ndata (id, uid, toWref, ally, topic, ntype, data, time, viewed) values (0,'51','1998','0','01.homok attacks A village',1,'51,37184,2,0,0,0,0,30,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,548,551,551,714,3300,54,1998,A village,3,,,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,,,,,,,,,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,,,,,',1508760044,0)
		   40 Query	UPDATE s1_movement set proc = 1 where moveid = 6242
		   40 Query	INSERT INTO s1_movement values (0,4,1998,37184,2052,0,1508760044,1508770207,0,1,0,0,0,0)
		   40 Query	INSERT INTO s1_send values (0,548,551,551,714,0)
		   40 Query	SELECT wood,clay,iron,crop,maxstore,maxcrop from s1_vdata where wref = 1998
		   40 Query	UPDATE s1_vdata set wood = 0, clay = 0, iron = 0, crop = 0 where wref = 1998
		   40 Query	INSERT INTO s1_movement values (0,6,1998,37184,2078,2052,1508760044,1508770207,0,1,0,0,0,0)
		   40 Query	UPDATE s1_users set RR = RR + 2364 where id = 51
		   40 Query	UPDATE s1_users set RR = RR + -2364 where id = 54
		   40 Query	UPDATE s1_alidata set RR = RR + -2364 where id = 0
		   40 Query	UPDATE s1_alidata set RR = RR + 2364 where id = 0
		   40 Query	INSERT INTO s1_general values (0,'0','1508760540',1)
		   40 Query	SELECT * FROM s1_vdata where wref = 1998
		   40 Query	SELECT owner FROM s1_vdata where wref = 1998
		   40 Query	SELECT b4 FROM s1_users where id = 54
		   40 Query	SELECT * from s1_fdata where vref = 1998
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 1998
		   40 Query	SELECT * from s1_units where vref = 1998
		   40 Query	SELECT * from s1_enforcement where vref = 1998
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 1998 AND e.from !=1998
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 1998
		   40 Query	SELECT * FROM s1_vdata where wref = 1998
		   40 Query	SELECT tribe FROM s1_users where id = 54
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '1998' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '1998' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '1998' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 1998
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT x,y FROM s1_wdata where id = 37184
		   40 Query	SELECT x,y FROM s1_wdata where id = 1014
		   40 Query	SELECT id, oasistype FROM s1_wdata where id = 1014
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT id FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 1014
		   40 Query	SELECT id FROM s1_users where id = 69
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT tribe FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 1014
		   40 Query	SELECT tribe FROM s1_users where id = 69
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT alliance FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 1014
		   40 Query	SELECT alliance FROM s1_users where id = 69
		   40 Query	SELECT * FROM s1_wdata left JOIN s1_vdata ON s1_vdata.wref = s1_wdata.id where s1_wdata.id = 1014
		   40 Query	SELECT * FROM s1_wdata left JOIN s1_vdata ON s1_vdata.wref = s1_wdata.id where s1_wdata.id = 37184
		   40 Query	SELECT * FROM s1_vdata where wref = 1014
		   40 Query	SELECT * FROM s1_vdata where wref = 37184
		   40 Query	SELECT * from s1_units where vref = 1014
		   40 Query	SELECT evasion FROM s1_vdata where wref = 1014
		   40 Query	SELECT maxevasion FROM s1_users where id = 69
		   40 Query	SELECT gold FROM s1_users where id = 69
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '1014' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 or s1_movement.to = '1014' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * from s1_units where vref = 1014
		   40 Query	SELECT * from s1_enforcement where vref = 1014
		   40 Query	SELECT f40 from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f19t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f19t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f20t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f20t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f21t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f21t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f22t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f22t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f23t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f23t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f24t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f24t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f25t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f25t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f26t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f26t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f27t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f27t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f28t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f28t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f29t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f29t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f30t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f30t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f31t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f31t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f32t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f32t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f33t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f33t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f34t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f34t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f35t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f35t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f36t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f36t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f37t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f37t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f38t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f38t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f39t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT f39t from s1_fdata where vref = 1014 LIMIT 1
		   40 Query	SELECT * FROM s1_abdata where vref = 37184
		   40 Query	SELECT * FROM s1_abdata where vref = 1014
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 3 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37184 AND active = 1 AND type = 3 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 3 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 69 AND active = 1 AND type = 3 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 1014 AND active = 1 AND type = 3 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 69 AND active = 1 AND type = 3 AND size=2
		   40 Query	SELECT * from s1_enforcement where vref = 1014
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37184 AND ((type = 8 AND kind = 3) OR (owner = 51 AND size > 1 AND active = 1 AND type = 8 AND kind = 3))
		   40 Query	SELECT * from s1_fdata where vref = 37184
		   40 Query	SELECT * from s1_enforcement where vref = 1014
		   40 Query	SELECT * from s1_enforcement where vref = 1014
		   40 Query	SELECT * FROM s1_units WHERE vref='1014'
		   40 Query	UPDATE s1_units set u1 = u1 -  0 WHERE vref = 1014
		   40 Query	UPDATE s1_units set u2 = u2 -  0 WHERE vref = 1014
		   40 Query	UPDATE s1_units set u3 = u3 -  0 WHERE vref = 1014
		   40 Query	UPDATE s1_units set u4 = u4 -  0 WHERE vref = 1014
		   40 Query	UPDATE s1_units set u5 = u5 -  0 WHERE vref = 1014
		   40 Query	UPDATE s1_units set u6 = u6 -  0 WHERE vref = 1014
		   40 Query	UPDATE s1_units set u7 = u7 -  0 WHERE vref = 1014
		   40 Query	UPDATE s1_units set u8 = u8 -  0 WHERE vref = 1014
		   40 Query	UPDATE s1_units set u9 = u9 -  0 WHERE vref = 1014
		   40 Query	UPDATE s1_units set u10 = u10 -  0 WHERE vref = 1014
		   40 Query	UPDATE s1_units set hero = hero -   WHERE vref = 1014
		   40 Query	SELECT * from s1_enforcement where vref = 1014
		   40 Query	UPDATE s1_attacks set t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0 WHERE id = 2057
		   40 Query	UPDATE s1_attacks set t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0 WHERE id = 2057
		   40 Query	UPDATE s1_users set dpall = dpall + 0 where id = 69
		   40 Query	UPDATE s1_users set apall = apall + 0 where id = 51
		   40 Query	UPDATE s1_users set dp = dp + 0 where id = 69
		   40 Query	UPDATE s1_users set ap = ap + 0 where id = 51
		   40 Query	UPDATE s1_alidata set Adp = Adp + 0 where id = 0
		   40 Query	UPDATE s1_alidata set Aap = Aap + 0 where id = 0
		   40 Query	UPDATE s1_alidata set dp = dp + 0 where id = 0
		   40 Query	UPDATE s1_alidata set ap = ap + 0 where id = 0
		   40 Query	SELECT * from s1_fdata where vref = 1014
		   40 Query	SELECT owner FROM s1_vdata where wref = 1014
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 69 AND active = 1 AND type = 7 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 1014 AND active = 1 AND type = 7 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 69 AND active = 1 AND type = 7 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 0 AND ((type = 8 AND kind = 7) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 7))
		   40 Query	SELECT * FROM s1_vdata where wref = 1014
		   40 Query	SELECT * from s1_fdata where vref = 1014
		   40 Query	SELECT * FROM s1_odata where conqured = 1014
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = '1014' AND type = '4' order by size
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 69 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 69 AND type = 4 AND size=3
		   40 Query	SELECT * from s1_units where vref = 1014
		   40 Query	SELECT * from s1_enforcement where vref = 1014
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 1014 AND e.from !=1014
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 1014
		   40 Query	SELECT * FROM s1_vdata where wref = 1014
		   40 Query	SELECT tribe FROM s1_users where id = 69
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '1014' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '1014' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '1014' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 1014
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT wood,clay,iron,crop,maxstore,maxcrop from s1_vdata where wref = 1014
		   40 Query	UPDATE s1_vdata set wood = 308, clay = 267, iron = 368, crop = -258 where wref = 1014
		   40 Query	UPDATE s1_vdata set lastupdate = 1508760540 where wref = 1014
		   40 Query	SELECT * FROM s1_vdata WHERE maxstore < 800 OR maxcrop < 800
		   40 Query	SELECT * FROM s1_vdata WHERE wood > maxstore OR clay > maxstore OR iron > maxstore OR crop > maxcrop
		   40 Query	SELECT * FROM s1_vdata WHERE wood < 0 OR clay < 0 OR iron < 0 OR crop < 0
		   40 Query	UPDATE s1_vdata set wood = 308.00, clay = 267.00, iron = 368.00, crop = 0 where wref = 1014
		   40 Query	SELECT clay FROM s1_vdata where wref = 1014
		   40 Query	SELECT iron FROM s1_vdata where wref = 1014
		   40 Query	SELECT wood FROM s1_vdata where wref = 1014
		   40 Query	SELECT crop FROM s1_vdata where wref = 1014
		   40 Query	SELECT capital,wref,name,pop,created from s1_vdata where owner = 69 order by pop desc
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 2 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37184 AND active = 1 AND type = 2 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 2 AND size=2
		   40 Query	SELECT * from s1_fdata where vref = 37184
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37184 AND ((type = 8 AND kind = 2) OR (owner = 51 AND size > 1 AND active = 1 AND type = 8 AND kind = 2))
		   40 Query	INSERT INTO s1_ndata (id, uid, toWref, ally, topic, ntype, data, time, viewed) values (0,'51','1014','0','01.homok scouts Negroo\'s village',18,'51,37184,2,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,69,1014,Negroo\'s village,1,,,1,14,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,,,,,,,14,<div class=\"res\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" />308 |\r\n				 <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />267 |\r\n				 <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />368 |\r\n				 <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />0</div>\r\n				 <div class=\"carry\"><img class=\"car\" src=\"img/x.gif\" alt=\"carry\" title=\"carry\" />Total Resources : 943</div>\r\n	,,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0',1508760071,0)
		   40 Query	UPDATE s1_movement set proc = 1 where moveid = 6247
		   40 Query	INSERT INTO s1_movement values (0,4,1014,37184,2057,0,1508760071,1508769737,0,1,0,0,0,0)
		   40 Query	SELECT * FROM s1_vdata where wref = 1014
		   40 Query	SELECT owner FROM s1_vdata where wref = 1014
		   40 Query	SELECT b4 FROM s1_users where id = 69
		   40 Query	SELECT * from s1_fdata where vref = 1014
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 1014
		   40 Query	SELECT * from s1_units where vref = 1014
		   40 Query	SELECT * from s1_enforcement where vref = 1014
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 1014 AND e.from !=1014
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 1014
		   40 Query	SELECT * FROM s1_vdata where wref = 1014
		   40 Query	SELECT tribe FROM s1_users where id = 69
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '1014' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '1014' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '1014' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 1014
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	UPDATE s1_vdata set starv = '36' where wref = 1014
		   40 Query	UPDATE s1_vdata set starvupdate = '1508760540' where wref = 1014
		   40 Query	SELECT x,y FROM s1_wdata where id = 18790
		   40 Query	SELECT x,y FROM s1_wdata where id = 16780
		   40 Query	SELECT id, oasistype FROM s1_wdata where id = 16780
		   40 Query	SELECT owner FROM s1_vdata where wref = 18790
		   40 Query	SELECT id FROM s1_users where id = 7
		   40 Query	SELECT owner FROM s1_odata where wref = 16780
		   40 Query	SELECT id FROM s1_users where id = 2
		   40 Query	SELECT owner FROM s1_vdata where wref = 18790
		   40 Query	SELECT tribe FROM s1_users where id = 7
		   40 Query	SELECT owner FROM s1_odata where wref = 16780
		   40 Query	SELECT tribe FROM s1_users where id = 2
		   40 Query	SELECT owner FROM s1_vdata where wref = 18790
		   40 Query	SELECT alliance FROM s1_users where id = 7
		   40 Query	SELECT owner FROM s1_odata where wref = 16780
		   40 Query	SELECT alliance FROM s1_users where id = 2
		   40 Query	SELECT * FROM s1_wdata left JOIN s1_odata ON s1_odata.wref = s1_wdata.id where s1_wdata.id = 16780
		   40 Query	SELECT * FROM s1_wdata left JOIN s1_vdata ON s1_vdata.wref = s1_wdata.id where s1_wdata.id = 18790
		   40 Query	SELECT * FROM s1_odata where wref = 16780
		   40 Query	SELECT * FROM s1_vdata where wref = 18790
		   40 Query	SELECT * from s1_units where vref = 16780
		   40 Query	SELECT * from s1_enforcement where vref = 16780
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 7 AND active = 1 AND type = 3 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 18790 AND active = 1 AND type = 3 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 7 AND active = 1 AND type = 3 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 2 AND active = 1 AND type = 3 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 16780 AND active = 1 AND type = 3 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 2 AND active = 1 AND type = 3 AND size=2
		   40 Query	SELECT * FROM s1_hero WHERE dead=0 AND uid=7 LIMIT 1
		   40 Query	SELECT * from s1_enforcement where vref = 16780
		   40 Query	SELECT * from s1_fdata where vref = 18790
		   40 Query	select * from s1_hero where `dead`='0' and `heroid`=4
		   40 Query	update s1_hero set `health`=`health`-22 where `heroid`=4
		   40 Query	SELECT * from s1_enforcement where vref = 16780
		   40 Query	SELECT * from s1_enforcement where vref = 16780
		   40 Query	SELECT * FROM s1_units WHERE vref='16780'
		   40 Query	UPDATE s1_units set u31 = u31 -  11 WHERE vref = 16780
		   40 Query	UPDATE s1_units set u32 = u32 -  0 WHERE vref = 16780
		   40 Query	UPDATE s1_units set u33 = u33 -  35 WHERE vref = 16780
		   40 Query	UPDATE s1_units set u34 = u34 -  0 WHERE vref = 16780
		   40 Query	UPDATE s1_units set u35 = u35 -  0 WHERE vref = 16780
		   40 Query	UPDATE s1_units set u36 = u36 -  0 WHERE vref = 16780
		   40 Query	UPDATE s1_units set u37 = u37 -  7 WHERE vref = 16780
		   40 Query	UPDATE s1_units set u38 = u38 -  20 WHERE vref = 16780
		   40 Query	UPDATE s1_units set u39 = u39 -  26 WHERE vref = 16780
		   40 Query	UPDATE s1_units set u40 = u40 -  3 WHERE vref = 16780
		   40 Query	UPDATE s1_units set hero = hero -   WHERE vref = 16780
		   40 Query	SELECT * from s1_enforcement where vref = 16780
		   40 Query	UPDATE s1_attacks set t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 27, t6=t6 - 49, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0 WHERE id = 2059
		   40 Query	UPDATE s1_attacks set t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0 WHERE id = 2059
		   40 Query	UPDATE s1_hero SET experience = experience + 220 WHERE uid=7
		   40 Query	UPDATE s1_users set dpall = dpall + 277 where id = 2
		   40 Query	UPDATE s1_users set apall = apall + 220 where id = 7
		   40 Query	UPDATE s1_users set dp = dp + 277 where id = 2
		   40 Query	UPDATE s1_users set ap = ap + 220 where id = 7
		   40 Query	UPDATE s1_alidata set Adp = Adp + 277 where id = 0
		   40 Query	UPDATE s1_alidata set Aap = Aap + 220 where id = 1
		   40 Query	UPDATE s1_alidata set dp = dp + 277 where id = 0
		   40 Query	UPDATE s1_alidata set ap = ap + 220 where id = 1
		   40 Query	SELECT * FROM s1_odata where wref = 16780
		   40 Query	SELECT * from s1_fdata where vref = 16780
		   40 Query	SELECT wood,clay,iron,crop,maxstore,maxcrop from s1_odata where wref = 16780
		   40 Query	UPDATE s1_odata set wood = 800, clay = 800, iron = 800, crop = -4256 where wref = 16780
		   40 Query	UPDATE s1_odata set lastupdated = 1508760540 where wref = 16780
		   40 Query	SELECT * FROM s1_odata WHERE maxstore < 800 OR maxcrop < 800
		   40 Query	SELECT * FROM s1_odata WHERE wood < 0 OR clay < 0 OR iron < 0 OR crop < 0
		   40 Query	UPDATE s1_odata set wood = 800, clay = 800, iron = 800, crop = 0 where wref = 16780
		   40 Query	SELECT clay FROM s1_odata where wref = 16780
		   40 Query	SELECT iron FROM s1_odata where wref = 16780
		   40 Query	SELECT wood FROM s1_odata where wref = 16780
		   40 Query	SELECT crop FROM s1_odata where wref = 16780
		   40 Query	SELECT * FROM s1_hero WHERE uid = 7
		   40 Query	SELECT capital,wref,name,pop,created from s1_vdata where owner = 2 order by pop desc
		   40 Query	select * from s1_units where `vref`=16780
		   40 Query	select * from s1_enforcement where `vref`=16780
		   40 Query	SELECT * from s1_fdata where vref = 18790
		   40 Query	SELECT count(*) FROM `s1_odata` WHERE conqured=18790
		   40 Query	SELECT * FROM s1_odata where wref = 16780
		   40 Query	SELECT x,y FROM s1_wdata where id = 18790
		   40 Query	SELECT x,y FROM s1_wdata where id = 16780
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 7 AND active = 1 AND type = 2 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 18790 AND active = 1 AND type = 2 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 7 AND active = 1 AND type = 2 AND size=2
		   40 Query	SELECT * from s1_fdata where vref = 18790
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 18790 AND ((type = 8 AND kind = 2) OR (owner = 7 AND size > 1 AND active = 1 AND type = 8 AND kind = 2))
		   40 Query	INSERT INTO s1_ndata (id, uid, toWref, ally, topic, ntype, data, time, viewed) values (0,'7','16780','1','1 attacks Unoccupied Oasis',2,'7,18790,1,0,0,191,0,122,216,0,0,0,0,0,0,0,0,27,49,0,0,0,0,0,0,0,0,0,2,16780,Unoccupied Oasis,4,,,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,14,0,45,0,0,0,9,26,33,4,11,0,35,0,0,0,7,20,26,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,,,,,,,14,<div class=\"res\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" />308 |\r\n				 <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />267 |\r\n				 <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />368 |\r\n				 <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />0</div>\r\n				 <div class=\"carry\"><img class=\"car\" src=\"img/x.gif\" alt=\"carry\" title=\"carry\" />Total Resources : 943</div>\r\n	,,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0',1508760214,0)
		   40 Query	UPDATE s1_movement set proc = 1 where moveid = 6262
		   40 Query	INSERT INTO s1_movement values (0,4,16780,18790,2059,0,1508760214,1508765357,0,1,0,0,0,0)
		   40 Query	INSERT INTO s1_send values (0,800,800,800,0,0)
		   40 Query	SELECT wood,clay,iron,crop,maxstore,maxcrop from s1_odata where wref = 16780
		   40 Query	UPDATE s1_odata set wood = 0, clay = 0, iron = 0, crop = 0 where wref = 16780
		   40 Query	INSERT INTO s1_movement values (0,6,16780,18790,2079,2059,1508760214,1508765357,0,1,0,0,0,0)
		   40 Query	UPDATE s1_users set RR = RR + 2400 where id = 7
		   40 Query	UPDATE s1_users set RR = RR + -4764 where id = 2
		   40 Query	UPDATE s1_alidata set RR = RR + -4764 where id = 0
		   40 Query	UPDATE s1_alidata set RR = RR + 2400 where id = 1
		   40 Query	INSERT INTO s1_general values (0,'178','1508760540',1)
		   40 Query	SELECT * FROM s1_vdata where wref = 16780
		   40 Query	SELECT owner FROM s1_vdata where wref = 16780
		   40 Query	SELECT b4 FROM s1_users where username = 'Multihunter'
		   40 Query	SELECT * from s1_fdata where vref = 16780
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 16780
		   40 Query	SELECT * from s1_units where vref = 16780
		   40 Query	SELECT * from s1_enforcement where vref = 16780
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 16780 AND e.from !=16780
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 16780
		   40 Query	SELECT * FROM s1_vdata where wref = 16780
		   40 Query	SELECT tribe FROM s1_users where username = 'Multihunter'
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '16780' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '16780' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '16780' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 16780
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	UPDATE s1_vdata set starv = '63' where wref = 16780
		   40 Query	UPDATE s1_vdata set starvupdate = '1508760540' where wref = 16780
		   40 Query	SELECT x,y FROM s1_wdata where id = 37184
		   40 Query	SELECT x,y FROM s1_wdata where id = 2804
		   40 Query	SELECT id, oasistype FROM s1_wdata where id = 2804
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT id FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 2804
		   40 Query	SELECT id FROM s1_users where id = 74
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT tribe FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 2804
		   40 Query	SELECT tribe FROM s1_users where id = 74
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT alliance FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 2804
		   40 Query	SELECT alliance FROM s1_users where id = 74
		   40 Query	SELECT * FROM s1_wdata left JOIN s1_vdata ON s1_vdata.wref = s1_wdata.id where s1_wdata.id = 2804
		   40 Query	SELECT * FROM s1_wdata left JOIN s1_vdata ON s1_vdata.wref = s1_wdata.id where s1_wdata.id = 37184
		   40 Query	SELECT * FROM s1_vdata where wref = 2804
		   40 Query	SELECT * FROM s1_vdata where wref = 37184
		   40 Query	SELECT * from s1_units where vref = 2804
		   40 Query	SELECT evasion FROM s1_vdata where wref = 2804
		   40 Query	SELECT maxevasion FROM s1_users where id = 74
		   40 Query	SELECT gold FROM s1_users where id = 74
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '2804' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 or s1_movement.to = '2804' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * from s1_units where vref = 2804
		   40 Query	SELECT * from s1_enforcement where vref = 2804
		   40 Query	SELECT f40 from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f19t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f19t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f20t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f20t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f21t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f21t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f22t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f22t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f23t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f23t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f24t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f24t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f25t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f25t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f26t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f26t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f27t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f27t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f28t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f28t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f29t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f29t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f30t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f30t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f31t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f31t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f32t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f32t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f33t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f33t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f34t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f34t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f35t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f35t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f36t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f36t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f37t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f37t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f38t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f38t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f39t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT f39t from s1_fdata where vref = 2804 LIMIT 1
		   40 Query	SELECT * FROM s1_abdata where vref = 37184
		   40 Query	SELECT * FROM s1_abdata where vref = 2804
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 3 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37184 AND active = 1 AND type = 3 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 3 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 74 AND active = 1 AND type = 3 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 2804 AND active = 1 AND type = 3 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 74 AND active = 1 AND type = 3 AND size=2
		   40 Query	SELECT * from s1_enforcement where vref = 2804
		   40 Query	SELECT * from s1_fdata where vref = 37184
		   40 Query	SELECT * from s1_enforcement where vref = 2804
		   40 Query	SELECT * from s1_enforcement where vref = 2804
		   40 Query	SELECT * FROM s1_units WHERE vref='2804'
		   40 Query	UPDATE s1_units set u1 = u1 -  0 WHERE vref = 2804
		   40 Query	UPDATE s1_units set u2 = u2 -  0 WHERE vref = 2804
		   40 Query	UPDATE s1_units set u3 = u3 -  0 WHERE vref = 2804
		   40 Query	UPDATE s1_units set u4 = u4 -  0 WHERE vref = 2804
		   40 Query	UPDATE s1_units set u5 = u5 -  0 WHERE vref = 2804
		   40 Query	UPDATE s1_units set u6 = u6 -  0 WHERE vref = 2804
		   40 Query	UPDATE s1_units set u7 = u7 -  0 WHERE vref = 2804
		   40 Query	UPDATE s1_units set u8 = u8 -  0 WHERE vref = 2804
		   40 Query	UPDATE s1_units set u9 = u9 -  0 WHERE vref = 2804
		   40 Query	UPDATE s1_units set u10 = u10 -  0 WHERE vref = 2804
		   40 Query	UPDATE s1_units set hero = hero -   WHERE vref = 2804
		   40 Query	SELECT * from s1_enforcement where vref = 2804
		   40 Query	UPDATE s1_attacks set t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 27, t6=t6 - 49, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0 WHERE id = 2051
		   40 Query	UPDATE s1_attacks set t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0 WHERE id = 2051
		   40 Query	UPDATE s1_users set dpall = dpall + 277 where id = 74
		   40 Query	UPDATE s1_users set apall = apall + 220 where id = 51
		   40 Query	UPDATE s1_users set dp = dp + 277 where id = 74
		   40 Query	UPDATE s1_users set ap = ap + 220 where id = 51
		   40 Query	UPDATE s1_alidata set Adp = Adp + 277 where id = 0
		   40 Query	UPDATE s1_alidata set Aap = Aap + 220 where id = 0
		   40 Query	UPDATE s1_alidata set dp = dp + 277 where id = 0
		   40 Query	UPDATE s1_alidata set ap = ap + 220 where id = 0
		   40 Query	SELECT * from s1_fdata where vref = 2804
		   40 Query	SELECT owner FROM s1_vdata where wref = 2804
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 74 AND active = 1 AND type = 7 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 2804 AND active = 1 AND type = 7 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 74 AND active = 1 AND type = 7 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 0 AND ((type = 8 AND kind = 7) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 7))
		   40 Query	SELECT * FROM s1_vdata where wref = 2804
		   40 Query	SELECT * from s1_fdata where vref = 2804
		   40 Query	SELECT * FROM s1_odata where conqured = 2804
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = '2804' AND type = '4' order by size
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 74 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 74 AND type = 4 AND size=3
		   40 Query	SELECT * from s1_units where vref = 2804
		   40 Query	SELECT * from s1_enforcement where vref = 2804
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 2804 AND e.from !=2804
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 2804
		   40 Query	SELECT * FROM s1_vdata where wref = 2804
		   40 Query	SELECT tribe FROM s1_users where id = 74
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '2804' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '2804' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '2804' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 2804
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT wood,clay,iron,crop,maxstore,maxcrop from s1_vdata where wref = 2804
		   40 Query	UPDATE s1_vdata set wood = 15, clay = 15, iron = 15, crop = 19 where wref = 2804
		   40 Query	UPDATE s1_vdata set lastupdate = 1508760540 where wref = 2804
		   40 Query	SELECT * FROM s1_vdata WHERE maxstore < 800 OR maxcrop < 800
		   40 Query	SELECT * FROM s1_vdata WHERE wood > maxstore OR clay > maxstore OR iron > maxstore OR crop > maxcrop
		   40 Query	SELECT * FROM s1_vdata WHERE wood < 0 OR clay < 0 OR iron < 0 OR crop < 0
		   40 Query	SELECT clay FROM s1_vdata where wref = 2804
		   40 Query	SELECT iron FROM s1_vdata where wref = 2804
		   40 Query	SELECT wood FROM s1_vdata where wref = 2804
		   40 Query	SELECT crop FROM s1_vdata where wref = 2804
		   40 Query	SELECT capital,wref,name,pop,created from s1_vdata where owner = 74 order by pop desc
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 2 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37184 AND active = 1 AND type = 2 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 2 AND size=2
		   40 Query	SELECT * from s1_fdata where vref = 37184
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37184 AND ((type = 8 AND kind = 2) OR (owner = 51 AND size > 1 AND active = 1 AND type = 8 AND kind = 2))
		   40 Query	INSERT INTO s1_ndata (id, uid, toWref, ally, topic, ntype, data, time, viewed) values (0,'51','2804','0','01.homok attacks asdfqwerty\'s village',1,'51,37184,2,0,0,0,0,30,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,74,2804,asdfqwerty\'s village,1,,,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,,,,,,,14,<div class=\"res\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" />308 |\r\n				 <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />267 |\r\n				 <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />368 |\r\n				 <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />0</div>\r\n				 <div class=\"carry\"><img class=\"car\" src=\"img/x.gif\" alt=\"carry\" title=\"carry\" />Total Resources : 943</div>\r\n	,,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0',1508760250,0)
		   40 Query	UPDATE s1_movement set proc = 1 where moveid = 6241
		   40 Query	INSERT INTO s1_movement values (0,4,2804,37184,2051,0,1508760250,1508771526,0,1,0,0,0,0)
		   40 Query	INSERT INTO s1_send values (0,15,15,15,19,0)
		   40 Query	SELECT wood,clay,iron,crop,maxstore,maxcrop from s1_vdata where wref = 2804
		   40 Query	UPDATE s1_vdata set wood = 0, clay = 0, iron = 0, crop = 0 where wref = 2804
		   40 Query	INSERT INTO s1_movement values (0,6,2804,37184,2080,2051,1508760250,1508771526,0,1,0,0,0,0)
		   40 Query	UPDATE s1_users set RR = RR + 64 where id = 51
		   40 Query	UPDATE s1_users set RR = RR + -4828 where id = 74
		   40 Query	UPDATE s1_alidata set RR = RR + -4828 where id = 0
		   40 Query	UPDATE s1_alidata set RR = RR + 64 where id = 0
		   40 Query	INSERT INTO s1_general values (0,'0','1508760540',1)
		   40 Query	SELECT * FROM s1_vdata where wref = 2804
		   40 Query	SELECT owner FROM s1_vdata where wref = 2804
		   40 Query	SELECT b4 FROM s1_users where id = 74
		   40 Query	SELECT * from s1_fdata where vref = 2804
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 2804
		   40 Query	SELECT * from s1_units where vref = 2804
		   40 Query	SELECT * from s1_enforcement where vref = 2804
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 2804 AND e.from !=2804
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 2804
		   40 Query	SELECT * FROM s1_vdata where wref = 2804
		   40 Query	SELECT tribe FROM s1_users where id = 74
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '2804' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '2804' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '2804' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 2804
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT x,y FROM s1_wdata where id = 37184
		   40 Query	SELECT x,y FROM s1_wdata where id = 1794
		   40 Query	SELECT id, oasistype FROM s1_wdata where id = 1794
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT id FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 1794
		   40 Query	SELECT id FROM s1_users where id = 49
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT tribe FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 1794
		   40 Query	SELECT tribe FROM s1_users where id = 49
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT alliance FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 1794
		   40 Query	SELECT alliance FROM s1_users where id = 49
		   40 Query	SELECT * FROM s1_wdata left JOIN s1_vdata ON s1_vdata.wref = s1_wdata.id where s1_wdata.id = 1794
		   40 Query	SELECT * FROM s1_wdata left JOIN s1_vdata ON s1_vdata.wref = s1_wdata.id where s1_wdata.id = 37184
		   40 Query	SELECT * FROM s1_vdata where wref = 1794
		   40 Query	SELECT * FROM s1_vdata where wref = 37184
		   40 Query	SELECT * from s1_units where vref = 1794
		   40 Query	SELECT evasion FROM s1_vdata where wref = 1794
		   40 Query	SELECT maxevasion FROM s1_users where id = 49
		   40 Query	SELECT gold FROM s1_users where id = 49
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '1794' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 or s1_movement.to = '1794' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * from s1_units where vref = 1794
		   40 Query	SELECT * from s1_enforcement where vref = 1794
		   40 Query	SELECT f40 from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f19t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f19t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f20t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f20t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f21t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f21t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f22t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f22t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f23t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f23t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f24t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f24t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f25t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f25t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f26t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f26t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f27t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f27t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f28t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f28t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f29t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f29t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f30t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f30t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f31t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f31t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f32t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f32t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f33t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f33t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f34t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f34t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f35t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f35t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f36t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f36t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f37t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f37t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f38t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f38t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f39t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT f39t from s1_fdata where vref = 1794 LIMIT 1
		   40 Query	SELECT * FROM s1_abdata where vref = 37184
		   40 Query	SELECT * FROM s1_abdata where vref = 1794
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 3 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37184 AND active = 1 AND type = 3 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 3 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 49 AND active = 1 AND type = 3 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 1794 AND active = 1 AND type = 3 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 49 AND active = 1 AND type = 3 AND size=2
		   40 Query	SELECT * from s1_enforcement where vref = 1794
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37184 AND ((type = 8 AND kind = 3) OR (owner = 51 AND size > 1 AND active = 1 AND type = 8 AND kind = 3))
		   40 Query	SELECT * from s1_fdata where vref = 37184
		   40 Query	SELECT * from s1_enforcement where vref = 1794
		   40 Query	SELECT * from s1_enforcement where vref = 1794
		   40 Query	SELECT * FROM s1_units WHERE vref='1794'
		   40 Query	UPDATE s1_units set u1 = u1 -  0 WHERE vref = 1794
		   40 Query	UPDATE s1_units set u2 = u2 -  0 WHERE vref = 1794
		   40 Query	UPDATE s1_units set u3 = u3 -  0 WHERE vref = 1794
		   40 Query	UPDATE s1_units set u4 = u4 -  0 WHERE vref = 1794
		   40 Query	UPDATE s1_units set u5 = u5 -  0 WHERE vref = 1794
		   40 Query	UPDATE s1_units set u6 = u6 -  0 WHERE vref = 1794
		   40 Query	UPDATE s1_units set u7 = u7 -  0 WHERE vref = 1794
		   40 Query	UPDATE s1_units set u8 = u8 -  0 WHERE vref = 1794
		   40 Query	UPDATE s1_units set u9 = u9 -  0 WHERE vref = 1794
		   40 Query	UPDATE s1_units set u10 = u10 -  0 WHERE vref = 1794
		   40 Query	UPDATE s1_units set hero = hero -   WHERE vref = 1794
		   40 Query	SELECT * from s1_enforcement where vref = 1794
		   40 Query	UPDATE s1_attacks set t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 27, t6=t6 - 49, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0 WHERE id = 2053
		   40 Query	UPDATE s1_attacks set t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0 WHERE id = 2053
		   40 Query	UPDATE s1_users set dpall = dpall + 277 where id = 49
		   40 Query	UPDATE s1_users set apall = apall + 220 where id = 51
		   40 Query	UPDATE s1_users set dp = dp + 277 where id = 49
		   40 Query	UPDATE s1_users set ap = ap + 220 where id = 51
		   40 Query	UPDATE s1_alidata set Adp = Adp + 277 where id = 0
		   40 Query	UPDATE s1_alidata set Aap = Aap + 220 where id = 0
		   40 Query	UPDATE s1_alidata set dp = dp + 277 where id = 0
		   40 Query	UPDATE s1_alidata set ap = ap + 220 where id = 0
		   40 Query	SELECT * from s1_fdata where vref = 1794
		   40 Query	SELECT owner FROM s1_vdata where wref = 1794
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 49 AND active = 1 AND type = 7 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 1794 AND active = 1 AND type = 7 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 49 AND active = 1 AND type = 7 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 0 AND ((type = 8 AND kind = 7) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 7))
		   40 Query	SELECT * FROM s1_vdata where wref = 1794
		   40 Query	SELECT * from s1_fdata where vref = 1794
		   40 Query	SELECT * FROM s1_odata where conqured = 1794
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = '1794' AND type = '4' order by size
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 49 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 49 AND type = 4 AND size=3
		   40 Query	SELECT * from s1_units where vref = 1794
		   40 Query	SELECT * from s1_enforcement where vref = 1794
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 1794 AND e.from !=1794
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 1794
		   40 Query	SELECT * FROM s1_vdata where wref = 1794
		   40 Query	SELECT tribe FROM s1_users where id = 49
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '1794' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '1794' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '1794' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 1794
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT wood,clay,iron,crop,maxstore,maxcrop from s1_vdata where wref = 1794
		   40 Query	UPDATE s1_vdata set wood = 5, clay = 4, iron = 3, crop = 0 where wref = 1794
		   40 Query	UPDATE s1_vdata set lastupdate = 1508760540 where wref = 1794
		   40 Query	SELECT * FROM s1_vdata WHERE maxstore < 800 OR maxcrop < 800
		   40 Query	SELECT * FROM s1_vdata WHERE wood > maxstore OR clay > maxstore OR iron > maxstore OR crop > maxcrop
		   40 Query	SELECT * FROM s1_vdata WHERE wood < 0 OR clay < 0 OR iron < 0 OR crop < 0
		   40 Query	SELECT clay FROM s1_vdata where wref = 1794
		   40 Query	SELECT iron FROM s1_vdata where wref = 1794
		   40 Query	SELECT wood FROM s1_vdata where wref = 1794
		   40 Query	SELECT crop FROM s1_vdata where wref = 1794
		   40 Query	SELECT capital,wref,name,pop,created from s1_vdata where owner = 49 order by pop desc
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 2 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37184 AND active = 1 AND type = 2 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 2 AND size=2
		   40 Query	SELECT * from s1_fdata where vref = 37184
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37184 AND ((type = 8 AND kind = 2) OR (owner = 51 AND size > 1 AND active = 1 AND type = 8 AND kind = 2))
		   40 Query	INSERT INTO s1_ndata (id, uid, toWref, ally, topic, ntype, data, time, viewed) values (0,'51','1794','0','01.homok scouts Fastfood\'s village',18,'51,37184,2,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,49,1794,Fastfood\'s village,1,,,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,,,,,,,14,<div class=\"res\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" />5 |\r\n				 <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />4 |\r\n				 <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />3 |\r\n				 <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />0</div>\r\n				 <div class=\"carry\"><img class=\"car\" src=\"img/x.gif\" alt=\"carry\" title=\"carry\" />Total Resources : 12</div>\r\n	,,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0',1508760320,0)
		   40 Query	UPDATE s1_movement set proc = 1 where moveid = 6243
		   40 Query	INSERT INTO s1_movement values (0,4,1794,37184,2053,0,1508760320,1508771781,0,1,0,0,0,0)
		   40 Query	SELECT * FROM s1_vdata where wref = 1794
		   40 Query	SELECT owner FROM s1_vdata where wref = 1794
		   40 Query	SELECT b4 FROM s1_users where id = 49
		   40 Query	SELECT * from s1_fdata where vref = 1794
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 1794
		   40 Query	SELECT * from s1_units where vref = 1794
		   40 Query	SELECT * from s1_enforcement where vref = 1794
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 1794 AND e.from !=1794
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 1794
		   40 Query	SELECT * FROM s1_vdata where wref = 1794
		   40 Query	SELECT tribe FROM s1_users where id = 49
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '1794' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '1794' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '1794' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 1794
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT x,y FROM s1_wdata where id = 37184
		   40 Query	SELECT x,y FROM s1_wdata where id = 1994
		   40 Query	SELECT id, oasistype FROM s1_wdata where id = 1994
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT id FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 1994
		   40 Query	SELECT id FROM s1_users where id = 78
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT tribe FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 1994
		   40 Query	SELECT tribe FROM s1_users where id = 78
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT alliance FROM s1_users where id = 51
		   40 Query	SELECT owner FROM s1_vdata where wref = 1994
		   40 Query	SELECT alliance FROM s1_users where id = 78
		   40 Query	SELECT * FROM s1_wdata left JOIN s1_vdata ON s1_vdata.wref = s1_wdata.id where s1_wdata.id = 1994
		   40 Query	SELECT * FROM s1_wdata left JOIN s1_vdata ON s1_vdata.wref = s1_wdata.id where s1_wdata.id = 37184
		   40 Query	SELECT * FROM s1_vdata where wref = 1994
		   40 Query	SELECT * FROM s1_vdata where wref = 37184
		   40 Query	SELECT * from s1_units where vref = 1994
		   40 Query	SELECT evasion FROM s1_vdata where wref = 1994
		   40 Query	SELECT maxevasion FROM s1_users where id = 78
		   40 Query	SELECT gold FROM s1_users where id = 78
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '1994' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 or s1_movement.to = '1994' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * from s1_units where vref = 1994
		   40 Query	SELECT * from s1_enforcement where vref = 1994
		   40 Query	SELECT f40 from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f19t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f19t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f20t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f20t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f21t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f21t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f22t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f22t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f23t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f23t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f24t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f24t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f25t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f25t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f26t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f26t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f27t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f27t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f28t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f28t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f29t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f29t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f30t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f30t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f31t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f31t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f32t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f32t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f33t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f33t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f34t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f34t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f35t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f35t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f36t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f36t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f37t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f37t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f38t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f38t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f39t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT f39t from s1_fdata where vref = 1994 LIMIT 1
		   40 Query	SELECT * FROM s1_abdata where vref = 37184
		   40 Query	SELECT * FROM s1_abdata where vref = 1994
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 3 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37184 AND active = 1 AND type = 3 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 3 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 78 AND active = 1 AND type = 3 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 1994 AND active = 1 AND type = 3 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 78 AND active = 1 AND type = 3 AND size=2
		   40 Query	SELECT * from s1_enforcement where vref = 1994
		   40 Query	SELECT owner FROM s1_vdata where wref = 0
		   40 Query	SELECT tribe FROM s1_users where username = 'Multihunter'
		   40 Query	SELECT owner FROM s1_vdata where wref = 0
		   40 Query	SELECT * FROM s1_hero
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37184 AND ((type = 8 AND kind = 3) OR (owner = 51 AND size > 1 AND active = 1 AND type = 8 AND kind = 3))
		   40 Query	SELECT * from s1_fdata where vref = 37184
		   40 Query	SELECT * from s1_enforcement where vref = 1994
		   40 Query	SELECT * from s1_enforcement where vref = 1994
		   40 Query	SELECT * FROM s1_units WHERE vref='1994'
		   40 Query	UPDATE s1_units set u1 = u1 -  0 WHERE vref = 1994
		   40 Query	UPDATE s1_units set u2 = u2 -  0 WHERE vref = 1994
		   40 Query	UPDATE s1_units set u3 = u3 -  0 WHERE vref = 1994
		   40 Query	UPDATE s1_units set u4 = u4 -  0 WHERE vref = 1994
		   40 Query	UPDATE s1_units set u5 = u5 -  0 WHERE vref = 1994
		   40 Query	UPDATE s1_units set u6 = u6 -  0 WHERE vref = 1994
		   40 Query	UPDATE s1_units set u7 = u7 -  0 WHERE vref = 1994
		   40 Query	UPDATE s1_units set u8 = u8 -  0 WHERE vref = 1994
		   40 Query	UPDATE s1_units set u9 = u9 -  0 WHERE vref = 1994
		   40 Query	UPDATE s1_units set u10 = u10 -  0 WHERE vref = 1994
		   40 Query	UPDATE s1_units set hero = hero -   WHERE vref = 1994
		   40 Query	SELECT * from s1_enforcement where vref = 1994
		   40 Query	SELECT * from s1_enforcement where vref = 1994
		   40 Query	UPDATE s1_enforcement set u31 = u31 - 0 where id = 4
		   40 Query	SELECT owner FROM s1_vdata where wref = 0
		   40 Query	UPDATE s1_attacks set t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 27, t6=t6 - 49, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0 WHERE id = 2054
		   40 Query	UPDATE s1_attacks set t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0 WHERE id = 2054
		   40 Query	UPDATE s1_users set dpall = dpall + 277 where id = 78
		   40 Query	UPDATE s1_users set apall = apall + 220 where id = 51
		   40 Query	UPDATE s1_users set dp = dp + 277 where id = 78
		   40 Query	UPDATE s1_users set ap = ap + 220 where id = 51
		   40 Query	UPDATE s1_alidata set Adp = Adp + 277 where id = 0
		   40 Query	UPDATE s1_alidata set Aap = Aap + 220 where id = 0
		   40 Query	UPDATE s1_alidata set dp = dp + 277 where id = 0
		   40 Query	UPDATE s1_alidata set ap = ap + 220 where id = 0
		   40 Query	SELECT * from s1_fdata where vref = 1994
		   40 Query	SELECT owner FROM s1_vdata where wref = 1994
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 78 AND active = 1 AND type = 7 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 1994 AND active = 1 AND type = 7 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 78 AND active = 1 AND type = 7 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 0 AND ((type = 8 AND kind = 7) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 7))
		   40 Query	SELECT * FROM s1_vdata where wref = 1994
		   40 Query	SELECT * from s1_fdata where vref = 1994
		   40 Query	SELECT * FROM s1_odata where conqured = 1994
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = '1994' AND type = '4' order by size
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 78 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 78 AND type = 4 AND size=3
		   40 Query	SELECT * from s1_units where vref = 1994
		   40 Query	SELECT * from s1_enforcement where vref = 1994
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 1994 AND e.from !=1994
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 1994
		   40 Query	SELECT * FROM s1_vdata where wref = 1994
		   40 Query	SELECT tribe FROM s1_users where id = 78
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '1994' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '1994' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '1994' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 1994
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT wood,clay,iron,crop,maxstore,maxcrop from s1_vdata where wref = 1994
		   40 Query	UPDATE s1_vdata set wood = 1200, clay = 1200, iron = 1200, crop = 437 where wref = 1994
		   40 Query	UPDATE s1_vdata set lastupdate = 1508760540 where wref = 1994
		   40 Query	SELECT * FROM s1_vdata WHERE maxstore < 800 OR maxcrop < 800
		   40 Query	SELECT * FROM s1_vdata WHERE wood > maxstore OR clay > maxstore OR iron > maxstore OR crop > maxcrop
		   40 Query	SELECT * FROM s1_vdata WHERE wood < 0 OR clay < 0 OR iron < 0 OR crop < 0
		   40 Query	SELECT clay FROM s1_vdata where wref = 1994
		   40 Query	SELECT iron FROM s1_vdata where wref = 1994
		   40 Query	SELECT wood FROM s1_vdata where wref = 1994
		   40 Query	SELECT crop FROM s1_vdata where wref = 1994
		   40 Query	SELECT capital,wref,name,pop,created from s1_vdata where owner = 78 order by pop desc
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 2 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37184 AND active = 1 AND type = 2 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 51 AND active = 1 AND type = 2 AND size=2
		   40 Query	SELECT * from s1_fdata where vref = 37184
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 37184 AND ((type = 8 AND kind = 2) OR (owner = 51 AND size > 1 AND active = 1 AND type = 8 AND kind = 2))
		   40 Query	INSERT INTO s1_ndata (id, uid, toWref, ally, topic, ntype, data, time, viewed) values (0,'51','1994','0','01.homok scouts sonya',18,'51,37184,2,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,78,1994,sonya,1,,,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,,,,,,,14,<div class=\"res\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" />1200 |\r\n				 <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />1200 |\r\n				 <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />1200 |\r\n				 <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />437</div>\r\n				 <div class=\"carry\"><img class=\"car\" src=\"img/x.gif\" alt=\"carry\" title=\"carry\" />Total Resources : 4037</div>\r\n	,,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0',1508760444,0)
		   40 Query	UPDATE s1_movement set proc = 1 where moveid = 6244
		   40 Query	INSERT INTO s1_movement values (0,4,1994,37184,2054,0,1508760444,1508772451,0,1,0,0,0,0)
		   40 Query	SELECT * FROM s1_vdata where wref = 1994
		   40 Query	SELECT owner FROM s1_vdata where wref = 1994
		   40 Query	SELECT b4 FROM s1_users where id = 78
		   40 Query	SELECT * from s1_fdata where vref = 1994
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 1994
		   40 Query	SELECT * from s1_units where vref = 1994
		   40 Query	SELECT * from s1_enforcement where vref = 1994
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 1994 AND e.from !=1994
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 1994
		   40 Query	SELECT * FROM s1_vdata where wref = 1994
		   40 Query	SELECT tribe FROM s1_users where id = 78
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '1994' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '1994' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '1994' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 1994
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT x,y FROM s1_wdata where id = 2417
		   40 Query	SELECT x,y FROM s1_wdata where id = 2223
		   40 Query	SELECT id, oasistype FROM s1_wdata where id = 2223
		   40 Query	SELECT owner FROM s1_vdata where wref = 2417
		   40 Query	SELECT id FROM s1_users where id = 81
		   40 Query	SELECT owner FROM s1_vdata where wref = 2223
		   40 Query	SELECT id FROM s1_users where id = 68
		   40 Query	SELECT owner FROM s1_vdata where wref = 2417
		   40 Query	SELECT tribe FROM s1_users where id = 81
		   40 Query	SELECT owner FROM s1_vdata where wref = 2223
		   40 Query	SELECT tribe FROM s1_users where id = 68
		   40 Query	SELECT owner FROM s1_vdata where wref = 2417
		   40 Query	SELECT alliance FROM s1_users where id = 81
		   40 Query	SELECT owner FROM s1_vdata where wref = 2223
		   40 Query	SELECT alliance FROM s1_users where id = 68
		   40 Query	SELECT * FROM s1_wdata left JOIN s1_vdata ON s1_vdata.wref = s1_wdata.id where s1_wdata.id = 2223
		   40 Query	SELECT * FROM s1_wdata left JOIN s1_vdata ON s1_vdata.wref = s1_wdata.id where s1_wdata.id = 2417
		   40 Query	SELECT * FROM s1_vdata where wref = 2223
		   40 Query	SELECT * FROM s1_vdata where wref = 2417
		   40 Query	SELECT * from s1_units where vref = 2223
		   40 Query	SELECT evasion FROM s1_vdata where wref = 2223
		   40 Query	SELECT maxevasion FROM s1_users where id = 68
		   40 Query	SELECT gold FROM s1_users where id = 68
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '2223' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 or s1_movement.to = '2223' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * from s1_units where vref = 2223
		   40 Query	SELECT * from s1_enforcement where vref = 2223
		   40 Query	SELECT f40 from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f19t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f19t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f20t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f20t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f21t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f21t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f22t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f22t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f23t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f23t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f24t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f24t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f25t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f25t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f26t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f26t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f27t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f27t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f28t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f28t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f29t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f29t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f30t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f30t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f31t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f31t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f32t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f32t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f33t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f33t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f34t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f34t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f35t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f35t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f36t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f36t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f37t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f37t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f38t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f38t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f39t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT f39t from s1_fdata where vref = 2223 LIMIT 1
		   40 Query	SELECT * FROM s1_abdata where vref = 2417
		   40 Query	SELECT * FROM s1_abdata where vref = 2223
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 81 AND active = 1 AND type = 3 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 2417 AND active = 1 AND type = 3 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 81 AND active = 1 AND type = 3 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 68 AND active = 1 AND type = 3 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 2223 AND active = 1 AND type = 3 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 68 AND active = 1 AND type = 3 AND size=2
		   40 Query	SELECT * from s1_enforcement where vref = 2223
		   40 Query	SELECT * from s1_fdata where vref = 2417
		   40 Query	SELECT * from s1_enforcement where vref = 2223
		   40 Query	SELECT * from s1_enforcement where vref = 2223
		   40 Query	SELECT * FROM s1_units WHERE vref='2223'
		   40 Query	UPDATE s1_units set u1 = u1 -  0 WHERE vref = 2223
		   40 Query	UPDATE s1_units set u2 = u2 -  0 WHERE vref = 2223
		   40 Query	UPDATE s1_units set u3 = u3 -  0 WHERE vref = 2223
		   40 Query	UPDATE s1_units set u4 = u4 -  0 WHERE vref = 2223
		   40 Query	UPDATE s1_units set u5 = u5 -  0 WHERE vref = 2223
		   40 Query	UPDATE s1_units set u6 = u6 -  0 WHERE vref = 2223
		   40 Query	UPDATE s1_units set u7 = u7 -  0 WHERE vref = 2223
		   40 Query	UPDATE s1_units set u8 = u8 -  0 WHERE vref = 2223
		   40 Query	UPDATE s1_units set u9 = u9 -  0 WHERE vref = 2223
		   40 Query	UPDATE s1_units set u10 = u10 -  0 WHERE vref = 2223
		   40 Query	UPDATE s1_units set hero = hero -   WHERE vref = 2223
		   40 Query	SELECT * from s1_enforcement where vref = 2223
		   40 Query	UPDATE s1_attacks set t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 27, t6=t6 - 49, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0 WHERE id = 2062
		   40 Query	UPDATE s1_attacks set t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0t1=t1 - 0, t2=t2 - 0, t3=t3 - 0, t4=t4 - 0, t5=t5 - 0, t6=t6 - 0, t7=t7 - 0, t8=t8 - 0, t9=t9 - 0, t10=t10 - 0, t11=t11 - 0 WHERE id = 2062
		   40 Query	UPDATE s1_users set dpall = dpall + 277 where id = 68
		   40 Query	UPDATE s1_users set apall = apall + 220 where id = 81
		   40 Query	UPDATE s1_users set dp = dp + 277 where id = 68
		   40 Query	UPDATE s1_users set ap = ap + 220 where id = 81
		   40 Query	UPDATE s1_alidata set Adp = Adp + 277 where id = 0
		   40 Query	UPDATE s1_alidata set Aap = Aap + 220 where id = 3
		   40 Query	UPDATE s1_alidata set dp = dp + 277 where id = 0
		   40 Query	UPDATE s1_alidata set ap = ap + 220 where id = 3
		   40 Query	SELECT * from s1_fdata where vref = 2223
		   40 Query	SELECT owner FROM s1_vdata where wref = 2223
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 68 AND active = 1 AND type = 7 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 2223 AND active = 1 AND type = 7 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 68 AND active = 1 AND type = 7 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 0 AND ((type = 8 AND kind = 7) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 7))
		   40 Query	SELECT * FROM s1_vdata where wref = 2223
		   40 Query	SELECT * from s1_fdata where vref = 2223
		   40 Query	SELECT * FROM s1_odata where conqured = 2223
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = '2223' AND type = '4' order by size
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 68 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 68 AND type = 4 AND size=3
		   40 Query	SELECT * from s1_units where vref = 2223
		   40 Query	SELECT * from s1_enforcement where vref = 2223
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 2223 AND e.from !=2223
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 2223
		   40 Query	SELECT * FROM s1_vdata where wref = 2223
		   40 Query	SELECT tribe FROM s1_users where id = 68
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '2223' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '2223' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '2223' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 2223
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT wood,clay,iron,crop,maxstore,maxcrop from s1_vdata where wref = 2223
		   40 Query	UPDATE s1_vdata set wood = 200, clay = 175, iron = 220, crop = 186 where wref = 2223
		   40 Query	UPDATE s1_vdata set lastupdate = 1508760540 where wref = 2223
		   40 Query	SELECT * FROM s1_vdata WHERE maxstore < 800 OR maxcrop < 800
171023 14:09:01	   40 Query	SELECT * FROM s1_vdata WHERE wood > maxstore OR clay > maxstore OR iron > maxstore OR crop > maxcrop
		   40 Query	SELECT * FROM s1_vdata WHERE wood < 0 OR clay < 0 OR iron < 0 OR crop < 0
		   40 Query	SELECT clay FROM s1_vdata where wref = 2223
		   40 Query	SELECT iron FROM s1_vdata where wref = 2223
		   40 Query	SELECT wood FROM s1_vdata where wref = 2223
		   40 Query	SELECT crop FROM s1_vdata where wref = 2223
		   40 Query	SELECT capital,wref,name,pop,created from s1_vdata where owner = 68 order by pop desc
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 81 AND active = 1 AND type = 2 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 2417 AND active = 1 AND type = 2 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 81 AND active = 1 AND type = 2 AND size=2
		   40 Query	SELECT * from s1_fdata where vref = 2417
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 2417 AND ((type = 8 AND kind = 2) OR (owner = 81 AND size > 1 AND active = 1 AND type = 8 AND kind = 2))
		   40 Query	INSERT INTO s1_ndata (id, uid, toWref, ally, topic, ntype, data, time, viewed) values (0,'81','2223','3','??? attacks Negro\'s village',1,'81,2417,3,30,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,68,2223,Negro\'s village,1,,,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,,,,,,,14,<div class=\"res\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" />1200 |\r\n				 <img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />1200 |\r\n				 <img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />1200 |\r\n				 <img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />437</div>\r\n				 <div class=\"carry\"><img class=\"car\" src=\"img/x.gif\" alt=\"carry\" title=\"carry\" />Total Resources : 4037</div>\r\n	,,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0',1508760521,0)
		   40 Query	UPDATE s1_movement set proc = 1 where moveid = 6270
		   40 Query	INSERT INTO s1_movement values (0,4,2223,2417,2062,0,1508760521,1508764158,0,1,0,0,0,0)
		   40 Query	INSERT INTO s1_send values (0,70,45,90,56,0)
		   40 Query	SELECT wood,clay,iron,crop,maxstore,maxcrop from s1_vdata where wref = 2223
		   40 Query	UPDATE s1_vdata set wood = 130, clay = 130, iron = 130, crop = 130 where wref = 2223
		   40 Query	INSERT INTO s1_movement values (0,6,2223,2417,2081,2062,1508760521,1508764158,0,1,0,0,0,0)
		   40 Query	UPDATE s1_users set RR = RR + 261 where id = 81
		   40 Query	UPDATE s1_users set RR = RR + -5089 where id = 68
		   40 Query	UPDATE s1_alidata set RR = RR + -5089 where id = 0
		   40 Query	UPDATE s1_alidata set RR = RR + 261 where id = 3
		   40 Query	INSERT INTO s1_general values (0,'0','1508760541',1)
		   40 Query	SELECT * FROM s1_vdata where wref = 2223
		   40 Query	SELECT owner FROM s1_vdata where wref = 2223
		   40 Query	SELECT b4 FROM s1_users where id = 68
		   40 Query	SELECT * from s1_fdata where vref = 2223
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 2223
		   40 Query	SELECT * from s1_units where vref = 2223
		   40 Query	SELECT * from s1_enforcement where vref = 2223
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 2223 AND e.from !=2223
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 2223
		   40 Query	SELECT * FROM s1_vdata where wref = 2223
		   40 Query	SELECT tribe FROM s1_users where id = 68
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '2223' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '2223' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '2223' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 2223
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	UPDATE s1_vdata set starv = '22' where wref = 2223
		   40 Query	UPDATE s1_vdata set starvupdate = '1508760541' where wref = 2223
		   40 Query	SELECT * FROM s1_vdata WHERE loyalty<>100
		   40 Query	SELECT * FROM s1_odata WHERE loyalty<>100
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.ref = s1_attacks.id and s1_movement.proc = '0' and s1_movement.sort_type = '3' and s1_attacks.attack_type = '2' and endtime < 1508760541
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.ref = s1_attacks.id and s1_movement.proc = '0' and s1_movement.sort_type = '4' and endtime < 1508760541
		   40 Query	SELECT owner FROM s1_vdata where wref = 2417
		   40 Query	SELECT tribe FROM s1_users where id = 81
		   40 Query	UPDATE s1_units set u21 = u21 +  10, u22 = u22 +  0, u23 = u23 +  0, u24 = u24 +  0, u25 = u25 +  0, u26 = u26 +  0, u27 = u27 +  0, u28 = u28 +  0, u29 = u29 +  0, u30 = u30 +  0, hero = hero +  0 WHERE vref = 2417
		   40 Query	UPDATE s1_movement set proc = 1 where moveid = 6267
		   40 Query	SELECT owner FROM s1_vdata where wref = 2417
		   40 Query	SELECT b4 FROM s1_users where id = 81
		   40 Query	SELECT * from s1_fdata where vref = 2417
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 2417
		   40 Query	SELECT * from s1_units where vref = 2417
		   40 Query	SELECT * from s1_enforcement where vref = 2417
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 2417 AND e.from !=2417
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 2417
		   40 Query	SELECT * FROM s1_vdata where wref = 2417
		   40 Query	SELECT tribe FROM s1_users where id = 81
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '2417' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '2417' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '2417' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 2417
		   40 Query	SELECT * FROM s1_vdata where wref = 2417
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT starv FROM s1_vdata where wref = 2417
		   40 Query	UPDATE s1_vdata set starv = '286' where wref = 2417
		   40 Query	UPDATE s1_vdata set starvupdate = '1508760541' where wref = 2417
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT tribe FROM s1_users where id = 51
		   40 Query	UPDATE s1_units set u11 = u11 +  0, u12 = u12 +  0, u13 = u13 +  0, u14 = u14 +  1, u15 = u15 +  0, u16 = u16 +  0, u17 = u17 +  0, u18 = u18 +  0, u19 = u19 +  0, u20 = u20 +  0, hero = hero +  0 WHERE vref = 37184
		   40 Query	UPDATE s1_movement set proc = 1 where moveid = 6258
		   40 Query	SELECT owner FROM s1_vdata where wref = 37184
		   40 Query	SELECT b4 FROM s1_users where id = 51
		   40 Query	SELECT * from s1_fdata where vref = 37184
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 37184
		   40 Query	SELECT * from s1_units where vref = 37184
		   40 Query	SELECT * from s1_enforcement where vref = 37184
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 37184 AND e.from !=37184
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 37184
		   40 Query	SELECT * FROM s1_vdata where wref = 37184
		   40 Query	SELECT tribe FROM s1_users where id = 51
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '37184' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '37184' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '37184' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 37184
		   40 Query	SELECT * FROM s1_vdata where wref = 37184
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT starv FROM s1_vdata where wref = 37184
		   40 Query	SELECT * FROM s1_movement, s1_send where s1_movement.ref = s1_send.id and s1_movement.proc = 0 and sort_type = 6 and endtime < 1508760541
		   40 Query	SELECT * FROM s1_wdata left JOIN s1_vdata ON s1_vdata.wref = s1_wdata.id where s1_wdata.id = 2417
		   40 Query	SELECT * FROM s1_wdata left JOIN s1_vdata ON s1_vdata.wref = s1_wdata.id where s1_wdata.id = 3423
		   40 Query	SELECT wood,clay,iron,crop,maxstore,maxcrop from s1_vdata where wref = 2417
		   40 Query	UPDATE s1_vdata set wood = 4816, clay = 6832, iron = 8085, crop = 9600 where wref = 2417
		   40 Query	UPDATE s1_movement set proc = 1 where moveid = 6268
		   40 Query	SELECT owner FROM s1_vdata where wref = 2417
		   40 Query	SELECT b4 FROM s1_users where id = 81
		   40 Query	SELECT * from s1_fdata where vref = 2417
		   40 Query	SELECT type FROM `s1_odata` WHERE conqured = 2417
		   40 Query	SELECT * from s1_units where vref = 2417
		   40 Query	SELECT * from s1_enforcement where vref = 2417
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 2417 AND e.from !=2417
		   40 Query	SELECT e.*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = 2417
		   40 Query	SELECT * FROM s1_vdata where wref = 2417
		   40 Query	SELECT tribe FROM s1_users where id = 81
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '2417' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '2417' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '2417' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_prisoners where `from` = 2417
		   40 Query	SELECT * FROM s1_vdata where wref = 2417
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT owner FROM s1_vdata where wref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Query	SELECT starv FROM s1_vdata where wref = 2417
		   40 Query	UPDATE s1_vdata set starv = '286' where wref = 2417
		   40 Query	SELECT * FROM s1_vdata WHERE maxstore < 800 OR maxcrop < 800
		   40 Query	SELECT * FROM s1_vdata WHERE wood > maxstore OR clay > maxstore OR iron > maxstore OR crop > maxcrop
		   40 Query	SELECT * FROM s1_vdata WHERE wood < 0 OR clay < 0 OR iron < 0 OR crop < 0
		   40 Query	SELECT * FROM s1_movement where ref = 0 and proc = '0' and sort_type = '4' and endtime < 1508760541
		   40 Query	SELECT * FROM s1_movement where proc = 0 and sort_type = 5 and endtime < 1508760541.065
		   40 Query	SELECT * FROM s1_general WHERE shown = 1
		   40 Query	SELECT * FROM s1_users WHERE invited != 0
		   40 Query	SELECT * FROM `s1_fdata`
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 216
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 594
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 1700 WHERE `wref` = 997
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 1014
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 800 WHERE `wref` = 1202
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 11800, `maxcrop` = 4000 WHERE `wref` = 1592
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 1794
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 1801
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 1994
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 1998
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 2001
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 2009
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 2223
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 9600, `maxcrop` = 9600 WHERE `wref` = 2417
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 2603
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 2605
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 2804
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 3423
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 3804
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 3100, `maxcrop` = 3100 WHERE `wref` = 4012
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 16379
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 16570
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 16573
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 1200 WHERE `wref` = 16980
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 17004
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 4000 WHERE `wref` = 17173
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 17578
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18173
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18581
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18584
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 80000, `maxcrop` = 80000 WHERE `wref` = 18790
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 25900, `maxcrop` = 17600 WHERE `wref` = 18791
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18810
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18980
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18987
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 18991
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 19013
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 800 WHERE `wref` = 19209
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 19212
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 20201
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 20587
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 37900, `maxcrop` = 21400 WHERE `wref` = 20599
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 9600, `maxcrop` = 3100 WHERE `wref` = 20801
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 20812
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 20986
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 25900, `maxcrop` = 17600 WHERE `wref` = 21002
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21187
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 21392
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21396
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21423
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21816
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 21996
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 800 WHERE `wref` = 22214
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 22395
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 22430
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 80000, `maxcrop` = 80000 WHERE `wref` = 22609
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23010
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23036
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23229
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23230
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23406
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 66400, `maxcrop` = 80000 WHERE `wref` = 23623
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23635
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 23636
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 24011
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 24032
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 24037
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 36591
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 36597
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 36770
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 36994
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 36995
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 36998
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 36999
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 80000, `maxcrop` = 80000 WHERE `wref` = 37184
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 37189
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 37192
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 37605
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 17600, `maxcrop` = 11800 WHERE `wref` = 37988
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 800 WHERE `wref` = 38196
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 38385
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 38607
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 38779
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1700 WHERE `wref` = 38801
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 39012
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 39177
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 39187
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 2300 WHERE `wref` = 39209
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 800, `maxcrop` = 800 WHERE `wref` = 39585
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 2300, `maxcrop` = 1700 WHERE `wref` = 39604
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1200, `maxcrop` = 1200 WHERE `wref` = 39792
		   40 Query	UPDATE `s1_vdata` SET `maxstore` = 1700, `maxcrop` = 1200 WHERE `wref` = 39804
		   40 Query	SELECT * FROM s1_banlist WHERE active = 1 and end < 1508760541
		   40 Query	SELECT * FROM s1_odata where conqured = 0 and lastupdated2 < 1508717341
		   40 Query	SELECT * FROM s1_config
		   40 Query	SELECT * FROM s1_artefacts where type = 8 and active = 1 and lastupdate <= 1508674141
		   40 Query	SELECT timestamp from s1_deleting where uid = 6
		   40 Query	SELECT * FROM s1_odata where conqured = 22609
		   40 Query	SELECT * FROM s1_movement,s1_odata, s1_attacks where s1_odata.wref = '22810' and s1_movement.to = 22810 and s1_movement.ref = s1_attacks.id and s1_attacks.attack_type != 1 and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement,s1_odata, s1_attacks where s1_odata.wref = '23008' and s1_movement.to = 23008 and s1_movement.ref = s1_attacks.id and s1_attacks.attack_type != 1 and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.to = '22609' and sort_type = 4 and ref = 0 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '22609' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 and s1_attacks.attack_type = 1 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.to = '22609' and sort_type = 4 and ref = 0 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 4 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.to = '22609' and sort_type = 4 and ref = 0 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.to = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement, s1_attacks where s1_movement.from = '22609' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '22609' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement where s1_movement.from = '22609' and sort_type = 5 and proc = 0 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_odata where conqured = 22609
		   40 Query	SELECT * FROM s1_movement,s1_odata, s1_attacks where s1_odata.wref = '22810' and s1_movement.to = 22810 and s1_movement.ref = s1_attacks.id and s1_attacks.attack_type != 1 and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement,s1_odata, s1_attacks where s1_odata.wref = '22810' and s1_movement.to = 22810 and s1_movement.ref = s1_attacks.id and s1_attacks.attack_type != 1 and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement,s1_odata, s1_attacks where s1_odata.wref = '23008' and s1_movement.to = 23008 and s1_movement.ref = s1_attacks.id and s1_attacks.attack_type != 1 and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * FROM s1_movement,s1_odata, s1_attacks where s1_odata.wref = '23008' and s1_movement.to = 23008 and s1_movement.ref = s1_attacks.id and s1_attacks.attack_type != 1 and s1_movement.proc = 0 and s1_movement.sort_type = 3 ORDER BY endtime ASC
		   40 Query	SELECT * from s1_units where vref = 22609
		   40 Query	SELECT * from s1_enforcement where vref = 22609
		   40 Query	SELECT * from s1_units where vref = 22609
		   40 Query	SELECT * FROM s1_bdata where wid = 22609 order by master,timestamp ASC
		   40 Query	SELECT a.wref, a.name, b.x, b.y from s1_vdata AS a left join s1_wdata AS b ON b.id = a.wref where owner = 6 order by capital DESC,pop DESC
		   40 Query	SELECT Count(*) as Total FROM s1_users WHERE timestamp > 1508759941 AND tribe!=0 AND tribe!=4 AND tribe!=5
		   40 Query	SELECT * FROM s1_users WHERE access< 8 AND id > 5 AND tribe<=3 AND tribe > 0 ORDER BY oldrank ASC Limit 1
		   40 Query	SELECT * FROM `s1_links` WHERE `userid` = 6 ORDER BY `pos` ASC
		   40 Query	SELECT * from s1_fdata where vref = 22609
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=3
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND active = 1 AND type = 4 AND size=1
		   40 Query	SELECT * FROM s1_artefacts WHERE owner = 6 AND active = 1 AND type = 4 AND size=2
		   40 Query	SELECT * FROM s1_artefacts WHERE vref = 22609 AND ((type = 8 AND kind = 4) OR (owner = 6 AND size > 1 AND active = 1 AND type = 8 AND kind = 4))
		   40 Quit	
";
  
    /*
    // we need to replace all escaped quotes or the regex below will go nuts
    $src = str_replace(['\\"', "\\'"], ['[Q1]', '[Q1]'], $src);
    
    $regexes = [
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Init DB[ \t]+travian\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SET NAMES \'UTF8\'\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT Count\(\*\) as Total FROM s1_users WHERE timestamp > \d{0,100} AND tribe!=\d{1,2} AND tribe!=\d{1,2} AND tribe!=\d{1,2}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_users WHERE access< 8 AND id > \d{1,5} AND tribe<=3 AND tribe > 0 ORDER BY oldrank ASC Limit 1\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Quit[ \t]+\n?/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT username FROM s1_users where username = \'[^\']+\' LIMIT 1\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT id,password,sessid,is_bcrypt FROM s1_users where username = \'[^\']+\'\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT (act|vac_mode|quest) FROM s1_users where username = \'[^\']+\'\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_users where username = \'[^\']+\'\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_users SET vac_mode = \'\d{0,100}\' , vac_time=\'\d{0,100}\' WHERE id=\d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+INSERT IGNORE INTO s1_online \(name, uid, time, sit\) VALUES \(\'[^\']+\', \d{0,100}, \'\d{0,100}\', \d{0,100}\)\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT id, village_select FROM `s1_users` WHERE `username`=\'[^\']+\'\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM `s1_vdata` WHERE `wref` = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT wref from s1_vdata where owner = \d{0,100} order by capital DESC,pop DESC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT sit(2)? FROM s1_online where uid = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT SUM\(hero\) from s1_enforcement where `from` = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT (SUM\(hero\)|\*) from s1_units where (`)?vref(`)?( )?=( )?(\')?\d{0,100}(\')?\n/i',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT SUM\(t\d{0,100}\) from s1_prisoners where `from` = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_movement, s1_attacks where s1_movement.from = \'\d{0,100}\' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = \d{0,100} ORDER BY endtime ASC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_movement, s1_attacks where s1_movement.to = \'\d{0,100}\' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = \d{0,100} ORDER BY endtime ASC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT dead FROM s1_hero WHERE `uid` = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT inrevive FROM s1_hero WHERE `uid` = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT intraining FROM s1_hero WHERE `uid` = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+REPLACE into s1_active values \(\'[^\']+\',\d{0,100}\)\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_users set sessid = \'[^\']+\' where username = \'[^\']+\'\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+Insert into s1_login_log values \(\d{0,100},\d{0,100},\'[^\']+\'\)\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Connect[ \t]+[^@]+@[a-zA-Z]+ as anonymous on \n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_users set timestamp = (\')?\d{0,100}(\')? where username = \'[^\']+\'\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_mdata WHERE target IN\([^)]+\) and send = 0 and archived = 0 ORDER BY time DESC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_mdata WHERE owner IN\([^)]+\) ORDER BY time DESC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_mdata WHERE target IN\([^)]+\) and send = 0 and archived = 0 and deltarget = 0 ORDER BY time DESC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_mdata WHERE owner IN\([^)]+\) and delowner = 0 ORDER BY time DESC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_mdata where target IN\([^)]+\) and send = 0 and archived = 1\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_mdata where target IN\([^)]+\) and send = 0 and archived = 1 and deltarget = 0\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_ndata where uid = \d{0,100} ORDER BY time DESC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_ndata where uid = \d{0,100} and del = 0 ORDER BY time DESC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT (\*|evasion) FROM s1_vdata where wref = (\'?)\d{0,100}(\')?\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT (\*|f\d{0,100}t) from s1_fdata where vref = \d{0,100}( LIMIT 1)?\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT x,y FROM s1_wdata where id = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT id, fieldtype FROM s1_wdata where id = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_odata where conqured = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* from s1_units where vref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* from s1_enforcement where (\`)?vref(\`)?( )?=( )?\d{0,100}\n/i',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* from s1_enforcement where `from` = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT e.\*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = \d{0,100} AND e.from !=\d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT e.\*,o.conqured FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref where o.conqured = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_prisoners where `from` = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT (tribe|plus|gold|alliance|b4|id|maxevasion) FROM s1_users where (id = \d{0,100}|username = \'[^\']+\')\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_movement where s1_movement.from = \'\d{0,100}\' and sort_type = 5 and proc = 0 ORDER BY endtime ASC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* from s1_tdata where vref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_abdata where vref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_research where vref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_bdata where wid = \d{0,100} and master = 1 order by master,timestamp ASC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_artefacts WHERE vref = \'\d{0,100}\' AND type = \'\d{0,100}\' order by size\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_artefacts WHERE owner = \d{0,100} AND type = \d{0,100} AND size=\d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_artefacts WHERE owner = \d{0,100} AND active = 1 AND type = \d{0,100} AND size=\d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_artefacts WHERE vref = \d{0,100} AND active = 1 AND type = \d{0,100} AND size=\d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_artefacts WHERE vref = \d{0,100} AND \(\(type = \d{0,100} AND kind = \d{0,100}\) OR \(owner = \d{0,100} AND size > 1 AND active = 1 AND type = \d{0,100} AND kind = \d{0,100}\)\)\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT wood,clay,iron,crop,maxstore,maxcrop from s1_(v|o)data where wref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_vdata set wood = (-)?\d{0,100}(\.\d{0,100})?, clay = (-)?\d{0,100}(\.\d{0,100})?, iron = (-)?\d{0,100}(\.\d{0,100})?, crop = (-)?\d{0,100}(\.\d{0,100})? where wref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_vdata set lastupdate = \d{0,100} where wref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_bdata where wid = \d{0,100} order by master,timestamp ASC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT count\(id\) FROM s1_users where id > 5\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT s1_users.id userid, s1_users.username username, s1_users.oldrank oldrank, s1_users.alliance alliance, \(\n[^A-Za-z]+SELECT SUM\( s1_vdata.pop \)\n[^A-Za-z]+FROM s1_vdata\n[^A-Za-z]+WHERE s1_vdata.owner = userid\n[^A-Za-z]+\)totalpop, \(\n[^A-Za-z]+SELECT COUNT\( s1_vdata.wref \)\n[^A-Za-z]+FROM s1_vdata\n[^A-Za-z]+WHERE s1_vdata.owner = userid AND type != 99\n[^A-Za-z]+\)totalvillages, \(\n[^A-Za-z]+SELECT s1_alidata.tag\n[^A-Za-z]+FROM s1_alidata, s1_users\n[^A-Za-z]+WHERE s1_alidata.id = s1_users.alliance\n[^A-Za-z]+AND s1_users.id = userid\n[^A-Za-z]+\)allitag\n[^A-Za-z]+FROM s1_users\n[^A-Za-z]+WHERE s1_users.access < 8\n[^A-Za-z]+AND s1_users.tribe <= 5\n[^A-Za-z]+AND s1_users.id > 5\n[^A-Za-z]+ORDER BY totalpop DESC, totalvillages DESC, userid DESC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_medal order by week DESC LIMIT 0, 1\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_users where oldrank = 0 and id > 5\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+DELETE FROM s1_active WHERE timestamp < \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_odata WHERE wood < \d{0,100} OR clay < \d{0,100} OR iron < \d{0,100} OR crop < \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_odata set wood = (-)?\d{0,100}(\.\d{0,100})?, clay = (-)?\d{0,100}(\.\d{0,100})?, iron = (-)?\d{0,100}(\.\d{0,100})?, crop = (-)?\d{0,100}(\.\d{0,100})? where wref = \d{0,100}(\.\d{0,100})?\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_odata set lastupdated = \d{0,100} where wref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_vdata WHERE maxstore < \d{0,100} OR maxcrop < \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_vdata WHERE wood > maxstore OR clay > maxstore OR iron > maxstore OR crop > maxcrop\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_vdata WHERE wood < 0 OR clay < 0 OR iron < 0 OR crop < 0\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_odata WHERE maxstore < \d{0,100} OR maxcrop < \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM `s1_ww_attacks` WHERE `attack_time` <= \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT id, lastupdate FROM s1_users WHERE lastupdate < \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT sum\(cp\) FROM s1_vdata where owner = \d{0,100} and natar = 0\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_users set cp = cp \+ \d{0,100}(\.\d{0,100})?, lastupdate = \d{0,100} where id = \'\d{0,100}\'\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_hero( WHERE uid = \d{0,100})?\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_hero WHERE (`)?dead(`)?=(\')?0(\')? AND (uid|`heroid`)=\d{0,100}( LIMIT 1)?\n/i',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE `s1_hero` SET health = \'\d{0,100}\' WHERE heroid = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE `s1_hero` SET lastupdate = \'\d{0,100}\' WHERE heroid = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE `s1_hero` SET health = \'\d{0,100}(\.\d{0,100})?\' WHERE heroid = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT (uid|timestamp) FROM s1_deleting where (timestamp < \d{0,100}|uid = \d{0,100})\n/i',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_bdata where timestamp < \d{0,100} and master = 0\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT f\d{0,100} from s1_fdata where vref = \d{0,100} LIMIT 1\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_fdata set f\d{0,100} = \d{0,100}, f\d{0,100}t = \d{0,100} where vref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_vdata set cp = \d{0,100} where wref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_vdata set pop = \d{0,100} where wref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT owner FROM s1_vdata where wref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_users WHERE access < 8\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_users set (clp|dpall|apall|dp|ap|RR) = (clp|dpall|apall|dp|ap|RR) [+-] (-)?\d{0,100} where id = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_users set oldrank = \d{0,100} where id = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT id,name,tag,oldrank,Aap,Adp FROM s1_alidata where id != \'\' ORDER BY id DESC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_users where alliance = \d{0,100} order  by \(SELECT sum\(pop\) FROM s1_vdata WHERE owner =  s1_users.id\) desc, s1_users.id desc\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT sum\(pop\) FROM s1_vdata where owner = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_bdata set loopcon = 0 where loopcon = 1 and master = 0 and wid = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+DELETE FROM s1_bdata where id = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT (type|count\(\*\)) FROM `s1_odata` WHERE conqured( )?=( )?\d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT starv FROM s1_vdata where wref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_vdata set starv = \'\d{0,100}\' where wref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_vdata set starvupdate = \'\d{0,100}\' where wref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* from s1_alidata where id = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_alidata set (clp|Adp|Aap|dp|ap|RR) = (clp|Adp|Aap|dp|ap|RR) [+-] (-)?\d{0,100} where id = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_alidata set oldrank = \d{0,100} where id = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_bdata set loopcon = 0 where loopcon = 1 and master = 0 and wid = \d{0,100} and field [<>] \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_bdata WHERE master = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT (wood|clay|iron|crop) FROM s1_vdata where wref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_bdata where wid = \d{0,100} and type = \d{0,100} and master = 0\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_bdata where wid = \d{0,100} and field [<>] \d{0,100} and master = 0\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_demolition WHERE timetofinish<=\d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM `s1_fdata`\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE `s1_vdata` SET `maxstore` = \d{0,100}, `maxcrop` = \d{0,100} WHERE `wref` = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+DELETE from s1_route where timeleft < \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_route where timestamp < \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_movement, s1_send where s1_movement.ref = s1_send.id and s1_movement.proc = 0 and sort_type = 0 and endtime < \d{0,100}(\.\d{0,100})?\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_movement where proc = 0 and sort_type = 2 and endtime < \d{0,100}(\.\d{0,100})?\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_research where timestamp < \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_training where vref IS NOT NULL\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_units set ((u\d{0,100}(o)?|hero) = (u\d{0,100}(o)?|hero) [+-]  (-)?\d{0,100}(,)?( )?)* WHERE vref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_training set amt = amt - \d{0,100}, timestamp2 = timestamp2 \+ \d{0,100} where id = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_vdata where starv != 0 and owner != \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT e.\*,o.conqured,o.wref,o.high, o.owner as ownero, v.owner as ownerv FROM s1_enforcement as e LEFT JOIN s1_odata as o ON e.vref=o.wref LEFT JOIN s1_vdata as v ON e.from=v.wref where o.conqured=\d{0,100} AND o.owner(<>|=)v.owner\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT e.\*, v.owner as ownerv, v1.owner as owner1 FROM s1_enforcement as e LEFT JOIN s1_vdata as v ON e.from=v.wref LEFT JOIN s1_vdata as v1 ON e.vref=v1.wref where e.vref=\d{0,100} AND v.owner(<>|=)v1.owner\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_vdata set crop = \'\d{0,100}\' where wref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_vdata where celebration < \d{0,100} AND celebration != 0\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_movement, s1_attacks where s1_movement.ref = s1_attacks.id and s1_movement.proc = \'0\' and s1_movement.sort_type = \'\d{0,100}\' and s1_attacks.attack_type != \'\d{0,100}\' and endtime < \d{0,100} ORDER BY endtime ASC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT id, oasistype FROM s1_wdata where id = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_wdata left JOIN s1_vdata ON s1_vdata.wref = s1_wdata.id where s1_wdata.id = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_movement, s1_attacks where s1_movement.to = \'\d{0,100}\' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = \d{0,100} or s1_movement.to = \'\d{0,100}\' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = \d{0,100} ORDER BY endtime ASC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_units set hero = hero -   WHERE vref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_attacks set t1=t1 - \d{0,100}, t2=t2 - \d{0,100}, t3=t3 - \d{0,100}, t4=t4 - \d{0,100}, t5=t5 - \d{0,100}, t6=t6 - \d{0,100}, t7=t7 - \d{0,100}, t8=t8 - \d{0,100}, t9=t9 - \d{0,100}, t10=t10 - \d{0,100}, t11=t11 - \d{0,100}(t1=t1 - \d{0,100}, t2=t2 - \d{0,100}, t3=t3 - \d{0,100}, t4=t4 - \d{0,100}, t5=t5 - \d{0,100}, t6=t6 - \d{0,100}, t7=t7 - \d{0,100}, t8=t8 - \d{0,100}, t9=t9 - \d{0,100}, t10=t10 - \d{0,100}, t11=t11 - \d{0,100})*? WHERE id = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT capital,wref,name,pop,created from s1_vdata where owner = \d{0,100} order by pop desc\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+INSERT INTO s1_ndata \(id, uid, toWref, ally, topic, ntype, data, time, viewed\) values \(0,\'\d{0,100}\',\'\d{0,100}\',\'\d{0,100}\',\'[^\']+\',\d{0,100},\'[^\']+\',\d{0,100},\d{0,100}\)\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_movement set proc = 1 where moveid = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+INSERT INTO s1_movement values \([^)]+\)\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+INSERT INTO s1_send values \([^)]+\)\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+INSERT INTO s1_general values \([^)]+\)\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT (\*|owner|clay|iron|wood|crop) FROM s1_odata where wref = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_wdata left JOIN s1_odata ON s1_odata.wref = s1_wdata.id where s1_wdata.id = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+update s1_hero set (`)?(health|experience)(`)?( )?=( )?(`)?(health|experience)(`)?( )?[+-]( )?(-)?\d{0,100} where (`)?(heroid|uid)(`)?=\d{0,100}\n/i',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+UPDATE s1_enforcement set u\d{0,100} = u\d{0,100} [+-] \d{0,100} where id = \d{0,100}\n/i',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_(v|o)data WHERE loyalty<>100\n/i',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_movement, s1_attacks where s1_movement.ref = s1_attacks.id and s1_movement.proc = \'0\' and s1_movement.sort_type = \'\d{0,100}\'( and s1_attacks.attack_type = \'\d{0,100}\')? and endtime < \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_movement, s1_send where s1_movement.ref = s1_send.id and s1_movement.proc = 0 and sort_type = \d{0,100} and endtime < \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_movement where (ref = 0 and )?proc = (\')?0(\')? and sort_type = (\')?\d{0,100}(\')? and endtime < \d{0,100}(\.\d{0,100})?\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_general WHERE shown = \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_users WHERE invited != 0\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_banlist WHERE active = 1 and end < \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_odata where conqured = 0 and lastupdated2 < \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_config\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_artefacts where type = \d{0,100} and active = 1 and lastupdate <= \d{0,100}\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_movement,s1_odata, s1_attacks where s1_odata.wref = \'\d{0,100}\' and s1_movement.to = \d{0,100} and s1_movement.ref = s1_attacks.id and s1_attacks.attack_type != \d{0,100} and s1_movement.proc = 0 and s1_movement.sort_type = \d{0,100} ORDER BY endtime ASC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_movement where s1_movement.to = \'\d{0,100}\' and sort_type = \d{0,100} and ref = \d{0,100} and proc = 0 ORDER BY endtime ASC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM s1_movement, s1_attacks where s1_movement.to = \'\d{0,100}\' and s1_movement.ref = s1_attacks.id and s1_movement.proc = 0 and s1_movement.sort_type = \d{0,100} and s1_attacks.attack_type = \d{0,100} ORDER BY endtime ASC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT a.wref, a.name, b.x, b.y from s1_vdata AS a left join s1_wdata AS b ON b.id = a.wref where owner = \d{0,100} order by capital DESC,pop DESC\n/',
        '/(\d{0,100} \d{1,2}:\d{1,2}:\d{1,2})?[ \t]+\d{1,100}[ \t]+Query[ \t]+SELECT \* FROM `s1_links` WHERE `userid` = \d{0,100} ORDER BY `pos` ASC\n/',
    ];
    
    echo preg_replace($regexes, '', $src);
    */
?>