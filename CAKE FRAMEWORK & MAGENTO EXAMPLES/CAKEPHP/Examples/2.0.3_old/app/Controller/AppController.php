<?php
// app/Controller/AppController.php
class AppController extends Controller {
	//...

	public $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'posts', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
		)
	);

	public function isAuthorized($user) {
		if (isset($user['role']) && $user['role'] === 'admin') {
			return true; //Admin can access every action
		}
		return false; // The rest don't
	}
}