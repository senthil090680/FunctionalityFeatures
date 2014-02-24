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

$status_blast = $_COOKIE[status_blast];
$order_id = $_COOKIE[order_id];
$user_id = $_COOKIE[user_id];
$email_id = $_COOKIE[email_id];
$resume_blast_id = $_COOKIE[resume_blast_id];
$admin_email="noreply@jobtardis.in";
$email_csv_file=$_COOKIE[email_csv_file];


/*$order_id = "1671";
$user_id = "31319";
$email_id = "senthil090680@gmail.com";
$resume_blast_id = "584";
$email_csv_file="file_1354204672.csv";*/

/*echo $status_blast."<br>";
echo $order_id."<br>";
echo $user_id."<br>";
echo $email_id."<br>";
echo $resume_blast_id."<br>";
echo $email_csv_file."<br>";*/

//exit(0);

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

//$resume_blast_id  = '73'; //needs to be removed when going live

echo $query_word = "SELECT blast_resume, blast_email,blast_fname FROM jt_resume_blast WHERE blast_id='".$resume_blast_id."'";
$result_word = mysql_query($query_word,$link);
$client_word = mysql_fetch_array($result_word);
$user_email=$client_word['blast_email'];
$blast_fname=$client_word['blast_fname'];
$path = $client_word['blast_resume'];

$base_path = basename($client_word['blast_resume']);

//Load the Emailer class into a variable
$Emailer->set_from("JOBTARDIS");
//$Emailer->set_useremail(trim($email_id));
$Emailer->set_sender("<$admin_email>");
$Emailer->set_subject("Resume from JOBTARDIS");
//$url	=	'http://www.jobtardis.in/';
//$url_path	=	str_replace('../','',$path);
//echo $url.$url_path;
//echo $path;
//exit(0);

$path = "http://www.jobtardis.in/new/excelfileforrb/".$base_path;

//echo $path	=	basename($path);

//$new_path	= "blastres/68714e770d6d98e65.doc";

$new_path	= "blastres/".$base_path;

if(copyemz($path,$new_path)) {
	//echo "moved";
} else {
	echo "Resume Not moved"; exit(0);
}


$sour_path_csv = "http://www.jobtardis.in/new/excelfileforrb/".$email_csv_file;

$dest_path_csv	= "excelfile/".$email_csv_file;

if(copyemz($sour_path_csv,$dest_path_csv)) {
	//echo "moved";
} else {
	echo "Csv File Not moved"; exit(0);
}
//exit(0);

$Emailer->add_attachments($new_path);

//$query_name = "select email, company_name, contact_person  from jt_login,jt_empdetails where (user_type=2 or user_type=3) and jt_login.user_id=jt_empdetails.user_id ";

//$result_name = mysql_query($query_name,$link);

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

/*$newcsvfile         =   "excelfile/file_".time().".csv";
											
$fp = fopen($newcsvfile, 'x+');

while($client_email = mysql_fetch_array($result_name))
//$testEmailArray = array('nkvuppala@yahoo.com', 'kv@anantha.co.uk', 'neeraj@anantha.co.in', 'jeeva@anantha.co.in', 'sirisha@anantha.co.ins');
//foreach($testEmailArray as $index => $client_email)
{					
	$client_email = $client_email['email'];
	//$client_email = "senthil090680@gmail.com";
	
	$client_email_arr = array($client_email);
	fputcsv($fp, $client_email_arr);
}

fclose($fp);*/

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
		//usleep(rand(50000,300000)); // halt for n microseconds

		fwrite($excel_alive,date("Y-m-d H:i:s")."\n");

		//file_put_contents('excelfile/alive.txt', date("H:i:s").$emailCount);
		
		$client_email = $fileop[0];
		//$client_email = 'senthil090680@gmail.com';
		//echo $client_email."<br>"; exit(0);
		//$client_email = 'senthilhari14@gmail.com';
		$Emailer->set_to($client_email);
		$Emailer->set_html($msg);
		$result = $Emailer->send();
		$emailCount++;
		//break;
	}
	//break;
}

fclose($excel_alive);

/*echo "<pre>";
print_r($receiver_mail_split);
echo "</pre>";


echo $emailCount."<br>";
echo time()."<br>"; */
echo date('Y-m-d H:i:s')."<br>";

//exit(0);

fclose($handle);

//echo "mail sent";
//exit(0);

##echo "Total Email Sent : ".$emailCount;
//To update the status of blasted resume

$blast_updated_date	=	date('Y-m-d H:i:s');

