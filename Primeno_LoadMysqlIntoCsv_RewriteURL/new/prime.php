<?php
ini_set("max_execution_time",50000);


echo __FILE__."<br>";

echo dirname(__FILE__)."<br>";

echo DIRECTORY_SEPARATOR."<br>";

echo dirname(__FILE__).DIRECTORY_SEPARATOR."<br>";

if($_GET[id] !='' && isset($_GET[id]) && $_GET[id] !='prime') {


echo "This is the program to display prime numbers between 1 - 100 <br>"; 
for($i=0;$i <= 1000;$i++) 
{ 
	$count=0;
	for($j=2;$j<=$i;$j++) 
	{ 
		$reminder = $i % $j; 
		if($reminder==0) 
		{ 
			$count=$count+1; 
		} 
	} 
	if($count == 1 ) 
	echo $i." "; 
} 

chmod('resume/45241.doc', 0600);

$camp		=	23;
$caon		=	24;
$array_val	=	array('php','mysql','java','ajax');

$hello = implode(",",$array_val);

$url = "http://www.jobtardis.in/displayjob.php?keyword=ajaxjava-functional-area=Information-Technology-job_id=9608-user_id=31320";

$url_sel			=	stristr($url,"job_id=");

$url_removed_part	=	str_replace("job_id=",'',$url_sel);

$url_pos			=	strpos($url_removed_part,'-');

echo substr($url_removed_part,0,$url_pos);





if($_POST) {
	echo $_POST[fruit];
	echo "<br>";
	echo $_POST[veg];
}


?>


<form name="frm1" method="post" action="">

<input type="checkbox" name="fruit" value="Orange" />Orange
<input type="checkbox" name="veg" value="Mango" />Mango

<input type="submit" value="Submit" />

</form>



<?php 

} else {
	
	
	echo "Not authorized to access";	
	
	
} ?>