<?php
function dblink()
{
	$host="jobtardis.in";
	$dbase="jobtarin_india";
	$user="jobtarin_india";
	$pwd="Q]O%PsU,}ch@";

	$link=mysql_connect($host, $user, $pwd);
	if(! $link)
	{
		die(mysql_error());
	}
	mysql_select_db($dbase);
	return $link;
}

function dblink_uk1()
{
	$host="77.92.87.193";
	$dbase="jobtardi_uk";
	$user="jobtardi_ukuser";
	$pwd="EphahU3WVlm@";

	$link=mysql_connect($host, $user, $pwd);
	if(! $link)
	{
		die(mysql_error());
	}
	mysql_select_db($dbase);
	return $link;
}

function dblink_blog1()
{
	$host_blog="localhost";
	$dbase_blog="jobtardu_blogs";
	$user_blog="jobtardu_blogs";
	$pwd_blog="3Ut^+G0X$2bz";
	$link_blog=mysql_connect($host_blog, $user_blog, $pwd_blog);
	if(! $link_blog)
	{
	die(mysql_error());
	}
	mysql_select_db($dbase_blog);
	return $link_blog;
}

function get_currency1($from_Currency, $to_Currency, $amount) {
	$amount = urlencode($amount);
	$from_Currency = urlencode($from_Currency);
	$to_Currency = urlencode($to_Currency);
	$url = "http://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";
	$ch = curl_init();
	$timeout = 0;
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$rawdata = curl_exec($ch);
	curl_close($ch);

	$data = explode('bld>', $rawdata);
	$data = explode($to_Currency, $data[1]);

	return round($data[0], 2);
}
function subscribe_mail($email)
{
		$link=dblink();
		$query="select * from jt_login where email ='".$email."'";
		$result=mysql_query($query,$link);

		if(mysql_num_rows($result)>0)
		{
			$row=mysql_fetch_array($result);
			$user_id=$row['user_id'];

			$query_alert="select * from jt_alert where user_id='".$user_id."'";
			$result_alert=mysql_query($query_alert,$link);
			$row_alert=mysql_fetch_array($result_alert);
			$subscribe_mail=$row_alert['subscribe_mail'];
			if(trim($subscribe_mail) =="No")
			{
				return 0;
			}
			else
			{
				return 1;
			}

		}
		else
		{
			return 1;
		}
}

function mail_append()
{
		$link=dblink();
		$query="select email_footer from jt_email_footer where id=2";
		$result=mysql_query($query,$link);

		if(mysql_num_rows($result)>0)
		{
			$row=mysql_fetch_array($result);
			$email_footer=$row['email_footer'];

			return $email_footer;
		}
}

function pre($resutl){
	echo '<pre>';
	print_r($resutl);
	echo '</pre>';
}

?>
