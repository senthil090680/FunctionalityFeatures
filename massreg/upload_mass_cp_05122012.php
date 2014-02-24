<?php
ob_start();
ini_set("max_execution_time","50000");

//echo "hoi";
//exit(0);
//echo ini_get("max_execution_time");
//echo ini_get('upload_max_filesize');
//echo ini_get('display_errors');
//echo ini_get('post_max_size');
ini_set("auto_detect_line_endings",true);
//error_reporting(E_ALL ^ E_NOTICE);
error_reporting(0);

require_once("config.php");
require_once("random_names.php");
include("dbfunctions_jt.php");
require_once("Emailer.class.php");
require_once ("user_functions.php");
$link=dblink();

global $Emailer;
$m      =   0;
$Emailer = new Emailer;        

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

$filename_post	=	$_POST[filename]; 
//$file=$_FILES['file']['tmp_name'];
$file = OTHERROOTPATH."uploaded_file/".$filename_post;
$filename=$filename_post;

//print_r($_FILES['file']['name']);
//exit(0);

//echo $path	=	basename($path);

//$new_path	= "blastres/68714e770d6d98e65.doc";

$new_path	= "moved_csv_file/".$filename_post;

if(copyemz($file,$new_path)) {
	//echo "moved";
} else {
	echo "Csv File Not moved (Maybe some problem in the file naming (For security reasons file name should not contain -, ., space, or any special characters or maybe the content you provided, please check it)"; exit(0);
}

$fname=explode(".",$filename);
$ext=$fname[1];

