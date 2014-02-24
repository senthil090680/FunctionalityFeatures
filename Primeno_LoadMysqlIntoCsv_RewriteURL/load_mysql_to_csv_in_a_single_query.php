<?php 
error_reporting(E_ALL ^ E_NOTICE);
$host="jobtardis.in";
$dbase="jobtarin_india";
$user="jobtarin_india";
$pwd="Q]O%PsU,}ch@";

/*$host="localhost";
$dbase="jobtardi_uk";
$user="root";
$pwd="";*/

$time = microtime(TRUE);
$mem = memory_get_usage();

$link=mysql_connect($host, $user, $pwd);
if(!$link)
{
	die(mysql_error());
}
mysql_select_db($dbase);

$newcsvfile         =   "/tmp/file_".time().".csv";



//$newcsvfile         =   "D://wamp/www/senthil/file_".time().".csv";

//$newcsvfile         =   "/home/jobtarin/public_html/new/excelfile/file_".time().".csv";

$sqljd="SELECT email INTO OUTFILE '".$newcsvfile."' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' FROM jt_login,jt_empdetails WHERE (user_type=2 or user_type=3) and jt_login.user_id=jt_empdetails.user_id ";

//$sqljd="SELECT email INTO OUTFILE '".$newcsvfile."' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' FROM jt_login";


$result = mysql_query($sqljd) or die(mysql_error());

move_uploaded_file($newcsvfile,"file_".time().".csv");


echo "file_".time().".csv";
echo "<br>".mysql_affected_rows();
?>