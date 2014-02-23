<?php  
class UsersController extends AppController 
{ 
    var $name = 'Users'; 
    var $helpers = array('Html', 'Javascript', 'Ajax','Form','Jsvalid');  
    function add(){ 
    } 
    function validator(){ 
        $this->layout = ''; 
        $this->set('user',$this->User->query("SELECT * FROM `users` WHERE `email` = '{$this->data['User']['email']}'")); 
    } 
} 
?>