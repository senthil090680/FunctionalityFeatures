<?php
class Post extends AppModel {

	var $name = 'Post';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasOne = array(
			'Comment' => array('className' => 'Comment',
								'foreignKey' => 'post_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>