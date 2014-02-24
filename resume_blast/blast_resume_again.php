<?php
ob_start();
ini_set("max_execution_time",18000);

//echo ini_get("max_execution_time");

ini_set("auto_detect_line_endings",true);

//error_reporting(E_ALL ^ E_NOTICE);
error_reporting(0);

//set_time_limit(0);  // there is no time limit if set to zero

//echo ini_get("max_execution_time");

//exit(0);
include("dbfunctions_jt.php");
require_once("Emailer.class.php");
$link=dblink();

global $Emailer;
$Emailer = new Emailer;

//echo time()."<br>";
//echo date('Y-m-d H:i:s')."<br>";

//echo "hai";

$user_id = $_COOKIE[user_id];
$email_id = $_COOKIE[email_id];
$resume_blast_id = $_COOKIE[resume_blast_id];
$admin_email="noreply@jobtardis.in";
$email_csv_file=$_COOKIE[email_csv_file];
$return_url=$_COOKIE[return_url];

function copyemz($file1,$file2){ 
	$contentx =@file_get_contents($file1);
	$openedfile = fopen($file2, "w"); 
	fwrite($openedfile, $contentx); 
	fclose($openedfile); 
	if ($contentx === FALSE) { 
		$status=false; 
	} else $status=true; 	
	 return $status; 
}

function smtp_mail_send($from, $to, $subject, $msg, $cc="", $bcc=""){
	//headers
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'from: ' . $from . "\r\n";
	if(!empty($cc))
	{
	$headers .= "CC: $cc" . "\r\n";
	}
	if(!empty($bcc))
	{
	$headers .= "Bcc: $bcc" . "\r\n";
	}
	$headers .='X-Mailer: PHP/' . phpversion();

	//message
	$messageheader =$msg;
	$message = wordwrap(($messageheader), 70);
	//send mail
	$response = mail($to, $subject, $message, $headers);
	return $response;
 }

echo $query_word = "SELECT blast_resume, blast_email,blast_fname FROM jt_resume_blast WHERE blast_id='".$resume_blast_id."'";
$result_word = mysql_query($query_word,$link);
$client_word = mysql_fetch_array($result_word);
$user_email=$client_word['blast_email'];
$blast_fname=$client_word['blast_fname'];
$path = $client_word['blast_resume'];

$base_path = basename($client_word['blast_resume']);

//Load the Emailer class into a variable
$Emailer->set_from("JOBTARDIS");
$Emailer->set_sender("<$admin_email>");
$Emailer->set_subject("Resume from JOBTARDIS");

$path = "http://www.jobtardis.in/new/excelfileforrb/".$base_path;

$new_path	= "blastres/".$base_path;

if(copyemz($path,$new_path)) {
	echo "Resume moved";
} else {
	echo "Resume Not moved"; exit(0);
}

$sour_path_csv = "http://www.jobtardis.in/new/excelfileforrb/".$email_csv_file;

$dest_path_csv	= "excelfile/".$email_csv_file;

if(copyemz($sour_path_csv,$dest_path_csv)) {
	echo "CSV File moved";
} else {
	echo "Csv File Not moved"; exit(0);
}
//exit(0);

$Emailer->add_attachments($new_path);

//Add some message percifics
$msg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Cover Sheet</title>
		<style type="text/css">
		<!--
		body {
			margin-left: 0px;
			margin-top: 0px;
			margin-right: 0px;
			margin-bottom: 0px;
			background-color: #7d7d7d;
		}
		.content {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 12px;
			line-height: 18px;
			color: #363a3a;
			text-decoration: none;
		}
		.content_b {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 12px;
			line-height: 18px;
			color: #363a3a;
			text-decoration: none;
			font-weight: bold;
		}
		.whiteContent {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 12px;
			line-height: 18px;
			color: #FFFFFF;
			text-decoration: none;
		}
		-->
		</style>
	</head>
	<body>
		<table border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td  align="top" bgcolor="#FFFFFF" class="content" style="padding:10px">
				Dear Employer / Recruiter,<br/><br/>
				I am submitting my resume through Jobtardis. Kindly refer me if you have any requirements relevant to my profile.
				</td>
			</tr>
			<tr>
				<td class="content" style="padding:3px;">
					Thanks and Regards,<br/>'.$blast_fname.'
				</td>
			</tr>
		</table>
	</body>
</html>';

$emailCount = 0;

$newcsvfile         =   $dest_path_csv;

$handle=fopen($newcsvfile,"r");

while(($fileop=fgetcsv($handle,0,",")) !== FALSE) {
	$receiver_mail_arr[]	=	$fileop[0];
}

$receiver_mail_split = array_chunk($receiver_mail_arr,1000);

$receiver_mail_count = sizeof($receiver_mail_split);

$excel_alive = fopen('excelfile/alive_2.txt','a+');

for($i=0; $i<$receiver_mail_count; $i++) {
	set_time_limit(0);	 // there is no time limit if set to zero
	ignore_user_abort(1);

	foreach($receiver_mail_split[$i] as $fileop[0]) {

		fwrite($excel_alive,date("Y-m-d H:i:s")."\n");
		
		$client_email = $fileop[0];
		//$client_email = 'senthil090680@gmail.com';
		//echo $client_email."<br>"; exit(0);
		//$client_email = 'senthilhari14@gmail.com';
		$Emailer->set_to($client_email);
		$Emailer->set_html($msg);
		//$result = $Emailer->send();
		$emailCount++;
		//break;
	}
	//break;
}

fclose($excel_alive);

echo "<pre>";
print_r($receiver_mail_split);
echo "</pre>";


echo $emailCount."<br>";
echo time()."<br>"; 
echo date('Y-m-d H:i:s')."<br>";

//exit(0);

fclose($handle);

//echo "mail sent";
//exit(0);

##echo "Total Email Sent : ".$emailCount;

?>
<form action="<?php echo $return_url; ?>" method="post" name="returnBlastForm">
<input type="hidden" name="resume_blast_id" value="<?php echo $_COOKIE[resume_blast_id]; ?>" />
<input type="hidden" name="emailCount" value="<?php echo $emailCount; ?>" />
<input type="hidden" name="user_id" value="<?php echo $_COOKIE[user_id]; ?>" />
<input type="hidden" name="user_email" value="<?php echo $_COOKIE[email_id]; ?>" />
<input type="hidden" name="admin_user_name" value="<?php echo "admin"; ?>" />
<input type="hidden" name="blaster_access" value="<?php echo '1'; ?>" />

<?php 
unset($_COOKIE['user_id']);
unset($_COOKIE['email_id']);
unset($_COOKIE['resume_blast_id']);
unset($_COOKIE['email_csv_file']);
unset($_COOKIE['return_url']);

//exit(0); ?>
</form>
<script type="text/javascript">
document.forms['returnBlastForm'].submit();
</script>