<?php

    $slots = $_POST['slot'];
    $lid = $_POST['lid'];
    $tribe = $_POST['tribe'];
    $getFLData = $database->getFLData($lid);
    $sql = "SELECT id, towref, t1, t2, t3, t4, t5, t6, t7, t8, t9, t10 FROM ".TB_PREFIX."raidlist WHERE lid = ".$database->escape((int) $lid)." order by id asc";
    $array = $database->query_return($sql);
    foreach($array as $row){
	    $sql1 = mysqli_fetch_array(mysqli_query($database->dblink,"SELECT * FROM ".TB_PREFIX."units WHERE vref = ".(int) $getFLData['wref']));
        $sid = $row['id'];
        $wref = $row['towref'];
        $t1 = $row['t1'];$t2 = $row['t2'];$t3 = $row['t3'];$t4 = $row['t4'];$t5 = $row['t5'];
        $t6 = $row['t6'];$t7 = $row['t7'];$t8 = $row['t8'];$t9 = $row['t9'];$t10 = $row['t10'];
        $t11 = 0;
		$villageOwner = $database->getVillageField($wref,'owner');
		$userAccess = $database->getUserField($villageOwner,'access',0);
        $userID = $database->getUserField($villageOwner,'id',0);

        if ( $userAccess != '0' && !($userAccess == MULTIHUNTER && $userID == 5) && ( $userAccess != ADMIN || ( ADMIN_ALLOW_INCOMING_RAIDS && $userAccess == ADMIN ) ) ) {
            if ( $tribe == 1 ) {
                $uname = "u";
                $uname1 = "u1";
                $uname2 = "";
            } elseif ( $tribe == 2 ) {
                $uname = "u1";
                $uname1 = "u2";
                $uname2 = "1";
            } elseif ( $tribe == 3 ) {
                $uname = "u2";
                $uname1 = "u3";
                $uname2 = "2";
            } elseif ( $tribe == 4 ) {
                $uname = "u3";
                $uname1 = "u4";
                $uname2 = "3";
            } else {
                $uname = "u4";
                $uname1 = "u5";
                $uname2 = "4";
            }

            if (
                $sql1[ $uname . '1' ] >= $t1 &&
                $sql1[ $uname . '2' ] >= $t2 &&
                $sql1[ $uname . '3' ] >= $t3 &&
                $sql1[ $uname . '4' ] >= $t4 &&
                $sql1[ $uname . '5' ] >= $t5 &&
                $sql1[ $uname . '6' ] >= $t6 &&
                $sql1[ $uname . '7' ] >= $t7 &&
                $sql1[ $uname . '8' ] >= $t8 &&
                $sql1[ $uname . '9' ] >= $t9 &&
                $sql1[ $uname1 . '0' ] >= $t10 &&
                $sql1['hero'] >= $t11
            ) {

                if ( $_POST[ 'slot' . $sid ] == 'on' ) {
                    $ckey = $generator->generateRandStr( 6 );
                    $time_now = time();
                    $id   = $database->addA2b( $ckey, $time_now, $wref, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11, 4 );

                    $data = $database->getA2b( $ckey, $time_now );
                    
                    $troopsTime = $units->getWalkingTroopsTime($getFLData['wref'], $data['to_vid'], $session->uid, $session->tribe, $data, 1, 'u');
                    $time = $database->getArtifactsValueInfluence($getFLData['owner'], $getFLData['wref'], 2, $troopsTime);

                    $ctar1 = $ctar2 = 0;
                    $abdata = $database->getABTech( $getFLData['wref'] );
                    $reference = $database->addAttack( ( $getFLData['wref'] ), $data['u1'], $data['u2'], $data['u3'], $data['u4'], $data['u5'], $data['u6'], $data['u7'], $data['u8'], $data['u9'], $data['u10'], $data['u11'], $data['type'], $ctar1, $ctar2, 0, $abdata['b1'], $abdata['b2'], $abdata['b3'], $abdata['b4'], $abdata['b5'], $abdata['b6'], $abdata['b7'], $abdata['b8'] );
                    $totalunits = $data['u1'] + $data['u2'] + $data['u3'] + $data['u4'] + $data['u5'] + $data['u6'] + $data['u7'] + $data['u8'] + $data['u9'] + $data['u10'] + $data['u11'];

                    $units   = [];
                    $amounts = [];
                    $modes   = [];

                    for ( $u = 1; $u <= 10; $u ++ ) {
                        if ($tribe == 1) {
                          $unitKey = $uname2 . $u;
                        } else {
                          $unitKey = $uname2 . ($u < 10 ? $u : 0);
                        }

                        $units[]   = $unitKey;
                        $amounts[] = $data[ 'u' . $u];
                        $modes[]   = 0;
                    }

                    $units[]   = 'hero';
                    $amounts[] = $data['u11'];
                    $modes[]   = 0;

                    $database->modifyUnit($getFLData['wref'], $units, $amounts, $modes);
                    $database->addMovement(3, $getFLData['wref'], $data['to_vid'], $reference, time(), ($time + time()));

                    // prevent re-use of the same attack via re-POSTing the same data
                    $database->remA2b( $id );
                }
    }
	}
	}
header("Location: build.php?id=39&t=99");
exit;
?>