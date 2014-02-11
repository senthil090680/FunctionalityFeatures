<?php

//This is an example for variable adding some values to it after reference
function add_some_extra(&$string)
{
    $string .= 'and something extra.';
}
$str = 'This is a string, ';
add_some_extra($str);
echo $str . "<br />";  


//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//This is an example for variable reference
$variable   =   'guru';
$guru       =   'aravind';  

echo $$variable . "<br />";

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//This is to use pos(), which is alias of current() function.  This function will return the current element in an array
$people = array("Peter", "Joe", "Glenn", "Cleveland");

echo pos($people) . "<br />";

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//This is to use next() and prev() function.  The next() function will return the next element in an array.  The prev() function will return the previous element in an array
$people = array("Peter", "Joe", "Glenn", "Cleveland");

echo next($people) . "<br />";

echo prev($people) . "<br />";

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//7 down vote accepted
	

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


//Curly braces are used to explicitly specify the end of a variable name. For example:

echo "This square is {$square->width}00 centimeters broad."; 

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//Adding two strings in different ways

$var1	=	'ab';
$var2	=	'cd';

echo $var1 + $var2;
echo "<br>";
echo "{$var1}efg{$var2}";
echo "<br>";
echo $var1.$var2;
echo "<br>";

echo $var1[1];
echo "<br>";

echo implode('',array($var1,$var2));
echo "<br>";

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//Different concatenation

echo 'Testing' . 1 + 2 + 'abc ';
echo "<br>";

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$try_rawurlencode =  "hello man good";

echo rawurlencode($try_rawurlencode);

echo "<br>";

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//Printf, print and echo

if(printf("Printf returns length ") ) {
	echo "of the outputted string";
}

echo "<br>";

if(print "Print returns always " ) {
	echo "1";
}

echo "<br>";

echo "Echo does not return any value";

echo "<br>";

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//LIST IN PHP

$my_array = array("Dog","Cat","Horse");

list($a, $b, $c) = $my_array;  //Assign value to multiple variable in one operation

echo "I have several animals, a $a, a $b, a $c.";

echo "<br>";

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$arrayone	=	array(10,20,40);

$arraytwo	=	array(1 => 20, 0 => 10, 2 => 40);

var_dump( $arrayone == $arraytwo );

echo "<br>";

var_dump( (bool) 5.8 );

echo "<br>";

$a = 123;

if($a === 0123) {
	echo "good";
} else {
	echo "bad";
}

echo "<br>";

echo count(strlen("http://php.net"));

echo "<br>";

$pattern = '/^[a-zA-Z0-9_.-]{5,1500}$/'; // this will allow a to z alphabets, A to Z alphabets, 0 to 9 numbers, underscore, dot operator, - symbol, and characters between 5 to 1500 limit, this starts with single quote, forward slash, caret symbol, left angular bracket, closed with right angular bracket, range in left curly brace and closed with right curly brace, ends with $ symbol, forward slash, and a single quote

$username = "this.is.a-demo_-werewrewrwerweeeeeeeeeeeeeeererewrwerewrwerew";
 
if (preg_match($pattern,$username)) echo "Match";
else echo "Not match";

echo "<br>";

$matsec = "this is good one";
echo substr_replace($matsec ,"",-5);	

echo "<br>";

echo $time = date('Y-m-d h:i:s');

echo "<br>";

echo $now = time()-strtotime($time);

echo "<br>";

echo $time = date('g:iA M dS');

echo "<br>";

date_default_timezone_set ("Asia/Calcutta");

echo substr("Hello world!",6,2);

echo "<br>";	

echo 123+"9oabc22";

echo "<br>";	

$_SESSION['name'] = 'senthil';

echo $time = date("h:i:s");

echo "<br>";

$now = time()-strtotime($time);

echo $time = date('g:iA M dS', strtotime($time));

echo "<br>";

echo date('Y-m-d H:i:s', time());

setcookie("name","good",time()+300);
?>

<script type="text/javascript">

alert(document.cookie);

</script>