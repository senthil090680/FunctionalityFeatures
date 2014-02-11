<?php
function array_multi_sort($val, $on1,$on2, $order=SORT_ASC) { // SORTING MULTIPLE COLUMNS 
	foreach($val as $key=>$value){
		$one_way_fares[$key] = $value[$on2];
		$return_fares[$key] = $value[$on1];
	}
	array_multisort($return_fares,$order,$one_way_fares,$order,$val);
	return $val;
}

$finalSearchInfo	=	array(
array("DSR_Name" => "Samson Amole","DSRCode" => "DSR003","DateVal" => "2013-10-17","visit_Count" =>11),
array("DSR_Name" => "David", "DSRCode" => "DSR004","DateVal" => "2013-10-18","visit_Count" => 20),
array("DSR_Name" => "Samson Amole","DSRCode" => "DSR003","DateVal" => "2013-10-18","visit_Count" => 15),
array("DSR_Name" => "David","DSRCode" => "DSR004","DateVal" => "2013-10-21","visit_Count" => 16),
array("DSR_Name" => "David","DSRCode" => "DSR004","DateVal" => "2013-10-21","visit_Count" => 0),
array("DSR_Name" => "Samson Amole","DSRCode" => "DSR003","DateVal" => "2013-10-21","visit_Count" => 14),
array("DSR_Name" => "David","DSRCode" => "DSR004","DateVal" => "2013-10-22","visit_Count" => 6),
array("DSR_Name" => "Samson Amole","DSRCode" => "DSR003","DateVal" => "2013-10-22","visit_Count" => 11),
array("DSR_Name" => "Samson Amole","DSRCode" => "DSR003","DateVal" => "2013-10-21","visit_Count" => 20),
array("DSR_Name" => "David","DSRCode" => "DSR004","DateVal" => "2013-10-23","visit_Count" => 13),
array("DSR_Name" => "Samson Amole","DSRCode" => "DSR003","DateVal" => "2013-10-24","visit_Count" => 12),
array("DSR_Name" => "David","DSRCode" => "DSR004","DateVal" => "2013-10-24","visit_Count" => 15),
array("DSR_Name" => "David","DSRCode" => "DSR004","DateVal" => "2013-10-25","visit_Count" => 13),
array("DSR_Name" => "Samson Amole","DSRCode" => "DSR003","DateVal" => "2013-10-25","visit_Count" => 8),
array("DSR_Name" => "Saheed A.","DSRCode" => "DSR001","DateVal" => "2013-11-04","visit_Count" => 5),
array("DSR_Name" => "David","DSRCode" => "DSR004","DateVal" => "2013-11-05","visit_Count" => 6),
array("DSR_Name" => "David","DSRCode" => "DSR004","DateVal" => "2013-11-05","visit_Count" => 7));

$arrayval		=	array_multi_sort($finalSearchInfo, 'DSRCode','DateVal', $order=SORT_DESC); 

echo "<pre>";
print_r($arrayval);
echo "</pre>";
