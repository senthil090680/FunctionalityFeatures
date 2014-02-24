<?php

function smtp_mail_send($from, $to, $subject, $msg, $cc="", $bcc=""){
		//headers
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'from: ' . $from . "\r\n";		//$headers .= 'Reply-To: ' . $from . "\r\n";
		
                
                if(!empty($cc))
		{
		$headers .= "CC: $cc" . "\r\n";
		}
		if(!empty($bcc))
		{
		$headers .= "Bcc: $bcc" . "\r\n";
		}
		$headers .='X-Mailer: PHP/' . phpversion();
		//$headers .= "Origin: ".$_SERVER['REMOTE_ADDR']."\n";
		//message
		$messageheader =$msg;
		$message = wordwrap(($messageheader), 70);
		//send mail
		$response = mail($to, $subject, $message, $headers);
		return $response;
	 }
         
function mail_send_class($from, $to, $subject, $msg, $cc="", $bcc="") {
    global $Emailer;    
    $Emailer->set_to($to);
    $Emailer->set_from($from);
    $Emailer->set_sender($from);
    $Emailer->set_subject($subject);						
    $Emailer->set_html($msg);
    if(!empty($cc))
    {
        $Emailer->set_cc($cc);
    }
    if(!empty($bcc))
    {
        $Emailer->set_bcc($bcc);
    }                
    //$Emailer->add_attachments($word_path);
    $result = $Emailer->send();
}
         
         
?>

