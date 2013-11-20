<?php
session_start();

$amount		= $_GET['amount'];
$title		= $_GET['title'];
$auth		= $_GET['auth'];
$country	= $_GET['country'];
$currency	= $_GET['currency'];
$free		= $_GET['free'];
$function	= $_GET['function'];

if(isset($_GET['amount'])) {
$id1 = $_GET['amount'];
} else {
$id1 = "";
}
if ($id1 == "") {
echo"<br>Somethings wrong";
}
if ($id1 == 199) {
$_SESSION['amount'] = $amount;
$trenner 	= "\n";
$status		= 'ok';
$url		= 'http://travian.shadowss.ro/a2b2.php'; // change to your own
$target		= '_blank';
$forward	= 0;

$response = 'status=' . $status;
$response.= $trenner;
$response.= 'url=' . $url;
$response.= $trenner;
$response.= 'target=' . $target;
$response.= $trenner;
$response.= 'forward=' . $forward;


echo $response;
}

if ($id1 == 499) {
$_SESSION['amount'] = $amount;
$trenner 	= "\n";
$status		= 'ok';
$url		= 'http://travian.shadowss.ro/a2b2.php'; // change to your own
$target		= '_blank';
$forward	= 1;

$response = 'status=' . $status;
$response.= $trenner;
$response.= 'url=' . $url;
$response.= $trenner;
$response.= 'target=' . $target;
$response.= $trenner;
$response.= 'forward=' . $forward;


echo $response;
}
if ($id1 == 999) {
$_SESSION['amount'] = $amount;
$trenner 	= "\n";
$status		= 'ok';
$url		= 'http://travian.shadowss.ro/a2b2.php'; // change to your own
$target		= '_blank';
$forward	= 1;

$response = 'status=' . $status;
$response.= $trenner;
$response.= 'url=' . $url;
$response.= $trenner;
$response.= 'target=' . $target;
$response.= $trenner;
$response.= 'forward=' . $forward;


echo $response;
}
if ($id1 == 1999) {
$_SESSION['amount'] = $amount;
$trenner 	= "\n";
$status		= 'ok';
$url		= 'http://travian.shadowss.ro/a2b2.php'; // change to your own
$target		= '_blank';
$forward	= 1;

$response = 'status=' . $status;
$response.= $trenner;
$response.= 'url=' . $url;
$response.= $trenner;
$response.= 'target=' . $target;
$response.= $trenner;
$response.= 'forward=' . $forward;


echo $response;
}
if ($id1 == 4999) {
$_SESSION['amount'] = $amount;
$trenner 	= "\n";
$status		= 'ok';
$url		= 'http://travian.shadowss.ro/a2b2.php'; // change to your own
$target		= '_blank';
$forward	= 1;

$response = 'status=' . $status;
$response.= $trenner;
$response.= 'url=' . $url;
$response.= $trenner;
$response.= 'target=' . $target;
$response.= $trenner;
$response.= 'forward=' . $forward;


echo $response;
}
?>

