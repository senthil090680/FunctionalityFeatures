<?php
class MathsController extends AppController {

	var $name = 'Maths';
	var $uses = array();
	
	function add_digits( $digit1 = 0, $digit2 = 0, $digit3 = 0 ) {
		$sum = intval($digit1) + intval($digit2) + intval($digit3);
	   $this->set('sum', $sum);
	}
}
?>