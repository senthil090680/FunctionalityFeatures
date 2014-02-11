<?php
class User extends AppModel {

	var $name = 'User';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Comment' => array('className' => 'Comment',
								'foreignKey' => 'user_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			'Post' => array('className' => 'Post',
								'foreignKey' => 'user_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			)
	);

}
?>