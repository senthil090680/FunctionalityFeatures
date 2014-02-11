<?php

class Question extends AppModel {

	var $name = 'Question';
	
	var $hasMany = array(
		'Answer' => array(
			'className'     => 'Answer'
		)
	);
	
	var $belongsTo = array(
		'User' => array(
			'className'    => 'User'
		)
	);
	
	var $validate = array(
		'question' => array(
			'rule' => array('minLenght', 1),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Question cannot be empty'
		)
	);

}

?>