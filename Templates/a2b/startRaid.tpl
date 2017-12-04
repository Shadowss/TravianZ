<?php

    $slots = $_POST['slot'];
    $lid = $_POST['lid'];
    $tribe = $_POST['tribe'];
    $getFLData = $database->getFLData($lid);
    $sql = "SELECT id, towref, t1, t2, t3, t4, t5, t6, t7, t8, t9, t10 FROM ".TB_PREFIX."raidlist WHERE lid = ".$database->escape((int) $lid)." order by id asc";
	$array = $database->query_return($sql);
    foreach($array as $row){
	$sql1 = mysqli_fetch_array(mysqli_query($GLOBALS['link'],"SELECT * FROM ".TB_PREFIX."units WHERE vref = ".(int) $getFLData['wref']));
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
                    $id   = $database->addA2b( $ckey, time(), $wref, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11, 4 );

                    $data = $database->getA2b( $ckey, time() );

                    $eigen = $database->getCoor( $getFLData['wref'] );
                    $from  = array( 'x' => $eigen['x'], 'y' => $eigen['y'] );

                    $ander = $database->getCoor( $data['to_vid'] );
                    $to    = array( 'x' => $ander['x'], 'y' => $ander['y'] );

                    $start = ( $tribe - 1 ) * 10 + 1;
                    $end   = ( $tribe * 10 );

                    $speeds = array();
                    $scout  = 1;

                    //find slowest unit.
                    for ( $i = 1; $i <= 10; $i ++ ) {
                        if ( $data[ 'u' . $i ] ) {
                            if ( $data[ 'u' . $i ] != '' && $data[ 'u' . $i ] > 0 ) {
                                if ( $unitarray ) {
                                    reset( $unitarray );
                                }
                                $unitarray = $GLOBALS[ "u" . ( ( $tribe - 1 ) * 10 + $i ) ];
                                $speeds[]  = $unitarray['speed'];
                            }
                        }
                    }

                    $artefact  = count( $database->getOwnUniqueArtefactInfo2( $getFLData['owner'], 2, 3, 0 ) );
                    $artefact1 = count( $database->getOwnUniqueArtefactInfo2( $getFLData['wref'], 2, 1, 1 ) );
                    $artefact2 = count( $database->getOwnUniqueArtefactInfo2( $getFLData['owner'], 2, 2, 0 ) );

                    if ( $artefact > 0 ) {
                        $fastertroops = 3;
                    } else if ( $artefact1 > 0 ) {
                        $fastertroops = 2;
                    } else if ( $artefact2 > 0 ) {
                        $fastertroops = 1.5;
                    } else {
                        $fastertroops = 1;
                    }

                    $time         = round( $generator->procDistanceTime( $from, $to, min( $speeds ), 1 ) / $fastertroops );
                    $foolartefact = $database->getFoolArtefactInfo( 2, $village->wid, $session->uid );

                    if ( count( $foolartefact ) > 0 ) {
                        foreach ( $foolartefact as $arte ) {
                            if ( $arte['bad_effect'] == 1 ) {
                                $time *= $arte['effect2'];
                            } else {
                                $time /= $arte['effect2'];
                                $time = round( $time );
                            }
                        }
                    }

                    if ( $data['u7'] > 0 ) {
                        $ctar1 = 99;
                    } else {
                        $ctar1 = 0;
                    }

                    $ctar2      = 0;
                    $abdata     = $database->getABTech( $getFLData['wref'] );
                    $reference  = $database->addAttack( ( $getFLData['wref'] ), $data['u1'], $data['u2'], $data['u3'], $data['u4'], $data['u5'], $data['u6'], $data['u7'], $data['u8'], $data['u9'], $data['u10'], $data['u11'], $data['type'], $ctar1, $ctar2, 0, $abdata['b1'], $abdata['b2'], $abdata['b3'], $abdata['b4'], $abdata['b5'], $abdata['b6'], $abdata['b7'], $abdata['b8'] );
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

                        $units[]   = $uname2 . $unitKey;
                        $amounts[] = $data[ 'u' . $unitKey ];
                        $modes[]   = 0;
                    }

                    $units[]   = 'hero';
                    $amounts[] = $data['u11'];
                    $modes[]   = 0;

                    $database->modifyUnit( $getFLData['wref'], $units, $amounts, $modes );
                    $database->addMovement( 3, $getFLData['wref'], $data['to_vid'], $reference, time(), ( $time + time() ) );

                    // prevent re-use of the same attack via re-POSTing the same data
                    $database->remA2b( $id );
                }
    }
	}
	}
header("Location: build.php?id=39&t=99");
exit;
?>