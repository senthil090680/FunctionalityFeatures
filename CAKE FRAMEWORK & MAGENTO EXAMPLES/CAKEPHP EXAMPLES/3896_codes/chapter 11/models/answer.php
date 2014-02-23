<?php

class Answer extends AppModel {

	var $name = 'Answer';
	
	var $belongsTo = array(
		'Question' => array(
			'className'    => 'Question'
		),
		'User' => array(
			'className'    => 'User'
		)
	);
	
	var $validate = array(
		'answer' => array(
			'rule' => array('minLenght', 1),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Answer cannot be empty'
		)
	);

}

?>