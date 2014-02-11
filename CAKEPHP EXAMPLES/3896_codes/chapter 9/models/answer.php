<?php

class Answer extends AppModel {

	var $name = 'Answer';
	
	var $belongsTo = array(
		'Question' => array(
			'className'    => 'Question'
		)
	);
	
	var $validate = array(
		'answer' => array(
			'rule' => array('minLenght', 1),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Answer cannot be empty'
		),
		'answerer' => array(
			'rule' => array('minLenght', 1),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Please enter your name'
		)
	);

}

?>