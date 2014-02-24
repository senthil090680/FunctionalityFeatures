<?php
class SingleTon { //Singleton Class
	private static $sing_instance = NULL;
	private $startConstruct;
	private $queryAnnex = '';
	private $selQuery;
	private $conString;

	private function __construct($dbName,$dbUser,$dbPass,$serverName) {
		$conString	=	mysql_connect($serverName,$dbUser,$dbPass);
		if(!($conString)) {
			die("Connection could not be made ". mysql_error());
		}
		mysql_select_db($dbName,$conString);
	}
	
	public static function getInstance($dbName = '',$dbUser = '',$dbPass = '',$serverName = '') {
		if(self::$sing_instance === NULL) {
			$startConstruct		=	new SingleTon($dbName,$dbUser,$dbPass,$serverName);	
		}
	}	

	/* selectQuery FUNCTION ARGUMENTS SHOULD BE
	1	OUTPUT VARIABLES	2	CONDITION VARIABLES	& VALUES	3	TABLE NAME
	4	RESULT TYPE			5	NUM OF ROWS REQUIRED OR NOT */

	public static function selectQuery($resultVar,$condVar = '',$tabVar,$fetchType = MY_BOTH,$nor = FALSE) {
		
		$arrSel					=		array();
		$selQuery				=		"SELECT ".$resultVar." FROM ".$tabVar." ".$condVar." ";
		//exit(0);

		$selResult				=		mysql_query($selQuery) or die(mysql_error());
		
		while($resultRow		=		mysql_fetch_array($selResult)) {
			$totalRows[]		=		$resultRow;
		}

		if($nor) {
			$noofrows			=		mysql_num_rows($selResult);
			$arrSel				=		array($noofrows,$totalRows);	
		} else {
			$arrSel				=		$totalRows;
		}
		
		return $arrSel;
	}
	public static function debugerr($value){ 
		echo "<pre>",print_r($value, true),"</pre>";
	}
}
?>