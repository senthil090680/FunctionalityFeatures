<?php
$con = mysql_connect("localhost","root","");

mysql_select_db("eatable",$con);

echo "hell";

$file = "upload.csv";


//echo $query = "LOAD DATA LOCAL INFILE '".$file."' IGNORE INTO TABLE students FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' (NAME,@dummy,email,mobile,industry,@dummy,@skills,@city,@course,@gender,@address,@dummy) SET id=null, skills = replace(@skills, '\"', ''), city = replace(@city, '\"', ''), course = replace(@course, '\"', ''), gender = replace(@gender, '\"', ''), address = replace(@address, '\"', '')";


echo $query = "LOAD DATA LOCAL INFILE '".$file."' IGNORE INTO TABLE students FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' (@NAME1,@email1,@mobile1,@industry1,@skills1,@city1,@course1,@gender1,@address1) SET id=null, NAME=@NAME1, email=@email1, mobile =@mobile1,industry=@industry1,skills=@skills1,city=@city1,course=@course1,gender=@gender1,address=@address1, skills = replace(@skills1, '\"', ''), city = replace(@city1, '\"', ''), course = replace(@course1, '\"', ''), gender = replace(@gender1, '\"', ''), address = replace(@address1, '\"', '')";


$res = mysql_query($query) or die(mysql_error());

?>

<html>
<body>

<form method="post" action="" enctype="multipart/form-data" >

<input type="file" name="fileload" id="fileload" />

<input type="submit" value="Submit" />
</form>

</body>

</html>