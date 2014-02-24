<?php
	ini_set("display_errors",true);
	ini_set("max_execution_time","18000");

	define('ROOT_DIRECTORY', 'onlinetest/');

	//LOCAL DATABASE CONNECTION
	define('DBNAME', 'onlinetest');							//DATABASE NAME
	define('DBUSERNAME', 'sen');							//DATABASE USERNAME
	define('DBPASS', 'sen');								//DATABASE PASSWORD
	define('SERVERNAME', '10.199.50.75');						//SERVER NAME
	//define('SERVERNAME', 'localhost');						//SERVER NAME
	
	define('TABLE_PRODUCTS', 'products');					//PRODUCT TABLE NAME

	$relativepath = 'http://'.$_SERVER['REMOTE_ADDR'].'/'.ROOT_DIRECTORY;

	//define('MACHINE_A','192.168.1.5');
	define('MACHINE_A','10.199.50.75');
	define('MACHINE_B','192.168.1.4');

	define('MACHINE_A_ACCESS',TRUE);
	define('MACHINE_B_ACCESS',TRUE);

	define('RELATIVE_PATH', $relativepath);
	define('TITLE', 'ONLINE TEST');
?>