<?php
//$time1 = '09:56:19';
//$time2 = '20:53:48';

$time1 = '08:11:34';
$time2 = '07:00:00';


function getTimeDiff($dtime,$atime) {
	$nextDay = $dtime>$atime?1:0;
	$dep = explode(':',$dtime);
	$arr = explode(':',$atime);
	$diff = abs(mktime($dep[0],$dep[1],0,date('n'),date('j'),date('y'))-mktime($arr[0],$arr[1],0,date('n'),date('j')+$nextDay,date('y')));
	$hours = floor($diff/(60*60));
	$mins = floor(($diff-($hours*60*60))/(60));
	$secs = floor(($diff-(($hours*60*60)+($mins*60))));
	if(strlen($hours)<2) {
	$hours="0".$hours;
	}
	if(strlen($mins)<2) {
	$mins="0".$mins;
	}
	if(strlen($secs)<2) {
	$secs="0".$secs;
	}
	return $hours.':'.$mins.':'.$secs;
} 

echo getTimeDiff($time1,$time2);





list($hours, $minutes) = explode(':', $time1);
$startTimestamp = mktime($hours, $minutes);

list($hours, $minutes) = explode(':', $time2);
$endTimestamp = mktime($hours, $minutes);

$seconds = $endTimestamp - $startTimestamp;
$minutes = ($seconds / 60) % 60;
echo $hours = floor($seconds / (60 * 60));

echo "Time passed: <b>$hours</b> hours and <b>$minutes</b> minutes";

function sum_the_time($time1, $time2) {
  $times = array($time1, $time2);
  $seconds = 0;
  foreach ($times as $time)
  {
    list($hour,$minute,$second) = explode(':', $time);
    $seconds += $hour*3600;
    $seconds += $minute*60;
    $seconds += $second;
  }
  $hours = floor($seconds/3600);
  $seconds -= $hours*3600;
  $minutes  = floor($seconds/60);
  $seconds -= $minutes*60;
  // return "{$hours}:{$minutes}:{$seconds}";
  return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds); // Thanks to Patrick
}


echo sum_the_time('10:59', '10:59');  // this will give you a result: 19:12:25

?>