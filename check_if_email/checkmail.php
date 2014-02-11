<?php

require_once('smtp_validate.php');
// the email to validate  
$email = 'senthilmurugan@anantha.co.in';  
// an optional sender  
$sender = 'noreply@jobtardis.in';  
// instantiate the class  
$SMTP_Valid = new SMTP_validateEmail();  
// do the validation  
$result = $SMTP_Valid->validate($email, $sender);  
// view results  
var_dump($result);  
echo $email.' is '.($result ? 'valid' : 'invalid')."\n";  
  
// send email?   
if ($result) {  
  //mail(...);  
}

?>  