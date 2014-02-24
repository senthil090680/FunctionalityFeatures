<?php


print_r($_REQUEST);

if($_POST) {

$con = mysql_connect("localhost","root","");

mysql_select_db("eatable",$con);

print_r($_FILES);
exit(0);



$file = $_FILES['']
	

//D:/wamp/www/testing/upload.csv";

//$keyword = str_replace(',','|',$keyword);

//keyword REGEXP '($keyword)'



$query = "LOAD DATA INFILE '".$file."' IGNORE INTO TABLE students FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' (NAME,email,mobile,industry,@skills,@city,@course,@gender,@address) SET id=null, skills = replace(@skills, '\"', ''), city = replace(@city, '\"', ''), course = replace(@course, '\"', ''), gender = replace(@gender, '\"', ''), address = replace(@address, '\"', '')";





/*$sqlchk="select email from jt_login where email='$email'";
$reschk=mysql_query($sqlchk,$link) or die(mysql_error());
if($rowchk=mysql_fetch_array($reschk))
{
	$emailchk=$rowchk['email'];
}
if($emailchk==$email)
{
	$sql="insert into failed_records (id,display_name,email,username,pass_word,filename,curr_status,user_type,ip,success,date,phno) values ('NULL','".$name."','".$email."','".$username."','".$password."','".$filename."','Active','".$user_type."','".$ip."','Failed','".$date."','".$mob."')";
	$res=mysql_query($sql,$link) or die(mysql_error());
}
else
{
	$sqll="insert into jt_login (display_name,email,username,pass_word,filename,curr_status,user_type,ip,success,date) values ('".$name."','".$email."','".$username."','".$password."','".$filename."','Active','".$user_type."','".$ip."','".$success."','".$date."')";
	$resl=mysql_query($sqll,$link) or die(mysql_error());

	$sql1="select user_id,email,display_name,username,pass_word from jt_login where filename='$filename'";
	$res1=mysql_query($sql1,$link) or die(mysql_error());
	while($row1=mysql_fetch_array($res1))
	{
		$user_id=$row1['user_id'];
		$email1=$row1['email'];
		$name1=$row1['display_name'];
		$username=$row1['username'];
		$password=$row1['pass_word'];
	}
	$sqljd="insert into jt_js_details(user_id,fname,dob,gender,email) values ('$user_id','".$name."','".$dob."','".$gender."','".$email."')";
	$resjd=mysql_query($sqljd,$link) or die(mysql_error());

	$sqlud="insert into jt_userdetails(user_id,user_type,landline,address,email) values ('$user_id','".$user_type."','".$mob."','".$add."','".$email."')";
	$resud=mysql_query($sqlud,$link) or die(mysql_error());

	$sqlcd="insert into current_details(user_id,curr_name,gender,functional_area,industry,course,institute) values('$user_id','".$name."','".$gender."','".$spec."','".$industry."','".$course."','".$institute."')";
	$rescd=mysql_query($sqlcd,$link) or die(mysql_error());
}



*/




//, IF (SELECT email FROM jt_login where email=email != email) THEN SET email = email ELSE 'No' END IF
$res = mysql_query($query) or die(mysql_error());


}

?>

<html>
<body>

<form name="fileupload" id="fileupload" method="post" action="" enctype="multipart/form-data" >
								

<input type="file" name="fileload" id="fileload" />

<input type="submit" name="sub" value="Submit" />
</form>

</body>

</html>