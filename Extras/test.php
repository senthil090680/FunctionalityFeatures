<?php
error_reporting(E_ALL);
function abc($a,$b) {
	$funccnt	=	func_num_args();
	
	$lengthfind	=	0;
	for($i=0; $i<$funccnt; $i++){
		$length = strlen(func_get_arg($i));				
		if($lengthfind == 0){
			$lengthfind	= $length;
		} else if ($lengthfind	== $length) {

		}
	}
}

//abc('abdc','abc');

$a = "NULL";

//echo !empty($a); //Ans: 1

//chr(27); //Ans : Ascii

//print 4<<5; Ans: 128 4 is multipled by 2 five times, 4*2=8*2=16*2=32*2=64*2=128

//echo 50 >> 4; //Ans: 128 50 is divided by by 2 four times, 50/2=25/2=12/2=6/2=3

//echo 64 >> 7; //Ans: 0 64 is divided by by 2 seven times, 64/2=32/2=16/2=8/2=4/2=2/2=1/2=0

//$le/1 = 'a'; // invalid variable name

//$le-1 = 'a'; // invalid variable name

//echo $le-1  // invalid

$foo = 5 + "10 things";

//echo $foo; //Ans : 15

$Rent = 250;



function Expenses($Other) {
	$Rent = 250 + $Other;
	return $Rent;
}

Expenses(50);
//echo $Rent;  //ans: 250

$a = "print";

//echo 0x100;

//var_dump(0x100);

$a = 'print';

//$a('hello');  //ans: fatal error

echo 0110; //Ans: 1280

//print null == NULL; //Ans: 1

//single quoted, double quoted, heredoc, and nowdoc are string literals

//echo (2) . (3 * (print 3)); //Ans : 323

$a = 0x01;
$b = 0x02;

//echo $a === $b >> $a; // Ans : 1

$a = (1<<0);
$b = (1<<1);

//echo ($b | $a) << 2; // ans : 12


function fn(&$var) {
	$var = $var - ($var/10*5);
	return $var;
}

//echo fn(100); // Ans: Internal Server Error 500

//str_replace // ans : array & string

//echo "5.0" == "5"; //Ans: 1

//echo !!!0;  //Ans: 1

?>