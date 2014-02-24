<?php
function getResponse($sock){
 $response="";
 while(substr($response,-2)!=="\r\n"){
  $data=fread($sock,4096);
  if($data=="")break;
  $response .=$data;
 }
 return $response;
}

function validateEmail($email,$senderemail){
 list($name,$Domain) = split('@',$email);
 $result=getmxrr($Domain,$POFFS);
 if(!$result){$POFFS[0]=$Domain;}
 $timeout=5;
 $oldErrorLevel= error_reporting(!E_WARNING);
 $result=false;
 foreach($POFFS as $PO )
 {
  $sock = fsockopen($PO, 25, 
           $errno, $errstr,  $timeout);
  if($sock){
   fwrite($sock, "HELO ".$Domain."\n");
   $response= getResponse($sock);
   fwrite($sock,
     "MAIL FROM: <".$senderemail.">\n");
   $response= getResponse($sock);
   fwrite($sock,"RCPT TO: <".$email.">\n");
   $response= getResponse($sock);
   list($code,$msg)=explode(' ',$response);
   fwrite($sock,"RSET\n");
   $response= getResponse($sock);
   fwrite($sock,"quit\n");
   fclose($sock);
   if ($code == '250') {
    $result= true;
    break;
   }
  }
 }
 error_reporting($oldErrorLevel);
 return $result;
}

//To use the function you simply write something like:

//echo validateEmail("senthil090680@gmail.com");

//exit(0);

$actual_email	=	"sathish@vforutechnology.com";

$sender_email	=	"senthil090680@gmail.com";

if(validateEmail($actual_email,$senderemail)){
 echo "valid";
}else{
 echo "not valid";
}
//echo "hello";
?>