<?php
class AppController extends Controller {
	
	var $components = array('Auth', 'Cookie');
 	
	function beforeFilter(){
  		$this->Auth->loginRedirect = array('controller' => 'questions', 'action' => 'home');
  		$this->Auth->logoutRedirect  = array('controller' => 'questions', 'action' => 'home');
  		$this->Auth->allow('signup', 'confirm', 'home', 'show');
  		$this->Auth->authorize = 'controller';
  		$this->Auth->userScope = array('User.confirmed' => '1');
  		$this->set('loggedIn', $this->Auth->user('id'));
  		
  		$this->Auth->autoRedirect = false;
  		$this->Cookie->name = 'QuickWall';
  		
  		if(!$this->Auth->user('id')) {
  			$cookie = $this->Cookie->read('User');
  			if($cookie) {
  				$this->Auth->login($cookie);
  			}
  		}
  		
  	}
  	
  	function isAuthorized() {
  		return true;
  	}
	
}
?>