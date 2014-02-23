<?php  
class User extends AppModel { 
    var $name = 'User'; 
    var $displayField = 'fname'; 
    var $validate = array( 
        'fname' => VALID_NOT_EMPTY, 
        'lname' => VALID_NOT_EMPTY, 
        'email' => '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', 
        'password' => '/^[_a-z0-9-][_a-z0-9-][_a-z0-9-][_a-z0-9-][_a-z0-9-][_a-z0-9-]+$/' 
    ); 
    var $jsFeedback = array( 
        'fname' => 'Enter a first name', 
        'lname' => 'Enter a last name', 
        'email' => 'Enter a valid email', 
        'password' => 'Your password must be at least 6 characters' 
    ); 
} 
?>