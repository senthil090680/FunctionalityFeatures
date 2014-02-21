<?php
//new function 
//$to = "senthil_sang24@yahoo.co.in"; 
//$to = "senthil090680@gmail.com";
$to = "senthil.kumar@kumanti.in";
$nameto = "Who To"; 
//$from = "senthil.kumar@kumanti.in";
$from = "noreply@wwcvl.com";
$namefrom = "Who From";
$subject = "Hello World Again!"; 
$message = "World, Hello!"; 
$filePath = "41_2_24.pdf";
echo authSendEmail($from, $namefrom, $to, $nameto, $subject, $message, $filePath); 

/* * * * * * * * * * * * * * SEND EMAIL FUNCTIONS * * * * * * * * * * * * * */  

//This will send an email using auth smtp and output a log array 
//logArray - connection,  

function authSendEmail($from, $namefrom, $to, $nameto, $subject, $message, $filePath) 
{ 
	//SMTP + SERVER DETAILS 
	/* * * * CONFIGURATION START * * * */
	$smtpServer = "mail.wwcvl.com"; 
	$port = "26";
	$SmtpUser="noreply@wwcvl.com";
	$SmtpPass="2pQm_lNU_}K1";

	$localhost = " ";  //system name
	$newLine = "\r\n"; 
	/* * * * CONFIGURATION END * * * * */

	//Connect to the host on the specified port 
	$smtpConnect = fsockopen($smtpServer, $port); 
	$smtpResponse = fgets($smtpConnect, 515); 
	

	//Request Auth Login 
	fputs($smtpConnect,"AUTH LOGIN" . $newLine); 
	$smtpResponse = fgets($smtpConnect, 515); 
	$logArray['authrequest'] = "$smtpResponse"; 

	fputs($smtpConnect, $SmtpUser.$newLine);
	$logArray["user"]=fgets($smtpConnect,515);
	fputs($smtpConnect, $SmtpPass.$newLine);
	$logArray["pass"]=fgets($smtpConnect,515);

	//Say Hello to SMTP 
	fputs($smtpConnect, "HELO $localhost" . $newLine); 
	$smtpResponse = fgets($smtpConnect, 515); 
	$logArray['heloresponse'] = "$smtpResponse"; 

	//Email From 
	fputs($smtpConnect, "MAIL FROM: $from" . $newLine); 
	$smtpResponse = fgets($smtpConnect, 515); 
	$logArray['mailfromresponse'] = "$smtpResponse"; 

	//Email To 
	fputs($smtpConnect, "RCPT TO: $to" . $newLine); 
	$smtpResponse = fgets($smtpConnect, 515); 
	$logArray['mailtoresponse'] = "$smtpResponse"; 

	//The Email 
	fputs($smtpConnect, "DATA" . $newLine); 
	$smtpResponse = fgets($smtpConnect, 515); 
	$logArray['data1response'] = "$smtpResponse"; 


		$filename = basename($filePath); // Filename that will be used for the file as the attachment
		$file_size = filesize($filePath);
		$handle = fopen($filePath, "r");
		$content = fread($handle, $file_size);
		fclose($handle);
		$content = chunk_split(base64_encode($content));
		$uid = md5(uniqid(time()));
		$fext = strtolower(substr(strrchr(basename($fileatt),"."),1));
		$mtype = '';
		$allowed_ext = array (

		  // archives
		  'zip' => 'application/zip',

		  // documents
		  'txt' => 'text/plain',
		  'pdf' => 'application/pdf',
		  'doc' => 'application/msword',
			'docx' => 'application/msword',
		  'xls' => 'application/vnd.ms-excel',
			'xlsx' => 'application/vnd.ms-excel',         
		  'ppt' => 'application/vnd.ms-powerpoint',
		 
		  // executables
		  'exe' => 'application/octet-stream',

		  // images
		  'gif' => 'image/gif',
		  'png' => 'image/png',
		  'jpg' => 'image/jpeg',
		  'jpeg' => 'image/jpeg',

		  // audio
		  'mp3' => 'audio/mpeg',
		  'wav' => 'audio/x-wav',

		  // video
		  'mpeg' => 'video/mpeg',
		  'mpg' => 'video/mpeg',
		  'mpe' => 'video/mpeg',
		  'mov' => 'video/quicktime',
		  'avi' => 'video/x-msvideo'
		);

		if ($allowed_ext[$fext] == '') {
		 
		  // mime type is not set, get from server settings
		  if (function_exists('mime_content_type')) {
			$mtype = mime_content_type($filePath);
		  }
		  else if (function_exists('finfo_file')) {
			$finfo = finfo_open(FILEINFO_MIME); // return mime type
			$mtype = finfo_file($finfo, $filePath);
			finfo_close($finfo); 
		  }
		  if ($mtype == '') {
			$mtype = "application/force-download";
		  }
		}
		else {
		  // get mime type defined by admin
		  $mtype = $allowed_ext[$fext];
		}



		//Header section

		$header  = "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
		$header .= "This is a multi-part message in MIME format.\r\n";
		$header .= "--".$uid."\r\n";
		$header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
		$header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
		$header .= $message."\r\n\r\n";
		$header .= "--".$uid."\r\n";
		$header .= "Content-Type:".$mtype."; name=\"".$filename."\"\r\n";
		$header .= "Content-Transfer-Encoding: base64\r\n";
		$header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
		$header .= $content."\r\n\r\n";
		$header .= "--".$uid."--";

	fputs($smtpConnect, "To:". $nameto." <".$to.">\nFrom:". $namefrom." <".$from.">\nSubject:". $subject."\n".$header."\n\n".$message."\n.\n"); 
	$smtpResponse = fgets($smtpConnect, 515); 
	$logArray['data2response'] = "$smtpResponse"; 

	// Say Bye to SMTP 
	fputs($smtpConnect,"QUIT" . $newLine);  
	$smtpResponse = fgets($smtpConnect, 515); 
	$logArray['quitresponse'] = "$smtpResponse";
	if(empty($smtpConnect))  
	{ 
		$output = "Failed to connect: $smtpResponse"; 
		return $output; 
	} 
	else
	{ 
		$logArray['connection'] = "Connected: $smtpResponse";
		return "success";
	//return $logArray['connection'];
	}  
}   
?>