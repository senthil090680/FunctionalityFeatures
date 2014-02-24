<?php
ob_start();
//ini_set("max_execution_time",-1);

error_reporting(E_ALL ^ E_NOTICE);
//error_reporting(0);

set_time_limit(0);  // there is no time limit if set to zero

//echo ini_get("max_execution_time");

include("dbfunctions_jt.php");
require_once("Emailer.class.php");
$link=dblink();

global $Emailer;
$Emailer = new Emailer;

/**********************************************************Remove part starts here***********************************************/

//$resume_blast_id  = '555'; //needs to be removed when going live

$user_fetch_query = "SELECT order_id,user_id,order_date,service_code,order_amount,item_number,email,payment_status,paid_amount,paid_date,reference,notes,resume_blast_id FROM jt_ccavenue_orders WHERE DATE(order_date) >= DATE(CURDATE()) AND service_code = 'JTINRB' AND payment_status = 'S'";

$user_fetch_result = mysql_query($user_fetch_query);


if(!$user_fetch_result) {
	$fp;
		
} else if ($user_fetch_result) {

	while($user_fetch_row = mysql_fetch_array($user_fetch_result)) {
		$user_order_id			=		$user_fetch_row[order_id];
		$user_user_id			=		$user_fetch_row[user_id];
		$user_order_date		=		$user_fetch_row[order_date];
		$user_service_code		=		$user_fetch_row[service_code];
		$user_order_amount		=		$user_fetch_row[order_amount];
		$user_email				=		$user_fetch_row[email];
		$user_payment_status	=		$user_fetch_row[payment_status];
		$user_paid_amount		=		$user_fetch_row[paid_amount];
		$user_paid_date			=		$user_fetch_row[paid_date];
		$user_reference			=		$user_fetch_row[reference];
		$user_notes				=		$user_fetch_row[notes];
		$user_resume_blast_id	=		$user_fetch_row[resume_blast_id];
	}
}
echo $query_word = "SELECT blast_resume, blast_email, blast_fname FROM jt_resume_blast WHERE blast_id='".$resume_blast_id."'";
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

$path = "http://www.jobtardis.in/blastres/".$base_path;

//echo $path	=	basename($path);

//$new_path	= "blastres/68714e770d6d98e65.doc";

$new_path	= "blastres/".$base_path;

copyemz($path,$new_path);

echo $Emailer->add_attachments($new_path);

$query_name = "select email, company_name, contact_person  from jt_login,jt_empdetails where (user_type=2 or user_type=3) and jt_login.user_id=jt_empdetails.user_id ";

$result_name = mysql_query($query_name,$link);

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

$newcsvfile         =   "excelfile/file_".time().".csv";
											
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

fclose($fp);

$emailCount = 1;

$handle=fopen($newcsvfile,"r");

while(($fileop=fgetcsv($handle,0,",")) !== FALSE) {
	//set_time_limit(0);	 // there is no time limit if set to zero
	$client_email=$fileop[0];
	//$client_email = 'senthil090680@gmail.com';
	//echo $client_email."<br>"; exit(0);
	$Emailer->set_to($client_email);
	$Emailer->set_html($msg);
	$result = $Emailer->send();
	$emailCount++;
	//break;
}
//exit(0);

fclose($handle);

echo "mail sent";
//exit(0);

##echo "Total Email Sent : ".$emailCount;
//To update the status of blasted resume

$blast_updated_date	=	date('Y-m-d H:i:s');
$query_update_blast = "UPDATE jt_resume_blast SET blast_status=1, blast_updated_date = '$blast_updated_date', tot_receiver='$emailCount' WHERE blast_id='".$resume_blast_id."'";
//echo "<br>".$query_update_blast."<br>"; die;
//$res_query_blast=mysql_query($query_update_blast,$link);
if(mysql_query($query_update_blast,$link)){
	##echo 'Record Updated in jt_resume_blast Table. <br />';
}else {
	##echo 'Error on Updating Record in jt_resume_blast Table. <br/>';
}
/**********************************************************Remove part ends here***********************************************/



?>