/*echo $query_update_blast = "UPDATE jt_resume_blast SET blast_status=1, blast_updated_date = '$blast_updated_date', tot_receiver='$emailCount' WHERE blast_id='".$resume_blast_id."'";

if(mysql_query($query_update_blast)){
	##echo 'Record Updated in jt_resume_blast Table. <br />';
}else {
	echo 'Error on Updating Record in jt_resume_blast Table. <br/>'; 
	//exit(0);
}*/

//exit(0);
$blast_paid_date	=	date('Y-m-d H:i:s');
$blast_pay_status	=	'Paid';
$blast_currency		=	'INR';
$blast_mode			=	1;
$Amount			=	'1249.00';

/*echo $resumePayerBlastInsertSql =	'INSERT INTO jt_payment_blast (blast_id, blast_paid_date, blast_amount, blast_pay_status, blast_payer_email, blast_currency, blast_trans_id, blast_payer_id,blast_mode) VALUES ("'.$resume_blast_id.'", "'.$blast_paid_date.'", '.$Amount.', "'.$blast_pay_status.'","'.$user_email.'", "'.$blast_currency.'", "'.$order_id.'", "'.$user_id.'", '.$blast_mode.')';

if(mysql_query($resumePayerBlastInsertSql)){
	//echo "pay";
} else {
	echo "Payment Blast Query Not Completed"; 
	//exit(0);
}*/

// Sent Mail to blast-user
$subject="Resume Blasting";
$msg_user = "<b>Dear $blast_fname,</b><br/><br/>\n".
"Your transaction is successful and your profile has been sent to all employers and recruiters.<br/><br/>\n" .
$msg_user = $msg_user."Heartly Invites,<br/>\n".
"Admin<br/>\n".
"<a href='www.jobtardis.in'>jobtardis.in</a><br/>\n".
"<img src='http://www.jobtardis.in/images/logo.gif' alt='Jobtardis' /><br/>\n";

$rval = smtp_mail_send($admin_email, trim($user_email), $subject, $msg_user,$cc,$bcc);  //Comment needs to be removed when going live

/*$query_purchase="SELECT * FROM jt_login where user_id='$user_id'";
$result_purchase=mysql_query($query_purchase,$link);
$row_purchase=mysql_fetch_array($result_purchase); Unused anywhere in this page*/

$from_ad="admin@jobtardis.in";
$to_ad="admin@jobtardis.in";

$from_ad="senthil090680@gmail.com";
$to_ad="senthil090680@gmail.com";

$subject_ad="Resume Blasting payment confirmation";
$msg_txt_ad="<b>Dear admin,</b><br><br>\n $blast_fname has registered for  <b> Resume Blast</b>.<br><br>\n".

	"Regards,<br/>\n".
		"Admin<br/>\n".
		"<a href='www.jobtardis.in'>jobtardis.in</a>,<br/>\n".
			"<img src='http://www.jobtardis.in/images/logo.gif'/><br/>\n";

$activate_mail_ad = smtp_mail_send($from_ad, $to_ad, $subject_ad, $msg_txt_ad,$cc,$bcc); //Comment needs to be removed when going live

/*echo $query_send = "INSERT INTO jt_intranet_email (user_id, msg_to, msg_subject, msg_body, sender_status, receiver_status, read_status) VALUES ('1', '".$user_id."', 'Confirmation Mail - Personal Ad payment confirmation', '".addslashes($msg_user)."', 'send', 'receive', 'unread')";

if(mysql_query($query_send)){
	//echo "pay";
} else {
	echo "Intranet Email Query Not Completed"; exit(0);
}*/

//exit(0);

?>
<form action="<?php echo ROOTPATH_BLAST; ?>" method="post" name="returnBlastForm">
<input type="hidden" name="status_blast" value="<?php echo $_COOKIE[status_blast]; ?>" />
<input type="hidden" name="order_id" value="<?php echo $_COOKIE[order_id]; ?>" />
<input type="hidden" name="res" value="<?php echo "25"; ?>" />
<input type="hidden" name="resume_blast_id" value="<?php echo $_COOKIE[resume_blast_id]; ?>" />
<input type="hidden" name="emailCount" value="<?php echo $emailCount; ?>" />
<input type="hidden" name="user_id" value="<?php echo $_COOKIE[user_id]; ?>" />
<input type="hidden" name="user_email" value="<?php echo $_COOKIE[email_id]; ?>" />

<?php 
unset($_COOKIE['status_blast']);
unset($_COOKIE['order_id']);
unset($_COOKIE['user_id']);
unset($_COOKIE['email_id']);
unset($_COOKIE['resume_blast_id']);
unset($_COOKIE['email_csv_file']);

//exit(0); ?>
</form>
<script type="text/javascript">
document.forms['returnBlastForm'].submit();
</script>