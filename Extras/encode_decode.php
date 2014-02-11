<?php
$alphabet_raw = "23456789abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
$alphabet = str_split($alphabet_raw);
 
function base56_encode($num, $alphabet){
    /*
	Encode a number in Base X
 
    `num`: The number to encode
    `alphabet`: The alphabet to use for encoding
    */
    if ($num == 0){
        return 0;
	}
 
	$n = str_split($num);
    $arr = array();
    $base = sizeof($alphabet);
 
    while($num){
        $rem = $num % $base;
        $num = (int)($num / $base);
        $arr[]=$alphabet[$rem];
	}
 
    $arr = array_reverse($arr);
    return implode($arr);
}
 
function base56_decode($string, $alphabet){
    /*
	Decode a Base X encoded string into the number
 
    Arguments:
    - `string`: The encoded string
    - `alphabet`: The alphabet to use for encoding
    */
 
    $base = sizeof($alphabet);
    $strlen = strlen($string);
    $num = 0;
    $idx = 0;
 
	$s = str_split($string);
	$tebahpla = array_flip($alphabet);
 
    foreach($s as $char){
        $power = ($strlen - ($idx + 1));
        $num += $tebahpla[$char] * (pow($base,$power));
        $idx += 1;
	}
    return $num;
}
echo $string = base64_encode(7);
echo "<br>";
echo $num = str_rot13($string);
echo "<br>";
echo $var = str_rot13(str_rot13($num));
echo "<br>";
?>