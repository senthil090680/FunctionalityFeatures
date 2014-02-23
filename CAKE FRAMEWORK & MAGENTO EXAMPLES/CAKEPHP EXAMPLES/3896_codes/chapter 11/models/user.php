<?php 

class User extends AppModel { 

	var $name = 'User';
	
	var $validate = array( 
		'username' => array( 
			'notempty' => array( 
				'rule' => array('minLenght', 1), 
				'required' => true, 
				'allowEmpty' => false, 
				'message' => 'User name cannot be empty' 
			), 
			'unique' => array( 
				'rule' => array('checkUnique', 'username'), 
				'message' => 'User name taken. Use another' 
			) 
		), 
		'password' => array( 
			'notempty' => array( 
				'rule' => array('minLenght', 1), 
				'required' => true, 
				'allowEmpty' => false, 
				'message' => 'Password cannot be empty.' 
			), 
			'passwordSimilar' => array( 
				'rule' => 'checkPasswords', 
				'message' => 'Different password re entered.' 
			) 
		), 
		'email' => array( 
			'rule' => 'email', 
			'required' => true, 
			'allowEmpty' => false,
			'message' => 'Please enter a valid email' 
		) 
	); 
	
	var $hasMany = array(
		'Question' => array(
				'className'     => 'Question'
		),
		'Answer' => array(
			'className'     => 'Answer'
		)
	);
	
	function checkUnique($data, $fieldName) { 
  		$valid = false; 
     	if(isset($fieldName) && $this->hasField($fieldName)) { 
         	$valid = $this->isUnique(array($fieldName => $data)); 
        } 
        return $valid; 
  	} 
  	
  	function checkPasswords($data) { 
		if($data['password'] == $this->data['User']['password2hashed']) 
			return true; 
		return false; 
	} 

} 

?>