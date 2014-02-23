<?php
class UtilComponent extends Object
{
	function strip_and_clean ( $id, $array) {
		$id = intval($id);
   	if( $id < 0 || $id >= count($array) ) {
      	$id = 0;
   	}
		return $id;
	}
}
?>