if($ext=="csv")
{
	$sqlfile="select filename from summary where filename='$filename'";

	$resfile=mysql_query($sqlfile,$link);
	if($rowfile=mysql_fetch_array($resfile))
	{
		$file1=$rowfile['filename'];
	}

	if($file1!=$filename)
	{
			$csvupload = "123";
							$ip=$_SERVER['REMOTE_ADDR'];
			//print_r($file);

			if(!file_exists($new_path)) {
				echo "$file does not exist"; exit(0);
			}
			$handle=fopen($new_path,"r");
			//$contents = file($file);
			
			$csv_file_mass	=	"file_".time().".csv";

			$excel_alive = fopen('excelfile/'.$csv_file_mass,'a+');

			//exit(0);
			while(($fileop=fgetcsv($handle,2001,",")) !== FALSE) {
							//for($i=0; $i<sizeof($contents); $i++) {
								
										$rows++;
										$name=$fileop[0];
										$email=$fileop[1];
										$dob=$fileop[2];
										$mob=$fileop[3];
										$industry=$fileop[4];
										$skills=$fileop[5];
										$cemployer=$fileop[6];
										$cloc=$fileop[7];
										$experience=$fileop[8];
										$ploc=$fileop[9];
										$course=$fileop[10];
										$spec=$fileop[11];
										$institute=$fileop[12];
										$gender=$fileop[13];
										$add=$fileop[14];
										
										$user_type="1";

										$date=date("d M Y");

										$username=Generate_userpass();
										$password=GeneratePassword();

										$sqlchk="select email from jt_login where email='$email'";
										$reschk=mysql_query($sqlchk,$link);
										if($rowchk=mysql_fetch_array($reschk))
										{
												$emailchk=$rowchk['email'];
										}
										if($emailchk==$email)
										{
												$sql="insert into failed_records_new (id,display_name,email,username,pass_word,filename,curr_status,user_type,ip,success,date,phno) values ('NULL','".$name."','".$email."','".$username."','".$password."','".$filename."','Active','".$user_type."','".$ip."','Failed','".$date."','".$mob."')";
												$res=mysql_query($sql,$link);
										}
										else {
											
											$fileop[15]     =   $username;
											$fileop[16]     =   $password;
											$sqll="insert into jt_login (display_name,email,username,pass_word,filename,curr_status,user_type,ip,success,date) values ('".$name."','".$email."','".$username."','".$password."','".$filename."','Active','".$user_type."','".$ip."','".$success."','".$date."')";
											$resl=mysql_query($sqll,$link);
											
											$fileop[17]     =   mysql_insert_id();
											
											$newcsvarray[]  =   $fileop;                                                                                                                 
											shuffle($random_names);
											$rname=$random_names[0];
											
											/*$sqlrn="select name from random_names order by rand() limit 0,1";
											$resrn=mysql_query($sqlrn,$link);
											if($rowrn=mysql_fetch_array($resrn))
											{
													$rname=$rowrn['name'];
											}*/
																							
											$moremsg ="Dear $name ,<br><br>\n" .
											"Welcome to jobtardis.in - 1stop shop for 7 billion people <br/><br/>".
											"Welcome to jobtardis.in - world first knowledge auction portal <br/><br/>".

											"The Knowledge Auction is a new innovative service using latest technology advances to allow both Recruiters/Employers and Jobseekers the possibility to post resume and job bids to find the right employee or employer respectively. We at jobtardis believe that the growth and survival of any business or organization, and on a bigger scale also the growth of an economy, is ultimately dependent on the effective acquisition and utilization of knowledge. Using  knowledge auction , we intend to unite recruiters ,companies ,employers with job seekers  blessed with unique talents and remarkable knowledge who will contribute effectively to the growth and development of the hiring organization <br/><br/>".

											"<a href='http://www.jobtardis.in/knowledge-auction-ticker.php'>what is knowlede auction ?</a> &nbsp;&nbsp;&nbsp;<a href='http://www.youtube.com/watch?v=GGZAt0-Iudg'>Click Here</a><br/><br/>".


											"Jobtardis.in is one of the most recent worldwide online jobportal with the objective of providing high level technology features to Jobseekers/Recruiters/Employers<br/><br/>".

											"Jobtardis.in provides jobs, resume bids, job bids, professional networking, discussions, groups, information, communication, audio video chat rooms, virtual job fairs, advertising, application tracking systems, personalised branding and other numerous services. Jobtardis.in is proud to declare itself as the world�s first knowledge auction portal, built with the objective of breaking all traditional rules of job posting <br/><br/>".

											"Jobtardis.in provides a one-stop-shop platform for worldwide citizens to connect online with each other, purposefully be it for an Employment/job. Jobtardis.in is committed to offering a personalized and a secure surfing with latest technology features</br>".

											"Enjoy you time with us <br/><br/>".

											"Your profile is created by your friend $rname .  You can delete you profile from Jobtardis.in  with in 7 days..  If you need any help , please contact Toll Free 1800 103 4598<br/><br/>".

											".once again welcome to jobtardis.in - stay ahead of you competition !! <br/><br/>".

											"Team Jobtardis <br/><br/>".

											"Jobtardis(India) <br/><br/>".
											"Toll Free No : 1800 103 4598".
		"Delhi | Chennai | Hyderabad | London | New York | Mountain view,California <br/><br/>".

									"Below provided are your account details:<br/><br/>\n".
											"Your Username : <b>$username</b><br>\n".
											"Your Password : <b>$password</b><br><br>\n";
											"<a href='jobtardis.in/login1.php'>Click here to login</a><br><br>\n";

											$moremsg .="Once again welcome to www.jobtardis.in <br><br>\n".
											"Many Thanks ,<br/>\n".

											"Admin Team � <a href='www.jobtardis.in'>jobtardis.in</a><br/>\n".
													"<img src='http://www.jobtardis.in/images/logo.gif'/><br/>\n";
													$subject="Join in Jobtardis";
													$cc = "";
													$bcc="";
													$msg = $moremsg;
													$from="admin@jobtardis.in";
													$to=$email;
													//$to = "senthil090680@gmail.com";
						//$rval = smtp_mail_send($from, $to, $subject, $moremsg,$cc,$bcc);
						//$to = 'senthil090680@gmail.com';
						$rval = mail_send_class($from, $to, $subject, $moremsg,$cc,$bcc);
																
										fwrite($excel_alive,date("Y-m-d H:i:s")."\n");

										//$m++;
										}                                                                                      
			}
				
				fclose($excel_alive);

							$newcsvfile         =   "file_".time().".csv";
											
							$fp = fopen($newcsvfile, 'x+');
							
							/*echo "<pre>";
							print_r($newcsvarray);
							echo "</pre>";*/
							
							//exit(0);
							foreach ($newcsvarray as $fields) {
								fputcsv($fp, $fields);
							}

							fclose($fp);
							
							
							/*$name=$fileop[0];
							$email=$fileop[1];
							$dob=$fileop[2];
							$mob=$fileop[3];
							$industry=$fileop[4];
							$skills=$fileop[5];
							$cemployer=$fileop[6];
							$cloc=$fileop[7];
							$ploc=$fileop[8];
							$course=$fileop[9];
							$spec=$fileop[10];
							$institute=$fileop[11];
							$gender=$fileop[12];
							$add=$fileop[13];
							$username=$fileop[13];
							$password=$fileop[13];
							$user_id=$fileop[13];
							  
							*/
							
							//$sqljd="insert into jt_js_details(user_id,fname,dob,gender,email) values ('$user_id','".$name."','".$dob."','".$gender."','".$email."')";
							$sqljd="LOAD DATA LOCAL INFILE '".$newcsvfile."' IGNORE INTO TABLE jt_js_details FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' (@NAME1,@email1,@dob,@mobile1,@industry1,@skills1,@cemployer,@cloc,@experience,@ploc,@course1,@spec1,@institute1,@gender1,@address1,@username1,@password1,@user_id1) SET id=null, user_id=@user_id1, fname=@NAME1, dob = @dob, email=@email1,gender=@gender1, gender = replace(@gender1, '\"', '')";
									
							$resjd=mysql_query($sqljd,$link);

							//$sqlud="insert into jt_userdetails(user_id,user_type,landline,address,email) values ('$user_id','".$user_type."','".$mob."','".$add."','".$email."')";
							
							$sqlud="LOAD DATA LOCAL INFILE '".$newcsvfile."' IGNORE INTO TABLE jt_userdetails FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' (@NAME1,@email1,@dob,@mobile1,@industry1,@skills1,@cemployer,@cloc,@experience,@ploc,@course1,@spec1,@institute1,@gender1,@address1,@username1,@password1,@user_id1) SET id=null, user_id=@user_id1, user_type=1, city=@cloc,mobile = @mobile1, address=@address1,email=@email1,address = replace(@address1, '\"', '')";
							$resud=mysql_query($sqlud,$link);

							//$sqlcd="insert into current_details(user_id,curr_name,gender,functional_area,industry,course,institute) values('$user_id','".$name."','".$gender."','".$spec."','".$industry."','".$course."','".$institute."')";
							$sqlcd="LOAD DATA LOCAL INFILE '".$newcsvfile."' IGNORE INTO TABLE current_details FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' (@NAME1,@email1,@dob,@mobile1,@industry1,@skills1,@cemployer,@cloc,@experience,@ploc,@course1,@spec1,@institute1,@gender1,@address1,@username1,@password1,@user_id1) SET id=null, user_id=@user_id1, curr_name=@NAME1, dob = @dob,present_city=@cloc,tot_exp=@experience,gender=@gender1,functional_area=@spec1,industry= @industry1, email=@email1,course=@course1,institute=@institute1,pref_location=@ploc,industry = replace(@industry1, '\"', '')";
							$rescd=mysql_query($sqlcd,$link);
							
							//$sqlpaidmoney="insert into jt_ad_info(user_id,name,email,amount_paid,amount_rem,amount_status,user_type,status) values('$user_id','".$name."','".$email."',600.00,600.00,'Paid',1,'Active')";
							$sqlpaidmoney="LOAD DATA LOCAL INFILE '".$newcsvfile."' IGNORE INTO TABLE jt_ad_info FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' (@NAME1,@email1,@dob,@mobile1,@industry1,@skills1,@cemployer,@cloc,@experience,@ploc,@course1,@spec1,@institute1,@gender1,@address1,@username1,@password1,@user_id1) SET id=null, user_id=@user_id1, name=@NAME1, email=@email1,amount_paid=600.00,amount_rem=600.00,amount_status='Paid',user_type=1,status='Active'";
							$respaidmoney=mysql_query($sqlpaidmoney,$link) or die(mysql_error());
							
							//echo $query = "LOAD DATA LOCAL INFILE '".$newcsvfile."' IGNORE INTO TABLE students FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' (@NAME1,@email1,@mobile1,@industry1,@skills1,@city1,@course1,@gender1,@address1) SET id=null, NAME=@NAME1, email=@email1, mobile =@mobile1,industry=@industry1,skills=@skills1,city=@city1,course=@course1,gender=@gender1,address=@address1, skills = replace(@skills1, '\"', ''), city = replace(@city1, '\"', ''), course = replace(@course1, '\"', ''), gender = replace(@gender1, '\"', ''), address = replace(@address1, '\"', '')";
							//$res = mysql_query($query) or die(mysql_error());
							unlink($newcsvfile);
							//exit(0);							
			$date=date("Y-m-d H:i:s");
			$sqlsum="insert into summary (id,tdate,filename,totalcnt,success,failed) values ('NULL','$date','".$filename."','".$rows."','','')";
			$ressum=mysql_query($sqlsum,$link);
			}
			else
			{
				echo "You cannot upload the same file";
			}
	if($csvupload)
	{ 
		//echo "data uploaded successfully";
		header("location: ".OTHERROOTPATH."detail_summary.php");
		//header("location:detail_summary.php");
		exit;
	}
}
else
{
	echo "Please Upload CSV files only";
}
function Generate_userpass()
{
	if(!$pwd_digit) $pwd_digit = 6;
	$retPassword = rand_string($pwd_digit);
	return $retPassword;
}
function GeneratePassword()
{
	if(!$pwd_digit)	$pwd_digit = 6;
	$retPassword = rand_string($pwd_digit);
	return $retPassword;
}
function rand_string($len, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
{
	$string = '';
	for ($i = 0; $i < $len; $i++)
	{
		$pos = rand(0, strlen($chars)-1);
		$string .= $chars{$pos};
	}
	return $string;
}
?>