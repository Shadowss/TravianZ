<?php 

### start config ### 

$strEmpfaenger = 'changeme@change.me'; 

$strFrom = "From: TravianiX Support <changeme@change.me>\n"; 
$strFrom .= "X-Sender: <changeme@change.me>\n"; 
$strFrom .= "X-Mailer: PHP\n"; 
$strFrom .= "X-Priority: 3\n"; 
$strFrom .= "Errors-To: <changeme@change.me>\n"; 
$strFrom .= "Return-Path: <changeme@change.me>\n"; 
$strFrom .= "Reply-To: " . $_POST['Emailadress'] . "\n"; 
$strFrom .= "Content-Type: text; charset=iso-8859-15\n"; 

$strSubject    = "New Ticket supported"; 


$strReturnhtml = 'dorf1.php'; 


$strDelimiter  = ":\t"; 

### end of config ### 

if($_POST) 
{ 
 $strMailtext = ""; 

 while(list($strName,$value) = each($_POST)) 
 { 
  if(is_array($value)) 
  { 
   foreach($value as $value_array) 
   { 
    $strMailtext .= $strName.$strDelimiter.$value_array."\n"; 
   } 
  } 
  else 
  { 
   $strMailtext .= $strName.$strDelimiter.$value."\n"; 
  } 
 } 

 if(get_magic_quotes_gpc()) 
 { 
  $strMailtext = stripslashes($strMailtext); 
 } 

 mail($strEmpfaenger, $strSubject, $strMailtext, $strFrom) 
  or die("The mail could not be send. Something get wrong!"); 
  header("Location: $strReturnhtml"); 
 exit; 
} 

?>