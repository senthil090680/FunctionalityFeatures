<?php
setcookie('user_id',$_POST[user_id]);
setcookie('email_id',$_POST[email_id]);
setcookie('resume_blast_id',$_POST[resume_blast_id]);
setcookie('email_csv_file',$_POST[email_csv_file]);
setcookie('return_url',$_POST[return_url]);

/*setcookie('user_id','31319');
setcookie('email_id','senthil090680@gmail.com');
setcookie('resume_blast_id','602');
setcookie('email_csv_file','file_1354296428.csv');
setcookie('return_url','http://jobtardis.in/administration/update_by_cash.php');*/

/*$order_id = "1671";
$user_id = "31319";
$email_id = "senthil090680@gmail.com";
$resume_blast_id = "584";
$email_csv_file="file_1354204672.csv";*/

?>
<script type="text/javascript">
window.location = 'blast_resume_again.php';
</script>